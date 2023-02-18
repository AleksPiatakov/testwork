<?php
//debug($data);
//debug($action);

?>

<div style="padding: 15px;">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered <?php echo $action;?>">
                <thead>
                <tr>
                    <?php foreach ($data['allowed_fields'] as $k=>$v): ?>
                        <th data-table="<?php echo $k?>"><?php echo trim($v['label']);?></th>
                    <?php endforeach; ?>
                </tr>
                </thead>
                <tbody>
                <?php for ($i=0; $i < count($data['data']); $i++): ?>
                    <tr>
                        <?php foreach ($data['allowed_fields'] as $k=>$v): ?>
                            <?php if (isset($data['data'][$i][$k])): ?>
                                <?php if ($k=='orders_status_id'): ?>
                                    <td>
                                        <?php echo $data['orders_status'][$data['data'][$i][$k]]['orders_status_name'];?>
                                    </td>
                                <?php elseif ($k=='customer_notified'): ?>
                                    <td class="text-center">
                                        <i class="fa fa-lg fa-<?php echo $data['data'][$i][$k]==1 ? 'check' : 'times'?>" aria-hidden="true"></i>
                                    </td>
                                <?php else: ?>
                                    <td><?php echo $data['data'][$i][$k];?></td>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tr>
                <?php endfor; ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <form class="form-horizontal col-md-12" action="<?php echo ($_SERVER['SCRIPT_URL']?:$_SERVER['SCRIPT_NAME']) . '?action=update_' . $action;?>" method="post">
                <input type="hidden" name="orders_id" value="<?php echo $data['data'][0]['orders_id']?>">
                <div class="form-group">
                    <label for="comments"><?php echo TABLE_HEADING_COMMENTS;?></label>
                    <textarea name="comments" id="comments" class="form-control" rows="5"><?=$data['orders_status'][$data['current_status_id']]['orders_status_text']?></textarea>
                </div>
                <div class="form-group">
                    <label for=""><?php echo TABLE_HEADING_STATUS;?></label>
                    <select id="orders_status" name="orders_status_id" class="form-control">
                        <?php foreach ($data['orders_status'] as $id=>$v): ?>
                            <option data-color="<?php echo $v['orders_status_color']?>" <?php echo $data['current_status']==$v['orders_status_name'] ? 'selected' : ''?>
                                    value="<?php echo $id?>">
                                <?php echo $v['orders_status_name']?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="checkbox-inline">
                        <input type="checkbox" id="customer_notified" name="customer_notified"><?php echo ENTRY_NOTIFY_CUSTOMER;?>
                    </label>
                </div>
                <div class="form-group text-right">
                    <input type="submit" value="OK" class="btn">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo TEXT_MODAL_CANCEL_ACTION?></button>
                </div>
            </form>
        </div>
    </div>
</div>
