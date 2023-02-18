<?php
//debug($data);
//debug($action);
$send_data = $data['data'][0];
$send_languages = $data['languages'];
include(DIR_WS_LANGUAGES . $_SESSION['language'] . '/modules/newsletters/' . $send_data['module'] . '.php');
?>

<?php $action_form = (!empty($data['data'])) ? "update_$action" : "insert_$action"; ?>
<div id="send2">
    <form  id="customersForm" class="form-horizontal <?=$action?>" action="<?=$_SERVER['SCRIPT_NAME']?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="send2">
        <?php if (!empty($_GET['id'])): ?>
            <input type="hidden" name="id" value="<?=$_GET['id']?>">
        <?php endif; ?>
        <div class="col-md-12">
            <?php foreach ($data['allowed_fields'] as $field_name => $option): ?>
                <?php if (!isset($option['type']) || $option['hideInForm'] === true || ($field_name!== 'customers' && $field_name!== 'products')) continue; ?>
                <?php $val = (!empty($data['data'][$field_name])) ? $data['data'][$field_name] : ''; ?>
                <?php require ('renderInput.php')?>
            <?php endforeach; ?>
        </div>
        <div class="form-group text-right">
            <div class="col-sm-12">
                    <button type="button" value="OK" class="btn">OK</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?=TEXT_MODAL_CANCEL_ACTION?></button>
            </div>
        </div>
    </form>
</div>


<script>
    $(document).ready(function () {

        $('.form-horizontal').on('click', 'button[type="button"]', function (e) {
            $.post(window.location.pathname, $('#customersForm').serialize(), function (response) {
                if(response['html']){
                    $('#customersForm').html(response['html']);
                }
            }, "json");
        });

        $('.form-horizontal').on('click', 'input[type="image"]', function (e) {
            e.preventDefault();
            $.post(window.location.pathname, $('#customersForm').serialize(), function (response) {
                if(response['html']){
                    $('#customersForm').html(response['html']);
                }
            }, "json");
        });
    })
</script>