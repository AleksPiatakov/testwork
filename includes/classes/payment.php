<?php

/*
  $Id: payment.php,v 1.1.1.1 2003/09/18 19:05:15 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

class payment
{
    var $modules, $selected_module;

    // class constructor
    function __construct($module = '')
    {
        global $payment, $language, $PHP_SELF, $cart, $customer_id, $customers_groups_id;

        if (defined('MODULE_PAYMENT_INSTALLED') && tep_not_null(MODULE_PAYMENT_INSTALLED)) {
            if (is_file(DIR_WS_EXT . 'customers_groups/customers_groups.php')) {
                $customer_payment_query = tep_db_query("select IF(c.customers_payment_allowed <> '', c.customers_payment_allowed, cg.group_payment_allowed) as payment_allowed
                from " . TABLE_CUSTOMERS . " c, " . TABLE_CUSTOMERS_GROUPS . " cg where
                 c.customers_id = " . (int)$customer_id . " and cg.customers_groups_id =  " . (int)$customers_groups_id);
            } else {
                $customer_payment_query = tep_db_query("select c.customers_payment_allowed as payment_allowed 
                from " . TABLE_CUSTOMERS . " c where
                 c.customers_id = " . (int)$customer_id);
            }

            if (getConstantValue('SHIP2PAY_ENABLED') == 'true' && is_file(DIR_FS_EXT . 'ship2pay/ship2pay.php')) {
                require_once(DIR_FS_EXT . 'ship2pay/ship2pay.php');
                $this->modules = ship2pay();
            } else {
                $this->modules = explode(';', MODULE_PAYMENT_INSTALLED);
            }

            if ($customer_payment = tep_db_fetch_array($customer_payment_query)) {
                if (tep_not_null($customer_payment['payment_allowed'])) {
                    $temp_payment_array = explode(';', $customer_payment['payment_allowed']);
                    $installed_modules = explode(';', MODULE_PAYMENT_INSTALLED);
                    for ($n = 0; $n < sizeof($installed_modules); $n++) {
                        // check to see if a payment method is not de-installed
                        if (in_array($installed_modules[$n], $temp_payment_array)) {
                            $payment_array[] = $installed_modules[$n];
                        }
                    } // end for loop

                    $this->modules = $payment_array;
                }
            }
            // add for SPPC shipment and payment module end

            $include_modules = [];
            if (
                tep_not_null($module) &&
                in_array(
                    $module . '.' . substr($PHP_SELF, (strrpos($PHP_SELF, '.') + 1)),
                    $this->modules
                )
            ) {
                $this->selected_module = $module;
                $include_modules[] = ['class' => $module, 'file' => $module . '.php'];
            } else {
                reset($this->modules);
                // BOF: WebMakers.com Added: Downloads Controller - Free Shipping and Payments
                // Show either normal payment modules or free payment module when Free Shipping Module is On
                // Free Payment Only

                //   if (
                //       tep_get_configuration_key_value('MODULE_PAYMENT_FREECHARGER_STATUS') and
                //       ($cart->show_total() == 0 and $cart->show_weight == 0)
                //   ) {
                //     $this->selected_module = $module;
                //     $include_modules[] = array('class'=> 'freecharger', 'file' => 'freecharger.php');
                //   } else {
                // All Other Payment Modules
                foreach ($this->modules as $key => $value) {
                    if (trim($value) == '') {
                        continue;
                    }
                    $class = substr($value, 0, strrpos($value, '.'));
                    // Don't show Free Payment Module
                    //  if ($class !='freecharger') {
                    $include_modules[] = ['class' => $class, 'file' => $value];
                    //  }
                }
                // EOF: WebMakers.com Added: Downloads Controller
                // }
            }

            for ($i = 0, $n = sizeof($include_modules); $i < $n; $i++) {
                if(!is_file(DIR_WS_MODULES . 'payment/' . $include_modules[$i]['file'])){
                    continue;
                }
                includeLanguages(DIR_WS_LANGUAGES . $language . '/modules/payment/' . $include_modules[$i]['file']);
                include_once(DIR_WS_MODULES . 'payment/' . $include_modules[$i]['file']);
                $GLOBALS[$include_modules[$i]['class']] = new $include_modules[$i]['class']();
            }

            // if there is only one payment method, select it as default because in
            // checkout_confirmation.php the $payment variable is being assigned the
            // $_POST['payment'] value which will be empty (no radio button selection possible)
            if (
                (tep_count_payment_modules() == 1) &&
                (!isset($GLOBALS[$payment]) || (isset($GLOBALS[$payment]) && !is_object($GLOBALS[$payment])))
            ) {
                $payment = $include_modules[0]['class'];
            }

            if (
                (tep_not_null($module)) &&
                (in_array($module, $this->modules)) &&
                (isset($GLOBALS[$module]->form_action_url))
            ) {
                $this->form_action_url = $GLOBALS[$module]->form_action_url;
            }
        }
    }

    // class methods
    /* The following method is needed in the checkout_confirmation.php page
       due to a chicken and egg problem with the payment class and order class.
       The payment modules needs the order destination data for the dynamic status
       feature, and the order class needs the payment module title.
       The following method is a work-around to implementing the method in all
       payment modules available which would break the modules in the contributions
       section. This should be looked into again post 2.2.
    */
    function update_status()
    {
        if (is_array($this->modules)) {
            if (is_object($GLOBALS[$this->selected_module])) {
                if (function_exists('method_exists')) {
                    if (method_exists($GLOBALS[$this->selected_module], 'update_status')) {
                        $GLOBALS[$this->selected_module]->update_status();
                    }
                } else { // PHP3 compatibility
                    @call_user_func('update_status', $GLOBALS[$this->selected_module]);
                }
            }
        }
    }

    function selection()
    {
        $selection_array = [];
        if (is_array($this->modules)) {
            reset($this->modules);
            foreach ($this->modules as $key => $value) {
                $class = substr($value, 0, strrpos($value, '.'));
                if ($GLOBALS[$class]->enabled) {
                    $selection = $GLOBALS[$class]->selection();
                    if (is_array($selection)) {
                        $selection_array[] = $selection;
                    }
                }
            }
        }

        return $selection_array;
    }
    //ICW CREDIT CLASS Gift Voucher System
    // check credit covers was setup to test whether credit covers is set in other parts of the code
    function check_credit_covers()
    {
        global $credit_covers;

        return $credit_covers;
    }

    function pre_confirmation_check()
    {
        global $credit_covers, $payment_modules; //ICW CREDIT CLASS Gift Voucher System
        if (is_array($this->modules)) {
            if (is_object($GLOBALS[$this->selected_module]) && ($GLOBALS[$this->selected_module]->enabled)) {
                if ($credit_covers) { //  ICW CREDIT CLASS Gift Voucher System
                    $GLOBALS[$this->selected_module]->enabled = false; //ICW CREDIT CLASS Gift Voucher System
                    $GLOBALS[$this->selected_module] = null; //ICW CREDIT CLASS Gift Voucher System
                    $payment_modules = ''; //ICW CREDIT CLASS Gift Voucher System
                } else { //ICW CREDIT CLASS Gift Voucher System
                    $GLOBALS[$this->selected_module]->pre_confirmation_check();
                }
            }
        }
    } //ICW CREDIT CLASS Gift Voucher System

    function confirmation()
    {
        if (is_array($this->modules)) {
            if (is_object($GLOBALS[$this->selected_module]) && ($GLOBALS[$this->selected_module]->enabled)) {
                return $GLOBALS[$this->selected_module]->confirmation();
            }
        }
    }

    function process_button()
    {
        if (is_array($this->modules)) {
            if (is_object($GLOBALS[$this->selected_module]) && ($GLOBALS[$this->selected_module]->enabled)) {
                return $GLOBALS[$this->selected_module]->process_button();
            }
        }
    }

    function before_process()
    {
        if (is_array($this->modules)) {
            if (is_object($GLOBALS[$this->selected_module]) && ($GLOBALS[$this->selected_module]->enabled)) {
                return $GLOBALS[$this->selected_module]->before_process();
            }
        }
    }

    function after_process()
    {
        if (is_array($this->modules)) {
            if (is_object($GLOBALS[$this->selected_module]) && ($GLOBALS[$this->selected_module]->enabled)) {
                return $GLOBALS[$this->selected_module]->after_process();
            }
        }
    }

    function get_error()
    {
        if (is_array($this->modules)) {
            if (is_object($GLOBALS[$this->selected_module]) && ($GLOBALS[$this->selected_module]->enabled)) {
                return $GLOBALS[$this->selected_module]->get_error();
            }
        }
    }

    static function isModuleAvailable()
    {
        return defined('CARDS_ENABLED') && strtolower(CARDS_ENABLED) === 'true';
    }
}
