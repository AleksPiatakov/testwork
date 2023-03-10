<?php

/*
  $Id: ot_total.php,v 1.1.1.1 2003/09/18 19:04:58 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

class ot_total
{
    var $title, $output;

    function __construct()
    {
        $this->code = 'ot_total';
        $this->title = MODULE_ORDER_TOTAL_TOTAL_TITLE;
        $this->description = MODULE_ORDER_TOTAL_TOTAL_DESCRIPTION;
        $this->enabled = ((MODULE_ORDER_TOTAL_TOTAL_STATUS == 'true') ? true : false);
        $this->sort_order = MODULE_ORDER_TOTAL_OT_TOTAL_SORT_ORDER;

        $this->output = array();
    }

    function process()
    {
        global $order, $currencies;

        $this->output[] = array('title' => '<b>' . $this->title . ':</b>',
                              'text' => '<b id="ot_sum">' . $currencies->format($order->info['total'], true, $order->info['currency'], $order->info['currency_value']) . '</b>',
                              'value' => $order->info['total']);
    //  $order->info['total'] = tep_round($order->info['total'] * $order->info['currency_value'], 0);
    //  $order->info['total'] = number_format($order->info['total'] * $order->info['currency_value'],2);
        $order->info['total'] = number_format($order->info['total'] * $order->info['currency_value'], 2, '.', '');
    }

    function check()
    {
        if (!isset($this->_check)) {
            $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_ORDER_TOTAL_TOTAL_STATUS'");
            $this->_check = tep_db_num_rows($check_query);
        }

        return $this->_check;
    }

    static function keys()
    {
        return array('MODULE_ORDER_TOTAL_TOTAL_STATUS', 'MODULE_ORDER_TOTAL_OT_TOTAL_SORT_ORDER');
    }

    static function install()
    {
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('???????????????????? ??????????', 'MODULE_ORDER_TOTAL_TOTAL_STATUS', 'true', '???? ???????????? ???????????????????? ?????????? ?????????????????? ?????????????', '6', '1','tep_cfg_select_option(array(\'true\', \'false\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('?????????????? ????????????????????', 'MODULE_ORDER_TOTAL_OT_TOTAL_SORT_ORDER', '4', '?????????????? ???????????????????? ????????????.', '6', '2', now())");
    }

    function remove()
    {
        tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", static::keys()) . "')");
    }
}
