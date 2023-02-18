<?php

/** @noinspection PhpUnused */

$rootDirectory = __DIR__ . "/../../../";
$pathToPaymentModule = $rootDirectory . 'ext/acquiring/oshad/oshad.php';

if (defined('CARDS_ENABLED') && CARDS_ENABLED == 'true' && file_exists($pathToPaymentModule)) {
    /** @noinspection PhpIncludeInspection */
    require_once $pathToPaymentModule;
} else {
    class oshad
    {
        use EmptyPaymentMethod;

        public function __construct()
        {
            $this->title = MODULE_PAYMENT_OSHAD_TEXT_TITLE;
            $this->description = MODULE_PAYMENT_OSHAD_TEXT_ADMIN_DESCRIPTION;
            $this->getConfigurationLink();
        }
    }
}
