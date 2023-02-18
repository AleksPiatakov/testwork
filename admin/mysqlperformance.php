<?php
require('includes/application_top.php');
require(DIR_WS_FUNCTIONS . 'mysqlperformance.php');

use admin\includes\solomono\app\models\mysqlperformance\mysqlperformance;

$filename = basename(__FILE__, ".php");

$mysqlperformance = new mysqlperformance();


if (isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show') {
    $mysqlperformance->query($_GET);
    echo json_encode($mysqlperformance->data);
    exit;
}

if ($mysqlperformance->isAjax()) {      
    $action = $_POST['action'];
    switch ($action) {
        case "delete_$filename":
            if (cutline(DIR_FS_LOGS . '/MYSQL/admin/slow_query/slow_query_log.txt', $_POST['id'])) {
                $arr = array(
                    'success' => true,
                    'msg' => TEXT_SAVE_DATA_OK
                );
            } else {
                $arr = array(
                    'success' => false,
                    'msg' => TEXT_ERROR
                );
            }
            echo json_encode($arr);
            exit;
            break;
        case "deleteAll":
            if (unlink(DIR_FS_LOGS . '/MYSQL/admin/slow_query/slow_query_log.txt')) {
                $arr = array(
                    'success' => true,
                    'msg' => TEXT_SAVE_DATA_OK
                );
            } else {
                $arr = array(
                    'success' => false,
                    'msg' => TEXT_ERROR
                );
            }
            echo json_encode($arr);
            exit;
            break;
    }
        
    if(isset($_POST['status'])){
        if($mysqlperformance->statusUpdate($_POST['status'],$_POST['id'])){
            $array = array(
                'success' => true,
                'msg' => TEXT_SAVE_DATA_OK,
            );
        }else{
            $array = array(
                'success' => false,
                'msg' => TEXT_ERROR
            );
        }
        echo json_encode($array);
        exit;
    }
}

?>

<?php
include_once('html-open.php');
include_once('header.php');
?>
    <script>
        var lang=<?php echo $mysqlperformance->getTranslation();?>;
    </script>
    <div class="container-fluid mysqlperformance_block">
        <?php echo $mysqlperformance->getView();?>
    </div>

<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>