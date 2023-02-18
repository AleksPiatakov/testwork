<?php

if (!is_object($lng)) {
    include(DIR_WS_CLASSES . 'language.php');
    $lng = new language();
}

if (count($lng->catalog_languages) > 1) {
    $language_dropdown = '<div class="language_select">';
    reset($lng->catalog_languages);

  // выводим всегда текущий язык:
    foreach ($lng->catalog_languages as $key => $value) {
   // while (list($key, $value) = each($lng->catalog_languages)) {

        if ($display_lng == 'image') {
            $dlng = '<img class="lazyload" src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="' . DIR_WS_LANGUAGES . $value['directory'] . '/images/' . $value['image'] . '">';
        } elseif ($display_lng == 'code') {
            $dlng = $value['code'];
        } else {
            $dlng = $value['name'];
        }

        if ($language == $value['directory']) {
            $language_dropdown .= '<button type="button" class="language-dropdown-button" data-toggle="dropdown">
                                    ' . $dlng . ' <span class="caret"></span>
                                 </button>';
        }
    }


    $language_dropdown .= '<ul class="dropdown-menu dropdown-menu-language" role="menu">';
    reset($lng->catalog_languages);

  // show all parameters except cPath:
    $parameters = tep_get_all_get_params(['language', 'currency', 'row_by_page', 'cPath', 'products_id']);
    $new_parameters = explode('&', $parameters);
    $parameters = implode('&', array_filter($new_parameters));
    if (!empty($parameters)) {
        $parameters = '?' . $parameters;
    }

    if (strstr($PHP_SELF, "/product_info.php")) { // product page:
        $productAlternatesQuery = tep_db_query("SELECT pd.products_url, l.code
                                              FROM products_description pd 
                                         INNER JOIN languages l ON pd.language_id = l.languages_id and l.lang_status = '1'
                                         WHERE pd.products_id = '" . (int)$_GET['products_id'] . "'
                                         ORDER BY l.sort_order");

        $alternate = '';

        while ($productAlternates = tep_db_fetch_array($productAlternatesQuery)) {
            if ($productAlternates['code'] == DEFAULT_LANGUAGE) {
                $languageCode = '';
            } else {
                $languageCode = $productAlternates['code'] . '/';
            }
            $productIdPrefix = getConstantValue('SEO_ADD_SLASH_BEFORE_PRODUCT_ID', 'true') == 'true' ? '/p-' : '-p-';
            if ($promUrls) {
                $product_href = $languageCode . 'p' . $_GET['products_id'] . '-' . $productAlternates['products_url'];
            } else {
                $product_href = $languageCode . $productAlternates['products_url'] . $productIdPrefix . $_GET['products_id'];
            }
            $language_dropdown .= '<li><a hreflang="' . $value['code'] . '" href="' . addHostnameToLink($product_href . '.html' . $parameters) . '">' . $lng->catalog_languages[$productAlternates['code']]['name'] . '</a></li>';
        }
    } else {
        foreach ($lng->catalog_languages as $key => $value) {
            if ($value['code'] == DEFAULT_LANGUAGE) {
                $languageCode = '';
            } else {
                $languageCode = $value['code'] . '/';
            }

            if ($display_lng == 'image') {
                $dlng = '<img class="lazyload" src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="' . DIR_WS_LANGUAGES . $value['directory'] . '/images/' . $value['image'] . '">';
            } elseif ($display_lng == 'code') {
                $dlng = $value['code'];
            } else {
                $dlng = $value['name'];
            }
             $filename = $PHP_SELF;
            if (strstr($PHP_SELF, "/price.php")) {
                $filename = "/sitemap.html";
            } else if (strstr($PHP_SELF, "/allcomments.php")) {
                $filename = "/allcomments.html";
            } elseif (strstr($PHP_SELF, "/manufacturers.php")) {
                $filename = "/brands";
            }
            if ($language != $value['directory']) {
                if ($isFilter) {
                    unset($tempSeoFilterInfo);
                    $url = getFilterUrl($_GET['cPath'], (isset($_GET['filter_id']) ? $_GET['filter_id'] : ''), $redirectOptionsIdsArrayForCheck, $value['code'], $value['id']);
                } else {
                    if (strstr($PHP_SELF, FILENAME_DEFAULT) and !empty($_GET['cPath'])) { // categories page:
                           $url = addHostnameToLink($languageCode . $cat_urls[$value['id']][$current_category_id]) . $parameters;
                    } else {
                        $url = tep_href_link($value['code'] . '/' . basename($filename), tep_get_all_get_params([
                          'language',
                          'currency'
                        ]));
                    }
                }
                $language_dropdown .= '<li><a hreflang="' . $value['code'] . '" href="' . $url . '">' . $dlng . '</a></li>';
            }
        }
    }

    $language_dropdown .= '</ul>
                       </div>';

    echo $language_dropdown;
}
