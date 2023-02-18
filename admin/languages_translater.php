<?php

//todo api translater
//todo add new constant
//todo по хорошему переделать по примеру ниже, есть проблема что если константа была объявлена ранее то в итоговом массиве её не будет:
//if (isset($_GET['translate']) && $_GET['translate'] = 'admin') {
//    chdir('includes/languages');
//} else {
//    chdir('../includes/languages');
//}
//$tmp_dir = getcwd();
//$dir = ($_GET['path'] ? $tmp_dir . DIRECTORY_SEPARATOR . $_GET['path'] : $tmp_dir) .DIRECTORY_SEPARATOR. $_GET['file'];
//$before = get_defined_constants(true)['user'];
//require_once ($dir);
//$after = get_defined_constants(true)['user'];
//$intersect = array_diff($after,$before);
//var_dump($before,$after,$intersect);
//die;

require_once('includes/application_top.php');

require_once DIR_WS_CLASSES . "LanguageEditor/autoload.php";

use App\Classes\Filesystem\Filesystem;
use SoloMono\LanguageEditor\LanguageEditorFactory;

$languageEditor = LanguageEditorFactory::create(isset($_GET['translate']) ? $_GET['translate'] : '');

$lang_translate = new Filesystem();
if (isset($_GET['translate']) && $_GET['translate'] == 'admin') {
    chdir('includes/languages');
} else {
    chdir('../includes/languages');
}
if (!empty($_POST['action'])) {
    $action = $_POST['action'];
    switch ($action) {
        case 'getDirectories':
            $dirs = glob('*', GLOB_ONLYDIR);
            echo json_encode(array(
                'dirs' => $dirs
            ));
            exit;
            break;
        case 'newConst':
            $cName = strtoupper($_POST['const_name']);
            preg_match_all('/[A-Z0-9_]+/i',$cName,$out);
            $cName = implode('_',$out[0]);
            $cVal = addslashes($_POST['const_val']);
            $cFile = $_POST['const_file'];
            if (!tep_not_null($cName)) {
                die(json_encode(['error'=>true,'text'=>'Const name "'.$cName.'" is empty']));
            }
            if (!tep_not_null($cVal)) {
                die(json_encode(['error'=>true,'text'=>'Const val "'.$cName.'" is empty']));
            }
            $cBlock = '            
            <div class="form-group">
                <div class="col-xs-12 col-sm-12 col-md-3 no-padder">
                    <span class="const">'.$cName.'</span>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 const-val-area">
                    <textarea required class="form-control" data-autoresize name="'.$cName.'[new]" rows="1">'.$cVal.'</textarea>
                    <textarea  required class="form-control value hidden" name="'.$cName.'[base]" readonly>'.$cVal.'</textarea>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3 hidden no-padder">
                    <div class="btn btn-default ok">'.TEXT_MODAL_UPDATE_ACTION.'</div>
                    <div class="btn btn-default reset">'.IMAGE_CANCEL.'</div>
                </div>
            </div>
            
            ';

            try {
                $languageEditor->insert($cName, $cVal, $cFile);
            } catch (\Exception $exception) {
                die(json_encode(['error'=>true,'text'=>$exception->getMessage()]));
            }

            die(json_encode(['error'=>false,'text'=>$cBlock]));
    }

}
function get_params_to_str(array $include = [],array $get_params=[]) {
    $absolutes = '';
    $get_params=$get_params?:$_GET;
    foreach ($get_params as $k => $v) {
        if (in_array($k, $include)) {
            $absolutes .= "&$k=$v";
        };
    }
    return $absolutes;
}

$tmp_dir = getcwd();
$dirs = glob('*', GLOB_ONLYDIR);
$current_dir = ($_GET['path'] ? $tmp_dir . DS . $_GET['path'] : $tmp_dir);
$dir = new DirectoryIterator($current_dir);
if (!empty($_POST['file'])) {
    $file_path = $_POST['file'];
    unset($_POST['file']);
    $languageEditor->update($_POST, $file_path);
    if ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'){
        die(1);
    }
}
?>
<?php $dir_folders = [];$dir_files = []; ?>
<?php $sql = "SELECT l.directory
FROM ". TABLE_LANGUAGES ." AS l
WHERE l.lang_status = '1'";
$langQuery = tep_db_query($sql);
$activeLanguages = [];
while($row = tep_db_fetch_array($langQuery)){
    $activeLanguages[] = $row['directory'];
}
if(!empty($_GET['path']) && searchInPath($_GET['path'], $activeLanguages)===False){
    header("HTTP/1.0 301 Moved Permanently");
    header("Location: languages_translater.php");
    tep_exit();
}

?>

<?php foreach ($dir as $fileinfo): ?>
    <?php if (!$fileinfo->isDot() && ($fileinfo->getExtension() == $languageEditor->getFileExtension() || $fileinfo->getExtension() == '')): ?>
        <?php if(searchLangFilesInArr($fileinfo->getFilename(), $activeLanguages, basename( $fileinfo->getPath()))!==False): ?>
        <?php if ($fileinfo->isDir()): ?>
           <?php $dir_folders[$fileinfo->getFilename()] = '
                <a href="'.tep_href_link(FILENAME_LANGUAGES_TRANSLATER . '?path=' . $_GET['path'] . $fileinfo->getFilename() . DS . get_params_to_str(['translate'])).'">
                    <i class="fa fa-folder-open" aria-hidden="true"></i>
                    '.$fileinfo->getFilename().'
                </a>';?>
            <?php else: ?>
                <?php $dir_files[$fileinfo->getFilename()]= '
                <a href="'.tep_href_link(FILENAME_LANGUAGES_TRANSLATER . '?file=' . $fileinfo->getFilename() . get_params_to_str([
                        'path',
                        'translate'
                    ])).'">
                    <i class="fa fa-file-o" aria-hidden="true"></i>
                    '.  $fileinfo->getFilename() .'
                </a>';?>

        <?php endif; ?>
        <?php endif; ?>

    <?php endif; ?>
<?php endforeach; ?>

<?php sort($dir_folders);sort($dir_files); ?>
<?php $dir = array_merge($dir_folders,$dir_files); ?>
<?php
include_once(DIR_FS_ADMIN . 'html-open.php');
include_once(DIR_FS_ADMIN . 'header.php');
?>
    <div id="tabs-attr" class="tabs-lang container ">
        <ul class="nav nav-tabs" id="attributes">
            <li class="">
                <a href="<?=tep_href_link(FILENAME_LANGUAGES)?>"><?=BOX_LOCALIZATION_LANGUAGES?></a>
            </li>
            <li class="active">
                <a href="<?=tep_href_link(FILENAME_LANGUAGES_TRANSLATER, 'file='.$language.'.json')?>"><?=TEXT_TRANSLATER_TITLE?></a>
            </li>
            <li class="">
                <a href="<?=tep_href_link(FILENAME_AUTO_TRANSLATE)?>"
                    <?=(getConstantValue('AUTO_TRANSLATE_MODULE_ENABLED') == 'true') ? '' : 'style="pointer-events: none;"'?>>
                    <?=AUTO_TRANSLATE_MODULE_ENABLED_TITLE?>
                </a>
            </li>
        </ul>
    </div>
    <div class="container <?php echo  basename(__FILE__, '.php') ?>">
        <div class="wrapper-md wrapper_767">
            <h2 class="bg-light lter ng-scope h3"><?= TEXT_TRANSLATER_TITLE ?></h2>
        </div>
        <ul class="nav nav-tabs">
            <li role="presentation" class="<?php echo  empty($_GET['translate']) ? 'active' : '' ?>">
                <a href="<?= tep_href_link(FILENAME_LANGUAGES_TRANSLATER) ?>"><?=BOX_CONFIGURATION_MYSTORE;?></a>
            </li>
            <li role="presentation" class="<?php echo  $_GET['translate'] == 'admin' ? 'active' : '' ?>">
                <a href="<?= tep_href_link(FILENAME_LANGUAGES_TRANSLATER . '?translate=admin') ?>"><?=HEADER_ADMIN_TEXT;?></a>
            </li>
        </ul>
        <ol class="breadcrumb">
            <li>
                <?php if(!empty($_GET['translate'])): ?>
                    <a href="<?= tep_href_link(FILENAME_LANGUAGES_TRANSLATER, "translate=" . $_GET['translate']) ?>">Home</a>
                <?php else: ?>
                    <a href="<?= tep_href_link(FILENAME_LANGUAGES_TRANSLATER) ?>">Home</a>
                <?php endif; ?>
            </li>
            <?php if (!empty($_GET['path'])): ?>
                <?php $li = explode(DS, ($_GET['path'])); ?>
                <?php foreach ($li as $v): ?>
                    <?php $link .= $v . DS; ?>
                    <li>
                        <a href="<?= tep_href_link(FILENAME_LANGUAGES_TRANSLATER,'path=' . $link . get_params_to_str(['translate'])) ?>"><?php echo  $v ?></a>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ol>

        <div class="bg-white-only">
            <div class="col-md-3 no-padder">
                <table class="table translater_nav">
                    <thead>
                    <tr>
                        <th>Name</th>
                    </tr>
                    </thead>

                    <?php foreach ($dir as $name => $link): ?>
                        <tr<?= ($name == $_GET['file'] ? ' class="active"' : '') ?>>
                            <td>
                                <?= $link ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </table>
            </div>
            <div class="col-md-9 translater_content">
                <?php if ($_GET['file'] && file_exists($current_dir .DIRECTORY_SEPARATOR. $_GET['file'])): ?>
                    <?php $arr = $languageEditor->parse($current_dir .DIRECTORY_SEPARATOR. $_GET['file']); ?>
                    <div class="row">
                        <div class="col-md-12 pl-20">
                            <h2 style="margin-top: 0"><?php echo  $_GET['file'] ?></h2><br/>
                            <i id="add_const" class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="<?php echo  IMAGE_INSERT ?>">Add new const</i>

                            <div class="col-sm-5 m-b m-r-lg const_filter">
                                <input type="text" name="const_filter" class="form-control m-b-xs" id="const_filter" placeholder="const">
                            </div>
                            <div class="col-sm-5 m-b val_filter">
                                <input type="text" name="val_filter" class="form-control m-b-xs" id="val_filter" placeholder="val">
                            </div>

                        </div>

                        <div class="col-md-12 pl-20">
                            <form class="form-horizontal" method="post" name="change_const">
                                <input type="hidden" value="<?php echo  $current_dir .DIRECTORY_SEPARATOR. $_GET['file'] ?>" name="file">
                                <input type="hidden" value="<?php if (empty($_GET['path'])){$temp_arr = explode('.',$_GET['file']); $current_language = array_shift($temp_arr);}else{$folders_array = explode('\\',$_GET['path']); $current_language = array_shift($folders_array); }echo  $current_language ?>" name="current_language">
                                <?php foreach ($arr as $line => $v): ?>
                                    <div class="form-group">
                                        <div class="col-xs-12 col-sm-12 col-md-3 no-padder">
                                            <span class="const"><?php echo  $v['const'] ?></span>
                                            <!--<span class="edit-const" data-const="<?php /*echo  $v['const'] */?>" ><i class="fa fa-pencil" style="font-size: 18px;cursor: pointer;"></i></span>-->
<!--                                            <span style="font-size: 11px;display: inline-block; font-weight: bold;">In developing(need google api key)</span>-->
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 const-val-area">
                                            <textarea required class="form-control" data-autoresize name="<?php echo  $v['const'] ?>[new]" rows="1"><?php echo $v['val'] ?></textarea>

                                            <textarea  required class="form-control value hidden" name="<?php echo  $v['const'] ?>[base]" readonly><?php echo  $v['val'] ?></textarea>
<!--                                            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#--><?php //echo  $v['const'] ?><!--_" aria-expanded="false" aria-controls="collapseExample">show old value</button>-->
<!--                                            <div class="collapse" id="--><?php //echo  $v['const'] ?><!--_">-->
<!--                                                --><?php //echo  htmlspecialchars($v['val']) ?>
<!--                                            </div>-->
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-3 hidden no-padder">
                                            <div class="btn btn-default ok"><?=TEXT_MODAL_UPDATE_ACTION?></div>
                                            <div class="btn btn-default reset"><?=IMAGE_CANCEL?></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <style type="text/css">
        .const {
            word-break: break-all;
        }

        .languages_translater table tr.active{
            background-color: #fff;
        }
        .languages_translater .form-group {
            margin-bottom: 5px;
        }
    </style>
    <script>
        $(document).ready(function () {

            $('#const_filter,#val_filter').on('input',function(){
                var filter_const = $('#const_filter').val().toLowerCase();
                var filter_val = $('#val_filter').val().toLowerCase();
                $('form[name=change_const] .form-group').hide();
                $('form[name=change_const] .form-group').each(function(){
                    if ($(this).find('.const').text().toLowerCase().includes(filter_const) && $(this).find('textarea:not(.value)').text().toLowerCase().includes(filter_val) ){
                        $(this).show();
                    }
                })
            })
            $
            $.each($('textarea[data-autoresize]'), function() {
                var offset = this.offsetHeight - this.clientHeight;

                var resizeTextarea = function(el) {
                    $(el).css('height', 'auto').css('height', el.scrollHeight + offset);
                };
                resizeTextarea(this);
                $(this).on('keyup input', function() { resizeTextarea(this); }).removeAttr('data-autoresize');
            });
            $(document).on('focusin','textarea',function(){
                $(this).parent().next().removeClass('hidden');
            })
            $(document).on('focusout','textarea',function(e){
                if($('.ok:hover,.reset:hover').length) {
                    return;
                }
                $(this).parent().next().addClass('hidden');
            })
            $('body').on('click', '.form-group ul>li', function () {
                var $langId = $(this).data('lang');
                var block = $(this).closest('.form-group');
                block.find('li.active').removeClass('active');
                $(this).addClass('active');
                block.find('div[data-lang]').removeClass('active');
                block.find('div[data-lang="' + $langId + '"]').addClass('active');
            });
            $(document).on('click','.reset',function(){
                var formGroup = $(this).parents('.form-group');
                var defaultValue = formGroup.find('textarea.hidden.value').val();
                var textarea = formGroup.find('textarea');
                textarea.val(defaultValue).trigger('input');;
            })
            $(document).on('click','.ok',function () {
                var formGroup = $(this).parents('.form-group');
                var defaultValue = formGroup.find('textarea.hidden.value').val();
                var newValue = formGroup.find('textarea').val();
                var constName = formGroup.find('.const').text();
                var filename = $('form[name=change_const] input:hidden[name=file]').val();
                var formData = {};
                var params = new URLSearchParams(location.search.slice(1)).toString();
                if (defaultValue !== newValue){
                    formData[constName]={'base':defaultValue,'new':newValue};
                    formData['file'] = filename;
                    $.ajax({
                        'url':'languages_translater.php?'+params,
                        'type':'POST',
                        'data':formData
                    })
                        .done(function(response){
                            console.log(response);
                            formGroup.find('textarea.hidden.value').val(newValue);
                        });
                }

            });
            $('#add_const').click(function () {
                var body = '<p>Please Enter Your Constant:</p>';
                body += '<div class="form-group">';
                body += '<input type="text" name="const_name" required placeholder="const name, in upper case" class="form-control">';
                body += '</div>';
                body += '<div class="form-group">';
                body += '<input type="text" name="const_val" required placeholder="const val" class="form-control">';
                body += '</div>';
                body += '<input type="hidden" name="const_file" value="<?= addslashes($_GET['path'].DIRECTORY_SEPARATOR.$_GET['file'])?>" required class="form-control">';
                body += '<input type="hidden" name="action" value="newConst" required class="form-control">';
                body += '<p class="error-input"></p>';
                body += '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
                body += '<input type="submit" class="btn btn-default">';
                modal({
                    body: body,
                    after: function (modal) {
                        modal.on('click', 'input[type="submit"]', function (e) {
                            var constName = $(modal).find('input').val();
                            var data={};
                            var errMsg = '';
                            $('.modal input:not(:submit)').serializeArray().map(function(arr){data[arr.name] = arr.value});

                            var additionalQuery = '';
                            if(window.location.search.indexOf('translate=admin') !== -1) {
                                additionalQuery = '?translate=admin';
                            }

                            $.post(window.location.pathname + additionalQuery, data, function (r) {
                                if (r.error){
                                    $('.modal .error-input').text(r.text);
                                }else{
                                    $('form[name="change_const"]').append(r.text);
                                    $(modal).modal('hide');
                                    scrollToElement('form[name="change_const"]>.form-group:last');
                                }
                            }, "json");
                        });

                    }
                })
            });
            $(document).on('click','.edit-const',function(){
                var constname = $(this).data('const');
                $.get('ajax_edit_const.php?',{
                    file:'<?= $_GET['file']?>',
                    path:'<?= addslashes($_GET['path'])?>',
                    translate:'<?= $_GET['translate']?>',
                    constname:constname
                },function(data){
                    modal({
                        'title':constname,
                        'body':data
                    })
                },'html')
            })


            $(document).on('click','.submit-edit-const',function(){
                $(this).prop('disabled',true);
                var constname = $(this).data('constname');
                var constArray = {};
                $('.file_name').each(function () {
                    var name = $(this).attr('name');
                    constArray[name] =  {
                        new:$('[name="'+name+'[new]"]').val(),
                        base:$('[name="'+name+'[base]"]').val(),
                        directory:$('[name="'+name+'[directory]"]').val()
                    }
                })
                console.log(constArray,constname);
                $.post('ajax_edit_const.php?translate=<?= $_GET['translate']?>',{
                    constArray:constArray,
                    constname:constname,
                },function(r){
                    $('[name="'+constname+'[base]"]').val(constArray[$('[name="current_language"]').val()].new);
                    $('[name="'+constname+'[new]"]').val(constArray[$('[name="current_language"]').val()].new);
                   $('.modal').modal('hide');
                },'html');
            });

        });
    </script>

<?php
include_once(DIR_FS_ADMIN . 'footer.php');
include_once(DIR_FS_ADMIN . 'html-close.php');
require(DIR_FS_ADMIN . DIR_WS_INCLUDES . 'application_bottom.php');
