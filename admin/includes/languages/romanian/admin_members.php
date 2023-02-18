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
	define('HEADING_TITLE', 'Grupuri de administrare');
}elseif(!empty($_GET['info']) && $_GET['info'] == 'admin_files'){
	define('HEADING_TITLE', 'Drepturi de acces');
}else{
	define('HEADING_TITLE', 'Admin');
}
define('ADMIN_LIST', 'Lista de administratori');


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
define('TEXT_ADMIN_LIST', 'Admins list');
define('TEXT_ADMIN_GROUPS', 'Admin Groups');
define('TEXT_ADMIN_ACCESS', 'Access rights');

define('TEXT_INFO_DEFAULT_INTRO', 'Member group');
define('TEXT_INFO_DELETE_INTRO', 'Remove <nobr><b>%s</b></nobr> from <nobr>Admin Members?</nobr>');
define('TEXT_INFO_DELETE_INTRO_NOT', 'You can not delete <nobr>%s group!</nobr>');
define('TEXT_INFO_EDIT_INTRO', 'Set permission level here: ');

define('TEXT_INFO_FULLNAME', 'Name: ');
define('TEXT_INFO_FIRSTNAME', 'Firstname: ');
define('TEXT_INFO_LASTNAME', 'Lastname: ');
define('TEXT_INFO_EMAIL', 'Email Address: ');
define('TEXT_INFO_PASSWORD', 'Password ');
define('TEXT_INFO_CONFIRM', 'Confirm Password ');
define('TEXT_INFO_CHANGE_PASSWORD', 'Change own Password ');
define('TEXT_ERROR_NOT_MATCH_PASS', 'Password didn\'t match ');
define('TEXT_ERROR_EMPTY_PASS', 'Password is empty');
define('TEXT_ERROR_CNT_ADMIN', 'You can not delete the last admin.');

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
define('ADMIN_EMAIL_SUBJECT_PASS_NEW', 'New pass');
define('ADMIN_EMAIL_TEXT_CHANGE_PASS', 'Hi %s,' . "\n\n" . 'You can access the admin panel with the following password. ' . "\n\n" . 'Website : %s' . "\n" . 'Username: %s' . "\n" . 'Password: %s' . "\n\n" . 'Thanks!' . "\n" . '%s' . "\n\n" . 'This is an automated response, please do not reply!');

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

define("stats_products_purchased.php", "Ordered Products");
define("stats_customers_orders.php", "Sales Orders");
define("template_configuration.php", "Template configuration");
define("easypopulate_functions.php", ".. EASYPOPULATE_FUNCTIONS ..");
define("create_account_process.php", "Account Creation Process");
define("create_account_success.php", "Successful registration page");
define("stats_customers_entry.php", "Customer Login");
define("stats_products_viewed.php", "Viewed Items");
define("languages_translater.php", "Translation of languages");
define("create_order_process.php", "Order Creation Process");
define("stats_sales_report2.php", "Sales statistics (2)");
define("total_configuration.php", "Settings Editor");
define("stats_monthly_sales.php", "Monthly sales");
define("extra_product_price.php", "Additional Product Price");
define("products_attributes.php", "Product Attributes");
define("stats_last_modified.php", "Recent Changes");
define("stats_sales_report.php", "Report on sales statistics");
define("attributeManager.php", "Attributes Manager");
define("mysqlperformance.php", "Slow Query Log");
define("customers_groups.php", "Customer groups");
define("validcategories.php", "Valid Categories");
define("stats_customers.php", "Customer statistics");
define("design_controls.php", "Design Controls");
define("stats_opened_by.php", "Statistics for new accounts");
define("create_account.php", "Create Account");
define("listcategories.php", "List of categories");
define("stats_keywords.php", "Search Queries");
define("image_explorer.php", "File Manager");
define("xsell_products.php", "Associated Products");
define("products_multi.php", "Product Management");
define("manufacturers.php", "Manufacturers");
define("stats_zeroqty.php", "Products of which are not in stock");
define("configuration.php", "Configuration");

define("stats_nophoto.php", "Products without photos");
define("quick_updates.php", "Price Update");
define("validproducts.php", "Product List");
define("configuration.php", "My store");
define("admin_members.php", "Admin Management");
define("orders_status.php", "Status of orders");
define("email_content.php", "Email Templates");
define("administrator.php", "Administrators");
define("coupon_admin.php", "Promo codes");
define("listproducts.php", "Product List");
define("easypopulate.php", "Excel Import / Export");
define("manudiscount.php", "Manufacturer Discounts");
define("localization.php", "Localization");
define("edit_orders.php", "Edit Orders");
define("newsletters.php", "Mailing list manager");
define("tax_classes.php", "List of taxes");
define("admin_files.php", "Menu of admin boxes");
define("whos_online.php", "People Online");
define("currencies.php", "Currencies");
define("ajax_xsell.php", "AJAX Associated Products");
define("chart_data.php", ".. CHART_DATA ..");
define("categories.php", "Product List");
define("tax_rates.php", "Tax Rates");
define("salemaker.php", "Bulk discounts");
define("languages.php", "Languages");
define("pollbooth.php", ".. POLLBOTH ..");
define("customers.php", "Customer list");
define("countries.php", "Countries");
define("geo_zones.php", "Geographical areas");
define("customers.php", "Customers");
define("articles.php", "Articles");
define("products.php", "Product Editor");
define("featured.php", "Featured Products");
define("gv_admin.php", ".. GV_ADMIN ..");
define("specials.php", "Discounts");
define("gv_queue.php", "Certificate Activation");
define("ship2pay.php", "Delivery-Payment");
define("reviews.php", "Comments");
define("articles.php", "Pages");
define("modules.php", "Modules");
define("reports.php", "Reports");
define("catalog.php", "Catalog");
define("gv_mail.php", "Send Certificate");
define("gv_sent.php", "Sent Certificates");
define("modules.php", "Modules");
define("backup.php", "Database Backup");
define("orders.php", "List of orders");
define("taxes.php", "Taxes");
define("cache.php", "Cache");
define("tools.php", "Tools");
define("polls.php", "Polls");
define("polls.php", "Voting");
define("zones.php", "List of regions");
define("mail.php", "Send Email");

define('FILENAME_DEFAULT_TEXT', 'Main Page');
define('FILENAME_CATEGORIES_TEXT', 'Categories Page');

define('TEXT_INFO_HEADING_DEFINE', 'Define Group');
if ($_GET['gPath'] == 1) {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br>You can not change file permission for this group.<br><br>');
} else {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br>Change permission for this group by selecting or unselecting boxes and files provided. Click <b>save</b> to save the changes.<br><br>');
}
?>
