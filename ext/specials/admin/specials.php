<?php
require(DIR_WS_CLASSES . 'currencies.php');
$currencies = new currencies();
$action = (isset($_GET['action']) ? $_GET['action'] : '');
if (tep_not_null($action)) {
    switch ($action) {
        case 'setflag':
            tep_set_specials_status($_GET['id'], $_GET['flag']);
            tep_redirect(tep_href_link(FILENAME_SPECIALS,
                (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'sID=' . $_GET['id'], 'NONSSL'));
            break;
        case 'validate':
            $specials_id = tep_db_prepare_input($_POST['specials_id']);
            $products_id = tep_db_prepare_input($_POST['products_id']);
            //TotalB2B start
            $checkbox_customers_groups = tep_db_prepare_input($_POST['checkbox_customers_groups']);
            $customers_groups = tep_db_prepare_input($_POST['customers_groups']);
            if ($checkbox_customers_groups == false) {
                $customers_groups = 0;
            }

            $checkbox_customers = tep_db_prepare_input($_POST['checkbox_customers']);
            $customers = tep_db_prepare_input($_POST['customers']);
            if ($checkbox_customers == false) {
                $customers = 0;
            }

            //TotalB2B end
            // Validation
            $validate_response = [
                'success' => true,
                'message' => ''
            ];
            if (tep_not_null($products_id) && (tep_not_null($customers_groups) || tep_not_null($customers))) {
                $query = tep_db_query("
                    select 
                        products_id 
                    from 
                        " . TABLE_SPECIALS . " 
                    where 
                        products_id = '" . (int)$products_id . "' and 
                        customers_groups_id = '" . (int)$customers_groups . "' and 
                        customers_id = '" . (int)$customers . "'" . (tep_not_null($specials_id) ? " and 
                        specials_id !='" . $specials_id . "'" : "")
                );
                if ($query->num_rows > 0) {
                    $validate_response['message'] = TEXT_SPECIAL_ALREADY_EXIST;
                }
            }

            if (!tep_not_null($products_id)) {
                $validate_response['message'] = TEXT_EMPTY_PRODUCT;
            }

            /*if (!tep_not_null($customers_groups) && !tep_not_null($customers)) {
                $validate_response['message'] = TEXT_EMPTY_CUSTOMER;
            }*/

            if (!empty($validate_response['message'])) {
                $validate_response['success'] = false;
            }

            // END Validation
            echo json_encode($validate_response);
            die;
            break;
        case 'insert':
            // Prepare insert data
            $checkbox_customers_groups = tep_db_prepare_input($_POST['checkbox_customers_groups']);
            $customers_groups = tep_db_prepare_input($_POST['customers_groups']);
            if ($checkbox_customers_groups == false) {
                $customers_groups = 0;
                $price_column = 'products_price';
            } else {
                $customer_query = tep_db_query("select customers_groups_price from " . TABLE_CUSTOMERS_GROUPS . " WHERE g.customers_groups_id = " . (int) $customers_groups);
                $customer_query_result = tep_db_fetch_array($customer_query);
                $customer_price = $customer_query_result['customers_groups_price'];
                if ((int) $customer_price != 1) {
                    $price_column = 'products_price_' . $customer_price;
                }
            }
            $products_id = tep_db_prepare_input($_POST['products_id']);
            $attribute_combination_price = tep_db_prepare_input($_POST['attribute_combination_price']);
            $specials_price = tep_db_prepare_input($_POST['specials_price']);
            if (is_numeric($attribute_combination_price)) {
                $products_price = $attribute_combination_price;
            } else {
                $new_special_insert_query = tep_db_query("
                    select 
                        $price_column 
                    from 
                        " . TABLE_PRODUCTS . " 
                    where 
                        products_id = '" . (int)$products_id . "'"
                );
                $products_price = tep_db_fetch_array($new_special_insert_query);
                $products_price = $products_price['products_price'];
            }

            if (substr($specials_price, -1) == '%') {
                $specials_price = ($products_price - (($specials_price / 100) * $products_price));
            }

            if ($specials_price > $products_price) {
                $specials_price = $products_price;
            }
            if ($specials_price < 0) {
                $specials_price = 0;
            }
            $attribute_combination = tep_db_prepare_input($_POST['attribute_combination']);
            $start_date = tep_db_prepare_input($_POST['start_date']);
            $expires_date = tep_db_prepare_input($_POST['expires_date']);
            $checkbox_display_countdown = tep_db_prepare_input($_POST['display_countdown'] ? 1 : 0);
            //TotalB2B start

            $checkbox_customers = tep_db_prepare_input($_POST['checkbox_customers']);
            $customers = tep_db_prepare_input($_POST['customers']);
            if ($checkbox_customers == false) {
                $customers = 0;
            }//TotalB2B end

            //TotalB2B start
            tep_db_query("
                insert into 
                " . TABLE_SPECIALS . " 
                (
                    products_id, 
                    specials_new_products_price, 
                    attribute_combination,
                    specials_date_added, 
                    start_date, 
                    expires_date, 
                    display_countdown, 
                    status, 
                    customers_groups_id, 
                    customers_id
                ) values 
                (
                    '" . (int)$products_id . "', 
                    '" . tep_db_input($specials_price) . "', 
                    '" . tep_db_input($attribute_combination) . "', 
                    now(), 
                    '" . tep_db_input($start_date) . "', 
                    '" . tep_db_input($expires_date) . "', 
                    '" . $checkbox_display_countdown . "', 
                    '1', 
                    " . (int)$customers_groups . ", 
                    " . (int)$customers . "
                )"
            );
            //TotalB2B end
            tep_redirect(tep_href_link(FILENAME_SPECIALS, 'page=' . $_GET['page']));
            break;
        case 'update':
            // Prepare update data
            $specials_id = tep_db_prepare_input($_POST['specials_id']);
            $checkbox_customers_groups = tep_db_prepare_input($_POST['checkbox_customers_groups']);
            $customers_groups = tep_db_prepare_input($_POST['customers_groups']);
            if ($checkbox_customers_groups == false) {
                $customers_groups = 0;
                $price_column = 'products_price';
            } else {
                $customer_query = tep_db_query("select customers_groups_price from " . TABLE_CUSTOMERS_GROUPS . " WHERE g.customers_groups_id = " . (int) $customers_groups);
                $customer_query_result = tep_db_fetch_array($customer_query);
                $customer_price = $customer_query_result['customers_groups_price'];
                if ((int) $customer_price != 1) {
                    $price_column = 'products_price_' . $customer_price;
                }
            }
            $products_id = tep_db_prepare_input($_POST['products_id']);
            $attribute_combination_price = tep_db_prepare_input($_POST['attribute_combination_price']);
            $specials_price = tep_db_prepare_input($_POST['specials_price']);
            if (is_numeric($attribute_combination_price)) {
                $products_price = $attribute_combination_price;
            } else {
                $new_special_insert_query = tep_db_query("
                    select 
                        $price_column 
                    from 
                        " . TABLE_PRODUCTS . " 
                    where 
                        products_id = '" . (int)$products_id . "'"
                );
                $products_price = tep_db_fetch_array($new_special_insert_query);
                $products_price = $products_price['products_price'];
            }

            if (substr($specials_price, -1) == '%') {
                $specials_price = ($products_price - (($specials_price / 100) * $products_price));
            }

            if ($specials_price > $products_price) {
                $specials_price = $products_price;
            }
            if ($specials_price < 0) {
                $specials_price = 0;
            }
            $attribute_combination = tep_db_prepare_input($_POST['attribute_combination']);
            $start_date = tep_db_prepare_input($_POST['start_date']);
            $expires_date = tep_db_prepare_input($_POST['expires_date']);
            $checkbox_display_countdown = tep_db_prepare_input($_POST['display_countdown'] ? 1 : 0);
            //TotalB2B start

            $checkbox_customers = tep_db_prepare_input($_POST['checkbox_customers']);
            $customers = tep_db_prepare_input($_POST['customers']);
            if ($checkbox_customers == false) {
                $customers = 0;
            }//TotalB2B end

            //TotalB2B start
            tep_db_query("
                update " .
                    TABLE_SPECIALS . " 
                set 
                    specials_new_products_price = '" . tep_db_input($specials_price) . "', 
                    attribute_combination = '" . tep_db_input($attribute_combination) . "', 
                    specials_last_modified = now(), 
                    start_date = '" . tep_db_input($start_date) . "', 
                    expires_date = '" . tep_db_input($expires_date) . "', 
                    display_countdown = '" . $checkbox_display_countdown . "', 
                    customers_groups_id = " . (int)$customers_groups . ", 
                    customers_id = " . (int)$customers . " 
                where 
                    specials_id = '" . (int)$specials_id . "'"
            );
            //TotalB2B end
            tep_redirect(tep_href_link(FILENAME_SPECIALS, 'page=' . $_GET['page'] . '&sID=' . $specials_id));
            break;
        case 'deleteconfirm':
            $specials_id = tep_db_prepare_input($_GET['sID']);
            tep_db_query("delete from " . TABLE_SPECIALS . " where specials_id = '" . (int)$specials_id . "'");
            tep_redirect(tep_href_link(FILENAME_SPECIALS, 'page=' . $_GET['page']));
            break;
    }
}
include_once('html-open.php');
include_once('header.php');
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
    <title><?php echo TITLE; ?></title>
    <link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
    <link rel="stylesheet" href="includes/solomono/css/overwrite.css" type="text/css"/>
    <script type="text/javascript" src="../includes/javascript/lib/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="includes/javascript/jquery-ui-1.9.2.custom.min.js"></script>
    <link rel="stylesheet" href="../includes/javascript/jqueryui/css/smoothness/jquery-ui-1.10.4.custom.min.css">
    <script type="text/javascript" src="includes/autocomplete/jquery.autocomplete.js"></script>
    <script type="text/javascript" src="includes/autocomplete/ac.js"></script>
    <link type="text/css" rel="stylesheet" href="includes/autocomplete/ac.css"/>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- header //-->
<!-- header_smend //-->
<!-- body //-->
<table class="table_specials" border="0" width="100%" cellspacing="2" cellpadding="2">
    <tr>
        <!-- body_text //-->
        <td width="100%" valign="top">
            <table border="0" width="100%" cellspacing="0" cellpadding="2">
                <tr>
                    <td width="100%">
                        <?php include DIR_WS_TABS . "products_discounts.php"; ?>
                    </td>
                </tr>
                <tr>
                    <td width="100%">
                        <table border="0" width="100%" cellspacing="0" cellpadding="0">
                            <tr>
                                <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
                                <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.png',
                                        HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <?php
                if (($action == 'new') || ($action == 'edit')) {
                    $form_action = 'insert';
                    //TotalB2B start
                    $specials_array = [];
                    $specials_query = tep_db_query("
                        select 
                            p.products_id, 
                            s.customers_groups_id 
                        from 
                            " . TABLE_PRODUCTS . " p, 
                            " . TABLE_SPECIALS . " s 
                        where 
                            s.products_id = p.products_id"
                    );
                    while ($specials = tep_db_fetch_array($specials_query)) {
                        $specials_array[] = (int)$specials['products_id'] . ":" . (int)$specials['customers_groups_id'];
                    }

                    $specials_query = tep_db_query("
                        select 
                            p.products_id, 
                            s.customers_id 
                        from 
                            " . TABLE_PRODUCTS . " p, 
                            " . TABLE_SPECIALS . " s 
                        where 
                            s.products_id = p.products_id"
                    );
                    while ($specials = tep_db_fetch_array($specials_query)) {
                        $specials_array[] = (int)$specials['products_id'] . ":" . (int)$specials['customers_id'];
                    }

                    $input_groups = [];
                    if (file_exists(DIR_FS_EXT . 'customers_groups/customers_groups.php')) {
                        $customers_groups_query = tep_db_query("
                            select distinct 
                                customers_groups_name, 
                                customers_groups_id 
                            from 
                                " . TABLE_CUSTOMERS_GROUPS . " 
                            order by customers_groups_name"
                        );
                        $input_groups = [];
                        $all_groups = [];
                        $sde = 0;
                        while ($existing_groups = tep_db_fetch_array($customers_groups_query)) {
                            $input_groups[$sde++] = [
                                "id" => $existing_groups['customers_groups_id'],
                                "text" => $existing_groups['customers_groups_name']
                            ];
                            $all_groups[$existing_groups['customers_groups_id']] =
                                $existing_groups['customers_groups_name'];
                        }
                    }

                    $customers_query = tep_db_query("
                        select distinct 
                            customers_firstname, 
                            customers_lastname, 
                            customers_id 
                        from 
                            " . TABLE_CUSTOMERS . " 
                        order by 
                            customers_lastname, 
                            customers_firstname"
                    );
                    $input_customers = [];
                    $all_customers = [];
                    $sde = 0;
                    while ($existing_customers = tep_db_fetch_array($customers_query)) {
                        $input_customers[$sde++] = [
                            "id" => $existing_customers['customers_id'],
                            "text" => $existing_customers['customers_lastname'] . " " .
                                $existing_customers['customers_firstname']
                        ];
                        $all_customers[$existing_customers['customers_id']] =
                            $existing_customers['customers_lastname'] . " " .
                            $existing_customers['customers_firstname'];
                    }//TotalB2B end

                    $product_attributes = [
                        ['id'=>'','text'=>TEXT_SPECIALS_PRODUCT_WITHOUT_ATTRIBUTES],
                        ['id'=>'all','text'=>TEXT_SPECIALS_PRODUCT_All_ATTRIBUTES]
                    ];

                    if (($action == 'edit') && isset($_GET['sID'])) {
                        $form_action = 'update';

                        $product_query = tep_db_query("
                            select 
                                p.products_id, 
                                p.products_tax_class_id, 
                                pd.products_name, 
                                p.products_price, 
                                s.specials_new_products_price, 
                                s.attribute_combination, 
                                s.display_countdown, 
                                s.customers_id, 
                                s.customers_groups_id, 
                                s.start_date, 
                                s.expires_date,
                                ps.products_stock_attributes
                            from 
                                " . TABLE_PRODUCTS . " p 
                                JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd 
                                JOIN " . TABLE_SPECIALS . " s 
                                LEFT JOIN " . TABLE_PRODUCTS_STOCK . " ps on ps.products_id = p.products_id
                            where 
                                p.products_id = pd.products_id and 
                                pd.language_id = '" . (int)$languages_id . "' and 
                                p.products_id = s.products_id and 
                                s.specials_id = '" . (int)$_GET['sID'] . "'"
                        );
                        $product = tep_db_fetch_array($product_query);
                        if (count($product)) {
                            $sInfo = new objectInfo($product);
                        } else {
                            $sInfo = new objectInfo([]);
                        }

                        $product_attributes_query = tep_db_query("
                            select ps.products_stock_attributes, ps.products_vendor_code, ps.products_combination_price
                            from " . TABLE_PRODUCTS_STOCK . " ps
                            JOIN " . TABLE_SPECIALS . " s ON ps.products_id = s.products_id
                            where s.specials_id = " . (int)$_GET['sID'] .
                            " order by ps.products_vendor_code"
                        );

                        $product_attributes_price = 0;
                        while($product_attribute = tep_db_fetch_array($product_attributes_query)){
                            if ($product_attribute['products_stock_attributes'] == $sInfo->attribute_combination) {
                                $product_attributes_price = $product_attribute['products_combination_price'];
                            }
                            $product_attributes[] = [
                                'id' => $product_attribute['products_stock_attributes'],
                                'parameters' => ' data-price="' . $product_attribute['products_combination_price'] . '" ',
                                'text' => $product_attribute['products_vendor_code'] . ' (' . TBL_HEADING_PRICE . ':' . $product_attribute['products_combination_price'] . ')'
                            ];
                        }

                    } else {
                        $sInfo = new objectInfo([]);
                        // create an array of products on special, which will be excluded from the pull down menu of products
                        //// (when creating a new product on special)
                        $specials_array = [];
                        $specials_query = tep_db_query("
                            select 
                                p.products_id 
                            from 
                                " . TABLE_PRODUCTS . " p, 
                                " . TABLE_SPECIALS . " s 
                            where 
                                s.products_id = p.products_id"
                        );
                        while ($specials = tep_db_fetch_array($specials_query)) {
                            $specials_array[] = $specials['products_id'];
                        }
                    } ?>
                    <tr>
                        <form name="new_special" <?php echo 'action="' . tep_href_link(FILENAME_SPECIALS,
                                tep_get_all_get_params(['action', 'info', 'sID']) . 'action=' . $form_action,
                                'NONSSL') . '"'; ?> method="post"><?php if ($form_action == 'update') {
                                echo tep_draw_hidden_field('specials_id', $_GET['sID']);
                            } ?>
                            <td><br>
                                <table border="0" cellspacing="0" cellpadding="2" width="100%">
                                    <tr>
                                        <td class="main" width="200"><?php echo TEXT_SPECIALS_PRODUCT; ?>&nbsp;</td>
                                        <td class="main">
                                            <?php
                                            if (isset($sInfo->products_name)) {
                                                echo $sInfo->products_name . ' <small>('
                                                    . $currencies->format($sInfo->products_price) . ')</small>';
                                            } else {
                                                echo tep_draw_input_field('keywords', '',
                                                    'placeholder="' . TEXT_ENTER_NAME . '" id="searchpr" class="specials_keywords"');
                                                //echo tep_draw_products_pull_down('products_id', 'style="font-size:10px"', $specials_array);
                                            }


                                            echo tep_draw_hidden_field('products_id', (isset($sInfo->products_id) ? $sInfo->products_id : ''));
                                            echo tep_draw_hidden_field('products_price', (isset($sInfo->products_price) ? $sInfo->products_price : ''));
                                            if(getConstantValue('QTY_PRO_ENABLED') == 'true'){
                                                echo tep_draw_pull_down_menu('attribute_combination', $product_attributes, $sInfo->attribute_combination);
                                                echo tep_draw_hidden_field('attribute_combination_price', $product_attributes_price);
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <!--TotalB2B start-->
                                    <tr>
                                        <td class="main"><?php echo TEXT_SPECIALS_CUSTOMERS; ?>&nbsp;</td>
                                        <td class="main">
                                            <?php
                                            if ($sInfo->customers_id != 0) {
                                                echo tep_draw_pull_down_menu('customers', $input_customers,
                                                    (isset($sInfo->customers_id) ? $sInfo->customers_id : ''), '');
                                                ?>
                                                <input type="checkbox" name="checkbox_customers" checked value="false"
                                                       onClick="if (customers.disabled && checkbox_customers.checked) {
                                                           customers.disabled = false;
                                                           customers_groups.disabled = true;
                                                           checkbox_customers_groups.checked = false
                                                       } else {
                                                           customers.disabled = true;
                                                           customers_groups.disabled = true;
                                                       }">
                                            <?php
                                            } else {
                                                echo tep_draw_pull_down_menu('customers', $input_customers,
                                                    (isset($sInfo->customers_id) ? $sInfo->customers_id : ''),
                                                    'disabled');
                                                ?>
                                                <input type="checkbox" name="checkbox_customers" value="false"
                                                       onClick="if (customers.disabled && checkbox_customers.checked) {
                                                           customers.disabled = false;
                                                           customers_groups.disabled = true;
                                                           checkbox_customers_groups.checked = false
                                                       } else {
                                                           customers.disabled = true;
                                                           customers_groups.disabled = true;
                                                       }">
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="main"><?php echo TEXT_SPECIALS_GROUPS; ?>&nbsp;</td>
                                        <td class="main">
                                            <?php
                                            if ($sInfo->customers_groups_id != 0) {
                                                echo tep_draw_pull_down_menu(
                                                'customers_groups',
                                                $input_groups,
                                                isset($sInfo->customers_groups_id) ? $sInfo->customers_groups_id : '',
                                                ''
                                                );
                                                ?>
                                                <input type="checkbox" name="checkbox_customers_groups" checked
                                                       value="false"
                                                       onClick="
                                                       if (
                                                           customers_groups.disabled &&
                                                           checkbox_customers_groups.checked
                                                       ) {
                                                           checkbox_customers_groups.value = true;
                                                           customers_groups.disabled = false;
                                                           customers.disabled = true;
                                                           checkbox_customers.checked = false
                                                       } else {
                                                           checkbox_customers_groups.value = false;
                                                           customers_groups.disabled = true;
                                                           customers.disabled = true;
                                                       }">
                                            <?php
                                            } else {
                                                echo tep_draw_pull_down_menu(
                                                'customers_groups',
                                                $input_groups,
                                                isset($sInfo->customers_groups_id) ? $sInfo->customers_groups_id : '',
                                                'disabled'
                                                );
                                                ?>
                                                <input type="checkbox" name="checkbox_customers_groups" value="false"
                                                       onClick="
                                                       if (
                                                           customers_groups.disabled &&
                                                           checkbox_customers_groups.checked
                                                       ) {
                                                           checkbox_customers_groups.value = true;
                                                           customers_groups.disabled = false;
                                                           customers.disabled = true;
                                                           checkbox_customers.checked = false
                                                       } else {
                                                           checkbox_customers_groups.value = false;
                                                           customers_groups.disabled = true;
                                                           customers.disabled = true;
                                                       }"><?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <!--TotalB2B end-->
                                    <tr>
                                        <td class="main"><?php echo TEXT_SPECIALS_SPECIAL_PRICE; ?>&nbsp;</td>
                                        <td class="main">
                                            <?php echo tep_draw_input_field(
                                                'specials_price',
                                                isset($sInfo->specials_new_products_price) ?
                                                    $sInfo->specials_new_products_price : ''
                                            );
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="main"><?php echo TEXT_SPECIALS_START_DATE; ?>&nbsp;</td>
                                        <td class="main"><?php echo tep_draw_input_field('start_date',
                                                date_format(new DateTime($sInfo->start_date), 'Y-m-d'),
                                                'size="2" maxlength="2" class="cal-TextBox"', false, 'date') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="main"><?php echo TEXT_SPECIALS_EXPIRES_DATE; ?>&nbsp;</td>
                                        <td class="main"><?php echo tep_draw_input_field('expires_date',
                                                date_format(new DateTime($sInfo->expires_date), 'Y-m-d'),
                                                'size="2" maxlength="2" class="cal-TextBox"', false, 'date') ?></td>
                                    </tr>
                                    <tr>
                                        <td class="main"><?php echo TEXT_DISPLAY_COUNTDOWN; ?>&nbsp;</td>
                                        <td class="main">
                                            <input
                                                type="checkbox"
                                                name="display_countdown"
                                                value="<?php
                                                echo !empty($sInfo->display_countdown) ? $sInfo->display_countdown : 0;
                                                ?>"
                                                <?php echo $sInfo->display_countdown ? ' checked' : '' ?>
                                                onclick="
                                                $(this).prop('checked');
                                                if ($(this).is(':checked')) {
                                                    $(this).attr('value',1)
                                                } else {
                                                    $(this).attr('value',0)
                                                }
                                            ">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                    </tr>
                    <tr>
                        <td>
                            <table border="0" width="100%" cellspacing="0" cellpadding="2">
                                <tr>
                                    <td class="main">
                                        <div class="validate-result"></div>
                                        <br><?php echo TEXT_SPECIALS_PRICE_TIP; ?></td>
                                    <td class="main" align="right" valign="top">
                                        <br><?php
                                        echo (
                                            ($form_action == 'insert') ?
                                            tep_image_submit(
                                                'button_insert.gif',
                                                IMAGE_INSERT,
                                                "class='validate'"
                                            ) :
                                            tep_image_submit(
                                                'button_update.gif',
                                                IMAGE_UPDATE,
                                                "class='validate'"
                                            )
                                        )
                                        . '
                                        &nbsp;
                                        &nbsp;
                                        &nbsp;
                                        <a href="' .
                                            tep_href_link(
                                                FILENAME_SPECIALS,
                                                'page=' . $_GET['page'] . (
                                                    isset($_GET['sID']) ?
                                                        '&sID=' . $_GET['sID'] :
                                                        ''
                                                )
                                            ) . '">'
                                        . tep_text_button(BUTTON_CANCEL_NEW) . '</a>';
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        </form></tr>
                    <?php
                } else {
                ?>
                <tr>
                    <td>
                        <table border="0" width="100%" cellspacing="0" cellpadding="0" class="small_table_mobil">
                            <tr>
                                <td valign="top">
                                    <table border="0" width="100%" cellspacing="0" cellpadding="2">
                                        <tr class="dataTableHeadingRow">
                                            <!--TotalB2B start-->
                                            <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS_ID; ?>
                                            <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS; ?>
                                                <a href="<?php echo "$PHP_SELF"; ?>"><b>N</b></a></td>
                                            <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS_VENDOR_CODE; ?>
                                            <td class="dataTableHeadingContent"
                                                align="right"><?php echo TABLE_HEADING_PRODUCTS_PRICE; ?>
                                                <a href="<?php echo "$PHP_SELF?listing=customers"; ?>"><b>C</b></a>&nbsp;<a
                                                        href="<?php echo "$PHP_SELF?listing=groups"; ?>"><b>G</b></a>
                                            </td>
                                            <td class="dataTableHeadingContent" align="center"
                                                style="width: 100px;"><?php echo TABLE_HEADING_STATUS; ?></td>
                                            <td class="dataTableHeadingContent" align="center"
                                                style="width: 100px;"><?php echo TABLE_HEADING_ACTION; ?></td>
                                        </tr>
                                        <?php
                                        switch ($listing) {
                                            case "customers":
                                                $order = "s.customers_id DESC, s.customers_groups_id, pd.products_name";
                                                break;
                                            case "groups":
                                                $order = "s.customers_groups_id DESC, s.customers_id, pd.products_name";
                                                break;
                                            default:
                                                $order = "pd.products_name, s.customers_groups_id, s.customers_id";
                                        }
                                        ?>
                                        <!--TotalB2B start-->
                                        <?php
                                        //TotalB2B start
                                        $all_groups = [];
                                        if (file_exists(DIR_FS_EXT . 'customers_groups/customers_groups.php')) {
                                            $customers_groups_query = tep_db_query("
                                                select distinct 
                                                    customers_groups_name, 
                                                    customers_groups_id 
                                                from 
                                                    " . TABLE_CUSTOMERS_GROUPS . " 
                                                order by 
                                                    customers_groups_name"
                                            );
                                            while ($existing_groups = tep_db_fetch_array($customers_groups_query)) {
                                                $all_groups[$existing_groups['customers_groups_id']] =
                                                    $existing_groups['customers_groups_name'];
                                            }
                                        }
                                        $all_customers = [];
                                        $customers_query = tep_db_query("
                                            select distinct 
                                                customers_firstname, 
                                                customers_lastname, 
                                                customers_id 
                                            from 
                                                " . TABLE_CUSTOMERS . " 
                                            order by 
                                                customers_id"
                                        );
                                        while ($existing_customers = tep_db_fetch_array($customers_query)) {
                                            $all_customers[$existing_customers['customers_id']] =
                                                $existing_customers['customers_lastname'] .
                                                " " .
                                                $existing_customers['customers_firstname'];
                                        }

                                        $specials_query_raw = "
                                            select 
                                                DISTINCT (p.products_id), 
                                                pd.products_name, 
                                                p.products_price,
                                                p.products_model,
                                                s.specials_id, 
                                                s.customers_groups_id, 
                                                s.customers_id, 
                                                s.specials_new_products_price, 
                                                s.specials_date_added, 
                                                s.specials_last_modified, 
                                                s.expires_date, 
                                                s.date_status_change, 
                                                s.status,
                                                s.attribute_combination,
                                                ps.products_vendor_code,
                                                ps.products_combination_price
                                            from 
                                                " . TABLE_PRODUCTS . " p 
                                                JOIN " . TABLE_SPECIALS . " s
                                                JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd 
                                                LEFT JOIN " . TABLE_PRODUCTS_STOCK . " ps on ps.products_id = p.products_id and ps.products_stock_attributes = s.attribute_combination 
                                            where 
                                                p.products_id = pd.products_id and 
                                                pd.language_id = '" . (int)$languages_id . "' and 
                                                p.products_id = s.products_id 
                                            order by " . $order;
                                        //TotalB2B end
                                        $specials_split = new splitPageResults(
                                            $_GET['page'],
                                            MAX_DISPLAY_SEARCH_RESULTS,
                                            $specials_query_raw,
                                            $specials_query_numrows
                                        );
                                        $specials_query = tep_db_query($specials_query_raw);
                                        while ($specials = tep_db_fetch_array($specials_query)) {
                                            if (
                                                (
                                                    !isset($_GET['sID']) ||
                                                    (
                                                        isset($_GET['sID']) &&
                                                        ($_GET['sID'] == $specials['specials_id'])
                                                    )
                                                ) &&
                                                !isset($sInfo)
                                            ) {
                                                $products_query = tep_db_query("
                                                    select 
                                                        products_image 
                                                    from 
                                                        " . TABLE_PRODUCTS . " 
                                                    where 
                                                     products_id = '" . (int)$specials['products_id'] . "'"
                                                );
                                                $products = tep_db_fetch_array($products_query);
                                                $sInfo_array = array_merge($specials, $products);
                                                $sInfo = new objectInfo($sInfo_array);
                                            }

                                            //TotalB2B start
                                            if (
                                                isset($sInfo) &&
                                                is_object($sInfo) &&
                                                ($specials['specials_id'] == $sInfo->specials_id)
                                            ) {
                                                echo '
                                                <tr 
                                                    id="defaultSelected" 
                                                    class="dataTableRowSelected" 
                                                    onmouseover="rowOverEffect(this)" 
                                                    onmouseout="rowOutEffect(this)" 
                                                    onclick="document.location.href=\'' .
                                                    tep_href_link(
                                                        FILENAME_SPECIALS,
                                                        'listing=' . $listing . '&page=' . $_GET['page'] . '&sID=' . $sInfo->specials_id . '&action=edit') . '\'">' . "\n";
                                            } else {
                                                echo '
                                                <tr 
                                                    class="dataTableRow" 
                                                    onmouseover="rowOverEffect(this)" 
                                                    onmouseout="rowOutEffect(this)" 
                                                    onclick="document.location.href=\'' .
                                                    tep_href_link(
                                                        FILENAME_SPECIALS,
                                                        'listing=' . $listing . '&page=' . $_GET['page'] . '&sID=' . $specials['specials_id']) . '\'">' . "\n";
                                            } //TotalB2B end
                                            ?>
                                            <td class="dataTableContent"><?php echo $specials['products_id']; ?></td>
                                            <td class="dataTableContent"><?php echo $specials['products_name']; ?></td>
                                            <?php
                                            if ($specials['attribute_combination'] == 'all') {
                                                $vendor_text = 'all';
                                            } else {
                                                if ($specials['products_vendor_code']) {
                                                    $vendor_text = $specials['products_vendor_code'];
                                                } else {
                                                    $vendor_text = $specials['products_model'] ?: '-';
                                                }
                                            }
                                            ?>
                                            <td class="dataTableContent"><?php echo $vendor_text; ?></td>
                                            <!--TotalB2B start-->
                                            <td class="dataTableContent" align="right">
                                                <span class="oldPrice">
                                                  <?php echo $currencies->format($specials['products_combination_price'] ?: $specials['products_price']); ?>
                                                </span>
                                                <span class="specialPrice">
                                                  <?php
                                                  echo $currencies->format($specials['specials_new_products_price']);
                                                  echo " ( ";
                                                  if ($specials['customers_groups_id'] != 0) {
                                                      echo "[G] -> " . $all_groups[$specials['customers_groups_id']];
                                                  } else {
                                                      if ($specials['customers_id'] != 0) {
                                                          echo "[C] -> " . $all_customers[$specials['customers_id']];
                                                      }
                                                  }
                                                  echo " )"; ?>
                                               </span>
                                            </td><!--TotalB2B end-->
                                            <td class="dataTableContent specials_td_status" align="center">
                                                <?php
                                                if ($specials['status'] == '1') {
                                                    echo tep_image(
                                                            DIR_WS_IMAGES . 'icon_status_green.gif',
                                                            IMAGE_ICON_STATUS_GREEN,
                                                            10,
                                                            10
                                                        ) . '&nbsp;&nbsp;
                                                        <a href="' .
                                                        tep_href_link(
                                                            FILENAME_SPECIALS,
                                                            'action=setflag&flag=0&id=' . $specials['specials_id'],
                                                            'NONSSL'
                                                        ) . '">' .
                                                        tep_image(
                                                            DIR_WS_IMAGES . 'icon_status_red_light.gif',
                                                            IMAGE_ICON_STATUS_RED_LIGHT,
                                                            10,
                                                            10
                                                        ) . '</a>';
                                                } else {
                                                    echo '
                                                    <a href="' .
                                                        tep_href_link(
                                                            FILENAME_SPECIALS,
                                                            'action=setflag&flag=1&id=' . $specials['specials_id'],
                                                            'NONSSL'
                                                        ) . '">' .
                                                        tep_image(
                                                            DIR_WS_IMAGES . 'icon_status_green_light.gif',
                                                            IMAGE_ICON_STATUS_GREEN_LIGHT,
                                                            10,
                                                            10
                                                        ) . '</a>&nbsp;&nbsp;' .
                                                        tep_image(
                                                            DIR_WS_IMAGES . 'icon_status_red.gif',
                                                            IMAGE_ICON_STATUS_RED,
                                                            10,
                                                            10
                                                        );
                                                }
                                                ?>
                                            </td>
                                            <td class="dataTableContent" align="center">
                                                <?php
                                                if (
                                                    isset($sInfo) &&
                                                    is_object($sInfo) &&
                                                    $specials['specials_id'] == $sInfo->specials_id
                                                ) {
                                                    echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', '');
                                                } else {
                                                    echo '<a 
                                                        href="' . tep_href_link(
                                                            FILENAME_SPECIALS,
                                                            'page=' . $_GET['page'] . '&sID=' . $specials['specials_id']) . '">' .
                                                            tep_image(
                                                                DIR_WS_IMAGES . 'icon_info.gif',
                                                                IMAGE_ICON_INFO
                                                            ) . '
                                                    </a>';
                                                } ?>
                                            </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="4">
                                                <table class="table_nav" border="0" width="100%" cellpadding="0"
                                                       cellspacing="2">
                                                    <tr>
                                                        <td class="smallText" valign="top">
                                                            <?php echo $specials_split->display_count(
                                                                    $specials_query_numrows,
                                                                    MAX_DISPLAY_SEARCH_RESULTS,
                                                                    $_GET['page'],
                                                                    TEXT_DISPLAY_NUMBER_OF_SPECIALS
                                                            ); ?>
                                                        </td>
                                                        <td class="smallText" align="right">
                                                            <?php
                                                            echo $specials_split->display_links(
                                                                    $specials_query_numrows,
                                                                    MAX_DISPLAY_SEARCH_RESULTS,
                                                                    MAX_DISPLAY_PAGE_LINKS,
                                                                    $_GET['page']
                                                            ); ?>
                                                        </td>
                                                    </tr>
                                                    <?php if (empty($action)) {?>
                                                        <tr>
                                                            <td colspan="2" align="right">
                                                                <?php echo '
                                                                <a 
                                                                class="new_product_btn" 
                                                                href="' .tep_href_link(FILENAME_SPECIALS, 'page=' . $_GET['page'] . '&action=new') . '">' .
                                                                    tep_text_button(BUTTON_NEW_PRODUCT_NEW) . '
                                                                </a>'; ?>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <?php
                                $heading = [];
                                $contents = [];
                                switch ($action) {
                                    case 'delete':
                                        $heading[] = ['text' => '<b>' . TEXT_INFO_HEADING_DELETE_SPECIALS . '</b>'];
                                        $contents = [
                                            'form' => tep_draw_form(
                                                'specials',
                                                FILENAME_SPECIALS,
                                                'page=' . $_GET['page'] . '&sID=' . $sInfo->specials_id . '&action=deleteconfirm'
                                            )
                                        ];
                                        $contents[] = ['text' => TEXT_INFO_DELETE_INTRO];
                                        $contents[] = ['text' => '<br><b>' . $sInfo->products_name . '</b>'];
                                        $contents[] = [
                                            'align' => 'center',
                                            'text' => '<br>' .
                                                tep_image_submit(
                                                    'button_delete.gif',
                                                    IMAGE_DELETE,
                                                    'class="specials_del_btn"'
                                                ) . '&nbsp;
                                                <a 
                                                    class="specials_edit_btn" 
                                                    href="' .
                                                        tep_href_link(
                                                            FILENAME_SPECIALS,
                                                            'page=' . $_GET['page'] . '&sID=' . $sInfo->specials_id
                                                        ) . '">
                                                    ' . tep_text_button(BUTTON_CANCEL_NEW) . '
                                                </a>
                                                <br><br>'
                                        ];
                                        break;
                                    default:
                                        if (is_object($sInfo)) {
                                            $heading[] = ['text' => '<b>' . $sInfo->products_name . '</b>'];
                                            $contents[] = [
                                                'align' => 'center',
                                                'text' => '
                                                    <a 
                                                        class="specials_edit_btn" 
                                                        href="' .
                                                            tep_href_link(
                                                                FILENAME_SPECIALS,
                                                                'page=' . $_GET['page'] . '&sID=' . $sInfo->specials_id . '&action=edit'
                                                            ) . '"
                                                    >' .
                                                        tep_text_button(BUTTON_EDIT_NEW) .
                                                    '</a> 
                                                    <a 
                                                        class="specials_del_btn" 
                                                        href="' .
                                                            tep_href_link(
                                                                FILENAME_SPECIALS,
                                                                'page=' . $_GET['page'] . '&sID=' . $sInfo->specials_id . '&action=delete'
                                                            ) . '"
                                                    >' .
                                                        tep_text_button(BUTTON_DELETE_NEW) . '
                                                    </a>'
                                            ];
                                            $contents[] = [
                                                    'text' => '<br>' . TEXT_INFO_DATE_ADDED . ' ' .
                                                        tep_date_short($sInfo->specials_date_added)];
                                            $contents[] = [
                                                    'text' => '' . TEXT_INFO_LAST_MODIFIED . ' ' .
                                                        tep_date_short($sInfo->specials_last_modified)];
                                            $contents[] = [
                                                'align' => 'center',
                                                'text' => '<br>' .
                                                    tep_info_image(
                                                        $sInfo->products_image,
                                                        $sInfo->products_name,
                                                        150,
                                                        150
                                                    )
                                            ];
                                            $contents[] = [
                                                'text' => '<br>' . TEXT_INFO_ORIGINAL_PRICE . ' ' .
                                                    $currencies->format($sInfo->products_price)];
                                            $contents[] = [
                                                'text' => TEXT_INFO_NEW_PRICE . ' ' .
                                                    $currencies->format($sInfo->specials_new_products_price)];
                                            $contents[] = [
                                                'text' => TEXT_INFO_PERCENTAGE . ' ' .
                                                    number_format(
                                                100 - (
                                                            (
                                                            $sInfo->specials_new_products_price / $sInfo->products_price
                                                            ) * 100
                                                        )
                                                    ) . '%'
                                            ];
                                            $contents[] = [
                                                    'text' => '<br>' . TEXT_INFO_EXPIRES_DATE .
                                                        ' <b>' . tep_date_short($sInfo->expires_date) . '</b>'
                                            ];
                                            $contents[] = [
                                                    'text' => TEXT_INFO_STATUS_CHANGE . ' ' .
                                                        tep_date_short($sInfo->date_status_change)
                                            ];
                                        }
                                        break;
                                }

                                if ((tep_not_null($heading)) && (tep_not_null($contents))) {
                                    echo '<td class="specials_small_table" width="25%" valign="top">' . "\n";
                                    $box = new box;
                                    echo $box->infoBox($heading, $contents), '</td>' . "\n";
                                }
                            } ?>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
        <!-- body_text_smend //-->
    </tr>
</table>
<!-- body_smend //-->
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_smend //-->
<script>
    $(document).on('change', '[name="attribute_combination"]', function() {
        var element = $(this).find('option:selected');
        $('[name="attribute_combination_price"]').val(element.data('price'));
    });
    $(document).on('change', '[name="keywords"]', function () {
        setTimeout(function () {
            var product_id = $('*[name=products_id]').val();
            if (product_id.length) {
                var data = {};
                data['product_id'] = product_id;
                $.ajax({
                    url: 'ajax_get_attributes_combinations.php',
                    type: "POST",
                    data: data,
                    dataType: 'json',
                    success: function (response) {
                        var optionText;
                        $.each(response, function (attributesCombination, attributesInfo) {
                            optionText = attributesInfo.vendor_code + ' (<?php echo TBL_HEADING_PRICE; ?>: ' + attributesInfo.price + ')';
                            $('[name="attribute_combination"]').append('<option data-price="' + attributesInfo.price + '" value="' + attributesCombination + '">' + optionText + '</option>');
                        });
                    }
                });
            }
        }, 500);
    });
    window.IS_MOBILE = <?=isMobile()?>;
</script>
</body>
</html>
<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>