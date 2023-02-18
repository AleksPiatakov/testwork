<?php
/*
  $Id: articles.php, v1.0 2003/12/04 12:00:00 ra Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Sections / Artikel');
define('HEADING_TITLE_NAME', 'Titel');
define('HEADING_TITLE_SEARCH', 'Suche:');
define('HEADING_TITLE_GOTO', 'Go:');
define('HEADING_CATEGORY', 'Abschnitte');
define('TEXT_MODAL_COPY_ACTION', 'Kopieren nach');
define('TEXT_ADD_FIELD', 'Feld hinzufügen');
define('TEXT_CHOOSE_CATEGORY', 'Auswählen');
define('TEXT_COUNT_SURE_DELL', 'Dieser Bereich enthält die Kategorie %s und die %s des Artikels. Sind Sie sicher?');
define('TEXT_NO_IMG', 'Kein Bild');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_TOPICS_ARTICLES', 'Sections / Artikel');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_STATUS', 'Status');

define('TEXT_ARTICLES_CURRENT', 'Aktuelle Artikel:');

define('TEXT_NEW_ARTICLE', 'Hinzufügen eines neuen Artikels zum Abschnitt &quot;%s&quot;');
define('TEXT_TOPICS', 'Abschnitte:');
define('TEXT_ALL', 'Alle');
define('TEXT_RELATED_PRODUCTS', 'Verwandte Produkte');
define('TEXT_SUBTOPICS', 'Unterabschnitte:');
define('TEXT_ARTICLES', 'Artikel:');
define('TEXT_ARTICLES_AVERAGE_RATING', 'Durchschnittliche Bewertung:');
define('TEXT_ARTICLES_HEAD_TITLE_TAG', 'Meta Title');
define('TEXT_ARTICLES_HEAD_DESC_TAG', 'Meta Description:<br><small>(nicht mehr als  %s Zeichen) </small>');
define('TEXT_ARTICLES_HEAD_KEYWORDS_TAG', 'Meta Description');
define('TEXT_DATE_ADDED', 'Datum hinzugefügt');
define('TEXT_DATE_AVAILABLE', 'Verfügbar von');
define('TEXT_LAST_MODIFIED', 'Zuletzt geändert');
define('TEXT_NO_CHILD_TOPICS_OR_ARTICLES', 'Abschnitt oder Artikel hinzufügen');
define('TEXT_ARTICLE_MORE_INFORMATION', 'Um mehr zu erfahren, besuchen Sie <a href="http://%s" target="blank"><u>hier</u></a>.');
define('TEXT_ARTICLE_DATE_ADDED', 'wurde in Artikel %s hinzugefügt.');
define('TEXT_ARTICLE_DATE_AVAILABLE', 'Der Artikel wird ab %s Verfügung stehen.');

define('TEXT_EDIT_INTRO', 'die notwendigen Änderungen vornehmen');
define('TEXT_EDIT_TOPICS_ID', 'ID:');
define('TEXT_EDIT_TOPICS_NAME', 'Abschnittsname');
define('TEXT_EDIT_SORT_ORDER', 'Sortierreihenfolge:');

define('TEXT_INFO_COPY_TO_INTRO', 'Wählen Sie die Partition, in dem Sie den Artikel kopieren möchten');
define('TEXT_INFO_CURRENT_TOPICS', 'Aktuelle Partitionen:');

define('TEXT_INFO_HEADING_NEW_TOPIC', 'Neuer Abschnitt');
define('TEXT_INFO_HEADING_EDIT_TOPIC', 'Abschnitt bearbeiten');
define('TEXT_INFO_HEADING_DELETE_TOPIC', 'Abschnitt löschen');
define('TEXT_INFO_HEADING_MOVE_TOPIC', 'Abschnitt verschieben');
define('TEXT_INFO_HEADING_DELETE_ARTICLE', 'Löschen Artikel');
define('TEXT_INFO_HEADING_MOVE_ARTICLE', 'Artikel verschieben');
define('TEXT_INFO_HEADING_COPY_TO', 'Kopieren nach');

define('TEXT_DELETE_TOPIC_INTRO', 'Sind Sie sicher, dass Sie diesen Abschnitt löschen möchten?');
define('TEXT_DELETE_ARTICLE_INTRO', 'Möchten Sie diesen Artikel wirklich löschen?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>ACHTUNG:</b> Dieser Abschnitt enthält %s Unterabschnitte!');
define('TEXT_DELETE_WARNING_ARTICLES', '<b>ACHTUNG:</b> Dieser Abschnitt enthält %s Artikel!');

define('TEXT_MOVE_ARTICLES_INTRO', 'Wähle die Partition aus, in die der Artikel verschoben werden soll <b>%s</b>');
define('TEXT_MOVE_TOPICS_INTRO', 'Wählen Sie die Partition aus, auf die Sie den <b>%s</b> -Abschnitt verschieben möchten');
define('TEXT_MOVE', 'Verschiebe <b>%s</b> zu:');

define('TEXT_NEW_TOPIC_INTRO', 'Füllen Sie dieses Formular aus, um einen neuen Abschnitt hinzuzufügen');
define('TEXT_TOPICS_NAME', 'Abschnittsname');
define('TEXT_SORT_ORDER', 'Sortierreihenfolge:');
define('TEXT_SEO_TITLE', 'Beschreibung von SEO');

define('TEXT_EDIT_TOPICS_HEADING_TITLE', 'Abschnittsname im Detail');
define('TEXT_EDIT_TOPICS_DESCRIPTION', 'Beschreibung des Abschnitts');

define('TEXT_ARTICLES_STATUS', 'Status:');
define('TEXT_ARTICLES_DATE_AVAILABLE', 'Verfügbar von');
define('TEXT_ARTICLE_AVAILABLE', 'Aktiv');
define('TEXT_ARTICLE_NOT_AVAILABLE', 'Nicht aktiv');
define('TEXT_ARTICLES_AUTHOR', 'Autor:');
define('TEXT_ARTICLES_NAME', 'Artikelname:');
define('TEXT_ARTICLES_DESCRIPTION', 'Artikeltext');
define('TEXT_ARTICLES_URL', 'URL-Adresse');
define('TEXT_ARTICLES_LINK', 'Benutzerdefinierter URL-Link');
define('TEXT_EDIT_ROBOTS_STATUS', 'Robots Status');
define('TEXT_EDIT_ROBOTS_STATUS_ON', 'index, follow');
define('TEXT_EDIT_ROBOTS_STATUS_OFF', 'noindex, nofollow');
define('TEXT_ARTICLES_CODE', 'code');
define('TEXT_ARTICLES_IMAGE', 'Bild');
define('TEXT_ARTICLES_DEL_IMAGE', 'Bild löschen');
define('TEXT_ARTICLES_SORT', 'Sortieren');
define('TEXT_SHOW_IN_SITEMAP', 'In Sitemap anzeigen');
define('TEXT_TOPICS_ROBOTS_STATUS', 'Robots Status');

define('TEXT_ARTICLES_URL_WITHOUT_HTTP', '<small>(ohne http://)</small>');
define('EMPTY_TOPIC', 'Die Partition ist leer.');
define('TOPICS_SEO_URL_TITLE', 'Topic SEO URL');

define('TEXT_HOW_TO_COPY', 'Kopiermethode:');
define('TEXT_COPY_AS_LINK', 'Link');
define('TEXT_COPY_AS_DUPLICATE', 'Kopieren');
define('TEXT_COPY_AS_MOVE', 'Bewegung');

define('ERROR_CANNOT_LINK_TO_SAME_TOPIC', 'Fehler: Sie können keine Verknüpfung zu einem Artikel im selben Abschnitt wie der Artikel herstellen.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Fehler: Das Image-Verzeichnis ist schreibgeschützt. Legen Sie die Schreibberechtigungen für dieses Verzeichnis fest:'. DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Fehler: Das Bildverzeichnis fehlt:'. DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_TOPIC_TO_PARENT', 'Fehler: Die Partition kann nicht in einen Unterabschnitt verschoben werden.');
define('TEXT_ARTICLES_IMAGE_MOBILE','Mobiles Bild');
