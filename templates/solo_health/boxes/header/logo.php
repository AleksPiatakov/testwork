<!-- LOGO -->
<div class="col-lg-3 col-md-2 col-sm-3 col-xs-5 header-logo-block">
    <div class="logo">
        <?php
        if (LOGO_IMAGE) {
            $logo_str = '<img class="img-responsive" alt="' . LOGO_IMAGE_TITLE . '" src="' . HTTP_SERVER . '/' . str_replace("images/", "images/" . $logo_width . "x" . $logo_height . "/",
                    LOGO_IMAGE) . '&r=x" />';
        } else {
            $logo_str = '<p style="font-size: 18px;">' . STORE_NAME . '</p>';
        }
        echo '<div class="logo-link"><a href="' . tep_href_link('/') . '">' . $logo_str . '</a></div>';
        ?>
    </div>
</div>
<!-- END LOGO -->
