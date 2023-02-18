<?php

if (!function_exists('CheckAuthentication')) {
    function CheckAuthentication()
    {
        // если мы в админке Оска тогда продолжаем

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
