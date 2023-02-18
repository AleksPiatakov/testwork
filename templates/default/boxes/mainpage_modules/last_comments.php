<?php if (
    defined('COMMENTS_MODULE_ENABLED') && COMMENTS_MODULE_ENABLED == 'true' && !$template->show(
        "M_ARTICLES_MAIN"
    )
) :
    if (!$template->getMainconf('MC_SHOW_LEFT_COLUMN') || isMobile()) {
        echo '<div class="' . ($template->getModuleSetting(
            'MAINPAGE',
            'M_LAST_COMMENTS',
            'content_width'
        ) ? 'container' : 'container-fluid') . '">';
    } ?>
    <!-- REVIEWS -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="customer_reviews white-rounded-box">
            <div class="like_h2">
                <?php echo MAIN_REVIEWS; ?>
                <a href="<?php echo tep_href_link('allcomments.html'); ?>" class="view-all-btn">
                    <?php echo MAIN_REVIEWS_ALL; ?>
                </a>
            </div>
            <div class="container_customer_reviews">
<?php endif; ?>
                <?php //check file
                if (is_file(DIR_WS_EXT . 'reviews/last_comments.php')) {
                    include_once(DIR_WS_EXT . 'reviews/last_comments.php');
                } else {
                    $reviews = [];
                } ?>
                <?php foreach ($reviews as $review) : ?>
                    <article>
                        <div class="user_info_container">
                            <div class="user_info">
                                <p class="quantity_like"><span><?= $review['reviews_rating'] ?></span></p>
                                <svg enable-background="new 0 0 24 24" height="512" viewBox="0 0 24 24"
                                     width="512" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m23.363 8.584-7.378-1.127-3.307-7.044c-.247-.526-1.11-.526-1.357 0l-3.306 7.044-7.378 1.127c-.606.093-.848.83-.423 1.265l5.36 5.494-1.267 7.767c-.101.617.558 1.08 1.103.777l6.59-3.642 6.59 3.643c.54.3 1.205-.154 1.103-.777l-1.267-7.767 5.36-5.494c.425-.436.182-1.173-.423-1.266z"
                                          fill="#ffc107"/>
                                </svg>
	                            <a href="<?= $review['link'] ?>" class="nik_user nik_user_h5"><?= $review['customers_name'] ?></a>
                            </div>
                            <time datetime="<?= $review['date_added'] ?>">
                                <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm61.8-104.4l-84.9-61.7c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v141.7l66.8 48.6c5.4 3.9 6.5 11.4 2.6 16.8L334.6 349c-3.9 5.3-11.4 6.5-16.8 2.6z"></path>
                                </svg>
                                <?= $review['date_added'] ?>
                            </time>
                        </div>
                        <p class="text_review">
                            <a href="<?= $review['link'] ?>"><?= $review['reviews_text'] ?></a>
                        </p>
                    </article>
                <?php endforeach; ?>
                <?php
                //                $comments_limit = '';
                //                if (COMMENTS_MODULE_ENABLED == 'true') require('ext/reviews/commentit/last.php');
                ?>
                <?php if (
                defined('COMMENTS_MODULE_ENABLED') && COMMENTS_MODULE_ENABLED == 'true' && !$template->show(
                    "M_ARTICLES_MAIN"
                )
) : ?>
            </div>
        </div>
    </div>
</div>
    <?php if (!$template->getMainconf('MC_SHOW_LEFT_COLUMN') || isMobile()) {
        echo '</div>';
    }
                endif; ?>
<!-- END REVIEWS -->
