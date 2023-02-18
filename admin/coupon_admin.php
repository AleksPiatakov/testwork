<?php
/*
$Id: coupon_admin.php,v 1.2 2003/09/24 13:57:05 wilt Exp $

osCommerce, Open Source E-Commerce Solutions
http://www.oscommerce.com
Copyright (c) 2003 osCommerce

Released under the GNU General Public License
*/

require('includes/application_top.php');
require(DIR_WS_CLASSES . 'currencies.php');
$currencies = new currencies();

if (CUPONES_MODULE_ENABLED == 'false') {
    tep_redirect(tep_href_link(FILENAME_DEFAULT));
} // если в данном магазине нет такого модуля то перекидываем на главную

include(DIR_FS_CATALOG . 'ext/coupons/coupon_admin.php');

?>

<?php

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
 * Начало обработки параметров $_GET
 */
switch ($_GET['action']) {
    case 'send_email_to_user':

        print json_encode(array(
            'modal' => array(
                'hide',
            ),
        ));

        exit;
        break;

    case 'update_confirm':
        unset($_GET['cid']);
        unset($_GET['oldaction']);

        print json_encode(array(
            'updated_panel' => get_coupon_admin_page_panel_html(),
            'modal' => array(
                'hide',
            ),
        ));

        exit;
        break;

    case 'confirmdelete':

        $coupon_id = $_POST['cid'];
        //$delete_query=tep_db_query("update " . TABLE_COUPONS . " set coupon_active = 'N' where coupon_id='".$coupon_id."'");
        $delete_query = tep_db_query("delete from " . TABLE_COUPONS . " where coupon_id='" . $coupon_id . "'");

        print json_encode(array(
            'updated_panel' => get_coupon_admin_page_panel_html(),
            'modal' => array(
                'hide',
            ),
        ));

        exit;
        break;

    case 'voucherdelete':
        global $languages_id;

        $coupon_query = tep_db_query("select * from " . TABLE_COUPONS . " where coupon_id = '" . $_GET['cid'] . "'");
        $coupon_result = tep_db_fetch_array($coupon_query);
        $coupon_name_query = tep_db_query("select coupon_name from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $_GET['cid'] . "' and language_id = '" . $languages_id . "'");
        $coupon_name = tep_db_fetch_array($coupon_name_query);
        $cInfo = new objectInfo($coupon_result);

        ?>

        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="<?php echo TEXT_CLOSE_BUTTON; ?>">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="ajaxModalLabel"><?php print !empty($coupon_name['coupon_name']) ? $coupon_name['coupon_name'] : HEADING_TITLE; ?></h4>
            </div>

            <div class="modal-body">
                <form action="<?php print tep_href_link(FILENAME_COUPON_ADMIN, tep_get_all_get_params(array('action')) . 'action=confirmdelete', 'NONSSL'); ?>" method="post">
                    <input type="text" hidden value="<?php print $_GET['cid'] ?>" name="cid">
                    <p class="text-center m-b-none"><?php print TEXT_CONFIRM_DELETE; ?></p>
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

    case 'voucherreport':
        global $languages_id;

        $coupon_query = tep_db_query("SELECT * FROM " . TABLE_COUPONS . " WHERE coupon_id = '" . $_GET['cid'] . "'");
        $coupon_result = tep_db_fetch_array($coupon_query);
        $coupon_name_query = tep_db_query("SELECT coupon_name FROM " . TABLE_COUPONS_DESCRIPTION . " WHERE coupon_id = '" . $_GET['cid'] . "' AND language_id = '" . $languages_id . "'");
        $coupon_name = tep_db_fetch_array($coupon_name_query);

        ?>

        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="<?php echo TEXT_CLOSE_BUTTON; ?>">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="ajaxModalLabel"><?php print !empty($coupon_name['coupon_name']) ? $coupon_name['coupon_name'] : HEADING_TITLE; ?></h4>
            </div>
            <?php

            $cc_query_raw = "SELECT * FROM " . TABLE_COUPON_REDEEM_TRACK . " WHERE coupon_id = '" . $_GET['cid'] . "'";
            $cc_query = tep_db_query($cc_query_raw);

            ?>
            <div class="modal-body">
                <p class="m-b-none"><?php print TEXT_REDEMPTIONS_TOTAL . ': ' . tep_db_num_rows($cc_query); ?></p>
                <?php

                if (tep_db_num_rows($cc_query) > 0) {
                    ?>
                    <table class="table table-hover table-condensed bg-white-only b-t b-light m-t m-b-none">
                        <thead>
                        <tr>
                            <th class="v-middle"><?php echo CUSTOMER_ID; ?></th>
                            <th class="text-center v-middle"><?php echo CUSTOMER_NAME; ?></th>
                            <th class="text-center v-middle"><?php echo IP_ADDRESS; ?></th>
                            <th class="text-center v-middle"><?php echo REDEEM_DATE; ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        $rows = 0;
                        while ($cc_list = tep_db_fetch_array($cc_query)) {
                            $rows++;

                            if (strlen($rows) < 2) {
                                $rows = '0' . $rows;
                            }

                            $cInfo = new objectInfo($cc_list);
                            $count_customers = tep_db_query("SELECT * FROM " . TABLE_COUPON_REDEEM_TRACK . " WHERE coupon_id = '" . $_GET['cid'] . "' AND customer_id = '" . $cInfo->customer_id . "'");

                            $dataTool = TEXT_REDEMPTIONS_CUSTOMER . ': ' . tep_db_num_rows($count_customers);

                            ?>
                            <tr data-toggle="tooltip" title="<?php print $dataTool ?>">
                                <?php

                                $customer_query = tep_db_query("SELECT customers_firstname, customers_lastname FROM " . TABLE_CUSTOMERS . " WHERE customers_id = '" . $cc_list['customer_id'] . "'");
                                $customer = tep_db_fetch_array($customer_query);

                                ?>
                                <td class="v-middle"><?php echo $cc_list['customer_id']; ?></td>
                                <td class="text-center v-middle"><?php echo $customer['customers_firstname'] . ' ' . $customer['customers_lastname']; ?></td>
                                <td class="text-center v-middle"><?php echo $cc_list['redeem_ip']; ?></td>
                                <td class="text-center v-middle"><?php echo tep_date_short($cc_list['redeem_date']); ?></td>
                            </tr>
                            <?php
                        }

                        ?>
                        </tbody>
                    </table>
                    <?php
                }

                ?>

            </div>

            <div class="modal-footer">
                <button class="btn btn-info" data-dismiss="modal"><?php print TEXT_MODAL_CONTINUE_ACTION; ?></button>
            </div>
        </div>

        <?php

        exit;
        break;

    case 'preview_email':
        $coupon_query = tep_db_query("select coupon_code from " . TABLE_COUPONS . " where coupon_id = '" . $_GET['cid'] . "'");
        $coupon_result = tep_db_fetch_array($coupon_query);
        $coupon_name_query = tep_db_query("select coupon_name from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $_GET['cid'] . "' and language_id = '" . $languages_id . "'");
        $coupon_name = tep_db_fetch_array($coupon_name_query);

        switch ($_POST['customers_email_address']) {
            case '***':
                $mail_sent_to = TEXT_ALL_CUSTOMERS;
                break;
            case '**D':
                $mail_sent_to = TEXT_NEWSLETTER_CUSTOMERS;
                break;
            default:
                $mail_sent_to = $_POST['customers_email_address'];
                break;
        }

        ?>

        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="<?php echo TEXT_CLOSE_BUTTON; ?>">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="ajaxModalLabel"><?php print !empty($coupon_name['coupon_name']) ? $coupon_name['coupon_name'] : HEADING_TITLE; ?></h4>
            </div>

            <div class="modal-body">
                <?php echo tep_draw_form('mail', FILENAME_COUPON_ADMIN, 'action=send_email_to_user&cid=' . $_GET['cid'], 'post', 'class="form-horizontal"'); ?>
                <div class="form-group">
                    <label class="col-lg-3 font-bold"><?php echo TEXT_CUSTOMER; ?></label>
                    <div class="col-lg-9"><?php echo $mail_sent_to; ?></div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 font-bold"><?php echo TEXT_FROM; ?></label>
                    <div class="col-lg-9"><?php echo htmlspecialchars(stripslashes($_POST['from'])); ?></div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 font-bold"><?php echo TEXT_SUBJECT; ?></label>
                    <div class="col-lg-9"><?php echo htmlspecialchars(stripslashes($_POST['subject'])); ?></div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 font-bold"><?php echo TEXT_MESSAGE; ?></label>
                    <div class="col-lg-9"><?php echo htmlspecialchars(stripslashes($_POST['message'])); ?></div>
                </div>
                <?php

                /* Re-Post all POST'ed variables */
                reset($_POST);
                foreach ($_POST as $key => $value) {
                    // while (list($key, $value) = each($_POST)) {
                    if (!is_array($_POST[$key])) {
                        echo tep_draw_hidden_field($key, htmlspecialchars(stripslashes($value)));
                    }
                }

                ?>
                </form>
            </div>

            <div class="modal-footer">
                <button class="ajax btn btn-info"><?php print IMAGE_SEND_EMAIL; ?></button>
                <button class="btn btn-default" data-dismiss="modal"><?php print IMAGE_CANCEL; ?></button>
            </div>
        </div>

        <?php

        exit;
        break;

    case 'email':
        $coupon_query = tep_db_query("select coupon_code from " . TABLE_COUPONS . " where coupon_id = '" . $_GET['cid'] . "'");
        $coupon_result = tep_db_fetch_array($coupon_query);
        $coupon_name_query = tep_db_query("select coupon_name from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $_GET['cid'] . "' and language_id = '" . $languages_id . "'");
        $coupon_name = tep_db_fetch_array($coupon_name_query);

        ?>
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="<?php echo TEXT_CLOSE_BUTTON; ?>">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="ajaxModalLabel"><?php print !empty($coupon_name['coupon_name']) ? $coupon_name['coupon_name'] : HEADING_TITLE; ?></h4>
            </div>

            <div class="modal-body">
                <?php

                if (isset($_POST['customers_email_address']) && empty($_POST['customers_email_address'])) {
                    ?>
                    <div class="alert alert-danger alert-dismissable">
                        <div><span><?php print ERROR_NO_CUSTOMER_SELECTED; ?></span></div>
                    </div>
                    <?php
                }

                ?>

                <?php print tep_draw_form('mail', FILENAME_COUPON_ADMIN, 'action=preview_email&cid=' . $_GET['cid'], 'post', 'class="form-horizontal"'); ?>
                <?php

                $customers = array();
                $customers[] = array('id' => '', 'text' => TEXT_SELECT_CUSTOMER);
                $customers[] = array('id' => '***', 'text' => TEXT_ALL_CUSTOMERS);
                $customers[] = array('id' => '**D', 'text' => TEXT_NEWSLETTER_CUSTOMERS);
                $mail_query = tep_db_query("select customers_email_address, customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " order by customers_lastname");

                while ($customers_values = tep_db_fetch_array($mail_query)) {
                    $customers[] = array(
                        'id' => $customers_values['customers_email_address'],
                        'text' => $customers_values['customers_lastname'] . ', ' . $customers_values['customers_firstname'] . ' (' . $customers_values['customers_email_address'] . ')'
                    );
                }

                ?>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo TEXT_CUSTOMER; ?></label>
                    <div class="col-lg-9"><?php print new_tep_draw_pull_down_menu('customers_email_address', $customers, $_GET['customer']); ?></div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo TEXT_FROM; ?></label>
                    <div class="col-lg-9"><?php print tep_draw_input_field('from', STORE_OWNER_EMAIL_ADDRESS, 'class="form-control"'); ?></div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo TEXT_SUBJECT; ?></label>
                    <div class="col-lg-9"><?php print tep_draw_input_field('subject', '', 'class="form-control"'); ?></div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo TEXT_MESSAGE; ?></label>
                    <div class="col-lg-9"><?php print tep_draw_textarea_field('message', 'soft', '60', '15', '', 'class="form-control"'); ?></div>
                </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="ajax-modal btn btn-info"><?php print IMAGE_SEND_EMAIL; ?></button>
                <button class="btn btn-default" data-dismiss="modal"><?php print 'Cancel'; ?></button>
            </div>
        </div>

        <?php

        exit;
        break;

    case 'update_preview':
        ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo TEXT_CLOSE_BUTTON; ?>"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"
                    id="ajaxModalLabel"><?php print $_GET['oldaction'] != 'new' && !empty($_POST['coupon_name'][$languages_id]) ? $_POST['coupon_name'][$languages_id] : HEADING_TITLE; ?></h4>
            </div>

            <div class="modal-body">
                <?php echo tep_draw_form('coupon', 'coupon_admin.php', 'action=update_confirm&oldaction=' . $_GET['oldaction'] . '&cid=' . $_GET['cid'], 'post', 'class="form-horizontal"'); ?>
                <div class="form-group">
                    <label class="col-lg-7"><?php echo COUPON_NAME; ?></label>
                    <div class="col-lg-5">
                        <div class="tab-container">
                            <ul class="nav nav-tabs">
                                <?php

                                $languages = tep_get_languages();
                                $sorted_languages = array(
                                    $languages_id => array(),
                                );
                                foreach ($languages AS $lang) {
                                    $sorted_languages[$lang['id']] = $lang;
                                }

                                foreach ($sorted_languages AS $lang_id => $lang) {
                                    $active_tab = $languages_id == $lang['id'] ? 'active' : ' ';

                                    ?>
                                    <li class="<?php print $active_tab; ?>">
                                        <a href="#<?php print $lang['code']; ?>1" data-toggle="tab">
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
                                    $active_tab = $languages_id == $lang['id'] ? ' active ' : ' ';

                                    ?>
                                    <div id="<?php print $lang['code']; ?>1" class="tab-pane fade<?php print $active_tab; ?>in">
                                        <?php echo $_POST['coupon_name'][$lang['id']] . '&nbsp;'; ?>
                                    </div>
                                    <?php
                                }

                                ?>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-7"><?php echo COUPON_DESC; ?></label>
                    <div class="col-lg-5">
                        <div class="tab-container">
                            <ul class="nav nav-tabs">
                                <?php

                                $languages = tep_get_languages();
                                $sorted_languages = array(
                                    $languages_id => array(),
                                );
                                foreach ($languages AS $lang) {
                                    $sorted_languages[$lang['id']] = $lang;
                                }

                                foreach ($sorted_languages AS $lang_id => $lang) {
                                    $active_tab = $languages_id == $lang['id'] ? 'active' : ' ';

                                    ?>
                                    <li class="<?php print $active_tab; ?>">
                                        <a href="#<?php print $lang['code']; ?>2" data-toggle="tab">
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
                                    $active_tab = $languages_id == $lang['id'] ? ' active ' : ' ';

                                    ?>
                                    <div id="<?php print $lang['code']; ?>2" class="tab-pane fade<?php print $active_tab; ?>in">
                                        <?php echo $_POST['coupon_desc'][$lang['id']] . '&nbsp;'; ?>
                                    </div>
                                    <?php
                                }

                                ?>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-7"><?php echo COUPON_AMOUNT; ?></label>
                    <div class="col-lg-5"><?php echo $_POST['coupon_amount']; ?></div>
                </div>
                <div class="form-group">
                    <label class="col-lg-7"><?php echo COUPON_MIN_ORDER; ?></label>
                    <div class="col-lg-5"><?php echo $_POST['coupon_min_order']; ?></div>
                </div>
                <div class="form-group">
                    <label class="col-lg-7"><?php echo COUPON_FREE_SHIP; ?></label>
                    <div class="col-lg-5"><?php echo $_POST['coupon_free_ship'] ? TEXT_FREE_SHIPPING : TEXT_NO_FREE_SHIPPING; ?></div>
                </div>
                <div class="form-group">
                    <label class="col-lg-7"><?php echo COUPON_CODE; ?></label>
                    <div class="col-lg-5">
                        <?php

                        if ($_POST['coupon_code']) {
                            $c_code = $_POST['coupon_code'];
                        } else {
                            $c_code = $coupon_code;
                        }

                        echo $c_code;

                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-7"><?php echo COUPON_USES_COUPON; ?></label>
                    <div class="col-lg-5"><?php echo $_POST['coupon_uses_coupon']; ?></div>
                </div>
                <div class="form-group">
                    <label class="col-lg-7"><?php echo COUPON_USES_USER; ?></label>
                    <div class="col-lg-5"><?php echo $_POST['coupon_uses_user']; ?></div>
                </div>
                <div class="form-group">
                    <label class="col-lg-7"><?php echo COUPON_PRODUCTS; ?></label>
                    <div class="col-lg-5"><?php echo $_POST['coupon_products']; ?></div>
                </div>
                <div class="form-group">
                    <label class="col-lg-7"><?php echo COUPON_CATEGORIES; ?></label>
                    <div class="col-lg-5"><?php echo $_POST['coupon_categories']; ?></div>
                </div>
                <div class="form-group">
                    <label class="col-lg-7"><?php echo COUPON_STARTDATE; ?></label>
                    <div class="col-lg-5">
                        <?php

                        $start_date = date(DATE_FORMAT, mktime(0, 0, 0, $_POST['coupon_startdate_month'], $_POST['coupon_startdate_day'], $_POST['coupon_startdate_year']));
                        echo $start_date;

                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-7"><?php echo COUPON_FINISHDATE; ?></label>
                    <div class="col-lg-5">
                        <?php

                        $finish_date = date(DATE_FORMAT, mktime(0, 0, 0, $_POST['coupon_finishdate_month'], $_POST['coupon_finishdate_day'], $_POST['coupon_finishdate_year']));
                        echo $finish_date;

                        ?>
                    </div>
                </div>

                <?php

                $languages = tep_get_languages();
                for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                    $language_id = $languages[$i]['id'];
                    echo tep_draw_hidden_field('coupon_name[' . $languages[$i]['id'] . ']', $_POST['coupon_name'][$language_id]);
                    echo tep_draw_hidden_field('coupon_desc[' . $languages[$i]['id'] . ']', $_POST['coupon_desc'][$language_id]);
                }

                echo tep_draw_hidden_field('coupon_amount', $_POST['coupon_amount']);
                echo tep_draw_hidden_field('coupon_min_order', $_POST['coupon_min_order']);
                echo tep_draw_hidden_field('coupon_free_ship', $_POST['coupon_free_ship']);
                echo tep_draw_hidden_field('coupon_code', $c_code);
                echo tep_draw_hidden_field('coupon_uses_coupon', $_POST['coupon_uses_coupon']);
                echo tep_draw_hidden_field('coupon_uses_user', $_POST['coupon_uses_user']);
                echo tep_draw_hidden_field('coupon_products', $_POST['coupon_products']);
                echo tep_draw_hidden_field('coupon_categories', $_POST['coupon_categories']);
                echo tep_draw_hidden_field('coupon_startdate', date('Y-m-d', mktime(0, 0, 0, $_POST['coupon_startdate_month'], $_POST['coupon_startdate_day'], $_POST['coupon_startdate_year'])));
                echo tep_draw_hidden_field('coupon_finishdate', date('Y-m-d', mktime(0, 0, 0, $_POST['coupon_finishdate_month'], $_POST['coupon_finishdate_day'], $_POST['coupon_finishdate_year'])));

                ?>
                </form>
            </div>

            <div class="modal-footer">
                <button class="ajax btn <?php print $_GET['oldaction'] == 'new' ? 'btn-success' : 'btn-info'; ?>"><?php print COUPON_BUTTON_CONFIRM; ?></button>
                <button class="ajax-modal ajax-modal-lg btn btn-default"
                        data-href="<?php print tep_href_link('coupon_admin.php', 'action=voucheredit&cid=' . $_GET['cid']); ?>"><?php print COUPON_BUTTON_BACK; ?></button>
            </div>
        </div>
        <?php

        exit;
        break;

    case 'voucheredit':
        $languages = tep_get_languages();
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
            $language_id = $languages[$i]['id'];
            $coupon_query = tep_db_query("select coupon_name,coupon_description from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $_GET['cid'] . "' and language_id = '" . $language_id . "'");
            $coupon = tep_db_fetch_array($coupon_query);
            $coupon_name[$language_id] = $coupon['coupon_name'];
            $coupon_desc[$language_id] = $coupon['coupon_description'];
        }
        $coupon_query = tep_db_query("select coupon_code, coupon_amount, coupon_type, coupon_minimum_order, coupon_start_date, coupon_expire_date, uses_per_coupon, uses_per_user, restrict_to_products, restrict_to_categories from " . TABLE_COUPONS . " where coupon_id = '" . $_GET['cid'] . "'");
        $coupon = tep_db_fetch_array($coupon_query);
        $coupon_amount = (string)cutToFirstSignificantDigit($coupon['coupon_amount']);
        if (strpos($coupon['coupon_type'], 'P') !== false) {
            $coupon_amount .= '%';
        }
        if (strpos($coupon['coupon_type'], 'S') !== false) {
            $coupon_free_ship = true;
        }
        if (strpos($coupon['coupon_type'], 'E') !== false) {
            $coupon_for_every_product = true;
        }
        $coupon_min_order = (string)cutToFirstSignificantDigit($coupon['coupon_minimum_order']);

        $coupon_code = $coupon['coupon_code'];
        $coupon_uses_coupon = $coupon['uses_per_coupon'];
        $coupon_uses_user = $coupon['uses_per_user'];
        $coupon_products = $coupon['restrict_to_products'];
        $coupon_categories = $coupon['restrict_to_categories'];

        $coupon_start_date = $coupon['coupon_start_date'];
        $coupon_expire_date = $coupon['coupon_expire_date'];

    case 'new':

        // set some defaults
        if (!$coupon_uses_user) {
            $coupon_uses_user = 0;
        }

        ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo TEXT_CLOSE_BUTTON; ?>"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="ajaxModalLabel"><?php print !empty($coupon_name[$languages_id]) ? $coupon_name[$languages_id] : HEADING_TITLE; ?></h4>
            </div>

            <div class="modal-body">
                <?php

                if (isset($_GET['errors'])) {
                    foreach ($_GET['errors'] AS $i => $error) {
                        ?>
                        <div class="alert alert-danger alert-dismissable fade in text-left m-b-xs">
                            <button class="close" type="button" data-dismiss="alert">
                                <span>×</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <div>
                                <span><?php print $error; ?></span>
                            </div>
                        </div>
                        <?php
                    }
                }

                ?>

                <!--        <form class="form-horizontal text-center" name="coupon" action="-->
                <?php //print tep_href_link('coupon_admin.php', tep_get_all_get_params(array('cID','action','oldaction')) . 'action=update&oldaction=' . $_GET['action'], 'NONSSL');
                ?><!--" method="post">-->
                <form class="form-horizontal text-center" name="coupon"
                      action="<?php print tep_href_link('coupon_admin.php', tep_get_all_get_params(array('cID', 'action', 'oldaction')) . 'action=update_confirm&oldaction=' . $_GET['action'],
                          'NONSSL'); ?>" method="post">
                    <div class="form-group">
                        <label class="col-md-6 control-label">
                            <?php print COUPON_NAME; ?>
                        </label>
                        <div class="col-md-6">
                            <div class="tab-container">
                                <ul class="nav nav-tabs admin-coupon-language-box">
                                    <?php

                                    $languages = tep_get_languages();
                                    $sorted_languages = array(
                                        $languages_id => array(),
                                    );
                                    foreach ($languages AS $lang) {
                                        $sorted_languages[$lang['id']] = $lang;
                                    }

                                    foreach ($sorted_languages AS $lang_id => $lang) {
                                        $active_tab = $languages_id == $lang['id'] ? 'active' : ' ';

                                        ?>
                                        <li class="<?php print $active_tab; ?>">
                                            <a href="#<?php print $lang['code']; ?>1" data-toggle="tab">
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
                                        $active_tab = $languages_id == $lang['id'] ? ' active ' : ' ';

                                        ?>
                                        <div id="<?php print $lang['code']; ?>1" class="tab-pane fade<?php print $active_tab; ?>in">
                                            <?php

                                            print tep_draw_input_field('coupon_name[' . $lang['id'] . ']', $coupon_name[$lang['id']],
                                                'class="form-control" data-toggle="tooltip" title="' . COUPON_NAME_HELP . '"');

                                            ?>
                                        </div>
                                        <?php
                                    }

                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-6 control-label">
                            <?php echo COUPON_CODE; ?>
                        </label>
                        <div class="col-md-6">
                            <?php echo tep_draw_input_field('coupon_code', $coupon_code, 'class="form-control" data-toggle="tooltip" title="' . COUPON_CODE_HELP . '"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-6 control-label">
                            <?php echo COUPON_AMOUNT; ?>
                        </label>
                        <div class="col-md-6">
                            <?php echo tep_draw_input_field('coupon_amount', $coupon_amount, 'class="form-control" data-toggle="tooltip" title="' . htmlspecialchars(COUPON_AMOUNT_HELP) . '"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-6 control-label">
                            <?php echo COUPON_MIN_ORDER; ?>
                        </label>
                        <div class="col-md-6">
                            <?php echo tep_draw_input_field('coupon_min_order', $coupon_min_order, 'class="form-control" data-toggle="tooltip" title="' . COUPON_MIN_ORDER_HELP . '"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-6 control-label">
                            <?php echo COUPON_FREE_SHIP; ?>
                        </label>
                        <div class="col-md-6 text-left">
                            <?php echo new_tep_draw_checkbox_field('coupon_free_ship', $coupon_free_ship, false, '',
                                'class="form-control" data-toggle="tooltip" title="' . htmlspecialchars(COUPON_FREE_SHIP_HELP) . '"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-6 control-label">
                            <?php echo COUPON_FOR_EVERY_PRODUCT; ?>
                        </label>
                        <div class="col-md-6 text-left">
                            <?php echo new_tep_draw_checkbox_field('coupon_for_every_product', $coupon_for_every_product, false, '',
                                'class="form-control" data-toggle="tooltip" title="' . htmlspecialchars(COUPON_FOR_EVERY_PRODUCT_HELP) . '"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-6 control-label">
                            <?php echo COUPON_USES_COUPON; ?>
                        </label>
                        <div class="col-md-6">
                            <?php echo tep_draw_input_field('coupon_uses_coupon', $coupon_uses_coupon, 'class="form-control" data-toggle="tooltip" title="' . COUPON_USES_COUPON_HELP . '"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-6 control-label">
                            <?php echo COUPON_USES_USER; ?>
                        </label>
                        <div class="col-md-6">
                            <?php echo tep_draw_input_field('coupon_uses_user', $coupon_uses_user, 'class="form-control" data-toggle="tooltip" title="' . COUPON_USES_USER_HELP . '"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-6 control-label">
                            <?php echo COUPON_PRODUCTS; ?>
                        </label>
                        <div class="col-md-6">
                            <?php echo tep_draw_input_field('coupon_products', $coupon_products, 'class="form-control" data-toggle="tooltip" title="' . COUPON_PRODUCTS_HELP . '"'); ?>
                            <a href="validproducts.php" target="_blank"
                               onclick="window.open('validproducts.php', 'Valid_Products', 'scrollbars=yes,resizable=yes,menubar=yes,width=600,height=600'); return false">
                            </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-6 control-label">
                            <?php echo COUPON_CATEGORIES; ?>
                        </label>
                        <div class="col-md-6">
                            <select multiple="" size="7" name="coupon_categories_select" id="coupon_categories_select" class="form-control">
                                <?php
                                $cats_array = array_map(function ($a) {
                                    return trim($a);
                                }, explode(',', $coupon_categories));
                                ?>
                                <option value="" <?= (empty($cats_array) || (in_array('', $cats_array)) ? 'selected' : ''); ?>>
                                    -
                                </option>
                                <?php
                                foreach ($tep_get_category_tree as $cat) {
                                    ?>
                                    <option value="<?= $cat['id'] ?>" <?= ((in_array($cat['id'], $cats_array)) ? 'selected' : ''); ?>>
                                        <?= str_repeat("&nbsp", $cat['level']) . $cat['text'] ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                            <?php echo tep_draw_hidden_field('coupon_categories', $coupon_categories, 'class="form-control" data-toggle="tooltip" title="' . COUPON_CATEGORIES_HELP . '"'); ?>
                            <a href="validcategories.php" target="_blank"
                               onclick="window.open('validcategories.php', 'Valid_Categories', 'scrollbars=yes,resizable=yes,menubar=yes,width=600,height=600'); return false">
                            </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-6 control-label">
                            <?php echo COUPON_STARTDATE; ?>
                        </label>
                        <div class="col-md-6 text-left">
                            <div class="form-inline inline" data-toggle="tooltip" title="<?php print COUPON_STARTDATE_HELP; ?>">
                                <?php print tep_draw_input_field('coupon_startdate', date_format(new DateTime($coupon_start_date), 'Y-m-d'), 'class="form-control m-r-xs"', true, 'date'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-6 control-label">
                            <?php echo COUPON_FINISHDATE; ?>
                        </label>
                        <div class="col-md-6 text-left">
                            <div class="form-inline inline" data-toggle="tooltip" title="<?php print COUPON_FINISHDATE_HELP; ?>">
                                <?php print tep_draw_input_field('coupon_finishdate', date_format(new DateTime($coupon_expire_date), 'Y-m-d'), 'class="form-control m-r-xs"', true, "date"); ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <!--        <button class="modal-preview-btn ajax-modal btn --><?php //print $_GET['action'] == 'new' && $_GET['oldaction'] != 'voucheredit'?'btn-success':'btn-info';
                ?><!--">--><?php //print COUPON_BUTTON_PREVIEW;
                ?><!--</button>-->
                <button class="modal-preview-btn ajax btn <?php print $_GET['action'] == 'new' && $_GET['oldaction'] != 'voucheredit' ? 'btn-success' : 'btn-info'; ?>"><?php print COUPON_BUTTON_CONFIRM; ?></button>
                <button class="btn btn-default" data-dismiss="modal"><?php print IMAGE_CANCEL; ?></button>
            </div>

            <script>
                $('input[name=coupon_products]').autocomplete({
                    source: function (request, response) {
                        $.ajax({
                            type: 'GET',
                            url: '<?=DIR_WS_EXT?>coupons/ajax.php',
                            data: {
                                't': 'p',
                                'term': $('input[name=coupon_products]').val().split(',').pop().trim(),
                                'lang': <?=$languages_id?>
                            },
                            dataType: 'json',
                            success: function (jsonData) {
                                response(jsonData);
                            }
                        });
                    },
                    delay: 0,
                    minLength: 2,
                    open: function () {
                        $(this).autocomplete("widget")
                            .appendTo("#autocomplete-results")
                            .css("position", "static")
                    },
                    focus: function (event, ui) {
                        $(this).attr("placeholder", ui.item.label);
                        return false;
                    },
                    select: function (event, ui) {
                        event.preventDefault();
                        let id = ui.item.products_id;
                        let text = $('input[name=coupon_products]').val();
                        let text_arr = text.split(',');
                        text_arr.pop();
                        $('input[name=coupon_products]').val((text_arr.join(',') + ',' + id));
                        if ($('input[name=coupon_products]').val().substr(0, 1) == ',') {
                            $('input[name=coupon_products]').val($('input[name=coupon_products]').val().substr(1))
                        }

                    }
                }).autocomplete("instance")._renderItem = function (ul, item) {
                    ul.css('z-index', 9999);
                    return $("<li>")
                        .append("<div>(" + item.products_id + ") " + item.products_model + " " + item.products_name + "</div>")
                        .appendTo(ul);
                };
                $(document).on('change', '#coupon_categories_select', function () {
                    if ($(this).val())
                        $('input[name=coupon_categories]').val($(this).val().join(','));
                    else
                        $('input[name=coupon_categories]').val(null);
                })
            </script>
        </div>
        <?php

        exit;
        break;
}


?>



<?php
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
                    <h1 class="m-n font-thin h3"><?php echo HEADING_TITLE; ?></h1>
                    <a class="ajax-modal ajax-modal-lg btn btn-default btn-xs green_plus"
                       href="<?php print tep_href_link(FILENAME_COUPON_ADMIN, tep_get_all_get_params(array('action', 'info')) . 'action=new', 'NONSSL'); ?>">
                        <svg width="44px" role="img" viewBox="0 0 512 512">
                            <path fill="#18bf49"
                                  d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm144 276c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92h-92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z"
                                  class=""></path>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="wrapper-md wrapper_767">
                <?php print get_coupon_admin_page_panel_html(); ?>
            </div>
        </div>
        <!-- /main -->
    </div>
</div>

<!-- /content -->


<?php

/**
 * footer
 */

include_once('footer.php');
include_once('html-close.php');

if ($_GET['action'] == 'new_coupon') {
    echo '<script>
    document.addEventListener("DOMContentLoaded", function(){
        var couponModalOpen = $(".ajax-modal.green_plus:not(.ajax-loader-invisible)");
        couponModalOpen.ready(function() {
            $(couponModalOpen).click();
        });
    })
</script>';
}
?>


<?php
/**
 * Создает html панели страницы "Купоны"
 * @return string - готовый html панели страницы "Купоны"
 */
function get_coupon_admin_page_panel_html()
{
    global $languages_id;
    global $currencies;

    ob_start();

    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-sm-6">
                    <?php echo tep_draw_form('status', FILENAME_COUPON_ADMIN, '', 'get', 'class="form-inline"'); ?>
                    <?php

                    $status_array = array();
                    $status_array[] = array('id' => 'Y', 'text' => TEXT_COUPON_ACTIVE);
                    $status_array[] = array('id' => 'N', 'text' => TEXT_COUPON_INACTIVE);
                    $status_array[] = array('id' => '*', 'text' => TEXT_COUPON_ALL);

                    if (isset($_GET['status'])) {
                        $status = tep_db_prepare_input($_GET['status']);
                    } else {
                        $status = 'Y';
                    }

                    print '<div class="form-group"><label class="control-label text-xs m-r">' . HEADING_TITLE_STATUS . '</label>' . new_tep_draw_pull_down_menu('status', $status_array, $status,
                            'class="form-control input-sm padder-lg" onChange="this.form.submit();"') . '</div>';

                    ?>
                    </form>

                </div>
                <div class="col-sm-6 text-right text-center-xs">


                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover table-condensed bg-white-only b-t b-light">
                <thead>
                <tr>
                    <th class="v-middle"><?php echo COUPON_NAME; ?></th>
                    <th class="text-center v-middle"><?php echo COUPON_AMOUNT; ?></th>
                    <th class="text-center v-middle"><?php echo COUPON_CODE; ?></th>
                    <th class="text-center v-middle"><?php echo COUPON_DESC; ?></th>
                    <th class="text-center v-middle"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ($_GET['page'] > 1) {
                    $rows = $_GET['page'] * 20 - 20;
                }

                if ($status != '*') {
                    $cc_query_raw = "select coupon_id, coupon_code, coupon_amount, coupon_type, coupon_start_date,coupon_expire_date,uses_per_user,uses_per_coupon,restrict_to_products, restrict_to_categories, date_created,date_modified from " . TABLE_COUPONS . " where coupon_active='" . tep_db_input($status) . "' and coupon_type != 'G'";
                } else {
                    $cc_query_raw = "select coupon_id, coupon_code, coupon_amount, coupon_type, coupon_start_date,coupon_expire_date,uses_per_user,uses_per_coupon,restrict_to_products, restrict_to_categories, date_created,date_modified from " . TABLE_COUPONS . " where coupon_type != 'G'";
                }

                $cc_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $cc_query_raw, $cc_query_numrows);
                $cc_query = tep_db_query($cc_query_raw);

                while ($cc_list = tep_db_fetch_array($cc_query)) {

                    $rows++;
                    if (strlen($rows) < 2) {
                        $rows = '0' . $rows;
                    }

                    $coupon_description_query = tep_db_query("select coupon_name from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $cc_list['coupon_id'] . "' and language_id = '" . $languages_id . "'");
                    $coupon_desc = tep_db_fetch_array($coupon_description_query);

                    $cInfo = new objectInfo($cc_list);
                    ?>

                    <tr>
                        <td class="v-middle col-name-coupon_name"><?php echo $coupon_desc['coupon_name']; ?></td>
                        <td class="text-center v-middle col-name-coupon_amount">
                            <?php

                            if (strpos($cc_list['coupon_type'], 'P') !== false) {
                                echo cutToFirstSignificantDigit($cc_list['coupon_amount']) . '%';
                            } else {
                                echo $currencies->format(cutToFirstSignificantDigit($cc_list['coupon_amount']));
                            }
                            if (strpos($cc_list['coupon_type'], 'S') !== false) {
                                echo '<br>' . TEXT_FREE_SHIPPING;
                            }

                            ?>
                        </td>
                        <td class="text-center v-middle">
                            <?php echo $cc_list['coupon_code']; ?>
                        </td>
                        <td class="v-middle col-name-coupon-description">
                            <?php

                            $amount = $cInfo->coupon_amount;
                            if (strpos($cInfo->coupon_type, 'P') !== false) {
                                $amount .= '%';
                            } else {
                                $amount = $currencies->format($amount);
                            }

                            $prod_details = 'NONE';
                            if ($cInfo->restrict_to_products) {
                                $prod_details = '<A HREF="listproducts.php?cid=' . $cInfo->coupon_id . '" TARGET="_blank" ONCLICK="window.open(\'listproducts.php?cid=' . $cInfo->coupon_id . '\', \'Valid_Categories\', \'scrollbars=yes,resizable=yes,menubar=yes,width=600,height=600\'); return false">' . COUPON_VIEW . '</A>';
                            }
                            $cat_details = 'NONE';
                            if ($cInfo->restrict_to_categories) {
                                $cat_details = '<A HREF="listcategories.php?cid=' . $cInfo->coupon_id . '" TARGET="_blank" ONCLICK="window.open(\'listcategories.php?cid=' . $cInfo->coupon_id . '\', \'Valid_Categories\', \'scrollbars=yes,resizable=yes,menubar=yes,width=600,height=600\'); return false">' . COUPON_VIEW . '</A>';
                            }

                            print addDoubleDot(COUPON_STARTDATE) . '<div class="coupon_description_value">' . tep_date_short($cInfo->coupon_start_date) . '</div><br>' .
                                addDoubleDot(COUPON_FINISHDATE) . '<div class="coupon_description_value">' . tep_date_short($cInfo->coupon_expire_date) . '</div><br>' .
                                addDoubleDot(COUPON_USES_COUPON) . '<div class="coupon_description_value">' . $cInfo->uses_per_coupon . '</div><br>' .
                                addDoubleDot(COUPON_USES_USER) . '<div class="coupon_description_value">' . $cInfo->uses_per_user . '</div><br>' .
                                addDoubleDot(COUPON_PRODUCTS) . '<div class="coupon_description_value">' . $prod_details . '</div><br>' .
                                addDoubleDot(COUPON_CATEGORIES) . '<div class="coupon_description_value">' . $cat_details . '</div><br>' .
                                addDoubleDot(DATE_CREATED) . '<div class="coupon_description_value">' . tep_date_short($cInfo->date_created) . '</div><br>' .
                                addDoubleDot(DATE_MODIFIED) . '<div class="coupon_description_value">' . tep_date_short($cInfo->date_modified) . '</div>';
                            ?>
                        </td>
                        <?php

                        /*
                         * Кнопки действий
                         */
                        ?>
                        <td class="text-center v-middle">
                            <a class="ajax-modal btn-link btn-link-icon" href="<?php print tep_href_link('coupon_admin.php', 'action=email&cid=' . $cc_list['coupon_id'], 'NONSSL'); ?>"
                               data-toggle="tooltip" data-placement="right" title="<?php print TEXT_TOOLTIP_VOUCHER_EMAIL; ?>">
                                <i class="fa fa-envelope"></i>
                            </a>
                            <a class="ajax-modal ajax-modal-lg m-l-sm btn-link btn-link-icon"
                               href="<?php print tep_href_link('coupon_admin.php', 'action=voucheredit&cid=' . $cc_list['coupon_id'], 'NONSSL'); ?>" data-toggle="tooltip" data-placement="right"
                               title="<?php print TEXT_TOOLTIP_VOUCHER_EDIT; ?>">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a class="ajax-modal m-l-sm btn-link btn-link-icon" href="<?php print tep_href_link('coupon_admin.php', 'action=voucherdelete&cid=' . $cc_list['coupon_id'], 'NONSSL'); ?>"
                               data-toggle="tooltip" data-placement="right" title="<?php print TEXT_TOOLTIP_VOUCHER_DELETE; ?>">
                                <i class="fa fa-trash-o"></i>
                            </a>
                            <a class="ajax-modal m-l-sm btn-link btn-link-icon" href="<?php print tep_href_link('coupon_admin.php', 'action=voucherreport&cid=' . $cc_list['coupon_id'], 'NONSSL'); ?>"
                               data-toggle="tooltip" data-placement="right" title="<?php print TEXT_TOOLTIP_VOUCHER_REPORT; ?>">
                                <i class="fa fa-bar-chart-o"></i>
                            </a>
                        </td>

                    </tr>

                    <?php
                }
                ?>

                </tbody>
            </table>
        </div>
        <footer class="panel-footer">
            <div class="row m-b">
                <div class="col-sm-6">
                    <?php echo $cc_split->display_count($cc_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_COUPONS); ?>
                </div>
                <div class="col-sm-6 text-right">
                    <?php echo $cc_split->new_display_links($cc_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?>
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
