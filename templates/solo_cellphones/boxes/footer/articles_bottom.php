<!-- FOOTER ARTICLES -->
<div class="col-sm-4 col-xs-12 width-20">
    <div class="section_top_footer">
        <div class="h3"><?php echo FOOTER_ARTICLES; ?></div>
        <nav class="list_footer">
            <ul>
                <?php
                $art_array = getArticles(
                    $config['id']['val'] ?: 13,
                    (int)($config['limit']['val'] > 0 ? $config['limit']['val']: 7)
                );  // 13 - id for Articles
                $all_articles_string = '';

                if (is_array($art_array)) {
                    foreach ($art_array as $articles) {
                        $link = $_SERVER['REQUEST_URI'];
                        $link = $link != '/' ? substr($link, 1, strlen($link)) : $link;
                        $active = $articles['link'] == $link ? 'class="active"' : '';
                        $all_articles_string .= '<li><a ' . $active . ' href="' . $articles['link'] . '">' . $articles['name'] . '</a></li>';
                    }
                    echo $all_articles_string;
                }

                ?>
            </ul>
            <?php if (count(getArticles($config['id']['val'] ?: 13, 10)) > 7) {
                echo '<a href="' . tep_href_link(FILENAME_ARTICLES, 'tPath=13') . '">' . SHOW_ALL_ARTICLES . '</a>';
            } ?>
        </nav>
    </div>
</div>
<!-- END FOOTER ARTICLES -->
