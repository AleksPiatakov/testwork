<div class="row">
    <div class="col-sm-6 pull-center">
        <div class="password-forgotten-page white-rounded-box">
            <h2><?php echo NAVBAR_TITLE_2; ?></h2>
            <?php echo tep_draw_form(
                'password_forgotten',
                tep_href_link(FILENAME_PASSWORD_FORGOTTEN, 'action=process', 'SSL')
            ); ?>
            <div class="content">
                <div class="form-group">
                    <?php echo TEXT_MAIN; ?>
                </div>
                <?php echo $messageStack->render('password_forgotten'); ?>
                <div class="form-group">
                    <input type="email" name="email_address" id="inputEmail_address" class="form-control" value=""
                           required="required" title="" placeholder="<?php echo ENTRY_EMAIL_ADDRESS ?>">
                </div>

                <div class="form-group">
                    <a href="<?php echo tep_href_link(FILENAME_LOGIN, '', 'SSL') ?>"
                       class="btn btn-default"><?php echo IMAGE_BUTTON_BACK ?></a>
                    <button type="submit" class="btn btn-primary"><?php echo IMAGE_BUTTON_CONTINUE; ?></button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
