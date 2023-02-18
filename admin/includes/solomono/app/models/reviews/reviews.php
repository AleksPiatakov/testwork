<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 14.06.2017
 * Time: 15:22
 */

namespace admin\includes\solomono\app\models\reviews;

use admin\includes\solomono\app\core\Model;


class reviews extends Model {

    protected $allowed_fields=[
        'customers_name'=>[
            'label'=>TEXT_CUSTOMER_NAME,
            'type'=>'text',
            'sort'=>true,
            'filter'=>true
        ],
        'reviews_text'=>[
            'label'=>TEXT_TYPE_TEXT,
            'type'=>'textarea',
        ],
        'languages_id'=>[
            'label'=>TEXT_INDEX_LANGUAGE,
            'type'=>'text',
            'show'=>false
        ],
        'products_id'=>[
            'label'=>TEXT_PRODUCT_ID,
            'type'=>'text',
            'filter'=>true
        ],
        'reviews_rating'=>[
            'label'=>TEXT_ARTICLES_AVERAGE_RATING,
            'type'=>'text',
            'filter'=>true
        ],
        'date_added'=>[
            'label'=>TEXT_DATE_ADDED,
            'type'=>'disabled',
            'filter'=>true
        ],
        'last_modified'=>[
            'label'=>TEXT_DATE_MODIFIED,
            'type'=>'disabled',
            'show'=>false,
        ]
    ];

    protected $prefix_id='reviews_id';

    public function select($id=false,$parent=false) {
        $sql="SELECT
                        r.reviews_id as 'id'
                       ,r.products_id
                       ,r.customers_id
                       ,r.customers_name
                       ,r.reviews_rating
                       ,r.date_added
                       ,r.parent_id
                       ,rw.reviews_text
                       ,rw.languages_id
                FROM `reviews` `r`
                  LEFT JOIN `reviews_description` `rw` ON `rw`.`reviews_id` = `r`.`reviews_id` 
                WHERE `r`.`reviews_id` > '0'";

        if ($parent) {
            $sql .= " AND `r`.`parent_id` > 0";
        } else {
            $sql .= " AND `r`.`parent_id` = 0";
        }

        if ($id) {
            $sql .= " AND `r`.`reviews_id` = {$id}";
        }
        $this->data['sql'] = $sql;
        return $sql;
    }

    public function selectOne($id,$parent=false) {
        $sql=$this->select($id, $parent);
        if ($id) {
            $result = $this->getResult($sql);
            $first = reset($result);
            $this->data['data']= $first;
        }
    }

    public function selectParent(){
        $sql=$this->select(false, true);
        $result = $this->getResult($sql);

        return $result;
    }

    public function update($data) {

        $id=$data['id'];
        $text = addslashes(tep_db_prepare_input($data['reviews_text']));
        $langId = tep_db_prepare_input($data['languages_id']);
        unset($data['id'],$data['reviews_text'],$data['languages_id']);

        $query=$this->prepareGeneralField($data);
        if (tep_db_query("INSERT INTO reviews_description SET reviews_id = '{$id}', languages_id = '{$langId}', reviews_text = '{$text}' ON DUPLICATE KEY UPDATE reviews_text = VALUES(reviews_text), languages_id = VALUES(languages_id)")) {
            $sql="INSERT INTO `{$this->table}` SET {$query},`$this->prefix_id`='{$id}',`last_modified`=now() ON DUPLICATE KEY UPDATE {$query},`$this->prefix_id`='{$id}',`last_modified`=now()";
            if (!tep_db_query($sql)) {
                return false;
            }
        }
        return true;
    }


    public function insert($data) {

        $id=tep_db_fetch_array(tep_db_query("select max({$this->prefix_id})+1 as next_id from `{$this->table}`"))['next_id']?:1;
        $text = addslashes(tep_db_prepare_input($data['reviews_text']));
        $languages_id = (int)$data['languages_id'];
        unset($data['reviews_text']);
        unset($data['languages_id']);
        $parent_id = $data['parent_id'] = (int)$data['parent_id'];
        $query=$this->prepareGeneralField($data);
        if (tep_db_query("INSERT INTO reviews_description SET reviews_id = '{$id}', languages_id = '{$languages_id}', reviews_text = '{$text}', parent_id = '{$parent_id}' ON DUPLICATE KEY UPDATE reviews_text = VALUES(reviews_text)")) {
            $sql="INSERT INTO `{$this->table}` SET {$query},`$this->prefix_id`='{$id}',`date_added`=now()";
            if (!tep_db_query($sql)) {
                return false;
            }
        }
        return true;
    }

    private function seoUrl() {
        $seo_urls=new \SEO_URL($this->language_id);
        $this->seoUrl=$seo_urls;
    }

    public function delete($id) {
        if (tep_db_query("DELETE FROM {$this->table} WHERE `{$this->prefix_id}`={$id}")) {
            tep_db_query("DELETE FROM `reviews_description` WHERE `{$this->prefix_id}`={$id}");
            //ответы администратора на  отзывы
            tep_db_query("DELETE FROM {$this->table} WHERE `parent_id`={$id}");
            tep_db_query("DELETE FROM `reviews_description` WHERE `parent_id`={$id}");
            return true;
        }
        return false;
    }


    protected function order($request) {
        $request['order']=$request['order'] ? : 'id-desc';


        return parent::order($request);
    }

}