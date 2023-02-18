<?php
/*
  $Id: categories.php,v 1.7 21.05.2013 by solomono
*/

require('includes/application_top.php');

// include seo.class.php
include_once('../' . DIR_WS_CLASSES . 'seo.class.php');
if (!is_object($seo_urls)) {
    $seo_urls = new SEO_URL($languages_id);
}

//Added for Categories Description 1.5
require('includes/functions/categories_description.php');
//End Categories Description 1.5

//$tep_get_category_tree = tep_get_category_tree();

require(DIR_WS_CLASSES . 'currencies.php');
$currencies = new currencies();

global $current_category_id;
$page = $_GET['page'];
$action = (isset($_GET['action']) ? $_GET['action'] : '');
// Ultimate SEO URLs v2.1
// If the action will affect the cache entries
if (preg_match('/(insert|update|setflag)/i', $action)) {
    include_once('includes/reset_seo_cache.php');
}
$getSearch = isset($_GET['search']) && !empty($_GET['search']) ? tep_db_prepare_input($_GET['search']) : false;

if (tep_not_null($action)) {
    switch ($action) {
        case 'setflag':
            if (($_GET['flag'] == '0') || ($_GET['flag'] == '1')) {
                if (isset($_GET['pID'])) {
                    tep_set_product_status($_GET['pID'], $_GET['flag']);
                }
            }

            tep_redirect(tep_href_link(FILENAME_CATEGORIES, tep_get_all_get_params(array(
                    'cID',
                    'action'
                )) . 'pID=' . $_GET['pID']));
            break;

        case 'setflag_cat':
            if (($_GET['flag'] == '0') || ($_GET['flag'] == '1')) {
                if (isset($_GET['cID'])) {
                    tep_set_categories_status($_GET['cID'], $_GET['flag']);
                }
            }

            tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $_GET['cPath'] . '&cID=' . $_GET['cID']));
            break;

        case 'setxml':
            if (($_GET['flagxml'] == '0') || ($_GET['flagxml'] == '1')) {
                if (isset($_GET['pID'])) {
                    tep_set_product_xml($_GET['pID'], $_GET['flagxml']);
                }
            }

            tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $_GET['cPath'] . '&pID=' . $_GET['pID']));
            break;

        case 'setxml_cat':
            if (($_GET['flagxml'] == '0') || ($_GET['flagxml'] == '1')) {
                if (isset($_GET['cID'])) {
                    $cPaths = [];
                    $cPaths[$_GET['cID']] = [];
                    tep_get_cpath_global($cat_tree);
                    $currentCatTree = [];
                    foreach (explode('-', $cPaths[$_GET['cID']]) as $cID) {
                        $currentCatTree = isset($currentCatTree[$cID]) ? $currentCatTree[$cID] : $cat_tree[$cID];
                    }
                    if (is_int($currentCatTree)) {
                        $catList = [$currentCatTree];
                    } else {
                        $catList = nestedToSingle($currentCatTree);
                        $catList[] = (int)$_GET['cID'];
                    }
                    set_categories_xml($catList, $_GET['flagxml']);
                    //also enable/disable products
                    $catArrayWithCatIdAsKey = array_flip($catList);
                    $productsToXml = [];
                    foreach ($prodToCat as $k => $v) {
                        if (isset($catArrayWithCatIdAsKey[$v])) {
                            $productsToXml[] = $k;
                        }
                    }
                    if (!empty($productsToXml)) {
                        set_products_xml($productsToXml, $_GET['flagxml']);
                    }


                }
            }
            tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $_GET['cPath'] . '&cID=' . $_GET['cID']));
            break;

        case 'new_category':
        case 'edit_category':
            $_GET['action'] = $_GET['action'] . '_ACD';
            break;

        case 'insert_category':
        case 'update_category':
            if (isset($_POST['categories_id'])) {
                $categories_id = tep_db_prepare_input($_POST['categories_id']);
            } else {
                $categories_id = tep_db_prepare_input($_GET['cID']);
            }

            $sort_order = (int)$_POST['sort_order'];
            $id_sys_category = (int)$_POST['id_sys_category'];
            $vendor_template = tep_db_prepare_input($_POST['vendor_template']);
            if (!empty($id_sys_category)) {
                $is_id_sys_category_exist = tep_get_categories_id([
                    'id_sys_category' => $id_sys_category,
                    'vendor_template' => $vendor_template
                ]);
                if ($is_id_sys_category_exist > 0 and $is_id_sys_category_exist != $categories_id) {
                    tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $categories_id . '&action=edit_category&sys_category_exist=' . $id_sys_category . '&existing_cat=' . $is_id_sys_category_exist));
                    break;
                }
            }
            $categories_status = (int)$_POST['categories_status'];
            $categories_robots_status = (int)$_POST['categories_robots_status'];
            $display_products = $_POST['display_products'];

            $sql_data_array = array(
                'sort_order' => $sort_order,
                'id_sys_category' => $id_sys_category,
                'vendor_template' => $vendor_template,
                'categories_status' => $categories_status,
                'categories_robots_status' => $categories_robots_status,
                'display_products' => $display_products
            );

            if ($action == 'insert_category') {
                $last_sort_order = getLastSortOrder('categories');
                $insert_sql_data = array(
                    'parent_id' => $current_category_id,
                    'date_added' => 'now()',
                    'sort_order' => (int)$last_sort_order + 1
                );

                $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

                tep_db_perform(TABLE_CATEGORIES, $sql_data_array);

                $categories_id = tep_db_insert_id();
            } elseif ($action == 'update_category') {
                //    echo '<pre>',var_dump($sql_data_array),'</pre>';
                // die();
                $update_sql_data = array('last_modified' => 'now()');


                $sql_data_array = array_merge($sql_data_array, $update_sql_data);

                tep_db_perform(TABLE_CATEGORIES, $sql_data_array, 'update', "categories_id = '" . (int)$categories_id . "'");
            }

            $languages = tep_get_languages();
            for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {

                $language_id = $languages[$i]['id'];

                $sql_data_array = array(
                    'categories_name' => $_POST['categories_name'][$language_id],
                    'categories_heading_title' => $_POST['categories_heading_title'][$language_id],
                    'categories_description' => $_POST['categories_description'][$language_id],
                    'categories_meta_title' => $_POST['categories_meta_title'][$language_id],
                    'categories_meta_description' => $_POST['categories_meta_description'][$language_id],
                    'categories_meta_keywords' => $_POST['categories_meta_keywords'][$language_id],
                    'categories_seo_url' => !empty($_POST['categories_seo_url'][$language_id]) ? $seo_urls->strip($_POST['categories_seo_url'][$language_id]) : $seo_urls->strip($_POST['categories_name'][$language_id])
                );

                $check_query = tep_db_query("select * from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$categories_id . "' and language_id = " . (int)$language_id);
                if (!tep_db_num_rows($check_query)) {
                    $add_lang = true;
                } else {
                    $add_lang = false;
                }

                if ($action == 'insert_category' || $add_lang) {
                    $insert_sql_data = array(
                        'categories_id' => $categories_id,
                        'language_id' => $language_id
                    );

                    $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

                    tep_db_perform(TABLE_CATEGORIES_DESCRIPTION, $sql_data_array);
                } elseif ($action == 'update_category') {
                    tep_db_perform(TABLE_CATEGORIES_DESCRIPTION, $sql_data_array, 'update',
                        "categories_id = '" . (int)$categories_id . "' and language_id = '" . (int)$languages[$i]['id'] . "'");
                }
            }

            $categories_image = new upload('categories_image');
            $uploadDir = DIR_FS_CATALOG_IMAGES . 'categories/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $categories_image->set_destination($uploadDir);
            if ($categories_image->parse() && $categories_image->save($_POST['categories_image'], '300', '300', false)) {
                $categories_image_name = $categories_image->filename;
            } else {
                $categories_image_name = $_POST['categories_previous_image'];
            }


            if ($_POST['delete_categories_image'] == 'on') {
                // $update_sql_data = array_merge($update_sql_data, array('categories_image'=>''));
                $categories_image_name = '';
                if (file_exists(DIR_FS_CATALOG_IMAGES . 'categories/' . $_POST['categories_previous_image'])) {
                    unlink(DIR_FS_CATALOG_IMAGES . 'categories/' . $_POST['categories_previous_image']);
                }
            }


            $categories_icon = new upload('categories_icon');
            $uploadDir = DIR_FS_CATALOG_IMAGES . 'categories/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $categories_icon->set_destination($uploadDir);
            if ($categories_icon->parse() && $categories_icon->save($_POST['categories_icon'], '24', '24', false)) {
                $categories_icon_name = $categories_icon->filename;
            } else {
                $categories_icon_name = $_POST['categories_previous_icon'];
            }
            if ($_POST['delete_categories_icon'] == 'on') {
                // $update_sql_data = array_merge($update_sql_data, array('categories_image'=>''));
                $categories_icon_name = '';
                if (file_exists(DIR_FS_CATALOG_IMAGES . 'categories/' . $_POST['categories_previous_icon'])) {
                    unlink(DIR_FS_CATALOG_IMAGES . 'categories/' . $_POST['categories_previous_icon']);
                }

            }
            tep_db_query("update " . TABLE_CATEGORIES . " set categories_image = '" . $categories_image_name . "', categories_icon = '" . $categories_icon_name . "' where categories_id = '" . tep_db_input($categories_id) . "'");
            tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $categories_id));


            break;
        case 'delete_category_confirm':
            if (isset($_POST['categories_id'])) {
                $categories_id = tep_db_prepare_input($_POST['categories_id']);

                //   $categories=tep_get_category_tree($categories_id, '', '0', '', true);
                if (is_array($cat_list[$categories_id])) {
                    $categories = $cat_list[$categories_id] + array((int)$categories_id => (int)$categories_id);
                } else {
                    $categories = array((int)$categories_id => (int)$categories_id);
                }

                $products = array();
                $products_delete = array();
                /*
                for ($i=0, $n=sizeof($categories); $i < $n; $i++) {
                    $product_ids_query=tep_db_query("select products_id from " . TABLE_PRODUCTS_TO_CATEGORIES . " where categories_id = '" . (int)$categories[$i]['id'] . "'");

                    while ($product_ids=tep_db_fetch_array($product_ids_query)) {
                        $products[$product_ids['products_id']]['categories'][]=$categories[$i]['id'];
                    }
                }    */

                $product_ids_query = tep_db_query("select products_id, categories_id from " . TABLE_PRODUCTS_TO_CATEGORIES . " where categories_id in (" . implode(',',
                        $categories) . ") ");
                while ($product_ids = tep_db_fetch_array($product_ids_query)) {
                    $products[$product_ids['products_id']]['categories'][] = $product_ids['categories_id'];
                }
                reset($products);
                foreach ($products as $key => $value) {
//                while (list($key, $value)=each($products)) {
                    $category_ids = '';

                    for ($i = 0, $n = sizeof($value['categories']); $i < $n; $i++) {
                        if ((int)$value['categories'][$i]) {
                            $category_ids .= "'" . (int)$value['categories'][$i] . "', ";
                        }
                    }
                    $category_ids = substr($category_ids, 0, -2);

                    $check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$key . "' and categories_id not in (" . $category_ids . ")");
                    $check = tep_db_fetch_array($check_query);
                    if ($check['total'] < '1') {
                        $products_delete[$key] = $key;
                    }
                }

                tep_set_time_limit(0);
                foreach ($categories as $cat_del) {
                    tep_remove_category($cat_del);
                }
                /*
                for ($i=0, $n=sizeof($categories); $i < $n; $i++) {
                    tep_remove_category($categories[$i]['id']);
                }  */

                reset($products_delete);
                foreach ($products_delete as $key => $val) {
//                while (list($key)=each($products_delete)) {
                    tep_remove_product($key);
                }
            }

            tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath));
            break;
        case 'delete_product_confirm':
            if (isset($_POST['products_id']) && isset($_POST['product_categories']) && is_array($_POST['product_categories'])) {
                $product_id = tep_db_prepare_input($_POST['products_id']);
                $product_categories = $_POST['product_categories'];

                for ($i = 0, $n = sizeof($product_categories); $i < $n; $i++) {
                    tep_db_query("delete from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = " . (int)$product_id . " and categories_id = " . (int)$product_categories[$i]);
                }

                $product_categories_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$product_id . "'");
                $product_categories = tep_db_fetch_array($product_categories_query);

                if ($product_categories['total'] == '0') {
                    tep_remove_product($product_id);
                }
                //delete from products_xsell table
                tep_db_query("delete from " . TABLE_PRODUCTS_XSELL . " where products_id = " . (int)$product_id . " or xsell_id = " . (int)$product_id);
            }

            tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath));
            break;
        case 'move_category_confirm':
            if (isset($_POST['categories_id']) && ($_POST['categories_id'] != $_POST['move_to_category_id'])) {
                $categories_id = tep_db_prepare_input($_POST['categories_id']);
                $new_parent_id = tep_db_prepare_input($_POST['move_to_category_id']);

                $path = explode('_', tep_get_generated_category_path_ids($new_parent_id));

                if (in_array($categories_id, $path)) {
                    $messageStack->add_session(ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT, 'error');

                    tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $categories_id));
                } else {
                    tep_db_query("update " . TABLE_CATEGORIES . " set parent_id = '" . (int)$new_parent_id . "', last_modified = now() where categories_id = '" . (int)$categories_id . "'");

                    tep_redirect(tep_href_link(FILENAME_CATEGORIES,
                        'cPath=' . $new_parent_id . '&cID=' . $categories_id));
                }
            }

            break;
        case 'move_product_confirm':
            $products_id = tep_db_prepare_input($_POST['products_id']);
            $new_parent_id = tep_db_prepare_input($_POST['move_to_category_id']);

            $duplicate_check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$products_id . "' and categories_id = '" . (int)$new_parent_id . "'");
            $duplicate_check = tep_db_fetch_array($duplicate_check_query);
            if ($duplicate_check['total'] < 1) {
                tep_db_query("update " . TABLE_PRODUCTS_TO_CATEGORIES . " set categories_id = '" . (int)$new_parent_id . "' where products_id = '" . (int)$products_id . "' and categories_id = '" . (int)$current_category_id . "'");
            }

            tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $new_parent_id . '&pID=' . $products_id));
            break;

        case 'create_copy_product_attributes':

            $copy_attributes_delete_first = $_POST['copy_attributes_delete_first'];
            $copy_attributes_duplicates_skipped = $_POST['copy_attributes_duplicates_skipped'];
            $copy_attributes_duplicates_overwrite = $_POST['copy_attributes_duplicates_overwrite'];
            $copy_attributes_include_downloads = $_POST['copy_attributes_include_downloads'];

            tep_copy_products_attributes($_POST['products_id'], $_POST['copy_to_products_id']);
            tep_redirect(tep_href_link(FILENAME_CATEGORIES,
                'cPath=' . $_GET['cPath'] . '&pID=' . $_POST['products_id']));
            break;

        case 'create_copy_product_attributes_categories':
            // $products_id_to= $categories_products_copying['products_id'];
            // $products_id_from = $make_copy_from_products_id;
            $categories_products_copying_query = tep_db_query("select products_id from " . TABLE_PRODUCTS_TO_CATEGORIES . " where categories_id='" . $cID . "'");
            while ($categories_products_copying = tep_db_fetch_array($categories_products_copying_query)) {
                // process all products in category
                tep_copy_products_attributes($make_copy_from_products_id, $categories_products_copying['products_id']);
            }
            break;
        case 'copy_to_confirm':
            if (isset($_POST['products_id']) && isset($_POST['categories_id'])) {
                $products_id = tep_db_prepare_input($_POST['products_id']);
                $categories_id = tep_db_prepare_input($_POST['categories_id']);

                if ($_POST['copy_as'] == 'link') {
                    if ($categories_id != $current_category_id) {
                        $check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$products_id . "' and categories_id = '" . (int)$categories_id . "'");
                        $check = tep_db_fetch_array($check_query);
                        if ($check['total'] < '1') {
                            tep_db_query("insert into " . TABLE_PRODUCTS_TO_CATEGORIES . " (products_id, categories_id) values ('" . (int)$products_id . "', '" . (int)$categories_id . "')");
                        }
                    } else {
                        $messageStack->add_session(ERROR_CANNOT_LINK_TO_SAME_CATEGORY, 'error');
                    }
                } elseif ($_POST['copy_as'] == 'duplicate') {
                    $products_price_list = tep_xppp_getpricelist("");

                    $product_query = tep_db_query("select products_quantity, products_image, products_model, " . $products_price_list . ", products_date_available, products_weight, lable_1, lable_2, lable_3, products_tax_class_id, products_quantity_order_min, products_quantity_order_units, products_sort_order, manufacturers_id from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'");
                    $product = tep_db_fetch_array($product_query);

                    $prices_num = tep_xppp_getpricesnum();
                    for ($i = 2; $i <= $prices_num; $i++) {
                        if ($product['products_price_' . $i] == null) {
                            $products_instval .= "NULL, ";
                        } else {
                            $products_instval .= "'" . tep_db_input($product['products_price_' . $i]) . "', ";
                        }
                    }

                    $products_instval .= "'" . tep_db_input($product['products_price']) . "' ";

                    // переіменовуємо всі картинки в нові:
                    $new_images_str = tep_rename_images($product['products_image'], ';');
                    // END переіменовуємо всі картинки в нові

                    tep_db_query("insert into " . TABLE_PRODUCTS . " 
            (products_quantity, 
             products_image,
             products_model, 
             " . $products_price_list . ", 
             products_date_added, 
             products_date_available, 
             products_weight, 
             lable_1, 
             lable_2, 
             lable_3, 
             products_status, 
             products_tax_class_id, 
             products_quantity_order_min, 
             products_quantity_order_units, 
             products_sort_order, 
             manufacturers_id) 
           values 
             ('" . tep_db_input($product['products_quantity']) . "', 
             '" . $new_images_str . "', 
             '" . tep_db_input($product['products_model']) . "', 
             " . $products_instval . ",  
             now(), 
             " . (empty($product['products_date_available']) ? "null" : "'" . tep_db_input($product['products_date_available']) . "'") . ", 
             '" . tep_db_input($product['products_weight']) . "', 
             '" . tep_db_input($product['lable_1']) . "', 
             '" . tep_db_input($product['lable_2']) . "', 
             '" . tep_db_input($product['lable_3']) . "', 
             '0', 
             '" . (int)$product['products_tax_class_id'] . "', 
             '" . (int)$product['products_quantity_order_min'] . "', 
             '" . (int)$product['products_quantity_order_units'] . "', 
             '" . (int)$product['products_sort_order'] . "', 
             '" . (int)$product['manufacturers_id'] . "')");

                    $dup_products_id = tep_db_insert_id();

                    $description_query = tep_db_query("select language_id, products_name, products_info, products_description, products_head_title_tag, products_head_desc_tag, products_head_keywords_tag, products_url from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$products_id . "'");
                    while ($description = tep_db_fetch_array($description_query)) {
                        $description['products_url'] = '';
                        tep_db_query("insert into " . TABLE_PRODUCTS_DESCRIPTION . " (products_id, language_id, products_name, products_info, products_description, products_head_title_tag, products_head_desc_tag, products_head_keywords_tag, products_url, products_viewed) values ('" . (int)$dup_products_id . "', '" . (int)$description['language_id'] . "', '" . tep_db_input($description['products_name']) . "', '" . tep_db_input($description['products_info']) . "', '" . tep_db_input($description['products_description']) . "', '" . tep_db_input($description['products_head_title_tag']) . "', '" . tep_db_input($description['products_head_desc_tag']) . "', '" . tep_db_input($description['products_head_keywords_tag']) . "', '" . tep_db_input($description['products_url']) . "', '0')");
                    }

                    tep_db_query("insert into " . TABLE_PRODUCTS_TO_CATEGORIES . " (products_id, categories_id) values ('" . (int)$dup_products_id . "', '" . (int)$categories_id . "')");

                    $products_id_from = tep_db_input($products_id);
                    $products_id_to = $dup_products_id;
                    $products_id = $dup_products_id;

                    if ($_POST['copy_attributes'] == 'copy_attributes_yes' and $_POST['copy_as'] == 'duplicate') {

                        $copy_attributes_delete_first = '1';
                        $copy_attributes_duplicates_skipped = '1';
                        $copy_attributes_duplicates_overwrite = '0';

                        if (DOWNLOAD_ENABLED == 'true') {
                            $copy_attributes_include_downloads = '1';
                            $copy_attributes_include_filename = '1';
                        } else {
                            $copy_attributes_include_downloads = '0';
                            $copy_attributes_include_filename = '0';
                        }
                        tep_copy_products_attributes($products_id_from, $products_id_to);
                    }
                    //copy products_xsell
                    $productXsellQuery = tep_db_query("select xsell_id, sort_order, discount from " . TABLE_PRODUCTS_XSELL . " where products_id = " . $products_id_from);
                    if (tep_db_num_rows($productXsellQuery)) {
                        $sql = "insert into " . TABLE_PRODUCTS_XSELL . " (products_id, xsell_id, sort_order, discount) VALUES ";
                        while ($xsellProd = tep_db_fetch_array($productXsellQuery)) {
                            $sql .= "(" . (int)$dup_products_id . ", $xsellProd[xsell_id], $xsellProd[sort_order], '$xsellProd[discount]'),";
                        }

                        $sql = substr($sql, 0, -1) . ";";
                        tep_db_query($sql);
                    }

                    //Добавляем новый товар к тем, у которых копируемый был в сопутствующих
                    $productXsellQuery = tep_db_query("select products_id, sort_order, discount from " . TABLE_PRODUCTS_XSELL . " where xsell_id = " . $products_id_from);
                    if (tep_db_num_rows($productXsellQuery)) {
                        $sql = "insert into " . TABLE_PRODUCTS_XSELL . " (products_id, xsell_id, sort_order, discount) VALUES ";
                        while ($xsellProd = tep_db_fetch_array($productXsellQuery)) {
                            $sql .= "(" . $xsellProd['products_id'] . ", " . (int)$dup_products_id . ", $xsellProd[sort_order], '$xsellProd[discount]'),";
                        }

                        $sql = substr($sql, 0, -1) . ";";
                        tep_db_query($sql);
                    }
                }

            }

            tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $categories_id . '&pID=' . $products_id));
            break;
    }
}


// check if the catalog image directory exists
if (is_dir(DIR_FS_CATALOG_IMAGES)) {
    if (!is_writeable(DIR_FS_CATALOG_IMAGES)) {
        $messageStack->add(ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE, 'error');
    }
} else {
    $messageStack->add(ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST, 'error');
}

if (($_GET['cID']) && (!$_POST)) {
    $categories_query = tep_db_query("
        select c.categories_id, c.categories_status, c.id_sys_category, c.vendor_template, 
        c.categories_robots_status, c.sort_order, cd.categories_name, 
        cd.categories_heading_title, cd.categories_description,  cd.categories_meta_title, 
        cd.categories_meta_description, cd.categories_meta_keywords, cd.categories_seo_url, 
        c.categories_image, c.categories_icon, c.parent_id, c.sort_order, c.date_added, 
        c.last_modified, c.display_products 
        from " . TABLE_CATEGORIES . " c
        JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd on c.categories_id = cd.categories_id and cd.language_id = " . (int)$languages_id . "
        where c.categories_id = " . (int)$_GET['cID'] . "
        order by c.sort_order, cd.categories_name
    ");
    if(!$categories_query->num_rows){
        tep_redirect(tep_href_link(FILENAME_CATEGORIES, tep_get_all_get_params(array('cID','action'))));
        exit();
    }
    $category = tep_db_fetch_array($categories_query);
    $cInfo = new objectInfo($category);
}

/**
 * header
 */

include_once('html-open.php');
include_once('header.php');

?>

<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" href="includes/solomono/css/overwrite.css" type="text/css"/>

<style>
    small {
        color: #999;
    }

    .ui-widget-content {
        border: 0px solid #e7e7e7;
        background: #fff;
        color: #222222;
    }
</style>

<div id="spiffycalendar" class="text"></div>

<div class="container">
    <!-- body //-->
    <div class="table-responsive table_categories_wrapper">
        <table class="table_cat_page" border="0" width="100%" cellspacing="2" cellpadding="2">
            <tr>
                <td width="100%" valign="top">
                    <table border="0" width="100%" cellspacing="0" cellpadding="2">
                        <?php
                        if ($_GET['action'] == 'new_category_ACD' || $_GET['action'] == 'edit_category_ACD') {
                        if (!is_object($cInfo)) {
                            if (($_GET['cID']) && (!$_POST)) {
                                $categories_query = tep_db_query("
                                    select c.categories_id, c.categories_status, c.id_sys_category, c.vendor_template, 
                                    c.categories_robots_status, c.sort_order, cd.categories_name, 
                                    cd.categories_heading_title, cd.categories_description,  
                                    cd.categories_meta_title, cd.categories_meta_description, cd.categories_meta_keywords, 
                                    cd.categories_seo_url, c.categories_image, c.categories_icon, c.parent_id, 
                                    c.sort_order, c.date_added, c.last_modified, c.display_products 
                                    from " . TABLE_CATEGORIES . " c
                                    JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd on c.categories_id = cd.categories_id and cd.language_id = " . (int)$languages_id . "
                                    where c.categories_id = " . (int)$_GET['cID'] . "
                                    order by c.sort_order, cd.categories_name
                                ");
                                $category = tep_db_fetch_array($categories_query);
                                $cInfo = new objectInfo($category);
                            } elseif ($_POST) {
                                $cInfo = new objectInfo($_POST);
                                $categories_name = $_POST['categories_name'];
                                $categories_heading_title = $_POST['categories_heading_title'];
                                $categories_description = $_POST['categories_description'];
                                $categories_meta_title = $_POST['categories_meta_title'];
                                $categories_meta_description = $_POST['categories_meta_description'];
                                $categories_meta_keywords = $_POST['categories_meta_keywords'];
                                $categories_seo_url = $_POST['categories_seo_url'];
                            } else {
                                $cInfo = new objectInfo(array());
                            }
                        }

                            $languages = tep_get_languages();

                            $text_new_or_edit = ($_GET['action'] == 'new_category_ACD') ? TEXT_INFO_HEADING_NEW_CATEGORY : TEXT_INFO_HEADING_EDIT_CATEGORY;
                            ?>
                            <tr>
                                <td class="pageHeading"><?php echo sprintf($text_new_or_edit,
                                        tep_output_generated_category_path($current_category_id)); ?></td>
                            </tr>
                            <tr>
                                <?php

                                $form_action = ($_GET['cID']) ? 'update_category' : 'insert_category';
                                echo tep_draw_form($form_action, FILENAME_CATEGORIES,
                                    'cPath=' . $cPath . '&cID=' . $_GET['cID'] . '&action=' . $form_action, 'post',
                                    'enctype="multipart/form-data"');
                                ?>

                                <td>
                                    <div id="tabs" class="tabs-preload">
                                        <ul>
                                            <?php
                                            foreach ($languages as $key => &$language) {
                                                if ($language['id'] == $languages_id) {
                                                    $tmp = $languages[0];
                                                    $languages[0] = $language;
                                                    $languages[$key] = $tmp;
                                                    break;
                                                }
                                            }
                                            reset($languages);
                                            foreach ($languages as $language_value) { ?>
                                                <li>
                                                    <a href="#language-<?php echo $language_value['id']; ?>">
                                                        <img class="tab-flag-image"
                                                             src="<?= 'images/flags/' . $language_value['code'] . '.svg' ?>"
                                                             alt="lang image" height="18">
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                        <?php foreach ($languages as $language_key => $language_value) { ?>
                                            <div id="language-<?php echo $language_value['id']; ?>">
                                                <table border="0" cellspacing="0" cellpadding="2">
                                                    <tr>
                                                        <td class="main">
                                                            <?php echo TEXT_EDIT_CATEGORIES_NAME; ?></td>
                                                        <td class="main"><?php echo '&nbsp;' . tep_lol('categories_name[' . $language_value['id'] . ']',
                                                                    (($categories_name[$language_value['id']]) ? stripslashes($categories_name[$language_value['id']]) : tep_get_category_name($cInfo->categories_id,
                                                                        $language_value['id']))); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="main">
                                                            <?php echo TEXT_EDIT_CATEGORIES_HEADING_TITLE; ?></td>
                                                        <td class="main"><?php echo '&nbsp;' . tep_lol('categories_heading_title[' . $language_value['id'] . ']',
                                                                    (($categories_name[$language_value['id']]) ? stripslashes($categories_name[$language_value['id']]) : tep_get_category_heading_title($cInfo->categories_id,
                                                                        $language_value['id']))); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="main">
                                                            <?php echo TEXT_COPY_LINK; ?></td>
                                                        <td class="main">
                                                            <?php
                                                            echo '&nbsp;' . tep_lol('categories_seo_url[' . $language_value['id'] . ']',
                                                                    (isset($categories_seo_url[$language_value['id']]) ? stripslashes($categories_seo_url[$language_value['id']]) : tep_get_category_url($cInfo->categories_id,
                                                                        $language_value['id'])));
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="main"
                                                            valign="top">
                                                            <?php echo TEXT_EDIT_CATEGORIES_DESCRIPTION; ?></td>
                                                        <td>
                                                            <table border="0" cellspacing="0" cellpadding="0"
                                                                   width="100%">
                                                                <tr>
                                                                    <td class="main">
                                                                        <div class="ckeditor_outer">
                                                                            <?php
                                                                            echo tep_draw_textarea_field('categories_description[' . $language_value['id'] . ']',
                                                                                'soft', '80', '20',
                                                                                (($categories_description[$language_value['id']]) ? stripcslashes($categories_description[$language_value['id']]) : tep_get_category_description($cInfo->categories_id,
                                                                                    $language_value['id'])));
                                                                            echo '<div class="ck_replacer">' . (($categories_description[$language_value['id']]) ? stripcslashes($categories_description[$language_value['id']]) : str_replace('form',
                                                                                        'div',
                                                                                        tep_get_category_description($cInfo->categories_id,
                                                                                            $language_value['id'])) . '</div>');
                                                                            ?>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="main">
                                                            <?php echo TEXT_META_TITLE; ?></td>
                                                        <td class="main"><?php echo '&nbsp;' . tep_lol('categories_meta_title[' . $language_value['id'] . ']',
                                                                    (($categories_meta_title[$language_value['id']]) ? stripslashes($categories_meta_title[$language_value['id']]) : tep_get_category_meta_title($cInfo->categories_id,
                                                                        $language_value['id']))); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="main">
                                                            <?php echo TEXT_META_DESCRIPTION; ?></td>
                                                        <td class="main"><?php echo '&nbsp;' . tep_lol('categories_meta_description[' . $language_value['id'] . ']',
                                                                    (($categories_meta_description[$language_value['id']]) ? stripslashes($categories_meta_description[$language_value['id']]) : tep_get_category_meta_description($cInfo->categories_id,
                                                                        $language_value['id']))); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="main">
                                                            <?php echo TEXT_META_KEYWORDS; ?></td>
                                                        <td class="main"><?php echo '&nbsp;' . tep_lol('categories_meta_keywords[' . $language_value['id'] . ']',
                                                                    (($categories_meta_keywords[$language_value['id']]) ? stripslashes($categories_meta_keywords[$language_value['id']]) : tep_get_category_meta_keywords($cInfo->categories_id,
                                                                        $language_value['id']))); ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                                    <table border="0" cellspacing="0" cellpadding="0" width="100%"
                                           class="categories_file_wrap">
                                        <tr>
                                        <tr>
                                            <td class="main"><?php echo TEXT_EDIT_CATEGORIES_IMAGE; ?></td>
                                            <td class="main categories_file_image"><?php echo tep_draw_separator('pixel_trans.png',
                                                        '24',
                                                        '15') . '&nbsp;' . tep_draw_file_field('categories_image') . '<br>' . tep_draw_separator('pixel_trans.png',
                                                        '24',
                                                        '15') . '&nbsp;' . $cInfo->categories_image . tep_draw_hidden_field('categories_previous_image',
                                                        $cInfo->categories_image); ?></td>
                                        </tr>
                                        <?php if ($cInfo->categories_image): ?>
                                            <tr>
                                                <td class="main"></td>
                                                <td class="main"><?php echo tep_draw_separator('pixel_trans.png', '24',
                                                            '15') . '&nbsp;'; ?>
                                                    <img src="/r_imgs.php?thumb=categories/<?php echo $cInfo->categories_image; ?>"
                                                         class="category-bg_image" alt="">
                                                    <br><?php echo tep_draw_separator('pixel_trans.png', '24',
                                                            '15') . '&nbsp;'; ?><?php echo TEXT_CAT_DELPHOTO; ?>
                                                    <input type="checkbox" name="delete_categories_image"></td>
                                            </tr>
                                        <?php endif; ?>
                                        <tr>
                                            <td class="main"><?php echo TEXT_EDIT_CATEGORIES_ICON; ?></td>
                                            <td class="main categories_file_image"><?php echo tep_draw_separator('pixel_trans.png',
                                                        '24',
                                                        '15') . '&nbsp;' . tep_draw_file_field('categories_icon') . '<br>' . tep_draw_separator('pixel_trans.png',
                                                        '24',
                                                        '15') . '&nbsp;' . $cInfo->categories_icon . tep_draw_hidden_field('categories_previous_icon',
                                                        $cInfo->categories_icon); ?></td>
                                        </tr>
                                        <?php if ($cInfo->categories_icon): ?>
                                            <tr>
                                                <td class="main"></td>
                                                <td class="main"><?php echo tep_draw_separator('pixel_trans.png', '24',
                                                            '15') . '&nbsp;'; ?>
                                                    <img src="/r_imgs.php?thumb=categories/<?php echo $cInfo->categories_icon; ?>"
                                                         alt="">
                                                    <br><?php echo tep_draw_separator('pixel_trans.png', '24',
                                                            '15') . '&nbsp;'; ?><?php echo TEXT_CAT_DELPHOTO; ?>
                                                    <input type="checkbox" name="delete_categories_icon"></td>
                                            </tr>
                                        <?php endif; ?>
                                        <tr>
                                            <td class="main"><?php echo TEXT_EDIT_SORT_ORDER; ?></td>
                                            <td class="main">
                                                <?php echo tep_draw_separator('pixel_trans.png', '24', '15') . '&nbsp;' .
                                                    tep_draw_input_field('sort_order', $cInfo->sort_order, 'size="1" class="category_sort_order"', false, 'number');
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="main"><?php echo TEXT_EDIT_STATUS; ?></td>
                                            <?php $status = !empty($cInfo->categories_status) ? $cInfo->categories_status : 1; ?>
                                            <td class="main"><?php echo tep_draw_separator('pixel_trans.png', '24',
                                                        '15') . '&nbsp;' .
                                                    tep_draw_checkbox_field('categories_status', 1,
                                                        ($status == 1) ? true : false, '',
                                                        'title="' . TEXT_DEFINE_CATEGORY_STATUS . '"'); ?>
                                                &nbsp;<?php //echo TEXT_DEFINE_CATEGORY_STATUS; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="main"><?php echo TEXT_EDIT_ROBOTS_STATUS; ?></td>
                                            <?php $status = !empty($cInfo->categories_robots_status) ? $cInfo->categories_robots_status : 1; ?>
                                            <td class="main"><?php echo tep_draw_separator('pixel_trans.png', '24',
                                                        '15') . '&nbsp;' .
                                                    tep_draw_checkbox_field('categories_robots_status', 1,
                                                        ($status == 1) ? true : false, '',
                                                        'title="' . TEXT_DEFINE_CATEGORY_ROBOTS_STATUS . '"'); ?>
                                                &nbsp;<?php //echo TEXT_DEFINE_CATEGORY_ROBOTS_STATUS; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="main"><?php echo TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS; ?></td>
                                            <td class="main">
                                                <?php
                                                $display_products = [
                                                    'all' => TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_ALL,
                                                    'nothing' => TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_NOTHING,
                                                    'products_ordered' => TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_TOP,
                                                    'featured' => TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_RECOMMENDED,
                                                    'new' => TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_NEW,
                                                ];
                                                echo tep_draw_separator('pixel_trans.png', '24', '15'); ?>
                                                <select name="display_products">
                                                    <?php
                                                    foreach ($display_products as $dpKey => $dpValue) {
                                                        $selected = '';
                                                        if (empty($cInfo->display_products) && $dpKey === 'all') {
                                                            $selected = 'selected';
                                                        } elseif (isset($cInfo->display_products) && $cInfo->display_products === $dpKey) {
                                                            $selected = 'selected';
                                                        }

                                                        echo '<option value="' . $dpKey . '" ' . $selected . '>', $dpValue, '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="main"><?php echo TEXT_ID_XML_CATEGORY; ?></td>
                                            <td class="main">
                                                <?php
                                                echo tep_draw_separator('pixel_trans.png', '24', '15') . '&nbsp;' .
                                                tep_draw_input_field('id_sys_category', $cInfo->id_sys_category, 'size="10"');
                                                if (isset($_GET['sys_category_exist'])) {
                                                    echo '<span class="errorText">' . sprintf(ERROR_SYS_CATEGORY_EXIST, $_GET['sys_category_exist'], $_GET['existing_cat']) . '</span>';
                                                } ?>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="main"><?php echo TEXT_VENDOR_XML_CATEGORY; ?></td>
                                            <td class="main">
                                                <img src="images/pixel_trans.png" border="0" alt="" width="24" height="15">
                                                <?php $all_vendor_templates = tep_get_all_vendor_templates(); ?>
                                                <select name="vendor_template">
                                                    <?php
                                                    foreach ($all_vendor_templates as $dpKey => $dpText) {
                                                        $selected = '';
                                                        if (empty($cInfo->vendor_template) && $dpKey === 'ukrservice') {
                                                            $selected = 'selected';
                                                        } elseif (isset($cInfo->vendor_template) && $cInfo->vendor_template === $dpKey) {
                                                            $selected = 'selected';
                                                        }

                                                        echo '<option value="' . $dpKey . '" ' . $selected . '>' . $dpText . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="main table_categories_button" align="right">
                                    <?php
                                    if ($_GET['cID']) {
                                        echo tep_image_submit('button_update.gif', IMAGE_UPDATE);
                                    } else {
                                        echo tep_image_submit('button_insert.gif', IMAGE_INSERT);
                                    }

                                    echo tep_draw_hidden_field('categories_date_added',
                                            (($cInfo->date_added) ? $cInfo->date_added : date('Y-m-d'))) . tep_draw_hidden_field('parent_id',
                                            $cInfo->parent_id) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORIES,
                                            'cPath=' . $cPath . '&cID=' . $_GET['cID']) . '">' . tep_text_button(BUTTON_CANCEL_NEW) . '</a>';
                                    ?>
                                </td>
                                </form></tr>
                            <?php

                        } else {
                            ?>
                            <table border="0" width="100%" cellspacing="0" cellpadding="2" class="categories_mob">
                                <tr>
                                    <td>
                                        <table border="0" width="100%" cellspacing="0" cellpadding="0"
                                               class="categories_mob_table">
                                            <tr class="categories_mob_header">
                                                <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
                                            </tr>
                                            <tr class="tr_categories_mob">
                                                <td class="categories_mob_form"
                                                    style="text-align:left;padding: 10px 10px 10px 20px;background: #fff;border-bottom: 1px solid #e1e1e1; ">
                                                    <table border="0" width="100%" height="19" cellspacing="0"
                                                           cellpadding="0">
                                                        <tr>
                                                            <td class="smallText" align="left"
                                                                style="display: flex;justify-content: space-between;flex-wrap: wrap; align-items: center;">
                                                                <div class="filter_form_decktop" style="float:left;">
                                                                    <form id="filter_form" method="get" action=""
                                                                          style="display: inline-flex;align-items: center;">
                                                                        <?php foreach ($_GET as $k => $v): ?>
                                                                            <?php if ($v == 'on') {
                                                                                continue;
                                                                            } ?>
                                                                            <input type="hidden" name="<?php echo $k ?>"
                                                                                   value="<?php echo $v ?>"/>
                                                                        <?php endforeach; ?>
                                                                        <div class="filter_form_span_wrapper">
                                                                            <label class="filter_form_span"><input
                                                                                        type="checkbox" <?php echo $_GET['specials'] ? 'checked' : ''; ?>
                                                                                        name="specials"><span><?php echo TEXT_FILTER_SPECIALS ?></span></label>
                                                                            <label class="filter_form_span"><input
                                                                                        type="checkbox" <?php echo $_GET['concomitant'] ? 'checked' : ''; ?>
                                                                                        name="concomitant"><span><?php echo TEXT_FILTER_CONCOMITANT ?></span></label>
                                                                            <label class="filter_form_span"><input
                                                                                        type="checkbox" <?php echo $_GET['top'] ? 'checked' : ''; ?>
                                                                                        name="top"><span><?php echo TEXT_FILTER_TOP ?></span></label>
                                                                            <label class="filter_form_span"><input
                                                                                        type="checkbox" <?php echo $_GET['new'] ? 'checked' : ''; ?>
                                                                                        name="new"><span><?php echo TEXT_FILTER_NEW ?></span></label>
                                                                            <label class="filter_form_span"><input
                                                                                        type="checkbox" <?php echo $_GET['stock'] ? 'checked' : ''; ?>
                                                                                        name="stock"><span><?php echo TEXT_FILTER_STOCK ?></span></label>
                                                                            <label class="filter_form_span"><input
                                                                                        type="checkbox" <?php echo $_GET['recommend'] ? 'checked' : ''; ?>
                                                                                        name="recommend"><span><?php echo TEXT_FILTER_RECOMMEND ?></span></label>
                                                                        </div>
                                                                        <input type="submit" value="Ok">
                                                                    </form>
                                                                </div>
                                                                <div class="smallText smallText_but" style="padding: 10px 0 0">
                                                                    <?php
                                                                            if (!$getSearch) {
                                                                                echo '<a class="new_cat_btn" href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                                        'cPath=' . $cPath . '&action=new_category') . '">' . tep_text_button(BUTTON_NEW_CATEGORY_NEW) . '</a>&nbsp;&nbsp;';
                                                                            }
                                                                            echo '<a class="new_product_btn" href="' . tep_href_link(FILENAME_PRODUCTS,
                                                                                    'cPath=' . $cPath . '&action=new_product') . '">' . tep_text_button(BUTTON_NEW_PRODUCT_NEW) . '</a>'; ?>
                                                                </div>
                                                                <div class="fields-wtap">
                                                                    <div class="transition_unit">
                                                                        <?php echo tep_draw_pull_down_categories('cat_tree_links', $tep_get_category_tree, $current_category_id, FILENAME_CATEGORIES) ?>
                                                                    </div>
                                                                    <div class="product_search">
                                                                        <?php
                                                                        echo tep_draw_form('search', FILENAME_CATEGORIES, '', 'get', 'class="cat_top_form cat_top_form_mob2"');
                                                                        //                                                                echo '<div style="float:left;">' . HEADING_TITLE_SEARCH . ' ' . tep_draw_input_field('search', $_GET['search']) . '</div>';
                                                                        echo tep_draw_hidden_field('cPath', $_GET['cPath']);
                                                                        echo '<div class="form_mob">' . tep_draw_input_field('search', $getSearch, 'placeholder="'.TEXT_GO_TO_SEARCH.'"') . tep_image_submit('button_search.gif', IMAGE_SEARCH) . '</div>';
                                                                        echo '</form>';
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>

                                    <td>
                                        <table border="0" height="100%" width="100%" cellspacing="0" cellpadding="0">
                                            <tr height="100%" class="wrapper_width_cats">
                                                <td valign="top" class="td_with_cats header-menu-wood">
                                                    <?php
                                                    echo tep_draw_form('goto', FILENAME_CATEGORIES, '', 'get');
                                                    echo tep_draw_pull_down_menu_new('cPath', $tep_get_category_tree,
                                                        $current_category_id,
                                                        'id="left_cats" onChange="this.form.submit();"');
                                                    echo '</form>';
                                                    ?>
                                                </td>
                                                <?php
                                                $categories_count = 0;
                                                $rows = 0;
                                                if ($getSearch) {
                                                    $search = $getSearch;
                                                    $sql = "select c.categories_id, cd.categories_name, cd.categories_meta_title, cd.categories_meta_description, cd.categories_meta_keywords, c.categories_image, c.parent_id, c.sort_order, c.date_added, c.last_modified, c.categories_status, c.categories_to_xml from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' and cd.categories_name like '%" . tep_db_input($search) . "%' ";
                                                    if (isset($_GET['cPath']) && !empty($_GET['cPath'])) {
                                                        $sql .= "and c.parent_id = '" . tep_db_prepare_input($_GET['cPath']) . "' ";
                                                    }
                                                    $sql .= "order by c.sort_order, cd.categories_name ";
                                                    $categories_query = tep_db_query($sql);
                                                } else {
                                                    $categories_query = tep_db_query("select c.categories_id, cd.categories_name, cd.categories_meta_title, cd.categories_meta_description, cd.categories_meta_keywords, c.categories_image, c.parent_id, c.sort_order, c.date_added, c.last_modified, c.categories_status, c.categories_to_xml from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$current_category_id . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' order by c.sort_order, cd.categories_name");
                                                }

                                                $showCategoriesFlag = isset($_GET['concomitant']) ? false : true;
                                                if ($showCategoriesFlag) {
                                                    while ($categories = tep_db_fetch_array($categories_query)) {
                                                        $categories_count++;
                                                        $rows++;
                                                        if ($getSearch) {
                                                            $cPath = $categories['parent_id'];
                                                        }
                                                        if ((!isset($_GET['cID']) && !isset($_GET['pID']) || (isset($_GET['cID']) && ($_GET['cID'] == $categories['categories_id']))) && !isset($cInfo) && (substr($action,
                                                                    0, 3) != 'new')) {
                                                            $category_childs = ['childs_count' => tep_childs_in_category_count($categories['categories_id'])];
                                                            $category_products = ['products_count' => tep_products_in_category_count($categories['categories_id'])];
                                                            $cInfo_array = array_merge($categories, $category_childs, $category_products);
                                                            $cInfo = new objectInfo($cInfo_array);
                                                        }
                                                        if (isset($cInfo) && is_object($cInfo) && ($categories['categories_id'] == $cInfo->categories_id)) {
                                                            $r_selected = '1';
                                                        } else {
                                                            $r_selected = '0';
                                                        }
                                                        ?>
                                                        <!--                                                        <td></td>-->
                                                        <?php
                                                    }
                                                }

                                                ?>
                                                <td valign="top" class="td_block_cats">
                                                    <table class="td_block_cats_table" border="0" width="100%"
                                                           cellspacing="0" cellpadding="2">
                                                        <tr class="dataTableHeadingRow">
                                                            <td class="dataTableHeadingContent" align="center"
                                                                width="35">#
                                                            </td>
                                                            <td class="dataTableHeadingContent" align="center"
                                                                width="40"><?php echo TABLE_HEADING_STATUS; ?></td>
                                                            <td class="dataTableHeadingContent" align="center"
                                                                style="padding: 8px 5px;"><?php echo TEXT_CAT_IMAGE; ?></td>
                                                            <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CATEGORIES_PRODUCTS; ?></td>
                                                            <td class="dataTableHeadingContent" align="center"
                                                                width="100" style="border-right: 1px solid #e1e1e1;"><?php echo TEXT_CAT_ACTION; ?></td>
                                                        </tr>
                                                        <?php
                                                        $heading = array();
                                                        $contents = array();
                                                        switch ($action) {
                                                            case 'delete_category':
                                                                $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_CATEGORY . '</b>');

                                                                $contents = array(
                                                                    'form' => tep_draw_form('categories', FILENAME_CATEGORIES,
                                                                            'action=delete_category_confirm&cPath=' . $cPath) . tep_draw_hidden_field('categories_id',
                                                                            ($cInfo->categories_id ?: $_GET['cID']))
                                                                );

                                                                $contents[] = array('text' => TEXT_DELETE_CATEGORY_INTRO);

                                                                $contents[] = array('text' => '<br><b>' . $cInfo->categories_name . '</b>');
                                                                if ($cInfo->childs_count > 0) {
                                                                    $contents[] = array(
                                                                        'text' => '<br>' . sprintf(TEXT_DELETE_WARNING_CHILDS,
                                                                                $cInfo->childs_count)
                                                                    );
                                                                }
                                                                if ($cInfo->products_count > 0) {
                                                                    $contents[] = array(
                                                                        'text' => '<br>' . sprintf(TEXT_DELETE_WARNING_PRODUCTS,
                                                                                $cInfo->products_count)
                                                                    );
                                                                }
                                                                $contents[] = array(
                                                                    'align' => 'center',
                                                                    'text' => '<br>' . tep_image_submit('button_delete.gif',
                                                                            IMAGE_DELETE) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                            'cPath=' . $cPath . '&cID=' . $cInfo->categories_id) . '">' . tep_text_button(BUTTON_CANCEL_NEW) . '</a>'
                                                                );
                                                                break;
                                                            case 'move_category':
                                                                $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_MOVE_CATEGORY . '</b>');

                                                                $contents = array(
                                                                    'form' => tep_draw_form('categories', FILENAME_CATEGORIES,
                                                                            'action=move_category_confirm&cPath=' . $cPath) . tep_draw_hidden_field('categories_id', $cInfo->categories_id)
                                                                );
                                                                $contents[] = array(
                                                                    'text' => sprintf(TEXT_MOVE_CATEGORIES_INTRO,
                                                                        $cInfo->categories_name)
                                                                );
                                                                $contents[] = array(
                                                                    'text' => '<br>' . sprintf(TEXT_MOVE, $cInfo->categories_name)
                                                                        . '<br>' . tep_draw_pull_down_categories('move_to_category_id', $tep_get_category_tree, $current_category_id)
                                                                );

                                                                $contents[] = array(
                                                                    'align' => 'center',
                                                                    'text' => '<br>' . tep_image_submit('button_move.gif', IMAGE_MOVE)
                                                                        . ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $cInfo->categories_id) . '">'
                                                                        . tep_text_button(BUTTON_CANCEL_NEW) . '</a>'
                                                                );
                                                                break;
                                                        }

                                                        if ((tep_not_null($heading)) && (tep_not_null($contents))) {
                                                            echo '            <tr>' . "\n";
                                                            echo '                    <td colspan="5"><div style="padding-left:10px;">';

                                                            $box = new box;
                                                            echo $box->infoBox($heading, $contents);

                                                            echo '            </div></td></tr>' . "\n";
                                                        }
                                                        ?>
                                                        <?php
                                                        $products_count = 0;
                                                        if (!isset($page)) {
                                                            $page = 0;
                                                        };

                                                        $max_prod_admin_side_q = tep_db_query("select configuration_value FROM configuration WHERE configuration_key='MAX_PROD_ADMIN_SIDE'");
                                                        $max_prod_admin_side = (tep_db_fetch_array($max_prod_admin_side_q));
                                                        #
                                                        $max_count = $max_prod_admin_side['configuration_value'];
                                                        #

                                                        //new from 03.10.17
                                                        $join_query = '';
                                                        $conditional_query = '';
                                                        if (isset($_GET['specials'])) {
                                                            $join_query .= " RIGHT JOIN `specials` `s` ON `s`.`products_id` = `p`.`products_id`";
                                                        }

                                                        if (isset($_GET['recommend'])) {
                                                            $join_query .= " RIGHT JOIN `featured` `f` ON `f`.`products_id` = `p`.`products_id`";
                                                        }
                                                        if (isset($_GET['top'])) {
                                                            $conditional_query .= " AND `p`.`lable_1` = 1";
                                                        }
                                                        if (isset($_GET['new'])) {
                                                            $conditional_query .= " AND `p`.`lable_2` = 1";
                                                        }
                                                        if (isset($_GET['stock'])) {
                                                            $conditional_query .= " AND `p`.`lable_3` = 1";
                                                        }

                                                        $search_query_string = "";
                                                        if (empty($_GET['search'])) {
                                                            $search_category_query_string = " and p2c.categories_id = '" . (int)$current_category_id . "' ";
                                                        }

                                                        if ($getSearch) {
                                                            $search_query_string .= " and (p.products_model like '%" . tep_db_input($search) . "%' or pd.products_name like '%" . tep_db_input($search) . "%') ";
                                                        }
                                                        //if (isset($_GET['concomitant']) && !empty($_GET['cPath'])) {
                                                        if (empty($_GET['cPath'])) {
                                                            $_GET['cPath'] = 0;
                                                        }
                                                        $subCategoriesIds = getSubCategoriesIds($cat_tree,$_GET['cPath']);
                                                        $search_category_query_string = '';
                                                        if(!empty($subCategoriesIds)){
                                                            $search_category_query_string = " and p2c.categories_id in (" . implode(',', $subCategoriesIds) . ") ";
                                                        }
                                                        //}
                                                        $search_query_string .= $search_category_query_string;
//                                                    elseif ($conditional_query!='' || $join_query!='') {
                                                        //                                                        $search_query_string='';
                                                        //                                                    }
                                                        //else {
                                                        //    $search_query_string=" and p2c.categories_id = '" . (int)$current_category_id . "' ";
                                                        //}

                                                        //$products_query_line="select p.products_image, p.products_id, pd.products_name, p.products_quantity, p.products_price, p.products_date_added, p.products_last_modified, p.products_date_available, p.products_status, p.products_to_xml, p.products_sort_order, p.products_model, p2c.categories_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = p2c.products_id " . $search_query_string . " order by pd.products_name, p.products_id";
                                                        $products_query_line = "SELECT
                                                                              `p`.`products_image`,
                                                                              `p`.`products_id`,
                                                                              `pd`.`products_name`,
                                                                              `p`.`products_quantity`,
                                                                              `p`.`products_price`,
                                                                              `p`.`products_date_added`,
                                                                              `p`.`products_last_modified`,
                                                                              `p`.`products_date_available`,
                                                                              `p`.`products_status`,
                                                                              `p`.`products_to_xml`,
                                                                              `p`.`edited_for_seo`,
                                                                              `p`.`products_sort_order`,
                                                                              `p`.`products_model`,
                                                                              `p2c`.`categories_id`,
                                                                              `cd`.categories_name
                                                                            FROM `products` `p`
                                                                              LEFT JOIN `products_description` `pd` ON `pd`.`products_id` = `p`.`products_id`
                                                                              LEFT JOIN `products_to_categories` `p2c` ON `p2c`.`products_id` = `p`.`products_id`
                                                                              LEFT JOIN `categories_description` `cd` ON `cd`.`categories_id` = `p2c`.`categories_id` AND `cd`.`language_id`=" . (int)$languages_id . "
                                                                              {$join_query}
                                                                            WHERE `pd`.`language_id` = '{$languages_id}' {$conditional_query}{$search_query_string}
                                                                            ORDER BY `pd`.`products_name`, `p`.`products_id`";

                                                        $products_query = tep_db_query($products_query_line);
                                                        $numr = tep_db_num_rows($products_query);

                                                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                                        $products_query_line .= " limit " . (($page - 1) * $max_count) . "," . $max_count;
                                                        $products_query = tep_db_query($products_query_line);
                                                        if ($numr > $max_count) {
                                                            if (is_file($pathPagination = DIR_WS_CLASSES . 'categories_paginator/Paginator.php')) {
                                                                include_once $pathPagination;

                                                                $herf = 'categories.php?cPath=' . $cPath . ($getSearch ? '&search=' . $getSearch : '') . '&page=';
                                                                $paginator = new  Paginator($numr, $page, $max_count,
                                                                    $herf);
                                                            }
                                                        }


                                                        while ($products = tep_db_fetch_array($products_query)) {
                                                            $products_count++;
                                                            $rows++;

                                                            // Get categories_id for product if search
                                                            if ($getSearch) {
                                                                $cPath = $products['categories_id'];
                                                            }

                                                            if ((!isset($_GET['pID']) && !isset($_GET['cID']) || (isset($_GET['pID']) && ($_GET['pID'] == $products['products_id']))) && !isset($pInfo) && !isset($cInfo) && (substr($action,
                                                                        0, 3) != 'new')) {
                                                                $pInfo = new objectInfo($products);
                                                            }

                                                            if (isset($pInfo) && is_object($pInfo) && ($products['products_id'] == $pInfo->products_id)) {
                                                                $r_selected = '1';
                                                            } else {
                                                                $r_selected = '0';
                                                            }

                                                            echo '              <tr class="dataTableRow ' . ($_GET['pID'] == $products['products_id'] ? 'dataTableRowOver' : '') . '" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_PRODUCTS,
                                                                    tep_get_all_get_params(array(
                                                                        'cID',
                                                                        'action'
                                                                    )) . 'pID=' . $products['products_id'] . '&action=new_product') . '\'">' . "\n";

                                                            ?>
                                                            <td class="dataTableContent nobg bg_left" align="center">
                                                                <?php echo $products['products_sort_order']; ?>
                                                            </td>
                                                            
                                                            <td class="dataTableContent" align="center">
                                                                <?php
                                                                if ($products['products_status'] == '1') {
                                                                    echo '<a href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                            tep_get_all_get_params(array(
                                                                                'cID',
                                                                                'action'
                                                                            )) . 'action=setflag&flag=0&pID=' . $products['products_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green.gif',
                                                                            IMAGE_ICON_STATUS_RED_LIGHT, 16,
                                                                            16) . '</a>';
                                                                } else {
                                                                    echo '<a href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                            tep_get_all_get_params(array(
                                                                                'cID',
                                                                                'action'
                                                                            )) . 'action=setflag&flag=1&pID=' . $products['products_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_red.gif',
                                                                            IMAGE_ICON_STATUS_GREEN_LIGHT, 16,
                                                                            16) . '</a>';
                                                                }
                                                                ?>

                                                                <?php if (showXmlStatusSettings()) {
                                                                    if ($products['products_to_xml'] == '1') {
                                                                        echo '<a href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                                tep_get_all_get_params(array(
                                                                                    'cID',
                                                                                    'action'
                                                                                )) . 'action=setxml&flagxml=0&pID=' . $products['products_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green.gif',
                                                                                IMAGE_ICON_STATUS_RED_LIGHT, 10,
                                                                                10) . '</a>';
                                                                    } else {
                                                                        echo '<a href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                                tep_get_all_get_params(array(
                                                                                    'cID',
                                                                                    'action'
                                                                                )) . 'action=setxml&flagxml=1&pID=' . $products['products_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green_light.gif',
                                                                                IMAGE_ICON_STATUS_GREEN_LIGHT, 10,
                                                                                10) . '</a>';
                                                                    }
                                                                } ?>
                                                            </td>
                                                            <td class="nobg"
                                                                style="width:70px;text-align:center;padding: 10px 5px;">
                                                                <?php
                                                                $prod_img = explode(';', $products['products_image']);
                                                                if (!empty($prod_img[0])) {
                                                                    echo tep_info_image($prod_img[0], '', '64', '64',
                                                                        true);
                                                                } else {
                                                                    echo tep_info_image('default.png', '', '64', '64');
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="dataTableContent"
                                                                style="padding-left:10px;"><?php

                                                                echo '<span style="font-size:12px;font-weight:bold;">' . stripslashes($products['products_name']) . '</span>';
                                                                if ($getSearch) {
                                                                    echo '<br /><span style="font-size:12px;font-weight:bold;opacity: 0.5;">' . $products['categories_name'] . '</span>';
                                                                }
                                                                echo '<br /><br />#' . $products['products_id'] . '';
                                                                if ($products['products_model']) {
                                                                    echo '&nbsp;&nbsp;&nbsp;&nbsp;' . TEXT_CAT_MODEL . ': ' . $products['products_model'] . '';
                                                                }
                                                                echo '&nbsp;&nbsp;&nbsp;&nbsp;' . TEXT_CAT_QTY . ': <b>' . $products['products_quantity'] . '</b>';
                                                                if ($new_price = tep_get_products_special_price($products['products_id'])) {
                                                                    echo '&nbsp;&nbsp;&nbsp;&nbsp;' . TEXT_CAT_PRICE . ': <b>' . $currencies->format($new_price) . ' (' . $currencies->format($products['products_price']) . ')</b>';
                                                                } else {
                                                                    echo '&nbsp;&nbsp;&nbsp;&nbsp;' . TEXT_CAT_PRICE . ': <b>' . $currencies->format($products['products_price']) . '</b>';
                                                                }
                                                                ?></td>
                                                            <!--                                                        <td style="text-align: center">-->
                                                            <!--                                                            --><?php //if($products['edited_for_seo'] == "1"): ?>
                                                            <!--                                                                <i class="fa fa-check" aria-hidden="true"></i>-->
                                                            <!--                                                            --><?php //else: ?>
                                                            <!--                                                                <i class="fa fa-times" aria-hidden="true"></i>-->
                                                            <!--                                                            --><?php //endif; ?>
                                                            <!--                                                        </td>-->

                                                            <td class="dataTableContent actions_class" align="right"
                                                                style="width:100px; border-right: 1px solid #e1e1e1;">
                                                                <?php
                                                                echo '<a href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                        tep_get_all_get_params(array(
                                                                            'cID',
                                                                            'action'
                                                                        )) . 'pID=' . $products['products_id'] . '&action=move_product') . '">' . tep_image(DIR_WS_ICONS . 'move.gif',
                                                                        IMAGE_MOVE) . '</a>';
                                                                echo '&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                        tep_get_all_get_params(array(
                                                                            'cID',
                                                                            'action'
                                                                        )) . 'pID=' . $products['products_id'] . '&action=copy_to') . '">' . tep_image(DIR_WS_ICONS . 'copy.gif',
                                                                        IMAGE_COPY_TO) . '</a>';
                                                                echo '&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                        tep_get_all_get_params(array(
                                                                            'cID',
                                                                            'action'
                                                                        )) . 'pID=' . $products['products_id'] . '&action=copy_product_attributes') . '">' . tep_image(DIR_WS_ICONS . 'copy_atr.gif',
                                                                        ATTRIBUTES_COPY_MANAGER_COPY) . '</a>';
                                                                echo '&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCTS,
                                                                        tep_get_all_get_params(array(
                                                                            'cID',
                                                                            'action'
                                                                        )) . 'pID=' . $products['products_id'] . '&action=new_product') . '">' . tep_image(DIR_WS_ICONS . 'icon_properties_add.gif',
                                                                        ICON_PREVIEW) . '</a>';
                                                                echo '&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                        tep_get_all_get_params(array(
                                                                            'cID',
                                                                            'action'
                                                                        )) . 'pID=' . $products['products_id'] . '&action=delete_product') . '">' . tep_image(DIR_WS_ICONS . 'del.gif',
                                                                        IMAGE_DELETE) . '</a>';
                                                                ?>
                                                            </td>
                                                            </tr>
                                                            <?php
                                                            if ($r_selected == '1') {

                                                                $heading = array();
                                                                $contents = array();
                                                                switch ($action) {
                                                                    case 'delete_product':
                                                                        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_PRODUCT . '</b>');

                                                                        $contents = array(
                                                                            'form' => tep_draw_form('products',
                                                                                    FILENAME_CATEGORIES,
                                                                                    'action=delete_product_confirm&cPath=' . $cPath) . tep_draw_hidden_field('products_id',
                                                                                    $pInfo->products_id)
                                                                        );
                                                                        $contents[] = array('text' => TEXT_DELETE_PRODUCT_INTRO);
                                                                        $contents[] = array('text' => '<br><b>' . $pInfo->products_name . '</b>');

                                                                        $product_categories_string = '';
                                                                        $product_categories = tep_generate_category_path($pInfo->products_id,
                                                                            'product');
                                                                        for ($i = 0, $n = sizeof($product_categories); $i < $n; $i++) {
                                                                            $category_path = '';
                                                                            for ($j = 0, $k = sizeof($product_categories[$i]); $j < $k; $j++) {
                                                                                $category_path .= $product_categories[$i][$j]['text'] . '&nbsp;&gt;&nbsp;';
                                                                            }
                                                                            $category_path = substr($category_path, 0,
                                                                                -16);
                                                                            $product_categories_string .= tep_draw_checkbox_field('product_categories[]',
                                                                                    $product_categories[$i][sizeof($product_categories[$i]) - 1]['id'],
                                                                                    true) . '&nbsp;' . $category_path . '<br>';
                                                                        }
                                                                        $product_categories_string = substr($product_categories_string,
                                                                            0, -4);
                                                                        if ($n > 1) {
                                                                            $product_categories_string = addDoubleDot(getConstantValue('TEXT_INFO_DELETE_FROM_CATEGORY')) . '<br>' . $product_categories_string;
                                                                        }
                                                                        $contents[] = array('text' => '<br>' . $product_categories_string);
                                                                        $contents[] = array(
                                                                            'align' => 'center',
                                                                            'text' => '<br>' . tep_image_submit('button_delete.gif',
                                                                                    IMAGE_DELETE) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                                    'cPath=' . $cPath . '&pID=' . $pInfo->products_id) . '">' . tep_text_button(BUTTON_CANCEL_NEW) . '</a>'
                                                                        );
                                                                        break;
                                                                    case 'move_product':
                                                                        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_MOVE_PRODUCT . '</b>');

                                                                        $contents = array(
                                                                            'form' => tep_draw_form('products',
                                                                                    FILENAME_CATEGORIES,
                                                                                    'action=move_product_confirm&cPath=' . $cPath) . tep_draw_hidden_field('products_id',
                                                                                    $pInfo->products_id)
                                                                        );
                                                                        $contents[] = array(
                                                                            'text' => sprintf(TEXT_MOVE_PRODUCTS_INTRO,
                                                                                $pInfo->products_name)
                                                                        );
                                                                        $contents[] = array(
                                                                            'text' => '<br>' . TEXT_INFO_CURRENT_CATEGORIES . '<br><b>' . tep_output_generated_category_path($pInfo->products_id,
                                                                                    'product') . '</b>'
                                                                        );
                                                                        $contents[] = array(
                                                                            'text' => '<br>' . sprintf(TEXT_MOVE,
                                                                                    $pInfo->products_name) . '<br>' . tep_draw_pull_down_categories('move_to_category_id',
                                                                                    $tep_get_category_tree,
                                                                                    $current_category_id)
                                                                        );
                                                                        $contents[] = array(
                                                                            'align' => 'center',
                                                                            'text' => '<br>' . tep_image_submit('button_move.gif',
                                                                                    IMAGE_MOVE) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                                    'cPath=' . $cPath . '&pID=' . $pInfo->products_id) . '">' . tep_text_button(BUTTON_CANCEL_NEW) . '</a>'
                                                                        );
                                                                        break;
                                                                    case 'copy_to':
                                                                        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_COPY_TO . '</b>');

                                                                        $contents = array(
                                                                            'form' => tep_draw_form('copy_to',
                                                                                    FILENAME_CATEGORIES,
                                                                                    'action=copy_to_confirm&cPath=' . $cPath) . tep_draw_hidden_field('products_id',
                                                                                    $pInfo->products_id)
                                                                        );
                                                                        $contents[] = array('text' => TEXT_INFO_COPY_TO_INTRO);
                                                                        $contents[] = array(
                                                                            'text' => '<br>' . TEXT_INFO_CURRENT_CATEGORIES . '<br><b>' . tep_output_generated_category_path($pInfo->products_id,
                                                                                    'product') . '</b>'
                                                                        );
                                                                        $contents[] = array(
                                                                            'text' => '<br>' . TEXT_CATEGORIES . '<br>' . tep_draw_pull_down_categories('categories_id',
                                                                                    $tep_get_category_tree, $cPath)
                                                                        );
                                                                        $contents[] = array(
                                                                            'text' => '<br>' . TEXT_HOW_TO_COPY . '<br>' . tep_draw_radio_field('copy_as',
                                                                                    'link',
                                                                                    true) . ' ' . TEXT_COPY_AS_LINK . '<br>' . tep_draw_radio_field('copy_as',
                                                                                    'duplicate') . ' ' . TEXT_COPY_AS_DUPLICATE
                                                                        );
                                                                        // BOF: WebMakers.com Added: Attributes Copy
                                                                        $contents[] = array(
                                                                            'text' => '<br>' . tep_image(DIR_WS_IMAGES . 'pixel_black.gif',
                                                                                    '', '100%', '1')
                                                                        );
                                                                        // only ask about attributes if they exist
                                                                        if (tep_has_product_attributes($pInfo->products_id)) {
                                                                            $contents[] = array('text' => '<br>' . TEXT_COPY_ATTRIBUTES_ONLY);
                                                                            $contents[] = array(
                                                                                'text' => '<br>' . TEXT_COPY_ATTRIBUTES . '<br>' . tep_draw_radio_field('copy_attributes',
                                                                                        'copy_attributes_yes',
                                                                                        true) . ' ' . TEXT_COPY_ATTRIBUTES_YES . '<br>' . tep_draw_radio_field('copy_attributes',
                                                                                        'copy_attributes_no') . ' ' . TEXT_COPY_ATTRIBUTES_NO
                                                                            );
                                                                        }
                                                                        // EOF: WebMakers.com Added: Attributes Copy

                                                                        $contents[] = array(
                                                                            'align' => 'center',
                                                                            'text' => '<br>' . tep_image_submit('button_copy.gif',
                                                                                    IMAGE_COPY) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                                    'cPath=' . $cPath . '&pID=' . $pInfo->products_id) . '">' . tep_text_button(BUTTON_CANCEL_NEW) . '</a>'
                                                                        );
                                                                        break;

                                                                    /////////////////////////////////////////////////////////////////////
                                                                    // WebMakers.com Added: Copy Attributes Existing Product to another Existing Product
                                                                    case 'copy_product_attributes':
                                                                        $copy_attributes_delete_first = '1';
                                                                        $copy_attributes_duplicates_skipped = '1';
                                                                        $copy_attributes_duplicates_overwrite = '0';

                                                                        if (DOWNLOAD_ENABLED == 'true') {
                                                                            $copy_attributes_include_downloads = '1';
                                                                            $copy_attributes_include_filename = '1';
                                                                        } else {
                                                                            $copy_attributes_include_downloads = '0';
                                                                            $copy_attributes_include_filename = '0';
                                                                        }

                                                                        $heading[] = array('text' => '<b>' . ATTRIBUTES_COPY_MANAGER_13 . '</b>');
                                                                        $contents = array(
                                                                            'form' => tep_draw_form('products',
                                                                                    FILENAME_CATEGORIES,
                                                                                    'action=create_copy_product_attributes&cPath=' . $cPath . '&pID=' . $pInfo->products_id) . tep_draw_hidden_field('products_id',
                                                                                    $pInfo->products_id) . tep_draw_hidden_field('products_name',
                                                                                    $pInfo->products_name)
                                                                        );
                                                                        $contents[] = array('text' => '<br>' . ATTRIBUTES_COPY_MANAGER_2 . '<b>' . $pInfo->products_name . '</b><br>' . ATTRIBUTES_COPY_MANAGER_15 . '<b>' . $pInfo->products_id . '</b>');
                                                                        $contents[] = array(
                                                                            'text' => ATTRIBUTES_COPY_MANAGER_16 . tep_draw_input_field('copy_to_products_id',
                                                                                    $copy_to_products_id,
                                                                                    'size="3"') . ATTRIBUTES_COPY_MANAGER_3
                                                                        );
                                                                        $contents[] = array(
                                                                            'text' => '<br>' . ATTRIBUTES_COPY_MANAGER_17 . tep_draw_checkbox_field('copy_attributes_delete_first',
                                                                                    $copy_attributes_delete_first,
                                                                                    'size="2"')
                                                                        );
                                                                        $contents[] = array(
                                                                            'text' => '<br>' . tep_image(DIR_WS_IMAGES . 'pixel_black.gif',
                                                                                    '', '100%', '1')
                                                                        );
                                                                        $contents[] = array('text' => '<br>' . ATTRIBUTES_COPY_MANAGER_7);
                                                                        $contents[] = array(
                                                                            'text' => ATTRIBUTES_COPY_MANAGER_8 . tep_draw_checkbox_field('copy_attributes_duplicates_skipped',
                                                                                    $copy_attributes_duplicates_skipped,
                                                                                    'size="2"')
                                                                        );
                                                                        $contents[] = array(
                                                                            'text' => ATTRIBUTES_COPY_MANAGER_9 . tep_draw_checkbox_field('copy_attributes_duplicates_overwrite',
                                                                                    $copy_attributes_duplicates_overwrite,
                                                                                    'size="2"')
                                                                        );
                                                                        /*if (DOWNLOAD_ENABLED=='true') {
                                                                        $contents[]=array('text'=>'<br>' . ATTRIBUTES_COPY_MANAGER_10 . tep_draw_checkbox_field('copy_attributes_include_downloads', $copy_attributes_include_downloads, 'size="2"'));
                                                                    }*/
                                                                        $contents[] = array(
                                                                            'text' => '<br>' . tep_image(DIR_WS_IMAGES . 'pixel_black.gif',
                                                                                    '', '100%', '1')
                                                                        );
                                                                        /**/
                                                                        /*if ($pID) {
                                                                    }else {
                                                                        $contents[]=array(
                                                                            'align'=>'center',
                                                                            'text'=>'<br>Select a product for display'
                                                                        );
                                                                    }*/
                                                                        $contents[] = array(
                                                                            'align' => 'center',
                                                                            'text' => '<br>' . tep_image_submit('button_copy.gif',
                                                                                    ATTRIBUTES_COPY_MANAGER_COPY) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                                    'cPath=' . $cPath . '&pID=' . $pInfo->products_id) . '">' . tep_text_button(BUTTON_CANCEL_NEW) . '</a>'
                                                                        );
                                                                        break;
                                                                    // WebMakers.com Added: Copy Attributes Existing Product to All Products in Category
                                                                    case 'copy_product_attributes_categories':
                                                                        $copy_attributes_delete_first = '1';
                                                                        $copy_attributes_duplicates_skipped = '1';
                                                                        $copy_attributes_duplicates_overwrite = '0';

                                                                        if (DOWNLOAD_ENABLED == 'true') {
                                                                            $copy_attributes_include_downloads = '1';
                                                                            $copy_attributes_include_filename = '1';
                                                                        } else {
                                                                            $copy_attributes_include_downloads = '0';
                                                                            $copy_attributes_include_filename = '0';
                                                                        }

                                                                        $heading[] = array('text' => '<b>' . ATTRIBUTES_COPY_MANAGER_1 . '</b>');
                                                                        $contents = array(
                                                                            'form' => tep_draw_form('products',
                                                                                FILENAME_CATEGORIES,
                                                                                'action=create_copy_product_attributes_categories&cPath=' . $cPath . '&cID=' . $cID . '&make_copy_from_products_id=' . $copy_from_products_id)
                                                                        );
                                                                        $contents[] = array(
                                                                            'text' => ATTRIBUTES_COPY_MANAGER_2 . tep_draw_input_field('make_copy_from_products_id',
                                                                                    $make_copy_from_products_id,
                                                                                    'size="3"') . ATTRIBUTES_COPY_MANAGER_3
                                                                        );
                                                                        $contents[] = array(
                                                                            'text' => '<br>' . ATTRIBUTES_COPY_MANAGER_4 . '<b>' . tep_get_category_name($cID,
                                                                                    $languages_id) . '</b><br>' . ATTRIBUTES_COPY_MANAGER_5 . $cID
                                                                        );
                                                                        $contents[] = array(
                                                                            'text' => '<br>' . ATTRIBUTES_COPY_MANAGER_6 . tep_draw_checkbox_field('copy_attributes_delete_first',
                                                                                    $copy_attributes_delete_first,
                                                                                    'size="2"')
                                                                        );
                                                                        $contents[] = array(
                                                                            'text' => '<br>' . tep_image(DIR_WS_IMAGES . 'pixel_black.gif',
                                                                                    '', '100%', '1')
                                                                        );
                                                                        $contents[] = array('text' => '<br>' . ATTRIBUTES_COPY_MANAGER_7);
                                                                        $contents[] = array(
                                                                            'text' => ATTRIBUTES_COPY_MANAGER_8 . tep_draw_checkbox_field('copy_attributes_duplicates_skipped',
                                                                                    $copy_attributes_duplicates_skipped,
                                                                                    'size="2"')
                                                                        );
                                                                        $contents[] = array(
                                                                            'text' => '<br>' . ATTRIBUTES_COPY_MANAGER_9 . tep_draw_checkbox_field('copy_attributes_duplicates_overwrite',
                                                                                    $copy_attributes_duplicates_overwrite,
                                                                                    'size="2"')
                                                                        );
                                                                        if (DOWNLOAD_ENABLED == 'true') {
                                                                            $contents[] = array(
                                                                                'text' => '<br>' . ATTRIBUTES_COPY_MANAGER_10 . tep_draw_checkbox_field('copy_attributes_include_downloads',
                                                                                        $copy_attributes_include_downloads,
                                                                                        'size="2"')
                                                                            );
                                                                        }
                                                                        $contents[] = array(
                                                                            'text' => '<br>' . tep_image(DIR_WS_IMAGES . 'pixel_black.gif',
                                                                                    '', '100%', '1')
                                                                        );
                                                                        $contents[] = array(
                                                                            'align' => 'center',
                                                                            'text' => '<br>' . tep_image_submit('button_copy.gif',
                                                                                    ATTRIBUTES_COPY_MANAGER_COPY) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                                    'cPath=' . $cPath . '&cID=' . $cID) . '">' . tep_text_button(BUTTON_CANCEL_NEW) . '</a>'
                                                                        );
                                                                        break;
                                                                }

                                                                if ((tep_not_null($heading)) && (tep_not_null($contents))) {
                                                                    echo '            <tr><td colspan="5" style="border:2px solid red;">' . "\n";
                                                                    $box = new box;
                                                                    echo $box->infoBox($heading, $contents);
                                                                    echo '            </td></tr>' . "\n";
                                                                }
                                                            }
                                                        }

                                                        $cPath_back = '';
                                                        if (is_array($cPath_array) && sizeof($cPath_array) > 0) {
                                                            for ($i = 0, $n = sizeof($cPath_array) - 1; $i < $n; $i++) {
                                                                if (empty($cPath_back)) {
                                                                    $cPath_back .= $cPath_array[$i];
                                                                } else {
                                                                    $cPath_back .= '_' . $cPath_array[$i];
                                                                }
                                                            }
                                                        }

                                                        $cPath_back = (tep_not_null($cPath_back)) ? 'cPath=' . $cPath_back . '&' : '';
                                                        ?>
                                                        <tr class="smallText_wrap">
                                                            <td colspan="6">
                                                                <table border="0" width="100%" cellspacing="0"
                                                                       cellpadding="2">
                                                                    <tr>
                                                                        <td class="smallText smallText_text"
                                                                            style="padding: 10px;font-size: 11px;line-height: 1.4;">
                                                                            <?php echo TEXT_CATEGORIES . '&nbsp;' . $categories_count . '<br>' . TEXT_PRODUCTS . '&nbsp;' . $products_count; ?>
                                                                            <br>
                                                                            <?php echo TEXT_TOTAL_PRODUCTS . $numr; ?>
                                                                            <br>
                                                                            <?php
                                                                            if ($paginator) {
                                                                                echo $paginator->createLinks(4,
                                                                                    'pagination');
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                        <td align="right"
                                                                            class="smallText smallText_but"
                                                                            style="padding: 10px;">
                                                                            <?php if (is_array($cPath_array) && sizeof($cPath_array) > 0) {
                                                                                echo '<a class="back_btn"  href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                                        $cPath_back . 'cID=' . $current_category_id) . '">' . tep_text_button(BUTTON_BACK_NEW) . '</a>&nbsp;&nbsp;';
                                                                            }
                                                                            if (!$getSearch) {
                                                                                echo '<a class="new_cat_btn" href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                                        'cPath=' . $cPath . '&action=new_category') . '">' . tep_text_button(BUTTON_NEW_CATEGORY_NEW) . '</a>&nbsp;&nbsp;';
                                                                            }
                                                                            echo '<a class="new_product_btn" href="' . tep_href_link(FILENAME_PRODUCTS,
                                                                                    'cPath=' . $cPath . '&action=new_product') . '">' . tep_text_button(BUTTON_NEW_PRODUCT_NEW) . '</a>'; ?>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr class="td_block_cats_mobil">
                                    <td valign="top" class="td_block_cats">
                                        <div class="table-responsive">
                                            <table class="td_block_cats_table" border="0" width="100%" cellspacing="0"
                                                   cellpadding="2">
                                                <tr class="dataTableHeadingRow">
                                                    <td class="dataTableHeadingContent" align="center" width="35">#</td>
                                                    
                                                    <td class="dataTableHeadingContent" align="center"
                                                        width="40"><?php echo TABLE_HEADING_STATUS; ?></td>
                                                    <td class="dataTableHeadingContent" align="center"
                                                        style="padding: 8px 5px;"><?php echo TEXT_CAT_IMAGE; ?></td>
                                                    <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CATEGORIES_PRODUCTS; ?></td>
                                                    <!--                                                        <td class="dataTableHeadingContent" style="text-align: center">SEO</td>-->
                                                    <td class="dataTableHeadingContent" align="center"
                                                        width="100" style="border-right: 1px solid #e1e1e1;"><?php echo TEXT_CAT_ACTION; ?></td>
                                                </tr>
                                                <?php
                                                $heading = array();
                                                $contents = array();
                                                switch ($action) {
                                                    case 'delete_category':
                                                        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_CATEGORY . '</b>');

                                                        $contents = array(
                                                            'form' => tep_draw_form('categories', FILENAME_CATEGORIES,
                                                                    'action=delete_category_confirm&cPath=' . $cPath) . tep_draw_hidden_field('categories_id',
                                                                    $cInfo->categories_id)
                                                        );
                                                        $contents[] = array('text' => TEXT_DELETE_CATEGORY_INTRO);
                                                        $contents[] = array('text' => '<br><b>' . $cInfo->categories_name . '</b>');
                                                        if ($cInfo->childs_count > 0) {
                                                            $contents[] = array(
                                                                'text' => '<br>' . sprintf(TEXT_DELETE_WARNING_CHILDS,
                                                                        $cInfo->childs_count)
                                                            );
                                                        }
                                                        if ($cInfo->products_count > 0) {
                                                            $contents[] = array(
                                                                'text' => '<br>' . sprintf(TEXT_DELETE_WARNING_PRODUCTS,
                                                                        $cInfo->products_count)
                                                            );
                                                        }
                                                        $contents[] = array(
                                                            'align' => 'center',
                                                            'text' => '<br>' . tep_image_submit('button_delete.gif',
                                                                    IMAGE_DELETE) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                    'cPath=' . $cPath . '&cID=' . $cInfo->categories_id) . '">' . tep_text_button(BUTTON_CANCEL_NEW) . '</a>'
                                                        );
                                                        break;
                                                    case 'move_category':
                                                        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_MOVE_CATEGORY . '</b>');
                                                        
														$contents = array(
                                                            'form' => tep_draw_form('categories', FILENAME_CATEGORIES,
                                                                    'action=move_category_confirm&cPath=' . $cPath) . tep_draw_hidden_field('categories_id',
                                                                    $cInfo->categories_id)
                                                        );
                                                        $contents[] = array(
                                                            'text' => sprintf(TEXT_MOVE_CATEGORIES_INTRO,
                                                                $cInfo->categories_name)
                                                        );
                                                        $contents[] = array(
                                                            'text' => '<br>' . sprintf(TEXT_MOVE,
                                                                    $cInfo->categories_name) . '<br>' . tep_draw_pull_down_categories('move_to_category_id',
                                                                    $tep_get_category_tree, $current_category_id)
                                                        );
                                                        $contents[] = array(
                                                            'align' => 'center',
                                                            'text' => '<br>' . tep_image_submit('button_move.gif',
                                                                    IMAGE_MOVE) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                    'cPath=' . $cPath . '&cID=' . $cInfo->categories_id) . '">' . tep_text_button(BUTTON_CANCEL_NEW) . '</a>'
                                                        );
                                                        break;
                                                }

                                                if ((tep_not_null($heading)) && (tep_not_null($contents))) {
                                                    echo '            <tr>' . "\n";
                                                    echo '                    <td colspan="5"><div style="padding-left:10px;">';

                                                    $box = new box;
                                                    echo $box->infoBox($heading, $contents);

                                                    echo '            </div></td></tr>' . "\n";
                                                }
                                                ?>
                                                <?php
                                                $products_count = 0;
                                                if (!isset($page)) {
                                                    $page = 0;
                                                };

                                                $max_prod_admin_side_q = tep_db_query("select configuration_value FROM configuration WHERE configuration_key='MAX_PROD_ADMIN_SIDE'");
                                                $max_prod_admin_side = (tep_db_fetch_array($max_prod_admin_side_q));
                                                #
                                                $max_count = $max_prod_admin_side['configuration_value'];
                                                #

                                                //new from 03.10.17
                                                $join_query = '';
                                                $conditional_query = '';
                                                if (isset($_GET['specials'])) {
                                                    $join_query .= " RIGHT JOIN `specials` `s` ON `s`.`products_id` = `p`.`products_id`";
                                                }
                                                if (isset($_GET['concomitant'])) {
                                                    $join_query .= " RIGHT JOIN `products_xsell` `px` ON `px`.`products_id` = `p`.`products_id`";
                                                }
                                                if (isset($_GET['recommend'])) {
                                                    $join_query .= " RIGHT JOIN `featured` `f` ON `f`.`products_id` = `p`.`products_id`";
                                                }
                                                if (isset($_GET['top'])) {
                                                    $conditional_query .= " AND `p`.`lable_1` = 1";
                                                }
                                                if (isset($_GET['new'])) {
                                                    $conditional_query .= " AND `p`.`lable_2` = 1";
                                                }
                                                if (isset($_GET['stock'])) {
                                                    $conditional_query .= " AND `p`.`lable_3` = 1";
                                                }

                                                if ($getSearch) {
                                                    $search_query_string = " and (p.products_model like '%" . tep_db_input($search) . "%' or pd.products_name like '%" . tep_db_input($search) . "%') ";

                                                } elseif (!empty($conditional_query) || !empty($join_query)) {
                                                    $search_query_string = '';
                                                } else {
                                                    $search_query_string = " and p2c.categories_id = '" . (int)$current_category_id . "' ";
                                                }

                                                //$products_query_line="select p.products_image, p.products_id, pd.products_name, p.products_quantity, p.products_price, p.products_date_added, p.products_last_modified, p.products_date_available, p.products_status, p.products_to_xml, p.products_sort_order, p.products_model, p2c.categories_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = p2c.products_id " . $search_query_string . " order by pd.products_name, p.products_id";
                                                $products_query_line = "SELECT
                                                                              `p`.`products_image`,
                                                                              `p`.`products_id`,
                                                                              `pd`.`products_name`,
                                                                              `p`.`products_quantity`,
                                                                              `p`.`products_price`,
                                                                              `p`.`products_date_added`,
                                                                              `p`.`products_last_modified`,
                                                                              `p`.`products_date_available`,
                                                                              `p`.`products_status`,
                                                                              `p`.`products_to_xml`,
                                                                              `p`.`edited_for_seo`,
                                                                              `p`.`products_sort_order`,
                                                                              `p`.`products_model`,
                                                                              `p2c`.`categories_id`
                                                                            FROM `products` `p`
                                                                              LEFT JOIN `products_description` `pd` ON `pd`.`products_id` = `p`.`products_id`
                                                                              LEFT JOIN `products_to_categories` `p2c` ON `p2c`.`products_id` = `p`.`products_id`
                                                                              {$join_query}
                                                                            WHERE `pd`.`language_id` = '{$languages_id}' {$conditional_query}{$search_query_string}
                                                                            ORDER BY `pd`.`products_name`, `p`.`products_id`";

                                                $products_query = tep_db_query($products_query_line);
                                                $numr = tep_db_num_rows($products_query);

                                                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                                $products_query_line .= " limit " . (($page - 1) * $max_count) . "," . $max_count;
                                                $products_query = tep_db_query($products_query_line);

                                                if ($numr > $max_count) {
                                                    if (is_file($pathPagination = DIR_WS_CLASSES . 'categories_paginator/Paginator.php')) {
                                                        include_once $pathPagination;
                                                        $herf = 'categories.php?cPath=' . $cPath . ($getSearch ? '&search=' . $getSearch : '') . '&page=';
                                                        $paginator = new Paginator($numr, $page, $max_count, $herf);
                                                    }
                                                }

                                                while ($products = tep_db_fetch_array($products_query)) {
                                                    $products_count++;
                                                    $rows++;

                                                    // Get categories_id for product if search
                                                    if ($getSearch) {
                                                        $cPath = $products['categories_id'];
                                                    }

                                                    if ((!isset($_GET['pID']) && !isset($_GET['cID']) || (isset($_GET['pID']) && ($_GET['pID'] == $products['products_id']))) && !isset($pInfo) && !isset($cInfo) && (substr($action,
                                                                0, 3) != 'new')) {
                                                        $pInfo = new objectInfo($products);
                                                    }

                                                    if (isset($pInfo) && is_object($pInfo) && ($products['products_id'] == $pInfo->products_id)) {
                                                        $r_selected = '1';
                                                    } else {
                                                        $r_selected = '0';
                                                    }

                                                    echo '              <tr class="dataTableRow ' . ($_GET['pID'] == $products['products_id'] ? 'dataTableRowOver' : '') . '" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_PRODUCTS,
                                                            tep_get_all_get_params(array(
                                                                'cID',
                                                                'action'
                                                            )) . 'pID=' . $products['products_id'] . '&action=new_product') . '\'">' . "\n";

                                                    ?>
                                                    <td class="dataTableContent nobg bg_left" align="center">
                                                        <?php echo $products['products_sort_order']; ?>
                                                    </td>
                                                    
                                                    <td class="dataTableContent" align="center">
                                                        <?php
                                                        if ($products['products_status'] == '1') {
                                                            echo '<a href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                    tep_get_all_get_params(array(
                                                                        'cID',
                                                                        'action'
                                                                    )) . 'action=setflag&flag=0&pID=' . $products['products_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green.gif',
                                                                    IMAGE_ICON_STATUS_RED_LIGHT, 16, 16) . '</a>';
                                                        } else {
                                                            echo '<a href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                    tep_get_all_get_params(array(
                                                                        'cID',
                                                                        'action'
                                                                    )) . 'action=setflag&flag=1&pID=' . $products['products_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_red.gif',
                                                                    IMAGE_ICON_STATUS_GREEN_LIGHT, 16, 16) . '</a>';
                                                        }
                                                        ?>

                                                        <?php
                                                        if (EXCEL_IMPORT_MODULE_ENABLED == 'true') {
                                                            if ($products['products_to_xml'] == '1') {
                                                                echo '<a href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                        tep_get_all_get_params(array(
                                                                            'cID',
                                                                            'action'
                                                                        )) . 'action=setxml&flagxml=0&pID=' . $products['products_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green.gif',
                                                                        IMAGE_ICON_STATUS_RED_LIGHT, 10, 10) . '</a>';
                                                            } else {
                                                                echo '<a href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                        tep_get_all_get_params(array(
                                                                            'cID',
                                                                            'action'
                                                                        )) . 'action=setxml&flagxml=1&pID=' . $products['products_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green_light.gif',
                                                                        IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10) . '</a>';
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="nobg"
                                                        style="width:70px;text-align:center;padding: 10px 5px;">
                                                        <?php
                                                        $prod_img = explode(';', $products['products_image']);
                                                        if (!empty($prod_img[0])) {
                                                            echo tep_info_image($prod_img[0], '', '64', '64', true);
                                                        } else {
                                                            echo tep_info_image('default.png', '', '64', '64');
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="dataTableContent" style="padding-left:10px;"><?php

                                                        echo '<span style="font-size:12px;font-weight:bold;">' . $products['products_name'] . '</span>';
                                                        echo '<br /><br />#' . $products['products_id'] . '';
                                                        if ($products['products_model']) {
                                                            echo '&nbsp;&nbsp;&nbsp;&nbsp;' . TEXT_CAT_MODEL . ': ' . $products['products_model'] . '';
                                                        }
                                                        echo '&nbsp;&nbsp;&nbsp;&nbsp;' . TEXT_CAT_QTY . ': <b>' . $products['products_quantity'] . '</b>';
                                                        echo '&nbsp;&nbsp;&nbsp;&nbsp;' . TEXT_CAT_PRICE . ': <b>' . $currencies->format($products['products_price']) . '</b>';

                                                        ?></td>
                                                    <!--                                                        <td style="text-align: center">-->
                                                    <!--                                                            --><?php //if($products['edited_for_seo'] == "1"): ?>
                                                    <!--                                                                <i class="fa fa-check" aria-hidden="true"></i>-->
                                                    <!--                                                            --><?php //else: ?>
                                                    <!--                                                                <i class="fa fa-times" aria-hidden="true"></i>-->
                                                    <!--                                                            --><?php //endif; ?>
                                                    <!--                                                        </td>-->

                                                    <td class="dataTableContent actions_class" align="right"
                                                        style="width:100px; border-right: 1px solid #e1e1e1;">
                                                        <?php
                                                        echo '<a href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                tep_get_all_get_params(array(
                                                                    'cID',
                                                                    'action'
                                                                )) . 'pID=' . $products['products_id'] . '&action=move_product') . '">' . tep_image(DIR_WS_ICONS . 'move.gif',
                                                                IMAGE_MOVE) . '</a>';
                                                        echo '&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                tep_get_all_get_params(array(
                                                                    'cID',
                                                                    'action'
                                                                )) . 'pID=' . $products['products_id'] . '&action=copy_to') . '">' . tep_image(DIR_WS_ICONS . 'copy.gif',
                                                                IMAGE_COPY_TO) . '</a>';
                                                        echo '&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                tep_get_all_get_params(array(
                                                                    'cID',
                                                                    'action'
                                                                )) . 'pID=' . $products['products_id'] . '&action=copy_product_attributes') . '">' . tep_image(DIR_WS_ICONS . 'copy_atr.gif',
                                                                ATTRIBUTES_COPY_MANAGER_COPY) . '</a>';
                                                        echo '&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCTS,
                                                                tep_get_all_get_params(array(
                                                                    'cID',
                                                                    'action'
                                                                )) . 'pID=' . $products['products_id'] . '&action=new_product') . '">' . tep_image(DIR_WS_ICONS . 'icon_properties_add.gif',
                                                                ICON_PREVIEW) . '</a>';
                                                        echo '&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                tep_get_all_get_params(array(
                                                                    'cID',
                                                                    'action'
                                                                )) . 'pID=' . $products['products_id'] . '&action=delete_product') . '">' . tep_image(DIR_WS_ICONS . 'del.gif',
                                                                IMAGE_DELETE) . '</a>';
                                                        ?>
                                                    </td>
                                                    </tr>
                                                    <?php
                                                    if ($r_selected == '1') {

                                                        $heading = array();
                                                        $contents = array();
                                                        switch ($action) {
                                                            case 'delete_product':
                                                                $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_PRODUCT . '</b>');

                                                                $contents = array(
                                                                    'form' => tep_draw_form('products',
                                                                            FILENAME_CATEGORIES,
                                                                            'action=delete_product_confirm&cPath=' . $cPath) . tep_draw_hidden_field('products_id',
                                                                            $pInfo->products_id)
                                                                );
                                                                $contents[] = array('text' => TEXT_DELETE_PRODUCT_INTRO);
                                                                $contents[] = array('text' => '<br><b>' . $pInfo->products_name . '</b>');

                                                                $product_categories_string = '';
                                                                $product_categories = tep_generate_category_path($pInfo->products_id,
                                                                    'product');
                                                                for ($i = 0, $n = sizeof($product_categories); $i < $n; $i++) {
                                                                    $category_path = '';
                                                                    for ($j = 0, $k = sizeof($product_categories[$i]); $j < $k; $j++) {
                                                                        $category_path .= $product_categories[$i][$j]['text'] . '&nbsp;&gt;&nbsp;';
                                                                    }
                                                                    $category_path = substr($category_path, 0, -16);
                                                                    $product_categories_string .= tep_draw_checkbox_field('product_categories[]',
                                                                            $product_categories[$i][sizeof($product_categories[$i]) - 1]['id'],
                                                                            true) . '&nbsp;' . $category_path . '<br>';
                                                                }
                                                                $product_categories_string = substr($product_categories_string,
                                                                    0, -4);
                                                                if ($n > 1) {
                                                                    $product_categories_string = addDoubleDot(getConstantValue('TEXT_INFO_DELETE_FROM_CATEGORY')) . '<br>' . $product_categories_string;
                                                                }
                                                                $contents[] = array('text' => '<br>' . $product_categories_string);
                                                                $contents[] = array(
                                                                    'align' => 'center',
                                                                    'text' => '<br>' . tep_image_submit('button_delete.gif',
                                                                            IMAGE_DELETE) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                            'cPath=' . $cPath . '&pID=' . $pInfo->products_id) . '">' . tep_text_button(BUTTON_CANCEL_NEW) . '</a>'
                                                                );
                                                                break;
                                                            case 'move_product':
                                                                $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_MOVE_PRODUCT . '</b>');

                                                                $contents = array(
                                                                    'form' => tep_draw_form('products',
                                                                            FILENAME_CATEGORIES,
                                                                            'action=move_product_confirm&cPath=' . $cPath) . tep_draw_hidden_field('products_id',
                                                                            $pInfo->products_id)
                                                                );
                                                                $contents[] = array(
                                                                    'text' => sprintf(TEXT_MOVE_PRODUCTS_INTRO,
                                                                        $pInfo->products_name)
                                                                );
                                                                $contents[] = array(
                                                                    'text' => '<br>' . TEXT_INFO_CURRENT_CATEGORIES . '<br><b>' . tep_output_generated_category_path($pInfo->products_id,
                                                                            'product') . '</b>'
                                                                );
                                                                $contents[] = array(
                                                                    'text' => '<br>' . sprintf(TEXT_MOVE,
                                                                            $pInfo->products_name) . '<br>' . tep_draw_pull_down_categories('move_to_category_id',
                                                                            $tep_get_category_tree,
                                                                            $current_category_id)
                                                                );
                                                                $contents[] = array(
                                                                    'align' => 'center',
                                                                    'text' => '<br>' . tep_image_submit('button_move.gif',
                                                                            IMAGE_MOVE) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                            'cPath=' . $cPath . '&pID=' . $pInfo->products_id) . '">' . tep_text_button(BUTTON_CANCEL_NEW) . '</a>'
                                                                );
                                                                break;
                                                            case 'copy_to':
                                                                $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_COPY_TO . '</b>');

                                                                $contents = array(
                                                                    'form' => tep_draw_form('copy_to',
                                                                            FILENAME_CATEGORIES,
                                                                            'action=copy_to_confirm&cPath=' . $cPath) . tep_draw_hidden_field('products_id',
                                                                            $pInfo->products_id)
                                                                );
                                                                $contents[] = array('text' => TEXT_INFO_COPY_TO_INTRO);
                                                                $contents[] = array(
                                                                    'text' => '<br>' . TEXT_INFO_CURRENT_CATEGORIES . '<br><b>' . tep_output_generated_category_path($pInfo->products_id,
                                                                            'product') . '</b>'
                                                                );
                                                                $contents[] = array(
                                                                    'text' => '<br>' . TEXT_CATEGORIES . '<br>' . tep_draw_pull_down_categories('categories_id',
                                                                            $tep_get_category_tree, $cPath)
                                                                );
                                                                $contents[] = array(
                                                                    'text' => '<br>' . TEXT_HOW_TO_COPY . '<br>' . tep_draw_radio_field('copy_as',
                                                                            'link',
                                                                            true) . ' ' . TEXT_COPY_AS_LINK . '<br>' . tep_draw_radio_field('copy_as',
                                                                            'duplicate') . ' ' . TEXT_COPY_AS_DUPLICATE
                                                                );
                                                                // BOF: WebMakers.com Added: Attributes Copy
                                                                $contents[] = array(
                                                                    'text' => '<br>' . tep_image(DIR_WS_IMAGES . 'pixel_black.gif',
                                                                            '', '100%', '1')
                                                                );
                                                                // only ask about attributes if they exist
                                                                if (tep_has_product_attributes($pInfo->products_id)) {
                                                                    $contents[] = array('text' => '<br>' . TEXT_COPY_ATTRIBUTES_ONLY);
                                                                    $contents[] = array(
                                                                        'text' => '<br>' . TEXT_COPY_ATTRIBUTES . '<br>' . tep_draw_radio_field('copy_attributes',
                                                                                'copy_attributes_yes',
                                                                                true) . ' ' . TEXT_COPY_ATTRIBUTES_YES . '<br>' . tep_draw_radio_field('copy_attributes',
                                                                                'copy_attributes_no') . ' ' . TEXT_COPY_ATTRIBUTES_NO
                                                                    );
                                                                }
                                                                // EOF: WebMakers.com Added: Attributes Copy

                                                                $contents[] = array(
                                                                    'align' => 'center',
                                                                    'text' => '<br>' . tep_image_submit('button_copy.gif',
                                                                            IMAGE_COPY) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                            'cPath=' . $cPath . '&pID=' . $pInfo->products_id) . '">' . tep_text_button(BUTTON_CANCEL_NEW) . '</a>'
                                                                );
                                                                break;

                                                            /////////////////////////////////////////////////////////////////////
                                                            // WebMakers.com Added: Copy Attributes Existing Product to another Existing Product
                                                            case 'copy_product_attributes':
                                                                $copy_attributes_delete_first = '1';
                                                                $copy_attributes_duplicates_skipped = '1';
                                                                $copy_attributes_duplicates_overwrite = '0';

                                                                if (DOWNLOAD_ENABLED == 'true') {
                                                                    $copy_attributes_include_downloads = '1';
                                                                    $copy_attributes_include_filename = '1';
                                                                } else {
                                                                    $copy_attributes_include_downloads = '0';
                                                                    $copy_attributes_include_filename = '0';
                                                                }

                                                                $heading[] = array('text' => '<b>' . ATTRIBUTES_COPY_MANAGER_13 . '</b>');
                                                                $contents = array(
                                                                    'form' => tep_draw_form('products',
                                                                            FILENAME_CATEGORIES,
                                                                            'action=create_copy_product_attributes&cPath=' . $cPath . '&pID=' . $pInfo->products_id) . tep_draw_hidden_field('products_id',
                                                                            $pInfo->products_id) . tep_draw_hidden_field('products_name',
                                                                            $pInfo->products_name)
                                                                );
                                                                $contents[] = array('text' => '<br>' . ATTRIBUTES_COPY_MANAGER_2 . '<b>' . $pInfo->products_name . '</b><br>' . ATTRIBUTES_COPY_MANAGER_15 . '<b>' . $pInfo->products_id . '</b>');
                                                                $contents[] = array(
                                                                    'text' => ATTRIBUTES_COPY_MANAGER_16 . tep_draw_input_field('copy_to_products_id',
                                                                            $copy_to_products_id,
                                                                            'size="3"') . ATTRIBUTES_COPY_MANAGER_3
                                                                );
                                                                $contents[] = array(
                                                                    'text' => '<br>' . ATTRIBUTES_COPY_MANAGER_17 . tep_draw_checkbox_field('copy_attributes_delete_first',
                                                                            $copy_attributes_delete_first, 'size="2"')
                                                                );
                                                                $contents[] = array(
                                                                    'text' => '<br>' . tep_image(DIR_WS_IMAGES . 'pixel_black.gif',
                                                                            '', '100%', '1')
                                                                );
                                                                $contents[] = array('text' => '<br>' . ATTRIBUTES_COPY_MANAGER_7);
                                                                $contents[] = array(
                                                                    'text' => ATTRIBUTES_COPY_MANAGER_8 . tep_draw_checkbox_field('copy_attributes_duplicates_skipped',
                                                                            $copy_attributes_duplicates_skipped,
                                                                            'size="2"')
                                                                );
                                                                $contents[] = array(
                                                                    'text' => ATTRIBUTES_COPY_MANAGER_9 . tep_draw_checkbox_field('copy_attributes_duplicates_overwrite',
                                                                            $copy_attributes_duplicates_overwrite,
                                                                            'size="2"')
                                                                );
                                                                if (DOWNLOAD_ENABLED == 'true') {
                                                                    $contents[] = array(
                                                                        'text' => '<br>' . ATTRIBUTES_COPY_MANAGER_10 . tep_draw_checkbox_field('copy_attributes_include_downloads',
                                                                                $copy_attributes_include_downloads,
                                                                                'size="2"')
                                                                    );
                                                                }
                                                                $contents[] = array(
                                                                    'text' => '<br>' . tep_image(DIR_WS_IMAGES . 'pixel_black.gif',
                                                                            '', '100%', '1')
                                                                );
                                                                if ($pID) {
                                                                } else {
                                                                    $contents[] = array(
                                                                        'align' => 'center',
                                                                        'text' => '<br>Select a product for display'
                                                                    );
                                                                }
                                                                $contents[] = array(
                                                                    'align' => 'center',
                                                                    'text' => '<br>' . tep_image_submit('button_copy.gif',
                                                                            ATTRIBUTES_COPY_MANAGER_COPY) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                            'cPath=' . $cPath . '&pID=' . $pInfo->products_id) . '">' . tep_text_button(BUTTON_CANCEL_NEW) . '</a>'
                                                                );
                                                                break;
                                                            // WebMakers.com Added: Copy Attributes Existing Product to All Products in Category
                                                            case 'copy_product_attributes_categories':
                                                                $copy_attributes_delete_first = '1';
                                                                $copy_attributes_duplicates_skipped = '1';
                                                                $copy_attributes_duplicates_overwrite = '0';

                                                                if (DOWNLOAD_ENABLED == 'true') {
                                                                    $copy_attributes_include_downloads = '1';
                                                                    $copy_attributes_include_filename = '1';
                                                                } else {
                                                                    $copy_attributes_include_downloads = '0';
                                                                    $copy_attributes_include_filename = '0';
                                                                }

                                                                $heading[] = array('text' => '<b>' . ATTRIBUTES_COPY_MANAGER_1 . '</b>');
                                                                $contents = array(
                                                                    'form' => tep_draw_form('products',
                                                                        FILENAME_CATEGORIES,
                                                                        'action=create_copy_product_attributes_categories&cPath=' . $cPath . '&cID=' . $cID . '&make_copy_from_products_id=' . $copy_from_products_id)
                                                                );
                                                                $contents[] = array(
                                                                    'text' => ATTRIBUTES_COPY_MANAGER_2 . tep_draw_input_field('make_copy_from_products_id',
                                                                            $make_copy_from_products_id,
                                                                            'size="3"') . ATTRIBUTES_COPY_MANAGER_3
                                                                );
                                                                $contents[] = array(
                                                                    'text' => '<br>' . ATTRIBUTES_COPY_MANAGER_4 . '<b>' . tep_get_category_name($cID,
                                                                            $languages_id) . '</b><br>' . ATTRIBUTES_COPY_MANAGER_5 . $cID
                                                                );
                                                                $contents[] = array(
                                                                    'text' => '<br>' . ATTRIBUTES_COPY_MANAGER_6 . tep_draw_checkbox_field('copy_attributes_delete_first',
                                                                            $copy_attributes_delete_first, 'size="2"')
                                                                );
                                                                $contents[] = array(
                                                                    'text' => '<br>' . tep_image(DIR_WS_IMAGES . 'pixel_black.gif',
                                                                            '', '100%', '1')
                                                                );
                                                                $contents[] = array('text' => '<br>' . ATTRIBUTES_COPY_MANAGER_7);
                                                                $contents[] = array(
                                                                    'text' => ATTRIBUTES_COPY_MANAGER_8 . tep_draw_checkbox_field('copy_attributes_duplicates_skipped',
                                                                            $copy_attributes_duplicates_skipped,
                                                                            'size="2"')
                                                                );
                                                                $contents[] = array(
                                                                    'text' => '<br>' . ATTRIBUTES_COPY_MANAGER_9 . tep_draw_checkbox_field('copy_attributes_duplicates_overwrite',
                                                                            $copy_attributes_duplicates_overwrite,
                                                                            'size="2"')
                                                                );
                                                                if (DOWNLOAD_ENABLED == 'true') {
                                                                    $contents[] = array(
                                                                        'text' => '<br>' . ATTRIBUTES_COPY_MANAGER_10 . tep_draw_checkbox_field('copy_attributes_include_downloads',
                                                                                $copy_attributes_include_downloads,
                                                                                'size="2"')
                                                                    );
                                                                }
                                                                $contents[] = array(
                                                                    'text' => '<br>' . tep_image(DIR_WS_IMAGES . 'pixel_black.gif',
                                                                            '', '100%', '1')
                                                                );
                                                                $contents[] = array(
                                                                    'align' => 'center',
                                                                    'text' => '<br>' . tep_image_submit('button_copy.gif',
                                                                            ATTRIBUTES_COPY_MANAGER_COPY) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                            'cPath=' . $cPath . '&cID=' . $cID) . '">' . tep_text_button(BUTTON_CANCEL_NEW) . '</a>'
                                                                );
                                                                break;
                                                        }

                                                        if ((tep_not_null($heading)) && (tep_not_null($contents))) {
                                                            echo '            <tr><td colspan="5" style="border:2px solid red;">' . "\n";
                                                            $box = new box;
                                                            echo $box->infoBox($heading, $contents);
                                                            echo '            </td></tr>' . "\n";
                                                        }
                                                    }
                                                }

                                                $cPath_back = '';
                                                if (is_array($cPath_array) && sizeof($cPath_array) > 0) {
                                                    for ($i = 0, $n = sizeof($cPath_array) - 1; $i < $n; $i++) {
                                                        if (empty($cPath_back)) {
                                                            $cPath_back .= $cPath_array[$i];
                                                        } else {
                                                            $cPath_back .= '_' . $cPath_array[$i];
                                                        }
                                                    }
                                                }

                                                $cPath_back = (tep_not_null($cPath_back)) ? 'cPath=' . $cPath_back . '&' : '';
                                                ?>
                                                <tr class="smallText_wrap">
                                                    <td colspan="6">
                                                        <table border="0" width="100%" cellspacing="0" cellpadding="2">
                                                            <tr>
                                                                <td class="smallText smallText_text"
                                                                    style="padding: 10px;font-size: 11px;line-height: 1.4;">
                                                                    <?php echo TEXT_CATEGORIES . '&nbsp;' . $categories_count . '<br>' . TEXT_PRODUCTS . '&nbsp;' . $products_count; ?>
                                                                    <br>
                                                                    <?php echo TEXT_TOTAL_PRODUCTS . $numr; ?>
                                                                    <br>
                                                                    <?php
                                                                    if ($paginator) {
                                                                        $paginator->createLinks(4, 'pagination');
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td align="right" class="smallText smallText_but"
                                                                    style="padding: 10px;">
                                                                    <?php if (is_array($cPath_array) && sizeof($cPath_array) > 0) {
                                                                        echo '<a class="back_btn"  href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                                $cPath_back . 'cID=' . $current_category_id) . '">' . tep_text_button(BUTTON_BACK_NEW) . '</a>&nbsp;&nbsp;';
                                                                    }
                                                                    if (!$getSearch) {
                                                                        echo '<a class="new_cat_btn" href="' . tep_href_link(FILENAME_CATEGORIES,
                                                                                'cPath=' . $cPath . '&action=new_category') . '">' . tep_text_button(BUTTON_NEW_CATEGORY_NEW) . '</a>&nbsp;&nbsp;';
                                                                    }
                                                                    echo '<a class="new_product_btn" href="' . tep_href_link(FILENAME_PRODUCTS,
                                                                            'cPath=' . $cPath . '&action=new_product') . '">' . tep_text_button(BUTTON_NEW_PRODUCT_NEW) . '</a>'; ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <?php
                        }
                        ?>
                        </td>
                        <!-- body_text_smend //--></tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</div>
<script language="javascript"
        src="includes/general.js?t=<?= filesize(__DIR__ . DIRECTORY_SEPARATOR . DIR_WS_INCLUDES . 'general.js') ?>"></script>
<script src="includes/javascript/jquery-ui-1.9.2.custom.min.js"></script>
<script>
    var admin_folder = "<?=$admin?>";
    var add_folder = "<?=$add_folder?>";

    $(function () {
        // language tabs
        $('#tabs').tabs({fx: {opacity: 'toggle', duration: 'fast'}});
        // открываем селектбокс с категориями:
        $('#left_cats').attr('size', $('#left_cats option').length);
        // опускаемся до выбранного товара:
        scrollToEl('.dataTableRowOver');
        function scrollToEl(element){
          var $el = jQuery(element);
          if ($el.length) {
              var $elOffset_top = $el.offset().top - 200;
              jQuery('body,html').stop(false, false).animate({scrollTop: $elOffset_top}, {
                  duration: 600,
                  easing: 'swing'
              }, 800);
          }
        }
    });
</script>

<?php if ($_GET['action'] == 'new_category_ACD' || $_GET['action'] == 'edit_category_ACD') { ?>
    <script src="includes/ckeditor/ckeditor.js"></script>
    <script src="includes/ckfinder/ckfinder.js"></script>
    <script>
        $(function () {
            // CKEDITOR.disableAutoInline = true;

            $(".ck_replacer").on('click', function () {
                $(this).hide();
                var textarea = $(this).parent().find('textarea');
                var editor = CKEDITOR.replace(textarea.attr('name'), {
                    extraPlugins: 'colorbutton,font,showblocks,justify,codemirror,btgrid',
                    startupFocus: true,
                    removePlugins: 'sourcearea',
                    on: {
                        instanceReady: function () {
                            this.dataProcessor.htmlFilter.addRules({
                                elements: {
                                    img: function (el) {
                                        // Add an attribute.
                                        if (!el.attributes.alt)
                                            el.attributes.alt = '';

                                        // Add some class.
                                        if (typeof el.attributes.class === 'undefined' || el.attributes.class.indexOf('img-responsive') == -1) {
                                            el.addClass(' img-responsive');
                                        }
                                        if (typeof el.attributes.class === 'undefined' || el.attributes.class.indexOf('lazyload') == -1) {
                                            el.addClass(' lazyload');
                                        }
                                        el.attributes.style = '';
                                    }
                                }
                            });
                        }
                    }
                });
                editor.on('change', function (evt) {
                    $(textarea).text(evt.editor.getData());
                });
                CKFinder.setupCKEditor(editor, (add_folder ? '/' + add_folder : '') + '/' + admin_folder + '/includes/ckfinder/');
            });
        });
    </script>
<?php } ?>


<?php

/**
 * footer
 */

include_once('footer.php');
include_once('html-close.php');

?>

<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
