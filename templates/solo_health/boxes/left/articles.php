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
            $all_articles_string .= '<li><a href="' . $articles['link'] . '"><img class="lazyload" src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="' . $image . '" alt="' . $articles["name"] . '"><span>' . $articles['name'] . '</span></a></li>';
        } else {
            $all_articles_string .= '<li><a href="' . $articles['link'] . '"><span>' . $articles['name'] . '</span></a></li>';
        }
    }

    ?>
    <!-- ARTICLES -->
    <div class="articles">
        <div class="like_h2">
            <?php echo $topicName;?>
            <a href="<?php echo tep_href_link(FILENAME_ARTICLES, 'tPath=' . $articles_category);?>" class="view-all-btn" data-toggle="tooltip" data-placement="auto right" title="<?php echo mb_ucfirst_custom(FILTER_ALL." ".$topicName); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M80 280h256v48H80zM80 184h320v48H80zM80 88h352v48H80z"></path>
                    <g>
                        <path d="M80 376h288v48H80z"></path>
                    </g>
                </svg>
            </a>
        </div>

        <nav>
            <ul>
                <?php echo $all_articles_string; ?>
            </ul>
        </nav>

    </div>
    <!-- END ARTICLES -->

    <?php
}
?>
