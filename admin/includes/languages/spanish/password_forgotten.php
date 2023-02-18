<?php
/*
  $Id: password_forgotten.php,v 1.8 2003/06/09 22:46:46 hpdl Exp $

  osCommerce, soluciones de comercio electrónico de código abierto
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Publicado bajo la Licencia Pública General GNU
*/

define('NAVBAR_TITLE_1', 'Entrar');
define('NAVBAR_TITLE_2', 'Recuperación de contraseña');

define('HEADING_TITLE', '¡Olvidé mi contraseña!');

define('TEXT_MAIN', 'Si ha olvidado su contraseña, ingrese su dirección de correo electrónico y le enviaremos su contraseña a la dirección de correo electrónico que proporcionó.');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', '<b>Error:</b> La dirección de correo electrónico no coincide con su cuenta, inténtelo de nuevo.');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' es su contraseña');
define('EMAIL_PASSWORD_REMINDER_BODY', 'Se recibió una solicitud de una nueva contraseña de ');
define('EMAIL_PASSWORD_REMINDER_BODY2', 'Tu nueva contraseña está en \'' . STORE_NAME . '\':' . ' %s');
define('EMAIL_PASSWORD_REMINDER_SUBJECT2', STORE_NAME . ' - solicitud de cambio de contraseña');
define('EMAIL_PASSWORD_REMINDER_BODY3', 'si realizó esta solicitud, siga el enlace a continuación y la contraseña de la cuenta se actualizará');

define('SUCCESS_PASSWORD_SENT', 'Listo: Se le ha enviado su nueva contraseña por correo electrónico.');
define('SUCCESS_PASSWORD_TOKEN_SENT', 'Listo: Se ha enviado un enlace de restablecimiento de contraseña a su dirección de correo electrónico.');
define('EMAIL_TOKEN_ERROR', 'El token ya no es válido');