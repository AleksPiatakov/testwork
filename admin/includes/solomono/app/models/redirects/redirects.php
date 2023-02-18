<?php

namespace admin\includes\solomono\app\models\redirects;

use admin\includes\solomono\app\core\Model;

class redirects extends Model{
    protected $allowed_fields = [
        'redirect_from' => [
            'label' => TEXT_REDIRECT_FROM,
            'type' => 'text',
        ],
        'action' => [
            'label' => TEXT_CHOOSE_ACTION,
            'type' => 'multiradio',
            'radio' => [
                '1'=>TEXT_REDIRECT,
                '2'=>TEXT_NOT_FOUND,
                '3'=>TEXT_NO_INDEX,
            ]
        ],
        'redirect_to' => [
            'label' => TEXT_REDIRECT_TO,
            'type' => 'text',
        ],
        'status' => [
            'label' => TABLE_HEADING_STATUS,
        ],
        'date_added' => [
            'label' => TEXT_DATE_ADDED,
            'general' => 'disabled',

        ],
        'date_updated' => [
            'label' => TEXT_DATE_UPDATED,

        ]
    ];
    protected $prefix_id='id';
    public function select($id=false, $initial_action_val = false) {
        $sql = "SELECT DISTINCT 
                  `r`.`id`,
                  `r`.`redirect_from`,
                  `r`.`redirect_to`, ";
        if($initial_action_val){
            $sql .= " `r`.`action`, ";
        }else{
            $sql .= " CASE ";
            foreach($this->allowed_fields['action']['radio'] as $key=>$name){
                $sql .= " WHEN `r`.`action` = '".$key."' THEN '".$name."'";
            }
            $sql .= " END `action`, ";
        }

        $sql .= "`r`.`status`,
                  `r`.`date_added`,
                  `r`.`date_updated`
                FROM `redirects` `r`
             ";
        if ($id) {
            $sql.=" WHERE  `r`.id ='{$id}'";
        }
        return $sql;
    }
    public function selectOne($id) {
        if ($id) {
            $sql=$this->select($id, true);
            $this->data['data']=$this->getResult($sql)[0];
        }
    }

    public function update($data) {
        $id = $data['id'];
        unset($data['id']);


        $redirects_query = $this->prepareGeneralField($data);
        $sql = "UPDATE `redirects` SET `date_updated`=now(),{$redirects_query} WHERE {$this->prefix_id}={$id} ";
            if (!tep_db_query($sql)) {
                return false;
            }

        return true;
    }

    public function insert($data)
    {
        unset($data['id']);
        $data['status'] = 1;
        if (!tep_db_query($data = parent::prepareFields($data))) {
            $this->error = "Error 'insert'({$data})";
            return false;
        }
        return tep_db_insert_id();
    }
}
