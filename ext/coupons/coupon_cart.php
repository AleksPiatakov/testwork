<?php

$r_mycode = $_POST['gv_redeem_code'];
$coupon_text = '<span class="coupon_text">' . TEXT_COUPON_NOTIFICATION . '</span>';

if (!empty($r_mycode)) {
    $coupon_array = redeemCoupon($r_mycode);
    $coupon_array = json_decode($coupon_array);
    if ($coupon_array->success == 'true') {
        $coupon_text .= '<p class="valid_coupon">' . $r_mycode . ' <span>' . $coupon_array->coupon_discount . '</span>
                         <button id="deleteCupon" type="button" class="close" aria-label="Close">
                         <span aria-hidden="true">&times;</span></button></p>';
    } else {
        $coupon_text .= '<div class="coupon_response_invalid">' . $coupon_array->message . '</div>';
    }
} else {
    if (isset($cc_ids)) {
        unset($cc_ids);
    }
    if (isset($_SESSION['cc_ids'])) {
        unset($_SESSION['cc_ids']);
    }
}

function redeemCoupon($code)
{
    //BOF KGT

    if (MODULE_ORDER_TOTAL_COUPON_STATUS == 'true') {
        //EOF KGT
        global $customer_id, $order, $REMOTE_ADDR, $credit_covers, $order_total_modules, $cart, $currencies;
        if (!$order) {
            $order = new order();//fix for promocodes in url
        }
        if ($code) {
            $code = addslashes($code);
            $coupon_query = tep_db_query("select coupon_id, coupon_amount, coupon_type, coupon_minimum_order,uses_per_coupon, uses_per_user, restrict_to_products, restrict_to_categories from " . TABLE_COUPONS . " where coupon_code='" . $code . "' and coupon_active='Y'");

            $coupon_results = [];
            $errMsg = ERROR_NO_INVALID_REDEEM_COUPON;
            while ($coupon_result = tep_db_fetch_array($coupon_query)) {
                $error = false;
                if ($coupon_result['coupon_type'] != 'G') {
                    //existing
                    if (tep_db_num_rows($coupon_query) == 0) {
                        $error = true;
                        $errMsg = ERROR_NO_INVALID_REDEEM_COUPON;
                    }

                    //coupon_minimum_order
                    if ((float)$coupon_result['coupon_minimum_order'] > 0 && $cart->show_total() < (float)$coupon_result['coupon_minimum_order']) {
                        $error = true;
                        $errMsg = sprintf(ERROR_MINIMUM_CART_AMOUNT, $currencies->display_price($coupon_result['coupon_minimum_order'], 0, 1, true));
                    }

                    //coupon_start_date
                    $date_query = tep_db_query("select coupon_start_date from " . TABLE_COUPONS . " where coupon_start_date <= now() and coupon_code='" . $code . "'");
                    if (tep_db_num_rows($date_query) == 0) {
                        $error = true;
                        $errMsg = ERROR_INVALID_STARTDATE_COUPON;
                    }

                    //coupon_expire_date
                    $date_query = tep_db_query("select coupon_expire_date from " . TABLE_COUPONS . " where coupon_expire_date >= now() and coupon_code='" . $code . "'");
                    if (tep_db_num_rows($date_query) == 0) {
                        $error = true;
                        $errMsg = ERROR_INVALID_FINISDATE_COUPON;
                    }

                    //uses_per_coupon
                    $coupon_count = tep_db_query("select coupon_id from " . TABLE_COUPON_REDEEM_TRACK . " where coupon_id = '" . $coupon_result['coupon_id'] . "'");
                    if (tep_db_num_rows($coupon_count) >= $coupon_result['uses_per_coupon'] && $coupon_result['uses_per_coupon'] > 0) {
                        $error = true;
                        $errMsg = ERROR_INVALID_USES_COUPON . $coupon_result['uses_per_coupon'] . TIMES;
                    }

                    //customer conditions
                    if (!empty($customer_id) or empty($REMOTE_ADDR)) {
                        $userCond = "and customer_id = '" . $customer_id . "' and customer_id>0";
                    } else {
                        $userCond = "and redeem_ip = '" . $REMOTE_ADDR . "'";
                    }
                    $coupon_count_customer = tep_db_query("select coupon_id from " . TABLE_COUPON_REDEEM_TRACK . " where coupon_id = '" . $coupon_result['coupon_id'] . "'" . $userCond);

                    if (tep_db_num_rows($coupon_count_customer) >= $coupon_result['uses_per_user'] && $coupon_result['uses_per_user'] > 0) {
                        $error = true;
                        $errMsg = ERROR_INVALID_USES_USER_COUPON . $coupon_result['uses_per_user'] . TIMES;
                    }

                    //collect product_id from order
                    if (is_array($order->products)) {
                        foreach (array_column($order->products, 'id') as $pid) {
                            $pids[] = tep_get_prid($pid);
                        }
                    } else {
                        $pids = [];
                    }

                    //restrict_to_categories
                    if ($coupon_result['restrict_to_categories'] !== '') {
                        $cat_query = tep_db_query("select products_id from products_to_categories 
                        where products_id in(" . implode(',', $pids) . ") 
                        and categories_id in(" . $coupon_result['restrict_to_categories'] . ")");
                        if (tep_db_num_rows($cat_query) == 0) {
                            $error = true;
                            $errMsg = ERROR_RESTRICTION_COUPON;
                        }
                    }

                    //restrict_to_products
                    if (!empty($coupon_result['restrict_to_products'])) {
                        $coupon_result['restrict_to_products'] = preg_replace('/\s+/', '', $coupon_result['restrict_to_products']);
                        $products_array = explode(',', $coupon_result['restrict_to_products']);
                        $intersect = array_intersect($products_array, $pids);
                        if (empty($intersect)) {
                            $error = true;
                            $errMsg = ERROR_RESTRICTION_COUPON;
                        }
                    }

                    //get coupon discount value
                    if ($error === false) {
                        $coupon_results[] = $coupon_result['coupon_id'];

                        if (empty($couponDiscount)) {
                            $coupon_result["coupon_amount"] = cutToFirstSignificantDigit($coupon_result["coupon_amount"]);

                            if (strpos($coupon_result['coupon_type'], 'P') !== false) {
                                $couponDiscount = $coupon_result["coupon_amount"] . '%';
                            } else {
                                $couponDiscount = $currencies->format($coupon_result["coupon_amount"]);
                            }

                            if (strpos($coupon_result['coupon_type'], 'S') !== false) {
                                $format = !empty($couponDiscount) ? (' (%s)') : '%s';
                                $couponDiscount .= sprintf($format, getConstantValue('NEW_CHECKOUT_COUPON_TEXT_FREE_SHIPPING'));
                            }
                        }
                    }

                }
            }
            if (!empty($coupon_results)) {
                global $order_total_modules, $cc_ids;
                $cc_ids = $coupon_results;
                if (!tep_session_is_registered('cc_ids')) {
                    tep_session_register('cc_ids');
                }
                $_SESSION['cc_ids'] = $cc_ids;
                $order_total_modules->pre_confirmation_check();
                if (!tep_session_is_registered('credit_covers')) {
                    tep_session_register('credit_covers');
                    $credit_covers = true;
                }
                return '{"success": "true", "coupon_discount": "' . $couponDiscount . '"}';
            } else {
                return '{"success": "false","message":"' . $errMsg . '"}';
                if (tep_session_is_registered('credit_covers')) {
                    tep_session_unregister('credit_covers');
                }
            }
        }
    }
    return '{"success": "false","message":"Module is disabled"}';
}
