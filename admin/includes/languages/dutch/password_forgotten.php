<?php
/*
  $Id: password_forgotten.php,v 1.8 2003/06/09 22:46:46 hpdl Exp $

  osCommerce, open source e-commerce-oplossingen
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Vrijgegeven onder de GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Enter');
define('NAVBAR_TITLE_2', 'Wachtwoord herstel');

define('HEADING_TITLE', 'Ik ben mijn wachtwoord vergeten!');

define('TEXT_MAIN', 'Als u uw wachtwoord bent vergeten, vul dan uw e-mailadres in en wij sturen uw wachtwoord naar het door u opgegeven e-mailadres.');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', '<b>Fout:</b> E-mailadres komt niet overeen met uw account, probeer het opnieuw.');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' is uw wachtwoord');
define('EMAIL_PASSWORD_REMINDER_BODY', 'Er is een verzoek om een ​​nieuw wachtwoord ontvangen van ');
define('EMAIL_PASSWORD_REMINDER_BODY2', 'Uw nieuwe wachtwoord staat in \'' . STORE_NAME . '\':' . ' %s');
define('EMAIL_PASSWORD_REMINDER_SUBJECT2', STORE_NAME . ' - wachtwoord wijzigingsverzoek');
define('EMAIL_PASSWORD_REMINDER_BODY3', 'als je dit verzoek hebt gedaan, volg dan de onderstaande link en het accountwachtwoord zal worden bijgewerkt');

define('SUCCESS_PASSWORD_SENT', 'Klaar: uw nieuwe wachtwoord is naar u gemaild.');
define('SUCCESS_PASSWORD_TOKEN_SENT', 'Klaar: er is een wachtwoordherstellink naar uw e-mailadres gestuurd.');
define('EMAIL_TOKEN_ERROR', 'Token is niet meer geldig');