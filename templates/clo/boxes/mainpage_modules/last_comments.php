<?php if (
    defined('COMMENTS_MODULE_ENABLED') && COMMENTS_MODULE_ENABLED == 'true' && !$template->show(
        "M_ARTICLES_MAIN"
    )
) : ?>
    <div class="container">
    <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <!-- REVIEWS -->
    <div class="customer_reviews">
    <div class="like_h2"><?php echo MAIN_REVIEWS; ?>
        <a href="<?php echo tep_href_link('allcomments.html'); ?>"><span><?php echo MAIN_REVIEWS_ALL; ?></span>&nbsp;&raquo;
        </a>
    </div>
    <div class="container_customer_reviews">
<?php endif; ?>
<?php
$comments_limit = '';
if (COMMENTS_MODULE_ENABLED == 'true') {
    if (is_file(DIR_WS_EXT . 'reviews/last_comments.php')) {
        include_once(DIR_WS_EXT . 'reviews/last_comments.php');
    } else {
        $reviews = [];
    }
}
?>
<?php if (
    defined('COMMENTS_MODULE_ENABLED') && COMMENTS_MODULE_ENABLED == 'true' && !$template->show(
        "M_ARTICLES_MAIN"
    )
) : ?>
    </div>
    </div>
    <!-- END REVIEWS -->
    </div>
    </div>
    </div>
<?php endif; ?>
