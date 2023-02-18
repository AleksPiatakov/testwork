<?php require('includes/widgets/ShowMore/ShowMore.php');
//debug($data);
//debug($action);
global $login_id;
?>
<div class="wrapper-title">
    <div class="bg-light lter ng-scope">
        <h1 class="m-n font-thin h3"><?php echo HEADING_TITLE;?></h1>
    </div>
</div>
<table id="own_table" class="table table-hover table-bordered bg-white-only b-t b-light <?php echo $action;?>">
    <thead>
    <tr>
        <?php foreach ($data['allowed_fields'] as $key => $value): ?>
            <?php if ($value['show'] === false)
                continue; ?>
            <th data-table="<?php echo $key?>"><?php echo trim($value['label']);?>
                <?php if (!empty($value['filter'])) : ?>
                    <input type="text" class="search">
                <?php endif; ?>
                <?php if ($value['sort'] === true): ?>
                    <i class="fa fa-sort fa-1x" aria-hidden="true"></i>
                <?php endif; ?>
            </th>
        <?php endforeach; ?>
        <th align="center" style="width: 130px;text-align: center;">
            <button class="btn_own">
               <?php echo TABLE_HEADING_ACTION;?>
            </button>
        </th>
    </tr>
    </thead>
    <tbody></tbody>
</table>
<div class="row row_pagin_admin">
    <div class="pagin_admin">
        <label><?php echo TEXT_SHOW?>
            <select disabled name="per_page" id="per_page" style="width: 75px; display: inline-block;" class="form-control input-sm">
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <?php echo TEXT_RECORDS?>
            <span id="count_prod"></span>
        </label>
    </div>

    <?php echo (new ShowMore) -> init($action, 'template_configuration.php'); ?>

    <div id="own_pagination"></div>
</div>

<!--  button for action -->
<div style="display: none" id="action" align="center">
    <button class="btn_own edit_row" data-action="edit_<?php echo $action?>" data-toggle="tooltip" data-placement="top" title="<?php echo TEXT_MODAL_UPDATE_ACTION?>">
        <i class="fa fa-pencil-square-o"></i>
    </button>
    <?php if ($login_id == 1): ?>
    <button class="btn_own copy_row" data-action="copy_<?php echo $action?>" data-toggle="tooltip" data-placement="top" title="<?php echo 'Copy template'?>">
        <i class="fa fa-files-o"></i>
    </button>
    <?php endif; ?>
</div>


<?php if ($login_id == 1): ?>

<script>
    $(document).on('click','.copy_row', function(){
        var action = $(this).data('action');
        var id = $(this).closest('tr').data('id');
        $.get(window.location.pathname,{action:action,id:id},function(r){
            modal({
                id:action,
                title:r.title,
                body:r.html,
                width:'500px',
                after: function(modal){
                    $(modal).on('click', 'button', function (e) {
                        e.preventDefault();
                        var form = $(modal).find('form');
                        var data = form.serializeArray();
                        $.post(window.location.pathname, data, function (msg) {

                            $(modal).modal('hide');
                            var time = msg['time'] || 3000;
                            show_tooltip(msg['msg'], time);
                        }, "json");
                    })
                }
            })
        },'json')
    });
</script>
<?php endif; ?>
