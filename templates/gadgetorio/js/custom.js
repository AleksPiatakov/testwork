/****************************/
jQuery('body').ready(function () {
    // init scrollbar
    function initScrollBar(selector, autoHide) {
        $(selector).each(function () {
            new SimpleBar($(this)[0], {
                autoHide: autoHide
            });
        });
    }

    // init categories slider
    $('#categories-slider').owlCarousel({
        loop: false,
        margin: 40,
        nav: true,
        navText: ['<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"></path></svg>', '<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg>'],
        pagination: false,
        responsive: {
            0: {
                items: 3
            },
            600: {
                items: 5
            },
            1000: {
                items: 7
            }
        }
    });

    // checking if slider is not too long to show the arrows (control)
    var wideSlider = $(".categories-mainpage");
    var sliderStage = wideSlider.find(".owl-stage").width();
    var sliderOuterStage = wideSlider.find(".owl-stage-outer").width();
    if (sliderStage <= sliderOuterStage) {
        wideSlider.find('.owl-controls').hide();
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

    $('.dropdown-submenu').click(function (e) {

    });

    function wishlistCompare_xs(e) {
        if ($(e).parent().hasClass('wc-box-hovered')) {
            $(e).parent().removeClass('wc-box-hovered');
        } else {
            $(e).parent().addClass('wc-box-hovered');
        }
    }


    // if ($(window).width() <= 992) {
    $(document).on('click', '#wishlist_box2 .wishlist-icon', function (e) {
        wishlistCompare_xs(this);
    });
    $(document).on('click', '#compare_box .compare-icon', function (e) {
        wishlistCompare_xs(this);
    });
    // }


    if ($(window).width() <= 767) {
        $('a.submenu.level-0').on('click', function (e) {
            e.preventDefault();

            $(this).next('.submenu-list').toggleClass('opened');
        });

        $('.section_top_footer .h3, .contacts_info_footer .h3, .subscribe_news .h3').click('click', function (event) {
            event.preventDefault();
            var arrow = $(this).parent().find('.toggle-xs');

            $(arrow.attr('data-target')).slideToggle(); // show or hide block

            arrow.toggleClass('open');
            $(this).toggleClass('openh3');
        });
    } else {
        if ($('form[name="cart_quantity"]').length != 0) {
            var productHeader = $('.p_header').offset().top;
            $(document).on("scroll", function () {
                if ($(document).scrollTop() > productHeader) {
                    $(".p_header").removeClass("p_header_rel").addClass("p_header_fix");
                    $("main").css('margin-top', '160px');
                } else {
                    if ($('.p_header').hasClass('p_header_fix')) {
                        $(".p_header").removeClass("p_header_fix").addClass("p_header_rel");
                        $("main").css('margin-top', 0);
                    }
                }
            });
        }
    }
    // if ($(window).width() > 767) {
    //
    //     if($('.p_header').length > 0) {
    //         var productHeader = $('.p_header');
    //         var productHeaderOffsetStatic = productHeader.offset().top;
    //         $(window).scroll(function() {
    //             var windowOffset = $(window).scrollTop();
    //             if (windowOffset >= (productHeaderOffsetStatic)) {
    //                 productHeader.addClass('small_header');
    //
    //                 productHeader.css({
    //                     "transform": "translateY("+ (windowOffset - productHeaderOffsetStatic) +"px)"
    //                 });
    //
    //             } else {
    //                 productHeader.removeClass('small_header');
    //                 productHeader.css({
    //                     "transform": "translateY(0px)"
    //                 });
    //             }
    //         });
    //     }
    // }

    $('.go-back-xs').on('click', function (e) {
        $(this).parent('div.submenu-list').removeClass('opened');
    });

    initScrollBar('.thumbs_row', 'false');

    $('.color_attributes input').on("click", function (e) {
        initScrollBar('.thumbs_row', 'false');
    });

    $('[data-toggle="popover"]').on("click", function (e) {
        e.preventDefault();
    });

    $(".input_select_all").on("click", function () {
        $(this).select();
    });

    $('.stop_propagation').on('click', function (e) {
        e.stopPropagation();
    });


    $('.mainpage-categories-tabs a[data-toggle="tab"]').on('show.bs.tab', function () {
        $('.mainpage-categories-tabs .tab-content').css('opacity', '0.05');
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
            $(tabHref).html('<div class="products-slider-block"><div class="row row_catalog_products"><div id="' + fName + '">' + html + '</div></div></div>');

            if (findWidthToUnveil) {
                //  $('#'+fName+" img").width(findWidthToUnveil);
                findWidthToUnveil = 0;
            }
            createSliderForCategoryTabs(fName, ajax_globals);

            $('.mainpage-categories-tabs .tab-content').css('opacity', '1');
            $('.tab-loader').addClass('hidden');

        }, 'json');

    });
    $('.quantity-selector-mask>input.qty').on('change input', function () {
        $('.p_info_item>[name="cart_quantity"]').val($(this).val());
    });
    if ($('.mainpage-categories-tabs .tab-content .product_slider').length > 0) {
        var fName = $('.mainpage-categories-tabs .nav-tabs li.active a').data('file');
        $.get('/ajax_mainpage_tabs.php?fName=' + fName, function (data) {
            var firstTabId = $('.mainpage-categories-tabs .tab-content .product_slider').eq(0).attr('id');
            var ajax_globals = data['globals'];
            createSliderForCategoryTabs(firstTabId, ajax_globals);
        }, 'json');
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

function createSliderForCategoryTabs(fName, ajax_globals) {
    $("#" + fName).owlCarousel({
        items: 4,
        responsive: {
            0: {items: ajax_globals.blocks_num.xs, nav: true},
            600: {items: ajax_globals.blocks_num.sm, nav: true},
            1000: {items: 4, nav: true, loop: true}
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
        $("#" + fName + " img").unveil(500);
    });
    $('#' + fName + " img").unveil(500);
    $('#' + fName + " img").width('100%'); //to make lazyload work properlty we need to set dimensions in pixels, and then return "100%" width as in css
}

//on keyup, start the countdown
var typingTimer;
jQuery('body')
    .on('change', 'input[name="cart_quantity[]"]', function (e) {
        $(this).click(function () {
            $(this).parent().next('.product_total').find('.refresh_total').css('opacity', '1');
            clearTimeout(typingTimer);
            typingTimer = setTimeout(doneTyping, 1000);
        });
    })
    .on('keyup', 'input[name="cart_quantity[]"]', function (e) {
        $(this).parent().next('.product_total').find('.refresh_total').css('opacity', '1');
        if (e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || e.keyCode == 8 || e.keyCode == 46 || e.keyCode == 16 || e.keyCode >= 37 && e.keyCode <= 40) {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(doneTyping, 1000);
        }
    })
    .on('keydown', 'input[name="cart_quantity[]"]', function (e) {
        $(this).parent().next('.product_total').find('.refresh_total').css('opacity', '1');
        if (e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode >= 96 && e.keyCode <= 105 || e.keyCode == 8 || e.keyCode == 46 || e.keyCode == 16 || e.keyCode >= 37 && e.keyCode <= 40) {
            clearTimeout(typingTimer);
        }
    });

//user is "finished typing," do something
function doneTyping() {
    jQuery("#popup_cart_form").ajaxSubmit({
        target: '#modal_cart_popup .modal-body',
        success: showPopupResponse
    });
    $('.refresh_total').css('opacity', '0');
}

$(document).ready(function () {
    $('select[name="currency"]').selectize({
        hideSelected: true,
        maxItems: 1,
        dropdownDirection: "up"

    });
});
Selectize.define('dropdown_direction', function (options) {
    var self = this;
    options = $.extend({
        direction: self.settings.dropdownDirection || 'auto'
    }, options);

    /**
     * Calculates and applies the appropriate position of the dropdown.
     *
     * Supports dropdownDirection up, down and auto. In case menu can't be fitted it's
     * height is limited to don't fall out of display.
     */
    this.positionDropdown = (function () {
        return function () {
            var $control = this.$control;
            var $dropdown = this.$dropdown;
            var p = getPositions();

            // direction
            var direction = getDropdownDirection(p);
            if (direction === 'up') {
                $dropdown.addClass('direction-up').removeClass('direction-down');
            } else {
                $dropdown.addClass('direction-down').removeClass('direction-up');
            }
            $control.attr('data-dropdown-direction', direction);

            // position
            var isParentBody = this.settings.dropdownParent === 'body';
            var offset = isParentBody ? $control.offset() : $control.position();
            var fittedHeight;

            switch (direction) {
                case 'up':
                    offset.top -= p.dropdown.height;
                    if (p.dropdown.height > p.control.above) {
                        fittedHeight = p.control.above - 15;
                    }
                    break;

                case 'down':
                    offset.top += p.control.height;
                    if (p.dropdown.height > p.control.below) {
                        fittedHeight = p.control.below - 15;
                    }
                    break;
            }

            if (fittedHeight) {
                this.$dropdown_content.css({'max-height': fittedHeight});
            }

            this.$dropdown.css({
                width: $control.outerWidth(),
                top: offset.top,
                left: offset.left
            });
        };
    })();

    /**
     * Gets direction to display dropdown in. Either up or down.
     */
    function getDropdownDirection(positions) {
        // var direction = self.settings.dropdownDirection;
        var direction = options.direction;

        if (direction === 'auto') {
            // down if dropdown fits
            if (positions.control.below > positions.dropdown.height) {
                direction = 'down';
            }
            // otherwise direction with most space
            else {
                direction = (positions.control.above > positions.control.below) ? 'up' : 'down';
            }
        }

        return direction;
    }

    /**
     * Get position information for the control and dropdown element.
     */
    function getPositions() {
        var $control = self.$control;
        var $window = $(window);

        var control_height = $control.outerHeight(false);
        var control_above = $control.offset().top - $window.scrollTop();
        var control_below = $window.height() - control_above - control_height;

        var dropdown_height = self.$dropdown.outerHeight(false);

        return {
            control: {
                height: control_height,
                above: control_above,
                below: control_below
            },
            dropdown: {
                height: dropdown_height
            }
        };
    }
});
