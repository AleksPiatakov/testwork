<?php
$file_query = tep_db_query("select admin_files_name from " . TABLE_ADMIN_FILES . " where admin_files_is_boxes = '0' ");
while ($fetch_files = tep_db_fetch_array($file_query)) {
    $files_array[] = $fetch_files['admin_files_name'];
}

$file_dir = array();
$excludeFiles = [
    FILENAME_DEFAULT, FILENAME_LOGIN, FILENAME_LOGOFF, FILENAME_FORBIDEN, FILENAME_PASSWORD_FORGOTTEN,
    FILENAME_ADMIN_ACCOUNT, FILENAME_ORDERS_INVOICE, FILENAME_ORDERS_PACKINGSLIP,
    'customization_panel.php', 'header.php', 'footer.php'
];

$dir = dir(DIR_FS_ADMIN);
while ($file = $dir->read()) {
    if (substr("$file", -4) == '.php' && !in_array($file, $excludeFiles) && strpos($file, 'ajax_') !== 0) {
        $file_dir[] = $file;
    }
}

$result = $file_dir;
if (sizeof($files_array) > 0) {
    $result = array_values(array_diff($file_dir, $files_array));
}

sort($result);
reset($result);
$show = [];
foreach ($result as $key => $val) {
    $show[] = array(
        'id' => $val,
        'text' => $val
    );
}

$group = [];
foreach ($data['result'] as $groupId => $groupName) {
    $group[] = array(
        'id' => $groupId,
        'text' => defined($groupName) ? constant($groupName) : $groupName
    );
}
?>
<form class="form-horizontal" action="<?= ($_SERVER['SCRIPT_URL'] ?: $_SERVER['SCRIPT_NAME']) . '?action=addconfirm_admin_files' ?>" method="post">
    <div class="col-md-12">
        <div class="form-group">
            <label for="admin_files_group" class="col-sm-3 control-label">Группа:</label>
            <div class="col-sm-9">
                <?= tep_draw_pull_down_menu('admin_files_group', $group, $group); ?>
            </div>
        </div>
        <div class="form-group">
            <label for="admin_files_name" class="col-sm-3 control-label">Имя файла:</label>
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