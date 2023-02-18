<?php
/*
  $Id: admin_members.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

if ($_GET['gID']) {
  define('HEADING_TITLE', 'Ομάδες διαχειριστή');
} elseif ($_GET['gPath']) {
  define('HEADING_TITLE', 'define ομάδες');
}elseif(!empty($_GET['info']) && $_GET['info'] == 'admin_groups'){
	define('HEADING_TITLE', 'Ομάδες διαχειριστή');
}elseif(!empty($_GET['info']) && $_GET['info'] == 'admin_files'){
	define('HEADING_TITLE', 'Δικαιώματα πρόσβασης');
}else{
	define('HEADING_TITLE', 'διαχειριστής');
}
define('ADMIN_LIST', 'Λίστα διαχειριστών');


define('TEXT_COUNT_GROUPS', 'Groups: ');
define('TABLE_HEADING_NAME', 'Όνομα');
define('TABLE_HEADING_EMAIL', 'Διεύθυνση email');
define('TABLE_HEADING_PASSWORD', 'Κωδικός πρόσβασης');
define('TABLE_HEADING_CONFIRM', 'Επιβεβαίωση Κωδικού');
define('TABLE_HEADING_GROUPS', 'Επίπεδο Ομάδων');
define('TABLE_HEADING_CREATED', 'Ο Λογαριασμός Δημιουργήθηκε');
define('TABLE_HEADING_MODIFIED', 'Ο Λογαριασμός αναδημιουργήθηκε');
define('TABLE_HEADING_LOGDATE', 'Τελευταία πρόσβαση');
define('TABLE_HEADING_LOGNUM', 'Αρχείο καταγραφής');
define('TABLE_HEADING_LOG_NUM', 'Αριθμός αρχείου καταγραφής');
define('TABLE_HEADING_ACTION', 'Δράση');
define('TABLE_HEADING_PAGES_REDIRECT', 'Σελίδα ανακατεύθυνσης διαχειριστή');


define('TABLE_HEADING_GROUPS_NAME', 'Όνομα ομάδας');
define('TABLE_HEADING_GROUPS_DEFINE', 'Επιλογή εικονιδίου και αρχείων');
define('TABLE_HEADING_GROUPS_GROUP', 'Επίπεδο');
define('TABLE_HEADING_GROUPS_CATEGORIES', 'Αδειοδότηση Κατηγοριών');


define('TEXT_INFO_HEADING_DEFAULT', 'Μέλος διαχειριστή ');
define('TEXT_INFO_HEADING_DELETE', 'Διαγραφή Πρόσβασης');
define('TEXT_INFO_HEADING_EDIT', 'Επεξεργασία κατηγορίας / ');
define('TEXT_INFO_HEADING_NEW', 'Νεος διαχειριστής');

define('TEXT_INFO_DEFAULT_INTRO', 'Ομάδα μελών');
define('TEXT_INFO_DELETE_INTRO', 'Αφαιρεσε <nobr><b>%s</b></nobr> from <nobr>Μέλη διαχειριστή;</nobr>');
define('TEXT_INFO_DELETE_INTRO_NOT', 'Δεν μπορείτε να διαγράψετε <nobr>%s group!</nobr>');
define('TEXT_INFO_EDIT_INTRO', 'define το επίπεδο άδειας εδώ:');

define('TEXT_INFO_FULLNAME', 'ΌΝΟΜΑ: ');
define('TEXT_INFO_FIRSTNAME', 'Ονομα: ');
define('TEXT_INFO_LASTNAME', 'Επίθετο: ');
define('TEXT_INFO_EMAIL', 'Διεύθυνση email: ');
define('TEXT_INFO_PASSWORD', 'Κωδικός πρόσβασης: ');
define('TEXT_INFO_CONFIRM', 'Επιβεβαίωση Κωδικού: ');
define('TEXT_INFO_CREATED', 'Ο λογαριασμός Δημιουργήθηκε: ');
define('TEXT_INFO_MODIFIED', 'Ο Λογαριασμός Τροποποιήθηκε: ');
define('TEXT_INFO_LOGDATE', 'Τελευταία πρόσβαση: ');
define('TEXT_INFO_LOGNUM', 'Αριθμός αρχείου καταγραφής: ');
define('TEXT_INFO_GROUP', 'Ομαδικό επίπεδο: ');
define('TEXT_INFO_ERROR', '<span>Η Διεύθυνση έχει χρησιμοποιηθεί! ΠΑΡΑΚΑΛΩ προσπαθησε ξανα.</span>');

define('JS_ALERT_FIRSTNAME', '- Απαιτείται: Όνομα \n');
define('JS_ALERT_LASTNAME', '- Απαιτείται: Επίθετο \n');
define('JS_ALERT_EMAIL', '- Απαιτείται: Διεύθυνση email \n');
define('JS_ALERT_EMAIL_FORMAT', '- Η μορφή διεύθυνσης ηλεκτρονικού ταχυδρομείου δεν είναι έγκυρη! \n');
define('JS_ALERT_EMAIL_USED', '- Η διεύθυνση ηλεκτρονικού ταχυδρομείου έχει ήδη χρησιμοποιηθεί!\n');
define('JS_ALERT_LEVEL', '- Απαιτείται: Μέλος ομάδας \n');

define('ADMIN_EMAIL_SUBJECT', 'Νέο μέλος διαχειριστή');
define('ADMIN_EMAIL_TEXT', 'Hi %s,' . "\n\n" . 'Μπορείτε να αποκτήσετε πρόσβαση στον πίνακα διαχείρισης με τον ακόλουθο κωδικό πρόσβασης. Μόλις αποκτήσετε πρόσβαση στο διαχειριστή, αλλάξτε τον κωδικό πρόσβασής σας!' . "\n\n" . 'ιστοσελίδα : %s' . "\n" . 'Username: %s' . "\n" . 'Κωδικός πρόσβασης: %s' . "\n\n" . 'Ευχαριστούμε πολύ!' . "\n" . '%s' . "\n\n" . 'Αυτή είναι μια αυτοματοποιημένη απάντηση,σας παρακαλούμε μην απαντήσετε!'); 
define('ADMIN_EMAIL_EDIT_SUBJECT', 'Επεξεργασία προφίλ μέλους διαχειριστή');
define('ADMIN_EMAIL_EDIT_TEXT', 'Hi %s,' . "\n\n" . 'Τα προσωπικά σας στοιχεία έχουν ενημερωθεί από διαχειριστή.' . "\n\n" . 'excelelnt : %s' . "\n" . 'Όνομα χρήστη: %s' . "\n" . 'Κωδικός πρόσβασης: %s' . "\n\n" . 'Ευχαριστούμε πολύ!' . "\n" . '%s' . "\n\n" . 'Αυτή είναι μια αυτοματοποιημένη απάντηση, παρακαλούμε να μην απαντήσετε!'); 

define('TEXT_INFO_HEADING_DEFAULT_GROUPS', 'Ομάδα διαχειριστών ');
define('TEXT_INFO_HEADING_DELETE_GROUPS', 'Διαγραφή ομάδας ');

define('TEXT_INFO_DEFAULT_GROUPS_INTRO', '<b>NOTE:</b><li><b>edit:</b> Επεξεργασία ονόματος ομάδας.</li><li><b>delete:</b> delete group.</li><li><b>define:</b> define group access.</li>');
define('TEXT_INFO_DELETE_GROUPS_INTRO', 'It\'s επίσης θα διαγράψει μέλος αυτής της ομάδας. Είστε βέβαιοι ότι θέλετε να διαγράψετε <nobr><b>%s</b> group?</nobr>');
define('TEXT_INFO_DELETE_GROUPS_INTRO_NOT', 'Δεν μπορείτε να διαγράψετε αυτές τις ομάδες!');
define('TEXT_INFO_GROUPS_INTRO', 'Δώστε ένα μοναδικό όνομα ομάδας. Κάντε κλικ στην επόμενη για να υποβάλετε.');

define('TEXT_INFO_HEADING_GROUPS', 'Νέα ομάδα');
define('TEXT_INFO_GROUPS_NAME', ' <b>Όνομα Ομάδας:</b><br>Δώστε ένα μοναδικό όνομα ομάδας. Στη συνέχεια, κάντε κλικ στο επόμενο για να υποβάλετε.<br>');
define('TEXT_INFO_GROUPS_NAME_FALSE', '<span><b>ERROR:</b> Το όνομα της ομάδας πρέπει να έχει περισσότερους από 2 χαρακτήρες!</span>');
define('TEXT_INFO_GROUPS_NAME_USED', '<span><b>ERROR:</b> Το όνομα ομάδας έχει ήδη χρησιμοποιηθεί!</span>');
define('TEXT_INFO_GROUPS_LEVEL', 'Ομαδικό επίπεδο: ');
define('TEXT_INFO_GROUPS_BOXES', '<b>Πλαίσια πρόσβασης:</b><br>Δώστε πρόσβαση σε επιλεγμένα πλαίσια.');
define('TEXT_INFO_GROUPS_BOXES_INCLUDE', 'Συμπεριλάβετε τα αρχεία που είναι αποθηκευμένα στο: ');

define('TEXT_INFO_HEADING_EDIT_GROUP', 'Επεξεργασία ονόματος ομάδας');
define('TEXT_INFO_EDIT_GROUP_INTRO', 'Μπορείτε να αλλάξετε το τρέχον όνομα αυτής της ομάδας, πληκτρολογήστε νέο όνομα και κάντε κλικ στο κουμπί Αποθήκευση.');

define("stats_products_purchased.php", "παραγγελθέντα προϊόντα");
define("stats_customers_orders.php", "Παραγγελίες πωλήσεων");
define("template_configuration.php", "Διαμόρφωση προτύπου");
define("easypopulate_functions.php", ".. EASYPOPULATE_FUNCTIONS ..");
define("create_account_process.php", "Διαδικασία δημιουργίας λογαριασμού");
define("create_account_success.php", "επιτυχής σελίδα εγγραφής");
define("stats_customers_entry.php", "Customer Login");
define("stats_products_viewed.php", "Viewed Items");
define("languages_translater.php", "Μετάφραση γλωσσών");
define("create_order_process.php", "διαδικασία δημιουργίας παραγγελιών");
define("stats_sales_report2.php", "στατιστικά στοιχεία πωλήσεων (2)");
define("total_configuration.php", "Editor ρυθμίσεων");
define("stats_monthly_sales.php", "μηνιαίες πωλήσεις");
define("extra_product_price.php", "Πρόσθετη τιμή προϊόντος");
define("products_attributes.php", "Χαρακτηριστικά προϊόντος");
define("stats_last_modified.php", "Πρόσφατες αλλαγές");
define("stats_sales_report.php", "Αναφορά στατιστικών πωλήσεων");
define("attributeManager.php", "Διαχείριση ιδιοτήτων");
define("mysqlperformance.php", "αργό ημερολόγιο ερωτήματος");
define("customers_groups.php", "ομάδες πελατών");
define("validcategories.php", "έγκυρες κατηγορίες");
define("stats_customers.php", "Στατιστικά στοιχεία πελατών");
define("design_controls.php", "Έλεγχοι σχεδιασμού");
define("stats_opened_by.php", "Στατιστικά για νέους λογαριασμούς");
define("create_account.php", "Δημιουργία λογαριασμού");
define("listcategories.php", "Λίστα κατηγοριών");
define("stats_keywords.php", "ερωτήματα αναζήτησης");
define("image_explorer.php", "Διαχείριση αρχείων");
define("xsell_products.php", "συνδεδεμένα προϊόντα");
define("products_multi.php", "Διαχείριση προϊόντων");
define("manufacturers.php", "Κατασκευαστές");
define("stats_zeroqty.php", "Τα προϊόντα των οποίων δεν είναι σε απόθεμα");
define("configuration.php", "Διαμόρφωση");

define("stats_nophoto.php", "Προϊόντα χωρίς φωτογραφίες");
define("quick_updates.php", "Ενημέρωση τιμής");
define("validproducts.php", "Λίστα Προϊόντων");
define("configuration.php", "Το κατάστημά μου");
define("admin_members.php", "Διαχειριστής διαχείρισης");
define("orders_status.php", "Κατάσταση παραγγελιών");
define("email_content.php", "Πρότυπα ηλεκτρονικού ταχυδρομείου");
define("administrator.php", "Διαχειριστές");
define("coupon_admin.php", "Κουπόνια");
define("listproducts.php", "λίστα προϊόντων");
define("easypopulate.php", "Εισαγωγή / Εξαγωγή Excel");
define("manudiscount.php", "Εκπτώσεις κατασκευαστών");
define("localization.php", "εντοπισμός");
define("edit_orders.php", "Επεξεργασία παραγγελιών");
define("newsletters.php", "διευθυντής λίστας διευθύνσεων");
define("tax_classes.php", "Λίστα φόρων");
define("admin_files.php", "Μενού των πλαισίων διαχειριστή");
define("whos_online.php", "Άνθρωποι σε απευθείας σύνδεση");
define("currencies.php", "νομίσματα");
define("ajax_xsell.php", "AJAX συνδεδεμένα προϊόντα");
define("chart_data.php", ".. CHART_DATA ..");
define("categories.php", "λίστα προϊόντων");
define("tax_rates.php", "Φόροι Φόρων");
define("salemaker.php", "Μαζικές εκπτώσεις");
define("languages.php", "γλώσσες");
define("pollbooth.php", ".. POLLBOTH ..");
define("customers.php", "λίστα πελατών");
define("countries.php", "χώρες");
define("geo_zones.php", "Γεωγραφικές περιοχές");
define("customers.php", "Πελάτες");
define("articles.php", "Άρθρα");
define("products.php", "Product Editor");
define("featured.php", "Προτεινόμενα προϊόντα");
define("gv_admin.php", ".. GV_ADMIN ..");
define("specials.php", "Εκπτώσεις");
define("gv_queue.php", "ενεργοποίηση πιστοποιητικού");
define("ship2pay.php", "Παράδοση-Πληρωμή");
define("reviews.php", "Σχόλια");
define("articles.php", "Σελίδες");
define("modules.php", "Modules");
define("reports.php", "Αναφορές");
define("catalog.php", "Κατάλογος");
define("gv_mail.php", "Αποστολή πιστοποιητικού");
define("gv_sent.php", "πιστοποιητικά αποστολής");
define("modules.php", "Modules");
define("backup.php", "Database Backup");
define("orders.php", "Λίστα παραγγελιών");
define("taxes.php", "Φόροι");
define("cache.php", "Cache");
define("tools.php", "Εργαλεία");
define("polls.php", "Δημοσκοπήσεις");
define("polls.php", "Ψηφοφορία");
define("zones.php", "Λίστα περιφερειών");
define("mail.php", "Αποστολή μηνύματος ηλεκτρονικού ταχυδρομείου");

define('FILENAME_DEFAULT_TEXT', 'Αρχική σελίδα');
define('FILENAME_CATEGORIES_TEXT', 'Σελίδα κατηγοριών');

define('TEXT_INFO_HEADING_DEFINE', 'Ορισμός ομάδας');
if ($_GET['gPath'] == 1) {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br>Δεν μπορείτε να αλλάξετε την άδεια αρχείου για αυτήν την ομάδα.<br><br>');
} else {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br>Αλλάξτε την άδεια για αυτήν την ομάδα επιλέγοντας ή αποεπιλέγοντας τα πλαίσια και τα αρχεία που παρέχονται. Κάντε κλικ <b>αποθήκευση</b> των αλλαγών.<br><br>');
}
?>
