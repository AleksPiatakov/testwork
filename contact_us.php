<?php

require('includes/application_top.php');

includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CONTACT_US);

// BOF: BugFix: Spam mailer exploit
$sanita = array("|([\r\n])[\s]+|", "@Content-Type:@");
$_POST['email'] = $_POST['email'] = preg_replace($sanita, " ", $_POST['email']);
$_POST['name'] = $_POST['name'] = preg_replace($sanita, " ", $_POST['name']);
$_POST['phone'] = $_POST['phone'] = preg_replace($sanita, " ", $_POST['phone']);
$send_to = $_POST['send_to'];
// EOF: BugFix: Spam mailer exploit

$error = false;

if (isset($_GET['action']) && ($_GET['action'] == 'send')) {
    $isValidCSRF = \Solomono\CSRF::isValid();
    //get new _csrf token only after check isValid old
    \Solomono\CSRF::get();
    if (!$isValidCSRF) {
        $messageStack->add('contact', 'reCaptcha error');
        $message = $messageStack->render('contact', 'div', true);
        die(json_encode(['status' => 'fail', 'msg' => $message, 'csrf' => $_SESSION['_csrf']]));
    }

    if (getConstantValue('DEFAULT_CAPTCHA_STATUS', 'false') !== 'false') {
        if (isset($_SESSION['captcha_keystring']) && $_POST['keystring'] !== $_SESSION['captcha_keystring']) {
            $error = true;
            $messageStack->add('contact', 'Captcha error');
            $message = $messageStack->render('contact', 'div', true);
            echo json_encode([
                'status' => 'fail',
                'msg' => $message,
                'csrf' => $_SESSION['_csrf']
            ]);
            die;
        } else {
            unset($_SESSION['captcha_keystring']);
        }
    } else {
        unset($_SESSION['captcha_keystring']);
    }

    if (getConstantValue('GOOGLE_RECAPTCHA_STATUS', 'false') !== 'false' && file_exists(DIR_WS_EXT . 'recaptcha/recaptcha.php')) {
        if ($_SESSION['recaptcha'] !== true) {
            $messageStack->add('contact', 'reCaptcha error');
            $message = $messageStack->render('contact', 'div', true);
            echo json_encode([
                'status' => 'fail',
                'msg' => $message,
                'csrf' => $_SESSION['_csrf']
            ]);
            die;
        }
    }

    $name = tep_db_prepare_input($_POST['name']);
    $email_address = tep_db_prepare_input($_POST['email']);
    $phone = tep_db_prepare_input($_POST['phone']);
    $enquiry = tep_db_prepare_input($_POST['enquiry']);

    $enquiry = ENTRY_FIRST_NAME . " " . $name . "<br /> " . ENTRY_EMAIL . " " . $email_address . "<br />" . ENTRY_TELEPHONE_NUMBER . " " . $phone . "<br /> " . ENTRY_ENQUIRY . " " . $enquiry . "<br />" . sprintf(
        EMAIL_SUBJECT,
        STORE_NAME
    ) . " " . $_SERVER['SERVER_NAME'] . "<br />IP: " . $_SERVER['REMOTE_ADDR'];

    if (tep_validate_email($email_address)) {
        tep_mail(
            STORE_OWNER,
            STORE_OWNER_EMAIL_ADDRESS,
            sprintf(EMAIL_SUBJECT, STORE_NAME),
            $enquiry,
            $name,
            'bot@'.$_SERVER["HTTP_HOST"]
        );

        $messageStack->add('contact', TEXT_SUCCESS, 'success');
        $message = $messageStack->render('contact', 'div', true);
        unset($_SESSION['recaptcha']);

        echo json_encode(array('status' => 'success', 'msg' => $message, 'csrf' => $_SESSION['_csrf']));
    } else {
        $messageStack->add('contact', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
        $message = $messageStack->render('contact', 'div', true);
        echo json_encode(array('status' => 'fail', 'msg' => $message, 'csrf' => $_SESSION['_csrf']));
    }
    die();
}

$enquiry = "";
$name = "";
$email = "";

$breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_CONTACT_US));

$content = CONTENT_CONTACT_US;

require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

require(DIR_WS_INCLUDES . 'application_bottom.php');
