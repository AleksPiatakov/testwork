$(document).ready(function () {
    $(document).on('click', '#translate', function (e) {
        e.preventDefault();
        $(this).prop('disabled', true);
        if ($('#translate-products').prop("tagName") === 'FORM') {
            var data = $('#translate-products').serialize();
        } else {
            var data = [];
            $('#translate-products').find('input, select').each(function ( ) {
                data.push($(this).attr('name') + "=" + $(this).val());
            });
            data = data.join('&');
        }
        $.ajax(
            {
                type : 'POST',
                url : 'auto_translate.php',
                data: data,
                dataType : 'JSON',
                success: function (response) {
                    if (response.done) {
                        $('#translate-products').html(response.msg);
                    } else {
                        location.reload();
                    }
                }
            }
        );
        if ($('#progressBar').length > 0) {
            var data = {timestamp : new Date().getTime()}
                getTranslateDownloadProgress(data);
        }
    });
    $('input[type=radio][name=what_translate]').change(function () {
        $('.fields').hide();
        $('.' + this.value).show();
    });
});

function getTranslateDownloadProgress(data)
{
    $.ajax(
        {
            type : 'GET',
            url : '/ext/auto_translate/check_progress.php',
            data : data,
            dataType : 'JSON',
            success : function (response) {
                $('#progressBar').css('width', response.ratio + '%');
                $('#percent').text(response.ratio);
                if (response.done) {
                    $('.multi-translate').html(response.msg)
                } else {
                    getTranslateDownloadProgress(
                        {timestamp : new Date().getTime(), current : response.ratio}
                    );
                }
            }
        }
    );
}