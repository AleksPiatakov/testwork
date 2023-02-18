<?php

$allowedDomains = ['demo.solomono.net', 'clo.solomono.net', 'gadgetorio.solomono.net', 'solo_health.solomono.net', 'solo_cellphones.solomono.net', 'solo_home.solomono.net'];
if ( !in_array($_SERVER['HTTP_HOST'], $allowedDomains)) {
    die;
}
$rootPath = __DIR__ . '/../../';
chdir($rootPath);

require_once 'includes/application_top.php';

define('DESIGN_UPDATE_SECRET', '9955615397');

$response = [];

try {
    $result = true;
    if (!isset($_GET['secret']) || $_GET['secret'] !== DESIGN_UPDATE_SECRET) {
        throw new Exception('Invalid secret key');
    }

    //get this DB name
    $thisDBName = getenv('DB_DATABASE');

    //get this template code
    $templateCode = getConstantValue('DEFAULT_TEMPLATE', 'false');
    if ($templateCode == 'false') {
        throw new Exception('Invalid default template code');
    }

    //get this template id
    $sql = "SELECT template_id FROM " . TABLE_TEMPLATE . " WHERE template_name = '" . $templateCode . "'";
    $query = tep_db_query($sql);
    $templateId = tep_db_fetch_array($query)['template_id'];
    if (empty($templateId)) {
        throw new Exception('Invalid template id');
    }

    //collect data of this template
    $designData = [];
    $sql = "SELECT * FROM " . TABLE_INFOBOX_CONFIGURATION . " WHERE template_id = '" . $templateId . "'";
    $query = tep_db_query($sql);
    while ($row = tep_db_fetch_array($query)) {
        $designData[] = $row;
    }
    if (empty($designData)) {
        throw new Exception('Empty template design data');
    }

    //collect all templates DB names
    $templateDBNames = [
        'demo_clo',
        'demo_demo',
        'demo_gadgetorio',
        'demo_solo_cellphones',
        'demo_solo_health',
        'demo_solo_home',
        'demo_dev'
    ];

    //remove this DB from array of target DB-s
    $templateDBNames = array_filter($templateDBNames, function ($v) use ($thisDBName) {
        return $v != $thisDBName;
    });

    //for each template create design update sql queries
    $message = [];
    foreach ($templateDBNames as $templateDBName) {
        //extra line before new connection
        if (!empty($message)) {
            $message[] = '';
        }

        //check is DB exist
        $sql = "SELECT COUNT(*) AS `exists` FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMATA.SCHEMA_NAME='" . $templateDBName . "'";
        $query = tep_db_query($sql);
        if (tep_db_fetch_array($query)['exists'] == 0) {
            $result = false;
            $message[] = 'DataBase ' . $templateDBName . ' not found: error!';
            continue;
        }

        //connect to DB
        $link = mysqli_connect(getenv('DB_HOST'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), $templateDBName);
        if ($link == false) {
            $result = false;
            $message[] = 'Connect to ' . $templateDBName . ': error!';
            continue;
        }
        $message[] = 'Connect to ' . $templateDBName . ': success';

        //collect design ids
        foreach ($designData as $index => $designRowData) {
            //unset id of source DB and target id from previous connection
            unset($designData[$index]['infobox_id']);

            //check is design setting in target DB exist and collect target id
            $sql = "SELECT `infobox_id` FROM `" . TABLE_INFOBOX_CONFIGURATION . "` WHERE `infobox_define` = '" . $designRowData['infobox_define'] . "' and `template_id` = '" . $templateId . "'";
            $query = mysqli_query($link, $sql);
            if (is_object($query) && mysqli_num_rows($query) > 0) {
                //get design setting id in target DB
                $designData[$index]['infobox_id'] = mysqli_fetch_assoc($query)['infobox_id'];
            }
        }

        //delete all design`s data
        $sql = "DELETE FROM `" . TABLE_INFOBOX_CONFIGURATION . "` WHERE `template_id` = '" . $templateId . "'";
        if (mysqli_query($link, $sql)) {
            $message[] = 'Design cleaning: success';
        } else {
            $result = false;
            $message[] = 'Design cleaning: error!';
        }

        //insert all design`s data
        reset($designData);
        foreach ($designData as $designRowData) {
            //collect query
            $sqlParams = '';
            foreach ($designRowData as $k => $v) {
                $sqlParams .= "`{$k}` = " . "'" . $v . "', ";
            }
            $sqlParams = substr($sqlParams, 0, -2);

            $sql = "INSERT INTO `" . TABLE_INFOBOX_CONFIGURATION . "` SET {$sqlParams} ON DUPLICATE KEY UPDATE {$sqlParams}";

            if (!mysqli_query($link, $sql)) {
                $result = false;
                $message[] = 'Design update of ' . $designRowData['infobox_define'] . ': error!';
            }
        }
    }

    $message = implode('<br>', $message);
    $response = [
        'status'  => $result,
        'message' => $message,
    ];
} catch (Exception $exception) {
    $response = [
        'status'  => false,
        'message' => $exception->getMessage(),
    ];
}

header('Content-Type: application/json');

echo json_encode($response);
