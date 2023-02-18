<?php

require_once(DIR_WS_LANGUAGES . $language . '/modules/novaposhta/novaposhta.php');

?>
<link rel="stylesheet" type="text/css" href="<?php echo 'includes/modules/novaposhta/novaposhta.css';?>">
<script src="<?= DIR_WS_INCLUDES ?>javascript/datepicker/moment.min.js"></script>
<!--<script src="--><?//= DIR_WS_INCLUDES ?><!--javascript/datepicker/daterangepicker.js"></script>-->
<!--<link rel="stylesheet" type="text/css" href="--><?//= DIR_WS_INCLUDES ?><!--javascript/datepicker/daterangepicker.css"/>-->
<script src="<?= DIR_WS_INCLUDES ?>javascript/datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script src="<?= DIR_WS_INCLUDES ?>modules/novaposhta/js/autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="<?= DIR_WS_INCLUDES ?>javascript/datetimepicker/bootstrap-datetimepicker.min.css"/>

<div class="container-fluid">
    <div class="wrapper-title">
        <div class="bg-light lter ng-scope">
            <h3><i class="fa fa-truck font-thin m-n"></i> <?php echo HEADING_TITLE; ?></h3>
            <div class="bg-light lter ng-scope">
                <a id="button-save" class="btn btn-primary" role="button"><?php echo BUTTON_SAVE_CN; ?></a>
                <a id="button-getcnlist2" data-toggle="tooltip" title="<?php echo BUTTON_CN_LIST; ?>" class="btn btn-default" role="button"><i class="fa fa-list-ul"></i></a>
                <a href="<?php echo $data['cancel']; ?>" data-toggle="tooltip" title="<?php echo BUTTON_CANCEL; ?>" class="btn btn-danger" role="button"><i class="fa fa-reply"></i></a>
            </div>
        </div>
    </div>

    <?php if (!empty($error_warning)) { ?>
        <?php foreach ($error_warning as $error) { ?>
            <div class="alert alert-danger">
                <i class="fa fa-exclamation-circle"></i> <?php echo $error; ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php } ?>
    <?php } ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-file-text-o" aria-hidden="true"></i> <?php echo $data["text_form"]; ?></h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo TEXT_SENDER; ?></h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="input-sender"><?php echo ENTRY_SENDER; ?></label>
                                    <div class="col-sm-9">
                                        <select name="sender" id="input-sender" class="form-control">
                                            <option value=""><?php echo TEXT_SELECT; ?></option>
                                                    <?php foreach ($data['senders'] as $v) { ?>
                                                        <?php if ($v['Ref'] == $data['sender']) { ?>
                                                            <option value="<?php echo $v['Ref']; ?>" selected="selected"><?php echo $v['Description']; ?><?php echo ($v['CityDescription']) ? ', ' . $v['CityDescription'] : ''; ?><?php echo ($v['EDRPOU']) ? ', ' . $v['EDRPOU'] : ''; ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $v['Ref']; ?>"><?php echo $v['Description']; ?><?php echo ($v['CityDescription']) ? ', ' . $v['CityDescription'] : ''; ?><?php echo ($v['EDRPOU']) ? ', ' . $v['EDRPOU'] : ''; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="input-sender_edrpou">ЄДРПОУ</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="EDRPOU" value="" placeholder="ЄДРПОУ" id="input-sender_edrpou" class="form-control" readonly />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="input-sender_contact_person"><?php echo ENTRY_CONTACT_PERSON; ?></label>
                                    <div class="col-sm-9">
                                        <select name="sender_contact_person" id="input-sender_contact_person" class="form-control">
                                            <option value=""><?php echo TEXT_SELECT; ?></option>
                                                    <?php foreach ($data['sender_contact_persons'] as $v) { ?>
                                                        <?php if ($v['Ref'] == $data['sender_contact_person']) { ?>
                                                            <option value="<?php echo $v['Ref']; ?>" selected="selected"><?php echo $v['Description'] . ', ' . $v['Phones']; ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $v['Ref']; ?>"><?php echo $v['Description'] . ', ' . $v['Phones']; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="input-sender_contact_person_phone"><?php echo ENTRY_PHONE; ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="sender_contact_person_phone" value="" placeholder="<?php echo ENTRY_PHONE; ?>" id="input-sender_contact_person_phone" class="form-control" readonly />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="input-sender_region"><?php echo ENTRY_REGION; ?></label>
                                    <div class="col-sm-9">
                                        <select name="sender_region" id="input-sender_region" class="form-control">
                                            <option value=""><?php echo TEXT_SELECT; ?></option>
                                                    <?php foreach ($data['zones'] as $v) { ?>
                                                        <?php if ($v['zone_id'] == $data['sender_region']) { ?>
                                                            <option value="<?php echo $v['zone_id']; ?>" selected="selected"><?php echo $v['zone_name']; ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $v['zone_id']; ?>"><?php echo $v['zone_name']; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="input-sender_city_name"><?php echo ENTRY_CITY; ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="sender_city_name" value="<?php echo $data['sender_city_name']; ?>" placeholder="<?php echo TEXT_SELECT; ?>" id="input-sender_city_name" class="form-control" />
                                        <input type="hidden" name="sender_city" value="<?php echo $data['sender_city']; ?>" id="input-sender_city" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="input-sender_address_name"><?php echo ENTRY_ADDRESS; ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="sender_address_name" value="<?php echo $data['sender_address_name']; ?>" placeholder="<?php echo TEXT_SELECT; ?>" id="input-sender_address_name" class="form-control" />
                                        <input type="hidden" name="sender_address" value="<?php echo $data['sender_address']; ?>" id="input-sender_address" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading clearfix" style="padding-top: 5px; padding-bottom: 5px;">
                                <h3 class="panel-title" style="padding-top: 5px;"><?php echo TEXT_RECIPIENT; ?></h3>
                                <div class="btn-group pull-right" data-toggle="buttons">
                                    <?php if ($data['recipient_address_type'] == 'warehouse') { ?>
                                        <label class="btn btn-default btn-sm active" data-toggle="tooltip" title="<?php echo BUTTON_WAREHOUSE_DELIVERY; ?>"><input type="radio" name="recipient_address_type" value="warehouse" id="input-recipient_address_type" checked><i class="fa fa-map-marker" aria-hidden="true"></i></label>
                                        <label class="btn btn-default btn-sm" data-toggle="tooltip" title="<?php echo BUTTON_DOORS_DELIVERY; ?>"><input type="radio" name="recipient_address_type" value="doors" id="input-recipient_address_type"><i class="fa fa-home" aria-hidden="true"></i></label>
                                        <label class="btn btn-default btn-sm" data-toggle="tooltip" title="<?php echo BUTTON_POSHTOMAT_DELIVERY; ?>"><input type="radio" name="recipient_address_type" value="poshtomat" id="input-recipient_address_type"><i class="fa fa-building" aria-hidden="true"></i></label>
                                    <?php } elseif ($data['recipient_address_type'] == 'poshtomat') { ?>
                                        <label class="btn btn-default btn-sm" data-toggle="tooltip" title="<?php echo BUTTON_WAREHOUSE_DELIVERY; ?>"><input type="radio" name="recipient_address_type" value="warehouse" id="input-recipient_address_type"><i class="fa fa-map-marker" aria-hidden="true"></i></label>
                                        <label class="btn btn-default btn-sm" data-toggle="tooltip" title="<?php echo BUTTON_DOORS_DELIVERY; ?>"><input type="radio" name="recipient_address_type" value="doors" id="input-recipient_address_type"><i class="fa fa-home" aria-hidden="true"></i></label>
                                        <label class="btn btn-default btn-sm active" data-toggle="tooltip" title="<?php echo BUTTON_POSHTOMAT_DELIVERY; ?>"><input type="radio" name="recipient_address_type" value="poshtomat" id="input-recipient_address_type" checked><i class="fa fa-building" aria-hidden="true"></i></label>
                                    <?php } else { ?>
                                        <label class="btn btn-default btn-sm" data-toggle="tooltip" title="<?php echo BUTTON_WAREHOUSE_DELIVERY; ?>"><input type="radio" name="recipient_address_type" value="warehouse" id="input-recipient_address_type"><i class="fa fa-map-marker" aria-hidden="true"></i></label>
                                        <label class="btn btn-default btn-sm active" data-toggle="tooltip" title="<?php echo BUTTON_DOORS_DELIVERY; ?>"><input type="radio" name="recipient_address_type" value="doors" id="input-recipient_address_type" checked><i class="fa fa-home" aria-hidden="true"></i></label>
                                        <label class="btn btn-default btn-sm" data-toggle="tooltip" title="<?php echo BUTTON_POSHTOMAT_DELIVERY; ?>"><input type="radio" name="recipient_address_type" value="poshtomat" id="input-recipient_address_type"><i class="fa fa-building" aria-hidden="true"></i></label>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="input-recipient_name"><?php echo ENTRY_RECIPIENT; ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="recipient_name" value="<?php echo $data['recipient_name']; ?>" placeholder="<?php echo TEXT_SELECT; ?>" id="input-recipient_name" class="form-control" />
                                        <input type="hidden" name="recipient" value="<?php echo $data['recipient']; ?>" id="input-recipient" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="input-recipient_contact_person"><?php echo ENTRY_CONTACT_PERSON; ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="recipient_contact_person" value="<?php echo $data['recipient_contact_person']; ?>" placeholder="<?php echo ENTRY_CONTACT_PERSON; ?>" id="input-recipient_contact_person" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="input-recipient_contact_person_phone"><?php echo ENTRY_PHONE; ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="recipient_contact_person_phone" value="<?php echo $data['recipient_contact_person_phone']; ?>" placeholder="<?php echo ENTRY_PHONE; ?>" id="input-recipient_contact_person_phone" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="input-recipient_region"><?php echo ENTRY_REGION; ?></label>
                                    <div class="col-sm-9">
                                        <select name="recipient_region" id="input-recipient_region" class="form-control">
                                            <option value=""><?php echo TEXT_SELECT; ?></option>
                                                    <?php foreach ($data['zones'] as $v) { ?>
                                                        <?php if ($v['zone_id'] == $data['recipient_region']) { ?>
                                                            <option value="<?php echo $v['zone_id']; ?>" selected="selected"><?php echo $v['zone_name']; ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $v['zone_id']; ?>"><?php echo $v['zone_name']; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                        </select>
                                        <input type="hidden" name="recipient_region_name" value="<?php echo $data['recipient_region_name']; ?>" id="input-recipient_region_name" />
                                        <input type="hidden" name="recipient_district_name" value="<?php echo $data['recipient_district_name']; ?>" id="input-recipient_district_name" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="input-recipient_city_name"><?php echo ENTRY_CITY; ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="recipient_city_name" value="<?php echo $data['recipient_city_name']; ?>" placeholder="<?php echo ENTRY_CITY; ?>" id="input-recipient_city_name" class="form-control" />
                                        <input type="hidden" name="recipient_city" value="<?php echo $data['recipient_city']; ?>" id="input-recipient_city" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="input-recipient_warehouse_name"><?php echo ENTRY_WAREHOUSE; ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="recipient_warehouse_name" value="<?php echo str_replace('\" ', "&#187; ", str_replace(' \"', " &#171;", $data['recipient_warehouse_name'])); ?>" placeholder="<?php echo ENTRY_WAREHOUSE; ?>" id="input-recipient_warehouse_name" class="form-control" />
                                        <input type="hidden" name="recipient_warehouse" value="<?php echo $data['recipient_warehouse']; ?>" id="input-recipient_warehouse" />
                                    </div>
                                </div>
                                <div class="form-group" style="display: none">
                                    <label class="col-sm-3 control-label" for="input-recipient_street_name"><?php echo ENTRY_STREET; ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="recipient_street_name" value="<?php echo $data['recipient_street_name']; ?>" placeholder="<?php echo ENTRY_STREET; ?>" id="input-recipient_street_name" class="form-control" />
                                        <input type="hidden" name="recipient_street" value="<?php echo $data['recipient_street']; ?>" id="input-recipient_street" />
                                    </div>
                                </div>
                                <div class="form-group" style="display: none">
                                    <label class="col-sm-3 control-label" for="input-recipient_house"><?php echo ENTRY_HOUSE; ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="recipient_house" value="<?php echo $data['recipient_house']; ?>" placeholder="<?php echo ENTRY_HOUSE; ?>" id="input-recipient_house" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group" style="display: none">
                                    <label class="col-sm-3 control-label" for="input-recipient_flat"><?php echo ENTRY_FLAT; ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="recipient_flat" value="<?php echo $data['recipient_flat']; ?>" placeholder="<?php echo ENTRY_FLAT; ?>" id="input-recipient_flat" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo TEXT_DEPARTURE_OPTIONS; ?></h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="input-departure_type"><?php echo ENTRY_DEPARTURE_TYPE; ?></label>
                                    <div class="col-sm-9">
                                        <select name="departure_type" id="input-departure_type" class="form-control">
                                                    <?php foreach ($data['references']['cargo_types'] as $cargo_type) { ?>
                                                        <?php if ($cargo_type['Ref'] == $data['departure']) { ?>
                                                            <option value="<?php echo $cargo_type['Ref']; ?>" selected="selected"><?php echo $cargo_type['Description']; ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $cargo_type['Ref']; ?>"><?php echo $cargo_type['Description']; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                        </select>
                                    </div>
                                </div>
<!--                                <div class="form-group">-->
<!--                                    <label class="col-sm-3 control-label" for="input-redbox_barcode">--><?php //echo ENTRY_REDBOX_BARCODE; ?><!--</label>-->
<!--                                    <div class="col-sm-9">-->
<!--                                        <input type="text" name="redbox_barcode" value="--><?php //echo $data['redbox_barcode']; ?><!--" placeholder="--><?php //echo ENTRY_REDBOX_BARCODE; ?><!--" id="input-redbox_barcode" class="form-control" />-->
<!--                                    </div>-->
<!--                                </div>-->
                                        <?php foreach ($data['references']['tires_and_wheels'] as $t_and_w) { ?>
                                            <div class="form-group" style="display: none;">
                                                <label class="col-sm-3 control-label" for="input-tires_and_wheels_<?php echo $t_and_w['Ref']; ?>"><?php echo $t_and_w['Description']; ?></label>
                                                <div class="col-sm-9">
                                                    <div class="input-group">
                                                        <input type="text" name="tires_and_wheels[<?php echo $t_and_w['Ref']; ?>]" value="<?php echo isset($data['references']['tires_and_wheels'][$t_and_w['Ref']]) ? $data['references']['tires_and_wheels'][$t_and_w['Ref']] : ''?>" placeholder="<?php echo $t_and_w['Description']; ?>" id="input-tires_and_wheels_<?php echo $t_and_w['Ref']; ?>" class="form-control" />
                                                        <span class="input-group-addon"><?php echo TEXT_PC; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                <div class="form-group" style="display: none;">
                                    <label class="col-sm-3 control-label" for="input-width"><?php echo ENTRY_WIDTH; ?></label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" name="width" value="<?php echo $data['width']; ?>" placeholder="<?php echo ENTRY_WIDTH; ?>" id="input-width" class="form-control" />
                                            <span class="input-group-addon"><?php echo TEXT_CM; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none;">
                                    <label class="col-sm-3 control-label" for="input-length"><?php echo ENTRY_LENGTH; ?></label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" name="length" value="<?php echo $data['length']; ?>" placeholder="<?php echo ENTRY_LENGTH; ?>" id="input-length" class="form-control" />
                                            <span class="input-group-addon"><?php echo TEXT_CM; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none;">
                                    <label class="col-sm-3 control-label" for="input-height"><?php echo ENTRY_HEIGHT; ?></label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" name="height" value="<?php echo $data['height']; ?>" placeholder="<?php echo ENTRY_HEIGHT; ?>" id="input-height" class="form-control" />
                                            <span class="input-group-addon"><?php echo TEXT_CM; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="input-weight"><?php echo ENTRY_WEIGHT; ?></label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" name="weight" value="<?php echo $data['weight']; ?>" placeholder="<?php echo ENTRY_WEIGHT; ?>" id="input-weight" class="form-control" />
                                            <span class="input-group-addon"><?php echo TEXT_KG; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="input-volume_general"><?php echo ENTRY_VOLUME_GENERAL; ?></label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" name="volume_general" value="<?php echo $data['volume_general']; ?>" placeholder="<?php echo ENTRY_VOLUME_GENERAL; ?>" id="input-volume_general" class="form-control" />
                                            <span class="input-group-addon"><?php echo TEXT_CUBIC_METER; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="input-volume_weight"><?php echo ENTRY_VOLUME_WEIGHT; ?></label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" name="volume_weight" value="<?php echo $data['volume_weight']; ?>" placeholder="<?php echo ENTRY_VOLUME_WEIGHT; ?>" id="input-volume_weight" class="form-control" readonly/>
                                            <span class="input-group-addon"><?php echo TEXT_KG; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="input-seats_amount"><?php echo ENTRY_SEATS_AMOUNT; ?></label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="button" id="button-options_seat" data-toggle="modal" data-target="#modal-options-seat" data-tooltip="true" title="<?php echo BUTTON_OPTIONS_SEAT; ?>" class="btn btn-default"><i class="fa fa-cubes"></i></button>
                                        </span>
                                            <input type="text" name="seats_amount" value="<?php echo $data['seats_amount']; ?>" placeholder="<?php echo ENTRY_SEATS_AMOUNT; ?>" id="input-seats_amount" class="form-control" />
                                            <span class="input-group-addon"><?php echo TEXT_PC; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="input-declared_cost"><?php echo ENTRY_DECLARED_COST; ?></label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="button" id="button-components_list" data-toggle="modal" data-target="#modal-totals-list" data-tooltip="true" title="<?php echo BUTTON_COMPONENTS_LIST; ?>" class="btn btn-default"><i class="fa fa-list" aria-hidden="true"></i></button>
                                        </span>
                                            <input type="text" name="declared_cost" value="<?php echo $data['declared_cost']; ?>" placeholder="<?php echo ENTRY_DECLARED_COST; ?>" id="input-declared_cost" class="form-control" />
                                            <span class="input-group-addon"><?php echo TEXT_GRN; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="input-departure_description"><?php echo ENTRY_DEPARTURE_DESCRIPTION; ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="departure_description" value="<?php echo $data['departure_description']; ?>" placeholder="<?php echo ENTRY_DEPARTURE_DESCRIPTION; ?>" id="input-departure_description" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo TEXT_PAYMENT; ?></h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="input-delivery_payer"><?php echo ENTRY_DELIVERY_PAYER; ?></label>
                                    <div class="col-sm-9">
                                        <select name="delivery_payer" id="input-delivery_payer" class="form-control">
                                            <option value="0"><?php echo TEXT_SELECT; ?></option>
                                                    <?php foreach ($data['references']['payer_types'] as $payer_type) { ?>
                                                        <?php if ($payer_type['Ref'] == 'ThirdPerson' && empty($data['sender_options']['CanPayTheThirdPerson'])) { ?>
                                                            <option value="<?php echo $payer_type['Ref']; ?>" disabled><?php echo $payer_type['Description']; ?></option>
                                                        <?php } elseif ($payer_type['Ref'] == $data['delivery_payer']) { ?>
                                                            <option value="<?php echo $payer_type['Ref']; ?>" selected="selected"><?php echo $payer_type['Description']; ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $payer_type['Ref']; ?>"><?php echo $payer_type['Description']; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none">
                                    <label class="col-sm-3 control-label" for="input-third_person"><?php echo ENTRY_THIRD_PERSON; ?></label>
                                    <div class="col-sm-9">
                                        <select name="third_person" id="input-third_person" class="form-control">
                                            <option value=""><?php echo TEXT_SELECT; ?></option>
                                                    <?php foreach ($data['references']['third_persons'] as $v) { ?>
                                                        <?php if ($v['Ref'] == $data['third_person']) { ?>
                                                            <option value="<?php echo $v['Ref']; ?>" selected="selected"><?php echo $v['Description']; ?>, <?php echo $v['CityDescription']; ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $v['Ref']; ?>"><?php echo $v['Description']; ?>, <?php echo $v['CityDescription']; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="input-payment_type"><?php echo ENTRY_PAYMENT_TYPE; ?></label>
                                    <div class="col-sm-9">
                                        <select name="payment_type" id="input-payment_type" class="form-control">
                                            <option value="0"><?php echo TEXT_SELECT; ?></option>
                                                    <?php foreach ($data['references']['payment_types'] as $v) { ?>
                                                        <?php if ($v['Ref'] == $data['payment_type']) { ?>
                                                            <option value="<?php echo $v['Ref']; ?>" selected="selected"><?php echo $v['Description']; ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $v['Ref']; ?>"><?php echo $v['Description']; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="input-backward_delivery"><?php echo ENTRY_BACKWARD_DELIVERY; ?></label>
                                    <div class="col-sm-9">
                                        <select name="backward_delivery" id="input-backward_delivery" class="form-control">
                                            <option value="0"><?php echo TEXT_SELECT; ?></option>
                                            <option value="N"<?php echo ($data['backward_delivery'] == 'N') ? ' selected="selected"' : ''; ?>><?php echo TEXT_NO_BACKWARD_DELIVERY; ?></option>
                                                    <?php foreach ($data['references']['backward_delivery_types'] as $backward_delivery_type) { ?>
                                                        <?php if ($backward_delivery_type['Ref'] == $data['backward_delivery']) { ?>
                                                            <option value="<?php echo $backward_delivery_type['Ref']; ?>" selected="selected"><?php echo $backward_delivery_type['Description']; ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $backward_delivery_type['Ref']; ?>"><?php echo $backward_delivery_type['Description']; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none">
                                    <label class="col-sm-3 control-label" for="input-backward_delivery_total"><?php echo ENTRY_BACKWARD_DELIVERY_TOTAL; ?></label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" name="backward_delivery_total" value="<?php echo $data['backward_delivery_total']; ?>" placeholder="<?php echo ENTRY_BACKWARD_DELIVERY_TOTAL; ?>" id="input-backward_delivery_total" class="form-control" />
                                            <span class="input-group-addon"><?php echo TEXT_GRN; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none">
                                    <label class="col-sm-3 control-label" for="input-backward_delivery_payer"><?php echo ENTRY_BACKWARD_DELIVERY_PAYER; ?></label>
                                    <div class="col-sm-9">
                                        <select name="backward_delivery_payer" id="input-backward_delivery_payer" class="form-control">
                                            <option value="0"><?php echo TEXT_SELECT; ?></option>
                                                    <?php foreach ($data['references']['backward_delivery_payers'] as $v) { ?>
                                                        <?php if ($v['Ref'] == $data['backward_delivery_payer']) { ?>
                                                            <option value="<?php echo $v['Ref']; ?>" selected="selected"><?php echo $v['Description']; ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $v['Ref']; ?>"><?php echo $v['Description']; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none">
                                    <label class="col-sm-3 control-label" for="input-money_transfer_method"><?php echo ENTRY_MONEY_TRANSFER_METHOD; ?></label>
                                    <div class="col-sm-9">
                                        <select name="money_transfer_method" id="input-money_transfer_method" class="form-control">
                                            <option value="0"><?php echo TEXT_SELECT; ?></option>
                                                    <?php foreach ($data['money_transfer_methods'] as $k => $v) { ?>
                                                        <?php if ($k == $data['money_transfer_method']) { ?>
                                                            <option value="<?php echo $k; ?>" selected="selected"><?php echo $v; ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none">
                                    <label class="col-sm-3 control-label" for="input-payment_card"><?php echo ENTRY_PAYMENT_CARD; ?></label>
                                    <div class="col-sm-9">
                                        <select name="payment_card" id="input-payment_card" class="form-control">
                                            <option value=""><?php echo TEXT_SELECT; ?></option>
                                            <?php if (isset($data['references']['payment_cards']) && $data['references']['payment_cards']) { ?>
                                                    <?php foreach ($data['references']['payment_cards'] as $v) { ?>
                                                        <?php if ($v['Ref'] == $data['payment_card']) { ?>
                                                            <option value="<?php echo $v['Ref']; ?>" selected="selected"><?php echo $v['Description']; ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $v['Ref']; ?>"><?php echo $v['Description']; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="input-payment_control"><?php echo ENTRY_PAYMENT_CONTROL; ?></label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" name="payment_control" value="<?php echo $data['payment_control']; ?>" placeholder="<?php echo ENTRY_PAYMENT_CONTROL; ?>" id="input-payment_control" class="form-control" />
                                            <span class="input-group-addon"><?php echo TEXT_GRN; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo TEXT_ADDITIONALLY; ?></h3>
                            </div>
                            <div class="panel-body">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="input-departure_date"><?php echo ENTRY_DEPARTURE_DATE; ?></label>
                                        <div class="col-sm-9">
                                            <div class="input-group date">
                                                <input type="text" name="departure_date" value="<?php echo $data['departure_date']; ?>" placeholder="<?php echo ENTRY_DEPARTURE_DATE; ?>" data-date-format="DD.MM.YYYY" id="input-departure_date" class="form-control">
                                                <span class="input-group-btn">
                                                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="input-preferred_delivery_date"><?php echo ENTRY_PREFERRED_DELIVERY_DATE; ?></label>
                                        <div class="col-sm-9">
                                            <div class="input-group date">
                                                <input type="text" name="preferred_delivery_date" value="<?php echo $data['preferred_delivery_date']; ?>" placeholder="<?php echo ENTRY_PREFERRED_DELIVERY_DATE; ?>" data-date-format="DD.MM.YYYY" id="input-preferred_delivery_date" class="form-control">
                                                <span class="input-group-btn">
                                                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" style="display: none">
                                        <label class="col-sm-3 control-label" for="input-time_interval"><?php echo ENTRY_PREFERRED_DELIVERY_TIME; ?></label>
                                        <div class="col-sm-9">
                                            <select name="time_interval" id="input-time_interval" class="form-control">
                                                <option value=""><?php echo TEXT_DURING_DAY; ?></option>
                                                        <?php if (isset($data['time_intervals']) && $data['time_intervals']) { ?>
                                                            <?php foreach ($data['time_intervals'] as $interval) { ?>
                                                                <?php if ($interval['Number'] == $data['time_interval']) { ?>
                                                                    <option value="<?php echo $interval['Number']; ?>" selected="selected"><?php echo $interval['Start'] . ' - ' . $interval['End']; ?></option>
                                                                <?php } else { ?>
                                                                    <option value="<?php echo $interval['Number']; ?>"><?php echo $interval['Start'] . ' - ' . $interval['End']; ?></option>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="input-sales_order_number"><?php echo ENTRY_SALES_ORDER_NUMBER; ?></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="sales_order_number" value="<?php echo $data['sales_order_number']; ?>" placeholder="<?php echo ENTRY_SALES_ORDER_NUMBER; ?>" id="input-sales_order_number" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="input-packing_number"><?php echo ENTRY_PACKING_NUMBER; ?></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="packing_number" value="<?php echo $data['packing_number']; ?>" placeholder="<?php echo ENTRY_PACKING_NUMBER; ?>" id="input-packing_number" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="input-additional_information"><?php echo ENTRY_DEPARTURE_ADDITIONAL_INFORMATION; ?></label>
                                        <div class="col-sm-9">
                                            <textarea name="additional_information" rows="3" id="input-additional_information" maxlength="100" class="form-control"><?php echo $data['additional_information']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="input-rise_on_floor"><?php echo ENTRY_RISE_ON_FLOOR; ?></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="rise_on_floor" value="<?php echo $data['rise_on_floor']; ?>" placeholder="<?php echo ENTRY_RISE_ON_FLOOR; ?>" id="input-rise_on_floor" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="input-elevator"><?php echo ENTRY_ELEVATOR; ?></label>
                                        <div class="col-sm-9">
                                            <label class="radio-inline">
                                                <?php if ($data['elevator']) { ?>
                                                    <input type="checkbox" name="elevator" id="input-elevator" class="form-control" checked>
                                                <?php } else { ?>
                                                    <input type="checkbox" name="elevator" id="input-elevator" class="form-control">
                                                <?php } ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal seats START -->
                <div class="modal fade" id="modal-options-seat" tabindex="-1" role="dialog" aria-labelledby="option-seat-label">
                    <div class="modal-dialog modal-lg" role="document" style="width: 85%;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="options-seat-label"><?php echo HEADING_OPTIONS_SEAT; ?></h4>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-seats">
                                        <thead>
                                        <tr>
                                            <td class="text-center"><?php echo COLUMN_NUMBER; ?></td>
                                            <td class="text-center"><?php echo COLUMN_VOLUME; ?></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"><?php echo COLUMN_WIDTH; ?></td>
                                            <td class="text-center"><?php echo COLUMN_LENGTH; ?></td>
                                            <td class="text-center"><?php echo COLUMN_HEIGHT; ?></td>
                                            <td class="text-center"><?php echo COLUMN_WEIGHT; ?></td>
                                            <td class="text-center"><?php echo COLUMN_VOLUME_WEIGHT; ?></td>
                                            <td class="text-center" width="100px"><?php echo COLUMN_ACTION; ?></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="8"></td>
                                            <td class="text-center">
                                                <button type="button" onclick="addSeat();" data-toggle="modal"  data-tooltip=true title="<?php echo BUTTON_ADD; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" onclick="saveSeats();" class="btn btn-primary"><i class="fa fa-check"></i></button>
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal seats END -->

                <!-- Modal of totals list START -->
                <div class="modal fade" id="modal-totals-list" tabindex="-1" role="dialog" aria-labelledby="totals-list-label">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="totals-list-label"><?php echo HEADING_COMPONENTS_LIST; ?></h4>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-totals_list">
                                        <thead>
                                        <tr>
                                            <td><?php echo COLUMN_DESCRIPTION; ?></td>
                                            <td class="text-center"><?php echo COLUMN_PRICE; ?></td>
                                            <td class="text-center"><?php echo COLUMN_ACTION; ?></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                                <?php foreach ($data['totals'] as $i => $total) { ?>
                                                    <tr>
                                                        <td><?php echo $total['title']; ?></td>
                                                        <td class="text-center"><?php echo $total['price']; ?> <?php echo TEXT_GRN; ?></td>
                                                        <td class="text-center">
                                                            <?php if ($total['status']) { ?>
                                                                <button type="button" class="btn btn-danger btn-xs" id="button-total_declared_cost_minus"><i class="fa fa-minus"></i></button>
                                                            <?php } else { ?>
                                                                <button type="button" class="btn btn-success btn-xs" id="button-total_declared_cost_plus"><i class="fa fa-plus"></i></button>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td><strong><?php echo TEXT_DECLARED_COST; ?></strong></td>
                                            <td class="text-center" id="td-declared_cost_total"><strong><?php echo $data['declared_cost']; ?> <?php echo TEXT_GRN; ?></strong></td>
                                            <td></td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" onclick="saveDeclaredCost();" class="btn btn-primary"><i class="fa fa-check"></i></button>
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal of totals list END -->

            </form>
        </div>
    </div>
</div>

<?php include(DIR_WS_INCLUDES.'modules/novaposhta/js/novaposhta_cn_form.php'); ?>
