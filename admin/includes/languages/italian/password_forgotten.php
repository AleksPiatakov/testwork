<?php
/*
  $ID: password_forgotten.php,v 1.8 2003/06/09 22:46:46 hpdl Exp $

  osCommerce, soluzioni di e-commerce open source
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Rilasciato sotto la GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Invio');
define('NAVBAR_TITLE_2', 'Recupero password');

define('HEADING_TITLE', 'Ho dimenticato la mia password!');

define('TEXT_MAIN', 'Se hai dimenticato la tua password, inserisci il tuo indirizzo email e ti invieremo la password all\'indirizzo email che hai fornito.');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', '<b>Errore:</b> l\'indirizzo e-mail non corrisponde al tuo account, per favore riprova.');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . 'è la tua password');
define('EMAIL_PASSWORD_REMINDER_BODY', 'Una richiesta per una nuova password è stata ricevuta da ');
define('EMAIL_PASSWORD_REMINDER_BODY2', 'La tua nuova password è in \'' . STORE_NAME . '\':' . ' %s');
define('EMAIL_PASSWORD_REMINDER_SUBJECT2', STORE_NAME . ' - richiesta di cambio password');
define('EMAIL_PASSWORD_REMINDER_BODY3', 'se hai fatto questa richiesta, segui il link qui sotto e la password dell\'account verrà aggiornata');

define('SUCCESS_PASSWORD_SENT', 'Fatto: la tua nuova password ti è stata inviata via email.');
define('SUCCESS_PASSWORD_TOKEN_SENT', 'Fatto: un link per la reimpostazione della password è stato inviato al tuo indirizzo email.');
define('EMAIL_TOKEN_ERROR', 'Il token non è più valido');