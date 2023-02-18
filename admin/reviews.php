<?php
require('includes/application_top.php');

use admin\includes\solomono\app\models\reviews\reviews;

$filename = basename(__FILE__, ".php");

$reviews = new reviews();


if (isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show') {
    $reviews->query($_GET);
    echo json_encode($reviews->data);
    exit;
}

if ($reviews->isAjax()) {

    $action = $_GET['action'];
    switch ($action) {
        case "edit_$filename":
        case "new_$filename":
            $id = $_GET['id'] ? $_GET['id'] : false;
            $reviews->selectOne($id);
            $html = $reviews->getView("form");
            echo json_encode(array('html' => $html));
            exit;
            break;
        case "answer_$filename":
            $id = $_GET['id'];
            if($id) {
                $reviews->selectOne($id);
                $html = $reviews->getview('reviews/answer');
                echo json_encode(array('html' => $html));
            }
            else{
                $_POST['customers_id'] = $login_id;
                $_POST['customers_name'] = "Admin";
                $_POST['reviews_rating'] = "5";
                $_POST['last_modified'] = date('Y-m-d H:i:s');
                if ($reviews->insert($_POST)) {
                    $arr = array(
                        'success' => true,
                        'msg' => TEXT_SAVE_DATA_OK,
                    );
                } else {
                    $arr = array(
                        'success' => false,
                        'msg' => TEXT_ERROR
                    );
                }
                echo json_encode($arr);
            }
            exit;
            break;
        case "insert_$filename":
            if ($reviews->insert($_POST)) {
                $arr = array(
                    'success' => true,
                    'msg' => TEXT_SAVE_DATA_OK,
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
        case "update_$filename":
            if ($reviews->update($_POST)) {
                $arr = array(
                    'success' => true,
                    'msg' => TEXT_SAVE_DATA_OK,
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
        case "editreply_$filename":
            $id = $_GET['id'] ? $_GET['id'] : false;
            $reviews->selectOne($id, true);
            $html = $reviews->getView("form");
            echo json_encode(array('html' => $html));
            exit;
            break;
        case "getParents":
            $parent = $reviews->selectParent();
            echo json_encode($parent);
            exit;
            break;
    }
    $action = $_POST['action'];
    switch ($action) {
        case "delete_$filename":
            if ($reviews->delete($_POST['id'])) {
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
        if($reviews->statusUpdate($_POST['status'],$_POST['id'])){
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
        var lang=<?php echo $reviews->getTranslation();?>;
    </script>
    <div class="container">
        <?php echo $reviews->getView();?>
    </div>

<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>