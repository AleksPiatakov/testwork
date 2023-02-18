<?php
/*
  $Id: coupon_admin.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Κουπόνια έκπτωσης');
define('HEADING_TITLE_STATUS', 'Κατάσταση : ');
define('TEXT_CUSTOMER', 'Πελάτης:');
define('TEXT_COUPON', 'Όνομα κουπονιού');
define('TEXT_COUPON_ALL', 'Όλα τα κουπόνια');
define('TEXT_COUPON_ACTIVE', 'Ενεργοποιηση των κουπόνιων');
define('TEXT_COUPON_INACTIVE', 'Απενεργοποιηση των κουπόνιων');
define('TEXT_SUBJECT', 'ΜΕ Θέμα:');
define('TEXT_FROM', 'ΑΠΟ! ');
define('TEXT_FREE_SHIPPING', 'Δωρεαν Αποστολή');
define('TEXT_MESSAGE', 'Μήνυμα:');
define('TEXT_SELECT_CUSTOMER', 'Επιλέξτε Πελάτη');
define('TEXT_ALL_CUSTOMERS', 'Όλοι οι πελάτες');
define('TEXT_NEWSLETTER_CUSTOMERS', 'Για όλους τους συνδρομητές Newsletter');
define('TEXT_CONFIRM_DELETE', 'Είστε βέβαιοι ότι θέλετε να διαγράψετε αυτό το κουπόνι?');

define('TEXT_TO_REDEEM', 'Μπορείτε να εξαργυρώσετε αυτό το κουπόνι κατά το checkout. Απλώς πληκτρολογήστε τον κωδικό στο πλαίσιο που παρέχεται και κάντε κλικ στο κουμπί εξαργύρωσης.');
define('TEXT_IN_CASE', ' σε περίπτωση που έχετε καποιο θέμα. ');
define('TEXT_VOUCHER_IS', 'Ο κωδικός κουπονιού είναι ');
define('TEXT_REMEMBER', 'Μην χάσετε τον κωδικό κουπονιού, βεβαιωθείτε ότι έχετε κρατήσει τον κωδικό ασφαλές ώστε να μπορείτε να επωφεληθείτε από αυτή την ειδική προσφορά.');
define('TEXT_VISIT', 'και όταν μας επισκέπτεστε ' . HTTP_SERVER . DIR_WS_CATALOG);
define('TEXT_ENTER_CODE', ' να εισάγετε τον κωδικό ');

define('TABLE_HEADING_ACTION', 'Δράση');

define('CUSTOMER_ID', 'Κωδικός πελάτη');
define('CUSTOMER_NAME', 'Όνομα πελάτη');
define('REDEEM_DATE', 'Ημερομηνία Εξαργύρωσης');
define('IP_ADDRESS', 'Διεύθυνση IP');

define('TEXT_REDEMPTIONS', 'εξαργύρωσις');
define('TEXT_REDEMPTIONS_TOTAL', 'Συνολικά');
define('TEXT_REDEMPTIONS_CUSTOMER', 'Για αυτόν τον Πελάτη');
define('TEXT_NO_FREE_SHIPPING', 'Δεν υπάρχει δωρεάν αποστολή');

define('NOTICE_EMAIL_SENT_TO', 'Σημείωση: Το ηλεκτρονικό ταχυδρομείο στάλθηκε στο: %s');
define('ERROR_NO_CUSTOMER_SELECTED', 'Σφάλμα: Δεν έχει επιλεγεί πελάτης.');
define('COUPON_NAME', 'Όνομα κουπονιού');
//define('COUPON_VALUE', 'Coupon Value');
define('COUPON_AMOUNT', 'Ποσό κουπονιού');
define('COUPON_CODE', 'Κωδικός κουπονιού');
define('COUPON_STARTDATE', 'Ημερομηνία έναρξης');
define('COUPON_FINISHDATE', 'Ημερομηνία λήξης');
define('COUPON_FREE_SHIP', 'Δωρεάν αποστολή');
define('COUPON_FOR_EVERY_PRODUCT', 'Χρησιμοποιήστε για κάθε κατάλληλο προϊόν');
define('COUPON_DESC', 'Περιγραφή κουπονιού');
define('COUPON_MIN_ORDER', 'Ελάχιστη αξια παραγγελίας κουπονιού');
define('COUPON_USES_COUPON', 'ποσες Χρήσεις ανά Κουπόνι');
define('COUPON_USES_USER', 'Χρήσεις του ιδιου κουπονιού ανά πελάτη');
define('COUPON_PRODUCTS', 'για ποια Έγκυρη Λίστα Προϊόντων');
define('COUPON_CATEGORIES', 'για ποια Λίστα έγκυρων κατηγοριών');
define('VOUCHER_NUMBER_USED', 'ποσους  Αριθμός που χρησιμοποιείται');
define('DATE_CREATED', 'Ημερομηνία Δημιουργίας');
define('DATE_MODIFIED', 'Ημερομηνία τροποποίησης');
define('TEXT_HEADING_NEW_COUPON', 'Δημιουργία νέου κουπονιού');
define('TEXT_NEW_INTRO', 'Συμπληρώστε τις παρακάτω πληροφορίες για το νέο κουπόνι.<br>');

define('COUPON_BUTTON_PREVIEW', 'Προεπισκόπηση');
define('COUPON_BUTTON_CONFIRM', 'Επιβεβαιώση');
define('COUPON_BUTTON_BACK', 'Πισω');

define('ERROR_NO_COUPON_AMOUNT', 'Σφάλμα!!!!!: Δεν υπάρχει αξια κουπονιού');
define('ERROR_NO_COUPON_NAME', 'Σφάλμα!!!!!. Δεν υπάρχει όνομα κουπονιού');
define('ERROR_COUPON_EXISTS', 'Σφάλμα!!!!!: Το κουπόνι υπάρχει ήδη');

define('COUPON_VIEW', 'ΘΕΑΣΗ');

define('COUPON_NAME_HELP', 'Ένα σύντομο όνομα για το κουπόνι ');
define('COUPON_AMOUNT_HELP', 'Η αξία της έκπτωσης για το κουπόνι, είτε ειναι  απόλυτη σε αξια είτε ειναι σε ποσοστο % για μια έκπτωση από το σύνολο της παραγγελίας.');
define('COUPON_CODE_HELP', 'Μπορείτε να εισάγετε τον δικό σας κωδικό εδώ, ή να αφήσετε κενό για ένα αυτόματα δημιουργημένο.');
define('COUPON_STARTDATE_HELP', 'Η ημερομηνία από την οποία ( αρχίζει να ) ισχύει το κουπόνι');
define('COUPON_FINISHDATE_HELP', 'Η ημερομηνία λήξης του κουπονιού');
define('COUPON_FREE_SHIP_HELP', 'Το κουπόνι δίνει δωρεάν παράδοση με παραγγελία. Σημείωση: Αυτό παρακάμπτει το μέγεθος (αξια) κουπονιού, αλλά σέβεται την ελάχιστη τιμή παραγγελίας');
define('COUPON_FOR_EVERY_PRODUCT_HELP', 'Η έκπτωση κουπονιού θα εφαρμοστεί σε κάθε κατάλληλο στοιχείο στο καλάθι. Η επιλογή λειτουργεί μόνο εάν υπάρχει περιορισμός στο προϊόν ή την κατηγορία.');
define('COUPON_DESC_HELP', 'Περιγραφή του κουπονιού για τον πελάτη');
define('COUPON_MIN_ORDER_HELP', 'Η ελάχιστη αξια της παραγγελίας πριν το κουπόνι είναι έγκυρη');
define('COUPON_USES_COUPON_HELP', 'Ο μέγιστος αριθμός ( σε) φορές που μπορεί να χρησιμοποιηθεί (αυτο )το κουπόνι. αφήστε κενό εάν δεν θέλετε όριο.');
define('COUPON_USES_USER_HELP', 'Πόσες φορές ένας χρήστης μπορεί να χρησιμοποιήσει το κουπόνι, αφήστε κενό για κανένα όριο.');
define('COUPON_PRODUCTS_HELP', 'ενα κομμα χωριζει την λιστα προιοντων απο τον αριθμό χρησεων των κουπωνιων )Μια λίστα προϊόντων_ιδίων που χωρίζετε με κόμμα και τα οποία μπορεί να χρησιμοποιηθεί με αυτό το κουπόνι!!!. Αφήστε κενό για να μην υπάρχουν περιορισμοί  .');
define('COUPON_CATEGORIES_HELP', 'Μια λίστα διαχωρισμένων με κόμμα των cpa ths που μπορεί να χρησιμοποιηθεί με αυτό το κουπόνι, αφήστε κενό χωρίς περιορισμούς.');

define('TEXT_TOOLTIP_VOUCHER_EMAIL', 'Αποστολή κουπονιου μεσω emall');
define('TEXT_TOOLTIP_VOUCHER_EDIT', 'Επεξεργασία κουπονιού');
define('TEXT_TOOLTIP_VOUCHER_DELETE', 'Διαγραφή κουπονιού');
define('TEXT_TOOLTIP_VOUCHER_REPORT', 'Έκθεση (αναλυση ) κουπονιού');
