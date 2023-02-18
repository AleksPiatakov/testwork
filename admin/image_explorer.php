<?php
/**
 * Created by PhpStorm.
 * User: 'Serhii.M'
 * Date: 05.03.2019
 * Time: 15:22
 */

require('includes/application_top.php');

include_once('html-open.php');
include_once('header.php');
?>
    <div class="wrapper-title">
        <div class="bg-light lter wrapper-md ng-scope">
            <h1 class="m-n font-thin h3"><?=TEXT_MENU_CKFINDER?></h1>
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
                        parentWindow['CKEDITOR'].tools.callFunction(funcNum, fileUrl, data);
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

<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');

?>