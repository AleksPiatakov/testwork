<?php

/**
 * @param string $tamplate_name
 * @param int    $languageId
 *
 * @return array||boolean
 */
function get_email_contents($tamplate_name, $languageId = false)
{
    $languageId = $languageId ? : $_SESSION['languages_id'];
    $query = tep_db_query('
			select email_name, email_description, from_name, from_email, subject, content_text, content_html
			from email_content ec
			where language_id = ' . (int)$languageId . ' 
			and email_name = "' . $tamplate_name . '";');

    return tep_db_num_rows($query) ? tep_db_fetch_array($query) : false;
}

/**
 * @param int $languageId
 *
 * @return string
 */
function getStoreCategories($languageId)
{
    $store_categories = '';
    $store_categories_query = tep_db_query("
            select cd.categories_id, cd.categories_name 
            from " . TABLE_CATEGORIES_DESCRIPTION . " cd
            left join " . TABLE_CATEGORIES . " c on c.categories_id = cd.categories_id 
            where c.categories_status = 1
            and cd.language_id = '" . (int)$languageId . "' 
            limit 5
        ");
    while ($sc_array = tep_db_fetch_array($store_categories_query)) {
        $store_categories .= '<a style="text-decoration:underline;color:inherit" href="' . HTTP_SERVER . '/index.php?cPath=' . $sc_array['categories_id'] . '"><span>' . $sc_array['categories_name'] . '</span></a><span style="padding:0 5px">&bull;</span>';
    }

    return $store_categories;
}

/**
 * @param string $new_password
 *
 * @return array
 */
function getPasswordForgottenText($new_password)
{
    $customFields = [
        '{CUSTOMER_IP}' => $_SERVER['REMOTE_ADDR'],
        '{CUSTOMER_PASSWORD}' => $new_password,
    ];

    return renderBaseTemplate($_SESSION['languages_id'], 'password_forgotten', $customFields);
}

/**
 * @param int    $languageId
 * @param array  $orderInfo
 * @param string $statusName
 * @param string $comment
 *
 * @return array
 */
function getChangeOrderStatusText($languageId, $orderInfo, $statusName, $comment = false)
{
    $customFields = [
        '{ORDER_NUMBER}' => $orderInfo['orders_id'],
        '{CUSTOMER_NAME}' => $orderInfo['customers_name'],
        '{DETAILED_I}' => tep_catalog_href_link(FILENAME_CATALOG_ACCOUNT_HISTORY_INFO, 'order_id=' . $orderInfo['orders_id'], 'SSL'),
        '{DATE_ORDER}' => tep_date_long_translate(tep_date_long($orderInfo['date_purchased'])),
        '{ORDER_STATUS}' => $statusName,
        '{ORDER_COMMENT}' => $comment ? : $orderInfo['comments'],
    ];

    return renderBaseTemplate($languageId, 'change_order_status', $customFields);
}

/**
 * @param int   $languageId
 * @param array $data
 *
 * @return array
 */
function getChangeGroupText($languageId, $data)
{
    $customFields = [
        '{ORDER_NUMBER}' => $data['orders_id'],
        '{CUSTOMER_NAME}' => $data['customers_name'],
        '{LIMIT}' => $data['limit'],
        '{CUSTOMERS_GROUP}' => $data['customers_groups_name'],
        '{CUSTOMERS_DISCOUNT}' => $data['current_discount'],
    ];

    return renderBaseTemplate($languageId, 'change_group', $customFields);
}

/**
 * @param int    $languageId
 * @param array  $data
 * @param string $email_template
 *
 * @return array
 */
function getRecoverCartSales($languageId, $data, $email_template)
{
    $customFields = [
        '{CUSTOMER_NAME}' => $data['customers_name'],
        '{CUSTOMER_EMAIL}' => $data['customers_email'],
        '{DATE_ORDER}' => $data['date_purchased'],
        '{DAYS}' => $data['days'],
        '{CUSTOMER_PHONE}' => $data['customers_phone'],
        '{PRODUCTS}' => $data['products_block'],
        '{ORDER_COMMENT}' => $data['comments'],
    ];

    return renderBaseTemplate($languageId, $email_template, $customFields);
}

/**
 * @param int   $languageId
 * @param array $data
 *
 * @return array
 */
function getChangeGroupManualText($languageId, $data)
{
    $customFields = [
        '{CUSTOMER_NAME}' => $data['customers_name'],
        '{CUSTOMERS_GROUP}' => $data['customers_group'],
        '{CUSTOMERS_DISCOUNT}' => $data['customers_discount'],
    ];

    return renderBaseTemplate($languageId, 'change_group_manual', $customFields);
}

/**
 * @param int    $languageId
 * @param string $template
 * @param array  $customFields
 *
 * @return array
 */
function renderBaseTemplate($languageId, $template, $customFields)
{

    $email_text = $subject = '';
    if ($content_email_array = get_email_contents($template, $languageId)) {
        $store_categories = getStoreCategories($languageId);
        if (!empty($customFields)) {
            foreach ($customFields as $key => &$row) {
                $row = stripslashes($row);
            }
        }
        // array to replace variables from html template:
        $array_from_to = [
            '{STORE_NAME}' => STORE_NAME,
            '{STORE_LOGO}' => HTTP_SERVER . '/' . str_replace("images/", "images/150x150/", LOGO_IMAGE),
            '{STORE_URL}' => HTTP_SERVER . tep_href_link('/'),
            '{STORE_OWNER_EMAIL}' => STORE_OWNER_EMAIL_ADDRESS,
            '{STORE_ADDRESS}' => strip_tags(renderArticle('contacts_footer')),
            '{STORE_PHONE}' => strip_tags(renderArticle('phones')),
            '{STORE_CATEGORIES}' => $store_categories,
        ];
        $array_from_to = array_merge($array_from_to, $customFields);

        $email_text = strtr($content_email_array['content_html'], $array_from_to);
        $subject = strtr($content_email_array['subject'], $array_from_to);
    }

    return [
        'content_html' => $email_text,
        'subject' => $subject,
    ];
}

/**
 * @param int   $languageId
 * @param array $data
 *
 * @return array
 */
function getCreateAccountText($languageId, $data)
{
    $customFields = [
        '{CUSTOMER_NAME}' => $data['customers_name'],
        '{CUSTOMER_LOGIN}' => $data['email_address'],
        '{CUSTOMER_PASSWORD}' => $data['password'],
    ];

    return renderBaseTemplate($languageId, 'create_account', $customFields);
}

/**
 * @param int   $languageId
 * @param array $data
 *
 * @return array
 */
function getSuccessPaymentText($languageId, $data)
{
    $customFields = [
        '{CUSTOMER_NAME}' => $data['customers_name'],
        '{ORDER_ID}' => $data['order_id'],
        '{PAYMENT_METHOD}' => $data['payment_method'],
    ];

    return renderBaseTemplate($languageId, 'success_payment', $customFields);
}

/**
 * @param int   $languageId
 * @param array $data
 *
 * @return array
 */
function getCreateOrderText($languageId, $data)
{
    $customFields = [
        '{ORDER_NUMBER}' => $data['order_number'],
        '{DETAILED_I}' => $data['detail_i'],
        '{DATE_ORDER}' => $data['date_order'],
        '{CUSTOMER_NAME}' => $data['customers_name'],
        '{CUSTOMER_EMAIL}' => $data['customers_email'],
        '{CUSTOMER_PHONE}' => $data['customers_phone'],
        '{ORDER_COMMENT}' => $data['order_comments'],
        '{PRODUCTS}' => $data['products'],
        '{ORDER_TOTALS}' => $data['order_totals'],
        '{BILLING_ADDRESS}' => $data['billing_address'],
        '{SHIPPING_ADDRESS}' => $data['shipping_address'],
        '{PAYMENT_METHOD}' => $data['payment_method'],
    ];

    return renderBaseTemplate($languageId, 'create_order', $customFields);
}

/**
 * @param int   $languageId
 * @param array $data
 *
 * @return array
 */
function getCreateAdminMemberText($languageId, $data)
{
    $customFields = [
        '{CUSTOMER_NAME}' => $data['customers_name'],
        '{CUSTOMER_LOGIN}' => $data['email_address'],
        '{CUSTOMER_PASSWORD}' => $data['password'],
        '{SITE}' => HTTP_SERVER . DIR_WS_ADMIN,
        '{STORE_OWNER}' => STORE_OWNER,
    ];

    return renderBaseTemplate($languageId, 'create_admin_member', $customFields);
}

function getAdminPasswordForgottenText($languageId, $data)
{
    $customFields = [
        '{CUSTOMER_NAME}' => $data['customers_name'],
        '{CUSTOMER_LOGIN}' => $data['email_address'],
        '{CUSTOMER_PASSWORD}' => $data['password'],
        '{SITE}' => HTTP_SERVER . DIR_WS_ADMIN,
        '{STORE_OWNER}' => STORE_OWNER,
        '{CUSTOMER_IP}' => $data['remote_addr'],
        '{DATE_TIME}' => $data['date_time'],
        '{TOKEN}' => $data['token'],
    ];

    return renderBaseTemplate($languageId, 'admin_password_forgotten', $customFields);
}

/**
 * @param int $languageId
 * @param array $data
 *
 * @return array
 */
function getSubscribeNewText(int $languageId, array $data): array
{
    //send only subscription discount
    if (!empty($data) && $data['customers_discount'] !== '' && $data['customers_coupon'] === '') {
        $customFields = [
            '{EMAIL_ADDRESS}' => $data['email_address'],
            '{CUSTOMERS_DISCOUNT}' => $data['customers_discount'],
        ];

        return renderBaseTemplate($languageId, 'subscribe_new_discount', $customFields);
    }

    //send only subscription coupon
    if (!empty($data) && $data['customers_discount'] === '' && $data['customers_coupon'] !== '') {
        $customFields = [
            '{CUSTOMERS_COUPON}' => $data['customers_coupon'],
            '{EMAIL_ADDRESS}' => $data['email_address'],
        ];

        return renderBaseTemplate($languageId, 'subscribe_new_coupon', $customFields);
    }

    //send subscription discount and coupon
    if (!empty($data) && $data['customers_coupon'] !== '' && $data['customers_discount'] !== '') {
        $customFields = [
            '{CUSTOMERS_COUPON}' => $data['customers_coupon'],
            '{EMAIL_ADDRESS}' => $data['email_address'],
            '{CUSTOMERS_DISCOUNT}' => $data['customers_discount'],
        ];

        return renderBaseTemplate($languageId, 'subscribe_new_discount_coupon', $customFields);
    }
     // send subscription only
    if (!empty($data)) {
        $customFields = [
            '{EMAIL_ADDRESS}' => $data['email_address'],
        ];
    }

    return renderBaseTemplate($languageId, 'subscribe_new', $customFields);

}
function getLimitReachedText(int $languageId, array $data, string $rent_package){
    $customFields = [
        '{CURRENT_LIMIT}' => $data['current_limit'],
        '{COUNT_PRODUCTS}' => $data['count_products'],
        '{LINK_TO_SUBSCRIPTION}' => $data['link_to_subscription'],
    ];

    return renderBaseTemplate($languageId, 'limit_reached_'.$rent_package, $customFields);
}