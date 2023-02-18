<?php

$footer_contacts = renderArticle('contacts_footer');
if (!empty($footer_contacts)) { ?>
    <!-- FOOTER CONTACTS -->
    <div class="h3"><?php echo FOOTER_CONTACTS; ?></div>
    <a href="#" rel="nofollow" class="toggle-xs" data-target="#footer_contacts"></a>
    <div class="phones" id="footer_contacts"><?php echo $footer_contacts; ?></div>
    <!-- END FOOTER CONTACTS -->
<?php }
