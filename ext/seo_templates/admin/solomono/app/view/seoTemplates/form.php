<?php
$action_form = (!empty($data['data'])) ? "update_$action" : "insert_$action";
$languages = $data['languages']->catalog_languages;
unset($languages[$data['languages']->language['code']]);
?>
<form class="form-horizontal <?= $action ?>"
      action="<?= ($_SERVER['SCRIPT_URL'] ?: $_SERVER['SCRIPT_NAME']) . '?action=' . $action_form; ?>"
      method="post" enctype="multipart/form-data">
    <?php if (!empty($data['data'])) { ?>
        <input type="hidden" name="id" value="<?= $data['data']['id'] ?>">
    <?php } ?>
    <div class="col-md-12">
        <?php
        foreach ($data['allowed_fields'] as $field_name => $option) {
            if (!isset($option['type']) || $option['hideInForm'] === true) {
                continue;
            }

            if ($option['type'] == "select") {
                if (isset($option['option']['id']) && isset($data['data'][$option['option']['id']])) {
                    $val = $data['data'][$option['option']['id']];
                } else {
                    $val = $data['data'][$field_name];
                }
            } else {
                $val = $option['value'] ?: '';
                if (!empty($data['data'][$field_name]) || $data['data'][$field_name] === '0') {
                    $val = $data['data'][$field_name];
                }
            }

            require('renderInput.php');
        }
        ?>
    </div>
    <div class="col-md-12">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#<?= $data['languages']->language['code'] ?>">
                    <img src="<?= 'images/flags/' . $data['languages']->language['code'] . '.svg' ?>" alt="lang image"
                         height="18">
                </a>
            </li>
            <?php
            foreach ($languages as $k => $v) { ?>
                <li>
                    <a data-toggle="tab" href="#<?= $v['code'] ?>">
                        <img src="<?= 'images/flags/' . $v['code'] . '.svg' ?>" alt="lang image" height="18">
                    </a>
                </li>
            <?php } ?>
        </ul>
        <div class="tab-content">
            <div id="<?= $data['languages']->language['code'] ?>" class=" col-md-8 form-group tab-pane active">
                <input class="form-control default-cursor" placeholder="<?= TABLE_HEADING_SEO_META_TITLE; ?>"
                       type="text"
                       name="seo_meta_title[<?= $data['languages']->language['id'] ?>]" size="255"
                       value="<?= $data['descriptions'][$data['languages']->language['id']]['meta_title'] ?>">
                <input class="form-control default-cursor" placeholder="<?= TABLE_HEADING_SEO_META_DESCRIPTION; ?>"
                       type="text"
                       name="seo_meta_description[<?= $data['languages']->language['id'] ?>]" size="255"
                       value="<?= $data['descriptions'][$data['languages']->language['id']]['meta_description'] ?>">
            </div>
            <?php foreach ($languages as $k => $v) { ?>
                <div id="<?= $v['code'] ?>" class=" col-md-8 form-group tab-pane">
                    <input class="form-control default-cursor" placeholder="<?= TABLE_HEADING_SEO_META_TITLE; ?>"
                           type="text"
                           name="seo_meta_title[<?= $v['id'] ?>]" size="255"
                           value="<?= $data['descriptions'][$v['id']]['meta_title'] ?>">
                    <input class="form-control default-cursor" placeholder="<?= TABLE_HEADING_SEO_META_DESCRIPTION; ?>"
                           type="text"
                           name="seo_meta_description[<?= $v['id'] ?>]" size="255"
                           value="<?= $data['descriptions'][$v['id']]['meta_description'] ?>">
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="col-md-12">
        <?php include_once '_examples.php'; ?>
    </div>
    <div class="form-group text-right">
        <div class="col-sm-12">
            <input type="submit" value="OK" class="btn">
            <button type="button" class="btn btn-info saveInputData"><?= TEXT_MODAL_APPLY_ACTION ?></button>
            <button type="button" class="btn btn-default"
                    data-dismiss="modal"><?= TEXT_MODAL_CANCEL_ACTION ?></button>
        </div>
    </div>
</form>
