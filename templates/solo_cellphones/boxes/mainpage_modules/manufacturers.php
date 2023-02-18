<!-- MANUFACTURERS CAROUSEL -->
<div class="small_slider" id="manufacturers">
    <div>
        <?php
        $limit = (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 10);
        $manufacturers_query = tep_db_query(
            "SELECT DISTINCT m.`manufacturers_image`, m.`manufacturers_id`, mi.`manufacturers_name` FROM " . TABLE_MANUFACTURERS . " `m` LEFT JOIN " . TABLE_MANUFACTURERS_INFO . " `mi` on m.manufacturers_id = mi.manufacturers_id  WHERE `m`.`status` = '1' and mi.languages_id = $languages_id ORDER BY `m`.`sort`, `mi`.`manufacturers_name` LIMIT {$limit}"
        );
        $output_man = '';
        while ($manufacturers_values = tep_db_fetch_array($manufacturers_query)) {
            if ($manufacturers_values['manufacturers_image'] == '') {
                $man_image = $manufacturers_values['manufacturers_name'];
            } else {
                $man_image = '<img  src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="getimage/200x200/' . $manufacturers_values['manufacturers_image'] . '" class="lazyload" alt="' . $manufacturers_values['manufacturers_name'] . '" title="' . $manufacturers_values['manufacturers_name'] . '">';
            }

            $output_man .= '<a href="' . tep_href_link(
                FILENAME_DEFAULT,
                'manufacturers_id=' . $manufacturers_values['manufacturers_id'],
                'NONSSL'
            ) . '">' . $man_image . '</a>';
        }
        echo $output_man;
        ?>
    </div>
</div>
<!-- END MANUFACTURERS CAROUSEL -->    
