<?php

$banner_block = getArticles($config['id']['val'] ?: 23, (int)($config['limit']['val'] > 0 ? $config['limit']['val']: 2), true, true);
?>
<div class="banner_block">
    <div class="row">
        <?php echo renderArticle('banner_block'); ?>
        <?php
        if ($banner_block) {
            foreach ($banner_block as $block) {
                $block['image'] = '/getimage/' . $block['image'];

                echo '<div class="col-sm-6 col-xs-12 section_banner">
                        <img alt="" class="img-responsive lazyload" src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="' . $block['image'] . '" />
                        ' . $block['desc'] . '
                    </div>';
            }
        }
        ?>
    </div>
</div>


