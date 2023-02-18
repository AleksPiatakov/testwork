<?php
/*
  $Id: gv_mail.php,v 1.2 2003/09/24 13:57:08 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright(c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Zertifikat senden');

define('TEXT_CUSTOMER', 'Kunde: ');
define('TEXT_SUBJECT', 'Betreff: ');
define('TEXT_FROM', 'Von: ');
define('TEXT_TO', 'An: ');
define('TEXT_AMOUNT', 'Zertifikatsumme');
define('TEXT_MESSAGE', 'Nachricht: ');
define('TEXT_SINGLE_EMAIL', '<span class ="smallText">In diesem Feld können Sie das Zertifikat an andere E-Mail-Adressen senden, die nicht in der obigen Liste sind.</span>. ');
define('TEXT_SELECT_CUSTOMER', 'Kunde auswählen');
define('TEXT_ALL_CUSTOMERS', 'Alle Clients');
define('TEXT_NEWSLETTER_CUSTOMERS', 'zu allen Einkaufsliste');

define('NOTICE_EMAIL_SENT_TO', 'Benachrichtigung: E-Mail gesendet: %s');
define('ERROR_NO_CUSTOMER_SELECTED', 'Fehler: Sie haben den Client nicht ausgewählt. ');
define('ERROR_NO_AMOUNT_SELECTED', 'Fehler: Sie haben nicht die Menge des Zertifikats angegeben. ');

define('TEXT_GV_WORTH', 'Zertifikat für den Betrag');
define('TEXT_TO_REDEEM', 'das Zertifikat zu aktivieren, klicken Sie auf den unten stehenden Link und geben Sie den Gutschein-Code -');
define('TEXT_WHICH_IS', '');
define('TEXT_IN_CASE', '');
define('TEXT_OR_VISIT', 'oder indem Sie unseren Online-Shop besuchen');
define('TEXT_ENTER_CODE', 'das Zertifikat Code während des Bestellvorgangs angeben. ');

define('TEXT_REDEEM_COUPON_MESSAGE_HEADER', 'Sie haben Ihr Zertifikat aktiviert, aber es kann verwendet werden, wenn Sie Einkäufe erst nach Überprüfung der Filialleiter machen, dies ausschließlich zum Zweck der Sicherheit getan wird Nachdem das Zertifikat vom Administrator überprüft wird Sie bei der E-Mail benachrichtigt werden,... ');
define('TEXT_REDEEM_COUPON_MESSAGE_AMOUNT', "\n\n" . 'Certificate wert %s');
define('TEXT_REDEEM_COUPON_MESSAGE_BODY', "\n\n" . 'Sie können Ihr Zertifikat oder eine Bescheinigung über die Summe ihrer Freunde und Bekannten schicken. ');
define('TEXT_REDEEM_COUPON_MESSAGE_FOOTER', "\n\n");

//Button
define('BUTTON_CANCEL_NEW', 'stornieren');
?>