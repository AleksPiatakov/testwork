<?php

interface XmlDataFormat
{

    public function getData();

    public function setData();

    public function setQuery($query);

    public function format($row);

    public function formatLangOutput($langUrls, $alternates, $lastmod);
}

abstract class AbstractXmlDataFormat implements XmlDataFormat
{
    public function formatLangOutput($langUrls, $alternates, $lastmod = false)
    {
        $output = [];
        foreach ($langUrls as $link) {
            $data = ['loc' => $link, 'xhtml:link' => $alternates];
            if ($lastmod) {
                $data['lastmod'] = $lastmod;
            }
            $output[] = $data;
        }
        return $output;
    }
}

class XmlDefaultFormat extends AbstractXmlDataFormat
{

    public $query;

    protected $linkBuilder;

    protected $url = [];

    public function __construct(LinkBuilder $linkBuilder)
    {
        $this->linkBuilder = $linkBuilder;
    }


    public function setQuery($query)
    {
        $this->query = $query;
    }

    public function getData()
    {
        return $this->url;
    }

    public function setData()
    {
        $query = tep_db_query($this->query);
        $urls = [];
        while ($row = tep_db_fetch_array($query)) {
            $urls = array_merge($urls, $this->format($row));
        }
        $this->url = $urls;
    }

    public function format($row)
    {
        global $lng;
        $alternate = [];
        $links = [];
        $lastmod = isset($row['last_modified']) && $row['last_modified'] && $row['last_modified'] != '0000-00-00 00:00:00' ? date("Y-m-d", strtotime($row['last_modified'])) : false;
        $lastmod = $lastmod ? $lastmod : (isset($row['date_added']) && $row['date_added'] && $row['date_added'] != '0000-00-00 00:00:00' ? date("Y-m-d", strtotime($row['date_added'])) : false);

        foreach ($lng->catalog_languages as $hreflang => $language_info) {
            $id = $this->linkBuilder->hrefLink(
                $row['id'],
                $hreflang . '/'
            );
            $link = Sitemap::sanitizeLink($id);
            if (count($lng->catalog_languages) > 1) {
                $alternate[] = [
                  'rel' => 'alternate',
                  'hreflang' => $hreflang,
                  'href' => $link,
                ];
            }
            $links[] = $link;
        }

        return $this->formatLangOutput($links, $alternate, $lastmod);
    }
}

class XmlArticleFormat extends XmlDefaultFormat
{
    public function setData()
    {
        parent::setData();
        $this->url = array_merge($this->url, $this->formatMainPage());
    }
    public function formatMainPage()
    {
        global $lng;
        $alternate = [];
        $links = [];
        foreach ($lng->catalog_languages as $hreflang => $language_info) {
            $id = addHostnameToLink(tep_href_link($hreflang . '/' . FILENAME_DEFAULT));
            $link = Sitemap::sanitizeLink($id);
            $alternate[] = [
              'rel' => 'alternate',
              'hreflang' => $hreflang,
              'href' => $link,
            ];
            $links[] = $link;
        }

        return $this->formatLangOutput($links, $alternate, $lastmod = false);
    }
}

class XmlSeoFilterFormat extends XmlDefaultFormat
{

    public $query;


    protected $url = [];

    public function __construct(LinkBuilder $linkBuilder)
    {
        parent::__construct($linkBuilder);
    }

    public function format($row)
    {
        global $lng;
        $alternate = [];
        $links = [];
        foreach ($lng->catalog_languages as $hreflang => $language_info) {
            $id = $this->linkBuilder->hrefLink(
                $row['categories_id'],
                $row['manufacturers_id'],
                [$row['filter_id_1'],$row['filter_id_2']],
                $hreflang,
                $language_info['id']
            );
            if (empty($id)) {
                continue;
            }
            $link = Sitemap::sanitizeLink($id);
            $alternate[] = [
                'rel' => 'alternate',
                'hreflang' => $hreflang,
                'href' => $link,
            ];
            $links[] = $link;
        }


        return $this->formatLangOutput($links, $alternate, $lastmod = false);
    }
}

class XmlFilterFormat extends XmlDefaultFormat
{

    public $query;


    protected $url = [];

    public function __construct(LinkBuilder $linkBuilder)
    {
        parent::__construct($linkBuilder);
    }

    public function format($row)
    {
        global $lng;
        $alternate = [];
        $links = [];
        foreach ($lng->catalog_languages as $hreflang => $language_info) {
            $ovArray = isset($row['options_values_id']) ? [$row['options_values_id']] : [];
            $id = $this->linkBuilder->hrefLink(
                $row['categories_id'],
                $row['manufacturers_id'],
                $ovArray,
                $hreflang,
                $language_info['id']
            );
            $link = Sitemap::sanitizeLink($id);
            $alternate[] = [
                'rel' => 'alternate',
                'hreflang' => $hreflang,
                'href' => $link,
            ];
            $links[] = $link;
        }

        return $this->formatLangOutput($links, $alternate, $lastmod = false);
    }
}

class XmlImageFormat extends AbstractXmlDataFormat
{

    public $query;

    private $linkBuilder;

    protected $url = [];

    public function __construct(LinkBuilder $linkBuilder)
    {
        $this->linkBuilder = $linkBuilder;
    }

    public function getData()
    {
        return $this->url;
    }

    public function format($row)
    {
        $image = array_map(
            function ($name) {
                return [
                    'image:loc' => HTTP_SERVER . '/getimage/products/' . $name,
                ];
            },
            array_filter(explode(';', $row['image']))
        );

        return [
            'loc' => Sitemap::sanitizeLink($this->linkBuilder->hrefLink($row['id'])),
            'image:image' => $image,
        ];
    }

    public function setData()
    {
        $query = tep_db_query($this->query);
        while ($row = tep_db_fetch_array($query)) {
            $this->url[] = $this->format($row);
        }
    }

    public function setQuery($query)
    {
        $this->query = $query;
    }
}

class XmlIndexFormat extends AbstractXmlDataFormat
{


    private $linkBuilder;

    protected $url = [];

    public function __construct(LinkBuilder $linkBuilder)
    {
        $this->linkBuilder = $linkBuilder;
    }

    public function getData()
    {
        return $this->url;
    }

    public function setData()
    {
        foreach (Index::$typeToClass as $k => $name) {
            $query = call_user_func($name . '::getQuery');
            if (tep_db_query($query)->num_rows) {
                $this->url[] = $this->format($k);
            }
        }
    }

    public function setQuery($query)
    {
    }


    public function format($name)
    {
        return [
            'loc' => $this->linkBuilder->hrefLink($name),
        ];
    }
}
