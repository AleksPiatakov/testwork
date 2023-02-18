<script type="text/javascript">
    function validateForm(element) {
        var post_data = element.name + '=' + encodeURIComponent(element.value);

        if (element.name == 'sender_contact_person') {
            post_data += '&f_sender=' + encodeURIComponent($('#input-sender').val());
        } else if (element.name == 'sender_city_name') {
            post_data += '&sender_city=' + encodeURIComponent($('#input-sender_city').val());
        } else if (element.name == 'sender_address_name') {
            post_data += '&sender_address=' + encodeURIComponent($('#input-sender_address').val()) + '&f_sender=' + encodeURIComponent($('#input-sender').val()) + '&sender_city=' + encodeURIComponent($('#input-sender_city').val());
        } else if (element.name == 'recipient_city_name') {
            post_data += '&recipient_city=' + encodeURIComponent($('#input-recipient_city').val());
        } else if (element.name == 'recipient_warehouse_name') {
            post_data += '&recipient_warehouse=' + encodeURIComponent($('#input-recipient_warehouse').val());
        } else if (element.name == 'recipient_street_name') {
            post_data += '&recipient_street=' + encodeURIComponent($('#input-recipient_street').val());
        }  else if (element.name == 'backward_delivery_total') {
            post_data += '&backward_delivery=' + encodeURIComponent($('#input-backward_delivery').val());
        }

        $.ajax( {
            url: './includes/modules/novaposhta/novaposhta.php?action=getCNForm',
            type: 'POST',
            data: post_data,
            dataType: 'json',
            success: function(json) {
                checkErrors(json);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus);
            }
        } );
    }

    function checkErrors(array) {
        if (array['warning']) {
            if (array['warning'] instanceof Array) {
                for(var w in array['warning']) {
                    $('.container-fluid').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + array['warning'][w] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                }
            } else {
                $('.container-fluid').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + array['warning'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
            }
        }

        for(var field in array['errors']) {
            $('div.form-group').has('label[for="input-' + field + '"]').removeClass('has-success').addClass('has-error');
            $('#span-' + field).remove('.help-block');
            $('div.form-group > div[class^="col-sm"]').has('#input-' + field).append('<span id="span-' + field + '" class="help-block">' + array['errors'][field] + '</span>');
        }

        for(var field in array['success']) {
            $('div.form-group').has('label[for="input-' + field + '"]').removeClass('has-error').addClass('has-success');
            $('#span-' + field).remove('.help-block');
        }
    }

    function addSeat() {
        var row = '<tr>';

        row += '<td>' + ($('#table-seats tbody tr').length + 1) + '</td>';
        row += '<td><div class="input-group"><input type="text" name="volume" value="" id="input-seat-volume" class="form-control" /><span class="input-group-addon"><?php echo TEXT_CUBIC_METER; ?></span></div></td>';
        row += '<td><label class="col-sm-12 control-label"><?php echo TEXT_OR; ?></label></td>';
        row += '<td><div class="input-group"><input type="text" name="width" value="" id="input-seat-width" class="form-control" /><span class="input-group-addon"><?php echo TEXT_CM; ?></span></div></td>';
        row += '<td><div class="input-group"><input type="text" name="length" value="" id="input-seat-length" class="form-control" /><span class="input-group-addon"><?php echo TEXT_CM; ?></span></div></td>';
        row += '<td><div class="input-group"><input type="text" name="height" value="" id="input-seat-height" class="form-control" /><span class="input-group-addon"><?php echo TEXT_CM; ?></span></div></td>';
        row += '<td><div class="input-group"><input type="text" name="actual_weight" value="" id="input-seat-actual-weight" class="form-control" /><span class="input-group-addon"><?php echo TEXT_KG; ?></span></div></td>';
        row += '<td><div class="input-group"><input type="text" name="volume_weight" value="" id="input-seat-volume-weight" class="form-control" readonly/><span class="input-group-addon"><?php echo TEXT_KG; ?></span></div></td>';
        row += '<td class="text-center"><button type="button" onclick="$(this).parents(\'tr\').remove()" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
        row += '</tr>';

        $('#table-seats tbody').append(row);
    }

    function saveSeats() {
        var trs = $('#table-seats tbody tr');
        var seats = trs.length, weight = 0, volume = 0, volume_weight = 0;

        trs.each(function(i, element){
            tr = $(element);

            weight += +tr.find('#input-seat-actual-weight').val();
            volume += +tr.find('#input-seat-volume').val();
            volume_weight += +tr.find('#input-seat-volume-weight').val();
        } );

        $('#input-seats_amount').val(seats);
        $('#input-weight').val(weight);
        $('#input-volume_general').val(volume);
        $('#input-volume_weight').val(volume_weight);

        $('#modal-options-seat').modal('hide');
    }

    function saveDeclaredCost() {
        $('#input-declared_cost').val(parseInt($('#td-declared_cost_total')[0].outerText));

        $('#modal-totals-list').modal('hide');
    }

    function formHandler(element) {
        switch(element.id) {
            case 'input-sender':
                $.ajax( {
                    url: './includes/modules/novaposhta/novaposhta.php?request=getNPData',
                    type: 'POST',
                    data: 'action=getContactPerson&filter=' + encodeURIComponent(element.value),
                    dataType: 'json',
                    success: function (json) {
                        var html = '<option value=""><?php echo TEXT_SELECT; ?></option>';

                        for (var i in json) {
                            if (json[i]['Ref'] == "<?php echo $data['sender_contact_person']; ?>") {
                                html += '<option value="' + json[i]['Ref'] + '" selected="selected">' + json[i]['Description'] + ', ' + json[i]['Phones'] + '</option>';
                            } else {
                                html += '<option value="' + json[i]['Ref'] + '">' + json[i]['Description'] + ', ' + json[i]['Phones'] + '</option>';
                            }
                        }

                        $('#input-sender_contact_person').html(html).trigger('change');

                        var edrpou = element.selectedOptions[0].label.substr(element.selectedOptions[0].label.indexOf(', ') + 2);
                        $('#input-sender_edrpou').val(edrpou);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus);
                    }
                } );

                $.ajax( {
                    url: './includes/modules/novaposhta/novaposhta.php?request=getNPData',
                    type: 'post',
                    data: 'action=getSenderOptions&filter=' + encodeURIComponent(element.value),
                    dataType: 'json',
                    success: function (json) {
                        if (json['CanPayTheThirdPerson']) {
                            $('#input-payer > option[value="ThirdPerson"]').prop('disabled', false).trigger('change');
                        } else {
                            $('#input-payer > option[value="ThirdPerson"]').prop('disabled', true).trigger('change');
                        }

                        if (json['CanAfterpaymentOnGoodsCost']) {
                            $('[for="input-payment_control"]').filter(':hidden').parent().fadeIn();
                        } else {
                            $('[for="input-payment_control"]').filter(':visible').parent().fadeOut();
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus);
                    }
                } );

                break;

            case 'input-sender_contact_person':
                var phone = element.selectedOptions[0].label.substr(element.selectedOptions[0].label.indexOf(', ') + 2);

                $('#input-sender_contact_person_phone').val(phone);

                break;

            case 'input-sender_region':
                $('#input-sender_city_name').val('').trigger('change');

            case 'input-sender_city_name':
                $('#input-sender_city, #input-sender_address, #input-sender_address_name').val('').trigger('change');

                break;

            case 'input-recipient_address_type':
                if (element.value == 'doors') {
                    $('[for="input-recipient_warehouse_name"], [for="input-width"], [for="input-length"], [for="input-height"]').filter(':visible').parent().fadeOut();
                    $('[for="input-recipient_street_name"], [for="input-recipient_house"], [for="input-recipient_flat"], [for="input-rise_on_floor"], [for="input-elevator"]').filter(':hidden').parent().fadeIn();
                    $('#input-departure_type > option[value="TiresWheels"], #input-departure_type > option[value="Pallet"], #input-volume_general, #input-seats_amount, #button-options_seat').attr('disabled', false);

                    if ($('#input-preferred_delivery_date').val()) {
                        $('[for="input-time_interval"]').filter(':hidden').parent().fadeIn();
                    }
                } else if (element.value == 'poshtomat') {
                    var departure_type = $('#input-departure_type').val();

                    if (departure_type == 'Parcel') {
                        $('[for="input-width"], [for="input-length"], [for="input-height"]').filter(':hidden').parent().fadeIn();
                    } else if (departure_type == 'Cargo' || departure_type == 'TiresWheels' || departure_type == 'Pallet'){
                        $('#input-departure_type').val('Parcel').trigger('change');
                    }

                    $('[for="input-recipient_warehouse_name"]').filter(':hidden').parent().fadeIn();
                    $('[for="input-recipient_street_name"], [for="input-recipient_house"], [for="input-recipient_flat"], [for="input-time_interval"], [for="input-rise_on_floor"], [for="input-elevator"]').filter(':visible').parent().fadeOut();
                    $('#input-departure_type > option[value="TiresWheels"], #input-departure_type > option[value="Pallet"], #input-volume_general, #input-seats_amount, #button-options_seat').attr('disabled', true);
                    $('#input-seats_amount').val('1');
                } else {
                    $('[for="input-recipient_warehouse_name"]').filter(':hidden').parent().fadeIn();
                    $('[for="input-recipient_street_name"], [for="input-recipient_house"], [for="input-recipient_flat"], [for="input-width"], [for="input-length"], [for="input-height"], [for="input-time_interval"], [for="input-rise_on_floor"], [for="input-elevator"]').filter(':visible').parent().fadeOut();
                    $('#input-departure_type > option[value="TiresWheels"], #input-departure_type > option[value="Pallet"], #input-volume_general, #input-seats_amount, #button-options_seat').attr('disabled', false);
                }

                break;

            case 'input-recipient_name':
                $('#input-recipient').val('');

                break;

            case 'input-recipient_region':
                $('#input-recipient_region_name, #input-recipient_district_name').val('');

            case 'input-recipient_city_name':
                var
                    address_type = $('#input-recipient_address_type:checked').val(),
                    delivery_date = $('#input-preferred_delivery_date').val();

                if (address_type == 'doors' && delivery_date) {
                    $.ajax( {
                        url: './includes/modules/novaposhta/novaposhta.php?request=getNPData',
                        type: 'post',
                        data: 'action=getTimeIntervals&filter=' + encodeURIComponent(element.value) + '&delivery_date=' + encodeURIComponent(delivery_date),
                        dataType: 'json',
                        success: function (json) {
                            var html = '<option value=""><?php echo TEXT_DURING_DAY; ?></option>';

                            for (var i in json) {
                                html += '<option value="' + json[i]['Number'] + '">' + json[i]['Start'] + ' - ' + json[i]['End'] + '</option>';
                            }

                            $('#input-time_interval').html(html);
                        }
                    } );
                }

                break;

            case 'input-recipient_warehouse_name':
                if (element.value.match(/почтомат|поштомат/i)) {
                    $('input[value="poshtomat"]').prop('checked', true).trigger('change').parent().addClass('active').siblings().removeClass('active').children().removeAttr('checked');
                } else {
                    $('input[value="warehouse"]').prop('checked', true).trigger('change').parent().addClass('active').siblings().removeClass('active').children().removeAttr('checked');
                }

                break;

            case 'input-departure_type':
                var recipient_warehouse = $('#input-recipient_warehouse_name').val();

                if (element.value == 'Parcel' || element.value == 'Cargo') {
                    var html = '<input type="text" name="weight" value="<?php echo $data['weight']; ?>" placeholder="<?php echo ENTRY_WEIGHT; ?>" id="input-weight" class="form-control" />';

                    $('#input-weight').replaceWith(html);

                    $('[for*="input-tires_and_wheels"]').filter(':visible').parent().fadeOut();
                    $('[for="input-weight"], [for="input-volume_weight"], [for="input-volume_general"]').filter(':hidden').parent().fadeIn();
                    $('#button-options_seat, #input-seats_amount, #input-departure_description').attr('disabled', false);

                    if (recipient_warehouse.match(/почтомат|поштомат/i)) {
                        $('[for="input-width"], [for="input-length"], [for="input-height"]').filter(':hidden').parent().fadeIn();
                        $('#button-options_seat, #input-seats_amount').attr('disabled', true);
                        $('#input-seats_amount').val('1');
                    }

                    if (element.value == 'Cargo') {
                        $('[for="input-redbox_barcode"]').filter(':visible').parent().fadeOut();
                    } else {
                        $('[for="input-redbox_barcode"]').filter(':hidden').parent().fadeIn();
                        $('#input-redbox_barcode').trigger('change');
                    }
                } else if (element.value == 'Documents') {
                    var html = '<select name="weight" id="input-weight" class="form-control"><option value=""><?php echo TEXT_SELECT; ?></option><option value="0.1">0.1</option><option value="0.5">0.5</option><option value="1">1</option></select>';

                    $('#input-weight').replaceWith(html);

                    $('[for="input-redbox_barcode"], [for*="input-tires_and_wheels"], [for="input-volume_weight"], [for="input-volume_general"]').filter(':visible').parent().fadeOut();
                    $('[for="input-weight"]').filter(':hidden').parent().fadeIn();
                    $('#button-options_seat, #input-seats_amount').attr('disabled', false);
                    $('#input-departure_description').attr('disabled', true).val('Документи');

                    if (recipient_warehouse.match(/почтомат|поштомат/i)) {
                        $('[for="input-width"], [for="input-length"], [for="input-height"]').filter(':visible').parent().fadeOut();
                        $('#button-options_seat, #input-seats_amount').attr('disabled', true);
                        $('#input-seats_amount').val('1');
                    }
                } else if (element.value == 'TiresWheels') {
                    $('[for="input-redbox_barcode"], [for="input-width"], [for="input-length"], [for="input-height"], [for="input-weight"], [for="input-volume_weight"], [for="input-volume_general"]').filter(':visible').parent().fadeOut();
                    $('[for*="input-tires_and_wheels"]').filter(':hidden').parent().fadeIn();
                    $('#button-options_seat, #input-seats_amount, #input-departure_description').attr('disabled', true);
                    $('#input-departure_description').val('Шини та диски');
                }

                break;

            case 'input-redbox_barcode':
                if (element.value) {
                    $('[for="input-weight"], [for="input-volume_general"], [for="input-volume_weight"]').filter(':visible').parent().fadeOut();
                    $('#button-options_seat, #input-seats_amount').attr('disabled', true);
                    $('#input-seats_amount').val('1');
                } else {
                    $('[for="input-weight"], [for="input-volume_general"], [for="input-volume_weight"]').filter(':hidden').parent().fadeIn();
                    $('#button-options_seat, #input-seats_amount').attr('disabled', false);
                }

                break;

            case (element.id.match(/input-tires_and_wheels_/) || {}).input:
                var c = 0;

                $('input[id^="input-tires_and_wheels"]').each(function() {
                    c += +this.value;
                } );

                $('#input-seats_amount').val(c);

                break;

            case 'input-volume_general':
                $('#input-volume_weight').val((element.value * 250).toFixed(3));

                break;

            case 'input-width':
            case 'input-length':
            case 'input-height':
                $('#input-volume_general').val(($('#input-width').val() * $('#input-length').val() * $('#input-height').val() / 1000000).toFixed(3)).trigger('change');

                break;

            case 'input-seat-volume':
                $(element).parents('tr').find('#input-seat-volume-weight').val((element.value * 250).toFixed(3));

                break;

            case 'input-seat-width':
            case 'input-seat-length':
            case 'input-seat-height':
                var
                    row = $(element).parents('tr'),
                    width = row.find('#input-seat-width').val(),
                    length = row.find('#input-seat-length').val(),
                    height = row.find('#input-seat-height').val();

                row.find('#input-seat-volume').val((width * length * height / 1000000).toFixed(3)).trigger('change');

                break;

            case 'input-declared_cost':
                var $backward_delivery_total = $('#input-backward_delivery_total');

                if (+element.value < +$backward_delivery_total.val() && $backward_delivery_total.is(':visible')) {
                    element.value = $backward_delivery_total.val();
                }

                break;

            case 'input-payer':
                if (element.value == 'ThirdPerson') {
                    $('[for="input-third_person"]').filter(':hidden').parent().fadeIn();
                    $('#input-payment_type > option[value ="NonCash"]').prop('selected', true);
                    $('#input-payment_type > option[value="Cash"]').prop({'disabled': true, 'selected': false});
                } else {
                    $('[for="input-third_person"]').filter(':visible').parent().fadeOut();
                    $('#input-payment_type > option[value="Cash"]').prop('disabled', false);
                }

                $('#input-payment_type').trigger('change');

                break;

            case 'input-backward_delivery':
                if (element.value == 'Money') {
                    $('[for="input-backward_delivery_total"], [for="input-backward_delivery_payer"], [for="input-money_transfer_method"]').filter(':hidden').parent().fadeIn();

                    $('#input-money_transfer_method').trigger('change');
                } else {
                    $('[for="input-backward_delivery_total"], [for="input-backward_delivery_payer"], [for="input-money_transfer_method"], [for="input-payment_card"]').filter(':visible').parent().fadeOut();
                }

                break;

            case 'input-backward_delivery_total':
                var $declared_cost = $('#input-declared_cost');

                if (+element.value > +$declared_cost.val()) {
                    $declared_cost.val(element.value);
                }

                break;

            case 'input-money_transfer_method':
                if (element.value == 'to_payment_card') {
                    $('[for="input-payment_card"]').filter(':hidden').parent().fadeIn();
                } else {
                    $('[for="input-payment_card"]').filter(':visible').parent().fadeOut();
                }

                break;

            case 'input-payment_control':
                if (element.value) {
                    $('#input-backward_delivery > option[value ="N"]').prop('selected', true).trigger('change');
                } else {
                    $('#input-backward_delivery > option[value ="Money"]').prop('selected', true).trigger('change');
                }

                break;

            case 'input-preferred_delivery_date':
                if (element.value && $('#input-recipient_address_type:checked').val() == 'doors') {
                    $('[for="input-time_interval"]').filter(':hidden').parent().fadeIn();
                    $('#input-recipient_city_name').trigger('change')
                } else {
                    $('[for="input-time_interval"]').filter(':visible').parent().fadeOut();
                }

                break;

            case 'input-elevator':
                if ($('#input-elevator:checked').val()) {
                    $('#input-rise_on_floor').attr('disabled', true);
                } else {
                    $('#input-rise_on_floor').attr('disabled', false);
                }

                break;
        }
    }

    $( function () {
        $('[data-tooltip=true]').tooltip();

        $('.date').datetimepicker( {pickTime: false} ).on('change', function () {
            var input = $(this).find('input')[0];

            formHandler(input);
            validateForm(input);
        } );

        $('form').on('change', 'input, select, textarea', function() {
            setTimeout(formHandler, 100, this);
            setTimeout(validateForm, 200, this);
        } );

        $('#input-sender, input-sender_contact_person, #input-recipient_address, #input-recipient_address_type:checked, #input-departure_type, #input-delivery_payer, #input-backward_delivery, #input-elevator').each(function() {
            formHandler(this);
        } );

        // Change totals list
        $('#modal-totals-list').on('click', '#button-total_declared_cost_minus, #button-total_declared_cost_plus', function (e) {
            var b = $(e.currentTarget),
                cost = parseInt(b.parents('tr').find('td:eq(1)').text()),
                total = $('#td-declared_cost_total')[0].outerText;

            if (e.currentTarget.id == 'button-total_declared_cost_minus') {
                b.replaceWith('<button type="button" class="btn btn-success btn-xs" id="button-total_declared_cost_plus"><i class="fa fa-plus"></i></button>');

                total = total.replace(/-?\d+/, parseInt(total) - cost);
            } else {
                b.replaceWith('<button type="button" class="btn btn-danger btn-xs" id="button-total_declared_cost_minus"><i class="fa fa-minus"></i></button>');

                total = total.replace(/-?\d+/, parseInt(total) + cost);
            }

            $('#td-declared_cost_total').html('<strong>' + total + '</strong>');
        } );

        // Search sender city
        $('#input-sender_city_name').autocomplete( {
            source: function(request, response) {
                var post_data = 'city=' + encodeURIComponent(request) + '&region=' + encodeURIComponent($('#input-sender_region').val());

                $.ajax( {
                    url: './includes/modules/novaposhta/novaposhta.php?request=autocomplete',
                    type: 'post',
                    data: post_data,
                    dataType: 'json',
                    success: function(json) {
                        response($.map(json, function(item) {
                            return {
                                label: item['FullDescription'],
                                value: item['Description'],
                                ref:  item['Ref']
                            }
                        } ));
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus);
                    }
                } );
            },
            select: function(item) {
                $(this).val(item['value']).trigger('change');
                setTimeout(function() { $('#input-sender_city').val(item['ref']); }, 150);
            }
        } );

        // Search address
        $('#input-sender_address_name').autocomplete( {
            source: function(request, response) {
                $.ajax( {
                    url: './includes/modules/novaposhta/novaposhta.php?request=autocomplete',
                    type: 'POST',
                    data: 'address=' + encodeURIComponent(request) + '&filter=' + encodeURIComponent($('#input-sender_city').val()) + '&sender=' + encodeURIComponent($('#input-sender').val()),
                    dataType: 'json',
                    success: function(json) {
                        response($.map(json, function(item) {
                            return {
                                label: item['Description'],
                                value: item['Ref']
                            }
                        } ));
                    }
                } );
            },
            select: function(item) {
                $(this).val(item['label']).trigger('change');
                $(this).siblings('input[type="hidden"]').val(item['value']);
            }
        } );

        // Search recipient
        $('#input-recipient_name').autocomplete( {
            source: function(request, response) {
                $.ajax( {
                    url: './includes/modules/novaposhta/novaposhta.php?request=autocomplete',
                    type: 'POST',
                    data: 'recipient_name=' + encodeURIComponent(request),
                    dataType: 'json',
                    success: function(json) {
                        response($.map(json, function(item) {
                            return {
                                label: item['FullDescription'],
                                value: item['Description'],
                                ref:   item['Ref']
                            }
                        }));
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus);
                    }
                } );
            },
            select: function(item) {
                $(this).val(item['value']).trigger('change');
                setTimeout(function() { $('#input-recipient').val(item['ref']); }, 150);
            }
        } );

        // Search recipient city
        $('#input-recipient_city_name').autocomplete( {
            source: function(request, response) {
                var post_data;

                if ($('#input-recipient_address_type:checked').val() == 'doors') {
                    post_data = 'settlement=' + encodeURIComponent(request)

                    if ($('#input-recipient_region').val()) {
                        post_data += encodeURIComponent(' ' + $('#input-recipient_region option:selected').text());
                    }
                } else {
                    post_data = 'city=' + encodeURIComponent(request) + '&region=' + encodeURIComponent($('#input-recipient_region').val());
                }

                $.ajax( {
                    url: './includes/modules/novaposhta/novaposhta.php?request=autocomplete',
                    type: 'post',
                    data: post_data,
                    dataType: 'json',
                    success: function(json) {
                        response($.map(json, function(item) {
                            return {
                                label:		  item['FullDescription'],
                                value:		  item['Ref'],
                                name:		  item['Description'],
                                region_name:  item['Area'] || '',
                                distric_name: item['Region'] || '',
                            }
                        } ));
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus);
                    }
                } );
            },
            select: function(item) {
                $(this).val(item['name']).trigger('change');
                $('#input-recipient_city').val(item['value']);
                $('#input-recipient_region_name').val(item['region_name']);
                $('#input-recipient_district_name').val(item['distric_name']);
            }
        } );

        // Search warehouse
        $('#input-recipient_warehouse_name').autocomplete( {
            source: function(request, response) {
                $.ajax( {
                    url: './includes/modules/novaposhta/novaposhta.php?request=autocomplete',
                    type: 'POST',
                    data: 'filter=' + encodeURIComponent($('#input-recipient_city').val()) + '&warehouse=' + encodeURIComponent(request),
                    dataType: 'json',
                    success: function(json) {
                        response($.map(json, function(item) {
                            return {
                                label: item['Description'],
                                value: item['Description'],
                                ref:   item['Ref']
                            }
                        } ));
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus);
                    }
                } );
            },
            select: function(item) {
                $(this).val(item['value']).trigger('change');
                $(this).siblings('input[type="hidden"]').val(item['ref']);
            }
        } );

        // Search street
        $('#input-recipient_street_name').autocomplete( {
            source: function(request, response) {
                $.ajax( {
                    url: './includes/modules/novaposhta/novaposhta.php?request=autocomplete',
                    type: 'POST',
                    data: 'filter=' + encodeURIComponent($('#input-recipient_city').val()) + '&street=' + encodeURIComponent(request),
                    dataType: 'json',
                    success: function(json) {
                        response($.map(json, function(item) {
                            return {
                                label: item['Description'],
                                value: item['Description'],
                                ref:   item['Ref']
                            }
                        } ));
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus);
                    }
                } );
            },
            select: function(item) {
                $(this).val(item['value']).trigger('change');
                $(this).siblings('input[type="hidden"]').val(item['ref']);
            }
        } );

        // Departure description
        $('#input-departure_description').autocomplete({
            source: function(request, response) {
                $.ajax( {
                    url: './includes/modules/novaposhta/novaposhta.php?request=autocomplete',
                    type: 'post',
                    data: 'departure_description=' + encodeURIComponent(request),
                    dataType: 'json',
                    success: function(json) {
                        response($.map(json, function(item) {
                            return {
                                label: item['Description'],
                                value: item['Description'],
                            }
                        } ));
                    }
                } );
            },
            select: function(item) {
                $(this).val(item['value']).triggerHandler('change');
            }
        } );

        // Save CN
        $('#button-save').on('click', function () {
            var $post_data = $('input[type="text"], input[type="radio"]:checked, input[type="checkbox"]:checked, select, textarea').filter(':visible').add('input[type="hidden"]');

            $.ajax( {
                url: './includes/modules/novaposhta/novaposhta.php?request=saveCN&order_id=<?php echo $data['order_id']; ?>&cn_ref=<?php echo $data['cn_ref']; ?>',
                type: 'POST',
                data: $post_data,
                dataType: 'json',
                beforeSend: function() {
                    $('body').fadeTo('fast', 0.8).prepend('<div id="ajax-loader" style="position: fixed; top: 50%;	left: 50%; z-index: 9999;"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
                },
                complete: function(json){
                    var $alerts = $('.alert-danger, .alert-success');

                    if ($alerts.length !== 0) {
                        setTimeout(function() { $alerts.remove(); }, 15000);
                    }

                    if (json['errors'] != 'undefined' || json['warning'] != 'undefined') {
                        $('html, body').animate({ scrollTop: $('.has-error, .alert').offset() }, 1000);
                    }

                    $('body').fadeTo('fast', 1)
                    $('#ajax-loader').remove();

                },
                success: function(json) {
                    if (typeof json['success'] !== 'undefined') {
                        $.post('includes/modules/novaposhta/novaposhta.php', {
                            action: 'getCNList'
                        }, function(data) {
                            modal({
                                id: 'getCNList',
                                body: data.html,
                                render: true,
                                width: '70%',
                            });

                        }, 'json');
                        return false;
                    } else {
                        $('.help-block').remove();
                        $('div').removeClass('has-error has-success');

                        checkErrors(json);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus);
                },
            } );
        } );

        // getCNList
        $('#button-getcnlist2').on('click', function () {
            $.post('includes/modules/novaposhta/novaposhta.php', {
                action: 'getCNList'
            }, function(data) {
                modal({
                    id: 'getCNList',
                    body: data.html,
                    render: true,
                    width: '70%',
                });

            }, 'json');
            return false;
        } );

    } );

</script>