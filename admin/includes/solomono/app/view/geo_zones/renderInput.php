<div class="form-group">
    <?php if ($option['type'] == 'file'): ?>
        <div class="col-sm-4">
            <label for="<?php echo $field_name;?>"><?php echo addDoubleDot($option['label']);?></label>
        </div>
        <div class="col-sm-8">
            <input type="<?php echo $option['type']?>" name="<?php echo $field_name?>" id="<?php echo $field_name?>" class="form-control">
        </div>
        <?php $path = DIR_WS_IMAGES . $val; ?>
        <?php if (file_exists(DIR_FS_CATALOG . $path) && !is_dir(DIR_FS_CATALOG . $path)): ?>
            <img src="/<?php echo $path;?>" style="max-width: 60px;">
            <button data-toggle="tooltip" data-action="delete_image" data-placement="top" title="" class="btn_own del_link" data-original-title="Удалить">
                <i class="fa fa-trash-o"></i>
            </button>
            <span style="display: none">Нет картинки</span>
        <?php else: ?>
            <span>Нет картинки</span>
        <?php endif; ?>
    <?php elseif ($option['type'] == 'textarea'): ?>
        <div class="col-sm-4">
            <label for="<?php echo $field_name;?>"><?php echo addDoubleDot($option['label']);?></label>
        </div>
        <?php if ($option['ckeditor'] === true): ?>
            <div class="ckeditor_outer col-sm-8">
                <textarea class="form-control" rows="<?php echo $option['rows'] ?: 6?>" name="<?php echo $field_name?>"><?php echo $val?></textarea>
                <div class="ck_replacer">
                    <?php echo $val?>
                </div>
            </div>
        <?php else: ?>
            <div class="col-sm-8">
                <textarea <?php echo $option['params'] ? : '';?> class="form-control" id="<?php echo $field_name?>" rows="<?php echo $option['rows'] ?: 6?>" name="<?php echo $field_name?>"><?php echo $val?></textarea>
            </div>
        <?php endif; ?>
    <?php elseif ($option['type'] == 'checkbox'): ?>
        <div class="col-sm-4">
            <label for="<?php echo $field_name;?>"><?php echo addDoubleDot($option['label']);?></label>
        </div>
        <div class="col-sm-8">
            <input class="cmn-toggle cmn-toggle-round" <?php echo $val ? 'checked' : '';?> type="<?php echo $option['type']?>" name="<?php echo $field_name?>" id="cmn-toggle-<?php echo $field_name?>">
            <label for="cmn-toggle-<?php echo $field_name?>"></label>
        </div>
    <?php elseif ($option['type'] == 'select'): ?>
        <div class="col-sm-4">
            <label><?php echo addDoubleDot($option['label']);?></label>
        </div>
        <div class="col-sm-8">
            <select  <?php echo $option['params'] ? : '';?> name="<?php echo $field_name?><?php echo (strpos($option['params'], 'multiple') !== false) ? '[]' : '';?>" id="<?php echo $field_name?>" class="form-control">
                <?php if (is_array($data['option'][$field_name])): ?>
                    <?php foreach ($data['option'][$field_name] as $id => $v): ?>
                        <?php if ($id === 'disabled'): ?>
                            <option <?php echo $id;?> selected><?php echo $v?></option>
                        <?php else: ?>
                            <option <?php echo $id == $val ? 'selected' : '';?> value="<?php echo $id?>"><?php echo $v?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?php echo $data['option'][$field_name];?>
                <?php endif; ?>
            </select>
        </div>
    <?php elseif ($option['type'] == 'disabled'): ?>
        <div class="col-sm-4">
            <label for="<?php echo $field_name;?>"><?php echo addDoubleDot($option['label']);?></label>
        </div>
        <div class="col-sm-8">
            <input type="text" <?php echo $option['type'];?> value="<?php echo $val?>" id="<?php echo $field_name?>" class="form-control">
        </div>
    <?php elseif ($option['type'] == 'hidden'): ?>
        <div class="col-sm-8">
            <input type="<?php echo $option['type'];?>" value="<?php echo $val?>" id="<?php echo $field_name?>" class="form-control">
        </div>
    <?php else: ?>
        <div class="col-sm-4">
            <label for="<?php echo $field_name;?>"><?php echo addDoubleDot($option['label']);?></label>
        </div>
        <div class="col-sm-8">
            <input <?php echo $option['params'] ? : '';?> type="<?php echo $option['type']?>" value="<?php echo $val?>" name="<?php echo $field_name?>" class="form-control <?php echo $option['class']?>" id="<?php echo $field_name?>">
        </div>
    <?php endif; ?>
</div>