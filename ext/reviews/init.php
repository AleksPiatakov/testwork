<?php

// 10/23/2020
includeLanguages(DIR_WS_LANGUAGES . $language . '/' . 'reviews.json');
$reviews = new reviews();
$reviews->setAjaxPath('/ext/reviews/ajaxReviews.php');
$reviews->renderScripts();
$reviews->setReviewsType(1); // 1 - products
//$reviews->setLanguageId($languages_id);
if ($customer_id) {
    $reviews->setCustomerData($customer_first_name, $customer_id);
}
if (TEMPLATE_NAME === 'solo_home') {
    $reviews->setDrawAnswer(false);
}
$reviews->setProductId($_GET['products_id']);
$reviews->printReviews();
