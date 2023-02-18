<?php
//debug($data);
//debug($action);
//exit;
?>
<ul class="nav nav-tabs col-md-offset-3" id="lang">
    <?php foreach ($data['languages'] as $k => $v): ?>
        <?php $class = ($v['language_id'] == $_SESSION['languages_id'] ? ' class="active"' : ''); ?>
        <li <?php echo $class;?>>
            <a href="#" data-lang="<?php echo $k?>"><?php echo $v['code']?></a>
        </li>
    <?php endforeach; ?>
</ul>
<?php $action_form = (!empty($data['data'])) ? "update_$action" : "insert_$action"; ?>

<form class="form-horizontal" action="<?php echo ($_SERVER['SCRIPT_URL']?:$_SERVER['SCRIPT_NAME']) . '?action=' . $action_form;?>" method="post" enctype="multipart/form-data">
    <?php if (!empty($data['data'])): ?>
        <input type="hidden" name="id" value="<?php echo current($data['data'])['id']?>">
    <?php endif; ?>
    <div class="col-md-3">
        <h3><?php echo TEXT_GENERAL_SETTING;?></h3>
        <?php foreach ($data['allowed_fields'] as $field_name => $option): ?>
            <?php if (isset($option['general'])): ?>
                <?php $current = !empty($data['data']) ? current($data['data']) : null; ?>
                <?php $val = $current[$field_name] !== '' ? $current[$field_name] : ''; ?>
                <div class="form-group">
                    <label for="<?php echo $field_name;?>" class="col-sm-12 control-label"><?php echo addDoubleDot($option['label']);?></label for="<?php echo $field_name;?>" class="col-sm-12 control-label">
                    <div class="col-sm-12">
                        <?php if ($option['general'] == 'file'): ?>
                            <input type="<?php echo $option['general']?>" name="<?php echo $field_name?>" id="<?php echo $field_name?>" class="form-control">
                            <?php $path = DIR_WS_IMAGES . $val; ?>
                            <?php if (file_exists(DIR_FS_CATALOG . $path) && !is_dir(DIR_FS_CATALOG . $path)): ?>
                                <img src="/<?php echo $path;?>" style="max-width: 60px;">
                                <button data-toggle="tooltip" data-action="delete_image" data-placement="top" title="" class="btn_own del_link" data-original-title="Удалить">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            <?php else: ?>
                                <span><?php echo TEXT_IMAGE_NONEXISTENT?></span>
                            <?php endif; ?>
                        <?php elseif ($option['general'] == 'select'): ?>
                            <select class="form-control" name="<?php echo $field_name;?>" id="<?php echo $field_name;?>">
                                <?php foreach ($data['option'][$field_name] as $k => $v):
                                    if(is_array($v)){ ?>
                                        <?php if (is_null($data['data']['1'][$field_name])) {
                                            $selected = (isset($v['selected']) ? $v['selected'] : false);
                                        }else{
                                            $selected = $k==$data['data']['1'][$field_name];
                                        }
                                        ?>
                                        <option value="<?php echo $k;?>" <?php echo  $selected?'selected':''; ?> ><?php echo $v['val'];?></option>
                                    <?php }else{ ?>
                                        <option value="<?php echo $k;?>" <?php echo $k == $data['data']['1'][$field_name] ? 'selected' : '';?> ><?php echo $v;?></option>
                                    <?php }
                                endforeach; ?>
                            </select>
                        <?php elseif ($option['general'] == 'radio'): ?>
                            <div class="radio">
                                <label>
                                    <input type="radio" <?php echo ($val == 1) ? 'checked' : '';?> name="<?php echo $field_name?>" value="1">
                                    true
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php echo $val?> type="radio" <?php echo empty($val) ? 'checked' : '';?> name="<?php echo $field_name?>" value="0">
                                    false
                                </label>
                            </div>
                        <?php elseif ($option['general'] == 'disabled'): ?>
                            <input type="checkbox" <?php echo $option['general'];?> value="<?php echo $val?>" id="<?php echo $field_name?>" class="form-control">
                        <?php elseif ($option['general'] == 'checkbox'): ?>
                            <div class="col-sm-8 topics_checkbox_box">
                                <input class="cmn-toggle cmn-toggle-round" <?php echo $val ? 'checked' : ''; ?>
                                       type="<?php echo $option['general'] ?>" name="<?php echo $field_name ?>"
                                       id="cmn-toggle-<?php echo $field_name ?>">
                                <label for="cmn-toggle-<?php echo $field_name ?>"></label>
                            </div>
                        <?php else: ?>
                            <input type="<?php echo $option['general']?>" value="<?php echo $val?>" name="<?php echo $field_name?>" class="form-control" id="<?php echo $field_name?>">
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div class="col-md-9">
        <?php foreach ($data['languages'] as $k => $v): ?>
            <?php $class = ($v['language_id'] == $_SESSION['languages_id'] ? ' class="active"' : ''); ?>
            <div data-lang="<?php echo $k;?>" <?php echo $class;?>>
                <h3 class="text-center"><?php echo $data['languages'][$k]['name']?></h3>
                <?php foreach ($data['allowed_fields'] as $field_name => $option): ?>
                    <?php if (!isset($option['type']) || $option['hideInForm'] === true) continue; ?>
                    <?php $val = (!empty($data['data'][$k][$field_name])) ? $data['data'][$k][$field_name] : ''; ?>
                    <?php $field_lan = $field_name . '[' . $k . ']'; ?>
                    <div class="form-group">
                        <label for="<?php echo $field_lan;?>" class="col-sm-3 control-label"><?php echo addDoubleDot($option['label']);?></label>
                        <div class="col-sm-9">
                            <?php if ($option['type'] == 'textarea'): ?>
                                <textarea class="<?php echo $option['ckeditor'] === true ? 'ck_replacer' : ''?> form-control" rows="<?php echo $option['rows'] ?: 6?>" name="<?php echo $field_lan?>"><?php echo $val?></textarea>
                            <?php else: ?>
                                <input type="<?php echo $option['type']?>" value="<?php echo $val?>" name="<?php echo $field_lan?>" class="form-control" id="<?php echo $field_lan?>">
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="form-group text-right">
        <div class="col-sm-12">
            <input type="submit" value="OK" class="btn">
            <button type="button" class="btn btn-info saveInputData"><?php echo TEXT_MODAL_APPLY_ACTION?></button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo TEXT_MODAL_CANCEL_ACTION?></button>
        </div>
    </div>
</form>