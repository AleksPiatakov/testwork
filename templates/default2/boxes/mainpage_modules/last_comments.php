<?php $comments_limit = 5;     //will add to admin settings for change
?>
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <div class="customer_reviews">
        <div class="like_h2"><?php echo MAIN_REVIEWS; ?>
            <div class="link_block">
                <a class="link_whole_list"
                   href="<?php echo tep_href_link('allcomments.html'); ?>"><?php echo MAIN_REVIEWS_ALL; ?></a>
                <span class="count_comments">(<?php echo tep_get_count_comments() ?>)</span>
            </div>
        </div>
        <div class="container_customer_reviews">
            <?php $comments = tep_get_last_comments($comments_limit);
            foreach ($comments as $comment) { ?>
                <div class="block_review">
                    <div class="user_info">
                        <a class="nik_user" href="#"><?php echo $comment['name'] ?></a>
                        <a class="model_review" href="<?php echo tep_href_link('p-' . $comment['pid'] . '.html'); ?>">
                            - <?php echo $comment['products_name'] ?></a>
                        <span class="quantity_like"><?php echo $comment['rating'] ?>
                            <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M496.656 285.683C506.583 272.809 512 256 512 235.468c-.001-37.674-32.073-72.571-72.727-72.571h-70.15c8.72-17.368 20.695-38.911 20.695-69.817C389.819 34.672 366.518 0 306.91 0c-29.995 0-41.126 37.918-46.829 67.228-3.407 17.511-6.626 34.052-16.525 43.951C219.986 134.75 184 192 162.382 203.625c-2.189.922-4.986 1.648-8.032 2.223C148.577 197.484 138.931 192 128 192H32c-17.673 0-32 14.327-32 32v256c0 17.673 14.327 32 32 32h96c17.673 0 32-14.327 32-32v-8.74c32.495 0 100.687 40.747 177.455 40.726 5.505.003 37.65.03 41.013 0 59.282.014 92.255-35.887 90.335-89.793 15.127-17.727 22.539-43.337 18.225-67.105 12.456-19.526 15.126-47.07 9.628-69.405zM32 480V224h96v256H32zm424.017-203.648C472 288 472 336 450.41 347.017c13.522 22.76 1.352 53.216-15.015 61.996 8.293 52.54-18.961 70.606-57.212 70.974-3.312.03-37.247 0-40.727 0-72.929 0-134.742-40.727-177.455-40.727V235.625c37.708 0 72.305-67.939 106.183-101.818 30.545-30.545 20.363-81.454 40.727-101.817 50.909 0 50.909 35.517 50.909 61.091 0 42.189-30.545 61.09-30.545 101.817h111.999c22.73 0 40.627 20.364 40.727 40.727.099 20.363-8.001 36.375-23.984 40.727zM104 432c0 13.255-10.745 24-24 24s-24-10.745-24-24 10.745-24 24-24 24 10.745 24 24z"></path>
                            </svg>
                        </span>
                    </div>
                    <div class="text_review">
                        <a href="#"><?php echo $comment['text'] ?></a>
                    </div>
                    <time class="time_review" datetime=""><?php echo $comment['date'] ?></time>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- END REVIEWS -->
