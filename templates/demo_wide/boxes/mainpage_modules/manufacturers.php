<?php

$module_name = 'manufacturers';
if (isset($_POST['render'])) {
    $config = $template->checkConfig('MAINPAGE', 'M_MANUFACTURERS');
}

$module_is_ajax = isset($config['ajax']['val']) && $config['ajax']['val'] == '1' ? true : false;
if (isset($_POST['render']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest' || !$module_is_ajax) {
    if (!$template->getMainconf('MC_SHOW_LEFT_COLUMN') || isMobile()) {
        echo '<div class="' . ($template->getModuleSetting(
            'MAINPAGE',
            'M_MANUFACTURERS',
            'content_width'
        ) ? 'container' : 'container-fluid') . '">';
    } ?>
    <!-- MANUFACTURERS CAROUSEL -->
    <div class="small_slider" id="manufacturers">
        <div>
            <?php
            $item_limit_mobile = (int)($config['limit_mobile']['val'] > 0 ? $config['limit_mobile']['val'] : 5);
            $item_limit = (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 10);
            $cols = $config['cols']['val'] ?: 10;

            $limit = isMobile() ? $item_limit_mobile : $item_limit;
            $manufacturers_query = tep_db_query(
                "SELECT DISTINCT m.`manufacturers_image`, m.`manufacturers_id`, mi.`manufacturers_name` FROM " . TABLE_MANUFACTURERS . " `m` LEFT JOIN " . TABLE_MANUFACTURERS_INFO . " `mi` on m.manufacturers_id = mi.manufacturers_id  WHERE `m`.`status` = '1' and mi.languages_id = $languages_id ORDER BY `m`.`sort`, `mi`.`manufacturers_name` LIMIT {$limit}"
            );
            $output_man = '';
            while ($manufacturers_values = tep_db_fetch_array($manufacturers_query)) {
                if ($manufacturers_values['manufacturers_image'] == '') {
                    $man_image = $manufacturers_values['manufacturers_name'];
                } else {
                    $man_image = '<img class="lazyload" src="images/pixel_trans.png" data-src="getimage/200x200/' . $manufacturers_values['manufacturers_image'] . '" alt="' . $manufacturers_values['manufacturers_name'] . '" title="' . $manufacturers_values['manufacturers_name'] . '" height="1" width="1">';
                }
                $output_man .= '<a href="' . tep_href_link(
                    FILENAME_DEFAULT,
                    'manufacturers_id=' . $manufacturers_values['manufacturers_id'],
                    'NONSSL'
                ) . '">' . $man_image . '</a>';
            }
            echo $output_man; ?>
        </div>
    </div>
    <!-- END MANUFACTURERS CAROUSEL -->
    <?php if (!$template->getMainconf('MC_SHOW_LEFT_COLUMN') || isMobile()) {
        echo '</div>';
    }
}
if ($module_is_ajax) {
    echo '<div data-module-id="' . $module_name . '" class="ajax-module-box lazy-data-block"><span class="lazy-data-loader"></span></div>';
}
$assets->jsVariables[] = 'window.manufacturersCarouselCols = parseInt("' . $cols . '");';
?>
