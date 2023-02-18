<?php

/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 14.06.2017
 * Time: 15:22
 */

use admin\includes\solomono\app\core\Model;

include_once(DIR_ROOT . '/' . DIR_WS_CLASSES . 'seo.class.php');

class salemaker extends Model
{

    protected $allowed_fields = [
        'sale_name' => [
            'label' => TABLE_HEADING_SALE_NAME,
            'type' => 'text',
            'sort' => true,
            'filter' => true
        ],
        'sale_deduction_value' => [
            'label' => TABLE_HEADING_SALE_DEDUCTION,
            'type' => 'text',
            'callback' => 'cutToFirstSignificantDigit'
        ],
        'sale_deduction_type' => [
            'label' => TEXT_SALEMAKER_DEDUCTION_TYPE,
            'type' => 'select',
            'option' => array(
                '0' =>  DEDUCTION_TYPE_DROPDOWN_0,
                '1' =>  DEDUCTION_TYPE_DROPDOWN_1,
                '2' =>  DEDUCTION_TYPE_DROPDOWN_2,
            )
        ],
        'sale_date_start' => [
            'label' => TABLE_HEADING_SALE_DATE_START,
            'type' => 'text',
            'class' => 'datepicker',
            'default' => '0000-00-00'
        ],
        'sale_date_end' => [
            'label' => TABLE_HEADING_SALE_DATE_END,
            'type' => 'text',
            'class' => 'datepicker',
            'default' => '0000-00-00'
        ],
        'sale_pricerange_from' => [
            'label' => TEXT_INFO_PRICERANGE_FROM,
            'type' => 'text',
            'show' => false,
            'default' => '0.0000'
        ],
        'sale_pricerange_to' => [
            'label' => TEXT_INFO_PRICERANGE_TO,
            'type' => 'text',
            'show' => false,
            'default' => '0.0000'
        ],
        'sale_specials_condition' => [
            'label' => TEXT_INFO_SPECIALS_CONDITION,
            'show' => false,
            'type' => 'select',
            'option' => array(
                '0' => SPECIALS_CONDITION_DROPDOWN_0,
                '1' => SPECIALS_CONDITION_DROPDOWN_1,
                '2' => SPECIALS_CONDITION_DROPDOWN_2,
            )
        ],
/*        'sale_categories_all'=>[
            'label'=>TEXT_SALEMAKER_ENTIRE_CATALOG,
            'show' => false,
            'type' => 'checkbox',
        ],*/
        'sale_categories_selected' => [
            'label' => TEXT_SALEMAKER_CATEGORIES,
            'show' => false,
            'type' => 'select',
            'params' => 'multiple  size=7',
            'option' => array()
        ],
        'sale_manufacturers_selected' => [
            'label' => TEXT_SALEMAKER_MANUFACTURERS,
            'show' => false,
            'type' => 'select',
            'params' => 'multiple  size=7',
            'option' => array()
        ],
        'status' => [
            'label' => TABLE_HEADING_STATUS,
        ],
    ];

    protected $prefix_id = 'sale_id';

    //protected $table='salemaker_sales';

    public function select()
    {
        $sql = "select sale_id as id, 
                sale_status as status, 
                sale_name, 
                sale_deduction_value, 
                sale_deduction_type, 
                sale_date_start, 
                sale_date_end 
                from " . TABLE_SALEMAKER_SALES;
        return $sql;
    }

    public function query($request)
    {
        parent::query($request);
        $this->getOptions();
        $this->prepareAllowFields();
    }

    private function getCategoryTree()
    {
        $sql = "SELECT
                  `c`.`categories_id` AS `id`,
                  `c`.`parent_id`,
                  `c`.`categories_status`,
                  `cd`.`categories_name` AS `name`
                FROM `categories` `c`
                  LEFT JOIN `categories_description` `cd` ON `cd`.`categories_id` = `c`.`categories_id`
                WHERE `cd`.`language_id` = '{$this->language_id}'
                ORDER BY `sort_order` ASC";
        return $sql;
    }

    public function setTree()
    {
        $arr = $this->getResultKey($this->getCategoryTree(), 'id');
        return $this->mapTree($arr);
    }

    private function mapTree($dataset)
    {
        $tree = array();
        foreach ($dataset as $id => &$node) {
            if (!$node['parent_id']) {
                $tree[$id] =& $node;
            } else {
                $dataset[$node['parent_id']]['childs'][$id] =& $node;
            }
        }
        return $tree;
    }

/*    public function getTreeOption($arr, $spaces = '') {
        static $resArr = [];
        foreach ($arr as $k => $v) {
            $resArr[$k] = $spaces.$v['name'];
            if (array_key_exists('childs', $v)) {
                $this->getTreeOption($v['childs'], $spaces.'&nbsp;&nbsp;&nbsp;&nbsp;');
            }
        }
        return $resArr;
    }*/

    public function getOptions()
    {
/*        $arr = $this->setTree();
        $category_tree = $this->getTreeOption($arr);*/
        foreach ($this->allowed_fields as $field_name => &$value) {
            if (isset($value['option'])) {
/*                if($field_name == 'sale_categories_selected'){
                    $value['option'] = $category_tree;
                }*/
                $this->data['option'][$field_name] = $value['option'];
            }
        }
    }

    public function prepareAllowFields()
    {
        foreach ($this->data['data'] as &$field_names) {
            foreach ($field_names as $field_name => &$value) {
                if (isset($this->data['allowed_fields'][$field_name]['option']) && $field_name == 'sale_deduction_type') {
                    $options = $this->data['option'][$field_name];
                    $value =  $options[$value];
                }
            }
        }
    }

    public function selectOne($id)
    {
        $sql = "select sale_id as id, 
                    sale_status, 
                    sale_name, 
                    sale_deduction_value, 
                    sale_deduction_type, 
                    sale_pricerange_from, 
                    sale_pricerange_to, 
                    sale_specials_condition, 
                    sale_categories_selected, 
                    sale_manufacturers_selected, 
                    sale_categories_all, 
                    sale_date_start,
                    sale_date_end, 
                    sale_date_added, 
                    sale_date_last_modified, 
                    sale_date_status_change 
                    from " . TABLE_SALEMAKER_SALES . " 
                    where sale_id = '" . $id . "'";
        if ($id) {
            $this->data['data'] = $this->getResult($sql)[0];
        }
    }

    public function update($data)
    {
        $id = $data['id'];
        unset($data['id']);
        $data['sale_categories_selected'] = $data['sale_categories_selected'] ?: [];
        $data['sale_manufacturers_selected'] = $data['sale_manufacturers_selected'] ?: [];
        asort($data['sale_categories_selected']);

        $data['sale_categories_selected'] = $data['sale_categories_all'] = implode(',', array_unique($data['sale_categories_selected']));
        $data['sale_manufacturers_selected'] = implode(',', array_unique($data['sale_manufacturers_selected']));

        $query = $this->prepareGeneralField($data);

        $sql = "INSERT INTO `salemaker_sales` SET {$query},`$this->prefix_id`='{$id}',`sale_date_last_modified`=now() ON DUPLICATE KEY UPDATE {$query},`$this->prefix_id`='{$id}',`sale_date_last_modified`=now()";
        if (!tep_db_query($sql)) {
            return false;
        }
        return true;
    }

    public function insert($data)
    {
        $id = tep_db_fetch_array(tep_db_query("select max({$this->prefix_id})+1 as next_id from `salemaker_sales`"))['next_id'] ?: 1;

        $data['sale_categories_selected'] = $data['sale_categories_selected'] ?: [];
        $data['sale_manufacturers_selected'] = $data['sale_manufacturers_selected'] ?: [];
        asort($data['sale_categories_selected']);

        $data['sale_categories_selected'] = $data['sale_categories_all'] = implode(',', array_unique($data['sale_categories_selected']));
        $data['sale_manufacturers_selected'] = implode(',', array_unique($data['sale_manufacturers_selected']));

        $query = $this->prepareGeneralField($data);

        $sql = "INSERT INTO `salemaker_sales` SET {$query},`$this->prefix_id`='{$id}',`sale_date_added`=now(),sale_status='1'";
        if (!tep_db_query($sql)) {
            return false;
        }
        return true;
    }


    public function delete($id)
    {
        tep_db_query("DELETE FROM salemaker_sales WHERE `{$this->prefix_id}`={$id}");
        return true;
    }

    public function getManufacturers()
    {
        $sql = "SELECT m.manufacturers_id, mi.manufacturers_name FROM manufacturers m JOIN manufacturers_info mi ON m.manufacturers_id = mi.manufacturers_id  WHERE status = '1' and mi.languages_id = {$this->language_id} order by manufacturers_name asc";
        $query = tep_db_query($sql);
        $output = [];
        while ($row = tep_db_fetch_array($query)) {
            $output[] = ['id' => $row['manufacturers_id'],'name' => $row['manufacturers_name']];
        }
        return $output;
    }
}
