<?php
require('includes/application_top.php');

use admin\includes\solomono\app\models\tax_classes\tax_classes;

$filename = basename(__FILE__, ".php");

$tax_classes = new tax_classes();


if (isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show') {
    $tax_classes->query($_GET);
    echo json_encode($tax_classes->data);
    exit;
}

if ($tax_classes->isAjax()) {

    $action = $_GET['action'];
    switch ($action) {
        case "edit_$filename":
        case "new_$filename":
            $id = $_GET['id'] ? $_GET['id'] : false;
            $tax_classes->selectOne($id);
            $html = $tax_classes->getView("form");
            echo json_encode(array('html' => $html));
            exit;
            break;
        case "insert_$filename":
            if ($tax_classes->insert($_POST)) {
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
            if ($tax_classes->update($_POST)) {
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
            if ($tax_classes->delete($_POST['id'])) {
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
        var lang=<?php echo $tax_classes->getTranslation();?>;
    </script>
    <div class="container">
        <?php include DIR_WS_TABS . "taxes.php"; ?>
        <?php echo $tax_classes->getView();?>
    </div>

<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>