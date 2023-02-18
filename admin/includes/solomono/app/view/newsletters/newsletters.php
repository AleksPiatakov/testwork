<?php require('includes/widgets/ShowMore/ShowMore.php');
//debug($data);
//debug($action);

?>
<div class="wrapper-title">
    <div class="bg-light lter ng-scope">
        <h1 class="m-n font-thin h3"><?=HEADING_TITLE;?></h1>
        <button class="btn_own" id="add" data-action="new_<?=$action?>" data-toggle="tooltip" data-placement="top" title="<?=TEXT_MODAL_ADD_ACTION?>">
            <svg width="44px" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="#18bf49" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm144 276c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92h-92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z" class=""></path></svg>
        </button>
    </div>
</div>

<table id="own_table" class="table table-hover table-bordered bg-white-only b-t b-light <?=$action;?>">
    <thead>
    <tr>
        <?php foreach ($data['allowed_fields'] as $key=>$value): ?>
            <?php if ($value['show']===false)
                continue; ?>
            <th data-table="<?=$key?>"><?=trim($value['label']);?>
                <?php if (!empty($value['filter'])) : ?>
                    <input type="text" class="search">
                <?php endif; ?>
                <?php if ($value['sort']===true): ?>
                    <i class="fa fa-sort fa-1x" aria-hidden="true"></i>
                <?php endif; ?>
            </th>
        <?php endforeach; ?>
        <th align="center" style="width: 130px;text-align: center;">
            <p class="btn_own"  data-toggle="tooltip" data-placement="bottom" title="<?php echo TEXT_MODAL_ACTION?>">
                <i class="fa fa-exclamation-circle"></i>
            </p>
        </th>
    </tr>
    </thead>
    <tbody></tbody>
</table>

<div class="row row_pagin_admin">
    <div class="pagin_admin">
        <label><?=TEXT_SHOW?>
            <select name="per_page" id="per_page" style="width: 75px; display: inline-block;" class="form-control input-sm">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <?=TEXT_RECORDS?>
            <span id="count_prod"></span>
        </label>
    </div>

    <?php echo (new ShowMore) -> init($action, 'newsletters.php'); ?>

    <div id="own_pagination"></div>
</div>

<!--  button for action -->
<div style="display: none" id="action" align="center">
    <button class="btn_own edit_row" data-action="edit_<?=$action?>" data-toggle="tooltip" data-placement="top" title="<?=TEXT_MODAL_UPDATE_ACTION?>">
        <i class="fa fa-pencil-square-o"></i>
    </button>
    <button data-toggle="tooltip" data-action="delete_<?=$action?>" data-placement="top" title="<?=TEXT_MODAL_DELETE_ACTION?>" class="btn_own del_link">
        <i class="fa fa-trash-o"></i>
    </button>
    <button data-toggle="tooltip" data-placement="top" data-action="preview"  title="<?=BUTTON_PREVIEW_NEW?>" class="btn_own edit_row">
        <i class="fa fa-search-plus"></i>
    </button>
    <button data-toggle="tooltip" data-placement="top" data-action="send" title="<?=BUTTON_SEND_NEW?>" class="btn_own edit_row">
        <i class="fa fa-envelope-o"></i>
    </button>
</div>
<!-- end button for action -->

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

            $("body").on('click', 'button[data-action="preview"]', function () {
                getForm.call(this);
            });
        });
    });
</script>