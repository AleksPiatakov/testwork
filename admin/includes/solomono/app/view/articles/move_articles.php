<form class="form-horizontal" action="<?php echo ($_SERVER['SCRIPT_URL']?:$_SERVER['SCRIPT_NAME']) . '?action=move_articles'?>" method="post">
    <input type="hidden" name="id" value="<?php echo $_POST['id']?>">
    <input type="hidden" name="current_topic" value="<?php echo $data['current_category'];?>">
    <h3><?php echo TEXT_INFO_COPY_TO_INTRO;?></h3>
    <div class="col-md-12">
        <div class="form-group">
            <label for="33" class="col-sm-12 control-label"><?php echo addDoubleDot(HEADING_CATEGORY)?></label>
            <?php if (!empty($data['category'])): ?>
                <div class="col-sm-12">
                    <select class="form-control" name="topics_id">
                        <?php echo $data['category'];?>
                    </select>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-12">
        <p><?php echo TEXT_HOW_TO_COPY;?></p>
        <div class="radio">
            <label>
                <input type="radio" name="copy_as" id="link" value="link" checked>
                <?php echo TEXT_COPY_AS_LINK;?>
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="copy_as" id="duplicate" value="duplicate">
                <?php echo TEXT_COPY_AS_DUPLICATE;?>
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="copy_as" id="move" value="move">
                <?php echo TEXT_COPY_AS_MOVE;?>
            </label>
        </div>
    </div>
    <div class="form-group text-right">
        <div class="col-sm-12">
            <input type="submit" value="OK" class="btn">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo TEXT_MODAL_CANCEL_ACTION?></button>
        </div>
    </div>
</form>
