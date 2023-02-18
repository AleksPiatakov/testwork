<?php
/*
  $Id: table.php,v 1.1.1.1 2003/09/18 19:04:56 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

class table
{
    var $code, $title, $description, $icon, $enabled;

// class constructor
    function __construct()
    {
        global $order, $admin_check;

        $this->code = 'table';
        $this->title = MODULE_SHIPPING_TABLE_TEXT_TITLE;
        $this->description = MODULE_SHIPPING_TABLE_TEXT_DESCRIPTION;
        $this->sort_order = getConstantValue('MODULE_SHIPPING_TABLE_SORT_ORDER', '0');
        $this->icon = '';
        $this->tax_class = MODULE_SHIPPING_TABLE_TAX_CLASS;
        $this->enabled = ((MODULE_SHIPPING_TABLE_STATUS == 'true') ? true : false);

        if (
            $this->enabled == true && !$admin_check &&
            (int)getConstantValue('MODULE_SHIPPING_TABLE_ZONE', 0) > 0 &&
            getConstantValue('ACCOUNT_COUNTRY') == 'true' && getConstantValue('ACCOUNT_STATE') == 'true'
        ) {
            $check_flag = false;
            $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . (int)MODULE_SHIPPING_TABLE_ZONE . "' and (zone_country_id = '" . (int)$order->delivery['country']['id'] . "' or zone_country_id=0) order by zone_id");
            while ($check = tep_db_fetch_array($check_query)) {
                if ($check['zone_id'] < 1) {
                    $check_flag = true;
                    break;
                } elseif ($check['zone_id'] == $order->delivery['zone_id']) {
                    $check_flag = true;
                    break;
                }
            }

            if ($check_flag == false) {
                $this->enabled = false;
            }
        }
    }

// class methods
    function quote($method = '')
    {
        global $order, $cart, $shipping_weight, $shipping_num_boxes;

        if (MODULE_SHIPPING_TABLE_MODE == 'price') {
            $order_total = $cart->show_total();
        } else {
            $order_total = $shipping_weight;
        }

        $table_cost = preg_split("/[:,]/", MODULE_SHIPPING_TABLE_COST);
        $size = sizeof($table_cost);
        for ($i = 0, $n = $size; $i < $n; $i += 2) {
            if ($order_total <= $table_cost[$i]) {
                $shipping = $table_cost[$i + 1];
                break;
            }
        }

        if (MODULE_SHIPPING_TABLE_MODE == 'weight') {
            $shipping = $shipping * $shipping_num_boxes;
        }

        $this->quotes = array(
            'id' => $this->code,
            'module' => MODULE_SHIPPING_TABLE_TEXT_TITLE,
            'methods' => array(
                array(
                    'id' => $this->code,
                    'title' => MODULE_SHIPPING_TABLE_TEXT_WAY,
                    'cost' => $shipping + (float)MODULE_SHIPPING_TABLE_HANDLING
                )
            )
        );

        if ($this->tax_class > 0) {
            $this->quotes['tax'] = tep_get_tax_rate($this->tax_class, $order->delivery['country']['id'], $order->delivery['zone_id']);
        }

        if (tep_not_null($this->icon)) {
            $this->quotes['icon'] = tep_image($this->icon, $this->title);
        }

        return $this->quotes;
    }

    function check()
    {
        if (!isset($this->_check)) {
            $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_TABLE_STATUS'");
            $this->_check = tep_db_num_rows($check_query);
        }
        return $this->_check;
    }

    static function install()
    {
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Table method', 'MODULE_SHIPPING_TABLE_STATUS', 'true', 'Do you want to enable Table method?', '6', '0', 'tep_cfg_select_option_checkbox(array(\'true\', \'false\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Cost', 'MODULE_SHIPPING_TABLE_COST', '25:8.50,50:5.50,10000:0.00', 'The shipping cost is calculated based on the total weight of the order or the total cost of the order. For example: 25: 8.50,50: 5.50, etc ... This means that up to 25 delivery will cost 8.50, from 25 to 50 it will cost 5.50, etc.', '6', '0', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Method of calculation', 'MODULE_SHIPPING_TABLE_MODE', 'weight', 'The cost of calculating the delivery based on the total weight of the order (weight) or based on the total cost of the order (price).', '6', '0', 'tep_cfg_select_option(array(\'weight\', \'price\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Cost', 'MODULE_SHIPPING_TABLE_HANDLING', '0', 'Cost for this shipping method.', '6', '0', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Tax', 'MODULE_SHIPPING_TABLE_TAX_CLASS', '0', 'Use tax.', '6', '0', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Zone', 'MODULE_SHIPPING_TABLE_ZONE', '0', 'If zone is set, this module will available only for customers from selected zone.', '6', '0', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order', 'MODULE_SHIPPING_TABLE_SORT_ORDER', '0', 'Enter sort order for this module.', '6', '0', now())");
    }

    function remove()
    {
        tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", static::keys()) . "')");
    }

    static function keys()
    {
        return array(
            'MODULE_SHIPPING_TABLE_STATUS',
            'MODULE_SHIPPING_TABLE_COST',
            'MODULE_SHIPPING_TABLE_MODE',
            'MODULE_SHIPPING_TABLE_HANDLING',
            'MODULE_SHIPPING_TABLE_TAX_CLASS',
            'MODULE_SHIPPING_TABLE_ZONE',
            'MODULE_SHIPPING_TABLE_SORT_ORDER'
        );
    }
}
