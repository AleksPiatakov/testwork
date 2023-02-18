<?php echo tep_draw_form('order', tep_href_link(FILENAME_CHECKOUT_SUCCESS, 'action=update', 'SSL')); ?>
<div class="size1of2" style="margin: 0 auto;text-align: center;">

    <h1><?php echo TEXT_THANKS_FOR_SHOPPING; ?></h1>
    <p class="checkout-success-text"><?php echo TEXT_SUCCESS_INFO; ?></p>
    <?php if ($_SESSION['payment_method']) {
        unset($_SESSION['payment_method']); ?>
        <p><?php echo MODULE_PAYMENT_BANK_CART_TEXT_TITLE . ': ' . MODULE_PAYMENT_BANK_CART_TRANSFER_2 ?></p>
    <?php } ?>
    <?php require('add_checkout_success.php'); //ICW CREDIT CLASS/GV SYSTEM ?>
    <div>
        <input class="btn bold" type="submit" value="<?php echo IMAGE_BUTTON_CONTINUE; ?>">
        <input id="successPageProductsIds" type="hidden"
               value="['<?php echo implode("','", $productsIdsForAnalyticsArray); ?>']">
        <input id="successPageProductsPrices" type="hidden"
               value="['<?php echo implode("','", $productsPriceForAnalyticsArray); ?>']">
    </div>
</div>

</form>
