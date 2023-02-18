<?php

/*
  $Id: ot_tax.php,v 1.1.1.1 2003/09/18 19:04:57 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

class ot_tax
{
    var $title, $output;

    function __construct()
    {
        $this->code = 'ot_tax';
        $this->title = MODULE_ORDER_TOTAL_TAX_TITLE;
        $this->description = MODULE_ORDER_TOTAL_TAX_DESCRIPTION;
        $this->enabled = ((MODULE_ORDER_TOTAL_TAX_STATUS == 'true') ? true : false);
        $this->sort_order = MODULE_ORDER_TOTAL_OT_TAX_SORT_ORDER;

        $this->output = array();
    }

    function process()
    {
        global $order, $currencies;

        if (DISPLAY_PRICE_WITH_TAX === "false" && DISPLAY_PRICE_WITH_TAX_CHECKOUT === "true") {
            $this->calculateTaxesForProducts();
        }

        reset($order->info['tax_groups']);
        foreach ($order->info['tax_groups'] as $key => $value) {
            if ($value > 0) {
                $this->output[] = [
                    'title' => $key . ':',
                    'text' => $currencies->format($value, true, $order->info['currency'], $order->info['currency_value']),
                    'value' => $value,
                ];
            }
        }
    }

    function calculateTaxesForProducts()
    {
        global $order;

        foreach ($order->products as $product) {
            $taxName = tep_get_tax_description($product['tax_class_id'], $order->delivery['country']['id'], $order->delivery['zone_id'], true);
            $taxRate = tep_get_tax_rate($product['tax_class_id'], $order->delivery['country']['id'], $order->delivery['zone_id'], true);
            $taxTotal = $product['final_price'] * $product['qty'] * ($taxRate / 100);
            if (!empty($taxName) && !empty($taxTotal)) {
                //for each tax_groups summarize tax of all products with tax discount from other order_total modules (for example coupon)
                $order->info['tax_groups']["$taxName"] += $taxTotal;
                $order->info['total'] += $taxTotal;
            }
        }
        //format
        $order->info['total'] = round($order->info['total'], 2);
    }

    function check()
    {
        if (!isset($this->_check)) {
            $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_ORDER_TOTAL_TAX_STATUS'");
            $this->_check = tep_db_num_rows($check_query);
        }

        return $this->_check;
    }

    static function keys()
    {
        return array('MODULE_ORDER_TOTAL_TAX_STATUS', 'MODULE_ORDER_TOTAL_OT_TAX_SORT_ORDER');
    }

    static function install()
    {
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Показывать налог', 'MODULE_ORDER_TOTAL_TAX_STATUS', 'true', 'Вы хотите показывать налог?', '6', '1','tep_cfg_select_option(array(\'true\', \'false\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Порядок сортировки', 'MODULE_ORDER_TOTAL_OT_TAX_SORT_ORDER', '3', 'Порядок сортировки модуля.', '6', '2', now())");
    }

    function remove()
    {
        tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", static::keys()) . "')");
    }
}
