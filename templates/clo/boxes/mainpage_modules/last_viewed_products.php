<?php

$tpl_settings = [
    'id' => 'last_viewed',
    'classes' => ['product_slider'],
    'cols' => $config['cols']['val'] ?: '2;4;6;6;6',
    'limit' => (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 10),
    'wishlist' => true,
    'title' => BOX_HEADING_LASTVIEWED,
];
if (in_array('product_slider', $tpl_settings['classes'])) {
    $assets->jsHomePageInline[] = generateOwlCarousel($tpl_settings);
}
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <?php
            if (is_file($rootPath . "ext/last_viewed_products/last_viewed_products.php")) {
                require_once $rootPath . "ext/last_viewed_products/last_viewed_products.php";
            } ?>
        </div>
    </div>
</div>
