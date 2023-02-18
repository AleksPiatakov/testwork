<?php

use admin\includes\solomono\app\core\Model;

class seoTemplates extends Model
{

    const MAIN_PAGE = 'main';
    const PRODUCT = 'product';
    const CATEGORY = 'category';
    const MANUFACTURER = 'manufacturer';
    const SEARCH = 'search';

    protected $prefix_id = 'id';
    protected $info;
    protected $allowed_fields = [];
    protected $catList = [];

    public function __construct($info, $catList)
    {
        $this->info = $info;
        $this->catList = $catList;
        $info = $_GET['action'] != 'edit_seoTemplates' ? $info : '';
        $this->allowed_fields = [
            'temlate_name' => [
                'label' => TABLE_HEADING_SEO_TEMPLATE_NAME,
                'type' => 'text',
                'sort' => true,
                'required' => true,
                'form_option' => 'required',
                'filter' => true,
                'class' => 'default-cursor'
            ],
            'type' => [
                'label' => TABLE_HEADING_SEO_META_TYPE,
                'type' => 'hidden',
                'sort' => true,
                'filter' => true,
                'value' => $info,
            ],
            'status' => [
                'label' => TABLE_HEADING_STATUS,
            ],
            'sort_order' => [
                'label' => TABLE_HEADING_SEO_META_SORT_ORDER,
                'type' => 'number',
                'required' => true,
                'form_option' => 'required',
                'class' => 'default-cursor'
            ],
        ];

        if ($this->info == 'category' || $this->info == 'product') {
            $this->allowed_fields['seo_categories_selected'] = [
                'label' => TEXT_SEO_TEMLATES_CATEGORIES,
                'show' => false,
                'type' => 'select',
                'params' => 'multiple  size=7',
                'option' => array()
            ];
        }

        if ($this->info == 'manufacturer') {
            $this->allowed_fields['seo_manufacturers_selected'] = [
                'label' => TEXT_SEO_TEMLATES_MANUFACTURERS,
                'show' => false,
                'type' => 'select',
                'params' => 'multiple  size=7',
                'option' => array()
            ];
        }
        return parent::__construct();
    }

    public function getDescriptions($seoTempalteId)
    {
        $sql = "SELECT 
                `language_id`, 
                `meta_title`, 
                `meta_description`
                from " . TABLE_SEO_TEMLATES_DESCRIPTION . " 
                    where seo_templates_id = " . $seoTempalteId;
        if ($seoTempalteId) {
            return $this->getResultKey($sql, 'language_id');
        }
    }

    public function select()
    {
        $sql = 'SELECT 
                `id`, 
                `temlate_name`, 
                `include_ids`, 
                `sort_order`, 
                `status`, 
                `type`
                from ' . TABLE_SEO_TEMLATES . ' where type = "' . $this->info . '"';
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

    public function getOptions()
    {
        foreach ($this->allowed_fields as $field_name => &$value) {
            if (isset($value['option'])) {
                $this->data['option'][$field_name] = $value['option'];
            }
        }
    }

    public function prepareAllowFields()
    {
        foreach ($this->data['data'] as &$field_names) {
            foreach ($field_names as $field_name => &$value) {
                if (isset($this->data['allowed_fields'][$field_name]['option']) && $field_name == 'type') {
                    $options = $this->data['option'][$field_name];
                    $value =  $options[$value];
                }
            }
        }
    }

    public function selectOne($id)
    {

        $sql = "SELECT 
                `id`, 
                `temlate_name`, 
                `include_ids`, 
                `sort_order`, 
                `status`, 
                `type`
                from " . TABLE_SEO_TEMLATES . " 
                    where id = " . $id;
        if ($id) {
            $this->data['data'] = $this->getResult($sql)[0];
        }
    }

    public function update($data)
    {

        $includesIds = '';
        $id = $data['id'];
        unset($data['id']);

        if (!$data['type']) {
            unset($data['type']);
        }

        if ($data['seo_categories_selected']) {
            $carArr = [];

            foreach ($data['seo_categories_selected'] as $catId) {
                if ($this->catList[$catId]) {
                    $carArr = array_merge_recursive($this->catList[$catId], $carArr);
                }
            }

            $carArr = array_merge_recursive($data['seo_categories_selected'], $carArr);
            $includesIds = ', include_ids ="' . implode(',', $carArr) . '"';
        } elseif ($data['seo_manufacturers_selected']) {
            $includesIds = implode(',', $data['seo_manufacturers_selected']);
            $includesIds = ', include_ids ="' . $includesIds . '"';
        }

        $query = $this->prepareGeneralField($data);
        $query .= $includesIds;

        $sql = 'UPDATE ' . TABLE_SEO_TEMLATES . ' SET ' . $query . ' WHERE id = ' . $id;

        if (!tep_db_query($sql)) {
            return false;
        } else {
            foreach ($data['seo_meta_title'] as $languageId => $text) {
                $sql = 'UPDATE ' . TABLE_SEO_TEMLATES_DESCRIPTION . ' SET meta_title = "' . $text . '", meta_description = "' . $data['seo_meta_description'][$languageId] . '" where seo_templates_id = ' . $id . ' AND language_id = ' . $languageId;
                tep_db_query($sql);
            }
        }
        return true;
    }

    public function insert($data)
    {

        $includesIds = '';
        if ($data['seo_categories_selected']) {
            $carArr = [];

            foreach ($data['seo_categories_selected'] as $catId) {
                if ($this->catList[$catId]) {
                    $carArr = array_merge_recursive($this->catList[$catId], $carArr);
                }
            }

            $carArr = array_merge_recursive($data['seo_categories_selected'], $carArr);
            $includesIds = ', include_ids ="' . implode(',', $carArr) . '"';
        } elseif ($data['seo_manufacturers_selected']) {
            $includesIds = implode(',', $data['seo_manufacturers_selected']);
            $includesIds = ', include_ids ="' . $includesIds . '"';
        }

        $query = $this->prepareGeneralField($data);
        $query .= $includesIds;

        $sql = "INSERT INTO `" . TABLE_SEO_TEMLATES . "` SET {$query}, status = 1";
        if (!tep_db_query($sql)) {
            return false;
        } else {
            $seoTemlatesId = tep_db_insert_id();

            foreach ($data['seo_meta_title'] as $languageId => $text) {
                $sql = 'INSERT INTO ' . TABLE_SEO_TEMLATES_DESCRIPTION . '(seo_templates_id, language_id, meta_title, meta_description) VALUES 
                        (' . $seoTemlatesId . ', ' . $languageId . ', "' . $text . '", "' . $data['seo_meta_description'][$languageId] . '")';
                tep_db_query($sql);
            }
        }
        return true;
    }

    public function delete($id)
    {
        tep_db_query("DELETE FROM " . TABLE_SEO_TEMLATES . "  WHERE `{$this->prefix_id}`={$id}");
        tep_db_query("DELETE FROM " . TABLE_SEO_TEMLATES_DESCRIPTION . "  WHERE seo_templates_id = " . $id);
        return true;
    }

    public function getManufacturers()
    {
        $sql = "SELECT m.manufacturers_id, mi.manufacturers_name FROM manufacturers m JOIN manufacturers_info mi on m.manufacturers_id = mi.manufacturers_id WHERE status = '1' and mi.languages_id = {$this->language_id} order by manufacturers_name asc";
        $query = tep_db_query($sql);
        $output = [];
        while ($row = tep_db_fetch_array($query)) {
            $output[] = ['id' => $row['manufacturers_id'],'name' => $row['manufacturers_name']];
        }
        return $output;
    }
}
