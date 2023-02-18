<?php

namespace admin\includes\solomono\app\models\stats_search_keywords;
use admin\includes\solomono\app\core\Model;
include_once(DIR_ROOT . '/' . DIR_WS_CLASSES . 'seo.class.php');

class stats_search_keywords extends Model {

    protected $allowed_fields=[
        'products_name'=>[
            'label'=>'keywords',
            'general'=>'text',
            'sort'=>true,
            'filter'=>true,
        ],
        'length'=>[
            'label'=>'length',
            'general'=>'text',
            'sort'=>false,
            'filter'=>false,
        ],
        'url'=>[
            'label'=>'url',
            'general'=>'text',
            'sort'=>false,
            'filter'=>false,
        ],
    ];

    public function select() {
        $sql="select pd.products_id as id,
                     pd.products_name,
                     LENGTH(pd.products_description) as length
                from " . TABLE_PRODUCTS_DESCRIPTION . " pd
                left join " . TABLE_PRODUCTS . " p on pd.products_id = p.products_id 
               where pd.language_id = {$this->language_id} and p.products_status = 1";
        return $sql;
    }

    public function query($request) {
        $request['order'] = $request['order']?:'products_name-asc';
        parent::query($request);
        $this->getKeywords();
    }

    private function getKeywords(){
        foreach ($this->data['data'] as $k => $v){
            $productKeywords = explode(' ', $this->data['data'][$k]['products_name']);
            foreach($productKeywords as $kw) {
                if(strlen($kw)>2){
                    unset($v['products_name']);
                    $pKArray[strtolower($kw)] = $v;
                }
            }
        }
        unset($this->data['data']);
        if(!empty($pKArray)){
            krsort($pKArray);
            foreach ($pKArray as $k => $v) {
                $url = '<a href="'.tep_href_link(FILENAME_PRODUCTS,'pID='.$v['id'].'&action=new_product').'">'.tep_image(DIR_WS_ICONS . 'icon_properties_add.gif', ICON_PREVIEW).'</a>';
                $this -> data['data'][] = ['products_name' => $k, 'length' => $v['length'], 'url'=>$url];
            }
        }
    }

}