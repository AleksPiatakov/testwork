<?php

namespace JsonLd;

class Product implements IGenerate
{

    const BEST_RATING = 100;
    const WORST_RATING = 0;

    protected $id;
    protected $name;
    protected $image;
    protected $description;
    protected $sku;
    protected $mpn;
    protected $identifier;
    protected $brand;

    /**
     * @var ProductReview[]
     */
    protected $reviews = [];
    protected $rating = 100;
    protected $ratingCount = 1;
    protected $price;
    protected $quantity;
    protected $currency;
    protected $convert_currency = 'USD';

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setCurrency($currencyCode)
    {
        $this->currency = $currencyCode;
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function setSku($sku)
    {
        $this->sku = $sku;
        return $this;
    }

    public function setMpn($mpn)
    {
        $this->mpn = $mpn;
        return $this;
    }

    public function setRatingCount($ratingCount)
    {
        $this->ratingCount = $ratingCount;
        return $this;
    }

    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
        return $this;
    }

    public function setBrand($brand)
    {
        $this->brand = $brand;
        return $this;
    }

    public function setReviews($reviews)
    {
        $this->reviews = $reviews;
        return $this;
    }

    public function setRating($rating)
    {
        $this->rating = $rating;
        return $this;
    }

    public function setPrice($price)
    {
        $this->price = number_format((float)$price, 2, '.', '');
        return $this;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = (int) $quantity;
        return $this;
    }

    public function addReview(ProductReview $review)
    {
        $this->reviews[] = $review;
    }

    private function formatPrice($price)
    {
        global $currencies;
        return number_format(tep_round($price * $currencies->currencies[$this->currency]['value'], $currencies->currencies[$this->currency]['decimal_places']), $currencies->currencies[$this->currency]['decimal_places'], $currencies->currencies[$this->currency]['decimal_point'], $currencies->currencies[$this->currency]['thousands_point']);
    }

    public function generate()
    {
        global $currencies, $currency;

        //only for UAH currency in facebook pixel
        if ($currency == 'UAH' && defined('FACEBOOK_PIXEL_MODULE_ENABLED') && FACEBOOK_PIXEL_MODULE_ENABLED === 'true') {
            //use (if is set) facebook currency else use (if is set) USD
            if (defined('DEFAULT_PIXEL_CURRENCY') && isset($currencies->currencies[DEFAULT_PIXEL_CURRENCY]['value'])) {
                $convertCurrency = DEFAULT_PIXEL_CURRENCY;
            } elseif (isset($currencies->currencies[$this->convert_currency]['value'])) {
                $convertCurrency = $this->convert_currency;
            }

            //convert amount of currency to amount of $convertCurrency
            if (isset($convertCurrency) && isset($currencies->currencies[$convertCurrency]['value'])) {
                $currencies->enableCurrencies = false;
                $this->price = (float) $currencies->format($this->price, true, $convertCurrency, $currencies->currencies[$convertCurrency]['value'] / $currencies->currencies[$currency]['value']);
                $currencies->enableCurrencies = true;
                $this->currency = $convertCurrency;
            }
        }

        $data = [
            "@context"        => "https://schema.org",
            "@type"           => "Product",
            "description"     => $this->description,
            "name"            => $this->name,
            "image"           => $this->image,
            "mpn"             => $this->mpn,
            "identifier"      => $this->identifier,
            "productId"       => $this->id,
            "sku"             => $this->sku,
            "brand"           => [
                "@type"           => "Brand",
                "name"    => $this->brand,
            ],
            "offers"          => [
                "@type"           => "Offer",
                "availability"    => ($this->quantity > 0) ? "https://schema.org/InStock" : "https://schema.org/OutOfStock",
                "price"           => $this->formatPrice($this->price),
                "priceCurrency"   => $this->currency,
                "priceValidUntil" => date("Y-m-d", time() + 86400),
                "url"             => HTTP_SERVER . $_SERVER['REQUEST_URI']
            ],
            "aggregateRating" => [
                "@type"       => "AggregateRating",
                "ratingValue" => $this->rating,
                "ratingCount" => $this->ratingCount,
                "bestRating"  => static::BEST_RATING,
                "worstRating" => static::WORST_RATING
            ],
            "review"          => [[
                "@type"        => "Review",
                "author"       => [
                    "@type"           => "Person",
                    "name"    => STORE_OWNER,
                ],
                "name"         => $this->name,
                "description"  => $this->description,
                "reviewRating" => [
                    "@type"       => "Rating",
                    "bestRating"  => ProductReview::BEST,
                    "ratingValue" => "5",
                    "worstRating" => ProductReview::WORST,
                ]
            ]]
        ];

        foreach ($this->reviews as $i => $review) {
            $data["review"][] = [
                "@type"         => "Review",
                "author"        => $review->getAuthor(),
                "name"          => $this->name . " - #" . ($i + 1),
                "description"   => $review->getDescription(),
                "datePublished" => $review->getDatePublished(),
                "reviewRating"  => [
                    "@type"       => "Rating",
                    "bestRating"  => ProductReview::BEST,
                    "ratingValue" => $review->getReviewRating(),
                    "worstRating" => ProductReview::WORST,
                ]
            ];
        }

        return json_encode($data);
    }
}
