<?php

/** @noinspection PhpUnused */

$rootDirectory = __DIR__ . "/../../../";
$pathToPaymentModule = $rootDirectory . 'ext/acquiring/stripe/stripe.php';
if (defined('CARDS_ENABLED') && CARDS_ENABLED == 'true' && file_exists($pathToPaymentModule)) {
    /** @noinspection PhpIncludeInspection */
    require_once $pathToPaymentModule;
} else {
    class stripe
    {
        use EmptyPaymentMethod;

        public function __construct()
        {
            $this->title = MODULE_PAYMENT_STRIPE_TEXT_TITLE . (!isMobile() ? MODULE_PAYMENT_STRIPE_IMAGES : '');
            $this->description = MODULE_PAYMENT_STRIPE_TEXT_DESCRIPTION;
            $this->getConfigurationLink();
        }
    }
}
