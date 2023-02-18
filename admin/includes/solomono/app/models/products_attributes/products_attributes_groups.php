<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 14.06.2017
 * Time: 15:22
 */

namespace admin\includes\solomono\app\models\products_attributes;

use admin\includes\solomono\app\core\Model;

class products_attributes_groups extends Model {

    protected $allowed_fields=[
        'pag_name'=>[
            'label'=>TEXT_OPTION_GROUP_NAME,
            'type'=>'text',
            'sort'=>true,
            'filter'=>true
        ],
        'sort_order'=>[
            'label'=>TEXT_OPTION_SORT_ORDER,
            'general'=>'text',
            'sort'=>true,
            'filter'=>true
        ],

    ];
    
    protected $prefix_id='pag_id';

    public function select($id=false) {
        $sql="SELECT
                  `p`.`pag_id` as id,
                  `p`.`language_id`,
                  `p`.`pag_name`,
                  `p`.`sort_order`
                  
                FROM `products_attributes_groups` `p`
                  ";
        if ($id) {
            return $sql . " WHERE `p`.`pag_id` = {$id}";
        }
        $sql.=" WHERE `p`.`language_id`='{$this->language_id}'";
        return $sql;
    }

    public function selectOne($id) {
        $sql=$this->select($id);
        if ($id) {
            $this->data['data']=$this->getResultKey($sql, 'language_id');
        }
        $this->getLanguages();
    }

    public function update($data) {

        $id=$data['id'];
        unset($data['id']);

        //$query=$this->prepareGeneralField($data);
        if ($this->insertUpdate($data, $id, __FUNCTION__, 'products_attributes_groups', 'language_id')) {
                return true;
        }
        return false;
    }

    public function insert($data)
    {
        $id = tep_db_fetch_array(tep_db_query("select max({$this->prefix_id})+1 as next_id from `{$this->table}`"))['next_id'] ?: 1;
        //$query=$this->prepareGeneralField($data);
        if ($this->insertUpdate($data, $id, __FUNCTION__, 'products_attributes_groups', 'language_id')) {
            return true;
        }
        return false;
    }
}