<?php
require('includes/application_top.php');

$filename = basename(__FILE__, ".php");

$class = $_GET['info'] ?: 'admin';

if (!empty($_GET['action'])) {
    preg_match('/^([a-z]+)_(.+)/', $_GET['action'], $matches);
    $class = $matches[2];
}
if (!empty($_POST['action'])) {
    preg_match('/^([a-z]+)_(.+)/', $_POST['action'], $matches);
    $class = $matches[2];
}

$class_path = 'admin\includes\solomono\app\models' . '\\' . $filename . '\\' . $class;

$obg = new $class_path;

if (isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show') {
    $obg->query($_GET);
    echo json_encode($obg->data);
    exit;
}


if ($obg->isAjax()) {

    $action = $_GET['action'];
    switch ($action) {
        case "add_admin_files":
            $obg->getGroups();
            $html = $obg->getView("admin_members/add_file");
            echo json_encode(array('html'  => $html,
                                   'title' => 'Добавить файл'
            ));
            exit;
            break;
        case "addconfirm_admin_files":
            if ($obg->insertFile($_POST)) {
                $arr = array(
                    'success' => true,
                    'msg'     => TEXT_SAVE_DATA_OK,
                );
            } else {
                $arr = array(
                    'success' => false,
                    'msg'     => $obg->error
                );
            }
            echo json_encode($arr);
            exit;
            break;
        case "remove_admin_files":
            $html = $obg->getView("admin_members/remove_file");
            echo json_encode(array('html'  => $html,
                                   'title' => 'Удалить файл'
            ));
            exit;
            break;
        case "removeconfirm_admin_files":
            if ($obg->deleteFile($_POST)) {
                $arr = array(
                    'success' => true,
                    'msg'     => TEXT_SAVE_DATA_OK,
                );
            } else {
                $arr = array(
                    'success' => false,
                    'msg'     => $obg->error
                );
            }
            echo json_encode($arr);
            exit;
            break;
        case "changepass_admin":
            $obg->data['id'] = $_SESSION['login_id'];
            $html = $obg->getView("admin_members/change_pass");
            echo json_encode(array('html'  => $html,
                                   'title' => 'Change Password'
            ));
            exit;
            break;
        case "changepassconfirm_admin":
            if ($obg->updatePassword($_POST)) {
                 $arr = array(
                    'success' => true,
                    'msg'     => TEXT_SAVE_DATA_OK,
                );
            } else {
                $arr = array(
                    'success' => false,
                    'msg'     => $obg->error
                );
            }
            echo json_encode($arr);
            exit;
            break;
        case "new_$class":
            $html = $obg->getView("/form");
            echo json_encode(array('html' => $html));
            exit;
            break;
        case "edit_admin_groups":
            $id = $_GET['id'];
            $obg->selectOne($id);
            $html = $obg->getView("admin_members/form");
            echo json_encode(array('html' => $html));
            exit;
            break;
        case "edit_$class":
            $id = $_GET['id'];
            $obg->selectOne($id);
            $html = $obg->getView("/form");
            echo json_encode(array('html' => $html));
            exit;
            break;
        case "insert_$class":
            if ($obg->insert($_POST)) {
                if ($class == 'admin') {
                    if (checkConst('EMAIL_CONTENT_MODULE_ENABLED') == 'true') {
                        require_once(DIR_FS_EXT . 'email_content/functions.php');
                        $data = [
                            'customers_name' => $_POST['admin_firstname'] . ' ' . $_POST['admin_lastname'],
                            'email_address' => $_POST['admin_email_address'],
                            'password' => $obg->getMakePassword(),
                        ];
                        $content_email_array = getCreateAdminMemberText($languages_id, $data);
                        $email_text = $content_email_array['content_html'] ?: nl2br(sprintf(ADMIN_EMAIL_TEXT, $_POST['admin_firstname'], HTTP_SERVER . DIR_WS_ADMIN, $_POST['admin_email_address'], $obg->getMakePassword(), STORE_OWNER));
                        $subject = $content_email_array['subject'] ?: ADMIN_EMAIL_SUBJECT;
                        tep_mail($data['customers_name'], $data['email_address'], $subject, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
                    } else {
                        tep_mail($_POST['admin_firstname'] . ' ' . $_POST['admin_lastname'], $_POST['admin_email_address'], ADMIN_EMAIL_SUBJECT, nl2br(sprintf(ADMIN_EMAIL_TEXT, $_POST['admin_firstname'], HTTP_SERVER . DIR_WS_ADMIN, $_POST['admin_email_address'], $obg->getMakePassword(), STORE_OWNER)), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
                    }
                }
                $arr = array(
                    'success' => true,
                    'msg'     => TEXT_SAVE_DATA_OK,
                );
            } else {
                $arr = array(
                    'success' => false,
                    'msg'     => $obg->error
                );
            }
            echo json_encode($arr);
            exit;
            break;
        case "update_$class":
            if ($obg->update($_POST)) {
                $arr = array(
                    'success' => true,
                    'msg'     => TEXT_SAVE_DATA_OK,
                );
            } else {
                $arr = array(
                    'success' => false,
                    'msg'     => TEXT_ERROR
                );
            }
            echo json_encode($arr);
            exit;
            break;
    }
    $action = $_POST['action'];
    switch ($action) {
        case "delete_$class":
            if ($obg->delete($_POST['id'])) {
                $arr = array(
                    'success' => true,
                    'msg'     => TEXT_SAVE_DATA_OK
                );
            } else {
                $arr = array(
                    'success' => false,
                    'msg'     => $obg->error?:TEXT_ERROR
                );
            }
            echo json_encode($arr);
            exit;
            break;
    }
}


if ($class == 'admin_files') {
    $admin_group_id = $_GET['admin_groups_id'] ?: 1;
    if (!empty($_POST['id'])) {
        $_POST['admin_groups_id'] = $admin_group_id;
        if ($obg->update($_POST)) {
            $array = array(
                'success' => true,
                'msg'     => TEXT_SAVE_DATA_OK
            );
        } else {
            $array = array(
                'success' => false,
                'msg'     => TEXT_ERROR
            );
        }
        echo json_encode($array);
        exit;
    } else {
        $obg->checkBox($admin_group_id);

    }
}
?>

<?php
include_once('html-open.php');
include_once('header.php');
?>
    <script>
        var lang =<?php echo $obg->getTranslation();?>;
        $(document).ready(function () {

            $('#add_file').on('click', function (e) {
                e.preventDefault();
                $.get($(this).attr('href'), function (response) {
                    modal({
                        title: response.title,
                        body: response.html,
                        after: function (modal) {
                            var form = $(modal).find('form');
                            form.on('click', 'input[type="submit"]', function (e) {
                                var id = form.find('input[name="id"]').val();
                                e.preventDefault();
                                var formData = new FormData(form.get(0));
                                $.ajax({
                                    url: form.attr('action'),
                                    type: form.attr('method'),
                                    dataType: 'json',
                                    data: formData,
                                    contentType: false,
                                    processData: false,
                                    success: function (response) {
                                        $(modal).modal('hide');
                                        show_tooltip(response['msg'], 9999999,$('body'),true);
                                    }
                                });
                            })
                        }
                    })
                }, "json");
            });
            $('#remove_file').on('click', function (e) {
                e.preventDefault();
                $.get($(this).attr('href'), function (response) {
                    modal({
                        title: response.title,
                        body: response.html,
                        after: function (modal) {
                            var form = $(modal).find('form');
                            form.on('click', 'input[type="submit"]', function (e) {
                                var id = form.find('input[name="id"]').val();
                                e.preventDefault();
                                var formData = new FormData(form.get(0));
                                $.ajax({
                                    url: form.attr('action'),
                                    type: form.attr('method'),
                                    dataType: 'json',
                                    data: formData,
                                    contentType: false,
                                    processData: false,
                                    success: function (response) {
                                        $(modal).modal('hide');
                                        show_tooltip(response['msg'], 9999999,$('body'),true);
                                    }
                                });
                            })
                        }
                    })
                }, "json");
            });
        })
    </script>
    <div class="container-fluid admin_members">
        <div class="nav_table">
            <a href="<?php echo  ($_SERVER['SCRIPT_URL']?:$_SERVER['SCRIPT_NAME']) . '?info=admin' ?>" class="<?php echo  ($class == 'admin' or !isset($_GET['info'])) ? 'active' : ''; ?> link link-noactive">
                <?php echo TEXT_ADMIN_LIST . " " . renderTooltip(TOOLTIP_ADMINISTRATORS)?>
            </a>
            <a href="<?php echo  ($_SERVER['SCRIPT_URL']?:$_SERVER['SCRIPT_NAME']) . '?info=admin_groups' ?>" class="<?php echo  ($class == 'admin_groups') ? 'active' : ''; ?> link"><?php echo TEXT_ADMIN_GROUPS  . " " . renderTooltip(TOOLTIP_ADMINISTRATORS_GROUPS)?></a>
            <a href="<?php echo  ($_SERVER['SCRIPT_URL']?:$_SERVER['SCRIPT_NAME']) . '?info=admin_files' ?>" class="<?php echo  ($class == 'admin_files') ? 'active' : ''; ?> link link-noactive">
                <?php echo TEXT_ADMIN_ACCESS  . " " . renderTooltip(TOOLTIP_ADMINISTRATORS_ACCESS_RIGHTS)?>
            </a>
        </div>
        <?php  echo $obg->getView(); ?>
    </div>

<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
<?php if (isset($obg->error)): ?>

<?php endif; ?>