   $(function () {
       var options = {target: '#block', beforeSubmit: showRequest, success: showResponse};
       var rangeTimeout = null;
       $(document).on('keyup', "#range1, #range2", function () {
        if (rangeTimeout) {
            clearTimeout(rangeTimeout);
        }
           rangeTimeout = setTimeout(function () {
            if ($(this).attr('id') == 'range1') {
                $("#slider-range").slider("values", 0, $(this).val());
            } else if ($(this).attr('id') == 'range2') {
                $("#slider-range").slider("values", 1, $(this).val());
            }
            if ($("#rmin2").length != 0) {
                $("#rmin2").remove();
            }
               $("#m_srch").append('<input type=hidden name=rmin id=rmin2 value="' + $("#range1").val() + '" />');
            if ($("#rmax2").length != 0) {
                $("#rmax2").remove();
            }
               $("#m_srch").append('<input type=hidden name=rmax id=rmax2 value="' + $("#range2").val() + '" />');
               // $('#m_srch').ajaxSubmit(options);
               ajaxSubmitSerialize(options);
           }, 500)
       });
       initSlider = function () {
           $("#slider-range").slider({
                range: true,
                min: parseInt($("input[name=slider_min]").val()),
                max: parseInt($("input[name=slider_max]").val()),
                values: [parseInt($("#range1").val() || $("input[name=slider_min]").val()),  // current min val
                   parseInt($("#range2").val() || $("input[name=slider_max]").val())], // current max val
                animate: true, // animate sliding on change
                slide: function (event, ui) {
                    var left_symbol = '';
                    var right_symbol = '';
                    if ($('[name="currency"]:first option:selected').length) {
                        left_symbol = $('[name="currency"]:first option:selected').data('left') || '';
                        right_symbol = $('[name="currency"]:first option:selected').data('right') || '';
                        left_symbol.trim();
                        right_symbol.trim();
                    }
                    var curmin = $("input[name=slider_min]").val();
                    var curmax = $("input[name=slider_max]").val();
                    // change inputs values when sliding
                    $("#range1").val(left_symbol + ui.values[0] + right_symbol);
                    $("#range2").val(left_symbol + ui.values[1] + right_symbol);

                    // renew hidden inputs of min and max values:
                    if ($("#rmin2").length != 0) {
                        $("#rmin2").remove();
                    }
                    $("#m_srch").append('<input type=hidden name=rmin id=rmin2 value="' + $("#range1").val() + '" />');
                    if ($("#rmincurrent2").length != 0) {
                        $("#rmincurrent2").remove();
                    }
                    $("#m_srch").append('<input type=hidden name=rmin_current id=rmincurrent2 value="' + curmin + '" />');
                    if ($("#rmax2").length != 0) {
                        $("#rmax2").remove();
                    }
                    $("#m_srch").append('<input type=hidden name=rmax id=rmax2 value="' + $("#range2").val() + '" />');
                    if ($("#rmaxcurrent2").length != 0) {
                        $("#rmaxcurrent2").remove();
                    }
                    $("#m_srch").append('<input type=hidden name=rmax_current id=rmaxcurrent2 value="' + curmax + '" />');
                },
                stop: function (event, ui) {
                    ajaxSubmitSerialize(options);
                }
            });
       }
       initSlider();
       $(document).on('change','#ajax_search_brands input[type=checkbox]',function () {
           brand_filtering(this);
       });
       // clarifying categories
       $(document).on('click', '.clarifying-categories', function () {
           $('.search_cat_active').removeClass('search_cat_active');
           this.classList.add('search_cat_active');
           clarifying_categories_filtering(this.dataset.id);
       });
       $(document).on('change',"#attribs input[type=checkbox]",function () {
           // for template clo, except brand
        if (this.classList.contains('except_brands')) {
            return false;
        }

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

            $output_val = $output_val.slice(0, -1);

            if ($("#pl_at" + currenlol + "_2").length != 0) {
                $("#pl_at" + currenlol + "_2").val($output_val);
            } else { // append hidden field of current attribute:
                $("#m_srch").append('<input type="hidden" name="' + currenlol + '" id="pl_at' + currenlol + '_2" value="' + currentval + '" />');
            }

            // auto check "all" when we have unchecked all checkboxes
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
})

function brand_filtering(value)
{

    var options = {target: '#block',beforeSubmit: showRequest,success:showResponse};
    value = $(value).val();
    var output_val = '';

    var input = $('#m_srch input[name="filter_id"]');

    if (value === 'not') {
        input.remove();
        $('#ajax_search_brands :not(.filter_all)').prop('checked', false);
        $('#ajax_search_brands .filter_all').prop('checked', true);
    } else {
        $('#ajax_search_brands .filter_all').prop('checked', false); // uncheck "all"

        $("#ajax_search_brands input[name='filter_id[]']").each(function () {
            if ($(this).val() !== 'not') {
                if ($(this).is(':checked')) {
                    output_val += $(this).val() + '-';
                }
            }
        });

        output_val = output_val.slice(0, -1);

        if (input.length === 0) {
            $("#m_srch").append('<input type="hidden" name="filter_id" value="' + value + '" />');
        } else {
            // if there is not selected any manufacturer, select 'not'
            if (value === '') {
                input.remove();
                $('#ajax_search_brands :not(.filter_all)').prop('checked', false);
                $('#ajax_search_brands .filter_all').prop('checked', true);
            } else {
                // add string
                input.val(output_val);
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