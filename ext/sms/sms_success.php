<?php

require(DIR_WS_CLASSES . 'Sms.php');

if (SMS_ENABLE == 'true') {
    $customerPhoneNumber = formatPhoneNumber($_SESSION['onepage']['customer']['telephone']);
    $gate_name = tep_get_sms_gatename(SMS_GATENAME);
    if ($customerPhoneNumber) {
        $options = [
            'to'       => $customerPhoneNumber,
            'from'     => SMS_SIGN,
            'username' => SMS_LOGIN,
            'password' => SMS_PASSWORD,
            'message'  => HEADING_TITLE . ' #' . $_GET['order_id'] . '. ' . SMS_OWNER_TEL,
        ];

        if (defined('SMS_TEXT') && SMS_TEXT) {
            $text = SMS_TEXT;
            $options['message'] = $text;
        }

        //Відправляти sms клієнту при покупці
        if (SMS_CUSTOMER_ENABLE) {
            $sms = new Sms($gate_name, $options);
            $sms->send();
        }

        //Отправлять sms админу при покупке
        if (SMS_OWNER_ENABLE) {
            $options['to'] = SMS_OWNER_TEL;
            $options['message'] = SMS_NEW_ORDER . ': #' . $_GET['order_id'] . '!';
            $sms = new Sms($gate_name, $options);
            $sms->send();
        }
    }
}