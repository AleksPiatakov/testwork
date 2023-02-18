<?php

/*
  $Id: flat.php,v 1.1.1.1 2003/09/18 19:04:54 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

class nwposhtanew
{
    var $code, $title, $description, $icon, $enabled, $sort_order, $tax_class, $update_warehouses_api_key,
        $show_shipping_cost_status, $costText;
    public $countriesAllowed = array("220");

// class constructor
    function __construct()
    {
        global $order;

        $this->code = 'nwposhtanew';
        //default title
        $title = MODULE_SHIPPING_NWPOSHTANEW_TEXT_TITLE;
        $this->costText = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_SHIPPING_PRICE_TEXT');
        //check if exist custom title
        $constCustomName = 'MODULE_SHIPPING_NWPOSHTANEW_CUSTOM_NAME';
        if (defined($constCustomName) && !empty(constant($constCustomName)) && is_object($order)) {
            $title = MODULE_SHIPPING_NWPOSHTANEW_CUSTOM_NAME;
        }
        $this->title = $title;
        $this->description = MODULE_SHIPPING_NWPOSHTANEW_TEXT_DESCRIPTION;
        $this->sort_order = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_SORT_ORDER', '0');
        $this->icon = '';
        $this->tax_class = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_TAX_CLASS', '0');
        $this->enabled = (getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_STATUS', 'false') == 'true') ? true : false;
        $this->update_warehouses_api_key = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_API_KEY','');
        $this->show_shipping_cost_status = (getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_SHOW_SHIPPING_COST_STATUS', 'false') == 'true') ? true : false;

//      if ( ($this->enabled == true) && ((int)MODULE_SHIPPING_NWPOSHTANEW_ZONE > 0) ) {
//        $check_flag = false;
//        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_SHIPPING_NWPOSHTANEW_ZONE . "' and (zone_country_id = '" . $order->delivery['country']['id'] . "' or zone_country_id=0) order by zone_id");
//        while ($check = tep_db_fetch_array($check_query)) {
//          if ($check['zone_id'] < 1) {
//            $check_flag = true;
//            break;
//          } elseif ($check['zone_id'] == $order->delivery['zone_id']) {
//            $check_flag = true;
//            break;
//          }
//        }
//
//        if ($check_flag == false) {
//          $this->enabled = false;
//        }
//      }
    }
    function getWarehouses()
    {
        global $lng,$languages_id,$languages;
        $existLngArray = [];
        foreach ($lng->catalog_languages as $oneLng) {
            $existLngArray[] = $oneLng['id'];
        }

        $query = tep_db_query("SELECT language_id FROM novaposhta_warehouses group by language_id");
        $dbLanguages = [];
        while ($dbLanguagesLine = tep_db_fetch_array($query)) {
            $dbLanguages[] = $dbLanguagesLine['language_id'];
        }

        $lang_id = in_array($languages_id, $dbLanguages) ? $languages_id : $dbLanguages[0];
        $query = tep_db_query("SELECT city,name FROM novaposhta_warehouses WHERE language_id = '{$lang_id}' and city != '' ORDER BY number,city ASC");
        $warehouses = [];
        while ($warehouse = tep_db_fetch_array($query)) {
            $warehouses[] = [
              'city' => trim($warehouse['city']),
              'name' => $warehouse['name'],
            ];
        }
        return $warehouses ? $this->drawSelects($warehouses) : '';
    }
    function drawSelects($warehouses)
    {
        global $order;
        $selectCity = '<select id="np_cities" class="required">';
        $selectWarehouse = '<select id="np_warehouses" class="required">';
        $selectCityArray = $selectWarehouseArray = [];
        $warehouseCity = isset($_SESSION["onepage"]["shipping"]["np_cities"]) ? $_SESSION["onepage"]["shipping"]["np_cities"] : $order->delivery['city'];
        $warehouseName = isset($_SESSION["onepage"]["shipping"]["np_warehouses"]) ? $_SESSION["onepage"]["shipping"]["np_warehouses"] : $order->delivery['street_address'];
        foreach ($warehouses as $warehouse) {
            $selectedCity = $warehouse['city'] == $warehouseCity ? ' selected' : '';

            $selectCityArray[$warehouse['city']] =      '<option value="' . $warehouse['city'] . '"' . $selectedCity . '>' . $warehouse['city'] . '</option>';
            $selectWarehouseArray[$warehouse['city']][] = ['id' => $warehouse['name'],'name' => $warehouse['name']];
        }
        $selectWarehouseJSON = json_encode($selectWarehouseArray);
        $selectCity .= implode($selectCityArray);
        $selectCity .= '</select>';
        $selectWarehouse .= '</select>';
        $placeholder = MODULE_SHIPPING_NWPOSHTANEW_PLACEHOLDER;
        $scripts = <<<SCRIPT
    <script>
        var warehouses = $selectWarehouseJSON;
        var placeholder = '$placeholder';
        var sel1 = document.querySelector('#np_cities');
        var sel2 = document.querySelector('#np_warehouses');
        var citySelected = $(sel1).find('option:selected').val();
        var selected = JSON.stringify($(sel2).find('option:selected').val());
        var options2 = sel2.querySelectorAll('option');
        var select_state;
        var select_city,  select_city_i;
         select_city = $('#np_warehouses').selectize({
            valueField: 'name',
            labelField: 'name',
            placeholder: placeholder,
            searchField: ['name'],
            onChange: function(value){
               $('[name="shipping_street_address"]').val(value).trigger('blur')
              }
        });
        
        select_city_i  = select_city[0].selectize;
        select_state = $('#np_cities').selectize({
          maxItems:1,
          hideSelected: false,
          sortField: [
              { field: "\$order", direction: "asc" }
          ],
          // openOnFocus: false,
          onDropdownClose:
              function(dropdown){
              $(dropdown).find('.selected').not('.active').removeClass('selected');
          },
          onChange: function(value){
                  if (!value.length) return;            
                  $('[name="shipping_city"]').val(value).trigger('blur');
  
                  select_city_i.disable();                
                  select_city_i.clear();
                  select_city_i.clearOptions()
                  select_city_i.addOption(warehouses[value]);
                  select_city_i.enable();
                      // console.log(warehouses[value]);
                      // callback(warehouses[value]);
          },
          onFocus: function(){
              this.clear();
          },
          onInitialize: function(){
              $('[name="shipping_city"]').val(sel1.value).trigger('blur');
              this.refreshItems();
              select_city_i.setValue('$warehouseName');
            }
        });
        
        
        
        

       

</script>
SCRIPT;
        return $selectCity . PHP_EOL . $selectWarehouse . PHP_EOL . $scripts;
    }
// class methods
    function quote($method = '')
    {
        global $order;

        $this->quotes = array('id' => $this->code,
                            'module' => $this->title,
                            'methods' => array(array('id' => $this->code,
                                                     'title' => $this->title,
//                                                     'html' => $this->getWarehouses(),
                                                     'cost' => MODULE_SHIPPING_NWPOSHTANEW_COST)));
        if ($order->info['shipping_method'] == $this->title) {
            $this->quotes['methods'][0]['html'] = $this->getWarehouses();
        }
        if ($this->tax_class > 0) {
            $this->quotes['tax'] = tep_get_tax_rate($this->tax_class, $order->delivery['country']['id'], $order->delivery['zone_id']);
        }

        if (!empty($this->costText) && is_object($order)) {
            $this->quotes['methods'][0]['cost_text'] = $this->costText;
        }

        if (tep_not_null($this->icon)) {
            $this->quotes['icon'] = tep_image($this->icon, $this->title);
        }
        if ($this->countriesAllowed) {//check if object has field countries, which means countries, where this module is enabled
            $is_allowed = (in_array($_SESSION['customer_country_id'], $this->countriesAllowed) || !$_SESSION['customer_country_id']);
            $are_countries_empty = (count($this->countriesAllowed) == 0);
            if ((!($is_allowed || $are_countries_empty)) || ($is_allowed && $are_countries_empty)) {
                $this->quotes = [];
                return $this->quotes;
            }
        }
        return $this->quotes;
    }

    function check()
    {
        if (!isset($this->_check)) {
            $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_NWPOSHTANEW_STATUS'");
            $this->_check = tep_db_num_rows($check_query);
        }
        return $this->_check;
    }

    static function install()
    {
        $nwposhtaAddressExist = tep_db_query("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '" . TABLE_ORDERS . "' AND COLUMN_NAME = 'nwposhta_address'");
        if (tep_db_num_rows($nwposhtaAddressExist) === 0) {
            tep_db_query("ALTER TABLE " . TABLE_ORDERS . " ADD nwposhta_address VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;");
        }

        tep_db_query('CREATE TABLE IF NOT EXISTS `novaposhta_cities` (
   			`CityID` int(11) NOT NULL,
   			`Ref` varchar(36) NOT NULL,
   			`Description` varchar(200) NOT NULL, 
   			`DescriptionRu` varchar(200) NOT NULL,    
   			`Area` varchar(36) NOT NULL,
   			`SettlementType` varchar(36) NOT NULL,
   			`SettlementTypeDescription` varchar(200) NOT NULL, 
   			`SettlementTypeDescriptionRu` varchar(200) NOT NULL,
   			`Delivery1` tinyint(1) NOT NULL,
   			`Delivery2` tinyint(1) NOT NULL,
   			`Delivery3` tinyint(1) NOT NULL,
   			`Delivery4` tinyint(1) NOT NULL,
   			`Delivery5` tinyint(1) NOT NULL,
   			`Delivery6` tinyint(1) NOT NULL,
   			`Delivery7` tinyint(1) NOT NULL,
   			`Conglomerates` text NOT NULL,
   			`PreventEntryNewStreetsUser` text NOT NULL,
   			`IsBranch` tinyint(1) NOT NULL,
   			`SpecialCashCheck` tinyint(1) NOT NULL,
   			INDEX (`CityID`),
   			INDEX (`Area`),		
   			INDEX (`SettlementType`), 			
   			PRIMARY KEY (`Ref`)
   			) ENGINE=MyISAM DEFAULT CHARSET=utf8'
        );

        tep_db_query('CREATE TABLE IF NOT EXISTS `novaposhta_warehouses_api` (
   			`SiteKey` int(11) NOT NULL,
   			`Ref` varchar(36) NOT NULL,
   			`Description` varchar(500) NOT NULL, 
   			`DescriptionRu` varchar(500) NOT NULL,
   			`ShortAddress` varchar(500) NOT NULL, 
   			`ShortAddressRu` varchar(500) NOT NULL,		 
   			`TypeOfWarehouse` varchar(36) NOT NULL,
   			`CityRef` varchar(36) NOT NULL,
   			`CityDescription` varchar(200) NOT NULL,
   			`CityDescriptionRu` varchar(200) NOT NULL,  
   			`Number` int(11) NOT NULL, 	
   			`Phone` varchar(50) NOT NULL,  					
   			`Longitude` double NOT NULL,
   			`Latitude` double NOT NULL,
   			`PostFinance` tinyint(1) NOT NULL,
   			`BicycleParking` tinyint(1) NOT NULL,
   			`PaymentAccess` tinyint(1) NOT NULL,
   			`POSTerminal` tinyint(1) NOT NULL,
   			`InternationalShipping` tinyint(1) NOT NULL,
   			`TotalMaxWeightAllowed` int(11) NOT NULL,
   			`PlaceMaxWeightAllowed` int(11) NOT NULL,
   			`Reception` text NOT NULL,
   			`Delivery` text NOT NULL,
   			`Schedule` text NOT NULL,
   			`DistrictCode` varchar(20) NOT NULL,
   			`WarehouseStatus` varchar(20) NOT NULL,
   			`CategoryOfWarehouse` varchar(20) NOT NULL,
   			INDEX (`SiteKey`),
   			INDEX (`TypeOfWarehouse`),
   			INDEX (`CityRef`),
   			PRIMARY KEY (`Ref`)
   			) ENGINE=MyISAM DEFAULT CHARSET=utf8'
        );

        tep_db_query('CREATE TABLE IF NOT EXISTS `novaposhta_references` (
   			`type` varchar(100) NOT NULL, 
   			`value` mediumtext NOT NULL,  
   			UNIQUE(`type`)
   			) ENGINE=MyISAM DEFAULT CHARSET=utf8'
        );

        $query = tep_db_query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE `table_name` = '" . TABLE_ORDERS . "' AND `table_schema` = '" . DB_DATABASE . "' AND `column_name` = 'novaposhta_cn_number'");
        $result = tep_db_fetch_array($query);

        if (!$result) {
            tep_db_query("ALTER TABLE `" . TABLE_ORDERS . "` 
				ADD `novaposhta_cn_number` varchar(100) NOT NULL AFTER `nwposhta_address`, 
				ADD `novaposhta_cn_ref` varchar(100) NOT NULL AFTER `novaposhta_cn_number`"
            );
        }

        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable method', 'MODULE_SHIPPING_NWPOSHTANEW_STATUS', 'true', 'Do you want to enable this method?', '6', '0', 'tep_cfg_select_option_checkbox(array(\'true\', \'false\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable debugging mode', 'MODULE_SHIPPING_NWPOSHTANEW_DEBUGGING_MODE', 'false', 'Do you want to enable this mode?', '6', '0', 'tep_cfg_select_option_checkbox(array(\'true\', \'false\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Custom module name', 'MODULE_SHIPPING_NWPOSHTANEW_CUSTOM_NAME', '', 'Leave empty if you want to use default module name', '6', '0', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Cost', 'MODULE_SHIPPING_NWPOSHTANEW_COST', '5.00', 'Cost for this shipping method.', '6', '0', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Custom shipping price text', 'MODULE_SHIPPING_NWPOSHTANEW_SHIPPING_PRICE_TEXT', '', 'Leave blank if you want to use the price shown in the cost field.', '6', '0', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Tax', 'MODULE_SHIPPING_NWPOSHTANEW_TAX_CLASS', '0', 'Use tax.', '6', '0', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Zone', 'MODULE_SHIPPING_NWPOSHTANEW_ZONE', '0', 'If zone is set, this module will available only for customers from selected zone.', '6', '0', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order', 'MODULE_SHIPPING_NWPOSHTANEW_SORT_ORDER', '0', 'Enter sort order for this module.', '6', '0', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('API Key', 'MODULE_SHIPPING_NWPOSHTANEW_API_KEY', '' , '', '6', '0', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Show shipping cost', 'MODULE_SHIPPING_NWPOSHTANEW_SHOW_SHIPPING_COST_STATUS', 'true', '', '6', '0', 'tep_cfg_select_option_checkbox(array(\'true\', \'false\'), ', now())");

        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sender region', 'MODULE_SHIPPING_NWPOSHTANEW_SENDER_REGION', 'Київська', 'Do you want to enable this method?', '6', '0', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sender city name', 'MODULE_SHIPPING_NWPOSHTANEW_SENDER_CITY_NAME', 'Киев', 'Do you want to enable this method?', '6', '0', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sender address name', 'MODULE_SHIPPING_NWPOSHTANEW_SENDER_ADDRESS_NAME', 'Отделение №1: ул. Пироговский путь, 135', 'Do you want to enable this method?', '6', '0', now())");

        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Autodetection departure type', 'MODULE_SHIPPING_NWPOSHTANEW_AUTODETECTION_DEPARTURE_TYPE', 'true', 'Do you want to enable this method?', '6', '0', 'tep_cfg_select_option_checkbox(array(\'true\', \'false\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Departure type', 'MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_TYPE', 'Cargo', 'Do you want to enable this method?', '6', '0', 'tep_cfg_select_option_nwposhtanew(array(\'Parcel\', \'Cargo\', \'Documents\', \'TiresWheels\', \'Pallet\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Seats amount', 'MODULE_SHIPPING_NWPOSHTANEW_SEATS_AMOUNT', '1', 'Do you want to enable this method?', '6', '0', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Departure description', 'MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_DESCRIPTION', 'Бытовые вещи', 'Do you want to enable this method?', '6', '0', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Backward delivery', 'MODULE_SHIPPING_NWPOSHTANEW_BACKWARD_DELIVERY', 'Money', 'Do you want to enable this method?', '6', '0', 'tep_cfg_pull_down_nwposhtanew(array(\'N\', \'Documents\', \'Money\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Declared cost', 'MODULE_SHIPPING_NWPOSHTANEW_DECLARED_COST', 'ot_total', 'Do you want to enable this method?', '6', '0', 'tep_cfg_select_option_nwposhtanew(array(\'ot_shipping\', \'ot_subtotal\', \'ot_total\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Declared cost default', 'MODULE_SHIPPING_NWPOSHTANEW_DECLARED_COST_DEFAULT', '200', 'Do you want to enable this method?', '6', '0', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Backward delivery payer', 'MODULE_SHIPPING_NWPOSHTANEW_BACKWARD_DELIVERY_PAYER', 'Recipient', 'Do you want to enable this method?', '6', '0', 'tep_cfg_select_option_nwposhtanew(array(\'Sender\', \'Recipient\', \'ThirdPerson\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Payment type', 'MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_TYPE', 'Cash', 'Do you want to enable this method?', '6', '0', 'tep_cfg_pull_down_nwposhtanew(array(\'NonCash\', \'Cash\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Payment cod', 'MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_COD', '', 'Do you want to enable this method?', '6', '0', 'tep_get_payment_modules(', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Money transfer method', 'MODULE_SHIPPING_NWPOSHTANEW_MONEY_TRANSFER_METHOD', 'on_warehouse', 'Do you want to enable this method?', '6', '0', 'tep_cfg_pull_down_nwposhtanew(array(\'on_warehouse\', \'to_payment_card\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Payment control', 'MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_CONTROL', '', 'Do you want to enable this method?', '6', '0', 'tep_cfg_pull_down_nwposhtanew(array(\'ot_shipping\', \'ot_subtotal\', \'ot_total\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Departure_additional_information', 'MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_ADDITIONAL_INFORMATION', 'Товары: | {name} - {quantity} шт', 'Do you want to enable this method?', '6', '0', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Print format', 'MODULE_SHIPPING_NWPOSHTANEW_PRINT_FORMAT', 'markings_A4', 'Do you want to enable this method?', '6', '0', 'tep_cfg_select_option_nwposhtanew(array(\'document_A4\', \'document_A5\', \'markings_A4\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Template type', 'MODULE_SHIPPING_NWPOSHTANEW_TEMPLATE_TYPE', 'html', 'Do you want to enable this method?', '6', '0', 'tep_cfg_select_option_nwposhtanew(array(\'html\', \'pdf\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Print type', 'MODULE_SHIPPING_NWPOSHTANEW_PRINT_TYPE', 'verPrint', 'Do you want to enable this method?', '6', '0', 'tep_cfg_select_option_nwposhtanew(array(\'horPrint\', \'verPrint\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Print start', 'MODULE_SHIPPING_NWPOSHTANEW_PRINT_START', '1', 'Do you want to enable this method?', '6', '0', 'tep_cfg_select_option_nwposhtanew(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Number of copies', 'MODULE_SHIPPING_NWPOSHTANEW_NUMBER_OF_COPIES', '1', 'Do you want to enable this method?', '6', '0', 'tep_cfg_select_option_nwposhtanew(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display all consignments', 'MODULE_SHIPPING_NWPOSHTANEW_DISPLAY_ALL_CONSIGNMENTS', 'true', 'Do you want to enable this method?', '6', '0', 'tep_cfg_select_option_checkbox(array(\'true\', \'false\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Consignment displayed information', 'MODULE_SHIPPING_NWPOSHTANEW_CONSIGNMENT_DISPLAYED_INFORMATION', 'cn_number, order_number, estimated_shipping_date, recipient, recipient_address, shipping_cost, status', 'Select displayed information.', '6', '20', 'nwposhtanew->get_multioption_nwposhtanew',  'nwposhtanew_cfg_select_multioption_indexed(array(\'cn_identifier\', \'cn_number\', \'order_number\', \'create_date\', \'actual_shipping_date\', \'preferred_shipping_date\', \'estimated_shipping_date\', \'recipient_date\', \'last_updated_status_date\', \'sender\', \'sender_address\', \'recipient\', \'recipient_address\', \'weight\', \'seats_amount\', \'declared_cost\', \'shipping_cost\', \'backward_delivery\', \'service_type\', \'description\', \'additional_information\', \'payer_type\', \'payment_method\', \'departure_type\', \'packing_number\', \'rejection_reason\', \'status\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Delivery payer', 'MODULE_SHIPPING_NWPOSHTANEW_DELIVERY_PAYER', 'Recipient', 'Do you want to enable this method?', '6', '0', 'tep_cfg_select_option_nwposhtanew(array(\'Sender\', \'Recipient\', \'ThirdPerson\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Weight', 'MODULE_SHIPPING_NWPOSHTANEW_WEIGHT', '1', 'Do you want to enable this method?', '6', '0', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Width', 'MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_W', '1', 'Do you want to enable this method?', '6', '0', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Length', 'MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_L', '1', 'Do you want to enable this method?', '6', '0', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Height', 'MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_H', '1', 'Do you want to enable this method?', '6', '0', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Save TTN one click', 'MODULE_SHIPPING_NWPOSHTANEW_SAVE_TTN_ONE_CLICK', 'true', 'Do you want to enable this method?', '6', '0', 'tep_cfg_select_option_checkbox(array(\'true\', \'false\'), ', now())");

    }

    function remove()
    {
        tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", static::keys()) . "')");

        tep_db_query("DROP TABLE `novaposhta_cities`,  `novaposhta_warehouses_api`, `novaposhta_references`");
    }

    static function keys()
    {
        return array('MODULE_SHIPPING_NWPOSHTANEW_STATUS', 'MODULE_SHIPPING_NWPOSHTANEW_DEBUGGING_MODE', 'MODULE_SHIPPING_NWPOSHTANEW_API_KEY',
            'MODULE_SHIPPING_NWPOSHTANEW_CUSTOM_NAME', 'MODULE_SHIPPING_NWPOSHTANEW_SHIPPING_PRICE_TEXT', 'MODULE_SHIPPING_NWPOSHTANEW_SHOW_SHIPPING_COST_STATUS',
            'MODULE_SHIPPING_NWPOSHTANEW_COST', 'MODULE_SHIPPING_NWPOSHTANEW_TAX_CLASS', 'MODULE_SHIPPING_NWPOSHTANEW_ZONE',
            'MODULE_SHIPPING_NWPOSHTANEW_SORT_ORDER', 'MODULE_SHIPPING_NWPOSHTANEW_SENDER_REGION', 'MODULE_SHIPPING_NWPOSHTANEW_SENDER_CITY_NAME',
            'MODULE_SHIPPING_NWPOSHTANEW_SENDER_ADDRESS_NAME', 'MODULE_SHIPPING_NWPOSHTANEW_AUTODETECTION_DEPARTURE_TYPE',
            'MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_TYPE', 'MODULE_SHIPPING_NWPOSHTANEW_SEATS_AMOUNT',
            'MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_DESCRIPTION', 'MODULE_SHIPPING_NWPOSHTANEW_BACKWARD_DELIVERY',
            'MODULE_SHIPPING_NWPOSHTANEW_DECLARED_COST', 'MODULE_SHIPPING_NWPOSHTANEW_DECLARED_COST_DEFAULT',
            'MODULE_SHIPPING_NWPOSHTANEW_BACKWARD_DELIVERY_PAYER', 'MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_TYPE', 'MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_COD',
            'MODULE_SHIPPING_NWPOSHTANEW_MONEY_TRANSFER_METHOD', 'MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_CONTROL',
            'MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_ADDITIONAL_INFORMATION', 'MODULE_SHIPPING_NWPOSHTANEW_PRINT_FORMAT',
            'MODULE_SHIPPING_NWPOSHTANEW_TEMPLATE_TYPE', 'MODULE_SHIPPING_NWPOSHTANEW_PRINT_TYPE', 'MODULE_SHIPPING_NWPOSHTANEW_PRINT_START',
            'MODULE_SHIPPING_NWPOSHTANEW_NUMBER_OF_COPIES', 'MODULE_SHIPPING_NWPOSHTANEW_DISPLAY_ALL_CONSIGNMENTS',
            'MODULE_SHIPPING_NWPOSHTANEW_CONSIGNMENT_DISPLAYED_INFORMATION', 'MODULE_SHIPPING_NWPOSHTANEW_DELIVERY_PAYER',
            'MODULE_SHIPPING_NWPOSHTANEW_WEIGHT', 'MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_W', 'MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_L',
            'MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_H', 'MODULE_SHIPPING_NWPOSHTANEW_SAVE_TTN_ONE_CLICK');
    }
}

if (!function_exists('get_multioption_nwposhtanew')) {
    function get_multioption_nwposhtanew($values)
    {
        if (tep_not_null($values)) {
            $values_array = explode(',', $values);
            foreach ($values_array as $key => $_method) {
                if ($_method == '--none--') {
                    $method = $_method;
                } else {
                    $method = constant('NWPOSHTANEW_' . trim($_method));
                }
                $readable_values_array[] = $method;
            }
            $readable_values = implode(', ', $readable_values_array);
            return $readable_values;
        } else {
            return '';
        }
    }
}

function nwposhtanew_cfg_select_multioption_indexed($select_array, $key_value, $key = '')
{
    for ($i = 0; $i < sizeof($select_array); $i++) {
        $name = (($key) ? 'configuration[' . $key . '][]' : 'configuration_value');
        $string .= '<br><input type="checkbox" name="' . $name . '" value="' . $select_array[$i] . '"';
        $key_values = explode(", ", $key_value);
        if (in_array($select_array[$i], $key_values)) {
            $string .= ' CHECKED';
        }
        $string .= '> ' . constant('MODULE_SHIPPING_NWPOSHTANEW_' . trim($select_array[$i]));
    }
    $string .= '<input type="hidden" name="' . $name . '" value="--none--">';
    return $string;
}

// Alias function for Store configuration values in the Administration Tool
function tep_cfg_select_option_nwposhtanew($select_array, $key_value, $key = ''): string
{
    $string = '';

    for ($i = 0, $n = sizeof($select_array); $i < $n; $i++) {
        $values_array = explode(':', $select_array[$i]);

        if (is_dir(DIR_FS_CATALOG . 'ext/' . $values_array[0]) or $values_array[1] == '') {
            $name = ((tep_not_null($key)) ? 'configuration[' . $key . ']' : 'configuration_value');
            $string .= '
            <div class="radio">
              <label class="i-checks i-checks-sm">
                <input class="ajaxRadio" type="radio" name="' . $name . '" value="' . $select_array[$i] . '"';
            if ($key_value == $select_array[$i]) {
                $string .= ' CHECKED';
            }
            $var = explode(':', $select_array[$i]);
            $flag = end($var);
            if (defined('MODULE_SHIPPING_NWPOSHTANEW_' . $flag)) {
                $flag = constant('MODULE_SHIPPING_NWPOSHTANEW_' . $flag);
            }
            $string .= ' >
                <i></i>
                ' . $flag . '
              </label>
            </div>
        ';
            // $string .= '<div class="radio"><lable><input class="" type="radio" name="' . $name . '" value="' . $select_array[$i] . '"';
            // if ($key_value == $select_array[$i]) $string .= ' CHECKED';
            // $string .= '>' . $select_array[$i];
            //    $string .= '</lable></div> ';
        } else {
            $string = '<a class="buyme" target="_blank" href="https://solomono.net/?module=' . $values_array[0] . '">' . ADMIN_BTN_BUY_MODULE . '</a>';
        }

    }

    return $string;
}

//get payment modules
if (!function_exists('tep_get_payment_modules')) {
    function tep_get_payment_modules($module_id, $key = '') {
        $name = (($key) ? 'configuration[' . $key . ']' : 'configuration_value');
        // set php_self in the local scope
        if (!isset($PHP_SELF)) $PHP_SELF = $_SERVER['PHP_SELF'];
        $module_payment_directory = DIR_FS_CATALOG_MODULES . 'payment/';
        $file_extension = substr($PHP_SELF, strrpos($PHP_SELF, '.'));
        $directory_array = array();
        if ($dir = @dir($module_payment_directory)) {
            while ($file = $dir->read()) {
                if (!is_dir($module_payment_directory . $file)) {
                    if (substr($file, strrpos($file, '.')) == $file_extension) {
                        $directory_array[] = $file; // array of all the payment modules present in includes/modules/payment
                    }
                }
            }
            sort($directory_array);
            $dir->close();
        }
        $module_active = explode (";",MODULE_PAYMENT_INSTALLED);
        $installed_payment_modules = array();
        for ($i = 0, $n = sizeof($directory_array); $i < $n; $i++) {
            $file = $directory_array[$i];
            if (in_array($directory_array[$i], $module_active)) {
                includeLanguages(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/modules/payment/' . $file);
                $class = substr($file, 0, strrpos($file, '.'));
                $installed_payment_modules[] = array(
                    'id' => $class,
                    'text' => getConstantValue('MODULE_PAYMENT_' . strtoupper($class) . '_TEXT_TITLE')
                );
            }
        }

        for ($j = 0; $j < sizeof($installed_payment_modules); $j++) {
            $name = (($key) ? 'configuration[' . $key . '][]' : 'configuration_value');
            $string .= '<br><input type="checkbox" name="' . $name . '" value="' . $installed_payment_modules[$j]['id'] . '"';
            $key_values = explode(", ", $module_id);
            if (in_array($installed_payment_modules[$j]['id'], $key_values)) {
                $string .= ' CHECKED';
            }
            $string .= '> ' . $installed_payment_modules[$j]['text'];
        }
        $string .= '<input type="hidden" name="' . $name . '" value="--none--">';
        return $string;
    }
}

function tep_cfg_pull_down_nwposhtanew($select_array, $backward_delivery_id, $key = '')
{
    $name = (($key) ? 'configuration[' . $key . ']' : 'configuration_value');
    $backward_delivery_array = array(array('id' => '0', 'text' => ''));

    for ($i = 0, $n = sizeof($select_array); $i < $n; $i++) {
        $var = explode(':', $select_array[$i]);
        $flag = end($var);
        if (defined('MODULE_SHIPPING_NWPOSHTANEW_' . $flag)) {
            $flag = constant('MODULE_SHIPPING_NWPOSHTANEW_' . $flag);
        }
        $backward_delivery_array[] = array(
            'id' => $select_array[$i],
            'text' => $flag ?: ''
        );
    }

    return tep_draw_pull_down_menu($name, $backward_delivery_array, $backward_delivery_id);
}

