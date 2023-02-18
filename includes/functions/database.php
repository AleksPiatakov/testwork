<?php

use App\Logger\Log;

require_once __DIR__ . '/../classes/Database/Mysqli/Connector.php';

function DB()
{
    return Connector::getInstance()->getConnection();
}

function tep_db_connect()
{
    $link = DB();
    if(getenv('SET_NAMES')!=false){
        $link->query("SET NAMES '".getenv('SET_NAMES')."'");
    }
    $link->query("SET SESSION sql_mode=''");
    $timeZoneArray = explode(' ', DB_TIME_ZONE);
    if ( !empty($timeZoneArray[1])) {
        $link->query("SET @@session.time_zone = '" . str_replace(['(', ')'],'', $timeZoneArray[1]) . "';");
    }
    if (getenv('SET_CHARACTER') != false) {
        $link->query("SET CHARACTER '" . getenv('SET_CHARACTER') . "'");
    }
    return $link;
}

function tep_db_close($link = 'db_link')
{
    return mysqli_close(DB());
}


/**
 * @param $query
 * @param $errno
 * @param $error
 * @return string
 */
function tep_db_error($query, $errno, $error)
{
    $data = [
        'errno' => $errno,
        'error' => $error,
        'query' => $query,
        'SERVER_NAME' => $_SERVER['SERVER_NAME'],
        'REMOTE_ADDR' => $_SERVER['REMOTE_ADDR'],
        'HTTP_REFERER' => $_SERVER['HTTP_REFERER'],
        'REQUEST_URI' => $_SERVER['REQUEST_URI'],
    ];
    Log::critical('MYSQL QUERY ERROR REPORT', $data);

    if (defined('SOLOMONO_ADMINS_EMAIL_ADDRESS')) {
        $msg = "\n" . 'MYSQL QUERY ERROR REPORT' . "\n" . " - " . date("d/m/Y H:m:s", time()) . "\n" . '---------------------------------------' . "\n";
        $msg .= $errno . ' - ' . $error . "\n\n" . $query . "\n";
        $msg .= '---------------------------------------' . "\n";
        $msg .= 'Server Name   : ' . $data['SERVER_NAME'] . "\n";
        $msg .= 'Remote Address: ' . $data['REMOTE_ADDR'] . "\n";
        $msg .= 'Referer       : ' . $data["HTTP_REFERER"] . "\n";
        $msg .= 'Requested     : ' . $data["REQUEST_URI"] . "\n";
        mail('admin@solomono.net', 'Проблемы с MySQL сервером!', $msg, 'From: db_error@' . $data["SERVER_NAME"]);
    }

    die(json_encode($data));
}

function tep_db_query($query)
{

    static $queries;
    global $query_counts;
    global $query_total_time;
    $query_counts++;

    $start = microtime(true);

    $queryHash = md5($query);
    if (isset($queries[$queryHash]) && $queries[$queryHash] instanceof mysqli_result) {
        $result = $queries[$queryHash];
        $result->data_seek(0);
    } else {
        $queries[$queryHash] = $result = DB()->query($query);
    }

    $parseTime = round((microtime(true) - $start), 2);

    if ($parseTime > 2) {
        Log::alert('Mysql Time query', [
            'query' => tep_db_input($query),
            'time' => $parseTime,
            'SCRIPT_FILENAME' => $_SERVER["SCRIPT_FILENAME"],
        ]);
    }

    $mysqlPerformanceTreshold = (defined('MYSQL_PERFORMANCE_TRESHOLD') and MYSQL_PERFORMANCE_TRESHOLD > 0) ? MYSQL_PERFORMANCE_TRESHOLD : 2;
    if ($parseTime > $mysqlPerformanceTreshold) {
        $logFile = DIR_FS_LOGS . '/MYSQL/admin/slow_query/slow_query_log.txt';
        $slowDateTime = date('F j, Y, g:i a', time());
        $slowQuery = tep_db_input($query) . "\t" . $_SERVER["SCRIPT_FILENAME"] . "\t" . $parseTime . "\t" . $slowDateTime . "\r\n";
        $dirname = dirname($logFile);
        if (!is_dir($dirname)) {
            mkdir($dirname, 0755, true);
        }
        $slowLogFile = fopen($logFile, 'a');
        fwrite($slowLogFile, $slowQuery);
        fclose($slowLogFile);
    }

    $query_total_time += $parseTime;

    if (!$result) {
        tep_db_error($query, mysqli_errno(DB()), mysqli_error(DB()));
    }

    return $result;
}

/**
 * @param $table
 * @param $data
 * @param string $action
 * @param string $parameters
 * @param string $link
 * @return mixed
 */
function tep_db_perform($table, $data, $action = 'insert', $parameters = '', $link = 'db_link')
{
    //    global DB();
    global $saveDbPrepareInput;
    reset($data);

    if ($action == 'insert') {
        $query = 'insert into ' . $table . ' (';
        foreach ($data as $columns => $value) {
//        while (list($columns,)=each($data)) {
            $query .= "`{$columns}`" . ', ';
        }
        $query = substr($query, 0, -2) . ') values (';
        reset($data);
        foreach ($data as $key => $value) {
//        while (list(, $value)=each($data)) {
            switch ((string)$value) {
                case 'now()':
                    $query .= 'now(), ';
                    break;
                case 'null':
                    $query .= 'null, ';
                    break;
                default:
                    if (!in_array($value, $saveDbPrepareInput)) {
                        $query .= '\'' . tep_db_input($value) . '\', ';
                    }else {
                        $query .= '\'' . $value . '\', ';
                    }
                    break;
            }
        }
        $query = substr($query, 0, -2) . ')';
    } elseif ($action == 'insertodku') {
        $query = [];
        foreach ($data as $key => $value) {
            $query[] = "`{$key}` = " . '\'' . tep_db_input($value) . '\'';
        }
        $query = implode(',', $query);
        $query = "INSERT INTO `{$table}` SET $query ON DUPLICATE KEY UPDATE {$query}";
    } elseif ($action == 'update') {
        $query = 'update ' . $table . ' set ';
        foreach ($data as $columns => $value) {
//        while (list($columns, $value)=each($data)) {
            switch ((string)$value) {
                case 'now()':
                    $query .= $columns . ' = now(), ';
                    break;
                case 'null':
                    $query .= $columns .= ' = null, ';
                    break;
                default:
                    $query .= $columns . ' = \'' . tep_db_input($value) . '\', ';
                    break;
            }
        }
        $query = substr($query, 0, -2) . ' where ' . $parameters;
    }

    return tep_db_query($query, DB());
}

function tep_db_fetch_array($db_query)
{
    return $db_query ? mysqli_fetch_assoc($db_query) : null;
}

function tep_db_num_rows($db_query)
{
    return mysqli_num_rows($db_query);
}

function tep_db_data_seek($db_query, $row_number)
{
    return mysqli_data_seek($db_query, $row_number);
}

function tep_db_insert_id()
{
    return DB()->insert_id;
}

function tep_db_free_result($db_query)
{
    mysqli_free_result($db_query);
}

function tep_db_input($string, $stripTags = true)
{
    if (function_exists('mysqli_real_escape_string')) {
        $string = mysqli_real_escape_string(DB(), $string);
    } elseif (function_exists('mysqli_escape_string')) {
        $string = mysqli_escape_string(DB(), $string);
    }
    if ($stripTags) {
        $string = tep_db_strip_tags($string);
    }
    return $string;
}

function tep_db_prepare_input($string)
{
    global $saveDbPrepareInput;
    if (is_string($string)) {
        if (!in_array($string, $saveDbPrepareInput)) {
            $string = tep_db_input(tep_db_strip_tags(trim(tep_db_sanitize_string(stripslashes($string)))));
            $saveDbPrepareInput[] = $string;
        }
        return $string;
    } elseif (is_array($string)) {
        reset($string);
        foreach ($string as $key => $value) {
            $string[$key] = tep_db_prepare_input($value);
        }
        return $string;
    } else {
        if (!in_array($string, $saveDbPrepareInput)) {
            $string = tep_db_input(trim(stripslashes(tep_db_strip_tags($string))));
            $saveDbPrepareInput[] = $string;
        }
        return $string;
    }
}

function tep_db_strip_tags($string)
{
    return strip_tags($string, '<p><div><span><br><b><a>');
}

function tep_db_sanitize_string($string)
{
    $string = preg_replace('/ +/', ' ', trim($string));

    return preg_replace("/[<>]/", '_', $string);
}
