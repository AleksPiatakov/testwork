/****************************/
if ($(window).width() <= '768') {
    $('.section_top_footer .h3, .contacts_info_footer .h3').click('click', function (event) {
        event.preventDefault();
        var arrow = $(this).parent().find('.toggle-xs');
        var h3 = $(this);

        $(arrow.attr('data-target')).slideToggle(); // show or hide block

        if (arrow.hasClass('open')) {
            arrow.removeClass('open');
            h3.removeClass('openh3');
        } else {
            arrow.addClass('open');
            h3.addClass('openh3');
        }
    });
}

//open mobile_menu
function openMenu() {
    $('.btn-mobile_menu').toggleClass('active_btn');
    $('.mobile_menu').toggleClass('active_menu');
    $('#search-form-fader').toggleClass('search-form-fader-open');
    $('body').toggleClass('modal-open');

    if ($('body').attr("data-cpath") != '') {
        $('.block_categories .mob_cats_wrapper.accordion').css("display", "block");
    }
}
$('.btn-mobile_menu').click(function (e) {
    openMenu();
});
//close search, mobile_menu
$('#search-form-fader').click(function (e) {
    $('#search-form-fader').removeClass('search-form-fader-open');
    $('.btn-mobile_menu').removeClass('active_btn');
    $('.mobile_menu').removeClass('active_menu');
    $('body').removeClass('modal-open');
    closeSearchForm();
});

//open mobile catalogs
function openMobCat(el){
    $(el).parent().toggleClass('open_menu').find('.mob_cats_wrapper, .menu_information, .menu_manuf').slideToggle();
}
$('.button-main-cursor').click(function (e) {
    //$(this).parent('div').toggleClass('open_menu').find('.mob_cats_wrapper, .menu_information, .menu_manuf').slideToggle();
    openMobCat(this);
});
//Show all categories
//check device if mobile
if(IS_MOBILE) {
    $('.show_all').click(function () {
        let el = $('.block_categories').children('.button-main-cursor');
        openMenu();
        openMobCat(el);
    });
}

function openSearchForm()
{
    if ($('.mobile_header .main_search_form').hasClass('search-form-open')) {
        closeSearchForm();
    } else {
        $('.mobile_header .main_search_form').addClass('search-form-open');
        $('.mobile_header #searchpr1').addClass('search-form-input-open').select();
        $('.mobile_header #search-form-button1').addClass('search-form-button-open');
        $('.mobile_header #search-form-button-close1').addClass('search-form-button-close-open');
        $('.search-form-fader').toggleClass('search-form-fader-open');
        $('body').addClass('modal-open');

        if (!$('#search-form-fader').hasClass('search-form-fader-open')) {
            $('#search-form-fader').addClass('search-form-fader-open');
        }
    }
}

function closeSearchForm()
{
    $('.mobile_header .main_search_form').removeClass('search-form-open');
    $('.mobile_header #searchpr1').removeClass('search-form-input-open');
    $('.mobile_header #search-form-button1').removeClass('search-form-button-open');
    $('.mobile_header #search-form-button-close1').removeClass('search-form-button-close-open');
    if ($('.mobile_menu.active_menu').length === 0) {
        $('body').removeClass('modal-open');
        $('#search-form-fader').removeClass('search-form-fader-open');
    }
}

$(document).ready(() => {
    $(document).on('change', '#show_coupon', function () {
        if ($(this).prop("checked")) {
            $(this).closest('.coupon_block').find('.set_coupon').slideDown(200);
        } else {
            $(this).closest('.coupon_block').find('.set_coupon').slideUp(200);
        }
    });
});

$(document).on('click', '.proceed_btn ', function () {
    var collapse_wrapper = $(this).closest('.collapse_wrapper');
    collapse_wrapper.removeClass('open');
    collapse_wrapper.find('.edit_block').fadeIn();

    if (typeof checkout !== 'undefined') {
        checkoutCollapsedTab(this.dataset.target, false);
    }
    // allow submit if no errors
    disableCheckoutButton();

    if (!collapse_wrapper.next('.collapse_wrapper').hasClass('open')) {
        collapse_wrapper.next('.collapse_wrapper').find('.collapse_wrapper_info').hide();
        collapse_wrapper.next('.collapse_wrapper').addClass('open');
        collapse_wrapper.next('.collapse_wrapper').find('.collapse').collapse('show');
        collapse_wrapper.next('.collapse_wrapper').find('.edit_block').fadeOut();
    }
});

$(document).on('click', '.edit_block ', function () {
    $('.collapse_wrapper_info[data-parent="' + this.dataset.target + '"]').hide();
    $('.collapse_wrapper_billing_info[data-parent="' + this.dataset.target + '"]').hide();

    var collapse_wrapper = $(this).closest('.collapse_wrapper');

    collapse_wrapper.addClass('open');
    collapse_wrapper.find('.edit_block').fadeOut();
});

if ($('.mob_short_cart').length > 0) {
    $('.checkout_scroll').on('click', function () {
        var bottom = $('.terms_of_use').offset().top;
        $('body, html').animate({scrollTop: bottom}, 1500);
    });
    $(document).on("scroll", function () {
        if ($(window).scrollTop() == $(document).height() - $(window).height()) {
            $('.mob_short_cart').fadeOut(200);
        } else {
            $('.mob_short_cart').fadeIn(200);
        }
    });
}

if ($(window).width() <= '768') {
    $('#shippingAddress .form-group').on('click', function () {
        $('#shippingAddress .form-group .error_icon').removeClass('d-none');
        $(this).children('.error_icon').toggleClass('d-none');
    });
}
