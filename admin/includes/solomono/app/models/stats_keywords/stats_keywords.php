<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 14.06.2017
 * Time: 15:22
 */

namespace admin\includes\solomono\app\models\stats_keywords;

use admin\includes\solomono\app\core\Model;

//include_once(DIR_ROOT . '/' . DIR_WS_CLASSES . 'seo.class.php');

class stats_keywords extends Model {

    protected $allowed_fields=[
        'search_text'=>[
            'label'=>KEYWORD_TITLE,
            'general'=>'text',
            'sort'=>true,
            'filter'=>true,
        ],
        'search_count'=>[
            'label'=>KEYWORD_TITLE2,
            'general'=>'text',
            'sort'=>true,
        ],
    ];

    protected $prefix_id='search_text';

    public function select() {
        $sql="SELECT search_text as search_text, 
              search_count FROM 
              search_queries_sorted";
        return $sql;
    }

    public function query($request) {
        parent::query($request);
    }

    public function updateKeyList(){
        $sql_q = tep_db_query("SELECT DISTINCT search_text, COUNT(*) AS ct FROM search_queries GROUP BY search_text");

        while ($sql_q_result = tep_db_fetch_array($sql_q)) {
            $search_text = addslashes(strip_tags(tep_db_input($sql_q_result['search_text'])));
        
            $update_q = tep_db_query("select search_text, search_count from search_queries_sorted where search_text = '" . $search_text . "'");
            $update_q_result = tep_db_fetch_array($update_q);
            $count = $sql_q_result['ct'] + $update_q_result['search_count'];

            if (!empty($update_q_result['search_count'])) {
                tep_db_query("update search_queries_sorted set search_count = '" . $count . "' where search_text = '" . $$search_text . "'");
            } else {
                tep_db_query("insert into search_queries_sorted (search_text, search_count) values ('" .$search_text . "'," . $count . ")");
            } // search_count

            tep_db_query("delete from search_queries");
        } // while    
        return true;
    }

    public function deleteKeyList(){
        tep_db_query("delete from search_queries_sorted");
        return true;
    }

    public function selectWords(){
        $sql = "SELECT * 
                FROM searchword_swap";
        $this->data['swap'] = $this->getResult($sql);
    }

    public function selectOne($id) {
        $sql="SELECT
                  `m`.`manufacturers_id` as id,
                  `mi`.`manufacturers_name`,
                  `m`.`manufacturers_countries`,
                  `m`.`manufacturers_seo_url`,
                  `m`.`manufacturers_image`,
                  `m`.`date_added`,
                  `m`.`last_modified`,
                  `m`.`status`,
                  `m`.`manufacturers_top`,
                  `m`.`sort`,
                  `mc`.`countries_name`,
                  `mi`.`languages_id`,
                  `mi`.`manufacturers_htc_title_tag`,
                  `mi`.`manufacturers_htc_desc_tag`,
                  `mi`.`manufacturers_htc_keywords_tag`,
                  `mi`.`manufacturers_htc_description`
                FROM `manufacturers` `m`
                  LEFT JOIN `manufacturers_countries` `mc` ON `mc`.`countries_id` = `m`.`manufacturers_countries`
                  LEFT JOIN `manufacturers_info` `mi` ON `mi`.`manufacturers_id` = `m`.`manufacturers_id`
                WHERE `m`.`manufacturers_id` = {$id} and `mi`.`languages_id` = {$this->language_id}";
        if ($id) {
            $this->data['data']=$this->getResultKey($sql, 'languages_id');
        }
    }

    public function updateWord($id, $field, $value){
        tep_db_query("UPDATE searchword_swap SET {$field} = '{$value}' where sws_id = {$id}");
        $this->selectWords();
        return true;
    }

    public function insertWord($sws_word, $sws_replacement){
        tep_db_query("INSERT INTO searchword_swap SET sws_word = '{$sws_word}', sws_replacement = '{$sws_replacement}'");
        $this->selectWords();
        return true;
    }


    public function deleteWord($sws_id){
        tep_db_query("DELETE FROM searchword_swap WHERE sws_id = {$sws_id}");
        $this->selectWords();
        return true;
    }
    }