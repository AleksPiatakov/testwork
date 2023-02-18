<?php
require('includes/application_top.php');
require(DIR_WS_CLASSES . 'currencies.php');

use admin\includes\solomono\app\models\customers\customers;
use admin\includes\solomono\app\models\customers\address_book;
use admin\includes\solomono\app\models\customers\mail;

$filename = 'customers';

$customers = new customers();


if (isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show') {
    $customers->query($_GET);
    echo json_encode($customers->data);
    exit;
}

if ($customers->isAjax()) {
    $action = $_GET['action'];
    switch ($action) {
        case "new_$filename":
            $address_book = new address_book();
            $address_book->selectAllZones();
            $address_book->selectAllCountry();
            $address_book->selectAllCustomersGroups();
            $html = $address_book->getView("$filename/address_book_form");
            echo json_encode(array('html' => $html));
            exit;
            break;
        case "edit_$filename":
            $id_customer = $_GET['id'] ?: false;
            $address_book = new address_book();
            $address_book->setIdCustomer($id_customer);
            $address_book->selectOne();
            $address_book->selectAllCustomersGroups();
            $html = $address_book->getView("$filename/address_book_form");
            echo json_encode(array('html' => $html));
            exit;
            break;
        case "add_address":
            $customer_id = $_GET['customer_id'] ?: false;
            $address_book = new address_book();
            $address_book->insertAddressBook($customer_id, array());
            $address_book->setIdCustomer($customer_id);
            $address_book->selectOne();
            $address_book->selectAllCustomersGroups();
            $html = $address_book->getView("$filename/address_form");
            echo json_encode(array('html' => $html));
            exit;
            break;
        case "delete_address":
            $customer_id = $_GET['customer_id'] ?: false;
            $address_book = new address_book();
            $address_book->delete($_GET['address_id']);
            $address_book->setIdCustomer($customer_id);
            $address_book->selectOne();
            $address_book->selectAllCustomersGroups();
            $html = $address_book->getView("$filename/address_form");
            echo json_encode(array('html' => $html));
            exit;
            break;
        case "insert_address_book":
            $address_book = new address_book();
            if ($address_book->insert($_POST)) {
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
        case "update_address_book":
            $address_book = new address_book();
            $address_book->setIdCustomer($_POST['id']);
            if ($address_book->update($_POST)) {
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
        case "show_mail":
            $id_customer = $_GET['id'];
            $mail = new mail();
            $mail->setIdCustomer($id_customer);
            $mail->select();
            $html = $mail->getView("$filename/send_mail");
            echo json_encode(array(
                'title' => 'Send Email',
                'html' => $html
            ));
            exit;
            break;
        case "send_mail":
            $mail = new mail();
            $mail->sendMail($_POST);
            if ($mail->error) {
                $msg = implode("<br>", $mail->error);
                $arr = array(
                    'success' => false,
                    'msg' => $msg,
                );
            } else {
                $arr = array(
                    'success' => true,
                    'reload' => false,
                    'msg' => "success"
                );
            }
            echo json_encode($arr);
            exit;
            break;
    }
    $action = $_POST['action'];
    switch ($action) {
        case "delete_address_book":
            $address_book = new address_book();
            if ($address_book->delete($_POST['id'])) {
                $arr = array(
                    'success' => true,
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
        case "delete_$filename":
            $customers->delete($_POST['id']);
            if ($customers->error) {
                $msg = implode("<br>", $customers->error);
                $arr = array(
                    'success' => false,
                    'msg' => $msg,
                    'close' => true,
                    'time' => 999999
                );
            } else {
                $arr = array(
                    'success' => true,
                    'msg' => defined('MSG_DELETE') ? constant('MSG_DELETE') : 'Deleted',
                );
            }
            echo json_encode($arr);
            exit;
            break;
        case "check_email_address_book":
            $address_book = new address_book();
            $address_book->checkEmail($_POST['email']);
            if ($address_book->checkEmail($_POST['email'])) {
                $arr = array(
                    'success' => false,
                );
            } else {
                $arr = array(
                    'success' => true,
                );
            }
            echo json_encode($arr);
            exit;
            break;
    }

    if (isset($_POST['status'])) {
        if ($customers->statusUpdate($_POST['status'], $_POST['id'], 'customers_status', 'customers')) {
            $array = array(
                'success' => true,
                'msg' => TEXT_SAVE_DATA_OK,
            );
        } else {
            $array = array(
                'success' => false,
                'msg' => TEXT_ERROR
            );
        }
        echo json_encode($array);
        exit;
    }
}
?>

<?php
include_once('html-open.php');
include_once('header.php');
?>

    <script>
        var lang = <?=$customers->getTranslation();?>;

        $(document).ready(function () {

            $('#own_table').on('click', 'tr td:not(:last-child, :has([for^="cmn-toggle-status"]))', function () {
                var tr = $(this).closest('tr');
                var id = tr.data('id');
                tr.find('td:last-child .edit_row').click();
            });

            $('#showcredit').prop("checked", (option.showcredit == 'yes') ? true : false);
            $('#showcredit').on('change', function () {
                option.showcredit = $(this).is(':checked') ? 'yes' : 'no';
                option.page = 1;
                delete (option.count);
                $('#own_pagination').pagination('selectPage', option.page);
            });

            $('#own_table').on('click', '.fa.fa-key', function () {
                var cID = $(this).closest('tr').data('id');
                show_tooltip('<span style="font-size: 5em;" class="ajax-loader"></span>', 55555);
                $.get("password_forgotten_user.php", {cID: cID}, function (response) {
                    $('.tooltip_own').remove();
                    show_tooltip(response.msg, 9999999, $('body'), true);
                }, 'json')
            });

            $('body').on('change', '.select_address_book', function () {
                var IdBook = $(this).val();
                $('input[name="address_book_id"]').val(IdBook);
                $('#address_book>div[data-address_id!="' + IdBook + '"]').hide();
                $('#address_book>div[data-address_id="' + IdBook + '"]').show();
                $('input[name="customers_default_address_id"]').prop('checked', false);
                $('#address_book .select_address_book').val(IdBook);
            });

            $('#own_table').on('click', '.show_orders, .fa.fa-share', function () {
                var cID = $(this).closest('tr').data('id');
                window.location.href = 'orders.php?cID=' + cID;
            });

            $('#own_table').on('click', '.show_mail, .fa.fa-envelope-o', function () {
                var ID = $(this).closest('tr').data('id');
                $(this).attr('href', window.location.search + '&action=show_mail&id=' + ID);
                getForm.call($(this));
            });

            $('body').on('focus', 'input[name="customers_dob"]', function () {
                $(this).datepicker({
                    showOtherMonths: true,
                    selectOtherMonths: true,
                    dateFormat: 'yy-mm-dd'
                });
                $(this).change();
            });

            $.validator.addMethod("validEmail", function (value) {
                var result;
                $.ajax({
                    url: window.location.pathname,
                    type: 'post',
                    data: {
                        action: 'check_email_address_book',
                        email: value
                    },
                    success: function (response) {
                        result = response.success
                    },
                    dataType: "json",
                    async: false
                });
                return result;
            }, '<?=ENTRY_EMAIL_ADDRESS_ERROR_EXISTS?>');
        });
    </script>

    <div class="container-fluid">
        <?= $customers->getView(); ?>
    </div>

<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>