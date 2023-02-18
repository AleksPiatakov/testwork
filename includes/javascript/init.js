"use strict";
var initSlider, attributeStock, attributeStockVendorCode, attributeStockPrice, attributeStockSpecialPrice;
jQuery(document).ready(function () {

    var userClickEvent = false;
    var attributeCombinationElement = $('.prod_attributes_combination');
    if (attributeCombinationElement.length > 0) {
        attributeStock = attributeCombinationElement.data('attributestock');
        attributeStockVendorCode = attributeCombinationElement.data('attributestockvendorcode');
        attributeStockPrice = attributeCombinationElement.data('attributestockprice');
        attributeStockSpecialPrice = attributeCombinationElement.data('attributestockspecialprice');
    }

    if ($('#r_buy_intovar').length && typeof attributeStock != "undefined" && attributeStock && attributeStock.length) {
        //start on page load
        setTimeout(function () {
            initialRefreshSelectizesOptions();
            chooseNewCombination();
        }, 100);

        //start on attribute choose
        $(document).on('change', '.color_attributes:not(.attributes_type_color) input', function (event) {
            event.preventDefault();
            var $this = $(this);
            var currAttrIid = $this.parents('.color_attributes').find('input[name="id_color"]').val();
            // change select and refresh it and recalculate summ after changing image of color
            $('#select_id_' + currAttrIid).val($this.val());
            $('#select_id_' + currAttrIid).change();
            //show black border around chosen color
            $this.parents('.color_attributes').find('label').removeClass('active');
            $this.parent().addClass('active');
        });

        $('.prod_attributes_div').on('click', function () {
            userClickEvent = true;
        });

        //start on attribute select
        $('.attr_select .items input:radio,.attr_select .select_id_option').on('change', function () {
            var selectedOptionId = $(this).attr('id').replace('select_id_', '');
            if (userClickEvent) {
                chooseAttribute( selectedOptionId );
            }
        });
    } else {
        setTimeout(checkDefaultAttributesAvailable, 100);
    }

    function checkDefaultAttributesAvailable() {
        var selectElementOptionId, elementSelectize, $element;
        var enableBuyButton = true;
        $('.prod_attributes .attr_select').each(function () {
            //worked only for radio buttons attributes
            //TODO need implement for other attributes variants
            if ($(this).find('.prod_options_radio label').length !== 0 && $(this).find('.prod_options_radio .disabled_label').length === $(this).find('.prod_options_radio label').length) {
                enableBuyButton = false;
            }
        });
        if (!enableBuyButton) {
            $('#r_buy_intovar').addClass('pointer_events_none');
        }
    }

    function chooseNewCombination(selectedOptionId = false) {
        //to prevent events on attribute changes
        userClickEvent = false;
        //select all optionValueIds to optionIds
        var optionIds = [], optionValueIds = [], elementSelectize;
        var optionId = '', optionValueId = '', inCart = false, element;
        $('.attr_select [name="option_name"]').each(function () {
            optionId = $(this).val();
            optionValueIds = [];

            if ($('[name=' + optionId + ']').length) {
                //attribute type image or radio
                optionValueId = $('[name=' + optionId + ']:checked').val();
                $('[name=' + optionId + ']').each(function () {
                    optionValueIds.push($(this).val());
                });
            } else {
                //attribute type select
                optionValueId = $('#select_id_' + optionId + ' option').val();
                element = $('#select_id_' + optionId)[0];
                if (element) {
                    elementSelectize = element.selectize;
                    if (elementSelectize) {
                        optionValueIds = Object.keys(elementSelectize.options);
                    }
                }
            }

            //collect all optionValueIds to optionIds
            optionIds[optionId] = optionValueIds;
            if (optionValueId != 0) {
                inCart = true;
            }
        });
        // console.log(optionIds);

        //collect all valid combinations of attribute`s values
        var validAttributeCombination = collectAllValidAttributeCombinations(attributeStock);

        //if is not choosed any attribute
        // if (inCart == false || selectedOptionId != false) {
            //find first valid attribute combination order in attributeStock list
            var possibleCombinationsBuffer = findFirstValidAttributeCombination(validAttributeCombination, optionIds, selectedOptionId);

            //choose first valid attribute combination
            chooseAttributeCombination(attributeStock, possibleCombinationsBuffer);
            chooseAttribute();
        // }
    }

    function chooseAttribute(selectedOptionId = false)
    {

        //turn off "buy" button
        $('#r_buy_intovar').addClass('pointer_events_none');

        //collect active attribute`s values
        var optionId = '', optionValueId = '', optionIds = [], attrs = [];
        $('.attr_select [name="option_name"]').each(function () {
            optionId = $(this).val();
            // optionValueId = $('[name='+optionId+']:checked').val() || $('#select_id_'+optionId).val();
            optionValueId = $('.attr_select [name="id[' + optionId + ']"]').val();
            optionIds[optionId] = optionValueId;
        });

        //glue active attributes to attributes combination
        $.each(optionIds, function (optionId, optionValueId) {
            if (optionValueId) {
                attrs[optionId] = optionId + '-' + optionValueId;
            }
        });
        var attr = Object.keys(attrs).map(function (x) {
            return attrs[x];
        }).join(',');

        //calc enableBuyButton
        var enableBuyButton = true;
        if (optionIds.includes('0')) {
            enableBuyButton = false;
        }

        // console.log('choose attribute');
        // console.log(selectedOptionId);
        // console.log(attr);
        //check combination existing and
        if (!attributeStock.includes(attr) && enableBuyButton != false && selectedOptionId != false) {
            // console.log('new combo');
            // console.log(attrs);
            //if combination isn`t existing
            chooseNewCombination(selectedOptionId);
        } else {
            //if combination is existing

            //collect all valid combinations of attribute`s values
            var validAttributeCombination = collectAllValidAttributeCombinations(attributeStock);

            //calc current excluded combinations of attribute`s values
            var excludedCombination = calcExcludedCombinations(validAttributeCombination, optionIds);

            //calc current possible combinations of attribute`s values
            var possibleCombination = calcPossiblyValidAttributeCombinations(validAttributeCombination, excludedCombination, optionIds);

            //disable all attribute`s values
            disableAllAttributesValues();

            //display only valid attribute`s values (by valid possible attribute combinations)
            enableActiveAttributesValues(optionIds);

            //display only valid attribute`s values (by valid possible attribute combinations)
            enableValidAttributesValues(possibleCombination);

            //display vendor code
            displayAttributeVendorCode(attr);

            //display attribute combination list
            displayAttributeCombinationList(optionIds);

            if (enableBuyButton) {
                //enable "buy" button
                $('#r_buy_intovar').removeClass('pointer_events_none');

                //display stock label
                var stockBlock = $('.label-stock');
                stockBlock.html(LIST_TEMP_INSTOCK);
                stockBlock.addClass('label-success');
                stockBlock.removeClass('label-danger');
            }
        }
    }

    //collect all valid combinations of attribute`s values
    function collectAllValidAttributeCombinations(attributeStock)
    {
        var validAttributeCombinationList, validAttributeCombination = {}, optionArr, optionId, optionValueId;
        $.each(attributeStock, function (key, attributeCombination) {
            validAttributeCombinationList = attributeCombination.split(',');
            $.each(validAttributeCombinationList, function (key, value) {
                optionArr = value.split('-');
                optionId = optionArr[0];
                optionValueId = optionArr[1];
                if (!validAttributeCombination[optionId]) {
                    validAttributeCombination[optionId] = [];
                }
                validAttributeCombination[optionId].push(optionValueId);
            });
        });
        return validAttributeCombination;
    }

    //find first valid attribute combination order in attributeStock list
    function findFirstValidAttributeCombination(validAttributeCombination, optionIds, selectedOptionId = false)
    {
        var possibleCombination = [], possibleCombinationsBuffer = [], selectedOptionIdValue;
        if (selectedOptionId != false) {
            selectedOptionIdValue = $('#select_id_' + selectedOptionId).val();
        }
        $.each(optionIds, function (optionId, optionValues) {
            if (optionValues) {
                $.each(optionValues, function (key, optionValueId) {
                    possibleCombination = [];
                    if (optionValueId != 0 && ((selectedOptionId == false) || (selectedOptionId != false && optionValueId == selectedOptionIdValue))) {
                        //find possible combinations for option id
                        $.each(validAttributeCombination[optionId], function (attributeCombinationOrder, combinationOptionValueId) {
                            if (optionValueId == combinationOptionValueId) {
                                possibleCombination.push(attributeCombinationOrder);
                            }
                        });

                        //collect intersect of possible combinations of different option id`s (attributes) in buffer
                        if (possibleCombinationsBuffer.length) {
                            possibleCombination = possibleCombinationsBuffer.filter(x => possibleCombination.includes(x));
                        }

                        //if exist combination then break
                        if (possibleCombination.length) {
                            possibleCombinationsBuffer = possibleCombination;
                            if (possibleCombinationsBuffer.length) {
                                return false;
                            }
                        }
                    }
                });
            }
        });
        return possibleCombinationsBuffer;
    }

    //choose valid attribute combination
    function chooseAttributeCombination(attributeStock, possibleCombinationsBuffer)
    {
        // console.log('active');
        // console.log(attributeStock[possibleCombinationsBuffer[0]]);

        var firstValidAttributeCombinationList, optionArr, $element, optionId, optionValueId;
        if (possibleCombinationsBuffer[0] != undefined && attributeStock[possibleCombinationsBuffer[0]].length) {
            firstValidAttributeCombinationList = attributeStock[possibleCombinationsBuffer[0]].split(',');
            $.each(firstValidAttributeCombinationList, function (key, value) {
                optionArr = value.split('-');
                optionId = optionArr[0];
                optionValueId = optionArr[1];

                $element = $('.color_attributes-item:has([name="' + optionId + '"][value!="0"])');
                if ($element.length > 0) {
                    $element.removeClass('active');
                }

                if (optionValueId) {
                    //all attribute types
                    $('[name="id[' + optionId + ']"] [value="' + optionValueId + '"]').prop('selected', true);

                    //attribute type image
                    $element = $('.color_attributes-item [name="' + optionId + '"][value="' + optionValueId + '"]').prop('checked', true);
                    if ($element.length > 0) {
                        $element.prop('checked', true);
                    }

                    //attribute type radio
                    $element = $('.prod_options_radio input[type="radio"][name="' + optionId + '"][value="' + optionValueId + '"]');
                    if ($element.length > 0) {
                        $element.prop('checked', true);
                    }

                    //display images by image type attribute
                    $element = $('.color_attributes.attributes_type_color [name="' + optionId + '"][value="' + optionValueId + '"]');
                    if ($element.length > 0) {
                        displayAttributesImages(optionId, optionValueId);
                    }

                    //attribute type select
                    $element = $('#select_id_' + optionId + '.select_id_option');
                    if ($element.hasClass('selectized') && $element[0].selectize) {
                        $element[0].selectize.setValue(optionValueId);
                    }
                }
            });
        }
    }

    //calc current excluded combinations of attribute`s values
    function calcExcludedCombinations(validAttributeCombination, optionIds)
    {
        var excludedCombination = [];
        $.each(optionIds, function (currentoptionId, currentoptionValueId) {
            if (currentoptionValueId && currentoptionValueId > 0) {
                $.each(validAttributeCombination[currentoptionId], function (attributeCombinationOrder, optionValueId) {
                    if (optionValueId != currentoptionValueId) {
                        $.each(validAttributeCombination, function (optionId) {
                            if (!excludedCombination[optionId]) {
                                excludedCombination[optionId] = [];
                            }
                            if (!excludedCombination[optionId][attributeCombinationOrder]) {
                                excludedCombination[optionId][attributeCombinationOrder] = 0;
                            }
                            excludedCombination[optionId][attributeCombinationOrder] += 1;
                        });
                    }
                });
            }
        });
        return excludedCombination;
    }

    //calc possibly valid combinations of attribute`s values (with one missing any attribute)
    function calcPossiblyValidAttributeCombinations(validAttributeCombination, excludedCombination, optionIds)
    {
        $.each(excludedCombination, function (optionId, attributeCombinationArray) {
            $.each(attributeCombinationArray, function (attributeCombinationOrder, countOfExcluded) {
                if (countOfExcluded && (countOfExcluded > 1 || optionIds[optionId] == 0)) {
                    validAttributeCombination[optionId][attributeCombinationOrder] = null;
                }
            });
        });
        return validAttributeCombination;
    }

    //refresh selectize`s options
    function initialRefreshSelectizesOptions()
    {
        var $element, selectElementOptionId, elementSelectize, $optionElement;
        $('.attr_select [id^="select_id_"].select_id_option').each(function () {
            $element = $(this);
            selectElementOptionId = $element.attr('id').replace('select_id_', '');

            elementSelectize = this.selectize;
            if (elementSelectize) {
                elementSelectize.options[0]['disabled'] = true;
                elementSelectize.renderCache = {};
                if (elementSelectize.$dropdown_content.html().length == 0) {
                    elementSelectize.refreshOptions(false);
                }
            }
        });

    }

    //disable all attribute`s values
    function disableAllAttributesValues()
    {
        var selectElementOptionId, elementSelectize, element, $element;
        $('.attr_select [id^="select_id_"].select_id_option').each(function () {
            $element = $(this);
            selectElementOptionId = $element.attr('id').replace('select_id_', '');

            $element.find('option').addClass('disabled-filter-value');

            //attribute type select
            if ($element.length > 0 && $element.hasClass('select_attr_select')) {
                elementSelectize = this.selectize;
                if (elementSelectize) {
                    $.each(elementSelectize.options, function (optionValueId) {
                        if (optionValueId != 0) {
                            element = elementSelectize.$dropdown.find('[data-value="' + optionValueId + '"]')
                            if (element.hasClass('active')) {
                                element.removeClass('active');
                            }
                            element.addClass('disabled-filter');
                            // elementSelectize.options[optionValueId]['disabled'] = true;
                        }
                    });
                }
            }

            //attribute type image
            $element = $('.color_attributes-item:has([name="' + selectElementOptionId + '"][value!="0"])');
            if ($element.length > 0) {
                $element.removeClass('active');
                $element.addClass('disabled-filter');
            }

            //attribute type radio
            $element = $('.prod_options_radio [name="' + selectElementOptionId + '"]+label');
            if ($element.length > 0) {
                $element.removeClass('active');
                $element.addClass('disabled-filter');
            }

        });
    }

    function enableActiveAttributesValues(optionIds)
    {
        var $element;
        $.each(optionIds, function (optionId, optionValueId) {
            if (optionId && optionValueId) {
                //attribute type image
                $element = $('.color_attributes-item:has([name="' + optionId + '"][value="' + optionValueId + '"])');
                if ($element.length > 0) {
                    $element.addClass('active');
                }

                //attribute type radio
                $element = $('.prod_options_radio:has([name="' + optionId + '"]) label[for="option' + optionValueId + '"]');
                if ($element.length > 0) {
                    $element.addClass('active');
                }
            }
        });
    }

    //enable valid attribute`s values
    function enableValidAttributesValues(validAttributeCombination)
    {
        var optionId = '', optionValueId = '', optionIds = [];
        $('.attr_select [name="option_name"]').each(function () {
            optionId = $(this).val();
            // optionValueId = $('[name='+optionId+']:checked').val() || $('#select_id_'+optionId).val();
            optionValueId = $('[name="id[' + optionId + ']"]').val();
            optionIds[optionId] = optionValueId;
        });

        var $element, element, elementSelectize, selectElementOptionId;
        $.each(validAttributeCombination, function (currentoptionId, currentoptionValuesArray) {
            element = $('#select_id_' + currentoptionId)[0];
            $element = $(element);
            //element exist
            if ($element.attr('id')) {
                selectElementOptionId = $element.attr('id').replace('select_id_', '');

                //attribute type select
                if ($element.length > 0 && $element.hasClass('select_attr_select')) {
                    elementSelectize = element.selectize;
                    if (elementSelectize) {
                        $.each(currentoptionValuesArray, function (attributeCombinationOrder, currentoptionValueId) {
                            if (currentoptionValueId) {
                                elementSelectize.$dropdown.find('[data-value="' + currentoptionValueId + '"]').removeClass('disabled-filter');
                                // elementSelectize.options[currentoptionValueId]['disabled'] = false;
                            }
                        });
                    }
                }

                //attribute type image
                $element = $('.color_attributes-item:has([name="' + selectElementOptionId + '"])');
                if ($element.length > 0) {
                    $.each(currentoptionValuesArray, function (attributeCombinationOrder, currentOptionValueId) {
                        if (currentOptionValueId) {
                            $('.select_id_option[name="id[' + selectElementOptionId + ']"] option[value="' + currentOptionValueId + '"]').removeClass('disabled-filter-value');
                            $('.color_attributes-item:has([name="' + selectElementOptionId + '"][value="' + currentOptionValueId + '"])').removeClass('disabled-filter');
                        }
                    });
                }

                //attribute type radio
                $element = $('.prod_options_radio:has([name="' + selectElementOptionId + '"])');
                if ($element.length > 0) {
                    $.each(currentoptionValuesArray, function (attributeCombinationOrder, currentoptionValueId) {
                        if (currentoptionValueId) {
                            $('.select_id_option[name="id[' + selectElementOptionId + ']"] option[value="' + currentoptionValueId + '"]').removeClass('disabled-filter-value');
                            $('.prod_options_radio:has([name="' + selectElementOptionId + '"]) label[for="option' + currentoptionValueId + '"]').removeClass('disabled-filter');
                        }
                    });
                }
            }
        });
    }

    //display vendor code
    function displayAttributeVendorCode(attr)
    {
        if (typeof attributeStockVendorCode != "undefined" && attributeStockVendorCode) {
            if (Object.values(attributeStockVendorCode).length && attributeStockVendorCode[attr]) {
                $('.art_card_product').html(attributeStockVendorCode[attr]);
                $('input[name=extra_sku]').val(attributeStockVendorCode[attr]);
            } else {
                $('.art_card_product').html('');
                $('input[name=extra_sku]').val('');
            }
        }
    }

    //display attribute combination list
    function displayAttributeCombinationList(optionIds)
    {

        //select all attribute`s texts to optionValueIds
        var $this, optionValueTexts = [], optionId = '';
        $('.attr_select [name="option_name"]').each(function () {
            optionId = $(this).val();
            if (optionIds[optionId] > 0) {
                //attribute type select
                $('#select_id_' + optionId + ' option').each(function () {
                    $this = $(this);
                    if (optionIds[optionId] == $this.val()) {
                        optionValueTexts.push($this.html());
                    }
                });
            }
        });

        //glue attribute combination text to list
        var attributeCombinationTextList = Object.keys(optionValueTexts).map(function (x) {
            return optionValueTexts[x];
        }).join(', ');

        $('.attribute_combination_text_list').html(attributeCombinationTextList);
    }

    //enable form elements that may run submit form
    if (formElements) {
        for (var tagIndex = 0; tagIndex < formElements.length; tagIndex++) {
            for (var elementIndex = 0; elementIndex < formElements[tagIndex].length; elementIndex++) {
                formElements[tagIndex][elementIndex].removeAttribute('disabled');
            }
        }
    }

    $('.input-type-number-custom').on('keyup focus', (event) => {
        let select = $(event.currentTarget);
        select.val(select.val().replace(/[^0-9]/gi, ''));
    });


    $(".product-carousel-video").click(function (e) {
        this.pause();
    });
    $(document).on('input', 'form[name="create_account"] input[type="text"]', function () {
        $(this).val($(this).val().replace(/(<([^>]+)>)/ig, "")); //striptags
    });
    //lazyload
    $(".lazyload").lazyload();//.addClass('anim');
    //$(".product img").unveil();
    //$(".product_list img").unveil();
    setTimeout(function () {
        if (typeof $.fn.unveil != 'undefined') {
            $(".row_catalog_products .owl-item.active img").unveil(100, addAnimClassToImg);//for active slider elements
            $(".row_catalog_products .not-slider img").unveil(100, addAnimClassToImg);//for no slider elements
            $("#sidebar-left .row_catalog_products img").unveil(100, addAnimClassToImg); // show images in left colunm
        }
    }, 5);

    $('#loadMoreProducts').click(function () {
        loadMoreProducts();
    });
    $(document).on('click', '.ch_link', function (event) {
        hs.expand(this);
        return false;
    });
    $('.container_top_header .buy_one_click').click(function (event) {
        doHookie('callback');
        document.getElementById('callback').setAttribute('data-callback', 'true');
    });
    $('.prod_buy_btns .buy_one_click').click(function (event) {
        doHookie('fast_buy');
    });
    $('.buy_one_click').click(function (event) {
        var $modal = null;
        $.post('./ajax.php', {
            request: 'getBuyOnClickForm'
        }, function (data) {
            modal({
                id: 'QuickBuy',
                body: data.html,
                render: true,
                after: function (modal) {
                    $modal = modal;

                }
            });

            $('#QuickBuyForm').on('submit', function (event) {
                event.preventDefault();
                var $data = $('#QuickBuyForm,#products_id').serialize();
                var callback = $('.container_top_header .buy_one_click').attr('data-callback');
                if (callback) {
                    $data += '&callback=' + callback;
                }
                $data += '&prod_price_uah=' + $('.productSpecialPrice').text();
                $data += '&model=' + $('.art_card_product').text();
                $.post('./ajax.php', $data, function (data, textStatus, xhr) {
                    if (data.success) {
                        doHookie('fast_buy_success');
                    }
                    $('#QuickBuyForm').html(data.message);
                }, 'json');
            });

        }, 'json');
        return false;
    });

    $(document).on('click', '.sidebar-toggle-back, .sidebar_fader', function (event) {
        event.stopPropagation();
        var $button = jQuery('.sidebar-toggle-back');
        // $('.sidebar_fader').fadeOut(300);
        $('.sidebar_fader').removeClass('open');
        jQuery('#sidebar-left').toggleClass('opened');
        $button.removeClass('visible-xs').removeClass('visible-sm');
        $button.addClass('hidden-xs').addClass('hidden-sm');
        jQuery('#sidebar-left').unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd");

    });
    $(document).on('click', '.sidebar-toggle-up', function (event) {
        event.stopPropagation();
        var $button = $('.sidebar-toggle-back');
        // $('.sidebar_fader').fadeIn(300);
        $('.sidebar_fader').addClass('open');
        jQuery('#sidebar-left').toggleClass('opened');
        jQuery('#sidebar-left').on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function () {
            $button.removeClass('hidden-xs').removeClass('hidden-sm');
            $button.addClass('visible-xs').addClass('visible-sm');
        });

    });

    // when click on "reviews" it opens for us "reviews" tab
    $(document).on('click', '.quantity_rating', function (e) {
        e.preventDefault();
        $('.nav-tabs a[href="#tab-comments"]').tab('show');
    });

    // show share popup windows
    $('.share_with_friends a, .social_group_footer a, .social_buttons a').click(function (e) {
        e.preventDefault();
        showLoginvk($(this).attr('href'));
    });

    $('.nav-tabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show')
    });


    $('#cat_accordion').cutomAccordion({
        classExpand: "custom_id" + $('input[name=current_hidden_cat_id]').val(),
        menuClose: false,
        autoClose: true,
        saveState: false,
        disableLink: false,
        autoExpand: true
    });
    $('#left_cat_accordion').cutomAccordion({
        classExpand: "custom_id" + $('input[name=current_hidden_cat_id]').val(),
        menuClose: false,
        autoClose: false,
        saveState: false,
        disableLink: false,
        autoExpand: true
    });

    /*
     $(document).on("shown.bs.collapse shown.bs.tab", ".panel-collapse, a[data-toggle='tab']", function(e) {
     var $elOffset_top = $(e.target).parent('.panel').offset().top;
     jQuery('body,html').stop(false, false).animate({
     scrollTop: $elOffset_top
     }, {
     duration: 600,
     easing: 'swing'
     }, 800);
     });
     */

    if ($(window).width() > '768') {
        $('.categories_menu ul').superfish();
    }

    jQuery('#slider_product a').click(function (e) {
        if (jQuery(this).is('.active')) {
            e.preventDefault();
            return false;
        } else {
            jQuery('#slider_product a').removeClass('active');
            jQuery(this).addClass('active');
        }
    });

    if (typeof $.fn.owlCarousel != 'undefined') {
        $("#sync1, #sync1_1").owlCarousel({
            items: 1,
            loop: true,
            dots: true,
            slideSpeed: 200,
            nav: true,
            navText: ['<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"></path></svg>', '<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg>'],
            dotsContainer: '#sync2',
            responsiveRefreshRate: 200,
            onTranslated: function () {
                var images = this.$element.find('.lazyload');
                if (images.length) {
                    this.$element.find('.lazyload').lazyload();
                }
            }
        });
    }

    /*$("#owl-frontslider").owlCarousel({
        items: 1,
        nav: true,
        lazyLoad: true,
        loop:true,
        video:true,
        navText:['<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"></path></svg>','<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg>'],
        autoplay:true,
        autoplayTimeout:5000,
        dotsContainer: '#carousel-custom-dots',
        autoplayHoverPause:true,
        smartSpeed: 2000,
        onInitialized:function () {$(".owl-carousel, .single_slide").removeAttr('style');$(".active .owl-video-play-icon").trigger("click");}, // autoplay video on slider load
        onTranslated:function () {$(".active .owl-video-play-icon").trigger("click");} // autoplay video on change slide

    });*/
    // custom dots:
    if (typeof $.fn.owlCarousel != 'undefined') {
        $("#manufacturers > div").owlCarousel({
            items: window.manufacturersCarouselCols ? window.manufacturersCarouselCols : 4,
            itemsDesktop: window.manufacturersCarouselCols ? window.manufacturersCarouselCols : 4,
            itemsDesktopSmall: window.manufacturersCarouselCols ? window.manufacturersCarouselCols : 4,
            itemsTablet: window.manufacturersCarouselCols ? window.manufacturersCarouselCols : 4,
            itemsMobile: window.manufacturersCarouselCols ? window.manufacturersCarouselCols : 4,
            nav: true,
            dots: false,
            loop: true,
            navText: ['<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"></path></svg>', '<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg>'],
            slideSpeed: 200,
        });
    }
    if (typeof $.fn.unveil != 'undefined') {
        $("#manufacturers > div img").unveil(100, addAnimClassToImg);
    }
    $('.owl-carousel img').lazyload();
    /* ---------  END Additional images --------- */

    /* ---------  Shopping cart --------- */
    jQuery('body').on('submit', 'form[name="cart_quantity"], form[name="modal_cart_quantity"]', function (event) {
        event.preventDefault();
        doAddProduct(this);
    });

    // jQuery('body').on('submit', 'form[name="modal_cart_quantity"]', function(event) {
    //     event.preventDefault();
    //     $.post('./popup_cart.php?action=update_product', {'products_id[]':jQuery(this).find('[name="products_id"]').val(),'cart_quantity[]':jQuery(this).find('#modal_qty_input').val()}, function(response) {
    //         showPopupResponse(response)
    //     })
    // });

    // add to cart in product listing
    jQuery('body').on('click', '.add2cart', function (event) {
        var $this = $(this);
        var product = $this.closest('.product');
        if (product.length && product.hasClass('has_attributes')) {
            var product_href = product.find(".p_img_href").attr('href');
            if (typeof product_href != 'undefined' && product_href != '') {
                window.location.href = product_href;
            }
        } else {
            doAddProductList($this);
        }
    });

    jQuery('body').on('click', '#checkoutButton', function (event) {
        event.preventDefault();
        var href = jQuery(this).attr('href');
        jQuery("#popup_cart_form").ajaxSubmit({
            // target: '#modal_cart_popup .modal-body',
            success: function () {
                showPopupResponse();
                window.location.href = href;
            }
        });
        /*var options={target:'#modal_cart_popup .modal-body', detailhref:href};
         ajaxSubmitSerializePopup (options);*/
    });
    jQuery('body').on('focus', 'input[name="cart_quantity[]"]', function (event) {
        $(this).parent().next('.ok').fadeIn();
    });
    jQuery('body').on('change input', '#popup_cart_form [name="cart_quantity[]"]', function (event) {
        jQuery("#popup_cart_form").ajaxSubmit({
            // target: '#modal_cart_popup .modal-body',
            success: showPopupResponse
        });
        var inputNumber = jQuery(this).siblings('.input-group').find('.inputnumber');
        inputNumber.val(Math.round(inputNumber.val()));
        var btnOk = $('#cartContent-page .btn.ok');
        for (var i = 0; i < btnOk.length; i++) {
            btnOk[i].style.display = 'none';
        }
        //var options={target:'#modal_cart_popup .modal-body'};
        //ajaxSubmitSerializePopup (options);
    });

    //by Demo2
    jQuery(document).on('shown.bs.dropdown', '#divShoppingCard', function (event) {
        event.preventDefault();
        $.get('./popup_cart.php', null, function (response) {
            $('#new_basked_block').html(response);
        });
    });
    //by Demo2
    jQuery(document).on('change', '#new_basked_block input[name="cart_quantity[]"]', function (event) {
        jQuery("#popup_cart_form").ajaxSubmit({
            target: '#new_basked_block',
            success: function () {
                $.post('./ajax_update_cart.php', '', function (data) {
                    $('.quantity_basket,.mobile_cart_count').html(data.cart_count);
                    $.get('./popup_cart.php', null, function (response) {
                        $('#new_basked_block').html(response);
                    });
                }, 'json');
            }
        });
    });

    jQuery('body').on('click', '#popup_cart_form .delete', function (event) {
        //jQuery("#cart_delete" + jQuery(this).val()).attr('checked', 'checked');
        $(this).parent().find($('input[name="cart_delete[]"]')).attr('checked', 'checked');
        if (jQuery("#popup_cart_form .delete").length == 1) { // if there is only one element, hide other element in shopping cart
            jQuery("#popup_cart_form").animate({
                opacity: 0
            }, 200, function () {
                // fadeout of deleted element
                jQuery("#modal_cart_popup .modal-body").animate({
                    height: jQuery("#modal_cart_popup .modal-body").height() - 163
                }, 200, function () {
                    jQuery("#popup_cart_form").ajaxSubmit({
                        target: '#modal_cart_popup .modal-body',
                        success: showPopupResponse
                    }); // submit form
                    //var options={target:'#modal_cart_popup .modal-body'};
                    //ajaxSubmitSerializePopup (options);
                });
            });
        } else {
            var skipTemplates = [
                'gadgetorio',
                'solo_cellphones',
                'solo_health'
            ];
            jQuery('#popup_cart_form .delete').attr('disabled', true);
            jQuery(this).parent().parent().parent().parent().slideUp(200, function () {
                // fadeout of deleted element
                if (jQuery.inArray(TEMPLATE_NAME, skipTemplates) != -1) {
                    jQuery("#popup_cart_form").ajaxSubmit({
                        target: '#modal_cart_popup .modal-body',
                        success: showPopupResponse
                    }); // submit form
                } else {
                    jQuery("#popup_cart_form").ajaxSubmit({
                        // target: '#modal_cart_popup .modal-body',
                        success: showPopupResponse
                    }); // submit form
                    jQuery(this).remove();
                }
                //var options={target:'#modal_cart_popup .modal-body'};
                //ajaxSubmitSerializePopup (options);
            });
        }
        var _vall = $(this).attr('data-clearpid');

        $('.added2cart[data-id=' + _vall + ']').replaceWith(sprintf(RTPL_ADD_TO_CART_BUTTON, _vall));
        $("#r_buy_intovar[data-id=" + _vall + "]").html(RTPL_ADD_TO_CART_BUTTON_PRODUCT_PAGE); // replace button in product info page.

    });

    /* ---------  Shopping cart --------- */

    /* ---------  Subscribe --------- */
    jQuery(document).on('submit', '.form_subscribe_news', function (event) {
        event.preventDefault();
        doHookie('subscribe');
        var this_form = $(this);

        $.post($(this).attr('action'), $(this).serialize(), function (response) {
            this_form.trigger("reset"); // обнуляем поля
            modal({
                id: 'subscribe',
                body: response.message,
                render: true,
                after: function (modal) {
                    setTimeout(function () {
                        modal.modal('hide');
                    }, 3500);
                }
            });
        }, 'json');
        /* Act on the event */
    });

    /* ---------  Popups --------- */
    jQuery(document).on('submit', '[name="contact_us"]', function (event) {
        event.preventDefault();
        doHookie('contact_us');
        var this_form = $(this);
        // Sending email
        $.post($(this).attr('action'), $(this).serialize(), function (response) {
            $('[name="_csrf"]').val(response.csrf);
            if (response.status != 'fail') {
                this_form.trigger("reset");
                if (typeof grecaptcha === 'object') {
                    grecaptcha.reset();
                }
            } // reset all fields
            modal({
                id: 'ContactUs',
                body: response.msg,
                render: true,
                after: function (modal) {
                    /*   setTimeout(function() {
                           modal.modal('hide');
                       }, 3500);  */
                }
            });
        }, 'json');
        /* Act on the event */
    });


    jQuery('body').on('click touchstart', '.popup_cart', function (event) {
        event.preventDefault();
        if ($('[data-dismiss="modal"]')) {
            $('[data-dismiss="modal"]').click();
            setTimeout(function () {
                showCartpopup();
            }, 300);
        } else {
            showCartpopup();
        }
    });
    jQuery('body').on('click', '.article-alert .close', function (event) {
        event.preventDefault();
        setCookie('article_alert_showed', '1', 1);
    });

    jQuery('.call_us_btn').click(function (e) {
        e.preventDefault();
        pop_contact_us();
    });

    $('#user-login-dropdown .dropdown-menu').on('click', function (event) {
        event.stopPropagation();
    });

    /* --------- End Popups --------- */

    $(document).ready(function () {

        if ($(window).width() > 768) {
            $('[data-toggle="tooltip"]').tooltip({
                container: 'body'
            });
        }

        jQuery('body').on('click', '.show_search_form', function () {
            openSearchForm();

            $('.close-mobile-search').toggleClass('d-none');
            $('.open-mobile-search').toggleClass('d-none')
        });

        $(document).on('click', '#search-form-button-close, #search-form-button-close1', function () {
            closeSearchForm();
        });

        $(document).on('click', '#search-form-fader', function () {
            closeSearchForm();
        });


        $(window).on("scroll", function () {
            // adding shadow to header when scrolling
            var stickyPosition = Math.abs(parseInt($('header').css('top'), 10));

            if ($(this).scrollTop() > stickyPosition) {
                $('header').addClass('header_shadow');

            } else {
                $('header').removeClass('header_shadow');
            }
        });

        $('.hover .dropdown-menu').on("click", function (e) {
            e.stopPropagation();
            // e.preventDefault();
        });

        if ($(window).width() >= 992) {
            $("#user-login-dropdown")
                // on #user-login-dropdown hovered
                .mouseenter(function () {
                    // opens dropdown on hover
                    // $(this).addClass('open');
                })
                // on #user-login-dropdown unhovered
                .mouseleave(function () {
                    // closes dropdown on hover
                    // $(this).removeClass('open');
                });


            $(".dropdown-hover")
                // on #header-megamenu hovered
                .mouseenter(function () {
                    // opens dropdown on hover
                    $(this).addClass('open');
                })
                // on #header-megamenu unhovered
                .mouseleave(function () {
                    // closes dropdown on hover
                    $(this).removeClass('open');
                });
        }

        $(".dropdown-submenu a.submenu")
            // hover on button to open submenu
            .mouseenter(function () {
                var headerHeight = Math.abs(parseInt($('header').css('height'), 10));
                var menuHeight = Math.abs(parseInt($('.add_nav').css('height'), 10));

                // if submenu exists add class .hover for visible effect
                $(this).parent('li').addClass('hover');

                // when scrolling with opened .submenu
                $(window).on("scroll", function () {
                    var windowsScrolled = $(this).scrollTop();

                    // if scrolled less than 164px from top, then change top: value for .dropdown-menu inside .submenu
                    if ($(this).scrollTop() < 164) {
                        $('li.hover .dropdown-menu').css({
                            'top': headerHeight - windowsScrolled + 'px'
                        });
                        // else set top: value 51px for .dropdown-menu inside .submenu
                    } else {
                        $('li.hover .dropdown-menu').css({
                            'top': '51px'
                        });
                    }
                });
            })

            // leave mouse from button (that opens submenu) to any direction
            .mouseleave(function () {
                $('.dropdown-submenu')
                    // hover mouse on .submenu
                    .mouseenter(function () {
                        // removes class .hover when left not to parent button
                        $(this).siblings('li.hover').removeClass('hover');
                    });
            });


        // delete in two weeks (22.02.19)
        // $(".dropdown-submenu a.submenu")
        // // hover on button to open submenu
        //     .mouseenter(function() {
        //         var headerHeight = Math.abs(parseInt($('header').css('height'), 10));
        //         var menuHeight = Math.abs(parseInt($('.add_nav').css('height'), 10));
        //
        //         // if submenu exists add class .hover for visible effect
        //         // $(this).parent('li').addClass('hover');
        //
        //         // getting padding-left: of bootstrap class .container
        //         var pageContainerPaddingLeft =  Math.abs(parseInt($('.container').css('padding-left'), 10));
        //
        //         // getting margin-left: of bootstrap class .container
        //         var pageContainerMarginLeft =  Math.abs(parseInt($('.container').css('margin-left'), 10));
        //
        //         // getting width: of .dropdown-menu when opened
        //         var menuWidth = Math.abs(parseInt($('.dropdown .dropdown-menu').css('width'), 10));
        //
        //         // summing padding-left: (.container), margin left (.container) and .dropdown-menu width
        //         var dropDownMenuLeft = menuWidth+pageContainerMarginLeft+pageContainerPaddingLeft-1;
        //
        //         $(this).siblings('.dropdown-menu').css('left', dropDownMenuLeft+'px');
        //
        //         if ($(window).scrollTop() >= 164) {
        //             $(this).siblings('.dropdown-menu').css('top', '51px');
        //         } else {
        //             $(this).siblings('.dropdown-menu').css('top', headerHeight+'px');
        //         }
        //
        //         // when scrolling with opened .submenu
        //         $(window).on("scroll", function() {
        //             var windowsScrolled = $(this).scrollTop();
        //
        //             // if scrolled less than 164px from top, then change top: value for .dropdown-menu inside .submenu
        //             if ($(this).scrollTop() < 164) {
        //                 $('li.hover .dropdown-menu').css({
        //                     'top': headerHeight-windowsScrolled+'px'
        //                 });
        //                 // else set top: value 51px for .dropdown-menu inside .submenu
        //             } else {
        //                 $('li.hover .dropdown-menu').css({
        //                     'top': '51px'
        //                 });
        //             }
        //         });
        //     })
        //
        //     // leave mouse from button (that opens submenu) to any direction
        //     .mouseleave(function() {
        //         $('.dropdown-submenu')
        //         // hover mouse on .submenu
        //             .mouseenter(function() {
        //                 // removes class .hover when left not to parent button
        //                 $(this).siblings('li.hover').removeClass('hover');
        //             });
        //     });

    });

    $('#pdf_block span.btn-link').click(function () {
        window.open($(this).data('href'));
        return false;
    });


    /* ---------   attr_select --------- */
    // refresh cart`s key of product with attributes on product page
    function refreshCartKey(optionKey, optionValue)
    {
        var form = $('form[name="cart_quantity"]').length ? $('form[name="cart_quantity"]') : $('form[name="modal_cart_quantity"]'),
            optionKeyToVal = form.data('cart-key').toString().split('{');
        for (var i = 0; i < optionKeyToVal.length; i++) {
            if (optionKeyToVal[i].indexOf(optionKey + '}') === 0) {
                optionKeyToVal[i] = optionKey + '}' + optionValue;
            }
        }
        var newCartKey = optionKeyToVal.join('{');
        form.data('cart-key', newCartKey);
        // console.log(form.data('cart-key'));  //cart key what will be taken when click button "add to cart"
        productInCart(newCartKey);
    }

    function updateAttribute(element)
    {
        var activeOptionMap = [];
        var elementTag = element[0];
        if (element.hasClass('select_attr_img')) {
            var selected_op = $('.select_id_option [value="' + element.val() + '"]')[0];
        } else {
            var selectizeLoc = elementTag.selectize;
            var selected_op = selectizeLoc.$input[0].selectedOptions[0];
            selected_op.setAttribute("data-prefix", selectizeLoc.options[selected_op.value].prefix);
        }
        var attributeKey = element.attr('id').replace('select_id_', ''),
            attributeValue = $(selected_op).val();

        refreshCartKey(attributeKey, attributeValue);

        if ($('.art_card_product')) {
            if (typeof attributeStockVendorCode == "undefined" || !attributeStockVendorCode) {
                //collect vendor code
                activeOptionMap[attributeKey] = attributeValue;
                if (attributeValue == 0) {
                    delete activeOptionMap[attributeKey];
                }
                var article;
                var attributeArticlesList = Object.keys(activeOptionMap).map(function (x) {
                    article = $('#id_option_other' + activeOptionMap[x]).data('article');
                    return article ? article + ', ' : '';
                }).join('').replace(new RegExp(', ' + '$'), '');
                //display vendor code
                if (attributeArticlesList) {
                    $('.art_card_product').html(attributeArticlesList);
                } else {
                    if (typeof defaultVendorCode != "undefined" && defaultVendorCode) {
                        $('.art_card_product').html(defaultVendorCode);
                    }
                }
            }
        }

        calculate_sum($(selected_op));
    }

    //update data on attribute change (and "dropdown" click)
    $(document).on('change', '.select_id_option', function (e) {
        updateAttribute($(this));
    });

    //"radio" click trigger change of attribute
    $(document).on('click', '.prod_options_radio label', function (e) {
        var attribute = $('#' + $(this).attr('for'));
        $('#select_id_' + attribute.attr('name'))[0].selectize.setValue(attribute.val());
    });

    //"color" click trigger change of attribute
    $(document).on('click', '.color_attributes label input', function (e) {
        var $option = $(this).attr('value');
        var $name = $(this).attr('name');
        $('#select_id_' + $name).val($option).change();
    });

    //set initial sum and article
    var defaultVendorCode;
    $(document).ready(function () {
        if ($('.art_card_product')) {
            defaultVendorCode = $('.art_card_product').html();
            if($('.select_id_option:first').length > 0){
                updateAttribute($('.select_id_option:first'));
            }
        }
    });
    /* --------- end  attr_select --------- */

    /* --------- DEBUG --------- */
    if (jQuery('pre.debug').length) {
        jQuery('pre.debug').remove().insertBefore('body');
        jQuery('pre.debug').fadeIn(300).animate({
            top: '100px'
        }, "slow");
        jQuery('pre.debug').append('<span class="close">X</span>');
        jQuery('pre.debug .close').click(function () {
            jQuery(this).parent('.debug').remove();
        });
    }
    /* --------- /DEBUG --------- */


    // ACCORDION
    if (typeof accordion != 'undefined') {
        $('.accordion').accordion({
            heightStyle: 'content',
            header: 'h3',
            active: false,
            collapsible: true,
            autoHeight: false
        });
    }

    $(document).on('click', '.ajax_modal_article', function (e) {
        e.preventDefault();
        $.post('./ajax_modal_article.php', {article_id: $(this).attr('data-id')}, function (data) {
            modal({
                id: 'ajax_modal_article',
                title: data.articles_name,
                body: data.articles_description
            });
        }, 'json');
    });

    // making "Create Account" button active if "store rules" checked
    $('#shoprules').click(function (e) {
        var el = 'form[name=create_account] input[type=submit]';
        if ($(el).hasClass('active_submit')) {
            $(el).removeClass('active_submit');
        } else {
            $(el).addClass('active_submit');
        }
    });

    // SHOW/HIDE NAVIGATION WHEN WIDTH <= 768 PX
    $('.main_nav > ul').prepend('<li class="mobile"></li>');

    $('.toggle_nav').click(function (e) {
        if ($('.main_nav li').hasClass('mobile')) {
            e.preventDefault();
            $('.main_nav').toggleClass('expand');
        }
    });

    $('.main_nav li > a').click(function (e) {
        $('.main_nav li').removeClass('active_page');
        $(this).closest('li').addClass('active_page');
    });

    // TABS
    if (typeof tabs != 'undefined') {
        $('.tabs').tabs();
    }

    $('.nav-tabs').children('li:first-child').addClass('active');
    $('.tab-content').children('.tab-pane.fade:first-child').addClass('in active');

    /* --------- SELECTIZE --------- */

    $("select").not("select[name=billing_country], select[name=shipping_country], select[name=selectCountry], select[name=country], .select_attr_img, .select_attr_select").selectize({
        hideSelected: false,
        maxItems: 1,
    });

    $('select[name="currency"], select[name="row_by_page"], select#pl_sort').selectize({
        hideSelected: false,
        maxItems: 1
        // plugins: ['hidden_textfield']
    });

    $("select.select_attr_select").selectize({
        hideSelected: false,
        maxItems: 1,
        render: {
            option: function (item, escape) {
                if (item.disabled) {
                    return '<div class="option unselectable">' + escape(item.text) + '</div>';
                }
                return '<div class="option">' + escape(item.text) + '</div>';
            }
        }
    });

    $('select[name="selectCountry"], select[name=country], select[name="shipping_zone_id"]').selectize({
        hideSelected: false,
        maxItems: 1,
        highlight: true,
        onFocus: function () {
            this.clear();
        }

    });
    $('select[name="shipping_country"], select[name="billing_country"]').selectize({
        hideSelected: false,
        maxItems: 1,
        highlight: true,
        onDropdownOpen: function () {
            this.$input.closest('.form-group').find('.error_icon').css('display', 'none');
        },
        onFocus: function () {
            this.clear();
        }
    });
    /* --------- END SELECTIZE --------- */
    // Select option region
    $("select[name=selectCountry], select[name=country]").on('change', function () {

        var country = $(this);
        var default_region = country.attr('data-zone');
        var zone_field_name = '';
        var fieldForInsert = '';
        country.attr('data-zone', ''); // erase default zone for all other countries except default.

        if (country.attr('name') == 'selectCountry') {
            zone_field_name = 'selectRegion';
            fieldForInsert = $('.selectZone');
        } else if (country.attr('name') == 'country') {
            zone_field_name = 'zone_id';
            fieldForInsert = $('.selectZone');
        }

        $("select[name=" + country.attr('name') + "]+button span:last-of-type").html(country.children(':selected').text()); // change country selectize

        //  $("*[name="+zone_field_name+"]").remove();

        $.get("./ajax_select_region.php", {
            country_id: country.val(),
            'default_region': default_region,
            'zone_field_name': zone_field_name
        }, function (data) {

            if ($("*[name=" + zone_field_name + "]").length != 0) {
                $("*[name=" + zone_field_name + "]").closest('span').replaceWith(data);
            } else if (fieldForInsert.length != 0) {
                fieldForInsert.replaceWith(data);
            } else {
                country.parent().after(data);
            }

            if (typeof checkout !== 'undefined') {
                checkout.checkFields();
            }
            $("select[name=" + zone_field_name + "]").selectize({
                hideSelected: false,
                maxItems: 1,
                // placeholder:ENTER_KEY,
                highlight: true,
                onDropdownOpen: function () {
                    this.$input.closest('.form-group').find('.error_icon').css('display', 'none');
                },
                onFocus: function () {
                    this.clear();
                }
            });
        });
    });

    $('select[name=country]').change();
    $('select[name=selectCountry]').change();

    var options = {target: '#block', beforeSubmit: showRequest, success: showResponse};

    $('.vivod_columns button, .vivod_list button').on('click', function () {
        if ($("#" + $(this).attr("name") + "2").length != 0) {
            $("#" + $(this).attr("name") + "2").val($(this).val());
        }
        // if element ...2 already exists - delete it
        else {
            $("#m_srch").append("<input type=hidden name=" + $(this).attr("name") + " id=" + $(this).attr("name") + "2 value=" + $(this).val() + " />");
        } // create hidden element in form
        //$('#m_srch').ajaxSubmit(options);// submit form
        ajaxSubmitSerialize(options);

        // delete class "hover" for all buttons and add this class only for current element
        $(this).parent().parent().find('button').each(function () {
            $(this).removeClass('hover');
        });
        $(this).addClass('hover');
    });

    $("#pl_onpage").change(function () {
        if ($("#" + $(this).attr("name") + "2").length != 0) {
            $("#" + $(this).attr("name") + "2").remove();
        }
        $("#m_srch").append("<input type=hidden name=" + $(this).attr("name") + " id=" + $(this).attr("name") + "2 value=" + $(this).val() + " />");
        //$('#m_srch').ajaxSubmit(options);
        ajaxSubmitSerialize(options);
    });
    $("#pl_sort").change(function () {
        if ($("#" + $(this).attr("name") + "2").length != 0) {
            $("#" + $(this).attr("name") + "2").remove();
        }
        $("#m_srch").append("<input type=hidden name=" + $(this).attr("name") + " id=" + $(this).attr("name") + "2 value=" + $(this).val() + " />");
        //$('#m_srch').ajaxSubmit(options);
        ajaxSubmitSerialize(options);
    });
    $("input:radio[name=sort]").change(function () {
        if ($("#" + $(this).attr("name") + "2").length != 0) {
            $("#" + $(this).attr("name") + "2").remove();
        }
        $("#m_srch").append("<input type=hidden name=" + $(this).attr("name") + " id=" + $(this).attr("name") + "2 value=" + $(this).val() + " />");
        //$('#m_srch').ajaxSubmit(options);
        ajaxSubmitSerialize(options);
    });

    function changeColor(picker_field, color)
    {
        if (picker_field.data('configuration-key')) {
            var configurationCode = picker_field.data('configuration-key');
            var colorCode = color.toHexString();

            $.ajax({
                url: "/includes/modules/CustomizationPanel/index.php?action=changeColor",
                type: "POST",
                data: {colorCode: colorCode, configurationCode: configurationCode},
                dataType: 'json'
            });

        }
    }

    /*
     if($('input[name=displayajax]').val()=='true') {
     var options = {target: "#block",beforeSubmit: showRequest,success:showResponse};
     ajaxSubmitSerialize(options);
     }
     */

    // colorpicker on main page:

    // jQuery('body').on('click', '.custom_panel_block.visible .change_color', function(event) {
    //     event.preventDefault();
    //     var picker_field = $(this).find('.change_color-input');
    //
    //     $(this).ColorPicker({
    //         color: picker_field.val(),
    //         onChange: function (hsb, hex, rgb) {
    //             $(picker_field).val('#'+hex);
    //             $("body").get(0).style.setProperty("--"+picker_field.attr('data-color'), '#'+hex);
    //         }
    //     });
    //     $(this).click();
    // });
    if (IS_MOBILE == '1') {
        $(document).on('click', '.change_color', function () {
            var picker_field = $(this).find('.change_color-input'),
                spectrum_block = $(this).find('.spectrum_block');
            $(this).closest('.palette_li').find('.close_palette').addClass('visible');
            spectrum_block.spectrum({
                color: picker_field.val(),
                type: "color",
                showPaletteOnly: true,
                showPalette: true,
                hideAfterPaletteSelect: true,
                showAlpha: false,
                palette: [
                    ["#000", "#444", "#666", "#999", "#ccc", "#eee", "#f3f3f3", "#fff"],
                    ["#f00", "#f90", "#ff0", "#0f0", "#0ff", "#00f", "#90f", "#f0f"],
                    ["#f4cccc", "#fce5cd", "#fff2cc", "#d9ead3", "#d0e0e3", "#cfe2f3", "#d9d2e9", "#ead1dc"],
                    ["#ea9999", "#f9cb9c", "#ffe599", "#b6d7a8", "#a2c4c9", "#9fc5e8", "#b4a7d6", "#d5a6bd"],
                    ["#e06666", "#f6b26b", "#ffd966", "#93c47d", "#76a5af", "#6fa8dc", "#8e7cc3", "#c27ba0"],
                    ["#c00", "#e69138", "#f1c232", "#6aa84f", "#45818e", "#3d85c6", "#674ea7", "#a64d79"],
                    ["#900", "#b45f06", "#bf9000", "#38761d", "#134f5c", "#0b5394", "#351c75", "#741b47"]
                ],
                change: function (color) {
                    $("body").get(0).style.setProperty("--" + picker_field.attr('data-color'), color.toHexString());
                    picker_field.attr('value', color.toHexString());
                    changeColor(picker_field, color);
                },
            }).spectrum("show");
        });

        $(document).on('click', '.close_palette', function (e) {
            // e.stopPropagation();
            $('.sp-container').hide();
            $(this).removeClass('visible');
        });
    } else {
        $(document).on('click', '.change_color', function () {
            var picker_field = $(this).find('.change_color-input'),
                spectrum_block = $(this).find('.spectrum_block');

            spectrum_block.spectrum({
                color: picker_field.val(),
                type: "color",
                showPalette: false,
                togglePaletteOnly: true,
                hideAfterPaletteSelect: true,
                showAlpha: false,
                change: function (color) {
                    $("body").get(0).style.setProperty("--" + picker_field.attr('data-color'), color.toHexString());
                    picker_field.attr('value', color.toHexString());
                    changeColor(picker_field, color);
                },
                move: function (color) {
                    $("body").get(0).style.setProperty("--" + picker_field.attr('data-color'), color.toHexString());
                    picker_field.attr('value', color.toHexString());
                }
            }).spectrum("show");
        });

        //custom panel
        $(document).mouseup(function (e) {
            var collapse_block = $('.custom_panel_block .collapse_li, .sp-container');
            // console.log(collapse_block)
            if (!collapse_block.is(e.target) && collapse_block.has(e.target).length === 0) {
                collapse_block.find('.drop_menu.in').collapse('hide');
                if (typeof spectrum != 'undefined') {
                    $('.spectrum_block').spectrum("hide");
                }
                collapse_block.find('.collapse_btn').addClass('collapsed');
            }
        });
    }

    $(document).on('click', '.open_custom_panel_btn', function () {
        if ($('.custom_panel_block').hasClass('visible')) {
            $('.custom_panel_fader').removeClass('visible');
            $('.custom_panel_block .collapse_btn').addClass('collapsed');
            $('.custom_panel_block .drop_menu.in').collapse('hide');
            $('.custom_panel_block').removeClass('visible');
            $('.open_custom_panel_btn').addClass('anim');
        } else {
            $('.custom_panel_block').addClass('visible');
            $('.open_custom_panel_btn').removeClass('anim');
            setCookie('custom_panel_status', '1', 1);
        }
    });
    $(document).on('click', '.custom_panel_close', function () {
        $('.custom_panel_block').removeClass('visible');
        $('.custom_panel_fader').removeClass('visible');
        $('.custom_panel_block .collapse_btn').addClass('collapsed');
        $('.custom_panel_block .drop_menu.in').collapse('hide');
        $('.open_custom_panel_btn').addClass('anim');
        setCookie('custom_panel_status', '0', 1);
    });

    // if ($(window).width()>'991') {
    //     setTimeout(function() {
    //         $('.custom_panel_block').addClass('visible');
    //         $('.open_custom_panel_btn').removeClass('anim');
    //     }, 1500);
    // } else {
    //     $('.open_custom_panel_btn').addClass('anim');
    // }
    //end custom panel


    $(document).on('click', '.popupPrintReceipt', function (e) {
        e.preventDefault();
        window.open($(this).attr('href'), 'popupPrintReceipt', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=750');
    });

    var firstImage, srcImage;

    $(document).on({
        mouseenter: function () {
            srcImage = $(this).find('.p_img_href img');
            if (srcImage.is("[data-hover]")) {
                firstImage = srcImage.attr('src');

                srcImage.attr('src', srcImage.attr("data-hover"));
            } else {
                firstImage = '';
            }
        },
        mouseleave: function () {
            if (typeof srcImage === 'object' && srcImage.is("[data-hover]") && firstImage != '') {
                srcImage.attr('src', firstImage);
            }
        }
    }, '.product');

    $(document).on({
        mouseenter: function () {
            srcImage = $(this).find('.p_img_href img');
            if (srcImage.is("[data-hover]")) {
                firstImage = srcImage.attr('src');

                srcImage.attr('src', srcImage.attr("data-hover"));
            } else {
                firstImage = '';
            }
        },
        mouseleave: function () {
            if (typeof srcImage === 'object' && srcImage.is("[data-hover]") && firstImage != '') {
                srcImage.attr('src', firstImage);
            }
        }
    }, '.bt_product');

    $('.checkout_authorization, .enter_link').click(function (event) {
        $.post('./ajax.php', {
            request: 'getLoginForm'
        }, function (data) {
            modal({
                id: 'getLoginForm',
                body: data.html,
                render: true,
                width: 320,
            });

        }, 'json');
        return false;
    });

    //Open modal with bug report form, take a screenshot of page and (then) initialize listener of form submit
    $(document).on('click', '.bug_report', function (event) {
        //Open modal with bug report form
        doHookie('bug_report');
        $.post('./ru/ajax.php', {
            request: 'getBugReportForm'
        }, function (data) {
            modal({
                id: 'getBugReportForm',
                body: data.html,
                render: true,
            });
        }, 'json');
        //take a screenshot of page
        $('body').append("<script type='text/javascript' src='includes/javascript/html2canvas.min.js'></script>");
        var element = document.querySelector('html');
        html2canvas(element, {
            windowHeight: element.offsetHeight,
            windowWidth: element.offsetWidth
        }).then(canvas => {
            var img_base64 = canvas.toDataURL(),    //convert from canvas to base64 screenshot
                popup_btn = $('#BugReportForm .btn[type="submit"]'),
                load_circle = $('#BugReportForm img.btn-loader');
            //Prepare base64 screenshot to post (encode to the url-transported state)
            img_base64 = img_base64.split('+').join('.');
            img_base64 = img_base64.split('/').join('_');
            img_base64 = img_base64.split('=').join('-');
            //Show btn Send in modal
            popup_btn.removeClass('hidden');
            load_circle.addClass('hidden');
            $('#BugReportForm').data('screenshot', img_base64);

        });

        return false;
    });
    //submit form listener
    $(document).on('submit', '#BugReportForm', function (event) {
        event.preventDefault();
        var img_base64 = $(this).data('screenshot'),
            popup_btn = $('#BugReportForm .btn[type="submit"]'),
            load_circle = $('#BugReportForm img.btn-loader');
        //Hide btn Send in modal and show load circle
        popup_btn.addClass('hidden');
        load_circle.removeClass('hidden');
        //Post user`s text and screenshot of page to processing
        var data = $('#BugReportForm').serialize() + '&img_base64=' + img_base64;
        $.post('./ru/ajax.php', data, function (data, xhr) {
            //Show result of processing in modal
            if (data.success) {
                $('#BugReportForm').html(data.message);
            } else {
                alert('Send error!');
            }
        }, 'json');
    });
    //alert close button for header messages
    $(document).on('click', '.alert-danger-header .close', function () {
        $('.alert-danger-header').remove();
    });

    $(document).on('submit', 'form[name=add_set]', function (e) {
        e.preventDefault();
        var $this = $(this);
        var data = {};
        $this.serializeArray().map(function (arr) {
            data[arr.name] = arr.value;
        });
        $.ajax({url: $this.attr('action'), dataType: "json", data: data})
            .done(function (response) {
                updateCart();
                $('.popup_cart').click();
            })
    });
    $(document).on('click', '#tab-comments-anchor', function (e) {
        if (typeof includeRecaptchaFile == 'function') {
            includeRecaptchaFile();
        }
    });
});

//special price timer
var timer_id = '#timer';
if ($(timer_id).length) {
    var deadline = $(timer_id).data('expired');
    setClock(timer_id, deadline);
}

function setClock(selector, endtime)
{
    const timer = document.querySelector(selector),
        days = timer.querySelector('#days'),
        hours = timer.querySelector('#hours'),
        minutes = timer.querySelector('#minutes'),
        seconds = timer.querySelector('#seconds'),
        timeInterval = setInterval(updateClock, 1000);

    updateClock();

    function updateClock()
    {
        const t = getTimeRemaining(endtime);

        days.textContent = addZero(t.days);
        hours.textContent = addZero(t.hours);
        minutes.textContent = addZero(t.minutes);
        seconds.textContent = addZero(t.seconds);

        if (t.total <= 0) {
            days.textContent = '00';
            hours.textContent = '00';
            minutes.textContent = '00';
            seconds.textContent = '00';

            clearInterval(timeInterval);
        }

        function addZero(num)
        {
            if (num <= 9) {
                return '0' + num;
            } else {
                return num;
            }
        }

        function getTimeRemaining(endtime)
        {
            const t = Date.parse(endtime) - Date.parse(new Date()),
                seconds = Math.floor((t / 1000) % 60),
                minutes = Math.floor((t / 1000 / 60) % 60),
                hours = Math.floor((t / (1000 * 60 * 60)) % 24),
                days = Math.floor((t / (1000 * 60 * 60 * 24)));

            return {
                'total': t,
                'days': days,
                'hours': hours,
                'minutes': minutes,
                'seconds': seconds
            };
        }
    }
}

$(document).on('keyup', 'input[name=phone]', function (e) {
    this.value = this.value.replace(/[^0-9\-\+()]/g, '');
});

$(document).on('click', '.owl-next, .owl-prev, .play-video', function (e) {
    $('.yt_player_iframe').each(function () {
        this.contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}', '*')
    });
});

$(document).ready(function () {
    if ($('.account-datepicker').length) {
        let dateFormat = 'DD/MM/YYYY';
        $('.account-datepicker').daterangepicker({
            autoUpdateInput: false,
            singleDatePicker: true,
            showDropdowns: true,
            showOtherMonths: true,
            selectOtherMonths: true,
            //dateFormat: 'yy-mm-dd'
            minYear: 1945,
            maxYear: parseInt(moment().format('YYYY'), 10),
            opens: "center",
            locale: {
                "format": dateFormat,
                "applyLabel": TEXT_MODAL_APPLY_ACTION,
                "cancelLabel": IMAGE_CANCEL,
                "daysOfWeek": [
                    TEXT_DAY_SHORT_1,
                    TEXT_DAY_SHORT_2,
                    TEXT_DAY_SHORT_3,
                    TEXT_DAY_SHORT_4,
                    TEXT_DAY_SHORT_5,
                    TEXT_DAY_SHORT_6,
                    TEXT_DAY_SHORT_7
                ],
                "monthNames": [
                    TEXT_MONTH_BASE_1,
                    TEXT_MONTH_BASE_2,
                    TEXT_MONTH_BASE_3,
                    TEXT_MONTH_BASE_4,
                    TEXT_MONTH_BASE_5,
                    TEXT_MONTH_BASE_6,
                    TEXT_MONTH_BASE_7,
                    TEXT_MONTH_BASE_8,
                    TEXT_MONTH_BASE_9,
                    TEXT_MONTH_BASE_10,
                    TEXT_MONTH_BASE_11,
                    TEXT_MONTH_BASE_12
                ],
                "firstDay": 0
            },
        });

        $('.account-datepicker').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format(dateFormat));
            $('.account-datepicker').trigger('input');
        });

        $('.account-datepicker').on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('');
            $('.account-datepicker').trigger('input');
        });
    }
});

$(document).ready(function () {
    if ($('.account-edit-datepicker').length) {
        let dateFormat = 'DD/MM/YYYY';
        $('.account-edit-datepicker').daterangepicker({
            autoUpdateInput: false,
            singleDatePicker: true,
            showDropdowns: true,
            showOtherMonths: true,
            selectOtherMonths: true,
            minYear: 1945,
            maxYear: parseInt(moment().format('YYYY'), 10),
            opens: "center",
            locale: {
                "format": dateFormat,
                "applyLabel": TEXT_MODAL_APPLY_ACTION,
                "cancelLabel": IMAGE_CANCEL,
                "daysOfWeek": [
                    TEXT_DAY_SHORT_1,
                    TEXT_DAY_SHORT_2,
                    TEXT_DAY_SHORT_3,
                    TEXT_DAY_SHORT_4,
                    TEXT_DAY_SHORT_5,
                    TEXT_DAY_SHORT_6,
                    TEXT_DAY_SHORT_7
                ],
                "monthNames": [
                    TEXT_MONTH_BASE_1,
                    TEXT_MONTH_BASE_2,
                    TEXT_MONTH_BASE_3,
                    TEXT_MONTH_BASE_4,
                    TEXT_MONTH_BASE_5,
                    TEXT_MONTH_BASE_6,
                    TEXT_MONTH_BASE_7,
                    TEXT_MONTH_BASE_8,
                    TEXT_MONTH_BASE_9,
                    TEXT_MONTH_BASE_10,
                    TEXT_MONTH_BASE_11,
                    TEXT_MONTH_BASE_12
                ],
                "firstDay": 0
            },
        });

        $('.account-edit-datepicker').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format(dateFormat));
            $('.account-edit-datepicker').trigger('input');
        });

        $('.account-edit-datepicker').on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('');
            $('.account-edit-datepicker').trigger('input');
        });
    }
});
