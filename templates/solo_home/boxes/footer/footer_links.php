<!-- FOOTER INFO -->
<div class="section_top_footer">
    <a href="#footer_information" rel="nofollow" class="collapsed" data-toggle="collapse" aria-expanded="false"
       aria-controls="footer_information">
        <div class="h3"><?php echo FOOTER_INFO; ?></div>
        <span class="rotate_arrow">
            <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                <path d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"></path>
            </svg>
        </span>
    </a>
    <nav class="list_footer collapse" id="footer_information">
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
<!-- END FOOTER INFO -->
