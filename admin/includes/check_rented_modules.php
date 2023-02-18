<?php
use App\Logger\Log;

$sitename =  env('APP_NAME');
if(!isset($_COOKIE['CHECK_PACKAGE'])){
    setcookie("CHECK_PACKAGE", "true", time() + 60 * 60 * 24, '/');
    $domen = 'https://solomono.net';
    $secret = 9967543215497;
    $url = $domen . '/api/rent_modules_package.php?secret=' . $secret;
    $data = array('site_name' => $sitename);
    
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );

    $responseCode = get_http_code($url);
    if($responseCode == 200) {
        $context = stream_context_create($options);
        $results = @file_get_contents($url, false, $context);
        file_put_contents(DIR_FS_CATALOG . 'temp/check_rent_package.json', $results);
    }
}else{
    $results = @file_get_contents(DIR_FS_CATALOG.'temp/check_rent_package.json');
}

if ($results === FALSE) {
    Log::error('Ошибка проверки сайта ' . $sitename . ' на триал');
    die();
}

$result = json_decode($results, true);

if(isset($result['current_package'])){
    $not_buyed_modules = [];
    if (!empty($result)) {
        if(!empty($result['new_site_name'])){
            $new_site_name = $result['new_site_name'];
        }
        unset ($result['new_site_name']);
        
        if(!empty($result['current_package'])){
            $current_package = $result['current_package'];
        }
        unset ($result['current_package']);
        
        foreach ($result as $package){
            if(isset($package['rent_package_name'])){
                $not_buyed_modules[$package['rent_package_name']] = $package['modules'];
                define('RENT_LIMIT', $package['rent_package_limit']);
            }
        }
    }
    if(isset($current_package)){
        define('RENT_PACKAGE',$current_package);
    } else {
        define('RENT_PACKAGE','pro');
    }
    define('NOT_BUYED_MODULES', $not_buyed_modules);
    define('SITE_TYPE', 'RENTED');
}