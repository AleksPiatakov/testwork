<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 14.06.2017
 * Time: 15:22
 */

namespace admin\includes\solomono\app\models\tax_rates;

use admin\includes\solomono\app\core\Model;

class tax_rates extends Model
{

    protected $allowed_fields = [
        'tax_priority' => [
            'label' => TABLE_HEADING_TAX_RATE_PRIORITY,
            'type' => 'text',
            'sort' => true,
            'filter' => true
        ],
        'tax_class_id' => [
            'label' => TABLE_HEADING_TAX_CLASS_TITLE,
            'type' => 'select',
            'option' => [
                'table' => 'tax_class',
                'id' => 'tax_class_id',
                'title' => 'tax_class_title'
            ],
            'sort' => true,
            'filter' => true,
            'show' => false
        ],

        'tax_class_title' => [
            'label' => TABLE_HEADING_TAX_CLASS_TITLE,
            'type' => 'text',
            'sort' => true,
            'filter' => true,
            'hideInForm' => true
        ],

        'tax_zone_id' => [
            'label' => TABLE_HEADING_ZONE,
            'type' => 'select',
            'option' => [
                'table' => 'geo_zones',
                'id' => 'geo_zone_id',
                'title' => 'geo_zone_name'
            ],
            'show' => false
        ],

        'geo_zone_name' => [
            'label' => TABLE_HEADING_ZONE,
            'type' => 'text',
            'hideInForm' => true
        ],

        'tax_rate' => [
            'label' => TABLE_HEADING_TAX_RATE,
            'type' => 'text',
            'show' => false
        ],

        'tax_rate_table' => [
            'label' => TABLE_HEADING_TAX_RATE,
            'type' => 'text',
            'hideInForm' => true
        ],

        'tax_description' => [
            'label' => TEXT_INFO_RATE_DESCRIPTION,
            'type' => 'text',
            'show' => false,
        ],
        'date_added' => [
            'label' => TEXT_INFO_DATE_ADDED,
            'type' => 'disabled',
            'show' => false,
        ],
        'last_modified' => [
            'label' => TEXT_INFO_LAST_MODIFIED,
            'type' => 'disabled',
            'show' => false,
        ]
    ];

    protected $prefix_id = 'tax_rates_id';

    public function select($id = false)
    {
        $sql = "select r.tax_rates_id as id,
                z.geo_zone_id, 
                z.geo_zone_name, 
                tc.tax_class_title, 
                tc.tax_class_id, 
                r.tax_priority, 
                r.tax_rate, 
                r.tax_description, 
                r.date_added, 
                r.last_modified 
                from " . TABLE_TAX_CLASS . " tc, " . TABLE_TAX_RATES . " r 
                left join " . TABLE_GEO_ZONES . " z on r.tax_zone_id = z.geo_zone_id 
                where r.tax_class_id = tc.tax_class_id";
        if ($id) {
            return $sql . " and `tax_rates_id` = {$id}";
        }
        return $sql;
    }

    public function query($request)
    {
        parent::query($request);

        foreach ($this->data['data'] as $key => $val) {
            $this->data['data'][$key]['tax_rate_table'] = cutToFirstSignificantDigit($val['tax_rate']) . '%';
        }
    }

    public function selectOne($id)
    {
        $sql = $this->select($id);
        if ($id) {
            $this->data['data'] = $this->getResult($sql)[0];
        }
    }


    public function update($data)
    {
        $id = $data['id'];
        unset($data['id']);

        $query = $this->prepareGeneralField($data);
        $sql = "INSERT INTO `tax_rates` SET {$query},`$this->prefix_id`='{$id}',`last_modified`=now() ON DUPLICATE KEY UPDATE {$query},`$this->prefix_id`='{$id}',`last_modified`=now()";
        if (!tep_db_query($sql)) {
            return false;
        }
        return true;
    }

    public function insert($data) {

        $id=tep_db_fetch_array(tep_db_query("select max({$this->prefix_id})+1 as next_id from `tax_rates`"))['next_id']?:1;
        $query=$this->prepareGeneralField($data);

        $sql = "INSERT INTO `tax_rates` SET {$query},`$this->prefix_id`='{$id}',`date_added`=now()";
        if (!tep_db_query($sql)) {
            return false;
        }

        return true;
    }


    public function delete($id)
    {
        if (tep_db_query("DELETE FROM tax_rates WHERE `{$this->prefix_id}`={$id}")) {
            return true;
        }
        return false;
    }

}