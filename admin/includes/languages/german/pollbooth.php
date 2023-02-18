<?php
/*
$ Id: pollbooth.php, v 1.5 2003/04/06 21:45:33 wilt Exp $

Das Exchange-Projekt - Community Made Shopping!
http://www.theexchangeproject.org

Copyright(c) 2000, 2001 Das Exchange-Projekt

  Released under the GNU General Public License
*/

define('TEXT_POLLB_RESULTS', 'Umfrageergebnisse');
define('TEXT_POLLB_TOTAL', 'Gesamtstimmen');

if(!isset($_GET ['op'])) {
  $_GET ['op']="list";
} else if($_GET ['op'] =='results') {
  define('TOP_BAR_TITLE', 'Umfrageergebnisse');
  define('HEADING_TITLE', 'Umfrageergebnisse');
  define('SUB_BAR_TITLE', 'Umfrageergebnisse');
} else if($_GET ['op'] =='list') {
  define('TOP_BAR_TITLE', 'Umfrageergebnisse');
  define('HEADING_TITLE', 'Umfrageergebnisse');
  define('SUB_BAR_TITLE', 'Andere Umfragen');
} else if($_GET['op'] =='vote') {
  define('TOP_BAR_TITLE', 'Umfrageergebnisse');
  define('HEADING_TITLE', 'Umfrageergebnisse');
  define('SUB_BAR_TITLE', 'Vote');
} else if($_GET ['op'] =='comment') {
  define('HEADING_TITLE', 'Reviews');
}

define('_ WARNING', 'Warnung: ');
define('_ ALREADY_VOTED', 'Sie haben bereits abgestimmt. ');
define('_ NO_VOTE_SELECTED', 'Sie haben die Antwort nicht gewählt. ');
define('_ TOTALVOTES', 'Gesamtstimmen');
define('_ OTHERPOLLS', 'Andere Umfragen');
define('NAVBAR_TITLE_1', 'Umfrageergebnisse');
define('_ POLLRESULTS', 'Umfrageergebnisse');
define('_ VOTING', 'Vote');
define('_ ERGEBNISSE', 'Ergebnisse');
define('_ VOTES', 'Votes');
define('_ VOTE', 'Vote');
define('_ COMMENT', 'Feedback');
define('_ COMMENTS_POSTED', 'Bewertungen hinzugefügt');
define('_ COMMENTS_BY', 'Review hinzugefügt');
define('_ COMMENTS_ON', '');
definiere('_ YOURNAME', 'Dein Name: ');
define('_ OTZYV', 'Rückruf');
define('TEXT_CONTINUE', 'Feedback hinzufügen');
define('_ PUBLIC', 'Offene Abstimmung');
define('_ PRIVATE', 'Closed Voting');
define('_ POLLOPEN', 'Die Umfrage ist offen');
define('_ POLLCLOSED', 'Umfrage für registrierte Benutzer');
define('_ POLLPRIVATE', 'Umfrage für registrierte Benutzer, logge dich in den Shop ein, Umfrage nur für registrierte Benutzer');
define('_ ADD_COMMENTS', 'Feedback hinzufügen');
define('TEXT_DISPLAY_NUMBER_OF_COMMENTS', 'angezeigte <b>%d</b> - <b>%d</b> (alle <b>%d</b> Zusammenfassung)');

?>