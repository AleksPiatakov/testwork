<?php

$tpl_settings = [
    'id' => 'new_products',
    'classes' => ($config['slider']['val'] == 1) ? ['product_slider'] : ['front_section'],
    'cols' => (int)($config['cols']['val'] > 0 ? $config['cols']['val'] : 4),
    'limit' => (int)($config['limit']['val'] >0 ? $config['limit']['val'] : 8),
    'title' => BOX_HEADING_WHATS_NEW,
    'description' => CLO_NEW_PRODUCTS,
];
if (in_array('product_slider', $tpl_settings['classes'])) {
    $assets->jsHomePageInline[] = generateOwlCarousel($tpl_settings);
}
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <?php include(DIR_WS_MODULES . 'new_products.php'); ?>
        </div>
    </div>
</div>
