<?php
/*
  $Id: articles_xsell.php, v1.0 2003/12/04 12:00:00 ra Exp $

osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

Copyright (c) 2003 osCommerce

Released under the GNU General Public License
*/

if ($_GET['articles_id']) {
    $xsell_query = tep_db_query("select distinct a.products_id, ad.products_url, a.products_quantity, a.products_image, ad.products_name, a.lable_3, a.lable_2, a.lable_1, a.products_id, a.products_tax_class_id, a.products_price as products_price from " . TABLE_ARTICLES_XSELL . " ax, " . TABLE_PRODUCTS . " a, " . TABLE_PRODUCTS_DESCRIPTION . " ad where ax.articles_id = '" . $_GET['articles_id'] . "' and ax.xsell_id = a.products_id and a.products_id = ad.products_id and ad.language_id = '" . $languages_id . "' and a.products_status = '1' order by ax.sort_order asc limit 6");
    $num_products_xsell = tep_db_num_rows($xsell_query);
    if ($num_products_xsell >= 1) {
        $tpl_settings = array(
            'request' => $xsell_query,
            'id' => 'xsell_articles',
            'classes' => array(),
            'title' => ART_XSELL_TITLE,
        );
        include(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING_COL);
    }
}
