<?php

class bank_cart
{
    var $code, $title, $description, $enabled;

// class constructor
    function __construct()
    {
        $this->code = 'bank_cart';
        $this->title = MODULE_PAYMENT_BANK_CART_TRANSFER_TEXT_TITLE . (!isMobile() ? MODULE_PAYMENT_BANK_CART_TRANSFER_IMAGES : '');

            $this->description = sprintf(
                MODULE_PAYMENT_BANK_CART_TRANSFER_TEXT_DESCRIPTION,
                (defined('MODULE_PAYMENT_BANK_CART_TRANSFER_1') ? MODULE_PAYMENT_BANK_CART_TRANSFER_1 : ''), //Name of the bank:
                (defined('MODULE_PAYMENT_BANK_CART_TRANSFER_2') ? MODULE_PAYMENT_BANK_CART_TRANSFER_2 : ''), //Card number:
                (defined('MODULE_PAYMENT_BANK_CART_TRANSFER_3') ? MODULE_PAYMENT_BANK_CART_TRANSFER_3 : ''), //Recipient:
                STORE_OWNER_EMAIL_ADDRESS
            );
            $this->sort_order = MODULE_PAYMENT_BANK_CART_SORT_ORDER;
            $this->email_footer = sprintf(
                MODULE_PAYMENT_BANK_CART_TRANSFER_TEXT_EMAIL_FOOTER,
                (defined('MODULE_PAYMENT_BANK_CART_TRANSFER_1') ? MODULE_PAYMENT_BANK_CART_TRANSFER_1 : ''),
                (defined('MODULE_PAYMENT_BANK_CART_TRANSFER_2') ? MODULE_PAYMENT_BANK_CART_TRANSFER_2 : ''),
                (defined('MODULE_PAYMENT_BANK_CART_TRANSFER_3') ? MODULE_PAYMENT_BANK_CART_TRANSFER_3 : ''),
                STORE_OWNER_EMAIL_ADDRESS
            );

        $this->enabled = MODULE_PAYMENT_BANK_CART_TRANSFER_STATUS;
    }

// class methods

    function selection()
    {
        $field = '<div id="payment-form"><label class="number_field">' . MODULE_PAYMENT_BANK_CART_TEXT_TITLE . '<div id="cardNumber" class="form-control" >' . MODULE_PAYMENT_BANK_CART_TRANSFER_2 . '</div></label></div>';
        $selection = [
            'id' => $this->code,
            'module' => $this->title,
            'fields' => [
                [
                    'title' => '',
                    'field' => $field
                ],
            ]
        ];
        return $selection;
    }

    function pre_confirmation_check()
    {
        return false;
    }

    function confirmation()
    {
            return array('title' => sprintf(
                MODULE_PAYMENT_BANK_CART_TRANSFER_TEXT_DESCRIPTION,
                (defined('MODULE_PAYMENT_BANK_CART_TRANSFER_1') ? MODULE_PAYMENT_BANK_CART_TRANSFER_1 : ''),
                (defined('MODULE_PAYMENT_BANK_CART_TRANSFER_2') ? MODULE_PAYMENT_BANK_CART_TRANSFER_2 : ''),
                (defined('MODULE_PAYMENT_BANK_CART_TRANSFER_3') ? MODULE_PAYMENT_BANK_CART_TRANSFER_3 : ''),
                STORE_OWNER_EMAIL_ADDRESS
            ));
    }

    function process_button()
    {
        return false;
    }

    function before_process()
    {
        return false;
    }

    function after_process()
    {
        return false;
    }

    function get_error()
    {
        return false;
    }

    function check()
    {
        if (!isset($this->check)) {
            $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BANK_CART_TRANSFER_STATUS'");
            $this->check = tep_db_num_rows($check_query);
        }
        return $this->check;
    }

    static function install()
    {
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Предоплата на карту', 'MODULE_PAYMENT_BANK_CART_TRANSFER_STATUS', '1', 'Вы хотите использовать модуль Предоплата на карту? 1 - да, 0 - нет', '6', '1', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Название банка', 'MODULE_PAYMENT_BANK_CART_TRANSFER_1', '', 'Введите название банка', '6', '1', now());");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Номер карти', 'MODULE_PAYMENT_BANK_CART_TRANSFER_2', '', 'Введите Ваш номер карты', '6', '1', now());");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Получатель', 'MODULE_PAYMENT_BANK_CART_TRANSFER_3', '', 'Получатель платежа', '6', '1', now());");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Порядок сортировки.', 'MODULE_PAYMENT_BANK_CART_SORT_ORDER', '0', 'Порядок сортировки модуля.', '6', '0', now())");
    }

    function remove()
    {
        tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", static::keys()) . "')");
    }

    static function keys()
    {
        $keys = array('MODULE_PAYMENT_BANK_CART_TRANSFER_STATUS', 'MODULE_PAYMENT_BANK_CART_TRANSFER_1', 'MODULE_PAYMENT_BANK_CART_TRANSFER_2', 'MODULE_PAYMENT_BANK_CART_TRANSFER_3', 'MODULE_PAYMENT_BANK_CART_SORT_ORDER');

        return $keys;
    }
}
