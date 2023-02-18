<?php
/*
  $Id: logoff.php,v 1.2 2003/09/24 15:18:15 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

require('includes/application_top.php');

require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGOFF);

tep_session_destroy();
tep_session_unregister('login_id');
tep_session_unregister('login_firstname');
tep_session_unregister('login_groups_id');

?>
<!doctype html>
<html <?php echo HTML_PARAMS; ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
    <title><?php echo TITLE; ?></title>
    <!-- including css -->
    <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>material/libs/assets/animate.css/animate.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>material/libs/assets/font-awesome/css/font-awesome.min.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>material/libs/assets/simple-line-icons/css/simple-line-icons.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>material/libs/jquery/bootstrap/dist/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>material/css/font.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>material/css/app.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>solomono/css/solomono.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>javascript/OverlayScrollbars/OverlayScrollbars.min.css" type="text/css"/>
    <?php if($menu_location != '0'){ ?>
<!--        <link rel="stylesheet" href="--><?php //echo DIR_WS_INCLUDES; ?><!--solomono/css/menu_left.css" type="text/css"/>-->
        <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>solomono/css/menu_left1.css" type="text/css"/>
    <?php } else { ?>
        <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>solomono/css/menu_horizontal.css" type="text/css"/>
    <?php } ?>
    <meta name="theme-color" content="#efc600" />
</head>
<body class="admin_page <?=(!isMobile() && $menu_location==='1'?'open_sidebar':'');?>">
<?php
// push constants to JS:
if(!empty($array_for_js)) {
  foreach($array_for_js as $js_k => $js_val) $for_js .= 'const '.$js_k.' = "'.$js_val.'"; ';
  echo '<script>'.$for_js.'</script>';
}
?>
<div class="app app-header-fixed ">
    <div class="modal-over bg-black">
        <div class="modal-center animated fadeInUp text-center loginModal" style="width: 450px;">
            <div class="row">
                <div class="col-md-12 m-t">
                    <?php echo tep_image('images/logo_long_yellow.png'); ?>
                </div>
                <div class="col-md-12 m-t">
                    <p style="color: white;"><?php echo TEXT_MAIN; ?></p>
                </div>
                <div class="col-md-12 m-t">
                    <?php echo '<a class="btn_logoff" href="' . tep_href_link(FILENAME_LOGIN, '', 'SSL') . '">'.TEXT_MODAL_CONTINUE_ACTION. '</a>'; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
