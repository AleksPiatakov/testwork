"use strict";

/* --------- POPUPS --------- */

function authModal(data) {
    const body = document.querySelector("body");
    const modal_getLoginForm = document.getElementById("modal_getLoginForm");
    body.classList.add("modal-open");
    if(modal_getLoginForm)modal_getLoginForm.classList.add("hidden");
    body.innerHTML = `
    <div class="modal fade no-title in" id="authModal" tabindex="-1" role="dialog" aria-labelledby="authModal_label" aria-hidden="false" style="display: block;">
        <div class="modal-dialog" style="max-width: 820px; max-height: 800px; position: absolute; top: 50%; left: 50%; transition: all 0.5s ease 0s; transform: translate(-50%, -70%);">
        <div class="modal-content" 0=""><div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z"></path></svg>
            </button>
            </div>
            <div class="modal-body">${data.body}</div>        
        </div>      
        </div>
    </div>
    ` + body.innerHTML;
}

function checkLoginvk(id_var, first_name_var, last_name_var, photo_var, email_var, city_var, pass_var) { // detailed popup
    $.get('./ext/auth/login_process.php', {
        id: id_var,
        first_name: first_name_var,
        last_name: last_name_var,
        photo: photo_var,
        email: email_var,
        city: city_var,
        password: pass_var
    }, function (data) {
        var socEmailAddress = email_var;
        doHookie('complete_registration');
        doHookie('login');
        authModal({
            id: 'check_login',
            body: data
        });

        $.get('./ext/auth/ajax_login_top.php', {ajaxloading: true}, function (data) {
            $('#kabinet').html(data);
            $(".close").click(() => window.location.reload());
        });
    });
}

function modal(options) {
    var settings = {
        id: Math.floor(Math.random() * (1000 - 1 + 1)) + 1,
        after: function () {
        },
        width: 0,
        before: function () {
        }
    }
    $.extend(true, settings, options);
    var width = '';
    var transform = 0;
    if (settings.width != 0) width = 'style="width:auto;max-width:' + settings.width + 'px"';
    if (options.transform) transform = 'style="transform: translateY(' + options.transform + '%)"';
    if (jQuery('.modal').length == 0) {
        var $html = '<div class="modal ' + (settings.unique_styles ? settings.unique_styles.join(' ') : '') + ' fade" id="modal_' + settings.id + '" tabindex="-1" role="dialog" aria-labelledby="' + settings.id + '_label" aria-hidden="true">';
        $html += '<div class="modal-dialog" ' + width + '><div class="modal-content" ' + transform + '>';
        $html += '<div class="modal-header">';
        $html += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z"></path></svg></button>';
        if (settings.title) {
            $html += '<h4 class="modal-title" id="modal_' + settings.id + '_label">' + settings.title;
            if (settings.freeShipping) {
                $html += '<span class="freeShipping">'+settings.title+'</span>';
            }
            $html += '</h4>';
        }
        $html += '</div>';
        $html += '<div class="modal-body">' + settings.body + '</div>\
        </div>\
      </div>\
      </div>';
        jQuery('body').append($html).promise().done(function () {
            var $modal = jQuery('#modal_' + settings.id);
            var $before = settings.before($modal);
            if ($before !== false) {
                if (settings.classes) {
                    $modal.addClass(settings.classes);
                }

                if (settings.title == null) {
                    $modal.addClass('no-title');
                }

                if ($modal.hasClass('valign-false') == false) {
                    centerModal($modal);
                }
                $modal.on('hidden.bs.modal', function (e) {
                    $modal.remove();
                });
                $modal.on('shown.bs.modal', function (e) {
                    if (settings.after) {
                        settings.after($modal);
                    }
                });
                $modal.modal();

            } else {
                $modal.remove();
            }

        });
    }
}

function centerModal(el) {
    $(el).css('display', 'block');
    var $dialog = $(el).find(".modal-dialog");
    $dialog.css('position', 'absolute');
    $dialog.css('top', '50%');
    $dialog.css('left', '50%');
    $dialog.css('transition', '0.5s ease');
    $dialog.css('transform', 'translate(-50%, -70%)');
    $($dialog).animate({'margin-top': '100px'}, 1)
}

function pop_contact_us() {
    $.post('./pop_contact_us.php', '', function (data) {
        modal({
            id: 'pop_contact_us',
            title: data.title,
            body: data.html
            // classes: 'valign-false'
        });
    }, 'json');
}

function showCartpopup() {
    if (typeof window.settings != "undefined") {
        if (window.settings.SHOW_BASKET_ON_ADD_TO_CART == true) {
            $.get('./popup_cart.php', null, function (response) {
                modal({
                    id: 'cart_popup',
                    body: response,
                    classes: 'valign-false',
                    after: function () {
                        //   scrollToTop();
                    }
                });
            });
        }
    }
}

// call after get response
function showPopupResponse(res) {
    $('#popup_cart_form .delete').attr('disabled', false);
    if (res !== undefined && res !== 0) {
        res = JSON.parse(res);
        for (var i = 0; i<res.prod.length; i++) {
            var product_name = $('.row.cartContent_body.product_id_' + res.prod[i].string_id + res.prod[i].attr_chain + ' .product_name');
            if (product_name.html() != res.prod[i].name) {
                product_name.html(res.prod[i].name);
            }
            var product_total = $('.row.cartContent_body.product_id_' + res.prod[i].string_id + res.prod[i].attr_chain + ' .product_total');
            if (product_total.html() != res.prod[i].price_full) {
                product_total.html(res.prod[i].price_full);
            }
        }
        $('#cart_order_total').html(res.total);

        var warning_mess = $('.warning_mess');
        if (warning_mess.length > 0) {
            warning_mess.replaceWith(res.stock_text);
        } else {
            $('#cart_order_total').after(res.stock_text);
        }

        if (res.stock_text != '') {
            $('#checkoutButton').css({'pointer-events': 'none', 'opacity': '0.5'});
        } else {
            $('#checkoutButton').removeAttr("style");
        }
    }
    updateCart();
    if ($('#voucherRedeem').length) {
        $('#voucherRedeem').click();
    }
    // reset checkout
    if (typeof checkout != 'undefined') {
        checkout.updateShippingMethods();
        checkout.updateOrderTotals();
        updateCheckoutCart(res);
    }
}

function updateCheckoutCart(response) {
    // array for del product
    var checkoutCartProducts = [];
    var checkoutProducts = $('.checkout_cart_item');
    for (var i = 0; i < checkoutProducts.length; i++) {
        checkoutCartProducts.push(parseInt(checkoutProducts[i].dataset.id));
    }

    for (i = 0; i<response.prod.length; i++) {
        if (checkoutCartProducts.includes(response.prod[i].id)) {
            for (var j = 0; j < checkoutCartProducts.length; j++) {
                if (checkoutCartProducts[j] == response.prod[i].id) {
                    checkoutCartProducts.splice(j, 1);
                }
            }
        }
        var prodIdSelector = (response.prod[i].id).toString().replace(/{/g,'\\{').replace(/}/g,'\\}');//comments { } for attributes in profuct id
        var product_name = $('.product-id-' + prodIdSelector);
        if (product_name[0].outerHTML != response.prod[i].checkout_name) {
            product_name[0].outerHTML = response.prod[i].checkout_name;
        }

        var product_quantity = $('.input-checkout-prod-quantity.product-id-' + prodIdSelector);
        if (product_quantity.val() != response.prod[i].qty) {
            product_quantity.val(response.prod[i].qty);
        }

        var product_total = $('.price-full-' + prodIdSelector);
        if (product_total.html() != response.prod[i].price_full) {
            product_total.html(response.prod[i].price_full);
        }
    }

    for (i = 0; i < checkoutCartProducts.length; i++) {
        $('.checkout_cart_item[data-id="' + checkoutCartProducts[i] + '"]').remove();
    }

    var warning_mess = $('#checkout_cart .warning_mess');
    if (warning_mess.length > 0) {
        warning_mess.replaceWith(response.stock_text);
    } else {
        $('.checkout_cart_block').append(response.stock_text);
    }

    $('.cart_count').html('(' + response.count + ')');
}

// call after get response
function showPopupResponsev2(res) {
    updateCart();
    // reset checkout
    if (typeof checkout != 'undefined') {
        checkout.updateShippingMethods();
        checkout.updateOrderTotals();
    }
}

/* --------- /POPUPS --------- */

// Return cookie by name
function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
/* --------- AJAX-add to cart --------- */

function doAddProduct(form) {
    var fe = form.elements;
    var senddata = new Object();
    for (var i = 0; i < fe.length; i++) {
        if (fe[i].type == "radio" || fe[i].type == "checkbox") {
            if (fe[i].checked) senddata[fe[i].name] = fe[i].value;
        } else {
            senddata[fe[i].name] = fe[i].value;
        }
    }
    var url = form.action;
    $.post(url, senddata, function (data) {
        //  $('.add2cart[data-id='+senddata["products_id"]+']').replaceWith(sprintf(RTPL_CART_BUTTON, senddata["products_id"]));
        $('#r_buy_intovar[data-id=' + senddata["products_id"] + ']').html(RTPL_CART_BUTTON_PRODUCT_PAGE); // product page
        if ($('.fade.tooltip.top.in').length) $('.fade.tooltip.top.in').remove();
        if ($(window).width() > 768) {
            $('[data-toggle="tooltip"]').tooltip({
                container: 'body'
            });
        }
        showCartpopup();
        updateCart('add_product');
    });
}

function doAddProductList(button) {

    $.post('?action=add_product', {
        'products_id': button.attr('data-id'),
        'cart_quantity': button.attr('data-qty')
    }, function (data) {
        $('.add2cart[data-id=' + button.attr('data-id') + ']').replaceWith(sprintf(RTPL_CART_BUTTON, button.attr('data-id')));
        if ($('.fade.tooltip.top.in').length) $('.fade.tooltip.top.in').remove();
        if ($(window).width() > 768) {
            $('[data-toggle="tooltip"]').tooltip({container: 'body'});
        }
        //this variables is global and will be replaced for current product
        currentProductId = data.id;
        productPriceOrign = data.price;//$(this).attr('data-orign-price');
        currentProductCategoryName = data.category;
        currentProductName = data.name;
        doHookie('add2cart');
        showCartpopup();
        updateCart('add_product');
    }, 'json');
}

function showAlert(text, parent, type, removeClass) {
    // if removeClass isn't empty - show close button
    if (removeClass !== '') var close = '<button class="close" data-dismiss="alert" aria-label="close"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z"></path></svg></button>';

    // adds alert box to parent with next properties
    parent.after("<div class='alert " + type + " apple-tree fade in " + removeClass + "' data-alert='alert'>" + close + "<span>" + text + "</span></div>");

    setTimeout(function () {
        parent.next().remove();
    }, 5000);
}

// call before send data
function showRequest(formData, jqForm, options) {
    var queryString = $.param(formData);
    //  $('#block').animate({opacity: 0.6}, 50);
    $('.refresh_icon .fa-spin').fadeIn(20);
    queryString = '?' + queryString;
    history.replaceState({foo: "bar"}, "Jesus saves", document.location.pathname.toString() + queryString);
    return true;
}

// call after get answer
function showResponse(responseText, statusText) {
    //   console.log(responseText);
    //  $('#block').animate({opacity: 1}, 50);
    $('.refresh_icon .fa-spin').fadeOut(20);
}

/* --------- END AJAX-add to cart --------- */

function productInCart(cartKey) { // cartKey contain product_id + attributes
    $('#r_buy_intovar button[type="submit"]').attr('disabled');
    var isModal = false;
    if ($('.product_modal').length === 1) {
        isModal = true;
    }
    $.post('./ajax_product_in_cart.php', 'cartKey=' + cartKey + '&is_modal=' + isModal, function (data) {
        $('#r_buy_intovar').html(data['button_html']);
    }, 'json');
}

function updateCart(action) { // function updateCart(action = ''){
    $.post('./ajax_update_cart.php', '', function (data) {
        $('#divShoppingCard').replaceWith(data.cart_html); // $('#divShoppingCard').html(data.cart_html);
        $('.mobile_cart_count').html(data.cart_count);
        // if ($('.xs-menu-actions .popup_cart .counter').length) $('.xs-menu-actions .popup_cart .counter').text(data.count)
        if (action == 'add_product') {
            $('.alert').remove();
            showAlert(RENDER_TEXT_ADDED_TO_CART, $('#divShoppingCard'), 'alert-success', 'alert-dismissible');
        }
    }, 'json');
}

/* --------- ETC --------- */
function setLastcols(context, element) {
    var listing_item = jQuery(context + ' ' + element);
    var cols = Math.floor(jQuery('#center').width() / listing_item.width());
    jQuery(context + ' ' + element + ':nth-of-type(' + cols + 'n+' + cols + ')').addClass('last-col');
}

//Scroll to some element on page
function scrollToEl(element) {
    var $el = jQuery(element);
    var $elOffset_top = $el.offset().top;
    jQuery('body,html').stop(false, false).animate({scrollTop: $elOffset_top}, {duration: 600, easing: 'swing'}, 800);
}

function scrollToTop() {
    jQuery('body,html').stop(false, false).animate({scrollTop: 0}, {duration: 600, easing: 'swing'}, 800);
}

// Item list
function themeItems() {
    jQuery('.item-list li').each(function (e) {
        jQuery(this).addClass('item_' + e);
    });
}

function showLoginvk(url) {
// set window width and height
    var w = 635;
    var h = 250;
// calculate window position according to screen resolution
    var lPos = (screen.width) ? (screen.width - w) / 2 : 0;
    var tPos = (screen.height) ? (screen.height - h) / 2 : 0;
// newWindow = window.open("","","height="+h+",width="+w+",top="+tPos+",left="+lPos);
    var params = "menubar=no,location=yes,resizable=yes,scrollbars=no,status=no,height=" + h + ",width=" + w + ",top=" + tPos + ",left=" + lPos;
    let loginWindow = window.open(url, VK_LOGIN, params);
    var popupTick = setInterval(function() {
        if (loginWindow.closed) {
            $(".close").click();
            clearInterval(popupTick);
        }
    }, 500);

}

/*
* Function for fixing dropdown submenu
* last points by right side, if it`s width more than wrapper`s width
* Example : fixMenu('.nav','li.parent','.dropdown_div');
*/
function fixMenu(menu_selector, parent, dropdown) {
    var $menu = $(menu_selector);
    var $windowWidth = jQuery(window).width();
    var $wrapperWidth = $menu.width();
    var $outsideWidth = ($windowWidth - $wrapperWidth) / 2;
    $(menu_selector + '' + parent).each(function (index, el) {
        var $dropdown = $(el).find(dropdown);
        var $curTotalWidth = ($(el).offset().left + $dropdown.outerWidth(true)) - $outsideWidth;
        var $differenceWidth = ($(el).offset().left - $outsideWidth) / 2;
        if ($curTotalWidth > $wrapperWidth) {
            $dropdown.css({marginLeft: '-' + $differenceWidth + "px"});
        }
    });
}

/* --------- /ETC --------- */


/* --------- SEARCH --------- */
function liFormat(row, i, num) {
    var st = '';
    var result = '<div class="search_image_wrap"><img src="' + row[2] + '" class="picsearch"></div>' + '<p class=qnt1>' + row[0] + ' </p><span><p class=qntp>' + row[4] + '</p>' + '<p class=qnt>' + row[1] + ' </p></span>';
    return result;
}

function selectItem(li) {
    if (li == null) {
        var sValue = '!';
        window.location = "/search=" + li.extra[2];
    }
    if (!!li.extra) var sValue = li.extra[2];
    else var sValue = li.selectValue;
    var tbox = document.getElementById('searchpr') || document.getElementById('searchpr1');
    if (tbox) {
        window.location = SEARCH_LANG + "product_info.php?products_id=" + li.extra[2];
    }
}

/* --------- SEARCH --------- */

function calculate_sum(selected_op) {
    var summ, old_summ, sel_ops, other_value;
    if(typeof selected_op == "undefined" || selected_op.length == 0){
        return false;
    }
    setTimeout(function(){
    if ($('input[name=prod_price]').val() != '-') {
        other_value = $('#id_option_other' + selected_op.val()).val();
        if ((selected_op.attr('data-prefix') == '=' || other_value.indexOf('=') == 0) && other_value != '=0') { // if "=" and NOT "=0" then immediately set price
            summ = ($('#id_option_other' + selected_op.val()).val()).substring(1);
        } else {
            $('.select_id_option').each(function () { // search first attribute with "=" sign
                sel_ops = $(this).parent().find($("select option:selected"));
                if (sel_ops.attr('data-prefix') == '=' && $('#id_option_other' + sel_ops.val()).val() != '=0') {
                    summ = ($('#id_option_other' + sel_ops.val()).val()).substring(1);
                    return false;
                }
            });
            if (!summ) summ = parseFloat($('input[name=prod_price]').val()); // current product price
        }

        old_summ = parseFloat($('input[name=old_prod_price]').val());

        $('select.select_id_option').each(function () {   // adding all prices with "+"
            if ($(this).hasClass('selectized')) {
                sel_ops = selectizeGetSelectedItem(selectizeWrapper($(this)));
                if (typeof sel_ops != 'undefined' && sel_ops.prefix) {
                    if (sel_ops.prefix == '+' || (sel_ops.prefix == '=' && $('#id_option_other' + sel_ops.value).val() == '=0')) {
                        summ = parseFloat(summ) + parseFloat(($('#id_option_other' + sel_ops.value).val()).substring(1));
                        old_summ = parseFloat(old_summ) + parseFloat(($('#id_option_other' + sel_ops.value).val()).substring(1));
                    } else if (sel_ops.prefix == '-') {
                        summ = summ - parseFloat(($('#id_option_other' + sel_ops.value).val()).substring(1));
                        old_summ = old_summ - parseFloat(($('#id_option_other' + sel_ops.value).val()).substring(1));
                    }
                }
            } else {
                sel_ops = $(this).parent().find($("select option:selected"));
                if(typeof sel_ops != 'undefined'){
                    if (sel_ops.attr('data-prefix') == '+' || (sel_ops.attr('data-prefix') == '=' && $('#id_option_other' + sel_ops.val()).val() == '=0')) {
                        summ = parseFloat(summ) + parseFloat(($('#id_option_other' + sel_ops.val()).val()).substring(1));
                        old_summ =  parseFloat(old_summ) + parseFloat(($('#id_option_other'+sel_ops.val()).val()).substring(1));
                    } else if (sel_ops.attr('data-prefix') == '-') {
                        summ = summ - parseFloat(($('#id_option_other' + sel_ops.val()).val()).substring(1));
                        old_summ = old_summ - parseFloat(($('#id_option_other'+sel_ops.val()).val()).substring(1));
                    }
                }
            }
        });

        // console.log(attributeStock);
        if ($('#r_buy_intovar').length && typeof attributeStock != "undefined" && attributeStock && attributeStock.length) {
            var attrs = [], optionId = '', optionValueId = '';
            $('.prod_options [name="option_name"]').each(function () {
                optionId = $(this).val();
                if (optionId){
                    optionValueId = $('[name=' + optionId + ']:checked').val();
                    if(!optionValueId) optionValueId = $('#select_id_' + optionId).val();
                    attrs[optionId] = optionId + '-' + optionValueId;
                }
            });
            var attr = Object.keys(attrs).map(function (x) {
                return attrs[x];
            }).join(',');

            if (typeof attributeStockPrice != "undefined" && attributeStockPrice) {
                if (typeof attributeStockSpecialPrice != "undefined" && attributeStockSpecialPrice && Object.values(attributeStockSpecialPrice).length && attributeStockSpecialPrice[attr]) {
                    summ = attributeStockSpecialPrice[attr];
                    old_summ = attributeStockPrice[attr];
                    old_summ = parseFloat(old_summ)>parseFloat(summ)?old_summ:'';
                }else{
                    if (Object.values(attributeStockPrice).length && attributeStockPrice[attr]) {
                        summ = attributeStockPrice[attr];
                        old_summ = '';
                    }
                }
            }
        }

        // ------------------format summ!!------------------

        // add decimal places after decimal point
        var decimalPlaces = $('input[name=prod_dec_places]').val();
        if (decimalPlaces) {
            summ = parseFloat(summ).toFixed(decimalPlaces);
            old_summ = parseFloat(old_summ).toFixed(decimalPlaces);

            // replace dot(.) to store decimal point
            var decimalPoint = $('input[name=prod_dec_point]').val();
            if(decimalPoint) {
                summ = summ.replace('.', decimalPoint);
                old_summ = old_summ.replace('.', decimalPoint);
            }
        } else {
            // if dec_places empty, make it INT
            summ = parseInt(summ);
            old_summ = parseInt(old_summ);
        }

        // add thousands point
        var thousandsPoint = $('input[name=prod_thousands_point]').val();
        if(thousandsPoint) {
            summ = numberWithCommas(summ, thousandsPoint);
            old_summ = numberWithCommas(old_summ, thousandsPoint);
        }

        summ = summ === 'NaN' ? '' : summ;
        old_summ = old_summ === 'NaN'  ? '' : old_summ;

        // left currency symbol
        var currencyLeft = $('input[name=prod_currency_left]').val();
        if( currencyLeft && summ != '' ) {
            summ = currencyLeft + summ;
            if(typeof old_summ != "NaN" && old_summ.length) old_summ = currencyLeft + old_summ;
        }

        // right currency symbol
        var currencyRight = $('input[name=prod_currency_right]').val();
        if(currencyRight && summ != '') {
            summ = summ + ' ' +  currencyRight;
            if(typeof old_summ != "NaN" && old_summ.length) old_summ = old_summ + ' ' + currencyRight;
        }

        $(".new_price_card_product").html(summ);
        $(".old_price_card_product").html(old_summ);
    }
    }, 100);
}

function ajaxSubmitSerialize(options) {
    $('#attribs').addClass('pointer_events_none'); // Block filters for processing time
    $('#ajax_search_brands').addClass('pointer_events_none');
    $('.refresh_icon .fa-spin').fadeIn(20);
    if (options.target) {
        $('#m_srch input[name="page"]').prop("disabled", true);
    }
    var pathSerialize = $('#m_srch').attr('action') + '?' + $('#m_srch').serialize();
    var queryString = '?' + $('#m_srch').serialize();
    $('#m_srch input[name="page"]').prop("disabled", false);
    if (!(typeof SEO_FILTER == "string" && SEO_FILTER == 1)) {
        history.replaceState({foo: "bar"}, "Jesus saves", document.location.pathname.toString() + queryString);
    }
    var findWidthToUnveil;

    // if($('#m_srch input[name="loadajax"]').val()=='true') {
    if (options.target) {
        //  $(options.target).html('<div id="r_spisok" class="row row_catalog_products "></div>');
        $.post(pathSerialize, function (data) { // get array
            $('#attribs').removeClass('pointer_events_none'); // unblock filters
            $('#ajax_search_brands').removeClass('pointer_events_none');
            if (data != null && data['globals'] != undefined) {
                var ajax_globals = data['globals']; // array with global variables and languages constants

                $(options.target).html(ajax_globals['listing_header']);

                if (typeof RTPL_DEFAULT_COLS !== 'undefined') {
                    var default_cols = JSON.parse(RTPL_DEFAULT_COLS);
                    var default_cols_str = 'cc-xs-' + default_cols[0] + ' cc-sm-' + default_cols[1] + ' cc-md-' + default_cols[2] + ' cc-lg-' + default_cols[3] + ' cc-lg-' + default_cols[4];
                    $('#r_spisok').addClass(default_cols_str);
                }

                $.each(data, function (k, v) { // add array directly to html

                    //find width to activate unveil in chrome
                    if (v['product_image'] && !findWidthToUnveil) {
                        findWidthToUnveil = v['product_image'].split('&')[1].split('=')[1];
                    }
                    //
                    if (k != 'globals') $('#r_spisok').append(draw_product_block(v, ajax_globals));
                });
                showResponse();
                if (findWidthToUnveil) {
                    //        $("#r_spisok img").width(findWidthToUnveil);
                    findWidthToUnveil = 0;
                }
                $("#r_spisok img").unveil(100, addAnimClassToImg);
                //    $("#r_spisok img").width('100%'); // to make lazyload work properlty we need to set dimensions in pixels, and then return "100%" width as in css

                // add "show more" and pagination
                //   $('#r_spisok').after(ajax_globals['load_more']+ajax_globals['pages_html']+ajax_globals['number_of_rows']);
                $('#r_spisok').after(ajax_globals['listing_footer']);
                $('#loadMoreProducts').click(function () {
                    loadMoreProducts();
                });

                if (RTPL_PDF_ENABLED) {
                    $(RTPL_PDF_BLOCK_SELECTOR).data("href", ajax_globals['pdf_link'])
                }
                // if(RTPL_PDF_ENABLED) $('#block').prepend(sprintf(RTPL_LISTING_HEADER, ajax_globals['pdf_link']));

            } else {
                $('#block').html('');
                $('#attribs').removeClass('pointer_events_none'); // unblock filters
                $('.refresh_icon .fa-spin').fadeOut(20);
            }
            if (typeof SEO_FILTER == "string" && SEO_FILTER === 'true') {
                if (typeof ajax_globals !== 'undefined') {
                    if ($('#filters_box').length) $('#filters_box').replaceWith(ajax_globals['filtersBlock'])
                    if (ajax_globals['currentHref']) {
                        window.history.pushState('data', 'Title', ajax_globals['currentHref']);
                    } else {
                        history.replaceState({foo: "bar"}, "Jesus saves", document.location.pathname.toString() + queryString);
                    }
                } else {
                    history.replaceState({foo: "bar"}, "Jesus saves", document.location.pathname.toString() + queryString);
                }
                initSlider();
            }
            doHookie('filter');
        }, 'json');
    } else if (options = "loadMore") {
        var lastMsg = $('#r_spisok .col_product:last');
        var curOffset = lastMsg.offset().top - $(document).scrollTop();
        $('#attribs').removeClass('pointer_events_none'); // unblock filters
        $.get(pathSerialize, function (data) {
            //from all html get only list of products to add and append them to #r_spisok
            var ajax_globals = data['globals']; // array with global variables and languages constants
            $.each(data, function (k, v) { // add array directly to html
                //find width to activate unveil in chrome
                if (v['product_image'] && !findWidthToUnveil) {
                    findWidthToUnveil = v['product_image'].split('&')[1].split('=')[1];
                }
                if (k != 'globals') $('#r_spisok').append(draw_product_block(v, ajax_globals));
            });
            $(document).scrollTop(lastMsg.offset().top - curOffset);
            $($.find(".pagination .active")).next().attr("class", "active"); //mark next page as active
            showResponse();
            if (findWidthToUnveil) {
                //   $("#r_spisok img").width(findWidthToUnveil);
                findWidthToUnveil = 0;
            }
            $("#r_spisok img").unveil(100, addAnimClassToImg);
            //   $("#r_spisok img").width('100%'); //to make lazyload work properlty we need to set dimensions in pixels, and then return "100%" width as in css

            $('#loadMoreI').removeClass('fa-spin'); //stop font-awesome animation
        }, 'json');

    }

}

function loadMoreProducts() {
    var totalProducts = $('input[name=number_of_rows]').val();
    //  var productsPerPage=$('select[name=row_by_page] option:selected').text();
    var productsPerPage = $('*[name=row_by_page]').val(); //get value from row_by_page
    var lastRedElement;
    //find last red page(even it has not li .active)
    var obj = $('#m_srch').serializeArray();
    obj.forEach(function (item) {
        if (item['name'] == "row_by_page") {
            productsPerPage = item['value'];
        }
    });

    var foundpage = false;
    $.each(obj, function (i, field) {
        if (obj[i].name == "page") {
            lastRedElement = parseInt(obj[i].value);
            foundpage = true;

        }
    });
    var totalPagesAdjusted;
    if (~~(totalProducts / productsPerPage) === (totalProducts / productsPerPage)) {
        totalPagesAdjusted = (totalProducts / productsPerPage);
    } else {
        totalPagesAdjusted = ~~(totalProducts / productsPerPage) + 1;
    }
    if (foundpage == false) {
        lastRedElement = 1;
    }

    if (lastRedElement >= totalPagesAdjusted) {
    } else {
        $('#loadMoreI').addClass('fa-spin');//start font-awesome animation
        $('.refresh_icon .fa-spin').fadeIn(20);

        //serialize path with attributes
        var obj = $('#m_srch').serializeArray();
        var foundpage = false;
        $.each(obj, function (i, field) {
            if (obj[i].name == "page") {
                lastRedElement = obj[i].value;
                obj[i].value = parseInt(obj[i].value) + 1;
                $('#m_srch').prop("page").value = obj[i].value;
                foundpage = true;

            }
        });
        if (foundpage == false) {
            $('#m_srch').append('<input id="page1" type="hidden" name="page" value="2">');
            lastRedElement = 1;
        }

        ajaxSubmitSerialize("loadMore");
    }
}

// new draw product block by templates. 03.04.18 by raid
function draw_product_block($listing, glob) {

    var $id = $listing['p_id'];
    var $product_name = $listing['p_name'];
    var $show_button = $listing['show_button'];
    var $product_info = $listing['p_info'];
    var $cat_name = $listing['cat_name'];
    var $has_attributes = $listing['has_attributes'];
    var $product_href = glob['promUrls'] ? glob['catalog_path'] + 'p' + $id + '-' + $listing['p_href'] + '.html' : glob['catalog_path'] + $listing['p_href'] + '/p-' + $id + '.html';
    var $product_image = sprintf(RTPL_PRODUCTS_IMAGE, glob['img_end'], ($listing['p_img'] != '' ? $listing['p_img'] : glob['img_default']), $product_name, $product_name, ($listing['p_img2'] ? 'data-hover="getimage/' + glob['img_end'] + '/products/' + $listing['p_img2'] + '"' : ''));
    var $pmodel = ($listing['p_model'] != '' ? sprintf(RTPL_PRODUCTS_MODEL, glob['pmodel_class'], $listing['p_model']) : '');
    var $stock = ($listing['p_qty'] > 0 ? sprintf(RTPL_PRODUCTS_STOCK, glob['stock_pull']) : sprintf(RTPL_PRODUCTS_OUTSTOCK, glob['stock_pull']));
    var $label = '';
    $.each($listing['labels'], function (index, value) {
        $label += value['name'] ? sprintf(RTPL_LABEL, value['class'], value['name']) : '';
    });
    var $add_classes = glob['add_classes'] ? glob['add_classes'] : ''; // separated old price
    var $not_available = $listing['p_qty'] == 0 ? ' not_available' : '';
    var $p_wishlist, $cart_button;
    let $modal_button = glob['modal_button'];

    var $spec_price = $listing['p_specprice'] ? $listing['p_specprice'] : '';
    $spec_price = $spec_price == '-' ? '' : $spec_price;
    var $old_price = $listing['p_price'];
    $old_price = $old_price == '-' ? '' : $old_price;
    var $final_price = ($spec_price != '' ? sprintf(RTPL_PRODUCTS_SPEC_PRICE, $spec_price, $old_price) : sprintf(RTPL_PRODUCTS_PRICE, $old_price));

    var $new_price = sprintf(RTPL_PRODUCTS_PRICE, ($spec_price ? $spec_price : $old_price)); // separated new price
    var $old_price = $spec_price ? sprintf(RTPL_PRODUCTS_OLD_PRICE, $old_price) : ''; // separated old price

    $cart_button = '<input type="hidden" name="cart_quantity" value="1"><input type="hidden" name="products_id" value="' + $id + '">';
    if ($listing['p_qty'] <= 0) {
        if ($show_button == "true") {
            $cart_button += ($listing['cart_incart'] ? sprintf(RTPL_CART_BUTTON, $id) : sprintf(RTPL_ADD_TO_CART_BUTTON, $id, 1));
        }
    } else {
        $cart_button += ($listing['cart_incart'] ? sprintf(RTPL_CART_BUTTON, $id) : sprintf(RTPL_ADD_TO_CART_BUTTON, $id, 1));
    }

    $listing['compare'] = $listing['compare'] ? $listing['compare'] : '';
    $listing['wish'] = $listing['wish'] ? $listing['wish'] : '';

    // Compare & Wishlist
    var $compare_output = '';
    $p_wishlist = '';
    if (glob['compare_enabled'] == true || glob['wish_enabled'] == true) {

        if (glob['compare_enabled'] == true) {
            if (checkTemplate('default')) {
                $compare_output += sprintf(RTPL_PRODUCTS_COMPARE, $id, $id, $id, $listing['compare'], $listing['compare_link_before'], $id, ($listing['compare'] ? glob['compare_text_in'] : glob['compare_text']), $listing['compare_link_after']);
            } else {
                $compare_output += sprintf(RTPL_PRODUCTS_COMPARE, $id, $id, $id, $listing['compare'], $id, ($listing['compare'] ? glob['compare_text_in'] : glob['compare_text']));

            }
        }
        if (glob['wish_enabled'] == true) $p_wishlist = sprintf(RTPL_PRODUCTS_WISHLIST, $id, $id, $id, $listing['wish'], $id, ($listing['wish'] ? glob['wish_text_in'] : glob['wish_text']));
    }

    $compare_output = ($compare_output != '' ? sprintf(RTPL_COMPARE_OUTPUT, glob['compare_class'], $compare_output) : '');

    // Attributes:
    var $product_attributes = '';
    if ($listing['p_attr'] && glob['attr_body'] !== null) {
        $.each($listing['p_attr'], function ($ana_name, $ana_vals) {
            $product_attributes += sprintf(glob['attr_listing'], glob['all_attribs'][$ana_name], $ana_vals);
        });
        $product_attributes = $product_attributes ? sprintf(glob['attr_body'], $product_attributes) : '';
    }

    var $array_from_to = {
        'blocks_num_lg': glob['blocks_num']['lg'],
        'blocks_num_md': glob['blocks_num']['md'],
        'blocks_num_sm': glob['blocks_num']['sm'],
        'blocks_num_xs': glob['blocks_num']['xs'],
        'blocks_num_xl': glob['blocks_num']['xl'],
        'product_href': $product_href,
        'label': $label,
        'product_image': $product_image,
        'products_model': $pmodel,
        'has_attributes': $has_attributes,
        'stock': $stock,
        'final_price': $final_price,
        'new_price': $new_price,
        'old_price': $old_price,
        'id': $id,
        'category_name': $cat_name,
        'product_name': $product_name,
        'product_info': $product_info,
        'product_attributes': $product_attributes,
        'compare_output': $compare_output,
        'wishlist_output': $p_wishlist,
        'cart_button': $cart_button,
        'add_classes': $add_classes,
        'not_available': $not_available,
        'product_modal_button': $modal_button
    };

    return glob['listing_layout'].formatUnicorn($array_from_to);  // replace template by variables from $array_from_to
}

function numberWithCommas(x, comma) {
    if (typeof x != 'undefined') return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, comma);
}

// scroll to selected element:
function multiselectscroll() {
    $(document).on('click', '.ui-multiselect', function () {
        //   $(".ui-multiselect").on('click', function() {
        if ($('.ui-multiselect-menu:visible').length != 0) { // if its opened
            $('.ui-multiselect-menu:visible .ui-multiselect-checkboxes').animate({scrollTop: 0}, 0); // go to top first;
            $('.ui-multiselect-menu:visible .ui-multiselect-checkboxes').animate({ // go to current element
                scrollTop: $(".ui-multiselect-menu:visible .ui-multiselect-checkboxes .ui-state-active").position().top
            }, 0);
        }
    });
}

// NOT WORKING for IE:
/* function sprintf(format, ...args) {
    let i = 0;
    return format.replace(/%s/g, () => args[i++]);
} */

function sprintf() {
    if (arguments.length < 2) {
        return arguments[0];
    }
    var args = arguments;
    var index = 1;
    var result = (args[0] + '').replace(/%((\d)\$)?([sd%])/g, function (match, group, pos, format) {
        if (match === '%%') {
            return '%';
        }
        if (typeof pos === 'undefined') {
            pos = index++;
        }
        if (pos in args && pos > 0) {
            return args[pos];
        } else {
            return match;
        }
    });
    return result;
}

// replace function:
String.prototype.formatUnicorn = String.prototype.formatUnicorn ||
    function () {
        "use strict";
        var str = this.toString();
        if (arguments.length) {
            var t = typeof arguments[0];
            var key;
            var args = ("string" === t || "number" === t) ?
                Array.prototype.slice.call(arguments)
                : arguments[0];

            for (key in args) {
                str = str.replace(new RegExp("\\{{" + key + "\\}}", "gi"), args[key]);
            }
        }

        return str;
    };

function selectizeWrapper($selector) {
    return $selector[0].selectize;
}

function selectizeGetSelectedItem(wrapper) {
    return wrapper.options[wrapper.items[0]];
}

function checkTemplate(templateName) {
    return typeof TEMPLATE_NAME === 'string' && TEMPLATE_NAME === templateName;
}

function renderSlider(mainPageModules) {
    if (mainPageModules.length == 0) {
        return false;
    }
    var box = mainPageModules.shift();
    $.ajax({
        url: './routes.php?get-module=1',
        type: 'POST',
        data: {render: box},
        success: function (response) {
            var el = $('.ajax-module-box[data-module-id="' + box + '"]');
            el.append((response));
            el.find('img').unveil(100, addAnimClassToImg);
            el.find('.lazy-data-loader').remove();
            var block_id = el.find('.product_slider').attr('id');
            if (typeof block_id != 'undefined') {
                eval('make_' + block_id + '_slider();');
            }
            renderSlider(mainPageModules);
        }
    });
}

//the slider block is loaded when scroll top position near the our block
function blockUnveil(elements, th) {
    for (let index in elements) {
        var element = $('[data-module-id="' + elements[index] + '"]');
        var scrollFlag = (typeof (element.attr('data-scroll')) != 'undefined') ? true : false;
        if (element.length > 0 && !scrollFlag) {
            var wt = $(window).scrollTop(),
                wb = wt + $(window).height(),
                et = element.offset().top,
                eb = et + element.height();
            var ress = eb >= wt - th && et <= wb + th;
            if (ress) {
                scrollFlag = true;
                element.attr('data-scroll', true);
                renderSlider([elements[index]]);
            }
        }
    }
}

function renderCustomizationPanel() {
    if (page_name != 'checkout') {
        $.ajax({
            url: './customization_panel.php',
            success: function (response) {
                $('body').append(response);
            }
        });
    }
}

function checkIsCustomizationPanelVisible() {
    if (page_name != 'checkout') {
        if (!customizationPanelFlag) {
            customizationPanelFlag = true;
            setTimeout(function () {
                renderCustomizationPanel();
            }, timeoutValue);
        }
    }
}

function addAnimClassToImg() {
    $(this).addClass('anim');
}

function makeJSConstantsFromJson() {
    let jsonConstantsElem = document.getElementById('json-constants');
    if (jsonConstantsElem != null) {
        let jsonConstants = JSON.parse(document.getElementById('json-constants').innerHTML);
        for (let constant in jsonConstants) {
            window[constant] = jsonConstants[constant];
        }
    }
}

function checkAndAddMainStyles() {
    var link = $('#main-style').attr('data-href');
    if (typeof link != 'undefined') {
        $('#main-style').removeAttr('data-href');
        $('#main-style').attr('href', link);
    }
    if (IS_MOBILE && $('#mobile-main-style[data-href]').length > 0) {
        link = $('#mobile-main-style').attr('data-href');
        $('#mobile-main-style').removeAttr('data-href');
        $('#mobile-main-style').attr('href', link);
    }
}

function checkoutCollapsedTab(element, hideIcon = true) {
    var existError = checkoutCheckTab(element, hideIcon);

    if (existError) {
        $(element).closest('.collapse_wrapper').addClass('error');
        $(element).closest('.collapse_wrapper').removeClass('success_block');
    } else {
        $(element).closest('.collapse_wrapper').removeClass('error');
        $(element).closest('.collapse_wrapper').addClass('success_block');

        // build short info for tab
        var shortInfo = $('.collapse_wrapper_info[data-parent="' + element + '"] span');
        for (var i = 0; i < shortInfo.length; i++) {
            if (element === '#checkout_user') {
                if ($(shortInfo[i].dataset.selector).is("input")) {
                    shortInfo[i].textContent = $(shortInfo[i].dataset.selector).val();
                } else {
                    shortInfo[i].textContent = $(shortInfo[i].dataset.selector).text();
                }
            } else if (element === '#checkout_shipping') {
                var methodID = $(shortInfo[i].dataset.selector).attr('id');
                var lable = $('label[for="' + methodID + '"]').text();
                var price = $('label[for="' + methodID + '"]').closest('.shippingRow').find('.form-group.' + methodID.replace(/\s/g, '.').replace(/A\.M\./g,'A\\.M\\.')).text();
                if( methodID === 'radio_nwposhtanew_nwposhtanew' && (parseInt(price.replace( /\D/g, '')) || 0) == 0){
                    shortInfo[i].textContent = lable;
                }else {
                shortInfo[i].textContent = lable + ' - ' + price;
                }
            } else {
                var methodID = $(shortInfo[i].dataset.selector).attr('id');
                var shortBlockInfo = $('label[for="' + methodID + '"]').text();
                var cardNumber = $('label[for="' + methodID + '"]').closest('.form-group').find('input[name="cc_number"]');
                if (cardNumber.length > 0) {
                    shortBlockInfo += ' (' + GetCardType(cardNumber[0].value) + ' **** ' + cardNumber[0].value.substr(cardNumber[0].value.length - 4) + ')';
                }
                shortInfo[i].textContent = shortBlockInfo;
            }
        }
        $('.collapse_wrapper_info[data-parent="' + element + '"]').show();

        // build short info for billing
        if (element === '#checkout_user') {
            if ($('input[name="diffShipping"]').prop('checked')) {
                shortInfo = $('.collapse_wrapper_billing_info span');
                for (i = 0; i < shortInfo.length; i++) {
                    if ($(shortInfo[i].dataset.selector).is("input")) {
                        shortInfo[i].textContent = $(shortInfo[i].dataset.selector).val();
                    } else {
                        shortInfo[i].textContent = $(shortInfo[i].dataset.selector).text();
                    }
                }
                $('.collapse_wrapper_billing_info').show();

            }
        }

    }
}

function disableCheckoutButton() {
    var checkoutButtonSelector;
    if ($('#sub_butt').length === 0) {
        checkoutButtonSelector = '#checkoutButton';
    } else {
        checkoutButtonSelector = '#sub_butt';
    }
    if (checkoutCheckAllTabs() || $('.warning_mess').length > 0) {
        $(checkoutButtonSelector).css({'pointer-events': 'none', 'background': '#b5babe'});
    } else {
        $(checkoutButtonSelector).removeAttr("style");
    }
}

function checkoutCheckTab(element, hideIcon = true) {
    // build selector for get tab field for validation
    var fieldsSelector;
    if (element == '#checkout_user') {
        if (ONEPAGE_ADDRESS_TYPE_POSITION === 'billing_shipping') {
            fieldsSelector = element + ' #billingAddress input, ' + element + ' #billingAddress select';
            if ($('input[name="diffShipping"]').prop('checked')) {
                fieldsSelector += ', ' + element + ' #shippingAddress input, ' + element + ' #shippingAddress select';
            }
        } else {
            fieldsSelector = element + ' #shippingAddress input, ' + element + ' #shippingAddress select';
            if ($('input[name="diffShipping"]').prop('checked')) {
                fieldsSelector += ', ' + element + ' #billingAddress input, ' + element + ' #billingAddress select';
            }
        }
    } else {
        fieldsSelector = element + ' input:checked';
    }

    // check tab fields for errors
    var checkFields = $(fieldsSelector);
    var existError = false;
    if (element == '#checkout_user') {
        for (var i = 0; i < checkFields.length; i++) {
            var fieldExistError = checkout.fieldErrorCheck($(checkFields[i]), true, hideIcon);
            if (fieldExistError) {
                existError = true;
            }
        }
    } else {
        if (checkFields.length === 1) {
            var hideIcon = true;
            if (element === '#checkout_payment') {
                var fields = $(fieldsSelector).closest('#checkout_payment').find('.paymentFields input');
            } else {
                var fields = $(fieldsSelector).closest('.shippingRow').find('.shipping_methods_block select, .shipping_methods_block input[type="text"]');
            }
            for (var i = 0; i < fields.length; i++) {
                existError = checkout.fieldErrorCheck($(fields[i]), true, true);
                if (existError) {
                    break;
                }
            }
            // Validation for stripe field
            checkFields.each(function (k,v) {
                if (v.id === 'radio_stripe') {
                    if ($('.paymentFields .StripeElement--complete').length < 3) {
                        existError = true;
                    }
                }
            });
        } else {
            existError = true;
        }
    }

    if (element === '#checkout_payment' && $('.payment-errors').text().length > 0) {
        existError = true;
    }

    return existError;
}

function checkoutCheckAllTabs() {
    var allCheckoutTabs = ['#checkout_user', '#checkout_shipping', '#checkout_payment'];
    var error = false;
    for (var i = 0; i < allCheckoutTabs.length; i++) {
        error = checkoutCheckTab(allCheckoutTabs[i]);
        if (error) {
            break;
        }
    }
    return error;
}

function validateCheckoutInput(evt)
{
    var theEvent = evt || window.event;

    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    var regex = /[0-9]|\./;

    // Limit for field with month number
    var monthLimit = false;
    if (theEvent.target.dataset.stripe == 'exp_month' || theEvent.target.name == 'cc_expires_month') {
        var value = theEvent.target.value + key;
        if (value > 12) {
            monthLimit = true;
        }
    }

    // Limit for field with year number
    var yearLimit = false;
    if (theEvent.target.dataset.stripe == 'exp_year' || theEvent.target.name == 'cc_expires_year') {
        var value = theEvent.target.value + key;
        var nowYear = new Date().getFullYear().toString().substr(-2);
        if (value.length > 1 && value < nowYear) {
            monthLimit = true;
        }
    }

    if( !regex.test(key) || monthLimit || yearLimit) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
}

function GetCardType(number)
{
    // visa
    var re = new RegExp("^4");
    if (number.match(re) != null)
        return "Visa";

    // Mastercard
    // Updated for Mastercard 2017 BINs expansion
    if (/^(5[1-5][0-9]{14}|2(22[1-9][0-9]{12}|2[3-9][0-9]{13}|[3-6][0-9]{14}|7[0-1][0-9]{13}|720[0-9]{12}))$/.test(number))
        return "Mastercard";

    // AMEX
    re = new RegExp("^3[47]");
    if (number.match(re) != null)
        return "AMEX";

    // Discover
    re = new RegExp("^(6011|622(12[6-9]|1[3-9][0-9]|[2-8][0-9]{2}|9[0-1][0-9]|92[0-5]|64[4-9])|65)");
    if (number.match(re) != null)
        return "Discover";

    // Diners
    re = new RegExp("^36");
    if (number.match(re) != null)
        return "Diners";

    // Diners - Carte Blanche
    re = new RegExp("^30[0-5]");
    if (number.match(re) != null)
        return "Diners - Carte Blanche";

    // JCB
    re = new RegExp("^35(2[89]|[3-8][0-9])");
    if (number.match(re) != null)
        return "JCB";

    // Visa Electron
    re = new RegExp("^(4026|417500|4508|4844|491(3|7))");
    if (number.match(re) != null)
        return "Visa Electron";

    return "";
}

/**
 * Uses in product page for show tabs
 * @param tab
 * @param tabId
 */
function openTab(tab, tabId) {
    if (TEMPLATE_NAME !== 'solo_home') {
        // Get all elements with class="tab-content-item" and hide them and del class active
        $('.tab-content-item').removeClass('active').hide();
        // Get all elements with class="tab-item" and remove the class "active"
        $('.tab-item').removeClass('active');
        // Show the current tab, and add an "active" class to the button that opened the tab
        $(tabId).addClass('active').show();
        $(tab).closest('.tab-item').addClass('active');
    } else {
        var parentBlock = $(tab).closest('.product_tabs');
        // Get all elements with class="tab-content-item" and hide them and del class active
        parentBlock.find('.tab-content-item').removeClass('active').hide();
        // Get all elements with class="tab-item" and remove the class "active"
        parentBlock.find('.tab-item').removeClass('active');
        // Show the current tab, and add an "active" class to the button that opened the tab
        $(tabId).addClass('active').show();
        $(tab).closest('.tab-item').addClass('active');

        $('.resize_block').each(function () {
            var h = $(this).prop('scrollHeight');
            if(h > 135) {
                $(this).next('.more_info').addClass('less').css('display', 'inline-block');
            }
        });
    }
}

function displayAttributesImages(color_id, currColId) {
    $.get('./includes/modules/additional_images2.php', {
        method: 'ajax',
        pid: jQuery("input[name=products_id]").val(),
        colid: color_id,
        col: currColId,
        tpl: $('#modal').val(),
        color_images: jQuery("#color_images").val()
    }, function (obj) {
        jQuery('.additional_images2').html(obj).promise().done(function () {
            var sync1 = $("#sync1");
            var isSyncedCarousels = $('#sync1_1').length ? true : false;
            var isNewSyncedCarousels = $('#product_big_slider').length ? true : false;

            $("#sync1 .lazyload, .additional_images2 .lazyload, #sync1_1 .lazyload, #product_big_slider .lazyload").lazyload();

            if (isSyncedCarousels && typeof syncedCarousel === 'function') {
                carouselClass = new syncedCarousel('#sync1_1', '#sync2');
            } else if (isNewSyncedCarousels && typeof syncedCarousel === 'function') {
                carouselClass = new syncedCarousel('#product_big_slider', '#product_small_slider');
            } else {
                $("#sync1").owlCarousel({
                    items: 1,
                    loop: true,
                    dots: true,
                    slideSpeed: 200,
                    nav: true,
                    navText: ['<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"></path></svg>', '<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg>'],
                    dotsContainer: '#sync2',
                    responsiveRefreshRate: 200
                });
            }
            if ((typeof carouselClass != "undefined" && typeof syncedCarousel != "undefined") && $('#modal').val()) {
                var sync1 = $('#sync1'), sync2 = $('#sync2');
                carouselClass = new syncedCarousel(sync1, sync2)
            }
        });
    });
}