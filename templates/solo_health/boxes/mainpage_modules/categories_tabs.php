<?php

$remove_title = true;
$first_column = true;
$active_class = 'active';
$tabs = array();
$tabs_config_check = [];
$tabs_config_check = array_filter($config, function ($arr) {
    return $arr['val'];
});
if ($tabs_config_check) {
    $tabs = $tabs ?: getTabs();
    ?>
    <div class="white-rounded-box p_tabs mainpage-categories-tabs">
        <!--    <img src="--><?php //echo DIR_WS_IMAGES_CDN
        ?><!--pixel_trans.png" data-src="images/ajax-loader.gif" class="tab-loader lazyload hidden">-->
        <ul class="nav nav-tabs">
            <?php foreach ($tabs as $name => $val) : ?>
                <?php if ($val['total'] && $config[$name]['val']) : ?>
                    <li class="<?= $active_class;
                    $active_class = ''; ?>">
                        <a data-toggle="tab" href="#tab-<?= $name ?>"
                           data-file="<?= $val['filename'] ?>"><?= $val['title'] ?>
                            <span class="count"><?= $val['total'] ?></span>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        <div class="tab-content content">
            <?php foreach ($tabs as $name => $val) : ?>
                <?php if ($val['total'] && $config[$name]['val']) : ?>
                    <div id="tab-<?= $name ?>" class="tab-pane fade<?php if ($first_column) {
                        echo ' in active';
                                 } ?>">
                        <?php if ($first_column) : ?>
                            <?php
                            $sliderIdTimestamp = round(microtime(), 2) * 100;
                            $conf = $template->config['MAINPAGE_modules']['M_' . strtoupper($val['filename'])];
                            $tpl_settings['limit'] = (int)($conf['limit']['val'] ?: 8);
                            $tpl_settings['cols'] = $conf['cols']['val'] ?: 4;
                            $tpl_settings['id'] = $val['filename'] . '_' . $sliderIdTimestamp;
                            $tpl_settings['classes'] = ['product_slider'];
                            if (in_array('product_slider', $tpl_settings['classes'])) {
                                $assets->jsHomePageInline[] = generateOwlCarousel($tpl_settings);
                            }
                            ?>
                            <?php require(DIR_WS_MODULES . '/' . $val['filename'] . '.php') ?>
                            <?php $first_column = false;
                        endif; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <?php unset($remove_title);
} ?>
