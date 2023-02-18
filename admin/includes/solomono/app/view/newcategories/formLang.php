<?php
//echo "<pre>";
//print_r($data);
//echo "</pre>";
//debug($action);
//exit;
$is_product = isset($_GET['action']) && in_array(
        $_GET['action'],
        ['edit_products_description', 'new_products_description']
    );
?>
<ul class="nav nav-tabs" id="lang">
    <?php foreach ($data['languages'] as $k => $v):
        $class = $v['language_id'] == $_SESSION['languages_id'] ? ' class="active"' : ''; ?>

        <li <?= $class; ?> class="new-category_custom_li">
            <div class="langs-flag">
                <img src="images/flags/<?= $v['code'] ?>.svg" alt="">
            </div>
            <a href="#<?= $v['code'] ?>" data-lang="<?= $k ?>"><?= $v['code'] ?></a>
        </li>
    <?php endforeach; ?>
    <?php if ($is_product): ?>
        <li>
            <div class="langs-flag"></div>
            <a href="#xsell" data-lang="xsell"><?= TEXT_RELATED_PRODUCTS ?></a>
        </li>
        <?php
        $tabsPath = DIR_FS_ADMIN . DIR_WS_INCLUDES . 'newcategories/tabs/';
        $tabs = scandir($tabsPath);
        $ignoreFiles = ['.', '..'];
        $tabs = array_filter($tabs, function($tab) use($ignoreFiles) {return !in_array($tab, $ignoreFiles);});
        $tabs = array_reverse($tabs);

        foreach ($tabs as $tab) {
            if (file_exists($tabsPath . $tab)) {
                $tabCode = explode('.', $tab)[0];
                $tabName = defined('TEXT_'.strtoupper($tabCode))?constant('TEXT_'.strtoupper($tabCode)):$tabCode; ?>
                <li>
                    <div class="langs-flag"></div>
                    <a href="#<?= str_replace('tab_', '', $tabCode) ?>" data-lang="<?php echo $tabCode; ?>"><?= $tabName ?></a>
                </li>
            <?php }
        }
    endif; ?>

</ul>
<?php $action_form = (!empty($data['data'])) ? "update_$action" : "insert_$action"; ?>
<form class="form-horizontal row"
      action="<?= ($_SERVER['SCRIPT_URL'] ?: $_SERVER['SCRIPT_NAME']) . '?action=' . $action_form; ?>"
      method="post" enctype="multipart/form-data">
    <?php if (!empty($data['data'])): ?>
        <input type="hidden" name="id" value="<?= current($data['data'])['id'] ?>">
        <input type="hidden" name="old_tpath" value="<?= $data['tPath'] ?>">
    <?php endif; ?>
    <div class="col-sm-12 text-right products_control_buttons products_control_buttons_top">
        <button
            <?php
            if(!$is_product) {
                echo 'onclick="javascript:window.location.reload()"';
            } ?>
            type="button" class="btn btn-default"
            data-dismiss="modal"><?= TEXT_MODAL_CANCEL_ACTION ?></button>
        <button type="button" class="btn btn-info saveInputData"><?= TEXT_MODAL_APPLY_ACTION ?></button>
        <input type="submit" value="<?= IMAGE_SAVE; ?>" class="btn btn-success">
    </div>
    <div class="col-md-2">
        <h3><?= TEXT_GENERAL_SETTING; ?></h3>
        <?php
        foreach ($data['allowed_fields'] as $field_name => $option):
            if (isset($option['general'])):
                $current = !empty($data['data']) ? current($data['data']) : null;
                $val = $current[$field_name] !== '' ? $current[$field_name] : ($option['default'] ?: '');
                if (empty($val) && !empty($option['default'])) {
                    $val = $option['default'];
                } ?>
                <label for="<?= $field_name; ?>"
                       class="col-sm-12 control-label products_field_header"><?= addDoubleDot($option['label']); ?></label>
                <div>
                    <?php if ($option['general'] == 'file'): ?>
                        <input type="<?= $option['general'] ?>" name="<?= $field_name ?>"
                               id="<?= $field_name ?>" class="form-control">
                        <?php
                        if ($is_product) {
                            $path = DIR_WS_IMAGES . 'products/' . $val;
                        } else {
                            $path = DIR_WS_IMAGES . 'categories/' . $val;
                        }

                        if (file_exists(DIR_FS_CATALOG . $path) && !is_dir(DIR_FS_CATALOG . $path)): ?>
                            <img src="/<?= $path; ?>" style="max-width: 60px;">
                            <button data-toggle="tooltip" data-action="delete_image" data-placement="top" title=""
                                    class="btn_own del_link" data-original-title="Удалить">
                                <i class="fa fa-trash-o"></i>
                            </button>
                            <span style="display: none"><?= TEXT_NO_IMG; ?></span>
                        <?php else: ?>
                            <span><?= TEXT_NO_IMG; ?></span>
                        <?php endif; ?>
                    <?php elseif ($option['general'] == 'select'): ?>
                        <select class="form-control" name="<?= $field_name; ?>" id="<?= $field_name; ?>">
                            <?php foreach ($data['option'][$field_name] as $k => $v): ?>
                                <option value="<?= $k; ?>" <?= $k == $data['data']['1'][$field_name] ? 'selected' : ''; ?> ><?= $v; ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php elseif ($option['general'] == 'disabled'): ?>
                        <input type="text" <?= $option['general']; ?> value="<?= $val ?>"
                               id="<?= $field_name ?>" class="form-control">
                    <?php elseif ($option['general'] == 'checkbox'): ?>
                        <div class="col-sm-8 categories_checkbox_box">
                            <input class="cmn-toggle cmn-toggle-round" <?= $val ? 'checked' : ''; ?>
                                   type="<?= $option['general'] ?>" name="<?= $field_name ?>"
                                   id="cmn-toggle-<?= $field_name ?>">
                            <label for="cmn-toggle-<?= $field_name ?>"></label>
                        </div>
                    <?php else: ?>
                        <input type="<?= $option['general'] ?>" <?= $option['required'] ? 'required' : '' ?>
                               value="<?= $val ?>" name="<?= $field_name ?>"
                               class="form-control <?= $option['class'] ?: '' ?>" id="<?= $field_name ?>">
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div class="col-md-10">
        <?php foreach ($data['languages'] as $k => $v):
            $class = ($v['language_id'] == $_SESSION['languages_id'] ? ' class="active"' : ''); ?>
            <div data-lang="<?= $k; ?>" <?= $class; ?>>
                <div><h3><?= $data['languages'][$k]['name'] ?></h3></div>
                <?php foreach ($data['allowed_fields'] as $field_name => $option):
                    if (!isset($option['type']) || $option['hideInForm'] === true) {
                        continue;
                    }
                    $val = (!empty($data['data'][$k][$field_name])) ? stripcslashes($data['data'][$k][$field_name]) : '';
                    $field_lan = $field_name . '[' . $k . ']'; ?>
                    <div>
                        <span class="products_field_header"><?= addDoubleDot($option['label']); ?></span>
                        <?php if ($option['type'] == 'textarea'): ?>
                            <textarea
                                    class="<?= $option['ckeditor'] === true ? 'ck_replacer' : '' ?> form-control"
                                    rows="<?= $option['rows'] ?: 6 ?>"
                                    name="<?= $field_lan ?>"><?= $val ?></textarea>
                        <?php else: ?>
                            <input type="<?= $option['type'] ?>" value="<?= $val ?>"
                                   name="<?= $field_lan ?>" class="form-control" id="<?= $field_lan ?>">
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
        <div data-lang="xsell">
            <h3 class="text-center"><?= TEXT_RELATED_PRODUCTS ?></h3>
            <div class="form-group">
                <label class="col-sm-12 control-label">
                    <?= TEXT_ADD_FIELD ?>=>
                    <i onclick="createInput.call(this)" class="fa fa-lg plus fa-plus-circle" aria-hidden="true"></i>
                </label>
            </div>
            <?php if (count($data['xsell'])): ?>
                <?php for ($i = 0; $i < count($data['xsell']); $i++): ?>
                    <div class="col-sm-11">
                        <div class="form-group">
                            <input type="text" data-id="<?= $data['xsell'][$i]['xsell_id'] ?>"
                                   value="<?= $data['xsell'][$i]['products_name'] ?>"
                                   class="pr form-control disabled">
                            <i class="fa fa-lg ft_own fa-times" aria-hidden="true"></i>
                        </div>
                    </div>
                <?php endfor; ?>
            <?php endif ?>
        </div>
        <?php

        foreach ($tabs as $tab) {
            if (file_exists($tabsPath . $tab)) {
                require $tabsPath.$tab;
            }
        }
        ?>
        <div class="text-right products_control_buttons">
            <button type="button" class="btn btn-default"
                    data-dismiss="modal"><?= TEXT_MODAL_CANCEL_ACTION ?></button>
            <button type="button" class="btn btn-info saveInputData"><?= TEXT_MODAL_APPLY_ACTION ?></button>
            <input type="submit" value="<?= IMAGE_SAVE; ?>" class="btn btn-success">
        </div>
    </div>
</form>