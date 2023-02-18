<div class="checkout">
    <?php
    // Если юзер НЕ авторизированый
    if (!isset($_SESSION['customer_id'])) { ?>
        <div>
            <div class="checkout_title">
                <a class="checkout_new-user"><?php echo getConstantValue("TEXT_NEW_CUSTOMER", ""); ?></a>
                <a class="checkout_authorization" href="#"><?php echo getConstantValue("IMAGE_BUTTON_LOGIN", ""); ?></a>
            </div>
            <?php include(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/checkout/checkout_form.php'); ?>
        </div>
        <?php
    } else { // Если юзер АВТОРИЗИРОВАНЫЙ
        include(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/checkout/checkout_form.php');
    }
    ?>
</div>
