<?php
/*
  $Id : password_forgotten.php,v 1.8 2003/06/09 22:46:46 hpdl Exp $

  osCommerce, solutions de commerce électronique open source
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Publié sous la licence publique générale GNU
*/

définir('NAVBAR_TITLE_1', 'Entrée');
define('NAVBAR_TITLE_2', 'Récupération du mot de passe');

define('HEADING_TITLE', 'J\'ai oublié mon mot de passe !');

define('TEXT_MAIN', 'Si vous avez oublié votre mot de passe, veuillez entrer votre adresse e-mail et nous vous enverrons votre mot de passe à l\'adresse e-mail que vous avez fournie.');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', '<b>Erreur :</b> l\'adresse e-mail ne correspond pas à votre compte, veuillez réessayer.');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' est votre mot de passe');
define('EMAIL_PASSWORD_REMINDER_BODY', 'Une demande de nouveau mot de passe a été reçue de ');
define('EMAIL_PASSWORD_REMINDER_BODY2', 'Votre nouveau mot de passe est dans \'' . STORE_NAME . '\':' . ' %s');
define('EMAIL_PASSWORD_REMINDER_SUBJECT2', STORE_NAME . ' - demande de changement de mot de passe');
define('EMAIL_PASSWORD_REMINDER_BODY3', 'si vous avez fait cette demande, suivez le lien ci-dessous et le mot de passe du compte sera mis à jour');

define('SUCCESS_PASSWORD_SENT', 'Terminé : votre nouveau mot de passe vous a été envoyé par e-mail.');
define('SUCCESS_PASSWORD_TOKEN_SENT', 'Terminé : un lien de réinitialisation de mot de passe a été envoyé à votre adresse e-mail.');
define('EMAIL_TOKEN_ERROR', 'Le jeton n\'est plus valide');