<?php
/*
$Id: polls.php,v 1.10 2003/04/06 13:12:37 wilt Exp $

The Exchange Project - Community Made Shopping!
http://www.theexchangeproject.org

Copyright (c) 2000,2001 The Exchange Project

Released under the GNU General Public License
*/

require('includes/application_top.php');

$languages = tep_get_languages();

/*
 * Новый switch обработки параметров $_GET, таких, как 'action'
 *
 * Блоки ниже аналогичные, но в них царит хаос
 * Перемещайте необходимые обработчики в этот блок, при этом, пожалуйста, исправляйте и оформляйте код
 * После перемещения всех обработок блоки ниже можно будет удалить
 */
if (isset($_GET['action'])) {
  switch ($_GET['action']) {
    /*
     * Ответ на AJAX-запрос добавления опроса
     */
    case 'new':
      ?>
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" type="button" data-dismiss="modal" aria-label="<?php echo TEXT_CLOSE_BUTTON; ?>">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="ajaxModalLabel"><?php print HEADING_TITLE; ?></h4>
        </div>

        <div class="modal-body">
          <form class="form-horizontal text-center" name="polls" action="<?php print tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('action', 'cID')) . 'action=updatenew', 'NONSSL'); ?>" method="post">
            <input type="hidden" name="pollid" value="NULL">

            <?php

            /*
             * Выводим поле категории опроса
             */
            ?>
            <div class="form-group">
              <label class="col-lg-3 control-label"><?php print TEXT_POLL_CATEGORY; ?></label>
              <div class="col-lg-9">
                <?php

                $categories = $tep_get_category_tree;
                $categories[0]['text'] = TEXT_POLL_ALL_CATS;
                print new_tep_draw_pull_down_menu('cPath', $categories, 0);

                ?>
              </div>
            </div>

            <?php

            /*
             * Выводим вкладки с полями для каждого языка
             */
            ?>
            <div class="tab-container">
              <ul class="nav nav-tabs">
                <?php

                $sorted_languages = array(
                    $languages_id => array(),
                  );
                foreach ($languages AS $lang) {
                  $sorted_languages[$lang['id']] = $lang;
                }

                foreach ($sorted_languages AS $lang_id => $lang) {
                  $active_tab = $languages_id == $lang['id']?'active':' ';

                  ?>
                  <li class="<?php print $active_tab; ?>">
                    <a href="#<?php print $lang['code']; ?>" data-toggle="tab">
                      <?php print tep_image(DIR_WS_CATALOG_LANGUAGES . $lang['directory'] . '/images/' . $lang['image'], $lang['name']); ?>
                    </a>
                  </li>
                  <?php
                }

                ?>
              </ul>
              <div class="tab-content">
                <?php

                foreach ($sorted_languages AS $lang_id => $lang) {
                  $active_tab = $languages_id == $lang['id']?' active ':' ';

                  ?>
                  <div id="<?php print $lang['code']; ?>" class="tab-pane fade<?php print $active_tab; ?>in">
                    <?php

                    /*
                     * Вывод поля с названием опроса
                     */
                    $poll_data_query = tep_db_query("SELECT * FROM ".TABLE_PHESIS_POLL_DATA." WHERE pollid = '" . $_GET['cID'] . "' AND voteid = '0' AND language_id = '" . $lang['id'] . "'");
                    $poll_data = tep_db_fetch_array($poll_data_query);

                    ?>
                    <div class="form-group">
                      <label class="col-lg-3 control-label"><?php print TEXT_POLL_TITLE; ?></label>
                      <div class="col-lg-9">
                        <input class="form-control" type="text" name="voteid0[<?php print $lang['id']; ?>]" value="">
                      </div>
                    </div>
                    <?php

                    /*
                     * Вывод остальных полей
                     */
                    for ($i = 1; $i < 16; $i++) {
                      $poll_data_query = tep_db_query("SELECT * FROM ".TABLE_PHESIS_POLL_DATA." WHERE pollid = '" . $_GET['cID'] . "' AND voteid='" . $i . "' AND language_id = '" . $lang['id'] . "'");
                      $poll_data = tep_db_fetch_array($poll_data_query);

                      ?>
                      <div class="form-group">
                        <label class="col-lg-3 control-label"><?php print TEXT_OPTION . ' ' . $i; ?></label>
                        <div class="col-lg-9">
                          <input class="form-control" type="text" name="voteid<?php print $i; ?>[<?php print $lang['id']; ?>]" value="">
                        </div>
                      </div>
                      <?php
                    }
                    ?>
                  </div>
                  <?php
                }

                ?>
              </div>
            </div>
          </form>
        </div>

        <div class="modal-footer">
          <button class="ajax btn btn-success"><?php print TEXT_MODAL_ADD_ACTION; ?></button>
          <button class="btn btn-default" data-dismiss="modal"><?php print TEXT_MODAL_CANCEL_ACTION; ?></button>
        </div>
      </div>

      <?php
      exit;

      break;

    case 'updatenew':
      $new_poll_query = tep_db_query("INSERT INTO ".TABLE_PHESIS_POLL_DESC." (timeStamp, voters, catID) VALUES (NOW(), '0', '" . $_POST['cPath'] . "')");
      $new_poll_id = tep_db_insert_id($new_poll_query);

      foreach ($languages AS $lang_id => $lang) {
        for ($i = 0; $i < 16; $i++) {
          tep_db_query("INSERT INTO ".TABLE_PHESIS_POLL_DATA." (pollID, optionText, optionCount, voteID, language_id)
                        VALUES (" . $new_poll_id . ", '" . tep_db_input($_POST['voteid' . $i][$lang['id']]) . "', '0', '" . $i . "', '" . $lang['id'] . "')");
        }
      }

      print json_encode(array(
        'updated_panel' => get_polls_page_panel_html(),
        'modal' => array(
          'hide',
        ),
      ));
      exit;

      break;

    /*
     * Ответ на AJAX-запрос редактирования опроса
     */
    case 'edit':
      $poll_query = tep_db_query("SELECT poll_desc.pollID, poll_desc.timeStamp, poll_desc.voters,
                                  poll_desc.poll_type, poll_desc.poll_open, poll_desc.catID,
                                  poll_desc.prodID, poll_data.optionText
                                  FROM ".TABLE_PHESIS_POLL_DESC." poll_desc
                                  LEFT JOIN ".TABLE_PHESIS_POLL_DATA." poll_data
                                  ON (poll_desc.pollID = poll_data.pollID)
                                  WHERE poll_desc.pollID = '" . $_GET['cID'] . "'
                                  AND poll_data.voteID = '0'
                                  AND poll_data.language_id = '" . $languages_id . "'");
      $poll = tep_db_fetch_array($poll_query);

      ?>
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" type="button" data-dismiss="modal" aria-label="<?php echo TEXT_CLOSE_BUTTON; ?>">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="ajaxModalLabel"><?php print !empty($poll['optionText'])?$poll['optionText']:HEADING_TITLE; ?></h4>
        </div>

        <div class="modal-body">
          <form class="form-horizontal text-center" name="polls" action="<?php print tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('action', 'cID')) . 'action=update', 'NONSSL'); ?>" method="post">
            <input type="hidden" name="pollid" value="<?php echo $_GET['cID']; ?>">

            <?php

            /*
             * Выводим поле категории опроса
             */
            ?>
            <div class="form-group">
              <label class="col-lg-3 control-label"><?php print TEXT_POLL_CATEGORY; ?></label>
              <div class="col-lg-9">
                <?php

                $categories = $tep_get_category_tree;
                $categories[0]['text'] = TEXT_POLL_ALL_CATS;
                print new_tep_draw_pull_down_menu('cPath', $categories, $poll['catID']);

                ?>
              </div>
            </div>

            <?php

            /*
             * Выводим вкладки с полями для каждого языка
             */
            ?>
            <div class="tab-container">
              <ul class="nav nav-tabs">
                <?php

                $sorted_languages = array(
                    $languages_id => array(),
                  );
                foreach ($languages AS $lang) {
                  $sorted_languages[$lang['id']] = $lang;
                }

                foreach ($sorted_languages AS $lang_id => $lang) {
                  $active_tab = $languages_id == $lang['id']?'active':' ';

                  ?>
                  <li class="<?php print $active_tab; ?>">
                    <a href="#<?php print $lang['code']; ?>" data-toggle="tab">
                      <?php print tep_image(DIR_WS_CATALOG_LANGUAGES . $lang['directory'] . '/images/' . $lang['image'], $lang['name']); ?>
                    </a>
                  </li>
                  <?php
                }

                ?>
              </ul>
              <div class="tab-content">
                <?php

                foreach ($sorted_languages AS $lang_id => $lang) {
                  $active_tab = $languages_id == $lang['id']?' active ':' ';

                  ?>
                  <div id="<?php print $lang['code']; ?>" class="tab-pane fade<?php print $active_tab; ?>in">
                    <?php

                    /*
                     * Вывод поля с названием опроса
                     */
                    $poll_data_query = tep_db_query("SELECT * FROM ".TABLE_PHESIS_POLL_DATA." WHERE pollid = '" . $_GET['cID'] . "' AND voteid = '0' AND language_id = '" . $lang['id'] . "'");
                    $poll_data = tep_db_fetch_array($poll_data_query);

                    ?>
                    <div class="form-group">
                      <label class="col-lg-3 control-label"><?php print TEXT_POLL_TITLE; ?></label>
                      <div class="col-lg-9">
                        <input class="form-control" type="text" name="voteid0[<?php print $lang['id']; ?>]" value="<?php print $poll_data['optionText']; ?>">
                      </div>
                    </div>
                    <?php

                    /*
                     * Вывод остальных полей
                     */
                    for ($i = 1; $i < 16; $i++) {
                      $poll_data_query = tep_db_query("SELECT * FROM ".TABLE_PHESIS_POLL_DATA." WHERE pollid = '" . $_GET['cID'] . "' AND voteid='" . $i . "' AND language_id = '" . $lang['id'] . "'");
                      $poll_data = tep_db_fetch_array($poll_data_query);

                      ?>
                      <div class="form-group">
                        <label class="col-lg-3 control-label"><?php print TEXT_OPTION . ' ' . $i; ?></label>
                        <div class="col-lg-9">
                          <input class="form-control" type="text" name="voteid<?php print $i; ?>[<?php print $lang['id']; ?>]" value="<?php print $poll_data['optionText']; ?>">
                        </div>
                      </div>
                      <?php
                    }
                    ?>
                  </div>
                  <?php
                }

                ?>
              </div>
            </div>
          </form>
        </div>

        <div class="modal-footer">
          <button class="ajax btn btn-info"><?php print TEXT_MODAL_UPDATE_ACTION; ?></button>
          <button class="btn btn-default" data-dismiss="modal"><?php print TEXT_MODAL_CANCEL_ACTION; ?></button>
        </div>
      </div>

      <?php
      exit;

      break;

    /*
     * Ответ на AJAX-запрос вкл/выкл общедоступности опроса
     */
    case 'poll_type':
      $poll_query = tep_db_query("SELECT poll_type FROM ".TABLE_PHESIS_POLL_DESC." WHERE pollid = " . $_GET['info']);
      $poll = tep_db_fetch_array($poll_query);

      if ($poll['poll_type'] == 1) {
        $new_poll_type = 0;
        $new_title_attr = _ALT_PRIVATE;
      } else {
        $new_poll_type = 1;
        $new_title_attr = _ALT_PUBLIC;
      }

      $poll_update_query = tep_db_query("UPDATE ".TABLE_PHESIS_POLL_DESC." SET poll_type = ". $new_poll_type . " WHERE pollid = " . $_GET['info']);

      print json_encode(array(
        'checked' => $new_poll_type,
        'title' => $new_title_attr,
      ));
      exit;

      break;

    /*
     * Ответ на AJAX-запрос вкл/выкл опроса
     */
    case 'poll_open':
      $poll_query = tep_db_query("SELECT poll_open FROM ".TABLE_PHESIS_POLL_DESC." WHERE pollid = " .$_GET['info']);
      $poll = tep_db_fetch_array($poll_query);

      if ($poll['poll_open'] == 1) {
        $new_poll_open = 0;
        $new_title_attr = _ALT_CLOSE;
      } else {
        $new_poll_open = 1;
        $new_title_attr = _ALT_REOPEN;
      }

      $poll_update_query = tep_db_query("UPDATE ".TABLE_PHESIS_POLL_DESC." SET poll_open = " . $new_poll_open . " WHERE pollid = " .$_GET['info']);

      print json_encode(array(
        'checked' => $new_poll_open,
        'title' => $new_title_attr,
      ));
      exit;

      break;

    /*
     * Ответ на AJAX-запрос сохранения опроса
     */
    case 'update':
      $poll_update = tep_db_query("UPDATE ".TABLE_PHESIS_POLL_DESC." SET catID = '" . $_POST['cPath'] . "' WHERE pollID = '" . $_POST['pollid'] . "'");
      $poll_title = '';

      foreach ($languages AS $lang_id => $lang) {
        for ($i = 0; $i < 16; $i++) {
          $poll_text = tep_db_input($_POST['voteid' . $i][$lang['id']]);

          if ($i == 0) {
            $poll_title = $poll_text;
          }

          $check_query = tep_db_query("SELECT * FROM ".TABLE_PHESIS_POLL_DATA." WHERE voteid = '" . $i . "' AND pollID = '" . $_POST['pollid'] . "' AND language_id = '" . $lang['id'] . "'");
          if(!tep_db_num_rows($check_query)) {
            $update_query = "INSERT INTO ".TABLE_PHESIS_POLL_DATA." (pollid, optiontext, voteid, language_id) VALUES (" . $_POST['pollid'] . ", '" . $poll_text . "', " . $i . "," . $lang['id'] . ")";
          } else {
            $update_query = "UPDATE ".TABLE_PHESIS_POLL_DATA." SET optiontext='" . $poll_text . "' WHERE voteid = '" . $i . "' AND pollid = '" . $_POST['pollid'] . "' AND language_id = '" . $lang['id'] . "'";
          }

          tep_db_query($update_query);
        }
      }

      print json_encode(array(
        'updated_cols' => array(
          'optionText' => $poll_title,
        ),
        'modal' => array(
          'hide',
        ),
      ));
      exit;

      break;

    /*
     * Ответ на AJAX-запрос удаления опроса
     */
    case 'confirm':
      $poll_query = tep_db_query("SELECT poll_desc.pollID, poll_desc.timeStamp, poll_desc.voters,
                                  poll_desc.poll_type, poll_desc.poll_open, poll_desc.catID,
                                  poll_desc.prodID, poll_data.optionText
                                  FROM ".TABLE_PHESIS_POLL_DESC." poll_desc
                                  LEFT JOIN ".TABLE_PHESIS_POLL_DATA." poll_data
                                  ON (poll_desc.pollID = poll_data.pollID)
                                  WHERE poll_desc.pollID = '" . $_GET['info'] . "'
                                  AND poll_data.voteID = '0'
                                  AND poll_data.language_id = '" . $languages_id . "'");
      $poll = tep_db_fetch_array($poll_query);

      ?>
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" type="button" data-dismiss="modal" aria-label="<?php echo TEXT_CLOSE_BUTTON; ?>">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="ajaxModalLabel"><?php print !empty($poll['optionText'])?$poll['optionText']:HEADING_TITLE; ?></h4>
        </div>

        <div class="modal-body">
          <form action="<?php print tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('action')) . 'action=deleteconfirm', 'NONSSL'); ?>" method="post">
            <input type="hidden" name="cID" value="<?php print $poll['pollID']; ?>">
            <p class="text-center m-b-none"><?php print TEXT_DELETE_INTRO; ?></p>
          </form>
        </div>

        <div class="modal-footer">
          <button class="ajax btn btn-danger"><?php print TEXT_MODAL_DELETE_ACTION; ?></button>
          <button class="btn btn-default" data-dismiss="modal"><?php print TEXT_MODAL_CANCEL_ACTION; ?></button>
        </div>
      </div>

      <?php
      exit;

      break;

    case 'deleteconfirm':
      $delete_query_1 = "DELETE FROM ".TABLE_PHESIS_POLL_DESC." WHERE pollID = '" . $_POST['cID'] . "'";
      $delete_query_2 = "DELETE FROM ".TABLE_PHESIS_POLL_DATA." WHERE pollID = '" . $_POST['cID'] . "'";
      tep_db_query($delete_query_1);
      tep_db_query($delete_query_2);

      $polls_query = tep_db_query("SELECT COUNT(*) AS count FROM ".TABLE_PHESIS_POLL_DESC);
      $polls = tep_db_fetch_array($polls_query);

      print json_encode(array(
        'updated_panel' => get_polls_page_panel_html(),
        'modal' => array(
          'hide',
        ),
      ));
      exit;

      break;

    case 'edit_config':
      $config_query = tep_db_query("SELECT configuration_id AS cfgID,
                                      configuration_title AS cfgTitle,
                                      configuration_description AS cfgDesc,
                                      configuration_key AS cfgKey,
                                      configuration_value AS cfgValue,
                                      date_added, last_modified
                                      FROM ".TABLE_PHESIS_POLL_CONFIG."
                                      WHERE configuration_id = '" . $_GET['configuration_id'] . "'");
      $config = tep_db_fetch_array($config_query);
      $cfgInfo = new objectInfo($config);

      ?>
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" type="button" data-dismiss="modal" aria-label="<?php echo TEXT_CLOSE_BUTTON; ?>">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="ajaxModalLabel"><?php print constant(strtoupper($cfgInfo->cfgKey .'_TITLE')); ?></h4>
        </div>

        <div class="modal-body">

          <form name="configuration" action="<?php print tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('action')) . 'action=save_config', 'NONSSL'); ?>" method="post">
            <input type="hidden" name="configuration_id" value="<?php print $cfgInfo->cfgID; ?>">
            <p class="m-b-lg"><?php print TEXT_INFO_EDIT_INTRO; ?></p>
            <p><?php print TEXT_INFO_DESCRIPTION; ?></p>
            <p><?php print constant(strtoupper($cfgInfo->cfgKey .'_DESC')); ?></p>
            <?php

            if (tep_not_null($cfgInfo->set_function)) {
              $set_function = $cfgInfo->set_function;
              print $set_function($cfgInfo->cfgValue);
            } else {
              ?>
              <input class="form-control" type="text" name="configuration_value" value="<?php print $cfgInfo->cfgValue; ?>">
              <?php
            }

            ?>
          </form>
        </div>

        <div class="modal-footer">
          <button class="ajax btn btn-info"><?php print TEXT_MODAL_UPDATE_ACTION; ?></button>
          <button class="btn btn-default" data-dismiss="modal"><?php print TEXT_MODAL_CANCEL_ACTION; ?></button>
        </div>
      </div>

      <?php
      exit;

      break;

    case 'save_config':
      tep_db_query("UPDATE ".TABLE_PHESIS_POLL_CONFIG."
                    SET configuration_value = '" . $_POST['configuration_value'] . "', last_modified = NOW()
                    WHERE configuration_id = '" . $_POST['configuration_id'] . "'");
      $updated_conf_query = tep_db_query("SELECT last_modified
                                          FROM ".TABLE_PHESIS_POLL_CONFIG."
                                          WHERE configuration_id = '" . $_POST['configuration_id'] . "'");
      $updated_conf = tep_db_fetch_array($updated_conf_query);

      print json_encode(array(
        'updated_cols' => array(
          'cfgValue' => $_POST['configuration_value'],
          'last_modified' => tep_date_short($updated_conf['last_modified']),
        ),
        'modal' => array(
          'hide',
        ),
      ));
      exit;

      break;
  }
}
/*
 * Конец обработки параметров $_GET
 *
 *
 *
 *
 *
 *
 *
 *
 *
 */

/*
 *
 *
 *
 *
 *
 *
 *
 *
 *
 * Начало вывода HTML
 */
/**
 * header
 */
include_once('html-open.php');
include_once('header.php');

?>

<div class="modal fade" id="ajaxModal" tabindex="-1" role="dialog" aria-labelledby="ajaxModalLabel">
  <div class="modal-dialog" role="document">
  </div>
</div>

<!-- content -->

    <div class="container app-content-body p-b-none">
      <div class="hbox hbox-auto-xs hbox-auto-sm">
        <!-- main -->
        <div class="col">
          <div class="wrapper-md wrapper_767">
            <div class="bg-light lter ng-scope">
              <h1 class="m-n font-thin h3"><?php echo ($_GET['action'] == 'config' || $_GET['action'] == 'edit_config'? BOX_POLLS_CONFIG: HEADING_TITLE); ?></h1>
                <a class="ajax-modal ajax-modal-lg btn btn-default btn-xs green_plus" href="<?php print tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('action', 'info')) . 'action=new', 'NONSSL'); ?>" data-toggle="tooltip" data-placement="right" title="<?php print IMAGE_NEW_POLL; ?>">
                    <svg width="44px" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="#18bf49" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm144 276c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92h-92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z" class=""></path></svg>
                </a>
            </div>
          </div>

          <div class="wrapper-md wrapper_767">
            <?php

            /*
             * Если это страница "Настройки опросов"
             */
            if ($_GET['action'] == 'config' || $_GET['action'] == 'edit_config') {
              print get_polls_config_page_panel_html();
            } else {
              /*
               * Если это другая страница, например страница "Опросы"
               */
              print get_polls_page_panel_html();
            }

            ?>
          </div>
        </div>
      </div>
    </div>


<?php
/*
 * Конец вывода HTML
 */

/**
 * footer
 */
include_once('footer.php');
include_once('html-close.php');

?>

<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>

<?php

/**
 * Создает html панели страницы "Опросы"
 * @return string - готовый html панели страницы "Опросы"
 */
function get_polls_page_panel_html() {
  global $languages_id;

  ob_start();

  ?>

  <div class="panel panel-default">
<!--    <div class="table-responsive">-->
      <table class="table table-bordered table-hover table-condensed bg-white-only b-t b-light">
        <thead>
        <tr>
          <th class="text-center"><?php echo TABLE_HEADING_ID; ?></th>
          <th><?php echo TABLE_HEADING_TITLE; ?></th>
          <th class="text-center"><?php echo TABLE_HEADING_VOTES; ?></th>
          <th class="text-center"><?php echo TABLE_HEADING_CREATED; ?></th>
          <th class="text-center"><?php echo TABLE_HEADING_PUBLIC; ?></th>
          <th class="text-center"><?php echo TABLE_HEADING_OPEN; ?></th>
          <th class="text-center"><?php echo TABLE_HEADING_ACTION; ?></th>
        </tr>
        </thead>
        <tbody>
        <?php

        $poll_query_raw = "SELECT pollID, voters, timeStamp, poll_type, poll_open FROM ".TABLE_PHESIS_POLL_DESC." ORDER BY pollID ASC";
        $polls_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $poll_query_raw, $poll_query_numrows);
        $poll_query = tep_db_query($poll_query_raw);
        $rows = 0;
        while ($polls = tep_db_fetch_array($poll_query)) {
          $rows++;

          $title_query = tep_db_query("SELECT optionText FROM ".TABLE_PHESIS_POLL_DATA." WHERE voteid = '0' AND pollID = '" . $polls['pollID'] . "' AND language_id = '" . $languages_id . "'");
          $title = tep_db_fetch_array($title_query);

          ?>
          <tr>
            <td data-label="<?php echo TABLE_HEADING_ID; ?>" class="text-center col-name-pollID"><?php echo $polls['pollID']; ?></td>
            <td data-label="<?php echo TABLE_HEADING_TITLE; ?>" class="col-name-optionText"><?php echo $title['optionText']; ?></td>
            <td data-label="<?php echo TABLE_HEADING_VOTES; ?>" class="text-center col-name-voters"><?php echo $polls['voters']; ?></td>
            <td data-label="<?php echo TABLE_HEADING_CREATED; ?>" class="text-center col-name-timeStamp"><?php echo tep_date_short($polls['timeStamp']); ?></td>
            <td data-label="<?php echo TABLE_HEADING_PUBLIC; ?>" class="col-name-poll_type">
              <?php

              /*
               * Свич "Общедоступный опрос"
               */
              if ($polls['poll_type'] == 1) {
                $poll_is_public = '';
                $poll_title_text = ' data-toggle="tooltip" data-placement="right" title="' . _ALT_PUBLIC . '"';
              } else {
                $poll_is_public = ' checked';
                $poll_title_text = ' data-toggle="tooltip" data-placement="right" title="' . _ALT_PRIVATE . '"';
              }

              ?>
              <label class="bg-info ajax i-switch"<?php print $poll_title_text; ?>>
                <input type="checkbox" tabindex="0" data-href="<?php print tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('info', 'action', 'x', 'y')) . 'action=poll_type&info=' . $polls['pollID'], 'NONSSL'); ?>"<?php print $poll_is_public; ?>>
                <i></i>
              </label>
            </td>
            <td data-label="<?php echo TABLE_HEADING_OPEN; ?>" class="col-name-poll_open">
              <?php

              /*
               * Свич "Статус"
               *
               */
              if ($polls['poll_open'] == 1) {
                $poll_is_enabled = '';
                $poll_title_text = ' data-toggle="tooltip" data-placement="right" title="' . _ALT_REOPEN . '"';
              } else {
                $poll_is_enabled = ' checked';
                $poll_title_text = ' data-toggle="tooltip" data-placement="right" title="' . _ALT_CLOSE . '"';
              }

              ?>
              <label class="bg-info ajax i-switch"<?php print $poll_title_text; ?>>
                <input type="checkbox" tabindex="0" data-href="<?php print tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('info', 'action', 'x', 'y')) . 'action=poll_open&info=' . $polls['pollID'], 'NONSSL'); ?>"<?php print $poll_is_enabled; ?>>
                <i></i>
              </label>
            </td>
            <td data-label="<?php echo TABLE_HEADING_ACTION; ?>" class="text-center v-middle">
              <a class="ajax-modal ajax-modal-lg btn-link btn-link-icon" href="<?php print tep_href_link(FILENAME_POLLS,
                  tep_get_all_get_params(array('action', 'info', 'x', 'y')) . 'action=edit&cID=' . $polls['pollID'], 'NONSSL'); ?>" data-toggle="tooltip" data-placement="right" title="<?php print IMAGE_EDIT; ?>">
                <i class="fa fa-pencil"></i>
              </a>
              <a class="m-l-sm ajax-modal btn-link btn-link-icon" href="<?php print tep_href_link(FILENAME_POLLS,
                  tep_get_all_get_params(array('action', 'info', 'x', 'y')) . 'action=confirm&info=' . $polls['pollID'], 'NONSSL');?>" data-toggle="tooltip" data-placement="right" title="<?php print IMAGE_DELETE; ?>">
                <i class="fa fa-trash-o"></i>
              </a>
              <a class="m-l-sm ajax-modal btn-link btn-link-icon" href="<?php print tep_href_link('pollbooth.php', 'op=results&pollid=' . $polls['pollID'], 'NONSSL'); ?>" data-toggle="tooltip" data-placement="right" title="<?php print IMAGE_PREVIEW; ?>">
                <i class="fa fa-eye"></i>
              </a>
            </td>
          </tr>
          <?php
        }

        /*
         * Если ни одного опроса выведено не было, выводим уведомление об этом
         */
        if ($rows == 0) {
          ?>
          <tr><td colspan="7"><p class="m-b-none text-center"><?php print TEXT_POLL_NOPOLLS; ?></p></td></tr>
          <?php
        }

        ?>
        </tbody>
      </table>
<!--    </div>-->
    <footer class="panel-footer">
      <div class="row m-b">
        <div class="col-sm-6">
          <?php echo $polls_split->display_count($poll_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_POLLS); ?>
        </div>
        <div class="col-sm-6 text-right">
          <?php

          print $polls_split->new_display_links($poll_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']);

          ?>
        </div>
      </div>
    </footer>
  </div>

  <?php

  $html = ob_get_contents();
  ob_end_clean();

  return $html;
}

/**
 * Создает html панели страницы "Настройки опросов"
 * @return string - готовый html панели страницы "Настройки опросы"
 */
function get_polls_config_page_panel_html() {
  global $languages_id;

  ob_start();

  ?>

  <div class="panel panel-default">
<!--    <div class="table-responsive">-->
      <table class="table table-bordered table-hover table-condensed bg-white-only b-t b-light">
        <thead>
        <tr>
          <th><?php print TABLE_HEADING_CONFIGURATION_TITLE; ?></th>
          <th class="text-center"><?php print TABLE_HEADING_CONFIGURATION_VALUE; ?></th>
          <th class="text-center"><?php print trim(TEXT_INFO_DATE_ADDED, ':'); ?></th>
          <th class="text-center"><?php print trim(TEXT_INFO_LAST_MODIFIED, ':'); ?></th>
          <th class="text-center"><?php print TABLE_HEADING_ACTION; ?></th>
        </tr>
        </thead>
        <tbody>
        <?php

        $config_query = tep_db_query("SELECT configuration_id AS cfgID,
                                      configuration_title AS cfgTitle,
                                      configuration_description AS cfgDesc,
                                      configuration_key AS cfgKey,
                                      configuration_value AS cfgValue,
                                      date_added, last_modified
                                      FROM ".TABLE_PHESIS_POLL_CONFIG);
        $rows = 0;
        while ($config = tep_db_fetch_array($config_query)) {
          $rows++;

          ?>
          <tr>
            <td data-label="<?php echo TABLE_HEADING_CONFIGURATION_TITLE; ?>" class="col-name-cfgKey"><?php print constant(strtoupper($config['cfgKey'] . '_TITLE')); ?></td>
            <td data-label="<?php echo TABLE_HEADING_CONFIGURATION_VALUE; ?>" class="text-center col-name-cfgValue v-middle"><?php print $config['cfgValue']; ?></td>
            <td data-label="<?php print trim(TEXT_INFO_DATE_ADDED, ':'); ?>" class="text-center col-name-date_added v-middle"><?php print tep_date_short($config['date_added']); ?></td>
            <td data-label="<?php print trim(TEXT_INFO_LAST_MODIFIED, ':'); ?>" class="text-center col-name-last_modified v-middle"><?php print tep_date_short($config['last_modified']); ?></td>
            <td data-label="<?php echo TABLE_HEADING_ACTION; ?>" class="text-center v-middle">
              <a class="ajax-modal btn-link btn-link-icon" href="<?php print tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('action', 'info', 'configuration_id')) . 'action=edit_config&configuration_id='. $config['cfgID'], 'NONSSL'); ?>" data-toggle="tooltip" data-placement="right" title="<?php print IMAGE_EDIT; ?>">
                <i class="fa fa-pencil"></i>
              </a>
            </td>
          </tr>

          <?php
        }

        ?>
        </tbody>
      </table>
<!--    </div>-->
  </div>

  <?php

  $html = ob_get_contents();
  ob_end_clean();

  return $html;
}
