<?php

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $rootPath = dirname(dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME']))));
    chdir('../../../');
    include $rootPath . "/includes/application_top.php";

    include DIR_WS_MODULES . "CustomizationPanel/functions/auth.php";
    include DIR_WS_MODULES . "CustomizationPanel/classes/CustomizationPanelRegistry.php";
    include DIR_WS_MODULES . "CustomizationPanel/classes/CustomizationPanelModel.php";
    include DIR_WS_MODULES . "CustomizationPanel/classes/CustomizationPanelController.php";

    try {
        if (CheckAuthentication()) {
            CustomizationPanelRegistry::set('template_name', TEMPLATE_NAME);
            $actionMethod = $_GET['action'];

            if (!empty($actionMethod)) {
                $customizationPanelController = new CustomizationPanelController();
                if (method_exists($customizationPanelController, $actionMethod)) {
                    $customizationPanelController->$actionMethod();
                } else {
                    throw new Exception("Method doesn't exist");
                }
            } else {
                throw new Exception("Empty action!");
            }
        } else {
            throw new Exception("Authorization failed!");
        }
    } catch (\Exception $e) {
        echo json_encode([
            "status"  => false,
            "message" => $e->getMessage()
        ]);
    }
}
