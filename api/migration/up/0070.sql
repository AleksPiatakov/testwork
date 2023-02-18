ALTER TABLE `sub_configuration` ADD `sort_order` INT(11) NOT NULL DEFAULT '0' AFTER `title`;

/*1*/
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('4', '1', '10', 'Contact Information');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('4', '3', '10', 'Контактная информация');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('4', '5', '10', 'Контактна інформація');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('4', '8', '10', 'Στοιχεία επικοινωνίας');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('4', '9', '10', 'Kontaktinformationen');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('4', '11', '10', 'Información del contacto');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('4', '12', '10', 'Informacje kontaktowe');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('4', '15', '10', 'Contactgegevens');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('4', '16', '10', 'Coordonnées');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('4', '17', '10', 'Informazioni sui contatti');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('4', '18', '10', 'Informatii de contact');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('4', '19', '10', 'Contact Information');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('4', '20', '10', 'Elérhetőség');
UPDATE `configuration` SET `configuration_subgroup_id` = '4' WHERE `configuration_key` IN ('STORE_NAME', 'STORE_OWNER', 'STORE_OWNER_EMAIL_ADDRESS', 'STORE_COUNTRY', 'STORE_ZONE', 'DOMEN_URL', 'STORE_BANK_INFO', 'STORE_ADDRESS');

DELETE FROM `configuration` WHERE `configuration_key` = 'ONEPAGE_DEFAULT_COUNTRY';
DELETE FROM `configuration` WHERE `configuration_key` = 'SEND_EXTRA_ORDER_EMAILS_TO';
DELETE FROM `configuration` WHERE `configuration_key` = 'CONTACT_US_LIST';

/*2*/
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('5', '1', '20', 'Products and prices');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('5', '3', '20', 'Товары и цены');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('5', '5', '20', 'Товари та ціни');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('5', '8', '20', 'Προϊόντα και τιμές');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('5', '9', '20', 'Produkte und Preise');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('5', '11', '20', 'Productos y precios');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('5', '12', '20', 'Produkty i ceny');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('5', '15', '20', 'Producten en prijzen');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('5', '16', '20', 'Produits et prix');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('5', '17', '20', 'Prodotti e prezzi');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('5', '18', '20', 'Produse si preturi');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('5', '19', '20', 'Products and prices');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('5', '20', '20', 'Termékek és árak');
UPDATE `configuration` SET `configuration_subgroup_id` = '5' WHERE `configuration_key` IN ('SHOW_BASKET_ON_ADD_TO_CART', 'USE_DEFAULT_LANGUAGE_CURRENCY', 'CHANGE_BY_GEOLOCATION', 'DISPLAY_PRICE_WITH_TAX', 'ALLOW_GUEST_TO_SEE_PRICES', 'DISPLAY_PRICE_WITH_TAX_CHECKOUT', 'GUEST_DISCOUNT', 'MIN_ORDER', 'XPRICES_NUM', 'ONEPAGE_LOGIN_REQUIRED');
UPDATE `sub_configuration` SET `sort_order` = '30' WHERE `id` = '1';
UPDATE `sub_configuration` SET `sort_order` = '40' WHERE `id` = '2';

INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('6', '1', '50', 'Other settings');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('6', '3', '50', 'Другие настройки');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('6', '5', '50', 'Інші налаштування');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('6', '8', '50', 'Αλλες ρυθμίσεις');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('6', '9', '50', 'Andere Einstellungen');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('6', '11', '50', 'Otros ajustes');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('6', '12', '50', 'Inne ustawienia');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('6', '15', '50', 'Andere instellingen');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('6', '16', '50', 'Autres réglages');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('6', '17', '50', 'Altre impostazioni');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('6', '18', '50', 'Alte setari');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('6', '19', '50', 'Other settings');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('6', '20', '50', 'Egyéb beállitások');
UPDATE `configuration` SET `configuration_subgroup_id` = '6' WHERE `configuration_key` IN ('MASTER_PASS', 'REVIEWS_WRITE_ACCESS', 'MENU_LOCATION', 'DEFAULT_DATE_FORMAT', 'MYSQL_PERFORMANCE_TRESHOLD');

DELETE FROM `configuration` WHERE `configuration_key` = 'DEFAULT_FORMATED_DATE_FORMAT';
UPDATE `configuration` SET `configuration_group_id` = '125' WHERE `configuration_key` = 'ROBOTS_TXT';

/*3*/
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('7', '1', '60', 'Facebook authorization');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('7', '3', '60', 'Facebook авторизация');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('7', '5', '60', 'Facebook авторизація');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('7', '8', '60', 'Facebook εξουσιοδότηση');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('7', '9', '60', 'Facebook autorisierung');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('7', '11', '60', 'Facebook autorización');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('7', '12', '60', 'Facebook autoryzacja');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('7', '15', '60', 'Facebook autorisatie');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('7', '16', '60', 'Facebook autorisation');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('7', '17', '60', 'Facebook autorizzazione');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('7', '18', '60', 'Facebook autorizare');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('7', '19', '60', 'Facebook authorization');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('7', '20', '60', 'Facebook engedélyezés');
UPDATE `configuration` SET `configuration_subgroup_id` = '7', `configuration_group_id` = '125' WHERE `configuration_key` IN ('FACEBOOK_AUTH_STATUS', 'FACEBOOK_APP_ID', 'FACEBOOK_APP_SECRET');

INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('8', '1', '70', 'Facebook Pixel');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('8', '3', '70', 'Facebook Pixel');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('8', '5', '70', 'Facebook Pixel');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('8', '8', '70', 'Facebook Pixel');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('8', '9', '70', 'Facebook Pixel');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('8', '11', '70', 'Facebook Pixel');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('8', '12', '70', 'Facebook Pixel');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('8', '15', '70', 'Facebook Pixel');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('8', '16', '70', 'Facebook Pixel');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('8', '17', '70', 'Facebook Pixel');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('8', '18', '70', 'Facebook Pixel');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('8', '19', '70', 'Facebook Pixel');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('8', '20', '70', 'Facebook Pixel');
UPDATE `configuration` SET `configuration_subgroup_id` = '8', `configuration_group_id` = '125' WHERE `configuration_key` IN ('FACEBOOK_PIXEL_ID', 'DEFAULT_PIXEL_CURRENCY', 'FACEBOOK_GOALS_SUCCESS_PAGE', 'FACEBOOK_GOALS_ADD_PAYMENT_INFO', 'FACEBOOK_GOALS_ADD_TO_WISHLIST', 'FACEBOOK_GOALS_CONTACT_US_REQUEST', 'FACEBOOK_GOALS_COMPLETE_REGISTRATION', 'FACEBOOK_GOALS_VIEW_CONTENT', 'FACEBOOK_GOALS_SEARCH_RESULTS', 'FACEBOOK_GOALS_CHECKOUT_PROCESS', 'FACEBOOK_GOALS_ADD_TO_CART', 'FACEBOOK_GOALS_PAGE_VIEW', 'FACEBOOK_GOALS_ADD_REVIEW', 'FACEBOOK_GOALS_LOGIN', 'FACEBOOK_GOALS_SUBSCRIBE', 'FACEBOOK_GOALS_FILTER', 'FACEBOOK_GOALS_CALLBACK', 'FACEBOOK_GOALS_CLICK_ON_CHAT', 'FACEBOOK_GOALS_CLICK_FAST_BUY', 'FACEBOOK_GOALS_PHONE_CALL', 'FACEBOOK_GOALS_CLICK_ON_BUG_REPORT');

/*4*/
UPDATE `configuration_group` SET `configuration_group_key` = 'SEO_SETTINGS_CONF_TITLE', `configuration_group_title` = 'Настройки SEO', `configuration_group_description` = 'Настройки SEO' WHERE `configuration_group_id` = '125';
DELETE FROM `configuration_group` WHERE `configuration_group_id` = '124';

INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('9', '1', '10', 'Basic SEO settings');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('9', '3', '10', 'Основные настройки SEO');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('9', '5', '10', 'Основні налаштування SEO');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('9', '8', '10', 'Βασικές ρυθμίσεις SEO');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('9', '9', '10', 'Grundlegende SEO-Einstellungen');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('9', '11', '10', 'Configuración básica de SEO');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('9', '12', '10', 'Podstawowe ustawienia SEO');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('9', '15', '10', 'Basis SEO-instellingen');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('9', '16', '10', 'Paramètres de référencement de base');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('9', '17', '10', 'Impostazioni SEO di base');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('9', '18', '10', 'Setări SEO de bază');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('9', '19', '10', 'Basic SEO settings');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('9', '20', '10', 'Alapvető SEO beállítások');
UPDATE `configuration` SET `configuration_subgroup_id` = '9' WHERE `configuration_key` IN ('SEO_FILTER', 'ROBOTS_TXT');

INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('10', '1', '40', 'Google authorization');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('10', '3', '40', 'Google авторизация');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('10', '5', '40', 'Google авторизація');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('10', '8', '40', 'Google εξουσιοδότηση');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('10', '9', '40', 'Google autorisierung');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('10', '11', '40', 'Google autorización');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('10', '12', '40', 'Google autoryzacja');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('10', '15', '40', 'Google autorisatie');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('10', '16', '40', 'Google autorisation');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('10', '17', '40', 'Google autorizzazione');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('10', '18', '40', 'Google autorizare');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('10', '19', '40', 'Google authorization');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('10', '20', '40', 'Google engedélyezés');
UPDATE `configuration` SET `configuration_subgroup_id` = '10' WHERE `configuration_key` IN ('GOOGLE_OAUTH_STATUS', 'GOOGLE_OAUTH_CLIENT_ID', 'GOOGLE_OAUTH_CLIENT_SECRET');

INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('11', '1', '30', 'Google e-commerce');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('11', '3', '30', 'Google электронная торговля');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('11', '5', '30', 'Google електронна торгівля');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('11', '8', '30', 'Google ηλεκτρονικό εμπόριο');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('11', '9', '30', 'Google e-Commerce');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('11', '11', '30', 'Google comercio electrónico');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('11', '12', '30', 'Google e-commerce');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('11', '15', '30', 'Google e-commerce');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('11', '16', '30', 'Google commerce électronique');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('11', '17', '30', 'Google e-commerce');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('11', '18', '30', 'Google comerț electronic');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('11', '19', '30', 'Google e-commerce');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('11', '20', '30', 'Google e-kereskedelem');
UPDATE `configuration` SET `configuration_subgroup_id` = '11' WHERE `configuration_key` IN ('GOOGLE_ECOMM_HOME_PAGE', 'GOOGLE_ECOMM_SEARCH_RESULTS', 'GOOGLE_ECOMM_PRODUCT_DETAIL_PAGE', 'GOOGLE_ECOMM_CHECKOUT_PAGE', 'GOOGLE_ECOMM_SUCCESS_PAGE', 'GOOGLE_ECOMM_CLICK_FAST_BUY');

INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('12', '1', '50', 'Google Recaptcha');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('12', '3', '50', 'Google Recaptcha');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('12', '5', '50', 'Google Recaptcha');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('12', '8', '50', 'Google Recaptcha');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('12', '9', '50', 'Google Recaptcha');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('12', '11', '50', 'Google Recaptcha');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('12', '12', '50', 'Google Recaptcha');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('12', '15', '50', 'Google Recaptcha');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('12', '16', '50', 'Google Recaptcha');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('12', '17', '50', 'Google Recaptcha');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('12', '18', '50', 'Google Recaptcha');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('12', '19', '50', 'Google Recaptcha');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('12', '20', '50', 'Google Recaptcha');
UPDATE `configuration` SET `configuration_subgroup_id` = '12' WHERE `configuration_key` IN ('GOOGLE_RECAPTCHA_STATUS', 'GOOGLE_RECAPTCHA_PUBLIC_KEY', 'GOOGLE_RECAPTCHA_SECRET_KEY');

UPDATE `configuration` SET `configuration_subgroup_id` = '3' WHERE `configuration_key` IN ('GOOGLE_ANALYTICS_AND_TAGS_MODULE_ENABLED');
UPDATE `sub_configuration` SET `title` = 'Google Analytics', `sort_order` = '20' WHERE `id` = '3';

/*5*/

/*6*/
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('13', '1', '80', 'Other Integrations');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('13', '3', '80', 'Другие Интеграции');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('13', '5', '80', 'Інші інтеграції');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('13', '8', '80', 'Άλλες ενσωματώσεις');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('13', '9', '80', 'Andere Integrationen');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('13', '11', '80', 'Otras integraciones');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('13', '12', '80', 'Inne integracje');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('13', '15', '80', 'Andere integraties');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('13', '16', '80', 'Autres intégrations');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('13', '17', '80', 'Altre integrazioni');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('13', '18', '80', 'Alte integrări');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('13', '19', '80', 'Other Integrations');
INSERT INTO `sub_configuration` (`id`, `language_id`, `sort_order`, `title`) VALUES ('13', '20', '80', 'Egyéb integrációk');
UPDATE `configuration` SET `configuration_subgroup_id` = '13', `configuration_group_id` = '125' WHERE `configuration_key` IN ('JIVOSITE_WIDGET_ID', 'VK_APP_ID', 'VK_APP_SECRET', 'DEFAULT_CAPTCHA_STATUS', 'GOOGLE_SITE_VERIFICATION_KEY');
DELETE FROM `configuration_group` WHERE `configuration_group_id` = '26231';
