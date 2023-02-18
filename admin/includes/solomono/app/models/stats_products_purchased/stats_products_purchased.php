<?php

namespace admin\includes\solomono\app\models\stats_products_purchased;

use admin\includes\solomono\app\core\Model;

include_once(DIR_ROOT . '/' . DIR_WS_CLASSES . 'seo.class.php');

class stats_products_purchased extends Model {

    protected $allowed_fields = [
        'num' => [
            'label'=>TABLE_HEADING_NUMBER,
            'general'=>'text',
            'thWidth'=>100
        ],
        'products_model' => [
            'label'=>TABLE_HEADING_MODEL,
            'general'=>'text',
            'thWidth'=>200
        ],
        'products_name' => [
            'label'=>TABLE_HEADING_PRODUCTS,
            'general'=>'text',
            'sort'=>true,
            'filter'=>true,
        ],
        'quantitysum' => [
            'label'=>TABLE_HEADING_PURCHASED,
            'general'=>'text',
            'sort'=>true,
            'thWidth'=>150,
        ],
        'gross' => [
            'label'=>TABLE_HEADING_GROSS,
            'general'=>'text',
            'sort'=>true,
            'thWidth'=>150
        ],
    ];

    public function select() {
        global $start_date, $end_date;
        $sql = "select op.products_id as id, 
                       op.products_model, 
                       op.products_name, 
                       sum(op.products_quantity) as quantitysum, 
                       ROUND(sum(op.products_price*op.products_quantity), 2) as gross 
                from " . TABLE_ORDERS . " as o, 
                     " . TABLE_ORDERS_PRODUCTS . " AS op 
                where o.date_purchased BETWEEN '" . $start_date . "' AND '" . $end_date . " 23:59:59' AND 
                      o.orders_id = op.orders_id 
                group by op.products_id ";
        return $sql;
    }

    public function query($request) {
        $request['order'] = $request['order']?:'quantitysum-desc';
        parent::query($request);
        $this->getNumberInOrder();
        $this->getTotalGross($request);
    }


    private function getNumberInOrder() {
        $num = 1;
        foreach ($this->data['data'] as $k => $v) {
            $this->data['data'][$k]['num'] = $num++;
        }
    }

    private function getTotalGrossSql($request) {
        global $start_date, $end_date;
        $sql = "select ROUND(sum(op.products_price*op.products_quantity), 2)as total_gross 
                FROM " . TABLE_ORDERS . " as o, 
                     " . TABLE_ORDERS_PRODUCTS . " AS op 
                WHERE o.date_purchased BETWEEN '" . $start_date . "' AND '" . $end_date . " 23:59:59' AND 
                      o.orders_id = op.orders_id";
        $filter = parent::filter($request);
        if ($filter) {
            $sql .= ' AND ' . $filter;
        }
        $sql = tep_db_query($sql);
        $sql = tep_db_fetch_array($sql);
        return $sql['total_gross'];
    }

    private function getTotalGross($request) {
        if (count($this->data['data'])) {
            end($this->data['data']);
            $key = key($this->data['data']);
            $this->data['data'][$key + 1] = $this->data['data'][$key];
            foreach ($this->data['data'][$key + 1] as $k => $v) {
                $this->data['data'][$key + 1][$k] = '';
            }
            $getTotal = $this->getTotalGrossSql($request);
            $this->data['data'][$key + 1]['gross'] = '<b>' . ENTRY_TOTAL . ': ' . $getTotal . '</b>';
        }
    }

}