<?php
if ($_GET['login'] == 'fail_try') {
    $info_message = TEXT_LOGIN_ERROR_TRIED;
} ?>
<?php if (isset($info_message)) { ?>
    <tr>
        <td colspan="2" class="smallText" align="center"><?php echo $info_message; ?></td>
    </tr>
<?php } else { ?>

<?php echo tep_draw_form('login', tep_href_link(FILENAME_LOGIN, 'action=process', 'SSL')); ?>
<?php $messageStack->render('login'); ?>
<form name="login" action="<?php echo tep_href_link(FILENAME_LOGIN, 'action=process', 'SSL'); ?>" role="form">
    <?= csrf() ?>
    <div class="row">
        <div class="col-md-6 col-xs-12 col-sm-6">
            <div class="form-group">
                <?php echo '<h2>' . TEXT_NEW_CUSTOMER . '</h2>'; ?>
                <p><?php echo sprintf(TEXT_NEW_CUSTOMER_INTRODUCTION, STORE_NAME) ?></p>
            </div>
            <div class="form-group" style="margin-top: 36px;">
                <a rel="nofollow" class="btn btn-success" href="<?php echo tep_href_link(
                    FILENAME_CREATE_ACCOUNT,
                    '',
                    'SSL'
                ); ?>"><?php echo HEADER_TITLE_CREATE_ACCOUNT; ?></a>
            </div>
        </div>
        <div class="col-md-6 col-xs-12 col-sm-6">
            <h2><?php echo TEXT_RETURNING_CUSTOMER; ?></h2>
            <div class="form-group">
                <?php echo tep_draw_input_field(
                    'email_address',
                    '',
                    'class="reg_input form-control" autocomplete="off" placeholder="' . ENTRY_EMAIL_ADDRESS . '"'
                ); ?>
            </div>
            <div class="form-group">
                <?php echo tep_draw_password_field(
                    'password',
                    '',
                    'class="reg_input form-control" autocomplete="off" placeholder="' . ENTRY_PASSWORD . '"'
                ); ?>
            </div>
            <div class="form-group row">
                <div class="col-xs-6">
                    <?php echo '<a rel="nofollow" href="' . tep_href_link(
                        FILENAME_PASSWORD_FORGOTTEN,
                        '',
                        'SSL'
                    ) . '">' . TEXT_PASSWORD_FORGOTTEN . '</a>'; ?>
                </div>
                <div class="col-xs-12 networks-container">
                    <?php if (
                    AUTH_MODULE_ENABLED == 'true' and $template->show(
                        'H_LOGIN_FB'
                    ) and FACEBOOK_AUTH_STATUS == "true"
) : ?>
                        <a rel="nofollow"
                           href="javascript:showLoginvk('<?php echo 'https://www.facebook.com/dialog/oauth/?client_id=' . $fb_app_id . '&amp;display=popup&amp;redirect_uri=' . HTTP_SERVER . '/ext/auth/ajax_loginfb.php&amp;state=' . $fb_state . '&amp;scope=email,public_profile'; ?>');"
                           class="social_header_facebook">
                            <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M400 32H48A48 48 0 0 0 0 80v352a48 48 0 0 0 48 48h137.25V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.27c-30.81 0-40.42 19.12-40.42 38.73V256h68.78l-11 71.69h-57.78V480H400a48 48 0 0 0 48-48V80a48 48 0 0 0-48-48z"></path>
                            </svg>
                            <?php echo RENDER_LOGIN_WITH; ?> Facebook
                        </a>
                        <!--            <a rel="nofollow" href="javascript:showLoginvk('<?php echo 'https://oauth.vk.com/authorize?client_id=' . $vk_app_id . '&amp;scope=email&amp;display=popup&amp;redirect_uri=' . HTTP_SERVER . '/ext/auth/ajax_loginvk.php&amp;response_type=code'; ?>');" class="social_header_vk"><i class="fa fa-vk"></i></a> -->
                    <?php endif; ?>
                    <?php if (AUTH_MODULE_ENABLED == 'true' and GOOGLE_OAUTH_STATUS == 'true') { ?>
                        <a rel="nofollow" href="javascript:startGoogleOAuth();"
                           class="social_header_google googleSigninButton">
                            <svg id="Capa_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512"
                                 width="512" xmlns="http://www.w3.org/2000/svg">
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
                            <?php echo RENDER_LOGIN_WITH; ?> Google
                        </a>
                    <?php } ?>
                </div>
                <div class="col-xs-6 text-right">
                    <button type="submit" class="btn btn-default"><?php echo IMAGE_BUTTON_LOGIN; ?></button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php } ?>