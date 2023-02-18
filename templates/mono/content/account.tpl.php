<div id="account-menu">
    <h1><?php echo MY_NAVI; ?></h1>
    <div>
        <p>
            <?php echo '<a class="btn btn-xs btn-default" href="' . tep_href_link(
                FILENAME_ACCOUNT_HISTORY,
                '',
                'SSL'
            ) . '">' . MY_ORDERS_VIEW . '</a>'; ?>
        </p>
        <p>
            <?php echo '<a class="btn btn-xs btn-default" href="' . tep_href_link(
                FILENAME_ACCOUNT_EDIT,
                '',
                'SSL'
            ) . '">' . MY_INFO . '</a>'; ?>
        </p>
        <p>
            <?php echo '<a class="btn btn-xs btn-default" href="' . tep_href_link(
                FILENAME_ADDRESS_BOOK,
                '',
                'SSL'
            ) . '">' . EDIT_ADDRESS_BOOK . '</a>'; ?>
        </p>
        <p>
            <?php echo '<a class="btn btn-xs btn-default" href="' . tep_href_link(
                FILENAME_ACCOUNT_PASSWORD,
                '',
                'SSL'
            ) . '">' . MY_ACCOUNT_PASSWORD . '</a>'; ?>
        </p>
    </div>

</div>
