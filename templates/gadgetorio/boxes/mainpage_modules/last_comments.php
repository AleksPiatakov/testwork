<?php if (
    defined('COMMENTS_MODULE_ENABLED') && COMMENTS_MODULE_ENABLED == 'true' && !$template->show(
        "M_ARTICLES_MAIN"
    )
) : ?>
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
                <?php
                if (is_file(DIR_WS_EXT . 'reviews/last_comments.php')) {
                    include_once(DIR_WS_EXT . 'reviews/last_comments.php');
                } else {
                    $reviews = [];
                }
                ?>
                <?php foreach ($reviews as $review) : ?>
                    <article>
                        <div class="user_info_container">
                            <div class="user_info">
                                <p class="quantity_like"><span><?= $review['reviews_rating'] ?></span></p>
                                <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M104 224H24c-13.255 0-24 10.745-24 24v240c0 13.255 10.745 24 24 24h80c13.255 0 24-10.745 24-24V248c0-13.255-10.745-24-24-24zM64 472c-13.255 0-24-10.745-24-24s10.745-24 24-24 24 10.745 24 24-10.745 24-24 24zM384 81.452c0 42.416-25.97 66.208-33.277 94.548h101.723c33.397 0 59.397 27.746 59.553 58.098.084 17.938-7.546 37.249-19.439 49.197l-.11.11c9.836 23.337 8.237 56.037-9.308 79.469 8.681 25.895-.069 57.704-16.382 74.757 4.298 17.598 2.244 32.575-6.148 44.632C440.202 511.587 389.616 512 346.839 512l-2.845-.001c-48.287-.017-87.806-17.598-119.56-31.725-15.957-7.099-36.821-15.887-52.651-16.178-6.54-.12-11.783-5.457-11.783-11.998v-213.77c0-3.2 1.282-6.271 3.558-8.521 39.614-39.144 56.648-80.587 89.117-113.111 14.804-14.832 20.188-37.236 25.393-58.902C282.515 39.293 291.817 0 312 0c24 0 72 8 72 81.452z"></path>
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
                <?php if (
                defined('COMMENTS_MODULE_ENABLED') && COMMENTS_MODULE_ENABLED == 'true' && !$template->show(
                    "M_ARTICLES_MAIN"
                )
                ) : ?>
            </div>
        </div>
    </div>
</div>
<!-- END REVIEWS -->
<?php endif; ?>
