<?php
/*
  $Id: template_configuration.php,v 1.2 2003/09/24 13:57:08 vadne Exp $

  osCommerce, Open Source řešení elektronického obchodu
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Vydáno pod GNU General Public License
*/

define('HEADING_TITLE', 'Přizpůsobení šablony');
define('TABLE_HEADING_TEMPLATE', 'Jméno');
define('TABLE_HEADING_TEMPLATE_FOLDER', 'Složka');
define('TABLE_HEADING_ACTION', 'Akce');
define('TABLE_HEADING_ACTIVE', 'Stav');
define('TABLE_HEADING_COLOR', 'Barva');
define('CONTENT_WIDTH', 'Šířka obsahu');
define('CONTENT_WIDTH_CONTENT', 'Maximální šířka 100 %');
define('CONTENT_WIDTH_FIX', 'Maximální šířka 1440 pixelů');
define('SHOW_SHORTCUT_TREE', 'Zobrazit podkategorie pouze pro aktuální kategorii');
define('SHOW_ALL_LABELS_ON_DESKTOP', 'Zobrazit všechny štítky na ploše');
define('SHOW_ALL_LABELS_ON_MOBILE', 'Zobrazit všechny štítky na mobilu');
define('SHOW_SPECIAL_LABEL_WITH_SPECIAL', 'Zobrazit speciální štítek, pokud existuje zvláštní');

define('TABLE_HEADING_DISPLAY_COLUMN_LEFT', 'Zobrazit levý sloupec?');
define('SLIDER_SIZE_CONTENT', 'Umístění posuvníku');
define('SLIDER_RIGHT', 'V pravém sloupci');
define('SLIDER_CONTENT_WIDTH', 'Podle šířky obsahu');
define('SLIDER_CONTENT_WIDTH_100', 'Šířka stránky (100%)');

define('GENERAL_MODULES', 'Hlavní bloky webu');
define('HEADER_MODULES', 'Bloky záhlaví');
define('LEFT_MODULES', 'Bloky v levém sloupci');
define('MAINPAGE_MODULES', 'Bloky na hlavní stránce');
define('FOOTER_MODULES', 'Zápatí bloky');
define('OTHER_MODULES', 'Další bloky');

#from c\templates\solo\boxes\configuration.php:
define('NAME_ARTICLE', 'Název článku');
define('TOPIC_NAME', 'Název tématu');
define('LIMIT', 'Limit');
define('LIMIT_MOBILE', 'Omezit mobilní zařízení');
define('COLS', 'Počet sloupců');
define('SLIDER_WIDTH_TITLE', 'Šířka');
define('SLIDER_HEIGHT_TITLE', 'Výška');
define('SLIDER_HEIGHT_MOBILE_TITLE', 'Mobilní výška');
define('SLIDER_AUTOPLAY_TITLE', 'Automatické posouvání');
define('SLIDER_AUTOPLAY_DELAY_TITLE', 'Prodleva automatického posouvání');

#from BD tabulka infobox_configuration:
##BOXY V ZÁPĚCH
define('F_ARTICLES_BOTTOM', 'Články v zápatí');
define('F_FOOTER_CATEGORIES_MENU', 'Kategorie v zápatí');
define('F_TOP_LINKS', 'Informační stránky v zápatí');
define('F_MONEY_SYSTEM', 'Zobrazit platební systémy');
define('F_SOCIAL', 'Zobrazit zápatí sociálních sítí');
define('F_CONTACTS_FOOTER', 'Zobrazit kontakty v patičce');
define('F_WEB_STUDIO_LINK', 'Odkaz na poskytovatele služeb');
define('TEXT_UNAVAILABLE_IN_FREE_PACKAGE', 'Není k dispozici v bezplatném balíčku');

## BOXY HLAVICE
define('H_LOGIN', 'Přihlášení');
define('H_LOGO', 'Logo');
define('H_COMPARE', 'Porovnání');
define('H_LANGUAGES', 'Jazyky');
define('H_CURRENCIES', 'Měna');
define('H_ONLINE', 'Zobrazit "Online poradce"');
define('H_SEARCH', 'Hledat');
define('H_SHOPPING_CART', 'Nákupní košík');
define('H_WISHLIST', 'Seznam přání produktů');
define('H_TEMPLATE_SELECT', 'Výběr šablony');
define('H_TOP_MENU', 'Nabídka kategorií');
define('H_TOP_MENU_MOBILE', 'Nabídka mobilních kategorií');
define('H_CALLBACK', 'Zpětné volání');
define('H_TOP_LINKS', 'Horní nabídka');
define('H_TOGGLE_MOBILE_VISIBLE', 'Viditelnost kategorie');
define('H_LOGIN_FB', 'Zobrazit přihlášení přes Facebook');

##OTHER_MODULES
/*define('O_LOGIN', 'Přihlášení');
define('O_TEMPLATE_SELECT', 'Výběr šablony');
define('O_SHOPPING_CART', 'Nákupní košík');
define('O_SEARCH', 'Hledat');
define('O_ONLINE', 'Online chat');
define('O_COMPARE', 'Porovnání');
define('O_CURRENCIES', 'Měna');
define('O_LANGUAGES', 'Jazyky');
define('O_TOP_LINKS', 'Horní nabídka');
define('O_CALLBACK', 'Zpětné volání');
define('O_TOP_MENU', 'Nabídka kategorií');*/
define('O_FILTER', 'Filtr');
define('LIST_FILTER', 'Filter');

##LEFT_MODULES
define('L_FEATURED', 'Vybrané');
define('L_WHATS_NEW', 'Co je nového');
define('L_SPECIALS', 'Speciály');
define('L_MANUFACTURERS', 'Výrobci');
define('L_BESTSELLERS', 'Nejprodávanější');
define('L_ARTICLES', 'Články');
define('L_POLLS', 'Ankety');
define('L_FILTER', 'Filtr');
define('L_BANNER_1', 'Banner 1');
define('L_BANNER_2', 'Banner 2');
define('L_BANNER_3', 'Banner 3');
define('L_SUPER', 'Kategorie');
define('L_SUPER_TOPIC', 'Téma');

##MAINPAGE_MODULES
define('M_ARTICLES_MAIN', 'Novinky');
define('M_BANNER_LONG', 'Banner long');
define('M_BEST_SELLERS', 'nejprodávanější');
define('M_BROWSE_CATEGORY', 'Kategorie');
define('M_DEFAULT_SPECIALS', 'Speciální položky');
define('M_FEATURED', 'Vybrané');
define('M_LAST_COMMENTS', 'Poslední komentáře');
define('M_VIEW_PRODUCTS', 'Zobrazené produkty');
define('M_MAINPAGE', 'Text hlavní stránky');
define('M_MANUFACTURERS', 'Výrobci');
define('M_MOST_VIEWED', 'Nejsledovanější');
define('M_NEW_PRODUCTS', 'Nový produkt');
define('M_SLIDE_MAIN', 'Posuvník');
define('M_BANNER_1', 'Banner 1');
define('M_CATEGORIES_TABS', 'Záložky kategorií');
define('M_CATEGORIES_TABS_NEW', 'Nové');
define('M_CATEGORIES_TABS_FEATURED', 'Vybrané');
define('M_CATEGORIES_TABS_SPECIAL', 'Speciální položky');
define('M_CATEGORIES_TABS_BEST_SELLERS', 'Nejprodávanější');
define('M_CATEGORIES_TABS_NEW_PRODUCTS', 'Nové položky');
define('M_SUBSCRIBE', 'Přihlásit se k odběru nového newsletteru');
define('M_SUBSCRIBE_SPECIAL', 'Sleva z předplatného');
define('M_SUBSCRIBE_SPECIAL_PERCENT', 'Procentuální sleva %');
define('M_SUBSCRIBE_COUPONE_MAIL', 'Odeslat kupón');
define('M_SUBSCRIBE_COUPONE', 'Kupón');

##MAINPAGE_MODULES
define('G_HEADER_1', 'Horizontální húvodní řádek 1');
define('G_HEADER_2', 'Vodorovný řádek záhlaví 2');
define('G_LEFT_COLUMN', 'Levý sloupec');
define('G_FOOTER_1', 'Horizontální řádek zápatí 1');
define('G_FOOTER_2', 'Vodorovný řádek zápatí 2');
define('M_BANNER_BLOCK', 'Dvojitý banner na hlavní stránce');


##MAINCONF
define('ADD_MODULE_MODULES', 'Přidat modul');
define('MAINCONF_MODULES', 'Základní nastavení');
define('MC_COLOR_1', 'Barva textu');
define('MC_COLOR_2', 'Barva odkazu');
define('MC_COLOR_3', 'Barva pozadí');
define('MC_COLOR_4', 'Pozadí velkých písmen');
define('MC_COLOR_5', 'Pozadí suterénu');
define('MC_COLOR_6', 'Barva tlačítka');
define('MC_COLOR_BTN_TEXT', 'Text tlačítka');
define('MC_COLOR_GREY', 'Šedé prvky');
define('MC_SHOW_LEFT_COLUMN', 'Zobrazit/skrýt levý sloupec');
define('MC_PRODUCT_QNT_IN_ROW', 'Limit produktů v řádku');
define('MC_PRODUCT_MARGIN','Marže mezi produkty');
define('MAX_DISPLAY_SEARCH_RESULTS_TITLE', 'Limit produktů na stránce');
define('MC_THUMB_WIDTH', 'Šířka palce');
define('MC_THUMB_HEIGHT', 'Výška palce');
define('H_LOGO_WIDTH', 'Šířka loga');
define('H_LOGO_HEIGHT', 'Výška loga');
define('H_LOGO_WIDTH_MOBILE', 'Šířka loga (mobile)');
define('H_LOGO_HEIGHT_MOBILE', 'Výška loga (mobile)');
define('MC_SHOW_THUMB2', 'Zobrazit druhý obrázek při umístění kurzoru');
define('MC_THUMB_FIT', 'Přizpůsobení obrázku');

define('MAX_DISPLAY_SEARCH_RESULTS_TITLE_INFO', 'Zadejte požadovaný počet produktů na stránku');
define('CONTENT_WIDTH_INFO', 'Vyberte šířku obsahu z navrhovaných možností');
define('MC_PRODUCT_QNT_IN_ROW_INFO', 'Zadejte požadovaný počet položek na řádek');
define('MC_THUMB_HEIGHT_INFO', 'Určete výšku malého obrázku');
define('MC_THUMB_WIDTH_INFO', 'Určete šířku malého obrázku');
define('MC_SHOW_LEFT_COLUMN_INFO', 'Můžete povolit / zakázat zobrazení levého sloupce obsahu');
define('MC_LOGO_WIDTH_INFO', 'Určete šířku loga vašeho webu');
define('MC_LOGO_HEIGHT_INFO', 'Určete výšku vašeho loga');
define('MC_PRODUCT_MARGIN_INFO', 'Můžete zadat požadované rozestupy mezi produkty');
define('LIST_DISPLAY_TYPE_INFO', 'Můžete určit výstupní formát produktu: seznam - seznam, sloupce - tabulka');
define('MC_THUMB_FIT_INFO', 'Vyberte požadovanou hodnotu: obsahovat - zachová proporce obrázku, obal - změní měřítko obrázku na celý blok');
define('MC_SHOW_THUMB2_INFO', 'Můžete povolit / zakázat efekt změny jednoho obrázku na jiný, když na něj najedete myší');
define('MC_COLOR_1_INFO', 'Klikněte na paletu pro změnu barvy textu pro vaši stránku');
define('MC_COLOR_4_INFO', 'Kliknutím na paletu změníte pozadí záhlaví webu');
define('MC_COLOR_5_INFO', 'Kliknutím na paletu změníte pozadí zápatí');
define('MC_COLOR_2_INFO', 'Kliknutím na paletu změníte barvu odkazů na své webové stránky');
define('MC_COLOR_6_INFO', 'Klikněte na paletu pro změnu barvy tlačítek webových stránek');
define('MC_COLOR_3_INFO', 'Klikněte na paletu pro změnu barvy pozadí vašeho webu');
define('MC_COLOR_BTN_TEXT_INFO', 'Klikněte na paletu pro změnu barvy textu tlačítek');
define('MC_COLOR_GREY_INFO', 'Klikněte na paletu pro změnu barvy šedých prvků');

define('MAX_DISPLAY_SEARCH_RESULTS_TITLE_INFO_DEL', 'Smazat hodnotu');
define('MAX_DISPLAY_SEARCH_RESULTS_TITLE_INFO_ADD', 'Přidaná hodnota');
define('MC_PRODUCT_QNT_IN_ROW_INFO_0', 'Telefon < 768px. Hodnota \'3\' se rovná \'2\', pokud je ≤ 480 pixelů');
define('MC_PRODUCT_QNT_IN_ROW_INFO_1', 'Tablet (svisle) < 992 pixelů');
define('MC_PRODUCT_QNT_IN_ROW_INFO_2', 'Tablet (vodorovně) < 1200 pixelů');
define('MC_PRODUCT_QNT_IN_ROW_INFO_3', 'Displej < 1600 pixelů');
define('MC_PRODUCT_QNT_IN_ROW_INFO_4', 'Displej ≥ 1600 pixelů');

##SEZNAM
define('LISTING_MODULES', 'Seznam produktů');
define('LIST_MODEL', 'Zobrazit model produktů');
define('LIST_BREADCRUMB', 'Zobrazit drobky');
define('LIST_CONCLUSION', 'Zobrazit výstupní formát produktu');
define('LIST_QUANTITY_PAGE', 'Zobrazit počet produktů na stránce');
define('LIST_SORTING', 'Zobrazit řazení zboží');
define('LIST_LOAD_MORE', 'Zobrazit tlačítko "Zobrazit více"');
define('LIST_NUMBER_OF_ROWS', 'Zobrazit stránkování');
define('LIST_PRESENCE', 'Zobrazit dostupnost produktu');
define('LIST_LABELS', 'Zobrazit štítky');

##PRODUCT_INFO
define('PRODUCT_INFO_MODULES', 'Stránka produktu');
define('P_MODEL', 'Zobrazit model produktů');
define('P_BREADCRUMB', 'Zobrazit drobky');
define('P_SOCIAL_LIKE', 'Zobrazit lajky prostřednictvím sociálních sítí');
define('P_PRESENCE', 'Zobrazit dostupnost produktu');
define('P_BUY_ONE_CLICK', 'Zobrazit "Nakupte jedním kliknutím"');
define('P_ATTRIBUTES', 'Zobrazit atributy produktu');
define('P_SHARE', 'Zobrazit sdílení na sociálních sítích');
define('P_COMPARE', 'Zobrazit značku porovnání');
define('P_WISHLIST', 'Zobrazit značku seznamu přání');
define('P_RATING', 'Zobrazit hodnocení produktu');
define('P_SHORT_DESCRIPTION', 'Zobrazit krátký popis');
define('P_RIGHT_SIDE', 'Zobrazit pravý sloupec');
define('P_TAB_DESCRIPTION', 'Zobrazit kartu popisu');
define('P_TAB_CHARACTERISTICS', 'Zobrazit kartu charakteristik');
define('P_TAB_COMMENTS', 'Zobrazit kartu komentářů');
define('P_TAB_PAYMENT_SHIPPING', 'Zobrazit kartu platby a doručení');
define('P_WARRANTY', 'Záruka');
define('P_DRUGIE', 'Zobrazit podobné produkty');
define('P_XSELL', 'Zobrazit související produkty');
define('P_SHOW_QUANTITY_INPUT', 'Zobrazit pole "Množství zboží"');
define('P_FILTER', 'Filtr');
define('P_BETTER_TOGETHER', 'Ukázat blok Better Together');
define('LIST_SHOW_PDF_LINK', 'Zobrazit odkaz PDF');
define('LIST_DISPLAY_TYPE', 'Výstupní formát produktu');
define('INSTAGRAM_URL', 'Odkaz posuvníku');
define('M_INSTAGRAM', 'Instagram');
define('M_SEARCH_QUERIES', 'Statistika požadavků na vyhledávání');
define('SHOW_SHORTCUT_LEFT_TREE', 'Zobrazit sbalený levý strom');
define('F_FOOTER_CATEGORIES', 'Kategorie v zápatí');
define('P_SHOW_PROD_QTY_ON_PAGE', 'Zobrazit zbývající zásoby');
define('P_LABELS', 'Zobrazit štítky');