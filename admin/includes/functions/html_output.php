<?php
/*
  $Id: html_output.php,v 1.1.1.1 2003/09/18 19:03:44 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

////
// The HTML href link wrapper function

function tep_href_link($page = '', $parameters = '', $connection = 'NONSSL')
{
    if ($page == '') {
        die('</td></tr></table></td></tr></table><br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>Unable to determine the page link!<br><br>Function used:<br><br>tep_href_link(\'' . $page . '\', \'' . $parameters . '\', \'' . $connection . '\')</b>');
    }
    $link = HTTP_SERVER . DIR_WS_ADMIN;
    /*    if ($connection == 'NONSSL') {
          $link = HTTP_SERVER . DIR_WS_ADMIN;
        } elseif ($connection == 'SSL') {
          if (ENABLE_SSL == 'true') {
            $link = HTTPS_SERVER . DIR_WS_ADMIN;
          } else {
            $link = HTTP_SERVER . DIR_WS_ADMIN;
          }
        } else {
          die('</td></tr></table></td></tr></table><br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>Unable to determine connection method on a link!<br><br>Known methods: NONSSL SSL<br><br>Function used:<br><br>tep_href_link(\'' . $page . '\', \'' . $parameters . '\', \'' . $connection . '\')</b>');
        }*/
    if ($parameters == '') {
        $link = $link . $page . '?' . SID;
    } else {
        $link = $link . $page . '?' . $parameters . '&' . SID;
    }

    while ((substr($link, -1) == '&') || (substr($link, -1) == '?')) $link = substr($link, 0, -1);

    return $link;
}

function tep_hide_session_id()
{
    global $session_started, $SID;

    if (($session_started == true) && tep_not_null($SID)) {
        return tep_draw_hidden_field(tep_session_name(), tep_session_id());
    }
}

function tep_catalog_href_link($page = '', $parameters = '', $connection = 'NONSSL')
{
    $link = HTTP_SERVER . DIR_WS_CATALOG;
    /*    if ($connection == 'NONSSL') {
          $link = HTTP_CATALOG_SERVER . DIR_WS_CATALOG;
        } elseif ($connection == 'SSL') {
          if (ENABLE_SSL_CATALOG == 'true') {
            $link = HTTPS_CATALOG_SERVER . DIR_WS_CATALOG;
          } else {
            $link = HTTP_CATALOG_SERVER . DIR_WS_CATALOG;
          }
        } else {
          die('</td></tr></table></td></tr></table><br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>Unable to determine connection method on a link!<br><br>Known methods: NONSSL SSL<br><br>Function used:<br><br>tep_href_link(\'' . $page . '\', \'' . $parameters . '\', \'' . $connection . '\')</b>');
        }*/
    if ($parameters == '') {
        $link .= $page;
    } else {
        $link .= $page . '?' . $parameters;
    }

    while ((substr($link, -1) == '&') || (substr($link, -1) == '?')) $link = substr($link, 0, -1);

    return $link;
}

////
// The HTML image wrapper function
function tep_image($src, $alt = '', $width = '', $height = '', $params = '')
{
    $image = '<img src="' . $src . '" border="0" alt="' . $alt . '"';
    if ($alt) {
        $image .= ' title=" ' . $alt . ' "';
    }
    if ($width) {
        $image .= ' width="' . $width . '"';
    }
    if ($height) {
        $image .= ' height="' . $height . '"';
    }
    if ($params) {
        $image .= ' ' . $params;
    }
    $image .= '>';

    return $image;
}

////
// The HTML form submit button wrapper function
// Outputs a button in the selected language
//  function tep_image_submit($image, $alt = '', $parameters = '') {
//    global $language;
//
//    $image_submit = '<input type="image" src="' . tep_output_string(DIR_WS_LANGUAGES . $language . '/images/buttons/' . $image) . '" border="0" alt="' . tep_output_string($alt) . '"';
//
//    if (tep_not_null($alt)) $image_submit .= ' title=" ' . tep_output_string($alt) . ' "';
//
//    if (tep_not_null($parameters)) $image_submit .= ' ' . $parameters;
//
//    $image_submit .= '>';
//
//    return $image_submit;
//  }
function tep_image_submit($image, $alt = '', $parameters = '')
{
    global $language;

    $image_submit = '<input type="submit" value="' . tep_output_string($alt) . '"';

//    if (tep_not_null($alt)) $image_submit .= ' title=" ' . tep_output_string($alt) . ' "';
//
    if (tep_not_null($parameters)) $image_submit .= ' ' . $parameters;

    $image_submit .= '>';

    return $image_submit;
}

////
// Draw a 1 pixel black line
function tep_black_line()
{
    return tep_image(DIR_WS_IMAGES . 'pixel_black.gif', '', '100%', '1');
}

////
// Output a separator either through whitespace, or with an image
function tep_draw_separator($image = 'pixel_black.gif', $width = '100%', $height = '1')
{
    return tep_image(DIR_WS_IMAGES . $image, '', $width, $height);
}

////
// Output a function button in the selected language
function tep_image_button($image, $alt = '', $params = '')
{
    global $language;

    return tep_image(DIR_WS_LANGUAGES . $language . '/images/buttons/' . $image, $alt, '', '', $params);
}

function tep_text_button($text)
{

    return "<input type='button' value='$text' />";
}


////
// javascript to dynamically update the states/provinces list when the country is changed
// TABLES: zones
function tep_js_zone_list($country, $form, $field)
{
    $countries_query = tep_db_query("select distinct zone_country_id from " . TABLE_ZONES . " order by zone_country_id");
    $num_country = 1;
    $output_string = '';
    while ($countries = tep_db_fetch_array($countries_query)) {
        if ($num_country == 1) {
            $output_string .= '  if (' . $country . ' == "' . $countries['zone_country_id'] . '") {' . "\n";
        } else {
            $output_string .= '  } else if (' . $country . ' == "' . $countries['zone_country_id'] . '") {' . "\n";
        }

        $states_query = tep_db_query("select zone_name, zone_id from " . TABLE_ZONES . " where zone_country_id = '" . $countries['zone_country_id'] . "' order by zone_name");

        $num_state = 1;
        while ($states = tep_db_fetch_array($states_query)) {
            if ($num_state == '1') $output_string .= '    ' . $form . '.' . $field . '.options[0] = new Option("' . PLEASE_SELECT . '", "");' . "\n";
            $output_string .= '    ' . $form . '.' . $field . '.options[' . $num_state . '] = new Option("' . $states['zone_name'] . '", "' . $states['zone_id'] . '");' . "\n";
            $num_state++;
        }
        $num_country++;
    }
    $output_string .= '  } else {' . "\n" .
        '    ' . $form . '.' . $field . '.options[0] = new Option("' . TYPE_BELOW . '", "");' . "\n" .
        '  }' . "\n";

    return $output_string;
}

////
// Output a form
function tep_draw_form($name, $action, $parameters = '', $method = 'post', $params = '')
{
    $form = '<form name="' . tep_output_string($name) . '" action="';
    if (tep_not_null($parameters)) {
        $form .= tep_href_link($action, $parameters);
    } else {
        $form .= tep_href_link($action);
    }
    $form .= '" method="' . tep_output_string($method) . '"';
    if (tep_not_null($params)) {
        $form .= ' ' . $params;
    }
    $form .= '>';

    return $form;
}

////
// Output a form input field
function tep_draw_input_field($name, $value = '', $parameters = '', $required = false, $type = 'text', $reinsert_value = true)
{
    $field = '<input type="' . tep_output_string($type) . '" name="' . tep_output_string($name) . '" ';

    if (isset($GLOBALS[$name]) && ($reinsert_value == true) && is_string($GLOBALS[$name])) {
        $field .= ' value="' . tep_output_string(stripslashes($GLOBALS[$name])) . '"';
    } else {
        $field .= ' value="' . tep_output_string($value) . '"';
    }

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    if ($required == true) $field .= TEXT_FIELD_REQUIRED;

    return $field;
}

// input 4 admin NAME

function tep_lol($name, $value = '', $parameters = '', $required = false, $type = 'text', $reinsert_value = true)
{
    $field = '<input type="' . tep_output_string($type) . '" name="' . tep_output_string($name) . '" size="70" ';

    if (isset($GLOBALS[$name]) && ($reinsert_value == true) && is_string($GLOBALS[$name])) {
        $field .= ' value="' . tep_output_string(stripslashes($GLOBALS[$name])) . '"';
    } elseif (tep_not_null($value)) {
        $field .= ' value="' . tep_output_string($value) . '"';
    }

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    if ($required == true) $field .= TEXT_FIELD_REQUIRED;

    return $field;
}

////
// Output a form password field
function tep_draw_password_field($name, $value = '', $required = false)
{
    $field = tep_draw_input_field($name, $value, 'maxlength="40"', $required, 'password', false);

    return $field;
}

////
// Output a form filefield
function tep_draw_file_field($name, $required = false)
{
    $field = tep_draw_input_field($name, '', 'size="10"', $required, 'file');

    return $field;
}


//Admin begin
////
// Output a selection field - alias function for tep_draw_checkbox_field() and tep_draw_radio_field()
//  function tep_draw_selection_field($name, $type, $value = '', $checked = false, $compare = '') {
//    $selection = '<input type="' . tep_output_string($type) . '" name="' . tep_output_string($name) . '"';
//
//    if (tep_not_null($value)) $selection .= ' value="' . tep_output_string($value) . '"';
//
//    if ( ($checked == true) || (isset($GLOBALS[$name]) && is_string($GLOBALS[$name]) && ($GLOBALS[$name] == 'on')) || (isset($value) && isset($GLOBALS[$name]) && (stripslashes($GLOBALS[$name]) == $value)) || (tep_not_null($value) && tep_not_null($compare) && ($value == $compare)) ) {
//      $selection .= ' CHECKED';
//    }
//
//    $selection .= '>';
//
//    return $selection;
//  }
//
////
// Output a form checkbox field
//  function tep_draw_checkbox_field($name, $value = '', $checked = false, $compare = '') {
//    return tep_draw_selection_field($name, 'checkbox', $value, $checked, $compare);
//  }
//
////
// Output a form radio field
//  function tep_draw_radio_field($name, $value = '', $checked = false, $compare = '') {
//    return tep_draw_selection_field($name, 'radio', $value, $checked, $compare);
//  }
////
// Output a selection field - alias function for tep_draw_checkbox_field() and tep_draw_radio_field()
function tep_draw_selection_field($name, $type, $value = '', $checked = false, $compare = '', $parameter = '')
{
    $selection = '<input type="' . $type . '" name="' . $name . '"';
    if (!empty($value)) {
        $selection .= ' value="' . $value . '"';
    }
    if (($checked == true) || ($GLOBALS[$name] == 'on') || ($value && ($GLOBALS[$name] == $value)) || ($value && ($value == $compare))) {
        $selection .= ' CHECKED';
    }
    if (!empty($parameter)) {
        $selection .= ' ' . $parameter;
    }
    $selection .= '>';

    return $selection;
}

////
// Output a form checkbox field
function tep_draw_checkbox_field($name, $value = '', $checked = false, $compare = '', $parameter = '')
{
    return tep_draw_selection_field($name, 'checkbox', $value, $checked, $compare, $parameter);
}

////
// Output a form radio field
function tep_draw_radio_field($name, $value = '', $checked = false, $compare = '', $parameter = '')
{
    return tep_draw_selection_field($name, 'radio', $value, $checked, $compare, $parameter);
}

//Admin end

////
// Output a form textarea field
function tep_draw_textarea_field($name, $wrap, $width, $height, $text = '', $parameters = '', $reinsert_value = true)
{
    $field = '<textarea name="' . tep_output_string($name) . '" wrap="' . tep_output_string($wrap) . '" cols="' . tep_output_string($width) . '" rows="' . tep_output_string($height) . '"';

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    if ((isset($GLOBALS[$name])) && ($reinsert_value == true)) {
        $field .= tep_output_string_protected(stripslashes($GLOBALS[$name]));
    } elseif (tep_not_null($text)) {
        $field .= tep_output_string_protected($text);
    }

    $field .= '</textarea>';

    return $field;
}

function arr2ini(array $a, array $parent = array())
{
    $out = '';
    foreach ($a as $k => $v) {
        if (is_array($v)) {
            $sec = array_merge((array)$parent, (array)$k);
            $out .= '[' . join('.', $sec) . ']' . PHP_EOL;
            $out .= arr2ini($v, $sec);
        } else $out .= "$k=$v" . PHP_EOL;
    }
    return $out;
}

////
// Output a form hidden field
function tep_draw_hidden_field($name, $value = '', $parameters = '')
{
    $field = '<input type="hidden" name="' . tep_output_string($name) . '"';

    if (tep_not_null($value)) {
        $field .= ' value="' . tep_output_string($value) . '"';
    } elseif (isset($GLOBALS[$name]) && is_string($GLOBALS[$name])) {
        $field .= ' value="' . tep_output_string(stripslashes($GLOBALS[$name])) . '"';
    }

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    return $field;
}

////
// Output a form pull down menu
function tep_draw_pull_down_menu($name, $values, $default = '', $parameters = '', $required = false)
{
    $field = '<select class="ajaxSelect form-control" name="' . tep_output_string($name) . '"';

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
            $field .= ' selected';
        }

        if (!empty($value['parameters'])) {
            $field .= $value['parameters'];
        }

        $text = tep_output_string($value['text'], array('"' => '&quot;', '\'' => '&#039;', '<' => '&lt;', '>' => '&gt;'));

        if ($default == $value['id']) {
            $text = str_replace("&nbsp;", "", $text);
        }

        $field .= '>' . $text . '</option>';
    }
    $field .= '</select>';

    if ($required == true) {
        $field .= TEXT_FIELD_REQUIRED;
    }
    return $field;
}

function tep_draw_pull_down_menu_with_space($name, $values, $default = '', $parameters = '', $required = false) {
	$field = '<select class="ajaxSelect form-control" name="' . tep_output_string($name) . '"';
	if(tep_not_null($parameters)) $field .= ' ' . $parameters;
	$field .= '>';
	if(empty($default) && isset($GLOBALS[$name])) $default = stripslashes($GLOBALS[$name]);
	foreach($values as $value){
		$field .= '<option value="' . tep_output_string($value['id']) . '"';
		if($default == $value['id']){
			$field .= ' selected';
		}

		$text = tep_output_string($value['text'], array('"' => '&quot;', '\'' => '&#039;', '<' => '&lt;', '>' => '&gt;'));

		/*if($default == $value['id']){
			$text = str_replace("&nbsp;", "", $text);
		}*/
		if(!empty($value['level'])){
			$i = 1;
			while($i <= $value['level']){
				$text = '&nbsp;&nbsp;&nbsp;&nbsp;' . $text;
				$i++;
			}
		}

		$field .= '>' . $text . '</option>';
	}
	$field .= '</select>';

	if($required == true) $field .= TEXT_FIELD_REQUIRED;
	return $field;
}



function tep_draw_pull_down_menu_new($name, $values, $default = '', $parameters = '', $required = false, $mode = false)
{
    global $catProductCounter_ready, $all_categories_turned_on, $all_categories_to_xml;
    $field = '<ul class="menu-cats tree">';
    $nesting = 0;
    if (empty($default) && isset($GLOBALS[$name])) $default = stripslashes($GLOBALS[$name]);

    if ($values !== false) {
        foreach ($values as $value) {
            if ($nesting == $value['level']) {
                if($value['id'] == '0'){
                    $field .= '</li><li class="item-menu-cat zero';
                } else {

                    if ($value['level'] == '0') {
                        $field .= '</li><li class="item-menu-cat ten';
                    } else {
                        $field .= '</li><li class="item-menu-cat';
                    }
                }
                if ($default == $value['id']) {
                    //$field .= ' active';
                }
                $field .= '"><div><a style="display:block" data-cat-id="'.$value['id'].'" href="' . HTTP_SERVER . DIR_WS_ADMIN . 'categories.php?cPath=' . tep_output_string($value['id']) . '" ';

                $field .= '><span>' . tep_output_string($value['text'], array(
                        '"' => '&quot;',
                        '\'' => '&#039;',
                        '<' => '&lt;',
                        '>' => '&gt;'
                    )) . '</span>';
                if($value['id'] == 0){
                    $field .= '&nbsp;<span class="cat-num">(' . tep_products_count() . ')</span>';
                } else {
                    $field .= '&nbsp;<span class="cat-num">(' . ($catProductCounter_ready[$value['id']] ?: 0) . ')</span>';
                }
                $field .= '</a>';
                $field .= '<div class="cat_icons">';
                $field .= '<div class="cat_icons_svg">';
                $field .= '<div class="icons_down"><span class="down" id="open-'.$value['id'].'">
                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path>
                    </svg>
                </span></div>';
                // $field .= '<div class="icons_subcategories">';
                // //иконка подкатегорий
                // $field .='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-diagram-2" viewBox="0 0 16 16">
                //                <path fill-rule="evenodd" d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1H11a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0v-1A.5.5 0 0 1 5 7h2.5V6A1.5 1.5 0 0 1 6 4.5v-1zM8.5 5a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1zM3 11.5A1.5 1.5 0 0 1 4.5 10h1A1.5 1.5 0 0 1 7 11.5v1A1.5 1.5 0 0 1 5.5 14h-1A1.5 1.5 0 0 1 3 12.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm4.5.5a1.5 1.5 0 0 1 1.5-1.5h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1A1.5 1.5 0 0 1 9 12.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z"/>
                //            </svg>';
                // $field .= '<span>' . tep_childs_in_category_count($value['id']) . '</span>';
                // $field .= '</div>';
                // $field .= '<div class="icons_goods">';
                // //иконка товаров
                // $field .= '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket2" viewBox="0 0 16 16">
                //              <path d="M4 10a1 1 0 0 1 2 0v2a1 1 0 0 1-2 0v-2zm3 0a1 1 0 0 1 2 0v2a1 1 0 0 1-2 0v-2zm3 0a1 1 0 1 1 2 0v2a1 1 0 0 1-2 0v-2z"/>
                //              <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-.623l-1.844 6.456a.75.75 0 0 1-.722.544H3.69a.75.75 0 0 1-.722-.544L1.123 8H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.163 8l1.714 6h8.246l1.714-6H2.163z"/>
                //                </svg>';
                // if($value['id'] == 0){
                //        $field .= '<span>' . tep_products_count() . '</span>';
                //    } else {
                //        $field .= '<span>' . ($catProductCounter_ready[$value['id']] ?: 0) . '</span>';
                //    }
                // $field .= '</div>';
                if($value['id'] !=='0') {
                    $field .= '<div class="cat_settings"><svg class="cat_settings__i" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                          <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                          <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                        </svg><svg class="cat_settings__close" enable-background="new 0 0 32 32" height="18px" version="1.1" viewBox="0 0 32 32" width="18px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path fill="red" d="M11.312,12.766c0.194,0.195,0.449,0.292,0.704,0.292c0.255,0,0.51-0.097,0.704-0.292c0.389-0.389,0.389-1.02,0-1.409   L4.755,3.384c-0.389-0.389-1.019-0.389-1.408,0s-0.389,1.02,0,1.409L11.312,12.766z"/><path fill="red" d="M17.407,16.048L28.652,4.793c0.389-0.389,0.389-1.02,0-1.409c-0.389-0.389-1.019-0.561-1.408-0.171L15.296,15   c0,0-0.296,0-0.296,0s0,0.345,0,0.345L3.2,27.303c-0.389,0.389-0.315,1.02,0.073,1.409c0.194,0.195,0.486,0.292,0.741,0.292 s0.528-0.097,0.722-0.292L15.99,17.458l11.249,11.255c0.194,0.195,0.452,0.292,0.706,0.292s0.511-0.097,0.705-0.292   c0.389-0.389,0.39-1.02,0.001-1.409L17.407,16.048z"/></g></svg></div>';
                }
                $field .= '</div>';
                $field .= '</div>';

                $field .= '</div>';
                if($value['id'] !== '0') {
                    $field .= '<div class="cat_buttons">';
                    $field .= '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath='.tep_output_string($value['id']).'&cID=' . tep_output_string($value['id']) . '&action=move_category') . '">' . tep_image(DIR_WS_ICONS . 'move.gif', IMAGE_MOVE) . '</a>';
                    $field .= '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=&cID=' . tep_output_string($value['id']) . '&action=delete_category') . '">' . tep_image(DIR_WS_ICONS . 'del.gif', IMAGE_DELETE) . '</a>';
                    $field .= '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath='.tep_output_string($value['id']).'&cID=' . tep_output_string($value['id']) . '&action=edit_category') . '">' . tep_image(DIR_WS_ICONS . 'icon_properties_add.gif', TEXT_CAT_EDIT) . '</a>';

                    if (in_array($value['id'], $all_categories_turned_on)) {
                        $field .= '<a data-toggle="tooltip" data-placement="top" title="' . TOOLTIP_CATEGORY_STATUS . '" href="' . tep_href_link(FILENAME_CATEGORIES, 'action=setflag_cat&flag=0&cID=' . tep_output_string($value['id']) . '&cPath='.tep_output_string($value['id'])) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green.gif', '', 16, 16) . '</a>';
                    } else {
                        $field .= '<a data-toggle="tooltip" data-placement="top" title="' . TOOLTIP_CATEGORY_STATUS . '" href="' . tep_href_link(FILENAME_CATEGORIES, 'action=setflag_cat&flag=1&cID=' . tep_output_string($value['id']) . '&cPath='.tep_output_string($value['id'])) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green_light.gif', '', 16, 16) . '</a>';
                    }
                    if (showXmlStatusSettings()) {
                        if (in_array($value['id'], $all_categories_to_xml)) {
                            $field .= '&nbsp;<a data-toggle="tooltip" data-placement="top" title="' . TOOLTIP_CATEGORY_GOOGLE_FEED_STATUS . '"  href="' . tep_href_link(FILENAME_CATEGORIES, 'action=setxml_cat&flagxml=0&cID=' . tep_output_string($value['id']) . '&cPath='.tep_output_string($value['id'])) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green.gif', '', 10, 10) . '</a>';
                        } else {
                            $field .= '&nbsp;<a data-toggle="tooltip" data-placement="top" title="' . TOOLTIP_CATEGORY_GOOGLE_FEED_STATUS . '"  href="' . tep_href_link(FILENAME_CATEGORIES, 'action=setxml_cat&flagxml=1&cID=' . tep_output_string($value['id']) . '&cPath='.tep_output_string($value['id'])) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green_light.gif', '', 10, 10) . '</a>';
                        }
                    }

                    $field .= '</div>';
                }
            } elseif ($nesting < $value['level']) {

                $field .= '<ul class="sub_menu-cat"  id="nested-'.$value['id'].'"><li class="menu-cats-nesting item-menu-cat';
                if ($default == $value['id']) {
                    //$field .= ' active';
                }
                $field .= '"><div><a style="display:block" data-cat-id="'.$value['id'].'" href="' . HTTP_SERVER . DIR_WS_ADMIN . 'categories.php?cPath=' . tep_output_string($value['id']) . '" ';


                $field .= '><span>' . tep_output_string($value['text'], array(
                        '"' => '&quot;',
                        '\'' => '&#039;',
                        '<' => '&lt;',
                        '>' => '&gt;'
                    )) . '</span>';

                $field .= '&nbsp;<span class="cat-num">(' . ($catProductCounter_ready[$value['id']] ? : "0") . ')</span>';
                $field .= '</a>';
                $field .= '<div class="cat_icons">';

                $field .= '<div class="cat_icons_svg">';
                $field .= '<div class="icons_down"><span class="down" id="open-'.$value['id'].'">
                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path>
                    </svg>
                </span></div>';
                // $field .= '<div class="icons_subcategories">';
                // //иконка подкатегорий
                // $field .='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-diagram-2" viewBox="0 0 16 16">
                //                <path fill-rule="evenodd" d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1H11a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0v-1A.5.5 0 0 1 5 7h2.5V6A1.5 1.5 0 0 1 6 4.5v-1zM8.5 5a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1zM3 11.5A1.5 1.5 0 0 1 4.5 10h1A1.5 1.5 0 0 1 7 11.5v1A1.5 1.5 0 0 1 5.5 14h-1A1.5 1.5 0 0 1 3 12.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm4.5.5a1.5 1.5 0 0 1 1.5-1.5h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1A1.5 1.5 0 0 1 9 12.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z"/>
                //            </svg>';
                // $field .= '<span>' . tep_childs_in_category_count($value['id']) . '</span>';
                // $field .= '</div>';
                // $field .= '<div class="icons_goods">';
                // //иконка товаров
                // $field .= '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket2" viewBox="0 0 16 16">
                //              <path d="M4 10a1 1 0 0 1 2 0v2a1 1 0 0 1-2 0v-2zm3 0a1 1 0 0 1 2 0v2a1 1 0 0 1-2 0v-2zm3 0a1 1 0 1 1 2 0v2a1 1 0 0 1-2 0v-2z"/>
                //              <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-.623l-1.844 6.456a.75.75 0 0 1-.722.544H3.69a.75.75 0 0 1-.722-.544L1.123 8H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.163 8l1.714 6h8.246l1.714-6H2.163z"/>
                //                </svg>';
                // $field .= '<span>' . ($catProductCounter_ready[$value['id']] ? : "0") . '</span>';
                // $field .= '</div>';
                $field .= '<div class="cat_settings"><svg class="cat_settings__i" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                          <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                          <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                        </svg><svg class="cat_settings__close" enable-background="new 0 0 32 32" height="18px" version="1.1" viewBox="0 0 32 32" width="18px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path fill="red" d="M11.312,12.766c0.194,0.195,0.449,0.292,0.704,0.292c0.255,0,0.51-0.097,0.704-0.292c0.389-0.389,0.389-1.02,0-1.409   L4.755,3.384c-0.389-0.389-1.019-0.389-1.408,0s-0.389,1.02,0,1.409L11.312,12.766z"/><path fill="red" d="M17.407,16.048L28.652,4.793c0.389-0.389,0.389-1.02,0-1.409c-0.389-0.389-1.019-0.561-1.408-0.171L15.296,15   c0,0-0.296,0-0.296,0s0,0.345,0,0.345L3.2,27.303c-0.389,0.389-0.315,1.02,0.073,1.409c0.194,0.195,0.486,0.292,0.741,0.292 s0.528-0.097,0.722-0.292L15.99,17.458l11.249,11.255c0.194,0.195,0.452,0.292,0.706,0.292s0.511-0.097,0.705-0.292   c0.389-0.389,0.39-1.02,0.001-1.409L17.407,16.048z"/></g></svg></div>';
                $field .= '</div>';

                $field .= '</div>';
                $field .= '</div>';
                $field .= '<div class="cat_buttons">';
                $field .= '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath='.tep_output_string($value['id']).'&cID=' . tep_output_string($value['id']) . '&action=move_category') . '">' . tep_image(DIR_WS_ICONS . 'move.gif', IMAGE_MOVE) . '</a>';
                $field .= '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=&cID=' . tep_output_string($value['id']) . '&action=delete_category') . '">' . tep_image(DIR_WS_ICONS . 'del.gif', IMAGE_DELETE) . '</a>';
                $field .= '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath='.tep_output_string($value['id']).'&cID=' . tep_output_string($value['id']) . '&action=edit_category') . '">' . tep_image(DIR_WS_ICONS . 'icon_properties_add.gif', TEXT_CAT_EDIT) . '</a>';
                if (in_array($value['id'], $all_categories_turned_on)) {
                    $field .= '<a data-toggle="tooltip" data-placement="top" title="' . TOOLTIP_CATEGORY_STATUS . '" href="' . tep_href_link(FILENAME_CATEGORIES, 'action=setflag_cat&flag=0&cID=' . tep_output_string($value['id']) . '&cPath='.tep_output_string($value['id'])) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green.gif', '', 16, 16) . '</a>';
                }else {
                    $field .= '<a data-toggle="tooltip" data-placement="top" title="' . TOOLTIP_CATEGORY_STATUS . '" href="' . tep_href_link(FILENAME_CATEGORIES, 'action=setflag_cat&flag=1&cID=' . tep_output_string($value['id']) . '&cPath='.tep_output_string($value['id'])) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green_light.gif', '', 16, 16) . '</a>';
                }
                if (showXmlStatusSettings()) {
                    if (in_array($value['id'], $all_categories_to_xml)) {
                        $field .= '<a data-toggle="tooltip" data-placement="top" title="' . TOOLTIP_CATEGORY_GOOGLE_FEED_STATUS . '"  href="' . tep_href_link(FILENAME_CATEGORIES, 'action=setxml_cat&flagxml=0&cID=' . tep_output_string($value['id']) . '&cPath='.tep_output_string($value['id'])) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green.gif', '', 10, 10) . '</a>';
                    } else {
                        $field .= '<a data-toggle="tooltip" data-placement="top" title="' . TOOLTIP_CATEGORY_GOOGLE_FEED_STATUS . '"  href="' . tep_href_link(FILENAME_CATEGORIES, 'action=setxml_cat&flagxml=1&cID=' . tep_output_string($value['id']) . '&cPath='.tep_output_string($value['id'])) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green_light.gif', '', 10, 10) . '</a>';
                    }
                }
                $field .= '</div>';
            } elseif ($nesting > $value['level']) {
                $category_link = "";
                for ($i = 0; $i < ($nesting - $value['level']); $i++) {
                    $category_link .= "</ul></li>";
                }
                if($value['level'] =='0') {
                    $field .= $category_link . '<li class="item-menu-cat ten"';
                } else {
                    $field .= $category_link . '<li class="item-menu-cat"';
                }
                if ($default == $value['id']) {
                    //$field .= ' active';
                }
                $field .= '><div><a style="display:block" data-cat-id="'.$value['id'].'" href="' . HTTP_SERVER . DIR_WS_ADMIN . 'categories.php?cPath=' . tep_output_string($value['id']) . '" ';


                $field .= '><span>' . tep_output_string($value['text'], array(
                        '"' => '&quot;',
                        '\'' => '&#039;',
                        '<' => '&lt;',
                        '>' => '&gt;'
                    )) . '</span>';

                $field .= '&nbsp;<span class="cat-num">(' . ($catProductCounter_ready[$value['id']] ? : "0") . ')</span>';
                $field .= '</a>';
                $field .= '<div class="cat_icons">';

                $field .= '<div class="cat_icons_svg">';
                $field .= '<div class="icons_down"><span class="down" id="open-'.$value['id'].'">
                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path>
                    </svg>
                </span></div>';
                // $field .= '<div class="icons_subcategories">';
                // //иконка подкатегорий
                // $field .='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-diagram-2" viewBox="0 0 16 16">
                //                <path fill-rule="evenodd" d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1H11a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0v-1A.5.5 0 0 1 5 7h2.5V6A1.5 1.5 0 0 1 6 4.5v-1zM8.5 5a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1zM3 11.5A1.5 1.5 0 0 1 4.5 10h1A1.5 1.5 0 0 1 7 11.5v1A1.5 1.5 0 0 1 5.5 14h-1A1.5 1.5 0 0 1 3 12.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm4.5.5a1.5 1.5 0 0 1 1.5-1.5h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1A1.5 1.5 0 0 1 9 12.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z"/>
                //            </svg>';
                // $field .= '<span>' . tep_childs_in_category_count($value['id']) . '</span>';
                // $field .= '</div>';
                // $field .= '<div class="icons_goods">';
                // //иконка товаров
                // $field .= '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket2" viewBox="0 0 16 16">
                //              <path d="M4 10a1 1 0 0 1 2 0v2a1 1 0 0 1-2 0v-2zm3 0a1 1 0 0 1 2 0v2a1 1 0 0 1-2 0v-2zm3 0a1 1 0 1 1 2 0v2a1 1 0 0 1-2 0v-2z"/>
                //              <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-.623l-1.844 6.456a.75.75 0 0 1-.722.544H3.69a.75.75 0 0 1-.722-.544L1.123 8H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.163 8l1.714 6h8.246l1.714-6H2.163z"/>
                //                </svg>';
                // $field .= '<span>' . ($catProductCounter_ready[$value['id']] ? : "0") . '</span>';
                // $field .= '</div>';
                $field .= '<div class="cat_settings"><svg class="cat_settings__i" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                          <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                          <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                        </svg><svg class="cat_settings__close" enable-background="new 0 0 32 32" height="18px" version="1.1" viewBox="0 0 32 32" width="18px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path fill="red" d="M11.312,12.766c0.194,0.195,0.449,0.292,0.704,0.292c0.255,0,0.51-0.097,0.704-0.292c0.389-0.389,0.389-1.02,0-1.409   L4.755,3.384c-0.389-0.389-1.019-0.389-1.408,0s-0.389,1.02,0,1.409L11.312,12.766z"/><path fill="red" d="M17.407,16.048L28.652,4.793c0.389-0.389,0.389-1.02,0-1.409c-0.389-0.389-1.019-0.561-1.408-0.171L15.296,15   c0,0-0.296,0-0.296,0s0,0.345,0,0.345L3.2,27.303c-0.389,0.389-0.315,1.02,0.073,1.409c0.194,0.195,0.486,0.292,0.741,0.292 s0.528-0.097,0.722-0.292L15.99,17.458l11.249,11.255c0.194,0.195,0.452,0.292,0.706,0.292s0.511-0.097,0.705-0.292   c0.389-0.389,0.39-1.02,0.001-1.409L17.407,16.048z"/></g></svg></div>';

                $field .= '</div>';

                $field .= '</div>';
                $field .= '</div>';
                $field .= '<div class="cat_buttons">';
                $field .= '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath='.tep_output_string($value['id']).'&cID=' . tep_output_string($value['id']) . '&action=move_category') . '">' . tep_image(DIR_WS_ICONS . 'move.gif', IMAGE_MOVE) . '</a>';
                $field .= '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=&cID=' . tep_output_string($value['id']) . '&action=delete_category') . '">' . tep_image(DIR_WS_ICONS . 'del.gif', IMAGE_DELETE) . '</a>';
                $field .= '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath='.tep_output_string($value['id']).'&cID=' . tep_output_string($value['id']) . '&action=edit_category') . '">' . tep_image(DIR_WS_ICONS . 'icon_properties_add.gif', TEXT_CAT_EDIT) . '</a>';
                if (in_array($value['id'], $all_categories_turned_on)) {
                    $field .= '<a data-toggle="tooltip" data-placement="top" title="' . TOOLTIP_CATEGORY_STATUS . '" href="' . tep_href_link(FILENAME_CATEGORIES, 'action=setflag_cat&flag=0&cID=' . tep_output_string($value['id']) . '&cPath='.tep_output_string($value['id'])) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green.gif', '', 16, 16) . '</a>';
                }else {
                    $field .= '<a data-toggle="tooltip" data-placement="top" title="' . TOOLTIP_CATEGORY_STATUS . '" href="' . tep_href_link(FILENAME_CATEGORIES, 'action=setflag_cat&flag=1&cID=' . tep_output_string($value['id']) . '&cPath='.tep_output_string($value['id'])) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green_light.gif', '', 16, 16) . '</a>';
                }
                if (showXmlStatusSettings()) {
                    if (in_array($value['id'], $all_categories_to_xml)) {
                        $field .= '<a data-toggle="tooltip" data-placement="top" title="' . TOOLTIP_CATEGORY_GOOGLE_FEED_STATUS . '"  href="' . tep_href_link(FILENAME_CATEGORIES, 'action=setxml_cat&flagxml=0&cID=' . tep_output_string($value['id']) . '&cPath='.tep_output_string($value['id'])) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green.gif', '', 10, 10) . '</a>';
                    } else {
                        $field .= '<a data-toggle="tooltip" data-placement="top" title="' . TOOLTIP_CATEGORY_GOOGLE_FEED_STATUS . '"  href="' . tep_href_link(FILENAME_CATEGORIES, 'action=setxml_cat&flagxml=1&cID=' . tep_output_string($value['id']) . '&cPath='.tep_output_string($value['id'])) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green_light.gif', '', 10, 10) . '</a>';
                    }
                }
                $field .= '</div>';
            }
            $nesting = $value['level'];
        }
    }

    if ($required == true) $field .= TEXT_FIELD_REQUIRED;
    for ($i = 0; $i < $nesting; $i++) {
        $field .= "</ul></li>";
    }
    return $field;

}
function tep_draw_pull_down_categories($name, $values, $default = '', $filename=false){
    if($filename !== false){
        $class = 'redirect';
    } else {
        $class = '';
    }

    $field = '<select name="'.$name.'" data-placeholder=' . TEXT_CATEGORIES . ' class="cat_tree_dropdown ' . $class . '">';

    if(empty($default) && isset($GLOBALS['category_id'])) {
        $default = stripslashes($GLOBALS['category_id']);
    }

    if ($values !== false) {
        foreach ($values as $category) {
            $nest = '';
            for($i=0; $i < $category['level']; $i++){
                $nest .= '-';
            }
            if($filename !== false){
                $value =  tep_href_link($filename, 'cPath='.$category['id']);
            } else {
                $value = $category['id'];
            }
            $field .= '<option  value="' . $value . '"';

            if($default == $category['id']){
                $field .= ' selected';
            }
            $field .= '>' . $nest.$category['text'] .  '</option>';
        }
    }

    $field .= '</select>';
    $field .= '<button type="button" class="go_to_cat">' . HEADING_TITLE_GOTO . '</button>';

    return $field;
}

/**
 * Функция возвращает стилизованый дроп-даун
 *
 * @param $name - значение атрибута 'name'
 * @param $values - значения, из которых будет построен список
 * @param string $default - id выбранного значения
 * @param string $parameters - другие атрибуты дроп-дауна
 * @param bool $required - обязательно ли выбирать значение в этом дроп-дауне
 * @return string
 */
function new_tep_draw_pull_down_menu($name, $values, $default = '', $parameters = '', $required = false)
{
    $attr_name = tep_output_string($name);

    $select_attr_class = 'form-control';
    if (tep_not_null($parameters)) {
        preg_match('#class="([^"\']*)"#', $parameters, $matches);

        if (sizeof($matches) > 0) {
            $select_attr_class = $matches[1];
        }

        $parameters = ' ' . $parameters;
    }

    if (empty($default) && isset($GLOBALS[$name])) {
        $default = stripslashes($GLOBALS[$name]);
    }

    $options = '';
    foreach ($values as $value) {
        if ($default == $value['id']) {
            $attr_class .= ' selected';
        } else {
            $attr_class = '';
        }

        $attr_value = tep_output_string($value['id']);
        $text = tep_output_string($value['text'], array('"' => '&quot;', '\'' => '&#039;', '<' => '&lt;', '>' => '&gt;'));

        $options .= <<< EOF
<option{$attr_class} value="{$attr_value}">{$text}</option>
EOF;
    }

    if ($required == true) {
        $attr_required = TEXT_FIELD_REQUIRED;
    } else {
        $attr_required = '';
    }

    $field = <<< EOF
<select class="{$select_attr_class}" name="{$attr_name}"{$parameters}{$attr_required}>
  {$options}
</select>
EOF;

    return $field;
}

/**
 * Возвращает стилизованый чекбокс
 * @param $name
 * @param string $value
 * @param bool $checked
 * @param string $compare
 * @param string $parameter
 * @return string
 */
function new_tep_draw_checkbox_field($name, $value = '', $checked = false, $compare = '', $parameter = '')
{
    return new_tep_draw_selection_field($name, 'checkbox', $value, $checked, $compare, $parameter);
}

function new_tep_draw_selection_field($name, $type, $value = '', $checked = false, $compare = '', $parameter = '')
{
    $selection = '<input type="' . $type . '" name="' . $name . '"';

    if (!empty($value) && $type != 'checkbox') {
        $selection .= ' value="' . $value . '"';
    }

    if (($checked == true) || ($GLOBALS[$name] == 'on') || ($value && ($GLOBALS[$name] == $value)) || ($value && ($value == $compare))) {
        $selection .= ' CHECKED';
    }

    $label_parameter = '';
    if (!empty($parameter)) {
        preg_match('#data-toggle="tooltip" title="[^"\']*"#is', $parameter, $matches);

        if (sizeof($matches) > 0) {
            $parameter = str_replace($matches[0], '', $parameter);
            $label_parameter = ' ' . $matches[0];
        }

        $selection .= ' ' . trim($parameter);
    }

    $selection .= '>';

    if ($type == 'checkbox') {
        if ($value == '1') $value = '';
        $selection = '<label class="checkbox i-checks inline"' . $label_parameter . '>' . $selection . '<i></i>' . $value . '</label>';
    }

    return $selection;
}

/**
 * @param MenuItemConfiguration[] $subMenuItems
 * @return string
 */
function drawSubMenuTabs($subMenuItems)
{
    $html = '<div class="nav_table">';
    foreach ($subMenuItems as $subMenuItemFilename => $subMenuItem) {

        $isActive = $subMenuItem->isActive() ? "active" : "";
        $disabled = !$subMenuItem->isAccessible() ? "disabled" : "";
        if ($subMenuItem->isExternalLink()) {
            $subMenuItemFilename = $subMenuItem->getExternalLink();
        } else {
            $subMenuItemFilename = tep_href_link($subMenuItemFilename);
        }
        $html .= '
            <a href="' . $subMenuItemFilename . '" class="' . $isActive . ' link ' . $disabled . '">
                ' . $subMenuItem->getTitle() . '
            </a>';
    }
    $html .= '</div>';
    return $html;
}

function renderTooltip($text) {

    if (isMobile()) {
        return '';
    }
    return '<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="' . $text . '"></i>';
}
function renderLeftMenuTooltip($text) {

    if (isMobile()) {
        return '';
    }
    return '<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="' . $text . '"></i>';
}