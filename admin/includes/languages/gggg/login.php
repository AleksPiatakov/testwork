<?php
/*
  $Id: login.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

  define('NAVBAR_TITLE', 'Вход');
  define('HEADING_TITLE', 'Добро пожаловать, введите свои данные');
  define('TEXT_STEP_BY_STEP', ''); // should be empty

define('HEADING_RETURNING_ADMIN', 'Вход:');
define('HEADING_PASSWORD_FORGOTTEN', 'Напоминание пароля:');
define('TEXT_RETURNING_ADMIN', 'Только для администраторов!');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail адрес:');
define('ENTRY_PASSWORD', 'Пароль:');
define('ENTRY_FIRSTNAME', 'Имя:');
define('IMAGE_BUTTON_LOGIN', 'Войти');

define('TEXT_PASSWORD_FORGOTTEN', 'Забыли пароль?');

define('TEXT_LOGIN_ERROR', '<font color="#ff0000"><b>ОШИБКА:</b></font> Неверный email адрес или(и) пароль!');
define('TEXT_LOGIN_ERROR_TRIED', '<font color="#ff0000"><b>ОШИБКА:</b></font> Превышено количество попыток - попробуйте позже');
define('TEXT_FORGOTTEN_ERROR', '<font color="#ff0000"><b>ОШИБКА:</b></font> Имя и email не совпадают!');
define('TEXT_FORGOTTEN_FAIL', 'Вы пытались войти более 3 раз. В целях безопасности, свяжитесь с администратором для получения пароля на вход.<br>&nbsp;<br>&nbsp;');
define('TEXT_FORGOTTEN_SUCCESS', 'Новый пароль был отправлен на Ваш email адрес. Проверьте почту и попробуйте войти ещё раз.<br>&nbsp;<br>&nbsp;');

define('ADMIN_EMAIL_SUBJECT', 'Ваш новый пароль!'); 
define('ADMIN_EMAIL_TEXT', 'Здравствуйте %s,' . "\n\n" . 'Вы можете войти в администраторскую со следующим паролем. После входа с данным паролем, мы рекомендуем изменить пароль на новый!' . "\n\n" . 'Сайт : %s' . "\n" . 'Email: %s' . "\n" . 'Пароль: %s' . "\n\n" . 'Спасибо!' . "\n" . '%s' . "\n\n" . 'Это письмо отправлено автоматически, не нужно на него отвечать!'); 
?>
