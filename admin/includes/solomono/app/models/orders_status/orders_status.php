<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 07.09.2017
 * Time: 14:06
 */

namespace admin\includes\solomono\app\models\orders_status;


use admin\includes\solomono\app\core\Model;

class orders_status extends Model {

    protected $prefix_id = 'orders_status_id';
    private $default = DEFAULT_ORDERS_STATUS_ID;
    protected $allowed_fields = [
        'orders_status_name' => [
            'label' => TABLE_HEADING_ORDERS_STATUS,
            'type' => 'text',
        ],
        'orders_status_text' => [
            'label' => TABLE_HEADING_ORDER_STATUS_TEXT,
            'type' => 'textarea',
            'ckeditor' => true,
            'show'=>false
        ],
        'default' => [
            'label' => TABLE_HEADING_DEFAULT,
            'type' => 'status',
            'class' => 'check_all',
            'hideInForm' => true,
        ],
        'downloads_flag' => [
            'label' => TABLE_HEADING_DOWNLOADS,
            'type' => 'status',
            'hideInForm' => true,
        ],
        'orders_status_color' => [
            'label' => TABLE_HEADING_COLOR,
            'type' => 'color',
            'class' => 'color',
            'change' => true,
            'hideInForm' => true,
        ],
        'orders_status_show' => [
            'label' => TABLE_HEADING_STATUS_SHOW,
            'type' => 'status',
            'hideInForm' => true,
        ]
    ];

    public function select($id = false) {
        $sql = "SELECT
                `{$this->prefix_id}` as id,
                `orders_status_name`,
                `orders_status_text`,
                `orders_status_color`,
                `orders_status_show`,
                `downloads_flag`,
                `language_id`,
                 CASE `{$this->prefix_id}`
                WHEN '{$this->default}' THEN '1'
                ELSE '0'
                END as `default`
              FROM `{$this->table}`";
        if ($id) {
            return $sql . " WHERE {$this->prefix_id} = '{$id}'";
        }
        $sql .= " WHERE `language_id`='{$this->language_id}'";

        return $sql;
    }

    public function selectOne($id) {
        $sql = $this->select($id);
        if ($id) {
            $this->data['data'] = $this->getResultKey($sql, 'language_id');
        }
        $this->getLanguages();
    }

    public function insert($data)
    {
        $id = tep_db_fetch_array(tep_db_query("select max({$this->prefix_id})+1 as next_id from `{$this->table}`"))['next_id'] ?: 1;
        return $this->insertUpdate($data, $id, __FUNCTION__);
    }

    public function update($data) {
        $id = $data['id'];
        unset($data['id']);
        return $this->insertUpdate($data, $id,__FUNCTION__);
    }

    public function updateDefault($id) {
        $sql = ("UPDATE " . TABLE_CONFIGURATION . " SET `configuration_value`='{$id}' WHERE `configuration_key` = 'DEFAULT_ORDERS_STATUS_ID'");
        if (!tep_db_query($sql)) {
            return false;
        }
        return true;
    }




}