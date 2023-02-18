<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 14.06.2017
 * Time: 15:22
 */

namespace admin\includes\solomono\app\models\orders;

use admin\includes\solomono\app\core\Model;

class create_order extends Model
{

    protected $allowed_fields = [
        'search' => [
            'label' => TEXT_SELECT_CUST,
            'type' => 'text',
            'placeholder' => TEXT_SELECT_CUST_PLACEHOLDER,
            'autofocus' => true
        ],
        'address_book' => [
            'label' => TEXT_ADDRESS_BOOK,
            'type' => 'select',
            'type_class' => 'disabled'
        ],
        'customers_id' => [
            'label' => 'id',
            'type' => 'text',
            'type_class' => 'disabled'
        ],
        'customers_firstname' => [
            'label' => TEXT_FIRST_NAME,
            'type' => 'text',
            'form_option' => 'required'
        ],
        'customers_lastname' => [
            'label' => TEXT_LAST_NAME,
            'type' => 'text',
            'hideInForm' => ACCOUNT_LAST_NAME,
        ],
        'customers_groups_name' => [
            'label' => TEXT_GROUPS_NAME,
            'type' => 'text',
            'type_class' => 'disabled'
        ],
        'customers_email_address' => [
            'label' => TEXT_EMAIL,
            'type' => 'text'
        ],
        'customers_telephone' => [
            'label' => TEXT_PHONE,
            'type' => 'text',
            'hideInForm' => ACCOUNT_TELE,
        ],
        'customers_fax' => [
            'label' => TEXT_FAX,
            'type' => 'text',
            'hideInForm' => ACCOUNT_FAX,
        ],
        'customers_firm' => [
            'label' => TEXT_FIRM,
            'type' => 'text',
            'hideInForm' => ACCOUNT_COMPANY,
        ],
        'entry_street_address' => [
            'label' => TEXT_ADDRESS,
            'type' => 'text',
            'hideInForm' => ACCOUNT_STREET_ADDRESS,
        ],
        'entry_suburb' => [
            'label' => TEXT_SUBURB,
            'type' => 'text',
            'hideInForm' => ACCOUNT_SUBURB,
        ],
        'entry_postcode' => [
            'label' => TEXT_POSTCODE,
            'type' => 'text',
            'hideInForm' => ACCOUNT_POSTCODE,
        ],
        'entry_city' => [
            'label' => TEXT_CITY,
            'type' => 'text',
            'hideInForm' => ACCOUNT_CITY,
        ],
        'zone_name' => [
            'label' => TEXT_ZONE,
            'type' => 'text',
            'hideInForm' => ACCOUNT_STATE,
        ],
        'countries_name' => [
            'label' => TEXT_COUNTRY,
            'type' => 'text',
            'hideInForm' => ACCOUNT_COUNTRY,
        ],

    ];
    protected $table = 'customers';

    public function __construct()
    {
        foreach ($this->allowed_fields as $k => $v) {
            if (isset($v['hideInForm'])) {
                $this->allowed_fields[$k]['hideInForm'] = $v['hideInForm'] == 'true' ? false : true;
            }
        }
        parent::__construct();
    }

    public function select($search = false)
    {
        $sql = "SELECT
                  `c`.`customers_id` as id,
                  `c`.`customers_firstname` as first_name,
                  `c`.`customers_lastname` as last_name
                FROM `customers` `c`
                WHERE `c`.`customers_id` LIKE '{$search}%' OR `c`.`customers_firstname` LIKE '%{$search}%' OR `c`.`customers_lastname` LIKE '%{$search}%'
                LIMIT 10";
        return $this->getResult($sql);
    }

    public function selectOne($id)
    {
        $sql = "SELECT
                  `c`.`customers_id`,
                  `c`.`customers_firstname`,
                  `c`.`customers_lastname`,
                  `cg`.`customers_groups_name`,
                  `c`.`customers_email_address`,
                  `c`.`customers_telephone`,
                  `c`.`customers_fax`,
                  `ab`.`entry_street_address`,
                  `ab`.`entry_company` as customers_firm,
                  `ab`.`entry_suburb`,
                  `ab`.`entry_postcode`,
                  `ab`.`entry_city`,
                  `z`.`zone_name`,
                  `cntr`.`countries_name`
                FROM `customers` `c`
                  LEFT JOIN `customers_groups` `cg` ON `cg`.`customers_groups_id` = `c`.`customers_groups_id`
                  LEFT JOIN `address_book` `ab` ON `ab`.`address_book_id` = `c`.`customers_default_address_id`
                  LEFT JOIN `zones` `z` ON `z`.`zone_id` = `ab`.`entry_zone_id`
                  LEFT JOIN `countries` `cntr` ON `cntr`.`countries_id` = `ab`.`entry_country_id`
                WHERE `c`.`customers_id` = '{$id}'";
        return $this->getResult($sql)[0];
    }

    public function selectCustomerAddresses($id)
    {
        $sql = "SELECT
                  `ab`.`address_book_id`,
                  `c`.`customers_id`,
                  `c`.`customers_firstname`,
                  `c`.`customers_lastname`,
                  `cg`.`customers_groups_name`,
                  `c`.`customers_email_address`,
                  `c`.`customers_telephone`,
                  `c`.`customers_fax`,
                  `ab`.`entry_street_address`,
                  `ab`.`entry_company` as customers_firm,
                  `ab`.`entry_suburb`,
                  `ab`.`entry_postcode`,
                  `ab`.`entry_city`,
                  `z`.`zone_name`,
                  `cntr`.`countries_name`
                FROM `customers` `c`
                  LEFT JOIN `customers_groups` `cg` ON `cg`.`customers_groups_id` = `c`.`customers_groups_id`
                  LEFT JOIN `address_book` `ab` ON `ab`.`customers_id` = `c`.`customers_id`
                  LEFT JOIN `zones` `z` ON `z`.`zone_id` = `ab`.`entry_zone_id`
                  LEFT JOIN `countries` `cntr` ON `cntr`.`countries_id` = `ab`.`entry_country_id`
                WHERE `c`.`customers_id` = '{$id}' ORDER BY `ab`.`address_book_id` != `c`.`customers_default_address_id`";
        return $this->getResult($sql);
    }

    public function prepareFields(array $fields, $table = null, $prefix_id = null)
    {
        require(DIR_WS_CLASSES . 'currencies.php');
        $currencies = new \currencies();

        $sql_data_array = array(
            'customers_id' => tep_db_prepare_input($fields['customers_id']),
            'customers_name' => tep_db_prepare_input($fields['customers_firstname']) . ' ' . tep_db_prepare_input($fields['customers_lastname']),
            'customers_company' => tep_db_prepare_input($fields['customers_firm']),
            'customers_street_address' => tep_db_prepare_input($fields['entry_street_address']),
            'customers_suburb' => tep_db_prepare_input($fields['entry_suburb']),
            'customers_city' => tep_db_prepare_input($fields['entry_city']),
            'customers_postcode' => tep_db_prepare_input($fields['entry_postcode']),
            'customers_state' => tep_db_prepare_input($fields['zone_name']),
            'customers_country' => tep_db_prepare_input($fields['countries_name']),
            'customers_telephone' => tep_db_prepare_input($fields['customers_telephone']),
            'customers_fax' => tep_db_prepare_input($fields['customers_fax']),
            'customers_email_address' => tep_db_prepare_input($fields['customers_email_address']),
            'customers_address_format_id' => 1,
            'delivery_name' => tep_db_prepare_input($fields['customers_firstname']) . ' ' . tep_db_prepare_input($fields['customers_lastname']),
            'delivery_company' => tep_db_prepare_input($fields['customers_firm']),
            'delivery_street_address' => tep_db_prepare_input($fields['entry_street_address']),
            'delivery_suburb' => tep_db_prepare_input($fields['entry_suburb']),
            'delivery_city' => tep_db_prepare_input($fields['entry_city']),
            'delivery_postcode' => tep_db_prepare_input($fields['entry_postcode']),
            'delivery_state' => tep_db_prepare_input($fields['zone_name']),
            'delivery_country' => tep_db_prepare_input($fields['countries_name']),
            'delivery_address_format_id' => 1,
            'billing_name' => tep_db_prepare_input($fields['customers_firstname']) . ' ' . tep_db_prepare_input($fields['customers_lastname']),
            'billing_company' => tep_db_prepare_input($fields['customers_firm']),
            'billing_street_address' => tep_db_prepare_input($fields['entry_street_address']),
            'billing_suburb' => tep_db_prepare_input($fields['entry_suburb']),
            'billing_city' => tep_db_prepare_input($fields['entry_city']),
            'billing_postcode' => tep_db_prepare_input($fields['entry_postcode']),
            'billing_state' => tep_db_prepare_input($fields['zone_name']),
            'billing_country' => tep_db_prepare_input($fields['countries_name']),
            'billing_address_format_id' => 1,
            'date_purchased' => 'now()',
            'orders_status' => DEFAULT_ORDERS_STATUS_ID,
            'currency' => DEFAULT_CURRENCY,
            'currency_value' => $currencies->currencies[DEFAULT_CURRENCY]['value']
        );
        tep_db_perform(TABLE_ORDERS, $sql_data_array);
        $insert_id = tep_db_insert_id();

        $sql_data_array = array(
            'orders_id' => $insert_id,
            'orders_status_id' => DEFAULT_ORDERS_STATUS_ID,
            'date_added' => 'now()'
        );
        tep_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);

        $sql_data_array = array(
            'orders_id' => $insert_id,
            'title' => TEXT_OP_PRICE . ":",
            'text' => 0,
            'value' => "0.00",
            'class' => "ot_subtotal",
            'sort_order' => "1"
        );
        tep_db_perform(TABLE_ORDERS_TOTAL, $sql_data_array);


        $sql_data_array = array(
            'orders_id' => $insert_id,
            'title' => TEXT_OP_TAX . ":",
            'text' => 0,
            'value' => "0.00",
            'class' => "ot_tax",
            'sort_order' => "2"
        );
        tep_db_perform(TABLE_ORDERS_TOTAL, $sql_data_array);


        $sql_data_array = array(
            'orders_id' => $insert_id,
            'title' => TEXT_OP_SHIPPING . ":",
            'text' => 0,
            'value' => "0.00",
            'class' => "ot_shipping",
            'sort_order' => "3"
        );
        tep_db_perform(TABLE_ORDERS_TOTAL, $sql_data_array);


        $sql_data_array = array(
            'orders_id' => $insert_id,
            'title' => TEXT_OP_TOTAL . ":",
            'text' => 0,
            'value' => "0.00",
            'class' => "ot_total",
            'sort_order' => "4"
        );
        tep_db_perform(TABLE_ORDERS_TOTAL, $sql_data_array);

        return $insert_id;
    }
}