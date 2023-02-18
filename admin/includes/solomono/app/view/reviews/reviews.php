<?php
require('includes/widgets/ShowMore/ShowMore.php');
//debug($data);
//debug($action);

?>
<div class="wrapper-title">
    <div class="bg-light lter ng-scope">
        <h1 class="m-n font-thin h3"><?php echo HEADING_TITLE; ?></h1>
        <button class="btn_own" id="add" data-action="new_<?php echo $action ?>" data-toggle="tooltip"
                data-placement="top" title="<?php echo TEXT_MODAL_ADD_ACTION ?>">
            <svg width="44px" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="#18bf49"
                      d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm144 276c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92h-92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z"
                      class=""></path>
            </svg>
        </button>
    </div>
</div>

<table id="own_table" class="table table-hover table-bordered bg-white-only b-t b-light <?php echo $action; ?>">
    <thead>
    <tr>
        <?php foreach ($data['allowed_fields'] as $key => $value): ?>
            <?php if ($value['show'] === false)
                continue; ?>
            <th data-table="<?php echo $key ?>"><?php echo trim($value['label']) . (!empty($value['tooltip']) ? renderTooltip($value['tooltip']) : ''); ?>
                <?php if (!empty($value['filter'])) : ?>
                    <input type="text" class="search">
                <?php endif; ?>
                <?php if ($value['sort'] === true): ?>
                    <i class="fa fa-sort fa-1x" aria-hidden="true"></i>
                <?php endif; ?>
            </th>
        <?php endforeach; ?>
        <th align="center" style="width: 130px;text-align: center;">
            <p class="btn_own" data-toggle="tooltip" data-placement="bottom" title="<?php echo TEXT_MODAL_ACTION ?>">
                <i class="fa fa-exclamation-circle"></i>
            </p>
        </th>
    </tr>
    </thead>
    <tbody></tbody>
</table>

<div class="row row_pagin_admin">
    <div class="pagin_admin">
        <label><?php echo TEXT_SHOW ?>
            <select name="per_page" id="per_page" style="width: 75px; display: inline-block;"
                    class="form-control input-sm">
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <?php echo TEXT_RECORDS ?>
            <span id="count_prod"></span>
        </label>
    </div>
    <?php echo (new ShowMore)->init($action, '/admin/' . $action . '.php'); ?>
    <div id="own_pagination"></div>
</div>

<!--  button for action -->
<div style="display: none" id="action" align="center">
    <a class="admin-answer-button"
       href='<?= tep_href_link('reviews.php', 'action=answer_reviews&id=&products_id=')  ?>'
       data-src="" title="<?php echo TEXT_BTN_REPLY ?>"><i class="fa fa-share"></i></a>

    <button class="btn_own edit_row" data-action="edit_<?php echo $action ?>" data-toggle="tooltip" data-placement="top"
            title="<?php echo TOOLTIP_CLIENT_GROUP_EDIT ?>">
        <i class="fa fa-pencil-square-o"></i>
    </button>
    <button data-toggle="tooltip" data-action="delete_<?php echo $action ?>" data-placement="top"
            title="<?php echo TEXT_MODAL_DELETE_ACTION ?>" class="btn_own del_link">
        <i class="fa fa-trash-o"></i>
    </button>
</div>

<script>
    function loadChildReview() {
        $.ajax ( {
            url: "reviews.php?action=getParents",
            dataType: "json",
            success: function ( data, textStatus, jqXHR ) {
                $.each(data, function (i,item){
                    var parent_tr = $('[data-id="'+item.parent_id+'"]');
                    var description = item.reviews_text.slice(0,20);
                    var html = '';
                    html += '<tr class="review_reply_tr">';
                    html += '<td colspan="6">';
                    html += '<a class="reviews_item_bottom" href="reviews.php?action=editreply_reviews&id='+item.id+'">'+item.customers_name+': '+description+' ... </a>';
                    html += '</td>';
                    html += '</tr>';
                    parent_tr.after(html);
                })
            }
        } );
    }
</script>
