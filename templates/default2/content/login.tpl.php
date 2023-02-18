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
                    <?php echo '<a href="' . tep_href_link(
                        FILENAME_PASSWORD_FORGOTTEN,
                        '',
                        'SSL'
                    ) . '">' . TEXT_PASSWORD_FORGOTTEN . '</a>'; ?>
                </div>
                <div class="col-xs-6 text-right">
                    <button type="submit" class="btn btn-default"><?php echo IMAGE_BUTTON_LOGIN; ?></button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php }?>