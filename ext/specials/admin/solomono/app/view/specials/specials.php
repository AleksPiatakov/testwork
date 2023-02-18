<div class="row">
    <div class="col-sm-6">
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
</div>
<table id="own_table" class="table table-hover table-bordered bg-white-only b-t b-light <?php echo $action;?>">
    <thead>
    <tr>
        <?php foreach ($data['allowed_fields'] as $key => $value) { ?>
            <?php if ($value['show'] === false) {
                continue;
            } ?>
            <th data-table="<?php echo $key?>"><?php echo trim($value['label']);?>
                <?php if (!empty($value['filter'])) { ?>
                    <input type="text" class="search">
                <?php } ?>
                <?php if ($value['sort'] === true) { ?>
                    <i class="fa fa-sort fa-1x" aria-hidden="true"></i>
                <?php } ?>
            </th>
        <?php } ?>
        <th align="center" style="width:130px;text-align: center;">
            <button class="btn_own" id="add1" data-action="new_<?php echo $action?>" data-toggle="tooltip" data-placement="top" title="<?php echo TEXT_MODAL_ADD_ACTION?>">
            <?php echo TABLE_HEADING_ACTION;?>
            </button>
        </th>
    </tr>
    </thead>
    <tbody></tbody>
</table>
<div id="own_pagination">
</div>
<!--  button for action -->
<div style="display: none" id="action" align="center">
    <div class="action_ER">
        <i class="fa fa-check-circle" aria-hidden="true"></i>
        <i class="fa fa-times" aria-hidden="true"></i>
    </div>
    <button class="btn_own edit-row" data-toggle="tooltip" data-placement="top" title="<?php echo TEXT_MODAL_UPDATE_ACTION?>">
        <i class="fa fa-pencil-square-o"></i>
    </button>
    <button data-toggle="tooltip" data-action="delete_<?php echo $action?>" data-placement="top" title="<?php echo TEXT_MODAL_DELETE_ACTION?>" class="btn_own del_link">
        <i class="fa fa-trash-o"></i>
    </button>
    <a data-toggle="tooltip" class="go_to" data-placement="top" title="<?php echo TEXT_MODAL_GO_TO?>" href="/product/"><i class="fa fa-external-link-square" aria-hidden="true"></i></a>
</div>
<script>
    var text_wait = '<?php echo TEXT_WAIT;?>';
    $(document).ready(function () {
        //specials

        $('#own_table').on('click', '.edit-row', function () {
            var $row = $(this).parents('tr');
            $row.addClass('active').find('.change').addClass('active').children('input').prop('disabled', false);

        });
        $('#own_table').on('click', 'a.go_to', function (e) {
            e.preventDefault();
            var href=$(this).attr('href');
            var id=$(this).closest('tr').data('id');
            window.location.href = href +'p-'+ id+'.html';
        });

        $('#category').on('click', function (e) {
            e.preventDefault();
            $.get('includes/ajax/categories.ajax.php?mode=pbe', function (data) {
                modal({
                    width: '90%',
                    title: '<?php echo TEXT_INFO_CATEGORY;?>',
                    body: data,
                    after: function (modal) {
                        $(modal).on('click', '#categories li>a', function (e) {
                            e.preventDefault();
                            var val = $(this).attr('href');
                            $(modal).modal('hide');
                            $('#category option[value="' + val + '"]').prop('selected', true);
                            option.categoryId = val;
                            option.page = 1;
                            $('#own_pagination').pagination('selectPage', option.page);
                        })
                    }
                });
            });
        })

        $('#own_table').on('click', '.action_ER .fa-check-circle', function () {
            var $row = $(this).parents('tr');
            var inputs = $row.find('.change input');
            var data = {products_id: $row.data('id')};
            inputs.each(function (i, e) {
                data[$(e).attr('name')] = $(e).val();
            });
            $.ajax({
                type: 'POST',
                url: window.location.pathname,
                dataType: 'json',
                data: data,
                success: function (response) {
                    if (response.success == true) {
                        $row.removeClass('active').find('.change').removeClass('active').children('input').prop('disabled', true);
                    }
                    show_tooltip(response.msg, 500);
                }
            });
        });

        $('#own_table').on('click', '.action_ER .fa-times', function () {
            var $row = $(this).parents('tr');
            var inputs = $row.find('.change input');
            $row.removeClass('active').find('.change').removeClass('active').children('input').prop('disabled', true);
            inputs.each(function (i, e) {
                $(e).val("'" + $(e).data('old') + "'");
            });
        });

        $('#own_table').on('input', 'input[name="specials_new_products_percent"]', function () {
            var $row = $(this).parents('tr');
            var prodPrice = $row.find('td[data-name="products_price"]').text();
            var $val = $(this).val();
            var result = prodPrice - (prodPrice * $val / 100);
            $row.find('input[name="specials_new_products_price"]').val(result.toFixed(2));
        });
        $('#own_table').on('input', 'input[name="specials_new_products_price"]', function () {
            var $row = $(this).parents('tr');
            var prodPrice = $row.find('td[data-name="products_price"]').text();
            var $val = $(this).val();
            var result = 100 - ($val * 100 / prodPrice);
            $row.find('input[name="specials_new_products_percent"]').val(result.toFixed(4));
        });
        $('body').on('focus', '.date-picker', function () {
            $(this).datepicker({
                dateFormat: "yy-mm-dd"
            });
        });
    });
</script>