<?php

if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {

    chdir('../../');
    $configParse = parse_ini_file(".env");
    $rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
    chdir($configParse['ADMIN_FOLDER']);
    require_once $rootPath . '/' . $configParse['ADMIN_FOLDER'] . '/includes/application_top.php';
    require_once $rootPath . '/' . $configParse['ADMIN_FOLDER'] . '/includes/languages/' . $language . '/new_importexport.php';


    // if we are checking progress
    if($_GET['checkImportProgress']== true) {
        echo file_get_contents($rootPath.'/ext/yml_import/progress.txt');
        exit;
    }

    // if we went to stop process
    if($_GET['stopImportProcess']== true) {
        file_put_contents($rootPath.'/ext/yml_import/stop.txt','1');
        exit;
    }

    if ($_GET['endImportProcess']==true) {
        file_put_contents($rootPath.'/ext/yml_import/progress.txt', '{"productsProcessed":0,"imagesUploaded":0}');
        exit;
    }

} else {
    file_put_contents($rootPath.'/ext/yml_import/stop.txt','0');
//  file_put_contents($rootPath.'/ext/yml_import/progress.txt', '{"productsProcessed":0,"imagesUploaded":0}');
}

$checkProgress = json_decode(file_get_contents($rootPath . '/ext/yml_import/progress.txt'));
if ($checkProgress->productsProcessed == 100 and $checkProgress->imagesUploaded == 100) {
    file_put_contents($rootPath . '/ext/yml_import/progress.txt', '{"productsProcessed":0,"imagesUploaded":0}');
} elseif ($checkProgress->productsProcessed != 0 or $checkProgress->imagesUploaded != 0) {
    $continueProgress = true;
} else {
    $continueProgress = false;
}

require(DIR_WS_CLASSES . 'currencies.php');
$currencies = new currencies();
$exportLog = '';
$allowed_image_types = ['image/jpeg','image/gif','image/png','image/webp'];
$allowed_table_types = ['text/xml','application/xml'];

//debug($_FILES);

if(!empty($_GET['vendor'])){
    $vendor_template = $_GET['vendor'] ?? 'ukrservice';
    $modelCodeTag = $_GET['modelCodeTag'] ?: 'vendorCode';
    $urlData = download_price($_GET['link'],$vendor_template);
    $file_path = $urlData['filepath'] ?? false;
    $upload_images = $_GET['upload_images'] ?? false;
    $truncate_table = $_GET['truncate_table'] ?? false;
    $replace_name = $_GET['replace_name'] ?? false;
    $replace_attributes = $_GET['replace_attributes'] ?? false;
    $replace_price = $_GET['replace_price'] ?? false;
    $replace_quantity = $_GET['replace_quantity'] ?? false;
    $replace_image = $_GET['replace_images'] ?? false;
    $main_category = !empty($_GET['category_id']) ? $_GET['category_id'] : 0;
    $missing_offers = isset($_GET['missing_offers']) ? $_GET['missing_offers'] : 'nothing';

    require_once('../ext/yml_import/yml.php');

} else {
    if(tep_not_null($_FILES) && in_array($_FILES['excelfile']['type'], $allowed_table_types)) {
        $vendor_template = $_POST['vendor_template'] ?? 'ukrservice';
        $modelCodeTag = $_GET['modelCodeTag'] ?: 'vendorCode';
        $urlData['success'] = true;
        $file_path = $_FILES['excelfile']['tmp_name'];
        $upload_images = isset($_POST['uploadImages']);
        $truncate_table = isset($_POST['truncateTable']);
        $replace_name = $_POST['replaceName'] ?? false;
        $replace_attributes = $_POST['replaceAttributes'] ?? false;
        $replace_price = $_POST['replacePrice'] ?? false;
        $replace_image = $upload_images?true:($_POST['replaceImage'] ?? false);
        $replace_quantity = $_POST['replaceQuantity'] ?? false;
        $main_category = !empty($_POST['main_category']) ? $_POST['main_category'] : 0;
        $missing_offers = isset($_POST['missing_offers']) ? $_POST['missing_offers'] : 'nothing';

        require_once('../ext/yml_import/yml.php');
        exit;
    }
}

function download_price($url, $vendor_template)
{
    $file_path = $_SERVER['DOCUMENT_ROOT'] . '/temp/' . $vendor_template . '.xml';

    $result = [
        'filepath' => $file_path,
    ];

    if ($url) {
        $path = $file_path;
        $content = @file_get_contents($url);
        if ($content !== false) {
            file_put_contents($path, $content);
            if (file_exists($file_path) && filesize($file_path) > 0) {
                $result = array(
                    'success' => true,
                    'filepath' => $file_path,
                    'msg' => 'Downloaded successfully'
                );
            } else {
                $result = array(
                    'success' => false,
                    'filepath' => $file_path,
                    'msg' => 'File not in place'
                );
            }
        } else {
            $result = array(
                'success' => false,
                'filepath' => $file_path,
                'msg' => 'Wrong link'
            );
        }
        //echo json_encode($result);
    }
    return $result;
}

if ($current_page == FILENAME_NEW_IMPORT_EXPORT) { ?>
    <?php if (tep_not_null($exportLog)) { ?>
        <div id="progress"></div>
        <?= $exportLog ?>
    <?php } else { ?>
        <form id="upload_form" enctype="multipart/form-data" method="post">
        <?php if ($continueProgress) { ?>
            <input type="hidden" name="continueProgress" id="continueProgress" value="true"
                   data-products="<?php echo $checkProgress->productsProcessed; ?>"
                   data-images="<?php echo $checkProgress->imagesUploaded; ?>">
        <?php } ?>
            <div class="settings_block">
                <label>
                    <input type="checkbox" name="uploadImages" id="uploadImages">
                    <span><?php echo YML_IMPORT_UPLOAD_IMAGES; ?></span>
                </label>
                <label>
                    <input type="checkbox" name="truncateTable" id="truncateTable">
                    <span><?php echo YML_IMPORT_TRUNCATE_TABLE; ?></span>
                </label>
                <p style="width:100%"><?php echo YML_IMPORT_REPLACE_TEXT; ?></p>
                <label>
                    <input type="checkbox" checked name="replaceName" id="replaceName">
                    <span><?php echo YML_IMPORT_REPLACE_NAME; ?></span>
                </label>
                <label>
                    <input type="checkbox" checked name="replacePrice" id="replacePrice">
                    <span><?php echo YML_IMPORT_REPLACE_PRICE; ?></span>
                </label>
                <label>
                    <input type="checkbox" checked name="replaceQuantity" id="replaceQuantity">
                    <span><?php echo YML_IMPORT_REPLACE_QUANTITY; ?></span>
                </label>
                <label>
                    <input type="checkbox" checked name="replaceImage" id="replaceImage">
                    <span><?php echo YML_IMPORT_REPLACE_IMAGE; ?></span>
            </label>
            <label>
                <input type="checkbox" checked name="replaceAttributes" id="replaceAttributes">
                <span>Атрибути</span>
                </label>
                <div style="width: 100%;">
                    <label><span style="color: #313132;"><?php echo YML_IMPORT_MAIN_CATEGORY; ?></span></label>
                    <?php echo tep_draw_pull_down_categories('main_category', $tep_get_category_tree) ?>
                </div>
                <div style="width: 100%;">
                    <label><span style="color: #313132; margin: 20px 0 5px 0"><?php echo YML_IMPORT_MISSING_OFFERS; ?></span></label>
                    <?php
                    $missing_offers_options = [
                        ['id'=>'nothing', 'text'=> YML_IMPORT_MISSING_OFFERS_TEXT_NOTHING],
                        ['id'=>'turnoff', 'text'=> YML_IMPORT_MISSING_OFFERS_TEXT_TURN_OFF],
                        ['id'=>'delete', 'text'=> YML_IMPORT_MISSING_OFFERS_TEXT_DELETE],
                    ];
                    ?>
                    <?php echo tep_draw_pull_down_menu('missing_offers',$missing_offers_options) ?>
                </div>
                <div style="width: 100%;">
                    <label><span style="color: #313132;margin: 20px 0 5px 0"><?php echo YML_IMPORT_MARKUP; ?></span></label>
                    <div class="price_markup">
                        <font><?php echo YML_IMPORT_REPLACE_PRICE; ?></font>
                        <?php echo tep_draw_pull_down_menu('markup_type_price0', array(['id'=>'0','text'=>YML_IMPORT_NUMBER],['id'=>'1','text'=>'%'])) ?>
                        <?php echo tep_draw_input_field('markup_value_price0', '', 'class="form-control"'); ?>
                    </div>
                    <?php
                    $prices_num = tep_xppp_getpricesnum();
                    if($prices_num > 1) {
                        for ($i = 2; $i <= $prices_num; $i++) { ?>
                            <div class="price_markup">
                                <font><?php echo YML_IMPORT_REPLACE_PRICE . ' ' . $i; ?></font>
                                <?php echo tep_draw_pull_down_menu('markup_type_price'.$i, array(['id'=>'0','text'=>YML_IMPORT_NUMBER],['id'=>'1','text'=>'%'])) ?>
                                <?php echo tep_draw_input_field('markup_value_price'.$i, '', 'class="form-control"'); ?>
                            </div>
                        <?php    }
                    }

                    ?>
                </div>
                <?php if(count(tep_get_languages()) > 1){ ?>
                    <div style="width: 100%;">
                        <label><span style="color: #313132;"><?php echo YML_IMPORT_LANGUAGE; ?></span></label>
                        <?php
                        $import_languages = [];
                        foreach (tep_get_languages() as $lang_data){
                            $import_languages[] = [
                                'id' => $lang_data['id'],
                                'text' => $lang_data['name'],
                            ];
                        }
                        ?>
                        <?php echo tep_draw_pull_down_menu('import_language', $import_languages) ?>
                    </div>
                <?php } ?>
            </div>
            <div class="actions">
                <label>
                    <input type="file" class="load_file" name="excelfile" id="excelfile" accept=".xml">
                    <span id="replacement_block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                <g fill="none" fill-rule="evenodd">
                                    <g fill="#1283E4" fill-rule="nonzero">
                                        <g>
                                            <g>
                                                <g>
                                                    <path fill-opacity=".4" d="M0 15.5v-1c0-.276.224-.5.5-.5h15c.276 0 .5.224.5.5v1c0 .276-.224.5-.5.5H.5c-.276 0-.5-.224-.5-.5z" transform="translate(-1136 -110) translate(430 100) translate(650) translate(56 10)"/>
                                                    <path d="M9.147.75v7.251h3.137c.637 0 .956.672.505 1.066l-4.297 3.757c-.27.235-.707.235-.977 0L3.211 9.067c-.45-.394-.132-1.066.505-1.066h3.14V.751c0-.2.09-.391.252-.532.16-.14.38-.22.608-.219h.572c.228 0 .447.078.608.22.16.14.251.331.25.53z" transform="translate(-1136 -110) translate(430 100) translate(650) translate(56 10)"/>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            <?php echo YML_IMPORT_UPLOAD_FILE; ?>
                        </span>
                </label>
                <button type="submit" id="upload_button" class="btn btn-info green_btn"><?php echo YML_IMPORT_UPLOAD_BUTTON; ?></button>
            </div>
            <div class="progresses">
                <div class="progress_upload_block clearfix">
                    <div class="progress_left">File upload progress</div>
                    <div id="progress_upload"><div class="bar"></div></div>
                </div>
                <div class="progress_products_block clearfix">
                    <div class="progress_left">Products processing progress</div>
                    <div id="progress_products"><div class="checkImportProgress"></div></div>
                </div>
                <div class="progress_images_block clearfix">
                    <div class="progress_left">Images Uploading progress</div>
                    <div id="progress_images"><div class="checkImportProgress"></div></div>
                </div>

            </div>
        </form>
    <?php } ?>
<?php } ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        if ($("#continueProgress").val()) {
            $('.progresses').fadeIn();
            $('.progress_products_block').fadeIn();
            $('#progress_products .checkImportProgress').css('width', ($("#continueProgress").attr('data-products')) + '%');
            $('#progress_images .checkImportProgress').css('width', ($("#continueProgress").attr('data-images')) + '%');
            timer = window.setInterval(refreshProgress, 1000);
            $('#replacement_block').fadeOut(100);
            $('#upload_button').fadeOut(0).after('<div class="btn btn-info green_btn abortProcess">ABORT</div>');
        }
    });

    $("#upload_button").click(function() {
        event.preventDefault();

        $('.checkImportProgress').css('width','0%');
        $('#progress_upload .bar').css('width', '0%');
        $('.progresses').fadeIn();

        var form = document.querySelector("#upload_form");
        var formData = new FormData(form);

        $.ajax({
            type: "POST",
            url: "../ext/yml_import/yml_import.php",
            data: formData,
            xhr: function() {
                var xhr = $.ajaxSettings.xhr();
                xhr.upload.addEventListener('progress', function(ev) {
                    $('#progress_upload .bar').css('width', (ev.loaded/(ev.total/100))+'%');
                }, false);
                xhr.upload.addEventListener('load', function(ev) {
                    $('.progress_products_block').fadeIn();
                    timer = window.setInterval(refreshProgress, 1000);
                    $('#replacement_block').fadeOut(100);
                    $('#upload_button').fadeOut(0).after('<div class="btn btn-info green_btn abortProcess">ABORT</div>');
                }, false);

                return xhr;
            },
            beforeStart: function() {
                $('#progress_upload .bar').css('width', '0%');
            },
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            success:function(data){
                // $("#progress_products .checkImportProgress").html(data+' products updated');
            }
        });
    });

    var timer;

    function refreshProgress() {
        $.ajax({
            url: "../ext/yml_import/yml_import.php?checkImportProgress=true",
            dataType: 'json',
            success:function(data){
                $('#progress_products .checkImportProgress').css('width',(data.productsProcessed)+'%');

                // If the process is completed, we should stop the checking process.
                if (data.productsProcessed == 100) {

                    if ($(".progress_images_block").is(":hidden")) $('.progress_images_block').fadeIn();
                    $('#progress_images .checkImportProgress').css('width', (data.imagesUploaded) + '%');
                    if (data.imagesUploaded == 100) {
                        window.clearInterval(timer);
                        timer = window.setInterval(completed, 500);
                    }
                }
            }
        });
    }

    function completed() {
        window.clearInterval(timer);
        $('.abortProcess').fadeOut(0);
        $('#upload_button').fadeIn(0);
        $('#replacement_block').fadeIn(100);

        // change counters to 0:
        $.ajax({
            url: "../ext/yml_import/yml_import.php?endImportProcess=true",
        });
    }

    jQuery('body').on('click', '.abortProcess', function(event) {
        $.ajax({
            url: "../ext/yml_import/yml_import.php?stopImportProcess=true",
            success:function(data){
                $('.progresses').fadeOut(0);
                $('.checkImportProgress').css('width','0%');
                $('#progress_upload .bar').css('width', '0%');
                completed();
            }
        });
    });

</script>
<style>
    .progresses {
        display:none;
        padding:20px;
    }

    .checkImportProgress {
        background:#FFD700;
        height:20px;
        color:#fff;
        padding:2px;
        transition: 1s linear;
        text-align:left;
    }

    #progress_images .checkImportProgress {
        background:#eee;
    }

    .progress_upload_block {
        color:#fff;
    }

    #progress_upload .bar {
        background:#0057B7;
        width:0%;
        transition: 1s linear;
        height:20px;
    }

    .progress_products_block, .progress_images_block {
        display:none;
    }

    .progress_left {
        float:left;
        width:200px;
        padding:3px;
    }

    .abortProcess {
        background-color:red!important;
    }

    .price_markup{
        display: inline-block;
        margin-bottom: 10px;
        height: 35px;
    }
    .price_markup font {
        width: 39px;
        display: inline-block;
    }
    .price_markup select{
        width: 75px;
        display: inline;
        margin-right: -4px;
        padding: 5px;
    }
    .price_markup input[type=text]{
        width: 50px;
        display: inline;
        padding: 5px;
    }
</style>

