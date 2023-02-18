<?php

$articles_category = $config['id']['val'] ?: 13;
$articles_limit = (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 5);
$art_array = getArticles($articles_category, $articles_limit, false, true);
$topicName = getTopicName($articles_category, $languages_id);
$all_articles_string = '';

if (is_array($art_array)) {
    foreach ($art_array as $articles) {
        if (!empty($articles['image'])) {
            $image = 'getimage/38x38/' . $articles['image'];
            $all_articles_string .= '<li><img class="lazyload" src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="' . $image . '" alt="' . $articles["name"] . '" width="38" height="38"><a href="' . $articles['link'] . '"><span>' . $articles['name'] . '</span></a></li>';
        } else {
            $all_articles_string .= '<li><a class="no_mg" href="' . $articles['link'] . '"><span>' . $articles['name'] . '</span></a></li>';
        }
    }

    ?>
    <!-- ARTICLES -->
    <div class="articles">
        <div class="like_h2"><?php echo $topicName;?>
	        <a href="<?php echo tep_href_link(FILENAME_ARTICLES, 'tPath=' . $articles_category);?>"><?php echo mb_ucfirst_custom(FILTER_ALL." ".$topicName);?></a>
        </div>
        <nav>
            <ul>
                <?php echo $all_articles_string; ?>
            </ul>
        </nav>
    </div><!-- END ARTICLES -->

    <?php
}
?>
