<?php

/* $Id: ot_country_discount.php.php 2018/09/05 by Solomono */

class ot_country_discount
{
    var $code, $title, $description, $enabled, $num_zones;

// class constructor
    public static $num_zones_static = 5;
    function __construct()
    {
        $this->code = 'ot_country_discount';
        $this->title = MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_TEXT_TITLE;
        $this->description = MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_TEXT_DESCRIPTION;
        $this->enabled = ((MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_STATUS == 'true') ? true : false);
        $this->sort_order = (int)MODULE_ORDER_TOTAL_OT_COUNTRY_DISCOUNT_SORT_ORDER;
        $this->icon = '';

      // CUSTOMIZE THIS SETTING FOR THE NUMBER OF ZONES NEEDED
        $this->num_zones = self::$num_zones_static;

        $this->output = array();
    }

// class methods

    function process()
    {
        global $order, $currencies;

        $dest_country = $order->delivery['country']['iso_code_2'];
        $dest_zone = 0;
        $error = false;

        for ($i = 1; $i <= $this->num_zones; $i++) {
            $countries_table = constant('MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_COUNTRIES_' . $i);
            $country_zones = preg_split("/[,]/", $countries_table);
            if (in_array($dest_country, $country_zones)) {
                $dest_zone = $i;
                break;
            }
        }

        if ($dest_zone == 0) {
            $dest_zone = $this->num_zones;    // the zone is the lastest zone avalaible
        }

        $discount_percent = constant('MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_COST_' . $dest_zone);

        if (!empty($discount_percent)) {
            $discount_cost = $order->info['subtotal'] * $discount_percent / 100;
            $order->info['total'] = $order->info['total'] - $discount_cost;

            $this->output[] = array('title' => $this->title . ' (' . $discount_percent . '%):',
                                 'text' => $currencies->format($discount_cost, true, $order->info['currency'], $order->info['currency_value']),
                                 'value' => -$discount_percent . '%');
        }
    }

    function check()
    {
        if (!isset($this->_check)) {
            $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_STATUS'");
            $this->_check = tep_db_num_rows($check_query);
        }
        return $this->_check;
    }

   // elari - Added to select default country if not in listing
    static function install()
    {
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Stauts', 'MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_STATUS', 'true', 'Do you want to offer Countries Discount?', '6', '0', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ORDER_TOTAL_OT_COUNTRY_DISCOUNT_SORT_ORDER', '0', 'Sort order of display.', '6', '0', now())");
        for ($i = 1; $i <= self::$num_zones_static; $i++) {
            $default_countries = '';
            $discount = '';
            if ($i == 1) {
                $default_countries = 'GR';
                $discount = '10';
            }
            if ($i == 2) {
                $default_countries = 'AT,BE,GB,DE,FR,GL,IS,IE,IT,NO,DK,PL,ES,SE,CH,FI,PT,IL,GR';
                $discount = '15';
            }
            if ($i == 3) {
                $default_countries = 'All Others'; // this must be the lastest zone
                $discount = '5';
            }
            tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Zone " . $i . " Countries', 'MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_COUNTRIES_" . $i . "', '" . $default_countries . "', 'Comma separated list of two character ISO country codes that are part of Zone " . $i . ".', '6', '0', now())");
            tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Zone " . $i . " Discount', 'MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_COST_" . $i . "', '" . $discount . "', 'Discount to Zone " . $i . ".', '6', '0', now())");
        }
    }
   // elari - Added to select default country if not in listing

    function remove()
    {
        tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", static::keys()) . "')");
    }

    static function keys()
    {
        $keys = array('MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_STATUS', 'MODULE_ORDER_TOTAL_OT_COUNTRY_DISCOUNT_SORT_ORDER');

        for ($i = 1; $i <= self::$num_zones_static; $i++) {
            $keys[] = 'MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_COUNTRIES_' . $i;
            $keys[] = 'MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_COST_' . $i;
        }

        return $keys;
    }
}
