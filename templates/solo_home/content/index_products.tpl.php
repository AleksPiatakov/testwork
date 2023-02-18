<div class="category">
    <h1 class="category_heading"><?= stripslashes($heading_text_box); ?></h1>
    <?php if ($template->show('LIST_SHOW_PDF_LINK') && file_exists(DIR_WS_EXT . 'pdf_export/pdf.php')) { ?>
        <div id="pdf_block"><?php if (RTPL_PDF_ENABLED && $current_category_id != 0) {
                echo $output = sprintf(
                    RTPL_LISTING_HEADER,
                    tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('language')) . 'pdf=true')
                );
                            } ?></div>
    <?php } ?>
    <div class="listing-header form-group row">
        <noindex>
            <div class="row">
                <div class="col-xs-12">
                    <div class="sort-selector dd_select">
                        <?php if ($template->show('LIST_QUANTITY_PAGE')) : ?>
                            <div class="listing-per-page">
                                <span class="listing-header-punkt"><?php echo LISTING_PER_PAGE; ?></span>
                                <?php echo tep_draw_pull_down_menu(
                                    'row_by_page',
                                    $row_bypage_array,
                                    ($_GET['row_by_page'] == 'all' ? 'all' : (int)$_GET['row_by_page']),
                                    'id="pl_onpage"'
                                ); ?>
                            </div>
                        <?php endif ?>
                        <?php if ($template->show('LIST_SORTING')) : ?>
                            <div class="product-list-filter">
                                <span class="listing-header-punkt"><?php echo TEXT_SORT_PRODUCTS; ?></span>
                                <?php if (!isMobile()) { ?>
                                    <div class="sorting_block">
                                        <?php
                                        foreach ($r_sort_array as $vals) {
                                            $isChecked = (isset($_GET['sort']) && $vals['id'] == $_GET['sort']) ? ' checked' : '';
                                            echo '<input type="radio" name="sort" value="' . $vals['id'] . '" id="pl_sort-' . $vals['id'] . '"' . $isChecked . '>';
                                            echo '<label for="pl_sort-' . $vals['id'] . '">' . $vals['text'] . '</label>';
                                        }
                                        ?>
                                    </div>
                                <?php } else { ?>
                                    <?php echo tep_draw_pull_down_menu(
                                        'sort',
                                        $r_sort_array,
                                        $_GET['sort'],
                                        'id="pl_sort"'
                                    ); ?>
                                <?php } ?>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </noindex>
        <div class="clear"></div>
    </div>
    <?= !empty(trim($seo_text_top)) ? '<p>' . $seo_text_top . '</p>' : '' ?>
    <div class="form-group row visible-xs visible-sm">
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
            <?php if (empty($_GET['page']) or $_GET['page'] == 1) {
                echo $desc_text;
            } ?>
        </div>
    <?php } ?>

</div>
<?php echo $m_srch; // ajax-form, where we adding hidden values of current selected attributes ?>

