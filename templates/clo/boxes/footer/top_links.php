<!-- information //-->
<div class="col-sm-6">
    <div class="section_top_footer">
        <nav class="list_footer">
            <ul>
                <?php
                $art_array = getArticles(16, 7);  // 16 - id for "Information"
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
<!-- information_smend //-->
