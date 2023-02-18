/****************************/
jQuery(document).ready(function () {

    $("#manufacturers2 > div").owlCarousel({
        // items: 6,
        // responsive:{0:{items:2},600:{items:5}},
        nav: false,
        dots: false,
        loop: true,
        autoplay: true,
        autoplayHoverPause: true,
        responsive: {
            0: {items: 4},
            600: {items: 4},
            992: {items: 6},
            1200: {items: 6}
        },
        slideSpeed: 200
    });
    $("#manufacturers2 img").lazyload();

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
