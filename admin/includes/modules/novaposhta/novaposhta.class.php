<?php

class novaposhta
{
    public $key_api = null;
    public function __construct()
    {
        $this->key_api = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_API_KEY', '');
    }

    public function creatTables() {
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
    }

    public function deleteTables() {
        tep_db_query("DROP TABLE `novaposhta_cities`,  `novaposhta_warehouses_api`, `novaposhta_references`");
    }

    public function getOrder($order_id) {
        $query = tep_db_query("SELECT * FROM `" . TABLE_ORDERS . "` WHERE `orders_id` = '" . (int)$order_id . "'");
        return tep_db_fetch_array($query);
    }

    public function getOrderByDocumentNumber($number) {
        $query = tep_db_query("SELECT `orders_id` FROM `" . TABLE_ORDERS . "` WHERE `novaposhta_cn_number` = '" . $number . "'");

        return tep_db_fetch_array($query);
    }


    public function getOrderProducts($order_id): array
    {
        $product_data = array();
        global $languages_id;
        $products = tep_db_query("SELECT `op`.*, `p`.`products_model`, `p`.`products_weight` FROM " . TABLE_ORDERS_PRODUCTS . " AS `op` INNER JOIN " . TABLE_PRODUCTS . " AS `p` ON `op`.`products_id` = `p`.`products_id` AND `op`.`orders_id` = " . (int)$order_id);
        $result_products[] = tep_db_fetch_array($products);

        foreach ($result_products as $product) {
            $options = tep_db_query("SELECT * FROM ".TABLE_ORDERS_PRODUCTS_ATTRIBUTES." WHERE `orders_id` = '" . (int)$order_id . "' AND `orders_products_id` = '" . (int)$product['orders_products_id'] . "'");
            $result_options[] = tep_db_fetch_array($options);
            $option_data   = array();
            $option_weight = 0;

            foreach ($result_options as $option) {
                if ($option['type'] != 'file') {
                    $option_data[] = array(
                        'name'  => $option['name'],
                        'value' => $option['value']
                    );
                }

                $product_option_value_info = tep_db_query("SELECT `pov`.`products_options_values_name`, `pov`.`products_options_values_id` FROM " . TABLE_PRODUCTS_OPTIONS_VALUES . " AS `pov` WHERE `pov`.`products_options_values_id` = '" . (int)$product['products_id'] . "' AND `pov`.`products_options_values_id` = '" . (int)$option['products_options_values_id'] . "' AND `pov`.`language_id` = '" . (int)$languages_id . "'");
                $result_product_option_value_info[] = tep_db_fetch_array($product_option_value_info);
                if ($result_product_option_value_info) {
                    if ($result_product_option_value_info['weight_prefix'] == '+') {
                        $option_weight += $result_product_option_value_info['weight'];
                    } elseif ($result_product_option_value_info['weight_prefix'] == '-') {
                        $option_weight -= $result_product_option_value_info['weight'];
                    }
                }
            }

            $ean  = '';
            $jan  = '';
            $isbn = '';
            $mpn  = '';

            $product_data[] = array(
                'order_product_id' => $product['orders_products_id'],
                'name'             => $product['products_name'],
                'model'            => $product['products_model'],
                'option'   	 	   => $option_data,
                'quantity'         => $product['products_quantity'],
                'sku'              => '',
                'upc'              => '',
                'ean'              => $ean,
                'jan'              => $jan,
                'isbn'             => $isbn,
                'mpn'              => $mpn,
                'weight'           => '',
                'weight_class_id'  => '',
                'length'           => '',
                'width'            => '',
                'height'           => '',
                'length_class_id'  => ''
            );
        }

        return $product_data;
    }

    public function addCNToOrder($order_id, $number, $ref = '') {
        $sql = "UPDATE `" . TABLE_ORDERS . "` SET `novaposhta_cn_number` = '" . trim($number) . "', `novaposhta_cn_ref` = '" . trim($ref) . "' WHERE `orders_id` = " . (int)$order_id;

        tep_db_query($sql);
    }

    public function deleteCNFromOrder($orders) {
        foreach ($orders as $k => $v) {
            $orders[$k] = "'" . $v . "'";
        }

        tep_db_query("UPDATE `" . TABLE_ORDERS . "` SET `novaposhta_cn_number` = '', `novaposhta_cn_ref` = '' WHERE `orders_id` IN (" . implode(',', $orders) . ")");
    }

    public function getSimpleFields($order_id) {
        $data = array();

        $table_query = tep_db_query("SHOW TABLES LIKE '" . TABLE_ORDERS . "_simple_fields'");
        $table = tep_db_fetch_array($table_query);

        if ($table) {
            $data = tep_db_query("SELECT * FROM `" . TABLE_ORDERS . "_simple_fields` WHERE `orders_id` = '" . (int) $order_id . "'");
        }

        return $data;
    }

    public function getZoneIDByName($name) {
        $query = tep_db_query("SELECT `zone_id` FROM `" . TABLE_ZONES . "` WHERE `zone_name` = '" . $name . "'");
        $zone = tep_db_fetch_array($query);

        return !empty($zone['zone_id']) ? $zone['zone_id'] : false;
    }

    public function getZonesByCountryId($id): array
    {
        $query = tep_db_query("SELECT `zone_id`, `zone_name` FROM `" . TABLE_ZONES . "` WHERE `zone_country_id` = '" . $id . "'");
        $zones = [];
        while ($row = tep_db_fetch_array($query)) {
            $zones[] = $row;
        }

        return $zones;
    }

    public function getZoneById($id): array
    {
        $query = tep_db_query("SELECT `zone_id`, `zone_name` FROM `" . TABLE_ZONES . "` WHERE `zone_id` = '" . $id . "'");

        return tep_db_fetch_array($query);
    }

    public function getOrderTotals($id)
    {
        $sql = "SELECT
                  `ot`.`title`,
                  `ot`.`class`,
                  `ot`.`text`,
                  `ot`.`value`
                FROM `orders_total` `ot`
                WHERE `orders_id` = '{$id}'
                ORDER BY `sort_order`";

        $query = tep_db_query($sql);
        $results = [];
        while ($row[] = tep_db_fetch_array($query)) {
            $results = $row;
        }

        return $results;
    }

    /**
     * @param $string
     *
     * @return string only cyrillic letter
     */
    function to_cyrillic($string): string
    {
        $gost = [
            "a" => "а", "b" => "б", "v" => "в", "g" => "г", "d" => "д", "e" => "е", "yo" => "ё",
            "j" => "ж", "z" => "з", "i" => "і", "ji" => "й", "k" => "к",
            "l" => "л", "m" => "м", "n" => "н", "o" => "о", "p" => "п", "r" => "р", "s" => "с", "t" => "т",
            "y" => "у", "f" => "ф", "h" => "х", "c" => "ц",
            "ch" => "ч", "sh" => "ш", "sch" => "щ", "ie" => "ы", "u" => "у", "ya" => "я", "A" => "А", "B" => "Б",
            "V" => "В", "G" => "Г", "D" => "Д", "E" => "Е", "Yo" => "Ё", "J" => "Ж", "Z" => "З", "I" => "І", "Ji" => "Й",
            "K" => "К", "L" => "Л", "M" => "М",
            "N" => "Н", "O" => "О", "P" => "П",
            "R" => "Р", "S" => "С", "T" => "Т", "Y" => "Ю", "F" => "Ф", "H" => "Х", "C" => "Ц", "Ch" => "Ч", "Sh" => "Ш",
            "Sch" => "Щ", "Ie" => "Ы", "U" => "У", "Ya" => "Я", "'" => "ь", "_'" => "Ь", "''" => "ъ", "_''" => "Ъ",
            "yi" => "ї", "ge" => "ґ",
            "ye" => "є",
            "Yi" => "Ї",
            "II" => "І",
            "Ge" => "Ґ",
            "YE" => "Є",
        ];
        return strtr($string, $gost);
    }
}
