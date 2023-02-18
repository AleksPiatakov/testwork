<?php
/*
  $Id: admin_members.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

if ($_GET['gID']) {
  define('HEADING_TITLE', 'Групи');
} elseif ($_GET['gPath']) {
  define('HEADING_TITLE', 'Налаштування групи');
}elseif(!empty($_GET['info']) && $_GET['info'] == 'admin_groups'){
	define('HEADING_TITLE', 'Групи адміністраторів');
}elseif(!empty($_GET['info']) && $_GET['info'] == 'admin_files'){
	define('HEADING_TITLE', 'Права доступу');
}else{
	define('HEADING_TITLE', 'Адміністратори');
}
define('ADMIN_LIST', 'Лист адміністраторів');



define('TEXT_COUNT_GROUPS', 'Групи: ');
define('TABLE_HEADING_NAME', 'Ім\'я');
define('TABLE_HEADING_EMAIL', 'Email Адреса');
define('TABLE_HEADING_PASSWORD', 'Пароль');
define('TABLE_HEADING_CONFIRM', 'Підтвердити пароль');
define('TABLE_HEADING_GROUPS', 'Група');
define('TABLE_HEADING_CREATED', 'Дата створення');
define('TABLE_HEADING_MODIFIED', 'Останні зміни');
define('TABLE_HEADING_LOGDATE', 'Останній вхід');
define('TABLE_HEADING_LOGNUM', 'Кількість входів');
define('TABLE_HEADING_LOG_NUM', 'Кількість входів');
define('TABLE_HEADING_ACTION', 'Дія');
define('TABLE_HEADING_PAGES_REDIRECT', 'Сторінка перенаправлень адміністратора');

define('TABLE_HEADING_GROUPS_NAME', 'Назва групи');
define('TABLE_HEADING_GROUPS_DEFINE', 'Бокси і файли, доступні для даної групи');
define('TABLE_HEADING_GROUPS_GROUP', 'Група');
define('TABLE_HEADING_GROUPS_CATEGORIES', 'Доступні файли і бокси');


define('TEXT_INFO_HEADING_DEFAULT', 'Адміністратор');
define('TEXT_INFO_HEADING_DELETE', 'Видалити доступ');
define('TEXT_INFO_HEADING_EDIT', 'Змінити групу /');
define('TEXT_INFO_HEADING_NEW', 'Новий адміністратор');
define('TEXT_ADMIN_LIST', 'Список адміністраторів');
define('TEXT_ADMIN_GROUPS', 'Групи адміністраторів');
define('TEXT_ADMIN_ACCESS', 'Права доступу');

define('TEXT_INFO_DEFAULT_INTRO', 'Група');
define('TEXT_INFO_DELETE_INTRO', 'Ви дійсно хочете видалити <nobr><b>%s</b></nobr> з <nobr>Адміністраторів?</nobr>');
define('TEXT_INFO_DELETE_INTRO_NOT', 'Ви не можете видалити групу <nobr>%s!</nobr>');
define('TEXT_INFO_EDIT_INTRO', 'Права доступу до боксів і файлів:');

define('TEXT_INFO_FULLNAME', 'Ім\'я: ');
define('TEXT_INFO_FIRSTNAME', 'Ім\'я: ');
define('TEXT_INFO_LASTNAME', 'Прізвище:');
define('TEXT_INFO_EMAIL', 'Email Адреса:');
define('TEXT_INFO_PASSWORD', 'Пароль ');
define('TEXT_INFO_CONFIRM', 'Підтвердіть пароль');
define('TEXT_INFO_CHANGE_PASSWORD', 'Змінити свій пароль');
define('TEXT_ERROR_NOT_MATCH_PASS', 'Паролі не співпадають');
define('TEXT_ERROR_EMPTY_PASS', 'Пароль порожній');
define('TEXT_ERROR_CNT_ADMIN', 'Ви не можете видалити останнього адміністратора');
define('TEXT_INFO_CREATED', 'Запис створена:');
define('TEXT_INFO_MODIFIED', 'Останні зміни:');
define('TEXT_INFO_LOGDATE', 'Останній вхід:');
define('TEXT_INFO_LOGNUM', 'Кількість входів:');
define('TEXT_INFO_GROUP', 'Група: ');
define('TEXT_INFO_ERROR', 'Введений Email вже зареєстрований! Спробуйте вказати іншу адресу.');

define('JS_ALERT_FIRSTNAME',        '- Вы не указали своё Имя. \n');
define('JS_ALERT_LASTNAME',         '- Вы не указали свою Фамилию. \n');
define('JS_ALERT_EMAIL',            '- Вы не указали свой Email адрес. \n');
define('JS_ALERT_EMAIL_FORMAT',     '- Вы неправильно написали Email адрес! \n');
define('JS_ALERT_EMAIL_USED',       '- Введённый Email адрес уже зарегистрирован! \n');
define('JS_ALERT_LEVEL', '- Вы не указали группу \n');

define('ADMIN_EMAIL_SUBJECT', 'Новий адміністратор');
define('ADMIN_EMAIL_TEXT', 'Здравствуйте, %s!' . "\n\n" . 'Вы можете заходить в админку со следущим паролем. После того как Вы зайдёте в админку, мы настоятельно Вам рекомендуем изменить свой пароль!' . "\n\n" . 'Сайт: %s' . "\n" . 'Email: %s' . "\n" . 'Пароль: %s' . "\n\n" . 'Спасибо!' . "\n" . '%s' . "\n\n" . 'Это письмо отправлено автоматически, не нужно на него отвечать!');
define('ADMIN_EMAIL_SUBJECT_PASS_NEW', 'Новий пароль');
define('ADMIN_EMAIL_TEXT_CHANGE_PASS', 'Здравствуйте, %s!' . "\n\n" . 'Вы можете заходить в админку со следущим паролем. ' . "\n\n" . 'Сайт: %s' . "\n" . 'Email: %s' . "\n" . 'Пароль: %s' . "\n\n" . 'Спасибо!' . "\n" . '%s' . "\n\n" . 'Это письмо отправлено автоматически, не нужно на него отвечать!');
define('ADMIN_EMAIL_EDIT_SUBJECT', 'Ваша інформація змінена адміністратором');
define('ADMIN_EMAIL_EDIT_TEXT', 'Здравствуйте, %s!' . "\n\n" . 'Ваша информация изменена администратором.' . "\n\n" . 'Сайт: %s' . "\n" . 'Email: %s' . "\n" . 'Пароль: %s' . "\n\n" . 'Спасибо!' . "\n" . '%s' . "\n\n" . 'Это письмо отправлено автоматически, не нужно на него отвечать!'); 

define('TEXT_INFO_HEADING_DEFAULT_GROUPS', 'Група ');
define('TEXT_INFO_HEADING_DELETE_GROUPS', 'Видалити групу');

define('TEXT_INFO_DEFAULT_GROUPS_INTRO', '<b>УВАГА:</b><li><b>змінити:</b> зміна назви групи.</li><li><b>видалити:</b> видалення групи.</li><li><b>доступ до файлів:</b> налаштування доступу до боксів і файлів.</li>');
define('TEXT_INFO_DELETE_GROUPS_INTRO', 'Видаляючи дану групу, Ви також видаляєте всіх адміністраторів, які перебувають в цій групі. Ви дійсно хочете видалити групу <nobr><b>%s</b>?</nobr>');
define('TEXT_INFO_DELETE_GROUPS_INTRO_NOT', 'Ви не можете видалити цю групу!');
define('TEXT_INFO_GROUPS_INTRO', 'Дайте назву новій групі, потім натисніть кнопку "далі".');

define('TEXT_INFO_HEADING_GROUPS', 'Нова група');
define('TEXT_INFO_GROUPS_NAME', ' <b>Назва групи:</b><br>Введіть назву нової групи, потім натисніть кнопку "Далі".<br>');
define('TEXT_INFO_GROUPS_NAME_FALSE', '<b>ПОМИЛКА:</b> Назва групи повинно складатися мінімум з 2 символів!');
define('TEXT_INFO_GROUPS_NAME_USED', '<b>ПОМИЛКА:</b> Введене назва групи вже є, спробуйте назвати групу по-іншому!');
define('TEXT_INFO_GROUPS_LEVEL', 'Група: ');
define('TEXT_INFO_GROUPS_BOXES', '<b>Права доступу до боксів:</b><br>Розмежування доступу до боксів.');
define('TEXT_INFO_GROUPS_BOXES_INCLUDE', 'Додати файл в бокс:');

define('TEXT_INFO_HEADING_EDIT_GROUP', 'Змінити назву групи');
define('TEXT_INFO_EDIT_GROUP_INTRO', 'Ви можете змінити назву даної групи на нове, вкажіть нову назву і натисніть кнопку <b>зберегти</b>');

define("stats_products_purchased.php", "Замовлені товари");
define("stats_customers_orders.php", "Замовлення клієнтів");
define("template_configuration.php", "Конфігурація шаблону");
define("easypopulate_functions.php", ".. EASYPOPULATE_FUNCTIONS ..");
define("create_account_process.php", "Процес створення аккаунта");
define("create_account_success.php", "Сторінка успішної регісстраціі");
define("stats_customers_entry.php", "Входи клієнтів");
define("stats_products_viewed.php", "Переглядаємі товари");
define("languages_translater.php", "Переклад мов");
define("create_order_process.php", "Процес створення замовлення");
define("stats_sales_report2.php", "Статистика продажів (2)");
define("total_configuration.php", "Редактор налаштувань");
define("stats_monthly_sales.php", "Щомісячні продажу");
define("extra_product_price.php", "Додаткова ціна продукту");
define("products_attributes.php", "Атрибути товарів");
define("stats_last_modified.php", "Останні зміни");
define("stats_sales_report.php", "Звіт по статистиці продажів");
define("attributeManager.php", "Менеджер атрибутів");
define("mysqlperformance.php", "Лог повільних запитів");
define("customers_groups.php", "Групи клієнтів");
define("validcategories.php", "Дійсні категорії");
define("stats_customers.php", "Статистика клієнтів");
define("design_controls.php", "Елементи управління дизайном");
define("stats_opened_by.php", "Статистика за новими акаунтів");
define("create_account.php", "Створити обліковий запис");
define("listcategories.php", "Список категорій");
define("stats_keywords.php", "Пошукові запити");
define("image_explorer.php", "Менеджер файлів");
define("xsell_products.php", "Супутні продукти");
define("products_multi.php", "Управління товарами");
define("manufacturers.php", "Виробники");
define("stats_zeroqty.php", "Продукти яких немає на складі");
define("configuration.php", "Концігурація");

define("stats_nophoto.php", "Товари без фото");
define("quick_updates.php", "Оновлення прайса");
define("validproducts.php", "Список товарів");
define("configuration.php", "Мій магазин");
define("admin_members.php", "Управління адміністраторами");
define("orders_status.php", "Статус замовлень");
define("email_content.php", "Шаблони листів");
define("administrator.php", "Адміністратори");
define("coupon_admin.php", "Промо-коди");
define("listproducts.php", "Список товарів");
define("easypopulate.php", "Exсel Імпорт / Експорт");
define("manudiscount.php", "Знижки виробників");
define("localization.php", "Локалізація");
define("edit_orders.php", "Редагувати замовлення");
define("newsletters.php", "Менеджер поштових розсилок");
define("tax_classes.php", "Список податків");
define("admin_files.php", "Меню адміністраторських боксів");
define("whos_online.php", "Люди онлайн");
define("currencies.php", "Валюти");
define("ajax_xsell.php", "AJAX Супутні товари");
define("chart_data.php", ".. CHART_DATA ..");
define("categories.php", "Список товарів");
define("tax_rates.php", "Ставки податків");
define("salemaker.php", "Масові знижки");
define("languages.php", "Мови");
define("pollbooth.php", ".. POLLBOTH ..");
define("customers.php", "Список клієнтів");
define("countries.php", "Країни");
define("geo_zones.php", "Географічні зони");
define("customers.php", "Клієнти");
define("articles.php", "Статті");
define("products.php", "Редактор продукту");
define("featured.php", "Рекомендовані товари");
define("gv_admin.php", ".. GV_ADMIN ..");
define("specials.php", "Знижки");
define("gv_queue.php", "Активація сертифікатів");
define("ship2pay.php", "Доставка-Оплата (Ship 2 Pay)");
define("reviews.php", "Коментарі");
define("articles.php", "Сторінки");
define("modules.php", "Модулі");
define("reports.php", "Звіти");
define("catalog.php", "Каталог");
define("gv_mail.php", "Відправити сертифікат");
define("gv_sent.php", "Відправлені сертифікати");
define("modules.php", "Модулі");
define("backup.php", "Створення резервної копії");
define("orders.php", "Список замовлень");
define("taxes.php", "Податки");
define("cache.php", "Кеш");
define("tools.php", "Інструменти");
define("polls.php", "Опитування");
define("polls.php", "Голосування");
define("zones.php", "Список регіонів");
define("mail.php", "Відправити Email");

define('FILENAME_DEFAULT_TEXT', 'Головна Сторінка');
define('FILENAME_CATEGORIES_TEXT', 'Сторінка Категорій');

define('TEXT_INFO_HEADING_DEFINE', 'Налаштування групи');
if ($_GET['gPath'] == 1) {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br>Ви не можете змінювати доступ до боксів і файлів для цієї групи.<br><br>');
} else {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br>Ви можете встановити або зняти доступ до боксів і файлів для даної групи. Натисніть внизу кнопку  <b>зберегти</b> для збереження внесених змін.<br><br>');
}
?>
