<?php

require('includes/application_top.php');
// require('includes/functions/newsdesk_general.php');
$reviewsSql = "SELECT r.customers_name, r.products_id, r.reviews_rating, r.date_added, rd.reviews_text 
                             FROM reviews r 
                             INNER JOIN reviews_description rd ON r.reviews_id = rd.reviews_id and rd.languages_id = '{$languages_id}'
                             LEFT JOIN products p ON p.products_id = r.products_id
                             WHERE p.products_status = 1
                             ORDER BY r.reviews_id DESC";
$query = tep_db_query($reviewsSql);
$reviews = [];
while ($review = tep_db_fetch_array($query)) {
    $review['link'] = tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $review['products_id']) . '#reviews';
    $reviews[] = $review;
}
$breadcrumb->add(MAIN_REVIEWS_ALL);
$content = 'allcomments';
require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);
require(DIR_WS_INCLUDES . 'application_bottom.php');
