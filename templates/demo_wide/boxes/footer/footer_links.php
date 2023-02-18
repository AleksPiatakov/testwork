<!-- FOOTER INFO -->
<div class="col-sm-4 col-xs-12">
    <div class="section_top_footer">
        <div class="h3"><?php echo FOOTER_INFO; ?></div>
        <a href="#" rel="nofollow" class="toggle-xs" data-target="#footer_information"></a>
        <nav class="list_footer" id="footer_information">
            <ul>
                <?php
                $art_array = getArticles(
                    $config['id']['val'] ?: 16,
                    (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 7)
                );  // 16 - id for "Information"
                if (is_array($art_array)) {
                    foreach ($art_array as $articles) {
                        $link = $_SERVER['REQUEST_URI'];
                        $link = $link != '/' ? substr($link, 1, strlen($link)) : $link;
                        $active = $articles['link'] == $link ? 'class="active"' : '';
                        echo '<li><a ' . $active . ' href="' . $articles['link'] . '">' . $articles['name'] . '</a></li>';
                    }
                }
                ?>
            </ul>
        </nav>
    </div>
</div>
<!-- END FOOTER INFO -->
