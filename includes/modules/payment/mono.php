<?php

/** @noinspection PhpUnused */

$rootDirectory = __DIR__ . "/../../../";
$mono_path = $rootDirectory . 'ext/acquiring/mono/mono.php';
if (defined('CARDS_ENABLED') && CARDS_ENABLED == 'true' && file_exists($mono_path)) {
    /** @noinspection PhpIncludeInspection */
    require_once $mono_path;
} else {
    class mono
    {
        use EmptyPaymentMethod;

        public function __construct()
        {
            $this->title = MODULE_PAYMENT_MONO_TEXT_TITLE . !isMobile() ? MODULE_PAYMENT_MONO_IMAGES : '';
            $this->description = MODULE_PAYMENT_MONO_TEXT_ADMIN_DESCRIPTION;
            $this->getConfigurationLink();
        }

        public function check()
        {
            if (!isset($this->_check)) {
                $check_query = tep_db_query(
                    "select configuration_value from " . TABLE_CONFIGURATION .
                    " where configuration_key = 'MODULE_PAYMENT_MONO_STATUS'"
                );
                $this->_check = tep_db_num_rows($check_query);
            }
            return $this->_check;
        }
    }
}
