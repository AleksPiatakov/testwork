<?php

// /catalog/includes/functions/header_tags.php
// WebMakers.com Added: Header Tags Generator v2.0

////
// Get products_head_title_tag
// TABLES: products_description
function tep_get_header_tag_products_title($product_id)
{
    global $languages_id, $_GET;

    $product_header_tags = tep_db_query("select products_head_title_tag from " . TABLE_PRODUCTS_DESCRIPTION . " where language_id = " . (int)$languages_id . " and products_id = " . (int)$_GET['products_id']);
    $product_header_tags_values = tep_db_fetch_array($product_header_tags);

    return clean_html_comments($product_header_tags_values['products_head_title_tag']);
}


////
// Get products_head_keywords_tag
// TABLES: products_description
function tep_get_header_tag_products_keywords($product_id)
{
    global $languages_id, $_GET;

    $product_header_tags = tep_db_query("select products_head_keywords_tag from " . TABLE_PRODUCTS_DESCRIPTION . " where language_id = " . (int)$languages_id . " and products_id = " . (int)$_GET['products_id']);
    $product_header_tags_values = tep_db_fetch_array($product_header_tags);

    return $product_header_tags_values['products_head_keywords_tag'];
}


////
// Get products_head_desc_tag
// TABLES: products_description
function tep_get_header_tag_products_desc($product_id)
{
    global $languages_id, $_GET;

    $product_header_tags = tep_db_query("select products_head_desc_tag from " . TABLE_PRODUCTS_DESCRIPTION . " where language_id = " . (int)$languages_id . " and products_id = " . (int)$_GET['products_id']);
    $product_header_tags_values = tep_db_fetch_array($product_header_tags);

    return $product_header_tags_values['products_head_desc_tag'];
}

/**
 * @param array $attr_names_array
 * Array of attributes names, like ["attr_id => "attr_name"]
 * @param array $attr_vals_names_array
 * Array of attributes values names, like ["attr_val_id" => "attr_val_name"]
 * @return string
 * Empty string if there no attributes
 * Or pairs " - attr_name: attr_val_name, ... "
 */
function generateOptionsString($attr_names_array, $attr_vals_names_array)
{
    global $manufacturers_array;

    $attribs_array = [];
    foreach ($_GET as $k => $v) {
        if (is_numeric($k)) {
            $attribs_array[$k] = $v;
        }
    }
    $options_title = [];
    foreach ($attribs_array as $key_options => $key_options_values) {
        $key_options_values = explode('-', $key_options_values);
        $key_options_values = array_shift($key_options_values);
        if (isset($attr_names_array[$key_options]) && isset($attr_vals_names_array[$key_options_values])) {
            $options_title[] = "{$attr_names_array[$key_options]}: {$attr_vals_names_array[$key_options_values]}";
        }
    }

    $options_string = "";
    if (isset($_GET['filter_id']) && $_GET['filter_id'] && isset($manufacturers_array[$_GET['filter_id']])) {
        $options_string .= " " . $manufacturers_array[$_GET['filter_id']]['name'];
    }
    if (!empty($options_title)) {
        $options_string .= " - " . implode(", ", $options_title) . " ";
    }

    return $options_string;
}
