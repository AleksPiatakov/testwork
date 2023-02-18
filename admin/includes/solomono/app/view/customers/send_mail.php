<?php
//debug($data);
//debug($data['address_book']);
//debug($data['customers_default_address_id']);
//debug($action);

?>

<?php $action_form = "$action"; ?>
<form method="post" class="form-horizontal <?= $action ?>" action="<?= ($_SERVER['SCRIPT_URL'] ?: $_SERVER['SCRIPT_NAME']) . "?action=" . $action_form ?>">
    <div class="col-xs-12">
        <?php foreach ($data['data'] as $k => $v): ?>
            <?php $allowed_fields = $data['allowed_fields'][$k]; ?>
            <?php if (!$allowed_fields || $allowed_fields['hideInForm'] === true) continue; ?>
            <div class="form-group">
                <label for="<?= $k; ?>" class="col-sm-3 col-md-2 control-label"><?= $allowed_fields['label']; ?>
                    :</label>
                <div class="col-sm-9 col-md-10">
                    <?php if ($allowed_fields['type'] == 'select'): ?>
                        <select class="form-control" name="<?= $k; ?>" id="<?= $k; ?>">
                            <?php foreach ($v as $sk => $sv): ?>
                                <option value="<?= $sk; ?>"><?= $sv; ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php elseif ($allowed_fields['type'] == 'textarea'): ?>
                        <?php if ($allowed_fields['ckeditor'] === true): ?>
                            <div class="ckeditor_outer">
                                <textarea required class="form-control" rows="<?= $allowed_fields['rows'] ?: 6 ?>"
                                          name="<?= $k ?>"><?= $v ?></textarea>
                            </div>
                        <?php else: ?>
                            <textarea required class="form-control" rows="<?= $allowed_fields['rows'] ?: 6 ?>"
                                      name="<?= $k ?>"><?= $v ?></textarea>
                        <?php endif; ?>
                    <?php else: ?>
                        <input required type="<?= $allowed_fields['type'] ?>" value="<?= $v ?>" name="<?= $k; ?>"
                               placeholder="<?= $allowed_fields['label']; ?>" class="form-control" id="<?= $name; ?>">
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="col-xs-12 text-right">
        <input type="submit" value="OK" class="btn">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?= TEXT_MODAL_CANCEL_ACTION ?></button>
    </div>
    </div>
    <div class="row">

    </div>
</form>
<script>
    $(function () {
        CKEDITOR.disableAutoInline = true;
        var textarea = $('.ckeditor_outer textarea');
        var editor = CKEDITOR.replace(textarea.attr('name'), {
            extraPlugins : 'colorbutton,codemirror',
            startupFocus : true,
            removePlugins : 'sourcearea',
            on : {
                instanceReady : function () {
                    this.dataProcessor.htmlFilter.addRules({
                        elements : {
                            img : function (el) {
                                // Add an attribute.
                                if (!el.attributes.alt)
                                    el.attributes.alt = '';

                                // Add some class.
                                if (typeof el.attributes.class === 'undefined' || el.attributes.class.indexOf('img-responsive') == -1) {
                                    el.addClass(' img-responsive');
                                }
                                if (typeof el.attributes.class === 'undefined' || el.attributes.class.indexOf('lazyload') == -1) {
                                    el.addClass(' lazyload');
                                }
                                el.attributes.style = '';
                            }
                        }
                    });
                }
            }
        });

        editor.on('change', function (evt) {
            textarea.text(evt.editor.getData());
        });
        CKFinder.setupCKEditor(editor, '../../../../../includes/ckfinder/');
    });
</script>
