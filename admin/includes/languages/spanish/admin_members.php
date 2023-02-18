<?php
/*
  $Id: admin_members.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

if ($_GET['gID']) {
  define('HEADING_TITLE', 'Admin Groups');
} elseif ($_GET['gPath']) {
  define('HEADING_TITLE', 'Define Groups');
}elseif(!empty($_GET['info']) && $_GET['info'] == 'admin_groups'){
	define('HEADING_TITLE', 'Grupos de administradores');
}elseif(!empty($_GET['info']) && $_GET['info'] == 'admin_files'){
	define('HEADING_TITLE', 'Derechos de acceso');
}else{
	define('HEADING_TITLE', 'Administración');
}
define('ADMIN_LIST', 'Lista de administrador');


define('TEXT_COUNT_GROUPS', 'Groups: ');
define('TABLE_HEADING_NAME', 'Name');
define('TABLE_HEADING_EMAIL', 'Email Address');
define('TABLE_HEADING_PASSWORD', 'Password');
define('TABLE_HEADING_CONFIRM', 'Confirm Password');
define('TABLE_HEADING_GROUPS', 'Groups Level');
define('TABLE_HEADING_PAGES_REDIRECT', 'Admin Redirect Page Name');
define('TABLE_HEADING_CREATED', 'Account Created');
define('TABLE_HEADING_MODIFIED', 'Account Created');
define('TABLE_HEADING_LOGDATE', 'Last Access');
define('TABLE_HEADING_LOGNUM', 'LogNum');
define('TABLE_HEADING_LOG_NUM', 'Log Number');
define('TABLE_HEADING_ACTION', 'Action');

define('TABLE_HEADING_GROUPS_NAME', 'Groups Name');
define('TABLE_HEADING_GROUPS_DEFINE', 'Boxes and Files Selection');
define('TABLE_HEADING_GROUPS_GROUP', 'Level');
define('TABLE_HEADING_GROUPS_CATEGORIES', 'Categories Permission');


define('TEXT_INFO_HEADING_DEFAULT', 'Admin Member ');
define('TEXT_INFO_HEADING_DELETE', 'Delete Permission ');
define('TEXT_INFO_HEADING_EDIT', 'Edit Category / ');
define('TEXT_INFO_HEADING_NEW', 'New Admin Member ');

define('TEXT_ADMIN_LIST', 'Lista de administradores');
define('TEXT_ADMIN_GROUPS', 'Grupos de administradores');
define('TEXT_ADMIN_ACCESS', 'Derechos de acceso');

define('TEXT_INFO_DEFAULT_INTRO', 'Member group');
define('TEXT_INFO_DELETE_INTRO', 'Remove <nobr><b>%s</b></nobr> from <nobr>Admin Members?</nobr>');
define('TEXT_INFO_DELETE_INTRO_NOT', 'You can not delete <nobr>%s group!</nobr>');
define('TEXT_INFO_EDIT_INTRO', 'Set permission level here: ');
define('TEXT_INFO_CHANGE_PASSWORD', 'Cambiar su propia contraseña');

define('TEXT_INFO_FULLNAME', 'Name: ');
define('TEXT_INFO_FIRSTNAME', 'Firstname: ');
define('TEXT_INFO_LASTNAME', 'Lastname: ');
define('TEXT_INFO_EMAIL', 'Email Address: ');
define('TEXT_INFO_PASSWORD', 'Password: ');
define('TEXT_INFO_CONFIRM', 'Confirm Password: ');
define('TEXT_INFO_CREATED', 'Account Created: ');
define('TEXT_INFO_MODIFIED', 'Account Modified: ');
define('TEXT_INFO_LOGDATE', 'Last Access: ');
define('TEXT_INFO_LOGNUM', 'Log Number: ');
define('TEXT_INFO_GROUP', 'Group Level: ');
define('TEXT_INFO_ERROR', '<span>Email address has already been used! Please try again.</span>');

define('JS_ALERT_FIRSTNAME', '- Required: Firstname \n');
define('JS_ALERT_LASTNAME', '- Required: Lastname \n');
define('JS_ALERT_EMAIL', '- Required: Email address \n');
define('JS_ALERT_EMAIL_FORMAT', '- Email address format is invalid! \n');
define('JS_ALERT_EMAIL_USED', '- Email address has already been used! \n');
define('JS_ALERT_LEVEL', '- Required: Group Member \n');

define('ADMIN_EMAIL_SUBJECT', 'New Admin Member');
define('ADMIN_EMAIL_TEXT', 'Hi %s,' . "\n\n" . 'You can access the admin panel with the following password. Once you access the admin, please change your password!' . "\n\n" . 'Website : %s' . "\n" . 'Username: %s' . "\n" . 'Password: %s' . "\n\n" . 'Thanks!' . "\n" . '%s' . "\n\n" . 'This is an automated response, please do not reply!'); 
define('ADMIN_EMAIL_EDIT_SUBJECT', 'Admin Member Profile Edit');
define('ADMIN_EMAIL_EDIT_TEXT', 'Hi %s,' . "\n\n" . 'Your personal information has been updated by an administrator.' . "\n\n" . 'Website : %s' . "\n" . 'Username: %s' . "\n" . 'Password: %s' . "\n\n" . 'Thanks!' . "\n" . '%s' . "\n\n" . 'This is an automated response, please do not reply!'); 

define('TEXT_INFO_HEADING_DEFAULT_GROUPS', 'Admin Group ');
define('TEXT_INFO_HEADING_DELETE_GROUPS', 'Delete Group ');

define('TEXT_INFO_DEFAULT_GROUPS_INTRO', '<b>NOTE:</b><li><b>edit:</b> edit group name.</li><li><b>delete:</b> delete group.</li><li><b>define:</b> define group access.</li>');
define('TEXT_INFO_DELETE_GROUPS_INTRO', 'It\'s also will delete member of this group. Are you sure want to delete <nobr><b>%s</b> group?</nobr>');
define('TEXT_INFO_DELETE_GROUPS_INTRO_NOT', 'You can not delete this groups!');
define('TEXT_INFO_GROUPS_INTRO', 'Give an unique group name. Click next to submit.');

define('TEXT_INFO_HEADING_GROUPS', 'New Group');
define('TEXT_INFO_GROUPS_NAME', ' <b>Group Name:</b><br>Give an unique group name. Then, click next to submit.<br>');
define('TEXT_INFO_GROUPS_NAME_FALSE', '<span><b>ERROR:</b> At least the group name must have more than 2 character!</span>');
define('TEXT_INFO_GROUPS_NAME_USED', '<span><b>ERROR:</b> Group name has already been used!</span>');
define('TEXT_INFO_GROUPS_LEVEL', 'Group Level: ');
define('TEXT_INFO_GROUPS_BOXES', '<b>Boxes Permission:</b><br>Give access to selected boxes.');
define('TEXT_INFO_GROUPS_BOXES_INCLUDE', 'Include files stored in: ');

define('TEXT_INFO_HEADING_EDIT_GROUP', 'Edit group name');
define('TEXT_INFO_EDIT_GROUP_INTRO', 'You can change current name of this group, type new name and click Save button.');

define("stats_products_purchased.php", "Productos pedidos");
define("stats_customers_orders.php", "Pedidos de ventas");
define("template_configuration.php", "Configuración de plantilla");
define("easypopulate_functions.php", ".. EASYPOPULATE_FUNCTIONS ..");
define("create_account_process.php", "Proceso de creación de cuenta");
define("create_account_success.php", "Página de registro exitosa");
define("stats_customers_entry.php", "Inicio de sesión del cliente");
define("stats_products_viewed.php", "Elementos vistos");
define("languages_translater.php", "Traducción de idiomas");
define("create_order_process.php", "Proceso de creación de pedidos");
define("stats_sales_report2.php", "Estadísticas de ventas (2)");
define("total_configuration.php", "Editor de configuraciones");
define("stats_monthly_sales.php", "Ventas mensuales");
define("extra_product_price.php", "Precio adicional del producto");
define("products_attributes.php", "Atributos del producto");
define("stats_last_modified.php", "Cambios recientes");
define("stats_sales_report.php", "Informe sobre estadísticas de ventas");
define("attributeManager.php", "Administrador de atributos");
define("mysqlperformance.php", "Registro de consultas lentas");
define("customers_groups.php", "Grupos de clientes");
define("validcategories.php", "Categorías válidas");
define("stats_customers.php", "Estadísticas del cliente");
define("design_controls.php", "Controles de diseño");
define("stats_opened_by.php", "Estadísticas para nuevas cuentas");
define("create_account.php", "Crear cuenta");
define("listcategories.php", "Lista de categorías");
define("stats_keywords.php", "Consultas de búsqueda");
define("image_explorer.php", "Administrador de archivos");
define("xsell_products.php", "Productos asociados");
define("products_multi.php", "Gestión de productos");
define("manufacturers.php", "Fabricantes");
define("stats_zeroqty.php", "Productos que no están en stock");
define("configuration.php", "Configuración");

define("stats_nophoto.php", "Productos sin fotos");
define("quick_updates.php", "Actualización de precio");
define("validproducts.php", "Lista de productos");
define("configuration.php", "Mi tienda");
define("admin_members.php", "Administración del administrador");
define("orders_status.php", "Estado de los pedidos");
define("email_content.php", "Plantillas de correo electrónico");
define("administrator.php", "Administradores");
define("coupon_admin.php", "Cupones");
define("listproducts.php", "Lista de productos");
define("easypopulate.php", "Importar / Exportar Excel");
define("manudiscount.php", "Descuentos de fabricante");
define("localization.php", "Localización");
define("edit_orders.php", "Editar pedidos");
define("newsletters.php", "Administrador de la lista de correo");
define("tax_classes.php", "Lista de impuestos");
define("admin_files.php", "Menú de cuadros de administración");
define("whos_online.php", "Gente en línea");
define("currencies.php", "Monedas");
define("ajax_xsell.php", "Productos asociados a AJAX");
define("chart_data.php", ".. CHART_DATA ..");
define("categories.php", "Lista de productos");
define("tax_rates.php", "Tasas de impuestos");
define("salemaker.php", "Descuentos por volumen");
define("languages.php", "Idiomas");
define("pollbooth.php", ".. POLLBOTH ..");
define("customers.php", "Lista de clientes");
define("countries.php", "Países");
define("geo_zones.php", "Áreas geográficas");
define("customers.php", "Clientes");
define("articles.php", "Artículos");
define("products.php", "Editor de productos");
define("featured.php", "Productos destacados");
define("gv_admin.php", ".. GV_ADMIN ..");
define("specials.php", "Descuentos");
define("gv_queue.php", "Activación de certificado");
define("ship2pay.php", "Entrega-Pago");
define("reviews.php", "Comentarios");
define("articles.php", "Páginas");
define("modules.php", "Módulos");
define("reports.php", "Informes");
define("catalog.php", "Catálogo");
define("gv_mail.php", "Enviar certificado");
define("gv_sent.php", "Certificados enviados");
define("modules.php", "Módulos");
define("backup.php", "Database Backup");
define("orders.php", "Lista de pedidos");
define("taxes.php", "Impuestos");
define("cache.php", "Caché");
define("tools.php", "Herramientas");
define("polls.php", "Encuestas");
define("polls.php", "Votación");
define("zones.php", "Lista de regiones");
define("mail.php", "Enviar correo electrónico");

define('FILENAME_DEFAULT_TEXT', 'Inicio');
define('FILENAME_CATEGORIES_TEXT', 'Página de Categorías');

define('TEXT_INFO_HEADING_DEFINE', 'Define Group');
if ($_GET['gPath'] == 1) {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br>You can not change file permission for this group.<br><br>');
} else {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br>Change permission for this group by selecting or unselecting boxes and files provided. Click <b>save</b> to save the changes.<br><br>');
}
?>
