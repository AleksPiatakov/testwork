<?php 
    // Solomono jQuery Autocomplete module for osCommerce. 2017

    // go to catalog folder level
    chdir('../../');
    $rootPath = dirname(dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME']))));
    include('includes/application_top.php');
    

    // if this is ajax query
    if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {

        $response = [];
        $response['body'] = [];

        if ($_GET['q']) {
            $result = array();

            require(DIR_WS_CLASSES . 'currencies.php');
            $currencies = new currencies();

            // main search sql query
            $search_query = tep_db_query('SELECT DISTINCT pd.products_id, pd.products_name, p.products_image, p.products_tax_class_id, p.products_price, p.products_model 
    																FROM products p LEFT JOIN products_description pd ON pd.products_id=p.products_id 
    																WHERE (LOWER(pd.products_name) LIKE "%' . mb_strtolower($_GET['q']) . '%" or LOWER(p.products_model) LIKE "%' . mb_strtolower($_GET['q']) . '%")    
    																AND (p.products_status=1) and pd.language_id = ' . $languages_id . '
    																ORDER BY p.products_quantity desc
                                    LIMIT 10;');

            // store received data to array
            while ($search_product = tep_db_fetch_array($search_query)) {
                $search_id = $search_product['products_id'];
                $search_name = $search_product['products_name'];
                $search_model = $search_product['products_model'];
                $spec_price = $search_product['products_price'];

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
                $search_image_filename = '../getimage/products/' . $search_image[0];

                $response['body'][] = $search_name . ' (' . $search_model . ')|' . $search_category . '|' . $search_image_filename . '|' . $search_id . '|' . $search_price . "\n";
            }
        }
        echo json_encode($response);
    }
    require(DIR_WS_INCLUDES . 'application_bottom.php');
?>