<?php
//debug($data);
//debug($action);
chdir('/')
?>

<?php $action_form = 'answer_reviews' ?>

<form class="form-horizontal <?php echo $action?>" action="<?php echo ($_SERVER['SCRIPT_URL']?:$_SERVER['SCRIPT_NAME']) . '?action=' . $action_form;?>" id = "answer-comment-form" method="post" enctype="multipart/form-data">
    <?php if (!empty($data['data'])): ?>
        <input type="hidden" name="languages_id" value="<?php echo $data['data']['languages_id']?>">
        <input type="hidden" name="parent_id" value="<?php echo $data['data']['id']?>">
        <input type="hidden" name="products_id" value="<?php echo $data['data']['products_id']?>">
    <?php endif; ?>
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-sm-4">
                <label for="reviews_text"><?=$data['allowed_fields']['reviews_text']['label']?></label>
            </div>
            <div class="col-sm-8">
                <textarea class="form-control" id="reviews_text" rows="6" name="reviews_text"></textarea>
            </div>
        </div>
    </div>
    <div class="form-group text-right">
        <div class="col-sm-12">
            <input type="submit" value="OK" class="btn">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo TEXT_MODAL_CANCEL_ACTION?></button>
        </div>
    </div>
</form>