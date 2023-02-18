<?php
//debug($data);
//debug($action);

?>

<?php $action_form=(!empty($data['data'])) ? "update_$action" : "insert_$action"; ?>

<form class="form-horizontal <?=$action?>" action="<?=($_SERVER['SCRIPT_URL']?:$_SERVER['SCRIPT_NAME']) . '?action=' . $action_form;?>" method="post" enctype="multipart/form-data">
    <?php if (!empty($data['data'])): ?>
        <input type="hidden" name="id" value="<?=current($data['data'])['id']?>">
    <?php endif; ?>
    <div class="col-md-12">
        <?php foreach ($data['allowed_fields'] as $field_name=>$option): ?>
            <?php if (!isset($option['type']) || $option['hideInForm']===true)continue; ?>
                <?php $val=(!empty($data['data'][0][$field_name])) ? $data['data'][0][$field_name] : ''; ?>
                <div class="form-group">
                    <label for="<?=$field_name;?>" class="col-sm-3 control-label"><?=addDoubleDot($option['label']);?></label>
                    <div class="col-sm-9">
                        <?php if ($option['type']=='textarea'): ?>
                            <textarea class="<?php echo $option['ckeditor'] === true ? 'ck_replacer' : ''?> form-control" rows="<?php echo $option['rows'] ?: 6?>" name="<?php echo $field_name?>[]"><?php echo $val?></textarea>
                        <?php elseif ($option['type']=='select'): ?>
                            <select class="form-control" name="<?=$field_name;?>" id="<?=$field_name;?>">
                            <?php foreach ($data['option'][$field_name] as $k=>$v): ?>
                                <option value="<?=$v['id'];?>" <?= $v['id'] == $val?'selected':''; ?> ><?= $v['title'] ? : $v['text'];?></option>
                            <?php endforeach; ?>
                            </select>
                        <?php else: ?>
                            <input type="<?=$option['type']?>" <?=$option['form_option']?:''?> value="<?=$val?>" name="<?=$field_name;?>" placeholder="<?=$option['placeholder']?:$option['label'];?>" class="form-control <?=$option['type_class']?:''?>" id="<?=$field_name;?>">
                        <?php endif; ?>
                    </div>
                </div>
        <?php endforeach; ?>
    </div>
    <div class="form-group text-right">
        <div class="col-sm-12">
            <input type="submit" value="OK" class="btn">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?=TEXT_MODAL_CANCEL_ACTION?></button>
        </div>
    </div>
</form>

