<?php
/*
  $Id: template_configuration.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Customizing Template');
define('TABLE_HEADING_TEMPLATE', 'Name');
define('TABLE_HEADING_TEMPLATE_FOLDER', 'Folder');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_ACTIVE', 'Status');
define('TABLE_HEADING_COLOR', 'Color');
define('CONTENT_WIDTH', 'Content width');
define('CONTENT_WIDTH_CONTENT', 'Maximum width 100%');
define('CONTENT_WIDTH_FIX', 'Maximum width 1440 pixels');
define('SHOW_SHORTCUT_TREE', 'Show subcategories only for the current category');
define('SHOW_ALL_LABELS_ON_DESKTOP', 'Az összes címke megjelenítése az asztalon');
define('SHOW_ALL_LABELS_ON_MOBILE', 'Az összes címke megjelenítése mobilon');
define('SHOW_SPECIAL_LABEL_WITH_SPECIAL', 'Speciális címke megjelenítése, ha különleges létezik');

define('TABLE_HEADING_DISPLAY_COLUMN_LEFT', 'Show left column?');
define('SLIDER_SIZE_CONTENT', 'Placing a slider');
define('SLIDER_RIGHT', 'In right column');
define('SLIDER_CONTENT_WIDTH', 'By content width');
define('SLIDER_CONTENT_WIDTH_100', 'Page Width(100%)');

define('GENERAL_MODULES', 'The main blocks of the site');
define('HEADER_MODULES', 'Header blocks');
define('LEFT_MODULES', 'Blocks in left column');
define('MAINPAGE_MODULES', 'Blocks on the main page');
define('FOOTER_MODULES', 'Footer blocks');
define('OTHER_MODULES', 'Other blocks');

#from c\templates\solo\boxes\configuration.php:
define('ARTICLE_NAME', 'Article name');
define('TOPIC_NAME', 'Topic name');
define('LIMIT', 'Limit');
define('LIMIT_MOBILE', 'Limit Mobile');
define('COLS', 'Number of columns');
define('SLIDER_WIDTH_TITLE', 'Width');   
define('SLIDER_HEIGHT_TITLE', 'Height');
define('SLIDER_HEIGHT_MOBILE_TITLE', 'Mobile Height');     
define('SLIDER_AUTOPLAY_TITLE', 'Auto scroll');
define('SLIDER_AUTOPLAY_DELAY_TITLE', 'Auto scroll delay');

#from BD table infobox_configuration:

##FOOTER BOXES
define('F_ARTICLES_BOTTOM', 'Articles in footer');
define('F_FOOTER_CATEGORIES_MENU', 'Categories in footer');
define('F_TOP_LINKS', 'Infopages in footer');
define('F_MONEY_SYSTEM', 'Show payment systems');
define('F_SOCIAL', 'Show footer social networks');
define('F_CONTACTS_FOOTER', 'Show contacts in footer');
define('F_WEB_STUDIO_LINK', 'Hivatkozás a szolgáltatóhoz');
define('TEXT_UNAVAILABLE_IN_FREE_PACKAGE', 'Nem elérhető ingyenes csomagban');

##HEADER BOXES
define('H_LOGIN', 'Login');
define('H_LOGO', 'Logo');
define('H_COMPARE', 'Comparison');
define('H_LANGUAGES', 'Languages');
define('H_CURRENCIES', 'Currency');
define('H_ONLINE', 'Show "Online Consultant"');
define('H_SEARCH', 'Search');
define('H_SHOPPING_CART', 'Shop cart');
define('H_WISHLIST', 'Products Wishlist');
define('H_TEMPLATE_SELECT', 'Template Selection');
define('H_TOP_MENU', 'Category menu');
define('H_TOP_MENU_MOBILE', 'Mobile category menu');
define('H_CALLBACK', 'Callback');
define('H_TOP_LINKS', 'Top menu');
define('H_TOGGLE_MOBILE_VISIBLE', 'Category visibility');
define('H_LOGIN_FB', 'Show login via Facebook');

##OTHER_MODULES
/*define('O_LOGIN', 'Login');
define('O_TEMPLATE_SELECT', 'Template Selection');
define('O_SHOPPING_CART', 'Shop cart');
define('O_SEARCH', 'Search');
define('O_ONLINE', 'Online chat');
define('O_COMPARE', 'Comparison');
define('O_CURRENCIES', 'Currency');
define('O_LANGUAGES', 'Languages');
define('O_TOP_LINKS', 'Top menu');
define('O_CALLBACK', 'Callback');
define('O_TOP_MENU', 'Category menu');*/
define('O_FILTER', 'Filter');
define('LIST_FILTER', 'Filter');

##LEFT_MODULES
define('L_FEATURED', 'Featured');
define('L_WHATS_NEW', 'Whats new');
define('L_SPECIALS', 'Specials');
define('L_MANUFACTURERS', 'Manufacturers');
define('L_BESTSELLERS', 'Bestsellers');
define('L_ARTICLES', 'Articles');
define('L_POLLS', 'Polls');
define('L_FILTER', 'Filter');
define('L_BANNER_1', 'Banner 1');
define('L_BANNER_2', 'Banner 2');
define('L_BANNER_3', 'Banner 3');
define('L_SUPER', 'Category');
define('L_SUPER_TOPIC', 'Topic');

##MAINPAGE_MODULES
define('M_ARTICLES_MAIN', 'News');
define('M_BANNER_LONG', 'Banner long');
define('M_BEST_SELLERS', 'bestsellers');
define('M_BROWSE_CATEGORY', 'Category');
define('M_DEFAULT_SPECIALS', 'Specials');
define('M_FEATURED', 'Featured');
define('M_LAST_COMMENTS', 'Last comments');
define('M_VIEW_PRODUCTS', 'Viewed products');
define('M_MAINPAGE', 'Main page text');
define('M_MANUFACTURERS', 'Manufacturers');
define('M_MOST_VIEWED', 'Most viewed');
define('M_NEW_PRODUCTS', 'New product');
define('M_SLIDE_MAIN', 'Slider');
define('M_BANNER_1', 'Banner 1');
define('M_CATEGORIES_TABS', 'Categories tabs');
define('M_CATEGORIES_TABS_NEW', 'New');
define('M_CATEGORIES_TABS_FEATURED', 'Featured');
define('M_CATEGORIES_TABS_SPECIAL', 'Specials');
define('M_CATEGORIES_TABS_BEST_SELLERS', 'Top sales');
define('M_CATEGORIES_TABS_NEW_PRODUCTS', 'New items');
define('M_SUBSCRIBE', 'Iratkozzon fel egy új hírlevélre');
define('M_SUBSCRIBE_SPECIAL', 'Előfizetési kedvezmény');
define('M_SUBSCRIBE_SPECIAL_PERCENT', 'Százalékos kedvezmény %');
define('M_SUBSCRIBE_COUPONE_MAIL', 'Kupon beküldése');
define('M_SUBSCRIBE_COUPONE', 'Kupon');

##MAINPAGE_MODULES
define('G_HEADER_1', 'Horisontal header line 1');
define('G_HEADER_2', 'Horisontal header line 2');
define('G_LEFT_COLUMN', 'Left column');
define('G_FOOTER_1', 'Horisontal footer line 1');
define('G_FOOTER_2', 'Horisontal footer line 2');
define('M_BANNER_BLOCK', 'Double banner on the main');


##MAINCONF
define('ADD_MODULE_MODULES', 'Add module');
define('MAINCONF_MODULES', 'Basic settings');
define('MC_COLOR_1', 'Text color');
define('MC_COLOR_2', 'Link Color');
define('MC_COLOR_3', 'Background color');
define('MC_COLOR_4', 'Caps background');
define('MC_COLOR_5', 'Basement background');
define('MC_COLOR_6', 'Button color');
define('MC_COLOR_BTN_TEXT', 'Button text');
define('MC_COLOR_GREY', 'Grey elements');
define('MC_SHOW_LEFT_COLUMN', 'Show/hide left column');
define('MC_PRODUCT_QNT_IN_ROW', 'Products limit in row');
define('MC_PRODUCT_MARGIN','Margin between products');
define('MAX_DISPLAY_SEARCH_RESULTS_TITLE', 'Products limit in page');
define('MC_THUMB_WIDTH', 'Thumb width');
define('MC_THUMB_HEIGHT', 'Thumb height');
define('H_LOGO_WIDTH', 'Logó szélessége');
define('H_LOGO_HEIGHT', 'Logó magassága');
define('H_LOGO_WIDTH_MOBILE', 'Logó szélessége (mobile)');
define('H_LOGO_HEIGHT_MOBILE', 'Logó magassága (mobile)');
define('MC_SHOW_THUMB2', 'Show second image on hover');
define('MC_THUMB_FIT', 'Image fit');

define('MAX_DISPLAY_SEARCH_RESULTS_TITLE_INFO', 'Adja meg az oldalankénti kívánt termékek számát');
define('CONTENT_WIDTH_INFO', 'Válassza ki a tartalom szélességét a javasolt lehetőségek közül');
define('MC_PRODUCT_QNT_IN_ROW_INFO', 'Adja meg az elemek kívánt számát soronként');
define('MC_THUMB_HEIGHT_INFO', 'Adja meg a kis kép magasságát');
define('MC_THUMB_WIDTH_INFO', 'Adja meg a kis kép szélességét');
define('MC_SHOW_LEFT_COLUMN_INFO', 'Engedélyezheti/letilthatja a bal oldali tartalomoszlop megjelenítését');
define('MC_LOGO_WIDTH_INFO', 'Adja meg webhelye logójának szélességét');
define('MC_LOGO_HEIGHT_INFO', 'Adja meg a logó magasságát');
define('MC_PRODUCT_MARGIN_INFO', 'Megadhatja a kívánt távolságot a termékek között');
define('LIST_DISPLAY_TYPE_INFO', 'Megadhatja a termék kimeneti formátumát: lista - lista, oszlopok - táblázat');
define('MC_THUMB_FIT_INFO', 'Válassza ki a kívánt értéket: tartalmaz - megtartja a kép arányait, borító - a képet a teljes blokkra méretezi');
define('MC_SHOW_THUMB2_INFO', 'Engedélyezheti/letilthatja az egyik kép másikra cserélésének hatását, ha rámutatja az egérmutatót');
define('MC_COLOR_1_INFO', 'Kattintson a palettára a webhely szövegszínének megváltoztatásához');
define('MC_COLOR_4_INFO', 'Kattintson a palettára a webhely fejlécének hátterének megváltoztatásához');
define('MC_COLOR_5_INFO', 'Kattintson a palettára a lábléc hátterének megváltoztatásához');
define('MC_COLOR_2_INFO', 'Kattintson a palettára a webhely hivatkozásainak színének megváltoztatásához');
define('MC_COLOR_6_INFO', 'Kattintson a palettára a weboldal gombjainak színének megváltoztatásához');
define('MC_COLOR_3_INFO', 'Kattintson a palettára a webhely háttérszínének megváltoztatásához');
define('MC_COLOR_BTN_TEXT_INFO', 'Kattintson a palettára a gombok szövegszínének megváltoztatásához');
define('MC_COLOR_GREY_INFO', 'Kattintson a palettára a szürke elemek színének megváltoztatásához');

define('MAX_DISPLAY_SEARCH_RESULTS_TITLE_INFO_DEL', 'Érték törlése');
define('MAX_DISPLAY_SEARCH_RESULTS_TITLE_INFO_ADD', 'Hozzáadott érték');
define('MC_PRODUCT_QNT_IN_ROW_INFO_0', 'Telefon < 768px. A \'3\' érték egyenlő \'2\'-val, ha ≤ 480px');
define('MC_PRODUCT_QNT_IN_ROW_INFO_1', 'Táblagép (függőleges) < 992px');
define('MC_PRODUCT_QNT_IN_ROW_INFO_2', 'Táblagép (vízszintes) < 1200px');
define('MC_PRODUCT_QNT_IN_ROW_INFO_3', 'Kijelző < 1600px');
define('MC_PRODUCT_QNT_IN_ROW_INFO_4', 'Kijelző ≥ 1600px');

##LISTING
define('LISTING_MODULES', 'Products listing');
define('LIST_MODEL', 'Show products model');
define('LIST_BREADCRUMB', 'Show bread crumbs');
define('LIST_CONCLUSION', 'Show product output format');
define('LIST_QUANTITY_PAGE', 'Show the number of products on the page');
define('LIST_SORTING', 'Show sorting of goods');
define('LIST_LOAD_MORE', 'Show "Show more" button');
define('LIST_NUMBER_OF_ROWS', 'Show pagination');
define('LIST_PRESENCE', 'Show product availability');
define('LIST_LABELS', 'Címkék megjelenítése');

##PRODUCT_INFO
define('PRODUCT_INFO_MODULES', 'Product page');
define('P_MODEL', 'Show products model');
define('P_BREADCRUMB', 'Show bread crumbs');
define('P_SOCIAL_LIKE', 'Show likes via social networks');
define('P_PRESENCE', 'Show product availability');
define('P_BUY_ONE_CLICK', 'Show "Buy in one click"');
define('P_ATTRIBUTES', 'Show product attributes');
define('P_SHARE', 'Show share on social networks');
define('P_COMPARE', 'Show comparison mark');
define('P_WISHLIST', 'Show wish list mark');
define('P_RATING', 'Show product rating');
define('P_SHORT_DESCRIPTION', 'Show short description');
define('P_RIGHT_SIDE', 'Show right column');
define('P_TAB_DESCRIPTION', 'Show description tab');
define('P_TAB_CHARACTERISTICS', 'Show characteristics tab');
define('P_TAB_COMMENTS', 'Show comments tab');
define('P_TAB_PAYMENT_SHIPPING', 'Show the payment and delivery tab');
define('P_WARRANTY', 'Warranty');
define('P_DRUGIE', 'Show similar products');
define('P_XSELL', 'Show related products');
define('P_SHOW_QUANTITY_INPUT', 'Show field "Quantity of goods"');
define('P_FILTER', 'Filter');
define('P_BETTER_TOGETHER', 'Show Better Together block');
define('LIST_SHOW_PDF_LINK', 'Show PDF-link');
define('LIST_DISPLAY_TYPE', 'Product output format');
define('INSTAGRAM_URL', 'Slider link');
define('M_INSTAGRAM', 'Instagram');
define('M_SEARCH_QUERIES', 'Statistics of search requests');
define('SHOW_SHORTCUT_LEFT_TREE', 'Összecsukott bal oldali fa megjelenítése');
define('F_FOOTER_CATEGORIES', 'Kategóriák a láblécben');
define('P_SHOW_PROD_QTY_ON_PAGE', 'A fennmaradó készlet megjelenítése');
define('P_LABELS', 'Címkék megjelenítése');
