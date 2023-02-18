<style>
    body {
        font-family: Arial;
    }

    .products_table {
        width: 100%;
        padding: 30px 0;
    }

    .products_table td {
        padding: 5px;
    }

    .order_confirm_title {
        font-family: Arial;
        position: absolute;
        top: 200px;
        left: 35%;
        background: #fff;
        padding: 5px 10px;
        font-style: italic;
        font-size: 18px;
        color: #242424;
        font-weight: bold;
        /*border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        border-bottom-left-radius: 10px;
        border: 1px solid #242424;*/
    }

    .address_block {
        width: 100%;
	    margin-top: 35px;
    }

    .address_block .border_radius {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        border-bottom-left-radius: 10px;
        border: 1px solid #000;
        position: relative;
        display: block;
        width: 42%;
        float: left;
        padding: 10px 10px 0 20px;
        font-size: 13px;
    }

    .address_block .border_radius b {
        font-size: 14px;
    }

    .address_block .border_radius div {
        width: 50%;
        float: left;
    }

    .print-invoice-logo img {
	    pointer-events: none;
	    width: auto;
	    aspect-ratio: unset;
	    display: block;
	    max-width: 100%;
	    height: auto;
	    max-height: 100%;
	    height: 80px!important;
    }
    .print-invoice-logo {
	    height: 80px!important;
	    display: flex;
	    align-items: center;
    }
</style>
<div style="font-size: 10px; width: 50%;position: absolute;bottom: 60px;left: 60px;">
    <?= PDF_FOOTER_TEXT ?>
</div>

<!--mpdf

<htmlpagefooter name="myfooter">
<table width="100%" style="padding-top:80px;">

    <tr style="width:100%; text-align:right;">
        <td width="70%" style="padding-bottom:20px;text-align:right;vertical-align: bottom;padding-right:15px;font-size:10px;border-right:1px solid #eee">
           <?= nl2br(STORE_BANK_INFO) ?>
        </td>
        <td width="15%" style="padding-bottom:20px;text-align:left;font-size: 10px;padding-left:15px;">
            <?= STORE_NAME ?><br>
            <?= stripcslashes(STORE_ADDRESS) ?><br>
            <?= $storeTelephoneNumber ?><br>
            <?= STORE_OWNER_EMAIL_ADDRESS ?><br>
            <?= HTTP_SERVER; ?>
            </p>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <img src="<?= HTTP_SERVER . "/images/footer1.png" ?>">
        </td>
    </tr>
</table>
</htmlpagefooter>

<sethtmlpagefooter name="myfooter" value="on" />
mpdf-->

<table style="border-bottom: 1px solid #242424;padding-bottom: 20px;width: 100%;" class="print_header">
    <tr>
        <td width="50%" rowspan="2">
            <span class="print-invoice-logo">
	            <img src="<?php echo HTTP_SERVER . "/" . LOGO_IMAGE ?>" alt="logo" style="height: 100%; max-height: 100px; max-width: 220px">
            </span>
        </td>
        <td width="20%" style="vertical-align: top;font-size: 12px;">
            <b><?= PRINT_HEADER_COMPANY_NAME; ?></b><br> <b><?= PRINT_HEADER_ADDRESS; ?></b>
        </td>
        <td style="vertical-align: top;font-size: 12px;">
            <?= STORE_NAME ?><br>
            <?= stripcslashes(STORE_ADDRESS)?>
        </td>
    </tr>
    <tr>
        <td width="20%" style="vertical-align: top;font-size: 12px;">
            <b><?= PRINT_HEADER_PHONE; ?></b><br> <b><?= PRINT_HEADER_EMAIL_ADDRESS; ?></b><br>
            <b><?= PRINT_HEADER_WEBSITE; ?></b><br>
        </td>
        <td style="vertical-align: top;font-size: 12px;">
            <?= $storeTelephoneNumber ?><br>
            <?= STORE_OWNER_EMAIL_ADDRESS ?><br>
            <?= HTTP_SERVER; ?>
        </td>
    </tr>
</table>


<table width="100%" style="margin-top: 20px;position: relative;">
    <div class="order_confirm_title"><?= $pdfTitle ?></div>
</table>
<div class="address_block">
    <div class="border_radius">
        <b><?php echo ENTRY_SOLD_TO; ?></b><br>
        &nbsp;&nbsp;&nbsp;&nbsp;<?php echo make_address($order->customer); ?>
    </div>
    <div class="border_radius" style="float: right;">
        <b><?php echo ENTRY_SHIP_TO; ?></b><br>
        &nbsp;&nbsp;&nbsp;&nbsp;<?php echo make_address($order->delivery); ?>
    </div>
    <div class="border_radius" style="width: 100%; margin: 20px 0 0; padding: 10px 10px 10px 20px;">
        <div>
            <strong><?php echo INVOICE_TEXT_ORDER; ?><?php echo INVOICE_TEXT_COLON; ?></strong> <?php echo INVOICE_TEXT_NUMBER_SIGN; ?><?php echo $_GET['order_id']; ?>
            <br>
            <strong><?php echo INVOICE_CUSTOMER_NUMBER; ?></strong> <?php echo INVOICE_TEXT_NUMBER_SIGN; ?><?php echo $customer_id; ?>
        </div>
        <div style="float: right; width: 35%;">
            <strong><?php echo INVOICE_TEXT_DATE_OF_ORDER; ?></strong> <?php echo INVOICE_TEXT_COLON; ?> <?php echo mb_substr(
                $order->info['date_purchased'],
                0,
                -9
            ); ?>
            <br> <strong><?php echo ENTRY_PAYMENT_METHOD; ?></strong> <?php echo $order->info['payment_method']; ?>
        </div>
    </div>
</div>
<table width="100%" style="font-size: 14px;margin-bottom: 50px;">
    <tbody>
    <tr>
        <td colspan="2" align="center">
            <table border="0" cellspacing="0" cellpadding="2" class="products_table">
                <tr>
                    <td width="20" align="left">
                        <b><?php echo defined("TABLE_HEADING_PRODUCTS_PC") ? TABLE_HEADING_PRODUCTS_PC : ""; ?></b></td>
                    <td width="60">
                        <b><?php echo defined(
                                "TABLE_HEADING_PRODUCTS_MODEL"
                            ) ? TABLE_HEADING_PRODUCTS_MODEL : ""; ?></b>
                    </td>
                    <td width="120" align="left">
                        <b><?php echo defined("TABLE_HEADING_PRODUCTS") ? TABLE_HEADING_PRODUCTS : ""; ?></b></td>
                    <td width="80" align="right">
                        <b><?php echo defined("TABLE_HEADING_TAX") ? TABLE_HEADING_TAX : ""; ?></b></td>
                    <td width="80" align="right">
                        <b><?php echo defined("TABLE_HEADING_UNIT_PRICE") ? TABLE_HEADING_UNIT_PRICE : ""; ?></b></td>
                    <td width="80" align="right">
                        <b><?php echo defined("TABLE_HEADING_TOTAL") ? TABLE_HEADING_TOTAL : ""; ?></b></td>
                </tr>
                <?php
                for ($i = 0, $n = sizeof($order->products); $i < $n; $i++) {
                    echo '      <tr>' . "\n" .
                        '        <td valign="top" align="left">' . $order->products[$i]['qty'] . '</td>' . "\n" .
                        '        <td width="60" valign="top">' . $order->products[$i]['model'] . '</td>' . "\n" .
                        '        <td valign="top" align="left">' . $order->products[$i]['name'];

                    if (
                        isset($order->products[$i]['attributes']) && (($k = sizeof(
                                $order->products[$i]['attributes']
                            )) > 0)
                    ) {
                        for ($j = 0; $j < $k; $j++) {
                            echo '<br><nobr><small>&nbsp;<i> - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'];
                            if ($order->products[$i]['attributes'][$j]['price'] != '0') {
                                echo ' (' . $order->products[$i]['attributes'][$j]['prefix'] . $currencies->format(
                                        $order->products[$i]['attributes'][$j]['price'] * $order->products[$i]['qty'],
                                        true,
                                        $order->info['currency'],
                                        $order->info['currency_value']
                                    ) . ')';
                            }
                            echo '</i></small></nobr>';
                        }
                    }


                    echo '          </td>' . "\n";
                    echo '          <td WIDTH="80" align="right" valign="top">' . number_format(
                            $order->products[$i]['tax'],
                            0,
                            '.',
                            ''
                        ) . '%</td>' . "\n";
                    echo '          <td WIDTH="80" align="right" valign="top">' . $currencies->format(
                            $order->products[$i]['price'],
                            true,
                            $order->info['currency'],
                            $order->info['currency_value']
                        ) . '</td>' . "\n" .
                        '          <td WIDTH="80" align="right" valign="top">' . $currencies->format(
                            $order->products[$i]['price'] * $order->products[$i]['qty'],
                            true,
                            $order->info['currency'],
                            $order->info['currency_value']
                        ) . '</td>' . "\n";
                    echo '         </tr>' . "\n";
                }
                ?>
                <tr>
                    <td align="right" colspan="6">
                        <table border="0" cellspacing="0" cellpadding="2" style="margin-top: 10px;">
                            <?php
                            for ($i = 0, $n = sizeof($order->totals); $i < $n; $i++) {
                                echo '         <tr>' . "\n" .
                                    '          <td align="right" style="padding:2px 0 2px 5px;">' . $order->totals[$i]['title'] . '</td>' . "\n" .
                                    '          <td align="right" style="padding:2px 0 2px 5px;">' . $order->totals[$i]['text'] . '</td>' . "\n" .
                                    '         </tr>' . "\n";
                            }
                            ?>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    </tbody>
</table>
<!--<div style="font-size: 13px; margin-top: 10px;">--><?php //echo $product_info['products_description']; ?><!--</div>-->
