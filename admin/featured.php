<?php
require('includes/application_top.php');
use admin\includes\solomono\app\models\featured\featured;

$obg=new featured;
$filename=basename(__FILE__, ".php");
if (isset($_GET['ajax_load']) && $_GET['ajax_load']=='show') {
    $obg->query($_GET);
    echo json_encode($obg->data);
    exit;
}

if ($obg->isAjax()) {

    $action=$_GET['action'];
    switch ($action) {
        case "edit_$filename":
        case "new_$filename":
            $id=$_GET['id'] ? $_GET['id'] : false;
            $obg->selectOne($id);
            $html=$obg->getView('form');
            echo json_encode(array('html'=>$html));
            exit;
            break;
        case "insert_$filename":
            if ($obg->insert($_POST)) {
                $arr=array(
                    'success'=>true,
                    'msg'=>TEXT_SAVE_DATA_OK,
                );
            }else {
                $arr=array(
                    'success'=>false,
                    'msg'=>TEXT_ERROR
                );
            }
            echo json_encode($arr);
            exit;
            break;
        case "update_$filename":
            if ($obg->update($_POST)) {
                $arr=array(
                    'success'=>true,
                    'msg'=>TEXT_SAVE_DATA_OK,
                );
            }else {
                $arr=array(
                    'success'=>false,
                    'msg'=>TEXT_ERROR
                );
            }
            echo json_encode($arr);
            exit;
            break;

    }
    $action=$_POST['action'];
    switch ($action) {
        case "delete_$filename":
            if ($obg->delete($_POST['id'])) {
                $arr=array(
                    'success'=>true,
                    'msg'=>TEXT_SAVE_DATA_OK
                );
            }else {
                $arr=array(
                    'success'=>false,
                    'msg'=>TEXT_ERROR
                );
            }
            echo json_encode($arr);
            exit;
            break;
    }
    if(isset($_POST['status'])){
        if($obg->statusUpdate($_POST['status'],$_POST['id'])){
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

if (!empty($_GET['term'])) {
    $arr=$obg->getProducts($_GET['term']);
    echo json_encode($arr);
    exit;
}
?>

<?php
include_once('html-open.php');
include_once('header.php');
?>
    <script>
        var lang =<?php echo $obg->getTranslation();?>;
        $(document).ready(function () {
            $(document).on('click','.saveInputData',function(){
                $('#products_name,#expires_date').val('')
            })
            $('body').on('focus', 'input[name="expires_date"]', function () {
                $(this).datepicker({
                    showOtherMonths: true,
                    selectOtherMonths: true,
                    dateFormat:'yy-mm-dd',
                    onSelect: function(datetext) {
                        var d = new Date(); // for now

                        var h = d.getHours();
                        h = (h < 10) ? ("0" + h) : h ;

                        var m = d.getMinutes();
                        m = (m < 10) ? ("0" + m) : m ;

                        var s = d.getSeconds();
                        s = (s < 10) ? ("0" + s) : s ;

                        datetext = datetext + " " + h + ":" + m + ":" + s;

                        $('input[name="expires_date"]').val(datetext);
                    }
                });
            });

            $('body').on('focus', '#products_name', function () {
                $("#products_name").autocomplete({
                    source: window.location.pathname,
                    delay: 20,
                    minLength: 2,
                    select: function (event, ui) {
                        $("#products_name").val('(' + ui.item.id + ' #' + ui.item.model + ') ' + ui.item.label);
                        return false;
                    }
                }).autocomplete("instance")._renderItem = function (ul, item) {
                    ul.css('z-index', 9999);
                    return $("<li>")
                        .append("<div>" + item.label + "</div>")
                        .appendTo(ul);
                };
            });
        });
    </script>
    <div class="container">
        <?php echo $obg->getView();?>
    </div>
<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>