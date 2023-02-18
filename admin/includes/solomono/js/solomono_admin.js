var option = getGetParams();
var timeout = null;
var widthOfModal = null;

$(document).ready(function () {
    if (localStorage.getItem('needCreateCriticalCss') == "1") {
        showCriticalWindow(1);
    }

    $(document).on("click", ".admin-answer-button", (e) => e.preventDefault());
    //custom panel
    $(document).mouseup(function (e) {
        var collapse_block = $('.custom_panel_block .collapse_li');
        // console.log(collapse_block)
        if (!collapse_block.is(e.target) && collapse_block.has(e.target).length === 0) {
            collapse_block.find('.drop_menu.in').collapse('hide');
            collapse_block.find('.collapse_btn').addClass('collapsed');
        }
    });
    //QTY PRO
    //update attribute_combination
    $('#qtypro :button[data-value="update_attribute_combination"]').on('click', function () {
        var block = $(this).closest('tr');
        var params = [];
        block.find('[data-name]').each(function () {
            params[params.length] = $(this).data('name') + '=' + $(this).data('value')
        });
        params[params.length] = 'quantity=' + block.find('input[name="qty"]').val();
        params[params.length] = 'combination_price=' + block.find('input[name="combination_price"]').val();
        params[params.length] = 'vendor_code=' + block.find('input[name="vendor_code"]').val();
        params[params.length] = 'product_id=' + $('[name=product_id]').val();
        params[params.length] = 'action=insert_attribute_combination';
        $.get($('[name="href"]').val() + '?' + params.join('&'));
    });
    //delete attribute_combination
    $('#qtypro :button[data-value="delete_attribute_combination"]').on('click', function () {
        var block = $(this).closest('tr');
        var params = [];
        block.find('[data-name]').each(function () {
            params[params.length] = $(this).data('name') + '=' + $(this).data('value')
        });
        params[params.length] = 'quantity=' + block.find('input[name="qty"]').val();
        params[params.length] = 'combination_price=' + block.find('input[name="combination_price"]').val();
        params[params.length] = 'product_id=' + $('[name=product_id]').val();
        params[params.length] = 'action=delete_attribute_combination';
        $.get($('[name="href"]').val() + '?' + params.join('&'));
        block.remove();
    });
    //insert new attribute_combination
    $('#qtypro :button[data-value="insert_attribute_combination"]').on('click', function () {
        var params = $(this).attr('name') + '=' + $(this).data('value') + '&' + $('#qtypro input').serialize() + '&' + $('#qtypro select').serialize();
        $.get($('[name="href"]').val() + '?' + params, null, function (resp) {
            // location.href = location.href;
            location.reload();
        });
    });
    //END QTY PRO

    $(document).on('click', '.open_custom_panel_btn', function () {
        if ($('.custom_panel_block').hasClass('visible')) {
            $('.custom_panel_fader').removeClass('visible');
            $('.custom_panel_block .collapse_btn').addClass('collapsed');
            $('.custom_panel_block .drop_menu.in').collapse('hide');
            $('.custom_panel_block').removeClass('visible');
            $('.open_custom_panel_btn').addClass('anim');
        } else {
            $('.custom_panel_block').addClass('visible');
            $('.open_custom_panel_btn').removeClass('anim');
        }
    });
    $(document).on('click', '.custom_panel_close', function () {
        $('.custom_panel_block').removeClass('visible');
        $('.custom_panel_fader').removeClass('visible');
        $('.custom_panel_block .collapse_btn').addClass('collapsed');
        $('.custom_panel_block .drop_menu.in').collapse('hide');
        $('.open_custom_panel_btn').addClass('anim');
    });

    $('#change_pass').on('click', function (e) {
        e.preventDefault();
        $.get($(this).attr('href'), function (response) {
            modal({
                title: response.title,
                body: response.html,
                after: function (modal) {
                    var form = $(modal).find('form');
                    form.on('click', 'input[type="submit"]', function (e) {
                        var id = form.find('input[name="id"]').val();
                        e.preventDefault();
                        var formData = new FormData(form.get(0));
                        $.ajax({
                            url: form.attr('action'),
                            type: form.attr('method'),
                            dataType: 'json',
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                $(modal).modal('hide');
                                show_tooltip(response['msg'], 9999999,$('body'),true);
                            }
                        });
                    })
                }
            })
        }, "json");
    });

    $('body').on('focus', '.datepicker', function () {
        $(this).datepicker({
            showOtherMonths: true,
            selectOtherMonths: true,
            dateFormat: 'yy-mm-dd'
        });
    });

    // Saves block state in database
    $(document).on("click", ".collapse_link", function() {
        var url = window.location.origin + adminFolder+"/ajax_hide_block.php";
        $.ajax({
            url: url,
            type: "POST",
            data: {hide_block_id: this.hash, hide_block_value: $(this).hasClass("collapsed")?"hide":"show"}
        });
    });

    //---for all---//
    $('body').on('click', '#own_table .edit_row,#add,.admin-answer-button,.reviews_item_bottom', getForm);

    $('body').on('click', '#own_table .del_link', function () {
        var param = {
            msg: lang.all.TEXT_MODAL_CONFIRMATION_ACTION
        };
        var param_update = {};
        var $this = $(this), id = $this.closest('tr').data('id'), action = $this.data('action');

        if ($this.data('ajax')) {
            $.ajax({
                url: window.location.pathname,
                type: 'POST',
                data: {id: id, action: 'check'},
                success: function (data) {
                    console.log(data);
                    var params = JSON.parse(data);
                    if (params.msg) {
                        param_update = {
                            msg: params.msg
                        }
                    }
                },
                dataType: "json",
                async: false
            });
        }


        $.extend(param, param_update)

        var body = '<form>';
        body += '<p>' + param.msg + '</p>';
        body += '<input type="hidden" name="id" value="' + id + '">';
        if (['delete_articles', 'delete_products_description'].includes(action) && option.tPath !== undefined) {
            body += '<input type="hidden" name="tPath" value="' + option.tPath + '">';
        }
        body += '<input type="hidden" name="action" value="' + action + '">';
        if ($this.data('input')) {
            var matches = $this.data('input').match(/(.+)_(.+)/);
            body += '<p>' + lang.currentPage.TEXT_INFO_RESTOCK_PRODUCT_QUANTITY + '</p>';
            body += '<p><input type="' + matches[1] + '" name="' + matches[2] + '"></p>';
        }
        body += '<button type="button" class="btn btn-default" data-dismiss="modal">' + lang.all.TEXT_MODAL_CANCEL_ACTION + '</button>';
        body += '<button type="submit" class="btn btn-danger btn-confirm">OK</button>';
        body += '</form>';
        modal({
            id: 'confirm-delete',
            title: lang.all.TEXT_MODAL_CONFIRM_ACTION,
            body: body,
            width: '50%',
            after: function (modal) {
                $(modal).on('click', 'button.btn-confirm', function (e) {
                    e.preventDefault();
                    var form = $(modal).find('form');
                    var data = form.serializeArray();
                    $.post(window.location.pathname, data, function (msg) {
                        if (msg['success']) {
                            if ($this.closest('tbody').find('tr').length == 1) {
                                delete(option.count);
                                if (option.page == 1) {
                                    option.page = 1;
                                } else {
                                    option.page = option.page - 1;
                                }
                            }
                            $this.closest('tr').remove();
                            $('#own_pagination').pagination('selectPage', option.page);
                        }
                        $(modal).modal('hide');
                        var time = msg['time'] || 1500;
                        show_tooltip(msg['msg'], time);
                    }, "json");
                })
            }
        });
    });

    //---- Sidebar ----- //
    // var boxWidth = $('.app-header-fixed #aside .aside-wrap').width();
    // if(boxWidth > 55 && boxWidth < 65 ){
    // 	triggerMenuItem('close');
    // }
    //
    // $('#close-menu').on('click',function(e){
    //     $('nav.navi>ul>li>a').show();
    //     $('nav.navi>ul>li>ul>li').show();
    //     $('nav.navi>ul>li>ul').removeAttr('style');
    //     e.preventDefault();
    // 	collapsLeftMenu();
    // });
    // var el = $('#aside div:first');
    // $('#open-menu,nav ul li.item-menu').on('click',function(e){
    // 	$('#close-menu').show();
    // 	$('#open-menu').hide();
    // 	if(el.hasClass('collapse-menu')){
    // 		el.removeClass('collapse-menu');
    // 	}
    // 	if($(this).is('#open-menu')){
    // 		triggerMenuItem('open');
    // 	}else{
    // 		$('#aside ul.nav-sub').find('li._active').attr('class', 'active');
    // 		$('#aside ul.nav').find('li._active').attr('class', '');
    // 	}
    //
    // 	$('.menu-form div.menu_search_form').css({'display':'inline-block'});
    // 	if($(window).width()<= 1499){
    // 		$('.app-header-fixed #aside .aside-wrap').addClass('min-collapse-menu');
    // 	};
    // 	$('body').removeClass('wrap-collapse-menu');
    // 	$('#content.app-content').addClass('wrap-collapse-menu-id');
    // 	$('.wrapper_home_menu .block_home_menu').addClass('block_home_menu-id');
    // 	setTooltipForMenu();
    // 	$.get('ajax_set_menu_location.php?action=set_menu_location&value=1');
    // });

    // setTooltipForMenu();
    //--------------------------//

    $('select#per_page option[value="' + option.perPage + '"]').prop("selected", true);
    $('select#manufacturers option[value="' + option.manufacturersId + '"]').prop("selected", true);
    $('select#category option[value="' + option.categoryId + '"]').prop("selected", true);
    $('#specials').prop("checked", (option.onlySpecials == 'yes') ? true : false);

    $('#manufacturers').on('change', function () {
        option.manufacturersId = $(this).val();
        option.page = 1;
        $('#own_pagination').pagination('selectPage', option.page);
    });

    $('#specials').on('change', function () {
        option.onlySpecials = $(this).is(':checked') ? 'yes' : 'no';
        option.page = 1;
        $('#own_pagination').pagination('selectPage', option.page);
    });

    $('body').on('click', '#own_table >thead>tr>th>i.fa', function () {
        var $this = $(this);
        $this.removeClass('fa-sort');
        if ($this.hasClass("fa-sort-desc")) {
            $this.removeClass('fa-sort-desc').addClass('fa-sort-asc');
        } else if ($this.hasClass("fa-sort-asc")) {
            $this.removeClass('fa-sort-asc').addClass('fa-sort');
        } else {
            $this.removeClass('fa-sort-asc').addClass('fa-sort-desc');
        }
        field = $this.parent('th').data('table');
        sort = $this.attr('class').match(/sort-(asc|desc)/);
        if (sort) {
            option.order = field + '-' + sort[1];
        } else {
            delete(option.order);
        }
        option.page = 1;
        $('#own_pagination').pagination('selectPage', option.page);
    });

    $('body').on('click', '.quick_updates_table th i.fa', function () {
        var $this = $(this);
        $this.removeClass('fa-sort');

        if ($this.hasClass("fa-sort-desc")) {
            $this.removeClass('fa-sort-desc').addClass('fa-sort-asc');
        } else if ($this.hasClass("fa-sort-asc")) {
            $this.removeClass('fa-sort-asc').addClass('fa-sort');
        } else {
            $this.removeClass('fa-sort-asc').addClass('fa-sort-desc');
        }
    });


    var locseach = location.search.substr(1);
    var href = new URLSearchParams(location.href);
    var show_sort = locseach.match('sort_by');
    if (show_sort) {
        var correct_class = href.get('sort_by').split(' ').shift();
        correct_class = correct_class.replace(".", "_");

        if (locseach.match(/(desc)/)){
            $('.quick_updates_table .' + correct_class + ' a').removeClass('active');
            $('.quick_updates_table .' + correct_class + ' a.sort_asc').addClass('active');
        } else if (locseach.match(/(asc)/)) {
            $('.quick_updates_table .' + correct_class + ' a').removeClass('active');
            $('.quick_updates_table .' + correct_class + ' a.sort_default').addClass('active');
        }
    } else {
        $('.quick_updates_table th a').removeClass('active');
        $('.sort_desc').addClass('active');
    }



    $('body').on('change', '#own_table .status input', function () {
        var data = {};
        var id = $(this).attr('id').match(/[0-9]+/)[0];
        var field = $(this).parents('td').attr('data-name');
        var status = $(this).prop('checked');
        if (!checkAllStatus($(this), status)) return;
        if (status == true) {
            status = 1;
        } else {
            status = 0;
        }
        data[field] = status;
        data['status'] = status;
        data['field'] = field;
        data['id'] = id;
        $.ajax({
            url: window.location.href,
            type: "POST",
            data: data,
            dataType: 'json',
            success: function (response) {
                show_tooltip(response.msg, 500);
            }
        });
    });

    if ($('#own_pagination').length != 0) {

        renderData('show');

        $('#own_pagination').pagination('selectPage', option.page);
    }

    $('body').on('click', '#debug>div >h3', function () {
        $(this).next().slideToggle(400);
    });
    $('body').on('click', '#debug i.fa-bug', function () {
        $(this).parent().toggleClass('active');
        $(this).toggleClass('active').next().slideToggle(300);
    });

    $('body').on('change', 'select#per_page', function () {
        option.perPage = $(this).val();
        option.page = 1;
        delete(option.count);
        $('#own_pagination').pagination('selectPage', option.page);
    });


    $('body').on('input', '#own_table >thead>tr>th>input.search', function () {
        filterTable($(this).parents('thead'));
    });

    $('body').on('change', '#own_table >thead>tr>th>select.search', function () {
        filterTable($(this).parents('thead'));
    });

    // $('body').on('mouseenter', '#own_table', function () {
    //     $('[data-toggle="tooltip"]').tooltip();
    // });
    // $('body').on('mouseenter', '.fa-question-circle', function () {
    //     $('[data-toggle="tooltip"]').tooltip({
    //         container: 'body',
    //         html:true,
    //         offset: 20
    //     });
    // });

    //открыто всегда только 1 меню
    $(document).on('click', 'header .collapse_btn, #new_settings_menu .collapse_btn', function (e) {
        var collapse_btn = $('header .collapse_btn, #new_settings_menu .collapse_btn');
        collapse_btn.each(function () {
            if(!$(this).hasClass('collapsed')){
                $('header').find('.open_btn').removeClass('open_btn');
                $(this).next('ul').collapse('hide');
            }
        });
        $(this).toggleClass('open_btn');
        // $(this).next('ul').collapse();
        $(this).next('ul').on('shown.bs.collapse',function () {
            var height_ul = $(this).prop('scrollHeight');
            $(this).css('height', height_ul);
        });

    });
    //скрываем открытые меню, если таргет на в нем
    $(document).mouseup(function (e){
        var collapse_block = $('header .header_drop_menu');
        if (!collapse_block.is(e.target) && collapse_block.has(e.target).length === 0) {
            collapse_block.find('ul').collapse('hide');
            collapse_block.find('.open_btn').removeClass('open_btn');
        }
    });
    renderCustomizationPanel();


    $(document).on('change', '.status input[type="checkbox"]', function () {
        if ($(this).prop("checked")) {
            $(this).closest('li').addClass('active');
        } else {
            $(this).closest('li').removeClass('active');
        }
    });

    $(document).on('change', '.load_file',function(e) {
        if ($(this).val() !=='') {
            addFileToList($(this).val());
            $(this).closest('.actions').find('.green_btn').attr('disabled', false);
        }
    });
    function addFileToList(val){
        var fileName = val.split('\\');
        val = fileName[fileName.length-1];
        $('#replacement_block').addClass('file_selected').html('<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="#fff" d="M435.848 83.466L172.804 346.51l-96.652-96.652c-4.686-4.686-12.284-4.686-16.971 0l-28.284 28.284c-4.686 4.686-4.686 12.284 0 16.971l133.421 133.421c4.686 4.686 12.284 4.686 16.971 0l299.813-299.813c4.686-4.686 4.686-12.284 0-16.971l-28.284-28.284c-4.686-4.686-12.284-4.686-16.97 0z"></path></svg>' + val);
    }

    $('form.header_search_form').on('click',function(e){
        console.log(e.target)
        $(this).addClass('open');
        $(this).find('input').focus();
    });
    $('.header_search_form input').on('blur',function(e){
        if($(this).val() == '') {
            $(this).closest('.header_search_form').removeClass('open');
        }
    });

    $('.menu-cats.tree li.item-menu-cat').each(function (i,el){
        var active_child = $(this).find('.sub_menu-cat li.active');
        if(active_child.length > 0){
            $(this).addClass('active');
        }
    });

    $(document).on('click', '.jsChangeStatus' , function () {
        var value = $(this).val();
        if (value === 'false') {
            $(this).val('true');
        } else {
            $(this).val('false');
        }
    });

});
$(document).on('click','.start-generate-critical',function(){
    $('.critical-text').hide();
    $('.critical-process').show();
    $(this).hide();
    $('.critical-layout').show();
    $.ajax({
        url: './ajax_generate_critical_css.php',
        type: 'get',
        dataType: 'json',
        success: function (response) {
            if(response.success){
                $('.critical-layout').hide();
                setAndShowCriticalWindow(0);
           }
       }
   });
});

//render data
function renderData($url_show) {
    $('#own_pagination').pagination({
        onPageClick: function (pageNum, e) {
            option.page = pageNum;

            for (var key in option) { //in view
                if (option[key] === undefined || option[key] == '') {
                    delete option[key];
                }
            }

            if ($('#own_table').hasClass('inner_loader')) {
                $('#own_table').after('<div class="ajax_load">' + '<span class="spin"></span>' + '<span>' + lang.all.TEXT_WAIT + '</span>' + '</div>');
            } else {
                $('#own_table').addClass('inner_loader').after('<div class="ajax_load">' + '<span class="spin"></span>' + '<span>' + lang.all.TEXT_WAIT + '</span>' + '</div>');
            }

            $.ajax({
                url: window.location.pathname + '?ajax_load=' + $url_show,
                type: "GET",
                dataType: 'json',
                data: option,
                success: function (response) {
                    if (response['modal']) {
                        getForm();
                    }
                    var link = '';
                    for (var key in option) {
                        if (key == 'search' || key == 'count') continue;
                        link += '&' + key + '=' + option[key];
                    }
                    link = link.replace("&", "?");
                    window.history.pushState(null, null, window.location.pathname + link);

                    $('.ajax_load').remove();
                    var paginate = response.paginate;
                    var data = response.data;
                    var allowed_fields = response.allowed_fields;
                    var show = '';
                    var buttonAction = $('#action').clone().removeAttr('style').html();
                    if ($('input[name="number_of_rows"]')) {
                        $('input[name="number_of_rows"]').val(paginate['count'])
                    }
                    $('input[name="page"]').val(paginate['current_page']);
                    option['count'] = paginate['count'];
                    var count_product = paginate['count'];
                    $('#count_prod').text(count_product);
                    if (data != null) {
                        var cnt_data = data.length;
                        for (var i = 0; i < cnt_data; i++) {
                            var style = (data[i]['background-color'] != "undefined") ? 'style="background-color:' + data[i]['background-color'] + '1a' + '"' : '';
                            show += '<tr ' + style + ' data-id="' + data[i]['id'] + '">';
                            for (var field in allowed_fields) {
                                if (allowed_fields[field]['show'] === false) continue;
                                var className = allowed_fields[field]['class'] != undefined ? 'class="' + allowed_fields[field]['class'] + '"' : '';
                                show += '<td ' + className + ' data-name="' + field + '" data-label="' + $('th[data-table=' + field + ']')[0].childNodes[0].textContent.trim() + '">';
                                if (field == 'status' || allowed_fields[field]['type'] == 'status') {
                                    var check = data[i][field] == 1 ? 'checked' : '';
                                    var id = field + '_' + data[i]['id'];
                                    show += '<div class="status">';
                                    show += '<input class="cmn-toggle cmn-toggle-round" type="checkbox" id="cmn-toggle-' + id + '"' + check + '>';
                                    show += '<label for="cmn-toggle-' + id + '"></label>';
                                    show += '</div>';
                                } else if (allowed_fields[field]['type'] == 'file' || allowed_fields[field]['general'] == 'file') {
                                    if (data[i][field] == null || data[i][field].length == 0) {
                                        show += '<img src="/images/default.png">';
                                    } else {
                                        show += '<img src="/getimage/' + data[i][field] + '">';
                                    }
                                } else if (allowed_fields[field]['change'] == true) {
                                    params = allowed_fields[field]['params'] !== undefined ? allowed_fields[field]['params'] : '';
                                    show += '<span class="change">' +
                                        '<input class="' + allowed_fields[field]['class'] + '"' + params + ' data-old="' + data[i][field] + '" name="' + field + '" type="' + allowed_fields[field]['type'] + '" value="' + data[i][field] + '"></span>';
                                } else if (allowed_fields[field]['type'] == 'select' && typeof (table_option) !== 'undefined') {
                                    show += '<span data-value="' + data[i][field] + '">' + table_option[field][data[i][field]] + '</span>';
                                } else if (field == 'dynamic') {
                                    show += '<input type="' + allowed_fields[field]['type'] + '">';
                                } else if (data[i][field] == undefined) {
                                    show += '<div class="text-center">-</div>';
                                } else if (allowed_fields[field]['type'] == 'link') {
                                    show += '<a href="customers.php?id=' + data[i]['cid'] + '&action=edit_customers">' + data[i][field] + '</a>';
                                } else {
                                    show += data[i][field];
                                }
                                show += '</td>';
                            }
                            //  buttonAction = buttonAction.replace("data-title=","data-title='#"+data[i]['id']+"'");
                            show += buttonAction ? ('<td>' + buttonAction.replace("data-title=","data-title='#"+data[i]['id']+"'").replace('answer_reviews&amp;id=&amp;products_id=', 'answer_reviews&id='+data[i]['id'] + '&products_id=' + data[i]['products_id']) + '</td>') : '';
                            show += '/tr>';
                        }
                        $('#own_pagination').pagination('updateItems', response['paginate']['total']);
                        $('#own_table >tbody').empty().append(show);
                    } else {
                        $('#own_table >tbody').empty();
                        $('#own_pagination').pagination('updateItems', 1);
                        show_tooltip('empty');
                    }
                    if (response['debug'] != undefined) {
                        show = '';
                        for (var key in response['debug']) {
                            if (typeof response['debug'][key] === 'object') {
                                show += '<h3>' + key + '</h3><pre>' + dump(response['debug'][key]) + '</pre>';
                            } else {
                                show += '<h3>' + key + '</h3>' + response['debug'][key];
                            }
                        }
                        $('#debug').remove();
                        $('<div id="debug"><i class="fa fa-bug fa-lg" aria-hidden="true"></i><div>' + show + '</div></div>').insertAfter($('#own_pagination'));
                    }
                    checkShowMoreBtnStatus();
                }
            });
        }
    });
}

function filterTable($thead) {
    option.search = {};
    option.page = 1;
    delete(option.count);
    var $filters = $($thead).find('input.search');
    $filters.each(function (i, e) {
        var key = $(e).parent('th').data('table');
        option.search[key] = e.value;
    });

    var $filters_select = $($thead).find('select.search');
    $filters_select.each(function (i, e) {
        var key = $(e).parent('th').data('table_select');
        option.search[key] = e.value;
        option[key] = e.value;
    });

    if (timeout) clearTimeout(timeout);
    timeout = setTimeout(function () {
        $('#own_pagination').pagination('selectPage', option.page);
    }, 300);

}

function checkAllStatus(obg, status) {
    if (obg.parents('td').hasClass("check_all")) {
        obg.parents('table').find('.check_all input').prop('checked', false);
        obg.prop('checked', true);
        if (status == false) return false;
    }
    return true;
}

function modal(options) {
    var settings = {
        id: Math.floor(Math.random() * (1000 - 1 + 1)) + 1,
        after: function () {
        },
        width: 0,
        before: function () {
        },
        hidden: function () {
        }
    }

    $.extend(true, settings, options);
    var width = '';
    if (settings.width != 0) width = 'style="width:auto;max-width:' + settings.width + '"';

    var customModalContent = '';
    var bodyId = $(settings.body).find('input[name="id"]').val();
    if (bodyId == '23' || bodyId == '24' || bodyId == '30' || bodyId == '35' || bodyId == '36') {
        customModalContent = 'style="max-width:900px;margin:0 auto;"'
        width = 'style="width: auto; max-width: 900px; margin-top: 10px;"'
    }

    // if ($('.modal').length == 0) {
        var $html = '<div class="modal fade" id="modal_' + settings.id + '" tabindex="-1" role="dialog" aria-labelledby="' + settings.id + '_label" aria-hidden="true">';
        $html += '<div class="modal-dialog" ' + width + '><div class="modal-content" ' + customModalContent + '>';
        $html += '<div class="modal-header">';
        $html += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
        if (settings.title) {
            $html += '<h4 class="modal-title" id="modal_' + settings.id + '_label">' + settings.title + '</h4>';
        }
        $html += '</div>';
        $html += '<div class="modal-body">' + settings.body + '</div>\
        </div>\
      </div>\
      </div>';
        $('body').append($html).promise().done(function () {
            var $modal = $('#modal_' + settings.id);
            var $before = settings.before($modal);
            if ($before !== false) {
                if (settings.classes) {
                    $modal.addClass(settings.classes);
                }

                if (settings.title == null) {
                    $modal.addClass('no-title');
                }

                if ($modal.hasClass('valign-false') == false) {
                    centerModal($modal);
                }
                $modal.on('hidden.bs.modal', function (e) {
                    $modal.remove();
                    if (settings.hidden) {
                        settings.hidden($modal);
                    }
                });
                $modal.on('shown.bs.modal', function (e) {
                    /*---for ckeditor in mozilla  ----*/
                    $(document).off('focusin.modal');
                    if (settings.after) {
                        settings.after($modal);
                    }
                });
                $modal.modal();

            } else {
                $modal.remove();
            }

        });
    // }

}

function centerModal(el) {
    $(el).css('display', 'block');
    var $dialog = $(el).find(".modal-dialog");
    var offset = ($(window).height() - $dialog.height()) / 2;
    var bottomMargin = $dialog.css('marginBottom');
    bottomMargin = parseInt(bottomMargin);
    if (offset < bottomMargin) offset = bottomMargin;

    $dialog.css("margin-top", "10px");
    //$dialog.css("margin-top", offset);
}

function removeTooltip(e) {
    $(e).closest('.tooltip_own').remove();
}

function show_tooltip(message, time, element, close) {
    close = close == true ? '<span onclick="removeTooltip(this)" class="close">X</span>' : '';
    time = time || 1500;
    element = element || $('body');
    element.prepend('<p class="tooltip_own">' + message + close + '</p>');
    setTimeout(function () {
        $('.tooltip_own').animate({opacity: 0}, time, function () {
            $(this).remove();
        });
    }, time)
}

function dump(v, s) {
    s = s || 1;
    var t = '';
    switch (typeof v) {
        case "object":
            t += "\n";
            for (var i in v) {
                t += Array(s).join(" ") + i + ": ";
                t += dump(v[i], s + 3);
            }
            break;
        default: //number, string, boolean, null, undefined
            t += v + " (" + typeof v + ")\n";
            break;
    }
    return t;
}

function getGetParams() {
    var search = window.location.search.substr(1),
        keys = {
            page: 1,
            perPage: 25
        };
    search.split('&').forEach(function (item) {
        item = item.split('=');
        keys[item[0]] = item[1];
    });
    return keys;
}

function delGetParams(Url, Prm) {
    var a = Url.split('?');
    var result = a[0];
    var str = a[1];
    Prm.forEach(function (item, i, arr) {
        var re = new RegExp('(\\?|&)' + item + '=[^&]+', 'g');
        str = ('?' + str).replace(re, '');
        str = str.replace(/^&|\?/, '');
    });
    return result + str == '' ? '' : '?' + str;
}

function changeLang() {
    var $langId = $(this).children('a').data('lang');
    var modalBody = $(this).parents('.modal-body');
    $(this).parent().find('li.active').removeClass('active');
    $(this).addClass('active');
    modalBody.find('form div[data-lang], .modal_form_container div[data-lang]').removeClass('active');
    modalBody.find('form div[data-lang="' + $langId + '"], .modal_form_container div[data-lang="' + $langId + '"]').addClass('active');
}

function getForm(e) {
    if (e) e.preventDefault();
    var data = {};
    var $this = $(this);
    $('.modal').removeClass('fade');
    //close opened modal before you will open new
    if (window.location.pathname.indexOf('modules.php') == -1) {
        $('[data-dismiss="modal"]').click();
    }
    var url = $this.attr('href') ? $this.attr('href') : window.location.href;
    //get hash
    var hash = url.split('#')[1];
    //remove #something
    url = url.split('#')[0];
    var title = $this.data('title') || $this.closest('tr').find('td[data-name=articles_name]').text() || lang.currentPage.HEADING_TITLE;
    if (url.indexOf('template_configuration.php') != -1) {
        title += ' "' + $this.closest('tr').find('td[data-name=template_name]').text() + '"';
    }
    data.action = $this.data('action');
    if (data.action == 'edit_template') {
        widthOfModal = '90%';
    }
    //if isset and not empty var module and it not exist in url
    if (typeof module !== 'undefined' && module && url.indexOf('module=') == -1) {
        data.module = module;
    }
    if ($this.hasClass('edit_row')) {
        data.id = $this.closest('tr').attr('data-id');
    }
    if ($this.hasClass('check_options_values')) {
        data.id = $this.closest('tr').attr('data-id');
    }
    var link = '';
    for (var key in data) {
        if (data[key] === undefined) continue;
        link += '&' + key + '=' + data[key];
    }

    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('id') && lang.currentPage.HEADING_FORM_TITLE) {
        title = lang.currentPage.HEADING_FORM_TITLE
    }

    //store hash for reload page
    if (hash && window.location.pathname.indexOf('modules.php')) {
        link += '#' + hash;
    }

    $.ajax({
        url: url,
        type: "GET",
        data: data,
        dataType: 'json',
        success: function (response) {
            $('.tooltip_own').remove();
            window.history.pushState(null, null, url + link);
            modal({
                title: response.title ? response.title : title,
                body: response.html,
                id: 'form',
                width: (widthOfModal != undefined) ? widthOfModal : '90%',
                before: function () {
                    ckFinderBuilder();
                },
                hidden: function (modal) {
                    var str = delGetParams(url, ['action', 'id']);
                    delete(option.action);
                    delete(option.id);
                    //use hash to stay at right tab
                    var hash = window.location.href.split('#') ? window.location.href.split('#')[1] : false;
                    if(hash) str += '#' + hash;
                    window.history.pushState(null, null, str);
                },
                after: function (modal) {
                    var form = $(modal).find('form');
                    var lang = $(modal).find('ul#lang>li');
                    var del_file = $(modal).find('form button .fa-trash-o');
                    del_file.on('click', delFile);
                    lang.on('click', changeLang);
                    if (location.hash) $('a[href=' + location.hash + ']').click();
                    form.on('click', 'input[type="submit"]', function (e) {
                        //$('[contenteditable]').remove();
                        e.preventDefault();
                        if (checkRequired(form)) {
                            var id = form.find('input[name="id"]').val();
                            var formData = new FormData(form.get(0));
                            $.ajax({
                                url: form.attr('action'),
                                type: form.attr('method'),
                                dataType: 'json',
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function (response) {
                                    $('.tooltip_own').remove();
                                    delete(option.action);
                                    delete(option.id);
                                    $(modal).modal('hide');
                                    if (response.success == true) {
                                        delete(option.count);
                                        $('#own_pagination').pagination('selectPage', option.page);
                                    } else if (response.link !== undefined && response['msg'] !== undefined) {
                                        show_tooltip(response['msg'], 1500);
                                        setTimeout(function () {
                                            window.location.href = response.link
                                        }, 1500);
                                    } else if (response.link !== undefined) {
                                        window.location.href = response.link;
                                    } else if (response.html) {
                                        getForm();
                                    } else {
                                        show_tooltip(response['msg']);
                                    }
                                }
                            });
                        }
                    });
                    form.on('click', 'button.saveInputData', function (e) {
                        e.preventDefault();
                        if (checkRequired(form)) {
                            var $this = $(this),
                                id = form.find('input[name="id"]').val(),
                                thisUrl = form.attr('action'),
                                formData = new FormData(form.get(0));
                            if (id) thisUrl = thisUrl.replace('insert_', 'update_');
                            $this.attr('disabled', 'disabled');
                            $.ajax({
                                url: thisUrl,
                                type: form.attr('method'),
                                dataType: 'json',
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function (response) {
                                    $('.tooltip_own').remove();
                                    show_tooltip(response['msg']);
                                    if (response['id']) {
                                        form.append('<input type="hidden" name="id" value="' + response['id'] + '">');
                                        thisUrl = thisUrl.replace('insert_', 'update_');
                                        form.attr('action', thisUrl);
                                    }
                                    $this.prop("disabled", false);
                                }
                            });
                        }
                    });
                    $(modal).find('form .active[data-lang] .form-group:first .form-control').focus();
                }
            });
            // activate language tabs for attributes
            $('#attributes-tabs').tabs({fx: {opacity: 'toggle', duration: 'fast'}});
        }
    });
}

function checkRequired(form) {
    var error = true;
    form.find('[required]').each(function (i) {
        if (!($(this).val())) {
            error = false;
            $(this).addClass('error');
        } else {
            $(this).removeClass('error')
        }
    });
    return error;
}

function ckFinderBuilder() {
    var textarea = $('textarea.ck_replacer');

    if (textarea.length !== 0) {
        $('.modal').removeAttr('tabindex');

        textarea.each(function (i, e) {
            var editor = CKEDITOR.replace($(e).attr('name'), {
                extraPlugins: 'colorbutton,font,showblocks,justify,codemirror,btgrid',
                startupFocus: false,
                height: '400px',
                removePlugins: 'sourcearea',
                on: {
                    instanceReady: function() {
                        this.dataProcessor.htmlFilter.addRules( {
                            elements: {
                                img: function( el ) {
                                    // Add an attribute.
                                    if ( !el.attributes.alt )
                                        el.attributes.alt = '';
                                    // Add some class.
                                    if (typeof el.attributes.class === 'undefined' || el.attributes.class.indexOf('img-responsive') == -1){
                                        el.addClass( ' img-responsive' );
                                    }
                                    if (typeof el.attributes.class === 'undefined' || el.attributes.class.indexOf('lazyload') == -1){
                                        el.addClass( ' lazyload' );
                                    }
                                    // el.attributes.style = '' ;
                                }
                            }
                        });
                    }
                }
            });
            editor.on('change', function (evt) {
                $(e).text(evt.editor.getData());
            });
            CKFinder.setupCKEditor(editor, 'includes/ckfinder/');
        });
    }

}

function tableOption(params) {
    //file: template_configuration
    var o = {
        arr: null,
        id: null,
        name: null,
        ajax_url: window.location.pathname,
        hide: function (e) {
            e.hide();
        },
        show: function (e) {
            e.show();
        },
        remove: function (e) {
            e.remove();
        },
        onChange: function (element) {
            element.change(function (event) {
                var selected = $(this).find(':selected'), val = selected.val(), text = selected.text();
                o.data = {val: val, name: o.name, id: o.id, text: text};
                o.sendAjax(o.data);
                o.remove($linkWrapper);
                o.show($this);
            });
        },
        ajaxSuccess: function () {
            $this.replaceWith('<span data-value="' + o.data.val + '">' + o.data.text + '</span>');
        },
        ajaxError: function () {

        },
        onInit: function () {
            // Callback triggered immediately after initialization
        },
        drawOption: function (arr) {

            for (var val in arr) {
                var selected = val == val_id ? 'selected' : '';
                show += '<option ' + selected + ' value="' + val + '">' + arr[val] + '</option>';
            }
            return show;
        },
        sendAjax: function (data) {
            $.ajax({
                url: o.ajax_url + '?action=change_' + o.name,
                type: "POST",
                data: data,
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    show_tooltip(response.msg, 500);
                    if (response.result) {
                        o.ajaxSuccess();
                    } else {
                        o.ajaxError();
                    }
                }
            });
        }
    };
    $.extend(true, o, params);
    var $this = $(this), val_id = $this.data('value'), td = $this.parent(), show, $linkWrapper = $('<select></select>');
    o.onInit();
    o.hide($this);

    show = o.drawOption(o.arr[o.name]);

    $linkWrapper.addClass('form-control');

    o.onChange($linkWrapper);

    $linkWrapper.append(show);
    td.append($linkWrapper);
}

function delFile(e) {
    e.preventDefault();
    var $this = $(this);
    var $divBlock = $this.closest('div');
    var ID = $('form input[name="id"]').val();
    var field_name = $divBlock.find('input[type="file"]').attr('name');
    $.ajax({
        url: window.location.pathname,
        type: "POST",
        data: {ID: ID, field_name: field_name, action: 'delete_image'},
        dataType: 'json',
        success: function (response) {
            $divBlock.find('img').remove();
            $divBlock.find('#image_name').remove();
            $divBlock.find('span').show();
            $divBlock.find('button').remove();

        }
    });
}

function scrollToElement(element){
    var $el = jQuery(element);
    if ($el.length) {
        var $elOffset_top = $el.offset().top - 200;
        jQuery('body,html').stop(false, false).animate({scrollTop: $elOffset_top}, {
            duration: 600,
            easing: 'swing'
        }, 800);
    }
}

// function setTooltipForMenu(){
//     if($(window).width()<= 767){
//         return true;
//     }
//     var boxWidth = $('.app-header-fixed #aside .aside-wrap').width();
//     if(boxWidth > 55 && boxWidth < 65 ){
//         $('#aside li.item-menu').tooltip({
//             items:'[data-title]',
//             content: function(){
//                 return 	$(this).attr( "data-title" );
//             },
//             position: {
//                 my: "left",
//                 at: "left+70",
//                 collision: "none",
//                 //of:'.item-menu',
//                 using: function(position, feedback){
//                     var tooltip = $(this);
//                     tooltip.css({
//                         border: 'none',
//                         textTransform: 'none',
//                         minWidth: '120px',
//                         maxWidth: '120px',
//                         height: '31px',
//                         boxShadow: '0 5px 10px 0 rgba(0, 0, 0, 0.1)',
//                         backgroundColor: '#2d3343',
//                         color: '#fff',
//                         fontSize: '13px'
//                     })
//                     tooltip.css(position);
//                     tooltip.addClass("arrow-tt111").appendTo(tooltip);
//                 }
//             }
//         });
//     }else{
//         try{
//             $('#aside li.item-menu').tooltip('destroy');
//         }catch(e){
//             return true;
//         }
//     }
// }

// function triggerMenuItem(action,event){
//     if(action == 'close'){
//         $('#aside li.active').find('ul.nav-sub').css('display', 'none');
//         $('#aside li.active').map(function(idx, el){
//             $(el).removeClass('active').addClass('_active');
//         });
//     }else{
//         $('#aside li._active').map(function(idx, el){
//             $(el).removeClass('_active').addClass('active');
//         });
//         $('#aside li.active').find('ul.nav-sub').css('display', 'block');
//
//     }
//     return true;
// }

// function collapsLeftMenu() {
//     if($(window).width()<= 767){
//         $('.app-header-fixed #aside').removeClass('off-screen');
// 		$('#overflow_admin').removeClass('overflow_admin-open');
// 		$('body').removeClass('modal-open')
//         return false;
//     }
//     $('#close-menu').hide();
//     $('#open-menu').show();
//     $('.app-header-fixed #aside div.fix-width').addClass('collapse-menu');
//     $('.app-header-fixed #aside .aside-wrap').removeClass('min-collapse-menu');
//     $('body').addClass('wrap-collapse-menu');
// 	$('#content.app-content').removeClass('wrap-collapse-menu-id');
// 	$('.wrapper_home_menu .block_home_menu').removeClass('block_home_menu-id');
//     triggerMenuItem('close');
//     $('.menu-form div.menu_search_form').css({'display':'none'});
//     $('.app-aside-dock .app-aside .navi > ul > li > a > svg').css({'margin':'0 4px 0 0px'});
// 	$('.app-aside-dock .app-aside .navi > ul > li img.img-filter_1').css({'filter':'inherit','filter':'initial','filter':'unset'});
//     $('.app-aside-dock .app-aside .navi > ul > li > a img').css({'margin':'0 20px 0 15px'});
//     setTooltipForMenu();
//     $.get('ajax_set_menu_location.php?action=set_menu_location&value=2');
// }
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

$(document).on('click', 'td[data-conf-key="MENU_LOCATION"] .tableEditSave', function () {
    var selected_opt = $(this).closest("form").find("option:selected").val();
    console.log(selected_opt)
    setCookie('MENU_LOCATION', selected_opt, 7);
});




var sidebar = $('.sidebar_left');
var horizontal_container = $('.horizontal_container ');

function closeSidebar() {
    $('body').removeClass('open_sidebar');
    sidebar.addClass('compact_sidebar');
    sidebar.find('.item-menu.active').children('.sub_menu').slideUp(200);
}
function openSidebar() {
    $('body').addClass('open_sidebar');
    sidebar.removeClass('compact_sidebar');
    sidebar.find('.item-menu.active').children('.sub_menu').slideDown(200);
}


var menu_local_cookie = getCookie('MENU_LOCATION');

$(document).ready(function () {
    //fix quotation shift
    setTimeout(function () {
        $('#content').css('padding-bottom', $('#footer').height() + $('.quote-wrapper').height() + 30 + 'px');
    }, 10);
    if (menu_local_cookie != 0 && $(window).width() > 1200) {
        if (menu_local_cookie == 1) {
            $('.left_menu').find('li.active .sub_menu').css('display', 'block');
            openSidebar();
        } else if (menu_local_cookie == 2) {
            closeSidebar();
            $('.left_menu').find('li.active .sub_menu').css('display', 'none');
        }
    } else if ($(window).width() < 768) {
        $('.left_menu').find('li.active .sub_menu').css('display', 'block');
    }
});

$(window).resize(function () {
    //fix quotation shift
    setTimeout(function () {
        $('#content').css('padding-bottom', $('#footer').height() + $('.quote-wrapper').height() + 30 + 'px');
    }, 10);
    if (menu_local_cookie != 0 && $(window).width() > 1200) {
        if (menu_local_cookie == 1) {
            openSidebar();
            $('.left_menu').find('li.active .sub_menu').css('display', 'block');
        } else if (menu_local_cookie == 2) {
            closeSidebar();
            $('.left_menu').find('li.active .sub_menu').css('display', 'none');
        }
    } else if ($(window).width() < 768 ){
        $('.left_menu').find('li.active .sub_menu').css('display', 'block');
    }
});



$('.action_left_menu').on('click', function () {
    if (menu_local_cookie != 0) {
        if ($(window).width() > 1200) {
            if (!sidebar.hasClass('compact_sidebar')) {
                closeSidebar();
                $.get('ajax_set_menu_location.php?action=set_menu_location&value=2');
                setCookie('MENU_LOCATION', 2, 7);
            } else {
                openSidebar();
                $.get('ajax_set_menu_location.php?action=set_menu_location&value=1');
                setCookie('MENU_LOCATION', 1, 7);
            }
        } else if ($(window).width() > 750 && $(window).width() < 1199) {
            if (!$('body').hasClass('media_open')) {
                $('body').addClass('media_open');
                sidebar.find('.item-menu.active').children('.sub_menu').slideDown(200);
            } else {
                $('body').removeClass('media_open');
                sidebar.find('.item-menu.active').children('.sub_menu').slideUp(200);
            }
        }else {
            sidebar.removeClass('compact_sidebar');
            $(".new_index_navigation .open_mob_menu").click();
        }
    } else {
        if ($(window).width() > 767) {
            if (!horizontal_container.hasClass('open_horizontal')) {
                $('body').addClass('open_sidebar');
                horizontal_container.addClass('open_horizontal');
                horizontal_container.find('.item-menu.active').children('.sub_menu').slideDown(200);
            } else {
                $('body').removeClass('open_sidebar');
                horizontal_container.removeClass('open_horizontal');
                horizontal_container.find('.item-menu.active').children('.sub_menu').slideUp(200);
            }
        } else {
            $(".new_index_navigation .open_mob_menu").click();
        }
    }

});

$(".new_index_navigation .open_mob_menu").click(function() {
    if($('ul#new_settings_menu').hasClass('in')){
        $('#overflow_admin').removeClass('overflow_admin-open');
        $('ul#new_settings_menu').collapse('hide');
    }
    $("#overflow_admin").toggleClass("overflow_admin-open");
    $('.sidebar_left, .horizontal_container').toggleClass('mob_sidebar');
    $("body").toggleClass("open_sidebar modal-open");
});

// $('.navbar-header .open_menu').click( function() {
//     $('.sidebar_left').toggleClass('mob_sidebar');
//     $('#overflow_admin').toggleClass('overflow_admin-open');
//     $('body').toggleClass('open_sidebar modal-open');
//
// });


$('#overflow_admin').click( function() {
    $('.sidebar_left, .horizontal_container').toggleClass('mob_sidebar');
    $('#overflow_admin').removeClass('overflow_admin-open');
    $('body').removeClass('open_sidebar modal-open');
});

$('.new_index_navigation a[href="#new_settings_menu"]').on('click',function(){
    $('#overflow_admin').toggleClass('overflow_admin-open');
    if($('body').hasClass('open_sidebar')){
        $('#overflow_admin').addClass('overflow_admin-open');
        $('.sidebar_left, .horizontal_container').toggleClass('mob_sidebar');
        $("body").toggleClass("open_sidebar modal-open");
    }
});



$(document).on('click', '.item-menu .down', function () {
    var parent_li = $(this).closest('.item-menu');

    if(!parent_li.hasClass('active')) {
        $('.item-menu.active').find('.sub_menu').slideUp(200);
        $(this).closest('.left_menu, .horizontal_menu').find('.active').removeClass('active');
        parent_li.addClass('active');
        parent_li.find('.sub_menu').slideDown(200);
    } else {
        $('.item-menu.active').find('.sub_menu').slideUp(200);
        $(this).closest('.left_menu, .horizontal_menu').find('.active').removeClass('active');
    }
});

$(document).on('click', '.configuration_menu .configuration_menu_header', function () {
    var parent_li = $(this).closest('.configuration_menu');

    if (!parent_li.hasClass('active')) {
        //open
        // $('.configuration_menu.active').find('.sub_menu').slideUp(200);
        // parent_li.closest('.configurations').find('.active').removeClass('active');
        parent_li.find('.sub_menu').slideDown(200);
        parent_li.addClass('active');
    } else {
        //close
        parent_li.find('.sub_menu').slideUp(200);
        parent_li.removeClass('active');
        // $('.configuration_menu.active').find('.sub_menu').slideUp(200);
        // parent_li.closest('.configurations').find('.active').removeClass('active');
    }
});

$(document).on('click', '.item-menu-cat .down', function () {
    var parent_li = $(this).parent().parent().parent().parent().parent();

    if(parent_li.hasClass('opened')){
        // $(this).css({"transform": "rotate(0deg) translateX(0)"});
        $(this).removeClass('clicked');
        parent_li.removeClass('opened');

    } else {
        // $(this).css({"transform": "rotate(180deg) translateX(30%)"});
        $(this).addClass('clicked');
        parent_li.addClass('opened');
    }
});

$(document).on('click', '.item-menu-cat .cat_settings', function () {
    var cat_buttons = $(this).parent().parent().parent().siblings('.cat_buttons');
    var a = $(this).parent().parent().parent().find('a');

    if(cat_buttons.hasClass('opened')){
        // $(this).css({"transform": "rotate(0deg)"});
        $(this).removeClass('clicked');
        cat_buttons.slideUp(200);
        cat_buttons.removeClass('opened');
        a.removeClass('height');

    } else {
        // $(this).css({"transform": "rotate(90deg)"});
        $(this).addClass('clicked');
        cat_buttons.slideDown(200);
        cat_buttons.addClass('opened');
        a.addClass('height');

    }
});

$(document).ready(function () {
    var url_string = window.location.href
    var url = new URL(url_string);
    var cPath = url.searchParams.get("cPath");

    $('.menu-cats.tree a').each(function (i, e){
        if(cPath !== '' && cPath !== 'undefined' && cPath !== null) {
            if (e.getAttribute('data-cat-id') == cPath) {
                $(this).parent().parent().addClass('active') //родительская li
                $(this).parent().parent().parent().parent().addClass('opened')
                $(this).parent().parent().parent().parent().parent().parent().addClass('opened')
                $(this).parent().parent().parent().parent().parent().parent().parent().parent().addClass('opened')
            }
        }
    });

    $('.menu-cats.tree li').each(function (i, e){
        if($(this).find('ul:first').length > 0) {
            $(this).find('div .cat_icons .down:first').show();
        }
    });
    $('.sub_menu-cat li').each(function (i, e){
        if($(this).find('ul:first').length > 0) {
            $(this).find('div .cat_icons .down:first').show();
        }
    });




    $('.header_cat_btn').on('click', function(){
        $(this).next('.transition_unit').find('.selectize-input').trigger('click')
    })

});

$(document).on('keyup','.header_sidebar_left input[type="search"]',function(e){
    var search = e.target.value.toLowerCase();
    if(search.length > 0){
        $('.left_menu>li>a, .left_menu>li .down').hide();
        $('.horizontal_menu>li>a, .horizontal_menu>li .down').hide();
        $('.left_menu>li>ul>li, .horizontal_menu>li>ul>li').each(function(){
            var currText = $(this).text().toLowerCase();
            if(currText.indexOf(search) == -1){
                $(this).hide();
            }else{
                $(this).parent().parent().find('a').show();
                $(this).show();
            }
        });
        $('.left_menu>li>ul, .horizontal_menu>li>ul').show();
    }else{
        $('.left_menu>li>a, .left_menu>li .down').show();
        $('.horizontal_menu>li>a, .horizontal_menu>li .down').show();
        $('.left_menu>li>ul>li, .horizontal_menu>li>ul>li').show();
        $('.left_menu>li:not(.active)>ul, .horizontal_menu>li:not(.active)>ul').hide();
    }
});


function renderCustomizationPanel() {

    $.ajax({
        url: './customization_panel.php?side=admin',
        success: function (response) {   
            $('body').append(response);
        }
    });
}

$(document).on('click', '.table_specials input.validate[type="submit"]',function (e) {
    e.preventDefault();
    var form = $('.table_specials form'),
        query = form.attr('action').split('&');
    for(var i=0;query.length>i;i++){
        if(query[i].indexOf('action') != -1) query[i] = 'action=validate';
    }
    var actionValidate = query.join('&')

    $.ajax({
        url: actionValidate,
        type: form.attr('method'),
        dataType: 'json',
        data: form.serialize(),
        success: function (response) {
            if(response.success){
                form.submit();
            }else{
                $('.validate-result').text(response.message);
            }
        }
    });
});

function setAndShowCriticalWindow(status) {
    localStorage.setItem('needCreateCriticalCss', status);
    showCriticalWindow(status);
}

function showCriticalWindow(status) {
    $.get('./ajax_set_menu_location.php?action=set_critical_css_status&status='+status);
    setTimeout(function(){
        updateErrorsAlert();
    },1000);

}

$('.multi_manager_btn').click(function () {
    $(this).toggleClass('multi_manager_btn-active');
});

function showErrorsAlert(text, parent, type, removeClass) {
    // if removeClass isn't empty - show close button
    if (removeClass !== '') var close = '<button class="close" data-dismiss="alert" aria-label="close"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z"></path></svg></button>';

    // adds alert box to parent with next properties
    parent.append("<div class='alert " + type + " error_alert fade in " + removeClass + "' data-alert='alert'>" + close + "<span>" + text + "</span></div>");
}

$('.show_errors').on('click', function () {
    if(!$('#errors_block').hasClass('open')) {
        var errors = $(this).data('errors');
        // var errors_length = $('#errors_block').children('.error_alert').length - 1;
        if (!$(this).hasClass('shown')) {
            $(this).addClass('shown');
            $('#errors_block').addClass('open');
            if (typeof errors === 'string') {
                errors = JSON.parse(errors);
            }

            for (var key in errors) {
                showErrorsAlert(errors[key].text, $('#errors_block'), errors[key].type, 'alert-dismissible');
            }
        }
    }
});
$(window).on('load',function(){
    var errors = $('.show_errors').data('errors');
    if(Object.keys(errors).length !== 0){
        if(typeof errors['robots_txt'] !== "undefined"){
            if(Object.values(errors)[0]['critical_for_site'] == 'true'){
                if(!$(this).hasClass('shown')){
                    $(this).addClass('shown');
                    $('#errors_block').addClass('open');
                    if (typeof errors === 'string') {
                        errors = JSON.parse(errors);
                    }
                    for (var key in errors) {
                        showErrorsAlert(errors[key].text, $('#errors_block'), errors[key].type, 'alert-dismissible');
                    }
                }
            }
        }
        if(typeof errors['domen_in_robots_txt'] !== "undefined"){
            if(!$(this).hasClass('shown')){
                $(this).addClass('shown');
                $('#errors_block').addClass('open');
                if (typeof errors === 'string') {
                    errors = JSON.parse(errors);
                }
                for (var key in errors) {
                    showErrorsAlert(errors[key].text, $('#errors_block'), errors[key].type, 'alert-dismissible');
                }
            }
        }
    }
});
$(document).on('click', '.error_alert .close', function () {
    var errors_length = $('#errors_block').children('.error_alert').length - 1;
    if(errors_length <= 0) {
        $('.show_errors').removeClass('shown');
        $('#errors_block').removeClass('open');
    }
});
$(document).on('click', '.h3 .close_errors', function () {
    $('.show_errors').removeClass('shown');
    $(this).closest('#errors_block').removeClass('open');
    setTimeout(function () {
        $('#errors_block').children('.error_alert').remove();
    },100);
});

//newcategories

$('.openSubcatRow').on('click', function () {
    $(this).toggleClass('rotate');
    $(this).closest('.item').toggleClass('active');
});

//stick orders table head to top

if ($(window).width() < 750 && $('.orders-table').selector) {
    $(window).on( 'scroll', function(){
        let height = $(window).scrollTop();
        if(height > 50){
            $('.js-orders-table-head').addClass('orders-table-head_sticky');
        } else{
            $('.js-orders-table-head').removeClass('orders-table-head_sticky');
        }
    });

    $('.js-show-hide-orders-filter').on('click', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $('#own_table th.hidden-on-mobile').toggleClass('visible');
    });
}

$(document).on('click','.start-generate-robots-txt',function(){
    $('.robots-txt-text').hide();
    $('.generate-robots-txt-process').show();
    $(this).hide();
    $('.critical-layout').show();
    $.ajax({
        url: './ajax_set_menu_location.php',
        type: 'GET',
        dataType: 'json',
        data:{
            action:'generateRobotsTxt',
        },
        success: function (response) {
            if(response.success){
                $('.critical-layout').hide();
                updateErrorsAlert();
                setTimeout(function(){
                    updateErrorsAlert();
                },1000);
            }else{
                $('.critical-layout').hide();
                $('.generate-robots-txt-process').text(response.message);
            }
        }
    });
});
$(document).on('click', 'a.open-server-dir', function () {
    var pID = $(this).attr('data-prod-id');
    var newWin = window.open("/admin/upload_file_from_server.php?pID="+pID, "", "width=1200,height=800");
    const timer = setInterval(() => {
        if (newWin.closed) {
            clearInterval(timer);
            if((location.href).indexOf('#images') > 0){
                location.reload();
            }else{
                location.href = location.href+'#images';
            }
        }
    }, 2000);
});