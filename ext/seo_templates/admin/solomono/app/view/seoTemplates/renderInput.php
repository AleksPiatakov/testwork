<div class="form-group">
    <?php if ($option['type'] == 'file') { ?>
        <div class="col-sm-4">
            <label for="<?= $field_name; ?>"><?= $option['label']; ?>:</label>
        </div>
        <div class="col-sm-8">
            <input type="<?= $option['type'] ?>" name="<?= $field_name ?>" id="<?= $field_name ?>" class="form-control">
        </div>
        <?php $path = DIR_WS_IMAGES . $val; ?>
        <?php if (file_exists(DIR_FS_CATALOG . $path) && !is_dir(DIR_FS_CATALOG . $path)) { ?>
            <img src="/<?= $path; ?>" style="max-width: 60px;">
            <button data-toggle="tooltip" data-action="delete_image" data-placement="top" title="" class="btn_own del_link" data-original-title="Удалить">
                <i class="fa fa-trash-o"></i>
            </button>
            <span style="display: none">Нет картинки</span>
        <?php } else { ?>
            <span>Нет картинки</span>
        <?php } ?>
    <?php } elseif ($option['type'] == 'textarea') { ?>
        <div class="col-sm-4">
            <label for="<?= $field_name; ?>"><?= $option['label']; ?>:</label>
        </div>
        <?php if ($option['ckeditor'] === true) { ?>
            <div class="ckeditor_outer col-sm-8">
                <textarea class="form-control" rows="<?= $option['rows'] ?: 6 ?>" name="<?= $field_name ?>"><?= $val ?></textarea>
                <div class="ck_replacer">
                    <?= $val ?>
                </div>
            </div>
        <?php } else { ?>
            <div class="col-sm-8">
                <textarea <?= $option['params'] ?: ''; ?> class="form-control" id="<?= $field_name ?>" rows="<?= $option['rows'] ?: 6 ?>" name="<?= $field_name ?>"><?= $val ?></textarea>
            </div>
        <?php } ?>
    <?php } elseif ($option['type'] == 'checkbox') { ?>
        <div class="col-sm-4">
            <label for="<?= $field_name; ?>"><?= $option['label']; ?>:</label>
        </div>
        <div class="col-sm-8">
            <input class="cmn-toggle cmn-toggle-round" <?= $val ? 'checked' : ''; ?> type="<?= $option['type'] ?>" name="<?= $field_name ?>" id="cmn-toggle-<?= $field_name ?>">
            <label for="cmn-toggle-<?= $field_name ?>"></label>
        </div>
    <?php } elseif ($option['type'] == 'select') { ?>
        <div <?= ($field_name == 'type' ? 'style="display: none"' : '') ?> class="col-sm-4">
            <label><?= $option['label']; ?>:</label>
        </div>
        <div <?= ($field_name == 'type' ? 'style="display: none"' : '') ?> class="col-sm-8">
            <select <?= $option['params'] ?: ''; ?> name="<?= $field_name ?><?= (strpos($option['params'], 'multiple') !== false) ? '[]' : ''; ?>" id="<?= $field_name ?>" class="form-control">
                <?php
                if (is_array($data['option'][$field_name])) {
                    foreach ($data['option'][$field_name] as $id => $v) {
                        if ($id == 'disabled') {
                            echo '<option ' . $id . ' selected>' . $v . '</option>';
                        } else {
                            echo '<option ' . ($id == $val ? 'selected' : '') . ' value="' . $id . '">' . $v . '</option>';
                        }
                    }
                } else {
                    echo $data['option'][$field_name];
                } ?>
            </select>
        </div>
    <?php } elseif ($option['type'] == 'disabled') { ?>
        <div class="col-sm-4">
            <label for="<?= $field_name; ?>"><?= $option['label']; ?>:</label>
        </div>
        <div class="col-sm-8">
            <input type="text" <?= $option['type']; ?> value="<?= $val ?>" id="<?= $field_name ?>" class="form-control default-cursor">
        </div>
    <?php } elseif ($option['type'] == 'hidden') { ?>
        <div class="col-sm-8">
            <input name="<?= $field_name ?>" type="<?= $option['type']; ?>" value="<?= $option['value']; ?>" id="<?= $field_name ?>" class="form-control">
        </div>
    <?php } else { ?>
        <div class="col-sm-4">
            <label for="<?= $field_name; ?>"><?= $option['label']; ?>:</label>
        </div>
        <div class="col-sm-8">
            <input <?= $option['required'] ? 'required' : '' ?> <?php $option['params'] ?: ''; ?> type="<?= $option['type'] ?>" value="<?= $val ?>" name="<?= $field_name ?>"
                   class="form-control <?= $option['class'] ?>" id="<?= $field_name ?>" <?= (isset($option['autofocus']) && $option['autofocus'] ? ' autofocus' : '') ?>
                   <?= (isset($option['placeholder']) && $option['placeholder'] ? 'placeholder="' . $option['placeholder'] . '"' : '') ?>>
        </div>
    <?php } ?>
</div>