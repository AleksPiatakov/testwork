<?php


class Paginator
{
    private $_page;
    private $_total;
    private $_href;
    private $_limit;

    /**
     * Paginator constructor.
     * @param int $total
     * @param int $page
     */
    public function __construct($total, $page, $limit, $href)
    {
        $this->_total = $total;
        $this->_page = $page;
        $this->_href = $href;
        $this->_limit = $limit;

    }

    public function createLinks($links, $list_class)
    {

        $last = ceil($this->_total / $this->_limit);
        $start = (($this->_page - $links) > 0) ? $this->_page - $links : 1;
        $end = (($this->_page + $links) < $last) ? $this->_page + $links : $last;

        $html = '<ul class="' . $list_class . '">';

        $class = ($this->_page == 1) ? "disabled" : "";
        if ($this->_page > 2) {
            $html .= '<li class="' . $class . '"><a href="' . $this->_href . ($this->_page - 1) . '">&laquo;</a></li>';
        }


        if ($start > 1) {
            $html .= '<li><a href="' . $this->_href . '1">1</a></li>';
        }

        for ($i = $start; $i <= $end; $i++) {
            $class = ($this->_page == $i) ? "active" : "";
            $html .= '<li class="' . $class . '"><a href="' . $this->_href . $i . '">' . $i . '</a></li>';
        }

        if ($end < $last) {
            $html .= '<li><a href="' . $this->_href . $last . '">' . $last . '</a></li>';
        }

        $class = ($this->_page == $last) ? "disabled" : "";
        if ($this->_page != $last) {
            $html .= '<li class="' . $class . '"><a href="' . $this->_href . ($this->_page + 1) . '">&raquo;</a></li>';
        }

        $html .= '</ul>';

        return $html;
    }
}