<?php
$currentUrls = [];
//format $currentUrls
$currentUrls[] = tep_db_prepare_input(urldecode(substr($_SERVER['REQUEST_URI'], 1, strlen($_SERVER['REQUEST_URI']) - 1)));

//set local $lng if not exist
$needNewLanguageFlag = empty($lng);
if ($needNewLanguageFlag) {
    require_once DIR_WS_CLASSES . 'language.php';
    $redirectLanguage = new language();
    $languagesShortCodes = array_keys($redirectLanguage->languages);
} else {
    $languagesShortCodes = array_keys($lng->languages);
}

//remove language code from url string
$currentUrlsBuffer = $currentUrls;
foreach ($languagesShortCodes as $languageShortCode) {
    foreach ($currentUrlsBuffer as $currentUrl) {
        if (strpos($currentUrl, $languageShortCode . '/') === 0) {
            $currentUrls[] = str_replace($languageShortCode . '/', '', $currentUrl);
            $sourceLanguageShortCode = $languageShortCode;
            break;
        }
    }
}

//add both link variants with and without "/" at start
$currentUrlsBuffer = $currentUrls;
foreach ($currentUrlsBuffer as $currentUrl) {
    $currentUrls[] = strpos($currentUrl, '/') !== 0 ? '/' . $currentUrl : substr($currentUrl, 1);
}

//if string contains broken chars (�) or chars in Windows-1251
foreach ($currentUrls as $index => $currentUrl) {
    if (!mb_check_encoding($currentUrl, 'UTF-8')) {
        //convert to UTF-8
        $currentUrls[$index] = mb_convert_encoding($currentUrl, 'UTF-8', 'Windows-1251');
    }
}

//format and add $alternativeUrls by cyrillic translit
require_once(DIR_WS_CLASSES . 'seo.class.php');
$seo_urls = new SEO_URL($languages_id);
$currentUrlsBuffer = $currentUrls;
foreach ($currentUrlsBuffer as $currentUrl) {
    $currentUrls[] = strtr($currentUrl, $seo_urls->attributes['SEO_CHAR_CONVERT_SET']);
}
//END format $currentUrls

//check if exist redirect from $currentUrl
if (is_array($currentUrls) && !empty($currentUrls)) {
    $redirectQuery = tep_db_query("
        SELECT r.redirect_to, r.action 
        FROM redirects r
        WHERE r.status = 1 and r.redirect_from in ('" . implode("', '", $currentUrls) . "')
    ");
    if ($redirectQuery->num_rows) {
        $redirect = tep_db_fetch_array($redirectQuery);
        switch ($redirect['action']) {
            //301 redirect
            case 1:
                $redirectToUrl = $redirect['redirect_to'];

                //add first "/" if not exist
                $redirectToUrl = strpos($redirectToUrl, '/') !== 0 ? '/' . $redirectToUrl : $redirectToUrl;

                //check is existing language code in target link
                $isLanguageCode = false;
                foreach ($languagesShortCodes as $languageShortCode) {
                    if (strpos($redirectToUrl, '/' . $languageShortCode . '/') === 0) {
                        $isLanguageCode = true;
                        break;
                    }
                }

                //build target link
                $redirectToUrl = $isLanguageCode ? $redirectToUrl : '/' . $sourceLanguageShortCode . $redirectToUrl;

                //redirect
                header($_SERVER["SERVER_PROTOCOL"] . " 301 Moved Permanently");
                header("Location: " . $redirectToUrl);
                exit;
                break;
            //page not found
            case 2:
                header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
                exit;
                break;
            //noindex
            case 3:
                $robotsNoindex = true;
                break;
        }
    }
}
