<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 25.07.2017
 * Time: 13:09
 */

namespace admin\includes\solomono\app\models\admin_files;


use admin\includes\solomono\app\core\Model;

class boxes extends Model {

    protected $allowed_fields = [
        'topics_name' => [
            'label' => TEXT_EDIT_TOPICS_NAME,
            'type' => 'text'
        ],
        'topics_heading_title' => [
            'label' => TEXT_EDIT_TOPICS_HEADING_TITLE,
            'type' => 'text'
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

    /**
     * @return array
     */
    public function getAllowedFields() {
        return $this->allowed_fields;
    }

    public function getPrefixId() {
        return $this->prefix_id;
    }

    public function select($id = false) {
        $sql = "select admin_files_name as admin_boxes_name,
                       admin_files_id as id 
                       from " . TABLE_ADMIN_FILES . " 
                       where admin_files_is_boxes = 1";
        return $sql;
    }
    

    public function setTree() {
        $arr = $this->getResult($this->select());
        $new_arr = array();
        foreach ($arr as $key => $value) {
            $value['admin_boxes_name'] = ucfirst (substr_replace ($value['admin_boxes_name'], '' , -4));
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
        $ids = '';
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

    public function getLanguages() {
        $sql = "SELECT `languages_id` as language_id,`name`,`code` FROM languages";
        $this->data['languages'] = $this->getResultKey($sql, 'language_id');
    }

    public function update($data) {

        $id = $data['id'];
        unset($data['id']);

        $articles_query = $this->prepareGeneralField($data);
        if ($this->insertUpdate($data, $id, __FUNCTION__, 'topics_description', 'language_id')) {
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
        if ($this->insertUpdate($data, $id, __FUNCTION__, 'topics_description', 'language_id')) {
            $sql = "INSERT INTO `topics` SET {$articles_query},`parent_id`=0,`topics_id`='{$id}',`date_added`=now()";
            if (!tep_db_query($sql)) {
                return false;
            }
        }
        return true;
    }

}