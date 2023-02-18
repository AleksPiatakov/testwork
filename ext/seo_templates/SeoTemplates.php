<?php

if (getConstantValue('SEO_TEMPLATES_ENABLED') == 'true') {
    require_once __DIR__ . '/class/SeoTemplates.php';
    $seoTemplate = [];
    if (isset($languages_id) && !empty($languages_id)) {
        if (isset($current_category_id) && !empty($current_category_id)) {
            if ($_GET['products_id']) {
                $seoTemplate = SeoTemplates::getProduct($current_category_id, $languages_id);
            } else {
                $seoTemplate = SeoTemplates::getCategory($current_category_id, $languages_id);
            }
        } elseif ($_GET['keywords']) {
            $seoTemplate = SeoTemplates::getSearch($languages_id);
        } else {
            $seoTemplate = SeoTemplates::getMainPage($languages_id);
        }

        if (isset($_GET['manufacturers_id'])) {
            $seoTemplate = SeoTemplates::getManufacturer($_GET['manufacturers_id'], $languages_id);
        }
    }

    if (!empty($seoTemplate['meta_title'])) {
        $the_title = strtr($seoTemplate['meta_title'], $replaceArray);
    }

    if (!empty($seoTemplate['meta_title'])) {
        $the_desc = strtr($seoTemplate['meta_description'], $replaceArray);
    }
}
