<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="category">
                <div class="category_heading">
                    <h1 class="category_heading_name"><?= stripslashes($heading_text_box); ?></h1>
                    <p><?php echo $current_category['categories_heading_title']; ?></p>
                    <?php echo tep_draw_hidden_field('row_by_page', $display_results_array[0]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <?php if ($file = $template->getFiles('LISTING', 'LIST_FILTER')) : ?>
                <?php if (file_exists($file)) : ?>
                    <?php require $file; ?>
                <?php endif; ?>
            <?php endif; ?>

            <!--            <div id="pdf_block">-->
            <?php //if(RTPL_PDF_ENABLED && $current_category_id!=0 ) echo $output = sprintf(RTPL_LISTING_HEADER, tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('language')).'pdf=true'));?><!--</div>-->

        </div>
    </div>
</div>
<hr>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <?= !empty(trim($seo_text_top)) ? '<p>' . $seo_text_top . '</p>' : '' ?>
            <div id="block">
                <?php include(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING_COL); ?>
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
                        echo '<img class="lazyload" src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="getimage/' . $cat_image . '" alt="' . $heading_text_box . '">';
                    }
                    if (empty($_GET['page']) or $_GET['page'] == 1) {
                        echo $desc_text;
                    }
                    ?>
                </div>
            <?php } ?>

        </div>
        <?php echo $m_srch; // ajax-form, where we adding hidden values of current selected attributes ?>
    </div>
</div>
