<?php

/**
 * Main application asset bundle.
 */
class AppAsset
{
    //CSS
    const CSS_FILE_HOMEPAGE = 'homepage.min.css';
    const CSS_FILE_PRODUCT_DETAIL = 'product.min.css';
    const CSS_FILE_PRODUCT_LIST = 'product-list.min.css';
    const CSS_FILE_CHECKOUT = 'checkout.min.css';
    const CSS_FILE_OTHER = 'other.min.css';
    //JS
    const JS_FILE_HOMEPAGE = 'homepage.min.js';
    const JS_FILE_PRODUCT_DETAIL = 'product.min.js';
    const JS_FILE_PRODUCT_LIST = 'product-list.min.js';//files array for same files
    const JS_FILE_CHECKOUT = 'checkout.min.js';
    const JS_FILE_OTHER = 'other.min.js'; //JS constants
    const STATUS_NOT_MINIFY = 0; //JS variables
    const STATUS_MINIFY_NOW = 1;
    const STATUS_MINIFIRED = 2;

    const TIMEOUT_INTERVAL = 4000;//sec

    //public variables
    //main
    public $versionTimestamp;
    public $isMobile;
    public $isCriticalMode;
    public $useCritical = false;

    //CSS
    public $objMinifierCSS;
    public $cssFilesForClone = [];

    public $css = [];
    public $cssInline = [];

    public $cssHomePage = [];
    public $cssHomePageInline = [];
    public $cssProductDetail = [];
    public $cssProductInlineArray = [];
    public $cssProductList = [];
    public $cssProductListInlineArray = [];
    public $cssCheckout = [];
    public $cssCheckoutInlineArray = [];
    public $cssOtherPage = [];
    public $cssOtherInlineArray = [];

    //JS
    public $objMinifierJS;
    public $jsVariables = [];
    public $jsConstants = [];
    public $constantsJSON = [];
    public $jsFilesForClone = [];

    public $js = [];
    public $jsInline = [];
    public $jsInTimeOut = [];
    public $jsInDocumentReady = [];

    public $jsHomePage = [];
    public $jsHomePageInline = [];
    public $jsProduct = [];
    public $jsProductInline = [];
    public $jsProductList = [];
    public $jsProductListInline = [];
    public $jsCheckOut = [];
    public $jsCheckoutInline = [];

    //FONTS
    public $fonts = [];

    public $minifyStatus = MINIFY_CSSJS;

    //private variables
    //CSS
    private $cssArray = [];
    private $cssInlineArray = [];
    private $cssFileName = '';//output css file names
    private $minifieredCss = '';
    //JS
    private $jsArray = [];
    private $jsInlineArray = [];
    private $jsFileName = '';//output js file names

    //pages where we use critical CSS
    private $pagesArrayWithCriticalCss = [
        self::CSS_FILE_HOMEPAGE,
        self::CSS_FILE_PRODUCT_LIST,
        self::CSS_FILE_PRODUCT_DETAIL,
        //self::CSS_FILE_OTHER  //TODO disabled temporary need solution for compare, wishlist and contact_us pages
    ];

    /**
     * check if minifier.php exist in ext folder
     */
    public function ifMinifierModuleExist()
    {
        return file_exists(DIR_WS_EXT . 'minifier/minifier.php') ? true : false;
    }

    /**
     * check and return css file by page type
     * @param string $content
     * */
    public function renderCssBlock($content)
    {
        $minifyValue = self::ifMinifierModuleExist() ? $this->minifyStatus : self::STATUS_NOT_MINIFY;
        switch ($minifyValue) {
            case self::STATUS_NOT_MINIFY:
                $this->checkPageType($content);
                $this->getNoMinifyCssByPageType($content);
                $this->printFonts();
                $this->printNoMinifierCss();
                break;
            case self::STATUS_MINIFY_NOW:
                $this->deleteAllMinifiedFiles();
                $this->checkPageType($content);
                $this->makeMiniferCss();
                $this->makeCloneCssFiles($content);
                $this->printCriticalCss();
                $this->printFonts();
                $this->printMinifierCss();
                break;
            default://use minifed style before
                $this->checkPageType($content);
                if (!file_exists(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/css/' . $this->cssFileName)) {
                    $this->makeMiniferCss();
                    $this->makeCloneCssFiles($content);
                }
                $this->printCriticalCss();
                $this->printFonts();
                $this->printMinifierCss();
                break;
        }
        //$this->checkLongScriptsLoaded();
    }

    /**
     * check and return critical css
     * */
    private function printCriticalCss()
    {
        $this->useCritical = file_exists(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/css/' . ($this->isMobile ? 'critical.mobile.' : 'critical.') . $this->cssFileName) && defined('USE_CRITICAL_CSS') && USE_CRITICAL_CSS == 'true';
        if ($this->useCritical) {
            $cssMini = file_get_contents(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/css/' . ($this->isMobile ? 'critical.mobile.' : 'critical.') . $this->cssFileName);
            $cssMini = str_replace('../fonts/', DIR_WS_TEMPLATES . TEMPLATE_NAME . '/fonts/', $cssMini);
            echo '<style>' . $cssMini . '</style>' . "\n\t";
            //echo "\t".'<link rel="stylesheet" type="text/css" href="'.DIR_WS_TEMPLATES . TEMPLATE_NAME . '/css/' . 'critical.'.$this->cssFileName.'">'."\n\t";
        }
    }

    /**
     * Delete one file before generating a new files
     *
     * @param string $fileNmae
     * */
    private function deleteFile($fileNmae)
    {
        if (is_file($fileNmae)) {
            unlink($fileNmae);
        }
    }

    /**
     * Delete all minifired files before generating a new files
     * */
    private function deleteAllMinifiedFiles()
    {
        $fileForDelete = [
            DIR_WS_TEMPLATES . TEMPLATE_NAME . '/css/' . self::CSS_FILE_HOMEPAGE,
            DIR_WS_TEMPLATES . TEMPLATE_NAME . '/css/' . self::CSS_FILE_PRODUCT_DETAIL,
            DIR_WS_TEMPLATES . TEMPLATE_NAME . '/css/' . self::CSS_FILE_PRODUCT_LIST,
            DIR_WS_TEMPLATES . TEMPLATE_NAME . '/css/' . self::CSS_FILE_CHECKOUT,
            DIR_WS_TEMPLATES . TEMPLATE_NAME . '/css/' . self::CSS_FILE_OTHER,
            DIR_WS_TEMPLATES . TEMPLATE_NAME . '/js/' . self::JS_FILE_HOMEPAGE,
            DIR_WS_TEMPLATES . TEMPLATE_NAME . '/js/' . self::JS_FILE_PRODUCT_DETAIL,
            DIR_WS_TEMPLATES . TEMPLATE_NAME . '/js/' . self::JS_FILE_PRODUCT_LIST,
            DIR_WS_TEMPLATES . TEMPLATE_NAME . '/js/' . self::JS_FILE_CHECKOUT,
            DIR_WS_TEMPLATES . TEMPLATE_NAME . '/js/' . self::JS_FILE_OTHER,
        ];
        array_map([$this, 'deleteFile'], $fileForDelete);
    }

    /**
     * setting current values by page type
     * @param string $content
     * */
    private function getNoMinifyCssByPageType($content)
    {
        foreach ($this->cssArray as $key => $oneCss) {
            $this->cssArray[$key] = "\n\t<link rel=\"stylesheet\" type=\"text/css\" href=\"" . $oneCss . "\">";
        }
        $this->cssInline = array_merge($this->cssInline, $this->cssInlineArray);
        $this->cssArray[] = '<style>' . implode(' ', $this->cssInline) . '</style>';
    }

    /**
     * prepare css files for current page type
     * checked and merge css files and css inline styles
     * */
    private function checkPageType($content)
    {
        switch ($content) {
            case 'index_default':
                $this->cssArray = $this->cssHomePage;
                $this->cssInlineArray = $this->cssHomePageInline;
                $this->cssFileName = self::CSS_FILE_HOMEPAGE;
                //JS
                $this->jsArray = array_merge($this->js, $this->jsHomePage);
                $this->jsInlineArray = array_merge($this->jsInline, $this->jsHomePageInline);
                $this->jsFileName = self::JS_FILE_HOMEPAGE;
                break;
            case 'index_products':
                $this->cssArray = $this->cssProductList;
                $this->cssInlineArray = $this->cssProductListInlineArray;
                $this->cssFileName = self::CSS_FILE_PRODUCT_LIST;
                //JS
                $this->jsArray = array_merge($this->js, $this->jsProductList);
                $this->jsInlineArray = array_merge($this->jsInline, $this->jsProductListInline);
                $this->jsFileName = self::JS_FILE_PRODUCT_LIST;
                break;
            case 'product_info':
                $this->cssArray = $this->cssProductDetail;
                $this->cssInlineArray = $this->cssProductInlineArray;
                $this->cssFileName = self::CSS_FILE_PRODUCT_DETAIL;
                //JS
                $this->jsArray = array_merge($this->js, $this->jsProduct);
                $this->jsInlineArray = array_merge($this->jsInline, $this->jsProductInline);
                $this->jsFileName = self::JS_FILE_PRODUCT_DETAIL;
                break;
            case 'checkout':
                $this->cssArray = $this->cssCheckout;
                $this->cssInlineArray = $this->cssCheckoutInlineArray;
                $this->cssFileName = self::CSS_FILE_CHECKOUT;
                //JS
                $this->jsArray = array_merge($this->js, $this->jsCheckOut);
                $this->jsInlineArray = array_merge($this->jsInline, $this->jsCheckoutInline);
                $this->jsFileName = self::JS_FILE_CHECKOUT;
                break;
            default:
                $this->cssArray = $this->cssOtherPage;
                $this->cssInlineArray = $this->cssOtherInlineArray;
                $this->cssFileName = self::CSS_FILE_OTHER;
                //JS
                $this->jsArray = $this->js;
                $this->jsInlineArray = $this->jsInline;
                $this->jsFileName = self::JS_FILE_OTHER;
                break;
        }
    }

    /**
     * check font type by file extension
     * @param string $itemFont
     * @return string $result
     * */
    private function checkFontType($itemFont)
    {
        $path_info = pathinfo($itemFont);
        $result = '';
        switch ($path_info['extension']) {
            case 'woff2':
                $result = 'font/woff2';
                break;
            case 'ttf':
                $result = 'font/ttf';
                break;
            case 'eot':
                $result = 'application/vnd.ms-fontobject';
                break;
            case 'svg':
                $result = 'image/svg+xml';
                break;
        }

        return $result;
    }

    /**
     * output fonts tags
     * */
    private function printFonts()
    {
        if (!empty($this->fonts)) {
            foreach ($this->fonts as $itemFont) {
                $fontType = $this->checkFontType($itemFont);
                echo '<link rel="preload" href="' . HTTP_SERVER . '/' . $itemFont . '" as="font" type="' . $fontType . '" crossorigin>';
            }
        }
    }


    /**
     * output css files
     * */
    private function printNoMinifierCss()
    {
        foreach ($this->cssArray as $itemStyle) {
            echo $itemStyle;
        }
    }

    /**
     * Make the minifier css files for current page type
     * checked and merge css files and css inline styles
     * and put style code to css file
     * */
    private function makeMiniferCss()
    {
        try {
            if(!$this->objMinifierCSS && self::STATUS_MINIFIRED && file_exists(DIR_WS_EXT . 'minifier/minifier.php')){
                require_once(DIR_WS_EXT . 'minifier/minifier.php');
                $this->objMinifierCSS = !empty($minifierCSS) ? $minifierCSS : null;
            }
            if ($this->objMinifierCSS) {
                //clear minifier data before process
                $this->objMinifierCSS->clear();
                foreach ($this->cssArray as $key => $oneCss) {
                    if (file_exists($oneCss)) {
                        $this->cssArray[$key] = file_get_contents($oneCss);
                    }
                }
                $this->cssArray = array_merge($this->cssArray, $this->cssInline, $this->cssInlineArray);
                $this->objMinifierCSS->add(implode(' ', $this->cssArray));
                $this->minifieredCss = $this->objMinifierCSS->minify();
                $this->clearMinifieredCss();

                file_put_contents(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/css/' . $this->cssFileName, $this->minifieredCss);
            }
        } catch (Exception $e) {
            //echo $e->getMessage(), "\n";
        }
    }

    /**
     * Delete spaces at the beginning line and in content
     * */
    private function clearMinifieredCss()
    {
        $this->minifieredCss = preg_replace('/^ +/m', '', $this->minifieredCss);
        $this->minifieredCss = str_replace(' ::', '::', $this->minifieredCss);
        $this->minifieredCss = str_replace(' :', ':', $this->minifieredCss);
    }

    /**
     * @param string $content
     * clone css files for similar pages
     * */
    private function makeCloneCssFiles($content)
    {
        if (!empty($this->cssFilesForClone) && $content == 'index_default') {
            foreach ($this->cssFilesForClone as $oneClone) {
                @copy(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/css/' . self::CSS_FILE_HOMEPAGE, DIR_WS_TEMPLATES . TEMPLATE_NAME . '/css/' . $oneClone);
            }
        }
    }

    /**
     * printing separate css files
     * */
    private function printMinifierCss()
    {
        if (!$this->isMobile) {
            echo "\t" . '<link id="main-style" rel="stylesheet" ' . ($this->isCriticalMode || !$this->useCritical || !in_array($this->cssFileName, $this->pagesArrayWithCriticalCss) ? 'href' : 'data-href') . '="' . DIR_WS_TEMPLATES . TEMPLATE_NAME . '/css/' . $this->cssFileName . '?v=' . $this->versionTimestamp . '">' . "\n\t" . '<noscript><link rel="stylesheet" href="' . DIR_WS_TEMPLATES . TEMPLATE_NAME . '/css/' . $this->cssFileName . '?v=' . $this->versionTimestamp . '"></noscript>';
        } else {
            if ($this->isCriticalMode || !$this->useCritical) {//when site opened in critical emulation window or useCritical CSS disabled
                $cssContent = file_get_contents(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/css/' . $this->cssFileName);
                $cssContent = str_replace('../fonts/', DIR_WS_TEMPLATES . TEMPLATE_NAME . '/fonts/', $cssContent);
                echo '<style>' . $cssContent . '</style>' . "\n\t";
            } else {// for mobile version and useCritical CSS enable
                echo "\t" . '<link id="mobile-main-style" rel="preload" as="style" onload="this.onload=null;this.rel=\'stylesheet\'" data-href="' . DIR_WS_TEMPLATES . TEMPLATE_NAME . '/css/' . $this->cssFileName . '?v=' . $this->versionTimestamp . '">' . "\n\t" . '<noscript><link rel="stylesheet" href="' . DIR_WS_TEMPLATES . TEMPLATE_NAME . '/css/' . $this->cssFileName . '?v=' . $this->versionTimestamp . '"></noscript>';
            }
        }
    }

    /**
     * check LongScriptLoaded and print style
     * */
//    private function checkLongScriptsLoaded()
//    {
//        if (isset($_COOKIE['LongScriptsLoaded'])) {
//            echo "\t" . '<link rel="stylesheet" type="text/css" href="' . DIR_WS_TEMPLATES . TEMPLATE_NAME . '/css/fonts.css">' . "\n\t";
//        }
//    }

    /**
     * check and return js file by page type
     * @param string $content
     * */
    public function renderJsBlock($content)
    {
        $minifyValue = self::ifMinifierModuleExist() ? $this->minifyStatus : self::STATUS_NOT_MINIFY;
        switch ($minifyValue) {
            case self::STATUS_NOT_MINIFY:
                $this->checkPageType($content);
                $this->makeCloneJsArray($content);
                $this->getNoMinifyJsByPageType($content);
                $this->printNoMinifierJs();
                break;
            case self::STATUS_MINIFY_NOW:
                $this->checkPageType($content);
                $this->makeMiniferJs($content);
                $this->makeCloneJsFiles($content);
                //set database MINIFY_CSSJS value to "Use Minified file"
                tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '" . self::STATUS_MINIFIRED . "' where configuration_key = 'MINIFY_CSSJS'");
                $this->printMinifierJs();
                break;
            default://use minifed script file
                $this->checkPageType($content);
                if (!file_exists(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/js/' . $this->jsFileName)) {
                    $this->makeMiniferJs($content);
                    $this->makeCloneJsFiles($content);
                }
                $this->printMinifierJs();
                break;
        }
    }

    /**
     * prepare and output separate js files
     * */
    private function getNoMinifyJsByPageType($content)
    {
        $constantsStr = '<script>' . $this->getJsConstants() . '</script>';
        $variablesStr = '<script>' . implode(' ', $this->jsVariables) . '</script>';
        foreach ($this->jsArray as $key => $oneJs) {
            $this->jsArray[$key] = "\n\t<script type=\"text/javascript\" src=\"" . $oneJs . "\"></script>";
        }
        //added constants and variables before js files
        $this->jsArray[] = "<script id=\"json-constants\" type=\"application/json\">" . $this->getJSONConstants() . "</script>\n\t";
        $this->jsArray = array_merge([$constantsStr], [$variablesStr], $this->jsArray);
        $this->jsArray[] = '<script>' . implode(' ', $this->jsInlineArray) . '</script>';
        //added timeOut js to document Ready
        $this->jsInDocumentReady[] = 'setTimeout(function() {' . implode(' ', $this->jsInTimeOut) . '},' . self::TIMEOUT_INTERVAL . ');';
        $this->jsArray[] = '<script>$(document).ready(function() {' . implode(' ', $this->jsInDocumentReady) . '});</script>';
    }

    /**
     * prepare js constants to one string
     * */
    private function getJsConstants()
    {
        $jsStr = '';
        if (!empty($this->jsConstants)) {
            foreach ($this->jsConstants as $jsK => $jsVal) {
                $jsStr .= 'const ' . $jsK . ' = "' . $jsVal . '"; ';
            };
        }

        return $jsStr;
    }

    /**
     * prepare js constants to one JSON
     * */
    private function getJSONConstants()
    {
        return json_encode($this->constantsJSON);
    }

    /**
     * printing separate js files
     * */
    private function printNoMinifierJs()
    {
        foreach ($this->jsArray as $itemScript) {
            echo $itemScript;
        }
    }

    /**
     * Make the minifier js files for current page type
     * checked and merge js files and js inline scripts
     * and put script code to js file
     * */
    private function makeMiniferJs()
    {
        try {
            if(!$this->objMinifierJS && self::STATUS_MINIFIRED && file_exists(DIR_WS_EXT . 'minifier/minifier.php')){
                require(DIR_WS_EXT . 'minifier/minifier.php');
                $this->objMinifierJS = !empty($minifierJS) ? $minifierJS : null;
            }
            if ($this->objMinifierJS) {
                //clear minifier data before process
                $this->objMinifierJS->clear();
                foreach ($this->jsArray as $key => $oneJs) {
                    if(file_exists($oneJs) || @get_headers($oneJs)){
                        $this->jsArray[$key] = file_get_contents($oneJs);
                        if (!$this->jsArray[$key]) {// if not allow_url_fopen
                            $this->jsArray[$key] = curl_get_contents($oneJs);
                        }
                    }
                }
                $constantsStr = $this->getJsConstants();
                $variablesStr = implode(' ', $this->jsVariables);
                $jsInTimeOutStr = 'setTimeout(function() {' . implode(' ', $this->jsInTimeOut) . '},' . self::TIMEOUT_INTERVAL . ');';
                //added timeOut js to document Ready
                $jsInDocumentReadyStr = '$(document).ready(function() {' . implode(' ', $this->jsInDocumentReady) . " " . $jsInTimeOutStr . '});';
                //added constants, variables before js files and merge with other scripts
                $this->jsArray = array_merge([$constantsStr], [$variablesStr], $this->jsArray, $this->jsInlineArray, [$jsInDocumentReadyStr]);
                foreach ($this->jsArray as $oneJs) {
                    $this->objMinifierJS->add($oneJs);
                }
                file_put_contents(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/js/' . $this->jsFileName, $this->objMinifierJS->minify());
            }
        } catch (Exception $e) {
            //echo $e->getMessage(), "\n";
        }
    }

    /**
     * @param string $content
     * copy js files for similar pages
     * */
    private function makeCloneJsFiles($content)
    {
        if (!empty($this->jsFilesForClone) && $content == 'index_default') {
            foreach ($this->jsFilesForClone as $oneClone) {
                @copy(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/js/' . self::JS_FILE_HOMEPAGE, DIR_WS_TEMPLATES . TEMPLATE_NAME . '/js/' . $oneClone);
            }
        }
    }

    /**
     * @param string $content
     * copy js files for similar pages
     * */
    private function makeCloneJsArray($content)
    {
        if (!empty($this->jsFilesForClone)) {
            if (in_array($this->jsFileName, $this->jsFilesForClone)) {
                $this->jsArray = array_merge($this->js, $this->jsHomePage);
                $this->jsInlineArray = array_merge($this->jsInline, $this->jsHomePageInline);
            }
        }
    }

    /**
     * printing one minified js file
     * */
    private function printMinifierJs()
    {
        echo "<script id=\"json-constants\" type=\"application/json\">" . $this->getJSONConstants() . "</script>\n\t";
        echo "<script defer src=\"" . DIR_WS_TEMPLATES . TEMPLATE_NAME . "/js/" . $this->jsFileName . "?v=" . $this->versionTimestamp . "\" ></script>\n\t";
    }

    /**
     * merge
     */
    public function mergeCss()
    {
        $this->cssHomePage = array_merge($this->css, $this->cssHomePage);
        $this->cssProductDetail = array_merge($this->css, $this->cssProductDetail);
        $this->cssCheckout = array_merge($this->css, $this->cssCheckout);
        $this->cssProductList = array_merge($this->css, $this->cssProductList);
        $this->cssOtherPage = array_merge($this->css, $this->cssProductList);
    }

    /**
     * create js hookie variable
    */
    public function createHookieVariable()
    {
        $this->jsVariables[] = 'var hookie = {};';
    }
}
