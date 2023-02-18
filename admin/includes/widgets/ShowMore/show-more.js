$(document).ready(function ( ) {
    $('.show-more-btn').on('click',function (){
        loadMoreAdminPage();
    });

    $('#per_page').change(function(){
        var valItem = $("#per_page :selected").val();
        $('#pl_onpage option').val(valItem).text(valItem);
        $('input[name="perPage"]').val(valItem);
    });
})

function loadMoreAdminPage() {
    var totalProducts = $('input[name=number_of_rows]').val();
    var productsPerPage=$('*[name=row_by_page]').val();
    var lastRedElement;
    var obj = $('#m_srch').serializeArray();
    obj.forEach(function(item){
        if (item['name']=="row_by_page"){
            productsPerPage=item['value'];
        }
    });

    var foundpage = false;
    $.each(obj, function (i, field) {
        if (obj[i].name == "page") {
            lastRedElement=parseInt(obj[i].value);
            foundpage = true;
        }
    });
    var totalPagesAdjusted;
    if (~~(totalProducts/productsPerPage)===(totalProducts/productsPerPage)) {
        totalPagesAdjusted=(totalProducts/productsPerPage);
    } else {
        totalPagesAdjusted=~~(totalProducts/productsPerPage)+1;
    }

    if (foundpage == false) {
        lastRedElement=1;
    }

    if (lastRedElement>=totalPagesAdjusted) {
        $('.show-more-btn').addClass('disabled');
    } else {
        $('#loadMoreI').addClass('fa-spin');//start font-awesome animation
        $('.refresh_icon .fa-spin').fadeIn(20);
        //serialize path with attributes
        var obj = $('#m_srch').serializeArray();
        var foundpage = false;
        $.each(obj, function (i, field) {
            if (obj[i].name == "page") {
                lastRedElement=obj[i].value;
                obj[i].value = parseInt(obj[i].value) + 1;
                $('#m_srch').prop("page").value = obj[i].value;
                foundpage = true;
            }
        });
        if (foundpage == false) {
            $('#m_srch').append('<input id="page1" type="hidden" name="page" value="2">');
            lastRedElement=1;
        }
        ajaxSubmitSerialize();
    }
}

function ajaxSubmitSerialize (){
    var pathSerialize =$('#m_srch').attr('action')+ '&' + $('#m_srch').serialize() + '&' + 'ajax_load=show';
    if ($('#own_table').hasClass('inner_loader')) {
        $('#own_table').after('<div class="ajax_load">' + '<span class="spin"></span>' + '<span>' + lang.all.TEXT_WAIT + '</span>' + '</div>');
    } else {
        $('#own_table').addClass('inner_loader').after('<div class="ajax_load">' + '<span class="spin"></span>' + '<span>' + lang.all.TEXT_WAIT + '</span>' + '</div>');
    }

    $.get(pathSerialize, function (data) {
        appendShowMoreData(data);
        $($.find(".pagination .active")).next().attr("class", "active"); //mark next page as active
        $('#loadMoreI').removeClass('fa-spin'); //stop font-awesome animation
    }, 'json');
    return false
}

function appendShowMoreData(response) {
    $('.ajax_load').remove();
    var data = response.data;
    var paginate = response.paginate;
    var allowed_fields = response.allowed_fields;
    var show = '';
    var buttonAction = $('#action').clone().removeAttr('style').html();

    if($('input[name="number_of_rows"]')){
        $('input[name="number_of_rows"]').val(paginate['count'])
    }
    if(data.length >= paginate['count']){
        $('.show-more-btn').addClass('disabled');
    }else{
        $('.show-more-btn').removeClass('disabled');
    }
    $('input[name="page"]').val(paginate['current_page']);

    if (data != null) {
        var cnt_data = data.length;
        for (var i = 0; i < cnt_data; i++) {
            var style = (data[i]['background-color'] != "undefined") ? 'style="background-color:' + data[i]['background-color'] +'1a' + '"' : '';
            show += '<tr ' + style + ' data-id="' + data[i]['id'] + '">';
            for (var field in allowed_fields) {
                if (allowed_fields[field]['show'] === false) continue;
                var className = allowed_fields[field]['class'] != undefined ? 'class="' + allowed_fields[field]['class'] + '"' : '';
                show += '<td ' + className + ' data-name="' + field + '" data-label="' + $('th[data-table='+field+']')[0].childNodes[0].textContent.trim() + '">';
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
                    var params = allowed_fields[field]['params'] !== undefined ? allowed_fields[field]['params'] : '';
                    show += '<span class="change">' +
                        '<input class="' + allowed_fields[field]['class'] + '"' + params + ' data-old="' + data[i][field] + '" name="' + field + '" type="' + allowed_fields[field]['type'] + '" value="' + data[i][field] + '"></span>';
                } else if (allowed_fields[field]['type'] == 'select' && typeof(table_option) !== 'undefined') {
                    show += '<span data-value="' + data[i][field] + '">' + table_option[field][data[i][field]] + '</span>';
                } else if (field == 'dynamic') {
                    show += '<input type="' + allowed_fields[field]['type'] + '">';
                }
                else if (data[i][field] == undefined) {
                    show += '<div class="text-center">-</div>';
                } else if (allowed_fields[field]['type'] == 'link') {
                    show += '<a href="customers.php?id='+data[i]['cid']+'&action=edit_customers">'+data[i][field]+'</a>';
                } else {
                    show += data[i][field];
                }
                show += '</td>';
            }
            show += buttonAction ? ('<td>' + buttonAction.replace("data-title=","data-title='#"+data[i]['id']+"'") + '</td>') : '';
            show += '</tr>';
        }
        $('#own_table >tbody').append(show);
    } else {
        show_tooltip('empty');
    }
    checkShowMoreBtnStatus();
}

function checkShowMoreBtnStatus() {
    var max_item_page = parseInt($('input[name="number_of_rows"]').val());
    var curr_page = $('input[name="page"]').val();
    var perPage = $('input[name="perPage"]').val();

    if(max_item_page == $('#own_table tbody> tr').length || curr_page*perPage > max_item_page){
        $('.show-more-btn').addClass('disabled');
    }else{
        $('.show-more-btn').removeClass('disabled');
    }
    if($('table.reviews').length > 0){
        loadChildReview();
    }
}