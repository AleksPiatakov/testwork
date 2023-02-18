<?php
$subscribeConfig = $template->checkConfig('FOOTER', 'M_SUBSCRIBE');
$coupon_id = $subscribeConfig['coupone']['val'];
$sendSubscriptionCoupon = $subscribeConfig['coupone_mail']['val'];
$couponDiscount = cutToFirstSignificantDigit(getCoupon($coupon_id)['coupon_amount']) . '%';
?>

<?php if ($template->show('M_SUBSCRIBE')) { ?>
    <div class="subscribe_news">
        <div class="h3"><?php echo ($subscribeConfig['subscribe_specials']['val']) ? sprintf(HOME_MAIN_NEWS_SUBSCRIBE_FOR_DISCOUNT, $couponDiscount) : MAIN_NEWS_SUBSCRIBE; ?></div>
        <a href="#" class="toggle-xs" data-target="#footer_subscribe"></a>
        <form class="form_subscribe_news list_footer" action="subscripbe.php" method="POST" id="footer_subscribe">
            <input type="hidden" name="podpiska" value="yes">
            <input type="hidden" name="couponDiscount" value="<?php echo ($subscribeConfig['subscribe_specials']['val']) ? $couponDiscount : ''; ?>">
            <input type="hidden" name="coupon_id" value="<?php echo $coupon_id; ?>">
            <input type="hidden" name="sendSubscriptionCoupon" value="<?php echo $sendSubscriptionCoupon; ?>">
            <input type="email" class="form-control form_subscribe_input" required autocomplete="off" placeholder="<?php echo MAIN_NEWS_EMAIL; ?>" name="email_address">
            <!--                                        <button type="submit" class="btn btn-default">--><?php //echo MAIN_NEWS_SUBSCRIBE_BUT; ?><!-- </button>-->
            <button type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M170.718 216.482L141.6 245.6l93.6 93.6 208-208-29.118-29.118L235.2 279.918l-64.482-63.436zM422.4 256c0 91.518-74.883 166.4-166.4 166.4S89.6 347.518 89.6 256 164.482 89.6 256 89.6c15.6 0 31.2 2.082 45.764 6.241L334 63.6C310.082 53.2 284.082 48 256 48 141.6 48 48 141.6 48 256s93.6 208 208 208 208-93.6 208-208h-41.6z"></path>
                </svg>
                <?php echo MAIN_NEWS_SUBSCRIBE_BUT; ?>
            </button>
        </form>
    </div>
<?php } ?>