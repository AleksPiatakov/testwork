<?php
/*
$Id: pollbooth.php,v 1.5 2003/04/06 21:45:33 vadne Exp $

The Exchange Project – Community Made Shopping!
http://www.theexchangeproject.org

Copyright (c) 2000,2001 The Exchange Project

Vydáno pod GNU General Public License
*/

define('TEXT_POLLB_RESULTS', 'Výsledky ankety');
define('TEXT_POLLB_TOTAL', 'Celkový počet hlasů');

if (!isset($_GET['op'])) {
    $_GET['op']="seznam";
} else if ($_GET['op'] == 'výsledky') {
    define('TOP_BAR_TITLE', 'Polling Booth');
    define('HEADING_TITLE', 'Podívejte se, co si ostatní myslí');
    define('SUB_BAR_TITLE', 'Výsledky ankety');
} else if ($_GET['op'] == 'seznam') {
    define('TOP_BAR_TITLE', 'Polling Booth');
    define('HEADING_TITLE', 'Vážíme si vašich myšlenek');
    define('SUB_BAR_TITLE', 'Předchozí ankety');
} else if ($_GET['op'] == 'hlasovat') {
    define('TOP_BAR_TITLE', 'Polling Booth');
    define('HEADING_TITLE', 'Na našich zákaznících záleží');
    define('SUB_BAR_TITLE', 'Hlasujte v této anketě');
} else if ($_GET['op'] == 'komentář') {
    define('HEADING_TITLE', 'Komentář k tomuto hlasování');
}

define('_WARNING', 'Upozornění: ');
define('_ALREADY_VOTED', 'Nedávno jste hlasovali v tomto hlasování.');
define('_NO_VOTE_SELECTED', 'Nevybrali jste možnost, pro kterou budete hlasovat.');
define('_TOTALVOTES', 'Celkový počet odevzdaných hlasů');
define('_OTHERPOLLS', 'Další ankety');
define('_POLLRESULTS', 'Klikněte sem pro výsledky ankety');
define('_VOTING', 'Hlasujte nyní');
define('_RESULTS', 'Výsledky');
define('_VOTES', 'Hlasy');
define('_VOTE', 'VOTE');
define('_COMMENT', 'Komentář');
define('_COMMENTS_POSTED', 'Uveřejněny komentáře');
define('_COMMENTS_BY', 'Komentář vytvořil ');
define('_COMMENTS_ON', ' on ');
define('_VAŠE JMÉNO', 'Vaše jméno');
define('_OTZYV', 'Komentář:');
define('TEXT_CONTINUE', 'Pokračovat');
define('_PUBLIC','Public');
define('_PRIVATE','Private');
define('_POLLOPEN','Poll Open');
define('_POLLCLOSED','Anketa uzavřena');
define('_POLLPRIVATE','Soukromá anketa, pro hlasování musíte být přihlášeni');
define('_ADD_COMMENTS', 'Přidat komentář');
define('TEXT_DISPLAY_NUMBER_OF_COMMENTS', 'Zobrazuje se <b>%d</b> až <b>%d</b> (z <b>%d</b> komentářů)');