<?php
/*
  $Id: polls.php,v 1.2 2003/04/06 13:12:38 wilt Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Copyright (c) 2000,2001 The Exchange Project

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Διαχειριστής δημοσκόπησης Νικος');

define('TABLE_HEADING_ID', 'Ταυτότητα');
define('TABLE_HEADING_TITLE', 'Τίτλος δημοσκόπησης');
define('TABLE_HEADING_VOTES', 'Αριθμός ψήφων');
define('TABLE_HEADING_CREATED', 'Ημερομηνία Δημιουργίας');
define('TABLE_HEADING_ACTION', 'Ενεργή!');
define('TABLE_HEADING_PUBLIC', 'Δημόσια');
define('TABLE_HEADING_OPEN', 'Ανοιξε');
define('TABLE_HEADING_CONFIGURATION_TITLE','Τίτλος');
define('TABLE_HEADING_CONFIGURATION_VALUE','αξία');
define('TEXT_DISPLAY_NUMBER_OF_POLLS', 'Αριθμός δημοσκοπήσεων:');
define('TEXT_DELETE_INTRO', 'Είστε βέβαιοι ότι θέλετε να διαγράψετε αυτήν τη δημοσκόπηση?');
define('TEXT_INFO_DESCRIPTION','Περιγραφή Δημοσκόπισης:');
define('TEXT_INFO_DATE_ADDED','Ημερομηνία προστέθηκε αλλαγή:');
define('TEXT_INFO_LAST_MODIFIED','Τελευταία τροποποίηση:');
define('TEXT_INFO_EDIT_INTRO','Κάντε τις απαραίτητες αλλαγές');
define('TEXT_POLL_TITLE', 'Τίτλος δημοσκόπησης');
define('TEXT_POLL_CATEGORY', 'Επιλέξτε Κατηγορία');
define('TEXT_OPTION', 'Επιλογή');
define('IMAGE_NEW_POLL', 'Νέα δημοσκόπηση?');
define('_ALT_REOPEN','Ανοίξτε εκ νέου τη δημοσκόπηση');
define('_ALT_CLOSE','Κλείσιμο δημοσκόπησης');
define('_ALT_PUBLIC','Δημοσιεύστε την δημοσκόπηση στο κοινο της σιων');
define('_ALT_PRIVATE','Κάντε ιδιωτική δημοσκόπηση');

define('DISPLAY_POLL_HOW_TITLE', 'Εμφάνιση δημοσκόπησης');
define('DISPLAY_POLL_ID_TITLE', 'Poll Id');
define('SHOW_POLL_COMMENTS_TITLE', 'Επιτρέπω σχόλια?');
define('SHOW_NOPOLL_TITLE', 'Εμφάνιση αν δεν υπάρχουν Δημοσκοπήσεις');
define('POLL_SPAM_TITLE', 'Επιτρέψτε πολλαπλές ψήφους');
define('MAX_DISPLAY_NEW_COMMENTS_TITLE', 'Αριθμός σχολίων');

define('DISPLAY_POLL_HOW_DESC', 'Αποφασίστε πρωτα  πώς θα επιλέγεται η δημοσκόπηση που εμφανίζεται στο πλευρικό πλαίσιο <br> <br> 0 = Τυχαία <br> 1 = Τελευταία <br> 2 = Πιο δημοφιλή <br> 3 = Ειδική ταυτότητα δημοσκόπησης');
define('DISPLAY_POLL_ID_DESC', 'Αν επιλέξατε παραπάνω για να εμφανίσετε μια συγκεκριμένη δημοσκόπηση, εισάγετε εδώ το pollid (μαλλον ταυτοτητα ψηφοφορίας )');
define('SHOW_POLL_COMMENTS_DESC', 'Ενεργοποίηση ή απενεργοποίηση σχολίων δημοσκόπησης <br> <br> 0 = Απενεργοποίηση <br> 1 = Ενεργοποίηση');
define('SHOW_NOPOLL_DESC', 'Εάν έχει οριστεί, θα εμφανίστεί  το πλαίσιο δημοσκόπησης εάν δεν υπάρχουν επιλέξιμες δημοσκοπήσεις. <br> 0 = Να μην εμφανίζεται το παράθυρο πλαισίου <br> 1 = Εμφάνιση πλαισίου πλαισίου');
define('POLL_SPAM_DESC', 'Επιτρέψτε σε άτομα να ψηφίζουν περισσότερες από μία φορές <br> 0 = Όχι (συνιστάται) <br> 1 = Ναι (Χρήσιμο για δοκιμές)');
define('MAX_DISPLAY_NEW_COMMENTS_DESC', 'Μέγιστος αριθμός σχολίων που θα εμφανιστούν στη σελίδα της ρημάδας δημοσκόπησης');

define('TEXT_POLL_ALL_CATS','Ολες οι κατηγορίες');
define('TEXT_POLL_NOPOLLS','Δεν υπάρχουν δημοσκοπήσεις');

?>