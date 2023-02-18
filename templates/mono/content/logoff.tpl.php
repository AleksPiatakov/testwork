<div style="width:300px; margin:0 auto;">
    <table border="0" width="100%" cellspacing="0"
           cellpadding="<?php echo getConstantValue('CELLPADDING_SUB', '0'); ?>">
        <tr>
            <td align="center"><h1><?php echo HEADING_TITLE; ?></h1></td>
        </tr>
        <tr>
            <td align="center">
                <p><?php echo TEXT_MAIN; ?></p>
            </td>
        </tr>
        <tr>
            <td align="center"><?php echo '<a class="btn bold yellow" href="' . tep_href_link(
                FILENAME_DEFAULT
            ) . '">' . IMAGE_BUTTON_CONTINUE . '</a>'; ?></td>
        </tr>
    </table>
</div>
