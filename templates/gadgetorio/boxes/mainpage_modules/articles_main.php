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
                                    <a href="' . $art_link . '">
                                        <div class="info">
                                            <h5 class="title">' . $atr_name . '</h5>
                                            <time datetime="' . date(
                                                'Y-m-d',
                                                strtotime($atr_date)
                                            ) . '">' . $atr_date_long . '</time>
                                        </div>
                                        <p>' . $art_shorttext . '</p>
  									</a>
  								</article>';
    }
}


?>

<!-- NEWS + REVIEWS -->
<div class="row row_news_customer_reviews">
    <?php if (COMMENTS_MODULE_ENABLED == 'true' && $template->show("M_LAST_COMMENTS")) { ?>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <?php } else { ?>
        <div class="col-xs-12">
    <?php } ?>
            <!-- NEWS -->
            <div class="news">
                <div class="like_h2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M256 464c22.779 0 41.411-18.719 41.411-41.6h-82.823c0 22.881 18.633 41.6 41.412 41.6zm134.589-124.8V224.8c0-63.44-44.516-117.518-103.53-131.041V79.2c0-17.682-13.457-31.2-31.059-31.2s-31.059 13.518-31.059 31.2v14.559c-59.015 13.523-103.53 67.601-103.53 131.041v114.4L80 380.8v20.8h352v-20.8l-41.411-41.6z"></path>
                    </svg>
                    <?php echo $topicName;?>
                    <a href="<?php echo tep_href_link(FILENAME_ARTICLES, 'tPath=' . $news_category); ?>" class="view-all-btn"><?php echo mb_ucfirst_custom(FILTER_ALL." ".$topicName); ?></a>
                </div>
                <div class="content">
                    <?php echo $output; ?>
                </div>

            </div><!-- END NEWS -->
        </div>
        <?php if (COMMENTS_MODULE_ENABLED == 'true' && $template->show("M_LAST_COMMENTS")) { ?>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="customer_reviews white-rounded-box">
                    <div class="like_h2">
                        <?php echo MAIN_REVIEWS; ?>
                        <a href="<?php echo tep_href_link('allcomments.html'); ?>" class="view-all-btn">
                            <?php echo MAIN_REVIEWS_ALL; ?>
                        </a>
                    </div>
                    <div class="container_customer_reviews">
                        <?php require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/boxes/mainpage_modules/last_comments.php'); ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div><!-- END NEWS + REVIEWS -->
