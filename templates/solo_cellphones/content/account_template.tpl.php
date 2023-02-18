<?php includeLanguages('includes/languages/' . $language . '/account.php'); ?>

<div class="row account_template">
    <div class="col-md-12">
        <div class="profile-page">
            <?php if (isset($_SESSION['customer_id'])) : ?>
                <!--        <div class="col-md-3">-->
                <?php include_once 'account.tpl.php'; ?>
                <!--        </div>-->
            <?php endif; ?>
            <div class="col-md-12 <?php //echo (isset($_SESSION['customer_id']))? 'col-md-8' : 'col-md-12' ?>">
                <?php echo $data['content']; ?>
            </div>
        </div>
    </div>
</div>
