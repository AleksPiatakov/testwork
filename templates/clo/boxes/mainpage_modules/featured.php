<?php

$tpl_settings = [
    'id' => 'featured',
    'classes' => ($config['slider']['val'] == 1) ? ['product_slider'] : ['front_section'],
    'cols' => (int)($config['cols']['val'] > 0 ? $config['cols']['val'] : 4),
    'limit' => (int)($config['limit']['val'] >0 ? $config['limit']['val'] : 10),
    'title' => BOX_HEADING_FEATURED,
    'description' => CLO_FEATURED,
];
if (in_array('product_slider', $tpl_settings['classes'])) {
    $assets->jsHomePageInline[] = generateOwlCarousel($tpl_settings);
}
?>
<hr>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <?php include(DIR_WS_MODULES . 'featured.php'); ?>
        </div>
    </div>
</div>
