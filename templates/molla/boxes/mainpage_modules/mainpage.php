<?php if (!$template->getMainconf('MC_SHOW_LEFT_COLUMN') || isMobile()) {
    echo '<div class="' . ($template->getModuleSetting(
        'MAINPAGE',
        'M_MAINPAGE',
        'content_width'
    ) ? 'container' : 'container-fluid') . '">';
} ?>
    <div class="magazine_articles">
        <?php echo renderArticle($config['id']['val'] ?: 'mainpage'); ?>
    </div>
<?php if (!$template->getMainconf('MC_SHOW_LEFT_COLUMN') || isMobile()) {
    echo '</div>';
} ?>
