<?php

if (isset($_SESSION['compares']) && (count($_SESSION['compares']) > 0)) {
    $count_compare_items = count($_SESSION['compares']);
    ?>

    <div id="compare_box">
        <span class="compare"></span>
        <div class="clearfix">
            <a class="gocomparelink" rel="nofollow"
               href="<?php echo tep_href_link('compare.php'); ?>"><?php echo COMPARE; ?></a>
        </div>
        <?php

        foreach ($_SESSION['compares'] as $key => $val) {
            $compare_query = tep_db_query(
                "select p.products_id, pd.products_name, pd.products_description, p.products_model, p.products_image, pd.products_url, p.products_price, p.products_tax_class_id, p.manufacturers_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$key . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'"
            );
            $comp = tep_db_fetch_array($compare_query);

            if ($_GET['compare_id'] == $comp['products_id']) {
                $opacity = 0;
            } else {
                $opacity = 1;
            }

            $compare_prod_img = explode(';', $comp['products_image']);
            // debug($compare_prod_img);
            $compare_html = '<div id="compare_block' . $comp['products_id'] . '" class="compare_item clearfix">';
            $compare_html .= '<div class="inner clearfix">';
            // Image
            $compare_html .= '<div class="compare_block__prod_img left">
                              <a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $comp['products_id']) . '">
                              <img src="getimage/80x80/products/' . $compare_prod_img[0] . '" alt="">
                              </a>
                            </div>';
            //Name
            $compare_html .= '<div class="compare_block__prod_name left">
                              <a href="' . tep_href_link(
                FILENAME_PRODUCT_INFO,
                'products_id=' . $comp['products_id']
            ) . '">' . $comp['products_name'] . '
                              </a>
                            </div>';
            // Delete btn
            $compare_html .= '<a class="compare_block__delete" onclick="go_compare(' . $comp['products_id'] . ',' . $current_category_id . ',\'delete\')" href="javascript:;" ><i class="fa fa-trash"></i></a>';
            $compare_html .= '</div>';
            $compare_html .= '</div>';

            echo $compare_html;
        }
        ?>
    </div>
<?php } ?>
