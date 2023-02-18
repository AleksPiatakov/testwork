<?php

use admin\includes\solomono\app\models\email_content\email_content;

$filename = basename(__FILE__, ".php");

$email_content = new email_content();
$allowed_image_types = ['image/jpeg','image/gif','image/png','image/webp'];

if (isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show') {
    $email_content->query($_GET);
    echo json_encode($email_content->data);
    exit;
}

if ($email_content->isAjax()) {
    $action = $_GET['action'];
    switch ($action) {
        case "edit_$filename":
        case "new_$filename":
            $id = $_GET['id'] ? $_GET['id'] : false;
            $email_content->selectOne($id);
            $html = $email_content->getView("email_content/formLang");
            echo json_encode(array('html' => $html));
            exit;
            break;
        case "insert_$filename":
            $email_content->checkFile('email_content_image', $_POST['id'], null, $allowed_image_types);
            if ($email_content->insert($_POST)) {
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
            $email_content->checkFile('email_content_image', $_POST['id'], null, $allowed_image_types);
            if ($email_content->update($_POST)) {
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
            if ($email_content->delete($_POST['id'])) {
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

include_once('html-open.php');
include_once('header.php');
?>
<script>
    var lang=<?php echo $email_content->getTranslation();?>;
</script>
<div class="container">
    <?php echo $email_content->getView();?>
</div>