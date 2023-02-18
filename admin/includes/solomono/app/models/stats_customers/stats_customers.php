<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 14.06.2017
 * Time: 15:22
 */

namespace admin\includes\solomono\app\models\stats_customers;

use admin\includes\solomono\app\core\Model;

include_once(DIR_WS_CLASSES . 'currencies.php');


class stats_customers extends Model {

    protected $allowed_fields=[
        'num'=>[
            'label'=>TABLE_HEADING_NUMBER,
            //'label'=>'ID',
            'general'=>'text',
            'thWidth'=>100
        ],
        'fio'=>[
            'label'=>TABLE_HEADING_CUSTOMERS,
            'general'=>'text',
            'sort'=>true,
            'filter'=>true,
        ],
        'ordersum'=>[
            'label'=>TABLE_HEADING_TOTAL_PURCHASED,
            'general'=>'text',
            'sort'=>true,
            'filter'=>true,
            'thWidth'=>150
        ],
    ];

    public $castomers = [];

    public function select() {
        $start_date = $end_date = '';
        if (isset($_GET['start_date'])){
            $start_date = tep_db_prepare_input($_GET['start_date']);
            $start_date = strtotime($start_date);
            $start_date = date('Y-m-d H:i:s',$start_date);
            $start_date = "and o.date_purchased >= '$start_date'";
        }
        if (isset($_GET['end_date'])){
            $end_date = tep_db_prepare_input($_GET['end_date']);
            $end_date = strtotime($end_date);
            $end_date = date('Y-m-d H:i:s',$end_date);
            $end_date = "and o.date_purchased <= '$end_date'";
        }
        $sql="select c.customers_id as id, 
                c.customers_firstname, 
                c.customers_lastname, 
                sum(op.products_quantity * op.final_price) as ordersum 
                from " . TABLE_CUSTOMERS . " c, " . TABLE_ORDERS_PRODUCTS . " op, " . TABLE_ORDERS . " o 
                where c.customers_id = o.customers_id 
                and o.orders_id = op.orders_id
                $start_date $end_date
                group by c.customers_firstname, c.customers_lastname";
        return $sql;
    }

    public function query($request) {
        $request['order'] = $request['order']?:'ordersum-desc';
        parent::query($request);
        $this->getNumberInOrder();
        $this->getFIO();
    }

    private function getNumberInOrder(){
        $currencies = new \currencies();
        $num = 1;
        foreach ($this->data['data'] as $k => $v){
            $this->data['data'][$k]['num'] = $num++;
            $this->data['data'][$k]['ordersum'] = $currencies->format($v['ordersum']);
        }
    }

    private function getFIO(){
        foreach ($this->data['data'] as $k => $v){
            $this->data['data'][$k]['fio'] = $this->data['data'][$k]['customers_firstname'].' '.$this->data['data'][$k]['customers_lastname'];
        }
    }
}