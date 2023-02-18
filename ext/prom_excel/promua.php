<?php

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

/**
 * Created by PhpStorm.
 * User: 'Serhii.M'
 * Date: 16.04.2019
 * Time: 16:19
 */


function saveImg($url)
{
    global $imageFolder,$upload_images;
    $imageFolder = $imageFolder ?: DIR_WS_IMAGES;
    $filename_arr = explode('/', $url);
    $filename = end($filename_arr);
    if ($upload_images) {
        if (!file_exists($imageFolder . 'products/' . $filename)) {
            $img = file_get_contents($url);
            /*
                $imagesize = getimagesize($url);
                $end = '';
                if ($imagesize["mime"] == 'image/gif') {
                    $end = ".gif";
                } elseif ($imagesize["mime"] == 'image/png') {
                    $end = ".png";
                } elseif ($imagesize["mime"] == 'image/jpeg') {
                    $end = ".jpg";
                }
                $filename = explode('.', $filename);
                array_pop($filename);
                $filename = implode('_', $filename) . $end;
            */
            if (!file_exists($imageFolder . 'products/')) {
                mkdir($imageFolder . 'products/');
            }
            $path = $imageFolder . 'products/' . $filename;
            file_put_contents($path, $img);
        }
    }
    return $filename;
}


ini_set('max_execution_time', '0');
ini_set('memory_limit', '1024M');
ini_set('display_errors', '1');

if (!(isset($file_path) && isset($current_currency) && isset($current_lang))) {
    chdir('../../');
    $imageFolder = DIR_WS_IMAGES;
    $rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
    require $rootPath . '/includes/application_top.php';

    $lang_id = isset($_GET['lang']) ? (int)$_GET['lang'] : 1;
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
    $default_currency = isset($_GET['c']) ? strtoupper($_GET['c']) : 'USD';
    $file = __DIR__ . '/exportg.xlsx';
    $upload_images = isset($upload_images) ? $upload_images : true;
    $truncate_table = isset($truncate_table) ? $truncate_table : true;
} else {
    $imageFolder = DIR_FS_CATALOG_IMAGES;
    $file = $file_path;
    $default_currency = $current_currency;
    $lang_id = $current_lang;
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 30;
}
$lng = new language();
$reader =  ReaderEntityFactory::createXLSXReader();
$reader->open($file);
$first = true;
$productsArray = [];
$fields = [
    'Код_товара' => 'model_main',//'Уникальный_идентификатор'
    'Название_позиции' => 'products_name', //Название_позиции,
    'Название_позиции_укр' => 'products_name_uk',
    'Поисковые_запросы' => 'products_head_keywords_tag',//Поисковые_запросы
    'Поисковые_запросы_укр' => 'products_head_keywords_tag_uk',
    'Описание' => 'products_description', // Описание
    'Описание_укр' => 'products_description_uk',
    'Цена' => 'products_price', //Цена
    'HTML_заголовок' => 'products_head_title_tag', //Цена
    'HTML_заголовок_укр' => 'products_head_title_tag_uk',
    'HTML_описание' => 'products_head_desc_tag', //Цена
    'HTML_описание_укр' => 'products_head_desc_tag_uk',
    'Валюта' => 'currency', // Валюта
    'Ссылка_изображения' => 'products_image',//Ссылка_изображения
    'Наличие' => 'products_stock', //Наличие
    'Количество' => 'products_quantity', //Количество
    'Номер_группы' => 'categories_id_old', //номер группы
    'Идентификатор_группы' => 'categories_id_new', //Идентификатор_группы
    'Уникальный_идентификатор' => 'model',//'Уникальный_идентификатор'
    'Производитель' => 'brand', //Производитель
    'Скидка' => 'specials_new_products_price',//'Скидка',
    'Продукт_на_сайте' => 'products_url',//'Продукт_на_сайте'
    'Cрок действия скидки от' => 'specials_date_added',//'Cрок действия скидки от'
    'Cрок действия скидки до' => 'expires_date',//'Cрок действия скидки до'
    //'Meta Title' => 'products_head_title_tag',//'meta title'
    //'Meta Description' => 'products_head_desc_tag',//'meta description'
    'Название_Характеристики' => 'Название_Характеристики',
    'Измерение_Характеристики' => 'Измерение_Характеристики',
    'Значение_Характеристики' => 'Значение_Характеристики',
];
$catFields = [
    'Номер_группы' => 'categories_id',
    'Название_группы' => 'categories_name',
    'Название_группы_укр' => 'categories_name_uk',
//    'Идентификатор_группы'=>'parent_id',
    'Номер_родителя' => 'parent_id',
    'URL' => 'categories_seo_url',
    'HTML_заголовок_группы' => 'categories_meta_title',
    'HTML_заголовок_группы_укр' => 'categories_meta_title_uk',
    'HTML_описание_группы' => 'categories_meta_description',
    'HTML_описание_группы_укр' => 'categories_meta_description_uk',
    'HTML_ключевые_слова_группы' => 'categories_meta_keywords',
    'HTML_ключевые_слова_группы_укр' => 'categories_meta_keywords_uk',
];
#todo убрать зависимость от массива сверху
$attr_array = $attributes_array = $categories_array = $manufacturers = $products_manufacturers = $specials = [];
$productsCounter = $categoriesCounter = $manufacturersCounter = $attributesCounter = $attrValuesCounter = 0;
$fieldsGenerated = $catFieldsGenerated = [];
$attrStartId = 0;
foreach ($reader->getSheetIterator() as $sheet) {
    if ($sheet->getName() === 'Export Products Sheet') {
        foreach ($sheet->getRowIterator() as $key => $row) {
            $row = $row->toArray();
            if ($first) {
                foreach ($row as $key => $fieldName) {
                    if (isset($fields[$fieldName])) {
                        $fieldsGenerated[$key] = $fields[$fieldName];
                    }
                    if ($fieldName == 'Название_Характеристики' && $attrStartId == 0) {
                        $attrStartId = $key;
                    }
                }
                $first = false;
                continue;
            }
            $productArray = [];
            $productArrayAttr = [];
            $i = 0;
            $pId = 0;
            $product_attributes = [];
            foreach ($row as $k => $v) {
                if (isset($fieldsGenerated[$k]) && ($attrStartId === 0 || $k < $attrStartId)) {
                    $productArray[$fieldsGenerated[$k]] = $v;
                    if ($fieldsGenerated[$k] == 'model') {
                        $pId = $v;
                    }
                }
                if ($attrStartId && $k >= $attrStartId && $k < 195) {
                    $productArrayAttrOne[$i] = $v;
                    $i++;
                    if ($i == 3) {
                        if ($productArrayAttrOne[0]) {
                            $fullname = $productArrayAttrOne[0] . ($productArrayAttrOne[1] ? ', ' . $productArrayAttrOne[1] : '');
                            $attribute = (string)$productArrayAttrOne[2];
                            $product_attributes[$fullname] = $attribute;
                            $attributes_array[$fullname][(string)$attribute] = $attribute;
                        }
                        $i = 0;
                        $productArrayAttrOne = [];
                    }
                }
            }
            $attr_array[$pId] = $product_attributes;
            $productsArray[] = $productArray;
            //             if ($key == $limit) break;
            // $row - строка таблицы в виде массива
        }
    } elseif ($sheet->getName() === 'Export Groups Sheet') {
        $first = true;
        foreach ($sheet->getRowIterator() as $key => $row) {
            $row = $row->toArray();
            if ($first) {
                foreach ($row as $key => $fieldName) {
                    if (isset($catFields[$fieldName])) {
                        $catFieldsGenerated[$key] = $catFields[$fieldName];
                    }
                }
                $first = false;
                continue;
            }
            $category = [];

            foreach ($row as $k => $v) {
                if (isset($catFieldsGenerated[$k])) {
                    $category[$catFieldsGenerated[$k]] = empty($category[$catFieldsGenerated[$k]]) ? $v : $category[$catFieldsGenerated[$k]];
                }
            }
            if (!empty($category['categories_seo_url'])) {
                $seoUrl = preg_replace('/http(s?):\/\/(.*)\/g(\d+)-/', '', $category['categories_seo_url']);
            } else {
                $seoUrl = '';
            }
            $categories_array[intval($category['parent_id'])][$category['categories_id']] = [
                'name' => $category['categories_name'],
                'name_uk' => $category['categories_name_uk'],
                'categories_meta_title' => $category['categories_meta_title'],
                'categories_meta_title_uk' => $category['categories_meta_title_uk'],
                'categories_meta_description' => $category['categories_meta_description'],
                'categories_meta_description_uk' => $category['categories_meta_description_uk'],
                'categories_meta_keywords' => $category['categories_meta_keywords'],
                'categories_meta_keywords_uk' => $category['categories_meta_keywords_uk'],
                'seo_url' => $seoUrl,
            ];
        }
    }
}
unset($reader);

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
    tep_db_query("TRUNCATE TABLE `specials`;");
}

foreach ($productsArray as $productArray) {
    $productsCounter++;
    $images_raw = explode(',', $productArray['products_image']);
    $images = [];
    foreach ($images_raw as $image) {
        $images[] = saveImg(trim($image));
    }
    $images = implode(';', $images);
    $pId = $productArray['model'] ?: $productsCounter;
    $products_price = (($productArray['products_price'] && $productArray['currency']) ? $productArray['products_price'] / $currencies->currencies[$productArray['currency']]['value'] : 0);
    $products_array = [
        'products_id' => $pId,
        'products_model' => $productArray['model_main'] ?: $productArray['model'],
        'products_status' => 1,
        'products_quantity' => $productArray['products_quantity'],
        'products_image' => $images,
        'products_price' => $products_price
    ];
    tep_db_perform(TABLE_PRODUCTS, $products_array, 'insertodku');
    $manufacturers[$pId] = $productArray['brand'];
    $products_manufacturers[$productArray['brand']] = $productArray['brand'];
    $products_to_categories_array = [
        'categories_id' => $productArray['categories_id_old'] ?: $productArray['categories_id_new'],
        'products_id' => $pId,
    ];
    tep_db_perform(TABLE_PRODUCTS_TO_CATEGORIES, $products_to_categories_array, 'insertodku');
    $pUrl = explode('/', $productArray['products_url']);
    $pUrl = array_pop($pUrl);
    $product_url = str_replace('p' . $productArray['model'] . '-', '', explode('.', $pUrl)[0]);
    foreach ($lng->catalog_languages as $lang) {
        if ($lang['id'] == 5) {
            $products_descriptions = [
                'products_id' => $pId,
                'products_name' => $productArray['products_name_uk'],
                'products_url' => $product_url,
                'products_description' => $productArray['products_description_uk'],
                'products_head_keywords_tag' => $productArray['products_head_keywords_tag_uk'],
                'products_head_title_tag' => $productArray['products_head_title_tag_uk'],
                'products_head_desc_tag' => $productArray['products_head_desc_tag_uk'],
                'language_id' => $lang['id']
            ];
        } else {
            $products_descriptions = [
                'products_id' => $pId,
                'products_name' => $productArray['products_name'],
                'products_url' => $product_url,
                'products_description' => $productArray['products_description'],
                'products_head_keywords_tag' => $productArray['products_head_keywords_tag'],
                'products_head_title_tag' => $productArray['products_head_title_tag'],
                'products_head_desc_tag' => $productArray['products_head_desc_tag'],
                'language_id' => $lang['id']
            ];
        }
        tep_db_perform(TABLE_PRODUCTS_DESCRIPTION, $products_descriptions, 'insertodku');
    }
    if ($productArray['specials_new_products_price'] && $productArray['specials_date_added'] && $productArray['expires_date']) {
        unset($specials_price);
        if (substr($productArray['specials_new_products_price'], -1) == '%') {
            $specials_price = ($products_price - (($productArray['specials_new_products_price'] / 100) * $products_price));
        }

        $specials = [
            'products_id' => $pId,
            'specials_new_products_price' => $specials_price ?: $products_price,
            'specials_date_added' => date('Y-m-d H:i:s', strtotime($productArray['specials_date_added'])),
            'specials_last_modified' => null,
            'expires_date' => date('Y-m-d H:i:s', strtotime($productArray['expires_date'])),
        ];
        tep_db_perform(TABLE_SPECIALS, $specials, 'insertodku');
    }
}
ksort($categories_array);
$categories_array = tep_db_prepare_input($categories_array);
//var_dump($categories_array);die;
foreach ($categories_array as $parent_id => $childs) {
    $categoriesCounter++;
    foreach ($childs as $child_id => $info) {
        $category = [
            'categories_id' => $child_id,
            'parent_id' => $parent_id,
            'categories_status' => 1,
        ];
        tep_db_perform(TABLE_CATEGORIES, $category, 'insertodku');
        foreach ($lng->catalog_languages as $lang) {
            if ($lang['id'] == 5) {
                $category_description = [
                    'categories_id' => $child_id,
                    'categories_name' => $info['name_uk'],
                    'categories_seo_url' => $info['seo_url'],
                    'categories_meta_title' => $info['categories_meta_title_uk'],
                    'categories_meta_description' => $info['categories_meta_description_uk'],
                    'categories_meta_keywords' => $info['categories_meta_keywords_uk'],
                    'language_id' => $lang['id'],
                ];
            } else {
                $category_description = [
                    'categories_id' => $child_id,
                    'categories_name' => $info['name'],
                    'categories_seo_url' => $info['seo_url'],
                    'categories_meta_title' => $info['categories_meta_title'],
                    'categories_meta_description' => $info['categories_meta_description'],
                    'categories_meta_keywords' => $info['categories_meta_keywords'],
                    'language_id' => $lang['id'],
                ];
            }
            tep_db_perform(TABLE_CATEGORIES_DESCRIPTION, $category_description, 'insertodku');
        }
    }
}

$option_name_to_id = [];
$option_values_name_to_id = [];
$optionsIdByNamesMap = [];
$option_id = (int)tep_db_fetch_array(tep_db_query("SELECT MAX(`products_options_id`) as max FROM products_options"))['max'];
$option_value_id = (int)tep_db_fetch_array(tep_db_query("SELECT MAX(`products_options_values_id`) as max FROM products_options_values"))['max'];
if (!empty($attributes_array)) {
    $optionNamesArray = array_keys($attributes_array);
    $optionNamesArray = array_map(
        function ($a) {
            return "'{$a}'";
        },
        $optionNamesArray
    );
    $optionNamesList = implode(',', $optionNamesArray);
    $optionIdByNames = tep_db_query(
        "SELECT products_options_id, products_options_name FROM " . TABLE_PRODUCTS_OPTIONS . " WHERE products_options_name in ($optionNamesList)"
    );
    while ($option = tep_db_fetch_array($optionIdByNames)) {
        $optionsIdByNamesMap[$option['products_options_name']] = $option['products_options_id'];
    }
}
foreach ($attributes_array as $option_name => $values_array) {
    if (isset($optionsIdByNamesMap[$option_name])) {
        $optionId = $optionsIdByNamesMap[$option_name];
    } else {
        $option_id++;
        $optionId = $option_id;
    }
    foreach ($lng->catalog_languages as $lang) {
        $option = [
            'products_options_id' => $optionId,
            'language_id' => $lang['id'],
            'products_options_name' => $option_name,
            'products_options_type' => 0
        ];
        tep_db_perform(TABLE_PRODUCTS_OPTIONS, $option, 'insertodku');
    }

    $attributesCounter++;
    //        $option_id = tep_db_insert_id();
    $option_name_to_id[$option_name] = $optionId;
    $optionsValuesIdByNamesMap = [];

    if (!empty($values_array)) {
        $optionValuesNamesArray = array_keys($values_array);
        $optionValuesNamesArray = array_map(
            function ($a) {
                return "'" . addslashes($a) . "'";
            },
            $optionValuesNamesArray
        );
        $optionValuesNamesList = implode(',', $optionValuesNamesArray);
        $optionValuesIdByNames = tep_db_query(
            "SELECT pov.products_options_values_id, pov.products_options_values_name FROM " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov
        left join " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " povpo ON pov.products_options_values_id = povpo.products_options_values_id 
    WHERE products_options_values_name in ($optionValuesNamesList) and povpo.products_options_id = {$optionId}"
        );
        while ($option = tep_db_fetch_array($optionValuesIdByNames)) {
            $optionsValuesIdByNamesMap[$option['products_options_values_name']] = $option['products_options_values_id'];
        }
    }
    foreach ($values_array as $value) {
        $attrValuesCounter++;
        if (isset($optionsValuesIdByNamesMap[$value])) {
            $optionValueId = $optionsValuesIdByNamesMap[$value];
        } else {
            $option_value_id++;
            $optionValueId = $option_value_id;
        }
        foreach ($lng->catalog_languages as $lang) {
            $oValues = [
                'products_options_values_id' => $optionValueId,
                'language_id' => $lang['id'],
                'products_options_values_name' => $value
            ];
            tep_db_perform(TABLE_PRODUCTS_OPTIONS_VALUES, $oValues, 'insertodku');
        }

        if (isset($optionsValuesIdByNamesMap[$value])) {
            $ovalue_id = $optionsValuesIdByNamesMap[$value];
        } else {
            $ovalue_id = tep_db_insert_id();
        }
        $option_values_name_to_id[$optionId][$value] = $ovalue_id;
        $optionsValuesToOption = [
            'products_options_id' => $optionId,
            'products_options_values_id' => $ovalue_id
        ];
        tep_db_perform(TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS, $optionsValuesToOption, 'insertodku');
    };
}
$current_products_attributes = tep_db_query("SELECT products_attributes_id, products_id, options_id, options_values_id FROM " . TABLE_PRODUCTS_ATTRIBUTES);
$currentPaArray = [];
while ($row = tep_db_fetch_array($current_products_attributes)) {
    $pIdOIdOvId = implode('_', [$row['products_id'], $row['options_id'], $row['options_values_id']]);
    $currentPaArray[$pIdOIdOvId] = $row['products_attributes_id'];
}
foreach ($attr_array as $pId => $attr) {
    foreach ($attr as $option_name => $option_value) {
        $oId = $option_name_to_id[$option_name];
        $ovId = $option_values_name_to_id[$oId][$option_value];
        $prod_attr_array = [
            'products_id' => $pId,
            'options_id' => $oId,
            'options_values_id' => $ovId,
            'options_values_price' => '',
            'pa_qty' => 1
        ];
        if (isset($currentPaArray[implode('_', [$pId,$oId,$ovId])])) {
            $prod_attr_array['products_attributes_id'] = $currentPaArray[implode('_', [$pId,$oId,$ovId])];
        }
        tep_db_perform(TABLE_PRODUCTS_ATTRIBUTES, $prod_attr_array, 'insertodku');
    }
}
$brand_name_to_id_array = [];
foreach ($products_manufacturers as $manufacturer_name) {
    $manufacturersCounter++;
    $manufacturer_array = [
        'status' => 1
    ];
    tep_db_perform(TABLE_MANUFACTURERS, $manufacturer_array, 'insertodku');
    $mId = tep_db_insert_id();
    foreach ($lng->catalog_languages as $lang) {
        $manufacturer_info_array = [
            'manufacturers_id' => $mId,
            'manufacturers_name' => $manufacturer_name,
            'languages_id' => $lang['id']
        ];

        $brand_name_to_id_array[$manufacturer_name] = $mId;
        tep_db_perform(TABLE_MANUFACTURERS_INFO, $manufacturer_info_array, 'insertodku');
    }
}
foreach ($manufacturers as $pId => $manufacturer_name) {
    $mId = $brand_name_to_id_array[$manufacturer_name];
    tep_db_query("UPDATE products SET manufacturers_id = $mId WHERE products_id = '{$pId}'");
}

$exportLog = <<<EXPORTLOG
Добавлено товаров: $productsCounter      </br>
Добавлено категорий: $categoriesCounter    </br>
Добавлено производителей: $manufacturersCounter </br> 
Добавлено атрибутов: $attributesCounter    </br>
Добавлено значений атрибутов: $attrValuesCounter    </br>

EXPORTLOG;
