<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 14.06.2017
 * Time: 15:22
 */

namespace admin\includes\solomono\app\models\sub_configuration;

use admin\includes\solomono\app\core\Model;

class sub_configuration extends Model {

    protected $allowed_fields=[
        'id'=>[
            'label'=> 'ID',
            'general'=>'disabled',
        ],
        'title'=>[
            'label'=> SUB_CONFIGURATION_TITLE,
            'type'=>'text',
        ]
    ];

    protected $prefix_id='id';

    public function select($id = false) {
        $sql = "
              SELECT sc.id
                   , sc.language_id
                   , sc.title
              FROM sub_configuration sc
        ";
        if ($id) {
            return $sql . " WHERE sc.id = {$id}";
        }
        $sql .= " WHERE sc.language_id = '{$this->language_id}'";
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
        return $this->insertUpdate($data, $id, __FUNCTION__, 'sub_configuration', 'language_id');
    }

    public function insert($data) {
        $id= tep_db_fetch_array(tep_db_query("select max({$this->prefix_id})+1 as next_id from `{$this->table}`"))['next_id']?:1;
        return $this->insertUpdate($data, $id, __FUNCTION__, 'sub_configuration', 'language_id');
    }

    public function delete($id) {
        return tep_db_query("DELETE FROM `sub_configuration` WHERE `{$this->prefix_id}` = {$id}");
    }

}