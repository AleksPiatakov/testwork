<?php
/**
 * Categories - new categories on solomono. Exclusively on Solomono Market: https://solomono.net
 * @encoding           UTF-8
 * @version            1.0.0
 * @copyright          Copyright (C) 2016 - 2021 Solomono (https://solomono.net). All rights reserved.
 * @license            Solomono Standard Licenses
 * @author             Bokov Oleksandr
 * @support            admin@solomono.net
 */

namespace admin\includes\solomono\app\models\categories;

use admin\includes\solomono\app\core\Model;

/**
 * Class categories
 * @package admin\includes\solomono\app\models\categories
 */
class categories extends Model
{

    protected $allowed_fields = [
        'categories_name' => [
            'label' => TEXT_EDIT_CATEGORIES_NAME,
            'type' => 'text'
        ],
        'categories_heading_title' => [
            'label' => TEXT_EDIT_CATEGORIES_HEADING_TITLE,
            'type' => 'text'
        ],
        'categories_seo_url' => [
            'label' => CATEGORIES_SEO_URL_TITLE,
            'type' => 'text',
            'show' => false,
        ],
        'categories_meta_title' => [
            'label' => TEXT_META_TITLE,
            'type' => 'text',
            'show' => false,
        ],
        'categories_meta_description' => [
            'label' => TEXT_META_DESCRIPTION,
            'type' => 'text',
            'show' => false,
        ],
        'categories_meta_keywords' => [
            'label' => TEXT_META_KEYWORDS,
            'type' => 'text',
            'show' => false,
        ],
        'categories_description' => [
            'label' => TEXT_EDIT_CATEGORIES_DESCRIPTION,
            'type' => 'textarea',
            'ckeditor' => true,
            'row' => 10,
            'show' => false
        ],
        'categories_image' => [
            'label' => TEXT_EDIT_CATEGORIES_IMAGE,
            'general' => 'file',
            'show' => false,
        ],
        'categories_icon' => [
            'label' => TEXT_EDIT_CATEGORIES_ICON,
            'general' => 'file',
            'show' => false,
        ],
        'sort_order' => [
            'label' => TEXT_EDIT_SORT_ORDER,
            'show' => false,
            'general' => 'number',
        ],
        'сategory_background' => [
            'label' => TEXT_EDIT_CATEGORIES_BACKGROUND,
            'show' => false,
            'general' => 'text',
        ],
        'date_added' => [
            'label' => TEXT_DATE_ADDED,
            'general' => 'disabled',
            'show' => false,
        ],
        'last_modified' => [
            'label' => TEXT_LAST_MODIFIED,
            'general' => 'disabled',
            'show' => false,
        ],
        'categories_status' => [
            'label' => TABLE_HEADING_STATUS,
            'show' => false,
            'general' => 'checkbox',
        ],
        'categories_robots_status' => [
            'label' => TEXT_EDIT_ROBOTS_STATUS,
            'show' => false,
            'general' => 'checkbox',
        ],
        'categories_to_xml' => [
            'label' => TOOLTIP_CATEGORY_GOOGLE_FEED_STATUS,
            'show' => false,
            'general' => 'checkbox',
        ],
        'display_products' => [
            'label' => TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS,
            'show' => false,
            'general' => 'select',
            'option' => [
                'all' => TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_ALL,
                'nothing' => TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_NOTHING,
                'products_ordered' => TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_TOP,
                'featured' => TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_RECOMMENDED,
                'new' => TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_NEW,
            ],
        ],
    ];
    protected $prefix_id = 'categories_id';
    protected $table = 'categories_description';
    private $seoUrl;

    /**
     * @return array
     */
    public function getAllowedFields()
    {
        return $this->allowed_fields;
    }

    /**
     * set SEO_URL
     */
    private function seoUrl()
    {
        $seo_urls = new \SEO_URL($this->language_id);
        $this->seoUrl = $seo_urls;
    }

    /**
     * @return string
     */
    public function getPrefixId()
    {
        return $this->prefix_id;
    }

    /**
     * @param null||int $id
     * @return string
     */
    public function select($id = null)
    {
        $sql = 'SELECT
                  c.' . $this->prefix_id . ' as `id`,
                  c.parent_id,
                  c.sort_order,
                  c.categories_image,
                  c.categories_icon,
                  c.сategory_background,
                  c.display_products,
                  c.categories_to_xml,
                  c.categories_status,
                  c.categories_robots_status,
                  c.date_added,
                  c.last_modified,
                  cd.categories_name,
                  cd.categories_meta_title,
                  cd.categories_meta_description,
                  cd.categories_meta_keywords,
                  cd.categories_description,
                  cd.categories_heading_title,
                  cd.categories_seo_url,
                  cd.language_id
                FROM ' . TABLE_CATEGORIES . ' c 
                RIGHT JOIN ' . TABLE_CATEGORIES_DESCRIPTION . ' cd ON c.categories_id = cd.categories_id ';
        if ($id) {
            return $sql . " WHERE c.{$this->prefix_id} = {$id}";
        }

        $sql .= " WHERE cd.language_id={$this->language_id}";
        $sql .= " ORDER BY c.sort_order, cd.categories_name";
        return $sql;
    }

    public function getOptions() {
        foreach ($this->allowed_fields as $field_name => $value) {
            if (isset($value['option'])) {
                switch($field_name){
                    case 'display_products':
                        $this->data['option'][$field_name] = $value['option'];
                        break;
                    default:
                        parent::optionFields($field_name, $value['option']);
                }
            }
        }
    }

    /**
     * @param int $id
     */
    public function getDescription($id)
    {
        $sql = $this->select($id);
        if ($id) {
            $this->data['data'] = $this->getResultKey($sql, 'language_id');
        }

        $this->getLanguages();
    }

    /**
     * @return array
     */
    public function setTree()
    {
        $new_arr = [];
        foreach ($this->getResult($this->select()) as $key => $value) {
            if ($value['categories_name'] == $_POST['name']) {
                continue;
            }

            $new_arr[$value['id']] = $value;
        }

        return $this->mapTree($new_arr);
    }

    /**
     * @param array $dataset
     * @return array
     */
    public function mapTree($dataset)
    {
        $tree = [];
        foreach ($dataset as $id => &$node) {
            if (!$node['parent_id']) {
                $tree[$id] =& $node;
            } else {
                $dataset[$node['parent_id']]['childs'][$id] =& $node;
            }
        }

        return $tree;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function cntSubCat($id)
    {
        global $cat_list, $tep_get_category_tree;
        $result['categories'] = tep_get_newcategories_tree($id, $cat_list, $tep_get_category_tree);
        $sql = 'select 
                    ptc.products_id,
                    p.products_image
                from 
                    ' . TABLE_CATEGORIES . ' t
                    right join ' . TABLE_PRODUCTS_TO_CATEGORIES . ' ptc on ptc.categories_id = t.categories_id
                    left join  ' . TABLE_PRODUCTS_DESCRIPTION . ' pd on ptc.products_id = pd.products_id
                    left join  ' . TABLE_PRODUCTS . ' p on pd.products_id = p.products_id
                where 
                    t.categories_id = ' . $id . ' or 
                    t.parent_id = ' . $id;
        $result['products'] = $this->getResult($sql);

        return $result;
    }

    /**
     * @param int $from
     * @param int $to
     * @return bool
     */
    public function moveTo($from, $to)
    {
        global $cat_list, $tep_get_category_tree;

        $cat = tep_get_newcategories_tree($from,  $cat_list, $tep_get_category_tree);
        $ids = [];
        foreach ($cat as $item) {
            $ids[] = $item['id'];
        }

        $ids_exp = implode(', ', $ids);
        $sql = 'UPDATE ' . TABLE_CATEGORIES . ' set parent_id = ' . $to . ' WHERE categories_id in (' . $ids_exp . ')';
        if (!tep_db_query($sql)) {
            return false;
        }

        return true;
    }

    /**
     * @param int $id
     */
    public function confirmDelete($id)
    {
        $result = $this->cntSubCat($id);
        $ids = [];
        foreach ($result['categories'] as $category) {
            $ids[] = $category['id'];
        }

        $ids_imp = implode(",", $ids);
        $dbTables = [
            TABLE_CATEGORIES_DESCRIPTION,
            TABLE_CATEGORIES,
            TABLE_PRODUCTS_TO_CATEGORIES
        ];
        $this->delFiles($ids_imp, 'categories_image, categories_icon', TABLE_CATEGORIES);
        foreach ($dbTables as $table) {
            tep_db_query('delete from `' . $table . '` where categories_id in(' . $ids_imp . ')');
        }

        if (!empty($result['products'])) {
            $product = new products();
            $product->deleteProducts($result['products']);
        }
    }

    /**
     * @param string $ids
     * @param stirng $field
     * @param null|string $table
     */
    public function delFiles($ids, $field, $table = null) {
        $table = is_null($table) ? $this->table : $table;
        $sql = 'SELECT ' . $field . ' FROM ' . $table . ' WHERE ' . $this->prefix_id . ' in(' . $ids . ')';
        $files = $this->getResult($sql);
        $file_path = DIR_FS_CATALOG . DIR_WS_IMAGES;
        $f = $file_path . $table . DIRECTORY_SEPARATOR;
        foreach ($files as $file) {
            if (is_array($file)) {
                foreach ($file as $images) {
                    if (is_file($f . $images)) {
                        @unlink($f . $images);
                    }
                }
            }
        }
    }

    /**
     * @param string $field_name
     * @param null $id
     * @param null $path
     * @param array $allowed_types
     * @return bool
     */
    public function checkFile($field_name, $id = null, $path = null, $allowed_types = []) {
        $path = is_null($path) ? $this->table : $path;
        if (!empty($allowed_types) && !in_array($_FILES[$field_name]['type'], $allowed_types)) {
            return false;
        }

        if (!empty($_FILES[$field_name]['name']) && $_FILES[$field_name]['error'] == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES[$field_name]["tmp_name"];
            $name = basename($_FILES[$field_name]["name"]);
            $ext = substr($name, strpos($name,'.'), strlen($name) - 1);
            $name = uniqid('file_') . $ext;

            if (!is_null($id)) {
                $this->delFiles($id, $field_name, $path);
            }

            if ($this->moveUploadFile($tmp_name, $name, $path)) {
                $_POST[$field_name] = $name;
            }
        }

        return true;
    }

    /**
     * @param array $data
     * @return false|string
     */
    protected function prepareGeneralField(&$data, $glue = ', ')
    {
        $this->seoUrl();
        $query = [];
        foreach ($data as $k => $v) {
            if (!is_array($v)) {
                $v = tep_db_prepare_input($v);
                $query[] = "`{$k}` = " . '\'' . tep_db_input($v) . '\'';
                unset($data[$k]);
            }
        }
    
        return implode($glue, $query);
    }

    /**
     * @param array $data
     * @param int $id
     * @param string $action
     * @param string $table
     * @param string $lang
     * @return bool
     */
    protected function insertUpdate($data, $id, $action = 'update', $table = null, $lang = 'language_id')
    {
        $table = $table ?: $this->table;
        $this->getLanguages();
        $languages = $this->data['languages'];
        $sql = '';
        foreach ($languages as $k => $v) {
            $query = '';
            foreach ($data as $key => $value) {
                $value = tep_db_prepare_input($value[$k]);
                if ($key === 'categories_seo_url' && empty($value)) {
                    $query .= "`{$key}` = " . '\'' . $this->seoUrl->strip($data['categories_name'][$k]) . '\', ';
                } else {
                    $query .= "`{$key}` = " . '\'' . tep_db_input($value) . '\', ';
                }
            }

            $query .= "`{$this->prefix_id}`= {$id}, `{$lang}`={$k}";
            if ($action == 'update') {
                $sql = "INSERT INTO `{$table}` SET {$query} ON DUPLICATE KEY UPDATE {$query}";
            } elseif ($action == 'insert') {
                $sql = "INSERT INTO `{$table}` SET {$query}";
            }

            if (!tep_db_query($sql)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function update($data)
    {
        $id = $data['id'];
        unset($data['id']);
        unset($data['old_tpath']);
        $data = $this->setCheckbox($data);
        $query = $this->prepareGeneralField($data);
        if ($this->insertUpdate($data, $id, __FUNCTION__, TABLE_CATEGORIES_DESCRIPTION, 'language_id')) {
            $sql = "UPDATE " . TABLE_CATEGORIES
                . " SET {$query}, last_modified=now() WHERE {$this->prefix_id} = {$id}";
            if (!tep_db_query($sql)) {
                return false;
            }
        } else {
            return false;
        }

        return true;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function insert($data)
    {
        $id = tep_db_fetch_array(
            tep_db_query("select max($this->prefix_id)+1 as next_id from " . TABLE_CATEGORIES_DESCRIPTION)
        )['next_id'] ?: 1;
        $data = $this->setCheckbox($data);
        $query = $this->prepareGeneralField($data);
        if ($this->insertUpdate($data, $id, __FUNCTION__, TABLE_CATEGORIES_DESCRIPTION, 'language_id')) {
            $sql = "INSERT INTO `" . TABLE_CATEGORIES
                . "` SET {$query},`parent_id`=0,`categories_id`='{$id}',`date_added`=now()";
            if (!tep_db_query($sql)) {
                return false;
            }
        } else {
            return false;
        }

        return true;
    }

    /**
     * @param array $data
     * @return array
     */
    private function setCheckbox($data)
    {
        $keys = [
            'categories_to_xml',
            'categories_robots_status',
            'categories_status',
        ];

        foreach ($keys as $key) {
            if (isset($data[$key])) {
                $data[$key] = $data[$key] == 'on' ? 1 : 0;
            }
        }

        return $data;
    }
}
