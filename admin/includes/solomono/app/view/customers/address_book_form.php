<?php
//debug($data);
//debug($data['address_book']);
//debug($data['customers_default_address_id']);
//debug($action);

?>

<?php

$defaultAddressId = $data['customers_default_address_id'];
$action_form = empty($defaultAddressId)?"insert_$action":"update_$action";?>
<form id="customer_modal_form" class="form-horizontal <?= $action ?>" action="<?= ($_SERVER['SCRIPT_URL'] ? : $_SERVER['SCRIPT_NAME']) . '?action=' . $action_form; ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $data['id']; ?>">
    <input type="hidden" name="address_book_id" value="<?= $defaultAddressId; ?>">
    <div class="row">
        <div class="col-md-6">
            <div class="col-md-12">
                <h4><?= AD_CUSTOMERS_MAIN_INFO ?></h4>
                <?php
                if(empty($data['customer_cabinet']))$data['customer_cabinet'] = $data['allowed_fields']['customer_cabinet'];
                foreach ($data['customer_cabinet'] as $k => $v): ?>
                    <?php $allowed_fields = $data['allowed_fields']['customer_cabinet'][$k] ?>
                    <?php if (!$allowed_fields || $allowed_fields['hideInForm']===true) continue; ?>
                    <div class="form-group">
                        <label for="<?= $k; ?>" class="col-sm-3 customer-label"><?= addDoubleDot($allowed_fields['label']); ?></label>
                        <div class="col-sm-9">
                            <input type="<?= $allowed_fields['type'] ?>" value="<?= !is_array($v)?$v:'' ?>" name="<?= $k; ?>" placeholder="<?= $allowed_fields['placeholder'] ? : $allowed_fields['label']; ?>" class="form-control" id="<?= $k; ?>">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="col-md-12">
                <h4><?= AD_CHANGE_PASSWORD; ?></h4>
                <div class="form-group">
                    <label for="password" class="col-sm-3 customer-label"><?= addDoubleDot(AD_NEW_PASSWORD); ?></label>
                    <div class="col-sm-9">
                        <input type="password" name="password" class="form-control" data-min-length="<?= ENTRY_PASSWORD_MIN_LENGTH ?>" title="<?= sprintf(ERROR_NEW_PASSWORD_MIN_LENGTH,ENTRY_PASSWORD_MIN_LENGTH)?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password_confirm" class="col-sm-3 customer-label"><?= addDoubleDot(AD_CONFIRM_PASSWORD); ?></label>
                    <div class="col-sm-9">
                        <input type="password" name="password_confirm" class="form-control" title="<?= ERROR_CONFIRM_PASSWORD_EQUAL ?>">
                    </div>
                </div>
                <div class="form-group">
                    <?php
                    if(empty($data['customer_subscribe']))$data['customer_subscribe'] = $data['allowed_fields']['customer_subscribe'];
                    foreach ($data['customer_subscribe'] as $k => $v): ?>
                        <?php $allowed_fields = $data['allowed_fields']['customer_subscribe'][$k]; ?>
                        <?php if (!$allowed_fields || $allowed_fields['hideInForm']===true) continue; ?>
                        <?php if ($allowed_fields['type'] == 'status'): ?>
                            <input class="cmn-toggle cmn-toggle-round" <?= (!is_array($v) && $v) ? 'checked' : ''; ?> type="checkbox" name="<?= $k ?>" id="cmn-toggle-<?= $k ?>">
                            <label class="customer-label customer-checkbox-label" for="cmn-toggle-<?= $k ?>"><?= $allowed_fields['label'] ?></label>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-xs-12" id="address_book">
                        <?php include 'address_form.php' ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="col-md-12">
                <h4><?= DISCOUNT_OPTIONS; ?></h4>
                <?php
                $allowed_fields = $data['allowed_fields']['customer_discount'];
                $cd_data = $data['customer_discount'];
                ?>
                <div class="form-group">
                    <label for="<?= $name; ?>" class="col-sm-3 customer-label"><?= addDoubleDot($allowed_fields['customers_discount']['label']); ?></label>
                    <div class="col-sm-9">
                        <input type="<?= $allowed_fields['customers_discount']['type'] ?>" value="<?= $cd_data['customers_discount'] ?>" name="customers_discount" placeholder="<?= $allowed_fields['customers_discount']['label']; ?>" class="form-control" id="customers_discount">
                    </div>
                </div>
                <div class="form-group">
                    <label for="customer_discount" class="col-sm-3 customer-label"><?= addDoubleDot($allowed_fields['customers_groups_id']['label']); ?></label>
                    <div class="col-sm-9">
                        <select class="form-control" name="customers_groups_id" id="customers_groups_id">
                            <?php foreach ($data['option']['customers_groups_id'] as $sk => $sv): ?>
                                <option value="<?= $sk; ?>" <?= $sk == $cd_data['customers_groups_id'] ? 'selected' : ''; ?>><?= $sv; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <input class="cmn-toggle cmn-toggle-round" type="checkbox" id="customer_discount_notify" name="customer_discount_notify">
                    <label class="customer-label customer-checkbox-label" for="customer_discount_notify"><?= CHECK_NOTIFY_CUSTOMER ?></label>
                </div>
            </div>
        </div>
        <div class="col-xs-12 text-right">
            <?php if($action_form != "insert_$action"){ ?>
                <a class="btn btn-info" href="orders.php?cID=<?php echo $data['id']; ?>"><?= TEXT_SUMMARY_ORDERS ?></a>
            <?php } ?>
            <button type="button" class="btn btn-default" data-dismiss="modal"><?= TEXT_MODAL_CANCEL_ACTION ?></button>
            <input type="submit" value="<?= IMAGE_SAVE ?>" class="btn btn-success">
        </div>
    </div>
</form>
<script>
    $(document).ready(function () {
        <?php
        $newTitle = getConstantValue('HEADING_FORM_TITLE', false);
        if($newTitle !== false && $action_form != "insert_$action"){
        $newTitle .= ' ' . $data['customer_cabinet']['customers_firstname'] . ' ' . $data['customer_cabinet']['customers_lastname'];
        $newTitle = str_replace(["'"], "&#39;", $newTitle);?>
        $('#modal_form_label').html('<?php echo $newTitle; ?>');
        <?php } ?>
        $('select[id^=entry_zone_id] option').hide();
        $('select[id^=entry_zone_id] option[data-country-id=0]').show();
        $('select[id^=entry_zone_id] option[data-country-id=' + $('select[id^=entry_country_id]').val() + ']').show();
        $(document).on('change', 'select[id^=entry_country_id]', function () {
            var country_id = $(this).val();
            var address_id = $(this).closest('#address_book').children().data('address_id');
            var address = address_id?'['+address_id+']':'';
            $('select[id="entry_zone_id' + address + '"] option').hide();
            if($('select[id="entry_zone_id' + address + '"] option[data-country-id=' + country_id + ']').length) {
                $('select[id="entry_zone_id' + address + '"]').prop('disabled', false).show();
                $('input[name="entry_zone_id' + address + '"]').prop('disabled', true).hide().val('');
                $('select[id="entry_zone_id' + address + '"] option[data-country-id=0]').show();
                $('select[id="entry_zone_id' + address + '"] option[data-country-id=' + country_id + ']').show();
                $('select[id="entry_zone_id' + address + '"] option').prop('selected', false);
                // $('select[id="entry_zone_id['+address_id+']"] option[data-country-id=' + country_id + ']:first').prop('selected', true);
                $('select[id="entry_zone_id' + address + '"] option[data-country-id=0]:first').prop('selected', true);
            }else {
                $('select[id="entry_zone_id' + address + '"]').prop('disabled', true).hide();
                $('input[name="entry_zone_id' + address + '"]').prop('disabled', false).val('').show();

            }
        })
    });

    $(document).on('blur','[name="password"][type="password"]',function () {
        var $this = $(this),
            minAllowedPassLength = $this.data("min-length"),
        thisPassLength = $this.val().length;
        if(thisPassLength < minAllowedPassLength && thisPassLength != 0){
            $this.css('border-color','red');
        }else{
            $this.css('border-color','');
            $('[name="password_confirm"][type="password"]').blur();
        }
    });

    $(document).on('blur','[name="password_confirm"][type="password"]',function () {
        var $this = $(this),
            thisPass = $this.val(),
            originalPass = $('[name="password"][type="password"]').val();
        if(thisPass != originalPass){
            $this.css('border-color','red');
        }else{
            $this.css('border-color','');
        }
    });

    function addAddress() {
        $.getJSON(window.location.pathname,
            {action: 'add_address', customer_id: '<?=$data['id'];?>'},
            function (response) {
                $('#address_book').html(response.html);
                $('input[name="address_book_id"]').attr('value', $('.select_address_book').val());
            });
    };

    function deleteAddress() {
        $.getJSON(window.location.pathname,
            {action: 'delete_address', address_id: $(this).data('id'), customer_id: '<?=$data['id'];?>'},
            function (response) {
                $('#address_book').html(response.html);
            });
    }
</script>