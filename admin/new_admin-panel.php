<?php
require('includes/application_top.php');

include_once('html-open.php');
include_once('header.php');
include(DIR_WS_CLASSES . 'currencies.php');
$currencies = new currencies();
?>


</div>
<style>
    :root {--sm-currency-left: <?=$currencies->currencies[DEFAULT_CURRENCY]['symbol_left']?>;--sm-currency-right: <?=$currencies->currencies[DEFAULT_CURRENCY]['symbol_right']?>;}
</style>
<div class="catalog_wrapper">
    <div class="sidebar_menu">
        <div class="header-cat_menu">
            <a class="all_cat" href="#">Начало</a>
        </div>
        <ul class="cat_menu">
        <li>
            <div class="transp"></div>
            <span class="down collapsed" data-toggle="collapse" href="#ul_1" aria-expanded="false">
                <i class="fa fa-caret-right" aria-hidden="true"></i>
                <span class="img_block img_close"><img src="images/new_images_admin-panel/icons/folder-icon.svg"></span>
                <span class="img_block img_open"><img src="images/new_images_admin-panel/icons/opened-folder-icon.svg"></span>
            </span>
            <a href="#">Electronics</a>
            <span class="actions_block">
                <span class="img_block img_add"><img src="images/new_images_admin-panel/icons/add-icon.svg"></span>
                <span class="img_block img_menu"><img src="images/new_images_admin-panel/Menu Icon.svg"></span>
            </span>
            <span class="img_block img_hidden"><img src="images/new_images_admin-panel/icons/invisible-icon.svg"></span>

<!--actions_menu подтягивать сюда -->
<!--    --><?php // require (DIR_WS_ASSETS.'actions_menu.php') ?>
<!--END actions_menu подтягивать сюда -->

            <ul class="collapse" id="ul_1">
                <li>
                    <a href="#">
                        <span class="img_block img_close"><img src="images/new_images_admin-panel/icons/folder-icon.svg"></span>
                        Smartphones
                    </a>
                    <span class="actions_block">
                        <span class="img_block img_add"><img src="images/new_images_admin-panel/icons/add-icon.svg"></span>
                        <span class="img_block img_menu"><img src="images/new_images_admin-panel/Menu Icon.svg"></span>
                    </span>
                    <span class="img_block img_hidden"><img src="images/new_images_admin-panel/icons/invisible-icon.svg"></span>
                </li>
                <li>
                    <span class="down collapsed" data-toggle="collapse" href="#ul_2" aria-expanded="false">
                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                        <span class="img_block img_close"><img src="images/new_images_admin-panel/icons/folder-icon.svg"></span>
                        <span class="img_block img_open"><img src="images/new_images_admin-panel/icons/opened-folder-icon.svg"></span>
                    </span>
                    <a href="#">Laptops</a>
                    <span class="actions_block">
                        <span class="img_block img_add"><img src="images/new_images_admin-panel/icons/add-icon.svg"></span>
                        <span class="img_block img_menu"><img src="images/new_images_admin-panel/Menu Icon.svg"></span>
                    </span>
                    <span class="img_block img_hidden"><img src="images/new_images_admin-panel/icons/invisible-icon.svg"></span>
                    <ul class="collapse" id="ul_2">
                        <li>
                            <a href="#">
                                <span class="img_block img_close"><img src="images/new_images_admin-panel/icons/folder-icon.svg"></span>
                                Apple
                            </a>
                            <span class="actions_block">
                                <span class="img_block img_add"><img src="images/new_images_admin-panel/icons/add-icon.svg"></span>
                                <span class="img_block img_menu"><img src="images/new_images_admin-panel/Menu Icon.svg"></span>
                            </span>
                            <span class="img_block img_hidden"><img src="images/new_images_admin-panel/icons/invisible-icon.svg"></span>
                        </li>
                        <li>
                            <a href="#">
                                <span class="img_block img_close"><img src="images/new_images_admin-panel/icons/folder-icon.svg"></span>
                                Lenovo
                            </a>
                            <span class="actions_block">
                                <span class="img_block img_add"><img src="images/new_images_admin-panel/icons/add-icon.svg"></span>
                                <span class="img_block img_menu"><img src="images/new_images_admin-panel/Menu Icon.svg"></span>
                            </span>
                            <span class="img_block img_hidden"><img src="images/new_images_admin-panel/icons/invisible-icon.svg"></span>
                        </li>
                        <li>
                            <a href="#">
                                <span class="img_block img_close"><img src="images/new_images_admin-panel/icons/folder-icon.svg"></span>
                                Xiaomi
                            </a>
                            <span class="actions_block">
                                <span class="img_block img_add"><img src="images/new_images_admin-panel/icons/add-icon.svg"></span>
                                <span class="img_block img_menu"><img src="images/new_images_admin-panel/Menu Icon.svg"></span>
                            </span>
                            <span class="img_block img_hidden"><img src="images/new_images_admin-panel/icons/invisible-icon.svg"></span>
                        </li>
                    </ul>
                </li>
                <li>
                    <span class="down collapsed" data-toggle="collapse" href="#ul_3" aria-expanded="false">
                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                        <span class="img_block img_close"><img src="images/new_images_admin-panel/icons/folder-icon.svg"></span>
                        <span class="img_block img_open"><img src="images/new_images_admin-panel/icons/opened-folder-icon.svg"></span>
                    </span>
                    <a href="#">Smart Watches</a>
                    <span class="actions_block">
                        <span class="img_block img_add"><img src="images/new_images_admin-panel/icons/add-icon.svg"></span>
                        <span class="img_block img_menu"><img src="images/new_images_admin-panel/Menu Icon.svg"></span>
                    </span>
                    <span class="img_block img_hidden"><img src="images/new_images_admin-panel/icons/invisible-icon.svg"></span>
                    <ul class="collapse" id="ul_3">
                        <li>
                            <a href="#">
                                <span class="img_block img_close"><img src="images/new_images_admin-panel/icons/folder-icon.svg"></span>
                                sdfsdfga
                            </a>
                            <span class="actions_block">
                                <span class="img_block img_add"><img src="images/new_images_admin-panel/icons/add-icon.svg"></span>
                                <span class="img_block img_menu"><img src="images/new_images_admin-panel/Menu Icon.svg"></span>
                            </span>
                            <span class="img_block img_hidden"><img src="images/new_images_admin-panel/icons/invisible-icon.svg"></span>
                        </li>
                    </ul>
                </li>
                <li>
                    <span class="down collapsed" data-toggle="collapse" href="#ul_4" aria-expanded="false">
                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                        <span class="img_block img_close"><img src="images/new_images_admin-panel/icons/folder-icon.svg"></span>
                        <span class="img_block img_open"><img src="images/new_images_admin-panel/icons/opened-folder-icon.svg"></span>
                    </span>
                    <a href="#">Computer Accessories</a>
                    <span class="actions_block">
                        <span class="img_block img_add"><img src="images/new_images_admin-panel/icons/add-icon.svg"></span>
                        <span class="img_block img_menu"><img src="images/new_images_admin-panel/Menu Icon.svg"></span>
                    </span>
                    <span class="img_block img_hidden"><img src="images/new_images_admin-panel/icons/invisible-icon.svg"></span>
                </li>
                <li>
                    <span class="down collapsed" data-toggle="collapse" href="#ul_11" aria-expanded="false">
                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                        <span class="img_block img_close"><img src="images/new_images_admin-panel/icons/folder-icon.svg"></span>
                        <span class="img_block img_open"><img src="images/new_images_admin-panel/icons/opened-folder-icon.svg"></span>
                    </span>
                    <a href="#">Graphic Card</a>
                    <span class="actions_block">
                        <span class="img_block img_add"><img src="images/new_images_admin-panel/icons/add-icon.svg"></span>
                        <span class="img_block img_menu"><img src="images/new_images_admin-panel/Menu Icon.svg"></span>
                    </span>
                    <span class="img_block img_hidden"><img src="images/new_images_admin-panel/icons/invisible-icon.svg"></span>
                </li>
                <li>
                    <a href="#">
                        <span class="img_block img_close"><img src="images/new_images_admin-panel/icons/folder-icon.svg"></span>
                        Processor
                    </a>
                    <span class="actions_block">
                        <span class="img_block img_add"><img src="images/new_images_admin-panel/icons/add-icon.svg"></span>
                        <span class="img_block img_menu"><img src="images/new_images_admin-panel/Menu Icon.svg"></span>
                    </span>
                    <span class="img_block img_hidden"><img src="images/new_images_admin-panel/icons/invisible-icon.svg"></span>
                </li>
                <li>
                    <span class="down collapsed" data-toggle="collapse" href="#ul_5" aria-expanded="false">
                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                        <span class="img_block img_close"><img src="images/new_images_admin-panel/icons/folder-icon.svg"></span>
                        <span class="img_block img_open"><img src="images/new_images_admin-panel/icons/opened-folder-icon.svg"></span>
                    </span>
                    <a href="#">Smart Watches</a>
                    <span class="actions_block">
                        <span class="img_block img_add"><img src="images/new_images_admin-panel/icons/add-icon.svg"></span>
                        <span class="img_block img_menu"><img src="images/new_images_admin-panel/Menu Icon.svg"></span>
                    </span>
                    <span class="img_block img_hidden"><img src="images/new_images_admin-panel/icons/invisible-icon.svg"></span>
                </li>
            </ul>
        </li>
        <li>
            <span class="down collapsed" data-toggle="collapse" href="#ul_6" aria-expanded="false">
                <i class="fa fa-caret-right" aria-hidden="true"></i>
                <span class="img_block img_close"><img src="images/new_images_admin-panel/icons/folder-icon.svg"></span>
                <span class="img_block img_open"><img src="images/new_images_admin-panel/icons/opened-folder-icon.svg"></span>
            </span>
            <a href="#">Luggage</a>
            <span class="actions_block">
                <span class="img_block img_add"><img src="images/new_images_admin-panel/icons/add-icon.svg"></span>
                <span class="img_block img_menu"><img src="images/new_images_admin-panel/Menu Icon.svg"></span>
            </span>
            <span class="img_block img_hidden"><img src="images/new_images_admin-panel/icons/invisible-icon.svg"></span>
            <ul class="collapse" id="ul_6">
                <li>
                    <a href="#">
                        <span class="img_block img_close"><img src="images/new_images_admin-panel/icons/folder-icon.svg"></span>
                        Carry-ons
                    </a>
                   <span class="actions_block">
                        <span class="img_block img_add"><img src="images/new_images_admin-panel/icons/add-icon.svg"></span>
                        <span class="img_block img_menu"><img src="images/new_images_admin-panel/Menu Icon.svg"></span>
                    </span>
                    <span class="img_block img_hidden"><img src="images/new_images_admin-panel/icons/invisible-icon.svg"></span>
                </li>
                <li>
                    <span class="down collapsed" data-toggle="collapse" href="#ul_7" aria-expanded="false">
                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                        <span class="img_block img_close"><img src="images/new_images_admin-panel/icons/folder-icon.svg"></span>
                        <span class="img_block img_open"><img src="images/new_images_admin-panel/icons/opened-folder-icon.svg"></span>
                    </span>
                    <a href="#">Backpacks</a>
                    <span class="actions_block">
                        <span class="img_block img_add"><img src="images/new_images_admin-panel/icons/add-icon.svg"></span>
                        <span class="img_block img_menu"><img src="images/new_images_admin-panel/Menu Icon.svg"></span>
                    </span>
                    <span class="img_block img_hidden"><img src="images/new_images_admin-panel/icons/invisible-icon.svg"></span>
                </li>
                <li>
                    <span class="down collapsed" data-toggle="collapse" href="#ul_8" aria-expanded="false">
                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                        <span class="img_block img_close"><img src="images/new_images_admin-panel/icons/folder-icon.svg"></span>
                        <span class="img_block img_open"><img src="images/new_images_admin-panel/icons/opened-folder-icon.svg"></span>
                    </span>
                    <a href="#">Garment bags</a>
                    <span class="actions_block">
                        <span class="img_block img_add"><img src="images/new_images_admin-panel/icons/add-icon.svg"></span>
                        <span class="img_block img_menu"><img src="images/new_images_admin-panel/Menu Icon.svg"></span>
                    </span>
                    <span class="img_block img_hidden"><img src="images/new_images_admin-panel/icons/invisible-icon.svg"></span>
                </li>
                <li>
                    <span class="down collapsed" data-toggle="collapse" href="#ul_9" aria-expanded="false">
                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                        <span class="img_block img_close"><img src="images/new_images_admin-panel/icons/folder-icon.svg"></span>
                        <span class="img_block img_open"><img src="images/new_images_admin-panel/icons/opened-folder-icon.svg"></span>
                    </span>
                    <a href="#">Travel Totes</a>
                    <span class="actions_block">
                        <span class="img_block img_add"><img  src="images/new_images_admin-panel/icons/add-icon.svg"></span>
                        <span class="img_block img_menu"><img src="images/new_images_admin-panel/Menu Icon.svg"></span>
                    </span>
                    <span class="img_block img_hidden"><img src="images/new_images_admin-panel/icons/invisible-icon.svg"></span>
                </li>
                <li>
                    <a href="#">
                        <span class="img_block img_close"><img src="images/new_images_admin-panel/icons/folder-icon.svg"></span>
                        Luggage Sets
                    </a>
                    <span class="actions_block">
                        <span class="img_block img_add"><img src="images/new_images_admin-panel/icons/add-icon.svg"></span>
                        <span class="img_block img_menu"><img src="images/new_images_admin-panel/Menu Icon.svg"></span>
                    </span>
                    <span class="img_block img_hidden"><img src="images/new_images_admin-panel/icons/invisible-icon.svg"></span>
                </li>
                <li>
                    <span class="down collapsed" data-toggle="collapse" href="#ul_10" aria-expanded="false">
                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                        <span class="img_block img_close"><img src="images/new_images_admin-panel/icons/folder-icon.svg"></span>
                        <span class="img_block img_open"><img src="images/new_images_admin-panel/icons/opened-folder-icon.svg"></span>
                    </span>
                    <a href="#">Laptop Bags</a>
                    <span class="actions_block">
                        <span class="img_block img_add"><img src="images/new_images_admin-panel/icons/add-icon.svg"></span>
                        <span class="img_block img_menu"><img src="images/new_images_admin-panel/Menu Icon.svg"></span>
                    </span>
                    <span class="img_block img_hidden"><img src="images/new_images_admin-panel/icons/invisible-icon.svg"></span>
                </li>
            </ul>
        </li>
    </ul>
    </div>
    <div class="product_list_block">
<!--    <div class="product_list_block move_left-product_list">-->

        <div class="header_actions_block">
            <span class="change_checkboxes" >
                <input type="checkbox" id="check_checkbox">
            </span>
            <span class="img_block img_add"><img src="images/new_images_admin-panel/icons/add-icon.svg"></span>
            <span class="img_block img_remove"><img src="images/new_images_admin-panel/icons/trash-icon.svg"></span>
            <span class="img_block img_copy"><img src="images/new_images_admin-panel/icons/copy-icon.svg"></span>
            <span class="img_block img_move"><img src="images/new_images_admin-panel/icons/move-icon.svg"></span>

             <span class="btn-move_left">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </span>
        </div>


<!--форма поиска по выбранной категории-->
        <form action="">
            <div class="search_cat_form">
                <input type="text" placeholder="Search in ВЫБРАННАЯ КАТЕГОРИЯ">
                <button type="submit"><img class="img_search" src="images/new_images_admin-panel/Search Icon.svg"></button>
            </div>
        </form>
<!--END форма поиска по выбранной категории-->

<!-- список товаров product_list при выборе категории  -->
<!--  CODE  -->
        <?php  require (DIR_WS_ASSETS.'product_list.php') ?>
<!--END список товаров product_list при выборе категории  -->
    </div>

<!--settings_block-->
    <?php  require (DIR_WS_ASSETS.'settings_block.php') ?>
<!--END settings_block-->











<?php include_once('footer.php');?>
<?php
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>