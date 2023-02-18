<?php

function generateBackupHash()
{
    $phrase = 'So' . date('j') . 'Lo' . date('n') . 'Mo' . date('Y') . 'No';
    return substr(md5($phrase), strlen($phrase));
}

if (isset($_POST['method']) && in_array($_POST['method'], ['export', 'import'])) {
    $method = $_POST['method'];
    $action = $_POST['action'];
    if ($_POST['hash'] === generateBackupHash()) {
        require(DIR_WS_MODULES . 'backup/controller.php');
    } else {
        die;
    }
}
if (empty($method)) {
    $method = 'export';
}
$allTablesQuery = tep_db_query("SELECT `TABLE_NAME` FROM `information_schema`.`TABLES` WHERE `TABLE_SCHEMA` = DATABASE() ORDER BY `TABLE_NAME`");
$tables = [];
while ($row = tep_db_fetch_array($allTablesQuery)) {
    $tables[] = $row['TABLE_NAME'];
}

include_once('html-open.php');
/**
 * header
 */
include_once('header.php');
?>
<div id="spiffycalendar" class="text"></div>
<!-- body //-->
<div class="container backup">
    <!-- body_text //-->
    <h2><?= TEXT_DUMPER_HEADER_TITLE ?><i class="fa fa-spin fa-spinner" style="display:none;"></i></h2>
    <div class="row">
        <ul class="nav nav-tabs content-tabs">
            <li <?= ($method == 'export' ? ' class="active"' : '') ?>>
                <a data-toggle="tab" href="#export">
                    <?php echo BACKUP_EXPORT . " " . renderTooltip(TOOLTIP_BACKUP_CREATE); ?>
                </a>
            </li>
            <li <?= ($method == 'import' ? ' class="active"' : '') ?>>
                <a data-toggle="tab" href="#import">
                    <?php echo BACKUP_IMPORT . " " . renderTooltip(TOOLTIP_BACKUP_LOAD); ?>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="export" class="tab-pane fade<?= ($method == 'export' ? ' in active' : '') ?>">
                <div class="backup-tab-content">
                    <form method="post" class="backupForm">
                        <input type="hidden" name="method" value="export">
                        <input type="hidden" name="hash" value="<?= generateBackupHash() ?>">
                        <div class="showTables"><?= TEXT_DUMPER_SHOW_TABLES_LIST ?></div>
                        <div class="hidden">
                            <div class="check-buttons">
                                <div class="button btn-danger col-sm-1"
                                     data-check="false"><?= TEXT_CHOOSE_ALL_REMOVE ?></div>
                                <div class="button btn-success col-sm-1" data-check="true"><?= TEXT_CHOOSE_ALL ?></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="row">
                                <?php foreach ($tables as $table) { ?>
                                    <div class="checkbox col-sm-3">
                                        <label><input class="exportTable" type="checkbox" checked value="<?= $table ?>"
                                                      name="exportTables[]"><?= $table ?></label>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info"><?= TEXT_DUMPER_SUBMIT ?></button>
                    </form>
                </div>
            </div>
            <div id="import" class="tab-pane fade<?php ($method == 'import' ? ' in active' : '') ?>">
                <div class="backup-tab-content">
                    <?php $dumps = glob(BACKUP_FOLDER . '*.sql', GLOB_NOSORT);
                    usort(
                        $dumps,
                        function ($a, $b) {
                            return filemtime($b) - filemtime($a);
                        }
                    ); ?>
                    <?php foreach ($dumps as $filenameRaw) { ?>
                        <?php $filename = basename($filenameRaw); ?>
                        <?php $tablesList = explode(
                            ',',
                            substr(fgets(fopen($filenameRaw, 'r')), 3)
                        ); ?>
                        <form method="post" class="backupForm">
                            <input type="hidden" name="method" value="import">
                            <div class="row m-b">
                                <input type="hidden" name="hash" value="<?= generateBackupHash() ?>">
                                <input type="hidden" name="filename" value="<?= $filename ?>">
                                <div class="col-sm-3"><?= $filename ?></div>
                                <div class="col-sm-5">
                                    <p class="showTables"><?= TEXT_DUMPER_SHOW_TABLES_LIST ?></p>
                                    <div class="tableList hidden"><?= implode(', ', $tablesList) ?></div>
                                </div>
                                <div class="col-sm-4 button-block">
                                    <button type="submit" name="action" value="delete"
                                            class="btn btn-danger"><?= TEXT_DUMPER_DELETE ?></button>
                                    <button type="submit" name="action" value="download"
                                            class="btn btn-success m-auto"><?= TEXT_DUMPER_DOWNLOAD ?></button>
                                    <button type="submit" name="action" value="dump"
                                            class="btn btn-info"><?= TEXT_DUMPER_SUBMIT_IMPORT ?></button>
                                </div>
                            </div>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- body_text_eof //-->
</div>
<!-- body_eof //-->
<script>
    !function () {
        var lastBtn = null
        document.addEventListener('click', function (e) {
            if (!e.target.closest) return;
            lastBtn = e.target.closest('button, input[type=submit]');
        }, true);
        document.addEventListener('submit', function (e) {
            if (e.submitter) return;
            var canditates = [document.activeElement, lastBtn];
            for (var i = 0; i < canditates.length; i++) {
                var candidate = canditates[i];
                if (!candidate) continue;
                if (!candidate.form) continue;
                if (!candidate.matches('button, input[type=button], input[type=image]')) continue;
                e.submitter = candidate;
                return;
            }
            e.submitter = e.target.querySelector('button, input[type=button], input[type=image]')
        }, true);
    }();
    var callbacks = {
        __complete: function (container) {
            container.spinner.hide();
            show_tooltip('Success');
            $('.backup>.row').removeClass('disabled_module');

        },
        default: function (container) {
            var self = this;
            $.ajax({
                url: '<?=DIR_WS_ADMIN . 'backup.php'?>',
                method: 'POST',
                data: container.form,
                dataType: 'html',
                success: function (r) {
                    self.__complete(container);
                    window.location.reload();
                }
            })
        },
        download: function (container) {
            var self = this;
            $("body").append("<iframe id='fileIframe' src='/<?=$admin?>/includes/modules/backup/download.php?filename=" + container.fileName + "' style='display: none;' ></iframe>");
            self.__complete(container);
        }
    };

    $(document).ready(function () {

        $('.check-buttons>div').on('click', function () {
            $('.exportTable').prop('checked', $(this).data('check'))
        })

        $('.exportTable').on('change', function () {
            if ($('.exportTable:checked').length === 0) {
                $(this).closest('form').find('[type="submit"]').addClass('pointer_events_none')
            } else {
                $(this).closest('form').find('[type="submit"]').removeClass('pointer_events_none')
            }
        })

        $('.showTables').on('click', function () {
            $(this).next().toggleClass('hidden');
        })

        $('.backupForm').on('submit', function (e) {
            e.preventDefault();

            var container = {};
            var submitAction = e.originalEvent.submitter.value;
            submitAction = typeof submitAction !== "undefined" ? submitAction : "dump";
            if (submitAction === 'download' || confirm('<?=TEXT_MODAL_CONFIRMATION_ACTION?>')) {
                container.spinner = $('.backup .fa.fa-spin');
                var actionInput = $("<input>")
                    .attr("type", "hidden")
                    .attr("name", "action").val(submitAction);

                $(this).append(actionInput);
                container.fileName = $(this).find("[name=\"filename\"]").val();
                container.form = $(this).serialize();

                $('.backup>.row').addClass('disabled_module');
                container.spinner.show();
                if (typeof callbacks[submitAction] !== "undefined") {
                    callbacks[submitAction](container);
                } else {
                    callbacks.default(container);
                }
            }
        })
    });
</script>
