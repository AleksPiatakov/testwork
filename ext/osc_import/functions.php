<?php

define('PRODUCTS_IMAGES_JSON_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'products_images.json');
function createTableIfNotExist($tablesData, $table, $connection, $prefix = '')
{
    $prefix               = $prefix ? "{$prefix}_" : '';
    $createTableStatement = str_ireplace("CREATE TABLE `{$table}`", "CREATE TABLE IF NOT EXISTS `{$prefix}{$table}`", $tablesData[$table]['sql']);
    $connection->query($createTableStatement);
}

function truncateTables($tables, $connection, $prefix = '')
{
    if ($prefix) {
        $prefix = "{$prefix}_";
    }
    foreach (array_keys($tables) as $table) {
        truncateTable($table, $connection, $prefix);
    }
}

function truncateTable($table, $connection, $prefix = '')
{
    if ($prefix) {
        $prefix = "{$prefix}_";
    }
    $connection->query("TRUNCATE TABLE `{$prefix}{$table}`");
}

function isTableExist($tableName, $connection)
{
    return $connection->query("SELECT * FROM `information_schema`.`TABLES` WHERE `TABLE_NAME` = '{$tableName}' LIMIT 1")->num_rows;
}

function alterTables($sql, $connection)
{
    $query  = $connection->query($sql);
    $alters = [];
    while ($row = $query->fetch_assoc()) {
        $alters[] = $row['queries'];
    }
    //    $query->free_result();
    array_map(function ($sql) use ($connection) {
        $connection->query($sql);
    }, $alters);
}

function generateSolomonoTables($current_db, $connection)
{
    $tables = [];
    $sql    = "SELECT
                isc.TABLE_SCHEMA,
                isc.TABLE_NAME,
                isc.COLUMN_NAME,
                isc.COLUMN_TYPE,
                isc.IS_NULLABLE
                FROM information_schema.columns isc
                WHERE isc.TABLE_SCHEMA = '{$current_db}'";
    $result = $connection->query($sql);
    if ($result->num_rows) {
        while ($column = $result->fetch_assoc()) {
            $tables[$column['TABLE_NAME']][] = $column['COLUMN_NAME'];
        }
    }
    return $tables;
}

function mapImagesInDB($connection)
{
    #todo image mapping from old osc
    # plz, remove this
}

function checkProductsImages($connection)
{
    $imagesQuery = $connection->query("SELECT products_id, products_image FROM " . TABLE_PRODUCTS);
    $images      = [];
    $fileExist   = $total = 0;
    while ($row = $imagesQuery->fetch_assoc()) {
        foreach (explode(';', $row['products_image']) as $image) {
            $status                        = file_exists(DIR_FS_CATALOG_IMAGES . 'products/' . $image);
            $images[$row['products_id']][] = [
              'file'   => $image,
              'status' => false,
              'exist'  => $status,
            ];
            if ($status) {
                $fileExist++;
            }
            $total++;
        }
    }
    if ($images && $total > $fileExist) {
        file_put_contents(
            PRODUCTS_IMAGES_JSON_PATH,
            json_encode([
            'images'                => $images,
            'total'                 => $total,
            'exist'                 => $fileExist,
            'processed'             => 0,
            'inProgress'            => false,
            'completeMessageShowed' => false,
            ])
        );
    }
}

function getArrayFromJsonFile($filePath)
{
    if (file_exists($filePath)) {
        return json_decode(file_get_contents($filePath), true);
    }
    return [];
}

function saveImg($url, $file)
{
    global $imageFolder;
    $filename_arr = explode('/', $file);
    $filename     = basename($file);
    $path = $imageFolder . 'products/';
    // create children folder
    foreach ($filename_arr as $folder) {
        if ($folder !== $filename) {
            if (!file_exists($path . $folder)) {
                mkdir($path . $folder . '/');
            }
            $path .= $folder . '/';
        }
    }
    if (!file_exists($imageFolder . 'products/' . $file)) {
        // $img = file_get_contents($url); don't work if allow_url_fopen set to off on server
        // replace space to %20 because space incorrect in url
        // not used urlencode because urlencode replaces to +
        $url = str_replace(' ', '%20', $url);
        $img = getImgContentsCurl($url);
        $path = $imageFolder . 'products/' . $file;
        file_put_contents($path, $img);
    }
    return $filename;
}

/**
 * Receive URL and return content
 * @param $url
 * @return bool|string
 */
function getImgContentsCurl($url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $data = curl_exec($ch);

    curl_close($ch);

    return $data;
}

class db
{

    var $connection;

    function __construct($db_host, $db_username, $db_password)
    {
        $this->connection = new mysqli($db_host, $db_username, $db_password);
        $this->error();
    }

    function query($sql)
    {
        $query = $this->connection->query($sql);
        $this->error($sql);
        return $query;
    }

    function select_db($db)
    {
        $this->connection->select_db($db);
        $this->error();
    }

    function error($sql = '')
    {
        if ($this->connection->errno) {
            echo $sql . "\n";
            echo "MYSQL error no: " . $this->connection->errno . "\n";
            echo "Error: " . $this->connection->error . "\n";
            die;
        }
    }

    function multi_query($query)
    {
        $this->connection->multi_query($query);
        $this->error($query);
    }

    function next_result()
    {
        return $this->connection->next_result();
    }

    function more_results()
    {
        return $this->connection->more_results();
    }
}

/**
 * Catches errors with write permissions when loading sql file
 * @param $errno
 * @param $errstr
 */
function warning_handler_folder_access($errno, $errstr)
{
    switch ($errstr) {
        case 'mkdir(): Permission denied':
            echo OSC_IMPORT_PERMISSION_ERROR;
            break;
        case 'move_uploaded_file(C:\OSPanel\domains\demo-solomono\ext\osc_import\files/db.sql): failed to open stream: No such file or directory':
            echo OSC_IMPORT_UPLOAD_ERROR;
            break;
        case 'move_uploaded_file(): Unable to move \'C:\OSPanel\userdata\php_upload\php6E66.tmp\' to \'C:\OSPanel\domains\demo-solomono\ext\osc_import\files/db.sql\'':
            echo OSC_IMPORT_UNABLE_MOVE_ERROR;
            break;
        default:
            echo OSC_IMPORT_DEFAULT_ERROR;
            break;
    }
}

$dotenv         = parse_ini_file(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '.env');
$connection     = new db($dotenv['DB_HOST'], $dotenv['DB_USERNAME'], $dotenv['DB_PASSWORD']);
$dbname         = $dotenv['DB_DATABASE'];
$solomonoTables = generateSolomonoTables($dbname, $connection);
