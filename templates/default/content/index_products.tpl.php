<div class="category">
    <h1 class="category_heading"><?= clearKeywordsParam($heading_text_box); ?></h1>

    <?php if (is_array($subcat_array)) { ?>
        <div class="form-group row subcats_imgs">
            <?php // subcategoriest columns:
            foreach ($subcat_array as $cid => $carr) {
                echo '<div class="col-md-3 col-sm-4 col-xs-6"><a href="' . $carr['url'] . '">' . $carr['img'] . $carr['name'] . '</a></div>';
            }
            ?>
        </div>
    <?php } ?>

    <?php if (isset($_GET['keywords'])) {
        echo tep_show_results_categories();
    }
    if ($current_category['display_products'] != 'nothing') { ?>
        <div class="listing-header form-group row">
            <noindex>
                <div class="row">
                    <!-- LIST_CONCLUSION -->
                    <?php if ($template->show('LIST_CONCLUSION')) : ?>
                        <div class="col-sm-2 col-xs-4 refresh_icon">
                            <div class="pull-left vivod_ vivod_columns">
                                <button class="btn-link columns <?php echo $display_hover_columns; ?>" name="display"
                                        value="columns" title="<?php echo LISTING_SORT_COLUMNS; ?>">
                                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M149.333 56v80c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24V56c0-13.255 10.745-24 24-24h101.333c13.255 0 24 10.745 24 24zm181.334 240v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24h101.333c13.256 0 24.001-10.745 24.001-24zm32-240v80c0 13.255 10.745 24 24 24H488c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24H386.667c-13.255 0-24 10.745-24 24zm-32 80V56c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24h101.333c13.256 0 24.001-10.745 24.001-24zm-205.334 56H24c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24zM0 376v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zm386.667-56H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H386.667c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24zm0 160H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H386.667c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24zM181.333 376v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24z"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="pull-left vivod_ vivod_list">
                                <button class="btn-link list <?php echo $display_hover_list; ?>" name="display"
                                        value="list" title="<?php echo LISTING_SORT_LIST; ?>">
                                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path d="M12.83 352h262.34A12.82 12.82 0 0 0 288 339.17v-38.34A12.82 12.82 0 0 0 275.17 288H12.83A12.82 12.82 0 0 0 0 300.83v38.34A12.82 12.82 0 0 0 12.83 352zm0-256h262.34A12.82 12.82 0 0 0 288 83.17V44.83A12.82 12.82 0 0 0 275.17 32H12.83A12.82 12.82 0 0 0 0 44.83v38.34A12.82 12.82 0 0 0 12.83 96zM432 160H16a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm0 256H16a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16z"></path>
                                    </svg>
                                </button>
                            </div>
                            <svg class="fa-spin" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M370.72 133.28C339.458 104.008 298.888 87.962 255.848 88c-77.458.068-144.328 53.178-162.791 126.85-1.344 5.363-6.122 9.15-11.651 9.15H24.103c-7.498 0-13.194-6.807-11.807-14.176C33.933 94.924 134.813 8 256 8c66.448 0 126.791 26.136 171.315 68.685L463.03 40.97C478.149 25.851 504 36.559 504 57.941V192c0 13.255-10.745 24-24 24H345.941c-21.382 0-32.09-25.851-16.971-40.971l41.75-41.749zM32 296h134.059c21.382 0 32.09 25.851 16.971 40.971l-41.75 41.75c31.262 29.273 71.835 45.319 114.876 45.28 77.418-.07 144.315-53.144 162.787-126.849 1.344-5.363 6.122-9.15 11.651-9.15h57.304c7.498 0 13.194 6.807 11.807 14.176C478.067 417.076 377.187 504 256 504c-66.448 0-126.791-26.136-171.315-68.685L48.97 471.03C33.851 486.149 8 475.441 8 454.059V320c0-13.255 10.745-24 24-24z"></path>
                            </svg>
                        </div>
                    <?php endif ?>
                    <!--LIST_QUANTITY_PAGE-->
                    <?php if ($template->show('LIST_QUANTITY_PAGE')) : ?>
                        <div class="col-sm-3 text-right col-xs-8 dd_select">
                            <span class="listing-header-punkt"><?php echo LISTING_PER_PAGE; ?></span> <?php echo tep_draw_pull_down_menu(
                                'row_by_page',
                                $row_bypage_array,
                                ($_GET['row_by_page'] == 'all' ? 'all' : (int)$_GET['row_by_page']),
                                'id="pl_onpage"'
                                                               ); ?>
                        </div>
                    <?php endif ?>
                    <!--LIST_SORTING-->
                    <?php if ($template->show('LIST_SORTING')) : ?>
                        <div class="col-sm-6 text-right col-xs-12 dd_select pl_sort">
                            <span class="listing-header-punkt"><?php echo TEXT_SORT_PRODUCTS; ?></span> <?php echo tep_draw_pull_down_menu(
                                'sort',
                                $r_sort_array,
                                $_GET['sort'],
                                'id="pl_sort"'
                                                               ); ?>
                        </div>
                    <?php endif ?>
                    <?php if (PRODUCT_LIST_FILTER == 'true' && file_exists(DIR_WS_EXT . 'pdf_export/pdf.php')) { ?>
                        <div class="col-sm-1 text-right dd_select" id="pdf_block">
                            <?php if (RTPL_PDF_ENABLED && $current_category_id != 0) {
                                echo $output = sprintf(
                                    RTPL_LISTING_HEADER,
                                    tep_href_link(
                                        basename($PHP_SELF),
                                        tep_get_all_get_params(array('language')) . 'pdf=true'
                                    )
                                );
                            } ?>
                        </div>
                    <?php } ?>
                </div>
            </noindex>
            <div class="clear"></div>
        </div>
    <?php } ?>
    <?= !empty(trim($seo_text_top)) ? '<p>' . $seo_text_top . '</p>' : '' ?>
    <div class="form-group row hidden-md">
        <div class="col-md-6 col-xs-3">
            <button type="button" class="btn btn-xs btn-primary sidebar-toggle-up">
                <!--                --><?php //echo PROD_FILTERS; ?>
                <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M487.976 0H24.028C2.71 0-8.047 25.866 7.058 40.971L192 225.941V432c0 7.831 3.821 15.17 10.237 19.662l80 55.98C298.02 518.69 320 507.493 320 487.98V225.941l184.947-184.97C520.021 25.896 509.338 0 487.976 0z"></path>
                </svg>
            </button>
        </div>
    </div>

    <div id="block">
        <?php include(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING_COL); // products listing ?>
    </div>
    <?php
    if (isset($seoFilterInfo) && $seoFilterInfo) {
        $desc_text = $seoFilterInfo['description'];
    } elseif (is_array($searchResultsQuery) && $searchResultsQuery["seo_text"]) {
        $desc_text = $searchResultsQuery["seo_text"];
    }
    ?>
    <?php if (!empty($desc_text)) { ?>
        <div class="magazine_articles">
            <?php
            if (!empty($cat_image) and $cat_image != 'categories/') {
                echo '<img class="lazyload" src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="getimage/300x150/' . $cat_image . '" alt="' . $heading_text_box . '">';
            }
            if (empty($_GET['page']) or $_GET['page'] == 1) {
                echo $desc_text;
            }
            ?>
        </div>
    <?php } ?>

</div>

<?php echo $m_srch; // ajax-form, where we adding hidden values of current selected attributes ?>
