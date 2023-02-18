<?php
require('includes/application_top.php');

use admin\includes\solomono\app\models\manufacturers\manufacturers;

$filename = basename(__FILE__, ".php");

$manufacturers = new manufacturers();
$allowed_image_types = ['image/jpeg', 'image/gif', 'image/png', 'image/webp'];

if (isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show') {
    $manufacturers->query($_GET);
    echo json_encode($manufacturers->data);
    exit;
}

if ($manufacturers->isAjax()) {
    $action = $_GET['action'];
    switch ($action) {
        case "edit_$filename":
        case "new_$filename":
            $id = $_GET['id'] ? $_GET['id'] : false;
            $manufacturers->selectOne($id);
            $html = $manufacturers->getView("manufacturers/formLang");
            echo json_encode(array('html' => $html));
            exit;
            break;
        case "insert_$filename":
            $manufacturers->checkFile('manufacturers_image', $_POST['id'], null, $allowed_image_types);
            $result = $manufacturers->insert($_POST);
            if ($result) {
                $arr = array(
                    'success' => true,
                    'id' => $result,
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
            $manufacturers->checkFile('manufacturers_image', $_POST['id'], null, $allowed_image_types);
            if (isset($_POST['id']) && $manufacturers->update($_POST)) {
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
            if ($manufacturers->delete($_POST['id'])) {
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
        case 'delete_image':
            $manufacturers->delFile($_POST['ID'], $_POST['field_name'], 'manufacturers');
            $sql = ("UPDATE manufacturers SET manufacturers_image='' WHERE manufacturers_id='{$_POST['ID']}'");
            tep_db_query($sql);
            echo json_encode(true);
            exit;
            break;
    }
    if (isset($_POST['status'])) {
        if ($manufacturers->statusUpdate($_POST['status'], $_POST['id'])) {
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
        var lang =<?php echo $manufacturers->getTranslation();?>;
    </script>
    <div class="container">
        <?php echo $manufacturers->getView(); ?>
    </div>

<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>