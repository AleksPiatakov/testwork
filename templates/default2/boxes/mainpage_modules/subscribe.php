<?php
$subscribeConfig = $template->checkConfig('MAINPAGE', 'M_SUBSCRIBE');
$coupon_id = $subscribeConfig['coupone']['val'];
$sendSubscriptionCoupon = $subscribeConfig['coupone_mail']['val'];
$couponDiscount = cutToFirstSignificantDigit(getCoupon($coupon_id)['coupon_amount']) . '%';
?>

<?php if ($template->show('M_SUBSCRIBE')) { ?>
<div class="subscribe_news">
    <form class="form_subscribe_news" action="subscripbe.php" method="POST">
        <input type="hidden" name="podpiska" value="yes">
        <input type="hidden" name="couponDiscount" value="<?php echo ($subscribeConfig['subscribe_specials']['val']) ? $couponDiscount : ''; ?>">
        <input type="hidden" name="coupon_id" value="<?php echo $coupon_id; ?>">
        <input type="hidden" name="sendSubscriptionCoupon" value="<?php echo $sendSubscriptionCoupon; ?>">
        <input type="email" class="form_subscribe_input" required autocomplete="off"
               placeholder="<?php echo MAIN_NEWS_EMAIL; ?>" name="email_address">
        <button type="submit" class="btn btn_main"><?php echo MAIN_NEWS_SUBSCRIBE_BUT; ?></button>
    </form>
</div>
<?php } ?>