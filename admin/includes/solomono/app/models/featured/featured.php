<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 26.06.2017
 * Time: 15:42
 */

namespace admin\includes\solomono\app\models\featured;

use admin\includes\solomono\app\core\Model;

class featured extends Model
{

    protected $allowed_fields = [
        'products_model' => [
            'label' => TEXT_FEATURED_MODEL,
            'filter' => true,
            'sort' => true,
        ],
        'products_name' => [
            'label' => TABLE_HEADING_PRODUCTS,
            'type' => 'text',
            'placeholder' => TEXT_ENTER_PRODUCT,
            'filter' => true,
            'sort' => true,
        ],
        'status' => [
            'label' => TABLE_HEADING_STATUS,
        ],
        'featured_date_added' => [
            'label' => TEXT_FEATURED_ADDED,
            'class' => 'fz-12',
        ],
        'expires_date' => [
            'label' => TEXT_FEATURED_EXPIRE_DATE,
            'type' => 'text',
            'class' => 'fz-12'
        ],

    ];
    protected $prefix_id = 'featured_id';

    public function getProducts($find)
    {
        $sql = "SELECT pd.`products_id` as id,pd.`products_name` as label, p.`products_model` as model FROM `products_description` pd
             LEFT JOIN `products` p on p.`products_id`= pd.`products_id`
             WHERE (pd.`products_name` LIKE '%{$find}%' or  p.`products_model` LIKE '%{$find}%') AND pd.language_id = '{$this->language_id}' AND p.products_status = '1' limit 10";
        return $this->getResult($sql);
    }

    public function select($id = false)
    {
        //        AND pd.language_id = '{$this->language_id}'
        $sql = "SELECT
                  s.{$this->prefix_id} as id,
                  p.products_id,
                  p.products_model,
                  pd.products_name,
                  p.products_image,
                  s.featured_date_added,
                  s.date_status_change,
                  s.expires_date,
                  s.status
                FROM
                  products p,
                  {$this->table} s,
                  products_description pd
                WHERE p.products_id = pd.products_id AND p.products_id = s.products_id  AND pd.language_id = '{$this->language_id}' ";
        if ($id) {
            $sql .= " AND  s.{$this->prefix_id} ='{$id}'";
        }
        return $sql;
    }

    public function selectOne($id)
    {
        if ($id) {
            $sql = $this->select($id);
            $this->data['data'] = $this->getResult($sql)[0];
        }
    }

    public function update($data)
    {
        $this->changeField($data);
        if (empty($data['products_id'])) {
            unset($data['products_id']);
        }
        unset($data['products_name']);
        $data['date_status_change'] = date("Y-m-d H:i:s");
        return parent::update($data);
    }

    public function insert($data)
    {
        $this->changeField($data);
        $data['featured_date_added'] = date("Y-m-d H:i:s");
        return !empty($data['products_id']) ? parent::insert($data) : false;
    }

    private function changeField(&$data)
    {
        preg_match('/^\(([0-9]+)\s#.*\)/', $data['products_name'], $matches);
        $id = $matches[1];
        $data['products_id'] = $id;
        unset($data['products_name']);
    }

}