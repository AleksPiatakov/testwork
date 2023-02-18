<?php
if (getConstantValue('QUICK_ORDER_ENABLED','false') !== 'false' && $template->show('P_BUY_ONE_CLICK')) {
    if ($product_info['products_quantity'] <= 0) {
        if (STOCK_SHOW_BUY_BUTTON == "true") {
            echo '<button type="button" class="btn-success btn-lg buy_one_click">' . QUICK_ORDER_BUTTON . '</button>';
        }
    } else {
        echo '<button type="button" class="btn-success btn-lg buy_one_click">' . QUICK_ORDER_BUTTON . '</button>';
    }
}
