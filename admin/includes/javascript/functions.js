window.onload = function () {
    'use strict';
    $('#logoresize').on('click', function (){return false})


    var $image = $('#logoresize img');


    $image.cropper({
        preview: '.img-preview-wrapper',
        minContainerWidth: 300,
        crop: function (event) {
        }
    });

// Get the Cropper.js instance after initialized
    var cropper = $image.data('cropper');

    $('#set').on('click', function () {
        var dataURL = cropper.getCroppedCanvas().toDataURL();
        var image = new Image();
        image.src = dataURL;
        var reader = new FileReader();
        var src = new Blob([dataURL], {type: 'image/png'});
        reader.readAsDataURL(src);
        reader.onload = function () {
            var fileEncoded = reader.result;
            $.ajax({
                url: './configuration.php?gID=1&cID=2012&action=tableSave',
                type: 'post',
                data: 'file_type=base64&configuration_key=LOGO_IMAGE&configuration_value=' + fileEncoded,
                beforeSend: function () {
                },
                complete: function () {
                },
                success: function (data) {
                    $('.img-cutter-preview-wrapper').toggleClass('hidden');
                    $('.img-preview-wrapper img').css('display', 'block');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            })

        }
    });

    $('#logo_cut').on('click', function () {
        $('.img-cutter-preview-wrapper').toggleClass('hidden');
        $('.img-preview-wrapper img').css('display', 'block');
    });
    $('#logofile .img.editable').on('click', function () {
        return false;
    });
}
