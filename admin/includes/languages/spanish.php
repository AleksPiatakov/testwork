<?php
/*
  $Id: espanol.php,v 1.3 2003/09/28 23:37:26 anotherlango Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

//Admin begin
// header text in includes/header.php
define('HEADER_TITLE_LOGOFF', 'Logoff');
define('MODULE_PAYMENT_COD_STATUS_TITLE', 'Google SiteMaps');
define('MODULE_PAYMENT_COD_STATUS', 'Google SiteMaps');

// configuration box text in includes/boxes/administrator.php
define('BOX_HEADING_ADMINISTRATOR', 'Admins');
define('BOX_ADMINISTRATOR_MEMBERS', 'Member Groups');
define('BOX_ADMINISTRATOR_MEMBER', 'Members');
define('BOX_ADMINISTRATOR_BOXES', 'File Access');
define('BOX_ADMINISTRATOR_ACCOUNT_UPDATE', 'Update Account');
define('TEXT_PRODILE_INFO_CHANGE_PASSWORD', 'Cambiar su propia contraseña');
define('GOOGLE_FEED_MODULE_ENABLED_TITLE', 'Google Feed');

define('TEXT_MENU_REVIEWS', 'Comentarios');
define('SQL_MODE_RECOMMENDATION_TEXT', "For further correct work, you need to contact the hosting administration to reset the sql_mode variable in Mysql");
define('ROBOTS_TXT_RECOMMENDATION_TEXT', 'Robots.txt is not included on your site, for successful promotion we recommend that you enable it on <a target="_blank" href="/'.$admin.'/configuration.php?gID=1">page</a>');
define('CRITICAL_CSS_TXT_RECOMMENDATION_TEXT', '<span class="critical-text">Necesita generar CSS crítico</span> <span class="critical-process">Procesando...por favor espere</span><a class="start-generate-critical" href="javascript:void(0);">Comienzo</a>');
define('ALERT_ERRORS_BLOCK_TITLE', 'Alertas');
define('DOMEN_IN_ROBOTS_TXT_RECOMMENDATION_TEXT', '<span class="robots-txt-text">en Robots.txt, la directiva Host no coincide con el nombre de su sitio, para una promoción exitosa, lo recomendamos</span> <span class="generate-robots-txt-process">Procesando .. por favor espere</span><a class="start-generate-robots-txt" href="javascript:void(0);"> regenerar</a>');

define('FACEBOOK_PIXEL_MODULE_ENABLED_TITLE','FaceBook Pixel');
define('DEFAULT_PIXEL_CURRENCY_TITLE','FaceBook Pixel currency');
define('QUICK_PRODUCTS_UPDATE_ENABLED_TITLE','Quick Updates');
define('FACEBOOK_PIXEL_ID_TITLE','FaceBook Pixel ID');
define('HEADER_FRONT_LINK_TEXT', 'Go to site');
// images
define('IMAGE_FILE_PERMISSION', 'File Permission');
define('IMAGE_GROUPS', 'Groups List');
define('IMAGE_INSERT_FILE', 'Insert File');
define('IMAGE_MEMBERS', 'Members List');
define('IMAGE_NEW_GROUP', 'New Group');
define('IMAGE_NEW_MEMBER', 'New Member');
define('IMAGE_NEXT', 'Next');

define('ONE_PAGE_CHECKOUT_TITLE', 'Checkout');
define('BROWSE_BY_CATEGORIES_TITLE', 'Browse by categories');
define('SEO_TITLE', 'SEO URLs');

// constants for use in tep_prev_next_display function
define('TEXT_DISPLAY_NUMBER_OF_FILENAMES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> filenames)');
define('TEXT_DISPLAY_NUMBER_OF_MEMBERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> members)');
//Admin end

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'en_US'
// on FreeBSD 4.0 I use 'en_US.ISO_8859-1'
// this may not work under win32 environments..
setlocale(LC_TIME, 'en_US.ISO_8859-1');
define('DATE_FORMAT_SHORT', '%m/%d/%Y');  // this is used for strftime()
//define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT_LONG', '%d %B %Y'); // this is used for strftime()
define('DATE_FORMAT', 'm/d/Y'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'm/d/Y H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');
define('DATE_FORMAT_SPIFFYCAL', 'MM/dd/yyyy');  //Use only 'dd', 'MM' and 'yyyy' here in any order


define('TEXT_DAY_1','Lunes');
define('TEXT_DAY_2','Martes');
define('TEXT_DAY_3','Miércoles');
define('TEXT_DAY_4','Jueves');
define('TEXT_DAY_5','El viernes');
define('TEXT_DAY_6','Sábado');
define('TEXT_DAY_7','Domingo');
define('TEXT_DAY_SHORT_1','MON');
define('TEXT_DAY_SHORT_2','TUE');
define('TEXT_DAY_SHORT_3','WED');
define('TEXT_DAY_SHORT_4','THU');
define('TEXT_DAY_SHORT_5','FRI');
define('TEXT_DAY_SHORT_6','SAT');
define('TEXT_DAY_SHORT_7','SUN');
define('TEXT_MONTH_BASE_1','Enero');
define('TEXT_MONTH_BASE_2','Febrero');
define('TEXT_MONTH_BASE_3','Marzo');
define('TEXT_MONTH_BASE_4','Abril');
define('TEXT_MONTH_BASE_5','Mayo');
define('TEXT_MONTH_BASE_6','Junio');
define('TEXT_MONTH_BASE_7','Julio');
define('TEXT_MONTH_BASE_8','Agosto');
define('TEXT_MONTH_BASE_9','Septiembre');
define('TEXT_MONTH_BASE_10','Octubre');
define('TEXT_MONTH_BASE_11','Noviembre');
define('TEXT_MONTH_BASE_12','Diciembre');
define('TEXT_MONTH_1','De enero');
define('TEXT_MONTH_2','De febrero de');
define('TEXT_MONTH_3','De marzo de');
define('TEXT_MONTH_4','De abril de');
define('TEXT_MONTH_5','De mayo');
define('TEXT_MONTH_6','De junio de');
define('TEXT_MONTH_7','Julio');
define('TEXT_MONTH_8','De agosto de');
define('TEXT_MONTH_9','De septiembre de');
define('TEXT_MONTH_10','De octubre de');
define('TEXT_MONTH_11','De noviembre de');
define('TEXT_MONTH_12','De diciembre de');

// Global entries for the <html> tag
define('HTML_PARAMS', 'dir="ltr" lang="en"');

// charset for web pages and emails
define('CHARSET', 'utf-8');

// page title
define('TITLE', 'Solomono');

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Admin');
define('HEADER_TITLE_SUPPORT_SITE', 'osCommerce');
define('HEADER_TITLE_ONLINE_CATALOG', 'Catalog');
define('HEADER_TITLE_ADMINISTRATION', 'Admin');
define('HEADER_TITLE_CHAINREACTION', 'Chainreactionweb');
define('HEADER_TITLE_PHESIS', 'PHESIS Loaded6');

define('HEADER_TITLE_HELLO', 'Hello');
define('HEADER_ADMIN_TEXT', 'Adminpanel');
define('HEADER_ORDERS_TODAY', 'Pedidos hoy: ');
define('HEADER_GO_TO_SITE', 'Ir al sitio');

// MaxiDVD Added Line For WYSIWYG HTML Area: BOF
define('BOX_CATALOG_DEFINE_MAINPAGE', 'Define MainPage');
define('BOX_CATALOG_STATS_SEARCH_KEYWORDS', "Planificador de palabras clave");
// MaxiDVD Added Line For WYSIWYG HTML Area: EOF
define('BOX_CATALOG_CATEGORIES_PRODUCTS_MULTI', 'Multiedit products');
define('BOX_TOOLS_COMMENT8R', 'Comments');
define('BOX_TOOLS_MYSQL_PERFORMANCE', 'Slow queries');
define('BOX_GOOGLE_SITEMAP', 'Google SiteMaps');
define('BOX_CLEAR_IMAGE_CACHE', 'Borrar caché de imágenes');


define('TOOLTIP_STORE_NAME', 'Indique el nombre original de la tienda que atrae a los clientes, es recordado por los clientes y sirve para destacarse y distinguirse de tiendas similares - competidores.');
define('TOOLTIP_STORE_OWNER', 'Especificar el dueño de la tienda');
define('TOOLTIP_SHOW_BASKET_ON_ADD_TO_CART', 'Habilite, el carrito estará disponible al momento de agregar un producto, para que el visitante no tenga dudas de que el producto ha sido agregado al carrito.');
define('TOOLTIP_USE_DEFAULT_LANGUAGE_CURRENCY', 'Habilite para cambiar la moneda automáticamente de acuerdo con el idioma actual del sitio.');
define('TOOLTIP_CHANGE_BY_GEOLOCATION', 'Habilite para cambiar la moneda y el idioma del sitio según la geolocalización.');
define('TOOLTIP_GET_BROWSER_LANGUAGE', 'Habilite para cambiar la moneda del sitio según el idioma del navegador.');
define('TOOLTIP_STORE_BANK_INFO', 'Le permite definir la información bancaria exacta para los detalles de la factura');
define('TOOLTIP_ONEPAGE_LOGIN_REQUIRED', 'Habilitar y el inicio de sesión de usuario/cliente siempre será necesario');
define('TOOLTIP_REVIEWS_WRITE_ACCESS', 'Habilitar y solo los usuarios registrados podrán dejar sus comentarios');
define('TOOLTIP_ROBOTS_TXT', 'Protección de todo el sitio o de algunas de sus secciones contra la indexación');
define('TOOLTIP_MENU_LOCATION', 'Seleccione la posición del menú: superior, izquierda o izquierda contraída');
define('TOOLTIP_DEFAULT_DATE_FORMAT', 'Elija formato de fecha');
define('TOOLTIP_SET_HTTPS', 'Habilite la extensión del protocolo HTTPS para admitir el cifrado y aumentar la seguridad');
define('TOOLTIP_SET_WWW', 'Seleccione la configuración donde redirigir: deshabilitar, www->no-www o no-www->www');
define('TOOLTIP_ENABLE_DEBUG_PAGE_SPEED', 'Habilite la depuración de carga de página para encontrar y corregir errores en el script');
define('TOOLTIP_STORE_SCRIPTS', 'Puede incluir scripts JS adicionales');
define('TOOLTIP_STORE_METAS', 'Puede incluir etiquetas meta adicionales en el encabezado');
define('TOOLTIP_MYSQL_PERFORMANCE_TRESHOLD', 'Establezca el tiempo en "segundos" por encima del cual las consultas lentas y potencialmente problemáticas se registrarán en la base de datos');
define('TOOLTIP_STOCK_REORDER_LEVEL', 'Especificar la cantidad de mercancías en stock');

define('TOOLTIP_TELEGRAM_NOTIFICATIONS_ENABLED', 'Puedes habilitar/deshabilitar las notificaciones de Telegram');
define('TOOLTIP_TELEGRAM_TOKEN', 'Cuentas especiales de Telegram creadas para procesar y enviar mensajes automáticamente');
define('TOOLTIP_SMS_ENABLE', 'Puede habilitar/deshabilitar el servicio de sms');
define('TOOLTIP_SMS_CUSTOMER_ENABLE', 'Puede habilitar / deshabilitar la capacidad de enviar sms al cliente al momento de la compra');
define('TOOLTIP_SMS_CHANGE_STATUS', 'Puede habilitar / deshabilitar la capacidad de enviar sms al cliente al cambiar el estado');
define('TOOLTIP_SMS_OWNER_ENABLE', 'Puede habilitar / deshabilitar la capacidad de enviar sms al administrador al momento de la compra');
define('TOOLTIP_SMS_OWNER_TEL', 'Introducir/cambiar el número de teléfono del administrador');


define('TOOLTIP_FACEBOOK_AUTH_STATUS', 'Puede permitir que los usuarios inicien sesión en su sitio con una cuenta de Facebook. Esta es una excelente manera de hacer que este proceso sea más fácil y conveniente para sus usuarios, así como aumentar la cantidad de registros nuevos.');
define('TOOLTIP_FACEBOOK_APP_ID', 'Una identificación de redes sociales es una combinación de números que distingue una cuenta de otras. En Internet, este es un análogo de un pasaporte, que a menudo necesita el uso de métodos de protección confiables. Un número de identificación se genera automáticamente al registrar un perfil. Con él, puede encontrar la información que necesita, una persona o una comunidad de interés.');
define('TOOLTIP_FACEBOOK_APP_SECRET', 'La clave secreta es un dispositivo para proteger su cuenta de Facebook. También es un método de autenticación de dos factores que aumenta el nivel de seguridad al iniciar sesión en su cuenta.');
define('TOOLTIP_FACEBOOK_PIXEL_ID', 'Con los datos que recopila Facebook Pixel, puede realizar un seguimiento de las visitas y las conversiones en su sitio, optimizar los anuncios y crear audiencias personalizadas para la reorientación.');
define('TOOLTIP_DEFAULT_PIXEL_CURRENCY', 'Especifique la moneda en la que se enviará el precio del producto a FaceBook Pixel');
define('TOOLTIP_FACEBOOK_GOALS_CLICK_ON_BUG_REPORT', 'Tiene como objetivo describir los errores detectados, lo que permitirá al equipo de desarrollo corregir los errores en el programa.');
define('TOOLTIP_FACEBOOK_GOALS_PHONE_CALL', 'Al publicar anuncios con un número de teléfono, puede alentar a las personas a llamar a su empresa para realizar un pedido, obtener más información sobre sus productos o servicios o programar una reunión.');
define('TOOLTIP_FACEBOOK_GOALS_CLICK_FAST_BUY', 'Si los productos se compran regularmente, a menudo el comprador ya conoce las características, la tarea no es elegir, sino encontrar el correcto, agregarlo a la cesta y realizar un pedido rápidamente.');
define('TOOLTIP_FACEBOOK_GOALS_CLICK_ON_CHAT', 'Un botón de chat es un ícono ubicado en algún lugar de su sitio que permite a los clientes comunicarse en tiempo real con el equipo de atención al cliente. Con la ayuda del chat en línea, sus especialistas pueden resolver de manera rápida y eficiente las solicitudes de los clientes.');
define('TOOLTIP_FACEBOOK_GOALS_CALLBACK', 'La tarea del botón de devolución de llamada es llevar a un cliente potencial a la comunicación.');
define('TOOLTIP_FACEBOOK_GOALS_FILTER', 'El filtro permite reducir el surtido a una selección con las características más relevantes para las necesidades individuales del usuario.');
define('TOOLTIP_FACEBOOK_GOALS_SUBSCRIBE', 'Brinda a los usuarios la capacidad de organizar y mantener boletines temáticos por correo electrónico a los que otros usuarios del servicio pueden suscribirse.');
define('TOOLTIP_FACEBOOK_GOALS_LOGIN', 'Inicio de sesión es la palabra que se utilizará para ingresar al sitio o servicio. Muy a menudo, el inicio de sesión coincide con el nombre de usuario, que será visible para todos los participantes en el servicio.');
define('TOOLTIP_FACEBOOK_GOALS_ADD_REVIEW', 'Reseñas de los clientes: comentarios de los usuarios sobre sus productos o servicios. Para comprar un producto, el 89% de los compradores lee primero las reseñas.');
define('TOOLTIP_FACEBOOK_GOALS_PAGE_VIEW', 'Puede saber cuántas personas han visto y solicitado su sitio');
define('TOOLTIP_FACEBOOK_GOALS_ADD_TO_CART', 'El botón "Añadir a la cesta" implica la compra de varios productos, cuando se añaden por primera vez a la cesta y ya se ha realizado un pedido allí.');
define('TOOLTIP_FACEBOOK_GOALS_CHECKOUT_PROCESS', 'La calidad y la comodidad del uso del carrito de la compra es garantía de buen humor para sus clientes, una forma eficaz de aumentar la conversión del sitio web.');
define('TOOLTIP_FACEBOOK_GOALS_SEARCH_RESULTS', 'Lleva al usuario a la página de resultados de búsqueda.');
define('TOOLTIP_FACEBOOK_GOALS_VIEW_CONTENT', 'ViewContent te dice si alguien está visitando la URL de una página web.');
define('TOOLTIP_FACEBOOK_GOALS_COMPLETE_REGISTRATION', 'Proporcionar información por parte de un cliente a cambio de un servicio prestado por su empresa');
define('TOOLTIP_FACEBOOK_GOALS_CONTACT_US_REQUEST', 'Datos de contacto de una persona que haya mostrado un interés real por los productos y servicios de la empresa y que pueda convertirse en un futuro cliente real.');
define('TOOLTIP_FACEBOOK_GOALS_ADD_TO_WISHLIST', 'Uno de los eventos que permite monitorear las acciones de los usuarios, optimizarlas y crear audiencias');
define('TOOLTIP_FACEBOOK_GOALS_ADD_PAYMENT_INFO', 'Uno de los eventos que permite monitorear las acciones de los usuarios, optimizarlas y crear audiencias');
define('TOOLTIP_FACEBOOK_GOALS_SUCCESS_PAGE', 'El cliente ve una especie de factura sobre el pedido perfecto.');

define('TOOLTIP_GOOGLE_OAUTH_STATUS', 'Posibilidad de habilitar/deshabilitar la autorización del cliente a través de Google');
define('TOOLTIP_GOOGLE_OAUTH_CLIENT_ID', 'De forma predeterminada, Google asigna una ID de cliente única: ID de cliente.');
define('TOOLTIP_GOOGLE_OAUTH_CLIENT_SECRET', 'CLIENT_SECRET se utiliza para almacenar información un poco más confidencial, como el uso de API, información de tráfico e información de facturación.');
define('TOOLTIP_GOOGLE_ANALYTICS_AND_TAGS_MODULE_ENABLED', 'Tiene una herramienta de seguimiento de eventos, permite que los servicios recopilen datos y realicen análisis');
define('TOOLTIP_GOOGLE_ECOMM_SUCCESS_PAGE', 'Posibilidad de habilitar / deshabilitar la página de "compra" después de la confirmación del pedido');
define('TOOLTIP_GOOGLE_ECOMM_CHECKOUT_PAGE', 'Posibilidad de habilitar/deshabilitar la página de pago');
define('TOOLTIP_GOOGLE_ECOMM_PRODUCT_DETAIL_PAGE', 'Posibilidad de habilitar/deshabilitar la página de vista del producto');
define('TOOLTIP_GOOGLE_ECOMM_SEARCH_RESULTS', 'Capacidad para habilitar/deshabilitar la página de resultados de búsqueda');
define('TOOLTIP_GOOGLE_ECOMM_HOME_PAGE', 'Posibilidad de habilitar/deshabilitar la página de inicio al cargar el navegador');
define('TOOLTIP_GOOGLE_SITE_VERIFICATION_KEY', 'Clave proporcionada por Google (solo necesita insertar la llave en sí)');
define('TOOLTIP_GOOGLE_RECAPTCHA_STATUS', 'Puede activar/desactivar Google Recaptcha (protege los sitios web de los bots de Internet y al mismo tiempo ayuda a digitalizar los textos de los libros)');
define('TOOLTIP_GOOGLE_RECAPTCHA_PUBLIC_KEY', 'Proporciona un servicio de Google (para proteger los sitios web de los bots de Internet y al mismo tiempo ayudar en la digitalización de los textos de los libros)');
define('TOOLTIP_GOOGLE_RECAPTCHA_SECRET_KEY', 'Proporciona un servicio de Google (para proteger los sitios web de los bots de Internet y al mismo tiempo ayudar en la digitalización de los textos de los libros)');




define('TOOLTIP_ENTRY_FIRST_NAME_MIN_LENGTH', "Especifique el número mínimo de caracteres en la columna 'Valor' para cada parámetro");
define('TOOLTIP_ENTRY_LAST_NAME_MIN_LENGTH', "Especifique el número mínimo de caracteres en la columna 'Valor' para cada parámetro");
define('TOOLTIP_ENTRY_EMAIL_ADDRESS_MIN_LENGTH', "Especifique el número mínimo de caracteres en la columna 'Valor' para cada parámetro");
define('TOOLTIP_MIN_DISPLAY_XSELL', "Especifique el número mínimo de caracteres en la columna 'Valor' para cada parámetro");

// text for gender
define('MALE', 'Male');
define('FEMALE', 'Female');

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Configuration');
define('BOX_CONFIGURATION_MYSTORE', 'My Store');
define('BOX_CONFIGURATION_LOGGING', 'Logging');
define('BOX_CONFIGURATION_CACHE', 'Cache');

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Modules');
define('BOX_MODULES_PAYMENT', 'Payment');
define('BOX_MODULES_SHIPPING', 'Shipping');
define('BOX_MODULES_ORDER_TOTAL', 'Order Total');
define('BOX_MODULES_SHIP2PAY', 'Ship&Pay');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Catalog');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Categories/Products');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Attributes - Add values');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES_NEW', 'Attributes - Set values');
define('BOX_CATALOG_MANUFACTURERS', 'Manufacturers');
define('BOX_CATALOG_SPECIALS', 'Specials');
define('BOX_CATALOG_EASYPOPULATE', 'EasyPopulate');

define('BOX_CATALOG_SALEMAKER', 'SaleMaker');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Customers/Orders');
define('BOX_CUSTOMERS_CUSTOMERS', 'Customers');
define('BOX_CUSTOMERS_ORDERS', 'Orders');
define('BOX_CUSTOMERS_EDIT_ORDERS', 'Edit Orders');
define('BOX_CUSTOMERS_ENTRY', 'Number of Enries');
define('BOX_CATALOG_SEO_FILTER', "SEO filter");
define('BOX_CATALOG_SEO_TEMPALTES', "Plantillas SEO");
// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Locations / Taxes');
define('BOX_TAXES_COUNTRIES', 'Countries');
define('BOX_TAXES_ZONES', 'Zones');
define('BOX_TAXES_GEO_ZONES', 'Tax Zones');
define('BOX_TAXES_TAX_CLASSES', 'Tax Classes');
define('BOX_TAXES_TAX_RATES', 'Tax Rates');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Reports');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Products Viewed');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Products Purchased');
define('BOX_REPORTS_PRODUCTS_PURCHASED_BY_CATEGORY', 'Report - Products purchased (by Category)');
define('BOX_REPORTS_ORDERS_TOTAL', 'Customer Orders-Total');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Tools');
define('BOX_TOOLS_BACKUP', 'Database Backup');
define('BOX_TOOLS_CACHE', 'Cache Control');
define('BOX_TOOLS_MAIL', 'Send Email');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Newsletter Manager');

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Localization');
define('BOX_LOCALIZATION_CURRENCIES', 'Currencies');
define('BOX_LOCALIZATION_LANGUAGES', 'Languages');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Orders Status');

// infobox box text in includes/boxes/info_boxes.php
define('BOX_HEADING_BOXES', 'Infobox Admin');
define('BOX_HEADING_TEMPLATE_CONFIGURATION', 'Template Admin');
define('BOX_HEADING_DESIGN_CONTROLS', 'Design controls');

// javascript messages
define('JS_ERROR', 'Errors have occured during the process of your form!\nPlease make the following corrections:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* The new product atribute needs a price value\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* The new product atribute needs a price prefix\n');

define('JS_PRODUCTS_NAME', '* The new product needs a name\n');
define('JS_PRODUCTS_DESCRIPTION', '* The new product needs a description\n');
define('JS_PRODUCTS_PRICE', '* The new product needs a price value\n');
define('JS_PRODUCTS_WEIGHT', '* The new product needs a weight value\n');
define('JS_PRODUCTS_QUANTITY', '* The new product needs a quantity value\n');
define('JS_PRODUCTS_MODEL', '* The new product needs a model value\n');
define('JS_PRODUCTS_IMAGE', '* The new product needs an image value\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* A new price for this product needs to be set\n');

define('JS_GENDER', '* The \'Gender\' value must be chosen.\n');
define('JS_FIRST_NAME', '* The \'First Name\' entry must have at least ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' characters.\n');
define('JS_LAST_NAME', '* The \'Last Name\' entry must have at least ' . ENTRY_LAST_NAME_MIN_LENGTH . ' characters.\n');
define('JS_DOB', '* The \'Date of Birth\' entry must be in the format: xx/xx/xxxx (month/date/year).\n');
define('JS_EMAIL_ADDRESS', '* The \'E-Mail Address\' entry must have at least ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' characters.\n');
define('JS_ADDRESS', '* The \'Street Address\' entry must have at least ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' characters.\n');
define('JS_POST_CODE', '* The \'Post Code\' entry must have at least ' . ENTRY_POSTCODE_MIN_LENGTH . ' characters.\n');
define('JS_CITY', '* The \'City\' entry must have at least ' . ENTRY_CITY_MIN_LENGTH . ' characters.\n');
define('JS_STATE', '* The \'State\' entry is must be selected.\n');
define('JS_STATE_SELECT', '-- Select Above --');
define('JS_ZONE', '* The \'State\' entry must be selected from the list for this country.');
define('JS_COUNTRY', '* The \'Country\' value must be chosen.\n');
define('JS_TELEPHONE', '* The \'Telephone Number\' entry must have at least ' . ENTRY_TELEPHONE_MIN_LENGTH . ' characters.\n');
define('JS_PASSWORD', '* The \'Password\' amd \'Confirmation\' entries must match amd have at least ' . ENTRY_PASSWORD_MIN_LENGTH . ' characters.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'Order Number %s does not exist!');

define('CATEGORY_PERSONAL', 'Personal');
define('CATEGORY_ADDRESS', 'Address');
define('CATEGORY_CONTACT', 'Contact');
define('CATEGORY_COMPANY', 'Company');
define('CATEGORY_OPTIONS', 'Options');
define('DISCOUNT_OPTIONS', 'Discounts');

define('ENTRY_GENDER', 'Gender:');
define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">required</span>');
define('ENTRY_FIRST_NAME', 'First Name:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' chars</span>');
define('ENTRY_LAST_NAME', 'Last Name:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' chars</span>');
define('ENTRY_DATE_OF_BIRTH', 'Date of Birth:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(eg. 05/21/1970)</span>');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail Address:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' chars</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">The email address doesn\'t appear to be valid!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">This email address already exists!</span>');
define('ENTRY_COMPANY', 'Company name:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_STREET_ADDRESS', 'Street Address:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' chars</span>');
define('ENTRY_SUBURB', 'Suburb:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', 'Post Code:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' chars</span>');
define('ENTRY_CITY', 'City:');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_CITY_MIN_LENGTH . ' chars</span>');
define('ENTRY_STATE', 'State:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">required</span>');
define('ENTRY_COUNTRY', 'Country:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', 'Telephone Number:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' chars</span>');
define('ENTRY_FAX_NUMBER', 'Fax Number:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_NEWSLETTER', 'Newsletter:');
define('ENTRY_NEWSLETTER_YES', 'Subscribed');
define('ENTRY_NEWSLETTER_NO', 'Unsubscribed');

// images
define('IMAGE_ANI_SEND_EMAIL', 'Sending E-Mail');
define('IMAGE_BACK', 'Back');
define('IMAGE_BACKUP', 'Database Backup');
define('IMAGE_CANCEL', 'Cancel');
define('IMAGE_CONFIRM', 'Confirm');
define('IMAGE_COPY', 'Copy');
define('IMAGE_COPY_TO', 'Copy To');
define('IMAGE_DETAILS', 'Details');
define('IMAGE_DELETE', 'Delete');
define('IMAGE_EDIT', 'Edit');
define('IMAGE_EMAIL', 'Email');
define('IMAGE_FILE_MANAGER', 'File Manager');
define('IMAGE_ICON_STATUS_GREEN', 'Active');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Set Active');
define('IMAGE_ICON_STATUS_RED', 'Inactive');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Set Inactive');
define('IMAGE_ICON_INFO', 'Info');
define('IMAGE_INSERT', 'Insert');
define('IMAGE_LOCK', 'Lock');
define('IMAGE_MODULE_INSTALL', 'Install Module');
define('IMAGE_MODULE_REMOVE', 'Remove Module');
define('IMAGE_MOVE', 'Move');
define('IMAGE_NEW_BANNER', 'New Banner');
define('IMAGE_NEW_CATEGORY', 'New Category');
define('IMAGE_NEW_COUNTRY', 'New Country');
define('IMAGE_NEW_CURRENCY', 'New Currency');
define('IMAGE_NEW_FILE', 'New File');
define('IMAGE_NEW_FOLDER', 'New Folder');
define('IMAGE_NEW_LANGUAGE', 'New Language');
define('IMAGE_NEW_NEWSLETTER', 'New Newsletter');
define('IMAGE_NEW_PRODUCT', 'New Product');
define('IMAGE_NEW_SALE', 'New Sale');
define('IMAGE_NEW_TAX_CLASS', 'New Tax Class');
define('IMAGE_NEW_TAX_RATE', 'New Tax Rate');
define('IMAGE_NEW_TAX_ZONE', 'New Tax Zone');
define('IMAGE_NEW_ZONE', 'New Zone');
define('IMAGE_ORDERS', 'Orders');
define('IMAGE_ORDERS_INVOICE', 'Invoice');
define('IMAGE_ORDERS_PACKINGSLIP', 'Packing Slip');
define('IMAGE_PREVIEW', 'Preview');
define('IMAGE_RESTORE', 'Restore');
define('IMAGE_RESET', 'Reset');
define('IMAGE_SAVE', 'Save');
define('IMAGE_SEARCH', 'Search');
define('IMAGE_SELECT', 'Select');
define('IMAGE_SEND', 'Send');
define('IMAGE_SEND_EMAIL', 'Send Email');
define('IMAGE_UNLOCK', 'Unlock');
define('IMAGE_UPDATE', 'Update');
define('IMAGE_UPDATE_CURRENCIES', 'Update Exchange Rate');
define('IMAGE_UPDATE_CURRENCIES_SHORT', 'Update currencies');
define('IMAGE_UPLOAD', 'Upload');
define('TEXT_IMAGE_NONEXISTENT', 'No image');

define('ICON_CROSS', 'False');
define('ICON_CURRENT_FOLDER', 'Current Folder');
define('ICON_DELETE', 'Delete');
define('ICON_ERROR', 'Error');
define('ICON_FILE', 'File');
define('ICON_FILE_DOWNLOAD', 'Download');
define('ICON_FOLDER', 'Folder');
define('ICON_LOCKED', 'Locked');
define('ICON_PREVIOUS_LEVEL', 'Previous Level');
define('ICON_PREVIEW', 'Preview');
define('ICON_STATISTICS', 'Statistics');
define('ICON_SUCCESS', 'Success');
define('ICON_TICK', 'True');
define('ICON_UNLOCKED', 'Unlocked');
define('ICON_WARNING', 'Warning');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Page %s of %d');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> banners)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> countries)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> customers)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> currencies)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> languages)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> manufacturers)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> newsletters)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> orders)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> orders status)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> products)');
define('TEXT_DISPLAY_NUMBER_OF_SALES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> sales)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> products on special)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> tax classes)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> tax zones)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> tax rates)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> zones)');

define('TEXT_MENU_TOTAL_CONFIG', 'Configuración total');

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');

define('IMAGE_BUTTON_BUY_TEMPLATE','Cambiar a paquete pago');
define('IMAGE_BUTTON_BUY_TEMPLATE_MOB', 'Buy');
define('TIME_LEFT', 'Time left: ');

define('TEXT_DEFAULT', 'default');
define('TEXT_SET_DEFAULT', 'Set as default');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Required</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Error: There is currently no default currency set. Please set one at: Administration Tool->Localization->Currencies');

define('TEXT_CACHE_CATEGORIES', 'Categories Box');
define('TEXT_CACHE_MANUFACTURERS', 'Manufacturers Box');
define('TEXT_CACHE_ALSO_PURCHASED', 'Also Purchased Module');

define('TEXT_NONE', '--none--');
define('TEXT_TOP', 'Top');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Error: Destination does not exist.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Error: Destination not writeable.');
define('ERROR_FILE_NOT_SAVED', 'Error: File upload not saved.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Error: File upload type not allowed.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Success: File upload saved successfully.');
define('WARNING_NO_FILE_UPLOADED', 'Warning: No file uploaded.');
define('WARNING_FILE_UPLOADS_DISABLED', 'Warning: File uploads are disabled in the php.ini configuration file.');

define('BOX_CATALOG_XSELL_PRODUCTS', 'Cross Sell Products');

define('CUSTOM_PANEL_DATE1', 'día');
define('CUSTOM_PANEL_DATE2', 'días');
define('CUSTOM_PANEL_DATE3', 'días');

// X-Sell
REQUIRE(DIR_WS_LANGUAGES . 'add_ccgvdc_spanish.php');

// BOF: Lango Added for print order MOD
define('IMAGE_BUTTON_PRINT', 'Print');
// EOF: Lango Added for print order MOD

// BOF: Lango Added for Featured product MOD
define('BOX_CATALOG_FEATURED', 'Featured Products');
// EOF: Lango Added for Featured product MOD

// BOF: Lango Added for Sales Stats MOD
define('BOX_REPORTS_MONTHLY_SALES', 'Monthly Sales/Tax');
// EOF: Lango Added for Sales Stats MOD

//BEGIN Dynamic information pages unlimited
define('BOX_HEADING_INFORMATION', 'Contenido');
define('BOX_HEADING_SEO', 'SEO');
define('BOX_INFORMATION', 'Pages');
//END Dynamic information pages unlimited

define('BOX_TOOLS_KEYWORDS', 'Keyword Manager');

// RJW Begin Meta Tags Code
define('TEXT_META_TITLE', 'Meta Title');
define('TEXT_META_DESCRIPTION', 'Meta Description');
define('TEXT_META_KEYWORDS', 'Meta Keywords');
// RJW End Meta Tags Code

// Article Manager
define('BOX_HEADING_ARTICLES', 'Article Manager');
define('BOX_TOPICS_ARTICLES', 'Topics/Articles');
define('BOX_ARTICLES_CONFIG', 'Configuration');
define('BOX_ARTICLES_AUTHORS', 'Authors');
define('BOX_ARTICLES_XSELL', 'Cross-Sell Articles');
define('IMAGE_NEW_TOPIC', 'New Topic');
define('IMAGE_NEW_ARTICLE', 'New Article');
define('TEXT_DISPLAY_NUMBER_OF_AUTHORS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> authors)');

//TotalB2B start
define('BOX_CUSTOMERS_GROUPS', 'Groups');
define('BOX_MANUDISCOUNT', 'Manu Discount');

// add for Group minimum price to order start		
define('GROUP_MIN_PRICE', 'Group min price');
// add for Group minimum price to order end
// add for color groups start
define('GROUP_COLOR_BAR', 'Group Color');
// add for color groups end
//TotalB2B end
define('BOX_CATALOG_QUICK_UPDATES', 'Quick Updates');

define('IMAGE_PROPERTIES_POPUP_ADD_CHANGE_DELETE', 'Add, change, delete Properties');
define('IMAGE_PROPERTIES_POPUP_ADD', 'Add Properties');
define('IMAGE_PROPERTIES', 'Define your Products Properties');

// polls box text in includes/boxes/polls.php

define('BOX_HEADING_POLLS', 'Polls');
define('BOX_POLLS_POLLS', 'Poll Manager');
define('BOX_POLLS_CONFIG', 'Poll Configuration');
define('BOX_CURRENCIES_CONFIG', 'Currencies');
define('BOX_COUPONS', 'Promo codes');
define('BOX_INDEX_GIFTVOUCHERS', 'Gift vouchers / Promo codes');

define('BOX_REPORTS_SALES_REPORT2', 'Stats sales 2');
define('BOX_REPORTS_SALES_REPORT', 'Stats sales 3');
define('BOX_REPORTS_CUSTOMERS_ORDERS', 'Customers report');

define('TEXT_NEW_ATTRIBUTE_EDIT', 'Edit productc attributes');

define('SMS_ENABLE_TITLE', 'Turn on sms-service');
define('SMS_GATENAME_TITLE', 'SMS gatename');
define('SMS_CUSTOMER_ENABLE_TITLE', 'Sent sms to client on checkout?');
define('TELEGRAM_TOKEN_TITLE','Telegram Token');
define('TELEGRAM_NOTIFICATIONS_ENABLED_TITLE','Habilitar notificaciones de Telegram');
define('SMS_CHANGE_STATUS_TITLE', 'Sent sms to client on change order status?');
define('SMS_OWNER_ENABLE_TITLE', 'Sent sms to admin on checkout?');
define('SMS_OWNER_ENABLE_BUY_ONE_CLICK_TITLE', '¿Enviar sms al administrador al comprar en un clic?');
define('SMS_OWNER_TEL_TITLE', 'Admin tel. number');
define('SMS_TEXT_TITLE', 'text sms');
define('SMS_LOGIN_TITLE', 'Inicie sesión en la puerta de enlace SMS (o clave API, Account SID)');
define('SMS_PASSWORD_TITLE', 'pass (or Auth token)');
define('SMS_SIGN_TITLE', 'Remitente (or Service SID)');
define('SMS_ENC_TITLE', 'code2');

define('ROBOTS_TXT_TITLE', 'robots.txt');

define('SMS_CONF_TITLE', 'Sms-service');
define('MY_SHOP_CONF_TITLE', 'My Store');
define('MIN_VALUES_CONF_TITLE', 'Minimum Values');
define('MAX_VALUES_CONF_TITLE', 'Maximum Values');
define('IMAGES_CONF_TITLE', 'Images');
define('CUSTOMER_DETAILS_CONF_TITLE', 'Customer Details');
define('MODULES_CONF_TITLE', 'Installed Modules');
define('SHIPPING_CONF_TITLE', 'Shipping/Packaging');
define('LISTING_CONF_TITLE', 'Product Listing');
define('STOCK_CONF_TITLE', 'Stock');
define('LOGS_CONF_TITLE', 'Logging');
define('CACHE_CONF_TITLE', 'Cache');
define('EMAIL_CONF_TITLE', 'E-Mail Options');
define('DOWNLOAD_CONF_TITLE', 'Download');
define('GZIP_CONF_TITLE', 'GZip Compression');
define('SESSIONS_CONF_TITLE', 'Sessions');
define('HTML_CONF_TITLE', 'TinyMCE Editor');
define('DYMO_CONF_TITLE', 'Dynamic MoPics');
define('DOWN_CONF_TITLE', 'Site Maintenance');
define('GA_CONF_TITLE', 'Guests');
define('LINKS_CONF_TITLE', 'Links');
define('QUICK_CONF_TITLE', 'Quick Updates');
define('WISHLIST_TITLE', 'Wish List Settings');
define('PAGE_CACHE_TITLE', 'Page cache');
define('YANDEX_MARKET_CONF_TITLE', 'XML upload');


define('ATTRIBUTES_COPY_TEXT1', ' WARNING: Cannot copy from Product ID # ');
define('ATTRIBUTES_COPY_TEXT2', ' to Product ID # ');
define('ATTRIBUTES_COPY_TEXT3', ' ... No copy was made');
define('ATTRIBUTES_COPY_TEXT4', ' WARNING: No Attributes to copy from Product ID # ');
define('ATTRIBUTES_COPY_TEXT5', ' for: ');
define('ATTRIBUTES_COPY_TEXT6', ' ... No copy was made');
define('ATTRIBUTES_COPY_TEXT7', ' WARNING: There is no Product ID # ');
define('ATTRIBUTES_COPY_TEXT8', ' ... No copy was made');

//include('includes/languages/english_support.php');

// BOF FlyOpenair: Extra Product Price
define('BOX_EXTRA_PRODUCT_PRICE', 'Extra Product Price');
define('EXTRA_PRODUCT_PRICE_ID_TITLE', 'Enable Extra Product Price');
define('EXTRA_PRODUCT_PRICE_ID_DESC', 'Enable/Disable Extra Product Price)');
// EOF FlyOpenair: Extra Product Price

define('TEXT_IMAGE_OVERWRITE_WARNING', 'WARNING: FILENAME was updated but not overwritten ');

define('SERVICE_MENU', 'TOOLS');
define('SEO_CONFIGURATION','SEO TOOLS');

define('TEXT_INDEX_LANGUAGE', 'Language: ');
define('TEXT_SUMMARY_CUSTOMERS', 'Customers');
define('TEXT_SUMMARY_ORDERS', 'Orders');
define('TEXT_SUMMARY_PRODUCTS', 'Products');
define('TEXT_SUMMARY_HELP', 'Help');
define('TEXT_SUMMARY_STAT', 'Statistics');
define('TABLE_HEADING_CUSTOMERS', 'Customers');


define('COMMENTS_MODULE_ENABLED_TITLE', 'Reviews');
define('LANGUAGE_SELECTOR_MODULE_ENABLED_TITLE', 'Multilanguage');
define('PRODUCT_LABELS_MODULE_ENABLED_TITLE', 'Labels');
define('ATTRIBUTES_PRODUCTS_MODULE_ENABLED_TITLE', 'Filters');
define('AUTH_MODULE_ENABLED_TITLE', 'Authorization (Google, Facebook)');
define('EXCEL_IMPORT_MODULE_ENABLED_TITLE', 'Import/Export CSV (Easy Populate)');
define('CUPONES_MODULE_ENABLED_TITLE', 'Promo codes');
define('COMPARE_MODULE_ENABLED_TITLE', 'Comparison');
define('YML_MODULE_ENABLED_TITLE', 'Import XML (YML)');
define('OSC_IMPORT_MODULE_ENABLED_TITLE', 'Database migration (osCommerce)');
define('EXPORT_HOTLINE_MODULE_ENABLED_TITLE', 'XML products export "Hotline"');
define('EXPORT_PROMUA_MODULE_ENABLED_TITLE', 'XML products export "Prom"');
define('EXPORT_PRICEUA_MODULE_ENABLED_TITLE', 'XML products export "Price.ua"');
define('EXPORT_ROZETKA_MODULE_ENABLED_TITLE', 'XML products export "Rozetka"');
define('EXPORT_YANDEX_MARKET_MODULE_ENABLED_TITLE', 'Yandex Market export');
define('EXPORT_GOOGLE_SITEMAP_MODULE_ENABLED_TITLE', 'XML Sitemaps');
define('EXPORT_FACEBOOK_FEED_MODULE_ENABLED_TITLE', 'XML feed for Facebook Product Catalog');
define('EXPORT_PDF_MODULE_ENABLED_TITLE', 'Export catalog to PDF');
define('PROMURLS_MODULE_ENABLED_TITLE', 'Prom.ua Urls');
define('PROM_EXCEL_MODULE_ENABLED_TITLE', 'Import Prom.ua (Excel)');
define('MASTER_PASS_TITLE', 'Master Password');
define('WISHLIST_MODULE_ENABLED_TITLE', 'Lista de deseos');
define('GOOGLE_FEED_CHOOSE_ALL_PRODUCTS_TITLE', 'productos activos');
define('GOOGLE_FEED_CHOOSE_PRODUCTS_2_TITLE', 'productos con estado XML activo');
define('GOOGLE_FEED_CHOOSE_PRODUCTS_3_TITLE', 'productos con disponibilidad de stock');
define('XSELL_PRODUCTS_BUYNOW_ENABLED_TITLE', 'Productos relacionados');
define('STATS_PRODUCTS_PURCHASED_BY_CATEGORY_MODULE_ENABLED_TITLE', 'Report - Products purchased (by Category)');
define('SALEMAKER_MODULE_ENABLED_TITLE', 'Mass Discounts (SaleMaker)');
define('SPECIALS_MODULE_ENABLED_TITLE', 'Descuentos');
define('STATS_KEYWORDS_ENABLED_TITLE', 'Consultas de búsqueda');
define('BACKUP_ENABLED_TITLE', 'Database Backup');
define('PRODUCTS_MULTI_ENABLED_TITLE', 'Products multi-manager');
define('SEO_TEMPLATES_ENABLED_TITLE', 'Plantillas SEO');
define('SHIP2PAY_ENABLED_TITLE', 'Ship 2 Pay');
define('QTY_PRO_ENABLED_TITLE', 'Combinaciones de atributos');
define('SMSINFORM_MODULE_ENABLED_TITLE', 'SMS module');
define('CARDS_ENABLED_TITLE', 'Credit cards (13 methods)');
define('SOCIAL_WIDGETS_ENABLED_TITLE', 'Social widgets');
define('MULTICOLOR_ENABLED_TITLE', 'Multicolor');
define('WATERMARK_ENABLED_TITLE', 'Watermarking');

define('FACEBOOK_APP_ID_TITLE', 'Facebook app ID');
define('FACEBOOK_APP_SECRET_TITLE', 'Facebook secret key');
define('VK_APP_ID_TITLE', 'Vkontakte app ID');
define('VK_APP_SECRET_TITLE', 'Vkontakte secret key');

define('TABLE_HEADING_ORDERS', 'Orders:');
define('TABLE_HEADING_LAST_ORDERS', 'Last orders');
define('TABLE_HEADING_CUSTOMER', 'Customer');
define('TABLE_HEADING_ORDER_NUMBER', '#');
define('TABLE_HEADING_ORDER_TOTAL', 'Total');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_DATE', 'Date');

define('TEXT_GO_TO_CAT', 'Select category');
define('TEXT_GO_TO_SEARCH', 'Search');
define('TEXT_GO_TO_SEARCH2', 'by product<br>model');

include('includes/languages/order_edit_spanish.php');

define('TEXT_VALID_TITLE', 'Categories list');
define('TEXT_VALID_TITLE_PROD', 'Products list');
define('TEXT_VALID_CLOSE', 'Close window');

define('TABLE_HEADING_LANGUAGE_STATUS', 'Estado');
define('TABLE_HEADING_LASTNAME', 'Last name');
define('TABLE_HEADING_FIRSTNAME', 'First name');
define('TABLE_HEADING_PRODUCT_NAME', 'Name');
define('TABLE_HEADING_PRODUCT_PRICE', 'Price');
define('TEXT_SELECT_CUSTOMER', 'Select customer');
define('TEXT_SELECT_CUSTOMER_PLACEHOLDER', 'Comience a ingresar la ID del cliente / nombre / teléfono / dirección de correo electrónico');
define('TEXT_SINGLE_CUSTOMER', 'Cliente único');
define('TEXT_EMAIL_RECIPIENT', 'Destinatario del correo');

define('TEXT_NOTIFICATIONS', 'Notifications');
define('TEXT_NOTIFICATIONS_MESSAGE', 'You have %s orders awaiting for review');
define('TEXT_NOTIFICATIONS_LINK', 'Go to the orders page');

define('TEXT_PROFILE', 'Profile');
define('TEXT_PROFILE_GREETINGS', 'Hi, %s!');
define('TEXT_PROFILE_LOGIN_COUNT', 'Login count: %s');
define('TEXT_PROFILE_DAYS_WITH_US', 'You are with us for %s days');

define('TEXT_MENU_TITLE', 'Navigation');
define('TEXT_MENU_HOME', 'Home');
define('TEXT_MENU_PRODUCTS', 'Products');
define('TEXT_MENU_CATALOGUE', 'Catalogue');
define('TEXT_MENU_ATTRIBUTES', 'Attributes');
define('TEXT_MENU_ORDERS', 'Orders');
define('TEXT_MENU_ORDERS_LIST', 'Orders List');
define('TEXT_MENU_CLIENTS_LIST', 'Clients List');
define('TEXT_MENU_CLIENTS_GROUPS', 'Clients Groups');
define('TEXT_MENU_ADD_CLIENT', 'Add Client');
define('TEXT_MENU_PAGES', 'Pages');
define('TEXT_MENU_SITE_MODULES', 'Módulos SOLO');
define('TEXT_MENU_SITE_SEO_SETTINGS', 'Configuración de SEO');
define('TEXT_MENU_BACKUP', 'Database Backup');
define('TEXT_MENU_NEWSLETTERS', 'Newsletters');
define('TEXT_MENU_SLOW_QUERIES_LOGS', 'Slow Queries Logs');
define('TEXT_MENU_PRODUCTS_VIEWS', 'Products Views');
define('TEXT_MENU_CLIENTS', 'Clients');
define('TEXT_MENU_SALES', 'Sales');
define('TEXT_MENU_ADMINS_AND_GROUPS', 'Admins & Groups');
define('TEXT_MENU_UPDATE_PROFILE', 'Update Profile');
define('TEXT_MENU_NOPHOTO', 'Sin fotografía');
define('TEXT_MENU_OPENEDBY', 'Abierto por');
define('TEXT_MENU_LAST_MODIFIED', 'Última modificación');
define('TEXT_MENU_ZEROQTY', 'Cantidad cero');
define('TEXT_MENU_STATS_RECOVER_CART_SALES', 'Estadísticas Recuperar ventas de carro');
define('TEXT_MENU_SEARCH', 'Buscar por categoria');

define('TEXT_HEADING_ADD_NEW', 'Add');
define('TEXT_HEADING_ADD_NEW_PRODUCT', 'Product');
define('TEXT_HEADING_ADD_NEW_CATEGORY', 'Category');
define('TEXT_HEADING_ADD_NEW_PAGE', 'Page');
define('TEXT_HEADING_ADD_NEW_CLIENT', 'Client');
define('TEXT_HEADING_ADD_NEW_ORDER', 'Order');
define('TEXT_HEADING_ADD_NEW_COUPON', 'Coupon');

define('TEXT_BLOCK_ORDERS_STATUSES_COUNTERS', 'Orders\' Statuses');

define('TEXT_BLOCK_ORDERS_TODAY_COUNTERS', 'Today');
define('TEXT_BLOCK_ORDERS_YESTERDAY_COUNTERS', 'Yesterday');
define('TEXT_BLOCK_ORDERS_WEEK_COUNTERS', 'Week');
define('TEXT_BLOCK_ORDERS_MONTH_COUNTERS', 'Month');
define('TEXT_BLOCK_ORDERS_QUARTER_COUNTERS', 'Quarter');
define('TEXT_BLOCK_ORDERS_ALL_TIME_COUNTERS', 'All Time');
define('TEXT_BLOCK_ORDERS_BY_PERIOD_COUNTERS_CURRENCY', 'uah');
define('TEXT_BLOCK_ORDERS_BY_PERIOD_PREFIX', 'for');
define('TEXT_BLOCK_ORDERS_BY_PERIOD_COUNTERS_NOUN', 'orders');

define('TEXT_BLOCK_COUNTERS_PRODUCTS', 'Products');
define('TEXT_BLOCK_COUNTERS_ORDERS', 'Orders');
define('TEXT_BLOCK_COUNTERS_COMMENTS', 'Comments');
define('TEXT_BLOCK_COUNTERS_TOTAL_INCOME', 'Total Income');

define('TEXT_BLOCK_SETTINGS_TITLE', 'Settings');
define('TEXT_BLOCK_SETTINGS_TITLE_FIXED_HEADER', 'Fixed header');
define('TEXT_BLOCK_SETTINGS_TITLE_FIXED_ASIDE', 'Fixed aside');
define('TEXT_BLOCK_SETTINGS_TITLE_FOLDED_ASIDE', 'Folded aside');
define('TEXT_BLOCK_SETTINGS_TITLE_DOCK_ASIDE', 'Dock aside');

define('TEXT_BLOCK_MODULES_STATS_USING', 'Using');
define('TEXT_BLOCK_MODULES_STATS_AMOUNT', 'pc.');
define('TEXT_BLOCK_MODULES_STATS_MODULES', 'of modules');
define('TEXT_BLOCK_MODULES_USED', 'Modules used');
define('TEXT_BLOCK_MODULES_SEE_ALL', 'See all modules');
define('TEXT_MENU_EMAIL_CONTENT', 'Plantillas de correo electrónico');
define('TEXT_MENU_CKFINDER', 'File manager');

define('TEXT_BLOCK_OVERVIEW_TITLE', 'Overview');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS', 'Orders');
define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED', 'TOP Views');
define('TEXT_BLOCK_OVERVIEW_MOST_SOLD', 'TOP Sales');
define('TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES', 'Top Categories');
define('TEXT_BLOCK_OVERVIEW_LATEST_LOGINS', 'Logins');
define('TEXT_BLOCK_OVERVIEW_MOST_SEARCHED', 'Searches');

define('TEXT_BLOCK_OVERVIEW_ACTION_EDIT', 'Edit');
define('TEXT_BLOCK_OVERVIEW_ACTION_VIEW', 'View');

define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_CUSTOMER_NAME', 'Customer Name');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_DATE', 'Date');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_AMOUNT', 'Amount');
define('TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_STATUS', 'Status');

define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED_PRODUCT_IMAGE', 'Product Image');
define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED_PRODCUT_NAME', 'Product Name');
define('TEXT_BLOCK_OVERVIEW_MOST_VIEWED_VIEWS', 'Views');

define('TEXT_BLOCK_OVERVIEW_MOST_SOLD_PRODUCT_IMAGE', 'Product Image');
define('TEXT_BLOCK_OVERVIEW_MOST_SOLD_PRODCUT_NAME', 'Product Name');
define('TEXT_BLOCK_OVERVIEW_MOST_SOLD_ORDERS', 'Orders');

define('TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES_CATEGORY_NAME', 'Category Name');
define('TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES_ORDERS', 'Orders');

define('TEXT_BLOCK_OVERVIEW_LATEST_LOGINS_ADMIN_NAME', 'Admin Name');
define('TEXT_BLOCK_OVERVIEW_LATEST_LOGINS_DATE', 'Last Login Date');

define('TEXT_BLOCK_OVERVIEW_MOST_SEARCHED_QUERY', 'Search Query');
define('TEXT_BLOCK_OVERVIEW_MOST_SEARCHED_COUNT', 'Search Count');

define('TEXT_BLOCK_NEWS_TITLE', 'SoloMono News');

define('TEXT_BLOCK_PLOT_TITLE', 'Income Plot');
define('TEXT_BLOCK_PLOT_TAB_BY_DAYS', 'By days');
define('TEXT_BLOCK_PLOT_TAB_BY_WEEKS', 'By weeks');
define('TEXT_BLOCK_PLOT_TAB_BY_MONTHES', 'By monthes');

define('TEXT_BLOCK_PLOT_XAXIS_LABEL', 'Total income');
define('TEXT_BLOCK_PLOT_YAXIS_LABEL', 'Orders count');

define('TEXT_BLOCK_COMMENTS_TITLE', 'Comments');

define('TEXT_BLOCK_EVENTS_TITLE', 'Events');

define('TEXT_BLOCK_EVENTS_TOOLTIP_ALL_EVENTS', 'All events');
define('TEXT_BLOCK_EVENTS_TOOLTIP_ADMINS', 'Admins');
define('TEXT_BLOCK_EVENTS_TOOLTIP_ORDERS', 'Orders');
define('TEXT_BLOCK_EVENTS_TOOLTIP_CUSTOMERS', 'Customers');
define('TEXT_BLOCK_EVENTS_TOOLTIP_NEW_PRODUCTS', 'New products');
define('TEXT_BLOCK_EVENTS_TOOLTIP_COMMENTS', 'Comments');
define('TEXT_BLOCK_EVENTS_TOOLTIP_CALL_ME_BACK', 'Call me back');

define('TEXT_BLOCK_EVENTS_MESSAGE_ADMINS', '%s entered system');
define('TEXT_BLOCK_EVENTS_MESSAGE_ORDERS', 'Got %s');
define('TEXT_BLOCK_EVENTS_MESSAGE_ORDERS_2', 'order #%d');
define('TEXT_BLOCK_EVENTS_MESSAGE_CUSTOMERS', '%s registered on the site');
define('TEXT_BLOCK_EVENTS_MESSAGE_NEW_PRODUCTS', 'New product added: "%s"');
define('TEXT_BLOCK_EVENTS_MESSAGE_COMMENTS', 'User %s added comment');
define('TEXT_BLOCK_EVENTS_MESSAGE_CALL_ME_BACK', 'asked for call back');

define('TEXT_BLOCK_GA_TITLE', 'Google Analytics');

define('TEXT_SETTINGS_EDIT_FORM_SAVE', 'OK');
define('TEXT_SETTINGS_EDIT_FORM_CANCEL', 'Cancel');
define('TEXT_SETTINGS_EDIT_FORM_TOOLTIP', 'edit');

define('TEXT_MODAL_ADD_ACTION', 'Add');
define('TEXT_MODAL_UPDATE_ACTION', 'Update');
define('TEXT_MODAL_DELETE_ACTION', 'Delete');
define('TEXT_MODAL_CHANGE_STATUS', 'Change status');
define('TEXT_MODAL_DETAILED', 'Detailed');
define('TEXT_MODAL_ACTION', 'Action');
define('TEXT_MODAL_INSTALL_ACTION', 'Install');
define('TEXT_MODAL_CONTINUE_ACTION', 'Continue');
define('TEXT_MODAL_CANCEL_ACTION', 'Cancel');
define('TEXT_MODAL_CONFIRM_ACTION', 'Confirm');
define('TEXT_MODAL_CONFIRMATION_ACTION', 'Are you sure?');
define('TEXT_WAIT', 'Wait ..');
define('TEXT_SHOW', 'To the page:');
define('TEXT_RECORDS', 'To the page:');
define('TEXT_SAVE_DATA_OK', 'Data successfully changed');
define('TEXT_DEL_OK', 'Record deleted successfully');
define('TEXT_ERROR', 'There was an error');
define('TEXT_GENERAL_SETTING', 'General');

//featured
define('TEXT_FEATURED_ADDED', 'Added');
define('TEXT_FEATURED_CHANGE', 'Changed');
define('TEXT_FEATURED_EXPIRE_DATE', 'Expire date');
define('TEXT_ENTER_PRODUCT', 'Enter product name');
define('TEXT_FEATURED_MODEL', 'Model');
define('TEXT_PRODUCTS_ON_ATTRIBUTES_VAL', 'Productos con valor de esta opción');

define('ADMIN_BTN_BUY_MODULE', 'Buy this module!');
define('FOOTER_INSTRUCTION', 'Instruction');
define('FOOTER_NEWS', 'NEWS');
define('FOOTER_SUPPORT_TECHNICAL', 'Apoyo técnico');
define('FOOTER_SUPPORT_SOLOMONO', 'SoloMono Support');

//languages_translater
define('TEXT_TRANSLATER_TITLE', 'Editor de lenguaje');

define('TEXT_PRODUCT_FREE_SHIPPING', 'Envío gratis:');


define('TEXT_MOBILE_OPEN_COLLAPSE', 'Mostrar');
define('TEXT_MOBILE_CLOSE_COLLAPSE', 'Ocultar');
define('TEXT_ORDER_STATISTICS', 'Estadísticas de pedidos');
define('TEXT_WHO_ONLINE', 'Quien esta en linea');
define('TEXT_VIEW_LIST', 'Ver lista');
define('TEXT_ACTION_OVERVIEW', 'Resumen de acción');
define('TEXT_SEE_ALL', 'Ver todos');

define('TEXT_MOBILE_SHOW_MORE', 'Mostrar mas');
define('TEXT_MOBILE_INCOME', 'Ingresos:');
define('TEXT_SHOW_ALL', 'Mostrar todo');
define('TEXT_REPLY_COMMENT', 'Responder para comentar - ');
define('TEXT_BTN_REPLY', 'Responder');
define('TEXT_BTN_ANSWERED', 'Respondido');
define('TEXT_MODAL_APPLY_ACTION', 'Para aplicar');


define('RECOVER_CART_SALES', 'Recuperar ventas de carro');


define('RCS_CONF_TITLE', 'Pedidos incompletos');

define('TEXT_REDIRECTS_TITLE', 'Redireccionamientos');


define ('INSTAGRAM_PRODUCTS_TITLE', 'Importar desde Instagram');
define ('INSTAGRAM_PRODUCTS_RESULT', 'Productos cargados en la base de datos');
define ('INSTAGRAM_SUCCESS', '¡Se han agregado publicaciones de Instagram a nuestro sitio!');
define ('INSTAGRAM_LINK', 'Enlace de Instagram');
define ('INSTAGRAM_COUNT', 'Número de publicaciones');

define('TEXT_ENABLE_MULTILANGUAGE_MODULE', 'Habilite el módulo multilingüe');
define('TEXT_BUY_MULTILANGUAGE_MODULE', 'Compra el módulo multilingüe');











define('BOX_PRODUCTS_STATS_MENU_ITEM', 'Producto');


define('BOX_CLIENTS_STATS_TOP_CLIENTS', 'Mejores clientes');
define('BOX_CLIENTS_STATS_NEW_CLIENTS', 'Nuevos clientes');


define('BOX_MENU_TOOLS_EMAILS', 'Boletín electrónico');
define('BOX_MENU_TOOLS_MASS_EMAILS', 'Correo masivo');


define('BOX_EXEL_IMPORT_EXPORT', 'Importación / exportación de Excel');
define('BOX_PROM_IMPORT_EXPORT', 'Prom.ua Excel import');
define('IMPORT_EXPORT_MENU_BOX', 'Importación y exportación');


define('BOX_MENU_TAXES', 'Impuesto');


define('INTEGRATION_CONF_TITLE', 'Otras integraciones');

define('BOX_HEADING_INSTRUCTION', 'Instrucciones');

define('BOX_CATALOG_YML', 'Importación de YML');
define('TOOLTIP_CATEGORY_STATUS', 'Cuando se activa, la categoría / subcategoría / producto se muestra en la página del sitio.');
define('TOOLTIP_CATEGORY_GOOGLE_FEED_STATUS', 'Para agregar una categoría / subcategoría / producto a Google Feed. Para incluir un solo producto, se debe incluir la categoría y subcategoría en la que se encuentra el producto.');
define('TOOLTIP_PRODUCTS_FEATURED', 'Se muestra en la página de inicio.');
define('TOOLTIP_PRODUCTS_RELATED', 'Mostrado en la página del producto, en artículos.');
define('TOOLTIP_PRODUCTS_ATTRIBUTES', 'Los atributos (filtros) le permiten definir características adicionales del producto, como el tamaño o el color. Leer más en las instrucciones: LINK');
define('TOOLTIP_ATTRIBUTES_VALUES', 'Después de crear el atributo, complete los valores requeridos.');
define('TOOLTIP_ATTRIBUTES_GROUPS', 'Para combinar múltiples atributos en un grupo.');
define('TOOLTIP_ATTRIBUTES_TYPES', 'Texto: una descripción textual de las características; Desplegable: selección de la lista desplegable; Radio: para elegir entre las opciones proporcionadas; Imagen: la tarjeta cambia cuando se selecciona el valor del artículo; Mostrado en la página del producto.');
define('TOOLTIP_ATTRIBUTES_SHOW_IN_FILTER', 'Para mostrar los atributos del producto en el panel de filtro, mueva el control deslizante para activarlo.');
define('TOOLTIP_ATTRIBUTES_SHOW_IN_LISTING', 'Al pasar el cursor sobre un producto, se muestran los atributos en la lista de productos.');
define('TOOLTIP_SPECIALS', 'Para fijar un precio especial para un producto.');
define('TOOLTIP_SALES_MAKERS', 'Establecer descuentos para varias o todas las categorías de productos y / o fabricantes.');
define('TOOLTIP_EXPORT_IMPORT_CSV', 'Para cargar / descargar una base de datos desde un archivo con extensión .csv.');
define('TOOLTIP_EXPORT_IMPORT_PROM', 'Para exportar una base de datos de un archivo importado de Prom.');
define('TOOLTIP_ORDER_DATE', 'Ver pedidos para el intervalo de tiempo seleccionado.');
define('TOOLTIP_ORDER_DETAILS', 'detalles del pedido');
define('TOOLTIP_ORDER_EDIT', 'editar orden');
define('TOOLTIP_ORDER_STATUS', 'Para agregar un nuevo estado de pedido, haga clic en &quot;+&quot;');
define('TOOLTIP_CLIENT_EDIT', 'editar');
define('TOOLTIP_CLIENT_GROUP_PRICE', 'El precio que se mostrará en el sitio para los clientes de un determinado grupo después de la autorización. El número de precios se establece en la sección &quot;Mi tienda&quot;.');
define('TOOLTIP_CLIENT_PRICE_GROUP_LIMIT', 'Cuando la cantidad alcanza el límite, puede transferir al cliente a otro grupo.');
define('TOOLTIP_CLIENT_GROUP_EDIT', 'editar');
define('TOOLTIP_EMAIL_TEMPLATE', 'Plantillas de cartas listas para enviar a los clientes.');
define('TOOLTIP_EMAIL_TEMPLATE_EDIT', 'editar');
define('TOOLTIP_FILE_MANAGER', 'Para cargar y editar archivos en el sitio.');
define('TOOLTIP_REDIRECTS', 'Por ejemplo, debe redirigir de https://demo.solomono.net/kontakty a https://demo.solomono.net/contact_us.php. Debe especificar en la línea &quot;redireccionar desde&quot; kontakty &quot;redireccionar a&quot; contact_us.php');
define('TOOLTIP_MODULES_PAYMENT', 'Agrega métodos de pago disponibles.');
define('TOOLTIP_MODULES_SHIPPING', 'Agregue los métodos de envío disponibles.');
define('TOOLTIP_MODULES_TOTALS', 'El costo total del pedido se muestra en la página de pago.');
define('TOOLTIP_MODULES_ZONE', 'Especifique los posibles métodos de entrega para determinadas zonas, así como los métodos de pago permitidos para estas zonas. Puede crear una nueva zona en Configuración-&gt; Impuestos-&gt; Zonas fiscales');
define('TOOLTIP_MODULES_LANGUAGES', 'Seleccionar idiomas del sitio, configurar el idioma predeterminado.');
define('TOOLTIP_MODULES_CURRENCY', 'Establezca la moneda predeterminada y establezca el valor de acuerdo con la tasa.');
define('TOOLTIP_MODULES_COUPONS', 'Cree un cupón para que el cliente lo aplique en el carrito y obtenga un descuento.');
define('TOOLTIP_MODULES_POOLS', 'Cree una encuesta para obtener las estadísticas que necesita.');
define('TOOLTIP_MODULES_SOLOMONO', 'Lista de módulos comprados + lista de disponibles para su compra.');
define('TOOLTIP_CONFIGURATION_MAIN_EMAIL', 'La dirección principal a la que llegan todas las notificaciones.');
define('TOOLTIP_CONFIGURATION_FROM_EMAIL', 'Especifique la dirección desde cuyo nombre enviar todas las cartas en envíos masivos.');
define('TOOLTIP_CONFIGURATION_ORDER_COPY_EMAIL', 'Especifique todas las direcciones a las que se enviarán copias de las cartas con los pedidos. Puede especificar varios correos electrónicos, separados por comas con espacios.');
define('TOOLTIP_CONTACT_US_EMAIL', 'Especifique la dirección a la que se enviarán las solicitudes desde la página &quot;Contáctenos&quot;');
define('TOOLTIP_STORE_COUNTRY', 'Especifique el país de la tienda, se seleccionará por defecto al realizar un pedido.');
define('TOOLTIP_STORE_REGION', 'Especifique la región de la tienda, se seleccionará por defecto al realizar un pedido.');
define('TOOLTIP_CONTACT_ADDRESS', 'Ingrese la dirección de la tienda, se mostrará en la página &quot;Contactos&quot;.');
define('TOOLTIP_MINIMUM_ORDER', 'Opcionalmente, puede especificar la cantidad mínima para un pedido exitoso.');
define('TOOLTIP_MASTER_PASSWORD', 'Una contraseña que es adecuada para ingresar a la cuenta de cualquier cliente registrado en el sitio.');
define('TOOLTIP_SHOW_PRICE_WITH_TAX', 'Mueva el control deslizante para mostrar los precios en todas las páginas del sitio, incluidos los impuestos.');
define('TOOLTIP_CALCULATE_TAX', 'Si se incluye, el impuesto sobre el producto establecido se considerará al finalizar la compra.');
define('TOOLTIP_EXTRA_PRICE', 'Opcionalmente, puede establecer un marcado que se mostrará a los usuarios no registrados del sitio.');
define('TOOLTIP_PRICES_COUNT', 'Indique el número posible de precios que se establecerán para los bienes (por ejemplo, varios precios para diferentes grupos de clientes)');
define('TOOLTIP_SHOW_PRICE_TO_NOT_AUTHORIZED_CUSTOMER', 'Visualización de precios de productos para usuarios no registrados');
define('TOOLTIP_LOGO', 'Seleccione el logotipo (imagen) que se mostrará en la página de inicio');
define('TOOLTIP_WATERMARK', 'Seleccione una imagen para superponerla a la foto del producto, protección de copia.');
define('TOOLTIP_FAVICON', 'Seleccione la imagen que se mostrará con el icono del sitio web');
define('TOOLTIP_AUTO_STOCK', 'Al realizar un pedido, se verifica automáticamente el número de mercancías en el almacén y su disponibilidad para el pedido.');
define('TOOLTIP_DISABLED_BUY_BUTTON_FOR_ZERO_STOCK', 'En la página de un producto que está agotado, se mostrará un botón &quot;comprar&quot;.');
define('TOOLTIP_STOCK_AUTO_INCREMENT', 'Al realizar un pedido, la cantidad de bienes comprados se deduce automáticamente del saldo en el almacén.');
define('TOOLTIP_ALLOW_ZERO_STOCK_ORDER', 'Permitir realizar un pedido de un producto que no está en stock.');
define('TOOLTIP_MARK_ZERO_STOCK_PRODUCT', 'Si el artículo agregado al carrito no está en la cantidad requerida en stock, el artículo se marcará con el valor especificado.');
define('TOOLTIP_ZERO_STOCK_NOTIFICATION', 'Cuando se alcanza esta cantidad, se envía una notificación al correo de que la mercancía se está agotando.');
define('TOOLTIP_SMS_TEXT', 'Especifique el texto que se enviará al cliente.');
define('TOOLTIP_SMS_LOGIN', 'Proporcionado por el proveedor de SMS.');
define('TOOLTIP_SMS_PASSWORD', 'Proporcionado por el proveedor de SMS.');
define('TOOLTIP_SMS_CODE_1', 'Número de teléfono o remitente alfanumérico.');
define('TOOLTIP_SMS_CODE_2', 'Proporcionado por el proveedor de SMS.');
define('TOOLTIP_TAX_ADD', 'Para agregar un nuevo tipo de impuesto, haga clic en &quot;+&quot; y complete los campos obligatorios.');
define('TOOLTIP_TAX_RATE_ADD', 'Para agregar una tasa de porcentaje que se agregará al costo del producto, haga clic en &quot;+&quot; y complete los campos obligatorios.');
define('TOOLTIP_TAX_ZONE_ADD', 'Para agregar una zona (país) a la que se aplicará el impuesto, haga clic en &quot;+&quot; y complete los campos obligatorios.');
define('TOOLTIP_BACKUP_CREATE', 'Cree una copia de seguridad de la versión actual de la base de datos del sitio.');
define('TOOLTIP_BACKUP_LOAD', 'Restaurando la base de datos del archivo seleccionado.');
define('TOOLTIP_EMAILING', 'Envío de un correo electrónico a un cliente, a todos los clientes o a todos los suscriptores de noticias.');
define('TOOLTIP_MASS_EMAILING', 'Envío de correos electrónicos a un cliente individual o a un grupo seleccionado de clientes.');
define('TOOLTIP_CLEAR_CACHE', 'Borrar imágenes cargadas de la caché.');
define('TOOLTIP_STATS_SALES', 'Visualización de estadísticas de ventas.');
define('TOOLTIP_STATS_SALES_PRODUCTS_BY_TIME_PERIOD', 'Informe de ventas de mercancías pedidas durante el período de tiempo seleccionado.');
define('TOOLTIP_STATS_SALES_CATEGORIES_BY_TIME_PERIOD', 'Informe de ventas por categorías de productos para el período de tiempo seleccionado.');
define('TOOLTIP_STATS_VIEWED_PRODUCTS', 'Estadísticas de productos vistos.');
define('TOOLTIP_STATS_ZERO_QUANTITY_PRODUCTS', 'El producto está agotado.');
define('TOOLTIP_STATS_CLIENTS_ORDERS', 'Informe sobre las compras de los clientes durante un período de tiempo seleccionado.');
define('TOOLTIP_ADMINISTRATORS', 'Lista de administradores del sitio.');
define('TOOLTIP_ADMINISTRATORS_GROUPS', 'Separación de administradores en grupos.');
define('TOOLTIP_ADMINISTRATORS_ACCESS_RIGHTS', 'Derechos de acceso a la información del sitio, según el grupo de administradores.');
define('TOOLTIP_TEXT_COPIED', 'Texto copiado');
define('TOOLTIP_TEXT_FORBIDDEN_MODULES', 'Para usar este módulo cómprelo');
define('TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY', 'comprar');
define('TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON', 'encender');
define('TOOLTIP_TEXT_TAB_LANGUAGES', 'Funcionalidad de idioma');
define('TOOLTIP_TEXT_TAB_AUTO_TRANSLATE', 'Traducción automática masiva de contenido');
define('TOOLTIP_TEXT_TAB_EDIT_TRANSLATE', 'Editar traducciones');
define('HIGHSLIDE_CLOSE', 'Cerrar');
define('COMMENT_BY_ADMIN', 'Comentario del administrador');
define('TEXT_MENU_WHO_IS_ONLINE', 'Quién está conectado');
define('INFO_ICON_NEED_MINIFY', 'Cualquier cambio en este módulo cambiará el estado de los estilos a Minificar ahora');
define('INFO_ICON_ENABLE_SMTP', 'Al encender, verifique la configuración del SMTP');
define('SMTP_CONF_TITLE', 'Configuración de SMTP');
define('INFO_ICON_NEED_GENERATE_CRITICAL', 'Los cambios en este parámetro requieren la regeneración de CSS crítico');
define('YANDEX_MARKET_MODULE_ENABLED_TITLE', 'XML (YML) products export "Yandex Market"');
define('AUTO_TRANSLATE_MODULE_ENABLED_TITLE', 'Traducción automática');
define('TEXT_INFO_BUY_MODULE', 'El módulo «%s» está desactivado, para encenderlo utilice la página <a href="%s"><span style="color:blue;" >Módulos</span></a>');
define('TEXT_INFO_DISABLE_MODULE', 'No hay módulo «%s», para agregarlo, use <a href="%s"><span style="color:blue;" >Tienda de módulos SoloMono</span></a>');
define("TEXT_POPULAR_SEARCH_QUERIES", "Búsquedas populares");
define('STATS_KEYWORDS_POPULAR_ENABLED_TITLE','Páginas de búsqueda');
define("LIST_MODAL_ON","Ventana modal de producto");
define("SHOW_BASKET_ON_ADD_TO_CART_TITLE","Mostrar carrito al agregar artículo");
define("TEXT_QUICK_ORDER", "Pedido rápido");
define("TEXT_VIEWED","Visto");
define('API_ENABLED_TITLE', 'Solomono API');
define('TEXT_MENU_API', 'API');
define('EMAIL_CONTENT_MODULE_ENABLED_TITLE', 'Plantillas de correo electrónico');
define('ENTRY_CREDIT_CARD_CC_TYPE', 'Tipo de tarjeta');
define('ENTRY_CREDIT_CARD_CC_OWNER', 'Propietario de la tarjeta');
define('ENTRY_CREDIT_CARD_CC_NUMBER', 'Número de tarjeta');
define('ENTRY_CREDIT_CARD_CC_EXPIRES', 'Tarjeta expira');
define('TEXT_SEARCH_PAGES','Páginas de búsqueda');
define('SMTP_MODULE_ENABLED_TITLE','SMTP');

define('LEFT_MENU_SECTION_TITLE_SHOP','Tienda');
define('LEFT_MENU_SECTION_TITLE_INFO','Información');
define('LEFT_MENU_SECTION_TITLE_CONTROL','Control');
define('TEXT_CLOSE_BUTTON', 'Close');
define('TBL_LINK_TITLE', 'Categorías de Ajax');
define('TBL_HEADING_TITLE_BACK_TO_PARENT', 'atrás');
define('TBL_HEADING_TITLE_SEARCH', 'Buscar');
define('TBL_HEADING_CATEGORIES_PRODUCTS', 'Categorías / Productos');
define('TBL_HEADING_MODEL', 'Código');
define('TBL_HEADING_QUANTITY', 'Cant');
define('TBL_HEADING_PRICE', 'Precio');
define('TBL_HEADING_TITLE_BACK_TO_DEFAULT_ADMIN', 'Volver a la administración predeterminada');
define('TBL_HEADING_PRODUCTS_COUNT', ' productos');
define('TBL_HEADING_SUBCATEGORIES_COUNT', ' subcategorías');
define('TBL_HEADING_SUBCATEGORIE_COUNT', ' subcategoría');
define('INTEGRATION_FACEBOOK_CONF_TITLE','Integración Facebook');
define('INTEGRATION_GOOGLE_CONF_TITLE','Integración GOOGLE');
define('SEO_SETTINGS_CONF_TITLE','Configuración de SEO');

define('FACEBOOK_GOALS_ADD_PAYMENT_INFO_TITLE','Objetivo \'AddPaymentInfo\' - completar la información de pago');
define('FACEBOOK_GOALS_ADD_TO_WISHLIST_TITLE','Objetivo \'AddToWishlist\' - añadir a la lista de deseos');
define('FACEBOOK_GOALS_CONTACT_US_REQUEST_TITLE','Objetivo \'Lead\' - solicitud en la página de contacto');
define('FACEBOOK_GOALS_VIEW_CONTENT_TITLE','Objetivo \'ViewContent\' - ver la página del producto');
define('FACEBOOK_GOALS_SUCCESS_PAGE_TITLE','Objetivo \'Purchase\' - página tras orden confirmada');
define('FACEBOOK_GOALS_CHECKOUT_PROCESS_TITLE','Objetivo \'InitiateCheckout\' - página de pago');
define('FACEBOOK_GOALS_SEARCH_RESULTS_TITLE','Objetivo \'Search\' - página de resultados de búsqueda');
define('FACEBOOK_GOALS_COMPLETE_REGISTRATION_TITLE','Objetivo \'CompleteRegistration\' - cuando el cliente se registró');
define('FACEBOOK_GOALS_ADD_TO_CART_TITLE','Objetivo \'AddToCart\' - Añadir al carrito');
define('FACEBOOK_GOALS_PAGE_VIEW_TITLE','Objetivo \'PageView\' - en cada página');
define('FACEBOOK_GOALS_CLICK_FAST_BUY_TITLE','Objetivo \'FastBuy\' - cuando el cliente hace clic en el botón \'Pedido rápido\' en la página del producto');
define('FACEBOOK_GOALS_CLICK_ON_CHAT_TITLE','Objetivo \'ClickChat\' - cuando el cliente hace clic en el botón Chat');
define('FACEBOOK_GOALS_CALLBACK_TITLE','Objetivo \'Callback\' - cuando el cliente hace clic en el botón \'Devolución de llamada\' en el encabezado del sitio');
define('FACEBOOK_GOALS_FILTER_TITLE','Objetivo \'filter\' - cuando el cliente utiliza un filtro para buscar productos');
define('FACEBOOK_GOALS_SUBSCRIBE_TITLE','Objetivo \'Subscribe\' - cuando el cliente se ha suscrito');
define('FACEBOOK_GOALS_LOGIN_TITLE','Objetivo \'login\' - cuando el cliente ha iniciado sesión');
define('FACEBOOK_GOALS_ADD_REVIEW_TITLE','Objetivo \'add_review\' - cuando el cliente agregó una reseña');
define('FACEBOOK_GOALS_PHONE_CALL_TITLE','Objetivo \'PhoneCall\' - cuando el cliente hace clic en el número de teléfono en el encabezado del sitio');
define('FACEBOOK_GOALS_CLICK_ON_BUG_REPORT_TITLE','Objetivo \'BugReport\' - cuando el cliente haga clic en \'Enviar mensaje de error\' en el pie de página del sitio');

define('NWPOSHTA_DELIVERY_TITLE', 'Nueva dirección de entrega de correo');

define('HEADER_BUY_TEMPLATE_LINK','Cambiar a paquete pago');
define('HEADER_MARKETPLACE_LINK','Marketplace de módulos');
define('TEXT_CATEGORIES', 'Categorías');
define('HEADING_TITLE_GOTO', 'Ir a:');
define('ERROR_DOMAIN_IN_USE','¡Error! Este dominio ya está en uso');
define('ERROR_ANAME_MISMATCH', '¡Error! El nombre A no coincide con 167.172.41.152. Inténtalo más tarde');
define('SUCCESS_DOMAIN_CHANGE', '¡Éxito! Dominio cambiado');
define('ERROR_ADD_DOMAIN_FIRST','¡Primero conecta tu dominio personalizado!');
define('ERROR_BASH_EXECUTION','Error al ejecutar el script, administrador de contactos');
define('ERROR_SIMLINK_CREATE', 'Enlace simbólico no creado');
define('ERROR_FOLDER_RENAME', 'Carpeta no copiada');

define('PRODUCTS_LIMIT_REACHED_FREE', '¡Límite de productos superado! Su sitio se desactivará automáticamente en %s días. <a href="%s">Alquile una tarifa</a> o elimine los productos no deseados');
define('PRODUCTS_LIMIT_REACHED_JUNIOR', '¡Límite de producto superado! En %s días su sitio se actualizará automáticamente al paquete seo.');
define('PRODUCTS_LIMIT_REACHED_SEO', '¡Límite de producto superado! En %s días su sitio se actualizará automáticamente al paquete profesional');
define('PRODUCTS_LIMIT_REACHED_HEADING', '¡Límite de producto excedido!');