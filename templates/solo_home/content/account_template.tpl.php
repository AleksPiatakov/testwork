<?php includeLanguages('includes/languages/' . $language . '/account.php'); ?>

<div class="row account_template">
    <?php if (isset($_SESSION['customer_id'])) : ?>
        <div class="col-md-4 col-sm-3">
            <?php include_once 'account.tpl.php'; ?>
        </div>
        <div class="col-md-8 col-sm-9">
            <?php echo $data['content']; ?>
        </div>
    <?php endif; ?>
</div>
