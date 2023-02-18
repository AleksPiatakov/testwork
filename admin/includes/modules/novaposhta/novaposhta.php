<?php

if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {

    $rootPath = dirname(dirname(dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])))));
    chdir('../../../');
    require('includes/application_top.php');
    include 'includes/modules/novaposhta/novaposhta.class.php';
    include 'includes/modules/novaposhta/novaposhta_api.php';
    require_once(DIR_WS_LANGUAGES . $language . '/modules/novaposhta/novaposhta.php');

    $data = [];

    function getCNForm(): array
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $json = [];
            $error = validateCNForm();
            if (empty($error)) {
                $json["success"] = $_POST;
            } else {
                $json = $error;
            }
            echo json_encode($json, JSON_THROW_ON_ERROR);
            exit;

        } else {
            if (isset($error["warning"])) {
                $data["error_warning"][] = $error["warning"];
            } else {
                $data["error_warning"] = [];
            }
            $novaposhtaApi = new NovaPoshtaAPI();
            $novaposhta = new novaposhta();
            $settings = $novaposhtaApi->getReferences();
            if (count($settings) === 19) {
                $settingsSenders = array_key_first($settings['senders']);
            } else {
                echo json_encode([
                    'success' => false,
                    'msg' => ERROR_REFERENCES,
                ], JSON_THROW_ON_ERROR);
                die;
            }
            if (isset($_GET["order_id"])) {
                $order_id = $_GET["order_id"];
                $order_info = $novaposhta->getOrder($order_id);
                if (!$order_info) {
                    $data["error_warning"][] = ERROR_GET_ORDER;
                }
            } else {
                $order_id = 0;
                $order_info = [];
            }
            if (!empty($order_info["novaposhta_cn_ref"])) {
                $cn_ref = $order_info["novaposhta_cn_ref"];
            } else {
                if (isset($_GET["cn_ref"])) {
                    $cn_ref = $_GET["cn_ref"];
                } else {
                    $cn_ref = "";
                }
            }
            if ($cn_ref) {
                $cn = $novaposhtaApi->getCN($cn_ref);
                if (!$cn) {
                    $data["error_warning"] = $novaposhtaApi->error;
                    $data["error_warning"][] = ERROR_GET_CN;
                }
            } else {
                $cn = [];
            }

            $data["cancel"] = $_SERVER['HTTP_REFERER'];

            $data["text_form"] = $cn ? TEXT_FORM_EDIT : TEXT_FORM_CREATE;
            if ($cn) {
                $data["sender"] = $cn["SenderRef"];
                $data["sender_contact_person"] = $cn["ContactSenderRef"];
                $data["sender_contact_person_phone"] = $cn["SendersPhone"];
                $data["sender_region"] = $novaposhtaApi->getZoneIDByName($novaposhtaApi->getAreaName($cn["AreaSenderRef"]));
                $data["sender_city_name"] = $cn["CitySender"];
                $data["sender_city"] = $cn["CitySenderRef"];
                $data["sender_address_name"] = $novaposhtaApi->getWarehouseName($cn["SenderAddressRef"]);
                $data["sender_address"] = $cn["SenderAddressRef"];
                $data["recipient_name"] = $cn["Recipient"];
                $data["recipient"] = $cn["RecipientRef"];
                $data["recipient_contact_person"] = $cn["ContactRecipient"];
                $data["recipient_contact_person_phone"] = $cn["RecipientsPhone"];
                $data["recipient_region_name"] = $novaposhtaApi->getAreaName($cn["AreaRecipientRef"]);
                $data["recipient_region"] = $novaposhtaApi->getZoneIDByName($data["recipient_region_name"]);
                $data["recipient_warehouse_name"] = $novaposhtaApi->getWarehouseName($cn["RecipientAddressRef"]);
                if ($data["recipient_warehouse_name"]) {
                    if ($cn["RecipientCategoryOfWarehouse"] == "Postomat") {
                        $data["recipient_address_type"] = "poshtomat";
                    } else {
                        $data["recipient_address_type"] = "warehouse";
                    }
                    $data["recipient_district_name"] = "";
                    $data["recipient_city_name"] = $cn["CityRecipient"];
                    $data["recipient_city"] = $cn["CityRecipientRef"];
                    $data["recipient_warehouse"] = $cn["RecipientAddressRef"];
                    $data["recipient_street_name"] = "";
                    $data["recipient_street"] = "";
                    $data["recipient_house"] = "";
                    $data["recipient_flat"] = "";
                } else {
                    $data["recipient_address_type"] = "doors";
                    $data["recipient_district_name"] = $cn["OriginalGeoData"]["RecipientAreaRegions"];
                    $data["recipient_city_name"] = $cn["OriginalGeoData"]["RecipientCityName"];
                    $data["recipient_city"] = "";
                    $data["recipient_warehouse"] = "";
                    $data["recipient_street_name"] = $cn["OriginalGeoData"]["RecipientAddressName"];
                    $data["recipient_street"] = "";
                    $data["recipient_house"] = $cn["OriginalGeoData"]["RecipientHouse"];
                    $data["recipient_flat"] = $cn["OriginalGeoData"]["RecipientFlat"];
                    if ($data["recipient_city_name"]) {
                        $settlements = $novaposhtaApi->searchSettlements($data["recipient_city_name"] . " " . $data["recipient_region_name"]);
                        foreach ($settlements as $settlement) {
                            if (!($data["recipient_district_name"] && $data["recipient_district_name"] !== $settlement["Region"])) {
                                $data["recipient_city"] = $settlement["Ref"];
                            }
                        }
                    }
                    if ($data["recipient_street_name"] && $data["recipient_city"]) {
                        $streets = $novaposhtaApi->searchSettlementStreets($data["recipient_city"], $data["recipient_street_name"], 1);
                        if (isset($streets[0])) {
                            $data["recipient_street"] = $streets[0]["SettlementStreetRef"];
                        }
                    }
                }
                $data["departure"] = $cn["CargoTypeRef"];
                $data["redbox_barcode"] = $cn["RedBoxBarcode"];
                $data["width"] = isset($cn["OptionsSeat"][0]) ? $cn["OptionsSeat"][0]["volumetricWidth"] : "";
                $data["length"] = isset($cn["OptionsSeat"][0]) ? $cn["OptionsSeat"][0]["volumetricLength"] : "";
                $data["height"] = isset($cn["OptionsSeat"][0]) ? $cn["OptionsSeat"][0]["volumetricHeight"] : "";
                $data["weight"] = isset($cn["OptionsSeat"][0]) ? $cn["OptionsSeat"][0]["weight"] : $cn["Weight"];
                $data["volume_general"] = isset($cn["OptionsSeat"][0]) ? $cn["OptionsSeat"][0]["volumetricVolume"] : $cn["VolumeGeneral"];
                $data["volume_weight"] = isset($cn["OptionsSeat"][0]) ? $cn["OptionsSeat"][0]["volumetricWeight"] : $cn["VolumeWeight"];
                $data["seats_amount"] = $cn["SeatsAmount"];
                $data["declared_cost"] = $cn["Cost"];
                $data["departure_description"] = $cn["Description"];
                if (isset($cn["CargoDetails"]) && $cn["CargoTypeRef"] == "TiresWheels") {
                    foreach ($cn["CargoDetails"] as $cargo) {
                        $data["tires_and_wheels"][$cargo["CargoDescriptionRef"]] = $cargo["Amount"];
                    }
                } else {
                    $data["tires_and_wheels"] = [];
                }
                $data["delivery_payer"] = $cn["PayerTypeRef"];
                $data["third_person"] = $cn["ThirdPersonRef"];
                $data["payment_type"] = $cn["PaymentMethodRef"];
                $data["backward_delivery"] = isset($cn["BackwardDeliveryData"][0]) ? $cn["BackwardDeliveryData"][0]["CargoTypeRef"] : "N";
                $data["backward_delivery_total"] = isset($cn["BackwardDeliveryData"][0]) ? $cn["BackwardDeliveryData"][0]["RedeliveryString"] : "";
                $data["backward_delivery_payer"] = isset($cn["BackwardDeliveryData"][0]) ? $cn["BackwardDeliveryData"][0]["PayerTypeRef"] : 'Recipient';
                $data["payment_control"] = $cn["AfterpaymentOnGoodsCost"];
                if ($cn["PaymentCardToken"]) {
                    $data["money_transfer_method"] = "to_payment_card";
                    $data["payment_card"] = $cn["PaymentCardToken"];
                } else {
                    $data["money_transfer_method"] = "on_warehouse";
                    $data["payment_card"] = "";
                }
                $data["departure_date"] = date("d.m.Y", strtotime($cn["DateTime"]));
                $data["preferred_delivery_date"] = $cn["PreferredDeliveryDate"] != "0001-01-01 00:00:00" ? date("d.m.Y", strtotime($cn["PreferredDeliveryDate"])) : "";
                $data["time_interval"] = $cn["TimeIntervalRef"];
                $data["packing_number"] = $cn["PackingNumber"];
                $data["sales_order_number"] = $cn["InfoRegClientBarcodes"];
                $data["additional_information"] = $cn["AdditionalInformation"];
                $data["rise_on_floor"] = $cn["NumberOfFloorsLifting"];
                $data["elevator"] = $cn["Elevator"];
                $data["time_intervals"] = $novaposhtaApi->getTimeIntervals($data["recipient_city"], $data["preferred_delivery_date"]);
            } else {
                if ($order_info) {
                    $order_products = $novaposhta->getOrderProducts($order_id);
                    $order_totals = $novaposhta->getOrderTotals($order_id);

                    $find_order = ["{order_id}", "{invoice_no}", "{invoice_prefix}", "{store_name}", "{store_url}", "{customer}", "{firstname}", "{lastname}", "{email}", "{telephone}", "{fax}", "{payment_firstname}", "{payment_lastname}", "{payment_company}", "{payment_address_1}", "{payment_address_2}", "{payment_postcode}", "{payment_city}", "{payment_zone}", "{payment_zone_id}", "{payment_country}", "{shipping_firstname}", "{shipping_lastname}", "{shipping_company}", "{shipping_address_1}", "{shipping_address_2}", "{shipping_postcode}", "{shipping_city}", "{shipping_zone}", "{shipping_zone_id}", "{shipping_country}", "{comment}", "{total}", "{commission}", "{date_added}", "{date_modified}"];
                    $replace_order = ["order_id" => $order_info["orders_id"], "invoice_no" => $order_info["invoice_no"], "invoice_prefix" => $order_info["invoice_prefix"], "store_name" => $order_info["customers_company"], "store_url" => $order_info["customers_referer_url"], "customer" => $order_info["customers"], "firstname" => $order_info["customers_name"], "lastname" => $order_info["customers_lastname"], "email" => $order_info["customers_email_address"], "telephone" => $order_info["customers_telephone"], "fax" => isset($order_info["customers_fax"]) ? $order_info["customers_fax"] : "", "payment_firstname" => $order_info["billing_name"], "payment_lastname" => $order_info["billing_lastname"], "payment_company" => $order_info["billing_company"], "payment_address_1" => $order_info["billing_street_address"], "payment_address_2" => $order_info["payment_address_2"], "payment_postcode" => $order_info["billing_postcode"], "payment_city" => $order_info["billing_city"], "payment_zone" => $order_info["payment_zone"], "payment_zone_id" => $order_info["payment_zone_id"], "payment_country" => $order_info["billing_country"], "shipping_firstname" => $order_info["delivery_name"], "shipping_lastname" => $order_info["delivery_lastname"], "shipping_company" => $order_info["delivery_company"], "shipping_address_1" => $order_info["delivery_street_address"], "shipping_address_2" => $order_info["shipping_address_2"], "shipping_postcode" => $order_info["delivery_postcode"], "shipping_city" => $order_info["delivery_city"], "shipping_zone" => $order_info["shipping_zone"], "shipping_zone_id" => $order_info["shipping_zone_id"], "shipping_country" => $order_info["delivery_country"], "comment" => $order_info["comment"], "total" => $order_info["total"], "commission" => $order_info["commission"], "date_added" => $order_info["date_purchased"], "date_modified" => $order_info["last_modified"]];
                    foreach ($novaposhta->getSimpleFields($order_id) as $k => $v) {
                        if (!in_array("{" . $k . "}", $find_order)) {
                            $find_order[] = "{" . $k . "}";
                            $replace_order[$k] = $v;
                        }
                    }

                    $find_product = ["{name}", "{model}", "{option}", "{sku}", "{ean}", "{upc}", "{jan}", "{isbn}", "{mpn}", "{quantity}"];
                    $data["sender"] = $settingsSenders;
                    $data["sender_contact_person"] = array_key_first($settings["sender_contact_persons"][$settingsSenders]);
                    $data["sender_region"] = $novaposhtaApi->getZoneIDByName(getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_SENDER_REGION'));
                    $data["sender_city_name"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_SENDER_CITY_NAME');
                    $data["sender_city"] = $novaposhtaApi->getCityRef($data["sender_city_name"]);
                    $data["sender_address_name"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_SENDER_ADDRESS_NAME');
                    $data["sender_address"] = $novaposhtaApi->getWarehouseByCity($data["sender_address_name"], $data["sender_city_name"])['Ref'];
                    $data["recipient_name"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_RECIPIENT_NAME', 'Приватна особа');
                    $data["recipient"] = '';
                    $data["recipient_contact_person"] = $novaposhta->to_cyrillic(preg_replace("/ {2,}/", " ", mb_convert_case(trim(str_replace($find_order, $replace_order, $order_info['delivery_name'])), MB_CASE_TITLE, "UTF-8")));
                    $data["recipient_contact_person_phone"] = preg_replace("/[^0-9]/", "", str_replace($find_order, $replace_order, $order_info['customers_telephone']));
                    $data["recipient_address_type"] = "warehouse";
                    $data["recipient_region_name"] = trim(str_replace($find_order, $replace_order, $order_info['delivery_state']));
                    $data["recipient_region"] = $novaposhta->getZoneIDByName($data["recipient_region_name"]);
                    $data["recipient_district_name"] = "";
                    $data["recipient_city_name"] = trim(str_replace($find_order, $replace_order, $order_info['delivery_city']));
                    $data["recipient_city"] = $novaposhtaApi->getCityRef($data["recipient_city_name"]);
                    $data["recipient_warehouse_name"] = trim(str_replace($find_order, $replace_order, str_replace(array(' \"', '\" '), array(" «", "» "), $order_info['delivery_street_address'])));
                    $data["recipient_warehouse"] = $novaposhtaApi->getWarehouseRef($data["recipient_warehouse_name"]);
                    $data["recipient_address"] = trim(str_replace($find_order, $replace_order, '{shipping_address_1}'));
                    $data["recipient_street_name"] = trim(str_replace($find_order, $replace_order, '{shipping_street}'));
                    $data["recipient_street"] = "";
                    $data["recipient_house"] = trim(str_replace($find_order, $replace_order, '{shipping_house}'));
                    $data["recipient_flat"] = trim(str_replace($find_order, $replace_order, '{shipping_flat}'));
                    if (strlen($data["recipient_contact_person_phone"]) == 10) {
                        $data["recipient_contact_person_phone"] = "38" . $data["recipient_contact_person_phone"];
                    }
                    if (!$data["recipient_warehouse"] && !preg_match("/відділення|отделение|поштомат|почтомат|склад нп/ui", $data["recipient_warehouse_name"]) && (!isset($order_info["shipping_code"]) || $order_info["shipping_code"] == "novaposhta.doors")) {
                        $data["recipient_address_type"] = "doors";
                        $settlements = $novaposhtaApi->searchSettlements($data["recipient_city_name"] . " " . $data["recipient_region_name"]);
                        foreach ($settlements as $settlement) {
                            if (!($data["recipient_district_name"] && $data["recipient_district_name"] != $settlement["Region"])) {
                                $data["recipient_district_name"] = $settlement["Region"];
                                $data["recipient_city"] = $settlement["Ref"];
                                if ($data["recipient_address"] && !$data["recipient_street_name"]) {
                                    $address = parseAddress($data["recipient_address"]);
                                    $data["recipient_street_name"] = $address["street_type"] . " " . $address["street"];
                                    $data["recipient_house"] = $address["house"];
                                    $data["recipient_flat"] = $address["flat"];
                                }
                                if ($data["recipient_street_name"] && $data["recipient_city"]) {
                                    $streets = $novaposhtaApi->searchSettlementStreets($data["recipient_city"], $data["recipient_street_name"], 1);
                                    if (isset($streets[0])) {
                                        $data["recipient_street"] = $streets[0]["SettlementStreetRef"];
                                    }
                                }
                            }
                        }
                    } else {
                        if (preg_match("/поштомат|почтомат/ui", $data["recipient_warehouse_name"]) || (isset($order_info["shipping_code"]) && $order_info["shipping_code"] == "novaposhta.poshtomat")) {
                            $data["recipient_address_type"] = "poshtomat";
                        }
                    }
                    $departure = ''; //$novaposhtaApi->getDeparture($order_products, 0);
//                    if (getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_AUTODETECTION_DEPARTURE_TYPE', 'false') !== 'false') {
//                        $data["departure"] = $novaposhtaApi->getDepartureType($departure);
//                    } else {
//                        $data["departure"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_TYPE');
//                    }
                    $data["departure"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_TYPE');
                    if (getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_SEATS_AMOUNT', 'false') !== 'false') {
                        $data["seats_amount"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_SEATS_AMOUNT');
                    } else {
                        $data["seats_amount"] = $novaposhtaApi->getDepartureSeats($order_products);
                    }
                    $data["redbox_barcode"] = "";
                    $data["tires_and_wheels"] = [];
                    $data["width"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_W'); //$departure["width"];
                    $data["length"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_L'); //$departure["length"];
                    $data["height"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_H'); //$departure["height"];
                    $data["weight"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_WEIGHT'); //$departure["weight"];
                    $data["volume_general"] = ''; //$departure["volume"];
                    $data["volume_weight"] = ''; //$data["volume_general"] * 250;
                    $data["declared_cost"] = convertToUAH(getDeclaredCost($order_totals), $order_info["currency"], $order_info["currency_value"]);
                    $data["departure_description"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_DESCRIPTION') ?: $order_id;
//                    if (getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_SHIPPING_METHODS')[$data["recipient_address_type"]]["free_shipping"] && getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_SHIPPING_METHODS')[$data["recipient_address_type"]]["free_shipping"] <= convertToUAH($order_totals[count($order_totals) - 1]["value"], $order_info["currency_code"], $order_info["currency_value"])) {
//                        $data["delivery_payer"] = "Sender";
//                    } else {
//                        $data["delivery_payer"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DELIVERY_PAYER');
//                    }
                    $data["delivery_payer"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DELIVERY_PAYER');
                    if (isset($order_info["payment_code"]) && getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_COD', 'false') !== 'false' && (in_array($order_info["payment_code"], explode(', ', getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_COD'))) || in_array(stristr($order_info["payment_code"], ".", true), explode(', ', getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_COD'))))) {
                        $data["backward_delivery"] = "Money";
                    } else {
                        if (!isset($order_info["payment_code"]) && getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_COD', 'false') !== 'false') {
                            $data["backward_delivery"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_BACKWARD_DELIVERY');
                            foreach (explode(', ', getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_COD')) as $spc) {
                                if (is_array($spc) && ($spc == getPaymentMethodCodeByText(strip_tags($order_info["payment_method"])))) {
                                    $data["backward_delivery"] = "Money";
                                } else {
                                    $name = $spc;
                                    if (getPaymentMethodCodeByText(strip_tags($order_info["payment_method"])) == $name) {
                                        $data["backward_delivery"] = "Money";
                                    }
                                }
                            }
                        } else {
                            $data["backward_delivery"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_BACKWARD_DELIVERY');
                        }
                    }
                    if ((!$data["backward_delivery"] || $data["backward_delivery"] == "N" || !$data["declared_cost"]) && getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DECLARED_COST_DEFAULT')) {
                        $data["declared_cost"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DECLARED_COST_DEFAULT');
                    }

                    //$cod_plus_settings = PAYMENT_COD_PLUS;

                    if (isset($cod_plus_settings[$order_info["shipping_code"]])) {
                        $cod_plus_free = $cod_plus_settings[$order_info["shipping_code"]]["free"];
                    } else {
                        if (isset($cod_plus_settings[stristr($order_info["shipping_code"], ".", true)])) {
                            $cod_plus_free = $cod_plus_settings[stristr($order_info["shipping_code"], ".", true)]["free"];
                        } else {
                            $cod_plus_free = 0;
                        }
                    }
                    if ($cod_plus_free && $cod_plus_free <= $data["declared_cost"]) {
                        $data["backward_delivery_payer"] = "Sender";
                    } else {
                        $data["backward_delivery_payer"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_BACKWARD_DELIVERY_PAYER');
                    }
                    $data["third_person"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_THIRD_PERSON');
                    $data["payment_type"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_TYPE');
                    $data["backward_delivery_total"] = $data["declared_cost"];
                    $data["money_transfer_method"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_MONEY_TRANSFER_METHOD');
                    $data["payment_card"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DEFAULT_PAYMENT_CARD');
                    if ($data["backward_delivery"] == "Money" && !empty(getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_CONTROL'))) {
                        $data["backward_delivery"] = "N";
                        $data["payment_control"] = convertToUAH(getPaymentControl($order_totals), $order_info["currency_code"], $order_info["currency_value"]);
                    } else {
                        $data["payment_control"] = "";
                    }
                    $data["departure_date"] = date("d.m.Y");
                    $data["preferred_delivery_date"] = str_replace($find_order, $replace_order, getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_PREFERRED_DELIVERY_DATE'));
                    $data["time_interval"] = str_replace($find_order, $replace_order, getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_PREFERRED_DELIVERY_TIME'));
                    $data["sales_order_number"] = $order_id . ' ' .  STORE_NAME;
                    $data["packing_number"] = "";
                    if ($data["time_interval"]) {
                        $preferred_delivery_time = str_replace(":", "", $data["time_interval"]);
                        $data["time_intervals"] = $novaposhtaApi->getTimeIntervals($data["recipient_city"], $data["preferred_delivery_date"]);
                        foreach ((int)$data["time_intervals"] as $interval) {
                            $start = str_replace(":", "", $interval["Start"]);
                            $end = str_replace(":", "", $interval["End"]);
                            if ($start <= $preferred_delivery_time && $preferred_delivery_time <= $end) {
                                $data["time_interval"] = $interval["Number"];
                            }
                        }
                    }
                    $data["additional_information"] = "";
                    $template = explode("|", getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_ADDITIONAL_INFORMATION'));
                    if ($template[0]) {
                        $data["additional_information"] .= preg_replace(["/\\s\\s+/", "/\\r\\r+/", "/\\n\\n+/"], " ", trim(str_replace($find_order, $replace_order, $template[0])));
                    }
                    if (isset($template[1])) {
                        foreach ($order_products as $k => $product) {
                            $replace_product = ["name" => $product["name"], "model" => $product["model"], "option" => "", "sku" => $product["sku"], "ean" => $product["ean"], "upc" => $product["upc"], "jan" => $product["jan"], "isbn" => $product["isbn"], "mpn" => $product["mpn"], "quantity" => $product["quantity"]];
                            if ($product["option"]) {
                                foreach ($product["option"] as $po) {
                                    $replace_product["option"] .= $po["name"] . ": " . $po["value"];
                                }
                            }
                            $data["additional_information"] .= preg_replace(["/\\s\\s+/", "/\\r\\r+/", "/\\n\\n+/"], " ", trim(str_replace($find_product, $replace_product, $template[1])));
                        }
                    }
                    $data["rise_on_floor"] = "";
                    $data["elevator"] = "";
                } else {
                    $data["sender"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_SENDER');
                    $data["sender_contact_person"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_SENDER_CONTACT_PERSON');
                    $data["sender_region"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_SENDER_REGION');
                    $data["sender_city_name"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_SENDER_CITY_NAME');
                    $data["sender_city"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_SENDER_CITY');
                    $data["sender_address_name"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_SENDER_ADDRESS_NAME');
                    $data["sender_address"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_SENDER_ADDRESS');
                    $data["recipient_name"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_RECIPIENT_NAME', 'Приватна особа');
                    $data["recipient"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_RECIPIENT');
                    $data["recipient_contact_person"] = $novaposhta->to_cyrillic($order_info['delivery_name']);
                    $data["recipient_contact_person_phone"] = $order_info['customers_telephone'];
                    $data["recipient_address_type"] = "warehouse";
                    $data["recipient_region_name"] = $order_info['delivery_state'];
                    $data["recipient_region"] = $order_info['delivery_state'];
                    $data["recipient_district_name"] = '';
                    $data["recipient_city_name"] = $order_info['delivery_city'];
                    $data["recipient_city"] = '';
                    $data["recipient_warehouse_name"] = str_replace(array(' \"', '\" '), array(" «", "» "), $order_info['delivery_street_address']);
                    $data["recipient_warehouse"] = '';
                    $data["recipient_street_name"] = $order_info['delivery_street_address'];
                    $data["recipient_street"] = '';
                    $data["recipient_house"] = '';
                    $data["recipient_flat"] = '';
                    $data["departure"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_TYPE');
                    $data["redbox_barcode"] = "";
                    $data["tires_and_wheels"] = [];
                    $data["width"] = (int)getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_W') + (int)getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_ALLOWANCE_W');
                    $data["length"] = (int)getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_L') + (int)getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_ALLOWANCE_L');
                    $data["height"] = (int)getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_H') + (int)getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_ALLOWANCE_H');
                    $data["weight"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_WEIGHT');
                    $data["volume_general"] = max(round(((int)getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_W') + (int)getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_ALLOWANCE_W')) * ((int)getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_L') + (int)getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_ALLOWANCE_L')) * ((int)getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DIMENSIONS_H') + (int)getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_ALLOWANCE_H')) / 1000000, 4), 0);
                    $data["volume_weight"] = $data["volume_general"] * 250;
                    $data["seats_amount"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_SEATS_AMOUNT');
                    $data["declared_cost"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DECLARED_COST_DEFAULT');
                    $data["departure_description"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DEPARTURE_DESCRIPTION') ?: $order_id;
                    $data["delivery_payer"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DELIVERY_PAYER');
                    $data["third_person"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_THIRD_PERSON');
                    $data["payment_type"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_TYPE');
                    $data["backward_delivery"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_BACKWARD_DELIVERY');
                    $data["backward_delivery_total"] = $data["declared_cost"];
                    $data["backward_delivery_payer"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_BACKWARD_DELIVERY_PAYER');
                    $data["money_transfer_method"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_MONEY_TRANSFER_METHOD');
                    $data["payment_card"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DEFAULT_PAYMENT_CARD');
                    $data["payment_control"] = "";
                    $data["departure_date"] = date("d.m.Y");
                    $data["preferred_delivery_date"] = "";
                    $data["time_interval"] = "";
                    $data["sales_order_number"] = "";
                    $data["packing_number"] = "";
                    $data["additional_information"] = "";
                    $data["rise_on_floor"] = "";
                    $data["elevator"] = "";
                }
            }

            $data["zones"] = $novaposhta->getZonesByCountryId(220);
            $data["references"] = $novaposhtaApi->getReferences();
            if (isset($data["references"]["senders"]) && is_array($data["references"]["senders"])) {
                $data["senders"] = $data["references"]["senders"];
            } else {
                $data["senders"] = [];
            }
            if (isset($data["references"]["sender_options"][$data["sender"]]) && is_array($data["references"]["sender_options"][$data["sender"]])) {
                $data["sender_options"] = $data["references"]["sender_options"][$data["sender"]];
            } else {
                $data["sender_options"] = [];
            }
            if (isset($data["references"]["sender_contact_persons"][$data["sender"]]) && is_array($data["references"]["sender_contact_persons"][$data["sender"]])) {
                $data["sender_contact_persons"] = $data["references"]["sender_contact_persons"][$data["sender"]];
            } else {
                $data["sender_contact_persons"] = [];
            }
            if (isset($data["references"]["tires_and_wheels"]) && is_array($data["references"]["tires_and_wheels"])) {
                foreach ($data["references"]["tires_and_wheels"] as $i => $v) {
                    $data["references"]["tires_and_wheels"][$i]["Description"] = $v[$novaposhtaApi->description_field];
                    unset($data["references"]["tires_and_wheels"][$i]["DescriptionRu"]);
                }
            }
            $data["totals"] = [];
            if (isset($order_totals)) {
                foreach ($order_totals as $total) {
                    $data["totals"][] = ["title" => strip_tags($total["title"]),
                        "price" => convertToUAH($total["value"], $order_info["currency_code"], $order_info["currency_value"]),
                        "status" => getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DECLARED_COST', 'false') !== 'false'
                        && $total["class"] == getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DECLARED_COST') ? 1 : 0];
                }
            }
            $data["money_transfer_methods"] = ["on_warehouse" => TEXT_ON_WAREHOUSE, "to_payment_card" => TEXT_TO_PAYMENT_CARD];
            $data["order_id"] = $order_id;
            $data["cn_ref"] = $cn_ref;

            return $data;
        }
    }

    function validateCNForm()
    {
        $novaposhtaApi = new NovaPoshtaAPI();
        $array_matches = [];
        $error = [];

        if (isset($_POST["sender"])) {
            $senders = $novaposhtaApi->getReferences("senders");
            if (!array_key_exists($_POST["sender"], $senders)) {
                $error["errors"]["sender"] = ERROR_SENDER;
            }
        }
        if (isset($_POST["sender_contact_person"])) {
            $sender_contact_persons = $novaposhtaApi->getReferences("sender_contact_persons");
            if (isset($_POST["f_sender"])) {
                $sender = $_POST["f_sender"];
            } else {
                if (isset($_POST["sender"])) {
                    $sender = $_POST["sender"];
                } else {
                    $sender = "";
                }
            }
            if (!($sender && (!isset($sender_contact_persons[$sender]) || array_key_exists($_POST["sender_contact_person"], $sender_contact_persons[$sender])))) {
                $error["errors"]["sender_contact_person"] = ERROR_SENDER_CONTACT_PERSON;
            }
        }
        if (isset($_POST["sender_city_name"])) {
            if (!$_POST["sender_city_name"]) {
                $error["errors"]["sender_city_name"] = ERROR_FIELD;
            } else {
                if (empty($_POST["sender_city"])) {
                    $error["errors"]["sender_city_name"] = ERROR_CITY;
                }
            }
        }
        if (isset($_POST["sender_address_name"])) {
            if (isset($_POST["f_sender"])) {
                $sender = $_POST["f_sender"];
            } else {
                if (isset($_POST["sender"])) {
                    $sender = $_POST["sender"];
                } else {
                    $sender = "";
                }
            }
            if (isset($_POST["sender_city"])) {
                $city = $_POST["sender_city"];
            } else {
                $city = "";
            }
            $sender_addresses = $novaposhtaApi->getSenderAddresses($sender, $city);
            if (!$_POST["sender_address_name"]) {
                $error["errors"]["sender_address_name"] = ERROR_FIELD;
            } else {
                if (!$novaposhtaApi->getWarehouseByCity($_POST["sender_address"], $city) && !isset($sender_addresses[$_POST["sender_address"]])) {
                    $error["errors"]["sender_address_name"] = ERROR_ADDRESS;
                }
            }
        }
        if (isset($_POST["recipient_name"]) && !$_POST["recipient_name"]) {
            $error["errors"]["recipient_name"] = ERROR_FIELD;
        }
        if (isset($_POST["recipient_contact_person"])) {
            if (!preg_match("/[А-яҐґЄєIіЇїё\\-\\`']{2,}\\s+[А-яҐґЄєIіЇїё\\-\\`']{2,}/iu", trim($_POST["recipient_contact_person"]), $array_matches["recipient_contact_person"])) {
                $error["errors"]["recipient_contact_person"] = ERROR_FULL_NAME_CORRECT;
            } else {
                if (preg_match("/[^А-яҐґЄєIіЇїё\\-\\`'\\s]+/iu", $_POST["recipient_contact_person"], $array_matches["recipient_contact_person"])) {
                    $error["errors"]["recipient_contact_person"] = ERROR_CHARACTERS;
                }
            }
        }
        if (isset($_POST["recipient_contact_person_phone"]) && !preg_match("/^(38)[0-9]{10}\$/", $_POST["recipient_contact_person_phone"], $array_matches["recipient_contact_person_phone"])) {
            $error["errors"]["recipient_contact_person_phone"] = ERROR_PHONE;
        }
        if (isset($_POST["recipient_city_name"])) {
            if (!$_POST["recipient_city_name"]) {
                $error["errors"]["recipient_city_name"] = ERROR_FIELD;
            } else {
                if (empty($_POST["recipient_city"])) {
                    $error["errors"]["recipient_city_name"] = ERROR_CITY;
                }
            }
        }
        if (isset($_POST["recipient_warehouse_name"])) {
            if (!$_POST["recipient_warehouse_name"]) {
                $error["errors"]["recipient_warehouse_name"] = ERROR_FIELD;
            } else {
                if (empty($_POST["recipient_warehouse"])) {
                    $error["errors"]["recipient_warehouse_name"] = ERROR_WAREHOUSE;
                }
            }
        }
        if (isset($_POST["recipient_street_name"])) {
            if (!$_POST["recipient_street_name"]) {
                $error["errors"]["recipient_street_name"] = ERROR_FIELD;
            } else {
                if (empty($_POST["recipient_street"])) {
                    $error["errors"]["recipient_street_name"] = ERROR_ADDRESS;
                }
            }
        }
        if (isset($_POST["recipient_house"]) && !$_POST["recipient_house"]) {
            $error["errors"]["recipient_house"] = ERROR_FIELD;
        }
        if (isset($_POST["width"]) && !(preg_match("/^[1-9]{1}[0-9]*\$/", $_POST["width"], $array_matches["width"]) && $_POST["width"] <= 35)) {
            $error["errors"]["width"] = ERROR_WIDTH;
        }
        if (isset($_POST["length"]) && !(preg_match("/^[1-9]{1}[0-9]*\$/", $_POST["length"], $array_matches["length"]) && $_POST["length"] <= 61)) {
            $error["errors"]["length"] = ERROR_LENGTH;
        }
        if (isset($_POST["height"]) && !(preg_match("/^[1-9]{1}[0-9]*\$/", $_POST["height"], $array_matches["width"]) && $_POST["height"] <= 37)) {
            $error["errors"]["height"] = ERROR_HEIGHT;
        }
        if (isset($_POST["weight"]) && !(preg_match("/^[0-9]+(\\.|\\,)?[0-9]*\$/", $_POST["weight"], $array_matches["total_weight"]) && $_POST["weight"])) {
            $error["errors"]["weight"] = ERROR_WEIGHT;
        }
        if (!empty($_POST["volume_general"]) && !(preg_match("/^[0-9]+(\\.|\\,)?[0-9]*\$/", $_POST["volume_general"], $array_matches["volume_general"]) && $_POST["volume_general"])) {
            $error["errors"]["volume_general"] = ERROR_VOLUME;
        }
        if (isset($_POST["seats_amount"]) && !preg_match("/^[1-9]{1}[0-9]*\$/", $_POST["seats_amount"], $array_matches["seats_amount"])) {
            $error["errors"]["seats_amount"] = ERROR_SEATS_AMOUNT;
        }
        if (isset($_POST["declared_cost"]) && !(preg_match("/^[0-9]+(\\.|\\,)?[0-9]*\$/", $_POST["declared_cost"], $array_matches["declared_cost"]) && $_POST["declared_cost"])) {
            $error["errors"]["declared_cost"] = ERROR_SUM;
        }
        if (isset($_POST["departure_description"]) && strlen($_POST["departure_description"]) < 3) {
            $error["errors"]["departure_description"] = ERROR_DEPARTURE_DESCRIPTION;
        }
        if (isset($_POST["delivery_payer"]) && !$_POST["delivery_payer"]) {
            $error["errors"]["delivery_payer"] = ERROR_FIELD;
        }
        if (isset($_POST["third_person"])) {
            $third_persons = $novaposhtaApi->getReferences("third_persons");
            if (!array_key_exists($_POST["third_person"], $third_persons)) {
                $error["errors"]["third_person"] = ERROR_THIRD_PERSON;
            }
        }
        if (isset($_POST["payment_type"]) && !$_POST["payment_type"]) {
            $error["errors"]["payment_type"] = ERROR_FIELD;
        }
        if (isset($_POST["backward_delivery"]) && !$_POST["backward_delivery"]) {
            $error["errors"]["backward_delivery"] = ERROR_FIELD;
        }
        if (isset($_POST["backward_delivery_total"]) && !(preg_match("/^[0-9]+(\\.|\\,)?[0-9]*\$/", $_POST["backward_delivery_total"], $array_matches["backward_delivery_total"]) && $_POST["backward_delivery_total"])) {
            $error["errors"]["backward_delivery_total"] = ERROR_SUM;
        }
        if (isset($_POST["backward_delivery_payer"]) && !$_POST["backward_delivery_payer"]) {
            $error["errors"]["backward_delivery_payer"] = ERROR_FIELD;
        }
        if (isset($_POST["money_transfer_method"]) && !$_POST["money_transfer_method"]) {
            $error["errors"]["money_transfer_method"] = ERROR_FIELD;
        }
        if (isset($_POST["payment_card"]) && !$_POST["payment_card"]) {
            $error["errors"]["payment_card"] = ERROR_FIELD;
        }
        if (isset($_POST["payment_control"]) && !preg_match("/^[0-9]+(\\.|\\,)?[0-9]*\$/", $_POST["payment_control"], $array_matches["payment_control"]) && $_POST["payment_control"]) {
            $error["errors"]["payment_control"] = ERROR_SUM;
        }
        if (isset($_POST["departure_date"])) {
            if (!preg_match("/(0[1-9]|1[0-9]|2[0-9]|3[01])\\.(0[1-9]|1[012])\\.(20)\\d\\d/", $_POST["departure_date"], $array_matches["departure_date"])) {
                $error["errors"]["departure_date"] = ERROR_DATE;
            } else {
                if ($novaposhtaApi->dateDiff($_POST["departure_date"]) < 0) {
                    $error["errors"]["departure_date"] = ERROR_DATE_PAST;
                }
            }
        }
        if (isset($_POST["preferred_delivery_date"]) && $_POST["preferred_delivery_date"]) {
            if (!preg_match("/(0[1-9]|1[0-9]|2[0-9]|3[01])\\.(0[1-9]|1[012])\\.(20)\\d\\d/", $_POST["preferred_delivery_date"], $array_matches["preferred_delivery_date"])) {
                $error["errors"]["preferred_delivery_date"] = ERROR_DATE;
            } else {
                if ($novaposhtaApi->dateDiff($_POST["preferred_delivery_date"]) < 0) {
                    $error["errors"]["preferred_delivery_date"] = ERROR_DATE_PAST;
                }
            }
        }
        if (isset($_POST["additional_information"]) && 100 < strlen($_POST["additional_information"])) {
            $error["errors"]["additional_information"] = ERROR_DEPARTURE_ADDITIONAL_INFORMATION;
        }

        return $error;
    }

    function parseAddress($address): array
    {
        $data = [];
        $matches = [];
        $ul = "/\\b(с|улиця|вул|улица|ул|провулок|пров|переулок|пер|просп|проспект|пр|пр-т|площа|площадь|пл|узвіз|спуск|бульвар|бул|б-р|шосе|шоссе|ш|дорога|проїзд|проезд|алея|будинок|буд|дом|д|квартира|кв)\\b\\.*/ui";
        preg_match($ul, $address, $matches);
        $address = explode(",", preg_replace($ul, "", $address));
        $data["street"] = isset($address[0]) ? trim($address[0]) : "";
        $data["street_type"] = isset($matches[0]) ? $matches[0] : "вул.";
        $data["house"] = isset($address[1]) ? trim($address[1]) : "";
        $data["flat"] = isset($address[2]) ? trim($address[2]) : "";
        return $data;
    }

    function convertToUAH($value, $currency_code, $currency_value): float
    {
        require_once(DIR_WS_CLASSES . 'currencies.php');
        $currencies = new currencies();

        if (!($currency_value && $currency_code == "UAH")) {
            $currency_value = $currencies->currencies['UAH']['value'];
        }
        if ($currency_value != 1) {
            $value *= $currency_value;
        }
        return round($value);
    }

    function getPaymentMethodCodeByText($text_title) {
        $lng = new language();

        $module_active = explode (";",MODULE_PAYMENT_INSTALLED);
        $installed_payment_modules = array();
        for ($i = 0, $n = count($module_active); $i < $n; $i++) {
            if (is_array($module_active)) {
                $file = $module_active[$i];
                if ($file !== '') {
                    // find site languages
                    foreach ($lng->catalog_languages as $cat_lang) {
                        includeLanguages(DIR_FS_CATALOG_LANGUAGES . $cat_lang['directory'] . '/modules/payment/' . $file);
                        $class = substr($file, 0, strrpos($file, '.'));
                        $installed_payment_modules = array(
                            'id' => $class,
                            'text' => getConstantValue('MODULE_PAYMENT_' . strtoupper($class) . '_TEXT_TITLE')
                        );
                        if ($installed_payment_modules['text'] == $text_title) {
                            return $installed_payment_modules['id'];
                        }
                    }
                }
            }
        }
        return false;
    }

    function getDeclaredCost($order_totals)
    {
        $declared_cost = 0;
        foreach ($order_totals as $total) {
            if (getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DECLARED_COST', 'false') !== 'false' && $total["class"] == getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DECLARED_COST')) {
                $declared_cost = $total["value"];
            }
        }
        return $declared_cost;
    }

    function getPaymentControl($order_totals)
    {
        $payment_control = 0;
        foreach ($order_totals as $total) {
            if (getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_CONTROL', 'false') !== 'false' && $total["class"] == getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_PAYMENT_CONTROL')) {
                $payment_control = $total["value"];
            }
        }
        return $payment_control;
    }

    function getCNList(): array
    {
        require_once(DIR_WS_CLASSES . 'currencies.php');
        $currencies = new currencies();

        $novaposhtaApi = new NovaPoshtaAPI();
        $novaposhta = new novaposhta();

        $url = "";
        if (isset($_GET["filter_cn_number"])) {
            $filter_cn_number = $_GET["filter_cn_number"];
            $url .= "&filter_cn_number=" . urlencode(html_entity_decode($_GET["filter_cn_number"], ENT_QUOTES, "UTF-8"));
        } else {
            $filter_cn_number = "";
        }
        if (isset($_GET["filter_cn_type"])) {
            $filter_cn_type = $_GET["filter_cn_type"];
            foreach ($_GET["filter_cn_type"] as $v) {
                $url .= "&filter_cn_type[]=" . urlencode(html_entity_decode($v, ENT_QUOTES, "UTF-8"));
            }
        } else {
            $filter_cn_type = [];
        }
        if (isset($_GET["filter_departure_date_from"])) {
            $filter_departure_date_from = $_GET["filter_departure_date_from"];
            $url .= "&filter_departure_date_from=" . urlencode(html_entity_decode($_GET["filter_departure_date_from"], ENT_QUOTES, "UTF-8"));
        } else {
            $filter_departure_date_from = date("d.m.Y");
        }
        if (isset($_GET["filter_departure_date_to"])) {
            $filter_departure_date_to = $_GET["filter_departure_date_to"];
            $url .= "&filter_departure_date_to=" . urlencode(html_entity_decode($_GET["filter_departure_date_to"], ENT_QUOTES, "UTF-8"));
        } else {
            $filter_departure_date_to = "";
        }
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        }
        if (getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_PRINT_FORMAT') == "document_A4") {
            $print_format = "printDocument";
            $page_format = "A4";
        } else {
            if (getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_PRINT_FORMAT') == "document_A5") {
                $print_format = "printDocument";
                $page_format = "A5";
            } else {
                if (getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_PRINT_FORMAT') == "markings_A4") {
                    $print_format = "printMarkings";
                    $page_format = "A4";
                    if (getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_TEMPLATE_TYPE') == "html") {
                        $print_direction = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_PRINT_TYPE');
                        $position = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_PRINT_START');
                    }
                }
            }
        }
        $data["customized_printing"] = "https://my.novaposhta.ua/orders/" . $print_format . "/apiKey/" . $novaposhtaApi->key_api . "/type/" . getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_TEMPLATE_TYPE') . "/pageFormat/" . $page_format . "/copies/" . getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_NUMBER_OF_COPIES');
        if (isset($print_direction)) {
            $data["customized_printing"] .= "/printDirection/" . $print_direction . "/position/" . $position;
        }
        $data["print_cn_pdf"] = "https://my.novaposhta.ua/orders/printDocument/apiKey/" . $novaposhtaApi->key_api . "/type/pdf";
        $data["print_cn_html"] = "https://my.novaposhta.ua/orders/printDocument/apiKey/" . $novaposhtaApi->key_api . "/type/html";
        $data["print_markings_pdf"] = "https://my.novaposhta.ua/orders/printMarkings/apiKey/" . $novaposhtaApi->key_api . "/type/pdf";
        $data["print_markings_html"] = "https://my.novaposhta.ua/orders/printMarkings/apiKey/" . $novaposhtaApi->key_api . "/type/html";
        $data["print_markings_zebra_pdf"] = "https://my.novaposhta.ua/orders/printMarkings/apiKey/" . $novaposhtaApi->key_api . "/zebra/zebra/type/pdf";
        $data["print_markings_zebra_html"] = "https://my.novaposhta.ua/orders/printMarkings/apiKey/" . $novaposhtaApi->key_api . "/zebra/zebra/type/html";
        $data["print_markings_zebra_100_100_pdf"] = "https://my.novaposhta.ua/orders/printMarking100x100/apiKey/" . $novaposhtaApi->key_api . "/type/pdf";
        $data["print_markings_zebra_100_100_html"] = "https://my.novaposhta.ua/orders/printMarking100x100/apiKey/" . $novaposhtaApi->key_api . "/type/html";

        $data["back_to_orders"] = $_SERVER['HTTP_REFERER'];

        if (isset($data["success"])) {
            $data["success"] = $data["success"];
            $data["cn_number"] = $data["cn"];
            unset($data["success"]);
            unset($data["cn"]);
        } else {
            $data["success"] = "";
            $data["cn_number"] = "";
        }

        $cn_properties = [];
        if ($filter_cn_number) {
            $cn_properties["IntDocNumber"] = $filter_cn_number;
        }
        foreach ($filter_cn_type as $fct) {
            $cn_properties[$fct] = 1;
        }
        $cns = $novaposhtaApi->getCNList($filter_departure_date_from, $filter_departure_date_to, $cn_properties);
        if ($cns && is_array($cns)) {
            $service_types = $novaposhtaApi->getReferences();
            unset($service_types['payment_cards']);
            foreach ($service_types as $i => $service_type) {
                foreach ($service_type as $k => $v) {
                    if (isset($v["Ref"])) {
                        $service_types[$i][$v["Ref"]] = $v["Description"];
                        unset($service_types[$i][$k]);
                    }
                }
            }
            foreach ($cns as $k => $cn) {
                $order = $novaposhta->getOrderByDocumentNumber($cn["IntDocNumber"]);
                if (!getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_DISPLAY_ALL_CONSIGNMENTS') && !$order) {
                    unset($cns[$k]);
                } else {
                    if ($order) {
                        $cns[$k]["order"] = tep_href_link("orders.php?page=1&perPage=25&action=edit_orders", "id&action=edit_orders&id=" . $order["orders_id"], true);
                        $cns[$k]["order_id"] = $order["orders_id"];
                    }
                    $cns[$k]["create_date"] = date("Y-m-d H:i:s", strtotime($cn["CreateTime"]));
                    $cns[$k]["actual_shipping_date"] = date("Y-m-d H:i:s", strtotime($cn["DateTime"]));
                    if (strtotime($cn["PreferredDeliveryDate"])) {
                        $cns[$k]["preferred_shipping_date"] = date("Y-m-d H:i:s", strtotime($cn["PreferredDeliveryDate"]));
                    } else {
                        $cns[$k]["preferred_shipping_date"] = "";
                    }
                    $cns[$k]["estimated_shipping_date"] = date("Y-m-d H:i:s", strtotime($cn["EstimatedDeliveryDate"]));
                    if (strtotime($cn["RecipientDateTime"])) {
                        $cns[$k]["recipient_date"] = date("Y-m-d H:i:s", strtotime($cn["RecipientDateTime"]));
                    } else {
                        $cns[$k]["recipient_date"] = "";
                    }
                    $cns[$k]["last_updated_status_date"] = date("Y-m-d H:i:s", strtotime($cn["DateLastUpdatedStatus"]));
                    $cns[$k]["sender"] = $cn["SenderDescription"];
                    if ($cn["SendersPhone"]) {
                        $cns[$k]["sender"] .= " " . $cn["SendersPhone"];
                    }
                    $cns[$k]["sender_address"] = $cn["CitySenderDescription"] . ", " . $cn["SenderAddressDescription"];
                    $cns[$k]["recipient"] = $cn["RecipientDescription"] . ": " . $cn["RecipientContactPerson"] . " " . $cn["RecipientContactPhone"];
                    $cns[$k]["recipient_address"] = $cn["CityRecipientDescription"] . ", " . $cn["RecipientAddressDescription"];
                    $cns[$k]["declared_cost"] = $currencies->format($cn["Cost"], false, "UAH");
                    $cns[$k]["shipping_cost"] = $currencies->format($cn["CostOnSite"], false, "UAH");
                    if ($cn["BackwardDeliveryCargoType"]) {
                        $cns[$k]["backward_delivery"] = $cn["BackwardDeliveryCargoType"] . ": " . $currencies->format($cn["BackwardDeliverySum"], false, "UAH");
                    } else {
                        $cns[$k]["backward_delivery"] = "";
                    }
                    $cns[$k]["service_type"] = $service_types["service_types"][$cn["ServiceType"]];
                    $cns[$k]["payer_type"] = $service_types["payer_types"][$cn["PayerType"]];
                    $cns[$k]["payment_method"] = $service_types["payment_types"][$cn["PaymentMethod"]];
                    $cns[$k]["departure_type"] = $service_types["cargo_types"][$cn["CargoType"]];
                    $cns[$k]["status"] = "(" . ENTRY_CODE . " " . $cn["StateId"] . ") " . $cn["StateName"];
                }
            }
            $cns_total = count($cns);
            $cns = array_slice($cns, ($page - 1) * 10, 10);
        } else {
            $cns_total = 0;
        }
        $data["cns"] = $cns;
        $data["key_api"] = $novaposhtaApi->key_api;
        $data["filters"] = ["RedeliveryMoney" => TEXT_REDELIVERY_MONEY, "UnassembledCargo" => TEXT_UNASSEMBLED_CARGO];
        $data["print_formats"] = ["document_A4" => TEXT_CN_A4, "document_A5" => TEXT_CN_A5, "markings_A4" => TEXT_MARK];
        $data["template_types"] = ["html" => TEXT_HTML, "pdf" => TEXT_PDF];
        $data["print_types"] = ["horPrint" => TEXT_HORIZONTALLY, "verPrint" => TEXT_VERTICALLY];
        if (!empty(getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_CONSIGNMENT_DISPLAYED_INFORMATION'))) {
            $data["displayed_information"] = explode( ', ', getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_CONSIGNMENT_DISPLAYED_INFORMATION'));
        } else {
            $data["displayed_information"] = ['cn_number', 'order_number', 'estimated_shipping_date', 'recipient',
                'recipient_address', 'shipping_cost', 'status'];
        }
        $data["filter_cn_number"] = $filter_cn_number;
        $data["filter_cn_type"] = $filter_cn_type;
        $data["filter_departure_date_from"] = $filter_departure_date_from;
        $data["filter_departure_date_to"] = $filter_departure_date_to;

        return $data;
    }

    function saveCN(): array
    {
        $error = validateCNForm();
        $novaposhtaApi = new NovaPoshtaAPI();
        $novaposhta = new novaposhta();
        $json = [];

        if (!isset($error['errors'])) {
            $properties_cn = ["NewAddress" => 1, "Sender" => $_POST["sender"], "ContactSender" => $_POST["sender_contact_person"], "SendersPhone" => $_POST["sender_contact_person_phone"], "CitySender" => $_POST["sender_city"], "SenderAddress" => $_POST["sender_address"], "Recipient" => "", "RecipientsPhone" => $_POST["recipient_contact_person_phone"], "CargoType" => $_POST["departure_type"], "SeatsAmount" => $_POST["seats_amount"], "Cost" => $_POST["declared_cost"], "Description" => $_POST["departure_description"], "PayerType" => $_POST["delivery_payer"], "PaymentMethod" => $_POST["payment_type"], "DateTime" => $_POST["departure_date"]];
            if ($properties_cn["SendersPhone"] === '') {
                $properties_cn["SendersPhone"] = $novaposhtaApi->getReferences("sender_contact_persons")[$properties_cn["Sender"]][$properties_cn["ContactSender"]]['Phones'];
            }
            if ($_POST["recipient_address_type"] == "doors") {
                $address_type = "Doors";
            } else {
                $address_type = "Warehouse";
            }
            if (getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_SENDER_ADDRESS_TYPE')) {
                $properties_cn["ServiceType"] = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_SENDER_ADDRESS_TYPE') . $address_type;
            } else {
                $properties_cn["ServiceType"] = "Warehouse" . $address_type;
            }
            if (!$_POST["recipient"]) {
                $recipient_name_parts = explode(" ", preg_replace("/ {2,}/", " ", trim($_POST["recipient_name"])), 2);
                if (empty($recipient_name_parts[1])) {
                    $recipient_name_parts[1] = $recipient_name_parts[0];
                    $recipient_name_parts[0] = "ПП";
                }
                $result = $novaposhtaApi->getCounterparties("Recipient", $recipient_name_parts[1]);
                if ($result) {
                    $recipient_data = array_shift($result);
                } else {
                    $ownership_form = getOwnreshipForm($recipient_name_parts[0]);
                    $properties_r = ["CityRef" => $_POST["recipient_city"], "FirstName" => $recipient_name_parts[1], "CounterpartyType" => "Organization", "CounterpartyProperty" => "Recipient", "OwnershipForm" => $ownership_form["Ref"]];
                    $recipient_data = $novaposhtaApi->saveCounterparties($properties_r);
                }
                if ($recipient_data) {
                    $properties_cn["Recipient"] = $recipient_data["Ref"];
                }
            } else {
                $properties_cn["Recipient"] = $_POST["recipient"];
            }
            if ($_POST["recipient_address_type"] != "doors") {
                $properties_cn["CityRecipient"] = $_POST["recipient_city"];
                $properties_cn["RecipientAddress"] = $_POST["recipient_warehouse"];
            } else {
                $counterparty_addresses = $novaposhtaApi->getCounterpartyAddresses($properties_cn["Recipient"], "Recipient", $_POST["recipient_city"]);
                if ($counterparty_addresses) {
                    foreach ($counterparty_addresses as $k => $v) {
                        if ($v["BuildingDescription"] == $_POST["recipient_house"] && ((!$_POST["recipient_flat"] && mb_stripos($v["Description"], "кв.") === false) || ($_POST["recipient_flat"] && mb_stripos($v["Description"], "кв. " . $_POST["recipient_flat"]) !== false))) {
                            $properties_cn["CityRecipient"] = $_POST["recipient_city"];
                            $properties_cn["RecipientAddress"] = $k;
                        }
                    }
                }
                if (empty($properties_cn["RecipientAddress"])) {
                    $properties_cn["RecipientArea"] = $_POST["recipient_region_name"];
                    $properties_cn["RecipientAreaRegions"] = $_POST["recipient_district_name"];
                    $properties_cn["RecipientCityName"] = $_POST["recipient_city_name"];
                    $properties_cn["RecipientAddressName"] = $_POST["recipient_street_name"];
                    $properties_cn["RecipientHouse"] = $_POST["recipient_house"];
                    $properties_cn["RecipientFlat"] = $_POST["recipient_flat"];
                }
            }
            if (isset($recipient_data["CounterpartyType"]) && $recipient_data["CounterpartyType"] == "Organization") {
                $properties_cn["RecipientName"] = $recipient_data["FirstName"];
                $properties_cn["RecipientContactName"] = $novaposhta->to_cyrillic(preg_replace("/ {2,}/", " ", mb_convert_case(trim($_POST["recipient_contact_person"]), MB_CASE_TITLE, "UTF-8")));
                $properties_cn["RecipientType"] = $recipient_data["CounterpartyType"];
                if (!empty($recipient_data["OwnershipForm"])) {
                    $properties_cn["OwnershipForm"] = $recipient_data["OwnershipForm"];
                } else {
                    if (!empty($recipient_data["OwnershipFormRef"])) {
                        $properties_cn["OwnershipForm"] = $recipient_data["OwnershipFormRef"];
                    }
                }
            } else {
                $properties_cn["RecipientName"] = $novaposhta->to_cyrillic(preg_replace("/ {2,}/", " ", mb_convert_case(trim($_POST["recipient_contact_person"]), MB_CASE_TITLE, "UTF-8")));
                $properties_cn["RecipientType"] = "PrivatePerson";
            }
            if (isset($_POST["third_person"])) {
                $properties_cn["ThirdPerson"] = $_POST["third_person"];
            }
            if (isset($_POST["recipient_warehouse_name"]) && preg_match("/поштомат|почтомат/ui", $_POST["recipient_warehouse_name"]) && $_POST["departure_type"] == "Parcel") {
                $properties_cn["OptionsSeat"][] = ["volumetricVolume" => $_POST["volume_general"], "volumetricWidth" => $_POST["width"], "volumetricLength" => $_POST["length"], "volumetricHeight" => $_POST["height"], "weight" => $_POST["weight"], "volumetricWeight" => $_POST["volume_weight"]];
            } else {
                if ($_POST["departure_type"] == "TiresWheels") {
                    foreach ($_POST["tires_and_wheels"] as $ref => $amount) {
                        if ($amount) {
                            $properties_cn["CargoDetails"][] = ["CargoDescription" => $ref, "Amount" => $amount];
                        }
                    }
                } else {
                    if (isset($_POST["weight"])) {
                        $properties_cn["Weight"] = $_POST["weight"];
                    }
                    if (isset($_POST["volume_general"])) {
                        $properties_cn["VolumeGeneral"] = $_POST["volume_general"];
                    }
                    if (isset($_POST["volume_weight"])) {
                        $properties_cn["VolumeWeight"] = $_POST["volume_weight"];
                    }
                }
            }
            if (!empty($_POST["redbox_barcode"])) {
                $properties_cn["RedBoxBarcode"] = $_POST["redbox_barcode"];
            }
            if ($_POST["backward_delivery"] && $_POST["backward_delivery"] != "N" && $_POST["backward_delivery"] == "Money") {
                $properties_cn["BackwardDeliveryData"][0] = ["CargoType" => $_POST["backward_delivery"], "PayerType" => $_POST["backward_delivery_payer"], "RedeliveryString" => $_POST["backward_delivery_total"]];
                if ($_POST["money_transfer_method"] == "to_payment_card") {
                    $properties_cn["BackwardDeliveryData"][0]["PaymentCard"] = $_POST["payment_card"];
                }
            }
            if (!empty($_POST["payment_control"])) {
                $properties_cn["AfterpaymentOnGoodsCost"] = $_POST["payment_control"];
            }
            if (!empty($_POST["preferred_delivery_date"])) {
                $properties_cn["PreferredDeliveryDate"] = $_POST["preferred_delivery_date"];
            }
            if (!empty($_POST["time_interval"])) {
                $properties_cn["TimeInterval"] = $_POST["time_interval"];
            }
            if (!empty($_POST["sales_order_number"])) {
                $properties_cn["InfoRegClientBarcodes"] = $_POST["sales_order_number"];
            }
            if (!empty($_POST["packing_number"])) {
                $properties_cn["PackingNumber"] = $_POST["packing_number"];
            }
            if (!empty($_POST["additional_information"])) {
                $properties_cn["AdditionalInformation"] = $_POST["additional_information"];
            }
            if (isset($_POST["rise_on_floor"])) {
                $properties_cn["NumberOfFloorsLifting"] = $_POST["rise_on_floor"];
            }
            if (isset($_POST["elevator"])) {
                $properties_cn["Elevator"] = 1;
            }
            if (!empty($_GET["cn_ref"])) {
                $properties_cn["Ref"] = $_GET["cn_ref"];
            }
            $result = $novaposhtaApi->saveCN($properties_cn);
            if ($result) {
                if (!empty($_GET["order_id"])) {
                    $novaposhta->addCNToOrder($_GET["order_id"], $result["IntDocNumber"], $result["Ref"]);
                }
            } else {
                $error["warning"] = $novaposhtaApi->error;
                $error["warning"][] = ERROR_CN_SAVE;
            }
        }
        if ($error) {
            $json = $error;
            echo json_encode($json, JSON_THROW_ON_ERROR);
            exit;
        } else {
            if (!empty($result["IntDocNumber"])) {
                $data["cn"] = $result["IntDocNumber"];
                $data["success"] = TEXT_CN_SUCCESS_SAVE;
                $json["success"] = $_POST["departure_date"];
            }
        }

        return $json;
    }

    function getOwnreshipForm($name)
    {
        $novaposhtaApi = new NovaPoshtaAPI();
        $ownership_forms = $novaposhtaApi->getReferences("ownership_forms");
        $data = $ownership_forms[0];
        foreach ($ownership_forms as $ownership_form) {
            if (preg_match("/^(" . preg_quote($name) . ")/iu", $ownership_form["Description"])) {
                $data = $ownership_form;
                return $data;
            }
        }
    }

    function deleteCN(): array
    {
        $novaposhtaApi = new NovaPoshtaAPI();

        $json = [];
        if (isset($_POST["refs"])) {
            if (!empty($_POST["orders"])) {
                deleteCNFromOrder();
            }
            $data = $novaposhtaApi->deleteCN($_POST["refs"]);
            if ($data) {
                $json["success"]["refs"] = $data;
                $json["success"]["text"] = TEXT_SUCCESS_DELETE;
            } else {
                $json["warning"] = $novaposhtaApi->error;
                $json["warning"][] = ERROR_DELETE;
            }
        } else {
            $json["warning"][] = $error["warning"];
        }

        return $json;
    }

    function addCNToOrder(): array
    {
        $novaposhtaApi = new NovaPoshtaAPI();
        $novaposhta = new novaposhta();

        $json = [];

        if (isset($_POST["order_id"])) {
            if (isset($_POST["cn_number"]) && isset($_POST["cn_ref"])) {
                $result = $novaposhta->addCNToOrder($_POST["order_id"], $_POST["cn_number"], $_POST["cn_ref"]);
            } else {
                $documents = $novaposhtaApi->getCNList("", "", ["IntDocNumber" => $_POST["cn_number"]]);
                if (isset($documents[0])) {
                    $result = $novaposhta->addCNToOrder($_POST["order_id"], $documents[0]["IntDocNumber"], $documents[0]["Ref"]);
                }
                if (empty($result)) {
                    $track = $novaposhtaApi->tracking([["DocumentNumber" => $_POST["cn_number"], "Phone" => ""]]);
                    if ($track) {
                        $result = $novaposhta->addCNToOrder($_POST["order_id"], $_POST["cn_number"]);
                    }
                }
            }
            if (empty($result)) {
                $json["error"] = ERROR_CN_ASSIGNMENT;
            } else {
                $json["success"] = TEXT_CN_SUCCESS_ASSIGNMENT;
            }
        } else {
            $json["error"] = $error["warning"];
        }

        return $json;
    }

    function deleteCNFromOrder(): array
    {
        $novaposhtaApi = new NovaPoshtaAPI();
        $novaposhta = new novaposhta();

        $json = [];
        if (isset($_POST["orders"])) {
            $order = $novaposhta->getOrder($_POST["orders"][0]);
            if (!empty($order["novaposhta_cn_number"])) {
                //$novaposhtaApi->deleteCN($order["novaposhta_cn_ref"]);
                $novaposhta->deleteCNFromOrder($_POST["orders"]);
                $json["success"] = TEXT_SUCCESS_DELETE;
            } else {
                $json["error"] = ERROR_DELETE;
            }
        } else {
            $json["error"] = $error["warning"];
        }
        return $json;
    }

    function verifyingAPIaccess(): array
    {
        $novaposhtaApi = new NovaPoshtaAPI();

        $json = [];
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
        } else {
            $action = "";
        }
        if (isset($_POST["key"])) {
            $key = $_POST["key"];
        } else {
            $key = "";
        }
        $novaposhtaApi->key_api = $key;
        if ($action == "check") {
            $data = $novaposhtaApi->getCounterparties("Sender");
            if ($data) {
                $database = $novaposhtaApi->getReferences("database");
                if (empty($database)) {
                    $json["next_action"] = "regions";
                    $json["next_action_text"] = TEXT_REGIONS_UPDATING;
                } else {
                    $json["next_action"] = "references";
                    $json["next_action_text"] = TEXT_REFERENCES_UPDATING;
                }
            } else {
                $json["error"][] = ERROR_KEY_API;
            }
        } else {
            if ($action == "regions") {
                $data = $novaposhtaApi->update("areas");
                if ($data === false) {
                    $json["error"][] = ERROR_UPDATE;
                } else {
                    $json["next_action"] = "cities";
                    $json["next_action_text"] = TEXT_CITIES_UPDATING;
                }
            } else {
                if ($action == "cities") {
                    $data = $novaposhtaApi->update("cities");
                    if ($data === false) {
                        $json["error"][] = ERROR_UPDATE;
                    } else {
                        $json["next_action"] = "warehouses";
                        $json["next_action_text"] = TEXT_WAREHOUSES_UPDATING;
                    }
                } else {
                    if ($action == "warehouses") {
                        $data = $novaposhtaApi->update("warehouses");
                        if ($data === false) {
                            $json["error"][] = ERROR_UPDATE;
                        } else {
                            $json["next_action"] = "references";
                            $json["next_action_text"] = TEXT_REFERENCES_UPDATING;
                        }
                    } else {
                        if ($action == "references") {
                            $data = $novaposhtaApi->update("references");
                            if ($data === false) {
                                $json["error"][] = ERROR_UPDATE;
                            } else {
                                if (!empty(getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_RECIPIENT_NAME'))) {
                                    $recipient = current($novaposhtaApi->getCounterparties("Recipient", getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_RECIPIENT_NAME')));
                                    $json["recipient"] = $recipient["Ref"];
                                }
                                $json["next_action"] = "saving";
                                $json["next_action_text"] = TEXT_SAVING_SETTINGS;
                            }
                        }
                    }
                }
            }
        }
        if (!empty($novaposhtaApi->error) && isset($json["error"])) {
            $json["error"] = array_merge($json["error"], $novaposhtaApi->error);
        }
        return $json;
    }

    function update(): array
    {
        $novaposhtaApi = new NovaPoshtaAPI();
        if (isset($_GET["type"])) {
            $type = $_GET["type"];
        }
        $amount = $novaposhtaApi->update($type);
        if ($amount === false) {
            $json["error"] = ERROR_UPDATE;
        } else {
            $json["success"] = TEXT_UPDATE_SUCCESS;
            $json["amount"] = $amount;
        }

        return $json;
    }

    function getNPData()
    {
        $novaposhtaApi = new NovaPoshtaAPI();
        $json = [];
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
        } else {
            $action = "";
        }
        if (isset($_POST["filter"])) {
            $filter = $_POST["filter"];
        } else {
            $filter = "";
        }
        if (isset($_POST["delivery_date"])) {
            $delivery_date = $_POST["delivery_date"];
        } else {
            $delivery_date = "";
        }
        switch ($action) {
            case "getContactPerson":
                $sender_contact_persons = $novaposhtaApi->getReferences("sender_contact_persons");
                if (isset($sender_contact_persons[$filter])) {
                    $json = $sender_contact_persons[$filter];
                }
                return $json;
                break;
            case "getAddressType":
                $json["address_type"] = $novaposhtaApi->getWarehouseName($filter) ? "Warehouse" : "Doors";
                return $json;
                break;
            case "getSenderOptions":
                $sender_options = $novaposhtaApi->getReferences("sender_options");
                if (isset($sender_options[$filter])) {
                    $json = $sender_options[$filter];
                }
                return $json;
                break;
            case "getTimeIntervals":
                $json = $novaposhtaApi->getTimeIntervals($novaposhtaApi->getCityRef($filter), $delivery_date);
                return $json;
                break;
            default:
                return $json;
        }
    }

    function autocomplete()
    {
        $novaposhtaApi = new NovaPoshtaAPI();
        $novaposhta = new novaposhta();

        if (isset($_POST["recipient_name"])) {
            $recipients = $novaposhtaApi->getCounterparties("Recipient", $_POST["recipient_name"]);
            if ($recipients) {
                $recipients = array_slice($recipients, 0, 10);
                foreach ($recipients as $k => $recipient) {
                    $recipients[$k]["FullDescription"] = $recipient["OwnershipFormDescription"] . " " . $recipient["Description"];
                    if ($recipient["CityDescription"]) {
                        $recipients[$k]["FullDescription"] .= " (" . $recipient["CityDescription"] . ")";
                    }
                }
                $json = $recipients;
            }
        } else {
            if (isset($_POST["city"])) {
                $area_ref = "";
                if (isset($_POST["region"]) && $_POST["region"] !== '') {
                    $zone = $novaposhta->getZoneById($_POST["region"]);
                    if ($zone) {
                        $area_ref = $novaposhtaApi->getAreaRef($zone["zone_name"]);
                    }
                }
                $json = $novaposhtaApi->getCities($_POST["city"], $area_ref);
            } else {
                if (isset($_POST["settlement"])) {
                    $settlements = $novaposhtaApi->searchSettlements($_POST["settlement"]);
                    if ($settlements) {
                        foreach ($settlements as $settlement) {
                            $json[] = ["Ref" => $settlement["Ref"], "Description" => $settlement["MainDescription"], "Area" => $settlement["Area"], "Region" => $settlement["Region"], "FullDescription" => $settlement["Present"]];
                        }
                    }
                } else {
                    if (isset($_POST["address"])) {
                        $warehouses = $novaposhtaApi->getWarehousesByCityRef($_POST["filter"], $_POST["address"]);
                        $addresses = $novaposhtaApi->getSenderAddresses($_POST["sender"], $_POST["filter"]);
                        if ($_POST["address"]) {
                            foreach ($addresses as $k => $v) {
                                unset($addresses[$k]);
                                if (mb_stripos($v["Description"], $_POST["address"]) !== false) {
                                    $addresses[] = $v;
                                }
                            }
                        }
                        $json = array_merge($warehouses, $addresses);
                    } else {
                        if (isset($_POST["warehouse"])) {
                            $json = $novaposhtaApi->getWarehousesByCityRef($_POST["filter"], $_POST["warehouse"]);
                        } else {
                            if (isset($_POST["street"])) {
                                $streets = $novaposhtaApi->searchSettlementStreets($_POST["filter"], $_POST["street"], 20);
                                if ($streets) {
                                    foreach ($streets as $street) {
                                        $json[] = ["Ref" => $street["SettlementStreetRef"], "Description" => $street["Present"]];
                                    }
                                }
                            } else {
                                if (!empty($_POST["departure_description"])) {
                                    $limit = 5;
                                    $descriptions = $novaposhtaApi->getReferences("cargo_description");
                                    foreach ($descriptions as $description) {
                                        if (preg_match("/^(" . preg_quote($_POST["departure_description"]) . ").+/iu", $description[$novaposhtaApi->description_field])) {
                                            $limit--;
                                            $json[] = $description;
                                        }
                                        if (!$limit) {
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $json;
    }


    switch ($_GET['request']) {

        case 'getNPData':
            $data = getNPData();
            echo json_encode($data, JSON_THROW_ON_ERROR);
            break;

        case 'saveCN':
            $data = saveCN();
            echo json_encode($data, JSON_THROW_ON_ERROR);
            exit;

        case 'autocomplete':
            $data = autocomplete();
            echo json_encode($data, JSON_THROW_ON_ERROR);
            break;

        case 'addCNToOrder':
            $data = addCNToOrder();
            echo json_encode($data, JSON_THROW_ON_ERROR);
            exit;
    }


    switch ($_REQUEST['action']) {

        case 'getCNForm':
            ob_start();
            $data = getCNForm();
            require_once 'includes/modules/novaposhta/novaposhta_cn_form.tpl.php';
            $form = ob_get_contents();
            ob_end_clean();
            echo json_encode(array('html' => $form));
            break;

        case 'getCNList':
            ob_start();
            $data = getCNList();
            require_once 'includes/modules/novaposhta/novaposhta_cn_list.tpl.php';
            $form = ob_get_contents();
            ob_end_clean();
            echo json_encode(array('html' => $form));
            break;

        case 'assignmentCN':
            ob_start();
            //$data = getCNList();
            require_once 'includes/modules/novaposhta/novaposhta_assignment_cn_form.tpl.php';
            $form = ob_get_contents();
            ob_end_clean();
            echo json_encode(array('html' => $form));
            break;

        case 'deleteCN':
            $data = deleteCN();
            echo json_encode($data, JSON_THROW_ON_ERROR);
            exit;

        case 'addCNToOrder':
            $data = addCNToOrder();
            echo json_encode($data, JSON_THROW_ON_ERROR);
            exit;

    }
}
