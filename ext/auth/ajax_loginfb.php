<?php

$rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
chdir('../../');
require($rootPath . '/includes/application_top.php');

// Facebook - читается из application_top
$app_id = $fb_app_id;
$app_secret = $fb_app_secret;
$my_url = $fb_url;
$_SESSION['state'] = $fb_state;

//   session_start();
$code = $_REQUEST["code"];

if (empty($code)) {
    $_SESSION['state'] = md5(uniqid(rand(), true)); //CSRF protection
    $dialog_url = "https://www.facebook.com/dialog/oauth?client_id="
        . $app_id . "&redirect_uri=" . urlencode($my_url) . "&state="
        . $_SESSION['state'];

    echo("<script> top.location.href='" . $dialog_url . "'</script>");
}

if ($_SESSION['state'] && ($_SESSION['state'] === $_REQUEST['state'])) {
    $token_url = "https://graph.facebook.com/oauth/access_token?"
        . "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
        . "&client_secret=" . $app_secret . "&code=" . $code;

    // get user by token:
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $token_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);

    $params = json_decode($response);

    $appsecret_proof = hash_hmac('sha256', $params->access_token, $app_secret);
    $graph_url = "https://graph.facebook.com/me?fields=id,name,first_name,last_name,hometown,picture,email&access_token=" . $params->access_token . "&appsecret_proof=" . $appsecret_proof;

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_URL, $graph_url);
    curl_setopt($ch, CURLOPT_REFERER, $graph_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    // debug($result);

    $user = json_decode($result);

    echo '<script>window.close();window.opener.checkLoginvk("fb_' . $user->id . '","' . $user->first_name . '","' . $user->last_name . '","' . $user->picture->data->url . '","' . $user->email . '","' . $user->hometown->name . '","")</script>';
} else {
    echo("The state does not match. You may be a victim of CSRF.");
}
// Facebook END
