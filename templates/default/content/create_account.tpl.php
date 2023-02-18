<div class="row">
    <div class="col-md-6">
        <?= tep_draw_form(
            'create_account',
            tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'),
            'post',
            'onSubmit="return check_form(create_account);"'
        ) . tep_draw_hidden_field(
            'action',
            'process'
        ) . tep_draw_hidden_field('guest_account', $guest_account); ?>
        <h2><?= HEADER_TITLE_CREATE_ACCOUNT; ?></h2>
	    <div>
		    <div class="client-enter_window">
			    <?php if (AUTH_MODULE_ENABLED == 'true') { ?>
				    <?php if (is_file(DIR_WS_EXT . "auth/ajax_loginfb.php") && $template->show('H_LOGIN_FB') and FACEBOOK_AUTH_STATUS == "true") { ?>
					    <a rel="nofollow"
						     href="javascript:showLoginvk('<?php echo 'https://www.facebook.com/dialog/oauth/?client_id=' . $fb_app_id . '&amp;display=popup&amp;redirect_uri=' . HTTP_SERVER . '/ext/auth/ajax_loginfb.php&amp;state=' . $fb_state . '&amp;scope=email,public_profile'; ?>');"
						     class="social_header_facebook">
						    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
							    <path d="M400 32H48A48 48 0 0 0 0 80v352a48 48 0 0 0 48 48h137.25V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.27c-30.81 0-40.42 19.12-40.42 38.73V256h68.78l-11 71.69h-57.78V480H400a48 48 0 0 0 48-48V80a48 48 0 0 0-48-48z"></path>
						    </svg>
						    <?php echo RENDER_LOGIN_WITH_SINGUP; ?> Facebook
					    </a>
				    <?php } ?>
				    <?php if (is_file(DIR_WS_EXT . "auth/ajax_login_google.php") && GOOGLE_OAUTH_STATUS == 'true') { // auth?>
					    <a rel="nofollow" href="javascript:void(0);" class="social_header_google googleSigninButton">
						    <svg id="Capa_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512"
							     xmlns="http://www.w3.org/2000/svg">
							    <g>
								    <path d="m120 256c0-25.367 6.989-49.13 19.131-69.477v-86.308h-86.308c-34.255 44.488-52.823 98.707-52.823 155.785s18.568 111.297 52.823 155.785h86.308v-86.308c-12.142-20.347-19.131-44.11-19.131-69.477z"
									     fill="#fbbd00"/>
								    <path d="m256 392-60 60 60 60c57.079 0 111.297-18.568 155.785-52.823v-86.216h-86.216c-20.525 12.186-44.388 19.039-69.569 19.039z"
									     fill="#0f9d58"/>
								    <path d="m139.131 325.477-86.308 86.308c6.782 8.808 14.167 17.243 22.158 25.235 48.352 48.351 112.639 74.98 181.019 74.98v-120c-49.624 0-93.117-26.72-116.869-66.523z"
									     fill="#31aa52"/>
								    <path d="m512 256c0-15.575-1.41-31.179-4.192-46.377l-2.251-12.299h-249.557v120h121.452c-11.794 23.461-29.928 42.602-51.884 55.638l86.216 86.216c8.808-6.782 17.243-14.167 25.235-22.158 48.352-48.353 74.981-112.64 74.981-181.02z"
									     fill="#3c79e6"/>
								    <path d="m352.167 159.833 10.606 10.606 84.853-84.852-10.606-10.606c-48.352-48.352-112.639-74.981-181.02-74.981l-60 60 60 60c36.326 0 70.479 14.146 96.167 39.833z"
									     fill="#cf2d48"/>
								    <path d="m256 120v-120c-68.38 0-132.667 26.629-181.02 74.98-7.991 7.991-15.376 16.426-22.158 25.235l86.308 86.308c23.753-39.803 67.246-66.523 116.87-66.523z"
									     fill="#eb4132"/>
							    </g>
						    </svg>
						    <?php echo RENDER_LOGIN_WITH_SINGUP; ?> Google
					    </a>
				    <?php } ?>
				    <?php if ($template->show('H_LOGIN_FB') and FACEBOOK_AUTH_STATUS == "true" || GOOGLE_OAUTH_STATUS == 'true') { ?>
					    <p class="or"><?php echo HEADER_TITLE_OR; ?></p>
				    <?php } ?>
			    <?php } ?>
			    <p></p>
			    <?php echo tep_draw_form(
				    'login',
				    tep_href_link(FILENAME_LOGIN, 'action=process', 'SSL'),
				    'post',
				    'class="form_enter"'
			    ); ?>

		    </div>
	    </div>
        <?= $messageStack->render('create_account'); ?>
        <div class="form-group">
            <?= '<a class="btn btn-default btn-xs" rel="nofollow" href="' . tep_href_link(
                FILENAME_LOGIN
            ) . '">' . CR_ENTER . '</a>, ' . CR_IF; ?>
        </div>
        <div class="form-group">
            <input type="text" name="firstname" class="form-control reg_input" placeholder="<?= ENTRY_FIRST_NAME; ?>"
                   value="<?= $postFirstname; ?>">
        </div>
        <?php if (ACCOUNT_LAST_NAME === 'true') : ?>
            <div class="form-group">
                <input type="text" name="lastname" class="form-control reg_input" placeholder="<?= ENTRY_LAST_NAME; ?>"
                       value="<?= $postLastname; ?>">
            </div>
        <?php endif ?>
        <?php if (ACCOUNT_DOB === 'true') : ?>
            <div class="form-group">
                <input type="text" name="dob" class="form-control reg_input account-datepicker" placeholder="<?= ENTRY_DATE_OF_BIRTH; ?> "
                       value="<?= $postDob; ?>">
            </div>
        <?php endif ?>
        <?php if (ACCOUNT_COMPANY === 'true') : ?>
            <div class="form-group">
                <input type="text" name="company" class="form-control reg_input" placeholder="<?= ENTRY_COMPANY; ?>"
                       value="<?= $postCompany; ?>">
            </div>
        <?php endif ?>
        <div class="form-group">
            <input type="text" name="email_address" class="form-control reg_input"
                   placeholder="<?= ENTRY_EMAIL_ADDRESS; ?>" value="<?= $postEmailAddress; ?>">
        </div>
        <?php if (ACCOUNT_TELE === 'true') : ?>
            <div class="form-group">
                <input type="text" name="telephone" class="form-control reg_input"
                       placeholder="<?= ENTRY_TELEPHONE_NUMBER; ?>" value="<?= $postTelephone; ?>">
            </div>
        <?php endif ?>
        <?php if (ACCOUNT_STREET_ADDRESS === 'true') : ?>
            <div class="form-group">
                <input type="text" name="street_address" class="form-control reg_input"
                       placeholder="<?= ENTRY_STREET_ADDRESS; ?>" value="<?= $postStreetAddress; ?>">
            </div>
        <?php endif ?>
        <?php if (ACCOUNT_CITY === 'true') : ?>
            <div class="form-group">
                <input type="text" name="city" class="form-control reg_input" placeholder="<?= ENTRY_CITY; ?>"
                       value="<?= $postCity; ?>">
            </div>
        <?php endif ?>

        <?php if (ACCOUNT_COUNTRY == 'true' or ACCOUNT_STATE == 'true') {
            if (ACCOUNT_COUNTRY != 'true') {
                $non_show = 'style="display:none;"';
            }
            echo '<div class="form-group" ' . $non_show . '><span class="selectZone"></span></div>';
        } ?>

        <?php if (ACCOUNT_SUBURB === 'true') : ?>
            <div class="form-group">
                <input type="text" name="suburb" class="form-control reg_input" placeholder="<?= ENTRY_SUBURB; ?>"
                       value="<?= $postSuburb; ?>">
            </div>
        <?php endif ?>
        <?php if (ACCOUNT_POSTCODE === 'true') : ?>
            <div class="form-group">
                <input type="text" name="postcode" class="form-control reg_input" placeholder="<?= ENTRY_POST_CODE; ?>"
                       value="<?= $postPostcode; ?>">
            </div>
        <?php endif ?>
        <!-- select state -->
        <?php
        if (ACCOUNT_COUNTRY === 'true' or ACCOUNT_STATE === 'true') {
            if (ACCOUNT_COUNTRY !== 'true') {
                $non_show = 'style="display:none;"';
            }
            echo '<div class="form-group" ' . $non_show . '>' . tep_get_country_list(
                'selectCountry',
                isset($country_id) ? $country_id['countries_id'] : STORE_COUNTRY,
                'data-zone="' . $postZone . '" autocomplete="off" class="checkout_inputs required"'
            ) . '</div>';
        }

        if (ACCOUNT_FAX === 'true') : ?>
            <div class="form-group">
                <input type="text" name="fax" class="form-control reg_input" placeholder="<?= ENTRY_FAX_NUMBER; ?>"
                       value="<?= $postFax; ?>">
            </div>
        <?php endif ?>
        <?php if (!$guest_account) : ?>
            <div class="form-group">
                <input type="password" name="password" class="form-control reg_input"
                       placeholder="<?= ENTRY_PASSWORD; ?>">
            </div>
            <div class="form-group">
                <input type="password" name="confirmation" class="form-control reg_input"
                       placeholder="<?= ENTRY_PASSWORD_CONFIRMATION; ?>">
            </div>
        <?php endif ?>
        <?php if (ACCOUNT_NEWS === 'true') : ?>
            <div class="form-group">
                <?= tep_draw_checkbox_field('newsletter', '1', true, 'id="account_newsletter"') ?>
                <label for="account_newsletter"><?= ENTRY_NEWSLETTER ?></label>
            </div>
        <?php endif ?>
        <div class="form-group">
            <?= tep_draw_checkbox_field('shoprules', '1', true, 'id="shoprules"') ?>
            <label for="shoprules"><?= SHOPRULES_AGREE; ?></label>
            <a href="#" class="ajax_modal_article" data-id="store-rules"><?= SHOPRULES_AGREE2; ?></a>
        </div>
        <div class="form-group">
            <?php
            if (
                getConstantValue(
                    'GOOGLE_RECAPTCHA_STATUS',
                    'false'
                ) !== 'false' && is_file(DIR_WS_EXT . "recaptcha/recaptcha.php")
            ) {
                require_once DIR_WS_EXT . "recaptcha/recaptcha.php";
            } elseif (getConstantValue('DEFAULT_CAPTCHA_STATUS', 'false') !== 'false') { ?>
                <p>
                    <img class="lazyload" src="images/pixel_trans.png"
                         data-src="<?= tep_href_link(DIR_WS_INCLUDES . 'kcaptcha/kindex.php', '', 'SSL'); ?>">
                </p>
                <p><input type="text" name="keystring"></p>
                <?php
            }
            ?>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-default active_submit" value="<?= SEND_MESSAGE; ?>">
        </div>
        </form>
    </div>
</div>
