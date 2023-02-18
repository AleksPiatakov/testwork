<?php
/*
  $Id: database.php,v 1.1.1.1 2003/09/18 19:03:42 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

//require_once $rootPath . '../../includes/classes/Database/Mysqli/Connector.php';

//session_start();
$dbLink = null;
function DB()
{
    global $dbLink;
//    $link = null;
    if(!$dbLink instanceof mysqli){
        $dbLink = new mysqli(
            DB_SERVER,
            DB_SERVER_USERNAME,
            DB_SERVER_PASSWORD,
            DB_DATABASE
        );
    }
    return $dbLink;
}

function tep_db_connect()
{
    $link = DB();
    $link->query("SET NAMES 'utf8mb4'");
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
//    global DB();

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
    \App\Logger\Log::critical('MYSQL QUERY ERROR REPORT', $data);

    if (defined('SOLOMONO_ADMINS_EMAIL_ADDRESS')) {
        $msg = "\n" . 'MYSQL QUERY ERROR REPORT' . "\n" . " - " . date("d/m/Y H:m:s", time()) . "\n" . '---------------------------------------' . "\n";
        $msg .= $errno . ' - ' . $error . "\n\n" . $query . "\n";
        $msg .= '---------------------------------------' . "\n";
        $msg .= 'Server Name   : ' . $data['SERVER_NAME'] . "\n";
        $msg .= 'Remote Address: ' . $data['REMOTE_ADDR'] . "\n";
        $msg .= 'Referer       : ' . $data["HTTP_REFERER"] . "\n";
        $msg .= 'Requested     : ' . $data["REQUEST_URI"] . "\n";
        mail(DB_ERR_MAIL, 'Проблемы с MySQL сервером!', $msg, 'From: db_error@' . $data["SERVER_NAME"]);
    }

    die(json_encode($data));
}

function tep_db_query($query,$cache_queries=true)
{

    static $queries;
    global $query_counts;
    global $query_total_time;
    $query_counts++;

    $start = microtime(true);
    $cache_queries = is_bool($cache_queries) ? $cache_queries : true;

    $queryHash = md5($query);
    if (isset($queries[$queryHash]) && $queries[$queryHash] instanceof mysqli_result && $cache_queries) {
        $result = $queries[$queryHash];
        $result->data_seek(0);
    } else {
        $queries[$queryHash] = $result = DB()->query($query);
    }

    $end = round((microtime(true) - $start), 2);

    if ($end > 2) {
        \App\Logger\Log::alert('Mysql Time query', [
            'query' => tep_db_input($query),
            'time' => $end,
            'SCRIPT_FILENAME' => $_SERVER["SCRIPT_FILENAME"],
        ]);

    }

    $query_total_time += $end;

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
    reset($data);

    switch ($action) {
        case 'insert':
            $query = 'insert into ' . $table . ' (';
            foreach ($data as $columns => $val) {
                $query .= $columns . ', ';
            }
            $query = substr($query, 0, -2) . ') values (';
            reset($data);
            foreach ($data as $key => $value) {
                switch ((string)$value) {
                    case 'now()':
                        $query .= 'now(), ';
                        break;
                    case 'null':
                        $query .= 'null, ';
                        break;
                    default:
                        $query .= '\'' . tep_db_prepare_input($value) . '\', ';
                        break;
                }
            }
            $query = substr($query, 0, -2) . ')';
            break;
        case 'insertodku':
            //insert type DUPLICATE KEY UPDATE
            $query = [];
            foreach ($data as $key => $value) {
                $query[] = "`{$key}` = " . '\'' . tep_db_prepare_input($value) . '\'';
            }
            $query = implode(',', $query);
            $query = "INSERT INTO `{$table}` SET $query ON DUPLICATE KEY UPDATE {$query}";
            break;
        case 'update':
            $query = 'update ' . $table . ' set ';
            foreach ($data as $columns => $value) {
                switch ((string)$value) {
                    case 'now()':
                        $query .= $columns . ' = now(), ';
                        break;
                    case 'null':
                        $query .= $columns .= ' = null, ';
                        break;
                    default:
                        $query .= $columns . ' = \'' . tep_db_prepare_input($value) . '\', ';
                        break;
                }
            }
            $query = substr($query, 0, -2) . ' where ' . $parameters;
            break;
    }

    //call error if empty query
    return tep_db_query($query, DB());
}

function mysqli_result($res, $row, $field = 0)
{
    $res->data_seek($row);
    $datarow = $res->fetch_array();
    return $datarow[$field];
}

function tep_db_fetch_array($db_query)
{
    return mysqli_fetch_assoc($db_query);
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

function tep_db_input($string, $link = 'db_link')
{
//    global DB();
//    dd($string);
    if (function_exists('mysqli_real_escape_string')) {
        return mysqli_real_escape_string(DB(), $string);
    } elseif (function_exists('mysqli_escape_string')) {
        return mysqli_escape_string(DB(), $string);
    }

    return $string;
}

function tep_db_prepare_input($string)
{
    global $saveDbPrepareInput;
    if (is_string($string)) {
        if (!in_array($string, $saveDbPrepareInput)) {
            $string = tep_db_input(trim(stripslashes($string)));
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
            $string = tep_db_input(trim(stripslashes($string)));
            $saveDbPrepareInput[] = $string;
        }
        return $string;
    }
}
