<?php

/*
  $Id: shipping.php,v 1.1.1.1 2003/09/18 19:05:13 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

class shipping
{
    public $modules;

    function __construct($module = '')
    {
        global $language, $PHP_SELF, $cart, $customer_id, $customers_groups_id;

        if (defined('MODULE_SHIPPING_INSTALLED') && tep_not_null(MODULE_SHIPPING_INSTALLED)) {
            if (is_file(DIR_FS_EXT . 'customers_groups/customers_groups.php')) {
                $customer_shipment_query = tep_db_query("
                    select 
                        IF(c.customers_shipment_allowed <> '', 
                        c.customers_shipment_allowed, 
                        cg.group_shipment_allowed) as shipment_allowed
                    from 
                        " . TABLE_CUSTOMERS . " c, 
                        " . TABLE_CUSTOMERS_GROUPS . " cg 
                    where 
                        c.customers_id = " . (int)$customer_id . " and 
                        cg.customers_groups_id =  " . (int)$customers_groups_id);
            } else {
                $customer_shipment_query = tep_db_query(
                    "select 
                        c.customers_shipment_allowed as shipment_allowed
                    from 
                        " . TABLE_CUSTOMERS . " c 
                    where 
                        c.customers_id = " . (int)$customer_id
                );
            }

            $this->modules =  array_diff(explode(';', MODULE_SHIPPING_INSTALLED), array(''));
            if ($customer_shipment = tep_db_fetch_array($customer_shipment_query)) {
                if (tep_not_null($customer_shipment['shipment_allowed'])) {
                    $temp_shipment_array = explode(';', $customer_shipment['shipment_allowed']);
                    $installed_modules = $this->modules;
                    foreach ($installed_modules as $instalModule) {
                        // check to see if a shipping module is not de-installed
                        if (in_array($instalModule, $temp_shipment_array)) {
                            $shipment_array[] = $instalModule;
                        }
                    }
                    $this->modules = $shipment_array;
                }
            }

            $include_modules = [];
            if ($this->isModuleActive($module, $PHP_SELF)) {
                $include_modules[] = [
                'class' => substr($module['id'], 0, strpos($module['id'], '_')),
                'file'  => substr($module['id'], 0, strpos($module['id'], '_')) . '.' .
                substr($PHP_SELF, (strrpos($PHP_SELF, '.') + 1))
                ];
            } else {
                reset($this->modules);
              // BOF: WebMakers.com Added: Downloads Controller - Free Shipping and Payments
              // Show either normal shipping modules or free shipping module when Free Shipping Module is On
              // Free Shipping Only
                if (
                    tep_get_configuration_key_value('MODULE_SHIPPING_FREESHIPPER_STATUS') == 'true' and
                    $cart->show_weight() == 0
                ) {
                    $include_modules[] = ['class' => 'freeshipper', 'file' => 'freeshipper.php'];
                } else {
                  // All Other Shipping Modules
                    foreach ($this->modules as $key => $value) {
                        $class = substr($value, 0, strrpos($value, '.'));
                      // Don't show Free Shipping Module
                        if ($class != 'freeshipper') {
                              $include_modules[] = ['class' => $class, 'file' => $value];
                        }
                    }
                }
              // EOF: WebMakers.com Added: Downloads Controller - Free Shipping and Payments
            }

            foreach ($include_modules as $module) {
                if (is_file(DIR_WS_MODULES . 'shipping/' . $module['file'])) {
                    includeLanguages(DIR_WS_LANGUAGES . $language . '/modules/shipping/' . $module['file']);
                    include_once(DIR_WS_MODULES . 'shipping/' . $module['file']);
                    $GLOBALS[$module['class']] = new $module['class']();
                } elseif (is_file($path = DIR_FS_EXT . 'shipping/' . $module['class'] . '/' . $module['file'])) {
                    includeLanguages(DIR_FS_EXT . 'shipping/' . $module['class'] . '/languages/' . $language . '/' . $module['file']);
                    include_once($path);
                    $GLOBALS[$module['class']] = new $module['class']();
                }
            }
        }
    }

    function isModuleActive($module, $PHP_SELF)
    {
        return (tep_not_null($module) &&
        in_array(
            substr($module['id'], 0, strpos($module['id'], '_')) . '.' .
            substr($PHP_SELF, (strrpos($PHP_SELF, '.') + 1)),
            $this->modules
        ));
    }

    function quote($method = '', $module = '')
    {
        global $total_weight, $shipping_weight, $shipping_quoted, $shipping_num_boxes;

        $quotes_array = [];
        if (is_array($this->modules)) {
            $shipping_quoted = '';
            $shipping_num_boxes = 1;
            $shipping_weight = $total_weight;
            if (SHIPPING_BOX_WEIGHT >= $shipping_weight * SHIPPING_BOX_PADDING / 100) {
                $shipping_weight = $shipping_weight + SHIPPING_BOX_WEIGHT;
            } else {
                $shipping_weight = $shipping_weight + ($shipping_weight * SHIPPING_BOX_PADDING / 100);
            }

            if ($shipping_weight > SHIPPING_MAX_WEIGHT) { // Split into many boxes
                $shipping_num_boxes = ceil($shipping_weight / SHIPPING_MAX_WEIGHT);
                $shipping_weight = $shipping_weight / $shipping_num_boxes;
            }

            $include_quotes = [];
            reset($this->modules);
            foreach ($this->modules as $key => $value) {
                $class = substr($value, 0, strrpos($value, '.'));

                if (tep_not_null($module)) {
                    if (($module == $class) && ($GLOBALS[$class]->enabled)) {
                        $include_quotes[] = $class;
                    }
                } elseif ($GLOBALS[$class]->enabled) {
                    $include_quotes[] = $class;
                }
            }

            $size = sizeof($include_quotes);
            for ($i = 0; $i < $size; $i++) {
                $quotes = $GLOBALS[$include_quotes[$i]]->quote($method);
                if (is_array($quotes) && !empty($quotes)) {
                    $quotes_array[] = $quotes;
                }
            }
        }

        return $quotes_array;
    }

    function cheapest()
    {
        if (is_array($this->modules)) {
            $rates = [];
            reset($this->modules);
            foreach ($this->modules as $key => $value) {
                $class = substr($value, 0, strrpos($value, '.'));
                if ($GLOBALS[$class]->enabled) {
                    $quotes = $GLOBALS[$class]->quotes;
                    for ($i = 0, $n = sizeof((array)$quotes['methods']); $i < $n; $i++) {
                        if (isset($quotes['methods'][$i]['cost']) && tep_not_null($quotes['methods'][$i]['cost'])) {
                            $rates[] = [
                            'id' => $quotes['id'] . '_' . $quotes['methods'][$i]['id'],
                            'title' => $quotes['module'] . ' (' . $quotes['methods'][$i]['title'] . ')',
                            'cost' => $quotes['methods'][$i]['cost']
                            ];
                        }
                    }
                }
            }

            $cheapest = false;
            for ($i = 0, $n = sizeof($rates); $i < $n; $i++) {
                if (is_array($cheapest)) {
                    if ($rates[$i]['cost'] < $cheapest['cost']) {
                        $cheapest = $rates[$i];
                    }
                } else {
                    $cheapest = $rates[$i];
                }
            }

            return $cheapest;
        }
    }
}
