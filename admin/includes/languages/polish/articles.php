<?php
/*
  $Id: articles.php, v1.0 2003/12/04 12:00:00 ra Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Sekcje / Artykuły');
define('HEADING_TITLE_NAME', 'Nazwa');
define('HEADING_TITLE_SEARCH', 'Wyszukaj:');
define('HEADING_TITLE_GOTO', 'Przejdź:');
define('HEADING_CATEGORY', 'Sekcje');
define('TEXT_MODAL_COPY_ACTION', 'Skopiuj do');
define('TEXT_ADD_FIELD', 'Dodaj pole');
define('TEXT_CHOOSE_CATEGORY', 'Wybierz');
define('TEXT_COUNT_SURE_DELL', 'Ta sekcja zawiera %s kategorie i %s artykuły. Jesteś pewien?');
define('TEXT_NO_IMG', 'Brak obrazu');


define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_TOPICS_ARTICLES', 'Sekcje / Artykuły');
define('TABLE_HEADING_ACTION', 'Działanie');
define('TABLE_HEADING_STATUS', 'Status');

define('TEXT_ARTICLES_CURRENT', 'Bieżące artykuły:');

define('TEXT_NEW_ARTICLE', 'Dodaj nowy artykuł w sekcje &quot;%s&quot;');
define('TEXT_TOPICS', 'Sekcje:');
define('TEXT_ALL', 'Wszystkie');
define('TEXT_RELATED_PRODUCTS', 'Produkty powiązane');
define('TEXT_SUBTOPICS', 'Podsekcje:');
define('TEXT_ARTICLES', 'Artykuły:');
define('TEXT_ARTICLES_AVERAGE_RATING', 'Średnia ocena:');
define('TEXT_ARTICLES_HEAD_TITLE_TAG', 'Meta Title');
define('TEXT_ARTICLES_HEAD_DESC_TAG', 'Meta Description:<br><small>(nie więcej niż %s znaków)</small>');
define('TEXT_ARTICLES_HEAD_KEYWORDS_TAG', 'Meta Keywords');
define('TEXT_DATE_ADDED', 'Data dodania');
define('TEXT_DATE_AVAILABLE', 'Dostępna od');
define('TEXT_LAST_MODIFIED', 'Ostatnia modyfikacja');
define('TEXT_NO_CHILD_TOPICS_OR_ARTICLES', 'Dodaj sekcję lub artykuł.');
define('TEXT_ARTICLE_MORE_INFORMATION', 'Aby dowiedzieć się więcej, przejdź <a href="http://%s" target="blank"><u>tutaj</u></a>.');
define('TEXT_ARTICLE_DATE_ADDED', 'Artykuł został dodany %s.');
define('TEXT_ARTICLE_DATE_AVAILABLE', 'Artykuł będzie dostępny od %s.');

define('TEXT_EDIT_INTRO', 'Wprowadź niezbędne zmiany');
define('TEXT_EDIT_TOPICS_ID', 'ID:');
define('TEXT_EDIT_TOPICS_NAME', 'Nazwa sekcji');
define('TEXT_EDIT_SORT_ORDER', 'Kolejność sortowania:');

define('TEXT_INFO_COPY_TO_INTRO', 'Wybierz sekcję, do której chcesz skopiować artykuł');
define('TEXT_INFO_CURRENT_TOPICS', 'Aktualne sekcje:');

define('TEXT_INFO_HEADING_NEW_TOPIC', 'Nowa sekcja');
define('TEXT_INFO_HEADING_EDIT_TOPIC', 'Edytuj sekcje');
define('TEXT_INFO_HEADING_DELETE_TOPIC', 'Usuń sekcje');
define('TEXT_INFO_HEADING_MOVE_TOPIC', 'Przenieś sekcję');
define('TEXT_INFO_HEADING_DELETE_ARTICLE', 'Usuń artykuł');
define('TEXT_INFO_HEADING_MOVE_ARTICLE', 'Przenieś artykuł');
define('TEXT_INFO_HEADING_COPY_TO', 'Skopiuj do');

define('TEXT_DELETE_TOPIC_INTRO', 'Czy na pewno chcesz usunąć tę sekcję?');
define('TEXT_DELETE_ARTICLE_INTRO', 'Czy na pewno chcesz usunąć ten artykuł?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>UWAGA:</b> W tej sekcji znajduje się %s podsekcji!');
define('TEXT_DELETE_WARNING_ARTICLES', '<b>UWAGA:</b> W tej sekcji znajduje się %s artykułów!');

define('TEXT_MOVE_ARTICLES_INTRO', 'Wybierz sekcję, do której chcesz przenieść artykuł <b>%s</b>');
define('TEXT_MOVE_TOPICS_INTRO', 'Wybierz sekcję, do której chcesz przenieść sekcję <b>%s</b>');
define('TEXT_MOVE', 'Przenieś <b>%s</b> w:');

define('TEXT_NEW_TOPIC_INTRO', 'Wypełnij ten formularz, aby dodać nową sekcję');
define('TEXT_TOPICS_NAME', 'Nazwa sekcji');
define('TEXT_SORT_ORDER', 'Kolejność sortowania:');
define('TEXT_SEO_TITLE', 'Opis SEO');

define('TEXT_EDIT_TOPICS_HEADING_TITLE', 'Tytuł sekcji w szczegółach');
define('TEXT_EDIT_TOPICS_DESCRIPTION', 'Opis sekcji');

define('TEXT_ARTICLES_STATUS', 'Status:');
define('TEXT_ARTICLES_DATE_AVAILABLE', 'Dostępna od');
define('TEXT_ARTICLE_AVAILABLE', 'Aktywny');
define('TEXT_ARTICLE_NOT_AVAILABLE', 'Nieaktywny');
define('TEXT_ARTICLES_AUTHOR', 'Autor:');
define('TEXT_ARTICLES_NAME', 'Nazwa artykułu:');
define('TEXT_ARTICLES_DESCRIPTION', 'Treść artykułu');
define('TEXT_ARTICLES_URL', 'URL adres');
define('TEXT_ARTICLES_LINK', 'Niestandardowy link URL');
define('TEXT_EDIT_ROBOTS_STATUS', 'Robots Status');
define('TEXT_EDIT_ROBOTS_STATUS_ON', 'index, follow');
define('TEXT_EDIT_ROBOTS_STATUS_OFF', 'noindex, nofollow');
define('TEXT_ARTICLES_CODE', 'code');
define('TEXT_ARTICLES_IMAGE', 'Obraz');
define('TEXT_ARTICLES_DEL_IMAGE', 'Usuń obraz');
define('TEXT_ARTICLES_SORT', 'Sortuj');
define('TEXT_SHOW_IN_SITEMAP', 'Pokaż w mapie witryny');
define('TEXT_TOPICS_ROBOTS_STATUS', 'Robots Status');

define('TEXT_ARTICLES_URL_WITHOUT_HTTP', '<small>(bez http://)</small>');

define('EMPTY_TOPIC', 'Sekcja jest pusta.');

define('TEXT_HOW_TO_COPY', 'Sposób kopiowania:');
define('TEXT_COPY_AS_LINK', 'Link');
define('TEXT_COPY_AS_DUPLICATE', 'Kopiowanie');
define('TEXT_COPY_AS_MOVE', 'Ruszaj się');

define('ERROR_CANNOT_LINK_TO_SAME_TOPIC', 'BŁĄD: Nie można utworzyć link do artykułu w tej samej sekcji, w której znajduje się artykuł.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'BŁĄD: Katalog zdjęć jest chroniony przed zapisem. Ustaw uprawnienia do zapisu dla tego katalogu: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'BŁĄD Brak katalogu zdjęć: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_TOPIC_TO_PARENT', 'BŁĄD: Sekcja nie może być przeniesiona w podsekcje.');
define('TOPICS_SEO_URL_TITLE', 'Topic SEO URL');
define('TEXT_ARTICLES_IMAGE_MOBILE','Obraz mobilny');
