var submitter = null;
var paymentVals = [];
var addPaymentInfo = false;
var shippingPaymentFieldsBuf = [];
var withoutRegistrationFlag = false;

function echeck(str) {

    var at="@";
    var dot=".";
    var lat=str.indexOf(at);
    var lstr=str.length;
    var ldot=str.indexOf(dot);
    if (str.indexOf(at) === -1) {
       return false
    }

    if (str.indexOf(at) === -1 || str.indexOf(at) === 0 || str.indexOf(at) === lstr) {
       return false
    }

    if (str.indexOf(dot) === -1 || str.indexOf(dot) === 0 || str.indexOf(dot) === lstr) {
        return false
    }

    if (str.indexOf(at,(lat+1)) !== -1) {
       return false
    }

    if (str.substring(lat-1,lat) === dot || str.substring(lat+1,lat+2) === dot) {
       return false
    }

    if (str.indexOf(dot,(lat+2)) === -1) {
       return false
    }

    if (str.indexOf(" ") !== -1) {
       return false
    }
    var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    if (!(filter.test(str))) {return false}

    return true
}

function submitFunction() {
    submitter = 1;
}

function bindAutoFill($el) {
    if ($el.attr('type') === 'select-one') {
        var method = 'change';
    } else {
        var method = 'blur';
    }
    
    $el.blur(unsetFocus).focus(setFocus);
    
    if (document.attachEvent){
        $el.get(0).attachEvent('onpropertychange', function (){
            if ($(event.srcElement).data('hasFocus') && $(event.srcElement).data('hasFocus') == 'true') return;
            if ($(event.srcElement).val() != '' && $(event.srcElement).hasClass('required')) {
                $(event.srcElement).trigger(method);
            }
        });
    } else {
        $el.get(0).addEventListener('onattrmodified', function (e) {
            if ($(e.currentTarget).data('hasFocus') && $(e.currentTarget).data('hasFocus') == 'true') return;
            if ($(e.currentTarget).val() != '' && $(e.currentTarget).hasClass('required')){
                $(e.currentTarget).trigger(method);
            }
        }, false);
    }
}

function isValidCC(ccNumber) {
    var regList = [
        '^(?:3[47][0-9]{13})$', //american express
        '(?:4[0-9]{12}(?:[0-9]{3})?)$', //visa
        '^(?:5[1-5][0-9]{14})$', // master card
        '^(?:6(?:011|5[0-9][0-9])[0-9]{12})$', //discover
        '^(?:3(?:0[0-5]|[68][0-9])[0-9]{11})$', //dinner club
        '^(?:2131|1800|35[0-9]{3})[0-9]{11}$'    // jcb
    ];
    regList = regList.map(function(x){return "("+x+")";}).join('|');
    var regExp = new RegExp(regList);
    return regExp.test(ccNumber);
}

function setFocus() {
    $(this).data('hasFocus', 'true');
}

function unsetFocus() {
    var elementValue = $(this).val();
    $(this).val(elementValue.trim());
    $(this).data('hasFocus', 'false');
}

var checkout = {
    firstPaymentCall: true,
    firstShippingCall: true,
    charset: 'utf8',
    pageLinks: {},
    loadCheckout:true,
    checkoutSetModule:false,
    errors:true,
    checkoutClicked:false,
    checkoutSubmitted:false,
    checkoutBeforeSubmitted:false,
    amountRemaininginTotal:true,
    billingInfoChanged: false,
    shippingInfoChanged: false,
    checkedEmail: true,
    fieldSuccessHTML: checkoutConfig.fieldSuccessHTML,
    fieldErrorHTML: checkoutConfig.fieldErrorHTML,
    fieldRequiredHTML: checkoutConfig.fieldRequiredHTML,  // <i class="fa fa-warning"></i>
    showAjaxLoader: function (){

    },
    hideAjaxLoader: function (){

    },
    showAjaxMessage: function (message){
   
            // $('#checkoutButtonContainer').hide();
        $('#checkoutButtonContainer').find('.btn').addClass('unactive');   

        $('#ajaxMessages').show().html('<span><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i><br>' + message + '</span>'); // <img src="/includes/javascript/onepage/ajax_load.gif">

    },
	hideAjaxMessage: function (){

	// raid ------ minimum order!!!---------------- //		 
	if($('#minsum').length) {
	   $('#minimal_sum').html($('#minsum').val());
       $('#checkoutButtonContainer_minimal').css('display','block');
   } 
	// raid ------END minimum order!!!---------------- //	
   else {
     // $('#checkoutButtonContainer').show();
     $('#checkoutButtonContainer').find('.btn').removeClass('unactive');
     $('#checkoutButtonContainer_minimal').css('display','none');
   }  
	 //$('#checkoutButtonContainer').show();
	
   $('#ajaxMessages').hide();
		
	},
    fieldErrorCheck: function ($element, forceCheck, hideIcon) {

        forceCheck = forceCheck || false;
        hideIcon = hideIcon || false;
        var errMsg = this.checkFieldForErrors($element, forceCheck);
        if (hideIcon == false){
            if (errMsg != false){
                this.addIcon($element, 'error', errMsg);
                return true;
            }else{
                this.addIcon($element, 'success', errMsg);
            }
        }else{
            if (errMsg != false){
                return true;
            }
        }
        return false;
    },
    checkFieldForErrors: function ($element, forceCheck) {
        var hasError = false;
     //   if ($element.is(':visible') && ($element.hasClass('required') || forceCheck == true)){
        if ($element.hasClass('required') && ($element.is(':visible') || forceCheck == true || $element.attr('name') == 'shipping_country' || $element.attr('name') == 'shipping_zone_id')){
            var errCheck = getFieldErrorCheck($element);

             // for selectboxes:
            if($element.val()=='') {
              hasError = true;
            } else {
              if (!errCheck.errMsg){
                  return false;
              }
            }

            switch($element.attr('type')){
                case 'password':
                if ($element.attr('name') == 'password'){
                    if ($element.val().length < errCheck.minLength){
                        hasError = true;
                    }
                }else{
                    if ($element.val() != $(':password[name="password"]', $('#shippingAddress')).val() || $element.val().length <= 0){
                        hasError = true;
                    }
                }
                break;
                case 'radio':
                if ($(':radio[name="' + $element.attr('name') + '"]:checked').length <= 0){
                    hasError = true;
                }
                break;
                case 'checkbox':
                if ($(':checkbox[name="' + $element.attr('name') + '"]:checked').length <= 0){
                    hasError = true;
                }
                break;
                case 'select-one':
                if ($element.val() == '') {
                    hasError = true;
                }
                break;
                default:
                if ($element.val().length < errCheck.minLength){
                    hasError = true;
                } else
                if (($element.attr('name') == 'billing_email_address') && ((!(echeck($element.val()))) || $element.attr('data-check') == 'false')) {
                    hasError = true;
                }
                break;
            }

            if (hasError == true){  
             //   console.log(errCheck.errMsg);
                return errCheck.errMsg;
            }
        }
        return hasError;
    },
    addIcon: function ($curField, iconType, title){
        title = title || false;
        $('.success_icon, .error_icon, .required_icon', $curField.parent()).hide();
        $('.checkout_inputs', $curField.parent()).css({'border':checkoutConfig.inputRequiredBorder, 'background':checkoutConfig.inputRequiredBg});
        switch(iconType) {
            case 'error':
            if (this.initializing == true) {
                this.addRequiredIcon($curField, 'Required');
            } else {
                this.addErrorIcon($curField, title);
            }
            break;
            case 'success':
            this.addSuccessIcon($curField, title);
            break;
            case 'required':
            this.addRequiredIcon($curField, 'Required');
            break;
        }
    },
    addErrorIcon: function ($curField, title){
        if ($('.error_icon', $curField.parent()).length <= 0){
            $curField.parent().append(this.fieldErrorHTML);
        }
        // $('.error_icon', $curField.parent()).attr('title', title).show();
        $('.error_icon', $curField.parent()).html('<i>' + title +'</i>'+ checkoutConfig.addErrorIcon).css('display',checkoutConfig.inputIconShow);
        $('.checkout_inputs', $curField.parent()).css({'border':checkoutConfig.inputErrorBorder, 'background':checkoutConfig.inputErrorBg});
    },
    addSuccessIcon: function ($curField, title) {
        if ($('.success_icon', $curField.parent()).length <= 0){
            $curField.parent().append(this.fieldSuccessHTML);
        }
        $('.success_icon', $curField.parent()).attr('title', title).css('display',checkoutConfig.inputIconShow);
        $('.checkout_inputs', $curField.parent()).css({'border':checkoutConfig.inputSuccessBorder, 'background':checkoutConfig.inputSuccessBg});
    },
    addRequiredIcon: function ($curField, title) {
        if ($curField.hasClass('required')){
            if ($('.required_icon', $curField.parent()).length <= 0){
                $curField.parent().append(this.fieldRequiredHTML);
            }
            $('.required_icon', $curField.parent()).attr('title', title).css('display',checkoutConfig.inputIconShow);
            $('.checkout_inputs', $curField.parent()).css('border',checkoutConfig.inputRequiredBorder);
        }
    },
    clickButton: function (elementName) {
        if ($(':radio[name="' + elementName + '"]').length <= 0) {
            $('input[name="' + elementName + '"]').trigger('click', true);
        }else{
            $(':radio[name="' + elementName + '"]:checked').trigger('click', true);
         //   console.log(111);
        }
    },
    addRowMethods: function ($row) {
        var checkoutClass = this;

        $row.click(function () {
            if (!$(this).hasClass('moduleRowSelected')) {
                //collect input data
                var oldSelectedModule = $('#shippingMethods .moduleRowSelected');
                var oldModuleCode = oldSelectedModule.data('module');
                shippingPaymentFieldsBuf[oldModuleCode] = {};
                oldSelectedModule.find('input[name^="shipping_fields"]').each(function (index) {
                    shippingPaymentFieldsBuf[oldModuleCode][$(this).attr('name')] = $(this).val();
                });

                // delete all classes .moduleRowSelected
                var selector = ($(this).hasClass('shippingRow') ? '.shippingRow' : '.paymentRow') + '.moduleRowSelected';
                $(selector).find(':radio').removeAttr('checked');
                $(selector).removeClass('moduleRowSelected');

                // add class and "checked" to selected module
                $(this).addClass('moduleRowSelected');
                // setModule run only once
                checkoutClass.checkoutSetModule = true;
                $(this).find(':radio').prop('checked', true).click();
                checkoutClass.updateShippingMethods();
                checkoutClass.updatePaymentMethods();
            }
        });
    },
    queueAjaxRequest: function (options) {
        var checkoutClass = this;  
        var o = {
            url: options.url,
            cache: options.cache || false,
            dataType: options.dataType || 'html',
            type: options.type || 'GET',
            contentType: options.contentType || 'application/x-www-form-urlencoded; charset=' + this.ajaxCharset,
            data: options.data || false,
            beforeSend: options.beforeSend || function (){
                checkoutClass.showAjaxMessage(options.beforeSendMsg || 'Ajax Operation, Please Wait...');
            //    checkoutClass.showAjaxLoader();
            },
            complete: function (){
                    checkoutClass.hideAjaxMessage();
                    // raid!!!---------------------------
                    //if(checkoutClass.errors != true) $('#onePageCheckoutForm').submit();     
                    // raid!!!---------------------------
                    
                    if (document.ajaxq.q['orderUpdate'].length <= 0){
                        //alert(checkoutClass.errors);  alert(checkoutClass.checkoutClicked);
                        if(checkoutClass.errors != true && checkoutClass.checkoutClicked == true){   
                            var buttonConfirmOrder = $('.ui-dialog-buttonpane button:first');
                            buttonConfirmOrder.removeClass('ui-state-disabled');
                            $('#imgDlgLgr').hide();
                        }
                    
                    }
            },
            success: options.success
						//,
           // error: function (XMLHttpRequest, textStatus, errorThrown){
           //     if (XMLHttpRequest.responseText == 'session_expired') document.location = this.pageLinks.shoppingCart;
           //     alert(options.errorMsg || 'There was an ajax error, please contact ' + checkoutClass.storeName + ' for support.');
                //alert(textStatus +'\n'+ errorThrown+'\n'+options.data+'\n'+options.url);
           // }
        };
        if (checkoutClass.checkoutSubmitted === false) {
            $.ajaxq('orderUpdate', o);
            if (checkoutClass.checkoutBeforeSubmitted === true){
                checkoutClass.checkoutSubmitted === false;
            }
        }
    },  
    updateOrderTotals: function () {
        var checkoutClass = this;
        this.queueAjaxRequest({
            url: this.pageLinks.checkout,
            cache: false,
            data: 'action=getOrderTotals&randomNumber='+Math.random(),
            type: 'post',
            beforeSendMsg: checkoutClass.refresh,
            success: function (data){
                disableCheckoutButton();
                $('.orderTotals').html(data);
                if (IS_MOBILE == '1') {
                    var ot_sum = $('#ot_sum').text();
                    $('.mob_short_cart .scroll_total').html(ot_sum);
                }
            },
            errorMsg: checkoutClass.error_scart+' ' + checkoutClass.storeName
        });
    },
    updateModuleMethods: function (action, noOrdertotalUpdate){
        var checkoutClass = this;    
        var descText = (action == 'shipping' ? 'Shipping' : 'Payment');

        if (action == 'shipping'){
          var setMethod = checkoutClass.setShippingMethod;
        } else {
          var setMethod = checkoutClass.setPaymentMethod;
        }

        // get tab status (open/close)
        var openTab = false;
        var tab = $('#checkout_' + action);
        if (tab.length > 0) {
            openTab = tab.hasClass('in');
        }

        this.queueAjaxRequest({
            url: this.pageLinks.checkout,
            data: 'action=update' + descText + 'Methods&open_tab=' + openTab,
            type: 'post',
            beforeSendMsg: checkoutClass.refresh_method+' ' + descText,
            success: function (data) {

                if(action === 'payment') {
                    $('.payment-shipping-loader').hide();
                }

                $('#no' + descText + 'Address').hide();
                $('#' + action + 'Methods').html(data).show();

                //add validate of shipping fields
                if (action == 'shipping') {
                    $('.shipping_methods_block input[type="text"]').each(function () {
                        if ($(this).attr('name') !== undefined && $(this).attr('type') !== 'checkbox') {
                            var processAddressFunction = function () {
                                if (checkoutClass.fieldErrorCheck($(this)) == false) {
                                    checkoutClass[addressTypeConfiguration.first.jsProcessCallback](this);  // only if checkout button is not clicked.
                                }
                            };
                            $(this).blur(processAddressFunction);
                            bindAutoFill($(this));
                        }
                    });
                }

                //put input data
                var newSelectedModule = $('#' + action + 'Methods .moduleRowSelected');
                var newModuleCode = newSelectedModule.data('module');
                if (shippingPaymentFieldsBuf[newModuleCode]) {
                    newSelectedModule.find('input[name^="shipping_fields"]').each(function (index) {
                        $(this).val(shippingPaymentFieldsBuf[newModuleCode][$(this).attr('name')]);
                        $(this).trigger('blur');
                    });
                }

                var collapse = $('#checkout_' + action);

                if (!collapse.hasClass('in')) {
                    // update tab short info after update
                    checkoutCollapsedTab('#checkout_' + action);
                } else {
                    // hide edit_block if tab is open
                    collapse.closest('.collapse_wrapper').addClass('open');
                }

                // fix problem if user click continue during ajax update methods
                if (collapse.closest('.collapse_wrapper').hasClass('open') && !collapse.hasClass('in')) {
                    collapse.collapse('show');
                    collapse.closest('.collapse_wrapper').find('.collapse_wrapper_info').hide();
                }

                $('.' + action + 'Row').each(function (){

                    checkoutClass.addRowMethods($(this));
                    $('input[name="' + action + '"]', $(this)).each(function (){

                        $(this).click(function (e, noOrdertotalUpdate){
                            setMethod.call(checkoutClass, $(this));
                        });
                    });

                });

                if($("input[name=payment][value="+$("input[name=current_code]").val()+"]").prop("checked")!=true) { //if not checked payment with hidden field with model code - remove additional button
                    $("#checkoutButton").show();
                    $("#additional-button-container").remove();
                }

                // raid  - show additional fields if we select some shipping methods
                //  console.log($('.shippingRow.moduleRowSelected input[type=radio]').val());
                /*
                 var curr_sposob = $('.shippingRow.moduleRowSelected input[type=radio]').val();
                 var suburbblock = $('input[name=billing_suburb]').parent().parent();
                 var streetblock = $('input[name=billing_street_address]').parent().parent();

                 if(curr_sposob=='flat_flat') { 
                 suburbblock.fadeOut(0);
                 streetblock.fadeIn(100);
                 } else if(curr_sposob=='nwpochta_nwpochta'  ) {    
                 streetblock.fadeOut(0);
                 suburbblock.fadeIn(100);
                 } else { 
                 streetblock.fadeOut(0);
                 suburbblock.fadeOut(100);
                 }   */

                $(function () {
                    $('.checkout [data-toggle="tooltip"]').tooltip()
                });

                // raid end
                if (descText === "Shipping") {
                    checkoutClass.updateOrderTotals();
                }

            },
            errorMsg:  checkoutClass.error_some1+' ' + action + ' '+checkoutClass.error_some2+' ' + checkoutClass.storeName
        });
    },                               
    updateShippingMethods: function (noOrdertotalUpdate){
        if (this.shippingEnabled == false){
            return false;
        }

        this.updateModuleMethods('shipping', noOrdertotalUpdate);
    },
    updatePaymentMethods: function (noOrdertotalUpdate){
        this.updateModuleMethods('payment', noOrdertotalUpdate);
    },
    setModuleMethod: function (type, method, successFunction){
        var checkoutClass = this;  
        this.queueAjaxRequest({
            url: this.pageLinks.checkout,
            data: 'action=set' + (type == 'shipping' ? 'Shipping' : 'Payment') + 'Method&method=' + method,
            type: 'post',
            beforeSendMsg: checkoutClass.setting_method+' ' + (type == 'shipping' ? 'Shipping' : 'Payment'),
            dataType: 'json',
            success: successFunction,
            errorMsg: checkoutClass.error_set_some1+' ' + type + ' '+checkoutClass.error_set_some2+' ' + checkoutClass.storeName + ' '+checkoutClass.error_set_some2
        });

    },
    setShippingMethod: function ($button){
        if (this.checkoutSetModule) {
            if (this.shippingEnabled == false){
                return false;
            }

            this.setModuleMethod('shipping', $button.val(), function (data){
                // for PHP 7
            });
            this.checkoutSetModule = false;
        }
    },
    setPaymentMethod: function ($button){
        if (this.checkoutSetModule) {
            this.setModuleMethod('payment', $button.val(), function (data){
                try {
                    if(!$button.attr("input-loaded")) {
                        $(".paymentFields").remove();
                        $('input[input-loaded=true]').removeAttr('input-loaded');
                        $button.parent().append(data['inputFields'][0]);
                        $button.attr("input-loaded", true);
                    }
                    // disable checkout button
                    // disableCheckoutButton();
                }catch (e) {
                    return;
                }
            });
            this.checkoutSetModule = false;
        }
    },
    processBillingAddress: function (element){
        var checkoutClass = this;
        var hasError = false;

        if (element === undefined) {
            $('select[name="billing_country"], input[name="billing_street_address"], input[name="billing_zipcode"], input[name="billing_city"]', $('#billingAddress')).each(function (){
                if (checkoutClass.fieldErrorCheck($(this), false, true) === true){
                    hasError = true;
                }
            });
        } else {
            if (checkoutClass.fieldErrorCheck($(element), false, true) === true) {
                hasError = true;
            }
        }

        if (hasError === true){
            return;
        }
    
        this.setBillTo();
    },
    processShippingAddress: function (element){
        var checkoutClass = this;
        var hasError = false;

        if (element === undefined) {
            $('select[name="shipping_country"], input[name="shipping_street_address"], input[name="shipping_zipcode"], input[name="shipping_city"], *[name="shipping_state"]', $('#shippingAddress')).each(function (){
                if (checkoutClass.fieldErrorCheck($(this), false, true) === true){
                    hasError = true;
                }
            });
        } else {
            if (checkoutClass.fieldErrorCheck($(element), false, true) === true) {
                hasError = true;
            }
        }

        if (hasError === true){
            return;
        }
    
        this.setSendTo(true);
    },
    setCheckoutAddress: function (type, useShipping){
        var checkoutClass = this;
        var selector = '#' + type + 'Address';
        var sendMsg = checkoutClass.setting_address+' ' + (type == 'shipping' ? checkoutClass.setting_address_ship : checkoutClass.setting_address_bil);
        var errMsg = type + ' address';
        if (type == 'shipping' && useShipping == false){
         //   selector = '#billingAddress';
         //   sendMsg = 'Setting shipping address';
         //   errMsg = 'payment address';
        }

        action = 'setBillTo';
        if (type == 'shipping'){
            action = 'setSendTo';
        }
        checkoutClass.checkoutBeforeSubmitted = true;
        this.queueAjaxRequest({
            url: this.pageLinks.checkout,
            cache: false,
            beforeSendMsg: sendMsg,
            dataType: 'json',
            data: 'action=' + action + '&' + $('*', $(selector)).serialize(),
            type: 'post',
            success: function (data){
              // raid!!!---------------------------
              if(checkoutClass.errors != true){
                  checkoutClass.checkoutSubmitted = true;
                  $('#onePageCheckoutForm').submit();
              }
              // raid!!!---------------------------
            }
				//		,
        //    errorMsg: 'There was an error updating your ' + errMsg + ', please inform ' + checkoutClass.storeName + ' about this error.'
        });
    },
    setBillTo: function (){
        this.setCheckoutAddress('billing', false);
    },
    setSendTo: function (useShipping){
        this.setCheckoutAddress('shipping', useShipping);
    }, 
    checkFields: function (){
        var checkoutClass = this;
        $('input, password, select', $('#' + addressTypeConfiguration.first.id)).each(function (){
            if ($(this).attr('name') != undefined && $(this).attr('type') != 'checkbox' && $(this).attr('type') != 'radio'){
                if ($(this).attr('type') == 'password'){
                    $(this).blur(function (){
                        if ($(this).hasClass('required')){
                            checkoutClass.fieldErrorCheck($(this));
                        }
                    });
                    /* Used to combat firefox 3 and it's auto-populate junk */
                    $(this).val('');

                }else{ 
                           
            //      $(this).keyup(function (){
                    $(this).blur(function (){ 
                          
                        checkoutClass[addressTypeConfiguration.first.infoChanged] = true;
                        if ($(this).hasClass('required')){
                            checkoutClass.fieldErrorCheck($(this));
                        }
                    });
                    if($(this).attr('name')!='billing_email_address') {
	                    $(this).keyup(function (){  
	                        checkoutClass[addressTypeConfiguration.first.infoChanged] = true;
	                        if ($(this).hasClass('required')){
	                            checkoutClass.fieldErrorCheck($(this));
	                        }
	                    });
                    }
                    // for selectboxes!!
                    $(this).change(function (){
	                        if ($(this).hasClass('required')){
	                            checkoutClass.fieldErrorCheck($(this), true);
	                        }  
                    }); 
                    bindAutoFill($(this));
                }

                if ($(this).hasClass('required')) {
                    checkoutClass[addressTypeConfiguration.first.infoChanged] = true;
                    if (checkoutClass.fieldErrorCheck($(this), true, true) === false) {
                        if (this.attributes["name"].value === 'billing_email_address' && checkoutClass.initializing === true) {
                            $(this).change();
                        } else {
                            checkoutClass.addIcon($(this), 'success');
                        }
                    } else {
                        checkoutClass.addIcon($(this), 'required');
                    }
                }
            }
        });
    }, 
       
     checkAllErrors: function(){
        var checkoutClass = this;
            var errMsg = '';
            if ($('.required_icon:visible', $('#' + addressTypeConfiguration.first.id)).length > 0){
                errMsg += checkoutClass.error_err_ship+"\n"+ "<br />";
                $('.required_icon:visible', $('#' + addressTypeConfiguration.first.id)).each(function () {
                    errMsg += $(this).parents('.form-group').find('input').attr('placeholder') + "\n"+ "<br />"
                })
            }

            if ($('.error_icon:visible', $('#' + addressTypeConfiguration.first.id)).length > 0){
                errMsg += checkoutClass.error_err_ship+ "\n+ \"<br />\"";
                $('.error_icon:visible', $('#' + addressTypeConfiguration.first.id)).each(function () {
                    errMsg += $(this).text() + "\n"+ "<br />"
                })
            }

            if($('#diffShipping').prop('checked')==true) {
         //   if ($('#diffShipping:checked').length > 0){
                if ($('.required_icon:visible', $('#' + addressTypeConfiguration.second.id)).length > 0){
                    errMsg += checkoutClass.error_req_bil+ "\n" + "<br />";
                    $('.required_icon:visible', $('#' + addressTypeConfiguration.second.id)).each(function () {
                        errMsg += $(this).parents('.form-group').find('input').attr('placeholder') + "\n" + "<br />"
                    })
                }

                if ($('.error_icon:visible', $('#' + addressTypeConfiguration.second.id)).length > 0){
                    errMsg += checkoutClass.error_req_bil + "\n" + "<br />";
                    $('.error_icon:visible', $('#' + addressTypeConfiguration.second.id)).each(function () {
                        errMsg += $(this).attr('title') + "\n" + "<br />"
                    })
                }
            }

            if (errMsg != ''){
                errMsg = '<p><b>'+checkoutClass.error_address+':</b> ' +
                errMsg + "</p>";
            }

            if(checkoutClass.amountRemaininginTotal == true) {
                if ($(':radio[name="payment"]:checked').length <= 0){
                    if ($('input[name="payment"]:hidden').length <= 0){
                        errMsg += '<p><b>'+checkoutClass.error_pmethod+':</b> ' +
                        checkoutClass.error_select_pmethod + "</p>";
                    }
                }
            }

            if (checkoutClass.shippingEnabled === true) {
                if ($(':radio[name="shipping"]:checked').length <= 0){
                    if ($('input[name="shipping"]:hidden').length <= 0) {
                        errMsg += '<p><b>'+checkoutClass.error_pmethod+':</b> ' +
                        checkoutClass.error_select_pmethod + "</p>";
                    }
                }
            }
            if(checkoutClass.ccgvInstalled == true) {
                if($('input[name="gv_redeem_code"]').val() == 'redeem code') {
                    $('input[name="gv_redeem_code"]').val('');
                }
            }

            if(checkoutClass.kgtInstalled == true) {
                if($('input[name="coupon"]').val() == 'redeem code') {
                    $('input[name="coupon"]').val('');
                }
            }

            if (errMsg.length > 0) {
                checkoutClass.errors = true;
                // alert(errMsg);
                // showAlert(errMsg, $('#divShoppingCard'), 'alert-danger', 'alert-dismissible');
                return false;
            } else {
                checkoutClass.errors = false;
                //  if (checkoutClass.billingInfoChanged == true && $('.required_icon:visible', $('#billingAddress')).length <= 0 && checkoutClass.loggedIn != true){
                doHookie('checkout_progress');
                if(checkoutClass[addressTypeConfiguration.first.infoChanged] == true && $('.required_icon:visible', $('#shippingAddress')).length <= 0) {
                    //errMsg += 'You tried to checkout without first clicking update. We have updated for you. Please review your order to make sure it is correct and click checkout again.' + "\n";
                    checkoutClass[addressTypeConfiguration.first.jsProcessCallback]();
                    checkoutClass[addressTypeConfiguration.first.infoChanged] = false;
                }
                return true;
            }
        },
    switchWithoutRegistration: function (element) {
        //update flag
        withoutRegistrationFlag = element.checked;
        //update field
        var $emailElement = $('[name="billing_email_address"]');
        if (withoutRegistrationFlag) {
            $emailElement.removeClass('required');
            $emailElement.closest('.form-group').find('#email_error').text('');
        } else {
            $emailElement.addClass('required');
        }
        this.fieldErrorCheck($emailElement, true, false);
    },
    initCheckout: function (){
        var checkoutClass = this;
        $('#onePageCheckoutForm input[type="text"]').on('input',function(){
            $(this).val($(this).val().replace(/(<([^>]+)>)/ig,"")); //striptags
        })
        /*var billingInfoChanged = false;
        if ($('#diffShipping').checked && this.loggedIn != true){
        var shippingInfoChanged = false;
        }*/


    		$('#diffShipping').click(function (){
    		  if($(this).prop('checked')==true) {
        //	if (this.checked){
    				$('#' + addressTypeConfiguration.second.id).slideDown();
    	//			$('#shippingMethods').html('');
    				$('#noShippingAddress').show();
    				// $('select[name="'+addressTypeConfiguration.second.fullPrefix+'_country"]').trigger('change');
    			}else{
    				$('#' + addressTypeConfiguration.second.id).slideUp();
    				// var errCheck = checkoutClass.processShippingAddress();
    				// if (errCheck == ''){
    				// 	$('#noShippingAddress').hide();
    				// }else{
    				// 	$('#noShippingAddress').show();
    				// }
    			}
    		});
        
        $('#' + addressTypeConfiguration.second.id).hide();
        $('#checkoutYesScript').show();

        this.updateShippingMethods(true);
        this.updatePaymentMethods(true);
        
        // store selected data to session
        $(document).on('change', 'select[name='+addressTypeConfiguration.first.fullPrefix+'_country]', function(event) {
            var $thisField = $(this);
      		// $.post(checkoutClass.pageLinks.checkout, { action:'setCheckoutAddressField',addresstype:'shipping','field':'country_id','value':$(this).val()}, function(data) {
      		// 	checkoutClass.updateShippingMethods(true);
      		// });
            checkoutClass.queueAjaxRequest({
                url: checkoutClass.pageLinks.checkout,
                data: 'action=setCheckoutAddressField&addresstype='+addressTypeConfiguration.first.fullPrefix+'&field=country_id&value=' + $thisField.val(),
                type: 'post',
                beforeSendMsg: checkoutClass.refresh_method,
                dataType: 'json',
                success: function (data) {
                    checkoutClass.updateShippingMethods(true);
                    checkoutClass.updatePaymentMethods(true);
                },
            });
        });

        $(document).on('change', 'select[name='+addressTypeConfiguration.second.fullPrefix + '_country]', function(event) {
            var $thisField = $(this);
            checkoutClass.queueAjaxRequest({
                url: checkoutClass.pageLinks.checkout,
                data: 'action=setCheckoutAddressField&addresstype=' + addressTypeConfiguration.second.fullPrefix + '&field=country_id&value=' + $thisField.val(),
                type: 'post',
                beforeSendMsg: checkoutClass.refresh_method,
                dataType: 'json',
                success: function (data) {
                    checkoutClass.updateShippingMethods(true);
                    checkoutClass.updatePaymentMethods(true);
                },
            });
        });

        // store selected data to session
        $(document).on('change', 'select[name='+addressTypeConfiguration.first.fullPrefix+'_zone_id]', function(event) {
            var $thisField = $(this);
      		// $.post(checkoutClass.pageLinks.checkout, { action:'setCheckoutAddressField',addresstype:'shipping','field':'zone_id','value':$(this).val()}, function(data) {
      		// 	checkoutClass.updateShippingMethods(true);
      		// });
            checkoutClass.queueAjaxRequest({
                url: checkoutClass.pageLinks.checkout,
                data: 'action=setCheckoutAddressField&addresstype='+addressTypeConfiguration.first.fullPrefix+'&field=zone_id&value=' + $thisField.val(),
                type: 'post',
                beforeSendMsg: checkoutClass.refresh_method,
                dataType: 'json',
                success: function (data) {
                    checkoutClass.updateShippingMethods(true);
                    checkoutClass.updatePaymentMethods(true);
                    updateCart();
                    checkoutClass.queueAjaxRequest({
                        url: 'checkout.php',
                        data: 'action=updateCheckoutCart',
                        type: 'post',
                        beforeSendMsg: checkoutClass.refresh_method,
                        dataType: 'html',
                        success: function (data) {
                            $('#checkout_cart').html(data);
                        },
                    });
                },
            });
        });

        $(document).on('change', 'select[name='+addressTypeConfiguration.second.fullPrefix+'_zone_id]', function(event) {
            var $thisField = $(this);
            checkoutClass.queueAjaxRequest({
                url: checkoutClass.pageLinks.checkout,
                data: 'action=setCheckoutAddressField&addresstype='+addressTypeConfiguration.second.fullPrefix+'&field=zone_id&value=' + $thisField.val(),
                type: 'post',
                beforeSendMsg: checkoutClass.refresh_method,
                dataType: 'json',
                success: function (data) {
                    checkoutClass.updateShippingMethods(true);
                    checkoutClass.updatePaymentMethods(true);
                    updateCart();
                    checkoutClass.queueAjaxRequest({
                        url: 'checkout.php',
                        data: 'action=updateCheckoutCart',
                        type: 'post',
                        beforeSendMsg: checkoutClass.refresh_method,
                        dataType: 'html',
                        success: function (data) {
                            $('#checkout_cart').html(data);
                        },
                    });
                },
            });
        });

        $(document).on('change', '#np_cities, #np_warehouses', function () {
            var thisField = $(this);
            checkoutClass.queueAjaxRequest({
                url: checkoutClass.pageLinks.checkout,
                data: 'action=setNpFields&field=' + thisField.attr('id') + '&value=' + thisField.val(),
                type: 'post',
                dataType: 'json',
            });
        });
        // store selected data to session
        $(document).on('focusout', 'input[name='+addressTypeConfiguration.first.fullPrefix+'_zipcode]', function(event) {
            var $thisField = $(this);
            // this check blocks unnecessary ajax requests
            if ($thisField.val() !== '' && $thisField.val() !== $thisField.attr('data-sent-value')) {
                $thisField.attr('data-sent-value', $thisField.val());
                checkoutClass.queueAjaxRequest({
                    url: checkoutClass.pageLinks.checkout,
                    data: 'action=setCheckoutAddressField&addresstype='+addressTypeConfiguration.first.fullPrefix+'&field=zipcode&value=' + $thisField.val(),
                    type: 'post',
                    beforeSendMsg: checkoutClass.refresh_method,
                    dataType: 'json',
                    success: function (data) {
                        checkoutClass.updateShippingMethods(true);
                        checkoutClass.updatePaymentMethods(true);
                    },
                });
            }
        });

        $(document).on('focusout', 'input[name='+addressTypeConfiguration.second.fullPrefix+'_zipcode]', function(event) {
            var $thisField = $(this);
            // this check blocks unnecessary ajax requests
            if ($thisField.val() !== '' && $thisField.val() !== $thisField.attr('data-sent-value')) {
                $thisField.attr('data-sent-value', $thisField.val());
                checkoutClass.queueAjaxRequest({
                    url: checkoutClass.pageLinks.checkout,
                    data: 'action=setCheckoutAddressField&addresstype='+addressTypeConfiguration.second.fullPrefix+'&field=zipcode&value=' + $thisField.val(),
                    type: 'post',
                    beforeSendMsg: checkoutClass.refresh_method,
                    dataType: 'json',
                    success: function (data) {
                        checkoutClass.updateShippingMethods(true);
                        checkoutClass.updatePaymentMethods(true);
                    },
                });
            }
        });

        // -------------------CHANGE SHIPPING ADDRESS!!--------------------------
        $(document).on('click', '.choose_modal', function(event) {
          event.preventDefault();
          var addressType = $(this).attr('data-addresstype');
            checkoutClass.queueAjaxRequest({
                url: "./ajax_choose_modal.php",
                data: 'addresstype=' + addressType,
                type: 'post',
                beforeSendMsg: checkoutClass.refresh_method,
                dataType: 'html',
                success: function (data) {
                    modal({
                        id: 'pop_choose',
                        title: CHOOSE_ADDRESS,
                        width:'470px',
                        body: data
                    });
                },
            });
          // $.post( "./ajax_choose_modal.php", {'addresstype':$(this).attr('data-addresstype')}, function(data) {
          //     modal({
          //         id: 'pop_choose',
          //         title: CHOOSE_ADDRESS,
          //         width:'470px',
          //         body: data
          //     });
          // });
        });
        
        $(document).on('click', '.addresses_block', function(event) {
          $(this).closest('.modal-body').find('.addresses_block').removeClass('ab_checked');  
          $(this).addClass('ab_checked');           
          $(this).find('input[type=radio]').prop('checked', true);
        });
        
        $(document).on('click', '#confirm_change_address', function(event) {
          event.preventDefault();
          $.get( "./ajax_select_region.php", {
              'name':$(this).closest('.modal-body').find(':radio:checked').attr('name'),
              'val':$(this).closest('.modal-body').find(':radio:checked').val()
          }, function(data) {
            location.reload();
          });
        });
        
         // -------------------CHANGE SHIPPING ADDRESS!!-----END---------------------
        $('select[name="shipping_country"], select[name="billing_country"]').selectize({
            hideSelected:true,
            maxItems:1,
            highlight:true,
            onDropdownOpen:function() {
                this.$input.closest('.form-group').find('.error_icon').css('display','none');
            },
            onFocus: function(){
                this.clear();
                this.$input.closest('.form-group').find('.checkout_inputs').css({'border': checkoutConfig.inputRequiredBorder, 'background':checkoutConfig.inputRequiredBg});
            }
        });

        $(document).on('change',"select[name=billing_country], select[name=shipping_country]", function() {

            var country = $(this);
            var default_region = country.attr('data-zone');
            var zone_field_name = '';
            var fieldForInsert = '';

            country.attr('data-zone',''); // erase default zone for all other countries except default.

            if(country.attr('name')=='billing_country') {
              zone_field_name = 'billing_zone_id';
              fieldForInsert = $('.billing_zone_select');
            }
            else if(country.attr('name')=='shipping_country'){
              zone_field_name = 'shipping_zone_id';
              fieldForInsert = $('.shipping_zone_select');
            }


            $("select[name="+country.attr('name')+"]+button span:last-of-type").html(country.children(':selected').text()); // change country selectize

            //  $("*[name="+zone_field_name+"]").remove();
            checkoutClass.queueAjaxRequest({
                url: "./ajax_select_region.php",
                data: 'country_id='+country.val()+'&default_region='+default_region+'&zone_field_name=' + zone_field_name,
                type: 'get',
                beforeSendMsg: checkoutClass.refresh_method,
                success: function (data) {
                    if($("*[name="+zone_field_name+"]").length!=0) $("*[name="+zone_field_name+"]").closest('span').replaceWith(data);
                    else fieldForInsert.replaceWith(data);

                    if(typeof checkout !== 'undefined') checkout.checkFields();
                    $("select[name="+zone_field_name+"]").selectize({
                      hideSelected:false,
                      maxItems:1,
                      // placeholder:ENTER_KEY,
                      highlight:true,
                      onDropdownOpen:function() {
                        this.$input.closest('.form-group').find('.error_icon').css('display','none');
                        this.$input.closest('.form-group').find('.fulllength').css({'border': checkoutConfig.inputRequiredBorder, 'background':checkoutConfig.inputRequiredBg});
                      },
                      onFocus: function(){
                        this.clear();
                      }
                    });
                },
            });

        });

        // $('select[name=billing_country]').change();
        // $('select[name=shipping_country]').change();
        // $('input[name=billing_email_address]').val('');

      	$(document).on('click', '#voucherRedeem', function(event) {
      		// $.post('./includes/checkout/checkout_cart.php', {
      		// 	gv_redeem_code: $('input[name=gv_redeem_code]').val()
      		// }, function(data) {
          //    $('#checkout_cart').html(data);
          //    checkout.updateOrderTotals();
          // });
      		var gvCode = $('input[name=gv_redeem_code]').val();
            checkoutClass.queueAjaxRequest({
                url: 'checkout.php',
                data: 'gv_redeem_code=' + gvCode + '&action=updateCheckoutCart',
                type: 'post',
                beforeSendMsg: checkoutClass.refresh_method,
                dataType: 'html',
                success: function (data) {
                    $('#checkout_cart').html(data);
                    checkout.updateOrderTotals();
                },
            });
      	});
        $(document).on('click', '#deleteCupon', function(event) {
            var gvCode = '';
            checkoutClass.queueAjaxRequest({
                url: 'checkout.php',
                data: 'gv_redeem_code=' + gvCode + '&action=updateCheckoutCart',
                type: 'post',
                beforeSendMsg: checkoutClass.refresh_method,
                dataType: 'html',
                success: function (data) {
                    $('#checkout_cart').html(data);
                    checkout.updateOrderTotals();
                },
            });
        });
        $(document).on('click', '.delete', function(event) {
          $.post('./popup_cart.php?action=update_product', {'cart_delete[]':$(this).val(),'products_id[]':$(this).val()}, function(response) {
             $.post('checkout.php', 'action=updateCheckoutCart', function(data) {
               if(data!='empty') {
                 $('#checkout_cart').html(data);
                 checkout.updateShippingMethods();
                 checkout.updateOrderTotals();
                 updateCart();
                 try {

                 response = JSON.parse(response);
                 if(response.prod.length==1){
                     $('.delete').css('display','none');
                 }
                 else if (response.prod.length==0 && window.page_name=='checkout'){
                     window.location.href = '../';
                 }
                 else{
                     $('.delete').css('display','flex');
                 }
                 }
                 catch (e) {
                     window.location.href = '../';

                 }
               } else {
                 location.reload();
               }
             });
          });
        });

    checkout.checkFields();

    $('body').on('change', '#registration-off', function () {
        $('input[name="billing_email_address"]').change();
    });

    // save checkbox state to session
    $(document).on('change', 'input[type="checkbox"]', function () {
        //update withoutRegistrationFlag on "registration-off" checkbox switch
        if (this.id == 'registration-off') {
            checkout.switchWithoutRegistration(this);
        }
        checkoutClass.queueAjaxRequest({
            url: checkoutClass.pageLinks.checkout,
            data: 'action=setCheckboxStatus&checkboxName=' + this.id + '&checkboxStatus=' + this.checked,
            type: 'post',
            dataType: 'json',
            success: function (data) {
            }
        });
    });
    $(document).on('change', '#showComments', function () {
        if ($(this).prop("checked")) {
            $(this).closest('.checkout-comments').find('.comments-wrap').slideDown(200);
        } else {
            $(this).closest('.checkout-comments').find('.comments-wrap').slideUp(200);
        }
    });
    // Save card number in session
    $(document).on('blur', '.number_field input[name="cc_number"]', function () {
        checkoutClass.queueAjaxRequest({
            url: checkoutClass.pageLinks.checkout,
            data: 'action=setCardNumber&cc_number=' + this.value,
            type: 'post',
            dataType: 'json',
            success: function (data) {
            }
        });
    });
   
		$('input[name="billing_email_address"]').each(function (){
		    $(this).unbind('blur').change(function (){
                if(!addPaymentInfo){
                    addPaymentInfo = true;
                    doHookie('add_payment_info');
                }
				var $thisField = $(this);
                var withOutRegistration = $('#registration-off').prop('checked');
                $thisField.attr('data-check','progress');

				checkoutClass.shippingInfoChanged = true;
				if (checkoutClass.initializing == true && checkoutClass.checkedEmail){
					checkoutClass.addIcon($thisField, 'required');
				} else {
					//if (this.changed == false) return;
					if (checkoutClass.fieldErrorCheck($thisField, true, true) == false) {
						this.changed = false;
						if($thisField.val() == '') {
							checkoutClass.addIcon($thisField, 'error', data.errMsg.replace('/n', "\n"));
						}
                        if(!withOutRegistration) {
                            checkoutClass.queueAjaxRequest({
                                url: checkoutClass.pageLinks.checkout,
                                data: 'action=checkEmailAddress&emailAddress=' + $thisField.val(),
                                type: 'post',
                                beforeSendMsg: checkoutClass.check_email,
                                dataType: 'json',
                                success: function (data) {
                                    $('.success, .error', $thisField.parent()).hide();
                                    if (data.success == 'false') {
                                        if ($thisField.closest('.collapse_wrapper').hasClass('success_block')) {
                                            $thisField.closest('.collapse_wrapper').removeClass('success_block').addClass('error');
                                        }
                                        $thisField.attr('data-check',false);
                                        checkoutClass.addIcon($thisField, 'error', data.errMsg.replace('/n', "\n"));
                                        //		alert(data.errMsg.replace('/n', "\n").replace('/n', "\n").replace('/n', "\n"));
                                        $("#email_error").html(data.errMsg.replace('/n', "\n").replace('/n', "\n").replace('/n', "\n"));
                                    } else {
                                        $thisField.attr('data-check',true);
                                        $("#email_error").html('');
                                        checkoutClass.addIcon($thisField, 'success');
                                    }
                                },
                                errorMsg: checkoutClass.error_email + ' ' + checkoutClass.storeName + ' ' + checkoutClass.error_set_some3
                            });
                        } else {
                            $("#email_error").html('');
                            checkoutClass.addIcon($thisField, 'success');
                        }
					} else {
                        if($thisField.val() === '') {
                            $("#email_error").html('');
                        }
                    }
                    checkoutClass.checkedEmail = true;
				}
			}).keyup(function (){
				this.changed = true;
			});
			bindAutoFill($(this));
		});

        if ($('input[name=billing_email_address]').val() !== '') {
            checkoutClass.checkedEmail = false;
            $('input[name=billing_email_address]').change();
        }

        //dynamic check of billing address fields
        $('input,select[name="' + addressTypeConfiguration.second.fullPrefix + '_country"]', $('#' + addressTypeConfiguration.second.id)).each(function () {
            if ($(this).attr('name') !== undefined && $(this).attr('type') !== 'checkbox') {
                var processAddressFunction = function () {
                    if ($(this).hasClass('required')) {
                        if (checkoutClass.fieldErrorCheck($(this)) === false) {
                            checkoutClass[addressTypeConfiguration.second.jsProcessCallback](this);  // only if checkout button is not clicked.
                        }
                    }
                };

                $(this).blur(processAddressFunction);
                bindAutoFill($(this));

                if ($(this).hasClass('required')) {
                    var icon = 'required';
                    if ($(this).val() != '' && checkoutClass.fieldErrorCheck($(this), true, true) == false) {
                        icon = 'success';
                    }
                    checkoutClass.addIcon($(this), icon);
                }
            }
        });

        //dynamic check of shipping address fields
        $('input,select[name="' + addressTypeConfiguration.first.fullPrefix + '_country"]', $('#' + addressTypeConfiguration.first.id)).each(function () {
            if ($(this).attr('name') !== undefined && $(this).attr('type') !== 'checkbox') {
                var processAddressFunction = function () {
                    if (checkoutClass.fieldErrorCheck($(this)) == false) {
                        checkoutClass[addressTypeConfiguration.first.jsProcessCallback](this);  // only if checkout button is not clicked.
                    }
                };

                $(this).blur(processAddressFunction);
                bindAutoFill($(this));

            }
        });

		if(checkoutClass.stateEnabled == true)
		{

      /*
			$('select[name="shipping_country"], select[name="billing_country"]').each(function (){
				var $thisName = $(this).attr('name');
				var fieldType = 'billing';
				if ($thisName == 'shipping_country'){
					fieldType = 'delivery';
				}
	//			checkoutClass.addCountryAjax($(this), fieldType + '_state', 'stateCol_' + fieldType);
			});  */

		 /*
			$('*[name="billing_state"], *[name="delivery_state"]').each(function (){
				var processAddressFunction = checkoutClass.processBillingAddress;
				if ($(this).attr('name') == 'delivery_state'){
					processAddressFunction = checkoutClass.processShippingAddress;
				}
				
				var processFunction = function (){
					if ($(this).hasClass('required')){
						if (checkoutClass.fieldErrorCheck($(this)) == false){
							processAddressFunction.call(checkoutClass);
						}
					}else{
						processAddressFunction.call(checkoutClass);
					}
				}
			
				if ($(this).attr('type') == 'select-one'){
					$(this).change(processFunction);
				}else{
					$(this).blur(processFunction);
				}
				bindAutoFill($(this));
			});  */
		}
    
    $('#checkoutButton').on('mousedown', function(event) { // if "mousedown" first, we prevent "blur" from shippingAddress
        event.preventDefault();
    }).on('click', function() {
        $('select[name="'+addressTypeConfiguration.first.fullPrefix+'_country"], select[name="'+addressTypeConfiguration.first.fullPrefix+'_zone_id"], input', $('#'+ addressTypeConfiguration.first.id)).each(function (){
            checkoutClass.fieldErrorCheck($(this), false, false)
        });
			  checkoutClass.checkAllErrors();    
        return false;  
    });
     /*
        $('#checkoutButton').click(function() { 
				  checkoutClass.checkAllErrors();    
          return false;                                   
        });   */
        
      /*
        if (this.loggedIn == true && this.showAddressInFields == true){
            $('*[name="billing_state"]').trigger('change');
            $('*[name="delivery_state"]').trigger('change');
        }  */


        this.initializing = false;
        
        
    }

};
$(document).ready(function () {
    //update withoutRegistrationFlag on page load
    checkout.switchWithoutRegistration($('#registration-off')[0]);
    $(document).on('change', '.input-checkout-prod-quantity', function () {
        // Rounding to an integer
        this.value = Math.round(this.value);
        var products_id = $('input[name^=products_id]').map(function(idx, elem) {
            return $(elem).val();
        }).get();
        var cart_quantity = $('input[name^=cart_quantity]').map(function(idx, elem) {
            return $(elem).val();
        }).get();
        var data = {
            products_id: products_id,
            cart_quantity: cart_quantity
        };
        $('input.attr-hidden-value').each(function(){
            data[$(this).attr('name')] = $(this).val();
        });
        $.ajax({
            url: 'popup_cart.php?action=update_product',
            type: 'POST',
            data: data,
            success: function (response) {
                if (response !== undefined && response !== 0) {
                    response = JSON.parse(response);
                    updateCheckoutCart(response);
                }
                updateCart();
                if (typeof checkout != 'undefined') {
                    checkout.updateOrderTotals();
                }
            }
        });
    });

    // validate checkout fields when change new poshta selects
    $(document).on('change', '#np_cities, #np_warehouses', function () {
        disableCheckoutButton();
    });
    $(document).on('blur', 'input[name^="shipping_fields"]', function () {
        disableCheckoutButton();
    });
});