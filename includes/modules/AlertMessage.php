<?php
define('ALERT_MESSAGE_ARTICLE', 'alert_message');
$alertMessageArticle = renderArticle(ALERT_MESSAGE_ARTICLE);
?>
<?php if (!isset($_COOKIE['article_alert_showed']) && !empty($alertMessageArticle)) : ?>
    <div class="alert alert-danger alert-dismissible article-alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <div class="container">
            <?=$alertMessageArticle?>
            <button type="button" class="close">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z"></path>
                </svg>
            </button>
        </div>
    </div>
<?php endif; ?>