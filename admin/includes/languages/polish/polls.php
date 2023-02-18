<?php
/*
  $Id: polls.php,v 1.2 2003/04/06 13:12:38 wilt Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Copyright (c) 2000,2001 The Exchange Project

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Ankiety');

define('TABLE_HEADING_ID', 'Kod');
define('TABLE_HEADING_TITLE', 'Nazwa ankiety');
define('TABLE_HEADING_VOTES', 'Głosów');
define('TABLE_HEADING_CREATED', 'Data utworzenia');
define('TABLE_HEADING_ACTION', 'Działanie');
define('TABLE_HEADING_PUBLIC', 'Głosownie jawne');
define('TABLE_HEADING_OPEN', 'Status');
define('TABLE_HEADING_CONFIGURATION_TITLE','Nagłówek');
define('TABLE_HEADING_CONFIGURATION_VALUE','Wartość');
define('TEXT_DISPLAY_NUMBER_OF_POLLS', 'Ilość ankiet:');
define('TEXT_DELETE_INTRO', 'Czy na pewno chcesz usunąć tę ankietę?');
define('TEXT_INFO_DESCRIPTION','Opis:');
define('TEXT_INFO_DATE_ADDED','Data dodania:');
define('TEXT_INFO_LAST_MODIFIED','Ostatnie zmiany:');
define('TEXT_INFO_EDIT_INTRO','Wprowadź niezbędne zmiany');
define('TEXT_POLL_TITLE', 'Nazwa ankiety');
define('TEXT_POLL_CATEGORY', 'Wybierz kategorię');
define('TEXT_OPTION', 'Wariant odpowiedzi');
define('IMAGE_NEW_POLL', 'Nowa ankieta');
define('_ALT_REOPEN','Aktywuj ankietę');
define('_ALT_CLOSE','Zamknij ankietę');
define('_ALT_PUBLIC','Udostępnij ankietę dla wszystkich');
define('_ALT_PRIVATE','Udostępnij ankietę tylko zarejestrowanym użytkownikom');

define('DISPLAY_POLL_HOW_TITLE', 'Którą ankietę wyświetlać?');
define('DISPLAY_POLL_ID_TITLE', 'ID Ankiety');
define('SHOW_POLL_COMMENTS_TITLE', 'Zezwalaj komentarze');
define('SHOW_NOPOLL_TITLE', 'Pokaż box ankiet, nawet jeśli nie ma ankiet');
define('POLL_SPAM_TITLE', 'Pozwól wielokrotne głosowanie');
define('MAX_DISPLAY_NEW_COMMENTS_TITLE', 'Liczba komentarzy na stronę');

define('DISPLAY_POLL_HOW_DESC', 'Jakie ankiety pokazać w boxie.<br>0 = Przypadkowe<br>1 = Najnowsze<br>2 = Najbardziej popularne<br>3 = Poniższa ankieta w polu ID Ankiety ');
define('DISPLAY_POLL_ID_DESC', 'Jeśli podałeś 3 w opcji Pokaż ankietę, musisz podać ID ankiety, która ma być tutaj pokazana.');
define('SHOW_POLL_COMMENTS_DESC', 'Pozwalać zostawiać komentarze do ankiety?<br>0 = Nie pozwalaj<br>1 = Pozwól');
define('SHOW_NOPOLL_DESC', 'Pokaż box ankiet, nawet jeśli w tej chwili nie ma aktywnych ankiet.<br>0 = Nie pokazuj<br>1 = Pokaż');
define('POLL_SPAM_DESC', 'Pozwól jednej osobie głosować kilka razy w tej samej ankiecie.<br>0 = Nie pozwalaj(rekomendowane)<br>1 = Pozwalaj');
define('MAX_DISPLAY_NEW_COMMENTS_DESC', 'Maksymalna liczba komentarzy na stronie');

define('TEXT_POLL_ALL_CATS','Wszystkie kategorie');
define('TEXT_POLL_NOPOLLS','Nie masz żadnych ankiet');


?>
