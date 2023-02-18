<?php

/** @noinspection PhpUnused */

$rootDirectory = __DIR__ . "/../../../";
$pathToPaymentModule = $rootDirectory . 'ext/acquiring/portmone/portmone.php';
if (defined('CARDS_ENABLED') && CARDS_ENABLED == 'true' && file_exists($pathToPaymentModule)) {
    /** @noinspection PhpIncludeInspection */
    require_once $pathToPaymentModule;
} else {
    class portmone
    {
        use EmptyPaymentMethod;

        public function __construct()
        {
            $this->title = MODULE_PAYMENT_PORTMONE_TEXT_TITLE;
            $this->description = MODULE_PAYMENT_PORTMONE_TEXT_ADMIN_DESCRIPTION;
            $this->getConfigurationLink();
        }
    }
}
