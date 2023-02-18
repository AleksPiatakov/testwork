<?php

function checkAndGenerateCriticalCss()
{
    //check if exist criticalcss module and USE_CRITICAL_CSS == true && MINIFY_CSSJS = use minified
    if (is_file(DIR_FS_CATALOG . 'ext/criticalcss/index.php') && defined('USE_CRITICAL_CSS') && MINIFY_CSSJS != '0') {
        require_once DIR_FS_CATALOG . 'ext/criticalcss/index.php';
        require_once DIR_FS_CATALOG . 'includes/classes/Assets/AppAsset.php';
        $query    = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'DEFAULT_TEMPLATE'");
        $template = tep_db_fetch_array($query);
        $template = $template['configuration_value'];

        //get categogy seo url
        $query = tep_db_query("select c.categories_id from " . TABLE_CATEGORIES . " c
            left join " . TABLE_PRODUCTS_TO_CATEGORIES . " pc on pc.categories_id = c.categories_id
            left join  " . TABLE_PRODUCTS_ATTRIBUTES . " pa on pa.products_id = pc.products_id
            where c.categories_status = 1 limit 1");
        if (tep_db_num_rows($query) == 0) {
            $query = tep_db_query("select categories_id from " . TABLE_CATEGORIES . " where categories_status = 1 limit 1");
        }
        $catId           = tep_db_fetch_array($query);
        //get product url with images gallery
        $query     = tep_db_query("select products_id from " . TABLE_PRODUCTS . " where products_status = 1 and products_quantity > 0 and products_image LIKE '%;%' limit 1");
        if (tep_db_num_rows($query) == 0) {
            $query = tep_db_query("select products_id from " . TABLE_PRODUCTS . " where products_status = 1 and products_quantity > 0 and products_image != '' limit 1");
        }
        $productId = tep_db_fetch_array($query);
        //get article url
        //$query        = tep_db_query("select a.articles_id, ad.articles_url from " . TABLE_ARTICLES . " a LEFT JOIN " . TABLE_ARTICLES_DESCRIPTION . " ad on ad.articles_id = a.articles_id where a.articles_status = 1 and articles_code ='' limit 1");
        //$articlesData = tep_db_fetch_array($query);

        $protocol   = $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://';
        $assets     = new AppAsset();
        //$categoryIdPrefix = getConstantValue(SEO_ADD_SLASH_BEFORE_CATEGORY_ID, 'true') == 'true' ? '/c-' : '-c-';
        $pagesArray = [
            ['url' => $protocol . $_SERVER['HTTP_HOST'] . '?isCriticalMode=', 'file' => $assets::CSS_FILE_HOMEPAGE],
            ['url' => tep_href_link(FILENAME_DEFAULT, 'cPath='.$catId['categories_id']).'?isCriticalMode=', 'file' => $assets::CSS_FILE_PRODUCT_LIST],
            //TODO disabled temporary need solution for compare, wishlist and contact us pages
            //['url' => $protocol . $_SERVER['HTTP_HOST'] . '/' . $articlesData['articles_url'] . '/a-' . $articlesData['articles_id'] . '.html?isCriticalMode=', 'file' => $assets::CSS_FILE_OTHER],
        ];
        $productIdPrefix = getConstantValue('SEO_ADD_SLASH_BEFORE_PRODUCT_ID', 'true') == 'true' ? 'p-' : '-p-';
        if (isset($productId['products_id']) && !empty($productId['products_id'])) {
            $pagesArray[] = ['url' => $protocol . $_SERVER['HTTP_HOST'] . '/' . $productIdPrefix . $productId['products_id'] . '.html?isCriticalMode=', 'file' => $assets::CSS_FILE_PRODUCT_DETAIL];
        }
        resetMinifiedFiles();
        removeOldCriticalCssFiles($template, [$assets::CSS_FILE_HOMEPAGE, $assets::CSS_FILE_PRODUCT_LIST, $assets::CSS_FILE_OTHER, $assets::CSS_FILE_PRODUCT_DETAIL]);
        foreach ($pagesArray as $one) {
            openPageByCurlForRegenerateMinifiedCssFiles($one['url']);
            if (USE_CRITICAL_CSS == 'true') {
                generateCriticalCSS($template, $one['file'], $one['url']);
            }
        }
    }
}

function openPageByCurlForRegenerateMinifiedCssFiles($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_exec($ch);
    curl_close($ch);
}

function getParentId(&$categoriesArray)
{
    $currentCategoryId = $categoriesArray[count($categoriesArray) - 1];
    $currentCategoryQuery = tep_db_query("select parent_id from " . TABLE_CATEGORIES . " where categories_id = " . (int)$currentCategoryId);
    $currentCategory = tep_db_fetch_array($currentCategoryQuery);
    if ($currentCategory['parent_id'] != 0) {
        $categoriesArray[] = $currentCategory['parent_id'];
        getParentId($categoriesArray);
    }
}

function removeOldCriticalCssFiles($templateFolder, $fileNames)
{
    if (is_array($fileNames)) {
        foreach ($fileNames as $item) {
            if (file_exists(DIR_FS_CATALOG . 'templates/' . $templateFolder . '/css/critical.' . $item)) {
                unlink(DIR_FS_CATALOG . 'templates/' . $templateFolder . '/css/critical.' . $item);
            }
            if (file_exists(DIR_FS_CATALOG . 'templates/' . $templateFolder . '/css/critical.mobile.' . $item)) {
                unlink(DIR_FS_CATALOG . 'templates/' . $templateFolder . '/css/critical.mobile.' . $item);
            }
        }
    }
}
