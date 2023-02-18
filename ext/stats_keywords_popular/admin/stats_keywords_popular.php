<?php

require_once 'solomono/app/models/stats_keywords_popular/stats_keywords_popular.php';

$filename = basename(__FILE__, ".php");

$search_keywords = new stats_keywords_popular();


if (isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show') {
    $search_keywords->query($_GET);
    echo json_encode($search_keywords->data);
    exit;
}

if ($search_keywords->isAjax()) {
    $action = $_GET['action'];
    switch ($action) {
        case "edit_$filename":
        case "new_$filename":
            $id = $_GET['id'] ? $_GET['id'] : false;
            $search_keywords->selectOne($id);
            $html = $search_keywords->getView("formLang");
            echo json_encode(array('html' => $html));
            exit;
            break;
        case "insert_$filename":
            $insertResult = $search_keywords->insert($_POST);
            if ($insertResult) {
                $arr = array(
                    'success' => true,
                    'id' => $insertResult['id'],
                    'reload' => true,
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
            if ($search_keywords->update($_POST)) {
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
            if ($search_keywords->delete($_POST['id'])) {
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
        var lang=<?php echo $search_keywords->getTranslation();?>;
        if(!lang.currentPage)
            lang.currentPage = {};
    </script>
    <div class="container">
        <?php echo $search_keywords->getView();?>
    </div>

<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>