<?php

/*
  $Id: cc.php,v 1.1.1.1 2003/09/18 19:05:03 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

class cc
{
    var $code, $title, $description, $enabled;

// class constructor
    function __construct()
    {
        global $order;

        $this->code = 'cc';
        $this->title = MODULE_PAYMENT_CC_TEXT_TITLE . (!isMobile() ? MODULE_PAYMENT_CC_IMAGES : '');
        $this->description = MODULE_PAYMENT_CC_TEXT_DESCRIPTION;
        $this->sort_order = MODULE_PAYMENT_CC_SORT_ORDER;
        $this->enabled = ((MODULE_PAYMENT_CC_STATUS == 'True') ? true : false);

        if ((int)MODULE_PAYMENT_CC_ORDER_STATUS_ID > 0) {
            $this->order_status = MODULE_PAYMENT_CC_ORDER_STATUS_ID;
        }

        if (is_object($order)) {
            $this->update_status();
        }
    }

// class methods
    function update_status()
    {
        global $order;

        if (
            $this->enabled == true &&
            (int)getConstantValue('MODULE_PAYMENT_CC_ZONE', 0) > 0 &&
            getConstantValue('ACCOUNT_COUNTRY') == 'true' && getConstantValue('ACCOUNT_STATE') == 'true'
        ) {
            $check_flag = false;
            $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . (int)MODULE_PAYMENT_CC_ZONE . "' and (zone_country_id = '" . (int)$order->billing['country']['id'] . "' or zone_country_id=0) order by zone_id");
            while ($check = tep_db_fetch_array($check_query)) {
                if ($check['zone_id'] < 1) {
                    $check_flag = true;
                    break;
                } elseif ($check['zone_id'] == $order->billing['zone_id']) {
                    $check_flag = true;
                    break;
                }
            }

            if ($check_flag == false) {
                $this->enabled = false;
            }
        }
    }

    function selection()
    {
        global $order;

        for ($i = 1; $i < 13; $i++) {
            $expires_month[] = array(
                'id' => sprintf('%02d', $i),
                'text' => strftime('%B', mktime(0, 0, 0, $i, 1, 2000))
            );
        }

        $today = getdate();
        for ($i = $today['year']; $i < $today['year'] + 10; $i++) {
            $expires_year[] = array(
                'id' => strftime('%y', mktime(0, 0, 0, 1, 1, $i)),
                'text' => strftime('%Y', mktime(0, 0, 0, 1, 1, $i))
            );
        }

        if (isMobile()) {
            $ccFields = '
          <div class="new_payment_form">
              <div id="payment-form">
                  <span class="payment-errors"></span>
                  <label class="number_field">
                      ' . MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER . tep_draw_input_field(
                    'cc_number',
                    isset($_SESSION['cc_number']) ? $_SESSION['cc_number'] : '',
                    'inputmode="numeric" onkeypress="validateCheckoutInput(event)" maxlength="16" class="form-control full-width-field" placeholder="0000 0000 0000 0000"',
                    'tel'
                ) . '
                  </label>
                  <label class="cvc_field">
                      ' . MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_CVC . tep_draw_password_field(
                    'cvvnumber',
                    '',
                    'inputmode="numeric" onkeypress="validateCheckoutInput(event)" size="5" maxlength="4" class="form-control" placeholder="***"'
                ) . '
                  </label>
                  <label class="month_field">
                      ' . MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES_MM . tep_draw_input_field(
                    'cc_expires_month',
                    '',
                    'inputmode="numeric" onkeypress="validateCheckoutInput(event)" maxlength="2" class="form-control required checkout_inputs" placeholder="' . MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES_MM_PLACEHOLDER . '"',
                    'tel'
                ) . '
                   </label>        
                  <label class="year_field">
                      ' . MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES_YY . tep_draw_input_field(
                    'cc_expires_year',
                    '',
                    'inputmode="numeric" onkeypress="validateCheckoutInput(event)" maxlength="2" class="form-control required checkout_inputs" placeholder="' . MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES_YY_PLACEHOLDER . '"',
                    'tel'
                ) . '
                  </label>
              </div>
          </div> ';
        } else {
            $ccFields = '
          <div class="new_payment_form">
              <div id="payment-form">
                  <span class="payment-errors"></span>
                  <label class="number_field">
                      ' . MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER . tep_draw_input_field(
                    'cc_number',
                    isset($_SESSION['cc_number']) ? $_SESSION['cc_number'] : '',
                    'onkeypress="validateCheckoutInput(event)" maxlength="16" class="form-control full-width-field" placeholder="0000 0000 0000 0000"',
                    'tel'
                ) . '
                  </label>
                  <label class="month_field">
                      ' . MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES_MM . tep_draw_input_field(
                    'cc_expires_month',
                    '',
                    'onkeypress="validateCheckoutInput(event)" maxlength="2" class="form-control required checkout_inputs" placeholder="' . MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES_MM_PLACEHOLDER . '"',
                    'tel'
                ) . '
                   </label>        
                  <label class="year_field">
                      ' . MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES_YY . tep_draw_input_field(
                    'cc_expires_year',
                    '',
                    'onkeypress="validateCheckoutInput(event)" maxlength="2" class="form-control required checkout_inputs" placeholder="' . MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES_YY_PLACEHOLDER . '"',
                    'tel'
                ) . '
                  </label>
                  <label class="cvc_field">
                      ' . MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_CVC . tep_draw_password_field(
                    'cvvnumber',
                    '',
                    'onkeypress="validateCheckoutInput(event)" size="5" maxlength="4" class="form-control" placeholder="***"'
                ) . '
                  </label>
              </div>
          </div> ';
        }

        $selection = [
            'id' => $this->code,
            'module' => $this->title,
            'fields' => [
//                [
//                    'title' => '',
//                    'field' => tep_draw_input_field('cc_owner', $order->billing['firstname'] . ' ' . $order->billing['lastname'],
//                        'class="form-control full-width-field" placeholder="'.MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER.'"')
//                ],
                [
                    'title' => '',
                    'field' => $ccFields
                ],
            ]
        ];

        return $selection;
    }

    function pre_confirmation_check()
    {
        global $_POST, $order;

        include(DIR_WS_CLASSES . 'cc_validation.php');

        $cc_validation = new cc_validation();
        $result = $cc_validation->validate($_POST['cc_number'], $_POST['cc_expires_month'], $_POST['cc_expires_year']);

        $error = '';
        switch ($result) {
            case -1:
                $error = sprintf(TEXT_CCVAL_ERROR_UNKNOWN_CARD, substr($cc_validation->cc_number, 0, 4));
                break;
            case -2:
            case -3:
            case -4:
                $error = TEXT_CCVAL_ERROR_INVALID_DATE;
                break;
            case false:
                $error = TEXT_CCVAL_ERROR_INVALID_NUMBER;
                break;
        }

        if (($result == false) || ($result < 1)) {
            $payment_error_return = 'payment_error=' . $this->code . '&error=' . urlencode($error) . '&cc_owner=' . urlencode($_POST['cc_owner']) . '&cc_expires_month=' . $_POST['cc_expires_month'] . '&cc_expires_year=' . $_POST['cc_expires_year'];

            tep_redirect(tep_href_link(FILENAME_CHECKOUT, $payment_error_return, 'SSL', true, false));
        }

        $this->cc_card_type = $cc_validation->cc_type;
        $this->cc_card_number = $cc_validation->cc_number;

        $order->info['cc_number'] = $_POST['cc_number'];
        $order->info['cc_type'] = $_POST['cc_type'];
        $order->info['cc_owner'] = $_POST['cc_owner'];
        $order->info['cc_expires'] = $_POST['cc_expires_month'] . $_POST['cc_expires_year'];
        $order->info['cvvnumber'] = $_POST['cvvnumber'];
    }

    function confirmation()
    {
        global $_POST;

        $confirmation = array(
            'title' => $this->title . ': ' . $this->cc_card_type,
            'fields' => array(
                array(
                    'title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER,
                    'field' => $_POST['cc_owner']
                ),
                array(
                    'title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER,
                    'field' => substr($this->cc_card_number, 0, 4) . str_repeat(
                            'X',
                            (strlen($this->cc_card_number) - 8)
                        ) . substr($this->cc_card_number, -4)
                ),
                array(
                    'title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES,
                    'field' => strftime(
                        '%B, %Y',
                        mktime(0, 0, 0, $_POST['cc_expires_month'], 1, '20' . $_POST['cc_expires_year'])
                    )
                )
            )
        );

        return $confirmation;
    }

    function process_button()
    {
        global $_POST;

        $process_button_string = tep_draw_hidden_field(
                'cc_owner',
                $_POST['cc_owner']
            ) . tep_draw_hidden_field(
                'cc_expires',
                $_POST['cc_expires_month'] . $_POST['cc_expires_year']
            ) . tep_draw_hidden_field(
                'cc_type',
                $this->cc_card_type
            ) . tep_draw_hidden_field('cc_number', $this->cc_card_number);

        return $process_button_string;
    }

    function before_process()
    {
        global $_POST, $order;

        if ((defined('MODULE_PAYMENT_CC_EMAIL')) && (tep_validate_email(MODULE_PAYMENT_CC_EMAIL))) {
            $len = strlen($_POST['cc_number']);

            $this->cc_middle = substr($_POST['cc_number'], 4, ($len - 8));
            $order->info['cc_number'] = substr($_POST['cc_number'], 0, 4) . str_repeat(
                    'X',
                    (strlen($_POST['cc_number']) - 8)
                ) . substr($_POST['cc_number'], -4);
        }
    }

    function after_process()
    {
        global $insert_id;

        if ((defined('MODULE_PAYMENT_CC_EMAIL')) && (tep_validate_email(MODULE_PAYMENT_CC_EMAIL))) {
            $message = 'Order number ' . $insert_id . "\n\n" . 'Average numbers: ' . $this->cc_middle . "\n\n";

            tep_mail(
                '',
                MODULE_PAYMENT_CC_EMAIL,
                'Information on the order number: ' . $insert_id,
                $message,
                STORE_OWNER,
                STORE_OWNER_EMAIL_ADDRESS
            );
        }
    }

    function get_error()
    {
        global $_GET;

        $error = array(
            'title' => MODULE_PAYMENT_CC_TEXT_ERROR,
            'error' => stripslashes(urldecode($_GET['error']))
        );

        return $error;
    }

    function check()
    {
        if (!isset($this->_check)) {
            $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_CC_STATUS'");
            $this->_check = tep_db_num_rows($check_query);
        }
        return $this->_check;
    }

    static function install()
    {
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('?????????????????? ???????????? ???????????? ?????????????????? ????????????????', 'MODULE_PAYMENT_CC_STATUS', 'True', '???????????? ???? ???? ?????????????????? ?????????????? ?? ?????????????? ?????????????????? ?????????????????', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('E-Mail ??????????', 'MODULE_PAYMENT_CC_EMAIL', '', '???????? ???????????? e-mail ??????????, ???? ???? ?????????????????? e-mail ?????????? ?????????? ???????????????????????? ?????????????? ?????????? ???? ???????????? ?????????????????? ???????????????? (?? ???????? ???????????? ?????????? ?????????????????? ???????????? ?????????? ?????????????????? ??????????, ???? ?????????????????????? ???????????? ?????????????? ????????)', '6', '0', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('?????????????? ????????????????????.', 'MODULE_PAYMENT_CC_SORT_ORDER', '0', '?????????????? ???????????????????? ????????????.', '6', '0' , now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('????????', 'MODULE_PAYMENT_CC_ZONE', '0', '???????? ?????????????? ????????, ???? ???????????? ???????????? ???????????? ?????????? ?????????? ???????????? ?????????????????????? ???? ?????????????????? ????????.', '6', '2', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('???????????? ????????????', 'MODULE_PAYMENT_CC_ORDER_STATUS_ID', '0', '????????????, ?????????????????????? ?? ???????????????????????????? ?????????????? ???????????? ???????????? ?????????? ?????????????????? ?????????????????? ????????????.', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
    }

    function remove()
    {
        tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode(
                "', '",
                static::keys()
            ) . "')");
    }

    static function keys()
    {
        return array(
            'MODULE_PAYMENT_CC_STATUS',
            'MODULE_PAYMENT_CC_EMAIL',
            'MODULE_PAYMENT_CC_ZONE',
            'MODULE_PAYMENT_CC_ORDER_STATUS_ID',
            'MODULE_PAYMENT_CC_SORT_ORDER'
        );
    }
}
