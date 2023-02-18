<?php

define('CLIENT_DATA_CONFIGURATION_GROUP_ID', 5);
define('SHIPPING_PACKING_CONFIGURATION_GROUP_ID', 7);
define('CHECKOUT_CONFIGURATION_GROUP_ID', 7575);
define('PRODUCTS_LISTING_SETTINGS', 8);
define('SOLO_MODULES_CONFIGURATION_GROUP_ID', 277);
define('SOLO_SEO_CONFIGURATION_GROUP_ID', 125);
?>


<div class="sidebar_left <?=(!isMobile()&&$menu_location==='2'?'compact_sidebar':'');?>">
    <div class="header_sidebar_left">
        <form action="" method="post" class="search">
            <input type="search" name="" placeholder="<?php print TEXT_MENU_SEARCH; ?>" class="input" />
            <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path d="M508.5 468.9L387.1 347.5c-2.3-2.3-5.3-3.5-8.5-3.5h-13.2c31.5-36.5 50.6-84 50.6-136C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c52 0 99.5-19.1 136-50.6v13.2c0 3.2 1.3 6.2 3.5 8.5l121.4 121.4c4.7 4.7 12.3 4.7 17 0l22.6-22.6c4.7-4.7 4.7-12.3 0-17zM208 368c-88.4 0-160-71.6-160-160S119.6 48 208 48s160 71.6 160 160-71.6 160-160 160z"></path>
            </svg>
        </form>
        <button class="action_left_menu">
            <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path d="M247.9 412.5l-148.4-148c-4.7-4.7-4.7-12.3 0-17l148.4-148c4.7-4.7 12.3-4.7 17 0l19.6 19.6c4.8 4.8 4.7 12.5-.2 17.1L187.2 230H436c6.6 0 12 5.4 12 12v28c0 6.6-5.4 12-12 12H187.2l97.1 93.7c4.8 4.7 4.9 12.4.2 17.1l-19.6 19.6c-4.7 4.8-12.3 4.8-17 .1zM52 436V76c0-6.6-5.4-12-12-12H12C5.4 64 0 69.4 0 76v360c0 6.6 5.4 12 12 12h28c6.6 0 12-5.4 12-12z"></path>
            </svg>
        </button>
    </div>

    <ul class="left_menu">
        <li class="section_title"><?=LEFT_MENU_SECTION_TITLE_SHOP;?></li>
        <li class="item-menu <?php print tep_is_active_menu() || tep_is_active_menu(FILENAME_DEFAULT)?'active':''; ?>">
            <a href="<?php print tep_href_link(FILENAME_DEFAULT); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16">
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="newmade-admin-detailed" transform="translate(-20.000000, -103.000000)" fill="#1D202D">
                            <g id="Container">
                                <g id="Sidebar" transform="translate(0.000000, 50.000000)">
                                    <g id="List" transform="translate(0.000000, 38.000000)">
                                        <g id="Item">
                                            <g id="Icon" transform="translate(20.000000, 15.000000)">
                                                <g id="home-icon" transform="translate(1.000000, 2.000000)">
                                                    <path d="M2.18765248,6.84987802 L6.68765248,3.24987802 C6.8702618,3.10379056 7.1297382,3.10379056 7.31234752,3.24987802 L11.8123475,6.84987802 C11.9309551,6.94476411 12,7.08842056 12,7.24031242 L12,11.5 C12,11.7761424 11.7761424,12 11.5,12 L9.5,12 C9.22385763,12 9,11.7761424 9,11.5 L9,9.5 C9,9.22385763 8.77614237,9 8.5,9 L5.5,9 C5.22385763,9 5,9.22385763 5,9.5 L5,11.5 C5,11.7761424 4.77614237,12 4.5,12 L2.5,12 C2.22385763,12 2,11.7761424 2,11.5 L2,7.24031242 C2,7.08842056 2.06904486,6.94476411 2.18765248,6.84987802 Z" id="Rectangle" fill="#eee" class="home1"/>
                                                    <path d="M0.409951982,5.64861259 L6.67460431,0.278910589 C6.86184918,0.11841499 7.13815082,0.11841499 7.32539569,0.278910589 L13.590048,5.64861259 C13.7997109,5.82832366 13.8239917,6.14397365 13.6442806,6.35363657 C13.6359525,6.3633527 13.6272545,6.37274551 13.6182057,6.38179428 L13.3228701,6.67712987 C13.1400112,6.85998882 12.8478878,6.87323983 12.6492245,6.70768712 L7.3200922,2.2667435 C7.13466922,2.11222435 6.86533078,2.11222435 6.6799078,2.2667435 L1.35077546,6.70768712 C1.15211221,6.87323983 0.859988815,6.85998882 0.677129868,6.67712987 L0.381794278,6.38179428 C0.186532133,6.18653213 0.186532133,5.86994964 0.381794278,5.6746875 C0.390843044,5.66563873 0.400235862,5.65694069 0.409951982,5.64861259 Z" id="Rectangle" fill="#eee" class="home2"/>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
                <?php echo TEXT_MENU_HOME; ?>
            </a>
        </li>
        <?php

        /*
         * Товары
         */
        $filenames = array(
            FILENAME_CATEGORIES,
            FILENAME_NEW_PRODUCTS_ATTRIBUTES,
            FILENAME_SALEMAKER,
            FILENAME_IMPORT_EXPORT,
            FILENAME_NEW_IMPORT_EXPORT,
            FILENAME_XSELL_PRODUCTS,
            FILENAME_SPECIALS,
            FILENAME_PROM,
            FILENAME_YML,
            FILENAME_PRODUCTS_MULTI,
            FILENAME_MANUFACTURERS,
            FILENAME_QUICK_UPDATES,
            FILENAME_FEATURED,
        );

        $isActive = in_array(basename($PHP_SELF),$filenames) && $menu_location!='0';
        if (new_tep_admin_check_boxes_parent($filenames)) { ?>
            <li class="item-menu <?=$isActive ?'active':''?>" data-title="<?php echo TEXT_MENU_PRODUCTS; ?>">
                <a href="<?php echo tep_href_link(FILENAME_CATEGORIES); ?>" class="auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="newmade-admin-detailed" transform="translate(-20.000000, -149.000000)">
                                <g id="Container">
                                    <g id="Sidebar" transform="translate(0.000000, 50.000000)">
                                        <g id="List" transform="translate(0.000000, 38.000000)">
                                            <g id="Item" transform="translate(0.000000, 46.000000)">
                                                <g id="Parent">
                                                    <g id="Icon" transform="translate(20.000000, 15.000000)">
                                                        <rect id="Rectangle" fill="#0A0C12" opacity="0" x="0" y="0" width="16" height="16"/>
                                                        <g id="cart" transform="translate(1.000000, 1.000000)" fill="#1D202D" fill-rule="nonzero">
                                                            <ellipse id="Oval" transform="translate(5.015953, 13.015086) rotate(-1.057000) translate(-5.015953, -13.015086) " cx="5.01595306" cy="13.0150861" rx="1" ry="1" class="prod1" fill="#686d78"/>
                                                            <ellipse id="Oval" transform="translate(12.058632, 13.020675) rotate(-88.635063) translate(-12.058632, -13.020675) " cx="12.0586318" cy="13.0206746" rx="1" ry="1.00088171" class="prod1" fill="#686d78"/>
                                                            <path d="M13.9946344,2.42792824 C13.9695947,2.34261648 13.8944758,2.28574196 13.8086256,2.27863265 L3.90837366,1.15891568 C3.8082151,1.14825171 3.68659399,1.08426788 3.64009179,0.991846802 C3.55450368,0.832935106 4.06711163,3.16333564 5.17791564,7.98304842 C5.28644811,8.45395052 5.75617075,8.74771217 6.22707355,8.63918273 C6.23471808,8.63742089 6.24233857,8.63555632 6.24993295,8.63358953 L13.2470222,6.82148434 L13.2470222,6.82148434 C13.3400266,6.80726571 13.4115684,6.73261791 13.4222997,6.63664217 L13.9946344,2.52034933 C14.0017885,2.49191207 14.0017885,2.45992016 13.9946344,2.42792824 Z" id="Path" class="prod2" fill="#eee"/>
                                                            <path d="M2.76035981,0.991802925 C2.62466295,0.739421209 2.53895967,0.597234327 2.32470147,0.330633923 C2.04973678,-0.0035052507 1.53194613,0.00715876547 0.582068109,4.94213558e-05 C0.26068081,-0.0035052507 0,0.184892368 0,0.501258181 C0,0.81051465 0.24639693,1.00246694 0.557071319,1.00246694 C0.867745709,1.00246694 1.31768793,1.0202403 1.48552352,1.07000571 C1.65335911,1.11977112 1.78905597,1.39348087 1.83904955,1.63164389 C1.83904955,1.63519857 1.83904955,1.63875324 1.84262052,1.64230791 C1.84976246,1.68496398 1.91403992,2.00488446 1.91403992,2.00843913 L3.34242792,8.6551252 C3.4281312,9.17055265 3.60310873,9.5971133 3.86021857,9.92414313 C4.16018005,10.3080477 4.55655772,10.5 5.0350677,10.5 L12.6101453,10.5 C12.8815391,10.5 13.1136521,10.293829 13.124365,10.0236739 C13.1386489,9.73930018 12.9101068,9.50469182 12.6244292,9.50469182 L5.02792576,9.50469182 C4.95650636,9.50469182 4.85294823,9.50469182 4.73153525,9.40516101 C4.6065513,9.29852085 4.43514474,9.05324847 4.3208737,8.48094627 C3.31147951,3.54979836 2.79130821,1.05341724 2.76035981,0.991802925 Z" id="Path" class="prod1" fill="#686d78"/>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <?php echo TEXT_MENU_PRODUCTS; ?>
                </a>
                <span class="down">
                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path>
                    </svg>
                </span>
                <ul class="sub_menu" style="">

                    <?php

                    if (new_tep_admin_check_boxes(FILENAME_CATEGORIES) == true) {
                        ?>
                        <li<?php print tep_is_active_menu(FILENAME_CATEGORIES)?' class="active"':''; ?>>
                            <a href="<?php echo tep_href_link(FILENAME_CATEGORIES); ?>">
                                <?php echo TEXT_MENU_CATALOGUE; ?>
                            </a>
                        </li>
                        <?php
                    }

                    if (getConstantValue('PRODUCTS_MULTI_ENABLED') == 'true') {
                        echo printMenuItem(FILENAME_PRODUCTS_MULTI, BOX_CATALOG_CATEGORIES_PRODUCTS_MULTI, $menu_location, $PHP_SELF);
                    } elseif (!file_exists(DIR_FS_EXT . 'products_multi')) {
                        if(getConstantValue('SITE_TYPE') == "RENTED"){
                            echo printMenuItemNotExist(BOX_CATALOG_CATEGORIES_PRODUCTS_MULTI, LINK_TO_SUBSCRIPTION, getPackageName('products_multi'), 'rented', 596);
                        } else {
                            echo printMenuItemNotExist(BOX_CATALOG_CATEGORIES_PRODUCTS_MULTI, LINK_TO_SHOP, TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY);
                        }
                    } else {
                        echo printMenuItemNotExist(BOX_CATALOG_CATEGORIES_PRODUCTS_MULTI, tep_href_link(FILENAME_CONFIGURATION, 'gID=277'), TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON);
                    }

                    if (new_tep_admin_check_boxes(FILENAME_QUICK_UPDATES) == true) {
                        ?>
                        <li<?=strstr(basename($PHP_SELF),FILENAME_QUICK_UPDATES) && $menu_location != '0' ? ' class="active"' : ''?>>
                            <a href="<?php print tep_href_link(FILENAME_QUICK_UPDATES); ?>">
                                <?php print BOX_CATALOG_QUICK_UPDATES; ?>
                            </a>
                        </li>
                        <?php
                    }

                    if (new_tep_admin_check_boxes(FILENAME_FEATURED) == true) {
                        ?>
                        <li<?=strstr(basename($PHP_SELF),FILENAME_FEATURED) && $menu_location != '0' ? ' class="active"' : ''?>>
                            <a href="<?php print tep_href_link(FILENAME_FEATURED); ?>">
                                <?php print BOX_CATALOG_FEATURED . " " . renderLeftMenuTooltip(TOOLTIP_PRODUCTS_FEATURED); ?>
                            </a>
                        </li>
                        <?php
                    }

                    if (getConstantValue('XSELL_PRODUCTS_BUYNOW_ENABLED') == 'true') {
                        echo printMenuItem(FILENAME_XSELL_PRODUCTS, BOX_CATALOG_XSELL_PRODUCTS, $menu_location, $PHP_SELF, renderLeftMenuTooltip(TOOLTIP_PRODUCTS_RELATED));
                    } elseif (!file_exists(DIR_FS_EXT . 'xsell_products_buynow')) {
                        if(getConstantValue('SITE_TYPE') == "RENTED"){
                            echo printMenuItemNotExist(BOX_CATALOG_XSELL_PRODUCTS, LINK_TO_SUBSCRIPTION, getPackageName('xsell_products_buynow'), 'rented', 439);
                        } else {
                            echo printMenuItemNotExist(BOX_CATALOG_XSELL_PRODUCTS, LINK_TO_SHOP, TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY);
                        }
                    } else {
                        echo printMenuItemNotExist(BOX_CATALOG_XSELL_PRODUCTS, tep_href_link(FILENAME_CONFIGURATION, 'gID=277'), TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON);
                    }

                    echo printMenuItem(FILENAME_NEW_PRODUCTS_ATTRIBUTES, TEXT_MENU_ATTRIBUTES, $menu_location, $PHP_SELF);

                    $isMenuItemActive = strstr(basename($PHP_SELF),FILENAME_SPECIALS) ||
                        strstr(basename($PHP_SELF),FILENAME_SALEMAKER);

                    if (new_tep_admin_check_boxes(FILENAME_SPECIALS) == true) {
                        ?>
                        <li<?=$isMenuItemActive && $menu_location != '0' ? ' class="active"' : ''?>>
                            <a href="<?php print tep_href_link(FILENAME_SPECIALS); ?>">
                                <?php print BOX_CATALOG_SPECIALS; ?>
                            </a>
                        </li>
                        <?php
                    }


                    if (new_tep_admin_check_boxes(FILENAME_MANUFACTURERS) == true) {
                        ?>
                        <li<?=strstr(basename($PHP_SELF),FILENAME_MANUFACTURERS) && $menu_location != '0' ? ' class="active"' : ''?>>
                            <a href="<?php print tep_href_link(FILENAME_MANUFACTURERS); ?>">
                                <?php print BOX_CATALOG_MANUFACTURERS; ?>
                            </a>
                        </li>
                        <?php
                    }

                    $isMenuItemActive = strstr(basename($PHP_SELF),FILENAME_IMPORT_EXPORT);


                    ?>
                    <li<?=$isMenuItemActive && $menu_location != '0' ? ' class="active"' : ''?>>
                        <a href="<?php print tep_href_link(FILENAME_NEW_IMPORT_EXPORT); ?>">
                            <?php print IMPORT_EXPORT_MENU_BOX; ?>
                        </a>
                    </li>
                </ul>
            </li>
            <?php
        }

        /*
         * Заказы
         */
        $filenames = array(
            FILENAME_ORDERS,
            FILENAME_ORDERS_STATUS,
            FILENAME_CREATE_ORDER,
            FILENAME_QUICK_ORDERS
        );
        $isActive = in_array(basename($PHP_SELF),$filenames) && $menu_location != '0';

        if (new_tep_admin_check_boxes_parent($filenames)) { ?>
            <li class="item-menu tooltip-left_menu <?=$isActive ?'active':''?>" data-title="<?php echo TEXT_MENU_ORDERS; ?>">
                <a href="<?php echo tep_href_link(FILENAME_ORDERS); ?>" class="auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="newmade-admin-detailed" transform="translate(-20.000000, -570.000000)">
                                <g id="Container">
                                    <g id="Sidebar" transform="translate(0.000000, 50.000000)">
                                        <g id="List" transform="translate(0.000000, 38.000000)">
                                            <g id="Item" transform="translate(0.000000, 467.000000)">
                                                <g id="Icon" transform="translate(20.000000, 15.000000)">
                                                    <rect id="Rectangle" fill="#1D202D" opacity="0" x="0" y="0" width="16" height="16"/>
                                                    <path d="M8.41055718,15.9896657 L7.94134897,15.9896657 C7.84750686,15.9896657 7.70674581,15.9927277 7.51906158,15.9988517 C7.33137736,16.0049758 7.17888622,15.9866039 7.06158358,15.9437357 C6.94428094,15.9008675 6.87261892,14.7426763 6.87261892,14.4593553 C6.87261892,14.1760343 6.58064727,14.1760343 6.15835777,13.9800652 C5.03225243,13.4901426 4.32844716,12.6511626 4.04692082,11.4631001 C4.01564012,11.3651156 4,11.2487607 4,11.114032 C4,10.942559 4.06256047,10.8200802 4.18768328,10.7465918 C4.3128061,10.6731034 4.53176774,10.611864 4.84457478,10.5628717 L5.1026393,10.5261277 L5.66568915,10.5077557 C5.91593478,10.5077557 6.09579613,10.5261275 6.20527859,10.5628717 C6.31476106,10.5996159 6.4007817,10.6669793 6.46334311,10.7649638 C6.52590452,10.8629484 6.61192516,11.0466666 6.72140762,11.3161241 C6.83089009,11.5978296 6.99511132,11.8305394 7.21407625,12.0142604 C7.43304117,12.1979814 7.69892317,12.2898405 8.01173021,12.2898405 C8.10557232,12.2898405 8.17595284,12.2837165 8.2228739,12.2714685 C8.53568094,12.2469723 8.79374287,12.1244935 8.99706745,11.9040283 C9.20039202,11.6835631 9.30205279,11.4324815 9.30205279,11.150776 C9.30205279,11.0282953 9.27859261,10.9119404 9.23167155,10.8017078 C9.02834698,10.1893045 8.62170393,9.69326525 8.01173021,9.31357519 C6.94818628,8.67667573 6.04105947,7.98773232 5.29032258,7.24672429 C4.53958569,6.50571626 4.16422287,5.65142643 4.16422287,4.68382917 C4.16422287,4.45111591 4.20332317,4.18166249 4.28152493,3.87546082 C4.46920915,3.10383263 5.07917372,2.44244696 6.11143695,1.89128396 C6.56500716,1.6585707 6.87051882,1.72977282 6.91743988,1.49705955 C6.96436093,1.32558662 6.94819026,0.0347836369 7.21407625,0.0102875037 C7.2297166,0.0102875037 7.39002897,0.00722553301 7.46041056,0.00110149973 C7.53079214,-0.00502253355 8.51807047,0.0166782066 8.72136994,0.0102875037 C9.20840907,-0.00502253355 8.99706745,1.24767592 9.05870056,1.51647754 C9.05870056,1.70100299 9.40655518,1.68155569 9.65395894,1.78105191 L10.1466276,1.983144 C10.8973645,2.350586 11.4291284,2.91398861 11.7419355,3.67336874 C11.7888565,3.82034553 11.8123167,3.94282436 11.8123167,4.04080889 C11.8123167,4.40825089 11.6559155,4.62258884 11.3431085,4.68382917 C10.8582576,4.76956564 10.3655939,4.84305294 9.86510264,4.90429327 C9.70869912,4.91654134 9.58357818,4.89816951 9.48973607,4.84917725 C9.39589396,4.80018498 9.3216034,4.7144498 9.26686217,4.59196913 C9.21212094,4.46948847 9.16911062,4.37762935 9.13782991,4.31638901 C9.10654921,4.21840448 9.0518088,4.10817354 8.97360704,3.98569287 C8.89540528,3.85096414 8.76246428,3.74073319 8.57478006,3.65499673 C8.38709584,3.56926026 8.19159437,3.52639267 7.98826979,3.52639267 C7.70674346,3.52639267 7.4721417,3.62131376 7.28445748,3.81115879 C7.09677326,4.00100383 7.00293255,4.29189104 7.00293255,4.68382917 C7.00293255,5.1125115 7.17106381,5.53506346 7.50733138,5.95149773 C7.84359894,6.36793199 8.28543226,6.74149242 8.83284457,7.07219021 C9.4115376,7.42738414 9.97458182,7.84381216 10.5219941,8.32148676 C11.5073363,9.19109948 12,10.1403104 12,11.169148 C12,11.5488381 11.9452596,11.9101506 11.8357771,12.2530965 C11.6011718,13.0002285 11.0381276,13.5636311 10.1466276,13.9433212 L9.65395894,14.1454133 C9.37243261,14.2433978 9.05870056,14.2555751 9.05870056,14.5143712 C9.05870056,14.7731673 9.00879801,15.8610615 8.93841642,15.8978057 C8.86803484,15.9345499 8.69208352,15.9651696 8.41055718,15.9896657 Z" id="$" fill="#eee" fill-rule="nonzero" class="doll"/>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <?php print TEXT_MENU_ORDERS; ?>
                    <b class="badge new_badge">
                        <?php
                        $orders_awaiting = tep_db_fetch_array(tep_db_query("SELECT COUNT(*) AS total FROM " . TABLE_ORDERS . " WHERE views = '0'"));
                        $orders_awaiting = $orders_awaiting['total'];
                        echo '<span class="orders_menu_count">' . $orders_awaiting . '</span>';
                        $quick_orders_awaiting = '';
                        if (is_file(DIR_FS_EXT . 'quick_order/quick_order.php')) {
                            $quick_orders_awaiting = tep_db_fetch_array(tep_db_query("SELECT COUNT(*) AS total FROM " . TABLE_QUICK_ORDERS . " WHERE status = '0'"));
                            $quick_orders_awaiting = $quick_orders_awaiting['total'];
                            echo '/<span class="quick_orders_menu_count">' . $quick_orders_awaiting . '</span>';
                        }
                        ?>
                    </b>
                </a>
                <span class="down">
                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path>
                    </svg>
                </span>
                <ul class="sub_menu" style="">
                    <?php

                    if (new_tep_admin_check_boxes(FILENAME_ORDERS) == true) {
                        ?>
                        <li<?=strstr(basename($PHP_SELF),FILENAME_ORDERS) && $menu_location != '0' && !isset($_GET['action'])? ' class="active"' : ''?>>
                            <a href="<?php echo tep_href_link(FILENAME_ORDERS); ?>">
                                <?php echo '<div>
                                                ' . TEXT_MENU_ORDERS_LIST . '
                                                <b class="badge badge_item">' . $orders_awaiting . '</b>' .
                                            '</div>'; ?>
                            </a>
                        </li>
                        <?php
                    }
                    if (getConstantValue('QUICK_ORDER_ENABLED') == 'true') {
                        $text = '<div>' . TEXT_QUICK_ORDER;
                        $text .= '<b class="badge badge_item"><span class="quick_orders_menu_count">' . $quick_orders_awaiting . '</span></b>';
                        $text .= '</div>';
                        echo printMenuItem(FILENAME_QUICK_ORDERS, $text, $menu_location, $PHP_SELF);
                    } elseif (!file_exists(DIR_FS_EXT . 'quick_order')) {
                        if(getConstantValue('SITE_TYPE') == "RENTED"){
                            echo printMenuItemNotExist(TEXT_QUICK_ORDER, LINK_TO_SUBSCRIPTION, getPackageName('quick_order'), 'rented', '');
                        } else {
                            echo printMenuItemNotExist(TEXT_QUICK_ORDER, "https://solomono.net/$languages_code/?module=quick_order", TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY);
                        }
                    } else {
                        echo printMenuItemNotExist(TEXT_QUICK_ORDER, tep_href_link(FILENAME_CONFIGURATION, 'gID=277'), TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON);
                    }
                    if (new_tep_admin_check_boxes(FILENAME_ORDERS_STATUS) == true) {
                        ?>
                        <li<?=strstr(basename($PHP_SELF),FILENAME_ORDERS_STATUS) && $menu_location != '0' ? ' class="active"' : ''?>>
                            <a href="<?php echo tep_href_link(FILENAME_ORDERS_STATUS); ?>">
                                <?php echo BOX_LOCALIZATION_ORDERS_STATUS; ?>
                            </a>
                        </li>
                        <?php
                    }

                    if (true) {
                        ?>
                        <li<?=strstr(basename($PHP_SELF),FILENAME_ORDERS) && $menu_location != '0' && isset($_GET['action']) && $_GET['action'] == 'create_order_form_user_selection'? ' class="active"' : ''?>>
                            <a href="<?php echo tep_href_link(FILENAME_ORDERS,'page=1&perPage=25&action=create_order_form_user_selection'); ?>">
                                <?php echo BOX_MANUAL_ORDER_CREATE_ORDER; ?>
                            </a>
                        </li>
                        <?php
                    }

                    ?>
                </ul>
            </li>
            <?php
        }

        /*
         * Клиенты
         */
        $filenames = array(
            FILENAME_CUSTOMERS,
            FILENAME_GROUPS,
            FILENAME_CREATE_ACCOUNT,
        );
        $isActive = (
                in_array(basename($PHP_SELF),$filenames) ||
                (basename($PHP_SELF) === FILENAME_CONFIGURATION && $_GET['gID'] == CLIENT_DATA_CONFIGURATION_GROUP_ID )
            ) && $menu_location != '0';

        if (new_tep_admin_check_boxes_parent($filenames)) { ?>
            <li class="item-menu tooltip-left_menu <?=$isActive ?'active':''?>" data-title="<?php echo BOX_HEADING_CUSTOMERS; ?>">
                <a href="<?php echo tep_href_link(FILENAME_CUSTOMERS); ?>" class="auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="newmade-admin-detailed" transform="translate(-20.000000, -615.000000)">
                                <g id="Container">
                                    <g id="Sidebar" transform="translate(0.000000, 50.000000)">
                                        <g id="List" transform="translate(0.000000, 38.000000)">
                                            <g id="Item" transform="translate(0.000000, 513.000000)">
                                                <g id="Icon" transform="translate(20.000000, 14.000000)">
                                                    <rect id="Rectangle" fill="#1D202D" opacity="0" x="0" y="0" width="16" height="16"/>
                                                    <g id="users-solid" transform="translate(0.000000, 3.000000)" fill="#0A0C12" fill-rule="nonzero">
                                                        <path d="M8.05298013,5.61589404 C9.55189215,5.61589404 10.807947,4.35983917 10.807947,2.86092715 C10.807947,1.25605487 9.55189215,0 8.05298013,0 C6.44810785,0 5.19205298,1.25605487 5.19205298,2.86092715 C5.19205298,4.35983917 6.44810785,5.61589404 8.05298013,5.61589404 Z M9.9602649,6.46357616 L9.74834437,6.46357616 C9.1977649,6.71192053 8.61771523,6.86092715 8.05298013,6.88741722 C7.38228477,6.86092715 6.80474614,6.71192053 6.25165563,6.46357616 L6.0397351,6.46357616 C4.47450331,6.46357616 3.17880795,7.21523179 3.17880795,8.79470199 L3.17880795,10.5960265 C3.17880795,11.227649 3.18887969,11.2317881 3.81456954,11.2317881 L12.1854305,11.2317881 C12.8111203,11.2317881 12.8211921,11.227649 12.8211921,10.5960265 L12.8211921,8.79470199 C12.8211921,7.21523179 11.5254967,6.46357616 9.9602649,6.46357616 Z" id="Shape" fill="#eee" class="customers1"/>
                                                        <path d="M14.7284768,5.61589404 C15.5975836,5.61589404 16,6.01076159 16,6.88741722 L16,6.88741722 L16,8.1589404 C16,8.65149007 15.8530268,8.79470199 15.3642384,8.79470199 L15.3642384,8.79470199 L13.5629139,8.79470199 C13.5629139,7.58931445 13.1122373,6.60037817 11.6556291,6.0397351 C11.9467597,5.79221854 12.3458094,5.61589404 12.8211921,5.61589404 L12.8211921,5.61589404 Z M3.17880795,5.61589404 C3.65419063,5.61589404 4.05324029,5.79221854 4.34437086,6.0397351 C2.61515565,6.60037817 2.61515565,7.61754967 2.43708609,8.79470199 L2.43708609,8.79470199 L0.635761589,8.79470199 C0.146973192,8.79470199 -2.94875235e-13,8.65149007 -2.94875235e-13,8.1589404 L-2.94875235e-13,8.1589404 L-2.94875235e-13,6.78145695 C-2.94875235e-13,5.90480132 0.402416396,5.61589404 1.27152318,5.61589404 L1.27152318,5.61589404 Z M2.43708609,1.58940397 C3.31374172,1.58940397 4.02649007,2.30215232 4.02649007,3.17880795 C4.02649007,4.05546358 3.31374172,4.76821192 2.43708609,4.76821192 C1.56043046,4.76821192 0.847682119,4.05546358 0.847682119,3.17880795 C0.847682119,2.30215232 1.56043046,1.58940397 2.43708609,1.58940397 Z M13.5629139,1.58940397 C14.4395695,1.58940397 15.1523179,2.30215232 15.1523179,3.17880795 C15.1523179,4.05546358 14.4395695,4.76821192 13.5629139,4.76821192 C12.6862583,4.76821192 11.9735099,4.05546358 11.9735099,3.17880795 C11.9735099,2.30215232 12.6862583,1.58940397 13.5629139,1.58940397 Z" id="Combined-Shape" class="customers2" fill="#686d78"/>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <?php print BOX_HEADING_CUSTOMERS; ?>
                </a>
                <span class="down">
                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path>
                    </svg>
                </span>
                <ul class="sub_menu" style="">
                    <?php

                    if (new_tep_admin_check_boxes(FILENAME_CUSTOMERS) == true) {
                        ?>
                        <li<?=strstr(basename($PHP_SELF),FILENAME_CUSTOMERS) && $menu_location != '0' ? ' class="active"' : ''?>>
                            <a href="<?php echo tep_href_link(FILENAME_CUSTOMERS); ?>">
                                <?php echo TEXT_MENU_CLIENTS_LIST; ?>
                            </a>
                        </li>
                        <?php
                    }

                    if (new_tep_admin_check_boxes(FILENAME_GROUPS) == true) {
                        if (file_exists(DIR_FS_EXT . 'customers_groups/customers_groups.php')) {
                            echo printMenuItem(FILENAME_GROUPS, TEXT_MENU_CLIENTS_GROUPS, $menu_location, $PHP_SELF);
                        } else {
                            echo printMenuItemNotExist(TEXT_MENU_CLIENTS_GROUPS, LINK_TO_SHOP, TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY);
                        }
                    }

                    if (new_tep_admin_check_boxes(FILENAME_CREATE_ACCOUNT) == true) {
                        ?>
                        <li<?=strstr(basename($PHP_SELF),FILENAME_CREATE_ACCOUNT) && $menu_location != '0' ? ' class="active"' : ''?>>
                            <a href="<?php echo tep_href_link(FILENAME_CREATE_ACCOUNT); ?>">
                                <?php echo TEXT_MENU_ADD_CLIENT; ?>
                            </a>
                        </li>
                        <?php
                    }

                    ?>

                    <li <?=(isset($_GET['gID']) && $_GET['gID'] == CLIENT_DATA_CONFIGURATION_GROUP_ID && $menu_location != '0' ?' class="active"':'')?>>
                        <a href="<?=tep_href_link(FILENAME_CONFIGURATION, 'gID=' . CLIENT_DATA_CONFIGURATION_GROUP_ID, 'NONSSL')?>">
                            <?=CUSTOMER_DETAILS_CONF_TITLE?>
                        </a>
                    </li>

                </ul>
            </li>
            <?php
        }

        /*
         * Контент
         */
        $filenames = array(
            FILENAME_ARTICLES,
            FILENAME_EMAIL_CONTENT,
            FILENAME_REVIEWS,
            'image_explorer.php',
            FILENAME_MAIL,
        );
        $isActive = in_array(basename($PHP_SELF),$filenames) && $menu_location != '0';
        if (new_tep_admin_check_boxes_parent($filenames)) { ?>
            <li class="item-menu tooltip-left_menu <?=$isActive ?'active':''?>" data-title="<?php echo BOX_HEADING_INFORMATION; ?>">
                <a href="<?php echo tep_href_link(FILENAME_ARTICLES); ?>" class="auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="newmade-admin-detailed" transform="translate(-20.000000, -662.000000)">
                                <g id="Container">
                                    <g id="Sidebar" transform="translate(0.000000, 50.000000)">
                                        <g id="List" transform="translate(0.000000, 38.000000)">
                                            <g id="Item" transform="translate(0.000000, 559.000000)">
                                                <g id="Icon" transform="translate(20.000000, 15.000000)">
                                                    <rect id="Rectangle" fill="#1D202D" opacity="0" x="0" y="0" width="16" height="16"/>
                                                    <g id="Edit---Icon" transform="translate(1.000000, 1.000000)" fill="#0A0C12" fill-rule="nonzero">
                                                        <path d="M13.6281223,3.75526945 L12.1324467,5.25 L8.75,1.86670184 L10.2443544,0.371971289 C10.4822585,0.133812558 10.8050427,-5.68434189e-14 11.1416276,-5.68434189e-14 C11.4782126,-5.68434189e-14 11.8009967,0.133812558 12.0389009,0.371971289 L13.6281223,1.96027118 C13.8662211,2.19823524 14,2.52110063 14,2.85777031 C14,3.19444 13.8662211,3.51730539 13.6281223,3.75526945 L13.6281223,3.75526945 Z" id="Path" fill="#eee" class="content1"/>
                                                        <path d="M0.116401563,12.2649933 L0.00400659243,13.2759173 L0.00400659243,13.2759173 C-0.0178997456,13.4727141 0.0508142944,13.6688019 0.190766771,13.8088708 C0.330719248,13.9489396 0.526740122,14.0178069 0.723538435,13.9960474 L1.72939424,13.8850017 C3.08511257,13.7353315 4.349377,13.1282121 5.31380202,12.1637134 L11.375,6.10205224 L11.375,6.10205224 L7.89821344,2.625 L1.83731381,8.68505423 C0.873862018,9.64837165 0.26694969,10.910905 0.116401563,12.2649933 Z" id="Path" fill="#686d78" class="content2"/>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <?php echo BOX_HEADING_INFORMATION; ?>
                </a>
                <span class="down">
                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path>
                    </svg>
                </span>
                <ul class="sub_menu" style="">
                    <?php

                    if (new_tep_admin_check_boxes(FILENAME_ARTICLES) == true) {
                        ?>
                        <li<?=strstr(basename($PHP_SELF),FILENAME_ARTICLES) && $menu_location != '0' ? ' class="active"' : ''?>>
                            <a href="<?php echo tep_href_link(FILENAME_ARTICLES); ?>">
                                <?php echo TEXT_MENU_PAGES; ?>
                            </a>
                        </li>
                        <?php
                    }

                    if (getConstantValue('EMAIL_CONTENT_MODULE_ENABLED') == 'true') {
                        echo printMenuItem(FILENAME_EMAIL_CONTENT, TEXT_MENU_EMAIL_CONTENT, $menu_location, $PHP_SELF, renderLeftMenuTooltip(TOOLTIP_EMAIL_TEMPLATE));
                    } elseif (!file_exists(DIR_FS_EXT . 'email_content')) {
                        if(getConstantValue('SITE_TYPE') == "RENTED"){
                            echo printMenuItemNotExist(TEXT_MENU_EMAIL_CONTENT, LINK_TO_SUBSCRIPTION, getPackageName('email_content'), 'rented', '');
                        } else {
                            echo printMenuItemNotExist(TEXT_MENU_EMAIL_CONTENT, "https://solomono.net/$languages_code/?module=email_content", TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY);
                        }
                    } else {
                        echo printMenuItemNotExist(TEXT_MENU_EMAIL_CONTENT, tep_href_link(FILENAME_CONFIGURATION, 'gID=277'), TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON);
                    }

                    if (new_tep_admin_check_boxes('image_explorer.php') == true) {
                        ?>
                        <li<?=strstr(basename($PHP_SELF),'image_explorer.php') && $menu_location != '0' ? ' class="active"' : ''?>>
                            <a href="<?php echo tep_href_link('image_explorer.php'); ?>">
                                <?php echo TEXT_MENU_CKFINDER . " " . renderLeftMenuTooltip(TOOLTIP_FILE_MANAGER); ?>
                            </a>
                        </li>
                        <?php
                    }
                    if (getConstantValue('COMMENTS_MODULE_ENABLED') == 'true') {
                        echo printMenuItem(FILENAME_REVIEWS, TEXT_MENU_REVIEWS, $menu_location, $PHP_SELF);
                    } elseif (!file_exists(DIR_FS_EXT . 'reviews')) {
                        if(getConstantValue('SITE_TYPE') == "RENTED"){
                            echo printMenuItemNotExist(TEXT_MENU_REVIEWS, LINK_TO_SUBSCRIPTION, getPackageName('reviews'), 'rented', '');
                        } else {
                            echo printMenuItemNotExist(TEXT_MENU_REVIEWS, "https://solomono.net/$languages_code/?module=reviews", TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY);
                        }
                    } else {
                        echo printMenuItemNotExist(TEXT_MENU_REVIEWS, tep_href_link(FILENAME_CONFIGURATION, 'gID=277'), TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON);
                    }


                        $isMenuItemActive = strstr(basename($PHP_SELF),FILENAME_MAIL) ||
                            strstr(basename($PHP_SELF),FILENAME_NEWSLETTERS);

                        if (new_tep_admin_check_boxes(FILENAME_MAIL)) {
                        ?>
                            <li<?=$isMenuItemActive && $menu_location != '0' ? ' class="active"' : ''?>>
                                <a href="<?php echo tep_href_link(FILENAME_MAIL); ?>">
                                    <?php echo BOX_MENU_TOOLS_EMAILS?>
                                </a>
                                </li>
                                <?php
                                }
                    ?>
                </ul>
            </li>
            <?php
        }

        /*
         * Модули
         */
        echo '<li class="section_title">'.LEFT_MENU_SECTION_TITLE_INFO.'</li>';
        $filenames = [
            FILENAME_POLLS,
            FILENAME_CURRENCIES,
            FILENAME_COUPON_ADMIN,
            FILENAME_LANGUAGES,
            FILENAME_MODULES,
            FILENAME_SHIP2PAY,
            FILENAME_AUTO_TRANSLATE,
            FILENAME_LANGUAGES_TRANSLATER,
            FILENAME_BACKUP,
        ];
        $isActive =
            (
                in_array(basename($PHP_SELF),$filenames) ||
                (
                    basename($PHP_SELF) === FILENAME_CONFIGURATION &&
                    $_GET['gID'] == SOLO_MODULES_CONFIGURATION_GROUP_ID
                )
            ) && $menu_location != '0';

        if (new_tep_admin_check_boxes_parent($filenames)) { ?>
        <li class="item-menu tooltip-left_menu <?php echo $isActive  ? 'active' : ''; ?>" data-title="<?php echo BOX_HEADING_MODULES; ?>">
            <a href="<?php echo tep_href_link(FILENAME_MODULES, 'set=payment', 'NONSSL'); ?>" class="auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16">
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="newmade-admin-detailed" transform="translate(-20.000000, -708.000000)">
                            <g id="Container">
                                <g id="Sidebar" transform="translate(0.000000, 50.000000)">
                                    <g id="List" transform="translate(0.000000, 38.000000)">
                                        <g id="Item" transform="translate(0.000000, 605.000000)">
                                            <g id="Icon" transform="translate(20.000000, 15.000000)">
                                                <rect id="Rectangle" fill="#1D202D" opacity="0" x="0" y="0" width="16" height="16"/>
                                                <g id="sidebar-icon" fill="#0A0C12">
                                                    <path d="M13.9999245,11.000136 L15.1055728,11.5527864 C15.2023365,11.6011683 15.2807978,11.6796295 15.3291796,11.7763932 C15.4526742,12.0233825 15.3525621,12.323719 15.1055728,12.4472136 L15.1055728,12.4472136 L9.78885438,15.1055728 C8.66274442,15.6686278 7.33725558,15.6686278 6.21114562,15.1055728 L6.21114562,15.1055728 L0.894427191,12.4472136 C0.79766349,12.3988317 0.719202244,12.3203705 0.670820393,12.2236068 C0.547325769,11.9766175 0.647437942,11.676281 0.894427191,11.5527864 L0.894427191,11.5527864 L1.99892446,11.000136 L6.21114562,13.1055728 C7.33725558,13.6686278 8.66274442,13.6686278 9.78885438,13.1055728 L13.9999245,11.000136 Z" id="Combined-Shape" fill="#686d78" class="modules1"/>
                                                    <path d="M13.9999245,7.00013595 L15.1055728,7.5527864 C15.2023365,7.60116826 15.2807978,7.6796295 15.3291796,7.7763932 C15.4526742,8.02338245 15.3525621,8.32371897 15.1055728,8.4472136 L15.1055728,8.4472136 L9.78885438,11.1055728 C8.66274442,11.6686278 7.33725558,11.6686278 6.21114562,11.1055728 L6.21114562,11.1055728 L0.894427191,8.4472136 C0.79766349,8.39883174 0.719202244,8.3203705 0.670820393,8.2236068 C0.547325769,7.97661755 0.647437942,7.67628103 0.894427191,7.5527864 L0.894427191,7.5527864 L1.99892446,7.00013595 L6.21114562,9.10557281 C7.33725558,9.66862779 8.66274442,9.66862779 9.78885438,9.10557281 L13.9999245,7.00013595 Z" id="Combined-Shape" fill="#93969f" class="modules2"/>
                                                    <path d="M15.1055728,3.5527864 L9.78885438,0.894427191 C8.66274442,0.33137221 7.33725558,0.33137221 6.21114562,0.894427191 L0.894427191,3.5527864 C0.647437942,3.67628103 0.547325769,3.97661755 0.670820393,4.2236068 C0.719202244,4.3203705 0.79766349,4.39883174 0.894427191,4.4472136 L6.21114562,7.10557281 C7.33725558,7.66862779 8.66274442,7.66862779 9.78885438,7.10557281 L15.1055728,4.4472136 C15.3525621,4.32371897 15.4526742,4.02338245 15.3291796,3.7763932 C15.2807978,3.6796295 15.2023365,3.60116826 15.1055728,3.5527864 Z" id="Path" fill="#eee" class="modules3"/>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
                <?php print BOX_HEADING_MODULES; ?>
            </a>
            <span class="down">
                <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                    <path d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path>
                </svg>
            </span>
            <ul class="sub_menu" style="">
                <?php

                if (new_tep_admin_check_boxes(FILENAME_MODULES) == true) {
                    ?>
                    <li<?=strstr(basename($PHP_SELF),FILENAME_MODULES) && $menu_location != '0' && isset($_GET['set']) && $_GET['set'] == 'payment' ? ' class="active"' : ''?>>
                        <a href="<?php echo tep_href_link(FILENAME_MODULES, 'set=payment', 'NONSSL'); ?>">
                            <?php echo BOX_MODULES_PAYMENT . " " . renderLeftMenuTooltip(TOOLTIP_MODULES_PAYMENT); ?>
                        </a>
                    </li>
                    <li<?=strstr(basename($PHP_SELF),FILENAME_MODULES) && $menu_location != '0' && isset($_GET['set']) && $_GET['set'] == 'shipping' ? ' class="active"' : ''?>>
                        <a href="<?php echo tep_href_link(FILENAME_MODULES, 'set=shipping', 'NONSSL'); ?>">
                            <?php echo BOX_MODULES_SHIPPING . " " . renderLeftMenuTooltip(TOOLTIP_MODULES_SHIPPING); ?>
                        </a>
                    </li>
                    <li<?=strstr(basename($PHP_SELF),FILENAME_MODULES) && $menu_location != '0' && isset($_GET['set']) && $_GET['set'] == 'ordertotal' ? ' class="active"' : ''?>>
                        <a href="<?php echo tep_href_link(FILENAME_MODULES, 'set=ordertotal', 'NONSSL'); ?>">
                            <?php echo BOX_MODULES_ORDER_TOTAL . " " . renderLeftMenuTooltip(TOOLTIP_MODULES_TOTALS); ?>
                        </a>
                    </li>
                    <?php
                }

                if (new_tep_admin_check_boxes(FILENAME_SHIP2PAY) == true) {
                    ?>
                    <li<?=strstr(basename($PHP_SELF),FILENAME_SHIP2PAY) && $menu_location != '0' ? ' class="active"' : ''?>>
                        <a href="<?php echo tep_href_link(FILENAME_SHIP2PAY); ?>">
                            <?php echo BOX_MODULES_SHIP2PAY . " " . renderLeftMenuTooltip(TOOLTIP_MODULES_ZONE); ?>
                        </a>
                    </li>
                    <?php
                }
                } ?>

            <li<?=in_array(basename($PHP_SELF), [FILENAME_LANGUAGES, FILENAME_LANGUAGES_TRANSLATER, FILENAME_AUTO_TRANSLATE]) && $menu_location != '0' ? ' class="active"' : ''?>>
                <a href="<?php echo tep_href_link(FILENAME_LANGUAGES); ?>">
                    <?php echo BOX_LOCALIZATION_LANGUAGES . " " . renderLeftMenuTooltip(TOOLTIP_MODULES_LANGUAGES); ?>
                </a>
            </li>

            <?php if (new_tep_admin_check_boxes(FILENAME_CURRENCIES) == true) {
                ?>
                <li<?=strstr(basename($PHP_SELF),FILENAME_CURRENCIES) && $menu_location != '0' ? ' class="active"' : ''?>>
                    <a href="<?= tep_href_link(FILENAME_CURRENCIES); ?>">
                        <?= BOX_CURRENCIES_CONFIG . " " . renderLeftMenuTooltip(TOOLTIP_MODULES_CURRENCY); ?>
                    </a>
                </li>
                <?php
            }

            if (getConstantValue('CUPONES_MODULE_ENABLED') == 'true') {
                echo printMenuItem(FILENAME_COUPON_ADMIN, BOX_COUPONS, $menu_location, $PHP_SELF, renderLeftMenuTooltip(TOOLTIP_MODULES_COUPONS));
            } elseif (!file_exists(DIR_FS_EXT . 'coupons')) {
                if(getConstantValue('SITE_TYPE') == "RENTED"){
                    echo printMenuItemNotExist(BOX_COUPONS, LINK_TO_SUBSCRIPTION, getPackageName('coupons'), 'rented', '');
                } else {
                    echo printMenuItemNotExist(BOX_COUPONS, LINK_TO_SHOP, TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY);
                }
            } else {
                echo printMenuItemNotExist(BOX_COUPONS, tep_href_link(FILENAME_CONFIGURATION, 'gID=277'), TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON);
            }

            if (new_tep_admin_check_boxes(FILENAME_POLLS) == true) {?>
                <li<?=strstr(basename($PHP_SELF),FILENAME_POLLS) && $menu_location != '0' && !isset($_GET['action']) ? ' class="active"' : ''?>>
                    <a href="<?= tep_href_link(FILENAME_POLLS, '', 'NONSSL'); ?>">
                        <?= BOX_POLLS_POLLS . " " . renderLeftMenuTooltip(TOOLTIP_MODULES_POOLS); ?>
                    </a>
                </li>
                <?php
            }
            if (getConstantValue('BACKUP_ENABLED') == 'true') {
                echo printMenuItem(FILENAME_BACKUP, TEXT_MENU_BACKUP, $menu_location, $PHP_SELF);
            } elseif (!file_exists(DIR_FS_EXT . 'backup')) {
                if(getConstantValue('SITE_TYPE') == "RENTED"){
                    echo printMenuItemNotExist(TEXT_MENU_BACKUP, LINK_TO_SUBSCRIPTION, getPackageName('backup'), 'rented', 480);
                } else {
                    echo printMenuItemNotExist(TEXT_MENU_BACKUP, LINK_TO_SHOP, TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY);
                }
            } else {
                echo printMenuItemNotExist(TEXT_MENU_BACKUP, tep_href_link(FILENAME_CONFIGURATION, 'gID=277'), TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON);
            }

            if (new_tep_admin_check_boxes(FILENAME_CONFIGURATION) == true) {
                ?>
                <li<?= isset($_GET['gID']) && $_GET['gID'] == 277 && $menu_location != '0' ? ' class="active"' : '' ?>>
                    <a href="<?= tep_href_link(FILENAME_CONFIGURATION, 'gID=' . 277, 'NONSSL'); ?>">
                        <?= TEXT_MENU_SITE_MODULES . " " . renderLeftMenuTooltip(TOOLTIP_MODULES_SOLOMONO) ?>
                    </a>
                </li>
                <?php
            }
            ?>
        </ul>
    </li>
    <?php

        /*
    * Отчеты
    */
        $filenames = array(
            FILENAME_STATS_PRODUCTS_VIEWED,
            FILENAME_STATS_PRODUCTS_PURCHASED,
            FILENAME_STATS_PRODUCTS_PURCHASED_BY_CATEGORY,
            FILENAME_STATS_CUSTOMERS,
            FILENAME_STATS_MONTHLY_SALES,
            FILENAME_STATS_NOPHOTO,
            FILENAME_STATS_OPENED_BY,
            FILENAME_STATS_ZEROQTY,
            FILENAME_STATS_LAST_MODIFIED,
            FILENAME_STATS_RECOVER_CART_SALES,
            FILENAME_WHO_IS_ONLINE,
            FILENAME_KEYWORDS,
        );

        $isActive = in_array(basename($PHP_SELF),$filenames) && $menu_location != '0';
        if (new_tep_admin_check_boxes_parent($filenames)) { ?>
            <li class="item-menu tooltip-left_menu <?= $isActive ? 'active':''; ?>" data-title="<?php echo BOX_HEADING_REPORTS; ?>">
                <a href="<?php echo tep_href_link(FILENAME_WHO_IS_ONLINE); ?>" class="auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="newmade-admin-detailed" transform="translate(-20.000000, -892.000000)">
                                <g id="Container">
                                    <g id="Sidebar" transform="translate(0.000000, 50.000000)">
                                        <g id="List" transform="translate(0.000000, 38.000000)">
                                            <g id="Item" transform="translate(0.000000, 789.000000)">
                                                <g id="Icon" transform="translate(20.000000, 15.000000)">
                                                    <g id="analytics">
                                                        <path d="M2,12 C3.1045695,12 4,12.8954305 4,14 C4,15.1045695 3.1045695,16 2,16 C0.8954305,16 1.3527075e-16,15.1045695 0,14 C-1.3527075e-16,12.8954305 0.8954305,12 2,12 Z M11,8 C12.1045695,8 13,8.8954305 13,10 C13,11.1045695 12.1045695,12 11,12 C9.8954305,12 9,11.1045695 9,10 C9,8.8954305 9.8954305,8 11,8 Z M6,4 C7.1045695,4 8,4.8954305 8,6 C8,7.1045695 7.1045695,8 6,8 C4.8954305,8 4,7.1045695 4,6 C4,4.8954305 4.8954305,4 6,4 Z M14,0 C15.1045695,-2.02906125e-16 16,0.8954305 16,2 C16,3.1045695 15.1045695,4 14,4 C12.8954305,4 12,3.1045695 12,2 C12,0.8954305 12.8954305,2.02906125e-16 14,0 Z" id="Combined-Shape" fill="#eee" class="reports"/>
                                                        <polyline class="reports" id="Line" stroke="#eee" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" points="2 14 6 6 11 10 14 2"/>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <?php print BOX_HEADING_REPORTS; ?>
                </a>
                <span class="down">
                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path>
                    </svg>
                </span>
                <ul class="sub_menu" style="">
                    <?php

                    if (new_tep_admin_check_boxes(FILENAME_WHO_IS_ONLINE)) {
                        ?>
                        <li<?=strstr(basename($PHP_SELF),FILENAME_WHO_IS_ONLINE) && $menu_location != '0' ? ' class="active"' : ''?>>
                            <a href="<?php echo tep_href_link(FILENAME_WHO_IS_ONLINE); ?>">
                                <?php echo TEXT_MENU_WHO_IS_ONLINE; ?>
                            </a>
                        </li>
                        <?php
                    }

                    if (new_tep_admin_check_boxes(FILENAME_STATS_MONTHLY_SALES)) {
                        ?>
                        <li<?=strstr(basename($PHP_SELF),FILENAME_STATS_MONTHLY_SALES) && $menu_location != '0' ? ' class="active"' : ''?>>
                            <a href="<?php echo tep_href_link(FILENAME_STATS_MONTHLY_SALES); ?>">
                                <?php echo TEXT_MENU_SALES; ?>
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
                            <a href="<?php echo tep_href_link(FILENAME_STATS_PRODUCTS_PURCHASED); ?>">
                                <?php echo BOX_PRODUCTS_STATS_MENU_ITEM . " " . renderLeftMenuTooltip(TOOLTIP_STATS_VIEWED_PRODUCTS); ?>
                            </a>
                        </li>
                        <?php
                    }

                    $isMenuItemActive = strstr(basename($PHP_SELF),FILENAME_STATS_CUSTOMERS) ||
                        strstr(basename($PHP_SELF),FILENAME_STATS_OPENED_BY);


                    if (new_tep_admin_check_boxes(FILENAME_STATS_CUSTOMERS)) {
                        ?>
                        <li<?=$isMenuItemActive && $menu_location != '0' ? ' class="active"' : ''?>>
                            <a href="<?php echo tep_href_link(FILENAME_STATS_CUSTOMERS); ?>">
                                <?php echo TEXT_MENU_CLIENTS . " " . renderLeftMenuTooltip(TOOLTIP_STATS_CLIENTS_ORDERS); ?>
                            </a>
                        </li>
                        <?php
                    }
                    if (getConstantValue('STATS_KEYWORDS_ENABLED') == 'true') {
                        echo printMenuItem(FILENAME_KEYWORDS, BOX_TOOLS_KEYWORDS, $menu_location, $PHP_SELF);
                    } elseif (!file_exists(DIR_FS_EXT . 'stats_keywords')) {
                        if(getConstantValue('SITE_TYPE') == "RENTED"){
                            echo printMenuItemNotExist(BOX_TOOLS_KEYWORDS, LINK_TO_SUBSCRIPTION, getPackageName('stats_keywords'), 'rented', 598);
                        } else {
                            echo printMenuItemNotExist(BOX_TOOLS_KEYWORDS, LINK_TO_SHOP, TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY);
                        }
                    } else {
                        echo printMenuItemNotExist(BOX_TOOLS_KEYWORDS, tep_href_link(FILENAME_CONFIGURATION, 'gID=277'), TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON);
                    }

                        if (getConstantValue('FILENAME_STATS_NOPHOTO', false)) {
                            echo printMenuItem(FILENAME_STATS_NOPHOTO, getConstantValue('TEXT_MENU_NOPHOTO'), $menu_location, $PHP_SELF);
                        }

                    ?>
                </ul>
            </li>
            <?php
        }
        /*
        * Инструкции
        */
        $filenames = array(FILENAME_INSTRUCTIONS);
        $isActive = in_array(basename($PHP_SELF),$filenames);

        if (new_tep_admin_check_boxes_parent($filenames) and new_tep_admin_check_boxes(FILENAME_INSTRUCTIONS) == true) { ?>
            <li class="tooltip-menu item-menu tooltip-left_menu <?= $isActive?'active':''; ?>">
                <a href="<?php echo tep_href_link(FILENAME_INSTRUCTIONS); ?>" class="auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16" version="1.1">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="newmade-admin-detailed" transform="translate(-20.000000, -1031.000000)" fill-rule="nonzero">
                                <g id="Container">
                                    <g id="Sidebar" transform="translate(0.000000, 50.000000)">
                                        <g id="List" transform="translate(0.000000, 38.000000)">
                                            <g id="Item-" transform="translate(0.000000, 927.000000)">
                                                <g id="Icon" transform="translate(1.000000, 16.000000)">
                                                    <g id="people-outline">
                                                        <g id="align-left-solid" transform="translate(20.000000, 1.000000)">
                                                            <path d="M0.4009375,9.99999988 L8.5990625,9.99999988 C8.70542316,10.000083 8.80745141,9.95786814 8.88265978,9.88265978 C8.95786814,9.80745141 8.99999988,9.70542316 8.99999988,9.5990625 L8.99999988,8.4009375 C8.99999988,8.29457684 8.95786814,8.19254859 8.88265978,8.11734022 C8.80745141,8.04213186 8.70542316,7.999917 8.5990625,7.99999988 L0.4009375,7.99999988 C0.294576842,7.999917 0.19254859,8.04213186 0.117340224,8.11734022 C0.0421318581,8.19254859 -1.22151505e-07,8.29457684 -1.22151505e-07,8.4009375 L-1.22151505e-07,9.5990625 C-1.22151505e-07,9.70542316 0.0421318581,9.80745141 0.117340224,9.88265978 C0.19254859,9.95786814 0.294576842,10.000083 0.4009375,9.99999988 Z" id="Path" fill="#686d78" class="instruct1"/>
                                                            <path d="M0.4009375,1.99999988 L8.5990625,1.99999988 C8.70542316,2.000083 8.80745141,1.95786814 8.88265978,1.88265978 C8.95786814,1.80745141 8.99999988,1.70542316 8.99999988,1.5990625 L8.99999988,0.4009375 C8.99999988,0.294576842 8.95786814,0.19254859 8.88265978,0.117340224 C8.80745141,0.0421318581 8.70542316,-8.29970403e-05 8.5990625,-1.22151732e-07 L0.4009375,-1.22151732e-07 C0.294576842,-8.29970403e-05 0.19254859,0.0421318581 0.117340224,0.117340224 C0.0421318581,0.19254859 -1.22151505e-07,0.294576842 -1.22151505e-07,0.4009375 L-1.22151505e-07,1.5990625 C-1.22151505e-07,1.70542316 0.0421318581,1.80745141 0.117340224,1.88265978 C0.19254859,1.95786814 0.294576842,2.000083 0.4009375,1.99999988 L0.4009375,1.99999988 Z" id="Path" fill="#686d78" class="instruct1"/>
                                                            <path d="M13.5,4 L0.5,4 C0.223857625,4 0,4.22385763 0,4.5 L0,5.5 C0,5.77614237 0.223857625,6 0.5,6 L13.5,6 C13.7761424,6 14,5.77614237 14,5.5 L14,4.5 C14,4.22385763 13.7761424,4 13.5,4 Z" id="Path" fill="#eee" class="instruct2"/>
                                                            <path d="M13.5,12 L0.5,12 C0.223857625,12 0,12.2238576 0,12.5 L0,13.5 C0,13.7761424 0.223857625,14 0.5,14 L13.5,14 C13.7761424,14 14,13.7761424 14,13.5 L14,12.5 C14,12.2238576 13.7761424,12 13.5,12 Z" id="Path" fill="#eee" class="instruct3"/>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <?php echo BOX_HEADING_INSTRUCTION; ?>
                </a>
            </li>

            <?php
        }

        echo '<li class="section_title">'.LEFT_MENU_SECTION_TITLE_CONTROL.'</li>';
        /*
         * Настройки
         */
        $filenames = array(
            FILENAME_CONFIGURATION,
            FILENAME_TAX_CLASSES,
            FILENAME_TAX_RATES,
            FILENAME_GEO_ZONES,
            FILENAME_API,
            FILENAME_TOTAL_CONFIGURATION,
            FILENAME_MYSQL_PERFORMANCE,
        );

        $isActive = in_array(basename($PHP_SELF),$filenames) && $menu_location != '0';
        if(
            basename($PHP_SELF) == FILENAME_CONFIGURATION &&
            (
                $_GET['gID'] == CLIENT_DATA_CONFIGURATION_GROUP_ID ||
                $_GET['gID'] == SOLO_MODULES_CONFIGURATION_GROUP_ID ||
                $_GET['gID'] == SOLO_SEO_CONFIGURATION_GROUP_ID
            )
        ) {
            $isActive = false;
        }
        if (new_tep_admin_check_boxes(FILENAME_CONFIGURATION)) { ?>
            <li class="item-menu tooltip-left_menu <?= $isActive?'active':''; ?>" data-title="<?php echo BOX_HEADING_CONFIGURATION; ?>">
                <a href="<?php echo tep_href_link(FILENAME_CONFIGURATION, 'gID=1', 'NONSSL');?>" class="auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="newmade-admin-detailed" transform="translate(-20.000000, -800.000000)" fill="#0A0C12" fill-rule="nonzero">
                                <g id="Container">
                                    <g id="Sidebar" transform="translate(0.000000, 50.000000)">
                                        <g id="List" transform="translate(0.000000, 38.000000)">
                                            <g id="Item" transform="translate(0.000000, 697.000000)">
                                                <g id="Icon" transform="translate(20.000000, 15.000000)">
                                                    <g id="settings-icon">
                                                        <path d="M15.7947311,9.92258065 L14.3593,9.12903226 C14.5041923,8.38056602 14.5041923,7.61298237 14.3593,6.86451613 L15.7947311,6.07096774 C15.9585118,5.97985788 16.0352633,5.79282522 15.9800567,5.61935484 C15.6090745,4.4841312 14.9795586,3.44187134 14.1369093,2.56774194 C14.0091801,2.43454289 13.8021449,2.4037411 13.6382149,2.49354839 L12.2027839,3.28709677 C11.5998212,2.79039706 10.9049169,2.40634145 10.1540935,2.15483871 L10.1540935,0.570967742 C10.1540346,0.39016083 10.0232413,0.233476573 9.83903995,0.193548387 C8.62733261,-0.064516129 7.37119155,-0.064516129 6.15948421,0.193548387 C5.97461334,0.232827838 5.84298182,0.389677459 5.8427459,0.570967742 L5.8427459,2.15806452 C5.09379193,2.4134545 4.39959962,2.79711659 3.79405553,3.29032258 L2.36030922,2.49677419 C2.19667757,2.40543936 1.98857557,2.43639986 1.86161485,2.57096774 C1.01755891,3.4441047 0.387849544,4.48668503 0.0184674283,5.62258065 C-0.0382019656,5.79610353 0.0389033162,5.98399845 0.203793038,6.07419355 L1.63922412,6.86774194 C1.49433181,7.61620818 1.49433181,8.38379182 1.63922412,9.13225806 L0.203793038,9.92580645 C0.0397125868,10.0166697 -0.0371340194,10.2039343 0.0184674283,10.3774194 C0.389243091,11.5127298 1.01878383,12.555031 1.86161485,13.4290323 C1.98934405,13.5622313 2.19637926,13.5930331 2.36030922,13.5032258 L3.7957403,12.7096774 C4.39856837,13.2065587 5.09351033,13.5906351 5.84443068,13.8419355 L5.84443068,15.4290323 C5.8446666,15.6103225 5.97629812,15.7671722 6.16116899,15.8064516 C7.37287633,16.0645161 8.62901739,16.0645161 9.84072473,15.8064516 C10.0255956,15.7671722 10.1572271,15.6103225 10.157463,15.4290323 L10.157463,13.8419355 C10.9063823,13.5864736 11.6005616,13.2028187 12.2061534,12.7096774 L13.6415845,13.5032258 C13.8052416,13.5944316 14.013253,13.5634846 14.1402789,13.4290323 C14.9844635,12.5559862 15.6141907,11.5133764 15.9834263,10.3774194 C16.0365537,10.2023367 15.9588591,10.0150585 15.7947311,9.92258065 L15.7947311,9.92258065 Z M8,12 C5.790861,12 4,10.209139 4,8 C4,5.790861 5.790861,4 8,4 C10.209139,4 12,5.790861 12,8 C12.0001106,9.06089986 11.5787188,10.0783798 10.8285493,10.8285493 C10.0783798,11.5787188 9.06089986,12.0001106 8,12 L8,12 Z" id="Shape" fill="#686d78" class="config1"/>
                                                        <path d="M8,10 C6.8954305,10 6,9.1045695 6,8 C6,6.8954305 6.8954305,6 8,6 C9.1045695,6 10,6.8954305 10,8 C10,9.1045695 9.1045695,10 8,10 L8,10 Z" id="Path" fill="#eee" class="config2"/>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <?php echo BOX_HEADING_CONFIGURATION; ?>
                </a>
                <span class="down">
                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path>
                    </svg>
                </span>
                <ul class="sub_menu" style="">
                    <?php
                    define('UNCOMPLETED_ORDERS_CONFIGURATION_GROUP_ID', 6501);
                    define('XML_EXPORT_CONFIGURATION_GROUP_ID', 26230);

                    $settings_configuration = '';
                    $integrationSettingsStr = '';
                    $query = tep_db_query("SELECT configuration_group_id AS cgID, configuration_group_key AS cgKey, configuration_group_title AS cgTitle FROM " . TABLE_CONFIGURATION_GROUP . " WHERE visible = '1' ORDER BY sort_order");
                    while ($setting_configuration = tep_db_fetch_array($query)) {
                        if ($setting_configuration['cgID'] == 902 && SMSINFORM_MODULE_ENABLED != 'true') {

                            if (!file_exists(DIR_FS_EXT . 'sms')) {
                                if(getConstantValue('SITE_TYPE') == "RENTED"){
                                    $settings_configuration .= printMenuItemNotExist(constant(strtoupper($setting_configuration['cgKey'])), LINK_TO_SUBSCRIPTION, getPackageName('sms'), 'rented', 389);
                                } else {
                                    $settings_configuration .= printMenuItemNotExist(constant(strtoupper($setting_configuration['cgKey'])), LINK_TO_SHOP, TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY);
                                }
                            } else {
                                $settings_configuration .= printMenuItemNotExist(constant(strtoupper($setting_configuration['cgKey'])), tep_href_link(FILENAME_CONFIGURATION, 'gID=277'), TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON);
                            }

                            //$settings_configuration .= printMenuDisableItem(FILENAME_CONFIGURATION, constant(strtoupper($setting_configuration['cgKey'])), LINK_TO_SHOP);
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
                        } else if ($setting_configuration['cgID'] == 277) {
                            //$setting_configuration['cgKey'] = 'TEXT_MENU_SITE_MODULES';
                            continue;
                        } else if($setting_configuration['cgID'] == SMTP_CONFIGURATION_GROUP_ID && !defined('SMTP_MODULE_ENABLED')){
                            continue;
                        }
                        $settings_configuration .= '<li'.(isset($_GET['gID']) && $_GET['gID'] == $setting_configuration['cgID'] && $menu_location != '0' ?' class="active"':'').'><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=' . $setting_configuration['cgID'], 'NONSSL') . '">' . constant(strtoupper($setting_configuration['cgKey'])) . '</a></li>';
                    }
                    echo $settings_configuration;
                    $isMenuItemActive = strstr(basename($PHP_SELF),FILENAME_TAX_CLASSES) ||
                        strstr(basename($PHP_SELF),FILENAME_TAX_RATES) ||
                        strstr(basename($PHP_SELF),FILENAME_GEO_ZONES);
                    ?>
                    <li<?=$isMenuItemActive && $menu_location != '0' ? ' class="active"' : ''?>>
                        <a href="<?php echo tep_href_link(FILENAME_TAX_CLASSES); ?>">
                            <?php echo BOX_MENU_TAXES; ?>
                        </a>
                    </li>
                        <?php

                        if (new_tep_admin_check_boxes(FILENAME_MYSQL_PERFORMANCE)) {
                        ?>
                        <li<?=strstr(basename($PHP_SELF),FILENAME_MYSQL_PERFORMANCE) && $menu_location != '0' ? ' class="active"' : ''?>>
                            <a href="<?php echo tep_href_link(FILENAME_MYSQL_PERFORMANCE); ?>">
                                <?php echo TEXT_MENU_SLOW_QUERIES_LOGS; ?>
                            </a>
                            </li>
                            <?php
                            }

                            if (getConstantValue('API_ENABLED') == 'true') {
                                echo printMenuItem(FILENAME_API, TEXT_MENU_API, $menu_location, $PHP_SELF);
                            } elseif (!file_exists(DIR_FS_EXT . 'api')) {
                                if(getConstantValue('SITE_TYPE') == "RENTED"){
                                    echo printMenuItemNotExist(BOX_TOOLS_KEYWORDS, LINK_TO_SUBSCRIPTION, getPackageName('api'), 'rented', 608);
                                } else {
                                    echo printMenuItemNotExist(TEXT_MENU_API, LINK_TO_SHOP, TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY);
                                }
                            } else {
                                echo printMenuItemNotExist(TEXT_MENU_API, tep_href_link(FILENAME_CONFIGURATION, 'gID=277'), TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON);
                            }


                            if (new_tep_admin_check_boxes(FILENAME_TOTAL_CONFIGURATION) && $login_email_address == 'admin@solomono.net') {
                            ?>
                            <li<?=strstr(basename($PHP_SELF),FILENAME_TOTAL_CONFIGURATION) && $menu_location != '0' ? ' class="active"' : ''?>>
                                <a href="<?php echo tep_href_link(FILENAME_TOTAL_CONFIGURATION); ?>">
                                    <?php echo TEXT_MENU_TOTAL_CONFIG; ?>
                                </a>
                                </li>
                                <?php
                                }
                        ?>
                    <?= $integrationSettingsStr;?>
                </ul>
            </li>
            <?php
        }
        /**
         * SEO
         */
        $filenames = [
            FILENAME_SEO_TEMPLATES,
            FILENAME_SEO_FILTER,
            FILENAME_REDIRECTS,
            FILENAME_STATS_KEYWORDS_POPULAR,
        ];

        $isActive =
            (
                in_array(basename($PHP_SELF),$filenames) ||
                (
                    basename($PHP_SELF) === FILENAME_CONFIGURATION &&
                    $_GET['gID'] == SOLO_SEO_CONFIGURATION_GROUP_ID
                )
            ) && $menu_location != '0';
        if (new_tep_admin_check_boxes_parent($filenames)) { ?>
            <li class="item-menu tooltip-left_menu <?=$isActive ?'active':''?>" data-title="<?= BOX_HEADING_SEO; ?>">
                <a href="<?= tep_href_link(FILENAME_CONFIGURATION, 'gID=' . 125, 'NONSSL'); ?>" class="auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="17px" viewBox="0 0 16 17"><g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="newmade-admin-detailed" transform="translate(-20.000000, -984.000000)" fill="#0A0C12" fill-rule="nonzero"><g id="Container"><g id="Sidebar" transform="translate(0.000000, 50.000000)"><g id="List" transform="translate(0.000000, 38.000000)"><g id="Item-" transform="translate(0.000000, 881.000000)"><g id="Icon" transform="translate(20.000000, 16.000000)"><g id="people-outline"><g id="rocket-icon" transform="translate(1.000000, 1.000000)"><path d="M1.42026637,4.22418227 L0.0692070313,6.92608656 C0.0271003964,7.01813542 0.00357964185,7.1175912 -6.2890625e-06,7.21875 C8.71433207e-05,7.58114816 0.293845552,7.87490657 0.656243711,7.875 L3.21181602,7.875 C3.85279207,6.57857512 4.88010523,4.50151953 5.34163793,3.57305922 C5.35584383,3.54806512 5.36898168,3.52472695 5.38329449,3.5 L2.59273656,3.5 C2.14583715,3.50042711 1.62117895,3.82470703 1.42026637,4.22418227 Z M6.12499371,10.7911147 L6.12499371,13.3494648 C6.12994112,13.7084845 6.42112963,13.9976079 6.78017539,14 C6.88061951,13.9962028 6.97933582,13.9726851 7.07070273,13.9307861 L9.77025738,12.5802611 C10.1701597,12.3803099 10.4948668,11.8556517 10.4948668,11.4083252 L10.4948668,8.63250719 C10.4966824,8.63138609 10.4982847,8.63010395 10.4999937,8.62898258 L10.4999937,8.61456313 C10.4752134,8.62876902 10.4522488,8.64196156 10.427148,8.65627301 C9.49852887,9.12133031 7.41762656,10.1514219 6.12499371,10.7911147 Z" id="Shape" fill="#686d78" class="seo1"/><path d="M13.8129666,0.533630234 C13.7738758,0.362921059 13.6408076,0.22947961 13.4702086,0.18991082 C12.5843137,0 11.8774351,0 11.196832,0 C8.7591793,0 6.91272859,1.1105727 5.38607152,3.49503328 C5.3707973,3.52178969 5.35680523,3.5463575 5.34163793,3.57305922 C4.80576441,4.65110789 3.50405234,7.28369141 2.93410605,8.43688344 C2.76798651,8.77297963 2.83510448,9.17762208 3.10083895,9.44208672 L4.56789512,10.9021992 C4.83247333,11.165626 5.23540377,11.2313782 5.5700009,11.0657277 L5.95761988,10.8739477 C7.23113371,10.2437062 9.45943578,9.14093086 10.4271472,8.65627355 C10.4534229,8.64126648 10.477241,8.62759461 10.5034109,8.61258754 C12.8887257,7.07968188 13.9995655,5.23531395 13.9995655,2.80812902 C14.0017027,2.12207789 14.0035183,1.42427824 13.8129666,0.533630234 Z M10.0624937,5.25 C9.33762692,5.25 8.74999371,4.66238457 8.74999371,3.93751777 C8.74999371,3.21265098 9.33759137,2.625 10.0624582,2.625 C10.787325,2.625 11.3749643,3.21257989 11.3749937,3.93744668 C11.3746978,4.66220645 10.7872535,5.24967467 10.0624937,5.25 Z" id="Shape" fill="#eee" class="seo2"/></g></g></g></g></g></g></g></g></g></svg>
                    <?= BOX_HEADING_SEO; ?>
                </a>
                <span class="down">
                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path>
                    </svg>
                </span>
                <ul class="sub_menu" style="">
                    <?php
                        if (new_tep_admin_check_boxes(FILENAME_CONFIGURATION) == true) {
                            ?>
                            <li<?= isset($_GET['gID']) && $_GET['gID'] == 125 && $menu_location != '0' ? ' class="active"' : '' ?>>
                                <a href="<?= tep_href_link(FILENAME_CONFIGURATION, 'gID=' . 125, 'NONSSL'); ?>">
                                    <?= TEXT_MENU_SITE_SEO_SETTINGS; ?>
                                </a>
                            </li>
                            <?php
                        }
                        if (new_tep_admin_check_boxes(FILENAME_SEO_FILTER) == true) {
                            ?>
                            <li<?=strstr(basename($PHP_SELF),FILENAME_SEO_FILTER) && $menu_location != '0' ? ' class="active"' : ''?>>
                                <a href="<?= tep_href_link(FILENAME_SEO_FILTER); ?>">
                                    <?= BOX_CATALOG_SEO_FILTER; ?>
                                </a>
                            </li>
                            <?php
                        }
                        if (getConstantValue('SEO_TEMPLATES_ENABLED') == 'true') {
                            echo printMenuItem(FILENAME_SEO_TEMPLATES, BOX_CATALOG_SEO_TEMPALTES, $menu_location, $PHP_SELF);
                        } elseif (!file_exists(DIR_FS_EXT . 'seo_templates')) {
                            if(getConstantValue('SITE_TYPE') == "RENTED"){
                                echo printMenuItemNotExist(BOX_CATALOG_SEO_TEMPALTES, LINK_TO_SUBSCRIPTION, getPackageName('seo_templates'), 'rented', 588);
                            } else {
                                echo printMenuItemNotExist(BOX_CATALOG_SEO_TEMPALTES, LINK_TO_SHOP, TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY);
                            }
                        } else {
                            echo printMenuItemNotExist(BOX_CATALOG_SEO_TEMPALTES, tep_href_link(FILENAME_CONFIGURATION, 'gID=277'), TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON);
                        }

                        if (new_tep_admin_check_boxes(FILENAME_STATS_KEYWORDS_POPULAR) == true) {
                            ?>
                            <li<?=strstr(basename($PHP_SELF),FILENAME_STATS_KEYWORDS_POPULAR) && $menu_location != '0' ? ' class="active"' : ''?>>
                                <a href="<?php echo tep_href_link(FILENAME_STATS_KEYWORDS_POPULAR); ?>">
                                    <?php echo STATS_KEYWORDS_POPULAR_ENABLED_TITLE; ?>
                                </a>
                            </li>
                            <?php
                        }
                    ?>
                    <li<?=strstr(basename($PHP_SELF),FILENAME_REDIRECTS) && $menu_location != '0' ? ' class="active"' : ''?>>
                        <a href="<?= tep_href_link(FILENAME_REDIRECTS) ?>">
                            <?= TEXT_REDIRECTS_TITLE . " " . renderLeftMenuTooltip(TOOLTIP_REDIRECTS) ?>
                        </a>
                    </li>
                    <?php if (new_tep_admin_check_boxes(FILENAME_STATS_SEARCH_KEYWORDS) == true) { ?>
                        <li<?= strstr(basename($PHP_SELF), FILENAME_STATS_SEARCH_KEYWORDS) && $menu_location != '0' ? ' class="active"' : '' ?>>
                            <a href="<?= tep_href_link(FILENAME_STATS_SEARCH_KEYWORDS); ?>">
                                <?= BOX_CATALOG_STATS_SEARCH_KEYWORDS; ?>
                            </a>
                        </li>
                        <?php
                    }
                        echo '<li ' . $class . '>
                            <a style="color:#aaa;" href="#">
                                ' . 'SEO Assistant' . '
                            </a>
                        </li>';
                    ?>
                </ul>
            </li>
            <?php
        }
        /*
         * Дизайн
        */
        $filenames = array(FILENAME_TEMPLATE_CONFIGURATION);
        $isActive = in_array(basename($PHP_SELF),$filenames);
        if (new_tep_admin_check_boxes_parent($filenames) and new_tep_admin_check_boxes(FILENAME_TEMPLATE_CONFIGURATION) == true) {
            $template_id_select_query = tep_db_query("SELECT template_id FROM " . TABLE_TEMPLATE . "  WHERE template_name = '" . DEFAULT_TEMPLATE . "'");
            $template_id_select = tep_db_fetch_array($template_id_select_query);
            ?>
            <li class="item-menu tooltip-left_menu <?=$isActive ?'active':''?>" data-title="<?php echo BOX_HEADING_DESIGN_CONTROLS; ?>">
                <a href="<?php echo tep_href_link(FILENAME_TEMPLATE_CONFIGURATION, 'action=edit_template&id=' . $template_id_select['template_id'], 'NONSSL'); ?>" class="auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16"><g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="newmade-admin-detailed" transform="translate(-20.000000, -754.000000)"><g id="Container"><g id="Sidebar" transform="translate(0.000000, 50.000000)"><g id="List" transform="translate(0.000000, 38.000000)"><g id="Item" transform="translate(0.000000, 651.000000)"><g id="Icon" transform="translate(20.000000, 15.000000)"><rect id="Rectangle" fill="#1D202D" opacity="0" x="0" y="0" width="16" height="16"/><path d="M6.07599262,1.106953 C11.5371915,0.327835949 15.9844934,3.92399001 16,8.03620646 C15.9968987,9.52993018 15.0975141,10.388367 14.0151985,10.0159932 C12.6919975,9.59732602 11.6995968,9.55048314 11.0379963,9.87546454 C9.38678166,10.6865493 9.58645732,12.2182614 10.0455956,12.9856732 C10.2129252,14.3180353 9.58645732,15.7158952 8.0607941,15.9553533 C4.36692524,16.4728276 -0.865012146,12.4300544 0.121588192,7.04631311 C0.890338511,4.13279896 3.37450084,1.81559969 6.07599262,1.106953 Z M3.5,9 C2.6703125,9 2,9.6703125 2,10.5 C2,11.3296875 2.6703125,12 3.5,12 C4.3296875,12 5,11.3296875 5,10.5 C5,9.6703125 4.3296875,9 3.5,9 Z M4.5,5 C3.6703125,5 3,5.6703125 3,6.5 C3,7.3296875 3.6703125,8 4.5,8 C5.3296875,8 6,7.3296875 6,6.5 C6,5.6703125 5.3296875,5 4.5,5 Z M12.5,4 C11.6703125,4 11,4.6703125 11,5.5 C11,6.3296875 11.6703125,7 12.5,7 C13.3296875,7 14,6.3296875 14,5.5 C14,4.6703125 13.3296875,4 12.5,4 Z M8.5,3 C7.6703125,3 7,3.6703125 7,4.5 C7,5.3296875 7.6703125,6 8.5,6 C9.3296875,6 10,5.3296875 10,4.5 C10,3.6703125 9.3296875,3 8.5,3 Z" id="Combined-Shape" fill="#eee" fill-rule="nonzero" class="design-c"/></g></g></g></g></g></g></g></svg>
                    <?php echo BOX_HEADING_DESIGN_CONTROLS; ?>
                </a>
            </li>
            <?php
        }
        /*
         * Инструменты
         */
//        $filenames = array(
//            FILENAME_NEWSLETTERS,
//            // FILENAME_GOOGLE_SITEMAP,
//            FILENAME_RECOVER_CART_SALES
//        );
//
//        $isActive = in_array(basename($PHP_SELF),$filenames) && $menu_location != '0';
//        if (new_tep_admin_check_boxes_parent($filenames)) { ?>
<!--            <li class="item-menu tooltip-left_menu --><?//= $isActive?'active':''; ?><!--" data-title="--><?php //echo BOX_HEADING_TOOLS; ?><!--">-->
<!--                <a href="--><?php //echo tep_href_link(FILENAME_MYSQL_PERFORMANCE); ?><!--" class="auto">-->
<!--                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16">-->
<!--                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">-->
<!--                            <g id="newmade-admin-detailed" transform="translate(-20.000000, -846.000000)">-->
<!--                                <g id="Container">-->
<!--                                    <g id="Sidebar" transform="translate(0.000000, 50.000000)">-->
<!--                                        <g id="List" transform="translate(0.000000, 38.000000)">-->
<!--                                            <g id="Item" transform="translate(0.000000, 743.000000)">-->
<!--                                                <g id="sidebar-icon" transform="translate(20.000000, 15.000000)">-->
<!--                                                    <rect id="Rectangle" fill="#1D202D" opacity="0" x="0" y="0" width="16" height="16"/>-->
<!--                                                    <path d="M2,14 C2,14.3644243 2.09746762,14.7060837 2.26775657,15.0003321 L0.9,15 C0.402943725,15 6.08718376e-17,14.5970563 0,14.1 L0,14.1 L0,13.9 C2.7219507e-16,13.4029437 0.402943725,13 0.9,13 L0.9,13 L2.26790938,12.9994038 C2.09752593,13.2937119 2,13.6354668 2,14 Z M15.1,13 C15.5970563,13 16,13.4029437 16,13.9 L16,13.9 L16,14.1 C16,14.5970563 15.5970563,15 15.1,15 L15.1,15 L9.73224343,15.0003321 C9.90253238,14.7060837 10,14.3644243 10,14 C10,13.6354668 9.90247407,13.2937119 9.73209062,12.9994038 Z" id="Combined-Shape" fill="#686d78"  class="tools-line"/>-->
<!--                                                    <path d="M15.1,1 C15.5970563,1 16,1.40294373 16,1.9 L16,1.9 L16,2.1 C16,2.59705627 15.5970563,3 15.1,3 L15.1,3 L5.73224343,3.00033215 C5.90253238,2.70608373 6,2.36442426 6,2 C6,1.63546675 5.90247407,1.2937119 5.73209062,0.999403849 Z" id="Combined-Shape" fill="#686d78"  class="tools-line"/>-->
<!--                                                    <path d="M5,8 C5,8.36442426 5.09746762,8.70608373 5.26775657,9.00033215 L0.9,9 C0.402943725,9 6.08718376e-17,8.59705627 0,8.1 L0,8.1 L0,7.9 C2.7219507e-16,7.40294373 0.402943725,7 0.9,7 L0.9,7 L5.26790938,6.99940385 C5.09752593,7.2937119 5,7.63546675 5,8 Z M15.1,7 C15.5970563,7 16,7.40294373 16,7.9 L16,7.9 L16,8.1 C16,8.59705627 15.5970563,9 15.1,9 L15.1,9 L12.7322434,9.00033215 C12.9025324,8.70608373 13,8.36442426 13,8 C13,7.63546675 12.9024741,7.2937119 12.7320906,6.99940385 Z" id="Combined-Shape" fill="#686d78"  class="tools-line"/>-->
<!--                                                    <path d="M6,12 C7.1045695,12 8,12.8954305 8,14 C8,15.1045695 7.1045695,16 6,16 C4.8954305,16 4,15.1045695 4,14 C4,12.8954305 4.8954305,12 6,12 Z M9,6 C10.1045695,6 11,6.8954305 11,8 C11,9.1045695 10.1045695,10 9,10 C7.8954305,10 7,9.1045695 7,8 C7,6.8954305 7.8954305,6 9,6 Z M2,0 C3.1045695,-2.02906125e-16 4,0.8954305 4,2 C4,3.1045695 3.1045695,4 2,4 C0.8954305,4 1.3527075e-16,3.1045695 0,2 C-1.3527075e-16,0.8954305 0.8954305,2.02906125e-16 2,0 Z" id="Combined-Shape" fill="#eee" class="tools-round"/>-->
<!--                                                </g>-->
<!--                                            </g>-->
<!--                                        </g>-->
<!--                                    </g>-->
<!--                                </g>-->
<!--                            </g>-->
<!--                        </g>-->
<!--                    </svg>-->
<!--                    --><?php //echo BOX_HEADING_TOOLS; ?>
<!--                </a>-->
<!--                <span class="down">-->
<!--                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">-->
<!--                        <path d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path>-->
<!--                    </svg>-->
<!--                </span>-->
<!--                <ul class="sub_menu" style="">-->
<!--                    --><?php
//
//                    ?>
<!--                    </ul>-->
<!--                </li>-->
<!--                --><?php
//            }


            /*
             * Админы
             */
            $filenames = array(FILENAME_ADMIN_MEMBERS);
            $isActive = in_array(basename($PHP_SELF),$filenames) && $menu_location != '0';

            if (new_tep_admin_check_boxes_parent($filenames) and new_tep_admin_check_boxes(FILENAME_ADMIN_MEMBERS) == true) { ?>
                <li class="tooltip-menu item-menu tooltip-left_menu <?=strstr(basename($PHP_SELF),FILENAME_ADMIN_MEMBERS) && $menu_location != '0' ? 'active' : ''?>" data-title="<?php print BOX_HEADING_ADMINISTRATOR; ?>">
                    <a class="auto" href="<?php echo tep_href_link(FILENAME_ADMIN_MEMBERS); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="17px" viewBox="0 0 16 17">
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="newmade-admin-detailed" transform="translate(-20.000000, -938.000000)">
                                    <g id="Container">
                                        <g id="Sidebar" transform="translate(0.000000, 50.000000)">
                                            <g id="List" transform="translate(0.000000, 38.000000)">
                                                <g id="Item-" transform="translate(0.000000, 835.000000)">
                                                    <g id="Icon" transform="translate(20.000000, 16.000000)">
                                                        <g id="people-outline">
                                                            <g id="Front" transform="translate(2.000000, 1.000000)">
                                                                <path d="M9,5 C9,6.65685425 7.65685425,8 6,8 C4.34314575,8 3,6.65685425 3,5 L9,5 L9,5 Z M6,2 C6.88854726,2 7.68687122,2.3862919 8.23619452,3.00009834 L3.76380548,3.00009834 C4.31312878,2.3862919 5.11145274,2 6,2 Z" id="Combined-Shape" fill="#eee" class="adm"/>
                                                                <path d="M6,10 C3.29984714,10 0.703079604,11.1560714 6.36646291e-12,13 C-0.00886927601,13.185942 -0.014231454,13.3504779 -0.0160865339,13.4936077 C-0.0195770851,13.7696797 0.201321913,13.9963799 0.477392742,13.999958 C0.479552207,13.999986 0.48171183,14 0.483871476,14 L11.5158528,14 C11.7920355,14.0000731 12.0159259,13.7761827 12.0159259,13.5 C12.0159259,13.4978666 12.0159122,13.4957332 12.0158849,13.4936 C12.014053,13.350472 12.008758,13.1859387 12,13 C11.297742,11.12 8.70097445,10 6,10 Z" id="Path" fill="#eee" class="adm"/>
                                                                <polygon id="Rectangle" fill="#FFD400" points="2 0 4.28571429 2.40740741 6 0.555555556 7.71428571 2.40740741 10 0 9.42857143 4 2.57142857 4"/>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        <?php echo BOX_HEADING_ADMINISTRATOR; ?>
                    </a>
                </li>
                <?php
            }
            ?>
        </ul>
</div>


<div id="overflow_admin"></div>
