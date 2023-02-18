<?php ob_start();  //Buffer ?>
<?php $messageStack->render('account_password'); ?>
<?php echo tep_draw_form(
    'account_password',
    tep_href_link(FILENAME_ACCOUNT_PASSWORD, '', 'SSL'),
    'post',
    'onSubmit="return check_form(account_password);" role="form"'
) . tep_draw_hidden_field('action', 'process'); ?>

<div class="row">
    <div class="col-md-8">
        <h1><?php echo MY_PASSWORD_TITLE; ?></h1>
        <?php //echo FORM_REQUIRED_INFORMATION; ?>
        <div class="form-group">
            <label for="password_current"><?php echo ENTRY_PASSWORD_CURRENT; ?></label> <input type="password"
                                                                                               name="password_current"
                                                                                               class="form-control"
                                                                                               id="password_current"
                                                                                               placeholder="<?php echo ENTRY_PASSWORD_CURRENT; ?>">
        </div>
        <div class="form-group">
            <label for="password_new"><?php echo ENTRY_PASSWORD_NEW; ?></label> <input type="password"
                                                                                       name="password_new"
                                                                                       class="form-control"
                                                                                       id="password_new"
                                                                                       placeholder="<?php echo ENTRY_PASSWORD_NEW; ?>">
        </div>
        <div class="form-group">
            <label for="password_confirmation"><?php echo ENTRY_PASSWORD_CONFIRMATION; ?></label> <input type="password"
                                                                                                         name="password_confirmation"
                                                                                                         class="form-control"
                                                                                                         id="password_confirmation"
                                                                                                         placeholder="<?php echo ENTRY_PASSWORD_CONFIRMATION; ?>">
        </div>
        <div class="form-group">
            <a href="<?php echo tep_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?> "
               class="btn btn-default"><?php echo IMAGE_BUTTON_BACK; ?></a>
            <input class="btn btn-danger pull-right" type="submit" value="<?php echo IMAGE_BUTTON_CONTINUE; ?>">
        </div>
    </div>
</div>
</form>

<?php
$data['content'] = ob_get_contents();
ob_end_clean();
?>
<?php //$data['content'] = $content; ?>
<?php include_once 'account_template.tpl.php'; ?>
