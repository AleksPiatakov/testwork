<?php

/** @noinspection PhpUnused */

$moduleFilePath = __DIR__ . "/../../../ext/multisafepay/multisafepay.php";
if (defined('CARDS_ENABLED') && CARDS_ENABLED == 'true' && file_exists($moduleFilePath)) {
    /** @noinspection PhpIncludeInspection */
    require_once $moduleFilePath;
} else {
    class multisafepay
    {
        use EmptyPaymentMethod;

        public function __construct()
        {
            $this->title = MODULE_PAYMENT_MULTISAFEPAY_TEXT_TITLE;
            $this->description = MODULE_PAYMENT_MULTISAFEPAY_TEXT_TITLE;
            $this->getConfigurationLink();
        }

        public function check()
        {
            if (!isset($this->_check)) {
                $check_query = tep_db_query(
                    "select configuration_value from " . TABLE_CONFIGURATION .
                    " where configuration_key = 'MODULE_PAYMENT_LIQPAY_STATUS'"
                );
                $this->_check = tep_db_num_rows($check_query);
            }

            return $this->_check;
        }
    }
}
