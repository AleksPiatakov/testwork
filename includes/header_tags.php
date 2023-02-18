<?php

// /catalog/includes/header_tags.php
// WebMakers.com Added: Header Tags Generator v2.0
// Add META TAGS and Modify TITLE
//
// NOTE: Globally replace all fields in products table with current product name just to get things started:
// In phpMyAdmin use: UPDATE products_description set PRODUCTS_HEAD_TITLE_TAG = PRODUCTS_NAME
//


includeLanguages(DIR_WS_LANGUAGES . $language . '/' . 'header_tags.php');

$the_desc = '';
$the_key_words = '';
$the_title = '';


if (isset($product_info['manufacturers_id'])) {
    $manufacturerId = $product_info['manufacturers_id'];
} elseif (isset($_GET['manufacturers_id'])) {
    $manufacturerId = $_GET['manufacturers_id'];
}
$replaceArray = [
    '{{STORE_NAME}}' => checkConst('STORE_NAME'),
    '{{STORE_OWNER}}' => checkConst('STORE_OWNER'),
    '{{EMAIL_ADDRESS}}' => checkConst('STORE_OWNER_EMAIL_ADDRESS'),
    '{{ATTRIBUTES}}' => $options_string,
    '{{PRODUCT_NAME}}' => '',
    '{{PRODUCT_PRICE}}' => $product_info['products_price'],
    '{{PRODUCT_MODEL}}' => $product_info['products_model'],
    '{{PRODUCT_QUANTITY}}' => $product_info['products_quantity'],
    '{{CATEGORY_NAME}}' => '',
    '{{MANUFACTURER_NAME}}' => $manufacturerId ? stripslashes($manufacturers_array[$manufacturerId]['name']) : '',
    '{{SEARCH_NAME}}' => isset($_GET['keywords']) ? $_GET['keywords'] : '',
];

if (isset($seoFilterInfo) && $seoFilterInfo && !empty($seoFilterInfo['title'])) {
    $heading_text_box = $seoFilterInfo['title'];
}

// Define specific settings per page:
switch (true) {
// DEFAULT.PHP
    case (strstr($_SERVER['PHP_SELF'], FILENAME_DEFAULT) or strstr($PHP_SELF, FILENAME_DEFAULT)):
        $metaCategory = $current_category_id;

        $category_query = tep_db_query("select categories_name, categories_meta_title, categories_meta_description, categories_meta_keywords from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . $metaCategory . "' and language_id = '" . (int)$languages_id . "'");
        $metaData = tep_db_fetch_array($category_query);
        $replaceArray['{{CATEGORY_NAME}}'] = stripslashes($metaData['categories_name']);
        if ($metaData) {
            $metaData = array_map('strip_tags', $metaData);
        }

        if ($_SERVER['REQUEST_URI'] == $add_folder . '/') {
            $the_desc = checkConst('META_TAGS_MAINPAGE_DESC', true) ? strtr(META_TAGS_MAINPAGE_DESC, $replaceArray) : $headers_mainpage['articles_head_desc_tag'];
            $the_title = checkConst('META_TAGS_MAINPAGE_TITLE', true) ? strtr(META_TAGS_MAINPAGE_TITLE, $replaceArray) : $headers_mainpage['articles_head_title_tag'];
            $the_key_words = $headers_mainpage['articles_head_keywords_tag'];
        } else {
            if (isset($seoFilterInfo) && $seoFilterInfo) {
                $the_desc = $seoFilterInfo['meta_description'];
                $the_title = stripslashes($seoFilterInfo['meta_title']);
            } else {
                if (tep_not_null($_GET['keywords'])) {
                    if (is_array($searchResultsQuery) && $searchResultsQuery["meta_description"]) {
                        $the_desc = $searchResultsQuery["meta_description"];
                    } else {
                        $the_desc = checkConst('META_TAGS_SEARCH_DESC', true) ? strtr(META_TAGS_SEARCH_DESC, $replaceArray) : $headers_mainpage['articles_head_desc_tag'];
                    }
                } elseif (!empty($zero_category_title)) {
                    $the_desc = stripslashes($zero_category_title) . $options_string;
                } else {
                    if (empty($metaData['categories_name'])) {
                        $the_desc = $headers_mainpage['articles_head_desc_tag'];
                    } else {
                        if (isset($cPath) && tep_not_null($cPath)) {
                            if (empty($metaData['categories_meta_description'])) {
                                $the_desc = (checkConst('META_TAGS_CATEGORY_DESC', true) ? strtr(META_TAGS_CATEGORY_DESC, $replaceArray) : stripslashes($metaData['categories_name'])) . $options_string;
                            } else {
                                $the_desc = $metaData['categories_meta_description'] . $options_string;
                            }
                        } else {
                            $the_desc = $headers_mainpage['articles_head_desc_tag'];
                        }
                    }
                }


                if (empty($metaData['categories_meta_keywords'])) {
                    $the_key_words = $headers_mainpage['articles_head_keywords_tag'];
                } else {
                    if (isset($cPath) && tep_not_null($cPath)) {
                        $the_key_words = $metaData['categories_meta_keywords'] . ' ' . $headers_mainpage['articles_head_keywords_tag'];
                    } else {
                        $the_key_words = $headers_mainpage['articles_head_keywords_tag'];
                    }
                }

                if (tep_not_null($_GET['keywords'])) {
                    if (is_array($searchResultsQuery) && $searchResultsQuery["meta_title"]) {
                        $the_title = $searchResultsQuery["meta_title"];
                    } else {
                        $the_title = strip_tags($_GET["keywords"]) . ' - ' . HEAD_TITLE_SEARCH_RESULTS;
                    }
                } elseif (!empty($zero_category_title)) {
                    $the_title = stripslashes($zero_category_title) . $options_string;
                } elseif (empty($metaData['categories_name'])) {
                    $the_title = stripslashes($headers_mainpage['articles_head_title_tag']);
                } else {
                    if (HTTA_DEFAULT_ON == '1' and empty($metaData['categories_meta_title'])) {
                        $the_title = checkConst('META_TAGS_CATEGORY_TITLE', true) ? strtr(META_TAGS_CATEGORY_TITLE, $replaceArray) : stripslashes($metaData['categories_name']) . $options_string;
                    } else {
                        $the_title = stripslashes($metaData['categories_meta_title']) . $options_string;
                    }
                }
            }
            if (!empty($_GET['page']) && empty($redirectOptionsIdsArrayForCheck)) {
                $the_title .= ' - ' . PREVNEXT_TITLE_PPAGE . ' ' . $_GET['page'];
            }
            if (!empty($_GET['page']) && empty($redirectOptionsIdsArrayForCheck)) {
                $the_desc .= ' - ' . PREVNEXT_TITLE_PPAGE . ' ' . $_GET['page'];
            }

            // if exist filter and page add it to h1
            if (!empty($_GET['page']) && !empty($redirectOptionsIdsArrayForCheck)) {
                foreach ($redirectOptionsIdsArrayForCheck as $attrValue) {
                    $attrItems = explode('-', $attrValue);
                    foreach ($attrItems as $item) {
                        $heading_text_box .= ' - ' . $attr_vals_names_array[$item];
                        $the_title .= ' - ' . $attr_vals_names_array[$item];
                        $the_desc .= ' - ' . $attr_vals_names_array[$item];
                    }
                }
                $the_title .= ' - ' . PREVNEXT_TITLE_PPAGE . ' ' . $_GET['page'];
                $heading_text_box .= ' - ' . PREVNEXT_TITLE_PPAGE . ' ' . $_GET['page'];
                $the_desc .= ' - ' . PREVNEXT_TITLE_PPAGE . ' ' . $_GET['page'];
            }
        }
        if (is_file(__DIR__ . '/../ext/seo_templates/SeoTemplates.php')) {
            require_once __DIR__ . '/../ext/seo_templates/SeoTemplates.php';
        }

        break;
    case (strstr($_SERVER['PHP_SELF'], 'product_info.php') or strstr($PHP_SELF, 'product_info.php')):
        $the_product_info_query = tep_db_query("select
                                                   pd.products_name,
                                                   pd.products_head_title_tag,
                                                   pd.products_head_keywords_tag,
                                                   pd.products_head_desc_tag
                                            from " . TABLE_PRODUCTS_DESCRIPTION . " pd
                                            left join " . TABLE_PRODUCTS . " p on p.products_id = pd.products_id
                                            where pd.products_id = '" . (int)$_GET['products_id'] . "'" . " 
                                            and pd.language_id ='" . (int)$languages_id . "'");
        $the_product_info = tep_db_fetch_array($the_product_info_query);
        $the_product_info['products_name'] = stripslashes($the_product_info['products_name']);
        $replaceArray['{{PRODUCT_NAME}}'] = $the_product_info['products_name'];


        if (empty($the_product_info['products_name'])) {
            $the_desc = sprintf(HEAD_DESC_TAG_ALL, STORE_NAME);
        } else {
            if (empty($the_product_info['products_head_desc_tag'])) {
                $the_desc = checkConst('META_TAGS_PRODUCT_DESC') ? strtr(META_TAGS_PRODUCT_DESC, $replaceArray) : $the_product_info['products_name'];
            } else {
                if (HTDA_PRODUCT_INFO_ON == '1') {
                    $the_desc = $the_product_info['products_head_desc_tag'];
                } else {
                    $the_desc = $the_product_info['products_head_desc_tag'];
                }
            }
        }

        if (empty($the_product_info['products_head_keywords_tag'])) {
            $the_key_words = HEAD_KEY_TAG_ALL;
        } else {
            if (HTKA_PRODUCT_INFO_ON == '1') {
                $the_key_words = $the_product_info['products_head_keywords_tag'] . ' ' . HEAD_KEY_TAG_ALL;
            } else {
                $the_key_words = $the_product_info['products_head_keywords_tag'];
            }
        }

        $metaCategory = $current_category_id;

        $category_query = tep_db_query("select categories_name, categories_meta_title, categories_meta_description, categories_meta_keywords from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . $metaCategory . "' and language_id = '" . (int)$languages_id . "'");
        $metaData = tep_db_fetch_array($category_query);
        $metaData['categories_name'] = stripslashes($metaData['categories_name']);
        $replaceArray['{{CATEGORY_NAME}}'] = $metaData['categories_name'];

        if (empty($the_product_info['products_head_title_tag'])) {
            $the_title = checkConst('META_TAGS_PRODUCT_TITLE') ? strtr(META_TAGS_PRODUCT_TITLE, $replaceArray) : $the_product_info['products_name'] . ' - ' . $metaData['categories_name'];
        } else {
            if (defined("HTTA_PRODUCT_INFO_ON") && HTTA_PRODUCT_INFO_ON == '1') {
                $the_title = clean_html_comments($the_product_info['products_head_title_tag']) . ' - ' . $metaData['categories_name'];
            } else {
                $the_title = clean_html_comments($the_product_info['products_head_title_tag']);
            }
        }
        if (is_file(__DIR__ . '/../ext/seo_templates/SeoTemplates.php')) {
            require_once __DIR__ . '/../ext/seo_templates/SeoTemplates.php';
        }
        break;
    case ((strstr($_SERVER['PHP_SELF'], 'articles.php') or strstr($PHP_SELF, 'articles.php')) && !strstr($PHP_SELF, 'new_articles.php')):
        $the_topic_query = tep_db_query("select topics_name from " . TABLE_TOPICS_DESCRIPTION . " where topics_id = '" . (int)$current_topic_id . "' and language_id = '" . (int)$languages_id . "'");
        $the_topic = tep_db_fetch_array($the_topic_query);

//      $the_title = HEAD_TITLE_ARTICLE_TAG_ALL . ' - ' . HEAD_TITLE_TAG_ARTICLES;
//      $the_desc= HEAD_DESC_TAG_ARTICLES;
//      $the_key_words = HEAD_KEY_TAG_ARTICLES . ', ' . $the_key_words . ', ' . HEAD_KEY_ARTICLE_TAG_ALL;

        $the_title = '';
        $the_desc = HEAD_DESC_TAG_ARTICLES;
        $the_key_words = HEAD_KEY_TAG_ARTICLES . ', ' . $the_key_words . ', ' . HEAD_KEY_ARTICLE_TAG_ALL;
        $the_topic['topics_name'] = stripslashes($the_topic['topics_name']);
        if (tep_not_null($the_topic['topics_name'])) {
            $the_title .= '' . $the_topic['topics_name'];
            $the_desc .= '' . $the_topic['topics_name'];
            $the_key_words .= $the_topic['topics_name'];
        }

        if (!empty($_GET['page']) && empty($redirectOptionsIdsArrayForCheck)) {
            $the_desc .= ' - ' . PREVNEXT_TITLE_PPAGE . ' ' . $_GET['page'];
            $the_title .= ' - ' . PREVNEXT_TITLE_PPAGE . ' ' . $_GET['page'];
        }
        break;
    case (strstr($_SERVER['PHP_SELF'], 'article_info.php') or strstr($PHP_SELF, 'article_info.php')):
        $the_article_info_query = tep_db_query("select articles_name, articles_head_title_tag, articles_head_keywords_tag, articles_head_desc_tag from " . TABLE_ARTICLES_DESCRIPTION . " where articles_id = '" . (int)$_GET['articles_id'] . "'" . " and language_id ='" . (int)$languages_id . "'");
        $the_article_info = tep_db_fetch_array($the_article_info_query);
        $the_article_info['articles_name'] = stripslashes($the_article_info['articles_name']);

        if (empty($the_article_info['articles_head_desc_tag'])) {
            $the_desc = clean_html_comments($the_article_info['articles_name']);
        } else {
            if (defined('HTDA_ARTICLE_INFO_ON') and HTDA_ARTICLE_INFO_ON == '1') {
                $the_desc = $the_article_info['articles_head_desc_tag'] . ' ' . HEAD_DESC_ARTICLE_TAG_ALL;
            } else {
                $the_desc = $the_article_info['articles_head_desc_tag'];
            }
        }

        if (empty($the_article_info['articles_head_keywords_tag'])) {
            $the_key_words = HEAD_KEY_ARTICLE_TAG_ALL;
        } else {
            if (defined('HTKA_ARTICLE_INFO_ON') and HTKA_ARTICLE_INFO_ON == '1') {
                $the_key_words = $the_article_info['articles_head_keywords_tag'] . ', ' . HEAD_KEY_ARTICLE_TAG_ALL;
            } else {
                $the_key_words = $the_article_info['articles_head_keywords_tag'];
            }
        }

        if (empty($the_article_info['articles_head_title_tag'])) {
            $the_title = clean_html_comments($the_article_info['articles_name']);
        } else {
            if (defined("HTTA_ARTICLE_INFO_ON") && HTTA_ARTICLE_INFO_ON == '1') {
                $the_title = clean_html_comments($the_article_info['articles_head_title_tag']);
            } else {
                $the_title = clean_html_comments($the_article_info['articles_head_title_tag']);
            }
        }

        break;
    case (strstr($_SERVER['PHP_SELF'], 'newsdesk_info.php') or strstr($PHP_SELF, 'newsdesk_info.php')):
        $newsdesk_var_query = tep_db_query("select newsdesk_article_name from " . TABLE_NEWSDESK_DESCRIPTION . " where newsdesk_id = '" . (int)$_GET['newsdesk_id'] . "' and language_id ='" . (int)$languages_id . "'");
        $newsdesk_info = tep_db_fetch_array($newsdesk_var_query);
        $the_title = clean_html_comments($newsdesk_info['newsdesk_article_name']);
        break;
    case (strstr($_SERVER['PHP_SELF'], 'information.php')):
        $the_title = addslashes($page_info['pages_name']);
        $the_desc = addslashes($page_info['pages_name']);
        break;
    case (strstr($_SERVER['PHP_SELF'], 'account_history_info.php') or strstr($PHP_SELF, 'account_history_info.php')):
        $the_title = HEAD_TITLE_ACCOUNT_HISTORY . $_GET['order_id'];
        $the_desc = HEAD_TITLE_ACCOUNT_HISTORY . $_GET['order_id'];
        break;
    case (strstr($_SERVER['PHP_SELF'], 'checkout.php') or strstr($PHP_SELF, 'checkout.php')):
        $the_title = HEAD_TITLE_CHECKOUT;
        $the_desc = HEAD_TITLE_CHECKOUT;
        break;
    case (strstr($_SERVER['PHP_SELF'], 'checkout_success.php') or strstr($PHP_SELF, 'checkout_success.php')):
        $the_title = HEAD_TITLE_CHECKOUT_SUCCESS;
        $the_desc = HEAD_TITLE_CHECKOUT_SUCCESS;
        break;
    case (strstr($_SERVER['PHP_SELF'], 'create_account.php') or strstr($PHP_SELF, 'create_account.php')):
        $the_title = HEADER_TITLE_CREATE_ACCOUNT;
        $the_desc = HEADER_TITLE_CREATE_ACCOUNT;
        break;
    case (strstr($_SERVER['PHP_SELF'], 'account.php') or strstr($PHP_SELF, 'account.php')):
        $the_title = HEAD_TITLE_ACCOUNT;
        $the_desc = HEAD_TITLE_ACCOUNT;
        break;
    case (strstr($_SERVER['PHP_SELF'], 'account_history.php') or strstr($PHP_SELF, 'account_history.php')):
        $the_title = HEAD_TITLE_ACCOUNT_HISTORY;
        $the_desc = HEAD_TITLE_ACCOUNT_HISTORY;
        break;
    case (strstr($_SERVER['PHP_SELF'], 'account_edit.php') or strstr($PHP_SELF, 'account_edit.php')):
        $the_title = HEAD_TITLE_ACCOUNT_EDIT;
        $the_desc = HEAD_TITLE_ACCOUNT_EDIT;
        break;
    case (strstr($_SERVER['PHP_SELF'], 'address_book.php') or strstr($PHP_SELF, 'address_book.php')):
        $the_title = HEAD_TITLE_ADDRESS_BOOK;
        $the_desc = HEAD_TITLE_ADDRESS_BOOK;
        break;
    case (strstr($_SERVER['PHP_SELF'], 'account_password.php') or strstr($PHP_SELF, 'account_password.php')):
        $the_title = HEAD_TITLE_ACCOUNT_PASSWORD;
        $the_desc = HEAD_TITLE_ACCOUNT_PASSWORD;
        break;
    case (strstr($_SERVER['PHP_SELF'], 'allcomments.php') or strstr($PHP_SELF, 'allcomments.php')):
        $the_title = HEAD_TITLE_ALLCOMMENTS;
        $the_desc = HEAD_TITLE_ALLCOMMENTS;
        break;
    case (strstr($_SERVER['PHP_SELF'], 'contact_us.php') or strstr($PHP_SELF, 'contact_us.php')):
        $the_title = sprintf(HEAD_TITLE_CONTACT_US, STORE_NAME);
        $the_desc = sprintf(HEAD_TITLE_CONTACT_US, STORE_NAME);
        break;
    case (strstr($_SERVER['PHP_SELF'], 'price.php') or strstr($PHP_SELF, 'price.php')):
        $the_title = sprintf(HEAD_TITLE_PRICE, STORE_NAME);
        $the_desc = sprintf(HEAD_TITLE_PRICE, STORE_NAME);
        break;
    case (strstr($_SERVER['PHP_SELF'], 'login.php') or strstr($PHP_SELF, 'login.php')):
        $the_title = HEAD_TITLE_LOGIN;
        $the_desc = HEAD_TITLE_LOGIN;
        break;
    case (strstr($_SERVER['PHP_SELF'], 'compare.php') or strstr($PHP_SELF, 'compare.php')):
        $the_title = HEAD_TITLE_COMPARE;
        $the_desc = HEAD_TITLE_COMPARE;
        break;
    case (strstr($_SERVER['PHP_SELF'], 'wishlist.php') or strstr($PHP_SELF, 'wishlist.php')):
        $the_title = HEAD_TITLE_WISHLIST;
        $the_desc = HEAD_TITLE_WISHLIST;
        break;
    case (strstr($_SERVER['PHP_SELF'], 'password_forgotten.php') or strstr($PHP_SELF, 'password_forgotten.php')):
        $the_title = HEAD_TITLE_ACCOUNT_PASSWORD_FORGOTTEN;
        $the_desc = HEAD_TITLE_ACCOUNT_PASSWORD_FORGOTTEN;
        break;
    case (strstr($_SERVER['PHP_SELF'], '404.php') or strstr($PHP_SELF, '404.php')):
        $the_title = sprintf(HEAD_TITLE_404, STORE_NAME);
        $the_desc = sprintf(HEAD_TITLE_404, STORE_NAME);
        break;
    case (strstr($_SERVER['PHP_SELF'], '403.php') or strstr($PHP_SELF, '403.php')):
        $the_title = sprintf(HEAD_TITLE_403, STORE_NAME);
        $the_desc = sprintf(HEAD_TITLE_403, STORE_NAME);
        break;
    default:
        // ALL OTHER PAGES NOT DEFINED ABOVE
        $the_desc = sprintf(HEAD_DESC_TAG_ALL, STORE_NAME);
        $the_key_words = HEAD_KEY_TAG_ALL;
        $the_title = sprintf(HEAD_TITLE_TAG_ALL, STORE_NAME);
        break;
}

// Manufacturers
if (isset($_GET['manufacturers_id'])) {
    $manufacturers_query = tep_db_query("select title, keywords, description from " . TABLE_METATAGS . " where manufacturers_id = '" . $_GET['manufacturers_id'] . "' and language_id = '" . (int)$languages_id . "'");
    $metaData = tep_db_fetch_array($manufacturers_query);
    $metaData['title'] = stripslashes($metaData['title']);

    $the_manufacturers['manufacturers_name'] = stripslashes($manufacturers_array[$_GET['manufacturers_id']]['name']);

    $replaceArray['{{MANUFACTURER_NAME}}'] = $the_manufacturers['manufacturers_name'];
    if (empty($metaData['description'])) {
        $the_desc = (checkConst('META_TAGS_MANUFACTURER_DESC') ? strtr(META_TAGS_MANUFACTURER_DESC, $replaceArray) : $the_manufacturers['manufacturers_name']);
    } else {
        if (HTDA_DEFAULT_ON == '1') {
            $the_desc = clean_html_comments($metaData['description']);
        } else {
            $the_desc = $the_manufacturers['manufacturers_name'];
        }
    }

    if (empty($metaData['keywords'])) {
        $the_key_words = HEAD_KEY_TAG_ALL;
    } else {
        if (HTKA_DEFAULT_ON == '1') {
            $the_key_words = $metaData['keywords'] . ' ' . HEAD_KEY_TAG_ALL;
        } else {
            $the_key_words = $metaData['keywords'];
        }
    }

    if (empty($metaData['title'])) {
        $the_title = checkConst('META_TAGS_MANUFACTURER_TITLE') ? strtr(META_TAGS_MANUFACTURER_TITLE, $replaceArray) : $the_manufacturers['manufacturers_name'];
    } else {
        if (HTTA_DEFAULT_ON == '1') {
            $the_title = clean_html_comments($metaData['title']);
        } else {
            $the_title = $the_manufacturers['manufacturers_name'];
        }
    }
    if (is_file(__DIR__ . '/../ext/seo_templates/SeoTemplates.php')) {
        require_once __DIR__ . '/../ext/seo_templates/SeoTemplates.php';
    }


    if (!empty($_GET['page'])) {
        $the_desc .= ' - ' . PREVNEXT_TITLE_PPAGE . ' ' . $_GET['page'];
        $the_title .= ' - ' . PREVNEXT_TITLE_PPAGE . ' ' . $_GET['page'];
    }
}

$the_title = checkMetaText($the_title);
$the_desc = checkMetaText($the_desc);

$the_desc = htmlspecialchars($the_desc);
$the_title = htmlspecialchars($the_title);
$the_title = clearKeywordsParam($the_title);


echo "\n\n\t" . '<title>' . $the_title . '</title>' . "\n";
echo "\t" . '<meta name="Description" Content="' . $the_desc . '">' . "\n";
echo "\t" . '<meta name="Keywords" CONTENT="' . $the_key_words . '">' . "\n";
echo "\t" . STORE_METAS() . "\n";
