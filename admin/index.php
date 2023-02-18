<?php
/*
  $Id: index.php,v 1.2 2003/09/24 15:18:15 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

require('includes/application_top.php');

require(DIR_WS_CLASSES . 'currencies.php');
$currencies = new currencies();

$current_file = 'index';

/*
 * Solomono AJAX
 */
//  date_default_timezone_set('Europe/Kiev');

if (isset($_POST['gaCurrentId'])) {
    $_SESSION['gaCurrentId'] = $_POST['gaCurrentId'];
    tep_db_query('UPDATE ' . TABLE_ADMIN . ' SET ga_settings = \'' . json_encode($_POST['gaCurrentId']) . '\' WHERE admin_id = ' . $_SESSION['login_id']);

    exit;
}

if (isset($_POST['settings'])) {
    $_SESSION['settings'] = $_POST['settings'];
    exit;
} else if (isset($_POST['plot'])) {
    $data1 = array();
    $data2 = array();

    switch ($_POST['plot']) {
        /*
         * График за последние дни
         */
        case 'day':
            $days_before_today = 7;
            $today_time = strtotime(date('d F Y 00:00'));
            $days_before_today_time = $today_time - (86400 * ($days_before_today - 1)) + (3600 * 2);
            $query = tep_db_query("SELECT `o`.`orders_id`, `o`.`date_purchased` AS `date_created`, `ot`.`value` FROM " . TABLE_ORDERS . " `o` LEFT JOIN " . TABLE_ORDERS_TOTAL . " `ot` ON (`o`.`orders_id` = `ot`.`orders_id`) WHERE UNIX_TIMESTAMP(`o`.`date_purchased`) >= " . $days_before_today_time . " AND `ot`.`class` = 'ot_total'");

            $plot_days_before_today = array();
            $i = 0;
            while ($i <= $days_before_today) {
                $plot_days_before_today[] = array(
                    'time' => $days_before_today_time * 1000,
                    'count' => 0,
                    'sum' => 0,
                );

                $days_before_today_time += 86400;
                $i++;
            }

            while ($order = tep_db_fetch_array($query)) {
                foreach ($plot_days_before_today as $i => $plot_day) {
                    $order_time = strtotime($order['date_created']) * 1000;

                    if ($order_time >= $plot_day['time'] && $order_time <= $plot_days_before_today[$i + 1]['time']) {
                        $plot_days_before_today[$i]['count']++;
                        $plot_days_before_today[$i]['sum'] += $order['value'];

                        break;
                    }
                }
            }

            foreach ($plot_days_before_today as $i => $plot_day) {
                if ($i == $days_before_today) {
                    break;
                }

                $data1[] = array(
                    $plot_day['time'],
                    $plot_day['count']
                );
                $data2[] = array(
                    $plot_day['time'],
                    $plot_day['sum'] * $currencies->currencies[DEFAULT_CURRENCY]['value']
                );
            }

            break;

        /*
         * График за последние недели
         */

        case 'week':
            $weeks_before_this = 8;
            $this_week_time = strtotime('this week 00:00');
            $weeks_before_this_time = $this_week_time - (604800 * ($weeks_before_this - 1)) + (3600 * 2);
            $query = tep_db_query("SELECT o.orders_id, o.date_purchased as date_created, ot.value FROM " . TABLE_ORDERS . " o LEFT JOIN " . TABLE_ORDERS_TOTAL . " ot ON (o.orders_id = ot.orders_id) WHERE UNIX_TIMESTAMP(o.date_purchased) >= " . $weeks_before_this_time . " AND ot.class = 'ot_total'");

            $plot_weeks_before_this = array();
            $i = 0;
            while ($i <= $weeks_before_this) {
                $plot_weeks_before_this[] = array(
                    'time' => $weeks_before_this_time * 1000,
                    'count' => 0,
                    'sum' => 0,
                );

                $weeks_before_this_time += 604800;
                $i++;
            }

            while ($order = tep_db_fetch_array($query)) {
                foreach ($plot_weeks_before_this as $i => $plot_week) {
                    $order_time = strtotime($order['date_created']) * 1000;

                    if ($order_time >= $plot_week['time'] && $order_time <= $plot_weeks_before_this[$i + 1]['time']) {
                        $plot_weeks_before_this[$i]['count']++;
                        $plot_weeks_before_this[$i]['sum'] += $order['value'];

                        break;
                    }
                }
            }

            foreach ($plot_weeks_before_this as $i => $plot_week) {
                if ($i == $weeks_before_this) {
                    //            break;
                }

                $data1[] = array($plot_week['time'], $plot_week['count']);
                $data2[] = array($plot_week['time'], $plot_week['sum'] * $currencies->currencies[DEFAULT_CURRENCY]['value']);
            }

            break;


        /*
         * График за последние месяцы
         */
        case 'month':
            $monthes_before_this = 9;
            $month = date('n');
            $this_month_time = strtotime(date('01 F Y 00:00'));
            $monthes_before_this_time = strtotime(date('01 F Y', strtotime('-1 month')));
            $query = tep_db_query("SELECT DATE_FORMAT(`o`.`date_purchased`, '%m.%Y') as 'month',
                                          COUNT(`o`.`orders_id`) as 'count', 
                                          SUM(`ot`.`value`) as 'sum'
                                   FROM " . TABLE_ORDERS . " `o` 
                                   LEFT JOIN " . TABLE_ORDERS_TOTAL . " `ot` ON (`o`.`orders_id` = `ot`.`orders_id`)
                                   AND `ot`.`class` = 'ot_total' 
                                   WHERE DATE(`o`.`date_purchased`) >= str_to_date('" . date('01.m.Y', strtotime('-9 month')) . "', '%d.%m.%Y') 
                                   GROUP BY DATE_FORMAT(`o`.`date_purchased`, '%m.%Y')");

            $plot_monthes_before_this = [];
            $month = 0;
            while ($order = tep_db_fetch_array($query)) {
                $date_created = date('01.m.Y', strtotime('01.'. $order['month']));
                if (empty($plot_monthes_before_this[$month]['time'])) {
                    $plot_monthes_before_this[$month]['time'] = strtotime($date_created) * 1000;
                }
                $plot_monthes_before_this[$month]['count'] += $order['count'];
                $plot_monthes_before_this[$month]['sum'] += $order['sum'];
                $month++;
            }
            $plot_monthes_before_this = array_values($plot_monthes_before_this);
            usort($plot_monthes_before_this, function ($a, $b) {
                return $a['time'] > $b['time'];
            });
            foreach ($plot_monthes_before_this as $i => $plot_month) {
                if ($i == $monthes_before_this) {
                    break;
                }

                $data1[] = array(
                    $plot_month['time'],
                    $plot_month['count']
                );
                $data2[] = array(
                    $plot_month['time'],
                    $plot_month['sum'] * $currencies->currencies[DEFAULT_CURRENCY]['value']
                );
            }

            break;
    }

    print json_encode(array(
        'data' => array(
            $data2,
            $data1
        ),
        'label' => array(
            TEXT_BLOCK_PLOT_XAXIS_LABEL,
            TEXT_BLOCK_PLOT_YAXIS_LABEL
        ),
        'plot' => $_POST['plot'],
    ));
    exit;
}

if (isset($_POST['modalLoader'])) {

switch ($_POST['modalLoader']) {

    case 'blockOrdersPeriod':
        ?>
        <?php

        $quarter_time_start_from = array(
            'January' => 'December',
            'February' => 'December',
            'March' => 'March',
            'April' => 'March',
            'May' => 'March',
            'June' => 'June',
            'July' => 'June',
            'August' => 'June',
            'September' => 'September',
            'October' => 'September',
            'November' => 'September',
            'December' => 'December',
        );

        $today_time = strtotime(date('d F Y 00:00'));
        $yesterday_time = strtotime('yesterday 00:00');
        $week_time = strtotime('this week 00:00');
        $month_time = strtotime(date('01 F Y 00:00'));
        $quarter_time = strtotime('01 ' . $quarter_time_start_from[date('F')] . ' this year');

        /*
         * Сегодня
         */
//                $query = tep_db_query("SELECT `orders_id` FROM " . TABLE_ORDERS . " WHERE UNIX_TIMESTAMP(`date_purchased`) >= " . $today_time);
        $sql = "SELECT
                                orders_id
                                FROM `orders` `o`
                                WHERE DATE(`o`.`date_purchased`) = str_to_date('" . date('d.m.Y') . "', '%d.%m.%Y')
                                                                      ";
        $query = tep_db_query($sql);
        $today_orders_ids = array();
        while ($order = tep_db_fetch_array($query)) {
            $today_orders_ids[] = $order['orders_id'];
        }

        $today_orders_count = count($today_orders_ids);

        $today_orders_sum = 0;
        if ($today_orders_count > 0) {
            $query = tep_db_query("SELECT SUM(value) AS `sum` FROM " . TABLE_ORDERS_TOTAL . " WHERE `class` = 'ot_total' AND `orders_id` IN (" . implode(', ', $today_orders_ids) . ")");
            $today_orders_sum = tep_db_fetch_array($query);
            $today_orders_sum = $currencies->short_format($today_orders_sum['sum']);
        }

        /*
         * Вчера
         */
        $sql = "SELECT
                              orders_id
                              FROM `orders` `o`
                              WHERE DATE(`o`.`date_purchased`) = str_to_date('" . date('d.m.Y', strtotime('yesterday')) . "', '%d.%m.%Y')";
        $query = tep_db_query($sql);
        $yesterday_orders_ids = array();
        while ($order = tep_db_fetch_array($query)) {
            $yesterday_orders_ids[] = $order['orders_id'];
        }

        $yesterday_orders_count = count($yesterday_orders_ids);

        $yesterday_orders_sum = 0;
        if ($yesterday_orders_count > 0) {
            $query = tep_db_query("SELECT SUM(value) AS `sum` FROM " . TABLE_ORDERS_TOTAL . " WHERE `class` = 'ot_total' AND `orders_id` IN (" . implode(', ', $yesterday_orders_ids) . ")");
            $yesterday_orders_sum = tep_db_fetch_array($query);
            $yesterday_orders_sum = $currencies->short_format($yesterday_orders_sum['sum']);
        }

        /*
         * Неделя
         */
        $sql = "SELECT
                                orders_id
                                FROM `orders` `o`
                                WHERE DATE(`o`.`date_purchased`) >= str_to_date('" . date('d.m.Y', strtotime('this week 00:00')) . "', '%d.%m.%Y')";
        $query = tep_db_query($sql);
        $week_orders_ids = array();
        while ($order = tep_db_fetch_array($query)) {
            $week_orders_ids[] = $order['orders_id'];
        }

        $week_orders_count = count($week_orders_ids);

        $week_orders_sum = 0;
        if ($week_orders_count > 0) {
            $query = tep_db_query("SELECT SUM(value) AS `sum` FROM " . TABLE_ORDERS_TOTAL . " WHERE `class` = 'ot_total' AND `orders_id` IN (" . implode(', ', $week_orders_ids) . ")");
            $week_orders_sum = tep_db_fetch_array($query);
            $week_orders_sum = $currencies->short_format($week_orders_sum['sum']);
        }

        /*
         * Месяц
         */
        $sql = "SELECT
                                  orders_id
                                  FROM `orders` `o`
                                  WHERE DATE(`o`.`date_purchased`) >= str_to_date('" . date('d.m.Y', $month_time) . "', '%d.%m.%Y')";
        $query = tep_db_query($sql);
        $month_orders_ids = array();
        while ($order = tep_db_fetch_array($query)) {
            $month_orders_ids[] = $order['orders_id'];
        }

        $month_orders_count = count($month_orders_ids);

        $month_orders_sum = 0;
        if ($month_orders_count > 0) {
            $query = tep_db_query("SELECT SUM(value) AS sum FROM " . TABLE_ORDERS_TOTAL . " WHERE class = 'ot_total' AND orders_id IN (" . implode(', ', $month_orders_ids) . ")");
            $month_orders_sum = tep_db_fetch_array($query);
            $month_orders_sum = $currencies->short_format($month_orders_sum['sum']);
        }

        /*
         * Квартал
         */
        $month = date("n");
        $yearQuarter = ceil($month / 3);
        $quarter_to_start_month = [
            1 => '01',
            2 => '04',
            3 => '07',
            4 => '10',
        ];

        $sql = "SELECT
                                orders_id
                                FROM `orders` `o`
                                WHERE DATE(`o`.`date_purchased`) >= str_to_date('" . date('01.' . $quarter_to_start_month[$yearQuarter] . '.Y') . "', '%d.%m.%Y')";
        $query = tep_db_query($sql);
        $quarter_orders_ids = array();
        while ($order = tep_db_fetch_array($query)) {
            $quarter_orders_ids[] = $order['orders_id'];
        }

        $quarter_orders_count = count($quarter_orders_ids);

        $quarter_orders_sum = 0;
        if ($quarter_orders_count > 0) {
            $query = tep_db_query("SELECT SUM(value) AS sum FROM " . TABLE_ORDERS_TOTAL . " WHERE class = 'ot_total' AND orders_id IN (" . implode(', ', $quarter_orders_ids) . ")");
            $quarter_orders_sum = tep_db_fetch_array($query);
            $quarter_orders_sum = $currencies->short_format($quarter_orders_sum['sum']);
        }

        /*
         * За все время
         */
        $query = tep_db_query("SELECT count(*) as count FROM " . TABLE_ORDERS);
        $order = tep_db_fetch_array($query);
        $all_time_orders_count = $order['count'];

        $all_time_orders_sum = 0;
        if ($all_time_orders_count > 0) {
            $query = tep_db_query("SELECT SUM(value) AS `sum` FROM " . TABLE_ORDERS_TOTAL . " WHERE `class` = 'ot_total'");
            $all_time_orders_sum = tep_db_fetch_array($query);
            $all_time_orders_sum = $currencies->short_format($all_time_orders_sum['sum']);

        }

        ?>
        <?php if (false): ?>
        <div class="wrapper_home_menu">
            <div class="row">
                <div class="col-md-4">
                    <a href="#">
                        <div class="menu_wrap">
                            <div class="menu_img">
                                <img src="images/icons-sidebare/products-icon.svg" border="0" alt="">
                            </div>
                            <div class="menu_text">
                                <div class="menu_title-text">
                                    <h4><?php print TEXT_MENU_PRODUCTS; ?></h4>
                                    <ul>
                                        <li><a href="#"><?php echo TEXT_PROD_ATTRS; ?></a></li>
                                        <li><a href="#"><?php print BULK_DISCOUNTS; ?></a></li>
                                        <li><a href="#"><?php print EXCEL_IMPORT_EXPORT; ?></a></li>
                                        <li><a href="#"><?php print L_SPECIALS; ?></a></li>
                                        <li><a href="#"><?php print CONTROL; ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#">
                        <div class="menu_wrap">
                            <div class="menu_img">
                                <img src="images/icons-sidebare/orders-icon.svg" border="0" alt="">
                            </div>
                            <div class="menu_text">
                                <div class="menu_title-text">
                                    <h4><?php print TEXT_MENU_ORDERS; ?><span class="text-center">14</span></h4>
                                    <ul>
                                        <li><a href="#"><?php print ORDER_LIST; ?></a></li>
                                        <li><a href="#"><?php print REPORT_STATUS_FILTER; ?></a></li>
                                        <li><a href="#"><?php print ENTRY_CREATE_ORDER; ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#">
                        <div class="menu_wrap">
                            <div class="menu_img">
                                <img src="images/icons-sidebare/clients-icon.svg" border="0" alt="">
                            </div>
                            <div class="menu_text">
                                <div class="menu_title-text">
                                    <h4><?php print BOX_HEADING_CUSTOMERS; ?></h4>
                                    <ul>
                                        <li><a href="#"><?php print LIST_CLIENTS; ?></a></li>
                                        <li><a href="#"><?php print CLIENT_GROUPS; ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#">
                        <div class="menu_wrap">
                            <div class="menu_img">
                                <img src="images/icons-sidebare/content-icon.svg" border="0" alt="">
                            </div>
                            <div class="menu_text">
                                <div class="menu_title-text">
                                    <h4><?php print BOX_HEADING_INFORMATION; ?></h4>
                                    <ul>
                                        <li><a href="#"><?php print TEXT_PAGES; ?></a></li>
                                        <li><a href="#"><?php print COMMENTS; ?></a></li>
                                        <li><a href="#"><?php print TABLE_HEADING_EMAIL_CONTENT; ?></a></li>
                                        <li><a href="#"><?php print FILE_MANAGER; ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#">
                        <div class="menu_wrap">
                            <div class="menu_img">
                                <img src="images/icons-sidebare/design-icon.svg" border="0" alt="">
                            </div>
                            <div class="menu_text">
                                <div class="menu_title-text">
                                    <h4><?php print BOX_HEADING_DESIGN_CONTROLS; ?></h4>
                                    <ul>
                                        <li><a href="#"><?php print L_POLLS; ?></a></li>
                                        <li><a href="#"><?php print SURVEY_SETTINGS; ?></a></li>
                                        <li><a href="#"><?php print H_CURRENCIES; ?></a></li>
                                        <li><a href="#"><?php print TEXT_COUPON; ?></a></li>
                                        <li><a href="#"><?php print H_LANGUAGES; ?></a></li>
                                        <li><a href="#"><?php print TEXT_PAYMENT; ?></a></li>
                                        <li><a href="#"><?php print TABLE_HEADING_ORDER_TOTAL; ?></a></li>
                                    </ul>
                                </div>
                            </div>
                            <a href="#">
                                <div class="menu_close">
                                    <img src="images/icons-sidebare/remove-icon.svg" border="0" alt="">
                                </div>
                            </a>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#">
                        <div class="menu_wrap">
                            <div class="menu_img">
                                <img src="images/icons-sidebare/modules-icon.svg" border="0" alt="">
                            </div>
                            <div class="menu_text">
                                <div class="menu_title-text">
                                    <h4><?php print BOX_HEADING_MODULES; ?></h4>
                                    <ul>
                                        <li><a href="#"><?php print L_POLLS; ?></a></li>
                                        <li><a href="#"><?php print SURVEY_SETTINGS; ?></a></li>
                                        <li><a href="#"><?php print H_CURRENCIES; ?></a></li>
                                        <li><a href="#"><?php print TEXT_COUPON; ?></a></li>
                                        <li><a href="#"><?php print H_LANGUAGES; ?></a></li>
                                        <li><a href="#"><?php print TEXT_PAYMENT; ?></a></li>
                                        <li><a href="#"><?php print TABLE_HEADING_ORDER_TOTAL; ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#">
                        <div class="menu_wrap">
                            <div class="menu_img">
                                <img src="images/icons-sidebare/settings-icon.svg" border="0" alt="">
                            </div>
                            <div class="menu_text">
                                <div class="menu_title-text">
                                    <h4><?php print BOX_HEADING_CONFIGURATION; ?></h4>
                                    <ul>
                                        <li><a href="#"><?php print TEXT_MY_SHOP; ?></a></li>
                                        <li><a href="#"><?php print MENUE_TITLE_CUSTOMER; ?></a></li>
                                        <li><a href="#"><?php print TEXT_SHIPPING_PACKAGING; ?></a></li>
                                        <li><a href="#"><?php print TEXT_PRODUCT_WITHDRAWAL; ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#">
                        <div class="menu_wrap">
                            <div class="menu_img">
                                <img src="images/icons-sidebare/tools-icon.svg" border="0" alt="">
                            </div>
                            <div class="menu_text">
                                <div class="menu_title-text">
                                    <h4><?php print BOX_HEADING_TOOLS; ?></h4>
                                    <ul>
                                        <li><a href="#"><?php print TEXT_DUMPER_HEADER_TITLE; ?></a></li>
                                        <li><a href="#"><?php print TEXT_SETTINGS_EDITOR; ?></a></li>
                                        <li><a href="#"><?php print TEXT_SEND_MESSAGE; ?></a></li>
                                        <li><a href="#"><?php print TEXT_NEWSLETTER_CUSTOMERS; ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#">
                        <div class="menu_wrap">
                            <div class="menu_img">
                                <img src="images/icons-sidebare/charts-icon.svg" border="0" alt="">
                            </div>
                            <div class="menu_text">
                                <div class="menu_title-text">
                                    <h4><?php print BOX_HEADING_REPORTS; ?></h4>
                                    <ul>
                                        <li><a href="#"><?php print TEXT_PRODUCT_VIEWS; ?></a></li>
                                        <li><a href="#"><?php print TEXT_ORDERED_GOODS; ?></a></li>
                                        <li><a href="#"><?php print TABLE_HEADING_PRODUCTS; ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <?php if (false): ?>
                <div class="row">
                    <div class="col-md-8 text-left">
                        <div class="col-md-4">
                            <a href="#">
                                <div class="menu_bottom_wrap">
                                    <div class="menu_img">
                                        <img src="images/icons-sidebare/clients-icon.svg" border="0" alt="">
                                    </div>
                                    <div class="menu_title-text">
                                        <div class="menu_title"><?php print BOX_HEADING_ADMINISTRATOR; ?></div>
                                        <div class="menu_plus">
                                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                 viewBox="0 0 341.4 341.4"
                                                 style="enable-background:new 0 0 341.4 341.4;" xml:space="preserve">
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
                                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                 viewBox="0 0 341.4 341.4"
                                                 style="enable-background:new 0 0 341.4 341.4;" xml:space="preserve">
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
                                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                 viewBox="0 0 341.4 341.4"
                                                 style="enable-background:new 0 0 341.4 341.4;" xml:space="preserve">
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
    <?php endif; ?>


        <div class="order_statistics new_index_elem col-lg-8 col-md-9 col-xs-12">
            <div>
                <div class="new_index_title"><?php echo TEXT_ORDER_STATISTICS; ?>
                    <span><?php echo TEXT_SUMMARY_STAT; ?></span></div>
                <div class="order_statistics_block col-md-2 col-xs-4">
                    <div class="order_statistics_name"><?php echo TEXT_BLOCK_ORDERS_TODAY_COUNTERS; ?></div>
                    <div class="order_statistics_number"><span><?php echo $today_orders_count; ?></span>
                        <?php if (!empty($today_orders_sum)) {
                            echo '<span class="order_statistics_sum">' . $today_orders_sum . '</span>';
                        } ?>
                    </div>
                </div>
                <div class="order_statistics_block col-md-2 col-xs-4">
                    <div class="order_statistics_name"><?php print TEXT_BLOCK_ORDERS_YESTERDAY_COUNTERS; ?></div>
                    <div class="order_statistics_number"><span><?php print $yesterday_orders_count; ?></span>
                        <?php if (!empty($yesterday_orders_sum)) {
                            echo '<span class="order_statistics_sum">' . $yesterday_orders_sum . '</span>';
                        } ?>
                    </div>
                </div>
                <div class="order_statistics_block col-md-2 col-xs-4">
                    <div class="order_statistics_name"><?php echo TEXT_BLOCK_ORDERS_WEEK_COUNTERS; ?></div>
                    <div class="order_statistics_number"><span><?php echo $week_orders_count; ?></span>
                        <?php if (!empty($week_orders_sum)) {
                            echo '<span class="order_statistics_sum">' . $week_orders_sum . '</span>';
                        } ?>
                    </div>
                </div>
                <div class="order_statistics_block col-md-2 col-xs-4">
                    <div class="order_statistics_name"><?php echo TEXT_BLOCK_ORDERS_MONTH_COUNTERS; ?></div>
                    <div class="order_statistics_number"><span><?php echo $month_orders_count; ?></span>
                        <?php if (!empty($month_orders_sum)) {
                            echo '<span class="order_statistics_sum">' . $month_orders_sum . '</span>';
                        } ?>
                    </div>
                </div>
                <div class="order_statistics_block col-md-2 col-xs-4">
                    <div class="order_statistics_name"><?php echo TEXT_BLOCK_ORDERS_QUARTER_COUNTERS; ?></div>
                    <div class="order_statistics_number"><span><?php echo $quarter_orders_count; ?></span>
                        <?php if (!empty($quarter_orders_sum)) {
                            echo '<span class="order_statistics_sum">' . $quarter_orders_sum . '</span>';
                        } ?>
                    </div>
                </div>
                <div class="order_statistics_block col-md-2 col-xs-4">
                    <div class="order_statistics_name"><?php echo TEXT_BLOCK_ORDERS_ALL_TIME_COUNTERS; ?></div>
                    <div class="order_statistics_number"><span><?php echo $all_time_orders_count; ?></span>
                        <?php if (!empty($all_time_orders_sum)) {
                            echo '<span class="order_statistics_sum">' . $all_time_orders_sum . '</span>';
                        } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="who_online new_index_elem col-md-2 col-xs-12">
            <?php
            $sql = "SELECT count(1) as count FROM whos_online";
            $whosOnline = tep_db_fetch_array(tep_db_query($sql))['count'];


            ?>
            <div>
                <div class="new_index_title"><?php echo TEXT_WHO_ONLINE; ?></div>
                <div class="who_online_block">
                    <a href="#"><?= $whosOnline ?></a>
                    <a class="who_online_show_all" href="<?= FILENAME_WHOS_ONLINE ?>"><?php echo TEXT_VIEW_LIST; ?></a>
                </div>
            </div>
        </div>

        <?php $modules_count = tep_modules_count(); ?>
        <?php $percentModulesEnabled = round((100 * tep_modules_enabled()) / ($modules_count != 0 ? $modules_count : 1), 0); ?>

        <div class="other_statistics new_index_elem col-lg-2 col-md-3 col-xs-12">
            <div>
                <a href="<?php echo tep_href_link(FILENAME_REVIEWS, '', 'NONSSL'); ?>"
                   class="other_statistics_comments"><?php echo BOX_TOOLS_COMMENT8R; ?>
                    <span><?php print tep_comments_count(); ?></span></a>
                <a href="<?php echo tep_href_link(FILENAME_CATEGORIES); ?>"
                   class="other_statistics_products"><?php echo TEXT_MENU_PRODUCTS; ?>
                    <span><?php print tep_products_count(); ?></span></a>
                <a href="<?php echo tep_href_link(FILENAME_ORDERS); ?>"
                   class="other_statistics_orders"><?php echo TEXT_MENU_ORDERS; ?>
                    <span><?php print tep_orders_count($languages_id); ?></span></a>
                <a href="<?php echo tep_href_link(FILENAME_SPECIALS); ?>"
                   class="other_statistics_discount visible-sm visible-xs"><?php echo BOX_CATALOG_SPECIALS; ?>
                    <span>9</span></a>
                <a href="<?php echo tep_href_link(FILENAME_CUSTOMERS); ?>"
                   class="other_statistics_customers visible-sm visible-xs"><?php echo TEXT_MENU_CLIENTS; ?>
                    <span>84</span></a>
                <a href="<?php echo tep_href_link(FILENAME_STATS_PRODUCTS_PURCHASED); ?>"
                   class="other_statistics_sales"><?php echo TABLE_HEADING_ORDER_TOTAL; ?>
                    <span><?php print $currencies->format(tep_orders_sum_count($languages_id)); ?></span></a>
                <a href="<?php echo tep_href_link(FILENAME_CONFIGURATION, 'gID=' . 277, 'NONSSL') ?>"
                   class="other_statistics_buy_modules"><?php echo BOX_HEADING_MODULES; ?>
                    <span><?php print tep_modules_enabled() . "/" . tep_modules_count(); ?></span></a>
            </div>
        </div>

        <?php
        exit;
        break;
    case 'blockOrderStatus':
        ?>
        <div class="order_statuses col-xs-12">
            <?php
            $orders_statuses = array();
            $chart_colors_color = [];
            $chart_link_href = [];
            $query = tep_db_query("SELECT orders_status_id, orders_status_name, orders_status_color FROM " . TABLE_ORDERS_STATUS . " WHERE language_id = '" . (int)$languages_id . "' AND orders_status_show = '1' limit 6");
            while ($orders_status = tep_db_fetch_array($query)) {
                $orders_statuses[$orders_status['orders_status_id']] = $orders_status['orders_status_name'];
                $chart_colors_color[] = $orders_status['orders_status_color'];
                $chart_link_href[] = 'orders_status=' . $orders_status['orders_status_id'];
            }

            //                $chart_colors_color = array(
            //                    '#dd1e1e;',
            //                    '#d8802b;',
            //                    '#3189d7;',
            //                    '#a232ff;',
            //                    '#01c993;',
            //                    '#4c5d65;',
            //                );
            $chart_colors_class = array(
                'text-danger',
                'bg-solomono',
                'text-success',
                'text-info',
                'text-primary',
                'text-muted',
            );
            //                $chart_link_href = array(
            //                    'status=1',
            //                    'status=2',
            //                    'status=3',
            //                    'status=4',
            //                    'status=5',
            //                    'status=6',
            //                );
            $order_statuses_count = 0;
            foreach ($orders_statuses as $order_status_id => $order_status_name) {
                if ($order_statuses_count == 6) {
                    break;
                }
                $status_color_color = $chart_colors_color[$order_statuses_count];
                $status_color_class = $chart_colors_class[$order_statuses_count];

                $orders_status_orders_count = tep_db_fetch_array(tep_db_query("SELECT COUNT(*) AS total FROM " . TABLE_ORDERS . " o LEFT JOIN " . TABLE_ORDERS_TOTAL . " ot ON (o.orders_id = ot.orders_id) WHERE ot.class = 'ot_total' AND o.orders_status = '" . $order_status_id . "'"));
                $orders_status_orders_count = $orders_status_orders_count['total'];
                ?>
                <a class="order_statuses_elem"
                   href="<?php print tep_href_link(FILENAME_ORDERS, $chart_link_href[$order_statuses_count] . '&filter_on=on'); ?>"
                   style="color: <?php print $status_color_color; ?>">
                    <?php print ucfirst($order_status_name); ?>
                    <span style="background: <?php print $status_color_color; ?>"><?php print $orders_status_orders_count; ?></span>
                </a>
                <?php
                $order_statuses_count++;
            } ?>
        </div>

        <?php
        break;
    case 'blockCounters':
        ?>
        <script>
            uiLoad.load(jp_config['easyPieChart']);
        </script>
        <?php
        break;
    case 'blockOrdersSchedule':
        require('includes/index/orders-schedule.php');

        ?>

        <script>
            uiLoad.load(jp_config['plot']);
        </script>
        <?php

        break;

case 'blockEventsReviewsNews':
    ?>

    <!-- events block -->
    <?php

    /**
     * останні замовлення
     */
    $limit = 20;
    $orders = tep_get_last_orders($limit);

    /**
     * останні покупці
     */
    $customers = tep_get_last_customers($limit);

    /**
     * останні додані товари
     */
    $added_product = tep_get_last_product($limit);

    /**
     * час входу адміна
     */
    $entered_admin = tep_get_last_admin($limit);
    $added_comments = [];
    if (defined('COMMENTS_MODULE_ENABLED') && COMMENTS_MODULE_ENABLED == 'true') {
        /**
         * останні коментарі
         */
        $added_comments = tep_get_last_comments($limit);

    }
    /**
     * 20 нещодавних подій (об'єднання попередніх)
     */
    $last_events = array_merge($orders, $customers, $added_product, $entered_admin, $added_comments);

    uasort($last_events, 'datediff');

    ?>
    <div class="events_block col-md-6 col-xs-12">
        <div>
            <div class="new_index_title">
                <?php print TEXT_BLOCK_EVENTS_TITLE; ?>
                <!-- tabs -->
                <ul id="events_tabs" class="nav nav-tabs" role="tablist">
                    <li class="active">
                        <a data-target="#tab-1" role="tab" data-toggle="tab" class="border-color-none">
                            <i class="fa fa-list-ul text-md text-info" data-toggle="tooltip" data-placement="bottom"
                               title="<?php echo TEXT_BLOCK_EVENTS_TOOLTIP_ALL_EVENTS; ?>"></i>
                            <?php if (!isMobile()) {
                                echo '<span>' . TEXT_BLOCK_EVENTS_TOOLTIP_ALL_EVENTS . '</span>';
                            } ?>
                        </a>
                    </li>
                    <li>
                        <a data-target="#tab-2" role="tab" data-toggle="tab" class="border-color-none">
                            <i class="fa fa-user text-md text-warning" data-toggle="tooltip" data-placement="bottom"
                               title="<?php echo TEXT_BLOCK_EVENTS_TOOLTIP_ADMINS; ?>"></i>
                            <?php if (!isMobile()) {
                                echo '<span>' . TEXT_BLOCK_EVENTS_TOOLTIP_ADMINS . '</span>';
                            } ?>
                        </a>
                    </li>
                    <li>
                        <a data-target="#tab-3" role="tab" data-toggle="tab" class="border-color-none">
                            <i class="fa fa-dollar text-md text-success" data-toggle="tooltip" data-placement="bottom"
                               title="<?php echo TEXT_BLOCK_EVENTS_TOOLTIP_ORDERS; ?>"></i>
                            <?php if (!isMobile()) {
                                echo '<span>' . TEXT_BLOCK_EVENTS_TOOLTIP_ORDERS . '</span>';
                            } ?>
                        </a>
                    </li>
                    <li>
                        <a data-target="#tab-4" role="tab" data-toggle="tab" class="border-color-none">
                            <i class="fa fa-heart text-md text-danger" data-toggle="tooltip" data-placement="bottom"
                               title="<?php echo TEXT_BLOCK_EVENTS_TOOLTIP_CUSTOMERS; ?>"></i>
                            <?php if (!isMobile()) {
                                echo '<span>' . TEXT_BLOCK_EVENTS_TOOLTIP_CUSTOMERS . '</span>';
                            } ?>
                        </a>
                    </li>
                    <li>
                        <a data-target="#tab-5" role="tab" data-toggle="tab" class="border-color-none">
                            <i class="fa fa-cube text-md text-primary" data-toggle="tooltip" data-placement="bottom"
                               title="<?php echo TEXT_BLOCK_EVENTS_TOOLTIP_NEW_PRODUCTS; ?>"></i>
                            <?php if (!isMobile()) {
                                echo '<span>' . TEXT_BLOCK_EVENTS_TOOLTIP_NEW_PRODUCTS . '</span>';
                            } ?>
                        </a>
                    </li>
                    <?php if (defined('COMMENTS_MODULE_ENABLED') && COMMENTS_MODULE_ENABLED == 'true') { ?>
                        <li>
                            <a data-target="#tab-6" role="tab" data-toggle="tab" class="border-color-none">
                                <i class="fa fa-comments text-md text-warning" data-toggle="tooltip"
                                   data-placement="bottom"
                                   title="<?php echo TEXT_BLOCK_EVENTS_TOOLTIP_COMMENTS; ?>"></i>
                                <?php if (!isMobile()) {
                                    echo '<span>' . TEXT_BLOCK_EVENTS_TOOLTIP_COMMENTS . '</span>';
                                } ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
                <!-- /tabs -->
            </div>
            <div class="panel">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="tab-1">
                        <?php
                        $index = 0;

                        foreach ($last_events as $event) {

                            if ($index == $limit) break;

                            switch ($event['event_type']) {

                                case 'admin':

                                    $admin = $event;
                                    ?>

                                    <div class="media eventStyle">
                                        <span class="pull-left thumb-sm"><i
                                                    class="fa fa-user text-md text-warning wrapper-sm"></i></span>
                                        <div class="media-body">
                                            <div class="pull-right text-center m-r-10">
                                                <small class="block m-t-sm dateEventInfo">
                                                    <span class="text-muted"><?php echo date("d-m-Y", strtotime($admin['date_event'])); ?></span>
                                                    <span class=""><?php echo date("H:i:s", strtotime($admin['date_event'])); ?></span>
                                                </small>
                                            </div>
                                            <small class="block m-t-sm m-b-sm">
                                                <?php

                                                printf(TEXT_BLOCK_EVENTS_MESSAGE_ADMINS, '<a class="text-info" href="' . tep_href_link(FILENAME_ADMIN_MEMBERS, 'id=' . $admin['admin_id']) . '&action=edit_admin">' . $admin['admin_firstname'] . ' ' . $admin['admin_lastname'] . '</a>');

                                                ?>
                                            </small>
                                        </div>
                                    </div>

                                    <?php

                                    break;

                                case 'comment':

                                    $comment = $event;
                                    ?>
                                    <div class="media eventStyle">
                                        <span class="pull-left thumb-sm"><i
                                                    class="fa fa-comments text-md text-warning wrapper-sm"></i></span>
                                        <div class="media-body">
                                            <div class="pull-right text-center  m-r-10">
                                                <small class="block m-t-sm dateEventInfo">
                                                    <span class="text-muted"><?php echo date("d-m-Y", strtotime($comment['date_event'])); ?></span>
                                                    <span class=""><?php echo date("H:i:s", strtotime($comment['date_event'])); ?></span>
                                                </small>
                                            </div>
                                            <small class="block m-t-sm m-b-sm">
                                                <?php

                                                printf(TEXT_BLOCK_EVENTS_MESSAGE_COMMENTS, '<a class="text-info" href="">' . $comment['name'] . '</a>');

                                                ?>
                                            </small>
                                        </div>
                                    </div>

                                    <?php
                                    break;

                                case 'product':

                                    $product = $event;
                                    ?>
                                    <div class="media eventStyle">
                                        <span class="pull-left thumb-sm"><i
                                                    class="fa fa-cube text-md text-primary wrapper-sm"></i></span>
                                        <div class="media-body">
                                            <div class="pull-right text-center  m-r-10">
                                                <small class="block m-t-sm dateEventInfo">
                                                    <span class="text-muted"><?php echo date("d-m-Y", strtotime($product['date_event'])); ?></span>
                                                    <span class=""><?php echo date("H:i:s", strtotime($product['date_event'])); ?></span>
                                                </small>
                                            </div>
                                            <small class="block m-t-sm m-b-sm">
                                                <?php

                                                printf(TEXT_BLOCK_EVENTS_MESSAGE_NEW_PRODUCTS, '<a class="text-info" href="' . tep_href_link(FILENAME_PRODUCTS, 'pID=' . $product['products_id'] . '&action=new_product') . '">' . $product['products_name'] . '</a>');

                                                ?>
                                            </small>
                                        </div>
                                    </div>

                                    <?php
                                    # code...
                                    break;

                                case 'customer':

                                    $customer = $event;
                                    ?>
                                    <div class="media eventStyle">
                                        <span class="pull-left thumb-sm"><i
                                                    class="fa fa-heart text-md text-danger wrapper-sm"></i></span>
                                        <div class="media-body">
                                            <div class="pull-right text-center  m-r-10">
                                                <small class="block m-t-sm dateEventInfo">
                                                    <span class="text-muted"><?php echo date("d-m-Y", strtotime($customer['date_event'])); ?></span>
                                                    <span class=""><?php echo date("H:i:s", strtotime($customer['date_event'])); ?></span>
                                                </small>
                                            </div>
                                            <small class="block m-t-sm m-b-sm">
                                                <?php

                                                printf(TEXT_BLOCK_EVENTS_MESSAGE_CUSTOMERS, '<a class="text-info" href="' . tep_href_link(FILENAME_CUSTOMERS, 'id=' . $customer['customers_id']) . '&action=edit_customers">' . $customer['customers_lastname'] . ' ' . $customer['customers_firstname'] . '</a>');

                                                ?>
                                            </small>
                                        </div>
                                    </div>

                                    <?php
                                    # code...
                                    break;

                                case 'order':

                                    $order = $event;
                                    ?>
                                    <div class="media eventStyle">
                                        <span class="pull-left thumb-sm"><i
                                                    class="fa fa-dollar text-md wrapper-sm text-success"></i></span>
                                        <div class="media-body">
                                            <div class="pull-right text-center  m-r-10">
                                                <small class="block m-t-sm dateEventInfo">
                                                    <span class="text-muted"><?php echo date("d-m-Y", strtotime($order['date_event'])); ?></span>
                                                    <span class=""><?php echo date("H:i:s", strtotime($order['date_event'])); ?></span>
                                                </small>
                                            </div>
                                            <small class="block m-t-sm m-b-sm">
                                                <?php
                                                printf(TEXT_BLOCK_EVENTS_MESSAGE_ORDERS, '<a class="text-info" href="' . tep_href_link(FILENAME_EDIT_ORDERS, tep_get_all_get_params(array(
                                                            'oID',
                                                            'action'
                                                        )) . 'oID=' . $order['orders_id'] . '&action=edit') . '">' . sprintf(TEXT_BLOCK_EVENTS_MESSAGE_ORDERS_2, $order['orders_id']) . '</a>');
                                                ?>
                                            </small>
                                        </div>
                                    </div>
                                    <?php
                                    break;
                            }
                            $index++;
                        }
                        ?>
                    </div>
                    <!-- admins tab -->
                    <div role="tabpanel" class="tab-pane" id="tab-2">
                        <?php foreach ($entered_admin as $admin) { ?>
                            <div class="media eventStyle">
                                <span class="pull-left thumb-sm"><i
                                            class="fa fa-user text-md text-warning wrapper-sm"></i></span>
                                <div class="media-body">
                                    <div class="pull-right text-center  m-r-10">
                                        <small class="block m-t-sm dateEventInfo">
                                            <span class="text-muted"><?php echo date("d-m-Y", strtotime($admin['date_event'])); ?></span>
                                            <span class=""><?php echo date("H:i:s", strtotime($admin['date_event'])); ?></span>
                                        </small>
                                    </div>
                                    <small class="block m-t-sm m-b-sm">
                                        <?php
                                        printf(TEXT_BLOCK_EVENTS_MESSAGE_ADMINS, '<a class="text-info" href="' . tep_href_link(FILENAME_ADMIN_MEMBERS, 'id=' . $admin['admin_id']) . '&action=edit_admin">' . $admin['admin_firstname'] . ' ' . $admin['admin_lastname'] . '</a>');
                                        ?>
                                    </small>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- /admins tab -->

                    <!-- orders tab -->
                    <div role="tabpanel" class="tab-pane" id="tab-3">
                        <?php foreach ($orders as $order) { ?>

                            <div class="media eventStyle">
                                <span class="pull-left thumb-sm"><i
                                            class="fa fa-dollar text-md wrapper-sm icon text-success"></i></span>
                                <div class="media-body">
                                    <div class="pull-right text-center  m-r-10">
                                        <small class="block m-t-sm dateEventInfo">
                                            <span class="text-muted"><?php echo date("d-m-Y", strtotime($order['date_event'])); ?></span>
                                            <span class=""><?php echo date("H:i:s", strtotime($order['date_event'])); ?></span>
                                        </small>
                                    </div>
                                    <small class="block m-t-sm m-b-sm">
                                        <?php
                                        printf(TEXT_BLOCK_EVENTS_MESSAGE_ORDERS, '<a class="text-info" href="' . tep_href_link(FILENAME_EDIT_ORDERS, tep_get_all_get_params(array(
                                                    'oID',
                                                    'action'
                                                )) . 'oID=' . $order['orders_id'] . '&action=edit') . '">' . sprintf(TEXT_BLOCK_EVENTS_MESSAGE_ORDERS_2, $order['orders_id']) . '</a>');
                                        ?>
                                    </small>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- /orders tab -->

                    <!-- customers tab -->
                    <div role="tabpanel" class="tab-pane" id="tab-4">
                        <?php foreach ($customers as $customer) { ?>

                            <div class="media eventStyle">
                                <span class="pull-left thumb-sm"><i
                                            class="fa fa-heart text-md text-danger wrapper-sm"></i></span>
                                <div class="media-body">
                                    <div class="pull-right text-center  m-r-10">
                                        <small class="block m-t-sm dateEventInfo">
                                            <span class="text-muted"><?php echo date("d-m-Y", strtotime($customer['date_event'])); ?></span>
                                            <span class=""><?php echo date("H:i:s", strtotime($customer['date_event'])); ?></span>
                                        </small>
                                    </div>
                                    <small class="block m-t-sm m-b-sm">
                                        <?php
                                        printf(TEXT_BLOCK_EVENTS_MESSAGE_CUSTOMERS, '<a class="text-info" href="' . tep_href_link(FILENAME_CUSTOMERS, 'id=' . $customer['customers_id']) . '&action=edit_customers">' . $customer['customers_lastname'] . ' ' . $customer['customers_firstname'] . '</a>');
                                        ?>
                                    </small>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- customers tab -->

                    <!-- lastProducts tab -->
                    <div role="tabpanel" class="tab-pane" id="tab-5">
                        <?php foreach ($added_product as $product) { ?>

                            <div class="media eventStyle">
                                <span class="pull-left thumb-sm"><i
                                            class="fa fa-cube text-md text-primary wrapper-sm"></i></span>
                                <div class="media-body">
                                    <div class="pull-right text-center  m-r-10">
                                        <small class="block m-t-sm dateEventInfo">
                                            <span class="text-muted"><?php echo date("d-m-Y", strtotime($product['date_event'])); ?></span>
                                            <span class=""><?php echo date("H:i:s", strtotime($product['date_event'])); ?></span>
                                        </small>
                                    </div>
                                    <small class="block m-t-sm m-b-sm">
                                        <?php
                                        printf(TEXT_BLOCK_EVENTS_MESSAGE_NEW_PRODUCTS, '<a class="text-info" href="' . tep_href_link(FILENAME_PRODUCTS, 'pID=' . $product['products_id'] . '&action=new_product') . '">' . $product['products_name'] . '</a>');
                                        ?>
                                    </small>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- /lastProducts tab -->

                    <!-- lastComments tab -->
                    <?php if (defined('COMMENTS_MODULE_ENABLED') && COMMENTS_MODULE_ENABLED == 'true') { ?>
                        <div role="tabpanel" class="tab-pane" id="tab-6">
                            <?php foreach ($added_comments as $comment) { ?>

                                <div class="media eventStyle">
                                    <span class="pull-left thumb-sm"><i
                                                class="fa fa-comments text-md text-warning wrapper-sm"></i></span>
                                    <div class="media-body">
                                        <div class="pull-right text-center  m-r-10">
                                            <small class="block m-t-sm dateEventInfo">
                                                <span class="text-muted"><?php echo date("d-m-Y", strtotime($comment['date'])); ?></span>
                                                <span class=""><?php echo date("H:i:s", strtotime($comment['date'])); ?></span>
                                            </small>
                                        </div>
                                        <small class="block m-t-sm m-b-sm">
                                            <?php

                                            printf(TEXT_BLOCK_EVENTS_MESSAGE_COMMENTS, '<a class="text-info" href="/product_info.php?products_id=' . $comment['pid'] . '#tab-comments-anchor">' . $comment['name'] . '</a>');

                                            ?>
                                        </small>
                                    </div>
                                </div>


                            <?php } ?>
                        </div>
                    <?php } ?>
                    <!-- /lastComments tab -->
                    <?php if (isMobile()) { ?>
                        <span class="show_all_content"><span><?php echo TEXT_MOBILE_SHOW_MORE; ?><i
                                        class="fa fa-long-arrow-down" aria-hidden="true"></i></span></span>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>
    <?php
if (defined('COMMENTS_MODULE_ENABLED') && COMMENTS_MODULE_ENABLED == 'true'){
    $limit = 20;

    /**
     * останні коментарі
     */
    $added_comments = tep_get_last_comments($limit);

    ?>
    <div class="reviews_block col-md-6 col-xs-12">
        <div>
            <div class="new_index_title">
                <?php print TEXT_BLOCK_COMMENTS_TITLE; ?>
                <?php if (!isMobile()) { ?>
                    <a class="hidden-xs" href="<?= tep_href_link('reviews.php') ?>"><?php echo TEXT_SHOW_ALL; ?></a>
                <?php } else { ?>
                    <?php
                    $states = json_decode(ADMIN_BLOCK_STATE);
                    $states = (isset($_SESSION['login_id']) && isset($states->{$_SESSION['login_id']})) ? $states->{$_SESSION['login_id']} : $states;
                    if ($states->{"#reviews_wrapper"} == "hide") { ?>
                        <a class="collapse_link collapsed" data-toggle="collapse" href="#reviews_wrapper"
                           aria-expanded="false"
                           aria-controls="reviews_wrapper"><?php echo TEXT_MOBILE_OPEN_COLLAPSE; ?></a>
                    <?php } else { ?>
                        <a class="collapse_link" data-toggle="collapse" href="#reviews_wrapper" aria-expanded="false"
                           aria-controls="reviews_wrapper"><?php echo TEXT_MOBILE_CLOSE_COLLAPSE; ?></a>
                    <?php }
                } ?>
            </div>
            <?php if ($states->{"#reviews_wrapper"} == "hide") { ?>
            <div class="collapse" id="reviews_wrapper" aria-expanded="false" style="height: 0">
                <?php } else { ?>
                <div class="collapse in" id="reviews_wrapper"> <?php } ?>
                    <div class="reviews_content">
                        <ul class="reviews_list">

                            <?php
                            foreach ($added_comments as $comment) {
                                $comment_link = tep_href_link('reviews.php', 'action=edit_reviews&id=' . $comment['id']);
                                ?>

                                <li>
                                    <div class="review_item">
                                        <div class="review_item_left">
                                            <a class="commentListLogo" href="<?php echo $comment_link; ?>"
                                               target="_blank">
                                                <?php echo strtoupper(mb_substr(trim($comment['name']), 0, 2, 'UTF-8')); ?>
                                            </a>
                                            <span class="review_name_model">
                                                    <a class="review_name" href="<?php echo $comment_link; ?>"
                                                       target="_blank">
                                                        <?php echo trim($comment['name']); ?>
                                                    </a>
                                                <!-- <a href="#">Модель товара</a> -->
                                                </span>
                                            <a class="reviews_item_bottom" href="<?php print $comment_link; ?>">
                                                <?php
                                                if (mb_strlen($comment['comm'], 'UTF-8') > 194) {
                                                    echo mb_substr($comment['comm'], 0, 194, 'UTF-8') . '...';
                                                } else {
                                                    echo $comment['comm'];
                                                }
                                                ?>
                                            </a>
                                            <a class="admin-answer-button"
                                               href='<?= tep_href_link('reviews.php', 'action=answer_reviews&id=' . $comment['id'] . '&products_id=' . $comment['pid']); ?>'
                                               data-src="<?= $comment['id'] ?>"><?php echo TEXT_BTN_REPLY ?></a>
                                        </div>
                                        <div class="reviews_item_right">
                                                <span class="review_date">
                                                    <?php echo date("d.m.Y", strtotime($comment['date'])); ?>
                                                    (<?php echo date("H:i", strtotime($comment['date'])); ?>)
                                                </span>
                                            <!-- <span class="review_to_answer"><?php // echo TEXT_BTN_REPLY; ?></span> -->
                                            <!--<span class="review_to_answer answered"><?php //echo TEXT_BTN_REPLY; ?></span>-->
                                        </div>
                                    </div>
                                    <?php $replies = tep_get_last_comments_reply($comment['id']); ?>
                                    <?php foreach ($replies as $reply) {
                                        $reply_link = tep_href_link('reviews.php', 'action=editreply_reviews&id=' . $reply['id']);

                                        ?>
                                        <a href="<?php echo $reply_link?>"><?php echo $reply['name'] ?>: <?php echo substr($reply['comm'], 0, strrpos($reply['comm'], ' ')); ?>...</a> <br/>
                                    <?php } ?>

                                </li>

                            <?php } ?>


                            <!--                                    --><?php
                            //                                        foreach ($added_comments as $comment) {
                            //                                            $comment_link = tep_href_link('comments.php', 'treeview=' . $comment['num']);
                            //
                            ?>
                            <!--                                        <li>-->
                            <!--                                            <div class="review_item">-->
                            <!--                                                <div class="review_item_left">-->
                            <!--                                                    <a class="commentListLogo" href="-->
                            <?php //print $comment_link;
                            ?><!--" target="_blank">-->
                            <!--                                                        --><?php //print mb_substr(trim($comment['name']), 0, 1, 'UTF-8');
                            ?>
                            <!--                                                    </a>-->
                            <!--                                                    <span class="review_name_model">-->
                            <!--                                                        <a class="review_name" href="-->
                            <?php //print $comment_link;
                            ?><!--" target="_blank">-->
                            <!--                                                            --><?php //print trim($comment['name']);
                            ?>
                            <!--                                                        </a>-->
                            <!--                                                        <a href="#">Модель товара</a>-->
                            <!--                                                    </span>-->
                            <!--                                                </div>-->
                            <!--                                                <div class="reviews_item_right">-->
                            <!--                                                    <span class="review_date">-->
                            <!--                                                        --><?php //echo date("d.m.Y", strtotime($comment['date_event']));
                            ?>
                            <!--                                                        (-->
                            <?php //echo date("H:i", strtotime($comment['date_event']));
                            ?><!--)-->
                            <!--                                                    </span>-->
                            <!--                                                    <span class="review_to_answer">Ответить</span>-->
                            <!--                                                    <span class="review_to_answer answered">Отвечено</span>-->
                            <!--                                                </div>-->
                            <!--                                                <a class="reviews_item_bottom" href="-->
                            <?php //print $comment_link;
                            ?><!--" target="_blank">-->
                            <!--                                                    --><?php
                            //                                                        if (mb_strlen($comment['comm'], 'UTF-8')>194) {
                            //                                                            print mb_substr($comment['comm'], 0, 194, 'UTF-8') . '...';
                            //                                                        } else {
                            //                                                            print $comment['comm'];
                            //                                                        }
                            //
                            ?>
                            <!--                                                </a>-->
                            <!--                                            </div>-->
                            <!--                                        </li>-->
                            <!--                                    --><?php //}
                            ?>
                        </ul>
                        <?php if (isMobile()) { ?>
                            <span class="show_all_content"><span><?php echo TEXT_MOBILE_SHOW_MORE; ?><i
                                            class="fa fa-long-arrow-down" aria-hidden="true"></i></span></span>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <!-- / events block -->
        <?php
        break;
        case 'blockGA':
            break;
        case 'getAllJs':

            include_once('footer.php');
            exit;
            break;
        case 'logNum':
            if ($_SESSION['login_lognum'] == 0) {
                $_SESSION['login_lognum'] = 1; ?>

                <div class="row admin-modal-greetings">
                    <div class="col-xs-12">
                        <h3><?php echo MODAL_GREETING ?></h3>
                    </div>
                    <div class="col-xs-12">
                        <p style="margin: 15px 0"><?php echo MODAL_GREETING_TEXT ?></p>
                    </div>
                    <div class="col-xs-12">
                        <a href="<?php echo tep_href_link(FILENAME_CONFIGURATION, 'gID=1', 'NONSSL') ?>" type="button"
                           class="btn btn-success">
                            <?php echo MODAL_BUTTON_SETTINGS ?>
                        </a>
                        <a href="<?php echo tep_href_link(FILENAME_TEMPLATE_CONFIGURATION) ?>" type="button"
                           class="btn btn-success">
                            <?php echo MODAL_BUTTON_DESIGN ?>
                        </a>
                        <a href="<?php echo tep_href_link(FILENAME_INSTRUCTIONS, 'gID=1', 'NONSSL') ?>" type="button"
                           class="btn btn-success">
                            <?php echo MODAL_BUTTON_INSTRUCTIONS ?>
                        </a>
                        <!--                            <button type="button" class="btn btn-warning pull-right" data-dismiss="modal">Close</button>-->
                    </div>
                </div>


            <?php }
            exit;


            break;

        //        case 'getHeaderMenu':
        //
        //            include_once('header.php');
        //            exit;
        //
        //            break;

        }

        exit;

        }

        // BOF: KategorienAdmin / OLISWISS
        if ($login_groups_id != 1) {
            tep_redirect(tep_href_link(FILENAME_CATEGORIES, ''));
        }
        // BOF: KategorienAdmin / OLISWISS

        $template_id_select_query = tep_db_query("select template_id from " . TABLE_TEMPLATE . "  where template_name = '" . DEFAULT_TEMPLATE . "'");
        $template_id_select = tep_db_fetch_array($template_id_select_query);

        ?>

        <?php
        include_once('html-open.php');
        include_once('header.php');
        ?>

        <div class="new_index container">
            <div class="new_index_row row" id="blockOrdersPeriod"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
            </div>
            <div class="new_index_row row" id="blockOrderStatus"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>
            <!--        <div class="new_index_row row" id="blockCounters"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>-->
            <div class="new_index_row row" id="blockOrdersSchedule"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
            </div>
            <div class="new_index_row row" id="blockEventsReviewsNews"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
            </div>
        </div>

        <?php
        $const_js = new \admin\includes\solomono\app\models\index\index();
        ?>
        <script>
            var lang = <?= $const_js->getTranslation(); ?>;
            var IS_MOBILE = <?= isMobile(); ?>
        </script>
        <?php
        include_once('footer.php');
        include_once('html-close.php');
        require(DIR_WS_INCLUDES . 'application_bottom.php');
        ?>

<?php
///**
// * header
// */
//
//include_once('html-open.php');
//include_once('html-close.php');
//
//?>