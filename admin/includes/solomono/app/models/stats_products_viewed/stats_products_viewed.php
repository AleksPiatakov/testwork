<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 14.06.2017
 * Time: 15:22
 */

namespace admin\includes\solomono\app\models\stats_products_viewed;

use admin\includes\solomono\app\core\Model;

include_once(DIR_ROOT . '/' . DIR_WS_CLASSES . 'seo.class.php');

class stats_products_viewed extends Model {

    protected $allowed_fields=[
        'num'=>[
            'label'=>TABLE_HEADING_NUMBER,
            //'label'=>'ID',
            'general'=>'text',
            'thWidth'=>100
        ],
        'products_name'=>[
            'label'=>TABLE_HEADING_PRODUCTS,
            'general'=>'text',
            'sort'=>true,
            'filter'=>true,
        ],
        'products_viewed'=>[
            'label'=>TABLE_HEADING_VIEWED,
            'general'=>'text',
            'sort'=>true,
            'filter'=>true,
            'thWidth'=>150
        ],
    ];

    public function select() {
        $sql="select pd.products_id as id,
                     pd.products_name, 
                     pd.products_viewed
                from " . TABLE_PRODUCTS_DESCRIPTION . " pd
               where pd.language_id = {$this->language_id} and products_viewed>0";
        return $sql;
    }

    public function query($request) {
        $request['order'] = $request['order']?:'products_viewed-desc';
        parent::query($request);
        $this->getNumberInOrder();
    }


    private function getNumberInOrder(){
        $num = 1;
        foreach ($this->data['data'] as $k => $v){
            $this->data['data'][$k]['num'] = $num++;
        }
    }

}