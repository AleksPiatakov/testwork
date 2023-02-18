<?php
require('includes/application_top.php');

use admin\includes\solomono\app\models\orders\orders;
use admin\includes\solomono\app\models\orders\orders_status_history;
use admin\includes\solomono\app\models\orders\create_order;
use admin\includes\solomono\app\models\customers\address_book;

$filename = basename(__FILE__, ".php");

$orders = new orders();
$orders_status_history = new orders_status_history();
$create_orders = new create_order();


if (isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show') {
    $orders->query($_GET);
    echo json_encode($orders->data);
    exit;
}

if ($orders->isAjax()) {

    $action = $_GET['action'];
    switch ($action) {
        case "edit_$filename":
            $id = $_GET['id'] ? (int) $_GET['id'] : false;
            $orders->selectOne($id);
            $html = $orders->getView("$filename/orders_detail");
            echo json_encode(array('html' => $html));
            exit;
            break;
        case "update_orders_status_history":
            if ($_POST['customer_notified'] == 'on') {
                $_POST['customer_notified'] = 1;
                $notify_comments = sprintf(EMAIL_TEXT_COMMENTS_UPDATE, $_POST['comments']) . "\n\n";
                $customers = $orders_status_history->customersInfo($_POST['orders_id']);
                $email = STORE_NAME . "\n" . EMAIL_SEPARATOR . "\n" . EMAIL_TEXT_ORDER_NUMBER . ' ' . $_POST['orders_id'] . "\n" . EMAIL_TEXT_INVOICE_URL . ' ' . tep_catalog_href_link(FILENAME_CATALOG_ACCOUNT_HISTORY_INFO,
                        'order_id=' . $_POST['orders_id'],
                        'SSL') . "\n" . EMAIL_TEXT_DATE_ORDERED . ' ' . tep_date_long_translate(tep_date_long($customers['date_purchased'])) . "\n\n" . $notify_comments . sprintf(EMAIL_TEXT_STATUS_UPDATE,
                        $_POST['orders_status_name']);
                $subject = EMAIL_TEXT_SUBJECT;
                if (checkConst('EMAIL_CONTENT_MODULE_ENABLED') == 'true') {
                    require_once(DIR_FS_EXT . 'email_content/functions.php');
                    $orderInfo = [
                        'orders_id' => $_POST['orders_id'],
                        'customers_name' => $customers['customers_firstname'] . '' . $customers['customers_lastname'],
                        'date_purchased' => $customers['date_purchased'],
                        'comments' => $_POST['comments']
                    ];
                    $content_email_array = getChangeOrderStatusText($languages_id, $orderInfo,
                        $_POST['orders_status_name']);
                    $email = $content_email_array['content_html'] ?: $email;
                    $subject = $content_email_array['subject'] ?: $subject;
                }
                tep_mail($customers['customers_firstname'] . ' ' . $customers['customers_lastname'],
                    $customers['customers_email_address'], $subject . ' #' . tep_db_input($_POST['orders_id']), $email,
                    STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
            } else {
                $_POST['customer_notified'] = 0;
            }
            if ($orders_status_history->insert($_POST)) {
                $orders->statusUpdate($_POST['orders_status_id'], $_POST['orders_id'], 'orders_status', null,
                    'orders_id');
                $arr = array(
                    'success' => true,
                    'msg' => TEXT_SAVE_DATA_OK,
                );
            } else {
                $arr = array(
                    'success' => false,
                    'msg' => TEXT_ERROR
                );
            }
            echo json_encode($arr);
            exit;
            break;
        case "get_order_confirmation_template":
            $paidId = 7;
            $statusInfo = $orders_status_history->getOrderStatusById($paidId);
            $notify_comments = sprintf(EMAIL_TEXT_COMMENTS_UPDATE, $statusInfo['orders_status_text']) . "\n\n";
            $customers = $orders_status_history->customersInfo($_GET['orders_id']);
            $customers_name = $customers['customers_name'] ?: $customers['customers_firstname'] . '' . $customers['customers_lastname'];
            $email = STORE_NAME . "\n" . EMAIL_SEPARATOR . "\n" . EMAIL_TEXT_ORDER_NUMBER . ' ' . $_GET['orders_id'] . "\n" . EMAIL_TEXT_INVOICE_URL . ' ' . tep_catalog_href_link(FILENAME_CATALOG_ACCOUNT_HISTORY_INFO,
                    'order_id=' . $_GET['orders_id'],
                    'SSL') . "\n" . EMAIL_TEXT_DATE_ORDERED . ' ' . tep_date_long_translate(tep_date_long($customers['date_purchased'])) . "\n\n" . $notify_comments . sprintf(EMAIL_TEXT_STATUS_UPDATE,
                    $_GET['orders_status_name']);
            $subject = EMAIL_TEXT_SUBJECT;
            if (checkConst('EMAIL_CONTENT_MODULE_ENABLED') == 'true') {
                require_once(DIR_FS_EXT . 'email_content/functions.php');
                $orderInfo = [
                    'orders_id' => $_GET['orders_id'],
                    'customers_name' => $customers_name,
                    'date_purchased' => $customers['date_purchased'],
                    'comments' => $statusInfo['orders_status_text'],
                ];
                $content_email_array = getChangeOrderStatusText($languages_id, $orderInfo,
                    $statusInfo['orders_status_name']);
                $email = $content_email_array['content_html'] ?: $email;
                $subject = $content_email_array['subject'] ?: $subject;
            }

            echo json_encode([
                'email_customer_name' => $customers_name,
                'email_email' => $customers['customers_email_address'],
                'email_body' => $email,
                'orders_id' => $_GET['orders_id'],
                'email_subject' => $subject . ' #' . tep_db_input($_GET['orders_id'])
            ]);
            die;
            break;
        case "create_order_form_user_selection":
            $html = $create_orders->getView("orders/user_select");
            echo json_encode(array('html' => $html));
            exit;
        case "create_order_form":
            $html = $create_orders->getView("form");
            echo json_encode(array('html' => $html));
            exit;
            break;
        case "insert_customers":
            $id = $create_orders->prepareFields($_POST);
            echo json_encode(array(
                'msg' => TEXT_SAVE_DATA_OK,
                'link' => tep_href_link(FILENAME_EDIT_ORDERS, 'oID=' . $id . '&customer_id=' . $_POST['customers_id'],
                    'SSL')
            ));
            exit;
            break;
        case "insert_address_book":
            include_once(DIR_WS_LANGUAGES . $language . '/customers.php');
            $address_book = new address_book();
            if ($customer_id = $address_book->insert($_POST)) {
                $arr = array(
                    'success' => false,
                    'link' => tep_href_link(FILENAME_ORDERS, 'action=create_order_form&cid=' . $customer_id)
                );
            } else {
                $arr = array(
                    'success' => false,
                    'msg' => TEXT_ERROR
                );
            }
            echo json_encode($arr);
            exit;
            break;
        case "new_customers":

            include(DIR_WS_LANGUAGES . $language . '/customers.php');
            $address_book = new address_book();
            $address_book->selectAllZones();
            $address_book->selectAllCountry();
            $address_book->selectAllCustomersGroups();
            $html = $address_book->getView("customers/address_book_form");
            echo json_encode(array('html' => $html));
            exit;
            break;
    }
    $action = $_POST['action'];
    switch ($action) {
        case "delete_$filename":
            $_POST['restock'] = $_POST['restock'] ?: false;
            tep_remove_order($_POST['id'], $_POST['restock']);
            echo json_encode(array(
                'success' => true,
                'msg' => TEXT_SAVE_DATA_OK,
            ));
            exit;
            break;
        case "group_delete_$filename":
            $_POST['restock'] = $_POST['restock'] ?: false;
            $ids = explode(',', $_POST['id']);

            //            sleep(10);
            foreach ($ids as $k => $id) {
                tep_remove_order($id, $_POST['restock']);
            }
            echo json_encode(array(
                'success' => true,
                'msg' => TEXT_SAVE_DATA_OK,
            ));
            exit;
            break;
        case "get_orders_status":
            $status = $orders_status_history->getOrdersStatus($_POST['status_name']);
            $orders_status_history->select($_POST['id']);
            $content = $orders_status_history->getView();
            echo json_encode(array('html' => $content));
            exit;
            break;
        case "get_orders_status_list":
            $orders_status_history->getOrdersStatus();
            echo json_encode(array('status' => $orders_status_history->data['orders_status']));
            exit;
            break;
        case "change_group_orders_status":
            $email = $_POST['email'] == 'on' ?: false;
            if ($orders_status_history->changeStatusGroup($_POST['orders_status'], $_POST['id'], $email,
                $_POST['orders_status_comment'])) {
                $msg = true;
            } else {
                $msg = false;
            }

            echo json_encode(array(
                'success' => $msg,
                'msg' => $msg ? TEXT_SAVE_DATA_OK : TEXT_ERROR,
            ));
            exit;
            break;
        case "getCustomer":
            $arr = $create_orders->selectOne($_POST['id']);
            $arr['addresses'] = $create_orders->selectCustomerAddresses($_POST['id']);
            echo json_encode($arr);
            exit;
            break;
        case "send_order_confirmation_email":
            $_POST = tep_db_prepare_input($_POST);
            $paidId = 7;

            tep_mail($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['body'], STORE_OWNER,
                STORE_OWNER_EMAIL_ADDRESS);
            tep_mail($_POST['name'], STORE_OWNER_EMAIL_ADDRESS, $_POST['subject'], $_POST['body'], STORE_OWNER,
                STORE_OWNER_EMAIL_ADDRESS);
            tep_db_query("INSERT INTO orders_status_history (orders_id,orders_status_id,date_added,customer_notified,comments) VALUES  ('{$_POST['orders_id']}', '$paidId', NOW(), 1,  'Send confirmation')");
            $orders->statusUpdate($paidId, $_POST['orders_id'], 'orders_status', null, 'orders_id');

            echo json_encode(array(
                'success' => true,
                'msg' => TEXT_SAVE_DATA_OK,
            ));
            die;
            break;
    }

    if (!empty($_GET['term'])) {
        $arr = $create_orders->select($_GET['term']);
        echo json_encode($arr);
        exit;
    }
}
?>

<?php
include_once('html-open.php');
include_once('header.php');
?>
    <script src="<?= DIR_WS_INCLUDES ?>javascript/datepicker/moment.min.js"></script>
    <script src="<?= DIR_WS_INCLUDES ?>javascript/datepicker/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="<?= DIR_WS_INCLUDES ?>javascript/datepicker/daterangepicker.css"/>
    <style>
        button.cancelBtn.btn.btn-sm.btn-default {
            float: left;
        }

        button.applyBtn.btn.btn-sm.btn-primary {
            float: right;
            margin-bottom: 10px;
        }
    </style>
    <script type="text/javascript">
        $(function () {
            if ($('.orderdatepicker').length) {

                let dateFormat = 'MM/DD/YYYY';
                $('.orderdatepicker').daterangepicker({
                    autoUpdateInput: false,
                    locale: {
                        "format": dateFormat,
                        "separator": " - ",
                        "applyLabel": "<?=TEXT_MODAL_APPLY_ACTION?>",
                        "cancelLabel": "<?=IMAGE_CANCEL?>",
                        "daysOfWeek": [
                            "<?=TEXT_DAY_SHORT_7?>",
                            "<?=TEXT_DAY_SHORT_1?>",
                            "<?=TEXT_DAY_SHORT_2?>",
                            "<?=TEXT_DAY_SHORT_3?>",
                            "<?=TEXT_DAY_SHORT_4?>",
                            "<?=TEXT_DAY_SHORT_5?>",
                            "<?=TEXT_DAY_SHORT_6?>"

                        ],
                        "monthNames": [
                            "<?=TEXT_MONTH_BASE_1?>",
                            "<?=TEXT_MONTH_BASE_2?>",
                            "<?=TEXT_MONTH_BASE_3?>",
                            "<?=TEXT_MONTH_BASE_4?>",
                            "<?=TEXT_MONTH_BASE_5?>",
                            "<?=TEXT_MONTH_BASE_6?>",
                            "<?=TEXT_MONTH_BASE_7?>",
                            "<?=TEXT_MONTH_BASE_8?>",
                            "<?=TEXT_MONTH_BASE_9?>",
                            "<?=TEXT_MONTH_BASE_10?>",
                            "<?=TEXT_MONTH_BASE_11?>",
                            "<?=TEXT_MONTH_BASE_12?>"
                        ],
                        "firstDay": 1
                    },
                });

                $('.orderdatepicker').on('apply.daterangepicker', function (ev, picker) {
                    $(this).val(picker.startDate.format(dateFormat) + ' - ' + picker.endDate.format(dateFormat));
                    $('.orderdatepicker').trigger('input');
                });

                $('.orderdatepicker').on('cancel.daterangepicker', function (ev, picker) {
                    $(this).val('');
                    $('.orderdatepicker').trigger('input');
                });
            }
        });
    </script>
    <script>
        var lang =<?php echo $orders->getTranslation();?>;
        var orderStatusText =<?php echo $orders_status_history->getOrderStatusText();?>;
    </script>
    <div class="container">
        <?php echo $orders->getView(); ?>
    </div>
    <script>
        var addresses = [];
        $(document).ready(function () {
            $(document).on('click', '.send_confirmation', function () {
                var id = $(this).data('id');
                var currentModal = $(this).closest('.modal');
                currentModal.on('hidden.bs.modal', function () {

                    $.get(window.location.pathname, {
                        action: 'get_order_confirmation_template',
                        orders_id: id
                    }, function (response) {
                        var body = '<form>';
                        body += '<p>' + lang.all.TEXT_MODAL_CONFIRMATION_ACTION + '</p>';

                        body += '<div class="form-group">\n' +
                            '                    <label for="customers_firstname" class="col-sm-3 control-label">Customer Name:</label>\n' +
                            '                    <div class="col-sm-9">\n' +
                            '                        <input type="select" value="' + response.email_customer_name + '" name="name" class="form-control" id="name">\n' +
                            '                    </div>\n' +
                            '                </div>';

                        body += '<div class="form-group">\n' +
                            '                    <label for="customers_firstname" class="col-sm-3 control-label">Customer Email:</label>\n' +
                            '                    <div class="col-sm-9">\n' +
                            '                        <input type="select" value="' + response.email_email + '" name="email"  class="form-control" id="email">\n' +
                            '                    </div>\n' +
                            '                </div>';

                        body += '<div class="form-group">\n' +
                            '                    <label for="customers_firstname" class="col-sm-3 control-label">Email subject:</label>\n' +
                            '                    <div class="col-sm-9">\n' +
                            '                        <input type="select" value="' + response.email_subject + '" name="subject"  class="form-control" id="subject">\n' +
                            '                    </div>\n' +
                            '                </div>';

                        body += '<div class="form-group">\n' +
                            '                    <label for="customers_firstname" class="col-sm-3 control-label">Email content:</label>\n' +
                            '                    <div class="col-sm-9">\n' +
                            '                        <textarea name="body" class="form-control" id="body">' + response.email_body + '</textarea>\n' +
                            '                    </div>\n' +
                            '                </div>';
                        body += '<input type="hidden" name="orders_id" value="' + response.orders_id + '" />';
                        body += '<button type="button" class="btn btn-default" data-dismiss="modal">' + lang.all.TEXT_MODAL_CANCEL_ACTION + '</button>';
                        body += '<button type="submit" class="btn btn-danger btn-confirm">OK</button>';
                        body += '</form>';
                        modal({
                            id: 'email_confirmation',
                            title: lang.all.TEXT_MODAL_CONFIRM_ACTION,
                            body: body,
                            width: '75%',
                            after: function (modal) {
                                var textarea = $('#modal_email_confirmation [name="body"]');
                                var editor = CKEDITOR.replace(textarea.attr('name'), {
                                    extraPlugins: 'colorbutton,font,showblocks,justify,codemirror,btgrid',
                                    startupFocus: true,
                                    removePlugins: 'sourcearea'
                                });
                                editor.on('change', function (evt) {
                                    textarea.text(evt.editor.getData());
                                });
                                CKFinder.setupCKEditor(editor, 'includes/ckfinder/');
                                $(modal).on('click', 'button.btn-confirm', function (e) {
                                    e.preventDefault();
                                    var form = $(modal).find('form');
                                    var data = form.serializeArray();
                                    data.push({name: 'action', value: 'send_order_confirmation_email'});
                                    $.ajax({
                                        url: window.location.pathname,
                                        type: "POST",
                                        data: data,
                                        dataType: 'json',
                                        beforeSend: function () {
                                            $(modal).modal('hide');
                                            show_tooltip('<span style="font-size: 5em;" class="ajax-loader"></span>', 55555);
                                        },
                                        success: function (msg) {
                                            $('.tooltip_own').remove();
                                            if (msg['success']) {
                                                $('#own_pagination').pagination('selectPage', option.page);
                                            } else {
                                                show_tooltip(msg['success']);
                                            }
                                        }
                                    });
                                })
                            }
                        });

                    }, "json");
                })

            })
            $(document).on('change', '#modal_form [name="orders_status_id"]', function () {
                var textarea = $('#modal_form [name="comments"]');
                var statusText = orderStatusText[$(this).val()].orders_status_text;
                textarea.text(statusText);
                CKEDITOR.instances["comments"].setData(statusText);


            })
            $('#create_order').on('click', function (e) {
                e.preventDefault();
                getForm.call(this);
            });

            $('body').on('focus', '#search', function () {
                var stringParams = new URLSearchParams(window.location.search);
                if (stringParams.get('cid') !== null) {
                    $.post(window.location.pathname, {
                        action: "getCustomer",
                        id: stringParams.get('cid')
                    }, function (response) {
                        console.log(response);
                        for (var field in response) {
                            $('#' + field).val(response[field]);
                        }
                    }, "json").done(function () {
                        $('.tooltip_own').remove();
                        stringParams.delete('cid');
                        window.history.replaceState('', '', window.location.origin + window.location.pathname + '?' + stringParams.toString())
                    });
                }

                $("#search").autocomplete({
                    source: window.location.pathname,
                    delay: 50,
                    minLength: 2,
                    select: function (event, ui) {
                        $("#search").closest('form')[0].reset();
                        show_tooltip('<span style="font-size: 5em;" class="ajax-loader"></span>', 55555, $("#search").closest('form'));
                        $.post(window.location.pathname, {action: "getCustomer", id: ui.item.id}, function (response) {
                            console.log(response);
                            var element;
                            for (var field in response) {
                                switch (field) {
                                    case 'addresses':
                                        $('#address_book').html('');
                                        for (var address in response[field]) {
                                            addresses[response[field][address]['address_book_id']] = response[field][address];
                                            var select;
                                            if (response[field][address]['address_book_id'] == response[field][0]['address_book_id']) {
                                                select = ' selected';
                                            } else {
                                                select = '';
                                            }
                                            var addressValue = response[field][address]['address_book_id'];
                                            var addressName = (response[field][address]['type_address_name'] ? response[field][address]['type_address_name'] + '  ' : '') +
                                                (response[field][address]['customers_firm'] ? response[field][address]['customers_firm'] + '  ' : '') +
                                                (response[field][address]['entry_street_address'] ? response[field][address]['entry_street_address'] + '  ' : '') +
                                                (response[field][address]['entry_city'] ? response[field][address]['entry_city'] : '');
                                            if (addressName.length <= 0) addressName = '-';
                                            $('#address_book').append('<option value="' + addressValue + '"' + select + '>' + addressName + '</option>');
                                        }
                                        break;
                                    default:
                                        element = $('#' + field);
                                        if (element) element.val(response[field]);
                                }

                            }
                        }, "json").done(function () {
                            $('.tooltip_own').remove();
                        });
                        return false;
                    }
                }).autocomplete("instance")._renderItem = function (ul, item) {
                    ul.css('z-index', 9999);
                    return $("<li>")
                        .append("<div>(" + item.id + ") " + item.first_name + " " + item.last_name + "</div>")
                        .appendTo(ul);
                };
            });

            $(document).on('change', '#address_book', function () {
                setAddress($(this).val());
            });

            function setAddress(address_id) {
                var element;
                if (addresses && addresses[address_id]) {
                    for (var field in addresses[address_id]) {
                        element = $('#' + field);
                        if (element) element.val(addresses[address_id][field]);
                    }
                }
            }

            $('#own_table').on('change', 'td[data-name="dynamic"]>input', function () {
                if ($('#own_table td[data-name="dynamic"]>input:checked').length > 0) {
                    $('#action_orders>fieldset').prop('disabled', false)
                } else {
                    $('#action_orders>fieldset').prop('disabled', true)
                }
            });

            $('#own_table th[data-table="dynamic"]>input').on('change', function () {
                if ($(this).prop('checked')) {
                    $('#own_table td[data-name="dynamic"]>input').prop('checked', true);
                    $('#action_orders>fieldset').prop('disabled', false)
                } else {
                    $('#own_table td[data-name="dynamic"]>input').prop('checked', false);
                    $('#action_orders>fieldset').prop('disabled', true)
                }
            });

            $('#del_selected').on('click', function () {
                var obj = [];
                var inputChecked = $('#own_table td[data-name="dynamic"]>input:checked');
                inputChecked.each(function (i, e) {
                    obj[i] = $(e).closest('tr').data('id');
                });
                var body = '<form>';
                body += '<p>' + lang.all.TEXT_MODAL_CONFIRMATION_ACTION + '</p>';
                body += '<input type="hidden" name="action" value="group_delete_orders">';
                body += '<p>' + lang.currentPage.TEXT_INFO_RESTOCK_PRODUCT_QUANTITY + '</p>';
                body += '<p><input type="checkbox" name="restock"></p>';
                body += '<button type="button" class="btn btn-default" data-dismiss="modal">' + lang.all.TEXT_MODAL_CANCEL_ACTION + '</button>';
                body += '<button type="submit" class="btn btn-danger btn-confirm">OK</button>';
                body += '</form>';

                modal({
                    id: 'confirm-delete',
                    title: lang.all.TEXT_MODAL_CONFIRM_ACTION,
                    body: body,
                    width: '50%',
                    after: function (modal) {
                        $(modal).on('click', 'button.btn-confirm', function (e) {
                            e.preventDefault();
                            var form = $(modal).find('form');
                            var data = form.serializeArray();
                            data.push({name: 'id', value: obj});
                            $.ajax({
                                url: window.location.pathname,
                                type: "POST",
                                data: data,
                                dataType: 'json',
                                beforeSend: function () {
                                    $('#own_table td[data-name="dynamic"]>input').prop('checked', false);
                                    $('#own_table th[data-table="dynamic"]>input').prop('checked', false);
                                    $('#action_orders>fieldset').prop('disabled', true);
                                    $(modal).modal('hide');
                                    show_tooltip('<span style="font-size: 5em;" class="ajax-loader"></span>', 55555);
                                },
                                success: function (msg) {
                                    if (msg['success']) {
                                        $('.tooltip_own').remove();
                                        delete (option.count);
                                        $('#own_pagination').pagination('selectPage', option.page);
                                    } else {

                                    }
                                }
                            });
                        })
                    }
                });
            });

            $('#change_status').on('click', function () {
                var obj = [];
                var inputChecked = $('#own_table td[data-name="dynamic"]>input:checked');
                inputChecked.each(function (i, e) {
                    obj[i] = $(e).closest('tr').data('id');
                });
                $.post(window.location.pathname, {action: 'get_orders_status_list'}, function (msg) {
                    var show = '<p><select name="orders_status" class="form-control">';
                    for (var key in msg['status']) {
                        show += '<option value="' + msg['status'][key]['orders_status_id'] + '">' + msg['status'][key]['orders_status_name'] + '</option>';
                    }
                    show += '<select name="orders_status_id" class="form-control"></p>';
                    var body = '<form>';
                    body += '<p>' + lang.all.TEXT_MODAL_CONFIRMATION_ACTION + '</p>';
                    body += '<input type="hidden" name="action" value="change_group_orders_status">';
                    body += show;
                    body += '<textarea class="form-control" name="orders_status_comment"></textarea><br />';
                    body += '<p>' + lang.currentPage.ENTRY_NOTIFY_CUSTOMER_EMAIL + '<input type="checkbox" name="email"></p>';
                    body += '<button type="button" class="btn btn-default" data-dismiss="modal">' + lang.all.TEXT_MODAL_CANCEL_ACTION + '</button>';
                    body += '<button type="submit" class="btn btn-danger btn-confirm">OK</button>';
                    body += '</form>';
                    modal({
                        title: lang.all.TEXT_MODAL_CONFIRM_ACTION,
                        body: body,
                        width: '50%',
                        after: function (modal) {
                            $(modal).on('click', 'button.btn-confirm', function (e) {
                                e.preventDefault();
                                var form = $(modal).find('form');
                                var data = form.serializeArray();
                                data.push({name: 'id', value: obj});
                                $.ajax({
                                    url: window.location.pathname,
                                    type: "POST",
                                    data: data,
                                    dataType: 'json',
                                    beforeSend: function () {
                                        $('#own_table td[data-name="dynamic"]>input').prop('checked', false);
                                        $('#own_table th[data-table="dynamic"]>input').prop('checked', false);
                                        $('#action_orders>fieldset').prop('disabled', true);
                                        $(modal).modal('hide');
                                        show_tooltip('<span style="font-size: 5em;" class="ajax-loader"></span>', 55555);
                                    },
                                    success: function (msg) {
                                        $('.tooltip_own').remove();
                                        if (msg['success']) {
                                            $('#own_pagination').pagination('selectPage', option.page);
                                        } else {
                                            show_tooltip(msg['success']);
                                        }
                                    }
                                });
                            })
                        }
                    });

                }, "json");

            });

            $('body').on('click', '.edit_orders', function (e) {
                e.preventDefault();
                var oID = $(this).closest('tr').data('id');
                window.location.href = $(this).attr('href') + '?oID=' + oID;
            });

            $('#own_table.orders').on('click', 'td[data-name="orders_status_name"]', function () {
                var $this = $(this);
                $.ajax({
                    url: window.location.pathname,
                    type: "POST",
                    dataType: 'json',
                    data: {
                        action: 'get_orders_status',
                        id: $this.closest('tr').data('id'),
                        status_name: $(this).text()
                    },
                    success: function (response) {
                        modal({
                            title: lang.currentPage.HEADING_TITLE,
                            body: response.html,
                            id: 'form',
                            width: '90%',
                            after: function (modal) {
                                var textarea = $('#modal_form [name="comments"]');
                                var editor = CKEDITOR.replace(textarea.attr('name'), {
                                    extraPlugins: 'colorbutton,font,showblocks,justify,codemirror,btgrid',
                                    startupFocus: true,
                                    removePlugins: 'sourcearea',
                                    on: {
                                        instanceReady: function () {
                                            this.dataProcessor.htmlFilter.addRules({
                                                elements: {
                                                    img: function (el) {
                                                        // Add an attribute.
                                                        if (!el.attributes.alt)
                                                            el.attributes.alt = '';

                                                        // Add some class.
                                                        if (typeof el.attributes.class === 'undefined' || el.attributes.class.indexOf('img-responsive') == -1) {
                                                            el.addClass(' img-responsive');
                                                        }
                                                        if (typeof el.attributes.class === 'undefined' || el.attributes.class.indexOf('lazyload') == -1) {
                                                            el.addClass(' lazyload');
                                                        }
                                                        el.attributes.style = '';
                                                    }
                                                }
                                            });
                                        }
                                    }
                                });
                                editor.on('change', function (evt) {
                                    textarea.text(evt.editor.getData());
                                });
                                CKFinder.setupCKEditor(editor, 'includes/ckfinder/');

                                var form = $(modal).find('form');
                                $(modal).on('click', 'input[type="submit"]', function (e) {
                                    e.preventDefault();
                                    var data = $(form).serializeArray();
                                    data.push({
                                        name: 'orders_status_name',
                                        value: $('#orders_status :selected').text().trim()
                                    });
                                    $.ajax({
                                        url: form.attr('action'),
                                        type: form.attr('method'),
                                        dataType: 'json',
                                        data: data,
                                        success: function (response) {
                                            $(modal).modal('hide');
                                            if (response.success == true) {
                                                $('#own_pagination').pagination('selectPage', option.page);
                                            } else {
                                                show_tooltip(response['msg'], 5000);
                                            }
                                        }
                                    });
                                })
                            }
                        });
                    }
                });
            });
            $(document).on('click', '#create_customer,#create_order_from_exist', getForm);

        });

        $(document).on("click", "td[data-name='customers_name'],td[data-name='id']", function () {
            var closestTr = $(this).closest("tr");
            closestTr.find("button.edit_row").click();
        });
    </script>

<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>