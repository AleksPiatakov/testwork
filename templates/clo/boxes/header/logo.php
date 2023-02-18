<?php
if (LOGO_IMAGE) {
    $logoStyle = 'height: ' . $logo_height . 'px;';
    $logo_str = '<img class="img-responsive lazyload" alt="' . LOGO_IMAGE_TITLE . '" src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="' . HTTP_SERVER . '/' . str_replace("images/",
            "images/" . $logo_width . "x" . $logo_height . "/", LOGO_IMAGE) . '&r=x" />';
} else {
    $logoStyle = '';
    $logo_str = '<p style="font-size: 18px;">' . STORE_NAME . '</p>';
}
echo '<div class="logo" style="' . $logoStyle . '"><a href="' . tep_href_link('/') . '">' . $logo_str . '</a></div>';

