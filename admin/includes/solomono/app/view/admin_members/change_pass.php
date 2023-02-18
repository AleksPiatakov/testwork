<form class="form-horizontal" action="<?php echo  ($_SERVER['SCRIPT_URL']?:$_SERVER['SCRIPT_NAME']) . '?action=changepassconfirm_admin' ?>" method="post">
    <?php if (!empty($data['id'])): ?>
        <input type="hidden" name="id" value="<?php echo  $data['id'] ?>">
    <?php endif; ?>
    <div class="col-md-12">
        <div class="form-group">
            <label for="password" class="col-sm-3 control-label"><?php echo addDoubleDot(TEXT_INFO_PASSWORD)?></label>
            <div class="col-sm-9">
                <input type="password" name="password" placeholder="<?php echo TEXT_INFO_PASSWORD?>" class="form-control" id="password">
            </div>
        </div>
        <div class="form-group">
            <label for="password_confirm" class="col-sm-3 control-label"><?php echo addDoubleDot(TEXT_INFO_CONFIRM)?></label>
            <div class="col-sm-9">
                <input type="password" name="password_confirm" placeholder="<?php echo TEXT_INFO_CONFIRM?>" class="form-control" id="password_confirm">
            </div>
        </div>
    </div>
    <div class="form-group text-right">
        <div class="col-sm-12">
            <input type="submit" value="OK" class="btn">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo  TEXT_MODAL_CANCEL_ACTION ?></button>
        </div>
    </div>
</form>