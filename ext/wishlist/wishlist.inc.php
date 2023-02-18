<?php

function getWishList($id)
{
    if (isset($_SESSION['wishList']->wishID[$id])) {
        $wish_checked = 'checked';
        $wish_text = IN_WHISHLIST;
    } else {
        $wish_checked = '';
        $wish_text = WHISH;
    }
    return array('text' => $wish_text,'checked' => $wish_checked);
}
