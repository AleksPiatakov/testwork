<?php
/*
$Id: pollbooth.php,v 1.5 2003/04/06 21:45:33 wilt Exp $

The Exchange Project - Community Made Shopping!
http://www.theexchangeproject.org

Copyright (c) 2000,2001 The Exchange Project

Released under the GNU General Public License
*/

define('TEXT_POLLB_RESULTS', 'Αποτελέσματα δημοσκόπησης');
define('TEXT_POLLB_TOTAL', 'Σύνολο ψήφων');

if (!isset($_GET['op'])) {
  $_GET['op']="list";
} else if ($_GET['op'] == 'Αποτελέσματα') {
  define('TOP_BAR_TITLE', 'Κάλπη');
  define('HEADING_TITLE', 'Δείτε τι σκέφτονται οι άλλοι');
  define('SUB_BAR_TITLE', 'Αποτελέσματα δημοσκόπησης');
} else if ($_GET['op'] == 'λίστα') {
  define('TOP_BAR_TITLE', 'Καλπη');
  define('HEADING_TITLE', 'Εκτιμούμε τις σκέψεις σας');
  define('SUB_BAR_TITLE', 'Προηγούμενες δημοσκοπήσεις');
} else if ($_GET['op'] == 'ψήφος') {
  define('TOP_BAR_TITLE', 'Καλπη');
  define('HEADING_TITLE', 'Οι πελάτες μας έχουν σημασία');
  define('SUB_BAR_TITLE', 'Ψηφήστε σε αυτή τη δημοσκόπηση');
} else if ($_GET['op'] == 'σχόλια') {
  define('HEADING_TITLE', 'Σχολιάστε αυτή τη δημοσκόπηση');
}

define('_WARNING', 'Σας ενημερώνουμε : ');
define('_ALREADY_VOTED', 'Έχετε ψηφιστεί πρόσφατα σε αυτή τη δημοσκόπηση.');
define('_NO_VOTE_SELECTED', 'Δεν επιλέξατε την επιλογή να ψηφίσετε.');
define('_TOTALVOTES', 'Σύνολο ψήφων');
define('_OTHERPOLLS', 'Άλλες Δημοσκοπήσεις');
define('_POLLRESULTS', 'Κάντε κλικ εδώ για αποτελέσματα δημοσκόπησης');
define('_VOTING', 'Ψηφίστε τώρα');
define('_RESULTS', 'Αποτελέσματα');
define('_VOTES', 'Ψηφοφορίες');
define('_VOTE', 'ΨΗΦΟΣ');
define('_COMMENT', 'Σχόλια');
define('_COMMENTS_POSTED', 'Σχόλιο Καταχωρήθηκε');
define('_COMMENTS_BY', 'Σχόλιο από ');
define('_COMMENTS_ON', 'επί ');
define('_YOURNAME', 'Το όνομα σας');
define('_OTZYV', 'Σχόλιο:');
define('TEXT_CONTINUE', 'Να συνεχίσει');
define('_PUBLIC','Δημόσιο');
define('_PRIVATE','Ιδιωτικό');
define('_POLLOPEN','η δημοσκόπηση ειναι Άνοιχτη');
define('_POLLCLOSED','Η δημοσκόπηση είναι κλειστή');
define('_POLLPRIVATE','Ιδιωτική δημοσκόπηση, θα πρέπει να συνδεθείτε για να ψηφίσετε');
define('_ADD_COMMENTS', 'Πρόσθεσε σχόλιο');
define('TEXT_DISPLAY_NUMBER_OF_COMMENTS', 'Εμφάνιση <b>%d</b> to <b>%d</b> (of <b>%d</b> σχολίων)');
