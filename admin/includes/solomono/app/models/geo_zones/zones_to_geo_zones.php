<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 25.07.2017
 * Time: 13:03
 */

namespace admin\includes\solomono\app\models\geo_zones;

use admin\includes\solomono\app\core\Model;


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
class zones_to_geo_zones extends Model {

    protected $allowed_fields = [
        'countries_name' => [
            'label' => TABLE_HEADING_COUNTRY,
            'type' => 'text',
            'hideInForm' => true
        ],
        'geo_zone_id' => [
            'label' => TABLE_HEADING_COUNTRY_ZONE,
            'type' => 'select',
            'option' => [
                'table'=>'geo_zones',
                'id'=>'geo_zone_id',
                'title'=>'geo_zone_name'
            ],
            'show' => false
        ],
        'zone_country_id' => [
            'label' => TABLE_HEADING_COUNTRY,
            'type' => 'select',
            'option' => [
                'table'=>'countries',
                'id'=>'countries_id',
                'title'=>'countries_name'
            ],
            'show' => false
        ],
        'zone_name' => [
            'label' => TABLE_HEADING_COUNTRY_STATE,
            'type' => 'text',
            'hideInForm' => true
        ],
        'zone_id' => [
            'label' => TABLE_HEADING_COUNTRY_STATE,
            'type' => 'select',
            'option' => [
                'table'=>'zones',
                'id'=>'zone_id',
                'title'=>'zone_name'
            ],
            'show' => false
        ]
    ];
    protected $prefix_id = 'association_id';

    public function select() {
        $sql = "select ztgz.association_id as id, 
                            ztgz.zone_country_id, 
                            if (ztgz.zone_country_id = 0 , '".TEXT_ALL_COUNTRIES."' , c.countries_name) as countries_name, 
                            ztgz.zone_id, 
                            if (ztgz.zone_id = 0 , '".PLEASE_SELECT."' , z.zone_name) as zone_name, 
                            ztgz.geo_zone_id 
                    from zones_to_geo_zones ztgz
                    left join zones z on z.zone_id = ztgz.zone_id
                    left join countries c on c.countries_id = ztgz.zone_country_id";
        if (!empty($_GET['tPath'])) {
            $sql .= " where  ztgz.geo_zone_id= {$_GET['tPath']}";
        }

        return $sql;
    }



    public function selectOne($id) {
        if ($id) {
            $sql = "select ztgz.association_id as id, 
                            ztgz.zone_country_id, 
                            if (ztgz.zone_country_id = 0 , '".TEXT_ALL_COUNTRIES."' , c.countries_name) as countries_name, 
                            ztgz.zone_id, 
                            if (ztgz.zone_id = 0 , '".PLEASE_SELECT."', z.zone_name) as zone_name, 
                            ztgz.geo_zone_id 
                    from zones_to_geo_zones ztgz
                    left join zones z on z.zone_id = ztgz.zone_id
                    left join countries c on c.countries_id = ztgz.zone_country_id
                    where ztgz.association_id = {$id}";
            $this->data['data'] = $this->getResult($sql)[0];
            $this->data['tPath'] = $this->data['data']['geo_zone_id'];
        }
        $this->data['option']['zone_country_id'][0] = TEXT_ALL_COUNTRIES;
        $this->data['option']['zone_id'][0] = PLEASE_SELECT;
        $this->data['option']['zone_id'] = $this->getZones($this->data['data']['zone_country_id']?:'', $this->data['data']['zone_id']);

    }



    public function insert($data) {
        $id = tep_db_fetch_array(tep_db_query("SELECT max(`association_id`)+1 AS `next_id` FROM `zones_to_geo_zones`"))['next_id']?:1;

        $articles_query = $this->prepareGeneralField($data);
            $sql = "INSERT INTO `zones_to_geo_zones` SET {$articles_query},`association_id`='{$id}',`date_added`=now()";
            if (!tep_db_query($sql)) {
                return false;
            }
        return true;
    }

    public function update($data) {
        $id = $data['id'];
        unset($data['id']);

        $articles_query = $this->prepareGeneralField($data);
            $sql = "UPDATE `zones_to_geo_zones` SET `last_modified`=now(),{$articles_query} WHERE {$this->prefix_id}={$id} ";
            if (!tep_db_query($sql)) {
                return false;
            }

        return true;
    }

    public function getZones($id = '', $selected_id = ''){
        if(is_numeric($id)) $sql = "select z.zone_id, z.zone_name from zones z where z.zone_country_id = {$id}";
        else $sql = "select z.zone_id, z.zone_name from zones z";
        $arr = $this->getResult($sql);
        $html = '';
        $html .= '<option value="0">'.PLEASE_SELECT.'</option>';
        foreach ($arr as $k => $v){
            $html .= '<option value="'.$v['zone_id'].'"  '.($selected_id == $v['zone_id']?'selected':'').'>'.$v['zone_name'].'</option>';
        }
        return $html;
    }
}