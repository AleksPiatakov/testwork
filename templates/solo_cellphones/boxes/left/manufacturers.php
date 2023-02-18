<div class="left-manufacturers">
    <div class="like_h2">
        <?= BOX_HEADING_MANUFACTURERS ?>
        <a href="index.php" class="view-all-btn" data-toggle="tooltip" data-placement="auto right" title=""
           data-original-title="<?= BOX_HEADING_MANUFACTURERS ?>">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path d="M80 280h256v48H80zM80 184h320v48H80zM80 88h352v48H80z"></path>
                <g>
                    <path d="M80 376h288v48H80z"></path>
                </g>
            </svg>
        </a>
    </div>

    <?php

    $manufacturers_query = tep_db_query(
        "SELECT DISTINCT m.`manufacturers_image`, m.`manufacturers_id`, mi.`manufacturers_name` FROM " . TABLE_MANUFACTURERS . " `m` JOIN " . TABLE_MANUFACTURERS_INFO . " `mi` on m.manufacturers_id = mi.manufacturers_id  WHERE `status` = '1' and mi.languages_id = $languages_id ORDER BY `manufacturers_name`"
    );

    $manufacturers_list = '';
    ($_GET['manufacturers_id'] == '' ? ($marker_class = 'manuf_bg_current') : ($marker_class = 'manuf_bg'));
    while ($manufacturers_values = tep_db_fetch_array($manufacturers_query)) {
        $manufacturers_image = '<img src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="getimage/200x200/' . $manufacturers_values['manufacturers_image'] . '" class="lazyload" alt="' . $manufacturers_values['manufacturers_name'] . '" title="' . $manufacturers_values['manufacturers_name'] . '">';

        ($manufacturers_values['manufacturers_id'] == $_GET['manufacturers_id'] ? ($marker_class = 'manuf_bg_current') : ($marker_class = 'manuf_bg'));
        $manufacturers_list .= '<li class="' . $marker_class . '">
                                    <a href="' . tep_href_link(
            FILENAME_DEFAULT,
            'manufacturers_id=' . $manufacturers_values['manufacturers_id'],
            'NONSSL'
        ) . '">
                                        <span class="cat_img">' . $manufacturers_image . '</span>
                                        <span class="cat_name">' . substr(
                                            $manufacturers_values['manufacturers_name'],
                                            0,
                                            MAX_DISPLAY_MANUFACTURER_NAME_LEN
                                        ) . '
                                            <span class="counter">124</span>
                                        </span>
                                    </a>
                                  </li>';
    }

    $select_box = $manufacturers_list;


    echo '<ul>
              ' . $select_box . '
            </ul>';

    ?>
</div>
