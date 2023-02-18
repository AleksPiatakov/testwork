<?php
require_once('includes/application_top.php');
switch ($_GET['action']){
    case 'set_menu_location':
        tep_db_query("update " . TABLE_CONFIGURATION . " 
            set configuration_value = '".(int)$_GET['value']."'
            where configuration_key  = 'MENU_LOCATION'
        ");
        break;
    case 'errorsAlert':
        $sessionAlertErrors = [];
        if (!empty($_SESSION['alertErrors'])) {
            foreach ($_SESSION['alertErrors'] as $k => $v) {
                $sessionAlertErrors[$k]['text'] = constant($v['text']);
                $sessionAlertErrors[$k]['type'] = $v['type'];
            }
        }
        echo json_encode($sessionAlertErrors);
        break;
    case 'set_critical_css_status':
        if($_GET['status'] == 1){
            $_SESSION['alertErrors']['critical_css_txt'] = [
                "text" => "CRITICAL_CSS_TXT_RECOMMENDATION_TEXT",
                "type" => "alert_danger"
            ];
            echo json_encode('add critical_alert');
        }else{
            unset($_SESSION['alertErrors']['critical_css_txt']);
            echo json_encode('remove critical_alert');
        }
        break;
    case 'generateRobotsTxt':
        rewriteRobots(true);
        $domenInRobotsTxt = readRobotsHost();

        if(strpos($domenInRobotsTxt, $_SERVER["HTTP_HOST"])){
            $response = array('success' => true);
        } else {
            $response = array('success' => false, 'message' => TEXT_ERROR);
        }
        echo json_encode($response);
        break;
}