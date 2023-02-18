<?php

/*
  $Id: languages.php,v 1.2 2003/09/24 15:18:15 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

require_once('includes/application_top.php');

use App\Classes\Filesystem\Filesystem;

$filesystem = new Filesystem();
$action = (isset($_GET['action']) ? $_GET['action'] : '');

if (tep_not_null($action)) {
    switch ($action) {

        case 'deleteconfirm':

            $lID=$_POST['lID'];

            $lng_query=tep_db_query("select languages_id from " . TABLE_LANGUAGES . " where code = '" . DEFAULT_CURRENCY . "'");
            $lng=tep_db_fetch_array($lng_query);

            $directory_query=tep_db_query("select directory from " . TABLE_LANGUAGES . " where languages_id = '" . $lID . "'");
            $directory = tep_db_fetch_array($directory_query);

            if ($lng['languages_id']==$lID) {
                tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '' where configuration_key = 'DEFAULT_CURRENCY'");
            }

            tep_db_query("delete from " . TABLE_CATEGORIES_DESCRIPTION . " where language_id = '" . (int)$lID . "'");
            tep_db_query("delete from " . TABLE_PRODUCTS_DESCRIPTION . " where language_id = '" . (int)$lID . "'");
            tep_db_query("delete from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . (int)$lID . "'");
            tep_db_query("delete from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where language_id = '" . (int)$lID . "'");
            tep_db_query("delete from " . TABLE_MANUFACTURERS_INFO . " where languages_id = '" . (int)$lID . "'");
            tep_db_query("delete from " . TABLE_ORDERS_STATUS . " where language_id = '" . (int)$lID . "'");
            tep_db_query("delete from " . TABLE_LANGUAGES . " where languages_id = '" . (int)$lID . "'");
            tep_db_query("delete from " . TABLE_ARTICLES_DESCRIPTION . " where language_id = '" . (int)$lID . "'");
            tep_db_query("delete from " . TABLE_TOPICS_DESCRIPTION . " where language_id = '" . (int)$lID . "'");
            tep_db_query("delete from " . TABLE_PHESIS_POLL_DATA . " where language_id = '" . (int)$lID . "'");

            if(!empty($directory['directory'])){
                $filesystem->delete(DIR_ROOT . DS . DIR_WS_LANGUAGES . $directory['directory'] . '.json');
                $filesystem->delete(DIR_ROOT . DS . 'admin/' . DIR_WS_LANGUAGES . $directory['directory'] . '.php');
                // Del language files in ext modules
                $extDirectory = new \RecursiveDirectoryIterator(DIR_FS_EXT);
                $extIterator = new \RecursiveIteratorIterator($extDirectory);
                foreach ($extIterator as $extInfo) {
                    $extPathInfo = $extInfo->getPathInfo();
                    if ($extPathInfo->getFilename() === 'languages') {
                        $LanguageDirectory = $extPathInfo->getPathName() . DS . $directory['directory'];
                        $filesystem->deleteDirectory($LanguageDirectory);
                    }
                }
                // Del language files in includes modules
                $extDirectory = new \RecursiveDirectoryIterator(DIR_ROOT . DS . DIR_WS_INCLUDES);
                $extIterator = new \RecursiveIteratorIterator($extDirectory);
                foreach ($extIterator as $extInfo) {
                    $extPathInfo = $extInfo->getPathInfo();
                    if ($extPathInfo->getFilename() === 'languages') {
                        $LanguageDirectory = $extPathInfo->getPathName() . DS . $directory['directory'];
                        $filesystem->deleteDirectory($LanguageDirectory);
                    }
                }
                // Del language files in admin includes modules
                $extDirectory = new \RecursiveDirectoryIterator(DIR_ROOT . DS . 'admin/' . DIR_WS_INCLUDES);
                $extIterator = new \RecursiveIteratorIterator($extDirectory);
                foreach ($extIterator as $extInfo) {
                    $extPathInfo = $extInfo->getPathInfo();
                    if ($extPathInfo->getFilename() === 'languages') {
                        $LanguageDirectory = $extPathInfo->getPathName() . DS . $directory['directory'];
                        $filesystem->deleteDirectory($LanguageDirectory);
                    }
                }
            }

            print json_encode(array(
                'updated_panel'=>get_languages_page_panel_html(),
                'modal'=>array(
                    'hide',
                ),
            ));
            exit;

        case 'delete':

            $lID=(int)$_GET['lID'];

            $lng_query=tep_db_query("select * from " . TABLE_LANGUAGES . " where languages_id = " . $lID);
            $lng=tep_db_fetch_array($lng_query);
            $lInfo=new objectInfo($lng);

            $remove_language=true;
            if ($lng['code']==DEFAULT_LANGUAGE) {
                $remove_language=false;
                $messageStack->add(ERROR_REMOVE_DEFAULT_LANGUAGE, 'error');
            }

            ?>

            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="<?php echo defined('TEXT_CLOSE_BUTTON') ? TEXT_CLOSE_BUTTON : "TEXT_CLOSE_BUTTON"; ?>">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="editModalLabel"><?php print !empty($lInfo->name) ? $lInfo->name : HEADING_TITLE; ?></h4>
                </div>

                <div class="modal-body">
                    <?php if ($remove_language) { ?>

                        <?php print tep_draw_form('languages', FILENAME_LANGUAGES, 'page=' . $_GET['page'] . '&action=deleteconfirm'); ?>
                        <input type="hidden" name="lID" value="<?php print $lID; ?>">
                        <p class="text-center m-b-none"><?php print TEXT_INFO_DELETE_INTRO ?></p>
                        </form>

                        <?php
                    }else {
                        ?>
                        <div class="alert alert-danger alert-dismissable m-b-none" type="danger">
                            <div>
                                <span class="ng-binding ng-scope"></span><?php print ERROR_REMOVE_DEFAULT_LANGUAGE; ?></span>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <div class="modal-footer">
                    <?php if ($remove_language) { ?>
                        <button class="ajax btn btn-danger"><?php print IMAGE_DELETE; ?></button>
                    <?php } ?>
                    <button class="btn btn-default" data-dismiss="modal"><?php print IMAGE_CANCEL; ?></button>
                </div>
            </div>

            <?php
            exit;
            break;

        case 'new':

            $language_query_dirs=tep_db_query("select directory as id,directory as text from " . TABLE_LANGUAGES) ;
            while ($lang_dir = tep_db_fetch_array($language_query_dirs)) {
                $lang_dirs[] = $lang_dir;
            }

            $heading[]=array('text'=>'<b>' . TEXT_INFO_HEADING_NEW_LANGUAGE . '</b>');

            $contents=array('form'=>tep_draw_form('languages', FILENAME_LANGUAGES, 'page=' . $_GET['page'] . '&action=insert'));
            $contents[]=array('text'=>TEXT_INFO_INSERT_INTRO);
            $contents[]=array('text'=>TEXT_INFO_LANGUAGE_NAME . tep_draw_input_field('name', '', 'class="form-control input-sm" required'));
            $contents[]=array('text'=>TEXT_INFO_LANGUAGE_CODE . tep_draw_input_field('code', '', 'class="form-control input-sm" required'));
            $contents[]=array('text'=>TEXT_INFO_LANGUAGE_IMAGE . tep_draw_input_field('image', 'icon.gif', 'class="form-control input-sm"'));
            $contents[]=array('text'=>TEXT_INFO_LANGUAGE_DIRECTORY . tep_draw_input_field('directory', '', 'class="form-control input-sm" required'));
            $contents[]=array('text'=>TEXT_INFO_LANGUAGE_SORT_ORDER . tep_draw_input_field('sort_order', '', 'class="form-control input-sm" required'));
            $contents[]=array('text'=>TEXT_INFO_LANGUAGE_FROM_DIR . tep_draw_pull_down_menu('lang_dir', $lang_dirs, 'class="form-control input-sm" required'));
            $contents[]=array('text'=>tep_draw_checkbox_field('default') . ' ' . TEXT_SET_DEFAULT);

            $params=array(
                'submitButton'=>array(
                    'name'=>IMAGE_INSERT,
                    'class'=>'ajax btn btn-success'
                ),
                'cancelButton'=>array(
                    'name'=>IMAGE_CANCEL,
                    'class'=>'btn btn-default'
                ),
            );

            ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo defined('TEXT_CLOSE_BUTTON') ? TEXT_CLOSE_BUTTON : "TEXT_CLOSE_BUTTON"; ?>">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="editModalLabel"><?php print $heading[0]['text']; ?></h4>
                </div>
                <?php
                $box2=new box;
                echo $box2->infoBoxModal($contents, $params);
                ?>
            </div>
            <?php

            exit;
            break;

        case 'edit':

            $language_query_raw="select languages_id, name, code, image, directory, sort_order from " . TABLE_LANGUAGES . " where languages_id=" . $_GET['lID'];

            $languagesquery=tep_db_query($language_query_raw);
            $language=tep_db_fetch_array($languagesquery);
            $lInfo=new objectInfo($language);

            $heading[]=array('text'=>'<span class="font-bold">' . TEXT_INFO_HEADING_EDIT_LANGUAGE . '</span>');

            $contents=array('form'=>tep_draw_form('languages', FILENAME_LANGUAGES, 'page=' . $_GET['page'] . '&lID=' . $lInfo->languages_id . '&action=save'));
            $contents[]=array('text'=>TEXT_INFO_EDIT_INTRO);
            $contents[]=array('text'=>TEXT_INFO_LANGUAGE_NAME . tep_draw_input_field('name', $lInfo->name, 'class="form-control input-sm"'));
            $contents[]=array('text'=>TEXT_INFO_LANGUAGE_CODE . tep_draw_input_field('code', $lInfo->code, 'class="form-control input-sm"'));
            $contents[]=array('text'=>TEXT_INFO_LANGUAGE_IMAGE . tep_draw_input_field('image', $lInfo->image, 'class="form-control input-sm"'));
            $contents[]=array('text'=>tep_draw_input_field('directory', $lInfo->directory, 'class="form-control input-sm"',false,'hidden'));
            $contents[]=array('text'=>TEXT_INFO_LANGUAGE_SORT_ORDER . tep_draw_input_field('sort_order', $lInfo->sort_order, 'class="form-control input-sm"'));
            if (DEFAULT_LANGUAGE!=$lInfo->code)
                $contents[]=array('text'=>'<br>' . tep_draw_checkbox_field('default') . ' ' . TEXT_SET_DEFAULT);


            $params=array(
                'submitButton'=>array(
                    'name'=>IMAGE_UPDATE,
                    'class'=>'ajax btn btn-info'
                ),
                'cancelButton'=>array(
                    'name'=>IMAGE_CANCEL,
                    'class'=>'btn btn-default'
                ),
            );

            ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo TEXT_CLOSE_BUTTON; ?>">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="editModalLabel"><?php print !empty($lInfo->name) ? $lInfo->name : HEADING_TITLE; ?></h4>
                </div>
                <?php
                $box2=new box;
                echo $box2->infoBoxModal($contents, $params);
                ?>
            </div>
            <?php

            exit;
            break;

        case 'insert':
            $requiredFields = [
                'name',
                'code',
                'directory',
                'sort_order',
                'lang_dir',
            ];
            foreach ($requiredFields as $fieldName) {
                if (empty($_POST[$fieldName])) {
                    print json_encode(
                        [
                            'errors' => getConstantValue('REQUIRED_FIELDS_ERROR', 'Please fill in all required fields'),
                        ]
                    );
                    exit;
                }
            }
            $name=tep_db_prepare_input($_POST['name']);
            $code=tep_db_prepare_input($_POST['code']);
            $image=tep_db_prepare_input($_POST['image']);
            $directory=tep_db_prepare_input($_POST['directory']);
            $sort_order=tep_db_prepare_input($_POST['sort_order']);
            $lang_dir=tep_db_prepare_input($_POST['lang_dir']);

            if(!empty($lang_dir) && !empty($directory)){
                $from=DIR_WS_LANGUAGES.$lang_dir;
                $to=DIR_WS_LANGUAGES.$directory;
                $filesystem->copyDirectory($from,$to);
                $filesystem->copy($from.'.php',$to.'.php');

                $filesystem->copyDirectory(DIR_ROOT.DS.$from,DIR_ROOT.DS.$to);
                $filesystem->copy(DIR_ROOT . DS . $from . '.json',DIR_ROOT . DS . $to . '.json');

                // Copy language files in modules
                $extDirectory = new \RecursiveDirectoryIterator(DIR_FS_EXT);
                $extIterator = new \RecursiveIteratorIterator($extDirectory);
                foreach ($extIterator as $extInfo) {
                    $extPathInfo = $extInfo->getPathInfo();
                    if ($extPathInfo->getFilename() === 'languages') {
                        $defaultLanguageDirectory = $extPathInfo->getPathName() . DS . $lang_dir;
                        $existLanguageDirectory = $filesystem->isDirectory($defaultLanguageDirectory);
                        if ($existLanguageDirectory) {
                            $newLanguageDirectory = $extLanguageDirectory = $extPathInfo->getPathName() . DS . $directory;
                            $filesystem->copyDirectory($defaultLanguageDirectory, $newLanguageDirectory);
                        }
                    }
                }
            }

            $langs=language::getLangsByKey('directory');;
            $languages_id= $langs[$lang_dir]['id'];

            tep_db_query("insert into " . TABLE_LANGUAGES . " (name, code, image, directory, sort_order) values ('" . tep_db_input($name) . "', '" . tep_db_input($code) . "', '" . tep_db_input($image) . "', '" . tep_db_input($directory) . "', '" . tep_db_input($sort_order) . "')");
            $insert_id=tep_db_insert_id();

            // create additional articles_description records
            $articles_query=tep_db_query("select articles_id, articles_name,articles_description,articles_url,articles_head_title_tag,articles_head_desc_tag,articles_head_keywords_tag,seo_url from " . TABLE_ARTICLES_DESCRIPTION . " where language_id = '" . (int)$languages_id . "'");
            while ( $articles=tep_db_fetch_array($articles_query)) {
                tep_db_query("insert into " . TABLE_ARTICLES_DESCRIPTION . " (articles_id, language_id,  articles_name,articles_description,articles_url,articles_head_title_tag,articles_head_desc_tag,articles_head_keywords_tag,seo_url) values ('" . (int)$articles['articles_id'] . "', '" . (int)$insert_id . "', '" . tep_db_input($articles['articles_name']) ."', '" . tep_db_input($articles['articles_description'])  ."', '" . tep_db_input($articles['articles_url'])."', '" . tep_db_input($articles['articles_head_title_tag'])."', '" . tep_db_input($articles['articles_head_desc_tag'])."', '" . tep_db_input($articles['articles_head_keywords_tag'])."', '" . tep_db_input($articles['seo_url']) . "')");
            }

            // create additional topics_description records
            $topics_query=tep_db_query("select topics_id, topics_name,topics_heading_title,topics_description,topics_seo_title from " . TABLE_TOPICS_DESCRIPTION . " where language_id = '" . (int)$languages_id . "'");
            while ( $topics=tep_db_fetch_array($topics_query)) {
                tep_db_query("insert into " . TABLE_TOPICS_DESCRIPTION . " (topics_id,language_id, topics_name,topics_heading_title,topics_description,topics_seo_title) values ('" . (int)$topics['topics_id'] . "', '" . (int)$insert_id . "', '" . tep_db_input($topics['topics_name']) ."', '" . tep_db_input($topics['topics_heading_title'])  ."', '" . tep_db_input($topics['topics_description'])."', '" . tep_db_input($topics['topics_seo_title']) . "')");
            }

            // create additional phesis_poll_data records
            $phesis_poll_data_query=tep_db_query("select pollID, optionText,optionCount,voteID from " . TABLE_PHESIS_POLL_DATA . " where language_id = '" . (int)$languages_id . "'");
            while ( $phesis_poll_data=tep_db_fetch_array($phesis_poll_data_query)) {
                tep_db_query("insert into " . TABLE_PHESIS_POLL_DATA . " (pollID,language_id, optionText,optionCount,voteID) values ('" . (int)$phesis_poll_data['pollID'] . "', '" . (int)$insert_id . "', '" . tep_db_input($phesis_poll_data['optionText']) ."', '" . tep_db_input($phesis_poll_data['optionCount'])."', '" . tep_db_input($phesis_poll_data['voteID']) . "')");
            }


            // create additional categories_description records
            $categories_query=tep_db_query("select c.categories_id, cd.categories_name, cd.categories_heading_title,cd.categories_description, cd.categories_seo_url from " . TABLE_CATEGORIES . " c left join " . TABLE_CATEGORIES_DESCRIPTION . " cd on c.categories_id = cd.categories_id where cd.language_id = '" . (int)$languages_id . "'");
            while ($categories=tep_db_fetch_array($categories_query)) {
                tep_db_query("insert into " . TABLE_CATEGORIES_DESCRIPTION . " (categories_id, language_id, categories_name,categories_heading_title,categories_description, categories_seo_url) values ('" . (int)$categories['categories_id'] . "', '" . (int)$insert_id . "', '" . tep_db_input($categories['categories_name']) ."', '" . tep_db_input($categories['categories_heading_title'])  ."', '" . tep_db_input($categories['categories_description'])."', '" . tep_db_input($categories['categories_seo_url']) . "')");
            }

            // create additional products_description records
            $products_query=tep_db_query("select p.products_id, pd.products_name, pd.products_description, pd.products_url, pd.products_head_title_tag, pd.products_head_desc_tag, pd.products_head_keywords_tag, pd.products_info from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id where pd.language_id = '" . (int)$languages_id . "'");
            while ($products=tep_db_fetch_array($products_query)) {
                tep_db_query("insert into " . TABLE_PRODUCTS_DESCRIPTION . " (products_id, language_id, products_name, products_description, products_url, products_head_title_tag, products_head_desc_tag,products_head_keywords_tag,products_info) values ('" . (int)$products['products_id'] . "', '" . (int)$insert_id . "', '" . tep_db_input($products['products_name']) . "', '" . tep_db_input($products['products_description']) . "', '" . tep_db_input($products['products_url'])  . "', '" . tep_db_input($products['products_head_title_tag'])  . "', '" . tep_db_input($products['products_head_desc_tag'])  . "', '" . tep_db_input($products['products_head_keywords_tag'])  . "', '" . tep_db_input($products['products_info']) . "')");
            }

            // create additional products_options records
            $products_options_query=tep_db_query("select products_options_id, products_options_name,products_options_type,products_options_length,products_options_comment from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . (int)$languages_id . "'");
            while ($products_options=tep_db_fetch_array($products_options_query)) {
                tep_db_query("insert into " . TABLE_PRODUCTS_OPTIONS . " (products_options_id, language_id, products_options_name,products_options_type,products_options_length,products_options_comment) values ('" . (int)$products_options['products_options_id'] . "', '" . (int)$insert_id . "', '" . tep_db_input($products_options['products_options_name']) . "', '" . tep_db_input($products_options['products_options_type']) . "', '" . tep_db_input($products_options['products_options_length']). "', '" . tep_db_input($products_options['products_options_comment']) . "')");
            }

            // create additional products_options_values records
            $products_options_values_query=tep_db_query("select products_options_values_id, products_options_values_name,products_options_values_image,products_options_values_sort_order from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where language_id = '" . (int)$languages_id . "'");
            while ($products_options_values=tep_db_fetch_array($products_options_values_query)) {
                tep_db_query("insert into " . TABLE_PRODUCTS_OPTIONS_VALUES . " (products_options_values_id, language_id, products_options_values_name,products_options_values_image,products_options_values_sort_order) values ('" . (int)$products_options_values['products_options_values_id'] . "', '" . (int)$insert_id . "', '" . tep_db_input($products_options_values['products_options_values_name'])  . "', '" . tep_db_input($products_options_values['products_options_values_image'])  . "', '" . tep_db_input($products_options_values['products_options_values_sort_order']) . "')");
            }

            // create additional manufacturers_info records
            $manufacturers_query=tep_db_query("select m.manufacturers_id, mi.manufacturers_url from " . TABLE_MANUFACTURERS . " m left join " . TABLE_MANUFACTURERS_INFO . " mi on m.manufacturers_id = mi.manufacturers_id where mi.languages_id = '" . (int)$languages_id . "'");
            while ($manufacturers=tep_db_fetch_array($manufacturers_query)) {
                tep_db_query("insert into " . TABLE_MANUFACTURERS_INFO . " (manufacturers_id, languages_id, manufacturers_url) values ('" . $manufacturers['manufacturers_id'] . "', '" . (int)$insert_id . "', '" . tep_db_input($manufacturers['manufacturers_url']) . "')");
            }

            // create additional orders_status records
            $orders_status_query=tep_db_query("select orders_status_id, orders_status_name,orders_status_color from " . TABLE_ORDERS_STATUS . " where language_id = '" . (int)$languages_id . "'");
            while ($orders_status=tep_db_fetch_array($orders_status_query)) {
                tep_db_query("insert into " . TABLE_ORDERS_STATUS . " (orders_status_id, language_id, orders_status_name,orders_status_color) values ('" . (int)$orders_status['orders_status_id'] . "', '" . (int)$insert_id . "', '" . tep_db_input($orders_status['orders_status_name']) . "', '" . tep_db_input($orders_status['orders_status_color']) . "')");
            }

            if (isset($_POST['default']) && ($_POST['default']=='on')) {
                tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '" . tep_db_input($code) . "' where configuration_key = 'DEFAULT_LANGUAGE'");
            }

            // tep_redirect(tep_href_link(FILENAME_LANGUAGES, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'lID=' . $insert_id));

            print json_encode(array(
                'updated_panel'=>get_languages_page_panel_html(),
                'modal'=>array(
                    'hide',
                ),
            ));
            exit;
            break;

        case 'save':

            $lID=tep_db_prepare_input($_GET['lID']);
            $name=tep_db_prepare_input($_POST['name']);
            $page=tep_db_prepare_input($_GET['page']);
            $code=tep_db_prepare_input($_POST['code']);
            $image=tep_db_prepare_input($_POST['image']);
            $directory=tep_db_prepare_input($_POST['directory']);
            $sort_order=tep_db_prepare_input($_POST['sort_order']);

            $lang_status = '';
            if ($_POST['default']=='on') {
                $lang_status = ", lang_status = '1'";
                if (getConstantValue('LANGUAGE_SELECTOR_MODULE_ENABLED') == 'false')
                tep_db_query("update " . TABLE_LANGUAGES . " set lang_status = '0'");
            }

            tep_db_query("update " . TABLE_LANGUAGES . " set name = '" . tep_db_input($name) . "', code = '" . tep_db_input($code) . "', image = '" . tep_db_input($image) . "', directory = '" . tep_db_input($directory) . "', sort_order = '" . tep_db_input($sort_order) . "'" . $lang_status . " where languages_id = '" . (int)$lID . "'");

            if ($_POST['default']=='on') {
                tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '" . tep_db_input($code) . "' where configuration_key = 'DEFAULT_LANGUAGE'");

                $name=$name . ' (' . TEXT_DEFAULT . ')';
            }

            //tep_redirect(tep_href_link(FILENAME_LANGUAGES, 'page=' . $_GET['page'] . '&lID=' . $_GET['lID']));

            print json_encode(array(
                /*                'updated_cols'=>array(
                                    'name'=>$name,
                                    'code'=>$code,
                                    'image'=>tep_image(DIR_WS_CATALOG_LANGUAGES . $directory . '/images/' . $image, $name),
                                    'directory'=>$directory,
                                    'sort_order'=>$sort_order,
                                ),*/
                'updated_panel'=>get_languages_page_panel_html($code),
                'modal'=>array(
                    'hide',
                ),
            ));

            exit;
            break;

        case 'change_status':
            $msg=TEXT_ERROR;
            $redirect=$_POST['id']==$languages_id?'?language='.DEFAULT_LANGUAGE:false;
            if(!empty($_POST['id'])){
                // Allow change language status only if module multilanguage enabled
                if (getConstantValue('LANGUAGE_SELECTOR_MODULE_ENABLED') == 'true') {
                    if(tep_db_query("UPDATE " . TABLE_LANGUAGES . " set lang_status='{$_POST['status']}' where languages_id = '" . $_POST['id'] . "'")){
                        $msg=TEXT_SAVE_DATA_OK;
                    }
                } elseif ($_POST['status'] == 1) {
                    tep_db_query("update " . TABLE_LANGUAGES . " set lang_status = '0'");
                    if(tep_db_query("UPDATE " . TABLE_LANGUAGES . " set lang_status='{$_POST['status']}' where languages_id = '" . $_POST['id'] . "'")){
                        $msg=TEXT_SAVE_DATA_OK;
                        $redirect = '?language='.$languages_id;
                    }
                    $allLanguages = language::getLangsByKey();
                    tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '" . $allLanguages[$_POST['id']]["code"] . "' where configuration_key = 'DEFAULT_LANGUAGE'");
                } else {
                    if(tep_db_query("update " . TABLE_LANGUAGES . " set lang_status = '0' where code != '" . DEFAULT_LANGUAGE . "'")){
                        $msg=TEXT_SAVE_DATA_OK;
                    }
                }
            }
            echo json_encode(array('msg'=>$msg,'redirect'=>$redirect));
            exit;
    }
}
?>

<?php

/**
 * header
 */

include_once('html-open.php');
include_once('header.php');

?>

    <div class="modal fade" id="ajaxModal" tabindex="-1" role="dialog" aria-labelledby="ajaxModalLabel">
        <div class="modal-dialog modal-lg" role="document">
        </div>
    </div>

    <!-- content -->

    <div class="container app-content-body p-b-none">
        <div id="tabs-attr" class="tabs-lang">
            <ul class="nav nav-tabs" id="attributes">
                <li class="active">
                    <a href="<?=tep_href_link(FILENAME_LANGUAGES)?>"><?=BOX_LOCALIZATION_LANGUAGES?></a>
                </li>
                <li class="">
                    <a href="<?=tep_href_link(FILENAME_LANGUAGES_TRANSLATER, 'file='.$language.'.json')?>"><?=TEXT_TRANSLATER_TITLE?></a>
                </li>
                <li class="">
                    <a href="<?=tep_href_link(FILENAME_AUTO_TRANSLATE)?>"
                        <?=(getConstantValue('AUTO_TRANSLATE_MODULE_ENABLED') == 'true') ? '' : 'style="pointer-events: none;"'?>>
                        <?=AUTO_TRANSLATE_MODULE_ENABLED_TITLE?>
                    </a>
                </li>
            </ul>
        </div>
        <div class="hbox hbox-auto-xs hbox-auto-sm">
            <!-- main -->
            <div class="col">

                <div class="wrapper-md wrapper_767">
                    <div class="bg-light lter ng-scope">
                        <h1 class="m-n font-thin h3"><?php echo HEADING_TITLE; ?></h1>
                        <a class="ajax-modal btn btn-default btn-xs green_plus" href="<?php print tep_href_link(FILENAME_LANGUAGES, tep_get_all_get_params(array(
                                'action',
                                'info'
                            )) . 'action=new', 'NONSSL'); ?>" data-toggle="tooltip" data-placement="right" title="<?php print IMAGE_NEW_LANGUAGE; ?>" data-original-title="<?php print IMAGE_NEW_LANGUAGE; ?>">
                            <svg width="44px" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="#18bf49" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm144 276c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92h-92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z" class=""></path></svg>
                        </a>
                    </div>
                </div>

                <div class="wrapper-md wrapper_767">
                    <?php print get_languages_page_panel_html(); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- /content -->

    <script>
        $(document).ready(function () {
            $(document).on('change', '.status input', function () {
                var data = {};
                var id = $(this).attr('id').match(/[0-9]+/)[0];
                var status = $(this).prop('checked');
                //check default
                if($(this).closest('tr').find('span.default').length==1){
                    $(this).prop('checked',true);
                    show_tooltip('<?php echo addslashes(getConstantValue("ERROR_STATUS_DEFAULT_LANGUAGE", ""))?>', 3000);
                }else{
                    if (status == true) {
                        status = 1;
                    } else {
                        status = 0;
                    }
                    data['status'] = status;
                    data['id'] = id;
                    $.ajax({
                        url: window.location.pathname+'?action=change_status',
                        type: "POST",
                        data: data,
                        dataType: 'json',
                        success: function (response) {
                            show_tooltip(response.msg, 500);
                            if(response.redirect!==false){
                                location.href = location.pathname +response.redirect;
                            }
                        }
                    });
                }
            });
        });
    </script>
<?php

/**
 * footer
 */

include_once('footer.php');
include_once('html-close.php');

?>

<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>

<?php

/**
 * Создает html панели страницы "Языки"
 * @return string - готовый html панели страницы "Языки"
 */
function get_languages_page_panel_html($lang=null) {
    global $languages_id;
    $lang = ($lang && isset($_POST["default"]) && $_POST["default"] === "on") ? $lang : DEFAULT_LANGUAGE;
    ob_start();

    ?>


    <div class="panel panel-default">
        <!--        <div class="table-responsive">-->
        <table class="table table-bordered table-hover table-condensed bg-white-only b-t b-light">
            <thead>
            <tr>
                <th><?php echo TABLE_HEADING_LANGUAGE_NAME; ?></th>
                <th><?php echo TABLE_HEADING_LANGUAGE_CODE; ?></th>
                <th><?php echo TABLE_HEADING_LANGUAGE_PICTURE; ?></th>
                <th><?php echo TABLE_HEADING_LANGUAGE_DIR; ?></th>
                <th><?php echo TABLE_HEADING_LANGUAGE_ORDER; ?></th>
                <th><?php echo TABLE_HEADING_LANGUAGE_STATUS; ?></th>
                <th><?php echo TABLE_HEADING_ACTION; ?></th>
            </tr>
            </thead>
            <tbody>
            <?php

            $languages_query_raw="select languages_id, name, code, image, directory, sort_order,lang_status from " . TABLE_LANGUAGES . " order by sort_order";
            $languages_split=new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $languages_query_raw, $languages_query_numrows);
            $languages_query=tep_db_query($languages_query_raw);

            while ($languages=tep_db_fetch_array($languages_query)) {

                if ((!isset($_GET['lID']) || (isset($_GET['lID']) && ($_GET['lID']==$languages['languages_id']))) && !isset($lInfo) && (substr($action, 0, 3)!='new')) {
                    $lInfo=new objectInfo($languages);
                }

                ?>
                <tr>
                    <td data-label="<?php echo TABLE_HEADING_LANGUAGE_NAME; ?>" class="col-name-name <?php echo $languages['languages_id']==$languages_id?'selected':''; ?>"><?php echo ($lang==$languages['code']) ? '<span class="font-bold default">' . $languages['name'] . ' (' . TEXT_DEFAULT . ')</span>' : $languages['name']; ?></td>
                    <td data-label="<?php echo TABLE_HEADING_LANGUAGE_CODE; ?>" class="col-name-code"><?php echo $languages['code']; ?></td>
                    <td data-label="<?php echo TABLE_HEADING_LANGUAGE_PICTURE; ?>" class="col-name-image"><img src="<?='images/flags/' . $languages['code'] . '.svg'?>"
                                                                                                               alt="lang image" width="26"></td>
                    <td data-label="<?php echo TABLE_HEADING_LANGUAGE_DIR; ?>" class="col-name-directory"><?php echo $languages['directory']; ?></td>
                    <td data-label="<?php echo TABLE_HEADING_LANGUAGE_ORDER; ?>" class="col-name-sort_order"><?php echo $languages['sort_order']; ?></td>
                    <td data-label="<?php echo TABLE_HEADING_LANGUAGE_STATUS; ?>" class="col-name-status">
                        <div class="status">
                            <input class="cmn-toggle cmn-toggle-round" type="checkbox" id="cmn-toggle-status_<?php echo $languages['languages_id'];?>" <?php echo $languages['lang_status']==1?'checked':'';?>>
                            <label for="cmn-toggle-status_<?php echo $languages['languages_id'];?>"></label>
                        </div>
                    </td>
                    <td data-label="<?php echo TABLE_HEADING_ACTION; ?>">
                        <a class="ajax-modal btn-link btn-link-icon" href="<?php print tep_href_link(FILENAME_LANGUAGES, 'page=' . $_GET['page'] . '&lID=' . $languages['languages_id'] . '&action=edit'); ?>" data-toggle="tooltip" data-placement="right" title="<?php print getConstantValue("IMAGE_EDIT", ""); ?>" data-original-title="<?php print getConstantValue("IMAGE_EDIT", ""); ?>">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a class="m-l-sm ajax-modal btn-link btn-link-icon" href="<?php print tep_href_link(FILENAME_LANGUAGES, 'page=' . $_GET['page'] . '&lID=' . $languages['languages_id'] . '&action=delete'); ?>" data-toggle="tooltip" data-placement="right" title="<?php print getConstantValue("IMAGE_DELETE", "");; ?>" data-original-title="<?php print getConstantValue("IMAGE_DELETE", "");; ?>">
                            <i class="fa fa-trash-o"></i>
                        </a>
                        <a target="_blank" class="m-l-sm btn-link btn-link-icon" href="<?=  tep_href_link(FILENAME_LANGUAGES_TRANSLATER,'path='.$languages['directory'].DS) ?>" data-toggle="tooltip" data-placement="right" title="<?php print getConstantValue("IMAGE_LANG_DIR", ""); ?>" data-original-title="<?php print getConstantValue("IMAGE_LANG_DIR", ""); ?>">
                            <i class="fa fa-external-link-square"></i>
                        </a>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <!--        </div>-->
        <footer class="panel-footer">
            <div class="row m-b">
                <div class="col-sm-6">
                    <?php echo $languages_split->display_count($languages_query_numrows, getConstantValue("MAX_DISPLAY_SEARCH_RESULTS", ""), $_GET['page'], getConstantValue("TEXT_DISPLAY_NUMBER_OF_LANGUAGES", "")); ?>
                </div>
                <div class="col-sm-6 text-right">
                    <?php echo $languages_split->new_display_links($languages_query_numrows, getConstantValue("MAX_DISPLAY_SEARCH_RESULTS", ""), getConstantValue("MAX_DISPLAY_PAGE_LINKS", ""), $_GET['page']); ?>
                </div>
            </div>
        </footer>
    </div>


    <?php

    $html=ob_get_contents();
    ob_end_clean();

    return $html;
}
