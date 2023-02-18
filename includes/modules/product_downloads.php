<?php
global $product_downloads, $allow_download, $product_info;

$output = '';
$output .= '<div class="files">';

//в кабинете клиента только электронные товары
if (isset($allow_download) && $allow_download == true && is_array($product_downloads)) { //если товар оплачен
    foreach ($product_downloads as $file) {
        $output .= '<div class="file">';
        $output .= '<a class="download_file" target="_blank" href="' . $file['products_file_link'] . '"><span>' . $file['products_file'] . '</span> <small>(' . $file['products_file_size'] . ')</small></a>';
        $output .= '</div>';
    }
} elseif (is_array($product_downloads)) { //если это таб в карточке товара
    if ($product_info['is_download_product']) {
        $output .= '<p>' . TEXT_DOWNLOADS_UNAVAILABLE . '</p>';
    }

    foreach ($product_downloads as $file) {
        $output .= '<div class="file">';

        if ($product_info['is_download_product']) { //товар продается, ссылка только после оплаты
            $output .= '<span>' . $file['products_file'] . '</span> <small>(' . $file['products_file_size'] . ')</small>';
        } else { //товар не продается, качать может кто угодно
            $output .= '<a class="download_file" target="_blank" href="' . $file['products_file_link'] . '"><span>' . $file['products_file'] . '</span> <small>(' . $file['products_file_size'] . ')</small></a>';
        }
        $output .= '</div>';

    }
}
$output .= '</div>';

echo $output;
