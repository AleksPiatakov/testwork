<?php


require_once 'solomono/app/models/salemaker/salemaker.php';
$allowed_image_types = ['image/jpeg', 'image/gif', 'image/png', 'image/webp'];

function getTreeOption($arr, $depth = 0, $selected_id = false)
{
    $html = '';
    foreach ($arr as $v) {
        if (is_array($selected_id)) {
            $selected = in_array($v['id'], $selected_id) ? 'selected' : '';
        } else {
            $selected = $selected_id == $v['id'] ? 'selected' : '';
        }
        $html .= '<option ' . $selected . ' value="' . $v['id'] . '">';
        $html .= str_repeat('&nbsp;', $depth * 3);
        $html .= $v['name'] . '</option>';
        if (array_key_exists('childs', $v)) {
            $html .= getTreeOption($v['childs'], $depth + 1, $selected_id);
        }
    }
    return $html;
}

$filename = basename(__FILE__, ".php");
$salemaker = new salemaker();
if (isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show') {
    $salemaker->query($_GET);
    echo json_encode($salemaker->data);
    exit;
}

if ($salemaker->isAjax()) {
    $action = $_GET['action'];
    switch ($action) {
        case "edit_$filename":
        case "new_$filename":
            $id = $_GET['id'] ? $_GET['id'] : false;
            $salemaker->selectOne($id);
            $categories_arr = $salemaker->setTree();
            $selected_categories = explode(',', $salemaker->data['data']['sale_categories_selected']);
            $selected_manufacturers = explode(',', $salemaker->data['data']['sale_manufacturers_selected']);
            $salemaker->data['option']['sale_categories_selected'] = getTreeOption(
                $categories_arr,
                0,
                $selected_categories
            );
            $salemaker->data['option']['sale_manufacturers_selected'] = getTreeOption(
                $salemaker->getManufacturers(),
                0,
                $selected_manufacturers
            );
            $html = $salemaker->getView("form");
            echo json_encode(array('html' => $html));
            exit;
            break;
        case "insert_$filename":
            $salemaker->checkFile('salemaker_image', $_POST['id'], null, $allowed_image_types);
            if ($salemaker->insert($_POST)) {
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
            $salemaker->checkFile('salemaker_image', $_POST['id'], null, $allowed_image_types);
            if ($salemaker->update($_POST)) {
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
        case 'translate':
            /*id language*/
            $from = $_GET['from'] ?: 1;
            $to = $_GET['to'] ?: 3;

            $arr = $salemaker->yandexTranslate($_POST, $from, $to);
            echo json_encode($arr);
            exit;
            break;
    }
    $action = $_POST['action'];
    switch ($action) {
        case "delete_$filename":
            if ($salemaker->delete($_POST['id'])) {
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
    if (isset($_POST['status'])) {
        if (
            $salemaker->statusUpdate(
                $_POST['status'],
                $_POST['id'],
                $field = 'sale_status',
                $table = 'salemaker_sales'
            )
        ) {
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

include_once('html-open.php');
include_once('header.php');
include DIR_WS_TABS . "products_discounts.php";
?>
<script>
    var lang =<?php echo $salemaker->getTranslation();?>;
</script>
<div class="container">
    <?php echo $salemaker->getView(); ?>
</div>