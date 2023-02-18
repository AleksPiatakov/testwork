<?php

/**
 * Class Sitemap
 * htaccess strings
 *
 * RewriteRule ^sitemapimages.xml$ sitemap.php?type=images
 * RewriteRule ^sitemaparticles.xml$ sitemap.php?type=articles
 * RewriteRule ^sitemapproducts.xml$ sitemap.php?type=products
 * RewriteRule ^sitemapcategories.xml$ sitemap.php?type=categories
 * RewriteRule ^sitemapmanufacturers.xml$ sitemap.php?type=manufacturers
 * RewriteRule ^sitemapseo_filters.xml$ sitemap.php?type=seo_filters
 * RewriteRule ^sitemapcategorybrand.xml$ sitemap.php?type=categorybrand
 */
class Sitemap
{


    /**
     *
     */
    const SITEMAP_FOLDER = '';

    /**
     * @var string
     */
    public $topTagName = '';

    /**
     * @var XmlType
     */
    private $type;

    /**
     * @var
     */
    private $data;

    /**
     * @var bool
     */
    private $isIndex;

    /**
     * @var string
     */
    public $tagName = '';

    /**
     * @var array
     */
    public $url = [];

    /**
     * @var array
     */
    private $headerAttr = [
        "xmlns" => "http://www.sitemaps.org/schemas/sitemap/0.9",
        "xmlns:xsi" => "http://www.w3.org/2001/XMLSchema-instance",
        "xmlns:xhtml" => "http://www.w3.org/1999/xhtml",
        "xmlns:image" => "http://www.google.com/schemas/sitemap-image/1.1",
    ];

    /**
     * @var array
     */
    public static $types = [
        'products',
        'categories',
        'articles',
        'images',
        'manufacturers',
        //        'filters',
        'seo_filters',
        //'categorybrand',
    ];

    /**
     * Sitemap constructor.
     * @param XmlType $type
     * @param bool $isIndex
     */
    public function __construct(XmlType $type, $isIndex = false)
    {
        $this->type = $type;
        $this->isIndex = $isIndex;
    }

    /**
     * @return $this
     */
    public function getData()
    {
        $this->type->format->setQuery($this->type->query);
        $this->type->format->setData();
        $this->data = $this->type->format->getData();
        return $this;
    }

    /**
     * @param $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @param $tagName
     */
    public function setTopTagName($tagName)
    {
        $this->topTagName = $tagName;
    }

    /**
     * @param $tagName
     */
    public function setTagName($tagName)
    {
        $this->tagName = $tagName;
    }

    /**
     *
     */
    public function buildSitemap()
    {
        $doc = new DOMDocument('1.0', 'UTF-8');

//        $xmlRoot = $doc->createElement($this->type::TOP_TAG_NAME);
        $xmlRoot = $doc->createElement($this->type->getTopTagName());
        $xmlRoot = $doc->appendChild($xmlRoot);
        foreach ($this->headerAttr as $attr => $value) {
            $xmlRoot->setAttributeNS(
                'http://www.w3.org/2000/xmlns/',
                $attr,
                $value
            );
        }
        $xmlRoot->setAttributeNS(
            'http://www.w3.org/2001/XMLSchema-instance',
            "xsi:schemaLocation",
            "http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
        );

        foreach ($this->data as $urldata) {
//            $channelNode = $xmlRoot->appendChild($doc->createElement($this->type::TAG_NAME));
            $channelNode = $xmlRoot->appendChild($doc->createElement($this->type->getTagName()));
            foreach ($urldata as $name => $value) {
                if (is_array($value)) {
                    foreach ($value as $n => $v) {
                        $childNode = $channelNode->appendChild($doc->createElement($name));
                        foreach ($v as $nn => $vv) {
                            if ($nn == 'image:loc') {
                                $childNode->appendChild(
                                    $doc->createElement(
                                        $nn,
                                        htmlspecialchars(utf8_encode($vv))
                                    )
                                );
                            } else {
                                $childNode->setAttribute($nn, $vv);
                            }
                        }
                    }
                } else {
                    $channelNode->appendChild(
                        $doc->createElement(
                            $name,
                            $value
                        )
                    );
                }
            }
        }


        $doc->formatOutput = true;
        header("Content-Type: text/xml");
        echo $doc->saveXML();
    }


    /**
     * @param $link
     * @return string
     */
    public static function sanitizeLink($link)
    {
        $link = strstr($link, HTTP_SERVER) ? $link : HTTP_SERVER . str_replace('//', '/', '/' . $link);
        return htmlspecialchars(utf8_encode($link));
    }
}
