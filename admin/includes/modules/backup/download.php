<?php

$rootPath = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
chdir($rootPath);
include "includes/application_top.php";

if (!function_exists('CheckAuthentication')) {
    function CheckAuthentication() {
        $sessions = explode(';', $_SERVER['HTTP_COOKIE']);
        $adminCookie = array_filter($sessions, function ($cookie) {
            $cookie = explode('=', $cookie);
            return trim($cookie[0]) == 'osCAdminID';
        });

        if ($adminCookie) {
            $adminCookie = reset($adminCookie);
            $sId = explode('=', $adminCookie)[1];
            $query_add = "SELECT value FROM `sessions` WHERE `sesskey` = '" . trim($sId) . "'";
            $result_add = tep_db_query($query_add);

            $result = tep_db_fetch_array($result_add);

            if ($result && strstr($result['value'], 'login_first_name')) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

if(CheckAuthentication()) {
    if(isset($_REQUEST["filename"])){
        $file = urldecode($_REQUEST["filename"]);
        $filepath = BACKUP_FOLDER . $file;
        if(file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            flush();
            readfile($filepath);
            die();
        } else {
            http_response_code(404);
            die();
        }
    }
}

http_response_code(404);
