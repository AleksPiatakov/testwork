<!-- FOOTER CATEGORIES -->
<div class="section_footer col-sm-6 col-xs-12">
    <div class="h3"><?php echo FOOTER_CATEGORIES; ?></div>
    <a href="#" rel="nofollow" class="toggle-xs" data-target="#footer_categories"></a>
    <ul class="list_footer" id="footer_categories">
        <?php
        $fi = 1;
        foreach (array_keys($cat_tree) as $fcat) {
            $current_class = ($fcat == $cPath_array['0']) ? 'class="active"' : '';
            echo '<li><a ' . $current_class . ' href="' . tep_href_link(
                FILENAME_DEFAULT,
                'cPath=' . $fcat,
                'NONSSL'
            ) . '">' . $cat_names[$fcat] . '</a></li>';

            if ($fi >= ($config['limit']['val'] ? (int)$config['limit']['val'] - 2 : 9)) {
                break;
            }
            $fi++;
        }
        ?>
        <?php if (count($cat_tree) > ($config['limit']['val'] ? (int)$config['limit']['val'] : 9)) {
            echo '<li><a class="show_all_link" href="' . tep_href_link(
                FILENAME_DEFAULT,
                'cPath=0',
                'NONSSL'
            ) . '">' . DEMO2_SHOW_ALL_CATS . '</a></li>';
        } ?>
    </ul>
</div>
<!-- END FOOTER CATEGORIES -->
