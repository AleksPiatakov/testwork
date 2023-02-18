<?php

if(isset($_GET['page']) && $_GET['page'] && $_GET['page'] != '' && !is_numeric($_GET['page'])){
    header("Location: account_history.php");
    die;
}
require('includes/application_top.php');

if (!tep_session_is_registered('customer_id')) {
    // $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
}

includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_HISTORY);
includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT);

$breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
$breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));

$content = CONTENT_ACCOUNT_HISTORY;
$javascript = 'popup_window.js';
require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

require(DIR_WS_INCLUDES . 'application_bottom.php');
