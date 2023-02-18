<?php
/*
  $Id: backup.php,v 1.2 2003/09/24 13:57:08 vadne Exp $

  osCommerce, Open Source řešení elektronického obchodu
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Vydáno pod GNU General Public License
*/


define('BACKUP_EXPORT', 'Vytvořit zálohu');
define('BACKUP_IMPORT', 'Obnovit zálohu');
define('TEXT_DUMPER_HEADER_TITLE', 'Záloha');
define('TEXT_DUMPER_SUBMIT', 'Vytvořit nyní');
define('TEXT_DUMPER_SUBMIT_IMPORT', 'Obnovit');
define('TEXT_DUMPER_SEC', ' sec.');
define('TEXT_DUMPER_DELETE', 'Smazat soubor');
define('TEXT_DUMPER_DIR_ERROR', 'Nelze vytvořit adresář pro zálohování');
define('TEXT_DUMPER_DOWNLOAD', 'Stáhnout soubor');
define('TEXT_DUMPER_BACK', 'Zpět');
define('TEXT_DUMPER_CREATE', 'Vytváří se záloha');
define('TEXT_DUMPER_NAME_ERROR', 'CHYBA! Chybí databáze!');
define('TEXT_DUMPER_CONNECT', 'Připojování k databázi ');
define('TEXT_DUMPER_CONNECT_ERROR', 'Nelze vybrat databázi.');
define('TEXT_DUMPER_CREATE_FILE', 'Vytváření záložního souboru pro databázi:');
define('TEXT_DUMPER_CHARSET_ERROR', 'Nelze změnit kódování.');
define('TEXT_DUMPER_CHARSET', 'Zavedená kódovací sloučenina ');
define('TEXT_DUMPER_CHARSET_COLLATION', 'Kódování a tabulka připojení neodpovídá:');
define('TEXT_DUMPER_TABLE', 'Tabulka ');
define('TEXT_DUMPER_CONNECT1', 'spojení ');
define('TEXT_DUMPER_PROCESS', 'Zpracování tabulky ');
define('TEXT_DUMPER_MAKE', 'Záloha DB ');
define('TEXT_DUMPER_MAKE1', ' byl vytvořen.');
define('TEXT_DUMPER_SIZE', 'velikost DB: ');
define('TEXT_DUMPER_MB', ' Mb');
define('TEXT_DUMPER_FILE_SIZE', 'Velikost souboru: ');
define('TEXT_DUMPER_TABLES_COUNT', 'Zpracované tabulky: ');
define('TEXT_DUMPER_STRING_COUNT', 'Zpracované řádky: ');
define('TEXT_DUMPER_RESTORE', 'Obnova databáze ze zálohy');
define('TEXT_DUMPER_FILE_ERROR', 'CHYBA! Soubor nenalezen!');
define('TEXT_DUMPER_FILE_READ', 'Čtení souboru ');
define('TEXT_DUMPER_FILE_ERROR1', 'CHYBA! Soubor není vybrán!');
define('TEXT_DUMPER_QUERY_ERROR', 'Neplatný požadavek.');
define('TEXT_DUMPER_RESTORED', 'Databáze je obnovena ze zálohy.');
define('TEXT_DUMPER_DATE', 'Datum zálohování: ');
define('TEXT_DUMPER_QUERY_COUNT', 'Dotazy do DB: ');
define('TEXT_DUMPER_TABLES_CREATED', 'Tabulky vytvořeny: ');
define('TEXT_DUMPER_STRINGS_CREATED', 'Přidané řádky: ');
define('TEXT_DUMPER_MAX', '9 (max)');
define('TEXT_DUMPER_MED', '5 (uprostřed)');
define('TEXT_DUMPER_MIN', '1 (min)');
define('TEXT_DUMPER_NO', 'Bez komprese');

define('TEXT_DUMPER_BACKUP', 'Vytváření zálohy DB&nbsp;');
define('TEXT_DUMPER_DB', 'DB:');
define('TEXT_DUMPER_FILTER', 'Filtr tabulky:');
define('TEXT_DUMPER_COMPRESS', 'Metoda komprese:');
define('TEXT_DUMPER_COMPRESS_LEVEL', 'Míra komprese:');

define('TEXT_DUMPER_RESTORE_DB', 'Obnovení databáze ze zálohy&nbsp;');
define('TEXT_DUMPER_FILE', 'Soubor:');

define('TEXT_DUMPER_TABLE_STATUS', 'Stav tabulky:');
define('TEXT_DUMPER_TOTAL_STATUS', 'Celkový stav:');

define('TEXT_DUMPER_ERROR', 'Chyba');
define('TEXT_DUMPER_BROWSER_ERROR', 'Pro správnou funkci potřebuje Sypex Dumper Lite:<br /> - Internet Explorer 5.5+, Mozilla nebo Opera 8+ (<span id=sie>-</span>)<br /> - povolený JavaScript (<span id=sjs>-</span>)');

define('TEXT_DUMPER_LOGIN_HEADER', 'Zadejte přihlašovací jméno a heslo');
define('TEXT_DUMPER_LOGIN', 'Přihlášení:');
define('TEXT_DUMPER_PASSWORD', 'Heslo:');

define('TEXT_DUMPER_FORBIDDEN', 'Nemáte oprávnění prohlížet tento adresář');
define('TEXT_DUMPER_DB_CONNECT', 'Chyba při připojování k databázi');
define('TEXT_DUMPER_DB_ERROR', 'Došlo k chybě!');
define('TEXT_DUMPER_SHOW_TABLES_LIST', 'Zobrazit tabulky ze zálohy');


?>