<?php require('includes/widgets/ShowMore/ShowMore.php');
//debug($data);
//debug($action);

?>
<div class="wrapper-title">
    <div class="bg-light lter ng-scope">
        <h1 class="m-n font-thin h3"><?php echo HEADING_TITLE;?></h1>
    </div>
</div>
<div class="row">
    <div id="filters" class="col-md-12" style="margin-bottom: 20px">
        <button data-action="without_xsell" type="button" id="without_xsell" name="xsell" class="btn btn-success" value="false"><?php echo IMAGE_WITHOUT_XSELLS?></button>
        <button data-action="xsell" type="button" id="xsell" name="xsell" class="btn btn-success" value="true"><?php echo IMAGE_WITH_XSELLS?></button>
    </div>
</div>
<table id="own_table" class="table table-hover table-bordered bg-white-only b-t b-light <?php echo $action;?>">
    <thead>
    <tr>
        <?php foreach ($data['allowed_fields'] as $key=>$value): ?>
            <?php if ($value['show']===false)
                continue; ?>
            <th data-table="<?php echo $key?>"><?php echo trim($value['label']);?>
                <?php if (!empty($value['filter'])) : ?>
                    <input type="text" class="search">
                <?php endif; ?>
                <?php if ($value['sort']===true): ?>
                    <i class="fa fa-sort fa-1x" aria-hidden="true"></i>
                <?php endif; ?>
            </th>
        <?php endforeach; ?>
        <th align="center" style="width: 110px;text-align: center;">

        </th>
    </tr>
    </thead>
    <tbody class="table_mobil_own"></tbody>
</table>

<div class="row row_pagin_admin">
    <div class="pagin_admin">
        <label><?php echo TEXT_SHOW?>
            <select name="per_page" id="per_page" style="width: 75px; display: inline-block;" class="form-control input-sm">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <?php echo TEXT_RECORDS?>
            <span id="count_prod"></span>
        </label>
    </div>

    <?php echo (new ShowMore) -> init($action, 'xsell_products.php'); ?>

    <div id="own_pagination">
    </div>
</div>

<!--  button for action -->
<div style="display: none" id="action" align="center">
    <button class="btn_own edit_row" data-action="edit_<?php echo $action?>" data-toggle="tooltip" data-placement="top" title="<?php echo TEXT_MODAL_UPDATE_ACTION?>">
        <i class="fa fa-pencil-square-o"></i>
    </button>
</div>
<!-- end button for action -->
<script src="<?php echo DIR_WS_INCLUDES?>ckeditor/ckeditor.js"></script>
<script src="<?php echo DIR_WS_INCLUDES;?>ckfinder/ckfinder.js"></script>
<script>
    $(document).ready(function () {
        $(function () {
            CKEDITOR.disableAutoInline = true;

            $("body").on('click', '.ck_replacer', function () {
                $(this).empty().css('display', 'none');
                $('.modal').removeAttr('tabindex');
                var textarea = $(this).parent().find('textarea');
                var editor = CKEDITOR.replace(textarea.attr('name'), {
                    extraPlugins: 'colorbutton,codemirror',
                    startupFocus: true,
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
                                        el.attributes.style = '' ;
                                    }
                                }
                            });
                        }
                    }
                });

                editor.on('change', function (evt) {
                    textarea.text(evt.editor.getData());
                });
                CKFinder.setupCKEditor(editor, '../../../../../includes/ckfinder/');
            });

        });

        $('#filters button').on('click', function (e) {
            e.preventDefault();
            var name = $(this).attr('name');
            var val = $(this).val();
            option[name] = val;
            console.log(name + ' : ' + val);
            delete(option.count);
            //delete(option.total);
            //delete(option.page);
            $('#own_pagination').pagination('selectPage', 1);
        });
    });
</script>