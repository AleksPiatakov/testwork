<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 21.04.2020
 * Time: 22:15
 */
if (strstr($_SERVER['PHP_SELF'],'controller.php')){die;}
define('ADMINER_ROOT', DIR_FS_DOCUMENT_ROOT . DIR_WS_MODULES . 'migration_classes/');

define('SERVER', DB_SERVER); // eg, localhost - should not be empty for productive servers
define('USERNAME', DB_SERVER_USERNAME);
define('PASSWORD', DB_SERVER_PASSWORD);
define('DB',DB_DATABASE);
if (!file_exists(BACKUP_FOLDER)){
    if (strstr(strtolower(PHP_OS), 'win')) {
        mkdir(BACKUP_FOLDER, 775, true);
    } else {
        system("mkdir -m 775 -p " . BACKUP_FOLDER);
    }
}


function adminer_object() {
    class AdminerDump extends Adminer {
        function credentials() {
            return array(SERVER, USERNAME, PASSWORD);
        }
    }
    return new AdminerDump;
}

include ADMINER_ROOT . "include/tmpfile.inc.php";
include ADMINER_ROOT . "include/functions.inc.php";
include ADMINER_ROOT . "include/lang.inc.php";
include ADMINER_ROOT . "include/pdo.inc.php";
include ADMINER_ROOT . "include/driver.inc.php";
include ADMINER_ROOT . "drivers/mysql.inc.php";
include ADMINER_ROOT . "include/adminer.inc.php";
include ADMINER_ROOT . "include/editing.inc.php";
$connection = connect();
$connection->select_db(DB);

switch ($method){
    case 'import':
        $dumpFilename = $_POST['filename'];
        switch ($action) {
            case "delete":
                include_once 'delete.php';
                die;
                break;
        }
        include_once 'import.php';
        break;
    case 'export':
        include_once 'export.php';
        break;
    default:
        die;
}