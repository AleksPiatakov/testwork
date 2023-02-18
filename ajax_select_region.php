<?php

if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' || (isset($ajaxSelectRegionTrue) && $ajaxSelectRegionTrue)) {
    if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
        require('includes/application_top.php');
    } else {
        if ($_GET['zone_field_name'] === 'shipping_zone_id') {
            $_GET['country_id'] = isset($shippingAddress) && tep_not_null($shippingAddress['country_id']) ? $shippingAddress['country_id'] : STORE_COUNTRY;
            $_GET['default_region'] = isset($shippingAddress) && tep_not_null($shippingAddress['zone_id']) ? $shippingAddress['zone_id'] : STORE_ZONE;
        } else {
            $_GET['country_id'] = isset($billingAddress) && tep_not_null($billingAddress["country_id"]) ? $billingAddress["country_id"] : STORE_COUNTRY;
            $_GET['default_region'] = isset($billingAddress) && tep_not_null($billingAddress["zone_id"]) ? $billingAddress["country_id"] : STORE_ZONE;
        }
    }

    if (!function_exists('get_region')) {
        function get_region($country_id, $name = 'selectRegion', $default_region = 0)
        {
            $regions_array = array(array('id' => '', 'text' => PULL_DOWN_COUNTRY));
            $regions = tep_get_country_zones($country_id);
            $size = sizeof($regions);

            for ($i = 0; $i < $size; $i++) {
                $regions_array[] = array('id' => $regions[$i]['id'], 'text' => $regions[$i]['text']);
            }

            echo '<span>';

            if ($size > 1) {
                echo tep_draw_pull_down_menu($name, $regions_array, $default_region, 'class="fulllength checkout_inputs required"');
            } else {
                echo tep_draw_input_field($name, $default_region, 'class="form-control checkout_inputs required" placeholder="' . ENTRY_STATE_ERROR_SELECT . '"');
            }

            echo '</span>';
        }
    }

    if (isset($_GET['country_id']) && ACCOUNT_STATE == "true") {
        get_region($_GET['country_id'], $name = $_GET['zone_field_name'], $_GET['default_region']);
    }

    if ($_GET['name'] == 'sendto') {
        $_SESSION['sendto'] = $_SESSION['customer_default_address_id'] = $_GET['val'];
    }
    if ($_GET['name'] == 'billto') {
        $_SESSION['billto'] = $_SESSION['customer_default_address_id'] = $_GET['val'];
    }
}
