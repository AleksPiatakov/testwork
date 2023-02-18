/*-------------*/
jQuery('body').ready(function () {

    if ($(window).width() <= '768') {
        $('.section_top_footer .h3, .contacts_info_footer .h3, .subscribe_news .h3').click('click', function (event) {
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

    var typingTimer;
    //on keyup, start the countdown
    jQuery('body')
        .on('change', 'input[name="cart_quantity[]"]', function () {
            $(this).parent().next('.product_total').find('.refresh_total').css('opacity', '1');
            doneTyping();
        }).on('focus', 'input[name="cart_quantity[]"]', function () {
            $(this).select()
        });
    // jQuery('body')
    //     .on('change', 'input[name="cart_quantity[]"]', function(e) {
    //         $(this).click(function() {
    //             $(this).parent().next('.product_total').find('.refresh_total').css('opacity', '1');
    //             clearTimeout(typingTimer);
    //             typingTimer = setTimeout(doneTyping, 1000);
    //         });
    //     })
    //     .on('keyup', 'input[name="cart_quantity[]"]', function(e) {
    //         $(this).parent().next('.product_total').find('.refresh_total').css('opacity', '1');
    //         if (e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || e.keyCode == 8 || e.keyCode == 46 || e.keyCode == 16 || e.keyCode >= 37 && e.keyCode <= 40) {
    //             clearTimeout(typingTimer);
    //             typingTimer = setTimeout(doneTyping, 1000);
    //         }
    //     })
    //     .on('keydown', 'input[name="cart_quantity[]"]', function(e) {
    //         $(this).parent().next('.product_total').find('.refresh_total').css('opacity', '1');
    //         if (e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || e.keyCode == 8 || e.keyCode == 46 || e.keyCode == 16 || e.keyCode >= 37 && e.keyCode <= 40) {
    //             clearTimeout(typingTimer);
    //         }
    //     });

    //user is "finished typing," do something
    function doneTyping()
    {
        jQuery("#popup_cart_form").ajaxSubmit({
            target: '#modal_cart_popup .modal-body',
            success: showPopupResponse
        });
        $('.refresh_total').css('opacity', '0');
    }

    $('#shoprules').click(function (e) {
        var el = 'form[name=create_account] input[type=submit]';
        if (!$(el).hasClass('active_submit')) {
            $(el).addClass('active_submit');
        }
    });

    $('.open-menu-xs').click(function (e) {
        $('body').toggleClass('no-scroll-y');
        $('.header-categories').toggleClass('header-categories-animate');
        $(this).find('.fader').toggleClass('fader-menu-animate');
    });

    // function loaderStart() {
    //     $(this).parent().next('.product_total').find('.refresh_total').css('opacity', '1');
    //     console.log($(this).val());
    // }

    function wishlistCompare_xs(e)
    {
        if ($(e).parent().hasClass('wc-box-hovered')) {
            $(e).parent().removeClass('wc-box-hovered');
        } else {
            $(e).parent().addClass('wc-box-hovered');
        }
        // $(e).addClass('wc-box-hovered');
        console.log('opened');
    }


    if ($(window).width() <= 992) {
        $('#wishlist_box2').find('.wishlist-icon').click(function (e) {
            wishlistCompare_xs(this);
        });
        $('#compare_box').find('.compare-icon').click(function (e) {
            wishlistCompare_xs(this);
        });
    }


    $('[data-toggle="popover"]').on("click", function (e) {
        e.preventDefault();
    });

    $(".input_select_all").on("click", function () {
        $(this).select();
    });

    $('.stop_propagation').on('click', function (event) {
        event.stopPropagation();
    });

    $('.mainpage-categories-tabs a[data-toggle="tab"]').on('show.bs.tab', function () {
        // $('.mainpage-categories-tabs .tab-content').css('opacity','0.05');
        $('.tab-loader').removeClass('hidden');
        var fName = $(this).data('file');
        var tabHref = $(this).attr('href');
        var findWidthToUnveil;
        var html = '';
        $.get('/ajax_mainpage_tabs.php?fName=' + fName, function (data) {
            //from all html get only list of products to add and append them to #r_spisok
            var ajax_globals = data['globals']; // array with global variables and languages constants
            $.each(data, function (k, v) {
 // add array directly to html
                //find width to activate unveil in chrome
                if (v['product_image'] && !findWidthToUnveil) {
                    findWidthToUnveil = v['product_image'].split('&')[1].split('=')[1];
                }
                if (k != 'globals') {
                    html += draw_product_block(v, ajax_globals);
                }
            });
            $(tabHref).html('<div class="row row_catalog_products"><div id="' + fName + '">' + html + '</div></div>');

            if (findWidthToUnveil) {
                //  $('#'+fName+" img").width(findWidthToUnveil);
                findWidthToUnveil = 0;
            }
            // if (CATEGORIES_TABS_SLIDER) {
            createSliderForCategoryTabs(fName, ajax_globals);
            // }
            //  $('.mainpage-categories-tabs .tab-content').css('opacity','1');
            $('.tab-loader').addClass('hidden');
        }, 'json');

    });
    $('.quantity-selector-mask [name="cart_quantity"]').on('change', function () {
        $('.p_info_item >[name="cart_quantity"]').val($(this).val());
    });
    if ($('.mainpage-categories-tabs .tab-content .product_slider').length > 0) {
        var fName = $('.mainpage-categories-tabs .nav-tabs li.active a').data('file');
        $.get('/ajax_mainpage_tabs.php?fName=' + fName, function (data) {
            var firstTabId = $('.mainpage-categories-tabs .tab-content .product_slider').eq(0).attr('id');
            var ajax_globals = data['globals'];
            createSliderForCategoryTabs(firstTabId, ajax_globals);
        }, 'json');
    }


    // if (!LongScriptsLoaded) {
    //     $("head").append("<link href='../css/font-awesome.min.css' rel='stylesheet' type='text/css'>"); // font awesome
    // }

    $(document).on('change', '#show_coupon', function () {
        if ($(this).prop("checked")) {
            $(this).closest('.coupon_block').find('.set_coupon').slideDown(200);
        } else {
            $(this).closest('.coupon_block').find('.set_coupon').slideUp(200);
        }
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
    };

    $('.product_slider').on('mousedown', function(){
        $(this).addClass('dragged')
    }).on('mouseup', function(){
        $(this).removeClass('dragged')
    })

});

function createSliderForCategoryTabs(fName, ajax_globals)
{
    $("#" + fName).owlCarousel({
        items: 4,
        responsive: {
            0: {items: parseInt(12 / parseInt(ajax_globals.blocks_num.xs)), nav: true},
            768: {items: parseInt(12 / parseInt(ajax_globals.blocks_num.sm)), nav: true},
            992: {items: parseInt(12 / parseInt(ajax_globals.blocks_num.md)), nav: true, loop: true},
            1200: {items: parseInt(12 / parseInt(ajax_globals.blocks_num.lg)), nav: true, loop: true}
        },

        nav: true,
        loop: true,
        dots: false,
        navText: [
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M217.9 256L345 129c9.4-9.4 9.4-24.6 0-33.9-9.4-9.4-24.6-9.3-34 0L167 239c-9.1 9.1-9.3 23.7-.7 33.1L310.9 417c4.7 4.7 10.9 7 17 7s12.3-2.3 17-7c9.4-9.4 9.4-24.6 0-33.9L217.9 256z"></path></svg>'
            , '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M294.1 256L167 129c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.3 34 0L345 239c9.1 9.1 9.3 23.7.7 33.1L201.1 417c-4.7 4.7-10.9 7-17 7s-12.3-2.3-17-7c-9.4-9.4-9.4-24.6 0-33.9l127-127.1z"></path></svg>'],
        slideSpeed: 200,
    });
    $("#" + fName).on('changed.owl.carousel', function (e) {
        $("#" + fName + " img").unveil(0);
    });
    $('#' + fName + " img").unveil(0);
    $('#' + fName + " img").width('100%'); //to make lazyload work properlty we need to set dimensions in pixels, and then return "100%" width as in css
}

function openSearchForm()
{
    if ($('.main_search_form').hasClass('search-form-open')) {
        closeSearchForm();
    } else {
        $('.main_search_form').addClass('search-form-open');
        $('#searchpr,#searchpr1').addClass('search-form-input-open').select();
        $('#search-form-button').addClass('search-form-button-open');
        $('#search-form-button-close').addClass('search-form-button-close-open');
        $('.search-form-fader').toggleClass('search-form-fader-open');

        if (!$('#search-form-fader').hasClass('search-form-fader-open')) {
            $('#search-form-fader').addClass('search-form-fader-open');
        }
    }
}

function closeSearchForm()
{
    $('.main_search_form').removeClass('search-form-open');
    $('#searchpr,#searchpr1').removeClass('search-form-input-open');
    $('#search-form-button').removeClass('search-form-button-open');
    $('#search-form-button-close').removeClass('search-form-button-close-open');

    if ($('#search-form-fader').hasClass('search-form-fader-open')) {
        $('#search-form-fader').removeClass('search-form-fader-open');
    }
}






