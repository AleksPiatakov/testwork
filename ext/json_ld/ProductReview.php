<?php

namespace JsonLd;

class ProductReview
{

    const BEST = 5;
    const WORST = 1;

    protected $author;
    protected $datePublished;
    protected $description;
    protected $name;
    protected $reviewRating;

    /**
     * ProductReview constructor.
     * @param $author
     * @param $datePublished
     * @param $description
     * @param $name
     * @param $reviewRating
     */
    public function __construct($author, $datePublished, $description, $name, $reviewRating)
    {
        $this->author        = $author;
        $this->datePublished = $datePublished;
        $this->description   = $description;
        $this->name          = $name;
        $this->reviewRating  = $reviewRating;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getDatePublished()
    {
        return $this->datePublished;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getReviewRating()
    {
        return $this->reviewRating;
    }
}
