<?php

$rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
chdir('../../');
require($rootPath . '/includes/application_top.php');

$code = $_POST['code'];
$url = "https://accounts.google.com/o/oauth2/token";

$postFields = [
    'code' => $code,
    'client_id' => $googleClientID,
    'client_secret' => $googleClientSecret,
    'redirect_uri' => HTTP_SERVER,
    'grant_type' => 'authorization_code',
];

//get google access_token
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
curl_setopt($ch, CURLOPT_TIMEOUT, 20);
$response = curl_exec($ch);
curl_close($ch);
$user = json_decode($response);
$access_token = isset($user->access_token) ? $user->access_token : false;

//get google profile data
if ($access_token) {
    $ressult = file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo?alt=json&access_token=' . $access_token);
    $user = json_decode($ressult);

    echo json_encode([
        'success' => true,
        'id' => 'google_' . $user->id,
        'firstname' => $user->given_name,
        'lastname' => $user->family_name,
        'picture' => $user->picture,
        'email' => $user->email,
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Error google access token',
    ]);
}
