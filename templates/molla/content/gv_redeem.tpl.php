<table border="0" width="100%" cellspacing="0" cellpadding="<?php echo getConstantValue('CELLPADDING_SUB', '0'); ?>">
    <tr>
        <td>
            <table border="0" width="100%" cellspacing="0" cellpadding="2">
                <tr>
                    <td class="main"><?php echo TEXT_INFORMATION; ?></td>
                </tr>
                <?php
                // if we get here then either the url gv_no was not set or it was invalid
                // so output a message.
                $message = sprintf(TEXT_VALID_GV, $currencies->format($coupon['coupon_amount']));
                if ($error) {
                    $message = TEXT_INVALID_GV;
                }
                ?>
                <tr>
                    <td class="main"><?php echo $message; ?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
