<?php

/**
 * Payment module stripe
 */

class stripe
{

    /**
     * @var string
     */
    public $code;

    /**
     * @var string
     */
    public $title;

    /**
     * @var
     */
    public $description;

    /**
     * @var bool
     */
    public $enabled;

    /**
     * @var
     */
    public $sort_order;

    /**
     * stripe constructor.
     */
    function __construct()
    {
        global $order;

        $this->code = 'stripe'; // Should be the same as file name
        $this->title = MODULE_PAYMENT_STRIPE_TEXT_TITLE . (!isMobile() ? MODULE_PAYMENT_STRIPE_IMAGES : '');
        $this->description = MODULE_PAYMENT_STRIPE_TEXT_DESCRIPTION;
        $this->sort_order = MODULE_PAYMENT_STRIPE_SORT_ORDER;
        $this->enabled = ((MODULE_PAYMENT_STRIPE_STATUS == 'True') ? true : false);

        if (is_object($order)) {
            $this->update_status();
        }
    }

    /**
     * If in settings module set zone id then this method check and off module if current zone different
     */
    function update_status()
    {
        global $order;

        if (
            $this->enabled == true &&
            (int)getConstantValue('MODULE_PAYMENT_STRIPE_ZONE', 0) > 0 &&
            getConstantValue('ACCOUNT_COUNTRY') == 'true' && getConstantValue('ACCOUNT_STATE') == 'true'
        ) {
            $check_flag = false;
            $check_query = "
                select zone_id 
                from " . TABLE_ZONES_TO_GEO_ZONES . " 
                where geo_zone_id = '" . (int)MODULE_PAYMENT_STRIPE_ZONE . "' 
                      and (zone_country_id = '" . (int)$order->billing['country']['id'] . "' or zone_country_id=0) 
                order by zone_id";
            $check_query = tep_db_query($check_query);
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

    /**
     * Method build module for checkout page
     *
     * @return array|bool
     */
    function selection()
    {
        global $currency, $onepage, $order, $currencies, $order_total_modules, $ot_total;

        if (!payment::isModuleAvailable()) {
            return false;
        }

        // Create PaymentIntent only if selected stripe
        if ($onepage["info"]["payment_method"] === $this->code) {
            // If Stripe API return error save message to this value and print in stripe payment module
            $err = '';
            // Set the secret key
            \Stripe\Stripe::setApiKey(MODULE_PAYMENT_SECRET_KEY);
            // Calculation of the final price
            if (empty($ot_total->output)) {
                $order_total_modules->process();
            }
            $amount = tep_round($order->info['total'], $currencies->currencies[$currency]['decimal_places']) * 100; // convert to cents
            // Check if payment intent already exist
            if (isset($_SESSION['payment_intent'])) {
                try {
                    $intent = \Stripe\PaymentIntent::retrieve($_SESSION['payment_intent'], []);
                    // Check the status and create a new PaymentIntent if already payment
                    if ($intent->status !== 'succeeded') {
                        // Update price if it changes
                        if ($intent->amount !== $amount) {
                            \Stripe\PaymentIntent::update(
                                $_SESSION['payment_intent'],
                                ['amount' => $amount]
                            );
                        }
                    } else {
                        $intent = \Stripe\PaymentIntent::create([
                            'amount' => $amount,
                            'currency' => $currency,
                            'payment_method_types' => ['card'],
                        ]);

                        $_SESSION['payment_intent'] = $intent->id;
                    }
                } catch (\Stripe\Exception\ApiErrorException $e) {
                    $err = $e->getJsonBody();
                    $err = $err['error'];
                    $err = 'Status is:' . $e->getHttpStatus() . " " . $err['message'];
                }
            } else {
                try {
                    $intent = \Stripe\PaymentIntent::create([
                        'amount' => $amount,
                        'currency' => $currency,
                        'payment_method_types' => ['card'],
                    ]);

                    $_SESSION['payment_intent'] = $intent->id;
                } catch (\Stripe\Exception\ApiErrorException $e) {
                    $err = $e->getJsonBody();
                    $err = $err['error'];
                    $err = 'Status is:' . $e->getHttpStatus() . " " . $err['message'];
                }
            }
        }

        $strip_field = '
            <script src="https://js.stripe.com/v3/"></script>
            <input type="hidden" name="current_code" value="' . $this->code . '" />
            <script>
                $(document).ready(function() {
                    setTimeout(function() {
                                          var stripe = Stripe("' . MODULE_PAYMENT_PUBLIC_KEY . '");
                    
                    var elements = stripe.elements();
                    var card;
                    
                    // Initialize stripe fields
                    card = elements.create("cardNumber", {
                        classes: {
                            base: "form-control"
                        }
                    });
                    card.mount("#cardNumber");
                    
                    card = elements.create("cardExpiry", {
                        classes: {
                            base: "form-control"
                        }
                    });
                    card.mount("#cardExpiry");
                    
                    card = elements.create("cardCvc", {
                        classes: {
                            base: "form-control"
                        }
                    });
                    card.mount("#cardCvc");
                                                               
                    if($("#checkoutButtonContainer #additional-button-container").length === 0) {
                        $("#checkoutButtonContainer").append(\'<div id="additional-button-container"></div>\');
                        $("#additional-button-container").html(\'\');
                        $("#additional-button-container").append(\'<span id="sub_butt" class="btn" value="Submit"><svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M435.848 83.466L172.804 346.51l-96.652-96.652c-4.686-4.686-12.284-4.686-16.971 0l-28.284 28.284c-4.686 4.686-4.686 12.284 0 16.971l133.421 133.421c4.686 4.686 12.284 4.686 16.971 0l299.813-299.813c4.686-4.686 4.686-12.284 0-16.971l-28.284-28.284c-4.686-4.686-12.284-4.686-16.97 0z"></path></svg>' . IMAGE_BUTTON_CHECKOUT . '</span>\');
                    } 
                    
                    if($("input[name=payment][value=" + $("input[name=current_code]").val() + "]").prop("checked") === true) {
                        $("#checkoutButton").hide(); 
                        $("#additional-button-container").show();                            
                    }
                    
                    $(\'body\').on(\'click\', \'#sub_butt\', function(event) {                         
                            // Disable the button to prevent repeated clicks
                            $(\'#sub_butt\').prop(\'disabled\', true);
                            var has_error = false;
                            $(\'select[name="\'+addressTypeConfiguration.first.fullPrefix+\'_country"], select[name="\'+addressTypeConfiguration.first.fullPrefix+\'_zone_id"], input\', $(\'#\'+ addressTypeConfiguration.first.id)).each(function (){
                                if (checkout.fieldErrorCheck($(this), false, false)) {
                                    has_error = true;
                                }
                            });
                            if (has_error) {
                                $("#sub_butt").prop("disabled", false); // Allow submit
                                return false;
                            }
            
                            // confirmCardPayment
                            stripe.confirmCardPayment(
                                "' . $intent->client_secret . '",
                                {
                                    payment_method: {card: card}
                                }
                            ).then(stripeResponseHandler);                        
            
                            // Deny the form submit
                            return false;
                        });
                    }, 500);
                    
                });
            
                function stripeResponseHandler(response) {
                    var $form = $(\'#payment-form\');
            
                    if (response.error) { // Problem!
                        
                        var errorMessages = {
                            incorrect_number: "' . MODULE_PAYMENT_STRIPE_INCORRECT_NUMBER . '",
                            invalid_number: "' . MODULE_PAYMENT_STRIPE_INVALID_NUMBER . '",
                            invalid_expiry_month: "' . MODULE_PAYMENT_STRIPE_INVALID_EXPIRY_MONTH . '",
                            invalid_expiry_year: "' . MODULE_PAYMENT_STRIPE_INVALID_EXPIRY_YEAR . '",
                            invalid_cvc: "' . MODULE_PAYMENT_STRIPE_INVALID_CVC . '",
                            expired_card: "' . MODULE_PAYMENT_STRIPE_EXPIRED_CARD . '",
                            incorrect_cvc: "' . MODULE_PAYMENT_STRIPE_INCORRECT_CVC . '",
                            incorrect_zip: "' . MODULE_PAYMENT_STRIPE_INCORRECT_ZIP . '",
                            card_declined: "' . MODULE_PAYMENT_STRIPE_CARD_DECLINED . '",
                            missing: "' . MODULE_PAYMENT_STRIPE_MISSING . '",
                            processing_error: "' . MODULE_PAYMENT_STRIPE_PROCESSING_ERROR . '",
                            rate_limit:  "' . MODULE_PAYMENT_STRIPE_RATE_LIMIT . '"
                        };
                        
                        // Delete error message if customer change data
                        $(".new_payment_form input").on("change", function() {
                            $form.find(".payment-errors").text("");
                        });
                        
                        $(".paymentMethods.collapse_wrapper").removeClass("success_block");
                        $(".paymentMethods.collapse_wrapper").addClass("error");
            
                        // Show errors in form
                        if (response.error.type === "card_error") {
                            $form.find(".payment-errors").text(errorMessages[response.error.code]);
                        } else {
                            $form.find(".payment-errors").text(response.error.message);
                        }
                        $("#sub_butt").prop("disabled", false); // Allow submit
            
                    } else { // Payment was successful
            
                        // Get PaymentIntent ID
                        var paymentIntentID = response.paymentIntent.id;
                        // Add id to form for send to server
                        $("#paymentHiddenFields").append($(\'<input type="hidden" name="paymentIntentID">\').val(paymentIntentID));
            
                        $("#additional-button-container").hide();
                        $("#checkoutButton").show(); 
                        $("#checkoutButton").click();
                    }
                };
            </script>
             <style type="text/css">
                 #payment-form{
                  position: relative; 
                   font-size: 13px;
                 }
             </style>
            ';

        $strip_field .= isMobile() ? '<div class="new_payment_form">
            <form action="" method="POST" id="payment-form">
                <label class="number_field">
                    ' . MODULE_PAYMENT_STRIPE_TEXT_CREDIT_CARD_NUMBER . '
                    <div id="cardNumber">
                        <!-- a Stripe Element will be inserted here. -->
                    </div>
                </label>
                <label class="cvc_field">
                    ' . MODULE_PAYMENT_STRIPE_TEXT_CREDIT_CARD_CVC . '
                    <div id="cardCvc">
                        <!-- a Stripe Element will be inserted here. -->
                    </div>
                </label>
                <label class="month_field">
                    ' . MODULE_PAYMENT_STRIPE_TEXT_CREDIT_CARD_EXPIRES_MM . '
                    <div id="cardExpiry">
                        <!-- a Stripe Element will be inserted here. -->
                    </div>
                 </label>
                <span class="payment-errors"></span>
            </form>
        </div>
        ' : '<div class="new_payment_form">
            <form action="" method="POST" id="payment-form">
                <div class="form-row">
                    <label class="number_field">
                        ' . MODULE_PAYMENT_STRIPE_TEXT_CREDIT_CARD_NUMBER . '
                        <div id="cardNumber">
                            <!-- a Stripe Element will be inserted here. -->
                        </div>
                    </label>
                    
                    <label class="month_field">
                        ' . MODULE_PAYMENT_STRIPE_TEXT_CREDIT_CARD_EXPIRES_MM . '
                        <div id="cardExpiry">
                            <!-- a Stripe Element will be inserted here. -->
                        </div>
                    </label>
                    
                    <label class="cvc_field">
                        ' . MODULE_PAYMENT_STRIPE_TEXT_CREDIT_CARD_CVC . '
                        <div id="cardCvc">
                            <!-- a Stripe Element will be inserted here. -->
                        </div>
                    </label>

                    <div class="payment-errors" role="alert">' . $err . '</div>
                </div>
            </form>
        </div>';

        $selection = [
            'id' => $this->code,
            'module' => $this->title,
            'fields' => [
                [
                    'title' => '',
                    'field' => $strip_field
                ]
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
        $confirmation = [
            'title' => $this->title,
            'fields' => [],
        ];

        return $confirmation;
    }

    function process_button()
    {
        global $_POST;

        $process_button_string =
            tep_draw_hidden_field('cc_owner', $_POST['cc_owner']) .
            tep_draw_hidden_field('cc_expires', $_POST['cc_expires_month'] . $_POST['cc_expires_year']) .
            tep_draw_hidden_field('cc_type', $this->cc_card_type) .
            tep_draw_hidden_field('cc_number', $this->cc_card_number);

        return $process_button_string;
    }

    function before_process()
    {
        return false;
    }

    function after_process()
    {
        global $insert_id, $order, $stripe_customer_id;

        \Stripe\Stripe::setApiKey(MODULE_PAYMENT_SECRET_KEY);

        if (!$_SESSION['stripe_customer_id']) {
            // Create a Customer
            try {
                $customer = \Stripe\Customer::create([
                    'email' => $order->customer['email_address'],
                ]);
                $stripe_customer_id = $customer->id;
                if ($stripe_customer_id && isset($_SESSION['customer_id'])) {
                    tep_db_query('update customers c set c.stripe_customer_id = "' . $stripe_customer_id . '" where c.customers_id = ' . $_SESSION['customer_id']);
                }
            } catch (\Stripe\Exception\ApiErrorException $e) {
                $body = $e->getJsonBody();
                $err = $body['error'];
                print('Status is:' . $e->getHttpStatus() . " " . $err['message']);
            }
        } else {
            $stripe_customer_id = $_SESSION['stripe_customer_id'];
        }


        try {
            $paymentIntent = \Stripe\PaymentIntent::retrieve($_SESSION['payment_intent'], []);
            if ($paymentIntent->status === 'succeeded') {
                // update order status
                tep_db_perform(TABLE_ORDERS, ['orders_status' => MODULE_PAYMENT_STRIPE_ORDER_STATUS_ID], 'update', "orders_id='" . $insert_id . "'");
                tep_db_perform(
                    TABLE_ORDERS_STATUS_HISTORY,
                    [
                        'orders_id' => $insert_id,
                        'orders_status_id' => MODULE_PAYMENT_STRIPE_ORDER_STATUS_ID,
                        'date_added' => 'now()',
                        'customer_notified' => '0',
                        'comments' => 'Stripe - success!'
                    ]
                );

                // send email to customer:
                $email_order = 'Hello, ' . $order->customer['firstname'] . '.<br />Your order was successfully paid through Stripe.';
                tep_mail($order->customer['firstname'], $order->customer['email_address'], 'Status for order #' . $insert_id . ' - ' . strftime(DATE_FORMAT_LONG), nl2br($email_order), STORE_OWNER,
                    STORE_OWNER_EMAIL_ADDRESS, '');
            }

            // Add customer id and order id to paymentIntent
            \Stripe\PaymentIntent::update(
                $_SESSION['payment_intent'],
                [
                    'customer' => $stripe_customer_id,
                    'metadata' => [
                        'order_id' => $insert_id,
                    ]
                ]
            );
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $body = $e->getJsonBody();
            $err = $body['error'];
            print('Status is:' . $e->getHttpStatus() . " " . $err['message']);
        }
        unset($_SESSION['payment_intent']);
        unset($_SESSION['stripe_total']);
    }

    function get_error()
    {
        global $_GET;

        $error = array(
            'title' => MODULE_PAYMENT_STRIPE_TEXT_ERROR,
            'error' => stripslashes(urldecode($_GET['error']))
        );

        return $error;
    }

    function check()
    {
        if (!isset($this->_check)) {
            $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_STRIPE_STATUS'");
            $this->_check = tep_db_num_rows($check_query);
        }
        return $this->_check;
    }

    static function install()
    {
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Allow Stripe module', 'MODULE_PAYMENT_STRIPE_STATUS', 'True', 'Allow Stripe module?', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Public key', 'MODULE_PAYMENT_PUBLIC_KEY', '', 'Public key', '6', '0', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Secret key', 'MODULE_PAYMENT_SECRET_KEY', '', 'Secret key', '6', '0', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order.', 'MODULE_PAYMENT_STRIPE_SORT_ORDER', '0', 'Sort order.', '6', '0' , now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Zone', 'MODULE_PAYMENT_STRIPE_ZONE', '0', 'Zone', '6', '2', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Success status', 'MODULE_PAYMENT_STRIPE_ORDER_STATUS_ID', '0', 'Success status', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
    }

    function remove()
    {
        tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", static::keys()) . "')");
    }

    static function keys()
    {
        return array(
            'MODULE_PAYMENT_STRIPE_STATUS',
            'MODULE_PAYMENT_STRIPE_ZONE',
            'MODULE_PAYMENT_STRIPE_ORDER_STATUS_ID',
            'MODULE_PAYMENT_STRIPE_SORT_ORDER',
            'MODULE_PAYMENT_PUBLIC_KEY',
            'MODULE_PAYMENT_SECRET_KEY'
        );
    }
}
