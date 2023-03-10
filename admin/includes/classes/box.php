<?php
/*
  $Id: box.php,v 1.1.1.1 2003/09/18 19:03:49 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License

  Example usage:

  $heading = array();
  $heading[] = array('params' => 'class="menuBoxHeading"',
                     'text'  => BOX_HEADING_TOOLS,
                     'link'  => tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('selected_box')) . 'selected_box=tools'));

  $contents = array();
  $contents[] = array('text'  => SOME_TEXT);

  $box = new box;
  echo $box->infoBox($heading, $contents);
*/

  class box extends tableBlock {
 /*   function __construct() {
      $this->heading = array();
      $this->contents = array();
    }   */

    function infoBox($heading, $contents) {
      $this->heading = array();
      $this->contents = array();
      $this->table_row_parameters = 'class="infoBoxHeading"';
      $this->table_data_parameters = 'class="infoBoxHeading"';
      $this->heading = $this->__construct($heading);

      $this->table_row_parameters = '';
      $this->table_data_parameters = 'class="infoBoxContent"';
      $this->contents = $this->__construct($contents);

      return $this->heading . $this->contents;
    }

    function infoBoxModal($contents, $params) {

      $this->contents = $this->tableBlockModal($contents, $params);
      return $this->contents;

    }

    function menuBox($heading, $contents) {
		global $menu_dhtml;              // add for dhtml_menu
		if ($menu_dhtml == false ) {     // add for dhtml_menu
	    	$this->table_data_parameters = 'class="menuBoxHeading"';
			if (isset($heading[0]['link'])) {
				$this->table_data_parameters .= ' onmouseover="this.style.cursor=\'hand\'" onclick="document.location.href=\'' . $heading[0]['link'] . '\'"';
				$heading[0]['text'] = '&nbsp;<a href="' . $heading[0]['link'] . '" class="menuBoxHeadingLink">' . $heading[0]['text'] . '</a>&nbsp;';
			} else {
				$heading[0]['text'] = '&nbsp;' . $heading[0]['text'] . '&nbsp;';
			}
			$this->heading = $this->__construct($heading);
			$this->table_data_parameters = 'class="menuBoxContent"';
			$this->contents = $this->__construct($contents);
			return $this->heading . $this->contents;
		} else {
			// Replaced this to make sure that the correct id is passed to the menu
			$url = parse_url($heading[0]['link']);
			$params = explode("&", $url["query"]);
			foreach($params AS $param) {
				list($key, $value) = explode("=", $param);
				if ($key == "selected_box")
					$selected = $value;
			}
			// Eof replacement
	      	$dhtml_contents = $contents[0]['text'];
		    $change_style = array ('<br>'=>' ','<BR>'=>' ', 'a href='=> 'a class="menuItem" href=','class="menuBoxContentLink"'=>' ');
		    $dhtml_contents = strtr($dhtml_contents,$change_style);
		    $dhtml_contents = '<div id="'.$selected.'Menu" class="menu" onmouseover="menuMouseover(event)">'. $dhtml_contents . '</div>';
		    return $dhtml_contents;
		}
	  }

    function newInfoBoxModal($contents, $params) {
      $this->contents = $this->newTableBlockModal($contents, $params);

      return $this->contents;
    }
  }
?>
