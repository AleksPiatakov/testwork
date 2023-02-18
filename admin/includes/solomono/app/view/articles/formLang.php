<?php
//echo "<pre>";
//print_r($data);
//echo "</pre>";
//debug($action);
//exit;
?>
<ul class="nav nav-tabs" id="lang">
    <?php foreach ($data['languages'] as $k => $v): ?>
        <?php $class = ($v['language_id'] == $_SESSION['languages_id'] ? ' class="active"' : ''); ?>
        <li <?php echo $class;?>>
            <a href="#" data-lang="<?php echo $k?>"><?php echo $v['code']?></a>
        </li>
    <?php endforeach; ?>
    <li>
        <a href="#" data-lang="xsell"><?php echo TEXT_RELATED_PRODUCTS?></a>
    </li>
</ul>
<?php $action_form = (!empty($data['data'])) ? "update_$action" : "insert_$action"; ?>

<form class="form-horizontal row" action="<?php echo ($_SERVER['SCRIPT_URL']?:$_SERVER['SCRIPT_NAME']) . '?action=' . $action_form;?>" method="post" enctype="multipart/form-data">
    <?php if (!empty($data['data'])): ?>
        <input type="hidden" name="id" value="<?php echo current($data['data'])['id']?>">
        <input type="hidden" name="old_tpath" value="<?php echo $data['tPath']?>">
    <?php endif; ?>
    <div class="col-sm-12 text-right articles_control_buttons articles_control_buttons_top">  
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo TEXT_MODAL_CANCEL_ACTION?></button>
        <button type="button" class="btn btn-info saveInputData"><?php echo TEXT_MODAL_APPLY_ACTION?></button>
        <input type="submit" value="<?php echo IMAGE_SAVE; ?>" class="btn btn-success">
    </div>
    <div class="col-md-2">
        <h3><?php echo TEXT_GENERAL_SETTING;?></h3>
        <?php if (!empty($data['category'])): ?>
                <div>
                    <label for="topics_id" class="col-sm-12 control-label article_field_header"><?php echo addDoubleDot(HEADING_CATEGORY)?></label>
                    <select class="form-control" name="topics_id">
                        <?php echo $data['category'];?>
                    </select>
                </div>
        <?php endif; ?>
        <?php foreach ($data['allowed_fields'] as $field_name => $option): ?>
            <?php if (isset($option['general'])): ?>
                <?php $current = !empty($data['data']) ? current($data['data']) : null; ?>
                <?php $val = $current[$field_name] !== '' ? $current[$field_name] : ($option['default']?:'');
                        if (empty($val) && !empty($option['default'])) $val = $option['default'];     ?>
                    <label for="<?php echo $field_name;?>" class="col-sm-12 control-label article_field_header"><?php echo addDoubleDot($option['label']);?></label>
                    <div>
                        <?php if ($option['general'] == 'file'): ?>
                            <input type="<?php echo $option['general']?>" name="<?php echo $field_name?>" id="<?php echo $field_name?>" class="form-control">
                            <?php $path = DIR_WS_IMAGES . $val; ?>
                            <?php if (file_exists(DIR_FS_CATALOG . $path) && !is_dir(DIR_FS_CATALOG . $path)): ?>
                                <img src="/<?php echo $path;?>" style="max-width: 60px;">
                                <button data-toggle="tooltip" data-action="delete_image"  data-placement="top" title="" class="btn_own del_link" data-original-title="Удалить">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                                <span style="display: none"><?php echo TEXT_NO_IMG;?></span>
                            <?php else: ?>
                                <span><?php echo TEXT_NO_IMG;?></span>
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
                        <?php elseif ($option['general'] == 'disabled'): ?>
                            <input type="text" <?php echo $option['general'];?> value="<?php echo $val?>" id="<?php echo $field_name?>" class="form-control">
                        <?php elseif ($option['general'] == 'checkbox'): ?>
                            <div class="col-sm-8 topics_checkbox_box">
                                <input class="cmn-toggle cmn-toggle-round" <?php echo $val ? 'checked' : '';?> type="<?php echo $option['general']?>" name="<?php echo $field_name?>" id="cmn-toggle-<?php echo $field_name?>">
                                <label for="cmn-toggle-<?php echo $field_name?>"></label>
                            </div>
                        <?php else: ?>
                            <input type="<?php echo $option['general']?>" <?php echo $option['required'] ?'required': ''?> value="<?php echo $val?>" name="<?php echo $field_name?>" class="form-control <?php echo $option['class']?: ''?>" id="<?php echo $field_name?>">
                        <?php endif; ?>
                    </div>
            <?php endif; ?>
        <?php endforeach; ?>

    </div>
    <div class="col-md-10">
        <?php foreach ($data['languages'] as $k => $v): ?>
            <?php $class = ($v['language_id'] == $_SESSION['languages_id'] ? ' class="active"' : ''); ?>
            <div data-lang="<?php echo $k;?>" <?php echo $class;?>>
                <div><h3><?php echo $data['languages'][$k]['name']?></h3></div>
                <?php foreach ($data['allowed_fields'] as $field_name => $option): ?>
                    <?php if (!isset($option['type']) || $option['hideInForm'] === true) continue; ?>
                    <?php $val = (!empty($data['data'][$k][$field_name])) ? stripcslashes($data['data'][$k][$field_name]) : ''; ?>
                    <?php $field_lan = $field_name . '[' . $k . ']'; ?>
                
                    <div>
                        <span class="article_field_header"><?php echo addDoubleDot($option['label']);?></span>
                        <?php if ($option['type'] == 'textarea'): ?>
                            <textarea class="<?php echo $option['ckeditor'] === true ? 'ck_replacer' : ''?> form-control" rows="<?php echo $option['rows'] ?: 6?>" name="<?php echo $field_lan?>"><?php echo $val?></textarea>
                        <?php else: ?>
                            <input type="<?php echo $option['type']?>" value="<?php echo $val?>" name="<?php echo $field_lan?>" class="form-control" id="<?php echo $field_lan?>">
                        <?php endif; ?>
                    </div>
                  
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
        <div data-lang="xsell">
            <h3 class="text-center"><?php echo TEXT_RELATED_PRODUCTS?></h3>
            <div class="form-group">
                <label class="col-sm-12 control-label">
                    <?php echo TEXT_ADD_FIELD?>=>
                    <i onclick="createInput.call(this)" class="fa fa-lg plus fa-plus-circle" aria-hidden="true"></i>
                </label>
            </div>
            <?php if (is_array($data['xsell']) && count($data['xsell'])): ?>
                <?php for ($i = 0; $i<count($data['xsell']); $i++): ?>
                    <div class="col-sm-11">
                        <div class="form-group">
                            <input type="text" data-id="<?php echo $data['xsell'][$i]['xsell_id']?>" value="<?php echo $data['xsell'][$i]['products_name']?>" class="pr form-control disabled">
                            <i class="fa fa-lg ft_own fa-times" aria-hidden="true"></i>
                        </div>
                    </div>
                <?php endfor; ?>
            <?php endif ?>
        </div>
        <div class="text-right articles_control_buttons">  
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo TEXT_MODAL_CANCEL_ACTION?></button>
            <button type="button" class="btn btn-info saveInputData"><?php echo TEXT_MODAL_APPLY_ACTION?></button>
            <input type="submit" value="<?php echo IMAGE_SAVE; ?>" class="btn btn-success">
        </div>
    </div>
</form>