<?php
/*
  $Id: split_page_results.php,v 1.1.1.1 2003/09/18 19:03:47 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

  class splitPageResults {
    function __construct(&$current_page_number, $max_rows_per_page, &$sql_query, &$query_num_rows) {
      if (empty($current_page_number)) $current_page_number = 1;

      $pos_to = strlen($sql_query);
      $pos_from = stripos($sql_query, ' from', 0);

      $pos_group_by = stripos($sql_query, ' group by', $pos_from);
      if (($pos_group_by < $pos_to) && ($pos_group_by != false)) $pos_to = $pos_group_by;

      $pos_having = stripos($sql_query, ' having', $pos_from);
      if (($pos_having < $pos_to) && ($pos_having != false)) $pos_to = $pos_having;

      $pos_order_by = stripos($sql_query, ' order by', $pos_from);
      if (($pos_order_by < $pos_to) && ($pos_order_by != false)) $pos_to = $pos_order_by;

      $reviews_count_query = tep_db_query("select count(*) as total " . substr($sql_query, $pos_from, ($pos_to - $pos_from)));
      $reviews_count = tep_db_fetch_array($reviews_count_query);
      $query_num_rows = $reviews_count['total'];

      $num_pages = ceil($query_num_rows / $max_rows_per_page);
      if ($current_page_number > $num_pages) {
        $current_page_number = $num_pages;
      }
      $offset = ($max_rows_per_page * ($current_page_number - 1));
      $sql_query .= " limit " . max($offset, 0) . ", " . $max_rows_per_page;
    }

    function display_links($query_numrows, $max_rows_per_page, $max_page_links, $current_page_number, $parameters = '', $page_name = 'page') {
      global $PHP_SELF;

      if ( tep_not_null($parameters) && (substr($parameters, -1) != '&') ) $parameters .= '&';

// calculate number of pages needing links
      $num_pages = ceil($query_numrows / $max_rows_per_page);

      $pages_array = array();
      for ($i=1; $i<=$num_pages; $i++) {
        $pages_array[] = array('id' => $i, 'text' => $i);
      }

      if ($num_pages > 1) {
        $display_links = tep_draw_form('pages', basename($PHP_SELF), '', 'get');

        if ($current_page_number > 1) {
          $display_links .= '<a href="' . tep_href_link(basename($PHP_SELF), $parameters . $page_name . '=' . ($current_page_number - 1), 'NONSSL') . '" class="splitPageLink">' . PREVNEXT_BUTTON_PREV . '</a>&nbsp;&nbsp;';
        } else {
          $display_links .= PREVNEXT_BUTTON_PREV . '&nbsp;&nbsp;';
        }

        $display_links .= sprintf(TEXT_RESULT_PAGE, preg_replace('#class="[^"]*"#', '', tep_draw_pull_down_menu($page_name, $pages_array, $current_page_number, 'onChange="this.form.submit();"')), $num_pages);

        if (($current_page_number < $num_pages) && ($num_pages != 1)) {
          $display_links .= '&nbsp;&nbsp;<a href="' . tep_href_link(basename($PHP_SELF), $parameters . $page_name . '=' . ($current_page_number + 1), 'NONSSL') . '" class="splitPageLink">' . PREVNEXT_BUTTON_NEXT . '</a>';
        } else {
          $display_links .= '&nbsp;&nbsp;' . PREVNEXT_BUTTON_NEXT;
        }

        if (!empty($parameters)) {
          if (substr($parameters, -1) == '&') $parameters = substr($parameters, 0, -1);
          $pairs = explode('&', $parameters);
          foreach ($pairs as $key => $pair) {
//          while (list(, $pair) = each($pairs)) {
            list($key,$value) = explode('=', $pair);
            $display_links .= tep_draw_hidden_field(rawurldecode($key), rawurldecode($value));
          }
        }

        if (SID) $display_links .= tep_draw_hidden_field(tep_session_name(), tep_session_id());

        $display_links .= '</form>';
      } else {
        $display_links = sprintf(TEXT_RESULT_PAGE, $num_pages, $num_pages);
      }

      return $display_links;
    }

    function new_display_links($query_numrows, $max_rows_per_page, $max_page_links,
                                  $current_page_number, $parameters = '', $page_name = 'page') {
      global $PHP_SELF;

      if (tep_not_null($parameters)) {
        $parameters = rtrim($parameters, '&');
        $parameters .= '&';
      }

      $num_pages = ceil($query_numrows / $max_rows_per_page);
      if ($num_pages > 1) {
        $display_links = '<ul class="m-t-none m-b-none text-xs btn-group pagination">';

        if ($current_page_number > 1) {
          $display_links .= '<li><a href="' . tep_href_link(basename($PHP_SELF), $parameters . $page_name . '=' . ($current_page_number - 1), 'NONSSL') . '">' . PREVNEXT_BUTTON_PREV . '</a></li>';
        }

        $pages_dropdown_items = '';
        for ($i = 1; $i <= $num_pages; $i++) {
          $pages_dropdown_items .= '<li><a href="' . tep_href_link(basename($PHP_SELF), $parameters . $page_name . '=' . $i, 'NONSSL') . '">' . $i . '</a></li>';
        }

        $pages_dropdown = <<< EOF
<div class="btn-group dropdown m-l-xs m-r-xs">
  <button type="button" class="btn btn-default text-xs" data-toggle="dropdown">
    {$current_page_number}
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu text-xs">
    {$pages_dropdown_items}
  </ul>
</div>
EOF;

        $display_links .= '<li class="f-l m-l m-r">' . sprintf(TEXT_RESULT_PAGE, $pages_dropdown, $num_pages) . '</li>';

        if (($current_page_number < $num_pages) && ($num_pages != 1)) {
          $display_links .= '<li><a href="' . tep_href_link(basename($PHP_SELF), $parameters . $page_name . '=' . ($current_page_number + 1), 'NONSSL') . '">' . PREVNEXT_BUTTON_NEXT . '</a></li>';
        }

        $display_links .= '</ul>';
      } else {
        /*
         * Показываем, как минимум, 1 страницу из 1
         */
        $num_pages = 1;
        $display_links = sprintf(TEXT_RESULT_PAGE, $num_pages, $num_pages);
      }

      return $display_links;
    }

    function display_count($query_numrows, $max_rows_per_page, $current_page_number, $text_output) {
      $to_num = ($max_rows_per_page * $current_page_number);
      if ($to_num > $query_numrows) $to_num = $query_numrows;
      $from_num = ($max_rows_per_page * ($current_page_number - 1));
      if ($to_num == 0) {
        $from_num = 0;
      } else {
        $from_num++;
      }

      return sprintf($text_output, $from_num, $to_num, $query_numrows);
    }
  }
?>
