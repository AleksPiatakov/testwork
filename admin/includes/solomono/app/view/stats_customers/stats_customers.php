<?php require('includes/widgets/ShowMore/ShowMore.php');
//debug($data);
//debug($action);
include DIR_WS_TABS . "clients_statistic.php";
?>
<div class="wrapper-title">
    <div class="bg-light lter ng-scope">
        <h1 class="m-n font-thin h3"><?php echo HEADING_TITLE;?></h1>
    </div>
</div>
<table class="stats_customers_table" style="background: #fff; width: 100%;">
<td class="main wrapper-md">
<div class="bg-light lter b-b wrapper-md ng-scope wrapper_stats_customers">
    <?php


    echo tep_draw_form('date_range', 'stats_customers.php', '', 'get');
    echo '<span>' . ENTRY_STARTDATE . tep_draw_input_field('start_date', $_GET['start_date'],'class="date-picker"') .'</span>';
    echo '<span>' . ENTRY_TODATE . tep_draw_input_field('end_date', $_GET['end_date'],'class="date-picker"').'</span>';
    echo '<input type="submit" value="'. ENTRY_SUBMIT .'" class="form-control btn btn-info w-auto h-half-xxs">';
    echo '</form>';

    ?>
</div>
</td>
</table>
<table id="own_table" class="table table-hover table-bordered bg-white-only b-t b-light <?php echo $action;?>">
    <thead>
    <tr>
        <?php foreach ($data['allowed_fields'] as $key=>$value): ?>
            <?php if ($value['show']===false)
                continue; ?>
            <th <?php echo  $value['thWidth']?'style="width:'.$value['thWidth'].'px"':''?> data-table="<?php echo $key?>"><?php echo trim($value['label']);?>
                <?php if (!empty($value['filter'])) : ?>
                    <input type="text" class="search">
                <?php endif; ?>
                <?php if ($value['sort']===true): ?>
                    <i class="fa fa-sort fa-1x" aria-hidden="true"></i>
                <?php endif; ?>
            </th>
        <?php endforeach; ?>
    </tr>
    </thead>
    <tbody id="stats_customers"></tbody>
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

    <?php echo (new ShowMore) -> init($action, 'stats_customers.php'); ?>

    <div id="own_pagination"></div>
</div>

<!--  button for action -->

<!-- end button for action -->
<script>
    $(document).ready(function () {
        $('body').on('focus', '.date-picker', function () {
            $(this).datepicker({
                dateFormat: "yy-mm-dd"
            });
        });
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
    });
</script>