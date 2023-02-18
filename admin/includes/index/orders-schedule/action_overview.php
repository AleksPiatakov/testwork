<div class="action_overview col-md-6 col-xs-12">
    <div>
        <div class="new_index_title">
            <?php if (!isMobile()) { ?>
                <?php echo TEXT_ACTION_OVERVIEW; ?>
                <span class="hidden-xs"><?php // echo TEXT_SEE_ALL; ?></span>
            <?php } else {?>
                <button class="dropdown-toggle" id="action_overview_dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php print TEXT_BLOCK_OVERVIEW_LATEST_ORDERS; ?></button>
                <ul id="overview-tabs" class="new_index_dropdown dropdown-menu" aria-labelledby="action_overview_dropdown">
                    <li class="active">
                        <a href="#latest-orders" data-toggle="pill" data-role="<?php echo TEXT_BLOCK_OVERVIEW_LATEST_ORDERS; ?>"><?php echo TEXT_BLOCK_OVERVIEW_LATEST_ORDERS; ?></a>
                    </li>
                    <li>
                        <a href="#most-viewed" data-toggle="pill" data-role="<?php echo TEXT_BLOCK_OVERVIEW_MOST_VIEWED; ?>"><?php echo TEXT_BLOCK_OVERVIEW_MOST_VIEWED; ?></a>
                    </li>
                    <li>
                        <a href="#most-sold" data-toggle="pill" data-role="<?php echo TEXT_BLOCK_OVERVIEW_MOST_SOLD; ?>"><?php echo TEXT_BLOCK_OVERVIEW_MOST_SOLD; ?></a>
                    </li>
                    <li>
                        <a href="#top-categories" data-toggle="pill" data-role="<?php echo TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES; ?>"><?php echo TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES; ?></a>
                    </li>
                    <li>
                        <a href="#most-searches" data-toggle="pill" data-role="<?php echo TEXT_BLOCK_OVERVIEW_MOST_SEARCHED; ?>"><?php echo TEXT_BLOCK_OVERVIEW_MOST_SEARCHED; ?></a>
                    </li>
                </ul>
                <?php
                    $states=json_decode(ADMIN_BLOCK_STATE);
                    $states = (isset($_SESSION['login_id'])&&isset($states->{$_SESSION['login_id']}))?$states->{$_SESSION['login_id']}:$states;
                if ($states->{"#action_overview_wrapper"} == "hide") {?>
                        <a class="collapse_link collapsed" data-toggle="collapse" href="#action_overview_wrapper" aria-expanded="false" aria-controls="action_overview_wrapper"><?php echo TEXT_MOBILE_OPEN_COLLAPSE; ?></a>
                    <?php } else { ?>
                        <a class="collapse_link" data-toggle="collapse" href="#action_overview_wrapper" aria-expanded="false" aria-controls="action_overview_wrapper"><?php echo TEXT_MOBILE_CLOSE_COLLAPSE; ?></a>
            <?php } }?>
        </div>
        <?php if ($states->{"#action_overview_wrapper"} == "hide") {?>
            <div class="collapse" id="action_overview_wrapper" aria-expanded="false" style="height: 0">
        <?php } else {?> <div class="collapse in" id="action_overview_wrapper"> <?php }?>
            <?php if (!isMobile()) { ?>
                <ul id="overview-tabs" class="nav nav-pills">
                    <li class="active">
                        <a href="#latest-orders" data-toggle="pill"><?php echo TEXT_BLOCK_OVERVIEW_LATEST_ORDERS; ?></a>
                    </li>
                    <li>
                        <a href="#most-viewed" data-toggle="pill"><?php echo TEXT_BLOCK_OVERVIEW_MOST_VIEWED; ?></a>
                    </li>
                    <li>
                        <a href="#most-sold" data-toggle="pill"><?php echo TEXT_BLOCK_OVERVIEW_MOST_SOLD; ?></a>
                    </li>
                    <li>
                        <a href="#top-categories" data-toggle="pill"><?php echo TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES; ?></a>
                    </li>
                    <?php if (defined('STATS_KEYWORDS_ENABLED') && STATS_KEYWORDS_ENABLED == 'true'):?>
                        <li>
                            <a href="#most-searches" data-toggle="pill"><?php echo TEXT_BLOCK_OVERVIEW_MOST_SEARCHED; ?></a>
                        </li>
                    <?php
                        elseif (!file_exists(DIR_FS_EXT . 'stats_keywords')):
                            echo printMenuItemNotExist(TEXT_BLOCK_OVERVIEW_MOST_SEARCHED, LINK_TO_SHOP, TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY);
                        else:
                            echo printMenuItemNotExist(TEXT_BLOCK_OVERVIEW_MOST_SEARCHED, tep_href_link(FILENAME_CONFIGURATION, 'gID=277'), TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON);
                        endif;
                    ?>
                </ul>
            <?php } ?>
            <div id="action_overview_content" class="tab-content">

                <?php 
                
                // Latest Orders Tabs
                // require('includes/index2/orders-schedule/LatestOrders.php'); 

                // Latest Orders Tabs
                // require('includes/index2/orders-schedule/MostViewed.php'); 

                // Latest Most Sold
                // require('includes/index2/orders-schedule/MostSold.php'); 

                // Latest Top categories
                // require('includes/index2/orders-schedule/TopCategories.php'); 
                
                // Latest Most Searches
                // require('includes/index2/orders-schedule/MostSearches.php'); 
                ?> 
                
                <span class="show_all_content"><span class="show_all_content_button"><?php echo TEXT_MOBILE_SHOW_MORE;?><i class="fa fa-long-arrow-down" aria-hidden="true"></i></span></span>
            </div>
        </div>
    </div>
</div>