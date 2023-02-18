<?php
//debug($data);
//debug($data['address_book']);
//debug($data['customers_default_address_id']);
//debug($action);

?>

<?php $action_form="insert_$action";?>

<form class="form-horizontal <?=$action?>"  id="test_form" action="<?=($_SERVER['SCRIPT_URL']?:$_SERVER['SCRIPT_NAME']) . '?action=' . $action_form;?>" method="post" enctype="multipart/form-data" novalidate="novalidate">
    <div class="row">
        
        <div class="col-md-6">
            <h2><?=SUBTITLE_PERSONAL?></h2>
            <div class="form-group">
                <label for="entry_firstname" class="col-sm-3 control-label"><?=addDoubleDot(TABLE_HEADING_FIRSTNAME)?></label>
                <div class="col-sm-9">
                    <input type="text" name="entry_firstname" placeholder="<?=TABLE_HEADING_FIRSTNAME?>" class="form-control" id="entry_firstname" required minlength="<?=ENTRY_FIRST_NAME_MIN_LENGTH?>" >
                    <!--data-msg="Please fill this field" data-rule-minlength="2" data-rule-maxlength="4" data-msg-minlength="At least two chars" data-msg-maxlength="At most fours chars"-->
                </div>
            </div>
            <div class="form-group">
                <label for="entry_lastname" class="col-sm-3 control-label"><?=addDoubleDot(TABLE_HEADING_LASTNAME)?></label>
                <div class="col-sm-9">
                    <input type="text" name="entry_lastname" placeholder="<?=TABLE_HEADING_LASTNAME?>" class="form-control" id="entry_lastname" required>
                </div>
            </div>
            <?php if (ACCOUNT_DOB == 'true') { ?>
            <div class="form-group">
                <label for="customers_dob" class="col-sm-3 control-label"><?=addDoubleDot(CUSTOMERS_BIRTHDAY)?></label>
                <div class="col-sm-9">
                    <input type="text" name="customers_dob" placeholder="<?=CUSTOMERS_BIRTHDAY?>" class="form-control" id="customers_dob" required>
                </div>
            </div>
            <?php } ?>
            <div class="form-group">
                <label for="entry_email" class="col-sm-3 control-label"><?=addDoubleDot(ENTRY_EMAIL_ADDRESS)?></label>
                <div class="col-sm-9">
                    <input type="text" name="entry_email" placeholder="<?=ENTRY_EMAIL_ADDRESS?>" class="form-control" id="entry_email" required minlength="<?=ENTRY_EMAIL_ADDRESS_MIN_LENGTH?>" data-rule-email="1" data-rule-validEmail="1">
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <h2><?=SUBTITLE_ADDRESS?></h2>
            <div class="form-group">
                <label for="entry_street_address" class="col-sm-3 control-label"><?=ENTRY_STREET_ADDRESS?></label>
                <div class="col-sm-9">
                    <input type="text" name="entry_street_address" placeholder="<?=ENTRY_STREET_ADDRESS?>" class="form-control" id="entry_street_address" required minlength="<?=ENTRY_STREET_ADDRESS_MIN_LENGTH?>">
                </div>
            </div>
            <?php  if (ACCOUNT_SUBURB == 'true') { ?>
            <div class="form-group">
                <label for="entry_suburb" class="col-sm-3 control-label"><?=ENTRY_SUBURB?></label>
                <div class="col-sm-9">
                    <input type="text" name="customers_email_address" placeholder="<?=ENTRY_SUBURB?>" class="form-control" id="entry_suburb">
                </div>
            </div>
            <?php } ?>
            <div class="form-group">
                <label for="entry_postcode" class="col-sm-3 control-label"><?=ENTRY_POST_CODE?></label>
                <div class="col-sm-9">
                    <input type="text" name="entry_postcode" placeholder="<?=ENTRY_POST_CODE?>" class="form-control" id="entry_postcode" required minlength="<?=ENTRY_POSTCODE_MIN_LENGTH?>">
                </div>
            </div>
            <div class="form-group">
                <label for="entry_city" class="col-sm-3 control-label"><?=ENTRY_CITY?></label>
                <div class="col-sm-9">
                    <input type="text" name="entry_city" placeholder="<?=ENTRY_CITY?>" class="form-control" id="entry_city" required minlength="<?=ENTRY_CITY_MIN_LENGTH?>">
                </div>
            </div>
            <?php if (ACCOUNT_STATE == 'true') { ?>
            <div class="form-group">
                <label for="entry_zone_id" class="col-sm-3 control-label"><?=ENTRY_STATE?></label>
                <div class="col-sm-9">
                    <select class="form-control" name="entry_zone_id" id="entry_zone_id" required disabled style="display: none;">
                        <?php foreach ($data['option']['entry_zone_id'] as $k=>$v): ?>
                            <option value="<?=$k;?>" data-country-id="<?=$v['zone_country_id']?>"><?=$v['zone_name'];?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="text" value="<?=$data['option']['entry_state']?>" class="form-control" name="entry_zone_id" data-select-id="entry_zone_id">

                </div>
            </div>
            <?php } ?>
            <div class="form-group">
                <label for="entry_country_id" class="col-sm-3 control-label"><?=ENTRY_COUNTRY?></label>
                <div class="col-sm-9">
                    <select class="form-control" name="entry_country_id" id="entry_country_id" required>
                        <?php foreach ($data['option']['entry_country_id'] as $k=>$v): ?>
                            <option value="<?=$k;?>" <?= $k == STORE_COUNTRY ? 'selected' : '' ?>><?=$v;?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>


    </div>
    <div class="row">
        
        <?php if (ACCOUNT_COMPANY == 'true') { ?>
            <div class="col-md-6">
                <h2><?=SUBTITLE_COMPANY?></h2>
                <div class="form-group">
                    <label for="entry_company" class="col-sm-3 control-label"><?=ENTRY_COMPANY?></label>
                    <div class="col-sm-9">
                        <input type="text" name="entry_company" placeholder="<?=ENTRY_COMPANY?>" class="form-control" id="entry_company">
                    </div>
                </div>
            </div>
        <?php } ?>
        
        <div class="col-md-6">
            <h2><?=SUBTITLE_FOR_CONTACT?></h2>
            <div class="form-group">
                <label for="entry_phone" class="col-sm-3 control-label"><?=addDoubleDot(ENTRY_TELEPHONE_NUMBER)?></label>
                <div class="col-sm-9">
                    <input type="text" name="entry_phone" placeholder="<?=ENTRY_TELEPHONE_NUMBER?>" class="form-control" id="entry_phone" required minlength="<?=ENTRY_TELEPHONE_MIN_LENGTH?>" data-rule-number="">
                </div>
            </div>
            <div class="form-group">
                <label for="entry_fax" class="col-sm-3 control-label"><?=addDoubleDot(ENTRY_FAX_NUMBER)?></label>
                <div class="col-sm-9">
                    <input type="text" name="entry_fax" placeholder="<?=ENTRY_FAX_NUMBER?>" class="form-control" id="entry_fax">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <h2><?=SUBTITLE_SUBSCRIBE;?></h2>
            <input class="cmn-toggle cmn-toggle-round" checked type="checkbox" name="customers_newsletter" id="cmn-toggle-<?='customers_newsletter'?>">
            <label style="display: inline" for="cmn-toggle-<?='customers_newsletter'?>"><?=ENTRY_NEWSLETTER?></label>
        </div>
        <div class="col-xs-12 text-right">
            <input type="submit" value="OK" class="btn">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?=TEXT_MODAL_CANCEL_ACTION?></button>
        </div>
        
    </div>
</form>
<script>
    $(document).ready(function(){
        $('select#entry_zone_id option').hide();
        $('select#entry_zone_id option[data-country-id='+$('select[id^=entry_country_id]').val()+']').show();
        $(document).on('change','select[id=entry_country_id]',function(){
            var country_id = $(this).val();
            var address_id = $(this).closest('#address_book').children().data('address_id');
            $('select[id="entry_zone_id"] option').hide();
            if ($('select[id="entry_zone_id"] option[data-country-id='+country_id+']').length) {
                $('select[id="entry_zone_id"]').prop('disabled',false).show();
                $('input[name="entry_zone_id"]').prop('disabled',true).hide().val('');
                $('select[id="entry_zone_id"] option[data-country-id=' + country_id + ']').show();
                $('select[id="entry_zone_id"] option').prop('selected', false);
                $('select[id="entry_zone_id"] option[data-country-id=' + country_id + ']:first').prop('selected', true);
            }else{
                $('select[id="entry_zone_id"]').prop('disabled',true).hide();
                $('input[name="entry_zone_id"]').prop('disabled',false).val('').show();

            }
        });
        $('select#entry_country_id').change();
    })
</script>