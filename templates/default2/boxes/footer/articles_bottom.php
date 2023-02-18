<!-- FOOTER ARTICLES -->
<div class="section_footer col-sm-3 col-xs-12">
    <div class="h3"><?php echo FOOTER_ARTICLES; ?></div>
    <a href="#" class="toggle-xs" data-target="#footer_articles"></a>
    <ul class="list_footer" id="footer_articles">
        <?php
        $art_array = getArticles($config['id']['val'] ?: 13, (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 7));  // 13 - id for Articles
        $all_articles_string = '';
        $fi = 1;

        if (is_array($art_array)) {
            foreach ($art_array as $articles) {
                $link = $_SERVER['REQUEST_URI'];
                $link = $link != '/' ? substr($link, 1, strlen($link)) : $link;
                $active = $articles['link'] == $link ? 'class="active"' : '';
                $all_articles_string .= '<li><a ' . $active . ' href="' . $articles['link'] . '">' . $articles['name'] . '</a></li>';

                if ($fi >= 3) {
                    break;
                }
                $fi++;
            }
            echo $all_articles_string;
        }

        ?>
        <?php if (count($art_array) > 3) {
            echo '<li><a class="show_all_link" href="' . tep_href_link(
                FILENAME_ARTICLES,
                'tPath=13'
            ) . '">' . DEMO2_SHOW_ALL_ARTICLES . '</a></li>';
        } ?>
    </ul>
</div>
<!-- END FOOTER ARTICLES -->
