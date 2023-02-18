<?php
/*
  WebMakers.com Added: Free Payments and Shipping
  Written by Linda McGrath osCOMMERCE@WebMakers.com
  http://www.thewebmakerscorner.com

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

class freeshipper
{
    var $code, $title, $description, $icon, $enabled;

// BOF: WebMakers.com Added: Free Payments and Shipping
// class constructor
    function __construct()
    {
        global $order, $cart, $admin_check;
        $this->code = 'freeshipper';
        $this->title = MODULE_SHIPPING_FREESHIPPER_TEXT_TITLE;
        $this->description = MODULE_SHIPPING_FREESHIPPER_TEXT_DESCRIPTION;
        $this->sort_order = getConstantValue('MODULE_SHIPPING_FREESHIPPER_SORT_ORDER', '0');
        $this->icon = DIR_WS_ICONS . 'shipping_free_shipper.jpg';
        $this->tax_class = MODULE_SHIPPING_FREESHIPPER_TAX_CLASS;
        //  $this->enabled = ((MODULE_SHIPPING_FREESHIPPER_STATUS == 'true') ? true : false);

// Only show if weight is 0
//      if ( (!strstr($PHP_SELF,'modules.php')) || $cart->show_weight()==0) {
        $this->enabled = MODULE_SHIPPING_FREESHIPPER_STATUS;

        if (
            $this->enabled == true && !$admin_check &&
            (int)getConstantValue('MODULE_SHIPPING_FREESHIPPER_ZONE', 0) > 0 &&
            getConstantValue('ACCOUNT_COUNTRY') == 'true' && getConstantValue('ACCOUNT_STATE') == 'true'
        ) {
            $check_flag = false;
            $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . (int)MODULE_SHIPPING_FREESHIPPER_ZONE . "' and (zone_country_id = '" . (int)$order->delivery['country']['id'] . "' or zone_country_id=0) order by zone_id");
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
//      }
// EOF: WebMakers.com Added: Free Payments and Shipping
    }

// class methods
    function quote($method = '')
    {
        global $order;

        if (!defined('SHIPPING_HANDLING')) {
            define('SHIPPING_HANDLING', 0);
        }

        $this->quotes = array(
            'id' => $this->code,
            'module' => MODULE_SHIPPING_FREESHIPPER_TEXT_TITLE,
            'methods' => array(
                array(
                    'id' => $this->code,
                    'title' => '<FONT COLOR=FF0000><B>' . MODULE_SHIPPING_FREESHIPPER_TEXT_WAY . '</B></FONT>',
                    'cost' => (float)SHIPPING_HANDLING + (float)MODULE_SHIPPING_FREESHIPPER_COST
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
            $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_FREESHIPPER_STATUS'");
            $this->_check = tep_db_num_rows($check_query);
        }
        return $this->_check;
    }

    static function install()
    {
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable free shipping', 'MODULE_SHIPPING_FREESHIPPER_STATUS', 'true', 'Do you want to enable free shipping?', '6', '5', 'tep_cfg_select_option_checkbox(array(\'true\', \'false\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Cost', 'MODULE_SHIPPING_FREESHIPPER_COST', '0.00', 'Cost for this shipping method.', '6', '6', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Tax', 'MODULE_SHIPPING_FREESHIPPER_TAX_CLASS', '0', 'Use tax.', '6', '0', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Zone', 'MODULE_SHIPPING_FREESHIPPER_ZONE', '0', 'If zone is set, this module will available only for customers from selected zone.', '6', '0', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order', 'MODULE_SHIPPING_FREESHIPPER_SORT_ORDER', '0', 'Enter sort order for this module.', '6', '0', now())");
    }

    function remove()
    {
        $keys = '';
        $keys_array = static::keys();
        for ($i = 0; $i < sizeof($keys_array); $i++) {
            $keys .= "'" . $keys_array[$i] . "',";
        }
        $keys = substr($keys, 0, -1);

        tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in (" . $keys . ")");
    }

    static function keys()
    {
        return array(
            'MODULE_SHIPPING_FREESHIPPER_STATUS',
            'MODULE_SHIPPING_FREESHIPPER_COST',
            'MODULE_SHIPPING_FREESHIPPER_TAX_CLASS',
            'MODULE_SHIPPING_FREESHIPPER_ZONE',
            'MODULE_SHIPPING_FREESHIPPER_SORT_ORDER'
        );
    }
}
