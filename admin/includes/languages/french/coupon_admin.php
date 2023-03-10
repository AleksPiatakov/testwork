<?php 
define('HEADING_TITLE','Promo codes');
define('HEADING_TITLE_STATUS','Tri: ');
define('TEXT_CUSTOMER','Client:');
define('TEXT_COUPON','Le nom de coupon');
define('TEXT_COUPON_ALL','Tous les coupons');
define('TEXT_COUPON_ACTIVE','Actifs des coupons');
define('TEXT_COUPON_INACTIVE','Inactifs coupons');
define('TEXT_SUBJECT','Thème:');
define('TEXT_FROM','De:');
define('TEXT_FREE_SHIPPING','Livraison gratuite');
define('TEXT_MESSAGE','Message:');
define('TEXT_SELECT_CUSTOMER','Sélectionnez le client');
define('TEXT_ALL_CUSTOMERS','Tous les clients');
define('TEXT_NEWSLETTER_CUSTOMERS','Tous les abonnés à la newsletter de la boutique');
define('TEXT_CONFIRM_DELETE','Voulez-vous vraiment supprimer ce coupon?');
define('TEXT_TO_REDEEM','Vous pouvez utiliser ce coupon lors de votre commande dans notre magasin. Dans le processus de commande, il Vous sera demandé d\'entrer un code promo, saisissez le code de votre coupon et appuyez sur le bouton "Appliquer".');
define('TEXT_IN_CASE',' en cas de problèmes. ');
define('TEXT_VOUCHER_IS','Code promo: ');
define('TEXT_REMEMBER','N\'oubliez pas de code promo, si Vous oubliez le code de coupon, Vous ne pourrez pas les utiliser dans notre boutique en ligne.');
define('TEXT_VISIT','lorsque Vous visitez notre boutique en ligne à l\'adresse '.HTTP_SERVER.DIR_WS_CATALOG);
define('TEXT_ENTER_CODE',' et entrez le code de coupon ');
define('TABLE_HEADING_ACTION','L\'action');
define('CUSTOMER_ID','Le code client');
define('CUSTOMER_NAME','Le nom de');
define('REDEEM_DATE','Date d\'utilisation du coupon');
define('IP_ADDRESS','L\'Adresse IP');
define('TEXT_REDEMPTIONS','Les statistiques d\'utilisation du coupon');
define('TEXT_REDEMPTIONS_TOTAL','Seulement utilisé une fois');
define('TEXT_REDEMPTIONS_CUSTOMER','Ce client a utilisé une fois');
define('TEXT_NO_FREE_SHIPPING','Pas de livraison gratuite');
define('NOTICE_EMAIL_SENT_TO','Notification: e-mail envoyé à: %s');
define('ERROR_NO_CUSTOMER_SELECTED','Erreur: Vous n\'avez pas choisi le client.');
define('COUPON_NAME','Le nom de coupon');
define('COUPON_AMOUNT','La valeur nominale du coupon');
define('COUPON_CODE','Code promo');
define('COUPON_STARTDATE','Le coupon est valable avec');
define('COUPON_FINISHDATE','Le coupon est valable jusqu\'au');
define('COUPON_FREE_SHIP','Livraison gratuite');
define('COUPON_FOR_EVERY_PRODUCT', 'Utilisation pour chaque produit adapté');
define('COUPON_DESC','Description du coupon');
define('COUPON_MIN_ORDER','Quantité de commande minimum');
define('COUPON_USES_COUPON','Combien de fois vous pouvez utiliser le code promo lors de votre commande');
define('COUPON_USES_USER','Combien de fois peut utiliser ce coupon, un acheteur');
define('COUPON_PRODUCTS','Le coupon est valable uniquement pour des produits spécifiques');
define('COUPON_CATEGORIES','Le coupon est valable uniquement pour certaines catégories de');
define('VOUCHER_NUMBER_USED','Coupon utilisé une fois');
define('DATE_CREATED','Date de création');
define('DATE_MODIFIED','Les dernières modifications');
define('TEXT_HEADING_NEW_COUPON','Créer un nouveau coupon');
define('TEXT_NEW_INTRO','Pour créer un nouveau bon de réduction, Vous devez remplir le formulaire suivant.<br>');
define('COUPON_BUTTON_PREVIEW','Aperçu');
define('COUPON_BUTTON_CONFIRM','Confirmer');
define('COUPON_BUTTON_BACK','Retour');
define('ERROR_NO_COUPON_AMOUNT','Erreur: n\'est Pas spécifié la valeur nominale du coupon');
define('ERROR_NO_COUPON_NAME','Erreur: le nom de coupon');
define('ERROR_COUPON_EXISTS','Erreur: le Coupon existe déjà');
define('COUPON_VIEW','Regarder');
define('COUPON_NAME_HELP','Spécifiez un nom court du coupon.');
define('COUPON_AMOUNT_HELP','Vous pouvez spécifier soit le montant du coupon(indiquer la somme en chiffres, par exemple, pour le montant du coupon a été de 100$, il suffit d\'écrire "100"), soit un pourcentage de réduction(indiquez le pourcentage qui vous sera donné à l\'acheteur avait utilisé un coupon lors de la commande, par exemple, pour donner un rabais de 10%, et de l\'écrire "10%"), en utilisant ce coupon, l\'acheteur reçoit un ou déduction d\'un montant de coupon montant total de la commande, soit d\'une réduction du montant total de la commande, en fonction de ce que Vous indiquez dans ce champ, soit le montant de la déduction, soit le taux de réduction.');
define('COUPON_CODE_HELP','Vous pouvez spécifier le code de coupon-même, mais si Vous laissez ce champ vide(suffit de ne pas remplir ce champ), le code de coupon sera généré automatiquement.');
define('COUPON_STARTDATE_HELP','Date à partir de laquelle, le coupon doit être activé et vous pouvez l\'utiliser lors de votre commande.');
define('COUPON_FINISHDATE_HELP','La date après laquelle le coupon ne sera appliquer lors de la commande.');
define('COUPON_FREE_SHIP_HELP','Cochez cette case si Vous voulez que l\'acheteur utilise le coupon lors de la commande, reçu la livraison gratuite de votre commande. Attention. Cette option ne peut pas être partagée avec "la valeur Nominale du coupon", c\'est-à-dire ne pas donner immédiatement à l\'acheteur le montant de la déduction(ou rabais) sur le coupon et, simultanément, la livraison gratuite, une seule chose, soit la déduction(ou de réduction), ou la livraison gratuite. Cette option prend en compte le Montant de commande minimum", c\'est-à-dire, Vous pouvez, par exemple, de donner à l\'acheteur qui utilise le coupon livraison gratuite, uniquement si le montant de sa commande définie ci-dessus Vous, et vous ne pouvez pas limiter le montant minimum de commande et de donner de la livraison gratuite à tous ceux qui utilise le coupon lors de votre commande.');
define('COUPON_FOR_EVERY_PRODUCT_HELP', 'Le coupon de réduction sera appliqué à chaque article éligible dans le panier. L\'option ne fonctionne que s\'il existe une restriction sur le produit ou la catégorie.');
define('COUPON_DESC_HELP','Décrivez brièvement créé un coupon.');
define('COUPON_MIN_ORDER_HELP','Vous pouvez limiter(et ne peut pas limiter l\'action du coupon est le montant minimum de la commande, c\'est-à-dire si le montant de la commande inférieure à la valeur spécifiée dans ce champ montant, le coupon ne peut pas être appliquée pour la commande, uniquement pour les commandes au-dessus de ce montant. Ignorer cette zone, si Vous ne voulez pas imposer des restrictions.');
define('COUPON_USES_COUPON_HELP','Le nombre maximal de fois, qui peut être utilisé un coupon, laissez ce champ vide si Vous ne voulez pas limiter l\'action de la promo.');
define('COUPON_USES_USER_HELP','Le nombre maximal de fois, qui peut être utilisé un coupon par l\'acheteur, ne remplissez pas ce champ, si Vous ne voulez pas limiter l\'action de la promo.');
define('COUPON_PRODUCTS_HELP','Vous pouvez limiter l\'action du coupon uniquement sur les produits dans Votre boutique en ligne, la liste des codes de marchandises par des virgules. Ignorer cette zone, si Vous ne voulez pas imposer des restrictions.');
define('COUPON_CATEGORIES_HELP','Vous pouvez limiter l\'action du coupon uniquement à des catégories spécifiques à Votre boutique en ligne, la liste des codes de catégories séparées par des virgules. Ignorer cette zone, si Vous ne voulez pas imposer des restrictions.');
define('TEXT_TOOLTIP_VOUCHER_EMAIL','Envoyer un coupon par e-mail');
define('TEXT_TOOLTIP_VOUCHER_EDIT','Modifier le coupon');
define('TEXT_TOOLTIP_VOUCHER_DELETE','Supprimer coupon');
define('TEXT_TOOLTIP_VOUCHER_REPORT','Le rapport sur le coupon');
