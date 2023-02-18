<?php if (COMPARE_MODULE_ENABLED == 'true') { ?>
    <div id="compare_box">
        <?php

        //    include('ext/compare/r_compare_box.php');
        /*
            if ($_GET['method']=='ajax') {
                chdir('../../');
                $rootPath=dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
                require($rootPath . '/includes/application_top.php');
            }*/

        if (isset($_SESSION['compares']) && (count($_SESSION['compares']) > 0)) {
            $count_compare_items = count($_SESSION['compares']);
            ?>
            <div class="compare-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M434.8 137.6L285.4 69.5c-16.2-7.4-42.7-7.4-58.9 0L77.2 137.6c-17.6 8-17.6 21.1 0 29.1l148 67.5c16.9 7.7 44.7 7.7 61.6 0l148-67.5c17.6-8 17.6-21.1 0-29.1zM225.2 375.2l-99.8-45.5c-4.2-1.9-9.1-1.9-13.3 0l-34.9 15.9c-17.6 8-17.6 21.1 0 29.1l148 67.5c16.9 7.7 44.7 7.7 61.6 0l148-67.5c17.6-8 17.6-21.1 0-29.1l-34.9-15.9c-4.2-1.9-9.1-1.9-13.3 0l-99.8 45.5c-16.9 7.7-44.7 7.7-61.6 0z"></path>
                    <path d="M434.8 241.6l-31.7-14.4c-4.2-1.9-9-1.9-13.2 0l-108 48.9c-15.3 5.2-36.6 5.2-51.9 0l-108-48.9c-4.2-1.9-9-1.9-13.2 0l-31.7 14.4c-17.6 8-17.6 21.1 0 29.1l148 67.5c16.9 7.7 44.7 7.7 61.6 0l148-67.5c17.7-8 17.7-21.1.1-29.1z"></path>
                </svg>
                <div class="counter"><span id="compare_counter"><?= count($_SESSION['compares']); ?></span></div>
            </div>
            <div class="content">
                <div class="clearfix block-header">
                    <p><?php echo COMPARE; ?></p>
                </div>
                <div class="body">
                    <?php

                    $i = 0;
                    foreach ($_SESSION['compares'] as $key => $val) {
                        $i++;
                        if ($i <= 3) {
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
                            $compare_prod_price = $comp['products_price'];
                            // debug($compare_prod_img);
                            $compare_html = '<div id="compare_block' . $comp['products_id'] . '" class="compare_item clearfix">';
                            $compare_html .= '<div class="inner clearfix">';
                            // Image
                            $compare_html .= '<div class="compare_block__prod_img left">
                                  <a href="' . tep_href_link(
                                    FILENAME_PRODUCT_INFO,
                                    'products_id=' . $comp['products_id']
                                ) . '">
                                    <img src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="getimage/80x80/products/' . $compare_prod_img[0] . '" class="lazyload" alt="">
                                  </a>
                                </div>';
                            //Name
                            $compare_html .= '<div class="compare_block__prod_name left">
                                  <a href="' . tep_href_link(
                                    FILENAME_PRODUCT_INFO,
                                    'products_id=' . $comp['products_id']
                                ) . '">' . $comp['products_name'] . '</a>
                                </div>';
                            // Delete btn
                            $compare_html .= '<a class="compare_block__delete" onclick="go_compare(' . $comp['products_id'] . ',' . $current_category_id . ',\'delete\')" href="javascript:;" ><span class="icon-remove-compare">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <path d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z"></path>
                                            </svg>
                                        </a>';
                            $compare_html .= '</div>';
                            $compare_html .= '</div>';

                            echo $compare_html;
                        }
                    }

                    ?>
                </div>

                <div class="block-view-all">
                    <a class="gocomparelink"
                       href="<?php echo tep_href_link('compare.php'); ?>"><?php echo GO_COMPARE; ?> (<?= count(
                            $_SESSION['compares']
                        ); ?>)
                    </a>
                </div>
            </div>


        <?php } ?>


    </div>
<?php } ?>
