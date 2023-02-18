<div class="account-created-box white-rounded-box">
    <div class="header-block">
        <h2><?php echo HEADING_TITLE; ?></h2>
    </div>
    <div class="content">
        <p class="text-center"><?php echo sprintf(
            TEXT_ACCOUNT_CREATED,
            tep_href_link(FILENAME_CONTACT_US),
            tep_href_link(FILENAME_CONTACT_US)
        ); ?></p>

        <div class="form-group">
            <p class="text-center">
                <?php echo '<a class="btn btn-lg btn-primary" href="' . $origin_href . '">' . IMAGE_BUTTON_CONTINUE . '</a>'; ?>
            </p>
        </div>
    </div>
</div>

