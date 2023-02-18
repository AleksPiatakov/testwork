<?php
$checkModuleExist = [
    'P_COMPARE' => 'COMPARE_MODULE_ENABLED',
    'P_WISHLIST' => 'WISHLIST_MODULE_ENABLED'
];
//debug($data);
//debug($action);
//exit;
/// test1
?>
<?php global $login_id; ?>
<?php $action_form = (!empty($data['data'])) ? "update_$action" : "insert_$action"; ?>
<?php $cnt = ceil(12 / count($data['data'])); ?>
<form class="form-horizontal <?php echo  $action ?>" action="<?php echo  ($_SERVER['SCRIPT_URL']?:$_SERVER['SCRIPT_NAME']) . '?action=' . $action_form; ?>" method="post"
      enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo  $data['id'] ?>">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <ul class="nav nav-tabs col-md-3 padder template_conf_list">
                    <?php $first=true; foreach ($data['data'] as $const => $arr): ?>
                        <li<?=$first?' class="active" ':''?> style="float:none"><a data-toggle="tab" href="#tab-<?=$const?>"><?php echo  constant($const . '_MODULES'); ?></a></li>
                    <?php $first = false; endforeach; ?>
                    <?php if ($login_id == '1'): ?>
                        <li style="float:none"><a data-toggle="tab" href="#tab-addModule"><?= ADD_MODULE_MODULES ?></a></li>

                    <?php endif; ?>
                </ul>
                <div class="tab-content content col-md-9 padder">
                    <?php $first = true; if(array_key_exists('MAINCONF',$data['data'])) $first = false; ?>
                    <?php foreach ($data['data'] as $const => $arr): ?>
                        <?php if ($const == 'MAINCONF'): ?>

                            <div id="tab-<?=$const?>" data-name="<?=$const?>" class="tab-pane fade <?=($const == 'MAINCONF')?'active in' :''?>">
                                <h4><?php echo constant($const . '_MODULES'); ?></h4>
                                <?php foreach ($arr as $value) : ?>                    
                                    <div class="form-group padder">
                                      <?php $infobox_data = unserialize($value['infobox_data']); ?>

                                      <?php if($infobox_data['type'] == 'checkbox'){ ?>
                                          <span ><?=defined($value['infobox_define'])?constant($value['infobox_define']):$value['infobox_define'];?>
                                            <span title="<?= getConstantValue($value['infobox_define'].'_INFO')?>">
                                                <span class="glyphicon glyphicon-info-sign"></span>
                                            </span>
                                          </span>
                                      <?php } else { ?>
                                        <?php if ($value['infobox_define'] == 'MC_PRODUCT_QNT_IN_ROW'):?>
                                            <label for="MC_PRODUCT_QNT_IN_ROW0" class="label-for-select">
                                        <?php else: ?>
                                            <label for="<?=$value['infobox_define']?>">
                                        <?php endif; ?>
                                          
                                            <?=defined($value['infobox_define'])?constant($value['infobox_define']):$value['infobox_define'];?>
                                            <span title="<?= getConstantValue($value['infobox_define'].'_INFO')?>">
                                                <span class="glyphicon glyphicon-info-sign"></span>
                                            </span>
                                          </label>
                                      <?php } ?>
                                      <?php if ($infobox_data['type'] == 'select'): ?>
                                          <select class="form-control" id="<?=$value['infobox_define']?>" data-callback="<?php echo  $value['callback_data']; ?>">
                                            <?php foreach ($infobox_data['data'] as $k=>$v) : ?>
                                                <option value="<?=$k?>"<?=$infobox_data['val']==$k?' selected':''?>><?=defined($v)?constant($v):$v?></option>
                                            <?php endforeach; ?>
                                          </select>
                                        <?php elseif($infobox_data['type'] == 'checkbox'): ?>
                                            <input type="<?=$infobox_data['type']?>" class="cmn-toggle cmn-toggle-round" data-callback="<?php echo  $value['callback_data']; ?>" id="<?=$value['infobox_define']?>" value="<?=$infobox_data['val']?>"<?= $infobox_data['val']?' checked':''?>>
                                            <label for="<?=$value['infobox_define']?>"></label>
                                        <?php elseif($infobox_data['type'] == 'color'): ?>
                                            <input type="<?=$infobox_data['type']?>" class="color form-control" id="<?=$value['infobox_define']?>" value="<?=$infobox_data['val']?>">

                                        <?php elseif($value['infobox_define'] == 'MAX_DISPLAY_SEARCH_RESULTS_TITLE'): ?>
                                            <input type="hidden" class="form-control" id="<?=$value['infobox_define']?>" value="<?=$infobox_data['val']?>">
                                            <div class="form-group__items" id="MAX_DISPLAY_SEARCH_RESULTS_TITLE_ITEMS">
                                                <?php
                                                $arr = explode(';',$infobox_data['val']);
                                                $i = 0;
                                                $elem = 1;

                                                    foreach ($arr as $elem)
                                                    {
                                                        
                                                        if(count($arr) < 2){
                                                            if(!empty($elem)){
                                                                echo '<div class="form-group__items-item"><input type="number" class="form-control input-sec" step="1" min="1" value="'.$elem.'"></div>';
                                                            }else{
                                                                 echo '<div class="form-group__items-item"><input type="number" class="form-control input-sec" step="1" min="1" value="1"></div>';
                                                            }
                                                        }else{ 
                                                            echo '<div class="form-group__items-item"><input type="number" class="form-control input-sec" step="1" min="1" value="'.$elem.'"><span class="glyphicon glyphicon-remove form-group__items-item-remove" title="'. getConstantValue($value['infobox_define'].'_INFO_DEL').'"></span></div>';
                                                        };
                                                        $i++;
                                                    };
                                                    
                                                    if($i < 5){
                                                        echo '<span class="form-group__items-add"><span id="fgiAdd" class="glyphicon glyphicon-plus" title="'. getConstantValue($value['infobox_define'].'_INFO_ADD').'" data-del-title="'. getConstantValue($value['infobox_define'].'_INFO_DEL').'"></span></span>';
                                                    }else{
                                                        echo '<span class="form-group__items-add hidden"><span id="fgiAdd" class="glyphicon glyphicon-plus" title="'. getConstantValue($value['infobox_define'].'_INFO_ADD').'" data-del-title="'. getConstantValue($value['infobox_define'].'_INFO_DEL').'"></span></span>';
                                                    };
                                                ?>
                                            </div>

                                        <?php elseif($value['infobox_define'] == 'MC_PRODUCT_QNT_IN_ROW'): ?>
                                            <input type="hidden" class="form-control" id="<?=$value['infobox_define']?>" value="<?=$infobox_data['val']?>">
                                            <div class="form-group__items" id="MC_PRODUCT_QNT_IN_ROW_ITEMS">
                                                <div class="form-group__items-item">
                                                    <select data-val="<?=$infobox_data['val'][0]?>" data-separate=";" class="form-control input-sec" id="MC_PRODUCT_QNT_IN_ROW0">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                    <span class="glyphicon glyphicon-info-sign" title="<?= getConstantValue($value['infobox_define'].'_INFO_0')?>"></span>
                                                </div>
                                                <div class="form-group__items-item">
                                                    <select data-val="<?=$infobox_data['val'][2]?>" data-separate=";" class="form-control input-sec">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                    </select>
                                                    <span class="glyphicon glyphicon-info-sign" title="<?= getConstantValue($value['infobox_define'].'_INFO_1')?>"></span>
                                                </div>
                                                <div class="form-group__items-item">
                                                    <select data-val="<?=$infobox_data['val'][4]?>" data-separate=";" class="form-control input-sec">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                    </select>
                                                    <span class="glyphicon glyphicon-info-sign" title="<?= getConstantValue($value['infobox_define'].'_INFO_2')?>"></span>
                                                </div>
                                                <div class="form-group__items-item">
                                                    <select data-val="<?=$infobox_data['val'][6]?>" data-separate=";" class="form-control input-sec">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                    <span class="glyphicon glyphicon-info-sign" title="<?= getConstantValue($value['infobox_define'].'_INFO_3')?>"></span>
                                                </div>
                                                <div class="form-group__items-item">
                                                    <select data-val="<?=$infobox_data['val'][8]?>" data-separate="" class="form-control input-sec">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                    </select>
                                                    <span class="glyphicon glyphicon-info-sign" title="<?= getConstantValue($value['infobox_define'].'_INFO_4')?>"></span>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <input type="<?=$infobox_data['type']?>" class="form-control" id="<?=$value['infobox_define']?>" value="<?=$infobox_data['val']?>">
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                    <?php else: ?>
                    <div id="tab-<?=$const?>" class="tab-pane fade<?=$first?' active in' :''?>">
                        <?php $first = false; ?>
                        <h4><?php echo  constant($const . '_MODULES'); ?></h4>
                        <ul id="<?php echo  $const ?>" class="list-group <?php echo  ($const == 'LEFT' || $const == 'MAINPAGE') ? 'sortable' : ''; ?> <?php echo  $action; ?>">
                            <?php foreach ($arr as $k => $v): ?>
                                <?php

                                // START CHECK IF MODULE ENABLED
                                if (array_key_exists ($v["infobox_define"], $checkModuleExist)) {
                                    if (getConstantValue($checkModuleExist[$v["infobox_define"]]) == 'false') {
                                        continue;
                                    }
                                } // END CHECK IF MODULE ENABLED?>

                                <li class="list-group-item animated" data-location="<?php echo  $v['location']; ?>"
                                    data-id="<?php echo  $v['id']; ?>" data-callback="<?php echo  $v['callback_data']; ?>">
                                    <?php echo constant($v['infobox_define']); ?>
                                    <?php
                                        $class = $tooltip = '';
                                        if($v['infobox_define'] == 'F_WEB_STUDIO_LINK'){
                                            if(!defined('SITE_TYPE') || !defined('RENT_PACKAGE')){
                                                require_once ("includes/check_rented_modules.php");
                                            }

                                            if(getConstantValue('SITE_TYPE') == "RENTED"){
                                               if(getConstantValue('RENT_PACKAGE') == "free"){
                                                  $class = 'rented_free';
                                                  $tooltip = 'data-toggle="tooltip" data-placement="left" title="" data-original-title="'. TEXT_UNAVAILABLE_IN_FREE_PACKAGE. '"';
                                               }
                                            }
                                        }
                                        ?>
                                        <div class="status <?php echo $class ?>" <?php echo $tooltip; ?>>
                                            <input class="cmn-toggle cmn-toggle-round" type="checkbox"
                                                   id="cmn-toggle-<?php echo  $v['id']; ?>" <?php echo  ($v['infobox_display'] == 1) ? 'checked' : '' ?>>
                                            <label for="cmn-toggle-<?php echo  $v['id']; ?>"></label>
                                        </div>
                                    <?php // if (isset($v['infobox_data'])): ?>
                                        <?php require "template_config.php"; ?>
                                    <?php // endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                    </div>
                    <?php $first = false; endif; endforeach;?>
                    <div id="tab-addModule" class="tab-pane fade">
                        <h4><?= ADD_MODULE_MODULES; ?></h4>
                        <ul id="addModule" class="list-group">
                            <div class="form-group padder">
                                <label for="infobox_file_name">infobox_file_name</label>
                                <input type="text" class="form-control" id="infobox_file_name" name="infobox_file_name">
                            </div>
                            <div class="form-group padder">
                                <label for="infobox_define">infobox_define</label>
                                <input type="text" class="form-control" id="infobox_define" name="infobox_define">
                            </div>
                            <div class="form-group padder">
                                <label for="display_in_column">display_in_column</label>
                                <select class="form-control" id="display_in_column" name="display_in_column">
                                    <?php foreach ($this->getObject()->getDisplayInColumn() as $option): ?>
                                        <option value="<?=$option?>"><?=$option?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <p>infobox_data example:</p>
                            <pre>
                                    <?php var_export(['id'=>['val'=>5,'label'=>'name','callable'=>'method']]) ?>
                             </pre>
                            <div class="form-group padder">
                                <label for="infobox_data">infobox_data</label>
                                <textarea rows="5" class="form-control" id="infobox_data" name="infobox_data"></textarea>
                            </div>
                        </ul>
                        <button class="addModuleButton btn btn-default" type="button">Add module</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="form-group text-right">
        <div class="col-sm-12">
            <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
        </div>
    </div>
</form>
<script>

    $("form.template .changeable input,form.template .changeable select").on('change', function () {

        var block = $(this).parents('.val');
        var val = $(this).val()
        if ($(this).attr('type') == 'checkbox'){
            val = $(this).prop('checked') ? 1 : 0;
        }
        var name = {
            module: block.data('module'),
            const: block.data('const'),
            field: block.data('field'),
            val: val
        };
        $.ajax({
            url: window.location.pathname,
            type: 'POST',
            dataType: 'json',
            data: {action: 'changeable', name: name, template_id: $('form.template [name="id"]').val()},
            beforeSend: function () {
                show_tooltip('<span style="font-size: 5em;" class="ajax-loader"></span>', 55555);
            },
            success: function (response) {
                console.log(response);
                $('.tooltip_own').remove();
                if (response.success == true) {
                    show_tooltip(response.msg, 500);
                } else {
                    show_tooltip(response.msg, 99999, $('body'), true);
                }
            }
        });
    });

    $('.status>input.cmn-toggle').on('change', function () {
        var status = $(this).prop('checked');
        var callbackData = $(this).parents('li').data('callback');
        if (status == true) {
            status = 1;
        } else {
            status = 0;
        }
        var data = {
            action: 'infobox_display',
            id: $(this).parents('li').data('id'),
            callback: callbackData,
            status: status
        };
        $.ajax({
            url: window.location.pathname,
            type: "POST",
            data: data,
            dataType: 'json',
            success: function (response) {
                show_tooltip(response.msg, 500);
                if(typeof callbackData != 'undefined'){
                    setAndShowCriticalWindow(1);
                }
            }
        });
    });

    $(".sortable").sortable({
        update: function (event, ui) {
            var ul = event.target;
            var form = $(ul).closest('form');
            var li = $(ul).find('li');
            var data = {};
            $(li).each(function (i, e) {
                $(e).data('location', i + 1);
                data[$(e).data('id')] = $(e).data('location');
            });
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                dataType: 'json',
                data: data,
                success: function (response) {
                    if (response.success == false) {
                        $('#modal_form').modal('hide');
                        show_tooltip(response['msg']);
                    }
                }
            });
        }
    });
    $('body').on('click', 'input.form-control.color', function (e) {
        var $this = $(this);

        e.preventDefault();
        $this.ColorPicker({
            onBeforeShow: function () {
                $(this).ColorPickerSetColor(this.value);
            },
            onShow: function (colpkr) {
                $(colpkr).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                $(colpkr).fadeOut(500);
                var formData = {
                    action: 'changeable',
                    template_id: $('form.template [name="id"]').val(),
                    name: {
                        module: 'MAINCONF',
                        const: $this.attr('id'),
                        val: $this.val(),
                    }
                }

                $.ajax({
                    url: window.location.pathname,
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    beforeSend: function () {
                        show_tooltip('<span style="font-size: 5em;" class="ajax-loader"></span>', 55555);
                    },
                    success: function (response) {
                        $('.tooltip_own').remove();
                        if (response.success == true) {
                            show_tooltip(response.msg, 500);
                        } else {
                            show_tooltip(response.msg, 99999, $('body'), true);
                        }
                    }
                });
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                $this.val('#' + hex);
            }
        });
        $this.click();
    });
    //MC_PRODUCT_QNT_IN_ROW
    var self;
    var NewQNTinRow = '';
    $('#MC_PRODUCT_QNT_IN_ROW_ITEMS .input-sec option').each(function(){
        self = $(this); 
        if(self.val() == self.closest('.input-sec').attr('data-val')){
            self.prop('selected', true);
        }
    });
    $('#MC_PRODUCT_QNT_IN_ROW_ITEMS .input-sec').on('change', function(){
        NewQNTinRow = '';
        $('#MC_PRODUCT_QNT_IN_ROW_ITEMS .input-sec').each(function(){
            NewQNTinRow += $(this).val()+$(this).attr('data-separate')
        });
        $('#MC_PRODUCT_QNT_IN_ROW').val(NewQNTinRow).change()
    });

    // MAX_DISPLAY_SEARCH_RESULTS_TITLE
    var NewSRT,itemsCount;
    function newSRTfunc(){
        NewSRT = '';
        $('#MAX_DISPLAY_SEARCH_RESULTS_TITLE_ITEMS .input-sec').each(function(){
            NewSRT += $(this).val()+';'
        });            
        $('#MAX_DISPLAY_SEARCH_RESULTS_TITLE').val(NewSRT.slice(0, -1)).change()
    };
    function mdsrtiF(){
        $('#MAX_DISPLAY_SEARCH_RESULTS_TITLE_ITEMS .input-sec').on('change', function(){
            
            self = $(this); 
            var pa = self.parent();

            if((parseInt(self.val()) < 1 || self.val() == '') && $('#MAX_DISPLAY_SEARCH_RESULTS_TITLE_ITEMS .input-sec').length > 1){
                pa.remove();
                $('#fgiAdd').parent().removeClass('hidden');
            };
            if($('#MAX_DISPLAY_SEARCH_RESULTS_TITLE_ITEMS .input-sec').length < 2){
                $('#MAX_DISPLAY_SEARCH_RESULTS_TITLE_ITEMS').addClass('no-remove');
                if((parseInt(self.val()) < 1 || self.val() == '')){
                    self.val(1)
                }
            }else{
                $('#MAX_DISPLAY_SEARCH_RESULTS_TITLE_ITEMS').removeClass('no-remove')
            };

            newSRTfunc();
        });
    };
    function mdsrtiRemoveF(){
        $('#MAX_DISPLAY_SEARCH_RESULTS_TITLE_ITEMS .form-group__items-item-remove').on('click', function(){
            mdsrtiF();
            $(this).prev('.input-sec').val('').trigger('change')
        });
    };

    mdsrtiF();
    $('#fgiAdd').on('click', function(){
        var self = $(this); 
        var pa = self.parent();
        itemsCount = $('#MAX_DISPLAY_SEARCH_RESULTS_TITLE_ITEMS .form-group__items-item').length;
        var addVal;
        var delTitle = self.attr('data-del-title');

        if(itemsCount < 1){
            addVal = 20
        }else{
            addVal = Math.ceil(parseInt($('#MAX_DISPLAY_SEARCH_RESULTS_TITLE_ITEMS').find('.form-group__items-item').last().find('.form-control').val())*1.5/10)*10;
        };

        $('#MAX_DISPLAY_SEARCH_RESULTS_TITLE_ITEMS').removeClass('no-remove');

        if($('#MAX_DISPLAY_SEARCH_RESULTS_TITLE_ITEMS').find('.form-group__items-item').first().find('.form-group__items-item-remove').length < 1){
            $('#MAX_DISPLAY_SEARCH_RESULTS_TITLE_ITEMS').find('.form-group__items-item').first().append('<span class="glyphicon glyphicon-remove form-group__items-item-remove" title="'+delTitle+'"></span>');
        };

        if(itemsCount < 4){
            pa.removeClass('hidden');            
        }else{
            pa.addClass('hidden');
        };
        if(itemsCount < 5){
            $('<div class="form-group__items-item"><input type="number" class="form-control input-sec" step="1" min="1" value="'+addVal+'"><span class="glyphicon glyphicon-remove form-group__items-item-remove" title="'+delTitle+'"></span></div>').insertBefore(pa);
        };

        newSRTfunc();
        mdsrtiF();
        mdsrtiRemoveF();
    });
    mdsrtiRemoveF();
    $('[for="MAX_DISPLAY_SEARCH_RESULTS_TITLE"]').on('click', function(){
        $('#MAX_DISPLAY_SEARCH_RESULTS_TITLE_ITEMS').find('.form-group__items-item').first().find('.input-sec').focus()
    });
   

    $('body').on('change','.tab-pane[data-name] input:not(".input-sec"),.tab-pane[data-name] select',function(){
        var val = $(this).attr('type') == 'checkbox' ? ($(this).prop('checked')?1:0) : $(this).val();
        var callbackData = $(this).data('callback');
        var formData = {
            action: 'changeable',
            template_id: $('form.template [name="id"]').val(),
            callback: callbackData,
            name: {
                module: $(this).parents('.tab-pane[data-name]').data('name'),
                const: $(this).attr('id'),
                val: val,
            }
        }
        $.ajax({
            url: window.location.pathname,
            type: 'POST',
            dataType: 'json',
            data: formData,
            beforeSend: function () {
                show_tooltip('<span style="font-size: 5em;" class="ajax-loader"></span>', 55555);
            },
            success: function (response) {
                $('.tooltip_own').remove();
                if (response.success == true) {
                    show_tooltip(response.msg, 500);
                    if(typeof callbackData != 'undefined'){
                        setAndShowCriticalWindow(1);
                    }
                } else {
                    show_tooltip(response.msg, 99999, $('body'), true);
                }
            }
        });
    });

    <?php if ($login_id == "1"): ?>
    $('.changeable_admin .save_admin_block').on('click',function(){
        var $this = $(this).parent().find('textarea');
        var formData = {
            action: 'changeable_admin',
            template_id: $('form.template [name="id"]').val(),
            module: $(this).parents('ul').attr('id'),
            const: $this.attr('name'),
            val: $this.val(),
        }
        $.ajax({
            url: window.location.pathname,
            type: 'POST',
            dataType: 'json',
            data: formData,
            beforeSend: function () {
                show_tooltip('<span style="font-size: 5em;" class="ajax-loader"></span>', 55555);
            },
            success: function (response) {
                $('.tooltip_own').remove();
                if (response.success == true) {
                    show_tooltip(response.msg, 500);
                } else {
                    show_tooltip(response.msg, 99999, $('body'), true);
                }
            }
        })
    })
    $('.addModuleButton').on('click',function(){
        var formData = {'action':'addModule','template_id':$('form.template [name="id"]').val()};
        console.log(window.location.pathname);
        $('#addModule input,#addModule select,#addModule textarea').each(function(){
            if ($(this).val() == '') {
                return;
            } else {
                formData[$(this).attr('name')] = $(this).val();
            }
        });
    $.ajax({
        url: window.location.pathname,
        type: 'POST',
        dataType: 'json',
        data: formData,
        beforeSend: function () {
            show_tooltip('<span style="font-size: 5em;" class="ajax-loader"></span>', 55555);
        },
        success: function (response) {
            $('.tooltip_own').remove();
            if (response.success == true) {
                show_tooltip(response.msg, 500);
                $('#addModule input,#addModule select,#addModule textarea').each(function(){
                    $(this).val('');
                });
            } else {
                show_tooltip(response.msg, 99999, $('body'), true);
            }
        }
    });
    })

    <?php endif;?>
    /*setTimeout(()=>
    console.clear(),1000);*/

    $(document).ready(function (){
        //$('.status.rented_free label').preventDefault();
        $('.status.rented_free label').css('pointer-events', 'none');
        $('.status.rented_free label').on('mouseover', function (){
            console.log('dg')
        })
        $('[data-toggle="tooltip"]').tooltip();
    })
</script>