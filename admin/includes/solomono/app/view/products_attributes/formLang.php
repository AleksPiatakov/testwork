<?php
//debug($data);
//debug($action);
//exit;
?>

<?php $action_form = (!empty($data['data'])) ? "update_$action" : "insert_$action"; ?>
<?php
$type = '';
//_products_attributes_groups
if($action == 'products_attributes_groups'){
    $type = 'group';
}
//_products_options_values
if($action == 'products_options_values'){
    $type = 'value';
}
//_products_options
if($action == 'products_options'){
    $type = 'option';
}

?>

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
                                <img src="<?php echo $data['addFolder']. "/". $path;?>" style="max-width: 60px;">
                            <?php else: ?>
                                <span><?php echo TEXT_IMAGE_NONEXISTENT?></span>
                            <?php endif; ?>
                        <?php elseif ($option['general'] == 'select'): ?>
                        <?php if($option['categories']) {
                            echo '<input type="hidden" name="current_categories" value="'.$current['categories'].'">';

                                $tep_get_category_tree = tep_get_category_tree();
                                echo tep_draw_pull_down_categories('categories[]', $tep_get_category_tree);
                            } else {
                            ?>
                            <select class="form-control" name="<?php echo $field_name;?>" id="<?php echo $field_name;?>" <?php echo $multiple;?>>
                                <?php foreach ($data['option'][$field_name] as $k=>$v): ?>
                                    <?php $selected = $k==$data['data'][$_SESSION["languages_id"]][$field_name]; ?>
                                    <?php $selected = $selected ?: (isset($v['selected']) ? $v['selected'] : false); ?>
                                    <option value="<?php echo $k;?>" <?php echo  $selected?'selected':''; ?> ><?php echo $v['val'];?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php } ?>
                        <?php elseif ($option['general'] == 'radio'): ?>
                            <div class="radio">
                                <label>
                                    <input type="radio" <?php echo ($val==1) ?'checked':'';?> name="<?php echo $field_name?>" value="1">
                                    true
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php echo $val?> type="radio" <?php echo empty($val) ?'checked':'';?> name="<?php echo $field_name?>" value="0">
                                    false
                                </label>
                            </div>
                        <?php elseif ($option['general'] == 'disabled'): ?>
                            <input type="text" <?php echo $option['general'];?> value="<?php echo $val?>" id="<?php echo $field_name?>" class="form-control">
                        <?php elseif ($option['general'] == 'checkbox'): ?>
                            <div class="col-sm-8 topics_checkbox_box">
                                <input class="cmn-toggle cmn-toggle-round" name="<?php echo $field_name?>" <?php echo $val ? 'checked' : '';?> type="<?php echo $option['general']?>" id="<?php echo $field_name?>">
                                <label for="<?php echo $field_name?>"></label>
                            </div>
                        <?php else: ?>
                            <input type="<?php echo $option['general']?>" value="<?php echo $val?>" name="<?php echo $field_name?>" class="form-control" id="<?php echo $field_name?>">
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div class="col-md-9" style="padding-top: 55px;">
        <div id="attributes-tabs">
            <ul>
                <?php foreach ($data['languages'] as $k => $v) { ?>
                    <li>
                        <a href="#language-<?php echo $v['language_id']; ?>">
                            <img class="tab-flag-image" src="<?='images/flags/' . $v['code'] . '.svg'?>"
                                 alt="lang image" height="18">
                        </a>
                    </li>
                <?php } ?>
            </ul>
            <?php foreach ($data['languages'] as $k => $v) { ?>
                <?php $class = $v == reset($data['languages']) ? ' class="active"' : ''; ?>
                <div id="language-<?php echo $v['language_id']; ?>" data-lang="<?php echo $k;?>" <?php echo ' class="active"'?>>
                    <?php foreach ($data['allowed_fields'] as $field_name => $option): ?>
                        <?php if (!isset($option['type']) || $option['hideInForm']===true)continue; ?>
                        <?php $val = (!empty($data['data'][$k][$field_name])) ? $data['data'][$k][$field_name] : ''; ?>
                        <?php $field_lan = $field_name . '[' . $k . ']'; ?>
                        <div class="form-group" style="display: flex; align-items: center;">
                            <label for="<?php echo $field_lan;?>" class="col-sm-3 control-label"><?php if($type == 'group') { echo TEXT_OPTION_GROUP_NAME; } elseif ($type == 'value') {echo TEXT_OPTION_VALUE_NAME;} else {echo TEXT_OPTION_NAME;} ?></label>
                            <div class="col-sm-9">
                                <?php if ($option['type'] == 'text'): ?>
                                    <textarea class="<?php echo $option['ckeditor'] === true ? 'ck_replacer' : ''?> form-control" rows="<?php echo $option['rows'] ?: 6?>" name="<?php echo $field_lan?>"><?php echo $val?></textarea>
                                <?php else: ?>
                                    <input type="<?php echo $option['type']?>" value="<?php echo $val?>" name="<?php echo $field_lan?>" class="form-control" id="<?php echo $field_lan?>">
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php if (!empty($data['AllProductsByAttrVal'])):
        $adminFolder = basename(dirname(dirname(dirname(dirname(dirname(__DIR__))))));?>
    <div class="col-md-12">
        <h3><?php echo addDoubleDot(TEXT_PRODUCTS_ON_ATTRIBUTES_VAL)?></h3>
            <div class="wrapper_products_attributes_val">
                <table class="table table-striped" style="margin-bottom: 0">
                    <?php foreach ($data['AllProductsByAttrVal'] as $k=>$v): ?>
                        <tr>
                            <td><?php echo $v['products_id']?></td>
                            <td>
                                <a target="_blank" style="color: #337ab7;" href="<?= $data['addFolder']?>/<?= $adminFolder?>/products.php?pID=<?php echo $v['products_id']?>&action=new_product"><?php echo $v['products_name']?></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
    </div>
    <?php endif; ?>
    <div class="form-group text-right">
        <div class="col-sm-12">
            <input type="submit" value="OK" class="btn">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo TEXT_MODAL_CANCEL_ACTION?></button>
        </div>
    </div>
</form>

<link rel="stylesheet" href="/includes/javascript/selectize/selectize.css" type="text/css">
<script src="/includes/javascript/selectize/selectize.js"></script>
<script>
    var select_category = $('.cat_tree_dropdown').selectize({
        valueField: 'id',
        labelField: 'name',
        placeholder: $(this).attr('data-placeholder'),
        searchField: ['name'],
        maxItems:null,
        onDropdownOpen: function () {
            $('.selectize-dropdown-content .option').each(function (i, e) {
                var nest = 0;
                var str_to_array = $(this).text().split('');
                var clean_text = $(this).text();
                for (i = 0; i <= str_to_array.length; i++) {
                    if (str_to_array[i] == '-') {
                        nest++
                        clean_text = clean_text.replace('-', '');
                    } else {
                        break;
                    }
                }

                var current_class = $(this).attr('class');
                if (current_class.indexOf("nest-") < 0) {
                    $(this).addClass('nest-' + nest);
                    $(this).html('<i class="line"></i><span>' + clean_text + '</span>');
                }

            })
        },
        onItemAdd: function (value, $item) {
            var str_to_array = $item.text().split('');
            var clean_text = $item.text();
            for (i = 0; i <= str_to_array.length; i++) {
                if (str_to_array[i] == '-') {
                    clean_text = clean_text.replace('-', '');
                } else {
                    break;
                }
            }
            $item.text(clean_text);

            if ($item.parent().parent().hasClass('redirect')) {
                $item.parent().parent().siblings('.go_to_cat').trigger('click');
            }
        },
        onInitialize: function (){
            var categories_field = $('input[name=current_categories]');
            if (categories_field.length > 0) {
                var current_categories_array = categories_field.val().split(',');
                this.setValue(current_categories_array);
            }
        }
    });
</script>