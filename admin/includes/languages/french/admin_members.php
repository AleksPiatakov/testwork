<?php
if($_GET['gID']){
	define('HEADING_TITLE', 'Groupes');
}elseif($_GET['gPath']){
	define('HEADING_TITLE', 'Réglage de groupe');
}elseif(!empty($_GET['info']) && $_GET['info'] == 'admin_groups'){
	define('HEADING_TITLE', 'Groupe administrateurs');
}elseif(!empty($_GET['info']) && $_GET['info'] == 'admin_files'){
	define('HEADING_TITLE', 'Les droits d\'accès');
}else{
	define('HEADING_TITLE', 'Les administrateurs');
}
define('ADMIN_LIST', 'La liste des administrateurs');


//define('HEADING_TITLE','Les administrateurs');
define('TEXT_COUNT_GROUPS','Groupe: ');
define('TABLE_HEADING_NAME','Le nom de');
define('TABLE_HEADING_EMAIL','L\'Adresse Email');
define('TABLE_HEADING_PASSWORD','Le mot de passe');
define('TABLE_HEADING_CONFIRM','Confirmer le mot de passe');
define('TABLE_HEADING_GROUPS','Le groupe');
define('TABLE_HEADING_CREATED','Date de création');
define('TABLE_HEADING_MODIFIED','Les dernières modifications');
define('TABLE_HEADING_LOGDATE','La dernière entrée');
define('TABLE_HEADING_LOGNUM','Le nombre d\'entrées');
define('TABLE_HEADING_LOG_NUM','Le nombre d\'entrées');
define('TABLE_HEADING_ACTION','L\'action');
define('TABLE_HEADING_PAGES_REDIRECT', 'Page de redirection administrateur');
define('TABLE_HEADING_GROUPS_NAME','Le nom du groupe');
define('TABLE_HEADING_GROUPS_DEFINE','Boxes et les fichiers disponibles pour ce groupe');
define('TABLE_HEADING_GROUPS_GROUP','Le groupe');
define('TABLE_HEADING_GROUPS_CATEGORIES','Fichiers disponibles et boxes');
define('TEXT_INFO_HEADING_DEFAULT','L\'administrateur ');
define('TEXT_INFO_HEADING_DELETE','Supprimer l\'accès ');
define('TEXT_INFO_HEADING_EDIT','Changer de groupe / ');
define('TEXT_INFO_HEADING_NEW','Le nouvel administrateur ');
define('TEXT_ADMIN_LIST','La liste des administrateurs');
define('TEXT_ADMIN_GROUPS','Groupe administrateurs');
define('TEXT_ADMIN_ACCESS','Les droits d\'accès');
define('TEXT_INFO_DEFAULT_INTRO','Le groupe');
define('TEXT_INFO_DELETE_INTRO','Voulez-vous vraiment supprimer <nobr><b>%s</b></nobr> <nobr>Administrateurs?</nobr>');
define('TEXT_INFO_DELETE_INTRO_NOT','Vous ne pouvez pas supprimer le groupe <nobr>%s!</nobr>');
define('TEXT_INFO_EDIT_INTRO','Les droits d\'accès aux boxam et fichiers: ');
define('TEXT_INFO_FULLNAME','Nom: ');
define('TEXT_INFO_FIRSTNAME','Nom: ');
define('TEXT_INFO_LASTNAME','Nom de famille: ');
define('TEXT_INFO_EMAIL','Adresse Email: ');
define('TEXT_INFO_PASSWORD','Le mot de passe ');
define('TEXT_INFO_CONFIRM','Confirmez Le Mot De Passe ');
define('TEXT_INFO_CHANGE_PASSWORD','Changer votre mot de passe ');
define('TEXT_ERROR_NOT_MATCH_PASS','Les mots de passe ne correspondent pas ');
define('TEXT_ERROR_EMPTY_PASS','Le mot de passe vide');
define('TEXT_ERROR_CNT_ADMIN','Vous ne pouvez pas supprimer le dernier admin');
define('TEXT_INFO_CREATED','L\'enregistrement est créé: ');
define('TEXT_INFO_MODIFIED','Modifications récentes: ');
define('TEXT_INFO_LOGDATE','Dernière connexion: ');
define('TEXT_INFO_LOGNUM','Nombre d\'entrées: ');
define('TEXT_INFO_GROUP','Groupe: ');
define('TEXT_INFO_ERROR','Entré Email est déjà enregistré! Essayez de spécifier une autre adresse.');
define('JS_ALERT_FIRSTNAME','');
define('JS_ALERT_LASTNAME','');
define('JS_ALERT_EMAIL','');
define('JS_ALERT_EMAIL_FORMAT','');
define('JS_ALERT_EMAIL_USED','');
define('JS_ALERT_LEVEL','');
define('ADMIN_EMAIL_SUBJECT','Le nouvel administrateur');
define('ADMIN_EMAIL_SUBJECT_PASS_NEW','Le nouveau mot de passe');
define('ADMIN_EMAIL_TEXT_CHANGE_PASS','Bonjour %s!Vous pouvez accéder au panneau d\'administration avec un abus de mot de passe. Site: %sEmail: %sMot de passe: %sMerci!%sCette lettre est envoyée automatiquement, pas besoin de lui répondre!');
define('ADMIN_EMAIL_TEXT','Bonjour %s!Vous pouvez accéder au panneau d\'administration avec un abus de mot de passe. Une fois que Vous allez au panneau d\'administration, nous Vous recommandons vivement de changer votre mot de passe!Site: %sEmail: %sMot de passe: %sMerci!%sCette lettre est envoyée automatiquement, pas besoin de lui répondre!');
define('ADMIN_EMAIL_EDIT_SUBJECT','Votre information est modifiée par l\'administrateur');
define('ADMIN_EMAIL_EDIT_TEXT','Bonjour %s!Votre information est modifiée par l\'administrateur.Site: %sEmail: %sMot de passe: %sMerci!%sCette lettre est envoyée automatiquement, pas besoin de lui répondre!');
define('TEXT_INFO_HEADING_DEFAULT_GROUPS','Le groupe ');
define('TEXT_INFO_HEADING_DELETE_GROUPS','Supprimer le groupe ');
define('TEXT_INFO_DEFAULT_GROUPS_INTRO','<b>ATTENTION:</b><li><b>edit:</b> le changement de nom du groupe.</li><li><b>supprimer:</b> suppression d\'un groupe.</li><li><b>l\'accès à des fichiers:</b> configuration de l\'accès à boxam et fichiers.</li>');
define('TEXT_INFO_DELETE_GROUPS_INTRO','En supprimant ce groupe, Vous supprimez également tous les administrateurs présents dans ce groupe. Voulez-vous vraiment supprimer le groupe <nobr><b>%s</b>?</nobr>');
define('TEXT_INFO_DELETE_GROUPS_INTRO_NOT','Vous ne pouvez pas supprimer ce groupe!');
define('TEXT_INFO_GROUPS_INTRO','Donnez un nom à votre nouveau groupe, puis cliquez sur "suivant".');
define('TEXT_INFO_HEADING_GROUPS','Le nouveau groupe');
define('TEXT_INFO_GROUPS_NAME',' <b>Nom du groupe:</b><br>Entrez le nom du nouveau groupe, puis cliquez sur "Suivant".<br>');
define('TEXT_INFO_GROUPS_NAME_FALSE','<b>ERREUR:</b> le Nom du groupe doit être composé d\'au moins 2 caractères!');
define('TEXT_INFO_GROUPS_NAME_USED','<b>ERREUR:</b> vous avez Saisi le nom d\'un groupe déjà une, essayez d\'appeler le groupe de l\'autre!');
define('TEXT_INFO_GROUPS_LEVEL','Groupe: ');
define('TEXT_INFO_GROUPS_BOXES','<b>Droits d\'accès boxam:</b><br>permissions d\'accès boxam.');
define('TEXT_INFO_GROUPS_BOXES_INCLUDE','Ajouter un fichier à la boxe: ');
define('TEXT_INFO_HEADING_EDIT_GROUP','Modifier le nom du groupe');
define('TEXT_INFO_EDIT_GROUP_INTRO','Vous pouvez changer le nom de ce groupe sur nouveau, entrez le nouveau nom et appuyez sur la touche <b>garder</b>');
define('TEXT_INFO_HEADING_DEFINE','Configuration d\'un groupe de');
define('TEXT_INFO_DEFINE_INTRO','<b>%s</b><br>Vous pouvez installer ou retirer l\'accès à boxam et fichiers de ce groupe. Cliquez sur le bouton <b>garder</b> pour enregistrer les modifications.<br><br>');
define("stats_products_purchased.php", "Produits commandés");
define("stats_customers_orders.php", "Commandes clients");
define("template_configuration.php", "Configuration du modèle");
define("easypopulate_functions.php", ".. EASYPOPULATE_FUNCTIONS ..");
define("create_account_process.php", "Processus de création de compte");
define("create_account_success.php", "Page d'enregistrement réussie");
define("stats_customers_entry.php", "Login client");
define("stats_products_viewed.php", "Articles vus");
define("languages_translater.php", "Traduction de langues");
define("create_order_process.php", "Processus de création de commande");
define("stats_sales_report2.php", "Statistiques de vente (2)");
define("total_configuration.php", "Editeur de paramètres");
define("stats_monthly_sales.php", "Ventes mensuelles");
define("extra_product_price.php", "Prix du produit supplémentaire");
define("products_attributes.php", "Attributs du produit");
define("stats_last_modified.php", "Changements récents");
define("stats_sales_report.php", "Rapport sur les statistiques de vente");
define("attributeManager.php", "Gestionnaire d'attributs");
define("mysqlperformance.php", "Journal de requête lent");
define("customers_groups.php", "Groupes de clients");
define("validcategories.php", "Catégories valides");
define("stats_customers.php", "Statistiques client");
define("design_controls.php", "Contrôles de conception");
define("stats_opened_by.php", "Statistiques pour les nouveaux comptes");
define("create_account.php", "Créer un compte");
define("listcategories.php", "Liste des catégories");
define("stats_keywords.php", "Requêtes de recherche");
define("image_explorer.php", "Gestionnaire de fichiers");
define("xsell_products.php", "Produits associés");
define("products_multi.php", "Gestion de produit");
define("manufacturers.php", "Fabricants");
define("stats_zeroqty.php", "dont les produits ne sont pas en stock");
define("configuration.php", "Configuration");

define("stats_nophoto.php", "Produits sans photos");
define("quick_updates.php", "Mise à jour du prix");
define("validproducts.php", "Liste de produits");
define("configuration.php", "Mon magasin");
define("admin_members.php", "Admin Management");
define("orders_status.php", "Statut des commandes");
define("email_content.php", "Modèles de courrier électronique");
define("administrator.php", "Administrateurs");
define("coupon_admin.php", "Promo codes");
define("listproducts.php", "Liste de produits");
define("easypopulate.php", "Excel Import / Export");
define("manudiscount.php", "Réductions du fabricant");
define("localization.php", "Localisation");
define("edit_orders.php", "Editer les commandes");
define("newsletters.php", "Gestionnaire de listes de diffusion");
define("tax_classes.php", "Liste des taxes");
define("admin_files.php", "Menu des boîtes d’administrateur");
define("whos_online.php", "People Online");
define("currencies.php", "C currency");
define("ajax_xsell.php", "Produits associés AJAX");
define("chart_data.php", ".. CHART_DATA ..");
define("categories.php", "Liste de produits");
define("tax_rates.php", "Taux d'imposition");
define("salemaker.php", "Remises en vrac");
define("languages.php", "Langues");
define("pollbooth.php", ".. POLLBOTH ..");
define("customers.php", "Liste de clients");
define("countries.php", "Pays");
define("geo_zones.php", "Zones géographiques");
define("customers.php", "Clients");
define("articles.php", "Articles");
define("products.php", "Editeur de produit");
define("featured.php", "Produits en vedette");
define("gv_admin.php", ".. GV_ADMIN ..");
define("specials.php", "Remises");
define("gv_queue.php", "Activation du certificat");
define("ship2pay.php", "Livraison-Paiement");
define("reviews.php", "Commentaires");
define("articles.php", "Pages");
define("modules.php", "Modules");
define("reports.php", "Rapports");
define("catalog.php", "Catalogue");
define("gv_mail.php", "Envoyer le certificat");
define("gv_sent.php", "Certificats envoyés");
define("modules.php", "Modules");
define("backup.php", "Sauvegarde");
define("orders.php", "Liste des commandes");
define("taxes.php", "Taxes");
define("cache.php", "Cache");
define("tools.php", "Outils");
define("polls.php", "Polls");
define("polls.php", "Vote");
define("zones.php", "Liste des régions");
define("mail.php", "Envoyer un email");

define('FILENAME_DEFAULT_TEXT', 'Homepage');
define('FILENAME_CATEGORIES_TEXT', 'Page de catégorie');