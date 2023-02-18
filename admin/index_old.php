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
            while ($i<=$days_before_today) {
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

                    if ($order_time>=$plot_day['time'] && $order_time<=$plot_days_before_today[$i + 1]['time']) {
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
        /*
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
            $data2[] = array($plot_week['time'], $plot_week['sum']*$currencies->currencies[DEFAULT_CURRENCY]['value']);
          }

          break;
        */

        /*
         * График за последние месяцы
         */
        case 'month':
            $monthes_before_this = 9;
            $this_month_time = strtotime(date('d F Y 00:00'));
            $monthes_before_this_time = strtotime(date('01 F Y', $this_month_time - (2629743 * ($monthes_before_this - 1)) + (3600 * 2)));
            $query = tep_db_query("SELECT `o`.`orders_id`, `o`.`date_purchased` AS `date_created`, `ot`.`value` FROM " . TABLE_ORDERS . " `o` LEFT JOIN " . TABLE_ORDERS_TOTAL . " `ot` ON (`o`.`orders_id` = `ot`.`orders_id`) WHERE UNIX_TIMESTAMP(`o`.`date_purchased`) >= " . $monthes_before_this_time . " AND `ot`.`class` = 'ot_total'");

            $plot_monthes_before_this = array();
            $i = 0;
            while ($i<=$monthes_before_this) {
                $plot_monthes_before_this[] = array(
                    'time' => $monthes_before_this_time * 1000,
                    'count' => 0,
                    'sum' => 0,
                );

                $monthes_before_this_time += (2629743 + (86400 * 2));
                $monthes_before_this_time = strtotime(date('01 F Y', $monthes_before_this_time));
                $i++;
            }

            while ($order = tep_db_fetch_array($query)) {
                foreach ($plot_monthes_before_this as $i => $plot_month) {
                    $order_time = strtotime($order['date_created']) * 1000;

                    if ($order_time>=$plot_month['time'] && $order_time<=$plot_monthes_before_this[$i + 1]['time']) {
                        $plot_monthes_before_this[$i]['count']++;
                        $plot_monthes_before_this[$i]['sum'] += $order['value'];

                        break;
                    }
                }
            }

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

            <div class="row text-center">
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
                $query = tep_db_query("SELECT `orders_id` FROM " . TABLE_ORDERS . " WHERE UNIX_TIMESTAMP(`date_purchased`) >= " . $today_time);
                $today_orders_ids = array();
                while ($order = tep_db_fetch_array($query)) {
                    $today_orders_ids[] = $order['orders_id'];
                }

                $today_orders_count = count($today_orders_ids);

                $today_orders_sum = 0;
                if ($today_orders_count>0) {
                    $query = tep_db_query("SELECT SUM(value) AS `sum` FROM " . TABLE_ORDERS_TOTAL . " WHERE `class` = 'ot_total' AND `orders_id` IN (" . implode(', ', $today_orders_ids) . ")");
                    $today_orders_sum = tep_db_fetch_array($query);
                    $today_orders_sum = $currencies->format($today_orders_sum['sum']);
                }

                /*
                 * Вчера
                 */
                $query = tep_db_query("SELECT orders_id FROM " . TABLE_ORDERS . " WHERE UNIX_TIMESTAMP(date_purchased) >= " . $yesterday_time . " AND UNIX_TIMESTAMP(date_purchased) < " . $today_time);
                $yesterday_orders_ids = array();
                while ($order = tep_db_fetch_array($query)) {
                    $yesterday_orders_ids[] = $order['orders_id'];
                }

                $yesterday_orders_count = count($yesterday_orders_ids);

                $yesterday_orders_sum = 0;
                if ($yesterday_orders_count>0) {
                    $query = tep_db_query("SELECT SUM(value) AS `sum` FROM " . TABLE_ORDERS_TOTAL . " WHERE `class` = 'ot_total' AND `orders_id` IN (" . implode(', ', $yesterday_orders_ids) . ")");
                    $yesterday_orders_sum = tep_db_fetch_array($query);
                    $yesterday_orders_sum = $currencies->format($yesterday_orders_sum['sum']);
                }

                /*
                 * Неделя
                 */
                $query = tep_db_query("SELECT `orders_id` FROM " . TABLE_ORDERS . " WHERE UNIX_TIMESTAMP(`date_purchased`) >= " . $week_time);
                $week_orders_ids = array();
                while ($order = tep_db_fetch_array($query)) {
                    $week_orders_ids[] = $order['orders_id'];
                }

                $week_orders_count = count($week_orders_ids);

                $week_orders_sum = 0;
                if ($week_orders_count>0) {
                    $query = tep_db_query("SELECT SUM(value) AS `sum` FROM " . TABLE_ORDERS_TOTAL . " WHERE `class` = 'ot_total' AND `orders_id` IN (" . implode(', ', $week_orders_ids) . ")");
                    $week_orders_sum = tep_db_fetch_array($query);
                    $week_orders_sum = $currencies->format($week_orders_sum['sum']);
                }

                /*
                 * Месяц
                 */
                $query = tep_db_query("SELECT orders_id FROM " . TABLE_ORDERS . " WHERE UNIX_TIMESTAMP(date_purchased) >= " . $month_time);
                $month_orders_ids = array();
                while ($order = tep_db_fetch_array($query)) {
                    $month_orders_ids[] = $order['orders_id'];
                }

                $month_orders_count = count($month_orders_ids);

                $month_orders_sum = 0;
                if ($month_orders_count>0) {
                    $query = tep_db_query("SELECT SUM(value) AS sum FROM " . TABLE_ORDERS_TOTAL . " WHERE class = 'ot_total' AND orders_id IN (" . implode(', ', $month_orders_ids) . ")");
                    $month_orders_sum = tep_db_fetch_array($query);
                    $month_orders_sum = $currencies->format($month_orders_sum['sum']);
                }

                /*
                 * Квартал
                 */
                $query = tep_db_query("SELECT orders_id FROM " . TABLE_ORDERS . " WHERE UNIX_TIMESTAMP(date_purchased) >= " . $quarter_time);
                $quarter_orders_ids = array();
                while ($order = tep_db_fetch_array($query)) {
                    $quarter_orders_ids[] = $order['orders_id'];
                }

                $quarter_orders_count = count($quarter_orders_ids);

                $quarter_orders_sum = 0;
                if ($quarter_orders_count>0) {
                    $query = tep_db_query("SELECT SUM(value) AS sum FROM " . TABLE_ORDERS_TOTAL . " WHERE class = 'ot_total' AND orders_id IN (" . implode(', ', $quarter_orders_ids) . ")");
                    $quarter_orders_sum = tep_db_fetch_array($query);
                    $quarter_orders_sum = $currencies->format($quarter_orders_sum['sum']);
                }

                /*
                 * За все время
                 */
                $query = tep_db_query("SELECT count(*) as count FROM " . TABLE_ORDERS);
                $order = tep_db_fetch_array($query);
                $all_time_orders_count = $order['count'];

                $all_time_orders_sum = 0;
                if ($all_time_orders_count>0) {
                    $query = tep_db_query("SELECT SUM(value) AS `sum` FROM " . TABLE_ORDERS_TOTAL . " WHERE `class` = 'ot_total'");
                    $all_time_orders_sum = tep_db_fetch_array($query);
                    $all_time_orders_sum = $currencies->format($all_time_orders_sum['sum']);

                }

                ?>
                <div class="col-md-2 col-xs-4">
                    <div class="h6 dayOrderStyle"><?php print TEXT_BLOCK_ORDERS_TODAY_COUNTERS; ?></div>
                    <div class="h1 m-t"><?php print $today_orders_count; ?>
                        <span class="h6 dayOrderStyle"><?php print TEXT_BLOCK_ORDERS_BY_PERIOD_COUNTERS_NOUN; ?></span>
                    </div>
                    <div class="label text-white dayOrderStyle m-b-sm m-t "><?php print TEXT_BLOCK_ORDERS_BY_PERIOD_PREFIX; ?> <?php print $today_orders_sum; ?> </div>
                </div>
                <div class="col-md-2 col-xs-4">
                    <div class="h6 h6 dayOrderStyle"><?php print TEXT_BLOCK_ORDERS_YESTERDAY_COUNTERS; ?></div>
                    <div class="h1 m-t"><?php print $yesterday_orders_count; ?>
                        <span class="h6 dayOrderStyle"><?php print TEXT_BLOCK_ORDERS_BY_PERIOD_COUNTERS_NOUN; ?></span>
                    </div>
                    <div class="label text-white dayOrderStyle m-b-sm m-t"><?php print TEXT_BLOCK_ORDERS_BY_PERIOD_PREFIX; ?> <?php print $yesterday_orders_sum; ?> </div>
                </div>
                <div class="col-md-2 col-xs-4">
                    <div class="h6 h6 dayOrderStyle"><?php print TEXT_BLOCK_ORDERS_WEEK_COUNTERS; ?></div>
                    <div class="h1 m-t"><?php print $week_orders_count; ?>
                        <span class="h6 dayOrderStyle"><?php print TEXT_BLOCK_ORDERS_BY_PERIOD_COUNTERS_NOUN; ?></span>
                    </div>
                    <div class="label text-white dayOrderStyle m-b-sm m-t"><?php print TEXT_BLOCK_ORDERS_BY_PERIOD_PREFIX; ?> <?php print $week_orders_sum; ?> </div>
                </div>
                <div class="col-md-2 col-xs-4">
                    <div class="h6 h6 dayOrderStyle"><?php print TEXT_BLOCK_ORDERS_MONTH_COUNTERS; ?></div>
                    <div class="h1 m-t"><?php print $month_orders_count; ?>
                        <span class="h6 dayOrderStyle"><?php print TEXT_BLOCK_ORDERS_BY_PERIOD_COUNTERS_NOUN; ?></span>
                    </div>
                    <div class="label text-white dayOrderStyle m-b-sm m-t"><?php print TEXT_BLOCK_ORDERS_BY_PERIOD_PREFIX; ?> <?php print $month_orders_sum; ?> </div>
                </div>
                <div class="col-md-2 col-xs-4">
                    <div class="h6 h6 dayOrderStyle"><?php print TEXT_BLOCK_ORDERS_QUARTER_COUNTERS; ?></div>
                    <div class="h1 m-t"><?php print $quarter_orders_count; ?>
                        <span class="h6 dayOrderStyle"><?php print TEXT_BLOCK_ORDERS_BY_PERIOD_COUNTERS_NOUN; ?></span>
                    </div>
                    <div class="label text-white dayOrderStyle m-b-sm m-t"><?php print TEXT_BLOCK_ORDERS_BY_PERIOD_PREFIX; ?> <?php print $quarter_orders_sum; ?> </div>
                </div>
                <div class="col-md-2 col-xs-4">
                    <div class="h6 h6 dayOrderStyle"><?php print TEXT_BLOCK_ORDERS_ALL_TIME_COUNTERS; ?></div>
                    <div class="h1 m-t"><?php print $all_time_orders_count; ?>
                        <span class="h6 dayOrderStyle"><?php print TEXT_BLOCK_ORDERS_BY_PERIOD_COUNTERS_NOUN; ?></span>
                    </div>
                    <div class="label text-white dayOrderStyle m-b-sm m-t"><?php print TEXT_BLOCK_ORDERS_BY_PERIOD_PREFIX; ?> <?php print $all_time_orders_sum; ?> </div>
                </div>
            </div>

            <?php
            exit;

            break;

        case 'blockOrderStatus':
            ?>

            <div class="panel panel-default m-b-none">
                <div class="panel-heading">
                    <a href="<?php echo tep_href_link(FILENAME_ORDERS); ?>" target="_blank"><?php print TEXT_BLOCK_ORDERS_STATUSES_COUNTERS; ?></a>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <?php

                        $orders_statuses = array();
                        $query = tep_db_query("SELECT orders_status_id, orders_status_name FROM " . TABLE_ORDERS_STATUS . " WHERE language_id = '" . (int)$languages_id . "'");
                        while ($orders_status = tep_db_fetch_array($query)) {
                            $orders_statuses[$orders_status['orders_status_id']] = $orders_status['orders_status_name'];
                        }

                        $chart_colors_hex = array(
                            '#f05050',
                            '#f4dc47',
                            '#27c24c',
                            '#23b7e5',
                            '#7266ba',
                            '#98a6ad',
                        );

                        $chart_colors_class = array(
                            'text-danger',
                            'bg-solomono',
                            'text-success',
                            'text-info',
                            'text-primary',
                            'text-muted',
                        );

                        $chart_link_href = array(
                            'status=1',
                            'status=2',
                            'status=3',
                            'status=4',
                            'status=5',
                            'status=6',
                        );

                        $order_statuses_count = 0;
                        foreach ($orders_statuses as $order_status_id => $order_status_name) {
                            if ($order_statuses_count == 6) {
                                break;
                            }

                            $status_color_hex = $chart_colors_hex[$order_statuses_count];
                            $status_color_class = $chart_colors_class[$order_statuses_count];

                            $orders_status_orders_count = tep_db_fetch_array(tep_db_query("SELECT COUNT(*) AS total FROM " . TABLE_ORDERS . " o LEFT JOIN " . TABLE_ORDERS_TOTAL . " ot ON (o.orders_id = ot.orders_id) WHERE ot.class = 'ot_total' AND o.orders_status = '" . $order_status_id . "'"));
                            $orders_status_orders_count = $orders_status_orders_count['total'];

                            ?>
                            <div class="col-md-2 col-xs-4 text-center m-b">
                                <div class="status-heading">
                                    <a href="<?php print tep_href_link(FILENAME_ORDERS, $chart_link_href[$order_statuses_count] . '&filter_on=on'); ?>" target="_blank"><?php print ucfirst($order_status_name); ?></a>
                                </div>
                                <a href="<?php print tep_href_link(FILENAME_ORDERS, $chart_link_href[$order_statuses_count] . '&filter_on=on'); ?>" target="_blank">
                                    <div ui-jq="easyPieChart" ui-options="{
                        percent: 100,
                        lineWidth: 2,
                        trackColor: '<?php print $status_color_hex; ?>',
                        barColor: '<?php print $status_color_hex; ?>',
                        scaleColor: false,
                        size: 45,
                        rotate: 45,
                        lineCap: 'butt'
                      }" class="inline m-t">
                                        <div style="background-color: <?php print $status_color_hex; ?>; border-radius: 100%;">
                                            <span class="text-white h4" style="height: 45px; width: 45px; display: inline-block; line-height: 45px;"><?php print $orders_status_orders_count; ?></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php

                            $order_statuses_count++;
                        }

                        ?>
                    </div>
                </div>
            </div>

            <?php

            break;

        /*
         * Блоки "a Товаров, b Заказов, c Комментариев..." и "Используется модулей"
         */
        case 'blockCounters':
            ?>

            <div class="row">
                <!-- stats -->
                <div class="col-md-5">
                    <div class="row text-center outer">
                        <div class="innerCounters">
                            <div class="col-xs-6">
                                <a href="<?php print tep_href_link(FILENAME_CATEGORIES, ''); ?>" target="_blank">
                                    <div class="panel padder-v item bg-info">
                                        <div class="stats-heading">
                                            <div class="text-white font-thin h1">
                                                <?php print tep_products_count(); ?>
                                            </div>
                                        </div>
                                        <span class="text-xs"><?php print TEXT_BLOCK_COUNTERS_PRODUCTS; ?></span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xs-6">
                                <a href="<?php print tep_href_link(FILENAME_ORDERS, ''); ?>" target="_blank">
                                    <div class="panel padder-v bg-success item">
                                        <div class="stats-heading">
                                            <div class="text-white font-thin h1">
                                                <?php print tep_orders_count($languages_id); ?>
                                            </div>
                                        </div>
                                        <span class="text-xs"><?php print TEXT_BLOCK_COUNTERS_ORDERS; ?></span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xs-6">
                                <a href="<?php print tep_href_link('comments.php', ''); ?>" target="_blank">
                                    <div class="panel padder-v bg-warning-dark item m-b-none">
                                        <div class="stats-heading">
                                            <div class="text-white font-thin h1">
                                                <?php print tep_comments_count(); ?>
                                            </div>
                                        </div>
                                        <span class="text-xs"><?php print TEXT_BLOCK_COUNTERS_COMMENTS; ?></span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xs-6">
                                <a href="<?php print tep_href_link(FILENAME_STATS_MONTHLY_SALES, ''); ?>" target="_blank">
                                    <div class="panel padder-v item bg-danger m-b-none">
                                        <div class="stats-heading sales-sum">
                                            <div class="text-white font-thin h1">
                                                <?php print $currencies->format(tep_orders_sum_count($languages_id)); ?>
                                            </div>
                                        </div>
                                        <span class="text-xs"><?php print TEXT_BLOCK_COUNTERS_TOTAL_INCOME; ?></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / stats -->

                <!-- using modules block -->
                <div class="col-md-7 text-center">
                    <div class="row outer">

                        <div class="col-sm-4 col-xs-12 text-center inner innerLeft ">
                            <?php $modules_count = tep_modules_count(); ?>
                            <?php $percentModulesEnabled = round((100 * tep_modules_enabled()) / ($modules_count != 0 ? $modules_count : 1), 0); ?>
                            <a href="<?php print tep_href_link(FILENAME_CONFIGURATION, 'gID=277'); ?>" target="_blank">
                                <div ui-jq="easyPieChart" ui-options="{
                      percent: <?php print $percentModulesEnabled; ?>,
                      lineWidth: 4,
                      trackColor: '#e8eff0',
                      barColor: '#23b7e5',
                      scaleColor: false,
                      size: 200,
                      rotate: 90,
                      lineCap: 'butt'
                    }" class="inline" style="width: 100px; height: 100px;">
                                    <div class="inner innerText">
                                        <div class="text-sm"><?php print TEXT_BLOCK_MODULES_STATS_USING; ?></div>
                                        <div class="text-info h1"><?php print $percentModulesEnabled ?>%</div>
                                        <div class="text-sm"><?php print TEXT_BLOCK_MODULES_STATS_MODULES; ?>
                                            <span class="font-bold">(<?php print tep_modules_enabled(); ?> <?php print TEXT_BLOCK_MODULES_STATS_AMOUNT; ?>
                                                )</span></div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-sm-8 col-xs-12 text-left inner innerRight">
                            <?php $modules = tep_modules_enabled_name(); ?>
                            <ul id="modules-list" class="row">
                                <?php foreach ($modules as $module) { ?>
                                    <li class="col-xs-6 m-b-sm<?php print tep_module_exists($module['configuration_value']) ? '' : ' text-muted'; ?>">
                                        <?php

                                        $module_link = tep_href_link(FILENAME_CONFIGURATION, 'gID=277&cID=' . $module['configuration_id']);
                                        if (tep_module_exists($module['configuration_value'])) {
                                            ?>
                                            <a class="m-r pull-left" href="<?php print $module_link; ?>" target="_blank" onclick="window.open('<?php print $module_link; ?>', '_blank');">
                                                <?php print tep_modules_block_module_button($module['configuration_value']); ?>
                                            </a>
                                            <?php
                                        } else {
                                            print tep_modules_block_module_button($module['configuration_value']);
                                        }

                                        ?>
                                        <a href="<?php print $module_link; ?>" target="_blank">
                                            <?php print constant(strtoupper($module['configuration_key'] . '_TITLE')); ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>

                    </div>

                </div>
                <!-- / using modules block -->

            </div>
            <script>
                uiLoad.load(jp_config['easyPieChart']);
            </script>
            <?php

            break;

        case 'blockOrdersSchedule':
            ?>

            <div class="row">
                <div class="col-md-6">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                  <span class="text-info">
                    <i class="icon-share"></i>
                    <span class="m-l-xs h4 font-thin"><?php print TEXT_BLOCK_OVERVIEW_TITLE; ?></span>
                  </span>
                        </div>
                        <div class="panel-body">
                            <div class="tab-container m-b-none">
                                <ul id="overview-tabs" class="nav nav-pills">
                                    <li>
                                        <a href="#latest-orders" data-toggle="pill"><?php print TEXT_BLOCK_OVERVIEW_LATEST_ORDERS; ?></a>
                                    </li>
                                    <li>
                                        <a href="#most-viewed" data-toggle="pill"><?php print TEXT_BLOCK_OVERVIEW_MOST_VIEWED; ?></a>
                                    </li>
                                    <li>
                                        <a href="#most-sold" data-toggle="pill"><?php print TEXT_BLOCK_OVERVIEW_MOST_SOLD; ?></a>
                                    </li>
                                    <li>
                                        <a href="#top-categories" data-toggle="pill"><?php print TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES; ?></a>
                                    </li>
                                    <li>
                                        <a href="#most-searches" data-toggle="pill"><?php print TEXT_BLOCK_OVERVIEW_MOST_SEARCHED; ?></a>
                                    </li>
                                </ul>
                                <div class="tab-content no-padder no-borders wrapper-scroll" style="height: 318px;">
                                    <div id="latest-orders" class="tab-pane fade">
                                        <?php


                                          $orders_statuses = array();
                                          $query = tep_db_query("SELECT orders_status_id, orders_status_name FROM " . TABLE_ORDERS_STATUS . " WHERE language_id = '" . (int)$languages_id . "'");
                                          while ($orders_status = tep_db_fetch_array($query)) {
                                              $orders_statuses[$orders_status['orders_status_id']] = $orders_status['orders_status_name'];
                                          }
                                          
                                          //$query = tep_db_query("SELECT o.orders_id AS id, o.customers_id, o.customers_name, UNIX_TIMESTAMP(o.date_purchased) AS date_created, ot.value AS amount, o.orders_status AS status_id, os.orders_status_name AS status FROM " . TABLE_ORDERS . " o LEFT JOIN " . TABLE_ORDERS_TOTAL . " ot ON (o.orders_id = ot.orders_id) LEFT JOIN " . TABLE_ORDERS_STATUS . " os ON (o.orders_status = os.orders_status_id) WHERE ot.class = 'ot_total' AND os.language_id = '" . $languages_id . "' ORDER BY o.date_purchased DESC LIMIT 20");
                                          $query = tep_db_query("SELECT o.orders_id AS id, o.customers_id, o.customers_name, UNIX_TIMESTAMP(o.date_purchased) AS date_created, ot.value AS amount, o.orders_status AS status_id FROM " . TABLE_ORDERS . " o LEFT JOIN " . TABLE_ORDERS_TOTAL . " ot ON (o.orders_id = ot.orders_id) WHERE ot.class = 'ot_total' ORDER BY o.date_purchased DESC LIMIT 20");

                                        ?>
                                        <table class="table table-striped m-b-none">
                                            <tr>
                                                <th><?php print TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_CUSTOMER_NAME; ?></th>
                                                <th><?php print TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_DATE; ?></th>
                                                <th><?php print TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_AMOUNT; ?></th>
                                                <th><?php print TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_STATUS; ?></th>
                                                <th></th>
                                            </tr>

                                            <?php
                                            $order_statuses_colors = array(
                                                '1' => 'bg-danger text-white',
                                                '2' => 'text-white" style="background-color: #98a6ad;"',
                                                '3' => 'bg-success text-white',
                                                '4' => 'bg-info text-white',
                                                '5' => 'bg-primary text-white',
                                                '6' => 'text-white" style="background-color: #98a6ad;"',
                                                '7' => 'text-white" style="background-color: #98a6ad;"',
                                                '8' => 'text-white" style="background-color: #98a6ad;"',
                                            );

                                            while ($order = tep_db_fetch_array($query)) {
                                                ?>
                                                <tr>
                                                    <td class="text-info text-xs">
                                                        <a class="text-ellipsis inline" href="<?php print tep_href_link(FILENAME_CUSTOMERS, 'cID=' . $order['customers_id']); ?>" target="_blank" data-toggle="tooltip" data-placement="right" title="<?php print $order['customers_name']; ?>"><?php print $order['customers_name']; ?></a>
                                                    </td>
                                                    <td class="text-xs">
                                                        <?php print date('d.m.Y', $order['date_created']); ?>
                                                    </td>
                                                    <td class="text-xs">
                                                        <?php print $currencies->format($order['amount']); ?>
                                                    </td>
                                                    <td>
                                                        <span class="label <?php print $order_statuses_colors[$order['status_id']]?:'bg-danger text-white'; ?>"><?php print $orders_statuses[$order['status_id']]; ?></span>
                                                    </td>
                                                    <td class="text-info">
                                                        <a href="<?php print tep_href_link(FILENAME_ORDERS, 'oID=' . $order['id'] . '&action=edit'); ?>" title="<?php print TEXT_BLOCK_OVERVIEW_ACTION_EDIT; ?>">
                                                            <i class="fa fa-edit"></i></a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }

                                            ?>

                                        </table>
                                    </div>
                                    <div id="most-viewed" class="tab-pane fade">
                                        <?php

                                        $query = tep_db_query("SELECT `pd`.`products_id` AS `id`, `pd`.`products_name` AS `name`, `pd`.`products_viewed` AS `views`, `p`.`products_image` AS `images` FROM " . TABLE_PRODUCTS_DESCRIPTION . " `pd` LEFT JOIN " . TABLE_PRODUCTS . " `p` ON (`pd`.`products_id` = `p`.`products_id`) WHERE `pd`.`language_id` = " . $languages_id . " AND `pd`.`products_viewed` > 0 ORDER BY `pd`.`products_viewed` DESC LIMIT 20");

                                        ?>
                                        <table class="table table-striped m-b-none">
                                            <tr>
                                                <th>ID</th>
                                                <th><?php print TEXT_BLOCK_OVERVIEW_MOST_VIEWED_PRODUCT_IMAGE; ?></th>
                                                <th><?php print TEXT_BLOCK_OVERVIEW_MOST_VIEWED_PRODCUT_NAME; ?></th>
                                                <th><?php print TEXT_BLOCK_OVERVIEW_MOST_VIEWED_VIEWS; ?></th>
                                                <th></th>
                                            </tr>

                                            <?php

                                            while ($product = tep_db_fetch_array($query)) {
                                                $image_file_name = explode(';', $product['images']);
                                                if($image_file_name[0]!='') $image_file_name = '../getimage/50x50/products/' . $image_file_name[0] . '';
                                                else $image_file_name = '../getimage/50x50/products/default.png';

                                                ?>
                                                <tr>
                                                    <td class="text-xs">
                                                        <?php print $product['id']; ?>
                                                    </td>
                                                    <td>
                                                        <img src="<?php print $image_file_name; ?>" alt="<?php print $product['name']; ?>" title="<?php print $product['name']; ?>">
                                                    </td>
                                                    <td class="text-xs">
                                                        <?php print $product['name']; ?>
                                                    </td>
                                                    <td class="text-xs">
                                                        <?php print $product['views']; ?>
                                                    </td>
                                                    <td class="text-info text-xs">
                                                        <a href="<?php echo DIR_WS_CATALOG; ?>product_info.php?products_id=<?php print $product['id']; ?>" target="_blank"><?php print TEXT_BLOCK_OVERVIEW_ACTION_VIEW; ?></a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }

                                            ?>

                                        </table>
                                    </div>
                                    <div id="most-sold" class="tab-pane fade">
                                        <?php

                                        $query = tep_db_query("SELECT pd.products_id AS id, pd.products_name AS name, p.products_ordered as orders, p.products_image AS images FROM " . TABLE_PRODUCTS_DESCRIPTION . " pd LEFT JOIN " . TABLE_PRODUCTS . " p ON (pd.products_id = p.products_id) WHERE pd.language_id = " . $languages_id . " AND p.products_ordered > 0 ORDER BY p.products_ordered DESC LIMIT 20");

                                        ?>
                                        <table class="table table-striped m-b-none">
                                            <tr>
                                                <th>ID</th>
                                                <th><?php print TEXT_BLOCK_OVERVIEW_MOST_SOLD_PRODUCT_IMAGE; ?></th>
                                                <th><?php print TEXT_BLOCK_OVERVIEW_MOST_SOLD_PRODCUT_NAME; ?></th>
                                                <th><?php print TEXT_BLOCK_OVERVIEW_MOST_SOLD_ORDERS; ?></th>
                                                <th></th>
                                            </tr>

                                            <?php

                                            while ($product = tep_db_fetch_array($query)) {
                                                $image_file_name = explode(';', $product['images']);
                                                if($image_file_name[0]!='') $image_file_name = '../getimage/50x50/products/' . $image_file_name[0];
                                                else $image_file_name = '../getimage/50x50/products/default.png';

                                                ?>
                                                <tr>
                                                    <td class="text-xs">
                                                        <?php print $product['id']; ?>
                                                    </td>
                                                    <td>
                                                        <img src="<?php print $image_file_name; ?>" alt="<?php print $product['name']; ?>" title="<?php print $product['name']; ?>">
                                                    </td>
                                                    <td class="text-xs">
                                                        <?php print $product['name']; ?>
                                                    </td>
                                                    <td class="text-xs">
                                                        <?php print $product['orders']; ?>
                                                    </td>
                                                    <td class="text-info text-xs">
                                                        <a href="<?php echo DIR_WS_CATALOG; ?>product_info.php?products_id=<?php print $product['id']; ?>" target="_blank"><?php print TEXT_BLOCK_OVERVIEW_ACTION_VIEW; ?></a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }

                                            ?>

                                        </table>
                                    </div>
                                    <div id="top-categories" class="tab-pane fade">
                                        <?php

                                        $categories = array();
                                        $subquery = tep_db_query("SELECT p.products_id AS id, p.products_ordered AS orders, ptc.categories_id AS id, cd.categories_name as name FROM " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " ptc LEFT JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd ON (ptc.categories_id = cd.categories_id) WHERE cd.language_id = " . $languages_id . " AND p.products_ordered > 0 AND ptc.products_id = p.products_id ");

                                        while ($category = tep_db_fetch_array($subquery)) {
                                            $category['orders'] += $category['orders'];

                                            if (isset($categories[$category['id']])) {
                                                $categories[$category['id']]['orders'] += $category['orders'];
                                            } else {
                                                $categories[$category['id']] = $category;
                                            }
                                        }

                                        $sort_order = array();
                                        foreach ($categories as $category_id => $category) {
                                            $sort_order[$category_id] = $category['orders'];
                                        }

                                        array_multisort($sort_order, SORT_DESC, $categories);

                                        ?>
                                        <table class="table table-striped m-b-none">
                                            <tr>
                                                <th>ID</th>
                                                <th><?php print TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES_CATEGORY_NAME; ?></th>
                                                <th><?php print TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES_ORDERS; ?></th>
                                                <th></th>
                                            </tr>
                                            <?php

                                            $counter = 0;
                                            foreach ($categories as $category) {
                                                if ($counter == 20) {
                                                    break;
                                                }

                                                ?>
                                                <tr>
                                                    <td class="text-xs">
                                                        <?php print $category['id']; ?>
                                                    </td>
                                                    <td class="text-xs">
                                                        <?php print $category['name']; ?>
                                                    </td>
                                                    <td class="text-xs">
                                                        <?php print $category['orders']; ?>
                                                    </td>
                                                    <td class="text-info text-xs">
                                                        <a href="<?php echo DIR_WS_CATALOG; ?>index.php?cPath=<?php print $category['id']; ?>" target="_blank"><?php print TEXT_BLOCK_OVERVIEW_ACTION_VIEW; ?></a>
                                                    </td>
                                                </tr>
                                                <?php

                                                $counter++;
                                            }

                                            ?>

                                        </table>
                                    </div>
                                    <div id="most-searches" class="tab-pane fade">
                                        <?php

                                        $query = tep_db_query("SELECT search_text AS text, search_count AS count FROM search_queries_sorted ORDER BY search_count DESC LIMIT 20");

                                        ?>
                                        <table class="table table-striped m-b-none">
                                            <tr>
                                                <th><?php print TEXT_BLOCK_OVERVIEW_MOST_SEARCHED_QUERY; ?></th>
                                                <th><?php print TEXT_BLOCK_OVERVIEW_MOST_SEARCHED_COUNT; ?></th>
                                                <?php

                                                while ($search_query = tep_db_fetch_array($query)) {
                                                ?>
                                            <tr>
                                                <td class="text-xs"><?php print $search_query['text']; ?></td>
                                                <td class="text-xs"><?php print $search_query['count']; ?></td>
                                            </tr>
                                            <?php
                                            }

                                            ?>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading bg-black-opacity-important">
                  <span class="text-white">
                    <i class="icon-bar-chart"></i>
                    <span class="m-l-xs h4 font-thin"><?php print TEXT_BLOCK_PLOT_TITLE; ?></span>
                  </span>
                        </div>
                        <div class="panel-body bg-black dker wrapper-lg item">
                            <ul class="nav nav-pills nav-xxs nav-rounded m-b-lg">
                                <li class="active">
                                    <a class="plot-link" href data-period="month"><?php print TEXT_BLOCK_PLOT_TAB_BY_MONTHES; ?></a>
                                </li>
                                <?php /* ?>
                    <li><a class="plot-link" href data-period="week"><?php print TEXT_BLOCK_PLOT_TAB_BY_WEEKS; ?></a></li>
                    <?php */ ?>
                                <li>
                                    <a class="plot-link" href data-period="day"><?php print TEXT_BLOCK_PLOT_TAB_BY_DAYS; ?></a>
                                </li>
                            </ul>
                            <div id="plot" style="min-height:300px"></div>
                            <div class="bg-black dker w-full h-full top text-info h2 spinner">
                                <i class="fa fa-spinner fa-spin pos-abt t-n b-n l-n r-n m-auto w-half-xxs h-half-xxs"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                uiLoad.load(jp_config['plot']);
            </script>
            <?php

            break;

        case 'blockEventsReviewsNews':
            ?>

            <!-- events block -->
            <div class="row">
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

                /**
                 * останні коментарі
                 */
                $added_comments = tep_get_last_comments($limit);

                /**
                 * 20 нещодавних подій (об'єднання попередніх)
                 */

                $last_events = array_merge($orders, $customers, $added_product, $entered_admin, $added_comments);

                uasort($last_events, 'datediff');

                ?>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading nav-tabs-alt">
                            <span class="pull-left"><?php print TEXT_BLOCK_EVENTS_TITLE; ?></span>
                            <!-- tabs -->
                            <ul id="events-tabs" class="nav nav-tabs pull-right border-color-none" role="tablist">
                                <li class="active">
                                    <a data-target="#tab-1" role="tab" data-toggle="tab" class="p-none border-color-none">
                                        <i class="fa fa-list-ul text-md text-info wrapper-sm" data-toggle="tooltip" data-placement="bottom" title="<?php print TEXT_BLOCK_EVENTS_TOOLTIP_ALL_EVENTS; ?>"></i>
                                    </a>
                                </li>
                                <li>
                                    <a data-target="#tab-2" role="tab" data-toggle="tab" class="p-none border-color-none">
                                        <i class="fa fa-user text-md text-warning wrapper-sm" data-toggle="tooltip" data-placement="bottom" title="<?php print TEXT_BLOCK_EVENTS_TOOLTIP_ADMINS; ?>"></i>
                                    </a>
                                </li>
                                <li>
                                    <a data-target="#tab-3" role="tab" data-toggle="tab" class="p-none border-color-none">
                                        <i class="fa fa-dollar text-md text-success wrapper-sm" data-toggle="tooltip" data-placement="bottom" title="<?php print TEXT_BLOCK_EVENTS_TOOLTIP_ORDERS; ?>"></i>
                                    </a>
                                </li>
                                <li>
                                    <a data-target="#tab-4" role="tab" data-toggle="tab" class="p-none border-color-none">
                                        <i class="fa fa-heart text-md text-danger wrapper-sm" data-toggle="tooltip" data-placement="bottom" title="<?php print TEXT_BLOCK_EVENTS_TOOLTIP_CUSTOMERS; ?>"></i>
                                    </a>
                                </li>
                                <li>
                                    <a data-target="#tab-5" role="tab" data-toggle="tab" class="p-none border-color-none">
                                        <i class="fa fa-cube text-md text-primary wrapper-sm" data-toggle="tooltip" data-placement="top" title="<?php print TEXT_BLOCK_EVENTS_TOOLTIP_NEW_PRODUCTS; ?>"></i>
                                    </a>
                                </li>
                                <li>
                                    <a data-target="#tab-6" role="tab" data-toggle="tab" class="p-none border-color-none">
                                        <i class="fa fa-comments text-md text-warning wrapper-sm" data-toggle="tooltip" data-placement="top" title="<?php print TEXT_BLOCK_EVENTS_TOOLTIP_COMMENTS; ?>"></i>
                                    </a>
                                </li>
                            </ul>
                            <!-- /tabs -->
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body tab-content wrapper-scroll" style="height: 250px;">
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
                                                <span class="pull-left thumb-sm"><i class="fa fa-user text-md text-warning wrapper-sm"></i></span>
                                                <div class="media-body">
                                                    <div class="pull-right text-center m-r-10">
                                                        <small class="block m-t-sm dateEventInfo">
                                                            <span class="text-muted"><?php echo date("d-m-Y", strtotime($admin['date_event'])); ?></span>
                                                            <span class=""><?php echo date("H:i:s", strtotime($admin['date_event'])); ?></span>
                                                        </small>
                                                    </div>
                                                    <small class="block m-t-sm m-b-sm">
                                                        <?php

                                                        printf(TEXT_BLOCK_EVENTS_MESSAGE_ADMINS, '<a class="text-info" href="' . tep_href_link(FILENAME_ADMIN_MEMBERS, 'mID=' . $admin['admin_id']) . '" target="_blank">' . $admin['admin_firstname'] . ' ' . $admin['admin_lastname'] . '</a>');

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
                                                <span class="pull-left thumb-sm"><i class="fa fa-comments text-md text-warning wrapper-sm"></i></span>
                                                <div class="media-body">
                                                    <div class="pull-right text-center  m-r-10">
                                                        <small class="block m-t-sm dateEventInfo">
                                                            <span class="text-muted"><?php echo date("d-m-Y", strtotime($comment['date_event'])); ?></span>
                                                            <span class=""><?php echo date("H:i:s", strtotime($comment['date_event'])); ?></span>
                                                        </small>
                                                    </div>
                                                    <small class="block m-t-sm m-b-sm">
                                                        <?php

                                                        printf(TEXT_BLOCK_EVENTS_MESSAGE_COMMENTS, '<a class="text-info" href="" target="_blank">' . $comment['name'] . '</a>');

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
                                                <span class="pull-left thumb-sm"><i class="fa fa-cube text-md text-primary wrapper-sm"></i></span>
                                                <div class="media-body">
                                                    <div class="pull-right text-center  m-r-10">
                                                        <small class="block m-t-sm dateEventInfo">
                                                            <span class="text-muted"><?php echo date("d-m-Y", strtotime($product['date_event'])); ?></span>
                                                            <span class=""><?php echo date("H:i:s", strtotime($product['date_event'])); ?></span>
                                                        </small>
                                                    </div>
                                                    <small class="block m-t-sm m-b-sm">
                                                        <?php

                                                        printf(TEXT_BLOCK_EVENTS_MESSAGE_NEW_PRODUCTS, '<a class="text-info" href="' . tep_href_link(FILENAME_PRODUCTS, 'pID=' . $product['products_id'] . '&action=new_product') . '" target="_blank">' . $product['products_name'] . '</a>');

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
                                                <span class="pull-left thumb-sm"><i class="fa fa-heart text-md text-danger wrapper-sm"></i></span>
                                                <div class="media-body">
                                                    <div class="pull-right text-center  m-r-10">
                                                        <small class="block m-t-sm dateEventInfo">
                                                            <span class="text-muted"><?php echo date("d-m-Y", strtotime($customer['date_event'])); ?></span>
                                                            <span class=""><?php echo date("H:i:s", strtotime($customer['date_event'])); ?></span>
                                                        </small>
                                                    </div>
                                                    <small class="block m-t-sm m-b-sm">
                                                        <?php

                                                        printf(TEXT_BLOCK_EVENTS_MESSAGE_CUSTOMERS, '<a class="text-info" href="' . tep_href_link(FILENAME_CUSTOMERS, 'cID=' . $customer['customers_id']) . '" target="_blank">' . $customer['customers_lastname'] . ' ' . $customer['customers_firstname'] . '</a>');

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
                                                <span class="pull-left thumb-sm"><i class="fa fa-dollar text-md wrapper-sm text-success"></i></span>
                                                <div class="media-body">
                                                    <div class="pull-right text-center  m-r-10">
                                                        <small class="block m-t-sm dateEventInfo">
                                                            <span class="text-muted"><?php echo date("d-m-Y", strtotime($order['date_event'])); ?></span>
                                                            <span class=""><?php echo date("H:i:s", strtotime($order['date_event'])); ?></span>
                                                        </small>
                                                    </div>
                                                    <small class="block m-t-sm m-b-sm">
                                                        <?php

                                                        printf(TEXT_BLOCK_EVENTS_MESSAGE_ORDERS, '<a class="text-info" href="' . tep_href_link(FILENAME_ORDERS, tep_get_all_get_params(array(
                                                                    'oID',
                                                                    'action'
                                                                )) . 'oID=' . $order['orders_id'] . '&action=edit') . '" target="_blank">' . sprintf(TEXT_BLOCK_EVENTS_MESSAGE_ORDERS_2, $order['orders_id']) . '</a>');

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
                                        <span class="pull-left thumb-sm"><i class="fa fa-user text-md text-warning wrapper-sm"></i></span>
                                        <div class="media-body">
                                            <div class="pull-right text-center  m-r-10">
                                                <small class="block m-t-sm dateEventInfo">
                                                    <span class="text-muted"><?php echo date("d-m-Y", strtotime($admin['date_event'])); ?></span>
                                                    <span class=""><?php echo date("H:i:s", strtotime($admin['date_event'])); ?></span>
                                                </small>
                                            </div>
                                            <small class="block m-t-sm m-b-sm">
                                                <?php

                                                printf(TEXT_BLOCK_EVENTS_MESSAGE_ADMINS, '<a class="text-info" href="' . tep_href_link(FILENAME_ADMIN_MEMBERS, 'mID=' . $admin['admin_id']) . '" target="_blank">' . $admin['admin_firstname'] . ' ' . $admin['admin_lastname'] . '</a>');

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
                                        <span class="pull-left thumb-sm"><i class="fa fa-dollar text-md wrapper-sm icon text-success"></i></span>
                                        <div class="media-body">
                                            <div class="pull-right text-center  m-r-10">
                                                <small class="block m-t-sm dateEventInfo">
                                                    <span class="text-muted"><?php echo date("d-m-Y", strtotime($order['date_event'])); ?></span>
                                                    <span class=""><?php echo date("H:i:s", strtotime($order['date_event'])); ?></span>
                                                </small>
                                            </div>
                                            <small class="block m-t-sm m-b-sm">
                                                <?php

                                                printf(TEXT_BLOCK_EVENTS_MESSAGE_ORDERS, '<a class="text-info" href="' . tep_href_link(FILENAME_ORDERS, tep_get_all_get_params(array(
                                                            'oID',
                                                            'action'
                                                        )) . 'oID=' . $order['orders_id'] . '&action=edit') . '" target="_blank">' . sprintf(TEXT_BLOCK_EVENTS_MESSAGE_ORDERS_2, $order['orders_id']) . '</a>');

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
                                        <span class="pull-left thumb-sm"><i class="fa fa-heart text-md text-danger wrapper-sm"></i></span>
                                        <div class="media-body">
                                            <div class="pull-right text-center  m-r-10">
                                                <small class="block m-t-sm dateEventInfo">
                                                    <span class="text-muted"><?php echo date("d-m-Y", strtotime($customer['date_event'])); ?></span>
                                                    <span class=""><?php echo date("H:i:s", strtotime($customer['date_event'])); ?></span>
                                                </small>
                                            </div>
                                            <small class="block m-t-sm m-b-sm">
                                                <?php

                                                printf(TEXT_BLOCK_EVENTS_MESSAGE_CUSTOMERS, '<a class="text-info" href="' . tep_href_link(FILENAME_CUSTOMERS, 'cID=' . $customer['customers_id']) . '" target="_blank">' . $customer['customers_lastname'] . ' ' . $customer['customers_firstname'] . '</a>');

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
                                        <span class="pull-left thumb-sm"><i class="fa fa-cube text-md text-primary wrapper-sm"></i></span>
                                        <div class="media-body">
                                            <div class="pull-right text-center  m-r-10">
                                                <small class="block m-t-sm dateEventInfo">
                                                    <span class="text-muted"><?php echo date("d-m-Y", strtotime($product['date_event'])); ?></span>
                                                    <span class=""><?php echo date("H:i:s", strtotime($product['date_event'])); ?></span>
                                                </small>
                                            </div>
                                            <small class="block m-t-sm m-b-sm">
                                                <?php

                                                printf(TEXT_BLOCK_EVENTS_MESSAGE_NEW_PRODUCTS, '<a class="text-info" href="' . tep_href_link(FILENAME_PRODUCTS, 'pID=' . $product['products_id'] . '&action=new_product') . '" target="_blank">' . $product['products_name'] . '</a>');

                                                ?>
                                            </small>
                                        </div>
                                    </div>


                                <?php } ?>
                            </div>
                            <!-- /lastProducts tab -->

                            <!-- lastComments tab -->
                            <div role="tabpanel" class="tab-pane" id="tab-6">
                                <?php foreach ($added_comments as $comment) { ?>

                                    <div class="media eventStyle">
                                        <span class="pull-left thumb-sm"><i class="fa fa-comments text-md text-warning wrapper-sm"></i></span>
                                        <div class="media-body">
                                            <div class="pull-right text-center  m-r-10">
                                                <small class="block m-t-sm dateEventInfo">
                                                    <span class="text-muted"><?php echo date("d-m-Y", strtotime($comment['date_event'])); ?></span>
                                                    <span class=""><?php echo date("H:i:s", strtotime($comment['date_event'])); ?></span>
                                                </small>
                                            </div>
                                            <small class="block m-t-sm m-b-sm">
                                                <?php

                                                printf(TEXT_BLOCK_EVENTS_MESSAGE_COMMENTS, '<a class="text-info" href="' . $comment['url'] . '#tab-comments" target="_blank">' . $comment['name'] . '</a>');

                                                ?>
                                            </small>
                                        </div>
                                    </div>


                                <?php } ?>
                            </div>
                            <!-- /lastComments tab -->

                        </div>

                    </div>
                </div>
                <?php

                $limit = 20;

                /**
                 * останні коментарі
                 */
                $added_comments = tep_get_last_comments($limit);

                ?>
                <div class="col-md-4 connected">
                    <div class="panel panel-default" draggable="true">
                        <div class="panel-heading">
                            <?php print TEXT_BLOCK_COMMENTS_TITLE; ?>
                        </div>
                        <ul class="list-group alt wrapper-scroll" style="height: 250px;">

                            <?php

                            foreach ($added_comments as $comment) {
                                $comment_link = tep_href_link('comments.php', 'treeview=' . $comment['num']);

                                ?>
                                <li class="list-group-item">
                                    <div class="media">
                        <span class="pull-left thumb-sm">
                          <a href="<?php print $comment_link; ?>" target="_blank">
                            <span class="img-circle commentListLogo"><?php print mb_substr(trim($comment['name']), 0, 1, 'UTF-8'); ?></span>
                          </a>
                        </span>
                                        <div class="m-t-xs">
                                            <a href="<?php print $comment_link; ?>" class="text-info m-r-10" target="_blank"><?php print trim($comment['name']); ?></a>
                                            <div class="pull-right text-center  m-r-10">
                                                <small class="block dateCommentInfo">
                                                    <span class="text-muted"><?php echo date("d-m-Y", strtotime($comment['date_event'])); ?></span>
                                                    <span class=""><?php echo date("H:i:s", strtotime($comment['date_event'])); ?></span>
                                                </small>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="media-body">
                                            <small class="text-muted">
                                                <a href="<?php print $comment_link; ?>" target="_blank">
                                                    <?php

                                                    if (mb_strlen($comment['comm'], 'UTF-8')>194) {
                                                        print mb_substr($comment['comm'], 0, 194, 'UTF-8') . '...';
                                                    } else {
                                                        print $comment['comm'];
                                                    }

                                                    ?>
                                                </a>
                                            </small>
                                        </div>
                                    </div>
                                </li>

                            <?php } ?>

                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default" draggable="true">
                        <div class="panel-heading">
                            <?php print TEXT_BLOCK_NEWS_TITLE; ?>
                        </div>
                        <div class="panel-body" style="height: 250px;overflow: hidden;">
                            <iframe id="news" src="https://solomono.net/<?php echo $languages_code;?>/news.php"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / events block -->

            <?php

            break;

        case 'blockGA':
          /*  ?>

            <div class="panel panel-default m-b-none">
                <div class="panel-heading">
                    <?php print TEXT_BLOCK_GA_TITLE; ?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="embed-api-auth-container"></div>
                            <div id="view-selector-container"></div>
                        </div>
                        <div class="col-md-6">
                            <div id="data-chart-1-container"></div>
                        </div>
                        <div class="col-md-6">
                            <div id="data-chart-2-container"></div>
                        </div>
                    </div>
                </div>
            </div>

            <?php */

            break;

        case 'getAllJs':

            include_once('footer.php');
            exit;

            break;

        case 'logNum':
            if ($_SESSION['login_lognum'] == 0) {
                $_SESSION['login_lognum'] = 1; ?>

                <div class="row">
                    <div class="col-xs-12">
                        <h3><?php echo MODAL_GREETING?></h3>
                    </div>
                    <div class="col-xs-12">
                        <p style="margin: 15px 0"><?php echo MODAL_GREETING_TEXT?></p>
                    </div>
                    <div class="col-xs-12">
                        <a href="<?php echo tep_href_link(FILENAME_CONFIGURATION, 'gID=1', 'NONSSL')?>" type="button" class="btn btn-success">
                            <?php echo MODAL_BUTTON_SETTINGS?>
                        </a>
                        <a href="<?php echo tep_href_link(FILENAME_TEMPLATE_CONFIGURATION)?>" type="button" class="btn btn-success">
                            <?php echo MODAL_BUTTON_DESIGN?>
                        </a>
                        <button type="button" class="btn btn-warning pull-right" data-dismiss="modal">Close</button>
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
$sql = "select admin_redirect_link_from_index from " . TABLE_ADMIN_GROUPS . " where admin_groups_id = ".$login_groups_id;
$login_admin_redirect_link_from_index = tep_db_fetch_array(tep_db_query($sql))['admin_redirect_link_from_index'];
if ($login_groups_id != 1 && !empty($login_admin_redirect_link_from_index) && $login_admin_redirect_link_from_index != FILENAME_DEFAULT) {
    tep_redirect(tep_href_link($login_admin_redirect_link_from_index, ''));
}
// BOF: KategorienAdmin / OLISWISS

$template_id_select_query = tep_db_query("select template_id from " . TABLE_TEMPLATE . "  where template_name = '" . DEFAULT_TEMPLATE . "'");
$template_id_select = tep_db_fetch_array($template_id_select_query);

?>

<?php
include_once('html-open.php');
include_once('header.php');
?>

            <div class="app-content-body p-b-none">
                <div class="hbox hbox-auto-xs hbox-auto-sm">
                    <div class="col">
                        <!-- main -->
                        <div class="wrapper-md" id="blockOrdersPeriod"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>
                        <div class="wrapper-md" id="blockOrderStatus"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>
                        <div class="wrapper-md" id="blockCounters"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>
                        <div class="wrapper-md" id="blockOrdersSchedule"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>
                        <div class="wrapper-md" id="blockEventsReviewsNews"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>
<!--                        <div class="wrapper-md" id="blockGA"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>-->
                        <!-- / main -->
                    </div>
                </div>
            </div>


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