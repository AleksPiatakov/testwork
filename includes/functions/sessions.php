<?php

/*
  $Id: sessions.php,v 1.1.1.1 2003/09/18 19:05:07 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
if (STORE_SESSIONS == 'mysql') {
    if (defined('DIR_WS_ADMIN') && defined('SESSION_TIMEOUT_ADMIN')) {
        if (!$SESS_LIFE = (SESSION_TIMEOUT_ADMIN + 900)) {
            $SESS_LIFE = (SESSION_TIMEOUT_ADMIN + 900);
        }
    } else {
      //  if (!$SESS_LIFE=get_cfg_var('session.gc_maxlifetime')) {
            $SESS_LIFE = 14400;
      //  }
    }

    function _sess_open($save_path, $session_name)
    {
        return true;
    }

    function _sess_close()
    {
        return true;
    }

    function _sess_read($key)
    {
        $value_query = tep_db_query("select value from " . TABLE_SESSIONS . " where sesskey = '" . tep_db_prepare_input($key) . "' and expiry > '" . time() . "'");
        $value = tep_db_fetch_array($value_query);

        if (isset($value['value'])) {
            return $value['value'];
        }

        return "";
    }

    function _sess_write($key, $val)
    {
        global $SESS_LIFE;

        $expiry = time() + $SESS_LIFE;
        $value = $val;

        $check_query = tep_db_query("select count(*) as total from " . TABLE_SESSIONS . " where sesskey = '" . tep_db_prepare_input($key) . "'");
        $check = tep_db_fetch_array($check_query);

        if ($check['total'] > 0) {
            return tep_db_query("update " . TABLE_SESSIONS . " set expiry = '" . tep_db_input($expiry, false) . "', value = '" . tep_db_input($value, false) . "' where sesskey = '" . tep_db_input($key, false) . "'");
        } else {
            return tep_db_query("replace into " . TABLE_SESSIONS . " values ('" . tep_db_input($key, false) . "', '" . tep_db_input($expiry, false) . "', '" . tep_db_input($value, false) . "')");
        }
    }

    function _sess_destroy($key)
    {
        return tep_db_query("delete from " . TABLE_SESSIONS . " where sesskey = '" . tep_db_prepare_input($key) . "'");
    }

    function _sess_gc($maxlifetime)
    {
        tep_db_query("delete from " . TABLE_SESSIONS . " where expiry < '" . time() . "'");

        return true;
    }

    session_set_save_handler('_sess_open', '_sess_close', '_sess_read', '_sess_write', '_sess_destroy', '_sess_gc');
}

function tep_session_start()
{
    global $SESS_LIFE, $_GET, $_POST, $_COOKIE;
    ini_set('session.gc_probability', '1');
    ini_set('session.gc_divisor', '100');
    ini_set('session.gc_maxlifetime', $SESS_LIFE);

    $sane_session_id = true;

    if (isset($_GET[tep_session_name()])) {
        if (preg_match('/^[a-zA-Z0-9]+$/', $_GET[tep_session_name()]) == false) {
            unset($_GET[tep_session_name()]);

            $sane_session_id = false;
        }
    } elseif (isset($_POST[tep_session_name()])) {
        if (preg_match('/^[a-zA-Z0-9]+$/', $_POST[tep_session_name()]) == false) {
            unset($_POST[tep_session_name()]);

            $sane_session_id = false;
        }
    } elseif (isset($_COOKIE[tep_session_name()])) {
        if (preg_match('/^[a-zA-Z0-9]+$/', $_COOKIE[tep_session_name()]) == false) {
            $session_data = session_get_cookie_params();

            setcookie(tep_session_name(), '', time() - 42000, $session_data['path'], $session_data['domain'], false, true);

            $sane_session_id = false;
        }
    }

    if ($sane_session_id == false) {
        tep_redirect(tep_href_link('/', '', 'NONSSL', false));
    }

    return session_start();
}

function tep_session_register($variable)
{

    if (!isset($GLOBALS[$variable])) {
        $GLOBALS[$variable] = null;
    }

    $_SESSION[$variable]=&$GLOBALS[$variable];

    return false;
}

function tep_session_is_registered($variable)
{
    if (PHP_VERSION < 4.3) {
        return session_is_registered($variable);
    } else {
        return isset($_SESSION) && array_key_exists($variable, $_SESSION);
    }
}

function tep_session_unregister($variable)
{
    if (PHP_VERSION < 4.3) {
        return session_unregister($variable);
    } else {
        unset($_SESSION[$variable]);
    }
}

function tep_session_id($sessid = '')
{
    if (!empty($sessid)) {
        return session_id($sessid);
    } else {
        return session_id();
    }
}

function tep_session_name($name = '')
{
    if (!empty($name)) {
        return session_name($name);
    } else {
        return session_name();
    }
}

function tep_session_close()
{
    if (PHP_VERSION >= '4.0.4') {
        return session_write_close();
    } elseif (function_exists('session_close')) {
        return session_close();
    }
}

function tep_session_destroy()
{
    return session_destroy();
}

function tep_session_save_path($path = '')
{
    if (!empty($path)) {
        return ini_set("session_save_path", $path);
    } else {
        return session_save_path();
    }
}

function tep_session_recreate()
{
    if (PHP_VERSION >= 4.1) {
        $session_backup = $_SESSION;

        unset($_COOKIE[tep_session_name()]);

        tep_session_destroy();

        if (STORE_SESSIONS == 'mysql') {
            session_set_save_handler('_sess_open', '_sess_close', '_sess_read', '_sess_write', '_sess_destroy', '_sess_gc');
        }

        tep_session_start();

        $_SESSION = $session_backup;
        unset($session_backup);
    }
}
