<?php

namespace admin\includes\solomono\app\models\api_keys;

use admin\includes\solomono\app\core\Model;

include_once(DIR_ROOT . '/' . DIR_WS_CLASSES . 'seo.class.php');

class api_keys extends Model
{
    const API_KEY_PART_LENGTH = 15;

    protected $allowed_fields = [
        'api_key_name' => [
            'label' => API_KEY_NAME_LABEL,
            'type' => 'text',
            'sort' => true,
            'filter' => true
        ],
        'api_key' => [
            'label' => API_KEY_LABEL,
            'type' => 'text',
            'show' => false
        ],
        'api_key_status' => [
            'label' => API_KEY_STATUS_LABEL,
            'type' => 'status',
            'hideInForm' => true
        ],
    ];

    protected $table = 'api_keys';

    protected $prefix_id = 'id';

    public function select($id = false)
    {
        $sql = "
            SELECT `a`.`{$this->prefix_id}` AS `id`
                 , `a`.`api_key_name`
                 , `a`.`api_key`
                 , `a`.`api_key_status`
            FROM `{$this->table}` `a`
        ";
        if ($id) {
            return $sql . " WHERE `a`.`{$this->prefix_id}` = {$id}";
        }
        return $sql;
    }

    public function update($data)
    {
        $id = $data['id'];
        unset($data['id']);

        $query = $this->prepareGeneralField($data);
        $sql = "UPDATE `{$this->table}` SET {$query} WHERE `$this->prefix_id`='{$id}'";
        if (!tep_db_query($sql)) {
            return false;
        }
        return $id;
    }

    public function insert($data)
    {
        unset($data['id']);
        $id = tep_db_fetch_array(tep_db_query("select max({$this->prefix_id})+1 as next_id from `{$this->table}`"))['next_id'] ?: 1;
        $query = $this->prepareGeneralField($data);
        $sql = "INSERT INTO `{$this->table}` SET {$query},`$this->prefix_id`='{$id}'";
        if (!tep_db_query($sql)) {
            return false;
        }
        return $id;
    }

    public function delete($id)
    {
        return tep_db_query("DELETE FROM {$this->table} WHERE `{$this->prefix_id}`={$id}");
    }

    public function selectOne($id)
    {
        $sql = $this->select($id);
        if ($id) {
            $this->data['data'] = $this->getResult($sql)[0];
        }
    }

    public function generateApiKey()
    {
        return implode('-', [
            \RandomToken(self::API_KEY_PART_LENGTH),
            \RandomToken(self::API_KEY_PART_LENGTH),
            \RandomToken(self::API_KEY_PART_LENGTH),
        ]);
    }
}
