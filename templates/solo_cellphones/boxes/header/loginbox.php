<?php if (!isMobile()) { ?>
    <div id="kabinet" class="hidden-xs">

        <?php if (tep_session_is_registered('customer_id')) : ?>
            <?php //echo '<a href=account_history.php><strong>'.LOGIN_BOX_MY_CABINET.'</strong></a> | <a href="' . tep_href_link(FILENAME_LOGOFF, '', 'NONSSL') . '">' . LOGIN_BOX_LOGOFF . '</a>'; ?>
            <div class="enter_registration registered">
                <div class="enter">
                    <a rel="nofollow" href="<?php echo tep_href_link(FILENAME_ACCOUNT_HISTORY); ?>"
                       class="registered-user-link" data-toggle="tooltip" data-placement="auto bottom"
                       title="<?= LOGIN_BOX_MY_CABINET . ', ' . $_SESSION['customer_first_name']; ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M447.8 438.3c-7.2-31.8-48.3-47.3-62.5-52.3-15.6-5.5-37.8-6.8-52.1-10-8.2-1.8-20.1-6.3-24.1-11.1s-1.6-49.3-1.6-49.3 7.4-11.5 11.4-21.7c4-10.1 8.4-37.9 8.4-37.9s8.2 0 11.1-14.4c3.1-15.7 8-21.8 7.4-33.5-.6-11.5-6.9-11.2-6.9-11.2s6.1-16.7 6.8-51.3c.9-41.1-31.3-81.6-89.6-81.6-59.1 0-90.6 40.5-89.7 81.6.8 34.6 6.7 51.3 6.7 51.3s-6.3-.3-6.9 11.2c-.6 11.7 4.3 17.8 7.4 33.5 2.8 14.4 11.1 14.4 11.1 14.4s4.4 27.8 8.4 37.9c4 10.2 11.4 21.7 11.4 21.7s2.4 44.5-1.6 49.3c-4 4.8-15.9 9.3-24.1 11.1-14.3 3.2-36.5 4.5-52.1 10-14.2 5-55.3 20.5-62.5 52.3-1.1 5 2.7 9.7 7.9 9.7H440c5.1 0 8.9-4.7 7.8-9.7z"></path>
                        </svg>
                    </a>
                    <a rel="nofollow" href="<?php echo tep_href_link(FILENAME_LOGOFF); ?>" class="registered-exit-link"
                       title="<?php echo LOGIN_BOX_LOGOFF ?>">
                        <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z"></path>
                        </svg>
                    </a>
                </div>
            </div>
        <?php else : ?>
            <div class="enter_registration">
                <div class="enter">
                    <!--            <a href="#" class="enter_link">--><?php //echo LOGIN_FROM_SITE; ?><!--</a>-->

                    <div class="dropdown" id="user-login-dropdown">
                        <button class="dropdown-toggle" type="button" data-toggle="dropdown">
                            <!--                    <span class="custon-tooltip">-->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M447.8 438.3c-7.2-31.8-48.3-47.3-62.5-52.3-15.6-5.5-37.8-6.8-52.1-10-8.2-1.8-20.1-6.3-24.1-11.1s-1.6-49.3-1.6-49.3 7.4-11.5 11.4-21.7c4-10.1 8.4-37.9 8.4-37.9s8.2 0 11.1-14.4c3.1-15.7 8-21.8 7.4-33.5-.6-11.5-6.9-11.2-6.9-11.2s6.1-16.7 6.8-51.3c.9-41.1-31.3-81.6-89.6-81.6-59.1 0-90.6 40.5-89.7 81.6.8 34.6 6.7 51.3 6.7 51.3s-6.3-.3-6.9 11.2c-.6 11.7 4.3 17.8 7.4 33.5 2.8 14.4 11.1 14.4 11.1 14.4s4.4 27.8 8.4 37.9c4 10.2 11.4 21.7 11.4 21.7s2.4 44.5-1.6 49.3c-4 4.8-15.9 9.3-24.1 11.1-14.3 3.2-36.5 4.5-52.1 10-14.2 5-55.3 20.5-62.5 52.3-1.1 5 2.7 9.7 7.9 9.7H440c5.1 0 8.9-4.7 7.8-9.7z"></path>
                            </svg>
                            <!--                   </span>-->
                        </button>
                        <div class="dropdown-menu">
                            <!-- LOGIN FORM -->
                            <?php echo tep_draw_form(
                                'login',
                                tep_href_link(FILENAME_LOGIN, 'action=process', 'SSL'),
                                'post',
                                'class="form_enter"'
                            ); ?>
                            <input type="text" name="email_address" class="form-control name_enter" required
                                   autocomplete="off" value="" placeholder="<?php echo ENTRY_EMAIL_ADDRESS; ?>"/>
                            <input type="password" name="password" class="form-control password_enter" required
                                   autocomplete="off" value="" placeholder="<?php echo ENTRY_PASSWORD; ?>"/>
                            <div class="submit-reset">
                                <button type="submit" name="submit_enter"
                                        class="submit_enter"><?php echo IMAGE_BUTTON_LOGIN; ?></button>
                                <a rel="nofollow"
                                   href="<?php echo tep_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL'); ?>"
                                   class="reset-pass" data-toggle="tooltip" data-placement="auto bottom"
                                   title="<?= defined(
                                       'TEXT_PASSWORD_FORGOTTEN_DO'
                                          ) ? TEXT_PASSWORD_FORGOTTEN_DO : 'Reset password'; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M256 388c-72.597 0-132-59.405-132-132 0-72.601 59.403-132 132-132 36.3 0 69.299 15.4 92.406 39.601L278 234h154V80l-51.698 51.702C348.406 99.798 304.406 80 256 80c-96.797 0-176 79.203-176 176s78.094 176 176 176c81.045 0 148.287-54.134 169.401-128H378.85c-18.745 49.561-67.138 84-122.85 84z"/>
                                    </svg>
                                </a>
                            </div>
                            <p class="or"><?php echo HEADER_TITLE_OR; ?></p>
                            <?php if (
                            AUTH_MODULE_ENABLED == 'true' and $template->show(
                                'H_LOGIN_FB'
                            ) and FACEBOOK_AUTH_STATUS == "true"
) : ?>
                                <a rel="nofollow"
                                   href="javascript:showLoginvk('<?php echo 'https://www.facebook.com/dialog/oauth/?client_id=' . $fb_app_id . '&amp;display=popup&amp;redirect_uri=' . HTTP_SERVER . '/ext/auth/ajax_loginfb.php&amp;state=' . $fb_state . '&amp;scope=email,public_profile'; ?>');"
                                   class="social_login">
                                    <i class="fa fa-facebook-official"></i><?php echo RENDER_LOGIN_WITH; ?> Facebook
                                </a>
                                <!--            <a rel="nofollow" href="javascript:showLoginvk('<?php echo 'https://oauth.vk.com/authorize?client_id=' . $vk_app_id . '&amp;scope=email&amp;display=popup&amp;redirect_uri=' . HTTP_SERVER . '/ext/auth/ajax_loginvk.php&amp;response_type=code'; ?>');" class="social_header_vk"><i class="fa fa-vk"></i></a> -->
                            <?php endif ?>
                            <?php if (AUTH_MODULE_ENABLED == 'true' and GOOGLE_OAUTH_STATUS == 'true') { ?>
                                <a rel="nofollow" href="javascript:startGoogleOAuth();"
                                   class="social_header_google googleSigninButton">
                                    <svg id="Capa_1" enable-background="new 0 0 512 512" height="512"
                                         viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg">
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
                                </a>
                            <?php } ?>
                            </form>
                            <div class="create_account_text">
                                <a rel="nofollow" href="<?php echo tep_href_link(FILENAME_CREATE_ACCOUNT); ?>"
                                   class="registration"><?php echo HEADER_TITLE_CREATE_ACCOUNT; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php endif; ?>
    </div>

<?php } ?>
