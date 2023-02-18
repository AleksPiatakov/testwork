<div id="kabinet">
    <?php if (userExists()) : ?>
        <?php //echo '<a href=account_history.php><strong>'.LOGIN_BOX_MY_CABINET.'</strong></a> | <a href="' . tep_href_link(FILENAME_LOGOFF, '', 'NONSSL') . '">' . LOGIN_BOX_LOGOFF . '</a>'; ?>
        <div class="enter_registration">
            <div>
                <a rel="nofollow" href="<?php echo tep_href_link(FILENAME_ACCOUNT_HISTORY); ?>"
                   class="btn btn-xs btn-default">
                    <strong><?php echo LOGIN_BOX_MY_CABINET ?></strong>
                </a>
            </div>
            <a rel="nofollow" href="<?php echo tep_href_link(FILENAME_LOGOFF); ?>"
               class="registration"><?php echo LOGIN_BOX_LOGOFF ?></a>
        </div>
    <?php else : ?>
        <div class="enter_registration">
            <div class="enter">
                <a rel="nofollow" href="#" class="enter_link"><?php echo LOGIN_FROM_SITE; ?></a>
            </div>
        </div>

    <?php endif; ?>
</div>
