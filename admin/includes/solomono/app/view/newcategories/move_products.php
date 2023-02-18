<form class="form-horizontal"
      action="<?= ($_SERVER['SCRIPT_URL'] ?: $_SERVER['SCRIPT_NAME']) . '?action=move_products' ?>" method="post">
    <input type="hidden" name="id" value="<?= $_POST['id'] ?>">
    <input type="hidden" name="current_category" value="<?= $data['current_category']; ?>">
    <h3><?= TEXT_INFO_COPY_TO_INTRO; ?></h3>
    <div class="col-md-12">
        <div class="form-group">
            <label for="33" class="col-sm-12 control-label"><?= addDoubleDot(HEADING_CATEGORY) ?></label>
            <?php if (!empty($data['category'])): ?>
                <div class="col-sm-12">
                    <select class="form-control" name="categories_id">
                        <?= $data['category']; ?>
                    </select>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-12">
        <p><?= TEXT_HOW_TO_COPY; ?></p>
        <div class="radio">
            <label>
                <input type="radio" name="copy_as" id="link" value="link" checked>
                <?= TEXT_COPY_AS_LINK; ?>
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="copy_as" id="duplicate" value="duplicate">
                <?= TEXT_COPY_AS_DUPLICATE; ?>
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="copy_as" id="move" value="move">
                <?= TEXT_COPY_AS_MOVE; ?>
            </label>
        </div>
    </div>
    <div class="form-group text-right">
        <div class="col-sm-12">
            <input type="submit" value="OK" class="btn">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?= TEXT_MODAL_CANCEL_ACTION ?></button>
        </div>
    </div>
</form>
