<?php

/** @noinspection PhpUnused */

$rootDirectory = __DIR__ . "/../../../";
$pathToPaymentModule = $rootDirectory . 'ext/acquiring/yandex/yandex.php';
if (defined('CARDS_ENABLED') && CARDS_ENABLED == 'true' && file_exists($pathToPaymentModule)) {
    /** @noinspection PhpIncludeInspection */
    require_once $pathToPaymentModule;
} else {
    class yandex
    {
        use EmptyPaymentMethod;

        public function __construct()
        {
            $this->title = MODULE_PAYMENT_YANDEX_TEXT_TITLE;
            $this->description = MODULE_PAYMENT_YANDEX_TEXT_ADMIN_DESCRIPTION;
            $this->getConfigurationLink();
        }
    }
}
