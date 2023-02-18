<div class="container">
    <?php
    $val_name = '';
    $val_email = '';
    if (tep_session_is_registered('customer_id') && !empty($customers_id)) {
        $customer_query = tep_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_id=" . $customer_id);
        $customer_array = tep_db_fetch_array($customer_query);
        $val_name = $customer_array['customers_firstname'] . ' ' . $customer_array['customers_lastname'];
        $val_email = $customer_array['customers_email_address'];
    }
    
    echo tep_draw_form('contact_us', tep_href_link(FILENAME_CONTACT_US, tep_get_all_get_params(['action','language']).'action=send')); ?>
	<div class="row">
		<div class="col-sm-12 form-group">
			<h1><?= HEADING_TITLE ?></h1>
            <?php //echo renderArticle(76); // contacts main ?>
		</div>
		<div class="col-sm-6 form-group clearfix">
			<input type="text" name="name" class="form-group form-control" placeholder="<?= ENTRY_NAME ?>" required value="<?=  $val_name ?>" />
			<input name="email" type="email" class="form-group form-control" placeholder="<?= ENTRY_EMAIL ?>" required value="<?=  $val_email ?>" />
			<input name="phone" type="text" class="form-group form-control" placeholder="<?= ENTRY_PHONE ?>" required />
			<textarea name="enquiry" maxlength="1000"  class="form-group form-control" placeholder="<?= ENTRY_ENQUIRY ?>" rows="5" required ></textarea>
            <?php
            if (getConstantValue('GOOGLE_RECAPTCHA_STATUS', 'false') !== 'false' && is_file(DIR_WS_EXT . "recaptcha/recaptcha.php")) {
                require_once DIR_WS_EXT . "recaptcha/recaptcha.php";
            } elseif (getConstantValue('DEFAULT_CAPTCHA_STATUS', 'false') !== 'false') { ?>
				<p><img class="lazyload" src="images/pixel_trans.png" data-src="<?= tep_href_link(DIR_WS_INCLUDES.'kcaptcha/kindex.php', '', 'SSL');?>"></p>
				<p><input type="text" name="keystring"></p>
                <?php
            }
            ?>
			<button type="submit" class="form-group btn pull-right btn-default"><?= SEND_MESSAGE; ?></button>
		</div>
		<div class="col-sm-6 form-group">
            <?= renderArticle('contacts'); // contacts  ?>
            <?php //echo renderArticle(96); // google map ?>
		</div>
	</div>
	</form>
</div>