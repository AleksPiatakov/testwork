<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 25.07.2017
 * Time: 13:03
 */

namespace admin\includes\solomono\app\models\seo_filter;
use admin\includes\solomono\app\core\Model;

include_once(DIR_ROOT . '/' . DIR_WS_CLASSES . 'seo.class.php');

class seo_filter extends Model {

    protected $allowed_fields = [
        'title' => [
            'label' => TEXT_SEO_FILTER_TITLE,
            'type' => 'text',
            'filter' => true,
        ],
        'description' => [
            'label' => TEXT_SEO_FILTER_DESCRIPTION,
            'type'=>'textarea',
            'rows' => 3,
            'show'=>false,
            'ckeditor'=>true
        ],
        'meta_title' => [
            'label' => TEXT_SEO_FILTER_META_TITLE,
            'type' => 'text',
            'show' => false,
            'filter' => true,
        ],
        'meta_description' => [
            'label' => TEXT_SEO_FILTER_META_DESCRIPTION,
            'type' => 'text',
            'show' => false,
            'filter' => true,
        ],
        'seo_url' => [
            'label' => TEXT_SEO_FILTER_SEO_URL,
            'type' => 'text',
            'show' => false,
            'filter' => true,
        ],
        'categories_name' => [
            'label' => TEXT_SEO_FILTER_CATEGORIES_NAME,
            'general' => 'select',
            'show' => true,
            'filter' => true,
        ],
        'manufacturers_name' => [
            'label' => TEXT_SEO_FILTER_MANUFACTURERS_NAME,
            'general' => 'select',
            'show' => true,
            'filter' => true,
        ],
        'filter_1' => [
            'label' => TEXT_SEO_FILTER_F_NAME_1,
            'general' => 'select',
            'show' => true,
            'filter' => true,
        ],
        'filter_2' => [
            'label' => TEXT_SEO_FILTER_F_NAME_2,
            'general' => 'select',
            'show' => true,
            'filter' => true,
        ],
    ];

    protected $prefix_id = 'id';

    public function select() {

        $sql = "SELECT sf.id,
                       sfd.language_id,
                       sf.manufacturers_id,
                       sf.categories_id,
                       sf.filter_id_1,
                       sf.filter_id_2,
                       sfd.title
                FROM seo_filter sf
                LEFT JOIN seo_filter_description sfd
                       ON sfd.id = sf.id
                WHERE sfd.language_id = '{$this->language_id}'";
        return $sql;
    }

    public function getManufacturersNames() {
        $sql = "SELECT manufacturers_name,
                       manufacturers_id
                FROM manufacturers_info where languages_id = {$this->language_id}";

        $manufacturers = [0 => " --- "];
        $query = tep_db_query($sql);
        while ($row = tep_db_fetch_array($query)) {
            $manufacturers[$row['manufacturers_id']] = $row['manufacturers_name'];
        }

        return $manufacturers;
    }

    public function getCategoriesNames() {
        $sql = "SELECT categories_name,
                       categories_id
                FROM categories_description
                WHERE language_id = '" . $this->language_id . "'";

        $categories = [0 => "---"];
        $query = tep_db_query($sql);
        while ($row = tep_db_fetch_array($query)) {
            $categories[$row['categories_id']] = $row['categories_name'];
        }
        return $categories;
    }

    public function getFiltersNames() {
        $sql = "SELECT products_options_values_name,
                       products_options_values_id
                FROM products_options_values
                WHERE language_id = '" . $this->language_id . "'";

        $filters = [0 => "---"];
        $query = tep_db_query($sql);
        while ($row = tep_db_fetch_array($query)) {
            $filters[$row['products_options_values_id']] = $row['products_options_values_name'];
        }

        return $filters;
    }

    public function getFiltersOptionsName() {
        $sql = "SELECT products_options_name,
                       products_options_id
                FROM products_options
                WHERE language_id = '" . $this->language_id . "'";

        $filters = [0 => "---"];
        $query = tep_db_query($sql);
        while ($row = tep_db_fetch_array($query)) {
            $filters[$row['products_options_id']] = $row['products_options_name'];
        }
        return $filters;
    }

//    public function filter($request) {
//
//
//        var_dump($request); die;
//
//    }

    public function getOptionsToFilters() {
        $sql = "SELECT products_options_id,
                       products_options_values_id
                  FROM products_options_values_to_products_options
                  GROUP BY products_options_values_id";

        $res = [];
        $query = tep_db_query($sql);
        while ($row = tep_db_fetch_array($query)) {
            $res[$row['products_options_id']][] = $row['products_options_values_id'];
        }

        return $res;
    }

    public function selectOne($id) {
        if ($id) {
            $sql = "SELECT sf.id,
                           sfd.language_id,
                           sf.manufacturers_id,
                           sf.categories_id,
                           sf.filter_id_1,
                           sf.filter_id_2,
                           sfd.title,
                           sfd.description,
                           sfd.meta_title,
                           sfd.meta_description,
                           sfd.seo_url
                    FROM seo_filter sf
                    LEFT JOIN seo_filter_description sfd
                           ON sfd.id = sf.id 
                    WHERE sf.id = '{$id}'";
            $this->data['data'] = $this->getResultKey($sql, 'language_id');
        }
        $this->getLanguages();
    }

    public function getProduct($search) {
        $sql = "SELECT
                  `p`.`products_id` as id,
                  `p`.`products_model`  as model,
                  `pd`.`products_name`  as label
                FROM `products` `p`
                  LEFT JOIN `products_description` `pd` ON `pd`.`products_id` = `p`.`products_id`
                WHERE `p`.`products_id` LIKE '{$search}%' OR `p`.`products_model` LIKE '%{$search}%' OR `pd`.`products_name` LIKE '%{$search}%' AND `pd`.`language_id` = '{$this->language_id}'
                LIMIT 10";
        return $this->getResult($sql);
    }

    public function deleteSeoFilter($id) {

        if (!tep_db_query("DELETE FROM `seo_filter_description` where `id`={$id}")) {
            return false;
        };
        if (!tep_db_query("DELETE FROM `seo_filter` where `id`={$id}")) {
            return false;
        }
        return true;
    }

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

    public function insert($data) {
        $id = tep_db_fetch_array(tep_db_query("SELECT max(`id`)+1 AS `next_id` FROM `seo_filter`"))['next_id']?:1;

        $filter_1 = min($data['filter_1'],$data['filter_2']);
        $filter_2 = max($data['filter_1'],$data['filter_2']);
        if (!$filter_1 && ($tempFilter = $filter_1) < $filter_2){
            $filter_1 = $filter_2;
            $filter_2 = $tempFilter;
        }
        $arr = [
            "categories_id"    => tep_db_input($data['categories_name']),
            "manufacturers_id" => tep_db_input($data['manufacturers_name']),
            "filter_id_1"      => tep_db_input($filter_1),
            "filter_id_2"      => tep_db_input($filter_2)
        ];

        unset($data['categories_name']);
        unset($data['manufacturers_name']);
        unset($data['filter_1']);
        unset($data['filter_2']);

        $queryString = "";
        foreach ($arr as $k => $v) {
            $queryString .= "{$k} = '{$v}',";
        }
        $queryString = mb_substr($queryString, 0, -1);

        if ($this->insertUpdate($data, $id, __FUNCTION__, 'seo_filter_description')) {
            $sql = "INSERT INTO `seo_filter` SET {$queryString},`id`='{$id}'";
            if (!tep_db_query($sql)) {
                return false;
            }
        }
        return $id;
    }

    public function update($data) {
        $id = $data['id'];
        unset($data['id']);

        $filter_1 = min($data['filter_1'],$data['filter_2']);
        $filter_2 = max($data['filter_1'],$data['filter_2']);
        if (!$filter_1 && ($tempFilter = $filter_1) < $filter_2){
            $filter_1 = $filter_2;
            $filter_2 = $tempFilter;
        }
        $queryData = [
            "categories_id = '" . tep_db_input(tep_db_prepare_input($data["categories_name"])) . "'",
            "manufacturers_id = '" . tep_db_input(tep_db_prepare_input($data["manufacturers_name"])) . "'",
            "filter_id_1 = '" . tep_db_input(tep_db_prepare_input($filter_1)) . "'",
            "filter_id_2 = '" . tep_db_input(tep_db_prepare_input($filter_2)) . "'"
        ];

        $queryStr = implode(", ", $queryData);

        unset($data["categories_name"]);
        unset($data["manufacturers_name"]);
        unset($data["filter_1"]);
        unset($data["filter_2"]);

        if ($this->insertUpdate($data, $id, __FUNCTION__, 'seo_filter_description')) {
            $sql = "UPDATE `seo_filter` SET {$queryStr} WHERE {$this->prefix_id}={$id} ";
            if (!tep_db_query($sql)) {
                return false;
            }

        }
        return true;
    }

    public function link($data) {
        $check_query = tep_db_query("SELECT count(*) AS `total` FROM " . TABLE_ARTICLES_TO_TOPICS . " WHERE `articles_id` = '" . (int)$data['id'] . "' AND topics_id = '" . (int)$data['topics_id'] . "'");
        $check = tep_db_fetch_array($check_query);
        if ($check['total']<'1') {
            tep_db_query("INSERT INTO " . TABLE_ARTICLES_TO_TOPICS . " (`articles_id`, `topics_id`) VALUES ('" . (int)$data['id'] . "', '" . (int)$data['topics_id'] . "')");
        }
    }

}