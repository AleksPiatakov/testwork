var compareFlag = false;
jQuery(document).ready(function () {
    /* COPMARE */
    $(document).on('click', '.compare_button', function (event) {
        // if(compareFlag) {
        //     return false;
        // }
        // compareFlag = true;
        if (event.target.parentElement.tagName === 'A' && TEMPLATE_NAME === 'default') {
            window.location = event.target.parentElement.href;
            return false;
        }
        event.preventDefault();
        if (typeof $('#compare_counter').html() === 'undefined' || ($('#compare_counter').html() < 4)) {
            go_compare($(this).data().id);
        } else {
            if (!$(this).find('input').prop('checked')) {
                showAlert(TEXT_LIMIT_REACHED + '4', $('#compare_box'), 'alert-danger', 'alert-dismissible');
            } else {
                go_compare($(this).data().id);
            }
        }
    });
});

// COMPARE ---------------------------
function go_compare(tovarid)
{

    var $input = $('#compare_' + tovarid);
    var $text = $input.parent().find('label');
    var $del = "";
    var del = arguments[2] || "";

    if (del == '') {
        $del = $input.is(':checked') ? 'delete' : '';
    } else {
        $del = del;
    }
//  console.log($del);
    $.getJSON('./ext/compare/compare.php', {
        action: 'compare',
        idp: tovarid,
        ifdel: $del
    }, function (data) {
        $text.html(data.text);
        // compareFlag = false;
        $input.is(':checked') ? $input.prop('checked', false) : $input.prop('checked', true);
        if (TEMPLATE_NAME === 'default' && $text.length) {
            if (data.link && $input.is(':checked') && $text.parent()[0].tagName !== 'A') {
                $text.wrap('<a href="' + data.link + '"></a>')
            } else if ($text.parent()[0].tagName === 'A') {
                $text.unwrap()
            }
        }
    // reload page if current page is compare.php:
        if (window.location.href.toString().split(window.location.host)[1] == '/compare.php') {
            location.reload();
        }

        $.get('./ext/compare/r_compare_box.php',{
            method:'ajax',
            compare_id:tovarid
        },function (data2) {
            if (data2 == '') {
                $('#compare_box').fadeOut(300);
            } else {
                if (typeof $('#compare_box').html() === 'undefined') {
                    $('body').prepend('<div id="compare_box"></div>');
                }
                $('#compare_box').replaceWith(data2);
                $("#compare_box .lazyload").lazyload();
            }
        });
    });
}
