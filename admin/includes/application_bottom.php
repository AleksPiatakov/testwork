<?php
/*
  $Id: application_bottom.php,v 1.2 2003/09/24 13:57:07 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

// close session (store variables)
tep_session_close();

if (STORE_PAGE_PARSE_TIME == 'true') {
    echo "Page Time:" . round((microtime(true) - PAGE_PARSE_START_TIME), 2);
}
?>
