<?php

/**
 * Created by PhpStorm.
 * User: 'Serhii.M'
 * Date: 25.02.2019
 * Time: 15:21
 */

if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    $rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
    chdir('../../');
    require_once($rootPath . '/includes/application_top.php');
}

if (!defined("GOOGLE_RECAPTCHA_STATUS")) {
    $get_captcha_raw = "SELECT configuration_key AS key, configuration_value AS value FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'GOOGLE_RECAPTCHA_STATUS'";
    $res = tep_db_fetch_array(tep_db_query($get_captcha_raw));
    define($res['key'], [$res['value']]);
}
if (GOOGLE_RECAPTCHA_STATUS === 'true') {
    if (isset($_POST['action']) && $_POST['action'] === 'checkResponseToken') {
        $token = $_POST['token'];
        $data = [
            'secret' => GOOGLE_RECAPTCHA_SECRET_KEY,
            'response' => $token,
        ];

        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $response = json_decode(curl_exec($verify));
        $_SESSION['recaptcha'] = $response->success;
        die(json_encode(1));
    } else {
        ?>
        <div class="g-recaptcha" data-sitekey="<?= GOOGLE_RECAPTCHA_PUBLIC_KEY ?>" data-callback="reCaptchaCallback"></div>
    <?php } ?>
<?php } ?>