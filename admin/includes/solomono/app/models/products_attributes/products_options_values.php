<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 14.06.2017
 * Time: 15:22
 */

namespace admin\includes\solomono\app\models\products_attributes;

use admin\includes\solomono\app\core\Model;

include_once(DIR_ROOT . '/' . DIR_WS_CLASSES . 'seo.class.php');

class products_options_values extends Model {

    protected $allowed_fields=[
        'id'=>[
            'label'=>TABLE_HEADING_ID,
            'sort'=>true,
        ],
        'products_options_id'=>[
            'label'=>TABLE_HEADING_OPT_NAME,
            'general'=>'select',
            'show' => false,
            'option' => [
                'table' => "products_options",
                'id' => "products_options_id",
                'title' => "products_options_name"]
        ],
        'products_options_name'=>[
            'label'=>TABLE_HEADING_OPT_NAME,
            'filter'=>true,
            'sort'=>true,
        ],
        'products_options_values_name'=>[
            'label'=>TABLE_HEADING_OPT_VALUE,
            'type'=>'text',
            'sort'=>true,
            'filter'=>true,
        ],
        'products_options_values_image'=>[
            'label'=>TEXT_PRAT_COLOR,
            'general'=>'file',
        ],
        'products_options_values_sort_order'=>[
            'label'=>TEXT_OPTION_SORT_ORDER,
            'general'=>'number',
        ]
    ];


    private $seoUrl;
    public $addFolder;
    protected $prefix_id='products_options_values_id';

    public function select($id=false) {
        $sql="SELECT DISTINCT 
                  `pov`.`products_options_values_id` as id,
                  `pov`.`products_options_values_name`,
                  `po`.`products_options_id`,
                  `po`.`products_options_name`,
                  `pov`.`products_options_values_image`,
                  `pov`.`products_options_values_sort_order`,
                  `pov`.`language_id`
                FROM `products_options_values` `pov` 
                left join `products_options_values_to_products_options` `pov2po` on pov.products_options_values_id = pov2po.products_options_values_id
                left join `products_options` `po` on  pov2po.products_options_id = po.products_options_id
                ";
        if ($id) {
            return $sql . " WHERE `pov`.`products_options_values_id` = {$id}";
        }
        $sql.=" WHERE `pov`.`language_id`='{$this->language_id}' and `po`.`language_id`='{$this->language_id}'";
        return $sql;
    }

    public function query($request){

        parent::query($request);
    }

    public function getOptions() {
        foreach ($this->allowed_fields as $field_name => $value) {
            if (isset($value['option'])) {
                $selectedOption = isset($_GET['opt_id']) ? (int)$_GET['opt_id'] : false;
                $sql = "SELECT `{$value['option']['id']}`,`{$value['option']['title']}` FROM `{$value['option']['table']}` WHERE `language_id`='{$this->language_id}'";
                $sql = tep_db_query($sql);
                while ($row = tep_db_fetch_array($sql)) {
                    $result[$row[$value['option']['id']]] = [
                      'val' => $row[$value['option']['title']],
                      'selected' => $selectedOption == $row[$value['option']['id']],
                    ];

                }
                $this->data['option'][$field_name] = $result;
            }
        }
    }
    
    public function selectOne($id) {
        $sql=$this->select($id);
        if ($id) {
            $this->data['data']=$this->getResultKey($sql, 'language_id');
            $this->data['addFolder']=$this->addFolder;
        }
        $this->getLanguages();
        $this->getOptions();
        $this->getAllProductsByAttrVal($id);

    }

    public function update($data) {

        $id=$data['id'];
        unset($data['id']);
        $query=$data['products_options_id'];
        unset($data['products_options_id']);
        //$query=$this->prepareGeneralField($data);

        if ($this->insertUpdate($data, $id, __FUNCTION__) && $query) {
            $sql="INSERT INTO `products_options_values_to_products_options` SET products_options_id={$query},`$this->prefix_id`='{$id}' ON DUPLICATE KEY UPDATE products_options_id={$query},`$this->prefix_id`='{$id}'";
            if (!tep_db_query($sql)) {
                return false;
            }
            return true;
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
        $query=$data['products_options_id'];
        unset($data['products_options_id']);
        $id=tep_db_fetch_array(tep_db_query("select max({$this->prefix_id})+1 as next_id from `{$this->table}`"))['next_id']?:1;

        if ($this->insertUpdate($data, $id, __FUNCTION__)) {
            $sql="INSERT INTO `products_options_values_to_products_options` SET products_options_id={$query},`$this->prefix_id`='{$id}'";
            if (!tep_db_query($sql)) {
                return false;
            }
            return true;
        }
        return false;
    }

    public function delete($id) {
        $query = tep_db_query("SELECT `products_id` FROM `products_attributes` WHERE `options_values_id`={$id}");
        if($query->num_rows){
            $this->error = sprintf(TEXT_ALERT1, $query->num_rows);
            return false;
        }
        if (tep_db_query("DELETE FROM {$this->table} WHERE `{$this->prefix_id}`={$id}")) {
            return tep_db_query("DELETE FROM `products_options_values_to_products_options` WHERE `{$this->prefix_id}`={$id}");
        }
        return false;
    }

    protected function filter($request)
    {
        if (isset($request['search']) && count($request['search'])) {
            $columnSearch = [];
            foreach ($request['search'] as $field => $search) {

                if ($field == 'id'){
                    if($search) {
                        $columnSearch[] = "pov.products_options_values_id" . " LIKE '%" . tep_db_prepare_input($search) . "%'";
                    }
                } else {
                    if($search) {
                        $columnSearch[] = $field . " LIKE '%" . tep_db_prepare_input($search) . "%'";
                    }
                }

            }
            $columnSearch = implode(' AND ', $columnSearch);
        }
        if (isset($request['opt_id']) && $request['opt_id']){
            if($columnSearch) {
                $columnSearch .= ' AND ';
            }
            $columnSearch .= ' po.products_options_id='.$request['opt_id'];
        }
        return $columnSearch;
    }

    private function getAllProductsByAttrVal($id){
        $sql="SELECT pa.products_id, pd.products_name from products_attributes pa 
                LEFT JOIN products_description pd on pa.products_id = pd.products_id
                WHERE pa.options_values_id = '{$id}' and pd.language_id ='{$this->language_id}'";
        $this->data['AllProductsByAttrVal']=$this->getResult($sql);
    }

}