<?php $instagramPath = '/ext/instagram/insta_feed.php';
$instagramConfig = $template->checkConfig('MAINPAGE', 'M_INSTAGRAM');
if (file_exists($rootPath . $instagramPath) && $template->show(
        'M_INSTAGRAM') && !empty($instagramConfig['url']['val'])) {
    include $rootPath . $instagramPath;
    if ((!$template->getMainconf('MC_SHOW_LEFT_COLUMN') || isMobile()) && $content == 'index_default') { ?>
        <div class="<?php echo $template->getModuleSetting(
            'MAINPAGE',
            'M_INSTAGRAM',
            'content_width') ? 'container' : 'container-fluid'; ?> instagram_posts">
    <?php } elseif ($content == 'index_default') { ?>
        <div class="instagram_posts">
    <?php } ?>
    <div id="<?= $instaBlockId ?>" class="white-rounded-box"></div>
    </div>
<?php } ?>
