<?php

function checkMinimumOrderValue($cartTotal)
{
    global $currencies, $currency;
    return MIN_ORDER * $currencies->currencies[$currency]['value'] <= $cartTotal * $currencies->currencies[$currency]['value'];
}
