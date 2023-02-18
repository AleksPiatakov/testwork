<?php
/*
  $Id: polls.php,v 1.2 2003/04/06 13:12:38 vadne Exp $

  The Exchange Project – Community Made Shopping!
  http://www.theexchangeproject.org

  Copyright (c) 2000,2001 The Exchange Project

  Vydáno pod GNU General Public License
*/

define('HEADING_TITLE', 'Správce anket');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_TITLE', 'Název ankety');
define('TABLE_HEADING_VOTES', 'Počet hlasů');
define('TABLE_HEADING_CREATED', 'Datum vytvoření');
define('TABLE_HEADING_ACTION', 'Akce');
define('TABLE_HEADING_PUBLIC', 'Veřejné');
define('TABLE_HEADING_OPEN', 'Otevřít');
define('TABLE_HEADING_CONFIGURATION_TITLE','Název');
define('TABLE_HEADING_CONFIGURATION_VALUE','Hodnota');
define('TEXT_DISPLAY_NUMBER_OF_POLLS', 'Počet anket:');
define('TEXT_DELETE_INTRO', 'Opravdu chcete smazat toto hlasování?');
define('TEXT_INFO_DESCRIPTION','Popis:');
define('TEXT_INFO_DATE_ADDED','Datum přidání:');
define('TEXT_INFO_LAST_MODIFIED','Naposledy upraveno:');
define('TEXT_INFO_EDIT_INTRO','Proveďte prosím potřebné změny');
define('TEXT_POLL_TITLE', 'Název ankety');
define('TEXT_POLL_CATEGORY', 'Vyberte kategorii');
define('TEXT_OPTION', 'Možnost');
define('IMAGE_NEW_POLL', 'Nová anketa');
define('_ALT_REOPEN','Znovu otevřít anketu');
define('_ALT_CLOSE','Zavřít anketu');
define('_ALT_PUBLIC','Zveřejnit hlasování');
define('_ALT_PRIVATE','Nastavit hlasování jako soukromé');

define('DISPLAY_POLL_HOW_TITLE', 'Zobrazit anketu');
define('DISPLAY_POLL_ID_TITLE', 'ID ankety');
define('SHOW_POLL_COMMENTS_TITLE', 'Povolit komentáře');
define('SHOW_NOPOLL_TITLE', 'Zobrazit, pokud nejsou žádné ankety');
define('POLL_SPAM_TITLE', 'Povolit vícenásobné hlasování');
define('MAX_DISPLAY_NEW_COMMENTS_TITLE', 'Počet komentářů');

define('DISPLAY_POLL_HOW_DESC', 'Rozhodne, jak bude zvolena anketa zobrazená v postranním poli.<br>0 = Náhodné<br>1 = Nejnovější<br>2 = Nejoblíbenější<br>3 = Specifické ID ankety');
define('DISPLAY_POLL_ID_DESC', 'Pokud jste se rozhodli výše zobrazit<br>konkrétní anketu, zadejte anketu zde');
define('SHOW_POLL_COMMENTS_DESC', 'Povolit nebo zakázat komentáře v anketě.<br>0 = Zakázat<br>1 = Povolit');
define('SHOW_NOPOLL_DESC', 'Pokud je nastaveno, bude se stále zobrazovat pole pro hlasování, pokud neexistují žádné vhodné průzkumy.<br>0 = Nezobrazovat postranní pole<br>1 = Zobrazit postranní pole');
define('POLL_SPAM_DESC', 'Umožněte lidem hlasovat více než jednou.<br>0 = Ne (doporučeno)<br>1 = ano (užitečné pro testování)');
define('MAX_DISPLAY_NEW_COMMENTS_DESC', 'Maximální počet komentářů k zobrazení na stránce hlasování');

define('TEXT_POLL_ALL_CATS','Všechny kategorie');
define('TEXT_POLL_NOPOLLS','Neexistují žádné ankety');

?>