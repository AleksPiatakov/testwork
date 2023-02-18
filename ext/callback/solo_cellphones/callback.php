<!-- CALLBACK -->
<div class="call_me clearfix hidden">
    <div class="phones_header buy_one_click" id="callback" data-callback="">
        <i class="fa fa-phone"></i>
        <?php echo renderArticle($config['id']['val'] ?: 'phones'); ?>
    </div>
    <div class="time_work">
        <i class="fa fa-info"></i>
        <?php echo renderArticle($config['id_work']['val'] ?: 'time_work'); ?>
    </div>
</div>
<!-- END CALLBACK -->