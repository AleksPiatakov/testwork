<?php

/*
  $Id: flat.php,v 1.1.1.1 2003/09/18 19:04:54 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

/**
 * Class nwpochta
 */
class nwpochta
{
    /**
     * @var string
     */
    public $code;
    /**
     * @var string
     */
    public $title;
    /**
     * @var string
     */
    public $description;
    /**
     * @var string
     */
    public $icon;
    /**
     * @var bool
     */
    public $enabled;
    /**
     * @var array
     */
    public $quotes;
    /**
     * @var int
     */
    public $tax_class;
    /**
     * @var int
     */
    public $_check;

    /**
     * @var string
     */
    public $costText;
    /**
     * nwpochta constructor
     */
    public function __construct()
    {
        global $order, $admin_check;

        $this->code = 'nwpochta';
        $this->title = !empty(MODULE_SHIPPING_NWPOCHTA_CUSTOM_NAME) ? MODULE_SHIPPING_NWPOCHTA_CUSTOM_NAME : MODULE_SHIPPING_NWPOCHTA_TEXT_TITLE;
        $this->costText = getConstantValue('MODULE_SHIPPING_NWPOCHTA_SHIPPING_PRICE_TEXT');
        $this->description = MODULE_SHIPPING_NWPOCHTA_TEXT_DESCRIPTION;
        $this->sort_order = MODULE_SHIPPING_NWPOCHTA_SORT_ORDER;
        $this->icon = '';
        $this->tax_class = MODULE_SHIPPING_NWPOCHTA_TAX_CLASS;
        $this->enabled = (MODULE_SHIPPING_NWPOCHTA_STATUS == 'true') ? true : false;

        if (
            $this->enabled == true && !$admin_check &&
            (int)getConstantValue('MODULE_SHIPPING_NWPOCHTA_ZONE', 0) > 0 &&
            getConstantValue('ACCOUNT_COUNTRY') == 'true' && getConstantValue('ACCOUNT_STATE') == 'true'
        ) {
            $check_flag = false;
            $check_query = tep_db_query("
                select 
                    zone_id 
                from 
                    " . TABLE_ZONES_TO_GEO_ZONES . " 
                where 
                    geo_zone_id = '" . MODULE_SHIPPING_NWPOCHTA_ZONE . "' and 
                    (zone_country_id = '" . $order->delivery['country']['id'] . "' or zone_country_id=0) 
                order by 
                    zone_id");
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

    /**
     * @param string $method
     * @return array
     */
    public function quote($method = '')
    {
        global $order;

        $this->quotes = [
            'id' => $this->code,
            'module' => $this->title,
            'methods' => [
                [
                    'id' => $this->code,
                    'title' => MODULE_SHIPPING_NWPOCHTA_TEXT_WAY,
                    'cost' => MODULE_SHIPPING_NWPOCHTA_COST
                ]
            ]
        ];

        if ($this->tax_class > 0) {
            $this->quotes['tax'] = tep_get_tax_rate(
                $this->tax_class,
                $order->delivery['country']['id'],
                $order->delivery['zone_id']
            );
        }

        if (!empty($this->costText) && is_object($order)) {
            $this->quotes['methods'][0]['cost_text'] = $this->costText;
        }

        if (tep_not_null($this->icon)) {
            $this->quotes['icon'] = tep_image($this->icon, $this->title);
        }

        return $this->quotes;
    }

    /**
     * @return int
     */
    public function check()
    {
        if (empty($this->_check)) {
            $check_query = tep_db_query("
                select 
                    configuration_value 
                from 
                    " . TABLE_CONFIGURATION . " 
                where 
                    configuration_key = 'MODULE_SHIPPING_NWPOCHTA_STATUS'");
            $this->_check = tep_db_num_rows($check_query);
        }

        return $this->_check;
    }

    /**
     * install module to db
     * @return void
     */
    public static function install()
    {
        $installInfo = [
            [
                'configuration_title' => 'Enable method',
                'configuration_key' => 'MODULE_SHIPPING_NWPOCHTA_STATUS',
                'configuration_value' => 'true',
                'configuration_description' => "Do you want to enable this method?",
                'configuration_group_id' => '6',
                'sort_order' => '0',
                'use_function' => '',
                'set_function' => 'tep_cfg_select_option_checkbox(array("true", "false"),',
            ],
            [
                'configuration_title' => 'Custom module name',
                'configuration_key' => 'MODULE_SHIPPING_NWPOCHTA_CUSTOM_NAME',
                'configuration_value' => 'New Post test',
                'configuration_description' => 'Leave empty if you want to use default module name',
                'configuration_group_id' => '6',
                'sort_order' => '0',
                'use_function' => '',
                'set_function' => ''
            ],
            [
                'configuration_title' => 'Cost',
                'configuration_key' => 'MODULE_SHIPPING_NWPOCHTA_COST',
                'configuration_value' => '5.00',
                'configuration_description' => 'Cost for this shipping method.',
                'configuration_group_id' => '6',
                'sort_order' => '0',
                'use_function' => '',
                'set_function' => ''
            ],

            [
                'configuration_title' => 'Custom shipping price text',
                'configuration_key' => 'MODULE_SHIPPING_NWPOCHTA_SHIPPING_PRICE_TEXT',
                'configuration_value' => '',
                'configuration_description' => 'Leave blank if you want to use the price shown in the cost field.',
                'configuration_group_id' => '6',
                'sort_order' => '0',
                'use_function' => '',
                'set_function' => ''
            ],

            [
                'configuration_title' => 'Tax',
                'configuration_key' => 'MODULE_SHIPPING_NWPOCHTA_TAX_CLASS',
                'configuration_value' => '0',
                'configuration_description' => 'Use tax.',
                'configuration_group_id' => '6',
                'sort_order' => '0',
                'use_function' => 'tep_get_tax_class_title',
                'set_function' => 'tep_cfg_pull_down_tax_classes('
            ],
            [
                'configuration_title' => 'Zone',
                'configuration_key' => 'MODULE_SHIPPING_NWPOCHTA_ZONE',
                'configuration_value' => '0',
                'configuration_description' => 'If zone is set, this module will available only for customers from selected zone.',
                'configuration_group_id' => '6',
                'sort_order' => '0',
                'use_function' => 'tep_get_zone_class_title',
                'set_function' => 'tep_cfg_pull_down_zone_classes('
            ],
            [
                'configuration_title' => 'Sort order',
                'configuration_key' => 'MODULE_SHIPPING_NWPOCHTA_SORT_ORDER',
                'configuration_value' => '0',
                'configuration_description' => 'Enter sort order for this module.',
                'configuration_group_id' => '6',
                'sort_order' => '0',
                'use_function' => '',
                'set_function' => ''
            ]
        ];
        foreach ($installInfo as $info) {
            $fields = array_keys($info);
            $fields = implode(',', $fields);
            $fields .= ',date_added';
            $values = "'";
            $valuesArr = array_values($info);
            $values .= implode("','", $valuesArr);
            $values .= "',now()";
            tep_db_query('INSERT INTO ' . TABLE_CONFIGURATION . '(' . $fields . ') VALUES (' . $values . ')');
        }
    }

    /**
     * remove module
     */
    function remove()
    {
        tep_db_query("
            delete from 
                " . TABLE_CONFIGURATION . " 
            where 
                configuration_key in (
                    '" . implode("', '", static::keys()) . "'
                )");
    }

    /**
     * @return array
     */
    static function keys()
    {
        return [
            'MODULE_SHIPPING_NWPOCHTA_STATUS',
            'MODULE_SHIPPING_NWPOCHTA_CUSTOM_NAME',
            'MODULE_SHIPPING_NWPOCHTA_COST',
            'MODULE_SHIPPING_NWPOCHTA_TAX_CLASS',
            'MODULE_SHIPPING_NWPOCHTA_ZONE',
            'MODULE_SHIPPING_NWPOCHTA_SORT_ORDER'
        ];
    }
}
