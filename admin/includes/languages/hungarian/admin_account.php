<?php
/*
  $Id: admin_account.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Admin Account');

define('TABLE_HEADING_ACCOUNT', 'My Account');

define('TEXT_INFO_FULLNAME', '<b>Name: </b>');
define('TEXT_INFO_FIRSTNAME', '<b>Firstname: </b>');
define('TEXT_INFO_LASTNAME', '<b>Lastname: </b>');
define('TEXT_INFO_EMAIL', '<b>Email Address: </b>');
define('TEXT_INFO_PASSWORD', '<b>Password: </b>');
define('TEXT_INFO_PASSWORD_CONFIRM', '<b>Confirm Password: </b>');
define('TEXT_INFO_CREATED', '<b>Account Created: </b>');
define('TEXT_INFO_LOGDATE', '<b>Last Access: </b>');
define('TEXT_INFO_LOGNUM', '<b>Log Number: </b>');
define('TEXT_INFO_GROUP', '<b>Group Level: </b>');
define('TEXT_INFO_ERROR', 'Email address has already been used! Please try again.');
define('TEXT_INFO_MODIFIED', 'Modified: ');
define('TEXT_INFO_PASSWORD_HIDDEN', '**************');

define('TEXT_INFO_HEADING_DEFAULT', 'Edit Account ');
define('TEXT_INFO_HEADING_CONFIRM_PASSWORD', 'Password Confirmation ');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD', 'Password:');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD_ERROR', '<b>ERROR:</b> wrong password!');
define('TEXT_INFO_INTRO_DEFAULT', 'Click <b>edit button</b> below to change your account.');
define('TEXT_INFO_INTRO_DEFAULT_FIRST_TIME', '<br><b>WARNING:</b><br>Hello <b>%s</b>, you just come here for the first time. We recommend you to change your password!');
define('TEXT_INFO_INTRO_DEFAULT_FIRST', '<br><b>WARNING:</b><br>Hello <b>%s</b>, we recommend you to change your email (admin@localhost) and password!');
define('TEXT_INFO_INTRO_EDIT_PROCESS', 'All fields are required. Click save to submit.');

define('JS_ALERT_FIRSTNAME', '- Required: Firstname \n');
define('JS_ALERT_LASTNAME', '- Required: Lastname \n');
define('JS_ALERT_EMAIL', '- Required: Email address \n');
define('JS_ALERT_PASSWORD', '- Required: Password \n');
define('JS_ALERT_FIRSTNAME_LENGTH', '- Firstname length must over ');
define('JS_ALERT_LASTNAME_LENGTH', '- Lastname length must over ');
define('JS_ALERT_PASSWORD_LENGTH', '- Password length must over ');
define('JS_ALERT_EMAIL_FORMAT', '- Email address format is invalid! \n');
define('JS_ALERT_EMAIL_USED', '- Email address has already been used! \n');
define('JS_ALERT_PASSWORD_CONFIRM', '- Miss typing in Password Confirmation field! \n');

define('ADMIN_EMAIL_SUBJECT', 'Personal Information Change');
define('ADMIN_EMAIL_TEXT', 'Hi %s,' . "\n\n" . 'Your personal information, perhaps including your password, has been changed.  If this was done without your knowledge or consent please contact the administrator immediatly!' . "\n\n" . 'Website : %s' . "\n" . 'Username: %s' . "\n" . 'Password: %s' . "\n\n" . 'Thanks!' . "\n" . '%s' . "\n\n" . 'This is an automated response, please do not reply!');

//Button
define('BUTTON_BACK_NEW', 'back');