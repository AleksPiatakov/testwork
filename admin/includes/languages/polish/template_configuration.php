<?php
/*
  $Id: template_configuration.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Konfiguracja szablonu');
define('TABLE_HEADING_TEMPLATE', 'Nazwa');
define('TABLE_HEADING_TEMPLATE_FOLDER', 'Folder');
define('TABLE_HEADING_ACTION', 'Działanie');
define('TABLE_HEADING_ACTIVE', 'Status');
define('TABLE_HEADING_COLOR', 'Kolor');
define('CONTENT_WIDTH', 'Szerokość treści');
define('CONTENT_WIDTH_CONTENT', 'Maksymalna szerokość 100%');
define('CONTENT_WIDTH_FIX', 'Maksymalna szerokość 1440 pikseli');
define('SHOW_SHORTCUT_TREE', 'Pokaż podkategorii tylko dla bieżącej kategorii');
define('SHOW_ALL_LABELS_ON_DESKTOP', 'Pokaż wszystkie etykiety na pulpicie');
define('SHOW_ALL_LABELS_ON_MOBILE', 'Pokaż wszystkie etykiety na urządzeniu mobilnym');
define('SHOW_SPECIAL_LABEL_WITH_SPECIAL', 'Pokaż specjalną etykietę, gdy istnieje specjalna');

define('TABLE_HEADING_DISPLAY_COLUMN_LEFT', 'Pokazywać lewą kolumnę?');
define('SLIDER_SIZE_CONTENT', 'Umieszczanie suwaka');
define('SLIDER_RIGHT', 'W prawej kolumnie');
define('SLIDER_CONTENT_WIDTH', 'Dopasuj do szerokości treści');
define('SLIDER_CONTENT_WIDTH_100', 'Dopasuj do szerokości strony(100%)');

define('GENERAL_MODULES', 'Główne moduły witryny');
define('HEADER_MODULES', 'Moduły nagłówka');
define('LEFT_MODULES', 'Moduły w lewej kolumnie');
define('MAINPAGE_MODULES', 'Moduły na stronie głównej');
define('FOOTER_MODULES', 'Moduły stopek ');
define('OTHER_MODULES', 'Inne moduły');

#from c\templates\solo\boxes\configuration.php:
define('ARTICLE_NAME', 'Article name');
define('TOPIC_NAME', 'Topic name');
define('LIMIT', 'Limit');
define('LIMIT_MOBILE','Limit Mobile');
define('COLS', 'Number of columns');
define('SLIDER_WIDTH_TITLE', 'Szerokość');   
define('SLIDER_HEIGHT_TITLE', 'Wysokość');
define('SLIDER_HEIGHT_MOBILE_TITLE', 'Wysokość Mobile'); 
define('SLIDER_AUTOPLAY_TITLE', 'Auto Scroll');
define('SLIDER_AUTOPLAY_DELAY_TITLE', 'Opóźnienie automatycznego przewijania');

#from BD table infobox_configuration:
##FOOTER BOXES
define('F_ARTICLES_BOTTOM', 'Artykuły w stopkach');
define('F_FOOTER_CATEGORIES_MENU', 'Kategorie w stopkach');        
define('F_TOP_LINKS', 'Infopages w stopkach');
define('F_MONEY_SYSTEM', 'Pokaż systemy płatności');
define('F_SOCIAL', 'Pokaż stopki sieci społecznościowych');
define('F_CONTACTS_FOOTER', 'Pokaż kontakty w stopce');
define('F_WEB_STUDIO_LINK', 'Link do usługodawcy');
define('TEXT_UNAVAILABLE_IN_FREE_PACKAGE', 'Niedostępne w darmowym pakiecie');

##HEADER BOXES
define('H_LOGIN', 'Login');
define('H_LOGO', 'Logo');
define('H_COMPARE', 'Porównanie');
define('H_LANGUAGES', 'Języki');
define('H_CURRENCIES', 'Waluta');
define('H_ONLINE', 'Pokaż konsultanta online');
define('H_SEARCH', 'Wyszukaj');
define('H_SHOPPING_CART', 'Koszyk');
define('H_WISHLIST', 'Lista życzeń');
define('H_TEMPLATE_SELECT', 'Wybór szablonu');
define('H_TOP_MENU', 'Menu kategorii');
define('H_TOP_MENU_MOBILE', 'Menu kategorii mobilnej');
define('H_CALLBACK', 'Napisz swój numer, a my oddzwonimy');
define('H_TOP_LINKS', 'Górne menu');
define('H_TOGGLE_MOBILE_VISIBLE', 'Widoczność kategorii');
define('H_LOGIN_FB', 'Pokaż login za pośrednictwem Facebooka');

##OTHER_MODULES
/*define('O_LOGIN', 'Login');
define('O_INFORMATION', 'Informacje');
define('O_TEMPLATE_SELECT', 'Wybór szablonu');
define('O_SHOPPING_CART', 'Koszyk');
define('O_SEARCH', 'Wyszukaj');
define('O_ONLINE', 'Czat na żywo');
define('O_COMPARE', 'Porównanie');
define('O_CURRENCIES', 'Waluta');
define('O_LANGUAGES', 'Języki');
define('O_TOP_LINKS', 'Górne menu');
define('O_CALLBACK', 'Napisz swój numer, a my oddzwonimy');
define('O_TOP_MENU', 'Menu kategorii');*/
define('O_FILTER', 'Filtry');
define('LIST_FILTER', 'Filtry');

##LEFT_MODULES
define('L_FEATURED', 'Polecane');
define('L_WHATS_NEW', 'Nowości');
define('L_SPECIALS', 'Rabaty');
define('L_MANUFACTURERS', 'Producenci');
define('L_BESTSELLERS', 'TOP sprzedaży');
define('L_ARTICLES', 'Artykuły');
define('L_POLLS', 'Ankiety');
define('L_FILTER', 'Filtry');
define('L_BANNER_1', 'Banner 1');
define('L_BANNER_2', 'Banner 2');
define('L_BANNER_3', 'Banner 3');
define('L_SUPER', 'Kategorie');
define('L_SUPER_TOPIC', 'Sekcje artykułów');

##MAINPAGE_MODULES
define('M_ARTICLES_MAIN', 'Aktualności');
define('M_BANNER_LONG', 'Banner long');
define('M_BEST_SELLERS', 'TOP sprzedaży');
define('M_BROWSE_CATEGORY', 'Kategorie');
define('M_DEFAULT_SPECIALS', 'Rabaty');
define('M_FEATURED', 'Polecane');
define('M_LAST_COMMENTS', 'Najnowsze komentarze');
define('M_VIEW_PRODUCTS', 'Oglądane produkty');
define('M_MAINPAGE', 'Tekst na głównej');
define('M_MANUFACTURERS', 'Producenci');
define('M_MOST_VIEWED', 'TOP wyświetleń');
define('M_NEW_PRODUCTS', 'Nowości');
define('M_SLIDE_MAIN', 'Suwak');
define('M_BANNER_1', 'Banner 1');
define('M_CATEGORIES_TABS', 'Categories tabs');
define('M_CATEGORIES_TABS_NEW', 'New');
define('M_CATEGORIES_TABS_FEATURED', 'Featured');
define('M_CATEGORIES_TABS_SPECIAL', 'Specials');
define('M_CATEGORIES_TABS_BEST_SELLERS', 'Najlepsza sprzedaż');
define('M_CATEGORIES_TABS_NEW_PRODUCTS', 'Nowe przedmioty');
define('M_SUBSCRIBE', 'Zapisz się do nowego newslettera');
define('M_SUBSCRIBE_SPECIAL', 'Zniżka na subskrypcję');
define('M_SUBSCRIBE_SPECIAL_PERCENT', 'Zniżka procentowa %');
define('M_SUBSCRIBE_COUPONE_MAIL', 'Prześlij kupon');
define('M_SUBSCRIBE_COUPONE', 'Kupon');

##MAINPAGE_MODULES
define('G_HEADER_1', 'Poziomy pasek w nagłówku 1');
define('G_HEADER_2', 'Poziomy pasek w nagłówku 2');
define('G_LEFT_COLUMN', 'Lewa kolumna');
define('G_FOOTER_1', 'Poziomy pasek w stopku 1');
define('G_FOOTER_2', 'Poziomy pasek w stopku 2');
define('M_BANNER_BLOCK', 'Podwójny baner na głównej');


##MAINCONF
define('ADD_MODULE_MODULES', 'Dodaj moduł');
define('MAINCONF_MODULES', 'Podstawowe ustawienia');
define('MC_COLOR_1', 'Kolor tekstu');
define('MC_COLOR_2', 'Kolor linku');
define('MC_COLOR_3', 'Kolor tła');
define('MC_COLOR_4', 'Czapki w tle');
define('MC_COLOR_5', 'Tło piwnicy');
define('MC_COLOR_6', 'Kolor przycisku');
define('MC_COLOR_BTN_TEXT', 'Button text');
define('MC_COLOR_GREY', 'Grey elements');
define('MC_SHOW_LEFT_COLUMN', 'Pokaż / ukryj lewą kolumnę');
define('MC_PRODUCT_QNT_IN_ROW', 'Limit produktów w rzędzie');   
define('MC_PRODUCT_MARGIN','Margin between products');
define('MAX_DISPLAY_SEARCH_RESULTS_TITLE', 'Limit produktów na stronie');
define('MC_THUMB_WIDTH', 'Szerokość kciuka');
define('MC_THUMB_HEIGHT', 'Wysokość kciuka');
define('H_LOGO_WIDTH', 'Szerokość logo');
define('H_LOGO_HEIGHT', 'Wysokość logo');
define('H_LOGO_WIDTH_MOBILE', 'Szerokość logo (mobile)');
define('H_LOGO_HEIGHT_MOBILE', 'Wysokość logo (mobile)');
define('MC_SHOW_THUMB2', 'Zmień obraz po najechaniu myszą');
define('MC_THUMB_FIT', 'Rozciągnięty obraz produktu');

define('MAX_DISPLAY_SEARCH_RESULTS_TITLE_INFO', 'Określ żądaną liczbę produktów na stronie');
define('CONTENT_WIDTH_INFO', 'Wybierz szerokość treści z sugerowanych opcji');
define('MC_PRODUCT_QNT_IN_ROW_INFO', 'Określ żądaną liczbę elementów w wierszu');
define('MC_THUMB_HEIGHT_INFO', 'Określ wysokość małego obrazu');
define('MC_THUMB_WIDTH_INFO', 'Określ szerokość małego obrazu');
define('MC_SHOW_LEFT_COLUMN_INFO', 'Możesz włączyć / wyłączyć wyświetlanie lewej kolumny treści');
define('MC_LOGO_WIDTH_INFO', 'Określ szerokość logo swojej witryny');
define('MC_LOGO_HEIGHT_INFO', 'Określ wysokość swojego logo');
define('MC_PRODUCT_MARGIN_INFO', 'Możesz określić żądane odstępy między produktami');
define('LIST_DISPLAY_TYPE_INFO', 'Możesz określić format wyjściowy produktu: lista - lista, kolumny - tabela');
define('MC_THUMB_FIT_INFO', 'Wybierz żądaną wartość: zawieraj - zachowuje proporcje obrazu, przykryj - skaluje obraz do całego bloku');
define('MC_SHOW_THUMB2_INFO', 'Możesz włączyć / wyłączyć efekt zmiany jednego obrazu na inny po najechaniu na niego kursorem');
define('MC_COLOR_1_INFO', 'Kliknij paletę, aby zmienić kolor tekstu na swojej stronie');
define('MC_COLOR_4_INFO', 'Kliknij paletę, aby zmienić tło nagłówka strony');
define('MC_COLOR_5_INFO', 'Kliknij paletę, aby zmienić tło stopki');
define('MC_COLOR_2_INFO', 'Kliknij paletę, aby zmienić kolor linków do Twojej witryny');
define('MC_COLOR_6_INFO', 'Kliknij paletę, aby zmienić kolor przycisków strony');
define('MC_COLOR_3_INFO', 'Kliknij paletę, aby zmienić kolor tła swojej witryny');
define('MC_COLOR_BTN_TEXT_INFO', 'Kliknij paletę, aby zmienić kolor tekstu przycisków');
define('MC_COLOR_GREY_INFO', 'Kliknij paletę, aby zmienić kolor szarych elementów');

define('MAX_DISPLAY_SEARCH_RESULTS_TITLE_INFO_DEL', 'Usuń wartość');
define('MAX_DISPLAY_SEARCH_RESULTS_TITLE_INFO_ADD', 'Dodać wartość');
define('MC_PRODUCT_QNT_IN_ROW_INFO_0', 'Telefon < 768px. Wartość \'3\' jest równa \'2\', jeśli ≤ 480px');
define('MC_PRODUCT_QNT_IN_ROW_INFO_1', 'Tablet (w pionie) < 992px');
define('MC_PRODUCT_QNT_IN_ROW_INFO_2', 'Tablet (poziomo) < 1200px');
define('MC_PRODUCT_QNT_IN_ROW_INFO_3', 'Wyświetlacz < 1600px');
define('MC_PRODUCT_QNT_IN_ROW_INFO_4', 'Wyświetlacz ≥ 1600px');

##LISTING
define('LISTING_MODULES', 'Lista towarów');
define('LIST_MODEL', 'Pokaż kod produktu');
define('LIST_BREADCRUMB', 'Pokaż okruchy chleba');
define('LIST_CONCLUSION', 'Pokaż format wyjściowy produktu');
define('LIST_QUANTITY_PAGE', 'Pokaż liczbę produktów na stronie');
define('LIST_SORTING', 'Pokaż sortowanie towarów');
define('LIST_LOAD_MORE', 'Pokaż przycisk „Pokaż więcej”');
define('LIST_NUMBER_OF_ROWS', 'Pokaż podział na strony');
define('LIST_PRESENCE', 'Pokaż dostępność produktu');
define('LIST_LABELS', 'Pokaż etykiety');

##PRODUCT_INFO
define('PRODUCT_INFO_MODULES', 'Strona produktu');
define('P_MODEL', 'Pokaż kod produktu');
define('P_BREADCRUMB', 'Pokaż okruchy chleba');
define('P_SOCIAL_LIKE', 'Pokaż lubi za pośrednictwem sieci społecznościowych');
define('P_PRESENCE', 'Pokaż dostępność produktu');
define('P_BUY_ONE_CLICK', 'Pokaż „Kup jednym kliknięciem”');
define('P_ATTRIBUTES', 'Pokaż atrybuty produktu');
define('P_SHARE', 'Pokaż udział w sieciach społecznościowych');
define('P_COMPARE', 'Pokaż znak porównania');
define('P_WISHLIST', 'Pokaż znak listy życzeń');
define('P_RATING', 'Pokaż ocenę produktu');
define('P_SHORT_DESCRIPTION', 'Pokaż krótki opis');
define('P_RIGHT_SIDE', 'Pokaż prawą kolumnę');
define('P_TAB_DESCRIPTION', 'Pokaż kartę opisu');
define('P_TAB_CHARACTERISTICS', 'Pokaż kartę funkcji');
define('P_TAB_COMMENTS', 'Pokaż kartę komentarzy');
define('P_TAB_PAYMENT_SHIPPING', 'Pokaż kartę płatności i dostawy');
define('P_WARRANTY', 'Gwarancja');
define('P_DRUGIE', 'Pokaż podobne produkty');
define('P_XSELL', 'Pokaż powiązane produkty');
define('P_SHOW_QUANTITY_INPUT', 'Pokaż pole „Ilość towarów”');
define('P_FILTER', 'Filtry');
define('P_BETTER_TOGETHER', 'Pokaż blok Razem lepiej');
define('LIST_SHOW_PDF_LINK', 'Pokaż łącze PDF');
define('LIST_DISPLAY_TYPE', 'Format wyjściowy produktu');
define('INSTAGRAM_URL', 'Link do suwaka');
define('M_INSTAGRAM', 'Instagram');
define('M_SEARCH_QUERIES', 'Zapytania');
define('SHOW_SHORTCUT_LEFT_TREE', 'Pokaż zwinięte lewe drzewo');
define('F_FOOTER_CATEGORIES', 'Kategorie w stopce');
define('P_SHOW_PROD_QTY_ON_PAGE', 'Pokaż pozostałe zapasy');
define('P_LABELS', 'Pokaż etykiety');