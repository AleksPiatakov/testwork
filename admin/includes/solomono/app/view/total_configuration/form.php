<?php
//debug($data);
//debug($action);

?>

<?php $action_form=(!empty($data['data'])) ? "update_$action" : "insert_$action"; ?>

<form class="form-horizontal" action="<?php echo ($_SERVER['SCRIPT_URL']?:$_SERVER['SCRIPT_NAME']) . '?action=' . $action_form;?>" method="post" enctype="multipart/form-data">
    <?php if (!empty($data['data'])): ?>
        <input type="hidden" name="id" value="<?php echo $data['data']['id']?>">
    <?php endif; ?>
    <div class="col-md-12">
        <?php foreach ($data['allowed_fields'] as $field_name=>$option): ?>
            <?php if (!isset($option['type']) || $option['hideInForm']===true)continue; ?>
            <?php $val=(!empty($data['data'][$field_name])) ? $data['data'][$field_name] : ''; ?>
            <div class="form-group">
                <label for="<?php echo $field_name;?>" class="col-sm-3 control-label"><?php echo addDoubleDot($option['label']);?></label>
                <div class="col-sm-9">
                    <?php if ($field_name == 'configuration_value' && !empty($data['data']['set_function'])): ?>
                        <?php eval('$value_field = ' . $data['data']['set_function'] . '"' . htmlspecialchars($data['data']['configuration_value']) . '");'); ?>
                        <?php echo $value_field;?>
                    <?php elseif ($option['type']=='select'): ?>
                        <select class="form-control" name="<?php echo $field_name;?>" id="<?php echo $field_name;?>">
                            <?php foreach ($data['option'][$field_name] as $k=>$v): ?>
                                <option value="<?php echo $k;?>" <?php echo $k==$data['data'][$field_name]?'selected':'';?> ><?php echo $v;?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php elseif ($option['type']=='disabled'): ?>
                        <input type="<?php echo $option['type']?>" value="<?php echo $val?>" disabled class="form-control">
                    <?php else: ?>
                        <input type="<?php echo $option['type']?>" value="<?php echo $val?>" name="<?php echo $field_name;?>" placeholder="<?php echo $option['placeholder']?:'';?>" class="form-control" id="<?php echo $field_name;?>">
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="form-group text-right">
        <div class="col-sm-12">
            <input type="submit" value="OK" class="btn">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo TEXT_MODAL_CANCEL_ACTION?></button>
        </div>
    </div>
</form>