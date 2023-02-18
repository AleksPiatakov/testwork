<?php

use admin\includes\solomono\app\models\api_keys\api_keys;

require_once 'includes/application_top.php';
require_once __DIR__ . '/app/model/api_keys.php';


$filename = basename(__FILE__, ".php");
$api_keys = new api_keys();

if (isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show') {
    $api_keys->query($_GET);
    die(json_encode($api_keys->data));
}

if ($api_keys->isAjax()) {
    $action = $_GET['action'];
    switch ($action) {
        case "edit_$filename":
        case "new_$filename":
            $id = isset($_GET['id']) ? $_GET['id'] : false;
            $api_keys->selectOne($id);

            // if there is create api key action, generate new one
            if (!$id) {
                $api_keys->data['data']['api_key'] = $api_keys->generateApiKey();
            }

            ob_start();
            $action = $filename;
            $data = $api_keys->data;
            require_once __DIR__ . '/app/view/form.php';
            $html = ob_get_contents();
            ob_end_clean();

            die(json_encode(array('html' => $html)));
        case "insert_$filename":
            $result = $api_keys->insert($_POST);
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
            die(json_encode($arr));
        case "update_$filename":
            if ($api_keys->update($_POST)) {
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
            die(json_encode($arr));
    }
    $action = $_POST['action'];
    switch ($action) {
        case "delete_$filename":
            if ($api_keys->delete($_POST['id'])) {
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
            die(json_encode($arr));
    }
    if (isset($_POST['status'])) {
        if ($api_keys->statusUpdate($_POST['status'], $_POST['id'], 'api_key_status')) {
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
        die(json_encode($array));
    }
}

?>

<?php
include_once('html-open.php');
include_once('header.php');

?>
    <script>
        var lang =<?php echo $api_keys->getTranslation();?>;
    </script>
    <div class="container">
        <?php echo $api_keys->getView(); ?>
    </div>

<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
