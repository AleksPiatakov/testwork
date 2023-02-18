<?php

use App\Logger\Log;

class NovaPoshtaAPI
{
    public $key_api = NULL;
    public $description_field = NULL;
    public $error = [];
    private $api_url = "https://api.novaposhta.ua/v2.0/json/";
    private $registry = NULL;


    public function __construct()
    {
        $this->key_api = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_API_KEY','');

        if ($this->key_api === '') {
            $this->key_api = $_REQUEST['api_key'];
        }

        switch ($GLOBALS['languages_code']) {
            case "ru":
            case "ru-ru":
                $this->description_field = "DescriptionRu";
                break;
            default:
                $this->description_field = "Description";
        }
    }
    public function __get($name)
    {
        return $this->registry->get($name);
    }

    public function __set($name, $value) {

        return $this->registry->set($name, $value);
    }

    public function __isset($name) {

        return isset($name);
    }

    public function update($type): ?int
    {
        $data_count = 0;
        if ($type == "areas") {
            $data = $this->apiRequest("Address", "getAreas");
            if ($data) {
                foreach ($data as $k => $v) {
                    $data[$v["Description"]] = $v;
                    unset($data[$k]);
                    $data_count++;
                }
                try {
                    tep_db_query("INSERT INTO `novaposhta_references` (`type`, `value`) VALUES ('areas', '" . json_encode($data, JSON_UNESCAPED_UNICODE) . "') ON DUPLICATE KEY UPDATE `value`='" . json_encode($data, JSON_UNESCAPED_UNICODE) . "'");
                } catch (Exception $e) {
                    if (getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DEBUGGING_MODE', 'false') !== 'false') {
                        Log::warning($e->getMessage());
                    }
                }
            }
        } else {
            if ($type == "cities") {
                for ($current_page = 1; $data = $this->apiRequest("Address", "getCities", ["Page" => $current_page, "Limit" => 500]); $current_page++) {
                    if ($current_page == 1) {
                        tep_db_query("TRUNCATE TABLE `novaposhta_cities`");
                    }
                    foreach ($data as $v) {
                        if ($v["Description"] || $v["DescriptionRu"]) {
                            if (!$v["Description"]) {
                                $v["Description"] = $v["DescriptionRu"];
                            } else {
                                if (!$v["DescriptionRu"]) {
                                    $v["DescriptionRu"] = $v["Description"];
                                }
                            }
                            $sql = "INSERT INTO `novaposhta_cities` (`CityID`, `Ref`, `Description`, `DescriptionRu`, `Area`, `SettlementType`, `SettlementTypeDescription`, `SettlementTypeDescriptionRu`, `Delivery1`, `Delivery2`, `Delivery3`, `Delivery4`, `Delivery5`, `Delivery6`, `Delivery7`, `Conglomerates`, `PreventEntryNewStreetsUser`, `IsBranch`, `SpecialCashCheck`) VALUES (\r\n                        '" . (int) $v["CityID"] . "',\r\n                        '" . $v["Ref"] . "',\r\n                        '" . tep_db_input($v["Description"]) . "', \r\n\t\t\t\t\t\t'" . tep_db_input($v["DescriptionRu"]) . "', \t\t\t\t\t\t \r\n\t\t\t\t\t\t'" . $v["Area"] . "', \r\n\t\t\t\t\t    '" . $v["SettlementType"] . "',\r\n\t\t\t\t\t\t'" . (isset($v["SettlementTypeDescription"]) ? $v["SettlementTypeDescription"] : "") . "',\r\n\t\t\t\t\t\t'" . (isset($v["SettlementTypeDescriptionRu"]) ? $v["SettlementTypeDescriptionRu"] : "") . "',\r\n\t\t\t\t\t\t'" . (int) $v["Delivery1"] . "', \r\n\t\t\t\t\t\t'" . (int) $v["Delivery2"] . "', \r\n\t\t\t\t\t\t'" . (int) $v["Delivery3"] . "', \r\n\t\t\t\t\t\t'" . (int) $v["Delivery4"] . "', \r\n\t\t\t\t\t\t'" . (int) $v["Delivery5"] . "', \r\n\t\t\t\t\t\t'" . (int) $v["Delivery6"] . "', \r\n\t\t\t\t\t\t'" . (int) $v["Delivery7"] . "',\r\n\t\t\t\t\t\t'" . ($v["Conglomerates"] != NULL ? json_encode($v["Conglomerates"], JSON_UNESCAPED_UNICODE) : $v["Conglomerates"]) . "', \r\n\t\t\t\t\t\t'" . (int) $v["PreventEntryNewStreetsUser"] . "',\r\n\t\t\t\t\t\t'" . (int) $v["IsBranch"] . "', \r\n\t\t\t\t\t\t'" . (int) $v["SpecialCashCheck"] . "'\r\n\t\t\t\t\t)" . "ON DUPLICATE KEY UPDATE `Ref`='" . $v["Ref"] . "'";
                            try {
                                tep_db_query($sql);
                                $data_count++;
                            } catch (Exception $e) {
                                if (getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DEBUGGING_MODE', 'false') !== 'false') {
                                    Log::warning($e->getMessage());
                                }
                            }
                        }
                    }
                }
            } else {
                if ($type == "warehouses") {
                    for ($current_page = 1; $data = $this->apiRequest("Address", "getWarehouses", ["Page" => $current_page, "Limit" => 500]); $current_page++) {
                        if ($current_page == 1) {
                            tep_db_query("TRUNCATE TABLE `novaposhta_warehouses_api`");
                        }
                        foreach ($data as $v) {
                            if ($v["Description"] || $v["DescriptionRu"]) {
                                if (!$v["Description"]) {
                                    $v["Description"] = $v["DescriptionRu"];
                                } else {
                                    if (!$v["DescriptionRu"]) {
                                        $v["DescriptionRu"] = $v["Description"];
                                    }
                                }
                                $description = preg_replace(["/\"([^\"]*)\"/", "/\"/"], ["«\$1»", ""], $v["Description"]);
                                $description_ru = preg_replace(["/\"([^\"]*)\"/", "/\"/"], ["«\$1»", ""], $v["DescriptionRu"]);
                                $sql = "INSERT INTO `novaposhta_warehouses_api` (`SiteKey`, `Ref`, `Description`, `DescriptionRu`, `ShortAddress`, `ShortAddressRu`, `TypeOfWarehouse`, `CityRef`, `CityDescription`, `CityDescriptionRu`, `Number`, `Phone`,  `Longitude`, `Latitude`, `PostFinance`, `BicycleParking`, `PaymentAccess`, `POSTerminal`, `InternationalShipping`, `TotalMaxWeightAllowed`, `PlaceMaxWeightAllowed`, `Reception`, `Delivery`, `Schedule`, `DistrictCode`, `WarehouseStatus`, `CategoryOfWarehouse`) VALUES (\r\n                        '" . (int) $v["SiteKey"] . "',\r\n                        '" . $v["Ref"] . "',\r\n\t\t\t\t\t\t'" . tep_db_input($description) . "',\r\n\t\t\t\t\t\t'" . tep_db_input($description_ru) . "',\r\n\t\t\t\t\t\t'" . tep_db_input($v["ShortAddress"]) . "',\r\n\t\t\t\t\t\t'" . tep_db_input($v["ShortAddressRu"]) . "',\r\n\t\t\t\t\t\t'" . $v["TypeOfWarehouse"] . "',\r\n\t\t\t\t\t\t'" . $v["CityRef"] . "',\r\n\t\t\t\t\t\t'" . tep_db_input($v["CityDescription"]) . "',\r\n\t\t\t\t\t\t'" . tep_db_input($v["CityDescriptionRu"]) . "',\r\n\t\t\t\t\t\t'" . (int) $v["Number"] . "',\r\n\t\t\t\t\t\t'" . $v["Phone"] . "',\r\n\t\t\t\t\t\t'" . $v["Longitude"] . "', \r\n\t\t\t\t\t\t'" . $v["Latitude"] . "',\r\n\t\t\t\t\t\t'" . (int) $v["PostFinance"] . "', \r\n\t\t\t\t\t\t'" . (int) $v["BicycleParking"] . "', \r\n\t\t\t\t\t\t'" . (int) $v["PaymentAccess"] . "', \r\n\t\t\t\t\t\t'" . (int) $v["POSTerminal"] . "', \r\n\t\t\t\t\t\t'" . (int) $v["InternationalShipping"] . "', \r\n\t\t\t\t\t\t'" . (int) $v["TotalMaxWeightAllowed"] . "', \r\n\t\t\t\t\t\t'" . (int) $v["PlaceMaxWeightAllowed"] . "', \r\n\t\t\t\t\t\t'" . json_encode($v["Reception"]) . "', \r\n\t\t\t\t\t\t'" . json_encode($v["Delivery"]) . "', \r\n\t\t\t\t\t\t'" . json_encode($v["Schedule"]) . "',\r\n\t\t\t\t\t\t'" . tep_db_input($v["DistrictCode"]) . "',\r\n\t\t\t\t\t\t'" . $v["WarehouseStatus"] . "',\r\n\t\t\t\t\t\t'" . $v["CategoryOfWarehouse"] . "'\r\n\t\t\t\t\t)";
                                try {
                                    tep_db_query($sql);
                                    $data_count++;
                                } catch (Exception $e) {
                                    if (getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DEBUGGING_MODE', 'false') !== 'false') {
                                        Log::warning($e->getMessage());
                                    }
                                }
                            }
                        }
                    }
                } else {
                    if ($type == "references") {
                        //$post_fields = ["extension" => "novaposhta"];
                        //$options = [CURLOPT_HEADER => false, CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => false, CURLOPT_POST => true, CURLOPT_POSTFIELDS => $post_fields, CURLOPT_RETURNTRANSFER => true];
                        //if (getConstantValue('CURL_CONNECTTIMEOUT', 'false') !== 'false') {
                        //    $options[CURLOPT_CONNECTTIMEOUT] = getConstantValue('CURL_CONNECTTIMEOUT');
                        //}
                        //if (getConstantValue('CURL_TIMEOUT') && getConstantValue('CURL_CONNECTTIMEOUT') < getConstantValue('CURL_TIMEOUT')) {
                        //    $options[CURLOPT_TIMEOUT] = getConstantValue('CURL_TIMEOUT');
                        //}
                        //$ch = curl_init("");
                        //curl_setopt_array($ch, $options);
                        //$response = curl_exec($ch);
                        //curl_close($ch);
                        //$data = json_decode($response, true);
                        $data["senders"] = $this->getCounterparties("Sender");
                        $data["third_persons"] = $this->getCounterparties("ThirdPerson");
                        if ($data["senders"]) {
                            foreach ($data["senders"] as $sender) {
                                $data["sender_options"][$sender["Ref"]] = $this->getCounterpartyOptions($sender["Ref"]);
                                $data["sender_contact_persons"][$sender["Ref"]] = $this->getContactPerson($sender["Ref"]);
                                $data["sender_addresses"][$sender["Ref"]] = $this->getCounterpartyAddresses($sender["Ref"], "Sender");
                            }
                        }
                        $data["warehouse_types"] = $this->apiRequest("Address", "getWarehouseTypes");
                        $data["service_types"] = $this->apiRequest("Common", "getServiceTypes");
                        $data["cargo_types"] = $this->apiRequest("Common", "getCargoTypes");
                        $data["pack_types"] = $this->apiRequest("Common", "getPackList");
                        $data["tires_and_wheels"] = $this->apiRequest("Common", "getTiresWheelsList");
                        $data["payer_types"] = $this->apiRequest("Common", "getTypesOfPayers");
                        $data["payment_types"] = $this->apiRequest("Common", "getPaymentForms");
                        $data["backward_delivery_types"] = $this->apiRequest("Common", "getBackwardDeliveryCargoTypes");
                        $data["backward_delivery_payers"] = $this->apiRequest("Common", "getTypesOfPayersForRedelivery");
                        $data["cargo_description"] = array_merge($this->apiRequest("Common", "getCargoDescriptionList", ["Page" => 1]), $this->apiRequest("Common", "getCargoDescriptionList", ["Page" => 2]));
                        $data["ownership_forms"] = $this->apiRequest("Common", "getOwnershipFormsList");
                        $data["counterparties_types"] = $this->apiRequest("Common", "getTypesOfCounterparties");
                        $data["errors"] = $this->getErrors();
                        if (0 < count($data, COUNT_RECURSIVE) - count($data)) {
                            foreach ($data as $k => $v) {
                                $test = json_encode($v);
                                tep_db_query("INSERT INTO `novaposhta_references` (`type`, `value`) VALUES ('" . $k . "', '" . tep_db_input(json_encode($v, JSON_UNESCAPED_UNICODE)) . "') ON DUPLICATE KEY UPDATE `value`='" . tep_db_input(json_encode($v, JSON_UNESCAPED_UNICODE)) . "'");
                            }
                        }
                        $data_count = count($data);
                    }
                }
            }
        }
        if ($data_count) {
            $date = new DateTime();
            $database = $this->getReferences("database");
            $database[$type]["update_datetime"] = $date->format('d/m/Y H:i:s');
            $database[$type]["amount"] = $data_count;
            tep_db_query("INSERT INTO `novaposhta_references` (`type`, `value`) VALUES ('database', '" . json_encode($database) . "') ON DUPLICATE KEY UPDATE `value`='" . json_encode($database) . "'");
        }
        return $data_count;
    }
    public function apiRequest($model, $method, $properties = [])
    {
        $request = ["apiKey" => $this->key_api, "modelName" => $model, "calledMethod" => $method];
        if (!empty($properties)) {
            $request["methodProperties"] = $properties;
        }
        $json = json_encode($request);
        $options = [CURLOPT_HTTPHEADER => ["Content-Type: application/json"], CURLOPT_HEADER => false, CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => false, CURLOPT_POST => true, CURLOPT_POSTFIELDS => $json, CURLOPT_RETURNTRANSFER => true];
        if (getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_CURL_CONNECTTIMEOUT', 'false') !== 'false') {
            $options[CURLOPT_CONNECTTIMEOUT] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_CURL_CONNECTTIMEOUT');
        }
        if (getConstantValue('CURL_TIMEOUT') && getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_CURL_CONNECTTIMEOUT') < getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_CURL_TIMEOUT')) {
            $options[CURLOPT_TIMEOUT] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_CURL_TIMEOUT');
        }
        $ch = curl_init($this->api_url);
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        if (getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DEBUGGING_MODE', 'false') !== 'false') {
            Log::warning("Nova Poshta API request: " . $json);
            Log::warning("Nova Poshta API response: " . $response);
            if ($response === false) {
                Log::warning("cURL error: " . curl_error($ch));
            }
        }
        curl_close($ch);
        $response = json_decode($response, true);
        $this->parseErrors($response);
        if (isset($response["success"]) && isset($response["data"]) && $response["success"]) {
            $data = $response["data"];
        } else {
            $data = false;
        }
        return $data;
    }
    private function parseErrors($response): void
    {
        $error_types = ["errorCodes" => "errors", "warningCodes" => "warnings", "infoCodes" => "info"];
        if (!(empty($response["errorCodes"]) && empty($response["warningCodes"]) && empty($response["infoCodes"]))) {
            $errors_list = $this->getReferences("errors");
            if (!is_array($errors_list)) {
                $errors_list = [];
            }
        }
        foreach ($error_types as $code => $type) {
            if (!empty($response[$type]) && is_array($response[$type])) {
                foreach ($response[$type] as $k => $error) {
                    if (is_array($error)) {
                        foreach ($error as $i => $e) {
                            if (isset($response[$code][$k][$i]) && array_key_exists($response[$code][$k][$i], $errors_list)) {
                                $error_text = "Nova Poshta " . $type . ": " . $errors_list[$response[$code][$k][$i]]["Description"];
                            } else {
                                $error_text = "Nova Poshta " . $type . ": " . $e;
                            }
                            if ($type != "info") {
                                $this->error[] = $error_text;
                            }
                            if (getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DEBUGGING_MODE', 'false') !== 'false') {
                                Log::warning($error_text);
                            }
                        }
                    } else {
                        if (isset($response[$code][$k]) && isset($errors_list[$response[$code][$k]]) && isset($errors_list[$response[$code][$k]]["Description"])) {
                            $error_text = "Nova Poshta " . $type . ": " . $errors_list[$response[$code][$k]]["Description"];
                        } else {
                            $error_text = "Nova Poshta " . $type . ": " . $error;
                        }
                        if ($type != "info") {
                            $this->error[] = $error_text;
                        }
                        if (getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DEBUGGING_MODE', 'false') !== 'false') {
                            Log::warning($error_text);
                        }
                    }
                }
            }
        }
    }
    public function getReferences($type = "")
    {
        $data = [];
        if ($type) {
            $query = tep_db_query("SELECT `value` FROM `novaposhta_references` WHERE `type` = '" . $type . "'");
            $result = tep_db_fetch_array($query);

            if (isset($result["value"])) {
                $data = json_decode($result["value"], true);
                if (is_array($data)) {
                    foreach ($data as $k => $v) {
                        if (isset($v[$this->description_field]) && $this->description_field != "Description") {
                            $data[$k]["Description"] = $v[$this->description_field];
                        }
                    }
                }
            }
        } else {
            $query = tep_db_query("SELECT `type`, `value` FROM `novaposhta_references` WHERE `type` != 'cargo_description'");
            $results = [];
            while ($row = tep_db_fetch_array($query)) {
                $results[] = $row;
            }
            if (is_array($results)) {
                foreach ($results as $r) {
                    $data[$r["type"]] = json_decode($r["value"], true);
                    if (is_array($data[$r["type"]])) {
                        foreach ($data[$r["type"]] as $k => $v) {
                            if (isset($v[$this->description_field]) && $this->description_field != "Description") {
                                $data[$r["type"]][$k]["Description"] = $v[$this->description_field];
                            }
                        }
                    }
                }
            }
        }
        return $data;
    }
    public function getCounterparties($counterparty_type, $search = "", $city_ref = "")
    {
        $properties = ["CounterpartyProperty" => $counterparty_type];
        if ($search && !preg_match("/[^А-яҐґЄєIіЇїё0-9\\-\\`'\\s]+/iu", $search)) {
            $properties["FindByString"] = $search;
        }
        if ($city_ref) {
            $properties["CityRef"] = $city_ref;
        }
        $data = $this->apiRequest("Counterparty", "getCounterparties", $properties);
        if (is_array($data)) {
            foreach ($data as $k => $v) {
                $data[$v["Ref"]] = $v;
                unset($data[$k]);
            }
        }
        return $data;
    }
    public function getCounterpartyOptions($ref)
    {
        $properties = ["Ref" => $ref];
        $data = $this->apiRequest("Counterparty", "getCounterpartyOptions", $properties);
        return isset($data[0]) ? $data[0] : $data;
    }
    public function getContactPerson($ref, $search = "")
    {
        $properties = ["Ref" => $ref];
        if ($search) {
            $properties["FindByString"] = $search;
        }
        $data = $this->apiRequest("Counterparty", "getCounterpartyContactPersons", $properties);
        if (is_array($data)) {
            foreach ($data as $k => $v) {
                $data[$v["Ref"]] = $v;
                unset($data[$k]);
            }
        }
        return $data;
    }
    public function getCounterpartyAddresses($counterparty_ref, $counterparty_type, $city_ref = "")
    {
        $properties = ["Ref" => $counterparty_ref, "CounterpartyProperty" => $counterparty_type];
        if ($city_ref) {
            $properties["CityRef"] = $city_ref;
        }
        $data = $this->apiRequest("Counterparty", "getCounterpartyAddresses", $properties);
        if (is_array($data)) {
            foreach ($data as $k => $v) {
                $data[$v["Ref"]] = $v;
                unset($data[$k]);
            }
        }
        return $data;
    }
    public function getErrors()
    {
        $data = $this->apiRequest("CommonGeneral", "getMessageCodeText");
        if (is_array($data)) {
            foreach ($data as $k => $v) {
                $data[$v["MessageCode"]] = ["MessageCode" => $v["MessageCode"], "Description" => $v["MessageDescriptionUA"], "DescriptionRu" => $v["MessageDescriptionRU"], "DescriptionEn" => $v["MessageText"]];
                unset($data[$k]);
            }
        }
        return $data;
    }
    public function getAreaRef($name)
    {
        $data = "";
        $novaposhta_areas = $this->getAreas();
        $areas = $this->areas();
        $sub_name = mb_substr($name, 0, 6, "UTF-8");
        foreach ($areas as $d => $v) {
            $match = preg_grep("/^" . $sub_name . "/ui", $v);
            if (!empty($match)) {
                $data = $novaposhta_areas[$d]["Ref"];
                return $data;
            }
        }
    }
    public function getAreas()
    {
        $data = $this->getReferences("areas");
        return $data;
    }
    public function areas(): array
    {
        return ["АРК" => ["Крим", "АРК", "Крым", "АРК", "Krym", "Crimea"], "Вінницька" => ["Вінниця", "Вінницька", "Винница", "Винницкая", "Vinnitsa", "Vinnitskaya"], "Волинська" => ["Волинь", "Волинська", "Волынь", "Волынская", "Volyn", "Volynskaya"], "Дніпропетровська" => ["Дніпро", "Дніпропетровськ", "Дніпропетровська", "Днепропетровск", "Днепропетровская", "Dnipropetrovsk", "Dnepropetrovskaya"], "Донецька" => ["Донецьк", "Донецька", "Донецк", "Донецкая", "Donetsk", "Donetskaya"], "Житомирська" => ["Житомир", "Житомирська", "Житомир", "Житомирская", "Zhytomyr", "Zhitomirskaya"], "Закарпатська" => ["Закарпаття", "Закарпатська", "Закарпатье", "Закарпатская", "Zakarpattya", "Zakarpatskaya"], "Запорізька" => ["Запоріжжя", "Запорізька", "Запорожье", "Запорожская", "Zaporizhia", "Zaporozhskaya"], "Івано-Франківська" => ["Івано-Франківськ", "Івано-Франківська", "Ивано-Франковск", "Ивано-Франковская", "Ivano-Frankivsk", "Ivano-Frankovskaya"], "Київська" => ["Київ", "Київська", "Киев", "Киевская", "Kyiv", "Kiyevskaya"], "Київ" => ["Київ", "Київська", "Киев", "Киевская", "Kyiv", "Kiyevskaya"], "Кіровоградська" => ["Кіровоград", "Кіровоградська", "Кировоград", "Кировоградская", "Kirovohrad", "Kirovogradskaya"], "Луганська" => ["Луганськ", "Луганська", "Луганск", "Луганская", "Lugansk", "Luganskaya"], "Львівська" => ["Львів", "Львівська", "Львов", "Львовская", "Lviv", "L'vovskaya"], "Миколаївська" => ["Миколаїв", "Миколаївська", "Николаев", "Николаевская", "Mykolaiv", "Nikolayevskaya"], "Одеська" => ["Одеса", "Одеська", "Одесса", "Одесская", "Odessa", "Odesskaya"], "Полтавська" => ["Полтава", "Полтавська", "Полтава", "Полтавская", "Poltava", "Poltavskaya"], "Рівненська" => ["Рівне", "Рівненська", "Ровно", "Ровненская", "Ровенская", "Rivne", "Rovenskaya"], "Сумська" => ["Суми", "Сумська", "Сумы", "Сумская", "Sums", "Sumskaya"], "Тернопільська" => ["Тернопіль", "Тернопільська", "Тернополь", "Тернопольская", "Ternopil", "Ternopol'skaya"], "Харківська" => ["Харків", "Харківська", "Харьков", "Харьковская", "Kharkov", "Khar'kovskaya"], "Херсонська" => ["Херсон", "Херсонська", "Херсон", "Херсонская", "Herson", "Khersonskaya"], "Хмельницька" => ["Хмельницьк", "Хмельницька", "Хмельницкий", "Хмельницкая", "Khmelnytsky", "Khmel'nitskaya"], "Черкаська" => ["Черкаси", "Черкаська", "Черкассы", "Черкасская", "Cherkassy", "Cherkasskaya"], "Чернівецька" => ["Чернівці", "Чернівецька", "Черновцы", "Черновицкая", "Chernivtsi", "Chernovitskaya"], "Чернігівська" => ["Чернігів", "Чернігівська", "Чернигов", "Черниговская", "Chernihiv", "Chernigovskaya"]];
    }
    public function getZoneIDByName($name)
    {
        $area = $this->areas();
        $area_name = $area[$name];
        $q_query = tep_db_query("SELECT * FROM `zones` WHERE `zone_country_id` = '220' AND `zone_name` LIKE '" . $area_name[3] . "%' ORDER BY `zone_name`");
        $q_results = [];
        while ($row = tep_db_fetch_array($q_query)){
            $q_results[] = $row;
        }
        foreach ($q_results as $q_result) {
            $sub_name = mb_substr($q_result["zone_name"], 0, 6, "UTF-8");
            $match = preg_grep("/^" . $sub_name . "/ui", $area_name);
            if (!empty($match)) {
                $data = $q_result;
                return !empty($data["zone_id"]) ? $data["zone_id"] : false;
            }
        }
    }
    public function getAreaName($ref)
    {
        $data = "";
        $novaposhta_areas = $this->getAreas();
        foreach ($novaposhta_areas as $d => $v) {
            if ($ref == $v["Ref"]) {
                $data = $d;
                return $data;
            }
        }
    }
    public function getCityArea($ref): string
    {
        $result = tep_db_query("SELECT `Area` FROM `novaposhta_cities` WHERE `Ref` = '" . $ref . "'");
        return $result ? $result["Area"] : "";
    }
    public function getCityRef($name)
    {
        $query = tep_db_query("SELECT `Ref` FROM `novaposhta_cities` WHERE `Description` = '" . $name . "' OR `DescriptionRu` = '" . $name . "'");
        $result = tep_db_fetch_array($query);

        return $result ? $result["Ref"] : "";
    }
    public function getCityName($ref): string
    {
        $result = tep_db_query("SELECT `" . $this->description_field . "` FROM `novaposhta_cities` WHERE `Ref` = '" . $ref . "'");
        return $result ? $result[$this->description_field] : "";
    }
    public function getCities($search = "", $area = ""): array
    {
        $data = [];
        $sql = "SELECT *, `" . $this->description_field . "` as `Description` FROM `novaposhta_cities` WHERE 1";
        if ($search) {
            $sql .= " AND (`Description` LIKE '" . tep_db_prepare_input($search) . "%' OR `DescriptionRu` LIKE '" . tep_db_prepare_input($search) . "%')";
        }
        if ($area) {
            $sql .= " AND `Area` = '" . $area . "'";
        }
        $sql .= " ORDER BY `" . $this->description_field . "` LIMIT 10";
        $query = tep_db_query($sql);
        $results = [];
        while ($row = tep_db_fetch_array($query)) {
            $results[] = $row;
        }
        foreach ($results as $result) {
            $data[] = ["Ref" => $result["Ref"],
                "Description" => $result[$this->description_field],
                "FullDescription" => $result[$this->description_field] . ", " . $this->getAreaName($result["Area"]) . " обл."];
        }
        return $data;
    }
    public function getWarehouseRef($name)
    {
        $query = tep_db_query("SELECT `Ref` FROM `novaposhta_warehouses_api` WHERE `Description` = '" . tep_db_prepare_input($name) . "' OR `DescriptionRu` = '" . tep_db_prepare_input($name) . "'");
        $results = tep_db_fetch_array($query);

        return $results ? $results["Ref"] : "";
    }
    public function getWarehouseName($ref)
    {
        $query = tep_db_query("SELECT `" . $this->description_field . "` FROM `novaposhta_warehouses_api` WHERE `Ref` = '" . $ref . "'");
        $results = tep_db_fetch_array($query);

        return $results ? $results[$this->description_field] : "";
    }
    public function getWarehouseByCity($warehouse, $city)
    {
        $query = tep_db_query("SELECT `" . $this->description_field . "` as `Description`, `Ref` FROM `novaposhta_warehouses_api` WHERE (`Ref` = '" . $warehouse . "' OR `Description` = '" . tep_db_prepare_input($warehouse) . "' OR `DescriptionRu` = '" . tep_db_prepare_input($warehouse) . "') AND (`CityRef` = '" . $city . "' OR `CityDescription` = '" . tep_db_prepare_input($city) . "' OR `CityDescriptionRu` = '" . tep_db_prepare_input($city) . "')");
        return tep_db_fetch_array($query);
    }
    public function getWarehousesByCityRef($city_ref, $search = ""): array
    {
        $sql = "SELECT *, `" . $this->description_field . "` as `Description`, `Ref` FROM `novaposhta_warehouses_api` WHERE `CityRef` = '" . $city_ref . "'";
        if ($search) {
            $sql .= " AND (`Description` LIKE '%" . tep_db_prepare_input($search) . "%' OR `DescriptionRu` LIKE '%" . tep_db_prepare_input($search) . "%')";
        }
        $query = tep_db_query($sql);
        $results = [];

        while ($row = tep_db_fetch_array($query)) {
            $results[] = $row;
        }

        return $results;
    }
    public function getWarehousesByCityName($city_name, $search = "")
    {
        $sql = "SELECT *, `" . $this->description_field . "` as `Description` FROM `novaposhta_warehouses_api` WHERE (`CityDescription` = '" . tep_db_prepare_input($city_name) . "' OR `CityDescriptionRu` = '" . tep_db_prepare_input($city_name) . "')";
        if ($search) {
            $sql .= " AND `" . $this->description_field . "` LIKE '%" . tep_db_prepare_input($search) . "%'";
        }

        $query = tep_db_query($sql);
        return tep_db_fetch_array($query);
    }
    public function searchSettlements($search = "", $limit = 0)
    {
        $data = [];
        $properties = [];
        if ($search) {
            $properties["CityName"] = $search;
        }
        if ($limit) {
            $properties["Limit"] = $limit;
        }
        $result = $this->apiRequest("Address", "searchSettlements", $properties);
        if (!empty($result[0]["TotalCount"])) {
            $data = $result[0]["Addresses"];
        }
        return $data;
    }
    public function searchSettlementStreets($settlement_ref, $search = "", $limit = 0)
    {
        $data = [];
        $properties = ["SettlementRef" => $settlement_ref];
        if ($search) {
            $properties["StreetName"] = $search;
        }
        if ($limit) {
            $properties["Limit"] = $limit;
        }
        $result = $this->apiRequest("Address", "searchSettlementStreets", $properties);
        if (!empty($result[0]["TotalCount"])) {
            $data = $result[0]["Addresses"];
        }
        return $data;
    }
    public function saveCounterparties($properties)
    {
        $data = $this->apiRequest("Counterparty", "save", $properties);
        return isset($data[0]) ? $data[0] : $data;
    }
    public function saveContactPerson($properties)
    {
        $data = $this->apiRequest("ContactPerson", "save", $properties);
        return isset($data[0]) ? $data[0] : false;
    }
    public function updateContactPerson($properties)
    {
        $data = $this->apiRequest("ContactPerson", "update", $properties);
        return $data;
    }
    public function saveAddress($properties)
    {
        $data = $this->apiRequest("Address", "save", $properties);
        return isset($data[0]) ? $data[0] : false;
    }
    public function getSenderAddresses($counterparty_ref, $city_ref): array
    {
        $results = [];
        $addresses = $this->getReferences("sender_addresses");
        if (isset($addresses[$counterparty_ref])) {
            foreach ($addresses[$counterparty_ref] as $k => $sender_address) {
                if ($sender_address["CityRef"] == $city_ref) {
                    $results[$k] = $sender_address;
                }
            }
        }
        return $results;
    }
    public function getTimeIntervals($ref, $date = "")
    {
        $properties = ["RecipientCityRef" => $ref, "DateTime" => $date];
        $data = $this->apiRequest("Common", "getTimeIntervals", $properties);
        return $data;
    }
    public function getDocumentPrice($properties)
    {
        $cost = 0;
        $data = $this->apiRequest("InternetDocument", "getDocumentPrice", $properties);
        if (isset($data[0])) {
            $cost += $data[0]["Cost"];
            if (!empty($data[0]["CostPack"])) {
                $cost += $data[0]["CostPack"];
            }
        }
        return $cost;
    }
    public function getDocumentDeliveryDate($properties)
    {
        $data = $this->apiRequest("InternetDocument", "getDocumentDeliveryDate", $properties);
        return $data ? $this->dateDiff($data[0]["DeliveryDate"]["date"]) : 0;
    }
    public function dateDiff($string_time)
    {
        return ceil((strtotime($string_time) - time()) / 86400);
    }
    public function saveCN($properties)
    {
        $method = isset($properties["Ref"]) ? "update" : "save";
        $data = $this->apiRequest("InternetDocument", $method, $properties);
        return isset($data[0]) ? $data[0] : false;
    }
    public function getCN($ref)
    {
        $properties = ["Ref" => $ref];
        $data = $this->apiRequest("InternetDocument", "getDocument", $properties);
        return isset($data[0]) ? $data[0] : false;
    }
    public function getCNList($date_from = "", $date_to = "", $properties = [])
    {
        $properties["GetFullList"] = 1;
        if ($date_from && $date_to) {
            $properties["DateTimeFrom"] = $date_from;
            $properties["DateTimeTo"] = $date_to;
        } else {
            if ($date_from) {
                $properties["DateTime"] = $date_from;
            }
        }
        $data = $this->apiRequest("InternetDocument", "getDocumentList", $properties);
        return $data;
    }
    public function deleteCN($refs)
    {
        $properties = ["DocumentRefs" => $refs];
        $data = $this->apiRequest("InternetDocument", "delete", $properties);
        return $data;
    }
    public function tracking($documents = [])
    {
        $properties = ["Documents" => $documents];
        $data = $this->apiRequest("TrackingDocument", "getStatusDocuments", $properties);
        return $data;
    }
    public function getDeparture($products, $seats = 1)
    {
        $data["parcels"] = [];
        if (empty($products) || !is_array($products)) {
            $products = [["quantity" => 1, "weight_class_id" => 0, "length_class_id" => 0, "weight" => 0, "length" => 0, "width" => 0, "height" => 0]];
        }
        foreach ($products as $i => $product) {
            $p_weight = $this->weight->getUnit($product["weight_class_id"]);
            $p_length = $this->length->getUnit($product["length_class_id"]);
            if (getConstantValue('USE_PARAMETERS') == "products_without_parameters" && (int) $product["weight"]) {
                $data["parcels"][$i]["weight"] = $this->weightConvert($product["weight"], $p_weight);
            } else {
                if (getConstantValue('USE_PARAMETERS') == "whole_order") {
                    $data["parcels"][$i]["weight"] = (int) getConstantValue('WEIGHT');
                } else {
                    $data["parcels"][$i]["weight"] = (int) getConstantValue('WEIGHT') * $product["quantity"];
                }
            }
            if (getConstantValue('USE_PARAMETERS') == "products_without_parameters" && (int) $product["length"]) {
                $data["parcels"][$i]["length"] = $this->dimensionConvert($product["length"], $p_length);
            } else {
                $data["parcels"][$i]["length"] = (int) getConstantValue('DIMENSIONS_L');
            }
            if (getConstantValue('USE_PARAMETERS') == "products_without_parameters" && (int) $product["width"]) {
                $data["parcels"][$i]["width"] = $this->dimensionConvert($product["width"], $p_length);
            } else {
                $data["parcels"][$i]["width"] = (int) getConstantValue('DIMENSIONS_W');
            }
            if (getConstantValue('USE_PARAMETERS') == "products_without_parameters" && (int) $product["height"]) {
                $data["parcels"][$i]["height"] = $this->dimensionConvert($product["height"], $p_length) * $product["quantity"];
            } else {
                if (getConstantValue('USE_PARAMETERS') == "whole_order") {
                    $data["parcels"][$i]["height"] = (int) getConstantValue('DIMENSIONS_H');
                } else {
                    $data["parcels"][$i]["height"] = (int) getConstantValue('DIMENSIONS_H') * $product["quantity"];
                }
            }
            if ($data["parcels"][$i]["length"] < $data["parcels"][$i]["height"]) {
                $l = $data["parcels"][$i]["length"];
                $data["parcels"][$i]["length"] = $data["parcels"][$i]["height"];
                $data["parcels"][$i]["height"] = $l;
            }
            if (!$seats) {
                $data["parcels"][$i]["length"] += (int) getConstantValue('ALLOWANCE_L');
                $data["parcels"][$i]["width"] += (int) getConstantValue('ALLOWANCE_W');
                $data["parcels"][$i]["height"] += (int) getConstantValue('ALLOWANCE_H');
            }
            $data["parcels"][$i]["volume"] = $data["parcels"][$i]["length"] * $data["parcels"][$i]["width"] * $data["parcels"][$i]["height"] / 1000000;
            if (getConstantValue('USE_PARAMETERS') == "whole_order") {
                if (getConstantValue('CALCULATE_VOLUME') && getConstantValue('CALCULATE_VOLUME_TYPE') == "sum_all_products") {
                    $i_l = array_sum(array_map(function ($i) {
                        return $i["length"];
                    }, $data["parcels"]));
                    $i_w = array_sum(array_map(function ($i) {
                        return $i["width"];
                    }, $data["parcels"]));
                    $i_h = array_sum(array_map(function ($i) {
                        return $i["height"];
                    }, $data["parcels"]));
                    $i_v = array_sum(array_map(function ($i) {
                        return $i["volume"];
                    }, $data["parcels"]));
                } else {
                    $i_l = max(array_map(function ($i) {
                        return $i["length"];
                    }, $data["parcels"]));
                    $i_w = max(array_map(function ($i) {
                        return $i["width"];
                    }, $data["parcels"]));
                    $i_h = max(array_map(function ($i) {
                        return $i["height"];
                    }, $data["parcels"]));
                    $i_v = max(array_map(function ($i) {
                        return $i["volume"];
                    }, $data["parcels"]));
                }
                $all_weight = array_sum(array_map(function ($i) {
                    return $i["weight"];
                }, $data["parcels"]));
                if ($seats) {
                    $i_l = $i_l / $seats + (int) getConstantValue('ALLOWANCE_L');
                    $volume_cube = pow($i_v, 0);
                    $i_v = ($volume_cube + (int) getConstantValue('ALLOWANCE_L') / 100) * ($volume_cube + (int) getConstantValue('ALLOWANCE_W') / 100) * ($volume_cube + (int) getConstantValue('ALLOWANCE_H') / 100) / $seats;
                }
                $data["weight"] = max(round($all_weight, 2), 0);
                $data["length"] = max(round($i_l), 1);
                $data["width"] = max(round($i_w), 1);
                $data["height"] = max(round($i_h), 1);
                $data["volume"] = max(round($i_v, 4), 0);
                return $data;
            }
        }
    }
    public function weightConvert($value, $unit)
    {
        if (preg_match("/\\b(g|gr|gram|gramm|gramme|г|гр|грам|грамм)\\b\\.?/ui", $unit)) {
            return (int) $value / 1000;
        }
        return (int) $value;
    }
    public function dimensionConvert($value, $unit)
    {
        if (preg_match("/\\b(mm|millimeter|мм|міліметр|миллиметр)\\b\\.?/ui", $unit)) {
            return (int) $value / 10;
        }
        if (preg_match("/\\b(dm|decimetre|дц|дециметр)\\b\\.?/ui", $unit)) {
            return (int) $value * 10;
        }
        if (preg_match("/\\b(m|metre|м|метр)\\b\\.?/ui", $unit)) {
            return (int) $value * 100;
        }
        return (int) $value;
    }
    public function getDepartureType($departure): string
    {
        if ($departure["length"] <= 25 && $departure["width"] <= 35 && $departure["height"] <= 2 && $departure["weight"] <= 1) {
            $type = "Documents";
        } else {
            if ($departure["length"] <= 150 && $departure["width"] <= 150 && $departure["height"] <= 150 && $departure["weight"] <= 30) {
                $type = "Parcel";
            } else {
                $type = "Cargo";
            }
        }
        return $type;
    }
    public function getDepartureSeats($products = [])
    {
        $seats = 0;
        foreach ($products as $product) {
            $seats += $product["quantity"];
        }
        return $seats;
    }
    public function getPackType($departure)
    {
        $packs = $this->getReferences("pack_types");
        if (is_array($packs)) {
            $packs = $this->multiSort($packs, "Length", "Width", "Height");
        }
        foreach ($packs as $pack) {
            if (in_array($pack["Ref"], getConstantValue('PACK_TYPE')) && $departure["length"] * 10 <= $pack["Length"] && $departure["width"] * 10 <= $pack["Width"] && ($departure["height"] * 10 <= $pack["Height"] || !(int) $pack["Height"])) {
                return $pack["Ref"];
            }
        }
    }
    private function multiSort()
    {
        $args = func_get_args();
        $c = count($args);
        if (2 <= $c) {
            $array = array_splice($args, 0, 1);
            $array = $array[0];
            usort($array, function ($a, $b) {
                static $args = NULL;
                $i = 0;
                $c = count($args);
                $cmp = 0;
                if (!($cmp == 0 && $i < $c)) {
                    if ($a[$args[$i]] == $b[$args[$i]]) {
                        $cmp = 0;
                    } else {
                        if ($a[$args[$i]] < $b[$args[$i]]) {
                            $cmp = -1;
                        } else {
                            $cmp = 1;
                        }
                    }
                    $i++;
                } else {
                    return $cmp;
                }
            });
            return $array;
        }
        return false;
    }
}

?>