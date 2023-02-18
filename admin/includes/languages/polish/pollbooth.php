<?php
/*
$Id: pollbooth.php,v 1.5 2003/04/06 21:45:33 wilt Exp $

The Exchange Project - Community Made Shopping!
http://www.theexchangeproject.org

Copyright (c) 2000,2001 The Exchange Project

Released under the GNU General Public License
*/

define('TEXT_POLLB_RESULTS', 'Wyniki ankiety');
define('TEXT_POLLB_TOTAL', 'Łącznie głosów');

if (!isset($_GET['op'])) {
  $_GET['op']="list";
} else if ($_GET['op'] == 'results') {
  define('TOP_BAR_TITLE', 'Wyniki ankiety');
  define('HEADING_TITLE', 'Wyniki ankiety');
  define('SUB_BAR_TITLE', 'Wyniki ankiety');
} else if ($_GET['op'] == 'list') {
  define('TOP_BAR_TITLE', 'Wyniki ankiety');
  define('HEADING_TITLE', 'Wyniki ankiety');
  define('SUB_BAR_TITLE', 'Inne ankiety');
} else if ($_GET['op'] == 'vote') {
  define('TOP_BAR_TITLE', 'Wyniki ankiety');
  define('HEADING_TITLE', 'Wyniki ankiety');
  define('SUB_BAR_TITLE', 'Głosuj');
} else if ($_GET['op'] == 'comment') {
  define('HEADING_TITLE', 'Komentarze');
}

define('_WARNING', 'Ostrzeżenie: ');
define('_ALREADY_VOTED', 'Już głosowałeś.');
define('_NO_VOTE_SELECTED', 'Nie wybrałeś odpowiedzi do głosowania.');
define('_TOTALVOTES', 'Łącznie głosów');
define('_OTHERPOLLS', 'Inne ankiety');
define('NAVBAR_TITLE_1', 'Wyniki ankiety');
define('_POLLRESULTS', 'Wyniki ankiety');
define('_VOTING', 'Głosuj');
define('_RESULTS', 'Wyniki');
define('_VOTES', 'Głosów');
define('_VOTE', 'Głosuj');
define('_COMMENT', 'Komentarz');
define('_COMMENTS_POSTED', 'Komentarze dodane');
define('_COMMENTS_BY', 'Komentarz dodał ');
define('_COMMENTS_ON', '  ');
define('_YOURNAME', 'Twoje imię:');
define('_OTZYV', 'Komentarz:');
define('TEXT_CONTINUE', 'Dodaj komentarz');
define('_PUBLIC','Jawne głosowanie');
define('_PRIVATE','Tajne głosowanie');
define('_POLLOPEN','Ankieta aktywna');
define('_POLLCLOSED','Ankieta dla zarejestrowanych użytkowników');
define('_POLLPRIVATE','Ankieta wyłącznie dla zarejestrowanych użytkowników, zaloguj się, ankieta wyłącznie dla zarejestrowanych użytkowników');
define('_ADD_COMMENTS', 'Dodaj komentarz');
define('TEXT_DISPLAY_NUMBER_OF_COMMENTS', 'Wyświetlono <b>%d</b> - <b>%d</b> (łącznie <b>%d</b> komentarzy)');
