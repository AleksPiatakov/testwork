<div class="category">
    <?php if (!empty($heading_text_box)) : ?>
        <h1 class="like_h2"><?php echo $heading_text_box; ?></h1>
    <?php endif; ?>
    <?php if (is_array($subcat_array)) { ?>
        <div class="form-group subcats_imgs">
            <?php
            switch (count($subcat_array)) {
                case 1:
                    $browse_categories_class = 'col-3';
                    break;
                case 2:
                    $browse_categories_class = 'col-4';
                    break;
                case 3:
                    $browse_categories_class = 'col-4';
                    break;
                case 4:
                    $browse_categories_class = 'col-3';
                    break;
                case 6:
                    $browse_categories_class = 'col-2';
                    break;
                default:
                    $browse_categories_class = 'col-half-2';
                    break;
            }
            if (is_array($subcat_array) and !empty($subcat_array)) {
                $category_str = '';
                foreach ($subcat_array as $cid => $carr) {
                    $category_str .= '<div class="' . $browse_categories_class . ' browse_categories_item">
                                    <a href="' . tep_href_link(FILENAME_DEFAULT, 'cPath=' . $cid, 'NONSSL') . '">';
                    if (isset($cat_imgs[$cid]) && $cat_imgs[$cid]) {
                        $category_str .= $carr['img'];
                    } // show image
                    $category_str .= '<span>';
                    $category_str .= $carr['name'] . '</span>
                              </a>
                            </div>';
                }
                echo $category_str;
            } ?>
        </div>
    <?php } ?>
    <div class="listing_header">
        <noindex>
            <div class="row">
                <div class="col-9 product_sorting">
                    <!--LIST_QUANTITY_PAGE-->
                    <?php if ($template->show('LIST_SORTING')) : ?>
                        <span class="listing_header_punkt"><?php echo TEXT_SORT_PRODUCTS; ?></span> <?php echo tep_draw_pull_down_menu(
                            'sort',
                            $r_sort_array,
                            $_GET['sort'],
                            'id="pl_sort"'
                                                           ); ?>
                    <?php endif ?>
                    <?php if ($template->show('LIST_QUANTITY_PAGE')) : ?>
                        <span class="listing_header_punkt"><?php echo LISTING_PER_PAGE; ?></span>  <?php echo tep_draw_pull_down_menu(
                            'row_by_page',
                            $row_bypage_array,
                            ($_GET['row_by_page'] == 'all' ? 'all' : (int)$_GET['row_by_page']),
                            'id="pl_onpage"'
                                                           ); ?>
                    <?php endif ?>
                    <!--LIST_SORTING-->
                </div>
                <!-- LIST_CONCLUSION -->
                <?php if ($template->show('LIST_CONCLUSION')) : ?>
                    <div class="col-3 product_output">
                        <?php if (
                        $template->show('LIST_SHOW_PDF_LINK') && file_exists(
                            DIR_WS_EXT . 'pdf_export/pdf.php'
                        )
) { ?>
                            <div id="pdf_block"><?php if (RTPL_PDF_ENABLED && $current_category_id != 0) {
                                    echo $output = sprintf(
                                        RTPL_LISTING_HEADER,
                                        tep_href_link(
                                            basename($PHP_SELF),
                                            tep_get_all_get_params(array('language')) . 'pdf=true'
                                        )
                                    );
                                                } ?></div>
                        <?php } ?>
                        <div class="vivod_ vivod_list">
                            <button class="btn-link list <?php echo $display_hover_list; ?>" name="display" value="list"
                                    title="<?php echo LISTING_SORT_LIST; ?>">
                                <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M149.333 216v80c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24v-80c0-13.255 10.745-24 24-24h101.333c13.255 0 24 10.745 24 24zM0 376v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zM125.333 32H24C10.745 32 0 42.745 0 56v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24zm80 448H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24zm-24-424v80c0 13.255 10.745 24 24 24H488c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24zm24 264H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24z"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="vivod_ vivod_columns">
                            <button class="btn-link columns <?php echo $display_hover_columns; ?>" name="display"
                                    value="columns" title="<?php echo LISTING_SORT_COLUMNS; ?>">
                                <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M149.333 56v80c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24V56c0-13.255 10.745-24 24-24h101.333c13.255 0 24 10.745 24 24zm181.334 240v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24h101.333c13.256 0 24.001-10.745 24.001-24zm32-240v80c0 13.255 10.745 24 24 24H488c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24H386.667c-13.255 0-24 10.745-24 24zm-32 80V56c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24h101.333c13.256 0 24.001-10.745 24.001-24zm-205.334 56H24c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24zM0 376v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zm386.667-56H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H386.667c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24zm0 160H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H386.667c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24zM181.333 376v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </noindex>
    </div>

    <div class="row" hidden>
        <div class="col-md-6 col-xs-3">
            <button type="button" class="btn btn-xs btn-primary sidebar-toggle-up">
                <!--                --><?php //echo PROD_FILTERS; ?>
                <i class="fa fa-filter"></i>
            </button>
        </div>
    </div>

    <?= !empty(trim($seo_text_top)) ? '<p>' . $seo_text_top . '</p>' : '' ?>

    <div id="block">
        <?php include(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING_COL); // products listing ?>
    </div>

    <?php if (!empty($desc_text)) { ?>
        <div class="magazine_articles">
            <?php
            if (!empty($cat_image) and $cat_image != 'categories/') {
                echo '<img class="lazyload" src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="getimage/' . $cat_image . '" alt="' . $heading_text_box . '">';
            }
            if (empty($_GET['page']) or $_GET['page'] == 1) {
                echo '<div>' . $desc_text . '</div>';
            }
            ?>
        </div>
    <?php } ?>

</div>

<?php echo $m_srch; // ajax-form, where we adding hidden values of current selected attributes ?>
