<?php

/*
  $Id: breadcrumb.php,v 1.1.1.1 2003/09/18 19:05:14 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

class breadcrumb
{
    var $_trail;

    function __construct()
    {
        $this->reset();
    }

    function reset()
    {
        $this->_trail = array();
    }
    function add($title, $link = '', $nofollow = '')
    {
        $this->_trail[] = array('title' => $title, 'link' => $link, 'nofollow' => $nofollow);
        if (class_exists("\JsonLd\Container")) {
            \JsonLd\Container::get("breadcrumb")->add($link, $title);
        }
    }

    function trail($separator = ' - ')
    {
        global $show_breadcrumbs, $breadcrumb_container_begin, $breadcrumb_container_end;
        $trail_string = '';
        if (!$show_breadcrumbs) {
            return $trail_string;
        }

        $trail_string .= '<ol class="breadcrumb">';
        $class = '';
        for ($i = 0, $n = sizeof($this->_trail); $i < $n; $i++) {
  //        if (strpos($this->_trail[$i]['link'], '/c-') !== false) $site_link = HTTP_SERVER.'/';
  //        else $site_link = '';

            if ($n == $i) {
                $class = 'class="active"';
            }
            if (isset($this->_trail[$i]['link']) && tep_not_null($this->_trail[$i]['link'])) {
                if ($i + 1 == $n && !$_GET['products_id']) {
                    $trail_string .= '<li ' . $class . '>';
                    $trail_string .= '<span>' . $this->_trail[$i]['title'] . '</span>';
                    $trail_string .= '</li>';
                } else {
                    $trail_string .= '<li ' . $class . '>';
                    $trail_string .= '<a href="' . addHostnameToLink($this->_trail[$i]['link']) . '">';
                    $trail_string .= '<span>' . $this->_trail[$i]['title'] . '</span>';
                    $trail_string .= '</a></li>';
                }
            } else {
                $trail_string .= '<li ' . $class . ' ><span>' . $this->_trail[$i]['title'] . '</span></li>';
            }

          // if (($i+1) < $n) $trail_string .= $separator;
        }
        $trail_string .= '</ol>';

        return $breadcrumb_container_begin . $trail_string . $breadcrumb_container_end;
    }

    function size()
    {
        return sizeof($this->_trail);
    }
}
