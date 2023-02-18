<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 14.06.2017
 * Time: 15:22
 */

namespace admin\includes\solomono\app\models\newsletters;

use admin\includes\solomono\app\core\Model;

include(DIR_WS_LANGUAGES . $_SESSION['language'] . '/modules/newsletters/product_notification.php');

class newsletters extends Model {

    protected $allowed_fields=[
        'title'=>[
            'label'=>TABLE_HEADING_NEWSLETTERS,
            'type'=>'text',
            'sort'=>true,
            'filter'=>true

        ],
        'content'=>[
            'label'=>TEXT_NEWSLETTER_CONTENT,
            'type'=>'textarea',
            'ckeditor'=>true,
            'show' => false,
        ],
        'content_length'=>[
            'label'=>TABLE_HEADING_SIZE,
            'type'=>'text',
            'hideInForm'=>true,
        ],
        'module'=>[
            'label'=>TABLE_HEADING_MODULE,
            'type'=>'select',
            'option' => [],
        ],
        'sent'=>[
            'label'=>TABLE_HEADING_SENT,
        ],
        'status'=>[
            'label'=>TABLE_HEADING_STATUS,
        ],
    ];

    protected $prefix_id='newsletters_id';

    public function select() {
        $sql="select 
            newsletters_id as id, 
            title, 
            length(content) as content_length, 
            module, 
            status as sent, 
            locked as status
        from  newsletters";
        return $sql;
    }

    function query($request){
        parent::query($request);
        $this->prepareAllowFields();
    }

    protected function order($request) {
        $order=parent::order($request);
        return $order? :'ORDER BY date_added desc';
    }

    public function prepareAllowFields() {
        foreach($this->data['data'] as &$field_names){
            $field_names['content_length'] = number_format($field_names['content_length']) . ' <small>bytes</small>';

            $red = '<span class='.'red_mark'.'></span>';
            $green = '<span class='.'green_mark'.'></span>';
            $field_names['sent'] = $field_names['sent']? $green : $red;

            $dir = DIR_WS_MODULES . 'newsletters/reports/';
            foreach (glob($dir."report_*" . $field_names['module'] . "_" . $field_names['id'] . "_{*.txt}", GLOB_BRACE) as $report) {
                $path_parts = pathinfo($report);
                $replace = '';
                $file = preg_replace('/.txt/' , $replace, $path_parts["basename"]);
                $string = 'report(_bulk_|_smart_|_)' . $field_names['module'] . '_' . $field_names['id'] . '_';
                $file = preg_replace('/' . $string . '/', $replace, $file);
                $file_array = explode("_", $file);
                $date = preg_replace("/([0-9]{2})([0-9]{2})([0-9]{2})/", "$2/$1/20$3", $file_array[1]);
                $field_names['emails'] .= '<div>';
                $field_names['emails'] .= '<div style="float:left">emails:' . $file_array[0] . '</div>';
                $field_names['emails'] .= '<div style="float:right">' . date("d-m-Y", strtotime($date)) . '</div>';
                //echo '<div style="clear:both"></div>';
                $field_names['emails'] .= '</div>';
            }

            foreach ($field_names as $field_name => &$value){
                if (isset($this->data['allowed_fields'][$field_name]['option']) && $field_name == 'module'){
                    $options = $this->getModules();
                    $value = $options[array_search($value, array_column($options, 'id'))]['text'];
                }
            }
        }
    }

    public function getOptions()
    {
        foreach ($this->allowed_fields as $field_name => &$value) {
            if (isset($value['option'])){

                $value['option'] = $this->getModules();
                $this->data['option'][$field_name] = $value['option'];
            }
        }
    }

    private function getModules(){
        $directory_array = array();
        if ($dir = dir(DIR_WS_MODULES . 'newsletters/')) {
            while ($file = $dir->read()) {
                if (!is_dir(DIR_WS_MODULES . 'newsletters/' . $file)) {
                    $directory_array[] = $file;
                }
            }
            sort($directory_array);
            $dir->close();
        }
        $modules_array = [];
        for ($i=0, $n=sizeof($directory_array); $i<$n; $i++) {
            $modules_array[] = array('id' => substr($directory_array[$i], 0, strrpos($directory_array[$i], '.')), 'text' => substr($directory_array[$i], 0, strrpos($directory_array[$i], '.')));
        }
        return $modules_array;
    }

    public function selectOne($id) {
        $sql="select 
            newsletters_id as id, 
            title, 
            content, 
            length(content) as content_length, 
            module, 
            status as sent, 
            locked as status
        from  newsletters
                WHERE newsletters_id = {$id}";

        if ($id) {
            $this->data['data']=$this->getResult($sql);
        }
        $this->getLanguages();
    }

    public function select_customers(){
        $sql = "select customers_id, customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " ";
        $arr = $this->getResult($sql);
        foreach ($arr as $k=>$v){
            $this->data['option']['customers'][$v['customers_id']]= $v['customers_firstname'].' '.$v['customers_lastname'];
        }
        $this->data['allowed_fields']['customers'] = [
            'label'=>TEXT_COUNT_CUSTOMERS_RECEIVE,
            'type'=>'select',
            'option' => $this->data['option']['customers'],
            'params' => 'multiple  size=7',
        ];
    }


    public function select_products(){
        $sql = "select pd.products_id, pd.products_name 
                from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd 
                where pd.language_id = '" . $this->language_id . "' 
                and pd.products_id = p.products_id 
                and p.products_status = '1' 
                order by pd.products_name";
        $arr = $this->getResult($sql);
        foreach ($arr as $k=>$v){
            $this->data['option']['products'][$v['products_id']]= $v['products_name'];
        }
        $this->data['allowed_fields']['products'] = [
            'label'=>TEXT_PRODUCTS,
            'type'=>'select',
            'option' => $this->data['option']['products'],
            'params' => 'multiple  size=7',
        ];
    }
    public function update($data) {
        $id=$data['id'];
        unset($data['id']);
        $data['content'] = $data['content'][0];
        $query=$this->prepareGeneralField($data);

        $sql="INSERT INTO `newsletters` SET {$query},`$this->prefix_id`='{$id}' ON DUPLICATE KEY UPDATE {$query},`$this->prefix_id`='{$id}'";
        if (!tep_db_query($sql)) {
            return false;
        }

        return true;
    }

    public function insert($data)
    {
        $id = tep_db_fetch_array(tep_db_query("select max({$this->prefix_id})+1 as next_id from `{$this->table}`"))['next_id'] ?: 1;

        $query = $this->prepareGeneralField($data);

        $sql = "INSERT INTO `newsletters` SET {$query},`$this->prefix_id`='{$id}',`date_added`=now()";
        if (!tep_db_query($sql)) {
            return false;
        }

        return true;
    }


    public function delete($id) {
        if (tep_db_query("DELETE FROM {$this->table} WHERE `{$this->prefix_id}`={$id}")) {
            return tep_db_query("DELETE FROM `newsletters` WHERE `{$this->prefix_id}`={$id}");
        }
        return false;
    }

}