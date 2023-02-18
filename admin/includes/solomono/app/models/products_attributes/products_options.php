<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 14.06.2017
 * Time: 15:22
 */

namespace admin\includes\solomono\app\models\products_attributes;

use admin\includes\solomono\app\core\Model;


class products_options extends Model {

    protected $allowed_fields=[
        'id'=>[
            'label'=>TABLE_HEADING_ID,
            'sort'=>true,
        ],
        'products_options_name'=>[
            'label'=>TABLE_HEADING_OPT_NAME,
            'type'=>'text',
            'filter'=>true,
            'sort'=>true,
        ],
        'products_options_type'=>[
            'label'=>TABLE_HEADING_OPT_TYPE,
            'general'=>'select',
            'option' => array(
                array ('id' => '0',
                    'title' => TEXT_TYPE_TEXT),
                array ('id' => '1',
                    'title' => TEXT_TYPE_SELECT,
                    ),
                array ('id' => '2',
                    'title' => TEXT_TYPE_RADIO),
//                array ('id' => '3',
//                    'title' => TEXT_TYPE_CHECKBOX),
                array ('id' => '4',
                    'title' => TEXT_TYPE_TEXTAREA)
            ),
            'tooltip' => TOOLTIP_ATTRIBUTES_TYPES,
        ],
        'pag' => [
            'label' => TABLE_HEADING_OPT_GROUP,
            'general' => 'select',
            'option' => [],
            'show' => false
        ],
        'products_options_length'=>[
            'label'=>TABLE_HEADING_OPT_LENGTH,
            'general' => 'checkbox',
            'type'=>'status',
            'hideInForm'=>true,
            'tooltip' => TOOLTIP_ATTRIBUTES_SHOW_IN_FILTER,
        ],
        'products_options_comment'=>[
            'label'=>TABLE_HEADING_OPT_COMMENT,
            'general' => 'checkbox',
            'type'=>'status',
            'hideInForm'=>true,
            'tooltip' => TOOLTIP_ATTRIBUTES_SHOW_IN_LISTING,
        ],
        'products_options_sort_order'=>[
            'label'=>TEXT_OPTION_SORT_ORDER,
            'general'=>'number',
        ],
        'products_options_categories'=>[
            'label'=>TEXT_CATEGORIES,
            'general' => 'select',
            'multiple' => true,
            'categories' => true,
        ]
    ];


    protected $prefix_id='products_options_id';

    public function getProductsAttributesGroup()
    {
        $products_attributes_groups_array[] = [
            'id' => 0,
            'title' => ' --- '
        ];

        $query = tep_db_query("SELECT pag_id AS id, pag_name AS title FROM products_attributes_groups  WHERE language_id='".(int)$_SESSION['languages_id']."'");
        while($row = tep_db_fetch_array($query))  {
            $products_attributes_groups_array[] = $row;
        }
        return $products_attributes_groups_array;
    }

    public function select($id=false) {
        $sql="SELECT
                  `pa`.`products_options_id` as id,
                  `pa`.`products_options_name`,
                  `pa`.`products_options_type`,
                  `pa`.`products_options_length`,
                  `pa`.`products_options_comment`,
                  `pa`.`products_options_sort_order`,
                  `pa`.`pag`,
                  `pa`.`categories`,
                  `pa`.`language_id`
                FROM `products_options` `pa` ";
        if ($id) {
            return $sql . " WHERE `pa`.`products_options_id` = {$id}";
        }
        $sql.=" WHERE `pa`.`language_id`='{$this->language_id}'";
        return $sql;
    }

    public function query($request){
        parent::query($request);
        $lang=$this->language_id;
        foreach ($this->data['data']  as  $key => $value){
            $this->data['data'][$key]['products_options_type'] = $this->allowed_fields['products_options_type']['option'][$value['products_options_type']]['title'];
        }
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
        $data['categories'] = isset($data['categories']) ? implode(',', $data['categories']) : '';
        unset($data['current_categories']);
        unset($data['id']);
        $data['products_options_comment'] = $data['products_options_comment'] == 'on' ? 1 : 0;
        $data['products_options_length'] = $data['products_options_length'] == 'on' ? 1 : 0;

        //$query=$this->prepareGeneralField($data);

        if ($this->insertUpdate($data, $id, __FUNCTION__)) {
            //$sql="INSERT INTO `{$this->table}` SET {$query},`$this->prefix_id`='{$id}' ON DUPLICATE KEY UPDATE {$query},`$this->prefix_id`='{$id}'";
            //if (!tep_db_query($sql)) {
                return true;
            //}
        }
        return false;
    }

    protected function order($request) {
        if (empty($request['order'])){
            $request['order']='id-asc';
        }
        return parent::order($request);

    }

    public function insert($data) {
        $data['categories'] = isset($data['categories']) ? implode(',', $data['categories']) : '';
        unset($data['current_categories']);
        $data['products_options_comment'] = $data['products_options_comment'] == 'on' ? 1 : 0;
        $data['products_options_length'] = $data['products_options_length'] == 'on' ? 1 : 0;

        $id=tep_db_fetch_array(tep_db_query("select max({$this->prefix_id})+1 as next_id from `{$this->table}`"))['next_id']?:1;

        if (isset($data['products_options_sort_order'])) $data['products_options_sort_order'] = $data['products_options_sort_order']?:0;

        if ($this->insertUpdate($data, $id, __FUNCTION__)) {
            return true;
        }
        return false;
    }

    public function delete($id) {
        $sql = tep_db_query("SELECT pa.`products_id` FROM `products_attributes` pa JOIN products_to_categories ptc ON ptc.products_id=pa.products_id WHERE pa.`options_id`={$id}");
        $res = '';
        $count = 0;
        while ($row = tep_db_fetch_array($sql)) {
            $res .= $row['products_id'];
            $count++;
        }
        if($res){
            $this->error = sprintf(TEXT_ALERT1, $count);
            return false;
        }
        if (tep_db_query("DELETE FROM {$this->table} WHERE `{$this->prefix_id}`={$id}")) {
            if(tep_db_query("DELETE FROM `products_options_values` WHERE `products_options_values_id` in (SELECT products_options_values_id from products_options_values_to_products_options WHERE `{$this->prefix_id}`={$id}) ")){
                return tep_db_query("DELETE FROM `products_options_values_to_products_options` WHERE `{$this->prefix_id}`={$id}");
            }
        }
        return false;
    }

    public function getOptions()
    {
        foreach ($this->allowed_fields as $field_name => $value) {
            if (isset($value['option'])){
                if($field_name == 'products_options_type'){
                    foreach (array_column($value['option'], 'title') as $k => $title){
                        $this->data['option'][$field_name][$k] = [
                          'val' => $title,
                          'selected' => isset($value['option'][$k]['selected'])?:false,
                        ];
                    }
                }
                elseif ($field_name == 'pag')
                {
                    $productsAttributesGroup = $this->getProductsAttributesGroup();
                    foreach ($productsAttributesGroup as $k => $value) {
                        $this->data['option'][$field_name][$value['id']] = [
                          'val' => $value['title'],
                          'selected' => false,
                        ];
                    }
                }
                else {
//                    if($field_name == 'pag') $this->allowed_fields[$field_name]['option']['where'] = $value['option']['where'] = 'language_id ='.$_SESSION['languages_id'];
                    $this->optionFields($field_name, $value['option']);
                }

            }
        }
    }

    public function checkDelete($id)
    {
        $sql = tep_db_query("SELECT `products_options_id` FROM `products_options_values_to_products_options` WHERE `products_options_id`={$id}");
        $res = '';
        $data = [];
        $count = 0;
        while ($row = tep_db_fetch_array($sql)) {
            $res .= $row['products_options_id'];
            $count++;
        }
        if($res){
            $data['msg'] = sprintf(TEXT_ALERT2, $count);
            return json_encode($data);
        }
        return false;
    }
}