<?php

/** @noinspection PhpUnused */

$rootDirectory = __DIR__ . "/../../../";
$pathToPaymentModule = $rootDirectory . 'ext/acquiring/paylike/paylike.php';
if (defined('CARDS_ENABLED') && CARDS_ENABLED == 'true' && file_exists($pathToPaymentModule)) {
    /** @noinspection PhpIncludeInspection */
    require_once $pathToPaymentModule;
} else {
    class paylike
    {
        use EmptyPaymentMethod;

        public function __construct()
        {
            $this->title = MODULE_PAYMENT_PAYLIKE_TEXT_TITLE;
            $this->description = MODULE_PAYMENT_PAYLIKE_TEXT_DESCRIPTION;
            $this->getConfigurationLink();
        }
    }
}
