<?php

/**
 * Show More widget
 */
class ShowMore
{
    public $m_srch = '';
    public $str = '';
    public $adminFolder = 'admin';
    public $path = 'includes/widgets/ShowMore/';
    
    public function __construct()
    {
        $this -> adminFolder = basename(dirname(dirname(dirname(__DIR__))));
    }
    
    /**
     * @param string $source_id
     * @param string $source_path
     *
     * @return string
     */
    public function init($source_id, $source_path)
    {
        foreach ($_GET as $k => $v) {
            if ($k == 'cPath' or $k == 'f' or $k == 'language' or $k == 'manufacturers_id') {
            }elseif (is_int($k)) {
                $this -> m_srch .= '<input id="pl_at' . $k . '_2" type="hidden" name="' . $k . '" value="' . $v . '" />';
            }else {
                $this -> m_srch .= '<input id="' . $k . '2" type="hidden" name="' . $k . '" value="' . $v . '" />';
            }
        }
        
        $this -> addCSS();
        $this -> str = $this -> getView($source_id, "/$this->adminFolder/" . $source_path);
        $this -> addJS();
        return $this -> str;
    }
    
    /**
     * @param string $source_id
     * @param string $source_path
     *
     * @return string
     */
    private function getView($source_id, $source_path)
    {
        $perPage = isset($_GET['perPage']) ? $_GET['perPage'] : 25;
        $this -> str .= '<form name="m_srch" id="m_srch" action="' . $source_path . '?page=' . $_GET['page'] . '&perPage=25" method="get" >' . $this -> m_srch . '</form>' .
            '<input id="name_page" type="hidden" value="' . $source_id . '">' .
            '<select name="row_by_page" id="pl_onpage" tabindex="-1" class="selectized" style="display: none; "><option value="' . $perPage . '" selected="selected">' . $perPage . '</option></select>' .
            '<input type="hidden" name="number_of_rows" value="">' .
            '<button type="button" class="row_pagin_btn show-more-btn">' . TEXT_MOBILE_SHOW_MORE . '<svg id="loadMoreI" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class=""><path d="M370.72 133.28C339.458 104.008 298.888 87.962 255.848 88c-77.458.068-144.328 53.178-162.791 126.85-1.344 5.363-6.122 9.15-11.651 9.15H24.103c-7.498 0-13.194-6.807-11.807-14.176C33.933 94.924 134.813 8 256 8c66.448 0 126.791 26.136 171.315 68.685L463.03 40.97C478.149 25.851 504 36.559 504 57.941V192c0 13.255-10.745 24-24 24H345.941c-21.382 0-32.09-25.851-16.971-40.971l41.75-41.749zM32 296h134.059c21.382 0 32.09 25.851 16.971 40.971l-41.75 41.75c31.262 29.273 71.835 45.319 114.876 45.28 77.418-.07 144.315-53.144 162.787-126.849 1.344-5.363 6.122-9.15 11.651-9.15h57.304c7.498 0 13.194 6.807 11.807 14.176C478.067 417.076 377.187 504 256 504c-66.448 0-126.791-26.136-171.315-68.685L48.97 471.03C33.851 486.149 8 475.441 8 454.059V320c0-13.255 10.745-24 24-24z"></path></svg></button>';
        return $this -> str;
    }

    /**
     * add CSS stylesheet to widget
     */
    protected function addCSS()
    {
        $this -> str .= '<link rel="stylesheet" href="' . "/$this->adminFolder/" . $this -> path . 'show-more.css" type="text/css">';
    }
    
    /**
     * add JS script to widget
     */
    protected function addJS()
    {
        $this -> str .= '<script src="' . "/$this->adminFolder/" . $this -> path . 'show-more.js" type="application/javascript"></script>';
    }
}
