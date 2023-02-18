<?php

use admin\includes\solomono\app\core\Model;

include_once(DIR_ROOT . '/' . DIR_WS_CLASSES . 'seo.class.php');

/**
 * Class ship2pay
 */
class ship2pay extends Model
{
    /**
     * @var array
     */
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

    /**
     * @var string
     */
    protected $prefix_id = 's2p_id';

    /**
     * @var array
     */
    protected $uniqueColumns = ['shipment','zones_id'];

    /**
     * @return string
     */
    public function select()
    {
        return
            "select s2p.s2p_id as id, s2p.shipment, s2p.payments_allowed, s2p.zones_id, gz.geo_zone_name, s2p.`status` from "
            . TABLE_SHIP2PAY . " s2p left join " . TABLE_GEO_ZONES . " gz on gz.geo_zone_id = s2p.zones_id";
    }

    /**
     * @param int $id
     */
    public function selectOne($id)
    {
        $sql = "select s2p.s2p_id as id, s2p.shipment, s2p.payments_allowed, s2p.zones_id, s2p.`status` from "
            . TABLE_SHIP2PAY . " s2p where s2p.s2p_id = " . $id;


        if ($id) {
            $this->data['data'] = $this->getResult($sql)[0];
        }

        $this->getOptionsByName('payment', MODULE_PAYMENT_INSTALLED, 'payments_allowed');
        $this->getOptionsByName('shipping', MODULE_SHIPPING_INSTALLED, 'shipment');
        $this->getOptions();
    }

    /**
     * @param $request
     * @return array|void
     */
    public function query($request)
    {
        parent::query($request);
        $this->getOptionsByName('payment', MODULE_PAYMENT_INSTALLED, 'payments_allowed');
        $this->getOptionsByName('shipping', MODULE_SHIPPING_INSTALLED, 'shipment');
        $this->getOptions();
        $this->prepareAllowFields();
    }

    /**
     * @return void
     */
    public function getOptions()
    {

        foreach ($this->allowed_fields as $field_name => $value) {
            if ($field_name === 'zones_id' && isset($value['option'])) {
                $this->optionFields($field_name, $value['option']);
            }
        }

        $this->data['option']['zones_id'][0] = '-';
        ksort($this->data['option']['zones_id']);
    }

    /**
     * @return void
     */
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

    /**
     * @param array $data
     * @return bool
     */
    public function findDuplicateRows($data)
    {
        $uniqueColumnsData = array_intersect_key($data, array_flip($this->uniqueColumns));
        $queryParams = $this->prepareGeneralField($uniqueColumnsData, ' and ');

        $id = $data[$this->prefix_id] ?: $data['id'];
        $queryParams .= !empty($id) ? " and " . $this->prefix_id . " != '" . $id . "'" : "";

        $query = tep_db_query("SELECT " . $this->prefix_id . " FROM " . TABLE_SHIP2PAY . " WHERE " . $queryParams);

        $id = false;
        if (tep_db_num_rows($query) > 0) {
            $id = tep_db_fetch_array($query)[$this->prefix_id];
        }
        return $id;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function update($data)
    {
        $id = $data[$this->prefix_id] ?: $data['id'];
        unset($data[$this->prefix_id]);
        unset($data['id']);
        $data['payments_allowed'] = is_array($data['payments_allowed']) ? implode(';', array_unique($data['payments_allowed'])) : '';
        $query = $this->prepareGeneralField($data);
        $sql = "INSERT INTO "
            . TABLE_SHIP2PAY . " SET "
            . $query . ", " . $this->prefix_id . " = " . $id
            . " ON DUPLICATE KEY UPDATE "
            . $query . ", " . $this->prefix_id . " = " . $id;

        if (!tep_db_query($sql)) {
            return false;
        }

        return true;
    }

    /**
     * @param array $data
     * @return array|bool
     */
    public function insert($data)
    {
        $q = tep_db_query('select max(' . $this->prefix_id . ')+1 as next_id from ' . TABLE_SHIP2PAY);
        $arr = tep_db_fetch_array($q);
        $id = ($data[$this->prefix_id] ?: $data['id']) ?: ($arr['next_id'] ?: 1);
        unset($data[$this->prefix_id]);
        unset($data['id']);
        $data['payments_allowed'] = is_array($data['payments_allowed']) ? implode(';', array_unique($data['payments_allowed'])) : '';
        $query = $this->prepareGeneralField($data);
        $sql = "INSERT INTO "
            . TABLE_SHIP2PAY . " SET "
            . $query . ", " . $this->prefix_id . " = " . $id
            . " ON DUPLICATE KEY UPDATE "
            . $query . ", " . $this->prefix_id . " = " . $id;
        if (!tep_db_query($sql)) {
            return false;
        }

        return [
            "success" => "true",
            'id' => $id
        ];
    }

    /**
     * @param int $id
     * @return bool|mysqli_result
     */
    public function delete($id)
    {
        tep_db_query('DELETE FROM ' . TABLE_SHIP2PAY . ' WHERE ' . $this->prefix_id . '=' . $id);
        return true;
    }

    /**
     * @param string $name
     * @param string $const
     * @param string $arrayKey
     *
     * @return void
     */
    public function getOptionsByName($name, $const, $arrayKey)
    {
        $module_directory = DIR_FS_CATALOG_MODULES . $name . '/';
        $ext_module_directory = DIR_FS_EXT . $name . '/';
        $directory_array = [];
        $this->getFilesArrayByPath($directory_array, $module_directory);
        $this->getFilesArrayByPath($directory_array, $ext_module_directory, true);
        $module_active = explode(";", $const);
        $installed_modules = [];
        foreach ($directory_array as $file) {
            if (in_array($file, $module_active)) {
                $class = pathinfo($file)['filename'];
                if (is_file($path = $module_directory . $file)) {
                    includeLanguages(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/modules/' . $name . '/' . $file);
                    include($path);
                } elseif (is_file($path = $ext_module_directory . $class . '/' . $file)) {
                    includeLanguages($ext_module_directory . $class . '/languages/' . $_SESSION['language'] . '/' . $file);
                    include($path);
                }

                if (tep_class_exists($class)) {
                    $module = new $class();
                    if ($module->check() > 0) {
                        $installed_modules[$module->code . '.php'] = $module->title;
                    }
                }
            }
        }


        $this->data['option'][$arrayKey] = $installed_modules;
        $this->data['allowed_fields'][$arrayKey]['option'] = $installed_modules;
    }

    /**
     * @param array $directory_array
     * @param string $path
     */
    private function getFilesArrayByPath(&$directory_array, $path, $isExt = false)
    {
        // set php_self in the local scope
        if (!isset($PHP_SELF)) {
            $PHP_SELF = $_SERVER['PHP_SELF'];
        }

        $file_extension = substr($PHP_SELF, strrpos($PHP_SELF, '.'));
        if ($dir = @dir($path)) {
            while ($file = $dir->read()) {
                if ($isExt) {
                    if (!is_dir($path . $file . '/' . $file) && $file !== 'example') {
                        $directory_array[] = $file . $file_extension;
                    }
                } else {
                    if (!is_dir($path . $file)) {
                        if (substr($file, strrpos($file, '.')) == $file_extension) {
                            // array of all the payment modules present in includes/modules/payment
                            $directory_array[] = $file;
                        }
                    }
                }
            }

            sort($directory_array);
            $dir->close();
        }
    }
}
