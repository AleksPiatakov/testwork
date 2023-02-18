<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 14.06.2017
 * Time: 15:22
 */

namespace admin\includes\solomono\app\models\ship2fields;

use admin\includes\solomono\app\core\Model;

include_once(DIR_ROOT . '/' . DIR_WS_CLASSES . 'seo.class.php');

class ship2fields extends Model
{
    protected $title = [
        'label' => ''
    ];

    protected $allowed_fields = [
        'shipping_code' => [
            'label' => MODULE_SHIPPING_CODE_TITLE,
            'general' => 'hidden',
            'show' => false,
        ],
        'field_title' => [
            'label' => MODULE_FIELD_NAME_TITLE,
            'type' => 'text',
        ],
        'field_allowed' => [
            'label' => MODULE_ALLOWED_TITLE,
            'type' => 'status',
            'hideInForm' => true,
        ],
        'field_required' => [
            'label' => MODULE_REQUIRED_TITLE,
            'type' => 'status',
            'class' => 'status',
            'hideInForm' => true,
        ],
        'min_length' => [
            'label' => MODULE_MIN_LENGTH_TITLE,
            'general' => 'text',
            'type' => 'text',
            'hideInForm' => true,
        ],
    ];

    protected $prefix_id = 'id';
    protected $shippingCode = false;

    public function select($id = false)
    {
        $sql = "select s2f.id,
                        s2f.shipping_code,
                        s2f.field_allowed,
                        s2f.field_required,
                        s2f.min_length,
                        s2fd.language_id,
                        s2fd.field_title
				from " . TABLE_SHIP2FIELDS . " s2f
				LEFT JOIN " . TABLE_SHIP2FIELDS_DESCRIPTION . " s2fd ON s2fd.id = s2f.id";

        if ($id) {
            $sql .= " where s2f.id = '" . $id . "'";
        } else {
            $sql .= " where s2fd.language_id = '" . $this->language_id . "'";
        }
        if (!empty($this->shippingCode)) {
            $sql .= " and s2f.shipping_code = '" . $this->shippingCode . "'";
        }

        return $sql;
    }

    public function selectOne($id, $request = [])
    {
        $this->shippingCode = $request['module'] ?: false;
        if (!empty($this->shippingCode)) {
            $this->data['allowed_fields']['shipping_code']['default'] = $this->shippingCode;
        }
        if ($id) {
            $sql = $this->select($id);
            $this->data['data'] = $this->getResultKey($sql, 'language_id');
        }
        $this->getLanguages();
    }

    public function query($request)
    {
        $this->shippingCode = $request['module'] ?: false;
        parent::query($request);
    }

    public function update($data)
    {
        $id = $data['id'];
        unset($data['id']);

        $query = $this->prepareGeneralField($data);

        if ($this->insertUpdate($data, $id, __FUNCTION__, TABLE_SHIP2FIELDS_DESCRIPTION, 'language_id')) {
            $sql = "INSERT INTO " . TABLE_SHIP2FIELDS . " SET {$query},`$this->prefix_id`='{$id}' ON DUPLICATE KEY UPDATE {$query},`$this->prefix_id`='{$id}'";
            if (!tep_db_query($sql)) {
                return false;
            }
        }
        return true;
    }

    public function insert($data)
    {
        $id = $data['id'] ?: (tep_db_fetch_array(tep_db_query("select max({$this->prefix_id})+1 as next_id from " . TABLE_SHIP2FIELDS))['next_id'] ?: 1);
        $idDescription = (tep_db_fetch_array(tep_db_query("select max({$this->prefix_id})+1 as next_id from " . TABLE_SHIP2FIELDS_DESCRIPTION))['next_id'] ?: 1);
        $id = $idDescription > $id ? $idDescription : $id;
        unset($data['id']);

        $query = $this->prepareGeneralField($data);

        if ($this->insertUpdate($data, $id, __FUNCTION__, TABLE_SHIP2FIELDS_DESCRIPTION, 'language_id')) {
            $sql = "INSERT INTO " . TABLE_SHIP2FIELDS . " SET {$query},`$this->prefix_id`='{$id}'";
            if (!tep_db_query($sql)) {
                return false;
            }
        }
        return array(
            "success" => "true",
            'id' => $id
        );
    }

    public function delete($id)
    {
        tep_db_query("DELETE FROM `{$this->table}` WHERE `{$this->prefix_id}`={$id}");
        tep_db_query("DELETE FROM " . TABLE_SHIP2FIELDS_DESCRIPTION . " WHERE `{$this->prefix_id}`={$id}");
        return true;
    }

}