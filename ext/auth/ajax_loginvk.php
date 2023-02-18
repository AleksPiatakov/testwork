<?php

$rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
chdir('../../');
require($rootPath . '/includes/application_top.php');

mb_internal_encoding("UTF-8");
header('Content-Type: text/html; charset=UTF-8');

$vk_client_id = $vk_app_id;
$vk_secret = $vk_app_secret;
$vk_uri = $vk_url;

$r = json_decode(file_get_contents("https://oauth.vk.com/access_token?client_id=" . $vk_client_id . "&redirect_uri=" . $vk_uri . "&client_secret=" . $vk_secret . "&code=" . $_GET["code"]));
$_SESSION["VK_UID"] = $r->user_id;
$vkResponse = json_decode(file_get_contents("https://api.vk.com/method/getProfiles?uid={$r->user_id}&access_token={$r->access_token}&fields=photo,city,contacts&v=5.103"))->response;

$vk_first_name = $vkResponse[0]->first_name;
$vk_last_name = $vkResponse[0]->last_name;

$vk_photo = $vkResponse[0]->photo;
$vk_email = $r->email;

echo '<script>
          window.close();window.opener.checkLoginvk("vk_' . $vkResponse[0]->id . '","' . $vk_first_name . '","' . $vk_last_name . '","' . $vk_photo . '","' . $vk_email . '","","");
        </script>';
