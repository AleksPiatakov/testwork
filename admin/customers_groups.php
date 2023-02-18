<?php

use admin\includes\solomono\app\models\customers_groups\customers_groups;

require('includes/application_top.php');

$allowed_image_types = ['image/jpeg','image/gif','image/png','image/webp'];

function getTreeOption($arr, $depth = 0, $selected_id = false) {
    $html = '';
    foreach ($arr as $v) {
        if (is_array($selected_id)){
            $selected = in_array($v['id'], $selected_id) ? 'selected' : '';
        } else {
            $selected = $selected_id == $v['id'] ? 'selected' : '';
        }
        $html .= '<option ' . $selected . ' value="' . $v['id'] . '">';
        $html .= str_repeat('&nbsp;', $depth * 3);
        $html .= $v['name'] . '</option>';
        if (array_key_exists('childs', $v)) {
            $html .= getTreeOption($v['childs'], $depth + 1, $selected_id);
        }
    }
    return $html;
}

$filename = basename(__FILE__, ".php");

$customers_groups = new customers_groups();


if (isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show') {
    $customers_groups->query($_GET);
    echo json_encode($customers_groups->data);
    exit;
}


if ($customers_groups->isAjax()) {
    $action = $_GET['action'];
    switch ($action) {
        case "edit_$filename":
        case "new_$filename":
            $id = $_GET['id'] ? $_GET['id'] : false;
            $customers_groups->selectOne($id);

            $customers_groups->data['option']['orders_status'] = $customers_groups->getOrdersStatusOptions($id);

            $payment_arr = $customers_groups->getPaymentOptions();
            $selected_methods = explode(';',$customers_groups->data['data']['group_payment_allowed']);
            $customers_groups->data['option']['payment_allowed'] = getTreeOption($payment_arr, 0, $selected_methods);

            $shipping_arr = $customers_groups->getShippingOptions();
            $selected_methods = explode(';',$customers_groups->data['data']['group_shipment_allowed']);
            $customers_groups->data['option']['shipping_allowed'] = getTreeOption($shipping_arr, 0, $selected_methods);

            $html = $customers_groups->getView("form");
            echo json_encode(array('html' => $html));
            exit;
            break;
        case "insert_$filename":
            $customers_groups->checkFile('customers_groups_image', $_POST['id'],null,$allowed_image_types);
            if ($customers_groups->insert($_POST)) {
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
        case "update_$filename":
            if ($customers_groups->update($_POST)) {
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
        case 'translate':
            /*id language*/
            $from=$_GET['from']?:1;
            $to=$_GET['to']?:3;

            $arr=$customers_groups->yandexTranslate($_POST,$from,$to);
            echo json_encode($arr);
            exit;
            break;
    }
    $action = $_POST['action'];
    switch ($action) {
        case "delete_$filename":
            if ($customers_groups->delete($_POST['id'])) {
                $arr = array(
                    'success' => true,
                    'msg' => TEXT_SAVE_DATA_OK
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
        case "change_color":
            if ($customers_groups->statusUpdate($_POST['value'], $_POST['id'], $_POST['name'])) {
                $arr = array(
                    'success' => true,
                    'msg' => TEXT_SAVE_DATA_OK
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
    }
    if(isset($_POST['status'])){
        if($customers_groups->statusUpdate($_POST['status'],$_POST['id'],$field = 'sale_status', $table = 'customers_groups_sales')){
            $array = array(
                'success' => true,
                'msg' => TEXT_SAVE_DATA_OK,
            );
        }else{
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
        var lang=<?php echo $customers_groups->getTranslation();?>;
        $(document).ready(function () {
            widthOfModal='60%';
            $('#own_table').on('change','.change input',function (e) {
                console.log($(this).val());
                var data={
                    action:'change_'+$(this).attr('class'),
                    name:$(this).attr('name'),
                    value:$(this).val(),
                    id:$(this).closest('tr').data('id')
                };
                $.ajax({
                    url: window.location.pathname,
                    type: 'POST',
                    dataType: 'json',
                    data: data,
                    success: function (response) {
                        if (response.success == false) {

                        }
                    }
                });
            });
        });
    </script>
    <div class="container">
        <?php echo $customers_groups->getView();?>
    </div>

<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
