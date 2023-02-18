<?php

namespace admin\includes\solomono\app\models\total_configuration;

use admin\includes\solomono\app\core\Model;

class total_configuration extends Model {

    protected $allowed_fields = [
        'configuration_title' => [
            'label' => TABLE_HEADING_TITLE,
            'sort' => true,
            'filter' => true,
            'type' => 'text',
        ],
        'configuration_key' => [
            'label' => TABLE_HEADING_KEY,
            'sort' => true,
            'filter' => true,
            'type' => 'text',
        ],
        'configuration_value' => [
            'label' => TABLE_HEADING_VALUE,
            'sort' => true,
            'filter' => true,
            'type' => 'text',
        ],
        'configuration_description' => [
            'label' => TABLE_HEADING_DESCRIPTION,
            'sort' => true,
            'filter' => true,
            'type' => 'text',
        ],
        'configuration_group_id' => [
            'label' => TABLE_HEADING_GROUP_ID,
            'show' => 'disabled',
            'type' => 'select',
            'option' => [
                'table' => 'configuration_group',
                'id' => 'configuration_group_id',
                'title' => 'configuration_group_title'
            ]
        ],
        'use_function' => [
            'label' => TABLE_HEADING_USE_FUNC,
            'type' => 'text',
        ],
        'set_function' => [
            'label' => TABLE_HEADING_SET_FUNC,
            'type' => 'text',
        ],
        'last_modified' => [
            'label' => TABLE_HEADING_LAST_MODIFY,
            'show' => false,
            'type'=>'disabled'
        ],
        'date_added' => [
            'label' => TABLE_HEADING_DATE_ADDED,
            'show' => false,
            'type'=>'disabled'
        ],
    ];

    protected $prefix_id = 'configuration_id';
    protected $table = 'configuration';


    public function select() {
        $sql = "SELECT {$this->getField()} FROM {$this->table}";
        return $this->checkGroups($sql);
    }

    public function selectOne($id) {
        if ($id) {
            $sql = "SELECT {$this->getField()} FROM {$this->table} WHERE `{$this->prefix_id}` = {$id} ";
            $this->data['data'] = $this->getResult($sql)[0];
        }
        $this->getOptions();
    }

    public function getGroup() {
        $sql = "SELECT
                  `cg`.`configuration_group_id` as id,
                  `cg`.`configuration_group_title`
                FROM `configuration_group` `cg`
                ORDER BY `cg`.`configuration_group_title` ";
        return $this->getResult($sql);
    }

    private function checkGroups($sql) {
        $groupID = '';
        if (!empty($_GET['group']) && $_GET['group'] != 'all') {
            $groupID = " WHERE `configuration_group_id` = {$_GET['group']}";
        }
        return $sql . $groupID;
    }

    public function update($data) {
        $data = $this->checkFunction($data);
        $data['last_modified'] = date("Y-m-d H:i:s");
        return parent::update($data);
    }

    public function insert($data) {
        $data = $this->checkFunction($data);
        $data['date_added'] = date("Y-m-d H:i:s");
        return parent::insert($data);
    }

    private function checkFunction($data) {
        if (strlen($data['set_function']) != 0) {
            preg_match('/^([a-z_]+)(\()/', $data['set_function'], $matches);
            $func_name = $matches[1];
            if (!function_exists($func_name)) {
                unset($data['set_function']);
                if (!$this->isAjax()) {
                    $_SESSION['message'] = ERROR_DONT_EXIST_SET_FUNC;
                } else {
                    $this->error = ERROR_DONT_EXIST_SET_FUNC;
                }
            }
        }
        if (strlen($data['use_function']) != 0) {
            if (!function_exists($data['use_function'])) {
                unset($data['use_function']);
                if (!$this->isAjax()) {
                    $_SESSION['message'] = ERROR_DONT_EXIST_USE_FUNC;
                } else {
                    $this->error = ERROR_DONT_EXIST_USE_FUNC;
                }
            }
        }
        return $data;
    }

}