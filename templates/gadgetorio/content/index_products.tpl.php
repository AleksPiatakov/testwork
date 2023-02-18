<div class="category">
    <div class="listing-header form-group row">
        <noindex>
            <div class="row">
                <div class="col-md-12">
                    <div class="sort-selector">
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
                        <div class="pull-right"
                             id="pdf_block"><?php if (RTPL_PDF_ENABLED && $current_category_id != 0) {
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
            <button type="button" class="btn btn-xs btn-primary sidebar-toggle-up"><?php echo PROD_FILTERS; ?></button>
        </div>
    </div>

    <div id="block">
        <?php
        $default_cols = explode(';', $template->getMainconf('MC_PRODUCT_QNT_IN_ROW'));
        $tpl_settings = array(
            'request' => $listing_query,
            'id' => 'r_spisok',
            'classes' => array(
                'front_section',
                'cc-xs-' . $default_cols[0],
                'cc-sm-' . $default_cols[1],
                'cc-md-' . $default_cols[2],
                'cc-lg-' . $default_cols[3]
            ),
            'cols' => $config['cols']['val'] ?: 3,
            'compare' => true
        );

        include(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING_COL); // products listing
        ?>
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
