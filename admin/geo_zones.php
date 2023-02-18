<?php

require('includes/application_top.php');
require('includes/functions/newsdesk_general.php');

use admin\includes\solomono\app\models\geo_zones\zones_to_geo_zones;
use admin\includes\solomono\app\models\geo_zones\tax_zones;

$allowed_image_types = ['image/jpeg', 'image/gif', 'image/png', 'image/webp'];

function getTree($arr)
{
    static $show;
    foreach ($arr as $key => $value) {
        $show .= '<li data-topic="' . $value['id'] . '"><span class="settings_cat"><i class="fa fa-cog fa-fw" aria-hidden="true"></i></span><a href="' . $_SERVER['PHP_SELF'] . '?tPath=' . $value['id'] . '">' . $value['geo_zone_name'] . '</a>';
        if (isset($value['childs'])) {
            $show .= '<span class="badge"><i class="fa fa-folder fa-fw" aria-hidden="true"></i>' . count($value['childs']) . '</span><ul>';
            getTree($value['childs']);
            $show .= '</ul>';
        }
        $show .= '</li>';
    }

    return $show;
}

function getTreeOption($arr, $str = '', $find = false)
{
    foreach ($arr as $key => $value) {
        if ($value['parent'] != 0) {

            echo '<option value="' . $value['id'] . '">' . $value['topics_name'] . '</option>';
        } else {
            $select = $find == $value['id'] ? 'selected' : '';
            echo '<option ' . $select . ' value="' . $value['id'] . '">' . $str . ' ' . $value['topics_name'] . '</option>';
        }
        if (isset($value['childs'])) {
            $i = 1;
            for ($j = 0; $j < $i; $j++) {
                $str .= '→';
            }
            $i++;

            echo getTreeOption($value['childs'], $str, $find);
            $str = '';
        }
    }

}

$tax_zones = new tax_zones();
$zones_to_geo_zones = new zones_to_geo_zones();

if (isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show') {
    $zones_to_geo_zones->query($_GET);
    echo json_encode($zones_to_geo_zones->data);
    exit;
}

if ($zones_to_geo_zones->isAjax()) {

    $action = $_POST['action'] ?: $_GET['action'];
    switch ($action) {
        case 'topic':
            //if isset $_GET['tPath'] =get data in form else new form without id
            $id = $_GET['tPath'] ? $_GET['tPath'] : false;
            $tax_zones->getDescription($id);
            $html = $tax_zones->getView('geo_zones/form');
            $title = HEADING_TITLE;
            echo json_encode([
                    'title' => $title,
                    'html' => $html
            ]);
            exit;
            break;
        case 'update_geo_zones':
            if ($tax_zones->update($_POST)) {
                $get_tax_zones = $tax_zones->setTree();
                $categories = getTree($get_tax_zones);
                $arr = array(
                    'success' => true,
                    'html' => $categories,
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
        case 'insert_geo_zones':
            if ($tax_zones->insert($_POST)) {
                $get_tax_zones = $tax_zones->setTree();
                $categories = getTree($get_tax_zones);
                $arr = array(
                    'success' => true,
                    'html' => $categories,
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
        case 'delete_topic':
            $html = '<div class="row">
                            <div class="col-sm-12">
                                  <input type="submit" value="OK" class="btn">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">' . TEXT_MODAL_CANCEL_ACTION . '</button>
                            </div>
                     </div>';

            $arr = array(
                'title' => TEXT_INFO_HEADING_DELETE_ZONE,
                'html' => $html
            );
            echo json_encode($arr);
            exit;
            break;
        case 'confirm_delete_topic':
            $tax_zones->confirmDelete($_POST['tPath']);
            $arr = array(
                'success' => true,
            );
            echo json_encode($arr);
            exit;
            break;

        case 'edit_zones_to_geo_zones':
        case 'new_zones_to_geo_zones':
            $id = $_GET['id'] ? $_GET['id'] : false;
            $zones_to_geo_zones->selectOne($id);
            $tPath = $_GET['tPath'] ? $_GET['tPath'] : ($zones_to_geo_zones->data['tPath'] ?: false);
            $zones_to_geo_zones->data['tPath'] = $tPath;
            $zones_to_geo_zones->data['geo_zone_id'] = $tPath;
            $html = $zones_to_geo_zones->getView('geo_zones/form');
            echo json_encode(array('html' => $html));
            exit;
            break;
        case 'update_zones_to_geo_zones':
            if (!empty($_POST['id'])) {
                if ($zones_to_geo_zones->update($_POST)) {
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
            }
            break;
        case 'insert_zones_to_geo_zones':
            $zones_to_geo_zones->checkFile('zones_to_geo_zones_image', null, null, $allowed_image_types);
            if ($zones_to_geo_zones->insert($_POST)) {
                $arr = array(
                    'success' => true,
                    'reload' => true,
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
        case 'delete_zones_to_geo_zones':
            if ($zones_to_geo_zones->delete($_POST['id'])) {
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
        case 'get_zones':
            if ($html = $zones_to_geo_zones->getZones($_POST['zone_country_id'])) {
                $arr = array(
                    'success' => true,
                    'html' => $html,
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
    if (isset($_POST['status'])) {
        if ($zones_to_geo_zones->statusUpdate($_POST['status'], $_POST['id'], 'zones_to_geo_zones_status')) {
            $array = array(
                'success' => true,
                'msg' => TEXT_SAVE_DATA_OK,
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


$get_tax_zones = $tax_zones->setTree();
$categories = getTree($get_tax_zones);

include_once('html-open.php');
include_once('header.php');


?>
    <script>
        var lang =<?php echo $zones_to_geo_zones->getTranslation();?>;
    </script>
<?php include DIR_WS_TABS . "taxes.php"; ?>
    <div class="hbox hbox-auto-xs hbox-auto-sm">
        <div class="col w-lg bg-light dk b-r bg-auto" id="aside">
            <div class="wrapper bg">
                <h3 class="m-n font-thin">
                    <?php echo HEADING_TITLE; ?>
                    <i class="fa plus fa-plus-circle" aria-hidden="true"></i>
                </h3>
            </div>
            <div class="wrapper">
                <ul id="topics">
                    <li>
                        <a data-topic="all" href="<?php echo $_SERVER['PHP_SELF'] ?>"><?php echo TEXT_ALL_TAX_ZONES ?></a>
                    </li>
                    <?php echo $categories; ?>
                </ul>
            </div>
        </div>
        <div class="col">
            <div class="wrapper">
                <?php echo $zones_to_geo_zones->getView(); ?>
            </div>
        </div>
    </div>
<?php include_once('footer.php'); ?>
<?php
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>