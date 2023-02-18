<?php


// set php runtime to unlimited
set_time_limit(0);

$rootPath = dirname(dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME']))));
$config = parse_ini_file($rootPath . '/.env');
$dsn = "mysql:dbname={$config['DB_DATABASE']};host={$config['DB_HOST']}";
$user = $config['DB_USERNAME'];
$password = $config['DB_PASSWORD'];
$connection = new PDO($dsn, $user, $password);

$prevSessionIds = is_array($_POST['sessionIds']) ? $_POST['sessionIds'] : [];
sort($prevSessionIds);
// main loop
$startTime = microtime(true);
while (true) {
    $sessionIds = [];
    $sql = "SELECT session_id, last_page_url FROM whos_online WHERE " . time();
    $query = $connection->query($sql);
    foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $sessionIds[] = $row;
    }
    sort($sessionIds);
    if ($prevSessionIds != $sessionIds) {
        $json = json_encode(['sessionIds' => $sessionIds]);
        echo $json;
        break;

    } else {
        if (microtime(true) - $startTime>600) {
            die;
        }
        sleep(1);
        continue;
    }
}