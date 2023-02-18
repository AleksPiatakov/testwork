<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 14.06.2017
 * Time: 18:13
 */

namespace admin\includes\solomono\app\models\admin_members;

use admin\includes\solomono\app\core\Model;

class admin_groups extends Model {

    public $allowed_fields = [
        'admin_groups_name' => [
            'label' => TABLE_HEADING_GROUPS,
            'type' => 'text',
        ],
    ];
    protected $prefix_id = 'admin_groups_id';

    public function select($id=false) {
        $sql = "SELECT a.{$this->prefix_id} as id,a.admin_groups_name, a.admin_redirect_link_from_index
                from {$this->table} a ";
        if ($id) {
            $sql.=" WHERE {$this->prefix_id}='{$id}'";
        }
        return $sql;
    }
    public function selectOne($id) {
        $sql=$this->select($id);
        $this->data['data']=$this->getResult($sql)[0];
    }
}