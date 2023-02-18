<?php
/*
  $Id: template_configuration.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Προσαρμογή Template');
define('TABLE_HEADING_TEMPLATE', 'Ονομα');
define('TABLE_HEADING_TEMPLATE_FOLDER', 'Folder');
define('TABLE_HEADING_ACTION', 'Δράση');
define('TABLE_HEADING_ACTIVE', 'Κατάσταση');
define('TABLE_HEADING_COLOR', 'Χρώμα');
define('CONTENT_WIDTH', 'Πλάτος περιεχομένου');
define('CONTENT_WIDTH_CONTENT', 'Μέγιστο πλάτος 100%');
define('CONTENT_WIDTH_FIX', 'Μέγιστο πλάτος 1440 pixel');
define('SHOW_SHORTCUT_TREE', 'Εμφάνιση υποκατηγορίες μόνο για την τρέχουσα κατηγορία');
define('SHOW_ALL_LABELS_ON_DESKTOP', 'Εμφάνιση όλων των ετικετών στην επιφάνεια εργασίας');
define('SHOW_ALL_LABELS_ON_MOBILE', 'Εμφάνιση όλων των ετικετών στο κινητό');
define('SHOW_SPECIAL_LABEL_WITH_SPECIAL', 'Εμφάνιση ειδικής ετικέτας όταν υπάρχει ειδική');

define('TABLE_HEADING_DISPLAY_COLUMN_LEFT', 'Εμφάνιση αριστερής στήλης?');
define('SLIDER_SIZE_CONTENT', 'Τοποθετώντας ένα ρυθμιστικό');
define('SLIDER_RIGHT', 'Στη δεξιά στήλη');
define('SLIDER_CONTENT_WIDTH', 'Με πλάτος περιεχομένου');
define('SLIDER_CONTENT_WIDTH_100', 'Πλάτος σελίδας(100%)');

define('GENERAL_MODULES', 'Τα κύρια τμήματα του site');
define('HEADER_MODULES', 'Κεφαλίδες μπλοκ');
define('LEFT_MODULES', 'Αποκλεισμός στην αριστερή στήλη');
define('MAINPAGE_MODULES', 'Αποκλεισμός στην κύρια σελίδα');
define('FOOTER_MODULES', 'Υποσέλιδα μπλοκ');
define('OTHER_MODULES', 'Άλλα μπλοκ');

#from c\templates\solo\boxes\configuration.php:
define('ARTICLE_NAME', 'Article name');
define('TOPIC_NAME', 'Topic name');
define('LIMIT', 'Limit');
define('LIMIT_MOBILE', 'Όριο για κινητά');
define('COLS', 'Number of columns');
define('SLIDER_WIDTH_TITLE', 'Πλάτος');   
define('SLIDER_HEIGHT_TITLE', 'Υψος');
define('SLIDER_HEIGHT_MOBILE_TITLE', 'Υψος για κινητά'); 
define('SLIDER_AUTOPLAY_TITLE', 'Αυτόματη κύλιση');
define('SLIDER_AUTOPLAY_DELAY_TITLE', 'Αυτόματη καθυστέρηση κύλισης');

#from BD table infobox_configuration:
##FOOTER BOXES
define('F_ARTICLES_BOTTOM', 'Άρθρα στο υποσέλιδο');
define('F_FOOTER_CATEGORIES_MENU', 'Κατηγορίες στο υποσέλιδο');
define('F_TOP_LINKS', 'Σελιδες νικος πληροφοριών  στο υποσέλιδο');
define('F_MONEY_SYSTEM', 'Εμφάνιση συστημάτων πληρωμών');
define('F_SOCIAL', 'Εμφάνιση υποστέγων κοινωνικών δικτύων');
define('F_CONTACTS_FOOTER', 'Εμφάνιση επαφών στο υποσέλιδο');
define('F_WEB_STUDIO_LINK', 'Σύνδεσμος με τον πάροχο υπηρεσιών');
define('TEXT_UNAVAILABLE_IN_FREE_PACKAGE', 'Μη διαθέσιμο σε δωρεάν πακέτο');

##HEADER BOXES
define('H_LOGIN', 'Σύνδεση');
define('H_LOGO', 'Logo');
define('H_COMPARE', 'Σύγκριση');
define('H_LANGUAGES', 'Γλώσσες');
define('H_CURRENCIES', 'Νόμισμα');
define('H_ONLINE', 'Εμφάνιση ηλεκτρονικού συμβούλου');
define('H_SEARCH', 'Ψάξιμο');
define('H_SHOPPING_CART', 'Καλάθι αγορών');
define('H_WISHLIST', 'Λίστα επιθυμιών');
define('H_TEMPLATE_SELECT', 'Επιλογή προτύπου');
define('H_TOP_MENU', 'Μενού κατηγορίας');
define('H_TOP_MENU_MOBILE', 'Μενού Κινητό κατηγορία');
define('H_CALLBACK', 'Επανάκληση');
define('H_TOP_LINKS', 'Αρχικό μενού');
define('H_LOGIN_FB', 'Εμφάνιση σύνδεσης μέσω Facebook');

##OTHER_MODULES
/*define('O_LOGIN', 'Σύνδεση');
define('O_TEMPLATE_SELECT', 'Template Selection');
define('O_SHOPPING_CART', 'Shop cart');
define('O_SEARCH', 'Search');
define('O_ONLINE', 'Online chat');
define('O_COMPARE', 'Comparison');
define('O_CURRENCIES', 'Currency');
define('O_LANGUAGES', 'Languages');
define('O_TOP_LINKS', 'Top menu');
define('O_CALLBACK', 'Callback');
define('O_TOP_MENU', 'Category menu');*/
define('O_FILTER', 'Φίλτρο');
define('LIST_FILTER', 'Φίλτρο');

##LEFT_MODULES
define('L_FEATURED', 'Προτεινόμενα');
define('L_WHATS_NEW', 'Τι νέα μας');
define('L_SPECIALS', 'Προσφορές');
define('L_MANUFACTURERS', 'Κατασκευαστές');
define('L_BESTSELLERS', 'Κορυφαίες Πωλήσεις');
define('L_ARTICLES', 'Άρθρα');
define('L_POLLS', 'Δημοσκοπήσεις');
define('L_FILTER', 'Φίλτρο');
define('L_BANNER_1', 'Διαφήμιση 1');
define('L_BANNER_2', 'Διαφήμιση 2');
define('L_BANNER_3', 'Διαφήμιση 3');
define('L_SUPER', 'Κατηγορία');
define('L_SUPER_TOPIC', 'Τμήματα άρθρων');

##MAINPAGE_MODULES
define('M_ARTICLES_MAIN', 'Νέα');
define('M_BANNER_LONG', 'Πανό long');
define('M_BEST_SELLERS', 'Κορυφαίες πωλήσεις');
define('M_BROWSE_CATEGORY', 'Κατηγορία');
define('M_DEFAULT_SPECIALS', 'Προσφορές ');
define('M_FEATURED', 'Προτεινόμενα');
define('M_LAST_COMMENTS', 'Πρόσφατα σχόλια');
define('M_VIEW_PRODUCTS', 'Προβολές προϊόντων');
define('M_MAINPAGE', 'Κείμενο της κύριας σελίδας');
define('M_MANUFACTURERS', 'Κατασκευαστές');
define('M_MOST_VIEWED', 'Περισσότερες εμφανίσεις');
define('M_NEW_PRODUCTS', 'Νέο προϊόν');
define('M_SLIDE_MAIN', 'Ολισθητής εγω ');
define('M_BANNER_BLOCK', 'Διπλό banner στο κύριο');
define('M_BANNER_1', 'Πανω 1');
define('M_CATEGORIES_TABS', 'Categories tabs');
define('M_CATEGORIES_TABS_BEST_SELLERS', 'Κορυφαίες πωλήσεις');
define('M_CATEGORIES_TABS_NEW_PRODUCTS', 'Νέα στοιχεία');
define('M_SUBSCRIBE', 'Εγγραφείτε σε ένα νέο ενημερωτικό δελτίο');
define('M_SUBSCRIBE_SPECIAL', 'Έκπτωση συνδρομής');
define('M_SUBSCRIBE_SPECIAL_PERCENT', 'Ποσοστό έκπτωσης %');
define('M_SUBSCRIBE_COUPONE_MAIL', 'Υποβολή κουπονιού');
define('M_SUBSCRIBE_COUPONE', 'Κουπόνι');
define('H_TOGGLE_MOBILE_VISIBLE', 'Ορατότητα κατηγορίας');


##MAINPAGE_MODULES
define('G_HEADER_1', 'Οριζόντια γραμμή κεφαλίδας 1');
define('G_HEADER_2', 'Οριζόντια γραμμή κεφαλίδας 2');
define('G_LEFT_COLUMN', 'Αριστερή στήλη');
define('G_FOOTER_1', 'Οριζόντια γραμμή υποσέλιδου 1');
define('G_FOOTER_2', 'Οριζόντια γραμμή υποσέλιδου 2');



##MAINCONF
define('ADD_MODULE_MODULES', 'Προσθήκη μονάδας');
define('MAINCONF_MODULES', 'Βασικές ρυθμίσεις');
define('MC_COLOR_1', 'Χρώμα κειμένου');
define('MC_COLOR_2', 'Χρώμα συνδέσμου');
define('MC_COLOR_3', 'Χρώμα φόντου');
define('MC_COLOR_4', 'Caps φόντο');
define('MC_COLOR_5', 'Υπόβαθρο υπογείου');
define('MC_COLOR_6', 'Χρώμα κουμπιού');
define('MC_COLOR_BTN_TEXT', 'Button text');
define('MC_COLOR_GREY', 'Grey elements');
define('MC_SHOW_LEFT_COLUMN', 'Εμφάνιση / απόκρυψη της αριστερής στήλης');
define('MC_PRODUCT_QNT_IN_ROW', 'Όριο προϊόντων στη σειρά');
define('MC_PRODUCT_MARGIN','Margin between products');
define('MAX_DISPLAY_SEARCH_RESULTS_TITLE', 'Όριο προϊόντων στη σελίδα');
define('MC_THUMB_WIDTH', 'Πλάτος αντίχειρα');
define('MC_THUMB_HEIGHT', 'Ύψος αντίχειρα');
define('H_LOGO_WIDTH', 'Πλάτος λογότυπου');
define('H_LOGO_HEIGHT', 'Ύψος λογότυπου');
define('H_LOGO_WIDTH_MOBILE', 'Πλάτος λογότυπου (mobile)');
define('H_LOGO_HEIGHT_MOBILE', 'Ύψος λογότυπου (mobile)');
define('MC_SHOW_THUMB2', 'Εμφανίστε τη δεύτερη εικόνα με το δείκτη του ποντικιού');
define('MC_THUMB_FIT', 'Προσαρμογή εικόνας');

define('MAX_DISPLAY_SEARCH_RESULTS_TITLE_INFO', 'Καθορίστε τον επιθυμητό αριθμό προϊόντων ανά σελίδα');
define('CONTENT_WIDTH_INFO', 'Επιλέξτε το πλάτος περιεχομένου από τις προτεινόμενες επιλογές');
define('MC_PRODUCT_QNT_IN_ROW_INFO', 'Καθορίστε τον επιθυμητό αριθμό στοιχείων ανά γραμμή');
define('MC_THUMB_HEIGHT_INFO', 'Καθορίστε το ύψος της μικρής εικόνας');
define('MC_THUMB_WIDTH_INFO', 'Καθορίστε το πλάτος της μικρής εικόνας');
define('MC_SHOW_LEFT_COLUMN_INFO', 'Μπορείτε να ενεργοποιήσετε / απενεργοποιήσετε την εμφάνιση της αριστερής στήλης περιεχομένου');
define('MC_LOGO_WIDTH_INFO', 'Καθορίστε το πλάτος του λογότυπου του ιστότοπού σας');
define('MC_LOGO_HEIGHT_INFO', 'Καθορίστε το ύψος του λογότυπου σας');
define('MC_PRODUCT_MARGIN_INFO', 'Μπορείτε να καθορίσετε την επιθυμητή απόσταση μεταξύ των προϊόντων');
define('LIST_DISPLAY_TYPE_INFO', 'Μπορείτε να καθορίσετε τη μορφή εξόδου του προϊόντος: λίστα - λίστα, στήλες - πίνακας');
define('MC_THUMB_FIT_INFO', 'Επιλέξτε την επιθυμητή τιμή: περιέχει - διατηρεί τις αναλογίες της εικόνας, κάλυμμα - κλιμακώνει την εικόνα σε ολόκληρο το μπλοκ');
define('MC_SHOW_THUMB2_INFO', 'Μπορείτε να ενεργοποιήσετε/απενεργοποιήσετε το εφέ αλλαγής μιας εικόνας σε άλλη όταν τοποθετείτε το δείκτη του ποντικιού πάνω της');
define('MC_COLOR_1_INFO', 'Κάντε κλικ στην παλέτα για να αλλάξετε το χρώμα του κειμένου για τον ιστότοπό σας');
define('MC_COLOR_4_INFO', 'Κάντε κλικ στην παλέτα για να αλλάξετε το φόντο της κεφαλίδας του ιστότοπου');
define('MC_COLOR_5_INFO', 'Κάντε κλικ στην παλέτα για να αλλάξετε το φόντο του υποσέλιδου');
define('MC_COLOR_2_INFO', 'Κάντε κλικ στην παλέτα για να αλλάξετε το χρώμα των συνδέσμων του ιστότοπού σας');
define('MC_COLOR_6_INFO', 'Κάντε κλικ στην παλέτα για να αλλάξετε το χρώμα των κουμπιών του ιστότοπου');
define('MC_COLOR_3_INFO', 'Κάντε κλικ στην παλέτα για να αλλάξετε το χρώμα φόντου του ιστότοπού σας');
define('MC_COLOR_BTN_TEXT_INFO', 'Κάντε κλικ στην παλέτα για να αλλάξετε το χρώμα του κειμένου για τα κουμπιά');
define('MC_COLOR_GREY_INFO', 'Κάντε κλικ στην παλέτα για να αλλάξετε το χρώμα των γκρι στοιχείων');

define('MAX_DISPLAY_SEARCH_RESULTS_TITLE_INFO_DEL', 'Διαγραφή τιμής');
define('MAX_DISPLAY_SEARCH_RESULTS_TITLE_INFO_ADD', 'Προσθέστε αξία');
define('MC_PRODUCT_QNT_IN_ROW_INFO_0', 'Τηλέφωνο < 768px. Η τιμή \'3\' είναι ίση με \'2\' εάν ≤ 480px');
define('MC_PRODUCT_QNT_IN_ROW_INFO_1', 'Tablet (κάθετο) < 992px');
define('MC_PRODUCT_QNT_IN_ROW_INFO_2', 'Tablet (οριζόντια) < 1200px');
define('MC_PRODUCT_QNT_IN_ROW_INFO_3', 'Εμφάνιση < 1600px');
define('MC_PRODUCT_QNT_IN_ROW_INFO_4', 'Οθόνη ≥ 1600px');

##LISTING
define('LISTING_MODULES', 'Λίστα προϊόντων');
define('LIST_MODEL', 'Εμφάνιση μοντέλου προϊόντων');
define('LIST_BREADCRUMB', 'Εμφάνιση ψίχουλα ψωμιού');
define('LIST_CONCLUSION', 'Εμφάνιση μορφής εξόδου προϊόντος');
define('LIST_QUANTITY_PAGE', 'Εμφάνιση του αριθμού των προϊόντων στη σελίδα');
define('LIST_SORTING', 'Εμφάνιση ταξινόμησης αγαθών');
define('LIST_LOAD_MORE', 'Εμφανίστε το κουμπί "Εμφάνιση περισσότερων"');
define('LIST_NUMBER_OF_ROWS', 'Εμφάνιση σελίδας');
define('LIST_PRESENCE', 'Εμφάνιση της διαθεσιμότητας του προϊόντος');
define('LIST_LABELS', 'Εμφάνιση ετικετών');

##PRODUCT_INFO
define('PRODUCT_INFO_MODULES', 'Σελίδα προϊόντος');
define('P_MODEL', 'Εμφάνιση μοντέλου προϊόντων');
define('P_BREADCRUMB', 'Εμφάνιση ψίχουλα ψωμιού');
define('P_SOCIAL_LIKE', 'Εμφάνιση συμπαθειών μέσω κοινωνικών δικτύων');
define('P_PRESENCE', 'Εμφάνιση της διαθεσιμότητας του προϊόντος');
define('P_BUY_ONE_CLICK', 'Εμφάνιση "Αγορά με ένα κλικ"');
define('P_ATTRIBUTES', 'Εμφάνιση χαρακτηριστικών προϊόντος');
define('P_SHARE', 'Εμφάνιση κοινής χρήσης στα κοινωνικά δίκτυα');
define('P_COMPARE', 'Εμφάνιση σημείου σύγκρισης');
define('P_WISHLIST', 'Εμφάνιση γραμμής επιθυμιών');
define('P_RATING', 'Δείτε την αξιολόγηση προϊόντων');
define('P_SHORT_DESCRIPTION', 'Εμφάνιση σύντομης περιγραφής');
define('P_RIGHT_SIDE', 'Εμφάνιση στήλης δεξιά');
define('P_TAB_DESCRIPTION', 'Εμφάνιση καρτέλας περιγραφής');
define('P_TAB_CHARACTERISTICS', 'Εμφάνιση καρτέλας δυνατοτήτων');
define('P_TAB_COMMENTS', 'Εμφάνιση καρτέλας σχολίων');
define('P_TAB_PAYMENT_SHIPPING', 'Εμφάνιση της καρτέλας πληρωμής και παράδοσης');
define('P_WARRANTY', 'Εγγύηση');
define('P_DRUGIE', 'Εμφάνιση παρόμοιων προϊόντων');
define('P_XSELL', 'Εμφάνιση σχετικών προϊόντων');
define('P_SHOW_QUANTITY_INPUT', 'Εμφάνιση πεδίου "Ποσότητα προϊόντων"');
define('P_FILTER', 'Φίλτρο');
define('P_BETTER_TOGETHER', 'Εμφάνιση μπλοκ Better Together');
define('LIST_SHOW_PDF_LINK', 'Εμφάνιση συνδέσμου PDF');
define('LIST_DISPLAY_TYPE', 'Μορφή εξόδου προϊόντος');
define('INSTAGRAM_URL', 'Σύνδεσμος ρυθμιστικού');
define('M_INSTAGRAM', 'Ίνσταγκραμ');
define('M_SEARCH_QUERIES', 'Ερωτήματα αναζήτησης');
define('SHOW_SHORTCUT_LEFT_TREE', 'Εμφάνιση συμπτυγμένου αριστερού δέντρου');
define('F_FOOTER_CATEGORIES', 'Κατηγορίες στο υποσέλιδο');
define('P_SHOW_PROD_QTY_ON_PAGE', 'Εμφάνιση υπολειπόμενου αποθέματος');
define('P_LABELS', 'Εμφάνιση ετικετών');
