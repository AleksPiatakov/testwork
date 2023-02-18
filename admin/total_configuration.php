<?php
require('includes/application_top.php');

use admin\includes\solomono\app\models\total_configuration\total_configuration;

if ($login_id != "1"){
    tep_redirect(tep_href_link(FILENAME_DEFAULT));
}

$obg = new total_configuration();
$filename =$obg->getTableName();

if (isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show') {
    $obg->query($_GET);
    echo json_encode($obg->data);
    exit;
}

if ($obg->isAjax()) {

    $action = $_GET['action'];
    switch ($action) {
        case "edit_$filename":
        case "new_$filename":
            $id = $_GET['id'] ? $_GET['id'] : false;
            $obg->selectOne($id);
            $html = $obg->getView("total_configuration/form");
            echo json_encode(array('html' => $html));
            exit;
            break;
        case "insert_$filename":
            if ($obg->insert($_POST)) {
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
            if ($obg->update($_POST)) {
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
    }
    $action = $_POST['action'];
    switch ($action) {
        case "delete_$filename":
            if ($obg->delete($_POST['id'])) {
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

/*if ($obg->isAjax()) {

    if (isset($_GET['ajax']) && $_GET['ajax'] == 'ajax_form') {//get form
        $id = $_GET['id'] ? $_GET['id'] : false;
        $obg->selectOne($id);
        $html = $obg->getView('total_configuration/ajax_form');
        echo json_encode(array('html' => $html));
        exit;
    }
    if (!empty($_POST['id'])) { //update
        if ($obg->update($_POST)) {
            $array = array(
                'success' => true,
                'data' => $obg->data['data'][0],
            );
            $array['msg']=$obg->error?$obg->error:TEXT_SAVE_DATA_OK;
        } else {
            $array = array(
                'success' => false,
                'msg' => TEXT_ERROR
            );
        }
        echo json_encode($array);
        exit;
    }
    if (!empty($_POST['del'])) { //delete
        if ($obg->delete($_POST['del'])) {
            $array = array(
                'success' => true,
                'msg' => TEXT_DEL_OK
            );
        } else {
            $array = array(
                'success' => false,
                'msg' => TEXT_ERROR
            );
        }
        echo json_encode($array);
        exit;
    }

}
if (isset($_POST['id']) && empty($_POST['id'])) { //insert
    if ($obg->insert($_POST)) {
        tep_redirect($_SERVER['SCRIPT_NAME']);
    } else {
        debug($obg->error);
        exit;
    }
}*/

$conf_group = $obg->getGroup();
?>

<?php
include_once('html-open.php');
include_once('header.php');
?>
<script>
    var lang=<?php echo $obg->getTranslation()?>;

    $(document).ready(function () {
        $('select#group option[value="' + option.group + '"]').prop("selected", true);


        $('#own_table').on('mouseenter', 'td[data-name="configuration_description"]', function () {
            var text = $(this).text();
            show_tooltip(text, 900000, $(this));
        });
        $('#own_table').on('mouseleave', 'td[data-name="configuration_description"]', function () {
            $('.tooltip_own').remove();
        });

        $('#group').on('change', function () {
            option.group = $(this).val();
            option.page = 1;
            delete(option.count);
            $('#own_pagination').pagination('selectPage', option.page);
        });
    });
</script>
<div class="container-fluid">
    <div class="row text-right">Site folder: <?php $admin_folder = getenv('ADMIN_FOLDER'); echo str_replace($admin_folder, '', __DIR__) ?></div>
    <div class="wrapper-title">
        <div class="bg-light lter wrapper-md wrapper_767 ng-scope">
            <h1 class="m-n font-thin h3"><?php echo HEADING_TITLE;?></h1>
        </div>
    </div>
    <?php if(isset($_SESSION['message'])):?>
        <div class="alert alert-danger fade in" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            <?php echo $_SESSION['message'];?>
        </div>
        <?php unset($_SESSION['message']);?>
    <?php endif; ?>
    <div class="row">
        <div class="col-sm-2">
            <p>Filters:</p>
        </div>
        <div class="col-sm-4">
            <select class="form-control" id="group">
                <option value="all">ALL GROUPS</option>
                <?php for ($i = 0; $i < count($conf_group); $i++): ?>
                    <option value="<?php echo $conf_group[$i]['id']?>"><?php echo $conf_group[$i]['configuration_group_title']?></option>
                <?php endfor; ?>
            </select>
        </div>
    </div>
    <?php echo $obg->getView('total_configuration/total_configuration');?>
</div>
<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
