<?php
$subscribeConfig = $template->checkConfig('MAINPAGE', 'M_SUBSCRIBE');
$coupon_id = $subscribeConfig['coupone']['val'];
$sendSubscriptionCoupon = $subscribeConfig['coupone_mail']['val'];
$couponDiscount = cutToFirstSignificantDigit(getCoupon($coupon_id)['coupon_amount']) . '%';
?>

<?php if ($template->show('M_SUBSCRIBE')) { ?>
    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-xs-12">
        <div class="subscribe_news">
            <div class="row">
                <div class="col-lg-4 col-sm-4 col-xs-12">
                    <p><?php echo ($subscribeConfig['subscribe_specials']['val']) ? sprintf(HOME_MAIN_NEWS_SUBSCRIBE_FOR_DISCOUNT, $couponDiscount) : HOME_MAIN_NEWS_SUBSCRIBE; ?></p>
                </div>
                <div class="col-lg-8 col-sm-8 col-xs-12">
                    <form class="form_subscribe_news" action="subscripbe.php" method="POST">
                        <input type="hidden" name="podpiska" value="yes">
                        <input type="hidden" name="couponDiscount" value="<?php echo ($subscribeConfig['subscribe_specials']['val']) ? $couponDiscount : ''; ?>">
                        <input type="hidden" name="coupon_id" value="<?php echo $coupon_id; ?>">
                        <input type="hidden" name="sendSubscriptionCoupon" value="<?php echo $sendSubscriptionCoupon; ?>">
                        <input type="email" class="form-control form_subscribe_input" required autocomplete="off"
                               placeholder="<?php echo HOME_MAIN_NEWS_EMAIL; ?>" name="email_address">
                        <button type="submit" class="btn btn-default"><?php echo MAIN_NEWS_SUBSCRIBE_BUT; ?></button>
                    </form>
                </div>
            </div>
        </div><!-- END NEWS SUBMIT FORM -->
    </div>
<?php } ?>

