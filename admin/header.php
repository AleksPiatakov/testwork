<?php

$languages = tep_get_languages();
$languages_array = array();
$languages_selected = DEFAULT_LANGUAGE;

for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
    $languages_array[] = array('id' => $languages[$i]['code'],
        'text' => $languages[$i]['name']);
    if ($languages[$i]['directory'] == $language) {
        $languages_selected = $languages[$i]['code'];
    }
}

$pagesWithMenuArray = ['index.php'];

?>
<!-- header -->
<header id="header">
    <?php if($menu_location == '0'){?>
    <div class="container">
    <?php }?>
        <div class="header_left_col">
	        <a href="<?php print tep_href_link(FILENAME_DEFAULT); ?>" class="admin_logo" title="<?= HEADER_ADMIN_TEXT?>">
                <img src="<?=HTTP_SERVER;?>/favicon.ico" alt="admin logo">
                <span>
                    <?php if(!isMobile()) {echo HEADER_ADMIN_TEXT;}?>
                    <span><?=HEADER_ORDERS_TODAY;?> <?=getOrdersCountForPeriod(date("Y-m-d 00:00:00"))?></span>
                </span>

                <?php
                /*
               $site_name = tep_db_query("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " WHERE configuration_group_id = '1' AND configuration_key = 'STORE_NAME'");
               $site_name = tep_db_fetch_array($site_name);
               print $site_name['configuration_value']; */
                ?>
            </a>

            <a target="_blank" href="<?= HTTP_SERVER.'/'.$languages_code?>" class="admin-go-to-site" title="<?= HEADER_FRONT_LINK_TEXT?>">
                <?php if(!isMobile()) {
                    echo HEADER_GO_TO_SITE;
                    } else { echo '<i class="fa fa-external-link-square" aria-hidden="true"></i>';}
                ?>
            </a>

        </div>
        <div class="header_right_col">

            <?php if (isset($_GET['side'])) { ?>
                <a target="_blank" href="<?= DIR_WS_ADMIN; ?>configuration.php?gID=277" class="header_marketplace_link"><?= HEADER_MARKETPLACE_LINK;?></a>
            <?php } ?>

            <?php if (getenv('APP_ENV') == 'trial') {
                $sitaname = getenv('APP_NAME');
                ?>
            <a target="_blank" href="https://solomono.net/account/my_shops.php?sitename=<?php echo $sitaname; ?>&action=changePackage" class="header_buy_template_link"><?= HEADER_BUY_TEMPLATE_LINK;?></a>
            <?php } ?>
            <?php
            $sessionAlertErrors = [];
            if (!empty($_SESSION['alertErrors'])) {
                foreach ($_SESSION['alertErrors'] as $k => $v) {
                    if (isset($v['text'])) {
                        $sessionAlertErrors[$k]['text'] = constant($v['text']);
                    } else {
                        $sessionAlertErrors[$k]['text'] = $v;
                    }
                    if (isset($v['type'])) {
                        $sessionAlertErrors[$k]['type'] = $v['type'];
                    }
                    if (isset($v['critical_for_site'])) {
                        $sessionAlertErrors[$k]['critical_for_site'] = $v['critical_for_site'];
                    }
                    if (isset($v['domen_in_robots_txt'])) {
                        $sessionAlertErrors[$k]['domen_in_robots_txt'] = $v['domen_in_robots_txt'];
                    }
                }
            }
            ?>
            <span class="show_errors <?= (is_array($_SESSION['alertErrors']) && count($_SESSION['alertErrors']) > 0) ? '' : 'shown';?>" data-errors='<?= htmlspecialchars(json_encode($sessionAlertErrors));?>'>
                <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                    <path d="M569.517 440.013C587.975 472.007 564.806 512 527.94 512H48.054c-36.937 0-59.999-40.055-41.577-71.987L246.423 23.985c18.467-32.009 64.72-31.951 83.154 0l239.94 416.028zM288 354c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z"></path>
                </svg>
                <?php if(is_array($_SESSION['alertErrors']) && count($_SESSION['alertErrors']) > 0 && $_SESSION['alertErrors']['robots_txt']['critical_for_site'] == 'false') {
                    echo '<span class="count_err">' . count($_SESSION['alertErrors']) . '</span>';
                }?>
            </span>
            <form class="header_search_form" ui-shift="prependTo" data-target=".navbar-collapse" role="search" ng-controller="TypeaheadDemoCtrl" action="<?php print tep_href_link(FILENAME_CATEGORIES); ?>" method="get">
                <input type="text" ng-model="selected" typeahead="state for state in states | filter:$viewValue | limitTo:8" placeholder="<?php print TEXT_GO_TO_SEARCH; ?>" name="search">
                <button type="submit" class=""><i class="fa fa-search"></i></button>
            </form>
            <?php if(!isMobile()) { ?>
                <div class="header_drop_menu header-menu-wood hidden-sm">
                    <button class="header_cat_btn collapse_btn collapsed" data-toggle="collapse" data-target="#header_cat_menu" aria-expanded="false" aria-controls="header_cat_menu">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16px" height="16px" viewBox="0 0 16 16" version="1.1">
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="newmade-admin-detailed" transform="translate(-203.000000, -17.000000)">
                                    <g id="Container">
                                        <g id="Header">
                                            <g id="Links" transform="translate(193.000000, 9.000000)">
                                                <g id="Calalog-Link">
                                                    <g id="Icon" transform="translate(10.000000, 8.000000)">
                                                        <g id="folder-solid" transform="translate(0.000000, 2.000000)">
                                                            <path d="M5.88196601,0 C6.5671711,-1.25870133e-16 7.19356697,0.387133935 7.5,1 C7.80643303,1.61286606 8.4328289,2 9.11803399,2 L9.11803399,2 L14,2 C14.5522847,2 15,2.44771525 15,3 L15,3 L15.0000496,4.00874473 C14.9565917,4.00297693 14.9122524,4 14.8672178,4 L14.8672178,4 L1.13278222,4 C1.09131719,4 1.04989231,4.00257902 1.00874748,4.00772212 C1.00565715,4.00810842 1.00257187,4.00850842 0.99949172,4.00892208 L1,1 C1,0.44771525 1.44771525,1.01453063e-16 2,0 L2,0 Z" id="Combined-Shape" fill-rule="nonzero"/>
                                                            <path d="M1.15300969,5 L14.8469903,5 C15.3992751,5 15.8469903,5.44771525 15.8469903,6 C15.8469903,6.04731887 15.8436317,6.09457807 15.8369398,6.14142136 L15.1226541,11.1414214 C15.0522757,11.6340701 14.630355,12 14.1327046,12 L1.8672954,12 C1.36964503,12 0.947724299,11.6340701 0.877345908,11.1414214 L0.163060194,6.14142136 C0.0849553354,5.59468735 0.464854323,5.08815536 1.01158833,5.01005051 C1.05843162,5.00335861 1.10569082,5 1.15300969,5 Z" id="Rectangle" />
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        <?php print TEXT_MENU_CATALOGUE; ?>
                        <span class="caret"></span>
                    </button>
                    <div class="transition_unit">
                        <?php
                        require_once(DIR_WS_LANGUAGES. $language . '/categories.php');
                        echo tep_draw_pull_down_categories('categories_id', $tep_get_category_tree, $current_category_id, FILENAME_CATEGORIES); ?>
                    </div>

                </div>

                <div class="header_drop_menu hidden-sm">
                    <button class="header_add_menu collapse_btn collapsed" data-toggle="collapse" data-target="#header_add_menu" aria-expanded="false" aria-controls="header_cat_menu">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16px" height="16px" viewBox="0 0 16 16" version="1.1">
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="newmade-admin-detailed" transform="translate(-309.000000, -17.000000)" fill="#0A0C12">
                                    <g id="Container">
                                        <g id="Header">
                                            <g id="Links" transform="translate(193.000000, 9.000000)">
                                                <g id="Add-New" transform="translate(106.000000, 0.000000)">
                                                    <g id="Icon" transform="translate(10.000000, 8.000000)">
                                                        <path d="M8.5,1 C8.77614237,1 9,1.22385763 9,1.5 L8.999,7 L14.5,7 C14.7761424,7 15,7.22385763 15,7.5 L15,8.5 C15,8.77614237 14.7761424,9 14.5,9 L8.999,9 L9,14.5 C9,14.7761424 8.77614237,15 8.5,15 L7.5,15 C7.22385763,15 7,14.7761424 7,14.5 L6.999,9 L1.5,9 C1.22385763,9 1,8.77614237 1,8.5 L1,7.5 C1,7.22385763 1.22385763,7 1.5,7 L6.999,7 L7,1.5 C7,1.22385763 7.22385763,1 7.5,1 L8.5,1 Z" fill="#605004" id="Combined-Shape"/>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        <?php print TEXT_HEADING_ADD_NEW; ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="collapse" id="header_add_menu" data-parent="#header">
                        <li>
                            <a href="<?php print tep_href_link(FILENAME_PRODUCTS, 'cPath=&action=new_product');?>">
                                <i class="fa fa-cube"></i>
                                <span><?php print TEXT_HEADING_ADD_NEW_PRODUCT; ?></span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php print tep_href_link(FILENAME_CATEGORIES, 'cPath=&action=new_category');?>">
                                <i class="fa fa-folder"></i>
                                <span><?php print TEXT_HEADING_ADD_NEW_CATEGORY; ?></span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php print tep_href_link(FILENAME_ARTICLES, 'tPath=&action=new_articles');?>">
                                <i class="fa fa-file-text"></i>
                                <span><?php print TEXT_HEADING_ADD_NEW_PAGE; ?></span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php print tep_href_link(FILENAME_CUSTOMERS, 'action=new_customers');?>">
                                <i class="fa fa-user"></i>
                                <span><?php print TEXT_HEADING_ADD_NEW_CLIENT; ?></span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php print tep_href_link(FILENAME_ORDERS, 'action=create_order_form_user_selection');?>">
                                <i class="fa fa-dollar"></i>
                                <span><?php print TEXT_HEADING_ADD_NEW_ORDER; ?></span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php print tep_href_link(FILENAME_COUPON_ADMIN, 'action=new_coupon');?>">
                                <i class="fa fa-tag" ></i>
                                <span><?php print TEXT_HEADING_ADD_NEW_COUPON; ?></span>
                            </a>
                        </li>

                    </ul>
                </div>

<!--                <a class="header_order_link" href="--><?php //echo tep_href_link(FILENAME_ORDERS, 'status=1&filter_on=on'); ?><!--">-->
<!--                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16px" height="16px" viewBox="0 0 16 16" version="1.1">-->
<!--                        <defs>-->
<!--                            <path d="M14.4105572,22.9909575 L13.941349,22.9909575 C13.8475069,22.9909575 13.7067458,22.9936367 13.5190616,22.9989953 C13.3313774,23.0043538 13.1788862,22.9882784 13.0615836,22.9507687 C12.9442809,22.913259 12.8726189,21.8998417 12.8726189,21.6519359 C12.8726189,21.40403 12.5806473,21.40403 12.1583578,21.2325571 C11.0322524,20.8038747 10.3284472,20.0697673 10.0469208,19.0302126 C10.0156401,18.9444761 10,18.8426656 10,18.724778 C10,18.5747392 10.0625605,18.4675702 10.1876833,18.4032678 C10.3128061,18.3389655 10.5317677,18.285381 10.8445748,18.2425128 L11.1026393,18.2103617 L11.6656891,18.1942862 C11.9159348,18.1942862 12.0957961,18.2103616 12.2052786,18.2425128 C12.3147611,18.2746639 12.4007817,18.3336069 12.4633431,18.4193433 C12.5259045,18.5050798 12.6119252,18.6658333 12.7214076,18.9016086 C12.8308901,19.1481009 12.9951113,19.3517219 13.2140762,19.5124778 C13.4330412,19.6732337 14.7859238,20.355649 15.6539589,19.2830054 C16.5219941,18.2103617 14.6217039,17.4816071 14.0117302,17.1493783 C12.9481863,16.5920913 12.0410595,15.9892658 11.2903226,15.3408838 C10.5395857,14.6925017 10.1642229,13.9449981 10.1642229,13.0983505 C10.1642229,12.8947264 10.2033232,12.6589547 10.2815249,12.3910282 C10.4692091,11.7158536 11.0791737,11.1371411 12.111437,10.6548735 C12.5650072,10.4512494 12.8705188,10.5135512 12.9174399,10.3099271 C12.9643609,10.1598883 12.9481903,9.03043568 13.2140762,9.00900157 C13.2297166,9.00900157 13.390029,9.00632234 13.4604106,9.00096381 C13.5307921,8.99560528 14.5180705,9.01459343 14.7213699,9.00900157 C15.2084091,8.99560528 14.9970674,10.0917164 15.0587006,10.3269178 C15.0587006,10.4883776 15.4065552,10.4713612 15.6539589,10.5584204 L16.1466276,10.735251 C16.8973645,11.0567627 17.4291284,11.54974 17.7419355,12.2141976 C17.7888565,12.3428023 17.8123167,12.4499713 17.8123167,12.5357078 C17.8123167,12.8572195 17.6559155,13.0447652 17.3431085,13.0983505 C16.8582576,13.1733699 16.3655939,13.2376713 15.8651026,13.2912566 C15.7086991,13.3019737 15.5835782,13.2858983 15.4897361,13.2430301 C15.395894,13.2001619 15.3216034,13.1251436 15.2668622,13.017973 C15.2121209,12.9108024 15.1691106,12.8304257 15.1378299,12.7768404 C15.1065492,12.6911039 15.0518088,12.5946518 14.973607,12.4874813 C14.8954053,12.3695936 14.7624643,12.2731415 14.5747801,12.1981221 C14.3870958,12.1231027 13.0821114,11.6274416 12.4633431,12.3910282 C11.8445748,13.1546148 12.2844575,13.9915466 12.7214076,14.2043686 C13.1583578,14.4171906 14.2854323,14.8988059 14.8328446,15.1881664 C15.4115376,15.4989611 15.9745818,15.8633356 16.5219941,16.2813009 C17.5073363,17.042212 18,17.8727716 18,18.7730045 C18,19.1052333 17.9452596,19.4213818 17.8357771,19.7214594 C17.6011718,20.3752 17.0381276,20.8681772 16.1466276,21.200406 L15.6539589,21.3772366 C15.3724326,21.4629731 15.0587006,21.4736282 15.0587006,21.7000748 C15.0587006,21.9265214 15.008798,22.8784288 14.9384164,22.91058 C14.8680348,22.9427312 14.6920835,22.9695234 14.4105572,22.9909575 Z" id="path-1"/>-->
<!--                        </defs>-->
<!--                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">-->
<!--                            <g id="newmade-admin-detailed" transform="translate(-434.000000, -17.000000)">-->
<!--                                <g id="Container">-->
<!--                                    <g id="Header">-->
<!--                                        <g id="Links" transform="translate(193.000000, 9.000000)">-->
<!--                                            <g id="Orders" transform="translate(235.000000, 0.000000)">-->
<!--                                                <mask id="mask-2" fill="white">-->
<!--                                                    <use xlink:href="#path-1"/>-->
<!--                                                </mask>-->
<!--                                                <use id="$" fill="#0A0C12" fill-rule="nonzero" xlink:href="#path-1"/>-->
<!--                                            </g>-->
<!--                                        </g>-->
<!--                                    </g>-->
<!--                                </g>-->
<!--                            </g>-->
<!--                        </g>-->
<!--                    </svg>-->
<!--                    --><?//=TEXT_MENU_ORDERS;?>
<!--                    <span>-->
<!--                  --><?php
//                  $orders_awaiting = tep_db_fetch_array(tep_db_query("SELECT COUNT(*) AS total FROM " . TABLE_ORDERS . " WHERE views = '0'"));
//                  $orders_awaiting = $orders_awaiting['total'];
//                  echo $orders_awaiting;
//                  ?>
<!--                </span>-->
<!--                </a>-->

                <div class="header_drop_menu">
                    <button class="header_white_menu collapse_btn collapsed" data-toggle="collapse" data-target="#header_lang_menu" aria-expanded="false" aria-controls="header_lang_menu">
                        <?php

                        foreach ($languages_array as $_language) {
                            if ($_language['id'] == $languages_selected) {
                                $lan_img = '<img src="'.DIR_WS_IMAGES.'flags/'. $_language['id'] . '.svg">';
                                echo $lan_img . $_language['text'] . ' <b class="caret"></b>';
                            }
                        }

                        ?>
                    </button>
                    <ul class="collapse" id="header_lang_menu" data-parent="#header">
                        <?php

                        $url_parts = parse_url($_SERVER['REQUEST_URI']);
                        $url_path = $url_parts['path'];
                        $url_query = preg_replace('#&?language=[^&]*&?#is', '', $url_parts['query']);

                        if (strlen($url_query) > 0) {
                            $url_query .= '&language=';
                        } else {
                            $url_query = 'language=';
                        }

                        $language_url = $url_path . '?' . $url_query;
                        foreach ($languages_array as $_language) {
                            $lan_img = '<img src="'.DIR_WS_IMAGES.'flags/'. $_language['id'] . '.svg">';
                            ?>
                            <li>
                                <a href="<?php print $language_url . $_language['id']; ?>"><?php echo $lan_img . $_language['text']; ?></a>
                            </li>
                            <?php
                        }

                        ?>
                    </ul>
                </div>

                <div class="header_drop_menu">
                <button class="admin_conf_btn collapse_btn collapsed" data-toggle="collapse" data-target="#header_admin_menu" aria-expanded="false" aria-controls="header_admin_menu">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="28px" height="28px" viewBox="0 0 28 28" version="1.1">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="newmade-admin-detailed" transform="translate(-1859.000000, -11.000000)">
                                <g id="Container">
                                    <g id="Header">
                                        <g id="Right-Actions" transform="translate(1737.000000, 9.000000)">
                                            <g id="Admin" transform="translate(122.000000, 2.000000)">
                                                <g id="Avatar">
                                                    <path d="M14,0 C21.7319865,-1.42034288e-15 28,6.2680135 28,14 C28,21.7319865 21.7319865,28 14,28 C6.2680135,28 9.46895252e-16,21.7319865 0,14 C-9.46895252e-16,6.2680135 6.2680135,1.42034288e-15 14,0 Z M14.5,15 C13.2468029,15 12.2401033,15.4247117 11.0624199,15.9626405 C8.89611557,16.9521403 8.89611557,19.667033 9.06642251,19.8638677 C9.22311476,20.0453302 19.7769361,20.0454247 19.9335775,19.8638677 C20.1038844,19.667033 20.1038844,16.9176919 17.9375801,15.9626405 C16.7393489,15.4343802 15.7531971,15 14.5,15 Z M14.5000459,8 C13.7750394,8 13.1195046,8.30803571 12.6538753,8.86732143 C12.183198,9.43276786 11.953869,10.20125 12.0077156,11.0310714 C12.1144474,12.6682143 13.2324864,14 14.5000459,14 C15.7676055,14 16.8837214,12.6684821 16.9921358,11.0316071 C17.0467036,10.2092857 16.8159323,9.44241071 16.3423703,8.87267857 C15.8745776,8.30991071 15.2212063,8 14.5000459,8 Z" id="Combined-Shape" fill="#000000"/>
                                                    <g id="Combined-Shape-3" transform="translate(9.000000, 8.000000)"/>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <span class="green_point"></span>
                    <b class="caret"></b>
                </button>
                <ul class="collapse" id="header_admin_menu" data-parent="#header">
                    <li>
                        <span><?php printf(TEXT_PROFILE_GREETINGS, $_SESSION['login_first_name']); ?></span>
                    </li>
                    <li>
                        <span><?php printf(TEXT_PROFILE_LOGIN_COUNT, '<span class="font-bold">' . $_SESSION['login_lognum'] . '</span>'); ?></span>
                    </li>
                    <li>
                        <?php $days_with_us = date_diff(new DateTime($_SESSION['login_created']), new DateTime()); ?>
                        <span><?php printf(TEXT_PROFILE_DAYS_WITH_US, '<span class="font-bold">' . $days_with_us->days . '</span>'); ?></span>
                    </li>
                    <li class="divider"></li>
                    <!--            <li class="m-t-n-xs">-->
                    <!--              <a href="--><?php //print tep_href_link(FILENAME_ADMIN_ACCOUNT); ?><!--">--><?php //print TEXT_PROFILE; ?><!--</a>-->
                    <!--            </li>-->

                    <li>
                        <a id="change_pass" href="<?php echo FILENAME_ADMIN_MEMBERS.'?action=changepass_admin'?>" role="button"><?php echo TEXT_PRODILE_INFO_CHANGE_PASSWORD?></a>
                    </li>
                    <li>
                        <a href="<?php print tep_href_link(FILENAME_LOGOFF, '', 'NONSSL'); ?>"><?php print HEADER_TITLE_LOGOFF; ?></a>
                    </li>
                </ul>
            </div>
            <?php } ?>
        </div>
    <?php if($menu_location == '0'){?>
    </div>
    <?php }?>
</header>
<div id="errors_block">
    <div class="h3">
        <?=ALERT_ERRORS_BLOCK_TITLE;?>
        <svg class="close_errors" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z"></path>
        </svg>
    </div>
</div>
<div class="app-header-fixed"></div>
<!-- / header -->
<?php
$filenames = array(
    FILENAME_CATEGORIES,
    FILENAME_ORDERS,
    FILENAME_ARTICLES
); ?>
<?php if(isMobile()) { ?>
    <div class="new_index_navigation visible-xs">
        <a class="open_mob_menu">
            <i class="fa fa-bars" aria-hidden="true"></i>
            <?php echo TEXT_MENU_TITLE; ?>
        </a>
        <a href="<?php echo tep_href_link(FILENAME_CATEGORIES); ?>">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            <?php echo TEXT_MENU_CATALOGUE; ?>
        </a>
        <a href="<?php echo tep_href_link(FILENAME_ORDERS); ?>">
            <i class="fa fa-usd" aria-hidden="true"></i>
            <?php echo TEXT_MENU_ORDERS; ?>
        </a>
        <a href="<?php echo tep_href_link(FILENAME_ARTICLES); ?>">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            <?php echo BOX_HEADING_INFORMATION; ?>
        </a>
        <a href="#new_settings_menu" class="collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="new_settings_menu">
            <i class="fa fa-cog" aria-hidden="true"></i>
            <?php echo BOX_HEADING_CONFIGURATION; ?>
        </a>
        <ul class="collapse" id="new_settings_menu">
            <li>
                <button class="collapse_btn collapsed" data-toggle="collapse" data-target="#header_cat_menu" aria-expanded="false" aria-controls="header_cat_menu">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 18 18" version="1.1">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="newmade-admin-detailed" transform="translate(-203.000000, -17.000000)">
                                <g id="Container">
                                    <g id="Header">
                                        <g id="Links" transform="translate(193.000000, 9.000000)">
                                            <g id="Calalog-Link">
                                                <g id="Icon" transform="translate(10.000000, 8.000000)">
                                                    <g id="folder-solid" transform="translate(0.000000, 2.000000)">
                                                        <path d="M5.88196601,0 C6.5671711,-1.25870133e-16 7.19356697,0.387133935 7.5,1 C7.80643303,1.61286606 8.4328289,2 9.11803399,2 L9.11803399,2 L14,2 C14.5522847,2 15,2.44771525 15,3 L15,3 L15.0000496,4.00874473 C14.9565917,4.00297693 14.9122524,4 14.8672178,4 L14.8672178,4 L1.13278222,4 C1.09131719,4 1.04989231,4.00257902 1.00874748,4.00772212 C1.00565715,4.00810842 1.00257187,4.00850842 0.99949172,4.00892208 L1,1 C1,0.44771525 1.44771525,1.01453063e-16 2,0 L2,0 Z" id="Combined-Shape" fill-rule="nonzero"/>
                                                        <path d="M1.15300969,5 L14.8469903,5 C15.3992751,5 15.8469903,5.44771525 15.8469903,6 C15.8469903,6.04731887 15.8436317,6.09457807 15.8369398,6.14142136 L15.1226541,11.1414214 C15.0522757,11.6340701 14.630355,12 14.1327046,12 L1.8672954,12 C1.36964503,12 0.947724299,11.6340701 0.877345908,11.1414214 L0.163060194,6.14142136 C0.0849553354,5.59468735 0.464854323,5.08815536 1.01158833,5.01005051 C1.05843162,5.00335861 1.10569082,5 1.15300969,5 Z" id="Rectangle" />
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <?php print TEXT_MENU_CATALOGUE; ?>
                    <span class="caret"></span>
                </button>
                <ul class="new_settings_drop_menu collapse" id="header_cat_menu" data-parent="#new_settings_menu">
                    <?php
                    $categories_links = array();
                    foreach ($tep_get_category_tree as $category) {
                        $category_link = '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $category['id']) . '">' . $category['text'] . '</a>';
                        $categories_links[] = $category_link;
                    }
                    foreach ($categories_links as $category_link) { ?>
                        <li><?php echo $category_link; ?></li>
                        <?php
                    }
                    ?>
                </ul>
            </li>
            <li>
                <button class="collapse_btn collapsed" data-toggle="collapse" data-target="#header_add_menu" aria-expanded="false" aria-controls="header_add_menu">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 18 18" version="1.1">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="newmade-admin-detailed" transform="translate(-309.000000, -17.000000)" fill="#0A0C12">
                                <g id="Container">
                                    <g id="Header">
                                        <g id="Links" transform="translate(193.000000, 9.000000)">
                                            <g id="Add-New" transform="translate(106.000000, 0.000000)">
                                                <g id="Icon" transform="translate(10.000000, 8.000000)">
                                                    <path d="M8.5,1 C8.77614237,1 9,1.22385763 9,1.5 L8.999,7 L14.5,7 C14.7761424,7 15,7.22385763 15,7.5 L15,8.5 C15,8.77614237 14.7761424,9 14.5,9 L8.999,9 L9,14.5 C9,14.7761424 8.77614237,15 8.5,15 L7.5,15 C7.22385763,15 7,14.7761424 7,14.5 L6.999,9 L1.5,9 C1.22385763,9 1,8.77614237 1,8.5 L1,7.5 C1,7.22385763 1.22385763,7 1.5,7 L6.999,7 L7,1.5 C7,1.22385763 7.22385763,1 7.5,1 L8.5,1 Z" fill="#605004" id="Combined-Shape"/>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <?php print TEXT_HEADING_ADD_NEW; ?>
                    <span class="caret"></span>
                </button>
                <ul class="new_settings_drop_menu collapse" id="header_add_menu" data-parent="#new_settings_menu">
                    <li>
                        <a href="<?php print tep_href_link(FILENAME_PRODUCTS, 'cPath=&action=new_product');?>">
                            <i class="fa fa-cube"></i>
                            <span><?php print TEXT_HEADING_ADD_NEW_PRODUCT; ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php print tep_href_link(FILENAME_CATEGORIES, 'cPath=&action=new_category');?>">
                            <i class="fa fa-folder"></i>
                            <span><?php print TEXT_HEADING_ADD_NEW_CATEGORY; ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php print tep_href_link(FILENAME_ARTICLES, 'tPath=&action=new_articles');?>">
                            <i class="fa fa-file-text"></i>
                            <span><?php print TEXT_HEADING_ADD_NEW_PAGE; ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php print tep_href_link(FILENAME_CREATE_ACCOUNT);?>">
                            <i class="fa fa-user"></i>
                            <span><?php print TEXT_HEADING_ADD_NEW_CLIENT; ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php print tep_href_link(FILENAME_ORDERS, 'action=create_order_form_user_selection');?>">
                            <i class="fa fa-dollar"></i>
                            <span><?php print TEXT_HEADING_ADD_NEW_ORDER; ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php print tep_href_link(FILENAME_COUPON_ADMIN, 'action=new_coupon');?>">
                            <i class="fa fa-tag" ></i>
                            <span><?php print TEXT_HEADING_ADD_NEW_COUPON; ?></span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <button class="collapse_btn collapsed" data-toggle="collapse" data-target="#header_lang_menu" aria-expanded="false" aria-controls="header_lang_menu">
                    <?php

                    foreach ($languages_array as $_language) {
                        if ($_language['id'] == $languages_selected) {
                            $lan_img = '<img src="'.DIR_WS_IMAGES.'flags/'. $_language['id'] . '.svg">';
                            echo $lan_img . $_language['text'] . ' <b class="caret"></b>';
                        }
                    }

                    ?>
                </button>
                <ul class="new_settings_drop_menu collapse" id="header_lang_menu" data-parent="#new_settings_menu">
                    <?php

                    $url_parts = parse_url($_SERVER['REQUEST_URI']);
                    $url_path = $url_parts['path'];
                    $url_query = preg_replace('#&?language=[^&]*&?#is', '', $url_parts['query']);

                    if (strlen($url_query) > 0) {
                        $url_query .= '&language=';
                    } else {
                        $url_query = 'language=';
                    }

                    $language_url = $url_path . '?' . $url_query;
                    foreach ($languages_array as $_language) {
                        $lan_img = '<img src="'.DIR_WS_IMAGES.'flags/'. $_language['id'] . '.svg">';
                        ?>
                        <li>
                            <a href="<?php print $language_url . $_language['id']; ?>"><?php echo $lan_img . $_language['text']; ?></a>
                        </li>
                        <?php
                    }

                    ?>
                </ul>
            </li>
            <li>
                <button class="collapse_btn collapsed" data-toggle="collapse" data-target="#header_admin_menu" aria-expanded="false" aria-controls="header_admin_menu">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="28px" height="28px" viewBox="0 0 28 28" version="1.1">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="newmade-admin-detailed" transform="translate(-1859.000000, -11.000000)">
                                <g id="Container">
                                    <g id="Header">
                                        <g id="Right-Actions" transform="translate(1737.000000, 9.000000)">
                                            <g id="Admin" transform="translate(122.000000, 2.000000)">
                                                <g id="Avatar">
                                                    <path d="M14,0 C21.7319865,-1.42034288e-15 28,6.2680135 28,14 C28,21.7319865 21.7319865,28 14,28 C6.2680135,28 9.46895252e-16,21.7319865 0,14 C-9.46895252e-16,6.2680135 6.2680135,1.42034288e-15 14,0 Z M14.5,15 C13.2468029,15 12.2401033,15.4247117 11.0624199,15.9626405 C8.89611557,16.9521403 8.89611557,19.667033 9.06642251,19.8638677 C9.22311476,20.0453302 19.7769361,20.0454247 19.9335775,19.8638677 C20.1038844,19.667033 20.1038844,16.9176919 17.9375801,15.9626405 C16.7393489,15.4343802 15.7531971,15 14.5,15 Z M14.5000459,8 C13.7750394,8 13.1195046,8.30803571 12.6538753,8.86732143 C12.183198,9.43276786 11.953869,10.20125 12.0077156,11.0310714 C12.1144474,12.6682143 13.2324864,14 14.5000459,14 C15.7676055,14 16.8837214,12.6684821 16.9921358,11.0316071 C17.0467036,10.2092857 16.8159323,9.44241071 16.3423703,8.87267857 C15.8745776,8.30991071 15.2212063,8 14.5000459,8 Z" id="Combined-Shape" fill="#000000"/>
                                                    <g id="Combined-Shape-3" transform="translate(9.000000, 8.000000)"/>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <span class="green_point"></span>
                    <?php print $_SESSION['login_first_name'] . ' ' . $_SESSION['login_last_name']; ?>
                    <b class="caret"></b>
                </button>
                <ul class="new_settings_drop_menu collapse" id="header_admin_menu" data-parent="#new_settings_menu">
                    <li>
                        <span><?php printf(TEXT_PROFILE_GREETINGS, $_SESSION['login_first_name']); ?></span>
                    </li>
                    <li>
                        <span><?php printf(TEXT_PROFILE_LOGIN_COUNT, '<span class="font-bold">' . $_SESSION['login_lognum'] . '</span>'); ?></span>
                    </li>
                    <li>
                        <?php $days_with_us = date_diff(new DateTime($_SESSION['login_created']), new DateTime()); ?>
                        <span><?php printf(TEXT_PROFILE_DAYS_WITH_US, '<span class="font-bold">' . $days_with_us->days . '</span>'); ?></span>
                    </li>
                    <li class="divider"></li>
                    <!--            <li class="m-t-n-xs">-->
                    <!--              <a href="--><?php //print tep_href_link(FILENAME_ADMIN_ACCOUNT); ?><!--">--><?php //print TEXT_PROFILE; ?><!--</a>-->
                    <!--            </li>-->
                    <li>
                        <a href="<?php print tep_href_link(FILENAME_LOGOFF, '', 'NONSSL'); ?>"><?php print HEADER_TITLE_LOGOFF; ?></a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

<?php } ?>


<?php

if($menu_location != '0'){
    require(DIR_WS_INCLUDES . 'material/left_menu.php');
} else {
    require(DIR_WS_INCLUDES . 'material/header_navigation.php');
}

?>
<?php //if(true): ?>
<?php if(false): ?>
    <div class="wrapper_home_menu <?= (!in_array(basename($PHP_SELF),$pagesWithMenuArray) ? 'hidden' : '')?>">
        <div class="container block_home_menu">
            <div class="wrapper-pointer-customization">
                <div class="pointer_menu">
                    <svg version="1.1" id="Capa_1" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="96.155px" height="96.155px" viewBox="0 0 96.155 96.155" style="enable-background:new 0 0 96.155 96.155;"
                         xml:space="preserve">
                        <g><path d="M20.972,95.594l57.605-45.951c0.951-0.76,0.951-2.367,0-3.127L20.968,0.56c-0.689-0.547-1.716-0.709-2.61-0.414c-0.186,0.061-0.33,0.129-0.436,0.186c-0.65,0.35-1.056,1.025-1.056,1.764v91.967c0,0.736,0.405,1.414,1.056,1.762c0.109,0.06,0.253,0.127,0.426,0.185C19.251,96.305,20.281,96.144,20.972,95.594z"/></g>
                    </svg>
                </div>
            </div>

            <div class="row">

                <!-- Товары -->
                <div class="col-md-4 col-sm-6 col-xs-12 col_menu">
                    <div class="block-menu_wrap">
                        <div class="menu_wrap">
                            <div class="menu_img">
                                <img src="images/icons-sidebare/products-icon.svg" border="0" alt="">
                            </div>
                            <div class="menu_text">
                                <h4><?php print TEXT_MENU_PRODUCTS; ?></h4>
                                <ul>
                                    <?php

                                    if(new_tep_admin_check_boxes(FILENAME_CATEGORIES) == true){
                                        ?>
                                        <li<?php print tep_is_active_menu(FILENAME_CATEGORIES) ? ' class="active"' : ''; ?>>
                                            <a href="<?php print tep_href_link(FILENAME_CATEGORIES); ?>">
                                                <span><?php print TEXT_MENU_CATALOGUE; ?>	</span>
                                            </a>
                                        </li>
                                        <?php
                                    }

                                    if(new_tep_admin_check_boxes(FILENAME_PRODUCTS_MULTI) == true){
                                        ?>
                                        <li<?= strstr(basename($PHP_SELF), FILENAME_PRODUCTS_MULTI) && $menu_location != '0' ? ' class="active"' : '' ?>>
                                            <a href="<?php print tep_href_link(FILENAME_PRODUCTS_MULTI); ?>">
                                                <span><?php print BOX_CATALOG_CATEGORIES_PRODUCTS_MULTI; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }

                                    if(new_tep_admin_check_boxes(FILENAME_QUICK_UPDATES) == true){
                                        ?>
                                        <li<?= strstr(basename($PHP_SELF), FILENAME_QUICK_UPDATES) && $menu_location != '0' ? ' class="active"' : '' ?>>
                                            <a href="<?php print tep_href_link(FILENAME_QUICK_UPDATES); ?>">
                                                <span><?php print BOX_CATALOG_QUICK_UPDATES; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }

                                    if(new_tep_admin_check_boxes(FILENAME_FEATURED) == true){
                                        ?>
                                        <li<?= strstr(basename($PHP_SELF), FILENAME_FEATURED) && $menu_location != '0' ? ' class="active"' : '' ?>>
                                            <a href="<?php print tep_href_link(FILENAME_FEATURED); ?>">
                                                <span><?php print BOX_CATALOG_FEATURED; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }

                                    if(new_tep_admin_check_boxes(FILENAME_XSELL_PRODUCTS) == true){
                                        ?>
                                        <li<?= strstr(basename($PHP_SELF), FILENAME_XSELL_PRODUCTS) && $menu_location != '0' ? ' class="active"' : '' ?>>
                                            <a href="<?php print tep_href_link(FILENAME_XSELL_PRODUCTS); ?>">
                                                <span><?php print BOX_CATALOG_XSELL_PRODUCTS; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }

                                    if(new_tep_admin_check_boxes(FILENAME_NEW_PRODUCTS_ATTRIBUTES) == true){
                                        ?>
                                        <li<?php print tep_is_active_menu(FILENAME_NEW_PRODUCTS_ATTRIBUTES) ? ' class="active"' : ''; ?>>
                                            <a href="<?php print tep_href_link(FILENAME_NEW_PRODUCTS_ATTRIBUTES); ?>">
                                                <span><?php print TEXT_MENU_ATTRIBUTES; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }

                                    $isMenuItemActive = strstr(basename($PHP_SELF), FILENAME_SPECIALS) ||
                                        strstr(basename($PHP_SELF), FILENAME_SALEMAKER);

                                    if(new_tep_admin_check_boxes(FILENAME_SPECIALS) == true){
                                        ?>
                                        <li<?= $isMenuItemActive && $menu_location != '0' ? ' class="active"' : '' ?>>
                                            <a href="<?php print tep_href_link(FILENAME_SPECIALS); ?>">
                                                <span><?php print BOX_CATALOG_SPECIALS; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }


                                    if(new_tep_admin_check_boxes(FILENAME_MANUFACTURERS) == true){
                                        ?>
                                        <li<?= strstr(basename($PHP_SELF), FILENAME_MANUFACTURERS) && $menu_location != '0' ? ' class="active"' : '' ?>>
                                            <a href="<?php print tep_href_link(FILENAME_MANUFACTURERS); ?>">
                                                <span><?php print BOX_CATALOG_MANUFACTURERS; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }

                                    $isMenuItemActive = strstr(basename($PHP_SELF), FILENAME_EASYPOPULATE) ||
                                        strstr(basename($PHP_SELF), FILENAME_PROM);


                                    ?>
                                    <li<?= $isMenuItemActive && $menu_location != '0' ? ' class="active"' : '' ?>>
                                        <a href="<?php print tep_href_link(FILENAME_NEW_IMPORT_EXPORT); ?>">
                                            <span><?php print IMPORT_EXPORT_MENU_BOX; ?></span>
                                        </a>
                                    </li>

                                    <?php if(new_tep_admin_check_boxes(FILENAME_AUTO_TRANSLATE) == true) : ?>
                                        <li<?= strstr(basename($PHP_SELF), FILENAME_AUTO_TRANSLATE) && $menu_location != '0' ? ' class="active"' : '' ?>>
                                            <a href="<?php print tep_href_link(FILENAME_AUTO_TRANSLATE); ?>">
                                                <span><?php print AUTO_TRANSLATE_MODULE_ENABLED_TITLE; ?></span>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php $ymlClass = ''; ?>
                                    <?php $ymlClass = file_exists(DIR_FS_EXT . 'yml_import/yml_import.php') && getConstantValue('YML_MODULE_ENABLED') == 'true' ? '' : 'disabled_module' ?>
                                    <?php $ymlClass .= strstr(basename($PHP_SELF), 'yml.php') && $menu_location != '0' ? ' active' : '' ?>
                                    <li>
                                        <a href="<?php print tep_href_link('yml.php'); ?>"<?= $ymlClass ? ' class="' . $ymlClass . '"' : '' ?>>
                                            <span><?php print 'YML import'; ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Товары -->

                <!-- Заказы -->
                <div class="col-md-4 col-sm-6 col-xs-12 col_menu">
                    <div class="block-menu_wrap">
                        <div class="menu_wrap">
                            <div class="menu_img">
                                <img src="images/icons-sidebare/orders-icon.svg" border="0" alt="">
                            </div>
                            <div class="menu_text">
                                <h4><?php print TEXT_MENU_ORDERS; ?><span class="text-center">14</span></h4>
                                <ul>
                                    <?php

                                    if (new_tep_admin_check_boxes(FILENAME_ORDERS) == true) {
                                        ?>
                                        <li<?=strstr(basename($PHP_SELF),FILENAME_ORDERS) && $menu_location != '0' && !isset($_GET['action'])? ' class="active"' : ''?>>
                                            <a href="<?php print tep_href_link(FILENAME_ORDERS); ?>">
                                                <span><?php print TEXT_MENU_ORDERS_LIST; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }

                                    if (new_tep_admin_check_boxes(FILENAME_ORDERS_STATUS) == true) {
                                        ?>
                                        <li<?=strstr(basename($PHP_SELF),FILENAME_ORDERS_STATUS) && $menu_location != '0' ? ' class="active"' : ''?>>
                                            <a href="<?php print tep_href_link(FILENAME_ORDERS_STATUS); ?>">
                                                <span><?php print BOX_LOCALIZATION_ORDERS_STATUS; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }

                                    if (true) {
                                        ?>
                                        <li<?=strstr(basename($PHP_SELF),FILENAME_ORDERS) && $menu_location != '0' && isset($_GET['action']) && $_GET['action'] == 'create_order_form_user_selection'? ' class="active"' : ''?>>
                                            <a href="<?php print tep_href_link(FILENAME_ORDERS,'page=1&perPage=25&action=create_order_form_user_selection'); ?>">
                                                <span><?php print BOX_MANUAL_ORDER_CREATE_ORDER; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Заказы -->

                <!-- Клиенты -->
                <div class="col-md-4 col-sm-6 col-xs-12 col_menu">
                    <div class="block-menu_wrap">
                        <div class="menu_wrap">
                            <div class="menu_img">
                                <img src="images/icons-sidebare/clients-icon.svg" border="0" alt="">
                            </div>
                            <div class="menu_text">
                                <h4><?php print BOX_HEADING_CUSTOMERS; ?></h4>
                                <ul>
                                    <?php

                                    if (new_tep_admin_check_boxes(FILENAME_CUSTOMERS) == true) {
                                        ?>
                                        <li<?=strstr(basename($PHP_SELF),FILENAME_CUSTOMERS) && $menu_location != '0' ? ' class="active"' : ''?>>
                                            <a href="<?php print tep_href_link(FILENAME_CUSTOMERS); ?>">
                                                <span><?php print TEXT_MENU_CLIENTS_LIST; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }

                                    if (new_tep_admin_check_boxes(FILENAME_GROUPS) == true) {
                                        ?>
                                        <li<?=strstr(basename($PHP_SELF),FILENAME_GROUPS) && $menu_location != '0' ? ' class="active"' : ''?>>
                                            <a href="<?php print tep_href_link(FILENAME_GROUPS); ?>">
                                                <span><?php print TEXT_MENU_CLIENTS_GROUPS; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }

                                    if (new_tep_admin_check_boxes(FILENAME_CREATE_ACCOUNT) == true) {
                                        ?>
                                        <li<?=strstr(basename($PHP_SELF),FILENAME_CREATE_ACCOUNT) && $menu_location != '0' ? ' class="active"' : ''?>>
                                            <a href="<?php print tep_href_link(FILENAME_CREATE_ACCOUNT); ?>">
                                                <span><?php print TEXT_MENU_ADD_CLIENT; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }

                                    ?>
                                    <li <?=(isset($_GET['gID']) && $_GET['gID'] == CLIENT_DATA_CONFIGURATION_GROUP_ID && $menu_location != '0' ?' class="active"':'')?>>
                                        <a href="<?=tep_href_link(FILENAME_CONFIGURATION, 'gID=' . CLIENT_DATA_CONFIGURATION_GROUP_ID, 'NONSSL')?>">
                                            <span><?=CUSTOMER_DETAILS_CONF_TITLE?></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Клиенты-->

                <!-- Контент -->
                <div class="col-md-4 col-sm-6 col-xs-12 col_menu">
                    <div class="block-menu_wrap">
                        <div class="menu_wrap">
                            <div class="menu_img">
                                <img src="images/icons-sidebare/content-icon.svg" border="0" alt="">
                            </div>
                            <div class="menu_text">
                                <h4><?php print BOX_HEADING_INFORMATION; ?></h4>
                                <ul>
                                    <?php

                                    if (new_tep_admin_check_boxes(FILENAME_ARTICLES) == true) {
                                        ?>
                                        <li<?=strstr(basename($PHP_SELF),FILENAME_ARTICLES) && $menu_location != '0' ? ' class="active"' : ''?>>
                                            <a href="<?php print tep_href_link(FILENAME_ARTICLES); ?>">
                                                <span><?php print TEXT_MENU_PAGES; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }


                                    if (new_tep_admin_check_boxes(FILENAME_EMAIL_CONTENT) == true) {
                                        ?>
                                        <li<?=strstr(basename($PHP_SELF),FILENAME_EMAIL_CONTENT) && $menu_location != '0' ? ' class="active"' : ''?>>
                                            <a href="<?php print tep_href_link(FILENAME_EMAIL_CONTENT); ?>">
                                                <span><?php print TEXT_MENU_EMAIL_CONTENT; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    if (new_tep_admin_check_boxes('image_explorer.php') == true) {
                                        ?>
                                        <li<?=strstr(basename($PHP_SELF),'image_explorer.php') && $menu_location != '0' ? ' class="active"' : ''?>>
                                            <a href="<?php print tep_href_link('image_explorer.php'); ?>">
                                                <span><?php print TEXT_MENU_CKFINDER; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }

                                    if (new_tep_admin_check_boxes(FILENAME_SEO_FILTER) == true) {
                                        ?>
                                        <li<?=strstr(basename($PHP_SELF),FILENAME_SEO_FILTER) && $menu_location != '0' ? ' class="active"' : ''?>>
                                            <a href="<?php print tep_href_link(FILENAME_SEO_FILTER); ?>">
                                                <span><?php print BOX_CATALOG_SEO_FILTER; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }

                                    if (defined('COMMENTS_MODULE_ENABLED') && COMMENTS_MODULE_ENABLED == 'true') {

                                        if (new_tep_admin_check_boxes(FILENAME_REVIEWS) == true) {
                                            ?>
                                            <li<?=strstr(basename($PHP_SELF),FILENAME_REVIEWS) && $menu_location != '0' ? ' class="active"' : ''?>>
                                                <a href="<?php print tep_href_link(FILENAME_REVIEWS); ?>">
                                                    <span><?php print TEXT_MENU_REVIEWS; ?></span>
                                                </a>
                                            </li>
                                            <?php
                                        }
                                    }

                                    if (new_tep_admin_check_boxes(FILENAME_KEYWORDS)) {
                                        ?>
                                        <li<?=strstr(basename($PHP_SELF),FILENAME_KEYWORDS) && $menu_location != '0' ? ' class="active"' : ''?>>
                                            <a href="<?php print tep_href_link(FILENAME_KEYWORDS,'order=search_count-desc'); ?>">
                                                <span><?php print BOX_TOOLS_KEYWORDS; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }

                                    ?>

                                    <li<?=strstr(basename($PHP_SELF),FILENAME_LANGUAGES_TRANSLATER) && $menu_location != '0' ? ' class="active"' : ''?>>
                                        <a href="<?= tep_href_link(FILENAME_LANGUAGES_TRANSLATER,'file='.$language.'.php') ?>">
                                            <span><?= TEXT_TRANSLATER_TITLE ?></span>
                                        </a>
                                    </li>

                                    <li<?=strstr(basename($PHP_SELF),FILENAME_REDIRECTS) && $menu_location != '0' ? ' class="active"' : ''?>>
                                        <a href="<?= tep_href_link(FILENAME_REDIRECTS) ?>">
                                            <span><?= TEXT_REDIRECTS_TITLE ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Контент -->

                <!-- Дизайн -->
                <div class="col-md-4 col-sm-6 col-xs-12 col_menu">
                    <div class="block-menu_wrap">
                        <div class="menu_wrap">
                            <div class="menu_img">
                                <img src="images/icons-sidebare/design-icon.svg" border="0" alt="">
                            </div>
                            <div class="menu_text">
                                <h4><?php print BOX_HEADING_DESIGN_CONTROLS; ?></h4>
                                <ul class="ul_menu_text">
                                    <li><a href="#"><?php print BOX_HEADING_POLLS; ?></a></li>
                                    <li><a href="#"><?php print BOX_POLLS_CONFIG; ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Дизайн -->

                <!-- Модули -->
                <div class="col-md-4 col-sm-6 col-xs-12 col_menu">
                    <div class="block-menu_wrap">
                        <div class="menu_wrap">
                            <div class="menu_img">
                                <img src="images/icons-sidebare/modules-icon.svg" border="0" alt="">
                            </div>
                            <div class="menu_text">
                                <h4><?php print BOX_HEADING_MODULES; ?></h4>
                                <ul>
                                    <?php

                                    if (new_tep_admin_check_boxes(FILENAME_MODULES) == true) {
                                        ?>
                                        <li<?=strstr(basename($PHP_SELF),FILENAME_MODULES) && $menu_location != '0' && isset($_GET['set']) && $_GET['set'] == 'payment' ? ' class="active"' : ''?>>
                                            <a href="<?php print tep_href_link(FILENAME_MODULES, 'set=payment', 'NONSSL'); ?>">
                                                <span><?php print BOX_MODULES_PAYMENT; ?></span>
                                            </a>
                                        </li>
                                        <li<?=strstr(basename($PHP_SELF),FILENAME_MODULES) && $menu_location != '0' && isset($_GET['set']) && $_GET['set'] == 'shipping' ? ' class="active"' : ''?>>
                                            <a href="<?php print tep_href_link(FILENAME_MODULES, 'set=shipping', 'NONSSL'); ?>">
                                                <span><?php print BOX_MODULES_SHIPPING; ?></span>
                                            </a>
                                        </li>
                                        <li<?=strstr(basename($PHP_SELF),FILENAME_MODULES) && $menu_location != '0' && isset($_GET['set']) && $_GET['set'] == 'ordertotal' ? ' class="active"' : ''?>>
                                            <a href="<?php print tep_href_link(FILENAME_MODULES, 'set=ordertotal', 'NONSSL'); ?>">
                                                <span><?php print BOX_MODULES_ORDER_TOTAL; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }

                                    if (new_tep_admin_check_boxes(FILENAME_SHIP2PAY) == true) {
                                        ?>
                                        <li<?=strstr(basename($PHP_SELF),FILENAME_SHIP2PAY) && $menu_location != '0' ? ' class="active"' : ''?>>
                                            <a href="<?php print tep_href_link(FILENAME_SHIP2PAY); ?>">
                                                <span><?php print BOX_MODULES_SHIP2PAY; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }

                                    if (LANGUAGE_SELECTOR_MODULE_ENABLED == 'true') {
                                        if (new_tep_admin_check_boxes(FILENAME_LANGUAGES) == true) {
                                            ?>
                                            <li<?=strstr(basename($PHP_SELF),FILENAME_LANGUAGES) && $menu_location != '0'? ' class="active"' : ''?>>
                                                <a href="<?php print tep_href_link(FILENAME_LANGUAGES); ?>">
                                                    <span><?php print BOX_LOCALIZATION_LANGUAGES; ?></span>
                                                </a>
                                            </li>
                                            <?php
                                        }
                                    }


                                    if (new_tep_admin_check_boxes(FILENAME_CURRENCIES) == true) {
                                        ?>
                                        <li<?=strstr(basename($PHP_SELF),FILENAME_CURRENCIES) && $menu_location != '0' ? ' class="active"' : ''?>>
                                            <a href="<?php print tep_href_link(FILENAME_CURRENCIES); ?>">
                                                <span><?php print BOX_CURRENCIES_CONFIG; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }

                                    if (CUPONES_MODULE_ENABLED == 'true') {
                                        if (new_tep_admin_check_boxes(FILENAME_COUPON_ADMIN) == true) {
                                            ?>
                                            <li<?=strstr(basename($PHP_SELF),FILENAME_COUPON_ADMIN) && $menu_location != '0' ? ' class="active"' : ''?>>
                                                <a href="<?php print tep_href_link(FILENAME_COUPON_ADMIN); ?>">
                                                    <span><?php print BOX_COUPONS; ?></span>
                                                </a>
                                            </li>
                                            <?php
                                        }
                                    }

                                    if (new_tep_admin_check_boxes(FILENAME_POLLS) == true) {
                                        ?>

                                        <li<?=strstr(basename($PHP_SELF),FILENAME_POLLS) && $menu_location != '0' && !isset($_GET['action']) ? ' class="active"' : ''?>>
                                            <a href="<?php print tep_href_link(FILENAME_POLLS, '', 'NONSSL'); ?>">
                                                <span><?php print BOX_POLLS_POLLS; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }

                                    if (new_tep_admin_check_boxes(FILENAME_CONFIGURATION) == true) {
                                        ?>
                                        <li<?= isset($_GET['gID']) && $_GET['gID'] == 277 && $menu_location != '0' ? ' class="active"' : '' ?>>
                                            <a href="<?php print tep_href_link(FILENAME_CONFIGURATION, 'gID=' . 277, 'NONSSL'); ?>">
                                                <span><?php print TEXT_MENU_SITE_MODULES; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }

                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Модули -->

                <!-- Настройки -->
                <div class="col-md-4 col-sm-6 col-xs-12 col_menu">
                    <div class="block-menu_wrap">
                        <div class="menu_wrap">
                            <div class="menu_img">
                                <img src="images/icons-sidebare/settings-icon.svg" border="0" alt="">
                            </div>
                            <div class="menu_text">
                                <h4><?php print BOX_HEADING_CONFIGURATION; ?></h4>
                                <ul class="ul_menu_text">
                                    <?php

                                    define('UNCOMPLETED_ORDERS_CONFIGURATION_GROUP_ID', 6501);
                                    define('XML_EXPORT_CONFIGURATION_GROUP_ID', 26230);

                                    $settings_configuration = '';
                                    $query = tep_db_query("SELECT configuration_group_id AS cgID, configuration_group_key AS cgKey, configuration_group_title AS cgTitle FROM " . TABLE_CONFIGURATION_GROUP . " WHERE visible = '1' ORDER BY sort_order");
                                    while ($setting_configuration = tep_db_fetch_array($query)) {
                                        if ($setting_configuration['cgID'] == 902 && SMSINFORM_MODULE_ENABLED != 'true') {
                                            continue;
                                        } else if ($setting_configuration['cgID'] == 26230 && EXCEL_IMPORT_MODULE_ENABLED != 'true') {
                                            continue;
                                        } else if ($setting_configuration['cgID'] == 401) {
                                            continue;
                                        } else if ($setting_configuration['cgID'] == CLIENT_DATA_CONFIGURATION_GROUP_ID) {
                                            continue;
                                        } else if ($setting_configuration['cgID'] == SHIPPING_PACKING_CONFIGURATION_GROUP_ID) {
                                            continue;
                                        } else if ($setting_configuration['cgID'] == UNCOMPLETED_ORDERS_CONFIGURATION_GROUP_ID) {
                                            continue;
                                        } else if ($setting_configuration['cgID'] == XML_EXPORT_CONFIGURATION_GROUP_ID) {
                                            continue;
                                        } else if ($setting_configuration['cgID'] == CHECKOUT_CONFIGURATION_GROUP_ID) {
                                            continue;
                                        } else if ($setting_configuration['cgID'] == PRODUCTS_LISTING_SETTINGS) {
                                            continue;
                                        }
                                        else if ($setting_configuration['cgID'] == 277) {
                                            //$setting_configuration['cgKey'] = 'TEXT_MENU_SITE_MODULES';
                                            continue;
                                        }

                                        $settings_configuration .= '<li'.(isset($_GET['gID']) && $_GET['gID'] == $setting_configuration['cgID'] && $menu_location != '0' ?' class="active"':'').'><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=' . $setting_configuration['cgID'], 'NONSSL') . '"><span>' . constant(strtoupper($setting_configuration['cgKey'])) . '</span></a></li>';
                                    }

                                    print $settings_configuration;

                                    $isMenuItemActive = strstr(basename($PHP_SELF),FILENAME_TAX_CLASSES) ||
                                        strstr(basename($PHP_SELF),FILENAME_TAX_RATES) ||
                                        strstr(basename($PHP_SELF),FILENAME_GEO_ZONES);

                                    ?>
                                    <li<?=$isMenuItemActive && $menu_location != '0' ? ' class="active"' : ''?>>
                                        <a href="<?php print tep_href_link(FILENAME_TAX_CLASSES); ?>">
                                            <span><?php print BOX_MENU_TAXES; ?></span>
                                        </a>
                                    </li
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Настройки -->

                <!-- Инструменты -->
                <div class="col-md-4 col-sm-6 col-xs-12 col_menu">
                    <div class="block-menu_wrap">
                        <div class="menu_wrap">
                            <div class="menu_img">
                                <img src="images/icons-sidebare/tools-icon.svg" border="0" alt="">
                            </div>
                            <div class="menu_text">
                                <h4><?php print BOX_HEADING_TOOLS; ?></h4>
                                <ul>
                                    <?php

                                    if (new_tep_admin_check_boxes(FILENAME_BACKUP)) {
                                        ?>
                                        <li<?=strstr(basename($PHP_SELF),FILENAME_BACKUP) && $menu_location != '0' ? ' class="active"' : ''?>>
                                            <a href="<?php print tep_href_link(FILENAME_BACKUP); ?>">
                                                <span><?php print TEXT_MENU_BACKUP; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    if (isset($login_email_address) && new_tep_admin_check_boxes(FILENAME_TOTAL_CONFIGURATION) && $login_email_address == 'admin@solomono.net') {
                                        ?>
                                        <li<?=strstr(basename($PHP_SELF),FILENAME_TOTAL_CONFIGURATION) && $menu_location != '0' ? ' class="active"' : ''?>>
                                            <a href="<?php print tep_href_link(FILENAME_TOTAL_CONFIGURATION); ?>">
                                                <span><?php print TEXT_MENU_TOTAL_CONFIG; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }

                                    $isMenuItemActive = strstr(basename($PHP_SELF),FILENAME_MAIL) ||
                                        strstr(basename($PHP_SELF),FILENAME_NEWSLETTERS);

                                    if (new_tep_admin_check_boxes(FILENAME_MAIL)) {
                                        ?>
                                        <li<?=$isMenuItemActive && $menu_location != '0' ? ' class="active"' : ''?>>
                                            <a href="<?php print tep_href_link(FILENAME_MAIL); ?>">
                                                <span><?php print BOX_MENU_TOOLS_EMAILS; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }


                                    if (new_tep_admin_check_boxes(FILENAME_MYSQL_PERFORMANCE)) {
                                        ?>
                                        <li<?=strstr(basename($PHP_SELF),FILENAME_MYSQL_PERFORMANCE) && $menu_location != '0' ? ' class="active"' : ''?>>
                                            <a href="<?php print tep_href_link(FILENAME_MYSQL_PERFORMANCE); ?>">
                                                <span><?php print TEXT_MENU_SLOW_QUERIES_LOGS; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }

                                    ?>
                                    <li>
                                        <a id="menu-clear-image-cache" href="<?php print tep_href_link(FILENAME_CLEAR_IMAGE_CACHE); ?>">
                                            <span><?php print BOX_CLEAR_IMAGE_CACHE; ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Инструменты -->

                <!-- Отчеты -->
                <div class="col-md-4 col-sm-6 col-xs-12 col_menu">
                    <div class="block-menu_wrap">
                        <div class="menu_wrap">
                            <div class="menu_img">
                                <img src="images/icons-sidebare/charts-icon.svg" border="0" alt="">
                            </div>
                            <div class="menu_text">
                                <h4><?php print BOX_HEADING_REPORTS; ?></h4>
                                <ul>
                                    <?php

                                    if (new_tep_admin_check_boxes(FILENAME_STATS_MONTHLY_SALES)) {
                                        ?>
                                        <li<?=strstr(basename($PHP_SELF),FILENAME_STATS_MONTHLY_SALES) && $menu_location != '0' ? ' class="active"' : ''?>>
                                            <a href="<?php print tep_href_link(FILENAME_STATS_MONTHLY_SALES); ?>">
                                                <span><?php print TEXT_MENU_SALES; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }

                                    $isMenuItemActive = strstr(basename($PHP_SELF),FILENAME_STATS_PRODUCTS_VIEWED) ||
                                        strstr(basename($PHP_SELF),FILENAME_STATS_PRODUCTS_PURCHASED) ||
                                        strstr(basename($PHP_SELF),FILENAME_STATS_ZEROQTY) ||
                                        strstr(basename($PHP_SELF),FILENAME_STATS_PRODUCTS_PURCHASED_BY_CATEGORY);


                                    if (new_tep_admin_check_boxes(FILENAME_STATS_PRODUCTS_PURCHASED)) {
                                        ?>
                                        <li<?=$isMenuItemActive && $menu_location != '0' ? ' class="active"' : ''?>>
                                            <a href="<?php print tep_href_link(FILENAME_STATS_PRODUCTS_PURCHASED); ?>">
                                                <span><?php print BOX_PRODUCTS_STATS_MENU_ITEM; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }


                                    $isMenuItemActive = strstr(basename($PHP_SELF),FILENAME_STATS_CUSTOMERS) ||
                                        strstr(basename($PHP_SELF),FILENAME_STATS_OPENED_BY);


                                    if (new_tep_admin_check_boxes(FILENAME_STATS_CUSTOMERS)) {
                                        ?>
                                        <li<?=$isMenuItemActive && $menu_location != '0' ? ' class="active"' : ''?>>
                                            <a href="<?php print tep_href_link(FILENAME_STATS_CUSTOMERS); ?>">
                                                <span><?php print TEXT_MENU_CLIENTS; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Отчеты -->

            </div>
            '?>



            <?php if(false): ?>
                <div class="row">
                    <div  class="col-md-9">
                        <div class="col-md-4">
                            <a href="#">
                                <div class="menu_bottom_wrap">
                                    <div class="menu_img">
                                        <img src="images/icons-sidebare/clients-icon.svg" border="0" alt="">
                                    </div>
                                    <div class="menu_title-text">
                                        <div class="menu_title"><?php print BOX_HEADING_ADMINISTRATOR; ?></div>
                                        <div class="menu_plus">
                                            <svg version="1.1" id="Capa_1" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                 viewBox="0 0 341.4 341.4" style="enable-background:new 0 0 341.4 341.4;" xml:space="preserve">
                                         <g>
                                             <g>
                                                 <polygon points="192,149.4 192,0 149.4,0 149.4,149.4 0,149.4 0,192 149.4,192 149.4,341.4 192,341.4 192,192 341.4,192
		                                          341.4,149.4 		"/>
                                             </g>
                                         </g>

                                     </svg>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="#">
                                <div class="menu_bottom_wrap">
                                    <div class="menu_img">
                                        <img src="images/icons-sidebare/content-icon.svg" border="0" alt="">
                                    </div>
                                    <div class="menu_title-text">
                                        <div class="menu_title"><?php print BOX_HEADING_INFORMATION; ?></div>
                                        <div class="menu_plus">
                                            <svg version="1.1" id="Capa_1" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                 viewBox="0 0 341.4 341.4" style="enable-background:new 0 0 341.4 341.4;" xml:space="preserve">
                                         <g>
                                             <g>
                                                 <polygon points="192,149.4 192,0 149.4,0 149.4,149.4 0,149.4 0,192 149.4,192 149.4,341.4 192,341.4 192,192 341.4,192
		                                          341.4,149.4 		"/>
                                             </g>
                                         </g>

                                     </svg>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="#">
                                <div class="menu_bottom_wrap">
                                    <div class="menu_img">
                                        <img src="images/icons-sidebare/modules-icon.svg" border="0" alt="">
                                    </div>
                                    <div class="menu_title-text">
                                        <div class="menu_title"><?php print BOX_HEADING_MODULES; ?></div>
                                        <div class="menu_plus">
                                            <svg version="1.1" id="Capa_1" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                 viewBox="0 0 341.4 341.4" style="enable-background:new 0 0 341.4 341.4;" xml:space="preserve">
                                         <g>
                                             <g>
                                                 <polygon points="192,149.4 192,0 149.4,0 149.4,149.4 0,149.4 0,192 149.4,192 149.4,341.4 192,341.4 192,192 341.4,192
		                                          341.4,149.4 		"/>
                                             </g>
                                         </g>

                                     </svg>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<div id="content" class="app-content" role="main">
<?php
$adminFolder = getenv('ADMIN_FOLDER');  // admin folder
$adminFolder = $adminFolder ? "/" . $adminFolder : '/admin';
if ($PHP_SELF != $adminFolder . '/seoassistant.php') { ?>
    <div class="fix-width">
<?php } ?>

