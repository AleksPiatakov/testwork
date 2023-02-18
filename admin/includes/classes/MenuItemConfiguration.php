<?php

class MenuItemConfiguration {

    /**
     * The title of the tab
     * @var string
     */
    private $title;

    /**
     * Access validation function
     * @var Closure
     */
    private $accessClosure;

    /**
     * if link is external
     * @var bool
     */
    private $isExternalLink = false;

    /**
     * external link
     * @var string
     */
    private $externalLink;

    private $isActiveClosure;

    public function setIsActiveClosure($closure) {
        $this->isActiveClosure = $closure;
        return $this;
    }

    /**
     * @return bool
     */
    public function isExternalLink() {
        return $this->isExternalLink;
    }

    /**
     * @param string $link
     * @return $this
     */
    public function setExternalLink($link) {
        $this->externalLink = $link;
        $this->isExternalLink = true;
        return $this;
    }

    public function getExternalLink()
    {
        return $this->externalLink;
    }


    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string $title
     * @return self
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function isAccessible() {
        $closureResult = call_user_func($this->accessClosure);
        if(!is_bool($closureResult)) {
            throw new Exception("Result of closure must be bool!");
        }
        return $closureResult;
    }
    /**
     * @return bool
     * @throws Exception
     */
    public function isActive() {
        $closureResult = call_user_func($this->isActiveClosure);
        if(!is_bool($closureResult)) {
            throw new Exception("Result of closure must be bool!");
        }
        return $closureResult;
    }

    /**
     * @param Closure $accessClosure
     * @return self
     */
    public function setAccessClosure($accessClosure) {
        $this->accessClosure = $accessClosure;
        return $this;
    }

    /**
     * @return self
     */
    public static function create() {
        return new self;
    }

}