<?php
$skipLanguageRedirect = $skipGeoPluginRedirect = $skipSessionRedirect = true;
require('includes/application_top.php');

if (!function_exists('CheckAuthentication')) {
    function CheckAuthentication()
    {
        // если мы в админке Оска тогда продолжаем

        $sessions = explode(';', $_SERVER['HTTP_COOKIE']);
        $adminCookie = array_filter($sessions, function ($cookie) {
            $cookie = explode('=', $cookie);
            return trim($cookie[0]) == 'osCAdminID';
        });

        if ($adminCookie) {
            $adminCookie = reset($adminCookie);
            $sId = explode('=', $adminCookie)[1];
            $query_add = "SELECT value FROM `sessions` WHERE `sesskey` = '" . trim($sId) . "'";
            $result_add = tep_db_query($query_add);

            $result = tep_db_fetch_array($result_add);

            if ($result && strstr($result['value'], 'login_first_name')) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

function isCustomizationPanelAvailable()
{
    return getenv('APP_ENV') == 'trial' ? true : CheckAuthentication();
}

if (isCustomizationPanelAvailable()) {
    if (getenv('APP_ENV') == 'trial') {
        function checkLogin($d)
        {
            $c = explode('.', $_SERVER['HTTP_HOST'])[0];
            $ch = curl_init();
            $s = "h" . "tt" . "ps://so" . "lom" . "ono.n" . "et/lo" . "ginCh" . "eck.p" . "h" . "p";
            curl_setopt($ch, CURLOPT_URL, $s);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt(
                $ch,
                CURLOPT_POSTFIELDS,
                "c=$c&d=$d"
            );
            $e = curl_exec($ch);
            curl_close($ch);
        }
        checkLogin(1);
    }
    $buy_tpl_link = 'https://solomono.net/' . $language_short_link . 'pricing.html?type=p&from=' . $_SERVER['SERVER_NAME'];
    $to_date = get_created();
//  $to_date=get_created(260);

    if (CheckAuthentication()) {
        $admin_link = '';
        $link_name = '';
        if (tep_not_null($_GET['products_id'])) {
            $link_name = CUSTOM_PANEL_EDIT_PRODUCT;
            $admin_link = HTTP_SERVER . '/' . $admin . '/products.php?action=new_product&pID=' . $_GET['products_id'];
        } elseif (tep_not_null($_GET['manufacturers_id'])) {
            $link_name = CUSTOM_PANEL_EDIT_MANUF;
            $admin_link = HTTP_SERVER . '/' . $admin . '/manufacturers.php?action=edit_manufacturers&id=' . $_GET['manufacturers_id'];
        } elseif (tep_not_null($_GET['articles_id'])) {
            $link_name = CUSTOM_PANEL_EDIT_ARTICLE;
            $admin_link = HTTP_SERVER . '/' . $admin . '/articles.php?action=edit_articles&id=' . $_GET['articles_id'];
        } elseif (tep_not_null($_GET['tPath'])) {
            $link_name = CUSTOM_PANEL_EDIT_SECTION;
            $admin_link = HTTP_SERVER . '/' . $admin . '/articles.php?action=topic&tPath=' . $_GET['tPath'];
        } elseif (tep_not_null($_GET['cPath'])) {
            $link_name = CUSTOM_PANEL_EDIT_CATEGORY;
            $admin_link = HTTP_SERVER . '/' . $admin . '/categories.php?action=edit_category&cID=' . $current_category_id;
        } elseif ($content == 'index_default') {
            $link_name = CUSTOM_PANEL_EDIT_SEO;
            $admin_link = HTTP_SERVER . '/' . $admin . '/articles.php?page=1&perPage=25&tPath=15&action=edit_articles&id=68'; //правильная ссылка?
        }
    }
    ?>
    <div class="open_custom_panel_btn" data-toggle="tooltip" data-placement="auto left" title=""
         data-original-title="Настройки админстратора">
        <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <g class="fa-group">
                <path
                        d="M487.75 315.6l-42.6-24.6a192.62 192.62 0 0 0 0-70.2l42.6-24.6a12.11 12.11 0 0 0 5.5-14 249.2 249.2 0 0 0-54.7-94.6 12 12 0 0 0-14.8-2.3l-42.6 24.6a188.83 188.83 0 0 0-60.8-35.1V25.7A12 12 0 0 0 311 14a251.43 251.43 0 0 0-109.2 0 12 12 0 0 0-9.4 11.7v49.2a194.59 194.59 0 0 0-60.8 35.1L89.05 85.4a11.88 11.88 0 0 0-14.8 2.3 247.66 247.66 0 0 0-54.7 94.6 12 12 0 0 0 5.5 14l42.6 24.6a192.62 192.62 0 0 0 0 70.2l-42.6 24.6a12.08 12.08 0 0 0-5.5 14 249 249 0 0 0 54.7 94.6 12 12 0 0 0 14.8 2.3l42.6-24.6a188.54 188.54 0 0 0 60.8 35.1v49.2a12 12 0 0 0 9.4 11.7 251.43 251.43 0 0 0 109.2 0 12 12 0 0 0 9.4-11.7v-49.2a194.7 194.7 0 0 0 60.8-35.1l42.6 24.6a11.89 11.89 0 0 0 14.8-2.3 247.52 247.52 0 0 0 54.7-94.6 12.36 12.36 0 0 0-5.6-14.1zm-231.4 36.2a95.9 95.9 0 1 1 95.9-95.9 95.89 95.89 0 0 1-95.9 95.9z"></path>
                <path fill="#fff" d="M256.35 319.8a63.9 63.9 0 1 1 63.9-63.9 63.9 63.9 0 0 1-63.9 63.9z"></path>
            </g>
        </svg>
    </div>
    <div class="custom_panel_block">
        <ul>
            <?php if (CheckAuthentication() && !isset($_GET['side'])) { ?>
                <li>
                    <a href="<?= HTTP_SERVER . '/' . $admin; ?>" target="_blank">
                        <img src="<?= HTTP_SERVER; ?>/favicon.ico" width="16"
                             height="16"><?= CUSTOM_PANEL_ADMIN_LOGIN; ?></a>
                    <!--src="<?php /*= HTTP_SERVER; */ ?>/favicon.ico"><?php /*= CUSTOM_PANEL_ADMIN_LOGIN; */ ?></a>-->
                </li>
                <?php
                $dayAmount = 14;
                if (getenv('APP_ENV') == 'trial' && $to_date) { ?>
                    <li>
                        <?php
                        $plural = function ($n, $form1, $form2, $form3) {
                            $plural = ($n % 10 == 1 && $n % 100 != 11 ? 0 : ($n % 10 >= 2 && $n % 10 <= 4 && ($n % 100 < 10 or $n % 100 >= 20) ? 1 : 2));
                            switch ($plural) {
                                case 0:
                                default:
                                    return $form1;
                                case 1:
                                    return $form2;
                                case 2:
                                    return $form3;
                            }
                        };
                        $dayAmount = date_diff(new DateTime(), new DateTime($to_date))->days;
                    if (new DateTime() > new DateTime($to_date)) {
                        $dayAmount = 0;
                    }
                    ?>
                        <span id="clock"><?php echo TIME_LEFT, ' ', $dayAmount, ' ', $plural($dayAmount, CUSTOM_PANEL_DATE1, CUSTOM_PANEL_DATE2, CUSTOM_PANEL_DATE3); ?>
                            <span date-to="<?php echo $to_date; ?>" data-lan="<?php echo $language; ?>"></span>
                        </span>
                    </li>
                    <li>
                        <span>
                            <a
                                target="_blank" href="<?php echo $buy_tpl_link; ?>"
                                class="buy_template_link"
                            ><?php echo getenv('APP_ENV') == 'demo' ? IMAGE_BUTTON_TEST_TEMPLATE : IMAGE_BUTTON_BUY_TEMPLATE; ?>
                            </a>
                        </span>
                    </li>
                <?php }
                if (!$to_date || $dayAmount != 0) { ?>
                <li class="palette_li collapse_li">
        <span class="collapsed collapse_btn" data-toggle="collapse" data-target="#site_palette" aria-expanded="false">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><g fill="#FFF"
                                                                                                fill-rule="evenodd"><path
                          d="M14 11l1.106.553c.096.048.175.127.223.223.124.247.024.548-.223.671l-5.317 2.659c-1.126.563-2.452.563-3.578 0L.894 12.447C.798 12.4.72 12.32.671 12.224c-.124-.247-.024-.548.223-.671L2 11l4.212 2.106c1.126.563 2.452.563 3.578 0L13.999 11z"
                          opacity=".3"/><path
                          d="M14 7l1.106.553c.096.048.175.127.223.223.124.247.024.548-.223.671l-5.317 2.659c-1.126.563-2.452.563-3.578 0L.894 8.447C.798 8.4.72 8.32.671 8.224c-.124-.247-.024-.548.223-.671L2 7 6.21 9.106c1.126.563 2.452.563 3.578 0L13.999 7z"
                          opacity=".7"/><path
                          d="M15.106 3.553L9.789.894C8.663.331 7.337.331 6.21.894L.894 3.553c-.247.123-.347.424-.223.67.048.097.127.176.223.224l5.317 2.659c1.126.563 2.452.563 3.578 0l5.317-2.659c.247-.123.347-.424.223-.67-.048-.097-.127-.176-.223-.224z"/></g></svg>
                    <?= CUSTOM_PANEL_PALETTE; ?>
          <span class="caret"></span>
                    <?php if (isMobile()) {
                        echo '<span class="close_palette"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z"></path></svg></span>';
                    } ?>
        </span>
                    <ul class="collapse drop_menu" id="site_palette">
                        <li class="change_color">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path
                                fill="#495056"
                                d="M13.571 12.286h-.627l-3.5-9.705C9.324 2.234 8.998 2 8.631 2H7.368c-.367 0-.693.234-.811.581l-3.501 9.705h-.627c-.237 0-.429.192-.429.428v.857c0 .237.192.429.429.429h3.428c.237 0 .429-.192.429-.429v-.857c0-.236-.192-.428-.429-.428h-.524l.624-1.715h4.086l.624 1.715h-.524c-.237 0-.429.192-.429.428v.857c0 .237.192.429.429.429h3.428c.237 0 .429-.192.429-.429v-.857c0-.236-.192-.428-.429-.428zM6.737 8.429L8 4.96 9.263 8.43H6.737z"/></svg>
                    <?= CUSTOM_PANEL_PALETTE_TEXT_COLOR; ?>
                </span>
                            <input class="change_color-input" data-configuration-key="MC_COLOR_1"
                                   data-color="sm-text-color"
                                   value="<?php echo $template->getMainconf('MC_COLOR_1'); ?>"/>
                            <span class="spectrum_block"></span>
                        </li>
                        <li class="change_color">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><g fill="none"
                                                                                                          fill-rule="evenodd"><path
                                    fill="#C8CACC"
                                    d="M3 6c.552 0 1 .448 1 1v8c0 .552-.448 1-1 1H1c-.552 0-1-.448-1-1V7c0-.552.448-1 1-1zm12 0c.552 0 1 .448 1 1s-.448 1-1 1H7c-.552 0-1-.448-1-1s.448-1 1-1z"/><path
                                    fill="#495056"
                                    d="M15 10H7c-.552 0-1 .448-1 1s.448 1 1 1h8c.552 0 1-.448 1-1s-.448-1-1-1z"/><path
                                    fill="#C8CACC"
                                    d="M15 14H7c-.552 0-1 .448-1 1s.448 1 1 1h8c.552 0 1-.448 1-1s-.448-1-1-1z"/><path
                                    fill="#495056"
                                    d="M15 0H1C.448 0 0 .448 0 1v2c0 .552.448 1 1 1h14c.552 0 1-.448 1-1V1c0-.552-.448-1-1-1z"/></g></svg>
                    <?= CUSTOM_PANEL_PALETTE_HEADER_BG; ?>
                </span>
                            <input class="change_color-input" data-color="sm-bg-header"
                                   data-configuration-key="MC_COLOR_4"
                                   value="<?php echo $template->getMainconf('MC_COLOR_4'); ?>"/>
                            <span class="spectrum_block"></span>
                        </li>
                        <li class="change_color">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><g fill="none"
                                                                                                        fill-rule="evenodd"><path
                                  fill="#B6B9BB"
                                  d="M15 5H7c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h8c.552 0 1-.448 1-1V6c0-.552-.448-1-1-1z"/><path
                                  fill="#495056"
                                  d="M15 13H1c-.552 0-1 .448-1 1v1c0 .552.448 1 1 1h14c.552 0 1-.448 1-1v-1c0-.552-.448-1-1-1z"/><path
                                  fill="#B6B9BB"
                                  d="M15 0H1C.448 0 0 .448 0 1v1c0 .552.448 1 1 1h14c.552 0 1-.448 1-1V1c0-.552-.448-1-1-1zM3 5H1c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h2c.552 0 1-.448 1-1V6c0-.552-.448-1-1-1z"/></g></svg>
                    <?= CUSTOM_PANEL_PALETTE_FOOTER_BG; ?>
                </span>
                            <input class="change_color-input" data-color="sm-bg-footer"
                                   data-configuration-key="MC_COLOR_5"
                                   value="<?php echo $template->getMainconf('MC_COLOR_5'); ?>"/>
                            <span class="spectrum_block"></span>
                        </li>
                        <li class="change_color">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><g fill="none"
                                                                                                        fill-rule="evenodd"><path
                                  fill="#C8CACC"
                                  d="M15 5H7c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h8c.552 0 1-.448 1-1V6c0-.552-.448-1-1-1zM15 13H7c-.552 0-1 .448-1 1v1c0 .552.448 1 1 1h8c.552 0 1-.448 1-1v-1c0-.552-.448-1-1-1z"/><path
                                  fill="#495056"
                                  d="M15 0H1C.448 0 0 .448 0 1v1c0 .552.448 1 1 1h14c.552 0 1-.448 1-1V1c0-.552-.448-1-1-1z"/><path
                                  fill="#C8CACC"
                                  d="M3 5H1c-.552 0-1 .448-1 1v2c0 .552.448 1 1 1h2c.552 0 1-.448 1-1V6c0-.552-.448-1-1-1zM3 11H1c-.552 0-1 .448-1 1v3c0 .552.448 1 1 1h2c.552 0 1-.448 1-1v-3c0-.552-.448-1-1-1z"/></g></svg>
                    <?= CUSTOM_PANEL_PALETTE_LINK_COLOR; ?>
                </span>
                            <input class="change_color-input" data-color="sm-link-color"
                                   data-configuration-key="MC_COLOR_2"
                                   value="<?php echo $template->getMainconf('MC_COLOR_2'); ?>"/>
                            <span class="spectrum_block"></span>
                        </li>
                        <li class="change_color">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><g fill="none"
                                                                                                        fill-rule="evenodd"><path
                                  fill="#C8CACC"
                                  d="M4.1 5c.497 0 .9.403.9.9v4.2c0 .497-.403.9-.9.9H.9c-.497 0-.9-.403-.9-.9V5.9c0-.497.403-.9.9-.9zm11 0c.497 0 .9.403.9.9v4.2c0 .497-.403.9-.9.9H7.9c-.497 0-.9-.403-.9-.9V5.9c0-.497.403-.9.9-.9zm0-5c.497 0 .9.403.9.9v1.2c0 .497-.403.9-.9.9H.9C.403 3 0 2.597 0 2.1V.9C0 .403.403 0 .9 0z"/><path
                                  fill="#495056"
                                  d="M11.1 13H4.9c-.497 0-.9.403-.9.9v1.2c0 .497.403.9.9.9h6.2c.497 0 .9-.403.9-.9v-1.2c0-.497-.403-.9-.9-.9z"/></g></svg>
                    <?= CUSTOM_PANEL_PALETTE_BTN_COLOR; ?>
                </span>
                            <input class="change_color-input" data-color="sm-btn-color"
                                   data-configuration-key="MC_COLOR_6"
                                   value="<?php echo $template->getMainconf('MC_COLOR_6'); ?>"/>
                            <span class="spectrum_block"></span>
                        </li>
                        <li class="change_color">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><g fill="none"
                                                                                                        fill-rule="evenodd"><path
                                  fill="#C8CACC"
                                  d="M4.1 5c.497 0 .9.403.9.9v4.2c0 .497-.403.9-.9.9H.9c-.497 0-.9-.403-.9-.9V5.9c0-.497.403-.9.9-.9zm11 0c.497 0 .9.403.9.9v4.2c0 .497-.403.9-.9.9H7.9c-.497 0-.9-.403-.9-.9V5.9c0-.497.403-.9.9-.9zm0-5c.497 0 .9.403.9.9v1.2c0 .497-.403.9-.9.9H.9C.403 3 0 2.597 0 2.1V.9C0 .403.403 0 .9 0z"/><path
                                  fill="#495056"
                                  d="M11.1 13H4.9c-.497 0-.9.403-.9.9v1.2c0 .497.403.9.9.9h6.2c.497 0 .9-.403.9-.9v-1.2c0-.497-.403-.9-.9-.9z"/></g></svg>
                    <?= CUSTOM_PANEL_PALETTE_BTN_TEXT_COLOR; ?>
                </span>
                            <input class="change_color-input" data-color="sm-btn-text-color"
                                   data-configuration-key="MC_COLOR_BTN_TEXT"
                                   value="<?php echo $template->getMainconf('MC_COLOR_BTN_TEXT'); ?>"/>
                            <span class="spectrum_block"></span>
                        </li>
                        <li class="change_color">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><g fill="none"
                                                                                                          fill-rule="evenodd"><path
                                    fill="#C8CACC"
                                    d="M15.1 14c.497 0 .9.403.9.9v.2c0 .497-.403.9-.9.9H.9c-.497 0-.9-.403-.9-.9v-.2c0-.497.403-.9.9-.9zm0-14c.497 0 .9.403.9.9v.2c0 .497-.403.9-.9.9H.9C.403 2 0 1.597 0 1.1V.9C0 .403.403 0 .9 0z"/><path
                                    fill="#495056"
                                    d="M15.1 4H.9c-.497 0-.9.403-.9.9v6.2c0 .497.403.9.9.9h14.2c.497 0 .9-.403.9-.9V4.9c0-.497-.403-.9-.9-.9z"/></g></svg>
                    <?= CUSTOM_PANEL_PALETTE_GREY_COLORS; ?>
                </span>
                            <input class="change_color-input" data-color="sm-grey-color"
                                   data-configuration-key="MC_COLOR_GREY"
                                   value="<?php echo $template->getMainconf('MC_COLOR_GREY'); ?>"/>
                            <span class="spectrum_block"></span>
                        </li>
                        <li class="change_color">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><g fill="none"
                                                                                                          fill-rule="evenodd"><path
                                    fill="#C8CACC"
                                    d="M15.1 14c.497 0 .9.403.9.9v.2c0 .497-.403.9-.9.9H.9c-.497 0-.9-.403-.9-.9v-.2c0-.497.403-.9.9-.9zm0-14c.497 0 .9.403.9.9v.2c0 .497-.403.9-.9.9H.9C.403 2 0 1.597 0 1.1V.9C0 .403.403 0 .9 0z"/><path
                                    fill="#495056"
                                    d="M15.1 4H.9c-.497 0-.9.403-.9.9v6.2c0 .497.403.9.9.9h14.2c.497 0 .9-.403.9-.9V4.9c0-.497-.403-.9-.9-.9z"/></g></svg>
                    <?= CUSTOM_PANEL_PALETTE_BG_COLOR; ?>
                </span>
                            <input class="change_color-input" data-color="sm-background"
                                   data-configuration-key="MC_COLOR_3"
                                   value="<?php echo $template->getMainconf('MC_COLOR_3'); ?>"/>
                            <span class="spectrum_block"></span>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="<?= HTTP_SERVER . '/' . $admin; ?>/whos_online.php" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                            <g fill="#FFF">
                                <g>
                                    <path d="M5.5 5C6.882 5 8 3.882 8 2.5S6.882 0 5.5 0 3 1.118 3 2.5 4.118 5 5.5 5z"
                                          transform="translate(0 3)"/>
                                    <path fill-opacity=".5"
                                          d="M7.7 7H3.3C1.478 7 0 8.008 0 9.25V10h11v-.75C11 8.008 9.522 7 7.7 7z"
                                          transform="translate(0 3)"/>
                                </g>
                                <g>
                                    <path d="M3.5 3C4.329 3 5 2.329 5 1.5S4.329 0 3.5 0 2 .671 2 1.5 2.671 3 3.5 3z"
                                          transform="translate(9 3)"/>
                                    <path fill-opacity=".5"
                                          d="M4.9 4H2.1C.94 4 0 4.672 0 5.5V6h7v-.5C7 4.672 6.06 4 4.9 4z"
                                          transform="translate(9 3)"/>
                                </g>
                            </g>
                        </svg>
                        <span class="custom_panel_name"><?= CUSTOM_PANEL_ADD_STATISTICS; ?><span>
                  <span class="custom_panel_grey"><?= CUSTOM_PANEL_ADD_ONLINE; ?></span>
                    <?php
                    $sql = "SELECT count(1) as count FROM whos_online";
                    $whosOnline = tep_db_fetch_array(tep_db_query($sql))['count'];

                    echo $whosOnline
                    ?>
              </span>
          </span>
                    </a>
                </li>


                <li class="collapse_li">
        <span class="collapsed collapse_btn" data-toggle="collapse" data-target="#add_new" aria-expanded="false">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path fill="#F8FDF9"
                                                                                                   fill-rule="evenodd"
                                                                                                   d="M8.5 1c.276 0 .5.224.5.5L8.999 7H14.5c.276 0 .5.224.5.5v1c0 .276-.224.5-.5.5H8.999L9 14.5c0 .276-.224.5-.5.5h-1c-.276 0-.5-.224-.5-.5L6.999 9H1.5c-.276 0-.5-.224-.5-.5v-1c0-.276.224-.5.5-.5h5.499L7 1.5c0-.276.224-.5.5-.5h1z"/></svg>
                    <?= CUSTOM_PANEL_ADD; ?>
          <span class="caret"></span>
        </span>
                    <ul class="collapse drop_menu" id="add_new">
                        <li>
                            <a href="<?= HTTP_SERVER . '/' . $admin; ?>/products.php?cPath=&amp;action=new_product"
                               target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                    <g fill="#495056" fill-rule="evenodd">
                                        <path fill-opacity=".3"
                                              d="M15.1 9H.9c-.497 0-.9.403-.9.9v1.2c0 .497.403.9.9.9h14.2c.497 0 .9-.403.9-.9V9.9c0-.497-.403-.9-.9-.9zM13.1 14H2.9c-.497 0-.9.403-.9.9v.2c0 .497.403.9.9.9h10.2c.497 0 .9-.403.9-.9v-.2c0-.497-.403-.9-.9-.9z"/>
                                        <path
                                                d="M11.1 0H4.9c-.497 0-.9.403-.9.9v5.2c0 .497.403.9.9.9h6.2c.497 0 .9-.403.9-.9V.9c0-.497-.403-.9-.9-.9z"/>
                                    </g>
                                </svg>
                                <?= CUSTOM_PANEL_ADD_PRODUCT; ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?= HTTP_SERVER . '/' . $admin; ?>/articles.php?tPath=&action=new_articles"
                               target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                    <g fill="none" fill-rule="evenodd">
                                        <path fill="#495056"
                                              d="M15.1 5H6.9c-.497 0-.9.403-.9.9v9.2c0 .497.403.9.9.9h8.2c.497 0 .9-.403.9-.9V5.9c0-.497-.403-.9-.9-.9zM15.1 0H6.9c-.497 0-.9.403-.9.9v1.2c0 .497.403.9.9.9h8.2c.497 0 .9-.403.9-.9V.9c0-.497-.403-.9-.9-.9z"/>
                                        <path fill="#C8CACC"
                                              d="M3.1 0H.9C.403 0 0 .403 0 .9v3.2c0 .497.403.9.9.9h2.2c.497 0 .9-.403.9-.9V.9c0-.497-.403-.9-.9-.9zM3.1 7H.9c-.497 0-.9.403-.9.9v1.2c0 .497.403.9.9.9h2.2c.497 0 .9-.403.9-.9V7.9c0-.497-.403-.9-.9-.9zM3.1 12H.9c-.497 0-.9.403-.9.9v2.2c0 .497.403.9.9.9h2.2c.497 0 .9-.403.9-.9v-2.2c0-.497-.403-.9-.9-.9z"/>
                                    </g>
                                </svg>
                                <?= CUSTOM_PANEL_ADD_PAGE; ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?= HTTP_SERVER . '/' . $admin; ?>/specials.php?page=1&amp;action=new"
                               target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                    <g fill="#495056" fill-rule="evenodd">
                                        <path fill-opacity=".5"
                                              d="M15.1 7H.9c-.497 0-.9.403-.9.9v.2c0 .497.403.9.9.9h14.2c.497 0 .9-.403.9-.9v-.2c0-.497-.403-.9-.9-.9z"/>
                                        <path
                                                d="M8 12c1.105 0 2 .895 2 2s-.895 2-2 2-2-.895-2-2 .895-2 2-2zM8 0c1.105 0 2 .895 2 2s-.895 2-2 2-2-.895-2-2 .895-2 2-2z"/>
                                    </g>
                                </svg>
                                <?= CUSTOM_PANEL_ADD_DISCOUNT; ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?= HTTP_SERVER . '/' . $admin; ?>/categories.php?cPath=&amp;action=new_category"
                               target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                    <g fill="#495056" fill-rule="evenodd">
                                        <path
                                                d="M7.1 0H.9C.403 0 0 .403 0 .9v1.2c0 .497.403.9.9.9h6.2c.497 0 .9-.403.9-.9V.9c0-.497-.403-.9-.9-.9zM10.1 6H.9c-.497 0-.9.403-.9.9v1.2c0 .497.403.9.9.9h9.2c.497 0 .9-.403.9-.9V6.9c0-.497-.403-.9-.9-.9zM9.1 12H.9c-.497 0-.9.403-.9.9v1.2c0 .497.403.9.9.9h8.2c.497 0 .9-.403.9-.9v-1.2c0-.497-.403-.9-.9-.9z"/>
                                        <path fill-opacity=".3"
                                              d="M15.1 0h-2.2c-.497 0-.9.403-.9.9v1.2c0 .497.403.9.9.9h2.2c.497 0 .9-.403.9-.9V.9c0-.497-.403-.9-.9-.9zM15.1 6h-1.2c-.497 0-.9.403-.9.9v1.2c0 .497.403.9.9.9h1.2c.497 0 .9-.403.9-.9V6.9c0-.497-.403-.9-.9-.9zM15.1 12h-1.2c-.497 0-.9.403-.9.9v1.2c0 .497.403.9.9.9h1.2c.497 0 .9-.403.9-.9v-1.2c0-.497-.403-.9-.9-.9z"/>
                                    </g>
                                </svg>
                                <?= CUSTOM_PANEL_ADD_CATEGORY; ?>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="<?= HTTP_SERVER . '/' . $admin; ?>/orders.php" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                            <g fill="#FFF">
                                <circle cx="5.018" cy="15.037" r="1" transform="rotate(-1.057 5.018 15.037)"/>
                                <circle cx="14.024" cy="15.023" r="1" transform="rotate(-88.635 14.024 15.023)"/>
                                <path fill-opacity=".5"
                                      d="M15.994 3.775c-.029-.098-.115-.163-.213-.17L3.467 2.324c-.115-.013-.254-.086-.307-.191-.155-.289-.253-.451-.499-.756C2.347.996 1.754 1.008.666 1 .298.996 0 1.211 0 1.573c0 .353.282.573.638.573.355 0 .87.02 1.063.077.192.057.347.37.404.642 0 .004 0 .008.004.012l.082.418 1.635 7.597c.099.589.299 1.076.593 1.45.344.439.797.658 1.345.658h8.672c.311 0 .577-.236.589-.544.016-.325-.245-.593-.572-.593H5.756c-.082 0-.2 0-.34-.114-.142-.122-.339-.402-.47-1.056-.114.01-.167.015-.159.012L15.14 8.796c.107-.016.189-.102.2-.211l.655-4.705c.008-.032.008-.069 0-.105z"/>
                                <path
                                        d="M3.155 2.133c-.155-.288-.253-.45-.498-.755C2.343.996 1.75 1.008.665 1 .298.996 0 1.21 0 1.573c0 .353.282.573.637.573.355 0 .869.02 1.06.077.193.057.348.37.405.642 0 .004 0 .008.004.012.008.049.081.414.081.418l1.633 7.597c.098.589.298 1.076.592 1.45.342.439.795.658 1.342.658h8.658c.31 0 .575-.236.587-.544.017-.325-.245-.593-.571-.593H5.746c-.081 0-.2 0-.339-.114-.142-.122-.338-.402-.469-1.056l-.175-.963c0-.012-1.555-7.49-1.608-7.597z"/>
                            </g>
                        </svg>
                        <span class="custom_panel_name"><?= CUSTOM_PANEL_ORDERS; ?>
            <span>
                  <span class="custom_panel_grey"><?= CUSTOM_PANEL_ORDERS_NEW; ?></span>
                    <?php
                    $sql = "SELECT COUNT(*) AS count FROM orders WHERE date_purchased ";
                    $sql .= ">= '" . date('Y-m-d 00:00:00') . "'";
                    $query = tep_db_query($sql);
                    $countRow = tep_db_fetch_array($query);
                    echo (int)$countRow['count']; ?>
              </span>
          </span>
                    </a>
                </li>

                    <?php if (CheckAuthentication() and $admin_link) : ?>
                    <li>
                        <a href="<?= $admin_link; ?>" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                <g fill="#FFF">
                                    <path
                                            d="M14.628 4.755L13.132 6.25 9.75 2.867l1.494-1.495c.238-.238.561-.372.898-.372.336 0 .659.134.897.372l1.59 1.588c.237.238.371.561.371.898 0 .336-.134.66-.372.897z"/>
                                    <path fill-opacity=".5"
                                          d="M1.349 11.173l-.345 3.103c-.022.197.047.393.187.533s.336.209.533.187l3.1-.342 7.551-7.552-3.477-3.477-7.549 7.548z"/>
                                </g>
                            </svg>
                            <span class="custom_panel_name"><?= CUSTOM_PANEL_EDIT . $link_name; ?><span>
              <span class="custom_panel_grey">
                        <?php
                        if ($content == 'product_info') {
                            echo $products_name;
                        } elseif ($content == 'index_products') {
                            echo $heading_text_box;
                        }
                        ?>
              </span>
            </span>
          </span>
                        </a>
                    </li>
                    <?php endif ?>
                <?php } ?>
            <?php } else { ?>
                <li>
                    <a href="https://solomono.net"><img src="<?= HTTP_SERVER; ?>/favicon.ico">SoloMono</a>
                </li>
                <?php if ($to_date) { ?>
                    <li>
                        <?php
                        $plural = function ($n, $form1, $form2, $form3) {
                            $plural = ($n % 10 == 1 && $n % 100 != 11 ? 0 : ($n % 10 >= 2 && $n % 10 <= 4 && ($n % 100 < 10 or $n % 100 >= 20) ? 1 : 2));
                            switch ($plural) {
                                case 0:
                                default:
                                    return $form1;
                                case 1:
                                    return $form2;
                                case 2:
                                    return $form3;
                            }
                        };
                        $dayAmount = date_diff(new DateTime(), new DateTime($to_date))->days;
    ?>
                        <span id="clock"><?php echo TIME_LEFT, ' ', $dayAmount, ' ', $plural($dayAmount, CUSTOM_PANEL_DATE1, CUSTOM_PANEL_DATE2, CUSTOM_PANEL_DATE3); ?>
          <span date-to="<?php echo $to_date; ?>" data-lan="<?php echo $language; ?>"></span>
        </span>
                    </li>
                <?php }
                if (!isset($_GET['side']) || $_GET['side'] !== 'admin') :
                    ?>
                    <li class="palette_li collapse_li">
        <span class="collapsed collapse_btn" data-toggle="collapse" data-target="#site_palette" aria-expanded="false">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><g fill="#FFF"
                                                                                                fill-rule="evenodd"><path
                          d="M14 11l1.106.553c.096.048.175.127.223.223.124.247.024.548-.223.671l-5.317 2.659c-1.126.563-2.452.563-3.578 0L.894 12.447C.798 12.4.72 12.32.671 12.224c-.124-.247-.024-.548.223-.671L2 11l4.212 2.106c1.126.563 2.452.563 3.578 0L13.999 11z"
                          opacity=".3"/><path
                          d="M14 7l1.106.553c.096.048.175.127.223.223.124.247.024.548-.223.671l-5.317 2.659c-1.126.563-2.452.563-3.578 0L.894 8.447C.798 8.4.72 8.32.671 8.224c-.124-.247-.024-.548.223-.671L2 7 6.21 9.106c1.126.563 2.452.563 3.578 0L13.999 7z"
                          opacity=".7"/><path
                          d="M15.106 3.553L9.789.894C8.663.331 7.337.331 6.21.894L.894 3.553c-.247.123-.347.424-.223.67.048.097.127.176.223.224l5.317 2.659c1.126.563 2.452.563 3.578 0l5.317-2.659c.247-.123.347-.424.223-.67-.048-.097-.127-.176-.223-.224z"/></g></svg>
                    <?= CUSTOM_PANEL_PALETTE; ?>
          <span class="caret"></span>
                    <?php if (isMobile()) {
                        echo '<span class="close_palette"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z"></path></svg></span>';
                    } ?>
        </span>
                        <ul class="collapse drop_menu" id="site_palette">
                            <li class="change_color">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path fill="#495056"
                                                                                                         d="M13.571 12.286h-.627l-3.5-9.705C9.324 2.234 8.998 2 8.631 2H7.368c-.367 0-.693.234-.811.581l-3.501 9.705h-.627c-.237 0-.429.192-.429.428v.857c0 .237.192.429.429.429h3.428c.237 0 .429-.192.429-.429v-.857c0-.236-.192-.428-.429-.428h-.524l.624-1.715h4.086l.624 1.715h-.524c-.237 0-.429.192-.429.428v.857c0 .237.192.429.429.429h3.428c.237 0 .429-.192.429-.429v-.857c0-.236-.192-.428-.429-.428zM6.737 8.429L8 4.96 9.263 8.43H6.737z"/></svg>
                    <?= CUSTOM_PANEL_PALETTE_TEXT_COLOR; ?>
            </span>
                                <input class="change_color-input" data-color="sm-text-color"
                                       value="<?php echo $template->getMainconf('MC_COLOR_1'); ?>"/>
                                <span class="spectrum_block"></span>
                            </li>
                            <li class="change_color">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><g fill="none"
                                                                                                      fill-rule="evenodd"><path
                                fill="#C8CACC"
                                d="M3 6c.552 0 1 .448 1 1v8c0 .552-.448 1-1 1H1c-.552 0-1-.448-1-1V7c0-.552.448-1 1-1zm12 0c.552 0 1 .448 1 1s-.448 1-1 1H7c-.552 0-1-.448-1-1s.448-1 1-1z"/><path
                                fill="#495056"
                                d="M15 10H7c-.552 0-1 .448-1 1s.448 1 1 1h8c.552 0 1-.448 1-1s-.448-1-1-1z"/><path
                                fill="#C8CACC"
                                d="M15 14H7c-.552 0-1 .448-1 1s.448 1 1 1h8c.552 0 1-.448 1-1s-.448-1-1-1z"/><path
                                fill="#495056"
                                d="M15 0H1C.448 0 0 .448 0 1v2c0 .552.448 1 1 1h14c.552 0 1-.448 1-1V1c0-.552-.448-1-1-1z"/></g></svg>
                    <?= CUSTOM_PANEL_PALETTE_HEADER_BG; ?>
            </span>
                                <input class="change_color-input" data-color="sm-bg-header"
                                       value="<?php echo $template->getMainconf('MC_COLOR_4'); ?>"/>
                                <span class="spectrum_block"></span>
                            </li>
                            <li class="change_color">
            <span>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><g fill="none"
                                                                                                    fill-rule="evenodd"><path
                              fill="#B6B9BB"
                              d="M15 5H7c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h8c.552 0 1-.448 1-1V6c0-.552-.448-1-1-1z"/><path
                              fill="#495056"
                              d="M15 13H1c-.552 0-1 .448-1 1v1c0 .552.448 1 1 1h14c.552 0 1-.448 1-1v-1c0-.552-.448-1-1-1z"/><path
                              fill="#B6B9BB"
                              d="M15 0H1C.448 0 0 .448 0 1v1c0 .552.448 1 1 1h14c.552 0 1-.448 1-1V1c0-.552-.448-1-1-1zM3 5H1c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h2c.552 0 1-.448 1-1V6c0-.552-.448-1-1-1z"/></g></svg>
                    <?= CUSTOM_PANEL_PALETTE_FOOTER_BG; ?>
            </span>
                                <input class="change_color-input" data-color="sm-bg-footer"
                                       value="<?php echo $template->getMainconf('MC_COLOR_5'); ?>"/>
                                <span class="spectrum_block"></span>
                            </li>
                            <li class="change_color">
            <span>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><g fill="none"
                                                                                                    fill-rule="evenodd"><path
                              fill="#C8CACC"
                              d="M15 5H7c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h8c.552 0 1-.448 1-1V6c0-.552-.448-1-1-1zM15 13H7c-.552 0-1 .448-1 1v1c0 .552.448 1 1 1h8c.552 0 1-.448 1-1v-1c0-.552-.448-1-1-1z"/><path
                              fill="#495056"
                              d="M15 0H1C.448 0 0 .448 0 1v1c0 .552.448 1 1 1h14c.552 0 1-.448 1-1V1c0-.552-.448-1-1-1z"/><path
                              fill="#C8CACC"
                              d="M3 5H1c-.552 0-1 .448-1 1v2c0 .552.448 1 1 1h2c.552 0 1-.448 1-1V6c0-.552-.448-1-1-1zM3 11H1c-.552 0-1 .448-1 1v3c0 .552.448 1 1 1h2c.552 0 1-.448 1-1v-3c0-.552-.448-1-1-1z"/></g></svg>
                    <?= CUSTOM_PANEL_PALETTE_LINK_COLOR; ?>
            </span>
                                <input class="change_color-input" data-color="sm-link-color"
                                       value="<?php echo $template->getMainconf('MC_COLOR_2'); ?>"/>
                                <span class="spectrum_block"></span>
                            </li>
                            <li class="change_color">
            <span>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><g fill="none"
                                                                                                    fill-rule="evenodd"><path
                              fill="#C8CACC"
                              d="M4.1 5c.497 0 .9.403.9.9v4.2c0 .497-.403.9-.9.9H.9c-.497 0-.9-.403-.9-.9V5.9c0-.497.403-.9.9-.9zm11 0c.497 0 .9.403.9.9v4.2c0 .497-.403.9-.9.9H7.9c-.497 0-.9-.403-.9-.9V5.9c0-.497.403-.9.9-.9zm0-5c.497 0 .9.403.9.9v1.2c0 .497-.403.9-.9.9H.9C.403 3 0 2.597 0 2.1V.9C0 .403.403 0 .9 0z"/><path
                              fill="#495056"
                              d="M11.1 13H4.9c-.497 0-.9.403-.9.9v1.2c0 .497.403.9.9.9h6.2c.497 0 .9-.403.9-.9v-1.2c0-.497-.403-.9-.9-.9z"/></g></svg>
                    <?= CUSTOM_PANEL_PALETTE_BTN_COLOR; ?>
            </span>
                                <input class="change_color-input" data-color="sm-btn-color"
                                       value="<?php echo $template->getMainconf('MC_COLOR_6'); ?>"/>
                                <span class="spectrum_block"></span>
                            </li>
                            <li class="change_color">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><g fill="none"
                                                                                                      fill-rule="evenodd"><path
                                fill="#C8CACC"
                                d="M15.1 14c.497 0 .9.403.9.9v.2c0 .497-.403.9-.9.9H.9c-.497 0-.9-.403-.9-.9v-.2c0-.497.403-.9.9-.9zm0-14c.497 0 .9.403.9.9v.2c0 .497-.403.9-.9.9H.9C.403 2 0 1.597 0 1.1V.9C0 .403.403 0 .9 0z"/><path
                                fill="#495056"
                                d="M15.1 4H.9c-.497 0-.9.403-.9.9v6.2c0 .497.403.9.9.9h14.2c.497 0 .9-.403.9-.9V4.9c0-.497-.403-.9-.9-.9z"/></g></svg>
                    <?= CUSTOM_PANEL_PALETTE_BG_COLOR; ?>
            </span>
                                <input class="change_color-input" data-color="sm-background"
                                       value="<?php echo $template->getMainconf('MC_COLOR_3'); ?>"/>
                                <span class="spectrum_block"></span>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                <li>
        <span>
          <a target="_blank" href="<?php echo $buy_tpl_link; ?>"
             class="buy_template_link"><?php echo getenv('APP_ENV') == 'demo' ? IMAGE_BUTTON_TEST_TEMPLATE : IMAGE_BUTTON_BUY_TEMPLATE; ?></a>
        </span>
                </li>
            <?php } ?>
            <li>
        <span class="custom_panel_close">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><g fill="none"
                                                                                                fill-rule="evenodd"
                                                                                                opacity=".5"><path
                          fill="#000" fill-opacity="0" d="M2 2H14V14H2z"/><path fill="#FFF" fill-rule="nonzero"
                                                                                d="M14 3.2L12.8 2 8 6.8 3.2 2 2 3.2 6.8 8 2 12.8 3.2 14 8 9.2 12.8 14 14 12.8 9.2 8z"/></g></svg>
          <?php if (isMobile()) {
                echo HIGHSLIDE_CLOSE;
          } ?>
        </span>
            </li>
        </ul>
    </div>
    <script>
        var customPanelStatus = getCookie('custom_panel_status');
        if ($(window).width() > '991' && customPanelStatus != '0') {
            $('.custom_panel_block').addClass('visible');
        }else{
            $('.open_custom_panel_btn').addClass('anim');
        }
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.async = true;
        script.src = "includes/javascript/jquery.countdown/jquery.countdown.min.js";
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(script, s);

        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.async = true;
        script.src = "includes/javascript/jquery.countdown/initialization.js";
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(script, s);

        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.async = true;
        script.src = "includes/javascript/Spectrum/spectrum.min.js";
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(script, s);

        var link = document.createElement('link');
        link.type = 'text/css';
        link.rel = 'stylesheet';
        link.href = "includes/javascript/customization_panel.css";
        var s = document.getElementsByTagName('link')[0];
        s.parentNode.insertBefore(link, s);

        var link = document.createElement('link');
        link.type = 'text/css';
        link.rel = 'stylesheet';
        link.href = "includes/javascript/Spectrum/spectrum.min.css";
        var s = document.getElementsByTagName('link')[0];
        s.parentNode.insertBefore(link, s);
    </script>

    <div class="buy_template_margin"></div>
    <?php /* if (getenv('APP_ENV')!='demo' && $to_date==false): ?>
    <div class="col-xs-12 col-md-12">
      <h2 style="margin-top: 13px;text-align:center;"><?php echo MESSAGE_BUY_TEMPLATE1;?>
        <a target="_blank" href="<?php echo $buy_tpl_link;?>" class=""><?php echo MESSAGE_BUY_TEMPLATE2;?></a><?php echo MESSAGE_BUY_TEMPLATE3;?>
      </h2>
    </div>
    </body>
    <?php //die; ?>
  <?php endif; */ ?>
    <?php
}
