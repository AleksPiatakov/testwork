<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 14.06.2017
 * Time: 15:22
 */

namespace admin\includes\solomono\app\models\manufacturers;

use admin\includes\solomono\app\core\Model;

include_once(DIR_ROOT . '/' . DIR_WS_CLASSES . 'seo.class.php');

class manufacturers extends Model
{

    protected $allowed_fields = [
        'manufacturers_name' => [
            'label' => TEXT_MANUFACTURERS_NAME,
            'type' => 'text',
            'sort' => true,
            'filter' => true
        ],
        'manufacturers_image' => [
            'label' => TEXT_MANUFACTURERS_IMAGE,
            'general' => 'file',
        ],
        'sort' => [
            'label' => TEXT_MANUFACTURERS_SORT,
            'general' => 'number',
            'show' => false,
        ],
        'manufacturers_featured' => [
            'label' => TEXT_MANUFACTURERS_FEATURED,
            'general' => 'checkbox',
            'show' => false,
        ],
        'manufacturers_seo_url' => [
            'label' => 'Seo url',
            'general' => 'text',
            'show' => false,
        ],
        'manufacturers_url' => [
            'label' => TABLE_HEADING_DESC,
            'type' => 'textarea',
            'show' => false,
            'ckeditor' => true,
        ],
        'keywords' => [
            'label' => TABLE_HEADING_META_KEYWORDS,
            'type' => 'text',
            'show' => false,
        ],
        'description' => [
            'label' => TABLE_HEADING_META_DESC,
            'type' => 'text',
            'show' => false
        ],
        'title' => [
            'label' => TABLE_HEADING_META_TITLE,
            'type' => 'text',
            'show' => false,
        ],
        'status' => [
            'label' => TABLE_HEADING_STATUS,
            'type' => 'status',
            'hideInForm' => true
        ],
        'h1_manufacturer' => [
            'label' => TEXT_MANUFACTURERS_H1,
            'type' => 'text',
            'show' => false,
        ],
        'seo_text_top' => [
            'label' => TEXT_MANUFACTURERS_SEO_TOP,
            'type' => 'textarea',
            'show' => false,
            'ckeditor' => true,
        ],
        'manufacturers_robots_status' => [
            'label' => TEXT_EDIT_ROBOTS_STATUS,
            'general' => 'select',
            'option' => array(
                array(
                    'id' => '0',
                    'title' => TEXT_EDIT_ROBOTS_STATUS_OFF
                ),
                array(
                    'id' => '1',
                    'title' => TEXT_EDIT_ROBOTS_STATUS_ON,
                    'selected' => 'selected'
                )
            ),
            'show' => false,
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
        ]
    ];

    private $seoUrl;
    protected $prefix_id = 'manufacturers_id';

    public function select($id = false)
    {
        $sql = "SELECT
                  `m`.`manufacturers_id` as id,
                  `mi`.`manufacturers_name`,
                  `m`.`manufacturers_seo_url`,
                  `m`.`manufacturers_image`,
                  `m`.`manufacturers_robots_status`,
                  `m`.`date_added`,
                  `m`.`last_modified`,
                  `m`.`status`,
                  `m`.`sort`,
                  `m`.`manufacturers_featured`,
                  `mi`.`languages_id`,
                  `mi`.`manufacturers_url`,
                  `mi`.`h1_manufacturer`,
                  `mi`.`seo_text_top`,
                   mt.keywords,
                   mt.description,
                   mt.title
                FROM `manufacturers` `m`
                  LEFT JOIN `manufacturers_info` `mi` ON `mi`.`manufacturers_id` = `m`.`manufacturers_id` 
                  LEFT JOIN `meta_tags` `mt` ON `mt`.`manufacturers_id` = `m`.`manufacturers_id` and  language_id = `mi`.`languages_id`
                  ";
        if ($id) {
            return $sql . " WHERE `m`.`manufacturers_id` = {$id}";
        }
        $sql .= " WHERE `mi`.`languages_id`='{$this->language_id}'";
        return $sql;
    }

    public function selectOne($id)
    {
        $sql = $this->select($id);
        if ($id) {
            $this->data['data'] = $this->getResultKey($sql, 'languages_id');
        }
        $this->getLanguages();
    }

    public function update($data)
    {
        $this->seoUrl();
        $data['sort'] = (int)$data['sort'];
        $data['manufacturers_featured'] = $data['manufacturers_featured'] == 'on' ? 1 : 0;
        $data['manufacturers_seo_url'] = $this->seoUrl->strip($data['manufacturers_seo_url']);

        $meta_data = [];
        foreach ($data as $k => $v) {
            if ($k == 'keywords' || $k == 'description' || $k == 'title') {
                $meta_data[$k] = $v;
                unset($data[$k]);
            }
        }

        $id = $data['id'];
        unset($data['id']);

        $this->insertUpdate($meta_data, $id, __FUNCTION__, 'meta_tags', 'language_id');

        $query = $this->prepareGeneralField($data);
        if ($this->insertUpdate($data, $id, __FUNCTION__, 'manufacturers_info', 'languages_id')) {
            $sql = "INSERT INTO `{$this->table}` SET {$query},`$this->prefix_id`='{$id}',`last_modified`=now() ON DUPLICATE KEY UPDATE {$query},`$this->prefix_id`='{$id}',`last_modified`=now()";
            if (!tep_db_query($sql)) {
                return false;
            }
        }
        return true;
    }

    public function insert($data)
    {
        $this->seoUrl();
        $data['sort'] = (int)$data['sort'];
        $data['manufacturers_featured'] = $data['manufacturers_featured'] == 'on' ? 1 : 0;
        $data['manufacturers_seo_url'] = $this->seoUrl->strip($data['manufacturers_seo_url']);

        $id = tep_db_fetch_array(tep_db_query("select max({$this->prefix_id})+1 as next_id from `{$this->table}`"))['next_id'] ?: 1;

        $meta_data = [];
        foreach ($data as $k => $v) {
            if ($k == 'keywords' || $k == 'description' || $k == 'title') {
                $meta_data[$k] = $v;
                unset($data[$k]);
            }
        }
        $this->insertUpdate($meta_data, $id, __FUNCTION__, 'meta_tags', 'language_id');

        $query = $this->prepareGeneralField($data);
        if ($this->insertUpdate($data, $id, __FUNCTION__, 'manufacturers_info', 'languages_id')) {
            $sql = "INSERT INTO `{$this->table}` SET {$query},`$this->prefix_id`='{$id}',`date_added`=now()";
            if (!tep_db_query($sql)) {
                return false;
            }
        }
        return $id;
    }

    private function seoUrl()
    {
        $seo_urls = new \SEO_URL($this->language_id);
        $this->seoUrl = $seo_urls;
    }

    public function delete($id)
    {
        $this->delFile($id, 'manufacturers_image');
        if (tep_db_query("DELETE FROM {$this->table} WHERE `{$this->prefix_id}`={$id}")) {
            tep_db_query("DELETE FROM `meta_tags` WHERE `{$this->prefix_id}`={$id}");
            return tep_db_query("DELETE FROM `manufacturers_info` WHERE `{$this->prefix_id}`={$id}");
        }
        return false;
    }

    public function getOptions()
    {
        foreach ($this->allowed_fields as $field_name => $value) {
            if (isset($value['option'])) {
                switch ($field_name) {
                    case 'manufacturers_robots_status':
                        foreach (array_column($value['option'], 'title') as $k => $title) {
                            $this->data['option'][$field_name][$k] = [
                                'val' => $title,
                                'selected' => isset($value['option'][$k]['selected']) ?: false,
                            ];
                        }
                        break;
                    default:
                        parent::optionFields($field_name, $value['option']);
                }
            }
        }
    }

}