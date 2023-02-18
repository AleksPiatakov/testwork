<?php

$article_info_query = tep_db_query(
    "select a.articles_id, ad.articles_name, ad.articles_description from " . TABLE_ARTICLES . " a, " . TABLE_ARTICLES_DESCRIPTION . " ad where a.articles_status = '1' and a.articles_id = '" . (int)$_GET['articles_id'] . "' and ad.articles_id = a.articles_id and ad.language_id = '" . (int)$languages_id . "'"
);
$article_info = tep_db_fetch_array($article_info_query);

tep_db_query(
    "update " . TABLE_ARTICLES_DESCRIPTION . " set articles_viewed = articles_viewed+1 where articles_id = '" . (int)$_GET['articles_id'] . "' and language_id = '" . (int)$languages_id . "'"
);
?>
<?php
if (!$sidebar_left) {
    echo '<div class="' . ($template->getMainconf('CONTENT_WIDTH') ? 'container' : 'container-fluid') . '">';
}
if ($article_check['articles_status'] < 1) {
    ?>
    <div>
        <h1 class="pageHeading"><?php echo HEADING_ARTICLE_NOT_FOUND; ?></h1>
    </div>
    <div>
        <?php echo TEXT_ARTICLE_NOT_FOUND; ?>
    </div>

    <?php
} else {
    ?>
    <h1 class="pageHeading"><?php echo $article_info['articles_name']; ?></h1>
    <div class="article_content">
        <?php echo stripcslashes($article_info['articles_description']); ?>
    </div>
    <?php
//added for cross-sell
    if ((USE_CACHE == 'true') && !SID) {
        include(DIR_WS_MODULES . FILENAME_ARTICLES_XSELL);
    } else {
        include(DIR_WS_MODULES . FILENAME_ARTICLES_XSELL);
    }
}
if (!$sidebar_left) {
    echo '</div>';
}
?>
