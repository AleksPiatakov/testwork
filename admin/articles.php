<?php

require('includes/application_top.php');
require('includes/functions/newsdesk_general.php');
use admin\includes\solomono\app\models\articles\articles;
use admin\includes\solomono\app\models\articles\topics;

$allowed_image_types = ['image/jpeg','image/gif','image/png','image/webp'];
function getTree1($arr) {
	static $show;
	foreach ($arr as $key=>$value) {
		$show.='<li data-topic="' . $value['id'] . '"><span class="settings_cat"><svg width="16px" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><g class="fa-group"><path fill="rgba(73, 80, 86, 0.3)" d="M487.75 315.6l-42.6-24.6a192.62 192.62 0 0 0 0-70.2l42.6-24.6a12.11 12.11 0 0 0 5.5-14 249.2 249.2 0 0 0-54.7-94.6 12 12 0 0 0-14.8-2.3l-42.6 24.6a188.83 188.83 0 0 0-60.8-35.1V25.7A12 12 0 0 0 311 14a251.43 251.43 0 0 0-109.2 0 12 12 0 0 0-9.4 11.7v49.2a194.59 194.59 0 0 0-60.8 35.1L89.05 85.4a11.88 11.88 0 0 0-14.8 2.3 247.66 247.66 0 0 0-54.7 94.6 12 12 0 0 0 5.5 14l42.6 24.6a192.62 192.62 0 0 0 0 70.2l-42.6 24.6a12.08 12.08 0 0 0-5.5 14 249 249 0 0 0 54.7 94.6 12 12 0 0 0 14.8 2.3l42.6-24.6a188.54 188.54 0 0 0 60.8 35.1v49.2a12 12 0 0 0 9.4 11.7 251.43 251.43 0 0 0 109.2 0 12 12 0 0 0 9.4-11.7v-49.2a194.7 194.7 0 0 0 60.8-35.1l42.6 24.6a11.89 11.89 0 0 0 14.8-2.3 247.52 247.52 0 0 0 54.7-94.6 12.36 12.36 0 0 0-5.6-14.1zm-231.4 36.2a95.9 95.9 0 1 1 95.9-95.9 95.89 95.89 0 0 1-95.9 95.9z" class="fa-secondary"></path><path fill="currentColor" d="M256.35 319.8a63.9 63.9 0 1 1 63.9-63.9 63.9 63.9 0 0 1-63.9 63.9z" class="fa-primary"></path></g></svg></span><a href="' . $_SERVER['PHP_SELF'] . '?tPath=' . $value['id'] . '">' . $value['topics_name'] . '</a>';
		if (isset($value['childs'])) {
			$show.='<span class="badge"><i class="fa fa-folder fa-fw" aria-hidden="true"></i>' . count($value['childs']) . '</span><ul>';
			getTree($value['childs']);
			$show.='</ul>';
		}
		$show.='</li>';
	}
	return $show;
}
function getTree($arr) {
	static $show;
	foreach ($arr as $key=>$value) {
		$show.='<li data-topic="' . $value['id'] . '"><span class="settings_cat"><svg width="16px" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><g class="fa-group"><path fill="rgba(73, 80, 86, 0.3)" d="M487.75 315.6l-42.6-24.6a192.62 192.62 0 0 0 0-70.2l42.6-24.6a12.11 12.11 0 0 0 5.5-14 249.2 249.2 0 0 0-54.7-94.6 12 12 0 0 0-14.8-2.3l-42.6 24.6a188.83 188.83 0 0 0-60.8-35.1V25.7A12 12 0 0 0 311 14a251.43 251.43 0 0 0-109.2 0 12 12 0 0 0-9.4 11.7v49.2a194.59 194.59 0 0 0-60.8 35.1L89.05 85.4a11.88 11.88 0 0 0-14.8 2.3 247.66 247.66 0 0 0-54.7 94.6 12 12 0 0 0 5.5 14l42.6 24.6a192.62 192.62 0 0 0 0 70.2l-42.6 24.6a12.08 12.08 0 0 0-5.5 14 249 249 0 0 0 54.7 94.6 12 12 0 0 0 14.8 2.3l42.6-24.6a188.54 188.54 0 0 0 60.8 35.1v49.2a12 12 0 0 0 9.4 11.7 251.43 251.43 0 0 0 109.2 0 12 12 0 0 0 9.4-11.7v-49.2a194.7 194.7 0 0 0 60.8-35.1l42.6 24.6a11.89 11.89 0 0 0 14.8-2.3 247.52 247.52 0 0 0 54.7-94.6 12.36 12.36 0 0 0-5.6-14.1zm-231.4 36.2a95.9 95.9 0 1 1 95.9-95.9 95.89 95.89 0 0 1-95.9 95.9z" class="fa-secondary"></path><path fill="currentColor" d="M256.35 319.8a63.9 63.9 0 1 1 63.9-63.9 63.9 63.9 0 0 1-63.9 63.9z" class="fa-primary"></path></g></svg></span><span class="item"><a href="' . $_SERVER['PHP_SELF'] . '?tPath=' . $value['id'] . '"><span class="topic_ttl">' . $value['topics_name'] . '</span>';
		$show .= (isset($value['childs'])) ? ' <span class="badge"><i class="fa fa-folder fa-fw" aria-hidden="true"></i>' . count($value['childs']) . '</span></a></span>' : '</a></span>';
		if (isset($value['childs'])) {
			$show.='<ul>';
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
                $str.='→';
            }
            $i++;

            echo getTreeOption($value['childs'], $str, $find);
            $str='';
        }
    }

}

$topics=new topics();
$articles=new articles();

if (isset($_GET['ajax_load']) && $_GET['ajax_load']=='show') {
    $articles->query($_GET);
    $articles->data['allowed_fields']['sort_order']['class'] = "align_center";
    echo json_encode($articles->data);
    exit;
}

if ($articles->isAjax()) {

    $action=$_POST['action'] ? : $_GET['action'];
    switch ($action) {
        case 'topic':
            //if isset $_GET['tPath'] =get data in form else new form without id
            $id=$_GET['tPath'] ? $_GET['tPath'] : false;
            $topics->getDescription($id);
            $html=$topics->getView('articles/formLang');
            echo json_encode(array('html'=>$html));
            exit;
            break;
        case 'update_topics_description':
            if ($topics->update($_POST)) {
                $get_topics=$topics->setTree();
                $categories=getTree($get_topics);
                $arr=array(
                    'success'=>true,
                    'html'=>$categories,
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
        case 'insert_topics_description':
            if ($topics->insert($_POST)) {
                $get_topics=$topics->setTree();
                $categories=getTree($get_topics);
                $arr=array(
                    'success'=>true,
                    'html'=>$categories,
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
        case 'delete_topic':
            $cntSubCatArticles=$topics->cntSubCat($_POST['tPath']);
            $text=sprintf(TEXT_COUNT_SURE_DELL, count($cntSubCatArticles['categories']), count($cntSubCatArticles['articles']));
            $html='<div class="row">
                            <div class="col-sm-12">
                                <p>'.$text.'</p>
                            </div>
                            <div class="col-sm-12">
                                  <input type="submit" value="OK" class="btn">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">' . TEXT_MODAL_CANCEL_ACTION . '</button>
                            </div>
                     </div>';

            $arr=array(
                'title'=>TEXT_CONFIRM,
                'html'=>$html
            );
            echo json_encode($arr);
            exit;
            break;
        case 'confirm_delete_topic':
            $topics->confirmDelete($_POST['tPath']);
            $arr=array(
                'success'=>true,
            );
            echo json_encode($arr);
            exit;
            break;
        case 'move_topic':
            if (isset($_POST['topicId']) && isset($_POST['moveTo'])) {
                if ($topics->moveTo($_POST['topicId'], $_POST['moveTo'])) {
                    $get_topics=$topics->setTree();
                    $categories=getTree($get_topics);
                    $arr=array(
                        'success'=>true,
                        'html'=>$categories,
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
            }else {
                $get_topics=$topics->setTree();
                $textParent = defined('TEXT_PARENT') ? TEXT_PARENT : '';
                ob_start();
                echo '<div class="chose-cat"><i class="fa fa-fw fa-arrow-circle-left" aria-hidden="true"></i><select class="form-control"><option disabled value="" selected>'.TEXT_CHOOSE_CATEGORY.'</option><option value="0">' . $textParent . '</option>';
                getTreeOption($get_topics);
                echo '</select><div class="list-action">
                  <i class="fa fa-check-circle fa-lg" aria-hidden="true"></i></div>';
                $content=ob_get_clean();
                $arr=array(
                    'html'=>$content,
                );
                echo json_encode($arr);
                exit;
            }
            break;
        case 'edit_articles':
        case 'new_articles':
            $id=$_GET['id'] ? $_GET['id'] : false;
            $articles->selectOne($id);
            $tPath = $_GET['tPath'] ? $_GET['tPath'] : ($articles->data['tPath'] ? : false);
            $get_topics=$topics->setTree();
            ob_start();
            getTreeOption($get_topics, '', $tPath);
            $categories=ob_get_clean();
            $articles->data['category']=$categories;
            $articles->data['tPath']=$tPath;
            $html=$articles->getView('articles/formLang');
            echo json_encode(array('html'=>$html));
            exit;
            break;
        case 'update_articles':
            if (!empty($_POST['id'])) {
                $articles->checkFile('articles_image', $_POST['id'],null,$allowed_image_types);
                $articles->checkFile('articles_image_mobile', $_POST['id'],null,$allowed_image_types);
                if ($articles->update($_POST)) {
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
        case 'insert_articles':
            $articles->checkFile('articles_image',null,null,$allowed_image_types);
            $insert_result = $articles->insert($_POST);
            if ($insert_result['success']) {
                $arr=array(
                    'success'=>true,
                    'id'=>$insert_result['id'],
                    'reload'=>true,
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
        case 'copy_articles':
            $get_topics=$topics->setTree();
            $tPath=$_GET['tPath'] ? $_GET['tPath'] : 0;
            ob_start();
            getTreeOption($get_topics, '', $tPath);
            $categories=ob_get_clean();
            $articles->data['category']=$categories;
            $articles->data['current_category']=$tPath;
            $html=$articles->getView('articles/move_articles');
            echo json_encode(array('html'=>$html));
            exit;
            break;
        case 'move_articles':
            $arr=array();
            if ($_POST['copy_as']=='link') {
                if ($_POST['topics_id']!=$_POST['current_topic'] || $_POST['current_topic']==0) {
                    $articles->link($_POST);
                }else {
                    $msg=ERROR_CANNOT_LINK_TO_SAME_TOPIC;
                    $result=false;
                }
            }elseif ($_POST['copy_as']=='duplicate') {
                $articles->duplicate($_POST);
            } else if($_POST['copy_as']=='move') {
                $articles->move($_POST);
            }
            $arr=array(
                'success'=>$result ? : true,
                'msg'=>$msg ? : TEXT_SAVE_DATA_OK,
            );
            echo json_encode($arr);
            exit;
            break;
        case 'delete_articles':
            if ($articles->deleteArticle($_POST['id'],$_POST['tPath']?:false)) {
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
        case 'getProduct':
            $arr=$articles->getProduct($_GET['search']);
            echo json_encode($arr);
            exit;
            break;
        case 'addProduct':
            $arr['success']=false;
            $arr['msg']=TEXT_ERROR . ".Create first articles";
            if (!empty($_POST['productId']) and !empty($_POST['articlesId'])) {
                $arr['success']=$articles->addProduct($_POST['productId'], $_POST['articlesId']);
                $arr['msg']=TEXT_SAVE_DATA_OK;
            }
            echo json_encode($arr);
            exit;
            break;
        case 'delete_xselId':
            $arr['success']=$articles->delXsell($_POST['articlesId'], $_POST['xsellId']);
            echo json_encode($arr);
            exit;
            break;
        case 'delete_image':
            $articles->delFile($_POST['ID'], $_POST['field_name'], 'articles');
            $sql = ("UPDATE articles SET {$_POST['field_name']}='' WHERE articles_id='{$_POST['ID']}'");
            tep_db_query($sql);
            echo json_encode(true);
            exit;
            break;
    }
    if (isset($_POST['status'])) {
        if ($articles->statusUpdate($_POST['status'], $_POST['id'], 'articles_status')) {
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


$get_topics=$topics->setTree();
$categories=getTree($get_topics);

include_once('html-open.php');
include_once('header.php');


?>
<script>
    var lang =<?php echo $articles->getTranslation();?>;
</script>
<div class="hbox hbox-auto-xs hbox-auto-sm">
    <div class="col w-lg bg-light dk b-r bg-auto" id="aside">
        <div class="wrapper bg">
            <h3 class="m-n font-thin">
                <?php echo HEADING_CATEGORY;?>
            </h3>
            <svg class="plus fa-plus-circle new_article_button" width="44px"  role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="#18bf49" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm144 276c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92h-92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z" class=""></path>
            </svg>
        </div>
        <div class="wrapper no_padding">
            <ul id="topics">
                <li>
                    <a data-topic="all" href="<?php echo $_SERVER['PHP_SELF']?>"><?php echo TEXT_ALL?></a>
                </li>
                <?php echo $categories;?>
            </ul>
        </div>
    </div>
    <div class="col">
        <div class="wrapper wrapper_767">
            <?php echo $articles->getView();?>
        </div>
    </div>
</div>

<?php include_once('footer.php');?>
<?php
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>