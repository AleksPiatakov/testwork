<?php

if (isset($_SESSION['compares']) && (count($_SESSION['compares']) > 0)) {
    foreach ($_SESSION['compares'] as $key => $val) {
        $compare_query = tep_db_query(
            "select p.products_id, pd.products_name, pd.products_description, p.products_model, p.products_image, pd.products_url, p.products_price, p.products_tax_class_id, p.manufacturers_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$key . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'"
        );
        $comp = tep_db_fetch_array($compare_query);

        $products_attributes_query = tep_db_query(
            "select count(*) as total from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . (int)$comp['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$languages_id . "'"
        );
        $products_attributes = tep_db_fetch_array($products_attributes_query);

        if ($products_attributes['total'] > 0) {
            $products_options_name_query = tep_db_query(
                "select distinct popt.products_options_id, popt.products_options_name, popt.products_options_type, popt.products_options_length, popt.products_options_comment from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " pa where pa.products_id='" . (int)$comp['products_id'] . "' and pa.options_id = popt.products_options_id and popt.language_id = '" . (int)$languages_id . "' order by popt.products_options_sort_order, popt.products_options_name"
            );
            while ($products_options_name = tep_db_fetch_array($products_options_name_query)) {
                $products_options_array = array();
                $products_options_query = tep_db_query(
                    "select pov.products_options_values_id, pov.products_options_values_name from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov where pa.products_id = '" . (int)$comp['products_id'] . "' and pa.options_id = '" . (int)$products_options_name['products_options_id'] . "' and pa.options_values_id = pov.products_options_values_id and pov.language_id = '" . (int)$languages_id . "' order by pa.products_options_sort_order"
                );
                $count = tep_db_num_rows($products_options_query);
                while ($products_options = tep_db_fetch_array($products_options_query)) {
                    $products_options_array[] = array(
                        'id' => $products_options['products_options_values_id'],
                        'text' => $products_options['products_options_values_name']
                    );
                }
                // comma separated if there is couple values:
                if (!empty($products_options_array[1]['text'])) {
                    $i = 0;
                    foreach ($products_options_array as $poa_val) {
                        if ($i == $count - 1) {
                            $optionses[$products_options_name['products_options_name']] .= $poa_val['text'];
                        } else {
                            $optionses[$products_options_name['products_options_name']] .= $poa_val['text'] . ', ';
                        }
                        $i++;
                    }
                } else {
                    $optionses[$products_options_name['products_options_name']] = $products_options_array[0]['text'];
                }

                $pr_names[$products_options_name['products_options_name']] = 1;
            }
        }

        $comp['opts'] = $optionses;
        unset($optionses);
        $cps[] = $comp;
    }


    if (count($_SESSION['compares']) <= 4) {
        $product_class = 'table-col-' . count($_SESSION['compares']);
    } elseif (count($_SESSION['compares']) > 4) {
        $product_class = 'table-col-4-more';
    }

    ?>


    <div class="compare-table white-rounded-box">
        <div class="like_h2">
            <a class="remove-all-btn" href="<?php echo tep_href_link('compare.php', 'action=compare&delete=all'); ?>">
                <span><?= COMP_PROD_CLEAR; ?></span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z"></path>
                </svg>
            </a>
            <?= GO_COMPARE; ?>
            <a class="btn-link go-back-btn" href="javascript:history.back()"><?php echo COMP_PROD_BACK; ?></a>
        </div>
        <div class="compare-table-header">
            <div class="header-row">
                <div class="row-cell title"></div>
                <?php
                foreach ($cps as $key => $val) {
                    echo '<div class="row-cell ' . $product_class . '">';
                    echo '<a class="product-remove" href="' . tep_href_link(
                        'compare.php',
                        'action=compare&delete=' . $val['products_id']
                    ) . '" data-toggle="tooltip" data-placement="auto top" title="' . IMAGE_BUTTON_DELETE . '">
                                <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path></svg>
                            </a>';
                    echo '<a class="product-image" href="' . tep_href_link(
                        FILENAME_PRODUCT_INFO,
                        'products_id=' . $val['products_id']
                    ) . '"><img src="getimage/160x160/products/' . explode(
                        ';',
                        $val['products_image']
                    )[0] . '" alt=""></a>';
                    echo '<div class="product-price">' .
                        $currencies->display_price(
                            $val['products_price'],
                            tep_get_tax_rate($val['products_tax_class_id'])
                        )
                        . tep_draw_hidden_field('products_id', $comp['products_id']) . '
                             </div>';
                    echo '<span class="product-name"><a href="' . tep_href_link(
                        FILENAME_PRODUCT_INFO,
                        'products_id=' . $val['products_id']
                    ) . '"><b>' . $val['products_name'] . '</b></a></span>';


                    echo '</div>';
                }
                ?>
            </div>
        </div>
        <div class="compare-table-body">
            <?php
            if (isset($pr_names)) {
                foreach ($pr_names as $k => $v) {
                    echo '<div class="body-row">';
                    echo '<div class="row-cell title ">' . $k . '</div>';
                    foreach ($cps as $key => $val) {
                        echo '<div class="row-cell ' . $product_class . '">';
                        echo '<td><div class="compare_attrs">' . $val['opts'][$k] . '</div></td>';
                        echo '</div>';
                    }
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>

    <?php
} else { ?>
    <div class="compare-table white-rounded-box">
        <a href="javascript:history.back()" class="like_h2 btn-link"><?= COMP_PROD_ADD_TO; ?></a>
    </div>
<?php } ?>
