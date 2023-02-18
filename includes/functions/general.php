<?php
/*
  $Id: general.php,v 1.1.1.1 2003/09/18 19:05:10 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

include ('array_column.php');

// get all products IDs from current category
function get_all_pids($where_filters = '', $listing_sql)
{
    $cleared_listing_sql = str_replace($where_filters, '', $listing_sql); // clear temporary filter subqueries

    $parse_froms = explode('from', strtolower($cleared_listing_sql));
    $parse_listing_from = explode('order by', $parse_froms[count($parse_froms) - 1]);
    $parse_froms[count($parse_froms) - 1] = $parse_listing_from[0];
    unset($parse_froms[0]);
    $parse_froms_str = implode('from', $parse_froms);

    $new_listing = "select p.products_id from " . $parse_froms_str;
    $all_pids = [];
    $find_pids_query = tep_db_query($new_listing);
    while ($find_pids = tep_db_fetch_array($find_pids_query)) {
        $all_pids[] = $find_pids['products_id'];
    }

    return $all_pids;
}

function STORE_SCRIPTS()
{
    return htmlspecialchars_decode(stripslashes(checkConst('STORE_SCRIPTS')));
}

function STORE_METAS()
{
    return htmlspecialchars_decode(stripslashes(checkConst('STORE_METAS')));
}

function tep_get_query_products_info($listing_sql, $additional_fields = array())
{
    global $languages_id, $customer_price, $listing_add_fields, $spec_array, $all_pids;

    $module_products_first = tep_db_query($listing_sql);
    $all_pids = [];
    while ($raw_listing = tep_db_fetch_array($module_products_first)) {
        $all_pids[] = $raw_listing['products_id'];
    }

    if (is_array($all_pids) and !empty($all_pids)) {
        $products_id_str = implode(',', $all_pids);

        $tempSpecArray = get_specials(" p.products_id in(" . tep_db_prepare_input($products_id_str) . ") ");
        if (!is_array($spec_array)) {
            $spec_array = $tempSpecArray;
        } else {
            $spec_array += $tempSpecArray;
        }

        return  "SELECT p.products_id, 
                       p.products_image, 
                       p.products_quantity, 
                       p.products_model, 
                       p.lable_1, 
                       p.lable_2, 
                       p.lable_3,
                       p.manufacturers_id, 
                       CASE WHEN p." . $customer_price . " IS NULL THEN p.products_price ELSE p." . $customer_price . " END as products_price,
                       p.products_tax_class_id, 
                       pd.products_url, 
                       " . $listing_add_fields . "
                       pd.products_name
                  FROM " . TABLE_PRODUCTS . " p,                                     
                       " . TABLE_PRODUCTS_DESCRIPTION . " pd
                 WHERE p.products_id = pd.products_id 
                   AND pd.language_id = " . (int)$languages_id . "
                   AND p.products_id in(" . tep_db_prepare_input($products_id_str) . ")
              ORDER BY FIELD(p.products_id," . $products_id_str . ")";
    } else {
        $all_pids = 0;
        return  "SELECT p.products_id FROM " . TABLE_PRODUCTS . " p WHERE 1 = 2";
    }
}

function tep_get_all_pids_price_exclude($listing_sql, $excluded_statement)
{
    $cleared_listing_sql = str_replace($excluded_statement, '', $listing_sql);

    $module_products_first = tep_db_query($cleared_listing_sql);
    $all_pids = [];
    while ($raw_listing = tep_db_fetch_array($module_products_first)) {
        $all_pids[] = $raw_listing['products_id'];
    }
    return $all_pids;
}

/**
 * get count of comments
 */
function tep_get_count_comments()
{
    return tep_db_fetch_array(tep_db_query("SELECT COUNT(*) as count from " . TABLE_REVIEWS))['count'];
}

/**
 * get last comments
 */
function tep_get_last_comments($limit = 20)
{
    global $languages_id;
    $comments_query = tep_db_query(
        "SELECT
    r.reviews_id as id,
    r.customers_name as name,
    r.products_id as pid,
    pd.products_name as products_name,
    r.reviews_rating as rating,
    rd.reviews_text as text,
    r.date_added as date
    FROM " . TABLE_REVIEWS . " r
    LEFT JOIN " . TABLE_REVIEWS_DESCRIPTION . " rd ON r.reviews_id = rd.reviews_id
    LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd ON r.products_id = pd.products_id AND pd.language_id = " . (int)$languages_id . "
    ORDER BY date desc
    LIMIT " . $limit
    );
    $comments = array();
    while ($comment = tep_db_fetch_array($comments_query)) {
        $comment['event_type'] = 'comment';
        $comments[] = $comment;
    }

    return $comments;
}

/**
 * @param int $id
 * @param array $fields
 * @return string|string[]|null
 */
function renderArticle($id, $fields = [])
{
    global $languages_id;

    $fieldsMap = [
        'image' => 'a.articles_image',
        'name'  => 'ad.articles_name',
        'url'   => 'ad.articles_url',
    ];

    $queryFields = [];
    foreach ($fields as $field) {
        if (isset($fieldsMap[$field])) {
            $queryFields[] = $fieldsMap[$field];
        }
    }

    $queryFieldsList = $queryFields ? ", " . implode(", ", $queryFields) : "";

    $art_query = tep_db_query("
        select ad.articles_description 
             " . $queryFieldsList . " 
        from " . TABLE_ARTICLES . " a
           , " . TABLE_ARTICLES_DESCRIPTION . " ad 
        where a.articles_status = '1' 
          and (a.articles_id = " . (int)$id . " or a.articles_code = '" . tep_db_prepare_input($id) . "') 
          and ad.articles_id = a.articles_id 
          and ad.language_id = " . (int)$languages_id);

    $art_info = tep_db_fetch_array($art_query);

    $art_info['articles_description'] = stripcslashes($art_info['articles_description']);

    if (strstr($art_info['articles_description'], '<img')) {
        $html     = str_get_html($art_info['articles_description']);
        $data_src = "data-src";
        if (!empty($html)) {
            $html_img = $html->find('img');
            foreach ($html_img as &$img) {
                $img->$data_src = $img->src;
                $img->src       = DIR_WS_IMAGES_CDN . 'pixel_trans.png';
            }
            $art_info['articles_description'] = (string)$html;
        }
    }

    if ($fields) {
        return $art_info;
    } else {
        return $art_info['articles_description'];
    }
}

// show Articles list / by raid
function getArticles($topic_id, $limit = 5, $desc = false, $img = false)
{
    global $languages_id;
    $articles_topic = $topic_id; //topic ID

    $catalog_path = tep_href_link();

    if ($desc == true) {
        $desc_str = ' , ad.articles_description ';
    }
    if ($img == true) {
        $img_str = ' , a.articles_image , a.articles_image_mobile ';
    }
    if (is_array($topic_id)) {
        $topic_str = " and a2t.topics_id in (" . tep_db_prepare_input(implode(',', $articles_topic)) . ") ";
    } else {
        $topic_str = " and a2t.topics_id=" . (int)$articles_topic . " ";
    }
    $query_art = "select ad.articles_url, a.articles_link, ad.articles_id, articles_date_added, ad.articles_name, articles_code " . $desc_str . " " . $img_str . "
                from " . TABLE_ARTICLES_DESCRIPTION . " ad, " . TABLE_ARTICLES . " a, " . TABLE_ARTICLES_TO_TOPICS . " a2t 
                where a.articles_id=ad.articles_id 
                and a.articles_id=a2t.articles_id 
                $topic_str 
                and a.articles_status='1'
                and ad.language_id=" . (int)$languages_id . "
                order by a.sort_order, a.articles_id DESC LIMIT " . $limit;

    $query_art_info = tep_db_query($query_art);
    $all_articles_string = '';

    while ($row1 = tep_db_fetch_array($query_art_info)) {
        if (!empty($row1['articles_link'])) {
            if (strpos($row1['articles_link'], "http://") !== false or strpos($row1['articles_link'], "https://") !== false) {
                $link = $row1['articles_link'];
            } else {
                $link = preg_replace('~/{2,}~', '/', $catalog_path . $row1['articles_link']);
            }
        } elseif ($row1['articles_url']) {
            if (defined('PROM_URLS') && constant('PROM_URLS')) {
                $link = tep_href_link('a' . $row1['articles_id'] . '-' . $row1['articles_url'] . '.html');
            } else {
                $link = tep_href_link($row1['articles_url'] . '/a-' . $row1['articles_id'] . '.html');
            }
        } else {
            $link = tep_href_link(FILENAME_ARTICLE_INFO, 'articles_id=' . $row1['articles_id']);
        }

        $art_array[] = array(
            'id' => $row1['articles_id'],
            'name' => $row1['articles_name'],
            'desc' => stripcslashes($row1['articles_description']),
            'image' => !isMobile() ? $row1['articles_image'] : (($row1['articles_image_mobile']) ? $row1['articles_image_mobile'] : $row1['articles_image']),
            'date' => $row1['articles_date_added'],
            'code' => $row1['articles_code'],
            'direct_link' => $row1['articles_link'],
            'link' => $link //$row1['articles_link']

        );
    }
    return $art_array;
}

function getArticleUrlByCode($code)
{
    global $languages_id;
    $catalog_path = tep_href_link();

    $query = "
        select ad.articles_url, a.articles_link, ad.articles_id, articles_code 
        from " . TABLE_ARTICLES_DESCRIPTION . " ad, " . TABLE_ARTICLES . " a
        where a.articles_id = ad.articles_id 
            and articles_code = '" . $code . "'
            and a.articles_status='1'
            and ad.language_id=" . $languages_id . "
        order by a.sort_order, a.articles_id DESC LIMIT 1";
    $query = tep_db_query($query);
    $link = '#';

    if (tep_db_num_rows($query) == 1) {
        $query = tep_db_fetch_array($query);
        if (!empty($query['articles_link'])) {
            if (strpos($query['articles_link'], "http://") !== false or strpos($query['articles_link'], "https://") !== false) {
                $link = $query['articles_link'];
            } else {
                $link = preg_replace('~/{2,}~', '/', $catalog_path . $query['articles_link']);
            }
        } elseif ($query['articles_url']) {
            if (defined('PROM_URLS') && constant('PROM_URLS')) {
                $link = tep_href_link('a' . $query['articles_id'] . '-' . $query['articles_url'] . '.html');
            } else {
                $link = tep_href_link($query['articles_url'] . '/a-' . $query['articles_id'] . '.html');
            }
        } else {
            $link = tep_href_link(FILENAME_ARTICLE_INFO, 'articles_id=' . $query['articles_id']);
        }
    }

    return $link;
}

////
// Stop from parsing any further PHP code
function tep_exit()
{
    tep_session_close();
    exit();
}

/*
*   Show array of product attributes
*   @pid - Product_id
*   @fields - list of attributes array(1,2,3)
*/
function get_products_attributes($pid, $fields = array())
{
    global $languages_id;
    $result = array();
    if (count($fields) > 0) {
        $fields_where = ' (';
        foreach ($fields as $id) {
            $fields_where .= 'pa.options_id = ' . (int)$id . ' or ';
        }
        $fields_where = substr($fields_where, 0, -3);
        $fields_where .= ') and ';
    }

    $products_options_query = tep_db_query("select
      pov.products_options_values_id, 
      pov.products_options_values_name, 
      pa.pa_qty,
      popt.products_options_name
      from
      " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov 
      where " . $fields_where . "
			    pa.products_id = " . (int)$pid . "
      and pa.options_id = popt.products_options_id 
      and pa.options_values_id = pov.products_options_values_id 
      and pov.language_id = " . (int)$languages_id . "
      and popt.language_id = " . (int)$languages_id . "
      order by pa.products_options_sort_order");

    while ($products_options = tep_db_fetch_array($products_options_query)) {
        $result[$pid][$products_options['products_options_name']][] = array(
            'id' => $products_options['products_options_values_id'],
            'text' => $products_options['products_options_values_name'],
            'qty' => $products_options['pa_qty']
        );
    }

    if (count($result)) {
        return $result;
    } else {
        return false;
    }
}

// Redirect to another page or site
function tep_redirect($url)
{
    global $_GET, $PHP_SELF, $_RESULT;
    if (strpos(basename($PHP_SELF), 'ajax_shopping_cart.php') !== false) {
        if ($url == tep_href_link(FILENAME_SSL_CHECK) || $url == tep_href_link(FILENAME_LOGIN) || $url == tep_href_link(FILENAME_COOKIE_USAGE) || ($_GET['action'] === 'buy_now' && tep_has_product_attributes($_GET['products_id']))) {
            $_RESULT['ajax_redirect'] = $url;
            tep_exit();
        }
        return;
    }
    // AJAX Addto shopping_cart - End

    if ((strstr($url, "\n") != false) || (strstr($url, "\r") != false)) {
        tep_redirect(tep_href_link('/', '', 'NONSSL', false));
    }

    /*    if ((ENABLE_SSL==true) && (getenv('HTTPS')=='on')) { // We are loading an SSL page
            if (substr($url, 0, strlen(HTTP_SERVER))==HTTP_SERVER) { // NONSSL url
                $url=HTTPS_SERVER . substr($url, strlen(HTTP_SERVER)); // Change it to SSL
            }
        }*/

    header('Location: ' . $url);

    tep_exit();
}

// -------------merge two arrays and remove duplicates
function array_merge_recursive_unique($array1, $array2)
{
    if (empty($array1)) {
        return $array2; //optimize the base case
    }

    foreach ($array2 as $key => $value) {
        if (is_array($value) && is_array(@$array1[$key])) {
            $value = array_merge_recursive_unique($array1[$key], $value);
        }
        $array1[$key] = $value;
    }
    return $array1;
}

// ---------------------------------------------------------

////
// Parse the data used in the html tags to ensure the tags will not break
function tep_parse_input_field_data($data, $parse)
{
    if (is_array($data)) {
        $data = array_shift($data);
    }
    return strtr(trim($data), $parse);
}

function tep_output_string($string, $translate = false, $protected = false)
{
    if ($protected == true) {
        return htmlspecialchars($string, ENT_QUOTES, 'windows-1251');
    } else {
        if ($translate == false) {
            return tep_parse_input_field_data($string, array('"' => '&quot;'));
        } else {
            return tep_parse_input_field_data($string, $translate);
        }
    }
}

function tep_output_string_protected($string)
{
    return tep_output_string($string, false, true);
}

function tep_sanitize_string($string)
{
    return tep_db_sanitize_string($string);
}

////
// Return a random row from a database query
function tep_random_select($query)
{
    $random_product = '';
    $random_query = tep_db_query($query);
    $num_rows = tep_db_num_rows($random_query);
    if ($num_rows > 0) {
        $random_row = tep_rand(0, ($num_rows - 1));
        tep_db_data_seek($random_query, $random_row);
        $random_product = tep_db_fetch_array($random_query);
    }

    return $random_product;
}

////
// Return a product's name
// TABLES: products
function tep_get_products_name($product_id, $language = '')
{
    global $languages_id;

    if (empty($language)) {
        $language = $languages_id;
    }

    $product_query = tep_db_query("select products_name from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = " . (int)$product_id . " and language_id = " . (int)$language);
    $product = tep_db_fetch_array($product_query);

    return $product['products_name'];
}

////
// Return a product's special price (returns nothing if there is no offer)
// TABLES: products
function tep_get_customers_groups_id()
{
    global $customer_id;
    $customers_groups_query = tep_db_query("select customers_groups_id from " . TABLE_CUSTOMERS . " where customers_id =  " . (int)$customer_id);
    $customers_groups_id = tep_db_fetch_array($customers_groups_query);
    return $customers_groups_id['customers_groups_id'];
}


function tep_get_products_special_price($product_id)
{
    global $customer_price;
    global $customer_id;
    $special_price = false;
    $product_query = tep_db_query("select CASE WHEN " . $customer_price . " IS NULL THEN products_price ELSE " . $customer_price . " END as products_price, products_model
    from " . TABLE_PRODUCTS . " 
    where products_id = " . (int)$product_id);
    if (tep_db_num_rows($product_query)) {
        $product = tep_db_fetch_array($product_query);
        $product_price = $product['products_price'];
        // BOF FlyOpenair: Extra Product Price
        $product_price = extra_product_price($product_price);
        // EOF FlyOpenair: Extra Product Price
    } else {
        return $special_price;
    }

    // Search discounts for registered users
    $customers_groups_id = tep_get_customers_groups_id();
    if (
        file_exists(DIR_FS_EXT . 'specials')
        && getConstantValue('SPECIALS_MODULE_ENABLED') == 'true'
    ) {
        $specials_sql = "
            select s.specials_new_products_price from " . TABLE_SPECIALS . " s ".
            (getConstantValue('QTY_PRO_ENABLED') == 'true' ?"LEFT JOIN " . TABLE_PRODUCTS_STOCK . " ps on ps.products_id = s.products_id ":"").
            "where s.products_id = '" . $product_id . "' ".
                (getConstantValue('QTY_PRO_ENABLED') == 'true' ?" and
            (
                (
                    (s.attribute_combination = 'all' or s.attribute_combination = '')
                    and not exists (
                         select 1
                         from " . TABLE_PRODUCTS_STOCK . " ps2
                         where ps2.products_id = s.products_id
                    )
                )
                or (s.attribute_combination != '' and s.attribute_combination = ps.products_stock_attributes)
            ) ":"").
            "and s.status = '1'
            and (s.start_date <= CURDATE() or s.start_date = '0000-00-00 00:00:00' or s.start_date is NULL)
            and (s.expires_date > CURDATE() or s.expires_date = '0000-00-00 00:00:00' or s.expires_date is NULL)";
        // If there is a group look for discounts also for the group
        if (!empty($customers_groups_id)) {
            $specials_sql .= " and ( (customers_id = " . (int)$customer_id . " or customers_groups_id = " . (int)$customers_groups_id . ")
                 or (customers_id = 0 and customers_groups_id = 0) )";
        } else {
            if (!empty($customer_id)) {
                $specials_sql .= " and ( (customers_id = " . (int)$customer_id . ") 
                or (customers_id = 0 and customers_groups_id = 0) )";
            }
            $specials_sql .= " and customers_id = 0 and customers_groups_id = 0";
        }
        // If there is a discount for this user, use it (priority over group)
        $specials_sql .= " order by customers_id desc, customers_groups_id desc, specials_new_products_price asc limit 1";

        $specials_query = tep_db_query($specials_sql);
        if (tep_db_num_rows($specials_query)) {
            $special = tep_db_fetch_array($specials_query);
            $special_price = $special['specials_new_products_price'];
            // BOF FlyOpenair: Extra Product Price
            $special_price = extra_product_price($special_price);
            // EOF FlyOpenair: Extra Product Price
        }
    }

    $special_price = !$special_price ? $product_price : $special_price;

    //Never apply a salededuction to Ian Wilson's Giftvouchers
    if (substr($product['products_model'], 0, 4) == 'GIFT') {
        return $special_price;
    }

    $product_to_categories_query = tep_db_query("
        select p2c.categories_id, p.manufacturers_id 
        from " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c 
            LEFT JOIN products p ON p2c.products_id = p.products_id 
        where p2c.products_id = " . (int)$product_id);
    while ($product_to_categories = tep_db_fetch_array($product_to_categories_query)) {
        $s_category_array[] = $product_to_categories['categories_id'];
        $manufacturer = $product_to_categories['manufacturers_id'];
    }

    if (
        file_exists(DIR_WS_EXT . 'salemaker') &&
        getConstantValue('SALEMAKER_MODULE_ENABLED') == 'true'
    ) {
        $sale_query = tep_db_query("
            select 
                sale_specials_condition, 
                sale_deduction_value, 
                sale_deduction_type, 
                sale_categories_all, 
                sale_manufacturers_selected 
            from 
                " . TABLE_SALEMAKER_SALES . " 
            where 
                sale_status = '1' and 
                (sale_date_start <= now() or sale_date_start = '0000-00-00' or sale_date_start is NULL) and 
                (sale_date_end >= now() or sale_date_end = '0000-00-00' or sale_date_end is NULL) and 
                (sale_pricerange_from <= '" . tep_db_prepare_input($product_price) . "' or sale_pricerange_from = '0') and 
                (sale_pricerange_to >= '" . tep_db_prepare_input($product_price) . "' or sale_pricerange_to = '0')");
        if (tep_db_num_rows($sale_query)) {
            while ($row = tep_db_fetch_array($sale_query)) {
                foreach (explode(',', $row['sale_categories_all']) as $cid) {
                    if (in_array($cid, $s_category_array)) {
                        $sale = $row;
                    }
                }

                $sale_manufacturers = explode(',', $row['sale_manufacturers_selected']);
                if ($manufacturer) {
                    if (
                        array_filter($sale_manufacturers, function ($mId) use ($manufacturer) {
                            return $mId == $manufacturer;
                        })
                    ) {
                        $sale = $row;
                    }
                }
            }
            if (empty($sale)) {
                return $special_price;
            }
        } else {
            return $special_price;
        }
    } else {
        return $special_price;
    }

    if (!$special_price) {
        $tmp_special_price = $product_price;
    } else {
        $tmp_special_price = $special_price;
    }

    switch ($sale['sale_deduction_type']) {
        case 0:
            $sale_product_price = $product_price - $sale['sale_deduction_value'];
            $sale_special_price = $tmp_special_price - $sale['sale_deduction_value'];
            break;
        case 1:
            $sale_product_price = $product_price - (($product_price * $sale['sale_deduction_value']) / 100);
            $sale_special_price = $tmp_special_price - (($tmp_special_price * $sale['sale_deduction_value']) / 100);
            // BOF FlyOpenair: Extra Product Price
            $sale_special_price = extra_product_price($sale_special_price);
            // EOF FlyOpenair: Extra Product Price
            break;
        case 2:
            $sale_product_price = $sale['sale_deduction_value'];
            $sale_special_price = $sale['sale_deduction_value'];
            break;
        default:
            return $special_price;
    }

    if ($sale_product_price < 0) {
        $sale_product_price = 0;
    }

    if ($sale_special_price < 0) {
        $sale_special_price = 0;
    }

    if (!$special_price) {
        return number_format($sale_product_price, 4, '.', '');
    } else {
        switch ($sale['sale_specials_condition']) {
            case 0:
                return number_format($sale_product_price, 4, '.', '');
                break;
            case 1:
                return number_format($special_price, 4, '.', '');
                break;
            case 2:
                return number_format($sale_special_price, 4, '.', '');
                break;
            default:
                return number_format($special_price, 4, '.', '');
        }
    }
}

function tep_get_products_special_price_data($product_id)
{
    global $customer_id;
    $customers_groups_id = tep_get_customers_groups_id();
    $specials_sql = "select display_countdown, expires_date from " . TABLE_SPECIALS . " where products_id = " . (int)$product_id . " and status = '1' 
    and (start_date <= CURDATE() or start_date = '0000-00-00 00:00:00' or start_date is NULL)
    and (expires_date > CURDATE() or expires_date = '0000-00-00 00:00:00' or expires_date is NULL)";

    // If there is a group look for discounts also for the group
    if (!empty($customers_groups_id)) {
        $specials_sql .= " and ( (customers_id = " . (int)$customer_id . " or customers_groups_id = " . (int)$customers_groups_id . ")
        or (customers_id = 0 and customers_groups_id = 0) )";
    } else {
        if (!empty($customer_id)) {
            $specials_sql .= " and ( (customers_id = " . (int)$customer_id . ")
        or (customers_id = 0 and customers_groups_id = 0) )";
        }
        $specials_sql .= " and customers_id = 0 and customers_groups_id = 0";
    }

    // If there is a discount for this user, use it (priority over group)
    $specials_sql .= " order by customers_id, customers_groups_id desc limit 1";

    $query = tep_db_query($specials_sql);
    return tep_db_fetch_array($query);
}

function get_specials($all_pids_string)
{
    $spec_array = [];

    if (!file_exists(DIR_WS_EXT . 'specials/admin') || !getConstantValue('SPECIALS_MODULE_ENABLED') == 'true') {
        return $spec_array;
    }
    $customers_groups_id = tep_get_customers_groups_id();
    $customerGroupQuery = !empty($customers_groups_id) ? 'in (0,' . $customers_groups_id . ')' : '= 0';
    if (!empty($all_pids_string)) {
        $specials_query = tep_db_query("
            select p.products_id, p.specials_new_products_price 
            from " . TABLE_SPECIALS . " p 
            where " . $all_pids_string . "
              and p.status = '1' 
              and p.customers_groups_id " . $customerGroupQuery . "
              and (p.start_date <= CURDATE() or p.start_date = '0000-00-00 00:00:00' or p.start_date is NULL)
              and (p.expires_date >= CURDATE() or p.expires_date = '0000-00-00 00:00:00' or p.expires_date is NULL)
        ");
        while ($specials = tep_db_fetch_array($specials_query)) {
            $spec_array[$specials['products_id']] = $specials['specials_new_products_price'];
        }
    }
    return $spec_array;
}

function getTaxRates()
{
    $taxRatesArray = [];
    //get tax_rates with same priority, tax_class_id, zone_country_id, zone_id
    $taxRatesSQL = "select tr.tax_class_id, tr.tax_description, za.zone_country_id, za.zone_id, tr.tax_rate, tr.tax_priority
            from " . TABLE_TAX_RATES . " tr
            left join " . TABLE_ZONES_TO_GEO_ZONES . " za on za.geo_zone_id = tr.tax_zone_id
            order by tr.tax_priority desc, tr.tax_class_id asc, za.zone_country_id desc, za.zone_id desc";
    $taxRatesQuery = tep_db_query($taxRatesSQL);
    if (tep_db_num_rows($taxRatesQuery)) {
        while ($taxRates = tep_db_fetch_array($taxRatesQuery)) {
            if (!empty($taxRates['tax_class_id'])) {
                $taxRates['zone_country_id'] = !empty($taxRates['zone_country_id']) ? $taxRates['zone_country_id'] : 0;
                $taxRates['zone_id'] = !empty($taxRates['zone_id']) ? $taxRates['zone_id'] : 0;
                $taxRatesArray[][$taxRates['tax_class_id']][$taxRates['zone_country_id']][$taxRates['zone_id']] = [
                    'value' => $taxRates['tax_rate'],
                    'text' => $taxRates['tax_description']
                ];
            }
        }
    }

    return $taxRatesArray;
}

//salemaker: get salemaker prices only for products from current page
function get_salemakers($query)
{
    global $r_current_subcats, $spec_array;

    if (!file_exists(DIR_WS_EXT . 'salemaker') || !getConstantValue('SALEMAKER_MODULE_ENABLED') == 'true') {
        return [];
    }
    // find working salemaker
    $salemaker_query = tep_db_query("
        select sale_pricerange_from, sale_pricerange_to, sale_specials_condition, sale_deduction_value, sale_deduction_type, sale_categories_all, sale_manufacturers_selected 
        from " . TABLE_SALEMAKER_SALES . " 
        where sale_status = '1' 
        and (sale_date_start <= now() or sale_date_start = '0000-00-00' or sale_date_start is NULL) 
        and (sale_date_end >= now() or sale_date_end = '0000-00-00' or sale_date_end is NULL) ");
    if (tep_db_num_rows($salemaker_query)) {
        $salemaker_all_results = [];
        $salemaker_all_manufacturers_results = [];
        while ($salemaker_result_while = tep_db_fetch_array($salemaker_query)) {
            if (!empty($salemaker_result_while['sale_categories_all'])) {
                foreach (explode(',', $salemaker_result_while['sale_categories_all']) as $cid) {
                    $salemaker_all_results[$cid] = $salemaker_result_while;
                }
            }

            if (!empty($salemaker_result_while['sale_manufacturers_selected'])) {
                foreach (explode(',', $salemaker_result_while['sale_manufacturers_selected']) as $mid) {
                    $salemaker_all_manufacturers_results[$mid] = $salemaker_result_while;
                }
            }
            $salemaker_all_results = array_merge($salemaker_all_results, $salemaker_all_manufacturers_results);
        }

        // add salemaker to our current listing products:
        $sm_pids = array();
        // loop of each product in current category:
        while ($listing = tep_db_fetch_array($query)) {
            $listing_sm_all[] = $listing;
            $sm_products_array[] = $listing['products_id'];
        }

        $sm_products_array_un = !empty($sm_products_array) ? array_unique($sm_products_array) : false;

        if (is_array($sm_products_array_un)) {
            $sm_category_query = tep_db_query("select categories_id, products_id from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id in (" . tep_db_prepare_input(implode(',', $sm_products_array_un)) . ")");
            if (tep_db_num_rows($sm_category_query)) {
                while ($category = tep_db_fetch_array($sm_category_query)) {
                    $sm_category_array[$category['products_id']][] = $category['categories_id'];
                }
            }

            if (is_array($salemaker_all_results)) {
                foreach ($listing_sm_all as $listing_sm) {
                    // loop for array of ALL salemakers:
                    foreach ($salemaker_all_results as $salemaker_result) {
                        $salemaker_categories = array_filter(explode(',', $salemaker_result['sale_categories_all']));
                        $salemaker_manufacturers = array_filter(explode(',', $salemaker_result['sale_manufacturers_selected']));
                        if (
                            (
                                is_array($salemaker_categories)// and in_array(tep_get_product_cat($listing_sm['products_id']),$salemaker_categories) // check by current category
                                and count(array_unique(array_intersect($sm_category_array[$listing_sm['products_id']], $salemaker_categories))) > 0 // check by current category
                                and ($salemaker_result['sale_pricerange_from'] <= $listing_sm['products_price'] or $salemaker_result['sale_pricerange_from'] == 0)
                                and ($salemaker_result['sale_pricerange_to'] >= $listing_sm['products_price'] or $salemaker_result['sale_pricerange_to'] == 0)
                            )
                            ||
                            (
                                is_array($salemaker_manufacturers) and
                                in_array($listing_sm['manufacturers_id'], $salemaker_manufacturers)
                                and ($salemaker_result['sale_pricerange_from'] <= $listing_sm['products_price'] or $salemaker_result['sale_pricerange_from'] == 0)
                                and ($salemaker_result['sale_pricerange_to'] >= $listing_sm['products_price'] or $salemaker_result['sale_pricerange_to'] == 0)
                            )
                        ) {
                            if (!empty($spec_array[$listing_sm['products_id']])) {
                                $special_price = $spec_array[$listing_sm['products_id']];
                            } else {
                                $special_price = $listing_sm['products_price'];
                            }
                            $tmp_special_price = $special_price;
                            $product_price = $listing_sm['products_price'];

                            switch ($salemaker_result['sale_deduction_type']) {
                                case '0':
                                    $sale_product_price = $product_price - $salemaker_result['sale_deduction_value'];
                                    $sale_special_price = $tmp_special_price - $salemaker_result['sale_deduction_value'];
                                    break;
                                case '1':
                                    $sale_product_price = $product_price - (($product_price * $salemaker_result['sale_deduction_value']) / 100);
                                    $sale_special_price = $tmp_special_price - (($tmp_special_price * $salemaker_result['sale_deduction_value']) / 100);
                                    // BOF FlyOpenair: Extra Product Price
                                    $sale_special_price = extra_product_price($sale_special_price);
                                    // EOF FlyOpenair: Extra Product Price
                                    break;
                                case '2':
                                    $sale_product_price = $salemaker_result['sale_deduction_value'];
                                    $sale_special_price = $salemaker_result['sale_deduction_value'];
                                    break;
                                default:
                                    $return_price = $special_price;
                            }

                            if ($sale_product_price < 0) {
                                $sale_product_price = 0;
                            }

                            if ($sale_special_price < 0) {
                                $sale_special_price = 0;
                            }

                            if (!$special_price) {
                                $return_price = number_format($sale_product_price, 4, '.', '');
                            } else {
                                switch ($salemaker_result['sale_specials_condition']) {
                                    case 0:
                                        $return_price = number_format($sale_product_price, 4, '.', '');
                                        break;
                                    case 1:
                                        $return_price = number_format($special_price, 4, '.', '');
                                        break;
                                    case 2:
                                        $return_price = number_format($sale_special_price, 4, '.', '');
                                        break;
                                    default:
                                        $return_price = number_format($special_price, 4, '.', '');
                                }
                            }

//                            $return_price = number_format($sale_special_price, 4, '.', '');

                            $sm_pids[$listing_sm['products_id']] = $return_price;
                        }
                    }
                }
            }
        }
    }

    return $sm_pids;
}

/**
 * @return array
 */
function getSaleMakersDates(): array
{
    $salesMakersProductsSelected = [];
    $salesMakersCategoriesArray = [];
    $salesMakersManufacturersArray = [];
    $salesMakersQuery = tep_db_query("SELECT * FROM " . TABLE_SALEMAKER_SALES . " where sale_status = '1' and (sale_date_start <= CURDATE() or sale_date_start = '0000-00-00') and (sale_date_end >= CURDATE() or sale_date_end = '0000-00-00')");
    while($saleRow = $salesMakersQuery->fetch_assoc())
    {
        if($saleRow['sale_manufacturers_selected'])
            $salesMakersManufacturersArray[] = $saleRow;

        if($saleRow['sale_categories_selected'])
            $salesMakersCategoriesArray[] = $saleRow;
    }

    if($salesMakersManufacturersArray) {
        foreach ($salesMakersManufacturersArray as $manufacturers) {
            $tempManuf = explode(',', $manufacturers['sale_manufacturers_selected']);

            foreach ($tempManuf as $manufacturerId)
            {
                $productsQuery = tep_db_query("SELECT products_id FROM products WHERE manufacturers_id = '".(int)$manufacturerId."'");
                while ($row = $productsQuery->fetch_assoc()) {
                    {
                        $salesMakersProductsSelected[$row['products_id']]['sale_date_start'] = $manufacturers['sale_date_start'];
                        $salesMakersProductsSelected[$row['products_id']]['sale_date_end'] = $manufacturers['sale_date_end'];
                    }
                }

            }
        }
    }

    if($salesMakersCategoriesArray) {
        foreach ($salesMakersCategoriesArray as $categories) {
            $tempCategories = explode(',', $categories['sale_categories_selected']);

            foreach ($tempCategories as $categoriesId)
            {
                $productsQuery = tep_db_query("SELECT p.products_id FROM products p LEFT JOIN products_to_categories p2c ON p2c.products_id = p.products_id WHERE p2c.categories_id = '".$categoriesId."'");
                while ($row = $productsQuery->fetch_assoc()) {
                    {
                        $salesMakersProductsSelected[$row['products_id']]['sale_date_start'] = $categories['sale_date_start'];
                        $salesMakersProductsSelected[$row['products_id']]['sale_date_end'] = $categories['sale_date_end'];
                    }
                }

            }
        }
    }

    return $salesMakersProductsSelected;
}


////
// Return a product's stock
// TABLES: products
function tep_get_products_stock($products_id)
{
    $products_id = tep_get_prid($products_id);
    $stock_query = tep_db_query("select products_quantity from " . TABLE_PRODUCTS . " where products_id = " . (int)$products_id);
    $stock_values = tep_db_fetch_array($stock_query);

    return $stock_values['products_quantity'];
}

////
// Check if the required stock is available
// If insufficent stock is available return an out of stock message
function tep_check_stock($products_id, $products_quantity)
{
    $stock_left = tep_get_products_stock($products_id) - $products_quantity;
    $out_of_stock = '';

    if ($stock_left < 0) {
        $out_of_stock = '<span class="markProductOutOfStock">' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . '</span>';
    }

    return $out_of_stock;
}

////
// Break a word in a string if it is longer than a specified length ($len)
function tep_break_string($string, $len, $break_char = '-')
{
    $l = 0;
    $output = '';
    for ($i = 0, $n = strlen($string); $i < $n; $i++) {
        $char = substr($string, $i, 1);
        if ($char != ' ') {
            $l++;
        } else {
            $l = 0;
        }
        if ($l > $len) {
            $l = 1;
            $output .= $break_char;
        }
        $output .= $char;
    }

    return $output;
}

////
// Return all HTTP GET variables, except those passed as a parameter
function tep_get_all_get_params($exclude_array = '')
{
    global $_GET;

    if (!is_array($exclude_array)) {
        $exclude_array = array();
    }

    $get_url = '';
    if (is_array($_GET) && (sizeof($_GET) > 0)) {
        reset($_GET);
        foreach ($_GET as $key => $value) {
            // if ((strlen($value) > 0) && ($key != tep_session_name()) && ($key != 'error') && (!in_array($key, $exclude_array)) && ($key != 'x') && ($key != 'y')) {
            if (($key !== tep_session_name()) && ($key !== 'error') && (!in_array($key, $exclude_array)) && ($key !== 'x') && ($key !== 'y')) {
                if (is_string($value) || is_int($value)) { // validation for case when try hack for example /article_info.php?articles_id[]=73
                    $get_url .= $key . '=' . rawurlencode(stripslashes($value)) . '&';
                }
            }
        }
    }

    return $get_url;
}

////
// Returns an array with countries
// TABLES: countries
function tep_get_countries($countries_id = '', $with_iso_codes = false)
{
    $countries_array = array();
    if (tep_not_null($countries_id)) {
        if ($with_iso_codes == true) {
            $countries = tep_db_query("select countries_name, countries_iso_code_2, countries_iso_code_3 from " . TABLE_COUNTRIES . " where countries_id = " . (int)$countries_id . " order by country_sort, countries_name");
            $countries_values = tep_db_fetch_array($countries);
            $countries_array = array(
                'countries_name' => $countries_values['countries_name'],
                'countries_iso_code_2' => $countries_values['countries_iso_code_2'],
                'countries_iso_code_3' => $countries_values['countries_iso_code_3']
            );
        } else {
            $countries = tep_db_query("select countries_name from " . TABLE_COUNTRIES . " where countries_id = " . (int)$countries_id);
            $countries_values = tep_db_fetch_array($countries);
            $countries_array = array('countries_name' => $countries_values['countries_name']);
        }
    } else {
        $countries = tep_db_query("select countries_id, countries_name from " . TABLE_COUNTRIES . " order by country_sort, countries_name");
        while ($countries_values = tep_db_fetch_array($countries)) {
            $countries_array[] = array(
                'countries_id' => $countries_values['countries_id'],
                'countries_name' => $countries_values['countries_name']
            );
        }
    }

    return $countries_array;
}

////
// Alias function to tep_get_countries, which also returns the countries iso codes
function tep_get_countries_with_iso_codes($countries_id)
{
    return tep_get_countries($countries_id, true);
}

////
// Generate a path to categories
function tep_get_path($current_category_id = '')
{
    global $cPath_array;

    if (tep_not_null($current_category_id)) {
        $cp_size = sizeof($cPath_array);
        if ($cp_size == 0) {
            $cPath_new = $current_category_id;
        } else {
            $cPath_new = '';
            $last_category_query = tep_db_query("select parent_id from " . TABLE_CATEGORIES . " where categories_id = " . (int)$cPath_array[($cp_size - 1)]);
            $last_category = tep_db_fetch_array($last_category_query);

            $current_category_query = tep_db_query("select parent_id from " . TABLE_CATEGORIES . " where categories_id = " . (int)$current_category_id);
            $current_category = tep_db_fetch_array($current_category_query);

            if ($last_category['parent_id'] == $current_category['parent_id']) {
                for ($i = 0; $i < ($cp_size - 1); $i++) {
                    $cPath_new .= '-' . $cPath_array[$i];
                }
            } else {
                for ($i = 0; $i < $cp_size; $i++) {
                    $cPath_new .= '-' . $cPath_array[$i];
                }
            }
            $cPath_new .= '-' . $current_category_id;

            if (substr($cPath_new, 0, 1) == '-') {
                $cPath_new = substr($cPath_new, 1);
            }
        }
    } else {
        $cPath_new = implode('-', $cPath_array);
    }

    return 'cPath=' . $cPath_new;
}

////
// Returns the clients browser
function tep_browser_detect($component)
{
    global $_SERVER;

    return stristr($_SERVER['HTTP_USER_AGENT'], $component);
}

////
// Alias function to tep_get_countries()
function tep_get_country_name($country_id)
{
    $country_array = tep_get_countries($country_id);

    return $country_array['countries_name'];
}

////
// Returns the zone (State/Province) name
// TABLES: zones
function tep_get_zone_name($country_id, $zone_id, $default_zone)
{
    $zone_query = tep_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = " . (int)$country_id . " and zone_id = " . (int)$zone_id);
    if (tep_db_num_rows($zone_query)) {
        $zone = tep_db_fetch_array($zone_query);
        return $zone['zone_name'];
    } else {
        return $default_zone;
    }
}

// returns zones names
function tep_get_country_zones($country_id)
{
    $zones_array = array();
    $zones_query = tep_db_query("select zone_id, zone_name from " . TABLE_ZONES . " where zone_country_id = " . (int)$country_id . " order by zone_name");
    while ($zones = tep_db_fetch_array($zones_query)) {
        $zones_array[] = array(
            'id' => $zones['zone_id'],
            'text' => $zones['zone_name']
        );
    }

    return $zones_array;
}

////
// Returns the zone (State/Province) code
// TABLES: zones
function tep_get_zone_code($country_id, $zone_id, $default_zone)
{
    $zone_query = tep_db_query("select zone_code from " . TABLE_ZONES . " where zone_country_id = " . (int)$country_id . " and zone_id = " . (int)$zone_id);
    if (tep_db_num_rows($zone_query)) {
        $zone = tep_db_fetch_array($zone_query);
        return $zone['zone_code'];
    } else {
        return $default_zone;
    }
}

////
// Wrapper function for round()
function tep_round($number, $precision)
{
    if (strpos($number, '.') && (strlen(substr($number, strpos($number, '.') + 1)) > $precision)) {
        $number = substr($number, 0, strpos($number, '.') + 1 + $precision + 1);

        if (substr($number, -1) >= 5) {
            if ($precision > 1) {
                $number = substr($number, 0, -1) + ('0.' . str_repeat(0, $precision - 1) . '1');
            } elseif ($precision == 1) {
                $number = substr($number, 0, -1) + 0.1;
            } else {
                $number = substr($number, 0, -1) + 1;
            }
        } else {
            $number = substr($number, 0, -1);
        }
    }

    return $number;
}

function tep_get_tax_rate($classId, $countryId = -1, $zoneId = -1, $forceTax = false)
{
    global $customer_zone_id, $customer_country_id, $taxRatesArray;

    //validate
    if (DISPLAY_PRICE_WITH_TAX == 'true' || $forceTax) {
        //get info
        if ($countryId == -1 and $zoneId == -1) {
            if (tep_session_is_registered('customer_id')) {
                $countryId = $customer_country_id;
                $zoneId = $customer_zone_id;
            } else {
                $countryId = $_SESSION['onepage']['delivery']['country_id'] ? : STORE_COUNTRY;
                $zoneId = $_SESSION['onepage']['delivery']['zone_id'] ? : STORE_ZONE;
            }
        }

        //get tax multiplier
        $allCountriesId = $allZonesId = 0;
        //order by from max to min tax priority
        foreach ($taxRatesArray as $taxRates) {
            //get tax multiplier for current class, current priority and (if exist "current region" or if exist "all regions")
            $taxMultiplier = $taxRates[$classId][$countryId][$zoneId]['value'] ?: $taxRates[$classId][$allCountriesId][$allZonesId]['value'];
            //check lower priorities if there is no tax for current region
            if (!empty($taxMultiplier)) {
                break;
            }
        }
    }
    $taxMultiplier = !empty($taxMultiplier) ? $taxMultiplier : 0;

    return $taxMultiplier;
}

function tep_get_tax_description($classId, $countryId = -1, $zoneId = -1, $forceTax = false)
{
    global $customer_zone_id, $customer_country_id, $taxRatesArray;

    //validate
    if (DISPLAY_PRICE_WITH_TAX == 'true' || $forceTax) {
        //get info
        if ($countryId == -1 and $zoneId == -1) {
            if (tep_session_is_registered('customer_id')) {
                $countryId = $customer_country_id;
                $zoneId = $customer_zone_id;
            } else {
                $countryId = $_SESSION['onepage']['delivery']['country_id'] ? : STORE_COUNTRY;
                $zoneId = $_SESSION['onepage']['delivery']['zone_id'] ? : STORE_ZONE;
            }
        }

        //get tax text
        $allCountriesId = $allZonesId = 0;
        //order by from max to min tax priority
        foreach ($taxRatesArray as $taxRates) {
            //get tax multiplier for current class, current priority and (if exist "current region" or if exist "all regions")
            $taxDescription = $taxRates[$classId][$countryId][$zoneId]['text'] ?: $taxRates[$classId][$allCountriesId][$allZonesId]['text'];
            //check lower priorities if there is no tax for current region
            if (!empty($taxDescription)) {
                break;
            }
        }
    }
    $taxDescription = !empty($taxDescription) ? $taxDescription : '';

    return $taxDescription;
}

////
// Add tax to a products price
function tep_add_tax($price, $tax)
{
    global $currencies, $currency;

    if ((DISPLAY_PRICE_WITH_TAX == 'true') && ($tax > 0)) {
        return tep_round($price, $currencies->currencies[$currency]['decimal_places']) + tep_calculate_tax($price, $tax);
    } else {
        return $price;
    }
}

// Calculates Tax rounding the result
function tep_calculate_tax($price, $tax)
{
    global $currencies, $currency;

    return tep_round((float)$price * (float)$tax / 100, $currencies->currencies[$currency]['decimal_places']);
}

function tep_make_cat_list($current_category_id = 0, $array = array(), $parent = 0)
{
    global $cat_tree, $cat_list;
    //   $current_category_id = (int)$current_category_id;
    if (empty($array)) {
        $array = $current_category_id == 0 ? $cat_tree : $cat_tree[$current_category_id];
    }

    $return = array();
    if (is_array($array)) {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $return[$key] = $key;
                //   $return = array_merge($return, tep_make_cat_list($current_category_id, $value, $key));
                $return = $return + tep_make_cat_list($current_category_id, $value, $key);
            } else {
                $return[$key] = $value;
            }
        }
    } else {
        $return = array_column($cat_tree, $current_category_id)[0];

        if (is_array($return)) {
            $return = tep_make_cat_list($current_category_id, $return, $parent);
        }
        if ($return == $current_category_id) {
            $return = array();
        }
    }

    $cat_list[$parent] = $return;
    return $return;
}

function tep_rec_cats($table, $table2)
{
    if (is_array($table2)) {
        foreach ($table as $k => $v) {
            if (in_array($k, $table2)) {
                foreach ($v as $k2 => $v2) {
                    $table3[] = $v2;
                }
            }
        }
        if (!empty($table3)) {
            $table4 = tep_rec_cats($table, $table3);
            if (is_array($table4)) {
                $table3 = array_merge($table3, $table4);
            }
        }
        return $table3;
    }
}


////
// Return true if the category has subcategories
// TABLES: categories
function tep_has_category_subcategories($category_id)
{
    $child_category_query = tep_db_query("select count(*) as count from " . TABLE_CATEGORIES . " where parent_id = " . (int)$category_id);
    $child_category = tep_db_fetch_array($child_category_query);

    if ($child_category['count'] > 0) {
        return true;
    } else {
        return false;
    }
}

////
// Returns the address_format_id for the given country
// TABLES: countries;
function tep_get_address_format_id($country_id)
{
    $address_format_query = tep_db_query("select address_format_id as format_id from " . TABLE_COUNTRIES . " where countries_id = " . (int)$country_id);
    if (tep_db_num_rows($address_format_query)) {
        $address_format = tep_db_fetch_array($address_format_query);
        return $address_format['format_id'];
    } else {
        return '1';
    }
}

////
// Return a formatted address
// TABLES: address_format
function tep_address_format($address_format_id, $address, $html, $boln, $eoln)
{
    if (is_null($address_format_id) or $address_format_id == '0') {
        $address_format_id = 1;
    }
    $address_format_query = tep_db_query("select address_format as format from " . TABLE_ADDRESS_FORMAT . " where address_format_id = " . (int)$address_format_id);
    $address_format = tep_db_fetch_array($address_format_query);

    if (is_array($address['country'])) {
        $tmp_country = $address['country'];
        $address['country'] = $tmp_country['title'];
    }

    $company = tep_output_string_protected($address['company']);
    if (isset($address['firstname']) && tep_not_null($address['firstname'])) {
        $firstname = tep_output_string_protected($address['firstname']);
        $lastname = tep_output_string_protected($address['lastname']);
    } elseif (isset($address['name']) && tep_not_null($address['name'])) {
        $firstname = tep_output_string_protected($address['name']);
        $lastname = '';
    } else {
        $firstname = '';
        $lastname = '';
    }
    $street = tep_output_string_protected($address['street_address']);
    $suburb = tep_output_string_protected($address['suburb']);
    $city = tep_output_string_protected($address['city']);
    $state = tep_output_string_protected($address['state']);
    if (isset($address['country_id']) && tep_not_null($address['country_id'])) {
        $country = tep_get_country_name($address['country_id']);

        if (isset($address['zone_id']) && tep_not_null($address['zone_id'])) {
            //        $state = tep_get_zone_code($address['country_id'], $address['zone_id'], $state);
            $state = tep_get_zone_name($address['country_id'], $address['zone_id'], $state);
        }
    } elseif (isset($address['country']) && tep_not_null($address['country'])) {
        $country = tep_output_string_protected($address['country']);
    } else {
        $country = '';
    }
    $postcode = tep_output_string_protected($address['postcode']);
    $zip = $postcode;

    if ($html) {
        // HTML Mode
        $HR = '<hr>';
        $hr = '<hr>';
        if (($boln == '') && ($eoln == "\n")) { // Values not specified, use rational defaults
            $CR = '<br>';
            $cr = '<br>';
            $eoln = $cr;
        } else { // Use values supplied
            $CR = $eoln . $boln;
            $cr = $CR;
        }
    } else {
        // Text Mode
        $CR = $eoln;
        $cr = $CR;
        $HR = '----------------------------------------';
        $hr = '----------------------------------------';
    }

    $statecomma = '';
    $streets = $street;
    if (!empty($suburb)) {
        $streets = $street . $cr . $suburb;
    }
    if ($country == '') {
        $country = tep_output_string_protected($address['country']);
    }
    if (!empty($state)) {
        $statecomma = $state . ', ';
    }

    $fmt = $address_format['format'];
    eval("\$address2 = \"$fmt\";");

    if ((ACCOUNT_COMPANY == 'true') && (tep_not_null($company))) {
        $address2 = $company . $cr . $address2;
    }

    return $address2;
}

////
// Return a formatted address
// TABLES: customers, address_book
function tep_address_label($customers_id, $address_id = 1, $html = false, $boln = '', $eoln = "\n")
{
    $address_query = tep_db_query("select entry_firstname as firstname, entry_lastname as lastname, entry_company as company, entry_street_address as street_address, entry_suburb as suburb, entry_city as city, entry_postcode as postcode, entry_state as state, entry_zone_id as zone_id, entry_country_id as country_id from " . TABLE_ADDRESS_BOOK . " where customers_id = " . (int)$customers_id . " and address_book_id = " . (int)$address_id);
    $address = tep_db_fetch_array($address_query);

    $format_id = tep_get_address_format_id($address['country_id']);

    return tep_address_format($format_id, $address, $html, $boln, $eoln);
}

function tep_row_number_format($number)
{
    if (($number < 10) && (substr($number, 0, 1) != '0')) {
        $number = '0' . $number;
    }

    return $number;
}

function tep_get_manufacturers()
{
    global $seo_urls,$languages_id;

    $manufacturers_query = tep_db_query("select m.manufacturers_id, m.manufacturers_robots_status, mi.manufacturers_name, m.manufacturers_seo_url from " . TABLE_MANUFACTURERS . " m JOIN " . TABLE_MANUFACTURERS_INFO . " mi on mi.manufacturers_id = m.manufacturers_id where status = '1' and mi.languages_id = " . (int)$languages_id . " order by manufacturers_name");
    while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
        if ($manufacturers['manufacturers_seo_url'] == '') {
            $manufacturers['manufacturers_seo_url'] = $seo_urls->strip($manufacturers['manufacturers_name']);
            tep_db_query("update " . TABLE_MANUFACTURERS . " set manufacturers_seo_url = '" . tep_db_prepare_input($manufacturers['manufacturers_seo_url']) . "' where manufacturers_id = " . (int)$manufacturers['manufacturers_id']);
        }
        $manufacturers_array[$manufacturers['manufacturers_id']] = array(
            'name' => $manufacturers['manufacturers_name'],
            'url' => $manufacturers['manufacturers_seo_url'],
            'robots_status' => $manufacturers['manufacturers_robots_status']
            );
    }
    return $manufacturers_array;
}

function tep_date_short_custom($raw_date, $render = false)
{
    if (($raw_date == '0000-00-00 00:00:00') || ($raw_date == '')) {
        return false;
    }

    $year = substr($raw_date, 0, 4);
    $month = (int)substr($raw_date, 5, 2);
    $day = (int)substr($raw_date, 8, 2);
    $hour = (int)substr($raw_date, 11, 2);
    $minute = (int)substr($raw_date, 14, 2);
    $second = (int)substr($raw_date, 17, 2);

    $output['d'] = $day;
    $output['m'] = $month;
    $output['y'] = $year;

    if ($render) {
        $str = '';
        foreach ($output as $key => $value) {
            if ($key == 'y') {
                $str .= $value;
                continue;
            }
            $str .= $value . '.';
        }
        return $str;
    }
    return $output;
}

// Output a raw date string in the selected locale date format
// $raw_date needs to be in this format: YYYY-MM-DD HH:MM:SS
function tep_date_long($raw_date)
{
    if (($raw_date == '0000-00-00 00:00:00') || ($raw_date == '')) {
        return false;
    }

    $year = (int)substr($raw_date, 0, 4);
    $month = (int)substr($raw_date, 5, 2);
    $day = (int)substr($raw_date, 8, 2);
    $hour = (int)substr($raw_date, 11, 2);
    $minute = (int)substr($raw_date, 14, 2);
    $second = (int)substr($raw_date, 17, 2);

    return strftime(DATE_FORMAT_LONG, mktime($hour, $minute, $second, $month, $day, $year));
}

////
// Output a raw date string in the selected locale date format
// $raw_date needs to be in this format: YYYY-MM-DD HH:MM:SS
// NOTE: Includes a workaround for dates before 01/01/1970 that fail on windows servers
function tep_date_short($raw_date)
{
    if (($raw_date == '0000-00-00 00:00:00') || ($raw_date == '')) {
        return false;
    }

    $year = substr($raw_date, 0, 4);
    $month = (int)substr($raw_date, 5, 2);
    $day = (int)substr($raw_date, 8, 2);
    $hour = (int)substr($raw_date, 11, 2);
    $minute = (int)substr($raw_date, 14, 2);
    $second = (int)substr($raw_date, 17, 2);

    if (@date('Y', mktime($hour, $minute, $second, $month, $day, $year)) == $year) {
        return date(DATE_FORMAT, mktime($hour, $minute, $second, $month, $day, $year));
    } else {
        return preg_replace('/2037' . '$/', $year, date(DATE_FORMAT, mktime($hour, $minute, $second, $month, $day, 2037)));
    }
}

// -------------by raid
function tep_date_short_r($raw_date)
{
    if (($raw_date == '0000-00-00 00:00:00') || ($raw_date == '')) {
        return false;
    }

    $year = substr($raw_date, 0, 4);
    $month = (int)substr($raw_date, 5, 2);
    $day = (int)substr($raw_date, 8, 2);
    $hour = (int)substr($raw_date, 11, 2);
    $minute = (int)substr($raw_date, 14, 2);
    $second = (int)substr($raw_date, 17, 2);

    $vivod = array(
        $day,
        $month,
        $year
    );
    return $vivod;
}

////
// Check date
function tep_checkdate($date_to_check, $format_string, &$date_array)
{
    $separator_idx = -1;

    $separators = array(
        '-',
        ' ',
        '/',
        '.'
    );
    $month_abbr = array(
        'jan',
        'feb',
        'mar',
        'apr',
        'may',
        'jun',
        'jul',
        'aug',
        'sep',
        'oct',
        'nov',
        'dec'
    );
    $no_of_days = array(
        31,
        28,
        31,
        30,
        31,
        30,
        31,
        31,
        30,
        31,
        30,
        31
    );

    $format_string = strtolower($format_string);

    if (strlen($date_to_check) != strlen($format_string)) {
        return false;
    }

    $size = sizeof($separators);
    for ($i = 0; $i < $size; $i++) {
        $pos_separator = strpos($date_to_check, $separators[$i]);
        if ($pos_separator != false) {
            $date_separator_idx = $i;
            break;
        }
    }

    for ($i = 0; $i < $size; $i++) {
        $pos_separator = strpos($format_string, $separators[$i]);
        if ($pos_separator != false) {
            $format_separator_idx = $i;
            break;
        }
    }

    if ($date_separator_idx != $format_separator_idx) {
        return false;
    }

    if ($date_separator_idx != -1) {
        $format_string_array = explode($separators[$date_separator_idx], $format_string);
        if (sizeof($format_string_array) != 3) {
            return false;
        }

        $date_to_check_array = explode($separators[$date_separator_idx], $date_to_check);
        if (sizeof($date_to_check_array) != 3) {
            return false;
        }

        $size = sizeof($format_string_array);
        for ($i = 0; $i < $size; $i++) {
            if ($format_string_array[$i] == 'mm' || $format_string_array[$i] == 'mmm') {
                $month = $date_to_check_array[$i];
            }
            if ($format_string_array[$i] == 'dd') {
                $day = $date_to_check_array[$i];
            }
            if (($format_string_array[$i] == 'yyyy') || ($format_string_array[$i] == 'aaaa')) {
                $year = $date_to_check_array[$i];
            }
        }
    } else {
        if (strlen($format_string) == 8 || strlen($format_string) == 9) {
            $pos_month = strpos($format_string, 'mmm');
            if ($pos_month != false) {
                $month = substr($date_to_check, $pos_month, 3);
                $size = sizeof($month_abbr);
                for ($i = 0; $i < $size; $i++) {
                    if ($month == $month_abbr[$i]) {
                        $month = $i;
                        break;
                    }
                }
            } else {
                $month = substr($date_to_check, strpos($format_string, 'mm'), 2);
            }
        } else {
            return false;
        }

        $day = substr($date_to_check, strpos($format_string, 'dd'), 2);
        $year = substr($date_to_check, strpos($format_string, 'yyyy'), 4);
    }

    if (strlen($year) != 4) {
        return false;
    }

    if (!settype($year, 'integer') || !settype($month, 'integer') || !settype($day, 'integer')) {
        return false;
    }

    if ($month > 12 || $month < 1) {
        return false;
    }

    if ($day < 1) {
        return false;
    }

    if (tep_is_leap_year($year)) {
        $no_of_days[1] = 29;
    }

    if ($day > $no_of_days[$month - 1]) {
        return false;
    }

    $date_array = array(
        $year,
        $month,
        $day
    );

    return true;
}

////
// Check if year is a leap year
function tep_is_leap_year($year)
{
    if ($year % 100 == 0) {
        if ($year % 400 == 0) {
            return true;
        }
    } else {
        if (($year % 4) == 0) {
            return true;
        }
    }

    return false;
}

////
// Return table heading with sorting capabilities
function tep_create_sort_heading($sortby, $colnum, $heading)
{
    global $PHP_SELF;

    $sort_prefix = '';
    $sort_suffix = '';

    if ($sortby) {
        $sort_prefix = '<a rel="nofollow" href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array(
                    'page',
                    'info',
                    'sort'
                )) . 'page=1&sort=' . $colnum . ($sortby == $colnum . 'a' ? 'd' : 'a')) . '" title="' . tep_output_string(TEXT_SORT_PRODUCTS . ($sortby == $colnum . 'd' || substr($sortby, 0, 1) != $colnum ? TEXT_ASCENDINGLY : TEXT_DESCENDINGLY) . TEXT_BY . $heading) . '" class="productListing-heading">' . (substr($sortby, 0, 1) == $colnum ? '<b>' : '');
        $sort_suffix = (substr($sortby, 0, 1) == $colnum ? (substr($sortby, 1, 1) == 'a' ? ' +</b>' : ' -</b>') : '') . '</a>';
    }

    return $sort_prefix . $heading . $sort_suffix;
}

// new recursive function without DB queries:

function tep_get_parent_categories(&$parents = array(), $categories_id, $cat_tree = array())
{
    foreach ($cat_tree as $k => $v) {
        if (is_array($v)) {
            if ($k == $categories_id) {
                return array($k => $categories_id); // And if we match, stack it and return it
            }

            // If the current element of the array is an array, recurse it and capture the return
            $return = tep_get_parent_categories($parents, $categories_id, $v);

            // If the return is an array, stack it and return it
            if (is_array($return)) {
                $parents[] = $k;
                return array($k => $return);
            }
        } else {
            // Since we are not on an array, compare directly
            if ($v == $categories_id) {
                return array($k => $categories_id); // And if we match, stack it and return it
            }
        }
    }

    // Return false since there was nothing found
    return false;
}


////
// Construct a category path to the product
// TABLES: products_to_categories
function tep_get_product_path($products_id)
{
    global $cat_tree, $prodToCat;

    if (getConstantValue('SEO_ADD_PARENT_CATEGORIES_TO_URL') === 'false') {
        return $prodToCat[$products_id];
    }

    $cPath = '';
    tep_get_parent_categories($categories, $prodToCat[$products_id], $cat_tree);

    if (is_array($categories)) {
        $categories = array_reverse($categories);
        $cPath = implode('-', $categories);
        if (tep_not_null($cPath)) {
            $cPath .= '-';
        }
    }
    $cPath .= $prodToCat[$products_id];

    return $cPath;
}

// Return a product ID with attributes
function tep_get_uprid($prid, $params)
{
    if (is_numeric($prid)) {
        $uprid = $prid;

        if (is_array($params) && (sizeof($params) > 0)) {
            $attributes_check = true;
            $attributes_ids = '';

            reset($params);
            foreach ($params as $option => $value) {
                if (is_numeric($option) && is_numeric($value)) {
                    // otf 1.71 Add processing around $value. This is needed for text attributes.
                    $attributes_ids .= '{' . (int)$option . '}' . (int)$value;

                    // Add else stmt to process product ids passed in by other routines.
                } else {
//                    $attributes_ids .= htmlspecialchars(stripslashes($attributes_ids), ENT_QUOTES, 'windows-1251');
//                    $attributes_check = false;
//                    break;
                }
            }

            if ($attributes_check == true) {
                $uprid .= $attributes_ids;
            }
        }
    } else {
        $uprid = tep_get_prid($prid);

        if (is_numeric($uprid)) {
            if (strpos($prid, '{') !== false) {
                $attributes_check = true;
                $attributes_ids = '';

                // strpos()+1 to remove up to and including the first { which would create an empty array element in explode()
                $attributes = explode('{', substr($prid, strpos($prid, '{') + 1));

                for ($i = 0, $n = sizeof($attributes); $i < $n; $i++) {
                    $pair = explode('}', $attributes[$i]);

                    if (is_numeric($pair[0]) && is_numeric($pair[1])) {
                        $attributes_ids .= '{' . (int)$pair[0] . '}' . (int)$pair[1];
                    } else {
                        $attributes_check = false;
                        break;
                    }
                }

                if ($attributes_check == true) {
                    $uprid .= $attributes_ids;
                }
            }
        } else {
            return false;
        }
    }

    return $uprid;
}

////
// Return a product ID from a product ID with attributes
function tep_get_prid($uprid)
{
    if (is_array($uprid)) {
        $pieces = [array_shift($uprid)];
    } else {
        $pieces = explode('{', $uprid);
    }

    if (is_numeric($pieces[0])) {
        return $pieces[0];
    } else {
        return false;
    }
}
////
// Return a customer greeting
function tep_customer_greeting()
{
    global $customer_id, $customer_first_name;

    if (tep_session_is_registered('customer_first_name') && tep_session_is_registered('customer_id')) {
        $greeting_string = sprintf(TEXT_GREETING_PERSONAL, tep_output_string_protected($customer_first_name), tep_href_link(FILENAME_PRODUCTS_NEW));
    } else {
        $greeting_string = sprintf(TEXT_GREETING_GUEST, tep_href_link(FILENAME_LOGIN, '', 'SSL'), tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'));
    }

    return $greeting_string;
}

function tep_mail($to_name, $to_email_address, $email_subject, $email_text, $from_email_name, $from_email_address, $attachment = '')
{
    $botname = 'bot@' . $_SERVER['SERVER_NAME'];
    $smtpStatus = false;
    if (getConstantValue('SMTP_MODULE_ENABLED') == "true" && is_dir(ROOT_DIR . '/' . DIR_WS_EXT . "smtp")) {
        require_once ROOT_DIR . '/' . DIR_WS_EXT . "smtp/check.php";
        $smtpStatus = !empty(SMTP_HOST) && !empty(SMTP_PORT) && !empty(SMTP_SECURITY) && !empty(SMTP_USERNAME) && !empty(SMTP_PASSWORD);
    }

    if ($smtpStatus) {
        $result = false;
        try {
            $transport = (new Swift_SmtpTransport(SMTP_HOST, SMTP_PORT, SMTP_SECURITY))
                ->setUsername(SMTP_USERNAME)
                ->setPassword(SMTP_PASSWORD);

            // Create the Mailer using your created Transport
            $mailer = new Swift_Mailer($transport);

            // Create a message
            $message = (new Swift_Message($email_subject))
                ->setFrom([$botname=> $from_email_name])
                ->setReplyTo([$from_email_address => $from_email_name])
                ->setTo([$to_email_address])
                ->setBody($email_text, 'text/html');

            // Send the message
            $result = $mailer->send($message);
        } catch (\Exception $exception) {
            \App\Logger\Log::error($exception->getMessage());
        }

        return $result;
    } else {
        /*   $headers='MIME-Version: 1.0' . "\r\n";
           $headers.='Content-type: text/html; charset=utf-8' . "\r\n";
           $headers.="From: " . $from_email_name . " <" . $from_email_address . ">\r\n";
           return @mail($to_email_address, '=?utf-8?B?' . base64_encode($email_subject) . '?=', '<html>'.$email_text.'</html>', $headers);  */

        // Unique boundary
        $boundary = md5(uniqid() . microtime());

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= "From: \"" . mb_encode_mimeheader($botname) . "\" <" . $botname . ">\r\n";
        $headers .= "Reply-To: \"" . mb_encode_mimeheader($from_email_name) . "\" <" . $from_email_address . ">\r\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"$boundary\"\r\n\r\n";

        // Plain text version of message
        $body = "--$boundary\r\n" .
            "Content-Type: text/plain; charset=utf-8\r\n" . //charset=ISO-8859-1
            "Content-Transfer-Encoding: base64\r\n\r\n";
        $body .= chunk_split(base64_encode(trim(preg_replace('/^[ \t]*[\r\n]+/m', '', strip_tags($email_text)))));
        // HTML version of message
        $body .= "--$boundary\r\n" .
            "Content-Type: text/html; charset=utf-8\r\n" . //charset=ISO-8859-1
            "Content-Transfer-Encoding: base64\r\n\r\n";
        $body .= chunk_split(base64_encode('<html>' . $email_text . '</html>'));

        if (!empty($attachment)) {
            $body .= "--$boundary\r\n";
            $body .= "Content-Type: " . $attachment['type'] . "; name=\"" . $attachment['name'] . "\"\r\n";
            $body .= "Content-Transfer-Encoding: " . $attachment['encoding'] . "\r\n";
            $body .= "Content-ID: <" . $attachment['src'] . ">\r\n";
            $body .= "Content-Disposition: inline; filename=\"" . $attachment['name'] . "\"\r\n\r\n";
            $body .= $attachment['data'] . "\r\n";
        }
        $body .= "--$boundary--";

        return @mail($to_email_address, '=?utf-8?B?' . base64_encode($email_subject) . '?=', $body, $headers, '-f ' . $botname);
    }
}

////
// Check if product has attributes
function tep_has_product_attributes($products_id)
{
    $attributes_query = tep_db_query("select count(*) as count from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = " . (int)$products_id);
    $attributes = tep_db_fetch_array($attributes_query);

    if ($attributes['count'] > 0) {
        return true;
    } else {
        return false;
    }
}

////
// Get the number of times a word/character is present in a string
function tep_word_count($string, $needle)
{
    $temp_array = preg_split($needle, $string);

    return sizeof($temp_array);
}

function tep_count_modules($modules = '')
{
    $count = 0;

    if (empty($modules)) {
        return $count;
    }

    $modules_array = explode(';', $modules);

    for ($i = 0, $n = sizeof($modules_array); $i < $n; $i++) {
        $class = substr($modules_array[$i], 0, strrpos($modules_array[$i], '.'));

        if (is_object($GLOBALS[$class])) {
            if ($GLOBALS[$class]->enabled) {
                $count++;
            }
        }
    }

    return $count;
}

function tep_count_payment_modules()
{
    return tep_count_modules(MODULE_PAYMENT_INSTALLED);
}

function tep_count_shipping_modules()
{
    return tep_count_modules(MODULE_SHIPPING_INSTALLED);
}

function tep_create_random_value($length, $type = 'mixed')
{
    if (($type != 'mixed') && ($type != 'chars') && ($type != 'digits')) {
        return false;
    }

    $rand_value = '';
    while (strlen($rand_value) < $length) {
        if ($type == 'digits') {
            $char = tep_rand(0, 9);
        } else {
            $char = chr(tep_rand(0, 255));
        }
        if ($type == 'mixed') {
            if (preg_match('/^[a-z0-9]$/i', $char)) {
                $rand_value .= $char;
            }
        } elseif ($type == 'chars') {
            if (preg_match('/^[a-z]$/i', $char)) {
                $rand_value .= $char;
            }
        } elseif ($type == 'digits') {
            if (preg_match('/^[0-9]$/', $char)) {
                $rand_value .= $char;
            }
        }
    }

    return $rand_value;
}

function tep_array_to_string($array, $exclude = '', $equals = '=', $separator = '&')
{
    if (!is_array($exclude)) {
        $exclude = array();
    }

    $get_string = '';
    if (sizeof($array) > 0) {
        foreach ($array as $key => $value) {
            if ((!in_array($key, $exclude)) && ($key != 'x') && ($key != 'y')) {
                $get_string .= $key . $equals . $value . $separator;
            }
        }
        $remove_chars = strlen($separator);
        $get_string = substr($get_string, 0, -$remove_chars);
    }

    return $get_string;
}

function tep_not_null($value)
{
    if (is_array($value)) {
        if (sizeof($value) > 0) {
            return true;
        } else {
            return false;
        }
    } else {
        $value = trim($value);
        if (!empty($value) && (strtolower($value) != 'null')) {
            return true;
        } else {
            return false;
        }
    }
}

////
// Output the tax percentage with optional padded decimals
function tep_display_tax_value($value, $padding = 0)
{
    if (strpos($value, '.')) {
        $loop = true;
        while ($loop) {
            if (substr($value, -1) == '0') {
                $value = substr($value, 0, -1);
            } else {
                $loop = false;
                if (substr($value, -1) == '.') {
                    $value = substr($value, 0, -1);
                }
            }
        }
    }

    if ($padding > 0) {
        if ($decimal_pos = strpos($value, '.')) {
            $decimals = strlen(substr($value, ($decimal_pos + 1)));
            for ($i = $decimals; $i < $padding; $i++) {
                $value .= '0';
            }
        } else {
            $value .= '.';
            for ($i = 0; $i < $padding; $i++) {
                $value .= '0';
            }
        }
    }

    return $value;
}

////
// Checks to see if the currency code exists as a currency
// TABLES: currencies
function tep_currency_exists($code)
{
    global  $seo_urls;
    // If string contains chars Windows-1251 to UTF-8
    $code = mb_convert_encoding($code, 'UTF-8', 'Windows-1251');
    $code = strtr($code, $seo_urls->attributes['SEO_CHAR_CONVERT_SET']);
    $code = tep_db_prepare_input($code);

    $currency_code = tep_db_query("select currencies_id from " . TABLE_CURRENCIES . " where code = '" . tep_db_prepare_input($code) . "'");
    if (tep_db_num_rows($currency_code)) {
        return $code;
    } else {
        return false;
    }
}

function tep_string_to_int($string)
{
    return (int)$string;
}

////
// Parse and secure the cPath parameter values
function tep_parse_category_path($cPath)
{
    // make sure the category IDs are integers
    $cPath_array = array_map('tep_string_to_int', explode('-', $cPath));

    // make sure no duplicate category IDs exist which could lock the server in a loop
    $tmp_array = array();
    $n = sizeof($cPath_array);
    for ($i = 0; $i < $n; $i++) {
        if (!in_array($cPath_array[$i], $tmp_array)) {
            $tmp_array[] = $cPath_array[$i];
        }
    }

    //remove 0 category as child of another category
    $tmp_array = array_filter($tmp_array, function ($value, $key) {
        return $key == 0 || $value != 0;
    }, ARRAY_FILTER_USE_BOTH);

    return $tmp_array;
}

////
// Return a random value
function tep_rand($min = null, $max = null)
{
    static $seeded;

    if (!isset($seeded)) {
        mt_srand((double)microtime() * 1000000);
        $seeded = true;
    }

    if (isset($min) && isset($max)) {
        if ($min >= $max) {
            return $min;
        } else {
            return mt_rand($min, $max);
        }
    } else {
        return mt_rand();
    }
}

function tep_setcookie($name, $value = '', $expire = 0, $path = '/', $domain = '', $secure = 0)
{
    setcookie($name, $value, $expire, $path, (tep_not_null($domain) ? $domain : ''), $secure, true);
}

function tep_get_ip_address()
{
    if (isset($_SERVER)) {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
    } else {
        if (getenv('HTTP_X_FORWARDED_FOR')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('HTTP_CLIENT_IP')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } else {
            $ip = getenv('REMOTE_ADDR');
        }
    }

    return $ip;
}

function tep_count_customer_orders($id = '', $check_session = true)
{
    global $customer_id;

    if (is_numeric($id) == false) {
        if (tep_session_is_registered('customer_id')) {
            $id = $customer_id;
        } else {
            return 0;
        }
    }

    if ($check_session == true) {
        if ((tep_session_is_registered('customer_id') == false) || ($id != $customer_id)) {
            return 0;
        }
    }

    $orders_check_query = tep_db_query("select count(*) as total from " . TABLE_ORDERS . " where customers_id = " . (int)$id);
    $orders_check = tep_db_fetch_array($orders_check_query);

    return $orders_check['total'];
}

function tep_count_customer_address_book_entries($id = '', $check_session = true)
{
    global $customer_id;

    if (is_numeric($id) == false) {
        if (tep_session_is_registered('customer_id')) {
            $id = $customer_id;
        } else {
            return 0;
        }
    }

    if ($check_session == true) {
        if ((tep_session_is_registered('customer_id') == false) || ($id != $customer_id)) {
            return 0;
        }
    }

    $addresses_query = tep_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where customers_id = " . (int)$id);
    $addresses = tep_db_fetch_array($addresses_query);

    return $addresses['total'];
}

// nl2br() prior PHP 4.2.0 did not convert linefeeds on all OSs (it only converted \n)
function tep_convert_linefeeds($from, $to, $string)
{
    if ((PHP_VERSION < "4.0.5") && is_array($from)) {
        return preg_replace('/(' . implode('|/', $from) . ')', $to, $string);
    } else {
        return str_replace($from, $to, $string);
    }
}

//TotalB2B start
function tep_xppp_getmaxprices()
{
    //max prices per product
    return 10;
}

function tep_xppp_getpricesnum()
{
    //  $prices_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'XPRICES_NUM'");
    //    $prices = tep_db_fetch_array($prices_query);
    //  return $prices['configuration_value'];
    return XPRICES_NUM;
}

function tep_xppp_getpricelist($ts)
{
    $prices_num = tep_xppp_getpricesnum();
    for ($i = 2; $i <= $prices_num; $i++) {
        if ($ts != null) {
            $price_list .= $ts . ".products_price_" . $i . ",";
        } else {
            $price_list .= "products_price_" . $i . ",";
        }
    }
    if ($ts != null) {
        $price_list .= $ts . ".products_price";
    } else {
        $price_list .= "products_price";
    }
    return $price_list;
}

function tep_xppp_getproductprice($products_id)
{
    global $customer_id;
    $customer_price = 0;
    if (is_file(DIR_WS_EXT . 'customers_groups/customers_groups.php')) {
        $customer_query = tep_db_query("select g.customers_groups_price from " . TABLE_CUSTOMERS_GROUPS . " g inner join  " . TABLE_CUSTOMERS . " c on g.customers_groups_id = c.customers_groups_id and c.customers_id = " . (int)$customer_id);
        $customer_query_result = tep_db_fetch_array($customer_query);
        $customer_price = $customer_query_result['customers_groups_price'];
    }

    $products_price_list = tep_xppp_getpricelist("");
    $product_info_query = tep_db_query("select products_id, " . $products_price_list . "  from " . TABLE_PRODUCTS . " where products_id = " . (int)$products_id);
    $product_info = tep_db_fetch_array($product_info_query);
    if ($product_info['products_price_' . $customer_price] == null) {
        $product_info['products_price_' . $customer_price] = $product_info['products_price'];
    }
    if ((int)$customer_price != 1) {
        $product_info['products_price'] = $product_info['products_price_' . $customer_price];
    }
    // BOF FlyOpenair: Extra Product Price
    $product_info['products_price'] = extra_product_price($product_info['products_price']);
    // EOF FlyOpenair: Extra Product Price
    return $product_info['products_price'];
}
////
//CLR 030228 Add function tep_decode_specialchars
// Decode string encoded with htmlspecialchars()
function tep_decode_specialchars($string)
{
    $string = str_replace('&gt;', '>', $string);
    $string = str_replace('&lt;', '<', $string);
    $string = str_replace('&#039;', "'", $string);
    $string = str_replace('&quot;', "\"", $string);
    $string = str_replace('&amp;', '&', $string);

    return $string;
}


////
// Return a product's minimum quantity
// TABLES: products
function tep_get_products_quantity_order_min($product_id)
{

    $the_products_quantity_order_min_query = tep_db_query("select products_id, products_quantity_order_min from " . TABLE_PRODUCTS . " where products_id = " . (int)$product_id);
    $the_products_quantity_order_min = tep_db_fetch_array($the_products_quantity_order_min_query);
    if ($the_products_quantity_order_min['products_quantity_order_min'] == 0) {
        $the_products_quantity_order_min['products_quantity_order_min'] = 1;
    }
    return $the_products_quantity_order_min['products_quantity_order_min'];
}

////
// Return a product's minimum unit order
// TABLES: products
function tep_get_products_quantity_order_units($product_id)
{
    $the_products_quantity_order_units_query = tep_db_query("select products_id, products_quantity_order_units from " . TABLE_PRODUCTS . " where products_id = " . (int)$product_id);
    $the_products_quantity_order_units = tep_db_fetch_array($the_products_quantity_order_units_query);

    return $the_products_quantity_order_units['products_quantity_order_units'];
}

/**
 * Get all product's files to download
 * @param $product_id
 * @param $order_id
 * @return array
 */
function tep_get_products_downloads($product_id, $order_id = false)
{
    $product_downloads = [];
    $product_downloads_query = tep_db_query("SELECT products_file FROM " . TABLE_PRODUCTS_TO_DOWNLOAD . " WHERE products_id = " . $product_id . " ORDER BY sort_order");
    while ($file = tep_db_fetch_array($product_downloads_query)) {
        if ($order_id) {
            $order_id_str = '&order_id=' . $order_id;
        } else {
            $order_id_str = '';
        }
        if(is_file('images/downloads/' . $product_id . '/' . $file['products_file'])) {
            $href = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'];
            $product_downloads[] = [
                'products_file' => $file['products_file'],
                'products_file_link' => $href . '/downloads.php?product_id=' . $product_id . '&filename=' . $file['products_file'] . $order_id_str,
                'products_file_size' => convert_filesize(filesize('images/downloads/' . $product_id . '/' . $file['products_file'])),
            ];
        }
    }

    return $product_downloads;
}

/**Check if it is electronic product or not
 * if is - files to download in product will be accessible only after payment
 * @param $product_id
 * @return mixed|string
 */
function tep_is_download_product($product_id)
{
    $is_download_product_query = tep_db_query("SELECT is_download_product FROM " . TABLE_PRODUCTS . " WHERE products_id = " . $product_id);
    $row = tep_db_fetch_array($is_download_product_query);

    return $row['is_download_product'];

}

function tep_get_product_to_order($product_id, $order_id, $customer_id)
{
    global $languages_id;
    $sql = "SELECT o.orders_id, o.customers_id, s.downloads_flag, op.products_id
                                  FROM orders o
                                  LEFT JOIN orders_status s ON o.orders_status = s.orders_status_id
                                  LEFT JOIN orders_products op ON o.orders_id = op.orders_id
                                  WHERE s.language_id = '" . $languages_id . "' 
                                  AND o.orders_id = '" . $order_id . "' 
                                  AND s.downloads_flag = 1
                                  AND op.products_id = '" . $product_id . "'
                                  AND o.customers_id = '" . $customer_id . "'
                                  ORDER BY o.orders_id DESC";
    $orders_query = tep_db_query($sql);
    return $orders_query;
}

// begin mod for ProductsProperties v2.01
function tep_get_prop_options_name($options_id, $language = '')
{
    global $languages_id;

    if (empty($language)) {
        $language = $languages_id;
    }

    $options = tep_db_query("select products_options_name from " . TABLE_PRODUCTS_PROP_OPTIONS . " where products_options_id = " . (int)$options_id . " and language_id = " . (int)$languages_id);
    $options_values = tep_db_fetch_array($options);

    return $options_values['products_options_name'];
}

function tep_get_languages_id($code)
{
    global $languages_id;
    $language_query = tep_db_query("select languages_id from " . TABLE_LANGUAGES . " where code = '" . tep_db_prepare_input(DEFAULT_LANGUAGE) . "'");
    if (tep_db_num_rows($language_query)) {
        $language = tep_db_fetch_array($language_query);
        $languages_id = $language['languages_id'];
        return $language['languages_id'];
    } else {
        return false;
    }
}

// Select options show countries

/* One Page Checkout - BEGIN*/
function tep_cfg_pull_down_zone_list_one_page($zone_id)
{
    return tep_draw_pull_down_menu('configuration_value', tep_get_country_zones(STORE_COUNTRY), $zone_id);
}

/* One Page Checkout - END*/


/* DEBUG function */

function debug($data, $type = false)
{
    if ($type) {
        echo "<pre class='debug print_r'>";
        echo print_r($data);
        echo "</pre>";
    } else {
        echo "<pre class='debug var_dump'>";
        echo var_dump($data);
        echo "</pre>";
    }

    return true;
}

function tep_cut($str, $limit)
{
    if (strlen($str) > $limit) {
        $str = mb_substr($str, 0, $limit + 1); // +1 in case if $limit is between words
        return substr($str, 0, strrpos($str, ' '));
    } else {
        return $str;
    }
}

function getCategoryTree()
{
    $sql = "SELECT
                  `c`.`categories_id`    AS `id`,
                  `c`.`parent_id`,
                   cd.categories_name,
                   c.categories_icon,
                   c.categories_image,
                   c.categories_robots_status,
                  (select count(*) as cnt from categories cc left join categories_description cd on cd.categories_id = cc.categories_id where  cc.parent_id = `c`.`categories_id` and cc.categories_status='1' and cd.language_id={$_SESSION['languages_id']}) as childs
                FROM `categories` `c`, categories_description cd                           
                where c.categories_id = cd.categories_id and c.categories_status='1' and cd.language_id=" . (int)$_SESSION['languages_id'] . "
                ORDER BY c.sort_order, cd.categories_name";
    return $sql;
}

function getCategoryTreeAllStatuses() {
    $sql = "SELECT `c`.`categories_id` AS `id`,`c`.`parent_id`, (select count(*) as cnt from categories cc where  cc.parent_id = `c`.`categories_id`) as childs
            FROM `categories` `c`
            where 1";
    return $sql;
}

function getCatSeoUrl()
{
    global $cat_icons,$cat_urls_array, $cPaths, $lng;

    if ($cat_icons) {
        $categoriesIds = array_keys($cat_icons);
        $categoriesIdsList = tep_db_prepare_input(implode(',', $categoriesIds));

        $sql = "SELECT `c`.`categories_id` AS `id`, `c`.`parent_id`, cd.categories_name, cd.categories_seo_url, cd.language_id 
            FROM categories c 
            left join categories_description cd on c.categories_id = cd.categories_id 
            where c.categories_id in ($categoriesIdsList)";

        $query = tep_db_query($sql);
        $cat_urls_array = [];
        foreach ($lng->catalog_languages as $language) {
            $cat_urls_array[$language['id']][0] = ['all','all',0];
        }
        while ($row = tep_db_fetch_array($query)) {
            $cat_urls_array[$row['language_id']][$row['id']] = array($row['categories_seo_url'],$row['categories_name'],$row['parent_id']);
            //   $cPathWithLanguages[$row['language_id']][$row['id']]['seourl'] = $row['categories_seo_url'];
        }
    }
}

function setTree($exclude = '', $parent_cat = 0)
{
    $result = [];
    $sql = tep_db_query(getCategoryTree());
    while ($row = tep_db_fetch_array($sql)) {
        $result[$row['id']] = $row;
    }
    $result = mapTree($result, $exclude, $parent_cat);
    $result = checkMapTree($result);
    return $result;
}

function getAllTree($exclude = '', $parent_cat = 0) {
    $result = [];
    $sql = tep_db_query(getCategoryTreeAllStatuses());
    while ($row = tep_db_fetch_array($sql)) {
        $result[$row['id']] = $row;
    }
    $result = mapTreeCustom($result, $exclude, $parent_cat);
    $result = checkMapTree($result);
    return $result;
}

function checkIsCategoriesActive($pCategories, $cPathTree){
    if(!is_array($pCategories)){
        return false;
    }
    foreach ($pCategories as $categoryId){
        if(!key_exists($categoryId,$cPathTree)){
            return false;
        }
    }
    return true;
}
//checking is all elements are not empty
function checkMapTree($data)
{
    if (is_array($data)) {
        foreach ($data as $key => &$item) {
            if (is_array($item)) {
                if (!empty($item)) {
                    checkMapTree($item);
                } else {
                    $item = $key;
                }
            }
        }
    }

    return $data;
}

function mapTree($dataset, $exclude = '', $parent_cat = 0)
{
    global $cat_names, $cat_icons, $cat_imgs, $cat_robots_status, $cat_urls_array;
    $tree = array();
    foreach ($dataset as $id => &$node) {
        $cat_names[$node['id']] = $node['categories_name'];  // array id-name
        $cat_imgs[$node['id']] = $node['categories_image'];  // array id-image
        $cat_icons[$node['id']] = $node['categories_icon'];  // array id-icon
        $cat_robots_status[$node['id']] = $node['categories_robots_status'];  // array id-robots_status
//        $cat_urls_array[$node['id']] = array($node['categories_seo_url'],$node['categories_name'],$node['parent_id']); // array id-seo url

        $parent_id = $node['parent_id'];
        $childs = $node['childs'];

        unset($node['parent_id']);
        unset($node['id']);
        unset($node['childs']);
        unset($node['categories_name']);
        unset($node['categories_image']);
        unset($node['categories_icon']);
        unset($node['categories_description']);
        unset($node['categories_robots_status']);

        if ($parent_id == $parent_cat && $id != $exclude) {
            if ($childs) {
                $tree[$id] =& $node;
            } else {
                $tree[$id] = $id;
            }
        } elseif ($exclude && ($parent_id == $exclude || $id == $exclude)) {
            continue;
        } elseif (isset($dataset[$parent_id])) {
            if ($childs) {
                $dataset[$parent_id][$id] =& $node;
            } else {
                $dataset[$parent_id][$id] = $id;
            }
        } else {
            unset($cat_names[$id]);
            unset($cat_imgs[$id]);
            unset($cat_icons[$id]);
            unset($cat_robots_status[$id]);
        }
    }
    return $tree;
}

function mapTreeCustom($dataset, $exclude = '', $parent_cat = 0) {
    $tree = array();
    foreach ($dataset as $id => &$node) {
        $parent_id = $node['parent_id'];
        $childs = $node['childs'];
        
        unset($node['parent_id']);
        unset($node['id']);
        unset($node['childs']);
        if ($parent_id == $parent_cat && $id != $exclude) {
            if($childs){
                $tree[$id] =& $node;
            } else {
                $tree[$id] = $id;
            }
        } elseif($exclude && ($parent_id == $exclude || $id == $exclude)) {
            continue;
        } elseif(isset($dataset[$parent_id])) {
            if($childs){
                $dataset[$parent_id][$id] =& $node;
            } else {
                $dataset[$parent_id][$id] = $id;
            }
        }
    }
    return $tree;
}

function tep_get_categories_urls()
{
    global $cat_names, $cat_urls, $seo_urls, $cat_urls_array, $cPaths, $promUrls, $languages_id;

    if ($cat_urls_array) {
        foreach ($cat_urls_array as $lang_id => $urls) {
            foreach ($urls as $id => &$node) {
                if (!empty($node[0])) {
                    $cat_url = $node[0];
                } else {
                    if (!empty($node[1])) {
                        $cat_url = $seo_urls->strip($node[1]);
                    } else {
                        $cat_url = '-';
                    }
                    tep_db_query("update " . TABLE_CATEGORIES_DESCRIPTION . " set categories_seo_url = '" . tep_db_prepare_input($cat_url) . "' where language_id = " . (int)$lang_id . " and categories_id = " . (int)$id);
                }

                // add parent url:
                if ($seo_urls->attributes['SEO_ADD_CAT_PARENT'] == 'true') {
                    if ($node[2] != 0) {
                        if (!empty($cat_urls_array[$lang_id][$node[2]][0])) {
                            $par_url = $cat_urls_array[$lang_id][$node[2]][0];
                            $cat_url = $par_url . '-' . $cat_url;
                        } else {
                            $par_url = $cat_names[$node[2]];
                            $cat_url = $seo_urls->strip($par_url . ' ' . $cat_url);
                        }
                    }
                }
                if ($promUrls) {
                    $cat_urls[$lang_id][$id] = 'g' . $id . '-' . $cat_url;
                } else {
                    $categoryIdPrefix = getConstantValue('SEO_ADD_SLASH_BEFORE_CATEGORY_ID', 'true') == 'true' ? '/c-' : '-c-';
                    $cat_urls[$lang_id][$id] = $cat_url . $categoryIdPrefix . $cPaths[$id] . '.html';
                }
            }
        }
    }
    $q = 1;
}


function check_subcategories($tree, $current_category_id)
{
    if (is_array($tree)) {
        foreach ($tree as $key => $val) {
            if ($key == $current_category_id) {
                return $val;
            } else {
                $a = check_subcategories($val, $current_category_id);
                if ($a) {
                    return $a;
                }
            }
        }
    }
}

function tep_get_subcategories_tree($cat_tree, $current_category_id)
{
    global $cat_names, $cat_imgs;



    $subcat_tree = check_subcategories($cat_tree, $current_category_id);

    if (is_array($subcat_tree) and !empty($subcat_tree)) {
        //if ($subcat_tree = setTree('', $current_category_id)) {   //new function setTree
        $subcat_array = array();
        foreach ($subcat_tree as $cid => $cname) {
            $subcat_array[$cid]['url'] = tep_href_link(FILENAME_DEFAULT, 'cPath=' . $cid, 'NONSSL');
            $subcat_array[$cid]['name'] = $cat_names[$cid];
            if (isset($cat_imgs[$cid]) && $cat_imgs[$cid]) {
                if (pathinfo($cat_imgs[$cid], PATHINFO_EXTENSION) === 'svg') {
                    $img_path = 'images/categories/' . $cat_imgs[$cid];
                } else {
                    $img_path = 'getimage/240x240/categories/' . $cat_imgs[$cid];
                }
                $subcat_array[$cid]['img'] =  '<img alt="' . $cat_names[$cid] . '" src="' . $img_path . '">';
            } // show image

            //subsubcategories:
            if (is_array($cname)) {
                foreach ($cname as $cname_id => $cname_name) {
                    $subcat_array[$cid]['subcats'][$cname_id]['url'] = tep_href_link(FILENAME_DEFAULT, 'cPath=' . $cname_id, 'NONSSL');
                    $subcat_array[$cid]['subcats'][$cname_id]['name'] = $cat_names[$cname_id];
                }
            }
        }
        return $subcat_array;
    }
}

// --------------- ATTRIBUTES COUNTER IN FILTER ----------------------------- //

function find_counts($find_counts_array)
{
    if (!empty($find_counts_array)) {
        $length = count($find_counts_array); // quantity of all selected attributes
        $find_counts_array = call_user_func_array("array_merge", $find_counts_array); // merge all subarrays to one array

        $count_values = array_count_values($find_counts_array);
        $total_array = array();

        foreach ($count_values as $id => $count) {
            if ($count == $length) {
                $total_array[] = $id; // $length - there must be exactly as many matches as there are different attributes selected.
            }
        }

        return count($total_array);
    } else {
        return 0;
    }
}

// --------------- ATTRIBUTES COUNTER IN FILTER --END------------------------ //

function _bot_detected()
{

    return (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/bot|crawl|slurp|spider|Chrome-Lighthouse/i', $_SERVER['HTTP_USER_AGENT']));
}

function fixObject(&$object)
{
    if (!is_object($object) && gettype($object) == 'object') {
        return ($object = unserialize(serialize($object)));
    }
    return $object;
}

function clear_order_sessions($insert_id)
{
    global $wishList, $cart, $payment_modules, $paymentMethod;

    // load the after_process function from the payment modules
    //if(!is_null($payment_modules)) $payment_modules->after_process();
    if (!is_null($GLOBALS[$paymentMethod])) {
        $GLOBALS[$paymentMethod]->after_process();
    }

    if (is_object($wishList)) {
        $wishList->clear();
    }
    if (is_object($cart)) {
        $cart->reset(true);
    }
    // unregister session variables used during checkout
    tep_session_unregister('sendto');
    tep_session_unregister('billto');
    tep_session_unregister('shipping');
    tep_session_unregister('payment');
    tep_session_unregister('comments');
    tep_session_unregister('cart_payment_id');
    tep_session_unregister('check_order_status');
    tep_session_unregister('callback');
    $_SESSION['allowCheckoutSuccessPageId'] = (int)$insert_id;
    tep_redirect(addHostnameToLink(tep_href_link(FILENAME_CHECKOUT_SUCCESS, 'order_id=' . (int)$insert_id)));
}

function get_custom_favicon()
{
    global $headers_mainpage;

    if (defined('FAVICON_IMAGE') and !is_null(FAVICON_IMAGE) and !empty(FAVICON_IMAGE)) {
        $favicon .= '<link rel="shortcut icon" href="' . FAVICON_IMAGE . '">';
    } elseif (!empty($headers_mainpage['articles_image']) and file_exists(DIR_WS_IMAGES . '' . $headers_mainpage['articles_image'])) {
        $favicon .= '<link rel="shortcut icon" href="' . DIR_WS_IMAGES . '' . $headers_mainpage['articles_image'] . '">';
    } else {
        $favicon .= '<link rel="shortcut icon" href="/favicon.ico">';
    }

    return "\n\n\t" . $favicon;
}

function get_rel_prevnext()
{
    global $listing_split,$m_srch_action;

    if ($listing_split->number_of_pages > 1) {
        if ($listing_split->current_page_number == 1) {
            $prevnext .= '<link rel="next" href="' . addHostnameToLink(tep_href_link(FILENAME_DEFAULT, $m_srch_action . '&page=2', 'NONSSL')) . '">';
        } elseif ($listing_split->current_page_number == 2) {
            $prevnext .= '<link rel="prev" href="' . addHostnameToLink(tep_href_link(FILENAME_DEFAULT, $m_srch_action, 'NONSSL')) . '">' . "\n\t";
            if ($listing_split->number_of_pages >= $listing_split->current_page_number + 1) {
                $prevnext .= '<link rel="next" href="' . addHostnameToLink(tep_href_link(FILENAME_DEFAULT, $m_srch_action . '&page=' . ($listing_split->current_page_number + 1), 'NONSSL')) . '">';
            }
        } elseif ($listing_split->number_of_pages == $listing_split->current_page_number) {
            $prevnext .= '<link rel="prev" href="' . addHostnameToLink(tep_href_link(FILENAME_DEFAULT, $m_srch_action . '&page=' . ($listing_split->current_page_number - 1), 'NONSSL')) . '">';
        } else {
            $prevnext .= '<link rel="prev" href="' . addHostnameToLink(tep_href_link(FILENAME_DEFAULT, $m_srch_action . '&page=' . ($listing_split->current_page_number - 1), 'NONSSL')) . '">' . "\n\t";
            if ($listing_split->number_of_pages >= $listing_split->current_page_number + 1) {
                $prevnext .= '<link rel="next" href="' . addHostnameToLink(tep_href_link(FILENAME_DEFAULT, $m_srch_action . '&page=' . ($listing_split->current_page_number + 1), 'NONSSL')) . '">';
            }
        }
    }

    return "\n\t" . $prevnext;
}

function get_rel_alternate()
{
    global $lng, $PHP_SELF, $skipValidation, $isFilter, $cat_urls, $current_category_id;

    if ($isFilter) {
        get_rel_alternate_seo_filters();
    } else {
        $filename = $PHP_SELF;
        if (strstr($PHP_SELF, "/price.php")) {
            $filename = "/sitemap.html";
        } elseif (strstr($PHP_SELF, "/allcomments.php")) {
            $filename = "/allcomments.html";
        } elseif (strstr($PHP_SELF, "/manufacturers.php")) {
            $filename = "/brands";
        }
        $skipValidation = true;
        if (count($lng->catalog_languages) > 1) {
            // show all parameters except cPath:
            $parameters = tep_get_all_get_params(['language', 'currency', 'row_by_page', 'cPath', 'products_id']);
            $new_parameters = explode('&', $parameters);
            $parameters = implode('&', array_filter($new_parameters));
            if (!empty($parameters)) {
                $parameters = '?' . $parameters;
            }
            $alternate = '';
            if (strstr($PHP_SELF, "/product_info.php")) { // product page:
                $productIdPrefix = getConstantValue('SEO_ADD_SLASH_BEFORE_PRODUCT_ID', 'true') == 'true' ? '/p-' : '-p-';
                $productAlternatesQuery = tep_db_query("SELECT pd.products_url, l.code 
                                                        FROM products_description pd 
                                                   LEFT JOIN languages l ON pd.language_id = l.languages_id
                                                   WHERE pd.products_id = " . (int)$_GET['products_id'] . "
                                                   ORDER BY l.sort_order");
                while ($productAlternates = tep_db_fetch_array($productAlternatesQuery)) {
                    if ($productAlternates['code'] == DEFAULT_LANGUAGE) {
                        $languageCode = '';
                        // default language:
                        $alternate .= "\n\t" . '<link rel="alternate" href="' . addHostnameToLink($languageCode . $productAlternates['products_url'] . $productIdPrefix . $_GET['products_id'] . '.html' . $parameters) . '" hreflang="x-default" />';
                    } else {
                        $languageCode = $productAlternates['code'] . '/';
                    }
                    // all languages:
                    $alternate .= "\n\t" . '<link rel="alternate" href="' . addHostnameToLink($languageCode . $productAlternates['products_url'] . $productIdPrefix . $_GET['products_id'] . '.html' . $parameters) . '" hreflang="' . $productAlternates['code'] . '" />';
                }
            } elseif (strstr($PHP_SELF, FILENAME_DEFAULT) and !empty($_GET['cPath'])) { // categories page:
                foreach ($lng->catalog_languages as $hreflang => $language_info) {
                    if ($hreflang == DEFAULT_LANGUAGE) {
                        $languageCode = '';
                        // default language:
                        $alternate .= "\n\t" . '<link rel="alternate" href="' . addHostnameToLink($languageCode . $cat_urls[$language_info['id']][$current_category_id]) . $parameters . '" hreflang="x-default" />';
                    } else {
                        $languageCode = $hreflang . '/';
                    }
                    // all languages:
                    $alternate .= "\n\t" . '<link rel="alternate" href="' . addHostnameToLink($languageCode . $cat_urls[$language_info['id']][$current_category_id]) . $parameters . '" hreflang="' . $hreflang . '" />';
                }
            } else {
                //other pages:

                // default language:
                $alternate = "\n\n\t" . '<link rel="alternate" href="' . addHostnameToLink(tep_href_link(DEFAULT_LANGUAGE . '/' . basename($filename), tep_get_all_get_params(['language', 'currency', 'row_by_page']))) . '" hreflang="x-default" />';
                // other languages:

                foreach ($lng->catalog_languages as $hreflang => $language_info) {
                    $alternate .= "\n\t" . '<link rel="alternate" href="' . addHostnameToLink(tep_href_link($hreflang . '/' . basename($filename), tep_get_all_get_params(['language', 'currency', 'row_by_page']))) . '" hreflang="' . $hreflang . '" />';
                }
            }

            return $alternate . "\n";
        }
        unset($skipValidation);
    }
}

function get_rel_alternate_seo_filters()
{

    global $lng, $PHP_SELF,$redirectOptionsIdsArrayForCheck, $setAlternate, $addPage, $removeParams;
    $setAlternate = $removeParams = $addPage = true;
    if (count($lng->catalog_languages) > 1) {
        // default language:
        $url = HTTP_SERVER . getFilterUrl($_GET['cPath'], (isset($_GET['filter_id']) ? $_GET['filter_id'] : ''), $redirectOptionsIdsArrayForCheck);
        $alternate = "\n\n\t" . '<link rel="alternate" href="' . $url . '" hreflang="x-default" />';
        // other languages:
        foreach ($lng->catalog_languages as $hreflang => $language_info) {
            $langUrl = HTTP_SERVER . getFilterUrl($_GET['cPath'], (isset($_GET['filter_id']) ? $_GET['filter_id'] : ''), $redirectOptionsIdsArrayForCheck, $hreflang, $language_info['id']);
            $alternate .= "\n\t" . '<link rel="alternate" href="' . $langUrl . '" hreflang="' . $hreflang . '" />';
        }

        $setAlternate = $removeParams = $addPage = false;
        return $alternate . "\n";
    }
}
function get_canonical()
{
    global $content, $m_srch_action, $lng, $language, $redirectUrl, $isFilter, $addPage, $redirectOptionsIdsArrayForCheck, $setAlternate, $removeParams;

    //if ($_GET['display']!='' or $_GET['sort']!='' or $_GET['filter_id']!='' or $_GET['page']!='') {

    if ($content == 'index_default') {
        echo "\n\t" . '<link rel="canonical" href="' . addHostnameToLink(DEFAULT_LANGUAGE != $lng->language['code'] ? (tep_href_link()) : HTTP_SERVER) . '"/>';
    } elseif ($isFilter) {
        $setAlternate = $removeParams = $addPage = true;
        echo "\n\t" . '<link rel="canonical" href="' . HTTP_SERVER . getFilterUrl($_GET['cPath'], (isset($_GET['filter_id']) ? $_GET['filter_id'] : ''), $redirectOptionsIdsArrayForCheck) . '"/>';
        $setAlternate = $removeParams = $addPage = false;
    } elseif ($content == 'index_products') {
        $tempMSearchAction = $m_srch_action;
        if ($tempMSearchAction == 'index.php' && !empty($_GET['keywords'])) {
            $tempMSearchAction = 'keywords=' . $_GET['keywords'];
        }
        if (!empty($_GET['page']) && $_GET['page'] > 1) {
            $tempMSearchAction = $m_srch_action . (!empty($m_srch_action) ? "&" : "") . "page=" . $_GET['page'];
        }
        echo "\n\t" . '<link rel="canonical" href="' . addHostnameToLink(tep_href_link(FILENAME_DEFAULT, $tempMSearchAction)) . '"/>';
    } elseif ($content == 'product_info') {
        echo "\n\t" . '<link rel="canonical" href="' . addHostnameToLink(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_GET['products_id'])) . '"/>';
    } elseif ($content == 'article_info') {
        $url = parse_url($_SERVER['REQUEST_URI']);
        $url = $url['path'];
        echo "\n\t" . '<link rel="canonical" href="' . HTTP_SERVER . $url . '"/>';
    } elseif ($content == 'contact_us') {
        $url = parse_url($_SERVER['REQUEST_URI']);
        $url = rtrim($url['path'], '/');
        echo "\n\t" . '<link rel="canonical" href="' . HTTP_SERVER . $url . '"/>';
    }
}

function get_noindex_nofollow()
{
    global $tPath, $manufacturers_array, $cPath, $cat_robots_status, $current_category_id, $checkFilterRobots;

    $disallowRobots = false;

    //article`s page
    if (!empty($tPath)) {
        //check topic`s robots param
        $topicQuery = tep_db_query("select t.robots_status from  " . TABLE_TOPICS . " t where t.topics_id = " . (int)$tPath);
        if (tep_db_fetch_array($topicQuery)['robots_status'] == 0) {
            $disallowRobots = true;
        }
        //check article`s robots param
        if (!empty($_GET['articles_id']) && $disallowRobots == false) {
            $articleQuery = tep_db_query("select a.articles_robots_status from " . TABLE_ARTICLES . " a where a.articles_id = " . (int)$_GET['articles_id']);
            if (tep_db_fetch_array($articleQuery)['articles_robots_status'] == 0) {
                $disallowRobots = true;
            }
        }
    }

    //manufacturer`s (listing) page
    if (
        isset($_GET['manufacturers_id']) && $disallowRobots == false
        && isset($manufacturers_array[(int)$_GET['manufacturers_id']]['robots_status'])
        && $manufacturers_array[(int)$_GET['manufacturers_id']]['robots_status'] == 0
    ) {
        $disallowRobots = true;
    }

    if (!empty($cPath) && $disallowRobots == false) {
        if (!empty($_GET['products_id'])) {
            //product`s (info) page
            //check product`s robots param
            $productQuery = tep_db_query("select p.products_robots_status from " . TABLE_PRODUCTS . " p where p.products_id = " . (int)$_GET['products_id']);
            if (tep_db_fetch_array($productQuery)['products_robots_status'] == 0) {
                $disallowRobots = true;
            }
        } else {
            //category`s (listing) page
            //check category`s robots param
            if (isset($cat_robots_status[$current_category_id]) && $cat_robots_status[$current_category_id] == 0) {
                $disallowRobots = true;
            }
        }
    }

    if (
        $disallowRobots or $checkFilterRobots
        or $_SERVER['REQUEST_URI'] == '/password_forgotten.php'
        or $_SERVER['REQUEST_URI'] == '/login.php'
        or $_SERVER['REQUEST_URI'] == '/create_account.php'
        or $_SERVER['REQUEST_URI'] == '/checkout.php'
        or $_SERVER['REQUEST_URI'] == '/wishlist.php'
        or (isset($robotsNoindex) && $robotsNoindex === true)
        or (defined('ROBOTS_TXT') and ROBOTS_TXT == 'false')
    ) {
        echo '<meta name="robots" content="noindex, nofollow" />';
    }
}

function prodToCat()
{
    global $catProductCounter, $activeProducts, $catToProd, $cat_icons;
    $sql = "SELECT p2c.`categories_id`,p2c.`products_id` FROM " . TABLE_PRODUCTS_TO_CATEGORIES . " `p2c`";
    $query = tep_db_query($sql);
    $prodToCat = [];
    $prodToCatAll = [];
    if (!empty($activeProducts) && $query->num_rows) {
        $active_categories = $cat_icons ? array_keys($cat_icons) : [];
        $activeCategories = array_flip($active_categories);
        while ($item = tep_db_fetch_array($query)) {
            if (isset($activeCategories[$item['categories_id']])) {
                $prodToCatAll[$item['products_id']][] = $item['categories_id'];
                $catToProd[$item['categories_id']][] = $item['products_id'];
            }
        }
        $prodToCatAll = array_intersect_key($prodToCatAll, $activeProducts);
        foreach ($prodToCatAll as $prod_id => $cid_array) {
            $prodToCat[$prod_id] = $cid_array[0];
            foreach ($cid_array as $cid) {
                $catProductCounter[$cid] += 1;
            }
        }
    }
    return $prodToCat;
}

/*
function prodToCat() {
    global $catProductCounter;
    $sql = "SELECT p2c.`categories_id`,p2c.`products_id` FROM " . TABLE_PRODUCTS_TO_CATEGORIES . " `p2c`
            LEFT JOIN " . TABLE_PRODUCTS . " `p` ON `p`.`products_id` = `p2c`.`products_id`
            WHERE `p`.`products_status` = 1";
    $query = tep_db_query($sql);
    $prodToCat = [];
    if ($query->num_rows) {
        while ($item = tep_db_fetch_array($query)) {
            $prodToCat[$item['products_id']] = $item['categories_id'];
            $catProductCounter[$item['categories_id']] += 1;
        }
    }
    return $prodToCat;

}
 */

function countCategoryProductsRecursive($category, $counter = 0, $parent = 0)
{
    global $catProductCounter;

    if (is_array($category)) {
        $counter += $catProductCounter[$parent]; // if we have products AND subcategories in same time
        foreach ($category as $key => $cat) {
            $counter = countCategoryProductsRecursive($cat, $counter, $key);
        }
    } else {
        $counter += $catProductCounter[$category];
    }

    return $counter;
}

function countAllCategoryProductsRecursive()
{
    global $cat_list, $cat_names;

    if (is_array($cat_names)) {
        foreach ($cat_names as $cid => $name) {
            if (is_array($cat_list[$cid])) {
                $catProductCounter_ready[$cid] = countCategoryProductsRecursive($cat_list[$cid], 0, $cid);
            } else {
                $catProductCounter_ready[$cid] = countCategoryProductsRecursive($cid);
            }
        }
    }

    return $catProductCounter_ready;
}

function countProdToManufacturers()
{
    global $manufacturersToProductsId, $activeProducts, $productsIdToManufacturers;
    $sql = "select manufacturers_id, products_id, products_date_added from products where products_status = 1";
    $query = tep_db_query($sql);
    $prodToManufacturers = [];
    $activeProducts = [];
    if ($query->num_rows) {
        while ($item = tep_db_fetch_array($query)) {
            $activeProducts[$item['products_id']] = $item['products_date_added'];
            $prodToManufacturers[$item['manufacturers_id']] = isset($prodToManufacturers[$item['manufacturers_id']]) ? ++$prodToManufacturers[$item['manufacturers_id']] : 1;
            $manufacturersToProductsId[$item['manufacturers_id']] [] = $item['products_id'];
            $productsIdToManufacturers[$item['products_id']] = $item['manufacturers_id'];
        }
    }
    return $prodToManufacturers;
}

if (!function_exists("array_column")) {

    function array_column($array, $column_name)
    {

        return array_map(function ($element) use ($column_name) {
            return $element[$column_name];
        }, $array);
    }

}
function getTabs($getimage = false, $dimensions = '300x300')
{
    global $languages_id, $customer_price, $all_active_cats, $activeProducts, $template;
    $tabs = [];

    //get image:
    if ($getimage) {
        $tpl_settings = array('disable_listing' => true,'orderby' => 'rand()','limit' => '1');
        include(DIR_WS_MODULES . 'new_products.php');
        $tabs['new']['image'] = 'getimage/' . $dimensions . '/products/' . explode(';', tep_db_fetch_array($module_products)['products_image'])[0];
        include(DIR_WS_MODULES . 'featured.php');
        $tabs['featured']['image'] = 'getimage/' . $dimensions . '/products/' . explode(';', tep_db_fetch_array($featured)['products_image'])[0];
        include(DIR_WS_MODULES . 'default_specials.php');
        $tabs['specials']['image'] = 'getimage/' . $dimensions . '/products/' . explode(';', tep_db_fetch_array($specials)['products_image'])[0];
    }

    // get totals:
    $tpl_settings = array('disable_listing' => true);
    include(DIR_WS_MODULES . 'featured.php');
    include(DIR_WS_MODULES . 'default_specials.php');
    //only for module new_products
    $config = $template->checkConfig('MAINPAGE', 'M_NEW_PRODUCTS');
    $tpl_settings['limit'] = (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 8);
    include(DIR_WS_MODULES . 'new_products.php');

    $tabs['new']['filename'] = 'new_products';
    $tabs['new']['title'] = BOX_HEADING_WHATS_NEW;
    $tabs['new']['total'] = $module_products->num_rows;

    $tabs['featured']['filename'] = 'featured';
    $tabs['featured']['title'] = BOX_HEADING_FEATURED;
    $tabs['featured']['total'] = $featured->num_rows;

    $tabs['specials']['filename'] = 'default_specials';
    $tabs['specials']['title'] = BOX_HEADING_SPECIALS;
    $tabs['specials']['total'] = $specials->num_rows;

    return $tabs;
}
function getTabsHome($getimage = false, $dimensions = '300x300')
{
    global $languages_id, $customer_price, $all_active_cats, $activeProducts;
    $tabs = [];

    //get image:
    if ($getimage) {
        $tpl_settings = array('disable_listing' => true,'orderby' => 'rand()','limit' => '1');
        include(DIR_WS_MODULES . 'best_sellers.php');
        include(DIR_WS_MODULES . 'new_products.php');
        include(DIR_WS_MODULES . 'default_specials.php');

        $tabs['best_sellers']['image'] = 'getimage/' . $dimensions . '/products/' . explode(';', tep_db_fetch_array($best_sellers)['products_image'])[0];
        $tabs['new_products']['image'] = 'getimage/' . $dimensions . '/products/' . explode(';', tep_db_fetch_array($module_products)['products_image'])[0];
        $tabs['specials']['image'] = 'getimage/' . $dimensions . '/products/' . explode(';', tep_db_fetch_array($specials)['products_image'])[0];
    }

    // get totals:
    $tpl_settings = array('disable_listing' => true);
    include(DIR_WS_MODULES . 'best_sellers.php');
    include(DIR_WS_MODULES . 'new_products.php');
    include(DIR_WS_MODULES . 'default_specials.php');

    $tabs['best_sellers']['filename'] = 'best_sellers';
    $tabs['best_sellers']['title'] = MAIN_BESTSELLERS;
    $tabs['best_sellers']['total'] = $best_sellers->num_rows;

    $tabs['new_products']['filename'] = 'new_products';
    $tabs['new_products']['title'] = BOX_HEADING_WHATS_NEW;
    $tabs['new_products']['total'] = $module_products->num_rows;

    $tabs['specials']['filename'] = 'default_specials';
    $tabs['specials']['title'] = HOME_BOX_HEADING_SELL_OUT;
    $tabs['specials']['total'] = $specials->num_rows;
    return $tabs;
}
function getTemplates()
{
    $sql = "SELECT template_name,template_description FROM " . TABLE_TEMPLATE;
    $query = tep_db_query($sql);
    $output = [];
    while ($row = tep_db_fetch_array($query)) {
        $output[] = [
            'id' => $row['template_name'],
            'text' => $row['template_description']
        ];
    }
    return $output;
}
function isValidTemplateName($template_name)
{
    $sql = tep_db_query("SELECT template_name FROM template");
    $templates = [];
    while ($row = tep_db_fetch_array($sql)) {
        $templates[] = $row['template_name'];
    }
    return in_array($template_name, $templates);
}

if (!function_exists('tep_date_raw')) {

    function tep_date_raw($date, $reverse = false)
    {
        if ($reverse) {
            return substr($date, 3, 2) . substr($date, 0, 2) . substr($date, 6, 4);
        } else {
            return substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2);
        }
    }
}
if (!function_exists('tep_date_long_translate')) {

    function tep_date_long_translate($date_string)
    {
        $eng = [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday",
            "Sunday",
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
            "Mon",
            "Tue",
            "Wed",
            "Thu",
            "Fri",
            "Sat",
            "Sun"
        ];
        $loc = [
            TEXT_DAY_1,
            TEXT_DAY_2,
            TEXT_DAY_3,
            TEXT_DAY_4,
            TEXT_DAY_5,
            TEXT_DAY_6,
            TEXT_DAY_7,
            TEXT_MONTH_1,
            TEXT_MONTH_2,
            TEXT_MONTH_3,
            TEXT_MONTH_4,
            TEXT_MONTH_5,
            TEXT_MONTH_6,
            TEXT_MONTH_7,
            TEXT_MONTH_8,
            TEXT_MONTH_9,
            TEXT_MONTH_10,
            TEXT_MONTH_11,
            TEXT_MONTH_12,
            TEXT_DAY_SHORT_1,
            TEXT_DAY_SHORT_2,
            TEXT_DAY_SHORT_3,
            TEXT_DAY_SHORT_4,
            TEXT_DAY_SHORT_5,
            TEXT_DAY_SHORT_6,
            TEXT_DAY_SHORT_7,
        ];

        return str_replace($eng, $loc, $date_string);
    }
}
if (!function_exists('tep_date_long_translate_base')) {

    function tep_date_long_translate_base($date_string)
    {
        $eng = [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday",
            "Sunday",
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
            "Mon",
            "Tue",
            "Wed",
            "Thu",
            "Fri",
            "Sat",
            "Sun"
        ];
        $loc = [
            TEXT_DAY_1,
            TEXT_DAY_2,
            TEXT_DAY_3,
            TEXT_DAY_4,
            TEXT_DAY_5,
            TEXT_DAY_6,
            TEXT_DAY_7,
            TEXT_MONTH_BASE_1,
            TEXT_MONTH_BASE_2,
            TEXT_MONTH_BASE_3,
            TEXT_MONTH_BASE_4,
            TEXT_MONTH_BASE_5,
            TEXT_MONTH_BASE_6,
            TEXT_MONTH_BASE_7,
            TEXT_MONTH_BASE_8,
            TEXT_MONTH_BASE_9,
            TEXT_MONTH_BASE_10,
            TEXT_MONTH_BASE_11,
            TEXT_MONTH_BASE_12,
            TEXT_DAY_SHORT_1,
            TEXT_DAY_SHORT_2,
            TEXT_DAY_SHORT_3,
            TEXT_DAY_SHORT_4,
            TEXT_DAY_SHORT_5,
            TEXT_DAY_SHORT_6,
            TEXT_DAY_SHORT_7,
        ];

        return str_replace($eng, $loc, $date_string);
    }
}
function isMobile()
{
    if (isset($_GET['isCriticalMode']) && $_GET['isCriticalMode'] == 'isMobile') {
        return true;//only for critical emulation mobile version
    }
    if (preg_match("/(ipad)/i", $_SERVER["HTTP_USER_AGENT"])) {
        return false;
    } else {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }
}
function get_manufacturer_info($mId)
{
    global $languages_id;
    $manufacturers_sql = "SELECT 
                                `m`.`manufacturers_id`    AS `mid`,
                                `mi`.`manufacturers_name`  AS `name`,
                                `m`.`manufacturers_image` AS `image`
                              FROM " . TABLE_MANUFACTURERS . " `m`
                              JOIN " . TABLE_MANUFACTURERS_INFO . " `mi`
                              on `mi`.`manufacturers_id` = `m`.`manufacturers_id` and `mi`.`languages_id` = " . (int)$languages_id . "
                              WHERE `m`.`status` = '1' and `m`.`manufacturers_id` = " . (int)$mId ;
    $manufacturers_query = tep_db_query($manufacturers_sql);
    return $manufacturers_query->num_rows ? tep_db_fetch_array($manufacturers_query) : [];
}

if (!function_exists('tep_get_category_name')) {
    function tep_get_category_name($category_id, $language_id)
    {
        $category_query = tep_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = " . (int)$category_id . " and language_id = " . (int)$language_id);
        $category = tep_db_fetch_array($category_query);

        return $category['categories_name'];
    }
}

function tep_get_cpath_global($cat_tree, $parents = [])
{
    global $cPaths, $cPathTree;
    if (!isset($cPaths)) {
        $cPaths = [0 => 0];
    }
    if (!isset($cPathTree)) {
        $cPathTree = [0 => 0];
    }

    foreach ($cat_tree as $parent => $child) {
        if (is_array($child)) {
            $currentParents = $parents;
            array_push($currentParents, $parent);
            tep_get_cpath_global($cat_tree[$parent], $currentParents);
            $cPathTree[$parent] = implode('-', $currentParents);
            $cPaths[$parent] = end($currentParents);
        } else {
            $currentParents = $parents;
            array_push($currentParents, $child);
            $cPathTree[$child] = implode('-', $currentParents);
            $cPaths[$child] = end($currentParents);
        }
    }
    return $cPaths;
}

function tep_get_sms_gatename($sms_gatename_id)
{
    $sms_gatenames_array = array();
    $files = glob(DIR_FS_EXT . 'sms/smsgate/*.php');
    $i = 0;
    foreach ($files as $file) {
        $sms_gatenames_array[] = array('id' => $i, 'text' => basename($file, '.php'));
        $i++;
    }

    return $sms_gatenames_array[$sms_gatename_id]['text'];
}

function tep_show_results_categories()
{
    global $listing_sql_raw, $where_subcategories, $all_pids, $cPaths, $PHP_SELF, $prodToCat, $cat_names;

    $listing_sql_raw = str_replace($where_subcategories, '', $listing_sql_raw);
    $listing_sql_raw = tep_get_query_products_info($listing_sql_raw);

    if (is_array($all_pids)) {
        foreach ($all_pids as $pid) {
            $cpath = explode('-', $cPaths[$prodToCat[$pid]]);
            $current_catsss[$cpath[0]] += 1;
        }
    }

    if (is_array($current_catsss)) {
        $allProductsCount = count($all_pids);
        foreach ($current_catsss as $cid => $ccount) {
            if (isset($cat_names[$cid])) {
                $string .= '<div class="clarifying-categories' . ($_GET['cid'] == $cid ? ' search_cat_active' : '') . '" data-id="' . $cid . '">' .
                    $cat_names[$cid] . ' <span>(' . $ccount . ')</span>
                </div>';
            } else {
                $allProductsCount -= $ccount;
            }
        }

        if (!empty($allProductsCount)) {
            $string = '<div class="search_categories"> <a ' . ($_GET['cid'] == '' ? 'class="search_cat_active"' : '') . ' href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('currency', 'language','cid'))) . '">' . SHOW_RESULTS . ' <span>(' . $allProductsCount . ')</span></a>  ' . $string . '</div>';
        }
    }

    return $string;
}

function curl_get_contents($URL)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $URL);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}


function getFilterSeoUrlsList()
{
    $sql = "SELECT m.manufacturers_seo_url as seo_url, m.manufacturers_id 
            FROM manufacturers m 
            WHERE m.status = 1 
              AND m.manufacturers_seo_url != ''";
    $query = tep_db_query($sql);
    $output = [];
    if ($query->num_rows) {
        while ($row = tep_db_fetch_array($query)) {
            $output[$row['manufacturers_id']] = $row['seo_url'];
        }
    }
    return $output;
}
function getOptionSeoUrlsList()
{
    /*
     ALTER TABLE `products_options`
     ADD COLUMN `products_options_seourl` VARCHAR(64) NOT NULL DEFAULT '' AFTER `products_options_name`;
    */
    global $languages_id;
    $sql = "SELECT po.products_options_seourl, po.products_options_id, po.language_id
            FROM products_options po 
            WHERE po.products_options_seourl IS NOT NULL";
    $query = tep_db_query($sql);
    $output = [];
    if ($query->num_rows) {
        while ($row = tep_db_fetch_array($query)) {
            $output[$row['language_id']][$row['products_options_id']] = $row['products_options_seourl'];
        }
    }
    return $output;
}
function getOptionValuesSeoUrlsList()
{
    /*
     ALTER TABLE `products_options_values`
     ADD COLUMN `products_options_values_seourl` VARCHAR(64) NOT NULL DEFAULT '' AFTER `products_options_values_name`;
    */
    global $languages_id, $optionsValuesToOption;
    $sql = "SELECT pov.products_options_values_seourl, pov.products_options_values_id,povtpo.products_options_id, pov.language_id
            FROM products_options_values pov
            INNER JOIN products_options_values_to_products_options povtpo ON pov.products_options_values_id = povtpo.products_options_values_id  
            WHERE pov.products_options_values_seourl IS NOT NULL";
    $query = tep_db_query($sql);
    $output = [];
    if ($query->num_rows) {
        while ($row = tep_db_fetch_array($query)) {
            $optionsValuesToOption[$row['products_options_values_id']] = $row['products_options_id'];
            $output[$row['language_id']][$row['products_options_values_id']] = $row['products_options_values_seourl'];
        }
    }
    return $output;
}
function makeSeoUrlsForOptions()
{
    global $seo_urls;
    $sql = "SELECT po.products_options_name, po.products_options_id, po.language_id 
            FROM products_options po  ";
    $query = tep_db_query($sql);
    $output = [];
    if ($query->num_rows) {
        while ($row = tep_db_fetch_array($query)) {
            $url = $seo_urls->strip($row['products_options_name']);
            if ($url[strlen($url) - 1] == '-') {
                $url = substr($url, 0, -1);
            }
            $output[$row['language_id']][$row['products_options_id']] = "'" . $url . "'";
        }
    }

    if ($output) {
        foreach ($output as $lang_id => $arr) {
            foreach ($arr as $id => $url) {
                tep_db_query("UPDATE products_options 
                            SET products_options_seourl = '" . tep_db_prepare_input($url) . "' 
                            WHERE products_options_id = " . (int)$id . " and language_id = " . (int)$lang_id);
            }
        }
    }
}
function makeSeoUrlsForOptionsValues()
{
    global $seo_urls,$languages_id;
    $sql = "SELECT pov.products_options_values_name, pov.products_options_values_id , pov.language_id
            FROM products_options_values pov
              ";
    $query = tep_db_query($sql);
    $output = [];
    if ($query->num_rows) {
        while ($row = tep_db_fetch_array($query)) {
            $url = $seo_urls->strip($row['products_options_values_name']);
            if ($url[strlen($url) - 1] == '-') {
                $url = substr($url, 0, -1);
            }
            $output[$row['language_id']][$row['products_options_values_id']] = "'" . $url . "'";
        }
    }
    if ($output) {
        foreach ($output as $lang_id => $arr) {
            foreach ($arr as $id => $url) {
                tep_db_query("UPDATE products_options_values 
                            SET products_options_values_seourl = '" . tep_db_prepare_input($url) . "' 
                            WHERE products_options_values_id = " . (int)$id . " and language_id = " . (int)$lang_id);
            }
        }
    }
}

/**
 * @param $id
 * If no products_options_values_seourl generate
 * @return mixed
 */
function makeSeoUrlsForOptionsValue($id, $lngId)
{
    global $seo_urls;
    $sql = "SELECT pov.products_options_values_name, pov.products_options_values_id , pov.language_id
            FROM products_options_values pov
            WHERE products_options_values_id = " . (int)$id . " and language_id = " . (int)$lngId;
    $query = tep_db_query($sql);
    $output = [];
    if ($query->num_rows) {
        while ($row = tep_db_fetch_array($query)) {
            $url = $seo_urls->strip($row['products_options_values_name']);
            if ($url[strlen($url) - 1] == '-') {
                $url = substr($url, 0, -1);
            }
            $output[$row['language_id']][$row['products_options_values_id']] = $url;
        }
    }
    if ($output) {
        foreach ($output as $lang_id => $arr) {
            foreach ($arr as $id => $url) {
                tep_db_query("UPDATE products_options_values 
                            SET products_options_values_seourl = '" . tep_db_prepare_input($url) . "' 
                            WHERE products_options_values_id = " . (int)$id . " and language_id = " . (int)$lang_id);
            }
        }
    }

    return $output[$lngId][$id];
}
function getFiltersFromUrl($counter = false)
{
    $arr = [];
    if ($counter) {
        $counter = 0;
    }
    foreach ($_GET as $k => $v) {
        if (is_int($k)) {
            $arr[$k][$v] = $v;
            if ($counter !== false) {
                $counter = $counter + 1;
            }
        }
    }
    return $counter ? ['counter' => $counter,'filters' => $arr] : $arr;
}

function isFilterUrl()
{
    return isset($_GET['filtercPath']) && isset($_GET['filterId']) && isset($_GET['optionsvalues']) ;
}
function getFilterUrl($cPath, $filter_id = '', $optionsValuesArray = [], $lang = '', $lang_id = '')
{
    global $cat_urls_array,$current_category_id,$manufacturers_array,$optionValuesUrls, $languages_id, $addPage,
           $tempSeoFilterInfo, $setAlternate, $removeParams, $seo_urls;
    $redirectUrl = '';
    $lang_id = $lang_id ?: $languages_id;
    $lang = $lang ?: $_SESSION['language_short'];
    if (empty($current_category_id)) {
        $cPath_array = tep_parse_category_path($_GET['cPath']);
        $current_category_id = $cPath_array[(sizeof($cPath_array) - 1)];
    }
    $_lang = '';
    if ($lang != DEFAULT_LANGUAGE) {
        $redirectUrl .= $_lang = '/' . $lang;
    }
    $path = 'c' . $cPath;
    $oldPath = 'c-' . $cPath . '.html';
    $redirectCatNames = [];
    foreach (explode('-', $cPath) as $catId) {
        $redirectCatNames[] = $cat_urls_array[$lang_id][$catId][0];
    }

    if (SEO_ADD_CAT_PARENT !== "true") {
        $redirectCatNames = [end($redirectCatNames)];
    }

    $redirectUrl .= '/' . implode('-', $redirectCatNames) . '/';
    if (!empty($filter_id)) {
        foreach (explode('-', $filter_id) as $filterId) {
            $redirectFilterNames[] = $manufacturers_array[$filterId]['url'];
        }
        $redirectUrl .= implode('/', $redirectFilterNames) . '/';
        $path .= 'f' . $filter_id;
        $oldPath = '';
    }
    $pathOvIdArray = [];
    $ovIdsArr = [];
    if (!empty($optionsValuesArray)) {
        $path .= 'a';
        foreach ($optionsValuesArray as $oId => $ovIds) {
            $ovIdsArr = array_merge($ovIdsArr, explode('-', $ovIds));
        }

        sort($ovIdsArr);
        foreach ($ovIdsArr as $ovId) {
            if ($optionValuesUrls[$lang_id][$ovId]) {
                $redirectUrl .= $optionValuesUrls[$lang_id][$ovId] . '/';
            } else {
                $redirectUrl .= makeSeoUrlsForOptionsValue($ovId, $lang_id) . '/';
            }
        }
        $pathOvIdArray[] = implode('-', $ovIdsArr);

        $path .= implode('-', $pathOvIdArray);
        $oldPath = '';
    }
    $query_string = '';
    if (isset($_GET['rmin']) || isset($_GET['rmax']) || isset($_GET['sort']) || isset($_GET['row_by_page']) || (isset($_GET['page']) && isset($addPage) && $addPage)) {
        $queryArray = [];
        $_GET['rmin'] = preg_replace('/[^0-9]/', '', $_GET['rmin']);
        $_GET['rmax'] = preg_replace('/[^0-9]/', '', $_GET['rmax']);
        if (empty($removeParams)) {
            if (tep_not_null($_GET['rmin'])) {
                $queryArray['rmin'] = $_GET['rmin'];
            }
            if (tep_not_null($_GET['rmax'])) {
                $queryArray['rmax'] = $_GET['rmax'];
            }
            if (tep_not_null($_GET['sort'])) {
                $queryArray['sort'] = $_GET['sort'];
            }
            if (tep_not_null($_GET['row_by_page'])) {
                $queryArray['row_by_page'] = $_GET['row_by_page'];
            }
        }
        if (tep_not_null($_GET['page']) && isset($addPage) && $addPage) {
            $queryArray['page'] = $_GET['page'];
        }
        $query_string = $queryArray ? '?' . http_build_query($queryArray) : '';
    }
    $path .= '.html';

    if (defined('PROM_URLS') && constant('PROM_URLS') && $oldPath) {
        $oldPath = 'g' . $current_category_id . '-' . implode('-', $redirectCatNames);
        $redirectUrl = '';
    }
    if ((count($ovIdsArr) < 3 && empty($tempSeoFilterInfo)) || (isset($setAlternate) & $setAlternate)) {
        if ($tempSeoFilterInfo = getSeoFiltersInfo($current_category_id, $filter_id, (isset($ovIdsArr[0]) ? $ovIdsArr[0] : 0), (isset($ovIdsArr[1]) ? $ovIdsArr[1] : 0), $lang_id)) {
            return $_lang . '/' . $seo_urls->strip($tempSeoFilterInfo) . '/' . ($oldPath ?: $path) . $query_string;
        }
    }

    return $redirectUrl . ($oldPath ?: $path) . $query_string;
}

function getSeoFiltersInfo($categoriesId, $manufacturersId = 0, $fId1 = 0, $fId2 = 0, $lang = '')
{
    global $languages_id, $customSeoUrlList;
    $manufacturersId = empty($manufacturersId) ? 0 : $manufacturersId;
    $lang = $lang ?: $languages_id;
    $filter = implode('-', [$categoriesId,$manufacturersId,$fId1,$fId2]);
    return isset($customSeoUrlList[$lang][$filter]) ? $customSeoUrlList[$lang][$filter] : '';
    /*
    $sql = "SELECT
                sfd.title
              , sfd.description
              , sfd.meta_title
              , sfd.meta_description
              , sfd.seo_url
            FROM seo_filter_description sfd
                LEFT JOIN seo_filter sf ON sf.id = sfd.id
            WHERE
                sfd.language_id = '{$lang}'
                and sf.categories_id = '{$categoriesId}'
                and sf.manufacturers_id = '{$manufacturersId}'
                and sf.filter_id_1 = '{$fId1}'
                and sf.filter_id_2 = '{$fId2}'";
    $query = tep_db_query($sql);
    return $query->num_rows ? tep_db_fetch_array($query) : [];
    */
}
function getCustomSeoUrlsList()
{
    $sql = "SELECT 
                sfd.id
              , sfd.language_id
              , sfd.seo_url
              ,CONCAT_WS('-', sf.categories_id, sf.manufacturers_id, sf.filter_id_1, sf.filter_id_2) as params
            FROM seo_filter_description sfd
                LEFT JOIN seo_filter sf ON sf.id = sfd.id";
    $query = tep_db_query($sql);
    $customSeoUrlList = [];
    while ($row = tep_db_fetch_array($query)) {
        $customSeoUrlList[$row['language_id']][$row['params']] = $row['seo_url'];
    }
    return $customSeoUrlList;
}
function isCustomSeoUrlExist($cId, $fId = 0, $attr = [0,0])
{
    global $customSeoUrlList,$languages_id;
    $fId = $fId ?: 0;
    array_unshift($attr, $cId, $fId);
    while (count($attr) < 4) {
        $attr[] = 0;
    }
    $params = implode('-', $attr);
    return isset($customSeoUrlList[$languages_id][$params]);
}

if (!function_exists('getallheaders')) {
    /**
     * Get all HTTP header key/values as an associative array for the current request.
     *
     * @return string[] The HTTP header key/value pairs.
     */
    function getallheaders()
    {
        $headers = array();
        $copy_server = array(
            'CONTENT_TYPE'   => 'Content-Type',
            'CONTENT_LENGTH' => 'Content-Length',
            'CONTENT_MD5'    => 'Content-Md5',
        );
        foreach ($_SERVER as $key => $value) {
            if (substr($key, 0, 5) === 'HTTP_') {
                $key = substr($key, 5);
                if (!isset($copy_server[$key]) || !isset($_SERVER[$key])) {
                    $key = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', $key))));
                    $headers[$key] = $value;
                }
            } elseif (isset($copy_server[$key])) {
                $headers[$copy_server[$key]] = $value;
            }
        }
        if (!isset($headers['Authorization'])) {
            if (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
                $headers['Authorization'] = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
            } elseif (isset($_SERVER['PHP_AUTH_USER'])) {
                $basic_pass = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : '';
                $headers['Authorization'] = 'Basic ' . base64_encode($_SERVER['PHP_AUTH_USER'] . ':' . $basic_pass);
            } elseif (isset($_SERVER['PHP_AUTH_DIGEST'])) {
                $headers['Authorization'] = $_SERVER['PHP_AUTH_DIGEST'];
            }
        }
        return $headers;
    }
}
function addHostnameToLink($link)
{
    return strstr($link, HTTP_SERVER) ? $link : HTTP_SERVER . (substr($link, 0, 1) === '/' ? $link : '/' . $link );
}

/**
 * @return string $str
 **/
function outputGoogleVerificationMetaTag()
{
    $str = '';
    if (defined('GOOGLE_SITE_VERIFICATION_KEY') && GOOGLE_SITE_VERIFICATION_KEY) {
        $str = '<meta name="google-site-verification" content="' . GOOGLE_SITE_VERIFICATION_KEY . '" />';
    }

    return $str;
}

function getCPathUrlPart($productId, $languageId = null)
{
    global $prodToCat, $cPaths, $cat_urls, $languages_id;
    if (empty($languageId)) {
        $languageId = $languages_id;
    }
    if (SEO_ADD_CPATH_TO_PRODUCT_URLS === 'true') {
        $productCategoriesId = $prodToCat[$productId];
        $cPathList           = $cPaths[$productCategoriesId];
        $fullCPath           = $cat_urls[$languageId][$productCategoriesId];
        $categoryIdPrefix = getConstantValue('SEO_ADD_SLASH_BEFORE_CATEGORY_ID', 'true') == 'true' ? '/c-' : '-c-';
        return str_replace($categoryIdPrefix . $cPathList . ".html", "", $fullCPath) . "-";
    }
    return "";
}



/**
 * Function format number line 066.. 38066..
 * to +38066.. format
 * @param string $phoneNumber
 * @return string
 */
function formatPhoneNumber($phoneNumber)
{
    $cleanedNumber = (string)preg_replace("|[^0-9\+]|", "", $phoneNumber);
    if (strpos($cleanedNumber, "0") === 0 && strlen($cleanedNumber) === 10) {
        $cleanedNumber = "+38" . $cleanedNumber;
    }
    if (strpos($cleanedNumber, "380") === 0 && strlen($cleanedNumber) === 12) {
        $cleanedNumber = "+" . $cleanedNumber;
    }
    if (strpos($cleanedNumber, "+380") === 0 && strlen($cleanedNumber) === 13) {
        return $cleanedNumber;
    }
    return "";
}

function make_address($address_array)
{
    $company_name = $address_array['company'] ? $address_array['company'] . "<br>&nbsp;&nbsp;&nbsp;&nbsp;" : "";
    $user_name = $address_array['name'] ? $address_array['name'] . "<br>&nbsp;&nbsp;&nbsp;&nbsp;" : "";
    $street_address = $address_array['street_address'] ? $address_array['street_address'] . "<br>&nbsp;&nbsp;&nbsp;&nbsp;" : "";
    $post_code = $address_array['postcode'] ? $address_array['postcode'] . " " : "";
    $city_name = $address_array['city'] ? $address_array['city'] . "<br>&nbsp;&nbsp;&nbsp;&nbsp;" : "";
    $country_name = $address_array['country'] ? $address_array['country'] . "<br>&nbsp;&nbsp;&nbsp;&nbsp;" : "";

    echo $company_name . $user_name . $street_address . $post_code . $city_name . $country_name;
}
function getFilterSeoInfo($seourl)
{
    global $languages_id;
    $sql = "SELECT 
                sfd.title
              , sfd.description
              , sfd.meta_title
              , sfd.meta_description
              , sfd.seo_url
            FROM seo_filter_description sfd
            WHERE sfd.language_id = " . (int)$languages_id . "  and
                sfd.seo_url = '" . tep_db_prepare_input($seourl) . "'";
    $query = tep_db_query($sql);
    return $query->num_rows ? tep_db_fetch_array($query) : [];
}
function checkConst($const_name, $checkEmpty = false)
{
    $state = defined($const_name);
    if ($checkEmpty && $state) {
        $const = constant($const_name);
        $state = !empty($const);
    }
    return $state ? constant($const_name) : '';
}
/*
 * check images in DB and exist on FTP
 * @param array $limit
 * return array
 * */
function checkMissingImageFiles($limit = false)
{
    $sql = "SELECT products_id, products_image FROM products";
    if ($limit) {
        $sql .= " LIMIT $limit";
    }
    $missingImages = [];
    $query = tep_db_query($sql);
    if ($query->num_rows) {
        while ($raw = tep_db_fetch_array($query)) {
            if (!empty($raw['products_image'])) {
                $images = explode(';', $raw['products_image']);
                foreach ($images as $oneImage) {
                    if (!is_file('images/products/' . $oneImage)) {
                        $missingImages[$raw['products_id']][] = $oneImage;
                    }
                }
            }
        }
    }
    return $missingImages;
}

/*
 * delete product images
 * @param array $imageArray
 * */
//function deleteMissingImageFromDb($imageArray){
//    $counter = 0;
//    if(!array($imageArray)){
//        return false;
//    }
//    foreach ($imageArray as $pId => $images) {
//        if(is_array($images)){
//            foreach ($images as $oneImage){
//                $sql = "select products_id, products_image FROM products WHERE products_id = ".(int)$pId;
//                $query = tep_db_query($sql);
//                if($query->num_rows){
//                    $raw = tep_db_fetch_array($query);
//                    $imgStr =  $raw['products_image'];
//                    $images = explode(';',$imgStr);
//                    unset($images[array_search($oneImage,$images)]);
//                    $newImg = implode(';',$images);
//                    tep_db_query("UPDATE `products` SET products_image='$newImg' WHERE products_id = ".(int)$pId);
//                    $counter++;
//                }
//            }
//        }
//
//    }
//
//    return "cleared $counter images";
//}

function includeLanguages($languagePath)
{
    static $included = [];
    $languagePath = str_replace(".php", ".json", $languagePath);
    if (!isset($included[$languagePath]) && file_exists($languagePath)) {
        $json = file_get_contents($languagePath);
        $constants = json_decode($json, true);
        if (is_array($constants)) {
            foreach ($constants as $constantName => $constantValue) {
                if(!defined($constantName)) {
                    define($constantName, $constantValue);
                }
            }
        }
        $included[$languagePath] = $languagePath;
    }
}

function clearUrlFromScripts($data) : string
{
    $clearGetParams = urldecode($data);
    $clearGetParams = preg_replace('/<script\b[^>]*>(.*?)<\/script>/i', '', $clearGetParams);
    $clearGetParams = preg_replace('/\r\n|\r|\n/u', '', $clearGetParams);
    $clearGetParams = str_replace(['"', '\''], ["%22", "%27"], $clearGetParams);
    $clearGetParams = str_replace(['>', '<', '(', ')'], '', $clearGetParams);
    return $clearGetParams;
}

function clearKeywordsParam($data) : string
{
    $clearParams = stripslashes($data);
    $clearParams = preg_replace('/<script\b[^>]*>(.*?)<\/script>/i', '', $clearParams);
    $clearParams = preg_replace('/\r\n|\r|\n/u', '', $clearParams);
    $clearParams = str_replace(['"', '\'', '='], ["&quot;", "&#8217;"," "], $clearParams);
    return $clearParams;
}

/*
 *  preparing and generate all.min.css or separate style files
 * */

/*
 * generate Open Graph meta tags
 * */
function renderOpenGraphBlock()
{
    global $the_title, $content, $fb_app_id, $the_desc, $product_info;
    $clearGetParams = clearUrlFromScripts($_SERVER['REQUEST_URI']);
    $srt = '<meta property="og:locale" content="' . OG_LOCALE . '" />' .
        '<meta property="og:title" content="' . $the_title . '" />' .
        '<meta property="og:type" content="' . ($content == 'product_info' ? 'product' : 'website') . '" />' .
        '<meta property="fb:app_id" content="' . $fb_app_id . '" />' .
        '<meta property="og:description" content="' . $the_desc . '" />' .
        '<meta property="og:url" content="' . HTTP_SERVER . $clearGetParams . '" />' .
        '<meta property="og:image" content="' . (
            !empty($product_info['products_image']) ?
            HTTP_SERVER . '/getimage/products/' . urlencode(explode(';', $product_info['products_image'])[0]) :
            HTTP_SERVER . '/' . LOGO_IMAGE) . '" />';
    if (!empty($product_info['products_id'])) {
        $srt .= '<meta property="og:type" content="product"/>
              <meta property="og:image:width" content="500"/>
              <meta property="og:image:height" content="500"/>';
    }
    echo $srt;
}
function userExists()
{
    $cid = (int)$_SESSION['customer_id'];
    if (!$cid) {
        return false;
    }
    $raw = "SELECT customers_id FROM " . TABLE_CUSTOMERS . " WHERE customers_id = " . $cid;
    if (tep_db_num_rows(tep_db_query($raw)) != 0) {
        return true;
    }
    tep_session_unregister('customer_id');
    return false;
}
// Next part of code can be used for module update currency
/*
// Get NBU currency courses UAH to other
function get_nbu_exchange_rates()
{  //from https://bank.gov.ua/
    $url = 'https://bank.gov.ua/NBU_Exchange/exchange?json';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
    ]);
    ob_start();
    curl_exec($ch);
    $exchangeRatesInfo = ob_get_contents();
    ob_end_clean();
    curl_close($ch);

    return json_decode($exchangeRatesInfo);
}

// Save in cookies NBU course UAH to $convert_currency. If reset=true update anyway (is set cookie or not)
function update_currency_course($convert_currency, $reset = false){
    if(!isset($_COOKIE["course_to_".$convert_currency]) || $reset===true){
        if (isset($_COOKIE["course_to_".$convert_currency])) unset($_COOKIE["course_to_".$convert_currency]);
        $nbuExchangeRates = get_nbu_exchange_rates();
        $nbuExchangeRates = is_array($nbuExchangeRates) ? $nbuExchangeRates : [];
        foreach ($nbuExchangeRates as $nbu_exchange_rate) {
            if ($nbu_exchange_rate->CurrencyCodeL == $convert_currency) {
                setcookie("course_to_".$convert_currency, $nbu_exchange_rate->Amount/$nbu_exchange_rate->Units, time()+60*60,"/");
                break;
            }
        }
    }
}

// Convert UAH to $convert_currency by NBU course
function convert_currency($amount_of_UAH, $convert_currency = 'USD', $from_api = false)
{
    if(isset($_COOKIE["course_to_".$convert_currency]) && $from_api === false){
        $new_amount_of_money = $amount_of_UAH / $_COOKIE["course_to_".$convert_currency];
    }else{
        $nbuExchangeRates = get_nbu_exchange_rates();
        $nbuExchangeRates = is_array($nbuExchangeRates) ? $nbuExchangeRates : [];
        foreach ($nbuExchangeRates as $nbu_exchange_rate) {
            if ($nbu_exchange_rate->CurrencyCodeL == $convert_currency) {
                $new_amount_of_money = $amount_of_UAH / ($nbu_exchange_rate->Amount/$nbu_exchange_rate->Units);
                break;
            }
        }
    }

    return !empty($new_amount_of_money)?$new_amount_of_money:false;
}*/

// get array with all attributes names
//moved from Index.php
//TODO need refactoring
function getArrayWithAllAttributes()
{
    global $languages_id, $attr_names_array, $show_in_filter, $show_in_product_listing, $attr_sort_orders,
           $listing_sql, $type_join, $filter_join, $filer_select_price, $where_filters, $where_keywords,
           $where_subcategories, $counts_may_be, $attr_vals_array, $attrs_array, $r_pid_attr_array,
           $attr_vals_names_array, $counts_array, $manFilter, $attributesValuesArray, $pids_filter_excluded,
           $pids_filter_attr_axcluded, $attr_hide, $attr_not_hide;
    $attributesValuesArray = [];
    ini_set('memory_limit', '512M');
    $show_options_sql = tep_db_query("select products_options_id, products_options_name, products_options_length, products_options_comment, products_options_sort_order from " . TABLE_PRODUCTS_OPTIONS . " where (products_options_length = 1 or products_options_comment = 1) and language_id = " . (int)$languages_id); // products_options_length != 0
    while ($show_options = tep_db_fetch_array($show_options_sql)) {
        $show_options_arr[] = array('sort' => $show_options['products_options_sort_order'],'id' => $show_options['products_options_id']);
        //  $show_options_arr2[$show_options['products_options_id']] = $show_options['products_options_sort_order'];
        $attr_names_array[$show_options['products_options_id']] = $show_options['products_options_name'];
        // array with options to show in filter:
        $show_in_filter = is_array($show_in_filter) ? $show_in_filter : [];
        if ($show_options['products_options_length'] == '1') {
            $show_in_filter[] = $show_options['products_options_id'];
        }
        // array with options to show in product listing:
        $show_in_product_listing = is_array($show_in_product_listing) ? $show_in_product_listing : [];
        if ($show_options['products_options_comment'] == '1') {
            $show_in_product_listing[] = $show_options['products_options_id'];
        }
    }
    if (is_array($show_options_arr)) {
        array_multisort($show_options_arr);
        foreach ($show_options_arr as $key => $val) {
            unset($val['sort']);
            $show_options_arr[$key] = $val['id'];
        }
        $attr_sort_orders = array_flip($show_options_arr);  // make array with sort orders for EACH attribute
    }
    // array with attributes(options) values
    if (is_array($show_options_arr) && $show_options_arr) {
        $show_options_vals_arr = null;
        $show_options_vals_sql = tep_db_query("select pov.products_options_values_id, pov.products_options_values_name, pov.products_options_values_sort_order
            from " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " pov2po
            INNER JOIN " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov ON pov2po.products_options_values_id = pov.products_options_values_id and pov.language_id = " . (int)$languages_id . " 
            where pov2po.products_options_id in(" . tep_db_prepare_input(implode(',', array_unique($show_options_arr))) . ")
            GROUP BY products_options_values_id ORDER BY pov.products_options_values_sort_order, LENGTH(pov.products_options_values_name), pov.products_options_values_name");
        while ($show_options_vals = tep_db_fetch_array($show_options_vals_sql)) {
            $attr_vals_sort_orders[$show_options_vals['products_options_values_id']] = $show_options_vals['products_options_values_sort_order'];
            $attr_vals_names_array[$show_options_vals['products_options_values_id']] = $show_options_vals['products_options_values_name'];
        }

        // search attributes for specific products:
        if (!empty($listing_sql) && !empty($pids_filter_excluded)) {
            $new_listing = "select distinct at.options_values_id, at.options_id, at.products_id
                from " . TABLE_PRODUCTS_ATTRIBUTES . " at 
                inner join " . TABLE_PRODUCTS . " p on at.products_id=p.products_id 
                LEFT JOIN " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov ON pov.products_options_values_id = at.options_values_id and pov.language_id = " . (int)$languages_id . " 
                where p.products_id in(" . tep_db_prepare_input(implode(',', $pids_filter_excluded)) . ") ORDER BY pov.products_options_values_sort_order, LENGTH(pov.products_options_values_name), pov.products_options_values_name" .
                ($manufacturer ? $manufacturer : '');
        } else {
            // main page:
            $new_listing = "select distinct at.options_values_id, at.options_id, at.products_id
                from " . TABLE_PRODUCTS_ATTRIBUTES . " at 
                LEFT JOIN " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov ON pov.products_options_values_id = at.options_values_id and pov.language_id = " . (int)$languages_id . " 
                where at.options_id in(" . tep_db_prepare_input(implode(',', array_unique($show_options_arr))) . ") ORDER BY pov.products_options_values_sort_order, LENGTH(pov.products_options_values_name), pov.products_options_values_name";
        }
        $listing_count_sql = tep_db_query($new_listing);
        // fill in attributes arrays:
        $attr_hide = $attr_not_hide = [];
        while ($listing_count_pids = tep_db_fetch_array($listing_count_sql)) {
            if ((is_array($show_in_filter) && in_array($listing_count_pids['options_id'], $show_in_filter)) 
                or (is_array($show_in_product_listing) && in_array($listing_count_pids['options_id'], $show_in_product_listing))) { // show options only if we turn them on in admin
                // Hide attributes if select manufacturer
                if (!empty($pids_filter_attr_axcluded) && !in_array($listing_count_pids["products_id"], $pids_filter_attr_axcluded)) {
                    $attr_hide[$listing_count_pids["options_values_id"]] = $listing_count_pids["options_values_id"];
                } else {
                    $attr_not_hide[$listing_count_pids["options_values_id"]] = $listing_count_pids["options_values_id"];
                }
                $r_pid_attr_array[$listing_count_pids['products_id']][$listing_count_pids['options_id']][$attr_vals_sort_orders[$listing_count_pids['options_values_id']]] = $attr_vals_names_array[$listing_count_pids['options_values_id']];
                $pid_attr_array[$listing_count_pids['products_id']][$listing_count_pids['options_id']][$attr_vals_sort_orders[$listing_count_pids['options_values_id']]] = $listing_count_pids['options_values_id'];
                $attrs_array[$attr_sort_orders[$listing_count_pids['options_id']]] = $listing_count_pids['options_id'];
                if (defined('SEO_FILTER') && constant('SEO_FILTER') == 'true') {
                    if (empty($_GET["filter_id"]) || in_array($listing_count_pids['products_id'], $pids_filter_attr_axcluded)) {
                        $counts_array[$listing_count_pids['options_id']][$listing_count_pids['options_values_id']][] = $listing_count_pids['products_id']; // for attributes count in filter
                    }
                    // get all selected attribute values to one array $counts_may_be
                    if (isset($_GET[$listing_count_pids['options_id']])) {
                        foreach (explode('-', $_GET[$listing_count_pids['options_id']]) as $val) {
                            if ($listing_count_pids['options_values_id'] == $val) {
                                $counts_may_be[$listing_count_pids['options_id']][$listing_count_pids['options_values_id']][] = $listing_count_pids['products_id'];
                            }
                        }
                    }
                } else {
                    $attr_vals_array[$listing_count_pids['options_id']][$listing_count_pids['options_values_id']] = $attr_vals_sort_orders[$listing_count_pids['options_values_id']];
                }
                $attributesValuesArray[$listing_count_pids['options_id']][$listing_count_pids['options_values_id']] = $attr_vals_names_array[$listing_count_pids['options_values_id']];
            }
        }
        // unset existed attributes
        $attr_hide = array_filter($attr_hide, function ($k) {
            global $attr_not_hide;
            return !in_array($k, $attr_not_hide);
        }, ARRAY_FILTER_USE_KEY);

        if (isset($attrs_array) && is_array($attrs_array)) {
            $attrs_array = array_unique($attrs_array); // delete attributes - duplicates
            ksort($attrs_array); // sort array by sort_order
        }
        if ($listing_sql == '' && !@file_get_contents(DIR_FS_CATALOG.'temp/attributes_'.$languages_id.'.json')) { // added all products attributes to file
            $indexAttributes['attr_names_array'] = $attr_names_array;
            $indexAttributes['show_in_product_listing'] = $show_in_product_listing;
            $indexAttributes['attr_vals_array'] = $attr_vals_array;
            $indexAttributes['attrs_array'] = $attrs_array;
            $indexAttributes['r_pid_attr_array'] = $r_pid_attr_array;
            $indexAttributes['pid_attr_array'] = $pid_attr_array;
            $indexAttributes['attr_vals_names_array'] = $attr_vals_names_array;
            file_put_contents(DIR_FS_CATALOG.'temp/attributes_'.$languages_id.'.json', json_encode($indexAttributes));
        }
    }
}

function checkProductAttributesCache($languages_id, &$attrs_array, &$r_pid_attr_array, &$pid_attr_array, &$show_in_product_listing, &$attr_names_array,
    &$attr_vals_names_array, &$attr_vals_array) : bool
{
    ini_set('memory_limit', '256M');
    $content = @file_get_contents(DIR_FS_CATALOG.'temp/attributes_'.$languages_id.'.json');
    if(!$content){
        return false;
    }
    $content = json_decode($content, true);
    $attr_names_array = $content['attr_names_array'] ?: null;
    $show_in_product_listing = $content['show_in_product_listing'] ?: null;
    $attr_vals_array = $content['attr_vals_array'] ?: null;
    $attrs_array = $content['attrs_array'] ?: null;
    $r_pid_attr_array = $content['r_pid_attr_array'] ?: null;
    $pid_attr_array = $content['pid_attr_array'] ?: null;
    $attr_vals_names_array = $content['attr_vals_names_array'] ?: null;

    return true;
}

/**
 * @param int $orderId
 * @param array $statuses
 * @return bool
 */
function isOrderComplete($orderId, $statuses)
{
    $result = false;
    if (is_array($statuses)) {
        foreach ($statuses as $status) {
            $query = tep_db_query("SELECT orders_id FROM " . TABLE_ORDERS . " 
                WHERE orders_id = " . (int)$orderId . " 
                AND orders_status = " . (int)$status);
            if (tep_db_num_rows($query) > 0) {
                $result = true;
            }
        }
    }

    return $result;
}

/**
 * @param int $statusId
 * @param int $languageId
 * @return string
 */
function getOrderStatusById($statusId, $languageId)
{
    $status = "";
    $row = tep_db_fetch_array(tep_db_query("
        SELECT orders_status_name 
        FROM " . TABLE_ORDERS_STATUS . "
        WHERE orders_status_id = " . (int)$statusId . "
          AND language_id = " . (int)$languageId));
    if (isset($row["orders_status_name"])) {
        $status = $row["orders_status_name"];
    }
    return $status;
}

/**
 * Prepare a part of query to filter products by their price
 *
 * @param int $rmin product's min price
 * @param int $rmax product's max price
 * @param string $filter_finish_price product's actual price
 * @return string
 */
function preparePriceFilterWhereStatement($rmin, $rmax, $filter_finish_price)
{
    $countryId = $_SESSION['onepage']['delivery']['country_id'] ?: STORE_COUNTRY;
    $zoneId    = $_SESSION['onepage']['delivery']['zone_id'] ?: STORE_ZONE;

    // In case if product has some tax, we filter it by taxed price
    // in other way we filter it by plain product price
    $productPriceCaseTemplate = "
            ($filter_finish_price) {condition} CASE WHEN (
                p.products_tax_class_id > 0
            AND (za.zone_country_id IS NULL
              OR za.zone_country_id = '0'
              OR za.zone_country_id = " . (int)$countryId . ")
            AND (za.zone_id IS NULL
              OR za.zone_id = '0'
              OR za.zone_id = " . (int)$zoneId . ")) = 1 THEN {product_price}/((100+tr.tax_rate)/100) ELSE {product_price} END 
        ";

    $productPriceGreaterThenCase = strtr($productPriceCaseTemplate, [
        '{condition}'     => '>=',
        '{product_price}' => $rmin,
    ]);

    $productPriceLessThenCase = strtr($productPriceCaseTemplate, [
        '{condition}'     => '<=',
        '{product_price}' => $rmax,
    ]);

    return " $productPriceGreaterThenCase AND $productPriceLessThenCase AND ";
}

function removeDoubleDotsAndSpaces($str)
{
    //remove multiple " " and ":" from end of string
    return rtrim($str, ' :');
}

function addDoubleDot($str)
{
    //remove double dot and add one ":"
    return removeDoubleDotsAndSpaces($str) . ':';
}

function cutToFirstSignificantDigit($decimal)
{
    //remove multiple "0" and then "." from end of float
    return rtrim(rtrim($decimal, '0'), '.');
}

function isAjax()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}

function getPopularQueries($limit = false)
{
    global $languages_id;
    $query = "SELECT * FROM " . TABLE_STATS_KEYWORDS_POPULAR . " where language_id = " . (int)$languages_id . ($limit ? " LIMIT $limit" : '');
    return tep_db_query($query);
}

function getPopularQuery($searchKeywords)
{
    global $languages_id;
    $query = "SELECT search_keywords, meta_title, meta_description, seo_text, h1, canonical 
              FROM " . TABLE_STATS_KEYWORDS_POPULAR . " 
              WHERE language_id = " . (int) $languages_id . " AND LOWER(search_keywords)='" . tep_db_input(strtolower($searchKeywords)) . "'";
    $query = tep_db_query($query);
    if (tep_db_num_rows($query)) {
        return tep_db_fetch_array($query);
    }
    return false;
}

/**
 * set MINIFY_CSSJS = 1 when MINIFY_CSSJS == 2
 */
function resetMinifiedFiles()
{
    tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '1', last_modified = now() where configuration_key = 'MINIFY_CSSJS' AND configuration_value = '2'");
    tep_db_query("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = '" . time() . "' WHERE configuration_key = 'MINIFY_CSSJS_TIMESTAMP'");
}

function getLabels($listing)
{
    global $template;

    //general
    $labelConfig = $template->checkConfig('PRODUCT_INFO', 'P_LABELS');

    //label 1
    $return = [];
    if ($listing['lable_1']) {
        $return[] = ['name' => LABEL_TOP, 'class' => 1];
    }

    //label 2
    if ($listing['lable_2']) {
        $return[] = ['name' => LABEL_NEW, 'class' => 2];
    }

    //label 3
    //discount in %
    $discount = '';
    $oldPrice = $listing['products_price'];
    $specialPrice = $listing['products_special_price'];
    if (!empty($specialPrice) && !empty((double)$oldPrice)) {
        $discount = round((($oldPrice - $specialPrice) / $oldPrice) * 100);
    }
    if (
        $listing['lable_3'] ||
        ($labelConfig['show_special_label_with_special']['val'] && !empty($discount))
    ) {
        $name = !empty($discount) ? ('-' . $discount . '%') : LABEL_SPECIAL;
        $return[] = ['name' => $name, 'class' => 3];
    }

    return $return;
}

/**
 * Set payment method before loading payment modules
 */
function setPaymentMethod()
{
    global $payment_modules, $onepage, $onePageCheckout, $paymentMethod, $selection;
    if (tep_session_is_registered('onepage')) {
        $paymentModules = array_diff($payment_modules->modules, ['']);
        if (!$onepage['info']['payment_method'] && count($paymentModules) > 0) {
            foreach ($paymentModules as $paymentModuleItem) {
                $moduleName = pathinfo($paymentModuleItem, PATHINFO_FILENAME);
                if ($GLOBALS[$moduleName]->enabled) {
                    $onePageCheckout->setPaymentMethod($moduleName);
                    break;
                }
            }
        }
        $paymentMethod = $onepage['info']['payment_method'];
    }

    $selection = $payment_modules->selection();
}

/**
 * get Topic Name
 *
 * @param int $newsCategory
 * @param int $languages_id
 *
 * @return string $topicName
*/
function getTopicName(int $newsCategory, int $languages_id) : string
{
    $sql="select topics_name
                from " . TABLE_TOPICS_DESCRIPTION . "
                where topics_id = {$newsCategory}
                and language_id = " . (int)$languages_id;
    $query=tep_db_query($sql);
    $topicName = '';
    if($query->num_rows){
        $topicData = tep_db_fetch_array($query);
        $topicName = $topicData['topics_name'];
    }
    return $topicName;
}

/**
 * convert string to First letter to uppercase, other to lower case
 *
 * @param string $string
 * @param string $enc
 *
 * @return string
 */

function mb_ucfirst_custom(string $string, string $enc = 'UTF-8') : string
{
    return mb_strtoupper(mb_substr($string, 0, 1, $enc), $enc) .
        mb_strtolower(mb_substr($string, 1, mb_strlen($string, $enc), $enc), $enc);
}

/**
 * Bot or man.
 * Not the same $spider_flag because file includes/spiders.txt not include all bots and this will be more universally
 */
function isBot()
{
    if (preg_match('/bot|crawl|curl|dataprovider|search|get|spider|find|java|majesticsEO|google|yahoo|teoma|contaxe|yandex|libwww-perl|facebookexternalhit/i', $_SERVER['HTTP_USER_AGENT'])) {
        return true;
    }
    return false;
}

function convert_filesize($bytes, $decimals = 2){
    $size = array(' B',' kB',' MB',' GB',' TB',' PB',' EB',' ZB',' YB');
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
}

function checkMetaText($metaText, $storeTextConstant = false, $prefix = false)
{
    $extraText = $storeTextConstant ? getConstantValue($storeTextConstant, '') : '';
    if (empty($metaText) || !empty($extraText)) {
        $storeName = getConstantValue('STORE_NAME', '');
        $storeName = !empty($extraText) ? sprintf($extraText, $storeName) : $storeName;
        if (!empty($metaText)) {
            if ($prefix) {
                $metaText = $storeName . ' - ' . $metaText;
            } else {
                $metaText = $metaText . ' - ' . $storeName;
            }
        } else {
            $metaText = $storeName;
        }
    }
    return $metaText;
}
function getCoupon($id): array
{
    $sql = "SELECT `coupon_id`,`coupon_code`,`coupon_amount`
                FROM `coupons`
                WHERE `coupon_id`= " . (int)$id;
    $query=tep_db_query($sql);
    $couponName = [];
    if($query->num_rows){
        $couponData = tep_db_fetch_array($query);
        $couponName['coupon_code'] = $couponData['coupon_code'];
        $couponName['coupon_amount'] = $couponData['coupon_amount'];
    }
    return $couponName;

}

/**
 * не пропускає вказані символи
 * @param string @str
 * @param string @reg
 * @return bool
 * */
function validateFormFields($srt, $reg = "/[?!^0-9+()₴!\"№;%:?*_=~@#$^&\[\]\.\,><]/u") : bool
{
    return preg_match($reg, $srt) === 0;
}

/**
 * пропускає вказані символи
 * @param string @str
 * @return bool
 * */
function validatePhoneNumber($srt) : bool
{
    return preg_match("/[^0-9-+()]/", $srt) === 0;
}