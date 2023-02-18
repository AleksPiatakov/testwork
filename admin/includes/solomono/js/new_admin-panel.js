$(document).ready(function () {

    $('.actions_menu .img_visible').on('click', function () {
        $(this).parents('li').addClass('hidden_cat');
    });
    $('.actions_menu .img_hidden').on('click', function () {
        $(this).parents('li').removeClass('hidden_cat');
    });


    $('.actions_left .img_visible, .settings_menu-left .img_visible').on('click', function () {
        if (  $(this).parents('.product_list_block').hasClass('move_left-product_list') ) {
            $(this).parents('.t_body').find('.img_cell img, .price_code_name-group, .actions_cell, .settings_menu-left').addClass('hidden_prod');
        }
        else {
            $(this).parents('.t_body').find('.label_cell, .actions_cell').addClass('hidden_prod');
        }
    });
    $('.actions_left .img_hidden, .settings_menu-left .img_hidden').on('click', function () {
        if (  $(this).parents('.product_list_block').hasClass('move_left-product_list') ) {
            $(this).parents('.t_body').find('.img_cell img, .price_code_name-group, .actions_cell, .settings_menu-left').removeClass('hidden_prod');
        }
        else {
            $(this).parents('.t_body').find('.label_cell, .actions_cell').removeClass('hidden_prod');
        }
    });

    $('.btn-move_left').on('click', function () {
        $(this).parents('.product_list_block').toggleClass('move_left-product_list');

        if ( $('.product_list_block').hasClass('move_left-product_list') ) {
            $('.variable_value').attr('disabled', true);
        }
        else {
            $('.variable_value').removeAttr('disabled', false);
        }
    });

     $('#tab_general textarea').overlayScrollbars({
        resize : "none",
    });


    $('.img_cell input:checkbox').click(function () {
        if ($('.img_cell input:checkbox:checked').length >= 1 ) {
            $('#check_checkbox').prop('checked', true);
        } else {
            $('#check_checkbox').prop('checked', false);
        }
    });
    $('#check_checkbox').click(function(){
        if ($(this).is(':checked')){
            $('.product_list .img_cell input:checkbox').prop('checked', true);
        } else {
            $('.product_list .img_cell input:checkbox').prop('checked', false);
        }
    });


    //
    // var $input = $('.qwe'),
    //     $buffer = $('.input-buffer');
    //
    // $input.on('input', function() {
    //     $buffer.text($input.val());
    //     $input.width($buffer.width());
    // });


});
