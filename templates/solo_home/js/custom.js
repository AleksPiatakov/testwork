/*-------------*/
$('.contacts_info_footer > a, .section_top_footer > a').on('click', function (e) {
    e.preventDefault();
});
if ($(window).width() >= 768) {
    $('.contacts_info_footer > a, .section_top_footer > a').removeAttr('data-toggle');
}

$(window).resize(function () {
    if ($(window).width() >= 768) {
        $('.contacts_info_footer > a, .section_top_footer > a').removeAttr('data-toggle');
    } else {
        $('.contacts_info_footer > a, .section_top_footer > a').attr('data-toggle', 'collapse');
    }
});
var carouselClass;

function syncedCarousel(car1, car2)
{
    this.sync1 = $(car1);
    this.sync2 = $(car2);
    this.slidesPerPage = 1; //globaly define number of elements per page
    this.syncedSecondary = true;
    this.state = false;
    this.sync2OwlInstance;
    this.initCarousels();
}

syncedCarousel.prototype.syncPosition = function (el) {
    //if you set loop to false, you have to restore this next line
    // var current = el.item.index;

    //if you disable loop you have to comment this block
    var count = el.item.count - 1;
    var current = el.item.index - 1;
    // var current = Math.round(el.item.index - (el.item.count/2) - .5);

    if (current < 0) {
        current = count;
    }
    if (current > count) {
        current = 0;
    }

    //end block

    carouselClass.sync2.find(".owl-item").removeClass("current").eq(current).addClass("current");
    var onscreen = carouselClass.sync2.find('.owl-item.active').length - 1;
    var start = carouselClass.sync2.find('.owl-item.active').first().index();
    var end = carouselClass.sync2.find('.owl-item.active').last().index();

    if (current > end) {
        carouselClass.sync2.trigger('to.owl.carousel', [current, 100, true]);
    }
    if (current < start) {
        carouselClass.sync2.trigger('to.owl.carousel', [current - onscreen, 100, true]);
    }
};
syncedCarousel.prototype.syncPosition2 = function (el) {
    if (this.syncedSecondary) {
        var number = el.item.index;
        carouselClass.sync1.trigger('to.owl.carousel', [number, 100, true]);
    }
};
syncedCarousel.prototype.initCarousels = function () {
    var syncclass = this;

    this.sync1.owlCarousel({
        items: 1,
        slideSpeed: 2000,
        // autoplay: true,
        dots: true,
        loop: true,
        nav: true,
        navText: ['<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"></path></svg>', '<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg>'],
        responsiveRefreshRate: 200,
    }).on('changed.owl.carousel', this.syncPosition);

    this.sync2.on('initialized.owl.carousel', function (el) {
        syncclass.sync2.find(".owl-item").eq(0).addClass("current");

        var index_pos = el.page.size;
        var length = syncclass.sync2.find('.owl-item').length;

        var first_el = syncclass.sync2.find('.owl-item').first().index();
        var last_el = syncclass.sync2.find('.owl-item').last().index();


        $("#sync2 .owl-next").on("click", function (event) {
            ++index_pos;
            if (index_pos > length) {
                syncclass.sync2.trigger('to.owl.carousel', [first_el, 100, true]);
                index_pos = el.page.size;
            }
        });

        $("#sync2 .owl-prev").on("click", function () {
            --index_pos;
            if (index_pos < el.page.size) {
                syncclass.sync2.trigger('to.owl.carousel', [last_el, 100, true]);
                index_pos = length;
            }
        });

    });
    this.sync2OwlInstance = this.sync2.owlCarousel({
        items: this.slidesPerPage,
        dots: false,
        nav: true,
        smartSpeed: 200,
        slideSpeed: 500,
        navText: ['<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"></path></svg>', '<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg>'],
        responsive: {
            0: {items: 4},
            991: {items: 5},
            // 600:{items:4},
            // 768:{items:5}
        },
        slideBy: this.slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
    });
    this.sync2.on('changed.owl.carousel', this.syncPosition2);


    this.sync2.on("click", ".owl-item", function (e) {
        e.preventDefault();
        var number = $(this).index();
        syncclass.sync1.trigger('to.owl.carousel', [number, 100, true]);
    });
    this.sync2OwlInstance.on("changed.owl.carousel", function (e) {
        this.state = true;
    });
};


$(".slider_news").owlCarousel({
    // items: 4,
    // responsive:{0:{items:2},600:{items:5}},
    nav: true,
    dots: false,
    loop: true,
    lazyLoad: true,
    navText: ['<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"></path></svg>', '<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg>'],
    responsive: {
        0: {items: 1},
        500: {items: 2},
        600: {items: 3},
        700: {items: 4}
    },
    slideSpeed: 200
});
$("#manufacturers1 > div").owlCarousel({
    // items: 6,
    // responsive:{0:{items:2},600:{items:5}},
    nav: false,
    dots: false,
    loop: true,
    autoplay: true,
    autoplayHoverPause: true,
    responsive: {
        0: {items: 3},
        600: {items: 4},
        992: {items: 6},
        1200: {items: 6}
    },
    slideSpeed: 200
});

//сопряженные слайдеры на карточке продукта
$(document).ready(function () {
    carouselClass = new syncedCarousel('#sync1_1', '#sync2');
    //unveil all images
    $(".p_img_href>img").unveil();

    $('.owl-carousel:not(#owl-frontslider)').owlCarousel({});


    // подсчет кол-ва добавляемого товара

    $('.minus').click(function () {
        var $input = $(this).parent().find('input');
        var buyButton = $(this).parents('.count_buy').find('.add2cart');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        buyButton.attr('data-qty', count);
        $input.change();
        return false;
    });
    $('.plus').click(function () {
        var $input = $(this).parent().find('input');
        var buyButton = $(this).parents('.count_buy').find('.add2cart');
        var count = parseInt($input.val()) + 1;
        $input.val(count);
        buyButton.attr('data-qty', count);
        $input.change();
        return false;
    });

    $(document).on('change input', 'input.count', function () {
        var value = $(this).val();
        var buyButton = $(this).parents('.count_buy').find('.add2cart');
        var count = /^\d+$/.test(value) ? value : 1;
        buyButton.attr('data-qty', count);
        $(this).val(count);
        return false;
    });

    //плавный скрой к форме при нажатии "Ответить на коментарий"

    $("#ok").on("click", ".reply", function (event) {
        event.preventDefault();
        var reply_to_comment = $('#reply_to_comment'),
            top = $(reply_to_comment).offset().top;

        $('body, html').animate({scrollTop: top}, 1500);
    });

// показывать кнопку, если контейнер таба больше 135px

    $('.resize_block').each(function () {
        var h = $(this).prop('scrollHeight');
        if (h > 135) {
            $(this).next('.more_info').addClass('less').css('display', 'inline-block');
        }
    });
// показать/скрыть содержимое таба
    $('.more_info').click(function (e) {
        e.stopPropagation();

        var new_height = $(this).prev().prop('scrollHeight');
        // console.log(new_height);

        if ($(this).hasClass('less')) {
            $(this)
                .removeClass('less')
                .addClass('more')
                .text(HOME_LOAD_ROLL_UP);

            $(this).prev().animate({'height': new_height});
        } else {
            $(this).addClass('less').removeClass('more').text(HOME_LOAD_MORE_INFO);
            $(this).prev().animate({'height': '135px'});
        }
    });


// слайдеры в табах
    $('.mainpage-categories-tabs a[data-toggle="tab"]').on('show.bs.tab', function () {
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
            createSliderForCategoryTabs(fName, ajax_globals);
            // $('#'+fName+" img").width('100%'); //to make lazyload work properlty we need to set dimensions in pixels, and then return "100%" width as in css
            $('.tab-loader').addClass('hidden');

        }, 'json');
    });
    if ($('.mainpage-categories-tabs .tab-content .product_slider').length > 0) {
        var fName = $('.mainpage-categories-tabs .nav-tabs li.active a').data('file');
        $.get('/ajax_mainpage_tabs.php?fName=' + fName, function (data) {
            var firstTabId = $('.mainpage-categories-tabs .tab-content .product_slider').eq(0).attr('id');
            var ajax_globals = data['globals'];
            createSliderForCategoryTabs(firstTabId, ajax_globals);
        }, 'json');
    }

    //mobile menu

    //open mobile_menu
    $('.btn-mobile_menu').click(function () {
        //если в моб меню открыты вкладки, то при закрытии меню они закроются
        if ($('.mobile_menu').hasClass('active_menu')) {
            var open_collapse = $('.mobile_menu').find('.button-main-cursor');
            $(open_collapse).each(function () {
                if (!$(this).hasClass('collapsed')) {
                    $(this).addClass('collapsed').find('svg').css({'transform': 'rotate(0deg)', 'transition': '0.3s'});
                    $(this).next().collapse('hide');
                }
            });
        }
        $('.btn-mobile_menu').toggleClass('active_btn');
        $('.mobile_menu').toggleClass('active_menu');
        // $('#search-form-fader').toggleClass('search-form-fader-open');
        $('.splash').toggleClass('splash_open');
        $('body').css('overflow', 'hidden;');
    });
    //close search, mobile_menu
    $('#search-form-fader').click(function () {
        $('#search-form-fader').removeClass('search-form-fader-open');
        $('.btn-mobile_menu').removeClass('active_btn');
        $('.mobile_menu').removeClass('active_menu');
        $('body').css('overflow', 'visible;');
        closeSearchForm();
    });
    //arrow rotate mobile_menu

    if ($(window).width() >= 992) {
        $('.button-main-cursor').mouseenter(function () {

            $(this).parent().find('.wrapper_main_list, .menu_information, .menu_manuf').addClass('in open_menu');
            $('.overlay').on('click', function () {
                $('.wrapper_main_list').removeClass('in open_menu');
                $('.button-main-cursor').find('svg').css({'transform': 'rotate(0)', 'transition': '0.3s'});

            });
            if ($(this).next().hasClass('open_menu')) {
                $(this).find('svg').css({'transform': 'rotate(90deg)', 'transition': '0.3s'});
            } else {
                $(this).find('svg').css({'transform': 'rotate(0)', 'transition': '0.3s'});
            }
        });
        $('.sub_list .down, .sub1_list .down').click(function () {
            $(this).parent().toggleClass('active');
            if ($(this).parents().hasClass('active')) {
                $(this).find('svg').css({'transform': 'rotate(90deg)', 'transition': '0.3s'});
            } else {
                $(this).find('svg').css({'transform': 'rotate(0)', 'transition': '0.3s'});
            }
        });
    } else {
        $('.button-main-cursor').click(function () {

            $(this).parent('.new_nav-item').find('.wrapper_main_list, .menu_information, .menu_manuf').toggleClass('open_menu');
            if ($(this).next().hasClass('open_menu')) {
                $(this).find('svg').css({'transform': 'rotate(90deg)', 'transition': '0.3s'});
            } else {
                $(this).find('svg').css({'transform': 'rotate(0)', 'transition': '0.3s'});
            }
        });
        $('.sub_list .down, .sub1_list .down').click(function () {
            $(this).parent().toggleClass('active');
            if ($(this).parents().hasClass('active')) {
                $(this).find('svg').css({'transform': 'rotate(90deg)', 'transition': '0.3s'});
            } else {
                $(this).find('svg').css({'transform': 'rotate(0)', 'transition': '0.3s'});
            }
        });
    }

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
    }
});

function createSliderForCategoryTabs(fName, ajax_globals)
{
    // if (CATEGORIES_TABS_SLIDER) {
    $("#" + fName).owlCarousel({
        // items: 4,
        responsive: {
            0: {items: parseInt(12 / parseInt(ajax_globals.blocks_num.xs)), nav: true},
            600: {items: parseInt(12 / parseInt(ajax_globals.blocks_num.sm)), nav: true},
            992: {items: parseInt(12 / parseInt(ajax_globals.blocks_num.md)), nav: true, loop: true},
            1200: {items: parseInt(12 / parseInt(ajax_globals.blocks_num.lg)), nav: true, loop: true},
            1600: {items: parseInt(12 / parseInt(ajax_globals.blocks_num.xl)), nav: true, loop: true}
        },

        nav: true,
        loop: true,
        dots: false,
        navText: [
            '<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"></path></svg>', '<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg>'],
        slideSpeed: 200,
    });
    $("#" + fName).on('changed.owl.carousel', function (e) {
        $("#" + fName + " img").unveil(500);
    });
    $('#' + fName + " img").unveil(500);
    // }
}

function openSearchForm()
{
    if ($('.new_nav-wrapper .main_search_form').hasClass('search-form-open')) {
        closeSearchForm();
    } else {
        $('.new_nav-wrapper .main_search_form').addClass('search-form-open');
        $('.new_nav-wrapper #searchpr1').addClass('search-form-input-open').select();
        $('.new_nav-wrapper #search-form-button1').addClass('search-form-button-open');
        $('.new_nav-wrapper #search-form-button-close1').addClass('search-form-button-close-open');
        $('.search-form-fader').toggleClass('search-form-fader-open');
        $('body').css('overflow', 'hidden;');
        $('.add_navbar').css({'background': '#fff', 'transition': '.3s'});

        if (!$('#search-form-fader').hasClass('search-form-fader-open')) {
            $('#search-form-fader').addClass('search-form-fader-open');
        }
    }
}

function closeSearchForm()
{
    $('.new_nav-wrapper .main_search_form').removeClass('search-form-open');
    $('.new_nav-wrapper #searchpr1').removeClass('search-form-input-open');
    $('.new_nav-wrapper #search-form-button1').removeClass('search-form-button-open');
    $('.new_nav-wrapper #search-form-button-close1').removeClass('search-form-button-close-open');
    $('#search-form-fader').removeClass('search-form-fader-open');
    $('.add_navbar').css({'background': '#2b2b2b', 'transition': '.3s'});
    if ($('.mobile_menu.active_menu').length === 0) {
        $('body').css('overflow', 'visible;');
        $('.add_navbar').css({'background': '#2b2b2b', 'transition': '.3s'});
    }
}
