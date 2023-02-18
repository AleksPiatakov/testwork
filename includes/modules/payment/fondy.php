<?php

/** @noinspection PhpUnused */

$rootDirectory = __DIR__ . "/../../../";
$pathToPaymentModule = $rootDirectory . 'ext/acquiring/fondy/fondy.php';
if (defined('CARDS_ENABLED') && CARDS_ENABLED == 'true' && file_exists($pathToPaymentModule)) {
    /** @noinspection PhpIncludeInspection */
    require_once $pathToPaymentModule;
} else {
    class fondy
    {
        use EmptyPaymentMethod;

        /**
         * fondy constructor.
         */
        public function __construct()
        {
            $this->title = MODULE_PAYMENT_FONDY_TEXT_TITLE;
            $this->description = MODULE_PAYMENT_FONDY_TEXT_ADMIN_DESCRIPTION;
            $this->getConfigurationLink();
        }
    }
}
