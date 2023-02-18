<table class="table table-striped <?php echo $action; ?>">
    <thead>
    <tr>
        <th><?php echo WORD_ENTRY_ORIGINAL ?></th>
        <th><?php echo WORD_ENTRY_REPLACEMENT ?></th>
        <th style="width: 7%"></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data['swap'] as $k => $arr) { ?>
        <tr data-id="<?php echo $arr['sws_id'] ?>">
            <?php foreach ($arr as $field => $v) { ?>
                <?php if ($field != 'sws_id') { ?>
                    <td class="input_wrapper" style="width: 100px">
                        <input type="text" value="<?php echo $v; ?>" class="disabled" name="<?php echo $field ?>"><i class="fa fa-pencil-square-o"></i>
                    </td>
                <?php } ?>
            <?php } ?>
            <td><i class="fa fa-trash-o"></i></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
