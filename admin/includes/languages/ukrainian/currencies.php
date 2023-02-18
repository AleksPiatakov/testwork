<?php
/*
  $Id: currencies.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Валюти');

define('TABLE_HEADING_CURRENCY_NAME', 'Валюта');
define('TABLE_HEADING_CURRENCY_CODES', 'Код');
define('TABLE_HEADING_CURRENCY_VALUE', 'Величина');
define('TABLE_HEADING_ACTION', 'Дія');

define('TEXT_INFO_EDIT_INTRO', 'Будь ласка, внесіть необхідні зміни');
define('TEXT_INFO_CURRENCY_TITLE', 'Назва:');
define('TEXT_INFO_CURRENCY_CODE', 'Код:');
define('TEXT_INFO_CURRENCY_SYMBOL_LEFT', 'Символ ліворуч:');
define('TEXT_INFO_CURRENCY_SYMBOL_RIGHT', 'Символ праворуч:');
define('TEXT_INFO_CURRENCY_DECIMAL_POINT', 'Десятковий знак:');
define('TEXT_INFO_CURRENCY_THOUSANDS_POINT', 'Роздільник тисяч:');
define('TEXT_INFO_CURRENCY_DECIMAL_PLACES', 'Десяткові порядки:');
define('TEXT_INFO_CURRENCY_LAST_UPDATED', 'Останній раз скориговано:');
define('TEXT_INFO_CURRENCY_VALUE', 'Величина:');
define('TEXT_INFO_CURRENCY_EXAMPLE', 'Приклад:');
define('TEXT_INFO_INSERT_INTRO', 'Будь ласка, введіть дані для нової валюти');
define('TEXT_INFO_DELETE_INTRO', 'Ви дійсно хочете видалити цю валюту?');
define('TEXT_INFO_HEADING_NEW_CURRENCY', 'Нова Валюта');
define('TEXT_INFO_HEADING_EDIT_CURRENCY', 'Змінити Валюту');
define('TEXT_INFO_HEADING_DELETE_CURRENCY', 'Видалити Валюту');
define('TEXT_INFO_SET_AS_DEFAULT', TEXT_SET_DEFAULT . ' (эту валюту нужно корректировать вручную)');
define('TEXT_INFO_CURRENCY_UPDATED', 'Обмінний курс для %s (%s) успішно змінено за допомогою %s.');

define('ERROR_REMOVE_DEFAULT_CURRENCY', 'Помилка: Валюта, встановлена за замовчуванням не може бути видалена. Визначте іншу валюту за замовчуванням і спробуйте знову.');
define('ERROR_CURRENCY_INVALID', 'Помилка: Обмінний курс для %s (%s) ні оновлено за допомогою %s. Ви правильно вказали код валюти? Щоб оновити обмінний курс, Ви повинні бути підключені до інтернету.');
define('WARNING_PRIMARY_SERVER_FAILED', 'Попередження: Не вдалося підключитися до сервера (%s) і оновити обмінний курс для %s (%s) - спробуйте підключитися до іншого сервера. Щоб оновити обмінний курс, Ви повинні бути підключені до інтернету.');
?>
