<?php require(DIR_FS_ADMIN . 'includes/widgets/ShowMore/ShowMore.php');
//debug($data);
//debug($action);
?>
<div class="wrapper-title">
    <div class="bg-light lter ng-scope">
        <h1 class="m-n font-thin h3"><?php echo HEADING_TITLE; ?></h1>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <button style="margin-bottom: 5px" class="btn btn-success" data-toggle="tooltip" data-placement="top"
                id="update_word_list" data-update="update" title="<?php echo BUTTON_UPDATE_WORD_LIST ?>">
            <?php echo BUTTON_UPDATE_WORD_LIST ?>
        </button>
        <button style="margin-bottom: 5px" class="btn btn-success" data-toggle="tooltip" data-placement="top"
                data-action="edit_word" id="edit_word" title="<?php echo BUTTON_VIEW_WORD_LIST ?>">
            <?php echo BUTTON_VIEW_WORD_LIST ?>
        </button>
        <button style="margin-bottom: 5px" class="btn btn-danger" data-toggle="tooltip" data-placement="top"
                id="delete_word_list" title="<?php echo BUTTON_DELETE ?>">
            <?php echo BUTTON_DELETE ?>
        </button>
    </div>
</div>
<table id="own_table" class="table table-hover table-bordered bg-white-only b-t b-light <?php echo $action; ?>">
    <thead>
    <tr>
        <?php foreach ($data['allowed_fields'] as $key => $value) { ?>
            <?php if ($value['show'] === false) {
                continue;
            } ?>
            <th data-table="<?php echo $key ?>"><?php echo trim($value['label']); ?>
                <?php if (!empty($value['filter'])) { ?>
                    <input type="text" class="search">
                <?php } ?>
                <?php if ($value['sort'] === true) { ?>
                    <i class="fa fa-sort fa-1x" aria-hidden="true"></i>
                <?php } ?>
            </th>
        <?php } ?>
    </tr>
    </thead>
    <tbody></tbody>
</table>
<div class="row row_pagin_admin">
    <div class="pagin_admin">
        <label><?php echo TEXT_SHOW ?>
            <select name="per_page" id="per_page" style="width: 75px; display: inline-block;"
                    class="form-control input-sm">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <?php echo TEXT_RECORDS ?>
            <span id="count_prod"></span>
        </label>
    </div>
    <?php echo (new ShowMore())->init($action, '/admin/stats_keywords.php'); ?>
    <div id="own_pagination"></div>
</div>
<!-- end button for action -->
<script>
    $(document).ready(function () {
        widthOfModal = '60%';
        $('body').on('click', '#update_word_list', function () {
            $.post(window.location.pathname, {action: "update_word_list"}, function (response) {
                if (response['success'] == true) {
                    window.location.reload();
                }
            }, "json")
        });

        $('body').on('click', '#delete_word_list', function () {
            $.post(window.location.pathname, {action: "delete_word_list"}, function (response) {
                if (response['success'] == true) {
                    window.location.reload();
                }
            }, "json")
        });

        $('body').on('click', '#edit_word', getForm);
    });
</script>