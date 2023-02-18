<?php ob_start();  //Buffer ?>

<?php $messageStack->render('account_edit'); ?>

<div class="row">
    <form class="col-md-5" role="form" name="account_edit" method="POST"
          action="<?php echo tep_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL'); ?>"
          onSubmit="return check_form(account_edit);">
        <?= csrf() ?>
        <h1><?php echo MY_ACCOUNT_TITLE; ?></h1>
        <input type="hidden" name="action" value="process">

        <div class="form-group">
            <label><?php echo ENTRY_EMAIL_ADDRESS; ?></label> <input type="text" required name="email_address"
                                                                  class="form-control"
                                                                  value="<?php echo $account['customers_email_address']; ?>"
                                                                  id="customers_email_address"
                                                                  placeholder="<?php echo ENTRY_EMAIL_ADDRESS; ?>">
        </div>
        <div class="form-group">
            <label><?php echo ENTRY_FIRST_NAME; ?></label> <input type="text" required name="firstname"
                                                                  class="form-control"
                                                                  value="<?php echo stripslashes($account['customers_firstname']); ?>"
                                                                  id="customers_firstname"
                                                                  placeholder="<?php echo ENTRY_FIRST_NAME; ?>">
        </div>
        <div class="form-group">
            <label><?php echo ENTRY_LAST_NAME; ?></label> <input type="text" required name="lastname"
                                                                 class="form-control"
                                                                 value="<?php echo stripslashes($account['customers_lastname']); ?>"
                                                                 id="customers_lastname"
                                                                 placeholder="<?php echo ENTRY_LAST_NAME; ?>">
        </div>
        <?php if (ACCOUNT_DOB == 'true') : ?>
            <div class="form-group">
                <label><?php echo ENTRY_DATE_OF_BIRTH; ?></label> <input type="text" name="dob" class="form-control account-edit-datepicker"
                                                                         value="<?php echo date("d/m/Y", strtotime($account['customers_dob'])); ?>"
                                                                         id="customers_dob"
                                                                         placeholder="<?php echo ENTRY_DATE_OF_BIRTH; ?>">
            </div>
        <?php endif; ?>
        <div class="form-group">
            <label><?php echo ENTRY_TELEPHONE_NUMBER; ?></label> <input type="text" name="telephone"
                                                                        class="form-control"
                                                                        value="<?php echo $account['customers_telephone']; ?>"
                                                                        id="customers_telephone"
                                                                        placeholder="<?php echo ENTRY_TELEPHONE_NUMBER; ?>">
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <a href="<?php echo tep_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?> "
                       class="btn btn-default"><?php echo IMAGE_BUTTON_BACK; ?></a>
                </div>
                <div class="col-md-6 text-right">
                    <button type="submit" class="btn btn-danger"><?php echo IMAGE_BUTTON_CONTINUE; ?></button>
                </div>
            </div>

        </div>

    </form>
</div>

<?php
$data['content'] = ob_get_contents();
ob_end_clean();
?>
<?php include_once 'account_template.tpl.php'; ?>
