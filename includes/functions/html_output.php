<?php

/*
  $Id: html_output.php,v 1.1.1.1 2003/09/18 19:05:10 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

////
// The HTML href link wrapper function
///
// Ultimate SEO URLs v2.1
// The HTML href link wrapper function

/**
 * Return hidden input with csrf token
 *
 * @return string
 * @throws Exception
 */
function csrf()
{
    return tep_draw_hidden_field(\Solomono\CSRF::key(), \Solomono\CSRF::get());
}

function tep_href_link($page = '', $parameters = '', $connection = 'NONSSL', $add_session_id = false, $search_engine_safe = true)
{
    global $seo_urls, $cat_urls, $manufacturers_array, $lng, $current_category_id;

    if ($current_category_id == 0) {
        $parameters = str_replace(['sort=new&', 'type=specials&', 'sort=featured&'], ['', '', ''], $parameters);
    }

    $lng_code = $lng->language['code'] != DEFAULT_LANGUAGE ? ($lng->language['code'] . '/') : '';
    if (strstr($page, '/')) {
        $pageParts = explode('/', $page);
        if (count($pageParts) == 2) {
            $lng_code = (isset($lng->catalog_languages[$pageParts[0]]) and $pageParts[0] != DEFAULT_LANGUAGE) ? $pageParts[0] . '/' : '';
            $forse_seo_hreflink = true;
        }
    }
    if ($page === FILENAME_ERROR_404) {
        return HTTP_SERVER . '/' . $lng_code . FILENAME_ERROR_404;
    }
    $new_parameters = '';
    parse_str($parameters, $parsedParameters);
    // replace by category URL:
    if (strstr($parameters, 'cPath')) {
      //find category ID from path:
        $cat_id = $parsedParameters['cPath'];
        if (strpos($cat_id, '-') !== false) {
            $cat_id_arr = explode('-', $cat_id);
            $cat_id = end($cat_id_arr); // if its subcategory, find last categoty id
        }

        if (strpos($parameters, '&') !== false) {
          // show all parameters except cPath:
            $new_parameters = explode('&', $parameters);
            foreach ($new_parameters as $key => $par) {
                if (preg_match('/cPath=/', $par) or $par == '') {
                    unset($new_parameters[$key]);
                }
            }
            $new_parameters = implode('&', $new_parameters);
            if (!empty($new_parameters)) {
                $new_parameters = '?' . $new_parameters;
            }
        }

      // if wrong URL - go to href_link and validate name+redirect
        if ($current_category_id == $cat_id and '/' . $lng_code . $cat_urls[$lng->language['id']][$cat_id] != $_SERVER['REQUEST_URI']) {
            $forse_seo_hreflink = true;
        }
    }

    //replace by manufacturer URL:
    if (strstr($parameters, 'manufacturers_id')) {
        $man_id = $parsedParameters['manufacturers_id'];
        if (strpos($parameters, '&') !== false) {
          // show all parameters except manufacturers_id:
            $new_parameters = explode('&', $parameters);
            foreach ($new_parameters as $key => $par) {
                if (preg_match('/manufacturers_id=/', $par) or $par == '') {
                    unset($new_parameters[$key]);
                }
            }
            $new_parameters = implode('&', $new_parameters);
            if (!empty($new_parameters)) {
                $new_parameters = '?' . $new_parameters;
            }
        }

      // if wrong URL - go to href_link and validate name+redirect
        if ($_GET['manufacturers_id'] == $man_id and ($lng_code ?: '/') . $manufacturers_array[$man_id]['url'] . '-m-' . $man_id . '.html' != $_SERVER['REQUEST_URI']) {
            $forse_seo_hreflink = true;
        }
    }

    if (strstr($page, FILENAME_DEFAULT) and !empty($cat_urls[$lng->language['id']][$cat_id]) and preg_match('/cPath=/', $parameters) and !$forse_seo_hreflink) { // and explode('&',$parameters)[1]==''
        return HTTP_SERVER . '/' . $lng_code . $cat_urls[$lng->language['id']][$cat_id] . $new_parameters;
    } elseif (strstr($page, FILENAME_DEFAULT) and !empty($manufacturers_array[$man_id]['url']) and preg_match('/manufacturers_id=/', $parameters) and !$forse_seo_hreflink) { // and explode('&',$parameters)[1]==''
        return HTTP_SERVER . '/' . $lng_code . $manufacturers_array[$man_id]['url'] . '/m-' . $man_id . '.html' . $new_parameters;
    } else {
        if (!is_object($seo_urls)) {
            if (!class_exists('SEO_URL')) {
                include_once(DIR_WS_CLASSES . 'seo.class.php');
            }
            global $languages_id;
            $seo_urls = new SEO_URL($languages_id);
        }

        $return = $seo_urls->href_link($page, $parameters, $connection, $add_session_id);
        if (substr($return, -1) == '&') {
            $return = substr($return, 0, -1); // delete last empty &
        }
        return $return;
    }
}

function clearData($data, $type = 's', $trim = 50)
{
    if (!$type == 's') {
        return $data;
    }
    switch ($type) {
        case 's':
            $output = clean_html_comments(substr($data, 0, $trim)) . ((strlen($data) >= $trim) ? '...' : '');
            return $output;
    }
}

////
// The HTML image wrapper function
// BOF Image Magic
function tep_image($src, $alt = '', $width = '', $height = '', $params = '')
{
    global $product_info;
    $height = $height ?: 0;
    $width = $width ?: 0;
    if (!empty($src)) {
        //Allow for a new intermediate sized thumbnail size to be set
        //without any changes having to be made to the product_info page itself.
        //(see the lengths I go to to make your life easier :-)
        if (strstr($_SERVER['PHP_SELF'], "product_info.php")) {
            if (isset($product_info['products_image']) && $src == DIR_WS_IMAGES . $product_info['products_image'] && $product_info[products_id] == $_GET['products_id']) {   //final check just to make sure that we don't interfere with other contribs
                $width = PRODUCT_INFO_IMAGE_WIDTH == 0 ? '' : PRODUCT_INFO_IMAGE_WIDTH;
                $height = PRODUCT_INFO_IMAGE_HEIGHT == 0 ? '' : PRODUCT_INFO_IMAGE_HEIGHT;
                $product_info_image = true;
                $page = "prod_info";
            }
        }
        $image_size = file_exists($src) ? @getimagesize($src) : [];
        if (!empty($image_size)) {
            //send the image for processing unless told otherwise
            $image = '<img src="' . $src . '"'; //set up the image tag just in case we don't want to process

            // fix dimensions:

            $rwidth = $image_size[0];
            $rheight = $image_size[1];
            $new_height = '';
            $new_width = '';
            $margin_top = '';
            if ($rheight > $rwidth) {
                $new_height = $height;
            } else {
                $new_width = $width;
                $new_height = $width * $rheight / $rwidth;
                if (($height - $new_height) != 0) {
                    $margin_top = 'margin-top:' . (($height - $new_height) / 2) . 'px;';
                }
            }
            //  $width = $new_width;
            //  $height = $new_height;
            // fix dimensions END //


            if (!empty($new_width)) {
                $image .= ' width="' . tep_output_string($new_width) . '"';
            }

            if (!empty($new_height)) {
                $image .= ' height="' . tep_output_string($new_height) . '"';
            }

            // add margin to style:-----------------------------------
                $style_vars = array(
                'style="',
                'style= "',
                'style ="',
                'style = "',
                'style=',
                'style =',
                'style= ',
                'style = ',
                "style='",
                "style= '",
                "style ='",
                "style = '"
                );

                foreach ($style_vars as $vars) {
                    if (!empty(strstr($params, $vars))) {
                        $is_style = explode($vars, $params);
                        $params = $is_style[0] . 'style="' . $margin_top . $is_style[1] . '"';
                        $gi = 1;
                        break;
                    }
                }
                if ($gi != 1 && !empty($margin_top)) {
                    $params .= ' style="' . $margin_top . ';"';
                }
            // add margin to style END-----------------------------------//

                if (tep_not_null($params)) {
                    $image .= ' ' . $params;
                }

                $image .= ' alt="' . tep_output_string($alt) . '"';

                if (tep_not_null($alt)) {
                    $image .= ' title="' . tep_output_string($alt) . '"';
                }


                $image .= '>';
        }
        return $image;
    }
}

//EOF Image Magic


////
// The HTML form submit button wrapper function
// Outputs a button in the selected language
function tep_image_submit($image, $alt = '', $parameters = '')
{
    global $language;

    $image_submit = '<input type="image" src="' . tep_output_string(DIR_WS_LANGUAGES . $language . '/images/buttons/' . $image) . '" border="0" alt="' . tep_output_string($alt) . '"';

    if (tep_not_null($alt)) {
        $image_submit .= ' title=" ' . tep_output_string($alt) . ' "';
    }

    if (tep_not_null($parameters)) {
        $image_submit .= ' ' . $parameters;
    }

    $image_submit .= '>';

    return $image_submit;
}

////
// Output a function button in the selected language
function tep_image_button($image, $alt = '', $parameters = '')
{
    global $language;

    return tep_image(DIR_WS_LANGUAGES . $language . '/images/buttons/' . $image, $alt, '', '', $parameters);
}

////
// Output a separator either through whitespace, or with an image
function tep_draw_separator($image = 'pixel_black.gif', $width = '100%', $height = '0')
{

    $image = '<img src="/images/pixel_black.gif" />';

    return $image;
}

////
// Output a form
function tep_draw_form($name, $action, $method = 'post', $parameters = '')
{
    $exceptionFormName = ['quick_find'];
    $form = '<form name="' . tep_output_string($name) . '" action="' . tep_output_string($action) . '" method="' . tep_output_string($method) . '"';

    if (tep_not_null($parameters)) {
        $form .= ' ' . $parameters;
    }

    $form .= '>';
    if (!in_array($name, $exceptionFormName)) {
        $form .= csrf();
    }

    return $form;
}

////
// Output a form input field
function tep_draw_input_field($name, $value = '', $parameters = '', $type = 'text', $reinsert_value = true, $size = '')
{
    $field = '<input ' . (!empty($size) ? 'size="' . $size . '"' : '') . '  type="' . tep_output_string($type) . '" name="' . tep_output_string($name) . '"';

    if ((isset($GLOBALS[$name])) && ($reinsert_value == true)) {
        $field .= ' value="' . tep_output_string($value) . '"';
    } elseif (tep_not_null($value)) {
        $field .= ' value="' . tep_output_string($value) . '"';
    }

    if (tep_not_null($parameters)) {
        $field .= ' ' . $parameters;
    }

    $field .= '>';

    return $field;
}

////
// Output a form password field
function tep_draw_password_field($name, $value = '', $parameters = 'maxlength="40"')
{
    return tep_draw_input_field($name, $value, $parameters, 'password', false);
}

////
// Output a selection field - alias function for tep_draw_checkbox_field() and tep_draw_radio_field()
function tep_draw_selection_field($name, $type, $value = '', $checked = false, $parameters = '')
{
    $selection = '<input type="' . tep_output_string($type) . '" name="' . tep_output_string($name) . '"';

    if (tep_not_null($value)) {
        $selection .= ' value="' . tep_output_string($value) . '"';
    }

    if (($checked == true) || (isset($GLOBALS[$name]) && is_string($GLOBALS[$name]) && (($GLOBALS[$name] == 'on') || (isset($value) && (stripslashes($GLOBALS[$name]) == $value))))) {
        $selection .= ' CHECKED';
    }

    if (tep_not_null($parameters)) {
        $selection .= ' ' . $parameters;
    }

    $selection .= '>';

    return $selection;
}

////
// Output a form checkbox field
function tep_draw_checkbox_field($name, $value = '', $checked = false, $parameters = '')
{
    return tep_draw_selection_field($name, 'checkbox', $value, $checked, $parameters);
}

////
// Output a form radio field
function tep_draw_radio_field($name, $value = '', $checked = false, $parameters = '')
{
    return tep_draw_selection_field($name, 'radio', $value, $checked, $parameters);
}

////
// Output a form textarea field
function tep_draw_textarea_field($name, $wrap, $width, $height, $text = '', $parameters = '', $reinsert_value = true)
{
    $field = '<textarea name="' . tep_output_string($name) . '" wrap="' . tep_output_string($wrap) . '" cols="' . tep_output_string($width) . '" rows="' . tep_output_string($height) . '"';

    if (tep_not_null($parameters)) {
        $field .= ' ' . $parameters;
    }

    $field .= '>';

    if ((isset($GLOBALS[$name])) && ($reinsert_value == true)) {
        $field .= tep_output_string_protected(stripslashes($GLOBALS[$name]));
    } elseif (tep_not_null($text)) {
        $field .= tep_output_string_protected($text);
    }

    $field .= '</textarea>';

    return $field;
}

////
// Output a form hidden field
function tep_draw_hidden_field($name, $value = '', $parameters = '')
{
    $field = '<input type="hidden" name="' . tep_output_string($name) . '"';

    if (tep_not_null($value)) {
        $field .= ' value="' . tep_output_string($value) . '"';
    } elseif (isset($GLOBALS[$name])) {
        $field .= ' value="' . tep_output_string(stripslashes($GLOBALS[$name])) . '"';
    }

    if (tep_not_null($parameters)) {
        $field .= ' ' . $parameters;
    }

    $field .= '>';

    return $field;
}

////
// Hide form elements
function tep_hide_session_id()
{
    global $session_started, $SID;

    if (($session_started == true) && tep_not_null($SID)) {
        return tep_draw_hidden_field(tep_session_name(), tep_session_id());
    }
}

////
// Output a form pull down menu
function tep_draw_pull_down_menu($name, $values, $default = '', $parameters = '', $required = false, $mode = false, $json = false, $addPrice = false)
{
    global $currencies, $product_info, $products_stocks_array;
    $field = '<select name="' . tep_output_string($name) . '" ' . (tep_not_null($parameters) ? ' ' . $parameters : '') . '>';

    if (empty($default) && isset($GLOBALS[$name])) {
        $default = stripslashes($GLOBALS[$name]);
    }

    foreach ($values as $value) {
        if ($mode and !empty($value['prefix'])) {
            if ($json) {
                $prefix = 'data-data="' . htmlentities(json_encode(['prefix' => $value['prefix']])) . '"';
            } else {
                $prefix = 'data-prefix="' . tep_output_string($value['prefix']) . '"';
            }
        } else {
            $prefix = '';
        }

        //display text after attribute value (do not use for QTY_PRO attributes)
        if (empty($products_stocks_array) && $addPrice && $value['price'] > 0) {
            $paPrice = $currencies->display_price($value['price'], tep_get_tax_rate($product_info['products_tax_class_id']));
            switch ($value['prefix']) {
                case "+":
                    $paPrice = ' (+ ' . $paPrice . ')';
                    break;
                case "-":
                    $paPrice = ' - ' . $paPrice;
                    break;
                case "=":
                    $paPrice = ' = ' . $paPrice;
                    break;
                default:
                    $paPrice = ' + ' . $paPrice;
            }
        } else {
            $paPrice = '';
        }

        $field .= '<option ' . $prefix . ' value="' . tep_output_string($value['id']) . '"';
        if ($default == $value['id']) {
            $field .= ' selected';
        }

        if (isset($value['qty']) && $value['qty'] <= 0 && getConstantValue('STOCK_ALLOW_CHECKOUT_WITH_ATTR_COUNT_0', 'true') === 'false') {
            $field .= ' disabled';
        }

        $field .= '>' . tep_output_string($value['text'] . $paPrice, array(
                '"' => '&quot;',
                '\'' => '&#039;',
                '<' => '&lt;',
                '>' => '&gt;'
            )) . '</option>';
    }
    $field .= '</select>';

    if ($required == true) {
        $field .= TEXT_FIELD_REQUIRED;
    }

    return $field;
}

function tep_draw_pull_down_menu_for_row_by_page($name, $values, $default = '', $parameters = '', $required = false)
{
    $field = '<select name="' . tep_output_string($name) . '"';

    if (tep_not_null($parameters)) {
        $field .= ' ' . $parameters;
    }

    $field .= '>';

    if (empty($default) && isset($GLOBALS[$name])) {
        $default = stripslashes($GLOBALS[$name]);
    }

    foreach ($values as $value) {
        $field .= '<option value="' . tep_output_string($value['id']) . '"';

        if ($default == $value['id']) {
            $field .= ' SELECTED';
        }

        $field .= '>' . tep_output_string($value['text'], array(
                '"' => '&quot;',
                '\'' => '&#039;',
                '<' => '&lt;',
                '>' => '&gt;'
            )) . '</option>';
    }
    $field .= '</select>';

    if ($required == true) {
        $field .= TEXT_FIELD_REQUIRED;
    }

    return $field;
}

////
// Creates a pull-down list of countries
function tep_get_country_list($name, $selected = '', $parameters = '')
{
    $countries_array = array(
        array(
            'id' => '',
            'text' => PULL_DOWN_DEFAULT
        )
    );
    $countries = tep_get_countries();

    foreach ($countries as $country) {
        $countries_array[] = [
            'id' => $country['countries_id'],
            'text' => $country['countries_name']
        ];
    }

    return tep_draw_pull_down_menu($name, $countries_array, $selected, $parameters);
}

////
// The HTML form submit button wrapper function
// Outputs a button in the selected language
function tep_template_image_submit($image, $alt = '', $parameters = '')
{
    global $language;

    $image_submit = '<input type="image" src="' . tep_output_string(HTTP_SERVER . '/' . DIR_WS_TEMPLATES . TEMPLATE_NAME . '/images/buttons/' . $language . '/' . $image) . '" border="0" alt="' . tep_output_string($alt) . '"';

    if (tep_not_null($alt)) {
        $image_submit .= ' title=" ' . tep_output_string($alt) . ' "';
    }

    if (tep_not_null($parameters)) {
        $image_submit .= ' ' . $parameters;
    }

    $image_submit .= '>';

    return $image_submit;
}

////
// Output a function button in the selected language
function tep_template_image_button($image, $alt = '', $parameters = '')
{
    global $language;

    return tep_image(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/images/buttons/' . $language . '/' . $image, $alt, '', '', $parameters);
}


//
// Output radio-button menu
function tep_draw_radio_select($name, $values, $checked_value = false)
{
    $field = '';
    $i = 0;
    foreach ($values as $value) {
        $checked = $labelClassList = '';
        if ($value['class']) {
            $labelClassList = ' ' . $value['class'] . '';
        }
        if ($value['qty'] <= 0 && getConstantValue('STOCK_ALLOW_CHECKOUT_WITH_ATTR_COUNT_0', 'true') === 'false') {
            $disabled = 'disabled_label';
        } else {
            $disabled = '';
            if ($checked_value === false and $i == 0) {
                $checked = 'checked';
            }
            if ($value['id'] == $checked_value) {
                $checked = 'checked';
            }
            $i++;
        }

        $field .= '<input type="radio" name="' . tep_output_string($name) . '" id="option' . tep_output_string($value['id']) . '" value="' . tep_output_string($value['id']) . '" ' . $checked . '><label for="option' . tep_output_string($value['id']) . '" class="btn btn-default ' . $labelClassList . $disabled . '">' . tep_output_string($value['text']) . '</label>';
    }
    return $field;
}

function convertYoutube($string)
{
    return preg_replace(
        "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
        "<iframe width=\"100%\" frameborder=\"0\" height=\"100%\" style=\"position: absolute;\" src=\"//www.youtube.com/embed/$2\" allowfullscreen></iframe>",
        $string
    );
}

/**
 * @param array $tpl_settings
 * @return string
 */
function generateOwlCarousel($tpl_settings)
{
    global $template;

    $tpl_settings['cols'] = !empty($tpl_settings['cols']) ? $tpl_settings['cols'] : '2;3;3;5;5';
    $default_cols = explode(';', $template->getMainconf('MC_PRODUCT_QNT_IN_ROW')); // XS, SM, MD, LG
    $default_cols[4] = is_null($default_cols[4]) ? 6 : $default_cols[4];
    $tpl_cols = explode(';', $tpl_settings['cols']); // XS, SM, MD, LG
    if (count($tpl_cols) == 1) {
        $default_cols[2] = 12 / $tpl_settings['cols'];
    }
    $str = '
            function make_' . $tpl_settings['id'] . '_slider(){
            
                var sliderObject = document.getElementById("' . $tpl_settings['id'] . '");
                var itemsCount = $(">div",sliderObject).length;
                
                var it0 = ' . ($tpl_cols[0] ?: $default_cols[0]) . ';
                var it600 = ' . ($tpl_cols[1] ?: $default_cols[1]) . ';
                var it992 = ' . ($tpl_cols[2] ?: $default_cols[2]) . ';
                var it1200 = ' . ($tpl_cols[3] ?: $default_cols[3]) . ';
                var it1600 = ' . ($tpl_cols[4] ?: $default_cols[4]) . ';
                
                var navValue0 = it0 < itemsCount;
                var navValue600 = it600 < itemsCount;
                var navValue992 = it992 < itemsCount;
                var navValue1200 = it1200 < itemsCount;
                var navValue1600 = it1600 < itemsCount;
           
                $("#' . $tpl_settings['id'] . '").owlCarousel({
                         items:' . ($tpl_cols[3] ?: $default_cols[3]) . ',
                         responsive:{
                             0:{items: it0, nav: navValue0},
                             600:{items: it600, nav: navValue600},
                             992:{items: it992, nav: navValue992,loop:true},
                             1200:{items: it1200, nav: navValue1200,loop:true},
                             1600:{items: it1600, nav: navValue1600,loop:true}
                         },
                           
                         loop:true,
                         margin:' . ($template->getMainconf('MC_PRODUCT_MARGIN') ?: '0') . ',
                         dots: false, 
                         onInitialized: setTimeout(function () {$(".product_slider ").css(\'overflow\',\'visible\');}, 500),
                         onTranslated:function (e) {
                            $("#' . $tpl_settings['id'] . '").find(".active img").unveil(100,addAnimClassToImg);
                         }, 
                         navText:[\'' . RTPL_ARROW_LEFT . '\',\'' . RTPL_ARROW_RIGHT . '\'],
                         slideSpeed: 200,
                    });
            }
            jQuery(document).ready(function() {
                 make_' . $tpl_settings['id'] . '_slider();
            });';
    return $str;
}
