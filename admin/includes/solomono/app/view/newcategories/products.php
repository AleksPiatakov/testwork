<?php
//echo "<pre>";
//print_r($data);
//echo "</pre>";
//debug($action);
//exit;
require('includes/widgets/ShowMore/ShowMore.php'); ?>
<div class="wrapper-title products-mob-wrapper">
    <div class="bg-light lter ng-scope products-mob-wrapper-md">
        <h1 class="m-n font-thin h3 products-mob-h3"><?= HEADING_TITLE; ?></h1>
        <button class="btn_own" id="add" data-action="new_<?= $action ?>" data-toggle="tooltip" data-placement="top"
                title="<?= TEXT_MODAL_ADD_ACTION ?>">
            <svg width="44px" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="#58666e"
                      d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm144 276c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92h-92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z"
                      class=""></path>
            </svg>
        </button>
    </div>
</div>
<table id="own_table"
       class="table table-hover table-bordered bg-white-only b-t b-light <?= $action; ?> products-mob-tr">
    <thead>
    <tr>
        <?php foreach ($data['allowed_fields'] as $key => $value):
            if ($value['show'] === false) {
                continue;
            } ?>
            <th data-table="<?= $key ?>"><?= trim($value['label']); ?>
                <?php if (!empty($value['filter'])) : ?>
                    <input type="text" class="search">
                <?php endif; ?>
                <?php if ($value['sort'] === true): ?>
                    <i class="fa fa-sort fa-1x" aria-hidden="true"></i>
                <?php endif; ?>
            </th>
        <?php endforeach; ?>
        <th align="center" style="width: 130px;text-align: center;">
            <p class="btn_own" data-toggle="tooltip" data-placement="bottom"
               title="<?= getConstantValue("TEXT_MODAL_ACTION", ""); ?>">
                <i class="fa fa-exclamation-circle"></i>
            </p>
        </th>
    </tr>
    </thead>
    <tbody></tbody>
</table>
<div class="row row_pagin_admin">
    <div class="pagin_admin">
        <label><?= TEXT_SHOW ?>
            <select name="per_page" id="per_page" style="width: 75px; display: inline-block;"
                    class="form-control input-sm">
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <?= TEXT_RECORDS ?>
            <span id="count_prod"></span>
        </label>
    </div>
    <?php echo (new ShowMore) -> init($action, 'newcategories.php'); ?>
    <div id="own_pagination"></div>
</div>
<!--  button for action -->
<div style="display: none" id="action" align="center">
    <button class="btn_own edit_row" data-action="edit_<?= $action ?>" data-toggle="tooltip" data-placement="top"
            title="<?= getConstantValue("TEXT_MODAL_UPDATE_ACTION", "") ?>">
        <i class="fa fa-pencil-square-o"></i>
    </button>
    <button data-toggle="tooltip" data-action="delete_<?= $action ?>" data-placement="top"
            title="<?= getConstantValue("TEXT_MODAL_DELETE_ACTION", "") ?>" class="btn_own del_link">
        <i class="fa fa-trash-o"></i>
    </button>
    <button data-toggle="tooltip" data-action="copy_<?= $action ?>" data-placement="top"
            title="<?= getConstantValue("TEXT_MODAL_COPY_ACTION", "") ?>" class="btn_own copy_<?= $action ?>">
        <i class="fa fa-copy"></i>
    </button>
    <a target="_blank" href="<?= HTTP_SERVER . '/product_info.php'; ?>" data-toggle="tooltip"
       title="<?= getConstantValue("TEXT_MODAL_LINK_ACTION", "") ?>" class="btn_own link_<?= $action ?>">
        <i class="fa fa-external-link-square" aria-hidden="true"></i>
    </a>
</div>
<script>
    $(document).ready(function () {
        $('#xsell').prop("checked", (option.xsell == 'yes') ? true : false);
        $('#xsell').on('change', function () {
            option.xsell = $(this).is(':checked') ? 'yes' : 'no';
            option.page = 1;
            delete (option.count);
            $('#own_pagination').pagination('selectPage', option.page);
        });
        if ($('ul#categories li[data-category="' + option.tPath + '"]').length) {
            var e = $('ul#categories li[data-category="' + option.tPath + '"]');
            init(e);
        } else {
            init($('ul#categories li').eq(0));
        }

        $('ul#categories').on('click', 'li a>span.badge', function (el) {
            var $this = $(this);
            $this.parents('span.item').toggleClass('active').next().children().addClass('slideInLeft animated');
            el.preventDefault();
        });

        $('#categories li>a').on('click', function (e) {
            e.preventDefault();
            init($(this).closest('li'));
            option.tPath = $(this).parent().data('category');
            if (option.tPath == 'all') delete (option.tPath);
            option.page = 1;
            delete (option.count);
            $('#own_pagination').pagination('selectPage', option.page);
        });

        $('.plus.fa-plus-circle').on('click', function () {
            getCategories({action: 'category'});
        });

        $('ul#categories').on('click', 'li .fa-arrow-circle-left', function () {
            $(this).parent().remove();
        });

        $('ul#categories').on('click', ' li .fa-pencil', function () {
            var tPath = $(this).closest('li').data('category');
            getCategories({tPath: tPath, action: 'category'});
        });

        $('ul#categories').on('click', ' .settings_cat', function () {
            var $this = $(this);
            if (!$this.parent().find('.settings_panel').length) {
                $('.settings_panel').remove();
                $this.parent().append('<div class="drop-icons slideInLeft animated settings_panel">' +
                    '<i class="fa fa-fw fa-arrow-circle-left" aria-hidden="true"></i>' +
                    '<i class="fa fa-pencil" aria-hidden="true"></i>' +
                    '<i class="fa fa-trash-o" aria-hidden="true"></i>' +
                    '<i class="fa fa-arrows" aria-hidden="true"></i></div>');
            }
        });

        $('ul#categories').on('click', ' li .fa-trash-o', function () {
            var tPath = $(this).closest('li').data('category');
            $.ajax({
                url: window.location.pathname,
                type: "POST",
                data: {tPath: tPath, action: 'delete_category'},
                dataType: 'json',
                success: function (response) {
                    modal({
                        title: response.title,
                        body: response.html,
                        width: '60%',
                        after: function (modal) {
                            $(modal).find('input[type="submit"]').on("click", {tPath: tPath}, confirmDeleteCategory);
                        }
                    });
                }
            });
        });

        $('ul#categories').on('click', 'li .fa-arrows', function () {
            var $replace = $(this).parent();
            var name = $(this).closest('li').find('a').text();
            $.ajax({
                url: window.location.pathname,
                type: "POST",
                data: {
                    name: name,
                    action: 'move_category'
                },
                dataType: 'json',
                success: function (response) {
                    $($replace).after(response.html);
                }
            });
        });

        $('ul#categories').on('click', '.list-action .fa-check-circle', function () {
            var moveTo = $(this).closest('.chose-cat').find(':selected').val();
            var categoryId = $(this).closest('li').data('category');
            if (!moveTo == '' && moveTo != categoryId) {
                $.ajax({
                    url: window.location.pathname,
                    type: "POST",
                    data: {action: 'move_category', categoryId: categoryId, moveTo: moveTo},
                    dataType: 'json',
                    success: function (response) {
                        if (response.success == true) {
                            $('ul#categories').empty().prepend(response.html);
                        }
                        show_tooltip(response.msg, 3000);
                    }
                });
            }
        });

        $('body').on('click', 'td[data-name="products_name"],td[data-name="sort_order"]', function () {
            $(this).closest('tr').find('.edit_row').click();
        });

        $('body').on('focus', '.pr', function (e) {
            var $this = $(this);
            var form = $this.closest('form');
            var productsId = form.find('[name="id"]').val();
            $this.autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: window.location.pathname,
                        dataType: "json",
                        data: {
                            search: request.term,
                            action: 'getProduct'
                        },
                        success: function (data) {
                            response(data);
                        }
                    });
                },
                delay: 50,
                minLength: 2,
                select: function (event, ui) {
                    $.post(window.location.pathname, {
                        action: "addProduct",
                        xsellId: ui.item.id,
                        productId: productsId
                    }, function (response) {
                        if (response.success == true) {
                            //$this.val('(' + ui.item.id + ' #' + ui.item.model + ') ' + ui.item.label);
                            $this.val(ui.item.label);
                            $this.attr('data-id', ui.item.id);
                            $this.addClass('disabled').after('<i class="fa ft_own fa-lg fa-times" aria-hidden="true"></i>');
                        } else {
                            $this.val('');
                        }
                        show_tooltip(response.msg, 2000, form)
                    }, "json").done(function () {
                    });
                    return false;
                }
            }).autocomplete("instance")._renderItem = function (ul, item) {
                ul.css('z-index', 9999);
                return $("<li>")
                    .append("<div>(" + item.id + ") " + item.label + " " + item.model + "</div>")
                    .appendTo(ul);
            };
        });

        $('body').on('click', '.ft_own.fa-times', function (e) {
            var $this = $(this);
            var form = $this.closest('form');
            var productsId = form.find('[name="id"]').val();
            var xsellId = $(this).prev('input').data('id');
            $.post(window.location.pathname, {
                productsId: productsId,
                xsellId: xsellId,
                action: "delete_xselId"
            }, function (response) {
                if (response.success == true) {
                    $this.parent().parent().remove();
                }
            }, "json");
        });

        $('#own_table').on('click', '.link_products_description', function () {
            var id = $(this).closest('tr').data('id');
            $(this).attr('href', $(this).attr('href') + '?products_id=' + id);
        });

        $('#own_table').on('click', '.copy_products_description', function () {
            var data = {};
            data.id = $(this).parents('tr').data('id');
            data.action = $(this).data('action');
            $.ajax({
                url: window.location.href,
                type: "POST",
                data: data,
                dataType: 'json',
                success: function (response) {
                    modal({
                        body: response.html,
                        width: '60%',
                        after: function (modal) {
                            $(modal).find('input[type="submit"]').on("click", function (e) {
                                e.preventDefault();
                                var form = $(this).closest('form');
                                var data = form.serializeArray();

                                $.ajax({
                                    url: $(form).attr('action'),
                                    type: $(form).attr('method'),
                                    data: data,
                                    dataType: 'json',
                                    success: function (response) {
                                        $(modal).modal('hide');
                                        show_tooltip(response.msg, 2500);
                                        setTimeout(function () {
                                            location.reload();
                                        }, 2500);

                                    }
                                });
                            });
                        }
                    });
                }
            });
        });
    });

    function getCategories(data) {
        $.ajax({
            url: window.location.pathname,
            type: "GET",
            data: data,
            dataType: 'json',
            success: function (response) {
                modal({
                    id: 'category',
                    title: response.title,
                    body: response.html,
                    width: '90%',
                    before: function () {
                        ckFinderBuilder();
                    },
                    after: function (modal) {
                        var form = $(modal).find('form');
                        var lang = $(modal).find('ul#lang>li');
                        var del_file = $(modal).find('form button .fa-trash-o');
                        del_file.on('click', delFile);
                        lang.on('click', changeLang);
                        form.on('click', 'input[type="submit"]', function (e) {
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
                                    if (response.success == true) {
                                        $('ul#categories').empty().prepend(response.html);
                                        $(modal).modal('hide');
                                    }
                                    show_tooltip(response.msg, 3000);
                                }
                            });
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
                    }
                });
            }
        });
    }

    function confirmDeleteCategory(e) {
        var tPath = e.data.tPath;
        $('.modal').modal('hide').on('hidden.bs.modal', function () {
            $(this).remove();
        });
        $.ajax({
            url: window.location.pathname,
            type: "POST",
            dataType: 'json',
            data: {tPath: tPath, action: 'confirm_delete_category'},
            success: function (response) {
                if (response.success == true) {
                    window.location.href = window.location.pathname;
                } else {
                    show_tooltip('error', 3000);
                }
            }
        });
    }

    function createInput() {
        var wrapper = $("<div class='col-sm-11'></div>");
        var input = $('<div class="form-group"><input type="text" class="pr form-control"></div>');
        wrapper.append(input);
        $(this).parents('.active').append(wrapper);
    }

    function init(li_element) {
        var title = '';
        $('#categories li').removeClass('active');
        li_element.find('a span.category_ttl').first().text(function (index, el) {
            title += el + ' ';
        });
        $('h1.m-n').text(title ? title : $('h1.m-n').text());
        li_element.addClass('active');
    }

    $('body').on('click', '#categories .item', function (e) {
        var tPath = $(this).parent().attr('data-category');
        e.preventDefault();
        $('tbody').empty();
        if (typeof tPath === 'undefined') {
            tPath = 0;
        }

        if ($.isNumeric($(this).data('count'))) {
            option.count = $(this).data('count');
        } else {
            option.count = 0;
        }

        option.tPath = tPath;
        history.pushState(null, null, 'newcategories.php?page=' + option.page + '&perPage=' + option.perPage + '&tPath=' + option.tPath);
        init($(this).closest('li'));
        renderData('show');
        $('#own_pagination').pagination('selectPage', option.page);
    });
</script>