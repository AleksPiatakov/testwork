<?php
/*
  $Id: easypopulate.php,v 1.4 2004/09/21  zip1 Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 20042 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Настройка модуля Excel импорт/экспорт');
define('EASY_VERSION_A', 'Excel импорт/экспорт');
define('EASY_DEFAULT_LANGUAGE', '  -  Язык по умолчанию - ');
define('EASY_UPLOAD_FILE', 'Файл загружен. ');
define('EASY_UPLOAD_TEMP', 'Имя временного файла: ');
define('EASY_UPLOAD_USER_FILE', 'Имя файла пользователя: ');
define('EASY_SIZE', 'Размер: ');
define('EASY_FILENAME', 'Имя файла: ');
define('EASY_SPLIT_DOWN', 'Вы можете скачать Ваши разделённые файлы из папки temp');
define('EASY_UPLOAD_EP_FILE', 'Импортировать файл');
define('EASY_SPLIT_EP_FILE', 'Загрузить и разделить файл на части');
define('EASY_INSERT', 'Импортировать');
define('EASY_SPLIT', 'Разделить');
define('EASY_LIMIT', 'Настройка экспорта:');

define('TEXT_IMPORT_TEMP', 'Импортирование данных из папки %s<br>');
define('TEXT_INSERT_INTO_DB', 'Импортировать');
define('TEXT_SELECT_ONE', 'Выберите файл для импортирования');
define('TEXT_SPLIT_FILE', 'Выберите файл');
define('EASY_LABEL_CREATE', 'Экспорт:');
define('EASY_LABEL_IMPORT', 'Импорт:');
define('EASY_LABEL_CREATE_SELECT', 'Способ сохранения экспортируемого файла: ');
define('EASY_LABEL_CREATE_SAVE', 'Сохранить в папке temp на сервере');
define('EASY_LABEL_SELECT_DOWN', 'Выберите поля для загрузки: ');
define('EASY_LABEL_SORT', 'Выберите порядок сортировки: ');
define('EASY_LABEL_PRODUCT_RANGE', 'Экспортировать товары с ID номером ');
define('EASY_LABEL_LIMIT_CAT', 'Экспортировать товары из категории: ');
define('EASY_LABEL_LIMIT_MAN', 'Экспортировать товары производителя: ');

define('EASY_LABEL_PRODUCT_AVAIL', 'Доступный диапазон ID номеров: ');
define('EASY_LABEL_PRODUCT_FROM', ' от ');
define('EASY_LABEL_PRODUCT_TO', ' до ');
define('EASY_LABEL_PRODUCT_RECORDS', 'Всего записей: ');
define('EASY_LABEL_PRODUCT_BEGIN', 'от: ');
define('EASY_LABEL_PRODUCT_END', 'до: ');
define('EASY_LABEL_PRODUCT_START', 'Экспортировать');

define('EASY_FILE_LOCATE', 'Вы можете взять Ваш файл в папке ');
define('EASY_FILE_LOCATE_2', '');
define('EASY_FILE_RETURN', ' Вы можете вернуться, нажав на эту ссылку.');
define('EASY_IMPORT_TEMP_DIR', 'Импортировать и папки temp ');
define('EASY_LABEL_DOWNLOAD', 'Скачать файл');
define('EASY_LABEL_COMPLETE', 'Все поля');
define('EASY_LABEL_TAB', 'tab-delimited .txt file to edit');
define('EASY_LABEL_MPQ', 'Код товара/Цена/Количество');
define('EASY_LABEL_EP_MC', 'Код товара/Категория');
define('EASY_LABEL_EP_FROGGLE', 'Файл с данными для системы Фругл');
define('EASY_LABEL_EP_ATTRIB', 'Атрибуты товара');
define('EASY_LABEL_NONE', 'Нет');
define('EASY_LABEL_CATEGORY', 'Корневой раздел');
define('PULL_DOWN_MANUFACTURES', 'Все производители');
define('EASY_LABEL_PRODUCT', 'ID номер товара');
define('EASY_LABEL_MANUFACTURE', 'ID номер производителя');
define('EASY_LABEL_EP_FROGGLE_HEADER', 'Скачать файл с данными или фругл файл');
define('EASY_LABEL_EP_MA', 'Код товара/Атрибуты');
define('EASY_LABEL_EP_FR_TITLE', 'Создать файл с данными или фругл файл в папке temp ');
define('EASY_LABEL_EP_DOWN_TAB', 'Create <b>Complete</b> tab-delimited .txt file in temp dir');
define('EASY_LABEL_EP_DOWN_MPQ', 'Create <b>Model/Price/Qty</b> tab-delimited .txt file in temp dir');
define('EASY_LABEL_EP_DOWN_MC', 'Create <b>Model/Category</b> tab-delimited .txt file in temp dir');
define('EASY_LABEL_EP_DOWN_MA', 'Create <b>Model/Attributes</b> tab-delimited .txt file in temp dir');
define('EASY_LABEL_EP_DOWN_FROOGLE', 'Create <b>Froogle</b> tab-delimited .txt file in temp dir');

define('EASY_LABEL_NEW_PRODUCT', '<font color=blue> Товар добавлен</font><br>');
define('EASY_LABEL_UPDATED', "<font color=green> Товар обновлён</font><br>");
define('EASY_LABEL_DELETE_STATUS_1', '<font color=red>Товар</font><font color=black> ');
define('EASY_LABEL_DELETE_STATUS_2', ' </font><font color=red> удалён!</font>');
define('EASY_LABEL_LINE_COUNT_1', 'Добавлено ');
define('EASY_LABEL_LINE_COUNT_2', ' записей и файл закрыт... ');
define('EASY_LABEL_FILE_COUNT_1', 'Создать файл EP_Split ');
define('EASY_LABEL_FILE_COUNT_2', '.txt ...  ');
define('EASY_LABEL_FILE_CLOSE_1', 'Добавлено ');
define('EASY_LABEL_FILE_CLOSE_2', ' записей и файл закрыт...');
//errormessages
define('EASY_ERROR_1', 'Странно, но язык по умолчанию не установлен... Ничего страшного, просто предупреждение... ');
define('EASY_ERROR_2', '... ОШИБКА! - Слишком много символов в поле код товара.<br>
			12 символов это максимальное количество в стандартном OsCommerce.<br>
			Максимальная длина поля product_model, установленная в настройках модуля: ');
define('EASY_ERROR_2A', ' <br>Вы можете либо укоротить код товара, либо увеличить длину поля в базе данных.</font>');
define('EASY_ERROR_2B',  "<font color='red'>");
define('EASY_ERROR_3', '<p class=smallText>Не заполнено поле products_id. Данная строка не была импортирована. <br><br>');
define('EASY_ERROR_4', '<font color=red>ОШИБКА! - v_customer_group_id and v_customer_price must occur in pairs</font>');
define('EASY_ERROR_5', '</b><font color=red>ОШИБКА! - You are trying to use a file created with EP Advanced, please try with Easy Populate Advanced </font>');
define('EASY_ERROR_5a', '<font color=red><b><u>  Click here to return to Easy Populate Basic </u></b></font>');
define('EASY_ERROR_6', '</b><font color=red>ОШИБКА! - You are trying to use a file created with EP Basic, please try with Easy Populate Basic </font>');
define('EASY_ERROR_6a', '<font color=red><b><u>  Click here to return to Easy Populate Advanced </u></b></font>');

define('EASY_R_NAME', 'название');
define('EASY_R_INFO', 'краткое описание');
define('EASY_R_DESC', 'описание');
define('EASY_R_CAT', 'категория');
define('EASY_R_MODEL', 'код');
define('EASY_R_IMAGES', 'картинки');
define('EASY_R_MANUF', 'производитель');
define('EASY_R_DISC', 'скидка');
define('EASY_R_PRICE', 'цена');
define('EASY_R_QTY', 'колич');
define('EASY_R_WEIGHT', '_вес_');
define('EASY_R_DATE', 'дата');
define('EASY_R_STATUS', 'статус');
define('EASY_R_STATUS_ACT', 'активный');
define('EASY_R_STATUS_NOACT', 'неактивный');
define('EASY_R_STATUS_DELETE', 'удалить');
define('EASY_R_DOWNLOAD', 'Вы можете скачать ваш файл здесь');
define('EASY_R_NORMAL', 'Нормальный');
define('EASY_R_ADD', 'Добавить');
define('EASY_R_REFRESH', 'Обновить');
define('EASY_R_DEL', 'Удалить');
define('EASY_R_FULLFILE', 'Полный файл');
define('EASY_R_ID_PRICE', 'Артикул/Цена/Количество');
define('EASY_R_DOWN_NOW', 'Скачать на лету');
define('EASY_R_DOWN_CREATE', 'Создать и скачать');
define('EASY_R_TMP_DIR', 'Создать в временной папке');
define('EASY_R_ALL', 'Все');
define('EASY_R_PRICEQTY', 'Цена/Количество');
define('EASY_R_CATS', 'Категории');
define('EASY_R_ATTRS', 'Атрибуты');
define('EASY_R_FILE3', 'файл (код товара всегда есть).');
define('EASY_R_SORT', 'Сортировка');
define('EASY_R_FILTER', 'Фильтрация');
define('EASY_LABEL_ALGORITHM', 'Алгоритм импорта');
define('EASY_LABEL_DELIMITER', 'Разделитель');
define('EASY_SELECT_FILE', 'Выберите файл');
define('EASY_EXPORT_DATA', 'Экспортировать данные');

?>
