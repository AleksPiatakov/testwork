<!-- FOOTER CATEGORIES -->
<div class="col-sm-4 col-xs-12">
    <div class="section_top_footer">
        <div class="h3"><?php echo FOOTER_CATEGORIES; ?></div>
        <a href="#" rel="nofollow" class="toggle-xs" title="<?php echo FOOTER_CATEGORIES; ?>" data-target="#footer_categories"></a>
        <nav class="list_footer" id="footer_categories">
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
            <!--          --><?php //if(count($cat_tree)>5) echo '<a class="show_all" href="'.tep_href_link(FILENAME_DEFAULT, 'cPath=0', 'NONSSL').'">'.SHOW_ALL_CATS.'</a>'; ?>
            <?php if (count($cat_tree) > ($config['limit']['val'] ? (int)$config['limit']['val'] : 5)) {
                echo '<li><a class="show_all" style="text-decoration: none;" onclick="window.scroll({top: 0,left: 0,behavior: \'smooth\'});">' . SHOW_ALL_CATS . '</a></li>';
            } ?>
        </nav>
    </div>
</div>
<!-- END FOOTER CATEGORIES -->
