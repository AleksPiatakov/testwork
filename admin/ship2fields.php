<?php
use admin\includes\solomono\app\models\ship2fields\ship2fields;

require_once('includes/application_top.php');

require 'includes/solomono/app/models/ship2fields/ship2fields.php';
include 'includes/languages/' . $language . '/ship2fields.php';
$ship2fields = new ship2fields();

if (isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show') {
    $ship2fields->query($_GET);
    echo json_encode($ship2fields->data);
    exit;
}

$action = (isset($_GET['action']) ? $_GET['action'] : (isset($_POST['action']) ? $_POST['action'] : ''));
if ($ship2fields->isAjax()) {
    switch ($action) {
        //edit
        case 'edit_ship2fields':
        case 'new_ship2fields':
            $id = $_GET['id'] ? $_GET['id'] : false;
            $ship2fields->selectOne($id, $_GET);
            $html = $ship2fields->getView("formLang");
            echo json_encode(array('html' => $html));
            exit;
            break;
        //update
        case 'update_ship2fields':
        case 'insert_ship2fields':
            $method = strpos($action, 'update') !== false ? 'update' : 'insert';
            if ($response = $ship2fields->$method($_POST)) {
                if (is_array($response)) {
                    $arr = $response;
                    $arr['msg'] = TEXT_SAVE_DATA_OK;
                } else {
                    $arr = array(
                        'success' => $response,
                        'msg' => TEXT_SAVE_DATA_OK,
                    );
                }
            } else {
                $arr = array(
                    'success' => false,
                    'msg' => TEXT_ERROR
                );
            }
            echo json_encode($arr);
            exit;
            break;
        //delete
        case 'delete_ship2fields':
            if ($ship2fields->delete($_POST['id'])) {
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

    if (isset($_POST['status']) && isset($_POST['field'])) {
        if ($ship2fields->statusUpdate($_POST['status'], $_POST['id'], $_POST['field'])) {
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

//prevent empty page on reload
if (strpos($_GET['action'], 'ship2fields') !== false) {
    unset($_GET['action']);
}