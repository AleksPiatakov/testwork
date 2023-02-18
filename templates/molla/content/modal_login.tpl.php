<div class="client-enter_window">
    <?php if (AUTH_MODULE_ENABLED == 'true') { ?>
        <?php if (
        is_file(DIR_WS_EXT . "auth/ajax_loginfb.php") && $template->show(
            'H_LOGIN_FB'
        ) and FACEBOOK_AUTH_STATUS == "true"
) { ?>
    <a rel="nofollow"
       href="javascript:showLoginvk('<?php echo 'https://www.facebook.com/dialog/oauth/?client_id=' . $fb_app_id . '&amp;display=popup&amp;redirect_uri=' . HTTP_SERVER . '/ext/auth/ajax_loginfb.php&amp;state=' . $fb_state . '&amp;scope=email,public_profile'; ?>');"
       class="social_header_facebook">
        <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path d="M400 32H48A48 48 0 0 0 0 80v352a48 48 0 0 0 48 48h137.25V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.27c-30.81 0-40.42 19.12-40.42 38.73V256h68.78l-11 71.69h-57.78V480H400a48 48 0 0 0 48-48V80a48 48 0 0 0-48-48z"></path>
        </svg>
    </a>
    <a rel="nofollow" href="<?php echo tep_href_link(FILENAME_CREATE_ACCOUNT); ?>"
       class="registration"><?php echo HEADER_TITLE_CREATE_ACCOUNT; ?></a>
    <a rel="nofollow" href="<?php echo tep_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL'); ?>"
       class="forget_password"><?php echo TEXT_PASSWORD_FORGOTTEN; ?></a>
</div>
</form>

<p class="or"><?php echo MOLLA_LOGIN_FORM_OR; ?></p>
<div class="login_with">
    <?php if (is_file(DIR_WS_EXT . "auth/ajax_login_google.php") && GOOGLE_OAUTH_STATUS == 'true') { ?>
        <?php echo RENDER_LOGIN_WITH; ?> Facebook
        </a>
    <?php }
        } ?>
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
            <?php echo RENDER_LOGIN_WITH; ?> Google
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
    <span>
        <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path d="M464 64H48C21.5 64 0 85.5 0 112v288c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM48 96h416c8.8 0 16 7.2 16 16v41.4c-21.9 18.5-53.2 44-150.6 121.3-16.9 13.4-50.2 45.7-73.4 45.3-23.2.4-56.6-31.9-73.4-45.3C85.2 197.4 53.9 171.9 32 153.4V112c0-8.8 7.2-16 16-16zm416 320H48c-8.8 0-16-7.2-16-16V195c22.8 18.7 58.8 47.6 130.7 104.7 20.5 16.4 56.7 52.5 93.3 52.3 36.4.3 72.3-35.5 93.3-52.3 71.9-57.1 107.9-86 130.7-104.7v205c0 8.8-7.2 16-16 16z"></path>
        </svg>
    </span>
    <input type="text" name="email_address" class="form-control name_enter" required autocomplete="off" value=""
           placeholder="<?php echo ENTRY_EMAIL_ADDRESS; ?>"/>
    <span>
        <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path d="M400 224h-24v-72C376 68.2 307.8 0 224 0S72 68.2 72 152v72H48c-26.5 0-48 21.5-48 48v192c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V272c0-26.5-21.5-48-48-48zm-104 0H152v-72c0-39.7 32.3-72 72-72s72 32.3 72 72v72z"></path>
        </svg>
    </span>
    <input type="password" name="password" class="form-control password_enter" required autocomplete="off" value=""
           placeholder="<?php echo ENTRY_PASSWORD; ?>"/>
    <a rel="nofollow" href="<?php echo tep_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL'); ?>"
       class="forget_password"><?php echo TEXT_PASSWORD_FORGOTTEN; ?></a>
    <button type="submit" name="submit_enter" class="submit_enter"><?php echo LOGIN_FROM_SITE; ?></button>

    </form>
    <?php if (
    is_file(DIR_WS_EXT . "auth/ajax_loginfb.php") && $template->show(
        'H_LOGIN_FB'
    ) and FACEBOOK_AUTH_STATUS == "true"
) { ?>
        <a rel="nofollow"
           href="javascript:showLoginvk('<?php echo 'https://www.facebook.com/dialog/oauth/?client_id=' . $fb_app_id . '&amp;display=popup&amp;redirect_uri=' . HTTP_SERVER . '/ext/auth/ajax_loginfb.php&amp;state=' . $fb_state . '&amp;scope=email,public_profile'; ?>');"
           class="social_header_facebook">
            <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                <path fill="#3366cc"
                      d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path>
            </svg>
                                                                       <?php echo MOLLA_LOGIN_FORM_FACEBOOK; ?>
        </a>
    <?php } ?>
</div>
</div>
