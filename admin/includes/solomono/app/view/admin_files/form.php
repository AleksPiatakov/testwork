<?php
//debug($data);
//debug($action);

?>

<?php $action_form = (!empty($data['data'])) ? "update_$action" : "insert_$action"; ?>
<form class="form-horizontal <?=$action?>" action="<?=($_SERVER['SCRIPT_URL']?:$_SERVER['SCRIPT_NAME']) . '?action=' . $action_form;?>" method="post" enctype="multipart/form-data">
    <?php if (!empty($data['data'])): ?>
        <input type="hidden" name="id" value="<?=$data['data']['id']?>">
    <?php endif; ?>
    <input type="hidden" name="tPath" value="<?=$_GET['tPath']?:false?>">
    <div class="col-md-12">
        <?php foreach ($data['allowed_fields'] as $field_name => $option): ?>
            <?php if (!isset($option['type']) || $option['hideInForm'] === true) continue; ?>
            <?php $val = (!empty($data['data'][$field_name])) ? $data['data'][$field_name] : ''; ?>
            <?php require ('renderInput.php')?>
        <?php endforeach; ?>
    </div>
    <div class="form-group text-right">
        <div class="col-sm-12">
            <input type="submit" value="OK" class="btn">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?=TEXT_MODAL_CANCEL_ACTION?></button>
        </div>
    </div>
</form>