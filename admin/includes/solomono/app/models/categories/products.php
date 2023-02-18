<?php
/**
 * Products - new categories on solomono. Exclusively on Solomono Market: https://solomono.net
 * @encoding           UTF-8
 * @version            1.0.0
 * @copyright          Copyright (C) 2016 - 2021 Solomono (https://solomono.net). All rights reserved.
 * @license            Solomono Standard Licenses
 * @author             Bokov Oleksandr
 * @support            admin@solomono.net
 */

namespace admin\includes\solomono\app\models\categories;

use admin\includes\solomono\app\core\Model;

include_once(DIR_ROOT . '/' . DIR_WS_CLASSES . 'seo.class.php');

/**
 * Class products
 * @package admin\includes\solomono\app\models\categories
 * (show===false) - not show in table
 * if (type==disabled) show in form like input disabled
 * if (general) show in form into left column && value is type
 * if (exist 'type') show in form else not show
 * if ('type' == textarea && ckeditor) show text in plugin
 * to set style,example:
 * #own_table.products>thead>tr>th[data-table="sort_order"]
 */
class products extends Model
{
    protected $allowed_fields = [
        'products_sort_order' => [
            'label' => TEXT_EDIT_SORT_ORDER,
            'sort' => true,
            'general' => 'number',
            'required' => true,
            'default' => '1'
        ],
        'products_name' => [
            'label' => HEADING_TITLE_NAME,
            'type' => 'text',
            'filter' => true,
        ],
        'products_info' => [
            'label' => TEXT_PRODUCTS_INFO,
            'type' => 'text',
            'filter' => true,
        ],
        'products_head_title_tag' => [
            'label' => TEXT_PRODUCTS_HEAD_TITLE_TAG,
            'type' => 'text',
            'show' => false,
        ],
        'products_head_desc_tag' => [
            'label' => 'Meta Description',
            'type' => 'textarea',
            'rows' => 1,
            'show' => false,
        ],
        'products_head_keywords_tag' => [
            'label' => TEXT_PRODUCTS_HEAD_KEYWORDS_TAG,
            'type' => 'text',
            'show' => false,
        ],
        'products_url' => [
            'label' => TEXT_PRODUCTS_URL,
            'type' => 'text',
            'show' => false,
        ],
        'products_description' => [
            'label' => TEXT_PRODUCTS_DESCRIPTION,
            'type' => 'textarea',
            'ckeditor' => true,
            'rows' => 10,
            'show' => false,
        ],
        'products_robots_status' => [
            'label' => TEXT_EDIT_ROBOTS_STATUS,
            'general' => 'select',
           'option' => array(
                '0'=> TEXT_EDIT_ROBOTS_STATUS_OFF,
                '1'=> TEXT_EDIT_ROBOTS_STATUS_ON
            ),
            'show' => false,
        ],
        'products_date_added' => [
            'label' => TEXT_DATE_ADDED,
            'general' => 'disabled',
            'show' => false,
        ],
        'products_last_modified' => [
            'label' => TEXT_LAST_MODIFIED,
            'general' => 'disabled',
            'show' => false,
        ],
        'status' => [
            'label' => TABLE_HEADING_STATUS,
        ],

    ];
    protected $prefix_id = 'products_id';
    protected $table = 'products_description';
    private $seoUrl;

    /**
     * @return string
     */
    public function select()
    {
        global $cat_list, $tep_get_category_tree;
        $xsell = $_GET['xsell'] == 'yes' ?
            ' RIGHT JOIN ' . TABLE_PRODUCTS_XSELL . ' px on px.products_id=ptc.products_id ' : '';
        $sql = 'SELECT DISTINCT 
                ptc.products_id AS id,
                pd.products_name,
                p.products_status AS status,     
                p.products_sort_order
            FROM 
                ' . TABLE_PRODUCTS_TO_CATEGORIES . ' ptc
                LEFT JOIN ' . TABLE_PRODUCTS_DESCRIPTION . ' pd ON pd.products_id = ptc.products_id
                LEFT JOIN ' . TABLE_PRODUCTS . ' p ON p.products_id = pd.products_id
                ' . $xsell . '
            WHERE 
                pd.language_id = ' . $this->language_id;

        if (!empty($_GET['tPath'])) {
            $ids = [];
            $c_ids = tep_get_newcategories_tree($_GET['tPath'], $cat_list, $tep_get_category_tree);
            foreach ($c_ids as $category) {
                $ids[] = $category['id'];
            }

            if (!empty($ids)) {
                $ids_imp = implode(",", $ids);
                $this->debug($ids_imp, __METHOD__, 'p');
                $sql .= ' AND ptc.categories_id in(' . $ids_imp . ')';
            } else {
                $this->debug($_GET['tPath'], __METHOD__, 'p');
                $sql .= ' AND ptc.categories_id in(' . $_GET['tPath'] . ')';
            }
        }

        return $sql;
    }

    /**
     * @param int $id
     */
    public function selectOne($id)
    {
        if ($id) {
            $sql = 'SELECT
                  ptc.products_id AS id,
                  ptc.categories_id,
                  pd.language_id,
                  pd.products_name,
                  pd.products_info,
                  pd.products_head_title_tag,
                  pd.products_head_desc_tag,
                  pd.products_head_keywords_tag,
                  pd.products_description,
                  p.products_image,
                  p.products_robots_status,
                  DATE(p.products_date_available) products_date_available,
                  pd.products_url,
                  p.products_status AS status,
                  p.products_date_added,
                  p.products_last_modified,
                  p.products_sort_order
                FROM ' . TABLE_PRODUCTS_TO_CATEGORIES . ' ptc
                  LEFT JOIN ' . TABLE_PRODUCTS_DESCRIPTION . ' pd ON pd.products_id = ptc.products_id
                  LEFT JOIN ' . TABLE_PRODUCTS . ' p ON p.products_id = pd.products_id
                  WHERE ptc.' . $this->prefix_id . ' = ' . $id;
            $this->data['data'] = $this->getResultKey($sql, 'language_id');
            $this->data['tPath'] = current($this->data['data'])['categories_id'];
        }

        $this->data['allowed_fields']['products_date_available']['default'] = date('Y-m-d');
        $this->getLanguages();
        $this->getXsell($id);
    }

    /**
     * @param string $table
     */
    public function setTable($table = TABLE_PRODUCTS)
    {
        $this->table = $table;
    }

    /**
     * @param string $search
     * @return array
     */
    public function getProduct($search)
    {
        $sql = 'SELECT
                p.products_id as id,
                p.products_model  as model,
                pd.products_name  as label
            FROM 
                ' . TABLE_PRODUCTS . ' p
                LEFT JOIN ' . TABLE_PRODUCTS_DESCRIPTION . ' pd ON pd.products_id = p.products_id
            WHERE 
                p.products_id LIKE "%' . $search . '%" OR
                p.products_model LIKE "%' . $search . '%" OR 
                pd.products_name LIKE "%' . $search . '%" AND 
                pd.language_id = ' . $this->language_id . '
                LIMIT 10';
        return $this->getResult($sql);
    }

    /**
     * @param int $productId
     * @param int $xsellId
     * @return bool|mysqli_result
     */
    public function addProduct($productId, $xsellId)
    {
        return tep_db_query(
            'INSERT INTO ' . TABLE_PRODUCTS_XSELL . ' SET products_id = ' . $productId . ', xsell_id = ' . $xsellId
        );
    }

    /**
     * @param int $products_id
     * @param int $xsellId
     * @return bool|mysqli_result
     */
    public function delXsell($products_id, $xsellId)
    {
        return tep_db_query(
            'DELETE FROM ' .
            TABLE_PRODUCTS_XSELL .
            ' WHERE 
                products_id = ' . $products_id . ' AND 
                xsell_id = ' . $xsellId
        );
    }

    /**
     * @param array $arr
     */
    public function deleteProducts($arr)
    {
        $ids = [];
        foreach ($arr as $item) {
            $ids[] = $item['products_id'];
            $file = DIR_FS_CATALOG_IMAGES . 'products/' . $item['products_image'];
            if (!empty($item['products_image']) && is_file($file)) {
                @unlink($file);
            }
        }

        $ids_imp = implode(",", $ids);
        $dbTables = [
            TABLE_PRODUCTS_DESCRIPTION,
            TABLE_PRODUCTS
        ];
        foreach ($dbTables as $table) {
            tep_db_query('delete from ' . $table . ' where products_id in(' . $ids_imp . ')');
        }
    }

    /**
     * @param int $id
     * @param int|bool $tPath
     * @return bool
     */
    public function deleteProduct($id, $tPath)
    {
        if ($this->checkLink($id, $tPath)) {
            return true;
        }

        $dbTables = [
            TABLE_PRODUCTS_DESCRIPTION,
            TABLE_PRODUCTS,
            TABLE_PRODUCTS_TO_CATEGORIES
        ];
        $this->delFiles($id, 'products_image', TABLE_PRODUCTS);
        foreach ($dbTables as $table) {
            if (tep_db_query('DELETE FROM ' . $table . ' where products_id = ' . $id)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param int $id
     * @param string $field
     * @param string|null $table
     */
    public function delFiles($id, $field, $table = null)
    {
        $table = is_null($table) ? $this->table : $table;
        $sql = "SELECT {$field} FROM {$table} WHERE {$this->prefix_id} = {$id}";
        $files = $this->getResult($sql);
        foreach ($files as $v) {
            if ($v[$field] !== null) {
                $file_path = DIR_FS_CATALOG . DIR_WS_IMAGES;
                $path = '';
                if (file_exists($path = $file_path . $v[$field])) {
                    @unlink($path);
                } elseif (file_exists($path = $file_path . $this->table . DIRECTORY_SEPARATOR . $v[$field])) {
                    @unlink($path);
                }
            }
        }
    }

    /**
     * @param array $data
     * @return array|bool
     */
    public function insert($data)
    {
        $id = tep_db_fetch_array(
            tep_db_query('SELECT max(' . $this->prefix_id . ') + 1 AS next_id FROM ' . TABLE_PRODUCTS)
        )['next_id'] ?: 1;

        if (!tep_db_query($this->productsToCategories($data, __FUNCTION__, $id))) {
            return false;
        }

        $query = $this->prepareGeneralField($data);
        if ($this->insertUpdate($data, $id, __FUNCTION__, TABLE_PRODUCTS_DESCRIPTION)) {
            $sql = 'INSERT INTO ' . TABLE_PRODUCTS . ' SET ' . $query . ', products_id = ' . (int)$id . ', products_date_added = now()';
            if (!tep_db_query($sql)) {
                return false;
            }
        }

        return [
            'success' => true,
            'id' => $id
        ];
    }

    /**
     * @param array $data
     * @return bool
     */
    public function update($data)
    {
        $id = $data['id'];
        unset($data['id']);
        if (!tep_db_query($this->productsToCategories($data, __FUNCTION__, $id))) {
            return false;
        }

        $query = $this->prepareGeneralField($data);
        if ($this->insertUpdate($data, $id, __FUNCTION__, TABLE_PRODUCTS_DESCRIPTION)) {
            $sql = 'UPDATE ' .
                TABLE_PRODUCTS .
                ' SET products_last_modified = now(), ' . $query . ' WHERE ' . $this->prefix_id . ' = ' . $id;
            if (!tep_db_query($sql)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param array $data
     */
    public function duplicate($data)
    {
        tep_db_query('INSERT INTO ' . TABLE_PRODUCTS .
            ' (products_date_added, products_date_available, products_status, products_sort_order, products_image) 
            SELECT
                NOW(),
                products_date_available,
                0,
                products_sort_order,
                products_image
            FROM ' . TABLE_PRODUCTS . ' 
            WHERE products_id = ' . (int)$data['id']
        );
        $dup_id = tep_db_insert_id();
        $description_query = tep_db_query(
            "SELECT
              pd.language_id,
              pd.products_name,
              pd.products_description,
              pd.products_url,
              pd.products_head_title_tag,
              pd.products_head_desc_tag,
              pd.products_head_keywords_tag,
              pd.products_info,
              p.products_image
          FROM " . TABLE_PRODUCTS_DESCRIPTION . " as pd
          INNER JOIN " . TABLE_PRODUCTS . " as p
          ON p.products_id = pd.products_id
          WHERE pd.products_id = " . (int)$data['id']
        );
        $olgImg = "";
        while ($description = tep_db_fetch_array($description_query)) {
            $olgImg = $description['products_image'];
            tep_db_query(
                'INSERT INTO ' . TABLE_PRODUCTS_DESCRIPTION . '
                (
                    products_id, 
                    language_id, 
                    products_name, 
                    products_description, 
                    products_url, 
                    products_head_title_tag, 
                    products_head_desc_tag, 
                    products_head_keywords_tag, 
                    products_info, 
                    products_viewed
                )
                VALUES 
                (' .
                    (int)$dup_id . ', ' .
                    (int)$description['language_id'] . ', "' .
                    tep_db_input($description['products_name']) . '", "' .
                    tep_db_input($description['products_description']) . '", "' .
                    tep_db_input($description['products_url']) . '",  "' .
                    tep_db_input($description['products_head_title_tag']) . '", "' .
                    tep_db_input($description['products_head_desc_tag']) . '", "' .
                    tep_db_input($description['products_head_keywords_tag']) . '", "' .
                    tep_db_input($description['products_info']) . '", 
                    0
                )'
            );
        }

        if ($olgImg) {
            // переіменовуємо всі картинки в нові:
            $new_images_str = tep_rename_images($olgImg, ';');
            tep_db_query(
                "UPDATE " . TABLE_PRODUCTS . "
                SET products_image = '" . $new_images_str . "'
                WHERE products_id = " . (int)$dup_id
            );
        }

        tep_db_query(
            "INSERT INTO " .
            TABLE_PRODUCTS_TO_CATEGORIES .
            " (products_id, categories_id) VALUES (" . (int)$dup_id . ", " . (int)$data['categories_id'] . ")"
        );
    }

    /**
     * @param array $data
     */
    public function link($data)
    {
        $check_query = tep_db_query(
            "SELECT count(*) AS total FROM " .
            TABLE_PRODUCTS_TO_CATEGORIES .
            " WHERE products_id = " . (int)$data['id'] . " AND categories_id = " . (int)$data['categories_id']
        );
        $check = tep_db_fetch_array($check_query);
        if ($check['total'] < '1') {
            tep_db_query(
                "INSERT INTO " . TABLE_PRODUCTS_TO_CATEGORIES .
                " (products_id, categories_id) VALUES (" . (int)$data['id'] . ", " . (int)$data['categories_id'] . ")"
            );
        }
    }

    /**
     * @param array $data
     */
    public function move($data)
    {
        $check_query = tep_db_query(
            "SELECT count(*) AS total FROM " . TABLE_PRODUCTS_TO_CATEGORIES .
            " WHERE products_id = " . (int)$data['id'] . " AND categories_id = " . (int)$data['categories_id']
        );
        $check = tep_db_fetch_array($check_query);
        if ($check['total'] < '1' && isset($data['current_category'])) {
            tep_db_query(
                "UPDATE " . TABLE_PRODUCTS_TO_CATEGORIES .
                " SET categories_id = " . (int)$data['categories_id'] .
                " WHERE products_id = " . (int)$data['id'] . " AND categories_id = " . (int)$data['current_category']
            ); // current_category
        }
    }

    /**
     * return options by field name
     */
    public function getOptions()
    {
        foreach ($this->allowed_fields as $field_name => $value) {
            if (isset($value['option'])) {
                switch ($field_name) {
                    case 'products_robots_status':
                        $this->data['option'][$field_name] = $value['option'];
                        break;
                    default:
                        parent::optionFields($field_name, $value['option']);
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
        if(!empty($allowed_types) && !in_array($_FILES[$field_name]['type'], $allowed_types)){
            return false;
        }

        if (!empty($_FILES[$field_name]['name']) && $_FILES[$field_name]['error'] == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES[$field_name]["tmp_name"];
            $name = basename($_FILES[$field_name]["name"]);
            if (!is_null($id)) {
                $this->delFile($id, $field_name);
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
                $v = html_entity_decode(tep_db_prepare_input($v));
                $query[] = "`{$k}` = " . '\'' . tep_db_input($v) . '\'';
                unset($data[$k]);
            }
        }
        return implode($glue, $query);
    }

    /**
     * @param array $request
     * @return string
     */
    protected function order($request)
    {
        $request['order'] = $request['order'] ?: 'products_sort_order-asc';
        return parent::order($request);
    }

    /**
     * @param array $data
     * @param string $action
     * @param int $id
     * @return string
     */
    private function productsToCategories(&$data, $action, $id)
    {
        $sql = '';
        switch ($action) {
            case 'insert':
                $sql = 'INSERT INTO ' . TABLE_PRODUCTS_TO_CATEGORIES . ' 
                            (products_id, categories_id) 
                        VALUES 
                            (' . (int)$id . ', ' . (int)$data['categories_id'] . ') 
                        ON DUPLICATE KEY UPDATE 
                            categories_id = ' . (int)$data['categories_id'] . ', ' . $this->prefix_id . ' = ' . (int)$id;
                break;
            case 'update':
                $sql = 'UPDATE ' . TABLE_PRODUCTS_TO_CATEGORIES .
                    ' SET categories_id = ' . (int)$data['categories_id'] .
                    ' WHERE ' . $this->prefix_id . ' = ' . (int)$id . ' AND categories_id = ' . (int)$data['old_tpath'];
                break;
        }

        unset($data['categories_id'], $data['old_tpath']);
        return $sql;
    }

    /**
     * @param int $products_id
     */
    private function getXsell($products_id)
    {
        $sql = 'SELECT
                px.xsell_id,
                px.products_id,
                pd.products_name 
            FROM 
                ' . TABLE_PRODUCTS_XSELL . ' px 
                LEFT JOIN ' . TABLE_PRODUCTS_DESCRIPTION . ' pd ON pd.products_id = px.xsell_id 
            WHERE 
                px.products_id = "' . $products_id . '" AND 
                pd.language_id = ' . $this->language_id;

        $this->data['xsell'] = $this->getResult($sql);
    }

    /**
     * @param int $id
     * @param int|bool $tPath
     * @return bool
     */
    private function checkLink($id, $tPath)
    {
        $res = false;
        $check_query = tep_db_query(
            'SELECT ' .
            $this->prefix_id .
            ' FROM ' .
            TABLE_PRODUCTS_TO_CATEGORIES .
            ' WHERE ' .
            $this->prefix_id . ' = ' . $id
        );
        if ($check_query->num_rows > 1 && $tPath) {
            tep_db_query(
                'DELETE FROM ' .
                TABLE_PRODUCTS_TO_CATEGORIES .
                ' where 
                    products_id = ' . $id . ' and 
                    categories_id = ' . $tPath
            );
            $res = true;
        }

        return $res;
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
        foreach ($languages as $k => $v) {
            $query = '';
            foreach ($data as $key => $value) {
                $value = tep_db_prepare_input($value[$k]);
                if ($key == 'products_url' && empty($value)) {
                    $value = preg_replace(
                        "/[^-a-z0-9]/",
                        "",
                        $this->seoUrl->strip($data['products_name'][$k])
                    );
                }
                $query .= "`{$key}` = " . '\'' . tep_db_input($value) . '\', ';
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
     * added seoUrl
     */
    private function seoUrl()
    {
        $seo_urls = new \SEO_URL($this->language_id);
        $this->seoUrl = $seo_urls;
    }
}