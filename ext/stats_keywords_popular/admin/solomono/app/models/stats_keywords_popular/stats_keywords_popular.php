<?php

use admin\includes\solomono\app\core\Model;

class stats_keywords_popular extends Model
{

    protected $allowed_fields = [
        'id'               => [
            'label'  => SEARCH_KEYWORDS_ID,
            'filter' => true,
            'sort'   => true,
        ],
        'search_keywords'  => [
            'label'  => SEARCH_KEYWORDS_TEXT,
            'type'   => 'text',
            'search' => true,
            'filter' => true,
            'sort'   => true,
        ],
        'meta_title'       => [
            'label' => SEARCH_KEYWORDS_META_TITLE,
            'show'  => false,
            'type'  => 'text',
        ],
        'meta_description' => [
            'label' => SEARCH_KEYWORDS_META_DESCRIPTION,
            'show'  => false,
            'type'  => 'textarea',
        ],
        'seo_text'         => [
            'label'    => SEARCH_KEYWORDS_SEO_TEXT,
            'show'     => false,
            'type'     => 'textarea',
            'ckeditor' => true,
        ],
        'h1'               => [
            'label' => SEARCH_KEYWORDS_H1,
            'show'  => false,
            'type'  => 'text',
        ],
    ];

    protected $prefix_id = 'id';

    public function select($id = false)
    {
        $sql = "
            SELECT sk.id
                 , sk.language_id
                 , sk.search_keywords
                 , sk.meta_title
                 , sk.meta_description
                 , sk.seo_text
                 , sk.h1
                 , sk.canonical
            FROM " . TABLE_STATS_KEYWORDS_POPULAR . " sk
        ";
        if ($id) {
            return $sql . " WHERE sk.id = {$id}";
        }
        $sql .= " WHERE sk.language_id = '{$this->language_id}'";
        return $sql;
    }

    public function selectOne($id)
    {
        $sql = $this->select($id);
        if ($id) {
            $this->data['data'] = $this->getResultKey($sql, 'language_id');
        }
        $this->getLanguages();
    }

    public function update($data)
    {

        $id = $data['id'];
        unset($data['id']);

        if ($this->InsertUpdate($data, $id, __FUNCTION__)) {
            return true;
        }
        return false;
    }

    public function insert($data)
    {
        $id = tep_db_fetch_array(tep_db_query("select max({$this->prefix_id})+1 as next_id from `{$this->table}`"))['next_id'] ?: 1;

        if ($this->InsertUpdate($data, $id, __FUNCTION__)) {
            return [
                'success' => true,
                'id' => $id
            ];
        }
        return false;
    }


    protected function insertUpdate($data, $id, $action = 'update', $table = null, $lang = 'language_id')
    {

        $table = $table ?: $this->table;
        $this->getLanguages();
        $languages = $this->data['languages'];

        foreach ($languages as $k => $v) {
            $query = '';
            foreach ($data as $key => $value) {
                if (!is_array($value)) {
                    $tmp_val = [];
                    foreach ($languages as $lk => $lv) {
                        $tmp_val[$lk] = $value;
                    }
                    $value = $tmp_val;
                }
                $value = tep_db_prepare_input($value[$k]);
                $query .= "`{$key}` = " . '\'' . tep_db_input($value) . '\', ';
            }
            $query .= "`{$this->prefix_id}`= {$id}, `{$lang}`={$k}";

            if ($action == 'update') {
                $sql = "INSERT INTO `{$table}` SET $query ON DUPLICATE KEY UPDATE {$query}";
            } elseif ($action == 'insert') {
                $sql = "INSERT INTO `{$table}` SET $query";
            }
            if (!tep_db_query($sql)) {
                return false;
            }
        }
        return true;
    }

    public function delete($id)
    {
        if (tep_db_query("DELETE FROM {$this->table} WHERE `{$this->prefix_id}`={$id}")) {
            return true;
        }
        return false;
    }
}
