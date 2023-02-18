<?php $action_form = (!empty($data['data'])) ? "update_$action" : "insert_$action"; ?>

<form class="form-horizontal <?php echo $action ?>"
      action="<?php echo ($_SERVER['SCRIPT_URL'] ?: $_SERVER['SCRIPT_NAME']) . '?action=' . $action_form; ?>"
      method="post" enctype="multipart/form-data">
    <?php if (!empty($data['data'])) { ?>
        <input type="hidden" name="id" value="<?php echo $data['data']['id']?>">
    <?php } ?>
    <div class="col-md-12">
        <?php
        foreach ($data['allowed_fields'] as $field_name => $option) {
            if (!isset($option['type']) || $option['hideInForm'] === true) {
                continue;
            }
            if ($option['type'] == "select") {
                $val = isset($option['option']['id']) && isset($data['data'][$option['option']['id']]) ? $data['data'][$option['option']['id']] : $data['data'][$field_name];
            } else {
                $val = (!empty($data['data'][$field_name])) ? $data['data'][$field_name] : '';
            }
            require('renderInput.php');
        }
        ?>
    </div>
    <div class="form-group text-right">
        <div class="col-sm-12">
            <input type="submit" value="OK" class="btn">
            <button type="button" class="btn btn-info saveInputData"><?php echo TEXT_MODAL_APPLY_ACTION?></button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo TEXT_MODAL_CANCEL_ACTION?></button>
        </div>
    </div>
</form>