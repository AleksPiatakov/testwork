<?php
/*
  $Id: categories.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

// BOF MaxiDVD: Added For Ultimate-Images Pack!
define('TEXT_COPY_LINK', 'Link');
define('TEXT_PRODUCTS_IMAGE_NOTE','<b>Εικόνα προϊόντων:</b><small><br>Main Image used in<br><u>catalog & description</u> page.<small>');
define('TEXT_PRODUCTS_IMAGE_MEDIUM', '<b>Bigger Image:</b><br><small>REPLACES Small Image on<br><u>products description</u> page.</small>');
define('TEXT_PRODUCTS_IMAGE_LARGE', '<b>Pop-up Image:</b><br><small>REPLACES Small Image on<br><u>pop-up window</u> page.</small>');
define('TEXT_PRODUCTS_IMAGE_LINKED', '<u>Store Product/s Sharring this Image =</u>');
define('TEXT_PRODUCTS_IMAGE_REMOVE', '<b>Remove</b> this Image from this Product?');
define('TEXT_PRODUCTS_IMAGE_DELETE', '<b>Delete</b> this Image from the Server (Permanent!)?');
define('TEXT_PRODUCTS_IMAGE_REMOVE_SHORT', 'Remove');
define('TEXT_PRODUCTS_IMAGE_DELETE_SHORT', 'Delete');
define('TEXT_PRODUCTS_IMAGE_TH_NOTICE', '<b>SM = Small Images,</b> if a "SM" image is used<br>(Alone) NO Pop-up window link is created, the "SM"<br>(small image) will be placed directly under the products<br>description. if used inconjunction with a<br>"XL" image on the right, A Pop-up Window Link<br> is created and the "XL" image will be<br>shown in a Pop-up window.<br><br>');
define('TEXT_PRODUCTS_IMAGE_XL_NOTICE', '<b>XL = Large Images,</b> Used for the Pop-up image<br><br><br>');
define('TEXT_PRODUCTS_IMAGE_ADDITIONAL', 'Περισσότερες εικόνες προσθήκης - Θα εμφανιστούν κάτω από την περιγραφή του προϊόντος, αν χρησιμοποιηθούν.');
// EOF MaxiDVD: Added For Ultimate-Images Pack!
define('HEADING_TITLE', 'Κατηγορίες / Προϊόντα');
define('HEADING_TITLE_SEARCH', 'Search:');
define('HEADING_TITLE_GOTO', 'Παω σε:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Κατηγορίες / Προϊόντα');
define('TABLE_HEADING_ACTION', 'Δράση');
define('TABLE_HEADING_STATUS', 'Κατάσταση');

define('TEXT_NEW_PRODUCT', 'New Product in &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Κατηγορίες:');
define('TEXT_SUBCATEGORIES', 'Υποκατηγορίες:');
define('TEXT_PRODUCTS', 'Προιόντα:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Τιμή:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Tax Class:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Μέση βαθμολογία:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Ποσότητα:');
define('TEXT_DATE_ADDED', 'Ημερομηνία προστέθηκε:');
define('TEXT_DELETE_IMAGE', 'Διαγραφή εικόνας');

define('TEXT_DATE_AVAILABLE', 'ΗΜΕΡΟΜΗΝΙΑ διαθεσιμη:');
define('TEXT_LAST_MODIFIED', 'Τελευταία τροποποίηση:');
define('TEXT_IMAGE_NONEXISTENT', 'Η ΕΙΚΟΝΑ ΔΕΝ ΥΠΑΡΧΕΙ');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Καταχωρίστε μια νέα κατηγορία ή προϊόν σε αυτό το επίπεδο.');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Για περισσότερες πληροφορίες, επισκεφθείτε αυτά τα προϊόντα <a href="http://%s" target="blank"><u>webpage</u></a>.');
define('TEXT_PRODUCT_DATE_ADDED', 'Αυτό το προιόν προστέθηκε στον κατάλογό μας την %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Αυτό το προϊόν θα είναι διαθέσιμο στο κατάστημά μας στις %s.');

define('TEXT_EDIT_INTRO', 'Κάντε τις απαραίτητες αλλαγές');
define('TEXT_EDIT_CATEGORIES_ID', 'Αναγνωριστικό κατηγορίας:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Όνομα κατηγορίας:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Εικόνα κατηγορίας:');
define('TEXT_EDIT_CATEGORIES_ICON', 'Εικονίδιο για την κατηγορία:');
define('TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS', 'Εμφάνιση προϊόντων:');
define('TEXT_EDIT_SORT_ORDER', 'Σειρά ταξινόμησης:');
define('TEXT_EDIT_CATEGORIES_HEADING_TITLE', 'Επικεφαλίδα κατηγορίας:');
define('TEXT_EDIT_CATEGORIES_DESCRIPTION', 'Περιγραφή επικεφαλίδας:');

define('TEXT_INFO_COPY_TO_INTRO', 'Επιλέξτε μια νέα κατηγορία στην οποία θέλετε να αντιγράψετε αυτό το προϊόν');
define('TEXT_INFO_DELETE_FROM_CATEGORY', 'Επιλέξτε την κατηγορία από την οποία θέλετε να καταργήσετε αυτό το προϊόν');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Τρέχουσες κατηγορίες:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Νέα κατηγορία');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Επεξεργασία κατηγορίας');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Διαγραφή κατηγορίας');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Μετακίνηση κατηγορίας');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Διαγραφή προϊόντος');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Μετακίνηση προϊόντος');
define('TEXT_INFO_HEADING_COPY_TO', 'Αντέγραψε στο');

define('TEXT_DELETE_CATEGORY_INTRO', 'Είστε βέβαιοι ότι θέλετε να διαγράψετε αυτήν την κατηγορία?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Είστε βέβαιοι ότι θέλετε να διαγράψετε οριστικά αυτό το προϊόν?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>WARNING:</b> Υπάρχουν %s (child-)κατηγορίες που εξακολουθούν να συνδέονται με αυτήν την κατηγορία!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>WARNING:</b> Υπάρχουν %s προιοντα που εξακολουθούν να συνδέονται με αυτήν την κατηγορία!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Επιλέξτε την κατηγορία που επιθυμείτε <b>%s</b> να κατοικούν');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Επιλέξτε την κατηγορία που επιθυμείτε <b>%s</b> να επανατοποθετηθούν');
define('TEXT_MOVE', 'Move <b>%s</b> to:');

define('TEXT_NEW_CATEGORY_INTRO', 'Συμπληρώστε τις παρακάτω πληροφορίες για τη νέα κατηγορία');
define('TEXT_CATEGORIES_NAME', 'όνομα κατηγορίας:');
define('TEXT_CATEGORIES_IMAGE', 'Category Image:');
define('TEXT_SORT_ORDER', 'Σειρά ταξινόμησης:');

define('TEXT_PRODUCTS_STATUS', 'Κατάσταση προϊόντων:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'ΗΜΕΡΟΜΗΝΙΑ διαθεσιμη:');
define('TEXT_PRODUCT_AVAILABLE', 'Σε απόθεμα');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Εξαντλήθηκε');
define('TEXT_PRODUCTS_MANUFACTURER', 'Κατασκευαστής προϊόντων:');
define('TEXT_PRODUCTS_NAME', 'Όνομα προϊόντος:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Περιγραφή προϊόντος:');
define('TEXT_PRODUCTS_QUANTITY', 'Ποσότητα Προϊόντος :');
define('TEXT_PRODUCTS_MODEL', 'Κωδικός προϊόντων:');
define('TEXT_PRODUCTS_IMAGE', 'Εικόνα προϊόντων:');
define('TEXT_PRODUCTS_URL', 'προϊόντων URL:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(without http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Τιμή (καθαρή):');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Τιμή:');
define('TEXT_PRODUCTS_WEIGHT', 'Βάρος :');
define('TEXT_NONE', '--Κανένα--');

define('EMPTY_CATEGORY', 'Κενή κατηγορία');

define('TEXT_HOW_TO_COPY', 'Μέθοδος αντιγραφής:');
define('TEXT_COPY_AS_LINK', 'Σύνδεση προϊόντος');
define('TEXT_COPY_AS_DUPLICATE', 'Διπλότυπο προϊόν');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Σφάλμα: Δεν είναι δυνατή η σύνδεση προϊόντων στην ίδια κατηγορία.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Error: Ο κατάλογος εικόνων του καταλόγου δεν είναι εγγράψιμος: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Error: Ο κατάλογος εικόνων του καταλόγου δεν υπάρχει: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Error: Η κατηγορία δεν μπορεί να μετακινηθεί σε υποκατηγορία.');


//
define('ENTRY_PRODUCTS_PRICE', 'Τιμή');
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
define('TEXT_ATTRIBUTE_DESC', 'Ρύθμιση χαρακτηριστικών προϊόντος.');

#Add:
define('TABLE_HEADING_XML', 'XML');
define('TEXT_PRODUCTS_TO_XML', 'XML files:');
define('TEXT_PRODUCT_AVAILABLE_TO_XML', 'Enable');
define('TEXT_PRODUCT_NOT_AVAILABLE_TO_XML', 'Disable');

// BOF Enable - Disable Categories Contribution--------------------------------------
define('TEXT_EDIT_STATUS', 'Κατάσταση');
define('TEXT_DEFINE_CATEGORY_STATUS', 'Ενεργό/Ανενεργο');
define('TEXT_EDIT_ROBOTS_STATUS', 'Robots Index Status');
define('TEXT_DEFINE_CATEGORY_ROBOTS_STATUS', 'index, follow/noindex, nofollow');
// EOF Enable - Disable Categories Contribution--------------------------------------

define('TEXT_MIN_QUANTITY', 'Ελάχιστο:');
define('TEXT_MIN_QUANTITY_UNITS', 'Τεμάχια:');

define('ATTRIBUTES_COPY_MANAGER_1', 'Αντιγράψτε τα χαρακτηριστικά του προϊόντος στην κατηγορία ...');
define('ATTRIBUTES_COPY_MANAGER_2', 'Αντιγραφή χαρακτηριστικών προϊόντος ');
define('ATTRIBUTES_COPY_MANAGER_3', ' id προιόντος');
define('ATTRIBUTES_COPY_MANAGER_4', 'σε όλα τα προϊόντα της κατηγορίας ');
define('ATTRIBUTES_COPY_MANAGER_5', 'Αριθμός κατηγορίας: ');
define('ATTRIBUTES_COPY_MANAGER_6', 'Διαγράψτε όλα τα χαρακτηριστικά και τις λήψεις πριν αντιγράψετε ');
define('ATTRIBUTES_COPY_MANAGER_7', 'Σε διαφορετική περίπτωση ...');
define('ATTRIBUTES_COPY_MANAGER_8', 'Τα διπλότυπα χαρακτηριστικά θα πρέπει να παραλειφθούν');
define('ATTRIBUTES_COPY_MANAGER_9', 'Τα διπλότυπα χαρακτηριστικά θα πρέπει να αντικατασταθούν');
define('ATTRIBUTES_COPY_MANAGER_10', 'Αντιγράψτε τα χαρακτηριστικά με τις λήψεις ');
define('ATTRIBUTES_COPY_MANAGER_11', 'Επιλέξτε μία κατηγορία');
define('ATTRIBUTES_COPY_MANAGER_12', 'Αντιγράψτε τα χαρακτηριστικά από όλα τα προϊόντα στην κατηγορία ');
define('ATTRIBUTES_COPY_MANAGER_13', 'Διπλότυπα Χαρακτηριστικά προϊόντων');
define('ATTRIBUTES_COPY_MANAGER_14', 'Επιλέξτε ένα προϊόν');
define('ATTRIBUTES_COPY_MANAGER_15', 'Αριθμός προϊόντος: ');
define('ATTRIBUTES_COPY_MANAGER_16', 'Στο προϊόν: ');
define('ATTRIBUTES_COPY_MANAGER_17', 'Διαγράψτε όλα τα χαρακτηριστικά πριν αντιγράψετε νέα χαρακτηριστικά ');
define('ATTRIBUTES_COPY_MANAGER_COPY', 'Αντιγραφή χαρακτηριστικών');

define('TEXT_PAGES', 'Pages: ');
define('TEXT_TOTAL_PRODUCTS', 'Προϊόντα αυτής της κατηγορίας: ');
define('TEXT_ATT_UPLOAD', 'Μεταφόρτωση ...');

define('TEXT_WEIGHT_HELP', '<span class="main"><b>Warning:</b> Weight must be more than 0. For virtual products (downloadable products) weight must be 0.</span>');

define('HEADING_TITLE_SEARCH_MODEL', 'Αναζήτηση προϊόντος:');

define('TEXT_PRODUCTS_IMAGE_DIR', 'Μεταφόρτωση στον κατάλογο:');
define('TEXT_IMAGES_MAIN_DIRECTORY', 'Εικόνες');
define('TABLE_HEADING_YES','Ναι');
define('TABLE_HEADING_NO','Όχι');
define('TEXT_IMAGES_OVERWRITE', 'Αντικαταστήστε την υπάρχουσα εικόνα?');
define('TEXT_IMAGES_OVERWRITE1', 'Χρησιμοποιήστε Όχι για μη αυτόματα πληκτρολογημένα ονόματα');
define('TEXT_IMAGE_OVERWRITE_WARNING','ΠΡΟΕΙΔΟΠΟΙΗΣΗ: Το αρχείο FILENAME ενημερώθηκε αλλά δεν αντικαταστάθηκε');

define('TEXT_CAT_DELPHOTO', 'Διαγραφή εικόνας');
define('TEXT_CAT_ACTION', 'Δράση');
define('TEXT_CAT_IMAGE', 'Εικόνα');
define('TEXT_CAT_EDIT', 'Επεξεργασία');
define('TEXT_CAT_SUBCATS', 'Υποκατηγορίες');
define('TEXT_CAT_PRODUCTS', 'Προϊόντα της κατηγορίας');
define('TEXT_CAT_MODEL', 'Μοντέλο');
define('TEXT_CAT_QTY', 'Ποσότητα');
define('TEXT_CAT_PRICE', 'Τιμή');
define('TEXT_FILTER_SPECIALS','Με ειδικές προσφορές');
define('TEXT_FILTER_CONCOMITANT','Συνακόλουθος');
define('TEXT_FILTER_TOP','ΑΝΩ');
define('TEXT_FILTER_NEW','Νεο');
define('TEXT_FILTER_STOCK','Στοκ');
define('TEXT_FILTER_RECOMMEND','Συνιστώμενα προιόντα');

// WebMakers.com Added: Attribute Copy Option
define('TEXT_COPY_ATTRIBUTES_ONLY','Χρησιμοποιείται μόνο για διπλότυπα προϊόντα ...');
define('TEXT_COPY_ATTRIBUTES','Αντιγράψτε τα χαρακτηριστικά των προϊόντων για την αντιγραφή?');
define('TEXT_COPY_ATTRIBUTES_YES','Ναι');
define('TEXT_COPY_ATTRIBUTES_NO','Όχι');

//Button
define('BUTTON_CANCEL_NEW', 'Ματαίωση');
define('BUTTON_BACK_NEW', 'Πίσω');
define('BUTTON_NEW_CATEGORY_NEW', 'Νέα κατηγορία');
define('BUTTON_NEW_PRODUCT_NEW', 'Νέο προϊόν');


define('TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_NOTHING','Τίποτα');
define('TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_ALL','Όλα τα προϊόντα των υποκατηγοριών');
define('TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_TOP','Κορυφαίες πωλήσεις αυτής της κατηγορίας');
define('TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_RECOMMENDED','Συνιστάται για αυτήν την κατηγορία');
define('TEXT_EDIT_CATEGORIES_DISPLAY_PRODUCTS_NEW','Καινοτομίες αυτής της κατηγορίας');
define('TEXT_ID_XML_CATEGORY','ID κατηγορίας XML');
define('TEXT_VENDOR_XML_CATEGORY','Vendor κατηγορίας XML');
define('ERROR_SYS_CATEGORY_EXIST','Το αναγνωριστικό XML της κατηγορίας %s έχει ήδη καταληφθεί από <a href="'.DIR_WS_ADMIN . 'categories.php?cID=%s&action=edit_category" target="_blank">άλλη κατηγορία</a>');
?>