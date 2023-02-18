<?php
$reviews = [];
if ( !empty($activeProducts)) {
    $new_products_ids_str = implode(',', array_keys($activeProducts));
    $reviewsSql = "SELECT r.customers_name, r.products_id, r.reviews_rating, r.date_added, rd.reviews_text, pd.products_url
                             FROM reviews r
                             INNER JOIN reviews_description rd ON r.reviews_id = rd.reviews_id and rd.languages_id = '{$languages_id}'
                             LEFT JOIN products p ON p.products_id = r.products_id
                             LEFT JOIN products_description pd ON r.products_id = pd.products_id and pd.language_id = '{$languages_id}'
                             WHERE p.products_status = 1 and p.products_id in ($new_products_ids_str)
                             ORDER BY r.reviews_id DESC
                             LIMIT 5";
    $query = tep_db_query($reviewsSql);
    $productIdPrefix = getConstantValue('SEO_ADD_SLASH_BEFORE_PRODUCT_ID', 'true') == 'true' ? '/p-' : '-p-';
    while ($review = tep_db_fetch_array($query)) {
        if ($promUrls) {
            $review['link'] = tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $review['products_id']);
        }else {
            $review['link'] = tep_href_link(FILENAME_DEFAULT) . $review['products_url'] . $productIdPrefix . $review['products_id'] . '.html';
        }
        $reviews[] = $review;
    }
}
