<?php
/*
  $Id: password_forgotten.php,v 1.8 2003/06/09 22:46:46 hpdl Λήξη $

  osCommerce, Λύσεις ηλεκτρονικού εμπορίου ανοιχτού κώδικα
  http://www.oscommerce.com

  Πνευματικά δικαιώματα (γ) 2003 osCommerce

  Κυκλοφόρησε υπό τη Γενική Δημόσια Άδεια GNU
*/

define('NAVBAR_TITLE_1', 'Enter');
define('NAVBAR_TITLE_2', 'Ανάκτηση κωδικού πρόσβασης');

define('HEADING_TITLE', 'Ξέχασα τον κωδικό πρόσβασής μου!');

define('TEXT_MAIN', 'Εάν έχετε ξεχάσει τον κωδικό πρόσβασής σας, πληκτρολογήστε τη διεύθυνση email σας και θα στείλουμε τον κωδικό πρόσβασής σας στη διεύθυνση email που καταχωρίσατε.');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', '<b>Σφάλμα:</b> Η διεύθυνση e-mail δεν ταιριάζει με το λογαριασμό σας, δοκιμάστε ξανά.');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' είναι ο κωδικός πρόσβασής σας');
define('EMAIL_PASSWORD_REMINDER_BODY', 'Έλαβε αίτημα για νέο κωδικό πρόσβασης από το ');
define('EMAIL_PASSWORD_REMINDER_BODY2', 'Ο νέος κωδικός πρόσβασης βρίσκεται στο \'' . STORE_NAME . '\':' . ' %s');
define('EMAIL_PASSWORD_REMINDER_SUBJECT2', STORE_NAME . ' - αίτημα αλλαγής κωδικού πρόσβασης');
define('EMAIL_PASSWORD_REMINDER_BODY3', 'εάν υποβάλατε αυτό το αίτημα, ακολουθήστε τον παρακάτω σύνδεσμο και ο κωδικός πρόσβασης του λογαριασμού θα ενημερωθεί');

define('SUCCESS_PASSWORD_SENT', 'Τέλος: Ο νέος κωδικός πρόσβασής σας έχει σταλεί με email.');
define('SUCCESS_PASSWORD_TOKEN_SENT', 'Τέλος: Έχει σταλεί σύνδεσμος επαναφοράς κωδικού πρόσβασης στη διεύθυνση email σας.');
define('EMAIL_TOKEN_ERROR', 'Token δεν είναι πλέον έγκυρο');