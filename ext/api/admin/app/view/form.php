<?php $action_form = (!empty($data['data']['id'])) ? "update_$action" : "insert_$action"; ?>

<form class="form-horizontal <?php echo $action ?>"
      action="<?php echo ($_SERVER['SCRIPT_URL'] ? : $_SERVER['SCRIPT_NAME']) . '?action=' . $action_form; ?>"
      method="post" enctype="multipart/form-data">
    <?php if (!empty($data['data'])) { ?>
        <input type="hidden" name="id" value="<?php echo $data['data']['id'] ?>">
    <?php } ?>
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-sm-4">
                <label for="api_key_name"><?=API_KEY_NAME_LABEL?>:</label>
            </div>
            <div class="col-sm-8">
                <input type="text"
                       value="<?= isset($data['data']['api_key_name']) ? $data['data']['api_key_name'] : '' ?>"
                       name="api_key_name" class="form-control " id="api_key_name">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-4">
                <label for="api_key"><?=API_KEY_LABEL?>:</label>
            </div>
            <div class="col-sm-7">
                <input type="text" value="<?= isset($data['data']['api_key']) ? $data['data']['api_key'] : '' ?>"
                       name="api_key" class="form-control " id="api_key">
            </div>
            <div class="col-sm-1">
                <button type="button" class="btn btn-info w-full refresh-token"><?=API_KEY_REFRESH_BUTTON?></button>
            </div>
        </div>
    </div>
    <div class="form-group text-right">
        <div class="col-sm-12">
            <input type="submit" value="OK" class="btn">
            <button type="button" class="btn btn-info saveInputData"><?php echo TEXT_MODAL_APPLY_ACTION ?></button>
            <button type="button" class="btn btn-default"
                    data-dismiss="modal"><?php echo TEXT_MODAL_CANCEL_ACTION ?></button>
        </div>
    </div>
</form>

<script>
    $(document).on('click', '.refresh-token', function () {
        var rand = function () {
            return Math.random(0).toString(36).substr(2);
        };
        var token = function (length) {
            return (rand() + rand() + rand() + rand()).substr(0, length);
        };

        var PART_LENGTH = <?=\admin\includes\solomono\app\models\api_keys\api_keys::API_KEY_PART_LENGTH * 2?>;

        $('#api_key').val([
            token(PART_LENGTH),
            token(PART_LENGTH),
            token(PART_LENGTH),
        ].join('-'));
    });
</script>