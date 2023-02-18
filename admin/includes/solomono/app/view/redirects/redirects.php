
<?php $action_form = (!empty($data['data'])) ? "update_$action" : "insert_$action"; ?>

<form class="form-horizontal <?php echo $action?>" action="<?php echo ($_SERVER['SCRIPT_URL']?:$_SERVER['SCRIPT_NAME']) . '?action=' . $action_form;?>" method="post" enctype="multipart/form-data">
    <?php if (!empty($data['data'])): ?>
        <input type="hidden" name="id" value="<?php echo $data['data']['id']?>">
    <?php endif; ?>
    <div class="col-md-12">
        <?php
            foreach ($data['allowed_fields'] as $field_name => $option)
            {
                if (!isset($option['type']) || $option['hideInForm'] === true) continue;
                if($option['type'] == "select") $val = isset($option['option']['id']) && isset($data['data'][$option['option']['id']]) ?$data['data'][$option['option']['id']]:$data['data'][$field_name];
                else $val = (!empty($data['data'][$field_name])) ? $data['data'][$field_name] : '';
                ?>
                <div class="form-group" style="display: flex;flex-direction: column;align-items: center;">
                    <?php if($option['type']=='text'):?>
                        <div class="col-sm-4" style="text-align: center">
                            <label style="font-size: 15px; font-weight: bold;" for="<?php echo $field_name;?>"><?php echo $option['label'];?>:</label>
                        </div>
                        <div class="col-sm-6" style="display: flex;">
                            <div class="col-sm-2" style="height: fit-content; margin: auto 0;">
                            <span><?=$_SERVER['SERVER_NAME']?>/</span>
                        </div>
                            <div class="col-sm-8">
                            <input <?php echo $option['params'] ? : '';?> type="<?php echo $option['type']?>" value="<?php echo $val?>" name="<?php echo $field_name?>" class="form-control <?php echo $option['class']?>" id="<?php echo $field_name?>" <?= (isset($option['autofocus']) && $option['autofocus'] ? ' autofocus' : '') ?> <?= (isset($option['placeholder']) && $option['placeholder'] ? 'placeholder="'.$option['placeholder'].'"' : '') ?>>
                        </div>
                        </div>
                    <?php elseif ($option['type'] == 'multiradio'): ?>
                        <div class="col-sm-4" style="text-align: center">
                            <label style="font-size: 15px; font-weight: bold;" for="<?php echo $field_name;?>"><?php echo $option['label'];?>:</label>
                        </div>
                    <div class="redirect_radio" style="display: flex; flex-direction: column">
                        <?php foreach ($option['radio'] as $value => $name){ ?>
                            <label>
                                <input type="radio" <?php echo ((empty($val) && $val=$value) || $val == $value) ? 'checked' : '';?> name="<?php echo $field_name?>" value="<?php echo $value ?>">
                            <?php echo $name ?>
                            </label>
                        <?php } ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php
            }
        ?>
    </div>
    <script>
        var action_redirect = 1;
        var redirect_to_elem = $('[name="redirect_to"]').closest('.form-group');
        if($('.redirect_radio input[type="radio"]:checked').val()!=action_redirect){
            redirect_to_elem.hide("fast");
        }
        $('.redirect_radio input[type="radio"]').on('click', function(){
            if($(this).val() == action_redirect){
                redirect_to_elem.show("fast");
            }else{
                redirect_to_elem.hide("fast");
            }
        });
    </script>
    <div class="form-group text-right">
        <div class="col-sm-12">
            <input type="submit" value="OK" class="btn">
            <button type="button" class="btn btn-info saveInputData"><?php echo TEXT_MODAL_APPLY_ACTION?></button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo TEXT_MODAL_CANCEL_ACTION?></button>
        </div>
    </div>
</form>
<script>
    setTimeout(function(){
        var $input = $('.form-group input[type="text"]:first');
        var input = $input[0];
        $input.focus();
        input.selectionStart = input.value.length;
    }, 500);
</script>