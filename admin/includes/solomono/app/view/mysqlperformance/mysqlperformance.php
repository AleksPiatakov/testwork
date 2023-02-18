<?php require('includes/widgets/ShowMore/ShowMore.php');
//debug($data);
//debug($action);

?>
<div class="wrapper-title">
    <div class="bg-light lter ng-scope">
        <h1 class="m-n font-thin h3"><?php echo HEADING_TITLE;?></h1>
    </div>
</div>
<div class="row">
    <div class="col-sm-12" style="text-align: right">
        <button style="margin-bottom: 5px" class="btn btn-danger" data-toggle="tooltip" data-placement="top" data-action="deleteAll" id="delete_log_list"  title="<?php echo TEXT_DELETE?>">
            <?php echo TEXT_DELETE?>
        </button>
    </div>
</div>
<table id="own_table" class="table table-hover table-bordered bg-white-only b-t b-light <?php echo $action;?>">
    <thead>
    <tr>
        <?php
        if(isMobile()) {
            $data['allowed_fields'] = [
                '0'=>[
                    'label'=>TABLE_HEADING_NUMBER,
                    'general'=>'text',
                ],
                '1'=>[
                    'label'=>TABLE_HEADING_QUERY,
                    'general'=>'text',
                    'thWidth' => '500'
                ],
                '2'=>[
                    'label'=>TABLE_HEADING_QLOCATION,
                    'general'=>'text',
                    'thWidth' => '130'
                ],
                '3'=>[
                    'label'=>TABLE_HEADING_QUERY_TIME,
                    'general'=>'disabled',
                    'thWidth' => '120'
                ],
                '4'=>[
                    'label'=>TABLE_HEADING_DATE_CREATED,
                    'general'=>'text',
                    'thWidth' => '50'
                ],
            ];
        }
        ?>

        <?php foreach ($data['allowed_fields'] as $key=>$value): ?>
            <?php if ($value['show']===false)
                continue; ?>
            <th style="width: <?php echo $value['thWidth']?>px" data-table="<?php echo $key?>"><?php echo trim($value['label']);?>
                <?php if (!empty($value['filter'])) : ?>
                    <input type="text" class="search">
                <?php endif; ?>
                <?php if ($value['sort']===true): ?>
                    <i class="fa fa-sort fa-1x" aria-hidden="true"></i>
                <?php endif; ?>
            </th>
        <?php endforeach; ?>
        <th align="center" style="width: 50px;text-align: center;">

        </th>
    </tr>
    </thead>
    <tbody></tbody>
</table>

<div class="row row_pagin_admin">
    <div class="pagin_admin">
        <label><?php echo TEXT_SHOW?>
            <select name="per_page" id="per_page" style="width: 75px; display: inline-block;" class="form-control input-sm">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <?php echo TEXT_RECORDS?>
            <span id="count_prod"></span>
        </label>
    </div>

    <?php echo (new ShowMore) -> init($action, 'mysqlperformance.php'); ?>

    <div id="own_pagination"></div>
</div>


<!--  button for action -->
<div style="display: none" id="action" align="center">
    <button data-toggle="tooltip" data-action="delete_<?php echo $action?>" data-placement="top" title="<?php echo TEXT_MODAL_DELETE_ACTION?>" class="btn_own del_link">
        <i class="fa fa-trash-o"></i>
    </button>
</div>
<!-- end button for action -->
<script>
    $(document).ready(function () {
        $('body').on('click', '#delete_log_list', function () {
            var param = {
                msg: lang.all.TEXT_MODAL_CONFIRMATION_ACTION
            };
            var param_update = {};
            var $this = $(this), action = $this.data('action');

            if ($this.data('ajax')) {
                $.ajax({
                    url: window.location.pathname,
                    type: 'POST',
                    data: {id: id, action: 'check'},
                    success: function (data) {
                        var params = JSON.parse(data);
                        if (params.msg) {
                            param_update = {
                                msg: params.msg
                            }
                        }
                    },
                    dataType: "json",
                    async: false
                });
            }


            $.extend(param, param_update)

            var body = '<form>';
            body += '<p>' + lang.all.TEXT_MODAL_CONFIRMATION_ACTION + '</p>';
            body += '<input type="hidden" name="action" value="' + action + '">';
            if ($this.data('input')) {
                var matches = $this.data('input').match(/(.+)_(.+)/);
                body += '<p>' + lang.currentPage.TEXT_INFO_RESTOCK_PRODUCT_QUANTITY + '</p>';
                body += '<p><input type="' + matches[1] + '" name="' + matches[2] + '"></p>';
            }
            body += '<button type="button" class="btn btn-default" data-dismiss="modal">' + lang.all.TEXT_MODAL_CANCEL_ACTION + '</button>';
            body += '<button style="margin-left: 40px;" type="submit" class="btn btn-danger btn-confirm">OK</button>';
            body += '</form>';
            modal({
                id: 'confirm-delete',
                title: lang.all.TEXT_MODAL_CONFIRM_ACTION,
                body: body,
                width: '50%',
                after: function (modal) {
                    $(modal).on('click', 'button.btn-confirm', function (e) {
                        e.preventDefault();
                        var form = $(modal).find('form');
                        var data = form.serializeArray();
                        $.post(window.location.pathname, data, function (msg) {
                            $(modal).modal('hide');
                            if (msg.success == true) {
                                if ($this.closest('tbody').find('tr').length == 1) {
                                    delete(option.count);
                                    if (option.page == 1) {
                                        option.page = 1;
                                    } else {
                                        option.page = option.page - 1;
                                    }
                                }
                                // $this.closest('tr').remove();
                                $('#own_pagination').pagination('selectPage', option.page);
                            }
                            var time = msg.time || 1500;
                            var close = msg.close || false;
                            show_tooltip(msg.msg, time, $('body'), close);
                        }, "json");
                    })
                }
            });
        });
    });
</script>