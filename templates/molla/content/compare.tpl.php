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


    ?>
    <br/><br/>
    <a class="btn-success btn-lg" href="<?php echo tep_href_link(
        'compare.php',
        'action=compare&delete=all'
                                        ); ?>"><?php echo COMP_PROD_CLEAR; ?></a>
    <a class="btn-success btn-lg" href="javascript:history.back()"><?php echo COMP_PROD_BACK; ?></a>
    <br/><br/><br/><br/>
    <table border="0" cellspacing="0" cellpadding="0" class="compare_table">
        <?php


        echo '<tr>';
        $i = 0;
        foreach ($cps as $key => $val) {
            $i++;
            if ($i == 1) {
                echo '<td width="150"><b>' . COMP_PROD_NAME . '</b></td>';
            }
            echo '<td class="text-center"><span><a href="' . tep_href_link(
                FILENAME_PRODUCT_INFO,
                'products_id=' . $val['products_id']
            ) . '"><b>' . $val['products_name'] . '</b></a></span></td>';
        }
        echo '</tr>';
        //-------------------------------------------------------------
        echo '<tr>';
        $i = 0;
        foreach ($cps as $key => $val) {
            $i++;
            if ($i == 1) {
                echo '<td width="150"><b>' . COMP_PROD_IMG . '</b></td>';
            }

            $compare_image = explode(';', $val['products_image']);
            echo '<td class="text-center">
            <span><a href="' . tep_href_link(
                FILENAME_PRODUCT_INFO,
                'products_id=' . $val['products_id']
            ) . '">' . tep_image(
                DIR_WS_IMAGES . 'products/' . $compare_image[0],
                $val['products_name'],
                '',
                '',
                'style="height: 115px;"'
            ) . '</a></span>
            <br /><a href="' . tep_href_link(
                'compare.php',
                'action=compare&delete=' . $val['products_id']
            ) . '">' . IMAGE_BUTTON_DELETE . '</a>
          </td>';
        }
        echo '</tr>';
        //--------------------------------------------------------------
        echo '<tr>';
        $i = 0;
        foreach ($cps as $key => $val) {
            $i++;
            if ($i == 1) {
                echo '<td width="150"><b>' . COMP_PROD_PRICE . '</b></td>';
            }
            echo '<td><div class="prod_price">' .
                $currencies->display_price($val['products_price'], tep_get_tax_rate($val['products_tax_class_id']))
                . tep_draw_hidden_field('products_id', $comp['products_id']) . '
          </div></td>';
        }
        echo '</tr>';
        //--------------------------------------------------------------

        if (isset($pr_names)) {
            foreach ($pr_names as $k => $v) {
                echo '<tr><td width="150"><b>' . $k . '</b></td>';
                foreach ($cps as $key => $val) {
                    echo '<td><div class="compare_attrs">' . $val['opts'][$k] . '</div></td>';
                }
                echo '</tr>';
            }
        }

        ?>
    </table>
    <?php
} else {
    echo '<h1 style="display:block;float:left;">' . COMP_PROD_ADD_TO . '</h1>  
<div class="clear"></div>  
<a class="btn yellow" href="javascript:history.back()">' . COMP_PROD_BACK . '</a>

';
}
?>
