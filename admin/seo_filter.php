<?php

require('includes/application_top.php');
use admin\includes\solomono\app\models\seo_filter\seo_filter;

function getTree($arr) {
    static $show;
    foreach ($arr as $key=>$value) {
        $show.='<li data-topic="' . $value['id'] . '"><span class="settings_cat"><i class="fa fa-cog fa-fw" aria-hidden="true"></i></span><a href="' . $_SERVER['PHP_SELF'] . '?tPath=' . $value['id'] . '">' . $value['topics_name'] . '</a>';
        if (isset($value['childs'])) {
            $show.='<span class="badge"><i class="fa fa-folder fa-fw" aria-hidden="true"></i>' . count($value['childs']) . '</span><ul>';
            getTree($value['childs']);
            $show.='</ul>';
        }
        $show.='</li>';
    }

    return $show;
}

function getTreeOption($arr, $str='', $find=false) {
    foreach ($arr as $key=>$value) {
        if ($value['parent']!=0) {

            echo '<option value="' . $value['id'] . '">' . $value['topics_name'] . '</option>';
        }else {
            $select=$find==$value['id'] ? 'selected' : '';
            echo '<option ' . $select . ' value="' . $value['id'] . '">' . $str . ' ' . $value['topics_name'] . '</option>';
        }
        if (isset($value['childs'])) {
            $i=1;
            for ($j=0; $j < $i; $j++) {
                $str.='?';
            }
            $i++;

            echo getTreeOption($value['childs'], $str, $find);
            $str='';
        }
    }

}

$seo_filter=new seo_filter();

$categories    = $seo_filter->getCategoriesNames();
$filters       = $seo_filter->getFiltersNames();
$manufacturers = $seo_filter->getManufacturersNames();
$options       = $seo_filter->getFiltersOptionsName();
$optionsToFilters = $seo_filter->getOptionsToFilters();


if (isset($_GET['ajax_load']) && $_GET['ajax_load']=='show') {
    $seo_filter->query($_GET);

    /**
     * Add manufacturers, categories and filters names to data array
     */
    foreach ($seo_filter->data["data"] as $k => &$v) {
        if(!empty($manufacturers[$v["manufacturers_id"]])) {
            $v["manufacturers_name"] = $manufacturers[$v["manufacturers_id"]];
        }
        if(!empty($categories[$v["categories_id"]])) {
            $v["categories_name"] = $categories[$v["categories_id"]];
        }
        if(!empty($filters[$v["filter_id_1"]])) {
            $v["filter_1"] = $filters[$v["filter_id_1"]];
        }
        if(!empty($filters[$v["filter_id_2"]])) {
            $v["filter_2"] = $filters[$v["filter_id_2"]];
        }
    }

    echo json_encode($seo_filter->data);
    exit;
}

if ($seo_filter->isAjax()) {

    $action=$_POST['action'] ? : $_GET['action'];
    switch ($action) {
        case 'new_seo_filter':
        case 'edit_seo_filter':

            $id=$_GET['id'] ? $_GET['id'] : false;
            $seo_filter->selectOne($id);

            $seo_filter->data['option']['categories_name']    = $categories;
            $seo_filter->data['option']['manufacturers_name'] = $manufacturers;

            $seo_filter->data['filters']          = $filters;
            $seo_filter->data['options']          = $options;
            $seo_filter->data['optionsToFilters'] = $optionsToFilters;

            $html = $seo_filter->getView('seo_filter/formLang');
            echo json_encode(array('html' => $html));
            exit;
            break;

        case 'update_seo_filter':

            if (!empty($_POST['id'])) {
                if ($seo_filter->update($_POST)) {
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
            }
            break;

        case 'insert_seo_filter':
            $result = $seo_filter->insert($_POST);
            if ($result) {
                $arr=array(
                    'success'=>true,
                    'reload'=>true,
                    'id'=>$result,
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

        case 'delete_seo_filter':
            if ($seo_filter->deleteSeoFilter($_POST['id'])) {
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
}

include_once('html-open.php');
include_once('header.php');


?>
    <script>
        var lang =<?php echo $seo_filter->getTranslation();?>;
    </script>
    <div class="container">
        <?php echo $seo_filter->getView();?>
    </div>
<?php include_once('footer.php');?>
<?php
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>