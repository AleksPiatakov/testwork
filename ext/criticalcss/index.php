<?php

/**
 *     INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`, `depends_on`, `configuration_subgroup_id`) VALUES ('Use critical css', 'USE_CRITICAL_CSS', 'true', 'Use critical css?', 1, 37, '2020-10-17 23:34:05', '2019-02-10 10:10:10', '', 'tep_cfg_select_option(array(\'true\', \'false\'),', '', 1);
 */
function generateCriticalCSS($templateFolder, $resource = 'homepage.min.css', $sitePageUrl = HTTP_SERVER)
{
    $cssFile = sprintf(DIR_FS_CATALOG . 'templates/' . '%s/css/' . $resource, $templateFolder);
    $saveTo = sprintf(DIR_FS_CATALOG . 'templates/' . '%s/css/critical.' . $resource, $templateFolder);
    $target_url = 'https://solomono.net/api/criticalcss/';
    //Open file handler.
    $fp = fopen($saveTo, 'w+');
    //desktop request
    //$sitePageUrl must have a get param ?isCriticalMode=
    if (file_exists($cssFile)) {
        $cFile      = curl_file_create($cssFile);
        $post       = ['hostname' => $sitePageUrl, 'css' => $cFile];
        $ch         = curl_init();
        curl_setopt($ch, CURLOPT_URL, $target_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
    }

    //mobile request
    $saveTo = sprintf(DIR_FS_CATALOG . 'templates/' . '%s/css/critical.mobile.' . $resource, $templateFolder);
    //Open file handler.
    $fp = fopen($saveTo, 'w+');
    //$sitePageUrl must have a get param ?isCriticalMode=isMobile
    if (file_exists($cssFile)) {
        $cFile      = curl_file_create($cssFile);
        $post       = ['hostname' => $sitePageUrl . 'isMobile', 'css' => $cFile];
        $ch         = curl_init();
        curl_setopt($ch, CURLOPT_URL, $target_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
    }
}
