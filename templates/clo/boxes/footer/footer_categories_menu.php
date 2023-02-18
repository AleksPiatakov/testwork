<div class="col-sm-6">
    <div class="section_top_footer">
        <nav class="list_footer">
            <!--/////////////  FOOTER CATEGORY MENU /////////////-->
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
            <!--///////////// END FOOTER CATEGORY  /////////////-->
        </nav>
    </div>
</div>

