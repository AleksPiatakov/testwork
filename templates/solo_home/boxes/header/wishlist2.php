<?php

echo '<div id="wishlist_box2">';
echo '<a rel="nofollow" href="' . tep_href_link('wishlist.php') . '">
            <div id="wishlist_bg">';

if (is_array($wishList->wishID) && !empty($wishList->wishID)) {
    echo '<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="#d50000" d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path>
              </svg>';
} else {
    echo '<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="#fff" d="M462.3 62.7c-54.5-46.4-136-38.7-186.6 13.5L256 96.6l-19.7-20.3C195.5 34.1 113.2 8.7 49.7 62.7c-62.8 53.6-66.1 149.8-9.9 207.8l193.5 199.8c6.2 6.4 14.4 9.7 22.6 9.7 8.2 0 16.4-3.2 22.6-9.7L472 270.5c56.4-58 53.1-154.2-9.7-207.8zm-13.1 185.6L256.4 448.1 62.8 248.3c-38.4-39.6-46.4-115.1 7.7-161.2 54.8-46.8 119.2-12.9 142.8 11.5l42.7 44.1 42.7-44.1c23.2-24 88.2-58 142.8-11.5 54 46 46.1 121.5 7.7 161.2z"></path>
             </svg>';
}

echo '<span class="wishlist_text">' . HOME_BOX_HEADING_WISHLIST . '</span></div></a>';
echo '</div>';
