<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 14.06.2017
 * Time: 15:22
 */

namespace admin\includes\solomono\app\models\ship2pay;

use admin\includes\solomono\app\core\Model;

include_once(DIR_ROOT . '/' . DIR_WS_CLASSES . 'seo.class.php');

class ship2pay extends Model
{

    protected $allowed_fields = [
        'shipment' => [
            'label' => TABLE_HEADING_SHIPMENT,
            'show' => true,
            'type' => 'select',
            'option' => '',
            'sort' => true,
            'filter' => true
        ],
        'geo_zone_name' => [
            'label' => TABLE_HEADING_ZONE,
        ],
        'zones_id' => [
            'label' => TABLE_HEADING_ZONE,
            'type' => 'select',
            'show' => false,
            'option' => [
                'table' => 'geo_zones',
                'id' => 'geo_zone_id',
                'title' => 'geo_zone_name'
            ]
        ],
        'payments_allowed' => [
            'label' => TABLE_HEADING_PAYMENTS,
            'show' => true,
            'type' => 'select',
            'params' => 'multiple  size=7',
            'option' => '',
            'sort' => true,
            'filter' => true
        ],
        'status' => [
            'label' => TABLE_HEADING_STATUS,
        ],

    ];

    protected $prefix_id = 's2p_id';

    //protected $table='salemaker_sales';

    public function select()
    {
        $sql = "select s2p.s2p_id as id, 
                s2p.shipment, 
                s2p.payments_allowed, 
                s2p.zones_id, 
				gz.geo_zone_name,	
                s2p.`status` 
				from " . TABLE_SHIP2PAY . " s2p
                left join " . TABLE_GEO_ZONES . " gz on gz.geo_zone_id = s2p.zones_id";
        return $sql;
    }

    public function query($request)
    {
        parent::query($request);
        $this->getPaymentOptions();
        if (!isset($request['shipping']) || $request['shipping'] != false) {
            $this->getShippingOptions();
        }
        $this->getOptions();
        $this->prepareAllowFields();
    }

    public function getOptions()
    {
        foreach ($this->allowed_fields as $field_name => &$value) {
            if (isset($value['option'])) {
                if ($field_name == 'zones_id') {
                    $this->optionFields($field_name, $value['option']);
                }
            }
        }
        $this->data['option']['zones_id'][0] = '-';
        ksort($this->data['option']['zones_id']);

    }

    public function prepareAllowFields()
    {
        foreach ($this->data['data'] as &$field_names) {
            foreach ($field_names as $field_name => &$value) {
                if (isset($this->data['allowed_fields'][$field_name]['option']) && $field_name == 'shipment') {
                    $options = $this->data['option'][$field_name];
                    $value = $options[$value];
                }
                if (isset($this->data['allowed_fields'][$field_name]['option']) && $field_name == 'payments_allowed') {
                    $options = $this->data['option'][$field_name];
                    $payments_allowed = explode(';', $value);
                    $arr = [];
                    foreach ($payments_allowed as $k => $v) {
                        $arr[] = $options[$v];
                    }
                    $value = implode(', ', $arr);
                }
            }
        }
    }

    public function selectOne($id)
    {
        $sql = "select s2p.s2p_id as id, 
                s2p.shipment, 
                s2p.payments_allowed, 
                s2p.zones_id, 
                s2p.`status` 
				from " . TABLE_SHIP2PAY . " s2p
                where s2p.s2p_id = '" . $id . "'";

        if ($id) {
            $this->data['data'] = $this->getResult($sql)[0];
        }
        $this->getPaymentOptions();
        $this->getShippingOptions();
        $this->getOptions();
    }

    public function update($data)
    {
        $id = $data['id'];
        unset($data['id']);

        if (is_array($data['payments_allowed'])) {
            $data['payments_allowed'] = implode(';', array_unique($data['payments_allowed']));
        }

        $query = $this->prepareGeneralField($data);

        $sql = "INSERT INTO " . TABLE_SHIP2PAY . " SET {$query},`$this->prefix_id`='{$id}' ON DUPLICATE KEY UPDATE {$query},`$this->prefix_id`='{$id}'";
        if (!tep_db_query($sql)) {
            return false;
        }
        return true;
    }

    public function insert($data)
    {
        $id = $data['id'] ?: (tep_db_fetch_array(tep_db_query("select max({$this->prefix_id})+1 as next_id from " . TABLE_SHIP2PAY))['next_id'] ?: 1);
        unset($data['id']);
        if (is_array($data['payments_allowed'])) {
            $data['payments_allowed'] = implode(';', array_unique($data['payments_allowed']));
        }

        $query = $this->prepareGeneralField($data);

        $sql = "INSERT INTO " . TABLE_SHIP2PAY . " SET {$query},`$this->prefix_id`='{$id}'";
        if (!tep_db_query($sql)) {
            return false;
        }
        return array(
            "success" => "true",
            'id' => $id
        );
    }

    public function delete($id)
    {
        tep_db_query("DELETE FROM " . TABLE_SHIP2PAY . " WHERE `{$this->prefix_id}`={$id}");
        return true;
    }

    public function getPaymentOptions()
    {
        // set php_self in the local scope
        if (!isset($PHP_SELF)) {
            $PHP_SELF = $_SERVER['PHP_SELF'];
        }

        $module_directory = DIR_FS_CATALOG_MODULES . 'payment/';

        $file_extension = substr($PHP_SELF, strrpos($PHP_SELF, '.'));
        $directory_array = array();
        if ($dir = @dir($module_directory)) {
            while ($file = $dir->read()) {
                if (!is_dir($module_directory . $file)) {
                    if (substr($file, strrpos($file, '.')) == $file_extension) {
                        $directory_array[] = $file; // array of all the payment modules present in includes/modules/payment
                    }
                }
            }
            sort($directory_array);
            $dir->close();
        }
        $module_active = explode(";", MODULE_PAYMENT_INSTALLED);
        $installed_modules = array();
        for ($i = 0, $n = sizeof($directory_array); $i < $n; $i++) {
            $file = $directory_array[$i];
            if (in_array($directory_array[$i], $module_active)) {
                includeLanguages(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/modules/payment/' . $file);
                include($module_directory . $file);

                $class = substr($file, 0, strrpos($file, '.'));
                if (tep_class_exists($class)) {
                    $module = new $class;
                    if ($module->check() > 0) {
                        $installed_modules[$module->code . '.php'] = $module->title;
                    }
                }
            }
        }
        $this->data['option']['payments_allowed'] = $installed_modules;
        $this->data['allowed_fields']['payments_allowed']['option'] = $installed_modules;
    }

    public function getShippingOptions()
    {

        // set php_self in the local scope
        if (!isset($PHP_SELF)) {
            $PHP_SELF = $_SERVER['PHP_SELF'];
        }

        $ship_module_directory = DIR_FS_CATALOG_MODULES . 'shipping/';

        $file_extension = substr($PHP_SELF, strrpos($PHP_SELF, '.'));
        $ship_directory_array = array();
        if ($dir = @dir($ship_module_directory)) {
            while ($file = $dir->read()) {
                if (!is_dir($ship_module_directory . $file)) {
                    if (substr($file, strrpos($file, '.')) == $file_extension) {
                        $ship_directory_array[] = $file; // array of all shipping modules present in includes/modules/shipping
                    }
                }
            }
            sort($ship_directory_array);
            $dir->close();
        }

        $ship_module_active = explode(";", MODULE_SHIPPING_INSTALLED);
        $installed_shipping_modules = array();
        for ($i = 0, $n = sizeof($ship_directory_array); $i < $n; $i++) {
            $file = $ship_directory_array[$i];
            if (in_array($ship_directory_array[$i], $ship_module_active)) {
                includeLanguages(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/modules/shipping/' . $file);
                include($ship_module_directory . $file);

                $ship_class = substr($file, 0, strrpos($file, '.'));
                if (tep_class_exists($ship_class)) {
                    $ship_module = new $ship_class;
                    if ($ship_module->check() > 0) {
                        $installed_shipping_modules[$ship_module->code . '.php'] = $ship_module->title;
                    }
                }
            }
        }
        $this->data['option']['shipment'] = $installed_shipping_modules;
        $this->data['allowed_fields']['shipment']['option'] = $installed_shipping_modules;
    }

    public function checkDuplicateRows()
    {
        //collect data
        $data = array_merge(
            $_POST['new']['zones_id'] ? (is_array($_POST['new']['zones_id']) ? $_POST['new']['zones_id'] : [$_POST['new']['zones_id']]) : [],
            $_POST['zones_id'] ? (is_array($_POST['zones_id']) ? $_POST['zones_id'] : [$_POST['zones_id']]) : []
        );

        //check data duplicate
        $result = false;
        if (!empty($data) && count(array_unique($data)) < count($data)) {
            //duplicate exist
            $result = true;
        }

        return $result;
    }

    //modules page:
    public function shippingInsertNewShipToPay($defaultPaymentAllowed)
    {
        if (!empty($_POST['new']['zones_id']) && is_array($_POST['new']['zones_id'])) {
            $newId = false;
            foreach ($_POST['new']['zones_id'] as $key => $zonesId) {
                $paymentsAllowed = $_POST['new']['payments_allowed'][$key] ?: $defaultPaymentAllowed;
                $status = $_POST['new']['status'][$key] == 'on' ? 1 : 0;
                $result = $this->insert([
                    'id' => $newId,
                    'shipment' => $_POST['shipment'] ?: '',
                    'zones_id' => $zonesId,
                    'payments_allowed' => $paymentsAllowed,
                    'status' => $status
                ]);
                $newId = $result['id'] + 1;
            }
        }
    }

    public function shippingUpdateShipToPay($defaultPaymentAllowed)
    {
        if (!empty($_POST['zones_id']) && is_array($_POST['zones_id'])) {
            foreach ($_POST['zones_id'] as $key => $zonesId) {
                $ship2payId = $_POST['ship2pay_id'][$key];
                $paymentsAllowed = $_POST['payments_allowed'][$key] ?: $defaultPaymentAllowed;
                $status = $_POST['status'][$key] == 'on' ? 1 : 0;
                $this->update([
                    'id' => $ship2payId,
                    'zones_id' => $zonesId,
                    'payments_allowed' => $paymentsAllowed,
                    'status' => $status
                ]);
            }
        }
    }
}