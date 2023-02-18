<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 14.06.2017
 * Time: 15:22
 */

namespace admin\includes\solomono\app\models\tax_classes;

use admin\includes\solomono\app\core\Model;

include_once(DIR_ROOT . '/' . DIR_WS_CLASSES . 'seo.class.php');

class tax_classes extends Model {

    protected $allowed_fields=[
        'tax_class_title'=>[
            'label'=>TABLE_HEADING_TAX_CLASSES,
            'type'=>'text',
            'sort'=>true,
            'filter'=>true
        ],
        'tax_class_description'=>[
            'label'=>TEXT_INFO_CLASS_DESCRIPTION,
            'type'=>'text',
            'show'=>false,
        ],
        'date_added'=>[
            'label'=>TEXT_INFO_DATE_ADDED,
            'type'=>'disabled',
            'show'=>false,
        ],
        'last_modified'=>[
            'label'=>TEXT_INFO_LAST_MODIFIED,
            'type'=>'disabled',
            'show'=>false,
        ]
    ];
    
    protected $prefix_id='tax_class_id';

    public function select($id=false) {
        $sql="select tax_class_id as id, 
                tax_class_title, 
                tax_class_description, 
                last_modified, 
                date_added 
                from " . TABLE_TAX_CLASS . " ";
        if ($id) {
            return $sql . " WHERE `tax_class_id` = {$id}";
        }
        return $sql;
    }

    protected function order($request) {
        $order=parent::order($request);
        return $order? :'order by tax_class_title';
    }

    public function selectOne($id) {
        $sql=$this->select($id);
        if ($id) {
            $this->data['data']=$this->getResult($sql)[0];
        }
    }

    public function update($data) {

        $id=$data['id'];
        unset($data['id']);

        $query=$this->prepareGeneralField($data);
            $sql="INSERT INTO `tax_class` SET {$query},`$this->prefix_id`='{$id}',`last_modified`=now() ON DUPLICATE KEY UPDATE {$query},`$this->prefix_id`='{$id}',`last_modified`=now()";
            if (!tep_db_query($sql)) {
                return false;
            }
        return true;
    }

    public function insert($data) {

        $id=tep_db_fetch_array(tep_db_query("select max({$this->prefix_id})+1 as next_id from `tax_class`"))['next_id']?:1;
        $query=$this->prepareGeneralField($data);

        $sql="INSERT INTO `tax_class` SET {$query},`$this->prefix_id`='{$id}',`date_added`=now()";
        if (!tep_db_query($sql)) {
            return false;
        }

        return true;
    }


    public function delete($id) {
        if (tep_db_query("DELETE FROM tax_class WHERE `{$this->prefix_id}`={$id}")) {
            tep_db_query("DELETE FROM tax_rates WHERE tax_class_id={$id}");
            tep_db_query("UPDATE products SET products_tax_class_id = 0 WHERE products_tax_class_id={$id}");
            return true;
        }
        return false;
    }

}