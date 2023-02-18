<?php

require('includes/application_top.php');

includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CREATE_ACCOUNT_SUCCESS);

$breadcrumb->add(NAVBAR_TITLE_1);
$breadcrumb->add(NAVBAR_TITLE_2);

//TotalB2B start
/* tep_session_register('customer_id');
 tep_session_register('customer_default_address_id');
 tep_session_register('customer_first_name');
 tep_session_register('customer_last_name');
 tep_session_register('customer_country_id');
 tep_session_register('customer_zone_id');
 tep_session_register('comments');   */
//  $cart->reset();
//TotalB2B end

$origin_href = tep_href_link(FILENAME_DEFAULT);


$content = CONTENT_CREATE_ACCOUNT_SUCCESS;

require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

require(DIR_WS_INCLUDES . 'application_bottom.php');
