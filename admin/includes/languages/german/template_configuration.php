<?php
/*
  $ Id: template_configuration.php, v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Lösungen
  http://www.oscommerce.com

  Copyright(c) 2002 osCommerce

    Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Vorlagen Konfiguration');
define('TABLE_HEADING_TEMPLATE', 'Name');
define('TABLE_HEADING_TEMPLATE_FOLDER', 'Folder');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_ACTIVE', 'Status');
define('TABLE_HEADING_COLOR', 'Farbe');
define('CONTENT_WIDTH', 'Inhaltsbreite');
define('CONTENT_WIDTH_CONTENT', 'Maximale Breite 100%');
define('CONTENT_WIDTH_FIX', 'Maximale Breite 1440 Pixel');
define('SHOW_SHORTCUT_TREE', 'Zeige Unterkategorien nur für die aktuelle Kategorie');
define('SHOW_ALL_LABELS_ON_DESKTOP', 'Alle Labels auf dem Desktop anzeigen');
define('SHOW_ALL_LABELS_ON_MOBILE', 'Alle Labels auf Mobilgeräten anzeigen');
define('SHOW_SPECIAL_LABEL_WITH_SPECIAL', 'Sonderkennzeichen anzeigen, wenn Sonderzeichen vorhanden sind');

define('TABLE_HEADING_DISPLAY_COLUMN_LEFT', 'Zeige linke Spalte?');
define('SLIDER_SIZE_CONTENT', 'Platzieren des Reglers');
define('SLIDER_RIGHT', 'In der rechten Spalte');
define('SLIDER_CONTENT_WIDTH', 'Nach Inhaltsbreite');
define('SLIDER_CONTENT_WIDTH_100', 'Nach Seitenbreite(100%)');

define('GENERAL_MODULES', 'Basisblöcke der Site');
define('HEADER_MODULES', 'Blöcke der Kappe');
define('LEFT_MODULES', 'Blöcke in der linken Spalte');
define('MAINPAGE_MODULES', 'Blöcke auf der Hauptseite');
define('FOOTER_MODULES', 'Kellerblöcke');
define('OTHER_MODULES', 'Andere Blöcke');

#from c\templates\solo\boxes\configuration.php:
define('ARTICLE_NAME', 'Article name');
define('TOPIC_NAME', 'Topic name');
define('LIMIT', 'Limit');
define('LIMIT_MOBILE', 'Limit Sie Mobile');
define('COLS', 'Number of columns');
define('SLIDER_WIDTH_TITLE', 'Breite');   
define('SLIDER_HEIGHT_TITLE', 'Höhe');
define('SLIDER_HEIGHT_MOBILE_TITLE', 'Höhe Sie Mobile');     
define('SLIDER_AUTOPLAY_TITLE', 'Auto Scroll');
define('SLIDER_AUTOPLAY_DELAY_TITLE', 'Auto Scroll Delay');

#from BD table infobox_configuration:

##FOOTER BOXES
define('F_ARTICLES_BOTTOM', 'Artikel im Keller');
define('F_FOOTER_CATEGORIES_MENU', 'Kategorien im Keller');
define('F_TOP_LINKS', 'Infopage im Keller');
define('F_MONEY_SYSTEM', 'Zahlungssysteme anzeigen');
define('F_SOCIAL', 'Zeige soziale Netzwerke in der Fußzeile');
define('F_CONTACTS_FOOTER', 'Kontakte in der Fußzeile anzeigen');
define('F_WEB_STUDIO_LINK', 'Link zum Dienstanbieter');
define('TEXT_UNAVAILABLE_IN_FREE_PACKAGE', 'Nicht im kostenlosen Paket verfügbar');

##HEADER BOXES
define('H_LOGIN', 'Login');
define('H_LOGO', 'Logo');
define('H_COMPARE', 'Vergleich');
define('H_LANGUAGES', 'Sprachen');
define('H_CURRENCIES', 'Währung');
define('H_ONLINE', 'Online-Berater anzeigen');
define('H_SEARCH', 'Suche');
define('H_SHOPPING_CART', 'Papierkorb');
define('H_WISHLIST', 'Wunschliste');
define('H_TEMPLATE_SELECT', 'Template Auswahl');
define('H_TOP_MENU', 'Kategorie-Menü');
define('H_TOP_MENU_MOBILE', 'Mobile Kategorie Menü');
define('H_CALLBACK', 'Ruf mich zurück');
define('H_TOP_LINKS', 'Hauptmenü');
define('H_TOGGLE_MOBILE_VISIBLE', 'Sichtbarkeit der Kategorie');
define('H_LOGIN_FB', 'Login über Facebook anzeigen');


##OTHER_MODULES
/* define('O_LOGIN', 'Login');
define('O_INFORMATION', 'Information');
define('O_TEMPLATE_SELECT', 'Template Auswahl');
define('O_SHOPPING_CART', 'Papierkorb');
define('O_SEARCH', 'Suche');
define('O_ONLINE', 'Online-Chat');
define('O_COMPARE', 'Vergleich');
define('O_CURRENCIES', 'Währung');
define('O_LANGUAGES', 'Sprachen');
define('O_TOP_LINKS', 'Hauptmenü');
define('O_CALLBACK', 'Ruf mich zurück');
define('O_TOP_MENU', 'Kategorie menu'); */
define('O_FILTER', 'Filter');
define('LIST_FILTER', 'Filter');

##LEFT_MODULES
define('L_FEATURED', 'Empfohlen');
define('L_WHATS_NEW', 'Neu');
define('L_SPECIALS', 'Rabatte');
define('L_MANUFACTURERS', 'Hersteller');
define('L_BESTSELLERS', 'Top Sales');
define('L_ARTICLES', 'Artikel');
define('L_POLLS', 'Umfragen');
define('L_FILTER', 'Filter');
define('L_BANNER_1', 'Banner 1');
define('L_BANNER_2', 'Banner2');
define('L_BANNER_3', 'Banner 3');
define('L_SUPER', 'Kategorien');
define('L_SUPER_TOPIC', 'Abschnitte von Artikeln');

##MAINPAGE_MODULES
define('M_ARTICLES_MAIN', 'Nachrichten');
define('M_BANNER_LONG', 'Banner long');
define('M_BEST_SELLERS', 'Top Sales');
define('M_BROWSE_CATEGORY', 'Kategorien');
define('M_DEFAULT_SPECIALS', 'Rabatte');
define('M_FEATURED', 'Recommended');
define('M_LAST_COMMENTS', 'Letzte Kommentare');
define('M_VIEW_PRODUCTS', 'Angesehene Artikel');
define('M_MAINPAGE', 'Haupttext');
define('M_MANUFACTURERS', 'Hersteller');
define('M_MOST_VIEWED', 'Draufsichten');
define('M_NEW_PRODUCTS', 'Neuheiten');
define('M_SLIDE_MAIN', 'Slider');
define('M_BANNER_1', 'Banner 1');
define('M_CATEGORIES_TABS', 'Categories tabs');
define('M_CATEGORIES_TABS_NEW', 'New');
define('M_CATEGORIES_TABS_FEATURED', 'Featured');
define('M_CATEGORIES_TABS_SPECIAL', 'Specials');
define('M_CATEGORIES_TABS_BEST_SELLERS', 'Spitzenverkäufe');
define('M_CATEGORIES_TABS_NEW_PRODUCTS', 'Neue Artikel');
define('M_SUBSCRIBE', 'Abonnieren Sie einen neuen Newsletter');
define('M_SUBSCRIBE_SPECIAL', 'Abo-Rabatt');
define('M_SUBSCRIBE_SPECIAL_PERCENT', 'Prozentrabatt %');
define('M_SUBSCRIBE_COUPONE_MAIL', 'Gutschein einreichen');
define('M_SUBSCRIBE_COUPONE', 'Coupon');

##MAINPAGE_MODULES
define('G_HEADER_1', 'Horizontaler Streifen in Kappe 1');
define('G_HEADER_2', 'Horizontaler Streifen in Kappe 2');
define('G_LEFT_COLUMN', 'linke Spalte');
define('G_FOOTER_1', 'Horizontaler Streifen an der Unterseite 1');
define('G_FOOTER_2', 'Horizontaler Streifen an der Unterseite 2');
define('M_BANNER_BLOCK', 'Doppelbanner auf der Hauptseite');


##MAINCONF
define('ADD_MODULE_MODULES', 'Modul hinzufügen');
define('MAINCONF_MODULES', 'Grundeinstellungen');
define('MC_COLOR_1', 'Textfarbe');
define('MC_COLOR_2', 'Linkfarbe');
define('MC_COLOR_3', 'Hintergrundfarbe');
define('MC_COLOR_4', 'Caps Hintergrund');
define('MC_COLOR_5', 'Kellerhintergrund');
define('MC_COLOR_6', 'Tastenfarbe');
define('MC_COLOR_BTN_TEXT', 'Button text');
define('MC_COLOR_GREY', 'Grey elements');
define('MC_SHOW_LEFT_COLUMN', 'Linke Spalte ein- / ausblenden');
define('MC_PRODUCT_QNT_IN_ROW', 'Produktlimit in Reihe');
define('MAX_DISPLAY_SEARCH_RESULTS_TITLE', 'Produktlimit auf Seite');
define('MC_THUMB_WIDTH', 'Daumenbreite');
define('MC_THUMB_HEIGHT', 'Daumengehicht');
define('H_LOGO_WIDTH', 'Logobreite');
define('H_LOGO_HEIGHT', 'Logohöhe');
define('H_LOGO_WIDTH_MOBILE', 'Logobreite (mobile)');
define('H_LOGO_HEIGHT_MOBILE', 'Logohöhe (mobile)');
define('MC_SHOW_THUMB2', 'Zeige zweites Bild bei Hover');
define('MC_THUMB_FIT', 'Bild passt');

define('MAX_DISPLAY_SEARCH_RESULTS_TITLE_INFO', 'Geben Sie die gewünschte Anzahl Produkte pro Seite an');
define('CONTENT_WIDTH_INFO', 'Wählen Sie die Inhaltsbreite aus den vorgeschlagenen Optionen aus');
define('MC_PRODUCT_QNT_IN_ROW_INFO', 'Geben Sie die gewünschte Anzahl von Artikeln pro Zeile an');
define('MC_THUMB_HEIGHT_INFO', 'Geben Sie die Höhe des kleinen Bildes an');
define('MC_THUMB_WIDTH_INFO', 'Geben Sie die Breite des kleinen Bildes an');
define('MC_SHOW_LEFT_COLUMN_INFO', 'Sie können die Anzeige der linken Inhaltsspalte aktivieren/deaktivieren');
define('MC_LOGO_WIDTH_INFO', 'Geben Sie die Breite Ihres Website-Logos an');
define('MC_LOGO_HEIGHT_INFO', 'Geben Sie die Höhe Ihres Website-Logos an');
define('MC_PRODUCT_MARGIN_INFO', 'Sie können den gewünschten Abstand zwischen den Produkten angeben');
define('LIST_DISPLAY_TYPE_INFO', 'Sie können das Ausgabeformat des Produkts angeben: Liste - Liste, Spalten - Tabelle');
define('MC_THUMB_FIT_INFO', 'Wählen Sie den gewünschten Wert: enthalten - behält die Proportionen des Bildes bei, bedecken - skaliert das Bild auf den gesamten Block');
define('MC_SHOW_THUMB2_INFO', 'Sie können den Effekt des Wechselns von einem Bild zu einem anderen ein- und ausschalten, wenn Sie mit der Maus darüber fahren');
define('MC_COLOR_1_INFO', 'Klicken Sie auf die Palette, um die Textfarbe für Ihre Website zu ändern');
define('MC_COLOR_4_INFO', 'Klicken Sie auf die Palette, um den Hintergrund des Website-Headers zu ändern');
define('MC_COLOR_5_INFO', 'Klicken Sie auf die Palette, um den Hintergrund der Fußzeile zu ändern');
define('MC_COLOR_2_INFO', 'Klicken Sie auf die Palette, um die Farbe Ihrer Website-Links zu ändern');
define('MC_COLOR_6_INFO', 'Klicken Sie auf die Palette, um die Farbe der Website-Schaltflächen zu ändern');
define('MC_COLOR_3_INFO', 'Klicken Sie auf die Palette, um die Hintergrundfarbe Ihrer Website zu ändern');
define('MC_COLOR_BTN_TEXT_INFO', 'Klicken Sie auf die Palette, um die Textfarbe für die Schaltflächen zu ändern');
define('MC_COLOR_GREY_INFO', 'Klicken Sie auf die Palette, um die Farbe der grauen Elemente zu ändern');

define('MAX_DISPLAY_SEARCH_RESULTS_TITLE_INFO_DEL', 'Wert löschen');
define('MAX_DISPLAY_SEARCH_RESULTS_TITLE_INFO_ADD', 'Mehrwert');
define('MC_PRODUCT_QNT_IN_ROW_INFO_0', 'Telefon < 768px. Der Wert \'3\' ist gleich \'2\' wenn ≤ 480px');
define('MC_PRODUCT_QNT_IN_ROW_INFO_1', 'Tablet (vertikal) < 992px');
define('MC_PRODUCT_QNT_IN_ROW_INFO_2', 'Tablet (horizontal) < 1200px');
define('MC_PRODUCT_QNT_IN_ROW_INFO_3', 'Anzeige < 1600px');
define('MC_PRODUCT_QNT_IN_ROW_INFO_4', 'Anzeige ≥ 1600px');

##LISTING
define('LISTING_MODULES', 'Produktauflistung');
define('LIST_MODEL', 'Produktmodell anzeigen');
define('LIST_BREADCRUMB', 'Zeige Semmelbrösel');
define('LIST_CONCLUSION', 'Produktausgabeformat anzeigen');
define('LIST_QUANTITY_PAGE', 'Zeigen Sie die Anzahl der Produkte auf der Seite an');
define('LIST_SORTING', 'Warensortierung anzeigen');
define('LIST_LOAD_MORE', 'Schaltfläche "Mehr anzeigen" anzeigen');
define('LIST_NUMBER_OF_ROWS', 'Paginierung anzeigen');
define('LIST_PRESENCE', 'Produktverfügbarkeit anzeigen');
define('LIST_LABELS', 'Etiketten anzeigen');


##PRODUCT_INFO
define('PRODUCT_INFO_MODULES', 'Produktseite');
define('P_MODEL', 'Produktmodell anzeigen');
define('P_BREADCRUMB', 'Zeige Semmelbrösel');
define('P_SOCIAL_LIKE', 'Zeigen Sie Likes über soziale Netzwerke');
define('P_PRESENCE', 'Produktverfügbarkeit anzeigen');
define('P_BUY_ONE_CLICK', 'Show "Mit einem Klick kaufen"');
define('P_ATTRIBUTES', 'Produktattribute anzeigen');
define('P_SHARE', 'In sozialen Netzwerken teilen');
define('P_COMPARE', 'Vergleichsmarke anzeigen');
define('P_WISHLIST', 'Merkzettel anzeigen');
define('P_RATING', 'Produktbewertung anzeigen');
define('P_SHORT_DESCRIPTION', 'Kurze Beschreibung anzeigen');
define('P_RIGHT_SIDE', 'Zeige rechte Spalte');
define('P_TAB_DESCRIPTION', 'Registerkarte Beschreibung anzeigen');
define('P_TAB_CHARACTERISTICS', 'Registerkarte "Feature" anzeigen');
define('P_TAB_COMMENTS', 'Tab "Kommentare" anzeigen');
define('P_TAB_PAYMENT_SHIPPING', 'Zeigen Sie die Registerkarte Zahlung und Lieferung an');
define('P_WARRANTY', 'Garantie');
define('P_DRUGIE', 'Ähnliche Produkte anzeigen');
define('P_XSELL', 'Ähnliche Produkte anzeigen');
define('P_SHOW_QUANTITY_INPUT', 'Feld "Warenmenge" anzeigen');
define('P_FILTER', 'Filter');
define('P_BETTER_TOGETHER', 'Block "Besser zusammen anzeigen"');
define('LIST_SHOW_PDF_LINK', 'PDF-Link anzeigen');
define('LIST_DISPLAY_TYPE', 'Produktausgabeformat');
define('INSTAGRAM_URL', 'Schieberegler');
define('M_INSTAGRAM', 'Instagram');
define('M_SEARCH_QUERIES', 'Suchanfragen');
define('SHOW_SHORTCUT_LEFT_TREE', 'Eingestürzten linken Baum anzeigen');
define('F_FOOTER_CATEGORIES', 'Kategorien in der Fußzeile');
define('P_SHOW_PROD_QTY_ON_PAGE', 'Restposten anzeigen');
define('P_LABELS', 'Show labels');
