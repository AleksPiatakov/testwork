<?php
/*
  $Id: categories.php,v 1.7 21.05.2013 by solomono
*/
require('includes/application_top.php');

// include seo.class.php
include_once('../' . DIR_WS_CLASSES . 'seo.class.php');
if (!isset($seo_urls) || !is_object($seo_urls)) {
    $seo_urls = new SEO_URL($languages_id);
}

$action = (isset($_GET['action']) ? $_GET['action'] : '');
$exceptAction = [
    'new_product',
    'insert_product'
];
$product_query = tep_db_query("select products_id from " . TABLE_PRODUCTS . " where products_id = " . (int)$_GET['pID']);
if(!$product_query->num_rows && !in_array($action, $exceptAction)){
    tep_redirect(tep_href_link(FILENAME_CATEGORIES, tep_get_all_get_params(array('cID','action'))));
    exit();
}
require(DIR_WS_CLASSES . 'currencies.php');
$currencies = new currencies();

global $current_category_id;
$action = (isset($_GET['action']) ? $_GET['action'] : '');

// Ultimate SEO URLs v2.1
// If the action will affect the cache entries
if (preg_match('/(insert|update|setflag)/i', $action)) {
    include_once('includes/reset_seo_cache.php');
}

if (tep_not_null($action)) {
    switch ($action) {
        case 'add_image':
            $result = $_GET['pID'];
            $query = tep_db_query("select products_image from " . TABLE_PRODUCTS . " where products_id = " . (int)$_GET['pID']);
            if($query->num_rows){
                $row = tep_db_fetch_array($query);
                $images = $row['products_image'];
                $imagesArray = explode(';',$images);
                $newImage = str_replace('/images/products/','',tep_db_prepare_input($_POST['imagePath']));
                if(!in_array($newImage,$imagesArray)){
                    $imagesArray[] = $newImage;
                    tep_db_query("UPDATE " . TABLE_PRODUCTS . " SET products_image = '".implode(';',$imagesArray)."' where products_id = " . (int)$_GET['pID']);
                }
            }
            echo json_encode(['success'=>true]);
            exit;
        case 'insert_product':
        case 'update_product':
            if (isset($_POST['edit_x']) || isset($_POST['edit_y'])) {
                $action = 'new_product';
            } else {
                if (isset($_GET['pID'])) {
                    $products_id = tep_db_prepare_input($_GET['pID']);
                } else {
                    $_POST['products_status'] = 1;
                }

                $products_date_available = tep_db_prepare_input($_POST['products_date_available']);
                $products_date_available = (date('Y-m-d') < $products_date_available) ? $products_date_available : date('Y-m-d');

                $sql_data_array = array(
                    'products_quantity' => tep_db_prepare_input($_POST['products_quantity']),
                    'is_download_product' => tep_db_prepare_input($_POST['is_download_product'] ? 1 : 0),
                    'products_model' => tep_db_prepare_input($_POST['products_model']),
                    'products_price' => tep_db_prepare_input($_POST['products_price'] ?: 0),
                    'products_date_available' => $products_date_available,
                    'products_weight' => tep_db_prepare_input($_POST['products_weight'] ?: 0.00),
                    'products_free_ship' => tep_db_prepare_input($_POST['products_free_ship'] ? 1 : 0),
                    'lable_1' => tep_db_prepare_input($_POST['lable_1'] ? 1 : 0),
                    'lable_2' => tep_db_prepare_input($_POST['lable_2'] ? 1 : 0),
                    'lable_3' => tep_db_prepare_input($_POST['lable_3'] ? 1 : 0),
                    'edited_for_seo' => tep_db_prepare_input($_POST['edited_for_seo'] ? 1 : 0),
                    'products_robots_status' => tep_db_prepare_input($_POST['products_robots_status'] ? 1 : 0),
                    'products_status' => tep_db_prepare_input($_POST['products_status'] ? 1 : 0),
                    'products_to_xml' => tep_db_prepare_input($_POST['products_to_xml'] ?: 1),
                    'products_tax_class_id' => tep_db_prepare_input($_POST['products_tax_class_id'] ?: 0),
                    'products_quantity_order_min' => tep_db_prepare_input($_POST['products_quantity_order_min']),
                    'products_quantity_order_units' => tep_db_prepare_input($_POST['products_quantity_order_units']),
                    'products_sort_order' => tep_db_prepare_input($_POST['products_sort_order'] ?: 0),
                    'manufacturers_id' => tep_db_prepare_input($_POST['manufacturers_id'] ?: 0)
                );

                $prices_num = tep_xppp_getpricesnum();
                for ($i = 2; $i <= $prices_num; $i++) {
                    if (tep_db_prepare_input($_POST['checkbox_products_price_' . $i]) != "true") {
                        $sql_data_array['products_price_' . $i] = 'null';
                    } else {
                        $sql_data_array['products_price_' . $i] = tep_db_prepare_input($_POST['products_price_' . $i]);
                    }
                }

                if ($action == 'insert_product') {
                    $last_sort_order = getLastSortOrder('products');
                    $insert_sql_data = array(
                        'products_date_added' => 'now()',
                        'products_sort_order' => (int)$last_sort_order + 1
                    );
                    $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

                    tep_db_perform(TABLE_PRODUCTS, $sql_data_array);
                    $products_id = tep_db_insert_id();

                    tep_db_query("insert into " . TABLE_PRODUCTS_TO_CATEGORIES . " (products_id, categories_id) values ('" . (int)$products_id . "', '" . (int)$current_category_id . "')");

                } elseif ($action == 'update_product') {
                    $update_sql_data = array('products_last_modified' => 'now()');
                    $sql_data_array = array_merge($sql_data_array, $update_sql_data);

                    tep_db_perform(TABLE_PRODUCTS, $sql_data_array, 'update', "products_id = '" . (int)$products_id . "'");
                }

                $languages = tep_get_languages();
                if (is_file(DIR_FS_CATALOG_MODULES . 'cyrillic_conversion.php')) {
                    include_once DIR_FS_CATALOG_MODULES . 'cyrillic_conversion.php';
                }

                for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                    $language_id = $languages[$i]['id'];
                    $products_url = !empty($_POST['products_url'][$language_id]) ? $_POST['products_url'][$language_id] : tep_db_prepare_input($_POST['products_name'][$language_id]);
                    $products_url = is_string($products_url) ? $products_url : '';
                    if (isset($cyryllic) && is_array($cyryllic)) {
                        $products_url = strtr($products_url, $cyryllic);
                    }

                    if (isset($seo_urls) && is_object($seo_urls)) {
                        $products_url = $seo_urls->strip(tep_db_prepare_input($products_url));
                    } else {
                        $products_url = tep_db_prepare_input($products_url);
                    }
                    $products_url = str_replace(' ', '-', $products_url);
                    $products_url = mb_ereg_replace("[^-a-zA-Z0-9]", "", $products_url);
                    $products_url = strtolower($products_url);

                    $sql_data_array = array(
                        'products_name' => tep_db_prepare_input($_POST['products_name'][$language_id]),
                        'products_info' => tep_db_prepare_input($_POST['products_info'][$language_id]),
                        'products_description' => tep_db_prepare_input($_POST['products_description'][$language_id]),
                        'products_url' => $products_url,
                        'products_head_title_tag' => tep_db_prepare_input($_POST['products_head_title_tag'][$language_id]),
                        'products_head_desc_tag' => tep_db_prepare_input($_POST['products_head_desc_tag'][$language_id]),
                        'products_head_keywords_tag' => tep_db_prepare_input($_POST['products_head_keywords_tag'][$language_id])
                    );

                    $check_query = tep_db_query("select * from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$products_id . "' and language_id = " . (int)$language_id);
                    if (!tep_db_num_rows($check_query)) {
                        $add_lang = true;
                    } else {
                        $add_lang = false;
                    }

                    if ($action == 'insert_product' or $add_lang) {
                        $insert_sql_data = array(
                            'products_id' => $products_id,
                            'language_id' => $language_id
                        );

                        $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

                        tep_db_perform(TABLE_PRODUCTS_DESCRIPTION, $sql_data_array);
                    } elseif ($action == 'update_product') {
                        tep_db_perform(TABLE_PRODUCTS_DESCRIPTION, $sql_data_array, 'update', "products_id = '" . (int)$products_id . "' and language_id = '" . (int)$language_id . "'");
                    }
                }
                tep_db_query("DELETE FROM " . TABLE_PRODUCTS_VIDEO . " WHERE products_id = '" . (int)$products_id . "'");
                if(!empty($_POST['products_video'])) {
                    foreach ($_POST['products_video'] as $video) {
                        $video['video_url'] = checkAndFixYoutubeUrl($video['video_url']);
                        $video['video_preview'] = setVideoImagePreview($video['video_url']);
                        tep_db_perform(TABLE_PRODUCTS_VIDEO, $video, 'insertodku');

                    }
                }

                /** AJAX Attribute Manager  **/
                require_once('attributeManager/includes/attributeManagerUpdateAtomic.inc.php');
                /** AJAX Attribute Manager  end **/

                tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath));
//                tep_redirect(tep_href_link(FILENAME_PRODUCTS, 'cPath=' . $cPath . '&pID=' . $products_id . '&action=new_product'));
            }
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
include_once('html-open.php');
include_once('header.php');
?>

    <!-- AJAX Attribute Manager  -->
<?php require_once('attributeManager/includes/attributeManagerHeader.inc.php') ?>
    <!-- AJAX Attribute Manager  end -->
    <link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
    <link rel="stylesheet" href="../includes/javascript/jqueryui/css/smoothness/jquery-ui-1.10.4.custom.min.css">
    <link rel="stylesheet" href="includes/solomono/css/overwrite.css" type="text/css"/>
    <link rel="stylesheet" href="includes/javascript/imagecrop/jquery.Jcrop.min.css" type="text/css"/>
    <style>
        .attr_img {
            position: relative;
            float: left;
            border: 1px solid #eee;
            margin: 10px 5px 0 0;
        }

        .attr_del {
            position: absolute;
            right: 0;
            top: 0;
            cursor: pointer;
        }

        .attr_crop {
            cursor: pointer;
        }
    </style>
    <style>
        small {
            color: #999;
        }
        @media (min-width: 1600px){
            .container {
                width: 1220px!important;
            }
        }

        @media (max-width: 480px) {
            .ui-widget.ui-widget-content {
                border: none;
                padding: 0px;
            }
            .container.edit_orders {
                padding: 0px;
            }
            .ui-tabs .ui-tabs-nav .ui-tabs-anchor {
                padding: 5px;
            }
            .main .new-style-btn input,
            .main input[type="submit"],
            .main input[type="button"] {
                color: #ffffff !important;
                background-color: #2172ff;
                border: 1px solid transparent;
                font-weight: 500;
                border-radius: 2px;
                outline: 0 !important;
                display: inline-block;
                padding: 6px 12px;
                margin-bottom: 0;
                font-size: 14px;
                line-height: 1.42857143;
                text-align: center;
                white-space: nowrap;
                vertical-align: middle;
            }
            #text {
                padding: 0;
            }
            #language-3 {
                padding: 5px;
            }
            #language-3 .main {
                padding: 0px;
                text-align: left;
            }

            .translate-box select {
                font-weight: 500;
                border-radius: 2px;
                outline: 0 !important;
                display: inline-block;
                padding: 8px 12px;
                margin-bottom: 0;
                font-size: 14px;
                line-height: 1.42857143;
                text-align: center;
                white-space: nowrap;
                vertical-align: middle;
                background: #ffffff;
            }
            .main-tr {
                padding: 3px;
            }
            .products_inner_left-cont tr td:last-of-type {
                padding: 0px;
            }
            .main textarea {
                border-radius: unset;
            }
            #attribs {
                padding: 5px;
            }
            #topBar tr{
                display: flex;
                flex-direction: column;
            }
            #attributeManager {
                min-width: unset;
            }
            #attributeManager #topBar {
                height: 75px;
            }
            #topBar tr td {
                display: flex;
                flex-wrap: wrap;
            }
        /*    tab attribute mobile */
            #currentAttributes .header {
                display: none;
            }
            #currentAttributes .option td {
                padding: 4px !important;
                display: flex;
                width: 100% !important;
            }
            #currentAttributes .option {
                border-bottom: 2px solid #ccc;
            }
        }
    </style>

    <style>
        td.main {
            padding: 2px;
        }
    </style>

    <div id="spiffycalendar" class="text"></div>

    <div class="container edit_orders">
        <?php
        if ($action == 'new_product') {
            $parameters = array(
                'products_name' => '',
                'products_info' => '',
                'products_description' => '',
                'products_url' => '',
                'products_id' => '',
                'products_quantity' => '',
                'products_model' => '',
                'products_price' => '',
                'products_weight' => '',
                'lable_1' => '',
                'lable_2' => '',
                'lable_3' => '',
                'edited_for_seo' => 0,
                'products_robots_status' => 1,
                'products_date_added' => '',
                'products_last_modified' => '',
                'products_date_available' => '',
                'products_status' => '',
                'products_to_xml' => '',
                'products_sort_order' => '',
                'products_tax_class_id' => '',
                'manufacturers_id' => ''
            );

            $prices_num = tep_xppp_getpricesnum();
            for ($i = 2; $i <= $prices_num; $i++) {
                $parameters['products_price_' . $i] = '';
            }

            $pInfo = new objectInfo($parameters);

            if (isset($_GET['pID']) && empty($_POST)) {
                $products_price_list = tep_xppp_getpricelist("p");
                $product_query = tep_db_query("select ptc.categories_id, p.products_free_ship, p.is_download_product, pd.products_name, pd.products_description, pd.products_head_title_tag, pd.products_head_desc_tag, pd.products_head_keywords_tag, p.edited_for_seo, pd.products_url, p.products_id, p.products_quantity, p.products_model, " . $products_price_list . ", p.products_weight, p.lable_1, p.lable_2, p.lable_3, p.products_date_added, p.products_last_modified, date_format(p.products_date_available, '%Y-%m-%d') as products_date_available, p.products_status, p.products_robots_status, p.products_to_xml, p.products_tax_class_id, p.products_quantity_order_min, p.products_quantity_order_units, p.products_sort_order, p.manufacturers_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " ptc where ptc.products_id = p.products_id and p.products_id = '" . (int)$_GET['pID'] . "' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "'");
                $product = tep_db_fetch_array($product_query);
                $cPath = $product['categories_id'];
                $pInfo->__construct($product);
            } elseif (tep_not_null($_POST)) {
                $pInfo->__construct($_POST);
                $products_name = $_POST['products_name'];
                $products_info = $_POST['products_info'];
                $products_description = $_POST['products_description'];
                $products_url = $_POST['products_url'];
            }
            $product['products_name'] = stripslashes($product['products_name']);
            $manufacturers_array = array(
                array(
                    'id' => '',
                    'text' => TEXT_NONE
                )
            );
            $manufacturers_query = tep_db_query("select manufacturers_id, manufacturers_name from " . TABLE_MANUFACTURERS_INFO . " where languages_id = $languages_id order by manufacturers_name");
            while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
                $manufacturers_array[] = array(
                    'id' => $manufacturers['manufacturers_id'],
                    'text' => $manufacturers['manufacturers_name']
                );
            }

            $tax_class_array = array(array('id' => '0', 'text' => TEXT_NONE));
            $tax_class_query = tep_db_query("select tax_class_id, tax_class_title from " . TABLE_TAX_CLASS . " order by tax_class_title");
            while ($tax_class = tep_db_fetch_array($tax_class_query)) {
                $tax_class_array[] = array('id' => $tax_class['tax_class_id'],
                    'text' => $tax_class['tax_class_title']);
            }

            $languages = tep_get_languages();

            if (!isset($pInfo->products_status)) {
                $pInfo->products_status = '1';
            }
            switch ($pInfo->products_status) {
                case '0':
                    $status = false;
                    break;
                case '1':
                default:
                    $status = true;
            }
            // лейбы:
            if (!isset($pInfo->lable_1)){
                $pInfo->lable_1 = '0';
            }
            switch ($pInfo->lable_1) {
                case '0':
                    $in_lable_1 = false;
                    $out_lable_1 = true;
                    break;
                case '1':
                    $in_lable_1 = true;
                    $out_lable_1 = false;
                    break;
                default:
                    $in_lable_1 = false;
                    $out_lable_1 = true;
            }
            if (!isset($pInfo->lable_2)) {
                $pInfo->lable_2 = '0';
            }
            switch ($pInfo->lable_2) {
                case '0':
                    $in_lable_2 = false;
                    $out_lable_2 = true;
                    break;
                case '1':
                    $in_lable_2 = true;
                    $out_lable_2 = false;
                    break;
                default:
                    $in_lable_2 = false;
                    $out_lable_2 = true;
            }
            if (!isset($pInfo->lable_3)){
                $pInfo->lable_3 = '0';
            }
            switch ($pInfo->lable_3) {
                case '0':
                    $in_lable_3 = false;
                    $out_lable_3 = true;
                    break;
                case '1':
                    $in_lable_3 = true;
                    $out_lable_3 = false;
                    break;
                default:
                    $in_lable_3 = false;
                    $out_lable_3 = true;
            }

            if (!isset($pInfo->edited_for_seo)) {
                $pInfo->edited_for_seo = '0';
            }
            $in_edited_for_seo = $pInfo->edited_for_seo == '1';
            $out_edited_for_seo = $pInfo->edited_for_seo == '0';

            // лейбы END

            //is_download_product
            if (!isset($pInfo->is_download_product)){
                $pInfo->is_download_product = '0';
            }
            switch ($pInfo->is_download_product) {
                case '0':
                    $in_is_download_product = false;
                    $out_is_download_product = true;
                    break;
                case '1':
                    $in_is_download_product = true;
                    $out_is_download_product = false;
                    break;
                default:
                    $in_is_download_product = false;
                    $out_is_download_product = true;
            }
            // is_download_product end

            //free shipping
            if (!isset($pInfo->products_free_ship)){
                $pInfo->products_free_ship = '0';
            }
            switch ($pInfo->products_free_ship) {
                case '0':
                    $in_products_free_ship = false;
                    $out_products_free_ship = true;
                    break;
                case '1':
                    $in_products_free_ship = true;
                    $out_products_free_ship = false;
                    break;
                default:
                    $in_products_free_ship = false;
                    $out_products_free_ship = true;
            }
            // free shipping end
            if (!isset($pInfo->products_to_xml)){
                $pInfo->products_to_xml = '1';
            }
            switch ($pInfo->products_to_xml) {
                case '0':
                    $in_xml = false;
                    $out_xml = true;
                    break;
                case '1':
                default:
                    $in_xml = true;
                    $out_xml = false;
            }

            $form_action = (isset($_GET['pID'])) ? 'update_product' : 'insert_product';
            echo tep_draw_form($form_action, FILENAME_PRODUCTS, 'cPath=' . $cPath . (isset($_GET['pID']) ? '&pID=' . $_GET['pID'] : '') . '&action=' . $form_action, 'post', 'enctype="multipart/form-data" id="product_edit_form"');
            ?>
                <table border="0" width="100%" cellspacing="0" cellpadding="3">
                    <tr class="ignore_height">
                        <td class="main" style="color:#777;">
                            <?php if (!$_GET['pID']) { ?>
                                <?php echo sprintf(TEXT_NEW_PRODUCT, tep_output_generated_category_path($current_category_id));
                            } else {
                                echo tep_output_generated_category_path($current_category_id) . ': ' . $product['products_name'];
                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                <tr>
                                    <td class="main"></td>
                                    <td class="main" align="right">
                                        <a class=""
                                           href="<?php echo HTTP_SERVER . '/product_info.php?products_id=' . $_GET['pID']; ?>"
                                           target="_blank">
                                            <i class="fa fa-external-link-square" aria-hidden="true"></i>
                                            <!--                                                        --><?//=  getConstantValue('BUTTON_QUICK_VIEW', ''); ?>
                                        </a>
                                        <?php
                                        if (isset($_GET['pID'])) {
                                            echo tep_image_submit('button_update.gif', IMAGE_UPDATE);
                                        } else {
                                            echo tep_image_submit('button_insert.gif', IMAGE_INSERT);
                                        }
                                        if (strstr($url_query, 'search')) {
                                            $temp_query = explode('&', $url_query);
                                            $temp_query = array_filter($temp_query, function ($str) {
                                                $a = explode('=', $str);
                                                $required_keys = array('search', 'x', 'y');
                                                return in_array($a[0], $required_keys);
                                            });
                                            $query_string = implode('&', $temp_query);
                                        } else {
                                            $query_string = ($cPath ? 'cPath=' . $cPath : '') . ($_GET['page'] ? '&page=' . $_GET['page'] : '') . (isset($_GET['pID']) ? '&pID=' . $_GET['pID'] : '');
                                        }

                                        echo '&nbsp;&nbsp;<a class="new-style-btn" href="' . tep_href_link(FILENAME_CATEGORIES, $query_string) . '">' . tep_text_button(BUTTON_BACK_NEW) . '</a>';
                                        ?>
                                    </td>
                                </tr>
                            </table>
                            <div id="tabs" class="tabs-preload">
                                <ul>
                                    <li>
                                        <a href="#text"><?php echo TEXT_PROD_TEXTS; ?></a>
                                    </li>
                                    <li>
                                        <a href="#images"><?php echo TEXT_PROD_IMGS; ?></a>
                                    </li>
                                    <li>
                                        <a href="#video"><?php echo TEXT_PROD_VIDEO; ?></a>
                                    </li>
                                    <li>
                                        <a href="#attribs"><?php echo TEXT_PROD_ATTRS; ?></a>
                                    </li>
                                    <li>
                                        <a href="#downloads"><?php echo TEXT_PROD_DOWNLOADS; ?></a>
                                    </li>

                                    <?php $qtyProFilename = $path . DIR_WS_EXT . 'qty_pro/' . FILENAME_STOCK;
                                    if (file_exists($qtyProFilename) && getConstantValue('QTY_PRO_ENABLED') == 'true') { ?>
                                        <li>
                                            <a href="#qtypro"><?php echo getConstantValue('QTY_PRO_ENABLED_TITLE', 'QTY Pro'); ?></a>
                                        </li>
                                    <?php } ?>

                                    <?php
                                    if (defined('XSELL_PRODUCTS_BUYNOW_ENABLED') && XSELL_PRODUCTS_BUYNOW_ENABLED == 'true') {
                                        echo '<li><a href="#xsells">', BOX_CATALOG_XSELL_PRODUCTS, '</a></li>';
                                    } elseif (!file_exists(DIR_FS_EXT . 'xsell_products_buynow')) {
                                        echo printMenuItemNotExist(BOX_CATALOG_XSELL_PRODUCTS, LINK_TO_SHOP, TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY, 'not-tab');
                                    } else {
                                        echo printMenuItemNotExist(BOX_CATALOG_XSELL_PRODUCTS, tep_href_link(FILENAME_CONFIGURATION, 'gID=277'), TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON, 'not-tab');
                                    }

                                    ?>

                                </ul>
                                <div id="text">
                                    <div class="products_inner_left">
                                        <div class="products_inner_left-cont">
                                            <div id="text__tabs">
                                                <ul>
                                                    <?php
                                                    $currLangDir = 'english';
                                                    foreach ($languages as $key => &$language) {
                                                        if ($language['id'] == $languages_id) {
                                                            $tmp = $languages[0];
                                                            $currLangDir = $language['directory'];
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
                                                <?php if (getConstantValue('AUTO_TRANSLATE_MODULE_ENABLED')) :
                                                    if (file_exists(DIR_FS_EXT . 'auto_translate/languages/' . $currLangDir . '/auto_translate.json')) {
                                                        includeLanguages(DIR_FS_EXT . 'auto_translate/languages/' . $currLangDir . '/auto_translate.json');
                                                    } elseif (file_exists(DIR_FS_EXT . 'auto_translate/languages/english/auto_translate.json')) {
                                                        includeLanguages(DIR_FS_EXT . 'auto_translate/languages/english/auto_translate.json');
                                                    } else {
                                                        define('TRANSLATE_FROM', 'Translate From');
                                                        define('BUTTON_TRANSLATE', 'Translate');
                                                    } ?>
                                                <?php endif; ?>
                                                <?php foreach ($languages as $language_key => $language_value) { ?>
                                                    <div id="language-<?php echo $language_value['id']; ?>">
                                                        <?php if (getConstantValue('AUTO_TRANSLATE_MODULE_ENABLED') == 'true') { ?>
                                                            <div class="translate-box" style="margin: 5px 0"
                                                                 id="translate-products">
                                                                <input type="hidden" name="product_id"
                                                                       value="<?= $product['products_id'] ?>">
                                                                <label for="default_language"><?= TRANSLATE_FROM ?></label>
                                                                <select name="default_language">
                                                                    <?php foreach ($languages as $_language) : ?>
                                                                        <option value="<?= $_language['code'] ?>">
                                                                            <?= $_language['name'] ?> <b
                                                                                    class="caret"></b>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <label>
                                                                    <input type="checkbox" name="remove_tags">
                                                                    <?= getConstantValue('REMOVE_TAGS'); ?>
                                                                </label>
                                                                <label>
                                                                    <input type="checkbox" name="ignore_existing">
                                                                    <?= getConstantValue('IGNORE_EXISTING'); ?>
                                                                </label>

                                                                <button id="translate" class="btn btn-info"
                                                                        type="submit"><?= getConstantValue('BUTTON_TRANSLATE') ?></button>
                                                            </div>
                                                        <?php } ?>
                                                        <table width="100%" border="0" cellspacing="0"
                                                               cellpadding="2">
                                                            <?php
                                                            $product_texts_array = array(array());
                                                            $product_texts_query = tep_db_query("select products_name, products_url, products_info, products_description, products_head_title_tag, products_head_keywords_tag, products_head_desc_tag, language_id from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$pInfo->products_id . "' order by language_id");
                                                            while ($product_texts = tep_db_fetch_array($product_texts_query)) {
                                                                if ($product_texts['language_id'] == $language_value['id']) {
                                                                    $product_texts_array[$language_value['id']] = array(
                                                                        'products_name' => stripslashes($product_texts['products_name']),
                                                                        'products_url' => $product_texts['products_url'],
                                                                        'products_info' => $product_texts['products_info'],
                                                                        'products_description' => stripcslashes($product_texts['products_description']),
                                                                        'products_head_title_tag' => $product_texts['products_head_title_tag'],
                                                                        'products_head_keywords_tag' => $product_texts['products_head_keywords_tag'],
                                                                        'products_head_desc_tag' => $product_texts['products_head_desc_tag']
                                                                    );
                                                                }
                                                            }
                                                            ?>
                                                            <tr class="main-tr" bgcolor="#cef0ff">
                                                                <td class="main"><?php
                                                                    echo TEXT_PRODUCTS_NAME; ?>

                                                                </td>
                                                                <td class="main">
                                                                    <table>
                                                                        <?php
                                                                        $r_products_name = tep_lol('products_name[' . $language_value['id'] . ']', (isset($products_name[$language_value['id']]) ? stripslashes($products_name[$language_value['id']]) : $product_texts_array[$language_value['id']]['products_name']), 'style="width:100%;"');
                                                                        $r_products_url = tep_lol('products_url[' . $language_value['id'] . ']', (isset($products_url[$language_value['id']]) ? stripslashes($products_url[$language_value['id']]) : $product_texts_array[$language_value['id']]['products_url']), 'style="width:60%;"');
                                                                        ?>

                                                                        <tr>
                                                                            <td class="main"><?php echo $r_products_name; ?></td>
                                                                            <td class="main"><?php echo TEXT_PROD_LINK; ?>
                                                                                :
                                                                                <?php echo $r_products_url; ?></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="main" valign="top">
                                                                    <?php echo TEXT_PRODUCTS_INFO . '<br />'; ?>
                                                                </td>
                                                                <td class="main"><?php echo tep_draw_textarea_field('products_info[' . $language_value['id'] . ']', 'soft', '105', '3', (isset($products_info[$language_value['id']]) ? $products_info[$language_value['id']] : $product_texts_array[$language_value['id']]['products_info']), 'class="notinymce" style="width:100%;height:80px;"'); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="main" valign="top">
                                                                    <?php echo TEXT_PRODUCTS_DESCRIPTION . '<br />'; ?>
                                                                </td>
                                                                <td>
                                                                    <div class="ckeditor_outer">
                                                                        <?php
                                                                        echo tep_draw_textarea_field('products_description[' . $language_value['id'] . ']', 'soft', '80', '20', (($products_description[$language_value['id']]) ? stripslashes($products_description[$language_value['id']]) : $product_texts_array[$language_value['id']]['products_description']));
                                                                        echo '<div class="ck_replacer">' . (($products_description[$language_value['id']]) ? stripslashes($products_description[$language_value['id']]) : str_replace('form', 'div', $product_texts_array[$language_value['id']]['products_description']) . '</div>');
                                                                        ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <!--  перенесла с прав. сайдбара  -->
                                                            <tr>
                                                                <td colspan="2" valign="top" class="main">
                                                                    <br/><?php echo TEXT_PRODUCTS_PAGE_TITLE; ?>&nbsp;
                                                                    <br/><?php echo tep_draw_textarea_field('products_head_title_tag[' . $language_value['id'] . ']', 'soft', '105', '1', (isset($products_head_title_tag[$language_value['id']]) ? $products_head_title_tag[$language_value['id']] : $product_texts_array[$language_value['id']]['products_head_title_tag']), 'style="width:100%;height:60px;"'); ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" valign="top"
                                                                    class="main"><?php echo TEXT_PRODUCTS_HEADER_DESCRIPTION; ?>
                                                                    &nbsp;
                                                                    <br/><?php echo tep_draw_textarea_field('products_head_desc_tag[' . $language_value['id'] . ']', 'soft', '105', '1', (isset($products_head_desc_tag[$language_value['id']]) ? $products_head_desc_tag[$language_value['id']] : $product_texts_array[$language_value['id']]['products_head_desc_tag']), 'style="width:100%;height:100px;"'); ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" valign="top"
                                                                    class="main"><?php echo TEXT_PRODUCTS_KEYWORDS; ?>
                                                                    &nbsp;
                                                                    <br/><?php echo tep_draw_textarea_field('products_head_keywords_tag[' . $language_value['id'] . ']', 'soft', '105', '1', (isset($products_head_keywords_tag[$language_value['id']]) ? $products_head_keywords_tag[$language_value['id']] : $product_texts_array[$language_value['id']]['products_head_keywords_tag']), 'style="width:100%;height:60px;"'); ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="products_inner_right">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="2">                                            
                                            <?php if (DISPLAY_PRICE_WITH_TAX == 'true' || DISPLAY_PRICE_WITH_TAX_CHECKOUT == 'true') { ?>
                                                <tr bgcolor="#ebebff">
                                                    <td class="main"><?php echo TEXT_PRODUCTS_TAX_CLASS; ?></td>
                                                    <td class="main"><?php echo tep_draw_pull_down_menu('products_tax_class_id', $tax_class_array, $pInfo->products_tax_class_id, 'onchange="updateGross()" style="width:150px;"'); ?></td>
                                                </tr>
                                            <?php } ?>
                                                        <?php $pInfo->products_price = cutToFirstSignificantDigit($pInfo->products_price); ?>
                                            <tr bgcolor="#cef0ff">
                                                <td class="main"><?php echo addDoubleDot(TEXT_PROD_PRICE); ?></td>
                                                <td class="main">
                                                    <?php echo tep_draw_hidden_field('products_to_xml', $pInfo->products_to_xml);
                                                    echo tep_draw_input_field('products_price', $pInfo->products_price, 'style="width:150px;" ' . ((DISPLAY_PRICE_WITH_TAX == 'true' || DISPLAY_PRICE_WITH_TAX_CHECKOUT == 'true') ? 'onchange="updateGross()"' : '')); ?>
                                                </td>
                                            </tr>

                                            <?php if (DISPLAY_PRICE_WITH_TAX == 'true' || DISPLAY_PRICE_WITH_TAX_CHECKOUT == 'true') { ?>
                                                <tr bgcolor="#ebebff">
                                                    <td class="main"><?php echo TEXT_PRODUCTS_PRICE_GROSS; ?></td>
                                                    <td class="main"><?php echo tep_draw_input_field('products_price_gross', $pInfo->products_price, 'onkeyup="updateNet()" style="width:150px;"'); ?></td>
                                                </tr>
                                            <?php } ?>

                                            <?php
                                            $prices_num = tep_xppp_getpricesnum();
                                                        for ($i = 2; $i <= $prices_num; $i++) {
                                                            $products_price_X_name = "products_price_" . $i;
                                                            $products_price_X_value = $pInfo->$products_price_X_name;
                                                            if ($products_price_X_value != null) {
                                                                $products_price_X_value = cutToFirstSignificantDigit($products_price_X_value);
                                                            } ?>
                                                <tr>
                                                    <td class="main"><?php echo TEXT_PROD_PRICE . " " . $i; ?>
                                                                    <input type="checkbox" name="<?php echo "checkbox_" . $products_price_X_name; ?>"
                                                                        <?php if ($products_price_X_value != null) {
                                                                            echo " checked ";
                                                                        } ?>
                                                                           value="true"
                                                                           onClick="if (!<?php echo $products_price_X_name; ?>.disabled) { <?php echo $products_price_X_name; ?>.disabled = true;  <?php echo $products_price_X_name . "_gross"; ?>.disabled = true; } else { <?php echo $products_price_X_name; ?>.disabled = false;  <?php echo $products_price_X_name . "_gross"; ?>.disabled = false; } ">
                                                    </td>
                                                                <td class="main">
                                                                    <?php if ($products_price_X_value == null) {
                                                                        echo tep_draw_input_field($products_price_X_name, $products_price_X_value, ', disabled', 'style="width:150px;"');
                                                        } else {
                                                                        echo tep_draw_input_field($products_price_X_name, $products_price_X_value, 'style="width:150px;"', '');
                                                                    } ?>
                                                                </td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td class="main"
                                                    width="140"><?php echo TEXT_PRODUCTS_MODEL; ?></td>
                                                <td class="main"><?php echo tep_draw_input_field('products_model', $pInfo->products_model, 'style="width:150px;"'); ?></td>
                                            </tr>
                                            <tr>
                                                <td class="main"><?php echo TEXT_PRODUCTS_MANUFACTURER; ?></td>
                                                <td class="main"><?php echo tep_draw_pull_down_menu('manufacturers_id', $manufacturers_array, $pInfo->manufacturers_id, 'style="width:150px;"'); ?></td>
                                            </tr>
                                            <tr>
                                                <td class="main"><?php echo addDoubleDot(TEXT_PRODUCT_STATUS); ?></td>
                                                <td class="main toggle-main">
                                                    <div class="status">
                                                        <input class="cmn-toggle cmn-toggle-round" name="products_status" type="checkbox" id="cmn-toggle-products_available" <?= $status ? 'checked' : '' ?>>
                                                        <label for="cmn-toggle-products_available"></label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <?php if (PRODUCT_LABELS_MODULE_ENABLED == 'true') { ?>
                                                <tr>
                                                    <td class="main"><?php echo addDoubleDot(TEXT_PROD_TOP); ?></td>
                                                    <td class="main toggle-main">
                                                        <div class="status">
                                                            <input class="cmn-toggle cmn-toggle-round" name="lable_1" type="checkbox" id="cmn-toggle-products_options_length_1" <?= $in_lable_1 ? 'checked' : '' ?>>
                                                            <label for="cmn-toggle-products_options_length_1"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="main"><?php echo addDoubleDot(TEXT_PROD_NEW); ?></td>
                                                    <td class="main toggle-main">
                                                        <div class="status">
                                                            <input class="cmn-toggle cmn-toggle-round" name="lable_2" type="checkbox" id="cmn-toggle-products_options_length_2" <?= $in_lable_2 ? 'checked' : '' ?>>
                                                            <label for="cmn-toggle-products_options_length_2"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="main"><?php echo addDoubleDot(TEXT_PROD_AKC); ?></td>
                                                    <td class="main toggle-main">
                                                        <div class="status">
                                                            <input class="cmn-toggle cmn-toggle-round" name="lable_3" type="checkbox" id="cmn-toggle-products_options_length_3" <?= $in_lable_3 ? 'checked' : '' ?>>
                                                            <label for="cmn-toggle-products_options_length_3"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <tr class="main-indent">
                                                <td class="main"><?php echo addDoubleDot(TEXT_PROD_WE); ?></td>
                                                <td class="main"><?php echo tep_draw_input_field('products_weight', $pInfo->products_weight, 'style="width:150px;"'); ?></td>
                                            </tr>
                                            <tr class="main-indent">
                                                <td class="main"><?php echo addDoubleDot(TEXT_PROD_SORT); ?></td>
                                                <td class="main"><?php echo tep_draw_input_field('products_sort_order', $pInfo->products_sort_order, 'style="width:150px;"'); ?></td>
                                            </tr>
                                            <tr class="main-indent">
                                                <td class="main"><?php echo addDoubleDot(TEXT_PROD_QTY); ?></td>
                                                <td class="main"><?php echo tep_draw_input_field('products_quantity', ($pInfo->products_quantity == '' ? 1 : $pInfo->products_quantity), 'style="width:150px;"') . tep_draw_hidden_field('r_oldquantity', $pInfo->products_quantity); ?></td>
                                            </tr>
                                            <tr class="main-indent">
                                                <td class="main"><?php echo addDoubleDot(TEXT_PROD_MINORD); ?></td>
                                                <td class="main"><?php echo tep_draw_input_field('products_quantity_order_min', ($pInfo->products_quantity_order_min == 0 ? 1 : $pInfo->products_quantity_order_min), 'style="width:150px;"'); ?></td>
                                            </tr>
                                            <tr class="main-indent">
                                                <td class="main"><?php echo TEXT_MIN_QUANTITY_UNITS; ?></td>
                                                <td class="main"><?php echo tep_draw_input_field('products_quantity_order_units', ($pInfo->products_quantity_order_units == 0 ? 1 : $pInfo->products_quantity_order_units), 'style="width:150px;"'); ?></td>
                                            </tr>
                                            <tr>
                                                <td class="main"><?php echo TEXT_PRODUCT_FREE_SHIPPING; ?></td>
                                                <td class="main toggle-main">
                                                    <div class="status">
                                                        <input class="cmn-toggle cmn-toggle-round" name="products_free_ship" type="checkbox" id="cmn-toggle-products_options_length_4" <?= $in_products_free_ship ? 'checked' : '' ?>>
                                                        <label for="cmn-toggle-products_options_length_4"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="main"><?php echo TEXT_EDITED_FOR_SEO; ?></td>
                                                <td class="main toggle-main">
                                                    <div class="status">
                                                        <input class="cmn-toggle cmn-toggle-round" name="edited_for_seo" type="checkbox" id="cmn-toggle-products_options_length_5" <?php echo $in_edited_for_seo ? 'checked' : '' ?>>
                                                        <label for="cmn-toggle-products_options_length_5"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="main"><?php echo TEXT_EDIT_ROBOTS_STATUS; ?></td>
                                                <td class="main toggle-main">
                                                    <div class="status">
                                                        <input class="cmn-toggle cmn-toggle-round" name="products_robots_status" type="checkbox" id="cmn-toggle-products_options_length_6"
                                                            <?php echo $pInfo->products_robots_status == '1' ? 'checked' : '' ?>>
                                                        <label for="cmn-toggle-products_options_length_6" title="<?php echo TEXT_DEFINE_CATEGORY_ROBOTS_STATUS; ?>"></label>
                                                    </div>
                                                </td>
                                            </tr>


                                            <?php
                                            /*                                                        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                                                                                                        */ ?><!--
                                                            <tr>
                                                                <td colspan="2" valign="top" class="main">
                                                                    <br/><?php /*echo TEXT_PRODUCTS_PAGE_TITLE; */ ?>&nbsp;
                                                                    <small><?php /*echo $languages[$i]['name']; */ ?></small>
                                                                    <br/><?php /*echo tep_draw_textarea_field('products_head_title_tag[' . $languages[$i]['id'] . ']', 'soft', '105', '1', (isset($products_head_title_tag[$languages[$i]['id']]) ? $products_head_title_tag[$languages[$i]['id']] : $product_texts_array[$languages[$i]['id']]['products_head_title_tag']), 'style="width:100%;height:60px;"'); */ ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" valign="top"
                                                                    class="main"><?php /*echo TEXT_PRODUCTS_HEADER_DESCRIPTION; */ ?>
                                                                    &nbsp;
                                                                    <small><?php /*echo $languages[$i]['name']; */ ?></small>
                                                                    <br/><?php /*echo tep_draw_textarea_field('products_head_desc_tag[' . $languages[$i]['id'] . ']', 'soft', '105', '1', (isset($products_head_desc_tag[$languages[$i]['id']]) ? $products_head_desc_tag[$languages[$i]['id']] : $product_texts_array[$languages[$i]['id']]['products_head_desc_tag']), 'style="width:100%;height:100px;"'); */ ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" valign="top"
                                                                    class="main"><?php /*echo TEXT_PRODUCTS_KEYWORDS; */ ?>
                                                                    &nbsp;
                                                                    <small><?php /*echo $languages[$i]['name']; */ ?></small>
                                                                    <br/><?php /*echo tep_draw_textarea_field('products_head_keywords_tag[' . $languages[$i]['id'] . ']', 'soft', '105', '1', (isset($products_head_keywords_tag[$languages[$i]['id']]) ? $products_head_keywords_tag[$languages[$i]['id']] : $product_texts_array[$languages[$i]['id']]['products_head_keywords_tag']), 'style="width:100%;height:60px;"'); */ ?>
                                                                </td>
                                                            </tr>
                                                            --><?php
                                            /*                                                        }
                                                                                                    */ ?>
                                            <tr>
                                                <td class="main"><?php echo addDoubleDot(TEXT_IS_DOWNLOAD_PRODUCT); ?></td>
                                                <td class="main toggle-main">
                                                    <div class="status is_download_input">
                                                        <input class="cmn-toggle cmn-toggle-round"
                                                               name="is_download_product" type="checkbox"
                                                               id="cmn-toggle-products_options_length_7" <?= $in_is_download_product ? 'checked' : '' ?>>
                                                        <label for="cmn-toggle-products_options_length_7"></label>
                                                    </div>
                                                </td>
                                            </tr>                                                        
                                        </table>
                                    </div>
                                    <div style="clear:both;"></div>
                                </div>
                                <div id="images">
                                    <?php if (isset($_GET['pID'])) { ?>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="2" class="images">
                                            <tr>
                                                <td>
                                                    <!-- html5uploader -->
                                                    <?php echo TEXT_PROD_IMGS_OR; ?>    <?php echo TEXT_PROD_IMGS_DRAG; ?>
                                                    :<br/>
                                                    <link rel="stylesheet"
                                                          href="html5uploader/assets/css/styles.css"/>
                                                    <small>
                                                        <?php echo addDoubleDot(TEXT_PROD_IMGS2); ?>
                                                        <input type="text" name="img_width" value="150"
                                                               style="width:40px;font-size:12px;">
                                                        <?php echo TEXT_PROD_IMGS3; ?>
                                                        <input type="text" name="img_height" value="150"
                                                               style="width:40px;font-size:12px;">
                                                        px
                                                    </small>
                                                    <div id="dropbox_first" class="dropbox">
                                                        <span class="message"><i><?php echo TEXT_PROD_IMGS_DRAG; ?></i></span>
                                                    </div>
                                                    <?php

                                                    if (MULTICOLOR_ENABLED == 'true') {
                                                        include(DIR_FS_EXT . 'multicolor/admin_color.php');
                                                    }

                                                    ?>
                                                    <input type="hidden" name="pidd" id="pidd"
                                                           value="<?php echo $_GET['pID']; ?>"/>
                                                    <!-- html5uploader -->
                                                    <input type="hidden" id="crop_x" name="crop_x"/>
                                                    <input type="hidden" id="crop_y" name="crop_y"/>
                                                    <input type="hidden" id="crop_w" name="crop_w"/>
                                                    <input type="hidden" id="crop_h" name="crop_h"/>
                                                    <span id="crop_button"
                                                          style="display:none;float:left;font-weight:bold;cursor:pointer;color:#fff;font-size:17px;background:#339933;border-radius:5px;padding:5px;margin:15px 0;"><?php echo TEXT_PROD_CROP; ?></span>
                                                    <div style="clear:both"></div>
                                                    <div id="crop_area"></div>
                                                </td>
                                            </tr>
                                        </table>
                                        <?php } else {
                                            echo '<img border="0" src="images/icon_info.gif">' . TEXT_PROD_SAVE_BEFORE . '';
                                        } ?>
                                </div>
                                <div id="video">
                                    <?php if (isset($_GET['pID'])) { ?>
                                        <table id="product-video" width="100%" border="0" cellspacing="0" cellpadding="2" class="video">
                                            <thead>
                                            <tr>
                                                <th><?php echo TEXT_IMAGE_PREVIEW ?></th>
                                                <th><?php echo TEXT_LINK_TO_YOUTUBE ?></th>
                                                <th><?php echo TEXT_EDIT_SORT_ORDER ?></th>
                                                <th><?php echo IMAGE_DELETE ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $products_videos_query = tep_db_query("select * from " . TABLE_PRODUCTS_VIDEO . " where products_id = '" . (int)$pInfo->products_id . "' order by sort_order");
                                            $video_row = 0;
                                            while ($products_video = tep_db_fetch_array($products_videos_query)){
                                                ?>
                                                <tr id="video-row-<?php echo $video_row;?>">
                                                    <td class="preview">
                                                        <img src="<?php echo DIR_WS_CATALOG . 'images/products/' . $products_video['video_preview']; ?>" />
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="products_video[<?php echo $video_row;?>][products_video_id]" value="<?php echo $products_video['products_video_id']; ?>"/>
                                                        <input type="hidden" name="products_video[<?php echo $video_row;?>][products_id]" value="<?php echo $pInfo->products_id; ?>"/>
                                                        <input type="text" name="products_video[<?php echo $video_row;?>][video_url]" class="form-control" value="<?php echo $products_video['video_url']; ?>">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="products_video[<?php echo $video_row;?>][sort_order]" class="form-control" value="<?php echo $products_video['sort_order']; ?>">
                                                    </td>
                                                    <td>
                                                        <img class="image_delete" src="images/icons/del.gif" border="0" alt="<?php echo IMAGE_DELETE ?>" title=" <?php echo IMAGE_DELETE ?> " onclick="$('#video-row-<?php echo $video_row;?>').remove();">
                                                    </td>
                                                    <?php $video_row++ ?>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <td colspan="4" class="text-center">
                                                    <button class="btn_own" id="button-video"  data-toggle="tooltip" title="" data-original-title="<?php echo IMAGE_INSERT ?>">
                                                        <svg width="24px" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="#18bf49" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm144 276c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92h-92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z" class=""></path></svg>
                                                    </button>
                                                </td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    <?php } else {
                                        echo '<img border="0" src="images/icon_info.gif">' . TEXT_PROD_SAVE_BEFORE . '';
                                    } ?>
                                </div>
                                <div id="attribs">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                        <!-- AJAX Attribute Manager  -->
                                        <?php require_once('attributeManager/includes/attributeManagerPlaceHolder.inc.php') ?>
                                        <!-- AJAX Attribute Manager end -->
                                    </table>
                                </div>
                                <div id="downloads">
                                    <?php if (isset($_GET['pID'])) { ?>

                                        <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                            <tr>
                                                <td>
                                                    <!-- html5uploader -->
                                                    <?php echo TEXT_PROD_IMGS_OR; ?>    <?php echo TEXT_PROD_FILES_DRAG; ?>:<br/>
                                                    <div class="text-right"><?php echo TEXT_ALOWED_FILE_TYPES; ?> .zip, .rar, .rtf, .epub, .pdf, .doc, .docx, .xls, .xlsx, .7z, .csv, .txt </div>
                                                    <link rel="stylesheet"
                                                          href="html5uploader/assets/css/styles.css"/>

                                                    <div id="dropbox_second" class="dropboxsecond">
                                                        <span class="message"><i><?php echo TEXT_PROD_IMGS_DRAG; ?></i></span>
                                                    </div>
                                                    <input type="hidden" name="pidd" id="pidd"
                                                           value="<?php echo $_GET['pID']; ?>"/>
                                                </td>
                                            </tr>
                                        </table>
                                    <?php } else {
                                        echo '<img border="0" src="images/icon_info.gif">' . TEXT_PROD_SAVE_BEFORE . '';
                                    }?>
                                </div>
                                            <?php if (defined('XSELL_PRODUCTS_BUYNOW_ENABLED') && XSELL_PRODUCTS_BUYNOW_ENABLED == 'true') { ?>
                                    <div id="xsells">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                            <tr>
                                                <td class="main" colspan="3">
                                                    <?php echo TEXT_XSELLS_ADD; ?>
                                                    <input size="35" type="text" name="add_xsells_input"/>
                                                    <input type="hidden" name="current_pid"
                                                           value="<?php echo $_GET['pID']; ?>"/>
                                                    <!--                                                        <a class="add_xsell_button" href="javascript:;">-->
                                                    <?php //echo TEXT_XSELLS_ADD_BUTTON; ?><!--</a>-->
                                                </td>
                                            </tr>
                                        </table>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="2"
                                               class="xsells_table">
                                            <?php

                                            $xsell_query = tep_db_query("select distinct xp.discount, xp.sort_order, p.products_id, p.products_model, pd.products_name,xp.xsell_id,xp.discount, p.products_sort_order from " . TABLE_PRODUCTS_XSELL . " xp, " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where xp.products_id = '" . $_GET['pID'] . "' and xp.xsell_id = p.products_id and p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "' order by xp.sort_order asc, p.products_id, p.products_sort_order ");

                                            while ($xsells = tep_db_fetch_array($xsell_query)) {
                                                $checked = '';
                                                $rec_link = tep_db_query("select distinct products_id,xsell_id from " . TABLE_PRODUCTS_XSELL . " WHERE products_id=" . $xsells['xsell_id'] . " and xsell_id=" . $_GET['pID']);
                                                if ($rec_link->num_rows) {
                                                    $checked = 'checked';
                                                }
                                                echo '<tr>
                                                            <td class="main"><a target="_blank" href="products.php?pID=' . $xsells['products_id'] . '&action=new_product">#' . $xsells['products_model'] . '</a></td>
                                                            <td><a class="del_xsell_button" data-xid="' . $xsells['products_id'] . '" href="javascript:;">' . TEXT_XSELLS_DEL_BUTTON . '</a></td>
                                                            <td>' . TEXT_DISCOUNT . ':<input name="discount" size=5 type="text" value="' . $xsells['discount'] . '"></td>
                                                            <td>' . TEXT_SORT_ORDER . '<input class="xsell_sort_order" name="xsell_sort_order" size=2 type="number" value="' . $xsells['sort_order'] . '"></td>
                                                            <td>' . TEXT_RECIPROCAL_LINK . ':<input name="rec_link" type="checkbox" ' . $checked . '></td>
                                                            <td class="main">' . $xsells['products_name'] . '</td>
                                                          </tr>';
                                            } ?>
                                        </table>
                                    </div>
                                            <?php } ?>
                                <div id="qtypro" class="container">
                                    <?php
                                    if (file_exists($qtyProFilename) && getConstantValue('QTY_PRO_ENABLED') == 'true') {
                                        require $qtyProFilename;
                                    } ?>
                                </div>
                            </div>
                            <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="main" align="right">
                            <?php echo tep_draw_hidden_field('products_date_added', (tep_not_null($pInfo->products_date_added) ? $pInfo->products_date_added : date('Y-m-d'))); ?><?php
                                if (isset($_GET['pID'])) {
                                    echo tep_image_submit('button_update.gif', IMAGE_UPDATE, 'form="product_edit_form"');
                                } else {
                                    echo tep_image_submit('button_insert.gif', IMAGE_INSERT, 'form="product_edit_form"');
                                }
                            echo '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . (isset($_GET['pID']) ? '&pID=' . $_GET['pID'] : '')) . '">' . tep_text_button(BUTTON_BACK_NEW) . '</a>';
                            ?>
                        </td>
                    </tr>
                </table>
            </form>
            <?php if ($_GET['pID']) { ?>
                <div id="custom_form_wrapper">
                    <form style="display:none;font-size: 16px;" id="custom_form"
                          action="<?= HTTP_SERVER . '/' . $admin ?>/html5uploader/post_file.php?act=custom_update&img_w=150&img_h=150&pid=<?php echo $_GET['pID']; ?>&cPath=<?php echo(($_GET['cPath'] ?: $cPath ?: $category['id'])); ?>&opid=first"
                          method="post" enctype="multipart/form-data">
                        <?php echo addDoubleDot(TEXT_PROD_LOAD_IMGS); ?> <input name="pic[]" type="file" multiple/>
                        <input type="submit" value="<?php echo TEXT_PROD_LOAD_IMGS_BUT; ?>"/>
                    </form>
                    <a class="open-server-dir" data-prod-id="<?= (int)$_GET['pID']?>"><?= TEXT_CHOOSE_ON_SERVER?></a>
                </div>
                <div id="custom_form_wrapper_second">
                    <form style="display:none;font-size: 16px;" id="custom_form_second"
                          action="<?= HTTP_SERVER . '/' . $admin ?>/html5uploader/post_file.php?act=custom_update&img_w=150&img_h=150&pid=<?php echo $_GET['pID']; ?>&cPath=<?php echo(($_GET['cPath'] ?: $cPath ?: $category['id'])); ?>&opid=second"
                          method="post" enctype="multipart/form-data">
                        <?php echo addDoubleDot(TEXT_PROD_LOAD_FILES); ?> <input name="files[]" type="file" multiple/>
                        <input type="submit" value="<?php echo TEXT_PROD_LOAD_IMGS_BUT; ?>"/>
                    </form>
                </div>
            <?php } ?>
            <?php
        }
        ?>
    </div>

    <script language="javascript" src="includes/menu.js?t=<?=filesize(__DIR__ . DIRECTORY_SEPARATOR . DIR_WS_INCLUDES . 'menu.js')?>"></script>
    <script language="javascript" src="includes/general.js?t=<?=filesize(__DIR__ . DIRECTORY_SEPARATOR . DIR_WS_INCLUDES . 'general.js')?>"></script>
    <script src="includes/ckeditor/ckeditor.js"></script>
    <script src="includes/ckfinder/ckfinder.js"></script>
    <script src="html5uploader/assets/js/jquery.getimagedata.min.js"></script>
    <script src="html5uploader/assets/js/canvas-toBlob.min.js"></script>
    <script src="html5uploader/assets/js/jquery.filedrop.js"></script>
    <script src="html5uploader/assets/js/jquery.filedropFiles.js"></script>
    <script src="html5uploader/assets/js/script.js"></script>
    <script src="html5uploader/assets/js/script_for_files.js"></script>
<?php if (file_exists(DIR_FS_EXT . 'auto_translate/auto_translate.js') && getConstantValue('AUTO_TRANSLATE_MODULE_ENABLED')) : ?>
    <script src="../ext/auto_translate/auto_translate.js"></script>
<?php endif; ?>
    <!--    <script src="includes/javascript/jquery-ui-1.9.2.custom.min.js"></script>-->
    <script>
        $(function () {

            attributeManagerInit();
            SetFocus();

            CKEDITOR.disableAutoInline = true;
            $('#tabs').tabs({fx: {opacity: 'toggle', duration: 'fast'}});
            $("#tabs").tabs({
                beforeActivate: function (e, ui) {
                    if ($(ui.newTab[0]).hasClass('not-tab')) {
                        e.preventDefault();
                        location.href = $(ui.newTab.context).attr('href');
                    }
                }
            });
            // activate language tabs for product
            $('#text__tabs').tabs({fx: {opacity: 'toggle', duration: 'fast'}});

            /* $(document).on('click', ('.add_xsell_button'), function () {
             $.get('ajax_xsell.php', {
             action: 'add',
             pid: $('input[name=current_pid]').val(),
             xsell_model: $('input[name=add_xsells_input]').val()
             }, function (data) {
             $('.xsells_table').prepend('<tr><td class="main"><a target="_blank" href="products.php?pID=' + $('input[name=current_pid]').val() + '&amp;action=new_product">#' + $('input[name=add_xsells_input]').val() + '</a></td><td><a class="del_xsell_button" data-xid="683" href="javascript:;">del</a></td><td class="main">' + data + '</td></tr>');
             $('input[name=add_xsells_input]').val('');
             });
             });*/


            if ($('input[name=add_xsells_input]').length) {
                $('input[name=add_xsells_input]').autocomplete({
                    source: function (request, response) {
                        $.ajax({
                            url: "ajax_xsell.php?action=show",
                            dataType: 'json',
                            data: {
                                xsell_model: request.term,
                                pid: $('input[name=current_pid]').val(),
                                exclude: $('.del_xsell_button').map(function () {
                                    return $(this).data('xid');
                                }).get().join()
                            },
                            success: function (data) {
                                response(data);
                            }
                        });
                    },
                    delay: 50,
                    minLength: 2,
                    select: function (event, ui) {
                        var selected = ui.item.label;
                        var id = ui.item.id;
                        var model = ui.item.model;
                        $.ajax({
                            url: "ajax_xsell.php?action=add",
                            dataType: 'json',
                            data: {
                                pid: $('input[name=current_pid]').val(),
                                xsell_model: id
                            },
                            success: function (data) {
                                if (data.msg == true) {
                                    $('.xsells_table').prepend('<tr><td class="main"><a target="_blank" href="products.php?pID=' + id + '&amp;action=new_product">#' + model + '</a></td><td><a class="del_xsell_button" data-xid="' + id + '" href="javascript:;">del</a></td><td><?php echo addDoubleDot(TEXT_DISCOUNT)?><input name="discount" size=5 type="text"></td><td><?php echo addDoubleDot(TEXT_RECIPROCAL_LINK)?><input name="rec_link" type="checkbox"></td><td class="main">' + selected + '</td></tr>');
                                }
                                $('input[name=add_xsells_input]').val('')
                            }
                        });
                        return false;
                    }
                }).autocomplete("instance")._renderItem = function (ul, item) {
                    ul.css({'z-index': 9991, 'width': '300'});
                    return $("<li>")
                        .append("<div>(" + item.model + ")" + item.label + "</div>")
                        .appendTo(ul);
                };
            }

            $(document).on('blur', 'input[name=discount]', function () {
                var val = $(this).val();
                $.get('ajax_xsell.php', {
                    action: 'add_discount',
                    pid: $('input[name=current_pid]').val(),
                    xsell_id: $(this).closest('tr').find('[data-xid]').data('xid'),
                    val: val,
                    discount: $(this).closest('tr').find('[name=rec_link]').prop('checked')
                });
            });

            $(document).on('blur', 'input[name=xsell_sort_order]', function () {
                var val = $(this).val();
                $.get('ajax_xsell.php', {
                    action: 'change_sort_order',
                    pid: $('input[name=current_pid]').val(),
                    xsell_id: $(this).closest('tr').find('[data-xid]').data('xid'),
                    val: val
                });
            });
            $(document).on('click', ('.del_xsell_button'), function () {
                var current_row = $(this).parent().parent();
                $.get('ajax_xsell.php', {
                    action: 'del',
                    pid: $('input[name=current_pid]').val(),
                    xsell_id: $(this).attr('data-xid')
                }, function (data) {
                    current_row.slideUp(200);
                });
            });

            $(document).on('change', ('input[name=rec_link]'), function () {

                $.get('ajax_xsell.php', {
                    action: 'add_rec_link',
                    pid: $('input[name=current_pid]').val(),
                    xsell_id: $(this).closest('tr').find('[data-xid]').data('xid'),
                    val: $(this).prop("checked"),
                    discount: $(this).closest('tr').find('[name=discount]').val(),
                })
            });

            $(".ck_replacer").on('click', function () {
                $(this).hide();
                var textarea = $(this).parent().find('textarea');
                //  textarea.attr('contenteditable','true');
                var editor = CKEDITOR.replace(textarea.attr('name'), {
                    extraPlugins: 'colorbutton,font,justify,iframe,codemirror',
                    startupFocus: true,
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
                CKFinder.setupCKEditor(editor, 'includes/ckfinder/');
            });


        });
    </script>
    <script>
        var video_row = <?php echo $video_row; ?>;
        $('#button-video').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            html = '<tr id="video-row-' + video_row + '">';
            html += '<td class="preview"><img src="images/icon_save.gif" /></td>';
            html += '<td>'
            html += '   <input type="hidden" name="products_video[' + video_row + '][products_video_id]" value=""/>';
            html += '   <input type="hidden" name="products_video[' + video_row + '][products_id]" value="<?php echo $pInfo->products_id; ?>"/>';
            html += '   <input type="text" name="products_video[' + video_row + '][video_url]" class="form-control" value="">';
            html += '</td>';
            html += '<td><input type="text" name="products_video[' + video_row + '][sort_order]" class="form-control" value="0"></td>';
            html += '<td><img class="image_delete" src="images/icons/del.gif" border="0" alt="<?php echo IMAGE_DELETE ?>" title="<?php echo IMAGE_DELETE ?>" onclick="$(\'#video-row-' + video_row + '\').remove();"></td>';
            html += '</tr>';
            $('#product-video tbody').append(html);
            video_row++;
        });
    </script>
    <script src="includes/javascript/imagecrop/jquery.Jcrop.min.js"></script>

<?php if (DISPLAY_PRICE_WITH_TAX == 'true' || DISPLAY_PRICE_WITH_TAX_CHECKOUT == 'true') { ?>
    <script>
        var tax_rates = new Array();
        <?php
        for ($i = 0, $n = sizeof($tax_class_array); $i < $n; $i++) {
            if ($tax_class_array[$i]['id'] > 0) {
                echo 'tax_rates["' . $tax_class_array[$i]['id'] . '"] = ' . tep_get_tax_rate_value($tax_class_array[$i]['id']) . ';' . "\n";
            }
        }
        ?>

        function doRound(x, places) {
            return Math.round(x * Math.pow(10, places)) / Math.pow(10, places);
        }

        function getTaxRate() {
            var selected_value = document.getElementById('product_edit_form').products_tax_class_id.selectedIndex;
            var parameterVal = document.getElementById('product_edit_form').products_tax_class_id[selected_value].value;

            if ((parameterVal > 0) && (tax_rates[parameterVal] > 0)) {
                return tax_rates[parameterVal];
            } else {
                return 0;
            }
        }

        function updateGross() {
            var taxRate = getTaxRate();
            var grossValue = document.getElementById('product_edit_form').products_price.value;

            if (taxRate > 0) {
                grossValue = grossValue * ((taxRate / 100) + 1);
            }

            document.getElementById('product_edit_form').products_price_gross.value = doRound(grossValue, 4);
        }

        function updateNet() {
            var taxRate = getTaxRate();
            var netValue = document.getElementById('product_edit_form').products_price_gross.value;

            if (taxRate > 0) {
                netValue = netValue / ((taxRate / 100) + 1);
            }

            document.getElementById('product_edit_form').products_price.value = doRound(netValue, 4);
        }

        $(function () {
            updateGross();
        });
    </script>
<?php }
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
