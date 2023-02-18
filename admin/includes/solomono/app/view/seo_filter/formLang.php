<?php
//debug($data);
//debug($action);
//exit;
?>
<ul class="nav nav-tabs col-md-offset-3" id="lang">
    <?php foreach ($data['languages'] as $k => $v): ?>
        <?php $class = ($v['language_id'] == $_SESSION['languages_id'] ? ' class="active"' : ''); ?>
        <li <?php echo $class;?>>
            <a href="#" data-lang="<?php echo $k?>"><?php echo $v['code']?></a>
        </li>
    <?php endforeach; ?>
</ul>
<?php $action_form = (!empty($data['data'])) ? "update_$action" : "insert_$action"; ?>

<form class="form-horizontal" action="<?php echo ($_SERVER['SCRIPT_URL']?:$_SERVER['SCRIPT_NAME']) . '?action=' . $action_form;?>" method="post" enctype="multipart/form-data">
    <?php if (!empty($data['data'])): ?>
        <input type="hidden" name="id" value="<?php echo current($data['data'])['id']?>">
    <?php endif; ?>
    <div class="col-md-3">
        <h3><?php echo TEXT_GENERAL_SETTING;?></h3>

        <?php foreach ($data['allowed_fields'] as $field_name => $option): ?>
            <?php if (isset($option['general'])): ?>
                <?php $current = !empty($data['data']) ? current($data['data']) : null; ?>
                <?php $val = $current[$field_name] !== '' ? $current[$field_name] : ''; ?>
                <div class="form-group">
                    <label for="<?php echo $field_name;?>" class="col-sm-12 control-label"><?php echo addDoubleDot($option['label']);?></label for="<?php echo $field_name;?>" class="col-sm-12 control-label">
                    <div class="col-sm-12">
                        <?php if ($option['general'] == 'file'): ?>
                            <input type="<?php echo $option['general']?>" name="<?php echo $field_name?>" id="<?php echo $field_name?>" class="form-control">
                            <?php $path = DIR_WS_IMAGES . $val; ?>
                            <?php if (file_exists(DIR_FS_CATALOG . $path) && !is_dir(DIR_FS_CATALOG . $path)): ?>
                                <img src="/<?php echo $path;?>" style="max-width: 60px;">
                                <button data-toggle="tooltip" data-action="delete_image" data-placement="top" title="" class="btn_own del_link" data-original-title="Delete">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            <?php else: ?>
                                <span><?php echo TEXT_IMAGE_NONEXISTENT?></span>
                            <?php endif; ?>
                        <?php elseif ($option['general'] == 'select'): ?>
                            <?php
                            if(!empty($data['data'])) {
                                $generalData = end($data['data']); // get date for general field
                            }
                            /**
                             * Mapping for selection
                             */
                            $selectMapping = [
                                "categories_name"    => "categories_id",
                                "manufacturers_name" => "manufacturers_id",
                                "filter_1"           => "filter_id_1",
                                "filter_2"           => "filter_id_2"
                            ];

                            ?>
                            <select class="form-control" name="<?php echo $field_name;?>" id="<?php echo $field_name;?>">
                                <?php if($field_name === "filter_1" || $field_name === "filter_2"): ?>
                                    <option value="0">---</option>



                                    <?php foreach ($data["optionsToFilters"] as $o => $f): ?>
                                        <optgroup label="<?=$data['options'][$o]?>">
                                            <?php foreach ($f as $filterId): ?>
                                                <?php
                                                $selected = "";
                                                if(isset($selectMapping[$field_name]) && (int)$generalData[$selectMapping[$field_name]] == (int)$filterId) {
                                                    $selected = "selected";
                                                }
                                                ?>
                                                <option value="<?=$filterId?>" <?=$selected?>><?=$data['filters'][$filterId]?></option>
                                            <?php endforeach;?>
                                        </optgroup>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <?php foreach ($data['option'][$field_name] as $k => $v): ?>
                                        <option value="<?php echo $k;?>" <?php echo (int)$k == (int)$generalData[$selectMapping[$field_name]] ? 'selected' : '';?> ><?php echo $v;?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>

                        <?php elseif ($option['general'] == 'radio'): ?>
                            <div class="radio">
                                <label>
                                    <input type="radio" <?php echo ($val == 1) ? 'checked' : '';?> name="<?php echo $field_name?>" value="1">
                                    true
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input <?php echo $val?> type="radio" <?php echo empty($val) ? 'checked' : '';?> name="<?php echo $field_name?>" value="0">
                                    false
                                </label>
                            </div>
                        <?php elseif ($option['general'] == 'disabled'): ?>
                            <input type="text" <?php echo $option['general'];?> value="<?php echo $val?>" id="<?php echo $field_name?>" class="form-control">
                        <?php else: ?>
                            <input type="<?php echo $option['general']?>" value="<?php echo $val?>" name="<?php echo $field_name?>" class="form-control" id="<?php echo $field_name?>">
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>

    </div>
    <div class="col-md-9">
        <?php foreach ($data['languages'] as $k => $v): ?>
            <?php $class = ($v['language_id'] == $_SESSION['languages_id'] ? ' class="active"' : ''); ?>
            <div data-lang="<?php echo $k;?>" <?php echo $class;?>>
                <h3 class="text-center"><?php echo ADD_LANGUAGE_TEXT . $data['languages'][$k]['name']?></h3>
                <?php foreach ($data['allowed_fields'] as $field_name => $option): ?>
                    <?php if (!isset($option['type']) || $option['hideInForm'] === true) continue; ?>
                    <?php $val = (!empty($data['data'][$k][$field_name])) ? $data['data'][$k][$field_name] : ''; ?>
                    <?php $field_lan = $field_name . '[' . $k . ']'; ?>
                    <div class="form-group">
                        <label for="<?php echo $field_lan;?>" class="col-sm-3 control-label"><?php echo addDoubleDot($option['label']);?></label>
                        <div class="col-sm-9">
                            <?php if ($option['type'] == 'textarea'): ?>
                                <textarea class="<?php echo $option['ckeditor'] === true ? 'ck_seo_filter_replacer' : ''?> form-control" rows="<?php echo $option['rows'] ?: 6?>" name="<?php echo $field_lan?>"><?php echo $val?></textarea>
                            <?php else: ?>
                                <input type="<?php echo $option['type']?>" value="<?php echo $val?>" name="<?php echo $field_lan?>" class="form-control" id="<?php echo $field_lan?>">
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="form-group text-right">
        <div class="col-sm-12">
            <input type="submit" value="OK" class="btn">
            <button type="button" class="btn btn-info saveInputData"><?php echo TEXT_MODAL_APPLY_ACTION?></button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo TEXT_MODAL_CANCEL_ACTION?></button>
        </div>
    </div>
</form>
<script>

    $(function () {

        // initial
        disableOptions();
        disableManufacturers();
        disableSecondFilter();
        ckFinderBuilderSeoFilter();


        function ckFinderBuilderSeoFilter() {
            var textarea = $('textarea.ck_seo_filter_replacer');

            if (textarea.length !== 0) {
                $('.modal').removeAttr('tabindex');

                textarea.each(function (i, e) {
                    var editor = CKEDITOR.replace($(e).attr('name'), {
                        extraPlugins: 'colorbutton,font,showblocks,justify,codemirror,btgrid',
                        startupFocus: true,
                        height: '275px',
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

        /**
         * Function disable manufacturers select box
         * if filters are enabled
         */
        function disableManufacturers() {
            var filter1 = $("#filter_1").find("option:selected").val();
            var filter2 = $("#filter_2").find("option:selected").val();

            if(filter1 != 0 && filter2 != 0) {
                $("#manufacturers_name").prop("disabled", true);
            }
        }

        /**
         * Disable second filter select box
         * if manufacturers and first filter
         * selected
         */
        function disableSecondFilter() {
            var filter1 = $("#filter_1").find("option:selected").val();
            var manufacturersId = $("#manufacturers_name").find("option:selected").val();

            if(filter1 != 0 && manufacturersId != 0) {
                $("#filter_2").prop("disabled", true);
            }
        }

        /**
         * Function turn all options disabled attributes to false
         * Make them available
         *
         * @param {string} selectId
         */
        function resetSelects(selectId) {
            $("#"+selectId).find("optgroup").each(function () {
                $(this).css("display", "block");
            });
            // $("#"+selectId).find("option").each(function () {
            //     $(this).prop("disabled", false);
            // });
        }

        /**
         * Function disabled option in dedicated select box
         * and dedicated options group
         *
         * @param {string} selectId
         * @param {string} optGroupLabel
         */
        function disableSomeOptions(selectId, optGroupLabel) {
            // $("select#"+selectId).find("optgroup[label='" + optGroupLabel + "']").find("option").each(function() {
            //     $(this).prop("disabled", true)
            // });
            $("select#"+selectId).find("optgroup[label='" + optGroupLabel + "']").css("display", "none");
        }

        /**
         * Disable filter option group in another
         * select box
         */
        function disableOptions() {
            var enabledInFilter1 = $("#filter_1").find("option:selected").closest("optgroup").prop("label");
            var enabledInFilter2 = $("#filter_2").find("option:selected").closest("optgroup").prop("label");
            resetSelects("filter_1");
            resetSelects("filter_2");
            disableSomeOptions("filter_1", enabledInFilter2);
            disableSomeOptions("filter_2", enabledInFilter1);
        }

        $(document).on('change', 'select', function () {
            var countSelected = 0;
            $('.modal-content select').each(function () {
                if ($(this).val() !== "0") {
                    countSelected += 1;
                }
            });
            if ($('select#categories_name').val() !== "0" && countSelected === 1) {
                $('input[type="submit"], .saveInputData').addClass('disableOpacity');
            } else {
                $('input[type="submit"], .saveInputData').removeClass('disableOpacity');
            }
        });

        $('input[type="submit"], .saveInputData').on('click', function (event) {
            if ($(this).hasClass('disableOpacity')) {
                event.preventDefault();
                event.stopPropagation();
                show_tooltip("<?=TEXT_SEO_FILTER_CATEGORIES_ERROR?>", 1200);
            }
        });

        $(document).on("change", "#manufacturers_name", function () {
            var manufacturersId = $(this).find("option:selected").val();
            if(manufacturersId != 0) {
                var tmpSelected = $("#filter_2").find("option:selected").val();

                resetSelects("filter_1");
                resetSelects("filter_2");

                $("#filter_2").val(0);
                $("#filter_1").val(tmpSelected);
            }
            $("#filter_2").prop("disabled", ( manufacturersId != 0  ));
        });

        $(document).on("change", "#filter_1, #filter_2", function () {

            var filter2 = $("#filter_2").find("option:selected").val();
            var filter1 = $("#filter_1").find("option:selected").val();

            disableOptions();

            if(!$("#filter_2").prop("disabled")) {
                $("#manufacturers_name").val(0)
            }
            $("#manufacturers_name").prop("disabled", ( filter1 != 0 && filter2 != 0 ));
        })

    });

</script>