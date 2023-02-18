<!-- TOP LINKS -->
<ul>
    <?php

    // php close HTML tags function
    function closetags($html)
    {
        preg_match_all('#<([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
        $openedtags = $result[1];
        preg_match_all('#</([a-z]+)>#iU', $html, $result);
        $closedtags = $result[1];
        $len_opened = count($openedtags);
        if (count($closedtags) == $len_opened) {
            return $html;
        }
        $openedtags = array_reverse($openedtags);
        for ($i = 0; $i < $len_opened; $i++) {
            if (!in_array($openedtags[$i], $closedtags)) {
                $html .= '</' . $openedtags[$i] . '>';
            } else {
                unset($closedtags[array_search($openedtags[$i], $closedtags)]);
            }
        }
        return $html;
    }

    $art_array = getArticles($config['id']['val'] ?: 16, (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 7), true, true);
    //    ($articles['image'])?$image=$articles['image']:$image='';

    if (is_array($art_array)) {
//        print_r($description);
        foreach ($art_array as $articles) {
            $description = !empty($articles['desc']) ? '<p>' . tep_cut(
                strip_tags(closetags($articles['desc'])),
                60
            ) . (strlen(strip_tags(closetags($articles['desc']))) > 60 ? '...' : '') . '</p>' : '';
            $image = !empty($articles['image']) ? '<img src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="getimage/64x64/' . ($articles['image']) . '" class="lazyload" alt="' . $articles['name'] . '" title="' . $articles['name'] . '" />' : '';
            $link = $_SERVER['REQUEST_URI'];
            $link = $link != '/' ? substr($link, 1, strlen($link)) : $link;
            $active = $articles['link'] == $link ? 'class="active"' : '';
//            echo '<li><a href="' . $articles['link'] . '">' . $articles['name'] . $description . '</a></li>';
            echo '<a ' . $active . ' href="' . $articles['link'] . '" class="menu-item">
                        ' . $image . '
                        <div class="link_info">
                            <span class="title">' . $articles['name'] . '</span>
                            ' . $description . '
                        </div>
                    </a>';
        }
    }
    ?>
</ul>
<!-- END TOP LINKS -->
