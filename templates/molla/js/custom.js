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
$('.btn-mobile_menu').click(function (e) {
    $('.btn-mobile_menu').toggleClass('active_btn');
    $('.mobile_menu').toggleClass('active_menu');
    $('#search-form-fader').toggleClass('search-form-fader-open');
    $('body').toggleClass('modal-open');

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
$('.button-main-cursor').click(function (e) {
    $(this).parent('div').toggleClass('open_menu').find('.mob_cats_wrapper, .menu_information, .menu_manuf').slideToggle();
});

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
