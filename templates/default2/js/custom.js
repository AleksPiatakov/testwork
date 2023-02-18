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


$('.open-menu-xs').click(function (e) {
    $('body').toggleClass('no-scroll-y');
    $('.navbar-header').toggleClass('header-categories-animate');
    $(this).find('.fader').toggleClass('fader-menu-animate');
});
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

//arrow rotate mobile_menu
$('.button-main-cursor').click(function () {

    $(this).parent().find('.navbar-nav, .menu_information, .menu_manuf').toggleClass('open_menu');
    if ($(this).next().hasClass('open_menu')) {
        $(this).find('.fa').css('transform', 'rotate(90deg)');
    } else {
        $(this).find('.fa').css('transform', 'rotate(0)');
    }
});
$('.show-sub_ul .down').click(function () {
    $(this).parent().toggleClass('active');
    if ($(this).parents().hasClass('active')) {
        $(this).find('.fa').css('transform', 'rotate(90deg)');
    } else {
        $(this).find('.fa').css('transform', 'rotate(0)');
    }
});


function openSearchForm()
{
    if ($('.navbar-header .main_search_form').hasClass('search-form-open')) {
        closeSearchForm();
    } else {
        $('.navbar-header .main_search_form').addClass('search-form-open');
        $('.navbar-header #searchpr1').addClass('search-form-input-open').select();
        $('.navbar-header #search-form-button1').addClass('search-form-button-open');
        $('.navbar-header #search-form-button-close1').addClass('search-form-button-close-open');
        $('.search-form-fader').toggleClass('search-form-fader-open');
        $('body').addClass('modal-open');

        if (!$('#search-form-fader').hasClass('search-form-fader-open')) {
            $('#search-form-fader').addClass('search-form-fader-open');
        }
    }
}

function closeSearchForm()
{
    $('.navbar-header .main_search_form').removeClass('search-form-open');
    $('.navbar-header #searchpr1').removeClass('search-form-input-open');
    $('.navbar-header #search-form-button1').removeClass('search-form-button-open');
    $('.navbar-header #search-form-button-close1').removeClass('search-form-button-close-open');
    if ($('.mobile_menu.active_menu').length === 0) {
        $('body').removeClass('modal-open');
        $('#search-form-fader').removeClass('search-form-fader-open');
    }
}


//dropdown для логина + очистка полей
$('.dropdown-menu').click(function (e) {
    if (e.target === document.querySelector('.input_reset1')) {
        var val = $('input.name_enter').val();
        if (val.length >= 1) {
            $('input.name_enter').val('');
        }
    } else if (e.target === document.querySelector('.input_reset2')) {
        var val2 = $('input.password_enter').val();
        if (val2.length >= 1) {
            $('input.password_enter').val('');
        }
    }
    e.stopPropagation();
});
//слайдер на главной
// $("#owl-frontslider").owlCarousel({
//     items: 1,
//     nav: true,
//     lazyLoad: true,
//     loop:true,
//     video:true,
//     navText:['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
//     autoplay:true,
//     autoplayTimeout:4000,
//     dotsContainer: '#carousel-custom-dots',
//     autoplayHoverPause:true,
//     smartSpeed: 2000,
//     onInitialized:function () {$(".active .owl-video-play-icon").trigger("click");}, // autoplay video on slider load
//     onTranslated:function () {$(".active .owl-video-play-icon").trigger("click");} // autoplay video on change slide
//
// });
//слайдеры в левой колонке
$('#left_featured, #left_specials, #left_bestsellers, #left_whatsnew').owlCarousel({
    items: 1,
    nav: true,
    loop: true,
    navText: ['<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M231.293 473.899l19.799-19.799c4.686-4.686 4.686-12.284 0-16.971L70.393 256 251.092 74.87c4.686-4.686 4.686-12.284 0-16.971L231.293 38.1c-4.686-4.686-12.284-4.686-16.971 0L4.908 247.515c-4.686 4.686-4.686 12.284 0 16.971L214.322 473.9c4.687 4.686 12.285 4.686 16.971-.001z"></path></svg>', '<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M24.707 38.101L4.908 57.899c-4.686 4.686-4.686 12.284 0 16.971L185.607 256 4.908 437.13c-4.686 4.686-4.686 12.284 0 16.971L24.707 473.9c4.686 4.686 12.284 4.686 16.971 0l209.414-209.414c4.686-4.686 4.686-12.284 0-16.971L41.678 38.101c-4.687-4.687-12.285-4.687-16.971 0z"></path></svg>'],
    dots: true
});

//слайдер additional_images2

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
    var current = el.item.index;
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
        dots: true,
        loop: false,
        nav: false,
        responsiveRefreshRate: 700,
    }).on('changed.owl.carousel', this.syncPosition);
    this.sync2.on('initialized.owl.carousel', function () {
        syncclass.sync2.find(".owl-item").eq(0).addClass("current");
    });
    this.sync2OwlInstance = this.sync2.owlCarousel({
        items: this.slidesPerPage,
        dots: false,
        nav: true,
        smartSpeed: 700,
        slideSpeed: 700,
        margin: 0,
        navText: ['<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M231.293 473.899l19.799-19.799c4.686-4.686 4.686-12.284 0-16.971L70.393 256 251.092 74.87c4.686-4.686 4.686-12.284 0-16.971L231.293 38.1c-4.686-4.686-12.284-4.686-16.971 0L4.908 247.515c-4.686 4.686-4.686 12.284 0 16.971L214.322 473.9c4.687 4.686 12.285 4.686 16.971-.001z"></path></svg>', '<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M24.707 38.101L4.908 57.899c-4.686 4.686-4.686 12.284 0 16.971L185.607 256 4.908 437.13c-4.686 4.686-4.686 12.284 0 16.971L24.707 473.9c4.686 4.686 12.284 4.686 16.971 0l209.414-209.414c4.686-4.686 4.686-12.284 0-16.971L41.678 38.101c-4.687-4.687-12.285-4.687-16.971 0z"></path></svg>'],
        responsive: {
            0: {items: 3},
            991: {items: 3},
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
    // $("#product_small_slider .owl-next").on("click", function() {
    //
    //     var start = syncclass.sync2.find('.owl-item').first().index();
    //     var last = syncclass.sync2.find('.owl-item').last();
    //
    //     if(last.hasClass('active') && state === false) {
    //         // sync2.find('.owl-item').removeClass('active');
    //         syncclass.sync2.trigger('to.owl.carousel', [start, 100, true]);
    //     }
    //     state = false;
    // });
    // $("#product_small_slider .owl-prev").on("click", function() {
    //
    //     var end = sync2.find('.owl-item').last().index();
    //     var first = sync2.find('.owl-item').first();
    //
    //     if(first.hasClass('active' || 'current') && state === false) {
    //         // sync2.find('.owl-item').removeClass('active');
    //         sync2.trigger('to.owl.carousel', [end, 100, true]);
    //     }
    //     state = false;
    // });


};
//скролл отзывов на главной
$(".container_customer_reviews, .category .magazine_articles > div").overlayScrollbars({
    resize: "none"
});
//collapse для статьи на главной + при сокрытии контента добавление скролла
$(document).ready(function () {
    carouselClass = new syncedCarousel('#product_big_slider', '#product_small_slider');


    $('.read_more').click(function (e) {
        e.stopPropagation();

        var parent_block = $(".default_magazine_articles");

        var new_height = $(this).parent().prop('scrollHeight');
        var max_height = 2000;
        var correct_height;

        if ($(this).hasClass('less')) {
            $(this).removeClass('less').addClass('more').html(DEMO2_READ_MORE_UP);
            correct_height = (new_height > max_height) ? max_height : new_height;
            // console.log(correct_height);
            $(this).parent().animate({'height': correct_height}, 300, function () {
                parent_block.removeClass('shortcut');
                if (new_height > max_height) {
                    parent_block.addClass('add_scroll');
                    parent_block.overlayScrollbars({
                        resize: "none"
                    });
                }
            });
        } else {
            if (parent_block.hasClass('add_scroll')) {
                parent_block.overlayScrollbars().destroy();
                parent_block.removeClass('add_scroll');
            }
            $(this).addClass('less').removeClass('more').html(DEMO2_READ_MORE);
            $(this).parent().addClass('shortcut').animate({'height': '280px'});
        }
    });

});

//desktop выравниваем колонки категорий горизонтального меню
$(document).ready(function () {
    $.fn.equivalent = function () {
        //запишем значение jQuery выборки к которой будет применена эта функция в локальную переменную $blocks
        var $blocks = $(this),
            //примем за максимальную высоту - высоту первого блока в выборке и запишем ее в переменную maxH
            maxH = $blocks.eq(0).height();
        //делаем сравнение высоты каждого блока с максимальной
        $blocks.each(function () {
            maxH = ($(this).height() > maxH) ? $(this).height() : maxH;
        });
        //устанавливаем найденное максимальное значение высоты для каждого блока
        $blocks.height(maxH);

    };

    $(document).on('click', '#dropdown_menu_wrapper', function () {
        if ($('.block_categories').hasClass('show')) {
            $('#cat_fader').addClass('show');
        } else {
            $('#cat_fader').removeClass('show');
        }
    });
    $(document).on('click', '#cat_fader', function () {
        $('#cat_fader').removeClass('show');

    });
    $(document).on('mouseenter mouseleave', '.block_categories', function () {
        if (!$(this).hasClass('show')) {
            $('#cat_fader').toggleClass('show');
        }
    });


    var menu_timer = null;
    $('.block_categories').on('mouseenter', '.parent_li', function () {

        var $this = $(this);
        menu_timer = setTimeout(function () {
            if (!$this.hasClass('active')) {
                if ($this.parent('.first_list')) {
                    $this.parent('.first_list').removeClass('calc_height').css({
                        'height': 'auto',
                        'transition': '0.5s'
                    });
                }
                $this.closest('ul').find('.active ul').removeClass('calc_height').css('height', 'auto');
                $this.closest('ul').find('.active').removeClass('active');
                $this.addClass('active');
            }
            $this.parent('.first_list').addClass('calc_height');
            $this.find('ul:first').addClass('calc_height');
            $('.calc_height').equivalent();

        }, 500);
    }).on('mouseleave', '.parent_li', function () {
        clearTimeout(menu_timer);
    });

    $(document).on('change input', 'input.count', function () {
        var value = $(this).val();
        var buyButton = $(this).closest('.prod_card_calculation').find('.add2cart');
        var count = /^\d+$/.test(value) ? value : 1;
        buyButton.attr('data-qty', count);
        $(this).val(count);
        return false;
    });

    // Select language and currency
    $('.dropdown-language-currency a').click(function (e) {
        e.preventDefault();

        // $(this).parent('ul').find('a').removeClass('active');
        $(this).parent().find('a').removeClass('active');
        $(this).addClass('active');
    });

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












