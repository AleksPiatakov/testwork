<?php
$assets->jsCheckoutInline[] = "
    var addressTypeConfiguration = " . json_encode($addressTypeIdentificators) . "
    var minLengthArray = " . json_encode($minLengthArray) . ";
    var onePage = checkout;
    onePage.initializing = true;
    onePage.ajaxCharset = 'utf-8';
    onePage.storeName = '" . addslashes(STORE_NAME) . "';
    onePage.loggedIn = " . (tep_session_is_registered('customer_id') ? 'true' : 'false') . ";
    onePage.autoshow = " . ((ONEPAGE_AUTO_SHOW_BILLING_SHIPPING == 'False') ? 'false' : 'true') . ";
    onePage.stateEnabled = " . (ACCOUNT_STATE == 'true' ? 'true' : 'false') . ";
    onePage.showAddressInFields = " . ((ONEPAGE_CHECKOUT_SHOW_ADDRESS_INPUT_FIELDS == 'False') ? 'false' : 'true') . ";
    onePage.showMessagesPopUp = " . ((ONEPAGE_CHECKOUT_LOADER_POPUP == 'True') ? 'true' : 'false') . ";
    onePage.ccgvInstalled = " . getConstantValue('MODULE_ORDER_TOTAL_COUPON_STATUS', 'false') . ";

    onePage.refresh = '" . addslashes(getConstantValue('CH_JS_REFRESH')) . "';
    onePage.refresh_method = '" . addslashes(getConstantValue('CH_JS_REFRESH_METHOD')) . "';
    onePage.setting_method = '" . addslashes(getConstantValue('CH_JS_SETTING_METHOD')) . "';
    onePage.setting_address = '" . addslashes(getConstantValue('CH_JS_SETTING_ADDRESS')) . "';
    onePage.setting_address_ship = '" . addslashes(getConstantValue('CH_JS_SETTING_ADDRESS_SHIP')) . "';
    onePage.setting_address_bil = '" . addslashes(getConstantValue('CH_JS_SETTING_ADDRESS_BIL')) . "';

    onePage.error_scart = '" . addslashes(getConstantValue('CH_JS_ERROR_SCART')) . "';
    onePage.error_some1 = '" . addslashes(getConstantValue('CH_JS_ERROR_SOME1')) . "';
    onePage.error_some2 = '" . addslashes(getConstantValue('CH_JS_ERROR_SOME2')) . "';
    onePage.error_set_some1 = '" . addslashes(getConstantValue('CH_JS_ERROR_SET_SOME1')) . "';
    onePage.error_set_some2 = '" . addslashes(getConstantValue('CH_JS_ERROR_SET_SOME2')) . "';
    onePage.error_set_some3 = '" . addslashes(getConstantValue('CH_JS_ERROR_SET_SOME3')) . "';
    onePage.error_req_bil = '" . addslashes(getConstantValue('CH_JS_ERROR_REQ_BIL')) . "';
    onePage.error_err_bil = '" . addslashes(getConstantValue('CH_JS_ERROR_ERR_BIL')) . "';
    onePage.error_req_ship = '" . addslashes(getConstantValue('CH_JS_ERROR_REQ_SHIP')) . "';
    onePage.error_err_ship = '" . addslashes(getConstantValue('CH_JS_ERROR_ERR_SHIP')) . "';
    onePage.error_address = '" . addslashes(getConstantValue('CH_JS_ERROR_ADDRESS')) . "';
    onePage.error_pmethod = '" . addslashes(getConstantValue('CH_JS_ERROR_PMETHOD')) . "';
    onePage.error_select_pmethod = '" . addslashes(getConstantValue('CH_JS_ERROR_SELECT_PMETHOD')) . "';
    onePage.check_email = '" . addslashes(getConstantValue('CH_JS_CHECK_EMAIL')) . "';
    onePage.error_email = '" . addslashes(getConstantValue('CH_JS_ERROR_EMAIL')) . "';

    onePage.shippingEnabled = " . ($onepage['shippingEnabled'] === true ? 'true' : 'false') . ";
    onePage.pageLinks = {}

    function getFieldErrorCheck(element){
        var rObj = {};
        var name = element.attr('name');
        var minLength = 1;
        var errMsg = '';
        if(name && name.indexOf('shipping_fields') == 0){
            nameInfo = name.split('[');
            name = nameInfo[0];
            shipmentKey = element.data('shipment');
            fieldId = nameInfo[1].replace(']','');
            minLength = (typeof minLengthArray[shipmentKey] != undefined && typeof minLengthArray[shipmentKey][fieldId] != undefined) ? minLengthArray[shipmentKey][fieldId] : minLength;
            errMsg = '" . addslashes(ENTRY_CUSTOMER_FIELDS_ERROR) . "'.replace('%s', minLength);
        }
        switch(name){  
            case 'billing_firstname':
            case 'shipping_firstname':
                rObj.minLength = " . addslashes(ENTRY_FIRST_NAME_MIN_LENGTH) . ";
                rObj.errMsg = '" . addslashes(sprintf(ENTRY_FIRST_NAME_ERROR, ENTRY_FIRST_NAME_MIN_LENGTH)) . "';
                break;
            case 'billing_lastname':
            case 'shipping_lastname':
                rObj.minLength = " . addslashes(ENTRY_LAST_NAME_MIN_LENGTH) . ";
                rObj.errMsg = '" . addslashes(sprintf(ENTRY_LAST_NAME_ERROR, ENTRY_LAST_NAME_MIN_LENGTH)) . "';
                break;
            case 'billing_email_address':
                rObj.minLength = " . addslashes(ENTRY_EMAIL_ADDRESS_MIN_LENGTH) . ";
                rObj.errMsg = '" . addslashes(sprintf(ENTRY_EMAIL_ADDRESS_ERROR, ENTRY_EMAIL_ADDRESS_MIN_LENGTH)) . "';
                break;
            case 'billing_street_address':
            case 'shipping_street_address':
                rObj.minLength = " . addslashes(ENTRY_STREET_ADDRESS_MIN_LENGTH) . ";
                rObj.errMsg = '" . addslashes(sprintf(ENTRY_STREET_ADDRESS_ERROR, ENTRY_STREET_ADDRESS_MIN_LENGTH)) . "';
                break;
            case 'billing_zipcode':
            case 'shipping_zipcode':
                rObj.minLength = " . addslashes(ENTRY_POSTCODE_MIN_LENGTH) . ";
                rObj.errMsg = '" . addslashes(sprintf(ENTRY_POST_CODE_ERROR, ENTRY_POSTCODE_MIN_LENGTH)) . "';
                break;
            case 'shipping_suburb':
            case 'billing_suburb':
                rObj.minLength = " . addslashes(ENTRY_STATE_MIN_LENGTH) . ";
                rObj.errMsg = '" . addslashes(ENTRY_SUBURB_ERROR) . "';
                break;
            case 'billing_city':
            case 'shipping_city':
                rObj.minLength = " . addslashes(ENTRY_CITY_MIN_LENGTH) . ";
                rObj.errMsg = '" . addslashes(sprintf(ENTRY_CITY_ERROR, ENTRY_CITY_MIN_LENGTH)) . "';
                break;
            case 'billing_telephone':
                rObj.minLength = " . addslashes(ENTRY_TELEPHONE_MIN_LENGTH) . ";
                rObj.errMsg = '" . addslashes(sprintf(ENTRY_TELEPHONE_NUMBER_ERROR, ENTRY_TELEPHONE_MIN_LENGTH)) . "';
                break;
            case 'billing_country':
            case 'shipping_country':
                rObj.errMsg = '" . addslashes(ENTRY_COUNTRY_ERROR) . "';
                break;
            case 'billing_state':
            case 'delivery_state':
                rObj.minLength = " . addslashes(ENTRY_STATE_MIN_LENGTH) . ";
                rObj.errMsg = '" . addslashes(sprintf(ENTRY_STATE_ERROR, ENTRY_STATE_MIN_LENGTH)) . "';
                break;
            case 'shipping_zone_id':
            case 'billing_zone_id':
                rObj.minLength = " . addslashes(ENTRY_STATE_MIN_LENGTH) . ";
                rObj.errMsg = '" . addslashes(sprintf(ENTRY_STATE_ERROR, ENTRY_STATE_MIN_LENGTH)) . "';
                break;
            case 'password':
            case 'confirmation':
                rObj.minLength = " . addslashes(ENTRY_PASSWORD_MIN_LENGTH) . ";
                rObj.errMsg = '" . addslashes(sprintf(ENTRY_PASSWORD_ERROR, ENTRY_PASSWORD_MIN_LENGTH)) . "';
                break;
            case 'shipping_fields':
                rObj.minLength = minLength;
                rObj.errMsg = errMsg;
                break;
        }
    return rObj;
    }
    function clearRadeos(){
        return true;
    }";
$assets->jsInDocumentReady[] = "
    if (page_name == 'checkout'){
        $('#pageContentContainer').show();
        onePage.initCheckout();
    }";
?>