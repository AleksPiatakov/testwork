<?php
/*
  $Id: googlesitemap.php admin page,v 2.0 2/03/2006 developer@eurobigstore.com
  Released under the GNU General Public License
*/

function GenerateSubmitURL()
{
    $url = urlencode(HTTP_SERVER . DIR_WS_CATALOG . 'sitemap.xml');
    return htmlspecialchars(utf8_encode('http://www.google.com/webmasters/sitemaps/ping?sitemap=' . $url));
}

$url = 'ext/export_google_sitemap/sitemaps.index.php?lang=' . $languages_code;

// Fine
?>

<?php

/**
 * header
 */

include_once(DIR_FS_ADMIN . '/html-open.php');
include_once(DIR_FS_ADMIN . '/header.php');

?>

<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
    <title><?php echo TITLE; ?></title>
    <link rel="stylesheet" type="text/css" href="../../admin/includes/stylesheet.css">
    <link rel="stylesheet" href="../../admin/includes/solomono/css/overwrite.css" type="text/css"/>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">

<!-- body //-->
<div class="container backup">
    <div class="wrapper-title">
        <div class="bg-light lter ng-scope">
            <h1 class="m-n font-thin h3"><?php echo TITLE_GOOGLE_SITEMAPS; ?></h1>
        </div>
    </div>

    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="main">
        <tr>
            <td width="78%" align="left" valign="top"><p>
                    <strong><?php echo OVERVIEW_TITLE_GOOGLE_SITEMAPS; ?></strong></p>
                <p><?php echo OVERVIEW_GOOGLE_SITEMAPS; ?></p>
                <p>
                    <a class="btn btn-info" href="javascript:(void 0)" class="splitPageLink" onClick="window.open('<?php echo HTTP_SERVER . DIR_WS_CATALOG . $url; ?>','google','resizable=0,statusbar=5,width=960,height=310,top=0,left=50,scrollbars=yes')"><strong><?php echo EXEC_GOOGLE_SITEMAPS; ?></strong></a>
                </p>
        </tr>
    </table>
</div>
<!-- body_smend //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_smend //-->

<?php

/**
 * footer
 */

include_once('footer.php');
include_once('html-close.php');

?>

<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
