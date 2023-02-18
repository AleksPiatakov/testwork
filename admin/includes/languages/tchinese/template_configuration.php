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
define('SHOW_ALL_LABELS_ON_DESKTOP', 'Show all labels on desktop');
define('SHOW_ALL_LABELS_ON_MOBILE', 'Show all labels on mobile');
define('SHOW_SPECIAL_LABEL_WITH_SPECIAL', 'Show special label when exist special');

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
define('F_WEB_STUDIO_LINK', 'Link to service provider');
define('TEXT_UNAVAILABLE_IN_FREE_PACKAGE', 'Not available in free package');

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
define('M_SUBSCRIBE', 'Subscribe to a new newsletter');
define('M_SUBSCRIBE_SPECIAL', 'Subscription Discount');
define('M_SUBSCRIBE_SPECIAL_PERCENT', 'Percentage discount %');
define('M_SUBSCRIBE_COUPONE_MAIL', 'Submit Coupon');
define('M_SUBSCRIBE_COUPONE', 'Coupon');

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
define('H_LOGO_WIDTH', 'Logo width');
define('H_LOGO_HEIGHT', 'Logo height');
define('H_LOGO_WIDTH_MOBILE', 'Logo width (mobile)');
define('H_LOGO_HEIGHT_MOBILE', 'Logo height (mobile)');
define('MC_SHOW_THUMB2', 'Show second image on hover');
define('MC_THUMB_FIT', 'Image fit');

define('MAX_DISPLAY_SEARCH_RESULTS_TITLE_INFO', 'Specify the desired number of products per page');
define('CONTENT_WIDTH_INFO', 'Select the content width from the suggested options');
define('MC_PRODUCT_QNT_IN_ROW_INFO', 'Specify the desired number of items per line');
define('MC_THUMB_HEIGHT_INFO', 'Specify the height of the small image');
define('MC_THUMB_WIDTH_INFO', 'Specify the width of the small image');
define('MC_SHOW_LEFT_COLUMN_INFO', 'You can enable / disable the display of the left column of content');
define('MC_LOGO_WIDTH_INFO', 'Specify the width of your website logo');
define('MC_LOGO_HEIGHT_INFO', 'Specify the height of your logo');
define('MC_PRODUCT_MARGIN_INFO', 'You can specify the desired spacing between products');
define('LIST_DISPLAY_TYPE_INFO', 'You can specify the product output format: list - list, columns - table');
define('MC_THUMB_FIT_INFO', 'Select the desired value: contain - maintains the proportions of the image, cover - scales the image to the entire block');
define('MC_SHOW_THUMB2_INFO', 'You can enable / disable the effect of changing one image to another when you hover over it');
define('MC_COLOR_1_INFO', 'Click on the palette to change the text color for your site');
define('MC_COLOR_4_INFO', 'Click on the palette to change the background of the site header');
define('MC_COLOR_5_INFO', 'Click on the palette to change the background of the footer');
define('MC_COLOR_2_INFO', 'Click on the palette to change the color of your website links');
define('MC_COLOR_6_INFO', 'Click on the palette to change the color of the website buttons');
define('MC_COLOR_3_INFO', 'Click on the palette to change the background color of your website');
define('MC_COLOR_BTN_TEXT_INFO', 'Click on the palette to change the text color for the buttons');
define('MC_COLOR_GREY_INFO', 'Click on the palette to change the color of the gray elements');

define('MAX_DISPLAY_SEARCH_RESULTS_TITLE_INFO_DEL', '删除值');
define('MAX_DISPLAY_SEARCH_RESULTS_TITLE_INFO_ADD', '增加价值');
define('MC_PRODUCT_QNT_IN_ROW_INFO_0', '电话 < 768px。 如果 ≤ 480px，则值 \'3\' ​​等于 \'2\'');
define('MC_PRODUCT_QNT_IN_ROW_INFO_1', '平板电脑（垂直）< 992px');
define('MC_PRODUCT_QNT_IN_ROW_INFO_2', '平板电脑（水平）< 1200px');
define('MC_PRODUCT_QNT_IN_ROW_INFO_3', '显示 < 1600px');
define('MC_PRODUCT_QNT_IN_ROW_INFO_4', '显示 ≥ 1600px');

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
define('LIST_LABELS', 'Show labels');

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
define('SHOW_SHORTCUT_LEFT_TREE', '显示折叠的左侧树');
define('F_FOOTER_CATEGORIES', '页脚中的类别');
define('P_SHOW_PROD_QTY_ON_PAGE', '顯示剩餘庫存');
define('P_LABELS', 'Show labels');