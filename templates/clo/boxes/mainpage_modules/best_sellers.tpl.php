<?php

$tpl_settings = [
    'id' => 'best_sellers',
    'classes' => ($config['slider']['val'] == 1) ? ['product_slider'] : ['front_section'],
    'cols' => (int)($config['cols']['val'] > 0 ? $config['cols']['val'] : 4),
    'limit' => (int)($config['limit']['val'] >0 ? $config['limit']['val'] : 3),
    'title' => MAIN_BESTSELLERS,
    'description' => CLO_DESCRIPTION_BESTSELLERS,
];
if (in_array('product_slider', $tpl_settings['classes'])) {
    $assets->jsHomePageInline[] = generateOwlCarousel($tpl_settings);
}
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <?php include(DIR_WS_MODULES . 'best_sellers.php'); ?>
        </div>
    </div>
</div>
