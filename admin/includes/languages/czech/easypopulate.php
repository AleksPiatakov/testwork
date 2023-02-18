<?php
/*
  $Id: easypopulate.php,v 1.4 2004/09/21 zip1 Exp $

  osCommerce, Open Source řešení elektronického obchodu
  http://www.oscommerce.com

  Copyright (c) 20042 osCommerce

  Vydáno pod GNU General Public License
*/

define('HEADING_TITLE', 'Snadná konfigurace naplnění');
define('EASY_VERSION_A', 'Easy Populate Advanced ');
define('EASY_DEFAULT_LANGUAGE', ' - Výchozí jazyk ');
define('EASY_UPLOAD_FILE', 'Soubor nahrán. ');
define('EASY_UPLOAD_TEMP', 'Dočasný název souboru: ');
define('EASY_UPLOAD_USER_FILE', 'Uživatelské jméno souboru: ');
define('EASY_SIZE', 'Velikost: ');
define('EASY_FILENAME', 'Název souboru: ');
define('EASY_SPLIT_DOWN', 'Své rozdělené soubory si můžete stáhnout v Nástroje/Soubory pod /temp/');
define('EASY_UPLOAD_EP_FILE', 'Nahrát soubor EP pro import');
define('EASY_SPLIT_EP_FILE', 'Nahrát a rozdělit soubor EP');
define('EASY_INSERT', 'Vložit do DB');
define('EASY_SPLIT', 'Nahrát a rozdělit soubor EP');
define('EASY_LIMIT', 'Export:');
define('EASY_LABEL_IMPORT', 'Import:');

define('TEXT_IMPORT_TEMP', 'Importovat data ze souboru v %s');
define('TEXT_INSERT_INTO_DB', 'Vložit do DB');
define('TEXT_SELECT_ONE', 'Vyberte soubor EP pro import');
define('TEXT_SPLIT_FILE', 'Vyberte soubor EP');
define('EASY_LABEL_CREATE', 'Export souboru');
define('EASY_LABEL_CREATE_SELECT', 'Vyberte metodu pro uložení exportovaného souboru');
define('EASY_LABEL_CREATE_SAVE', 'Uložit do dočasného souboru na serveru');
define('EASY_LABEL_SELECT_DOWN', 'Vyberte sadu polí ke stažení');
define('EASY_LABEL_SORT', 'Vyberte pole pro řazení');
define('EASY_LABEL_PRODUCT_RANGE', 'Omezení podle ID_produktů');
define('EASY_LABEL_LIMIT_CAT', 'Omezení podle kategorie');
define('EASY_LABEL_LIMIT_MAN', 'Omezení podle výrobce');

define('EASY_LABEL_PRODUCT_AVAIL', 'Dostupný rozsah: ');
define('EASY_LABEL_PRODUCT_FROM', ' from ');
define('EASY_LABEL_PRODUCT_TO', ' až ');
define('EASY_LABEL_PRODUCT_RECORDS', ' Celkový počet záznamů: ');
define('EASY_LABEL_PRODUCT_BEGIN', 'begin: ');
define('EASY_LABEL_PRODUCT_END', 'end: ');
define('EASY_LABEL_PRODUCT_START', 'Zahájit vytváření souboru ');

define('EASY_FILE_LOCATE', 'Svůj soubor můžete získat v Nástroje/Soubory pod ');
define('EASY_FILE_LOCATE_2', ' kliknutím na tento odkaz a přechodem do správce souborů');
define('EASY_FILE_RETURN', ' Do EP se můžete vrátit kliknutím na tento odkaz.');
define('EASY_IMPORT_TEMP_DIR', 'Import z Temp Dir ');
define('EASY_LABEL_DOWNLOAD', 'Stáhnout');
define('EASY_LABEL_COMPLETE', 'Dokončeno');
define('EASY_LABEL_TAB', 'soubor .txt oddělený tabulátory k úpravě');
define('EASY_LABEL_MPQ', 'Model/Cena/Množství');
define('EASY_LABEL_EP_MC', 'Model/kategorie');
define('EASY_LABEL_EP_FROGGLE', 'Froogle');
define('EASY_LABEL_EP_ATTRIB', 'Atributy');
define('EASY_LABEL_NONE', 'Žádný');
define('EASY_LABEL_CATEGORY', 'Název 1. kategorie');
define('PULL_DOWN_MANUFACTURES', 'Výrobci');
define('EASY_LABEL_PRODUCT', 'ID produktu');
define('EASY_LABEL_MANUFACTURE', 'Identifikační číslo výrobce');
define('EASY_LABEL_EP_FROGGLE_HEADER', 'Stáhnout soubor EP nebo Froogle');
define('EASY_LABEL_EP_MA', 'Model/Atributy');
define('EASY_LABEL_EP_FR_TITLE', 'Vytvořte soubory EP nebo Froogle v Temp Dir ');
define('EASY_LABEL_EP_DOWN_TAB', 'Vytvořit <b>Úplný</b> soubor .txt oddělený tabulátory v dočasném adresáři');
define('EASY_LABEL_EP_DOWN_MPQ', 'Vytvořit <b>Model/Cena/Množství</b> soubor .txt oddělený tabulátory v dočasném adresáři');
define('EASY_LABEL_EP_DOWN_MC', 'Vytvořte <b>Model/Kategorii</b> soubor .txt oddělený tabulátory v dočasném adresáři');
define('EASY_LABEL_EP_DOWN_MA', 'Vytvořte <b>Model/Atributy</b> soubor .txt oddělený tabulátory v dočasném adresáři');
define('EASY_LABEL_EP_DOWN_FROOGLE', 'Vytvořte <b>Froogle</b> soubor .txt oddělený tabulátory v dočasném adresáři');

define('EASY_LABEL_NEW_PRODUCT', '!Nový produkt!</font><br>');
define('EASY_LABEL_UPDATED', "<font color='black'> Aktualizováno</font><br>");
define('EASY_LABEL_DELETE_STATUS_1', "<barva písma='red'> !!Mazání produktu ");
define('EASY_LABEL_DELETE_STATUS_2', " z databáze !!</font><br>");
define('EASY_LABEL_LINE_COUNT_1', 'Přidáno ');
define('EASY_LABEL_LINE_COUNT_2', 'záznamy a uzavírání souboru... ');
define('EASY_LABEL_FILE_COUNT_1', 'Vytváření souboru EP_Split ');
define('EASY_LABEL_FILE_COUNT_2', '.txt ... ');
define('EASY_LABEL_FILE_CLOSE_1', 'Přidáno ');
define('EASY_LABEL_FILE_CLOSE_2', ' záznamy a uzavření souboru...');
//chybové zprávy
define('EASY_ERROR_1', 'Zvláštní, ale neexistuje žádný výchozí jazyk, který by fungoval... To se nemusí stát, jen pro případ... ');
define('EASY_ERROR_2', '... CHYBA! - Příliš mnoho znaků v čísle modelu.<br>
25 je maximum na standardní instalaci cre.<br>
Vaše maximální délka product_model je nastavena na ');
define('EASY_ERROR_2A', ' <br>Můžete buď zkrátit čísla modelů, nebo zvětšit velikost pole v databázi.</font>');
define('EASY_ERROR_2B', "<barva písma='red'>");
define('EASY_ERROR_3', '<p class=smallText>Žádné pole product_id v záznamu. Tento řádek nebyl importován <br><br>');
define('EASY_ERROR_4', '<font color=red>CHYBA - v_customer_group_id a v_customer_price se musí vyskytovat v párech</font>');
define('EASY_ERROR_5', '</b><font color=red>ERROR - Pokoušíte se použít soubor vytvořený pomocí EP Advanced, zkuste to prosím pomocí Easy Populate Advanced </font>');
define('EASY_ERROR_5a', '<font color=red><b><u> Kliknutím sem se vrátíte do Easy Populate Basic </u></b></font>');
define('EASY_ERROR_6', '</b><font color=red>ERROR - Pokoušíte se použít soubor vytvořený pomocí EP Basic, zkuste to prosím pomocí Easy Populate Basic </font>');
define('EASY_ERROR_6a', '<font color=red><b><u> Kliknutím sem se vrátíte do Easy Populate Advanced </u></b></font>');

define('EASY_R_NAME', 'jméno');
define('EASY_R_INFO', 'krátký popis');
define('EASY_R_DESC', 'popis');
define('EASY_R_CAT', 'kategorie');
define('EASY_R_MODEL', 'model');
define('EASY_R_IMAGES', 'obrázky');
define('EASY_R_MANUF', 'výrobce');
define('EASY_R_DISC', 'sleva');
define('EASY_R_PRICE', 'cena');
define('EASY_R_QTY', 'množství');
define('EASY_R_WEIGHT', '_váha_');
define('EASY_R_DATE', 'datum');
define('EASY_R_STATUS', 'stav');
define('EASY_R_STATUS_ACT', 'aktivní');
define('EASY_R_STATUS_NOACT', 'noaktivní');
define('EASY_R_STATUS_DELETE', 'smazat');
define('EASY_R_DOWNLOAD', 'Zde si můžete stáhnout svůj soubor');
define('EASY_R_NORMAL', 'Normální');
define('EASY_R_ADD', 'Přidat řádky');
define('EASY_R_REFRESH', 'Obnovit');
define('EASY_R_DEL', 'Smazat');
define('EASY_R_FULLFILE', 'Úplný soubor');
define('EASY_R_ID_PRICE', 'Model/Cena/Množství');
define('EASY_R_DOWN_NOW', 'Stáhnout nyní');
define('EASY_R_DOWN_CREATE', 'Vytvořit a stáhnout');
define('EASY_R_TMP_DIR', 'Vytvořit v dočasné složce');
define('EASY_R_ALL', 'Vše');
define('EASY_R_PRICEQTY', 'Cena/množství');
define('EASY_R_CATS', 'Kategorie');
define('EASY_R_ATTRS', 'Atributy');
define('EASY_R_FILE3', 'soubor');
define('EASY_R_SORT', 'Pořadí řazení');
define('EASY_R_FILTER', 'Filtrace');
define('EASY_LABEL_ALGORITHM', 'Algoritmus importu');
define('EASY_LABEL_DELIMITER', 'Oddělovač');
define('EASY_SELECT_FILE', 'Vyberte soubor');
define('EASY_EXPORT_DATA', 'Export dat');
define('EASY_LABEL_EXPORT_FULL_ATTR_INF', 'Stáhněte si úplné informace o atributech');
define('EASY_LABEL_IMPORT_FULL_ATTR_INF', 'Stáhněte si úplné informace o atributech');

?>