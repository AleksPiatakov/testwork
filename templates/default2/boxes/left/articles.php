<?php

$articles_category = $config['id']['val'] ?: 13;
$articles_limit = (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 5);
$art_array = getArticles($articles_category, $articles_limit, false, true);
$all_articles_string = '';

if (is_array($art_array)) {
    foreach ($art_array as $articles) {
        $all_articles_string .= '<li><a href="' . $articles['link'] . '"><span>' . $articles['name'] . '</span></a></li>';
    }
    ?>
    <!-- ARTICLES -->
    <div class="articles_left">
        <div class="title_section_block">
            <div class="title_section"><?php echo BOX_HEADING_ARTICLES; ?></div>
            <a class="link_whole_list" href="<?php echo tep_href_link(
                FILENAME_ARTICLES,
                'tPath=' . $articles_category
            ); ?>"><?php echo BOX_ALL_ARTICLES; ?></a>
        </div>
        <ul class="articles_left_body">
            <?php echo $all_articles_string; ?>
        </ul>
    </div>
    <!-- END ARTICLES -->

    <?php
}
?>            
