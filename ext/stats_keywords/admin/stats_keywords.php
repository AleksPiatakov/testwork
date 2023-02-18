<?php

require_once 'solomono/app/models/stats_keywords/stats_keywords.php';

$filename = basename(__FILE__, ".php");

$stats_keywords = new stats_keywords();


if (isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show') {
    $stats_keywords->query($_GET);
    echo json_encode($stats_keywords->data);
    exit;
}

if ($stats_keywords->isAjax()) {
    $action = $_GET['action'];
    switch ($action) {
        case "edit_word":
            $stats_keywords->selectWords();
            $html = $stats_keywords->getView("../../../../../ext/stats_keywords/admin/solomono/app/view/stats_keywords/form_swap");
            echo json_encode(array('html' => $html));
            exit;
            break;
        case 'translate':
            /*id language*/
            $from = $_GET['from'] ?: 1;
            $to = $_GET['to'] ?: 3;

            $arr = $stats_keywords->yandexTranslate($_POST, $from, $to);
            echo json_encode($arr);
            exit;
            break;
    }
    $action = $_POST['action'];
    switch ($action) {
        case "update_word_list":
            if ($stats_keywords->updateKeyList()) {
                $arr = array(
                    'success' => true,
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
        case "updateWord":
            $arr['success'] = $stats_keywords->updateWord($_POST['sws_id'], $_POST['field'], $_POST['value']);
            $arr['html'] = $stats_keywords->getView("../../../../../ext/stats_keywords/admin/solomono/app/view/stats_keywords/form_swap_temp");
            echo json_encode($arr);
            exit;
            break;
        case "insertWord":
            if (!empty($_POST['sws_word']) && !empty($_POST['sws_replacement'])) {
                $arr['success'] = $stats_keywords->insertWord($_POST['sws_word'], $_POST['sws_replacement']);
                $arr['html'] = $stats_keywords->getView("../../../../../ext/stats_keywords/admin/solomono/app/view/stats_keywords/form_swap_temp");
                echo json_encode($arr);
            }
            exit;
            break;
        case "deleteWord":
            if (!empty($_POST['sws_id'])) {
                $arr['success'] = $stats_keywords->deleteWord($_POST['sws_id']);
                $arr['html'] = $stats_keywords->getView("../../../../../ext/stats_keywords/admin/solomono/app/view/stats_keywords/form_swap_temp");
                echo json_encode($arr);
            }
            exit;
            break;
        case "delete_word_list":
            if ($stats_keywords->deleteKeyList()) {
                $arr = array(
                    'success' => true,
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
    }
}

?>

<?php
include_once('html-open.php');
include_once('header.php');
?>
<script>
    var lang=<?php echo $stats_keywords->getTranslation();?>;
</script>
<div class="container">
    <?php echo $stats_keywords->getView('../../../../../ext/stats_keywords/admin/solomono/app/view/stats_keywords/stats_keywords');?>
</div>

