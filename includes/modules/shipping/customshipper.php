<?php
/*
  $Id: flat.php,v 1.1.1.1 2003/09/18 19:04:54 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

class customshipper
{
    var $code, $title, $description, $icon, $enabled;

// class constructor
    function __construct()
    {
        global $order, $admin_check;

        $this->code = 'customshipper';
        $this->title = MODULE_SHIPPING_CUSTOMSHIPPER_NAME;
        //   $this->description = MODULE_SHIPPING_CUSTOMSHIPPER_TEXT_DESCRIPTION;
        $this->sort_order = getConstantValue('MODULE_SHIPPING_CUSTOMSHIPPER_SORT_ORDER', '0');
        $this->icon = '';
        $this->tax_class = getConstantValue('MODULE_SHIPPING_CUSTOMSHIPPER_TAX_CLASS', '');
        $this->enabled = getConstantValue('MODULE_SHIPPING_CUSTOMSHIPPER_STATUS', 'false') == 'true';

        if (
            $this->enabled == true && !$admin_check &&
            (int)getConstantValue('MODULE_SHIPPING_CUSTOMSHIPPER_ZONE', 0) > 0 &&
            getConstantValue('ACCOUNT_COUNTRY') == 'true' && getConstantValue('ACCOUNT_STATE') == 'true'
        ) {
            $check_flag = false;
            $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . (int)MODULE_SHIPPING_CUSTOMSHIPPER_ZONE . "' and (zone_country_id = '" . (int)$order->delivery['country']['id'] . "' or zone_country_id=0) order by zone_id");
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
        global $order;

        $this->quotes = array(
            'id' => $this->code,
            'module' => MODULE_SHIPPING_CUSTOMSHIPPER_NAME,
            'methods' => array(
                array(
                    'id' => $this->code,
                    'title' => MODULE_SHIPPING_CUSTOMSHIPPER_WAY,
                    'cost' => MODULE_SHIPPING_CUSTOMSHIPPER_COST
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
            $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_CUSTOMSHIPPER_STATUS'");
            $this->_check = tep_db_num_rows($check_query);
        }
        return $this->_check;
    }

    static function install()
    {
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Allow this module', 'MODULE_SHIPPING_CUSTOMSHIPPER_STATUS', 'true', '', '6', '0', 'tep_cfg_select_option_checkbox(array(\'true\', \'false\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Module name', 'MODULE_SHIPPING_CUSTOMSHIPPER_NAME', 'Shipper', '', '6', '1', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Description', 'MODULE_SHIPPING_CUSTOMSHIPPER_WAY', '', '', '6', '2', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Cost', 'MODULE_SHIPPING_CUSTOMSHIPPER_COST', '5.00', '', '6', '3', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Tax', 'MODULE_SHIPPING_CUSTOMSHIPPER_TAX_CLASS', '0', '', '6', '4', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Zone', 'MODULE_SHIPPING_CUSTOMSHIPPER_ZONE', '0', '', '6', '5', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sorting order', 'MODULE_SHIPPING_CUSTOMSHIPPER_SORT_ORDER', '0', '', '6', '6', now())");
    }

    function remove()
    {
        tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", static::keys()) . "')");
    }

    static function keys()
    {
        return array(
            'MODULE_SHIPPING_CUSTOMSHIPPER_STATUS',
            'MODULE_SHIPPING_CUSTOMSHIPPER_NAME',
            'MODULE_SHIPPING_CUSTOMSHIPPER_WAY',
            'MODULE_SHIPPING_CUSTOMSHIPPER_COST',
            'MODULE_SHIPPING_CUSTOMSHIPPER_TAX_CLASS',
            'MODULE_SHIPPING_CUSTOMSHIPPER_ZONE',
            'MODULE_SHIPPING_CUSTOMSHIPPER_SORT_ORDER'
        );
    }
}

