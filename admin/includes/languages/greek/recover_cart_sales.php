<?php
/*
  $Id$
  Recover Cart Sales v 1.4 ENGLISH Language File

  Recover Cart Sales contrib: JM Ivler (c)
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Released under the GNU General Public License

*/

define('MESSAGE_STACK_CUSTOMER_ID', 'Καλάθι για αναγνωριστικό πελάτη ');
define('MESSAGE_STACK_DELETE_SUCCESS', ' διαγράφηκε με επιτυχία');
define('HEADING_TITLE', 'Ανακτήστε τις πωλήσεις καλαθιού');
define('HEADING_EMAIL_SENT', 'Αποστολή μηνύματος ηλεκτρονικού ταχυδρομείου αναφορά');
define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Έρευνα από '.  STORE_NAME );
define('EMAIL_TEXT_SALUTATION', 'αγαπητέ ' );
define('EMAIL_TEXT_NEWCUST_INTRO', "\n\n" . 'Ευχαριστούμε για το χρόνο σας ' . STORE_NAME .
                                   ' που θα μας συμπεριλαβατε για την υποψήφια αγορά σας. ');
define('EMAIL_TEXT_CURCUST_INTRO', "\n\n" . 'Θα θέλαμε να σας ευχαριστήσουμε που έχετε αγοράσει ' .
                                   STORE_NAME . ' και στο παρελθόν. ');
define('EMAIL_TEXT_COMMON_BODY', 'Παρατηρήσαμε ότι κατά τη διάρκεια μιας επίσκεψης στο κατάστημά μας τοποθετήσατε ' .
                                 'τα ακόλουθα προιόντα στο καλάθι αγορών σας, αλλά δεν ολοκληρώσατε ' .
                                 'τη συναλλαγή.' . "\n\n" .
                                 'Περιεχόμενα στο καλάθι αγορών ειναι:' .
                                 "\n\n" . '%s' . "\n\n" .
                                 'Μας ενδιαφέρει πάντα να γνωρίζουμε τι συνέβη ' .
											'και αν υπήρχε ένας λόγος που αποφασίσατε να μην αγοράσετε' .
											'αυτή τη φορά. Εάν θα μπορούσατε να είστε τόσο ευγενικοί ώστε να μας αφήσετε ' .
											'να γνωρίζουμε  εάν είχατε προβλήματα ή ανησυχίες,και  θα το εκτιμούσαμε πολυ .  ' .
											'Ζητούμε από εσάς και τους άλλους να μας ενημερώσουν για το πώς μπορείτε να  ' .
											'βοηθήστε ωστε να κάνουμε  την εμπειρία σας στο'. STORE_NAME . ' καλλήτερη.'."\n\n".
											'ΠΑΡΑΚΑΛΩ ΣΗΜΕΙΩΣΤΕ:'."\n".'Εάν πιστεύετε ότι ολοκληρώσατε την αγορά σας και ' .
											'αναρωτιόντας γιατί δεν παραδόθηκε, αυτό το μήνυμα ηλεκτρονικού ταχυδρομείου είναι μια ένδειξη ότι ' .
											'η παραγγελία σας ΔΕΝ ολοκληρώθηκε και ότι δεν έχετε χρεωθεί! ' .
											'Επιστρέψτε στο κατάστημα για να ολοκληρώσετε την παραγγελία σας.'."\n\n".
											'Ζητούμε συγγνώμη αν έχετε ήδη ολοκληρώσει την αγορά σας, ' .
											'προσπαθούμε να μην στέλνουμε  αυτό τα μήνυμα σε αυτές τις περιπτώσεις, αλλά μερικές φορές είναι ' .
											'είναι δύσκολο να πούμε και είναι ανάλογο με τις μεμονωμένες περιστάσεις.'."\n\n".
                                 'Και πάλι, σας ευχαριστούμε για το χρόνο και την προσοχή που διαθέσατε μας βοηθάτε ' .
                                 'βελτιώνουμε καθημερινά το ' . STORE_NAME .  ".\n\nμε εκτιμιση,\n\n" .
                                 STORE_NAME . "\n". HTTP_SERVER . DIR_WS_CATALOG . "\n");
define('DAYS_FIELD_PREFIX', 'Εμφάνιση για τελευταία ');
define('DAYS_FIELD_POSTFIX', ' ημέρες ');
define('DAYS_FIELD_BUTTON', 'Πηγαίνω');
define('TABLE_HEADING_DATE', 'ΗΜΕΡΟΜΗΝΙΑ');
define('TABLE_HEADING_CONTACT', 'ΕΠΙΚΟΙΝΩΝΙΑ');
define('TABLE_HEADING_CUSTOMER', 'ΟΝΟΜΑ ΠΕΛΑΤΗ');
define('TABLE_HEADING_EMAIL', 'E-MAIL');
define('TABLE_HEADING_PHONE', 'ΤΗΛΕΦΩΝΟ');
define('TABLE_HEADING_MODEL', 'ΕΙΔΟΣ');
define('TABLE_HEADING_DESCRIPTION', 'ΠΕΡΙΓΡΑΦΗ');
define('TABLE_HEADING_QUANTY', 'Ποσότητα');
define('TABLE_HEADING_PRICE', 'Τιμή');
define('TABLE_HEADING_TOTAL', 'Σύνολο');
define('TABLE_GRAND_TOTAL', 'Σύνολο: ');
define('TABLE_CART_TOTAL', 'Συνολική Αξία καλαθιού: ');
define('TEXT_CURRENT_CUSTOMER', 'ΠΕΛΑΤΗΣ');
define('TEXT_SEND_EMAIL', 'Αποστολή e-mail');
define('TEXT_RETURN', '[Κάντε κλικ εδώ για να επιστρέψετε]');
define('TEXT_NOT_CONTACTED', 'Ανεξάρτητα');
define('PSMSG', 'Απο ττο μήνυμα: ');
?>