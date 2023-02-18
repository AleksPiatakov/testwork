<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 25.07.2017
 * Time: 13:09
 */

namespace admin\includes\solomono\app\models\geo_zones;


use admin\includes\solomono\app\core\Model;

class tax_zones extends Model {

    protected $allowed_fields = [
        'geo_zone_name' => [
            'label' => TABLE_HEADING_TAX_ZONES,
            'type' => 'text'
        ],
        'geo_zone_description' => [
            'label' => TEXT_INFO_ZONE_DESCRIPTION,
            'type' => 'text',
            'show' => false
        ],
    ];
    protected $prefix_id = 'geo_zone_id';
    protected $table = 'geo_zones';

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
        $sql = "SELECT
                  gz.{$this->prefix_id} as `id`,
                  gz.geo_zone_name,
                  gz.geo_zone_description
                FROM geo_zones gz";
        if ($id) {
            return $sql . " WHERE gz.{$this->prefix_id} = '{$id}'";
        }
        return $sql;
    }

    public function getDescription($id) {
        $sql = $this->select($id);
        if ($id) {
            $this->data['data'] = $this->getResult($sql)[0];
        }
    }


    public function setTree() {
        $arr = $this->getResult($this->select());
        $new_arr = array();
        foreach ($arr as $key => $value) {
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


    public function confirmDelete($id) {
        tep_db_query("delete from `geo_zones` where geo_zone_id = {$id}");
        tep_db_query("delete from `zones_to_geo_zones` where geo_zone_id = {$id}");
    }


    public function update($data) {

        $id = $data['id'];
        unset($data['id']);

        $articles_query = $this->prepareGeneralField($data);
            $sql = "UPDATE `geo_zones` SET {$articles_query},`last_modified`=now()  WHERE {$this->prefix_id}={$id}";
            if (!tep_db_query($sql)) {
                return false;
            }
        return true;
    }

    public function insert($data)
    {
        $id = tep_db_fetch_array(tep_db_query("select max($this->prefix_id)+1 as next_id from geo_zones"))['next_id'] ?: 1;

        $geo_zones_query = $this->prepareGeneralField($data);
        $sql = "INSERT INTO `geo_zones` SET {$geo_zones_query},`geo_zone_id`='{$id}',`date_added`=now()";
        if (!tep_db_query($sql)) {
            return false;
        }
        return true;
    }

}