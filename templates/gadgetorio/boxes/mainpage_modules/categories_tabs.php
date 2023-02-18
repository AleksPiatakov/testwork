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
    $tabs['new']['total'] = tep_db_fetch_array(
        tep_db_query(
            "
            SELECT count(*) AS `total`
            FROM " . TABLE_PRODUCTS . " `p` 
            LEFT JOIN " . TABLE_SPECIALS . " `s` ON `p`.`products_id` = `s`.`products_id` AND `s`.`status` = '1', 
                   " . TABLE_PRODUCTS_DESCRIPTION . " `pd`
             WHERE `p`.`products_id` = `pd`.`products_id` 
               AND `pd`.`language_id` = '" . (int)$languages_id . "' 
               AND `products_status` = '1' 
"
        )
    )['total'];
    $tabs['new']['filename'] = 'new_products';
    $tabs['new']['title'] = BOX_HEADING_WHATS_NEW;

    $tabs['featured']['total'] = tep_db_fetch_array(
        tep_db_query(
            "
            SELECT count(*) AS `total`
            FROM " . TABLE_PRODUCTS . " `p` 
           LEFT JOIN " . TABLE_FEATURED . " `f` ON `p`.`products_id` = `f`.`products_id` 
           LEFT JOIN " . TABLE_SPECIALS . " `s` ON `p`.`products_id` = `s`.`products_id` AND `s`.`status` = '1'
           LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " `pd` ON `p`.`products_id` = `pd`.`products_id` 
               WHERE `p`.`products_status` = '1' 
                 AND `pd`.`language_id` = '" . (int)$languages_id . "' 
                 AND `f`.`status` = '1' 
"
        )
    )['total'];
    $tabs['featured']['filename'] = 'featured';
    $tabs['featured']['title'] = BOX_HEADING_FEATURED;

    $tabs['specials']['total'] = tep_db_fetch_array(
        tep_db_query(
            "SELECT count(*) AS `total`
             FROM " . TABLE_PRODUCTS . " `p` LEFT JOIN " . TABLE_SPECIALS . " `s` ON `p`.`products_id` = `s`.`products_id` AND `s`.`status` = '1', 
                  " . TABLE_PRODUCTS_DESCRIPTION . " `pd` 
            WHERE `p`.`products_id` = `pd`.`products_id` 
              AND `s`.`status` = '1' 
              AND `pd`.`language_id` = '" . (int)$languages_id . "' 
              AND `products_status` = '1'"
        )
    )['total'];
    $tabs['specials']['filename'] = 'default_specials';
    $tabs['specials']['title'] = BOX_HEADING_SPECIALS;

    ?>
    <div class="white-rounded-box p_tabs mainpage-categories-tabs">
        <img src="<?php echo DIR_WS_IMAGES_CDN ?>pixel_trans.png" data-src="images/ajax-loader.gif"
             class="tab-loader lazyload hidden">
        <ul class="nav nav-tabs">
            <?php foreach ($tabs as $name => $val) : ?>
                <?php if ($val['total'] && $config[$name]['val']) : ?>
                    <li class="<?= $active_class;
                    $active_class = ''; ?>">
                        <a data-toggle="tab" href="#tab-<?= $name ?>"
                           data-file="<?= $val['filename'] ?>"><?= $val['title'] ?>
                            <span class="count"><?= $val['total'] ?></span></a>
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
