<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 25.07.2017
 * Time: 13:03
 */

namespace admin\includes\solomono\app\models\articles;

use admin\includes\solomono\app\core\Model;

include_once(DIR_ROOT . '/' . DIR_WS_CLASSES . 'seo.class.php');

/**
 * Class articles
 * @package admin\includes\solomono\app\models\articles
 * (show===false) - not show in table
 * if (type==disabled) show in form like input disabled
 * if (general) show in form into left column && value is type
 * if (exist 'type') show in form else not show
 * if ('type' == textarea && ckeditor) show text in plugin
 * to set style,example:
 * #own_table.articles>thead>tr>th[data-table="sort_order"]
 */
class articles extends Model {

    protected $allowed_fields = [
        'sort_order' => [
            'label' => TEXT_ARTICLES_SORT,
            'sort' => true,
            'general' => 'number',
            'required' => true,
            'default' => '1'
        ],
        'articles_name' => [
            'label' => HEADING_TITLE_NAME,
            'type' => 'text',
            'filter' => true,
        ],
        'articles_head_title_tag' => [
            'label' => TEXT_ARTICLES_HEAD_TITLE_TAG,
            'type' => 'text',
            'show' => false,
        ],
        'articles_head_desc_tag' => [
            'label' => 'Meta Description',
            'type' => 'textarea',
            'rows' => 1,
            'show' => false,
        ],
        'articles_head_keywords_tag' => [
            'label' => TEXT_ARTICLES_HEAD_KEYWORDS_TAG,
            'type' => 'text',
            'show' => false,
        ],
        'articles_url' => [
            'label' => TEXT_ARTICLES_URL,
            'type' => 'text',
            'show' => false,
        ],
        'articles_description' => [
            'label' => TEXT_ARTICLES_DESCRIPTION,
            'type' => 'textarea',
            'ckeditor' => true,
            'rows' => 10,
            'show' => false,
        ],
        'articles_image' => [
            'label' => TEXT_ARTICLES_IMAGE,
            'general' => 'file',
            'show' => false,
        ],
        'articles_image_mobile' => [
            'label' => TEXT_ARTICLES_IMAGE_MOBILE,
            'general' => 'file',
            'show' => false,
        ],
        'articles_link' => [
            'label' => TEXT_ARTICLES_LINK,
            'general' => 'text',
            'show' => false,
        ],
        'articles_robots_status' => [
            'label' => TEXT_EDIT_ROBOTS_STATUS,
            'general' => 'select',
            'option' => array(
                array ('id' => '0',
                    'title' => TEXT_EDIT_ROBOTS_STATUS_OFF),
                array ('id' => '1',
                    'title' => TEXT_EDIT_ROBOTS_STATUS_ON,
                    'selected'=>'selected')
            ),
            'show' => false,
        ],
        'articles_code' => [
            'label' => TEXT_ARTICLES_CODE,
            'general' => 'text',
            'show' => false,
        ],
        
        'articles_date_available' => [
            'label' => TEXT_DATE_AVAILABLE,
            'general' => 'text',
            'show' => false,
            'required' => true,
            'class' => 'datepicker',
        ],
        'articles_date_added' => [
            'label' => TEXT_DATE_ADDED,
            'general' => 'disabled',
            'show' => false,
        ],
        'articles_last_modified' => [
            'label' => TEXT_LAST_MODIFIED,
            'general' => 'disabled',
            'show' => false,
        ],
        'status' => [
            'label' => TABLE_HEADING_STATUS,
        ],

    ];
    protected $prefix_id = 'articles_id';
    private $seoUrl;

    public function select() {
        $xsell=$_GET['xsell']=='yes'?' RIGHT JOIN articles_xsell `ax` on `ax`.`articles_id`=`att`.`articles_id` ':'';
        $sql = "SELECT DISTINCT 
                  `att`.`articles_id` AS `id`,
                  `ad`.`articles_name`,
                  `a`.`articles_status` AS `status`,     
                  `a`.`sort_order`
                FROM `articles_to_topics` `att`
                  LEFT JOIN `articles_description` `ad` ON `ad`.`articles_id` = `att`.`articles_id`
                  LEFT JOIN `articles` `a` ON `a`.`articles_id` = `ad`.`articles_id`
                  {$xsell}
                  WHERE `ad`.`language_id`='{$this->language_id}' ";
        if (!empty($_GET['tPath'])) {
            $ids = [];
            $topic_ids = tep_get_topic_tree($_GET['tPath'], '', '0', '', true);
            foreach ($topic_ids as $category) {
                $ids[] = $category['id'];
            }
            $ids_imp = implode(",", $ids);
            $this->debug($ids_imp, __METHOD__, 'p');
            $sql .= " AND att.topics_id in({$ids_imp})";
        }

        return $sql;
    }

    public function selectOne($id) {
        if ($id) {
            $sql = "SELECT
                  `att`.`articles_id` AS `id`,
                  `att`.`topics_id`,
                  `ad`.`language_id`,
                  `ad`.`articles_name`,
                  `ad`.`articles_head_title_tag`,
                  `ad`.`articles_head_desc_tag`,
                  `ad`.`articles_head_keywords_tag`,
                  `ad`.`articles_description`,
                  `a`.`articles_image`,
                  `a`.`articles_robots_status`,
                  `a`.`articles_image_mobile`,
                  DATE(`a`.`articles_date_available`) `articles_date_available`,
                  `a`.`articles_link`, 
                  a.articles_code,                  
                  `ad`.`articles_url`,
                  `a`.`articles_status` AS `status`,
                  `a`.`articles_date_added`,
                  `a`.`articles_last_modified`,
                  `a`.`sort_order`
                FROM `articles_to_topics` `att`
                  LEFT JOIN `articles_description` `ad` ON `ad`.`articles_id` = `att`.`articles_id`
                  LEFT JOIN `articles` `a` ON `a`.`articles_id` = `ad`.`articles_id`
                  WHERE att.{$this->prefix_id} = '{$id}'";
            $this->data['data'] = $this->getResultKey($sql, 'language_id');
                $this->data['tPath'] = current($this->data['data'])['topics_id'];
        }
        $this->data['allowed_fields']['articles_date_available']['default'] = date('Y-m-d');
        $this->getLanguages();
        $this->getXsell($id);
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

    public function addProduct($productId, $xsellId) {
        return tep_db_query("INSERT INTO `articles_xsell` SET `articles_id`={$xsellId},`xsell_id`={$productId} ");
    }

    private function getXsell($article_id) {
        $sql = "SELECT
                  `ax`.`xsell_id`,
                  `ax`.`articles_id`,
                  `pd`.`products_name`
                FROM `articles_xsell` `ax`
                  LEFT JOIN `products_description` `pd` ON `pd`.`products_id` = `ax`.`xsell_id`
                WHERE `ax`.`articles_id` = '{$article_id}' AND `pd`.`language_id` = '{$this->language_id}'";

        $this->data['xsell'] = $this->getResult($sql);
    }

    public function delXsell($articlesId, $xsellId) {
        return tep_db_query("DELETE FROM `articles_xsell` WHERE `articles_id`='{$articlesId}' AND `xsell_id`='{$xsellId}'");
    }

    public function deleteArticles($arr) {
        $ids = '';
        foreach ($arr as $item) {
            $ids[] = $item['articles_id'];
            if (!empty($item['articles_image'])) {
                @unlink(DIR_FS_CATALOG_IMAGES . 'articles/' . $item['articles_image']);
            }

        }
        $ids_imp = implode(",", $ids);
        tep_db_query("delete from `articles` where `articles_id` in ({$ids_imp})");
        tep_db_query("delete from `articles_description` where `articles_id` in ({$ids_imp})");
    }

    public function deleteArticle($id,$tPath) {

        if($this->checkLink($id,$tPath)){
            return true;
        }

        $this->delFiles($id, 'articles_image', 'articles');
        if (!tep_db_query("DELETE FROM `articles_description` where `articles_id`={$id}")) {
            return false;
        };
        if (!tep_db_query("DELETE FROM `articles` where `articles_id`={$id}")) {
            return false;
        }
        if (!tep_db_query("DELETE FROM `articles_to_topics` where `articles_id`={$id}")) {
            return false;
        }
        return true;
    }

    private function checkLink($id,$tPath){
        $check_query = tep_db_query("SELECT {$this->prefix_id} FROM `articles_to_topics` WHERE `{$this->prefix_id}` = {$id}");
        if ($check_query->num_rows>1 && $tPath) {
           tep_db_query("DELETE FROM `articles_to_topics` where `articles_id`={$id} and `topics_id`={$tPath}");
           return true;
        }
        return false;
    }

    public function delFiles($id, $field, $table = null) {
        $table = is_null($table) ? $this->table : $table;
        $sql = "SELECT `{$field}` FROM `{$table}` WHERE `{$this->prefix_id}` = {$id}";
        $files = $this->getResult($sql);
        foreach ($files as $v) {

            if ($v[$field] !== NULL) {
                $file_path = DIR_FS_CATALOG . DIR_WS_IMAGES;
                if (file_exists($file_path . $v[$field])) {
                    @unlink($file_path . $v[$field]);
                } elseif (file_exists($file_path . $this->table . DIRECTORY_SEPARATOR . $v[$field])) {
                    @unlink($file_path . $this->table . DIRECTORY_SEPARATOR . $v[$field]);
                }
            }
        }

    }

    private function seoUrl() {
        $seo_urls = new \SEO_URL($this->language_id);
        $this->seoUrl = $seo_urls;
    }

    protected function insertUpdate($data, $id, $action = 'update', $table = null, $lang = 'language_id')
    {
        $table = $table ?: $this->table;
        $this->getLanguages();
        $languages = $this->data['languages'];

        foreach ($languages as $k => $v) {
            $query = '';
            foreach ($data as $key => $value) {
                $value = tep_db_prepare_input($value[$k]);
                if ($key == 'articles_url' && empty($value)) {
                    $value = preg_replace( "/[^-a-z0-9]/","", $this->seoUrl->strip($data['articles_name'][$k]));
                }
                
                $query .= "`{$key}` = " . '\'' . $value . '\', ';                                
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

    private function articlesToTopics(&$data, $action, $id) {
        switch ($action) {
            case 'insert':
                $sql = "INSERT INTO `articles_to_topics` (`articles_id`,`topics_id`) VALUES ({$id},'{$data['topics_id']}') ON DUPLICATE KEY UPDATE `topics_id`='{$data['topics_id']}',{$this->prefix_id}='{$id}' ";
                break;
            case 'update':
                $sql = "UPDATE `articles_to_topics` SET `topics_id`='{$data['topics_id']}' WHERE {$this->prefix_id}='{$id}' AND topics_id='{$data['old_tpath']}'";
                break;
        }
        unset($data['topics_id'],$data['old_tpath']);
        return $sql;
    }

    public function insert($data) {
        $id = tep_db_fetch_array(tep_db_query("SELECT max(`articles_id`)+1 AS `next_id` FROM `articles`"))['next_id']?:1;

        if (!tep_db_query($this->articlesToTopics($data, __FUNCTION__, $id))) {
            return false;
        }
        $articles_query = $this->prepareGeneralField($data);
        if ($this->insertUpdate($data, $id, __FUNCTION__, 'articles_description', 'language_id')) {
            $sql = "INSERT INTO `articles` SET {$articles_query},`articles_id`='{$id}',`articles_date_added`=now()";
            if (!tep_db_query($sql)) {
                return false;
            }
        }
        return [
            'success'=> true,
            'id' => $id
        ];
    }

    public function update($data) {
        $id = $data['id'];
        unset($data['id']);

        if (!tep_db_query($this->articlesToTopics($data, __FUNCTION__, $id))) {
            return false;
        }

        $articles_query = $this->prepareGeneralField($data);
        if ($this->insertUpdate($data, $id, __FUNCTION__, 'articles_description', 'language_id')) {
            $sql = "UPDATE `articles` SET `articles_last_modified`=now(),{$articles_query} WHERE {$this->prefix_id}={$id} ";
            if (!tep_db_query($sql)) {
                return false;
            }

        }
        return true;
    }

    public function duplicate($data) {
        tep_db_query("INSERT INTO `articles` (`articles_date_added`, `articles_date_available`, `articles_status`, `sort_order`,`articles_image`)
                                  SELECT
                                    NOW(),
                                    `articles_date_available`,
                                    '0',
                                    `sort_order`,
                                    `articles_image`
                                  FROM `articles`
                                  WHERE `articles_id` = '{$data['id']}'");
        $dup_articles_id = tep_db_insert_id();
        $description_query = tep_db_query("SELECT
                                                      `ad`.`language_id`,
                                                      `ad`.`articles_name`,
                                                      `ad`.`articles_description`,
                                                      `ad`.`articles_url`,
                                                      `ad`.`articles_head_title_tag`,
                                                      `ad`.`articles_head_desc_tag`,
                                                      `ad`.`articles_head_keywords_tag`,
                                                      `ad`.`seo_url`,
                                                      `a`.`articles_image`
                                                  FROM " . TABLE_ARTICLES_DESCRIPTION . " as `ad` 
                                                  INNER JOIN " . TABLE_ARTICLES . " as `a`
                                                  ON `a`.`articles_id` = `ad`.`articles_id`
                                                  WHERE `ad`.`articles_id` = '" . (int)$data['id'] . "'
                                                  ");


        $olgImg = "";
        while ($description = tep_db_fetch_array($description_query)) {
            $olgImg = $description['articles_image'];
            tep_db_query("INSERT INTO " . TABLE_ARTICLES_DESCRIPTION . " 
            (`articles_id`, `language_id`, `articles_name`, `articles_description`, `articles_url`, `articles_head_title_tag`, `articles_head_desc_tag`, `articles_head_keywords_tag`, `seo_url`, `articles_viewed`)
              VALUES ('" . (int)$dup_articles_id . "', '" . (int)$description['language_id'] . "', '" . tep_db_input($description['articles_name']) . "', '" . tep_db_input($description['articles_description']) . "', '" . tep_db_input($description['articles_url']) . "',  '" . tep_db_input($description['articles_head_title_tag']) . "', '" . tep_db_input($description['articles_head_desc_tag']) . "', '" . tep_db_input($description['articles_head_keywords_tag']) . "','" . tep_db_input($description['seo_url']) . "', '0')");

        }
        if($olgImg){
            // переіменовуємо всі картинки в нові:
            $new_images_str=tep_rename_images($olgImg, ';');
            tep_db_query("UPDATE ". TABLE_ARTICLES . "
            SET articles_image = '" . $new_images_str . "'
            WHERE articles_id = " . (int)$dup_articles_id);
        }

        tep_db_query("INSERT INTO " . TABLE_ARTICLES_TO_TOPICS . " (`articles_id`, `topics_id`) VALUES ('" . (int)$dup_articles_id . "', '" . (int)$data['topics_id'] . "')");
    }

    public function link($data) {
        $check_query = tep_db_query("SELECT count(*) AS `total` FROM " . TABLE_ARTICLES_TO_TOPICS . " WHERE `articles_id` = '" . (int)$data['id'] . "' AND topics_id = '" . (int)$data['topics_id'] . "'");
        $check = tep_db_fetch_array($check_query);
        if ($check['total']<'1') {
            tep_db_query("INSERT INTO " . TABLE_ARTICLES_TO_TOPICS . " (`articles_id`, `topics_id`) VALUES ('" . (int)$data['id'] . "', '" . (int)$data['topics_id'] . "')");
        }
    }

    public function move($data) {
        $check_query = tep_db_query("SELECT count(*) AS `total` FROM " . TABLE_ARTICLES_TO_TOPICS . " WHERE `articles_id` = '" . (int)$data['id'] . "' AND topics_id = '" . (int)$data['topics_id'] . "'");
        $check = tep_db_fetch_array($check_query);
        if ($check['total']<'1') {
            tep_db_query("UPDATE " . TABLE_ARTICLES_TO_TOPICS . " SET `topics_id` = '" . (int)$data['topics_id'] . "' WHERE `articles_id` = '" . (int)$data['id'] . "' AND `topics_id` = '" . (int)$data['current_topic'] . "'"); // current_topic
        }
    }

    protected function order($request) {
        $request['order'] = $request['order'] ?: 'sort_order-asc';
        return parent::order($request);
    }

    public function getOptions() {
        foreach ($this->allowed_fields as $field_name => $value) {
            if (isset($value['option'])) {
                switch($field_name){
                    case 'articles_robots_status':
                        foreach (array_column($value['option'], 'title') as $k => $title){
                            $this->data['option'][$field_name][$k] = [
                                'val' => $title,
                                'selected' => isset($value['option'][$k]['selected'])?:false,
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