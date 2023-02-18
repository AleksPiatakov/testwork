<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 14.06.2017
 * Time: 17:57
 */

namespace admin\includes\solomono\app\models\admin_members;

use admin\includes\solomono\app\core\Model;

class admin_files extends Model {

    protected $prefix_id = 'admin_files_id';

    public function __construct() {
        parent::__construct();
        $admin_groups=new admin_groups();
        $this->data['admin_groups']= $this->getResult($admin_groups->select());
    }

    public function select() {
        $sql = "SELECT a.{$this->prefix_id} as id, a.admin_files_id,a.admin_files_name,a.admin_files_is_boxes,a.admin_files_to_boxes,a.admin_groups_id,a1.admin_files_name as admin_category
                from {$this->table} a
                left join {$this->table} a1 on a1.{$this->prefix_id}=a.admin_files_to_boxes
                where a.admin_files_to_boxes!=0 and a.status = 1
                order by a1.admin_files_name,a.admin_files_name";
       return $this->getResult($sql);
    }


    public function insertFile($data) {
        $admin_files_group=$data['admin_files_group'];
        $admin_files_name=$data['admin_files_name'];
        $sql_data_array = array('admin_files_name' => tep_db_prepare_input( $admin_files_name),
                                'admin_files_to_boxes' => tep_db_prepare_input($admin_files_group));
        return tep_db_perform(TABLE_ADMIN_FILES, $sql_data_array);;
    }

    public function deleteFile($data) {
        $admin_files_name=$data['admin_files_name'];
        $sql = "delete from {$this->table} where `admin_files_name`='{$admin_files_name}'";
        return tep_db_query($sql);
    }


    public function getGroups(){
        $data=$this->select();
        $groupsArray = array();

        foreach ($data as $key => $value) {
            if (!empty($value['admin_category']) && !in_array($value['admin_category'], $groupsArray)) {
                $groupsArray[$value['admin_files_to_boxes']] = $value['admin_category'];
            }
        }
        $this->data['result'] = $groupsArray;
    }

    public function update($data)
    {
        $id = $data['id'];
        $admin_group_id = $data['admin_groups_id'];
        $sql = "SELECT * from {$this->table} WHERE {$this->prefix_id} = {$id}";
        $sql = tep_db_query($sql);
        $row = tep_db_fetch_array($sql);
        $admin_group_values = explode(',', $row['admin_groups_id']);
        $key = array_search($admin_group_id, $admin_group_values);
        if ($key !== false) {
            unset($admin_group_values[$key]);
        } else {
            $admin_group_values[] = $admin_group_id;
        }
        sort($admin_group_values);
        $result = implode(',', $admin_group_values);
        $sql = "UPDATE {$this->table} SET `admin_groups_id`='{$result}' WHERE `{$this->prefix_id}`='{$id}'";
        return tep_db_query($sql);
    }


    public function checkBox($id_groups){
        $data=$this->select();
        foreach ($data as $key => $value) {
            $groupsArray = explode(",", $value['admin_groups_id']);
            if(in_array($id_groups,$groupsArray)){
                $data[$key] += ['checked'=>true];
            }else{
                $data[$key] += ['checked'=>false];
            }
            $result[$value['admin_category']][]=$data[$key];
        }
        $this->data['result'] =$result;
    }
}