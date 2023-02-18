<?php
/*
  $Id: currencies.php,v 1.2 2003/09/24 13:57:05 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

require('includes/application_top.php');

require(DIR_WS_CLASSES . 'currencies.php');

$action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (tep_not_null($action)) {
    switch ($action) {

      case 'new':
      
        $contents = array('form' => tep_draw_form('currencies', FILENAME_CURRENCIES, 'page=' . $_GET['page'] . (isset($cInfo) ? '&cID=' . $cInfo->currencies_id : '') . '&action=insert'));
        $contents[] = array('text' => '<p>' . TEXT_INFO_INSERT_INTRO . '</p>');
        $contents[] = array(
            'text' => '<label class="control-label">' . TEXT_INFO_CURRENCY_TITLE . '</label>' . tep_draw_input_field('title', '', 'class="form-control"'),
            'wrapper_open' => '<div class="form-group">',
            'wrapper_close' => '</div>',
          );
        $contents[] = array(
            'text' => '<label class="control-label">' . TEXT_INFO_CURRENCY_CODE . '</label>' . tep_draw_input_field('code', '', 'class="form-control"'),
            'wrapper_open' => '<div class="form-group">',
            'wrapper_close' => '</div>',
          );
        $contents[] = array(
            'text' => '<label class="control-label">' . TEXT_INFO_CURRENCY_SYMBOL_LEFT . '</label>' . tep_draw_input_field('symbol_left', '', 'class="form-control"'),
            'wrapper_open' => '<div class="form-group">',
            'wrapper_close' => '</div>',
          );
        $contents[] = array(
            'text' => '<label class="control-label">' . TEXT_INFO_CURRENCY_SYMBOL_RIGHT . '</label>' . tep_draw_input_field('symbol_right', '', 'class="form-control"'),
            'wrapper_open' => '<div class="form-group">',
            'wrapper_close' => '</div>',
          );
        $contents[] = array(
            'text' => '<label class="control-label">' . TEXT_INFO_CURRENCY_DECIMAL_POINT . '</label>' . tep_draw_input_field('decimal_point', '', 'class="form-control"'),
            'wrapper_open' => '<div class="form-group">',
            'wrapper_close' => '</div>',
          );
        $contents[] = array(
            'text' => '<label class="control-label">' . TEXT_INFO_CURRENCY_THOUSANDS_POINT . '</label>' . tep_draw_input_field('thousands_point', '', 'class="form-control"'),
            'wrapper_open' => '<div class="form-group">',
            'wrapper_close' => '</div>',
          );
        $contents[] = array(
            'text' => '<label class="control-label">' . TEXT_INFO_CURRENCY_DECIMAL_PLACES . '</label>' . tep_draw_input_field('decimal_places', '', 'class="form-control"'),
            'wrapper_open' => '<div class="form-group">',
            'wrapper_close' => '</div>',
          );
        $contents[] = array(
            'text' => '<label class="control-label">' . TEXT_INFO_CURRENCY_VALUE . '</label>' . tep_draw_input_field('value', '', 'class="form-control m-b"'),
            'wrapper_open' => '<div class="form-group">',
            'wrapper_close' => '</div>',
          );
        $contents[] = array(
            'text' => new_tep_draw_checkbox_field('default', TEXT_INFO_SET_AS_DEFAULT),
            'wrapper_open' => '<div class="form-group">',
            'wrapper_close' => '</div>',
          );

        $params = array(
            'submitButton' => array('name' => IMAGE_INSERT, 'class' => 'ajax btn btn-success'),
            'cancelButton' => array('name' => IMAGE_CANCEL, 'class' => 'btn btn-default'),
          );

        ?>

        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo TEXT_CLOSE_BUTTON; ?>"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="editModalLabel"><?php print TEXT_INFO_HEADING_NEW_CURRENCY; ?></h4>
          </div>

          <?php

          $box = new box;
          print $box->newInfoBoxModal($contents, $params);

          ?>
        </div>
        <?php

        exit;
        break;

      case 'edit':

        $currencies_id = tep_db_prepare_input($_GET['cID']);
        $currency_query_raw = "select currencies_id, title, code, symbol_left, symbol_right, decimal_point, thousands_point, decimal_places, last_updated, value from " . TABLE_CURRENCIES . "  where currencies_id = '" . $currencies_id . "'";
        $currency_query = tep_db_query($currency_query_raw);
        $currency = tep_db_fetch_array($currency_query);
        $cInfo = new objectInfo($currency);

        $contents = array('form' => tep_draw_form('currencies', FILENAME_CURRENCIES, 'page=' . $_GET['page'] . '&cID=' . $cInfo->currencies_id . '&action=save'));
        $contents[] = array('text' => '<p>' . TEXT_INFO_EDIT_INTRO . '</p>');
        $contents[] = array(
            'text' => '<label class="control-label">' . TEXT_INFO_CURRENCY_TITLE . '</label>' . tep_draw_input_field('title', $cInfo->title, 'class="form-control"'),
            'wrapper_open' => '<div class="form-group">',
            'wrapper_close' => '</div>',
          );
        $contents[] = array(
            'text' => '<label class="control-label">' . TEXT_INFO_CURRENCY_CODE . '</label>' . tep_draw_input_field('code', $cInfo->code, 'class="form-control"'),
            'wrapper_open' => '<div class="form-group">',
            'wrapper_close' => '</div>',
          );
        $contents[] = array(
            'text' => '<label class="control-label">' . TEXT_INFO_CURRENCY_SYMBOL_LEFT . '</label>' . tep_draw_input_field('symbol_left', $cInfo->symbol_left, 'class="form-control"'),
            'wrapper_open' => '<div class="form-group">',
            'wrapper_close' => '</div>',
          );
        $contents[] = array(
            'text' => '<label class="control-label">' . TEXT_INFO_CURRENCY_SYMBOL_RIGHT . '</label>' . tep_draw_input_field('symbol_right', $cInfo->symbol_right, 'class="form-control"'),
            'wrapper_open' => '<div class="form-group">',
            'wrapper_close' => '</div>',
          );
        $contents[] = array(
            'text' => '<label class="control-label">' . TEXT_INFO_CURRENCY_DECIMAL_POINT . '</label>' . tep_draw_input_field('decimal_point', $cInfo->decimal_point, 'class="form-control"'),
            'wrapper_open' => '<div class="form-group">',
            'wrapper_close' => '</div>',
          );
        $contents[] = array(
            'text' => '<label class="control-label">' . TEXT_INFO_CURRENCY_THOUSANDS_POINT . '</label>' . tep_draw_input_field('thousands_point', $cInfo->thousands_point, 'class="form-control"'),
            'wrapper_open' => '<div class="form-group">',
            'wrapper_close' => '</div>',
          );
        $contents[] = array(
            'text' => '<label class="control-label">' . TEXT_INFO_CURRENCY_DECIMAL_PLACES . '</label>' . tep_draw_input_field('decimal_places', $cInfo->decimal_places, 'class="form-control"'),
            'wrapper_open' => '<div class="form-group">',
            'wrapper_close' => '</div>',
          );
        $contents[] = array(
            'text' => '<label class="control-label">' . TEXT_INFO_CURRENCY_VALUE . '</label>' . tep_draw_input_field('value', $cInfo->value, 'class="form-control m-b"'),
            'wrapper_open' => '<div class="form-group">',
            'wrapper_close' => '</div>',
          );
          if (DEFAULT_CURRENCY != $cInfo->code) {
          $contents[] = array(
              'text' => new_tep_draw_checkbox_field('default', TEXT_INFO_SET_AS_DEFAULT),
              'wrapper_open' => '<div class="form-group">',
              'wrapper_close' => '</div>',
            );
        }

        $params = array(
            'submitButton'  => array('name' => IMAGE_UPDATE, 'class' => 'ajax btn btn-info'),
            'cancelButton'  => array('name' => IMAGE_CANCEL, 'class' => 'btn btn-default'),
          );

        ?>
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo TEXT_CLOSE_BUTTON; ?>"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="editModalLabel"><?php print $cInfo->title; ?></h4>
          </div>

          <?php

          $box = new box;
          print $box->newInfoBoxModal($contents, $params);

          ?>

        </div>
        <?php

        exit;
        break;

      case 'insert':
      case 'save':
        if (isset($_GET['cID'])) $currency_id = tep_db_prepare_input($_GET['cID']);
        $title = tep_db_prepare_input($_POST['title']);
        $code = tep_db_prepare_input($_POST['code']);
        $symbol_left = tep_db_prepare_input($_POST['symbol_left']);
        $symbol_right = tep_db_prepare_input($_POST['symbol_right']);
        $decimal_point = tep_db_prepare_input($_POST['decimal_point']);
        $thousands_point = tep_db_prepare_input($_POST['thousands_point']);
        $decimal_places = (int) $_POST['decimal_places'];
        $value = tep_db_prepare_input($_POST['value']);

        $sql_data_array = array('title' => $title,
                                'code' => $code,
                                'symbol_left' => $symbol_left,
                                'symbol_right' => $symbol_right,
                                'decimal_point' => $decimal_point,
                                'thousands_point' => $thousands_point,
                                'decimal_places' => $decimal_places,
                                'value' => $value);

        $check = false;
        $default = false;
        $closeModal = false;

        if(empty($code) || ( $action == 'insert' && tep_db_num_rows(tep_db_query("SELECT code from ".TABLE_CURRENCIES." where code='".$code."'"))) > 0){
            $closeModal = true;
        }

        if ($action == 'insert' && !$closeModal) {
          tep_db_perform(TABLE_CURRENCIES, $sql_data_array);
          $currency_id = tep_db_insert_id();
          $check = true;
        } elseif ($action == 'save' && !$closeModal) {
          tep_db_perform(TABLE_CURRENCIES, $sql_data_array, 'update', "currencies_id = '" . (int)$currency_id . "'");
        }


        if( isset($_POST['default']) && ($_POST['default'] == 'on')  && !$closeModal) {
          tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '" . tep_db_input($code) . "' where configuration_key = 'DEFAULT_CURRENCY'");
//          tep_db_query("update " . TABLE_CURRENCIES . " set value = '1' where code = '" . tep_db_input($code) . "'");
          $check = true;
          $default = true;
        }

        if($check) {
          print json_encode(array(
            'updated_panel' => $default == true?get_currencies_page_panel_html($code):get_currencies_page_panel_html(),
            'ajax_type' => 'save',
            'modal' => array(
              'hide',
            ),
          ));
        } else {
          print json_encode(array(
            'updated_panel' => $default == true?get_currencies_page_panel_html($code):get_currencies_page_panel_html(),
            'modal' => array(
              'hide',
            ),
          ));
        }

        exit;
        break;

      case 'deleteconfirm':
        $currencies_id = tep_db_prepare_input($_POST['currencies_id']);

        $currency_query = tep_db_query("select currencies_id from " . TABLE_CURRENCIES . " where code = '" . DEFAULT_CURRENCY . "'");
        $currency = tep_db_fetch_array($currency_query);

        if ($currency['currencies_id'] == $currencies_id) {
          tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '' where configuration_key = 'DEFAULT_CURRENCY'");
        }

        tep_db_query("delete from " . TABLE_CURRENCIES . " where currencies_id = '" . (int)$currencies_id . "'");

        print json_encode(array(
          'updated_panel' => get_currencies_page_panel_html(),
          'modal' => array(
            'hide',
          ),
        ));

        exit;
        break;

      case 'delete':
        $currencies_id = tep_db_prepare_input($_GET['cID']);

        $currency_query = tep_db_query("select title, code from " . TABLE_CURRENCIES . " where currencies_id = '" . (int)$currencies_id . "'");
        $currency = tep_db_fetch_array($currency_query);
        $cInfo = new objectInfo($currency);

        $remove_currency = true;
        if ($currency['code'] == DEFAULT_CURRENCY) {
          $remove_currency = false;
          $messageStack->add(ERROR_REMOVE_DEFAULT_CURRENCY, 'error');
        }
        ?>

        <div class="modal-content">
          <div class="modal-header">
            <button class="close" type="button" data-dismiss="modal" aria-label="<?php echo TEXT_CLOSE_BUTTON; ?>">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="editModalLabel"><?php print !empty($cInfo->title)?$cInfo->title:HEADING_TITLE; ?></h4>
          </div>

          <div class="modal-body">
            <?php if($remove_currency) { ?>
              
              <?php print tep_draw_form('currencies', FILENAME_CURRENCIES, 'page=' . $_GET['page'] . '&action=deleteconfirm'); ?>
                <input type="hidden" name="currencies_id" value="<?php print $currencies_id; ?>">
                <p class="text-center m-b-none"><?php print TEXT_INFO_DELETE_INTRO ?></p>
              </form>

            <?php 
              } else {
                ?>
                <div class="alert alert-danger alert-dismissable m-b-none" type="danger">
                    <div><span class="ng-binding ng-scope"></span><?php print ERROR_REMOVE_DEFAULT_CURRENCY; ?></span></div>
                </div>
            <?php
              }
            ?>
          </div>

          <div class="modal-footer">
          <?php if( $remove_currency ) { ?>
            <button class="ajax btn btn-danger"><?php print IMAGE_DELETE; ?></button>
          <?php } ?>
            <button class="btn btn-default" data-dismiss="modal"><?php print IMAGE_CANCEL; ?></button>
          </div>
        </div>
      
      <?php
        exit;
        break;
    }
  }

/**
 * header
 */

include_once('html-open.php');
include_once('header.php');

?>

<div class="modal fade" id="ajaxModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
  <div class="modal-dialog modal-lg" role="document">
  </div>
</div>

<!-- content -->
    <div class="container app-content-body p-b-none">
      <div class="hbox hbox-auto-xs hbox-auto-sm">
        <!-- main -->
        <div class="col">

          <div class="wrapper-md wrapper_767">
            <div class="bg-light lter ng-scope">
              <h1 class="m-n font-thin h3"><?php echo HEADING_TITLE; ?></h1>
                <a class="ajax-modal btn btn-default btn-xs green_plus" href="<?php print tep_href_link(FILENAME_CURRENCIES, tep_get_all_get_params(array('action', 'info')) . 'action=new', 'NONSSL'); ?>">
                    <svg width="44px" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="#18bf49" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm144 276c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92h-92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z" class=""></path></svg>
                </a>
            </div>
          </div>

          <div class="wrapper-md wrapper_767">
            <?php echo get_currencies_page_panel_html(); ?>
          </div>

        </div>
      </div>
    </div>
<!-- /content -->

<?php

/**
 * footer
 */

include_once('footer.php');
include_once('html-close.php');

?>


<?php

/**
 * Создает html панели страницы "Валюты"
 * @return string - готовый html панели страницы "Валюты"
 */
function get_currencies_page_panel_html($code = DEFAULT_CURRENCY) {

  ob_start();
  ?>

  <div class="panel panel-default">
<!--    <div class="table-responsive">-->
      <table class="table table-bordered table-hover table-condensed bg-white-only b-t b-light">
        <thead>
          <tr>
            <th class="v-middle"><?php echo TABLE_HEADING_CURRENCY_NAME; ?></th>
            <th class="text-center v-middle" style="max-width: 50%;"><?php echo TABLE_HEADING_CURRENCY_CODES; ?></th>
            <th class="text-center v-middle"><?php echo TABLE_HEADING_CURRENCY_VALUE; ?></th>
            <th class="text-center v-middle"><?php print removeDoubleDotsAndSpaces(TEXT_INFO_CURRENCY_LAST_UPDATED); ?></th>
            <th class="text-center v-middle"><?php print removeDoubleDotsAndSpaces(TEXT_INFO_CURRENCY_EXAMPLE); ?></th>
            <th class="text-center v-middle"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</th>
          </tr>
        </thead>
        <tbody>

          <?php

            $currency_query_raw = "select currencies_id, title, code, symbol_left, symbol_right, decimal_point, thousands_point, decimal_places, last_updated, value from " . TABLE_CURRENCIES . " order by title";
            $currency_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $currency_query_raw, $currency_query_numrows);
            $currency_query = tep_db_query($currency_query_raw);
            
            while ($currency = tep_db_fetch_array($currency_query)) {
              
              if ((!isset($_GET['cID']) || (isset($_GET['cID']) && ($_GET['cID'] == $currency['currencies_id']))) && !isset($cInfo) && (substr($action, 0, 3) != 'new')) {
                $cInfo = new objectInfo($currency);
              }

              ?>
              <tr>
                <td data-label="<?php echo TABLE_HEADING_CURRENCY_NAME; ?>" class="col-name-title">
                <?php 
                    if ($code == $currency['code']) {
                      echo '<b>' . $currency['title'] . ' ' . '(' . TEXT_DEFAULT . ')</b>';
                    } else {
                      echo $currency['title'];
                    }
                ?>
                </td>
                <td data-label="<?php echo TABLE_HEADING_CURRENCY_CODES; ?>" class="text-center v-middle col-name-code"><?php echo $currency['code']; ?></td>
                <td data-label="<?php echo TABLE_HEADING_CURRENCY_VALUE; ?>" class="text-center v-middle col-name-value"><?php echo number_format($currency['value'], 8); ?></td>
                <td data-label="<?php print removeDoubleDotsAndSpaces(TEXT_INFO_CURRENCY_LAST_UPDATED); ?>" class="text-center v-middle col-name-last-updated">
                  <?php print tep_date_short($currency['last_updated']); ?>
                </td>
                <td data-label="<?php print removeDoubleDotsAndSpaces(TEXT_INFO_CURRENCY_EXAMPLE); ?>" class="text-center v-middle col-name-example">
                  <?php

                  $currencies = new currencies();

                  print $currencies->format('30', false, DEFAULT_CURRENCY) . ' = ' . $currencies->format('30', true, $currency['code']);

                  ?>
                </td>
                <td data-label="<?php echo TABLE_HEADING_ACTION; ?>" class="text-center v-middle">
                  
                  <a class="ajax-modal btn-link btn-link-icon" href="<?php print tep_href_link(FILENAME_CURRENCIES, 'page=' . $_GET['page'] .'&cID='. $currency['currencies_id'] . '&action=edit'); ?>" data-toggle="tooltip" data-placement="right" title="<?php print IMAGE_EDIT; ?>">
                    <i class="fa fa-pencil"></i>
                  </a>

                  <a class="ajax-modal m-l-sm btn-link btn-link-icon" href="<?php echo tep_href_link(FILENAME_CURRENCIES, 'page=' . $_GET['page'] . '&cID=' . $currency['currencies_id'] . '&action=delete'); ?>" data-toggle="tooltip" data-placement="right" title="<?php print IMAGE_DELETE; ?>">
                    <i class="fa fa-trash-o"></i>
                  </a>

                </td>
              </tr>                
              <?php
            }
          ?>
        </tbody>
      </table>
<!--    </div>-->
    <footer class="panel-footer">
      <div class="row m-b">
        <div class="col-sm-6">
          <?php echo $currency_split->display_count($currency_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_CURRENCIES);?>
        </div>
        <div class="col-sm-6 text-right">
          <?php

          echo $currency_split->new_display_links($currency_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']);

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
?>

<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
