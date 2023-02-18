<h1><?php echo MAIN_REVIEWS; ?></h1>
<div class="container_customer_reviews allcomments">

    <?php foreach ($reviews as $review) : ?>
        <article>
            <div class="user_info_container">
                <div class="user_info">
                    <p class="quantity_like"><span><?= $review['reviews_rating'] ?></span></p>
                    <i
                            class="fa fa-thumbs-up"></i>
                    <h5>
                        <a href="<?= $review['link'] ?>" class="nik_user"><?= $review['customers_name'] ?></a>
                    </h5>
                </div>
                <time datetime="<?= $review['date_added'] ?>"><i class="fa fa-clock-o"></i><?= $review['date_added'] ?>
                </time>
            </div>
            <p class="text_review">
                <a href="<?= $review['link'] ?>"><?= $review['reviews_text'] ?></a>
            </p>
        </article>
    <?php endforeach; ?>
</div>
