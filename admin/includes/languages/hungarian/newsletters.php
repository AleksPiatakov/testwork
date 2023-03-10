<?php
/*
  $Id: newsletters.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Newsletter Manager');

define('TABLE_HEADING_NEWSLETTERS', 'Newsletters');
define('TABLE_HEADING_SIZE', 'Size');
define('TABLE_HEADING_MODULE', 'Module');
define('TABLE_HEADING_SENT', 'Sent');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Action');

define('TEXT_NEWSLETTER_MODULE', 'Module:');
define('TEXT_NEWSLETTER_TITLE', 'Newsletter Title:');
define('TEXT_NEWSLETTER_CONTENT', 'Content:');

define('TEXT_NEWSLETTER_DATE_ADDED', 'Date Added:');
define('TEXT_NEWSLETTER_DATE_SENT', 'Date Sent:');

define('TEXT_COUNT_CUSTOMERS_RECEIVE', 'Customers receiving newsletter:');

define('TEXT_INFO_DELETE_INTRO', 'Are you sure you want to delete this newsletter?');

define('TEXT_PLEASE_WAIT', 'Please wait .. sending emails ..<br><br>Please do not interrupt this process!');
define('TEXT_FINISHED_SENDING_EMAILS', 'Finished sending e-mails!');

define('ERROR_NEWSLETTER_TITLE', 'Error: Newsletter title required');
define('ERROR_NEWSLETTER_MODULE', 'Error: Newsletter module required');
define('ERROR_REMOVE_UNLOCKED_NEWSLETTER', 'Error: Please lock the newsletter before deleting it.');
define('ERROR_EDIT_UNLOCKED_NEWSLETTER', 'Error: Please lock the newsletter before editing it.');
define('ERROR_SEND_UNLOCKED_NEWSLETTER', 'Error: Please lock the newsletter before sending it.');

//Button
define('BUTTON_CANCEL_NEW', 'cancel');
define('BUTTON_EDIT_NEW', 'edit');
define('BUTTON_UNLOCK_NEW', 'unlock');
define('BUTTON_PREVIEW_NEW', 'preview');
define('BUTTON_BACK_NEW', 'back');
define('BUTTON_NEWSLETTER_NEW', 'newsletter');
define('BUTTON_DELETE_NEW', 'delete');
define('BUTTON_LOCK_NEW', 'lock');
define('BUTTON_SEND_NEW', 'send');
?>