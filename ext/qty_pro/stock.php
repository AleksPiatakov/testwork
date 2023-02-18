<?php
if (
    !defined('FILENAME_PRODUCTS') ||
    !strstr($PHP_SELF, FILENAME_PRODUCTS) ||
    $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'
) {
    $rootPath = __DIR__ . '/../../';
    chdir($rootPath);
    require_once($rootPath . '/includes/application_top.php');
} else {
    $_GET['product_id'] = $_GET['pID'] ?: $_GET['product_id'];
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $VARS = $_GET;
} else {
    $VARS = $_POST;
}

switch ($VARS['action']) {
    case 'insert_attribute_combination':
        $error = false;

        //check that product_id is numeric
        if (!is_numeric($VARS['product_id'])) {
            $error = true;
        }

        //check that option_id is numeric and collect options
        foreach ($VARS as $v1 => $v2) {
            if (preg_match("/^option(\d+)$/", $v1, $m1)) {
                if (is_numeric($v2)) {
                    $val_array[] = $m1[1] . "-" . $v2;
                } else {
                    $error = true;
                }
            }
        }

        //check that quantity is numeric
        if (!is_numeric($VARS['quantity'])) {
            $error = true;
        }

        //validate
        if (!$error) {
            //sort new values by id
            sort($val_array, SORT_NUMERIC);
            //join ids to string
            $val = join(",", $val_array);
            //check attribute combination of product in DB
            $query = tep_db_query("select products_stock_id as stock_id 
                from " . TABLE_PRODUCTS_STOCK . " 
                where products_id = " . (int)$VARS['product_id'] . " 
                and products_stock_attributes = '" . $val . "' 
                order by products_stock_attributes");
            if (tep_db_num_rows($query) > 0) {
                //update values of attribute combination
                $stock_item = tep_db_fetch_array($query);
                $stock_id = $stock_item['stock_id'];
                tep_db_query("update " . TABLE_PRODUCTS_STOCK . " set 
                    products_stock_quantity = " . (int)$VARS['quantity'] . ", 
                    products_combination_price = '" . $VARS['combination_price'] . "', 
                    products_vendor_code = '" . $VARS['vendor_code'] . "' 
                    where products_stock_id = " . $stock_id);
            } else {
                //insert values of attribute combination
                tep_db_query("insert into " . TABLE_PRODUCTS_STOCK . " 
                ( products_id, products_stock_attributes, products_stock_quantity, products_combination_price, products_vendor_code) 
                values (" . (int)$VARS['product_id'] . ",'" . $val . "'," . (int)$VARS['quantity'] . ",'" . $VARS['combination_price'] . "','" . $VARS['vendor_code'] . "')");
            }
        }
        break;
    case 'Delete':
        tep_db_query("delete from " . TABLE_PRODUCTS_STOCK . "  where products_id = " . (int)$VARS['product_id'] . " and products_stock_quantity=" . (int)$VARS['quantity']);
        break;
}

//collect product attributes info
$query = tep_db_query($sql = "select pa.options_id, 
                            po.products_options_name as options_name,
                            pov.products_options_values_name as options_values_name,
                            pa.options_values_id as values_id 
    from products_attributes pa
    INNER JOIN products_options po ON po.products_options_id = pa.options_id and po.language_id = " . (int)$languages_id . " 
    INNER JOIN products_options_values pov ON pov.products_options_values_id = pa.options_values_id and pov.language_id = " . (int)$languages_id . "
    where pa.products_id = " . (int)$VARS['product_id'] . " 
    /*and po.products_options_type != 0 */
    order by pa.options_id, pa.options_values_id");

if (tep_db_num_rows($query) > 0) {
    while ($row = tep_db_fetch_array($query)) {
        $options[$row['options_id']][] = array($row['options_values_name'], $row['values_id']);
        $option_names[$row['options_id']] = $row['options_name'];
    }
} else {
    $query = tep_db_query("select products_quantity,products_name from " . TABLE_PRODUCTS . " p,products_description pd where pd.products_id=" . (int)$VARS['product_id'] . " and p.products_id=" . (int)$VARS['product_id']);
    $row = tep_db_fetch_array($query);
    $db_quantity = $row['products_quantity'];
}

//remove product options with one value
if (!empty($options)) {
    foreach ($options as $key => $value) {
        if (count($value) <= 1) {
            unset($options[$key]);
        }
    }
}

//end if ajax
if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    exit;
}

//display header html if isn`t loading in tab on product page
if (!strstr($PHP_SELF, FILENAME_PRODUCTS) && $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
    include_once(DIR_FS_ADMIN . '/html-open.php');
    include_once(DIR_FS_ADMIN . '/header.php');
}

//display main content
if (!empty($options)) { ?>
    <form action="<?php echo $PHP_SELF; ?>" method=get>
        <table id="qty_pro" style="width: max-content;">
            <tr class="dataTableHeadingRow">
                <?php
                //display heading columns attributes
                foreach ($options as $k => $v) {
                    echo '<td class="dataTableHeadingContent">' . $option_names[$k] . '</td>';
                }
                //display heading columns attributes combination params and actions
                echo '<td class="dataTableHeadingContent">
                        <span>' . TEXT_QTY_PRO_QUANTITY_LABEL . '</span>
                      </td>
                      <td class="dataTableHeadingContent">
                        <span>' . TEXT_QTY_PRO_COMBINATION_PRICE_LABEL . '</span>
                      </td>
                      <td class="dataTableHeadingContent">
                        <span>' . TEXT_QTY_PRO_VENDOR_CODE_LABEL . '</span>
                      </td>
                      <td> </td>';
                echo '</tr>';

                //get product attributes combination info
                $newCombinationList = $stocks = [];
                $query = tep_db_query("select * from " . TABLE_PRODUCTS_STOCK . " where products_id = " . $VARS['product_id'] . " order by products_stock_attributes ASC");
                while ($row = tep_db_fetch_array($query)) {
                    $stocks[$row['products_stock_attributes']] = $row['products_stock_id'];
                    //collect combination
                    $newCombination = [];
                    $val_array = explode(",", $row['products_stock_attributes']);
                    foreach ($val_array as $val) {
                        $combination = explode('-', $val);
                        $optionsArray[$combination[0]] = $combination[1];
                        if (in_array($combination[0], array_keys($options))) {
                            $newCombination[$combination[0]] = $combination[1];
                        }
                    }
                    //collect new combinations (if was removed any attribute)
                    if (count($val_array) > count(array_keys($options))) {
                        $parts = [];
                        foreach ($newCombination as $optionId => $optionVal) {
                            $parts[] = $optionId . '-' . $optionVal;
                        }
                        $newCombinationList[$row['products_stock_id']] = implode(',', $parts);
                        continue;
                    }

                    //display attribute combination row
                    echo '<tr class="dataTableRow">';
                    //display values of attributes
                    foreach (array_keys($options) as $optionId) {
                        if (!empty($optionsArray[$optionId])) {
                            echo '<td data-name="option' . $optionId . '" data-value="' . $optionsArray[$optionId] . '">
                                <div class="attribute_text">' . tep_values_name($optionsArray[$optionId]) . '</div>
                            </td>';
                        } else {
                            echo '<td> </td>';
                        }
                    }
                    //display attributes combination params and actions
                    if (strstr($PHP_SELF, FILENAME_PRODUCTS)) {
                        echo '<td>
                                <input class="form-control" size="4" name="qty" value="' . $row['products_stock_quantity'] . '">
                              </td>
                              <td>
                                <input class="form-control" size="6" name="combination_price" value="' . $row['products_combination_price'] . '">
                              </td>
                              <td>
                                <input class="form-control" size="12" name="vendor_code" value="' . $row['products_vendor_code'] . '">
                              </td>
                              <td>
                                <button type="button" name="action" value="update_attribute_combination" data-value="update_attribute_combination">
                                    ' . IMAGE_UPDATE . '
                                </button>
                                <button type="button" name="action" value="delete_attribute_combination" data-value="delete_attribute_combination">
                                    ' . IMAGE_DELETE . '
                                </button>
                              </td>';
                    } else {
                        echo '<td>
                                <div class="attribute_text">' . $row['products_stock_quantity'] . '</div>
                               </td> 
                              <td></td> 
                              </tr>';
                    }
                }
                //save new combinations (if was removed any attribute)
                foreach ($newCombinationList as $stockId => $stock_attributes) {
                    if (empty($stocks[$stock_attributes])) {
                        tep_db_query("update " . TABLE_PRODUCTS_STOCK . " 
                        set products_stock_attributes = '" . $stock_attributes . "' 
                        where products_stock_id = " . (int)$stockId);
                    } else {
                        tep_db_query("delete from " . TABLE_PRODUCTS_STOCK . " 
                        where products_stock_id = " . (int)$stockId);
                    }
                }

                //display row to add new attribute combination
                reset($options);
                echo '<tr class="dataTableRow">';
                foreach ($options as $k => $v) {
                    echo '<td><select name="option' . $k . '" class="form-control">';
                    foreach ($v as $v1) {
                        echo "<option value=" . $v1[1] . ">" . $v1[0];
                    }
                    echo "</select></td>";
                }

                //hide href filepath
                echo '<input type="hidden" name="href" value="' . DIR_WS_EXT . 'qty_pro/' . FILENAME_STOCK . '" />';
                //display quantity and hide product id
                echo '<td>
                        <input type="text" name="quantity" class="form-control" size="4" value="' . $db_quantity . '">
                        <input type="hidden" name="product_id" value="' . $VARS['product_id'] . '">
                      </td>';
                //display price
                echo '<td>
                        <input type="text" name="combination_price" class="form-control" size="6" value="">
                      </td>';
                //display vendor code
                echo '<td>
                        <input type="text" name="vendor_code" class="form-control" size="12" value="">
                      </td>';
                //display action buttons
                echo '<td>
                        <button type="' . (strstr($PHP_SELF, FILENAME_PRODUCTS) ? 'button' : 'submit') . '"
                               name="action" value="insert_attribute_combination" 
                               data-value="insert_attribute_combination">' . getConstantValue('IMAGE_INSERT') . '</button>
                      </td>';
                ?>
            </tr>
        </table>
    </form>

    <?php
} else {
    echo '<div>' . TEXT_EMPTY_ATTRIBUTES . '</div>';
}

//display footer html if isn`t loading in tab on product page
if (!strstr($PHP_SELF, FILENAME_PRODUCTS) && $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
    include_once(DIR_FS_ADMIN . '/footer.php');
    include_once(DIR_FS_ADMIN . '/html-close.php'); ?>
    <?php require(DIR_WS_INCLUDES . 'application_bottom.php');
} ?>
