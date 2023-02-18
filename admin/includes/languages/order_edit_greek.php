<?php
/*
  $Id: order_edit_english.php,v 1.1 2003/09/24 14:33:18 wilt Exp $

  
  Contribution based on:
  
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 - 2003 osCommerce

  Released under the GNU General Public License
*/

// pull down default text
define('PULL_DOWN_DEFAULT', 'Παρακαλώ επιλέξτε');
define('TYPE_BELOW', 'Πληκτρολογήστε παρακάτω');

define('JS_ERROR', 'Σφάλματα παρουσιάστηκαν κατά τη διαδικασία της φόρμας σας! \ NΠαρακαλώ κάνετε τις παρακάτω διορθώσεις: \ n \ n ');

define('JS_FIRST_NAME', '* The \'Ονομα\'η είσοδος πρέπει να έχει τουλάχιστον'. ENTRY_FIRST_NAME_MIN_LENGTH. ' χαρακτήρες. \ n');
define('JS_LAST_NAME', '* The \'Επίθετο\' η είσοδος πρέπει να έχει τουλάχιστον ' . ENTRY_LAST_NAME_MIN_LENGTH . ' χαρακτήρες.\n');
define('JS_DOB', '* The \'ΗΜΕΡΟΜΗΝΙΑ ΓΕΝΝΗΣΗΣ\' η είσοδος πρέπει να είναι στη μορφή: xx/xx/xxxx (Μηνας /μερα/ Ετος).\n');
define('JS_EMAIL_ADDRESS', '* Ή \'Διεύθυνση ηλεκτρονικού ταχυδρομείου\' η είσοδος πρέπει να έχει τουλάχιστον ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' χαρακτήρες.\n');
define('JS_ADDRESS', '* Η \'Διεύθυνση\' η είσοδος πρέπει να έχει τουλάχιστον' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' χαρακτήρες.\n');
define('JS_POST_CODE', '* Ο \'ΤΑΧΥΔΡΟΜΙΚΟΣ ΚΩΔΙΚΟΣ\' η είσοδος πρέπει να έχει τουλάχιστον' . ENTRY_POSTCODE_MIN_LENGTH . ' χαρακτήρες.\n');
define('JS_CITY', '* The \'Περιοχη\' η είσοδος πρέπει να έχει τουλάχιστον ' . ENTRY_CITY_MIN_LENGTH . ' χαρακτήρες.\n');
define('JS_STATE', '* Η \'ΠΕΡΙΟΧΗ\' η είσοδος πρέπει να επιλεγεί.\n');
define('JS_STATE_SELECT', '-- Επιλέξτε παραπάνω --');
define('JS_ZONE', '* Η \'ΠΟΛΗ\' η είσοδος πρέπει να επιλεγεί από τη λίστα για αυτήν τη χώρα.\n');
define('JS_COUNTRY', '* ΧΩΡΑ \'ΧΩΡΑ\' η είσοδος πρέπει να επιλεγεί.\n');
define('JS_TELEPHONE', '* Ο \'TΑριθμός τηλεφώνου\' η είσοδος πρέπει να έχει τουλάχιστον ' . ENTRY_TELEPHONE_MIN_LENGTH . ' χαρακτήρες.\n');
define('JS_PASSWORD', '* Ο \'Κωδικός πρόσβασης\' ΚΑΙ \'Η Επιβεβαίωση\'οι καταχωρήσεις πρέπει να ταιριάζουν και να έχουν τουλάχιστον ' . ENTRY_PASSWORD_MIN_LENGTH . ' χαρακτήρες.\n');

define('CATEGORY_COMPANY', 'ΣΤΟΙΧΕΙΑ ΕΤΑΙΡΕΙΑΣ');
define('CATEGORY_PERSONAL', 'Προσωπικές λεπτομέρειες');
define('CATEGORY_ADDRESS', 'Διεύθυνση');
define('CATEGORY_CONTACT', 'Στοιχεία επικοινωνίας');
define('CATEGORY_OPTIONS', 'Επιλογές');
define('CATEGORY_CORRECT', 'Εάν αυτός είναι ο σωστός πελάτης, πατήστε το κουμπί Επιβεβαίωση παρακάτω.');
define('ENTRY_CUSTOMERS_ID', 'ταυτότητα:');
define('ENTRY_CUSTOMERS_ID_TEXT', '&nbsp;<small> <font color = "# AABBDD"> απαιτείται </ font> </ small> ');
define('ENTRY_COMPANY', 'ΣΤΟΙΧΕΙΑ ΕΤΑΙΡΕΙΑΣ:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_FIRST_NAME', 'Ονομα:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' χαρακτήρες</font></small>');
define('ENTRY_FIRST_NAME_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_LAST_NAME', 'Επίθετο:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' chars</font></small>');
define('ENTRY_LAST_NAME_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_DATE_OF_BIRTH', 'ΗΜΕΡΟΜΗΝΙΑ ΓΕΝΝΗΣΗΣ:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<small><font color="#FF0000">(eg. 05/21/1970)</font></small>');
define('ENTRY_DATE_OF_BIRTH_TEXT', '&nbsp;<small>(eg. 05/21/1970) <font color="#AABBDD">required</font></small>');
define('ENTRY_EMAIL_ADDRESS', 'Διεύθυνση ηλεκτρονικού ταχυδρομείου:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' χαρακτήρες</font></small>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<small><font color="#FF0000">Η διεύθυνση ηλεκτρονικού ταχυδρομείου σας δεν φαίνεται να είναι έγκυρη!</font></small>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<small><font color="#FF0000">η διεύθυνση ηλεκτρονικού ταχυδρομείου υπάρχει ήδη!</font></small>');
define('ENTRY_EMAIL_ADDRESS_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_STREET_ADDRESS', 'Διεύθυνση:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' χαρακτήρες</font></small>');
define('ENTRY_STREET_ADDRESS_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_SUBURB', 'Περιοχη:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'ΤΑΧΥΔΡΟΜΙΚΟΣ ΚΩΔΙΚΟΣ:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' χαρακτήρες</font></small>');
define('ENTRY_POST_CODE_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_CITY', 'Προάστιο:');
define('ENTRY_CITY_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_CITY_MIN_LENGTH . ' χαρακτήρες</font></small>');
define('ENTRY_CITY_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_STATE', 'Πόλη:');
define('ENTRY_STATE_ERROR', '&nbsp;<small><font color="#FF0000">required</font></small>');
define('ENTRY_STATE_ERROR_SELECT', 'Πολη-Περιοχη.');
define('ENTRY_STATE_TEXT', '*');
define('ENTRY_COUNTRY', 'Χωρα:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_COUNTRY_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_TELEPHONE_NUMBER', 'Αριθμός τηλεφώνου:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' chars</font></small>');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_FAX_NUMBER', 'Αριθμός φαξ:');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Ενημερωτικό δελτίο:');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'Εγγραφή');
define('ENTRY_NEWSLETTER_NO', 'Δεν έχει εγγραφεί');
define('ENTRY_PASSWORD', 'Κωδικός πρόσβασης:');
define('ENTRY_PASSWORD_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_PASSWORD_MIN_LENGTH . ' χαρακτήρες</font></small>');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'Οπότε οι υπογραμμίζετε ότι έχετε συμπληρώσει την παραγγελία σας.');
define('ENTRY_PASSWORD_CONFIRMATION', 'Επιβεβαίωση κωδικού πρόσβασης:');
define('ENTRY_PASSWORD_CURRENT', 'Τρέχων κωδικός πρόσβασης:');
define('ENTRY_PASSWORD_CURRENT_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_PASSWORD_MIN_LENGTH . ' chars</font></small>');
define('ENTRY_PASSWORD_NEW', 'Νέος Κωδικός:');
define('ENTRY_PASSWORD_NEW_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_PASSWORD_MIN_LENGTH . ' chars</font></small>');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'Οι κωδικοί πρόσβασης δεν συμφωνούν.');

// manual order box text in includes/boxes/manual_order.php

define('BOX_HEADING_MANUAL_ORDER', 'Μη αυτοματοποιημένες παραγγελίες');
define('BOX_MANUAL_ORDER_CREATE_ACCOUNT', 'Δημιουργήστε λογαριασμό');
define('BOX_MANUAL_ORDER_CREATE_ORDER', 'Δημιουργία παραγγελίας');
?>