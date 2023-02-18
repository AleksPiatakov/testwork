<?php
require('includes/application_top.php');

use admin\includes\solomono\app\models\tax_rates\tax_rates;

$filename = basename(__FILE__, ".php");

$tax_rates = new tax_rates();


if (isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show') {
    $tax_rates->query($_GET);
    echo json_encode($tax_rates->data);
    exit;
}

if ($tax_rates->isAjax()) {

    $action = $_GET['action'];
    switch ($action) {
        case "edit_$filename":
        case "new_$filename":
            $id = $_GET['id'] ? $_GET['id'] : false;
            $tax_rates->selectOne($id);
            $html = $tax_rates->getView("form");
            echo json_encode(array('html' => $html));
            exit;
            break;
        case "insert_$filename":
            if ($tax_rates->insert($_POST)) {
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
            if ($tax_rates->update($_POST)) {
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
            if ($tax_rates->delete($_POST['id'])) {
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
        var lang=<?php echo $tax_rates->getTranslation();?>;
    </script>
    <div class="container">
        <?php include DIR_WS_TABS . "taxes.php"; ?>
        <?php echo $tax_rates->getView();?>
    </div>

<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>