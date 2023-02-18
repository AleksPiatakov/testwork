<?php

require('includes/application_top.php');
require('includes/functions/newsdesk_general.php');
require_once ("includes/languages/$language/articles.php");
use admin\includes\solomono\app\models\admin_files\admin_files;
use admin\includes\solomono\app\models\admin_files\boxes;

function getTree($arr) {
    static $show;
    foreach ($arr as $key=>$value) {
        $show.='<li data-topic="' . $value['id'] . '"><a href="' . $_SERVER['PHP_SELF'] . '?tPath=' . $value['id'] . '">' . $value['admin_boxes_name'] . '</a>';
        if (isset($value['childs'])) {
            $show.='<span class="badge"><i class="fa fa-folder fa-fw" aria-hidden="true"></i>' . count($value['childs']) . '</span><ul>';
            getTree($value['childs']);
            $show.='</ul>';
        }
        $show.='</li>';
    }

    return $show;
}

$boxes=new boxes();
$admin_files=new admin_files();

if (isset($_GET['ajax_load']) && $_GET['ajax_load']=='show') {
    $admin_files->query($_GET);
    echo json_encode($admin_files->data);
    exit;
}

if ($admin_files->isAjax()) {

    $action=$_POST['action'] ? : $_GET['action'];
    switch ($action) {
        case 'new_admin_files':
            $admin_files->getFiles();
            $tPath = $_GET['tPath'] ? $_GET['tPath'] : ($admin_files->data['tPath'] ? : false);
            $admin_files->data['tPath']=$tPath;
            $html=$admin_files->getView('admin_files/form');
            echo json_encode(array('html'=>$html));
            exit;
            break;
        case 'insert_admin_files':
            if ($admin_files->insertFiles($_POST['admin_files_select'],$_POST['tPath']?:false)) {
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
        case 'delete_admin_files':
            if ($admin_files->deleteFiles($_POST['id'],$_POST['tPath']?:false)) {
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
    if (isset($_POST['status'])) {
        if ($admin_files->statusUpdate($_POST['status'], $_POST['id'], 'status')) {
            $array=array(
                'success'=>true,
                'msg'=>TEXT_SAVE_DATA_OK,
            );
        }else {
            $array=array(
                'success'=>false,
                'msg'=>TEXT_ERROR
            );
        }
        echo json_encode($array);
        exit;
    }
}




$get_boxes=$boxes->setTree();
$categories=getTree($get_boxes);

include_once('html-open.php');
include_once('header.php');


?>
<script>
    var lang =<?=$admin_files->getTranslation();?>;
</script>
<div class="hbox hbox-auto-xs hbox-auto-sm">
    <div class="col w-lg bg-light dk b-r bg-auto" id="aside">
        <div class="wrapper bg ">
            <h3 class="m-n font-thin">
                <?=TABLE_HEADING_BOXES;?>
            </h3>
        </div>
        <div class="wrapper">
            <ul id="topics">
                <?=$categories;?>
            </ul>
        </div>
    </div>
    <div class="col">
        <div class="wrapper">
            <?=$admin_files->getView();?>
        </div>
    </div>
</div>
<?php include_once('footer.php');?>
<?php
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>