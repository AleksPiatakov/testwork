<div class="category">
    <div class="listing-header form-group row">
        <noindex>
            <div class="row">
                <div class="col-md-12">
                    <?php if ($template->show('LIST_CONCLUSION')) : ?>
                        <?php if (!isMobile()) { ?>
                            <div class="select-view refresh_icon hidden-xs">
                                <div class="pull-left vivod_ vivod_columns">
                                    <button class="columns <?php echo $display_hover_columns; ?>" name="display"
                                            value="columns" data-toggle="tooltip" data-placement="auto top"
                                            title="<?php echo LISTING_SORT_COLUMNS; ?>"/>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M409.6 64H102.4C81.3 64 64 81.3 64 102.4v307.2c0 21.1 17.3 38.4 38.4 38.4h307.2c21.1 0 38.4-17.3 38.4-38.4V102.4c0-21.1-17.3-38.4-38.4-38.4zM179.2 409.6h-76.8v-76.8h76.8v76.8zm0-115.2h-76.8v-76.8h76.8v76.8zm0-115.2h-76.8v-76.8h76.8v76.8zm115.2 230.4h-76.8v-76.8h76.8v76.8zm0-115.2h-76.8v-76.8h76.8v76.8zm0-115.2h-76.8v-76.8h76.8v76.8zm115.2 230.4h-76.8v-76.8h76.8v76.8zm0-115.2h-76.8v-76.8h76.8v76.8zm0-115.2h-76.8v-76.8h76.8v76.8z"></path>
                                    </svg>
                                    </button>
                                </div>
                                <div class="pull-left vivod_ vivod_list">
                                    <button class="list <?php echo $display_hover_list; ?>" name="display" value="list"
                                            data-toggle="tooltip" data-placement="auto top"
                                            title="<?php echo LISTING_SORT_LIST; ?>"/>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M80 280h256v48H80zM80 184h320v48H80zM80 88h352v48H80z"></path>
                                        <g>
                                            <path d="M80 376h288v48H80z"></path>
                                        </g>
                                    </svg>
                                    </button>
                                </div>
                            </div>
                        <?php } ?>
                    <?php endif; ?>

                    <div class="sort-selector ">
                        <?php if ($template->show('LIST_SORTING')) : ?>
                            <div class="product-list-filter dd_select pl_sort">
                                <span class="listing-header-punkt"><?php echo TEXT_SORT_PRODUCTS; ?></span>
                                <?php echo tep_draw_pull_down_menu(
                                    'sort',
                                    $r_sort_array,
                                    $_GET['sort'],
                                    'id="pl_sort"'
                                ); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($template->show('LIST_QUANTITY_PAGE')) : ?>
                            <div class="listing-per-page dd_select">
                                <span class="listing-header-punkt"><?php echo LISTING_PER_PAGE; ?></span>
                                <?php echo tep_draw_pull_down_menu(
                                    'row_by_page',
                                    $row_bypage_array,
                                    ($_GET['row_by_page'] == 'all' ? 'all' : (int)$_GET['row_by_page']),
                                    'id="pl_onpage"'
                                ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
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
                </div>
            </div>
        </noindex>
        <div class="clear"></div>
    </div>
    <?= !empty(trim($seo_text_top)) ? '<p>' . $seo_text_top . '</p>' : '' ?>
    <div class="form-group row visible-xs">
        <div class="col-md-6 col-xs-3">
            <button type="button" class="btn btn-xs btn-primary sidebar-toggle-up">
                <!--                --><?php //echo PROD_FILTERS; ?>
                <i class="fa fa-filter"></i>
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
            <?php if (empty($_GET['page']) or $_GET['page'] == 1) {
                echo $desc_text;
            } ?>
        </div>
    <?php } ?>

</div>

<?php echo $m_srch; // ajax-form, where we adding hidden values of current selected attributes ?>
