<?php
/*
  $Id: login.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

  define('NAVBAR_TITLE', 'Вхід');
  define('HEADING_TITLE', 'Ласкаво просимо, введіть свої дані');
  define('TEXT_STEP_BY_STEP', ''); // should be empty

define('HEADING_RETURNING_ADMIN', 'Вхід:');
define('HEADING_PASSWORD_FORGOTTEN', 'Нагадування пароля:');
define('TEXT_RETURNING_ADMIN', 'Тільки для адміністраторів!');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail адреса:');
define('ENTRY_PASSWORD', 'Пароль:');
define('ENTRY_FIRSTNAME', 'Ім\'я:');
define('IMAGE_BUTTON_LOGIN', 'Увійти');

define('TEXT_PASSWORD_FORGOTTEN', 'Забули пароль?');

define('TEXT_LOGIN_ERROR', '<font color="#ff0000"><b>ОШИБКА:</b></font> Неверный email адрес или(и) пароль!');
define('TEXT_LOGIN_ERROR_TRIED', '<font color="#ff0000"><b>ПОМИЛКА:</b></font> Перевищено кількість спроб - спробуйте через 5  хвилин');
define('TEXT_FORGOTTEN_ERROR', '<font color="#ff0000"><b>ОШИБКА:</b></font> Имя и email не совпадают!');
define('TEXT_FORGOTTEN_FAIL', 'Ви намагалися увійти більше 3 разів. З метою безпеки, зв\'яжіться з адміністратором для отримання пароля на вхід.<br>&nbsp;<br>&nbsp;');
define('TEXT_FORGOTTEN_SUCCESS', 'Новий пароль був відправлений на Ваш email адрес. Перевірте пошту та повторити вашу спробу ще раз.<br>&nbsp;<br>&nbsp;');

define('ADMIN_EMAIL_SUBJECT', 'Ваш новий пароль!'); 
define('ADMIN_EMAIL_TEXT', 'Здравствуйте %s,' . "\n\n" . 'Вы можете войти в администраторскую со следующим паролем. После входа с данным паролем, мы рекомендуем изменить пароль на новый!' . "\n\n" . 'Сайт : %s' . "\n" . 'Email: %s' . "\n" . 'Пароль: %s' . "\n\n" . 'Спасибо!' . "\n" . '%s' . "\n\n" . 'Это письмо отправлено автоматически, не нужно на него отвечать!'); 
?>
