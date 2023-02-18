<?php

/** @noinspection PhpUnused */

$rootDirectory = __DIR__ . "/../../../";
$pathToPaymentModule = $rootDirectory . 'ext/acquiring/easypay/easypay.php';
if (defined('CARDS_ENABLED') && CARDS_ENABLED == 'true' && file_exists($pathToPaymentModule)) {
    /** @noinspection PhpIncludeInspection */
    require_once $pathToPaymentModule;
} else {
    class easypay
    {
        use EmptyPaymentMethod;

        var $code, $title, $description, $enabled;

        function __construct()
        {
            $this->getConfigurationLink();
        }

        function check()
        {
            return false;
        }
    }
}
