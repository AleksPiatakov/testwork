<?php
//debug($data);
//debug($action);

?>

<?php $action_form=(!empty($data['data'])) ? "update_$action" : "insert_$action"; ?>

<form class="form-horizontal <?php echo $action?>" action="<?php echo ($_SERVER['SCRIPT_URL']?:$_SERVER['SCRIPT_NAME']) . '?action=' . $action_form;?>" method="post" enctype="multipart/form-data">
    <?php if (!empty($data['id'])): ?>
        <input type="hidden" name="id" value="<?php echo $data['id']?>">
    <?php endif; ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="wrapper_xsell_products">
                <table class="table table-striped <?php echo  $action; ?>">
                    <thead>
                    <tr>
                        <?php foreach ($data['allowed_fields'] as $field => $v): ?>
                            <?php if(!empty($v['form_header'])):?>
                                <th><?php echo  $v['label'] ?: $field; ?></th>
                            <?php endif;?>
                        <?php endforeach; ?>
                        <th style="width: 7%"></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            require ('form_xsell_product.php');
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h3><?php echo  XSELL_NEW_XSELL ?></h3>
            <div class="wrapper_xsell_new_products">
                <input type="text" value="" name="search_product_on_id" placeholder="<?=XSELL_NEW_INPUT_PLACEHOLDER;?>" class="form-control" id="search_product_on_id">
                <input type="hidden" value="" name="search_product_id" id="search_product_id">
            </div>
        </div>
    </div>
    <div class="form-group text-right">
        <div class="col-sm-12">
            <!--<input type="submit" value="OK" class="btn">-->
            <button type="button" class="btn" data-dismiss="modal">OK</button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo TEXT_MODAL_CANCEL_ACTION?></button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function () {
        $('.form-horizontal').on('click', '.input_wrapper', function () {
            $('.input_wrapper input').addClass('disabled').removeClass('active');
            var $input = $(this).find('input');
            $input.removeClass('disabled').addClass('active').select();
        });

        $('.form-horizontal').on('change', '.input_wrapper input, input[name="cross_prod"]', function () {
            var $this = $(this);
            var $val = $this.val();
            var name = $this.attr('name');
            var status;
            if(name == 'cross_prod'){
                status = $(this).prop('checked');
                if (status == true) {
                    status = 1;
                } else {
                    status = 0;
                }
            }
            var xsell_product_id = $(this).closest('form').find('input[name="id"]').val();
            var xsell_id = $this.closest('[data-xsell-product-id]').attr('data-xsell-product-id');
            var xsell_xsell_id = $this.closest('[data-xsell-id]').attr('data-xsell-id');
            $.post(window.location.pathname, {action: "updateXsellProduct", id: xsell_id, product_id: xsell_product_id, xsell_id: xsell_xsell_id, name: name, val: $val, status: status}, function (response) {
                if(response['success'] == true){
                    //$('#order_general').html(response['html']);
                }
            }, "json");
            $this.addClass('disabled').removeClass('active');
        });

        $('.form-horizontal').on('click', '.fa-trash-o', function () {
            var $this = $(this);
            var xsell_id = $this.closest('[data-xsell-product-id]').attr('data-xsell-product-id');
            $.post(window.location.pathname, {action: "delete", id: xsell_id}, function (response) {
                if(response['success'] == true){
                    $this.closest('tr[data-xsell-product-id]').remove();
                }
            }, "json");
        });

        $('.form-horizontal').on('focus', '#search_product_on_id', function () {
            $("#search_product_on_id").autocomplete({
                source: function( request, response ) {
                    var xsell_product_id = $('form.form-horizontal').find('input[name="id"]').val();
                    console.log(xsell_product_id);
                    $.ajax( {
                        url: window.location.pathname,
                        dataType: "json",
                        data: {
                            id: xsell_product_id,
                            product_id: request.term
                        },
                        success: function( data ) {
                            response( data );
                        }
                    } );
                },
                delay: 100,
                minLength: 2,
                select: function (event, ui) {
                    var xsell_product_id = $(this).closest('form').find('input[name="id"]').val();
                    $('#search_product_id').val(ui.item.products_id);
                    $('#search_product_on_id').val(ui.item.products_name);
                    console.log(ui.item);
                    $.post(window.location.pathname, {action: "insert", xsell_id: ui.item.products_id, product_id: xsell_product_id}, function (response) {
                        if(response['success'] == true){
                            $('.form-horizontal tbody').html(response['html']);
                        }
                    }, "json").done(function () {
                        $('.tooltip_own').remove();
                    });
                    return false;
                }
            }).autocomplete("instance")._renderItem = function (ul, item) {
                ul.css('z-index', 9999);
                return $("<li>")
                    .append("<div>(" + item.products_id + ") " + item.products_model +" "+ item.products_name +"</div>")
                    .appendTo(ul);
            };
        });
    })
</script>