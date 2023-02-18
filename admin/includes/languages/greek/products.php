<?php
/*
  $Id: categories.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

// BOF MaxiDVD: Added For Ultimate-Images Pack!
define('TEXT_PROD_LOAD_FILES','Φόρτωση αρχείων:');
define('TEXT_ALOWED_FILE_TYPES','Επιτρεπόμενοι τύποι αρχείων:');
define('TEXT_PROD_FILES_DRAG','Σύρετε αρχεία εδώ');
define('TEXT_PROD_DOWNLOADS','Αρχεία προς λήψη');
define('TEXT_IS_DOWNLOAD_PRODUCT','Ηλεκτρονικό Προϊόν:');
define('TEXT_PRODUCTS_IMAGE_NOTE', '<b>Εικόνα προϊόντων:</b><small><br>Main Image used in<br><u>κατάλογο και περιγραφή</u> page.<small>');
define('TEXT_PRODUCTS_IMAGE_MEDIUM', '<b>Μεγαλύτερη εικόνα:</b><br><small>ΑΝΤΙΚΑΤΑΣΤΑΣΕΙ τη Μικρή Εικόνα στο<br><u>κατάλογο και περιγραφή</u> page.</small>');
define('TEXT_PRODUCTS_IMAGE_LARGE', '<b>Αναδυόμενη εικόνα:</b><br><μικρό> ΑΝΤΙΚΑΤΑΣΤΑΣΕΙΣ Μικρή εικόνα σε<br><u>pop-up window</u> Σελίδα.</small>');
define('TEXT_PRODUCTS_IMAGE_LINKED', '<u>Αποθήκευση προϊόντος  Κοινή χρήση αυτής της εικόνας =</u>');
define('TEXT_PRODUCTS_IMAGE_REMOVE', '<b>αφαιρεση</b> Αυτή η εικόνα από αυτό το Προϊόν?');
define('TEXT_PRODUCTS_IMAGE_DELETE', '<b>δαιαγραφη</b> μονιμα της εικόνας)?');
define('TEXT_PRODUCTS_IMAGE_REMOVE_SHORT', 'αφαιρεση');
define('TEXT_PRODUCTS_IMAGE_DELETE_SHORT', 'διαγραφη');
define('TEXT_PRODUCTS_IMAGE_TH_NOTICE', '<b>SM = μικρες εικονες,</b> if a "SM" εικονα χρησιμοποιητε απο <br>(Alone) ΔΕΝ δημιουργείται σύνδεσμος pop-up παραθύρου, το "SM"<br>(μικρή εικόνα) θα τοποθετηθεί απευθείας κάτω από την περιγραφή των προϊόντων. αν χρησιμοποιηθεί σε συνδυασμό με μια εικόνα "XL" στο δεξιό παράθυρο, δημιουργείται ένα παράθυρο συνδέσμου αναδυόμενων παραθύρων <br> και η εικόνα "XL" θα εμφανίζεται σε ένα αναδυόμενο παράθυρο.<br><br>');
define('TEXT_PRODUCTS_IMAGE_XL_NOTICE', '<b>XL = Μεγάλες εικόνες, </b> Χρησιμοποιείται για την αναδυόμενη εικόνα<br><br><br>');
define('TEXT_PRODUCTS_IMAGE_ADDITIONAL', 'Περισσότερες εικόνες προσθήκης - Θα εμφανιστούν κάτω από την περιγραφή του προϊόντος, αν χρησιμοποιηθούν.');

define('TEXT_XSELLS_ADD', 'Προσθήκη xsell ανά προϊόντα Μοντέλο:');
define('TEXT_XSELLS_ADD_BUTTON', 'Προσθέτω');
define('TEXT_XSELLS_DEL_BUTTON', 'διαγραφη');

define ('TEXT_QTY_PRO_QUANTITY_LABEL', 'Ποσότητα');
define('TEXT_QTY_PRO_COMBINATION_PRICE_LABEL', 'Τιμή');
define ('TEXT_QTY_PRO_VENDOR_CODE_LABEL', 'Κωδικός προμηθευτή');

// EOF MaxiDVD: Added For Ultimate-Images Pack!
define('HEADING_TITLE', 'Κατηγορίες / Προϊόντα');
define('HEADING_TITLE_SEARCH', 'αναζητηση:');
define('HEADING_TITLE_GOTO', 'Πηγαινε:');

define('TABLE_HEADING_ID', 'ταυτοτατα');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Κατηγορίες / Προϊόντα');
define('TABLE_HEADING_ACTION', 'δραση');
define('TABLE_HEADING_STATUS', 'Κατάσταση');

define('TEXT_NEW_PRODUCT', 'Νέο προϊόν &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Κατηγορίες:');
define('TEXT_SUBCATEGORIES', 'Υποκατηγορίες:');
define('TEXT_PRODUCTS', 'Προϊόντα:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Τιμή:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Φορολογική κλάση:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Μέση βαθμολογία:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Ποσότητα:');
define('TEXT_DATE_ADDED', 'Ημερομηνία προστέθηκε:');
define('TEXT_DELETE_IMAGE', 'Διαγραφή εικόνας');

define('TEXT_DATE_AVAILABLE', 'ΗΜΕΡΟΜΗΝΙΑ διαθεσιμότητας:');
define('TEXT_LAST_MODIFIED', 'Τελευταία τροποποίηση:');
define('TEXT_IMAGE_NONEXISTENT', 'Η ΕΙΚΟΝΑ ΔΕΝ ΥΠΑΡΧΕΙ');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Καταχωρίστε μια νέα κατηγορία ή προϊόν σε αυτό το επίπεδο.');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Για περισσότερες πληροφορίες, επισκεφθείτε αυτά τα προϊόντα <a href="http://%s" target="blank"><u>ιστοσελίδα</u></a>.');
define('TEXT_PRODUCT_DATE_ADDED', 'Αυτό το προιόν προστέθηκε στον κατάλογό μας την %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Αυτό το προϊόν θα είναι διαθέσιμο στο %s.');

define('TEXT_EDIT_INTRO', 'Κάντε τις απαραίτητες αλλαγές');
define('TEXT_EDIT_CATEGORIES_ID', 'Αναγνωριστικό κατηγορίας:');
define('TEXT_EDIT_CATEGORIES_NAME', 'όνομα κατηγορίας:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Εικόνα κατηγορίας:');
define('TEXT_EDIT_SORT_ORDER', 'Σειρά ταξινόμησης:');
define('TEXT_EDIT_CATEGORIES_HEADING_TITLE', 'επικεφαλιδα τίτλου κατηγορίας:');
define('TEXT_EDIT_CATEGORIES_DESCRIPTION', 'επικεφαλιδα τίτλου Περιγραφή:');

define('TEXT_INFO_COPY_TO_INTRO', 'Επιλέξτε μια νέα κατηγορία στην οποία θέλετε να αντιγράψετε αυτό το προϊόν');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Current Categories:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Νέα κατηγορία');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Επεξεργασία κατηγορίας');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Διαγραφή κατηγορίας');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Μετακίνηση κατηγορίας');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Διαγραφή προϊόντος');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Μετακίνηση προϊόντος');
define('TEXT_INFO_HEADING_COPY_TO', 'Αντέγραψε στο');

define('TEXT_DELETE_CATEGORY_INTRO', 'Είστε βέβαιοι ότι θέλετε να διαγράψετε αυτήν την κατηγορία?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Είστε βέβαιοι ότι θέλετε να διαγράψετε οριστικά αυτό το προϊόν?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>ΠΡΟΕΙΔΟΠΟΙΗΣΗ: </b> Υπάρχουν κατηγορίες% s (παιδιών) που εξακολουθούν να συνδέονται με αυτήν την κατηγορία!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>ΠΡΟΕΙΔΟΠΟΙΗΣΗ: </b> Υπάρχουν% s προϊόντα που εξακολουθούν να συνδέονται με αυτή την κατηγορία! ');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Παρακαλώ επιλέξτε σε ποια κατηγορία επιθυμείτε <b>% s </b> να διαμένετε σε');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Επιλέξτε την κατηγορία που επιθυμείτε <b>% s </b> να διαμείνει στο ');
define('TEXT_MOVE', 'Μεταφορά <b>%s</b> σε:');

define('TEXT_NEW_CATEGORY_INTRO', 'Συμπληρώστε τις παρακάτω πληροφορίες για τη νέα κατηγορία ');
define('TEXT_CATEGORIES_NAME', 'Ονομα κατηγορίας:');
define('TEXT_CATEGORIES_IMAGE', 'Εικόνα κατηγορίας: ');
define('TEXT_SORT_ORDER', 'Σειρά ταξινόμησης:');

define('TEXT_PRODUCTS_STATUS', 'Κατάσταση προϊόντων: ');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'ΗΜΕΡΟΜΗΝΙΑ διαθεσιμη:');
define('TEXT_PRODUCT_AVAILABLE', 'Σε απόθεμα');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Εξαντλημένο ');
define('TEXT_PRODUCT_STATUS','Status');
define('TEXT_PRODUCTS_MANUFACTURER', 'Προϊόντα Κατασκευαστής: ');
define('TEXT_PRODUCTS_NAME', 'Όνομα προϊόντων: ');
define('TEXT_PRODUCTS_DESCRIPTION', 'Προϊόντα Περιγραφή: ');
define('TEXT_PRODUCTS_QUANTITY', 'Ποσότητα προϊόντων:');
define('TEXT_PRODUCTS_MODEL', 'Μοντέλο προϊόντων: ');
define('TEXT_PRODUCTS_IMAGE', 'Εικόνα προιόντος:');
define('TEXT_PRODUCTS_URL', ' UR Προϊόντος:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(χωρις http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Καθαρη τιμη  (Net):');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Τιμη με φόρο (Gross):');
define('TEXT_PRODUCTS_WEIGHT', 'βαρος:');
define('TEXT_NONE', '--none--');

define('EMPTY_CATEGORY', 'Κενή κατηγορία');

define('TEXT_HOW_TO_COPY', 'Μέθοδος αντιγραφής:');
define('TEXT_COPY_AS_LINK', 'Σύνδεση προϊόντος');
define('TEXT_COPY_AS_DUPLICATE', 'Διπλότυπο προϊόν');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Σφάλμα: Δεν είναι δυνατή η σύνδεση προϊόντων στην ίδια κατηγορία. ');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Error: Ο κατάλογος εικόνων του καταλόγου δεν είναι εγγράψιμος: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Σφάλμα: Ο κατάλογος εικόνων Catalogue δεν υπάρχει: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Σφάλμα: Η κατηγορία δεν μπορεί να μετακινηθεί σε υποκατηγορία. ');


//
define('ENTRY_PRODUCTS_PRICE', 'Τιμη');
define('ENTRY_PRODUCTS_PRICE_DISABLED', 'Τιμή απενεργοποιημένη');
//


define('TEXT_PRODUCTS_PAGE_TITLE', 'Meta Title:');
define('TEXT_PRODUCTS_HEADER_DESCRIPTION', 'Meta Description:');
define('TEXT_PRODUCTS_KEYWORDS', 'Meta Keywords:');


// RJW Begin Meta Tags Code
define('TEXT_META_TITLE', 'Meta Title');
define('TEXT_META_DESCRIPTION', 'Meta Description');
define('TEXT_META_KEYWORDS', 'Meta Keywords');
// RJW End Meta Tags Code

define('TABLE_HEADING_PARAMETERS', 'Ιδιότητες προϊόντων');

define('TEXT_PRODUCTS_INFO', 'Σύντομη περιγραφή:');

define('TEXT_ATTRIBUTE_HEAD', 'Χαρακτηριστικά προϊόντος:');
define('TABLE_HEADING_ATTRIBUTE_1', 'Ενεργά χαρακτηριστικά');
define('TABLE_HEADING_ATTRIBUTE_2', 'Πρόθεμα');
define('TABLE_HEADING_ATTRIBUTE_3', 'Τιμή');
define('TABLE_HEADING_ATTRIBUTE_4', 'Σειρά ταξινόμησης');
define('TABLE_HEADING_ATTRIBUTE_5', 'Ονομα αρχείου');
define('TABLE_HEADING_ATTRIBUTE_6', 'Λήξη συνδέσμου (ημέρες)');
define('TABLE_HEADING_ATTRIBUTE_7', 'Μέγιστες λήψεις');
define('TABLE_HEADING_ATTRIBUTE_9', 'Βάρος');

define('TABLE_HEADING_PRODUCT_SORT', 'Σειρά ταξινόμησης');
define('TEXT_ATTRIBUTE_DESC', 'Ρύθμιση χαρακτηριστικών προϊόντος. ');

define('TEXT_EMPTY_ATTRIBUTES', 'Αρχικά, προσθέστε ένα χαρακτηριστικό στο προϊόν με τουλάχιστον δύο τιμές.');

#Add:
define('TABLE_HEADING_XML', 'XML');
define('TEXT_PRODUCTS_TO_XML', 'XML files:');
define('TEXT_PRODUCT_AVAILABLE_TO_XML', 'Ενεργοποίηση');
define('TEXT_PRODUCT_NOT_AVAILABLE_TO_XML', 'Απενεργοποίηση');

// BOF Enable - Disable Categories Contribution--------------------------------------
define('TEXT_EDIT_STATUS', 'Status');
define('TEXT_DEFINE_CATEGORY_STATUS', '1 = Ενεργοποίηση. 0 = Απενεργοποίηση');
define('TEXT_EDIT_ROBOTS_STATUS', 'Robots Index Status');
define('TEXT_DEFINE_CATEGORY_ROBOTS_STATUS', 'index, follow/noindex, nofollow');
// EOF Enable - Disable Categories Contribution--------------------------------------

define('TEXT_MIN_QUANTITY', 'Ελάχιστο:');
define('TEXT_MIN_QUANTITY_UNITS', 'Τεμάχια-μοναδες:');

define('ATTRIBUTES_COPY_MANAGER_1', 'Αντιγραφή χαρακτηριστικών του προϊόντος στην κατηγορία ... ');
define('ATTRIBUTES_COPY_MANAGER_2', 'Αντιγραφή χαρακτηριστικών προϊόντος ');
define('ATTRIBUTES_COPY_MANAGER_3', ' τύπος προϊόντος');
define('ATTRIBUTES_COPY_MANAGER_4', 'σε όλα τα προϊόντα της κατηγορίας ');
define('ATTRIBUTES_COPY_MANAGER_5', 'Αριθμός κατηγορίας: ');
define('ATTRIBUTES_COPY_MANAGER_6', 'Διαγράψτε όλα τα χαρακτηριστικά και τις λήψεις πριν αντιγράψετε ');
define('ATTRIBUTES_COPY_MANAGER_7', 'Σε διαφορετική περίπτωση ...');
define('ATTRIBUTES_COPY_MANAGER_8', 'Τα διπλότυπα χαρακτηριστικά πρέπει να παραλειφθούν ');
define('ATTRIBUTES_COPY_MANAGER_9', 'Τα διπλότυπα χαρακτηριστικά θα πρέπει να αντικατασταθούν ');
define('ATTRIBUTES_COPY_MANAGER_10', 'Αντιγράψτε τα χαρακτηριστικά με τις λήψεις ');
define('ATTRIBUTES_COPY_MANAGER_11', 'Επιλέξτε μία κατηγορία');
define('ATTRIBUTES_COPY_MANAGER_12', 'Αντιγράψτε τα χαρακτηριστικά από όλα τα προϊόντα στην κατηγορία ');
define('ATTRIBUTES_COPY_MANAGER_13', 'Χαρακτηριστικά προϊόντων φωτοαντιγραφικά');
define('ATTRIBUTES_COPY_MANAGER_14', 'Επιλέξτε ένα προϊόν');
define('ATTRIBUTES_COPY_MANAGER_15', 'Αριθμός προϊόντων: ');
define('ATTRIBUTES_COPY_MANAGER_16', 'Στο προϊόν: ');
define('ATTRIBUTES_COPY_MANAGER_17', 'διαγράψτε όλα τα χαρακτηριστικά πριν αντιγράψετε νέα χαρακτηριστικά ');
define('ATTRIBUTES_COPY_MANAGER_COPY', 'Αντιγραφή χαρακτηριστικών');

define('TEXT_PAGES', 'Σελίδες: ');
define('TEXT_TOTAL_PRODUCTS', 'Προϊόντα αυτής της κατηγορίας: ');
define('TEXT_ATT_UPLOAD', 'Μεταφόρτωση...');

define('TEXT_WEIGHT_HELP', '<span class="Βασικό!!!!!!!"><b><font color="red">Προειδοποίηση:</font></b>Το βάρος πρέπει να είναι μεγαλύτερο από 0. Για τα εικονικά προϊόντα (προϊόντα με δυνατότητα λήψης) το βάρος πρέπει να είναι 0.</span>');

define('HEADING_TITLE_SEARCH_MODEL', 'Αναζήτηση μοντέλου προϊόντος:');

define('TEXT_PRODUCTS_IMAGE_DIR', 'Μεταφόρτωση στον κατάλογο:');
define('TEXT_IMAGES_MAIN_DIRECTORY', 'εικόνες ');
define('TABLE_HEADING_YES', 'ΝΑΙ');
define('TABLE_HEADING_NO', 'ΟΧΙ');
define('TEXT_IMAGES_OVERWRITE', 'Αντικαταστήστε την υπάρχουσα εικόνα?');
define('TEXT_IMAGES_OVERWRITE1', 'Χρησιμοποιήστε Όχι για μη αυτόματα πληκτρολογημένα ονόματα');
define('TEXT_IMAGE_OVERWRITE_WARNING', 'ΠΡΟΕΙΔΟΠΟΙΗΣΗ: ΠΡΟΕΙΔΟΠΟΙΗΣΗ: Το όνομα του αρχείου ενημερώθηκε αλλά δεν αντικαταστάθηκε ');

define('TEXT_PROD_TEXTS', 'Κείμενα');
define('TEXT_PROD_IMGS', 'Εικόνες');
define('TEXT_PROD_VIDEO','βίντεο');
define('TEXT_PROD_ATTRS', 'Χαρακτηριστικά!!!!!!');
define('TEXT_PROD_LINK', 'Σύνδεσμος');
define('TEXT_PROD_PRICE', 'Τιμή');
define('TEXT_PROD_TOP', 'Κορυφάιο');
define('TEXT_PROD_NEW', 'Νεο!');
define('TEXT_PROD_AKC', 'PROMO');
define('TEXT_PROD_WE', 'Βάρος');
define('TEXT_PROD_SORT', 'Σειρά ταξινόμησης');
define('TEXT_PROD_QTY', 'Ποσότητα');
define('TEXT_PROD_MINORD', 'Ελάχιστη ποσότητα παραγγελίας');
define('TEXT_PROD_IMGS2', 'Εικόνα προϊόντος');
define('TEXT_PROD_IMGS3', 'x');
define('TEXT_PROD_IMGS_OR', 'εναλλακτικα?');
define('TEXT_PROD_IMGS_DRAG', 'Σύρετε την εικόνες εδώ');
define('TEXT_PROD_COLOR', 'Χρώμα');
define('TEXT_PROD_CROP', 'Crop-κοβω-μαλλον');
define('TEXT_PROD_SAVE_BEFORE', 'Αποθηκεύστε το προϊόν πριν προσθέσετε τις εικόνες.');
define('TEXT_PROD_LOAD_IMGS', 'Μεταφόρτωση εικόνων');
define('TEXT_PROD_LOAD_IMGS_BUT', 'Μεταφόρτωση');
define('TEXT_PROD_ON', 'on');
define('TEXT_PROD_OFF', 'off');

define('TEXT_DISCOUNT','Discount');
define('TEXT_RECIPROCAL_LINK','Reciprocal Link');



define('TEXT_EDITED_FOR_SEO', 'Επεξεργασμένο για SEO');

define('BUTTON_QUICK_VIEW', 'Γρήγορη ματιά');
define('TEXT_LINK_TO_YOUTUBE', 'Σύνδεσμος σε βίντεο YouTube');
define('TEXT_IMAGE_PREVIEW', 'Προεπισκόπηση');
define('TEXT_CHOOSE_ON_SERVER', 'Επιλέξτε στον διακομιστή');