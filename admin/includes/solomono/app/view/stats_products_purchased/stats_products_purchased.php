<?php require('includes/widgets/ShowMore/ShowMore.php');
//debug($data);
//debug($action);
include DIR_WS_TABS . "products_statistic.php";
?>
<div class="wrapper-title">
    <div class="bg-light lter ng-scope">
        <h1 class="m-n font-thin h3"><?php echo HEADING_TITLE;?></h1>
    </div>
</div>
<?php
echo tep_draw_form('date_range','stats_products_purchased.php' , '', 'get', 'class="stats_products_purchased_data_range"');
echo '<div class="form-div">' . ENTRY_STARTDATE . tep_draw_input_field('start_date', $start_date);
//    echo ' <td> ';
echo ENTRY_TODATE . tep_draw_input_field('end_date', $end_date). '&nbsp;' . '</div>';
echo '<input type="submit" class="stats_products_input" value="'. ENTRY_SUBMIT .'">';
echo '</form>';
?>
<table id="own_table" class="table table-hover table-bordered bg-white-only b-t b-light <?php echo $action;?>">
    <thead>
    <tr>
        <?php foreach ($data['allowed_fields'] as $key=>$value): ?>
            <?php if ($value['show']===false)
                continue; ?>
            <th <?php echo  $value['thWidth']?'style="width:'.$value['thWidth'].'px"':''?> data-table="<?php echo $key?>"><?php echo trim($value['label']);?>
                <?php if (!empty($value['filter'])) : ?>
                    <input type="text" class="search">
                <?php endif; ?>
                <?php if ($value['sort']===true): ?>
                    <i class="fa fa-sort fa-1x" aria-hidden="true"></i>
                <?php endif; ?>
            </th>
        <?php endforeach; ?>
    </tr>
    </thead>
    <tbody id="most_purchased"></tbody>
</table>

<div class="row row_pagin_admin">
    <div class="pagin_admin">
        <label><?php echo TEXT_SHOW?>
            <select name="per_page" id="per_page" style="width: 75px; display: inline-block;" class="form-control input-sm">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <?php echo TEXT_RECORDS?>
            <span id="count_prod"></span>
        </label>
    </div>
    <?php echo (new ShowMore)->init($action,'stats_products_purchased.php');?>
    <div id="own_pagination"></div>
</div>

<!--  button for action -->