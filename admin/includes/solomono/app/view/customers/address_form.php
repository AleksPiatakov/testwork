<?php if (empty($data['address_book'])) {
    $data['address_book'][] = $data['allowed_fields']['address_book'];
}
$defaultAddressId = $defaultAddressId && is_array($data['address_book']) && in_array($defaultAddressId, array_keys($data['address_book'])) ? $defaultAddressId : array_key_last($data['address_book']);
foreach ($data['address_book'] as $id_add_book => $arr) { ?>
    <div data-address_id="<?= $id_add_book ?: ''; ?>" class="fadeIn animated"
         style="display:<?= $id_add_book == $defaultAddressId ? 'block' : 'none'; ?> ">
        <h4><?= AD_BOOK ?></h4>
        <?php if ($action_form != "insert_$action") { ?>
            <div class="form-group">
                <label class="col-sm-3 customer-label"><?= addDoubleDot(AD_CHOOSE_ADDRESS) ?></label>
                <div class="col-sm-9">
                    <div class="address_form_control">
                        <select class="form-control select_address_book">
                            <?php foreach ($data['address_book'] as $k => $v) { ?>
                                <option value="<?= $k; ?>"
                                        <?= $k == $defaultAddressId ? 'selected' : ''; ?>><?= $v['entry_street_address']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 customer-label"></label>
                <div class="col-sm-9">
                    <div class="address_form_control">
                        <div class="active_buttons">
                            <?php if ($id_add_book != $data['customers_default_address_id']) { ?>
                                <div class="customer-label customers_default_address">
                                    <input class="cmn-toggle cmn-toggle-round" type="checkbox"
                                           name="customers_default_address_id"
                                           id="customers_default_address_id[<?= $id_add_book ?>]">
                                    <label class="customer-label customer-checkbox-label"
                                           for="customers_default_address_id[<?= $id_add_book ?>]"><?= AD_BY_DEFAULT; ?></label>
                                </div>
                                <button class="btn btn-danger" type="button" data-toggle="collapse"
                                        data-target="#del_<?= $id_add_book ?>" aria-expanded="false"
                                        aria-controls="collapseExample"><?php echo IMAGE_DELETE ?> </button>
                            <?php } ?>
                            <button class="btn btn-primary add_customer_address" type="button"
                                    onclick="addAddress.call(this)"><?php echo IMAGE_INSERT ?> </button>
                        </div>
                    </div>
                    <span class="sure_block collapse" id="del_<?= $id_add_book ?>"> <?= AD_SURE; ?>
                    <button class="btn btn-danger" type="button" data-toggle="collapse"
                            data-target="#del_<?= $id_add_book ?>" aria-expanded="false"
                            aria-controls="collapseExample"><?= BUTTON_NO; ?></button>
                    <button class="btn btn-danger" type="button" data-id="<?= $id_add_book ?>"
                            onclick="deleteAddress.call(this)"><?= BUTTON_YES; ?></button>
                </span>
                </div>
            </div>
        <?php }
        foreach ($arr as $k => $v) {
            ?>
            <?php $allowed_fields = $data['allowed_fields']['address_book'][$k]; ?>
            <?php if (!$allowed_fields || $allowed_fields['hideInForm'] === true || $data['account_fields'][$k] == 'false') {
                continue;
            } ?>
            <?php $name = ($action_form != "insert_$action") ? $k . "[{$id_add_book}]" : $k; ?>
            <div class="form-group">
                <label for="<?= $name; ?>"
                       class="col-sm-3 customer-label"><?= addDoubleDot($allowed_fields['label']); ?></label>
                <div class="col-sm-9">
                    <?php if ($allowed_fields['type'] == 'select') { ?>
                        <select class="form-control" name="<?= $name; ?>" id="<?= $name; ?>">
                            <option value="0" data-country-id="0" <?= $v == 0 ? 'selected' : ''; ?>></option>
                            <?php foreach ($data['option'][$k] as $sk => $sv) { ?>
                                <?php if (is_array($sv)) { ?>
                                    <option value="<?= $sk; ?>" data-country-id="<?= $sv['zone_country_id'] ?>"
                                            <?= $sk == $v ? 'selected' : ''; ?>><?= $sv['zone_name']; ?></option>
                                <?php } else { ?>
                                    <option value="<?= $sk; ?>" <?= $sk == $v ? 'selected' : ''; ?>><?= $sv; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    <?php } else { ?>
                        <input type="<?= $allowed_fields['type'] ?>" value="<?= !is_array($v) ? $v : '' ?>"
                               name="<?= $name; ?>" placeholder="<?= $allowed_fields['label']; ?>" class="form-control"
                               id="<?= $name; ?>">
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>