<?php

require_once 'solomono/app/models/ship2pay/ship2pay.php';

function getTreeOption($arr, $depth = 0, $selected_id = false)
{
    $html = '';
    foreach ($arr as $k => $v) {
        if (is_array($selected_id)) {
            $selected = in_array($k, $selected_id) ? 'selected' : '';
        } else {
            $selected = $selected_id == $k ? 'selected' : '';
        }
        $html .= '<option ' . $selected . ' value="' . $k . '">';
        $html .= str_repeat('&nbsp;', $depth * 3);
        $html .= $v . '</option>';
    }
    return $html;
}

$filename = basename(__FILE__, ".php");
$ship2pay = new ship2pay();

if (isset($_GET['ajax_load']) && $_GET['ajax_load'] === 'show') {
    $ship2pay->query($_GET);
    echo json_encode($ship2pay->data);
    exit;
}

if ($ship2pay->isAjax()) {
    $action = $_GET['action'];
    switch ($action) {
        case "edit_$filename":
        case "new_$filename":
            $id = $_GET['id'] ? $_GET['id'] : false;
            $ship2pay->selectOne($id);
            $selected_methods = explode(';', $ship2pay->data['data']['payments_allowed']);
            $ship2pay->data['option']['payments_allowed'] = getTreeOption(
                $ship2pay->data['option']['payments_allowed'],
                0,
                $selected_methods
            );
            $html = $ship2pay->getView("form");
            echo json_encode(['html' => $html]);
            exit;
        case "insert_$filename":
            $id = $ship2pay->findDuplicateRows($_POST);
            if (empty($id)) {
                if ($result = $ship2pay->insert($_POST)) {
                    $arr = [
                        'success' => true,
                        'id' => $result['id'],
                        'msg' => TEXT_SAVE_DATA_OK,
                    ];
                } else {
                    $arr = [
                        'success' => false,
                        'msg' => TEXT_ERROR
                    ];
                }
            } else {
                $arr = [
                    'link' => tep_href_link('ship2pay.php', tep_get_all_get_params(array('action','id')) . 'action=edit_ship2pay&id=' . $id, 'NONSSL'),
                    'msg' => TEXT_INFO_SHIP2PAY_ZONE_ALREADY_EXIST
                ];
            }

            echo json_encode($arr);
            exit;
        case "update_$filename":
            $id = $ship2pay->findDuplicateRows($_POST);
            if (empty($id)) {
                if ($ship2pay->update($_POST)) {
                    $arr = array(
                        'success' => true,
                        'msg' => TEXT_SAVE_DATA_OK,
                    );
                } else {
                    $arr = [
                        'success' => false,
                        'msg' => TEXT_ERROR
                    ];
                }
            } else {
                $arr = [
                    'link' => tep_href_link('ship2pay.php', tep_get_all_get_params(array('action', 'id')) . 'action=edit_ship2pay&id=' . $id, 'NONSSL'),
                    'msg' => TEXT_INFO_SHIP2PAY_ZONE_ALREADY_EXIST
                ];
            }

            echo json_encode($arr);
            exit;
        case 'translate':
            /*id language*/
            $from = $_GET['from'] ?: 1;
            $to = $_GET['to'] ?: 3;
            $arr = $ship2pay->yandexTranslate($_POST, $from, $to);
            echo json_encode($arr);
            exit;
    }

    $action = $_POST['action'];
    switch ($action) {
        case "delete_$filename":
            $arr = [
                'success' => false,
                'msg' => TEXT_ERROR
            ];
            if ($ship2pay->delete($_POST['id'])) {
                $arr = [
                    'success' => true,
                    'msg' => TEXT_SAVE_DATA_OK
                ];
            }

            echo json_encode($arr);
            exit;
    }

    if (isset($_POST['status'])) {
        $array = [
            'success' => false,
            'msg' => TEXT_ERROR
        ];
        if ($ship2pay->statusUpdate($_POST['status'], $_POST['id'])) {
            $array = [
                'success' => true,
                'msg' => TEXT_SAVE_DATA_OK,
            ];
        }

        echo json_encode($array);
        exit;
    }
}
include_once('html-open.php');
include_once('header.php');
?>
<script>
    var lang =<?= $ship2pay->getTranslation();?>;
    $(document).ready(function () {
        widthOfModal = '60%';
    });
</script>
<div class="container">
    <?= $ship2pay->getView(); ?>
</div>
<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>