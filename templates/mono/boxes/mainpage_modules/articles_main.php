<?php
$news_category = $config['id']['val'] ?: 14; // 14 - id for "News"
$module_is_ajax = isset($config['ajax']['val']) && $config['ajax']['val'] == '1' ? true : false;
$module_name = 'articles_main';
$item_limit_mobile = (int)($config['limit_mobile']['val'] > 0 ? $config['limit_mobile']['val']: 2);
$item_limit = (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 3);
$limit = isMobile() ? $item_limit_mobile : $item_limit;
$art_array = getArticles($news_category, $limit, true, true);
$topicName = getTopicName($news_category, $languages_id);
$output = '';
$art_image_h = $art_image_w = 89;
// set style for block news
if (isset($config['content_width']['val'])) {
    $config['content_width']['val'] = 'style="max-width:' . $config['content_width']['val'] . '"';
}

if (is_array($art_array)) {
    foreach ($art_array as $articles) {
        $art_link = $articles['link'];
        $art_image = 'getimage/' . $art_image_w . 'x' . $art_image_h . '/' . $articles['image'];
        $art_shorttext = tep_cut(
            strip_tags($articles['desc']),
            150
        ) . (strlen(strip_tags($articles['desc'])) > 150 ? '...' : '');

        $atr_date = $articles['date'];
        $atr_date_long = tep_date_long_translate(strftime('%d %B %Y', strtotime($atr_date)));
        $atr_name = $articles['name'];
        $output .= '<article>
                        <div class="news_block_wrapper">
                            <div class="news_block_img">
                                <img class="lazyload" src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="' . $art_image . '" alt="' . $atr_name . '" width="' . $art_image_w . '" height="' . $art_image_h . '">  								      
                            </div>
                            <div class="pad-left-0">
                                <time datetime="' . date('Y-m-d', strtotime($atr_date)) . '">
                                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm61.8-104.4l-84.9-61.7c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v141.7l66.8 48.6c5.4 3.9 6.5 11.4 2.6 16.8L334.6 349c-3.9 5.3-11.4 6.5-16.8 2.6z"></path>
                                    </svg>
                                    ' . $atr_date_long . '
                                </time>
                                <h5><a href="' . $art_link . '">' . $atr_name . '</a></h5>
                                <p>' . $art_shorttext . '</p>
                            </div>
                        </div>
                    </article>';
    }
}
if (!$template->getMainconf('MC_SHOW_LEFT_COLUMN') || isMobile()) {
    echo '<div class="' . ($template->getModuleSetting(
        'MAINPAGE',
        'M_ARTICLES_MAIN',
        'content_width'
    ) ? 'container' : 'container-fluid') . '">';
}
?>
<!-- NEWS + REVIEWS -->
<div class="row row_news_customer_reviews">
    <?php if (COMMENTS_MODULE_ENABLED == 'true' && $template->show("M_LAST_COMMENTS")) { ?>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 customer_reviews_overflow">
    <?php } else { ?>
        <div class="col-xs-12">
    <?php } ?>
            <!-- NEWS -->
            <div class="news">
                <div class="like_h2"><?php echo $topicName; ?>
                    <a href="<?php echo tep_href_link(FILENAME_ARTICLES, 'tPath=' . $news_category); ?>">
                        <span><?php echo mb_ucfirst_custom(FILTER_ALL." ".$topicName); ?></span>
                    </a>
                </div>
                <?php /*echo $output; */?>
            </div><!-- END NEWS -->

    <div class="container_customer_reviews-wrap scrolbar_box">
        <?php echo $output; ?>
        <!-- NEWS SUBMIT BUTTON -->
        <?php
        if (is_file(DIR_WS_EXT . 'subscribe/subscribe.php')) {
            require_once DIR_WS_EXT . 'subscribe/subscribe.php';
        }
        ?>
        <!-- END NEWS SUBMIT FORM -->
    </div>
    </div>
<?php if (COMMENTS_MODULE_ENABLED == 'true' && $template->show("M_LAST_COMMENTS")) { ?>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 customer_reviews_overflow">
        <div class="customer_reviews white-rounded-box">
            <div class="like_h2">
                <?php echo MAIN_REVIEWS; ?>
                <a href="<?php echo tep_href_link('allcomments.html'); ?>" class="view-all-btn">
                    <?php echo MAIN_REVIEWS_ALL; ?>
                </a>
            </div>
            <div class="container_customer_reviews scrolbar_box">
                <?php require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/boxes/mainpage_modules/last_comments.php'); ?>
            </div>
        </div>
    </div>
<?php } ?>
    </div><!-- END NEWS + REVIEWS -->
<?php if (!$template->getMainconf('MC_SHOW_LEFT_COLUMN') || isMobile()) {
    echo '</div>';
}
