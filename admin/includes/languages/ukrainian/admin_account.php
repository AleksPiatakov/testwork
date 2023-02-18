<?php
/*
  $Id: admin_account.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Адміністратор');

define('TABLE_HEADING_ACCOUNT', 'Мої дані');

define('TEXT_INFO_FULLNAME', '<b>Ім\'я: </b>');
define('TEXT_INFO_FIRSTNAME', '<b>Ім\'я: </b>');
define('TEXT_INFO_LASTNAME', '<b>Прізвище: </b>');
define('TEXT_INFO_EMAIL', '<b>Email Адреса: </b>');
define('TEXT_INFO_PASSWORD', '<b>Пароль: </b>');
define('TEXT_INFO_PASSWORD_CONFIRM', '<b>Підтвердіть пароль: </b>');
define('TEXT_INFO_CREATED', '<b>Запис створена: </b>');
define('TEXT_INFO_LOGDATE', '<b>Останній вхід: </b>');
define('TEXT_INFO_LOGNUM', '<b>Кількість входів: </b>');
define('TEXT_INFO_GROUP', '<b>Група: </b>');
define('TEXT_INFO_ERROR', 'Даний Email адрес вже зареєстрований! Спробуйте ще раз.');
define('TEXT_INFO_MODIFIED', 'Останні зміни:');
define('TEXT_INFO_PASSWORD_HIDDEN', '**************');

define('TEXT_INFO_HEADING_DEFAULT', 'Змінити дані');
define('TEXT_INFO_HEADING_CONFIRM_PASSWORD', 'Введіть пароль');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD', 'Пароль:');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD_ERROR', '<b>ПОМИЛКА:</b> невірний пароль!');
define('TEXT_INFO_INTRO_DEFAULT', 'Натисніть кнопку <b>змінити</b> для редагування даних.');
define('TEXT_INFO_INTRO_DEFAULT_FIRST_TIME', '<br><b>УВАГА:</b><br>Доброго дня, <b>%s</b>, Ви зайшли сюди в перший раз. Ми рекомендуємо Вам змінити свій пароль!');
define('TEXT_INFO_INTRO_DEFAULT_FIRST', '<br><b>УВАГА:</b><br>Доброго дня, <b>%s</b>, ми рекомендуємо Вам змінити email адресу (admin@localhost) і пароль!');
define('TEXT_INFO_INTRO_EDIT_PROCESS', 'Все поля формы обязательны для заполнения. Нажмите кнопку "сохранить" для сохранения внесённых изменений.');

define('JS_ALERT_FIRSTNAME',        '- Вы не указали своё Имя. \n');
define('JS_ALERT_LASTNAME',         '- Вы не указали свою Фамилию. \n');
define('JS_ALERT_EMAIL',            '- Вы не указали свой Email адрес. \n');
define('JS_ALERT_PASSWORD',         '- Вы не указали свой Пароль. \n');
define('JS_ALERT_FIRSTNAME_LENGTH', '- Поле Ім\'я повинно містити як мінімум символів: ');
define('JS_ALERT_LASTNAME_LENGTH',  '- Поле Фамилия должно содержать как минимум символов: ');
define('JS_ALERT_PASSWORD_LENGTH',  '- Поле Пароль должно содержать как минимум символов: ');
define('JS_ALERT_EMAIL_FORMAT',     '- Вы неправильно написали Email адрес! \n');
define('JS_ALERT_EMAIL_USED',       '- Введённый Email адрес уже зарегистрирован! \n');
define('JS_ALERT_PASSWORD_CONFIRM', '- Ви не ввели пароль в поле Підтвердіть пароль! \n');

define('ADMIN_EMAIL_SUBJECT', 'Ваші дані змінені!');
define('ADMIN_EMAIL_TEXT', 'Здравствуйте, %s!' . "\n\n" . 'Ваша информация успешно изменена. Если Вы не изменяли свою информацию, обязательно свяжитесь с администратором, возможно, кто-то пытается получить доступ к Вашей информации!!' . "\n\n" . 'Сайт: %s' . "\n" . 'Email: %s' . "\n" . 'Пароль: %s' . "\n\n" . 'Спасибо!' . "\n" . '%s' . "\n\n" . 'Это письмо отправлено автоматически, не нужно на него отвечать!'); 

//Button
define('BUTTON_BACK_NEW', 'назад');
?>
