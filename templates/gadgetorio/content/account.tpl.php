<div id="account-menu">
    <ul>
        <li><?php echo '<a ' . ($content . '.php' == FILENAME_ACCOUNT_HISTORY ? 'class="active"' : '') . ' href="' . tep_href_link(
            FILENAME_ACCOUNT_HISTORY,
            '',
            'SSL'
        ) . '">' . MY_ORDERS_VIEW . '</a>'; ?></li>
        <li><?php echo '<a ' . ($content . '.php' == FILENAME_ACCOUNT_EDIT ? 'class="active"' : '') . ' href="' . tep_href_link(
            FILENAME_ACCOUNT_EDIT,
            '',
            'SSL'
        ) . '">' . MY_INFO . '</a>'; ?></li>
        <li><?php echo '<a ' . ($content . '.php' == FILENAME_ADDRESS_BOOK ? 'class="active"' : '') . ' href="' . tep_href_link(
            FILENAME_ADDRESS_BOOK,
            '',
            'SSL'
        ) . '">' . EDIT_ADDRESS_BOOK . '</a>'; ?></li>
        <li><?php echo '<a ' . ($content . '.php' == FILENAME_ACCOUNT_PASSWORD ? 'class="active"' : '') . ' href="' . tep_href_link(
            FILENAME_ACCOUNT_PASSWORD,
            '',
            'SSL'
        ) . '">' . MY_ACCOUNT_PASSWORD . '</a>'; ?></li>
        <li>
            <a href="<?php echo tep_href_link(FILENAME_LOGOFF); ?>" class="registration reg_solo_health"
               title=""><?php echo LOGIN_BOX_LOGOFF ?></a>
        </li>
    </ul>
</div>
