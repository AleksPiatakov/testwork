<?php
require('includes/application_top.php');

use admin\includes\solomono\app\models\template_configuration\template;

define('F_SOCIAL_INSTAGRAM_TITLE', 'Instagram');
define('F_SOCIAL_YOUTUBE_TITLE', 'Youtube');
define('F_SOCIAL_FACEBOOK_TITLE', 'Facebook');
define('F_SOCIAL_TELEGRAM_TITLE', 'Telegram');

define('P_SHARE_TWITTER_TITLE', 'Twitter');
define('P_SHARE_VIBER_TITLE', 'Viber');
define('P_SHARE_FACEBOOK_TITLE', 'Facebook');
define('P_SHARE_TELEGRAM_TITLE', 'Telegram');
//refresh templates if it is rent
require('includes/widgets/getCurrentRentPackageTemplates/getCurrentRentPackageTemplates.php');

$template_obg = new template();
$filename = $template_obg->getTableName();
$allowed_image_types = ['image/jpeg', 'image/gif', 'image/png', 'image/webp'];

if (isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show') {
    $template_obg->query($_GET);
    echo json_encode($template_obg->data);
    exit;
}

if ($template_obg->isAjax()) {
    $action = $_GET['action'];
    switch ($action) {
        case "edit_$filename":
        case "new_$filename":
            $id = $_GET['id'] ? $_GET['id'] : false;
            $template_obg->selectOne($id);
            $html = $template_obg->getView("template_configuration/form", $template_obg);
            echo json_encode(array('html' => $html));
            exit;
            break;
        case "copy_$filename":
            $id = $_GET['id'] ? $_GET['id'] : false;
            $html = $template_obg->getView("template_configuration/copy_form", $template_obg);
            echo json_encode(['html' => $html]);
            exit;
            break;
        case "insert_$filename":
            $template_obg->checkFile('manufacturers_image', $_POST['id'], null, $allowed_image_types);
            if ($template_obg->insert($_POST)) {
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
            if ($template_obg->update($_POST)) {
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
        case 'change_slider_width':
            $msg = TEXT_ERROR;
            $result = false;
            if ($template_obg->changeBySelect($_POST)) {
                $msg = TEXT_SAVE_DATA_OK;
                $result = true;
            }
            echo json_encode(['msg' => $msg, 'result' => $result]);
            exit;
            break;
    }
    $action = $_POST['action'];
    switch ($action) {
        case "confirm_copy_template":
            if ($login_id == 1) {
                $id = (int)$_POST['id'];
                $name = tep_db_prepare_input($_POST['new_template_name']);
                if ($template_obg->copyTemplate($id, $name)) {
                    $output = ['msg' => "Template {$name} successfully created!"];
                } else {
                    $output = ['msg' => TEXT_ERROR . '<br /><span style="color:#f00;font-weight: bold">Error: ' . $template_obg->error . '</span>'];

                }
            } else {
                $output = ['msg' => 'Access denied'];

            }
            echo json_encode($output);
            die;
            break;
        case "addModule":
            $post = tep_db_prepare_input($_POST);
            $temp_conf_path = DIR_FS_CATALOG . 'temp/' . time() . '.php';
            $php_arr_base = "<?php\n return {$_POST['infobox_data']};\n";
            //sanitize code
            $php_arr = str_replace([
                'eval',
                'exec',
                'shell_exec',
                'system',
                'die',
                'exit',
                'var_dump',
                'print_r',
                'echo',
                'preg_replace',
                'create_function',
                'include',
                'include_once',
                'require',
                'require_once',
                'popen',
                'pcntl_exec'
            ], '', $php_arr_base);
            if ($php_arr_base !== $php_arr) {
                echo json_encode([
                    'success' => false,
                    'msg' => 'Must be valid array',
                ]);
                die;
            }
            file_put_contents($temp_conf_path, $php_arr);
            $output = shell_exec("php -l $temp_conf_path");
            if (substr($output, 0, 16) == 'No syntax errors') {
                $q = require_once($temp_conf_path);
                $q = serialize($q);
                tep_db_query("INSERT INTO " . TABLE_INFOBOX_CONFIGURATION . " (template_id,infobox_file_name,infobox_define,display_in_column,infobox_data) VALUES ('{$post['template_id']}','{$post['infobox_file_name']}','{$post['infobox_define']}','{$post['display_in_column']}','$q')");
                echo json_encode([
                    'success' => true,
                    'msg' => 'Success',
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'msg' => $output,
                ]);
            }
            unlink($temp_conf_path);
            die;
            break;
        case "changeable_admin":
            $temp_conf_path = DIR_FS_CATALOG . 'temp/' . time() . '.php';
            $php_arr_base = "<?php\n return {$_POST['val']};\n";
            //sanitize code
            $php_arr = str_replace([
                'eval',
                'exec',
                'shell_exec',
                'system',
                'die',
                'exit',
                'var_dump',
                'print_r',
                'echo',
                'preg_replace',
                'create_function',
                'include',
                'include_once',
                'require',
                'require_once',
                'popen',
                'pcntl_exec'
            ], '', $php_arr_base);
            if ($php_arr_base !== $php_arr) {
                echo json_encode([
                    'success' => false,
                    'msg' => 'Must be valid array',
                ]);
                die;
            }
            file_put_contents($temp_conf_path, $php_arr);
//            $output = shell_exec("php -l $temp_conf_path");
//            if (substr($output, 0, 16) != 'No syntax errors') {
//                echo json_encode([
//                    'success' => false,
//                    'msg' => $output,
//                ]);
//            } else {
            $q = require_once($temp_conf_path);
            if (is_array($q)) {
                $_POST['const'] = str_replace('_admintext', '', $_POST['const']);
                $conf_where = " WHERE template_id = " . (int)$_POST['template_id'] . " 
                                                    AND display_in_column = '" . $_POST['module'] . "' 
                                                    AND infobox_define = '" . $_POST['const'] . "'";
                tep_db_query('UPDATE ' . TABLE_INFOBOX_CONFIGURATION . ' SET infobox_data = \'' . serialize($q) . '\'' . $conf_where);

                echo json_encode([
                    'success' => true,
                    'msg' => 'Valid array, saved',
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'msg' => 'Code is not array',
                ]);
            }
//            }
            unlink($temp_conf_path);
            die;
            break;
        case "mainconf_update":
            $temp_conf_path = $template_obg->getConfigPath($_POST['template_id']);
            if ($arr = $template_obg->getConfigArr($temp_conf_path)) {
                $post = $_POST['name'];
                $arr[$post['module'] . '_modules'][$post['const']]['val'] = $post['val'];
                $contents = var_export($arr, true);
                file_put_contents($temp_conf_path, "<?php\n return {$contents};\n ?>");
            };
            echo json_encode([
                'success' => !$template_obg->checkErrors(),
                'msg' => $template_obg->showMsg(),
            ]);
            exit;
            break;
        case "changeable":
//            $temp_conf_path=$template_obg->getConfigPath($_POST['template_id']);
            $post = $_POST['name'];
            $conf_where = " WHERE template_id = " . (int)$_POST['template_id'] . " 
                                                    AND display_in_column = '" . $post['module'] . "' 
                                                    AND infobox_define = '" . $post['const'] . "'";
            $conf = tep_db_fetch_array(tep_db_query("SELECT infobox_data, callback_data FROM " . TABLE_INFOBOX_CONFIGURATION . $conf_where));

            if (isset($conf['infobox_data'])) {
                $arr = unserialize($conf['infobox_data']);
                if (!empty($post['field'])) {
                    $arr[$post['field']]['val'] = $post['val'];
                } else {
                    $arr['val'] = $post['val'];
                }
                tep_db_query('UPDATE ' . TABLE_INFOBOX_CONFIGURATION . ' SET infobox_data = \'' . serialize($arr) . '\'' . $conf_where);
                if ($conf['callback_data'] == 'NEED_MINIFY') {//set MINIFY_CSSJS = 1
                    resetMinifiedFiles();
                }
//                $contents = var_export($arr, true);
                /*                file_put_contents($temp_conf_path, "<?php\n return {$contents};\n ?>");*/
            };
            echo json_encode([
                'success' => !$template_obg->checkErrors(),
                'msg' => $template_obg->showMsg(),
            ]);
            exit;
            break;
        case "infobox_display":
            if ($template_obg->statusUpdate($_POST['status'], $_POST['id'], 'infobox_display', 'infobox_configuration',
                'infobox_id')) {
                if (isset($_POST['callback']) && $_POST['callback'] == 'NEED_MINIFY') {//set MINIFY_CSSJS = 1
                    resetMinifiedFiles();
                }
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
        case "change_color":
            if ($template_obg->statusUpdate($_POST['value'], $_POST['id'], $_POST['name'])) {
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
    if (isset($_POST['include_column_left']) || isset($_POST['slider_width'])) {
        $column = isset($_POST['include_column_left']) ? 'include_column_left' : 'slider_width';
        if ($template_obg->statusUpdate($_POST[$column], $_POST['id'], $column)) {
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
    if (isset($_POST['status'])) {
        if ($template_obg->updateDefault($_POST['id'])) {
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
?>

<?php
include_once('html-open.php');
include_once('header.php');
?>
    <script>
        var lang =<?php echo $template_obg->getTranslation();?>;
        var table_option =<?php echo $template_obg->sliderOption();?>;
    </script>
    <div class="container">
        <?php echo $template_obg->getView(); ?>
    </div>
    <script>
        $(document).ready(function () {
            $('body').on('click', 'td[data-name="slider_width"] span', function () {
                var id = $(this).closest('tr').data('id');
                var name = $(this).closest('td').data('name');
                tableOption.call($(this), {arr: table_option, name: name, id: id});
            });

            $('#own_table').on('click', '.change input.color', function (e) {
                var $this = $(this);

                e.preventDefault();
                $this.ColorPicker({
                    onBeforeShow: function () {
                        $(this).ColorPickerSetColor(this.value);
                    },
                    onShow: function (colpkr) {
                        $(colpkr).fadeIn(500);
                        return false;
                    },
                    onHide: function (colpkr) {
                        $(colpkr).fadeOut(500);
                        var data = {
                            action: 'change_' + $this.attr('class'),
                            name: $this.attr('name'),
                            value: $this.val(),
                            id: $this.closest('tr').data('id')
                        };
                        $.ajax({
                            url: window.location.pathname,
                            type: 'POST',
                            dataType: 'json',
                            data: data,
                            success: function (response) {
                                if (response.success == false) {

                                }
                            }
                        });
                        return false;
                    },
                    onChange: function (hsb, hex, rgb) {
                        $this.val('#' + hex);
                    }
                });
                $this.click();
            });
        });
    </script>
<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>