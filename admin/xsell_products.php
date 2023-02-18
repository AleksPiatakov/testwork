<?php
require('includes/application_top.php');

use admin\includes\solomono\app\models\xsell_products\xsell_products;

$filename = basename(__FILE__, ".php");

$xsell_products = new xsell_products();


if (isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show') {
    $xsell_products->query($_GET);   
    echo json_encode($xsell_products->data);
    exit;
}

if ($xsell_products->isAjax()) {

    $action = $_GET['action'];
    switch ($action) {
        case "edit_$filename":
            $id = $_GET['id'] ? $_GET['id'] : false;
            $xsell_products->selectOne($id);
            $html = $xsell_products->getView("xsell_products/form");
            echo json_encode(array('html' => $html));
            exit;
            break;
        case 'translate':
            /*id language*/
            $from=$_GET['from']?:1;
            $to=$_GET['to']?:3;

            $arr=$xsell_products->yandexTranslate($_POST,$from,$to);
            echo json_encode($arr);
            exit;
            break;
    }
    $action = $_POST['action'];
    switch ($action) {
        case "delete":
            if ($xsell_products->delete($_POST['id'])) {
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
        case "updateXsellProduct":
            if ($xsell_products->updateXsellProduct($_POST)) {
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
        case "insert":
            if ($xsell_products->insert($_POST)) {
                $arr = array(
                    'success' => true,
                    'msg' => TEXT_SAVE_DATA_OK,
                    'html' => $xsell_products->getView("$filename/form_xsell_product")
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
        if($xsell_products->statusUpdate($_POST['status'],$_POST['id'])){
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
    if (!empty($_GET['product_id']) && !empty($_GET['id'])) {
        $arr=$xsell_products->select_product_xsell($_GET['product_id'], $_GET['id']);
        echo json_encode($arr);
        exit;
    }
}

?>

<?php
include_once('html-open.php');
include_once('header.php');
?>
    <script>
        var lang=<?php echo $xsell_products->getTranslation();?>;
    </script>
    <div class="container-fluid">
        <?php echo $xsell_products->getView('xsell_products/xsell_product');?>
    </div>

<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>