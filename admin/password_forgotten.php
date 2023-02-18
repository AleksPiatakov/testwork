<?php
/*
  $Id: password_forgotten.php,v 1.2 2003/09/24 15:18:15 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

require('includes/application_top.php');
require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGIN);


if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'confirmRestorePass' :
            require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PASSWORD_FORGOTTEN);
            $email_address = tep_db_prepare_input($_POST['email']);
            $log_times = $_POST['log_times'] + 1;
            if ($log_times >= 4) {
                tep_session_register('password_forgotten');
            }

// Check if email exists
            $check_admin_query = tep_db_query("select admin_id as check_id, admin_firstname as check_firstname, admin_lastname as check_lastname, admin_email_address as check_email_address from " . TABLE_ADMIN . " where admin_email_address = '" . tep_db_input($email_address) . "'");
            if (!tep_db_num_rows($check_admin_query)) {
                $_GET['login'] = 'fail';
            } else {
                $check_admin = tep_db_fetch_array($check_admin_query);
                $token = bin2hex(random_bytes(25));
                $jsonData = json_encode([
                    'email_address' => $email_address,
                    'desc' => 'recovery password request from ' . $_SERVER['REMOTE_ADDR'],
                ]);
                tep_db_query("insert INTO " . TABLE_TEMP_CUSTOMER . " (token, json_data) VALUES ('$token','$jsonData')");

                if (checkConst('EMAIL_CONTENT_MODULE_ENABLED') == 'true') {
                    require_once(DIR_FS_EXT . 'email_content/functions.php');
                    $data = [
                        'customers_name' => $check_admin['check_firstname'] . ' ' . $check_admin['admin_lastname'],
                        'email_address' => $email_address,
                        'token' => $token,
                        'date_time' => date('Y-m-d H:i:s', time()),
                        'remote_addr' => $_SERVER['REMOTE_ADDR']
                    ];
                    $content_email_array = getAdminPasswordForgottenText($languages_id, $data);
                }
                    $email_plain_text = EMAIL_PASSWORD_REMINDER_BODY . ' ' . $_SERVER['REMOTE_ADDR'] . ' ' . date('Y-m-d H:i:s', time()).'<br />'. EMAIL_PASSWORD_REMINDER_BODY3 . '<br /><a href="'.HTTP_SERVER . DIR_WS_ADMIN . 'password_forgotten.php?language='.$languages_code.'&action=confirm-token&token=' .$token.'">link</a>' ;
                    $email_text = $content_email_array['content_html'] ?: $email_plain_text;
                    $subject = $content_email_array['subject'] ?: NAVBAR_TITLE_2;

                tep_mail($check_admin['check_firstname'] . ' ' . $check_admin['admin_lastname'], $email_address, $subject, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
                $_GET['login'] = 'success';

            }
            break;
        case 'confirm-token':
            $checkTokenQuery = tep_db_query("select json_data from " . TABLE_TEMP_CUSTOMER . " where token = '" . tep_db_input($_GET['token']) . "'");
            if (tep_db_num_rows($checkTokenQuery)) {
                $jsonData = tep_db_fetch_array($checkTokenQuery);
                $jsonData = $jsonData['json_data'];
                $jsonData = json_decode($jsonData);
                $new_password = tep_create_random_value(ENTRY_PASSWORD_MIN_LENGTH);
                $crypted_password = tep_encrypt_password($new_password);
                tep_db_query("update " . TABLE_ADMIN . " set admin_password = '" . tep_db_input($crypted_password) . "' where admin_email_address = '" . $jsonData->email_address . "'");
                tep_db_query("DELETE FROM " . TABLE_TEMP_CUSTOMER . " where token = '" . tep_db_input($_GET['token']) . "'");

                //отправка письма пользователю
                if (checkConst('EMAIL_CONTENT_MODULE_ENABLED') == 'true') {
                    require_once(DIR_FS_EXT . 'email_content/functions.php');
                    $content_email_array = getPasswordForgottenText($new_password);
                }

                $email_plain_text = sprintf(EMAIL_PASSWORD_REMINDER_BODY2, $new_password);
                $email_text = $content_email_array['content_html'] ?: $email_plain_text;
                $subject = $content_email_array['subject'] ?: ADMIN_EMAIL_SUBJECT;

                tep_mail('', $jsonData->email_address, $subject, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

                $messageStack->add_session('home', SUCCESS_PASSWORD_SENT, 'success');
                tep_redirect(tep_href_link(FILENAME_DEFAULT, 'login=' . $jsonData->email_address, 'NONSSL'));
            } else {
                $messageStack->add_session('home', EMAIL_TOKEN_ERROR, 'error');
                tep_redirect(tep_href_link(FILENAME_DEFAULT, '', 'SSL'));
            }

    }
}

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
    <title><?php echo TITLE; ?></title>
    <!-- including css -->
    <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>material/libs/assets/animate.css/animate.css"
          type="text/css"/>
    <link rel="stylesheet"
          href="<?php echo DIR_WS_INCLUDES; ?>material/libs/assets/font-awesome/css/font-awesome.min.css"
          type="text/css"/>
    <link rel="stylesheet"
          href="<?php echo DIR_WS_INCLUDES; ?>material/libs/assets/simple-line-icons/css/simple-line-icons.css"
          type="text/css"/>
    <link rel="stylesheet"
          href="<?php echo DIR_WS_INCLUDES; ?>material/libs/jquery/bootstrap/dist/css/bootstrap.min.css"
          type="text/css"/>
    <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>material/css/font.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>material/css/app.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>solomono/css/solomono.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>javascript/OverlayScrollbars/OverlayScrollbars.min.css"
          type="text/css"/>
    <?php if ($menu_location != '0') { ?>
        <!--        <link rel="stylesheet" href="--><?php //echo DIR_WS_INCLUDES; ?><!--solomono/css/menu_left.css" type="text/css"/>-->
        <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>solomono/css/menu_left1.css" type="text/css"/>
    <?php } else { ?>
        <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>solomono/css/menu_horizontal.css" type="text/css"/>
    <?php } ?>
    <meta name="theme-color" content="#efc600"/>
</head>
<body class="admin_page <?= (!isMobile() && $menu_location === '1' ? 'open_sidebar' : ''); ?>">
<?php
// push constants to JS:
if (!empty($array_for_js)) {
    foreach ($array_for_js as $js_k => $js_val) $for_js .= 'const ' . $js_k . ' = "' . $js_val . '"; ';
    echo '<script>' . $for_js . '</script>';
}
?>
<div class="app app-header-fixed ">
    <?php echo tep_draw_form('login', FILENAME_PASSWORD_FORGOTTEN, 'action=confirmRestorePass'); ?>
    <div class="modal-over bg-black">
        <div style="text-align: center;position: relative;top: 37%;"><?php echo HEADING_PASSWORD_FORGOTTEN; ?></div>
        <div class="modal-center animated fadeInUp text-center loginModal">
            <div class="thumb-lg">
                <img src="includes/solomono/img/logo_crown_big.png" class="img-circle">
            </div>
            <?php if ($_GET['login'] == 'fail'): ?>
                <p class="login_heading m-t">
                    <?php echo TEXT_NO_EMAIL_ADDRESS_FOUND; ?>
                </p>
            <?php elseif ($_GET['login'] == 'success'): ?>
                <p class="login_heading m-t">
                    <?php echo TEXT_FORGOTTEN_SUCCESS; ?>
                </p>
            <?php endif; ?>
            <?php if (tep_session_is_registered('password_forgotten')): ?>
                <p class="login_heading m-t">
                    <?php echo TEXT_FORGOTTEN_FAIL; ?>
                </p>
            <?php endif; ?>

                <input type="email" name="email"
                       class="token-input form-control text-sm btn-rounded no-border email_address"
                       placeholder="<?php echo ENTRY_EMAIL_ADDRESS; ?>">
                <button class="confirm-restore-pass btn btn-success btn-rounded"><i
                            class="fa fa-arrow-right"></i></button>
            <div class="row">
                <div class="col-md-12 text-right m-t">
                    <?php echo '<a class="sub" href="' . tep_href_link(FILENAME_LOGIN, '', 'SSL') . '">' . IMAGE_BACK . '</a>'; ?>
                </div>
            </div>
        </div>

    </div>
    </form>
</div>
<script type="text/javascript">
    // Submit restore password
    /*$(document).on('click', '.confirm-restore-pass', function (event) {
        event.preventDefault();
        var this_form = $(this).closest("form");

        $.post('/password_forgotten.php', {
            request: 'confirmRestorePass',
            email: this_form.find('input[name=email]').val(),
        }, function (data) {
            if (data.error) {
                this_form.find('.error_text').html(data.error);
            } else if (data.message) {
                $('.login .register-token').remove();
                $('.login .register-form').show();
                $('.login .register-form .error_text').html(data.message);
                $('.login .register-form .email').val(data.email);
            }
        }, 'json');
    });*/
</script>
</body>
</html>