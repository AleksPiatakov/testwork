<?php

require('includes/application_top.php');
use admin\includes\solomono\app\models\redirects\redirects;

$filename = basename(__FILE__, ".php");
$allowed_image_types = ['image/jpeg','image/gif','image/png','image/webp'];

$redirects = new redirects();
if (isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show') {
    $redirects->query($_GET);
    echo json_encode($redirects->data);
    exit;
}

if ($redirects->isAjax()) {

    $action = $_GET['action'];
    switch ($action) {
        case "edit_$filename":
        case "new_$filename":
            $id = $_GET['id'] ? $_GET['id'] : false;
            $redirects->selectOne($id);
            $html = $redirects->getView();
            echo json_encode(array('html' => $html));
            exit;
            break;
        case "insert_$filename":
            $redirects->checkFile('manufacturers_image', $_POST['id'],null,$allowed_image_types);
            $result = $redirects->insert($_POST);
            if ($result) {
                $arr = array(
                    'success' => true,
                    'id'=>$result,
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
            $redirects->checkFile('manufacturers_image', $_POST['id'],null,$allowed_image_types);
            if ($redirects->update($_POST)) {
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
        case "delete_$filename":
            if ($redirects->delete($_POST['id'])) {
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
        if($redirects->statusUpdate($_POST['status'],$_POST['id'])){
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


include_once('html-open.php');
include_once('header.php');
?>
    <script>
        var lang=<?php echo $redirects->getTranslation();?>;
    </script>

<div class="hbox hbox-auto-xs hbox-auto-sm">

    <div class="col">
        <div class="wrapper">
            <?php echo $redirects->getView("default.php");?>
        </div>
    </div>
</div>
<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>