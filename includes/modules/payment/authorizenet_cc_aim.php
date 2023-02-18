<?php

/** @noinspection PhpUnused */

$rootDirectory = __DIR__ . "/../../../";
$liqpay_path = $rootDirectory . 'ext/acquiring/authorizenet_cc_aim/authorizenet_cc_aim.php';

if (defined('CARDS_ENABLED') && CARDS_ENABLED === 'true' && file_exists($liqpay_path)) {
    /** @noinspection PhpIncludeInspection */
    require_once $liqpay_path;
} else {
    class authorizenet_cc_aim
    {
        use EmptyPaymentMethod;

        public function __construct()
        {
            $img = !isMobile() ? MODULE_PAYMENT_AUTHORIZENET_CC_AIM_IMAGES : '';
            $this->title = MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_TITLE . $img;
            $this->description = MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_DESCRIPTION;
            $this->getConfigurationLink();
        }
    }
}
