<!-- TOP LINKS -->
<ul class="dropdown-menu">
    <?php
    $art_array = getArticles($config['id']['val'] ?: 16, (int)($config['limit']['val'] > 0 ? $config['limit']['val']: 7));
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
<!-- END TOP LINKS -->
