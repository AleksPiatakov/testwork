<?php

if (is_array($wishList->wishID) && !empty($wishList->wishID)) {
    $wishlist_show = 'style="display:block;"';
} else {
    $wishlist_show = 'style="display:none;"';
}

echo '<div id="wishlist_box2" ' . $wishlist_show . '>';

if (is_array($wishList->wishID) && !empty($wishList->wishID)) {
    echo '<div class="wishlist_box2" style="display:block;">';
    echo '<a href="' . tep_href_link('wishlist.php') . '">
                                    <div id="wishlist_bg">
                                        ' . BOX_HEADING_WISHLIST . ': <b>' . count(
        $wishList->wishID
    ) . ' ' . WISHLIST_PC . '</b>
                                    </div>
                                  </a>';
    echo '</div>';
}

echo '</div>';
