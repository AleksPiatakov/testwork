<div class="new_chart col-md-6 col-xs-12">
    <div class="panel">
        <div class="new_index_title with_dropdown">
            <?php if(!isMobile()){?>
                <?php echo TEXT_BLOCK_PLOT_TITLE; ?>
                <span><?php //echo TEXT_SEE_ALL;?></span>
            <?php } else {?>
                <?php echo TEXT_MOBILE_INCOME; ?>
                <button class="dropdown-toggle" id="chart_dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo TEXT_BLOCK_PLOT_TAB_BY_MONTHES; ?></button>
                <ul class="new_index_dropdown dropdown-menu" aria-labelledby="chart_dropdown">
                    <li class="active">
                        <a class="chart-link" href data-period="month" data-role="<?php echo TEXT_BLOCK_PLOT_TAB_BY_MONTHES; ?>"><?php echo TEXT_BLOCK_PLOT_TAB_BY_MONTHES; ?></a>
                    </li>
                    <li>
                        <a class="chart-link" href data-period="week" data-role="<?php echo TEXT_BLOCK_PLOT_TAB_BY_WEEKS; ?>"><?php echo TEXT_BLOCK_PLOT_TAB_BY_WEEKS; ?></a>
                    </li>
                    <li>
                        <a class="chart-link" href data-period="day" data-role="<?php echo TEXT_BLOCK_PLOT_TAB_BY_DAYS; ?>"><?php echo TEXT_BLOCK_PLOT_TAB_BY_DAYS; ?></a>
                    </li>
                </ul>
                <?php
                    $states=json_decode(ADMIN_BLOCK_STATE);
                    $states = (isset($_SESSION['login_id'])&&isset($states->{$_SESSION['login_id']}))?$states->{$_SESSION['login_id']}:$states;
                if ($states->{"#new_chart_content"} == "hide") {?>
                        <a class="collapse_link collapsed" data-toggle="collapse" href="#new_chart_content" aria-expanded="false"><?php echo TEXT_MOBILE_OPEN_COLLAPSE; ?></a>
                    <?php } else { ?>
                        <a class="collapse_link" data-toggle="collapse" href="#new_chart_content" aria-expanded="false"><?php echo TEXT_MOBILE_CLOSE_COLLAPSE; ?></a>
            <?php } }?>
        </div>
        <?php if($states->{"#new_chart_content"} == "hide") {?>
            <div class="panel-body item collapse" id="new_chart_content" aria-expanded="false" style="height: 0">
        <?php } else {?> <div class="panel-body item collapse in" id="new_chart_content"> <?php }?>
            <?php if(!isMobile()){?>
            <ul class="nav nav-pills">
                <li class="active">
                    <a class="chart-link" href data-period="month"><?php echo TEXT_BLOCK_PLOT_TAB_BY_MONTHES; ?></a>
                </li>
                <li>
                    <a class="chart-link" href data-period="week" data-role="<?php echo TEXT_BLOCK_PLOT_TAB_BY_WEEKS; ?>"><?php echo TEXT_BLOCK_PLOT_TAB_BY_WEEKS; ?></a>
                </li>
                <li>
                    <a class="chart-link" href data-period="day"><?php echo TEXT_BLOCK_PLOT_TAB_BY_DAYS; ?></a>
                </li>
            </ul>
            <?php } ?>
            <span class="item">
                <div class="index-page-charts chart-el"></div>
            </span>
            <!-- <div id="chart" style="min-height:300px"></div>
                <div class="bg-white w-full h-full top text-info h2 spinner">
                <i class="fa fa-spinner fa-spin pos-abt t-n b-n l-n r-n m-auto w-half-xxs h-half-xxs"></i>
            </div> -->
        </div>
    </div>
</div>