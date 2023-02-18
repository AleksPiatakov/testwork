<div class="row">
    <div class="col-md-6 col-md-offset-3 col-xs-12">
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
        <?= $messageStack->render('create_account'); ?>
        <div class="form-group">
            <?= '<a class="enter_if" rel="nofollow" href="' . tep_href_link(
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
                <input type="text" name="dob" class="form-control reg_input account-datepicker" placeholder="<?= ENTRY_DATE_OF_BIRTH; ?>"
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
        <?php endif;

        if (ACCOUNT_COUNTRY === 'true' or ACCOUNT_STATE === 'true') {
            if (ACCOUNT_COUNTRY != 'true') {
                $non_show = 'style="display:none;"';
            }
            echo '<div class="form-group" ' . $non_show . '>' . tep_get_country_list(
                'selectCountry',
                isset($country_id) ? $country_id['countries_id'] : STORE_COUNTRY,
                'data-zone="' . $postZone . '" class="checkout_inputs required"'
            ) . '</div>';
        } ?>
        <?php if (ACCOUNT_FAX === 'true') : ?>
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
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-default login_btn active_submit" value="<?= SEND_MESSAGE; ?>">
        </div>
        </form>
    </div>
</div>
