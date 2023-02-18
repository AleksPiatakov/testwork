   $(function () {
       var options = {target: '#block',beforeSubmit: showRequest,success:showResponse};

       $("#range1, #range2").keyup(function () {
        if ($(this).attr('id') == 'range1') {
            $("#slider-range").slider("values",0,$(this).val());
        } else if ($(this).attr('id') == 'range2') {
            $("#slider-range").slider("values",1,$(this).val());
        }
        if ($("#rmin2").length != 0) {
            $("#rmin2").remove();}$("#m_srch").append('<input type=hidden name=rmin id=rmin2 value="' + $("#range1").val() + '" />');
        if ($("#rmax2").length != 0) {
            $("#rmax2").remove();}$("#m_srch").append('<input type=hidden name=rmax id=rmax2 value="' + $("#range2").val() + '" />');
        // $('#m_srch').ajaxSubmit(options);
                 ajaxSubmitSerialize(options);
       });
     $("#slider-range").slider({
            range: true,
            min: parseInt($("input[name=slider_min]").val()),
            max: parseInt($("input[name=slider_max]").val()),
            values: [parseInt($("#range1").data('val') || $("input[name=slider_min]").val()),  // current min val
                parseInt($("#range2").data('val') || $("input[name=slider_max]").val())], // current max val
            animate:true, // animate sliding on change
            slide: function (event, ui) {
                var left_symbol = '';
                var right_symbol = '';
                if ($('[name="currency"]:first option:selected').length) {
                    left_symbol = $('[name="currency"]:first option:selected').data('left') || '';
                    right_symbol = $('[name="currency"]:first option:selected').data('right') || '';
                    left_symbol.trim();
                    right_symbol.trim();
                }
              // change inputs values when sliding
                $("#range1").val(left_symbol + ui.values[0] + right_symbol);
                $("#range2").val(left_symbol + ui.values[1] + right_symbol);

              // renew hidden inputs of min and max values:
                if ($("#rmin2").length != 0) {
                    $("#rmin2").remove();}$("#m_srch").append('<input type=hidden name=rmin id=rmin2 value="' + $("#range1").val() + '" />');
                if ($("#rmax2").length != 0) {
                    $("#rmax2").remove();}$("#m_srch").append('<input type=hidden name=rmax id=rmax2 value="' + $("#range2").val() + '" />');
            },
            stop: function (event, ui) {
                ajaxSubmitSerialize(options);
            }
        });
    $('#ajax_search_brands input[type=checkbox]').change(function () {
        brand_filtering(this.value);
    });
   // clarifying categories
    $(document).on('click', '.clarifying-categories', function () {
        $('.search_cat_active').removeClass('search_cat_active');
        this.classList.add('search_cat_active');
        clarifying_categories_filtering(this.dataset.id);
    });
     $("#attribs input[type=checkbox]").change(function () {
        currenlol = $(this).attr('name'); // id of option (attribute)
        currentval = $(this).val(); // id of option value (attribute value)
                 var $output_val = '';
        if (currentval == "not") { // uncheck all checkboxes for current option if check "all":
            $("#pl_at" + currenlol + "_2").remove();
            $("#attribs input[name=" + currenlol + "]:not(.filter_all)").prop('checked', false);
            $("#attribs input[name=" + currenlol + "].filter_all").prop('checked', true); // by raid
        } else { // get all checked checkboxes:
            $("#attribs input[name=" + currenlol + "]").each(function () {
                if ($(this).val() != 'not') {
                    if ($(this).is(':checked')) {
                              $output_val += $(this).val() + '-';
                    }
                }
            });

            $output_val = $output_val.slice(0, -1)

            if ($("#pl_at" + currenlol + "_2").length != 0) {
                       $("#pl_at" + currenlol + "_2").val($output_val);
            } else { // append hidden field of current attribute:
                                    $("#m_srch").append('<input type="hidden" name="' + currenlol + '" id="pl_at' + currenlol + '_2" value="' + currentval + '" />');
            }
            if ($("#pl_at" + currenlol + "_2").val() == '') {
                $("#pl_at" + currenlol + "_2").remove();
                $("#attribs input[name=" + currenlol + "].filter_all").prop('checked', true);
                $("#attribs input[name=" + currenlol + "]:not(.filter_all)").prop('checked', false);
            } else {
                $("#attribs input[name=" + currenlol + "].filter_all").prop('checked', false);
            }
        }
            ajaxSubmitSerialize(options);
     });
});

function brand_filtering(value)
{

    var options = {target: '#block',beforeSubmit: showRequest,success:showResponse};
    var input = $('#m_srch input[name="filter_id"]');
    var checked_string = '';

    if (value == 'not') {
        input.remove();
        $('#ajax_search_brands :not(.filter_all)').prop('checked', false);
        $('#ajax_search_brands .filter_all').prop('checked', true); // by raid
    } else {
          $('#ajax_search_brands .filter_all').prop('checked', false); // uncheck "all"

          $('#ajax_search_brands input[name="filter_id[]"]:checked').each(function (index, el) {
            if (checked_string == '') {
                checked_string = $(this).val();
            } else {
                checked_string = checked_string + '-' + $(this).val();
            }
          });

        // if input does not exists - create it
        if (input.length == 0) {
            $("#m_srch").append('<input type="hidden" name="filter_id" value="' + checked_string + '" />');
        } else {
          // if there is not selected any manufacturer, select 'not'
            if (checked_string == '') {
                  input.remove();
                  $('#ajax_search_brands :not(.filter_all)').prop('checked', false);
                  $('#ajax_search_brands .filter_all').prop('checked', true); // by raid
            } else {
              // add string
                input.val(checked_string);
            }
        }
    }
        ajaxSubmitSerialize(options);
}

function clarifying_categories_filtering(value)
{
    var options = {target: '#block', beforeSubmit: showRequest, success:showResponse};
    var input = $('#m_srch input[name="cid"]');

    if (input.length === 0) {
        $("#m_srch").append('<input type="hidden" name="cid" value="' + value + '" />');
    } else {
        input.val(value);
    }

    ajaxSubmitSerialize(options);
}