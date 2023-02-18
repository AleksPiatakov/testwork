<?php
/*
  $Id: password_forgotten.php,v 1.8 2003/06/09 22:46:46 hpdl Exp $

  osCommerce, nyílt forráskódú e-kereskedelmi megoldások
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  A GNU General Public License alatt jelent meg
*/

define('NAVBAR_TITLE_1', 'Enter');
define('NAVBAR_TITLE_2', 'Jelszó helyreállítás');

define('HEADING_TITLE', 'Elfelejtettem a jelszavamat!');

define('TEXT_MAIN', 'Ha elfelejtette jelszavát, kérjük adja meg e-mail címét, és elküldjük jelszavát a megadott e-mail címre.');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', '<b>Hiba:</b> Az e-mail cím nem egyezik a fiókjával, próbálkozzon újra.');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' az Ön jelszava');
define('EMAIL_PASSWORD_REMINDER_BODY', 'Új jelszó kérése érkezett tőle:');
define('EMAIL_PASSWORD_REMINDER_BODY2', 'Az új jelszava itt található: \' . STORE_NAME . \':' . ' %s');
define('EMAIL_PASSWORD_REMINDER_SUBJECT2', STORE_NAME . ' - jelszómódosítási kérés');
define('EMAIL_PASSWORD_REMINDER_BODY3', 'ha Ön küldte ezt a kérést, akkor kövesse az alábbi linket, és a fiók jelszava frissül');

define('SUCCESS_PASSWORD_SENT', 'Kész: Az új jelszavát e-mailben elküldtük.');
define('SUCCESS_PASSWORD_TOKEN_SENT', 'Kész: Jelszó-visszaállítási linket küldtünk az e-mail címedre.');
define('EMAIL_TOKEN_ERROR', 'A token már nem érvényes');