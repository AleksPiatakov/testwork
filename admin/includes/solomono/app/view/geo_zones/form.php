<?php
//debug($data);
//debug($action);

?>

<?php $action_form = (!empty($data['data'])) ? "update_$action" : "insert_$action"; ?>

<form class="form-horizontal <?php echo $action?>" action="<?php echo ($_SERVER['SCRIPT_URL']?:$_SERVER['SCRIPT_NAME']) . '?action=' . $action_form;?>" method="post" enctype="multipart/form-data">
    <?php if (!empty($data['data'])): ?>
        <input type="hidden" name="id" value="<?php echo $data['data']['id']?>">
    <?php endif; ?>
    <div class="col-md-12">
        <?php foreach ($data['allowed_fields'] as $field_name => $option): ?>
            <?php if (!isset($option['type']) || $option['hideInForm'] === true) continue; ?>
            <?php $val = (!empty($data['data'][$field_name])) ? $data['data'][$field_name] : ''; ?>
            <?php require ('renderInput.php')?>
        <?php endforeach; ?>
    </div>
    <div class="form-group text-right">
        <div class="col-sm-12">
            <input type="submit" value="OK" class="btn">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo TEXT_MODAL_CANCEL_ACTION?></button>
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
        $('.form-horizontal').on('change', '#zone_country_id', function () {
            var countryId = $(this).val();
            $.post(window.location.pathname, {
                zone_country_id: countryId,
                action: "get_zones"
            }, function (response) {
                if (response.success == true) {
                    $('#zone_id').html(response.html);
                }
            }, "json");
        })
    });
</script>
