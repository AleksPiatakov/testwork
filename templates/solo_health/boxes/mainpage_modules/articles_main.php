<?php

$news_category = $config['id']['val'] ?: 14; // 14 - id for "News"
$limit = (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 3);
$art_array = getArticles($news_category, $limit, true, true);
$topicName = getTopicName($news_category, $languages_id);
$output = '';

if (is_array($art_array)) {
    foreach ($art_array as $articles) {
        $art_link = $articles['link'];
        $art_image = 'getimage/89x89/' . $articles['image'];
        $art_shorttext = tep_cut(strip_tags($articles['desc']), 125) . (strlen(
            strip_tags($articles['desc'])
        ) > 125 ? '...' : '');

        $atr_date = $articles['date'];
        $atr_date_long = tep_date_long_translate(strftime('%d %B %Y', strtotime($atr_date)));
        $atr_name = $articles['name'];
        $output .= '
  								<article>
  									<img  src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="' . $art_image . '" class="lazyload" alt="' . $atr_name . '">
  									<div class="info">
                                        <time datetime="' . date(
                                        'Y-m-d',
                                        strtotime($atr_date)
                                    ) . '">' . $atr_date_long . '</time>
                                        <h5 class="title"><a href="' . $art_link . '">' . $atr_name . '</a></h5>
  									</div>
  									<p>' . $art_shorttext . '</p>
  								</article>';
    }
}


if (COMMENTS_MODULE_ENABLED == 'true' && $template->show("M_LAST_COMMENTS")) {
    $class = 'col-lg-6 col-md-6 col-sm-12 col-xs-12';
} else {
    $class = 'col-xs-12';
}
?>

<!-- NEWS + REVIEWS -->
<div class="row row_news_customer_reviews">
            <!-- NEWS -->
        <div class="<?php echo $class; ?>">
            <div class="news">
                <div class="like_h2">
                    <?php echo $topicName;?>
                    <a href="<?php echo tep_href_link(FILENAME_ARTICLES, 'tPath=' . $news_category); ?>" class="view-all-btn" data-toggle="tooltip" data-placement="auto right" title="<?php echo mb_ucfirst_custom(FILTER_ALL." ".$topicName); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M80 280h256v48H80zM80 184h320v48H80zM80 88h352v48H80z"></path>
                            <g>
                                <path d="M80 376h288v48H80z"></path>
                            </g>
                        </svg>
                    </a>
                </div>
                <div class="content container_customer_reviews scrolbar_box">
                    <?php echo $output; ?>
                </div>

        </div>
            </div>
    <!-- END NEWS -->
    <!-- REVIEWS -->
        <?php if (COMMENTS_MODULE_ENABLED == 'true' && $template->show("M_LAST_COMMENTS")) { ?>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="customer_reviews white-rounded-box">
                    <div class="like_h2">
                        <?php echo MAIN_REVIEWS; ?>
                        <a href="<?php echo tep_href_link('allcomments.html'); ?>" class="view-all-btn"
                           data-toggle="tooltip" data-placement="auto right" title="<?php echo MAIN_REVIEWS_ALL; ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M80 280h256v48H80zM80 184h320v48H80zM80 88h352v48H80z"></path>
                                <g>
                                    <path d="M80 376h288v48H80z"></path>
                                </g>
                            </svg>
                        </a>
                    </div>
                    <div class="container_customer_reviews container_customer_reviews-wrap scrolbar_box">
                        <?php require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/boxes/mainpage_modules/last_comments.php'); ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
<!-- END REVIEWS -->
<!-- END NEWS + REVIEWS -->
