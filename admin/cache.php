<?php

use admin\includes\solomono\app\models\cache\cache;

require('includes/application_top.php');

$filename = basename(__FILE__, ".php");

$cache = new cache();
$allowed_image_types = ['image/jpeg', 'image/gif', 'image/png', 'image/webp'];

if (isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show') {
    $cache->query($_GET);
    echo json_encode($cache->data);
    exit;
}

$action = $_GET['action'];
switch ($action) {
    case "clear_$filename":
        $id = $_GET['id'] ? $_GET['id'] : false;
        $cache->clear($id);
        $html = $cache->getView("manufacturers/formLang");
        echo json_encode(array('html' => $html));
        exit;
}

include_once('html-open.php');
include_once('header.php');

?>
    <script>
        var lang =<?php echo $cache->getTranslation();?>;
    </script>
    <div class="container">
        <?php
        echo $cache->getView(); ?>
    </div>

<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>