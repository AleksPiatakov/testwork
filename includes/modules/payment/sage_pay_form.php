<?php

/** @noinspection PhpUnused */

$rootDirectory = __DIR__ . "/../../../";
$pathToPaymentModule = $rootDirectory . 'ext/acquiring/sage_pay_form/sage_pay_form.php';
if (defined('CARDS_ENABLED') && CARDS_ENABLED == 'true' && file_exists($pathToPaymentModule)) {
    /** @noinspection PhpIncludeInspection */
    require_once $pathToPaymentModule;
} else {
    class sage_pay_form
    {
        use EmptyPaymentMethod;

        public function __construct()
        {
            $this->title = MODULE_PAYMENT_SAGE_PAY_FORM_TEXT_TITLE;
            $this->description = MODULE_PAYMENT_SAGE_PAY_FORM_TEXT_DESCRIPTION;
            $this->getConfigurationLink();
        }
    }
}
