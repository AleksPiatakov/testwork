<?php
require_once(DIR_WS_LANGUAGES . $language . '/modules/novaposhta/novaposhta.php');
?>
<link rel="stylesheet" type="text/css" href="<?php echo 'includes/modules/novaposhta/novaposhta.css';?>">
<div class="container-fluid">
    <div class="wrapper-title">
        <h4 class="modal-title" id="assignment-cn-to-order-label"><?php echo HEADING_CN; ?></h4>
    </div>
    <div class="bg-light lter ng-scope">
        <div class="form-group clearfix">
            <input type="hidden" name="cn_order_id" value="<?= $_GET['order_id']; ?>" id="cn_order_id" />
            <input type="hidden" name="cn_shipping_method" value="novaposhta" id="cn_shipping_method" />
            <div class="col-sm-10">
                <input type="text" name="cn_number" value="" placeholder="<?php echo ENTRY_CN_NUMBER; ?>" id="cn_number" class="form-control" />
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="assignmentCN();"><i class="fa fa-check"></i></button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i></button>
    </div>
</div>
<script type="text/javascript">
    function assignmentCN() {

        if ($('#assignment-cn-to-order').is(':hidden')) {
            $('#assignment-cn-to-order').modal('show');
        } else {
            var post_data = 'order_id=' + $('#cn_order_id').val() + '&cn_number=' + $('#cn_number').val();

            $.ajax( {
                url: './includes/modules/novaposhta/novaposhta.php?request=addCNToOrder',
                type: 'POST',
                data: post_data,
                dataType: 'json',
                beforeSend: function () {
                    $('body').fadeTo('fast', 0.7).prepend('<div id="ajax-loader" style="position: fixed; top: 50%;	left: 50%; z-index: 9999;"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
                },
                complete: function () {
                    var $alerts = $('.alert-danger, .alert-success');

                    if ($alerts.length !== 0) {
                        setTimeout(function() { $alerts.fadeOut(); }, 5000);
                    }

                    $('body').fadeTo('fast', 1)
                    $('#ajax-loader').remove();
                },
                success: function(json) {
                    if(json['error']) {
                        $('.container-fluid').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                    }

                    if (json['success']) {
                        $('.container-fluid').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

                        setTimeout(function() { location.reload(); }, 2000);
                    }

                    $('html, body').animate({ scrollTop: 0 }, 'slow');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus);
                }
            } );

            $('#assignment-cn-to-order').modal('hide');
        }
    }
</script>
