"use strict"
$(document).ready(function () {
    $('#fileUpload button[type=submit]').on('click', function (e) {
        let $this = $(this)
        $('#fileUpload').ajaxForm({
            target : '#outputImage',
            url : '/ext/osc_import/uploadFile.php',
            beforeSubmit : function () {
                $("#progressDivId").css("display", "block");
                var percentValue = '0%';
                $('#progressBar').width(percentValue);
                $('#percent').html(percentValue);
                $this.prop('disabled', true);
            },
            uploadProgress : function (event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                $("#progressBar").width(percentVal);
                $("#percent").html(percentVal);
            },
            error : function (response, status, e) {
                alert('Oops something went.');
            },
            complete : function (xhr) {
                if (xhr.responseText && xhr.responseText != "error") {
                    $('#fileUpload').remove();
                    $("#oscImportResponse").html(xhr.responseText);
                }
            }
        });
    })
    $(document).on('change', '[name="tables[]"]', function () {
        $('[name="table[' + $(this).val() + '][]"]').prop('checked', $(this).prop('checked'));
    });
    $(document).on('click', '.show-fields', function () {
        $(this).next().toggleClass('hidden');
    })
    $(document).on('click', '.button-check', function () {
        $('#oscImportResponse input').prop('checked', $(this).data('check'))
    })
    $('#downloadImagesFromOldWebsite').on('submit', function (e) {
        e.preventDefault();
        let data = $(this).serialize();
        $.ajax(
            {
                type : 'POST',
                url : '/ext/osc_import/image_downloader.php',
                data: data,
                dataType : 'JSON',
            }
        );
        $('#downloadProgress').removeClass('hidden');
        $('#downloadImagesFromOldWebsite button[type=submit]').prop('disabled', true).addClass('hidden')
        getImageDownloadProgress();
    })
    $(document).on('submit', '#oscImportDBTables', function () {
        $(this).find('button[type=submit]').prop('disabled', true);
    })
})

function getImageDownloadProgress(data)
{
    $.ajax(
        {
            type : 'GET',
            url : '/ext/osc_import/image_queue_check.php',
            data : data,
            dataType : 'JSON',
            success : function (response) {
                    $('#downloadProgress .progress-bar').css('width', response.ratio + '%');
                    $('#downloadProgress .percent').text(response.text);
                if (response.done) {
                    $('#oscImportContainer').html(response.msg)
                } else {
                    getImageDownloadProgress(
                        {timestamp : new Date().getTime(), current : response.current}
                    );
                }
            }
        }
    );
}