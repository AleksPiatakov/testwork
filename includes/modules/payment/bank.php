<?php

/*
  $Id: bank.php,v 1.2 2002/11/22

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

class bank
{
    var $code, $title, $description, $enabled;

// class constructor
    function __construct()
    {
        $this->code = 'bank';
        $this->title = MODULE_PAYMENT_BANK_TRANSFER_TEXT_TITLE . (!isMobile() ? MODULE_PAYMENT_BANK_TRANSFER_IMAGES : '');

        if($_SESSION['language'] == 'ukrainian' || $_SESSION['language'] == 'russian'){
            $this->description = sprintf(
                MODULE_PAYMENT_BANK_TRANSFER_TEXT_DESCRIPTION,
                (defined('MODULE_PAYMENT_BANK_TRANSFER_1') ? MODULE_PAYMENT_BANK_TRANSFER_1 : ''), //Назва банку:
                (defined('MODULE_PAYMENT_BANK_TRANSFER_2') ? MODULE_PAYMENT_BANK_TRANSFER_2 : ''), //Розрахунковий рахунок:
                (defined('MODULE_PAYMENT_BANK_TRANSFER_3') ? MODULE_PAYMENT_BANK_TRANSFER_3 : ''), //МФО :
                (defined('MODULE_PAYMENT_BANK_TRANSFER_4') ? MODULE_PAYMENT_BANK_TRANSFER_5 : ''), //ЄДРПОУ/ІПН:
                (defined('MODULE_PAYMENT_BANK_TRANSFER_5') ? MODULE_PAYMENT_BANK_TRANSFER_6 : ''), //Отримувач:
                (defined('MODULE_PAYMENT_BANK_TRANSFER_6') ? MODULE_PAYMENT_BANK_TRANSFER_8 : ''), //Призначення платежу:
                STORE_OWNER_EMAIL_ADDRESS
            );
            $this->sort_order = MODULE_PAYMENT_BANK_SORT_ORDER;
            $this->email_footer = sprintf(
                MODULE_PAYMENT_BANK_TRANSFER_TEXT_EMAIL_FOOTER,
                (defined('MODULE_PAYMENT_BANK_TRANSFER_1') ? MODULE_PAYMENT_BANK_TRANSFER_1 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_2') ? MODULE_PAYMENT_BANK_TRANSFER_2 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_3') ? MODULE_PAYMENT_BANK_TRANSFER_3 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_4') ? MODULE_PAYMENT_BANK_TRANSFER_5 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_5') ? MODULE_PAYMENT_BANK_TRANSFER_6 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_6') ? MODULE_PAYMENT_BANK_TRANSFER_8 : ''),
                STORE_OWNER_EMAIL_ADDRESS
            );
        }else{
            $this->description = sprintf(
                MODULE_PAYMENT_BANK_TRANSFER_TEXT_DESCRIPTION,
                (defined('MODULE_PAYMENT_BANK_TRANSFER_1') ? MODULE_PAYMENT_BANK_TRANSFER_1 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_2') ? MODULE_PAYMENT_BANK_TRANSFER_2 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_3') ? MODULE_PAYMENT_BANK_TRANSFER_3 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_4') ? MODULE_PAYMENT_BANK_TRANSFER_4 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_5') ? MODULE_PAYMENT_BANK_TRANSFER_5 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_6') ? MODULE_PAYMENT_BANK_TRANSFER_6 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_7') ? MODULE_PAYMENT_BANK_TRANSFER_7 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_8') ? MODULE_PAYMENT_BANK_TRANSFER_8 : ''),
                STORE_OWNER_EMAIL_ADDRESS
            );
            $this->sort_order = MODULE_PAYMENT_BANK_SORT_ORDER;
            $this->email_footer = sprintf(
                MODULE_PAYMENT_BANK_TRANSFER_TEXT_EMAIL_FOOTER,
                (defined('MODULE_PAYMENT_BANK_TRANSFER_1') ? MODULE_PAYMENT_BANK_TRANSFER_1 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_2') ? MODULE_PAYMENT_BANK_TRANSFER_2 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_3') ? MODULE_PAYMENT_BANK_TRANSFER_3 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_4') ? MODULE_PAYMENT_BANK_TRANSFER_4 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_5') ? MODULE_PAYMENT_BANK_TRANSFER_5 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_6') ? MODULE_PAYMENT_BANK_TRANSFER_6 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_7') ? MODULE_PAYMENT_BANK_TRANSFER_7 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_8') ? MODULE_PAYMENT_BANK_TRANSFER_8 : ''),
                STORE_OWNER_EMAIL_ADDRESS
            );
        }

        ;
        $this->enabled = MODULE_PAYMENT_BANK_TRANSFER_STATUS;
    }

// class methods

    function selection()
    {
        return array('id' => $this->code,
                   'module' => $this->title);
    }

    function pre_confirmation_check()
    {
        return false;
    }

    function confirmation()
    {
        if($_SESSION['language'] == 'ukranian' || $_SESSION['language'] == 'russian') {
            return array('title' => sprintf(
                MODULE_PAYMENT_BANK_TRANSFER_TEXT_DESCRIPTION,
                (defined('MODULE_PAYMENT_BANK_TRANSFER_1') ? MODULE_PAYMENT_BANK_TRANSFER_1 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_2') ? MODULE_PAYMENT_BANK_TRANSFER_2 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_3') ? MODULE_PAYMENT_BANK_TRANSFER_3 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_4') ? MODULE_PAYMENT_BANK_TRANSFER_5 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_5') ? MODULE_PAYMENT_BANK_TRANSFER_6 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_6') ? MODULE_PAYMENT_BANK_TRANSFER_8 : ''),
                STORE_OWNER_EMAIL_ADDRESS
            ));
        }else{
            return array('title' => sprintf(
                MODULE_PAYMENT_BANK_TRANSFER_TEXT_DESCRIPTION,
                (defined('MODULE_PAYMENT_BANK_TRANSFER_1') ? MODULE_PAYMENT_BANK_TRANSFER_1 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_2') ? MODULE_PAYMENT_BANK_TRANSFER_2 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_3') ? MODULE_PAYMENT_BANK_TRANSFER_3 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_4') ? MODULE_PAYMENT_BANK_TRANSFER_4 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_5') ? MODULE_PAYMENT_BANK_TRANSFER_5 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_6') ? MODULE_PAYMENT_BANK_TRANSFER_6 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_7') ? MODULE_PAYMENT_BANK_TRANSFER_7 : ''),
                (defined('MODULE_PAYMENT_BANK_TRANSFER_8') ? MODULE_PAYMENT_BANK_TRANSFER_8 : ''),
                STORE_OWNER_EMAIL_ADDRESS
            ));
        }
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
            $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BANK_TRANSFER_STATUS'");
            $this->check = tep_db_num_rows($check_query);
        }
        return $this->check;
    }

    static function install()
    {
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Предоплата на счёт', 'MODULE_PAYMENT_BANK_TRANSFER_STATUS', '1', 'Вы хотите использовать модуль Предоплата на счёт? 1 - да, 0 - нет', '6', '1', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Название банка', 'MODULE_PAYMENT_BANK_TRANSFER_1', '', 'Введите название банка', '6', '1', now());");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Расчетный счет', 'MODULE_PAYMENT_BANK_TRANSFER_2', '', 'Введите Ваш расчетный счет', '6', '1', now());");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('МФО', 'MODULE_PAYMENT_BANK_TRANSFER_3', '', 'Введите МФО банка', '6', '1', now());");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Кор./счет', 'MODULE_PAYMENT_BANK_TRANSFER_4', '', 'Введите Кор./счет банка', '6', '1', now());");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ИНН', 'MODULE_PAYMENT_BANK_TRANSFER_5', '', 'Введите ИНН банка', '6', '1', now());");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Получатель', 'MODULE_PAYMENT_BANK_TRANSFER_6', '', 'Получатель платежа', '6', '1', now());");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('КПП', 'MODULE_PAYMENT_BANK_TRANSFER_7', '', 'Введите КПП', '6', '1', now());");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Назначение платежа', 'MODULE_PAYMENT_BANK_TRANSFER_8', '', 'Укажите назначение платежа', '6', '1', now());");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Порядок сортировки.', 'MODULE_PAYMENT_BANK_SORT_ORDER', '0', 'Порядок сортировки модуля.', '6', '0', now())");
    }

    function remove()
    {
        tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", static::keys()) . "')");
    }

    static function keys()
    {
        if($_SESSION['language'] == 'ukranian' || $_SESSION['language'] == 'russian') {
            $keys = array('MODULE_PAYMENT_BANK_TRANSFER_STATUS', 'MODULE_PAYMENT_BANK_TRANSFER_1', 'MODULE_PAYMENT_BANK_TRANSFER_2', 'MODULE_PAYMENT_BANK_TRANSFER_3', 'MODULE_PAYMENT_BANK_TRANSFER_5', 'MODULE_PAYMENT_BANK_TRANSFER_6', 'MODULE_PAYMENT_BANK_TRANSFER_8', 'MODULE_PAYMENT_BANK_SORT_ORDER'); // 'MODULE_PAYMENT_BANK_TRANSFER_4', 'MODULE_PAYMENT_BANK_TRANSFER_7'
        }else{
            $keys = array('MODULE_PAYMENT_BANK_TRANSFER_STATUS', 'MODULE_PAYMENT_BANK_TRANSFER_1', 'MODULE_PAYMENT_BANK_TRANSFER_2', 'MODULE_PAYMENT_BANK_TRANSFER_3', 'MODULE_PAYMENT_BANK_TRANSFER_4', 'MODULE_PAYMENT_BANK_TRANSFER_5', 'MODULE_PAYMENT_BANK_TRANSFER_6', 'MODULE_PAYMENT_BANK_TRANSFER_7', 'MODULE_PAYMENT_BANK_TRANSFER_8', 'MODULE_PAYMENT_BANK_SORT_ORDER');

        }
        return $keys;
    }
}
