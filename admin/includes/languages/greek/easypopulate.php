<?php
/*
  $Id: easypopulate.php,v 1.4 2004/09/21  zip1 Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 20042 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Εύκολη ρύθμιση πληθυσμού ');
define('EASY_VERSION_A', 'Εύκολη Πληθυσμός Προηγμένη');
define('EASY_DEFAULT_LANGUAGE', '  -  Προεπιλεγμένη γλώσσα');
define('EASY_UPLOAD_FILE', 'Το αρχείο μεταφορτώθηκε. ');
define('EASY_UPLOAD_TEMP', 'Προσωρινό όνομα αρχείου: ');
define('EASY_UPLOAD_USER_FILE', 'Όνομα αρχείου χρήστη: ');
define('EASY_SIZE', 'Μέγεθος: ');
define('EASY_FILENAME', 'Ονομα αρχείου: ');
define('EASY_SPLIT_DOWN', 'Μπορείτε να κατεβάσετε τα αρχεία διαίρεσης στα εργαλεία / αρχεία κάτω από / temp/');
define('EASY_UPLOAD_EP_FILE', 'Μεταφόρτωση αρχείου EP για εισαγωγή');
define('EASY_SPLIT_EP_FILE', 'Ανεβάστε και χωρίστε ένα αρχείο EP');
define('EASY_INSERT', 'Εισαγάγετε στο DB');
define('EASY_SPLIT', 'Ανεβάστε και χωρίστε ένα αρχείο EP');
define('EASY_LIMIT', 'Εξαγωγή:');
define('EASY_LABEL_IMPORT', 'Εισαγωγή:');

define('TEXT_IMPORT_TEMP', 'IΕισαγωγή δεδομένων από αρχείο στο %s');
define('TEXT_INSERT_INTO_DB', 'Εισάγετε σε DB');
define('TEXT_SELECT_ONE', 'Επιλέξτε ένα αρχείο EP για εισαγωγή');
define('TEXT_SPLIT_FILE', 'Επιλέξτε ένα αρχείο EP');
define('EASY_LABEL_CREATE', 'Εξαγωγή αρχείου');
define('EASY_LABEL_CREATE_SELECT', 'Επιλέξτε τη μέθοδο αποθήκευσης του αρχείου εξαγωγής');
define('EASY_LABEL_CREATE_SAVE', 'Αποθηκεύστε στο αρχείο σας στο διακομιστή');
define('EASY_LABEL_SELECT_DOWN', 'Επιλέξτε το πεδίο που θέλετε να κατεβάσετε');
define('EASY_LABEL_SORT', 'Επιλέξτε πεδίο για ταξινόμηση');
define('EASY_LABEL_PRODUCT_RANGE', 'Περιορίστε κατά Προϊόντα_ταυτοτητας');
define('EASY_LABEL_LIMIT_CAT', 'Περιορισμός κατά κατηγορία');
define('EASY_LABEL_LIMIT_MAN', 'Περιορισμός κατά κατασκευαστή');

define('EASY_LABEL_PRODUCT_AVAIL', 'Διαθέσιμη περιοχή: ');
define('EASY_LABEL_PRODUCT_FROM', ' απο ');
define('EASY_LABEL_PRODUCT_TO', ' μεχρι ');
define('EASY_LABEL_PRODUCT_RECORDS', '    Συνολικός αριθμός αρχείων: ');
define('EASY_LABEL_PRODUCT_BEGIN', 'παμε τωρα: ');
define('EASY_LABEL_PRODUCT_END', 'τελος: ');
define('EASY_LABEL_PRODUCT_START', 'Ξεκινήστε τη δημιουργία αρχείων ');

define('EASY_FILE_LOCATE', 'Μπορείτε να πάρετε το αρχείο σας στα εργαλεία / αρχεία κάτω από ');
define('EASY_FILE_LOCATE_2', ' κάνοντας κλικ σε αυτόν το σύνδεσμο και πηγαίνοντας στο διαχειριστή αρχείων');
define('EASY_FILE_RETURN', ' Μπορείτε να επιστρέψετε στο ΕΚ κάνοντας κλικ σε αυτόν το σύνδεσμο.');
define('EASY_IMPORT_TEMP_DIR', 'Εισαγωγή από Temp Dir ');
define('EASY_LABEL_DOWNLOAD', 'Κατεβάστε');
define('EASY_LABEL_COMPLETE', 'Πλήρης');
define('EASY_LABEL_TAB', 'tab-οριοθετημένο αρχείο .κειμενο για επεξεργασία');
define('EASY_LABEL_MPQ', 'Μοντέλο / Τιμή / Ποσοτητα');
define('EASY_LABEL_EP_MC', 'Μοντέλο / Κατηγορία');
define('EASY_LABEL_EP_FROGGLE', 'Froogle τι σημαινει δεν ξέρω');
define('EASY_LABEL_EP_ATTRIB', 'χαρακτηριστικα');
define('EASY_LABEL_NONE', 'κανενα');
define('EASY_LABEL_CATEGORY', '1st κατηγοριαName');
define('PULL_DOWN_MANUFACTURES', 'κατασκευαστης');
define('EASY_LABEL_PRODUCT', 'ταυτοτητα προιοντος');
define('EASY_LABEL_MANUFACTURE', 'Αριθμός αναγνωριστικού κατασκευαστή');
define('EASY_LABEL_EP_FROGGLE_HEADER', 'Κάντε λήψη ενός αρχείου EP ή Froogle');
define('EASY_LABEL_EP_MA', 'Model/Attributes');
define('EASY_LABEL_EP_FR_TITLE', 'Δημιουργία αρχείων EP ή Froogle στο Temp Directory ');
define('EASY_LABEL_EP_DOWN_TAB', 'Create <b>Complete</b> tab - οριοθετημένο αρχείο .text στο temp dir');
define('EASY_LABEL_EP_DOWN_MPQ', 'Create <b>Model/Price/Qty</b> tab-delimited αρχείου .txt στο temp dir');
define('EASY_LABEL_EP_DOWN_MC', 'Create <b>Model/Category</b> tab-delimited .txt file in temp dir');
define('EASY_LABEL_EP_DOWN_MA', 'Create <b>Model/Attributes</b> tab-delimited .txt file in temp dir');
define('EASY_LABEL_EP_DOWN_FROOGLE', 'Create <b>Froogle</b> tab-delimited .txt file in temp dir');

define('EASY_LABEL_NEW_PRODUCT', 'νεο προιόν!</font><br>');
define('EASY_LABEL_UPDATED', "<font color='black'> αναβαθμιση</font><br>");
define('EASY_LABEL_DELETE_STATUS_1', "<font color='red'> !!Διαγραφή προϊόντος ");
define('EASY_LABEL_DELETE_STATUS_2', " από τη βάση δεδομένων !!</font><br>");
define('EASY_LABEL_LINE_COUNT_1', 'προστεθηκε');
define('EASY_LABEL_LINE_COUNT_2', 'καταγραφη  και κλείνει το αρχείο... ');
define('EASY_LABEL_FILE_COUNT_1', 'Creating file EP_Split ');
define('EASY_LABEL_FILE_COUNT_2', '.txt ...  ');
define('EASY_LABEL_FILE_CLOSE_1', 'Προστέθηκε ');
define('EASY_LABEL_FILE_CLOSE_2', ' καταγράφει και κλείνει το αρχείο...');
//errormessages
define('EASY_ERROR_1', 'Παράξενη αλλά δεν υπάρχει προεπιλεγμένη γλώσσα για εργασία ... Αυτό μπορεί να μην συμβεί, μόνο στην περίπτωση... ');
define('EASY_ERROR_2', '... ΛΑΘΟΣ! - Πολλοί χαρακτήρες στον αριθμό μοντέλου.<br>
			Το 25 είναι το μέγιστο σε μια τυπική εγκατάσταση cre.<br>
			Το μέγιστο μήκος μοντέλου προϊόντος σας έχει οριστεί σε ');
define('EASY_ERROR_2A', ' <br>Μπορείτε είτε να συντομεύσετε τους αριθμούς μοντέλων είτε να αυξήσετε το μέγεθος του πεδίου στη βάση δεδομένων.</font>');
define('EASY_ERROR_2B',  "<font color='red'>");
define('EASY_ERROR_3', '<p class=smallText>No products_id field in record. This line was not imported <br><br>');
define('EASY_ERROR_4', '<font color=red>ERROR - v_customer_group_id and v_customer_price must occur in pairs</font>');
define('EASY_ERROR_5', '</b><font color=red>ERROR - You are trying to use a file created with EP Advanced, please try with Easy Populate Advanced </font>');
define('EASY_ERROR_5a', '<font color=red><b><u>  Click here to return to Easy Populate Basic </u></b></font>');
define('EASY_ERROR_6', '</b><font color=red>ERROR - You are trying to use a file created with EP Basic, please try with Easy Populate Basic </font>');
define('EASY_ERROR_6a', '<font color=red><b><u>  Click here to return to Easy Populate Advanced </u></b></font>');

define('EASY_R_NAME', 'όνομα');
define('EASY_R_DESC', 'περιγραφή');
define('EASY_R_CAT', 'κατηγορία');
define('EASY_R_LANGUAGE', 'Γλώσσα');
define('EASY_R_MODEL', 'μοντέλο');
define('EASY_R_IMAGES', 'εικόνες');
define('EASY_R_MANUF', 'κατασκευαστής');
define('EASY_R_DISC', 'έκπτωση');
define('EASY_R_PRICE', 'τιμή');
define('EASY_R_QTY', 'ποσοτητα');
define('EASY_R_DATE', 'ημερομηνία');
define('EASY_R_STATUS', 'κατάσταση');
define('EASY_R_STATUS_ACT', 'ενεργός');
define('EASY_R_STATUS_NOACT', 'μη ενεργή');
define('EASY_R_STATUS_DELETE', 'διαγράφω');
define('EASY_R_DOWNLOAD', 'Μπορείτε να κατεβάσετε το αρχείο σας εδώ');
define('EASY_R_NORMAL', 'Normal');
define('EASY_R_ADD', 'Προσθέστε γραμμές');
define('EASY_R_REFRESH', 'ανανεωση');
define('EASY_R_DEL', 'διαγραφη');
define('EASY_R_FULLFILE', 'Πλήρες αρχείο');
define('EASY_R_ID_PRICE', 'Μοντέλο / Τιμή / Ποσότητα');
define('EASY_R_DOWN_NOW', 'Κατεβάστε τώρα');
define('EASY_R_DOWN_CREATE', 'Δημιουργία και λήψη');
define('EASY_R_TMP_DIR', 'Δημιουργία σε προσωρινό φάκελο');
define('EASY_R_ALL', 'ολα');
define('EASY_R_PRICEQTY', 'τμη/ποσοτητα');
define('EASY_R_CATS', 'Κατηγορίες');
define('EASY_R_ATTRS', 'ΧΑΡΑΚΤΗΡΙΣΤΙΚΑ');
define('EASY_R_FILE3', 'αρχείο');
define('EASY_R_SORT', 'Σειρά ταξινόμησης');
define('EASY_R_FILTER', 'Διήθηση');
define('EASY_LABEL_ALGORITHM', 'Εισαγωγή αλγορίθμου');
define('EASY_LABEL_DELIMITER', 'Οριοθέτης');
define('EASY_SELECT_FILE', 'Eπιλέξτε ένα αρχείο');
define('EASY_EXPORT_DATA', 'Εξαγωγή δεδομένων');
define('EASY_LABEL_EXPORT_FULL_ATTR_INF', 'Λήψη πλήρους πληροφοριών χαρακτηριστικών');
define('EASY_LABEL_IMPORT_FULL_ATTR_INF', 'Λήψη πλήρους πληροφοριών χαρακτηριστικών');

?>
