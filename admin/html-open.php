<!DOCTYPE html>
<html <?php echo HTML_PARAMS; ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
    <title><?php echo TITLE; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>material/libs/assets/animate.css/animate.css?t=<?=filesize(__DIR__. DIRECTORY_SEPARATOR . DIR_WS_INCLUDES.'material/libs/assets/animate.css/animate.css')?>" type="text/css"/>
    <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>material/libs/assets/font-awesome/css/font-awesome.min.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>material/libs/assets/simple-line-icons/css/simple-line-icons.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>material/libs/jquery/bootstrap/dist/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>material/css/font.css?t=<?=filesize(__DIR__. DIRECTORY_SEPARATOR . DIR_WS_INCLUDES.'material/css/font.css')?>" type="text/css"/>
    <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>material/css/app.css?t=<?=filesize(__DIR__. DIRECTORY_SEPARATOR . DIR_WS_INCLUDES.'material/css/app.css')?>" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>solomono/css/solomono.css?t=<?=filesize(__DIR__. DIRECTORY_SEPARATOR . DIR_WS_INCLUDES.'solomono/css/solomono.css')?>" type="text/css"/>

    <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>javascript/colorpicker/css/colorpicker.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>solomono/libs/jquery-ui-1.12.1/jquery-ui.min.css" type="text/css"/>
    <?php if($current_file == 'dashboard') {?><link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>solomono/css/charts.css" type="text/css"/> <?php } ?>
    <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>javascript/OverlayScrollbars/OverlayScrollbars.min.css" type="text/css"/>
<!--    <link rel="stylesheet" type="text/css" href="includes/stylesheet.css">-->
<!--    <link rel="stylesheet" href="includes/solomono/css/overwrite.css" type="text/css"/>-->
    <?php if($menu_location != '0'){ ?>
        <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>solomono/css/menu_left1.css" type="text/css"/>
    <?php } else { ?>
        <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>solomono/css/menu_horizontal.css" type="text/css"/>
    <?php };
    // push constants to JS:
    if(!empty($array_for_js)) {
        foreach($array_for_js as $js_k => $js_val) $for_js .= 'const '.$js_k.' = "'.$js_val.'"; ';
        echo '<script>'.$for_js.'</script>';
    }
    ?>

    <script src="<?php echo DIR_WS_INCLUDES; ?>material/libs/jquery/jquery/dist/jquery.js"></script>
    <script src="<?php echo DIR_WS_INCLUDES; ?>solomono/libs/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <script src="<?=DIR_WS_INCLUDES;?>solomono/libs/jquery-validation-1.17.0/dist/jquery.validate.min.js"></script>
    <script src="<?=DIR_WS_INCLUDES;?>solomono/libs/jquery-validation-1.17.0/src/localization/messages_<?=$_SESSION['languages_code']?>.js"></script>
    <?php if (tep_is_active_menu() || tep_is_active_menu(FILENAME_DEFAULT)|| tep_is_active_menu('index.php')) :?>
        <script src="<?php echo DIR_WS_INCLUDES; ?>solomono/js/modules-loader.js?1"></script>
    <?php endif; ?>
    <script language="javascript" src="includes/menu.js?t=<?=filesize(__DIR__ . DIRECTORY_SEPARATOR . DIR_WS_INCLUDES . 'menu.js')?>"></script>
    <script language="javascript" src="includes/general.js?t=<?=filesize(__DIR__ . DIRECTORY_SEPARATOR . DIR_WS_INCLUDES . 'general.js')?>"></script>
    <?php if (strstr($_SERVER['PHP_SELF'],'new_admin-panel.php')): ?>
        <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>solomono/css/new_admin-panel.css?t=<?=filesize(__DIR__ . DIRECTORY_SEPARATOR . DIR_WS_INCLUDES.'solomono/css/new_admin-panel.css')?>" type="text/css"/>
    <?php endif; ?>
    <?php if (strstr($_SERVER['PHP_SELF'],'index.php')): ?>
        <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>solomono/css/index.css?t=<?=filesize(__DIR__ . DIRECTORY_SEPARATOR . DIR_WS_INCLUDES.'solomono/css/index.css')?>" type="text/css"/>
    <?php endif; ?>
    <?php if (strstr($_SERVER['PHP_SELF'],'customize_template.php')): ?>
        <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>solomono/css/customize_template.css?t=<?=filesize(__DIR__ . DIRECTORY_SEPARATOR . DIR_WS_INCLUDES.'solomono/css/customize_template.css')?>" type="text/css"/>
    <?php endif; ?>
    <?php if (strstr($_SERVER['PHP_SELF'],'new_importexport.php')): ?>
        <link rel="stylesheet" href="<?php echo DIR_WS_INCLUDES; ?>solomono/css/new_importexport.css?t=<?=filesize(__DIR__ . DIRECTORY_SEPARATOR . DIR_WS_INCLUDES.'solomono/css/new_importexport.css')?>" type="text/css"/>
    <?php endif; ?>

    <link rel="stylesheet" href="/includes/javascript/customization_panel.css" type="text/css"/>

    <meta name="theme-color" content="#efc600" />
</head>
<body class="admin_page <?=(!isMobile() && $menu_location==='1'?'open_sidebar':'');?>">
<?php
// #CP - point logos to come from selected template's images directory
$template_query = tep_db_query("select configuration_id, configuration_title, configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'DEFAULT_TEMPLATE'");
$template = tep_db_fetch_array($template_query);
$CURR_TEMPLATE = $template['configuration_value'] . '/';

?>
<?php

$_settings = '';
if (isset($_SESSION['settings'])) {
    foreach ($_SESSION['settings'] as $setting_name => $setting_state) {
        switch ($setting_name) {
            case 'settings_header_fixed':
                if ($setting_state == 'on') {
                    $_settings .= ' app-header-fixed';
                }

                break;
            case 'settings_aside_fixed':
                if ($setting_state == 'on') {
                    $_settings .= ' app-aside-fixed';
                }

                break;
            case 'settings_aside_folded':
                if ($setting_state == 'on') {
                    $_settings .= ' app-aside-folded';
                }

                break;
            case 'settings_aside_dock':
                if ($setting_state == 'on') {
                    $_settings .= ' app-aside-dock';
                }

                break;
        }
    }
}

if (empty($_settings)) {
    $_settings = ' app-header-fixed app-aside-fixed app-aside-dock';
}

?>
<!-- app -->
<div class="app<?php print $_settings; ?>">
