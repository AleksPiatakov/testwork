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
define('CONTENT_WIDTH', 'Ancho del contenido');
define('CONTENT_WIDTH_CONTENT', 'Ancho máximo 100%');
define('CONTENT_WIDTH_FIX', 'Ancho máximo 1440 píxeles');
define('SHOW_SHORTCUT_TREE', 'Mostrar subcategorías sólo para la categoría actual');
define('SHOW_ALL_LABELS_ON_DESKTOP', 'Mostrar todas las etiquetas en el escritorio');
define('SHOW_ALL_LABELS_ON_MOBILE', 'Mostrar todas las etiquetas en el móvil');
define('SHOW_SPECIAL_LABEL_WITH_SPECIAL', 'Mostrar etiqueta especial cuando exista especial');

define('TABLE_HEADING_DISPLAY_COLUMN_LEFT', 'Show left column?');
define('TEXT_SHOW_SLIDER_SIZE_CONTENT', 'Show slider for the entire width of the content?');

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
define('LIMIT_MOBILE','Limitar móvil');
define('COLS', 'Number of columns');
define('SLIDER_WIDTH_TITLE', 'Anchura');   
define('SLIDER_HEIGHT_TITLE', 'Altura');
define('SLIDER_HEIGHT_MOBILE_TITLE', 'Altura móvil'); 
define('SLIDER_AUTOPLAY_TITLE', 'Desplazamiento automático');
define('SLIDER_AUTOPLAY_DELAY_TITLE', 'Retraso de desplazamiento automático');

#from BD table infobox_configuration:

define('SLIDER_SIZE_CONTENT', 'Placing a slider');
define('SLIDER_CONTENT_WIDTH', 'By content width');
define('SLIDER_RIGHT', 'In right column');
define('SLIDER_CONTENT_WIDTH_100', 'Page Width(100%)');

##FOOTER BOXES
define('F_ARTICLES_BOTTOM', 'Articles in footer');
define('F_FOOTER_CATEGORIES_MENU', 'Categories in footer');
define('F_TOP_LINKS', 'Infopages in footer');
define('F_MONEY_SYSTEM', 'Mostrar sistemas de pago');
define('F_SOCIAL', 'Mostrar pie de página en las redes sociales');
define('F_CONTACTS_FOOTER', 'Mostrar contactos en el pie de página');
define('F_WEB_STUDIO_LINK', 'Enlace al proveedor de servicios');
define('TEXT_UNAVAILABLE_IN_FREE_PACKAGE', 'No disponible en paquete gratuito');

##HEADER BOXES
define('H_LOGIN', 'Login');
define('H_LOGO', 'Logo');
define('H_COMPARE', 'Comparison');
define('H_LANGUAGES', 'Languages');
define('H_CURRENCIES', 'Currency');
define('H_ONLINE', 'Mostrar consultor en línea');
define('H_SEARCH', 'Search');
define('H_SHOPPING_CART', 'Shop cart');
define('H_WISHLIST', 'Products Wishlist');
define('H_TEMPLATE_SELECT', 'Template Selection');
define('H_TOP_MENU', 'Category menu');
define('H_TOP_MENU_MOBILE', 'Menú de categoría móvil');
define('H_CALLBACK', 'Callback');
define('H_TOP_LINKS', 'Top menu');
define('H_TOGGLE_MOBILE_VISIBLE', 'Visibilidad de la categoría');
define('H_LOGIN_FB', 'Mostrar inicio de sesión a través de Facebook');

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
define('L_SUPER_TOPIC', 'Topics');

##MAINPAGE_MODULES
define('M_ARTICLES_MAIN', 'Noticias');
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
define('M_BANNER_BLOCK', 'Doble pancarta en la principal');
define('M_CATEGORIES_TABS', 'Categories tabs');
define('M_CATEGORIES_TABS_NEW', 'New');
define('M_CATEGORIES_TABS_FEATURED', 'Featured');
define('M_CATEGORIES_TABS_SPECIAL', 'Specials');
define('M_CATEGORIES_TABS_BEST_SELLERS', 'Top ventas');
define('M_CATEGORIES_TABS_NEW_PRODUCTS', 'Nuevos artículos');
define('M_SUBSCRIBE', 'Suscríbete a un nuevo boletín');
define('M_SUBSCRIBE_SPECIAL', 'Descuento de suscripción');
define('M_SUBSCRIBE_SPECIAL_PERCENT', 'Porcentaje de descuento %');
define('M_SUBSCRIBE_COUPONE_MAIL', 'Enviar cupón');
define('M_SUBSCRIBE_COUPONE', 'Cupón');

##MAINPAGE_MODULES
define('G_HEADER_1', 'Horisontal header line 1');
define('G_HEADER_2', 'Horisontal header line 2');
define('G_LEFT_COLUMN', 'Left column');
define('G_FOOTER_1', 'Horisontal footer line 1');
define('G_FOOTER_2', 'Horisontal footer line 2');



##MAINCONF
define('ADD_MODULE_MODULES', 'Agregar módulo');
define('MAINCONF_MODULES', 'Ajustes básicos');
define('MC_COLOR_1', 'Color del texto');
define('MC_COLOR_2', 'Color de enlace');
define('MC_COLOR_3', 'Color de fondo');
define('MC_COLOR_4', 'Fondo de tapas');
define('MC_COLOR_5', 'Fondo del sótano');
define('MC_COLOR_6', 'Color del botón');
define('MC_COLOR_BTN_TEXT', 'Button text');
define('MC_COLOR_GREY', 'Grey elements');
define('MC_SHOW_LEFT_COLUMN', 'Mostrar / ocultar columna izquierda');
define('MC_PRODUCT_QNT_IN_ROW', 'Límite de productos en fila');
define('MC_PRODUCT_MARGIN','Margin between products');
define('MAX_DISPLAY_SEARCH_RESULTS_TITLE', 'Límite de productos en la página');
define('MC_THUMB_WIDTH', 'Ancho del pulgar');
define('MC_THUMB_HEIGHT', 'Altura del pulgar');
define('H_LOGO_WIDTH', 'Ancho del logo');
define('H_LOGO_HEIGHT', 'Altura del logotipo');
define('H_LOGO_WIDTH_MOBILE', 'Ancho del logo (mobile)');
define('H_LOGO_HEIGHT_MOBILE', 'Altura del logotipo (mobile)');
define('MC_SHOW_THUMB2', 'Cambiar imagen al pasar el mouse');
define('MC_THUMB_FIT', 'Estirar la imagen del producto');

define('MAX_DISPLAY_SEARCH_RESULTS_TITLE_INFO', 'Especifique el número deseado de productos por página');
define('CONTENT_WIDTH_INFO', 'Seleccione el ancho del contenido de las opciones sugeridas');
define('MC_PRODUCT_QNT_IN_ROW_INFO', 'Especifique el número deseado de elementos por línea');
define('MC_THUMB_HEIGHT_INFO', 'Especificar la altura de la imagen pequeña');
define('MC_THUMB_WIDTH_INFO', 'Especificar el ancho de la imagen pequeña');
define('MC_SHOW_LEFT_COLUMN_INFO', 'Puede habilitar / deshabilitar la visualización de la columna izquierda de contenido');
define('MC_LOGO_WIDTH_INFO', 'Especifique el ancho del logotipo de su sitio web');
define('MC_LOGO_HEIGHT_INFO', 'Especifica la altura de tu logo');
define('MC_PRODUCT_MARGIN_INFO', 'Puede especificar el espacio deseado entre productos');
define('LIST_DISPLAY_TYPE_INFO', 'Puede especificar el formato de salida del producto: lista - lista, columnas - tabla');
define('MC_THUMB_FIT_INFO', 'Seleccione el valor deseado: contener - mantiene las proporciones de la imagen, cubrir - escala la imagen a todo el bloque');
define('MC_SHOW_THUMB2_INFO', 'Puedes habilitar/deshabilitar el efecto de cambiar una imagen a otra cuando pasas el cursor sobre ella');
define('MC_COLOR_1_INFO', 'Haga clic en la paleta para cambiar el color del texto de su sitio');
define('MC_COLOR_4_INFO', 'Haga clic en la paleta para cambiar el fondo del encabezado del sitio');
define('MC_COLOR_5_INFO', 'Haga clic en la paleta para cambiar el fondo del pie de página');
define('MC_COLOR_2_INFO', 'Haga clic en la paleta para cambiar el color de los enlaces de su sitio web');
define('MC_COLOR_6_INFO', 'Haga clic en la paleta para cambiar el color de los botones del sitio web');
define('MC_COLOR_3_INFO', 'Haga clic en la paleta para cambiar el color de fondo de su sitio web');
define('MC_COLOR_BTN_TEXT_INFO', 'Haga clic en la paleta para cambiar el color del texto de los botones');
define('MC_COLOR_GREY_INFO', 'Haga clic en la paleta para cambiar el color de los elementos grises.');

define('MAX_DISPLAY_SEARCH_RESULTS_TITLE_INFO_DEL', 'Eliminar valor');
define('MAX_DISPLAY_SEARCH_RESULTS_TITLE_INFO_ADD', 'Añadir valor');
define('MC_PRODUCT_QNT_IN_ROW_INFO_0', 'Teléfono < 768px. El valor \'3\' es igual a \'2\' si ≤ 480px');
define('MC_PRODUCT_QNT_IN_ROW_INFO_1', 'Tableta (vertical) < 992px');
define('MC_PRODUCT_QNT_IN_ROW_INFO_2', 'Tableta (horizontal) < 1200px');
define('MC_PRODUCT_QNT_IN_ROW_INFO_3', 'Pantalla < 1600px');
define('MC_PRODUCT_QNT_IN_ROW_INFO_4', 'Pantalla ≥ 1600px');

##LISTING
define('LISTING_MODULES', 'Listado de productos');
define('LIST_MODEL', 'Mostrar modelo de productos');
define('LIST_BREADCRUMB', 'Mostrar pan rallado');
define('LIST_CONCLUSION', 'Mostrar formato de salida del producto');
define('LIST_QUANTITY_PAGE', 'Mostrar el número de productos en la página');
define('LIST_SORTING', 'Mostrar clasificación de productos');
define('LIST_LOAD_MORE', 'Mostrar el botón "Mostrar más"');
define('LIST_NUMBER_OF_ROWS', 'Mostrar paginación');
define('LIST_PRESENCE', 'Mostrar disponibilidad del producto');
define('LIST_LABELS', 'Mostrar etiquetas');

##PRODUCT_INFO
define('PRODUCT_INFO_MODULES', 'Página del producto');
define('P_MODEL', 'Mostrar modelo de productos');
define('P_BREADCRUMB', 'Mostrar pan rallado');
define('P_SOCIAL_LIKE', 'Mostrar me gusta a través de las redes sociales');
define('P_PRESENCE', 'Mostrar disponibilidad del producto');
define('P_BUY_ONE_CLICK', 'Mostrar "Comprar en un clic"');
define('P_ATTRIBUTES', 'Mostrar atributos del producto');
define('P_SHARE', 'Mostrar compartir en redes sociales');
define('P_COMPARE', 'Mostrar marca de comparación');
define('P_WISHLIST', 'Mostrar marca de lista de deseos');
define('P_RATING', 'Mostrar calificación del producto');
define('P_SHORT_DESCRIPTION', 'Mostrar breve descripción');
define('P_RIGHT_SIDE', 'Mostrar columna derecha');
define('P_TAB_DESCRIPTION', 'Mostrar pestaña de descripción');
define('P_TAB_CHARACTERISTICS', 'Mostrar pestaña de funciones');
define('P_TAB_COMMENTS', 'Mostrar la pestaña de comentarios');
define('P_TAB_PAYMENT_SHIPPING', 'Mostrar la pestaña de pago y entrega');
define('P_WARRANTY', 'Garantía');
define('P_DRUGIE', 'Mostrar productos similares');
define('P_XSELL', 'Mostrar productos relacionados');
define('P_SHOW_QUANTITY_INPUT', 'Mostrar campo "Cantidad de bienes"');
define('P_FILTER', 'Filter');
define('P_BETTER_TOGETHER', 'Bloque Mostrar mejor juntos');
define('LIST_SHOW_PDF_LINK', 'Mostrar enlace PDF');
define('LIST_DISPLAY_TYPE', 'Formato de salida del producto');
define('INSTAGRAM_URL', 'Enlace deslizante');
define('M_INSTAGRAM', 'Instagram');
define('M_SEARCH_QUERIES', 'Consultas de búsqueda');
define('SHOW_SHORTCUT_LEFT_TREE', 'Mostrar árbol izquierdo colapsado');
define('F_FOOTER_CATEGORIES', 'ategorías en el pie de página');
define('P_SHOW_PROD_QTY_ON_PAGE', 'Mostrar stock restante');
define('P_LABELS', 'Mostrar etiquetas');
