<table border="0" width="100%" cellspacing="0" cellpadding="<?php echo getConstantValue('CELLPADDING_SUB', '0'); ?>">
    <?php
    if ($_GET['action'] == 'process') {
        ?>
        <tr>
            <td class="main"><?php echo tep_image(
                        DIR_WS_TEMPLATES . TEMPLATE_NAME . '/images/content/man_on_board.gif',
                        HEADING_TITLE,
                        '0',
                        '0',
                        'align="left"') . TEXT_SUCCESS; ?><br><br><?php echo 'gv ' . $id1; ?>
            </td>
        </tr>
        <?php
    }
    if ($_GET['action'] == 'send' && !$error) {
        // validate entries
        $gv_amount = (double)$gv_amount;
        $gv_query = tep_db_query(
            "select customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " where customers_id = '" . $customer_id . "'");
        $gv_result = tep_db_fetch_array($gv_query);
        $send_name = $gv_result['customers_firstname'] . ' ' . $gv_result['customers_lastname'];
        ?>
        <tr>
            <td>
                <form action="<?php echo tep_href_link(FILENAME_GV_SEND, 'action=process', 'NONSSL'); ?>" method="post">
                    <table border="0" width="100%" cellspacing="0" cellpadding="2">
                        <?= csrf() ?>
                        <tr>
                            <td class="main"><?php echo sprintf(
                                    MAIN_MESSAGE,
                                    $currencies->format($_POST['amount']),
                                    $_POST['to_name'],
                                    $_POST['email'],
                                    $_POST['to_name'],
                                    $currencies->format($_POST['amount']),
                                    $send_name); ?></td>
                        </tr>
                        <?php
                        if ($_POST['message']) {
                            ?>
                            <tr>
                                <td class="main"><?php echo sprintf(
                                        PERSONAL_MESSAGE,
                                        $gv_result['customers_firstname']); ?></td>
                            </tr>
                            <tr>
                                <td class="main"><?php echo stripslashes($_POST['message']); ?></td>
                            </tr>
                            <?php
                        }

                        echo tep_draw_hidden_field('send_name', $send_name) . tep_draw_hidden_field(
                                'to_name',
                                stripslashes($_POST['to_name'])) . tep_draw_hidden_field(
                                'email',
                                $_POST['email']) . tep_draw_hidden_field(
                                'amount',
                                $gv_amount) . tep_draw_hidden_field('message', stripslashes($_POST['message']));
                        ?>
                    </table>
                </form>
            </td>
        </tr>
        <?php
    } elseif ($_GET['action'] == '' || $error) {
        ?>
        <tr>
            <td class="main"><?php echo HEADING_TEXT; ?></td>
        </tr>
        <tr>
            <td>
                <form action="<?php echo tep_href_link(FILENAME_GV_SEND, 'action=send', 'NONSSL'); ?>" method="post">
                    <table border="0" width="100%" cellspacing="0" cellpadding="2">
                        <?= csrf() ?>
                        <tr>
                            <td class="main"><?php echo ENTRY_NAME; ?><br><?php echo tep_draw_input_field(
                                    'to_name',
                                    stripslashes($_POST['to_name'])); ?></td>
                        </tr>
                        <tr>
                            <td class="main"><?php echo ENTRY_EMAIL; ?><br><?php echo tep_draw_input_field(
                                    'email',
                                    $_POST['email']);
                                if ($error) {
                                    echo $error_email;
                                } ?></td>
                        </tr>
                        <tr>
                            <td class="main"><?php echo ENTRY_AMOUNT; ?><br><?php echo tep_draw_input_field(
                                    'amount',
                                    $_POST['amount'],
                                    '',
                                    '',
                                    false);
                                if ($error) {
                                    echo $error_amount;
                                } ?></td>
                        </tr>
                        <tr>
                            <td class="main"><?php echo ENTRY_MESSAGE; ?>
                                <br><?php echo tep_draw_textarea_field(
                                    'message',
                                    'soft',
                                    50,
                                    15,
                                    stripslashes($_POST['message'])); ?></td>
                        </tr>
                    </table>
                    <table border="0" width="100%" cellspacing="0" cellpadding="2">
                        <tr>
                            <?php
                            $back = sizeof($navigation->path) - 2;
                            ?>
                            <td class="main"><?php echo '<a href="' . tep_href_link(
                                        $navigation->path[$back]['page'],
                                        tep_array_to_string($navigation->path[$back]['get'], array('action')),
                                        $navigation->path[$back]['mode']) . '">' . tep_template_image_button(
                                        'button_back.gif',
                                        IMAGE_BUTTON_BACK) . '</a>'; ?></td>
                        </tr>
                    </table>
                </form>
            </td>
        </tr>
        <?php
    }
    ?>
</table></td>
