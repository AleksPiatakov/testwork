<!-- LOGO -->
<?php
if (LOGO_IMAGE) {
    $logo_str = '<img class="img-responsive" alt="' . LOGO_IMAGE_TITLE . '" src="' . HTTP_SERVER . '/' . str_replace("images/", "images/" . $logo_width . "x" . $logo_height . "/",
            LOGO_IMAGE) . '" />';
} else {
    $logo_str = '<p style="font-size: 18px;">' . STORE_NAME . '</p>';
}

echo '<div class="logo"><a href="' . tep_href_link('/') . '">' . $logo_str . '</a></div>';
?>
<!-- END LOGO -->