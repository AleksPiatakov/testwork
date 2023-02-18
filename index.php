<?php

require('includes/application_top.php');

includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_DEFAULT);

if (isset($_GET['keywords']) || isset($_GET['cPath']) || isset($_GET['manufacturers_id']) || isset($_GET['type'])) {
    if (isset($_GET['type']) && !in_array($_GET['type'], ['featured', 'specials', 'new'])) {
        $page_not_found = true;
    }
    if ($page_not_found) {
        http_response_code(404);
        $content = CONTENT_ERROR_404;
        $sidebar_left = false;
    } else {
        $content = CONTENT_INDEX_PRODUCTS;

        if (ATTRIBUTES_PRODUCTS_MODULE_ENABLED == 'true') {
            if (defined('SEO_FILTER') && constant('SEO_FILTER') == 'true') {
                require('ext/filter/filter_seo.php');
            } else {
                require('ext/filter/filter.php');
            }
        }

        $current_cat_list = $cat_list[$current_category_id];
        $current_cat_list[] = $current_category_id;
        $current_cat_list_with_cat_as_keys = array_flip($current_cat_list);
        $productsToCurrentCat = [];
        foreach ($prodToCat as $pId => $cId) {
            if (isset($current_cat_list_with_cat_as_keys[$cId])) {
                $productsToCurrentCat[] = $pId;
            }
        }

        if (isset($_GET['manufacturers_id'])) {
            // current manufacturer info:
            $man_desc_query = tep_db_query("
                  select mi.manufacturers_url,mi.h1_manufacturer,mi.seo_text_top, m.manufacturers_image, mi.manufacturers_name 
                  from manufacturers_info mi, manufacturers m 
                  where m.manufacturers_id = mi.manufacturers_id 
                      and languages_id = '" . (int)$languages_id . "'   
                      and m.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "'");
            $man_desc = tep_db_fetch_array($man_desc_query);

            $heading_text_box = !empty(trim($man_desc['h1_manufacturer'])) ? $man_desc['h1_manufacturer'] : $man_desc['manufacturers_name'];
            $seo_text_top = stripcslashes($man_desc['seo_text_top']);
            $cat_image = $man_desc['manufacturers_image'];
            $desc_text = stripcslashes($man_desc['manufacturers_url']);
            $where_manufacturers = "p.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' and";
            $m_srch_action = 'manufacturers_id=' . (int)$_GET['manufacturers_id'];
        } else {
            if (isset($_GET['cPath'])) {
                $hide_categories_mainpage = false;
                $type_join = $where_type = "";
                // current category info:
                $current_category_query = tep_db_query("select cd.categories_name, cd.categories_heading_title, cd.categories_description, c.categories_image, c.display_products from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = '" . $current_category_id . "' and cd.categories_id = c.categories_id and cd.language_id = '" . $languages_id . "'");
                $current_category = tep_db_fetch_array($current_category_query);

                $heading_text_box = $current_category['categories_heading_title'] ? $current_category['categories_heading_title'] : $current_category['categories_name'];
                $cat_image = 'categories/' . $current_category['categories_image'];
                $desc_text = stripcslashes($current_category['categories_description']);

                // CURRENT subcategoriest columns:
                $subcat_array = tep_get_subcategories_tree($cat_tree, $current_category_id);
                if (isset($_GET['type'])) {
                    $hide_categories_mainpage = true;
                    switch ($_GET['type']) {
                        case 'featured':
                            $type_join = " inner join " . TABLE_FEATURED . " f on p.products_id = f.products_id and f.status = '1' ";
                            break;
                        case 'specials':
                            $salemaker_query = tep_db_query("
                                select sale_pricerange_from, sale_pricerange_to, sale_categories_all, sale_manufacturers_selected
                                from " . TABLE_SALEMAKER_SALES . "
                                where sale_status = '1'
                                and (sale_date_start <= now() or sale_date_start = '0000-00-00' or sale_date_start is NULL)
                                and (sale_date_end >= now() or sale_date_end = '0000-00-00' or sale_date_end is NULL) ");
                            if (tep_db_num_rows($salemaker_query)) {
                                $salemaker_all_results = [];
                                while($salemaker_result_while=tep_db_fetch_array($salemaker_query)) {
                                    $sql_salemaker = 'SELECT DISTINCT p.products_id FROM ' . TABLE_PRODUCTS . ' p ';
                                    if ($salemaker_result_while['sale_categories_all']) {
                                        $sql_salemaker .= 'LEFT JOIN ' . TABLE_PRODUCTS_TO_CATEGORIES . ' p2c ON p.products_id=p2c.products_id ';
                                    }
                                    $sql_salemaker .= "WHERE p.products_price >=  {$salemaker_result_while["sale_pricerange_from"]} and
                                                             p.products_price <= {$salemaker_result_while["sale_pricerange_to"]} ";
                                    if ($salemaker_result_while['sale_categories_all']) {
                                        $sql_salemaker .= "and p2c.categories_id in ({$salemaker_result_while['sale_categories_all']}) ";
                                    }
                                    if ($salemaker_result_while['sale_manufacturers_selected']) {
                                        $sql_salemaker .= "and p.manufacturers_id in ({$salemaker_result_while['sale_manufacturers_selected']}) ";
                                    }
                                    $salemaker_all_results[] = $sql_salemaker;
                                }
                                $sql_salemaker = implode(' UNION ', $salemaker_all_results);
                                $sql_salemaker = tep_db_query($sql_salemaker);
                                $saleMarketsProductIds = [];
                                while ($saleMarketsProduct = tep_db_fetch_array($sql_salemaker)) {
                                    $saleMarketsProductIds[] = $saleMarketsProduct['products_id'];
                                }
                            }
                            $type_join = " inner join " . TABLE_SPECIALS . " s
                              ON p.products_id = s.products_id and s.status = '1' 
                              and (s.start_date <= CURDATE() or s.start_date = '0000-00-00 00:00:00' or s.start_date is NULL)
                              and (s.expires_date >= CURDATE() or s.expires_date = '0000-00-00 00:00:00' or s.expires_date is NULL) ";
                            if (!empty($saleMarketsProductIds)) {
                                $type_join .= "or p.products_id in (" . implode(',',$saleMarketsProductIds) . ") ";
                            }
                            $customers_groups_id = tep_get_customers_groups_id();
                            // If there is a group look for discounts also for the group
                            if (!empty($customers_groups_id)) {
                                $type_join .= " and ( (s.customers_id = '" . $customer_id . "' or s.customers_groups_id = '" . $customers_groups_id . "')
                                 or (s.customers_id = '0' and s.customers_groups_id = '0') )";
                            } else {
                                if (!empty($customer_id)) {
                                    $type_join .= " and ( (s.customers_id = '" . $customer_id . "') 
                                or (s.customers_id = '0' and s.customers_groups_id = '0') )";
                                }
                                $type_join .= " and s.customers_id = '0' and s.customers_groups_id = '0'";
                            }
                            break;
                        case 'new':
                            $where_type = "p.lable_2 = '1' and";
                            break;
                    }
                }

                if ($current_category['display_products'] !== 'all') {
                    switch ($current_category['display_products']) {
                        case 'featured':
                            $type_join = " inner join " . TABLE_FEATURED . " f on p.products_id = f.products_id and f.status = '1' ";
                            break;
                        case 'new':
                            $where_type = "p.lable_2 = '1' and";
                            break;
                        case 'nothing':
                            $where_type = "p.products_id = 0 and";
                            break;
                        case 'products_ordered':
                            $where_type = "p.products_ordered > 0 and";
                            break;
                    }
                }

                if (isset($_GET['filter_id']) && constant('SEO_FILTER') != 'true') {
                    $m_srch_action = 'cPath=' . $_GET['cPath'] . '&filter_id=' . $_GET['filter_id'];
                } else {
                    $m_srch_action = 'cPath=' . $_GET['cPath'];
                }
            } elseif (isset($_GET['keywords'])) {
                $heading_text_box = $_GET['keywords'];
                $keyword_arr = explode(' ', $heading_text_box);
                if (getConstantValue("STATS_KEYWORDS_POPULAR_ENABLED") == 'true') {
                    $searchResultsQuery = getPopularQuery($_GET['keywords']);
                    if (is_array($searchResultsQuery) && $searchResultsQuery['h1']) {
                        $heading_text_box = $searchResultsQuery['h1'];
                    }
                }

                // searchword_swap:
                $sql_words = tep_db_query("SELECT * FROM `searchword_swap`");
                if ($sql_words->num_rows) {
                    while ($sql_words_result = tep_db_fetch_array($sql_words)) {
                        $sql_words_array[$sql_words_result['sws_word']] = $sql_words_result['sws_replacement'];
                    }
                    foreach ($keyword_arr as $k => $keyword) {
                        $keyword_arr[$k] = strtr($keyword, $sql_words_array);
                    }
                }

                $query_name = $query_model = $queryArticle = $queryProducts = $queryProductsDefault = [];
                foreach ($keyword_arr as $k) {
                    $query_name[] = 'LOWER(pd.products_name) LIKE "%' . mb_strtolower($k) . '%"';
                    $query_model[] = 'LOWER(p.products_model) LIKE "%' . mb_strtolower($k) . '%"';
                    $queryArticle[] = 'LOWER(pa_article) LIKE "%' . mb_strtolower($k) . '%"';
                    $queryProductsDefault[] = 'LOWER(p.products_id) LIKE "%' . mb_strtolower($k) . '%"';
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
                $where_keywords .= " (($query_name) or ($query_model) or ($queryProducts)) and";

                // subcategories for search results:
                if (!empty($_GET['cid'])) {
                    $clear_pid = (int)tep_db_input($_GET['cid']);

                    if ($cat_list[$clear_pid]) {
                        $all_search_cats = implode(',', $cat_list[$clear_pid]);
                    } else {
                        $all_search_cats = $clear_pid;
                    }

                    $where_subcategories = " p2c.categories_id in(" . $all_search_cats . ") and";
                }

                $search_enhancements_keywords = addslashes(strip_tags(tep_db_input($_GET['keywords'])));
                if ($search_enhancements_keywords != $last_search_insert) {
                    tep_db_query("insert into search_queries (search_text)  values ('" . $search_enhancements_keywords . "')");
                    tep_session_register('last_search_insert');
                    $last_search_insert = $search_enhancements_keywords;
                }

                // $m_srch_action = 'keywords='.$_GET['keywords'];
                $m_srch_action = 'index.php';
            }
        }
        if (DISPLAY_PRICE_WITH_TAX == 'true') {
            $type_join .= "LEFT JOIN " . TABLE_TAX_RATES . " tr on p.products_tax_class_id = tr.tax_class_id";

            if (isset($_GET['rmin']) || isset($_GET['rmax'])) {
                $type_join .= " LEFT JOIN " . TABLE_ZONES_TO_GEO_ZONES . " za ON tr.tax_zone_id = za.geo_zone_id";
            }
        }

        // show products from current category or from search
        $listing_sql = "select distinct p.products_id
                                 from " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, 
                                      " . TABLE_PRODUCTS_DESCRIPTION . " pd, 
                                      " . TABLE_PRODUCTS . " p 
                                      " . $type_join . "
                                      " . $filter_join . "
                                where " . $where_filters . "
                                      " . $where_keywords . " 
                                      " . $where_manufacturers . "
                                      " . $where_type . "
                                      " . $where_subcategories . "
                                      p.products_status = 1
                                  and p.products_id = p2c.products_id 
                                  and pd.products_id = p2c.products_id 
                                  and pd.language_id = '" . (int)$languages_id . "'";

        switch ($_GET['sort']) {
            case 'name':
                if ((isset($current_category['display_products']) && $current_category['display_products'] === 'products_ordered') && !isset($_GET['sort'])) {
                    $listing_sql .= " order by p.products_quantity > 0 desc, p.products_ordered desc";
                } else {
                    $listing_sql .= " order by p.products_quantity > 0 desc, p.products_sort_order, pd.products_name";
                }
                break;
            case 'price_ub':
                $listing_sql .= " order by p.products_quantity > 0 desc, $customer_price desc";
                break;
            case 'price_vozr':
                $listing_sql .= " order by p.products_quantity > 0 desc, $customer_price";
                break;
            case 'new':
                $listing_sql .= " order by p.products_quantity > 0 desc, p.products_date_added desc";
                break;
            case 'viewed':
            default:
                $listing_sql .= " order by p.products_quantity > 0 desc, pd.products_viewed desc";
                break;
        }

        $listing_sql_raw = $listing_sql;
        // split query to 2 small queries: 1) find all products ids, 2) get info for each product
        $pids_price_filter_excluded = tep_get_all_pids_price_exclude($listing_sql, $price_filter_statement);

        $pids_filter_excluded = tep_get_all_pids_price_exclude($listing_sql, str_replace($price_filter_statement, '', $where_filters));
        $pids_filter_excluded = $pids_filter_excluded ?: [0];
        $where_attr = str_replace($manFilter, '', $where_filters);
        $pids_filter_attr_axcluded = tep_get_all_pids_price_exclude($listing_sql, str_replace($price_filter_statement, '', $where_attr));
        $pids_filter_attr_axcluded = $pids_filter_attr_axcluded ?: [];

        $listing_sql = tep_get_query_products_info($listing_sql);
        // define how much products to show on page
        if (!empty($_GET['row_by_page'])) {
            if ($_GET['row_by_page'] == 'all') {
                $row_by_page = 1000;
            } elseif ((int)$_GET['row_by_page'] != 0) {
                $row_by_page = abs((int)$_GET['row_by_page']);
            } else {
                $row_by_page = explode(';', $template->getMainconf('MAX_DISPLAY_SEARCH_RESULTS_TITLE'))[0];
            }
        } else {
            $row_by_page = explode(';', $template->getMainconf('MAX_DISPLAY_SEARCH_RESULTS_TITLE'))[0];
        }

        if (is_array($all_pids)) {
            $all_pids_string = " p.products_id in(" . implode(',', $all_pids) . ") ";
            $number_of_rows = count($all_pids);
        } else {
            $all_pids_string = '';
            $number_of_rows = 0;
        }

        $listing_split = new splitPageResults($listing_sql, $row_by_page ?: 10, 'p.products_id', 'page', $number_of_rows);
        $listing_query = tep_db_query($listing_split->sql_query);

        //salemaker: get salemaker prices only for products from current page (uses only one sql-query)
        $salemakers_array = get_salemakers($listing_query);
        mysqli_data_seek($listing_query, 0);

        //$milliseconds = round(microtime(true) * 1000);
        //debug(round(microtime(true) * 1000) - $milliseconds);

        // PDF view:
        if ($_GET['pdf'] == 'true') {
            if (file_exists("ext/pdf_export/pdf.php")) {
                require_once "ext/pdf_export/pdf.php";
            }
        }
        // END PDF view

        $row_bypage_array = array();
        $display_results_array = explode(
            ';',
            ($template->getMainconf('MAX_DISPLAY_SEARCH_RESULTS_TITLE') . ';' . FILTER_ALL)
        );
        foreach ($display_results_array as $k => $res) {
            $row_bypage_array[] = array('id' => (($res != FILTER_ALL) ? $res : 'all'), 'text' => $res);
        }

        $r_sort_array = array(
            array('id' => 'viewed', 'text' => LISTING_SORT_POPULAR),
            array('id' => 'name', 'text' => LISTING_SORT_NAME),
            array('id' => 'price_vozr', 'text' => LISTING_SORT_PRICE1),
            array('id' => 'price_ub', 'text' => LISTING_SORT_PRICE2),
            array('id' => 'new', 'text' => LISTING_SORT_NEW),
        );

        $r_display_array = array(
            array('id' => 'list', 'text' => LISTING_SORT_LIST),
            array('id' => 'columns', 'text' => LISTING_SORT_COLUMNS)
        );

        if ($_GET['display'] == '') {
            $display = $template->getMainconf('LIST_DISPLAY_TYPE') == 0 ? 'list' : 'columns';
        } else {
            $display = $_GET['display'];
        }

        if ($display == 'list') {
            $display_hover_list = 'hover';
        } elseif ($display == 'columns') {
            $display_hover_columns = 'hover';
        }

        // ajax-form, where we adding hidden values of current selected attributes:
        foreach ($_GET as $k => $v) {
            if(!is_int($k)){
                $k = preg_replace('/[^A-Za-z0-9_]/ui','',$k);
            }
            $v = preg_replace('/[?!^0-9-+()₴!\"№;%:?*_=\'~@#$^&\[\]\.\,><]/','',$v);
            if ($k == 'cPath' or $k == 'f' or $k == 'language' or $k == 'manufacturers_id') {
            } elseif (is_int($k)) {
                $m_srch .= '<input id="pl_at' . $k . '_2" type="hidden" name="' . $k . '" value="' . $v . '" />';
            } else {
                if (isset($cPath) && $cPath == 0 && ($k == 'sort' || $k == 'type')) {
                    if ($_GET['sort'] == 'new') {
                        $heading_text_box = $zero_category_title = BOX_HEADING_WHATS_NEW;
                    }
                    if ($_GET['type'] == 'specials') {
                        $heading_text_box = sprintf(
                            BOX_HEADING_DEFAULT_SPECIALS,
                            tep_date_long_translate(strftime('%B'))
                        );
                        $zero_category_title = sprintf(BOX_HEADING_DEFAULT_SPECIALS, '');
                    }
                    if ($_GET['sort'] == 'featured') {
                        $heading_text_box = $zero_category_title = BOX_HEADING_FEATURED;
                    }
                } else {
                    $m_srch .= '<input id="' . $k . '2" type="hidden" name="' . $k . '" value="' . $v . '" />';
                }
            }
        }
        $m_srch = '<form name="m_srch" id="m_srch" action="' . tep_href_link(
            FILENAME_DEFAULT,
            $m_srch_action
        ) . '" method="get" >' . $m_srch . '</form>';
        // END ajax-form;

        if (!empty($_GET['page']) && empty($redirectOptionsIdsArrayForCheck)) {
            $heading_text_box .= ($heading_text_box ? ' - ' : '') . PREVNEXT_TITLE_PPAGE . ' ' . $_GET['page'];
        }

        // Clear $desc_text seo filter
        if (!empty($_GET['filter_id'])) {
            $desc_text = "";
        }
    }
} else { // default page
    $content = CONTENT_INDEX_DEFAULT;
    $breadcrumb->add(TITLE);
}

//$milliseconds = round(microtime(true) * 1000);

// attributes arrays:
// get all attributes list from current category

$counts_array = array();
$counts_may_be = array(); // array with all selected attributes
$show_in_filter = array();
$attr_names_array = array();
$attr_sort_orders = array();
$show_in_product_listing = array();
$show_options_arr = [];
if($content != CONTENT_INDEX_DEFAULT || !@file_get_contents(DIR_FS_CATALOG.'temp/attributes_'.$languages_id.'.json')){
    getArrayWithAllAttributes();
}
$options_string = generateOptionsString($attr_names_array, $attr_vals_names_array);
if (!empty($options_string)) {
    $heading_text_box .= $options_string;
}

// --------------- ATTRIBUTES COUNTER IN FILTER ----------------------------- //
if (defined('SEO_FILTER') && constant('SEO_FILTER') == 'true') {
    require(DIR_WS_MODULES . '/attributes_counter.php');
}
// --------------- ATTRIBUTES COUNTER IN FILTER --END------------------------ //

// END get list of all attributes from current category

if ($_SESSION['view_order_success']) {
    unset($_SESSION['view_order_success']);
}

if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    require(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING_COL);
} else {
    require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);
}

require(DIR_WS_INCLUDES . 'application_bottom.php');
