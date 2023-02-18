// Get store location
var storeLocation = window.location.pathname;

// Get current folder
var adminFolder = storeLocation.substring(0, storeLocation.lastIndexOf("/"));

// "http://demo"
var origin = window.location.origin;

function require(script) {
    $.ajax({
        url: script,
        dataType: "script",
        // async: false,           // <-- This is the key
        success: function (data) {
            // return data;
            // all good...
        },
        error: function () {
            throw new Error("Could not load script " + script);
        }
    });
}

function updateErrorsAlert() {
    $('.close_errors').click();
    $.ajax({
        url: './ajax_set_menu_location.php?action=errorsAlert',
        success: function (response) {
            var $showErrors = $('.show_errors');
            var errors = JSON.parse(response);
            var cnt = Object.keys(errors).length;
            $showErrors.data('errors', JSON.stringify(errors));
            if (cnt == 0 && !$showErrors.hasClass('shown')) {
                $showErrors.addClass('shown');
                $('.count_err').remove();
            } else if (cnt > 0) {
                $showErrors.removeClass('shown').append('<span class="count_err">' + cnt + '</span>');
            }
        }
    });
}


$(document).ready(function () {
    // console.log(createSeries(123));

//закрывать  editable поля при клике не на них
    $(document).mouseup(function (e) {
        var container = $(".setValue form");
        if (container.has(e.target).length === 0) {
            $('.tableEditCancel').trigger('click');
        }
    });


    function addAjaxSpinner(that) {
        if (!$(that).hasClass("active")) {
            $(that).append('<i class="fa fa-spin fa-spinner"></i>');
            $(that).addClass("active");
        } else {
            $(that)
                .find(".fa-spin")
                .remove();
            $(that).removeClass("active");
        }
    }

    $(document).on(
        "click",
        ".dataTableRowSelected .setValue span.editable:not(.ajax-loader), .dataTableRowSelected .setValue img.editable:not(.ajax-loader), #logo_download",
        function (event) {
            var that = this;
            var href = $(this)
                .parents("tr")
                .data("href");
            $(that).addClass("ajax-loader");

            $.post(
                href,
                {},
                function (response) {
                    $(that)
                        .removeClass("ajax-loader")
                        .addClass("hide");
                    $(that)
                        .parents("td")
                        .append(response);
                    if (
                        $(that)
                            .parents("td")
                            .find("textarea.ck_replacer").length
                    ) {
                        ckFinderBuilder();
                    }
                },
                "html"
            );

            return false;
        }
    );

    $(document).on("click", ".tableEditSave", function (event) {
        // урл на який направляю пост запит
        var href = $(this).data("href");

        // колонка таблиці у яку вставлю результат ajax
        var tdSetValue = $(this).parents("td.setValue");
        var tdSetOrder = $(this)
            .parents("tr")
            .find(".sortOrder");
        href = href + "&" + tdSetValue.find("form").find('input, textarea, select').not('[name=configuration_value]').serialize();
        var form = tdSetValue.find("form");
        var formData = new FormData(form.get(0));

        // блок у який вставлю відповідь від сервера, а потім вставлю у tdSetValue
        var editable = tdSetValue.find("span.editable");
        if (tdSetValue.find(".editable img").length) {
            var editableF = tdSetValue.find(".editable img");
        }

        var selectText = false;

        // якщо у нас select необхідно зберегти вибраний текст
        if (
            $(this)
                .parents("form")
                .find(":input")
                .is("select")
        )
            selectText = $(this)
                .parents("form")
                .find("option:selected")
                .text();
        $.ajax({
            url: href,
            type: "POST",
            dataType: "html",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                let isCheckBoxSmsEnable = $("td.setValue.v-middle.SMS_ENABLE input:checked").length;
                if (isCheckBoxSmsEnable && (tdSetValue.attr('data-conf-key') === 'SMS_LOGIN' || tdSetValue.attr('data-conf-key') === 'SMS_SIGN' || tdSetValue.attr('data-conf-key') === 'SMS_PASSWORD')) {
                    if (!smsFieldValidate(form.find('textarea[name="configuration_value"]').val(), tdSetValue.attr('data-conf-key'))) {
                        return false;
                    }
                }
            },
            success: function (response) {

                if (selectText) editable = editable.html(selectText);
                else editable = editable.html(response);

                if (tdSetValue.hasClass('SET_WWW')) {
                    editable.html(response);
                }

                if (tdSetValue.find("img").length) {
                    if (tdSetValue.find("#logoresize").length) {
                        window.location.reload();
                    } else {
                        tdSetValue.html(response);
                    }
                } else {
                    tdSetValue.html(editable.removeClass("hide"));
                }

                if (tdSetValue.hasClass('setAndShowCriticalWindow')) {
                    if (form.find('input[name="configuration_key"]').val() == 'MINIFY_CSSJS' && form.find('select[name="configuration_value"]').val() == "1") {
                        setAndShowCriticalWindow(1);
                    }
                }
            }
        });
        /*$.get(
            href,
            {},
            function (response) {
                console.log(response);

                if (selectText)
                    editable = editable.html(selectText);
                else
                    editable = editable.html(response);


                if(tdSetValue.find('img.editable').length) {
                    tdSetValue.html(editableF.removeClass('hide'));
                } else {
                    tdSetValue.html(editable.removeClass('hide'));
                }

            },
            'html'
        );*/

        return false;
    });

    $(document).on("click", ".tableEditCancel", function (event) {
        var tdSetValue = $(this).parents("td.setValue");
        tdSetValue.find("#logo_download").removeClass("hide");
        tdSetValue.find("span.editable").removeClass("hide");
        tdSetValue.find('form').remove();

        return false;
    });

    $(document).on("click", ".tableEditCancel", function (event) {
        var tdSetValue = $(this).parents("td.setValue");
        var editable = tdSetValue.find("span.editable").removeClass("hide");

        tdSetValue.empty().append(editable);

        return false;
    });

    // Встановлює, а також видалає модуль
    $(document).on("click", "a.actionInstall, a.actionDelete", function () {
        /*

         // містить this або .actionInstall або .actionDelete
         var thisActionInstall = this;
         // містить this батька (td)
         var tdActionInstall = $(this).parent();

         // отримуємо урл для ajax
         var href = $(this).attr('href');

         $.post(
         href,
         {
         },
         function(response) {

         // якщо дані успішно збереженні на сервері вставляє отриманий від сервера html
         if(response.result == 'success') {
         $(thisActionInstall).remove();
         $(tdActionInstall).html(response.html);
         }

         },
         'json'
         );

         return false;

         */
    });

    // модалка редагування для сторінок категорії "Модулі"
    $(document).on("click", ".actionEdit", function () {
        /*

         // отримуємо урл для ajax
         var href = $(this).data('href');

         $.post(
         href,
         {
         },
         function(response) {

         // вставка отриманого html в тіло мадалки
         $('#ajaxModal .modal-dialog').html(response);
         // відкриває модальне вікно
         $('#ajaxModal').modal();

         },
         'html'
         );

         return false;
         */
    });

    // надсилає форму на сервер через ajax аби зеберегти данні.
    /*$(document).on("submit, click", 'button[type="submit"]', (function (event) {

       // об"єкт поточної форми
       var currentForm = $(this).parents('form');
       // отримує усі поля форми
       var configuration_value = currentForm.serialize();

       // отримуєм урл для ajax
       var href = currentForm.attr('action');

       $.post(
       href,
       {
       configuration_value: configuration_value
       },
       function(response) {

       // якщо дані успішно збереженні на сервері закриваємо модальне вікно
       if(response.result == 'success') {
       window.tdSetOrder.html(response.sort_order);
       delete window.tdSetOrder;
       $('#ajaxModal').modal('hide');
       }

       },
       'json'
       );

       return false;

      })); */

    window.checkAjax = "sent";

    $(".dataTableRowSelected .buyme").click(function (event) {
        event.stopPropagation();
    });

    function smsFieldRequiredErrors()
    {
        if ($('.SMS_ENABLE .switchValue:checked').length === 0) {
            var error = false;
            var fields = ['SMS_LOGIN', 'SMS_SIGN', 'SMS_PASSWORD'];
            fields.forEach(function (element) {
                if (!error) {
                    var value = document.querySelector("." + element + " span").textContent;
                    error = !smsFieldValidate(value, element);
                }
            });

            return error;
        }
    }

    function smsFieldValidate(data, confKey)
    {
        var result = true;
        var textEdit = document.querySelector(".SMS_PASSWORD span").attributes['data-original-title'].value;
        if (typeof data === "undefined" || data.trim() === '' || data === textEdit) {
            if (confKey === 'SMS_LOGIN') {
                alert('Login to SMS gateway (or API key, Account SID) is required !');
                result = false;
            } else if (confKey === 'SMS_PASSWORD') {
                alert('Password (or Auth token) is required !');
                result = false;
            } else if (confKey === 'SMS_SIGN') {
                alert('Sender (or Service SID) is required !');
                result = false;
            }
        }
        return result;
    }

    $(".dataTableRowSelected .i-switch").click(function () {
        var inputCheck = $(this).find(".switchValue");

        if ($(this).closest('.setValue').data('confKey') === 'SMS_ENABLE') {
            if (smsFieldRequiredErrors()) {
                return false;
            }
        }
        // отримуємо урл для ajax
        var href = inputCheck.data("href");

        if (window.checkAjax == "sent") {
            window.checkAjax = "sending";

            $.post(
                href,
                {
                    href: href
                },
                function (response) {
                    window.checkAjax = "sent";

                    if (response.result == "success") {
                        switch (response.check) {
                            case "true":
                                inputCheck.prop("checked", true);
                                break;
                            case "false":
                                inputCheck.prop("checked", false);
                                break;
                        }

                        if (inputCheck.parents('td').hasClass('ROBOTS_TXT')) {
                            updateErrorsAlert();
                        }
                        inputCheck.data("href", response.newHref);
                        if (inputCheck.parents('.setAndShowCriticalWindow').length > 0) {
                            if (inputCheck.parents('.setAndShowCriticalWindow').attr('data-conf-key') == 'USE_CRITICAL_CSS' && response.check == 'false') {
                                setAndShowCriticalWindow(0);
                            } else {
                                setAndShowCriticalWindow(1);
                            }
                        }
                    }
                },
                "json"
            );
        }

        return false;
    });

    /*
     Settings
     */
    var $app = $(".app"),
        $settingsHeaderFixed = $(".settings-header-fixed"),
        $settingsAsideFixed = $(".settings-aside-fixed"),
        $settingsAsideFolded = $(".settings-aside-folded"),
        $settingsAsideDock = $(".settings-aside-dock");

    $settingsHeaderFixed.val("off");
    if ($app.hasClass("app-header-fixed")) {
        setTimeout(function () {
            $settingsHeaderFixed.click();
        }, 100);
    }

    $settingsAsideFixed.val("off");
    if ($app.hasClass("app-aside-fixed")) {
        setTimeout(function () {
            $settingsAsideFixed.click();
        }, 100);
    }

    $settingsAsideFolded.val("off");
    if ($app.hasClass("app-aside-folded")) {
        setTimeout(function () {
            $settingsAsideFolded.click();
        }, 100);
    }

    $settingsAsideDock.val("off");
    if ($app.hasClass("app-aside-dock")) {
        setTimeout(function () {
            $settingsAsideDock.click();
        }, 100);
    }

    $settingsHeaderFixed.change(function () {
        var state = $settingsHeaderFixed.val();

        if (state == "on") {
            $app.removeClass("app-header-fixed");
            $settingsHeaderFixed.val("off");
        } else {
            $app.addClass("app-header-fixed");
            $settingsHeaderFixed.val("on");
        }
    });

    $settingsAsideFixed.change(function () {
        var state = $settingsAsideFixed.val();

        if (state == "on") {
            $app.removeClass("app-aside-fixed");
            $settingsAsideFixed.val("off");

            $settingsHeaderFixed.removeAttr("disabled");
        } else {
            $app.addClass("app-aside-fixed");
            $settingsAsideFixed.val("on");

            if ($app.hasClass("app-aside-dock")) {
                if (!$app.hasClass("app-header-fixed")) {
                    $settingsHeaderFixed.click();
                }

                $settingsHeaderFixed.attr("disabled", "disabled");
            }
        }
    });

    $settingsAsideFolded.change(function () {
        var state = $settingsAsideFolded.val();

        if (state == "on") {
            $app.removeClass("app-aside-folded");
            $settingsAsideFolded.val("off");
        } else {
            $app.addClass("app-aside-folded");
            $settingsAsideFolded.val("on");
        }
    });

    $settingsAsideDock.change(function () {
        var state = $settingsAsideDock.val();

        if (state == "on") {
            $app.removeClass("app-aside-dock");
            $settingsAsideDock.val("off");

            $settingsHeaderFixed.removeAttr("disabled");
        } else {
            $app.addClass("app-aside-dock");
            $settingsAsideDock.val("on");

            if ($app.hasClass("app-aside-fixed")) {
                if (!$app.hasClass("app-header-fixed")) {
                    $settingsHeaderFixed.click();
                }

                $settingsHeaderFixed.attr("disabled", "disabled");
            }
        }
    });

    $("#ajaxModal").on("shown.bs.modal", function () {
        // tooltip on modal shown
        $('#ajaxModal [data-toggle="tooltip"]').tooltip();

        $("#ajaxModal .modal-preview-btn.ajax-modal").on("click", function () {
            var error_coupon_name = true;
            var error_coupon_amount = true;

            $.each($('#ajaxModal [name^="coupon_name"]'), function (i, value) {
                if ($(value).val().length !== 0) {
                    error_coupon_name = false;
                }
            });

            if (
                $('#ajaxModal [name="coupon_amount"]').val().length !== 0 ||
                $('#ajaxModal [name="coupon_free_ship"]').prop("checked")
            ) {
                error_coupon_amount = false;
            }

            if (error_coupon_name === true || error_coupon_amount === true) {
                $(this).addClass("ajax-modal-lg");
            }
        });
    });

    $(document).on("click", "#menu-clear-image-cache", function (e) {
        e.preventDefault();
        $.ajax("ajax_clear_image_cache.php").done(function (msg) {
            show_tooltip(msg, 1500);
        });
    });

    $(".orders-table").on("change", 'input[type="checkbox"]', function () {
        var activeCheckBoxes = 0;
        var editOrderCheckBoxes = $(".orders-table").find('input[type="checkbox"]');
        editOrderCheckBoxes.each(function (checkBoxID) {
            if ($(this).prop("checked")) activeCheckBoxes++;
        });
        if (activeCheckBoxes > 0) {
            $(".orders-edit-buttons").css("height", "44px");
        } else {
            $(".orders-edit-buttons").css("height", "0");
        }
    });

    $('.selectize-input .item').each(function (i, e) {
        var item = $(this);
        var str_to_array = item.text().split('');
        var clean_text = item.text();
        for (i = 0; i <= str_to_array.length; i++) {
            if (str_to_array[i] == '-') {
                clean_text = clean_text.replace('-', '');
            } else {
                break;
            }
        }
        item.text(clean_text);


    })

    // Конец $(document).ready();
});

/*
 Если у элемента есть класс 'ajax' и href, data-href или action атрибут, отправляем AJAX-запрос на него
 */
$(document).on("click", ".ajax:not(.ajax-loader-invisible)", function (event) {
    event.preventDefault();
    event.stopPropagation();

    var $that = $(this);
    var thatMethod = "get";
    var thatHref = undefined;
    var thatData = {};

    if ($that.is(":input")) {
        /*
           Если элемент - инпут, ищем у него форму, также, если элемент - инпут в модальном окне, ищем форму во всей модалке
           */
        var $thatForm = $that.parents("form");

        // Check if not empty required fields
        if (!checkRequired($thatForm)) {
            return false;
        }

        if ($that.is(".modal-dialog :input")) {
            var $thatModal = $that.parents(".modal-dialog");
            $thatForm = $thatModal.find("form");
        }

        /*
           Если у формы есть атрибут 'method', берем значение метода из него
           */
        if ($thatForm.attr("method") !== undefined) {
            thatMethod = $thatForm.attr("method");
        }

        thatHref = $thatForm.attr("action");
        thatData = $thatForm.serializeArray();
    } else if ($that.is(".i-switch")) {
        /*
           Если элемент - свич, берем адрес запроса у него в атрибуте data-href
           */
        var $thatInput = $that.find("input");
        thatHref = $thatInput.data("href");
    }

    /*
     Если адрес запроса найден, отправляем AJAX-запрос
     */
    if (thatHref !== undefined) {
        $that.addClass("ajax-loader-invisible");
        $[thatMethod](
            thatHref,
            thatData,
            function (response) {
                if (response.errors) {
                    show_tooltip(response.errors, 1000);
                }
                if ($that.is(".modal-dialog :input")) {
                    /*
                         Если необходимо обновить панель
                         */
                    if (response.updated_panel && window.editableRow) {
                        var $thatPanel = window.editableRow.parents(".panel");
                        $thatPanel.parent().html(response.updated_panel);
                    }

                    /*
                         Если необходимо обновить какие-либо колонки в таблице
                         */
                    if (response.updated_cols && window.editableRow) {
                        $.each(response.updated_cols, function (key, value) {
                            window.editableRow.find(".col-name-" + key).html(value);
                        });
                    }

                    /*
                         Если необходимо произвести какие-либо действия с модальным окном
                         */
                    if (response.modal) {
                        $.each(response.modal, function (key, value) {
                            $("#ajaxModal").modal(value);
                        });
                    }

                    if (response.msg) {
                        show_tooltip(response.msg, 1500);
                    }

                    window.editableRow = undefined;
                } else if ($that.is(".i-switch")) {
                    /*
                         Если элемент - свич, изменяем его состояние
                         */
                    if (response.checked) {
                        $thatInput.prop("checked", false);
                        $thatInput.removeAttr("checked");
                    } else {
                        $thatInput.prop("checked", true);
                        $thatInput.attr("checked", "checked");
                    }

                    if ($that.attr("data-original-title") !== undefined) {
                        $that.attr("data-original-title", response.title);
                    } else {
                        $that.attr("title", response.title);
                    }
                }

                $that.removeClass("ajax-loader-invisible");
            },
            "json"
        );
    }
});

/*
 Если у ссылки есть класс 'ajax-modal', отправляем AJAX-запрос по адресу из ее href атрибута,
 ответ на запрос вставляем в модальное окно на странице и показываем его
 */
$(document).on("click", ".ajax-modal", function (event) {
    event.preventDefault();
    event.stopPropagation();

    var $that = $(this);
    var $thatRow = $that.parents(".table tr");
    var thatMethod = "get";
    var thatHref = undefined;
    var thatData = {};

    if (!$that.hasClass('ajax-loader-invisible')) {
        if (window.editableRow === undefined) {
            if ($thatRow[0] !== undefined) {
                window.editableRow = $thatRow;
            } else {
                $thatRow = $that.parents(".panel-heading");

                if ($thatRow[0] === undefined) {
                    $thatRow = $that.parents(".panel-footer");
                }

                window.editableRow = $thatRow;
            }
        }

        /*
         Ищем ссылку, на которую будем отправлять AJAX-запрос
         */
        if ($that.is("a")) {
            thatHref = $that.attr("href");
        } else if ($that.data("href")) {
            thatHref = $that.data("href");
        } else if ($that.is(":input")) {
            /*
               Если элемент - инпут, ищем у него форму, также, если элемент - инпут в модальном окне, ищем форму во всей модалке
               */
            var $thatForm = $that.parents("form");

            if ($that.is(".modal-dialog :input")) {
                var $thatModal = $that.parents(".modal-dialog");
                $thatForm = $thatModal.find("form");
            }

            /*
               Если у формы есть атрибут 'method', берем значение метода из него
               */
            if ($thatForm.attr("method") !== undefined) {
                thatMethod = $thatForm.attr("method");
            }

            thatHref = $thatForm.attr("action");
            thatData = $thatForm.serializeArray();
        }

        /*
         Класс с размером модального окна
         */
        var modalSize = "";

        if ($that.hasClass("ajax-modal-sm")) {
            modalSize = "modal-sm";
        } else if ($that.hasClass("ajax-modal-lg")) {
            modalSize = "modal-lg";
        }

        if (thatHref !== undefined) {
            $that.addClass("ajax-loader-invisible");
            $[thatMethod](
                thatHref,
                thatData,
                function (response) {
                    $("#ajaxModal .modal-dialog").removeClass("modal-sm modal-lg");

                    if (modalSize.length) {
                        $("#ajaxModal .modal-dialog").addClass(modalSize);
                    }

                    $("#ajaxModal .modal-dialog").html(response);

                    if ($("#ajaxModal").is(":visible")) {
                        $("#ajaxModal").trigger("shown.bs.modal");
                    } else {
                        $("#ajaxModal").modal("show");
                    }

                    $that.removeClass("ajax-loader-invisible");
                },
                "html"
            );
        }
    }
});
$(document).ready(function () {
    //index2.php при resize закрыты вкладки колапса станут открытыми
    $(window).resize(function () {
        if ($(window).width() >= 768) {
            var collapse_block = $(".new_index").find(".collapse");

            $(collapse_block).each(function () {
                if (!$(this).hasClass("in")) {
                    $(this).addClass("in").css("height", "100%");
                    $(this).closest(".new_index_row").find("a.collapsed").removeClass("collapsed");
                }
            });
        }
    });


    $('.sidebar_left').overlayScrollbars({
        resize: "none",
        overflowBehavior: {
            x: "hidden"
        }
    });
    if ($('.horizontal_container').length > 0) {
        if ($(window).width() < 992) {
            $('.horizontal_container').overlayScrollbars({
                resize: "none",
                overflowBehavior: {
                    x: "hidden"
                }
            });
        }
        $(window).resize(function () {
            if ($(window).width() < 992) {
                $('.horizontal_container').overlayScrollbars({
                    resize: "none",
                    overflowBehavior: {
                        x: "hidden"
                    }
                });
            } else {
                if ($('.horizontal_container').hasClass('os-theme-dark')) {
                    $('.horizontal_container').overlayScrollbars().destroy();
                }

            }
        });
    }

    $('#content [data-toggle="tooltip"]').tooltip({
        container: 'body',
        trigger: 'hover',
        html: true,
        placement: 'auto right',
        template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
    });

    $('.sidebar_left [data-toggle="tooltip"], .horizontal_container [data-toggle="tooltip"]').tooltip({
        container: 'body',
        trigger: 'hover',
        html: true,
        template: '<div class="left_m_tooltip tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
    });

    $(document).on("click", ".collapse_link", function () {
        if ($(this).hasClass("collapsed")) {
            $(this).text(lang.all.TEXT_MOBILE_OPEN_COLLAPSE);
        } else {
            $(this).text(lang.all.TEXT_MOBILE_CLOSE_COLLAPSE);
        }
    });
    if ($(".new_index").length != 0) {
        if (IS_MOBILE == 1) {
            $(document).on("click", "#overview-tabs a", function () {
                $("#overview-tabs a")
                    .parent()
                    .removeClass("active");
                $(this)
                    .parent()
                    .addClass("active");

                var collapse_link = $(this)
                    .closest(".action_overview")
                    .find(".collapse_link");
                $(this)
                    .closest(".new_index_title")
                    .find("#action_overview_dropdown")
                    .text($(this).data("role"));
                if (collapse_link.hasClass("collapsed")) {
                    collapse_link.click();
                }
            });

            $(document).on("click", ".show_all_content", function () {
                if ($(this).closest(".events_block")) {
                    $(this)
                        .parent()
                        .animate({height: "360px"}, 300);
                    $(this)
                        .closest(".events_block")
                        .find(".tab-content > div")
                        .animate({height: "350px"}, 300)
                        .overlayScrollbars({
                            resize: "none"
                        });
                }
                if ($(this).closest(".reviews_block")) {
                    $(this)
                        .parent(".reviews_content")
                        .animate({height: "360px"}, 300)
                        .overlayScrollbars({
                            resize: "none"
                        });
                }
                if ($(this).closest(".action_overview")) {
                    $(this)
                        .parent(".action_overview")
                        .animate({height: "360px"});
                    $(this)
                        .closest(".action_overview")
                        .find(".tab-content > div")
                        .animate({height: "360px"}, 300)
                        .overlayScrollbars({
                            resize: "none"
                        });
                }
                $(this).css("display", "none");
            });
        }

        // If desktop
        if (IS_MOBILE != 1) {
            // On click Show More button, init scrollbar
            $(document).on("click", ".show_all_content_button", function (e) {
                var _this = $(this);

                // Define loader block
                var loader = "<div class='loader-container'><div class='loader'></div></div>";

                // Define page for current tab (0 as default)
                var currentPage = 0;

                // Adding current page attr
                $("#action_overview_content").find(".tab-pane").each(function (key) {
                    $(this).attr('data-page', currentPage);
                    // $(this).attr('data-fetch-again', 'active');
                });

                // Define template path
                const tplFilePath = origin + adminFolder + "/includes/solomono/js/components/";

                // Init scroll (on click)
                _this
                    .parents("#action_overview_content")
                    .find(".tab-pane")
                    // Show scroll of current container
                    .removeClass("hidden-scroll")
                    // Init custom scroll
                    .overlayScrollbars({
                        resize: "none",
                        callbacks: {
                            onInitialized: function (e) {
                                // console.log(hello);
                            },
                            onScroll: function (e) {
                                // Current tab
                                var thisTab = $(e.target);
                                var currentTab = $(this);

                                // Selected tab id (to file requesting)
                                var thisTabId = $(e.target).parents('.tab-pane').attr('id');

                                // Selected tab page (to request next page through Ajax)
                                var thisTabPage = $(e.target).parents('.tab-pane').attr('data-page');

                                // Refactor "most-viewed" to "MostViewed"
                                const capitalize = (s) => {
                                    if (typeof s !== 'string') return '';
                                    return s.charAt(0).toUpperCase() + s.slice(1)
                                }
                                var templateFunction = (thisTabId.split('-', 2).map(item => capitalize(item))).join().replace(",", "");
                                // console.log(templateFunction);

                                // Get height of current tab
                                var thisTabHeight = thisTab.innerHeight();

                                // Current tab scroll position px
                                scrollTop = e.target.scrollTop;

                                // Get height of current tab's content
                                var thisTabContentHeight = thisTab
                                    .find("table.table")
                                    .innerHeight();

                                // Current scroll position percentage
                                var currentPosition = Math.round(
                                    ((scrollTop + thisTabHeight) / thisTabContentHeight) * 100
                                );

                                // Get current tab's status
                                var fetchStatus = thisTab.parents('.tab-pane').attr('data-fetch-again');

                                // If no more data to fetch, prevent requesting
                                if (fetchStatus != 'sleep') {
                                    // If the user scrolls down more than n% of tab content
                                    if ((scrollTop + thisTabHeight) == thisTabContentHeight) {
                                        // Adding loaders
                                        thisTab.parents('.tab-pane').append(loader);

                                        // Set overflow state as default
                                        thisTab.find('.os-viewport').removeClass('hidden-overflow-y');

                                        // Sleep scroll on position equals 100%
                                        currentTab[0].sleep();

                                        // Show loader when reach bottom
                                        thisTab.find(".loader-container").show();

                                        // Send request to get new rows
                                        $.ajax({
                                            url: "./includes/index/orders-schedule/" + templateFunction + ".php",
                                            type: "POST",
                                            data: {next_page: parseInt(thisTabPage) + 1},
                                            dataType: "json",
                                            success: function (response) {

                                                // If there is data so status true, render elements
                                                if (response.status === true) {
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
                                                        // thisTab.find('tbody').append(renderMostViewed(item));
                                                        thisTab.find('tbody').append(eval(templateFunction)(item));
                                                    });


                                                    // Render items for each element from repsonse data
                                                    response.data.forEach(product => {

                                                        // // Define image
                                                        // var image_file_name = product.images.split(';', 1)[0];
                                                        // image_file_name
                                                        //   ? image_file_name = '../getimage/50x50/products/' + image_file_name + ''
                                                        //   : image_file_name = '../getimage/50x50/products/default.png';


                                                        // // Render element
                                                        // var itemTemplate = "<tr>"+
                                                        //                     "<td class='text-xs'>"+ product.id +"</td>"+
                                                        //                     "<td class='text-xs'><img src='"+ image_file_name +"' alt='"+ product.name +"' title='"+ product.name +"'></td>"+
                                                        //                     "<td class='text-xs'>"+ product.name +"</td>"+
                                                        //                     "<td class='text-xs'>"+ product.views +"</td>"+
                                                        //                     "<td class='text-info text-xs'><a href='"+ response.defines.DIR_WS_CATALOG +"product_info.php?products_id="+ product.id +"' target='_blank'>"+ response.defines.TEXT_BLOCK_OVERVIEW_ACTION_VIEW +"</a></td>"+
                                                        //                     "</tr>";

                                                        // Add element on page
                                                        // thisTab.find('tbody').append(itemTemplate);
                                                    });
                                                } else {
                                                    console.log(response);

                                                    // Set tab's status as sleep (no more data to fetch)
                                                    thisTab.parents('.tab-pane').attr('data-fetch-again', 'sleep');

                                                    // Render message "no more data"
                                                    $('<span class="no-more-data-loader">No more data to load.</span>').insertAfter(thisTab.find('.table'));
                                                }

                                                // Overwrite current tab's page
                                                thisTab.parents('.tab-pane').attr('data-page', parseInt(thisTabPage) + 1);
                                            }
                                        }).done(function (e) {
                                            setTimeout(() => {
                                                // Remove loader on any response
                                                thisTab.parents('.tab-pane').find('.loader-container').remove();

                                                // Set overflow state as hidden
                                                thisTab.find('.os-viewport').addClass('hidden-overflow-y')/*.css({'overflow-y' : 'hidden'})*/;

                                                // Update scroll anyway
                                                currentTab[0].update();
                                            }, 0);
                                        });
                                    } else {

                                        // Hide loader
                                        thisTab.find(".loader-container").hide();
                                    }
                                }


                            }
                        }
                    });

                // Remove self ("load more button")
                $(this)
                    .parent()
                    .remove();
            });

            // Get current active tab in Actions Block
            var activeTab = $("#action_overview_content").find(".tab-pane");

            activeTab.overlayScrollbars({
                callbacks: {
                    onScroll: function (eventArgs) {
                        // console.log(1234);
                    }
                }
            });

            var sTop = activeTab.scrollTop();

            $("#action_overview_content")
                .find(".tab-pane.active")
                .scroll(function (e) {
                    // activeTab('scroll', function (e) {ß
                });
        }
    }
});
$(document).on("click", ".go_to_cat", function (event) {
    var href = $(this).siblings('.redirect').find('.has-items .item').attr('data-value');
    window.location.href = href;
});

var select_category = $('.cat_tree_dropdown').selectize({
    valueField: 'id',
    labelField: 'name',
    placeholder: $(this).attr('data-placeholder'),
    searchField: ['name'],
    maxOptions: 100000,
    onDropdownOpen: function () {
        $('.selectize-dropdown-content .option').each(function (i, e) {
            var nest = 0;
            var str_to_array = $(this).text().split('');
            var clean_text = $(this).text();
            for (i = 0; i <= str_to_array.length; i++) {
                if (str_to_array[i] == '-') {
                    nest++;
                    clean_text = clean_text.replace('-', '');
                } else {
                    break;
                }
            }

            var current_class = $(this).attr('class');
            if (current_class.indexOf("nest-") < 0) {
                $(this).addClass('nest-' + nest);
                $(this).html('<i class="line"></i><span>' + clean_text + '</span>');
            }

        })
    },
    onItemAdd: function (value, $item) {
        var str_to_array = $item.text().split('');
        var clean_text = $item.text();
        for (i = 0; i <= str_to_array.length; i++) {
            if (str_to_array[i] == '-') {
                clean_text = clean_text.replace('-', '');
            } else {
                break;
            }
        }
        $item.text(clean_text);

        if ($item.parent().parent().hasClass('redirect')) {
            $item.parent().parent().siblings('.go_to_cat').trigger('click');
        }
    },
    onFocus: function (value) {
        this.clear();
    }
});
$('.rented_cert.no').on('click', function () {
    var text = $('#are_you_sure_text').val();

    if (confirm(text) === true) {
        $('.rented_cert.no').append('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
        var sitename = $('td[data-conf-key="DOMEN_URL"] span').text();
        $.ajax({
            url: "includes/widgets/DomenNameChange/AddPersonalSSL.php",
            type: "POST",
            data: {sitename: sitename},
            success: function (data) {
                if(data != ''){
                    var text_response = $('input[name='+data+']').val();
                    $('.rented_cert').text(text_response);
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(textStatus + '\n' + errorThrown);
            }
        });
    }

    setTimeout(function () {
        $.ajax({
            url: "/ssl",
            type: 'HEAD',
            success: function () {
                console.log('ssl exists');
                $.ajax({
                    url: "includes/widgets/DomenNameChange/AddPersonalSSL.php",
                    type: "POST",
                    data: {sitename: sitename, part: "part_two"},
                    success: function (data) {
                        $('.rented_cert').removeClass('no');
                        $('.rented_cert').addClass('yes').text(data);
                        console.log(data);
                        location.protocol = "https:";
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        console.log(textStatus + '\n' + errorThrown);
                    }
                })
            },
            error: function () {
                console.log("ssl doesn't exists");
            }
        });
    }, 6000)
})