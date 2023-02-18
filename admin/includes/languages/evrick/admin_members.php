<?php
/*
  $Id: admin_members.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

if($_GET['gID']){
	define('HEADING_TITLE', 'Группы');
}elseif($_GET['gPath']){
	define('HEADING_TITLE', 'Настройка группы');
}elseif(!empty($_GET['info']) && $_GET['info'] == 'admin_groups'){
	define('HEADING_TITLE', 'Группы администраторов');
}elseif(!empty($_GET['info']) && $_GET['info'] == 'admin_files'){
	define('HEADING_TITLE', 'Права доступа');
}else{
	define('HEADING_TITLE', 'Администраторы');
}
define('ADMIN_LIST', 'Список администраторов');


define('TEXT_COUNT_GROUPS', 'Группы: ');
define('TABLE_HEADING_NAME', 'Имя');
define('TABLE_HEADING_EMAIL', 'Email Адрес');
define('TABLE_HEADING_PASSWORD', 'Пароль');
define('TABLE_HEADING_CONFIRM', 'Подтвердить пароль');
define('TABLE_HEADING_GROUPS', 'Группа');
define('TABLE_HEADING_CREATED', 'Дата создания');
define('TABLE_HEADING_MODIFIED', 'Последние изменения');
define('TABLE_HEADING_LOGDATE', 'Последний вход');
define('TABLE_HEADING_LOGNUM', 'Количество входов');
define('TABLE_HEADING_LOG_NUM', 'Количество входов');
define('TABLE_HEADING_ACTION', 'Действие');
define('TABLE_HEADING_PAGES_REDIRECT', 'Страница перенаправлений администратора');

define('TABLE_HEADING_GROUPS_NAME', 'Название группы');
define('TABLE_HEADING_GROUPS_DEFINE', 'Боксы и файлы, доступные для данной группы');
define('TABLE_HEADING_GROUPS_GROUP', 'Группа');
define('TABLE_HEADING_GROUPS_CATEGORIES', 'Доступные файлы и боксы');


define('TEXT_INFO_HEADING_DEFAULT', 'Администратор ');
define('TEXT_INFO_HEADING_DELETE', 'Удалить доступ ');
define('TEXT_INFO_HEADING_EDIT', 'Изменить группу / ');
define('TEXT_INFO_HEADING_NEW', 'Новый администратор ');
define('TEXT_ADMIN_LIST', 'Список администраторов');
define('TEXT_ADMIN_GROUPS', 'Группы администраторов');
define('TEXT_ADMIN_ACCESS', 'Права доступа');

define('TEXT_INFO_DEFAULT_INTRO', 'Группа');
define('TEXT_INFO_DELETE_INTRO', 'Вы действительно хотите удалить <nobr><b>%s</b></nobr> из <nobr>Администраторов?</nobr>');
define('TEXT_INFO_DELETE_INTRO_NOT', 'Вы не можете удалить группу <nobr>%s!</nobr>');
define('TEXT_INFO_EDIT_INTRO', 'Права доступа к боксам и файлам: ');

define('TEXT_INFO_FULLNAME', 'Имя: ');
define('TEXT_INFO_FIRSTNAME', 'Имя: ');
define('TEXT_INFO_LASTNAME', 'Фамилия: ');
define('TEXT_INFO_EMAIL', 'Email Адрес: ');
define('TEXT_INFO_PASSWORD', 'Пароль ');
define('TEXT_INFO_CONFIRM', 'Подтвердите Пароль ');
define('TEXT_INFO_CHANGE_PASSWORD', 'Сменить свой пароль ');
define('TEXT_ERROR_NOT_MATCH_PASS', 'Пароли не совпадают ');
define('TEXT_ERROR_EMPTY_PASS', 'Пароль пустой');
define('TEXT_ERROR_CNT_ADMIN', 'Вы не можете удалить последнего админа');

define('TEXT_INFO_CREATED', 'Запись создана: ');
define('TEXT_INFO_MODIFIED', 'Последние изменения: ');
define('TEXT_INFO_LOGDATE', 'Последний вход: ');
define('TEXT_INFO_LOGNUM', 'Количество входов: ');
define('TEXT_INFO_GROUP', 'Группа: ');
define('TEXT_INFO_ERROR', 'Введённый Email уже зарегистрирован! Попробуйте указать другой адрес.');

define('JS_ALERT_FIRSTNAME',        '- Вы не указали своё Имя. \n');
define('JS_ALERT_LASTNAME',         '- Вы не указали свою Фамилию. \n');
define('JS_ALERT_EMAIL',            '- Вы не указали свой Email адрес. \n');
define('JS_ALERT_EMAIL_FORMAT',     '- Вы неправильно написали Email адрес! \n');
define('JS_ALERT_EMAIL_USED',       '- Введённый Email адрес уже зарегистрирован! \n');
define('JS_ALERT_LEVEL', '- Вы не указали группу \n');

define('ADMIN_EMAIL_SUBJECT', 'Новый администратор');
define('ADMIN_EMAIL_SUBJECT_PASS_NEW', 'Новый пароль');
define('ADMIN_EMAIL_TEXT_CHANGE_PASS', 'Здравствуйте, %s!' . "\n\n" . 'Вы можете заходить в админку со следущим паролем. ' . "\n\n" . 'Сайт: %s' . "\n" . 'Email: %s' . "\n" . 'Пароль: %s' . "\n\n" . 'Спасибо!' . "\n" . '%s' . "\n\n" . 'Это письмо отправлено автоматически, не нужно на него отвечать!');
define('ADMIN_EMAIL_TEXT', 'Здравствуйте, %s!' . "\n\n" . 'Вы можете заходить в админку со следущим паролем. После того как Вы зайдёте в админку, мы настоятельно Вам рекомендуем изменить свой пароль!' . "\n\n" . 'Сайт: %s' . "\n" . 'Email: %s' . "\n" . 'Пароль: %s' . "\n\n" . 'Спасибо!' . "\n" . '%s' . "\n\n" . 'Это письмо отправлено автоматически, не нужно на него отвечать!');
define('ADMIN_EMAIL_EDIT_SUBJECT', 'Ваша информация изменена администратором');
define('ADMIN_EMAIL_EDIT_TEXT', 'Здравствуйте, %s!' . "\n\n" . 'Ваша информация изменена администратором.' . "\n\n" . 'Сайт: %s' . "\n" . 'Email: %s' . "\n" . 'Пароль: %s' . "\n\n" . 'Спасибо!' . "\n" . '%s' . "\n\n" . 'Это письмо отправлено автоматически, не нужно на него отвечать!'); 

define('TEXT_INFO_HEADING_DEFAULT_GROUPS', 'Группа ');
define('TEXT_INFO_HEADING_DELETE_GROUPS', 'Удалить группу ');

define('TEXT_INFO_DEFAULT_GROUPS_INTRO', '<b>ВНИМАНИЕ:</b><li><b>изменить:</b> изменение названия группы.</li><li><b>удалить:</b> удаление группы.</li><li><b>доступ к файлам:</b> настройка доступа к боксам и файлам.</li>');
define('TEXT_INFO_DELETE_GROUPS_INTRO', 'Удаляя данную группу, Вы также удаляете всех администраторов, находящихся в этой группе. Вы действительно хотите удалить группу <nobr><b>%s</b>?</nobr>');
define('TEXT_INFO_DELETE_GROUPS_INTRO_NOT', 'Вы не можете удалить данную группу!');
define('TEXT_INFO_GROUPS_INTRO', 'Дайте название новой группе, затем нажмите кнопку "далее".');

define('TEXT_INFO_HEADING_GROUPS', 'Новая группа');
define('TEXT_INFO_GROUPS_NAME', ' <b>Название группы:</b><br>Введите название новой группы, затем нажмите кнопку "Далее".<br>');
define('TEXT_INFO_GROUPS_NAME_FALSE', '<b>ОШИБКА:</b> Название группы должно состоять минимум из 2 символов!');
define('TEXT_INFO_GROUPS_NAME_USED', '<b>ОШИБКА:</b> Введённое название группы уже есть, попробуйте назвать группу по-другому!');
define('TEXT_INFO_GROUPS_LEVEL', 'Группа: ');
define('TEXT_INFO_GROUPS_BOXES', '<b>Права доступа к боксам:</b><br>Разграничение доступа к боксам.');
define('TEXT_INFO_GROUPS_BOXES_INCLUDE', 'Добавить файл в бокс: ');

define('TEXT_INFO_HEADING_EDIT_GROUP', 'Изменить название группы');
define('TEXT_INFO_EDIT_GROUP_INTRO', 'Вы можете изменить название данной группы на новое, укажите новое название и нажмите кнопку <b>сохранить</b>');

// here
define("stats_products_purchased.php", "Заказанные товары");
define("stats_customers_orders.php", "Заказы клиентов");
define("template_configuration.php", "Конфигурация шаблона");
define("easypopulate_functions.php", " .. EASYPOPULATE_FUNCTIONS ..");
define("create_account_process.php", "Процесс создания аккаунта");
define("create_account_success.php", "Страница успешной регисстрации");
define("stats_customers_entry.php", "Входы клиентов");
define("stats_products_viewed.php", "Просматриваемые товары");
define("languages_translater.php", "Перевод языков");
define("create_order_process.php", "Процесс создания заказа");
define("stats_sales_report2.php", "Статистика продаж (2)");
define("total_configuration.php", "Редактор настроек");
define("stats_monthly_sales.php", "Ежемесячные продажи");
define("extra_product_price.php", "Дополнительная цена продукта");
define("products_attributes.php", "Атрибуты товаров");
define("stats_last_modified.php", "Последние изменения");
define("stats_sales_report.php", "Отчет по статистике продаж");
define("attributeManager.php", "Менеджер атрибутов");
define("mysqlperformance.php", "Лог медленных запросов");
define("customers_groups.php", "Группы клиентов");
define("validcategories.php", "Действительные категории");
define("stats_customers.php", "Статистика клиентов");
define("design_controls.php", "Элементы управления дизайном");
define("stats_opened_by.php", "Статистика по новым аккаунтам");
define("create_account.php", "Создать учетную запись");
define("listcategories.php", "Список категорий");
define("stats_keywords.php", "Поисковые запросы");
define("image_explorer.php", "Менеджер файлов");
define("xsell_products.php", "Сопутствующие продукты");
define("products_multi.php", "Управление товарами");
define("manufacturers.php", "Производители");
define("stats_zeroqty.php", "Продукты которых нет на складе");
define("configuration.php", "Концигурация");

define("stats_nophoto.php", "Товары без фото");
define("quick_updates.php", "Оновлення Прайсу");
define("validproducts.php", "Список товаров");
define("configuration.php", "Мой магазин");
define("admin_members.php", "Управление администраторами");
define("orders_status.php", "Статус заказов");
define("email_content.php", "Шаблоны писем");
define("administrator.php", "Администраторы");
define("coupon_admin.php", "Промо-коды");
define("listproducts.php", "Список товаров");
define("easypopulate.php", "Exсel Импорт / Экспорт");
define("manudiscount.php", "Скидки производителей");
define("localization.php", "Локализация");
define("edit_orders.php", "Редактировать заказы");
define("newsletters.php", "Менеджер почтовых рассылок");
define("tax_classes.php", "Список налогов");
define("admin_files.php", "Меню администраторских боксов");
define("whos_online.php", "Люди онлайн");
define("currencies.php", "Валюты");
define("ajax_xsell.php", "AJAX Сопутствующие товары");
define("chart_data.php", " .. CHART_DATA ..");
define("categories.php", "Список товаров");
define("tax_rates.php", "Ставки налогов");
define("salemaker.php", "Массовые скидки");
define("languages.php", "Языки");
define("pollbooth.php", ".. POLLBOTH ..");
define("customers.php", "Список клиентов");
define("countries.php", "Страны");
define("geo_zones.php", "Географические зоны");
define("customers.php", "Клиенты");
define("articles.php", "Статьи");
define("products.php", "Редактор продукта");
define("featured.php", "Рекомендуемые товары");
define("gv_admin.php", " .. GV_ADMIN ..");
define("specials.php", "Скидки");
define("gv_queue.php", "Активация сертификатов");
define("ship2pay.php", "Доставка-Оплата (Ship 2 Pay)");
define("reviews.php", "Коментарии");
define("articles.php", "Страницы");
define("modules.php", "Модули");
define("reports.php", "Отчеты");
define("catalog.php", "Каталог");
define("gv_mail.php", "Отправить сертификат");
define("gv_sent.php", "Отправленные сертификаты");
define("modules.php", "Модули");
define("backup.php", "Резервное копирование");
define("orders.php", "Список заказов");
define("taxes.php", "Налоги");
define("cache.php", "Кэш");
define("tools.php", "Инструменты");
define("polls.php", "Опросы");
define("polls.php", "Голосования");
define("zones.php", "Список регионов");
define("mail.php", "Отправить Email");

define('FILENAME_DEFAULT_TEXT', 'Главная Страница');
define('FILENAME_CATEGORIES_TEXT', 'Страница Категорий');


define('TEXT_INFO_HEADING_DEFINE', 'Настройка группы');
if ($_GET['gPath'] == 1) {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br>Вы не можете изменять доступ к боксам и файлам для этой группы.<br><br>');
} else {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br>Вы можете установить либо снять доступ к боксам и файлам для данной группы. Нажмите внизу кнопку  <b>сохранить</b> для сохранения внесённых изменений.<br><br>');
}
?>
