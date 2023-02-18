<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 14.06.2017
 * Time: 15:22
 */

namespace admin\includes\solomono\app\models\email_content;

use admin\includes\solomono\app\core\Model;

include_once(DIR_ROOT . '/' . DIR_WS_CLASSES . 'seo.class.php');

class email_content extends Model
{
    protected $allowed_fields = [
        'email_content_id' => [
            'label' => TABLE_HEADING_ID,
        ],
        'email_name' => [
            'label' => TABLE_HEADING_NAME,
            'general' => 'text',
        ],
        'email_description' => [
            'label' => TABLE_HEADING_DESCRIPTION,
            'type' => 'text',
        ],
        'from_name' => [
            'label' => TABLE_HEADING_FROM_NAME,
            'type' => 'text',
            'show' => false
        ],
        'from_email' => [
            'label' => TABLE_HEADING_FROM_EMAIL,
            'general' => 'text',
            'show' => false
        ],
        'subject' => [
            'label' => TABLE_HEADING_SUBJECT,
            'type' => 'text',
            'show' => false
        ],
        'content_text' => [
            'label' => TABLE_HEADING_CONTENT_TEXT,
            'type' => 'textarea',
            'rows' => 10,
            'show' => false,
        ],
        'content_html' => [
            'label' => TABLE_HEADING_CONTENT_HTML,
            'type' => 'textarea',
            'ckeditor' => true,
            'rows' => 10,
            'show' => false,
        ],
    ];

    protected $option_names = array(
        "create_account" => array(
            TABLE_HEADING_EC_STORE_NAME => 'STORE_NAME',
            TABLE_HEADING_EC_CUSTOMER_NAME => 'CUSTOMER_NAME',
            TABLE_HEADING_EC_CUSTOMER_LOGIN => 'CUSTOMER_LOGIN',
            TABLE_HEADING_EC_CUSTOMER_PASSWORD => 'CUSTOMER_PASSWORD',
            TABLE_HEADING_EC_STORE_LOGO => 'STORE_LOGO',
            TABLE_HEADING_EC_STORE_URL => 'STORE_URL',
            TABLE_HEADING_EC_STORE_OWNER_EMAIL => 'STORE_OWNER_EMAIL',
            TABLE_HEADING_EC_STORE_ADDRESS => 'STORE_ADDRESS',
            TABLE_HEADING_EC_STORE_PHONE => 'STORE_PHONE',
            TABLE_HEADING_EC_STORE_CATEGORIES => 'STORE_CATEGORIES',
        ),
        "create_order" => array(
            TABLE_HEADING_EC_STORE_NAME => 'STORE_NAME',
            TABLE_HEADING_EC_ORDER_NUMBER => 'ORDER_NUMBER',
            TABLE_HEADING_EC_DETAILED_I => 'DETAILED_I',
            TABLE_HEADING_EC_DATE_ORDER => 'DATE_ORDER',
            TABLE_HEADING_EC_CUSTOMER => 'CUSTOMER_NAME',
            TABLE_HEADING_EC_CUSTOMER_EMAIL => 'CUSTOMER_EMAIL',
            TABLE_HEADING_EC_CUSTOMER_PHONE => 'CUSTOMER_PHONE',
            TABLE_HEADING_EC_ORDER_COMMENT => 'ORDER_COMMENT',
            TABLE_HEADING_EC_PRODUCTS => 'PRODUCTS',
            TABLE_HEADING_EC_ORDER_TOTALS => 'ORDER_TOTALS',
            TABLE_HEADING_EC_BILLING_ADDRESS => 'BILLING_ADDRESS',
            TABLE_HEADING_EC_PAYMENT_METHOD => 'PAYMENT_METHOD',
            TABLE_HEADING_EC_SHIPPING_ADDRESS => 'SHIPPING_ADDRESS',
            TABLE_HEADING_EC_STORE_LOGO => 'STORE_LOGO',
            TABLE_HEADING_EC_STORE_URL => 'STORE_URL',
            TABLE_HEADING_EC_STORE_OWNER_EMAIL => 'STORE_OWNER_EMAIL',
            TABLE_HEADING_EC_STORE_ADDRESS => 'STORE_ADDRESS',
            TABLE_HEADING_EC_STORE_PHONE => 'STORE_PHONE',
            TABLE_HEADING_EC_STORE_CATEGORIES => 'STORE_CATEGORIES',
        ),
        "create_account_checkout" => array(
            TABLE_HEADING_EC_STORE_NAME => 'STORE_NAME',
            TABLE_HEADING_EC_CUSTOMER_NAME => 'CUSTOMER_NAME',
            TABLE_HEADING_EC_CUSTOMER_LOGIN => 'CUSTOMER_LOGIN',
            TABLE_HEADING_EC_CUSTOMER_PASSWORD => 'CUSTOMER_PASSWORD',
        ),
        "password_forgotten" => array(
            TABLE_HEADING_EC_STORE_NAME => 'STORE_NAME',
            TABLE_HEADING_EC_CUSTOMER_IP => 'CUSTOMER_IP',
            TABLE_HEADING_EC_NEW_PASSWORD => 'CUSTOMER_PASSWORD',
            TABLE_HEADING_EC_STORE_LOGO => 'STORE_LOGO',
            TABLE_HEADING_EC_STORE_URL => 'STORE_URL',
            TABLE_HEADING_EC_STORE_OWNER_EMAIL => 'STORE_OWNER_EMAIL',
            TABLE_HEADING_EC_STORE_ADDRESS => 'STORE_ADDRESS',
            TABLE_HEADING_EC_STORE_PHONE => 'STORE_PHONE',
            TABLE_HEADING_EC_STORE_CATEGORIES => 'STORE_CATEGORIES',
        ),
        "change_order_status" => array(
            TABLE_HEADING_EC_STORE_NAME => 'STORE_NAME',
            TABLE_HEADING_EC_ORDER_NUMBER => 'ORDER_NUMBER',
            TABLE_HEADING_EC_DETAILED_I => 'DETAILED_I',
            TABLE_HEADING_EC_DATE_ORDER => 'DATE_ORDER',
            TABLE_HEADING_EC_CUSTOMER => 'CUSTOMER_NAME',
            TABLE_HEADING_EC_ORDER_STATUS => 'ORDER_STATUS',
            TABLE_HEADING_EC_ORDER_COMMENT => 'ORDER_COMMENT',
            TABLE_HEADING_EC_STORE_LOGO => 'STORE_LOGO',
            TABLE_HEADING_EC_STORE_URL => 'STORE_URL',
            TABLE_HEADING_EC_STORE_OWNER_EMAIL => 'STORE_OWNER_EMAIL',
            TABLE_HEADING_EC_STORE_ADDRESS => 'STORE_ADDRESS',
            TABLE_HEADING_EC_STORE_PHONE => 'STORE_PHONE',
            TABLE_HEADING_EC_STORE_CATEGORIES => 'STORE_CATEGORIES',
        ),
    );

    protected $prefix_id = 'email_content_id';

    public function select($id = false)
    {
        $sql = "SELECT
                  `ec`.`email_content_id` as id,
                  `ec`.`email_content_id`,
                  `ec`.`email_name`,
                  `ec`.`email_description`,
                  `ec`.`language_id`,
                  `ec`.`from_name`,
                  `ec`.`from_email`,
                  `ec`.`subject`,
                  `ec`.`content_text`,
                  `ec`.`content_html`
                FROM `email_content` `ec` ";
        if ($id) {
            return $sql . " WHERE `ec`.`email_content_id` = {$id}";
        }
        $sql .= " WHERE `ec`.`language_id`='{$this->language_id}'";
        return $sql;
    }

    public function selectOne($id)
    {
        $sql = $this->select($id);
        if ($id) {
            $this->data['data'] = $this->getResultKey($sql, 'language_id');
            $this->data['option_names'] = $this->option_names;
        }
        $this->getLanguages();
    }

    public function update($data)
    {
        $id = $data['id'];
        unset($data['id']);

        //$query=$this->prepareGeneralField($data);
        if ($this->insertUpdate($data, $id, __FUNCTION__)) {
            return true;
        }
        return false;
    }

    public function insert($data)
    {
        $id = tep_db_fetch_array(tep_db_query("select max({$this->prefix_id})+1 as next_id from `{$this->table}`"))['next_id'] ?: 1;

        if ($this->insertUpdate($data, $id, __FUNCTION__)) {
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        if (tep_db_query("DELETE FROM {$this->table} WHERE `{$this->prefix_id}`={$id}")) {
            return true;
        }
        return false;
    }

}