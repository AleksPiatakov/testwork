<?php

require('includes/application_top.php');

if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    if ($_GET['q']) {
        $_GET['q'] = tep_db_input($_GET['q']);
        $name = explode(' ', $_GET['q']);

        $query_name = $query_model = $queryArticle = $queryProducts = $queryProductsDefault = [];
        foreach ($name as $n) {
            $query_name[] = 'LOWER(pd.products_name) LIKE "%' . mb_strtolower($n) . '%"';
            $query_model[] = 'LOWER(p.products_model) LIKE "%' . mb_strtolower($n) . '%"';
            $queryArticle[] = 'LOWER(pa_article) LIKE "%' . mb_strtolower($n) . '%"';
            $queryProductsDefault[] = 'LOWER(p.products_id) LIKE "%' . mb_strtolower($n) . '%"';
        }

        $queryArticle = implode(' AND ', $queryArticle);
        $queryArticle = tep_db_query("SELECT products_id FROM " . TABLE_PRODUCTS_ATTRIBUTES . " WHERE " . $queryArticle);
        while ($row = tep_db_fetch_array($queryArticle)) {
            $queryProducts[] = 'LOWER(p.products_id) LIKE "%' . mb_strtolower($row['products_id']) . '%"';
        }

        $query_name = implode(' AND ', $query_name);
        $query_model = implode(' AND ', $query_model);
        $queryProducts = $queryProducts ?: $queryProductsDefault;
        $queryProducts = implode(' AND ', $queryProducts);
        $time = microtime(true);

        $current_cat_list = $cat_list[$current_category_id];
        $current_cat_list[] = $current_category_id;
        $current_cat_list_with_cat_as_keys = array_flip($current_cat_list);


        $all_search_cats = implode(',', $current_cat_list_with_cat_as_keys);
        $where_subcategories = " p2c.categories_id in(" . $all_search_cats . ") AND";

        $sql = "SELECT pd.products_id
            FROM products_description pd
            inner JOIN products_to_categories p2c on p2c.products_id=pd.products_id
            LEFT JOIN products p ON pd.products_id = p.products_id
            WHERE ((" . $query_name . ") or (" . $query_model . ") or (" . $queryProducts . "))
			AND " . $where_subcategories . " p.products_status=1 and pd.language_id = '{$languages_id}' ";

        $milliseconds = round(microtime(true) * 1000);
        $query = tep_db_query($sql);
        $response = [];
        $response['body'] = [];
        $response['not_found'] = SEARCH_AUTOCOMPLETE_NOT_FOUND;
        if ($query->num_rows) {
            $response['not_found'] = null;
            $ids = [];
            $response['count'] = $query->num_rows;
            while ($row = tep_db_fetch_array($query)) {
                $ids[] = $row['products_id'];
            }
            $ids = implode(',', $ids);

            $spec_array = get_specials(" p.products_id in(" . $ids . ") ");

            $search_query = tep_db_query('SELECT p.products_id, 
                                                 pd.products_name, 
                                                 p.products_model, 
                                                 p.products_image, 
                                                 p.products_tax_class_id,
                                                 p.manufacturers_id, 
                                                 p.products_price
                                                 FROM products p, products_description pd 
                                                 WHERE p.products_id in(' . $ids . ') and pd.products_id=p.products_id and pd.language_id = ' . $languages_id . ' and ' . time() . '
                                           ORDER BY p.products_quantity > 0 desc');

            $salemakers_array = get_salemakers($search_query);
            mysqli_data_seek($search_query, 0);

            while ($search_product = tep_db_fetch_array($search_query)) {
                $search_id = $search_product['products_id'];
                $search_name = $search_product['products_name'];
                $search_model = $search_product['products_model'];

                if ($spec_array[$search_product['products_id']]) {
                    $spec_price = $spec_array[$search_product['products_id']];
                } elseif ($salemakers_array[$search_product['products_id']]) {
                    $spec_price = $salemakers_array[$search_product['products_id']];
                } else {
                    $spec_price = $search_product['products_price'];
                }

                $old_price = $currencies->display_price(
                    $spec_price,
                    tep_get_tax_rate($search_product['products_tax_class_id'])
                );

                // PRICES with discounts
                if ($spec_price = tep_get_products_special_price($search_product['products_id'])) {
                    $new_price = $currencies->display_price(
                        $spec_price,
                        tep_get_tax_rate($search_product['products_tax_class_id'])
                    );
                } else {
                    $new_price = '';
                }

                $search_price = $new_price ?: $old_price;
                $search_category = $cat_names[$prodToCat[$search_product['products_id']]];

                // image
                $search_image = explode(';', $search_product['products_image']);
                if (empty($search_image[0])) {
                    $search_image[0] = 'default.png';
                }
                $search_image_filename = 'getimage/80x80/products/' . $search_image[0];
                // end image
                //    print $search_name.'|'.$search_category.'|'.$search_image_filename.'|'.$search_id.'|'.$search_price."\n";
                //      print '<span class="search__name">'.$search_name.'</span> ('.$search_model.')|'.$search_category.'|'.$search_image_filename.'|'.$search_id.'|'.$search_price."\n";
                $response['body'][] = $search_name . ' (' . $search_model . ')|' . $search_category . '|' . $search_image_filename . '|' . $search_id . '|' . $search_price . "\n";
            }
        }
        //print round(microtime(true) * 1000)-$milliseconds;
        //echo $query_total_time;
        echo json_encode($response);
    }
}
require(DIR_WS_INCLUDES . 'application_bottom.php');
