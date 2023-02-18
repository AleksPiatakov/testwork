<?php

interface LinkBuilder
{

    public function hrefLink($id);
}

class CategoryLink implements LinkBuilder
{

    public function hrefLink($id, $lang = '')
    {
        return tep_href_link($lang . FILENAME_DEFAULT, 'cPath=' . $id);
    }
}

class ProductLink implements LinkBuilder
{

    public function hrefLink($id, $lang = '')
    {
        return tep_href_link(
            $lang . FILENAME_PRODUCT_INFO,
            'products_id=' . $id
        );
    }
}

class SeoFilterLink implements LinkBuilder
{
    public function hrefLink($cId, $languageId = 1)
    {
        $query = tep_db_query("SELECT sfd.seo_url FROM " . TABLE_SEO_FILTER_DESCRIPTION . " sfd WHERE id = " . (int)$cId . " && language_id = " . (int)$languageId);
        return $query->num_rows ? HTTP_SERVER . '/' . tep_db_fetch_array($query)['seo_url'] : '';
    }
}

class XmlLink implements LinkBuilder
{

    public function hrefLink($name)
    {
        return HTTP_SERVER . "/" . Sitemap::SITEMAP_FOLDER . 'sitemap' . $name . '.xml';
    }
}

class ArticleLink implements LinkBuilder
{

    public function hrefLink($id, $lang = '')
    {
        return tep_href_link(
            $lang . FILENAME_ARTICLE_INFO,
            'articles_id=' . $id
        );
    }
}

class ManufacturerLink implements LinkBuilder
{

    public function hrefLink($id, $lang = '')
    {
        return tep_href_link(
            $lang . FILENAME_DEFAULT,
            'manufacturers_id=' . $id
        );
    }
}

class FilterLink implements LinkBuilder
{

    public function hrefLink($cId, $fId = 0, $ovArray = [], $lang = '', $lang_id = 1)
    {
        global $cPaths,$current_category_id, $tempSeoFilterInfo;
        $fullCPath = $cPaths[$cId];
        $current_category_id = $cId;
        $ovArray = array_values(array_filter($ovArray));
        $tempSeoFilterInfo = [];
        $result = HTTP_SERVER . getFilterUrl($fullCPath, $fId, $ovArray, $lang, $lang_id);
        if (empty($fullCPath)) {
            $result = false;
        }
        return $result;
    }
}
