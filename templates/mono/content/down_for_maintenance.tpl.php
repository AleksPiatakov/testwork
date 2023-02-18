<table border="0" width="100%" cellspacing="0" cellpadding="<?php echo getConstantValue('CELLPADDING_SUB', '0'); ?>">
    <tr>
        <td><br>
            <table border="0" width="100%" cellspacing="0" cellpadding="2">
                <tr>
                    <td class="main"><?php echo DOWN_FOR_MAINTENANCE_TEXT_INFORMATION; ?></td>
                </tr>
                <?php if (DISPLAY_MAINTENANCE_TIME == 'true') { ?>
                    <tr>
                        <td class="main"><?php echo TEXT_MAINTENANCE_ON_AT_TIME . TEXT_DATE_TIME; ?></td>
                    </tr>
                    <?php
                }
                if (DISPLAY_MAINTENANCE_PERIOD == 'true') { ?>
                    <tr>
                        <td class="main"><?php echo TEXT_MAINTENANCE_PERIOD . TEXT_MAINTENANCE_PERIOD_TIME; ?></td>
                    </tr>
                <?php } ?>
            </table>
        </td>
    </tr>
    <tr>
        <td align="right" class="main"><br><?php echo DOWN_FOR_MAINTENANCE_STATUS_TEXT; ?></td>
    </tr>
</table>
