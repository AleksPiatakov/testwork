var wishlistFlag = false;
var prodId = '', prodName = '', prodPrice = '', prodCatName = '';
jQuery(document).ready(function () {
    /* WISHLIST */
    $(document).on('click', '.wishlisht_button', function (event) {
        if (wishlistFlag) {
            return false;
        }
        wishlistFlag = true;
        event.preventDefault();

        var $data = $(this).data();
        var $text = $(this).find('label');
        var $input = $(this).find('input');
        $.ajax({
            url: './ext/wishlist/ajax_wishlist.php',
            type: 'POST',
            dataType: 'json',
            data: {
                request: 'wishlist',
                action: $input.is(':checked') ? 'delete' : 'add',
                id: $data.id
            },
            success: function (callback) {
                wishlistFlag = false;
                $text.html(callback.text);
                $input.is(':checked') ? $input.prop('checked', false) : $input.prop('checked', true);
                if ($input.is(':checked') && typeof doHookie != 'undefined') {
                    //prepare params for analytics
                    //product detail page
                    prodId = document.getElementById('products_id') ? document.getElementById('products_id').value : '';
                    prodName = $('.product_page .category_heading').text();
                    prodPrice = document.querySelector('input[name=prod_price_orign]') ? document.querySelector('input[name=prod_price_orign]').value : "";
                    prodCatName = document.querySelector('input[name=prod_category_name]') ? document.querySelector('input[name=prod_category_name]').value : "";
                    //others pages
                    prodId = prodId == '' ? $data.id : prodId;
                    prodPrice = prodPrice == '' ? callback.price : prodPrice;
                    prodName = prodName == '' ? callback.name : prodName;
                    prodCatName = prodCatName == '' ? callback.categoryName : prodCatName;
                    doHookie('add_to_wishlist');
                }
                $('[name="wishlist_' + $data.id + '"]').prop('checked',$input.is(':checked'));
                // Wishlish box
                $.get('./ext/wishlist/r_wishlist_box2.php', {
                    method: 'ajax',
                    wishlist_id: $data.id
                }, function (data2) {
                    //  if (data2 == '') $('#wishlist_box2').fadeOut(300);
                    //  else {
                    $('#wishlist_box2').replaceWith(data2);
                    //  if ($('#wishlist_box2').css('display') == 'none') $('#wishlist_box2').fadeIn(300);
                    //  }
                });
            }
        });
    });
    /* /WISHLIST */
});
