$(document).ready(function () {
    //  урл для ajax
    window.ajaxLoadHref = window.location.href;
    blockOrdersPeriod();
    blockOrderStatus();
    blockCounters();
    blockOrdersSchedule();
    blockEventsReviewsNews();
    // blockGA();
    logNum();
});

function blockOrdersPeriod() {
    // Перший блок (Сегодня, Вчера, Неделя, Месяц ...)

    $.post(
        window.ajaxLoadHref,
        {
            modalLoader: 'blockOrdersPeriod'
        },
        function (response) {
            $('#blockOrdersPeriod').html(response);
            //blockOrderStatus();

        },
        'html'
    );
}

function blockOrderStatus() {
    // Другий блок (Статусы заказов)

    $.post(
        window.ajaxLoadHref,
        {
            modalLoader: 'blockOrderStatus'
        },
        function (response) {
            $('#blockOrderStatus').html(response);

        },
        'html'
    );
}

function blockCounters() {
    // Третій блок (Кількість товарів, Замовлень, Коментарів, Суммою продаж, та модулями)

    $.post(
        window.ajaxLoadHref,
        {
            modalLoader: 'blockCounters'
        },
        function (response) {
            $('#blockCounters').html(response);
        },
        'html'
    );
}

function blockOrdersSchedule() {
    // Четвертий блок (Графік доходів та обзором ТОп)
    $.post(
        window.ajaxLoadHref,
        {
            modalLoader: 'blockOrdersSchedule'
        },
        function (response) {

            $('#blockOrdersSchedule').html(response);
            $('.tab-container a[href="#latest-orders"]').click();

            initActionsHistoryBlock();
            
        },
        'html'
    );
}

var actionsBlocksArray = [
    'latest-orders',
    'most-viewed',
    'most-sold',
    'top-categories',
    'most-searches'
];


function initActionsHistoryBlock() {
    actionsBlocksArray.map((block, i) => {
        
        const capitalize = (s) => {if (typeof s !== 'string') return ''; return s.charAt(0).toUpperCase() + s.slice(1)}
        var templateFunction = (block.split('-', 2).map(item => capitalize(item))).join().replace(",", "");
        // console.log(templateFunction);

        $.ajax({
            url: "./includes/index/orders-schedule/"+templateFunction+".php",
            type: "POST",
            data: {method: 'init'},
            dataType: "json",
            success: function(response) {    
                // console.log('test: ', response.headers);

                $('#action_overview_content').prepend(`<div id="${block}" class="tab-pane fade ${i === 0 ? 'in active' : ''} hidden-scroll"></div>`);
                // $('#'+block).append('<table class="table m-b-none">'+renderHeaders(response.headers)+'</table>');
                $('#'+block).append('<table class="table m-b-none">'+renderHeaders(response.headers)+'</table>');

                response.data.map((item, key) => {

                    if (item.images) {
                      // Define image
                      var image_file_name = item.images.split(';', 1)[0];
                      image_file_name 
                      ? image_file_name = '../getimage/50x50/products/' + image_file_name + ''
                      : image_file_name = '../getimage/50x50/products/default.png';
                    }

                    var image = image_file_name;
                    var defines = response.defines;

                    item['image'] = image;
                    item['defines'] = defines;
                    // console.log(item);

                    // Add element on page
                    $('#'+block).find('tbody').append(eval(templateFunction)(item));
                });
            }
        });
    });
}



function blockEventsReviewsNews() {
    // П"ятий блок (Події)

    $.post(
        window.ajaxLoadHref,
        {
            modalLoader: 'blockEventsReviewsNews'
        },
        function (response) {
            $('#blockEventsReviewsNews').html(response);
            $('#events_tabs .fa').tooltip({
                template: '<div class="left_m_tooltip tooltip" role="tooltip"><div class="tooltip-inner"></div></div>',
                container: 'body',
            });
            if ( $('.new_index').length != 0) {
                if (IS_MOBILE != 1) {
                    $(".events_block .tab-content > div, .reviews_block .reviews_content").overlayScrollbars({
                        resize: 'none'
                    });
                }
            }
        },
        'html'
    );
}

function blockGA() {
    //  Шостий блок (Гугл аналітика)

    $.post(
        window.ajaxLoadHref,
        {
            modalLoader: 'blockGA'
        },
        function (response) {
            $('#blockGA').html(response);
        },
        'html'
    );
}

function logNum() {
    // Завантажуємо модалку,якщо вперше

    $.post(
        window.ajaxLoadHref,
        {
            modalLoader: 'logNum'
        },
        function (response) {
            if (response != '') {
                modal({
                    body: response,
                    id: 'form',
                    width: '50%'
                });
            }
        },
        'html'
    );
}
