<?php

//*******************************
//*******************************
// S T A R T
// INITIALIZATION
//*******************************
//*******************************

// modify tableBlock for use here.
//  class epbox extends tableBlock {
// constructor
/*  function __construct($contents, $direct_ouput = true) {
      $this->table_width = '';
      if (!empty($contents) && $direct_ouput == true) {
        echo $this->tableBlock($contents);
      }
    }  */
// only member function
//  function output($contents) {
//return $this->__construct($contents);
//   }
//  }
ini_set('max_execution_time', 0);
$allowed_file_types = ['text/csv','text/html','application/vnd.ms-excel', 'application/octet-stream'];
if (!empty($languages_id) && !empty($language)) {
    define('EP_DEFAULT_LANGUAGE_ID', $languages_id);
    define('EP_DEFAULT_LANGUAGE_NAME', $language);
} else {
    //elari check default language_id from configuration table DEFAULT_LANGUAGE
    $epdlanguage_query = tep_db_query("select languages_id, name from " . TABLE_LANGUAGES . " where code = '" . DEFAULT_LANGUAGE . "'");
    if (tep_db_num_rows($epdlanguage_query) > 0) {
        $epdlanguage = tep_db_fetch_array($epdlanguage_query);
        define('EP_DEFAULT_LANGUAGE_ID', $epdlanguage['languages_id']);
        define('EP_DEFAULT_LANGUAGE_NAME', $epdlanguage['name']);
    } else {
        echo 'Strange but there is no default language to work... That may not happen, just in case... ';
    }
}

$languages = tep_get_languages();

// VJ product attributes begin
$attribute_options_array = array();

if (EP_PRODUCTS_WITH_ATTRIBUTES == true) {
    if (is_array($attribute_options_select) && (count($attribute_options_select) > 0)) {
        foreach ($attribute_options_select as $value) {
            $attribute_options_query = "select distinct products_options_id from " . TABLE_PRODUCTS_OPTIONS . " where language_id = " . $leng . " products_options_name = '" . $value . "'";

            $attribute_options_values = tep_db_query($attribute_options_query);

            if ($attribute_options = tep_db_fetch_array($attribute_options_values)) {
                $attribute_options_array[$attribute_options['products_options_id']] = array('products_options_id' => $attribute_options['products_options_id']);
            }
        }
    } else {
        $attribute_options_query = "select distinct products_options_id, products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where language_id = " . $leng . " order by products_options_id";
        $attribute_options_values = tep_db_query($attribute_options_query);

        while ($attribute_options = tep_db_fetch_array($attribute_options_values)) {
            $attribute_options_array[$attribute_options['products_options_id']] = array('products_options_id' => $attribute_options['products_options_id'], 'products_options_name' => $attribute_options['products_options_name']);
        }
    }
    $attr_ids = implode(',', array_column($attribute_options_array, 'products_options_id'));
}
// VJ product attributes end

// manufacturers array:
$manufacturers_array = array();
$manufacturers_query = tep_db_query("SELECT manufacturers_id, manufacturers_name FROM " . TABLE_MANUFACTURERS_INFO . " WHERE languages_id = $languages_id");
while ($manuf = tep_db_fetch_array($manufacturers_query)) {
    $manufacturers_array[$manuf['manufacturers_id']] = $manuf['manufacturers_name'];
}

//categories array:
$cat_tree = setTree();

// these are the fields that will be defaulted to the current values in
// the database if they are not found in the incoming file
$default_these = array();
foreach ($languages as $key => $lang) {
    $default_these[] = 'v_products_name_' . $lang['id'];
    $default_these[] = 'v_products_description_' . $lang['id'];
    $default_these[] = 'v_products_url_' . $lang['id'];
    foreach ($custom_fields[TABLE_PRODUCTS_DESCRIPTION] as $key => $name) {
        $default_these[] = 'v_' . $key . '_' . $lang['id'];
    }
    if (EP_HTC_SUPPORT == true) {
        $default_these[] = 'v_products_head_title_tag_' . $lang['id'];
        $default_these[] = 'v_products_head_desc_tag_' . $lang['id'];
        $default_these[] = 'v_products_head_keywords_tag_' . $lang['id'];
    }
}
$default_these[] = 'v_products_image';
foreach ($custom_fields[TABLE_PRODUCTS] as $key => $name) {
    $default_these[] = 'v_' . $key;
}
if (EP_MVS_SUPPORT == true) {
    $default_these[] = 'v_vendor';
}

if (EP_PDF_UPLOAD_SUPPORT == true) {
    $default_these[] = 'v_products_pdfupload';
    $default_these[] = 'v_products_fileupload';
}

$default_these[] = 'v_categories_id';
$default_these[] = 'v_products_price';
$default_these[] = 'v_products_quantity';
$default_these[] = 'v_products_weight';
$default_these[] = 'v_status_current';
$default_these[] = 'v_date_avail';
$default_these[] = 'v_date_added';
$default_these[] = 'v_tax_class_title';
$default_these[] = 'v_manufacturers_name';
$default_these[] = 'v_manufacturers_id';

$prices_num = tep_xppp_getpricesnum();
for ($i = 2; $i <= $prices_num; $i++) {
    $default_these[] = 'v_products_price_' . $i;
}

$filelayout = '';
$filelayout_count = '';
$filelayout_sql = '';
$fileheaders = '';


if (!empty($_GET['dltype'])) {
    // if dltype is set, then create the filelayout.  Otherwise it gets read from the uploaded file
    list($filelayout, $filelayout_count, $filelayout_sql, $fileheaders) = ep_create_filelayout($_GET['dltype'], $attribute_options_array, $languages, $custom_fields); // get the right filelayout for this download
}

//*******************************
//*******************************
// E N D
// INITIALIZATION
//*******************************
//*******************************


//*******************************
//*******************************
// DOWNLOAD FILE (EXPORT)
//*******************************
//*******************************
if (!empty($_GET['download']) && ($_GET['download'] == 'stream' or $_GET['download'] == 'activestream' or $_GET['download'] == 'tempfile')) {
    $filestring = ""; // this holds the csv file we want to download
    $result = tep_db_query($filelayout_sql);
    $row = tep_db_fetch_array($result);


    // $EXPORT_TIME=time();  // start export time when export is started.
    $EXPORT_TIME = strftime('%Y%b%d-%H%I');
    $EXPORT_TIME = "EP" . $EXPORT_TIME;

    // Here we need to allow for the mapping of internal field names to external field names
    // default to all headers named like the internal ones
    // the field mapping array only needs to cover those fields that need to have their name changed
    if (is_array($fileheaders) && count($fileheaders) !== 0) {
        $filelayout_header = $fileheaders; // if they gave us fileheaders for the dl, then use them
    } else {
        $filelayout_header = $filelayout; // if no mapping was spec'd use the internal field names for header names
    }
    //We prepare the table heading with layout values
    foreach ($filelayout_header as $key => $value) {
        $filestring .= $key . $ep_separator;
    }
    // now lop off the trailing tab
    $filestring = substr($filestring, 0, strlen($filestring) - 1);

    // set the type

    // default to normal end of row
    $endofrow = $ep_separator . 'EOREOR' . "\n";

    $filestring .= $endofrow;

    if ($_GET['download'] == 'activestream') {
        header('Content-Encoding: UTF-8');
        header('Content-type: text/csv; charset=UTF-8');
        header("Content-disposition: attachment; filename=$EXPORT_TIME" . ((EP_EXCEL_SAFE_OUTPUT == true) ? ".csv" : ".txt"));
        // Changed if using SSL, helps prevent program delay/timeout (add to backup.php also)
        if ($request_type == 'NONSSL') {
            header("Pragma: no-cache");
        } else {
            header("Pragma: ");
        }
        header("Expires: 0");
    }

    //$num_of_langs = count($languages);
    while ($row) {
        // if the filelayout says we need a products_name, get it
        // names and descriptions require that we loop thru all languages that are turned on in the store

        // for each language, get the description and set the vals
        $sql2 = "SELECT *
                FROM " . TABLE_PRODUCTS_DESCRIPTION . "
                WHERE
                    products_id = " . $row['v_products_id'] . " and language_id=" . $leng . " ";
        $result2 = tep_db_query($sql2);
        $row2 = tep_db_fetch_array($result2);

        $row[EASY_R_NAME] = $row2['products_name'];
        $row[EASY_R_DESC] = str_replace('"\"', '""', $row2['products_description']);
        //          $row['v_products_url_' . $lid]           = $row2['products_url'];
        foreach ($custom_fields[TABLE_PRODUCTS_DESCRIPTION] as $key => $name) {
            $row['v_' . $key] = $row2[$key];
        }

        // support for Linda's Header Controller 2.0 here
        if (isset($filelayout['v_products_head_title_tag'])) {
            $row['v_products_head_title_tag'] = $row2['products_head_title_tag'];
            $row['v_products_head_desc_tag'] = $row2['products_head_desc_tag'];
            $row['v_products_head_keywords_tag'] = $row2['products_head_keywords_tag'];
        }
        // end support for Header Controller 2.0

        if (EP_MVS_SUPPORT == true) {
            $vend_result = tep_db_query("select vendors_name from " . TABLE_VENDORS . " where vendors_id = " . $row['v_vendor_id'] . "");
            if ($vend_row = tep_db_fetch_array($vend_result)) {
                $row['v_vendor'] = $vend_row['vendors_name'];
            }
        }

        // for the categories, we need to keep looping until we find the root category
        // start with v_categories_id
        // Get the category description
        // set the appropriate variable name
        // if parent_id is not null, then follow it up.
        // we'll populate an aray first, then decide where it goes in the
        /*$thecategory_id = $row['v_categories_id'];
        $fullcategory = ''; // this will have the entire category stack for froogle
        for ($categorylevel = 1; $categorylevel <= EP_MAX_CATEGORIES; $categorylevel++) {
            if ($thecategory_id) {

                $sql3 = "SELECT parent_id,
                                categories_image
                         FROM " . TABLE_CATEGORIES . "
                         WHERE
                                categories_id = " . $thecategory_id . '';
                $result3 = tep_db_query($sql3);
                if ($row3 = tep_db_fetch_array($result3)) {
                    //$temprow['v_categories_image_' . $categorylevel] = $row3['categories_image'];
                }

                $sql2 = "SELECT categories_name
                             FROM " . TABLE_CATEGORIES_DESCRIPTION . "
                             WHERE
                  language_id=" . $leng . "
                                    and categories_id = " . $thecategory_id;
                $result2 = tep_db_query($sql2);
                if ($row2 = tep_db_fetch_array($result2)) {
                    $temprow['v_categories_name_' . $categorylevel] = $row2['categories_name'];
                }


                // now get the parent ID if there was one
                $theparent_id = $row3['parent_id'];
                if ($theparent_id != '') {
                    // there was a parent ID, lets set thecategoryid to get the next level
                    $thecategory_id = $theparent_id;
                } else {
                    // we have found the top level category for this item,
                    $thecategory_id = false;
                }

            } else {
                //$temprow['v_categories_image_' . $categorylevel] = '';
                foreach ($languages as $key => $lang) {
                    $temprow['v_categories_name_' . $categorylevel] = '';
                }
            }
        }

        // now trim off the last ">" from the category stack
        $row['v_category_fullpath'] = substr($fullcategory, 0, strlen($fullcategory) - 3);

        // temprow has the old style low to high level categories.
        $newlevel = 1;
        // let's turn them into high to low level categories
        for ($categorylevel = EP_MAX_CATEGORIES; $categorylevel > 0; $categorylevel--) {
            $found = false;
            //if ($temprow['v_categories_image_' . $categorylevel] != ''){
                //  $row['картинка_кат_' . $newlevel] = $temprow['v_categories_image_' . $categorylevel];
                //  $found = true;
                //}

            if ($temprow['v_categories_name_' . $categorylevel] != '') {
                $row[EASY_R_CAT . '_' . $newlevel] = $temprow['v_categories_name_' . $categorylevel];
                $found = true;
            }

            if ($found == true) {
                $newlevel++;
            }
        }   */

        // categories tree for current product:
        $categories_path  = array($row['v_categories_id']);
        tep_get_parent_categories($categories_path, $row['v_categories_id'], $cat_tree);
        $c = 1;
        foreach (array_reverse($categories_path) as $cat) {
            $row[EASY_R_CAT . '_' . $c] = $cat_names[$cat];
            $c++;
        }

        // if the filelayout says we need a manufacturers name, get it
        if (isset($filelayout[EASY_R_MANUF])) {
            if (!empty($row['v_manufacturers_id'])) {
                $row[EASY_R_MANUF] = $manufacturers_array[$row['v_manufacturers_id']];
            }
        }


        // If you have other modules that need to be available, put them here

            // new attributes listing (only one DB query):

        if ($checkArttributes) {
            $select_fields = ', pa.options_values_price, pa.price_prefix, pa.products_options_sort_order, pa.pa_imgs, pa.pa_qty';
        } else {
            $select_fields = '';
        }

        if (is_array($attr_ids)) {
            $attr_ids_in = "and pa.options_id in(" . $attr_ids . ")";
        } else {
            $attr_ids = "";
        }

          $sql = tep_db_query("SELECT distinct pov.products_options_values_name, pa.options_id " . $select_fields . " FROM " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov, " . TABLE_PRODUCTS_ATTRIBUTES . " pa  WHERE pa.options_values_id = pov.products_options_values_id and pov.language_id = " . $leng . " " . $attr_ids . " and pa.products_id=" . (int)$row['v_products_id'] . "  order by pov.products_options_values_name DESC");
        if (tep_db_num_rows($sql)) {
            $current_arr_attr = array();
            while ($tmpAttr = tep_db_fetch_array($sql)) {
                if ($checkArttributes) {
                    $current_arr_attr[$attribute_options_array[$tmpAttr['options_id']]['products_options_name']][] = $tmpAttr['products_options_values_name'] . ":" . $tmpAttr['options_values_price'] . ":" . $tmpAttr['price_prefix'] . ":" . $tmpAttr['products_options_sort_order'] . ":" . $tmpAttr['pa_imgs'] . ":" . $tmpAttr['pa_qty'];
                } else {
                    $current_arr_attr[$attribute_options_array[$tmpAttr['options_id']]['products_options_name']][] = $tmpAttr['products_options_values_name'];
                }
            }

            foreach ($current_arr_attr as $arr_attr_name => $arr_attr_vals) {
                $row[$arr_attr_name] = implode('||', $arr_attr_vals);
            }
        }


        // this is for the cross sell contribution
        if (isset($filelayout['v_cross_sell'])) {
            $px_models = '';
            $sql2 = "SELECT
                    px.products_id,
                    px.xsell_id,
					p.products_model
                FROM
                    " . TABLE_PRODUCTS_XSELL . " px,
					" . TABLE_PRODUCTS . " p
                WHERE
                px.xsell_id = p.products_id and
                px.products_id = " . $row['v_products_id'] . "
                ";
            $cross_sell_result = tep_db_query($sql2);
            while ($cross_sell_row = tep_db_fetch_array($cross_sell_result)) {
                $px_models .= $cross_sell_row['products_model'] . ',';
            }
            if (strlen($px_models) > 0) {
                $px_models = substr($px_models, 0, -1);
            }
            $row['v_cross_sell'] = $px_models;
        }

        // this is for the separate price per customer module
        if (isset($filelayout['v_customer_price_1'])) {
            $sql2 = "SELECT
                    customers_group_price,
                    customers_group_id
                FROM
                    " . TABLE_PRODUCTS_GROUPS . "
                WHERE
                products_id = " . $row['v_products_id'] . "
                ORDER BY
                customers_group_id";
            $result2 = tep_db_query($sql2);
            $ll = 1;
            $row2 = tep_db_fetch_array($result2);

            // do pricing specials
            if (isset($filelayout['v_customer_specials_price_1'])) {
                $sppc_specials = array();
                $specials_result = tep_db_query("SELECT specials_new_products_price, status, customers_group_id FROM " . TABLE_SPECIALS . " WHERE products_id = " . $row['v_products_id'] . " and customers_group_id <> 0 and expires_date < CURRENT_TIMESTAMP ORDER BY specials_id DESC");
                while ($specials_result_row = tep_db_fetch_array($specials_result)) {
                    $sppc_specials[$specials_result_row['customers_group_id']] = $specials_result_row['specials_new_products_price'];
                }
            }

            while ($row2) {
                $row['v_customer_group_id_' . $ll] = $row2['customers_group_id'];
                $row['v_customer_price_' . $ll] = $row2['customers_group_price'];
                // do pricing specials
                if (isset($filelayout['v_customer_specials_price_1'])) {
                    $row['v_customer_specials_price_' . $ll] = $sppc_specials[$ll];
                }
                $row2 = tep_db_fetch_array($result2);
                $ll++;
            }
            // do pricing specials
            $specials_result = tep_db_query("SELECT specials_new_products_price, status FROM " . TABLE_SPECIALS . " WHERE products_id = " . $row['v_products_id'] . " and customers_group_id <> 0 and expires_date < CURRENT_TIMESTAMP ORDER BY specials_id DESC");
            if ($specials_result_row = tep_db_fetch_array($specials_result)) {
                if ($specials_result_row['status'] == 1) {
                    $row[EASY_R_DISC] = $specials_result_row['specials_new_products_price'];
                } else {
                    $row[EASY_R_DISC] = $specials_result_row['specials_new_products_price'];
                }
            } else {
                $row[EASY_R_DISC] = '';
            }
        }

        //elari -
        //We check the value of tax class and title instead of the id
        //Then we add the tax to price if EP_PRICE_WITH_TAX is set to true
        //     $row_tax_multiplier         = tep_get_tax_class_rate($row['v_tax_class_id']);
        //       $row['v_tax_class_title']   = tep_get_tax_class_title($row['v_tax_class_id']);
        $row[EASY_R_PRICE] = $row[EASY_R_PRICE] +
            (EP_PRICE_WITH_TAX == true ? round(($row[EASY_R_PRICE] * $row_tax_multiplier / 100), EP_PRECISION) : 0);

        // do pricing specials
        if (EP_SPPC_SUPPORT == true) {
            $SPPC_extra_query = 'and customers_group_id = 0 ';
        } else {
            $SPPC_extra_query = '';
        }
        if (isset($filelayout[EASY_R_DISC])) {
            $specials_result = tep_db_query("SELECT specials_new_products_price, status FROM " . TABLE_SPECIALS . " WHERE products_id = " . $row['v_products_id'] . " " . $SPPC_extra_query . "and (expires_date < CURRENT_TIMESTAMP or expires_date is null) ORDER BY specials_id DESC");
            if ($specials_result_row = tep_db_fetch_array($specials_result)) {
                if ($specials_result_row['status'] == 1) {
                    $row[EASY_R_DISC] = $specials_result_row['specials_new_products_price'];
                } else {
                    $row[EASY_R_DISC] = $specials_result_row['specials_new_products_price'];
                }
            } else {
                $row[EASY_R_DISC] = '';
            }
        }

        // Now set the status to a word the user specd in the config vars
        if ($row[EASY_R_STATUS] == '1') {
            $row[EASY_R_STATUS] = EASY_R_STATUS_ACT;
        } else {
            $row[EASY_R_STATUS] = EASY_R_STATUS_NOACT;
        }

        if (strlen($row['v_products_image_array']) > 0) {
            $row['v_products_image_array'] = implode("|", unserialize($row['v_products_image_array']));
        }

        // remove any bad things in the texts that could confuse EasyPopulate
        $therow = '';
        foreach ($filelayout as $key => $value) {
            //echo "The field was $key<br />";

            $thetext = $row[$key];
          //  $thetext = iconv('UTF-8', 'cp1251//TRANSLIT//IGNORE', $row[$key]);
            // kill the carriage returns and tabs in the descriptions, they're killing me!
            if (EP_PRESERVE_TABS_CR_LF == false) {
                $thetext = str_replace("\r", ' ', $thetext);
                $thetext = str_replace("\n", ' ', $thetext);
                $thetext = str_replace("\t", ' ', $thetext);
            }
            if (EP_EXCEL_SAFE_OUTPUT == true) {
                // use quoted values and escape the embedded quotes for excel safe output.
                $therow .= '"' . str_replace('"', '""', $thetext) . '"' . $ep_separator;
            } else {
                // and put the text into the output separated by $ep_separator defined above
                $therow .= $thetext . $ep_separator;
            }
        }

        // lop off the trailing separator, then append the end of row indicator
        $therow = substr($therow, 0, strlen($therow) - 1) . $endofrow;
        $filestring .= $therow;

        // grab the next row from the db
        $row = tep_db_fetch_array($result);
    }

    // now either stream it to them or put it in the temp directory
    if ($_GET['download'] == 'activestream') {
        echo "\xEF\xBB\xBF" . $filestring;
        die();
    }
}


//*******************************
//*******************************
// S T A R T
// PAGE DELIVERY
//*******************************
//*******************************
include_once('html-open.php');
include_once('header.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>

    <title><?php echo TITLE; ?></title>
    <script language="javascript" src="includes/general.js?t=<?=filesize(__DIR__ . DIRECTORY_SEPARATOR . DIR_WS_INCLUDES . 'general.js')?>"></script>

</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!--<div class="container">-->
<!--    <div class="col-md-12">-->
<!--        --><?php //include __DIR__ . "/../../admin/includes/material/blocks/tabs/import_export.php" ?>
<!--    </div>-->
<!--</div>-->
<div class="container">
    <div class="wrapper-title">
        <div class="bg-light lter wrapper-md wrapper_767 ng-scope">
            <h1 class="m-n font-thin h3"><?php echo EASY_VERSION_A; ?></h1>
        </div>
    </div>
    <p class="smallText"><?php
        echo $ep_message_stack;

        //*******************************
        //*******************************
        // UPLOAD AND INSERT FILE
        //*******************************
        //*******************************
    if (!empty($_POST['localfile']) or (isset($_FILES['usrfl']) && isset($_GET['split']) && $_GET['split'] == 0)) {
        ?>
    </p>
        <?php $formParams = ['import_type' => $_GET['import_type']]; ?>

    <form name="clear_form" action="<?= $_SERVER['PHP_SELF'] . '?' . http_build_query($formParams) ?>" method="post" id="clear_form">
        <input type="submit" name="clear_button" value="Clear" style="padding: 0"/>
    </form>
        <?php

        if (isset($_FILES['usrfl'])) {
            // move the file to where we can work with it
            $file = tep_get_uploaded_file('usrfl');
            if (!in_array($file['type'], $allowed_file_types)) {
                echo "<p class=smallText>";
                echo "Error file format. <br />";
                die;
            }
            if (is_uploaded_file($file['tmp_name'])) {
                tep_copy_uploaded_file($file, EP_TEMP_DIRECTORY);
            }

            echo "<p class=smallText>";
            echo "File uploaded. <br />";
            echo "Temporary filename: " . $file['tmp_name'] . "<br />";
            echo "User filename: " . $file['name'] . "<br />";
            echo "Size: " . $file['size'] . "<br />";

            // get the entire file into an array
            $readed = file(EP_TEMP_DIRECTORY . $file['name']);
        }
        if (!empty($_POST['localfile'])) {
            // move the file to where we can work with it
            //$file = tep_get_uploaded_file('usrfl');

            //$attribute_options_query = "select distinct products_options_id from " . TABLE_PRODUCTS_OPTIONS . " order by products_options_id";
            //$attribute_options_values = tep_db_query($attribute_options_query);
            //$attribute_options_count = 1;
            //while ($attribute_options = tep_db_fetch_array($attribute_options_values)){

            //if (is_uploaded_file($file['tmp_name'])) {
            //    tep_copy_uploaded_file($file, EP_TEMP_DIRECTORY);
            //}

            echo "<p class=smallText>";
            echo "Filename: " . $_POST['localfile'] . "<br />";

            // get the entire file into an array
            $readed = file(EP_TEMP_DIRECTORY . $_POST['localfile']);
        }

    // do excel safe input
        $fp = fopen(EP_TEMP_DIRECTORY . (isset($_FILES['usrfl']) ? $file['name'] : $_POST['localfile']), 'r') or die('##Can not open file for reading. Script will terminate.<br />');  // open file
    // determine the separator character.
        $header_line = fgets($fp);
        fclose($fp);

        $newStr = $header_line;
        $enCoding = mb_detect_encoding($newStr, array('Windows-1251', 'UTF-8'));
        if ($enCoding == "Windows-1251") {
            $newStr = iconv("cp1251", "utf-8", $newStr);
        }
        $header_line = trim($newStr);
        unset($readed);                    // kill array setup with above code
        $readed = array();                 // start a new one for excel_safe_output
        $fp = fopen(EP_TEMP_DIRECTORY . (isset($_FILES['usrfl']) ? $file['name'] : $_POST['localfile']), 'r') or die('##Can not open file for reading. Script will terminate.<br />');  // open file
    //setlocale(LC_ALL, 'ru_RU.cp1251');
        while ($line = fgetcsv($fp, 32768, $ep_separator)) {   // read new line (max 32K bytes)
            if ($enCoding == "Windows-1251") {
                foreach ($line as &$l) {
                    $l =    mb_convert_encoding($l, "utf-8", "windows-1251");
                }
            }
            unset($line[(sizeof($line) - 1)]);  // remove EOREOR at the end of the array
            $readed[] = $line;                // add to array we will process later
        }
        $theheaders_array = $readed[0];     // pull out header line

        fclose($fp);                        // close file

    // deleted added 3 chars "\xEF\xBB\xBF" when we made export:
 //   $theheaders_array[0] = substr($theheaders_array[0],3);
        $theheaders_array[0] = EASY_R_MODEL;

        foreach (array_keys($theheaders_array) as $key) {
         //   $theheaders_array[$key] = iconv('CP1251', 'UTF-8', $theheaders_array[$key]);
            $theheaders_array[$key] = iconv(mb_detect_encoding($theheaders_array[$key], mb_detect_order(), true), "UTF-8", $theheaders_array[$key]);
        }

        $lll = 0;
        $filelayout = array();
        foreach ($theheaders_array as $header) {
            $cleanheader = str_replace('"', '', $header);
            // echo "Fileheader was $header<br /><br /><br />";
            $filelayout[$cleanheader] = $lll++; //
        }
        unset($readed[0]); //  we don't want to process the headers with the data

    // now we've got the array broken into parts by the expicit end-of-row marker.
        foreach ($readed as $tkey => $readed_row) {
            process_row($readed_row, $filelayout, $filelayout_count, $default_these, $ep_separator, $languages, $custom_fields, $leng, $checkArttributes);
        }
    // isn't working in PHP 5
    // array_walk($readed, $filelayout, $filelayout_count, $default_these, 'process_row');
        ?>
    </p>
        <?php $formParams = ['import_type' => $_GET['import_type']]; ?>

    <form name="clear_form2" action="<?= $_SERVER['PHP_SELF'] . '?' . http_build_query($formParams) ?>" method="post" id="clear_form2">
        <input type="submit" name="clear_button2" value="Clear" style="padding: 0"/>
    </form>
        <?php


    //*******************************
    //*******************************
    // UPLOAD AND SPLIT FILE
    //*******************************
    //*******************************
    } elseif (isset($_FILES['usrfl']) && isset($_GET['split']) && $_GET['split'] == 1) {
        ?>
        </p>
        <?php $formParams = ['import_type' => $_GET['import_type']]; ?>

        <form name="clear_form2" action="<?= $_SERVER['PHP_SELF'] . '?' . http_build_query($formParams) ?>" method="post" id="clear_form2">
            <input type="submit" name="clear_button2" value="Clear" style="padding: 0"/>
        </form>
        <?php
        echo "<p class=smallText>";
        // move the file to where we can work with it
        $file = tep_get_uploaded_file('usrfl');

        //echo "Trying to move file...";
        if (is_uploaded_file($file['tmp_name'])) {
            tep_copy_uploaded_file($file, EP_TEMP_DIRECTORY);
        }

        $infp = fopen(EP_TEMP_DIRECTORY . $file['name'], "r");

        $ext_tmp = substr($file['name'], -3, 3);

        //toprow has the field headers
        $toprow = fgets($infp, 32768);


        $filecount = 1;

        echo "Creating file EP_Split" . $filecount . '.' . $ext_tmp . ' ...  ';
        $tmpfname = EP_TEMP_DIRECTORY . "EP_Split" . $filecount . '.' . $ext_tmp;
        $fp = fopen($tmpfname, "w+");
        fwrite($fp, $toprow);

        $linecount = 0;
        $line = fgets($infp, 32768);
        while ($line) {
            // walking the entire file one row at a time
            // but a line is not necessarily a complete row, we need to split on rows that have "EOREOR" at the end
            $line = str_replace('"EOREOR"', 'EOREOR', $line);
            fwrite($fp, $line);
            if (strpos($line, 'EOREOR')) {
                // we found the end of a line of data, store it
                $linecount++; // increment our line counter
                if ($linecount >= EP_SPLIT_MAX_RECORDS) {
                    echo "Added $linecount records and closing file... <br />";
                    $linecount = 0; // reset our line counter
                    // close the existing file and open another;
                    fclose($fp);
                    // increment filecount
                    $filecount++;
                    echo "Creating file EP_Split" . $filecount . '.' . $ext_tmp . ' ...  ';
                    $tmpfname = EP_TEMP_DIRECTORY . "EP_Split" . $filecount . '.' . $ext_tmp;
                    //Open next file name
                    $fp = fopen($tmpfname, "w+");
                    fwrite($fp, $toprow);
                }
            }
            $line = fgets($infp, 32768);
        }
        echo "Added $linecount records and closing file...<br /><br /> ";
        fclose($fp);
        fclose($infp);

        echo "You can download your split files in the Tools/Files under " . EP_TEMP_DIRECTORY;
    }


    //*******************************
    //*******************************
    // MAIN MENU
    //*******************************
    //*******************************
    ?>
    </p>
    <div class="row">
        <div class="col-md-12">
            <h1><?php echo EASY_LABEL_IMPORT; ?></h1>
            <?php $formParams = [
                    'split' => 0,
                    'import_type' => $_GET['import_type'],
            ];
?>
            <form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] . '?' . http_build_query($formParams) ?>" method="post"><?php if (defined('SID') && tep_not_null(SID)) {
                    echo tep_draw_hidden_field(tep_session_name(), tep_session_id());
                                                        } ?>

                <p style="margin-top: 0;">
                <input class="form-control" type="hidden" name="MAX_FILE_SIZE" value="100000000">
                <div class="col-md-3" style="padding-left: 0">
                    <input class="form-control" name="usrfl" type="file" size="50">
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="imput_mode">
                        <option value="normal"><?php echo EASY_R_NORMAL; ?></option>
                        <option value="addnew"><?php echo EASY_R_ADD; ?></option>
                        <option value="update"><?php echo EASY_R_REFRESH; ?></option>
                    </select>
                </div>

                <div class="col-md-1 col-md-offset-3">
                    <select class="form-control" name="separators">
                        <option value="1">;</option>
                        <option value="2" <?php echo ($_SESSION['languages_code'] == 'en' ? 'selected' : '') ?> >,</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="submit" style="width: 100%; float: right;" class="btn button-small control const-btn" name="buttoninsert" value="<?php echo EASY_INSERT; ?>">
                </div>
                <br/>
                </p>
            </form>
        </div>
        <div class="col-md-12" style="margin-bottom: 20px">
            <h1><?php echo EASY_LABEL_CREATE; ?></h1>
<!--            <a class="btn button-small" href="easypopulate.php?download=stream&dltype=full--><?php //if (defined('SID') && tep_not_null(SID)) {
//                echo '&' . tep_session_name() . '=' . tep_session_id();
//            } ?><!--"><b>--><?php //echo EASY_R_FULLFILE; ?><!--</b></a>-->
<!--            <a class="btn button-small" href="easypopulate.php?download=stream&dltype=priceqty--><?php //if (defined('SID') && tep_not_null(SID)) {
//                echo '&' . tep_session_name() . '=' . tep_session_id();
//            } ?><!--"><b>--><?php //echo EASY_R_ID_PRICE; ?><!--</b></a><br/>-->
            <p style="margin-top: 0;"><!-- Download file links -  Add your custom fields here -->

                <?php $formParams = ['import_type' => $_GET['import_type']]; ?>
                <form name="custom" action="<?= $_SERVER['PHP_SELF'] . '?' . http_build_query($formParams) ?>" method="get" id="custom">
                <input type="hidden" name="import_type" value="<?=$_GET['import_type']?>">

                <?php

                echo '<div class="hidden">' . tep_draw_pull_down_menu('download', array(0 => array("id" => 'activestream', 'text' => EASY_R_DOWN_NOW))) . '</div>';
                echo '<div class="col-md-2" style="padding-left: 0">' . tep_draw_pull_down_menu('dltype', array(0 => array("id" => 'full', 'text' => EASY_R_ALL), 1 => array("id" => 'priceqty', 'text' => EASY_R_PRICEQTY)), 'custom', 'onChange="return switchForm(this);"') . '</div>';
                //echo '<div class="col-md-4"><div style="height: 36px; padding: 8px">'.((EP_EXCEL_SAFE_OUTPUT == true) ? ".csv" : ".txt") . ' ' . EASY_R_FILE3.'</div></div>';

                $cells = array();
                $cells[0][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . tep_draw_checkbox_field('epcust_name', 'show', (!empty($_GET['epcust_name']) ? true : false)) . '</td><td class="smallText"> name' . '</td></tr></table>');
                $cells[0][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . tep_draw_checkbox_field('epcust_description', 'show', (!empty($_GET['epcust_description']) ? true : false)) . '</td><td class="smallText"> description' . '</td></tr></table>');
                $cells[0][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . tep_draw_checkbox_field('epcust_url', 'show', (!empty($_GET['epcust_url']) ? true : false)) . '</td><td class="smallText"> url' . '</td></tr></table>');
                $cells[0][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . tep_draw_checkbox_field('epcust_image', 'show', (!empty($_GET['epcust_image']) ? true : false)) . '</td><td class="smallText"> image' . '</td></tr></table>');
                if (EP_PRODUCTS_WITH_ATTRIBUTES == true) {
                    $cells[0][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . tep_draw_checkbox_field('epcust_attributes', 'show', (!empty($_GET['epcust_attributes']) ? true : false)) . '</td><td class="smallText"> attributes' . '</td></tr></table>');
                }

                $cells[0][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . tep_draw_checkbox_field('epcust_category', 'show', (!empty($_GET['epcust_category']) ? true : false)) . '</td><td class="smallText"> categories' . '</td></tr></table>');
                $cells[0][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . tep_draw_checkbox_field('epcust_manufacturer', 'show', (!empty($_GET['epcust_manufacturer']) ? true : false)) . '</td><td class="smallText"> manufacturer' . '</td></tr></table>');

                $cells[1][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . tep_draw_checkbox_field('epcust_price', 'show', (!empty($_GET['epcust_price']) ? true : false)) . '</td><td class="smallText"> price' . '</td></tr></table>');
                $cells[1][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . tep_draw_checkbox_field('epcust_quantity', 'show', (!empty($_GET['epcust_quantity']) ? true : false)) . '</td><td class="smallText"> quantity' . '</td></tr></table>');
                $cells[1][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . tep_draw_checkbox_field('epcust_weight', 'show', (!empty($_GET['epcust_weight']) ? true : false)) . '</td><td class="smallText"> weight' . '</td></tr></table>');
                $cells[1][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . tep_draw_checkbox_field('epcust_tax_class', 'show', (!empty($_GET['epcust_tax_class']) ? true : false)) . '</td><td class="smallText"> tax class' . '</td></tr></table>');
                $cells[1][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . tep_draw_checkbox_field('epcust_avail', 'show', (!empty($_GET['epcust_avail']) ? true : false)) . '</td><td class="smallText"> available' . '</td></tr></table>');
                $cells[1][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . tep_draw_checkbox_field('epcust_date_added', 'show', (!empty($_GET['epcust_date_added']) ? true : false)) . '</td><td class="smallText"> date added' . '</td></tr></table>');
                $cells[1][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . tep_draw_checkbox_field('epcust_status', 'show', (!empty($_GET['epcust_status']) ? true : false)) . '</td><td class="smallText"> status' . '</td></tr></table>');

                $tmp_row_count = 2;
                $tmp_col_count = 0;
                $cells[$tmp_row_count][$tmp_col_count++] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . tep_draw_checkbox_field('epcust_specials_price', 'show', (!empty($_GET['epcust_specials_price']) ? true : false)) . '</td><td class="smallText"> specials' . '</td></tr></table>');

                if (EP_MVS_SUPPORT == true) {
                    $cells[$tmp_row_count][$tmp_col_count++] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . tep_draw_checkbox_field('epcust_vendor', 'show', (!empty($_GET['epcust_vendor']) ? true : false)) . '</td><td class="smallText"> vendor' . '</td></tr></table>');
                }
                if (EP_XSELL_SUPPORT == true) {
                    $cells[$tmp_row_count][$tmp_col_count++] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . tep_draw_checkbox_field('epcust_cross_sell', 'show', (!empty($_GET['epcust_cross_sell']) ? true : false)) . '</td><td class="smallText"> x-sell' . '</td></tr></table>');
                }

                foreach ($custom_fields[TABLE_PRODUCTS] as $key => $name) {
                    $cells[$tmp_row_count][$tmp_col_count++] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . tep_draw_checkbox_field('epcust_' . $key, 'show', (!empty($_GET['epcust_' . $key]) ? true : false)) . '</td><td class="smallText"> ' . $name . '</td></tr></table>');
                    if ($tmp_col_count >= 7) {
                        $tmp_row_count += 1;
                        $tmp_col_count = 0;
                    }
                }

                foreach ($custom_fields[TABLE_PRODUCTS_DESCRIPTION] as $key => $name) {
                    $cells[$tmp_row_count][$tmp_col_count++] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . tep_draw_checkbox_field('epcust_' . $key, 'show', (!empty($_GET['epcust_' . $key]) ? true : false)) . '</td><td class="smallText"> ' . $name . '</td></tr></table>');
                    if ($tmp_col_count >= 7) {
                        $tmp_row_count += 1;
                        $tmp_col_count = 0;
                    }
                }

                // $bigbox = new epbox('',false);
                //  $bigbox->table_parameters = 'id="customtable" style="border: 1px solid #CCCCCC; padding: 2px; margin: 3px;"';
                //  echo $bigbox->output($cells);

                $manufacturers_array = array();
                $manufacturers_array[] = array("id" => '', 'text' => '- ' . EASY_R_MANUF . ' -');
                $manufacturers_query = tep_db_query("select manufacturers_id, manufacturers_name from " . TABLE_MANUFACTURERS_INFO . " where languages_id = $languages_id order by manufacturers_name");
                while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
                    $manufacturers_array[] = array("id" => $manufacturers['manufacturers_id'], 'text' => $manufacturers['manufacturers_name']);
                }

                $status_array = array(array("id" => '', 'text' => '- ' . EASY_R_STATUS . ' -'), array("id" => '1', 'text' => EASY_R_STATUS_ACT), array("id" => '0', 'text' => EASY_R_STATUS_NOACT));
                $separators_array = array(array("id" => '1', "text" => ';'), array("id" => '2', "text" => ','));

                echo '<div class="col-md-2" style="width: 9.666667%; padding: 0 10px;"><div style="width: 14.666667%; padding: 6px 0; font-size: 16px; text-align: right">' . EASY_R_FILTER . ':</div></div><div class="col-md-2">' . tep_draw_pull_down_menu('epcust_category_filter', array_merge(array(0 => array("id" => '', 'text' => '- ' . EASY_R_CAT . ' -')), $tep_get_category_tree ?: [])) . '</div>';
                echo ' ' . '<div class="col-md-2" style="padding: 0 10px; padding-left: 0; width: 17.666667%">' . tep_draw_pull_down_menu('epcust_manufacturer_filter', $manufacturers_array) . '</div>' . ' ';
                echo ' ' . '<div class="col-md-2" style="padding: 0 10px; padding-left: 0; width: 14.666667%;">' . tep_draw_pull_down_menu('epcust_status_filter', $status_array) . '</div>' . ' ';
                $default_separator_id = $_SESSION['languages_code'] == 'en' ? '2' : '1';
                echo ' ' . '<div class="col-md-1" style="padding: 0 10px; width: 7.666667%;">' . tep_draw_pull_down_menu('separators', $separators_array, $default_separator_id) . '</div>' . ' ';


                // echo tep_draw_input_field('submit', 'Создать', ' style="padding: 0px"', false, 'submit');
                echo '<div class="col-md-2">' . "<input type='submit' style='width: 100%;float: right;' class='btn button-small const-btn' value='" . EASY_LABEL_PRODUCT_START . "'>" . '</div>';
                ?>

                </form>

            </p>
        </div>
    </div>
</div>


<?php
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
//
// ep_create_filelayout()
//
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
function ep_create_filelayout($dltype, $attribute_options_array, $languages, $custom_fields)
{

    // depending on the type of the download the user wanted, create a file layout for it.
    $fieldmap = array(); // default to no mapping to change internal field names to external.

    // build filters
    $sql_filter = '';
    if (!empty($_GET['epcust_category_filter'])) {
        $sub_categories = array();
        $categories_query_addition = 'ptoc.categories_id = ' . (int)$_GET['epcust_category_filter'] . '';
        tep_get_sub_categories($sub_categories, $_GET['epcust_category_filter']);
        foreach ($sub_categories as $ckey => $category) {
            $categories_query_addition .= ' or ptoc.categories_id = ' . (int)$category . '';
        }
        $sql_filter .= ' and (' . $categories_query_addition . ')';
    }
    if (!empty($_GET['epcust_manufacturer_filter'])) {
        $sql_filter .= ' and p.manufacturers_id = ' . (int)$_GET['epcust_manufacturer_filter'];
    }
    if (!empty($_GET['epcust_status_filter'])) {
        $sql_filter .= ' and p.products_status = ' . (int)$_GET['epcust_status_filter'];
    }

    // /////////////////////////////////////////////////////////////////////
    //
    // Start: Support for other contributions
    //
    // /////////////////////////////////////////////////////////////////////

    $ep_additional_layout_product = '';
    $ep_additional_layout_product_select = '';
    $ep_additional_layout_product_description = '';
    $ep_additional_layout_pricing = '';

    if ($dltype == 'full') {
        foreach ($custom_fields[TABLE_PRODUCTS] as $key => $name) {
            $ep_additional_layout_product .= '$filelayout[\'v_' . $key . '\'] = $iii++;
                                            ';
            $ep_additional_layout_product_select .= 'p.' . $key . ' as v_' . $key . ',';
        }
    }

    if (EP_PDF_UPLOAD_SUPPORT == true) {
        $ep_additional_layout_product .= '$filelayout[\'v_products_pdfupload\'] = $iii++;
					$filelayout[\'v_products_fileupload\'] = $iii++;
					';
    }

    if (EP_PDF_UPLOAD_SUPPORT == true) {
        $ep_additional_layout_product_select .= 'p.products_pdfupload as v_products_pdfupload,p.products_fileupload as v_products_fileupload,';
    }

    if (EP_SPPC_SUPPORT == true) {
        if (!empty($_GET['epcust_specials_price'])) {
            $ep_additional_layout_pricing .= '$filelayout[\'v_customer_price_1\'] = $iii++;
                                        $filelayout[\'v_customer_specials_price_1\'] = $iii++;
                                        $filelayout[\'v_customer_group_id_1\'] = $iii++;
                                        $filelayout[\'v_customer_price_2\'] = $iii++;
                                        $filelayout[\'v_customer_specials_price_2\'] = $iii++;
                                        $filelayout[\'v_customer_group_id_2\'] = $iii++;
                                        $filelayout[\'v_customer_price_3\'] = $iii++;
                                        $filelayout[\'v_customer_specials_price_3\'] = $iii++;
                                        $filelayout[\'v_customer_group_id_3\'] = $iii++;
                                        $filelayout[\'v_customer_price_4\'] = $iii++;
                                        $filelayout[\'v_customer_specials_price_4\'] = $iii++;
                                        $filelayout[\'v_customer_group_id_4\'] = $iii++;
                                        ';
        } else {
            $ep_additional_layout_pricing .= '$filelayout[\'v_customer_price_1\'] = $iii++;
                                        $filelayout[\'v_customer_group_id_1\'] = $iii++;
                                        $filelayout[\'v_customer_price_2\'] = $iii++;
                                        $filelayout[\'v_customer_group_id_2\'] = $iii++;
                                        $filelayout[\'v_customer_price_3\'] = $iii++;
                                        $filelayout[\'v_customer_group_id_3\'] = $iii++;
                                        $filelayout[\'v_customer_price_4\'] = $iii++;
                                        $filelayout[\'v_customer_group_id_4\'] = $iii++;
                                        ';
        }
    }
    if (EP_HTC_SUPPORT == true) {
        $ep_additional_layout_product_description .= '$filelayout[\'v_products_head_title_tag_\'.$lang[\'id\']]    = $iii++;
                                                    $filelayout[\'v_products_head_desc_tag_\'.$lang[\'id\']]     = $iii++;
                                                    $filelayout[\'v_products_head_keywords_tag_\'.$lang[\'id\']] = $iii++;
                                                    ';
    }

    if (EP_MVS_SUPPORT == true) {
        $ep_additional_layout_product_select .= 'p.vendors_id as v_vendor_id,';
    }

    // /////////////////////////////////////////////////////////////////////
    // End: Support for other contributions
    // /////////////////////////////////////////////////////////////////////


    switch ($dltype) {
        case 'full':
            // The file layout is dynamically made depending on the number of languages
            $iii = 0;
            $filelayout = array();

            $filelayout[EASY_R_MODEL] = $iii++;


            $filelayout[EASY_R_NAME] = $iii++;
            $filelayout[EASY_R_DESC] = $iii++;
//            $filelayout['v_products_url_'.$lang['id']]         = $iii++;
            foreach ($custom_fields[TABLE_PRODUCTS_DESCRIPTION] as $key => $name) {
                $filelayout['v_' . $key] = $iii++;
            }
            if (!empty($ep_additional_layout_product_description)) {
                eval($ep_additional_layout_product_description);
            }


            $filelayout[EASY_R_IMAGES] = $iii++;

            if (!empty($ep_additional_layout_product)) {
                eval($ep_additional_layout_product);
            }

            $filelayout[EASY_R_PRICE] = $iii++;

            // price 2,3,4
            $prices_num = tep_xppp_getpricesnum();
            $prices_str = '';
            for ($i = 2; $i <= $prices_num; $i++) {
                $filelayout[EASY_R_PRICE . '_' . $i] = $iii++;
                $prices_str .= 'p.products_price_' . $i . ' as ' . EASY_R_PRICE . '_' . $i . ',';
            }

            $filelayout[EASY_R_DISC] = $iii++;

            if (EP_MVS_SUPPORT == true) {
                $filelayout['v_vendor'] = $iii++;
            }

            if (!empty($ep_additional_layout_pricing)) {
                eval($ep_additional_layout_pricing);
            }

            $filelayout[EASY_R_QTY] = $iii++;
            //       $filelayout['v_products_weight']   = $iii++;
            //      $filelayout['v_date_avail']        = $iii++;
            //      $filelayout['минимум']   = $iii++;
            //      $filelayout['шаг']        = $iii++;

            //       $filelayout['ед_изм']   = $iii++;
            //       $filelayout['хит'] = $iii++;

            $filelayout[EASY_R_DATE] = $iii++;

            // build the categories name section of the array based on the number of categores the user wants to have
            for ($i = 1; $i < EP_MAX_CATEGORIES + 1; $i++) {
                //$filelayout['картинка_кат_' . $i] = $iii++;
                $filelayout[EASY_R_CAT . '_' . $i] = $iii++;
            }

            $filelayout[EASY_R_MANUF] = $iii++;

            // VJ product attribs begin
            $attribute_options_count = 1;
            foreach ($attribute_options_array as $attribute_options_values) {
                //   $filelayout['v_attribute_options_id_'.$attribute_options_count] = $iii++;

                $filelayout[$attribute_options_values['products_options_name']] = $iii++;


                /*
            $attribute_values_query = "select products_options_values_id  from " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " where products_options_id = '" . (int)$attribute_options_values['products_options_id'] . "' order by products_options_values_id";
            $attribute_values_values = tep_db_query($attribute_values_query);

            $attribute_values_count = 1;
            while ($attribute_values = tep_db_fetch_array($attribute_values_values)) {
                $filelayout['v_attribute_values_id_'.$attribute_options_count.'_'.$attribute_values_count] = $iii++;
                foreach ($languages as $tkey => $lang ) {
                    $filelayout['v_attribute_values_name_'.$attribute_options_count.'_'.$attribute_values_count.'_'.$lang['id']] = $iii++;
                }
                $filelayout['v_attribute_values_price_'.$attribute_options_count.'_'.$attribute_values_count] = $iii++;
                //// attributes stock add start
                if ( EP_PRODUCTS_ATTRIBUTES_STOCK == true ) {
                    $filelayout['v_attribute_values_stock_'.$attribute_options_count.'_'.$attribute_values_count] = $iii++;
                }
                //// attributes stock add end
                $attribute_values_count++;
             }
             */


                $attribute_options_count++;
            }
            // VJ product attribs end

            //     $filelayout['v_tax_class_title']  = $iii++;
            $filelayout[EASY_R_STATUS] = $iii++;

            $filelayout_sql = "SELECT
            p.products_id as v_products_id,
            p.products_model as " . EASY_R_MODEL . ",
            p.products_image as " . EASY_R_IMAGES . ",
            p.products_quantity as " . EASY_R_QTY . ",
            $ep_additional_layout_product_select
            p.products_price as " . EASY_R_PRICE . ",
            $prices_str
            p.products_date_added as " . EASY_R_DATE . ",
            p.manufacturers_id as v_manufacturers_id,
            subc.categories_id as v_categories_id,
            p.products_status as " . EASY_R_STATUS . "
            FROM
            " . TABLE_PRODUCTS . " as p,
            " . TABLE_CATEGORIES . " as subc,
            " . TABLE_PRODUCTS_TO_CATEGORIES . " as ptoc
            WHERE
            p.products_id = ptoc.products_id AND
            ptoc.categories_id = subc.categories_id
            " . $sql_filter;

            break;

        case 'priceqty':
            $iii = 0;
            $filelayout = array();

            $filelayout[EASY_R_MODEL] = $iii++;
            $filelayout[EASY_R_PRICE] = $iii++;

            // price 2,3,4
            $prices_num = tep_xppp_getpricesnum();
            $prices_str = '';
            for ($i = 2; $i <= $prices_num; $i++) {
                $filelayout[EASY_R_PRICE . '_' . $i] = $iii++;
                $prices_str .= 'p.products_price_' . $i . ' as ' . EASY_R_PRICE . '_' . $i . ',';
            }

            $filelayout[EASY_R_QTY] = $iii++;
            if (!empty($ep_additional_layout_pricing)) {
                eval($ep_additional_layout_pricing);
            }

            $filelayout_sql = "SELECT
            p.products_id as v_products_id,
            p.products_model as " . EASY_R_MODEL . ",
            p.products_price as " . EASY_R_PRICE . ",
            $prices_str
			      p.products_quantity as " . EASY_R_QTY . "
            FROM
            " . TABLE_PRODUCTS . " as p,
            " . TABLE_CATEGORIES . " as subc,
            " . TABLE_PRODUCTS_TO_CATEGORIES . " as ptoc
            WHERE
            p.products_id = ptoc.products_id AND
            ptoc.categories_id = subc.categories_id
            " . $sql_filter;
            break;

        case 'custom':
            $iii = 0;
            $filelayout = array();

            $filelayout['v_products_model'] = $iii++;

            if (!empty($_GET['epcust_status'])) {
                $filelayout['v_status'] = $iii++;
            }

            foreach ($languages as $key => $lang) {
                if (!empty($_GET['epcust_name'])) {
                    $filelayout['v_products_name_' . $lang['id']] = $iii++;
                }
                if (!empty($_GET['epcust_description'])) {
                    $filelayout['v_products_description_' . $lang['id']] = $iii++;
                }
                if (!empty($_GET['epcust_url'])) {
                    $filelayout['v_products_url_' . $lang['id']] = $iii++;
                }
                foreach ($custom_fields[TABLE_PRODUCTS_DESCRIPTION] as $key => $name) {
                    if (!empty($_GET['epcust_' . $key])) {
                        $filelayout['v_' . $key . '_' . $lang['id']] = $iii++;
                    }
                }
            }

            if (!empty($_GET['epcust_image']) || !empty($_GET['epcust_add_images'])) {
                $filelayout['v_products_image'] = $iii++;

                if (!empty($ep_additional_layout_product)) {
                    eval($ep_additional_layout_product);
                }
            }

            foreach ($custom_fields[TABLE_PRODUCTS] as $key => $name) {
                if (!empty($_GET['epcust_' . $key])) {
                    $filelayout['v_' . $key] = $iii++;
                    $ep_additional_layout_product_select .= 'p.' . $key . ' as v_' . $key . ',';
                }
            }

            if (!empty($_GET['epcust_price'])) {
                $filelayout['v_products_price'] = $iii++;
            }
            if (!empty($_GET['epcust_specials_price'])) {
                $filelayout['v_products_specials_price'] = $iii++;
            }
            if (!empty($_GET['epcust_quantity'])) {
                $filelayout['v_products_quantity'] = $iii++;
            }
            if (!empty($_GET['epcust_weight'])) {
                $filelayout['v_products_weight'] = $iii++;
            }
            if (!empty($_GET['epcust_avail'])) {
                $filelayout['v_date_avail'] = $iii++;
            }
            if (!empty($_GET['epcust_date_added'])) {
                $filelayout['v_date_added'] = $iii++;
            }

            if (!empty($_GET['epcust_category'])) {
                // build the categories name section of the array based on the number
                // of categores the user wants to have
                for ($i = 1; $i <= EP_MAX_CATEGORIES; $i++) {
                    $filelayout['v_categories_image_' . $i] = $iii++;
                    foreach ($languages as $key => $lang) {
                        $filelayout['v_categories_name_' . $i . '_' . $lang['id']] = $iii++;
                    }
                }
            }

            if (!empty($_GET['epcust_manufacturer'])) {
                $filelayout['v_manufacturers_name'] = $iii++;
            }

            if (!empty($_GET['epcust_attributes'])) {
                // VJ product attribs begin
                $attribute_options_count = 1;
                foreach ($attribute_options_array as $tkey => $attribute_options_values) {
                    $filelayout['v_attribute_options_id_' . $attribute_options_count] = $iii++;
                    foreach ($languages as $tkey => $lang) {
                        $filelayout['v_attribute_options_name_' . $attribute_options_count . '_' . $lang['id']] = $iii++;
                    }
                    /*
            $attribute_values_query = "select products_options_values_id  from " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " where products_options_id = '" . (int)$attribute_options_values['products_options_id'] . "' order by products_options_values_id";
            $attribute_values_values = tep_db_query($attribute_values_query);

            $attribute_values_count = 1;
            while ($attribute_values = tep_db_fetch_array($attribute_values_values)) {
                $filelayout['v_attribute_values_id_'.$attribute_options_count.'_'.$attribute_values_count] = $iii++;
                foreach ($languages as $tkey => $lang ) {
                    $filelayout['v_attribute_values_name_'.$attribute_options_count.'_'.$attribute_values_count.'_'.$lang['id']] = $iii++;
                }
                $filelayout['v_attribute_values_price_'.$attribute_options_count.'_'.$attribute_values_count] = $iii++;
                //// attributes stock add start
                if ( EP_PRODUCTS_ATTRIBUTES_STOCK == true ) {
                    $filelayout['v_attribute_values_stock_'.$attribute_options_count.'_'.$attribute_values_count] = $iii++;
                }
                //// attributes stock add end
                $attribute_values_count++;
             }
             */
                    $attribute_options_count++;
                }
                // VJ product attribs end
            }
            if (EP_MVS_SUPPORT == true) {
                if (!empty($_GET['epcust_vendor'])) {
                    $filelayout['v_vendor'] = $iii++;
                }
            }

            if (!empty($_GET['epcust_sppc'])) {
                if (!empty($ep_additional_layout_pricing)) {
                    eval($ep_additional_layout_pricing);
                }
            }

            if (!empty($_GET['epcust_tax_class'])) {
                $filelayout['v_tax_class_title'] = $iii++;
            }
            if (!empty($_GET['epcust_comment'])) {
                $filelayout['v_products_comment'] = $iii++;
            }
            if (!empty($_GET['epcust_cross_sell'])) {
                $filelayout['v_cross_sell'] = $iii++;
            }

            $filelayout_sql = "SELECT
            p.products_id as v_products_id,
            p.products_model as v_products_model,
            p.products_status as v_status,
            p.products_price as v_products_price,
            p.products_quantity as v_products_quantity,
            p.products_weight as v_products_weight,
            p.products_image as v_products_image,
            $ep_additional_layout_product_select
            p.manufacturers_id as v_manufacturers_id,
            p.products_date_available as v_date_avail,
            p.products_date_added as v_date_added,
            p.products_tax_class_id as v_tax_class_id,
            subc.categories_id as v_categories_id
            FROM
            " . TABLE_PRODUCTS . " as p,
            " . TABLE_CATEGORIES . " as subc,
            " . TABLE_PRODUCTS_TO_CATEGORIES . " as ptoc
            WHERE
            p.products_id = ptoc.products_id AND
            ptoc.categories_id = subc.categories_id
            " . $sql_filter;
            break;

        case 'category':
            $iii = 0;
            $filelayout = array();

            $filelayout['v_products_model'] = $iii++;

            for ($i = 1; $i < EP_MAX_CATEGORIES + 1; $i++) {
                $filelayout['v_categories_image_' . $i] = $iii++;
                foreach ($languages as $key => $lang) {
                    $filelayout['v_categories_name_' . $i . '_' . $lang['id']] = $iii++;
                }
            }

            $filelayout_sql = "SELECT
            p.products_id as v_products_id,
            p.products_model as v_products_model,
            subc.categories_id as v_categories_id
            FROM
            " . TABLE_PRODUCTS . " as p,
            " . TABLE_CATEGORIES . " as subc,
            " . TABLE_PRODUCTS_TO_CATEGORIES . " as ptoc
            WHERE
            p.products_id = ptoc.products_id AND
            ptoc.categories_id = subc.categories_id
            ";
            break;

        case 'extra_fields':
            // start EP for product extra field ============================= DEVSOFTVN - 10/20/2005
            $iii = 0;
            $filelayout = array(
                'v_products_model' => $iii++,
                'v_products_extra_fields_name' => $iii++,
                'v_products_extra_fields_id' => $iii++,
//            'v_products_id'        => $iii++,
                'v_products_extra_fields_value' => $iii++,
            );

            $filelayout_sql = "SELECT
                        p.products_id as v_products_id,
                        p.products_model as v_products_model,
                        subc.products_extra_fields_id as v_products_extra_fields_id,
                        subc.products_extra_fields_value as v_products_extra_fields_value,
                        ptoc.products_extra_fields_name as v_products_extra_fields_name
                        FROM
                        " . TABLE_PRODUCTS . " as p,
                        " . TABLE_PRODUCTS_TO_PRODUCTS_EXTRA_FIELDS . " as subc,
                        " . TABLE_PRODUCTS_EXTRA_FIELDS . " as ptoc
                        WHERE
                        p.products_id = subc.products_id AND
                        ptoc.products_extra_fields_id = subc.products_extra_fields_id
                        ";
            // end of EP for extra field code ======= DEVSOFTVN================
            break;

        // VJ product attributes begin
        case 'attrib':
            $iii = 0;
            $filelayout = array();

            $filelayout['v_products_model'] = $iii++;

            $attribute_options_count = 1;
            foreach ($attribute_options_array as $tkey1 => $attribute_options_values) {
                //   $filelayout['v_attribute_options_id_'.$attribute_options_count] = $iii++;
                foreach ($languages as $tkey => $lang) {
                    $filelayout['v_attribute_options_name_' . $attribute_options_count . '_' . $lang['id']] = $iii++;
                }
                /*
            $attribute_values_query = "select products_options_values_id  from " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " where products_options_id = '" . (int)$attribute_options_values['products_options_id'] . "' order by products_options_values_id";
            $attribute_values_values = tep_db_query($attribute_values_query);

            $attribute_values_count = 1;
            while ($attribute_values = tep_db_fetch_array($attribute_values_values)) {
               $filelayout['v_attribute_values_id_'.$attribute_options_count.'_'.$attribute_values_count] = $iii++;
                foreach ($languages as $tkey2 => $lang ) {
                    $filelayout['v_attribute_values_name_'.$attribute_options_count.'_'.$attribute_values_count.'_'.$lang['id']] = $iii++;
                }
                $filelayout['v_attribute_values_price_'.$attribute_options_count.'_'.$attribute_values_count] = $iii++;
                //// attributes stock add start
                if ( EP_PRODUCTS_ATTRIBUTES_STOCK    == true ) {
                    $header_array['v_attribute_values_stock_'.$attribute_options_count.'_'.$attribute_values_count] = $iii++;
                }
                //// attributes stock add end
                $attribute_values_count++;
            }
            */
                $attribute_options_count++;
            }

            $filelayout_sql = "SELECT
                            p.products_id as v_products_id,
                            p.products_model as v_products_model
                            FROM
                            " . TABLE_PRODUCTS . " as p
                            ";

            break;
        // VJ product attributes end
    }


    $filelayout_count = count($filelayout);

    return array($filelayout, $filelayout_count, $filelayout_sql, $fileheaders);
}


///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
//
// process_row()
//
//   Processes one row of the import file
//
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
function process_row($item1, $filelayout, $filelayout_count, $default_these, $ep_separator, $languages, $custom_fields, $leng, $checkArttributes)
{

    $tempFileLayout = [];
    foreach ($filelayout as $k => &$f) {
        $tempFileLayout[mb_strtolower($k)] = $f;
    }
    $filelayout = $tempFileLayout;

    // first we clean up the row of data
    if (EP_EXCEL_SAFE_OUTPUT == true) {
        $items = $item1;
    } else {
        // chop blanks from each end
        $item1 = ltrim(rtrim($item1));

        // blow it into an array, splitting on the tabs
        if ($_POST['separators']) {
            if ($_POST['separators'] == '2') {
                $items = explode(';', $item1);
            } else {
                $items = explode(',', $item1);
            }
        }
    }

    foreach (array_keys($items) as $key) {
     //   $items[$key] = iconv('CP1251', 'UTF-8', $items[$key]);
         $items[$key] = iconv(mb_detect_encoding($items[$key], mb_detect_order(), true), "UTF-8", $items[$key]);
    }

    // make sure all non-set things are set to '';
    // and strip the quotes from the start and end of the stings.


    // escape any special chars for the database.
    foreach ($filelayout as $key => $value) {
        $i = $filelayout[$key];
        if (isset($items[$i]) == false) {
            $items[$i] = '';
        } else {
            // Check to see if either of the magic_quotes are turned on or off;
            // And apply filtering accordingly.
            if (function_exists('ini_get')) {
                //echo "Getting ready to check magic quotes<br />";
                if (ini_get('magic_quotes_runtime') == 1) {
                    // The magic_quotes_runtime are on, so lets account for them
                    // check if the first & last character are quotes;
                    // if it is, chop off the quotes.
                    if (substr($items[$i], -1) == '"' && substr($items[$i], 0, 1) == '"') {
                        $items[$i] = substr($items[$i], 2, strlen($items[$i]) - 4);
                    }
                    // now any remaining doubled double quotes should be converted to one doublequote
                    if (EP_REPLACE_QUOTES == true) {
                        if (EP_EXCEL_SAFE_OUTPUT == true) {
                            $items[$i] = str_replace('\"\"', "&#34;", $items[$i]);
                        }
                        $items[$i] = str_replace('\"', "&#34;", $items[$i]);
                        $items[$i] = str_replace("\'", "&#39;", $items[$i]);
                    }
                } else { // no magic_quotes are on
                    // check if the last character is a quote;
                    // if it is, chop off the 1st and last character of the string.
                    if (substr($items[$i], -1) == '"' && substr($items[$i], 0, 1) == '"') {
                        $items[$i] = substr($items[$i], 1, strlen($items[$i]) - 2);
                    }
                    // now any remaining doubled double quotes should be converted to one doublequote
                    if (EP_REPLACE_QUOTES == true) {
                        if (EP_EXCEL_SAFE_OUTPUT == true) {
                            $items[$i] = str_replace('""', "&#34;", $items[$i]);
                        }
                        $items[$i] = str_replace('"', "&#34;", $items[$i]);
                        $items[$i] = str_replace("'", "&#39;", $items[$i]);
                    }
                }
            }
        }
    }


    $v_products_quantity = $items[$filelayout[EASY_R_QTY]];
    $v_products_model = $items[$filelayout[EASY_R_MODEL]];
    $v_products_image = $items[$filelayout[EASY_R_IMAGES]];
//    $v_products_image_med = $items[$filelayout['картинка_большая']];
    $v_status = $items[$filelayout[EASY_R_STATUS]];

    // /////////////////////////////////////////////////////////////
    // Do specific functions without processing entire range of vars
    // /////////////////////////////
    // first do product extra fields
    if (isset($items[$filelayout['v_products_extra_fields_id']])) {
        $v_products_model = $items[$filelayout[EASY_R_MODEL]];
        // EP for product extra fields Contrib by minhmaster DEVSOFTVN ==========
        $v_products_extra_fields_id = $items[$filelayout['v_products_extra_fields_id']];
//        $v_products_id    =    $items[$filelayout['v_products_id']];
        $v_products_extra_fields_value = $items[$filelayout['v_products_extra_fields_value']];

        $sql = "SELECT p.products_id as v_products_id FROM " . TABLE_PRODUCTS . " as p WHERE p.products_model = '" . $v_products_model . "'";
        $result = tep_db_query($sql);
        $row = tep_db_fetch_array($result);

        $sql_exist = "SELECT products_extra_fields_value FROM " . TABLE_PRODUCTS_TO_PRODUCTS_EXTRA_FIELDS . " WHERE (products_id ='" . $row['v_products_id'] . "') AND (products_extra_fields_id ='" . $v_products_extra_fields_id . "')";

        if (tep_db_num_rows(tep_db_query($sql_exist)) > 0) {
            $sql_extra_field = "UPDATE " . TABLE_PRODUCTS_TO_PRODUCTS_EXTRA_FIELDS . " SET products_extra_fields_value='" . $v_products_extra_fields_value . "' WHERE (products_id ='" . $row['v_products_id'] . "') AND (products_extra_fields_id ='" . $v_products_extra_fields_id . "')";
            $str_err_report = " $v_products_extra_fields_id | $v_products_id  | $v_products_model | $v_products_extra_fields_value | <b><font color=black>Product Extra Fields Updated</font></b><br />";
        } else {
            $sql_extra_field = "INSERT INTO " . TABLE_PRODUCTS_TO_PRODUCTS_EXTRA_FIELDS . "(products_id,products_extra_fields_id,products_extra_fields_value) VALUES ('" . $row['v_products_id'] . "','" . $v_products_extra_fields_id . "','" . $v_products_extra_fields_value . "')";
            $str_err_report = " $v_products_extra_fields_id | $v_products_id | $v_products_model | $v_products_extra_fields_value | <b><font color=green>Product Extra Fields Inserted</font></b><br />";
        }

        $result = tep_db_query($sql_extra_field);

        echo $str_err_report;
        // end (EP for product extra fields Contrib by minhmt DEVSOFTVN) ============

        // /////////////////////
        // or do product deletes

        // if product's status is 'delete' --> delete product
    } elseif ($v_status == EASY_R_STATUS_DELETE) {
        // Get the ID
        $sql = "SELECT p.products_id as v_products_id    FROM " . TABLE_PRODUCTS . " as p WHERE p.products_model = '" . $items[$filelayout[EASY_R_MODEL]] . "'";
        $result = tep_db_query($sql);
        $row = tep_db_fetch_array($result);
        if (tep_db_num_rows($result) == 1) {
            tep_db_query("delete from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . $row['v_products_id'] . "'");

            $product_categories_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . $row['v_products_id'] . "'");
            $product_categories = tep_db_fetch_array($product_categories_query);

            if ($product_categories['total'] == '0') {
                // gather product attribute data
                $result = tep_db_query("select pov.products_options_values_id from " . TABLE_PRODUCTS_ATTRIBUTES . " pa left join " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov on pa.options_values_id=pov.products_options_values_id where pa.products_id = '" . (int)$row['v_products_id'] . "'");
                $remove_attribs = array();
                while ($tmp_attrib = tep_db_fetch_array($result)) {
                    $remove_attribs[] = $tmp_attrib;
                }

                // check each attribute name for links to other products
                foreach ($remove_attribs as $rakey => $ravalue) {
                    $product_attribs_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_ATTRIBUTES . " where options_values_id = '" . (int)$ravalue['products_options_values_id'] . "'");
                    $product_attribs = tep_db_fetch_array($product_attribs_query);
                    // if no other products linked, remove attribute name
                    if ((int)$product_attribs['total'] == 1) {
                        tep_db_query("delete from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where products_options_values_id = '" . (int)$ravalue['products_options_values_id'] . "'");
                    }
                }
                // remove attribute records
                tep_db_query("delete from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$row['v_products_id'] . "'");

                // remove product
                tep_remove_product($row['v_products_id']);
            }

            resetCacheForCategories();
            echo "Deleted product " . $items[$filelayout[EASY_R_MODEL]] . " from the database<br />";
        } else {
            echo "Did not delete " . $items[EASY_R_MODEL] . " since it is not unique<br> ";
        }

        // //////////////////////////////////
        // or do regular product processing
        // //////////////////////////////////
    } else {
        // /////////////////////////////////////////////////////////////////////
        //
        // Start: Support for other contributions in products table
        //
        // /////////////////////////////////////////////////////////////////////
        $ep_additional_select = '';

        if (EP_PDF_UPLOAD_SUPPORT == true) {
            $ep_additional_select .= 'p.products_pdfupload as v_products_pdfupload, p.products_fileupload as v_products_fileupload,';
        }

        if (EP_MVS_SUPPORT == true) {
            $ep_additional_select .= 'vendors_id as v_vendor_id,';
        }

        foreach ($custom_fields[TABLE_PRODUCTS] as $key => $name) {
            $ep_additional_select .= 'p.' . $key . ' as v_' . $key . ',';
        }

        // price 2,3,4
        $prices_num = tep_xppp_getpricesnum();
        $prices_str = '';
        for ($i = 2; $i <= $prices_num; $i++) {
            $prices_str .= 'p.products_price_' . $i . ' as ' . EASY_R_PRICE . '_' . $i . ',';
        }

        // /////////////////////////////////////////////////////////////////////
        // End: Support for other contributions in products table
        // /////////////////////////////////////////////////////////////////////

        // now do a query to get the record's current contents

        $sql = "SELECT
                    p.products_id as v_products_id,
                    p.products_model as " . EASY_R_MODEL . ",
                    p.products_quantity as " . EASY_R_QTY . ",
                    p.products_image as " . EASY_R_IMAGES . ",
                    $ep_additional_select
                    p.products_price as " . EASY_R_PRICE . ",
                    $prices_str
                    p.products_date_added as " . EASY_R_DATE . ",
                    p.manufacturers_id as v_manufacturers_id,
                    subc.categories_id as v_categories_id,
                    p.products_status as " . EASY_R_STATUS . "
                FROM
                    " . TABLE_PRODUCTS . " as p,
                    " . TABLE_CATEGORIES . " as subc,
                    " . TABLE_PRODUCTS_TO_CATEGORIES . " as ptoc
                WHERE
                    p.products_model = '" . $items[$filelayout[EASY_R_MODEL]] . "' AND
                    p.products_id = ptoc.products_id AND
                    ptoc.categories_id = subc.categories_id
                LIMIT 1
            ";

        $result = tep_db_query($sql);
        $row = tep_db_fetch_array($result);

        // determine processing status based on dropdown choice on EP menu
        // Delete product included in normal & update options
        if ((sizeof($row) > 1) && ($_POST['imput_mode'] == "normal" || $_POST['imput_mode'] == "update")) {
            $process_product = true;
            // For Delete Only option (product exists) & (v_status = EP_DELETE_IT) & (Delete Only)
        } elseif ((sizeof($row) > 1) && ($items[$filelayout[EASY_R_STATUS]] == EASY_R_STATUS_NOACT) && ($_POST['imput_mode'] == "delete")) {
            $process_product = true;
        } elseif ((sizeof($row) == 0) && ($_POST['imput_mode'] == "normal" || $_POST['imput_mode'] == "addnew")) {
            $process_product = true;
        } else {
            $process_product = false;
        }

        if ($process_product == true) {
            while ($row) {
                // OK, since we got a row, the item already exists.
                // Let's get all the data we need and fill in all the fields that need to be defaulted
                // to the current values for each language, get the description and set the vals

                // products_name, products_description, products_url
                $sql2 = "SELECT products_name, products_description
                            FROM " . TABLE_PRODUCTS_DESCRIPTION . "
                            WHERE
                                products_id = " . $row['v_products_id'] . "
                                and language_id=" . $leng . "
                            ";
                $result2 = tep_db_query($sql2);
                $row2 = tep_db_fetch_array($result2);
                // Need to report from ......_name_1 not ..._name_0
                $row[EASY_R_NAME] = $row2['products_name'];
                $row[EASY_R_DESC] = $row2['products_description'];
                //       $row['v_products_url_' . $lang['id']]         = $row2['products_url'];
                foreach ($custom_fields[TABLE_PRODUCTS_DESCRIPTION] as $key => $name) {
                    $row['v_' . $key] = $row2[$key];
                }
                // header tags controller support
                if (isset($filelayout['v_products_head_title_tag_' . $lang['id']])) {
                    $row['v_products_head_title_tag_' . $lang['id']] = $row2['products_head_title_tag'];
                    $row['v_products_head_desc_tag_' . $lang['id']] = $row2['products_head_desc_tag'];
                    $row['v_products_head_keywords_tag_' . $lang['id']] = $row2['products_head_keywords_tag'];
                }
                // end: header tags controller support


                // start with v_categories_id
                // Get the category description
                // set the appropriate variable name
                // if parent_id is not null, then follow it up.
                $thecategory_id = $row['v_categories_id'];
                for ($categorylevel = 1; $categorylevel <= (EP_MAX_CATEGORIES + 1); $categorylevel++) {
                    if ($thecategory_id) {
                        $sql3 = "SELECT parent_id,
						                categories_image
							     FROM " . TABLE_CATEGORIES . "
							     WHERE
								        categories_id = " . $thecategory_id . '';
                        $result3 = tep_db_query($sql3);
                        if ($row3 = tep_db_fetch_array($result3)) {
                            $temprow['v_categories_image_' . $categorylevel] = $row3['categories_image'];
                        }

                        $sql2 = "SELECT categories_name
								     FROM " . TABLE_CATEGORIES_DESCRIPTION . "
								     WHERE
                          language_id=" . $leng . "
									        and categories_id = " . $thecategory_id;
                        $result2 = tep_db_query($sql2);
                        if ($row2 = tep_db_fetch_array($result2)) {
                            $temprow['v_categories_name_' . $categorylevel] = $row2['categories_name'];
                        }


                        // now get the parent ID if there was one
                        $theparent_id = $row3['parent_id'];
                        if (!empty($theparent_id)) {
                            // there was a parent ID, lets set thecategoryid to get the next level
                            $thecategory_id = $theparent_id;
                        } else {
                            // we have found the top level category for this item,
                            $thecategory_id = false;
                        }
                    } else {
                        $temprow['v_categories_image_' . $categorylevel] = '';

                        $temprow['v_categories_name_' . $categorylevel] = '';
                    }
                }
                // temprow has the old style low to high level categories.
                $newlevel = 1;
                // let's turn them into high to low level categories
                for ($categorylevel = EP_MAX_CATEGORIES + 1; $categorylevel > 0; $categorylevel--) {
                    $found = false;
                    /* if ($temprow['v_categories_image_' . $categorylevel] != ''){
                        $row['картинка_кат_' . $newlevel] = $temprow['v_categories_image_' . $categorylevel];
                        $found = true;
                    } */

                    if (!empty($temprow['v_categories_name_' . $categorylevel])) {
                        $row[EASY_R_CAT . '_' . $newlevel] = $temprow['v_categories_name_' . $categorylevel];
                        $found = true;
                    }

                    if ($found == true) {
                        $newlevel++;
                    }
                }


                // default the manufacturer
                if (!empty($row['v_manufacturers_id'])) {
                    $raid_manuds = $row['v_manufacturers_id'];
                    $sql2 = "SELECT manufacturers_name
                        FROM " . TABLE_MANUFACTURERS_INFO . "
                        WHERE
                        manufacturers_id = " . $row['v_manufacturers_id'] . " and languages_id = $languages_id";
                    $result2 = tep_db_query($sql2);
                    $row2 = tep_db_fetch_array($result2);
                    $row[EASY_R_MANUF] = $row2['manufacturers_name'];
                }

                if (EP_MVS_SUPPORT == true) {
                    $result2 = tep_db_query("select vendors_name from " . TABLE_VENDORS . " WHERE vendors_id = " . $row['v_vendor_id']);
                    $row2 = tep_db_fetch_array($result2);
                    $row['v_vendor'] = $row2['vendors_name'];
                }

                //elari -
                //We check the value of tax class and title instead of the id
                //Then we add the tax to price if EP_PRICE_WITH_TAX is set to true
                //    $row_tax_multiplier = tep_get_tax_class_rate($row['v_tax_class_id']);
                $row['v_tax_class_title'] = tep_get_tax_class_title($row['v_tax_class_id']);
                if (EP_PRICE_WITH_TAX == true) {
                    $row[EASY_R_PRICE] = $row[EASY_R_PRICE] + round(($row[EASY_R_PRICE] * $row_tax_multiplier / 100), EP_PRECISION);
                }
                // now create the internal variables that will be used
                // the $$thisvar is on purpose: it creates a variable named what ever was in $thisvar and sets the value
                foreach ($default_these as $tkey => $thisvar) {
                    $$thisvar = $row[$thisvar];
                }

                $row = tep_db_fetch_array($result);
            }

            // this is an important loop.  What it does is go thru all the fields in the incoming
            // file and set the internal vars. Internal vars not set here are either set in the
            // loop above for existing records, or not set at all (null values) the array values
            // are handled separatly, although they will set variables in this loop, we won't use them.
            foreach ($filelayout as $key => $value) {
                if (!($key == EASY_R_DATE && empty($items[$value]))) {
                    $$key = $items[$value];
                }
            }

            //elari... we get the tax_clas_id from the tax_title
            //on screen will still be displayed the tax_class_title instead of the id....
            if (isset($v_tax_class_title)) {
                $v_tax_class_id = tep_get_tax_title_class_id($v_tax_class_title);
            }
            //we check the tax rate of this tax_class_id
            //      $row_tax_multiplier = tep_get_tax_class_rate($v_tax_class_id);

            //And we recalculate price without the included tax...
            //Since it seems display is made before, the displayed price will still include tax
            //This is same problem for the tax_clas_id that display tax_class_title
            if (EP_PRICE_WITH_TAX == true) {
                $v_products_price = round($v_products_price / (1 + ($row_tax_multiplier * .01)), EP_PRECISION);
            }

            // if they give us one category, they give us all categories. convert data structure to a multi-dim array
            unset($v_categories_name); // default to not set.
            //unset ($v_categories_image); // default to not set.
            //  foreach ($languages as $key => $lang){
            //    $baselang_id = $lang['id'];
            //    break;
            //  }
            $baselang_id = $leng;


            if (isset($filelayout[EASY_R_CAT . '_1'])) {
                $v_categories_name = array();
                //$v_categories_image = array();
                $newlevel = 1;
                for ($categorylevel = EP_MAX_CATEGORIES; $categorylevel > 0; $categorylevel--) {
                    $found = false;
                    /* if ($items[$filelayout['картинка_кат_' . $categorylevel]] != '') {
                      $v_categories_image[$newlevel] = $items[$filelayout['картинка_кат_' . $categorylevel]];
                      $found = true;
                    } */

                    foreach ($languages as $key => $lang) {
                        if (!empty(trim($items[$filelayout[EASY_R_CAT . '_' . $categorylevel]]))) {
                            $v_categories_name[$newlevel][$lang['id']] = $items[$filelayout[EASY_R_CAT . '_' . $categorylevel]];
                            $found = true;
                        }
                    }

                    if ($found == true) {
                        $newlevel++;
                    }
                }
                while ($newlevel < EP_MAX_CATEGORIES + 1) {
                    //$v_categories_image[$newlevel] = ''; // default the remaining items to nothing
                    foreach ($languages as $key => $lang) {
                        $v_categories_name[$newlevel][$lang['id']] = ''; // default the remaining items to nothing
                    }
                    $newlevel++;
                }
            }

            if (ltrim(rtrim($v_products_quantity)) == '') {
                $v_products_quantity = 1;
            }

            if (empty($v_date_avail)) {
                $v_date_avail = 'NULL';
            } else {
                $v_date_avail = "'" . date("Y-m-d H:i:s", strtotime($v_date_avail)) . "'";
            }

            if (empty($v_date_added)) {
                $v_date_added = "'" . date("Y-m-d H:i:s") . "'";
            } else {
                $v_date_added = "'" . date("Y-m-d H:i:s", strtotime($v_date_added)) . "'";
            }

            // default the stock if they spec'd it or if it's blank
            if (isset($filelayout[EASY_R_STATUS])) {
                if (isset($v_status_current)) {
                    $v_db_status = strval($v_status_current); // default to current value
                } else {
                    $v_db_status = '1'; // default to active
                }

                if (trim($v_status) == EASY_R_STATUS_NOACT) {
                    // they told us to deactivate this item
                    $v_db_status = '0';
                } elseif (trim($v_status) == EASY_R_STATUS_ACT) {
                    $v_db_status = '1';
                }

                if (EP_INACTIVATE_ZERO_QUANTITIES == true && $v_products_quantity == 0) {
                    // if they said that zero qty products should be deactivated, let's deactivate if the qty is zero
                    $v_db_status = '0';
                }
            }

            //if ($v_manufacturer_id == '') {
            //    $v_manufacturer_id = "NULL";
            //}

            //       if (trim($v_products_image)==''){
            //           $v_products_image = EP_DEFAULT_IMAGE_PRODUCT;
            //       }

            if (strlen($v_products_model) > EP_MODEL_NUMBER_SIZE) {
                echo "<font color='red'>" . strlen($v_products_model) . $v_products_model . "... ERROR! - Too many characters in the model number.<br />
                    12 is the maximum on a standard OSC install.<br />
                    Your maximum product_model length is set to " . EP_MODEL_NUMBER_SIZE . ".<br />
                    You can either shorten your model numbers or increase the size of the<br />
                    \"products_model\" field of the \"products\" table in the database.<br />
                    Then change the setting at the top of the easypopulate.php file.</font>";
                die();
            }

            $v_manufacturers_name = $items[$filelayout[EASY_R_MANUF]];
            // OK, we need to convert the manufacturer's name into id's for the database

            if (!empty(($v_manufacturers_name)) {
                $sql = "SELECT man.manufacturers_id
                    FROM " . TABLE_MANUFACTURERS_INFO . " as man
                    WHERE
                        man.manufacturers_name = '" . tep_db_input($v_manufacturers_name) . "'";
                $result = tep_db_query($sql);
                $row = tep_db_fetch_array($result);
                if (!empty($row)) {
                    foreach ($row as $item) {
                        $v_manufacturer_id = $item;
                    }
                } else {
                    // to add, we need to put stuff in categories and categories_description
                   /* $sql = "SELECT MAX(manufacturers_id) max FROM " . TABLE_MANUFACTURERS;
                    $result = tep_db_query($sql);
                    $row = tep_db_fetch_array($result);
                    $max_mfg_id = $row['max'] + 1;
                    // default the id if there are no manufacturers yet
                    if (!is_numeric($max_mfg_id)) {
                        $max_mfg_id = 1;
                    }  */

                    // Comment this query out if you have an older 2.2 codebase
                    $sql = "INSERT INTO " . TABLE_MANUFACTURERS . "(
                        manufacturers_image,
                        date_added,
                        last_modified
                        ) VALUES (
                        '" . EP_DEFAULT_IMAGE_MANUFACTURER . "',
                        '" . date("Y-m-d H:i:s") . "',
                        '" . date("Y-m-d H:i:s") . "'
                        )";
                    $result = tep_db_query($sql);
                    $v_manufacturer_id = tep_db_insert_id();

                    $sql = "INSERT INTO " . TABLE_MANUFACTURERS_INFO . "(
                        manufacturers_id,
                        manufacturers_name,
                        manufacturers_url,
                        languages_id
                        ) VALUES (
                        $v_manufacturer_id,
                        '" . tep_db_input($v_manufacturers_name) . "',
                        '',
                        '" . EP_DEFAULT_LANGUAGE_ID . "'
                        )";
                    $result = tep_db_query($sql);
                }
            } //else $v_manufacturer_id = $raid_manuds;

            // if the categories names are set then try to update them
            //  foreach ($languages as $key => $lang){
            //    $baselang_id = $lang['id'];
            //    break;
            //  }   // lol????? nado tak:
            $baselang_id = $leng;

            if (isset($filelayout[EASY_R_CAT . '_1'])) {
                // start from the highest possible category and work our way down from the parent
                $v_categories_id = 0;
                $theparent_id = 0;
                for ($categorylevel = EP_MAX_CATEGORIES + 1; $categorylevel > 0; $categorylevel--) {
                    //foreach ($languages as $key => $lang){
                    $thiscategoryname = $v_categories_name[$categorylevel][$baselang_id];
                    //   print_r($v_categories_name[$categorylevel]);
                    if (!empty($thiscategoryname)) {
                        // we found a category name in this field, look for database entry
                        $sql = "SELECT cat.categories_id
                            FROM " . TABLE_CATEGORIES . " as cat,
                                 " . TABLE_CATEGORIES_DESCRIPTION . " as des
                            WHERE
                                cat.categories_id = des.categories_id AND
                                des.language_id = " . $baselang_id . " AND
                                cat.parent_id = " . $theparent_id . " AND
                                des.categories_name like '" . trim(tep_db_input($thiscategoryname)) . "'";
                        $result = tep_db_query($sql);
                        $row = tep_db_fetch_array($result);

                        if (!empty($row['categories_id'])) {
                            // we have an existing category, update image and date
                            //  foreach( $row as $item ){
                            //                    $thiscategoryid = $item;
                            //                }
                            $thiscategoryid = $row['categories_id'];
                            /* $cat_image = '';
                            if (!empty($v_categories_image[$categorylevel])) {
                               $cat_image = "categories_image='".tep_db_input($v_categories_image[$categorylevel])."', ";
                            } elseif (isset($filelayout['картинка_кат_' . $categorylevel])) {
                               $cat_image = "categories_image='', ";
                            }  */
                            /* $query = "UPDATE ".TABLE_CATEGORIES."
                                      SET
                                        $cat_image
                                        last_modified = '".date("Y-m-d H:i:s")."'
                                      WHERE
                                        categories_id = '".$row['categories_id']."'
                                      LIMIT 1"; */
                            $query = "UPDATE " . TABLE_CATEGORIES . "
                                      SET
                                        last_modified = '" . date("Y-m-d H:i:s") . "'
                                      WHERE
                                        categories_id = '" . $row['categories_id'] . "'
                                      LIMIT 1";

                            tep_db_query($query);
                        } else {
                            // to add, we need to put stuff in categories and categories_description
                            $sql = "SELECT MAX( categories_id) max FROM " . TABLE_CATEGORIES;
                            $result = tep_db_query($sql);
                            $row = tep_db_fetch_array($result);
                            $max_category_id = $row['max'] + 1;
                            if (!is_numeric($max_category_id)) {
                                $max_category_id = 1;
                            }
                            /* $sql = "INSERT INTO ".TABLE_CATEGORIES." (
                                        categories_id,
                                        parent_id,
                                        categories_image,
                                        sort_order,
                                        date_added,
                                        last_modified
                                   ) VALUES (
                                        $max_category_id,
                                        $theparent_id,
                                        '".tep_db_input($v_categories_image[$categorylevel])."',
                                        0,
                                        '".date("Y-m-d H:i:s")."',
                                        '".date("Y-m-d H:i:s")."'
                                   )"; */
                            $sql = "INSERT INTO " . TABLE_CATEGORIES . " (
                                        categories_id,
                                        parent_id,
                                        sort_order,
                                        date_added,
                                        last_modified
                                   ) VALUES (
                                        $max_category_id,
                                        $theparent_id,
                                        0,
                                        '" . date("Y-m-d H:i:s") . "',
                                        '" . date("Y-m-d H:i:s") . "'
                                   )";
                            $result = tep_db_query($sql);

                            foreach ($languages as $key => $lang) {
                                $sql = "INSERT INTO " . TABLE_CATEGORIES_DESCRIPTION . " (
                                                categories_id,
                                                language_id,
                                                categories_name
                                       ) VALUES (
                                                $max_category_id,
                                                '" . $lang['id'] . "',
                                                '" . (!empty($v_categories_name[$categorylevel][$lang['id']]) ? trim(tep_db_input(tep_db_prepare_input($v_categories_name[$categorylevel][$lang['id']]))) : '') . "'
                                       )";
                                tep_db_query($sql);
                            }

                            $thiscategoryid = $max_category_id;
                        }
                        // the current catid is the next level's parent
                        $theparent_id = $thiscategoryid;
                        $v_categories_id = $thiscategoryid; // keep setting this, we need the lowest level category ID later
                    }
                    // }
                }
            }


            if (!empty($v_products_model)) {
                //   products_model exists!
                foreach ($items as $tkey => $item) {
                    print_el($item);
                }

                // find the vendor id from the name imported
                if (EP_MVS_SUPPORT == true) {
                    $vend_result = tep_db_query("SELECT vendors_id FROM " . TABLE_VENDORS . " WHERE vendors_name = '" . $v_vendor . "'");
                    $vend_row = tep_db_fetch_array($vend_result);
                    $v_vendor_id = $vend_row['vendors_id'];
                }


                // process the PRODUCTS table
             //   if (isset($v_products_price)) {
                if (isset($filelayout[EASY_R_PRICE])) {
                    $v_products_price = tep_db_input($items[$filelayout[EASY_R_PRICE]], DB());
                    $v_products_price = str_replace(',', '.', $v_products_price);

                  // price 2,3,4
                    $prices_num = tep_xppp_getpricesnum();
                    $prices_fields = '';
                    $prices_vals = '';
                    $prices_update = "products_price = '" . $v_products_price . "',";
                    for ($i = 2; $i <= $prices_num; $i++) {
                        $v_products_price_arr[] = tep_db_input($items[$filelayout[EASY_R_PRICE . '_' . $i]], DB());
                        $prices_fields .= 'products_price_' . $i . ',';
                        $prices_vals .= "'" . tep_db_input($items[$filelayout[EASY_R_PRICE . '_' . $i]], DB()) . "',";
                        $prices_update .= "products_price_" . $i . "='" . tep_db_input($items[$filelayout[EASY_R_PRICE . '_' . $i]], DB()) . "',";
                    }
                }


              //  if (isset($v_products_quantity)) {
                if (isset($filelayout[EASY_R_QTY])) {
                    $v_products_quantity = $items[$filelayout[EASY_R_QTY]];
                    if ($v_products_quantity == '') {
                        $v_products_quantity = 1;
                    }
                    $tmp_products_quantity = "products_quantity = $v_products_quantity,";
                }
                //      $v_products_quantity_order_min = $items[$filelayout['минимум']];
                $v_products_quantity_order_min = 1;
                //      $v_products_quantity_order_units = $items[$filelayout['шаг']];
                //      $v_products_model_2 = $items[$filelayout['ед_изм']];
                //      $v_products_icon = $items[$filelayout['хит']];
                $v_products_specials_price = $items[$filelayout[EASY_R_DISC]];
                //      if($items[$filelayout['скидка']]!='') $v_products_icon_rasp = 'rasp';


                $result = tep_db_query("SELECT products_id FROM " . TABLE_PRODUCTS . " WHERE (products_model = '" . $v_products_model . "')");


                // First we check to see if this is a product in the current db.
                if (tep_db_num_rows($result) == 0) {
                    //   insert into products
                    echo "<font color='green'> !New Product!</font><br />";

                    // /////////////////////////////////////////////////////////////////////
                    //
                    // Start: Support for other contributions
                    //
                    // /////////////////////////////////////////////////////////////////////
                    $ep_additional_fields = '';
                    $ep_additional_data = '';

                    foreach ($custom_fields[TABLE_PRODUCTS] as $key => $name) {
                        $ep_additional_fields .= $key . ',';
                    }

                    foreach ($custom_fields[TABLE_PRODUCTS] as $key => $name) {
                        $tmp_var = 'v_' . $key;
                        $ep_additional_data .= "'" . $$tmp_var . "',";
                    }

                    if (EP_PDF_UPLOAD_SUPPORT == true) {
                        $ep_additional_fields .= 'products_pdfupload,products_fileupload,';
                        $ep_additional_data .= "'$v_products_pdfupload','$v_products_fileupload',";
                    }

                    if (EP_MVS_SUPPORT == true) {
                        $ep_additional_fields .= 'vendors_id,';
                        $ep_additional_data .= "'$v_vendor_id',";
                    }

                    // /////////////////////////////////////////////////////////////////////
                    // End: Support for other contributions
                    // /////////////////////////////////////////////////////////////////////

                    if (isset($v_products_image)) {
                        // Check the availability of links

                        $products_check = array();
                        $products_check = explode(';', trim(preg_replace('/\s+/', '', $v_products_image)));
                        $v_products_image = '';

                        $count = count($products_check);
                        foreach ($products_check as $product_check) {
                            if (mb_strpos($product_check, 'http://') !== false || mb_strpos($product_check, 'https://') !== false) {
                                $product_check = trim($product_check);

                                $url = $product_check;
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, $url);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                $data_image = curl_exec($ch);

                                parse_str(parse_url($product_check, PHP_URL_QUERY), $image_content);

                              //  $imagesize = getimagesize($product_check);
//                                $imagesize = getimagesize($data_image);
//                                if ($imagesize["mime"] == 'image/gif') {
//                                    $end = ".gif";
//                                } elseif ($imagesize["mime"] == 'image/png') {
//                                    $end = ".png";
//                                } elseif ($imagesize["mime"] == 'image/jpeg') {
//                                    $end = ".jpg";
//                                }
                                $filename_arr = explode('/', $product_check);
                                $filename = end($filename_arr);
                                if (!file_exists('../' . DIR_WS_IMAGES . 'products/')) {
                                    mkdir('../' . DIR_WS_IMAGES . 'products/');
                                }
                                $path = '../' . DIR_WS_IMAGES . 'products/' . $filename;
                                //file_put_contents($path, file_get_contents($product_check));
                                file_put_contents($path, $data_image);
                                $product_check = $filename;
                            }
                            $count--;
                            if ($count) {
                                $v_products_image .= $product_check . ';';
                            } else {
                                $v_products_image .= $product_check;
                            }
                        }
                    }


                    $query = "INSERT INTO " . TABLE_PRODUCTS . " (
                                products_image,
                                $ep_additional_fields
                                products_model,
                                products_price,
                                $prices_fields
                                products_quantity_order_min,
                                products_quantity_order_units,
                                products_status,
                                products_last_modified,
                                products_date_added,
                                products_date_available,
                                products_tax_class_id,
                                products_quantity,
                                manufacturers_id )
                              VALUES (
                                " . (!empty($v_products_image) ? "'" . addslashes(tep_db_prepare_input($v_products_image)) . "'" : "''") . ",
                                $ep_additional_data
                                '$v_products_model',
                                '$v_products_price',
                                $prices_vals
                                '$v_products_quantity_order_min',
                                '$v_products_quantity_order_units',
                                '$v_db_status',
                                '" . date("Y-m-d H:i:s") . "',
                                " . $v_date_added . ",
                                " . $v_date_avail . ",
                                '$v_tax_class_id',
                                '$v_products_quantity',
                                " . (!empty($v_manufacturer_id) ? $v_manufacturer_id : 'NULL') . ")
                                ";
                    $result = tep_db_query($query);

                    $v_products_id = tep_db_insert_id();
                } else {
                    // existing product(s), get the id from the query
                    // and update the product data
                    while ($row = tep_db_fetch_array($result)) {
                        $v_products_id = $row['products_id'];
                        echo "<font color='black'> Updated</font><br />";

                        // /////////////////////////////////////////////////////////////////////
                        //
                        // Start: Support for other contributions
                        //
                        // /////////////////////////////////////////////////////////////////////
                        $ep_additional_updates = '';

                        foreach ($custom_fields[TABLE_PRODUCTS] as $key => $name) {
                            $tmp_var = 'v_' . $key;
                            $ep_additional_updates .= $key . "='" . $$tmp_var . "',";
                        }

                        if (EP_PDF_UPLOAD_SUPPORT == true) {
                            $ep_additional_updates .= "products_pdfupload='$v_products_pdfupload',products_fileupload='$v_products_fileupload',";
                        }

                        if (EP_MVS_SUPPORT == true) {
                            $ep_additional_updates .= "vendors_id='$v_vendor_id',";
                        }

                        // /////////////////////////////////////////////////////////////////////
                        // End: Support for other contributions
                        // /////////////////////////////////////////////////////////////////////
                        // only include the products image if it has been included in the spreadsheet
                        $v_products_image = $items[$filelayout[EASY_R_IMAGES]];

                        $tmp_products_image_update = '';
                        if (isset($v_products_image)) {
                            // Check the availability of links

                            $products_check = array();
                            $products_check = explode(';', $v_products_image);
                            $v_products_image = '';
                            $count = count($products_check);
                            foreach ($products_check as $product_check) {
                                $product_check = trim($product_check);
                                if (mb_strpos($product_check, 'http://') !== false || mb_strpos($product_check, 'https://') !== false) {
                                    $url = $product_check;
                                    $ch = curl_init();
                                    curl_setopt($ch, CURLOPT_URL, $url);
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                    $data_image = curl_exec($ch);

                                    parse_str(parse_url($product_check, PHP_URL_QUERY), $image_content);

                                   // $imagesize = getimagesize($product_check);
//                                    $imagesize = getimagesize($data_image);
//                                    if ($imagesize["mime"] == 'image/gif') {
//                                        $end = ".gif";
//                                    } elseif ($imagesize["mime"] == 'image/png') {
//                                        $end = ".png";
//                                    } elseif ($imagesize["mime"] == 'image/jpeg') {
//                                        $end = ".jpg";
//                                    }
                                    $filename_arr = explode('/', $product_check);
                                    $filename = end($filename_arr);
                                    if (!file_exists('../' . DIR_WS_IMAGES . 'products/')) {
                                        mkdir('../' . DIR_WS_IMAGES . 'products/');
                                    }
                                    $path = '../' . DIR_WS_IMAGES . 'products/' . $filename;
                                    //file_put_contents($path, file_get_contents($product_check));
                                    file_put_contents($path, $data_image);
                                    $product_check = $filename;
                                }
                                $count--;
                                if ($count) {
                                    $v_products_image .= $product_check . ';';
                                } else {
                                    $v_products_image .= $product_check;
                                }
                            }
                            $tmp_products_image_update = "products_image=" . (!empty($v_products_image) ? "'" . $v_products_image . "'" : 'NULL') . ",";
                        }
                        //if (isset($v_products_quantity_order_min)) {
                        //    $tmp_products_quantity_order_min = "products_quantity_order_min='" . $v_products_quantity_order_min . "',
                                            //";
                        //}
                        if (isset($v_products_quantity_order_units)) {
                            $tmp_products_quantity_order_units = "products_quantity_order_units='" . $v_products_quantity_order_units . "',";
                        }

                        //if (isset($v_status_current)) {
                        if (isset($v_db_status)) {
                            $tmp_status = "products_status = $v_db_status,";
                        }
                        if (isset($v_manufacturer_id)) {
                            $tmp_manufacturers_id = "manufacturers_id='" . $v_manufacturer_id . "',";
                        }

                        $query = "UPDATE " . TABLE_PRODUCTS . "
                              SET
                                $prices_update
                                $tmp_products_quantity_order_units
                                $tmp_products_image_update
                                $tmp_manufacturers_id
                                $ep_additional_updates
                                $tmp_status
                                $tmp_products_quantity
                                products_id = $v_products_id
                              WHERE
                                (products_id = $v_products_id)
                              LIMIT 1";

/*
                        $query = "UPDATE " . TABLE_PRODUCTS . "
                              SET
                                products_price='$v_products_price',
                                $tmp_products_quantity_order_min
                                $tmp_products_quantity_order_units
                                $tmp_products_image_update
                                $tmp_products_image_med_update
                                $tmp_manufacturers_id
                                $ep_additional_updates
                                products_weight='$v_products_weight',
                                products_tax_class_id='$v_tax_class_id',
                                products_date_available=" . $v_date_avail . ",
                                products_date_added=" . $v_date_added . ",
                                products_last_modified='" . date("Y-m-d H:i:s") . "',
                                products_quantity = $v_products_quantity,
                                products_status = $v_db_status
                              WHERE
                                (products_id = $v_products_id)
                              LIMIT 1"; */

                        tep_db_query($query);
                    }
                }

                if (isset($v_products_specials_price)) {
                    if (EP_SPPC_SUPPORT == true) {
                        $SPPC_extra_query = ' and customers_group_id = 0';
                    } else {
                        $SPPC_extra_query = '';
                    }
                    $result = tep_db_query('select * from ' . TABLE_SPECIALS . ' WHERE products_id = ' . $v_products_id . $SPPC_extra_query);

                    if ($v_products_specials_price == '') {
                        $result = tep_db_query('DELETE FROM ' . TABLE_SPECIALS . ' WHERE products_id = ' . $v_products_id . $SPPC_extra_query);
                        if (EP_SPPC_SUPPORT == true) {
                            $result = tep_db_query('DELETE FROM specials_retail_prices WHERE products_id = ' . $v_products_id);
                        }
                    } else {
                        if ($specials = tep_db_fetch_array($result)) {
                            $sql_data_array = array('products_id' => $v_products_id,
                                'specials_new_products_price' => $v_products_specials_price,
                                'specials_last_modified' => 'now()'
                            );
                            tep_db_perform(TABLE_SPECIALS, $sql_data_array, 'update', 'specials_id = ' . $specials['specials_id']);

                            if (EP_SPPC_SUPPORT == true) {
                                $sql_data_array = array('products_id' => $v_products_id,
                                    'specials_new_products_price' => $v_products_specials_price
                                );
                                tep_db_perform('specials_retail_prices', $sql_data_array, 'update', 'products_id = ' . $v_products_id);
                            }
                        } else {
                            $sql_data_array = array('products_id' => $v_products_id,
                                'specials_new_products_price' => $v_products_specials_price,
                                'specials_date_added' => 'now()',
                                'status' => '1'
                            );
                            if (EP_SPPC_SUPPORT == true) {
                                $sql_data_array = array_merge($sql_data_array, array('customers_group_id' => '0'));
                            }
                            tep_db_perform(TABLE_SPECIALS, $sql_data_array, 'insert');

                            if (EP_SPPC_SUPPORT == true) {
                                $sql_data_array = array('products_id' => $v_products_id,
                                    'specials_new_products_price' => $v_products_specials_price,
                                    'status' => '1',
                                    'customers_group_id' => '0'
                                );
                                tep_db_perform('specials_retail_prices', $sql_data_array, 'insert');
                            }
                        }
                    }
                }

                // process the PRODUCTS_DESCRIPTION table

                //       echo 'lol: '.$baselang_id;
                $doit = false;
                foreach ($custom_fields[TABLE_PRODUCTS_DESCRIPTION] as $key => $name) {
                    if (isset($filelayout['v_' . $key])) {
                        $doit = true;
                    }
                }

                if (isset($filelayout[EASY_R_NAME]) || isset($filelayout[EASY_R_DESC]) || $doit == true) {
                    // if product exists
                    $check_product_exist = tep_db_query("SELECT * FROM " . TABLE_PRODUCTS . " WHERE products_id = $v_products_id ");

                    // if product exists for current language
                    $result = tep_db_query("SELECT * FROM " . TABLE_PRODUCTS_DESCRIPTION . " WHERE products_id = $v_products_id AND language_id = " . $baselang_id);

                    $products_var = EASY_R_NAME;
                    $description_var = EASY_R_DESC;
                    $url_var = 'v_products_url_' . $baselang_id;

                    // /////////////////////////////////////////////////////////////////////
                    //
                    // Start: Support for other contributions
                    //
                    // /////////////////////////////////////////////////////////////////////
                    $ep_additional_updates = '';
                    $ep_additional_fields = '';
                    $ep_additional_data = '';

                    foreach ($custom_fields[TABLE_PRODUCTS_DESCRIPTION] as $key => $name) {
                        $tmp_var = 'v_' . $key;
                        $ep_additional_updates .= $key . " = '" . tep_db_input($$tmp_var) . "',";
                        $ep_additional_fields .= $key . ",";
                        $ep_additional_data .= "'" . tep_db_input($$tmp_var) . "',";
                    }

                    // header tags controller support
                    if (isset($filelayout['v_products_head_title_tag_' . $baselang_id])) {
                        $head_title_tag_var = 'v_products_head_title_tag_' . $baselang_id;
                        $head_desc_tag_var = 'v_products_head_desc_tag_' . $baselang_id;
                        $head_keywords_tag_var = 'v_products_head_keywords_tag_' . $baselang_id;

                        $ep_additional_updates .= "products_head_title_tag = '" . tep_db_input($$head_title_tag_var) . "', products_head_desc_tag = '" . tep_db_input($$head_desc_tag_var) . "', products_head_keywords_tag = '" . tep_db_input($$head_keywords_tag_var) . "',";
                        $ep_additional_fields .= "products_head_title_tag,products_head_desc_tag,products_head_keywords_tag,";
                        $ep_additional_data .= "'" . tep_db_input($$head_title_tag_var) . "','" . tep_db_input($$head_desc_tag_var) . "','" . tep_db_input($$head_keywords_tag_var) . "',";
                    }
                    // end: header tags controller support

                    // /////////////////////////////////////////////////////////////////////
                    // End: Support for other contributions
                    // /////////////////////////////////////////////////////////////////////


                    // existing product for current language? let's just update it
                    if (tep_db_num_rows($result) > 0) {
                        $sql = "UPDATE " . TABLE_PRODUCTS_DESCRIPTION . "
                                   SET products_name='" . addslashes(tep_db_prepare_input($$products_var)) . "',
                                       $ep_additional_updates
  																		 products_description='" . addslashes(tep_db_prepare_input($$description_var)) . "' WHERE
                                       products_id = '$v_products_id' AND
                                       language_id = '" . $baselang_id . "'
                                 LIMIT 1";
                        $result = tep_db_query($sql);
                    } elseif (tep_db_num_rows($check_product_exist) > 0) {
                    // if product exist for some language but not exist fur current language:
                        $sql = "INSERT INTO " . TABLE_PRODUCTS_DESCRIPTION . "
              							 	 (products_id,
              								  language_id,
              								  products_name,
              								  $ep_additional_fields
              								  products_description)
              								VALUES ('" . $v_products_id . "',
              									       " . $baselang_id . ",
              									      '" . addslashes(tep_db_prepare_input($$products_var)) . "',
              									           $ep_additional_data
              								      	'" . addslashes(tep_db_prepare_input($$description_var)) . "')";
                        $result = tep_db_query($sql);
                    } else {
                    // this is a new product:
                        foreach ($languages as $key => $lang) {
                            $sql = "INSERT INTO " . TABLE_PRODUCTS_DESCRIPTION . "
                  								 (products_id,
                  								  language_id,
                  								  products_name,
                  								  $ep_additional_fields
                  								  products_description)
                  								VALUES ('" . $v_products_id . "',
                        									 " . $lang['id'] . ",
                        									'" . tep_db_input(tep_db_prepare_input($$products_var)) . "',
                        									     $ep_additional_data
                        									'" . tep_db_input(tep_db_prepare_input($$description_var)) . "')";
                            $result = tep_db_query($sql);
                        }
                    }
                }

                if (isset($v_categories_id)) {
                    //find out if this product is listed in the category given
                    $result_incategory = tep_db_query('SELECT
                                ' . TABLE_PRODUCTS_TO_CATEGORIES . '.products_id,
                                ' . TABLE_PRODUCTS_TO_CATEGORIES . '.categories_id
                                FROM
                                    ' . TABLE_PRODUCTS_TO_CATEGORIES . '
                                WHERE
                                ' . TABLE_PRODUCTS_TO_CATEGORIES . '.products_id=' . $v_products_id . ' AND
                                ' . TABLE_PRODUCTS_TO_CATEGORIES . '.categories_id=' . $v_categories_id);

                    if (tep_db_num_rows($result_incategory) == 0) {
                        // nope, this is a new category for this product
                        $res1 = tep_db_query('INSERT INTO ' . TABLE_PRODUCTS_TO_CATEGORIES . ' (products_id, categories_id)
                                              VALUES ("' . $v_products_id . '", "' . $v_categories_id . '")');
                    } else {
                        // already in this category, nothing to do!
                    }
                }

                // this is for the cross sell contribution
                if (isset($v_cross_sell)) {
                    tep_db_query("delete from " . TABLE_PRODUCTS_XSELL . " where products_id = " . $v_products_id . " or xsell_id = " . $v_products_id . "");
                    if (!empty($v_cross_sell)) {
                        $xsells_array = explode(',', $v_cross_sell);
                        foreach ($xsells_array as $xs_key => $xs_model) {
                            $cross_sell_sql = "select products_id from " . TABLE_PRODUCTS . " where products_model = '" . trim($xs_model) . "' limit 1";
                            $cross_sell_result = tep_db_query($cross_sell_sql);
                            $cross_sell_row = tep_db_fetch_array($cross_sell_result);

                            tep_db_query("insert into " . TABLE_PRODUCTS_XSELL . " (products_id, xsell_id, sort_order)
                                      values ( " . $v_products_id . ", " . $cross_sell_row['products_id'] . ", 1)");
                            tep_db_query("insert into " . TABLE_PRODUCTS_XSELL . " (products_id, xsell_id, sort_order)
								  values ( " . $cross_sell_row['products_id'] . ", " . $v_products_id . ", 1)");
                        }
                    }
                }

                // for the separate prices per customer (SPPC) module
                $ll = 1;
                if (isset($v_customer_price_1)) {
                    if (empty($v_customer_group_id_1) and !empty($v_customer_price_1)) {
                        echo "<font color=red>ERROR - v_customer_group_id and v_customer_price must occur in pairs</font>";
                        die();
                    }
                    // they spec'd some prices, so clear all existing entries
                    $result = tep_db_query('
                                DELETE
                                FROM
                                    ' . TABLE_PRODUCTS_GROUPS . '
                                WHERE
                                    products_id = ' . $v_products_id);
                    // and insert the new record
                    if (!empty($v_customer_price_1)) {
                        $result = tep_db_query('
                                    INSERT INTO
                                        ' . TABLE_PRODUCTS_GROUPS . '
                                    VALUES
                                    (
                                        ' . $v_customer_group_id_1 . ',
                                        ' . $v_customer_price_1 . ',
                                        ' . $v_products_id . '
                                        )');
                    }
                    if (!empty($v_customer_price_2)) {
                        $result = tep_db_query('
                                    INSERT INTO
                                        ' . TABLE_PRODUCTS_GROUPS . '
                                    VALUES
                                    (
                                        ' . $v_customer_group_id_2 . ',
                                        ' . $v_customer_price_2 . ',
                                        ' . $v_products_id . '
                                        )');
                    }
                    if (!empty($v_customer_price_3)) {
                        $result = tep_db_query('
                                    INSERT INTO
                                        ' . TABLE_PRODUCTS_GROUPS . '
                                    VALUES
                                    (
                                        ' . $v_customer_group_id_3 . ',
                                        ' . $v_customer_price_3 . ',
                                        ' . $v_products_id . '
                                        )');
                    }
                    if (!empty($v_customer_price_4)) {
                        $result = tep_db_query('
                                    INSERT INTO
                                        ' . TABLE_PRODUCTS_GROUPS . '
                                    VALUES
                                    (
                                        ' . $v_customer_group_id_4 . ',
                                        ' . $v_customer_price_4 . ',
                                        ' . $v_products_id . '
                                        )');
                    }

                    if (isset($v_customer_specials_price_1)) {
                        $result = tep_db_query('select * from ' . TABLE_SPECIALS . ' WHERE products_id = ' . $v_products_id . ' and customers_group_id = 1');

                        if ($v_customer_specials_price_1 == '') {
                            $result = tep_db_query('DELETE FROM ' . TABLE_SPECIALS . ' WHERE products_id = ' . $v_products_id . ' and customers_group_id = 1');
                        } else {
                            if ($specials = tep_db_fetch_array($result)) {
                                $sql_data_array = array('products_id' => $v_products_id,
                                    'specials_new_products_price' => $v_customer_specials_price_1,
                                    'specials_last_modified' => 'now()'
                                );
                                tep_db_perform(TABLE_SPECIALS, $sql_data_array, 'update', 'specials_id = ' . $specials['specials_id']);
                            } else {
                                $sql_data_array = array('products_id' => $v_products_id,
                                    'specials_new_products_price' => $v_customer_specials_price_1,
                                    'specials_date_added' => 'now()',
                                    'status' => '1',
                                    'customers_group_id' => '1'
                                );
                                tep_db_perform(TABLE_SPECIALS, $sql_data_array, 'insert');
                            }
                        }
                    }
                }
                // end: separate prices per customer (SPPC) module

                $attribute_options_query7 = "select distinct products_options_id, products_options_name from " . TABLE_PRODUCTS_OPTIONS . " order by products_options_id";
                $attribute_options_values7 = tep_db_query($attribute_options_query7);

                while ($attribute_options7 = tep_db_fetch_array($attribute_options_values7)) {
                    $attribute_options_array7[] = array('products_options_id' => $attribute_options7['products_options_id'], 'products_options_name' => $attribute_options7['products_options_name']);
                }

                if (tep_db_num_rows($attribute_options_values7) > 0) {
                    //Удаление атрибутов а продакт атрибутс

                    $attrs_delete_array = [];
                    foreach ($attribute_options_array7 as $attribute_options) {
                        if (isset($filelayout[$attribute_options['products_options_name']])) {
                            $attrs_delete_array[] = $attribute_options['products_options_id'];
                        }
                    }

                    if (count($attrs_delete_array) > 0) {
                        $attribute_values_delete_query = 'delete from ' . TABLE_PRODUCTS_ATTRIBUTES . ' where products_id=' . (int)$v_products_id . ' and options_id in (' . implode(",", $attrs_delete_array) . ')';
                        $attribute_values_delete = tep_db_query($attribute_values_delete_query);
                    }

                    foreach ($attribute_options_array7 as $attribute_options) {
                        if (isset($filelayout[$attribute_options['products_options_name']])) {
                            if (!empty($items[$filelayout[$attribute_options['products_options_name']]])) {
                                if ($checkArttributes) {
                                    $pieces = explode("||", $items[$filelayout[$attribute_options['products_options_name']]]);
                                    //$pieces = array_reverse($pieces);
                                    $InputQuantityAttr = count($pieces);

                                    for ($i = 0; $i < $InputQuantityAttr; $i++) {
                                        $tmpAttr[$i] = explode(":", $pieces[$i]);
                                    }

                                    for ($i = 0; $i < $InputQuantityAttr; $i++) {
                                        $attribute_values_query = tep_db_query('select pov.products_options_values_id from products_options_values pov, products_options_values_to_products_options pov2po where  pov.products_options_values_name="' . tep_db_input($tmpAttr[$i][0], DB()) . '" and pov2po.products_options_id="' . $attribute_options['products_options_id'] . '" and pov2po.products_options_values_id=pov.products_options_values_id');
                                        $attribute_values_id = tep_db_fetch_array($attribute_values_query);

                                        if (tep_db_num_rows($attribute_values_query) <= 0) {
                                            $id_query = tep_db_query("select MAX(products_options_values_id) as max from " . TABLE_PRODUCTS_OPTIONS_VALUES);
                                            $id = tep_db_fetch_array($id_query);
                                            $id['max']++;

                                            $attribute_values_new_query = "insert into " . TABLE_PRODUCTS_OPTIONS_VALUES . " (products_options_values_id,language_id, products_options_values_name) values (" . $id['max'] . ", " . $leng . ", '" . tep_db_input($tmpAttr[$i][0], DB()) . "')";
                                            $attribute_values_new = tep_db_query($attribute_values_new_query);


                                            $attribute_values_2op_new_query = "insert into " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " (products_options_id, products_options_values_id) values ('" . $attribute_options['products_options_id'] . "', '" . $id['max'] . "')";

                                            $attribute_values_2op_new = tep_db_query($attribute_values_2op_new_query);
                                        } else {
                                            $id['max'] = $attribute_values_id['products_options_values_id'];
                                        }

                                        $attribute_values_pov2po_query = "insert into " . TABLE_PRODUCTS_ATTRIBUTES . " (products_id, options_id, options_values_id, options_values_price, price_prefix, products_options_sort_order, pa_imgs, pa_qty) values ('" . $v_products_id . "', '" . $attribute_options['products_options_id'] . "', '" . $id['max'] . "', '" . $tmpAttr[$i][1] . "', '" . $tmpAttr[$i][2] . "', '" . $tmpAttr[$i][3] . "', '" . $tmpAttr[$i][4] . "', '" . $tmpAttr[$i][5] . "')";

                                        $attribute_values_pov2po = tep_db_query($attribute_values_pov2po_query);
                                    }
                                } else {
                                    $pieces = explode("||", $items[$filelayout[$attribute_options['products_options_name']]]);
                                    $pieces = array_reverse($pieces);
                                    $InputQuantityAttr = count($pieces);

                                    for ($i = 0; $i < $InputQuantityAttr; $i++) {
                                        $attribute_values_query = tep_db_query('select pov.products_options_values_id from products_options_values pov, products_options_values_to_products_options pov2po where  pov.products_options_values_name="' . tep_db_input($pieces[$i]) . '" and pov2po.products_options_id="' . $attribute_options['products_options_id'] . '" and pov2po.products_options_values_id=pov.products_options_values_id');
                                        $attribute_values_id = tep_db_fetch_array($attribute_values_query);

                                        if (tep_db_num_rows($attribute_values_query) <= 0) {
                                            $id_query = tep_db_query("select MAX(products_options_values_id) as max from " . TABLE_PRODUCTS_OPTIONS_VALUES);
                                            $id = tep_db_fetch_array($id_query);
                                            $id['max']++;

                                            $attribute_values_new_query = "insert into " . TABLE_PRODUCTS_OPTIONS_VALUES . " (products_options_values_id,language_id, products_options_values_name) values (" . $id['max'] . ", " . $leng . ", '" . tep_db_input($pieces[$i], DB()) . "')";
                                            $attribute_values_new = tep_db_query($attribute_values_new_query);


                                            $attribute_values_2op_new_query = "insert into " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " (products_options_id, products_options_values_id) values ('" . $attribute_options['products_options_id'] . "', '" . $id['max'] . "')";

                                            $attribute_values_2op_new = tep_db_query($attribute_values_2op_new_query);
                                        } else {
                                            $id['max'] = $attribute_values_id['products_options_values_id'];
                                        }

                                        $attribute_values_pov2po_query = "insert into " . TABLE_PRODUCTS_ATTRIBUTES . " (products_id, options_id, options_values_id) values ('" . $v_products_id . "', '" . $attribute_options['products_options_id'] . "', '" . $id['max'] . "')";

                                        $attribute_values_pov2po = tep_db_query($attribute_values_pov2po_query);
                                    }
                                }
                            }
                        }
                    }
                }
            } else {
                // this record was missing the product_model
                echo "<p class=smallText>No products_model field in record. This line was not imported: ";

                foreach ($items as $tkey => $item) {
                    print_el($item);
                }
                echo "<br /><br /></p>";
            }
            // end of row insertion code
        }
    }
    // end (EP for product extra fields Contrib by minhmt DEVSOFTVN) ============
}

?>
