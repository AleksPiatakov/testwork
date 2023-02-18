<?php
require('includes/application_top.php');

use admin\includes\solomono\app\models\orders_status\orders_status;

$filename = basename(__FILE__, ".php");

$orders_status = new orders_status();


if (isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show') {
    $orders_status->query($_GET);
    echo json_encode($orders_status->data);
    exit;
}

if ($orders_status->isAjax()) {

    $action = $_GET['action'];
    switch ($action) {
        case "edit_$filename":
        case "new_$filename":
            $id = $_GET['id'] ? $_GET['id'] : false;
            $orders_status->selectOne($id);
            $html = $orders_status->getView("formLang");
            echo json_encode(array('html' => $html));
            exit;
            break;
        case "insert_$filename":
            if ($orders_status->insert($_POST)) {
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
            if ($orders_status->update($_POST)) {
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
    }
    $action = $_POST['action'];
    switch ($action) {
        case "change_color":
            if ($orders_status->statusUpdate($_POST['value'], $_POST['id'], $_POST['name'])) {
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
        case "delete_$filename":

            if($_POST['id'] == DEFAULT_ORDERS_STATUS_ID) {
                $arr = array(
                    'success' => false,
                    'msg' => ERROR_ORDER_STATUS_IS_DEFAULT
                );
            } else {
                if ($orders_status->delete($_POST['id'])) {
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
            }


            echo json_encode($arr);
            exit;
            break;



    }

    if (isset($_POST['default'])){
        if ($orders_status->updateDefault($_POST['id'])) {
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
    if(isset($_POST['orders_status_show'])){
        if($orders_status->statusUpdate($_POST['orders_status_show'], $_POST['id'], 'orders_status_show')){
            $array = array(
                'success' => true,
                'msg' => TEXT_SAVE_DATA_OK,
            );
        }else {
            $array = array(
                'success' => false,
                'msg' => TEXT_ERROR
            );
        }
        echo json_encode($array);
        exit;
    }
    if (isset($_POST['downloads_flag'])) {
        if ($orders_status->statusUpdate($_POST['downloads_flag'], $_POST['id'], 'downloads_flag')) {
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
    var lang =<?php echo $orders_status->getTranslation();?>;
</script>
<div class="container">
    <?php echo $orders_status->getView();?>
</div>
<script>
    $(document).ready(function () {
        $('#own_table').on('change','.change input',function (e) {
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
<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>