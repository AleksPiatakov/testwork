<?php
/*
  $Id: password_forgotten.php,v 1.8 2003/06/09 22:46:46 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Login');
define('NAVBAR_TITLE_2', 'Password Forgotten');

define('HEADING_TITLE', 'I\'ve Forgotten My Password!');

define('TEXT_MAIN', 'If you\'ve forgotten your password, enter your e-mail address below and we\'ll send you an e-mail message containing your new password.');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', 'Error: The E-Mail Address was not found in our records, please try again.');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - New Password');
define('EMAIL_PASSWORD_REMINDER_BODY', 'A new password was requested from ');
define('EMAIL_PASSWORD_REMINDER_BODY2', 'Your new password to \'' . STORE_NAME . '\' is:' . '   %s');
define('SUCCESS_PASSWORD_SENT', 'Success: A new password has been sent to your e-mail address.');
define('SUCCESS_PASSWORD_TOKEN_SENT', 'Success: A password reset link has been sent to your email address.');
define('EMAIL_PASSWORD_REMINDER_SUBJECT2', STORE_NAME . ' - request for change password');
define('EMAIL_PASSWORD_REMINDER_BODY3', 'if you did it, please follow the link below and password will be changed');
define('EMAIL_TOKEN_ERROR', 'The token is no longer valid');