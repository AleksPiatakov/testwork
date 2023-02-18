<h1><?php echo QUICK_ORDER; ?></h1>
<form action="ajax.php" id="QuickBuyForm">
    <?= csrf() ?>
    <div class="text-center row">
        <div class="form-group col-sm-6 center-block">
            <input type="hidden" placeholder="" name="request" value="QuickBuyProccess">
            <input type="text" required class="form-control" placeholder="<?php echo ENTRY_TELEPHONE_NUMBER; ?>"
                   name="phone">
        </div>
    </div>
    <div class="form-group clearfix">
        <div class="text-center">
            <input class="btn btn-default" type="submit" value="<?php echo SEND_MESSAGE; ?>">
        </div>
    </div>
</form>
