<div class="checkout">
    <?php
    // Если юзер НЕ авторизированый
    if (!isset($_SESSION['customer_id'])) { ?>
        <div>
            <?php include(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/checkout/checkout_form.php'); ?>
        </div>
        <?php
    } else { // Если юзер АВТОРИЗИРОВАНЫЙ
        include(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/checkout/checkout_form.php');
    }
    ?>
</div>

