<?php

if ($_GET['clear'] == 'true') {
    require('includes/application_top.php');
    $path = "images/products/";

    //create folders:
    if (!file_exists(DIR_FS_CATALOG . 'images/categories')) {
        mkdir(DIR_FS_CATALOG . 'images/categories', 0777, true); // create folder categories
    }
    if (!file_exists(DIR_FS_CATALOG . 'images/icons')) {
        mkdir(DIR_FS_CATALOG . 'images/icons', 0777, true); // create folder categories
    }

    // find all images and move it to array:
    $images = glob($path . "*.*");
    $images_array = array();
    foreach ($images as $image) {
        $images_array[] = preg_replace('|' . $path . '|i', '', $image);
    }

    // move categories images to folder 'categories'
    $cat_images_query = tep_db_query("select `categories_image` from `categories` where `categories_image`!=''");
    while ($cat_images = tep_db_fetch_array($cat_images_query)) {
        if (in_array($cat_images['categories_image'], $images_array)) {
            copy(
                DIR_FS_CATALOG . 'images/products/' . $cat_images['categories_image'],
                DIR_FS_CATALOG . 'images/categories/' . $cat_images['categories_image']
            );
        }
        echo 'category image <b>' . $cat_images['categories_image'] . '</b> copied!<br />';
    }

    // move site logo from folder "products" to "images"
    $logo_query = tep_db_query("select `configuration_value` from `configuration` where `configuration_key`='LOGO_IMAGE'");
    $logo = tep_db_fetch_array($logo_query);
    $logo_path = preg_replace('|images/|i', '', $logo['configuration_value']);
    copy(DIR_FS_CATALOG . 'images/products/' . $logo_path, DIR_FS_CATALOG . 'images/' . $logo_path);


    // copy necessary files:
    $necessary_files = array('ajax-loader.gif', 'default.png', 'pixel_trans.png', 'printimage.gif');
    foreach ($necessary_files as $nf) {
        copy(DIR_FS_CATALOG . 'images/products/' . $nf, DIR_FS_CATALOG . 'images/' . $nf);
    }

    // copy colors: orange and white.
    copy(DIR_FS_CATALOG . 'images/products/white.jpg', DIR_FS_CATALOG . 'images/products_options_values/white.jpg');
    copy(DIR_FS_CATALOG . 'images/products/orange.jpg', DIR_FS_CATALOG . 'images/products_options_values/orange.jpg');

    // remove not necessary product images:
    $db_images_array = array();
    $product_images_query = tep_db_query("select products_image from products where products_image!=''");
    while ($product_images = tep_db_fetch_array($product_images_query)) {
        $db_images_array = array_merge($db_images_array, explode(";", $product_images['products_image']));
    }

    // get also images from attributes!!
    $pa_query = tep_db_query("select pa_imgs from products_attributes where pa_imgs!=''");
    while ($pa = tep_db_fetch_array($pa_query)) {
        $db_images_array = array_merge($db_images_array, explode("|", $pa['pa_imgs']));
    }

    $delete = array_diff($images_array, $db_images_array);

    foreach ($delete as $del) {
        @unlink($path . $del);
    }
    debug(count($delete) . ' images deleted');
}
