<?php

require(DIR_WS_CLASSES . 'Sms.php');
includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_SUCCESS);

if (SMS_ENABLE == 'true') {
    $customerPhoneNumber = $_POST['phone'] ? formatPhoneNumber($_POST['phone']) : '';
    $gate_name = tep_get_sms_gatename(SMS_GATENAME);
    $product_model = $_POST['model'] ? ', ' . LOW_STOCK_TEXT2 . $_POST['model'] : '';
    $product_id = $_POST['products_id'] ? ', ' . ' (id: ' . $_POST['products_id'] . ')' : '';
    $callback = $_POST['callback'] || '';

    if ($customerPhoneNumber) {
        $options = [
            'to'       => $customerPhoneNumber,
            'from'     => SMS_SIGN,
            'username' => SMS_LOGIN,
            'password' => SMS_PASSWORD,
            'message'  => SMS_NEW_ORDER_BY_ON_CLICK . $product_model . $product_id,
        ];

        // if call back
        if ($callback) {
            $options['message'] = SMS_CALL_BACK . $customerPhoneNumber;
        }

        //Send sms to admin when buying in one click
        if (SMS_OWNER_ENABLE_BUY_ONE_CLICK) {
            $options['to'] = SMS_OWNER_TEL;
            $sms = new Sms($gate_name, $options);
            $sms->send();
        }
    }
}