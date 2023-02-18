<?php
require('includes/application_top.php');

use admin\includes\solomono\app\models\newsletters\newsletters;

$filename = basename(__FILE__, ".php");

$newsletters = new newsletters();
$allowed_image_types = ['image/jpeg','image/gif','image/png','image/webp'];

if (isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show') {
    $newsletters->query($_GET);
    echo json_encode($newsletters->data);
    exit;
}

if ($newsletters->isAjax()) {

    $action = $_GET['action'];
    switch ($action) {
        case "edit_$filename":
        case "new_$filename":
            $id = $_GET['id'] ? $_GET['id'] : false;
            $newsletters->selectOne($id);
            $html = $newsletters->getView("newsletters/form");
            echo json_encode(array('html' => $html));
            exit;
            break;
        case "preview":
            $id = $_GET['id'] ? $_GET['id'] : false;
            $newsletters->selectOne($id);
            $html = $newsletters->getView("newsletters/preview");
            echo json_encode(array('html' => $html));
            exit;
            break;
        case "send":
            $id = $_GET['id'] ? $_GET['id'] : false;
            $newsletters->selectOne($id);
            switch ($newsletters->data['data'][0]['module']){
                case 'newsletter':
                    $newsletters->select_customers();
                    break;
                case 'product_notification':
                    $newsletters->select_products();
                    break;
            }
            $html = $newsletters->getView("newsletters/beforsend");
            echo json_encode(array('html' => $html));
            exit;
            break;
        case "insert_$filename":
            if ($newsletters->insert($_POST)) {
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
            $newsletters->checkFile('manufacturers_image', $_POST['id'],null,$allowed_image_types);
            if ($newsletters->update($_POST)) {
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

            $arr=$newsletters->yandexTranslate($_POST,$from,$to);
            echo json_encode($arr);
            exit;
            break;
    }
    $action = $_POST['action'];
    switch ($action) {
        case "delete_$filename":
            if ($newsletters->delete($_POST['id'])) {
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
        case "send2":
            $id = $_POST['id'] ? $_POST['id'] : false;
            $newsletters->selectOne($id);
            $_POST['recipients'] = $_POST['customers'];
            $_POST['chosen'] = $_POST['products'];
            $html = $newsletters->getView("newsletters/send");
            echo json_encode(array('html' => $html));
            exit;
            break;
        case "confirm_send":
            $id = $_POST['nID'] ? $_POST['nID'] : false;
            $newsletters->selectOne($id);
            $html = $newsletters->getView("newsletters/confirm_send");
            echo json_encode(array('html' => $html));
            exit;
            break;
    }
    if(isset($_POST['status'])){
        if($newsletters->statusUpdate($_POST['status'],$_POST['id'], 'locked')){
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
        var lang=<?=$newsletters->getTranslation();?>;
    </script>
    <div class="container-fluid">
        <?=$newsletters->getView();?>
    </div>

<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>