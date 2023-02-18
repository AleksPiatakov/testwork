<?php

$news_category = $config['id']['val'] ?: 14; // 14 - id for "News"
$limit = (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 3);
$art_array = getArticles($news_category, $limit, true, true);
$topicName = getTopicName($news_category, $languages_id);
$output = '';

if (is_array($art_array)) {
    foreach ($art_array as $articles) {
        $art_link = $articles['link'];
        $art_image = 'getimage/260x260/' . $articles['image'];
        $art_shorttext = tep_cut(strip_tags($articles['desc']), 250) . (strlen(
            strip_tags($articles['desc'])
        ) > 250 ? '...' : '');

        $atr_date = $articles['date'];
        $atr_date_long = tep_date_long_translate(strftime('%d.%m.%Y | %A', strtotime($atr_date)));
        $atr_name = $articles['name'];
        $output .= '
  								<article>
  									<a href="' . $art_link . '"><img class="lazyload" src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="' . $art_image . '" alt="' . $atr_name . '"></a> 
  									<time datetime="' . date('Y-m-d', strtotime($atr_date)) . '">' . $atr_date_long . '</time>
  									<h5><a href="' . $art_link . '">' . $atr_name . '</a></h5>
  									<a href="' . $art_link . '" class="read_more">' . HOME_ARTICLE_READ_MORE . '</a>
  								</article>';
    }
}


?>

<!-- NEWS + REVIEWS -->
<div class="row row_news_customer_reviews">
    <div class="col-xs-12">
        <!-- NEWS -->
        <div class="news">
            <div class="small_title">
                <a href="<?php echo tep_href_link(FILENAME_ARTICLES, 'tPath=' . $news_category); ?>">
                    <?php echo $topicName; ?>
                </a>
            </div>
            <div class="slider_news">
                <?php echo $output; ?>
            </div>
        </div><!-- END NEWS -->
    </div>
    <!-- NEWS SUBMIT BUTTON -->
    <?php
    if (is_file(DIR_WS_EXT . 'subscribe/subscribe.php')) {
        require_once DIR_WS_EXT . 'subscribe/subscribe.php';
    }
    ?>
    <!-- END NEWS SUBMIT FORM -->
</div><!-- END NEWS + REVIEWS -->
