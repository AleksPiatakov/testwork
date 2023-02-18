<?php

/**
 * Created by PhpStorm.
 * User: 'Serhii.M'
 * Date: 20.05.2019
 * Time: 14:51
 */

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

if (CheckAuthentication()) {
    $admin_link = '';
    if (tep_not_null($_GET['products_id'])) {
        $admin_link = HTTP_SERVER . '/' . $admin . '/products.php?action=new_product&pID=' . $_GET['products_id'];
    } elseif (tep_not_null($_GET['manufacturers_id'])) {
        $admin_link = HTTP_SERVER . '/' . $admin . '/manufacturers.php?action=edit_manufacturers&id=' . $_GET['manufacturers_id'];
    } elseif (tep_not_null($_GET['articles_id'])) {
        $admin_link = HTTP_SERVER . '/' . $admin . '/articles.php?action=edit_articles&id=' . $_GET['articles_id'];
    } elseif (tep_not_null($_GET['tPath'])) {
        $admin_link = HTTP_SERVER . '/' . $admin . '/articles.php?action=topic&tPath=' . $_GET['tPath'];
    } elseif (tep_not_null($_GET['cPath'])) {
        $admin_link = HTTP_SERVER . '/' . $admin . '/categories.php?action=edit_category&cID=' . $current_category_id;
    }
    if ($admin_link) {
        echo '<style>.fixed-edit-button{position: fixed;top: 50px;left: 50px;z-index: 1000000000000000;font-size: 24px;}</style>';
        echo '<a href="' . $admin_link . '" class="fixed-edit-button" target="_blank"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
    }
}
