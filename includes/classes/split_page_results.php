<?php

/*
  $Id: split_page_results.php,v 1.1.1.1 2003/09/18 19:05:12 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

class splitPageResults
{
    var $sql_query, $number_of_rows, $current_page_number, $number_of_pages, $number_of_rows_per_page, $page_name;

/* class constructor */
   // function splitPageResults($query, $max_rows, $count_key = '*', $page_holder = 'page') {
    function __construct($query, $max_rows, $count_key = '*', $page_holder = 'page', $number_of_rows = 0)
    {

        global $_GET, $_POST;

        $this->sql_query = $query;
        $this->page_name = $page_holder;

        if (isset($_GET[$page_holder])) {
            $page = (int)$_GET[$page_holder];
        } elseif (isset($_POST[$page_holder])) {
            $page = (int)$_POST[$page_holder];
        } else {
            $page = '';
        }

        if (empty($page) || !is_numeric($page)) {
            $page = 1;
        }
        $this->current_page_number = $page;

        $this->number_of_rows_per_page = $max_rows;

        if (empty($number_of_rows)) {
            $pos_to = strlen($this->sql_query);
            $pos_from = strpos(strtolower($this->sql_query), ' from', 0);

            $pos_group_by = strpos(strtolower($this->sql_query), ' group by', $pos_from);
            if (($pos_group_by < $pos_to) && ($pos_group_by != false)) {
                $pos_to = $pos_group_by;
            }

            $pos_having = strpos(strtolower($this->sql_query), ' having', $pos_from);
            if (($pos_having < $pos_to) && ($pos_having != false)) {
                $pos_to = $pos_having;
            }

            $pos_order_by = strpos(strtolower($this->sql_query), ' order by', $pos_from);
            if (($pos_order_by < $pos_to) && ($pos_order_by != false)) {
                $pos_to = $pos_order_by;
            }

            if (strpos(strtolower($this->sql_query), 'distinct') || strpos(strtolower($this->sql_query), 'group by')) {
                $count_string = 'distinct ' . tep_db_input($count_key);
            } else {
                $count_string = tep_db_input($count_key);
            }

            $count_query = tep_db_query("select count(" . $count_string . ") as total " . substr($this->sql_query, $pos_from, ($pos_to - $pos_from)));
            $count = tep_db_fetch_array($count_query);

            $this->number_of_rows = $count['total'];
        } else {
            $this->number_of_rows = $number_of_rows;
        }

        $this->number_of_pages = ceil($this->number_of_rows / $this->number_of_rows_per_page);

        if ($this->current_page_number > $this->number_of_pages && $this->number_of_pages > 0) {
            if (!empty($_GET['cPath'])) {
                tep_redirect(tep_href_link(FILENAME_DEFAULT, 'cPath=' . $_GET['cPath']));
                die;
            } elseif (!empty($_GET['tPath'])) {
                tep_redirect(tep_href_link(FILENAME_ARTICLES, 'tPath=' . $_GET['tPath']));
                die;
            }
            $this->current_page_number = $this->number_of_pages;
        }

        $offset = ($this->number_of_rows_per_page * ($this->current_page_number - 1));

        $this->sql_query .= " limit " . max($offset, 0) . ", " . $this->number_of_rows_per_page;
    }

/* class functions */

// display split-page-number-links
    function display_links($max_page_links, $parameters = '', $tagType = 'a')
    {
        global $PHP_SELF, $request_type, $isFilter,$redirectOptionsIdsArrayForCheck, $addPage;

        $tmpAddPage = $addPage;
        $addPage    = false;
        $setAlternate = true;
        $baseUrl =  getFilterUrl($_GET['cPath'], (isset($_GET['filter_id']) ? $_GET['filter_id'] : ''), $redirectOptionsIdsArrayForCheck);
        $parsedUrl = parse_url($baseUrl);
        $concatSign = !empty($parsedUrl['query']) ? "&" : "?";
        $setAlternate = false;
        $display_links_string = '<nav><ul class="pagination pagination-sm">';
// BOM Mod:allow for a call when there are no rows to be displayed
        if ($this->number_of_pages > 0) {
            if (tep_not_null($parameters) && (substr($parameters, -1) != '&')) {
                $parameters .= '&';
            }

  // previous button - not displayed on first page
            if ($this->current_page_number > 1) {
                if ($this->current_page_number == 2) {
                    if ($isFilter) {
                          $url = $baseUrl;
                    } else {
                        $url = tep_href_link(basename($PHP_SELF), $parameters, $request_type);
                    }
                    $display_links_string .= '<li><' . $tagType . ' ' . ($tagType != 'span' ? 'rel="prev"' : '') . ' class="prev_page" href="' . $url . '" title=" ' . PREVNEXT_TITLE_PREVIOUS_PAGE . ' "><svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"></path></svg></' . $tagType . '></li>';
                } else {
                    if ($isFilter) {
                        $url = $baseUrl . $concatSign . "{$this->page_name}=" . ($this->current_page_number - 1);
                    } else {
                        $url = tep_href_link(basename($PHP_SELF), $parameters . $this->page_name . '=' . ($this->current_page_number - 1), $request_type);
                    }
                    $display_links_string .= '<li><' . $tagType . ' class="prev_page" href="' . $url . '" title=" ' . PREVNEXT_TITLE_PREVIOUS_PAGE . ' "><svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"></path></svg></' . $tagType . '></li>';
                }
            }
  // check if number_of_pages > $max_page_links
            $cur_window_num = intval($this->current_page_number / $max_page_links);
            if ($this->current_page_number % $max_page_links) {
                $cur_window_num++;
            }

            $max_window_num = intval($this->number_of_pages / $max_page_links);
            if ($this->number_of_pages % $max_page_links) {
                $max_window_num++;
            }

  // previous window of pages
            if ($cur_window_num > 1) {
                if ($isFilter) {
                    $url = $baseUrl . $concatSign . "{$this->page_name}=" . (($cur_window_num - 1) * $max_page_links);
                } else {
                    $url = tep_href_link(basename($PHP_SELF), $parameters . $this->page_name . '=' . (($cur_window_num - 1) * $max_page_links), $request_type);
                }
                $display_links_string .= '<li><' . $tagType . ' href="' . $url . '" title=" ' . sprintf(PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE, $max_page_links) . ' ">...</' . $tagType . '></li>';
            }
  // page nn button
            for ($jump_to_page = 1 + (($cur_window_num - 1) * $max_page_links); ($jump_to_page <= ($cur_window_num * $max_page_links)) && ($jump_to_page <= $this->number_of_pages); $jump_to_page++) {
                if ($jump_to_page == $this->current_page_number) {
                    $display_links_string .= '<li class="active"><span href="#" onclick="return false">' . $jump_to_page . '</span></li>';
                } else {
                    if ($jump_to_page != 1) {
                        $add_page_name = $this->page_name . '=' . $jump_to_page;
                    } else {
                        $add_page_name = '';
                    }

                    if ($jump_to_page == ($this->current_page_number - 1)) {
                        $rel_prev_next = 'rel="prev"';
                    } elseif ($jump_to_page == ($this->current_page_number + 1)) {
                        $rel_prev_next = 'rel="next"';
                    } else {
                        $rel_prev_next = '';
                    }
                    if ($isFilter) {
                        $url = $baseUrl . ($add_page_name ? $concatSign . "$add_page_name" : '');
                    } else {
                        $url = tep_href_link(basename($PHP_SELF), $parameters . $add_page_name, $request_type);
                    }
                    $display_links_string .= '<li><' . $tagType . ' ' . ($tagType != 'span' ? $rel_prev_next : '') . ' href="' . $url . '" title=" ' . sprintf(PREVNEXT_TITLE_PAGE_NO, $jump_to_page) . ' ">' . $jump_to_page . '</' . $tagType . '></li>';
                }
            }

  // next window of pages
            if ($cur_window_num < $max_window_num) {
                if ($isFilter) {
                    $url = $baseUrl . $concatSign . "{$this->page_name}=" . (($cur_window_num) * $max_page_links + 1);
                } else {
                    $url = tep_href_link(basename($PHP_SELF), $parameters . $this->page_name . '=' . (($cur_window_num) * $max_page_links + 1), $request_type);
                }
                $display_links_string .= '<li><' . $tagType . ' href="' . $url . '" title=" ' . sprintf(PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE, $max_page_links) . ' ">...</' . $tagType . '></li>';
            }
  // next button
            if (($this->current_page_number < $this->number_of_pages) && ($this->number_of_pages != 1)) {
                if ($isFilter) {
                    $url = $baseUrl . $concatSign . "{$this->page_name}=" . ($this->current_page_number + 1);
                } else {
                    $url = tep_href_link(basename($PHP_SELF), $parameters . $this->page_name . '=' . ($this->current_page_number + 1), $request_type);
                }
                $display_links_string .= '<li><' . $tagType . ' ' . ($tagType != 'span' ? 'rel="next"' : '') . ' class="next_page" href="' . $url . '" title=" ' . PREVNEXT_TITLE_NEXT_PAGE . ' "><svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg></' . $tagType . '></li>';
            }
        } else {  // if zero rows, then simply say that
            $display_links_string .= '</ul></div>';
        }
        $addPage = $tmpAddPage;
// EMO Mod
        return $display_links_string;
    }

// display number of total products found
    function display_count($text_output)
    {
        $to_num = ($this->number_of_rows_per_page * $this->current_page_number);
        if ($to_num > $this->number_of_rows) {
            $to_num = $this->number_of_rows;
        }

        $from_num = ($this->number_of_rows_per_page * ($this->current_page_number - 1));

        if ($to_num == 0) {
            $from_num = 0;
        } else {
            $from_num++;
        }

        return sprintf($text_output, $from_num, $to_num, $this->number_of_rows);
    }
}
