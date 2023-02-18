<?php $configs = unserialize($v['infobox_data']);
$main_modules_define_array = [
    'M_NEW_PRODUCTS',
    'M_FEATURED',
    'M_DEFAULT_SPECIALS',
    'M_BANNER_LONG',
    'M_BROWSE_CATEGORY',
    'M_BEST_SELLERS',
    'M_VIEW_PRODUCTS',
    'M_MOST_VIEWED',
    'M_MANUFACTURERS'
];
if (in_array($v['infobox_define'], $main_modules_define_array)) {
    $configs["ajax"]["type"] = "checkbox";
}
?>
<?php global $login_id ?>
<?php if ($configs) { ?>
    <button style="padding: 0 5px;" type="button" class="btn btn-default" data-toggle="collapse" data-target="#<?php echo $v['infobox_define'] ?>">
        <span class="glyphicon glyphicon-pencil"></span>
    </button>
<?php } ?>
<?php if ($login_id == "1") { ?>
    <button style="padding: 0 5px;" type="button" class="btn btn-default" data-toggle="collapse" data-target="#<?php echo $v['infobox_define'] ?>_admin">
        <span class="glyphicon glyphicon-cog"></span>
    </button>
<?php } ?>
<?php if ($v['callback_data'] == 'NEED_MINIFY') { ?>
    <a href="javascript:void(0);" title="<?= INFO_ICON_NEED_MINIFY ?>">
        <span class="glyphicon glyphicon-info-sign" style="color: #2172ff"></span>
    </a>
<?php } ?>
<div style="width: calc(100% + 40px);" class="collapse changeable" id="<?php echo $v['infobox_define'] ?>">
    <table class="table" style="margin-bottom: 0;">
        <tbody>
        <?php if (is_array($configs)) {
            foreach ($configs as $key => $config) { ?>
                <tr>
                    <td style="border: none;padding: 5px 10px;min-width: 70px;"><?php echo $config['label'] ? constant($config['label']) : $key; ?></td>
                    <td style="border: none;padding: 5px 10px;" class="cell val" data-module="<?php echo $const; ?>" data-const="<?php echo $v['infobox_define']; ?>" data-field="<?php echo $key; ?>">
                        <?php if ($method = $config['callable']) { ?>
                            <?php if (method_exists($this->getObject(), $method)) { ?>
                                <?php echo $this->getObject()->$method($configs, $key) ?>
                            <?php } ?>
                        <?php } elseif ($config['type'] == 'checkbox') { ?>
                            <input type="<?= $config['type'] ?>" class="cmn-toggle cmn-toggle-round" id="<?= $key . $v['infobox_define'] ?>" value="<?= $config['val'] ?>"
                                   <?= $config['val'] ? ' checked' : '' ?>>
                            <label for="<?= $key . $v['infobox_define'] ?>"></label>
                        <?php } else { ?>
                            <input class="form-control" type="text" value="<?php echo $config['val']; ?>">
                        <?php } ?>
                    </td>
                </tr>
            <?php }
        } ?>
        </tbody>
    </table>
</div>
<?php if ($login_id == "1") { ?>
    <div style="width: calc(100% + 40px);" class="collapse changeable_admin" id="<?php echo $v['infobox_define'] ?>_admin">
        <table class="table" style="margin-bottom: 0;">
            <tbody>
            <textarea name="<?php echo $v['infobox_define'] ?>_admintext" id="" rows="10"
                      style="white-space: nowrap;display: block;margin: 10px 0;width: 100%;"><?php var_export($configs) ?></textarea>
            <button name="save_admin_block" type="button" class="btn btn-default save_admin_block">OK</button>
            </tbody>
        </table>
    </div>
<?php } ?>
