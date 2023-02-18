<?php
/*
  $Id: english.php,v 1.3 2003/09/28 23:37:26 anotherlango Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

//Admin begin
// header text in includes/header.php
define('HEADER_TITLE_LOGOFF', 'Αποσύνδεση');
define('MODULE_PAYMENT_COD_STATUS_TITLE', 'Google SiteMaps');
define('MODULE_PAYMENT_COD_STATUS', 'Google SiteMaps');

// configuration box text in includes/boxes/administrator.php
define('BOX_HEADING_ADMINISTRATOR', 'Διαχειριστές');
define('BOX_ADMINISTRATOR_MEMBERS', 'Ομάδες μελών');
define('BOX_ADMINISTRATOR_MEMBER', 'Μέλη');
define('BOX_ADMINISTRATOR_BOXES', 'Πρόσβαση αρχείων');
define('BOX_ADMINISTRATOR_ACCOUNT_UPDATE', 'Αναβάθμιση λογαριασμού');

// images
define('IMAGE_FILE_PERMISSION', 'Άδεια αρχείου');
define('TEXT_MENU_REVIEWS', 'Κριτικές');
define('SQL_MODE_RECOMMENDATION_TEXT', "For further correct work, you need to contact the hosting administration to reset the sql_mode variable in Mysql");
define('ROBOTS_TXT_RECOMMENDATION_TEXT', 'Robots.txt is not included on your site, for successful promotion we recommend that you enable it on <a target="_blank" href="/'.$admin.'/configuration.php?gID=1">page</a>');
define('CRITICAL_CSS_TXT_RECOMMENDATION_TEXT', '<span class="critical-text">Χρειάζεστε δημιουργία κρίσιμου CSS</span> <span class="critical-process">Επεξεργασία...περιμένετε</span><a class="start-generate-critical" href="javascript:void(0);">Αρχή</a>');
define('ALERT_ERRORS_BLOCK_TITLE', 'Ειδοποιήσεις');
define('DOMEN_IN_ROBOTS_TXT_RECOMMENDATION_TEXT', '<span class="robots-txt-text">στο Robots.txt η οδηγία Host δεν ταιριάζει με το όνομα του ιστότοπού σας, για επιτυχημένη προώθηση το προτείνουμε</span> <span class="generate-robots-txt-process">Επεξεργασία ...παρακαλώ περιμένετε</span><a class="start-generate-robots-txt" href="javascript:void(0);"> να αναγεννηθεί</a>');

define('GOOGLE_FEED_MODULE_ENABLED_TITLE', 'Google Feed');
define('IMAGE_GROUPS', 'Λίστα ομάδων');
define('TEXT_PRODILE_INFO_CHANGE_PASSWORD','Αλλάξτε τον κωδικό σας ');
define('IMAGE_INSERT_FILE', 'Εισαγωγή αρχείου');
define('IMAGE_MEMBERS', 'Λίστα μελών');
define('IMAGE_NEW_GROUP', 'Νέα ομάδα');
define('IMAGE_NEW_MEMBER', 'Νέο μέλος');
define('IMAGE_NEXT', 'Επόμενο');
define('HEADER_FRONT_LINK_TEXT', 'Go to site');


define('ONE_PAGE_CHECKOUT_TITLE', 'Ολοκλήρωση αγοράς');
define('BROWSE_BY_CATEGORIES_TITLE', 'Αναζήτηση ανά κατηγορίες');
define('SEO_TITLE', 'SEO URLs');

// constants for use in tep_prev_next_display function
define('TEXT_DISPLAY_NUMBER_OF_FILENAMES', 'Εμφάνιση <b>%d</b> to <b>%d</b> (of <b>%d</b> ονόματα αρχείων)');
define('TEXT_DISPLAY_NUMBER_OF_MEMBERS', 'Εμφάνιση <b>%d</b> to <b>%d</b> (of <b>%d</b> ονόματα αρχείων)');
//Admin end

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'en_US'
// on FreeBSD 4.0 I use 'en_US.ISO_8859-1'
// this may not work under win32 environments..
setlocale(LC_TIME, 'el_GR.UTF-8');
define('DATE_FORMAT_SHORT', '%m/%d/%Y');  // this is used for strftime()
//define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT_LONG', '%d %B %Y'); // this is used for strftime()
define('DATE_FORMAT', 'm/d/Y'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'm/d/Y H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');
define('DATE_FORMAT_SPIFFYCAL', 'MM/dd/yyyy');  //Use only 'dd', 'MM' and 'yyyy' here in any order


define('TEXT_DAY_1', 'Δευτέρα');
define('TEXT_DAY_2', 'Τρίτη');
define('TEXT_DAY_3', 'Τετάρτη');
define('TEXT_DAY_4', 'Πέμπτη');
define('TEXT_DAY_5', 'Παρασκευή');
define('TEXT_DAY_6', 'Σάββατο');
define('TEXT_DAY_7', 'Κυριακή');
define('TEXT_DAY_SHORT_1','MON');
define('TEXT_DAY_SHORT_2','TUE');
define('TEXT_DAY_SHORT_3','WED');
define('TEXT_DAY_SHORT_4','THU');
define('TEXT_DAY_SHORT_5','FRI');
define('TEXT_DAY_SHORT_6','SAT');
define('TEXT_DAY_SHORT_7','SUN');
define('TEXT_MONTH_BASE_1', 'Ιανουάριος');
define('TEXT_MONTH_BASE_2', 'Φεβρουάριος');
define('TEXT_MONTH_BASE_3', 'Μάρτιος');
define('TEXT_MONTH_BASE_4', 'Απρίλιος');
define('TEXT_MONTH_BASE_5', 'Μάιος');
define('TEXT_MONTH_BASE_6', 'Ιούνιος');
define('TEXT_MONTH_BASE_7', 'Ιούλιος');
define('TEXT_MONTH_BASE_8', 'Αύγουστος');
define('TEXT_MONTH_BASE_9', 'Σεπτέμβριος');
define('TEXT_MONTH_BASE_10', 'Οκτώβριος');
define('TEXT_MONTH_BASE_11', 'Νοέμβριος');
define('TEXT_MONTH_BASE_12', 'Δεκέμβριος');
define('TEXT_MONTH_1', 'Ιανουάριος');
define('TEXT_MONTH_2', 'Φεβρουάριος');
define('TEXT_MONTH_3', 'Martha');
define('TEXT_MONTH_4', 'Απρίλιος');
define('TEXT_MONTH_5', 'Μάιος');
define('TEXT_MONTH_6', 'Ιούνιος');
define('TEXT_MONTH_7', 'Ιούλιος');
define('TEXT_MONTH_8', 'Αύγουστος');
define('TEXT_MONTH_9', 'Σεπτέμβριος');
define('TEXT_MONTH_10', 'Οκτώβριος');
define('TEXT_MONTH_11', 'Νοέμβριος');
define('TEXT_MONTH_12', 'Δεκέμβριος');

// Global entries for the <html> tag
define('HTML_PARAMS', 'dir="ltr" lang="el"');

// charset for web pages and emails
define('CHARSET', 'utf-8');

// page title
define('TITLE', 'Solomono Admin');

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Διαχειριστής');
define('HEADER_TITLE_SUPPORT_SITE', 'osCommerce');
define('HEADER_TITLE_ONLINE_CATALOG', 'Κατάλογος');
define('HEADER_TITLE_ADMINISTRATION', 'Διαχειριστής');
define('HEADER_TITLE_CHAINREACTION', 'Chainreactionweb');
define('HEADER_TITLE_PHESIS', 'PHESIS Loaded6');

define('HEADER_TITLE_HELLO', 'Χαίρετε');
define('HEADER_ADMIN_TEXT', 'Adminpanel');
define('HEADER_ORDERS_TODAY', 'Παραγγελίες σήμερα: ');
define('HEADER_GO_TO_SITE', 'στην ιστοσελίδα');

// MaxiDVD Added Line For WYSIWYG HTML Area: BOF
define('BOX_CATALOG_DEFINE_MAINPAGE', 'Ορίστε την κύρια σελίδα');
define('BOX_CATALOG_STATS_SEARCH_KEYWORDS', "Σχεδιασμός λέξεων-κλειδιών");
// MaxiDVD Added Line For WYSIWYG HTML Area: EOF
define('BOX_CATALOG_CATEGORIES_PRODUCTS_MULTI', 'πολλαπλή επεξεργασία');
define('BOX_TOOLS_COMMENT8R', 'Σχόλια');
define('BOX_TOOLS_MYSQL_PERFORMANCE', 'δευτερευοντα ερωτήματα');
define('BOX_GOOGLE_SITEMAP', 'Google SiteMaps');
define('BOX_CLEAR_IMAGE_CACHE', 'Εκκαθάριση προσωρινής μνήμης εικόνων');



define('TOOLTIP_STORE_NAME', 'Αναφέρετε το αρχικό όνομα του καταστήματος που προσελκύει πελάτες, το θυμούνται οι πελάτες και χρησιμεύει για να ξεχωρίζει και να ξεχωρίζει από παρόμοια καταστήματα - ανταγωνιστές.');
define('TOOLTIP_STORE_OWNER', 'Προσδιορίστε τον ιδιοκτήτη του καταστήματος');
define('TOOLTIP_SHOW_BASKET_ON_ADD_TO_CART', 'Ενεργοποίηση, το καλάθι θα είναι διαθέσιμο κατά την προσθήκη ενός προϊόντος, έτσι ώστε ο επισκέπτης να μην έχει ερωτήσεις ότι το προϊόν έχει προστεθεί στο καλάθι.');
define('TOOLTIP_USE_DEFAULT_LANGUAGE_CURRENCY', 'Ενεργοποιήστε την αυτόματη αλλαγή του νομίσματος σύμφωνα με την τρέχουσα γλώσσα του ιστότοπου.');
define('TOOLTIP_CHANGE_BY_GEOLOCATION', 'Ενεργοποιήστε την αλλαγή του νομίσματος και της γλώσσας του ιστότοπου με βάση τη γεωγραφική τοποθεσία.');
define('TOOLTIP_GET_BROWSER_LANGUAGE', 'Ενεργοποιήστε την αλλαγή του νομίσματος του ιστότοπου ανάλογα με τη γλώσσα του προγράμματος περιήγησης.');
define('TOOLTIP_STORE_BANK_INFO', 'Σας επιτρέπει να ορίσετε ακριβείς τραπεζικές πληροφορίες για λεπτομέρειες τιμολογίου');
define('TOOLTIP_ONEPAGE_LOGIN_REQUIRED', 'Ενεργοποίηση και η σύνδεση χρήστη/πελάτη θα απαιτείται πάντα');
define('TOOLTIP_REVIEWS_WRITE_ACCESS', 'Ενεργοποιήστε και μόνο οι εγγεγραμμένοι χρήστες θα μπορούν να αφήνουν τα σχόλιά τους');
define('TOOLTIP_ROBOTS_TXT', 'Προστασία ολόκληρου του ιστότοπου ή ορισμένων ενοτήτων του από την ευρετηρίαση');
define('TOOLTIP_MENU_LOCATION', 'Επιλέξτε θέση μενού: επάνω, αριστερά ή αριστερά σε σύμπτυξη');
define('TOOLTIP_DEFAULT_DATE_FORMAT', 'Επιλέξτε μορφή ημερομηνίας');
define('TOOLTIP_SET_HTTPS', 'Ενεργοποιήστε την επέκταση πρωτοκόλλου HTTPS για υποστήριξη κρυπτογράφησης για αυξημένη ασφάλεια');
define('TOOLTIP_SET_WWW', 'Επιλέξτε τη ρύθμιση όπου θα ανακατευθύνετε: απενεργοποιήστε, www->no-www ή no-www->www');
define('TOOLTIP_ENABLE_DEBUG_PAGE_SPEED', 'Ενεργοποιήστε τον εντοπισμό σφαλμάτων φόρτωσης σελίδας για να βρείτε και να διορθώσετε σφάλματα στο σενάριο');
define('TOOLTIP_STORE_SCRIPTS', 'Μπορείτε να συμπεριλάβετε επιπλέον σενάρια JS');
define('TOOLTIP_STORE_METAS', 'Μπορείτε να συμπεριλάβετε πρόσθετες μετα-ετικέτες στο κεφάλι');
define('TOOLTIP_MYSQL_PERFORMANCE_TRESHOLD', 'Ορίστε τον χρόνο σε "δευτερόλεπτα" πάνω από τον οποίο θα καταγράφονται αργά και δυνητικά προβληματικά ερωτήματα στη βάση δεδομένων');
define('TOOLTIP_STOCK_REORDER_LEVEL', 'Προσδιορίστε την ποσότητα των αγαθών σε απόθεμα');

define('TOOLTIP_TELEGRAM_NOTIFICATIONS_ENABLED', 'Μπορείτε να ενεργοποιήσετε/απενεργοποιήσετε τις ειδοποιήσεις Telegram');
define('TOOLTIP_TELEGRAM_TOKEN', 'Ειδικοί λογαριασμοί Telegram που δημιουργήθηκαν για αυτόματη επεξεργασία και αποστολή μηνυμάτων');
define('TOOLTIP_SMS_ENABLE', 'Μπορεί να ενεργοποιήσει/απενεργοποιήσει την υπηρεσία sms');
define('TOOLTIP_SMS_CUSTOMER_ENABLE', 'Μπορείτε να ενεργοποιήσετε / απενεργοποιήσετε τη δυνατότητα αποστολής sms στον πελάτη κατά την αγορά');
define('TOOLTIP_SMS_CHANGE_STATUS', 'Μπορείτε να ενεργοποιήσετε / απενεργοποιήσετε τη δυνατότητα αποστολής sms στον πελάτη κατά την αλλαγή της κατάστασης');
define('TOOLTIP_SMS_OWNER_ENABLE', 'Μπορείτε να ενεργοποιήσετε / απενεργοποιήσετε τη δυνατότητα αποστολής sms στον διαχειριστή κατά την αγορά');
define('TOOLTIP_SMS_OWNER_TEL', 'Εισαγάγετε/αλλάξτε τον αριθμό τηλεφώνου του διαχειριστή');


define('TOOLTIP_FACEBOOK_AUTH_STATUS', 'Μπορείτε να επιτρέψετε στους χρήστες να συνδεθούν στον ιστότοπό σας με έναν λογαριασμό Facebook. Αυτός είναι ένας πολύ καλός τρόπος για να κάνετε αυτή τη διαδικασία ευκολότερη και πιο βολική για τους χρήστες σας, καθώς και να αυξήσετε τον ');
define('TOOLTIP_FACEBOOK_APP_ID', 'Το αναγνωριστικό μέσων κοινωνικής δικτύωσης είναι ένας συνδυασμός αριθμών που διακρίνει έναν λογαριασμό από άλλους. Στο Διαδίκτυο, αυτό είναι ένα ανάλογο ενός διαβατηρίου, το οποίο συχνά χρειάζεται τη χρήση αξιόπιστων μεθόδων προστασίας. Ένας αριθμός αναγνώρισης δημιουργείται αυτόματα κατά την εγγραφή ενός προφίλ. Με αυτό, μπορείτε να βρείτε τις πληροφορίες που χρειάζεστε, ένα άτομο ή μια κοινότητα ενδιαφέροντος.');
define('TOOLTIP_FACEBOOK_APP_SECRET', 'Το μυστικό κλειδί είναι μια συσκευή για την προστασία του λογαριασμού σας στο Facebook. Είναι επίσης μια μέθοδος ελέγχου ταυτότητας δύο παραγόντων που αυξάνει το επίπεδο ασφάλειας κατά τη σύνδεση στο λογαριασμό σας.');
define('TOOLTIP_FACEBOOK_PIXEL_ID', 'Με τα δεδομένα που συλλέγει το Facebook Pixel, μπορείτε να παρακολουθείτε επισκέψεις και μετατροπές στον ιστότοπό σας, να βελτιστοποιείτε τις διαφημίσεις και να δημιουργείτε προσαρμοσμένα είδη κοινού για επαναστόχευση.');
define('TOOLTIP_DEFAULT_PIXEL_CURRENCY', 'Καθορίστε το νόμισμα στο οποίο θα σταλεί η τιμή του προϊόντος στο FaceBook Pixel');
define('TOOLTIP_FACEBOOK_GOALS_CLICK_ON_BUG_REPORT', 'Προορίζεται να περιγράψει τα σφάλματα που εντοπίστηκαν, τα οποία θα επιτρέψουν στην ομάδα ανάπτυξης να διορθώσει τα σφάλματα στο πρόγραμμα.');
define('TOOLTIP_FACEBOOK_GOALS_PHONE_CALL', 'Προβάλλοντας διαφημίσεις με αριθμό τηλεφώνου, μπορείτε να ενθαρρύνετε τους ανθρώπους να καλέσουν την εταιρεία σας για να κάνουν μια παραγγελία, να μάθουν περισσότερα για τα προϊόντα ή τις υπηρεσίες σας ή να προγραμματίσουν μια συνάντηση.');
define('TOOLTIP_FACEBOOK_GOALS_CLICK_FAST_BUY', 'Εάν τα αγαθά αγοράζονται τακτικά, συχνά τα χαρακτηριστικά είναι ήδη γνωστά στον αγοραστή, το καθήκον δεν είναι να επιλέξει, αλλά να βρει το σωστό, να το προσθέσει στο καλάθι και να δώσει γρήγορα μια παραγγελία.');
define('TOOLTIP_FACEBOOK_GOALS_CLICK_ON_CHAT', 'Το κουμπί συνομιλίας είναι ένα εικονίδιο που τοποθετείται κάπου στον ιστότοπό σας και επιτρέπει στους πελάτες να επικοινωνούν σε πραγματικό χρόνο με την ομάδα υποστήριξης πελατών. Με τη βοήθεια της διαδικτυακής συνομιλίας, οι ειδικοί σας μπορούν να επιλύσουν γρήγορα και αποτελεσματικά αιτήματα πελατών.');
define('TOOLTIP_FACEBOOK_GOALS_CALLBACK', 'Η αποστολή του κουμπιού επανάκλησης είναι να φέρει έναν πιθανό πελάτη στην επικοινωνία.');
define('TOOLTIP_FACEBOOK_GOALS_FILTER', 'Το φίλτρο καθιστά δυνατό τον περιορισμό της ποικιλίας σε μια επιλογή με τα χαρακτηριστικά που είναι πιο σχετικά με τις μεμονωμένες ανάγκες του χρήστη.');
define('TOOLTIP_FACEBOOK_GOALS_SUBSCRIBE', 'Παρέχει στους χρήστες τη δυνατότητα να οργανώνουν και να διατηρούν θεματικά ενημερωτικά δελτία ηλεκτρονικού ταχυδρομείου στα οποία μπορούν να εγγραφούν άλλοι χρήστες της υπηρεσίας.');
define('TOOLTIP_FACEBOOK_GOALS_LOGIN', 'login είναι η λέξη που θα χρησιμοποιηθεί για την είσοδο στον ιστότοπο ή την υπηρεσία. Πολύ συχνά, η σύνδεση ταιριάζει με το όνομα χρήστη, το οποίο θα είναι ορατό σε όλους τους συμμετέχοντες στην υπηρεσία.');
define('TOOLTIP_FACEBOOK_GOALS_ADD_REVIEW', 'Κριτικές πελατών - Σχόλια από χρήστες για τα προϊόντα ή τις υπηρεσίες σας. Για να αγοράσουν ένα προϊόν, το 89% των αγοραστών διαβάζει πρώτα κριτικές.');
define('TOOLTIP_FACEBOOK_GOALS_PAGE_VIEW', 'Μπορείτε να μάθετε πόσα άτομα έχουν δει και ζητήσει τον ιστότοπό σας');
define('TOOLTIP_FACEBOOK_GOALS_ADD_TO_CART', 'Το κουμπί «Προσθήκη στο καλάθι» υποδηλώνει την αγορά πολλών προϊόντων, όταν προστεθούν για πρώτη φορά στο καλάθι και έχει ήδη γίνει μια παραγγελία εκεί.');
define('TOOLTIP_FACEBOOK_GOALS_CHECKOUT_PROCESS', 'Η ποιότητα και η ευκολία χρήσης του καλαθιού αγορών είναι εγγύηση καλής διάθεσης για τους πελάτες σας, ένας αποτελεσματικός τρόπος για να αυξήσετε τη μετατροπή του ιστότοπου.');
define('TOOLTIP_FACEBOOK_GOALS_SEARCH_RESULTS', 'Μεταφέρει τον χρήστη στη σελίδα αποτελεσμάτων αναζήτησης');
define('TOOLTIP_FACEBOOK_GOALS_VIEW_CONTENT', 'Το ViewContent σάς ενημερώνει εάν κάποιος επισκέπτεται τη διεύθυνση URL μιας ιστοσελίδας.');
define('TOOLTIP_FACEBOOK_GOALS_COMPLETE_REGISTRATION', 'Παροχή πληροφοριών από έναν πελάτη σε αντάλλαγμα για μια υπηρεσία που παρέχεται από την εταιρεία σας');
define('TOOLTIP_FACEBOOK_GOALS_CONTACT_US_REQUEST', 'Στοιχεία επικοινωνίας ατόμου που έχει δείξει πραγματικό ενδιαφέρον για τα προϊόντα και τις υπηρεσίες της εταιρείας και μπορεί να γίνει πραγματικός πελάτης στο μέλλον.');
define('TOOLTIP_FACEBOOK_GOALS_ADD_TO_WISHLIST', 'Ένα από τα συμβάντα που σας επιτρέπει να παρακολουθείτε τις ενέργειες των χρηστών, να τις βελτιστοποιείτε και να δημιουργείτε κοινό');
define('TOOLTIP_FACEBOOK_GOALS_ADD_PAYMENT_INFO', 'Ένα από τα συμβάντα που σας επιτρέπει να παρακολουθείτε τις ενέργειες των χρηστών, να τις βελτιστοποιείτε και να δημιουργείτε κοινό');
define('TOOLTIP_FACEBOOK_GOALS_SUCCESS_PAGE', 'Ο πελάτης βλέπει ένα είδος τιμολογίου σχετικά με την τέλεια παραγγελία.');

define('TOOLTIP_GOOGLE_OAUTH_STATUS', 'Δυνατότητα ενεργοποίησης/απενεργοποίησης εξουσιοδότησης πελάτη μέσω Google');
define('TOOLTIP_GOOGLE_OAUTH_CLIENT_ID', 'Από προεπιλογή, η Google εκχωρεί ένα μοναδικό αναγνωριστικό πελάτη - Αναγνωριστικό πελάτη.');
define('TOOLTIP_GOOGLE_OAUTH_CLIENT_SECRET', 'Το CLIENT_SECRET χρησιμοποιείται για την αποθήκευση ελαφρώς πιο ευαίσθητων πληροφοριών, όπως η χρήση του api, οι πληροφορίες κίνησης και οι πληροφορίες χρέωσης');
define('TOOLTIP_GOOGLE_ANALYTICS_AND_TAGS_MODULE_ENABLED', 'Διαθέτει εργαλείο παρακολούθησης συμβάντων, επιτρέπει στις υπηρεσίες να συλλέγουν δεδομένα και να διεξάγουν αναλύσεις');
define('TOOLTIP_GOOGLE_ECOMM_SUCCESS_PAGE', 'Δυνατότητα ενεργοποίησης/απενεργοποίησης της σελίδας «αγορά» μετά την επιβεβαίωση της παραγγελίας');
define('TOOLTIP_GOOGLE_ECOMM_CHECKOUT_PAGE', 'Δυνατότητα ενεργοποίησης/απενεργοποίησης της σελίδας ολοκλήρωσης αγοράς');
define('TOOLTIP_GOOGLE_ECOMM_PRODUCT_DETAIL_PAGE', 'Δυνατότητα ενεργοποίησης/απενεργοποίησης της σελίδας προβολής προϊόντος');
define('TOOLTIP_GOOGLE_ECOMM_SEARCH_RESULTS', 'Δυνατότητα ενεργοποίησης/απενεργοποίησης της σελίδας αποτελεσμάτων αναζήτησης');
define('TOOLTIP_GOOGLE_ECOMM_HOME_PAGE', 'Δυνατότητα ενεργοποίησης/απενεργοποίησης της αρχικής σελίδας κατά τη φόρτωση του προγράμματος περιήγησης');
define('TOOLTIP_GOOGLE_SITE_VERIFICATION_KEY', 'Το κλειδί παρέχεται από την Google (χρειάζεται μόνο να εισαγάγετε το ίδιο το κλειδί)');
define('TOOLTIP_GOOGLE_RECAPTCHA_STATUS', 'Μπορείτε να ενεργοποιήσετε/απενεργοποιήσετε το Google Recaptcha (προστατεύοντας ιστότοπους από bots του Διαδικτύου και ταυτόχρονα βοηθώντας στην ψηφιοποίηση κειμένων βιβλίων)');
define('TOOLTIP_GOOGLE_RECAPTCHA_PUBLIC_KEY', 'Παρέχει υπηρεσία Google (για την προστασία των ιστοσελίδων από τα bots του Διαδικτύου και την ταυτόχρονη βοήθεια στην ψηφιοποίηση κειμένων βιβλίων)');
define('TOOLTIP_GOOGLE_RECAPTCHA_SECRET_KEY', 'Παρέχει υπηρεσία Google (για την προστασία των ιστοσελίδων από τα bots του Διαδικτύου και την ταυτόχρονη βοήθεια στην ψηφιοποίηση κειμένων βιβλίων)');




define('TOOLTIP_ENTRY_FIRST_NAME_MIN_LENGTH', "Καθορίστε τον ελάχιστο αριθμό χαρακτήρων στη στήλη 'Τιμή' για κάθε παράμετρο");
define('TOOLTIP_ENTRY_LAST_NAME_MIN_LENGTH', "Καθορίστε τον ελάχιστο αριθμό χαρακτήρων στη στήλη 'Τιμή' για κάθε παράμετρο");
define('TOOLTIP_ENTRY_EMAIL_ADDRESS_MIN_LENGTH', "Καθορίστε τον ελάχιστο αριθμό χαρακτήρων στη στήλη 'Τιμή' για κάθε παράμετρο");
define('TOOLTIP_MIN_DISPLAY_XSELL', "Καθορίστε τον ελάχιστο αριθμό χαρακτήρων στη στήλη 'Τιμή' για κάθε παράμετρο");

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Διαμόρφωση');
define('BOX_CONFIGURATION_MYSTORE', 'Το κατάστημά μου');
define('BOX_CONFIGURATION_LOGGING', 'Συνδεθείτε');
define('BOX_CONFIGURATION_CACHE', 'Cache κρυφη μνύμη');

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Ενότητες (μεθοδοι) ');
define('BOX_MODULES_PAYMENT', 'Πληρωμή');
define('BOX_MODULES_SHIPPING', 'Αποστολή');
define('BOX_MODULES_ORDER_TOTAL', 'Σύνολο Παραγγελίας');
define('BOX_MODULES_SHIP2PAY', 'Πληρωμή & αποστολή');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Κατάλογος');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Κατηγορίες / Προϊόντα');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Χαρακτηριστικά - Προσθέστε τιμές');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES_NEW', 'Χαρακτηριστικά - Ορισμός τιμών');
define('BOX_CATALOG_MANUFACTURERS', 'Κατασκευαστές');
define('BOX_CATALOG_SPECIALS', 'Προσφορές');
define('BOX_CATALOG_EASYPOPULATE', 'EasyPopulate-Εύκολη προθήκη');
define('BOX_CATALOG_SEO_FILTER', "SEO filter");
define('BOX_CATALOG_SEO_TEMPALTES', "Πρότυπα SEO");
define('BOX_CATALOG_SALEMAKER', 'Εκπτώσεις');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Πελάτες / Παραγγελίες');
define('BOX_CUSTOMERS_CUSTOMERS', 'Πελάτες');
define('BOX_CUSTOMERS_ORDERS', 'Παραγγελίες');
define('BOX_CUSTOMERS_EDIT_ORDERS', 'Επεξεργασία παραγγελιών');
define('BOX_CUSTOMERS_ENTRY', 'Αριθμός καταχωρήσεων');


// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Τοποθεσίες / Φόροι');
define('BOX_TAXES_COUNTRIES', 'Χώρες');
define('BOX_TAXES_ZONES', 'Ζώνες');
define('BOX_TAXES_GEO_ZONES', 'Φορολογικές ζώνες');
define('BOX_TAXES_TAX_CLASSES', 'Φορολογικές κλάσεις');
define('BOX_TAXES_TAX_RATES', 'Φορολογικοί δείκτες');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Αναφορές');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Προϊόντα που είδατε');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Τα προϊόντα που αγοράσατε');
define('BOX_REPORTS_PRODUCTS_PURCHASED_BY_CATEGORY', 'Προϊόντα που αγοράζονται ανά κατηγορία');
define('BOX_REPORTS_ORDERS_TOTAL', 'Σύνολο παραγγελιών πελατών');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Εργαλεία');
define('BOX_TOOLS_BACKUP', 'εφεδρική βάση δεδομένων');
define('BOX_TOOLS_CACHE', 'Έλεγχος κρυφής μνήμης');
define('BOX_TOOLS_MAIL', 'Αποστολή Email');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Διαχείριση Newsletter');

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Εντοπισμός');
define('BOX_LOCALIZATION_CURRENCIES', 'Νομίσματα');
define('BOX_LOCALIZATION_LANGUAGES', 'Γλώσσες');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Κατάσταση παραγγελιών');

// infobox box text in includes/boxes/info_boxes.php
define('BOX_HEADING_BOXES', 'πλαίσιο Πληροφοριών  διαχειριστή');
define('BOX_HEADING_TEMPLATE_CONFIGURATION', 'Πρότυπο διαχειριστή');
define('BOX_HEADING_DESIGN_CONTROLS', 'Έλεγχος χρωμάτων');

// javascript messages
define('JS_ERROR', 'Παρουσιάστηκαν σφάλματα κατά τη διαδικασία της φόρμας σας! \ NΠαρακαλώ κάνετε τις παρακάτω διορθώσεις:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* Το χαρακτηριστικό του νέου προϊόντος χρειάζεται αξία\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* Το χαρακτηριστικό νέου προϊόντος χρειάζεται ένα πρόθεμα τιμής \ n');

define('JS_PRODUCTS_NAME', '* Το νέο προϊόν χρειάζεται ένα όνομα\n');
define('JS_PRODUCTS_DESCRIPTION', '* Το νέο προϊόν χρειάζεται μια περιγραφή\n');
define('JS_PRODUCTS_PRICE', '* Το νέο προϊόν χρειάζεται τιμή €\n');
define('JS_PRODUCTS_WEIGHT', '* Το νέο προϊόν χρειάζεται βάρος ( τα κιλά του ) \ n');
define('JS_PRODUCTS_QUANTITY', '* Το νέο προϊόν χρειάζεται ποσότητα τεμαχίων \n');
define('JS_PRODUCTS_MODEL', '* Το νέο προϊόν χρειάζεται μια κωδικό μοντέλου\n');
define('JS_PRODUCTS_IMAGE', '* Το νέο προϊόν χρειάζεται μια  εικόνα (φυσικά) \n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* Πρέπει να οριστεί νέα τιμή για αυτό το προϊόν\n');

define('JS_FIRST_NAME', '* Το \ονομα \' πρέπει να έχει τουλάχιστον ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' χαρακτήρες.\n');
define('JS_LAST_NAME', '* Το \'Επίθετο\' πρέπει να έχει τουλάχιστον ' . ENTRY_LAST_NAME_MIN_LENGTH . ' χαρακτήρες.\n');
define('JS_DOB', '* Η \'ΗΜΕΡΟΜΗΝΙΑ ΓΕΝΝΗΣΗΣ\' η είσοδος πρέπει να είναι στη μορφή: xx/xx/xxxx (μήνα / ημερομηνία / έτος).\n');
define('JS_EMAIL_ADDRESS', '* Το \'email \' η είσοδος πρέπει να έχει τουλάχιστον' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' χαρακτήρες.\n');
define('JS_ADDRESS', '* Η \'Διεύθυνση σας\' πρέπει να έχει τουλάχιστον' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' χαρακτήρες.\n');
define('JS_POST_CODE', '* Ο \'ΤΑΧΥΔΡΟΜΙΚΟΣ ΚΩΔΙΚΟΣ\' πρέπει να έχει τουλάχιστον ' . ENTRY_POSTCODE_MIN_LENGTH . ' χαρακτήρες.\n');
define('JS_CITY', '* Η \'Πόλη\' πρέπει να έχει τουλάχιστον ' . ENTRY_CITY_MIN_LENGTH . ' χαρακτήρες.\n');
define('JS_STATE', '* Η \'Περιοχη\' σας πρέπει να επιλεγεί.\n');
define('JS_STATE_SELECT', '-- Επιλέξτε παραπάνω --');
define('JS_ZONE', '* η \'πολη\'η είσοδος πρέπει να επιλεγεί από τη λίστα για αυτήν τη χώρα.');
define('JS_COUNTRY', '* η \'χωρα\'πρέπει να επιλεγεί.\n');
define('JS_TELEPHONE', '* Ο \'Αριθμός τηλεφώνου\' πρέπει να έχει τουλάχιστον' . ENTRY_TELEPHONE_MIN_LENGTH . ' χαρακτήρες..\n');
define('JS_PASSWORD', '* Ο \'Κωδικός πρόσβασης\' και η \'Επιβεβαίωση\' εισόδου πρέπει να ταιριάζει και να έχει τουλάχιστον ' . ENTRY_PASSWORD_MIN_LENGTH . ' χαρακτήρες.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'Ο αριθμός παραγγελίας δεν υπάρχει!');

define('CATEGORY_PERSONAL', 'Προσωπικός');
define('CATEGORY_ADDRESS', 'Διεύθυνση');
define('CATEGORY_CONTACT', 'Επικοινωνία');
define('CATEGORY_COMPANY', 'Εταιρία');
define('CATEGORY_OPTIONS', 'Επιλογές');
define('DISCOUNT_OPTIONS', 'Εκπτώσεις');

define('ENTRY_FIRST_NAME', 'Ονομα:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="σφάλμα κειμένου">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . 'χαρακτήρες  </span>');
define('ENTRY_LAST_NAME', 'Επίθετο:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="σφάλμα κειμένου">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' χαρακτήρες</span>');
define('ENTRY_DATE_OF_BIRTH', 'Date of Birth:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="σφάλμα κειμένου">(eg. 05/21/1970)</span>');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail Address:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="σφάλμα κειμένου">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' χαρακτήρες</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="σφάλμα κειμένου">The email address doesn\'t appear to be valid!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="σφάλμα κειμένου">This email address already exists!</span>');
define('ENTRY_COMPANY', 'ονομα Company :');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_STREET_ADDRESS', 'Διεύθυνση:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="σφάλμα κειμένου">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' chars</span>');
define('ENTRY_SUBURB', 'Προάστιο:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', 'ΤΑΧΥΔΡΟΜΙΚΟΣ ΚΩΔΙΚΟΣ:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="σφάλμα κειμένου">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' χαρακτήρες</span>');
define('ENTRY_CITY', 'City:');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="σφάλμα κειμένου">min ' . ENTRY_CITY_MIN_LENGTH . ' χαρακτήρες</span>');
define('ENTRY_STATE', 'State:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="σφάλμα κειμένου">απαιτείται</span>');
define('ENTRY_COUNTRY', 'Χώρα:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', 'Αριθμός τηλεφώνου:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="σφάλμα κειμένου">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' chars</span>');
define('ENTRY_FAX_NUMBER', 'Fax :');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_NEWSLETTER', 'Ενημερωτικό δελτίο:');
define('ENTRY_NEWSLETTER_YES', 'Εγγραφήτε');
define('ENTRY_NEWSLETTER_NO', 'Διαγραφήτε');

// images
define('IMAGE_ANI_SEND_EMAIL', 'Αποστολή ηλεκτρονικού ταχυδρομείου');
define('IMAGE_BACK', 'Πισω');
define('IMAGE_BACKUP', 'Αντιγράφα ασφαλείας');
define('IMAGE_CANCEL', 'ακύρωση');
define('IMAGE_CONFIRM', 'Επιβεβαιώνω');
define('IMAGE_COPY', 'αντίγραφο');
define('IMAGE_COPY_TO', 'Αντέγραψε στο');
define('IMAGE_DETAILS', 'Λεπτομέριες');
define('IMAGE_DELETE', 'Διαγράφή');
define('IMAGE_LANG_DIR', 'Σύνδεση με τον κατάλογο γλωσσων');
define('IMAGE_EDIT', 'Επεξεργασία');
define('IMAGE_EMAIL', 'Email');
define('IMAGE_FILE_MANAGER', 'Διαχείριση αρχείων');
define('IMAGE_ICON_STATUS_GREEN', 'Ενεργός');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'μεινε Ενεργός');
define('IMAGE_ICON_STATUS_RED', 'Αδρανής');
define('IMAGE_ICON_STATUS_RED_LIGHT', ' μεινε Αδρανής');
define('IMAGE_ICON_INFO', 'Πληροφορίες');
define('IMAGE_INSERT', 'Εισάγετε');
define('IMAGE_LOCK', 'Lock');
define('IMAGE_MODULE_INSTALL', 'Εγκαταστήστε την μεθοδο  (module)  ');
define('IMAGE_MODULE_REMOVE', 'Αφαιρέστε την ενότητα  Module');
define('IMAGE_MOVE', 'μετακίνηση');
define('IMAGE_NEW_BANNER', 'Nεο Banner');
define('IMAGE_NEW_CATEGORY', 'Νέα κατηγορία');
define('IMAGE_NEW_COUNTRY', 'Νέα χώρα');
define('IMAGE_NEW_CURRENCY', 'Νέο νόμισμα');
define('IMAGE_NEW_FILE', 'Νέο αρχείο');
define('IMAGE_NEW_FOLDER', 'Νέος φάκελος');
define('IMAGE_NEW_LANGUAGE', 'Νέα Γλώσσα');
define('IMAGE_NEW_NEWSLETTER', 'Νέο ενημερωτικό δελτίο');
define('IMAGE_NEW_PRODUCT', 'Νεο  προιόν');
define('IMAGE_NEW_SALE', 'Νέα πώληση');
define('IMAGE_NEW_TAX_CLASS', 'Νέα φορολογική τάξη ( τη κάτσαμε)');
define('IMAGE_NEW_TAX_RATE', 'Νέος φορολογικός συντελεστής');
define('IMAGE_NEW_TAX_ZONE', 'Νέα φορολογική ζώνη');
define('IMAGE_NEW_ZONE', 'Νέα  ζώνη');
define('IMAGE_ORDERS', 'Παραγγελίες');
define('IMAGE_ORDERS_INVOICE', 'Τιμολόγιο');
define('IMAGE_ORDERS_PACKINGSLIP', 'Συρραφή συσκευασίας');
define('IMAGE_PREVIEW', 'Προεπισκόπηση');
define('IMAGE_RESTORE', 'Επανακατασκευή');
define('IMAGE_RESET', 'Επαναφορά');
define('IMAGE_SAVE', 'Αποθηκεύσετε');
define('IMAGE_SEARCH', 'Αναζήτηση');
define('IMAGE_SELECT', 'Επιλογη');
define('IMAGE_SEND', 'Αποστολή');
define('IMAGE_SEND_EMAIL', 'αποστολή Email');
define('IMAGE_UNLOCK', 'Ξεκλείδωμα');
define('IMAGE_UPDATE', 'Ενημέρωση τώρα');
define('IMAGE_UPDATE_CURRENCIES', 'Ενημέρωση της ισοτιμίας');
define('IMAGE_UPDATE_CURRENCIES_SHORT', 'Ενημέρωση νομισμάτων');
define('IMAGE_UPLOAD', 'Μεταφόρτωση');
define('TEXT_IMAGE_NONEXISTENT', 'Χωρίς εικόνα');

define('ICON_CROSS', 'Ψευδές');
define('ICON_CURRENT_FOLDER', 'Τρέχων φάκελος');
define('ICON_DELETE', 'Διαγράφη');
define('ICON_ERROR', 'Λάθος');
define('ICON_FILE', 'Αρχείο');
define('ICON_FILE_DOWNLOAD', 'Κατεβάστε');
define('ICON_FOLDER', 'Ντοσιέ φακελο');
define('ICON_LOCKED', 'Κλειδωμένο');
define('ICON_PREVIOUS_LEVEL', 'Προηγούμενο Επίπεδο');
define('ICON_PREVIEW', 'Προεπισκόπηση');
define('ICON_STATISTICS', 'Στατιστικά');
define('ICON_SUCCESS', 'Επιτυχία');
define('ICON_TICK', 'Αληθής');
define('ICON_UNLOCKED', 'ΞΕκλείδωτος');
define('ICON_WARNING', 'Προειδοποίηση');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Page %s of %d');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Εμφάνιση <b>%d</b> to <b>%d</b> (of <b>%d</b> banners)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Εμφάνιση <b>%d</b> to <b>%d</b> (of <b>%d</b> χωρες)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Εμφάνιση <b>%d</b> to <b>%d</b> (of <b>%d</b> πελατες)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Εμφάνιση <b>%d</b> to <b>%d</b> (of <b>%d</b> currencies)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Εμφάνιση <b>%d</b> to <b>%d</b> (of <b>%d</b> γλωσσες)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Εμφάνιση <b>%d</b> to <b>%d</b> (of <b>%d</b> κατσκευαστές)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Εμφάνιση <b>%d</b> to <b>%d</b> (of <b>%d</b> ενημερωτικά δελτία)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Εμφάνιση <b>%d</b> to <b>%d</b> (of <b>%d</b> παραγγελίες)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Εμφάνιση <b>%d</b> to <b>%d</b> (of <b>%d</b> κατάσταση παραγγελιών)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Εμφάνιση <b>%d</b> to <b>%d</b> (of <b>%d</b> προϊόντα)');
define('TEXT_DISPLAY_NUMBER_OF_SALES', 'Εμφάνιση <b>%d</b> to <b>%d</b> (of <b>%d</b> πωλήσεις)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Εμφάνιση <b>%d</b> to <b>%d</b> (of <b>%d</b> Προτεινόμενα προϊόντα )');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Εμφάνιση <b>%d</b> to <b>%d</b> (of <b>%d</b> tax classes)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Εμφάνιση <b>%d</b> to <b>%d</b> (of <b>%d</b> φορολογικές ζώνες)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> φορολογικοί δείκτες)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Εμφάνιση <b>%d</b> to <b>%d</b> (of <b>%d</b> ζωνες)');

define('TEXT_MENU_TOTAL_CONFIG', 'Συνολική διαμόρφωση');

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');

define('IMAGE_BUTTON_BUY_TEMPLATE','Μετάβαση σε πακέτο επί πληρωμή');
define('IMAGE_BUTTON_BUY_TEMPLATE_MOB', 'Αγορά');
define('TIME_LEFT', 'Υπολειπόμενος χρόνος σας: ');

define('TEXT_DEFAULT', 'προεπιλογή');
define('TEXT_SET_DEFAULT', 'Ορίσετε ως προεπιλογή');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="πεδίο Απαιτείται">*  Απαιτείται</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Σφάλμα: Προς το παρόν δεν έχει οριστεί προεπιλεγμένο νόμισμα. Ορίστε ένα από τα εξής: Εργαλείο διαχείρισης->τοποθεσίες->Νομίσματα');

define('TEXT_CACHE_CATEGORIES', 'Κουτι Κατηγορίες');
define('TEXT_CACHE_MANUFACTURERS', 'Κουτί κατασκευαστών');
define('TEXT_CACHE_ALSO_PURCHASED', 'Επίσης αγορασμένη ενότητα Module');

define('TEXT_NONE', '--κανένας--');
define('TEXT_TOP', 'Top');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Σφάλμα: Ο προορισμός δεν υπάρχει.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Σφάλμα: Ο προορισμός δεν είναι εγγράψιμος.');
define('ERROR_FILE_NOT_SAVED', 'Σφάλμα: Η φόρτωση του αρχείου δεν αποθηκεύτηκε.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Σφάλμα: Ο τύπος μεταφόρτωσης αρχείου δεν επιτρέπεται.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Επιτυχία: Η μεταφόρτωση αρχείων αποθηκεύτηκε.');
define('WARNING_NO_FILE_UPLOADED', 'Προειδοποίηση: Δεν φορτώθηκε κανένα αρχείο.');
define('WARNING_FILE_UPLOADS_DISABLED', 'Προειδοποίηση: Οι μεταφορτώσεις αρχείων είναι απενεργοποιημένες στο αρχείο ρυθμίσεων php.ini.');

define('BOX_CATALOG_XSELL_PRODUCTS', 'Συνδεδεμένα αγαθά');

define('CUSTOM_PANEL_DATE1', 'ημέρα');
define('CUSTOM_PANEL_DATE2', 'ημέρες');
define('CUSTOM_PANEL_DATE3', 'ημέρες');

// X-Sell
REQUIRE(DIR_WS_LANGUAGES . 'add_ccgvdc_english.php');

// BOF: Lango Added for print order MOD
define('IMAGE_BUTTON_PRINT', 'εκτύπωση');
// EOF: Lango Added for print order MOD

// BOF: Lango Added for Featured product MOD
define('BOX_CATALOG_FEATURED', 'Προτεινόμενα Προϊόντα');
// EOF: Lango Added for Featured product MOD

// BOF: Lango Added for Sales Stats MOD
define('BOX_REPORTS_MONTHLY_SALES', 'Μηνιαίες πωλήσεις / Φόρος');
// EOF: Lango Added for Sales Stats MOD

//BEGIN Dynamic information pages unlimited
define('BOX_HEADING_INFORMATION', 'Περιεχόμενο');
define('BOX_HEADING_SEO', 'SEO');
define('BOX_INFORMATION', 'Σελίδες');
//END Dynamic information pages unlimited

define('BOX_TOOLS_KEYWORDS', 'Διαχείριση λέξεων-κλειδιών');

// RJW Begin Meta Tags Code
define('TEXT_META_TITLE', 'Meta Title');
define('TEXT_META_DESCRIPTION', 'Meta Description');
define('TEXT_META_KEYWORDS', 'Meta Keywords');
// RJW End Meta Tags Code

// Article Manager
define('BOX_HEADING_ARTICLES', 'Διαχειριστής άρθρου');
define('BOX_TOPICS_ARTICLES', 'Θέματα / Άρθρα');
define('BOX_ARTICLES_CONFIG', 'Διαμόρφωση');
define('BOX_ARTICLES_AUTHORS', 'Συγγραφέας κειμένου');
define('BOX_ARTICLES_XSELL', 'σύνδεση μεταξύ δυο αρθρων');
define('IMAGE_NEW_TOPIC', 'Νέο θέμα');
define('IMAGE_NEW_ARTICLE', 'Νέο άρθρο');
define('TEXT_DISPLAY_NUMBER_OF_AUTHORS', 'Εμφάνιση <b>%d</b> to <b>%d</b> (of <b>%d</b> Συγγραφέα κειμένου)');

//TotalB2B start
define('BOX_CUSTOMERS_GROUPS', 'Ομάδες');
define('BOX_MANUDISCOUNT', 'Έκπτωση ανα προιόν με το χέρι');

// add for Group minimum price to order start		
define('GROUP_MIN_PRICE', 'Ομάδες με  ελάχιστη τιμή');
// add for Group minimum price to order end
// add for color groups start
define('GROUP_COLOR_BAR', 'Χρώμα ομάδας');
// add for color groups end
//TotalB2B end
define('BOX_CATALOG_QUICK_UPDATES', 'Γρήγορες ενημερώσεις');

define('IMAGE_PROPERTIES_POPUP_ADD_CHANGE_DELETE', 'Προσθήκη, αλλαγή, διαγραφή ιδιοτήτων');
define('IMAGE_PROPERTIES_POPUP_ADD', 'Προσθήκη ιδιότητας');
define('IMAGE_PROPERTIES', 'Ορίστε τις ιδιότητες των προϊόντων σας');

// polls box text in includes/boxes/polls.php

define('BOX_HEADING_POLLS', 'Δημοσκοπήσεις');
define('BOX_POLLS_POLLS', 'Διαχειριστής δημοσκοπήσεων');
define('BOX_POLLS_CONFIG', 'Ρύθμιση ψηφοφορίας');
define('BOX_CURRENCIES_CONFIG', 'Νομίσματα');
define('BOX_COUPONS', 'Κουπόνια');
define('BOX_INDEX_GIFTVOUCHERS', 'Δωροεπιταγές/ Κουπόνια');

define('BOX_REPORTS_SALES_REPORT2', 'Στατιστικές πωλήσεις 2');
define('BOX_REPORTS_SALES_REPORT', 'Στατιστικές πωλήσεις 3');
define('BOX_REPORTS_CUSTOMERS_ORDERS', 'Οι πελάτες αναφέρουν');

define('TEXT_NEW_ATTRIBUTE_EDIT', 'Επεξεργασία χαρακτηριστικών προϊόντος');

define('SMS_ENABLE_TITLE', 'Ενεργοποιήστε την υπηρεσία sms');
define('SMS_GATENAME_TITLE', 'SMS gatename');
define('SMS_CUSTOMER_ENABLE_TITLE', 'Στείλτε sms στον πελάτη στο checkout?');
define('TELEGRAM_TOKEN_TITLE','Telegram Token');
define('TELEGRAM_NOTIFICATIONS_ENABLED_TITLE','Ενεργοποίηση ειδοποιήσεων τηλεγραφήματος');
define('SMS_CHANGE_STATUS_TITLE', 'Στείλτε sms στον πελάτη σχετικά με την κατάσταση της παραγγελίας αλλαγής?');
define('SMS_OWNER_ENABLE_TITLE', 'Στείλτε SMS στον νικο στο checkout?');
define('SMS_OWNER_ENABLE_BUY_ONE_CLICK_TITLE', 'Αποστολή sms στον διαχειριστή κατά την αγορά με ένα κλικ;');
define('SMS_OWNER_TEL_TITLE', 'Admin τηλεφωνικό νουμερο κινητό  αριθμός');
define('SMS_TEXT_TITLE', 'κείμενο sms');
define('SMS_LOGIN_TITLE', 'Είσοδος στην πύλη SMS (ή κλειδί API, Account SID)');
define('SMS_PASSWORD_TITLE', 'Κωδικός πρόσβασης (or Auth token)');
define('SMS_SIGN_TITLE', 'Αποστολέας (or Service SID)');
define('SMS_ENC_TITLE', 'Κωδικός2');

define('ROBOTS_TXT_TITLE', 'robots.txt');

define('SMS_CONF_TITLE', 'Sms-υπηρεσία');
define('MY_SHOP_CONF_TITLE', 'Το κατάστημά μου');
define('MIN_VALUES_CONF_TITLE', 'Ελάχιστες τιμές');
define('MAX_VALUES_CONF_TITLE', 'μεγιστες τιμές');
define('IMAGES_CONF_TITLE', 'εικονα');
define('CUSTOMER_DETAILS_CONF_TITLE', 'Πληροφορίες Πελάτη');
define('MODULES_CONF_TITLE', 'Εγκατεστημένες λειτουργικές μεθόδοι');
define('SHIPPING_CONF_TITLE', 'Αποστολή / Συσκευασία');
define('LISTING_CONF_TITLE', 'Λίστα προϊόντων');
define('STOCK_CONF_TITLE', 'απόθεμα');
define('LOGS_CONF_TITLE', 'συνδεθείτε');
define('CACHE_CONF_TITLE', 'Κρυφη μνήμη');
define('EMAIL_CONF_TITLE', 'Επιλογές email');
define('DOWNLOAD_CONF_TITLE', 'Κατεβάστε');
define('GZIP_CONF_TITLE', 'GZip Συμπίεση');
define('SESSIONS_CONF_TITLE', 'Συνεδρίες');
define('HTML_CONF_TITLE', 'Μικροσκοπικός MCE Συντάκτης');
define('DYMO_CONF_TITLE', 'Δυναμικός MoPics');
define('DOWN_CONF_TITLE', 'Συντήρηση ιστοσελίδας');
define('GA_CONF_TITLE', 'Οι επισκέπτες');
define('LINKS_CONF_TITLE', 'Συνδέσεις');
define('QUICK_CONF_TITLE', 'Γρήγορες ενημερώσεις');
define('WISHLIST_TITLE', 'Ρυθμίσεις Λίστα επιθυμιών');
define('PAGE_CACHE_TITLE', 'κρυφη μνήμη σελιδας ');
define('YANDEX_MARKET_CONF_TITLE', 'XMLμεταφόρτωση');


define('ATTRIBUTES_COPY_TEXT1', ' ΠΡΟΕΙΔΟΠΟΙΗΣΗ: Δεν είναι δυνατή η αντιγραφή από το ταυτοτητα προϊόντος # ');
define('ATTRIBUTES_COPY_TEXT2', ' στο αναγνωριστικό προϊόντος # ');
define('ATTRIBUTES_COPY_TEXT3', ' ... Δεν έγινε αντίγραφο');
define('ATTRIBUTES_COPY_TEXT4', ' ΠΡΟΕΙΔΟΠΟΙΗΣΗ: Δεν υπάρχουν ιδιότητες αντιγραφής από το id προϊόντος # ');
define('ATTRIBUTES_COPY_TEXT5', ' για: ');
define('ATTRIBUTES_COPY_TEXT6', ' ... Δεν έγινε αντίγραφο');
define('ATTRIBUTES_COPY_TEXT7', ' ΠΡΟΕΙΔΟΠΟΙΗΣΗ: Δεν υπάρχει Προϊόντος ID # ');
define('ATTRIBUTES_COPY_TEXT8', ' ... Δεν έγινε αντίγραφο');

//include('includes/languages/english_support.php');

// BOF FlyOpenair: Extra Product Price
define('BOX_EXTRA_PRODUCT_PRICE', 'προσθήκη στη Τιμή επιπλέον προϊόντος επιπλεων χρεωση ');
define('EXTRA_PRODUCT_PRICE_ID_TITLE', 'Ενεργοποίηση επιπλέον τιμής προϊόντος');
define('EXTRA_PRODUCT_PRICE_ID_DESC', 'Ενεργοποίηση / απενεργοποίηση της επιπλέον τιμής προϊόντος)');
// EOF FlyOpenair: Extra Product Price


define('TEXT_IMAGE_OVERWRITE_WARNING', 'ΠΡΟΕΙΔΟΠΟΙΗΣΗ: Το όνομα του αρχείου ενημερώθηκε αλλά δεν αντικαταστάθηκε ');

define('SERVICE_MENU', 'ΕΡΓΑΛΕΙΑ');
define('SEO_CONFIGURATION','SEO ΕΡΓΑΛΕΙΑ');

define('TEXT_INDEX_LANGUAGE', 'Γλώσσα: ');
define('TEXT_SUMMARY_CUSTOMERS', 'πελάτες');
define('TEXT_SUMMARY_ORDERS', 'Παραγγελίες');
define('TEXT_SUMMARY_PRODUCTS', 'Προϊόντα');
define('TEXT_SUMMARY_HELP', 'Βοήηθεια');
define('TEXT_SUMMARY_STAT', 'Στατιστικά');
define('TABLE_HEADING_CUSTOMERS', 'πελάτες');


define('COMMENTS_MODULE_ENABLED_TITLE', 'Κριτικές');
define('FACEBOOK_PIXEL_MODULE_ENABLED_TITLE','FaceBook Pixel');
define('DEFAULT_PIXEL_CURRENCY_TITLE','FaceBook Pixel currency');
define('QUICK_PRODUCTS_UPDATE_ENABLED_TITLE','Γρήγορες ενημερώσεις');
define('FACEBOOK_PIXEL_ID_TITLE','FaceBook Pixel ID');
define('LANGUAGE_SELECTOR_MODULE_ENABLED_TITLE', 'Πολλαπλών Γλωσσών');
define('PRODUCT_LABELS_MODULE_ENABLED_TITLE', 'Ετικέτες');
define('ATTRIBUTES_PRODUCTS_MODULE_ENABLED_TITLE', 'Φίλτρα');
define('AUTH_MODULE_ENABLED_TITLE', 'αυθεντικοποιηση μεσω face book');
define('EXCEL_IMPORT_MODULE_ENABLED_TITLE', 'Εισαγωγή εξαγωγή');
define('CUPONES_MODULE_ENABLED_TITLE', 'Κουπόνια');
define('COMPARE_MODULE_ENABLED_TITLE', 'Σύγκρινε');
define('WISHLIST_MODULE_ENABLED_TITLE', 'Λίστα επιθυμιών');
define('GOOGLE_FEED_CHOOSE_ALL_PRODUCTS_TITLE', 'ενεργών προϊόντων');
define('GOOGLE_FEED_CHOOSE_PRODUCTS_2_TITLE', 'προϊόντων με ενεργή κατάσταση XML');
define('GOOGLE_FEED_CHOOSE_PRODUCTS_3_TITLE', 'προϊόντων με διαθεσιμότητα στοκ');
define('XSELL_PRODUCTS_BUYNOW_ENABLED_TITLE', 'Σχετικά προϊόντα');
define('STATS_PRODUCTS_PURCHASED_BY_CATEGORY_MODULE_ENABLED_TITLE', 'Προϊόντα που αγοράζονται ανά κατηγορία');
define('SALEMAKER_MODULE_ENABLED_TITLE', 'Εκπτώσεις');
define('SPECIALS_MODULE_ENABLED_TITLE', 'Réductions');
define('STATS_KEYWORDS_ENABLED_TITLE', 'Ερωτήματα αναζήτησης');
define('BACKUP_ENABLED_TITLE', 'Αντίγραφο ασφαλείας');
define('PRODUCTS_MULTI_ENABLED_TITLE', 'πολλαπλή επεξεργασία');
define('SEO_TEMPLATES_ENABLED_TITLE', 'Πρότυπα SEO');
define('SHIP2PAY_ENABLED_TITLE', 'Κοστος αποστολής ανα τροπο παράδωσης');
define('QTY_PRO_ENABLED_TITLE', 'Συνδυασμοί ιδιοτήτων');
define('MASTER_PASSWORD_MODULE_ENABLED_TITLE', 'Master Password');
define('YML_MODULE_ENABLED_TITLE', 'Import XML (YML)');
define('OSC_IMPORT_MODULE_ENABLED_TITLE', 'Database migration (osCommerce)');
define('EXPORT_HOTLINE_MODULE_ENABLED_TITLE', 'XML products export "Hotline"');
define('EXPORT_PROMUA_MODULE_ENABLED_TITLE', 'XML products export "Prom"');
define('EXPORT_PRICEUA_MODULE_ENABLED_TITLE', 'XML products export "Price.ua"');
define('EXPORT_ROZETKA_MODULE_ENABLED_TITLE', 'XML products export "Rozetka"');
define('EXPORT_YANDEX_MARKET_MODULE_ENABLED_TITLE', 'Yandex Market export');
define('EXPORT_GOOGLE_SITEMAP_MODULE_ENABLED_TITLE', 'XML Sitemaps');
define('EXPORT_FACEBOOK_FEED_MODULE_ENABLED_TITLE', 'XML feed for Facebook Product Catalog');
define('EXPORT_PDF_MODULE_ENABLED_TITLE', 'Export catalog to PDF');
define('PROMURLS_MODULE_ENABLED_TITLE', 'Prom.ua Urls');
define('PROM_EXCEL_MODULE_ENABLED_TITLE', 'Import Prom.ua (Excel)');
define('MASTER_PASS_TITLE', 'Master Password');
define('SMSINFORM_MODULE_ENABLED_TITLE', 'SMS module');
define('CARDS_ENABLED_TITLE', 'Κάρτες που αποκτούν');
define('SOCIAL_WIDGETS_ENABLED_TITLE', 'Κοινωνικά widgets');
define('MULTICOLOR_ENABLED_TITLE', 'Πολύχρωμο');
define('WATERMARK_ENABLED_TITLE', 'Watermarking');

define('FACEBOOK_APP_ID_TITLE', 'Αναγνωριστικό εφαρμογής Facebook');
define('FACEBOOK_APP_SECRET_TITLE', 'Μυστικό κλειδί Facebook');
define('VK_APP_ID_TITLE', 'Αναγνωριστικό εφαρμογής Vkontakte');
define('VK_APP_SECRET_TITLE', 'Μυστικό κλειδί Vkontakte');

define('TABLE_HEADING_ORDERS', 'Παραγγελίες:');
define('TABLE_HEADING_LAST_ORDERS', 'Τελευταίες παραγγελίες');
define('TABLE_HEADING_CUSTOMER', 'Πελάτης');
define('TABLE_HEADING_ORDER_NUMBER', '#');
define('TABLE_HEADING_ORDER_TOTAL', 'σύνολο');
define('TABLE_HEADING_STATUS', 'Κατάσταση');
define('TABLE_HEADING_DATE', 'Ημερομηνία');

define('TEXT_GO_TO_CAT', 'Επιλέξτε Κατηγορία');
define('TEXT_GO_TO_SEARCH', 'αναζήτηση');
define('TEXT_GO_TO_SEARCH2', 'κατά προϊόν<br>κατά μοντέλο');

include('includes/languages/order_edit_english.php');

define('TEXT_VALID_TITLE', 'κατηγορίες');
define('TEXT_VALID_TITLE_PROD', 'Λίστα προϊόντων');
define('TEXT_VALID_CLOSE', 'Κλείστε το παράθυρο');

define('TABLE_HEADING_LASTNAME', 'Επίθετο');
define('TABLE_HEADING_FIRSTNAME', 'Ονομα');
define('TABLE_HEADING_PRODUCT_NAME', 'Ονομα');
define('TABLE_HEADING_PRODUCT_PRICE', 'Τιμή');
define('TEXT_SELECT_CUSTOMER', 'Επιλέξτε πελάτη');
define('TEXT_SELECT_CUSTOMER_PLACEHOLDER', 'Αρχίστε να εισάγετε αναγνωριστικό πελάτη / όνομα / τηλέφωνο / διεύθυνση ηλεκτρονικού ταχυδρομείου');
define('TEXT_SINGLE_CUSTOMER', 'Ενιαίος πελάτης');
define('TEXT_EMAIL_RECIPIENT', 'Email αποστολέα');

define('TEXT_NOTIFICATIONS', 'Ειδοποιήσεις');
define('TEXT_NOTIFICATIONS_MESSAGE', 'Έχετε εντολές % s που αναμένουν για έλεγχο');
define('TEXT_NOTIFICATIONS_LINK', 'Μεταβείτε στη σελίδα παραγγελιών');

define('TEXT_PROFILE', 'Προφίλ');
define('TEXT_PROFILE_GREETINGS', 'Γεια σας, %s!');
define('TEXT_PROFILE_LOGIN_COUNT', 'Καταμέτρηση σύνδεσης: %s');
define('TEXT_PROFILE_DAYS_WITH_US', 'Είστε μαζί μας για τις ημέρες %s');

define('TEXT_MENU_TITLE', 'Πλοήγηση');
define('TEXT_MENU_HOME', 'Σπίτι');
define('TEXT_MENU_PRODUCTS', 'Προϊόντα');
define('TEXT_MENU_CATALOGUE', 'Κατάλογος');
define('TEXT_MENU_ATTRIBUTES', 'Χαρακτηριστικά');
define('TEXT_MENU_ORDERS', 'Παραγγελίες');
define('TEXT_MENU_ORDERS_LIST', 'Λίστα παραγγελιών');
define('TEXT_MENU_CLIENTS_LIST', 'Λίστα Πελατών');
define('TEXT_MENU_CLIENTS_GROUPS', 'Ομάδες Πελατών');
define('TEXT_MENU_ADD_CLIENT', 'Προσθέστε Πελάτη');
define('TEXT_MENU_PAGES', 'Σελίδες');
define('TEXT_MENU_SITE_MODULES', 'SOLO modules');
define('TEXT_MENU_SITE_SEO_SETTINGS', 'Ρυθμίσεις SEO');
define('TEXT_MENU_BACKUP', 'Αντίγραφο ασφαλείας');
define('TEXT_MENU_NEWSLETTERS', 'Ενημερωτικά δελτία');
define('TEXT_MENU_SLOW_QUERIES_LOGS', ' αρχεία καταγραφής ερωτημάτων');
define('TEXT_MENU_PRODUCTS_VIEWS', 'Προβολές προϊόντων');
define('TEXT_MENU_CLIENTS', 'Πελάτες');
define('TEXT_MENU_SALES', 'Πωλήσεις');
define('TEXT_MENU_ADMINS_AND_GROUPS', 'Διαχειριστές και Ομάδες');
define('TEXT_MENU_UPDATE_PROFILE', 'Ανανέωση προφίλ');
define('TEXT_MENU_NOPHOTO', 'Δεν υπάρχει φωτογραφία');
define('TEXT_MENU_OPENEDBY', 'Άνοιξε από');
define('TEXT_MENU_LAST_MODIFIED', 'Last modified');
define('TEXT_MENU_ZEROQTY', 'Μηδενική ποσότητα');
define('TEXT_MENU_STATS_RECOVER_CART_SALES', 'Στατιστικά ανακτούν τις πωλήσεις των καλαθιών');
define('TEXT_MENU_SEARCH', 'Αναζήτηση ανά κατηγορία');

define('TEXT_HEADING_ADD_NEW', 'Προσθέτω');
define('TEXT_HEADING_ADD_NEW_PRODUCT', 'Προϊόν');
define('TEXT_HEADING_ADD_NEW_CATEGORY', 'Κατηγορία');
define('TEXT_HEADING_ADD_NEW_PAGE', 'Σελίδα');
define('TEXT_HEADING_ADD_NEW_CLIENT', 'Πελάτης');
define('TEXT_HEADING_ADD_NEW_ORDER', 'Παραγγελία');
define('TEXT_HEADING_ADD_NEW_COUPON', 'Κουπόνι');

define('TEXT_BLOCK_ORDERS_STATUSES_COUNTERS', 'Παραγγελίες\' Κατάσταση πανικού');

define('TEXT_BLOCK_ORDERS_TODAY_COUNTERS', 'Σήμερα');
define('TEXT_BLOCK_ORDERS_YESTERDAY_COUNTERS', 'χθές');
define('TEXT_BLOCK_ORDERS_WEEK_COUNTERS', 'Εβδομάδα');
define('TEXT_BLOCK_ORDERS_MONTH_COUNTERS', 'Μήνα');
define('TEXT_BLOCK_ORDERS_QUARTER_COUNTERS', 'τριμηνιαίος');
define('TEXT_BLOCK_ORDERS_ALL_TIME_COUNTERS', 'ΟΛΑ');
define('TEXT_BLOCK_ORDERS_BY_PERIOD_COUNTERS_CURRENCY', 'uah');
define('TEXT_BLOCK_ORDERS_BY_PERIOD_PREFIX', 'ΓΙΑ');
define('TEXT_BLOCK_ORDERS_BY_PERIOD_COUNTERS_NOUN', 'παραγγελίες');

define('TEXT_BLOCK_COUNTERS_PRODUCTS', 'Προϊόντα');
define('TEXT_BLOCK_COUNTERS_ORDERS', 'Παραγγελίες');
define('TEXT_BLOCK_COUNTERS_COMMENTS', 'Σχόλια');
define('TEXT_BLOCK_COUNTERS_TOTAL_INCOME', 'Συνολικό εισόδημα');

define('TEXT_BLOCK_SETTINGS_TITLE', 'Ρυθμίσεις');
define('TEXT_BLOCK_SETTINGS_TITLE_FIXED_HEADER', 'Σταθερή κεφαλίδα');
define('TEXT_BLOCK_SETTINGS_TITLE_FIXED_ASIDE', 'Σταθερή πλευρά');
define('TEXT_BLOCK_SETTINGS_TITLE_FOLDED_ASIDE', 'Αναδιπλώθηκε μια πλευρά');
define('TEXT_BLOCK_SETTINGS_TITLE_DOCK_ASIDE', 'Αγκυροβολήστε');

define('TEXT_BLOCK_MODULES_STATS_USING', 'Χρησιμοποιώντας');
define('TEXT_BLOCK_MODULES_STATS_AMOUNT', 'pc.');
define('TEXT_BLOCK_MODULES_STATS_MODULES', 'of modules');
define('TEXT_BLOCK_MODULES_USED', 'Modules ΣΕ ΧΡΗΣΗ');
define('TEXT_BLOCK_MODULES_SEE_ALL', 'ΔΕΣ ΟΛΑ ΤΑ  modules');

define('TEXT_BLOCK_OVERVIEW_TITLE', 'επισκόπηση');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS', 'Παραγγελίες');
define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED', 'Κορυφαίες προβολές');
define('TEXT_BLOCK_OVERVIEW_MOST_SOLD', 'κορυφαίες πωλήσεις');
define('TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES', 'Κορυφαίες κατηγορίες');
define('TEXT_MENU_EMAIL_CONTENT', 'Πρότυπα ηλεκτρονικού ταχυδρομείου');
define('TEXT_BLOCK_OVERVIEW_LATEST_LOGINS', 'Συνδεθείτε');
define('TEXT_MENU_CKFINDER', 'File manager');
define('TEXT_BLOCK_OVERVIEW_MOST_SEARCHED', 'Αναζητήσεις');

define('TEXT_BLOCK_OVERVIEW_ACTION_EDIT', 'Επεξεργασία');
define('TEXT_BLOCK_OVERVIEW_ACTION_VIEW', 'προβολη');

define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_CUSTOMER_NAME', 'Ονομα πελάτη');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_DATE', 'Ημερομηνία');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_AMOUNT', 'Ποσό');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_STATUS', 'Κατάσταση');

define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED_PRODUCT_IMAGE', 'Εικόνα προϊόντος');
define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED_PRODCUT_NAME', 'όνομα προϊόντος');
define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED_VIEWS', 'Προβολές');

define('TEXT_BLOCK_OVERVIEW_MOST_SOLD_PRODUCT_IMAGE', 'Εικόνα προϊόντος');
define('TEXT_BLOCK_OVERVIEW_MOST_SOLD_PRODCUT_NAME', 'όνομα προϊόντος');
define('TEXT_BLOCK_OVERVIEW_MOST_SOLD_ORDERS', 'Παραγγελίες');

define('TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES_CATEGORY_NAME', 'όνομα κατηγορίας');
define('TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES_ORDERS', 'Παραγγελίες');

define('TEXT_BLOCK_OVERVIEW_LATEST_LOGINS_ADMIN_NAME', 'Όνομα διαχειριστή');
define('TEXT_BLOCK_OVERVIEW_LATEST_LOGINS_DATE', 'Ημερομηνία τελευταίας σύνδεσης');

define('TEXT_BLOCK_OVERVIEW_MOST_SEARCHED_QUERY', 'Αναζήτηση ερωτήματος');
define('TEXT_BLOCK_OVERVIEW_MOST_SEARCHED_COUNT', 'Καταμέτρηση αναζήτησης');

define('TEXT_BLOCK_NEWS_TITLE', 'Ειδήσεις');

define('TEXT_BLOCK_PLOT_TITLE', 'Εισόδημα');
define('TEXT_BLOCK_PLOT_TAB_BY_DAYS', 'Με μέρες');
define('TEXT_BLOCK_PLOT_TAB_BY_WEEKS', 'Με εβδομάδες');
define('TEXT_BLOCK_PLOT_TAB_BY_MONTHES', 'Με μήνες');

define('TEXT_BLOCK_PLOT_XAXIS_LABEL', 'Συνολικό εισόδημα');
define('TEXT_BLOCK_PLOT_YAXIS_LABEL', 'μετρητής παραγγελιών');

define('TEXT_BLOCK_COMMENTS_TITLE', 'Σχόλια');

define('TEXT_BLOCK_EVENTS_TITLE', 'Εκδηλώσεις');

define('TEXT_BLOCK_EVENTS_TOOLTIP_ALL_EVENTS', 'ολες Εκδηλώσεις');
define('TEXT_BLOCK_EVENTS_TOOLTIP_ADMINS', 'Διαχειριστές');
define('TEXT_BLOCK_EVENTS_TOOLTIP_ORDERS', 'Παραγγελίες');
define('TEXT_BLOCK_EVENTS_TOOLTIP_CUSTOMERS', 'πελάτες');
define('TEXT_BLOCK_EVENTS_TOOLTIP_NEW_PRODUCTS', 'Νέα Προϊόντα');
define('TEXT_BLOCK_EVENTS_TOOLTIP_COMMENTS', 'Σχόλια');
define('TEXT_BLOCK_EVENTS_TOOLTIP_CALL_ME_BACK', 'Κάλεσέ με πίσω');

define('TEXT_BLOCK_EVENTS_MESSAGE_ADMINS', '%s εισήγαγε το σύστημα');
define('TEXT_BLOCK_EVENTS_MESSAGE_ORDERS', 'Πήρε %s');
define('TEXT_BLOCK_EVENTS_MESSAGE_ORDERS_2', 'παραγγελία#%d');
define('TEXT_BLOCK_EVENTS_MESSAGE_CUSTOMERS', '%s καταχωρημένοι στον ιστότοπο');
define('TEXT_BLOCK_EVENTS_MESSAGE_NEW_PRODUCTS', 'Προστέθηκε νέο προϊόν: "%s"');
define('TEXT_BLOCK_EVENTS_MESSAGE_COMMENTS', 'χρηστης %s πρόσθεσε σχόλιο');
define('TEXT_BLOCK_EVENTS_MESSAGE_CALL_ME_BACK', 'ζήτησε την κλήση');

define('TEXT_BLOCK_GA_TITLE', 'Google Analytics');

define('TEXT_SETTINGS_EDIT_FORM_SAVE', 'Aποθηκεύσετε');
define('TEXT_SETTINGS_EDIT_FORM_CANCEL', 'Aκυρωση');
define('TEXT_SETTINGS_EDIT_FORM_TOOLTIP', 'επεξεργασία');

define('TEXT_MODAL_ADD_ACTION', 'Προσθέτω');
define('TEXT_MODAL_UPDATE_ACTION', 'εκσυγχρονίζω');
define('TEXT_MODAL_DELETE_ACTION', 'Διαγράφω');
define('TEXT_MODAL_CHANGE_STATUS', 'Αλλαγή κατάστασης');
define('TEXT_MODAL_DETAILED', 'Λεπτομέριες');
define('TEXT_MODAL_ACTION', 'Δραση');
define('TEXT_MODAL_INSTALL_ACTION', 'Εγκαθιστώ');
define('TEXT_MODAL_CONTINUE_ACTION', 'Να συνεχίσει');
define('TEXT_MODAL_CANCEL_ACTION', 'ακυρωση');
define('TEXT_MODAL_CONFIRM_ACTION', 'Επιβεβαίωση');
define('TEXT_MODAL_CONFIRMATION_ACTION', 'σiγουρα?');
define('TEXT_WAIT', 'αναμoνή..');
define('TEXT_SHOW', 'προβολή');
define('TEXT_RECORDS', 'Εγγραφές');
define('TEXT_SAVE_DATA_OK', 'Τα δεδομένα άλλαξαν με επιτυχία');
define('TEXT_DEL_OK', 'Η εγγραφή διαγράφεται με επιτυχία');
define('TEXT_ERROR', 'Παρουσιάστηκε σφάλμα');
define('TEXT_GENERAL_SETTING', 'γενικo');

//featured
define('TEXT_FEATURED_ADDED', 'Προστέθηκε');
define('TEXT_FEATURED_CHANGE', 'άλλαξε');
define('TEXT_FEATURED_EXPIRE_DATE', 'Ημερομηνία λήξης');
define('TEXT_ENTER_PRODUCT', 'Εισαγάγετε το όνομα προϊόντος');
define('TEXT_FEATURED_MODEL', 'Μοντέλο');
define('TEXT_PRODUCTS_ON_ATTRIBUTES_VAL', 'Προϊόντα με αυτήν την τιμή επιλογής');

define('ADMIN_BTN_BUY_MODULE', 'ψώνισε αυτο το module!');
define('FOOTER_INSTRUCTION', 'Πώς να χρησιμοποιήσετε το Admin?');
define('FOOTER_NEWS', 'Νέα του');
define('FOOTER_SUPPORT_SOLOMONO', 'Technical Support');
define('FOOTER_SUPPORT_CONSULTANT', 'Online Consultant');
define('FOOTER_SUPPORT_TECHNICAL', 'Technical Support');

//languages_translater
define('TEXT_TRANSLATER_TITLE', 'Εκδότης γλωσσών');
define('TEXT_PRODUCT_FREE_SHIPPING', 'Δωρεάν αποστολή:');


define('TEXT_MOBILE_OPEN_COLLAPSE', 'Εμφάνιση');
define('TEXT_MOBILE_CLOSE_COLLAPSE', 'Απόκρυψη');
define('TEXT_ORDER_STATISTICS', 'Παραγγείλετε στατιστικά στοιχεία');
define('TEXT_WHO_ONLINE', 'Που είναι σε απευθείας σύνδεση');
define('TEXT_VIEW_LIST', 'Προβολή λίστας');
define('TEXT_ACTION_OVERVIEW', 'Επισκόπηση δράσης');
define('TEXT_SEE_ALL', 'Δείτε όλους');

define('TEXT_MOBILE_SHOW_MORE', 'Εμφάνιση περισσότερων');
define('TEXT_MOBILE_INCOME', 'Έσοδα:');
define('TEXT_SHOW_ALL', 'Εμφάνιση όλων');
define('TEXT_REPLY_COMMENT', 'Απάντηση στο σχόλιο - ');
define('TEXT_BTN_REPLY', 'Απάντηση');
define('TEXT_BTN_ANSWERED', 'Απαντήθηκε');
define('TEXT_MODAL_APPLY_ACTION', 'Για να εφαρμοστεί');



define('TEXT_REDIRECTS_TITLE', 'Ανακατευθύνσεις');
define('RCS_CONF_TITLE', 'Ελλιπείς παραγγελίες');
define('RECOVER_CART_SALES', 'Ανάκτηση πωλήσεων καλαθιού');

define ('INSTAGRAM_PRODUCTS_TITLE', 'Εισαγωγή από το Instagram');
define ('INSTAGRAM_PRODUCTS_RESULT', 'Τα προϊόντα που φορτώθηκαν στη βάση δεδομένων');
define ('INSTAGRAM_SUCCESS', 'Δημοσιεύσεις Instagram έχουν προστεθεί στον ιστότοπό μας!');
define ('INSTAGRAM_LINK', 'Σύνδεσμος Instagram');
define ('INSTAGRAM_COUNT', 'Αριθμός αναρτήσεων');

define('INSTAGRAM_MODULE_ENABLE_TITLE', 'Διαφάνειες Instagram');

define('TEXT_ENABLE_MULTILANGUAGE_MODULE', 'Ενεργοποιήστε την πολύγλωσση ενότητα');
define('TEXT_BUY_MULTILANGUAGE_MODULE', 'Αγοράστε την πολύγλωσση ενότητα');












define('BOX_PRODUCTS_STATS_MENU_ITEM', 'Προϊόντα');


define('BOX_CLIENTS_STATS_TOP_CLIENTS', 'Κορυφαίοι πελάτες');
define('BOX_CLIENTS_STATS_NEW_CLIENTS', 'Νέοι πελάτες');


define('BOX_MENU_TOOLS_EMAILS', 'Ενημερωτικό δελτίο μέσω email');
define('BOX_MENU_TOOLS_MASS_EMAILS', 'Μαζική αποστολή');


define('BOX_EXEL_IMPORT_EXPORT', 'Εισαγωγή / εξαγωγή Excel');
define('BOX_PROM_IMPORT_EXPORT', 'Εισαγωγή Prom.ua Excel');
define('IMPORT_EXPORT_MENU_BOX', 'Εισαγωγή εξαγωγή');


define('BOX_MENU_TAXES', 'Φόρος');


define('INTEGRATION_CONF_TITLE', 'Άλλες ενσωματώσεις');

define('BOX_HEADING_INSTRUCTION', 'Οδηγίες');

define('BOX_CATALOG_YML', 'Εισαγωγή YML');
define('TOOLTIP_CATEGORY_STATUS', 'Όταν ενεργοποιηθεί, η κατηγορία / υποκατηγορία / προϊόν εμφανίζεται στη σελίδα του ιστότοπου');
define('TOOLTIP_CATEGORY_GOOGLE_FEED_STATUS', 'Για να προσθέσετε μια κατηγορία / υποκατηγορία / προϊόν στη Ροή Google. Για να συμπεριλάβετε μόνο ένα προϊόν - την κατηγορία και την υποκατηγορία στην οποία βρίσκεται το προϊόν.');
define('TOOLTIP_PRODUCTS_FEATURED', 'Εμφανίζεται στην αρχική σελίδα.');
define('TOOLTIP_PRODUCTS_RELATED', 'Εμφανίζεται στη σελίδα του προϊόντος, σε άρθρα.');
define('TOOLTIP_PRODUCTS_ATTRIBUTES', 'Τα χαρακτηριστικά (φίλτρα) σάς επιτρέπουν να ορίσετε πρόσθετα χαρακτηριστικά προϊόντος, όπως μέγεθος ή χρώμα. Διαβάστε περισσότερα στις οδηγίες: LINK');
define('TOOLTIP_ATTRIBUTES_VALUES', 'Αφού δημιουργήσετε το χαρακτηριστικό, συμπληρώστε τις απαιτούμενες τιμές.');
define('TOOLTIP_ATTRIBUTES_GROUPS', 'Για να συνδυάσετε πολλά χαρακτηριστικά σε μία ομάδα.');
define('TOOLTIP_ATTRIBUTES_TYPES', 'Κείμενο - μια περιγραφή κειμένου των χαρακτηριστικών. Αναπτυσσόμενο μενού - επιλογή από την αναπτυσσόμενη λίστα. Ραδιόφωνο - για να επιλέξετε από τις παρεχόμενες επιλογές. Εικόνα - η κάρτα αλλάζει όταν έχει επιλεγεί η τιμή του αντικειμένου. Εμφανίζεται στη σελίδα του προϊόντος.');
define('TOOLTIP_ATTRIBUTES_SHOW_IN_FILTER', 'Για να εμφανίσετε τα χαρακτηριστικά προϊόντος στον πίνακα φίλτρων, μετακινήστε το ρυθμιστικό για να το ενεργοποιήσετε.');
define('TOOLTIP_ATTRIBUTES_SHOW_IN_LISTING', 'Τοποθετώντας το δείκτη του ποντικιού πάνω από ένα προϊόν εμφανίζονται τα χαρακτηριστικά στη λίστα προϊόντων.');
define('TOOLTIP_SPECIALS', 'Για να ορίσετε μια ειδική τιμή για ένα προϊόν.');
define('TOOLTIP_SALES_MAKERS', 'Για να ορίσετε εκπτώσεις για πολλές ή όλες τις κατηγορίες προϊόντων ή / και κατασκευαστών.');
define('TOOLTIP_EXPORT_IMPORT_CSV', 'Για να φορτώσετε / ξεφορτώσετε μια βάση δεδομένων από ένα αρχείο με επέκταση .csv.');
define('TOOLTIP_EXPORT_IMPORT_PROM', 'Για εξαγωγή βάσης δεδομένων από ένα αρχείο που έχει εισαχθεί από Prom.');
define('TOOLTIP_ORDER_DATE', 'Προβολή παραγγελιών για το επιλεγμένο χρονικό διάστημα.');
define('TOOLTIP_ORDER_DETAILS', 'Λεπτομέρειες Παραγγελίας');
define('TOOLTIP_ORDER_EDIT', 'επεξεργασία παραγγελίας');
define('TOOLTIP_ORDER_STATUS', 'Για να προσθέσετε μια νέα κατάσταση παραγγελίας, κάντε κλικ στο &quot;+&quot;');
define('TOOLTIP_CLIENT_EDIT', 'επεξεργασία');
define('TOOLTIP_CLIENT_GROUP_PRICE', 'Η τιμή που θα εμφανίζεται στον ιστότοπο για πελάτες μιας συγκεκριμένης ομάδας μετά την εξουσιοδότηση. Ο αριθμός των τιμών ορίζεται στην ενότητα &quot;Το κατάστημά μου&quot;');
define('TOOLTIP_CLIENT_PRICE_GROUP_LIMIT', 'Όταν το ποσό φτάσει το όριο, μπορείτε να μεταφέρετε τον πελάτη σε άλλη ομάδα.');
define('TOOLTIP_CLIENT_GROUP_EDIT', 'επεξεργασία');
define('TOOLTIP_EMAIL_TEMPLATE', 'Έτοιμα πρότυπα επιστολών για αποστολή σε πελάτες.');
define('TOOLTIP_EMAIL_TEMPLATE_EDIT', 'επεξεργασία');
define('TOOLTIP_FILE_MANAGER', 'Για να ανεβάσετε και να επεξεργαστείτε αρχεία στον ιστότοπο.');
define('TOOLTIP_REDIRECTS', 'Για παράδειγμα, πρέπει να ανακατευθύνετε από το https://demo.solomono.net/kontakty στο https://demo.solomono.net/contact_us.php. Πρέπει να καθορίσετε στη γραμμή &quot;ανακατεύθυνση από&quot; επαφήty &quot;ανακατεύθυνση σε&quot; contact_us.php');
define('TOOLTIP_MODULES_PAYMENT', 'Προσθέστε διαθέσιμους τρόπους πληρωμής.');
define('TOOLTIP_MODULES_SHIPPING', 'Προσθέστε διαθέσιμες μεθόδους αποστολής.');
define('TOOLTIP_MODULES_TOTALS', 'Το συνολικό κόστος της παραγγελίας εμφανίζεται στη σελίδα ολοκλήρωσης αγοράς.');
define('TOOLTIP_MODULES_ZONE', 'Καθορίστε τους πιθανούς τρόπους παράδοσης για συγκεκριμένες ζώνες, καθώς και τους επιτρεπόμενους τρόπους πληρωμής για αυτές τις ζώνες. Μπορείτε να δημιουργήσετε μια νέα ζώνη στις Ρυθμίσεις-&gt; Φόροι-&gt; Φορολογικές ζώνες');
define('TOOLTIP_MODULES_LANGUAGES', 'Επιλογή γλωσσών ιστότοπου, ρύθμιση της προεπιλεγμένης γλώσσας.');
define('TOOLTIP_MODULES_CURRENCY', 'Ορίστε το προεπιλεγμένο νόμισμα και ορίστε την τιμή σύμφωνα με την τιμή.');
define('TOOLTIP_MODULES_COUPONS', 'Δημιουργήστε ένα κουπόνι για να υποβάλει ο πελάτης στο καλάθι και να λάβει έκπτωση.');
define('TOOLTIP_MODULES_POOLS', 'Δημιουργήστε μια έρευνα για να λάβετε τα στατιστικά στοιχεία που χρειάζεστε.');
define('TOOLTIP_MODULES_SOLOMONO', 'Λίστα αγορασμένων ενοτήτων + λίστα διαθέσιμων για αγορά.');
define('TOOLTIP_CONFIGURATION_MAIN_EMAIL', 'Η κύρια διεύθυνση όπου φτάνουν όλες οι ειδοποιήσεις.');
define('TOOLTIP_CONFIGURATION_FROM_EMAIL', 'Καθορίστε τη διεύθυνση από την οποία θα στέλνετε όλα τα γράμματα μαζικά.');
define('TOOLTIP_CONFIGURATION_ORDER_COPY_EMAIL', 'Καθορίστε όλες τις διευθύνσεις όπου θα σταλούν αντίγραφα επιστολών με παραγγελίες. Μπορείτε να καθορίσετε πολλά e-mail, διαχωρισμένα με κόμματα με κενά.');
define('TOOLTIP_CONTACT_US_EMAIL', 'Καθορίστε τη διεύθυνση στην οποία θα αποστέλλονται αιτήματα από τη σελίδα &quot;Επικοινωνήστε μαζί μας&quot;');
define('TOOLTIP_STORE_COUNTRY', 'Καθορίστε τη χώρα του καταστήματος, θα επιλεγεί από προεπιλογή κατά την παραγγελία.');
define('TOOLTIP_STORE_REGION', 'Καθορίστε την περιοχή του καταστήματος, θα επιλεγεί από προεπιλογή κατά την παραγγελία.');
define('TOOLTIP_CONTACT_ADDRESS', 'Εισαγάγετε τη διεύθυνση καταστήματος, θα εμφανιστεί στη σελίδα &quot;Επαφές&quot;.');
define('TOOLTIP_MINIMUM_ORDER', 'Προαιρετικά, μπορείτε να καθορίσετε το ελάχιστο ποσό για μια επιτυχημένη παραγγελία.');
define('TOOLTIP_MASTER_PASSWORD', 'Ο κωδικός πρόσβασης που είναι κατάλληλος για την είσοδο του λογαριασμού οποιουδήποτε πελάτη που είναι εγγεγραμμένος στον ιστότοπο.');
define('TOOLTIP_SHOW_PRICE_WITH_TAX', 'Μετακινήστε το ρυθμιστικό για να εμφανίσετε τιμές σε όλες τις σελίδες του ιστότοπου, συμπεριλαμβανομένου του φόρου.');
define('TOOLTIP_CALCULATE_TAX', 'Εάν συμπεριληφθεί, ο καθορισμένος φόρος προϊόντος θα ληφθεί υπόψη κατά την ολοκλήρωση της αγοράς.');
define('TOOLTIP_EXTRA_PRICE', 'Προαιρετικά, μπορείτε να ορίσετε μια σήμανση που θα εμφανίζεται για μη εγγεγραμμένους χρήστες του ιστότοπου.');
define('TOOLTIP_PRICES_COUNT', 'Υποδείξτε τον πιθανό αριθμό τιμών που θα καθοριστούν για τα αγαθά (π.χ. πολλές τιμές για διαφορετικές ομάδες πελατών)');
define('TOOLTIP_SHOW_PRICE_TO_NOT_AUTHORIZED_CUSTOMER', 'Εμφάνιση τιμών προϊόντος για μη εγγεγραμμένους χρήστες');
define('TOOLTIP_LOGO', 'Επιλέξτε το λογότυπο (εικόνα) που θα εμφανίζεται στην αρχική σελίδα');
define('TOOLTIP_WATERMARK', 'Επιλέξτε μια εικόνα που θα τοποθετηθεί στη φωτογραφία του προϊόντος, προστασία αντιγραφής.');
define('TOOLTIP_FAVICON', 'Επιλέξτε την εικόνα που θα εμφανίζεται από το εικονίδιο του ιστότοπου');
define('TOOLTIP_AUTO_STOCK', 'Κατά την παραγγελία, ο αριθμός των εμπορευμάτων στην αποθήκη και η διαθεσιμότητα της παραγγελίας ελέγχονται αυτόματα.');
define('TOOLTIP_DISABLED_BUY_BUTTON_FOR_ZERO_STOCK', 'Στη σελίδα ενός προϊόντος που δεν είναι διαθέσιμο, θα εμφανιστεί ένα κουμπί &quot;αγορά&quot;.');
define('TOOLTIP_STOCK_AUTO_INCREMENT', 'Κατά την παραγγελία, το ποσό των αγορασθέντων αγαθών αφαιρείται αυτόματα από το υπόλοιπο στην αποθήκη.');
define('TOOLTIP_ALLOW_ZERO_STOCK_ORDER', 'Επιτρέψτε την παραγγελία για ένα προϊόν που δεν είναι διαθέσιμο.');
define('TOOLTIP_MARK_ZERO_STOCK_PRODUCT', 'Εάν το αντικείμενο που προστέθηκε στο καλάθι δεν είναι στην απαιτούμενη ποσότητα σε απόθεμα, το αντικείμενο θα επισημανθεί με την καθορισμένη τιμή.');
define('TOOLTIP_ZERO_STOCK_NOTIFICATION', 'Όταν επιτευχθεί αυτή η ποσότητα, αποστέλλεται μια ειδοποίηση στο ταχυδρομείο ότι τα αγαθά εξαντλούνται.');
define('TOOLTIP_SMS_TEXT', 'Καθορίστε το κείμενο που θα σταλεί στον πελάτη.');
define('TOOLTIP_SMS_LOGIN', 'Παρέχεται από πάροχο sms.');
define('TOOLTIP_SMS_PASSWORD', 'Παρέχεται από πάροχο sms.');
define('TOOLTIP_SMS_CODE_1', 'Αριθμός τηλεφώνου ή αλφαριθμητικός αποστολέας.');
define('TOOLTIP_SMS_CODE_2', 'Παρέχεται από πάροχο sms.');
define('TOOLTIP_TAX_ADD', 'Για να προσθέσετε έναν νέο τύπο φόρου, κάντε κλικ στο &quot;+&quot; και συμπληρώστε τα απαιτούμενα πεδία.');
define('TOOLTIP_TAX_RATE_ADD', 'Για να προσθέσετε ποσοστό% που θα προστεθεί στο κόστος του προϊόντος, κάντε κλικ στο &quot;+&quot; και συμπληρώστε τα απαιτούμενα πεδία.');
define('TOOLTIP_TAX_ZONE_ADD', 'Για να προσθέσετε μια ζώνη (χώρα) στην οποία θα ισχύει ο φόρος, κάντε κλικ στο &quot;+&quot; και συμπληρώστε τα απαιτούμενα πεδία.');
define('TOOLTIP_BACKUP_CREATE', 'Δημιουργήστε ένα αντίγραφο ασφαλείας της τρέχουσας έκδοσης της βάσης δεδομένων ιστότοπου.');
define('TOOLTIP_BACKUP_LOAD', 'Επαναφορά της βάσης δεδομένων από το επιλεγμένο αρχείο.');
define('TOOLTIP_EMAILING', 'Αποστολή e-mail σε έναν πελάτη, σε όλους τους πελάτες ή σε όλους τους συνδρομητές ειδήσεων.');
define('TOOLTIP_MASS_EMAILING', 'Αποστολή email σε μεμονωμένο πελάτη ή σε επιλεγμένη ομάδα πελατών.');
define('TOOLTIP_CLEAR_CACHE', 'Διαγραφή μεταφορτωμένων εικόνων από την προσωρινή μνήμη.');
define('TOOLTIP_STATS_SALES', 'Εμφάνιση στατιστικών στοιχείων πωλήσεων.');
define('TOOLTIP_STATS_SALES_PRODUCTS_BY_TIME_PERIOD', 'Αναφορά πωλήσεων για παραγγελθέντα προϊόντα για την επιλεγμένη χρονική περίοδο.');
define('TOOLTIP_STATS_SALES_CATEGORIES_BY_TIME_PERIOD', 'Αναφορά πωλήσεων ανά κατηγορίες προϊόντων για την επιλεγμένη χρονική περίοδο.');
define('TOOLTIP_STATS_VIEWED_PRODUCTS', 'Στατιστικά στοιχεία προβαλλόμενων προϊόντων.');
define('TOOLTIP_STATS_ZERO_QUANTITY_PRODUCTS', 'Το προϊόν δεν είναι διαθέσιμο.');
define('TOOLTIP_STATS_CLIENTS_ORDERS', 'Αναφορά αγορών πελατών για μια επιλεγμένη χρονική περίοδο.');
define('TOOLTIP_ADMINISTRATORS', 'Λίστα διαχειριστών ιστότοπου.');
define('TOOLTIP_ADMINISTRATORS_GROUPS', 'Διαχωρισμός διαχειριστών σε ομάδες.');
define('TOOLTIP_ADMINISTRATORS_ACCESS_RIGHTS', 'Δικαιώματα πρόσβασης σε πληροφορίες στον ιστότοπο, ανάλογα με την ομάδα των διαχειριστών.');
define('TOOLTIP_TEXT_COPIED', 'Το κείμενο αντιγράφηκε');
define('TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY', 'αγορά');
define('TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON', 'ανάβω');
define('TOOLTIP_TEXT_TAB_LANGUAGES', 'Γλωσσική λειτουργικότητα');
define('TOOLTIP_TEXT_TAB_AUTO_TRANSLATE', 'Αυτόματη μαζική μετάφραση περιεχομένου');
define('TOOLTIP_TEXT_TAB_EDIT_TRANSLATE', 'Επεξεργασία μεταφράσεων');
define('HIGHSLIDE_CLOSE', 'Κλείσε');
define('COMMENT_BY_ADMIN', 'Σχόλιο από τον διαχειριστή');
define('TEXT_MENU_WHO_IS_ONLINE', 'Ποιος είναι συνδεδεμένος');
define('INFO_ICON_NEED_MINIFY', 'Τυχόν αλλαγές σε αυτήν την ενότητα θα αλλάξουν την κατάσταση των στυλ σε Minify Now');
define('INFO_ICON_ENABLE_SMTP', 'Κατά την ενεργοποίηση, ελέγξτε τις ρυθμίσεις του SMTP');
define('SMTP_CONF_TITLE', 'Ρυθμίσεις SMTP');
define('INFO_ICON_NEED_GENERATE_CRITICAL', 'Οι αλλαγές σε αυτήν την παράμετρο απαιτούν αναγεννητική κρίσιμη CSS');
define('YANDEX_MARKET_MODULE_ENABLED_TITLE', 'XML (YML) products export "Yandex Market"');
define('AUTO_TRANSLATE_MODULE_ENABLED_TITLE', 'Αυτόματη μετάφραση');
define('TEXT_INFO_BUY_MODULE', 'Η ενότητα «%s» είναι απενεργοποιημένη, για να την ενεργοποιήσετε, χρησιμοποιήστε τη σελίδα <a href="%s"><span style="color:blue;" >Ενότητες</span></a>');
define('TEXT_INFO_DISABLE_MODULE', 'Δεν υπάρχει ενότητα «%s», για να την προσθέσετε, να τη χρησιμοποιήσετε <a href="%s"><span style="color:blue;" >Κατάστημα SoloMono Modules</span></a>');
define("TEXT_POPULAR_SEARCH_QUERIES", "Δημοφιλείς αναζητήσεις");
define("STATS_KEYWORDS_POPULAR_ENABLED_TITLE", "Αναζήτηση σελίδων");
define("LIST_MODAL_ON","Παράθυρο τρόπου παραγωγής προϊόντος");
define("SHOW_BASKET_ON_ADD_TO_CART_TITLE","Εμφάνιση καλαθιού κατά την προσθήκη αντικειμένου");
define("TEXT_QUICK_ORDER", "Τηλεφωνική παραγγελία !");
define("TEXT_VIEWED","Προβολή");
define('API_ENABLED_TITLE', 'Solomono API');
define('TEXT_MENU_API', 'API');
define('EMAIL_CONTENT_MODULE_ENABLED_TITLE', 'Πρότυπα ηλεκτρονικού ταχυδρομείου');
define('ENTRY_CREDIT_CARD_CC_TYPE', 'Τύπος κάρτας');
define('ENTRY_CREDIT_CARD_CC_OWNER', 'Κάτοχος κάρτας');
define('ENTRY_CREDIT_CARD_CC_NUMBER', 'Αριθμός κάρτας');
define('ENTRY_CREDIT_CARD_CC_EXPIRES', 'Λήξη κάρτας');
define('TEXT_SEARCH_PAGES','Αναζήτηση σελίδων');
define('SMTP_MODULE_ENABLED_TITLE','SMTP');
define('TEXT_CLOSE_BUTTON', 'Κλεισiμο');
define('LEFT_MENU_SECTION_TITLE_SHOP','Κατάστημα');
define('LEFT_MENU_SECTION_TITLE_INFO','Πληροφορίες');
define('LEFT_MENU_SECTION_TITLE_CONTROL','Ελεγχος');
define('TBL_LINK_TITLE', 'Κατηγορίες Ajax');
define('TBL_HEADING_TITLE_BACK_TO_PARENT', 'Πίσω');
define('TBL_HEADING_TITLE_SEARCH', 'Αναζήτηση');
define('TBL_HEADING_CATEGORIES_PRODUCTS', 'Κατηγορίες / Προϊόντα');
define('TBL_HEADING_MODEL', 'Κώδικας');
define('TBL_HEADING_QUANTITY', 'Ποτ');
define('TBL_HEADING_PRICE', 'Τιμή');
define('TBL_HEADING_TITLE_BACK_TO_DEFAULT_ADMIN', 'Επιστροφή στην προεπιλεγμένη διαχείριση');
define('TBL_HEADING_PRODUCTS_COUNT', ' προϊόντα');
define('TBL_HEADING_SUBCATEGORIES_COUNT', ' υποκατηγορίες');
define('TBL_HEADING_SUBCATEGORIE_COUNT', ' υποκατηγορία');
define('INTEGRATION_FACEBOOK_CONF_TITLE','Ενσωμάτωση Facebook');
define('INTEGRATION_GOOGLE_CONF_TITLE','Ενσωμάτωση GOOGLE');
define('SEO_SETTINGS_CONF_TITLE','Ρυθμίσεις SEO');

define('FACEBOOK_GOALS_ADD_PAYMENT_INFO_TITLE','Στόχος \'AddPaymentInfo\' - συμπλήρωση στοιχείων πληρωμής');
define('FACEBOOK_GOALS_ADD_TO_WISHLIST_TITLE','Στόχος \'AddToWishlist\' - πρόσθεσε στην λίστα επιθυμιών');
define('FACEBOOK_GOALS_CONTACT_US_REQUEST_TITLE','Στόχος \'Lead\' - αίτημα στη σελίδα επικοινωνίας');
define('FACEBOOK_GOALS_VIEW_CONTENT_TITLE','Στόχος \'ViewContent\' - προβολή σελίδας προϊόντος');
define('FACEBOOK_GOALS_SUCCESS_PAGE_TITLE','Στόχος \'Purchase\' - σελίδα μετά την επιβεβαίωση της παραγγελίας');
define('FACEBOOK_GOALS_CHECKOUT_PROCESS_TITLE','Στόχος \'InitiateCheckout\' - σελίδα ολοκλήρωσης αγοράς');
define('FACEBOOK_GOALS_SEARCH_RESULTS_TITLE','Στόχος \'Search\' - σελίδα αποτελεσμάτων αναζήτησης');
define('FACEBOOK_GOALS_COMPLETE_REGISTRATION_TITLE','Στόχος \'CompleteRegistration\' - όταν ο πελάτης έχει εγγραφεί');
define('FACEBOOK_GOALS_ADD_TO_CART_TITLE','Στόχος \'AddToCart\' - προσθήκη στο καλάθι');
define('FACEBOOK_GOALS_PAGE_VIEW_TITLE','Στόχος \'PageView\' - σε κάθε σελίδα');
define('FACEBOOK_GOALS_CLICK_FAST_BUY_TITLE','Στόχος \'FastBuy\' - όταν ο πελάτης κάνει κλικ στο κουμπί \'Γρήγορη παραγγελία\' στη σελίδα προϊόντος');
define('FACEBOOK_GOALS_CLICK_ON_CHAT_TITLE','Στόχος \'ClickChat\' - όταν ο πελάτης κάνει κλικ στο κουμπί Συνομιλία');
define('FACEBOOK_GOALS_CALLBACK_TITLE','Στόχος \'Callback\' - όταν ο πελάτης κάνει κλικ στο κουμπί \'Callback\' στην κεφαλίδα του ιστότοπου');
define('FACEBOOK_GOALS_FILTER_TITLE','Στόχος \'filter\' - όταν ο πελάτης χρησιμοποιεί ένα φίλτρο για αναζήτηση προϊόντων');
define('FACEBOOK_GOALS_SUBSCRIBE_TITLE','Στόχος \'Subscribe\' - όταν ο πελάτης έχει εγγραφεί');
define('FACEBOOK_GOALS_LOGIN_TITLE','Στόχος \'login\' - όταν ο πελάτης έχει συνδεθεί');
define('FACEBOOK_GOALS_ADD_REVIEW_TITLE','Στόχος \'add_review\' - όταν ο πελάτης πρόσθεσε κριτική');
define('FACEBOOK_GOALS_PHONE_CALL_TITLE','Στόχος \'PhoneCall\' - όταν ο πελάτης κάνει κλικ στον αριθμό τηλεφώνου στην κεφαλίδα του ιστότοπου');
define('FACEBOOK_GOALS_CLICK_ON_BUG_REPORT_TITLE','Στόχος \'BugReport\' - όταν ο πελάτης κάνει κλικ στο \'Αποστολή μηνύματος σφάλματος\' στο υποσέλιδο ιστότοπου');

define('NWPOSHTA_DELIVERY_TITLE', 'Νέα διεύθυνση αποστολής αλληλογραφίας');

define('HEADER_BUY_TEMPLATE_LINK','Μετάβαση σε πακέτο επί πληρωμή');
define('HEADER_MARKETPLACE_LINK','Αγορά ενοτήτων');
define('TEXT_CATEGORIES', 'Κατηγορίες');
define('HEADING_TITLE_GOTO', 'Μετάβαση σε:');
define('ERROR_DOMAIN_IN_USE','Σφάλμα! Αυτός ο τομέας χρησιμοποιείται ήδη');
define('ERROR_ANAME_MISMATCH', 'Σφάλμα! Ένα όνομα δεν ταιριάζει με το 167.172.41.152. Δοκιμάστε αργότερα');
define('SUCCESS_DOMAIN_CHANGE', 'Επιτυχία! Ο τομέας άλλαξε');
define('ERROR_ADD_DOMAIN_FIRST','Συνδέστε πρώτα τον προσαρμοσμένο τομέα σας!');
define('ERROR_BASH_EXECUTION','Σφάλμα κατά την εκτέλεση του σεναρίου, υπεύθυνος επικοινωνίας');
define('ERROR_SIMLINK_CREATE', 'Ο συμβολικός σύνδεσμος δεν δημιουργήθηκε');
define('ERROR_FOLDER_RENAME', 'Ο φάκελος δεν αντιγράφηκε');

define('PRODUCTS_LIMIT_REACHED_FREE', 'Υπέρβαση του ορίου προϊόντων! Ο ιστότοπός σας θα απενεργοποιηθεί αυτόματα σε %s ημέρες. <a href="%s">Ενοικιάστε μια χρέωση</a> ή αφαιρέστε τα ανεπιθύμητα προϊόντα');
define('PRODUCTS_LIMIT_REACHED_JUNIOR', 'Υπέρβαση του ορίου προϊόντος! Σε %s ημέρες ο ιστότοπός σας θα αναβαθμιστεί αυτόματα σε πακέτο SEO.');
define('PRODUCTS_LIMIT_REACHED_SEO', 'Υπέρβαση του ορίου προϊόντος! Σε %s ημέρες ο ιστότοπός σας θα αναβαθμιστεί αυτόματα σε πακέτο επαγγελματικής');
define('PRODUCTS_LIMIT_REACHED_HEADING', 'Υπέρβαση του ορίου προϊόντος!');