<?php
require(DIR_FS_CATALOG . 'better_together_marketing.php');

if (count($bt_strings) > 0) : ?>
    <div class="like_h2"><?= PROD_BETTER_TOGETHER ?></div>
    <div class="better_together">
        <?php foreach ($bt_strings as $bt_string) {
            echo tep_draw_form('add_set', tep_href_link(FILENAME_DEFAULT, 'action=add_set', 'NONSSL'));
            echo $bt_string;
            echo '</form>';
        } ?>
    </div>
<?php endif;
