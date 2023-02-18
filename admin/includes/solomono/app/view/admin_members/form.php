<?php
$dataPages = [
    FILENAME_DEFAULT    => FILENAME_DEFAULT_TEXT,
    FILENAME_CATEGORIES => FILENAME_CATEGORIES_TEXT
];

?>

<?php $action_form = (!empty($data['data'])) ? "update_$action" : "insert_$action"; ?>

<form class="form-horizontal <?php echo $action?>" action="<?php echo ($_SERVER['SCRIPT_URL']?:$_SERVER['SCRIPT_NAME']) . '?action=' . $action_form;?>" method="post" enctype="multipart/form-data">
    <?php if (!empty($data['data'])): ?>
        <input type="hidden" name="id" value="<?php echo $data['data']['id']?>">
    <?php endif; ?>
    <div class="col-md-12">

        <div class="form-group">

            <div class="col-sm-4">
                <label for="admin_groups_name"><?=addDoubleDot(TABLE_HEADING_GROUPS)?></label>
            </div>
            <div class="col-sm-8">
                <input type="text" value="<?=$data['data']['admin_groups_name'];?>" name="admin_groups_name" class="form-control" id="">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-4">
                <label for = "admin_redirect_link_from_index"><?=addDoubleDot(TABLE_HEADING_PAGES_REDIRECT); ?></label>
            </div>
            <div class="col-sm-8">
                <select name="admin_redirect_link_from_index" id="default_pages" class="form-control">
                    <?php foreach ($dataPages as $link => $pageName): ?>
                        <option <?php echo $link == $data['data']['admin_redirect_link_from_index'] ? 'selected' : '';?> value="<?php echo $link?>"><?php echo $pageName?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

    </div>
    <div class="form-group text-right">
        <div class="col-sm-12">
            <input type="submit" value="OK" class="btn">
            <button type="button" class="btn btn-info saveInputData"><?php echo TEXT_MODAL_APPLY_ACTION?></button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo TEXT_MODAL_CANCEL_ACTION?></button>
        </div>
    </div>
</form>