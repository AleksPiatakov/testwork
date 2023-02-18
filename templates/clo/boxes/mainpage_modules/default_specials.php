<?php

$tpl_settings = [
    'id' => 'specials',
    'classes' => ($config['slider']['val'] == 1) ? ['product_slider'] : ['front_section'],
    'cols' => (int)($config['cols']['val'] > 0 ? $config['cols']['val'] : 4),
    'limit' => (int)($config['limit']['val'] >0 ? $config['limit']['val'] : 10),
    'title' => sprintf(TABLE_HEADING_DEFAULT_SPECIALS, tep_date_long_translate(strftime('%B'))),
    'description' => CLO_DESCRIPTION_SPECIALS,
];
if (in_array('product_slider', $tpl_settings['classes'])) {
    $assets->jsHomePageInline[] = generateOwlCarousel($tpl_settings);
}
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <?php include(DIR_WS_MODULES . 'default_specials.php'); ?>
        </div>
    </div>
</div>
