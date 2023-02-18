<?php

class SeoTemplates
{

    const MAIN_PAGE = 'main';
    const PRODUCT = 'product';
    const CATEGORY = 'category';
    const MANUFACTURER = 'manufacturer';
    const SEARCH = 'search';
    const STATUS_ENABLE = 1;

    public static function getProduct($current_category_id, $languages_id)
    {
        $seoTemplateQuery = tep_db_query('
        SELECT 
            std.meta_title,
            std.meta_description
        FROM ' . TABLE_SEO_TEMLATES . ' st LEFT JOIN ' . TABLE_SEO_TEMLATES_DESCRIPTION . ' std ON st.id = std.seo_templates_id AND std.language_id = ' . (int)$languages_id . '
        WHERE 
            st.`include_ids` like "%' . $current_category_id . '%" AND 
            st.`type` = "' . self::PRODUCT . '" AND 
            st.status = ' . self::STATUS_ENABLE . ' ORDER BY st.`sort_order` DESC limit 1');
        $seoTemplate = tep_db_fetch_array($seoTemplateQuery);
        return $seoTemplate;
    }

    public static function getManufacturer($current_category_id, $languages_id)
    {
        $seoTemplateQuery = tep_db_query('
        SELECT 
            std.meta_title,
            std.meta_description
        FROM ' . TABLE_SEO_TEMLATES . ' st LEFT JOIN ' . TABLE_SEO_TEMLATES_DESCRIPTION . ' std ON st.id = std.seo_templates_id AND std.language_id = ' . (int)$languages_id . '
        WHERE 
            st.`include_ids` like "%' . $current_category_id . '%" AND 
            st.`type` = "' . self::MANUFACTURER . '" AND 
            st.status = ' . self::STATUS_ENABLE . ' ORDER BY st.`sort_order` DESC limit 1');
        $seoTemplate = tep_db_fetch_array($seoTemplateQuery);
        return $seoTemplate;
    }

    public static function getCategory($current_category_id, $languages_id)
    {
        $seoTemplateQuery = tep_db_query('
        SELECT 
            std.meta_title,
            std.meta_description
        FROM ' . TABLE_SEO_TEMLATES . ' st LEFT JOIN ' . TABLE_SEO_TEMLATES_DESCRIPTION . ' std ON st.id = std.seo_templates_id AND std.language_id = ' . (int)$languages_id . '
        WHERE 
            st.`include_ids` like "%' . $current_category_id . '%" AND 
            st.`type` = "' . self::CATEGORY . '" AND 
            st.status = ' . self::STATUS_ENABLE . ' ORDER BY st.`sort_order` DESC limit 1');
        $seoTemplate = tep_db_fetch_array($seoTemplateQuery);
        return $seoTemplate;
    }

    public static function getSearch($languages_id)
    {
        $seoTemplateQuery = tep_db_query('
        SELECT 
            std.meta_title,
            std.meta_description
        FROM ' . TABLE_SEO_TEMLATES . ' st LEFT JOIN ' . TABLE_SEO_TEMLATES_DESCRIPTION . ' std ON st.id = std.seo_templates_id AND std.language_id = ' . (int)$languages_id . '
        WHERE 
            st.`type` = "' . self::SEARCH . '" AND 
            st.status = ' . self::STATUS_ENABLE . ' ORDER BY st.`sort_order` DESC limit 1');
        $seoTemplate = tep_db_fetch_array($seoTemplateQuery);
        return $seoTemplate;
    }

    public static function getMainPage($languages_id)
    {
        $seoTemplateQuery = tep_db_query('
        SELECT 
            std.meta_title,
            std.meta_description
        FROM ' . TABLE_SEO_TEMLATES . ' st LEFT JOIN ' . TABLE_SEO_TEMLATES_DESCRIPTION . ' std ON st.id = std.seo_templates_id AND std.language_id = ' . (int)$languages_id . '
        WHERE 
            st.`type` = "' . self::MAIN_PAGE . '" AND 
            st.status = ' . self::STATUS_ENABLE . ' ORDER BY st.`sort_order` DESC limit 1');
        $seoTemplate = tep_db_fetch_array($seoTemplateQuery);
        return $seoTemplate;
    }
}
