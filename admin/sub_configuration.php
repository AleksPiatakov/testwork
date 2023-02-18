<?php
require('includes/application_top.php');

use admin\includes\solomono\app\models\sub_configuration\sub_configuration;

$filename = basename(__FILE__, ".php");

$sub_configuration = new sub_configuration();


if (isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show') {
    $sub_configuration->query($_GET);
    echo json_encode($sub_configuration->data);
    exit;
}


if ($sub_configuration->isAjax()) {

    $action = $_GET['action'];
    switch ($action) {
        case "edit_$filename":
        case "new_$filename":
            $id = $_GET['id'] ? $_GET['id'] : false;
            $sub_configuration->selectOne($id);
            $html = $sub_configuration->getView("formLang");
            echo json_encode(array('html' => $html));
            exit;
            break;
        case "insert_$filename":
            if ($sub_configuration->insert($_POST)) {
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
            if ($sub_configuration->update($_POST)) {
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
            if ($sub_configuration->delete($_POST['id'])) {
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
}

?>

<?php
include_once('html-open.php');
include_once('header.php');

?>
    <script>
        var lang=<?php echo $sub_configuration->getTranslation();?>;
    </script>
    <div class="container">
        <?php echo $sub_configuration->getView();?>
    </div>

<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>