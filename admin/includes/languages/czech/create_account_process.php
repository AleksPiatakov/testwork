<?php
/*
  $Id: create_account_process.php,v 1.1 2003/09/24 14:33:18 vadne Exp $

  osCommerce, Open Source řešení elektronického obchodu
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Vydáno pod GNU General Public License
*/
define('NAVBAR_TITLE', 'Vytvořit účet');
define('HEADING_TITLE', 'Informace o účtu');
define('HEADING_NEW', 'Proces objednávky');
define('NAVBAR_NEW_TITLE', 'Proces objednávky');

define('EMAIL_SUBJECT', 'Vítejte v ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Vážený pane ' . stripslashes($_POST['lastname']) . ',' . "\n\n");
define('EMAIL_GREET_MS', 'Vážená paní ' . stripslashes($_POST['lastname']) . ',' . "\n\n");
define('EMAIL_GREET_NONE', 'Vážený ' . stripslashes($_POST['firstname']) . ',' . "\n\n");
define('EMAIL_WELCOME', 'Vítáme vás v <b>' . STORE_NAME . '</b>.' . "\n\n");
define('EMAIL_TEXT', 'Nyní se můžete zúčastnit <b>různých služeb</b>, které vám nabízíme. Některé z těchto služeb zahrnují:' . "\n\n" . '<li><b >Trvalý košík</b> – Všechny produkty přidané do vašeho online košíku tam zůstanou, dokud je neodstraníte nebo nezkontrolujete.' . "\n" . '<li><b>Adresář</b> – Můžeme nyní doručujte své produkty na jinou adresu, než je vaše! To je ideální pro posílání narozeninových dárků přímo samotným oslavencům.' . "\n" . '<li><b>Historie objednávek</b> – Zobrazení historie nákupů, které jste u nás provedli.' . "\n" . '<li><b>Recenze produktů</b> – Podělte se o své názory na produkty s našimi ostatními zákazníky.' . "\n\n");
define('EMAIL_CONTACT', 'Pro pomoc s některou z našich online služeb prosím zašlete e-mail vlastníkovi obchodu: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<b>Poznámka:</b> Tuto e-mailovou adresu nám poskytl jeden z našich zákazníků. Pokud jste se nezaregistrovali jako člen, pošlete e-mail na adresu ' . STORE_OWNER_EMAIL_ADDRESS . '. ' . "\n");

  define('EMAIL_PASS_1', 'Vaše heslo ');
  define('EMAIL_PASS_2', ", nezapomeňte!" . "\n\n");
?>