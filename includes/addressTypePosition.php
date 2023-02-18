<?php

$billingIdentificators = [
    'id'          => 'billingAddress',
    'fullPrefix'  => 'billing',
    'type'        => 'billto',
    'infoChanged' => 'billingInfoChanged',
    'orderPrefix' => 'billing',
    'action'      => 'setBillTo',
    'jsProcessCallback' => 'processBillingAddress'
];

$shippingIdentificators = [
    'id'          => 'shippingAddress',
    'fullPrefix'  => 'shipping',
    'type'        => 'sendto',
    'infoChanged' => 'shippingInfoChanged',
    'orderPrefix' => 'delivery',
    'action'      => 'setSendTo',
    'jsProcessCallback' => 'processShippingAddress'
];

$addressTypeIdentificators = [
    'first'  => ONEPAGE_ADDRESS_TYPE_POSITION == 'billing_shipping' ? $billingIdentificators : $shippingIdentificators,
    'second' => ONEPAGE_ADDRESS_TYPE_POSITION == 'billing_shipping' ? $shippingIdentificators : $billingIdentificators
];
