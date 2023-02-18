<h1><?php echo QUICK_ORDER; ?></h1>
<form action="ajax.php" id="QuickBuyForm">
    <?= csrf() ?>
    <div class="text-center row">
        <div class="col-md-12 request-modal-body">
            <div class="numder-input">
                <input type="hidden" placeholder="" name="request" value="QuickBuyProccess">
                <input type="text" required class="form-control" autocomplete="off"
                       placeholder="<?php echo ENTRY_TELEPHONE_NUMBER; ?>" name="phone">
            </div>
            <div class="request-button">
                <button class="btn btn-primary" type="submit"><?php echo SEND_MESSAGE; ?></button>
            </div>
        </div>
    </div>
</form>
