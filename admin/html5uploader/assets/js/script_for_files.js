$(function () {

    var current_box;
    var pid3d = $('input[name=pidd]').val();

    showCurrentFiles(pid3d, 'second');

    $(document).ready(function () {
        $('#downloads > table').before($('#custom_form_wrapper_second').html());
        $('#downloads form').show();
        $('.add_more').click(function (e) {
            e.preventDefault();
            $(this).before("<input name='files[]' type='file'/><br>");
        });
        $('.ui-tabs-nav li.ui-state-active a').each(function (index, el) {
            if (jQuery(this).attr('href') == '#downloads') {
                $('#custom_form_second').show();
            }
        });
    });

    $('#tabs').on("tabsactivate", function (event, ui) {
        var active = $('#tabs').tabs("option", "active");
        if (active == 3) {
            $('#downloads #custom_form_second').show();
        } else {
            $('#downloads #custom_form_second').hide();
        }
    });

    $('#dropbox_second').filedropFiles({
        // The name of the $_FILES entry:
        paramname: 'files',
        maxfiles: 40,
        maxfilesize: 10,
        data: {
            opid: $(current_box).attr('id'),
        },
        uploadFinished: function (i, file, response) {
            $.data(file).addClass('done');
            $.data(file).attr('id', response['current']);
            $.data(file).find('img').attr('name', response['current']);
            $.data(file).append('<span class="delimg" name="' + response['current'] + '"></span>');
            $.data(file).find('.delimg').click(function () {
                deleteCurrentFile(pid3d, $(this).attr('name'));
            });
            $.data(file).find('.progressHolder').remove();
            //TODO: сделать сортировку, поле  в базе уже есть
            /*$('#dropbox_second').sortable({
                connectWith: "#dropbox_second",
                update: function(event, ui) {
                    var newOrder = $(this).sortable('toArray').toString();
                    $.post('html5uploader/post_file.php', {
                        'pid': pid3d,
                        'act':'sort',
                        'order':newOrder,
                        'opid':'second'
                    });
                }
            });*/
            // response is the JSON object that post_file.php returns
        },

        error: function (err, file) {
            switch (err) {
                case 'BrowserNotSupported':
                    showMessage('Your browser does not support HTML5 file uploads!', current_box);
                    break;
                case 'TooManyFiles':
                    alert('Too many files! Please select 5 at most! (configurable)');
                    break;
                case 'FileTooLarge':
                    alert(file.name + ' is too large! Please upload files up to 2mb (configurable).');
                    break;
                default:
                    break;
            }
        },

        // Called before each upload is started
        beforeEach: function (file) {
            //TODO: сделатьдополнительную проверку на загружаемые файлы
            /*if(!file.type.match(/^image\//)){
                alert('you can upload ONLY IMAGES!');

                // Returning false will cause the
                // file to be rejected
                return false;
            }*/
        },

        drop: function (dropper) {
            current_box = dropper.currentTarget;
            this.url = 'html5uploader/post_file.php?act=update&opid=second&pid=' + pid3d;
        },

        uploadStarted: function (i, file, len) {
            createPreview(file, current_box);
        },

        dragOver: function (dropper) {
            $(dropper.currentTarget).css('border', '2px dashed #fff');
        },

        dragLeave: function (dropper) {
            $(dropper.currentTarget).css('border', '2px solid #fff');
        },

        progressUpdated: function (i, file, progress) {
            $.data(file).find('.progress').width(progress);
    }

    });

    var template = '<div class="preview">' +
        '<span class="imageHolder">' +
        '<span class="file_icon">' +
        '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">' +
        '   <path d="M0 64C0 28.65 28.65 0 64 0H229.5C246.5 0 262.7 6.743 274.7 18.75L365.3 109.3C377.3 121.3 384 137.5 384 154.5V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM336 448V160H256C238.3 160 224 145.7 224 128V48H64C55.16 48 48 55.16 48 64V448C48 456.8 55.16 464 64 464H320C328.8 464 336 456.8 336 448z"></path>' +
        '</svg>' +
        '   <span class="filename"></span></span>' +
        '</span>' +
        '<div class="progressHolder">' +
        '<div class="progress"></div>' +
        '</div>' +
        '</div>';

    function createPreview(file, dbox_id) {
        var preview = $(template),
            name = $('.filename', preview);
        var reader = new FileReader();

        reader.onload = function (e) {
            name.text(file.name);
        };

        // Reading the file as a DataURL. When finished,
        // this will trigger the onload function above:
        reader.readAsDataURL(file);

        $('.message', dbox_id).remove();
        preview.appendTo(dbox_id);

        // Associating a preview container
        // with the file, using jQuery's $.data():

        $.data(file, preview);
    }

    function showMessage(msg, current_box) {
        $('.message', current_box).html(msg);
    }

    function showCurrentFiles(pid, opid) {
        $.getJSON('html5uploader/post_file.php', {
            '_timestmp': new Date().getTime(),
            'pid': pid,
            'act': 'read',
            'opid': opid
        }, function (obj) {
            var curr_dropbox = '#dropbox_second';
            if (obj != null) {
                var objlen = obj.length;

                if (objlen != 0) $(curr_dropbox + ' .message').remove();
                for (i = 0; i < objlen; i++) {
                    $(curr_dropbox).append('<div class="preview done" id="' + obj[i] + '"><span class="imageHolder">' +
                        '<span class="file_icon">' +
                        '   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M0 64C0 28.65 28.65 0 64 0H229.5C246.5 0 262.7 6.743 274.7 18.75L365.3 109.3C377.3 121.3 384 137.5 384 154.5V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM336 448V160H256C238.3 160 224 145.7 224 128V48H64C55.16 48 48 55.16 48 64V448C48 456.8 55.16 464 64 464H320C328.8 464 336 456.8 336 448z"/></svg>' +
                        '   <span class="filename">' + obj[i] + '</span>' +
                        '</span>' +
                        '<span class="delimg" name="' + obj[i] + '"></span></div>');

                }
                $('.delimg').click(function () {
                    deleteCurrentFile(pid, $(this).attr('name'));
                });
                //TODO: сделать сортировку, поле  в базе уже есть
                /*$('#dropbox_second').sortable({
                    connectWith: "#dropbox_second",
                    update: function(event, ui) {
                        $('.message', $(this)).remove();
                        var newOrder = $(this).sortable('toArray').toString();
                        $.post('html5uploader/post_file.php', {'pid': pid,'act':'sort', 'order':newOrder,'opid':'second'});
                    }
                });*/
            }
        });
    }

    function deleteCurrentFile(pid, file) {
        var opid = 'second';

        $.getJSON('html5uploader/post_file.php', {
            '_timestmp': new Date().getTime(),
            'pid': pid,
            'act': 'del',
            'file': file,
            'opid': opid
        }, function (obj) {
            $('.delimg[name="' + file + '"]').closest('.preview').animate({
                height: 0,
                marginLeft: 0,
                opacity: 0
            }, 500, function () {
                $(this).remove();
            });
        });
    }

});
