<?php

echo '<div id="checkout_payment" class="shipping_payment_block collapse ' . ($openTab == 'true' ? 'in' : '') . '">';

setPaymentMethod();

for ($i = 0, $n = sizeof($selection); $i < $n; $i++) {
    ?>
    <div class="row moduleRow paymentRow<?php echo($selection[$i]['id'] == $paymentMethod ? ' moduleRowSelected' : ''); ?>">
        <div class="col-xs-12">
            <div class="form-group">
                <?php
                if (sizeof($selection) > 1) {
                    echo tep_draw_radio_field(
                        'payment',
                        $selection[$i]['id'],
                        ($selection[$i]['id'] == $paymentMethod ? true : ($i == '0' ? true : false)),
                        'id="radio_' . $selection[$i]['id'] . '"'
                    );
                } else {
                    echo tep_draw_radio_field(
                        'payment',
                        $selection[$i]['id'],
                        true,
                        'id="radio_' . $selection[$i]['id'] . '"'
                    );
                }
                ?>
                <label for="radio_<?php echo $selection[$i]['id']; ?>"><?php echo $selection[$i]['module']; ?></label>
            </div>
        </div>
    </div>

    <?php
    if (isset($selection[$i]['error'])) {
        ?>
        <div class="row">
            <div class="col-xs-12"><?php echo $selection[$i]['error']; ?></div>
        </div>
        <?php
    } elseif (
        isset($selection[$i]['fields']) && is_array(
            $selection[$i]['fields']
        ) && ($selection[$i]['id'] == $paymentMethod)
    ) {
        echo '<div class="paymentFields">';
        if ($selection[$i]['id'] == 'cc' ||  $selection[$i]['id'] == 'bank_cart') {
            echo '<div class="credit_card_info">';
        }
        for ($j = 0, $n2 = sizeof($selection[$i]['fields']); $j < $n2; $j++) {
            ?>
            <div class="row item">
                <div class="col-xs-12"><?php echo $selection[$i]['fields'][$j]['title']; ?></div>
                <div class="col-xs-12"><?php echo $selection[$i]['fields'][$j]['field']; ?></div>
            </div>
            <?php
        }
        if ($selection[$i]['id'] == 'cc' || $selection[$i]['id'] == 'bank_cart') {
            echo '</div>';
        }
        echo '</div>';
    }
}

if ($paymentMethod == 'bank_cart') {
    $_SESSION['payment_method'] = 'bank_cart';
} else {
    $_SESSION['payment_method'] = '';
} ?>

<span class="proceed_btn collapsed" data-toggle="collapse" data-target="#checkout_payment" aria-expanded="false"
      aria-controls="checkout_payment"><?= NEW_CHECKOUT_PROCEED_BTN; ?></span>
</div>
<div class="collapse_wrapper_info short_info" style="display: none"  data-parent="#checkout_payment">
    <span data-selector="input[name='payment']:checked"></span>
</div>