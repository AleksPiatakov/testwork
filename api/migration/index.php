<?php

$rootPath = __DIR__ . '/../../';
chdir($rootPath);

require_once 'includes/application_top.php';

define('ADMINER_ROOT', DIR_WS_MODULES . 'migration_classes/');

define('SERVER', DB_SERVER); // eg, localhost - should not be empty for productive servers
define('USERNAME', DB_SERVER_USERNAME);
define('PASSWORD', DB_SERVER_PASSWORD);
define('DB', DB_DATABASE);

function adminer_object()
{
    class AdminerDump extends Adminer
    {
        function credentials()
        {
            return array(SERVER, USERNAME, PASSWORD);
        }
    }

    return new AdminerDump();
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
$sqlFiles = [];
$currentVersion = getConstantValue('MIGRATION_VERSION','0048.sql');
// проблема с базовым файлом, если его перетирать, то тогда будут удалятся созданные заказы, статьи и тд
// возможно стоит дампить важную инфу перед обновлением базы
//if (empty($currentVersion)) {
//    $sqlFiles[] = __DIR__ . '/migrations/base.sql';
//}

$upFiles = array_map(function ($path) {
    return basename($path);
}, glob(__DIR__ . '/up/*.sql'));

if (!empty($currentVersion)) {
    $lastUpFileIndex = array_search($currentVersion, $upFiles);
    if ($lastUpFileIndex !== false) {
        $upFiles = array_splice($upFiles, $lastUpFileIndex + 1, count($upFiles));
    }
}

$upFiles = array_map(function ($filename) {
    return __DIR__ . '/up/' . $filename;
}, $upFiles);

$sqlFiles = array_merge($sqlFiles, $upFiles);

define('MINIFICATION_SECRET', '9955615397');

header('Content-Type: application/json');

$response = [];

try {
    if (!isset($_GET['secret']) || $_GET['secret'] !== MINIFICATION_SECRET) {
        throw new Exception('Invalid secret key');
    }

    foreach ($sqlFiles as $sqlFile) {
        $_POST = [
            'webfile'     => true,
            'only_errors' => true,
            'filepath'    => $sqlFile,
        ];

        $_GET['import'] = true;
        $error          = false;
        include ADMINER_ROOT . "sql.inc.php";
    }

    $lastUpFilename = end($sqlFiles);
    if ($lastUpFilename && basename($lastUpFilename) !== 'base.sql') {
        $query = tep_db_query("update configuration SET configuration_value = '".basename($lastUpFilename)."' where configuration_key = 'MIGRATION_VERSION'");
    }

    if (!$sqlFiles) {
        throw new Exception('Nothing to update');
    }

    $response = [
        'status'  => true,
        'message' => 'Migration success' . PHP_EOL . implode(PHP_EOL, $sqlFiles),
    ];
} catch (Exception $exception) {
    $response = [
        'status'  => false,
        'message' => $exception->getMessage(),
    ];
}

echo json_encode($response);
