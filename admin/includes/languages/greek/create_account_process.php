<?php
/*
  $Id: create_account_process.php,v 1.1 2003/09/24 14:33:18 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/
define('NAVBAR_TITLE', 'Δημιουργία λογαριασμού');
define('HEADING_TITLE', 'Πληροφορίες λογαριασμού');
define('HEADING_NEW', 'Διαδικασία παραγγελίας');
define('NAVBAR_NEW_TITLE', 'Διαδικασία παραγγελίας');

define('EMAIL_SUBJECT', 'Καλωσήρθατε στο ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Αγαπητέ κύριε. ' . stripslashes($_POST['Επίθετο']) . ',' . "\n\n");
define('EMAIL_GREET_MS', 'Αγαπητή κυρία. ' . stripslashes($_POST['Επίθετο']) . ',' . "\n\n");
define('EMAIL_GREET_NONE', 'Αγαπητέ ' . stripslashes($_POST['Ονομα']) . ',' . "\n\n");
define('EMAIL_WELCOME', 'Σας καλωσορίζουμε στο <b>' . STORE_NAME . '</b>.' . "\n\n");
define('EMAIL_TEXT', 'You can now take part in the <b>various services</b> we have to offer you. Some of these services include:' . "\n\n" . '<li><b>Permanent Cart</b> - Any products added to your online cart remain there until you remove them, or check them out.' . "\n" . '<li><b>Address Book</b> - We can now deliver your products to another address other than yours! This is perfect to send birthday gifts direct to the birthday-person themselves.' . "\n" . '<li><b>Order History</b> - View your history of purchases that you have made with us.' . "\n" . '<li><b>Products Reviews</b> - Share your opinions on products with our other customers.' . "\n\n");
define('EMAIL_CONTACT', 'For help with any of our online services, please email the store-owner: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<b>Note:</b> This email address was given to us by one of our customers. If you did not signup to be a member, please send a email to ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");

define('EMAIL_PASS_1', 'Your password ');
define('EMAIL_PASS_2', ", don't forget it!" . "\n\n");
?>