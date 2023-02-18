<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 14.06.2017
 * Time: 15:22
 */

namespace admin\includes\solomono\app\models\test;

use admin\includes\solomono\app\core\Model;
use admin\includes\solomono\app\core\View;

class test extends Model {

    protected $allowed_fields = [
        'manufacturers_name' => [
            'label' => 'Производитель',
            'type'=>'text'
        ],
        'status' => [
            'label' => TABLE_HEADING_STATUS,
            'type' => 'checkbox',
            'show' => false,
        ],
        'date_added' => [
            'label' => 'дата добавления',
        ],
        'manufacturers_image' => [
            'label' => 'Картинка',
            'type' => 'file',
        ],
    ];

    protected $prefix_id = 'manufacturers_id';

    public function __construct() {
        parent::__construct();
        $this->table='manufacturers';
        $this->folder='test';
    }

    public function getView() {
        $obg = new View($this->folder . '/' . $this->folder);
        $obg->render($this->data, $this->folder);
    }

    public function select($id = false) {
        $sql = "SELECT
                  m.{$this->prefix_id},
                  mi.manufacturers_name,
                  manufacturers_image,
                  date_added,
                  last_modified,
                  status
                FROM
                  {$this->table} m JOIN {$this->table}_info mi on
                      mi.manufacturers_id = m.manufacturers_id where
                    mi.languages_id = {$this->language_id}";
        if ($id) {
            $sql .= " where {$this->prefix_id}={$id}";
        }
        $sql.=" ORDER BY manufacturers_name";
        $this->data['data'] = $this->getResult($sql);
        return $this->data['data'];
    }

    public function update($data) {
        $data['last_modified']=date("Y-m-d H:i:s");
        return parent::update($data);
    }

    public function insert($data) {
        $data['date_added']=date("Y-m-d H:i:s");
        return parent::insert($data);
    }


}