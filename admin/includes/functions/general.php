<?php
/*
  $Id: general.php,v 1.1.1.1 2003/09/18 19:03:42 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

include('array_column.php');

spl_autoload_register(function ($class) {
    global $admin;
    $adminPath = '';
    if (strpos($class, 'admin\includes\solomono\app') > -1) {
        $adminPath = str_replace('\\', '/', str_replace('admin\includes\solomono\app', $admin . '\includes\solomono\app', $class));
    }
    $file = DIR_FS_DOCUMENT_ROOT . $adminPath . '.php';
    if (is_file($file)) {
        require_once $file;
    }
});

// get name modules enabled
function tep_modules_enabled_name($gID = 277)
{
    $configuration_query = tep_db_query("select configuration_id, configuration_key, configuration_value from " . TABLE_CONFIGURATION . " where configuration_group_id = '" . $gID . "'");
    $configurations = array();

    while ($configuration = tep_db_fetch_array($configuration_query)) {
        $configurations[] = $configuration;
    }

    return $configurations;
}

// get modules count
function tep_modules_count($gID = 277)
{
    $configuration_query = tep_db_query("select count(*) as total from " . TABLE_CONFIGURATION . " where configuration_group_id = '" . $gID . "'");
    $configuration = tep_db_fetch_array($configuration_query);
    $configuration_count = $configuration['total'];

    return $configuration_count;
}

// show Article
function renderArticle($id, $isImage = false)
{
    global $languages_id;
    if ($isImage) {
        $articles_image = ', a.articles_image ';
    }
    $art_query = tep_db_query("select ad.articles_description, ad.articles_name " . $articles_image . " from " . TABLE_ARTICLES . " a, " . TABLE_ARTICLES_DESCRIPTION . " ad where a.articles_status = '1' and (a.articles_id = '" . $id . "' or a.articles_code = '" . $id . "') and ad.articles_id = a.articles_id and ad.language_id = " . $languages_id);
    $art_info = tep_db_fetch_array($art_query);
    if ($articles_image) {
        return $art_info;
    } else {
        return $art_info['articles_description'];
    }
}

// get modules enabled
function tep_modules_enabled($gID = 277)
{
    $configuration_query = tep_db_query("select count(*) as total from " . TABLE_CONFIGURATION . " where configuration_group_id = '" . $gID . "' and configuration_value LIKE '%true'");
    $configuration = tep_db_fetch_array($configuration_query);
    $configuration_count = $configuration['total'];

    return $configuration_count;
}

/**
 * To sort dates with uksort:
 */

function datediff($date_1, $date_2)
{
    $a = strtotime($date_1['date_event']);
    $b = strtotime($date_2['date_event']);

    if ($a == $b) {
        $r = 0;
    } else {
        $r = ($a < $b) ? 1 : -1;
    }

    return $r;
}

/**
 * get last admin entered
 */
function tep_get_last_admin($limit = 20)
{
    $admin_query = tep_db_query("select admin_id, admin_firstname, admin_lastname, admin_logdate as date_event from " . TABLE_ADMIN . " where admin_id != 1 order by admin_logdate desc limit " . $limit);

    $admins = array();
    while ($admin = tep_db_fetch_array($admin_query)) {
        $admin['event_type'] = 'admin';
        $admins[] = $admin;
    }

    return $admins;
}

/**
 * get last comments
 */
function tep_get_last_comments($limit = 20)
{
    $comments_query = tep_db_query(
        "SELECT
    r.reviews_id as id,
    r.customers_name as name,
    r.products_id as pid,
    r.reviews_rating as num,
    rd.reviews_text as comm,
    r.date_added as date
    FROM " . TABLE_REVIEWS . " r
    LEFT JOIN " . TABLE_REVIEWS_DESCRIPTION . " rd ON r.reviews_id = rd.reviews_id
    WHERE r.parent_id = 0
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

function tep_get_last_comments_reply($id)
{
    $replies_query = tep_db_query(
        "SELECT
    r.reviews_id as id,
    r.customers_name as name,
    r.products_id as pid,
    r.reviews_rating as num,
    rd.reviews_text as comm,
    r.date_added as date
    FROM " . TABLE_REVIEWS . " r
    LEFT JOIN " . TABLE_REVIEWS_DESCRIPTION . " rd ON r.reviews_id = rd.reviews_id
    WHERE r.parent_id = " . $id . "
    ORDER BY date desc "
    );
    $replies = array();
    while ($reply = tep_db_fetch_array($replies_query)) {
        $replies[] = $reply;
    }

    return $replies;
}

/**
 * get last add products
 */
function tep_get_last_product($limit = 20)
{
    global $languages_id;

    $products_query_raw = "SELECT p.products_id, pd.products_name, p.products_date_added as date_event FROM " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd WHERE p.products_id = pd.products_id AND pd.language_id = " . $languages_id . " order by p.products_date_added desc, pd.products_name limit " . $limit;

    $result = tep_db_query($products_query_raw);
    $products_info = array();

    while ($product_info = tep_db_fetch_array($result)) {
        $product_info['event_type'] = 'product';
        $products_info[] = $product_info;
    }

    return $products_info;

}

/**
 * get last customers
 */
function tep_get_last_customers($limit = 20)
{
    $customers_query_raw = "select c.customers_id, c.customers_lastname, c.customers_firstname, ci.customers_info_date_account_created as date_event from " . TABLE_CUSTOMERS . " c left join " . TABLE_CUSTOMERS_INFO . " ci on (ci.customers_info_id = c.customers_id) order by ci.customers_info_date_account_created desc limit " . $limit;

    $result = tep_db_query($customers_query_raw);
    $customers_info = array();

    while ($customer_info = tep_db_fetch_array($result)) {
        $customer_info['event_type'] = 'customer';
        $customers_info[] = $customer_info;
    }

    return $customers_info;

}

/**
 * get 20 orders
 */
function tep_get_last_orders($limit = 20)
{
    $orders_query_raw = "select o.orders_id, o.date_purchased as date_event from " . TABLE_ORDERS . " o order by o.date_purchased desc limit " . $limit;

    $result = tep_db_query($orders_query_raw);
    $orders_info = array();

    while ($order_info = tep_db_fetch_array($result)) {
        $order_info['event_type'] = 'order';
        $orders_info[] = $order_info;
    }

    return $orders_info;

}

function tep_make_cat_list_OLD($parent_cat = 0)
{
    $result = tep_db_query('select categories_id, parent_id from ' . TABLE_CATEGORIES);
    while ($row = tep_db_fetch_array($result)) {
        $table[$row['parent_id']][] = $row['categories_id'];
        if ($row['parent_id'] == $parent_cat) {
            $table2[$parent_cat][] = $row['categories_id'];
        }

    }
    $table3 = tep_rec_cats($table, $table2[$parent_cat]);

    if (is_array($table3)) {
        $table3 = array_merge($table3, $table2[$parent_cat]);
    } else {
        $table3 = $table2[$parent_cat];
    }

    return $table3;

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

function tep_get_products_special_price($product_id)
{
    $product_query = tep_db_query("select products_price, products_model from " . TABLE_PRODUCTS . " where products_id = '" . $product_id . "'");
    if (tep_db_num_rows($product_query)) {
        $product = tep_db_fetch_array($product_query);
        $product_price = $product['products_price'];
    } else {
        return false;
    }

    $specials_query = tep_db_query("select specials_new_products_price from " . TABLE_SPECIALS . " where products_id = '" . $product_id . "' and status = '1' 
    and (start_date <= CURDATE() or start_date = '0000-00-00 00:00:00' or start_date is NULL)
    and (expires_date >= CURDATE() or expires_date = '0000-00-00 00:00:00' or expires_date is NULL)");
    if (tep_db_num_rows($specials_query)) {
        $special = tep_db_fetch_array($specials_query);
        $special_price = $special['specials_new_products_price'];
    } else {
        $special_price = false;
    }

    if (substr($product['products_model'], 0, 4) == 'GIFT') {    //Never apply a salededuction to Ian Wilson's Giftvouchers
        return $special_price;
    }

    $product_to_categories_query = tep_db_query("select categories_id from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . $product_id . "'");
    $product_to_categories = tep_db_fetch_array($product_to_categories_query);
    $category = $product_to_categories['categories_id'];

    $sale_query = tep_db_query("select sale_specials_condition, sale_deduction_value, sale_deduction_type from " . TABLE_SALEMAKER_SALES . " where sale_categories_all like '%," . $category . ",%' and sale_status = '1' and (sale_date_start <= now() or sale_date_start = '0000-00-00') and (sale_date_end >= now() or sale_date_end = '0000-00-00') and (sale_pricerange_from <= '" . $product_price . "' or sale_pricerange_from = '0') and (sale_pricerange_to >= '" . $product_price . "' or sale_pricerange_to = '0')");
    if (tep_db_num_rows($sale_query)) {
        $sale = tep_db_fetch_array($sale_query);
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

function tep_xppp_getproductprice($products_id)
{
    global $customer_id;
    $customer_price = 0;
    if (file_exists(DIR_FS_EXT . 'customers_groups/customers_groups.php')) {
        $customer_query = tep_db_query("select g.customers_groups_price from " . TABLE_CUSTOMERS_GROUPS . " g inner join  " . TABLE_CUSTOMERS . " c on g.customers_groups_id = c.customers_groups_id and c.customers_id = '" . $customer_id . "'");
        $customer_query_result = tep_db_fetch_array($customer_query);
        $customer_price = $customer_query_result['customers_groups_price'];
    }
    $products_price_list = tep_xppp_getpricelist("");
    $product_info_query = tep_db_query("select products_id, " . $products_price_list . "  from " . TABLE_PRODUCTS . " where products_id = '" . $products_id . "'");
    $product_info = tep_db_fetch_array($product_info_query);
    if ($product_info['products_price_' . $customer_price] == null) {
        $product_info['products_price_' . $customer_price] = $product_info['products_price'];
    }
    if ((int)$customer_price != 1) {
        $product_info['products_price'] = $product_info['products_price_' . $customer_price];
    }

    return $product_info['products_price'];
}

//TotalB2B end

//Return files stored in box that can be accessed by user
function tep_admin_files_boxes_newsdesk($filename, $sub_box_name)
{
    global $login_groups_id;
    $sub_boxes = '';

    $dbquery = tep_db_query("select admin_files_name from " . TABLE_ADMIN_FILES . " where FIND_IN_SET( '" . $login_groups_id . "', admin_groups_id) and admin_files_is_boxes = '0' and admin_files_name = '" . $filename . "'");
    if (tep_db_num_rows($dbquery)) {
        $sub_boxes = '<a href="' . tep_href_link($filename) . '" class="menuBoxContentLink">' . $sub_box_name . '</a><br>';
    }

    $configuration_groups_query = tep_db_query("
select configuration_group_id as cgID, configuration_group_title as cgTitle from " . TABLE_NEWSDESK_CONFIGURATION_GROUP . " where visible = '1' order by sort_order
	");
    while ($configuration_groups = tep_db_fetch_array($configuration_groups_query)) {
        $sub_boxes .= '<a href="' . tep_href_link(FILENAME_NEWSDESK_CONFIGURATION, 'gID=' . $configuration_groups['cgID'], 'NONSSL') . '
		" class="menuBoxContentLink">' . $configuration_groups['cgTitle'] . '</a><br>';
    }
    return $sub_boxes;
}

//Return files stored in box that can be accessed by user
function tep_admin_files_boxes_faqdesk($filename, $sub_box_name)
{
    global $login_groups_id;
    $sub_boxes = '';

    $dbquery = tep_db_query("select admin_files_name from " . TABLE_ADMIN_FILES . " where FIND_IN_SET( '" . $login_groups_id . "', admin_groups_id) and admin_files_is_boxes = '0' and admin_files_name = '" . $filename . "'");
    if (tep_db_num_rows($dbquery)) {
        $sub_boxes = '<a href="' . tep_href_link($filename) . '" class="menuBoxContentLink">' . $sub_box_name . '</a><br>';
    }

    $configuration_groups_query = tep_db_query("
select configuration_group_id as cgID, configuration_group_title as cgTitle from " . TABLE_FAQDESK_CONFIGURATION_GROUP . " where visible = '1' order by sort_order
	");
    while ($configuration_groups = tep_db_fetch_array($configuration_groups_query)) {
        $sub_boxes .= '<a href="' . tep_href_link(FILENAME_FAQDESK_CONFIGURATION, 'gID=' . $configuration_groups['cgID'], 'NONSSL') . '
		" class="menuBoxContentLink">' . $configuration_groups['cgTitle'] . '</a><br>';
    }
    return $sub_boxes;
}

//Admin begin
//Check login and file access
function tep_admin_check_login()
{
    global $PHP_SELF, $login_groups_id;
    if (!tep_session_is_registered('login_id')) {
        if (isAjax()) {
            die;
        } else {
            $params = '';
            if (isset($_GET['token'])) {
                $params = 'token=' . $_GET['token'];
            }
            $adminFolder = basename(dirname(dirname(__DIR__)));
            $_SESSION['PRE_LOGIN_URL'] = str_replace("/$adminFolder/", '', $_SERVER['REQUEST_URI']);
            tep_redirect(tep_href_link(FILENAME_LOGIN, $params, 'SSL'));
        }
    } else {
        $filename = basename($PHP_SELF);

        if ($filename != FILENAME_DEFAULT && $filename != FILENAME_FORBIDEN && $filename != FILENAME_LOGOFF && $filename != FILENAME_ADMIN_ACCOUNT && $filename != 'packingslip.php' && $filename != 'invoice.php') {
            if (!isAjax()) {
                $db_file_query = tep_db_query("select admin_files_name from " . TABLE_ADMIN_FILES . " where FIND_IN_SET( '" . $login_groups_id . "', admin_groups_id) and admin_files_name = '" . $filename . "'");
                if (!tep_db_num_rows($db_file_query)) {
                    tep_redirect(tep_href_link(FILENAME_FORBIDEN));
                }
            }
        }
    }
}

function isAjax()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}

//Return 'true' or 'false' value to display boxes and files in index.php
function tep_admin_check_boxes($filename, $boxes = '')
{
    global $login_groups_id;

    $is_boxes = 1;
    if ($boxes == 'sub_boxes') {
        $is_boxes = 0;
    }
    $dbquery = tep_db_query("select admin_files_id from " . TABLE_ADMIN_FILES . " where FIND_IN_SET( '" . $login_groups_id . "', admin_groups_id) and admin_files_is_boxes = '" . $is_boxes . "' and admin_files_name = '" . $filename . "'");

    $return_value = false;
    if (tep_db_num_rows($dbquery)) {
        $return_value = true;
    }
    return $return_value;
}

function new_tep_admin_check_boxes($filename)
{
    global $login_groups_id;

    $dbquery = tep_db_query("select admin_files_id from " . TABLE_ADMIN_FILES . " where FIND_IN_SET( '" . $login_groups_id . "', admin_groups_id) and admin_files_name = '" . $filename . "'");

    return tep_db_num_rows($dbquery) ? true : false;
}

function new_tep_admin_check_boxes_parent($filenames)
{
    global $login_groups_id;

    foreach ($filenames as $filename) {
        $dbquery = tep_db_query("select admin_files_id from " . TABLE_ADMIN_FILES . " where FIND_IN_SET( '" . $login_groups_id . "', admin_groups_id) and admin_files_name = '" . $filename . "'");

        if (tep_db_num_rows($dbquery)) {
            return true;
        }
    }

    return false;
}

//Return files stored in box that can be accessed by user
function tep_admin_files_boxes($filename, $sub_box_name)
{
    global $login_groups_id;
    $sub_boxes = '';

    $dbquery = tep_db_query("select admin_files_name from " . TABLE_ADMIN_FILES . " where FIND_IN_SET( '" . $login_groups_id . "', admin_groups_id) and admin_files_is_boxes = '0' and admin_files_name = '" . $filename . "'");
    if (tep_db_num_rows($dbquery)) {
        $sub_boxes = '<a href="' . tep_href_link($filename) . '" class="menuBoxContentLink">' . $sub_box_name . '</a><br>';

    }
    return $sub_boxes;
}

//Get selected file for index.php
function tep_selected_file($filename)
{
    global $login_groups_id;
    $randomize = FILENAME_ADMIN_ACCOUNT;

    $dbquery = tep_db_query("select admin_files_id as boxes_id from " . TABLE_ADMIN_FILES . " where FIND_IN_SET( '" . $login_groups_id . "', admin_groups_id) and admin_files_is_boxes = '1' and admin_files_name = '" . $filename . "'");
    if (tep_db_num_rows($dbquery)) {
        $boxes_id = tep_db_fetch_array($dbquery);
        $randomize_query = tep_db_query("select admin_files_name from " . TABLE_ADMIN_FILES . " where FIND_IN_SET( '" . $login_groups_id . "', admin_groups_id) and admin_files_is_boxes = '0' and admin_files_to_boxes = '" . $boxes_id['boxes_id'] . "'");
        if (tep_db_num_rows($randomize_query)) {
            $file_selected = tep_db_fetch_array($randomize_query);
            $randomize = $file_selected['admin_files_name'];
        }
    }
    return $randomize;
}

//Admin end

// Redirect to another page or site
function tep_redirect($url)
{
    if ((strstr($url, "\n") != false) || (strstr($url, "\r") != false)) {
        tep_redirect(tep_href_link(FILENAME_DEFAULT, '', 'NONSSL', false));
    }

    header('Location: ' . $url);

    exit;
}

// Parse the data used in the html tags to ensure the tags will not break
function tep_parse_input_field_data($data, $parse)
{
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
    $string = preg_replace('/ +/', ' ', $string);

    return preg_replace("/[<>]/", '_', $string);
}

function tep_customers_name($customers_id)
{
    $customers = tep_db_query("select customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customers_id . "'");
    $customers_values = tep_db_fetch_array($customers);

    return $customers_values['customers_firstname'] . ' ' . $customers_values['customers_lastname'];
}

function tep_get_path($current_category_id = '')
{
    global $cPath_array;

    if ($current_category_id == '') {
        $cPath_new = implode('_', $cPath_array);
    } else {
        if (is_array($cPath_array) && sizeof($cPath_array) == 0) {
            $cPath_new = $current_category_id;
        } else {
            $cPath_new = '';
            $last_category_query = tep_db_query("select parent_id from " . TABLE_CATEGORIES . " where categories_id = '" . (int)$cPath_array[is_array($cPath_array) ? (sizeof($cPath_array) - 1) : 0] . "'");
            $last_category = tep_db_fetch_array($last_category_query);

            $current_category_query = tep_db_query("select parent_id from " . TABLE_CATEGORIES . " where categories_id = '" . (int)$current_category_id . "'");
            $current_category = tep_db_fetch_array($current_category_query);

            if ($last_category['parent_id'] == $current_category['parent_id']) {
                for ($i = 0, $n = sizeof($cPath_array) - 1; $i < $n; $i++) {
                    $cPath_new .= '_' . $cPath_array[$i];
                }
            } else {
                $arr_size = is_array($cPath_array) ? sizeof($cPath_array) : 0;
                for ($i = 0, $n = $arr_size; $i < $n; $i++) {
                    $cPath_new .= '_' . $cPath_array[$i];
                }
            }

            $cPath_new .= '_' . $current_category_id;

            if (substr($cPath_new, 0, 1) == '_') {
                $cPath_new = substr($cPath_new, 1);
            }
        }
    }

    return 'cPath=' . $cPath_new;
}

function tep_get_all_get_params($exclude_array = '')
{
    global $_GET;

    if ($exclude_array == '') {
        $exclude_array = array();
    }

    $get_url = '';

    reset($_GET);
    foreach ($_GET as $key => $value) {
        // while (list($key, $value) = each($_GET)) {
        if (($key != tep_session_name()) && ($key != 'error') && (!in_array($key, $exclude_array))) {
            $get_url .= $key . '=' . htmlspecialchars($value) . '&';
        }
    }

    return $get_url;
}

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

function tep_datetime_short($raw_datetime)
{
    if (($raw_datetime == '0000-00-00 00:00:00') || ($raw_datetime == '')) {
        return false;
    }

    $year = (int)substr($raw_datetime, 0, 4);
    $month = (int)substr($raw_datetime, 5, 2);
    $day = (int)substr($raw_datetime, 8, 2);
    $hour = (int)substr($raw_datetime, 11, 2);
    $minute = (int)substr($raw_datetime, 14, 2);
    $second = (int)substr($raw_datetime, 17, 2);

    return strftime(DATE_TIME_FORMAT, mktime($hour, $minute, $second, $month, $day, $year));
}

function tep_get_category_tree_OLD($parent_id = '0', $spacing = '', $exclude = '', $category_tree_array = '', $include_itself = false)
{
    global $languages_id;

    if (!is_array($category_tree_array)) {
        $category_tree_array = array();
    }
    if ((sizeof($category_tree_array) < 1) && ($exclude != '0')) {
        $category_tree_array[] = array('id' => '0', 'text' => TEXT_TOP);
    }

    if ($include_itself) {
        $category_query = tep_db_query("select cd.categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " cd where cd.language_id = '" . (int)$languages_id . "' and cd.categories_id = '" . (int)$parent_id . "'");
        $category = tep_db_fetch_array($category_query);
        $category_tree_array[] = array('id' => $parent_id, 'text' => $category['categories_name']);
    }

    $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' and c.parent_id = '" . (int)$parent_id . "' order by c.sort_order, cd.categories_name");
    while ($categories = tep_db_fetch_array($categories_query)) {
        if ($exclude != $categories['categories_id']) {
            $category_tree_array[] = array('id' => $categories['categories_id'], 'text' => $spacing . $categories['categories_name']);
        }
        $category_tree_array = tep_get_category_tree($categories['categories_id'], $spacing . '&nbsp;&nbsp;&nbsp;', $exclude, $category_tree_array);
    }

    return $category_tree_array;
}

function tep_get_category_tree($cat_tree_tmp = array(), $category_tree_array = array(), $level = 0)
{
    global $cat_names, $cat_tree;

    if (empty($cat_tree_tmp)) {
        $cat_tree_tmp = $cat_tree;
    }
    if ($level == 0) {
        $category_tree_array['0'] = array('id' => '0', 'text' => TEXT_TOP);
    }

    if ($cat_tree and is_array($cat_tree_tmp)) {
        foreach ($cat_tree_tmp as $cid => $cname) {
            $category_tree_array[$cid] = array('id' => $cid, 'text' => $cat_names[$cid], "level" => $level);

            if (is_array($cname)) { // if we have subcategories, then recursively execute same function but send them subcategories array from current category
                $category_tree_array = tep_get_category_tree($cname, $category_tree_array, $level + 1);
            }
        }
        return $category_tree_array;
    }
    return false;
}

function tep_get_all_categories_turned_on()
{
    $all_categories_turned_on = [];
    $get_all_categories_turned_on_query = tep_db_query("select categories_id from " . TABLE_CATEGORIES . " c where categories_status='1'");
    while ($get_all_categories_turned_on = tep_db_fetch_array($get_all_categories_turned_on_query)) {
        $all_categories_turned_on[] = $get_all_categories_turned_on['categories_id'];
    }
    return $all_categories_turned_on;
}

function tep_get_all_categories_to_xml()
{
    $all_categories_to_xml = [];
    $get_all_categories_to_xml_query = tep_db_query("select categories_id from " . TABLE_CATEGORIES . " c where categories_to_xml='1'");
    while ($get_all_categories_to_xml = tep_db_fetch_array($get_all_categories_to_xml_query)) {
        $all_categories_to_xml[] = $get_all_categories_to_xml['categories_id'];
    }
    return $all_categories_to_xml;
}

function tep_get_parent_categories(&$parents = array(), $categories_id = false, $cat_tree = array())
{
    if ($categories_id != false) {
        foreach ($cat_tree as $k => $v) {
            if (is_array($v)) {
                if ($k == $categories_id) {
                    return array($k => $categories_id);
                } // And if we match, stack it and return it

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
                    return array($k => $categories_id);
                } // And if we match, stack it and return it

            }
        }
    }

    // Return false since there was nothing found
    return false;
}

function tep_draw_products_pull_down($name, $parameters = '', $exclude = '')
{
    global $currencies, $languages_id;

    if ($exclude == '') {
        $exclude = array();
    }

    $select_string = '<select name="' . $name . '"';

    if ($parameters) {
        $select_string .= ' ' . $parameters;
    }

    $select_string .= '>';

    $products_query = tep_db_query("select p.products_id, pd.products_name, p.products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by products_name");
    while ($products = tep_db_fetch_array($products_query)) {
        if (!in_array($products['products_id'], $exclude)) {
            $select_string .= '<option value="' . $products['products_id'] . '">' . $products['products_name'] . ' (' . $currencies->format($products['products_price']) . ')</option>';
        }
    }

    $select_string .= '</select>';

    return $select_string;
}

function tep_options_name($options_id)
{
    global $languages_id;

    $options = tep_db_query("select products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where products_options_id = '" . (int)$options_id . "' and language_id = '" . (int)$languages_id . "'");
    $options_values = tep_db_fetch_array($options);

    return $options_values['products_options_name'];
}

function tep_values_name($values_id)
{
    global $languages_id;

    $values = tep_db_query("select products_options_values_name from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where products_options_values_id = '" . (int)$values_id . "' and language_id = '" . (int)$languages_id . "'");
    $values_values = tep_db_fetch_array($values);

    return $values_values['products_options_values_name'];
}

function tep_info_image($image, $alt, $width = '80', $height = '80')
{
    if (tep_not_null($image) && (file_exists(DIR_FS_CATALOG_IMAGES . 'products/' . $image))) {
        $image = tep_image('../getimage/' . $width . 'x' . $height . '/products/' . $image, $alt);
    } else {
        $image = TEXT_IMAGE_NONEXISTENT;
    }

    return $image;
}

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

function tep_get_country_name($country_id)
{
    $country_query = tep_db_query("select countries_name from " . TABLE_COUNTRIES . " where countries_id = '" . (int)$country_id . "'");

    if (!tep_db_num_rows($country_query)) {
        return $country_id;
    } else {
        $country = tep_db_fetch_array($country_query);
        return $country['countries_name'];
    }
}

function tep_get_zone_name($country_id, $zone_id, $default_zone)
{
    $zone_query = tep_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country_id . "' and zone_id = '" . (int)$zone_id . "'");
    if (tep_db_num_rows($zone_query)) {
        $zone = tep_db_fetch_array($zone_query);
        return $zone['zone_name'];
    } else {
        return $default_zone;
    }
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
        if ((is_string($value) || is_int($value)) && !empty($value) && ($value != 'NULL') && (strlen(trim($value)) > 0)) {
            return true;
        } else {
            return false;
        }
    }
}

function tep_browser_detect($component)
{
    global $_SERVER;

    return stristr($_SERVER['HTTP_USER_AGENT'], $component);
}

function tep_tax_classes_pull_down($parameters, $selected = '')
{
    $select_string = '<select ' . $parameters . '>';
    $classes_query = tep_db_query("select tax_class_id, tax_class_title from " . TABLE_TAX_CLASS . " order by tax_class_title");
    while ($classes = tep_db_fetch_array($classes_query)) {
        $select_string .= '<option value="' . $classes['tax_class_id'] . '"';
        if ($selected == $classes['tax_class_id']) {
            $select_string .= ' SELECTED';
        }
        $select_string .= '>' . $classes['tax_class_title'] . '</option>';
    }
    $select_string .= '</select>';

    return $select_string;
}

function tep_geo_zones_pull_down($parameters, $selected = '')
{
    $select_string = '<select ' . $parameters . '>';
    $zones_query = tep_db_query("select geo_zone_id, geo_zone_name from " . TABLE_GEO_ZONES . " order by geo_zone_name");
    while ($zones = tep_db_fetch_array($zones_query)) {
        $select_string .= '<option value="' . $zones['geo_zone_id'] . '"';
        if ($selected == $zones['geo_zone_id']) {
            $select_string .= ' SELECTED';
        }
        $select_string .= '>' . $zones['geo_zone_name'] . '</option>';
    }
    $select_string .= '</select>';

    return $select_string;
}

function tep_get_geo_zone_name($geo_zone_id)
{
    $zones_query = tep_db_query("select geo_zone_name from " . TABLE_GEO_ZONES . " where geo_zone_id = '" . (int)$geo_zone_id . "'");

    if (!tep_db_num_rows($zones_query)) {
        $geo_zone_name = $geo_zone_id;
    } else {
        $zones = tep_db_fetch_array($zones_query);
        $geo_zone_name = $zones['geo_zone_name'];
    }

    return $geo_zone_name;
}

function tep_address_format($address_format_id, $address, $html, $boln, $eoln)
{
    if (is_null($address_format_id) or $address_format_id == '0') {
        $address_format_id = 1;
    }
    $address_format_query = tep_db_query("select address_format as format from " . TABLE_ADDRESS_FORMAT . " where address_format_id = " . (int)$address_format_id);
    $address_format = tep_db_fetch_array($address_format_query);

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
            $state = tep_get_zone_code($address['country_id'], $address['zone_id'], $state);
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
            //$CR = $eoln . $boln;
            $CR = $eoln;
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
    if (!empty($country)) {
        $country = tep_output_string_protected($address['country']);
    }
    if (!empty($state)) {
        $statecomma = $state . ', ';
    }

    $fmt = $address_format['format'];
    if (!empty($lastname)) {
        $fmt = str_replace('$lastname$cr', '', $fmt);
    }
    if (!empty($city)) {
        $fmt = str_replace('$city,', '', $fmt);
    }
    if (!empty($streets)) {
        $fmt = str_replace('$streets,', '', $fmt);
    }
    if (!empty($postcode)) {
        $fmt = str_replace('$postcode', '', $fmt);
    }
    eval("\$address = \"$fmt\";");

    if ((ACCOUNT_COMPANY == 'true') && (tep_not_null($company))) {
        $address = $company . $cr . $address;
    }

    return $address;
}

////////////////////////////////////////////////////////////////////////////////////////////////
//
// Function    : tep_get_zone_code
//
// Arguments   : country           country code string
//               zone              state/province zone_id
//               def_state         default string if zone==0
//
// Return      : state_prov_code   state/province code
//
// Description : Function to retrieve the state/province code (as in FL for Florida etc)
//
////////////////////////////////////////////////////////////////////////////////////////////////
function tep_get_zone_code($country, $zone, $def_state)
{
    $state_prov_query = tep_db_query("select zone_code from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' and zone_id = '" . (int)$zone . "'");

    if (!tep_db_num_rows($state_prov_query)) {
        $state_prov_code = $def_state;
    } else {
        $state_prov_values = tep_db_fetch_array($state_prov_query);
        $state_prov_code = $state_prov_values['zone_code'];
    }

    return $state_prov_code;
}

function tep_get_uprid($prid, $params)
{
    $uprid = $prid;
    if ((is_array($params)) && (!strstr($prid, '{'))) {
        foreach ($params as $option => $value) {
            // while (list($option, $value) = each($params)) {
            $uprid = $uprid . '{' . $option . '}' . $value;
        }
    }

    return $uprid;
}

function tep_get_prid($uprid)
{
    $pieces = explode('{', $uprid);

    return $pieces[0];
}

function tep_get_languages()
{
    $wherelang = " where lang_status='1'";

    $languages_query = tep_db_query("select languages_id, name, code, image, directory 
                                     from " . TABLE_LANGUAGES . " " . $wherelang . " order by sort_order");
    while ($languages = tep_db_fetch_array($languages_query)) {
        $languages_array[] = array(
            'id' => $languages['languages_id'],
            'name' => $languages['name'],
            'code' => $languages['code'],
            'image' => $languages['image'],
            'directory' => $languages['directory']
        );
    }

    return $languages_array;
}

function tep_get_languages_formatted()
{
    $wherelang = " where lang_status='1'";

    $languages_query = tep_db_query("select languages_id, name, code, image, directory 
                                     from " . TABLE_LANGUAGES . " " . $wherelang . " order by sort_order");
    while ($languages = tep_db_fetch_array($languages_query)) {
        $languages_array[$languages['languages_id']] = array(
            'id' => $languages['languages_id'],
            'name' => $languages['name'],
            'code' => $languages['code'],
            'image' => $languages['image'],
            'directory' => $languages['directory']
        );
    }

    return $languages_array;
}

function tep_get_category_name($category_id, $language_id)
{
    $category_query = tep_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$category_id . "' and language_id = '" . (int)$language_id . "'");
    $category = tep_db_fetch_array($category_query);

    return $category['categories_name'];
}

function tep_get_category_url($category_id, $language_id)
{
    $category_query = tep_db_query("select categories_seo_url from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$category_id . "' and language_id = '" . (int)$language_id . "'");
    $category = tep_db_fetch_array($category_query);

    return $category['categories_seo_url'];
}

function tep_get_orders_status_name($orders_status_id, $language_id = '')
{
    global $languages_id;

    if (!$language_id) {
        $language_id = $languages_id;
    }
    $orders_status_query = tep_db_query("select orders_status_name from " . TABLE_ORDERS_STATUS . " where orders_status_id = '" . (int)$orders_status_id . "' and language_id = '" . (int)$language_id . "'");
    $orders_status = tep_db_fetch_array($orders_status_query);

    return $orders_status['orders_status_name'];
}

function tep_get_orders_status()
{
    global $languages_id;

    $orders_status_array = array();
    $orders_status_query = tep_db_query("select orders_status_id, orders_status_name from " . TABLE_ORDERS_STATUS . " where language_id = '" . (int)$languages_id . "' order by orders_status_id");
    while ($orders_status = tep_db_fetch_array($orders_status_query)) {
        $orders_status_array[] = array(
            'id' => $orders_status['orders_status_id'],
            'text' => $orders_status['orders_status_name']
        );
    }

    return $orders_status_array;
}

function tep_get_products_name($product_id, $language_id = 0)
{
    global $languages_id;

    if ($language_id == 0) {
        $language_id = $languages_id;
    }
    $product_query = tep_db_query("select products_name from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['products_name'];
}

function tep_get_products_info($product_id, $language_id)
{
    $product_query = tep_db_query("select products_info from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['products_info'];
}

function tep_get_infobox_file_name($infobox_id, $language_id = 0)
{
    global $languages_id;

    if ($language_id == 0) {
        $language_id = $languages_id;
    }
    $infobox_query = tep_db_query("select infobox_file_name from " . TABLE_INFOBOX_CONFIGURATION . " where infobox_id = '" . (int)$infobox_id . "' and language_id = '" . (int)$language_id . "'");
    $infobox = tep_db_fetch_array($infobox_query);

    return $infobox['infobox_file_name'];
}

function tep_get_products_description($product_id, $language_id)
{
    $product_query = tep_db_query("select products_description from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['products_description'];
}

function tep_get_products_head_title_tag($product_id, $language_id)
{
    $product_query = tep_db_query("select products_head_title_tag from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['products_head_title_tag'];
}

function tep_get_products_head_desc_tag($product_id, $language_id)
{
    $product_query = tep_db_query("select products_head_desc_tag from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['products_head_desc_tag'];
}

function tep_get_products_head_keywords_tag($product_id, $language_id)
{
    $product_query = tep_db_query("select products_head_keywords_tag from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['products_head_keywords_tag'];
}

function tep_get_products_url($product_id, $language_id)
{
    $product_query = tep_db_query("select products_url from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['products_url'];
}

function tep_get_all_products()
{
    $all_products = [];
    $get_all_products_query = tep_db_query("select products_id from " . TABLE_PRODUCTS);
    while ($get_all_products = tep_db_fetch_array($get_all_products_query)) {
        $all_products[] = $get_all_products['products_id'];
    }
    return $all_products;
}

// Return the manufacturers URL in the needed language
// TABLES: manufacturers_info
function tep_get_manufacturer_url($manufacturer_id, $language_id)
{
    $manufacturer_query = tep_db_query("select manufacturers_url from " . TABLE_MANUFACTURERS_INFO . " where manufacturers_id = '" . (int)$manufacturer_id . "' and languages_id = '" . (int)$language_id . "'");
    $manufacturer = tep_db_fetch_array($manufacturer_query);

    return $manufacturer['manufacturers_url'];
}

// Wrapper for class_exists() function
// This function is not available in all PHP versions so we test it before using it.
function tep_class_exists($class_name)
{
    if (function_exists('class_exists')) {
        return class_exists($class_name);
    } else {
        return true;
    }
}

function tep_iconv($text)
{
    if (function_exists('iconv')) {
        return iconv('UTF-8', CHARSET, $text);
    } else {
        return $text;
    }
}

function tep_iconv_utf($text)
{
    if (function_exists('iconv')) {
        return iconv(CHARSET, 'UTF-8', $text);
    } else {
        return $text;
    }
}

// Count how many orders exist
function tep_comments_count()
{
    $comments_count = 0;
    $comments_query = tep_db_query("select count(*) as total from " . TABLE_REVIEWS);
    $comments = tep_db_fetch_array($comments_query);
    $comments_count = $comments['total'];

    return $comments_count;
}

// Orders summ
function tep_orders_sum_count($languages_id = 1)
{
    $orders_sum_query = tep_db_query("SELECT SUM(value) as total FROM " . TABLE_ORDERS_TOTAL . " ot WHERE ot.class = 'ot_total'");
    $orders_sum = tep_db_fetch_array($orders_sum_query);
    $orders_sum_count = $orders_sum['total'];

    return $orders_sum_count;
}

// Count how many orders exist
function tep_orders_count($languages_id = 1)
{
    $orders_count = 0;
//    $orders_query = tep_db_query("select count(*) as total from " . TABLE_ORDERS . " o left join " . TABLE_ORDERS_TOTAL . " ot on (o.orders_id = ot.orders_id), " . TABLE_ORDERS_STATUS . " s where o.orders_status = s.orders_status_id and s.language_id = '" . (int)$languages_id . "' and ot.class = 'ot_total'");
    $orders_query = tep_db_query("select count(*) as total from " . TABLE_ORDERS);
    $orders = tep_db_fetch_array($orders_query);
    $orders_count = $orders['total'];

    return $orders_count;
}

// Count how many products exist
// TABLES: products_to_categories
function tep_products_count()
{
    global $languages_id;
    $products_count = 0;

    $products_query = tep_db_query("select count(*) as total
                                    from " . TABLE_PRODUCTS . " p
                                    join " . TABLE_PRODUCTS_DESCRIPTION . " pd on pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'
                                    join " . TABLE_PRODUCTS_TO_CATEGORIES . " ptc on ptc.products_id = p.products_id
                                    join " . TABLE_CATEGORIES_DESCRIPTION . " cd on cd.categories_id = ptc.categories_id AND cd.language_id = '" . (int)$languages_id . "'
    ");

    if ($products = tep_db_fetch_array($products_query)) {
        $products_count = $products['total'];
    }

    return $products_count;
}

function prodToCat()
{
    global $catProductCounter, $prodToCatLinks, $productsInCategory;
    $sql = "SELECT p2c.categories_id, p2c.products_id FROM " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c";
    $query = tep_db_query($sql);
    $prodToCat = [];
    if ($query->num_rows) {
        while ($item = tep_db_fetch_array($query)) {
            $prodToCat[$item['products_id']] = $item['categories_id'];
            //$prodToCat doesn`t store all links.
            $prodToCatLinks[$item['products_id']][$item['categories_id']] = $item['categories_id'];
            $productsInCategory[$item['categories_id']][$item['products_id']] = $item['products_id'];
            $catProductCounter[$item['categories_id']] += 1;
        }
    }
    return $prodToCat;

}

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
    global $cat_list, $cat_names, $catProductCounter;

    if (is_array($cat_names)) {
        foreach ($cat_names as $cid => $name) {
            $catProductCounter_ready[$cid] = $catProductCounter[$cid];
            if (is_array($cat_list[$cid])) {
                foreach ($cat_list[$cid] as $subcatid) {
                    $catProductCounter_ready[$cid] += $catProductCounter[$subcatid];
                }
            }
            // if(is_array($cat_list[$cid])) $catProductCounter_ready[$cid] = countCategoryProductsRecursive($cat_list[$cid],0,$cid);
            // else $catProductCounter_ready[$cid] = countCategoryProductsRecursive($cid);
        }
    }

    return $catProductCounter_ready;

}

/*
function check_subcategories($tree, $current_category_id) {
   if(is_array($tree)) {
     foreach($tree as $key => $val) {
        if($key == $current_category_id) {
          return $val;
        } else{
          $a = check_subcategories($val, $current_category_id);
          if ($a) return $a;
        }
     }
   }
}  */

// Count how many products exist in a category
// TABLES: products, products_to_categories, categories
function tep_products_in_category_count($categories_id, $include_deactivated = false)
{
    $categories = tep_make_cat_list($categories_id);
    if (empty($categories)) {
        $sub_where = $categories_id;
    } else {
        $sub_where = implode(',', tep_make_cat_list($categories_id));
    }

    $products_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where categories_id in (" . $sub_where . ")");
    $products = tep_db_fetch_array($products_query);
    return $products['total'];

    /*
          $r_current_subcats = tep_make_cat_list($categories_id);

          $products_count = 0;
          $sub_where = $categories_id . ',';

          $count_subcats = is_array($r_current_subcats) ? count($r_current_subcats) : null;
          for ($i = 0; $i < $count_subcats; $i++) if($r_current_subcats[$i]) {
              $sub_where .= $r_current_subcats[$i] . ',';
          }
          $sub_where = substr($sub_where, 0, -1);
          debug($sub_where);
          $products_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where categories_id in (" . $sub_where . ")");
      //		$products_query = tep_db_query("select count(p2c.products_id) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where (p2c.categories_id = '" . (int)$categories_id . "' " . $sub_where . ")");
          $products = tep_db_fetch_array($products_query);
          $products_count = $products['total'];

          return $products_count;  */
}

// Count how many subcategories exist in a category
// TABLES: categories
function tep_childs_in_category_count($categories_id)
{
    global $cat_list;
    if (is_array($cat_list[$categories_id])) {
        return count($cat_list[$categories_id]);
    } else {
        return 0;
    }

    /*
       $categories_count = 0;

       $r_current_subcats = tep_make_cat_list($categories_id);

       $sub_where = '';
       $count_subcats = is_array($r_current_subcats ) ? count($r_current_subcats) : 0;
       for ($i = 0; $i < $count_subcats; $i++) {
           $sub_where .= " or parent_id ='" . $r_current_subcats[$i] . "'";
       }

       $categories_query = tep_db_query("select count(*) as total from " . TABLE_CATEGORIES . " where parent_id = " . $categories_id . " " . $sub_where . " ");
       $categories = tep_db_fetch_array($categories_query);

       return $categories['total'];   */
}

// Returns an array with countries
// TABLES: countries
function tep_get_countries($default = '')
{
    $countries_array = array();
    if ($default) {
        $countries_array[] = array(
            'id' => '',
            'text' => $default
        );
    }
    $countries_query = tep_db_query("select countries_id, countries_name from " . TABLE_COUNTRIES . " order by countries_name");
    while ($countries = tep_db_fetch_array($countries_query)) {
        $countries_array[] = array(
            'id' => $countries['countries_id'],
            'text' => $countries['countries_name']
        );
    }

    return $countries_array;
}
function tep_get_time_zone_name($time_zone_id)
{
    $query = tep_db_query("select code, value from " . TABLE_TIME_ZONE . " where id = " . (int)$time_zone_id);
    if (!tep_db_num_rows($query)) {
        return $time_zone_id;
    } else {
        $row = tep_db_fetch_array($query);
        return $row['code'].' ('.$row['value'].')';
    }
}

function tep_get_time_zone($default = ''){
    $zones_array = array();
    if ($default) {
        $zones_array[] = array('id' => '',
            'text' => $default);
    }
    $query = tep_db_query("select id, code, value from " . TABLE_TIME_ZONE . " order by id");
    while ($zones = tep_db_fetch_array($query)) {
        $zones_array[] = array('id' => $zones['id'],
            'text' => $zones['code'].' ('.$zones['value'].')');
    }

    return $zones_array;
}

// return an array with country zones
function tep_get_country_zones($country_id)
{
    $zones_array = array();
    $zones_query = tep_db_query("select zone_id, zone_name from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country_id . "' order by zone_name");
    while ($zones = tep_db_fetch_array($zones_query)) {
        $zones_array[] = array(
            'id' => $zones['zone_id'],
            'text' => $zones['zone_name']
        );
    }

    return $zones_array;
}

function tep_prepare_country_zones_pull_down($country_id = '')
{
// preset the width of the drop-down for Netscape
    $pre = '';
    if ((!tep_browser_detect('MSIE')) && (tep_browser_detect('Mozilla/4'))) {
        for ($i = 0; $i < 45; $i++) {
            $pre .= '&nbsp;';
        }
    }

    $zones = tep_get_country_zones($country_id);

    if (sizeof($zones) > 0) {
        $zones_select = array(array('id' => '', 'text' => PLEASE_SELECT));
        $zones = array_merge($zones_select, $zones);
    } else {
        $zones = array(array('id' => '', 'text' => TYPE_BELOW));
// create dummy options for Netscape to preset the height of the drop-down
        if ((!tep_browser_detect('MSIE')) && (tep_browser_detect('Mozilla/4'))) {
            for ($i = 0; $i < 9; $i++) {
                $zones[] = array('id' => '', 'text' => $pre);
            }
        }
    }

    return $zones;
}

// Get list of address_format_id's
function tep_get_address_formats()
{
    $address_format_query = tep_db_query("select address_format_id from " . TABLE_ADDRESS_FORMAT . " order by address_format_id");
    $address_format_array = array();
    while ($address_format_values = tep_db_fetch_array($address_format_query)) {
        $address_format_array[] = array(
            'id' => $address_format_values['address_format_id'],
            'text' => $address_format_values['address_format_id']
        );
    }
    return $address_format_array;
}

// Alias function for Store configuration values in the Administration Tool
function tep_cfg_pull_down_country_list($country_id)
{
    return tep_draw_pull_down_menu('configuration_value', tep_get_countries(), $country_id);
}

function tep_cfg_pull_down_time_zone_list($time_zone_id){
    return tep_draw_pull_down_menu('configuration_value', tep_get_time_zone(), $time_zone_id);
}

function tep_cfg_pull_down_zone_list($zone_id, $parameters = '')
{
    return tep_draw_pull_down_menu('configuration_value', tep_get_country_zones(STORE_COUNTRY), $zone_id, $parameters);
}

function tep_cfg_pull_down_tax_classes($tax_class_id, $key = '')
{
    $name = (($key) ? 'configuration[' . $key . ']' : 'configuration_value');

    $tax_class_array = array(array('id' => '0', 'text' => TEXT_NONE));
    $tax_class_query = tep_db_query("select tax_class_id, tax_class_title from " . TABLE_TAX_CLASS . " order by tax_class_title");
    while ($tax_class = tep_db_fetch_array($tax_class_query)) {
        $tax_class_array[] = array(
            'id' => $tax_class['tax_class_id'],
            'text' => $tax_class['tax_class_title']
        );
    }

    return tep_draw_pull_down_menu($name, $tax_class_array, $tax_class_id);
}

// Function to read in text area in admin
function tep_cfg_textarea($text)
{
    return tep_draw_textarea_field('configuration_value', false, 35, 5, $text);
}

// Function to read in text area in admin
function tep_cfg_ckeditor($text)
{
    return tep_draw_textarea_field('configuration_value', false, 35, 5, htmlspecialchars_decode($text), ' class="ck_replacer"');
}

function tep_cfg_get_zone_name($zone_id)
{
    $zone_query = tep_db_query("select zone_name from " . TABLE_ZONES . " where zone_id = '" . (int)$zone_id . "'");

    if (!tep_db_num_rows($zone_query)) {
        return $zone_id;
    } else {
        $zone = tep_db_fetch_array($zone_query);
        return $zone['zone_name'];
    }
}

// Sets the status of a product
function tep_set_product_status($products_id, $status)
{
    if ($status == '1') {
        return tep_db_query("update " . TABLE_PRODUCTS . " set products_status = '1', products_last_modified = now() where products_id = '" . (int)$products_id . "'");
    } elseif ($status == '0') {
        return tep_db_query("update " . TABLE_PRODUCTS . " set products_status = '0', products_last_modified = now() where products_id = '" . (int)$products_id . "'");
    } else {
        return -1;
    }
}

// Sets the status of a product to XML
function tep_set_product_xml($products_id, $status)
{
    if ($status == '1') {
        return tep_db_query("update " . TABLE_PRODUCTS . " set products_to_xml = '1', products_last_modified = now() where products_id = '" . (int)$products_id . "'");
    } elseif ($status == '0') {
        return tep_db_query("update " . TABLE_PRODUCTS . " set products_to_xml = '0', products_last_modified = now() where products_id = '" . (int)$products_id . "'");
    } else {
        return -1;
    }
}

function tep_set_categories_xml($categories_id, $status)
{
    if ($status == '1') {
        return tep_db_query("update " . TABLE_CATEGORIES . " set categories_to_xml = '1' where categories_id = '" . (int)$categories_id . "'");
    } elseif ($status == '0') {
        return tep_db_query("update " . TABLE_CATEGORIES . " set categories_to_xml = '0' where categories_id = '" . (int)$categories_id . "'");
    } else {
        return -1;
    }
}

function set_categories_xml(array $catList, $status)
{
    if (!in_array($status, [0, 1])) {
        return false;
    }
    $catList = implode(',', $catList);
    tep_db_query("update " . TABLE_CATEGORIES . " set categories_to_xml = '{$status}' where categories_id in ({$catList})");

}

function set_products_xml(array $prodList, $status)
{
    if (!in_array($status, [0, 1])) {
        return false;
    }
    $prodList = implode(',', $prodList);
    tep_db_query("update " . TABLE_PRODUCTS . " set products_to_xml = '{$status}', products_last_modified = now() where products_id in ({$prodList})");

}

function tep_get_cpath_global($cat_tree, $parents = [])
{
    global $cPaths;
    if (!isset($cPaths)) {
        $cPaths = [0 => 0];
    }

    foreach ($cat_tree as $parent => $child) {
        if (is_array($child)) {
            $currentParents = $parents;
            array_push($currentParents, $parent);
            tep_get_cpath_global($cat_tree[$parent], $currentParents);
            $cPaths[$parent] = implode('-', $currentParents);
        } else {
            $currentParents = $parents;
            array_push($currentParents, $child);
            $cPaths[$child] = implode('-', $currentParents);
        }
    }
}

function nestedToSingle(array $array)
{
    $singleDimArray = [];

    foreach ($array as $k => $item) {
        if (is_array($item)) {
            $singleDimArray[] = $k;
            $singleDimArray = array_merge($singleDimArray, nestedToSingle($item));

        } else {
            $singleDimArray[] = $item;
        }
    }

    return $singleDimArray;
}

// Sets the status of a product on special
function tep_set_specials_status($specials_id, $status)
{
    if ($status == '1') {
        return tep_db_query("update " . TABLE_SPECIALS . " set status = '1', date_status_change = now() where specials_id = '" . (int)$specials_id . "'");
    } elseif ($status == '0') {
        return tep_db_query("update " . TABLE_SPECIALS . " set status = '0', date_status_change = now() where specials_id = '" . (int)$specials_id . "'");
    } else {
        return -1;
    }
}

// Sets timeout for the current script.
// Cant be used in safe mode.
function tep_set_time_limit($limit)
{
    if (!get_cfg_var('safe_mode')) {
        set_time_limit($limit);
    }
}

// Alias function for Store configuration values in the Administration Tool
function tep_cfg_select_option($select_array, $key_value, $key = '')
{
    $string = '';

    for ($i = 0, $n = sizeof($select_array); $i < $n; $i++) {
        $values_array = explode(':', $select_array[$i]);

        if (is_dir(DIR_FS_CATALOG . 'ext/' . $values_array[0]) or $values_array[1] == '') {
            $name = ((tep_not_null($key)) ? 'configuration[' . $key . ']' : 'configuration_value');
            $string .= '
                <div class="radio">
                  <label class="i-checks i-checks-sm">
                    <input class="ajaxRadio" type="radio" name="' . $name . '" value="' . $select_array[$i] . '"';
            if ($key_value == $select_array[$i]) {
                $string .= ' CHECKED';
            }
            $var = explode(':', $select_array[$i]);
            $flag = end($var);
            $string .= ' >
                    <i></i>
                    ' . $flag . '
                  </label>
                </div>
            ';
            // $string .= '<div class="radio"><lable><input class="" type="radio" name="' . $name . '" value="' . $select_array[$i] . '"';
            // if ($key_value == $select_array[$i]) $string .= ' CHECKED';
            // $string .= '>' . $select_array[$i];
            //    $string .= '</lable></div> ';
        } else {
            $string = '<a class="buyme" target="_blank" href="https://solomono.net/?module=' . $values_array[0] . '">' . ADMIN_BTN_BUY_MODULE . '</a>';
        }

    }

    return $string;
}

// Alias function for Store configuration values in the Administration Tool
function tep_cfg_select_option_checkbox($select_array, $key_value, $key = '')
{
    $string = '';

    $checked = in_array($key_value, $select_array) && in_array(strtolower($key_value), ['true', '1'], true) ? ' checked' : '';

    $valueTrue = $select_array[array_key_first($select_array)];
    $valueFalse = $select_array[array_key_last($select_array)];

    $name = ((tep_not_null($key)) ? 'configuration[' . $key . ']' : 'configuration_value');
    $string .= '<div class="status">';
    $string .= '<input type="hidden" name="' . $name . '" value="' . $valueFalse . '">';
    $string .= '<input class="cmn-toggle cmn-toggle-round" type="checkbox" id="cmn-toggle-' . $name . '" name="' . $name . '" value="' . $valueTrue . '"' . $checked . '>';
    $string .= '<label class="jsChangeStatus" for="cmn-toggle-' . $name . '"></label>';
    $string .= '</div>';

    return $string;
}

// Alias function for module configuration keys
function tep_mod_select_option($select_array, $key_name, $key_value)
{
    reset($select_array);
    foreach ($select_array as $key => $value) {
        // while (list($key, $value) = each($select_array)) {
        if (is_int($key)) {
            $key = $value;
        }
        $string .= '<br><input type="radio" name="configuration[' . $key_name . ']" value="' . $key . '"';
        if ($key_value == $key) {
            $string .= ' CHECKED';
        }
        $string .= '> ' . $value;
    }

    return $string;
}

// Retreive server information
function tep_get_system_information()
{
    global $_SERVER;

    $db_query = tep_db_query("select now() as datetime");
    $db = tep_db_fetch_array($db_query);

    list($system, $host, $kernel) = explode('/[\s,]+/', @exec('uname -a'), 5);

    return array(
        'date' => tep_datetime_short(date('Y-m-d H:i:s')),
        'system' => $system,
        'kernel' => $kernel,
        'host' => $host,
        'ip' => gethostbyname($host),
        'uptime' => @exec('uptime'),
        'http_server' => $_SERVER['SERVER_SOFTWARE'],
        'php' => PHP_VERSION,
        'zend' => (function_exists('zend_version') ? zend_version() : ''),
        'db_server' => DB_SERVER,
        'db_ip' => gethostbyname(DB_SERVER),
        'db_version' => 'MySQL ' . (function_exists('mysqli_get_server_info') ? mysqli_get_server_info(DB()) : ''),
        'db_date' => tep_datetime_short($db['datetime'])
    );
}

function tep_generate_category_path($id, $from = 'category', $categories_array = '', $index = 0)
{
    global $languages_id;

    if (!is_array($categories_array)) {
        $categories_array = array();
    }

    if ($from == 'product') {
        $categories_query = tep_db_query("select categories_id from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$id . "'");
        while ($categories = tep_db_fetch_array($categories_query)) {
            if ($categories['categories_id'] == '0') {
                $categories_array[$index][] = array('id' => '0', 'text' => TEXT_TOP);
            } else {
                $category_query = tep_db_query("select cd.categories_name, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = '" . (int)$categories['categories_id'] . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "'");
                $category = tep_db_fetch_array($category_query);
                $categories_array[$index][] = array('id' => $categories['categories_id'], 'text' => $category['categories_name']);
                if ((tep_not_null($category['parent_id'])) && ($category['parent_id'] != '0')) {
                    $categories_array = tep_generate_category_path($category['parent_id'], 'category', $categories_array, $index);
                }
                $categories_array[$index] = array_reverse($categories_array[$index]);
            }
            $index++;
        }
    } elseif ($from == 'category') {
        $category_query = tep_db_query("select cd.categories_name, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = '" . (int)$id . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "'");
        $category = tep_db_fetch_array($category_query);
        $categories_array[$index][] = array('id' => $id, 'text' => $category['categories_name']);
        if ((tep_not_null($category['parent_id'])) && ($category['parent_id'] != '0')) {
            $categories_array = tep_generate_category_path($category['parent_id'], 'category', $categories_array, $index);
        }
    }

    return $categories_array;
}

function tep_output_generated_category_path($id, $from = 'category')
{
    $calculated_category_path_string = '';
    $calculated_category_path = tep_generate_category_path($id, $from);
    for ($i = 0, $n = sizeof($calculated_category_path); $i < $n; $i++) {
        for ($j = 0, $k = sizeof($calculated_category_path[$i]); $j < $k; $j++) {
            $calculated_category_path_string .= $calculated_category_path[$i][$j]['text'] . '&nbsp;&gt;&nbsp;';
        }
        $calculated_category_path_string = substr($calculated_category_path_string, 0, -16) . '<br>';
    }
    $calculated_category_path_string = substr($calculated_category_path_string, 0, -4);

    if (strlen($calculated_category_path_string) < 1) {
        $calculated_category_path_string = TEXT_TOP;
    }

    return $calculated_category_path_string;
}

function tep_get_generated_category_path_ids($id, $from = 'category')
{
    $calculated_category_path_string = '';
    $calculated_category_path = tep_generate_category_path($id, $from);
    for ($i = 0, $n = sizeof($calculated_category_path); $i < $n; $i++) {
        for ($j = 0, $k = sizeof($calculated_category_path[$i]); $j < $k; $j++) {
            $calculated_category_path_string .= $calculated_category_path[$i][$j]['id'] . '_';
        }
        $calculated_category_path_string = substr($calculated_category_path_string, 0, -1) . '<br>';
    }
    $calculated_category_path_string = substr($calculated_category_path_string, 0, -4);

    if (strlen($calculated_category_path_string) < 1) {
        $calculated_category_path_string = TEXT_TOP;
    }

    return $calculated_category_path_string;
}

function tep_remove_category($category_id)
{
    $category_image_query = tep_db_query("select categories_image from " . TABLE_CATEGORIES . " where categories_id = '" . (int)$category_id . "'");
    $category_image = tep_db_fetch_array($category_image_query);

    $duplicate_image_query = tep_db_query("select count(*) as total from " . TABLE_CATEGORIES . " where categories_image = '" . tep_db_input($category_image['categories_image']) . "'");
    $duplicate_image = tep_db_fetch_array($duplicate_image_query);

    if ($duplicate_image['total'] < 2) {
        if (file_exists(DIR_FS_CATALOG_IMAGES . 'categories/' . $category_image['categories_image'])) {
            @unlink(DIR_FS_CATALOG_IMAGES . 'categories/' . $category_image['categories_image']);
        }
    }

    tep_db_query("delete from " . TABLE_CATEGORIES . " where categories_id = '" . (int)$category_id . "'");
    tep_db_query("delete from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$category_id . "'");
    tep_db_query("delete from " . TABLE_PRODUCTS_TO_CATEGORIES . " where categories_id = '" . (int)$category_id . "'");

    resetCacheForCategories();
}

function tep_remove_product($product_id)
{
    $product_image_query = tep_db_query("select products_image from " . TABLE_PRODUCTS . " where products_id = '" . (int)$product_id . "'");
    $product_image = tep_db_fetch_array($product_image_query);

    $duplicate_image_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " where products_image = '" . tep_db_input($product_image['products_image']) . "'");
    $duplicate_image = tep_db_fetch_array($duplicate_image_query);

    if ($duplicate_image['total'] < 2) {
        $im_array = explode(';', $product_image['products_image']);
        foreach ($im_array as $im) {
            if (file_exists(DIR_FS_CATALOG_IMAGES . 'products/' . $im)) {
                @unlink(DIR_FS_CATALOG_IMAGES . 'products/' . $im);
            }
        }
    }

    $products_copy_from_query = tep_db_query("select pa_imgs from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id=" . (int)$product_id . " and pa_imgs!=''");
    while ($products_copy = tep_db_fetch_array($products_copy_from_query)) {
        $im_array = explode('|', $products_copy['pa_imgs']);
        foreach ($im_array as $im) {
            if (file_exists(DIR_FS_CATALOG_IMAGES . 'products/' . $im)) {
                @unlink(DIR_FS_CATALOG_IMAGES . 'products/' . $im);
            }
        }
    }

    tep_db_query("delete from " . TABLE_SPECIALS . " where products_id = '" . (int)$product_id . "'");
    tep_db_query("delete from " . TABLE_PRODUCTS . " where products_id = '" . (int)$product_id . "'");
    tep_db_query("delete from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$product_id . "'");
    tep_db_query("delete from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "'");
    tep_db_query("delete from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$product_id . "'");
    tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where products_id = '" . tep_db_prepare_input($product_id) . "'");
    tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where products_id = '" . tep_db_prepare_input($product_id) . "'");

//Wishlist addition to delete products from the wishlist when deleted
    tep_db_query("delete from " . TABLE_WISHLIST . " where products_id = '" . tep_db_prepare_input($product_id) . "'");
    tep_db_query("delete from " . TABLE_WISHLIST_ATTRIBUTES . " where products_id = '" . tep_db_prepare_input($product_id) . "'");

//    $product_reviews_query = tep_db_query("select reviews_id from " . TABLE_REVIEWS . " where products_id = '" . (int)$product_id . "'");
//    while ($product_reviews = tep_db_fetch_array($product_reviews_query)) {
//      tep_db_query("delete from " . TABLE_REVIEWS_DESCRIPTION . " where reviews_id = '" . (int)$product_reviews['reviews_id'] . "'");
//    }
//    tep_db_query("delete from " . TABLE_REVIEWS . " where products_id = '" . (int)$product_id . "'");

    resetCacheForCategories();
}

function tep_remove_order($order_id, $restock = false)
{
    if ($restock == 'on') {
        $order_query = tep_db_query("select products_id, products_quantity from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . (int)$order_id . "'");
        while ($order = tep_db_fetch_array($order_query)) {
            tep_db_query("update " . TABLE_PRODUCTS . " set products_quantity = products_quantity + " . $order['products_quantity'] . ", products_ordered = products_ordered - " . $order['products_quantity'] . " where products_id = '" . (int)$order['products_id'] . "'");
        }
    }

    tep_db_query("delete from " . TABLE_ORDERS . " where orders_id = '" . (int)$order_id . "'");
    tep_db_query("delete from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . (int)$order_id . "'");
    tep_db_query("delete from " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " where orders_id = '" . (int)$order_id . "'");
    tep_db_query("delete from " . TABLE_ORDERS_STATUS_HISTORY . " where orders_id = '" . (int)$order_id . "'");
    tep_db_query("delete from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . (int)$order_id . "'");
}

function tep_reset_cache_block($cache_block)
{
    global $cache_blocks;

    for ($i = 0, $n = sizeof($cache_blocks); $i < $n; $i++) {
        if ($cache_blocks[$i]['code'] == $cache_block) {
            if ($cache_blocks[$i]['multiple']) {
                if ($dir = @opendir(DIR_FS_CACHE)) {
                    while ($cache_file = readdir($dir)) {
                        $cached_file = $cache_blocks[$i]['file'];
                        $languages = tep_get_languages();
                        for ($j = 0, $k = sizeof($languages); $j < $k; $j++) {
                            $cached_file_unlink = preg_replace('/-language/', '-' . $languages[$j]['directory'], $cached_file);
                            if (preg_match('/^' . $cached_file_unlink . '/', $cache_file)) {
                                @unlink(DIR_FS_CACHE . $cache_file);
                            }
                        }
                    }
                    closedir($dir);
                }
            } else {
                $cached_file = $cache_blocks[$i]['file'];
                $languages = tep_get_languages();
                for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                    $cached_file = preg_replace('/-language//', '-' . $languages[$i]['directory'], $cached_file);
                    @unlink(DIR_FS_CACHE . $cached_file);
                }
            }
            break;
        }
    }
}

function tep_get_file_permissions($mode)
{
// determine type
    if (($mode & 0xC000) == 0xC000) { // unix domain socket
        $type = 's';
    } elseif (($mode & 0x4000) == 0x4000) { // directory
        $type = 'd';
    } elseif (($mode & 0xA000) == 0xA000) { // symbolic link
        $type = 'l';
    } elseif (($mode & 0x8000) == 0x8000) { // regular file
        $type = '-';
    } elseif (($mode & 0x6000) == 0x6000) { //bBlock special file
        $type = 'b';
    } elseif (($mode & 0x2000) == 0x2000) { // character special file
        $type = 'c';
    } elseif (($mode & 0x1000) == 0x1000) { // named pipe
        $type = 'p';
    } else { // unknown
        $type = '?';
    }

// determine permissions
    $owner['read'] = ($mode & 00400) ? 'r' : '-';
    $owner['write'] = ($mode & 00200) ? 'w' : '-';
    $owner['execute'] = ($mode & 00100) ? 'x' : '-';
    $group['read'] = ($mode & 00040) ? 'r' : '-';
    $group['write'] = ($mode & 00020) ? 'w' : '-';
    $group['execute'] = ($mode & 00010) ? 'x' : '-';
    $world['read'] = ($mode & 00004) ? 'r' : '-';
    $world['write'] = ($mode & 00002) ? 'w' : '-';
    $world['execute'] = ($mode & 00001) ? 'x' : '-';

// adjust for SUID, SGID and sticky bit
    if ($mode & 0x800) {
        $owner['execute'] = ($owner['execute'] == 'x') ? 's' : 'S';
    }
    if ($mode & 0x400) {
        $group['execute'] = ($group['execute'] == 'x') ? 's' : 'S';
    }
    if ($mode & 0x200) {
        $world['execute'] = ($world['execute'] == 'x') ? 't' : 'T';
    }

    return $type .
        $owner['read'] . $owner['write'] . $owner['execute'] .
        $group['read'] . $group['write'] . $group['execute'] .
        $world['read'] . $world['write'] . $world['execute'];
}

function tep_remove($source)
{
    global $messageStack, $tep_remove_error;

    if (isset($tep_remove_error)) {
        $tep_remove_error = false;
    }

    if (is_dir($source)) {
        $dir = dir($source);
        while ($file = $dir->read()) {
            if (($file != '.') && ($file != '..')) {
                if (is_writeable($source . '/' . $file)) {
                    tep_remove($source . '/' . $file);
                } else {
                    $messageStack->add(sprintf(ERROR_FILE_NOT_REMOVEABLE, $source . '/' . $file), 'error');
                    $tep_remove_error = true;
                }
            }
        }
        $dir->close();

        if (is_writeable($source)) {
            rmdir($source);
        } else {
            $messageStack->add(sprintf(ERROR_DIRECTORY_NOT_REMOVEABLE, $source), 'error');
            $tep_remove_error = true;
        }
    } else {
        if (is_writeable($source)) {
            unlink($source);
        } else {
            $messageStack->add(sprintf(ERROR_FILE_NOT_REMOVEABLE, $source), 'error');
            $tep_remove_error = true;
        }
    }
}

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

function tep_mail($to_name, $to_email_address, $email_subject, $email_text, $from_email_name, $from_email_address)
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
                ->setFrom([$botname => $from_email_name])
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
        $body .= "--$boundary--";

        return @mail($to_email_address, '=?utf-8?B?' . base64_encode($email_subject) . '?=', $body, $headers);
    }
}

function tep_get_tax_class_title($tax_class_id)
{
    if ($tax_class_id == '0') {
        return TEXT_NONE;
    } else {
        $classes_query = tep_db_query("select tax_class_title from " . TABLE_TAX_CLASS . " where tax_class_id = '" . (int)$tax_class_id . "'");
        $classes = tep_db_fetch_array($classes_query);

        return $classes['tax_class_title'];
    }
}

// Wrapper function for round() for php3 compatibility
function tep_round($value, $precision)
{
    if (PHP_VERSION < 6) {
        $exp = pow(10, $precision);
        return round($value * $exp) / $exp;
    } else {
        return round($value, (int) $precision);
    }
}

// Add tax to a products price
function tep_add_tax($price, $tax)
{
    global $currencies;

    if (DISPLAY_PRICE_WITH_TAX == 'true') {
        return tep_round($price, $currencies->currencies[DEFAULT_CURRENCY]['decimal_places']) + tep_calculate_tax($price, $tax);
    } else {
        return tep_round($price, $currencies->currencies[DEFAULT_CURRENCY]['decimal_places']);
    }
}

// Calculates Tax rounding the result
function tep_calculate_tax($price, $tax)
{
    global $currencies;

    return tep_round($price * $tax / 100, $currencies->currencies[DEFAULT_CURRENCY]['decimal_places']);
}

// Returns the tax rate for a zone / class
// TABLES: tax_rates, zones_to_geo_zones
function tep_get_tax_rate($class_id, $country_id = -1, $zone_id = -1)
{
    global $customer_zone_id, $customer_country_id;

    $tax_multiplier = 0;
    //get info
    if (($country_id == -1) && ($zone_id == -1)) {
        if (tep_session_is_registered('customer_id')) {
            $country_id = $customer_country_id;
            $zone_id = $customer_zone_id;
        } else {
            $country_id = STORE_COUNTRY;
            $zone_id = STORE_ZONE;
        }
    }

    $tax_query = tep_db_query("select tax_rate
    from " . TABLE_TAX_RATES . " tr
            left join " . TABLE_ZONES_TO_GEO_ZONES . " za on (tr.tax_zone_id = za.geo_zone_id)
            where (za.zone_country_id is null or za.zone_country_id = '0' or za.zone_country_id = " . (int)$country_id . ")
            and (za.zone_id is null or za.zone_id = '0' or za.zone_id = " . (int)$zone_id . ")
            and tr.tax_class_id = " . (int)$class_id . "
            order by tax_priority desc, za.zone_country_id desc, za.zone_id desc
            limit 1");
    if (tep_db_num_rows($tax_query)) {
        $tax_multiplier = tep_db_fetch_array($tax_query)['tax_rate'];
    }
    return $tax_multiplier;
}

// Returns the tax rate for a tax class
// TABLES: tax_rates
function tep_get_tax_rate_value($class_id)
{
    $tax_multiplier = 0;
    $tax_query = tep_db_query("select tax_rate
    from " . TABLE_TAX_RATES . "
    where tax_class_id = '" . (int)$class_id . "'
    order by tax_priority desc
    limit 1");
    if (tep_db_num_rows($tax_query)) {
        $tax_multiplier = tep_db_fetch_array($tax_query)['tax_rate'];
    }
    return $tax_multiplier;
}

function tep_call_function($function, $parameter, $object = '')
{
    if ($object == '') {
        return call_user_func($function, $parameter);
    } elseif (PHP_VERSION < 4) {
        return call_user_func($function, $object, $parameter);
    } else {
        return call_user_func(array($object, $function), $parameter);
    }
}

function tep_get_zone_class_title($zone_class_id)
{
    if ($zone_class_id == '0') {
        return TEXT_NONE;
    } else {
        $classes_query = tep_db_query("select geo_zone_name from " . TABLE_GEO_ZONES . " where geo_zone_id = '" . (int)$zone_class_id . "'");
        $classes = tep_db_fetch_array($classes_query);

        return $classes['geo_zone_name'];
    }
}

function tep_cfg_pull_down_zone_classes($zone_class_id, $key = '')
{
    $name = (($key) ? 'configuration[' . $key . ']' : 'configuration_value');

    $zone_class_array = array(array('id' => '0', 'text' => TEXT_NONE));
    $zone_class_query = tep_db_query("select geo_zone_id, geo_zone_name from " . TABLE_GEO_ZONES . " order by geo_zone_name");
    while ($zone_class = tep_db_fetch_array($zone_class_query)) {
        $zone_class_array[] = array(
            'id' => $zone_class['geo_zone_id'],
            'text' => $zone_class['geo_zone_name']
        );
    }

    return tep_draw_pull_down_menu($name, $zone_class_array, $zone_class_id);
}

function tep_cfg_pull_down_order_statuses($order_status_id, $key = '')
{
    global $languages_id;

    $name = (($key) ? 'configuration[' . $key . ']' : 'configuration_value');

    $statuses_array = array(array('id' => DEFAULT_ORDERS_STATUS_ID, 'text' => TEXT_DEFAULT));
    $statuses_query = tep_db_query("select orders_status_id, orders_status_name from " . TABLE_ORDERS_STATUS . " where language_id = '" . (int)$languages_id . "' order by orders_status_name");
    while ($statuses = tep_db_fetch_array($statuses_query)) {
        $statuses_array[] = array(
            'id' => $statuses['orders_status_id'],
            'text' => $statuses['orders_status_name']
        );
    }

    return tep_draw_pull_down_menu($name, $statuses_array, $order_status_id);
}

function tep_get_order_status_name($order_status_id, $language_id = '')
{
    global $languages_id;

    if ($order_status_id < 1) {
        return TEXT_DEFAULT;
    }

    if (!is_numeric($language_id)) {
        $language_id = $languages_id;
    }

    $status_query = tep_db_query("select orders_status_name from " . TABLE_ORDERS_STATUS . " where orders_status_id = '" . (int)$order_status_id . "' and language_id = '" . (int)$language_id . "'");
    $status = tep_db_fetch_array($status_query);

    return $status['orders_status_name'];
}

// Return a random value
function tep_rand($min = null, $max = null)
{
    static $seeded;

    if (!$seeded) {
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

// nl2br() prior PHP 4.2.0 did not convert linefeeds on all OSs (it only converted \n)
function tep_convert_linefeeds($from, $to, $string)
{
    if ((PHP_VERSION < "4.0.5") && is_array($from)) {
        return preg_replace('/(' . implode('|/', $from) . ')', $to, $string);
    } else {
        return str_replace($from, $to, $string);
    }
}

function tep_string_to_int($string)
{
    return (int)$string;
}

// Parse and secure the cPath parameter values
function tep_parse_category_path($cPath)
{
// make sure the category IDs are integers
    $cPath_array = array_map('tep_string_to_int', explode('_', $cPath));

// make sure no duplicate category IDs exist which could lock the server in a loop
    $tmp_array = array();
    $n = sizeof($cPath_array);
    for ($i = 0; $i < $n; $i++) {
        if (!in_array($cPath_array[$i], $tmp_array)) {
            $tmp_array[] = $cPath_array[$i];
        }
    }

    return $tmp_array;
}

//TotalB2B start
function tep_xppp_getmaxprices()
{
    //max prices per product
    return 10;
}

function tep_xppp_getpricesnum()
{
    $prices_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'XPRICES_NUM'");
    $prices = tep_db_fetch_array($prices_query);
    return $prices['configuration_value'];
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

function tep_cfg_pull_down_prices($price)
{
    for ($i = 1; $i <= tep_xppp_getmaxprices(); $i++) {
        $price_array[] = array(
            'id' => $i,
            'text' => $i
        );
    }
    return tep_draw_pull_down_menu('configuration_value', $price_array, $price);
}

function tep_update_prices($price)
{
    $do_drop = true;
    $prices_num = tep_xppp_getpricesnum();

    if ($prices_num > 1) {
        for ($i = 2; $i <= $prices_num; $i++) {
            $show_columns = tep_db_query("SHOW columns from " . TABLE_PRODUCTS . " where field='products_price_" . $i . "' ");
            $columns = tep_db_fetch_array($show_columns);
            if (empty($columns)) {
                $do_drop = false;
                tep_db_query("alter table " . TABLE_PRODUCTS . " add products_price_" . $i . " decimal(15,4) null");
            }
        }
    }
    if ($do_drop) {
        for ($i = tep_xppp_getmaxprices(); $i > $prices_num; $i--) {
            $show_columns = tep_db_query("SHOW columns from " . TABLE_PRODUCTS . " where field='products_price_" . $i . "' ");
            $columns = tep_db_fetch_array($show_columns);
            if (!empty($columns)) {
                //  if (tep_db_query("select products_price_" . $i . " from " . TABLE_PRODUCTS)) {
                tep_db_query("alter table " . TABLE_PRODUCTS . " drop products_price_" . $i);
                if (file_exists(DIR_FS_EXT . 'customers_groups/customers_groups.php')) {
                    $customers_groups_update_query = tep_db_query("select customers_groups_id, customers_groups_price from " . TABLE_CUSTOMERS_GROUPS . " where customers_groups_price = '" . $i . "'");
                    while ($customers_groups = tep_db_fetch_array($customers_groups_update_query)) {
                        tep_db_query("update " . TABLE_CUSTOMERS_GROUPS . " set customers_groups_price = '1' where customers_groups_id = '" . $customers_groups['customers_groups_id'] . "'");
                    }
                }
            }
        }
    }

    return $prices_num;
}

function tep_set_customers_status($customers_id, $customers_status)
{
    if ($customers_status == '1') {
        return tep_db_query("update " . TABLE_CUSTOMERS . " set customers_status = '1' WHERE customers_id = '" . $customers_id . "'");
    } elseif ($customers_status == '0') {
        return tep_db_query("update " . TABLE_CUSTOMERS . " set customers_status = '0' WHERE customers_id = '" . $customers_id . "'");
    } else {
        return -1;
    }
}

//TotalB2B end

// Alias function for array of configuration values in the Administration Tool
function tep_cfg_select_multioption($select_array, $key_value, $key = '')
{
    for ($i = 0; $i < sizeof($select_array); $i++) {
        $name = (($key) ? 'configuration[' . $key . '][]' : 'configuration_value');
        $string .= '<br><input type="checkbox" name="' . $name . '" value="' . $select_array[$i] . '"';
        $key_values = explode(", ", $key_value);
        if (in_array($select_array[$i], $key_values)) {
            $string .= 'CHECKED';
        }
        $string .= '> ' . $select_array[$i];
    }
    return $string;
}

//create a select list to display list of themes available for selection
function tep_cfg_pull_down_template_list($template_id, $key = '')
{
    $name = (($key) ? 'configuration[' . $key . ']' : 'configuration_value');

    $template_query = tep_db_query("select template_id, template_name from " . TABLE_TEMPLATE . " order by template_name");
    while ($template = tep_db_fetch_array($template_query)) {
        $template_array[] = array(
            'id' => $template['template_name'],
            'text' => $template['template_name']
        );
    }

    return tep_draw_pull_down_menu($name, $template_array, $template_id);
}

function tep_cfg_pull_down_minify($current_value, $key = '')
{
    $array = array(
        array('id' => '0', 'text' => MINIFY_CSSJS_0_TITLE),
        array('id' => '1', 'text' => MINIFY_CSSJS_1_TITLE),
        array('id' => '2', 'text' => MINIFY_CSSJS_2_TITLE)
    );
    /*
     * INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_description`) VALUES ('Minify CSS/JS timestamp', 'MINIFY_CSSJS_TIMESTAMP', 'Minify CSS/JS timestamp');
     */
    tep_db_query("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = '" . time() . "' WHERE configuration_key = 'MINIFY_CSSJS_TIMESTAMP'");

    return tep_draw_pull_down_menu('configuration_value', $array, $current_value);
}

function tep_cfg_pull_down_redirect_www($current)
{
    $redirects = [
        [
            'id' => '0',
            'text' => 'disable',
        ],
        [
            'id' => '1',
            'text' => 'www -> no-www',
        ],
        [
            'id' => '2',
            'text' => 'no-www -> www',
        ]
    ];

    tep_db_query("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = 0 WHERE configuration_key = 'SET_WWW'");
    return tep_draw_pull_down_menu('configuration_value', $redirects, $current);
}

/**
 * @param string $configuration_value
 */
function redirectWWW($configuration_value)
{
    if ($configuration_value === '1') {
        rewriteHtaccess(true, '#www to non-www', 2);
        rewriteHtaccess(false, '#non-www to www', 2);
    } elseif ($configuration_value === '2') {
        rewriteHtaccess(false, '#www to non-www', 2);
        rewriteHtaccess(true, '#non-www to www', 2);
    } elseif ($configuration_value === '0') {
        rewriteHtaccess(false, '#www to non-www', 2);
        rewriteHtaccess(false, '#non-www to www', 2);
    }
}

/**
 * @param string $url
 * @param int $limit
 * @return bool
 */
function isRedirectionLimitReached($url, $limit = 20)
{
    $arrContextOptions = [
        "ssl" => [
            "verify_peer" => false,
            "verify_peer_name" => false,
        ],
        'http' => [
            'max_redirects' => $limit,
            'ignore_errors' => 0
        ]
    ];
    $res = false;
    if (is_bool(@file_get_contents($url, false, stream_context_create($arrContextOptions)))) {
        $res = true;
    }

    return $res;
}

function tep_cfg_read_redirect_www($value)
{
    $array = [
        [
            'id' => '0',
            'text' => 'disable',
        ],
        [
            'id' => '1',
            'text' => 'www -> no-www',
        ],
        [
            'id' => '2',
            'text' => 'no-www -> www',
        ],
        [
            'id' => '3',
            'text' => WWW_TOO_MANY_REDIRECTS,
        ]
    ];
    $array_column = array_column($array, 'text');

    return $array_column[$value];
}

function tep_cfg_pull_down_image_cache($current_value, $key = '')
{
    $array = array(
        array('id' => '0', 'text' => IMAGE_CACHE_0_TITLE),
        array('id' => '1', 'text' => IMAGE_CACHE_1_TITLE)
    );

    return tep_draw_pull_down_menu('configuration_value', $array, $current_value);
}

function tep_cfg_pull_down_menu_location($current_value, $key = '')
{
    $array = array(
        array('id' => '0', 'text' => MENU_TOP_LOCATION), // TODO uncomment when admin top menu will be fixed
        array('id' => '1', 'text' => MENU_LEFT_LOCATION),
        array('id' => '2', 'text' => MENU_LEFT_MIN_LOCATION),
    );

    return tep_draw_pull_down_menu('configuration_value', $array, $current_value);
}

function tep_cfg_read_minify($value)
{
    $array = array(
        array('id' => '0', 'text' => MINIFY_CSSJS_0_TITLE),
        array('id' => '1', 'text' => MINIFY_CSSJS_1_TITLE),
        array('id' => '2', 'text' => MINIFY_CSSJS_2_TITLE)
    );

    $array_column = array_column($array, 'text');

    return $array_column[$value];
}

function tep_cfg_read_image_cache($value)
{
    global $path;
    $array = array(
        array('id' => '0', 'text' => IMAGE_CACHE_0_TITLE),
        array('id' => '1', 'text' => IMAGE_CACHE_1_TITLE)
    );

    $array_column = array_column($array, 'text');
    $image_cache_array = parse_ini_file($path . ".env", true);
    $image_cache_array['IMAGE_CACHE'] = $value;
    $ini_save = arr2ini($image_cache_array);
    $file_handle = fopen($path . ".env", "w");
    fwrite($file_handle, $ini_save);
    fclose($file_handle);
    return $array_column[$value];
}

function tep_read_default_date_format($value)
{
    $array = array(
        array('id' => 'm/d/Y', 'text' => 'm/d/Y'),
        array('id' => 'd.m.Y', 'text' => 'd.m.Y'),
        array('id' => 'Y-m-d', 'text' => 'Y-m-d')
    );
    $array_column = [];
    foreach ($array as $e) {
        $array_column[$e['id']] = $e['text'];
    }

    return $array_column[$value];
}

function tep_pull_down_default_date_format($current_value)
{
    $array = array(
        array('id' => 'm/d/Y', 'text' => 'm/d/Y'),
        array('id' => 'd.m.Y', 'text' => 'd.m.Y'),
        array('id' => 'Y-m-d', 'text' => 'Y-m-d')
    );

    return tep_draw_pull_down_menu('configuration_value', $array, $current_value);
}

function tep_read_default_formated_date_format($value)
{
    $array = array(
        array('id' => '%m/%d/%Y', 'text' => 'm/d/Y'),
        array('id' => '%d.%m.%Y', 'text' => 'd.m.Y'),
        array('id' => '%Y-%m-%d', 'text' => 'Y-m-d')
    );
    $array_column = [];
    foreach ($array as $e) {
        $array_column[$e['id']] = $e['text'];
    }

    return $array_column[$value];
}

function tep_pull_down_default_formated_date_format($current_value)
{
    $array = array(
        array('id' => '%m/%d/%Y', 'text' => 'm/d/Y'),
        array('id' => '%d.%m.%Y', 'text' => 'd.m.Y'),
        array('id' => '%Y-%m-%d', 'text' => 'Y-m-d')
    );

    return tep_draw_pull_down_menu('configuration_value', $array, $current_value);
}

function tep_cfg_read_menu_location($value)
{
    $array = array(
        array('id' => '0', 'text' => MENU_TOP_LOCATION),// TODO uncomment when admin top menu will be fixed
        array('id' => '1', 'text' => MENU_LEFT_LOCATION),
        array('id' => '2', 'text' => MENU_LEFT_MIN_LOCATION)
    );

    $array_column = array_column($array, 'text');

    return $array_column[$value];
}

// BOF Enable - Disable Categories Contribution--------------------------------------
// Sets the status of a category and all nested categories and products whithin.
function tep_set_categories_status($category_id, $status)
{
    global $tep_get_category_tree;
    if ($status == '1') {
        tep_db_query("update " . TABLE_CATEGORIES . " set categories_status = '1', last_modified = now() where categories_id = '" . $category_id . "'");
        //  $tree = tep_get_category_tree($category_id);
        $tree = $tep_get_category_tree[$category_id];
        if (is_array($tree)) {
            for ($i = 1; $i < sizeof($tree); $i++) {
                tep_db_query("update " . TABLE_CATEGORIES . " set categories_status = '1', last_modified = now() where categories_id = '" . $tree[$i]['id'] . "'");
            }
        }
    } elseif ($status == '0') {
        tep_db_query("update " . TABLE_CATEGORIES . " set categories_status = '0', last_modified = now() where categories_id = '" . $category_id . "'");
        //  $tree = tep_get_category_tree($category_id);
        $tree = $tep_get_category_tree[$category_id];
        if (is_array($tree)) {
            for ($i = 1; $i < sizeof($tree); $i++) {
                tep_db_query("update " . TABLE_CATEGORIES . " set categories_status = '0', last_modified = now() where categories_id = '" . $tree[$i]['id'] . "'");
            }
        }
    }
}

// EOF Enable - Disable Categories Contribution--------------------------------------

// begin mod for PrductsProperties v2.01
function tep_get_products_model($product_id, $language_id = 0)
{
    global $languages_id;

    if ($language_id == 0) {
        $language_id = $languages_id;
    }
    $product_query = tep_db_query("select p.products_model, pd.language_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = '" . (int)$product_id . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$language_id . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['products_model'];
}

function tep_get_properties_options_name($options_id)
{
    global $languages_id;

    $options = tep_db_query("select products_options_name from " . TABLE_PRODUCTS_PROP_OPTIONS . " where products_options_id = '" . (int)$options_id . "' and language_id = '" . (int)$languages_id . "'");
    $options_values = tep_db_fetch_array($options);

    return $options_values['products_options_name'];
}

function tep_get_properties_values_name($values_id)
{
    global $languages_id;

    $values = tep_db_query("select products_options_values_name from " . TABLE_PRODUCTS_PROP_OPTIONS_VALUES . " where products_options_values_id = '" . (int)$values_id . "' and language_id = '" . (int)$languages_id . "'");
    $values_values = tep_db_fetch_array($values);

    return $values_values['products_options_values_name'];
}

// end mod for PrductsProperties v2.01

//TotalB2B start
function b2b_display_price($products_id, $products_price)
{
    global $customer_id;
    $query_A = tep_db_query("select m.manudiscount_discount from "
        . TABLE_MANUDISCOUNT . " m, " . TABLE_PRODUCTS . " p where 
m.manudiscount_groups_id = 0 and m.manudiscount_customers_id = '" .
        $customer_id . "' and p.products_id = '" . $products_id . "' and 
p.manufacturers_id = m.manudiscount_manufacturers_id");
    $query_B = tep_db_query("select m.manudiscount_discount from "
        . TABLE_CUSTOMERS . " c, " . TABLE_MANUDISCOUNT . " m, " .
        TABLE_PRODUCTS . " p where m.manudiscount_groups_id = 
c.customers_groups_id  and m.manudiscount_customers_id = 0 and 
c.customers_id = '" . $customer_id . "' and p.products_id = '" .
        $products_id . "' and p.manufacturers_id = 
m.manudiscount_manufacturers_id");
    $query_C = tep_db_query("select m.manudiscount_discount from "
        . TABLE_MANUDISCOUNT . " m, " . TABLE_PRODUCTS . " p where 
m.manudiscount_groups_id = 0 and m.manudiscount_customers_id = 0 and 
p.products_id = '" . $products_id . "' and p.manufacturers_id = 
m.manudiscount_manufacturers_id");
    if ($query_result = tep_db_fetch_array($query_A)) {
        $customer_discount = $query_result['manudiscount_discount'];
    } else {
        if ($query_result = tep_db_fetch_array($query_B)) {
            $customer_discount = $query_result['manudiscount_discount'];
        } else {
            if ($query_result = tep_db_fetch_array($query_C)) {
                $customer_discount = $query_result['manudiscount_discount'];
            } else {
                $customer_discount = 0;
                if (file_exists(DIR_FS_EXT . 'customers_groups/customers_groups.php')) {
                    $query = tep_db_query("select g.customers_groups_discount
                from " . TABLE_CUSTOMERS_GROUPS . " g inner join  " . TABLE_CUSTOMERS .
                        " c on g.customers_groups_id = c.customers_groups_id and c.customers_id
                = '" . $customer_id . "'");
                    $query_result = tep_db_fetch_array($query);
                    $customers_groups_discount =
                        $query_result['customers_groups_discount'];
                    $query = tep_db_query("select customers_discount from " .
                        TABLE_CUSTOMERS . " where customers_id =  '" . $customer_id . "'");
                    $query_result = tep_db_fetch_array($query);
                    $customer_discount = $query_result['customers_discount'];
                    $customer_discount = $customer_discount +
                        $customers_groups_discount;
                }
            }
        }
    }
    if ($customer_discount >= 0) {
        $products_price = $products_price + $products_price *
            abs($customer_discount) / 100;
    } else {
        $products_price = $products_price - $products_price *
            abs($customer_discount) / 100;
    }
    return $products_price;
}

//TotalB2B end

function tep_get_languages_directory($code)
{
    global $languages_id;
    $language_query = tep_db_query("select languages_id, directory from " . TABLE_LANGUAGES . " where code = '" . tep_db_input($code) . "'");
    if (tep_db_num_rows($language_query)) {
        $language = tep_db_fetch_array($language_query);
        $languages_id = $language['languages_id'];
        return $language['directory'];
    } else {
        return false;
    }
}

// BOF: WebMakers.com Added: Downloads Controller
require(DIR_WS_FUNCTIONS . 'downloads_controller.php');
// EOF: WebMakers.com Added: Downloads Controller

// Function to reset SEO URLs database cache entries
// Ultimate SEO URLs v2.1
function tep_reset_cache_data_seo_urls($action)
{
    // raid 22.07.15:
    if ($action == 'true') {
        $action = 'reset';
    }

    switch ($action) {
        case 'reset':
            tep_db_query("DELETE FROM cache WHERE cache_name LIKE '%seo_urls%'");
            tep_db_query("UPDATE configuration SET configuration_value='false' WHERE configuration_key='SEO_URLS_CACHE_RESET'");
            break;
        default:
            break;
    }

    return 'false';
    # The return value is used to set the value upon viewing
    # It's NOT returining a false to indicate failure!!

}

// переіменуємо картинку якщо така вже існує
function tep_rename_images($img_string, $separator)
{
    global $path;

    $new_images_array = explode($separator, $img_string);
    $new_images_str = '';
    foreach ($new_images_array as $k => $v) {
        $image_file = $v;

        $newimage_file = tep_check_duplicates_images($v);
        // копіюємо файл з новою назвою
        if (!empty($image_file)) {
            if (file_exists($path . 'images/categories/' . $image_file)) {
                if (!copy($path . 'images/categories/' . $image_file, $path . 'images/categories/' . $newimage_file)) {
                    echo "failed to copy $image_file...\n";
                }
                // END копіюємо файл з новою назвою
            } elseif (file_exists($path . 'images/products/' . $image_file)) {
                if (!copy($path . 'images/products/' . $image_file, $path . 'images/products/' . $newimage_file)) {
                    echo "failed to copy $image_file...\n";
                }
                // END копіюємо файл з новою назвою
            } elseif (file_exists($path . 'images/' . $image_file)) {
                if (!copy($path . 'images/' . $image_file, $path . 'images/' . $newimage_file)) {
                    echo "failed to copy $image_file...\n";
                }
                // END копіюємо файл з новою назвою
            }
        }

        $new_images_str .= $newimage_file . $separator;
    }
    $new_images_str = substr($new_images_str, 0, -1);

    if ($img_string == '') {
        $new_images_str = $img_string;
    }
    return $new_images_str;
}

function tep_check_duplicates_images($img_name)
{
    global $path;

    if (preg_match_all('#\((.*?)\)\.#', $img_name, $matches_tmp) and preg_match_all('#\((.*?)\)#', $img_name, $matches)) { // если есть чтото в кавычках перед точкой
        $last_el = $matches[1][count($matches[1]) - 1]; // ищем последние кавычки в названии
        $newimage_file = preg_replace('/\(' . $last_el . '\)\./', '(' . ($last_el + 1) . ').', $img_name);  // увеличиваем значение на 1
    } else {
        $curr_img_name = explode('.', $img_name);
        $extension = $curr_img_name[count($curr_img_name) - 1];
        unset($curr_img_name[count($curr_img_name) - 1]);
        $newimage_file = implode('.', $curr_img_name) . '(1).' . $extension;
    }

    if (@file_exists($path . '/images/products/' . $newimage_file)) {
        return tep_check_duplicates_images($newimage_file);
    } else {
        return $newimage_file;
    }

}

/* debug */

function debug($data, $var_dump = true)
{
    echo "<pre class='debug'>";
    if ($var_dump) {
        echo var_dump($data);
    } else {
        print_r($data);
    }

    echo "</pre>";
    return true;
}

function tep_select_color($mcolor)
{
    $html = '<link rel="stylesheet" media="screen" type="text/css" href="includes/javascript/colorpicker/css/colorpicker.css" />
             <script src="includes/javascript/colorpicker/js/colorpicker.js"></script>
             <script>
              	$(function() {
                    var picker_field = "#colorpickerField";
                    $(picker_field).ColorPicker({
                    	color: "#' . $mcolor . '",
                      onChange: function (hsb, hex, rgb) {
                    		$(picker_field).val(hex);    
                        $(picker_field).attr("value",hex);
                    	}
                    });
                });
             </script>
             <input type="text" name="configuration_value" value="' . $mcolor . '" id="colorpickerField" size="6" maxlength="6">';
    return $html;
}

// raid 24.11.16 - перевірка чи куплений модуль (чи існує папка)
function tep_check_modules_folder($value)
{
    global $languages_code;
    $values_array = explode(':', $value);

    if (is_dir(DIR_FS_CATALOG . 'ext/' . $values_array[0])) {
        return $values_array[0] . ':' . $values_array[1];
    } else {
        return '
        <a class="buyme" target="_blank" href="https://solomono.net/' . $languages_code . '/?module=' . $values_array[0] . '">
        <svg height="14" width="14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
        <path fill="#fff" d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z"></path>
        </svg>' . ADMIN_BTN_BUY_MODULE . '</a>';
    }
}

function tep_module_link($configuration_value)
{
    $module_data = explode(':', $configuration_value);

    if (count($module_data) > 0) {
        return '//solomono.net/?module=' . $module_data[0];
    }

    return false;
}

function tep_module_dir($configuration_value)
{
    $module_data = explode(':', $configuration_value);

    if (count($module_data) > 0) {
        return DIR_FS_CATALOG . 'ext/' . $module_data[0];
    }

    return false;
}

function tep_module_exists($configuration_value)
{
    $module_dir = tep_module_dir($configuration_value);

    if (file_exists($module_dir) && is_dir($module_dir)) {
        return true;
    }

    return false;
}

function tep_modules_block_module_button($configuration_value)
{
    if (tep_module_exists($configuration_value)) {
        $module_data = explode(':', $configuration_value);

        if (count($module_data) > 1) {
            if ($module_data[1] === 'true') {
                ?>
                <label class="i-switch i-switch-xs bg-info disabled">
                    <input type="checkbox" tabindex="0" checked disabled>
                    <i></i>
                </label>
                <?php
            } else {
                ?>
                <label class="i-switch i-switch-xs bg-info disabled">
                    <input type="checkbox" tabindex="0" disabled>
                    <i></i>
                </label>
                <?php
            }
        }
    } else {
        ?>
        <a href="<?php print tep_module_link($configuration_value); ?>" target="_blank">
            <button class="btn btn-rounded btn-xs btn-icon btn-default m-r pull-left bg-success">
                <i class="fa fa-shopping-cart text-white"></i>
            </button>
        </a>
        <?php
    }

    return false;
}

function tep_is_active_menu($path = '')
{
    $menu_path = DIR_WS_ADMIN . $path;

    if (($result = preg_match('#' . $menu_path . '(\?|$)#', $_SERVER['REQUEST_URI'])) != false) {
        return true;
    }

    return false;
}

function tep_array_merge($array1, $array2, $array3 = '')
{
    if ($array3 == '') {
        $array3 = array();
    }
    if (function_exists('array_merge')) {
        $array_merged = array_merge($array1, $array2, $array3);
    } else {
        foreach ($array1 as $key => $val) {
            $array_merged[$key] = $val;
        }
        // while (list($key, $val) = each($array1)) $array_merged[$key] = $val;
        foreach ($array2 as $key => $val) {
            $array_merged[$key] = $val;
        }
        // while (list($key, $val) = each($array2)) $array_merged[$key] = $val;
        if (sizeof($array3) > 0) {
            foreach ($array3 as $key => $val) {
                $array_merged[$key] = $val;
            }
        }
        //while (list($key, $val) = each($array3)) $array_merged[$key] = $val;
    }

    return (array)$array_merged;
}

function file_upload($path = '')
{
    if (file_exists(DIR_FS_CATALOG . $path) && !is_dir($path)) {
        return '<span class="image editable"><img class="image img-responsive" data-toggle="tooltip" data-placement="right" src="' . HTTP_SERVER . '/' . $path . '?' . rand() . '" alt="' . $path . '"></span>';
    } else {
        return '<span class="image editable"><img class="image img-responsive" data-toggle="tooltip" data-placement="right" src="/" alt="">' . TEXT_SETTINGS_EDIT_FORM_TOOLTIP . '<span>';
    }
}

/**
 * @param bool $flag
 * @param string $search
 * @param integer $line_quantity
 */

function rewriteHtaccess($flag, $search, $line_quantity)
{
    $file = DIR_ROOT . DS . '.htaccess';
    $handle = fopen($file, "r+");

    $searching = $search . (($flag == 'true') ? ' OFF#' : ' ON#');
    $lines = 0;
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            if ($lines > 0 && $lines <= $line_quantity) {
                $lines++;
                $line = $flag == 'true' ? substr($line, 1) : "#$line";
            }
            if (strpos($line, $searching) !== false) {
                $lines++;
                $line = $search . (($flag == 'true') ? ' ON#' : ' OFF#') . "\r\n";
            }
            $result[] = $line;
        }
        file_put_contents($file, implode('', $result));
        fclose($handle);
    }
}

function tep_cfg_pull_down_attr_list($attr_id)
{
    global $languages_id;
    $result = [];

    $options = tep_db_query("select products_options_id,products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where products_options_type >0 AND  language_id = '" . (int)$languages_id . "'");
    while ($options_values = tep_db_fetch_array($options)) {
        $result[] = array(
            'id' => $options_values['products_options_id'],
            'text' => $options_values['products_options_name']
        );
    }

    return tep_draw_pull_down_menu('configuration_value', $result, $attr_id);
}

function tep_get_attr_name($attr_id)
{
    if (is_dir(DIR_FS_CATALOG . 'ext/multicolor')) {
        return tep_options_name($attr_id);
    }
    return '<a class="buyme" target="_blank" href="https://solomono.net/?module=multicolor">' . ADMIN_BTN_BUY_MODULE . '</a>';
}

/* One Page Checkout - BEGIN*/
function tep_cfg_pull_down_zone_list_one_page($zone_id)
{
    return tep_draw_pull_down_menu('configuration_value', tep_get_country_zones(STORE_COUNTRY), $zone_id);
}

/* One Page Checkout - END*/


function fixObject(&$object)
{
    if (!is_object($object) && gettype($object) == 'object') {
        return ($object = unserialize(serialize($object)));
    }
    return $object;
}

function rewriteRobots($switch)
{
    if ($switch == "true") {
        unset($_SESSION['alertErrors']['robots_txt']);
        unset($_SESSION['critical_for_site']);
        $robot = 'User-Agent: *
Disallow: /includes/ 
Disallow: /tmp/
Disallow: /.htaccess
Disallow: /*account.php
Disallow: /*account_edit.php
Disallow: /*account_history.php
Disallow: /*account_history_info.php
Disallow: /*account_password.php
Disallow: /*address_book.php
Disallow: /*address_book_process.php
Disallow: /*checkout_process.php
Disallow: /*checkout_success.php
Disallow: /*cookie_usage.php
Disallow: /*create_account.php
Disallow: /*create_account_success.php
Disallow: /*login.php*
Disallow: /*logoff.php
Disallow: /*password_forgotten.php
Disallow: /*pollbooth.php*
Disallow: /*?row_by_page*  
Disallow: /*?op*
Disallow: /*?pdf=true*
Disallow: /*index.php?r=* 
Disallow: /*?keywords=*
Allow: /includes/javascript/
Allow: /includes/modules/rating/rating.js

Host: ' . HTTP_SERVER . '/
Sitemap: ' . HTTP_SERVER . '/sitemap.xml';
    } else {
        $_SESSION['critical_for_site'] = (strpos($_SERVER["SERVER_NAME"], 'solomono.net') === false) ? 'true' : 'false';
        $_SESSION['alertErrors']['robots_txt'] = [
            "text" => "ROBOTS_TXT_RECOMMENDATION_TEXT",
            "type" => "alert_danger",
            "critical_for_site" => $_SESSION['critical_for_site']
        ];
        $robot = 'User-agent: *
Disallow: /
                      
Host: ' . $_SERVER['HTTP_HOST'];
    }
    $file = DIR_ROOT . DS . 'robots.txt';
    file_put_contents($file, $robot);
}

function readRobotsHost()
{
    $robotsTxtContent = file_get_contents(DIR_FS_CATALOG . "robots.txt");
    $s = preg_split('#[\n]+#is', $robotsTxtContent);
    $current_hots = '';
    foreach ($s as $line) {
        $line = trim(current(explode('#', trim($line), 2)));
        if (substr_count($line, ':') < 1) {
            continue;
        }
        $line = explode(':', $line, 2);
        $current_directive = trim($line[0]);
        $current_value = trim($line[1]);
        if ($current_directive == 'Host') {
            $current_host = $current_value;
        }
    }
    return $current_host;
}

function tep_get_order_info($order_id)
{
    global $languages_id;
    $order_info_array = array();
    //$search = " and (o.delivery_country != 'Киев' or o.customers_country != 'Киев' or s.orders_status_name = 'Оплата получена' or s.orders_status_name = 'Ожидает оплаты')";
    $orders_query = tep_db_query("select o.orders_id, o.customers_id, o.customers_name, o.customers_email_address, o.customers_telephone, o.customers_fax, o.customers_country, o.payment_method, o.delivery_name, o.delivery_country, o.date_purchased, o.customers_street_address, o.last_modified, s.orders_status_id, s.orders_status_name, ot.text as order_total from " . TABLE_ORDERS . " o left join " . TABLE_ORDERS_TOTAL . " ot on (o.orders_id = ot.orders_id), " . TABLE_ORDERS_STATUS . " s where o.orders_status = s.orders_status_id and s.language_id = '" . (int)$languages_id . "' and o.orders_id = '" . (int)$order_id . "' and ot.class = 'ot_total' order by o.orders_id DESC");
    $order_info_array = tep_db_fetch_array($orders_query);
    return $order_info_array;
}

function getCategoryTree()
{
    global $languages_id;
    $sql = "SELECT
                  `c`.`categories_id`    AS `id`,
                  `c`.`parent_id`,
                   cd.categories_name,
                   c.categories_icon,
                   c.categories_image,
                  (select count(*) as cnt from categories cc left join categories_description cd on cd.categories_id = cc.categories_id where cc.parent_id = `c`.`categories_id` and cd.language_id={$_SESSION['languages_id']}) as childs
                FROM `categories` `c`, categories_description cd                           
                where c.categories_id = cd.categories_id and cd.language_id=" . ($languages_id ?: $_SESSION['languages_id']) . "
                ORDER BY c.sort_order, cd.categories_name";   // and c.categories_status='1'
    return $sql;
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
    global $cat_names, $cat_icons, $cat_imgs;
    $tree = array();
    foreach ($dataset as $id => &$node) {
        $cat_names[$node['id']] = $node['categories_name'];  // массив id-название
        $cat_imgs[$node['id']] = $node['categories_image'];  // массив id-картинка
        $cat_icons[$node['id']] = $node['categories_icon'];  // массив id-icon
        // $cat_childs[$node['id']]=$node['childs'];
        // $cat_description[$node['id']]=$node['categories_description'];  // массив id-icon

        $parent_id = $node['parent_id'];
        $childs = $node['childs'];

        unset($node['parent_id']);
        unset($node['id']);
        unset($node['childs']);
        unset($node['categories_name']);
        unset($node['categories_image']);
        unset($node['categories_icon']);
        unset($node['categories_description']);

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
        }
    }
    return $tree;
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

if (!function_exists('delTree')) {
    function delTree($dir)
    {
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }
}

/**
 * @param $order_statuses - массив из статусов
 * функиция для печати чекбокс меню
 */
function check_box_menu($order_statuses)
{
    $result = "";
    foreach ($order_statuses as $status) {
        if (isset($_GET['statuses'])) {
            $checked = in_array($status['id'], $_GET['statuses']) ? "checked" : "";
        } else {
            $checked = "checked";
        } // checked
        $result .= "<div class='checkbox_menu_item'><input type='checkbox' name='statuses[]' value='" . $status['id'] . "' " . $checked . "> <label class='menu_label'> " . $status['text'] . "</label></div>";
    }

    $result .= "<input id='btn_status' type=\"submit\" name=\"Submit\" value=\"" . SHOW_TEXT . "\"><br>";

    echo "<div class='checkbox_menu'>$result</div>";

}

if (!function_exists('rrmdir')) {
    function rrmdir($src)
    {
        $dir = opendir($src);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                $full = $src . '/' . $file;
                if (is_dir($full)) {
                    rrmdir($full);
                } else {
                    unlink($full);
                }
            }
        }
        closedir($dir);
        rmdir($src);
    }
}

function isMobile()
{
    if (preg_match("/(ipad)/i", $_SERVER["HTTP_USER_AGENT"])) {
        return false;
    } else {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }
}

function number_shorten($number, $precision = 1, $divisors = null)
{
    if ($number < 1000) {
        return $number;
    }

    // Setup default $divisors if not provided
    if (!isset($divisors)) {
        $divisors = array(
            pow(1000, 0) => '', // 1000^0 == 1
            pow(1000, 1) => 'k', // Thousand
            pow(1000, 2) => 'm', // Million
            pow(1000, 3) => 'b', // Billion
            pow(1000, 4) => 't', // Trillion
            pow(1000, 5) => 'Qa', // Quadrillion
            pow(1000, 6) => 'Qi', // Quintillion
        );
    }

    // Loop through each $divisor and find the
    // lowest amount that matches
    foreach ($divisors as $divisor => $shorthand) {
        if (abs($number) < ($divisor * 1000)) {
            // We found a match!
            break;
        }
    }

    // We found our match, or there were no matches.
    // Either way, use the last defined value for $divisor.
    return number_format($number / $divisor, $precision) . $shorthand;
}

/**
 * GET ALL SALES MAKERS
 */

/**
 * @param $salemaker_result
 * @param $listing_sm
 * @return mixed|string
 */
function getSalesMakersPrice($salemaker_result, $listing_sm)
{
    $tmp_special_price = $product_price = $special_price = $listing_sm['products_price'];

    switch ($salemaker_result['sale_deduction_type']) {
        case '0':
            $sale_product_price = $product_price - $salemaker_result['sale_deduction_value'];
            $sale_special_price = $tmp_special_price - $salemaker_result['sale_deduction_value'];
            break;
        case '1':
            $sale_product_price = $product_price - (($product_price * $salemaker_result['sale_deduction_value']) / 100);
            $sale_special_price = $tmp_special_price - (($tmp_special_price * $salemaker_result['sale_deduction_value']) / 100);
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

    $return_price = number_format($sale_special_price, 4, '.', '');

    return $return_price;
}

function getSaleMakersProductsSelected()
{
    $salesMakersProductsSelected = [];
    $salesMakersCategoriesArray = [];
    $salesMakersManufacturersArray = [];
    $selectedManufacturers = [];
    $salesMakersQuery = tep_db_query("SELECT * FROM " . TABLE_SALEMAKER_SALES . " where sale_status = '1' and (sale_date_start <= CURDATE() or sale_date_start = '0000-00-00') and (sale_date_end >= CURDATE() or sale_date_end = '0000-00-00')");
    while ($saleRow = $salesMakersQuery->fetch_assoc()) {
        if ($saleRow['sale_manufacturers_selected']) {
            $salesMakersManufacturersArray[] = $saleRow;
        }

        if ($saleRow['sale_categories_selected']) {
            $salesMakersCategoriesArray[] = $saleRow;
        }
    }

    if ($salesMakersManufacturersArray) {
        foreach ($salesMakersManufacturersArray as $manufacturers) {
            $tempManuf = explode(',', $manufacturers['sale_manufacturers_selected']);

            foreach ($tempManuf as $manufacturerId) {
                $productsQuery = tep_db_query("SELECT products_id, products_price FROM products WHERE manufacturers_id = '" . (int)$manufacturerId . "'");
                while ($row = $productsQuery->fetch_assoc()) {
                    $salesMakersProductsSelected[$row['products_id']] = getSalesMakersPrice($manufacturers, $row);
                }
            }
        }
    }

    if ($salesMakersCategoriesArray) {
        foreach ($salesMakersCategoriesArray as $categories) {
            $tempCategories = explode(',', $categories['sale_categories_selected']);

            foreach ($tempCategories as $categoriesId) {
                $productsQuery = tep_db_query("SELECT p.products_id, p.products_price FROM products p LEFT JOIN products_to_categories p2c ON p2c.products_id = p.products_id WHERE p2c.categories_id = '" . $categoriesId . "'");
                while ($row = $productsQuery->fetch_assoc()) {
                    $salesMakersProductsSelected[$row['products_id']] = getSalesMakersPrice($categories, $row);
                }
            }
        }
    }

    return $salesMakersProductsSelected;
}

function searchLangFilesInArr($fileName, $array, $baseName)
{
    if ($baseName !== 'languages') {
        return true;
    }
    $arr = explode("_", explode(".", $fileName)[0]);
    return array_search(end($arr), $array);
}

function searchInPath($path, $array)
{
    $result = false;
    foreach ($array as $key => $value) {
        if (strpos($path, $value) !== false) {
            $result = true;
        }
    }
    return $result;
}

function tep_cfg_pull_down_multiple_order_statuses($order_status_id, $key = '')
{
    global $languages_id;

    $name = 'configuration_value[]';

    $statuses_array = array(array('id' => '0', 'text' => TEXT_DEFAULT));
    $statuses_query = tep_db_query("select orders_status_id, orders_status_name from " . TABLE_ORDERS_STATUS . " where language_id = '" . (int)$languages_id . "' order by orders_status_name");
    while ($statuses = tep_db_fetch_array($statuses_query)) {
        $statuses_array[] = array(
            'id' => $statuses['orders_status_id'],
            'text' => $statuses['orders_status_name']
        );
    }

    return tep_draw_pull_down_menu($name, $statuses_array, $order_status_id, "multiple");
}

function tep_cfg_pull_down_sms_gatename_list($sms_gatename)
{
    return tep_draw_pull_down_menu('configuration_value', tep_get_sms_gatenames(), $sms_gatename);

}

function tep_get_multiple_order_status_names($values, $language_id = '')
{
    global $languages_id;
    $order_status_names = "";

    $order_statuses = unserialize($values);
    if (is_array($order_statuses) && 0 != count($order_statuses)) {
        if (!is_numeric($language_id)) {
            $language_id = $languages_id;
        }

        $status_query = tep_db_query("select orders_status_name from " . TABLE_ORDERS_STATUS . " where orders_status_id IN (" . implode($order_statuses,
                ',') . ") and language_id = '" . (int)$language_id . "'");
        while ($status = tep_db_fetch_array($status_query)) {
            $order_status_names .= $status['orders_status_name'] . ', ';
        }
    }

    return trim($order_status_names, ', ');
}

/**
 * Function update order views count
 * @param int $orderId
 */
function updateOrderViewsCount($orderId)
{
    $orderId = (int)$orderId;
    tep_db_query("UPDATE " . TABLE_ORDERS . " SET views = (views + 1) WHERE orders_id = '{$orderId}'");
}

/**
 * Function return count of orders
 * @param string $from [Y-m-d H:i:s]
 * @param string|null $to [Y-m-d H:i:s]
 * @return int Count of orders
 */
function getOrdersCountForPeriod($from, $to = null)
{
    $sql = "SELECT COUNT(*) AS count FROM orders WHERE date_purchased ";
    if ($to) {
        $sql .= "BETWEEN '{$from}' AND '{$to}'";
    } else {
        $sql .= ">= '{$from}'";
    }
    $query = tep_db_query($sql);
    $countRow = tep_db_fetch_array($query);
    return (int)$countRow['count'];
}

function addHostnameToLink($link)
{
    return strstr($link, HTTP_SERVER) ? $link : HTTP_SERVER . (substr($link, 0, 1) === '/' ? $link : '/' . $link);
}

function Salt()
{
    return substr(strtr(base64_encode(hex2bin(RandomToken(32))), '+', '.'), 0, 44);
}

function isExtensionExist($extensionName)
{
    return is_dir(
        __DIR__ .
        DIRECTORY_SEPARATOR .
        ".." .
        DIRECTORY_SEPARATOR .
        ".." .
        DIRECTORY_SEPARATOR .
        ".." .
        DIRECTORY_SEPARATOR .
        "ext" .
        DIRECTORY_SEPARATOR .
        $extensionName
    );
}

function getGroupConfigurationKeys()
{
    $query = tep_db_query("
        SELECT configuration_group_id
             , configuration_group_key
        FROM " . TABLE_CONFIGURATION_GROUP . "
    ");

    $keys = [];
    while ($row = tep_db_fetch_array($query)) {
        $keys[$row['configuration_group_id']] = $row['configuration_group_key'];
    }
    return $keys;
}

/**
 * Function return map (id -> title)
 * with sub configuration titles
 *
 * @param $languageId
 * @return string[]
 */
function getAllSubConfiguration($languageId)
{
    $query = tep_db_query("
        SELECT id, title
        FROM sub_configuration
        WHERE language_id = '" . $languageId . "'
    ");

    $result = [];
    while ($row = tep_db_fetch_array($query)) {
        $result[$row['id']] = $row['title'];
    }

    return $result;
}

function getConfigurationKeyById($id)
{
    $id = (int)$id;
    $query = tep_db_query("SELECT configuration_key FROM " . TABLE_CONFIGURATION . " WHERE configuration_id = '{$id}'");
    return $query->num_rows ? tep_db_fetch_array($query)['configuration_key'] : '';
}

function includeLanguages($languagePath)
{
    static $included = [];
    $languagePath = str_replace(".php", ".json", $languagePath);
    if (!isset($included[$languagePath])) {
        $json = file_get_contents($languagePath);
        $constants = json_decode($json, true);
        foreach ($constants as $constantName => $constantValue) {
            if (!defined($constantName)) {
                define($constantName, $constantValue);
            }
        }
        $included[$languagePath] = $languagePath;
    }
}

function printMenuItem($fileName, $text, $menu_location, $PHP_SELF, $toolTip = null, $parameters = '')
{
    $result = '';
    if (new_tep_admin_check_boxes($fileName) == true) {
        $calss = '';
        if (strstr(basename($PHP_SELF), $fileName) && $menu_location != '0') {
            $calss .= 'class="active"';
        }
        $result .= '<li ' . $calss . ' >';
        $result .= '<a href="' . tep_href_link($fileName, $parameters) . '">';
        $result .= '' . $text . " " . $toolTip . '';
        $result .= '</a>';
        $result .= '</li>';
    }
    return $result;
}

function printMenuItemNotExist($text, $link, $buttonText, $class = '', $id = '')
{
    $result = '';
    if ($class) {
        $class = 'class="' . $class . '"';
    }
    $result .= '<li ' . $class . '>
        <a target="blank" style="color:grey;" href="' . $link . '" data-id="' . $id . '">
	        <span>' . $text . ' <strong class="badge-buy">' . $buttonText . '</strong></span>
        </a>
    </li>';

    return $result;
}

function adminFirstFreeLogin($token)
{
    $hash = md5('first login');
    if ($token === $hash) {
        $query = tep_db_query('
        select
            admin_id as login_id, 
            admin_groups_id as login_groups_id, 
            admin_firstname as login_firstname, 
            admin_lastname as login_lastname, 
            admin_created as login_created, 
            admin_email_address as login_email_address,
            admin_created as login_created,
            admin_lognum as login_lognum
        from ' . TABLE_ADMIN . ' where `admin_right_access` = "' . $hash . '"');

        if (tep_db_num_rows($query)) {
            $adminInfo = tep_db_fetch_array($query);

            $_SESSION['login_id'] = $adminInfo['login_id'];
            $_SESSION['login_groups_id'] = $adminInfo['login_groups_id'];
            $_SESSION['login_first_name'] = $adminInfo['login_firstname'];
            $_SESSION['login_last_name'] = $adminInfo['login_lastname'];
            $_SESSION['login_email_address'] = $adminInfo['login_email_address'];
            $_SESSION['login_created'] = $adminInfo['login_created'];
            $_SESSION['login_lognum'] = $adminInfo['login_lognum'];
            $_SESSION['gaCurrentId'] = [];

            tep_db_query(
                "update " . TABLE_ADMIN . " set admin_logdate = now(), admin_lognum = admin_lognum+1, 	admin_right_access = '' where admin_id = '" . $adminInfo['login_id'] . "'"
            );

            tep_redirect(tep_href_link(FILENAME_DEFAULT));
            exit();
        }
    }
    tep_db_query(
        "update " . TABLE_ADMIN . " set admin_logdate = now(), admin_lognum = admin_lognum+1, 	admin_right_access = '' where admin_right_access = '" . $hash . "'"
    );
}

function adminAutoLogin($token, $customer_email)
{
    $query = tep_db_query('
        select
            admin_id as login_id, 
            admin_groups_id as login_groups_id, 
            admin_firstname as login_firstname, 
            admin_lastname as login_lastname, 
            admin_created as login_created, 
            admin_email_address as login_email_address,
            admin_created as login_created,
            admin_lognum as login_lognum,
            admin_right_access as login_right_access
        from ' . TABLE_ADMIN . ' where `admin_email_address` = "' . $customer_email . '"');

    if (tep_db_num_rows($query)) {
        $adminInfo = tep_db_fetch_array($query);

        if ($adminInfo['login_right_access'] == $token) {
            $_SESSION['login_id'] = $adminInfo['login_id'];
            $_SESSION['login_groups_id'] = $adminInfo['login_groups_id'];
            $_SESSION['login_first_name'] = $adminInfo['login_firstname'];
            $_SESSION['login_last_name'] = $adminInfo['login_lastname'];
            $_SESSION['login_email_address'] = $adminInfo['login_email_address'];
            $_SESSION['login_created'] = $adminInfo['login_created'];
            $_SESSION['login_lognum'] = $adminInfo['login_lognum'];
            $_SESSION['gaCurrentId'] = [];

            tep_db_query(
                "update " . TABLE_ADMIN . " set admin_logdate = now(), admin_lognum = admin_lognum+1, 	admin_right_access = '' where admin_id = '" . $adminInfo['login_id'] . "'"
            );

            tep_redirect(tep_href_link(FILENAME_DEFAULT));
            exit();
        }
    }
}

function getTextForDisabledModule($translationModuleName, $isSetModule)
{
    if ($isSetModule) {
        $str = sprintf(TEXT_INFO_BUY_MODULE, $translationModuleName, tep_href_link(FILENAME_CONFIGURATION, 'gID=277'));
    } else {
        $str = sprintf(TEXT_INFO_DISABLE_MODULE, $translationModuleName, LINK_TO_SHOP);
    }

    return $str;
}

function getActiveShippingModules()
{
    $activeShippingModulesString = tep_db_fetch_array(tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key='MODULE_SHIPPING_INSTALLED'"));

    return explode(';', $activeShippingModulesString['configuration_value']);
}

function tep_get_languages_id($code)
{
    global $languages_id;
    $language_query = tep_db_query("select languages_id from " . TABLE_LANGUAGES . " where code = '" . $code . "'");
    if (tep_db_num_rows($language_query)) {
        $language = tep_db_fetch_array($language_query);
        $languages_id = $language['languages_id'];
        return $language['languages_id'];
    } else {
        return false;
    }
}

// return an array with gatenames
function tep_get_sms_gatenames()
{
    $sms_gatenames_array = array();
    $files = glob('../ext/sms/smsgate/*.php');
    $i = 0;
    foreach ($files as $file) {
        $sms_gatenames_array[] = array('id' => $i, 'text' => basename($file, '.php'));
        $i++;
    }

    return $sms_gatenames_array;
}

function tep_get_sms_gatename($sms_gatename_id)
{
    $sms_gatenames_array = array();
    $files = glob(ROOT_DIR . '/' . DIR_WS_EXT . 'sms/smsgate/*.php');
    $i = 0;
    foreach ($files as $file) {
        $sms_gatenames_array[] = array('id' => $i, 'text' => basename($file, '.php'));
        $i++;
    }

    return $sms_gatenames_array[$sms_gatename_id]['text'];
}

/**
 * @param array $categoriesArray
 * @param int $currentCategoryId
 * @param array $result
 *
 * @return array $result
 */
function getSubCategoriesIds($categoriesArray, $currentCategoryId, &$result = [])
{
    if ($currentCategoryId == '0') {
        foreach ($categoriesArray as $key => $val) {
            $result[] = $key;
            getSubCategoriesValue($val, $result);
            if (is_array($val)) {
                getSubCategoriesIds($val, $currentCategoryId, $result);
            }
        }
    } else {
        foreach ($categoriesArray as $key => $val) {
            if ($key == $currentCategoryId) {
                $result[] = $key;
                getSubCategoriesValue($val, $result);
            } elseif (is_array($val)) {
                getSubCategoriesIds($val, $currentCategoryId, $result);
            }
        }
    }

    return array_unique($result);
}

/**
 * @param mixed $categoriesArray
 * @param array $result
 *
 * @return array $result
 */
function getSubCategoriesValue($categoriesArray, &$result)
{
    if (is_array($categoriesArray)) {
        foreach ($categoriesArray as $key => $val) {
            $result[] = $key;
            getSubCategoriesValue($val, $result);
        }
    } else {
        $result[] = $categoriesArray;
    }
    return $result;
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

function checkConst($const_name, $checkEmpty = false)
{
    $state = defined($const_name);
    if ($checkEmpty && $state) {
        $const = constant($const_name);
        $state = !empty($const);
    }
    return $state ? constant($const_name) : '';
}

function tep_setcookie($name, $value = '', $expire = 0, $path = '/', $domain = '', $secure = 0)
{
    setcookie($name, $value, $expire, $path);
}

/**
 * Receive http/https and check exist redirect https/https or no
 *
 * @param $http
 * @return bool
 */
function isRedirectHttpToHttps(string $http): bool
{
    $res = false;
    $url = $http . '://' . $_SERVER['SERVER_NAME'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    $out = curl_exec($ch);
    curl_close($ch);
    // line endings is the wonkiest piece of this whole thing
    $out = str_replace("\r", "", $out);

    // only look at the headers
    $headers_end = strpos($out, "\n\n");
    if ($headers_end !== false) {
        $out = substr($out, 0, $headers_end);
    }

    $headers = explode("\n", $out);
    foreach ($headers as $header) {
        if (substr($header, 0, 10) == "Location: ") {
            $target = substr($header, 10);

            $firstProtocol = explode(":", $url)[0];
            $secondProtocol = explode(":", $target)[0];
            if ($firstProtocol !== $secondProtocol) {
                $res = true;
            }
            break;
        }
    }

    return $res;
}

function isHttpsOn($url) {
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_AUTOREFERER    => true,
        CURLOPT_CONNECTTIMEOUT => 5,
        CURLOPT_ENCODING       => "",
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_MAXREDIRS      => 1,
        CURLOPT_NOBODY         => true,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_TIMEOUT        => 5,
        CURLOPT_USERAGENT      => "Mozilla/5.0",
    ]);
    curl_exec($ch);

    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($code === 200) {
        return true;
    }
    return false;
}

/**
 * set MINIFY_CSSJS = 1 when MINIFY_CSSJS == 2
 */
function resetMinifiedFiles()
{
    if (file_exists(DIR_FS_EXT . 'minifier/minifier.php')) {
        tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '1', last_modified = now() where configuration_key = 'MINIFY_CSSJS' AND configuration_value = '2'");
        tep_db_query("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = '" . time() . "' WHERE configuration_key = 'MINIFY_CSSJS_TIMESTAMP'");
    }
}

/**
 * Check if show XML status settings in categories and products
 */
function showXmlStatusSettings(): bool
{
    return getConstantValue('GOOGLE_FEED_MODULE_ENABLED', 'false') === 'true' ||
        getConstantValue('EXPORT_FACEBOOK_FEED_MODULE_ENABLED', 'false') === 'true' ||
        getConstantValue('YANDEX_MARKET_MODULE_ENABLED', 'false') === 'true';
}

/**
 * uses in /admin/configuration.php?gID=6 maybe else
 * @param $value
 * @return string
 */
if (!function_exists('sage_pay_form_clip_text')) {
    function sage_pay_form_clip_text($value)
    {
        if (strlen($value) > 20) {
            $value = substr($value, 0, 20) . '..';
        }

        return $value;
    }
}
/**
 * uses in /admin/configuration.php?gID=6 maybe else
 */
if (!function_exists('get_multioption_upsxml')) {
    function get_multioption_upsxml($values)
    {
        if (tep_not_null($values)) {
            $values_array = explode(',', $values);
            foreach ($values_array as $key => $_method) {
                if ($_method == '--none--') {
                    $method = $_method;
                } else {
                    $method = constant('UPSXML_' . trim($_method));
                }
                $readable_values_array[] = $method;
            }
            $readable_values = implode(', ', $readable_values_array);
            return $readable_values;
        } else {
            return '';
        }
    }
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

function clearAttrCache()
{
    $languages = tep_get_languages();
    if (is_array($languages)) {
        foreach ($languages as $lan) {
            file_put_contents(DIR_FS_CATALOG . 'temp/attributes_' . $lan['id'] . '.json', '');
        }
    }
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
                $subcat_array[$cid]['img'] = '<img alt="' . $cat_names[$cid] . '" src="' . $img_path . '">';
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

//reset cache for categories
function resetCacheForCategories()
{
    if (USE_CACHE == 'true') {
        tep_reset_cache_block('categories');
        tep_reset_cache_block('also_purchased');
    }
}

//check is product in category
function isProductInCategory($productsId, $targetCategoriesId)
{
    global $prodToCatLinks;
    $result = false;
    if (is_array($prodToCatLinks[$productsId])) {
        $result = in_array($targetCategoriesId, $prodToCatLinks[$productsId]);
    }
    return $result;
}

//check is product in other categories
function isProductInAnotherCategory($productsId, $targetCategoriesId)
{
    global $prodToCatLinks;
    $result = false;
    if (is_array($prodToCatLinks[$productsId])) {
        foreach ($prodToCatLinks[$productsId] as $categoriesId) {
            if ($categoriesId != $targetCategoriesId) {
                $result = true;
            }
        }
    }
    return $result;
}

//collect tree of subcategories from categories in $categoriesIds
function getTreeOfSubcategoriesFromMultipleCategories($categoriesIds)
{
    global $cat_tree;
    $treeOfChosenCategoriesAndSubcategories = [];
    if (is_array($categoriesIds)) {
        foreach ($categoriesIds as $categoriesId) {
            $treeOfChosenCategoriesAndSubcategories[$categoriesId] = check_subcategories($cat_tree, $categoriesId);
        }
    }
    return $treeOfChosenCategoriesAndSubcategories;
}

function setVideoImagePreview($youtube_url) : string
{
    $regExp = '/^.*(youtu\.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/';
    $match = preg_match($regExp, $youtube_url, $matches);
    if ($match && strlen($matches[2]) == 11) {
        $preview_url = 'http://img.youtube.com/vi/' . $matches[2] . '/maxresdefault.jpg';
        $upload_dir = DIR_FS_CATALOG . 'images/products/video_preview/';
        if ( !is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $picture_code = getResourceCode($preview_url);
        if ($picture_code == 200) {
            @file_put_contents($upload_dir . $matches[2] . ".jpg", fopen($preview_url, 'r'));
            return "video_preview/" . $matches[2] . ".jpg";
        }else {
            return "video_preview/default.png";
        }
    }
    return '';
}

function checkAndFixYoutubeUrl($link)
{
    $regExp = '/^.*(youtu\.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/';
    $match = preg_match($regExp, $link, $matches);
    if ($match && strlen($matches[2]) == 11) {
        $link = 'https://www.youtube.com/watch?v=' . $matches[2];
    }

    return $link;
}

function getResourceCode($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, true);    // we want headers
    curl_setopt($ch, CURLOPT_NOBODY, true);    // we don't need body
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $output = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return $httpcode;
}


function checkIsAdminAvailable($login_id){
    $query = tep_db_query("select admin_id from " . TABLE_ADMIN . " where admin_id = ".(int)$login_id);
    if(!$query->num_rows){
        return false;
    }
    return true;
}

function clearAdminSession($osCAdminID){
    tep_db_query("delete from " . TABLE_SESSIONS . " where sesskey = '".$osCAdminID."'");
    setcookie("osCAdminID", "", time() - 60, '/');
}


function checkLimitProducts(){
    global $path;
    global $languages_id;

    $env = parse_ini_file($path.".env", true);
    $site_type = $env['APP_ENV'];

    if($site_type === 'rent'){
        if(!defined('RENT_PACKAGE') || !defined('RENT_LIMIT') ){
            require_once "includes/check_rented_modules.php";
        }
        $rent_package = RENT_PACKAGE;
        $rent_limit = getConstantValue('RENT_LIMIT', 1000);

        //товаров больше, чем лимит
        if(count(tep_get_all_products()) > $rent_limit){
            $dateOfLimitExcessQuery = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'DATE_PRODUCTS_LIMIT_REACHED'");
            //уже было превышениие по лимиту
            if (tep_db_num_rows($dateOfLimitExcessQuery)) {
                $date_limit_was_reached = tep_db_fetch_array($dateOfLimitExcessQuery)['configuration_value'];
                $date_subscription_will_be_change = date("Y-m-d H:i:s", strtotime($date_limit_was_reached.'+ 15 days'));

                $now = new DateTime(); // текущее время на сервере
                $date = DateTime::createFromFormat("Y-m-d H:i:s", $date_subscription_will_be_change); // задаем дату в любом формате
                $interval = $now->diff($date); // получаем разницу в виде объекта DateInterval
                $interval = $interval->d;
            } else {
                //лимит превысился только что
                tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_required_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function, depends_on, configuration_subgroup_id, callback_func)
                    VALUES ('Products limit', 'DATE_PRODUCTS_LIMIT_REACHED', now(), 'false', '', '0', NULL, NULL, now(), NULL, NULL, '', '0', NULL);");
                $interval = 14;
                //отправить письмо пользователю
                if (checkConst('EMAIL_CONTENT_MODULE_ENABLED') == 'true') {
                    require_once(DIR_FS_EXT . 'email_content/functions.php');
                    $data = [
                        'current_limit' => $rent_limit,
                        'count_products' => count(tep_get_all_products()),
                        'link_to_subscription' => LINK_TO_SUBSCRIPTION,
                    ];

                    $content_email_array = getLimitReachedText($languages_id, $data, $rent_package);
                }

                if($rent_package == 'free') { //в пакете free добавить ссылку на оплату аренды
                    $text_format = 'PRODUCTS_LIMIT_REACHED_FREE';
                    $error_text = sprintf(constant($text_format), $interval, LINK_TO_SUBSCRIPTION);
                } else {
                    $text_format = 'PRODUCTS_LIMIT_REACHED_'. strtoupper($rent_package);
                    $error_text = sprintf(constant($text_format), $interval, $rent_package);
                }

                $email_plain_text = $error_text;
                $email_text = isset($content_email_array['content_html']) && !empty($content_email_array['content_html']) ? $content_email_array['content_html'] : $email_plain_text;
                $subject = isset($content_email_array['subject']) && !empty($content_email_array['subject']) ? $content_email_array['subject'] : PRODUCTS_LIMIT_REACHED_HEADING;

                tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, $subject, $email_text, 'bot', 'bot@solomono.net');
                //Notification to admin
                $email_text.'<br>site name: '.$_SERVER['HTTP_HOST'].'<br>Client Email: '.STORE_OWNER_EMAIL_ADDRESS;
                tep_mail('Solomono', 'admin@solomono.net', $subject, $email_text, 'bot', 'bot@solomono.net');
            }

            if($rent_package == 'free') { //в пакете free добавить ссылку на оплату аренды
                $text_format = 'PRODUCTS_LIMIT_REACHED_FREE';
                $error_text = sprintf(constant($text_format), $interval, LINK_TO_SUBSCRIPTION);
            } else {
                $text_format = 'PRODUCTS_LIMIT_REACHED_'. strtoupper($rent_package);
                $error_text = sprintf(constant($text_format), $interval, $rent_package);
            }

            //показываем сообщение
            $_SESSION['alertErrors']['products_limit']= $error_text;
        }
    }

}

function tep_get_all_products_by_vendor_template()
{
    global $products_images;
    $all_products_by_vendor_template = [];
    $get_all_products_by_vendor_template_query = tep_db_query("select products_id, products_image, products_model, vendor_template, id_sys_product from " . TABLE_PRODUCTS);
    while ($get_all_products_by_vendor_template = tep_db_fetch_array($get_all_products_by_vendor_template_query)) {
        if(empty($get_all_products_by_vendor_template['vendor_template'])){
            $get_all_products_by_vendor_template['vendor_template'] = 'other';
        }
        $all_products_by_vendor_template[$get_all_products_by_vendor_template['vendor_template']]['model'][$get_all_products_by_vendor_template['products_id']] = $get_all_products_by_vendor_template['products_model'];
        $all_products_by_vendor_template[$get_all_products_by_vendor_template['vendor_template']]['id'][$get_all_products_by_vendor_template['products_id']] = $get_all_products_by_vendor_template['id_sys_product'];
        $products_images[$get_all_products_by_vendor_template['products_id']] = $get_all_products_by_vendor_template['products_image'];
    }
    return $all_products_by_vendor_template;
}

function tep_get_all_categories_by_vendor_template(){
    $all_categories_by_vendor_template = [];
    $get_all_categories_by_vendor_template_query = tep_db_query("select categories_id, vendor_template, id_sys_category from " . TABLE_CATEGORIES);
    while ($get_all_categories_by_vendor_template = tep_db_fetch_array($get_all_categories_by_vendor_template_query)) {
        if(empty($get_all_categories_by_vendor_template['vendor_template'])){
            $get_all_categories_by_vendor_template['vendor_template'] = 'other';
        }
        $all_categories_by_vendor_template[$get_all_categories_by_vendor_template['vendor_template']][] = $get_all_categories_by_vendor_template['id_sys_category'] ? : $get_all_categories_by_vendor_template['categories_id'];
    }
    return $all_categories_by_vendor_template;
}

function tep_get_all_attributes_array(){
    $all_attributes_array = array();
    $get_all_attributes_array_query = tep_db_query("SELECT po.products_options_id, po.products_options_name, po.language_id FROM " . TABLE_PRODUCTS_OPTIONS . " po");
    while ($get_all_attributes_array = tep_db_fetch_array($get_all_attributes_array_query)) {
        $all_attributes_array[$get_all_attributes_array['products_options_id'].'.'.$get_all_attributes_array['language_id']] = $get_all_attributes_array['products_options_name'];
    }

    return $all_attributes_array;
}

function tep_get_all_attributes_values_array(){
    $all_attributes_values_array = array();
    $get_all_attributes_array_query = tep_db_query("SELECT DISTINCT pov.products_options_values_id, pov.products_options_values_name, pov.language_id FROM " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov");
    while ($get_all_attributes_array = tep_db_fetch_array($get_all_attributes_array_query)) {
        $all_attributes_values_array[$get_all_attributes_array['products_options_values_id'].'.'.$get_all_attributes_array['language_id']] = $get_all_attributes_array['products_options_values_name'];
    }
    return $all_attributes_values_array;
}

function tep_get_all_products_attributes_array(){
    $all_products_attributes_array = array();
    $get_all_attributes_array_query = tep_db_query("SELECT DISTINCT pa.products_id, pa.options_id, pa.options_values_id FROM " . TABLE_PRODUCTS_ATTRIBUTES . " pa");
    while ($query = tep_db_fetch_array($get_all_attributes_array_query)) {
        $all_products_attributes_array[] = $query['products_id'].'.'.$query['options_id'].'.'.$query['options_values_id'];
    }
    return $all_products_attributes_array;
}

function tep_get_all_manufacturers($languages_id){
    $manufacturers = [];
    $query = tep_db_query("select manufacturers_id, manufacturers_name from " . TABLE_MANUFACTURERS_INFO . " WHERE languages_id = ".(int)$languages_id);
    while ($row = tep_db_fetch_array($query)) {
        if(!empty($row['manufacturers_name'])){
            $manufacturers[$row['manufacturers_id']] = $row['manufacturers_name'];
        }
    }
    return $manufacturers;
}

function tep_get_products_id($data)
{
    $conditions = [];
    foreach ($data as $field => $value) {
        $conditions[] = $field . " = '" . $value . "'";
    }
    $conditionsList = implode(' and ', $conditions);

    if (!empty($conditionsList)) {
        $products_query = tep_db_query("select products_id from " . TABLE_PRODUCTS . " where " . $conditionsList);
        $products_id = tep_db_fetch_array($products_query)['products_id'];
    }
    $products_id = $products_id ?: 0;

    return $products_id;
}

function tep_get_categories_id($data)
{
    $conditions = [];
    foreach ($data as $field => $value) {
        $conditions[] = $field . " = '" . $value . "'";
    }
    $conditionsList = implode(' and ', $conditions);

    if (!empty($conditionsList)) {
        $categories_query = tep_db_query("select categories_id from " . TABLE_CATEGORIES . " where " . $conditionsList);
        $categories_id = tep_db_fetch_array($categories_query)['categories_id'];
    }

    $categories_id = $categories_id ?: 0;

    return $categories_id;
}

function priceToFloat($price)
{
    $stringPrice = (string)$price;
    $stringPrice = str_replace(',', '.', $stringPrice); //replace invalid comma
    return (float)$stringPrice;
}

function getLastOptionId()
{
    $max_products_options_id_query = tep_db_query("select max(products_options_id) as max_poi from " . TABLE_PRODUCTS_OPTIONS, false);
    $max_products_options_id = tep_db_fetch_array($max_products_options_id_query);
    return $max_products_options_id['max_poi'] + 1;
}

function checkStopImportProcess()
{
    global $rootPath;
    $readfile = file_get_contents($rootPath . '/ext/yml_import/stop.txt');
    if ($readfile == 1) {
        file_put_contents($rootPath . '/ext/yml_import/stop.txt', '0');
        file_put_contents($rootPath . '/ext/yml_import/progress.txt', '{"productsProcessed":0,"imagesUploaded":0}');
        echo 'import aborted!';
        exit;
    }
}

//delete products images that is not exist in DB
function clearProductsImages()
{
    //collect BD products images
    $sql = "SELECT products_image FROM " . TABLE_PRODUCTS . " WHERE products_image != ''";
    $query = tep_db_query($sql);
    $productsImagesDB = [];
    while ($row = tep_db_fetch_array($query)) {
        if (!empty($row['products_image'])) {
            $productImage = explode(';', $row['products_image']);
            foreach ($productImage as $filename) {
                $productsImagesDB[] = $filename;
            }
        }
    }

    //delete images that is not exist in $productsImagesDB
    $path = DIR_FS_CATALOG . DIR_WS_IMAGES . 'products/';
    $files = scandir($path);
    if ($files) {
        foreach ($files as $filename) {
            if ($filename == '.' || $filename == '..') {
                continue;
            }
            if (!is_dir($path . $filename) && !in_array($filename, $productsImagesDB)) {
                unlink($path . $filename);
            }
        }
    }
}

function tep_get_all_po2pov_array()
{
    $all_po2pov_array = array();
    $get_all_po2pov_array_query = tep_db_query("SELECT products_options_id, products_options_values_id FROM " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS);
    while ($get_all_po2pov_array = tep_db_fetch_array($get_all_po2pov_array_query)) {
        $all_po2pov_array[] = $get_all_po2pov_array['products_options_id'] . '.' . $get_all_po2pov_array['products_options_values_id'];
    }

    return $all_po2pov_array;
}

function tep_get_all_vendor_templates()
{
    $all_vendor_template = [];
    //TODO get vendor_templates from separate table vendor_templates
    $get_all_vendors_query = tep_db_query("SELECT DISTINCT (CASE WHEN vendor_template IS NULL THEN 'ukrservice' ELSE vendor_template END) AS vendor_template FROM " . TABLE_CATEGORIES);
    while ($get_all_vendors_array = tep_db_fetch_array($get_all_vendors_query)) {
        if (empty($get_all_vendors_array['vendor_template'])) {
            $all_vendor_template['ukrservice'] = 'ukrservice';
        } else {
            $all_vendor_template[$get_all_vendors_array['vendor_template']] = $get_all_vendors_array['vendor_template'];
        }
    }

    return $all_vendor_template;
}

//перевод с кирилицы и всякие проверки
//или можно сменить формат строки с названием файла и файл будет на русском: iconv("utf-8", "cp1251", $filename)
function transliterate_filename($string)
{
    $string = urldecode($string);
    $cyrillic = array("ж", "ё", "й","ю", "ь","ч", "щ", "ц","у","к","е","н","г","ш", "з","х","ъ","ф","ы","в","а","п","р","о","л","д","э","я","с","м","и","т","б","Ё","Й","Ю","Ч","Ь","Щ","Ц","У","К","Е","Н","Г","Ш","З","Х","Ъ","Ф","Ы","В","А","П","Р","О","Л","Д","Ж","Э","Я","С","М","И","Т","Б","і","І","ї","Ї","є","Є");
    $translit = array("zh","yo","i","yu","'","ch","sh","c","u","k","e","n","g","sh","z","h","'",  "f",  "y",  "v",  "a",  "p",  "r",  "o",  "l",  "d",  "yе", "jа", "s",  "m",  "i",  "t",  "b",  "yo", "i",  "yu", "ch", "'",  "sh", "c",  "u",  "k",  "e",  "n",  "g",  "sh", "z",  "h",  "'",  "f",  "y",  "v",  "a",  "p",  "r",  "o",  "l",  "d",  "zh", "ye", "ja", "s",  "m",  "i",  "t",  "b","i","i","ji","ji","ie","ie");
    $string = str_replace($cyrillic, $translit, $string);
    $string = preg_replace(array('@\s@','@[^a-zA-Z0-9\-_\.]+@',"@_+\-+@","@\-+_+@","@\-\-+@","@__+@"), array('_', '', "-","-","-","_"), $string);
    $string = preg_replace('/ /', '_', $string); // пробел
    $string = preg_replace('#\(?(\w)\)?#s', '$1', $string); // замена скобок
    $string = preg_replace(['/[\p{Han}？]/u', '/(\s)+/'], ['', '$1'], $string); // Удаление иероглифов
    preg_replace('/(?:[^-a-zA-Z0-9]|(?<=-)-+)/i', '', $string); // Оставляем только латиницу и цифры

    return $string;
}

function getPackageName($key){
    $packages = getConstantValue('NOT_BUYED_MODULES', false);
    if(is_array($packages)){
        foreach ($packages as $package => $modules) {
            $find = array_search($key, $modules);
            if ($find) {
                return ucfirst($package);
            }
        }
    }

    return false;
}

function getLastSortOrder($table){
    if($table == 'categories'){
        $field = 'sort_order';
    }
    if($table == 'products'){
        $field = 'products_sort_order';
    }
    $sort_order_value = 0;
    $sort_order_query = tep_db_query("select max(".$field.") as max from " . $table . "");
    if (tep_db_num_rows($sort_order_query)) {
        $sort_order = tep_db_fetch_array($sort_order_query);
        $sort_order_value = $sort_order['max'];
    }

    return $sort_order_value;
}