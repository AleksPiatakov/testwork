<?php

require_once 'solomono/app/models/seoTemplates/seoTemplates.php';

if (!($lng instanceof language)) {
    $lng = new language();
    $lng->set_language($_SESSION['languages_code']);
}

if (isset($_GET['info']) && !empty($_GET['info'])) {
    $info = $_GET['info'];
} else {
    $info = seoTemplates::MAIN_PAGE;
}

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

$filename = 'seoTemplates';

$seo_templates = new seoTemplates($info, $cat_list);

if (isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show') {
    $seo_templates->query($_GET);
    echo json_encode($seo_templates->data);
    exit;
}

if ($seo_templates->isAjax()) {
    $action = $_GET['action'];
    switch ($action) {
        case "edit_$filename":
        case "new_$filename":
            if ($action == "new_$filename") {
                $seo_templates->data['allowed_fields']['sort_order']['value'] = 1;
            }

            $id = $_GET['id'] ? $_GET['id'] : false;
            $seo_templates->selectOne($id);
            $categories_arr = $seo_templates->setTree();
            $selected_manufacturers = $seo_categories = explode(',', $seo_templates->data['data']['include_ids']);
            $seo_templates->data['option']['seo_categories_selected'] = getTreeOption(
                $categories_arr,
                0,
                $seo_categories
            );
            $seo_templates->data['option']['seo_manufacturers_selected'] = getTreeOption(
                $seo_templates->getManufacturers(),
                0,
                $selected_manufacturers
            );
            $seo_templates->data['descriptions'] = $seo_templates->getDescriptions($id);
            $seo_templates->data['languages'] = $lng;
            $seo_templates->data['info'] = $info;
            $html = $seo_templates->getView("../../../../../ext/seo_templates/admin/solomono/app/view/seoTemplates/form");
            echo json_encode(['html' => $html]);
            exit;
            break;
        case "insert_$filename":
            $result = $seo_templates->insert($_POST);
            if ($result) {
                $arr = [
                    'success' => true,
                    'id' => $result,
                    'msg' => TEXT_SAVE_DATA_OK,
                ];
            } else {
                $arr = [
                    'success' => false,
                    'msg' => TEXT_ERROR
                ];
            }
            echo json_encode($arr);
            exit;
            break;
        case "update_$filename":
            if ($seo_templates->update($_POST)) {
                $arr = [
                    'success' => true,
                    'msg' => TEXT_SAVE_DATA_OK,
                ];
            } else {
                $arr = [
                    'success' => false,
                    'msg' => TEXT_ERROR
                ];
            }
            echo json_encode($arr);
            exit;
            break;
        case 'translate':
            /*id language*/
            $from = $_GET['from'] ?: 1;
            $to = $_GET['to'] ?: 3;

            $arr = $seo_templates->yandexTranslate($_POST, $from, $to);
            echo json_encode($arr);
            exit;
            break;
    }
    $action = $_POST['action'];
    switch ($action) {
        case "delete_$filename":
            if ($seo_templates->delete($_POST['id'])) {
                $arr = [
                    'success' => true,
                    'msg' => TEXT_SAVE_DATA_OK
                ];
            } else {
                $arr = [
                    'success' => false,
                    'msg' => TEXT_ERROR
                ];
            }
            echo json_encode($arr);
            exit;
            break;
    }

    if (isset($_POST['status'])) {
        if ($seo_templates->statusUpdate($_POST['status'], $_POST['id'], $field = 'status', $table = 'seo_templates')) {
            $array = [
                'success' => true,
                'msg' => TEXT_SAVE_DATA_OK,
            ];
        } else {
            $array = [
                'success' => false,
                'msg' => TEXT_ERROR
            ];
        }
        echo json_encode($array);
        exit;
    }
}

include_once('html-open.php');
include_once('header.php');
$tabs = [
    seoTemplates::MAIN_PAGE => META_TAGS_MAINPAGE_TITLE_SEO,
    seoTemplates::PRODUCT => META_TAGS_PRODUCT_TITLE_SEO,
    seoTemplates::CATEGORY => META_TAGS_CATEGORY_TITLE_SEO,
    seoTemplates::MANUFACTURER => META_TAGS_MANUFACTURER_TITLE_SEO,
    seoTemplates::SEARCH => META_TAGS_SEARCH_TITLE_SEO,
]; ?>
    <div class="container">
        <h1 class="m-n font-thin h3"><?php echo HEADING_TITLE; ?></h1>
        <div class="nav_table">
            <?php foreach ($tabs as $page => $pageTranslate) { ?>
                <a data-template="<?= $page ?>" href="?info=<?= $page ?>"
                   class="<?= $page === $info ? 'active' : '' ?> link ">
                    <?= $pageTranslate ?>
                </a>
            <?php } ?>
        </div>
        <script>
            var lang =<?php echo $seo_templates->getTranslation();?>;
            lang.currentPage.HEADING_TITLE = lang.currentPage.HEADING_TITLE + ' <?= mb_strtolower($tabs[$info]) ?>'
        </script>
        <div class="container seo_templates_container">
            <?php echo $seo_templates->getView("../../../../../ext/seo_templates/admin/solomono/app/view/seoTemplates/default"); ?>
        </div>
    </div>
    <script>
        function copyToContext(copyText) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(copyText).select();
            document.execCommand("copy");
            $temp.remove();
            show_tooltip("<?= TOOLTIP_TEXT_COPIED ?>:\n\r " + copyText, 2000, $('body'), false);
        }
    </script>
<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>