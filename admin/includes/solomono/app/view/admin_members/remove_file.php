<?php
    $file_query = tep_db_query("select admin_files_name from " . TABLE_ADMIN_FILES . " where admin_files_is_boxes = '0' ");
    while ($fetch_files = tep_db_fetch_array($file_query)) {
        $result[] = $fetch_files['admin_files_name'];
    }
    sort($result);
    reset($result);
    foreach ($result as $key => $val) {
//    while (list ($key, $val) = each($result)) {
        $show[] = array('id'   => $val,
                        'text' => $val
        );
    }
?>
<form class="form-horizontal" action="<?= ($_SERVER['SCRIPT_URL']?:$_SERVER['SCRIPT_NAME']) . '?action=removeconfirm_admin_files' ?>" method="post">
    <div class="col-md-12">
        <div class="form-group">
            <label for="admin_files_name" class="col-sm-3 control-label">Удалить файл:</label>
            <div class="col-sm-9">
                <?= tep_draw_pull_down_menu('admin_files_name', $show, $show); ?>
            </div>
        </div>
    </div>
    <div class="form-group text-right">
        <div class="col-sm-12">
            <input type="submit" value="OK" class="btn">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?= TEXT_MODAL_CANCEL_ACTION ?></button>
        </div>
    </div>
</form>