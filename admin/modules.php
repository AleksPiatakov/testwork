<?php
/*
  $Id: modules.php,v 1.2 2003/09/24 15:18:15 wilt Exp $
  ++++ modified as USPS Methods 2.5 08/02/03 by Brad Waite and Fritz Clapp ++++
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

use admin\includes\solomono\app\models\ship2pay\ship2pay;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('includes/application_top.php');
include_once $module_directory . '../includes/classes/Traits/EmptyPaymentMethod.php';
define('API_MODULES_ADDRESS', 'https://solomono.net/api/v1/modules.php');
$set = (isset($_GET['set']) ? $_GET['set'] : '');
if (tep_not_null($set)) {
    switch ($set) {
        case 'shipping':
            $module_type = 'shipping';
            $module_directory = DIR_FS_CATALOG_MODULES . 'shipping/';
            $module_key = 'MODULE_SHIPPING_INSTALLED';
            define('HEADING_TITLE', HEADING_TITLE_MODULES_SHIPPING);
            break;
        case 'order_total':
        case 'ordertotal':
            $module_type = 'order_total';
            $module_directory = DIR_FS_CATALOG_MODULES . 'order_total/';
            $module_key = 'MODULE_ORDER_TOTAL_INSTALLED';
            define('HEADING_TITLE', HEADING_TITLE_MODULES_ORDER_TOTAL);
            break;
        default:
            $module_type = 'payment';
            $module_directory = DIR_FS_CATALOG_MODULES . 'payment/';
            $module_key = 'MODULE_PAYMENT_INSTALLED';
            define('HEADING_TITLE', HEADING_TITLE_MODULES_PAYMENT);
            break;
    }
}

/**
 * @param string $module_type
 * @param string $file_extension
 * @return void
 */
function sortModules($module_type, $file_extension)
{
    $module_type = strtoupper($module_type);
    $allSortOrdersql = tep_db_query(
        'SELECT 
            `configuration_key` as ck, 
            `configuration_value` 
        FROM 
            ' . TABLE_CONFIGURATION . ' 
        WHERE 
            `configuration_key` like "%MODULE_' . $module_type . '_%_SORT_ORDER%" 
        order by configuration_value + 0'
    );
    $installedMod = '';
    $arr = [
        'MODULE_' . $module_type . '_',
        '_SORT_ORDER'
    ];
    while ($allSortOrder = tep_db_fetch_array($allSortOrdersql)) {
        $installedMod .= ';' . mb_strtolower(str_replace($arr, '', $allSortOrder['ck']), "UTF-8") .
            $file_extension;
    }

    tep_db_query(
        "UPDATE "
        . TABLE_CONFIGURATION .
        " SET configuration_value = '" . $installedMod .
        "' WHERE configuration_key = 'MODULE_" . $module_type . "_INSTALLED'"
    );
}

/**
 * @param string $class
 * @param array $configuration
 * @return objectInfo
 */
function makeModule ($class, $configuration)
{
    $module = new $class;
    $module_info = [
        'code' => $module->code,
        'title' => $module->title,
        'description' => $module->description,
        'status' => $module->check()
    ];
    $module_keys = $module->keys();
    $keys_extra = [];
    foreach ($module_keys as $module_key_edit) {
        $key_value_query = tep_db_query("
                        select 
                            configuration_title, 
                            configuration_value, 
                            configuration_key, 
                            configuration_description, 
                            use_function, 
                            set_function 
                        from 
                            " . TABLE_CONFIGURATION . " 
                        where 
                            configuration_key = '" . $module_key_edit . "'");
        $key_value = tep_db_fetch_array($key_value_query);
        $title = strtoupper($configuration['configuration_key'] . '_TITLE');
        $keys_extra[$module_key_edit] = [
            'title' => defined($title) ? constant($title) : $key_value['configuration_title'],
            'value' => $key_value['configuration_value'],
            'description' => $key_value['configuration_description'],
            'use_function' => $key_value['use_function'],
            'set_function' => $key_value['set_function']
        ];
    }

    $module_info['keys'] = $keys_extra;
    $mInfo = new objectInfo($module_info);

    return $mInfo;
}

function getPaymentModules(){
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
    $installed_modules = array();
    for ($i = 0, $n = sizeof($directory_array); $i < $n; $i++) {
        $file = $directory_array[$i];
        if (in_array($directory_array[$i], $module_active)) {
            includeLanguages(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/modules/payment/' . $file);
            include($module_payment_directory . $file);

            $class = substr($file, 0, strrpos($file, '.'));
            if (tep_class_exists($class)) {
                $module = new $class;
                if ($module->check() > 0) {
                    $installed_modules[$module->code.'.php'] = $module->title;
                }
            }
        }
    }
    return $installed_modules;
}

//edit functions:

//drawShipToPayContent
function drawShipToPayContent($zones, $payment_modules, $key, $shipToPay = [], $isNew = true)
{
    //zones
    $name = $isNew ? 'new[zones_id][' . $key . ']' : 'zones_id[' . $key . ']';
    $shipToPayContentZones = '<select name="' . $name . '" id="zones_id" class="form-control">';
    foreach ($zones as $value => $text) {
        $selected = !$isNew && $shipToPay['zones_id'] == $value ? ' selected' : '';
        $shipToPayContentZones .= '<option value="' . $value . '"' . $selected . '>' . $text . '</option>';
    }
    $shipToPayContentZones .= '</select>';

    //payments
    if (!$isNew) {
        $paymentValues = explode(', ', $shipToPay['payments_allowed']);
    }
    $name = $isNew ? 'new[payments_allowed][' . $key . '][]' : 'payments_allowed[' . $key . '][]';
    $shipToPayContentPayments = '<select multiple="" size="7" name="' . $name . '" id="payments_allowed" class="form-control">';
    foreach ($payment_modules as $paymentModule => $value) {
        $selected = !$isNew && in_array($value, $paymentValues) ? ' selected' : '';
        $shipToPayContentPayments .= '<option value="' . $paymentModule . '"' . $selected . '>' . $value . '</option>';
    }
    $shipToPayContentPayments .= '</select>';

    //status
    $name = $isNew ? 'new[status][' . $key . ']' : 'status[' . $key . ']';
    $checked = $isNew || $shipToPay['status'] ? 'checked' : '';
    $shipToPayContentStatus = '
                        <div style="display: flex; justify-content: center">
                            <input id="cmn-toggle-status-' . $key . '" class="cmn-toggle cmn-toggle-round" type="checkbox" name="' . $name . '" ' . $checked . '>
                            <label for="cmn-toggle-status-' . $key . '"></label>
                        </div>';

    //actions
    if ($isNew) {
        $shipToPayContentActions = '';
        $dataId = '';
    } else {
        $shipToPayContentActions = '<input type="hidden" name="ship2pay_id[' . $key . ']" value="' . $shipToPay['id'] . '">';
        $dataId = 'data-id="' . $shipToPay['id'] . '"';
    }
    $shipToPayContentActions .= '
                        <div style="display: flex; justify-content: center">
                            <a class="del_link" data-href="/admin/ship2pay.php" data-action="delete_ship2pay" ' . $dataId . '><i class="fa fa-trash-o"></i></a>
                        </div>';

    $shipToPayContent = '<tr class="module_model_ship2pay_row">
                                        <td class="col-sm-4">' . $shipToPayContentZones . '</td>
                                        <td class="col-sm-4">' . $shipToPayContentPayments . '</td>
                                        <td class="col-sm-2">' . $shipToPayContentStatus . '</td>
                                        <td class="col-sm-2">' . $shipToPayContentActions . '</td>
                                        </tr>';

    return $shipToPayContent;
}

function displayEditForm($class, $file, $configuration, $isExtModule = false)
{
    global $ship2pay, $ship2fields, $module_type;

    if (tep_class_exists($class)) {
        $mInfo = makeModule($class, $configuration);
        $action = $isExtModule ? 'extsave' : 'save';

        //get shipping tab content
        $content = '';
        reset($mInfo->keys);
        foreach ($mInfo->keys as $key => $value) {
            if($key == 'MODULE_SHIPPING_NWPOSHTANEW_API_KEY'){
                $content .= '<a class="btn btn-sm btn-info" data-href="/admin/novaposhta.php" data-action="update_novaposhta_warehouses"><i class="fa fa-refresh"></i> ' . SHIPPING_UPDATE_WAREHOUSES_TITLE . '</a><br><br>';
                $content .= '<a class="btn btn-sm btn-info" data-href="/admin/novaposhta.php" data-action="update_novaposhta_areas"><i class="fa fa-refresh"></i> ' . SHIPPING_UPDATE_AREAS_TITLE . '</a><br><br>';
                $content .= '<a class="btn btn-sm btn-info" data-href="/admin/novaposhta.php" data-action="update_novaposhta_cities"><i class="fa fa-refresh"></i> ' . SHIPPING_UPDATE_CITIES_TITLE . '</a><br><br>';
                $content .= '<a class="btn btn-sm btn-info" data-href="/admin/novaposhta.php" data-action="update_novaposhta_references"><i class="fa fa-refresh"></i> ' . SHIPPING_UPDATE_REFERENCES_TITLE . '</a><br><br>';

            }
            //get shipping tab content
            if (defined(strtoupper($key . '_TITLE'))) {
                $value['title'] = constant(strtoupper($key . '_TITLE'));
            }

            if (defined(strtoupper($key . '_DESC'))) {
                $value['description'] = constant(strtoupper($key . '_DESC'));
            }

            $content .= '<b>' . $value['title'] . '</b>';
            if (!empty($value['description'])) {
                $content .= '<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="' . $value['description'] . '"></i>';
            }
            if($key == 'MODULE_SHIPPING_NWPOSHTANEW_API_KEY' && empty($value['description'])) {
                $content .= '<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="' . MODULE_SHIPPING_NWPOSHTANEW_API_KEY_DESCRIPTION . '"></i>';
            }


                if ($value['set_function']) {
                eval('$content .= ' . stripcslashes($value['set_function']) . "'" . stripcslashes($value['value']) . "', '" . $key . "');");
            } else {
                $content .= tep_draw_input_field(
                    'configuration[' . $key . ']',
                    stripcslashes($value['value']),
                    'class="form-control"'
                );
            }

            $content .= '<br>';
        }
        //remove br
        $content = substr($content, 0, strrpos($content, '<br>'));

        if ($module_type == 'shipping') {
            //get shipToPay tab content
            $ship2pay->query(['search' => ['shipment' => $file], 'perPage' => '100', 'shipping' => false]);
            $zones = $ship2pay->data['option']['zones_id'];
            $payment_modules = $ship2pay->data['option']['payments_allowed'];

            $shipToPayContent = '';
            foreach ($ship2pay->data['data'] as $key => $shipToPay) {
                $shipToPayContent .= drawShipToPayContent($zones, $payment_modules, $key, $shipToPay, false);
            }

            //draw shipToPay and shipToFields tabs
            $content = '<div data-lang="shipping" class="active">
                                    ' . $content . '
                                </div>
                                <div data-lang="shipToPay">
                                    <input type="text" name="shipment" value="' . $file . '" class="hidden">
                                    <table id="ship2pay_table">
                                        <tr class="module_model_ship2pay_row">
                                            <td class="col-sm-4">
                                                <b class="module_model_ship2pay_text">' . addDoubleDot(TABLE_HEADING_ZONE) . '</b>
                                            </td>
                                            <td class="col-sm-4">
                                                <b class="module_model_ship2pay_text">' . addDoubleDot(TABLE_HEADING_PAYMENTS) . '</b>
                                            </td>
                                            <td class="col-sm-2">
                                                <b class="module_model_ship2pay_text">' . addDoubleDot(TABLE_HEADING_STATUS) . '</b>
                                            </td>
                                            <td class="col-sm-2">
                                                <b class="module_model_ship2pay_text">' . addDoubleDot(TABLE_HEADING_ACTION) . '</b>
                                            </td>
                                        </tr>
                                        ' . $shipToPayContent . '
                                    </table>
                                    <div class="shippingButtonBox">
                                        <button type="button" class="btn btn-orders-success add_ship2pay" data-action="new_ship2pay" data-href="/admin/modules.php" data-target="#ship2pay_table" style="background-color: white;">
                                            <svg width="30px" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="#18bf49" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm144 276c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92h-92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z" class=""></path></svg>
                                        </button>
                                    </div>
                                </div>';
        }

        //add form
        $content = tep_draw_form('modules', FILENAME_MODULES, 'set=' . $module_type . '&module=' . $_GET['module'] . '&action=' . $action) . $content . '</form>';

        if ($module_type == 'shipping') {
            //get shipToFields tab content
            $shippingFieldContent = "<script>
                            var lang = " . $ship2fields->getTranslation() . ";
                            var module = '" . $_GET['module'] . "';
                            if ($('#own_pagination').length != 0) {
                                   renderData('show&module=' + module);
                                   $('#own_pagination').pagination('selectPage', option.page);
                            }
                            </script>";
            $shippingFieldContent .= $ship2fields->getView(null, $ship2fields->data);

            $content .= '<div data-lang="shipToFields">
                                    <div id="shipToFields">
                                        ' . $shippingFieldContent . '
                                    </div>
                                </div>';

            //add tabs
            $content = '<div class="modal_form_container">
            <ul class="shipping_tab nav nav-tabs" id="lang">
                <li class="active"><a href="#shipping" data-lang="shipping">' . SHIPPING_TAB_TITLE . '</a></li>
                <li><a href="#shipToPay" data-lang="shipToPay">' . SHIPPING_TO_PAYMENT_TAB_TITLE . '</a></li>
                <li><a href="#shipToFields" data-lang="shipToFields">' . SHIPPING_TO_FIELDS_TAB_TITLE . '</a></li>
            </ul>' . $content . '</div>';
        }

        $contents[] = ['text' => $content];
        $params = [
            'submitButton' => ['name' => IMAGE_UPDATE, 'class' => 'ajax btn btn-info'],
            'cancelButton' => ['name' => IMAGE_CANCEL, 'class' => 'btn btn-default'],
        ];
        $box = new box; ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="<?= TEXT_CLOSE_BUTTON; ?>">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="editModalLabel"><?= $mInfo->title; ?></h4>
            </div>
            <?= $box->infoBoxModal($contents, $params); ?>
        </div>
        <?php
    }
}

//save functions:

function insertUpdateShipToPay($file)
{
    global $ship2pay;

    $result = false;
    if (!$ship2pay->checkDuplicateRows()) {
        $result = true;
        //get $defaultPaymentAllowed
        $ship2pay->query(['search' => ['shipment' => $file], 'perPage' => '100', 'shipping' => false]);
        $defaultPaymentAllowed = array_key_first($ship2pay->data['option']['payments_allowed']);

        //update edited shipment to payments (ShipToPay tab)
        $ship2pay->shippingUpdateShipToPay($defaultPaymentAllowed);

        //insert new shipment to payments (ShipToPay tab)
        $ship2pay->shippingInsertNewShipToPay($defaultPaymentAllowed);
    }

    return $result;
}

function updateModuleFieldsValues($configuration)
{
    foreach ($configuration as $key => $value) {
        if (strpos($key, '_SORT_ORDER') !== false) {
            $sort_order = $value;
        }

        if (is_array( $value )) {
            $value = implode( ", ", $value);
            //$value = preg_replace ("/, --none--/", "", $value);
        }

        tep_db_query(
        "update " .
        TABLE_CONFIGURATION . " set configuration_value = '" . tep_db_prepare_input($value) .
        "' where configuration_key = '" . $key . "'"
        );
    }
    return $sort_order ?: false;
}

function callModuleUpdateMethod($configuration, $path, $isExtModule = false)
{
    global $language, $class, $module_type, $file_extension, $module_directory;

    if (file_exists($file = $path . $class . $file_extension)) {
        if ($isExtModule) {
            includeLanguages($path . 'languages/' . $language . '/' . $class . $file_extension);
        } else {
            includeLanguages(DIR_FS_CATALOG_LANGUAGES . $language . '/modules/' . $module_type . '/' . $class . $file_extension);
        }
        include_once $file;
        $module = new $class;
        if (method_exists($module, 'update')) {
            // Initialize the Update metnod with the configuration data being passed
            $module->update($configuration);
        }
    }
}

//create ship2fields object and check ship2fields actions
require 'ship2fields.php';

require 'includes/solomono/app/models/ship2pay/ship2pay.php';
include 'includes/languages/' . $language . '/ship2pay.php';
$ship2pay = new ship2pay();

$action = (isset($_GET['action']) ? $_GET['action'] : (isset($_POST['action']) ? $_POST['action'] : ''));
if (tep_not_null($action)) {
    $file_extension = substr($PHP_SELF, strrpos($PHP_SELF, '.'));
    $class = basename($_GET['module']);
    $ext_folder_path = DIR_FS_EXT . $set . '/' . $class . '/';
    $configuration = $_POST['configuration'];
    $sort_order = '';

    switch ($action) {
        //edit
        case 'extedit':
            $file = $class . $file_extension;
            includeLanguages($ext_folder_path . 'languages/' . $language . '/' . $class . $file_extension);
            include($ext_folder_path . $class . $file_extension);
            displayEditForm($class, $file, $configuration, true);
            break;
        case 'edit':
            $file = $class . $file_extension;
            includeLanguages(DIR_FS_CATALOG_LANGUAGES . $language . '/modules/' . $module_type . '/' . $file);
            include($module_directory . $file);
            displayEditForm($class, $file, $configuration, false);
            break;
        //save
        case 'extsave':
            $result = true;
            if ($module_type == 'shipping') {
                //insert new and update edited shipment to payments (ShipToPay tab)
                $result = insertUpdateShipToPay($file);
            }

            //update module`s fields values (Shipping tab)
            $sort_order = updateModuleFieldsValues($configuration);

            //Runs the module's Update method if it exists. This allows updating install data after
            // the installation is complete. The method code needs to determine when it should run.
            callModuleUpdateMethod($configuration, $ext_folder_path, true);

            if ($sort_order) {
                sortModules($module_type, $file_extension);
            }

            $response['updated_panel'] = get_modules_page_panel_html([
                'module_code' => $_GET['module'],
                'order' => $sort_order
            ]);

            if ($result) {
                $response['modal'] = ['hide'];
            } else {
                $response['msg'] = TEXT_INFO_SHIP2PAY_ZONE_ALREADY_EXIST;
            }

            echo json_encode($response);
            break;
        case 'save':
            $result = true;
            if ($module_type == 'shipping') {
                //insert new and update edited shipment to payments (ShipToPay tab)
                $result = insertUpdateShipToPay($file);
            }

            //update module`s fields values (main tab)
            $sort_order = updateModuleFieldsValues($configuration);

            //Runs the module's Update method if it exists. This allows updating install data after
            // the installation is complete. The method code needs to determine when it should run.
            callModuleUpdateMethod($configuration, $module_directory, false);

            if ($sort_order) {
                sortModules($module_type, $file_extension);
            }


            $response['updated_panel'] = get_modules_page_panel_html([
                'module_code' => $_GET['module'],
                'order' => $sort_order
            ]);

            if ($result) {
                $response['modal'] = ['hide'];
            } else {
                $response['msg'] = TEXT_INFO_SHIP2PAY_ZONE_ALREADY_EXIST;
            }

            echo json_encode($response);
            break;
        //install confirm
        case 'extinstallconfirm':
            if (file_exists($filePath = $ext_folder_path . $class . $file_extension)) {
                includeLanguages($ext_folder_path . 'languages/' . $language . '/' . $class . $file_extension);
                include($filePath);
                $new_const_array = array_map(function ($key) {
                    return "'$key'";
                }, call_user_func($class . '::keys'));
                $new_const_list = implode(',', $new_const_array);
                tep_db_query("DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key in ({$new_const_list})");
                call_user_func($class . '::install');
                $new_const_query = tep_db_query(
                    "SELECT configuration_value as cv, configuration_key as ck FROM " . TABLE_CONFIGURATION .
                    " WHERE configuration_key in ($new_const_list)"
                );

                while ($const = tep_db_fetch_array($new_const_query)) {
                    if (!defined($const['ck'])) {
                        define($const['ck'], $const['cv']);
                    }
                }

                sortModules($module_type, $file_extension);
            }

            echo json_encode(
                [
                    'updated_panel' => get_modules_page_panel_html(),
                    'modal' => [
                        'hide',
                    ],
                ]
            );
            break;
        case 'installconfirm':
            $class_new = basename($_GET['module']);
            if (file_exists($module_directory . $class_new . $file_extension)) {
                includeLanguages(
                    DIR_FS_CATALOG_LANGUAGES . $language . '/modules/' . $module_type . '/' . $class_new . $file_extension
                );
                include($module_directory . $class_new . $file_extension);
                $new_const_array = array_map(function ($key) {
                    return "'$key'";
                }, call_user_func($class_new . '::keys'));
                $new_const_list = implode(',', $new_const_array);
                if(!empty($new_const_list)){
                    tep_db_query("DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key in ({$new_const_list})");
                    call_user_func($class_new . '::install');
                    $new_const_query = tep_db_query(
                        "SELECT configuration_value as cv, configuration_key as ck FROM " . TABLE_CONFIGURATION .
                        " WHERE configuration_key in ($new_const_list)"
                    );
                    while ($const = tep_db_fetch_array($new_const_query)) {
                        if ( !defined($const['ck'])) {
                            define($const['ck'], $const['cv']);
                        }
                    }
                }
                sortModules($module_type, $file_extension);
            }

            echo json_encode([
                'updated_panel' => get_modules_page_panel_html(),
                'modal' => [
                    'hide',
                ],
            ]);
            break;
        //install
        case 'extinstall':
            if (file_exists($filePath = $ext_folder_path . $class . $file_extension)) {
                $definedConst = get_defined_constants(true)['user'] ?: [];
                includeLanguages($ext_folder_path . 'languages/' . $language . '/' . $class . $file_extension);
                $newDefinedConst = get_defined_constants(true)['user'];
                $diff = array_diff_key($newDefinedConst, $definedConst);
                $module_title = reset($diff);
                include($filePath);
            }
            ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="<?= TEXT_CLOSE_BUTTON; ?>">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="ajaxModalLabel">
                        <?= !empty($module_title) ? $module_title : HEADING_TITLE; ?>
                    </h4>
                </div>
                <div class="modal-body">
                    <form
                            method="post"
                            action="<?= tep_href_link(
                                FILENAME_MODULES,
                                tep_get_all_get_params(['action']) . 'action=extinstallconfirm', 'NONSSL'
                            ); ?>"
                    >
                        <p class="text-center m-b-none"><?= TEXT_INSTALL_INTRO; ?></p>

                </div>
                <div class="modal-footer">
                    <button class="ajax btn btn-success"><?= TEXT_MODAL_INSTALL_ACTION ?></button>
                    <button class="btn btn-default" data-dismiss="modal"><?= TEXT_MODAL_CANCEL_ACTION; ?></button>
                </div>
                </form>
            </div>
            <?php
            break;
        case 'install':
            $class = basename($_GET['module']);
            if (file_exists($module_directory . $class . $file_extension)) {
                $definedConst = get_defined_constants(true)['user'] ?: [];
                includeLanguages(DIR_FS_CATALOG_LANGUAGES . $language . '/modules/' . $module_type . '/' . $class . $file_extension);
                $newDefinedConst = get_defined_constants(true)['user'];
                $diff = array_diff_key($newDefinedConst, $definedConst);
                $module_title = reset($diff);
                include($module_directory . $class . $file_extension);
            }
            ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="<?= TEXT_CLOSE_BUTTON; ?>">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="ajaxModalLabel">
                        <?= !empty($module_title) ? $module_title : HEADING_TITLE; ?>
                    </h4>
                </div>
                <div class="modal-body">
                    <form action="<?= tep_href_link(FILENAME_MODULES,
                        tep_get_all_get_params(['action']) . 'action=installconfirm', 'NONSSL'); ?>" method="post">
                        <p class="text-center m-b-none"><?= TEXT_INSTALL_INTRO; ?></p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="ajax btn btn-success"><?= TEXT_MODAL_INSTALL_ACTION ?></button>
                    <button class="btn btn-default"
                            data-dismiss="modal"><?= TEXT_MODAL_CANCEL_ACTION; ?></button>
                </div>
            </div>
            <?php
            break;
        //confirm
        case 'extconfirm':
            if (file_exists($file = $ext_folder_path . $class . $file_extension)) {
                includeLanguages($ext_folder_path . 'languages/' . $language . '/' . $class . $file_extension);
                include($file);
                $module = new $class;
            } ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="<?= TEXT_CLOSE_BUTTON; ?>">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"
                        id="ajaxModalLabel"><?= !empty($module->title) ? $module->title : HEADING_TITLE; ?></h4>
                </div>
                <div class="modal-body">
                    <form
                            action="<?= tep_href_link(
                                FILENAME_MODULES,
                                tep_get_all_get_params(['action']) . 'action=extdeleteconfirm', 'NONSSL'
                            ); ?>"
                            method="post"
                    >
                        <input type="text" hidden value="<?= $class; ?>" name="module">
                        <p class="text-center m-b-none"><?= TEXT_DELETE_INTRO; ?></p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="ajax btn btn-danger"><?= TEXT_MODAL_DELETE_ACTION; ?></button>
                    <button class="btn btn-default" data-dismiss="modal">
                        <?= TEXT_MODAL_CANCEL_ACTION; ?>
                    </button>
                </div>
            </div>
            <?php
            break;
        case 'confirm':
            if (file_exists($module_directory . $class . $file_extension)) {
                includeLanguages(
                    DIR_FS_CATALOG_LANGUAGES . $language . '/modules/' . $module_type . '/' . $class . $file_extension
                );
                include($module_directory . $class . $file_extension);
                $module = new $class;
            } ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="<?= TEXT_CLOSE_BUTTON; ?>">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="ajaxModalLabel">
                        <?= !empty($module->title) ? $module->title : HEADING_TITLE; ?>
                    </h4>
                </div>
                <div class="modal-body">
                    <form action="<?= tep_href_link(FILENAME_MODULES,
                        tep_get_all_get_params(['action']) . 'action=deleteconfirm', 'NONSSL'); ?>" method="post">
                        <input type="text" hidden value="<?= $class; ?>" name="module">
                        <p class="text-center m-b-none"><?= TEXT_DELETE_INTRO; ?></p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="ajax btn btn-danger"><?= TEXT_MODAL_DELETE_ACTION; ?></button>
                    <button class="btn btn-default" data-dismiss="modal"><?= TEXT_MODAL_CANCEL_ACTION; ?></button>
                </div>
            </div>
            <?php
            break;
        //delete confirm
        case 'extdeleteconfirm':
            if (file_exists($file = $ext_folder_path . $class . $file_extension)) {
                includeLanguages(
                    $ext_folder_path . 'languages/' . $language . '/' . $class . $file_extension
                );
                include($file);
                $module_remove = new $class;
                $module_remove->remove();
                tep_db_query(
                    "UPDATE " . TABLE_CONFIGURATION .
                    " SET configuration_value = REPLACE(configuration_value, ';" . $class .
                    $file_extension . "', '') WHERE configuration_key = 'MODULE_" .
                    strtoupper($module_type) . "_INSTALLED'"
                );
            }

            echo json_encode(
                [
                    'updated_panel' => get_modules_page_panel_html(),
                    'modal' => [
                        'hide',
                    ],
                ]
            );
            break;
        case 'deleteconfirm':
            if (file_exists($module_directory . $class . $file_extension)) {
                includeLanguages(
                    DIR_FS_CATALOG_LANGUAGES . $language . '/modules/' . $module_type . '/' . $class . $file_extension
                );
                include($module_directory . $class . $file_extension);
                $module_remove = new $class;
                $module_remove->remove();
                tep_db_query(
                    "UPDATE " . TABLE_CONFIGURATION .
                    " SET configuration_value = REPLACE(configuration_value, ';" . $class . $file_extension . "', '') 
                    WHERE configuration_key = 'MODULE_" . strtoupper($module_type) . "_INSTALLED'"
                );
            }

            echo json_encode(
                [
                    'updated_panel' => get_modules_page_panel_html(),
                    'modal' => [
                        'hide',
                    ],
                ]
            );
            break;
        //new
        case 'new_ship2pay':
            $file = $class . $file_extension;
            $ship2pay->query(['search' => ['shipment' => $file], 'perPage' => '100', 'shipping' => false]);
            $zones = $ship2pay->data['option']['zones_id'];
            $payment_modules = $ship2pay->data['option']['payments_allowed'];
            $key = tep_rand();

            $shipToPayContent = drawShipToPayContent($zones, $payment_modules, $key, [], true);

            echo json_encode([
                'html' => $shipToPayContent
            ]);
            exit;
    }

    exit;
}
/**
 * header
 */
include_once('html-open.php');
include_once('header.php');
?>
<div class="modal fade" id="ajaxModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
    <div class="modal-dialog modal-lg" role="document">
    </div>
</div>
<!-- content -->
<div class="container app-content-body p-b-none">
    <div class="hbox hbox-auto-xs hbox-auto-sm">
        <!-- main -->
        <div class="col">
            <div class="wrapper-md wrapper_767">
                <div class="bg-light lter ng-scope">
                    <h1 class="m-n font-thin h3">
                        <?= defined('HEADING_TITLE') ? HEADING_TITLE : ''; ?>
                    </h1>
                </div>
            </div>
            <div class="wrapper-md wrapper_767">
                <?= get_modules_page_panel_html(); ?>
            </div>
        </div>
    </div>
</div>
<script>
    var hash = window.location.href.split('#') ? window.location.href.split('#')[1] : false;
    //remove url params on close modal (main modal, with tabs)
    $('#ajaxModal').on('hidden.bs.modal', function () {
        var url = new URL(window.location);
        //drop hash
        hash = '';
        url.hash = '';
        //drop url params
        var search_params = url.searchParams;
        search_params.delete('module');
        search_params.delete('page');
        search_params.delete('perPage');
        //change with page reload
        window.location.href = url.toString();
        //change without page reload
        // history.pushState(null, null, url.toString());
    });
    //open modal on reload
    <?php if (isset($_GET['module'])) { ?>
    setTimeout(function () {
        $('a.ajax-modal[href*="module=<?= $_GET['module']; ?>&action=edit"]').trigger('click');
    }, 500);
    <?php } ?>
    //scripts for shipping modules page
    <?php if ($_GET['set'] == 'shipping') { ?>
    $('#ajaxModal').on('shown.bs.modal', function () {
        if (typeof module !== 'undefined' && module && window.location.href.indexOf('module=') == -1) {
            history.pushState(null, null, window.location.href + '&module=' + module);
        }
        $(this).find('ul#lang>li').on('click', changeLang);
        if(hash){
            history.pushState(null, null, window.location.href + '#' + hash);
            $('ul#lang>li>a[data-lang="' + hash + '"]').trigger('click');
        }else{
            $('ul#lang>li.active>a').trigger('click');
        }
    });

    $(document).on('click','.add_ship2pay',function () {
        var $this = $(this);
        var href = $this.data('href');
        var action = $this.data('action');
        var target = $this.data('target');

        $.ajax({
            url: href,
            type: "POST",
            data: {action: action},
            dataType: 'json',
            success: function (response) {
                $(target).append(response.html);
            }
        });
    });

    $(document).on('click','[data-action="delete_ship2pay"]',function () {
        var $this = $(this);
        var href = $this.data('href');
        var id = $this.data('id');
        var action = $this.data('action');

        $this.closest('tr').remove();

        if(typeof id != 'undefined'){
            $.ajax({
                url: href,
                type: "POST",
                data: {id: id, action: action},
                dataType: 'json'
            });
        }

    });

    $(document).on('click','[data-action="update_novaposhta_warehouses"]',function () {
        var $this = $(this);
        var href = $this.data('href');
        var api_key = $this.parents('form').find('[name="configuration[MODULE_SHIPPING_NWPOSHTANEW_API_KEY]"]').val();
        var action = $this.data('action');
        if(typeof api_key == undefined || api_key.trim() == ''){
            alert('API Key is required');
            return false;
        }
        $.ajax({
            url: href,
            type: "POST",
            data: {api_key: api_key, action: action},
            dataType: 'json',
            beforeSend: function () {
                show_tooltip('<span style="font-size: 5em;" class="ajax-loader"></span>', 99999);
            },
            success: function (response) {
                $('.tooltip_own').remove();
                if (response.success == true) {
                    show_tooltip(response.msg, 99999);
                } else {
                    show_tooltip(response.msg, 99999, $('body'), true);
                }
            }

        });

    });

    $(document).on('click','[data-action="update_novaposhta_areas"]',function () {
        var $this = $(this);
        var href = $this.data('href');
        var api_key = $this.parents('form').find('[name="configuration[MODULE_SHIPPING_NWPOSHTANEW_API_KEY]"]').val();
        var action = $this.data('action');
        if(typeof api_key == undefined || api_key.trim() == ''){
            alert('API Key is required');
            return false;
        }
        $.ajax({
            url: href,
            type: "POST",
            data: {api_key: api_key, action: action},
            dataType: 'json',
            beforeSend: function () {
                show_tooltip('<span style="font-size: 5em;" class="ajax-loader"></span>', 99999);
            },
            success: function (response) {
                $('.tooltip_own').remove();
                if (response.success == true) {
                    show_tooltip(response.msg, 99999);
                } else {
                    show_tooltip(response.msg, 99999, $('body'), true);
                }
            }

        });

    });

    $(document).on('click','[data-action="update_novaposhta_cities"]',function () {
        var $this = $(this);
        var href = $this.data('href');
        var api_key = $this.parents('form').find('[name="configuration[MODULE_SHIPPING_NWPOSHTANEW_API_KEY]"]').val();
        var action = $this.data('action');
        if(typeof api_key == undefined || api_key.trim() == ''){
            alert('API Key is required');
            return false;
        }
        $.ajax({
            url: href,
            type: "POST",
            data: {api_key: api_key, action: action},
            dataType: 'json',
            beforeSend: function () {
                show_tooltip('<span style="font-size: 5em;" class="ajax-loader"></span>', 99999);
            },
            success: function (response) {
                $('.tooltip_own').remove();
                if (response.success == true) {
                    show_tooltip(response.msg, 99999);
                } else {
                    show_tooltip(response.msg, 99999, $('body'), true);
                }
            }

        });

    });

    $(document).on('click','[data-action="update_novaposhta_references"]',function () {
        var $this = $(this);
        var href = $this.data('href');
        var api_key = $this.parents('form').find('[name="configuration[MODULE_SHIPPING_NWPOSHTANEW_API_KEY]"]').val();
        var action = $this.data('action');
        if(typeof api_key == undefined || api_key.trim() == ''){
            alert('API Key is required');
            return false;
        }
        $.ajax({
            url: href,
            type: "POST",
            data: {api_key: api_key, action: action},
            dataType: 'json',
            beforeSend: function () {
                show_tooltip('<span style="font-size: 5em;" class="ajax-loader"></span>', 99999);
            },
            success: function (response) {
                $('.tooltip_own').remove();
                if (response.success == true) {
                    show_tooltip(response.msg, 99999);
                } else {
                    show_tooltip(response.msg, 99999, $('body'), true);
                }
            }

        });

    });
    <?php } ?>
</script>
<!-- /content -->
<?php
include_once('footer.php');
include_once('html-close.php');

/**
 * @param string $path
 * @param bool $isExt
 * @param string $file_extension
 * @return array
 */
function getDirectories($path, $isExt, $file_extension)
{
    $directories = [];
    if (is_dir($path) && $dir = @dir($path)) {
        while ($file = $dir->read()) {
            if ($isExt) {
                if (!is_dir(($p = $path . $file . '/') . $file) && $file !== 'example') {
                    array_push($directories, [
                        'path' => $p,
                        'file' => $file . $file_extension,
                        'class' => $file,
                        'isSet' => (bool)is_file($p . $file . $file_extension)
                    ]);
                }
            } else {
                if (!is_dir($path . $file)) {
                    if (substr($file, strrpos($file, '.')) == $file_extension) {
                        $directories[] = $file;
                    }
                }
            }
        }

        sort($directories);
        $dir->close();
    }

    return $directories;
}

/**
 * @return array
 */
function getInstaledModules()
{
    $modules_check_query = tep_db_query(
        "SELECT  
            GROUP_CONCAT(configuration_value SEPARATOR ';') AS modules
        FROM 
            `configuration`
        WHERE 
            configuration_key LIKE 'MODULE_%_INSTALLED'"
    );
    return explode(';', tep_db_fetch_array($modules_check_query)['modules']);
}

/**
 * @param string $mod
 * @return array|mixed
 */
function getAllApiModules($mod)
{
    $res = [];
    if ($mod) {
        removeCache($mod);
        $res = getCache($mod);
        if (empty($res)) {
            $json = file_get_contents(API_MODULES_ADDRESS . '?mod=' . $mod);
            $res = json_decode($json);
            setCache($mod, $json);
        }
    }

    return $res;
}

/**
 * @param string $set
 * @return mixed
 */
function getCache($set)
{
    $modules_check_query = tep_db_query(
        "SELECT cache_data FROM " . TABLE_CACHE .
        " WHERE cache_id = '" . $set . "' AND cache_expires > NOW() AND cache_language_id = 1"
    );

    return json_decode(tep_db_fetch_array($modules_check_query)['cache_data']);
}

/**
 * @param string $set
 */
function removeCache($set)
{
    tep_db_query(
        "DELETE FROM " . TABLE_CACHE .
        " WHERE cache_id = '" . $set . "' AND cache_language_id = 1 AND cache_expires < NOW()"
    );
}

/**
 * @param string $set
 * @param string $json
 */
function setCache($set, $json)
{
    tep_db_query("INSERT INTO " . TABLE_CACHE . "
        (
            `cache_id`, 
            `cache_language_id`, 
            `cache_name`, 
            `cache_data`, 
            `cache_global`, 
            `cache_gzip`, 
            `cache_method`, 
            `cache_date`, 
            `cache_expires`
        ) 
        VALUES 
        ('" . $set . "', '1','" . $set . "' , '" . $json . "', 0, 0, '', NOW(), NOW() + INTERVAL 1 DAY) 
        ON DUPLICATE KEY UPDATE `cache_data` = '" . $json . "', `cache_date` = NOW(), `cache_expires` = NOW() + INTERVAL 1 DAY");
}

/**
 * Создает html панели страницы "Модули"
 * @return string - готовый html панели страницы "Модули"
 */
function get_modules_page_panel_html($params = [])
{
    global $language;
    global $module_directory;
    global $PHP_SELF;
    global $module_type;
    global $module_key;
    global $set;
    global $admin_check;

    ob_start();
    $methodClass = $_GET['set'] == 'payment' ? 'payment' : 'shipping';
    $isPayment = $_GET['set'] == 'payment';
    ?>
    <div class="panel panel-default">
        <table
                class="
                table
                table-bordered
                table-hover
                table-condensed
                bg-white-only
                b-t
                b-light
                <?= $methodClass ?>_modules"
        >
            <thead>
            <tr>
                <th class="v-middle"><?= TABLE_HEADING_MODULES; ?></th>
                <?php if ($isPayment) { ?>
                    <th class="text-center v-middle payment_module_description"><?= TABLE_HEADING_MODULE_DESCRIPTION; ?>
                    </th>
                <?php } ?>
                <th class="text-center v-middle"><?= TABLE_HEADING_SORT_ORDER; ?></th>
                <th class="text-center v-middle"><?= TABLE_HEADING_ACTION; ?>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <?php
            include_once $module_directory . '../../classes/Traits/EmptyPaymentMethod.php';
            $file_extension = substr($PHP_SELF, strrpos($PHP_SELF, '.'));
            $directory_array = getDirectories($module_directory, false, $file_extension);
            $remoteModules = getAllApiModules($set);
            $installed_modules = [];
            $inst_modules = getInstaledModules();
            if ($set) {
                $directory_ext_array = getDirectories(DIR_FS_EXT . $set . '/', true, $file_extension);
            }

            //Модули в папке includes/modules/shipping/moduleName/*.php
            foreach ($directory_array as $i => $directory_arr) {
                $file = $directory_arr;
                $class = substr($file, 0, strrpos($file, '.'));
                if (in_array($file, $inst_modules)) {
                    includeLanguages(DIR_FS_CATALOG_LANGUAGES . $language . '/modules/' . $module_type . '/' . $file);
                    include_once($module_directory . $file);
                    if (tep_class_exists($class)) {
                        $admin_check = true; // for some modules like customshipper.php
                        $module = new $class;
                        if (is_null($module->code) && isset($module->isBuy) && $module->isBuy) {
                            $installed_modules[$i]['isBuy'] = $module->isBuy;
                            $installed_modules[$i]['link'] = $module->link;
                        }

                        if ($params['module_code'] == $module->code) {
                            $installed_modules[$i]['file'] = $file;
                            $installed_modules[$i]['order'] = $params['order'];
                        } else {
                            $installed_modules[$i]['file'] = $file;
                            $installed_modules[$i]['order'] = $module->sort_order;
                        }

                        if (in_array($module->enabled, ['True', 'true', true, 1]) and $module->check() > 0) {
                            $installed_modules[$i]['enabled'] = 1;
                        } else {
                            $installed_modules[$i]['enabled'] = 0;
                        }

                        $installed_modules[$i]['title'] = $module->title;
                        $installed_modules[$i]['description'] = $module->description;
                        $installed_modules[$i]['sort_order'] = $module->sort_order;
                        $installed_modules[$i]['check'] = $module->check();
                        $installed_modules[$i]['code'] = $module->code;
                    }
                } else {
                    $definedConst = get_defined_constants(true)['user'] ?: [];
                    includeLanguages(DIR_FS_CATALOG_LANGUAGES . $language . '/modules/' . $module_type . '/' . $file);
                    $newDefinedConst = get_defined_constants(true)['user'];
                    $diff_keys = array_diff_key($newDefinedConst, $definedConst);
                    $moduleTitle = reset($diff_keys);
                    include_once($module_directory . $file);
                    unset($module);
                    if ($moduleTitle == '') {
                        $module = new $class;
                        $moduleTitle = $module->title;
                    } elseif (method_exists($class, 'isEmptyPaymentMethod')) {
                        $module = new $class;
                    }

                    if (is_null($module->code) && isset($module->isBuy) && $module->isBuy) {
                        $installed_modules[$i]['isBuy'] = $module->isBuy;
                        $installed_modules[$i]['link'] = $module->link;
                        $installed_modules[$i]['code'] = null;
                    } else {
                        $installed_modules[$i]['code'] = $class;
                    }

                    $installed_modules[$i]['title'] = $moduleTitle;
                    $installed_modules[$i]['enabled'] = 0;
                    $installed_modules[$i]['description'] = "";
                    $installed_modules[$i]['file'] = $file;
                    $installed_modules[$i]['sort_order'] = 0;
                    $installed_modules[$i]['order'] = 0;
                    $installed_modules[$i]['check'] = 0;
                }
            }

            //Модули в папке ext/shipping/*
            foreach ($directory_ext_array as $ext_array) {
                if (in_array($ext_array['file'], $inst_modules)) {
                    includeLanguages($ext_array['path'] . 'languages/' . $language . '/' . $ext_array['file']);
                    $class = $ext_array['class'];
                    $admin_check = true; // for some modules like customshipper.php
                    include_once($ext_array['path'] . $ext_array['file']);
                    if (tep_class_exists($class)) {
                        $module = new $class;
                        $enabled = 0;
                        if ((in_array($module->enabled, ['True', 'true', true, 1])) and $module->check() > 0) {
                            $enabled = 1;
                        }

                        array_push($installed_modules, [
                            'file' => $ext_array['file'],
                            'order' => $params['module_code'] == $module->code ? $params['order'] : $module->sort_order,
                            'title' => $module->title,
                            'enabled' => $enabled,
                            'description' => $module->description,
                            'sort_order' => $module->sort_order,
                            'check' => $module->check(),
                            'isBuy' => !$ext_array['isSet'],
                            'code' => $module->code
                        ]);
                    }
                } else {
                    if (is_file($ext_array['path'] . $ext_array['file'])) {
                        includeLanguages($ext_array['path'] . 'languages/' . $language . '/' . $ext_array['file']);
                        $title = getConstantValue('MODULE_SHIPPING_' . strtoupper($ext_array['class']) . '_TEXT_TITLE');
                        array_push($installed_modules, [
                            'title' => $title,
                            'enabled' => 0,
                            'description' => '',
                            'sort_order' => 0,
                            'order' => 0,
                            'check' => 0,
                            'isBuy' => !$ext_array['isSet'],
                            'code' => $ext_array['class']
                        ]);
                    }
                }
            }

            //Модули из удалённого сервера*
            if (isset($remoteModules->response->status) && $remoteModules->response->status === 200) {
                foreach ($remoteModules->response->list as $code => $module) {
                    $code = explode('/', $code)[1];
                    if (!(bool)is_file(DIR_FS_EXT . $set . '/' . $code . '/' . $code . $file_extension)) {
                        $modTitle = $module->name->en;
                        $modLink = $module->link->en;
                        if (isset($module->name->{$_SESSION['languages_code']})) {
                            $modTitle = $module->name->{$_SESSION['languages_code']};
                        }

                        if (isset($module->name->{$_SESSION['languages_code']})) {
                            $modLink = $module->link->{$_SESSION['languages_code']};
                        }

                        array_push($installed_modules, [
                            'title' => $modTitle,
                            'enabled' => 0,
                            'description' => html_entity_decode(htmlspecialchars_decode($module->products_description)),
                            'sort_order' => 0,
                            'order' => 0,
                            'check' => 0,
                            'link' => $modLink,
                            'isBuy' => true,
                            'code' => $code
                        ]);
                    }
                }
            }
            // sort by two columns: "enabled" and "order"
            array_multisort(
                array_column($installed_modules, 'enabled'),
                SORT_DESC,
                array_column($installed_modules, 'order'),
                SORT_ASC,
                $installed_modules
            );

            foreach ($installed_modules as $module) {
                if ($module['enabled']) {
                    $installed_enabled_modules[] = $module['file'];
                } ?>
                <tr <?= ($module['enabled'] == 1) ? '' : 'style="opacity:0.5;"'; ?>>
                    <td data-label="<?= addDoubleDot(TABLE_HEADING_MODULES); ?>" class="col-name-title_<?= $methodClass ?> col-name-module_title">
                        <?= $module['title']; ?>
                    </td>
                    <?php if ($isPayment) { ?>
                        <td data-label="<?= addDoubleDot(TABLE_HEADING_MODULE_DESCRIPTION); ?>" class="value_payment_module_description col-name-module_description">
                            <?= $module['description']; ?>
                        </td>
                    <?php } ?>
                    <td data-label="<?= addDoubleDot(TABLE_HEADING_SORT_ORDER); ?>" class="text-center v-middle col-name-sort_order">
                        <?php
                        if (is_numeric($module['sort_order'])) {
                            echo $module['sort_order'];
                        }
                        ?>
                    </td>
                    <td data-label="<?= addDoubleDot(TABLE_HEADING_ACTION); ?>" class="text-center v-middle">
                        <?php
                        if ($module['check'] == '1') {
                            $actionEdit = 'edit';
                            $actionConfirm = 'confirm';
                            if (isset($module['isBuy'])) {
                                $actionEdit = 'extedit';
                                $actionConfirm = 'extconfirm';
                            }

                            echo '<a 
                                    class="ajax-modal btn-link btn-link-icon"
                                    data-toggle="tooltip" 
                                    data-placement="right" 
                                    title="' . IMAGE_EDIT . '" 
                                    data-original-title="' . IMAGE_EDIT . '"
                                    href="' . tep_href_link(
                                        FILENAME_MODULES,
                                        'set=' . $set . '&module=' . $module['code'] . '&action=' . $actionEdit
                                    ) . '"
                                >
                                    <i class="fa fa-pencil"></i>
                                </a>',
                                '<a 
                                    class="ajax-modal m-l-sm btn-link btn-link-icon"
                                    data-toggle="tooltip" 
                                    data-placement="right" 
                                    title="' . IMAGE_MODULE_REMOVE . '" 
                                    data-original-title="' . IMAGE_MODULE_REMOVE . '"
                                    href="' . tep_href_link(
                                    FILENAME_MODULES,
                                    'set=' . $set . '&module=' . $module['code'] . '&action=' . $actionConfirm
                                ) . '"
                                >
                                    <i class="fa fa-trash-o"></i>
                                </a>';
                        } else {
                            if (isset($module['isBuy']) && $module['isBuy']) {
                                if (!$module['code']) {
                                    $title = mb_convert_case(
                                        TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON,
                                        MB_CASE_TITLE,
                                        'UTF-8'
                                    );
                                } else {
                                    $title = ADMIN_BTN_BUY_MODULE;
                                }

                                echo '<a
                                    class="btn-link btn-link-icon"
                                    href="' . $module['link'] . '"
                                    title="' . $title . '" 
                                >
                                    <i class="fa fa-shopping-cart text-base"></i>
                                </a>';
                            } else {
                                $action = 'install';
                                if (isset($module['isBuy']) && !$module['isBuy']) {
                                    $action = 'extinstall';
                                }

                                echo '<a 
                                    class="ajax-modal btn-link btn-link-icon"
                                    href="' . tep_href_link(
                                        FILENAME_MODULES,
                                        'set=' . $set . '&module=' . $module['code'] . '&action=' . $action
                                    ) . '"
                                    data-toggle="tooltip" data-placement="right" 
                                    title="' . IMAGE_MODULE_INSTALL . '"
                                    data-original-title="' . IMAGE_MODULE_INSTALL . '"
                                >
                                    <i class="fa fa-plus text-base"></i>
                                </a>';
                            }
                        }
                        ?>
                    </td>
                </tr>
                <?php
            }

            //$installed_modules = array_column($installed_modules, 'file');
            $installed_modules = $installed_enabled_modules ?: [];
            $check_query = tep_db_query(
                "SELECT `configuration_value` FROM " . TABLE_CONFIGURATION .
                " WHERE `configuration_key` = '" . $module_key . "'"
            );
            if (tep_db_num_rows($check_query)) {
                $check = tep_db_fetch_array($check_query);
                if ($check['configuration_value'] != implode(';', $installed_modules)) {
                    //tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '" . implode(';', $installed_modules) . "', last_modified = now() where configuration_key = '" . $module_key . "'");
                }
            } else {
                tep_db_query(
                    "insert into " . TABLE_CONFIGURATION . " 
                    (
                        configuration_title, 
                        configuration_key, 
                        configuration_value, 
                        configuration_description, 
                        configuration_group_id, 
                        sort_order, 
                        date_added
                    ) 
                    values 
                    (
                        'Installed Modules', 
                        '" . $module_key . "', 
                        '" . implode(';', $installed_modules) . "', 
                        'This is automatically updated. No need to edit.', 
                        '6', 
                        '0', 
                        now()
                    )"
                );
            } ?>
            </tbody>
        </table>
        <!--    </div>-->
        <!--
    <footer class="panel-footer">
      <div class="row m-b">
        <div class="col-sm-12 text-xs">
          <?php echo TEXT_MODULE_DIRECTORY . ' ' . $module_directory; ?>
        </div>
    </footer>  -->
    </div>
    <?php
    $html = ob_get_contents();
    ob_end_clean();
    return $html;
}

require(DIR_WS_INCLUDES . 'application_bottom.php');
