<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 25.07.2017
 * Time: 13:09
 */

namespace admin\includes\solomono\app\models\articles;


use admin\includes\solomono\app\core\Model;

class topics extends Model {

    protected $allowed_fields = [
        'topics_name' => [
            'label' => TEXT_EDIT_TOPICS_NAME,
            'type' => 'text'
        ],
        'topics_heading_title' => [
            'label' => TEXT_EDIT_TOPICS_HEADING_TITLE,
            'type' => 'text'
        ],
        'topics_seo_url' => [
            'label' => TOPICS_SEO_URL_TITLE,
            'type' => 'text',
            'show' => false,
        ],
        'topics_description' => [
            'label' => TEXT_EDIT_TOPICS_DESCRIPTION,
            'type' => 'textarea',
            'row' => 6,
            'show' => false
        ],
        'topics_seo_title' => [
            'label' => TEXT_SEO_TITLE,
            'type' => 'textarea',
            'row' => 3,
            'show' => false

        ],
        'sort_order' => [
            'label' => TEXT_ARTICLES_SORT,
            'show' => false,
            'general' => 'number',
        ],
        'show_in_sitemap' => [
            'label' => TEXT_SHOW_IN_SITEMAP,
            'show' => false,
            'general' => 'checkbox',
        ],
        'robots_status' => [
            'label' => TEXT_TOPICS_ROBOTS_STATUS,
            'show' => false,
            'general' => 'checkbox',
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
    ];
    protected $prefix_id = 'topics_id';
    protected $table = 'topics_description';
    private $seoUrl;

    /**
     * @return array
     */
    public function getAllowedFields() {
        return $this->allowed_fields;
    }

    private function seoUrl() {
        $seo_urls = new \SEO_URL($this->language_id);
        $this->seoUrl = $seo_urls;
    }

    public function getPrefixId() {
        return $this->prefix_id;
    }

    public function select($id = false) {
        $sql = "SELECT
                  t.{$this->prefix_id} as `id`,
                  t.parent_id,
                  td.topics_name,
                  t.sort_order,
                  t.date_added,
                  t.last_modified,
                  t.show_in_sitemap,
                  t.robots_status,
                  td.topics_seo_title,
                  td.topics_description,
                  td.topics_heading_title,
                  td.topics_seo_url,
                  td.language_id
                FROM topics t
                RIGHT JOIN   topics_description td ON t.topics_id = td.topics_id ";
        if ($id) {
            return $sql . " WHERE t.{$this->prefix_id} = '{$id}'";
        }
        $sql .= " WHERE td.language_id={$this->language_id}";
        return $sql;
    }

    public function getDescription($id) {
        $sql = $this->select($id);
        if ($id) {
            $this->data['data'] = $this->getResultKey($sql, 'language_id');
        }
        $this->getLanguages();
    }


    public function setTree() {
        $arr = $this->getResult($this->select());
        $new_arr = array();
        foreach ($arr as $key => $value) {
            if($value['topics_name']==$_POST['name']){
                continue;
            }
            $new_arr[$value['id']] = $value;
        }
        return $this->mapTree($new_arr);
    }

    public function mapTree($dataset) {
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

    public function cntSubCat($id) {
        $result['categories'] = tep_get_topic_tree($id, '', '0', '', true);
        $sql = "select att.articles_id,a.articles_image
                from topics t
                right join articles_to_topics att on att.topics_id=t.topics_id
                left join  articles_description ad on  att.articles_id=ad.articles_id
                left join  articles a on  ad.articles_id =a.articles_id   
                where t.topics_id={$id} or t.parent_id={$id}";
        $result['articles'] = $this->getResult($sql);
        return $result;
    }

    public function moveTo($from, $to) {
        $cat = tep_get_topic_tree($from, '', '0', '', true);
        $ids = [];
        foreach ($cat as $item) {
            $ids[] = $item['id'];
        }
        $ids_exp = implode(', ', $ids);
        $sql = "UPDATE `topics` set `parent_id` ={$to} WHERE `topics_id` in ({$ids_exp})";

        if (!tep_db_query($sql)) {
            return false;
        }
        return true;
    }

    public function confirmDelete($id) {
        $result = $this->cntSubCat($id);
        foreach ($result['categories'] as $category) {
            $ids[] = $category['id'];
        }
        $ids_imp = implode(",", $ids);
        tep_db_query("delete from `topics_description` where topics_id in({$ids_imp})");
        tep_db_query("delete from `topics` where topics_id in({$ids_imp})");
        tep_db_query("delete from `articles_to_topics` where topics_id in({$ids_imp})");
        if (!empty($result['articles'])) {
            $articles = new articles();
            $articles->deleteArticles($result['articles']);
        }
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

//    public function getLanguages() {
//        $sql = "SELECT `languages_id` as language_id,`name`,`code` FROM languages";
//        $this->data['languages'] = $this->getResultKey($sql, 'language_id');
//    }

    protected function insertUpdate($data, $id, $action = 'update', $table = null, $lang = 'language_id')
    {
        $table = $table ?: $this->table;
        $this->getLanguages();
        $languages = $this->data['languages'];

        foreach ($languages as $k => $v) {
            $query = '';
            foreach ($data as $key => $value) {
                $value = tep_db_prepare_input($value[$k]);
                if ($key == 'topics_seo_url' && empty($value)) {
                    $query .= "`{$key}` = " . '\'' . $this->seoUrl->strip($data['topics_name'][$k]) . '\', ';
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

    public function update($data) {

        $id = $data['id'];
        unset($data['id']);
        unset($data['old_tpath']);
        $data['show_in_sitemap'] = $data['show_in_sitemap'] == 'on' ? 1 : 0;
        $data['robots_status'] = $data['robots_status'] == 'on' ? 1 : 0;
        $articles_query = $this->prepareGeneralField($data);
        if ($this->insertUpdate($data, $id, __FUNCTION__, 'topics_description')) {
            $sql = "UPDATE `topics` SET {$articles_query},`last_modified`=now()  WHERE {$this->prefix_id}={$id}";
            if (!tep_db_query($sql)) {
                return false;
            }

        }
        return true;
    }

    public function insert($data) {
        $id = tep_db_fetch_array(tep_db_query("select max($this->prefix_id)+1 as next_id from topics_description"))['next_id']?:1;

        $articles_query = $this->prepareGeneralField($data);
        if ($this->insertUpdate($data, $id, __FUNCTION__, 'topics_description')) {
            $sql = "INSERT INTO `topics` SET {$articles_query},`parent_id`=0,`topics_id`='{$id}',`date_added`=now()";
            if (!tep_db_query($sql)) {
                return false;
            }
        }
        return true;
    }

}