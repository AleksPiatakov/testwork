<?php foreach ($data['data'] as $k => $arr): ?>
    <tr data-xsell-product-id="<?php echo $arr['id']?>" data-xsell-id="<?php echo $arr['xsell_id']?>">
        <?php foreach ($arr as $field => $v): ?>
            <?php if ($field == 'products_name'): ?>
                <td>
                    <a target="_blank"  href="/product_info.php?products_id=<?php echo  $arr['xsell_id']; ?>"><?php echo  $v; ?></a>
                </td>
            <?php elseif($field == 'cross_prod'): ?>
                <td>
                    <input class="cmn-toggle cmn-toggle-round" <?php echo ($v) ?'checked':'';?> type="checkbox" value="True" name="<?php echo $field?>" id="cmn-toggle-<?php echo $arr['xsell_id']?>">
                    <label for="cmn-toggle-<?php echo $arr['xsell_id']?>"></label>
                </td>
            <?php elseif($field == 'discount' || $field == 'sort_order'): ?>
                <td class="input_wrapper" style="width: 100px">
                    <input type="text" value="<?php echo  $v; ?>" class="disabled" name="<?php echo  $field; ?>"><i class="fa fa-pencil-square-o"></i>
                </td>
            <?php elseif($field != 'products_name' && $field != 'cross_prod' && $field != 'discount' && $field != 'sort_order' && $field != 'id'): ?>
                <td><?php echo  $v; ?></td>
            <?php endif; ?>
        <?php endforeach; ?>

        <td><i class="fa fa-trash-o"></i></td>
    </tr>
<?php endforeach; ?>