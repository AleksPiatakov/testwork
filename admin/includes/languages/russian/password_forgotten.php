<?php
/*
  $Id: password_forgotten.php,v 1.8 2003/06/09 22:46:46 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Вход');
define('NAVBAR_TITLE_2', 'Восстановление пароля');

define('HEADING_TITLE', 'Я забыл свой пароль!');

define('TEXT_MAIN', 'Если Вы забыли свой пароль, введите свой e-mail адрес и мы вышлем Ваш парoль на e-mail, который Вы указали.');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', '<b>Ошибка:</b> E-Mail адрес не соответствует Вашей учетной записи, попробуйте ещё раз.');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - Ваш пароль');
define('EMAIL_PASSWORD_REMINDER_BODY', 'Запрос на получение нового пароля был получен от ');
define('EMAIL_PASSWORD_REMINDER_BODY2', 'Ваш новый пароль в \'' . STORE_NAME . '\':' .  '   %s');
define('EMAIL_PASSWORD_REMINDER_SUBJECT2', STORE_NAME . ' - запрос на смену пароля');
define('EMAIL_PASSWORD_REMINDER_BODY3', ' Если этот запрос сделали Вы, то перейдите по ссылке ниже и пароль от акаунта обновится');

define('SUCCESS_PASSWORD_SENT', 'Выполнено: Ваш новый пароль отправлен Вам по e-mail.');
define('SUCCESS_PASSWORD_TOKEN_SENT', 'Выполнено: На ваш адрес электронной почты была отправлена ссылка для сброса пароля.');
define('EMAIL_TOKEN_ERROR', 'Токен больше не действителен');