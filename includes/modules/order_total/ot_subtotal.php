<?php

/*
  $Id: ot_subtotal.php,v 1.1.1.1 2003/09/18 19:04:57 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

class ot_subtotal
{
    var $title, $output;

    function __construct() {
      $this->code = 'ot_subtotal';
      $this->title = MODULE_ORDER_TOTAL_SUBTOTAL_DESCRIPTION;
      $this->description = MODULE_ORDER_TOTAL_SUBTOTAL_DESCRIPTION;
      $this->enabled = ((MODULE_ORDER_TOTAL_SUBTOTAL_STATUS == 'true') ? true : false);
      $this->sort_order = MODULE_ORDER_TOTAL_OT_SUBTOTAL_SORT_ORDER;

        $this->output = array();
    }

    function process()
    {
        global $order, $currencies, $cart;

        $this->output[] = array('title' => sprintf($this->title, $cart->count_contents()) . ':',
                              'text' => $currencies->format($order->info['subtotal'], true, $order->info['currency'], $order->info['currency_value']),
                              'value' => $order->info['subtotal']);
    }

    function check()
    {
        if (!isset($this->_check)) {
            $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_ORDER_TOTAL_SUBTOTAL_STATUS'");
            $this->_check = tep_db_num_rows($check_query);
        }

        return $this->_check;
    }

    static function keys()
    {
        return array('MODULE_ORDER_TOTAL_SUBTOTAL_STATUS', 'MODULE_ORDER_TOTAL_OT_SUBTOTAL_SORT_ORDER');
    }

    static function install()
    {
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Показывать стоимость товара', 'MODULE_ORDER_TOTAL_SUBTOTAL_STATUS', 'true', 'Вы хотите показывать стоимость товара?', '6', '1','tep_cfg_select_option(array(\'true\', \'false\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Порядок сортировки', 'MODULE_ORDER_TOTAL_OT_SUBTOTAL_SORT_ORDER', '1', 'Порядок сортировки модуля.', '6', '2', now())");
    }

    function remove()
    {
        tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", static::keys()) . "')");
    }
}
