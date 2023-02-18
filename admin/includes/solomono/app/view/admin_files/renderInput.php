<div class="form-group">
    <?php if ($option['type'] == 'file'): ?>
        <div class="col-sm-4">
            <label for="<?=$field_name;?>"><?=addDoubleDot($option['label']);?></label>
        </div>
        <div class="col-sm-8">
            <input type="<?=$option['type']?>" name="<?=$field_name?>" id="<?=$field_name?>" class="form-control">
        </div>
        <?php $path = DIR_WS_IMAGES . $val; ?>
        <?php if (file_exists(DIR_FS_CATALOG . $path) && !is_dir(DIR_FS_CATALOG . $path)): ?>
            <img src="/<?=$path;?>" style="max-width: 60px;">
            <button data-toggle="tooltip" data-action="delete_image" data-placement="top" title="" class="btn_own del_link" data-original-title="Удалить">
                <i class="fa fa-trash-o"></i>
            </button>
            <span style="display: none">Нет картинки</span>
        <?php else: ?>
            <span>Нет картинки</span>
        <?php endif; ?>
    <?php elseif ($option['type'] == 'textarea'): ?>
        <div class="col-sm-4">
            <label for="<?=$field_name;?>"><?=addDoubleDot($option['label']);?></label>
        </div>
        <?php if ($option['ckeditor'] === true): ?>
            <div class="ckeditor_outer col-sm-8">
                <textarea class="form-control" rows="<?=$option['rows'] ?: 6?>" name="<?=$field_name?>"><?=$val?></textarea>
                <div class="ck_replacer">
                    <?=$val?>
                </div>
            </div>
        <?php else: ?>
            <div class="col-sm-8">
                <textarea <?=$option['params'] ? : '';?> class="form-control" id="<?=$field_name?>" rows="<?=$option['rows'] ?: 6?>" name="<?=$field_name?>"><?=$val?></textarea>
            </div>
        <?php endif; ?>
    <?php elseif ($option['type'] == 'checkbox'): ?>
        <div class="col-sm-4">
            <label for="<?=$field_name;?>"><?=addDoubleDot($option['label']);?></label>
        </div>
        <div class="col-sm-8">
            <input class="cmn-toggle cmn-toggle-round" <?=$val ? 'checked' : '';?> type="<?=$option['type']?>" name="<?=$field_name?>" id="cmn-toggle-<?=$field_name?>">
            <label for="cmn-toggle-<?=$field_name?>"></label>
        </div>
    <?php elseif ($option['type'] == 'select'): ?>
        <div class="col-sm-4">
            <label><?=addDoubleDot($option['label']);?></label>
        </div>
        <div class="col-sm-8">
            <select  <?=$option['params'] ? : '';?> name="<?=$field_name?><?=(strpos($option['params'], 'multiple') !== false) ? '[]' : '';?>" id="<?=$field_name?>" class="form-control">
                <?php if (is_array($data['option'][$field_name])): ?>
                    <?php foreach ($data['option'][$field_name] as $id => $v): ?>
                        <?php if ($id=='disabled'): ?>
                            <option <?=$id;?> selected><?=$v?></option>
                        <?php else: ?>
                            <option <?=$id == $val ? 'selected' : '';?> value="<?=$id?>"><?=$v?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?=$data['option'][$field_name];?>
                <?php endif; ?>
            </select>
        </div>
    <?php elseif ($option['type'] == 'disabled'): ?>
        <div class="col-sm-4">
            <label for="<?=$field_name;?>"><?=addDoubleDot($option['label']);?></label>
        </div>
        <div class="col-sm-8">
            <input type="text" <?=$option['type'];?> value="<?=$val?>" id="<?=$field_name?>" class="form-control">
        </div>
    <?php elseif ($option['type'] == 'hidden'): ?>
        <div class="col-sm-8">
            <input type="<?=$option['type'];?>" value="<?=$val?>" id="<?=$field_name?>" class="form-control">
        </div>
    <?php else: ?>
        <div class="col-sm-4">
            <label for="<?=$field_name;?>"><?=addDoubleDot($option['label']);?></label>
        </div>
        <div class="col-sm-8">
            <input <?=$option['params'] ? : '';?> type="<?=$option['type']?>" value="<?=$val?>" name="<?=$field_name?>" class="form-control <?=$option['class']?>" id="<?=$field_name?>">
        </div>
    <?php endif; ?>
</div>