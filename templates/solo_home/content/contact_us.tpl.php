<?php

$val_name = '';
$val_email = '';
if (tep_session_is_registered('customer_id') && !empty($customers_id)) {
    $customer_query = tep_db_query(
        "select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_id=" . $customer_id
    );
    $customer_array = tep_db_fetch_array($customer_query);
    $val_name = $customer_array['customers_firstname'] . ' ' . $customer_array['customers_lastname'];
    $val_email = $customer_array['customers_email_address'];
}

echo tep_draw_form(
    'contact_us',
    tep_href_link(FILENAME_CONTACT_US, tep_get_all_get_params(array('action', 'language')) . 'action=send')
); ?>
<div class="row">
    <div class="col-sm-12 form-group">
        <h1><?= HEADING_TITLE ?></h1>
        <?php //echo renderArticle(76); // contacts main ?>
    </div>
    <div class="col-sm-6 form-group clearfix">
        <input type="text" name="name" class="form-group form-control" placeholder="<?= ENTRY_NAME ?>" required
               value="<?= $val_name ?>"/>
        <input type="text" name="email" class="form-group form-control" placeholder="<?= ENTRY_EMAIL ?>" required
               value="<?= $val_email ?>"/>
        <input type="text" name="phone" class="form-group form-control" placeholder="<?= ENTRY_PHONE ?>" required/>
        <textarea name="enquiry" class="form-group form-control" placeholder="<?= ENTRY_ENQUIRY ?>" rows="5"
                  required></textarea>
        <?php
        if (
            getConstantValue('GOOGLE_RECAPTCHA_STATUS', 'false') !== 'false' && is_file(
                DIR_WS_EXT . "recaptcha/recaptcha.php"
            )
        ) {
            require_once DIR_WS_EXT . "recaptcha/recaptcha.php";
        } elseif (getConstantValue('DEFAULT_CAPTCHA_STATUS', 'false') !== 'false') { ?>
            <p>
                <img class="lazyload" src="images/pixel_trans.png"
                     data-src="<?= tep_href_link(DIR_WS_INCLUDES . 'kcaptcha/kindex.php', '', 'SSL'); ?>">
            </p>
            <p>
                <input type="text" name="keystring">
            </p>
            <?php
        }
        ?>
        <button type="submit" class="form-group btn pull-right btn-default contact_us_submit">
            <?= SEND_MESSAGE; ?>
            <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                <path fill="currentColor"
                      d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
            </svg>
        </button>
    </div>
    <div class="col-sm-6 form-group">
        <?= renderArticle('contacts'); // contacts   ?>
        <?php //echo renderArticle(96); // google map ?>
    </div>
</div>
</form>
