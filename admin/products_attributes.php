<?php
require('includes/application_top.php');

use admin\includes\solomono\app\models\products_attributes\products_options;
use admin\includes\solomono\app\models\products_attributes\products_options_values;
use admin\includes\solomono\app\models\products_attributes\products_attributes_groups;

$filename = 'products_options';
$products_options = new products_options();
$products_options_values = new products_options_values();
$products_attributes_groups = new products_attributes_groups();
$allowed_image_types = ['image/jpeg','image/gif','image/png','image/webp'];

if ((isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show' && !isset($_GET['info']))) {
    $products_options->query($_GET);
    echo json_encode($products_options->data);
    exit;
}

if($_GET['info']=='attr_options') {
    $html['header'] = $products_options->getView();
    echo json_encode($html);
    exit;
}

if($_GET['info']=='attr_options_value') {
    $html['header'] = $products_options_values->getView();
    echo json_encode($html);
    exit;
}

if($_GET['ajax_load'] == 'attr_options_value'){
    $products_options_values->query($_GET);
    echo json_encode( $products_options_values->data);
    exit;
}


if($_GET['info']=='attr_options_groups') {
    $html['header'] = $products_attributes_groups->getView();
    echo json_encode($html);
    exit;
}

if($_GET['ajax_load'] == 'attr_options_groups'){
    $products_attributes_groups->query($_GET);
    echo json_encode( $products_attributes_groups->data);
    exit;
}

if ($products_options->isAjax()) {
    $action = $_GET['action'];
    switch ($action) {
        case "edit_$filename":
        case "new_$filename":
            $id = $_GET['id'] ? $_GET['id'] : false;
            $products_options->selectOne($id);
            $html = $products_options->getView("products_attributes/formLang");
            echo json_encode(array('html' => $html));

        exit;
            break;

        case "edit_products_options_values":
        case "new_products_options_values":
            $id = $_GET['id'] ? $_GET['id'] : false;
            $products_options_values->addFolder = !empty(getenv('CATALOG_FOLDER')) ? '/'.getenv('CATALOG_FOLDER') : '';
            $products_options_values->selectOne($id);
            $html = $products_options_values->getView("products_attributes/formLang");
            $title = HEADING_TITLE_VAL;
            echo json_encode(array('title' => $title,'html' => $html));

        exit;
            break;
        case "edit_products_attributes_groups":
        case "new_products_attributes_groups":
            $id = $_GET['id'] ? $_GET['id'] : false;
            $products_attributes_groups->selectOne($id);
            $html = $products_attributes_groups->getView("products_attributes/formLang");
            $title = HEADING_TITLE_GROUP;
            echo json_encode(array('title' => $title,'html' => $html));

        exit;
            break;
        case "insert_$filename":
            if ($products_options->insert($_POST)) {
                clearAttrCache();
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
        case "insert_products_options_values":
            $products_options_values->checkFile('products_options_values_image', $_POST['id'], null, $allowed_image_types);
            if ($products_options_values->insert($_POST)) {
                clearAttrCache();
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
        case "insert_products_attributes_groups":
            if ($products_attributes_groups->insert($_POST)) {
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
            if ($products_options->update($_POST)) {
                clearAttrCache();
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
        case "update_products_options_values":
            $products_options_values->checkFile('products_options_values_image', $_POST['id'],null,$allowed_image_types);
            if ($products_options_values->update($_POST)) {
                clearAttrCache();
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
        case "update_products_attributes_groups":
            if ($products_attributes_groups->update($_POST)) {
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
        case "check":
            echo json_encode($products_options->checkDelete($_POST['id']));
            exit;
            break;
        case "delete_$filename":
            if ($products_options->delete($_POST['id'])) {
                clearAttrCache();
                $arr = array(
                    'success' => true,
                    'msg' => TEXT_SAVE_DATA_OK
                );
            } else {
                $arr = array(
                    'success' => false,
                    'msg' =>$products_options->error ?: TEXT_ERROR,
                    'time' => 10000
                );
            }
            echo json_encode($arr);
            exit;
            break;
        case "delete_products_options_values":
            if ($products_options_values->delete($_POST['id'])) {
                clearAttrCache();
                $arr = array(
                    'success' => true,
                    'msg' => TEXT_SAVE_DATA_OK
                );
            } else {
                $arr = array(
                    'success' => false,
                    'msg' => $products_options_values->error ?: TEXT_ERROR,
                    'time' => 10000
                );
            }
            echo json_encode($arr);
            exit;
            break;
        case "delete_products_attributes_groups":
            if ($products_attributes_groups->delete($_POST['id'])) {
                $arr = array(
                    'success' => true,
                    'msg' => TEXT_SAVE_DATA_OK
                );
            } else {
                $arr = array(
                    'success' => false,
                    'msg' => $products_attributes_groups->error ?: TEXT_ERROR,
                    'time' => 10000
                );
            }
            echo json_encode($arr);
            exit;
            break;
        case "get_option_values":
            $status=$products_options_values->query($_POST);
            $products_options_values->select($_POST['id']);
            $content=$products_options_values->getView();
            echo json_encode(array('html'=>$content));
            exit;
            break;
    }
    if(isset($_POST['status']) && !empty($_POST['field'])){
        if($products_options->statusUpdate($_POST['status'],$_POST['id'], $_POST['field'])){
            clearAttrCache();
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

?>

<?php
include_once('html-open.php');
include_once('header.php');
?>
    <script>
        var lang=<?php echo $products_options->getTranslation();?>;
    </script>
    <div class="container">
        <div id="tabs-attr">
            <ul class="nav nav-tabs" id="attributes">
                <li class="active">
                    <a href="?info=attr_options" data-attributes="attr_options"><?php echo HEADING_TITLE_OPT . " " . renderTooltip(TOOLTIP_PRODUCTS_ATTRIBUTES)?></a>
                </li>
                <li class="">
                    <a href="?info=attr_options_value" data-attributes="attr_options_value"><?php echo HEADING_TITLE_VAL . " " . renderTooltip(TOOLTIP_ATTRIBUTES_VALUES)?></a>
                </li>
                <li class="">
                    <a href="?info=attr_options_groups" data-attributes="attr_options_groups"><?php echo HEADING_TITLE_GROUP . " " . renderTooltip(TOOLTIP_ATTRIBUTES_GROUPS) ?></a>
                </li>
            </ul>
        </div>
        <div id="test"  class="products_attributes_id">
            <?php echo $products_options->getView();?>
        </div>
    </div>
    <script>
        $(document).ready(function () {

            option.perPage = 25;

            $('[data-attributes="attr_options"]').on('click', function (e) {
                e.preventDefault();
                opton_pages($(this), "attr_options");
            });

            $('[data-attributes="attr_options_value"]').on('click', function (e) {
                e.preventDefault();
                opton_pages($(this),"attr_options_value");
            });

            $('[data-attributes="attr_options_groups"]').on('click', function (e) {
                e.preventDefault();
                opton_pages($(this), "attr_options_groups");
            });


           $('body').on('click', '.products_options td[data-name="products_options_name"]', function () {
               var $this = $(this);
               $('#attributes').find('li').removeClass('active');
               $('#attributes').find('li:nth-child(2)').addClass('active');
               var url= '?info=attr_options_value';
               delete(option.count);
               delete(option.search);
               delete(option.order);
               option.page = 1;
               option.opt_id = $this.closest('tr').data('id');
               $.ajax({
                   url: url,
                   type: "GET",
                   data:option,
                   dataType: 'json',
                   success: function (response) {
                       $('#test').empty();
                       $('#test').prepend(response['header']);
                       $.ajax({
                           url: url+'&ajax_load=attr_options_value',
                           type: "GET",
                           data:option,
                           dataType: 'json',
                           success: function (response) {
                               if ($('#own_pagination').length != 0) {

                                   renderData('attr_options_value');

                                   $('#own_pagination').pagination('selectPage', option.page);
                               }
                           }
                       });
                   }
               });
            })

            $('body').on('click', 'td[data-name="products_options_values_name"]', function () {
               var $this = $(this);
                $this.attr('data-action','edit_products_options_values');
                $this.addClass('check_options_values')
            });
            $('body').on('click', 'td[data-name="products_options_values_name"]', getForm);


            $('body').on('click', 'td[data-name="products_options_values_name"]', function () {
                $(".modal-dialog").css('max-width: 60%!important;');
            });


        });

        function opton_pages($obj, page_name){
            $obj.parent().parent().find('li').removeClass('active');
            $obj.parent().addClass('active');
            var url= $obj.attr('href');
            delete(option.count);
            delete(option.search);
            delete(option.order);
            delete(option.opt_id);
            option.page = 1;
            $.ajax({
                url: url,
                type: "GET",
                data:option,
                dataType: 'json',
                success: function (response) {
                    $('#test').empty();
                    $('#test').prepend(response['header']);
                    $.ajax({
                        url: url+'&ajax_load='+page_name,
                        type: "GET",
                        data:option,
                        dataType: 'json',
                        success: function (response) {
                            if ($('#own_pagination').length != 0) {
                                renderData(page_name == "attr_options"?'show':page_name);
                                $('#own_pagination').pagination('selectPage', option.page);
                            }
                        }
                    });
                }
            });
        }
    </script>
<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>