<?php

if (isset($_POST['insta_url'])) {
    chdir('../../');
    require_once 'includes/application_top.php';
    if (!defined('INSTAGRAM_POSTS_MARKUP') || !defined('INSTAGRAM_LAST_UPDATE')) {
        require_once 'check.php';
    }
    $dateDiff = date_diff(new DateTime(date("Y-m-d H:i:s")), new DateTime(INSTAGRAM_LAST_UPDATE));
    if ($dateDiff->y > 0 || $dateDiff->m > 0 || $dateDiff->d > 0) {
        $imgPath = isset($_POST['pixel_trans_url']) ? $_POST['pixel_trans_url'] : 'images/pixel_trans.png';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            [
                'authority: www.instagram.com',
                'cookie: ' . $_POST['cookie'],
                'sec-fetch-dest: document',
                'sec-fetch-mode: navigate',
                'sec-fetch-site: none',
                'sec-fetch-user: ?1',
                'upgrade-insecure-requests: 1',
            ]
        );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
        curl_setopt($ch, CURLOPT_REFERER, 'www.instagram.com');
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_4_1 like Mac OS X) AppleWebKit/605.1.15Z(KHTML, like Gecko) Version/13.1 Mobile/15E148 Safari/604.1 (Applebot/0.1)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_URL, $_POST['insta_url'] . '?__a=1');
        $instaResult = curl_exec($ch);
        $instaResult = json_decode($instaResult, false);
        $instaMarkup = '';
        if ($instaResult) {
            foreach ($instaResult->graphql->user->edge_owner_to_timeline_media->edges as $pic) {
                $ii = 0;if ($ii <= 9) {
                    $instaMarkup .= '
                <a target="_blank" href="https://www.instagram.com/p/' . $pic->node->shortcode . '/">
                    <img class="lazyload" src="' . $imgPath . '" data-src="' . $pic->node->display_url . '" />
                    <p>' . $pic->node->edge_media_to_caption->edges[0]->node->text . '</p>
                </a>
                ';
                }
                $ii++;
            }
        }
             echo $instaMarkup;
        tep_db_query("UPDATE configuration set configuration_value = '" . addslashes($instaMarkup) . "' WHERE configuration_key = 'INSTAGRAM_POSTS_MARKUP'");
        tep_db_query("UPDATE configuration set configuration_value = now() WHERE configuration_key = 'INSTAGRAM_LAST_UPDATE'");
    } else {
        echo INSTAGRAM_POSTS_MARKUP;
    }
}
