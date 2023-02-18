if (typeof  syncedCarousel == "undefined") {
    var carouselClass;
    function syncedCarousel(car1, car2)
    {
        this.sync3 = $(car1);
        this.sync4 = $(car2);
        this.slidesPerPage = 1; //globaly define number of elements per page
        this.syncedSecondary = true;
        this.state = false;
        this.sync4OwlInstance;
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
            current = count;}
        if (current > count) {
            current = 0;}

        //end block

        carouselClass.sync4.find(".owl-item").removeClass("current").eq(current).addClass("current");
        var onscreen = carouselClass.sync4.find('.owl-item.active').length - 1;
        var start = carouselClass.sync4.find('.owl-item.active').first().index();
        var end = carouselClass.sync4.find('.owl-item.active').last().index();

        if (current > end) {
            carouselClass.sync4.trigger('to.owl.carousel', [current, 100, true]);
        }
        if (current < start) {
            carouselClass.sync4.trigger('to.owl.carousel', [current - onscreen, 100, true]);
        }
    };
    syncedCarousel.prototype.syncPosition2 = function (el) {
        if (this.syncedSecondary) {
            var number = el.item.index;
            carouselClass.sync3.trigger('to.owl.carousel', [number, 100, true]);
        }
    };
    syncedCarousel.prototype.initCarousels = function () {
        var syncclass = this;

        this.sync3.owlCarousel({
            items : 1,
            slideSpeed : 2000,
            // autoplay: true,
            dots: true,
            loop: true,
            nav:true,
            navText:['<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"></path></svg>','<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg>'],
            responsiveRefreshRate : 200,
        }).on('changed.owl.carousel', this.syncPosition);
        this.sync4.on('initialized.owl.carousel', function (el) {
            // syncclass.sync4.find(".owl-item").eq(0).addClass("current index_pos");
            syncclass.sync4.find(".owl-item").eq(0).addClass("current");

            var index_pos = el.page.size;
            var length = syncclass.sync4.find('.owl-item').length;

            var first_el = syncclass.sync4.find('.owl-item').first().index();
            var last_el = syncclass.sync4.find('.owl-item').last().index();


            $("#sync4 .owl-next").on("click", function (event) {
                ++index_pos;
                if (index_pos > length) {
                    syncclass.sync4.trigger('to.owl.carousel', [first_el, 100, true]);
                    index_pos = el.page.size;
                }
            });

            $("#sync4 .owl-prev").on("click", function () {
                --index_pos;
                if (index_pos < el.page.size) {
                    syncclass.sync4.trigger('to.owl.carousel', [last_el, 100, true]);
                    index_pos = length;
                }
            });

        });

        //hide nav if there are 3 product photo or less
        let hideNavIf3items = true;
        let prodPhotoCount = syncclass.sync3.find('.owl-item').length;
        if (prodPhotoCount <= 5) {
            hideNavIf3items = false;
        }
        //

        this.sync4OwlInstance = this.sync4.owlCarousel({
            items : this.slidesPerPage,
            dots: false,
            nav: hideNavIf3items,
            smartSpeed: 200,
            slideSpeed : 500,
            // loop: true,
            // navText: false,
            navText:['<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"></path></svg>','<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg>'],
            responsive:{
                0:{items:3, margin: 5},
                480:{margin: 10},
                991:{items:3},
                // 600:{items:4},
                // 768:{items:5}
            },
            slideBy: 1, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
        });
        this.sync4.on('changed.owl.carousel', this.syncPosition2);

        this.sync4.on("click", ".owl-item", function (e) {
            e.preventDefault();
            var number = $(this).index();
            syncclass.sync3.trigger('to.owl.carousel', [number, 100, true]);
        });
        this.sync4OwlInstance.on("changed.owl.carousel", function (e) {
            this.state = true;
        });
    };
}

$(document).on('click',".product-modal-button", function (e) {
    e.preventDefault();
    $.ajax({
        url: "ext/product_modal/product_modal.php",
        method: "get",
        data: {
            'product_href': $(this).parent().attr('href')
        },
        success: function (data) {
            let json = JSON.parse(data);
            modal({
                body: json.product.markup,
                title: json.product.products_name,

                width: 1140,
                freeShipping: json.product.products_free_ship,
                unique_styles: ['product_modal'],
            });

            $('.lazyload').addClass('anim');
            if (!$("body").find("#review_scripts_loaded").val()) {
                $("body").append("<input type='hidden' id = 'review_scripts_loaded' value = '1'>");
                $("body").append(json.product.comments.script);
            }

            $('select.select_attr_select').selectize({
                maxItems:1
            });
            $('.productModal-tabItem:first-child').click();

            // <Slider>


            // var sync3 = $('#sync3'), sync4 = $('#sync4');
            // carouselClass = new syncedCarousel(sync3, sync4);

            carouselClass = new syncedCarousel('#sync3','#sync4');

            // <Slider/>
            $('.actualPrice').addClass('new_price_card_product');
            $('.lazyload.anim').lazyload();
            calculate_sum($('.select_id_option:first'));
            if (typeof includeRecaptchaFile == 'function') {
                includeRecaptchaFile();
            }

        }

    })
});

$(".pagination pagination-sm").find("a").click(function (e) {
    e.preventDefault();
})

$('body').on('click','.productModal-tabItem',function (e) {
    e.preventDefault();
    $('.productModal-tabItem').removeClass('productModal-tabItem_active');
    $('.productModal-tabContent-Item').removeClass('productModal-tabContent-Item_active');

    $(this).addClass('productModal-tabItem_active');
    $($(this).attr('href')).addClass('productModal-tabContent-Item_active');
})


$("#modal_qty_input").on("input",function () {
    $(this).parent().find(".add2cart").attr("data-qty",$(this).val());
})
