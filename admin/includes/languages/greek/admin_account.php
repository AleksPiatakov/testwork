<?php
/*
  $Id: admin_account.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Λογαριασμός διαχειριστή');

define('TABLE_HEADING_ACCOUNT', 'Ο Λογαρισμός μου');

define('TEXT_INFO_FULLNAME', '<b>ΟΝΟΜΑ: </b>');
define('TEXT_INFO_FIRSTNAME', '<b>Όνομα: </b>');
define('TEXT_INFO_LASTNAME', '<b>Επίθετο: </b>');
define('TEXT_INFO_EMAIL', '<b>Διεύθυνση email: </b>');
define('TEXT_INFO_PASSWORD', '<b>Κωδικός password: </b>');
define('TEXT_INFO_PASSWORD_CONFIRM', '<b>Επιβεβαιώστε Password: </b>');
define('TEXT_INFO_CREATED', '<b>Ο Λογαριασμός σας Δημιουργήθηκε: </b>');
define('TEXT_INFO_LOGDATE', '<b>Τελευταία πρόσβαση: </b>');
define('TEXT_INFO_LOGNUM', '<b>Αριθμός καταγραφής αρχείου: </b>');
define('TEXT_INFO_GROUP', '<b>Ομαδικό επίπεδο: </b>');
define('TEXT_INFO_ERROR', 'Η διεύθυνση ηλεκτρονικού ταχυδρομείου έχει ήδη χρησιμοποιηθεί! ΠΑΡΑΚΑΛΩ προσπαθησε ξανα.');
define('TEXT_INFO_MODIFIED', 'Τροποποιήθηκε: ');
define('TEXT_INFO_PASSWORD_HIDDEN', '**************');

define('TEXT_INFO_HEADING_DEFAULT', 'Επεξεργασία λογαριασμού ');
define('TEXT_INFO_HEADING_CONFIRM_PASSWORD', 'Επιβεβαίωση κωδικού πρόσβασης ');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD', 'Κωδικός πρόσβασης:');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD_ERROR ',' <b> Σφάλμα: </b> λάθος κωδικός πρόσβασης! ');
define('TEXT_INFO_INTRO_DEFAULT ',' Κάντε κλικ στο <b> κουμπί επεξεργασίας </b> παρακάτω για να αλλάξετε το λογαριασμό σας. ');
define('TEXT_INFO_INTRO_DEFAULT_FIRST_TIME ',' <br> <b> ΠΡΟΕΙΔΟΠΟΙΗΣΗ: </b> <br> Γεια σας, <b>% s </b>, έρχεστε εδώ για πρώτη φορά. Σας συνιστούμε να αλλάξετε τον κωδικό πρόσβασής σας! ');
define('TEXT_INFO_INTRO_DEFAULT_FIRST', '<br><b>ΠΡΟΕΙΔΟΠΟΙΗΣΗ: </b> <br> Γεια σας, <b>% s </b>, σας συνιστούμε να αλλάξετε το email σας (admin @ localhost) και τον κωδικό πρόσβασης! ');
define('TEXT_INFO_INTRO_EDIT_PROCESS ',' Όλα τα πεδία είναι υποχρεωτικά. Κάντε κλικ στην αποθήκευση για να υποβάλετε. ');

define('JS_ALERT_FIRSTNAME ',' - Απαιτείται: Όνομα \ n ');
define('JS_ALERT_LASTNAME ',' - Απαιτείται: Επώνυμο \ n ');
define('JS_ALERT_EMAIL ',' - Απαιτείται: Διεύθυνση ηλεκτρονικού ταχυδρομείου \ n ');
define('JS_ALERT_PAPASSWORD ',' - Απαιτείται: Κωδικός πρόσβασης \ n ');
define('JS_ALERT_FIRSTNAME_LENGTH ',' - Το μήκος του ονόματος πρέπει να είναι πάνω από ');
define('JS_ALERT_LASTNAME_LENGTH ',' - Το μήκος του επώνυμου πρέπει να είναι πάνω από ');
define('JS_ALERT_PASSWORD_LENGTH ',' - Το μήκος του κωδικού πρόσβασης πρέπει να είναι πάνω από ');
define('JS_ALERT_EMAIL_FORMAT ',' - Η μορφή διεύθυνσης ηλεκτρονικού ταχυδρομείου δεν είναι έγκυρη! \ n ');
define('JS_ALERT_EMAIL_USED ',' - Η διεύθυνση ηλεκτρονικού ταχυδρομείου έχει ήδη χρησιμοποιηθεί! \ n ');
define('JS_ALERT_PASSWORD_CONFIRM ',' - Μήπως πληκτρολογείτε το πεδίο επιβεβαίωσης κωδικού πρόσβασης! \ n ');

define('ADMIN_EMAIL_SUBJECT', 'Αλλαγή προσωπικών πληροφοριών');
define('ADMIN_EMAIL_TEXT', 'Hi %s,' . "\n\n" . 'Τα προσωπικά σας στοιχεία, ίσως συμπεριλαμβανομένου του κωδικού πρόσβασής σας, έχουν αλλάξει. Εάν αυτό έγινε χωρίς τη γνώση ή τη συγκατάθεσή σας, επικοινωνήστε αμέσως με τον διαχειριστή!' . "\n\n". 'Ιστοσελίδα:% s'. "\n". 'Όνομα χρήστη:% s'. "\n". 'Κωδικός πρόσβασης:% s'. "\n\n". 'Ευχαριστώ!' . "\n". '% s'. "\n\n". 'Αυτή είναι μια αυτοματοποιημένη απάντηση, παρακαλώ μην απαντήσετε!');
