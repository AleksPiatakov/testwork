<?php
if ($_GET['gID']) {
    define('HEADING_TITLE', 'Admin Groups');
} elseif ($_GET['gPath']) {
    define('HEADING_TITLE', 'Definujte skupiny');
}elseif(!empty($_GET['info']) && $_GET['info'] == 'admin_groups'){
    define('HEADING_TITLE', 'Admin Groups');
}elseif(!empty($_GET['info']) && $_GET['info'] == 'admin_files'){
    define('HEADING_TITLE', 'Přístupová práva');
}else{
    define('HEADING_TITLE', 'Admin');
}
define('ADMIN_LIST', 'Seznam administrátorů');


define('TEXT_COUNT_GROUPS', 'Skupiny: ');
define('TABLE_HEADING_NAME', 'Jméno');
define('TABLE_HEADING_TELEGRAM_CHAT_ID', 'ID telegramového chatu');
define('TABLE_HEADING_EMAIL', 'E-mailová adresa');
define('TABLE_HEADING_PASSWORD', 'Heslo');
define('TABLE_HEADING_CONFIRM', 'Potvrzení hesla');
define('TABLE_HEADING_GROUPS', 'Úroveň skupin');
define('TABLE_HEADING_PAGES_REDIRECT', 'Název stránky přesměrování správce');
define('TABLE_HEADING_CREATED', 'Účet vytvořen');
define('TABLE_HEADING_MODIFIED', 'Účet vytvořen');
define('TABLE_HEADING_LOGDATE', 'Poslední přístup');
define('TABLE_HEADING_LOGNUM', 'LogNum');
define('TABLE_HEADING_LOG_NUM', 'Číslo protokolu');
define('TABLE_HEADING_ACTION', 'Akce');

define('TABLE_HEADING_GROUPS_NAME', 'Název skupiny');
define('TABLE_HEADING_GROUPS_DEFINE', 'Výběr krabic a souborů');
define('TABLE_HEADING_GROUPS_GROUP', 'Úroveň');
define('TABLE_HEADING_GROUPS_CATEGORIES', 'Povolení ke kategoriím');


define('TEXT_INFO_HEADING_DEFAULT', 'Administrátor ');
define('TEXT_INFO_HEADING_DELETE', 'Smazat oprávnění ');
define('TEXT_INFO_HEADING_EDIT', 'Upravit kategorii / ');
define('TEXT_INFO_HEADING_NEW', 'Nový administrátor ');
define('TEXT_ADMIN_LIST', 'Seznam administrátorů');
define('TEXT_ADMIN_GROUPS', 'Admin Groups');
define('TEXT_ADMIN_ACCESS', 'Přístupová práva');

define('TEXT_INFO_DEFAULT_INTRO', 'Skupina členů');
define('TEXT_INFO_DELETE_INTRO', 'Odebrat <nobr><b>%s</b></nobr> z <nobr>členů správce?</nobr>');
define('TEXT_INFO_DELETE_INTRO_NOT', 'Nemůžete smazat <nobr>%s skupinu!</nobr>');
define('TEXT_INFO_EDIT_INTRO', 'Zde nastavte úroveň oprávnění: ');

define('TEXT_INFO_FULLNAME', 'Jméno: ');
define('TEXT_INFO_FIRSTNAME', 'Jméno: ');
define('TEXT_INFO_LASTNAME', 'Příjmení: ');
define('TEXT_INFO_EMAIL', 'E-mailová adresa: ');
define('TEXT_INFO_PASSWORD', 'Heslo ');
define('TEXT_INFO_CONFIRM', 'Potvrzení hesla ');
define('TEXT_INFO_CHANGE_PASSWORD', 'Změna vlastního hesla ');
define('TEXT_ERROR_NOT_MATCH_PASS', 'Heslo se neshoduje ');
define('TEXT_ERROR_EMPTY_PASS', 'Heslo je prázdné');
define('TEXT_ERROR_CNT_ADMIN', 'Nemůžete smazat posledního správce.');

define('TEXT_INFO_CREATED', 'Účet vytvořen: ');
define('TEXT_INFO_MODIFIED', 'Účet změněn: ');
define('TEXT_INFO_LOGDATE', 'Poslední přístup: ');
define('TEXT_INFO_LOGNUM', 'Číslo protokolu: ');
define('TEXT_INFO_GROUP', 'Úroveň skupiny: ');
define('TEXT_INFO_ERROR', '<span>E-mailová adresa již byla použita! Zkuste to prosím znovu.</span>');

define('JS_ALERT_FIRSTNAME', '- Povinné: Jméno \n');
define('JS_ALERT_LASTNAME', '- Povinné: Příjmení \n');
define('JS_ALERT_EMAIL', '- Povinné: E-mailová adresa \n');
define('JS_ALERT_EMAIL_FORMAT', '- Formát e-mailové adresy je neplatný! \n');
define('JS_ALERT_EMAIL_USED', '- E-mailová adresa již byla použita! \n');
define('JS_ALERT_LEVEL', '- Povinné: Člen skupiny \n');

define('ADMIN_EMAIL_SUBJECT', 'Nový administrátor');
define('ADMIN_EMAIL_TEXT', 'Ahoj %s,' . "\n\n" . 'Do administrátorského panelu se dostanete s následujícím heslem. Jakmile se dostanete do administrátora, změňte si prosím heslo!' . "\n\n " . 'Web : %s' . "\n" . 'Uživatelské jméno: %s' . "\n" . 'Heslo: %s' . "\n\n" . 'Děkuji!' . "\n" . '%s' . "\n\n". "Toto je automatická odpověď, prosím neodpovídejte!");
define('ADMIN_EMAIL_SUBJECT_PASS_NEW', 'Nový přístup');
define('ADMIN_EMAIL_TEXT_CHANGE_PASS', 'Ahoj %s,' . "\n\n" . 'Do administrátorského panelu se dostanete s následujícím heslem. ' . "\n\n" . 'Web : %s' . "\ n" . 'Uživatelské jméno: %s' . "\n" . 'Heslo: %s' . "\n\n" . 'Děkuji!' . "\n" . '%s' . "\n\n" ."Toto je automatická odpověď, prosím neodpovídejte!");

define('ADMIN_EMAIL_EDIT_SUBJECT', 'Úprava profilu člena správce');
define('ADMIN_EMAIL_EDIT_TEXT', 'Ahoj %s,' . "\n\n" . 'Vaše osobní údaje byly aktualizovány administrátorem.' . "\n\n" . 'Web : %s' . "\n " . 'Uživatelské jméno: %s' . "\n" . 'Heslo: %s' . "\n\n" . 'Děkuji!' . "\n" . '%s' . "\n\n" . 'Toto je automatická odpověď, prosím neodpovídejte!');

define('TEXT_INFO_HEADING_DEFAULT_GROUPS', 'Skupina administrátorů ');
define('TEXT_INFO_HEADING_DELETE_GROUPS', 'Smazat skupinu ');

define('TEXT_INFO_DEFAULT_GROUPS_INTRO', '<b>POZNÁMKA:</b><li><b>upravit:</b> upravit název skupiny.</li><li><b>smazat:</b> smazat skupinu .</li><li><b>definovat:</b> definovat skupinový přístup.</li>');
define('TEXT_INFO_DELETE_GROUPS_INTRO', 'Smaže také člena této skupiny. Opravdu chcete smazat <nobr><b>%s</b> skupinu?</nobr>');
define('TEXT_INFO_DELETE_GROUPS_INTRO_NOT', 'Tuto skupinu nemůžete smazat!');
define('TEXT_INFO_GROUPS_INTRO', 'Uveďte jedinečný název skupiny. Klikněte na další pro odeslání.');

define('TEXT_INFO_HEADING_GROUPS', 'Nnová skupina');
define('TEXT_INFO_GROUPS_NAME', ' <b>Název skupiny:</b><br>Uveďte jedinečný název skupiny. Poté klikněte na Další pro odeslání.<br>');
define('TEXT_INFO_GROUPS_NAME_FALSE', '<span><b>CHYBA:</b> Alespoň název skupiny musí mít více než 2 znaky!</span>');
define('TEXT_INFO_GROUPS_NAME_USED', '<span><b>CHYBA:</b> Název skupiny již byl použit!</span>');
define('TEXT_INFO_GROUPS_LEVEL', 'Úroveň skupiny: ');
define('TEXT_INFO_GROUPS_BOXES', '<b>Povolení ke schránkám:</b><br>Povolte přístup k vybraným schránkám.');
define('TEXT_INFO_GROUPS_BOXES_INCLUDE', 'Zahrnout soubory uložené v: ');

define('TEXT_INFO_HEADING_EDIT_GROUP', 'Upravit název skupiny');
define('TEXT_INFO_EDIT_GROUP_INTRO', 'Můžete změnit aktuální název této skupiny, zadejte nový název a klikněte na tlačítko Uložit.');

define("stats_products_purchased.php", "Objednané produkty");
define("stats_customers_orders.php", "Prodejní objednávky");
define("konfigurace_šablony.php", "Konfigurace šablony");
define("easypopulate_functions.php", ".. EASYPOPULATE_FUNCTIONS ..");
define("create_account_process.php", "Proces vytvoření účtu");
define("create_account_success.php", "Úspěšná registrační stránka");
define("stats_customers_entry.php", "Přihlášení zákazníka");
define("stats_products_viewed.php", "Viewed Items");
define("languages_translater.php", "Překlad jazyků");
define("create_order_process.php", "Proces vytvoření objednávky");
define("stats_sales_report2.php", "Statistiky prodeje (2)");
define("total_configuration.php", "Editor nastavení");
define("stats_monthly_sales.php", "Musicni tržby");
define("extra_product_price.php", "Dodatečná cena produktu");
define("produkty_atributy.php", "Atributy produktu");
define("stats_last_modified.php", "Poslední změny");
define("stats_sales_report.php", "Zpráva o statistikách prodeje");
define("attributeManager.php", "Správce atributů");
define("mysqlperformance.php", "Protokol pomalého dotazu");
define("skupiny_zákazníků.php", "Skupiny zákazníků");
define("validcategories.php", "Platné kategorie");
define("stats_customers.php", "Statistiky zákazníků");
define("design_controls.php", "Design Controls");
define("stats_opened_by.php", "Statistiky pro nové účty");
define("create_account.php", "Create Account");
define("listcategories.php", "Seznam kategorií");
define("stats_keywords.php", "Vyhledávací dotazy");
define("image_explorer.php", "Správce souborů");
define("xsell_products.php", "Související produkty");
define("products_multi.php", "Product Management");
define("výrobci.php", "Výrobci");
define("stats_zeroqty.php", "Produkty, které nejsou skladem");
define("konfigurace.php", "Konfigurace");

define("stats_nophoto.php", "Produkty bez fotografií");
define("quick_updates.php", "Aktualizace ceny");
define("validproducts.php", "Seznam produktů");
define("konfigurace.php", "Můj obchod");
define("admin_members.php", "Admin Management");
define("status_objednávek.php", "Stav objednávek");
define("email_content.php", "Šablony e-mailu");
define("administrator.php", "Administrators");
define("coupon_admin.php", "Kupóny");
define("listproducts.php", "Seznam produktů");
define("easypopulate.php", "Excel Import / Export");
define("manudiscount.php", "Slevy výrobce");
define("lokalizace.php", "Lokalizace");
define("edit_orders.php", "Edit Orders");
define("newsletters.php", "Správce mailing listu");
define("tax_classes.php", "Seznam daní");
define("admin_files.php", "Nabídka admin boxů");
define("whos_online.php", "Lidé online");
define("měny.php", "Měny");
define("ajax_xsell.php", "AJAX Associated Products");
define("chart_data.php", ".. CHART_DATA ..");
define("categories.php", "Seznam produktů");
define("daňové_sazby.php", "daňové sazby");
define("prodejce.php", "Hromadné slevy");
define("jazyky.php", "Jazyky");
define("pollbooth.php", ".. POLLBOTH ..");
define("customers.php", "Seznam zákazníků");
define("země.php", "Země");
define("geo_zones.php", "Geografické oblasti");
define("zákazníci.php", "Zákazníci");
define("články.php", "Články");
define("produkty.php", "Editor produktu");
define("featured.php", "Featured Products");
define("gv_admin.php", ".. GV_ADMIN ..");
define("speciály.php", "Slevy");
define("gv_queue.php", "Aktivace certifikátu");
define("ship2pay.php", "Doručení-Platba");
define("recenze.php", "Komentáře");
define("články.php", "Stránky");
define("modules.php", "Moduly");
define("reports.php", "Reports");
define("katalog.php", "Katalog");
define("gv_mail.php", "Odeslat certifikát");
define("gv_sent.php", "Odeslané certifikáty");
define("modules.php", "Moduly");
define("záloha.php", "Záloha");
define("zakázky.php", "Seznam objednávek");
define("daně.php", "Daně");
define("cache.php", "Cache");
define("tools.php", "Tools");
define("ankety.php", "Ankety");
define("ankety.php", "Hlasování");
define("zones.php", "Seznam regionů");
define("mail.php", "Odeslat email");

define('FILENAME_DEFAULT_TEXT', 'Hlavní stránka');
define('FILENAME_CATEGORIES_TEXT', 'Stránka kategorií');

define('TEXT_INFO_HEADING_DEFINE', 'Definujte skupinu');
if ($_GET['gPath'] == 1) {
    define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br>Pro tuto skupinu nemůžete změnit oprávnění k souboru.<br><br>');
} else {
    define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br>Změňte oprávnění pro tuto skupinu zaškrtnutím nebo zrušením výběru poskytnutých polí a souborů. Kliknutím na <b>uložit</b> změny uložíte.<br ><br>');
}