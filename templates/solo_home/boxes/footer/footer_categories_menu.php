<!-- FOOTER CATEGORIES -->
<div class="section_top_footer">
    <a href="#footer_categories" rel="nofollow" class="collapsed" data-toggle="collapse" aria-expanded="false"
       aria-controls="footer_information">
        <div class="h3"><?php echo HOME_FOOTER_CATEGORIES; ?></div>
        <span class="rotate_arrow">
            <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                <path d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"></path>
            </svg>
        </span>
    </a>
    <nav class="list_footer collapse" id="footer_categories">
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
    </nav>
</div>
<!-- END FOOTER CATEGORIES -->
