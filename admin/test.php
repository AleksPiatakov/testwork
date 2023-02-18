<?php
require('includes/application_top.php');

preg_match('/([a-z_]+)\.php/', $_SERVER['SCRIPT_NAME'], $matches);
// папка
$folderPath = $matches[1];
$allowed_image_types = ['image/jpeg','image/gif','image/png','image/webp'];
// класс по дефолту если нет гет параметра
$action = $_GET['action'] ?: $folderPath;

$class_path = CLASS_PATH . '\\' . $folderPath . '\\' . $action;

$obg = new $class_path;
if (isset($_POST['id']) && empty($_POST['id']) && !empty($_GET['new'])) {
    unset($_POST['id']);
    if (!empty($_FILES['manufacturers_image']['name']) && in_array($_FILES['manufacturers_image']['type'],$allowed_image_types)) {
        if ($obg->uploadFile()) {
            $_POST['manufacturers_image'] = $action . '/' . $_FILES['manufacturers_image']['name'];
        } else {
            debug($obg->error);
            exit;
        }
    }
    if ($obg->insert($_POST)) {
        tep_redirect(($_SERVER['SCRIPT_URL']?:$_SERVER['SCRIPT_NAME']) . '?action=' . $action);
    } else {
        debug($obg->error);
        exit;
    }
} elseif (!empty($_POST['id'])) {
    if (!empty($_FILES['manufacturers_image']['name']) && in_array($_FILES['manufacturers_image']['type'],$allowed_image_types)) {
        $obg->delFile($_POST['id'], 'manufacturers_image');
        if ($obg->uploadFile()) {
            $_POST['manufacturers_image'] = $action . '/' . $_FILES['manufacturers_image']['name'];
        } else {
            debug($obg->error);
            exit;
        }
    }
    if ($obg->update($_POST)) {
        $array = array(
            'success' => true,
            'msg' => 'Данные успешно изменены',
            'data' => $obg->data['data'][0],
        );
    } else {
        $array = array(
            'success' => false,
            'msg' => 'Возникла ошибка'
        );
    }
    echo json_encode($array);
    exit;
} elseif (!empty($_GET['del'])) {
    $obg->delFile($_GET['del'], 'manufacturers_image');
    if ($obg->delete($_GET['del'])) {
        $array = array(
            'success' => true,
            'msg' => 'Запись успешно удалена'
        );
    } else {
        $array = array(
            'success' => false,
            'msg' => 'Возникла ошибка'
        );
    }
    echo json_encode($array);
    exit;
} elseif (!empty($_GET['ajax']) && $_GET['ajax'] = true) {
    $obg->select();
    $array = array(
        'success' => true,
        'msg' => 'Данные успешно изменены',
        'data' => $obg->data['data'],
    );
    echo json_encode($array);
    exit;
} else {
    $obg->select();
}

?>

<?php
include_once('html-open.php');
include_once('header.php');
?>
    <div class="container">
        <?php $obg->getView(); ?>
    </div>
    <script>
        $(document).ready(function () {
            $('#own_table').DataTable({
//                "columnDefs": [{
//                    "targets": [1, 3, 4],
//                    "orderable": false
//                }],
                language: {
                    url: "/<?= $admin?>/includes/languages/datatables/<?php echo $language ?>.json"
                }
            });
        });
    </script>
<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>