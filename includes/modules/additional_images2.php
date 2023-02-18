<?php

if ($_GET['method'] == 'ajax') {
    chdir('../../');
    $rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
    require($rootPath . '/includes/application_top.php');

    $zap_query = tep_db_query('SELECT pa_imgs FROM products_attributes WHERE products_id=' . (int)$_GET['pid'] . ' and options_id=' . (int)$_GET['colid'] . ' and options_values_id=' . (int)$_GET['col'] . ';');
    $row = tep_db_fetch_array($zap_query);
    if (tep_db_num_rows($zap_query) > 0 and !empty($row['pa_imgs'])) {
        $additional_images = explode('|', $row['pa_imgs']);
        $addim_main_img = $perem_sma = $additional_images[0];
        $attr_images = true;
    } else {
        $products_image_query = tep_db_query("select p.products_image from " . TABLE_PRODUCTS . " p where p.products_id = " . (int)$_GET['pid']);
        $products_image = tep_db_fetch_array($products_image_query);
        $additional_images = array_filter(explode(';', $products_image['products_image']));
        $addim_main_img = $additional_images[0];
        $perem_sma = $products_image['products_image'];
    }
} else {
    $zap_query = tep_db_query("SELECT DISTINCT pa.products_attributes_id, pa.pa_imgs, pov.products_options_values_sort_order
                               FROM " . TABLE_PRODUCTS_ATTRIBUTES . " pa
                               LEFT JOIN " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov ON pa.options_values_id = pov.products_options_values_id
                               LEFT JOIN " . TABLE_PRODUCTS_OPTIONS . " po ON po.products_options_id = pa.options_id
                               WHERE products_id=" . (int)$_GET['products_id'] . "  and po.products_options_type = 3 and pa.pa_imgs != ''
                               order by pov.products_options_values_sort_order");
    $row = tep_db_fetch_array($zap_query);
    if (tep_db_num_rows($zap_query) > 0 and !empty($row['pa_imgs']) and MULTICOLOR_ENABLED == 'true') {
        $additional_images = explode('|', $row['pa_imgs']);
        $addim_main_img = $additional_images[0];
        $attr_images = true;
    } else {
        $products_image_query = tep_db_query("select p.products_image from " . TABLE_PRODUCTS . " p where p.products_id = " . (int)$_GET['products_id']);
        $products_image = tep_db_fetch_array($products_image_query);
        $additional_images = array_filter(explode(';', $products_image['products_image']));
        $addim_main_img = $additional_images[0];
        $perem_sma = $products_image['products_image'];
    }
}
$products_video_query = tep_db_query("select * from " . TABLE_PRODUCTS_VIDEO . "  where products_id = " . (int)$_GET['products_id'] . " ORDER BY sort_order DESC");
$products_video = [];

while($products_video_data = tep_db_fetch_array($products_video_query)) {
    if(strpos( $products_video_data['video_url'], 'youtube') !== false){
        $regExp = '/^.*(youtu\.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/';
        $match = preg_match($regExp, $products_video_data['video_url'], $matches);
        if ($match && strlen($matches[2]) == 11) {
            $products_video[] = array(
                'video_code' => $matches[2],
                'video_url' => 'https://www.youtube.com/embed/' . $matches[2],
                'video_preview' => ($products_video_data['video_preview'] != '' ? $products_video_data['video_preview'] : 'default.png'),
            );
        }



    }

}

$count_addImgs = count($additional_images);
  $big_width = $big_width ?: 410;
  $big_height = $big_height ?: 410;
  $thumb_size_w = $thumb_size_w ?: 101;
  $thumb_size_h = $thumb_size_h ?: 101;

  // view:
if (!$_GET['tpl']) {
    if (file_exists(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/content/additional_images2.tpl.php')) {
        require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/content/additional_images2.tpl.php'); // content from current template (if exists)
    } else {
        require(DIR_WS_CONTENT . 'additional_images2.tpl.php'); // content from default template
    }
} else {
    if (file_exists(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/content/additional_images_modal.tpl.php')) {
        require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/content/additional_images_modal.tpl.php'); // content from current template (if exists)
    } else {
        require(DIR_WS_CONTENT . 'additional_images_modal.tpl.php'); // content from default template
    }
}
