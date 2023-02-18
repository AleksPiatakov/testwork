<?php
/*
  $Id: products_multi.php, v 2.0

  autor: sr, 2003-07-31 / sr@ibis-project.de

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'πολλαπλή διαχείρηση Προϊόντων');
define('HEADING_TITLE_SEARCH', 'Αναζήτηση:');
define('HEADING_TITLE_GOTO', 'Πηγαινε σε:');

define('TABLE_HEADING_ID', 'Ταυτότητα');
define('TABLE_HEADING_CATEGORIES_CHOOSE', 'Επιλογή');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Κατηγορίες / Προϊόντα');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Μοντέλο');
define('TABLE_HEADING_ACTION', 'Δράση');
define('TABLE_HEADING_PRODUCTS_QUANTITY', 'Ποσότητα');
define('TABLE_HEADING_MANUFACTURERS_NAME', 'Κατασκευαστής');
define('TABLE_HEADING_STATUS', 'Κατάσταση');

define('DEL_DELETE', 'διαγραφή  προϊόντος');
define('DEL_CHOOSE_DELETE_ART', 'Πώς να το διαγράψετε?');
define('DEL_THIS_CAT', 'μόνο από αυτή την κατηγορία');
define('DEL_COMPLETE', 'κατάργηση συνολικού προϊόντος ');

define('TEXT_NEW_PRODUCT', 'Νέο προϊόν σε &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Κατηγορίες:');
define('TEXT_ATTENTION_DANGER', '');
/*
define('TEXT_ATTENTION_DANGER', '<br><br><span class="dataTableContentRedAlert">!!! Внимание !!! пожалуйста прочтите !!!</span><br><br><span class="dataTableContentRed">Этот инструмент меняет таблицы "products_to_categories" (и в случае  \' полностью удалить товар\' даже "products" и "products_description" among others; через функцию \'tep_remove_product\') - поэтому делать резервную копию этих таблиц перед каждым использованием этого инструмента ОЧЕНЬ рекомендуется. Причины:<br><br>This tool deletes, moves or copies all via checkbox selected products without any interim step or warning, that means immediately after clicking on the go-button.</span><br><br><span class="dataTableContentRedAlert">Please take care:</span><ul><li>Pay very great attention when using <strong>\'delete the complete product\'</strong>. This function deletes all selected products immediately, without interim step or warning, and completely from all tables where these products belong to.</strong></li><li>While choosing <strong>\'delete product only in this category\'</strong>, no products are deleted completely, but only their links to the actually opened category - even when it\'s the only category-link of the product, and without warning, that means: be careful with this delete tool as well.</li><li>While <strong>copying</strong>, products are not duplicated, they are only linked to the new category chosen.</li><li>Products are only <strong>moved</strong> resp. <strong>copied</strong> to a new category in case they do not exist there allready.</li></ul>');
*/
define('TEXT_MOVE_TO', 'Μεταφορά σε');
define('TEXT_CHOOSE_ALL', 'Ελεγχος όλων');
define('TEXT_CHOOSE_ALL_REMOVE', 'καταργήστε την επιλογή');
define('TEXT_SUBCATEGORIES', 'Υποκατηγορίες:');
define('TEXT_PRODUCTS', 'Προϊόντα:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Τιμή:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Φορολογική κατηγορία:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'av. rating:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Ποσότητα:');
define('TEXT_DATE_ADDED', 'Πρόστέθηκε:');
define('TEXT_DATE_AVAILABLE', 'Διαθέσιμο:');
define('TEXT_LAST_MODIFIED', 'τροποποιήθηκε:');
define('TEXT_IMAGE_NONEXISTENT', 'Η ΕΙΚΟΝΑ ΔΕΝ ΥΠΑΡΧΕΙ');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Εισαγάγετε νέα κατηγορία ή προϊόν σε <br>&nbsp;<br><b>%s</b>');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Επισκευθήτε <a href="http://%s" target="κενό"><u>αυτή η σελίδα</u></a> για περισσότερες πληροφορίες.');
define('TEXT_PRODUCT_DATE_ADDED', 'Αυτό το προϊόν προστέθηκε στον κατάλογο μας %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Αυτό το προϊόν θα είναι διαθέσιμο στις %s.');

define('TEXT_EDIT_INTRO', 'Κάντε αλλαγές');
define('TEXT_EDIT_CATEGORIES_ID', 'Ταυτότητα:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Όνομα:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Εικόνα:');
define('TEXT_EDIT_SORT_ORDER', 'Σειρά ταξινόμησης:');

define('TEXT_INFO_COPY_TO_INTRO', 'Παρακαλώ επιλέξτε την νέα κατηγορία που θέλετε να αντιγράψετε το προϊόν');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Τρέχουσα κατηγορία:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Νέα κατηγορία');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Αλλαγή κατηγορίας');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Διαγραφή κατηγορίας');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Μετακίνηση κατηγορίας');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Διαγράψτε το προϊόν');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Μετακινήστε το προϊόν');
define('TEXT_INFO_HEADING_COPY_TO', 'Αντέγραψε στο');
define('LINK_TO', 'Συνδέω με');

define('TEXT_DELETE_CATEGORY_INTRO', 'Είστε βέβαιοι ότι θέλετε να διαγράψετε αυτήν την κατηγορία?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Είστε βέβαιοι ότι θέλετε να διαγράψετε αυτό το προϊόν?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>ΠΡΟΕΙΔΟΠΟΙΗΣΗ:</b> %s υπάρχουν υποκατηγορίες που εξακολουθούν να συνδέονται με αυτήν την κατηγορία!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>WARNING:</b> %s υπαρχουν προϊόντα που εξακολουθούν να συνδέονται με αυτή την κατηγορία!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Επιλέξτε κατηγορία που θέλετε να μετακινήσετε <b>%s</b>');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Επιλέξτε κατηγορία που θέλετε να μετακινήσετε <b>%s</b>');
define('TEXT_MOVE', 'Μετακίνιση <b>%s</b> to:');

define('TEXT_NEW_CATEGORY_INTRO', 'Συμπληρώστε τις παρακάτω πληροφορίες για τη νέα κατηγορία');
define('TEXT_CATEGORIES_NAME', 'Ονομα:');
define('TEXT_CATEGORIES_IMAGE', 'Εικόνα:');
define('TEXT_SORT_ORDER', 'Σειρά ταξινόμησης:');     

define('TEXT_PRODUCTS_STATUS', 'Κατάσταση:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Ημερομηνία διαθεσιμότητας:');
define('TEXT_PRODUCT_AVAILABLE', 'Σε απόθεμα');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Αναμένεται');
define('TEXT_PRODUCTS_MANUFACTURER', 'Κατασκευαστής:');
define('TEXT_PRODUCTS_NAME', 'Ονομα:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Περιγραφή:');
define('TEXT_PRODUCTS_QUANTITY', 'Ποσότητα:');
define('TEXT_PRODUCTS_MODEL', 'Μοντελο:');
define('TEXT_PRODUCTS_IMAGE', 'Εικονα:');
define('TEXT_PRODUCTS_URL', 'URL:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<μικρό>(without http://)</small>');
define('TEXT_PRODUCTS_PRICE', 'Τιμή:');
define('TEXT_PRODUCTS_WEIGHT', 'Βάρος:');
define('TEXT_NONE', '--κανενα--');

define('EMPTY_CATEGORY', 'Κενή κατηγορία');

define('TEXT_HOW_TO_COPY', 'Πώς να αντιγράψετε:');
define('TEXT_COPY_AS_LINK', 'Αντιγραφή ως σύνδεσμος');
define('TEXT_COPY_AS_DUPLICATE', 'Αντιγράφή ως διπλότυπο');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Σφάλμα: δεν μπορεί να συνδεθεί με την ίδια κατηγορία.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Σφάλμα: Ο φάκελος με εικόνες δεν είναι εγγράψιμος: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Σφάλμα: Ο φάκελος με εικόνες δεν υπάρχει: ' . DIR_FS_CATALOG_IMAGES);

define('TEXT_PMU_CANCEL', 'Ακυρο');
define('TEXT_DUBLICATE_TO', 'Αντίγραψτε σε');
define('TEXT_PMU_LINK', 'συνδέω με');
define('TEXT_PMU_DEL', 'διαγράφη');
define('TEXT_PMU_DUBL_CATEGORY', 'Διπλότυπος κατάλογος:');
define('BUTTON_PMU_SUBMIT', 'υποβάλλουν');