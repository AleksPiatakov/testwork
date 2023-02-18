<?php
/*
  $Id$
  Recover Cart Sales v 1.4 ENGLISH Language File

  Příspěvek z prodeje košíku: JM Ivler (c)
  osCommerce, Open Source řešení elektronického obchodu
  http://www.oscommerce.com

  Vydáno pod GNU General Public License

*/

define('MESSAGE_STACK_CUSTOMER_ID', 'Košík pro ID zákazníka ');
define('MESSAGE_STACK_DELETE_SUCCESS', ' úspěšně smazáno');
define('HEADING_TITLE', 'Obnovení prodeje košíku');
define('HEADING_EMAIL_SENT', 'E-mail odeslaná zpráva');
define('EMAIL_SEPARATOR', '------------------------------------------- -----------');
define('EMAIL_TEXT_SUBJECT', 'Dotaz od '. STORE_NAME );
define('EMAIL_TEXT_SALUTATION', 'Vážený ' );
define('EMAIL_TEXT_NEWCUST_INTRO', "\n\n" . 'Děkujeme, že jste se zastavili u ' . STORE_NAME .
    ' a zvažuje nás pro váš nákup. ');
define('EMAIL_TEXT_CURCUST_INTRO', "\n\n" . 'Rádi bychom vám poděkovali za nákup na ' .
    STORE_NAME . ' v minulosti. ');
define('EMAIL_TEXT_COMMON_BODY', 'Všimli jsme si, že při návštěvě našeho obchodu jste umístili ' .
                                 'následující položky ve vašem nákupním košíku, ale nebyly dokončeny' .
                                 'transakce.' . "\n\n" .
                                 'Obsah nákupního košíku:' .
                                 "\n\n" . '%s' . "\n\n" .
                                 "Vždy nás zajímá, co se stalo." .
"a pokud existuje důvod, proč jste se rozhodli nenakupovat u" .
'tentokrát. Kdybys mohl být tak laskav a dovolil nám '.
"Pokud byste měli nějaké problémy nebo obavy, ocenili bychom to. " .
"Žádáme o zpětnou vazbu od vás a ostatních, jak můžeme." .
'pomozte vytvořit svůj zážitek na '. STORE_NAME . 'lepší.'."\n\n".
'POZOR:'."\n".'Pokud se domníváte, že jste dokončili nákup a jste ' .
'zajímalo by mě, proč nebyl doručen, tento e-mail znamená, že ' .
'Vaše objednávka NEBYLA dokončena a že vám NEBYLA účtována platba! ' .
'Prosím, vraťte se do obchodu, abyste dokončili svou objednávku.'."\n\n".
'Omlouváme se, pokud jste již dokončili nákup, ' .
'v těchto případech se snažíme tyto zprávy neposílat, ale někdy je to tak' .
'těžko říct v závislosti na individuálních okolnostech.'."\n\n".
'Ještě jednou děkuji za váš čas a pozornost při pomoci nám'.
'zlepšit ' . STORE_NAME . ".\n\nS pozdravem\n\n" .
    STORE_NAME . "\n". HTTP_SERVER . DIR_WS_CATALOG . "\n");
define('DAYS_FIELD_PREFIX', 'Zobrazit naposledy ');
define('DAYS_FIELD_POSTFIX', ' dny ');
define('DAYS_FIELD_BUTTON', 'Go');
define('TABLE_HEADING_DATE', 'DATE');
define('TABLE_HEADING_CONTACT', 'CONTACTED');
define('TABLE_HEADING_CUSTOMER', 'JMÉNO ZÁKAZNÍKA');
define('TABLE_HEADING_EMAIL', 'E-MAIL');
define('TABLE_HEADING_PHONE', 'PHONE');
define('TABLE_HEADING_MODEL', 'ITEM');
define('TABLE_HEADING_DESCRIPTION', 'DESCRIPTION');
define('TABLE_HEADING_QUANTY', 'QTY');
define('TABLE_HEADING_PRICE', 'PRICE');
define('TABLE_HEADING_TOTAL', 'TOTAL');
define('TABLE_GRAND_TOTAL', 'Celkový součet: ');
define('TABLE_CART_TOTAL', 'Celkem košíku: ');
define('TEXT_CURRENT_CUSTOMER', 'CUSTOMER');
define('TEXT_SEND_EMAIL', 'Odeslat e-mail');
define('TEXT_RETURN', '[Klikněte sem pro návrat]');
define('TEXT_NOT_CONTACTED', 'Nekontaktován');
define('PSMSG', 'Další zpráva PS: ');
?>