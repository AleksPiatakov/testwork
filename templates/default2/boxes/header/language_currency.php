<?php $language_currency = 'any';

if (LANGUAGE_SELECTOR_MODULE_ENABLED == 'true') {
    $display_lng = '';
    include('ext/multilanguage/language_box.php');
}

//debug($languages_list);

$language_currency = '';

?>

<div class="dropdown dropdown-language-currency">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        <span class="language-title">Ukrainian</span> <span class="currency-title">UAH</span>
    </button>
    <div class="dropdown-menu">
        <div class="dropdown-menu-content dropdown-menu-language">
            <?php
            if (!empty($languages_list)) {
                foreach ($languages_list as $key => $value) {
                    if ($display_lng == 'image') {
                        $dlng = '<img class="lazyload" src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="' . DIR_WS_LANGUAGES . $value['directory'] . '/images/' . $value['image'] . '">';
                    } elseif ($display_lng == 'code') {
                        $dlng = $value['code'];
                    } else {
                        $dlng = $value['name'];
                    }

                    if ($language != $value['directory']) {
                        // $language_item .= '<li><a hreflang="'.$value['code'].'" href="' . tep_href_link($value['code'].'/'.basename($PHP_SELF), tep_get_all_get_params(array('language', 'currency'))) . '" class="dropdown-item">' . $dlng . '</a></li>';
                        $language_item .= '<a hreflang="' . $value['code'] . '" href="' . tep_href_link(
                            $value['code'] . '/' . basename($PHP_SELF),
                            tep_get_all_get_params(array(
                                    'language',
                                    'currency'
                            ))
                        ) . '" class="dropdown-item">' . $dlng . '</a>';
                    }
                }
                echo $language_item;
            }
            ?>
        </div>
        <div class="dropdown-menu-content dropdown-menu-currency">
            <ul>
                <a class="dropdown-item" data-value="uah" href="#">UAH</a>
                <a class="dropdown-item" data-value="usd" href="#">USD</a>
                <a class="dropdown-item" data-value="rub" href="#">RUB</a>
            </ul>
        </div>
        <button type="button">Apply</button>
    </div>
</div>

