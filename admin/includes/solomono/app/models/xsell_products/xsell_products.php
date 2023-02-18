<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 14.06.2017
 * Time: 15:22
 */

namespace admin\includes\solomono\app\models\xsell_products;

use admin\includes\solomono\app\core\Model;


class xsell_products extends Model {

    protected $allowed_fields=[
        'products_id'=>[
            'label'=>TABLE_HEADING_PRODUCT_ID,
            'general'=>'text',
            'sort'=>true,
            'filter'=>true
        ],
        'xsell_id'=>[
            'label'=>TABLE_HEADING_PRODUCT_ID,
            'form_header'=>true,
            'show'=>false,
        ],
        'products_model'=>[
            'label'=>TABLE_HEADING_PRODUCT_MODEL,
            'general'=>'text',
            'sort'=>true,
            'form_header'=>true,
            'filter'=>true
        ],
        'products_image'=>[
            'label'=>TABLE_HEADING_PRODUCT_IMAGE,
            'general'=>'file',
        ],
        'products_name'=>[
            'label'=>TABLE_HEADING_PRODUCT_NAME,
            'general'=>'text',
            'form_header'=>true,
        ],
        'current_sells'=>[
            'label'=>TABLE_HEADING_CURRENT_SELLS,
            'general'=>'text',
            'show'=>true,
        ],
        'products_price'=>[
            'label'=>XSELL_PRODUCT_PRICE,
            'form_header'=>true,
            'show'=>false,
        ],
        'discount'=>[
            'label'=>TEXT_XSELL_DISC,
            'form_header'=>true,
            'show'=>false,
        ],
        'sort_order'=>[
            'label'=>TABLE_HEADING_PRODUCT_SORT,
            'form_header'=>true,
            'show'=>false,
        ],
        'cross_prod'=>[
            'label'=>TEXT_RECIPROCAL_LINK,
            'form_header'=>true,
            'show'=>false,
        ],
    ];

    protected $prefix_id='products_id';

    public function select() {
            $sql="select distinct products_id as id,  
                         products_id,
                         products_model, 
                         products_image, 
                         products_name,
                         products_xsell.products_id as xsell 
                     from " . TABLE_PRODUCTS . " 
                        left join " . TABLE_PRODUCTS_DESCRIPTION . "  using (products_id)
                        left join products_xsell using (products_id)
                     where  language_id = '" . (int)$this->language_id . "'";
        return $sql;
    }

    public function query($request) {
        parent::query($request);
        $this->checkImage($this->data['data'], 'products_image');
        $this->prepareDataFields($request);
    }

    protected function filter($request) {
        if(isset($request['xsell'])){
            $request['search']['xsell'] = $request['xsell'];
        }

        $columnSearch = [];
        if (isset($request['search']) && count($request['search'])) {
            foreach ($request['search'] as $field => $search) {
                if (!empty($search)) {
                    if($field == 'xsell'){
                        $columnSearch[] = $search == 'true'?(" products_xsell.products_id is not null "):(" products_xsell.products_id is null ");
                    } else {
                        $columnSearch[] = $field . " LIKE '%" . $search . "%'";
                    }
                }
            }
            $columnSearch = $columnSearch ? implode(' AND ', $columnSearch) : '';
        }
        return $columnSearch;
    }

    private function checkImage(array &$arr, $field) {
        $file_path=DIR_FS_CATALOG . DIR_WS_IMAGES.'products/';
        foreach ($arr as &$item) {
            $img = explode(';',$item[$field])[0];
            if (!file_exists($file_path . $img)) {
                $item[$field]=null;
            } else {
                $item[$field]='80x80/products/'.$img;
            }
        }
    }

    public function prepareDataFields($request) {
        $sql="select px.products_id, pd.products_name, px.discount from products_xsell px
              left join products_description pd on pd.products_id = px.xsell_id
              where pd.language_id = '" . (int)$this->language_id . "'";
        $xsells=$this->getResult($sql);

        foreach($this->data['data'] as  $k => &$field_names){
            $count = 0;
            foreach ($xsells as $val){
                if($val['products_id'] == $field_names['products_id']){
                    $count++;
                    $field_names['current_sells'] .= $count.'. '. $val['products_name'].' ('.$val['discount'].')<br>';
                }
            }
        }

    }

    public function selectOne($id) {
        $sql="select px.id,
                     px.xsell_id, 
                     p.products_model, 
                     pd.products_name, 
                     p.products_price, 
                     px.discount, 
                     px.sort_order, 
                      (select px2.products_id  from products_xsell px2 where px2.xsell_id = px.products_id and  px2.products_id = px.xsell_id) as  cross_prod 
                     from products_xsell px 
                     left join products p on p.products_id = px.xsell_id
                     left join products_description pd on pd.products_id = px.xsell_id
                     where pd.language_id = '" . (int)$this->language_id . "' and px.products_id = {$id}";

        if ($id) {
            $this->data['data']=$this->getResult($sql);
            $this->data['id']=$id;
        }
    }

    public function insert($data) {
        tep_db_query ("INSERT INTO products_xsell SET products_id = '" . $data['product_id'] . "', xsell_id = '" . $data['xsell_id'] . "'");
        $this->selectOne($data['product_id']);
        return true;
    }


    public function delete($id) {
        if (tep_db_query("DELETE FROM products_xsell WHERE ID = '" . $id . "'")) {
            return true;
        }
        return false;
    }


    public function updateXsellProduct($data){
        if(isset($data['status'])){
            if($data['status']){
                tep_db_query ("INSERT INTO products_xsell SET products_id = '" . $data['xsell_id'] . "', xsell_id = '" . $data['product_id'] . "'");
            } else {
                tep_db_query ("DELETE FROM products_xsell WHERE products_id = '" . $data['xsell_id']. "' AND xsell_id = '" . $data['product_id'] ."'");
            }
        } else {
            tep_db_query ("UPDATE products_xsell SET {$data['name']} = '" . $data['val'] . "' WHERE ID = '" . $data['id']. "'");
        }

        return true;
    }

    public function select_product_xsell($search=false, $id) {

        $sql = "select
                     p.products_id, 
                     p.products_model, 
                     pd.products_name, 
                     p.products_price 
                     from products p 
                     left join products_description pd on pd.products_id = p.products_id
                     where (`p`.`products_id` LIKE '%{$search}%' or `p`.`products_model` LIKE '%{$search}%' or `pd`.`products_name` LIKE '%{$search}%')
                     and p.products_id not in (select xsell_id from products_xsell px where `px`.`products_id` = '{$id}') and pd.language_id = {$this->language_id} and p.products_id != $id";

        return $this->getResult($sql);
    }
}