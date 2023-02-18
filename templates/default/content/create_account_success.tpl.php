<h2>
    <center><?php echo HEADING_TITLE; ?></center>
</h2>

<p class="text-center"><?php echo sprintf(
    TEXT_ACCOUNT_CREATED,
    tep_href_link(FILENAME_CONTACT_US),
    tep_href_link(FILENAME_CONTACT_US)
); ?></p>

<div class="form-group">
    <p class="text-center">
        <?php echo '<a class="btn btn-lg btn-default" href="' . $origin_href . '">' . IMAGE_BUTTON_CONTINUE . '</a>'; ?>
    </p>
</div>

