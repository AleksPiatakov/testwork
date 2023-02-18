<?php
//debug($data);
//debug($action);
//exit;
require(DIR_WS_CLASSES . 'currencies.php');
$currencies = new currencies();
$language = $_SESSION['language'];
require_once(DIR_WS_LANGUAGES . $language . '/modules/novaposhta/novaposhta.php');
?>
<?php $action_form = (!empty($data['data'])) ? "update_$action" : "insert_$action"; ?>

<div class="container modal_order_details">
    <div class="row">
        <div class="col-md-3">
            <h3><?php echo ENTRY_INFO; ?></h3>
            <?php foreach ($data['data']['INFO'] as $field => $v) {
                switch ($field) {
                    case 'shipping_method_code':
                        break;
                    case 'nwposhta_address':
                        if ($data['data']['INFO']['shipping_method_code'] === 'nwposhtanew') {
                            echo $v ? '<p><b>' . addDoubleDot($field) . '</b> ' . $v . '</p>' : '';
                        }
                    default:
                        echo $v ? '<p><b>' . addDoubleDot($field) . '</b> ' . $v . '</p>' : '';
                }
            }
            $adminFolder = basename(dirname(dirname(dirname(dirname(dirname(__DIR__))))));?>
        </div>
        <div class="col-md-3">
            <h3><?php echo ENTRY_CUSTOMERS; ?></h3>
            <?php echo tep_address_format($data['data']['CUSTOMERS']['address_format_id'], $data['data']['CUSTOMERS'], 1, '', '<br>'); ?>
        </div>
        <div class="col-md-3">
            <h3><?php echo ENTRY_DELIVERY; ?></h3>
            <?php echo tep_address_format($data['data']['DELIVERY']['address_format_id'], $data['data']['DELIVERY'], 1, '', '<br>'); ?>
        </div>
        <div class="col-md-3">
            <h3><?php echo ENTRY_BILLING; ?></h3>
            <?php echo tep_address_format($data['data']['BILLING']['address_format_id'], $data['data']['BILLING'], 1, '', '<br>'); ?>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped <?php echo $action; ?>">
            <thead>
            <tr>
                <?php if (count($data['products'])) {
                    foreach (current($data['products']) as $field => $v) {
                        if ((isset($data['allowed_fields'][$field]['show']) && $data['allowed_fields'][$field]['show'] == false)) { ?>
                            <th><?php echo $data['allowed_fields'][$field]['label'] ?: $field; ?></th>
                        <?php }
                    }
                } ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['products'] as $k => $arr) { ?>
                <tr>
                    <?php foreach ($arr as $field => $v) {
                        if ((isset($data['allowed_fields'][$field]['show']) && $data['allowed_fields'][$field]['show'] == false)) { ?>
                            <?php
                            $products_attrs = "";
                            foreach ($arr['products_attr'] as $arrt) {
                                $products_attrs .= "<br><span class='attrs_product'><strong>" . $arrt['products_options'] . ": </strong>" . $arrt['products_options_values'] . "</span>";
                            }
                            ?>
                            <td data-label="<?php echo $data['allowed_fields'][$field]['label'] ?: $field; ?>">
                                <?php
                                if ($field == 'products_name') {
                                    echo '<a target="_blank" href="/product_info.php?products_id=' . $arr['products_id'] . '">' . $v . '</a>' . $products_attrs;
                                } elseif ($field == 'products_price' or $field == 'final_price') {
                                    echo $currencies->format($v, true, $data['data']['INFO'][TEXT_CURRENCY], $data['data']['INFO'][TEXT_CURRENCY_VALUE]);
                                } else {
                                    echo $v;
                                }
                                ?>
                            </td>
                        <?php } ?>
                    <?php } ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="row">
        <?php
        //associated "order_total" modules to their titles
        $modulesTitles = [
            'ot_better_together' => 'MODULE_ORDER_TOTAL_BETTER_TOGETHER_TITLE',
            'ot_country_discount' => 'MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_TEXT_TITLE',
            'ot_coupon' => 'MODULE_ORDER_TOTAL_COUPON_TITLE',
            'ot_gv' => 'MODULE_ORDER_TOTAL_GV_TITLE',
            'ot_lev_discount' => 'MODULE_LEV_DISCOUNT_TITLE',
            'ot_loworderfee' => 'MODULE_ORDER_TOTAL_LOWORDERFEE_TITLE',
            'ot_payment' => 'MODULE_PAYMENT_DISC_TITLE',
            'ot_qty_discount' => 'MODULE_QTY_DISCOUNT_TITLE',
            'ot_shipping' => 'MODULE_ORDER_TOTAL_SHIPPING_TITLE',
            'ot_subtotal' => 'MODULE_ORDER_TOTAL_SUBTOTAL_TITLE',
            'ot_tax' => 'MODULE_ORDER_TOTAL_TAX_TITLE',
            'ot_total' => 'MODULE_ORDER_TOTAL_TOTAL_TITLE'
        ];

        for ($i = 0; $i < count($data['orders_total']); $i++) { ?>
            <p class="text-right">
                <?php
                //default title from DB->orders_total
                $title = $data['orders_total'][$i]['title'];
                //change title on title of appropriate module
                switch ($data['orders_total'][$i]['class']) {
                    case 'ot_shipping':
                        //get active shipping module
                        $activeShippingModule = $data['data']['INFO']['shipping_method_code'];
                        if (!empty($activeShippingModule)) {
                            //init appropriate shipping module
                            if (is_file(DIR_FS_CATALOG_MODULES_SHIPPING . $activeShippingModule . '.php')) {
                                include_once(DIR_FS_CATALOG_MODULES_SHIPPING . $activeShippingModule . '.php');
                                includeLanguages(DIR_FS_CATALOG_LANGUAGES . $language . '/modules/shipping/' . $activeShippingModule . '.php');
                            } else {
                                include_once(DIR_FS_EXT . 'shipping/' . $activeShippingModule . '/' . $activeShippingModule . '.php');
                                includeLanguages(DIR_FS_EXT . 'shipping/' . $activeShippingModule . '/languages/' . $language . '/' . $activeShippingModule . '.json');
                            }
                            $class = $activeShippingModule;
                            $module = new $class;
                            $title = $module->title . ': ';
                        }
                        break;
                    default:
                        $moduleTitle = $modulesTitles[$data['orders_total'][$i]['class']];
                        if (isset($moduleTitle)) {
                            includeLanguages(DIR_FS_CATALOG_LANGUAGES . $language . '/modules/order_total/' . $data['orders_total'][$i]['class'] . '.php');
                            $title = getConstantValue($moduleTitle) . ': ';
                        }
                }
                echo $title . $data['orders_total'][$i]['text']; ?>
            </p>
        <?php } ?>
    </div>
    <div class="row form-group text-right">
        <?php if (getConstantValue(MODULE_SHIPPING_NWPOSHTANEW_STATUS, 'false') == 'true') { ?>
<!--        <button type="button" class="btn btn-default send_confirmation" data-dismiss="modal" data-id="--><?php //echo $data['order_id'] ?><!--">Send confirmation</button>-->
                <?php if (getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_SAVE_TTN_ONE_CLICK', 'false') == 'true') { ?>
                    <a id="button-save-one-click" data-id="<?php echo $data['order_id'] ?>" class="btn btn-primary" role="button"><?php echo BUTTON_CREATE_ONECLICK_CN; ?></a>
                    <a id="button-getcnlist" data-toggle="tooltip" title="<?php echo BUTTON_CN_LIST; ?>" class="btn btn-default" role="button"><i class="fa fa-list-ul"></i></a>
                <?php } else { ?>
                <div class="btn-group"><button type="button" id="create_cn" data-id="<?php echo $data['order_id'] ?>"
                                               class="btn btn-default dropdown-toggle action-button"
                                               data-toggle="dropdown" aria-haspopup="true"
                                               aria-expanded="false"><i class="fa fa-file-text-o"
                                                                        aria-hidden="true"></i>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="dropdown-header"><?php echo HEADING_CN ?></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header"><?php echo HEADING_TITLE ?></li>
                        <li><a onclick="createCN(this, 'novaposhta');"><?php echo TEXT_FORM_CREATE ?></a></li>
                        <li><a style="cursor: pointer;" onclick="assignmentCN(this, 'novaposhta');"><?php echo ENTRY_CONSIGNMENT_ASSIGNMENT_TO_ORDER ?></a></li>
                        <li role="separator" class="divider"></li></ul>
                </div>
                <?php } ?>
        <?php } ?>
        <a target="_blank" href="invoice.php?oID=<?php echo $data['order_id'] ?>" class="btn btn-info"><?php echo IMAGE_ORDERS_INVOICE ?></a>
        <a target="_blank" href="packingslip.php?oID=<?php echo $data['order_id'] ?>" class="btn btn-info"><?php echo IMAGE_ORDERS_PACKINGSLIP ?></a>
        <a href="<?php echo tep_href_link(FILENAME_EDIT_ORDERS, 'from=modal&oID=' . $data['order_id']);?>" class="btn btn-success"><?php echo TEXT_EDIT_ORDER ?></a>
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo IMAGE_BACK; ?></button>
    </div>
</div>
<script type="text/javascript">
    function createCN() {
        $.get('includes/modules/novaposhta/novaposhta.php', {
            action: 'getCNForm',
            order_id: $('#create_cn').attr('data-id')
        }, function(data) {
            modal({
                id: 'getCNForm',
                body: data.html,
                render: true,
                width: '70%',
            });

        }, 'json');
        return false;
    }

    function assignmentCN() {
        $.get('includes/modules/novaposhta/novaposhta.php', {
            action: 'assignmentCN',
            order_id: $('#create_cn').attr('data-id')
        }, function(data) {
            modal({
                id: 'assignment-cn-to-order',
                body: data.html,
                render: true,
                width: '30%',
            });

        }, 'json');
        return false;
    }

    // getCNList
    $('#button-getcnlist').on('click', function () {
        $.post('includes/modules/novaposhta/novaposhta.php', {
            action: 'getCNList'
        }, function(data) {
            modal({
                id: 'getCNList',
                body: data.html,
                render: true,
                width: '70%',
            });

        }, 'json');
        return false;
    } );

    // Save CN one Click
    $('#button-save-one-click').on('click', function () {
        $.get('includes/modules/novaposhta/novaposhta.php', {
            action: 'getCNForm',
            order_id: $('#button-save-one-click').attr('data-id')
        }, function(data) {
            if (data['success'] == false) {
                alert(data['msg']);
                return false;
            }
            modal({
                id: 'getCNForm',
                body: data.html,
                render: true,
                width: '70%',
            });

        }, 'json');
        return false;
    } );

    // Save CN
    $('#button-save2').on('click', function () {
        var $post_data = $('input[type="text"], input[type="radio"]:checked, input[type="checkbox"]:checked, select, textarea').filter(':visible').add('input[type="hidden"]');
        console.log($post_data);

        $.ajax( {
            url: './includes/modules/novaposhta/novaposhta.php?request=saveCN&order_id=<?php echo $data['order_id']; ?>&cn_ref=<?php echo $data['cn_ref']; ?>',
            type: 'POST',
            data: $post_data,
            dataType: 'json',
            beforeSend: function() {
                $('body').fadeTo('fast', 0.8).prepend('<div id="ajax-loader" style="position: fixed; top: 50%;	left: 50%; z-index: 9999;"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
            },
            complete: function(json){
                var $alerts = $('.alert-danger, .alert-success');

                if ($alerts.length !== 0) {
                    setTimeout(function() { $alerts.remove(); }, 15000);
                }

                if (json['errors'] != 'undefined' || json['warning'] != 'undefined') {
                    $('html, body').animate({ scrollTop: $('.has-error, .alert').offset() }, 1000);
                }

                $('body').fadeTo('fast', 1)
                $('#ajax-loader').remove();

            },
            success: function(json) {
                if (typeof json['success'] !== 'undefined') {
                    $.post('includes/modules/novaposhta/novaposhta.php', {
                        action: 'getCNList'
                    }, function(data) {
                        modal({
                            id: 'getCNList',
                            body: data.html,
                            render: true,
                            width: '70%',
                        });

                    }, 'json');
                    return false;
                } else {
                    $('.help-block').remove();
                    $('div').removeClass('has-error has-success');

                    //checkErrors(json);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus);
            },
        } );
    } );

</script>