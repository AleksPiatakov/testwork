<?php

//require('includes/application_top.php');

$manufacturer = $_GET['manufacturer'];
$row_by_page = $_GET['row_by_page'];
$search_pd_name = isset($_GET['search_pd_name']) && !empty($_GET['search_pd_name']) ? tep_db_prepare_input($_GET['search_pd_name']) : false;
$search_model = isset($_GET['search_model']) && !empty($_GET['search_model']) ? tep_db_prepare_input($_GET['search_model']) : false;

($row_by_page) ? define('MAX_DISPLAY_ROW_BY_PAGE', $row_by_page) : $row_by_page = MAX_DISPLAY_SEARCH_RESULTS;
define('MAX_DISPLAY_ROW_BY_PAGE', MAX_DISPLAY_SEARCH_RESULTS);

//// Tax Row
$tax_class_array = array(
    array(
        'id' => '0',
        'text' => NO_TAX_TEXT));
$tax_class_query = tep_db_query("select tax_class_id, tax_class_title from " . TABLE_TAX_CLASS . " order by tax_class_title");
while ($tax_class = tep_db_fetch_array($tax_class_query)) {
    $tax_class_array[] = array(
        'id' => $tax_class['tax_class_id'],
        'text' => $tax_class['tax_class_title']);
}

////Info Row pour le champ fabriquant
$manufacturers_array = array(
    array(
        'id' => '0',
        'text' => NO_MANUFACTURER));
$manufacturers_query = tep_db_query("select manufacturers_id, manufacturers_name from " . TABLE_MANUFACTURERS_INFO . " WHERE languages_id =$languages_id order by manufacturers_name ");
while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
    $manufacturers_array[] = array(
        'id' => $manufacturers['manufacturers_id'],
        'text' => $manufacturers['manufacturers_name']);
}
function change_price($sum, $param_)
{
    $param = strtolower(trim($param_));
    $is_percent = strpos($param, "%");
    $is_added = strpos($param, "-");
    $param = str_replace(['-','%'], ["",""], $param);
    if (!is_numeric($param)) {
        return $param_;
    }
    if ($is_percent !== false) {
        $diff = $param * $sum / 100;
    } else {
        $diff = $param;
    }
    if ($is_added !== false) {
        $diff = -$diff;
    }
    $return = $sum + $diff;
    return $return;
}
// Display the list of the manufacturers
function manufacturers_list()
{
    global $manufacturer, $languages_id;

    $manufacturers_query = tep_db_query("select mi.manufacturers_id, mi.manufacturers_name from " . TABLE_MANUFACTURERS_INFO . " mi where mi.languages_id = " . (int)$languages_id . " order by mi.manufacturers_name ASC");
    $return_string = '<select name="manufacturer" onChange="this.form.submit();" class="ajaxSelect form-control">';
    $return_string .= '<option value="' . 0 . '">' . TEXT_ALL_MANUFACTURERS . '</option>';
    while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
        $return_string .= '<option value="' . $manufacturers['manufacturers_id'] . '"';
        if ($manufacturer && $manufacturers['manufacturers_id'] == $manufacturer) {
            $return_string .= ' SELECTED';
        }
        $return_string .= '>' . $manufacturers['manufacturers_name'] . '</option>';
    }
    $return_string .= '</select>';
    return $return_string;
}

##// Uptade database
switch ($_GET['action']) {
    case 'update':
        $count_update = 0;
        $item_updated = array();
        if ($_POST['product_new_model']) {
            foreach ($_POST['product_new_model'] as $id => $new_model) {
                if (trim($_POST['product_new_model'][$id]) != trim($_POST['product_old_model'][$id])) {
                    $count_update++;
                    $item_updated[$id] = 'updated';
                    tep_db_query("UPDATE " . TABLE_PRODUCTS . " SET products_model='" . tep_db_prepare_input($new_model) . "' WHERE products_id=" . (int)$id);
                }
            }
        }
        if ($_POST['product_new_name']) {
            foreach ($_POST['product_new_name'] as $id => $new_name) {
                if (trim($_POST['product_new_name'][$id]) != trim($_POST['product_old_name'][$id])) {
                    $count_update++;
                    $item_updated[$id] = 'updated';
                    tep_db_query("UPDATE " . TABLE_PRODUCTS_DESCRIPTION . " SET products_name='" . tep_db_prepare_input($new_name) . "' WHERE products_id=" . (int)$id . " and language_id=" . (int)$languages_id);
                }
            }
        }
        if ($_POST['product_new_head_title_tag']) {
            foreach ($_POST['product_new_head_title_tag'] as $id => $new_name) {
                if (trim($_POST['product_new_head_title_tag'][$id]) != trim($_POST['product_old_head_title_tag'][$id])) {
                    $count_update++;
                    $item_updated[$id] = 'updated';
                    tep_db_query("UPDATE " . TABLE_PRODUCTS_DESCRIPTION . " SET products_head_title_tag='" . tep_db_prepare_input($new_name) . "' WHERE products_id=" . (int)$id . " and language_id=" . (int)$languages_id);
                }
            }
        }
        if ($_POST['product_new_head_desc_tag']) {
            foreach ($_POST['product_new_head_desc_tag'] as $id => $new_name) {
                if (trim($_POST['product_new_head_desc_tag'][$id]) != trim($_POST['product_old_head_desc_tag'][$id])) {
                    $count_update++;
                    $item_updated[$id] = 'updated';
                    tep_db_query("UPDATE " . TABLE_PRODUCTS_DESCRIPTION . " SET products_head_desc_tag='" . tep_db_prepare_input($new_name) . "' WHERE products_id=" . (int)$id . " and language_id=" . (int)$languages_id);
                }
            }
        }
        if ($_POST['product_new_price']) {
            foreach ($_POST['product_new_price'] as $id => $new_price) {
                if (($_POST['update_price'][$id] == 'yes' && $_POST['spec_price']) || ($_POST['product_new_price'][$id] != $_POST['product_old_price'][$id])) {
                    $count_update++;
                    $item_updated[$id] = 'updated';
                    if ($_POST['spec_price']) {
                        $new_price = change_price($new_price, $_POST['spec_price']);
                    }
                    tep_db_query("UPDATE " . TABLE_PRODUCTS . " SET products_price=" . (float)$new_price . " WHERE products_id=" . (int)$id);
                }
            }
        }

        $prices_num = tep_xppp_getpricesnum();
        for ($i = 2; $i <= $prices_num; $i++) {
            if ($_POST['products_price_' . $i]) {
                foreach ($_POST['products_price_' . $i] as $id => $new_price_list) {
                    $count_update++;
                    $item_updated[$id] = 'updated';
                    tep_db_query("UPDATE " . TABLE_PRODUCTS . " SET products_price_$i=" . (float)$new_price_list . " WHERE products_id=" . (int)$id);
                }
            }
        }

        if ($_POST['product_new_special_price']) {
            $specials_array = array();
            $specials_query = tep_db_query("select p.products_id, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_SPECIALS . " s where s.products_id = p.products_id");
            while ($specials = tep_db_fetch_array($specials_query)) {
                $specials_array[$specials['products_id']] = $specials['specials_new_products_price'];
            }

            foreach ($_POST['product_new_special_price'] as $id => $new_spec_price) {
                if ($_POST['product_new_special_price'][$id] != $_POST['product_old_special_price'][$id] && $_POST['update_price'][$id] == 'yes') {
                    $count_update++;
                    $item_updated[$id] = 'updated';
                    if (empty($new_spec_price)) {
                        tep_db_query("delete from " . TABLE_SPECIALS . "  WHERE products_id=" . (int)$id);
                    } else {
                        if (isset($specials_array[$id])) {
                            tep_db_query("UPDATE " . TABLE_SPECIALS . " SET specials_new_products_price=" . (float)$new_spec_price . " WHERE products_id=" . (int)$id);
                        } else {
                            tep_db_query("insert into " . TABLE_SPECIALS . " (specials_new_products_price, products_id) values (" . (float)$new_spec_price . ", " . (int)$id . ")");
                        }
                    }
                }
            }
        }

        if ($_POST['product_new_weight']) {
            foreach ($_POST['product_new_weight'] as $id => $new_weight) {
                if ($_POST['product_new_weight'][$id] != $_POST['product_old_weight'][$id]) {
                    $count_update++;
                    $item_updated[$id] = 'updated';
                    tep_db_query("UPDATE " . TABLE_PRODUCTS . " SET products_weight=" . (float)$new_weight . " WHERE products_id=" . (int)$id);
                }
            }
        }
        if ($_POST['product_new_quantity']) {
            foreach ($_POST['product_new_quantity'] as $id => $new_quantity) {
                if ($_POST['product_new_quantity'][$id] != $_POST['product_old_quantity'][$id]) {
                    $count_update++;
                    $item_updated[$id] = 'updated';
                    tep_db_query("UPDATE " . TABLE_PRODUCTS . " SET products_quantity=" . (int)$new_quantity . " WHERE products_id=" . (int)$id);
                }
            }
        }
        if ($_POST['product_new_sort_order']) {
            foreach ($_POST['product_new_sort_order'] as $id => $new_sort_order) {
                if ($_POST['product_new_sort_order'][$id] != $_POST['product_old_sort_order'][$id]) {
                    $count_update++;
                    $item_updated[$id] = 'updated';
                    tep_db_query("UPDATE " . TABLE_PRODUCTS . " SET products_sort_order=" . (int)$new_sort_order . " WHERE products_id=" . (int)$id);
                }
            }
        }
        if ($_POST['product_new_quantity_order_min']) {
            foreach ($_POST['product_new_quantity_order_min'] as $id => $new_quantity_order_min) {
                if ($_POST['product_new_quantity_order_min'][$id] != $_POST['product_old_quantity_order_min'][$id]) {
                    $count_update++;
                    $item_updated[$id] = 'updated';
                    tep_db_query("UPDATE " . TABLE_PRODUCTS . " SET products_quantity_order_min=" . (int)$new_quantity_order_min . " WHERE products_id=" . (int)$id);
                }
            }
        }
        if ($_POST['product_new_quantity_order_units']) {
            foreach ($_POST['product_new_quantity_order_units'] as $id => $new_quantity_order_units) {
                if ($_POST['product_new_quantity_order_units'][$id] != $_POST['product_old_quantity_order_units'][$id]) {
                    $count_update++;
                    $item_updated[$id] = 'updated';
                    tep_db_query("UPDATE " . TABLE_PRODUCTS . " SET products_quantity_order_units=" . (int)$new_quantity_order_units . " WHERE products_id=" . (int)$id);
                }
            }
        }
        if ($_POST['product_new_manufacturer']) {
            foreach ($_POST['product_new_manufacturer'] as $id => $new_manufacturer) {
                if ($_POST['product_new_manufacturer'][$id] != $_POST['product_old_manufacturer'][$id]) {
                    $count_update++;
                    $item_updated[$id] = 'updated';
                    tep_db_query("UPDATE " . TABLE_PRODUCTS . " SET manufacturers_id=" . (int)$new_manufacturer . " WHERE products_id=" . (int)$id);
                }
            }
        }
        if ($_POST['product_new_image']) {
            foreach ($_POST['product_new_image'] as $id => $new_image) {
                if (trim($_POST['product_new_image'][$id]) != trim($_POST['product_old_image'][$id])) {
                    $count_update++;
                    $item_updated[$id] = 'updated';
                    tep_db_query("UPDATE " . TABLE_PRODUCTS . " SET products_image=" . $new_image . " WHERE products_id=" . (int)$id);
                }
            }
        }
        if ($_POST['product_new_status']) {
            foreach ($_POST['product_new_status'] as $id => $new_status) {
                if ($_POST['product_new_status'][$id] != $_POST['product_old_status'][$id]) {
                    $count_update++;
                    $item_updated[$id] = 'updated';
                    tep_set_product_status($id, $new_status);
                }
            }
        }
        if ($_POST['product_new_tax']) {
            foreach ($_POST['product_new_tax'] as $id => $new_tax_id) {
                if ($_POST['product_new_tax'][$id] != $_POST['product_old_tax'][$id]) {
                    $count_update++;
                    $item_updated[$id] = 'updated';
                    tep_db_query("UPDATE " . TABLE_PRODUCTS . " SET products_tax_class_id=" . (int)$new_tax_id . " WHERE products_id=" . (int)$id);
                }
            }
        }
        $count_item = array_count_values($item_updated);
        if ($count_item['updated'] > 0) {
            $messageStack->add($count_item['updated'] . ' ' . TEXT_PRODUCTS_UPDATED . " $count_update " . TEXT_QTY_UPDATED, 'success');
        }
        break;

    case 'calcul':
        if ($_POST['spec_price']) {
            $preview_global_price = 'true';
        }
        break;
}

//// explode string parameters from preview product
if ($info_back && $info_back != "-") {
    $infoback = explode('-', $info_back);
    $sort_by = $infoback[0];
    $page = $infoback[1];
    $current_category_id = $infoback[2];

    $manufacturer = $infoback[4];
} else {
    $page = $_GET['page'];
}
$sort_by = $sort_by ?: $_GET['sort_by'];
//// define the step for rollover lines per page
$row_bypage_array = array(array());
for ($i = 50; $i <= 500; $i = $i + 50) {
    $row_bypage_array[] = array(
        'id' => $i,
        'text' => $i);
}
include_once('html-open.php');
include_once('header.php');
##// Let's start displaying page with forms
?>
    <!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
    <html <?php echo HTML_PARAMS; ?>>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
        <title><?php echo TITLE; ?></title>
        <link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
        <link rel="stylesheet" href="includes/solomono/css/overwrite.css" type="text/css"/>
    </head>
    <body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0"
          bgcolor="#FFFFFF">
    <script language="javascript">
        <!--
        var browser_family;
        var up = 1;

        if (document.all && !document.getElementById)
            browser_family = "dom2";
        else if (document.layers)
            browser_family = "ns4";
        else if (document.getElementById)
            browser_family = "dom2";
        else
            browser_family = "other";

        function display_ttc(action, prix, taxe, up) {
            if (action == 'display') {
                if (up != 1)
                    valeur = Math.round((prix + (taxe / 100) * prix) * 100) / 100;
            } else {
                if (action == 'keyup') {
                    valeur = Math.round((parseFloat(prix) + (taxe / 100) * parseFloat(prix)) * 100) / 100;
                } else {
                    valeur = '0';
                }
            }
            switch (browser_family) {
                case 'dom2':
                    document.getElementById('descDiv').innerHTML = '<?php echo TOTAL_COST; ?> : ' + valeur;
                    break;
                case 'ie4':
                    document.all.descDiv.innerHTML = '<?php echo TOTAL_COST; ?> : ' + valeur;
                    break;
                case 'ns4':
                    document.descDiv.document.descDiv_sub.document.write(valeur);
                    document.descDiv.document.descDiv_sub.document.close();
                    break;
                case 'other':
                    break;
            }
        }
        $(document).on("change","#spec_price_1",function(){
            $("#spec_price_2").val($("#spec_price_1").val());
        });
        -->
    </script>
    <!-- body //-->
    <table border="0" width="100%" cellspacing="2" cellpadding="2" class="table_quick_updates_wrapper">
	    <tr>
		    <!-- body_text //-->
		    <td width="100%" valign="top">
			    <table border="0" width="100%" cellspacing="0" cellpadding="2">
				    <tr>
					    <td>
						    <table border="0" width="100%" cellspacing="0" cellpadding="0">
							    <tr>
								    <td class="pageHeading table_quick_heading" colspan="3" valign="top"><?php echo HEADING_TITLE; ?></td>
								    <td class="pageHeading" align="right">
									    <?php
									    if ($current_category_id != 0) {
										    $image_query = tep_db_query("select c.categories_image from " . TABLE_CATEGORIES . " c where c.categories_id=" . (int)$current_category_id);
										    $image = tep_db_fetch_array($image_query);
										    echo tep_image(DIR_WS_CATALOG . DIR_WS_IMAGES . $image['categories_image'], '', 40);
									    } else {
										    if ($manufacturer) {
											    $image_query = tep_db_query("select manufacturers_image from " . TABLE_MANUFACTURERS . " where manufacturers_id=" . (int)$manufacturer);
											    $image = tep_db_fetch_array($image_query);
											    echo tep_image(DIR_WS_CATALOG . DIR_WS_IMAGES . $image['manufacturers_image'], '', 40);
										    }
									    }
									    ?>
								    </td>
							    </tr>
						    </table>
					    </td>
				    </tr>

				    <tr>
					    <td align="center">
						    <div class="table_quick table_block_width">
							    <table class="table_quick_updates_header" width="100%" cellspacing="0" cellpadding="0"
								     border="1" bordercolor="#D1E7EF" height="100">
								    <tr align="center">
									    <td valign="middle">
										    <table width="100%" cellspacing="0" cellpadding="0" border="0">
											    <tr>
												    <td height="5"></td>
											    </tr>
											    <tr align="center" class="form_quick_choice">
												    <td class="smalltext"><?php echo tep_draw_form('row_by_page', FILENAME_QUICK_UPDATES, '', 'get');
													    echo tep_draw_hidden_field('manufacturer', $manufacturer);
													    echo tep_draw_hidden_field('cPath', $current_category_id); ?>
												    </td>
												    <td class="smallText"><?php echo TEXT_MAXI_ROW_BY_PAGE . '&nbsp;&nbsp;' . tep_draw_pull_down_menu('row_by_page', $row_bypage_array, $row_by_page, 'onChange="this.form.submit();"'); ?></form></td>
												    <?php echo tep_draw_form('categorie', FILENAME_QUICK_UPDATES, '', 'get');
												    echo tep_draw_hidden_field('row_by_page', $row_by_page);
												    echo tep_draw_hidden_field('manufacturer', $manufacturer); ?>
												    <td class="smallText quick_td" align="center"
													     valign="top" width="40%"><?php echo DISPLAY_CATEGORIES . '&nbsp;&nbsp;' .
                                                        tep_draw_pull_down_categories('cPath', $tep_get_category_tree, $current_category_id);
													     ?></td>
												    </form>
												    <?php echo tep_draw_form('manufacturers', FILENAME_QUICK_UPDATES, '', 'get');
												    echo tep_draw_hidden_field('row_by_page', $row_by_page);
												    echo tep_draw_hidden_field('cPath', $current_category_id); ?>
												    <td class="smallText quick_td" align="center"
													     valign="top"><?php echo DISPLAY_MANUFACTURERS . '&nbsp;&nbsp' . manufacturers_list(); ?></td>
												    </form>
											    </tr>
										    </table>
										    <table width="100%" cellspacing="0" cellpadding="0" border="0">
											    <tr align="center">
												    <td align="center">
													    <table border="0" cellspacing="0" class="table_quick_form">
														    <form name="spec_price" <?php echo 'action="' . tep_href_link(FILENAME_QUICK_UPDATES, tep_get_all_get_params(array(
																	    'action',
																	    'info',
																	    'pID')) . "action=calcul&page=$page&sort_by=$sort_by&cPath=$current_category_id&row_by_page=$row_by_page&manufacturer=$manufacturer", 'NONSSL') . '"'; ?>
															     method="post">
															    <tr>
																    <?php if (ACTIVATE_COMMERCIAL_MARGIN == 'true') {
																	    echo '<td class="smalltext quick_td quick_text" align="center" valign="middle" width="50%">&nbsp;&nbsp;&nbsp;&nbsp;' . tep_draw_checkbox_field('marge', 'yes', '', 'no') . '&nbsp;' . TEXT_MARGE_INFO, tep_image(DIR_WS_IMAGES . 'icon_info.gif', TEXT_MARGE_INFO) . '</td>';
																    } ?>
																    <td>
																	    <table border="0" cellspacing="0" width="100%" class="quick_table">
																		    <tr>
																			    <td class="main" align="center" valign="middle"
																				     nowrap><?php echo TEXT_INPUT_SPEC_PRICE; ?></td>
																			    <td align="center"
																				     valign="middle"><?php echo tep_draw_input_field('spec_price', 0, 'size="5" style="height: 22px;" id = "spec_price_1"'); ?> </td>
																		    </tr>
																	    </table>
																    </td>
																    <td class="smalltext quick_td quick_button" align="center" valign="middle">
																	    <?php if ($preview_global_price != 'true') {
																		    echo tep_image_submit('button_preview.gif', IMAGE_PREVIEW, "page=$page&sort_by=$sort_by&cPath=$current_category_id&row_by_page=$row_by_page&manufacturer=$manufacturer style='display:block;'");
																	    } else {
																		    echo '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_QUICK_UPDATES, "page=$page&sort_by=$sort_by&cPath=$current_category_id&row_by_page=$row_by_page&manufacturer=$manufacturer") . '">' . tep_text_button(BUTTON_CANCEL_NEW) . '</a>';
																	    } ?></td>

															    </tr>
															    <tr class="quick_price">
																    <td class="smalltext quick_td" align="right" valign="middle"
																	     colspan="3" nowrap>
																	    <?php if ($preview_global_price != 'true') {
																		    echo TEXT_SPEC_PRICE_INFO1;
																	    } else {
																		    echo TEXT_SPEC_PRICE_INFO2;
																	    } ?>
																    </td>
															    </tr>
														    </form>
													    </table>
												    </td>
											    </tr>
											    <tr>
												    <td height="5"></td>
											    </tr>
										    </table>
									    </td>
								    </tr>
							    </table>
						    </div>
						    <br>
						    <table align="left" width="100%" cellspacing="0" cellpadding="0" border="0" class="update_form table_block_name">
							    <tr align="left">
								    <form name="update" method="POST"
									     action="<?php echo FILENAME_QUICK_UPDATES . "?action=update&page=$page&sort_by=$sort_by&cPath=$current_category_id&row_by_page=$row_by_page&manufacturer=$manufacturer"; ?>">
									    <?php echo tep_draw_hidden_field('spec_price', 0, 'id = "spec_price_2"'); ?>
									    <td class="smalltext" align="left"><?php echo WARNING_MESSAGE; ?> </td>
									    <?php echo "<td class=\"cena\" align=\"left\">" . '<script language="javascript"><!--
							switch (browser_family)
							{
							case "dom2":
							case "ie4":
							 document.write(\'<div id="descDiv">\');
							 break;
							default:
							 document.write(\'<ilayer id="descDiv"><layer id="descDiv_sub">\');
					   	  	 break;
							}
							-->
							</script>' . "</td>\n";
									    ?>
									    <td align="right"
										     valign="middle" class="update_block_button"><?php echo tep_image_submit('button_update.gif', IMAGE_UPDATE, "action=update&cPath=$current_category_id&page=$page&sort_by=$sort_by&row_by_page=$row_by_page"); ?></td>
							    </tr>
						    </table>
					    </td>
				    </tr>

				    <tr>
					    <td>
						    <div class="table-responsive table_block_width">
							    <table border="0" width="100%" cellspacing="0" cellpadding="2" style="width: 100%; max-width: 1200px">
								    <tr>
									    <td valign="top">
										    <table class="quick_updates_table table-hover table-bordered bg-white-only"
											     border="0" width="100%" cellspacing="0" cellpadding="2">
											    <tr class="dataTableHeadingRow">
												    <?php if (DISPLAY_MODEL == 'true') {
													    echo
														    "<th class='dataTableHeadingContent p_products_model' align='left' valign='middle'>"
														    . TABLE_HEADING_MODEL . "
                                                    <a class='sort_default' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES) . "\" ><i class='fa fa-sort-asc fa-1x' aria-hidden='true'></i></a>
                                                    <a class='sort_desc active' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES, 'cPath=' . $current_category_id . '&sort_by=p.products_model desc&page=' . $page . '&row_by_page=' . $row_by_page . '&manufacturer=' . $manufacturer) . "\" ><i class='fa fa-sort fa-1x' aria-hidden='true'></i></a>
                                                    <a class='sort_asc' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES, 'cPath=' . $current_category_id . '&sort_by=p.products_model asc&page=' . $page . '&row_by_page=' . $row_by_page . '&manufacturer=' . $manufacturer) . "\" ><i class='fa fa-sort-desc fa-1x' aria-hidden='true'></i></a>"

                                                    . "</form>" .
                                                    tep_draw_form('search_model', FILENAME_QUICK_UPDATES,
                                                        '', 'get') .
                                                    tep_draw_hidden_field('row_by_page', $row_by_page) .
                                                    tep_draw_hidden_field('manufacturer', $manufacturer) .
                                                    tep_draw_hidden_field('cPath', $current_category_id) .
                                                    tep_draw_hidden_field('search_pd_name', $search_pd_name) .
                                                    '<div class="search" style="float:left;">' . tep_draw_input_field('search_model',
                                                            $search_model) . "</div>" .
                                                    "</form>".

                                            "</th>";
												    } ?>
												    <th class="dataTableHeadingContent p_products_price" align="left"
													     valign="middle" style="width:105px;">
													    <?php echo TABLE_HEADING_PRICE .
														    "<a class='sort_default' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES) . "\" ><i class='fa fa-sort-asc fa-1x' aria-hidden='true'></i></a>
                                                    <a class='sort_desc active' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES, 'cPath=' . $current_category_id . '&sort_by=p.products_price desc&page=' . $page . '&row_by_page=' . $row_by_page . '&manufacturer=' . $manufacturer) . "\" ><i class='fa fa-sort fa-1x' aria-hidden='true'></i></a>
                                                    <a class='sort_asc' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES, 'cPath=' . $current_category_id . '&sort_by=p.products_price asc&page=' . $page . '&row_by_page=' . $row_by_page . '&manufacturer=' . $manufacturer) . "\" ><i class='fa fa-sort-desc fa-1x' aria-hidden='true'></i></a>"; ?>

                                                    </th>
												    <th class="dataTableHeadingContent" align="center" valign="middle"
													     style="width:85px;">
                                                    <?php echo TABLE_HEADING_SPECIAL_PRICE ?>
												    </th>
												    <th class="dataTableHeadingContent pd_products_name" align="left"
													     valign="middle">
													    <?php echo TABLE_HEADING_PRODUCTS .
														    "<a class='sort_default' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES) . "\" ><i class='fa fa-sort-asc fa-1x' aria-hidden='true'></i></a>
                                                    <a class='sort_desc active' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES, 'cPath=' . $current_category_id . '&sort_by=pd.products_name desc&page=' . $page . '&row_by_page=' . $row_by_page . '&manufacturer=' . $manufacturer) . "\" ><i class='fa fa-sort fa-1x' aria-hidden='true'></i></a>
                                                    <a class='sort_asc' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES, 'cPath=' . $current_category_id . '&sort_by=pd.products_name asc&page=' . $page . '&row_by_page=' . $row_by_page . '&manufacturer=' . $manufacturer) . "\" ><i class='fa fa-sort-desc fa-1x' aria-hidden='true'></i></a>"; ?>
                                                    <?php
                                                    echo '</form>';
                                                    echo tep_draw_form('search_pd_name', FILENAME_QUICK_UPDATES,
                                                        '', 'get');
                                                    echo tep_draw_hidden_field('row_by_page', $row_by_page);
                                                    echo tep_draw_hidden_field('manufacturer', $manufacturer);
                                                    echo tep_draw_hidden_field('cPath', $current_category_id);
                                                    echo tep_draw_hidden_field('search_model', $search_model);
                                                    echo '<div class="search" style="float:left;">' . tep_draw_input_field('search_pd_name',
                                                            $search_pd_name) . '</div>';
                                                    echo '</form>';
                                                    ?>
												    </th>
												    <?php ///////////// META_TITLE /////////////// META_DESCRIPTION ////////////////////////// ?>
												    <th class="dataTableHeadingContent pd_products_head_title_tag"
													     align="left" valign="middle">
													    <?php echo TABLE_HEADING_META_TITLE .
														    "<a class='sort_default' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES) . "\" ><i class='fa fa-sort-asc fa-1x' aria-hidden='true'></i></a>
                                                    <a class='sort_desc active' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES, 'cPath=' . $current_category_id . '&sort_by=pd.products_head_title_tag desc&page=' . $page . '&row_by_page=' . $row_by_page . '&manufacturer=' . $manufacturer) . "\" ><i class='fa fa-sort fa-1x' aria-hidden='true'></i></a>
                                                    <a class='sort_asc' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES, 'cPath=' . $current_category_id . '&sort_by=pd.products_head_title_tag asc&page=' . $page . '&row_by_page=' . $row_by_page . '&manufacturer=' . $manufacturer) . "\" ><i class='fa fa-sort-desc fa-1x' aria-hidden='true'></i></a>"; ?>
												    </th>
												    <th class="dataTableHeadingContent pd_products_head_desc_tag"
													     align="left" valign="middle">
													    <?php echo TABLE_HEADING_META_DESCRIPTION .
														    "<a class='sort_default' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES) . "\" ><i class='fa fa-sort-asc fa-1x' aria-hidden='true'></i></a>
                                                    <a class='sort_desc active' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES, 'cPath=' . $current_category_id . '&sort_by=pd.products_head_desc_tag desc&page=' . $page . '&row_by_page=' . $row_by_page . '&manufacturer=' . $manufacturer) . "\" ><i class='fa fa-sort fa-1x' aria-hidden='true'></i></a>
                                                    <a class='sort_asc' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES, 'cPath=' . $current_category_id . '&sort_by=pd.products_head_desc_tag asc&page=' . $page . '&row_by_page=' . $row_by_page . '&manufacturer=' . $manufacturer) . "\" ><i class='fa fa-sort-desc fa-1x' aria-hidden='true'></i></a>"; ?>
												    </th>
												    <?php //////////////////////////////////////////////////////// ?>
												    <?php if (DISPLAY_STATUT == 'true') {
													    echo
														    "<th class='dataTableHeadingContent p_products_status' align='left' valign='middle'>"
														    . TABLE_HEADING_STATUS . "<br>" . TEXT_STATUS_ON_OFF .
														    "<a class='sort_default' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES) . "\" ><i class='fa fa-sort-asc fa-1x' aria-hidden='true'></i></a>
                                                    <a class='sort_desc active' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES, 'cPath=' . $current_category_id . '&sort_by=p.products_status desc&page=' . $page . '&row_by_page=' . $row_by_page . '&manufacturer=' . $manufacturer) . "\" ><i class='fa fa-sort fa-1x' aria-hidden='true'></i></a>
                                                    <a href=\"" . tep_href_link(FILENAME_QUICK_UPDATES, 'cPath=' . $current_category_id . '&sort_by=p.products_status asc&page=' . $page . '&row_by_page=' . $row_by_page . '&manufacturer=' . $manufacturer) . "\" ><i class='fa fa-sort-desc fa-1x' aria-hidden='true'></i></a>
                                            </th>";
												    } ?>
												    <?php if (DISPLAY_WEIGHT == 'true') {
													    echo
														    "<th class='dataTableHeadingContent p_products_weight' align='left' valign='middle'>"
														    . TABLE_HEADING_WEIGHT .
														    "<a class='sort_default' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES) . "\" ><i class='fa fa-sort-asc fa-1x' aria-hidden='true'></i></a>
                                                    <a class='sort_desc active' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES, 'cPath=' . $current_category_id . '&sort_by=p.products_weight desc&page=' . $page . '&row_by_page=' . $row_by_page . '&manufacturer=' . $manufacturer) . "\" ><i class='fa fa-sort fa-1x' aria-hidden='true'></i></a>
                                                    <a class='sort_asc' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES, 'cPath=' . $current_category_id . '&sort_by=p.products_weight asc&page=' . $page . '&row_by_page=' . $row_by_page . '&manufacturer=' . $manufacturer) . "\" ><i class='fa fa-sort-desc fa-1x' aria-hidden='true'></i></a>
                                               
                                            </th>";
												    } ?>
												    <?php if (DISPLAY_QUANTITY == 'true') {
													    echo
														    "<th class='dataTableHeadingContent p_products_quantity' align='center' valign='middle'>"
														    . TABLE_HEADING_QUANTITY .
														    "<a class='sort_default' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES) . "\" ><i class='fa fa-sort-asc fa-1x' aria-hidden='true'></i></a>
                                                    <a class='sort_desc active' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES, 'cPath=' . $current_category_id . '&sort_by=p.products_quantity desc&page=' . $page . '&row_by_page=' . $row_by_page . '&manufacturer=' . $manufacturer) . "\" ><i class='fa fa-sort fa-1x' aria-hidden='true'></i></a>
                                                    <a class='sort_asc' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES, 'cPath=' . $current_category_id . '&sort_by=p.products_quantity asc&page=' . $page . '&row_by_page=' . $row_by_page . '&manufacturer=' . $manufacturer) . "\" ><i class='fa fa-sort-desc fa-1x' aria-hidden='true'></i></a>
                                            </th>";
												    } ?>
												    <?php if (DISPLAY_SORT_ORDER == 'true') {
													    echo
														    "<th class='dataTableHeadingContent p_products_sort_order' align='center' valign='middle'>"
														    . TABLE_HEADING_PRODUCTS_SORT_ORDER .
														    "<a class='sort_default' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES) . "\" ><i class='fa fa-sort-asc fa-1x' aria-hidden='true'></i></a>
                                                    <a class='sort_desc active' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES, 'cPath=' . $current_category_id . '&sort_by=p.products_sort_order desc&page=' . $page . '&row_by_page=' . $row_by_page . '&manufacturer=' . $manufacturer) . "\" ><i class='fa fa-sort fa-1x' aria-hidden='true'></i></a>
                                                    <a class='sort_asc' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES, 'cPath=' . $current_category_id . '&sort_by=p.products_sort_order asc&page=' . $page . '&row_by_page=' . $row_by_page . '&manufacturer=' . $manufacturer) . "\" ><i class='fa fa-sort-desc fa-1x' aria-hidden='true'></i></a>
                                            </th>";
												    } ?>
												    <?php if (DISPLAY_ORDER_MIN == 'true') {
													    echo
														    "<th class='dataTableHeadingContent p_products_quantity_order_min' align='center' valign='middle'>"
														    . TABLE_HEADING_QUANTITY_ORDER_MIN .
														    "<a class='sort_default' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES) . "\" ><i class='fa fa-sort-asc fa-1x' aria-hidden='true'></i></a>
                                                    <a class='sort_desc active' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES, 'cPath=' . $current_category_id . '&sort_by=p.products_quantity_order_min desc&page=' . $page . '&row_by_page=' . $row_by_page . '&manufacturer=' . $manufacturer) . "\" ><i class='fa fa-sort fa-1x' aria-hidden='true'></i></a>
                                                    <a class='sort_asc' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES, 'cPath=' . $current_category_id . '&sort_by=p.products_quantity_order_min asc&page=' . $page . '&row_by_page=' . $row_by_page . '&manufacturer=' . $manufacturer) . "\" ><i class='fa fa-sort-desc fa-1x' aria-hidden='true'></i></a>
                                            </th>";
												    } ?>
												    <?php if (DISPLAY_ORDER_UNITS == 'true') {
													    echo
														    "<th class='dataTableHeadingContent p_products_quantity_order_units' align='center' valign='middle'>"
														    . TABLE_HEADING_QUANTITY_ORDER_UNITS .
														    "<a class='sort_default' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES) . "\" ><i class='fa fa-sort-asc fa-1x' aria-hidden='true'></i></a>
                                                    <a class='sort_desc active' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES, 'cPath=' . $current_category_id . '&sort_by=p.products_quantity_order_units desc&page=' . $page . '&row_by_page=' . $row_by_page . '&manufacturer=' . $manufacturer) . "\" ><i class='fa fa-sort fa-1x' aria-hidden='true'></i></a>
                                                    <a class='sort_asc' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES, 'cPath=' . $current_category_id . '&sort_by=p.products_quantity_order_units asc&page=' . $page . '&row_by_page=' . $row_by_page . '&manufacturer=' . $manufacturer) . "\" ><i class='fa fa-sort-desc fa-1x' aria-hidden='true'></i></a>
                                            </th>";
												    } ?>
												    <!--                                                <td class="dataTableHeadingContent" align="center" valign="middle">-->
												    <!--                                                    <table border="0" cellspacing="0" cellpadding="0">-->
												    <!--                                                        <tr class="dataTableHeadingRow">-->
												    <!--                                                            <td class="dataTableHeadingContent" align="left" valign="middle">-->
												    <!--                                                                --><?php //if (DISPLAY_IMAGE == 'true') echo " <a href=\"" . tep_href_link(FILENAME_QUICK_UPDATES, 'cPath=' . $current_category_id . '&sort_by=p.products_image DESC&page=' . $page . '&row_by_page=' . $row_by_page . '&manufacturer=' . $manufacturer) . "\" >" . tep_image(DIR_WS_IMAGES . 'icon_arrow_down.gif', 'Desc') . "</a></td> " . "<td class=\"dataTableHeadingContent\" align=\"center\" valign=\"middle\">" . TABLE_HEADING_IMAGE . "</td>" . "<td class=\"dataTableHeadingContent\" align=\"left\" valign=\"middle\"><a href=\"" . tep_href_link(FILENAME_QUICK_UPDATES, 'cPath=' . $current_category_id . '&sort_by=p.products_image ASC&page=' . $page . '&row_by_page=' . $row_by_page . '&manufacturer=' . $manufacturer) . "\" >" . tep_image(DIR_WS_IMAGES . 'icon_arrow_up.gif', 'Asc') . "</a></td>"; ?>
												    <!--                                                        </tr>-->
												    <!--                                                    </table>-->
												    <!--                                                </td>-->
												    <?php if (DISPLAY_MANUFACTURER == 'true') {
													    echo
														    "<th class='dataTableHeadingContent p_manufacturers_id' align='center' valign='middle'>"
														    . TABLE_HEADING_MANUFACTURERS .
														    "<a class='sort_default' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES) . "\" ><i class='fa fa-sort-asc fa-1x' aria-hidden='true'></i></a>
                                                    <a class='sort_desc active' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES, 'cPath=' . $current_category_id . '&sort_by=p.manufacturers_id desc&page=' . $page . '&row_by_page=' . $row_by_page . '&manufacturer=' . $manufacturer) . "\" ><i class='fa fa-sort fa-1x' aria-hidden='true'></i></a>
                                                    <a class='sort_asc' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES, 'cPath=' . $current_category_id . '&sort_by=p.manufacturers_id asc&page=' . $page . '&row_by_page=' . $row_by_page . '&manufacturer=' . $manufacturer) . "\" ><i class='fa fa-sort-desc fa-1x' aria-hidden='true'></i></a>
                                            </th>";
												    } ?>
												    <?php if (DISPLAY_TAX == 'true') {
													    echo
														    "<th class='dataTableHeadingContent p_products_tax_class_id' align='center' valign='middle'>"
														    . TABLE_HEADING_TAX .
														    "<a class='sort_default' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES) . "\" ><i class='fa fa-sort-asc fa-1x' aria-hidden='true'></i></a>
                                                    <a class='sort_desc active' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES, 'cPath=' . $current_category_id . '&sort_by=p.products_tax_class_id desc&page=' . $page . '&row_by_page=' . $row_by_page . '&manufacturer=' . $manufacturer) . "\" ><i class='fa fa-sort fa-1x' aria-hidden='true'></i></a>
                                                    <a class='sort_asc' href=\"" . tep_href_link(FILENAME_QUICK_UPDATES, 'cPath=' . $current_category_id . '&sort_by=p.products_tax_class_id asc&page=' . $page . '&row_by_page=' . $row_by_page . '&manufacturer=' . $manufacturer) . "\" ><i class='fa fa-sort-desc fa-1x' aria-hidden='true'></i></a>
                                            </th>";
												    } ?>
												    <th class="dataTableHeadingContent" align="center" valign="middle"></th>
												    <!--                                            <th class="dataTableHeadingContent" align="center" valign="middle"></th>-->
											    </tr>
											    <tr class="datatableRow">
												    <?php
												    //// get the specials products list
												    $specials_array = array();
												    $specials_query = tep_db_query("select p.products_id, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_SPECIALS . " s where s.products_id = p.products_id");
												    while ($specials = tep_db_fetch_array($specials_query)) {
													    $specials_array[$specials['products_id']] = $specials['specials_new_products_price'];
												    }
												    //// control string sort page
												    if ($sort_by && !preg_match('/order by/', $sort_by)) {
													    $sort_by = 'order by ' . $sort_by;
												    }
												    //// define the string parameters for good back preview product
												    $origin = FILENAME_QUICK_UPDATES . "?info_back=$sort_by-$page-$current_category_id-$row_by_page-$manufacturer";
												    //// controle lenght (lines per page)
												    $split_page = $page;
												    //
												    if ($split_page > 1) {
													    $rows = $split_page * MAX_DISPLAY_ROW_BY_PAGE - MAX_DISPLAY_ROW_BY_PAGE;
												    }

												    ////  select categories
												    $products_price_list = tep_xppp_getpricelist("");

                                                    if ($current_category_id == 0) {
                                                        if ($manufacturer) {
                                                            $products_query_raw = "select p.products_id, pd.products_head_title_tag, pd.products_head_desc_tag, " . $products_price_list . ", p.products_image, p.products_model, pd.products_name, p.products_status, p.products_weight, p.products_quantity, p.products_quantity_order_min, p.products_quantity_order_units, p.products_sort_order, p.manufacturers_id, p.products_price, p.products_tax_class_id from  " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and pd.language_id = " . (int)$languages_id . " and p.manufacturers_id = " . (int)$manufacturer . " $sort_by ";
                                                        } else {
                                                            $products_query_raw = "select p.products_id, pd.products_head_title_tag, pd.products_head_desc_tag, " . $products_price_list . ", p.products_image, p.products_model, pd.products_name, p.products_status, p.products_weight, p.products_quantity, p.products_quantity_order_min, p.products_quantity_order_units, p.products_sort_order, p.manufacturers_id, p.products_price, p.products_tax_class_id from  " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and pd.language_id = " . (int)$languages_id . " $sort_by ";
                                                        }
                                                    } else {
                                                        if ($manufacturer) {
                                                            $products_query_raw = "select p.products_id, pd.products_head_title_tag, pd.products_head_desc_tag, " . $products_price_list . ", p.products_image, p.products_model, pd.products_name, p.products_status, p.products_weight, p.products_quantity, p.products_quantity_order_min, p.products_quantity_order_units, p.products_sort_order, p.manufacturers_id, p.products_price, p.products_tax_class_id from  " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " pc where p.products_id = pd.products_id and pd.language_id = " . (int)$languages_id . " and p.products_id = pc.products_id and pc.categories_id = " . (int)$current_category_id . " and p.manufacturers_id = " . (int)$manufacturer . " $sort_by ";
                                                        } else {
                                                            $products_query_raw = "select p.products_id, pd.products_head_title_tag, pd.products_head_desc_tag, " . $products_price_list . ", p.products_image, p.products_model, pd.products_name, p.products_status, p.products_weight, p.products_quantity, p.products_quantity_order_min, p.products_quantity_order_units, p.products_sort_order, p.manufacturers_id, p.products_price, p.products_tax_class_id from  " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " pc where p.products_id = pd.products_id and pd.language_id = " . (int)$languages_id . " and p.products_id = pc.products_id and pc.categories_id = " . (int)$current_category_id . " $sort_by ";
                                                        }
                                                    }

                                                    if($search_pd_name && $search_model){
                                                        if ($current_category_id == 0) {
                                                            if ($manufacturer) {
                                                                $products_query_raw = "select p.products_id, pd.products_head_title_tag, pd.products_head_desc_tag, " . $products_price_list . ", p.products_image, p.products_model, pd.products_name, p.products_status, p.products_weight, p.products_quantity, p.products_quantity_order_min, p.products_quantity_order_units, p.products_sort_order, p.manufacturers_id, p.products_price, p.products_tax_class_id from  " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and pd.language_id = " . (int)$languages_id . " and p.manufacturers_id = " . (int)$manufacturer . " and pd.products_name like '%" . $search_pd_name . "%'" . " and p.products_model like '%" . $search_model . "%'" . " $sort_by ";
                                                            } else {
                                                                $products_query_raw = "select p.products_id, pd.products_head_title_tag, pd.products_head_desc_tag, " . $products_price_list . ", p.products_image, p.products_model, pd.products_name, p.products_status, p.products_weight, p.products_quantity, p.products_quantity_order_min, p.products_quantity_order_units, p.products_sort_order, p.manufacturers_id, p.products_price, p.products_tax_class_id from  " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and pd.language_id = " . (int)$languages_id . " and pd.products_name like '%" . $search_pd_name . "%'" . " and p.products_model like '%" . $search_model . "%'" . " $sort_by ";
                                                            }
                                                        } else {
                                                            if ($manufacturer) {
                                                                $products_query_raw = "select p.products_id, pd.products_head_title_tag, pd.products_head_desc_tag, " . $products_price_list . ", p.products_image, p.products_model, pd.products_name, p.products_status, p.products_weight, p.products_quantity, p.products_quantity_order_min, p.products_quantity_order_units, p.products_sort_order, p.manufacturers_id, p.products_price, p.products_tax_class_id from  " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " pc where p.products_id = pd.products_id and pd.language_id = " . (int)$languages_id . " and p.products_id = pc.products_id and pc.categories_id = " . (int)$current_category_id . " and p.manufacturers_id = " . (int)$manufacturer . " and pd.products_name like '%" . $search_pd_name . "%'" . " and p.products_model like '%" . $search_model . "%'" . " $sort_by ";
                                                            } else {
                                                                $products_query_raw = "select p.products_id, pd.products_head_title_tag, pd.products_head_desc_tag, " . $products_price_list . ", p.products_image, p.products_model, pd.products_name, p.products_status, p.products_weight, p.products_quantity, p.products_quantity_order_min, p.products_quantity_order_units, p.products_sort_order, p.manufacturers_id, p.products_price, p.products_tax_class_id from  " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " pc where p.products_id = pd.products_id and pd.language_id = " . (int)$languages_id . " and p.products_id = pc.products_id and pc.categories_id = " . (int)$current_category_id . " and pd.products_name like '%" . $search_pd_name . "%'" . " and p.products_model like '%" . $search_model . "%'" . " $sort_by ";
                                                            }
                                                        }
                                                    }elseif ($search_pd_name){
                                                        if ($current_category_id == 0) {
                                                            if ($manufacturer) {
                                                                $products_query_raw = "select p.products_id, pd.products_head_title_tag, pd.products_head_desc_tag, " . $products_price_list . ", p.products_image, p.products_model, pd.products_name, p.products_status, p.products_weight, p.products_quantity, p.products_quantity_order_min, p.products_quantity_order_units, p.products_sort_order, p.manufacturers_id, p.products_price, p.products_tax_class_id from  " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and pd.language_id = " . (int)$languages_id . " and p.manufacturers_id = " . (int)$manufacturer . " and pd.products_name like '%" . $search_pd_name . "%'" . " $sort_by ";
                                                            } else {
                                                                $products_query_raw = "select p.products_id, pd.products_head_title_tag, pd.products_head_desc_tag, " . $products_price_list . ", p.products_image, p.products_model, pd.products_name, p.products_status, p.products_weight, p.products_quantity, p.products_quantity_order_min, p.products_quantity_order_units, p.products_sort_order, p.manufacturers_id, p.products_price, p.products_tax_class_id from  " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and pd.language_id = " . (int)$languages_id . " and pd.products_name like '%" . $search_pd_name . "%'" . " $sort_by ";
                                                            }
                                                        } else {
                                                            if ($manufacturer) {
                                                                $products_query_raw = "select p.products_id, pd.products_head_title_tag, pd.products_head_desc_tag, " . $products_price_list . ", p.products_image, p.products_model, pd.products_name, p.products_status, p.products_weight, p.products_quantity, p.products_quantity_order_min, p.products_quantity_order_units, p.products_sort_order, p.manufacturers_id, p.products_price, p.products_tax_class_id from  " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " pc where p.products_id = pd.products_id and pd.language_id = " . (int)$languages_id . " and p.products_id = pc.products_id and pc.categories_id = " . (int)$current_category_id . " and p.manufacturers_id = " . (int)$manufacturer . " and pd.products_name like '%" . $search_pd_name . "%'" . " $sort_by ";
                                                            } else {
                                                                $products_query_raw = "select p.products_id, pd.products_head_title_tag, pd.products_head_desc_tag, " . $products_price_list . ", p.products_image, p.products_model, pd.products_name, p.products_status, p.products_weight, p.products_quantity, p.products_quantity_order_min, p.products_quantity_order_units, p.products_sort_order, p.manufacturers_id, p.products_price, p.products_tax_class_id from  " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " pc where p.products_id = pd.products_id and pd.language_id = " . (int)$languages_id . " and p.products_id = pc.products_id and pc.categories_id = " . (int)$current_category_id . " and pd.products_name like '%" . $search_pd_name . "%'" . " $sort_by ";
                                                            }
                                                        }
                                                    }elseif ($search_model){
                                                        if ($current_category_id == 0) {
                                                            if ($manufacturer) {
                                                                $products_query_raw = "select p.products_id, pd.products_head_title_tag, pd.products_head_desc_tag, " . $products_price_list . ", p.products_image, p.products_model, pd.products_name, p.products_status, p.products_weight, p.products_quantity, p.products_quantity_order_min, p.products_quantity_order_units, p.products_sort_order, p.manufacturers_id, p.products_price, p.products_tax_class_id from  " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and pd.language_id = " . (int)$languages_id . " and p.manufacturers_id = " . (int)$manufacturer . " and p.products_model like '%" . $search_model . "%'" . " $sort_by ";
                                                            } else {
                                                                $products_query_raw = "select p.products_id, pd.products_head_title_tag, pd.products_head_desc_tag, " . $products_price_list . ", p.products_image, p.products_model, pd.products_name, p.products_status, p.products_weight, p.products_quantity, p.products_quantity_order_min, p.products_quantity_order_units, p.products_sort_order, p.manufacturers_id, p.products_price, p.products_tax_class_id from  " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and pd.language_id = " . (int)$languages_id . " and p.products_model like '%" . $search_model . "%'" . " $sort_by ";
                                                            }
                                                        } else {
                                                            if ($manufacturer) {
                                                                $products_query_raw = "select p.products_id, pd.products_head_title_tag, pd.products_head_desc_tag, " . $products_price_list . ", p.products_image, p.products_model, pd.products_name, p.products_status, p.products_weight, p.products_quantity, p.products_quantity_order_min, p.products_quantity_order_units, p.products_sort_order, p.manufacturers_id, p.products_price, p.products_tax_class_id from  " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " pc where p.products_id = pd.products_id and pd.language_id = " . (int)$languages_id . " and p.products_id = pc.products_id and pc.categories_id = " . (int)$current_category_id . " and p.manufacturers_id = " . (int)$manufacturer . " and p.products_model like '%" . $search_model . "%'" . " $sort_by ";
                                                            } else {
                                                                $products_query_raw = "select p.products_id, pd.products_head_title_tag, pd.products_head_desc_tag, " . $products_price_list . ", p.products_image, p.products_model, pd.products_name, p.products_status, p.products_weight, p.products_quantity, p.products_quantity_order_min, p.products_quantity_order_units, p.products_sort_order, p.manufacturers_id, p.products_price, p.products_tax_class_id from  " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " pc where p.products_id = pd.products_id and pd.language_id = " . (int)$languages_id . " and p.products_id = pc.products_id and pc.categories_id = " . (int)$current_category_id . " and p.products_model like '%" . $search_model . "%'" . " $sort_by ";
                                                            }
                                                        }
                                                    }

												    //// page splitter and display each products info
												    $products_split = new splitPageResults($split_page, MAX_DISPLAY_ROW_BY_PAGE, $products_query_raw, $products_query_numrows);
												    $products_query = tep_db_query($products_query_raw);
												    while ($products = tep_db_fetch_array($products_query)) {
													    $rows++;
													    if (strlen($rows) < 2) {
														    $rows = '0' . $rows;
													    }
//// check for global add value or rates, calcul and round values rates
													    if ($_POST['spec_price']) {
														    $flag_spec = 'true';
														    if (substr($_POST['spec_price'], -1) == '%') {
															    if ($_POST['marge'] && substr($_POST['spec_price'], 0, 1) != '-') {
																    $valeur = (1 - (preg_replace('/%/', "", $_POST['spec_price']) / 100));
																    $price = sprintf("%01.2f", round($products['products_price'] / $valeur, 2));
															    } else {
																    $price = sprintf("%01.2f", round($products['products_price'] + (($_POST['spec_price'] / 100) * $products['products_price']), 2));
															    }
														    } else {
															    $price = sprintf("%01.2f", round($products['products_price'] + $_POST['spec_price'], 2));
														    }
													    } else {
														    $price = $products['products_price'];
													    }

//// Check Tax_rate for displaying TTC
													    $tax_query = tep_db_query("select r.tax_rate, c.tax_class_title from " . TABLE_TAX_RATES . " r, " . TABLE_TAX_CLASS . " c where r.tax_class_id=" . (int)$products['products_tax_class_id'] . " and c.tax_class_id=" . (int)$products['products_tax_class_id']);
													    $tax_rate = tep_db_fetch_array($tax_query);
													    if ($tax_rate['tax_rate'] == '') {
														    $tax_rate['tax_rate'] = 0;
													    }

													    if (MODIFY_MANUFACTURER == 'false') {
														    $manufacturer_query = tep_db_query("select manufacturers_name from " . TABLE_MANUFACTURERS_INFO . " where languages_id = " . (int)$languages_id . " and manufacturers_id=" . (int)$products['manufacturers_id']);
														    $manufacturer = tep_db_fetch_array($manufacturer_query);
													    }
//// display infos per row
													    if ($flag_spec) {
														    echo '<tr class="dataTableRow" onmouseover="';
														    if (DISPLAY_TVA_OVER == 'true') {
															    echo 'display_ttc(\'display\', ' . $price . ', ' . $tax_rate['tax_rate'] . ');';
														    }
														    echo 'this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="';
														    if (DISPLAY_TVA_OVER == 'true') {
															    echo 'display_ttc(\'delete\');';
														    }
														    echo 'this.className=\'dataTableRow\'">';
													    } else {
														    echo '<tr class="dataTableRow" onmouseover="';
														    if (DISPLAY_TVA_OVER == 'true') {
															    echo 'display_ttc(\'display\', ' . $products['products_price'] . ', ' . $tax_rate['tax_rate'] . ');';
														    }
														    echo 'this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="';
														    if (DISPLAY_TVA_OVER == 'true') {
															    echo 'display_ttc(\'delete\', \'\', \'\', 0);';
														    }
														    echo 'this.className=\'dataTableRow\'">';
													    }
													    if (DISPLAY_MODEL == 'true') {
														    if (MODIFY_MODEL == 'true') {
															    echo "<td class=\"smallText\" align=\"left\"><input type=\"text\" size=\"14\" name=\"product_new_model[" . $products['products_id'] . "]\" value=\"" . $products['products_model'] . "\"></td>\n";
														    } else {
															    echo "<td class=\"smallText\" align=\"left\">" . $products['products_model'] . "</td>";
														    }
													    } else {
														    echo "<td class=\"smallText\" align=\"left\"></td>";
													    }

													    //  if (in_array($products['products_id'], $specials_array)) {
													    //      echo "<td class=\"smallText\" valign=\"middle\" align=\"left\">&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" size=\"6\" name=\"product_new_price[" . $products['products_id'] . "]\" value=\"" . $products['products_price'] . "\" disabled >&nbsp;<a href=\"" . tep_href_link(FILENAME_SPECIALS, 'sID=' . $products['products_id']) . "\" class=\"spec_link\">" . tep_image(DIR_WS_IMAGES . 'icon_info.gif', TEXT_SPECIALS_PRODUCTS) . "</a>";
													    //  } else {
													    if ($flag_spec == 'true') {
														    echo "<td class=\"smallText\" align=\"left\"><input type=\"text\" size=\"6\" name=\"product_new_price[" . $products['products_id'] . "]\" ";
														    if (DISPLAY_TVA_UP == 'true') {
															    echo "onKeyUp=\"display_ttc('keyup', this.value" . ", " . $tax_rate['tax_rate'] . ", 1);\"";
														    }
														    echo " value=\"" . $price . "\">" . tep_draw_checkbox_field('update_price[' . $products['products_id'] . ']', 'yes', 'checked', 'no') . "";
													    } else {
														    echo "<td class=\"smallText\" align=\"left\"><input type=\"text\" size=\"6\" name=\"product_new_price[" . $products['products_id'] . "]\" ";
														    if (DISPLAY_TVA_UP == 'true') {
															    echo "onKeyUp=\"display_ttc('keyup', this.value" . ", " . $tax_rate['tax_rate'] . ", 1);\"";
														    }
														    echo " value=\"" . $price . "\">" . tep_draw_hidden_field('update_price[' . $products['products_id'] . ']', 'yes') . "";
													    }
													    // }
													    $prices_num = tep_xppp_getpricesnum();
													    for ($i = 2; $i <= $prices_num; $i++) {
														    echo $i . '. ' . tep_draw_input_field("products_price_" . $i . '[' . $products['products_id'] . ']', $products["products_price_" . $i], 'size=6');
													    }
													    echo '</td>';


													    // Editable Specials:
													    echo "<td class=\"smallText\" align=\"center\"><input type=\"text\" size=\"6\" name=\"product_new_special_price[" . $products['products_id'] . "]\" value=\"" . $specials_array[$products['products_id']] . "\"></td>";


													    /*
																	 $products_price_list = tep_xppp_getpricelist("");

																			  $product_query = tep_db_query("select products_quantity, products_model, products_image, ". $products_price_list . ", products_date_available, products_weight, products_tax_class_id, products_quantity_order_min, products_quantity_order_units, products_sort_order, manufacturers_id from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'");
																			  $product = tep_db_fetch_array($product_query);
																			  print_r($product);
																						 //TotalB2B start
																						 $prices_num = tep_xppp_getpricesnum();
																						 $products_instval = '';
																						 for($i=2; $i<=$prices_num; $i++) {
																							  if ($product['products_price_' . $i] == NULL) $products_instval .= "NULL, ";
																							  else $products_instval .= "'" . tep_db_input($product['products_price_' . $i]) . "', ";
																						 }
																						 $products_instval .= "'" . tep_db_input($product['products_price']) . "' ";
																						 tep_db_query("insert into " . TABLE_PRODUCTS . " (products_quantity, products_model, products_image, ". $products_price_list . ", products_date_added, products_date_available, products_weight, products_status, products_tax_class_id, products_quantity_order_min, products_quantity_order_units, products_sort_order, manufacturers_id) values ('" . tep_db_input($product['products_quantity']) . "', '" . tep_db_input($product['products_model']) . "', '" . tep_db_input($product['products_image']) . "', " . $products_instval . ",  now(), " . (empty($product['products_date_available']) ? "null" : "'" . tep_db_input($product['products_date_available']) . "'") . ", '" . tep_db_input($product['products_weight']) . "', '0', '" . (int)$product['products_tax_class_id'] . "', '" . (int)$product['products_quantity_order_min'] . "', '" . (int)$product['products_quantity_order_units'] . "', '" . (int)$product['products_sort_order'] . "', '" . (int)$product['manufacturers_id'] . "')");
																						 //TotalB2B end
																			*/

													    if (MODIFY_NAME == 'true') {
														    echo "<td class=\"smallText\" align=\"left\"><input type=\"text\" size=\"35\" name=\"product_new_name[" . $products['products_id'] . "]\" value=\"" . htmlspecialchars($products['products_name']) . "\"></td>\n";
													    } else {
														    echo "<td class=\"smallText\" align=\"left\">" . $products['products_name'] . "</td>\n";
													    }
													    echo "<td class=\"smallText\" align=\"left\"><input type=\"text\" size=\"20\" name=\"product_new_head_title_tag[" . $products['products_id'] . "]\" value=\"" . $products['products_head_title_tag'] . "\"></td>\n";
													    echo "<td class=\"smallText\" align=\"left\"><input type=\"text\" size=\"20\" name=\"product_new_head_desc_tag[" . $products['products_id'] . "]\" value=\"" . $products['products_head_desc_tag'] . "\"></td>\n";
////// Product status radio button
//// Product status radio button
													    if (DISPLAY_STATUT == 'true') {
														    if ($products['products_status'] == '1') {
															    echo "<td class=\"smallText\" align=\"center\"><input  type=\"radio\" name=\"product_new_status[" . $products['products_id'] . "]\" value=\"0\" ><input type=\"radio\" name=\"product_new_status[" . $products['products_id'] . "]\" value=\"1\" checked ></td>\n";
														    } else {
															    echo "<td class=\"smallText\" align=\"center\"><input type=\"radio\" style=\"background-color: #EEEEEE\" name=\"product_new_status[" . $products['products_id'] . "]\" value=\"0\" checked ><input type=\"radio\" style=\"background-color: #EEEEEE\" name=\"product_new_status[" . $products['products_id'] . "]\" value=\"1\"></td>\n";
														    }
													    }
													    if (DISPLAY_WEIGHT == 'true') {
														    echo "<td class=\"smallText\" align=\"center\"><input type=\"text\" size=\"5\" name=\"product_new_weight[" . $products['products_id'] . "]\" value=\"" . $products['products_weight'] . "\"></td>\n";
													    }
													    if (DISPLAY_QUANTITY == 'true') {
														    echo "<td class=\"smallText\" align=\"center\"><input type=\"text\" size=\"3\" name=\"product_new_quantity[" . $products['products_id'] . "]\" value=\"" . $products['products_quantity'] . "\"></td>\n";
													    }
													    if (DISPLAY_SORT_ORDER == 'true') {
														    echo "<td class=\"smallText\" align=\"center\"><input type=\"text\" size=\"3\" name=\"product_new_sort_order[" . $products['products_id'] . "]\" value=\"" . $products['products_sort_order'] . "\"></td>\n";
													    }
													    if (DISPLAY_ORDER_MIN == 'true') {
														    echo "<td class=\"smallText\" align=\"center\"><input type=\"text\" size=\"3\" name=\"product_new_quantity_order_min[" . $products['products_id'] . "]\" value=\"" . $products['products_quantity_order_min'] . "\"></td>\n";
													    }
													    if (DISPLAY_ORDER_UNITS == 'true') {
														    echo "<td class=\"smallText\" align=\"center\"><input type=\"text\" size=\"3\" name=\"product_new_quantity_order_units[" . $products['products_id'] . "]\" value=\"" . $products['products_quantity_order_units'] . "\"></td>\n";
													    }
//                                                    if (DISPLAY_IMAGE == 'true') echo "<td class=\"smallText\" align=\"center\"><input type=\"text\" size=\"8\" name=\"product_new_image[" . $products['products_id'] . "]\" value=\"" . $products['products_image'] . "\"></td>\n"; else echo "<td class=\"smallText\" align=\"left\"></td>";
													    if (DISPLAY_MANUFACTURER == 'true') {
														    if (MODIFY_MANUFACTURER == 'true') {
															    echo "<td class=\"smallText\" align=\"center\">" . tep_draw_pull_down_menu("product_new_manufacturer[" . $products['products_id'] . "]\"", $manufacturers_array, $products['manufacturers_id']) . "</td>\n";
														    } else {
															    echo "<td class=\"smallText\" align=\"left\">" . $manufacturer['manufacturers_name'] . "</td>";
														    }
													    }
//// check specials
//        if ( in_array($products['products_id'],$specials_array)) {
//            echo "<td class=\"smallText\" align=\"center\">&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" size=\"6\" name=\"product_new_price[".$products['products_id']."]\" value=\"".$products['products_price']."\" disabled >&nbsp;<a href=\"".tep_href_link (FILENAME_SPECIALS, 'sID='.$products['products_id'])."\">". tep_image(DIR_WS_IMAGES . 'icon_info.gif', TEXT_SPECIALS_PRODUCTS) ."</a></td>\n";
//        } else {
//           if ($flag_spec == 'true') {
//                  echo "<td class=\"smallText\" align=\"center\">&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" size=\"6\" name=\"product_new_price[".$products['products_id']."]\" "; if(DISPLAY_TVA_UP == 'true'){ echo "onKeyUp=\"display_ttc('keyup', this.value" . ", " . $tax_rate['tax_rate'] . ", 1);\"";} echo " value=\"".$price ."\">".tep_draw_checkbox_field('update_price['.$products['products_id'].']','yes','checked','no')."</td>\n";
//            } else { echo "<td class=\"smallText\" align=\"center\">&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" size=\"6\" name=\"product_new_price[".$products['products_id']."]\" "; if(DISPLAY_TVA_UP == 'true'){ echo "onKeyUp=\"display_ttc('keyup', this.value" . ", " . $tax_rate['tax_rate'] . ", 1);\"";} echo " value=\"".$price ."\">".tep_draw_hidden_field('update_price['.$products['products_id'].']','yes'). "</td>\n";}
//        }
													    if (DISPLAY_TAX == 'true') {
														    if (MODIFY_TAX == 'true') {
															    echo "<td class=\"smallText\" align=\"center\">" . tep_draw_pull_down_menu("product_new_tax[" . $products['products_id'] . "]\"", $tax_class_array, $products['products_tax_class_id']) . "</td>\n";
														    } else {
															    echo "<td class=\"smallText\" align=\"center\">" . $tax_rate['tax_class_title'] . "</td>";
														    }
													    }
//// links to preview or full edit
													    if (DISPLAY_PREVIEW == 'true') {
														    echo "<td class=\"smallText\" align=\"center\"><a href=\"" . tep_href_link(FILENAME_PRODUCTS, 'pID=' . $products['products_id'] . '&action=new_product_preview&read=only&sort_by=' . $sort_by . '&page=' . $split_page . '&origin=' . $origin) . "\">" . tep_image(DIR_WS_IMAGES . 'icon_info.gif', TEXT_IMAGE_PREVIEW) . "</a></td>\n";
													    }
													    if (DISPLAY_EDIT == 'true') {
														    echo "<td class=\"smallText\" align=\"center\"><a href=\"" . tep_href_link(FILENAME_PRODUCTS, 'pID=' . $products['products_id'] . '&cPath=' . $categories_products[0] . '&action=new_product') . "\">" . tep_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', TEXT_IMAGE_SWITCH_EDIT) . "</a></td>\n";
													    }

//// Hidden parameters for cache old values
													    if (MODIFY_NAME == 'true') {
														    echo tep_draw_hidden_field('product_old_name[' . $products['products_id'] . '] ', $products['products_name']);
													    }
													    echo tep_draw_hidden_field('product_old_head_title_tag[' . $products['products_id'] . '] ', $products['products_head_title_tag']);
													    echo tep_draw_hidden_field('product_old_head_desc_tag[' . $products['products_id'] . '] ', $products['products_head_desc_tag']);
													    if (MODIFY_MODEL == 'true') {
														    echo tep_draw_hidden_field('product_old_model[' . $products['products_id'] . '] ', $products['products_model']);
													    }
													    echo tep_draw_hidden_field('product_old_status[' . $products['products_id'] . ']', $products['products_status']);
													    echo tep_draw_hidden_field('product_old_quantity[' . $products['products_id'] . ']', $products['products_quantity']);
													    echo tep_draw_hidden_field('product_old_sort_order[' . $products['products_id'] . ']', $products['products_sort_order']);
													    echo tep_draw_hidden_field('product_old_quantity_order_min[' . $products['products_id'] . ']', $products['products_quantity_order_min']);
													    echo tep_draw_hidden_field('product_old_quantity_order_units[' . $products['products_id'] . ']', $products['products_quantity_order_units']);
													    echo tep_draw_hidden_field('product_old_image[' . $products['products_id'] . ']', $products['products_image']);
													    if (MODIFY_MANUFACTURER == 'true') {
														    echo tep_draw_hidden_field('product_old_manufacturer[' . $products['products_id'] . ']', $products['manufacturers_id']);
													    }
													    echo tep_draw_hidden_field('product_old_weight[' . $products['products_id'] . ']', $products['products_weight']);
													    echo tep_draw_hidden_field('product_old_price[' . $products['products_id'] . ']', $products['products_price']);
													    echo tep_draw_hidden_field('product_old_special_price[' . $products['products_id'] . ']', $specials_array[$products['products_id']]);
													    if (MODIFY_TAX == 'true') {
														    echo tep_draw_hidden_field('product_old_tax[' . $products['products_id'] . ']', $products['products_tax_class_id']);
													    }
//// hidden display parameters
													    echo tep_draw_hidden_field('row_by_page', $row_by_page);
													    echo tep_draw_hidden_field('sort_by', $sort_by);
													    echo tep_draw_hidden_field('page', $split_page);
												    }
												    echo "</table>\n";

												    ?>
												    </td>
											    </tr>
										    </table>
									    </td>
								    </tr>
								    <tr>
									    <td align="right" class="back_btn_wrap" style="padding-top: 20px;">
										    <?php
										    //// display bottom page buttons
										    echo '<a class="back_btn" href="javascript:window.print()">' . tep_text_button(BUTTON_PRINT_NEW) . '</a>&nbsp;&nbsp;';
										    echo '<span class="new_product_btn">' . tep_image_submit('button_update.gif', IMAGE_UPDATE) . '</span>';
										    echo '&nbsp;&nbsp;<a class="specials_del_btn" href="' . tep_href_link(FILENAME_QUICK_UPDATES, "row_by_page=$row_by_page") . '">' . tep_text_button(BUTTON_CANCEL_NEW) . '</a>';
										    ?></td>
								    </tr>
								    </form>
								    <td>
									    <table class="table_nav" border="0" width="100%" cellspacing="0" cellpadding="2">
										    <td class="smallText"
											     valign="top"><?php echo $products_split->display_count($products_query_numrows, MAX_DISPLAY_ROW_BY_PAGE, $split_page, TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
										    <td class="smallText"
											     align="right"><?php echo $products_split->display_links($products_query_numrows, MAX_DISPLAY_ROW_BY_PAGE, MAX_DISPLAY_PAGE_LINKS, $split_page, '&cPath=' . $current_category_id . '&manufacturer=' . $manufacturer . '&sort_by=' . $sort_by . '&row_by_page=' . $row_by_page); ?></td>
									    </table>
								    </td>
								    </tr>
							    </table>
						    </div>
					    </td>
				    </tr>
			    </table>
		    </td>
		    <!-- body_text_smend //-->
	    </tr>
    </table>
    <!-- body_smend //-->
    </tr>
    </table>
    </body>
    </html>
<script type="text/javascript">
    $('select[name=cPath]').on('change', function (){
        if($('select[name=cPath]').val() !== ''){
            $('form[name=categorie]').submit();
        }
    })
</script>
<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>