<div class="wrapper-title">
    <div role="tabpanel">
        <!-- List group -->
        <div class="list-group" id="cache" role="tablist">
            <a class="list-group-item list-group-item-action" data-toggle="list" href="#settings" role="tab">Settings
            </a>
            <a class="list-group-item list-group-item" data-toggle="list" href="#stores" role="tab">Store list</a>
        </div>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="settings" role="tabpanel">
                <a href="?action=cache_clear">Cache clear</a>
            </div>
            <div class="tab-pane active" id="stores" role="tabpanel">
                <?php
                foreach (include ROOT_DIR . '/config/cache.php' as $key => $options): ?>
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#<?= $key ?>"
                       role="tab"><?= $key ?></a>
                <?php
                endforeach; ?>
            </div>
        </div>
    </div>
</div>
