<!--/////////////  ARTICLES BOTTOM /////////////-->
<div class="col-sm-4 col-xs-12">
    <div class="section_top_footer">
        <h3><?php echo FOOTER_ARTICLES; ?></h3>
        <nav class="list_footer">
            <ul>
                <?php
                $art_array = getArticles(13, 7);  // 13 - id for Articles
                $all_articles_string = '';

                if (is_array($art_array)) {
                    foreach ($art_array as $articles) {
                        $link = $_SERVER['REQUEST_URI'];
                        $link = $link != '/' ? substr($link, 1, strlen($link)) : $link;
                        $active = $articles['link'] == $link ? 'class="active"' : '';
                        $all_articles_string .= '<li><a ' . $active . ' href="' . $articles['link'] . '">' . $articles['name'] . '</a></li>';
                    }
                }
                echo $all_articles_string;

                ?>
            </ul>
        </nav>
    </div>
</div>

<!--///////////// END ARTICLES BOTTOM /////////////-->
