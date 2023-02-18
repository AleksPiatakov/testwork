<?php

define('CLIENT_DATA_CONFIGURATION_GROUP_ID', 5);
define('SHIPPING_PACKING_CONFIGURATION_GROUP_ID', 7);
define('CHECKOUT_CONFIGURATION_GROUP_ID', 7575);
define('PRODUCTS_LISTING_SETTINGS', 8);
define('SOLO_MODULES_CONFIGURATION_GROUP_ID', 277);
define('SOLO_SEO_CONFIGURATION_GROUP_ID', 125);
?>

<!-- aside -->
<div class="horizontal_container bg-dark">
    <div class="container">
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
        <ul class="horizontal_menu">
            <li class="item-menu <?php print tep_is_active_menu() || tep_is_active_menu(FILENAME_DEFAULT)?'active':''; ?>">
                <a href="<?php print tep_href_link(FILENAME_DEFAULT); ?>">

                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16px" height="16px" viewBox="0 0 16 16" version="1.1">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="newmade-admin-detailed" transform="translate(-20.000000, -65.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                <g id="Sidebar" transform="translate(0.000000, 50.000000)">
                                    <g id="List">
                                        <g id="Item">
                                            <g id="Icon" transform="translate(20.000000, 15.000000)">
                                                <g id="home-sharp" transform="translate(0.000000, 1.000000)">
                                                    <path d="M12.5,1 L11.5,1 C11.2238576,1 11,1.22385763 11,1.5 L11,2.51715728 C11,2.62761423 10.9104569,2.71715728 10.8,2.71715728 C10.7469567,2.71715728 10.6960859,2.69608591 10.6585786,2.65857864 L8.35355339,0.353553391 C8.15829124,0.158291245 7.84170876,0.158291245 7.64644661,0.353553391 L0.707106781,7.29289322 C0.545346323,7.45465368 0.545346323,7.7169192 0.707106781,7.87867966 C0.784786893,7.95635977 0.890143733,8 1,8 L1.5,8 C1.77614237,8 2,8.22385763 2,8.5 L2,13.5 C2,13.7761424 2.22385763,14 2.5,14 L5.5,14 C5.77614237,14 6,13.7761424 6,13.5 L6,9.5 C6,9.22385763 6.22385763,9 6.5,9 L9.5,9 C9.77614237,9 10,9.22385763 10,9.5 L10,13.5 C10,13.7761424 10.2238576,14 10.5,14 L13.5,14 C13.7761424,14 14,13.7761424 14,13.5 L14,8.5 C14,8.22385763 14.2238576,8 14.5,8 L15,8 C15.2287638,8 15.4142136,7.81455027 15.4142136,7.58578644 C15.4142136,7.47593017 15.3705733,7.37057333 15.2928932,7.29289322 L13.1464466,5.14644661 C13.0526784,5.05267842 13,4.92550146 13,4.79289322 L13,1.5 C13,1.22385763 12.7761424,1 12.5,1 Z" id="Path"></path>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <?php print TEXT_MENU_HOME; ?>
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
                FILENAME_XSELL_PRODUCTS,
                FILENAME_SPECIALS,
                FILENAME_PROM,
                FILENAME_YML,
                FILENAME_PRODUCTS_MULTI,
                FILENAME_MANUFACTURERS,
                FILENAME_QUICK_UPDATES,
                FILENAME_FEATURED,
            );

            $isActive = in_array(basename($PHP_SELF),$filenames);
            if (new_tep_admin_check_boxes_parent($filenames)) { ?>
                <li class="item-menu <?=$isActive ?'active':''?>" data-title="<?php print TEXT_MENU_PRODUCTS; ?>">
                    <a href="<?php echo tep_href_link(FILENAME_CATEGORIES); ?>" class="auto">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16" version="1.1">
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="newmade-admin-detailed" transform="translate(-20.000000, -149.000000)">
                                    <g id="Container">
                                        <g id="Sidebar" transform="translate(0.000000, 50.000000)">
                                            <g id="List" transform="translate(0.000000, 38.000000)">
                                                <g id="Item" transform="translate(0.000000, 46.000000)">
                                                    <g id="Parent">
                                                        <g id="Icon" transform="translate(20.000000, 15.000000)">
                                                            <rect id="Rectangle" fill="#0A0C12" opacity="0" x="0" y="0" width="16" height="16"></rect>
                                                            <g id="cart" fill="#FFFFFF" fill-rule="nonzero">
                                                                <path d="M14.0453549,13.0237755 C14.5966139,13.0370842 15.033002,13.4943698 15.0200551,14.0451515 C15.0071081,14.5959332 14.5497288,15.0316412 13.9984698,15.0183326 C13.4472108,15.0050238 13.0108227,14.5477382 13.0237696,13.9969565 C13.0367167,13.4461748 13.494096,13.0104668 14.0453549,13.0237755 Z M4.99851135,13.0184136 C5.54983475,13.0081071 6.0048987,13.446298 6.01492515,13.9971405 C6.02495155,14.547983 5.58614365,15.0028842 5.035084,15.013186 C4.48349685,15.0234974 4.02843291,14.5853065 4.01840645,14.034464 C4.00838006,13.4836215 4.44718796,13.0287203 4.99851135,13.0184136 Z M0.665220697,5.64815495e-05 C1.75079558,0.00818144625 2.34255632,-0.0040060008 2.65680168,0.37786734 C2.90166819,0.682553516 2.9996148,0.84505281 3.15469692,1.13348906 C3.19006653,1.20390542 3.78454801,4.05691241 4.93814137,9.69251003 C5.06873684,10.3465697 5.26463005,10.626881 5.40746885,10.7487554 C5.54622654,10.8625049 5.66457869,10.8625049 5.74620086,10.8625049 L5.74620086,10.8625049 L14.4279191,10.8625049 C14.7544078,10.8625049 15.0155987,11.1306288 14.9992743,11.4556274 C14.987031,11.764376 14.7217589,12 14.4115947,12 L14.4115947,12 L5.75436308,12 C5.20749453,12 4.75449148,11.780626 4.41167836,11.3418779 C4.11783854,10.9681295 3.91786422,10.4806316 3.81991762,9.89157166 L3.81991762,9.89157166 L2.18747419,2.29535901 C2.18747419,2.29129653 2.11401424,1.92567312 2.10585202,1.87692333 C2.10177091,1.87286084 2.10177091,1.86879836 2.10177091,1.86473588 C2.04463539,1.59254956 1.88955327,1.27973842 1.69774116,1.22286367 C1.50592906,1.16598892 0.991709382,1.1456765 0.636652937,1.1456765 C0.281596491,1.1456765 0,0.926302457 0,0.572866493 C0,0.211305564 0.297920925,-0.0040060008 0.665220697,5.64815495e-05 Z" id="Combined-Shape" opacity="0.5"></path>
                                                                <path d="M15.9938678,2.77477514 C15.9652511,2.67727597 15.8794009,2.61227653 15.7812864,2.6041516 L4.46671276,1.32447507 C4.35224583,1.31228767 4.21325027,1.2391633 4.16010491,1.1335392 C4.06228992,0.951925835 4.64812757,3.61524074 5.91761787,9.1234839 C6.04165498,9.66165773 6.57848085,9.99738534 7.11665548,9.87335169 C7.12539209,9.87133816 7.13410122,9.86920722 7.14278052,9.86695946 L15.139454,7.7959821 L15.139454,7.7959821 C15.2457447,7.77973224 15.3275068,7.69442047 15.3397711,7.58473391 L15.9938678,2.88039923 C16.0020441,2.84789951 16.0020441,2.81133732 15.9938678,2.77477514 Z" id="Path"></path>
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
                        <?php print TEXT_MENU_PRODUCTS; ?>
                    </a>
                    <span class="down">
                        <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                            <path d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path>
                        </svg>
                    </span>
                    <ul class="nav dk sub_menu">

                        <?php

                        if (new_tep_admin_check_boxes(FILENAME_CATEGORIES) == true) {
                            ?>
                            <li<?php print tep_is_active_menu(FILENAME_CATEGORIES)?' class="active"':''; ?>>
                                <a href="<?php print tep_href_link(FILENAME_CATEGORIES); ?>">
                                    <?php print TEXT_MENU_CATALOGUE; ?>
                                </a>
                            </li>
                            <?php
                        }

                        if (getConstantValue('PRODUCTS_MULTI_ENABLED') == 'true') {
                            echo printMenuItem(FILENAME_PRODUCTS_MULTI, BOX_CATALOG_CATEGORIES_PRODUCTS_MULTI, $menu_location, $PHP_SELF);
                        } elseif (!file_exists(DIR_FS_EXT . 'products_multi')) {
                            echo printMenuItemNotExist(BOX_CATALOG_CATEGORIES_PRODUCTS_MULTI, LINK_TO_SHOP, TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY);
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
                            echo printMenuItemNotExist(BOX_CATALOG_XSELL_PRODUCTS, LINK_TO_SHOP, TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY);
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
            <?php }

            /*
             * Заказы
             */
            $filenames = array(
                FILENAME_ORDERS,
                FILENAME_ORDERS_STATUS,
                FILENAME_CREATE_ORDER,
                FILENAME_QUICK_ORDERS
            );
            $isActive = in_array(basename($PHP_SELF),$filenames);

            if (new_tep_admin_check_boxes_parent($filenames)) { ?>
                <li class="item-menu <?=$isActive ?'active':''?>" data-title="<?php print TEXT_MENU_ORDERS; ?>">
                    <a href="<?php echo tep_href_link(FILENAME_ORDERS); ?>" class="auto">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16" version="1.1">
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="newmade-admin-detailed" transform="translate(-20.000000, -680.000000)">
                                    <g id="Container">
                                        <g id="Sidebar" transform="translate(0.000000, 50.000000)">
                                            <g id="List" transform="translate(0.000000, 38.000000)">
                                                <g id="Item" transform="translate(0.000000, 577.000000)">
                                                    <g id="Icon" transform="translate(20.000000, 15.000000)">
                                                        <rect id="Rectangle" fill="#1D202D" opacity="0" x="0" y="0" width="16" height="16"></rect>
                                                        <path d="M8.41055718,15.9896657 L7.94134897,15.9896657 C7.84750686,15.9896657 7.70674581,15.9927277 7.51906158,15.9988517 C7.33137736,16.0049758 7.17888622,15.9866039 7.06158358,15.9437357 C6.94428094,15.9008675 6.87261892,14.7426763 6.87261892,14.4593553 C6.87261892,14.1760343 6.58064727,14.1760343 6.15835777,13.9800652 C5.03225243,13.4901426 4.32844716,12.6511626 4.04692082,11.4631001 C4.01564012,11.3651156 4,11.2487607 4,11.114032 C4,10.942559 4.06256047,10.8200802 4.18768328,10.7465918 C4.3128061,10.6731034 4.53176774,10.611864 4.84457478,10.5628717 L5.1026393,10.5261277 L5.66568915,10.5077557 C5.91593478,10.5077557 6.09579613,10.5261275 6.20527859,10.5628717 C6.31476106,10.5996159 6.4007817,10.6669793 6.46334311,10.7649638 C6.52590452,10.8629484 6.61192516,11.0466666 6.72140762,11.3161241 C6.83089009,11.5978296 6.99511132,11.8305394 7.21407625,12.0142604 C7.43304117,12.1979814 7.69892317,12.2898405 8.01173021,12.2898405 C8.10557232,12.2898405 8.17595284,12.2837165 8.2228739,12.2714685 C8.53568094,12.2469723 8.79374287,12.1244935 8.99706745,11.9040283 C9.20039202,11.6835631 9.30205279,11.4324815 9.30205279,11.150776 C9.30205279,11.0282953 9.27859261,10.9119404 9.23167155,10.8017078 C9.02834698,10.1893045 8.62170393,9.69326525 8.01173021,9.31357519 C6.94818628,8.67667573 6.04105947,7.98773232 5.29032258,7.24672429 C4.53958569,6.50571626 4.16422287,5.65142643 4.16422287,4.68382917 C4.16422287,4.45111591 4.20332317,4.18166249 4.28152493,3.87546082 C4.46920915,3.10383263 5.07917372,2.44244696 6.11143695,1.89128396 C6.56500716,1.6585707 6.87051882,1.72977282 6.91743988,1.49705955 C6.96436093,1.32558662 6.94819026,0.0347836369 7.21407625,0.0102875037 C7.2297166,0.0102875037 7.39002897,0.00722553301 7.46041056,0.00110149973 C7.53079214,-0.00502253355 8.51807047,0.0166782066 8.72136994,0.0102875037 C9.20840907,-0.00502253355 8.99706745,1.24767592 9.05870056,1.51647754 C9.05870056,1.70100299 9.40655518,1.68155569 9.65395894,1.78105191 L10.1466276,1.983144 C10.8973645,2.350586 11.4291284,2.91398861 11.7419355,3.67336874 C11.7888565,3.82034553 11.8123167,3.94282436 11.8123167,4.04080889 C11.8123167,4.40825089 11.6559155,4.62258884 11.3431085,4.68382917 C10.8582576,4.76956564 10.3655939,4.84305294 9.86510264,4.90429327 C9.70869912,4.91654134 9.58357818,4.89816951 9.48973607,4.84917725 C9.39589396,4.80018498 9.3216034,4.7144498 9.26686217,4.59196913 C9.21212094,4.46948847 9.16911062,4.37762935 9.13782991,4.31638901 C9.10654921,4.21840448 9.0518088,4.10817354 8.97360704,3.98569287 C8.89540528,3.85096414 8.76246428,3.74073319 8.57478006,3.65499673 C8.38709584,3.56926026 8.19159437,3.52639267 7.98826979,3.52639267 C7.70674346,3.52639267 7.4721417,3.62131376 7.28445748,3.81115879 C7.09677326,4.00100383 7.00293255,4.29189104 7.00293255,4.68382917 C7.00293255,5.1125115 7.17106381,5.53506346 7.50733138,5.95149773 C7.84359894,6.36793199 8.28543226,6.74149242 8.83284457,7.07219021 C9.4115376,7.42738414 9.97458182,7.84381216 10.5219941,8.32148676 C11.5073363,9.19109948 12,10.1403104 12,11.169148 C12,11.5488381 11.9452596,11.9101506 11.8357771,12.2530965 C11.6011718,13.0002285 11.0381276,13.5636311 10.1466276,13.9433212 L9.65395894,14.1454133 C9.37243261,14.2433978 9.05870056,14.2555751 9.05870056,14.5143712 C9.05870056,14.7731673 9.00879801,15.8610615 8.93841642,15.8978057 C8.86803484,15.9345499 8.69208352,15.9651696 8.41055718,15.9896657 Z" id="$" fill="#FFFFFF" fill-rule="nonzero"></path>
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
                            echo $orders_awaiting;
                            ?>
                        </b>
                    </a>
                    <span class="down">
                        <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                            <path d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path>
                        </svg>
                    </span>
                    <ul class="nav dk sub_menu">
                        <?php

                        if (new_tep_admin_check_boxes(FILENAME_ORDERS) == true) {
                            ?>
                            <li<?=strstr(basename($PHP_SELF),FILENAME_ORDERS) && $menu_location != '0' && !isset($_GET['action'])? ' class="active"' : ''?>>
                                <a href="<?php print tep_href_link(FILENAME_ORDERS); ?>">
                                    <?php print TEXT_MENU_ORDERS_LIST; ?>
                                </a>
                            </li>
                            <?php
                        }
                        echo printMenuItem(FILENAME_QUICK_ORDERS, TEXT_QUICK_ORDER, $menu_location, $PHP_SELF, '');

                        if (new_tep_admin_check_boxes(FILENAME_ORDERS_STATUS) == true) {
                            ?>
                            <li<?=strstr(basename($PHP_SELF),FILENAME_ORDERS_STATUS) && $menu_location != '0' ? ' class="active"' : ''?>>
                                <a href="<?php print tep_href_link(FILENAME_ORDERS_STATUS); ?>">
                                    <?php print BOX_LOCALIZATION_ORDERS_STATUS; ?>
                                </a>
                            </li>
                            <?php
                        }

                        if (true) {
                            ?>
                            <li<?=strstr(basename($PHP_SELF),FILENAME_ORDERS) && $menu_location != '0' && isset($_GET['action']) && $_GET['action'] == 'create_order_form_user_selection'? ' class="active"' : ''?>>
                                <a href="<?php print tep_href_link(FILENAME_ORDERS,'page=1&perPage=25&action=create_order_form_user_selection'); ?>">
                                    <?php print BOX_MANUAL_ORDER_CREATE_ORDER; ?>
                                </a>
                            </li>
                            <?php
                        }


                        ?>
                    </ul>
                </li>
            <?php }

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
                );

            if (new_tep_admin_check_boxes_parent($filenames)) { ?>
                <li class="item-menu <?=$isActive ?'active':''?>" data-title="<?php print BOX_HEADING_CUSTOMERS; ?>">
                    <a href="<?php echo tep_href_link(FILENAME_CUSTOMERS); ?>" class="auto">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16" version="1.1">
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="newmade-admin-detailed" transform="translate(-20.000000, -725.000000)">
                                    <g id="Container">
                                        <g id="Sidebar" transform="translate(0.000000, 50.000000)">
                                            <g id="List" transform="translate(0.000000, 38.000000)">
                                                <g id="Item" transform="translate(0.000000, 623.000000)">
                                                    <g id="Icon" transform="translate(20.000000, 14.000000)">
                                                        <rect id="Rectangle" fill="#1D202D" opacity="0" x="0" y="0" width="16" height="16"></rect>
                                                        <g id="users-solid" transform="translate(0.000000, 3.000000)" fill-rule="nonzero">
                                                            <path d="M8.05298013,5.61589404 C9.55189215,5.61589404 10.807947,4.35983917 10.807947,2.86092715 C10.807947,1.25605487 9.55189215,0 8.05298013,0 C6.44810785,0 5.19205298,1.25605487 5.19205298,2.86092715 C5.19205298,4.35983917 6.44810785,5.61589404 8.05298013,5.61589404 Z M9.9602649,6.46357616 L9.74834437,6.46357616 C9.1977649,6.71192053 8.61771523,6.86092715 8.05298013,6.88741722 C7.38228477,6.86092715 6.80474614,6.71192053 6.25165563,6.46357616 L6.0397351,6.46357616 C4.47450331,6.46357616 3.17880795,7.21523179 3.17880795,8.79470199 L3.17880795,10.5960265 C3.17880795,11.227649 3.18887969,11.2317881 3.81456954,11.2317881 L12.1854305,11.2317881 C12.8111203,11.2317881 12.8211921,11.227649 12.8211921,10.5960265 L12.8211921,8.79470199 C12.8211921,7.21523179 11.5254967,6.46357616 9.9602649,6.46357616 Z" id="Shape" fill="#FFFFFF"></path>
                                                            <path d="M14.7284768,5.61589404 C15.5975836,5.61589404 16,6.01076159 16,6.88741722 L16,6.88741722 L16,8.1589404 C16,8.65149007 15.8530268,8.79470199 15.3642384,8.79470199 L15.3642384,8.79470199 L13.5629139,8.79470199 C13.5629139,7.58931445 13.1122373,6.60037817 11.6556291,6.0397351 C11.9467597,5.79221854 12.3458094,5.61589404 12.8211921,5.61589404 L12.8211921,5.61589404 Z M3.17880795,5.61589404 C3.65419063,5.61589404 4.05324029,5.79221854 4.34437086,6.0397351 C2.61515565,6.60037817 2.61515565,7.61754967 2.43708609,8.79470199 L2.43708609,8.79470199 L0.635761589,8.79470199 C0.146973192,8.79470199 -2.94875235e-13,8.65149007 -2.94875235e-13,8.1589404 L-2.94875235e-13,8.1589404 L-2.94875235e-13,6.78145695 C-2.94875235e-13,5.90480132 0.402416396,5.61589404 1.27152318,5.61589404 L1.27152318,5.61589404 Z M2.43708609,1.58940397 C3.31374172,1.58940397 4.02649007,2.30215232 4.02649007,3.17880795 C4.02649007,4.05546358 3.31374172,4.76821192 2.43708609,4.76821192 C1.56043046,4.76821192 0.847682119,4.05546358 0.847682119,3.17880795 C0.847682119,2.30215232 1.56043046,1.58940397 2.43708609,1.58940397 Z M13.5629139,1.58940397 C14.4395695,1.58940397 15.1523179,2.30215232 15.1523179,3.17880795 C15.1523179,4.05546358 14.4395695,4.76821192 13.5629139,4.76821192 C12.6862583,4.76821192 11.9735099,4.05546358 11.9735099,3.17880795 C11.9735099,2.30215232 12.6862583,1.58940397 13.5629139,1.58940397 Z" id="Combined-Shape" fill="#9699A1"></path>
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
                    <ul class="nav dk sub_menu">
                        <!--                  <li class="nav-sub-header">-->
                        <!--                    <a href>-->
                        <!--                      <span>--><?php //print BOX_HEADING_CUSTOMERS; ?><!--</span>-->
                        <!--                    </a>-->
                        <!--                    </a>-->
                        <!--                  </li>-->
                        <?php

                        if (new_tep_admin_check_boxes(FILENAME_CUSTOMERS) == true) {
                            ?>
                            <li<?=strstr(basename($PHP_SELF),FILENAME_CUSTOMERS) && $menu_location != '0' ? ' class="active"' : ''?>>
                                <a href="<?php print tep_href_link(FILENAME_CUSTOMERS); ?>">
                                    <?php print TEXT_MENU_CLIENTS_LIST; ?>
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
                                <a href="<?php print tep_href_link(FILENAME_CREATE_ACCOUNT); ?>">
                                    <?php print TEXT_MENU_ADD_CLIENT; ?>
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
            );
            $isActive = in_array(basename($PHP_SELF),$filenames);
            if (new_tep_admin_check_boxes_parent($filenames)) { ?>
                <li class="item-menu <?=$isActive ?'active':''?>" data-title="<?php print BOX_HEADING_INFORMATION; ?>">
                    <a href="<?php echo tep_href_link(FILENAME_ARTICLES); ?>" class="auto">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16" version="1.1">
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="newmade-admin-detailed" transform="translate(-20.000000, -772.000000)">
                                    <g id="Container">
                                        <g id="Sidebar" transform="translate(0.000000, 50.000000)">
                                            <g id="List" transform="translate(0.000000, 38.000000)">
                                                <g id="Item" transform="translate(0.000000, 669.000000)">
                                                    <g id="Icon" transform="translate(20.000000, 15.000000)">
                                                        <rect id="Rectangle" fill="#1D202D" opacity="0" x="0" y="0" width="16" height="16"></rect>
                                                        <g id="Edit---Icon" transform="translate(1.000000, 1.000000)" fill-rule="nonzero">
                                                            <path d="M13.6281223,3.75526945 L12.1324467,5.25 L8.75,1.86670184 L10.2443544,0.371971289 C10.4822585,0.133812558 10.8050427,-5.68434189e-14 11.1416276,-5.68434189e-14 C11.4782126,-5.68434189e-14 11.8009967,0.133812558 12.0389009,0.371971289 L13.6281223,1.96027118 C13.8662211,2.19823524 14,2.52110063 14,2.85777031 C14,3.19444 13.8662211,3.51730539 13.6281223,3.75526945 L13.6281223,3.75526945 Z" id="Path" fill="#FFFFFF"></path>
                                                            <path d="M0.116401563,12.2649933 L0.00400659243,13.2759173 L0.00400659243,13.2759173 C-0.0178997456,13.4727141 0.0508142944,13.6688019 0.190766771,13.8088708 C0.330719248,13.9489396 0.526740122,14.0178069 0.723538435,13.9960474 L1.72939424,13.8850017 C3.08511257,13.7353315 4.349377,13.1282121 5.31380202,12.1637134 L11.375,6.10205224 L11.375,6.10205224 L7.89821344,2.625 L1.83731381,8.68505423 C0.873862018,9.64837165 0.26694969,10.910905 0.116401563,12.2649933 Z" id="Path" fill="#9699A1"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                       <?php print BOX_HEADING_INFORMATION; ?>
                    </a>
                    <span class="down">
                        <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                            <path d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path>
                        </svg>
                    </span>
                    <ul class="nav dk sub_menu">
                        <!--                  <li class="nav-sub-header">-->
                        <!--                    <a href>-->
                        <!--                      <span>--><?php //print BOX_HEADING_INFORMATION; ?><!--</span>-->
                        <!--                    </a>-->
                        <!--                  </li>-->
                        <?php

                        if (new_tep_admin_check_boxes(FILENAME_ARTICLES) == true) {
                            ?>
                            <li<?=strstr(basename($PHP_SELF),FILENAME_ARTICLES) && $menu_location != '0' ? ' class="active"' : ''?>>
                                <a href="<?php print tep_href_link(FILENAME_ARTICLES); ?>">
                                    <?php print TEXT_MENU_PAGES; ?>
                                </a>
                            </li>
                            <?php
                        }

                        if (getConstantValue('EMAIL_CONTENT_MODULE_ENABLED') == 'true') {
                            echo printMenuItem(FILENAME_EMAIL_CONTENT, TEXT_MENU_EMAIL_CONTENT, $menu_location, $PHP_SELF, renderLeftMenuTooltip(TOOLTIP_EMAIL_TEMPLATE));
                        } elseif (!file_exists(DIR_FS_EXT . 'email_content')) {
                            echo printMenuItemNotExist(TEXT_MENU_EMAIL_CONTENT, LINK_TO_SHOP, TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY);
                        } else {
                            echo printMenuItemNotExist(TEXT_MENU_EMAIL_CONTENT, tep_href_link(FILENAME_CONFIGURATION, 'gID=277'), TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON);
                        }

                        if (new_tep_admin_check_boxes('image_explorer.php') == true) {
                            ?>
                            <li<?=strstr(basename($PHP_SELF),'image_explorer.php') && $menu_location != '0' ? ' class="active"' : ''?>>
                                <a href="<?php print tep_href_link('image_explorer.php'); ?>">
                                    <?php print TEXT_MENU_CKFINDER . " " . renderLeftMenuTooltip(TOOLTIP_FILE_MANAGER); ?>
                                </a>
                            </li>
                            <?php
                        }
                        if (getConstantValue('COMMENTS_MODULE_ENABLED') == 'true') {
                            echo printMenuItem(FILENAME_REVIEWS, TEXT_MENU_REVIEWS, $menu_location, $PHP_SELF);
                        } elseif (!file_exists(DIR_FS_EXT . 'reviews')) {
                            echo printMenuItemNotExist(TEXT_MENU_REVIEWS, LINK_TO_SHOP, TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY);
                        } else {
                            echo printMenuItemNotExist(TEXT_MENU_REVIEWS, tep_href_link(FILENAME_CONFIGURATION, 'gID=277'), TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON);
                        }

                        ?>
                    </ul>
                </li>
                <?php
            }

            /*
             * Модули
             */
            $filenames = [
                FILENAME_POLLS,
                FILENAME_CURRENCIES,
                FILENAME_COUPON_ADMIN,
                FILENAME_LANGUAGES,
                FILENAME_MODULES,
                FILENAME_SHIP2PAY,
                FILENAME_AUTO_TRANSLATE,
                FILENAME_LANGUAGES_TRANSLATER,
            ];
            $isActive =
                (
                    in_array(basename($PHP_SELF),$filenames) ||
                    (
                        basename($PHP_SELF) === FILENAME_CONFIGURATION &&
                        $_GET['gID'] == SOLO_MODULES_CONFIGURATION_GROUP_ID
                    )
                );

            if (new_tep_admin_check_boxes_parent($filenames)) { ?>
                <li class="item-menu <?php print $isActive?'active':''; ?>" data-title="<?php print BOX_HEADING_MODULES; ?>">
                    <a href="<?php echo tep_href_link(FILENAME_MODULES, 'set=payment', 'NONSSL'); ?>" class="auto">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16" version="1.1">
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="newmade-admin-detailed" transform="translate(-20.000000, -818.000000)">
                                    <g id="Container">
                                        <g id="Sidebar" transform="translate(0.000000, 50.000000)">
                                            <g id="List" transform="translate(0.000000, 38.000000)">
                                                <g id="Item" transform="translate(0.000000, 715.000000)">
                                                    <g id="Icon" transform="translate(20.000000, 15.000000)">
                                                        <rect id="Rectangle" fill="#1D202D" opacity="0" x="0" y="0" width="16" height="16"></rect>
                                                        <g id="sidebar-icon" fill="#FFFFFF">
                                                            <path d="M13.9999245,11.000136 L15.1055728,11.5527864 C15.2023365,11.6011683 15.2807978,11.6796295 15.3291796,11.7763932 C15.4526742,12.0233825 15.3525621,12.323719 15.1055728,12.4472136 L15.1055728,12.4472136 L9.78885438,15.1055728 C8.66274442,15.6686278 7.33725558,15.6686278 6.21114562,15.1055728 L6.21114562,15.1055728 L0.894427191,12.4472136 C0.79766349,12.3988317 0.719202244,12.3203705 0.670820393,12.2236068 C0.547325769,11.9766175 0.647437942,11.676281 0.894427191,11.5527864 L0.894427191,11.5527864 L1.99892446,11.000136 L6.21114562,13.1055728 C7.33725558,13.6686278 8.66274442,13.6686278 9.78885438,13.1055728 L13.9999245,11.000136 Z" id="Combined-Shape" opacity="0.3"></path>
                                                            <path d="M13.9999245,7.00013595 L15.1055728,7.5527864 C15.2023365,7.60116826 15.2807978,7.6796295 15.3291796,7.7763932 C15.4526742,8.02338245 15.3525621,8.32371897 15.1055728,8.4472136 L15.1055728,8.4472136 L9.78885438,11.1055728 C8.66274442,11.6686278 7.33725558,11.6686278 6.21114562,11.1055728 L6.21114562,11.1055728 L0.894427191,8.4472136 C0.79766349,8.39883174 0.719202244,8.3203705 0.670820393,8.2236068 C0.547325769,7.97661755 0.647437942,7.67628103 0.894427191,7.5527864 L0.894427191,7.5527864 L1.99892446,7.00013595 L6.21114562,9.10557281 C7.33725558,9.66862779 8.66274442,9.66862779 9.78885438,9.10557281 L13.9999245,7.00013595 Z" id="Combined-Shape" opacity="0.7"></path>
                                                            <path d="M15.1055728,3.5527864 L9.78885438,0.894427191 C8.66274442,0.33137221 7.33725558,0.33137221 6.21114562,0.894427191 L0.894427191,3.5527864 C0.647437942,3.67628103 0.547325769,3.97661755 0.670820393,4.2236068 C0.719202244,4.3203705 0.79766349,4.39883174 0.894427191,4.4472136 L6.21114562,7.10557281 C7.33725558,7.66862779 8.66274442,7.66862779 9.78885438,7.10557281 L15.1055728,4.4472136 C15.3525621,4.32371897 15.4526742,4.02338245 15.3291796,3.7763932 C15.2807978,3.6796295 15.2023365,3.60116826 15.1055728,3.5527864 Z" id="Path"></path>
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
                    <ul class="nav dk sub_menu">
                        <?php

                        if (new_tep_admin_check_boxes(FILENAME_MODULES) == true) {
                            ?>
                            <li<?=strstr(basename($PHP_SELF),FILENAME_MODULES) && $menu_location != '0' && isset($_GET['set']) && $_GET['set'] == 'payment' ? ' class="active"' : ''?>>
                                <a href="<?php print tep_href_link(FILENAME_MODULES, 'set=payment', 'NONSSL'); ?>">
                                    <?php print BOX_MODULES_PAYMENT . " " . renderLeftMenuTooltip(TOOLTIP_MODULES_PAYMENT); ?>
                                </a>
                            </li>
                            <li<?=strstr(basename($PHP_SELF),FILENAME_MODULES) && $menu_location != '0' && isset($_GET['set']) && $_GET['set'] == 'shipping' ? ' class="active"' : ''?>>
                                <a href="<?php print tep_href_link(FILENAME_MODULES, 'set=shipping', 'NONSSL'); ?>">
                                    <?php print BOX_MODULES_SHIPPING . " " . renderLeftMenuTooltip(TOOLTIP_MODULES_SHIPPING); ?>
                                </a>
                            </li>
                            <li<?=strstr(basename($PHP_SELF),FILENAME_MODULES) && $menu_location != '0' && isset($_GET['set']) && $_GET['set'] == 'ordertotal' ? ' class="active"' : ''?>>
                                <a href="<?php print tep_href_link(FILENAME_MODULES, 'set=ordertotal', 'NONSSL'); ?>">
                                    <?php print BOX_MODULES_ORDER_TOTAL . " " . renderLeftMenuTooltip(TOOLTIP_MODULES_TOTALS); ?>
                                </a>
                            </li>
                            <?php
                        }

                        if (new_tep_admin_check_boxes(FILENAME_SHIP2PAY) == true) {
                            ?>
                            <li<?=strstr(basename($PHP_SELF),FILENAME_SHIP2PAY) && $menu_location != '0' ? ' class="active"' : ''?>>
                                <a href="<?php print tep_href_link(FILENAME_SHIP2PAY); ?>">
                                    <?php print BOX_MODULES_SHIP2PAY . " " . renderLeftMenuTooltip(TOOLTIP_MODULES_ZONE); ?>
                                </a>
                            </li>
                            <?php
                        }
                        } ?>

                        <li<?=in_array(basename($PHP_SELF), [FILENAME_LANGUAGES, FILENAME_LANGUAGES_TRANSLATER, FILENAME_AUTO_TRANSLATE]) && $menu_location != '0' ? ' class="active"' : ''?>>
                            <?php if (getConstantValue('LANGUAGE_SELECTOR_MODULE_ENABLED') == 'true') { ?>
                                <a href="<?php print tep_href_link(FILENAME_LANGUAGES); ?>">
                                    <?php print BOX_LOCALIZATION_LANGUAGES . " " . renderLeftMenuTooltip(TOOLTIP_MODULES_LANGUAGES); ?>
                                </a>
                                <?php
                            } elseif (!file_exists(DIR_FS_EXT . 'multilanguage')) {
                                echo printMenuItemNotExist(BOX_LOCALIZATION_LANGUAGES, LINK_TO_SHOP, TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY);
                            } else {
                                echo printMenuItemNotExist(BOX_LOCALIZATION_LANGUAGES, tep_href_link(FILENAME_CONFIGURATION, 'gID=277'), TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON);
                            } ?>
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
                            echo printMenuItemNotExist(BOX_COUPONS, LINK_TO_SHOP, TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY);
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

                        if (new_tep_admin_check_boxes(FILENAME_CONFIGURATION) == true) {
                            ?>
                            <li<?= isset($_GET['gID']) && $_GET['gID'] == 277 && $menu_location != '0' ? ' class="active"' : '' ?>>
                                <a href="<?= tep_href_link(FILENAME_CONFIGURATION, 'gID=' . 277, 'NONSSL'); ?>">
                                    <?= TEXT_MENU_SITE_MODULES . " " . renderLeftMenuTooltip(TOOLTIP_MODULES_SOLOMONO) ?>
                                </a>
                            </li>
                            <?php
                        } ?>
                    </ul>
                </li>
                <?php

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
                    );
                if (new_tep_admin_check_boxes_parent($filenames)) { ?>
                    <li class="item-menu <?=$isActive ?'active':''?>" data-title="<?= BOX_HEADING_SEO; ?>">
                        <a href="<?= tep_href_link(FILENAME_CONFIGURATION, 'gID=' . 125, 'NONSSL'); ?>" class="auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16" version="1.1">
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="newmade-admin-detailed" transform="translate(-20.000000, -772.000000)">
                                        <g id="Container">
                                            <g id="Sidebar" transform="translate(0.000000, 50.000000)">
                                                <g id="List" transform="translate(0.000000, 38.000000)">
                                                    <g id="Item" transform="translate(0.000000, 669.000000)">
                                                        <g id="Icon" transform="translate(20.000000, 15.000000)">
                                                            <rect id="Rectangle" fill="#1D202D" opacity="0" x="0" y="0" width="16" height="16"></rect>
                                                            <g id="Edit---Icon" transform="translate(1.000000, 1.000000)" fill-rule="nonzero">
                                                                <path d="M13.6281223,3.75526945 L12.1324467,5.25 L8.75,1.86670184 L10.2443544,0.371971289 C10.4822585,0.133812558 10.8050427,-5.68434189e-14 11.1416276,-5.68434189e-14 C11.4782126,-5.68434189e-14 11.8009967,0.133812558 12.0389009,0.371971289 L13.6281223,1.96027118 C13.8662211,2.19823524 14,2.52110063 14,2.85777031 C14,3.19444 13.8662211,3.51730539 13.6281223,3.75526945 L13.6281223,3.75526945 Z" id="Path" fill="#FFFFFF"></path>
                                                                <path d="M0.116401563,12.2649933 L0.00400659243,13.2759173 L0.00400659243,13.2759173 C-0.0178997456,13.4727141 0.0508142944,13.6688019 0.190766771,13.8088708 C0.330719248,13.9489396 0.526740122,14.0178069 0.723538435,13.9960474 L1.72939424,13.8850017 C3.08511257,13.7353315 4.349377,13.1282121 5.31380202,12.1637134 L11.375,6.10205224 L11.375,6.10205224 L7.89821344,2.625 L1.83731381,8.68505423 C0.873862018,9.64837165 0.26694969,10.910905 0.116401563,12.2649933 Z" id="Path" fill="#9699A1"></path>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            <?= BOX_HEADING_SEO; ?>
                        </a>
                        <span class="down">
                            <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                <path d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path>
                            </svg>
                        </span>
                        <ul class="nav dk sub_menu">
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
                            ?>
                            <?php

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
                                echo printMenuItemNotExist(BOX_CATALOG_SEO_TEMPALTES, LINK_TO_SHOP, TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY);
                            } else {
                                echo printMenuItemNotExist(BOX_CATALOG_SEO_TEMPALTES, tep_href_link(FILENAME_CONFIGURATION, 'gID=277'), TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON);
                            }

                            //                          echo '<li ' . $class . '>
                            //                                <a style="color:grey;" href="#">
                            //                                    <span>' . TEXT_SEARCH_PAGES . '</span>
                            //                                </a>
                            //                            </li>';
                            if (new_tep_admin_check_boxes(FILENAME_STATS_KEYWORDS_POPULAR) == true) {
                                ?>
                                <li<?=strstr(basename($PHP_SELF),FILENAME_STATS_KEYWORDS_POPULAR) && $menu_location != '0' ? ' class="active"' : ''?>>
                                    <a href="<?php print tep_href_link(FILENAME_STATS_KEYWORDS_POPULAR); ?>">
                                        <?php print STATS_KEYWORDS_POPULAR_ENABLED_TITLE; ?>
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
                            if (new_tep_admin_check_boxes(FILENAME_CONFIGURATION) == true) {
                                ?>
                                <li<?= isset($_GET['gID']) && $_GET['gID'] == 125 && $menu_location != '0' ? ' class="active"' : '' ?>>
                                    <a href="<?= tep_href_link(FILENAME_CONFIGURATION, 'gID=' . 125, 'NONSSL'); ?>">
                                        <?= TEXT_MENU_SITE_SEO_SETTINGS; ?>
                                    </a>
                                </li>
                                <?php
                            }
                            echo '<li ' . $class . '>
                                <a style="color:grey;" href="#">
                                    ' . 'SEO Assistant' . '
                                </a>
                            </li>';
                            ?>
                        </ul>
                    </li>
                <?php }
                /*
                 * Дизайн
                 */
                $filenames = array(FILENAME_TEMPLATE_CONFIGURATION);
                $isActive = in_array(basename($PHP_SELF),$filenames);
                if (new_tep_admin_check_boxes_parent($filenames) and new_tep_admin_check_boxes(FILENAME_TEMPLATE_CONFIGURATION) == true) {
                    $template_id_select_query = tep_db_query("SELECT template_id FROM " . TABLE_TEMPLATE . "  WHERE template_name = '" . DEFAULT_TEMPLATE . "'");
                    $template_id_select = tep_db_fetch_array($template_id_select_query);
                    ?>
                    <li class="item-menu <?=$isActive ?'active':''?>" data-title="<?php print BOX_HEADING_DESIGN_CONTROLS; ?>">
                        <a href="<?php print tep_href_link(FILENAME_TEMPLATE_CONFIGURATION, 'action=edit_template&id=' . $template_id_select['template_id'], 'NONSSL'); ?>" class="auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16" version="1.1">
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="newmade-admin-detailed" transform="translate(-20.000000, -864.000000)">
                                        <g id="Container">
                                            <g id="Sidebar" transform="translate(0.000000, 50.000000)">
                                                <g id="List" transform="translate(0.000000, 38.000000)">
                                                    <g id="Item" transform="translate(0.000000, 761.000000)">
                                                        <g id="Icon" transform="translate(20.000000, 15.000000)">
                                                            <rect id="Rectangle" fill="#1D202D" opacity="0" x="0" y="0" width="16" height="16"></rect>
                                                            <path d="M6.07599262,1.106953 C11.5371915,0.327835949 15.9844934,3.92399001 16,8.03620646 C15.9968987,9.52993018 15.0975141,10.388367 14.0151985,10.0159932 C12.6919975,9.59732602 11.6995968,9.55048314 11.0379963,9.87546454 C9.38678166,10.6865493 9.58645732,12.2182614 10.0455956,12.9856732 C10.2129252,14.3180353 9.58645732,15.7158952 8.0607941,15.9553533 C4.36692524,16.4728276 -0.865012146,12.4300544 0.121588192,7.04631311 C0.890338511,4.13279896 3.37450084,1.81559969 6.07599262,1.106953 Z M3.5,9 C2.6703125,9 2,9.6703125 2,10.5 C2,11.3296875 2.6703125,12 3.5,12 C4.3296875,12 5,11.3296875 5,10.5 C5,9.6703125 4.3296875,9 3.5,9 Z M4.5,5 C3.6703125,5 3,5.6703125 3,6.5 C3,7.3296875 3.6703125,8 4.5,8 C5.3296875,8 6,7.3296875 6,6.5 C6,5.6703125 5.3296875,5 4.5,5 Z M12.5,4 C11.6703125,4 11,4.6703125 11,5.5 C11,6.3296875 11.6703125,7 12.5,7 C13.3296875,7 14,6.3296875 14,5.5 C14,4.6703125 13.3296875,4 12.5,4 Z M8.5,3 C7.6703125,3 7,3.6703125 7,4.5 C7,5.3296875 7.6703125,6 8.5,6 C9.3296875,6 10,5.3296875 10,4.5 C10,3.6703125 9.3296875,3 8.5,3 Z" id="Combined-Shape" fill="#FFFFFF" fill-rule="nonzero"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            <?php print BOX_HEADING_DESIGN_CONTROLS; ?>
                        </a>
                    </li>
                <?php }

                /*
                 * Настройки
                 */
                $filenames = array(
                    FILENAME_CONFIGURATION,
                    FILENAME_TAX_CLASSES,
                    FILENAME_TAX_RATES,
                    FILENAME_GEO_ZONES,
                );

                $isActive = in_array(basename($PHP_SELF),$filenames);
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
                    <li class="item-menu <?= $isActive?'active':''; ?>" data-title="<?php print BOX_HEADING_CONFIGURATION; ?>">
                        <a href="<?php echo tep_href_link(FILENAME_CONFIGURATION, 'gID=1', 'NONSSL');?>" class="auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16" version="1.1">
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="newmade-admin-detailed" transform="translate(-20.000000, -910.000000)">
                                        <g id="Container">
                                            <g id="Sidebar" transform="translate(0.000000, 50.000000)">
                                                <g id="List" transform="translate(0.000000, 38.000000)">
                                                    <g id="Item" transform="translate(0.000000, 807.000000)">
                                                        <g id="Icon" transform="translate(20.000000, 15.000000)">
                                                            <g id="settings-icon">
                                                                <rect id="Rectangle" fill="#2D3343" x="0" y="0" width="16" height="16"></rect>
                                                                <path d="M15.7947311,9.92258065 L14.3593,9.12903226 C14.5041923,8.38056602 14.5041923,7.61298237 14.3593,6.86451613 L15.7947311,6.07096774 C15.9585118,5.97985788 16.0352633,5.79282522 15.9800567,5.61935484 C15.6090745,4.4841312 14.9795586,3.44187134 14.1369093,2.56774194 C14.0091801,2.43454289 13.8021449,2.4037411 13.6382149,2.49354839 L12.2027839,3.28709677 C11.5998212,2.79039706 10.9049169,2.40634145 10.1540935,2.15483871 L10.1540935,0.570967742 C10.1540346,0.39016083 10.0232413,0.233476573 9.83903995,0.193548387 C8.62733261,-0.064516129 7.37119155,-0.064516129 6.15948421,0.193548387 C5.97461334,0.232827838 5.84298182,0.389677459 5.8427459,0.570967742 L5.8427459,2.15806452 C5.09379193,2.4134545 4.39959962,2.79711659 3.79405553,3.29032258 L2.36030922,2.49677419 C2.19667757,2.40543936 1.98857557,2.43639986 1.86161485,2.57096774 C1.01755891,3.4441047 0.387849544,4.48668503 0.0184674283,5.62258065 C-0.0382019656,5.79610353 0.0389033162,5.98399845 0.203793038,6.07419355 L1.63922412,6.86774194 C1.49433181,7.61620818 1.49433181,8.38379182 1.63922412,9.13225806 L0.203793038,9.92580645 C0.0397125868,10.0166697 -0.0371340194,10.2039343 0.0184674283,10.3774194 C0.389243091,11.5127298 1.01878383,12.555031 1.86161485,13.4290323 C1.98934405,13.5622313 2.19637926,13.5930331 2.36030922,13.5032258 L3.7957403,12.7096774 C4.39856837,13.2065587 5.09351033,13.5906351 5.84443068,13.8419355 L5.84443068,15.4290323 C5.8446666,15.6103225 5.97629812,15.7671722 6.16116899,15.8064516 C7.37287633,16.0645161 8.62901739,16.0645161 9.84072473,15.8064516 C10.0255956,15.7671722 10.1572271,15.6103225 10.157463,15.4290323 L10.157463,13.8419355 C10.9063823,13.5864736 11.6005616,13.2028187 12.2061534,12.7096774 L13.6415845,13.5032258 C13.8052416,13.5944316 14.013253,13.5634846 14.1402789,13.4290323 C14.9844635,12.5559862 15.6141907,11.5133764 15.9834263,10.3774194 C16.0365537,10.2023367 15.9588591,10.0150585 15.7947311,9.92258065 L15.7947311,9.92258065 Z M8,12 C5.790861,12 4,10.209139 4,8 C4,5.790861 5.790861,4 8,4 C10.209139,4 12,5.790861 12,8 C12.0001106,9.06089986 11.5787188,10.0783798 10.8285493,10.8285493 C10.0783798,11.5787188 9.06089986,12.0001106 8,12 L8,12 Z" id="Shape" fill="#9699A1" fill-rule="nonzero"></path>
                                                                <path d="M8,10 C6.8954305,10 6,9.1045695 6,8 C6,6.8954305 6.8954305,6 8,6 C9.1045695,6 10,6.8954305 10,8 C10,9.1045695 9.1045695,10 8,10 L8,10 Z" id="Path" fill="#FFFFFF" fill-rule="nonzero"></path>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            <?php print BOX_HEADING_CONFIGURATION; ?>
                        </a>
                        <span class="down">
                            <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                <path d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path>
                            </svg>
                        </span>
                        <ul class="nav dk sub_menu">
                            <?php

                            define('UNCOMPLETED_ORDERS_CONFIGURATION_GROUP_ID', 6501);
                            define('XML_EXPORT_CONFIGURATION_GROUP_ID', 26230);

                            $settings_configuration = '';
                            $query = tep_db_query("SELECT configuration_group_id AS cgID, configuration_group_key AS cgKey, configuration_group_title AS cgTitle FROM " . TABLE_CONFIGURATION_GROUP . " WHERE visible = '1' ORDER BY sort_order");
                            while ($setting_configuration = tep_db_fetch_array($query)) {
                                if ($setting_configuration['cgID'] == 902 && SMSINFORM_MODULE_ENABLED != 'true') {

                                    if (!file_exists(DIR_FS_EXT . 'sms')) {
                                        $settings_configuration .= printMenuItemNotExist(constant(strtoupper($setting_configuration['cgKey'])), LINK_TO_SHOP, TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY);
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
                                } else if($setting_configuration['cgID'] == SMTP_CONFIGURATION_GROUP_ID){
                                    continue;
                                }

                                $settings_configuration .= '<li'.(isset($_GET['gID']) && $_GET['gID'] == $setting_configuration['cgID'] && $menu_location != '0' ?' class="active"':'').'><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=' . $setting_configuration['cgID'], 'NONSSL') . '">' . constant(strtoupper($setting_configuration['cgKey'])) . '</a></li>';
                            }

                            print $settings_configuration;

                            $isMenuItemActive = strstr(basename($PHP_SELF),FILENAME_TAX_CLASSES) ||
                                strstr(basename($PHP_SELF),FILENAME_TAX_RATES) ||
                                strstr(basename($PHP_SELF),FILENAME_GEO_ZONES);

                            ?>
                            <li<?=$isMenuItemActive ? ' class="active"' : ''?>>
                                <a href="<?php print tep_href_link(FILENAME_TAX_CLASSES); ?>">
                                    <?php print BOX_MENU_TAXES; ?>
                                </a>
                            </li>

                        </ul>
                    </li>
                <?php }

                /*
                 * Инструменты
                 */
                $filenames = array(
                    FILENAME_API,
                    FILENAME_BACKUP,
                    FILENAME_TOTAL_CONFIGURATION,
                    FILENAME_MAIL,
                    FILENAME_NEWSLETTERS,
                    FILENAME_MYSQL_PERFORMANCE,
                    // FILENAME_GOOGLE_SITEMAP,
                    FILENAME_RECOVER_CART_SALES
                );

                $isActive = in_array(basename($PHP_SELF),$filenames);
                if (new_tep_admin_check_boxes_parent($filenames)) { ?>
                    <li class="item-menu <?= $isActive?'active':''; ?>" data-title="<?php print BOX_HEADING_TOOLS; ?>">
                        <a href="<?php echo tep_href_link(FILENAME_MYSQL_PERFORMANCE); ?>" class="auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16" version="1.1">
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="newmade-admin-detailed" transform="translate(-20.000000, -956.000000)">
                                        <g id="Container">
                                            <g id="Sidebar" transform="translate(0.000000, 50.000000)">
                                                <g id="List" transform="translate(0.000000, 38.000000)">
                                                    <g id="Item" transform="translate(0.000000, 853.000000)">
                                                        <g id="sidebar-icon" transform="translate(20.000000, 15.000000)">
                                                            <rect id="Rectangle" fill="#1D202D" opacity="0" x="0" y="0" width="16" height="16"></rect>
                                                            <path d="M2,14 C2,14.3644243 2.09746762,14.7060837 2.26775657,15.0003321 L0.9,15 C0.402943725,15 6.08718376e-17,14.5970563 0,14.1 L0,14.1 L0,13.9 C2.7219507e-16,13.4029437 0.402943725,13 0.9,13 L0.9,13 L2.26790938,12.9994038 C2.09752593,13.2937119 2,13.6354668 2,14 Z M15.1,13 C15.5970563,13 16,13.4029437 16,13.9 L16,13.9 L16,14.1 C16,14.5970563 15.5970563,15 15.1,15 L15.1,15 L9.73224343,15.0003321 C9.90253238,14.7060837 10,14.3644243 10,14 C10,13.6354668 9.90247407,13.2937119 9.73209062,12.9994038 Z" id="Combined-Shape" fill="#9699A1"></path>
                                                            <path d="M15.1,1 C15.5970563,1 16,1.40294373 16,1.9 L16,1.9 L16,2.1 C16,2.59705627 15.5970563,3 15.1,3 L15.1,3 L5.73224343,3.00033215 C5.90253238,2.70608373 6,2.36442426 6,2 C6,1.63546675 5.90247407,1.2937119 5.73209062,0.999403849 Z" id="Combined-Shape" fill="#9699A1"></path>
                                                            <path d="M5,8 C5,8.36442426 5.09746762,8.70608373 5.26775657,9.00033215 L0.9,9 C0.402943725,9 6.08718376e-17,8.59705627 0,8.1 L0,8.1 L0,7.9 C2.7219507e-16,7.40294373 0.402943725,7 0.9,7 L0.9,7 L5.26790938,6.99940385 C5.09752593,7.2937119 5,7.63546675 5,8 Z M15.1,7 C15.5970563,7 16,7.40294373 16,7.9 L16,7.9 L16,8.1 C16,8.59705627 15.5970563,9 15.1,9 L15.1,9 L12.7322434,9.00033215 C12.9025324,8.70608373 13,8.36442426 13,8 C13,7.63546675 12.9024741,7.2937119 12.7320906,6.99940385 Z" id="Combined-Shape" fill="#9699A1"></path>
                                                            <path d="M6,12 C7.1045695,12 8,12.8954305 8,14 C8,15.1045695 7.1045695,16 6,16 C4.8954305,16 4,15.1045695 4,14 C4,12.8954305 4.8954305,12 6,12 Z M9,6 C10.1045695,6 11,6.8954305 11,8 C11,9.1045695 10.1045695,10 9,10 C7.8954305,10 7,9.1045695 7,8 C7,6.8954305 7.8954305,6 9,6 Z M2,0 C3.1045695,-2.02906125e-16 4,0.8954305 4,2 C4,3.1045695 3.1045695,4 2,4 C0.8954305,4 1.3527075e-16,3.1045695 0,2 C-1.3527075e-16,0.8954305 0.8954305,2.02906125e-16 2,0 Z" id="Combined-Shape" fill="#FFFFFF"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            <?php print BOX_HEADING_TOOLS; ?>
                        </a>
                        <span class="down">
                            <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                <path d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path>
                            </svg>
                        </span>
                        <ul class="nav dk sub_menu">
                            <?php

                            if (getConstantValue('API_ENABLED') == 'true') {
                                echo printMenuItem(FILENAME_API, TEXT_MENU_API, $menu_location, $PHP_SELF);
                            } elseif (!file_exists(DIR_FS_EXT . 'api')) {
                                echo printMenuItemNotExist(TEXT_MENU_API, LINK_TO_SHOP, TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY);
                            } else {
                                echo printMenuItemNotExist(TEXT_MENU_API, tep_href_link(FILENAME_CONFIGURATION, 'gID=277'), TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON);
                            }

                            if (getConstantValue('BACKUP_ENABLED') == 'true') {
                                echo printMenuItem(FILENAME_BACKUP, TEXT_MENU_BACKUP, $menu_location, $PHP_SELF);
                            } elseif (!file_exists(DIR_FS_EXT . 'backup')) {
                                echo printMenuItemNotExist(TEXT_MENU_BACKUP, LINK_TO_SHOP, TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY);
                            } else {
                                echo printMenuItemNotExist(TEXT_MENU_BACKUP, tep_href_link(FILENAME_CONFIGURATION, 'gID=277'), TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON);
                            }

                            if (new_tep_admin_check_boxes(FILENAME_TOTAL_CONFIGURATION) && $login_email_address == 'admin@solomono.net') {
                                ?>
                                <li<?=strstr(basename($PHP_SELF),FILENAME_TOTAL_CONFIGURATION) && $menu_location != '0' ? ' class="active"' : ''?>>
                                    <a href="<?php print tep_href_link(FILENAME_TOTAL_CONFIGURATION); ?>">
                                        <?php print TEXT_MENU_TOTAL_CONFIG; ?>
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
                                        <?php print BOX_MENU_TOOLS_EMAILS?>
                                    </a>
                                </li>
                                <?php
                            }


                            if (new_tep_admin_check_boxes(FILENAME_MYSQL_PERFORMANCE)) {
                                ?>
                                <li<?=strstr(basename($PHP_SELF),FILENAME_MYSQL_PERFORMANCE) && $menu_location != '0' ? ' class="active"' : ''?>>
                                    <a href="<?php print tep_href_link(FILENAME_MYSQL_PERFORMANCE); ?>">
                                        <?php print TEXT_MENU_SLOW_QUERIES_LOGS; ?>
                                    </a>
                                </li>
                                <?php
                            }

                            ?>
                            <!--<li>
                              <a id="menu-clear-image-cache" href="<?php //print tep_href_link(FILENAME_CLEAR_IMAGE_CACHE); ?>">
                                <span><?php //print BOX_CLEAR_IMAGE_CACHE . " " . renderLeftMenuTooltip(TOOLTIP_CLEAR_CACHE); ?></span>
                              </a>
                            </li>-->
                        </ul>
                    </li>
                <?php }

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

                $isActive = in_array(basename($PHP_SELF),$filenames);
                if (new_tep_admin_check_boxes_parent($filenames)) { ?>
                    <li class="item-menu <?= $isActive ? 'active':''; ?>" data-title="<?php print BOX_HEADING_REPORTS; ?>">
                        <a href="<?php echo tep_href_link(FILENAME_WHO_IS_ONLINE); ?>" class="auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16" version="1.1">
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="newmade-admin-detailed" transform="translate(-20.000000, -1002.000000)">
                                        <g id="Container">
                                            <g id="Sidebar" transform="translate(0.000000, 50.000000)">
                                                <g id="List" transform="translate(0.000000, 38.000000)">
                                                    <g id="Item" transform="translate(0.000000, 899.000000)">
                                                        <g id="Icon" transform="translate(20.000000, 15.000000)">
                                                            <g id="analytics">
                                                                <rect id="Rectangle-Copy-3" fill="#FFFFFF" x="9" y="8" width="4" height="4" rx="2"></rect>
                                                                <rect id="Rectangle-Copy-5" fill="#FFFFFF" x="12" y="0" width="4" height="4" rx="2"></rect>
                                                                <rect id="Rectangle" fill="#FFFFFF" x="0" y="12" width="4" height="4" rx="2"></rect>
                                                                <rect id="Rectangle-Copy-3" fill="#FFFFFF" x="4" y="4" width="4" height="4" rx="2"></rect>
                                                                <polyline id="Line" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" points="2 14 6 6 11 10 14 2"></polyline>
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
                        <ul class="nav dk sub_menu">
                            <?php

                            if (new_tep_admin_check_boxes(FILENAME_WHO_IS_ONLINE)) {
                                ?>
                                <li<?=strstr(basename($PHP_SELF),FILENAME_WHO_IS_ONLINE) && $menu_location != '0' ? ' class="active"' : ''?>>
                                    <a href="<?php print tep_href_link(FILENAME_WHO_IS_ONLINE); ?>">
                                        <?php print TEXT_MENU_WHO_IS_ONLINE; ?>
                                    </a>
                                </li>
                                <?php
                            }

                            if (new_tep_admin_check_boxes(FILENAME_STATS_MONTHLY_SALES)) {
                                ?>
                                <li<?=strstr(basename($PHP_SELF),FILENAME_STATS_MONTHLY_SALES) && $menu_location != '0' ? ' class="active"' : ''?>>
                                    <a href="<?php print tep_href_link(FILENAME_STATS_MONTHLY_SALES); ?>">
                                        <?php print TEXT_MENU_SALES; ?>
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
                                        <?php print BOX_PRODUCTS_STATS_MENU_ITEM . " " . renderLeftMenuTooltip(TOOLTIP_STATS_VIEWED_PRODUCTS); ?>
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
                                        <?php print TEXT_MENU_CLIENTS . " " . renderLeftMenuTooltip(TOOLTIP_STATS_CLIENTS_ORDERS); ?>
                                    </a>
                                </li>
                                <?php
                            }

                            if (getConstantValue('STATS_KEYWORDS_ENABLED') == 'true') {
                                echo printMenuItem(FILENAME_KEYWORDS, BOX_TOOLS_KEYWORDS, $menu_location, $PHP_SELF);
                            } elseif (!file_exists(DIR_FS_EXT . 'stats_keywords')) {
                                echo printMenuItemNotExist(BOX_TOOLS_KEYWORDS, LINK_TO_SHOP, TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY);
                            } else {
                                echo printMenuItemNotExist(BOX_TOOLS_KEYWORDS, tep_href_link(FILENAME_CONFIGURATION, 'gID=277'), TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON);
                            }

                                if (getConstantValue('FILENAME_STATS_NOPHOTO',false)) {
                                    echo printMenuItem(FILENAME_STATS_NOPHOTO, getConstantValue('TEXT_MENU_NOPHOTO'), $menu_location, $PHP_SELF);
                                }

                            ?>
                        </ul>
                    </li>
                <?php }

                /*
                 * Админы
                 */
                $filenames = array(FILENAME_ADMIN_MEMBERS);
                $isActive = in_array(basename($PHP_SELF),$filenames);

                if (new_tep_admin_check_boxes_parent($filenames) and new_tep_admin_check_boxes(FILENAME_ADMIN_MEMBERS) == true) { ?>
                    <li class="tooltip-menu item-menu <?=strstr(basename($PHP_SELF),FILENAME_ADMIN_MEMBERS)?'active':''?>">
                        <a href="<?php print tep_href_link(FILENAME_ADMIN_MEMBERS); ?>" class="auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16" version="1.1">
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="newmade-admin-detailed" transform="translate(-20.000000, -1049.000000)">
                                        <g id="Container">
                                            <g id="Sidebar" transform="translate(0.000000, 50.000000)">
                                                <g id="List" transform="translate(0.000000, 38.000000)">
                                                    <g id="Item-" transform="translate(0.000000, 945.000000)">
                                                        <g id="Icon" transform="translate(20.000000, 16.000000)">
                                                            <g id="people-outline">
                                                                <g id="Front" transform="translate(2.000000, 1.000000)">
                                                                    <path d="M9,5 C9,6.65685425 7.65685425,8 6,8 C4.34314575,8 3,6.65685425 3,5 L9,5 L9,5 Z M6,2 C6.88854726,2 7.68687122,2.3862919 8.23619452,3.00009834 L3.76380548,3.00009834 C4.31312878,2.3862919 5.11145274,2 6,2 Z" id="Combined-Shape" fill="#FFFFFF"/>
                                                                    <path d="M6,10 C3.29984714,10 0.703079604,11.1560714 6.36646291e-12,13 C-0.00886927601,13.185942 -0.014231454,13.3504779 -0.0160865339,13.4936077 C-0.0195770851,13.7696797 0.201321913,13.9963799 0.477392742,13.999958 C0.479552207,13.999986 0.48171183,14 0.483871476,14 L11.5158528,14 C11.7920355,14.0000731 12.0159259,13.7761827 12.0159259,13.5 C12.0159259,13.4978666 12.0159122,13.4957332 12.0158849,13.4936 C12.014053,13.350472 12.008758,13.1859387 12,13 C11.297742,11.12 8.70097445,10 6,10 Z" id="Path" fill="#FFFFFF"/>
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
                            <?php print BOX_HEADING_ADMINISTRATOR; ?>
                        </a>
                    </li>
                <?php }

                /*
                * Инструкции
                */
                $filenames = array(FILENAME_INSTRUCTIONS);
                $isActive = in_array(basename($PHP_SELF),$filenames);

                if (new_tep_admin_check_boxes_parent($filenames) and new_tep_admin_check_boxes(FILENAME_INSTRUCTIONS) == true) { ?>
                    <li class="tooltip-menu item-menu <?= $isActive?'active':''; ?>">
                        <a href="<?php print tep_href_link(FILENAME_INSTRUCTIONS); ?>" class="auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 16 16" version="1.1">
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="newmade-admin-detailed" transform="translate(-20.000000, -818.000000)">
                                        <g id="Container">
                                            <g id="Sidebar" transform="translate(0.000000, 50.000000)">
                                                <g id="List" transform="translate(0.000000, 38.000000)">
                                                    <g id="Item" transform="translate(0.000000, 715.000000)">
                                                        <g id="Icon" transform="translate(20.000000, 15.000000)">
                                                            <rect id="Rectangle" fill="#1D202D" opacity="0" x="0" y="0" width="16" height="16"/>
                                                            <g id="sidebar-icon" fill="#FFFFFF">
                                                                <path d="M13.9999245,11.000136 L15.1055728,11.5527864 C15.2023365,11.6011683 15.2807978,11.6796295 15.3291796,11.7763932 C15.4526742,12.0233825 15.3525621,12.323719 15.1055728,12.4472136 L15.1055728,12.4472136 L9.78885438,15.1055728 C8.66274442,15.6686278 7.33725558,15.6686278 6.21114562,15.1055728 L6.21114562,15.1055728 L0.894427191,12.4472136 C0.79766349,12.3988317 0.719202244,12.3203705 0.670820393,12.2236068 C0.547325769,11.9766175 0.647437942,11.676281 0.894427191,11.5527864 L0.894427191,11.5527864 L1.99892446,11.000136 L6.21114562,13.1055728 C7.33725558,13.6686278 8.66274442,13.6686278 9.78885438,13.1055728 L13.9999245,11.000136 Z" id="Combined-Shape" opacity="0.3"/>
                                                                <path d="M13.9999245,7.00013595 L15.1055728,7.5527864 C15.2023365,7.60116826 15.2807978,7.6796295 15.3291796,7.7763932 C15.4526742,8.02338245 15.3525621,8.32371897 15.1055728,8.4472136 L15.1055728,8.4472136 L9.78885438,11.1055728 C8.66274442,11.6686278 7.33725558,11.6686278 6.21114562,11.1055728 L6.21114562,11.1055728 L0.894427191,8.4472136 C0.79766349,8.39883174 0.719202244,8.3203705 0.670820393,8.2236068 C0.547325769,7.97661755 0.647437942,7.67628103 0.894427191,7.5527864 L0.894427191,7.5527864 L1.99892446,7.00013595 L6.21114562,9.10557281 C7.33725558,9.66862779 8.66274442,9.66862779 9.78885438,9.10557281 L13.9999245,7.00013595 Z" id="Combined-Shape" opacity="0.7"/>
                                                                <path d="M15.1055728,3.5527864 L9.78885438,0.894427191 C8.66274442,0.33137221 7.33725558,0.33137221 6.21114562,0.894427191 L0.894427191,3.5527864 C0.647437942,3.67628103 0.547325769,3.97661755 0.670820393,4.2236068 C0.719202244,4.3203705 0.79766349,4.39883174 0.894427191,4.4472136 L6.21114562,7.10557281 C7.33725558,7.66862779 8.66274442,7.66862779 9.78885438,7.10557281 L15.1055728,4.4472136 C15.3525621,4.32371897 15.4526742,4.02338245 15.3291796,3.7763932 C15.2807978,3.6796295 15.2023365,3.60116826 15.1055728,3.5527864 Z" id="Path"/>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            <?php print BOX_HEADING_INSTRUCTION; ?>
                        </a>
                    </li>
                <?php } ?>

            </ul>

    </div>
</div>
<div id="overflow_admin"></div>
