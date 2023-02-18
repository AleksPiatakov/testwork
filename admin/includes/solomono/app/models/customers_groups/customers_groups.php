<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 14.06.2017
 * Time: 15:22
 */

namespace admin\includes\solomono\app\models\customers_groups;

use admin\includes\solomono\app\core\Model;

include_once(DIR_ROOT . '/' . DIR_WS_CLASSES . 'seo.class.php');

class customers_groups extends Model {

    protected $allowed_fields=[
        'customers_groups_name'=>[
            'label'=>TABLE_HEADING_NAME,
            'type'=>'text',
            'sort'=>true,
            'filter'=>true
        ],
        'color_bar'=>[
            'label'=>GROUP_COLOR_BAR,
            'type' => 'color',
            'class'=>'color',
            'change'=>true
        ],
        'customers_groups_min_price'=>[
            'label'=>TABLE_GROUP_MIN_PRICE,
            'type'=>'text',
        ],
        'customers_groups_discount'=>[
            'label'=>TABLE_HEADING_DISCOUNT,
            'type'=>'text',
        ],
        'customers_groups_price'=>[
            'label'=>TABLE_HEADING_PRICE,
            'type'=>'select',
            'option' => array(),
            'tooltip' => TOOLTIP_CLIENT_GROUP_PRICE,
        ],
        'customers_groups_accumulated_limit'=>[
            'label'=>TABLE_HEADING_ACCUMULATED_LIMIT,
            'type'=>'text',
            'tooltip' => TOOLTIP_CLIENT_PRICE_GROUP_LIMIT,
        ],
        'orders_status'=>[
            'label'=>ENTRY_ORDERS_STATUS,
            'show' => false,
            'type'=>'select',
            'params' => 'multiple  size=7',
            'option' => ''
        ],
        'payment_allowed'=>[
            'label'=>ENTRY_PAYMENT_MODULS,
            'show' => false,
            'type'=>'select',
            'params' => 'multiple  size=7',
            'option' => ''
        ],
        'shipping_allowed'=>[
            'label'=>ENTRY_SHIPPING_MODULS,
            'show' => false,
            'type'=>'select',
            'params' => 'multiple  size=7',
            'option' => ''
        ],

    ];

    protected $prefix_id='customers_groups_id';
    //protected $table='salemaker_sales';

    public function select() {
        $sql="select c.customers_groups_accumulated_limit, 
                    c.customers_groups_id as id, 
                    c.customers_groups_name, 
                    c.customers_groups_discount, 
                    c.customers_groups_price, 
                    c.color_bar, 
                    c.group_payment_allowed, 
                    c.group_shipment_allowed, 
                    c.customers_groups_min_price 
                    from " . TABLE_CUSTOMERS_GROUPS . " c";
        return $sql;
    }

    public function query($request) {
        parent::query($request);
        $this->getOptions();
        $this->prepareAllowFields();
    }

    public function getOptions()
    {
        foreach ($this->allowed_fields as $field_name => &$value) {
            if (isset($value['option'])) {
                if ($field_name = 'customers_groups_price') {
                    $tep_xppp_getpricesnum = tep_xppp_getpricesnum();
                    for ($i = 1; $i <= $tep_xppp_getpricesnum; $i++) {
                        $this->data['option'][$field_name][$i] = $i;
                    }
                } elseif($field_name = 'orders_status'){


                } else {
                    $this->data['option'][$field_name] = $value['option'];
                }
            }
        }
    }

    public function prepareAllowFields() {
        foreach($this->data['data'] as &$field_names){
            foreach ($field_names as $field_name => &$value){
                if (isset($this->data['allowed_fields'][$field_name]['option']) && $field_name == 'customers_groups_price'){
                    $options = $this->data['option'][$field_name];
                    $value =  $options[$value];
                }
            }
        }
    }

    public function selectOne($id) {
        $sql="select c.customers_groups_accumulated_limit, 
                        c.customers_groups_id as id, 
                        c.customers_groups_name, 
                        c.customers_groups_discount,
                        c.customers_groups_price, 
                        c.color_bar, 
                        c.group_payment_allowed, 
                        c.group_shipment_allowed, 
                        c.customers_groups_min_price 
                        from " . TABLE_CUSTOMERS_GROUPS . " c  
                        where c.customers_groups_id = '" . $id . "'";
        if ($id) {
            $this->data['data']=$this->getResult($sql)[0];
        }
    }

    public function update($data) {
        $id=$data['id'];
        unset($data['id']);

        tep_db_query("delete from customers_groups_orders_status where customers_groups_id = {$id}");
        $status = [];
        if($data['orders_status']){
            foreach ($data['orders_status'] as $v){
                $status[] = "({$id}, {$v})";
            }
            $status_str = implode(', ', $status);
            tep_db_query("insert into customers_groups_orders_status (customers_groups_id, orders_status_id) VALUE {$status_str}");
        }

        if(is_array($data['payment_allowed'])) $data['group_payment_allowed'] = implode(';', array_unique($data['payment_allowed']?:[]));
        if(is_array($data['shipping_allowed'])) $data['group_shipment_allowed'] = implode(';', array_unique($data['shipping_allowed']?:[]));

        $query=$this->prepareGeneralField($data);

        $sql="INSERT INTO `customers_groups` SET {$query},`$this->prefix_id`='{$id}' ON DUPLICATE KEY UPDATE {$query},`$this->prefix_id`='{$id}'";
        if (!tep_db_query($sql)) {
            return false;
        }
        return true;
    }

    public function insert($data)
    {
        $id = tep_db_fetch_array(tep_db_query("select max({$this->prefix_id})+1 as next_id from `customers_groups`"))['next_id'] ?: 1;

        $status = [];
        if (!empty($data['orders_status'])) {
            foreach ($data['orders_status'] as $v) {
                $status[] = "({$id}, {$v})";
            }
            $status_str = implode(', ', $status);
            tep_db_query("insert into customers_groups_orders_status (customers_groups_id, orders_status_id) VALUE {$status_str}");
        }


        if (is_array($data['payment_allowed'])) {
            $data['group_payment_allowed'] = implode(';', $data['payment_allowed']);
        }
        if (is_array($data['shipping_allowed'])) {
            $data['group_shipment_allowed'] = implode(';', $data['shipping_allowed']);
        }

        $data['customers_groups_min_price'] = $data['customers_groups_min_price'] ?: 0;
        $data['customers_groups_discount'] = $data['customers_groups_discount'] ?: 0;
        $data['customers_groups_accumulated_limit'] = $data['customers_groups_accumulated_limit'] ?: 0;

        $query = $this->prepareGeneralField($data);

        $sql = "INSERT INTO `customers_groups` SET {$query},`$this->prefix_id`='{$id}'";
        if (!tep_db_query($sql)) {
            return false;
        }
        return true;
    }


    public function delete($id) {
        tep_db_query("DELETE FROM customers_groups WHERE `{$this->prefix_id}`={$id}");
        return true;
    }

    public function getOrdersStatusOptions($id = 0)
    {
        $orders_status_query = tep_db_query("select os.orders_status_id, os.orders_status_name, cgos.customers_groups_id from orders_status os 
                                                    left join customers_groups_orders_status cgos on cgos.orders_status_id = os.orders_status_id and customers_groups_id = ".(int)$id."
                                                    where os.language_id = {$this->language_id}");
        $html ='';
        while ($orders_status = tep_db_fetch_array($orders_status_query)) {
            if ($orders_status['customers_groups_id'] === $id){
                $selected = 'selected';
            } else {
                $selected = '';
            }
            $html .= '<option ' . $selected . ' value="' . $orders_status['orders_status_id'] . '">'. $orders_status['orders_status_name'] . '</option>';
        }
        return $html;
    }
    
    public function getPaymentOptions(){
        // set php_self in the local scope
        if (!isset($PHP_SELF)) $PHP_SELF = $_SERVER['PHP_SELF'];
        
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
        $module_active = explode (";",MODULE_PAYMENT_INSTALLED);
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
                        $installed_modules[] = ['id' => $module->code.'.php', 'name' => $module->title];
                    }
                }
            }
        }
        return $installed_modules;
    }

    public function getShippingOptions(){

        // set php_self in the local scope
        if (!isset($PHP_SELF)) $PHP_SELF = $_SERVER['PHP_SELF'];

        $ship_module_directory = DIR_FS_CATALOG_MODULES . 'shipping/';

        // For modules in includes
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
        // For modules in ext
        $extShippingModules = DIR_FS_EXT . 'shipping/';
        if ($dir = @dir($extShippingModules)) {
            while ($file = $dir->read()) {
                if (file_exists($extShippingModules . $file . "/{$file}.php")) {
                    $ship_directory_array[] = $file . '.php';
                }
            }
            sort($ship_directory_array);
            $dir->close();
        }

        $ship_module_active = explode (";",MODULE_SHIPPING_INSTALLED);
        $installed_shipping_modules = array();
        for ($i = 0, $n = sizeof($ship_directory_array); $i < $n; $i++) {
            $file = $ship_directory_array[$i];
            if (in_array($ship_directory_array[$i], $ship_module_active)) {
                if (file_exists($ship_module_directory . $ship_directory_array[$i])) {
                    includeLanguages(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/modules/shipping/' . $file);
                    include($ship_module_directory . $file);
                } else {
                    $shipName = substr($ship_directory_array[$i], 0, strrpos($ship_directory_array[$i],'.'));
                    includeLanguages($extShippingModules . $shipName . '/languages/' . $_SESSION['language'] . '/' . $file);
                    include($extShippingModules . $shipName . '/' . $file);
                }

                $ship_class = substr($file, 0, strrpos($file, '.'));
                if (tep_class_exists($ship_class)) {
                    $ship_module = new $ship_class;
                    if ($ship_module->check() > 0) {
                        $installed_shipping_modules[] = ['id' => $ship_module->code.'.php', 'name' => $ship_module->title];
                    }
                }
            }
        }
        return $installed_shipping_modules;
    }
}