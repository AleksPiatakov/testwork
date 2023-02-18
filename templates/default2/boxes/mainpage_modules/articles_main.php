<?php

$news_category = $config['id']['val'] ?: 14; // 14 - id for "News"
$limit = (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 3);
$art_array = getArticles($news_category, $limit, true, true);
$output = '';

if (is_array($art_array)) {
    foreach ($art_array as $articles) {
        $art_link = $articles['link'];
        $art_image = 'getimage/70x70/' . $articles['image'];
        $art_shorttext = tep_cut(strip_tags($articles['desc']), 60) . (strlen(
            strip_tags($articles['desc'])
        ) > 60 ? '...' : '');

        $atr_date = $articles['date'];
        $atr_date_long = tep_date_long_translate(strftime('%d %B %Y', strtotime($atr_date)));
        $atr_name = $articles['name'];
        $output .= '
  								<div class="block_news">
  									<img class="lazyload" src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="' . $art_image . '" alt="' . $atr_name . '"> 
  									<span class="all_info_news">
  									    <p class="title_news">
  									        <a href="' . $art_link . '">' . $atr_name . '</a>
  									    </p>
  									    <p class="text_news">' . $art_shorttext . '</p>
                                        <time class="time_news" datetime="' . date(
                                            'Y-m-d',
                                            strtotime($atr_date)
                                        ) . '">' . $atr_date_long . '</time>
  									</span> 
  								</div>';
    }
}


?>

<!-- NEWS + REVIEWS -->
<div class="row row_news_customer_reviews">
    <?php
    if (COMMENTS_MODULE_ENABLED == 'true') {
        require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/boxes/mainpage_modules/last_comments.php');
    }
    ?>
    <?php if (COMMENTS_MODULE_ENABLED == 'true') { ?>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <?php } else { ?>
        <div class="col-xs-12">
    <?php } ?>
            <!-- NEWS -->
            <div class="news">
                <div class="like_h2"><?php echo MAIN_NEWS; ?>
                    <a class="link_whole_list" href="<?php echo tep_href_link(
                        FILENAME_ARTICLES,
                        'tPath=' . $news_category
                    ); ?>"><?php echo MAIN_NEWS_ALL; ?></a>
                </div>
                <div class="container_customer_news">
                    <?php echo $output; ?>
                </div>
                <!-- NEWS SUBMIT BUTTON -->
                <?php
                if (is_file(DIR_WS_EXT . 'subscribe/subscribe.php')) {
                    require_once DIR_WS_EXT . 'subscribe/subscribe.php';
                }
                ?>
                <!-- END NEWS SUBMIT FORM -->
            </div>
            <!-- END NEWS -->
        </div>
    </div><!-- END NEWS + REVIEWS -->
