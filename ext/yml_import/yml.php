<?php

/*
 * Если категория новая - она добавляется.
 * Если категория уже существует - ничего не меняется, не перезаписывается описание, категория вообще никак не изменяется.
 * Если товар новый - он добавляется. Если категория товара уже существовала, он добавится в уже существующую категорию
 * Если товар уже существует:   всегда обновляется наличие (в бд - products_status, в файле - <available> 1 или 0)
 *                              меняется название и описание, если отмечена галочка,
 *                              меняется цена, если отмечена галочка
 *                              меняется количество (в бд - products_quantity, в файле - <stock_quantity> или <quantity_in_stock>), если отмечена галочка
 *                              меняются картинки, если отмечена галочка
 *                              НЕ меняется категория товара
 * Галочка "Импортировать изображения", если отмечена, физически загружает на сервер новые картинки из файла к новым товарам, если до этого их на сервере не было. Если не отмечена - поменяет названия картинок для товара, но физически на сервер их загружать не будет, для экономии времени и траффика.
 * Если в файле естьи  новые и старые товары, можно отметить галочку "Импортировать изображения" - будут загружены новые картинки, но не отмечать "Заменять у существующих товаров изображения" - у старых товаров ничего не поменяется
 *
 * */
/**
 * Created by PhpStorm.
 * User: 'Serhii.M'
 * Date: 12.04.2019
 * Time: 12:18
 */
global $vendor_template, $truncate_table;

$milliseconds = round(microtime(true) * 1000);
ini_set('max_execution_time', '0');

$result = [
    'success' => true
];
if (empty($file_path)) {
    $result = [
        'success' => false,
        'message' => 'Empty filepath',
    ];
}

if ($result['success'] && !$urlData['success']) {
    $result = [
        'success' => false,
        'message' => $urlData['msg'],
    ];
}
$imageFolder = DIR_FS_CATALOG_IMAGES;
$file = $file_path;

if($result['success'] && empty(file_get_contents($file))){
    $result = [
        'success' => false,
        'message' => 'Document is empty!',
    ];
}

function clearDuplicates()
{
    $productIds = [];
    //collect duplicates by id
    $query = tep_db_query("SELECT min(products_id) as min_products_id, id_sys_product, products_model, vendor_template, min(products_price) as min_price, max(products_price) as max_price
                        FROM products
                        GROUP BY id_sys_product, vendor_template
                        HAVING COUNT(id_sys_product) > 1");
    $ids = $excludeProducts = [];
    while ($row = tep_db_fetch_array($query)) {
        $ids[] = $row['id_sys_product'];
        $excludeProducts[] = $row['min_products_id'];
    }
    if (!empty($ids) && !empty($excludeProducts)) {
        $idsList = implode("', '", $ids);
        $excludeProductsList = implode("', '", $excludeProducts);
        $query = tep_db_query("SELECT products_id FROM products WHERE id_sys_product in ('{$idsList}') and products_id not in ('{$excludeProductsList}')");
        while ($row = tep_db_fetch_array($query)) {
            $productIds[] = $row['products_id'];
        }
    }

    //clear collected duplicates
    if (!empty($productIds)) {
        $productIdsList = implode("', '", $productIds);
        tep_db_query("DELETE FROM products WHERE products_id in ('{$productIdsList}')");
        tep_db_query("DELETE FROM products_description WHERE products_id in ('{$productIdsList}')");
        tep_db_query("DELETE FROM products_to_categories WHERE products_id in ('{$productIdsList}')");
    }
}
clearDuplicates();

if ($result['success']) {
    $data = simplexml_load_file($file);
    $lng = new language();

    if ($truncate_table) {
        tep_db_query("TRUNCATE TABLE `products`;");
        tep_db_query("TRUNCATE TABLE `products_attributes`");
        tep_db_query("TRUNCATE TABLE `products_attributes_download`;");
        tep_db_query("TRUNCATE TABLE `products_attributes_groups`");
        tep_db_query("TRUNCATE TABLE `products_description`;");
        tep_db_query("TRUNCATE TABLE `products_notifications`");
        tep_db_query("TRUNCATE TABLE `products_options`;");
        tep_db_query("TRUNCATE TABLE `products_options_values`");
        tep_db_query("TRUNCATE TABLE `products_options_values_to_products_options`;");
        tep_db_query("TRUNCATE TABLE `products_to_categories`");
        tep_db_query("TRUNCATE TABLE `products_xsell`;");
        tep_db_query("TRUNCATE TABLE `categories_description`");
        tep_db_query("TRUNCATE TABLE `categories`;");
        tep_db_query("TRUNCATE TABLE `manufacturers`;");
        tep_db_query("TRUNCATE TABLE `manufacturers_info`;");
    }


    $all_attributes_array = tep_get_all_attributes_array();
    $all_attributes_values_array = tep_get_all_attributes_values_array();
    $all_products_attributes_array = tep_get_all_products_attributes_array();
    $all_po2pov_array = tep_get_all_po2pov_array();
    $all_DB_manufacturers_array = tep_get_all_manufacturers($lng->language['id']);
    $import_lang_id = $_POST['import_language'] ?? tep_get_languages_id(DEFAULT_LANGUAGE);

    $productsCounter = $productsUpdateCounter = $productsDeactivatedCounter = $categoriesCounter = $manufacturersCounter = $attributesCounter = $attributesUpdateCounter = $attrValuesCounter = $attrValuesUpdateCounter = 0;
    $manufacturers = $products_manufacturers = [];

//-------------------currencies--------------------------------
    $currencies_array = array();
    foreach ($data->shop->currencies as $currencies_arr) {
        foreach ($currencies_arr as $currency) {
            if ($rate = intval($currency['rate'])) {
                $currency_name = strval($currency['id']);
                $currencies_array[$currency_name] = $rate;
            }
        }
    }

//----------------------categories--------------------------------
    //structure categories data to tree
    function collectCategoriesTree(&$all_cats, $parentId)
    {
        global $categories_data, $categories_array;
        if (!empty($categories_array[$parentId])) {
            foreach ($categories_array[$parentId] as $childId) {
                //collect data
                $all_cats[$parentId]['children'][$childId] = $categories_data[$childId];
                //collect child data
                collectCategoriesTree($all_cats[$parentId]['children'], $childId);
            }
        }
    }

    //check and insert structured categories data
    function addCatToDb($category_data)
    {
        global $categoriesCounter;
        global $vendor_template_ids_array;
        global $vendor_template;

        $category_to_db_description = $category_data['description'];
        $category_to_db_children = $category_data['children'];
        unset($category_data['description']);
        unset($category_data['children']);

        //check is category exist
        $is_category_exist = false;

        //get vendor templates by vendor category id
        $vendorTemplatesByVendorCategoryInDB = $vendor_template_ids_array[$category_data['id_sys_category']];

        //if vendor category id exist in DB
        if (isset($vendorTemplatesByVendorCategoryInDB)) {
            if (in_array($vendor_template, $vendorTemplatesByVendorCategoryInDB)) {
                //exist category of this vendor
                $is_category_exist = true;
            } elseif ($_GET['vendor'] != $vendor_template) {
                //vendor template contain brand
                foreach ($vendorTemplatesByVendorCategoryInDB as $vendorTemplateByVendorCategoryInDB) {
                    if (strpos($vendorTemplateByVendorCategoryInDB, $_GET['vendor']) !== false) {
                        //exist category of this vendor but another brand
                        $is_category_exist = true;
                        break;
                    }
                }
            }
        }
        //check is category exist END

        if ($is_category_exist) {
            //get category id
            $category_id = tep_get_categories_id([
                'id_sys_category' => $category_data['id_sys_category'],
                'vendor_template' => $vendor_template
            ]);
        } elseif (!empty($category_data['id_sys_category'])) {
            //insert category
            tep_db_perform(TABLE_CATEGORIES, $category_data);
            $category_id = tep_db_insert_id();

            //insert category description
            foreach ($category_to_db_description as $lang) {
                $lang['categories_id'] = $category_id;
                tep_db_perform(TABLE_CATEGORIES_DESCRIPTION, $lang);
            }
        }

        //insert child categories data and description
        if (!empty($category_to_db_children) && !empty($category_id)) {
            foreach ($category_to_db_children as $child) {
                $child['parent_id'] = $category_id;
                addCatToDb($child);
            }
        }

        //count categories
        $categoriesCounter++;
    }

    global $main_category;
    $main_category = (int)$main_category;

    //prepare parent category
    //if target-category is not on the top level (category id != 0)
    $topLevelCategory = 0;
    if ($main_category != $topLevelCategory) {
        //then if target-category does not exist
        $query = tep_db_query("SELECT * FROM categories WHERE categories_id = " . $main_category . " LIMIT 1");
        if (!tep_db_num_rows($query)) {
            //create new category that is child of top level category
            $sql = "INSERT INTO " . TABLE_CATEGORIES . " (
                parent_id,
                sort_order,
                date_added,
                last_modified
            ) VALUES (
                " . $topLevelCategory . ",
                0,
                '" . date("Y-m-d H:i:s") . "',
                '" . date("Y-m-d H:i:s") . "'
            )";
            $result = tep_db_query($sql);

            if ($result) {
                //create new category description
                $newCategoryId = tep_db_insert_id();
                $sql = "insert into " . TABLE_CATEGORIES_DESCRIPTION . " (
                    categories_id, 
                    language_id, 
                    categories_name,
                    categories_heading_title,
                    categories_description, 
                    categories_seo_url
                ) values (
                    '" . (int)$newCategoryId . "', 
                    '" . (int)$import_lang_id . "', 
                    '" . tep_db_input($vendor_template) . "', 
                    '" . tep_db_input($vendor_template) . "', 
                    '" . tep_db_input($vendor_template) . "', 
                    '" . tep_db_input($vendor_template) . "'
                )";
                $result = tep_db_query($sql);
            }

            if ($result) {
                //use new category that is child of top level category instead target-category
                $main_category = $newCategoryId;
            } else {
                //use top level category instead target-category
                $main_category = $topLevelCategory;
            }
        }
    }
    //prepare parent category END

    //collect categories data to arrays
    $categories_data = [];
    $categories_array = [];
    if (!empty($data->shop->categories->category)) {
        foreach ($data->shop->categories->category as $row) {
            //get parent id
            if (!empty($row['parentId'])) {
                $parentId = intval($row['parentId']);
            } else {
                $parentId = $main_category;
            }

            //get category name
            $name = isset($row->name) && !empty($row->name) ? strval($row->name) : strval($row);

            //collect category id to categories array
            $categories_array[$parentId][intval($row['id'])] = intval($row['id']);

            //collect categories description data
            $categories_description_array[$import_lang_id] = [
                'categories_name' => $name,
                'language_id' => $import_lang_id,
                'vendor_template' => $vendor_template,
                'id_sys_category' => intval($row['id']),
            ];

            //collect categories data
            $categories_data[intval($row['id'])] = [
                'parent_id' => $parentId,
                'categories_status' => 1,
                'sort_order' => 0,
                'date_added' => date('Y-m-d H:i:s'),
                'last_modified' => date('Y-m-d H:i:s'),
                'vendor_template' => $vendor_template,
                'id_sys_category' => intval($row['id']),
                'description' => $categories_description_array,
            ];
        }
    }

    //structure data, check and insert to DB
    if (!empty($categories_array)) {
        // find vendor template by vendor category id
        $all_categories_by_vendor_template = tep_get_all_categories_by_vendor_template();
        foreach ($all_categories_by_vendor_template as $vendor_template_code => $vendor_template_ids) {
            foreach ($vendor_template_ids as $vendor_template_id) {
                $vendor_template_ids_array[$vendor_template_id][$vendor_template_code] = $vendor_template_code;
            }
        }

        //structure categories data to tree
        $all_cats = [];
        collectCategoriesTree($all_cats, $main_category);

        //check and insert categories
        foreach ($all_cats[$main_category]['children'] as $category_to_bd) {
            addCatToDb($category_to_bd);
        }
    }

//----------------------products--------------------------------
    global $replace_price, $replace_quantity, $replace_name, $missing_offers, $replace_image, $upload_images;

    $all_products_by_vendor_template = tep_get_all_products_by_vendor_template();
    if (!empty($all_products_by_vendor_template[$vendor_template]['id'])) {
        $existing_products = $all_products_by_vendor_template[$vendor_template]['id'];
    } else {
        $existing_products = [];
    }

    function addMarkup($value, $i)
    {
        //если выставили наценку на эту цену
        if (!empty($_POST['markup_value_price' . $i])) {
            $type = $_POST['markup_type_price' . $i];
            if ($type == 0) {
                //наценка = цена + число
                $markup = $_POST['markup_value_price' . $i];
                return $value + priceToFloat($markup);
            } else {
                //наценка = цена + процент
                $markup = $value * ($_POST['markup_value_price' . $i] / 100);
                return $value + priceToFloat($markup);
            }
        }
        return $value;
    }

    $brand_name_to_id_array = [];

    $totalProducts = count($data->shop->offers->offer);

    $modelCodeTag = $modelCodeTag ?: 'vendorCode';
    foreach ($data->shop->offers->offer as $row) {
        checkStopImportProcess();

        $vendorProductModel = $row->$modelCodeTag ?: $row[$modelCodeTag];
        $vendorProductId = strval($row['id']);

        if (!empty($all_products_by_vendor_template[$vendor_template]['id'])) {
            $is_product_exist = in_array($vendorProductId, $all_products_by_vendor_template[$vendor_template]['id']);
            if ($is_product_exist) {
                $action = 'update';
                $product_id = array_search($vendorProductId, $all_products_by_vendor_template[$vendor_template]['id']);
            } else {
                $action = 'insert';
            }
        } else {
            $action = 'insert';
        }

        if ($row['available'] == 'true') {
            $available = 1;
        } else {
            $available = 0;
        }
        $url = strval($row->url);
        $currencyId = strval($row->currencyId);
        $price = priceToFloat($row->price);
        $categoryId = tep_get_categories_id([
            'id_sys_category' => intval($row->categoryId),
            'vendor_template' => $vendor_template
        ]);
        if ($categoryId === 0) {
            $categoryId = $main_category;
        }

        if (isset($row->stock_quantity) || isset($row->quantity_in_stock)) {
            $quantity = intval($row->stock_quantity ?: $row->quantity_in_stock);
        } else {
            $quantity = 1;
        }

        $name = strval($row->name ?: $row->model);
        $vendor = trim(strval($row->vendor));
        $description = nl2br(strval($row->description));

        // MANUFACTURERS===============================================================

        if (in_array($vendor, $all_DB_manufacturers_array)) {
            // for update product manufacturers
            $manufacturers_id = array_search($vendor, $all_DB_manufacturers_array);
        } else {
            // for new manufacturers
            $manufacturersCounter++;
            $manufacturer_array = [
                'date_added' => date('Y-m-d H:i:s'),
                'last_modified' => date('Y-m-d H:i:s'),
                'status' => 1
            ];

            tep_db_perform(TABLE_MANUFACTURERS, $manufacturer_array);
            $manufacturers_id = tep_db_insert_id();
            foreach ($lng->catalog_languages as $lang) {
                $manufacturer_info_array = [
                    'manufacturers_id' => $manufacturers_id,
                    'manufacturers_name' => $vendor,
                    'languages_id' => $lang['id']
                ];
                tep_db_perform(TABLE_MANUFACTURERS_INFO, $manufacturer_info_array);
            }

            $all_DB_manufacturers_array[$manufacturers_id] = $vendor;
        }

        // MANUFACTURERS==END==========================================================

        if ($action == 'update') {
            $products_array = [
                'products_model' => $vendorProductModel,
                'products_status' => $available,
                'manufacturers_id' => $manufacturers_id,
                'products_last_modified' => date('Y-m-d H:i:s'),
                'id_sys_product' => $vendorProductId,
            ];

            if ($replace_price) {
                //функция добавления наценки
                $products_array['products_price'] = addMarkup($price, 0);

                $prices_num = tep_xppp_getpricesnum();
                if ($prices_num > 1) {
                    for ($i = 2; $i <= $prices_num; $i++) {
                        $products_array['products_price_' . $i] = addMarkup($price, $i);
                    }
                }
            }

            if ($replace_quantity) {
                $products_array['products_quantity'] = $quantity;
                //  $products_array['products_status'] = $quantity > 0 ? 1 : 0;
            }
            tep_db_perform(TABLE_PRODUCTS, $products_array, $action, 'products_id=' . $product_id);

            // products_description
            if ($replace_name) {
                $products_descriptions = [];

                $products_descriptions['products_id'] = $product_id;
                $products_descriptions['products_name'] = $name;
                $products_descriptions['products_description'] = $description;
                $products_descriptions['language_id'] = $import_lang_id;

                tep_db_query("DELETE FROM " . TABLE_PRODUCTS_DESCRIPTION . " WHERE products_id = '" . $product_id . "' AND language_id = " . $import_lang_id);
                tep_db_perform(TABLE_PRODUCTS_DESCRIPTION, $products_descriptions);
            }

            $productsUpdateCounter++;

        } else {
            // products
            $products_array = [
                'products_model' => $vendorProductModel,
                'products_status' => $available,
                'products_quantity' => $quantity,
                //'products_price' => $price,
                'manufacturers_id' => $manufacturers_id,
                'products_date_added' => date('Y-m-d H:i:s'),
                'products_last_modified' => date('Y-m-d H:i:s'),
                'id_sys_product' => $vendorProductId,
                'vendor_template' => $vendor_template,
            ];

            $products_array['products_price'] = addMarkup($price, 0);
            $prices_num = tep_xppp_getpricesnum();
            if ($prices_num > 1) {
                for ($i = 2; $i <= $prices_num; $i++) {
                    $products_array['products_price_' . $i] = addMarkup($price, $i);
                }
            }

            tep_db_perform(TABLE_PRODUCTS, $products_array, $action);

            $product_id = tep_db_insert_id();
            // products_to_categories
            $products_to_categories_array = [
                'categories_id' => $categoryId,
                'products_id' => $product_id,
            ];
            tep_db_perform(TABLE_PRODUCTS_TO_CATEGORIES, $products_to_categories_array, $action);
            // products_description
            foreach ($lng->catalog_languages as $lang) {
                if ($lang['id'] == $import_lang_id) {
                    $products_descriptions = [
                        'products_id' => $product_id,
                        'products_name' => $name,
                        'products_description' => $description,
                        'language_id' => $lang['id']
                    ];
                } else {
                    $products_descriptions = [
                        'products_id' => $product_id,
                        'products_name' => '',
                        'products_description' => '',
                        'language_id' => $lang['id']
                    ];
                }
                tep_db_perform(TABLE_PRODUCTS_DESCRIPTION, $products_descriptions, $action);
            }
            $productsCounter++;
        }

        // ATTRIBUTES===============================================================

        if ($replace_attributes or $action == 'insert') {
            $product_attributes = array();
            foreach ($row->param as $attribute) {
                $name = (string)$attribute['name'];
                $unit = (string)$attribute['unit'];
                $fullname = trim($name . ($unit ? ', ' . $unit : '')) ?: '-';
                $attribute_value = trim((string)$attribute) ?: '-';
                if (!in_array($fullname, $all_attributes_array)) {
                    // insert new option:
                    $option_id = getLastOptionId();
                    foreach ($lng->catalog_languages as $lang) {
                        /*   $option = [
                               'products_options_id' => $option_id,
                               'language_id' => $lang['id'],
                               'products_options_name' => $fullname,
                               'products_options_type' => 0
                           ];
                           tep_db_perform(TABLE_PRODUCTS_OPTIONS, $option);
                       */
                        if ($lang['id'] !== $import_lang_id) {
                            $fullname = '';
                        }

                        tep_db_query("INSERT into " . TABLE_PRODUCTS_OPTIONS . " (products_options_id,language_id,products_options_name,products_options_type) 
                    values (" . $option_id . "," . $lang['id'] . ",'" . mysqli_real_escape_string(DB(), $fullname) . "',0) ");
                        $all_attributes_array[$option_id . '.' . $lang['id']] = $fullname;
                    }


                    if (!in_array($attribute_value, $all_attributes_values_array)) {
                        // insert new option value:
                        $ovalue_id = '';
                        foreach ($lng->catalog_languages as $lang) {
                            if ($lang['id'] !== $import_lang_id) {
                                $attribute_value = '';
                            }
                            $oValues = [
                                'language_id' => $lang['id'],
                                'products_options_values_name' => $attribute_value
                            ];

                            if (isset($ovalue_id)) {
                                $oValues['products_options_values_id'] = $ovalue_id;
                            }

                            tep_db_perform(TABLE_PRODUCTS_OPTIONS_VALUES, $oValues);
                            $ovalue_id = tep_db_insert_id();
                            $all_attributes_values_array[$ovalue_id . '.' . $lang['id']] = $attribute_value;

                        }

                    } else {
                        // get existing option value for add it to pov2po table:
                        $ovalue_id = array_search($attribute_value, $all_attributes_values_array);
                        $ovalue_id = explode('.', $ovalue_id);
                        $ovalue_id = $ovalue_id[0];
                    }

                    // option to option_value
                    $optionsValuesToOption = [
                        'products_options_id' => $option_id,
                        'products_options_values_id' => $ovalue_id
                    ];
                    tep_db_perform(TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS, $optionsValuesToOption);
                    $all_po2pov_array[] = $option_id . '.' . $ovalue_id;

                    if (!in_array($product_id . '.' . $option_id . '.' . $ovalue_id, $all_products_attributes_array)) {
                        //products attributes:
                        $prod_attr_array = [
                            'products_id' => $product_id,
                            'options_id' => $option_id,
                            'options_values_id' => $ovalue_id,
                            'options_values_price' => '',
                            'pa_qty' => 1
                        ];
                        tep_db_perform(TABLE_PRODUCTS_ATTRIBUTES, $prod_attr_array);
                        $all_products_attributes_array[] = $product_id . '.' . $option_id . '.' . $ovalue_id;
                    }

                } else {
                    // if attribute already exists but current attribute value is new:
                    if (!in_array($attribute_value, $all_attributes_values_array)) {
                        // insert new option value:
                        $ovalue_id = '';
                        foreach ($lng->catalog_languages as $lang) {
                            if ($lang['id'] !== $import_lang_id) {
                                $attribute_value = '';
                            }
                            $oValues = [
                                'language_id' => $lang['id'],
                                'products_options_values_name' => $attribute_value
                            ];

                            if (isset($ovalue_id)) {
                                $oValues['products_options_values_id'] = $ovalue_id;
                            }

                            tep_db_perform(TABLE_PRODUCTS_OPTIONS_VALUES, $oValues);
                            $ovalue_id = tep_db_insert_id();
                            $all_attributes_values_array[$ovalue_id . '.' . $lang['id']] = $attribute_value;
                        }


                    } else {
                        // if attribute value exists and attribute exists, DO NOTHING
                        $ovalue_id = array_search($attribute_value, $all_attributes_values_array);
                        $ovalue_id = explode('.', $ovalue_id);
                        $ovalue_id = $ovalue_id[0];
                    }

                    // if attributes and values already exists but current product is new:
                    $option_id = array_search($fullname, $all_attributes_array);
                    $option_id = explode('.', $option_id);
                    $option_id = $option_id[0];

                    if (!in_array($option_id . '.' . $ovalue_id, $all_po2pov_array)) {
                        // option to option_value
                        $optionsValuesToOption = [
                            'products_options_id' => $option_id,
                            'products_options_values_id' => $ovalue_id
                        ];
                        tep_db_perform(TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS, $optionsValuesToOption);
                        $all_po2pov_array[] = $option_id . '.' . $ovalue_id;
                    }

                    if (!in_array($product_id . '.' . $option_id . '.' . $ovalue_id, $all_products_attributes_array)) {
                        //products attributes:
                        $prod_attr_array = [
                            'products_id' => $product_id,
                            'options_id' => $option_id,
                            'options_values_id' => $ovalue_id,
                            'options_values_price' => '',
                            'pa_qty' => 1
                        ];
                        tep_db_perform(TABLE_PRODUCTS_ATTRIBUTES, $prod_attr_array);
                        $all_products_attributes_array[] = $product_id . '.' . $option_id . '.' . $ovalue_id;
                    }
                }
            }
        }

        // ATTRIBUTES==END==========================================================


        $all_products_by_vendor_template[$vendor_template]['id'][$product_id] = $vendorProductId;

        unset($existing_products[$product_id]);

        // update ajax queries about progress (why not SESSION??)
        $progress_array['productsProcessed'] = (int)(100 * ($productsUpdateCounter + $productsCounter) / $totalProducts);
        file_put_contents($rootPath . '/ext/yml_import/progress.txt', json_encode($progress_array));
        //$_SESSION['checkImportProgress'] = json_encode($progress_array);

    }

    debug(round(microtime(true) * 1000) - $milliseconds);

    //deactivate deleted products:
    if (!empty($existing_products)) {
        switch ($missing_offers) {
            case 'turnoff':
                tep_db_query("UPDATE " . TABLE_PRODUCTS . " SET products_status = 0 WHERE products_id in(" . implode(',', array_keys($existing_products)) . ")");
                break;
            case 'delete':
                tep_db_query("DELETE FROM " . TABLE_PRODUCTS . " WHERE products_id in(" . implode(',', array_keys($existing_products)) . ")");
                break;
        }
    }

    // UPLOAD IMAGES SEPARATELY==========================================================
    $imageDownloadCounter = 0;

    function saveImg($url, $download = false)
    {
        global $imageFolder, $imageDownloadCounter;
        $imageFolder = $imageFolder ?: DIR_WS_IMAGES;

        //get filename
        $filename_arr = explode('/', $url);
        $filename = end($filename_arr);

        //sanitize filename
        $filename = str_replace('+', '_', $filename);
        //transliterate filename
        $filename = transliterate_filename($filename);

        if (!$download) {
            return $filename;
        }
        if (!file_exists($imageFolder . 'products/' . $filename)) {
            $imageDownloadCounter++;
            //format url
            $url = explode('/', $url);
            $url = trim(implode('/', $url));
            $url = str_replace(' ', '%20', $url);
            $url = str_replace('%28', '(', $url);
            $url = str_replace('%29', ')', $url);

            //get image by url
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
            $img = curl_exec($ch);
            curl_close($ch);

            //when image is not available
            if (empty($img)) {
                return '';
            }

            //check directory
            if (!file_exists($imageFolder . 'products/')) {
                mkdir($imageFolder . 'products/');
            }

            //save image by path
            $path = $imageFolder . 'products/' . $filename;
            file_put_contents($path, $img);
        }

        return $filename;
    }

    //upload images
    if ($replace_image) {
        $replacedImagesProducts = 0;
        foreach ($data->shop->offers->offer as $row) {
            if (isset($row->picture) && !empty($row->picture)) {
                checkStopImportProcess();

                $vendorProductModel = $row->$modelCodeTag ?: $row[$modelCodeTag];
                $vendorProductId = $row['id'];
                $product_id = array_search($vendorProductId, $all_products_by_vendor_template[$vendor_template]['id'] ?: []);
                $images = array();
                foreach ($row->picture as $picture) {
                    $picture = strval($picture);
                    $picture = str_replace('%28', '(', $picture);
                    $picture = str_replace('%29', ')', $picture);
                    $images[] = saveImg(strval($picture), $upload_images);
                }

                //update images of each product
                if (!empty($product_id) && is_array($images) && !empty($images)) {
                    tep_db_perform(TABLE_PRODUCTS, array('products_image' => implode(';', $images)), 'update', 'products_id=' . $product_id);
                }

                // update ajax queries about progress (why not SESSION??)
                $replacedImagesProducts++;
                $progress_array['imagesUploaded'] = (int)(100 * ($replacedImagesProducts) / $totalProducts);
                file_put_contents($rootPath . '/ext/yml_import/progress.txt', json_encode($progress_array));
                //$_SESSION['checkImportProgress'] = json_encode($progress_array);
            }
        }
    }

    // UPLOAD IMAGES SEPARATELY==========================================================


    debug(round(microtime(true) * 1000) - $milliseconds);
    // if we did not had any upload or $replace_image did not checked
    if ($progress_array['imagesUploaded'] == 0) {
        $progress_array['imagesUploaded'] = 100;
        file_put_contents($rootPath . '/ext/yml_import/progress.txt', json_encode($progress_array));
        //$_SESSION['checkImportProgress'] = json_encode($progress_array);
    }

    file_put_contents($rootPath . '/ext/yml_import/progress.txt', '{"productsProcessed":100,"imagesUploaded":100}');

    //if new parent category is empty
    $queryCategories = tep_db_query("SELECT * FROM categories WHERE parent_id = " . $main_category . " LIMIT 1");
    $queryProducts = tep_db_query("SELECT * FROM products_to_categories WHERE categories_id = " . $main_category . " LIMIT 1");
    if (!tep_db_num_rows($queryCategories) && !tep_db_num_rows($queryProducts)) {
        //delete it
        tep_db_query("DELETE FROM categories WHERE categories_id = " . $main_category);
        //update autoincrement
        tep_db_query("ALTER TABLE orders AUTO_INCREMENT = " . $main_category);
    }
} else {
    echo '<p class="error_xml_import_text">' . $result['message'] . '</p>';
}
?>