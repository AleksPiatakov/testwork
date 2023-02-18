<!-- FOOTER CATEGORIES -->
<div class="col-sm-3 col-xs-6 width-20 col-item">
    <div class="section_top_footer">
        <div class="h3"><?php echo FOOTER_CATEGORIES; ?></div>
        <nav class="list_footer">
            <ul>
                <?php
                $fi = 1;
                foreach (array_keys($cat_tree) as $fcat) {
                    $current_class = ($fcat == $cPath_array['0']) ? 'class="active"' : '';
                    echo '<li><a ' . $current_class . ' href="' . tep_href_link(
                        FILENAME_DEFAULT,
                        'cPath=' . $fcat,
                        'NONSSL'
                    ) . '">' . $cat_names[$fcat] . '</a></li>';

                    if ($fi >= ($config['limit']['val'] ? (int)$config['limit']['val'] : 3)) {
                        break;
                    }
                    $fi++;
                }
                ?>
            </ul>
            <?php if (count($cat_tree) > ($config['limit']['val'] ? (int)$config['limit']['val'] : 5)) {
                echo '<a href="' . tep_href_link(FILENAME_DEFAULT, 'cPath=0', 'NONSSL') . '">' . SHOW_ALL_CATS . '</a>';
            } ?>
        </nav>
    </div>
</div>
<!-- END FOOTER CATEGORIES -->
