<?php
/*
  $Id: easypopulate.php,v 1.4 2004/09/21  zip1 Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 20042 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Налаштування модуля Excel імпорт / експорт');
define('EASY_VERSION_A', 'Excel імпорт / експорт');
define('EASY_DEFAULT_LANGUAGE', '  -  Мова за замовчуванням - ');
define('EASY_UPLOAD_FILE', 'Файл завантажений. ');
define('EASY_UPLOAD_TEMP', 'Ім\'я тимчасового файлу: ');
define('EASY_UPLOAD_USER_FILE', 'Ім\'я файлу користувача:');
define('EASY_SIZE', 'Розмір:');
define('EASY_FILENAME', 'Ім\'я файлу: ');
define('EASY_SPLIT_DOWN', 'Ви можете завантажити Ваші розділені файли з папки temp');
define('EASY_UPLOAD_EP_FILE', 'Імпортувати файл');
define('EASY_SPLIT_EP_FILE', 'Завантажити і розділити файл на частини');
define('EASY_INSERT', 'Імпортувати');
define('EASY_SPLIT', 'Розділити');
define('EASY_LIMIT', 'Налаштування експорту:');

define('TEXT_IMPORT_TEMP', 'Імпорт даних з папки %s<br>');
define('TEXT_INSERT_INTO_DB', 'Імпортувати');
define('TEXT_SELECT_ONE', 'Виберіть файл для імпортування');
define('TEXT_SPLIT_FILE', 'Виберіть файл');
define('EASY_LABEL_CREATE', 'Експорт:');
define('EASY_LABEL_IMPORT', 'Імпорт:');
define('EASY_LABEL_CREATE_SELECT', 'Спосіб збереження експортованого файлу:');
define('EASY_LABEL_CREATE_SAVE', 'Зберегти в папці temp на сервері');
define('EASY_LABEL_SELECT_DOWN', 'Виберіть поля для завантаження:');
define('EASY_LABEL_SORT', 'Виберіть порядок сортування:');
define('EASY_LABEL_PRODUCT_RANGE', 'Експортувати товари з ID номером');
define('EASY_LABEL_LIMIT_CAT', 'Експортувати товари з категорії:');
define('EASY_LABEL_LIMIT_MAN', 'Експортувати товари виробника: ');

define('EASY_LABEL_PRODUCT_AVAIL', 'Доступний діапазон ID номерів:');
define('EASY_LABEL_PRODUCT_FROM', ' від ');
define('EASY_LABEL_PRODUCT_TO', ' до ');
define('EASY_LABEL_PRODUCT_RECORDS', 'Всього записів: ');
define('EASY_LABEL_PRODUCT_BEGIN', 'від: ');
define('EASY_LABEL_PRODUCT_END', 'до: ');
define('EASY_LABEL_PRODUCT_START', 'Експортувати');

define('EASY_FILE_LOCATE', 'Ви можете взяти Ваш файл в папці');
define('EASY_FILE_LOCATE_2', '');
define('EASY_FILE_RETURN', 'Ви можете повернутися, натиснувши на це посилання');
define('EASY_IMPORT_TEMP_DIR', 'Імпортувати також папки temp ');
define('EASY_LABEL_DOWNLOAD', 'Завантажити файл');
define('EASY_LABEL_COMPLETE', 'Всі поля');
define('EASY_LABEL_TAB', 'tab-delimited .txt file to edit');
define('EASY_LABEL_MPQ', 'Код товару / Ціна / Кількість');
define('EASY_LABEL_EP_MC', 'Код товару / Категорія');
define('EASY_LABEL_EP_FROGGLE', 'Файл з даними для системи Фругл');
define('EASY_LABEL_EP_ATTRIB', 'Аатрибути товару');
define('EASY_LABEL_NONE', 'Ні');
define('EASY_LABEL_CATEGORY', 'Кореневий розділ');
define('PULL_DOWN_MANUFACTURES', 'Всі виробники');
define('EASY_LABEL_PRODUCT', 'ID номер товару');
define('EASY_LABEL_MANUFACTURE', 'ID номер виробника');
define('EASY_LABEL_EP_FROGGLE_HEADER', 'Завантажити файл з даними або фругл файл');
define('EASY_LABEL_EP_MA', 'Код товару / Атрибути');
define('EASY_LABEL_EP_FR_TITLE', 'Створити файл з даними або фругл файл в папці temp');
define('EASY_LABEL_EP_DOWN_TAB', 'Create <b>Complete</b> tab-delimited .txt file in temp dir');
define('EASY_LABEL_EP_DOWN_MPQ', 'Create <b>Model/Price/Qty</b> tab-delimited .txt file in temp dir');
define('EASY_LABEL_EP_DOWN_MC', 'Create <b>Model/Category</b> tab-delimited .txt file in temp dir');
define('EASY_LABEL_EP_DOWN_MA', 'Create <b>Model/Attributes</b> tab-delimited .txt file in temp dir');
define('EASY_LABEL_EP_DOWN_FROOGLE', 'Create <b>Froogle</b> tab-delimited .txt file in temp dir');

define('EASY_LABEL_NEW_PRODUCT', '<font color=blue> Товар доданий</font><br>');
define('EASY_LABEL_UPDATED', "<font color=green> Товар оновлено</font><br>");
define('EASY_LABEL_DELETE_STATUS_1', '<font color=red>Товар оновлений</font><font color=black> ');
define('EASY_LABEL_DELETE_STATUS_2', ' </font><font color=red> видалено!</font>');
define('EASY_LABEL_LINE_COUNT_1', 'Додано');
define('EASY_LABEL_LINE_COUNT_2', ' записів і файл закритий... ');
define('EASY_LABEL_FILE_COUNT_1', 'Створити файл EP_Split ');
define('EASY_LABEL_FILE_COUNT_2', '.txt ...  ');
define('EASY_LABEL_FILE_CLOSE_1', 'Додано');
define('EASY_LABEL_FILE_CLOSE_2', ' записів і файл закритий...');
//errormessages
define('EASY_ERROR_1', 'Дивно, але мова за замовчуванням не встановлено ... Нічого страшного, просто попередження ...');
define('EASY_ERROR_2', '... ОШИБКА! - Слишком много символов в поле код товара.<br>
			12 символов это максимальное количество в стандартном OsCommerce.<br>
			Максимальная длина поля product_model, установленная в настройках модуля: ');
define('EASY_ERROR_2A', ' <br>Ви можете або вкоротити код товару, або збільшити довжину поля в базі даних.</font>');
define('EASY_ERROR_2B',  "<font color='red'>");
define('EASY_ERROR_3', '<p class=smallText>Не заповнене поле products_id. Цей рядок не був імпортован. <br><br>');
define('EASY_ERROR_4', '<font color=red>ПОМИЛКА! - v_customer_group_id and v_customer_price must occur in pairs</font>');
define('EASY_ERROR_5', '</b><font color=red>ПОМИЛКА! - You are trying to use a file created with EP Advanced, please try with Easy Populate Advanced </font>');
define('EASY_ERROR_5a', '<font color=red><b><u>  Click here to return to Easy Populate Basic </u></b></font>');
define('EASY_ERROR_6', '</b><font color=red>ПОМИЛКА! - You are trying to use a file created with EP Basic, please try with Easy Populate Basic </font>');
define('EASY_ERROR_6a', '<font color=red><b><u>  Click here to return to Easy Populate Advanced </u></b></font>');

define('EASY_R_NAME', 'назва');
define('EASY_R_INFO', 'короткий опис');
define('EASY_R_DESC', 'опис');
define('EASY_R_CAT', 'категорія');
define('EASY_R_LANGUAGE', 'Мова');
define('EASY_R_MODEL', 'код');
define('EASY_R_IMAGES', 'картинки');
define('EASY_R_MANUF', 'виробник');
define('EASY_R_DISC', 'знижка');
define('EASY_R_PRICE', 'ціна');
define('EASY_R_QTY', 'кількість');
define('EASY_R_WEIGHT', '_вага_');
define('EASY_R_DATE', 'дата');
define('EASY_R_STATUS', 'статус');
define('EASY_R_STATUS_ACT', 'активний');
define('EASY_R_STATUS_NOACT', 'неактивний');
define('EASY_R_STATUS_DELETE', 'видалити');
define('EASY_R_DOWNLOAD', 'Ви можете завантажити ваш файл тут');
define('EASY_R_NORMAL', 'Нормальний');
define('EASY_R_ADD', 'Додати');
define('EASY_R_REFRESH', 'Оновити');
define('EASY_R_DEL', 'Видалити');
define('EASY_R_FULLFILE', 'Повний файл');
define('EASY_R_ID_PRICE', 'Артикул / Ціна / Кількість');
define('EASY_R_DOWN_NOW', 'Завантажити на льоту');
define('EASY_R_DOWN_CREATE', 'Створити і завантажити');
define('EASY_R_TMP_DIR', 'Створити в тимчасовій папці');
define('EASY_R_ALL', 'Всі');
define('EASY_R_PRICEQTY', 'Ціна / Кількість');
define('EASY_R_CATS', 'Категорії');
define('EASY_R_ATTRS', 'Атрибути');
define('EASY_R_FILE3', 'файл (код товару завжди є).');
define('EASY_R_SORT', 'Сортування');
define('EASY_R_FILTER', 'Фільтрація');
define('EASY_LABEL_ALGORITHM', 'Алгоритм імпорту');
define('EASY_LABEL_DELIMITER', 'Роздільник');
define('EASY_SELECT_FILE', 'Виберіть файл');
define('EASY_EXPORT_DATA', 'Експортувати дані');
define('EASY_LABEL_EXPORT_FULL_ATTR_INF', 'Вивантажувати повну інформацію про атрибути');
define('EASY_LABEL_IMPORT_FULL_ATTR_INF', 'Завантажувати повну інформацію про атрибути');

?>
