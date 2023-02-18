<?php
/**
 * Created by PhpStorm.
 * User: 'Serhii.M'
 * Date: 05.03.2019
 * Time: 15:22
 */

require('includes/application_top.php');
include_once('html-open.php');
?>
    <div class="wrapper-title">
        <div class="bg-light lter wrapper-md ng-scope">
            <h1 class="m-n font-thin h3" style="padding-left: 35px;"><?=TEXT_MENU_CKFINDER?></h1>
        </div>
    </div>
    <div id="ckfinder" style="height: 60vh;"></div>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            (function () {
                var config = {};
                var get = CKFinder.tools.getUrlParam;
                var getBool = function (v) {
                    var t = get(v);

                    if (t === null)
                        return null;

                    return t == '0' ? false : true;
                };

                var tmp;
                if (tmp = get('basePath'))
                    CKFINDER.basePath = tmp;

                if (tmp = get('startupPath'))
                    config.startupPath = decodeURIComponent(tmp);

                config.id = get('id') || '';

                if ((tmp = getBool('rlf')) !== null)
                    config.rememberLastFolder = tmp;

                if ((tmp = getBool('dts')) !== null)
                    config.disableThumbnailSelection = tmp;

                if (tmp = get('data'))
                    config.selectActionData = tmp;

                if (tmp = get('tdata'))
                    config.selectThumbnailActionData = tmp;

                if (tmp = get('type'))
                    config.resourceType = tmp;

                if (tmp = get('skin'))
                    config.skin = tmp;

                if (tmp = get('langCode'))
                    config.language = tmp;

                // Try to get desired "File Select" action from the URL.
                var action;
                if (tmp = get('CKEditor')) {
                    if (tmp.length)
                        action = 'ckeditor';
                }
                if (!action)
                    action = get('action');
                var parentWindow = (window.parent == window)
                    ? window.opener : window.parent;

                var funcNum = get('CKEditorFuncNum');
                // if (parentWindow['CKEDITOR']) {
                config.selectActionFunction = function (fileUrl, data) {
                    var pID = '<?= $_GET['pID'];?>';
                    $.post('/admin/products.php?action=add_image&pID='+pID,{
                        'imagePath':fileUrl
                    },function (response) {
                        if(response.success){
                            window.close();
                        }
                    },'json');
                    return false;
                };

                config.selectThumbnailActionFunction = config.selectActionFunction;
                // }

                config.action = action;

                // Always use 100% width and height when nested using this middle page.
                config.width = config.height = '100%';
                var ckfinder = new CKFinder(config);
                ckfinder.replace('ckfinder', config);
            })();
        });
    </script>
    
    <script src="<?php echo DIR_WS_INCLUDES; ?>material/js/ui-load.js"></script>
    <script src="<?php echo DIR_WS_INCLUDES; ?>material/js/ui-jp.config.js"></script>
    <script src="<?php echo DIR_WS_INCLUDES; ?>material/js/ui-jp.js"></script>
    <script src="<?php echo DIR_WS_INCLUDES; ?>material/js/ui-nav.js"></script>
    <script src="<?php echo DIR_WS_INCLUDES; ?>material/js/ui-toggle.js"></script>
    <script src="<?php echo DIR_WS_INCLUDES; ?>material/js/ui-client.js"></script>
    <script src="<?php echo DIR_WS_INCLUDES; ?>material/libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
    <script>$.fn.collapse.Constructor.TRANSITION_DURATION = 0</script>
    <!--  <script src="--><?php //echo DIR_WS_INCLUDES; ?><!--solomono/libs/jquery-ui-1.12.1/jquery-ui.min.js"></script>-->
    <script src="<?php echo DIR_WS_INCLUDES; ?>solomono/js/components/actions_overview.js"></script>
    <script defer src="<?php echo DIR_WS_INCLUDES; ?>solomono/js/solomono.js?t=<?=filesize(__DIR__ . DIRECTORY_SEPARATOR . DIR_WS_INCLUDES.'solomono/js/solomono.js')?>"></script>
    <script src="<?php echo DIR_WS_INCLUDES; ?>solomono/js/solomono_admin.js?t=<?=filesize(__DIR__ . DIRECTORY_SEPARATOR . DIR_WS_INCLUDES.'solomono/js/solomono_admin.js')?>"></script>
    <script src="<?php echo DIR_WS_INCLUDES; ?>javascript/colorpicker/js/colorpicker.js"></script>
    <script src="<?php echo DIR_WS_INCLUDES; ?>solomono/libs/simplePagination/jquery.SimplePagination.js"></script>
    <script src="<?php echo DIR_WS_INCLUDES?>ckeditor/ckeditor.js"></script>
    <script src="<?php echo DIR_WS_INCLUDES;?>ckfinder/ckfinder.js"></script>
    <script src="<?php echo DIR_WS_INCLUDES; ?>javascript/OverlayScrollbars/jquery.overlayScrollbars.min.js"></script>
<?php
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>