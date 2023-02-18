<?php
/*
  $Id: admin_members.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

if ($_GET['gID']) {
  define('HEADING_TITLE', 'Grupy');
} elseif ($_GET['gPath']) {
  define('HEADING_TITLE', 'Konfigurowanie grupy');
}elseif(!empty($_GET['info']) && $_GET['info'] == 'admin_groups'){
	define('HEADING_TITLE', 'Grupy administracyjne');
}elseif(!empty($_GET['info']) && $_GET['info'] == 'admin_files'){
	define('HEADING_TITLE', 'Prawa dostępu');
}else{
	define('HEADING_TITLE', 'Administrator');
}
define('ADMIN_LIST', 'Lista administracyjna');


define('TEXT_COUNT_GROUPS', 'Grupy: ');
define('TABLE_HEADING_NAME', 'Imię');
define('TABLE_HEADING_EMAIL', 'Email adres');
define('TABLE_HEADING_PASSWORD', 'Hasło');
define('TABLE_HEADING_CONFIRM', 'Zatwierdź hasło');
define('TABLE_HEADING_GROUPS', 'Grupa');
define('TABLE_HEADING_CREATED', 'Data utworzenia');
define('TABLE_HEADING_MODIFIED', 'Ostatnie zmiany');
define('TABLE_HEADING_LOGDATE', 'Ostatnie logowanie');
define('TABLE_HEADING_LOGNUM', 'Liczba logowań');
define('TABLE_HEADING_LOG_NUM', 'Liczba logowań');
define('TABLE_HEADING_ACTION', 'Działanie');

define('TABLE_HEADING_GROUPS_NAME', 'Nazwa grupy');
define('TABLE_HEADING_GROUPS_DEFINE', 'Boxy i pliki, dostępne dla danej grupy');
define('TABLE_HEADING_GROUPS_GROUP', 'Grupa');
define('TABLE_HEADING_GROUPS_CATEGORIES', 'Dostępne boxy i pliki');
define('TABLE_HEADING_PAGES_REDIRECT', 'Strona przekierowania administratora');

define('TEXT_ADMIN_LIST', 'Lista administratorów');
define('TEXT_ADMIN_GROUPS', 'Grupy administracyjne');
define('TEXT_ADMIN_ACCESS', 'Prawa dostępu');

define('TEXT_INFO_HEADING_DEFAULT', 'Administrator ');
define('TEXT_INFO_HEADING_DELETE', 'Usuń dostęp ');
define('TEXT_INFO_HEADING_EDIT', 'Edytuj grupę ');
define('TEXT_INFO_HEADING_NEW', 'Nowy administrator ');

define('TEXT_INFO_DEFAULT_INTRO', 'Grupa');
define('TEXT_INFO_DELETE_INTRO', 'Czy na pewno chcesz usunąć <nobr><b>%s</b></nobr> z <nobr>Administratorów?</nobr>');
define('TEXT_INFO_DELETE_INTRO_NOT', 'Nie możesz usunąć grupy <nobr>%s!</nobr>');
define('TEXT_INFO_EDIT_INTRO', 'Prawa dostępu do boxów i plików: ');

define('TEXT_INFO_FULLNAME', 'Imię: ');
define('TEXT_INFO_FIRSTNAME', 'Imię: ');
define('TEXT_INFO_LASTNAME', 'Nazwisko: ');
define('TEXT_INFO_EMAIL', 'Email adres: ');
define('TEXT_INFO_PASSWORD', 'Hasło: ');
define('TEXT_INFO_CONFIRM', 'Zatwierdź hasło: ');
define('TEXT_INFO_CREATED', 'Wpis utworzony: ');
define('TEXT_INFO_MODIFIED', 'Ostatnie zmiany: ');
define('TEXT_INFO_LOGDATE', 'Ostatnie logowanie: ');
define('TEXT_INFO_LOGNUM', 'Liczba logowań: ');
define('TEXT_INFO_GROUP', 'Grupa: ');
define('TEXT_INFO_ERROR', 'Dany Email adres już jest zarejestrowany! Spróbuj podać inny Email adres.');

define('TEXT_INFO_CHANGE_PASSWORD', 'Zmień własne hasło ');

define('JS_ALERT_FIRSTNAME',        '- Nie podałeś swoje Imię. \n');
define('JS_ALERT_LASTNAME',         '- Nie podałeś swoje Nazwisko. \n');
define('JS_ALERT_EMAIL',            '- Nie podałeś swój Email adres. \n');
define('JS_ALERT_EMAIL_FORMAT',     '- Nieprawidłowo wprowadzony Email adres! \n');
define('JS_ALERT_EMAIL_USED',       '- Dany Email adres już jest zarejestrowany! \n');
define('JS_ALERT_LEVEL', '- Nie podałeś grupy \n');

define('ADMIN_EMAIL_SUBJECT', 'Nowy administrator');
define('ADMIN_EMAIL_TEXT', 'Witamy, %s!' . "\n\n" . 'Możesz wejść do panelu administracyjnego za pomocą następującego hasła. Po przejściu do panelu administratora zalecamy zmianę hasła!' . "\n\n" . 'Strona internetowa: %s' . "\n" . 'Email: %s' . "\n" . 'Hasło: %s' . "\n\n" . 'Dziękujemy!' . "\n" . '%s' . "\n\n" . 'Wiadomość została wysłana automatycznie, nie musisz na nią odpowiadać!'); 
define('ADMIN_EMAIL_EDIT_SUBJECT', 'Twoje informacje zostały zmienione przez administratora');
define('ADMIN_EMAIL_EDIT_TEXT', 'Witamy, %s!' . "\n\n" . 'Twoje informacje zostały zmienione przez administratora.' . "\n\n" . 'Strona internetowa: %s' . "\n" . 'Email: %s' . "\n" . 'Hasło: %s' . "\n\n" . 'Dziękujemy!' . "\n" . '%s' . "\n\n" . 'Wiadomość została wysłana automatycznie, nie musisz na nią odpowiadać!'); 

define('TEXT_INFO_HEADING_DEFAULT_GROUPS', 'Grupa ');
define('TEXT_INFO_HEADING_DELETE_GROUPS', 'Usuń grupę ');

define('TEXT_INFO_DEFAULT_GROUPS_INTRO', '<b>UWAGA:</b><li><b>zmień:</b> zmiana nazwy grupy.</li><li><b>usuń:</b> usuń grupę.</li><li><b>dostęp do plików:</b> konfiguracja dostępu do boxów i plików.</li>');
define('TEXT_INFO_DELETE_GROUPS_INTRO', 'Usuwając tę grupę, usuniesz także wszystkich administratorów z tej grupy. Czy na pewno chcesz usunąć grupę <nobr><b>%s</b>?</nobr>');
define('TEXT_INFO_DELETE_GROUPS_INTRO_NOT', 'Nie możesz usunąć daną grupę!');
define('TEXT_INFO_GROUPS_INTRO', 'Nazwij nową grupę, a następnie kliknij "Dalej".');

define('TEXT_INFO_HEADING_GROUPS', 'Nowa grupa');
define('TEXT_INFO_GROUPS_NAME', ' <b>Nazwa grupa:</b><br>Wprowadź nazwę nowej grupy, a następnie kliknij przycisk "Dalej".<br>');
define('TEXT_INFO_GROUPS_NAME_FALSE', '<b>BŁĄD:</b> Nazwa grupy musi składać się z co najmniej 2 znaków!');
define('TEXT_INFO_GROUPS_NAME_USED', '<b>BŁĄD:</b> Podana nazwa grupy już jest, spróbuj nazwać grupę inaczej!');
define('TEXT_INFO_GROUPS_LEVEL', 'Grupa: ');
define('TEXT_INFO_GROUPS_BOXES', '<b>Prawa dostępu do boxów:</b><br>Zabezpieczenia dostępu do boxów');
define('TEXT_INFO_GROUPS_BOXES_INCLUDE', 'Dodaj plik do boxu: ');

define('TEXT_INFO_HEADING_EDIT_GROUP', 'Edytuj nazwę grupy');
define('TEXT_INFO_EDIT_GROUP_INTRO', 'Możesz zmienić nazwę grupy na nowe, wprowadź nową nazwę i naciśnij przycisk <b>zapisz</b>');

define("stats_products_purchased.php", "Zamówione produkty");
define("stats_customers_orders.php", "Zamówienia sprzedaży");
define("template_configuration.php", "Konfiguracja szablonu");
define("easypopulate_functions.php", ".. EASYPOPULATE_FUNCTIONS ..");
define("create_account_process.php", "Proces tworzenia konta");
define("create_account_success.php", "Strona rejestracji zakończona powodzeniem");
define("stats_customers_entry.php", "Logowanie klienta");
define("stats_products_viewed.php", "Oglądane przedmioty");
define("languages_translater.php", "Tłumaczenie języków");
define("create_order_process.php", "Proces tworzenia zamówienia");
define("stats_sales_report2.php", "Statystyka sprzedaży (2)");
define("total_configuration.php", "Edytor ustawień");
define("stats_monthly_sales.php", "Miesięczna sprzedaż");
define("extra_product_price.php", "Dodatkowa cena produktu");
define("products_attributes.php", "Product Attributes");
define("stats_last_modified.php", "Ostatnie zmiany");
define("stats_sales_report.php", "Raport o statystykach sprzedaży");
define("attributeManager.php", "Menedżer atrybutów");
define("mysqlperformance.php", "Slow Query Log");
define("customers_groups.php", "Grupy klientów");
define("validcategories.php", "Valid Categories");
define("stats_customers.php", "Statystyka klienta");
define("design_controls.php", "Design Controls");
define("stats_opened_by.php", "Statystyka nowych kont");
define("create_account.php", "Utwórz konto");
define("listcategories.php", "Lista kategorii");
define("stats_keywords.php", "Wyszukiwane hasła");
define("image_explorer.php", "Menedżer plików");
define("xsell_products.php", "Associated Products");
define("products_multi.php", "Product Management");
define("manufacturers.php", "Producenci");
define("stats_zeroqty.php", "Produkty których nie ma w magazynie");
define("configuration.php", "Configuration");

define("stats_nophoto.php", "Produkty bez zdjęć");
define("quick_updates.php", "Price Update");
define("validproducts.php", "Lista produktów");
define("configuration.php", "My store");
define("admin_members.php", "Admin Management");
define("orders_status.php", "Status zamówień");
define("email_content.php", "Szablony e-mail");
define("administrator.php", "Administratorzy");
define("coupon_admin.php", "Promo codes");
define("listproducts.php", "lista produktów");
define("easypopulate.php", "Excel Import / Export");
define("manudiscount.php", "Zniżki producenta");
define("localization.php", "Localization");
define("edit_orders.php", "Edytuj zamówienia");
define("newsletters.php", "Menedżer listy mailingowej");
define("tax_classes.php", "Lista podatków");
define("admin_files.php", "Menu skrzynek administracyjnych");
define("whos_online.php", "People Online");
define("currencies.php", "Waluty");
define("ajax_xsell.php", "AJAX Associated Products");
define("chart_data.php", ".. CHART_DATA ..");
define("categories.php", "Lista produktów");
define("tax_rates.php", "Stawki podatku");
define("salemaker.php", "Luzem rabaty");
define("languages.php", "Języki");
define("pollbooth.php", ".. POLLBOTH ..");
define("customers.php", "Lista klientów");
define("countries.php", "Kraje");
define("geo_zones.php", "Obszary geograficzne");
define("customers.php", "Klienci");
define("articles.php", "Artykuły");
define("products.php", "Product Editor");
define("featured.php", "Polecane produkty");
define("gv_admin.php", ".. GV_ADMIN ..");
define("specials.php", "Zniżki");
define("gv_queue.php", "Aktywacja certyfikatu");
define("ship2pay.php", "Delivery-Payment");
define("reviews.php", "Komentarze");
define("articles.php", "Strony");
define("modules.php", "Moduły");
define("reports.php", "raporty");
define("catalog.php", "Catalog");
define("gv_mail.php", "Send Certificate");
define("gv_sent.php", "Wysłane certyfikaty");
define("modules.php", "Moduły");
define("backup.php", "Database Backup");
define("orders.php", "Lista zamówień");
define("taxes.php", "podatki");
define("cache.php", "Cache");
define("tools.php", "Narzędzia");
define("polls.php", "Ankiety");
define("polls.php", "Głosowanie");
define("zones.php", "Lista regionów");
define("mail.php", "Wyślij e-mail");

define('FILENAME_DEFAULT_TEXT', 'Strona główna');
define('FILENAME_CATEGORIES_TEXT', 'Strona kategorii');

define('TEXT_INFO_HEADING_DEFINE', 'Konfigurowanie grupy');

if ($_GET['gPath'] == 1) {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br>Nie można zmienić dostępu do boxów i plików dla tej grupy.<br><br>');
} else {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br>Można ustawić lub usunąć dostęp do boxów i plików dla danej grupy. Kliknij na dole przycisk  <b>zapisz</b> aby zapisać zmiany.<br><br>');
}
?>
