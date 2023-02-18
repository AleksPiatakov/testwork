<?php $conf = isset($template->settings['HEADER']['H_TOP_MENU']['infobox_data'])
    ? unserialize($template->settings['HEADER']['H_TOP_MENU']['infobox_data'])['toggle_mobile_visible']['val']
    : false; ?>
<div class="bottom_header">
    <nav class="navbar navbar-expand-md container py-0">
        <!--        <div class="container">-->
        <div class="navbar-header" hidden>
            <div class="col-xs-2 search-form-tooltip">
                <div id="show_search_form" class="show_search_form" data-toggle="tooltip" data-placement="auto bottom"
                     title="<?php echo BOX_OPEN_SEARCH_FORM; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M443.5 420.2L336.7 312.4c20.9-26.2 33.5-59.4 33.5-95.5 0-84.5-68.5-153-153.1-153S64 132.5 64 217s68.5 153 153.1 153c36.6 0 70.1-12.8 96.5-34.2l106.1 107.1c3.2 3.4 7.6 5.1 11.9 5.1 4.1 0 8.2-1.5 11.3-4.5 6.6-6.3 6.8-16.7.6-23.3zm-226.4-83.1c-32.1 0-62.3-12.5-85-35.2-22.7-22.7-35.2-52.9-35.2-84.9 0-32.1 12.5-62.3 35.2-84.9 22.7-22.7 52.9-35.2 85-35.2s62.3 12.5 85 35.2c22.7 22.7 35.2 52.9 35.2 84.9 0 32.1-12.5 62.3-35.2 84.9-22.7 22.7-52.9 35.2-85 35.2z"></path>
                    </svg>
                </div>
            </div>
            <!-- search mobile//-->
            <div class="col-xs-12 search-block" hidden>
                <div class="main_search_form">
                    <?php echo tep_draw_form(
                        'quick_find',
                        tep_href_link(FILENAME_DEFAULT, '', 'NONSSL', false),
                        'get',
                        'class="form_search_site"'
                    ); ?>
                    <input type="search" id="searchpr1" class="search_site_input search-form-input"
                           placeholder="<?php echo BOX_HEADING_SEARCH; ?>" name="keywords"
                           value="<?= stripslashes($_GET['keywords']); ?>">
                    <button type="submit" id="search-form-button1" class="search_site_submit">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M443.5 420.2L336.7 312.4c20.9-26.2 33.5-59.4 33.5-95.5 0-84.5-68.5-153-153.1-153S64 132.5 64 217s68.5 153 153.1 153c36.6 0 70.1-12.8 96.5-34.2l106.1 107.1c3.2 3.4 7.6 5.1 11.9 5.1 4.1 0 8.2-1.5 11.3-4.5 6.6-6.3 6.8-16.7.6-23.3zm-226.4-83.1c-32.1 0-62.3-12.5-85-35.2-22.7-22.7-35.2-52.9-35.2-84.9 0-32.1 12.5-62.3 35.2-84.9 22.7-22.7 52.9-35.2 85-35.2s62.3 12.5 85 35.2c22.7 22.7 35.2 52.9 35.2 84.9 0 32.1-12.5 62.3-35.2 84.9-22.7 22.7-52.9 35.2-85 35.2z"></path>
                        </svg>
                    </button>
                    <button type="button" id="search-form-button-close1" class="">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z"></path>
                                </svg>
                            </span>
                    </button>
                    </form>
                </div>
            </div>
            <!-- search_sm end //-->
            <div class="col-xs-6 logo_block" hidden>
                <?php require $template->requireBox('H_LOGO'); ?>
            </div>
            <div class="col-xs-4 pull-right header-actions" hidden>
                <!-- SHOPPING CART -->
                <?php require $template->requireBox('H_SHOPPING_CART'); ?>
                <?php echo $cart_output_mobile; ?>
                <!-- END SHOPPING CART -->
                <button type="button" class="btn-mobile_menu">
                    <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                            class="icon-bar"></span> <span class="icon-bar"></span>
                </button>
            </div>
        </div>
        <div class="mobile_menu">
            <?php if (($conf == false and isMobile()) or $conf == true) : ?>
                <div class="block_categories">
                    <div class="button-main-cursor dropdown-toggle" id="dropdown_menu_wrapper" data-toggle="dropdown"
                         aria-haspopup="true" aria-expanded="false">
                        <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path d="M436 124H12c-6.627 0-12-5.373-12-12V80c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12zm0 160H12c-6.627 0-12-5.373-12-12v-32c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12zm0 160H12c-6.627 0-12-5.373-12-12v-32c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12z"></path>
                        </svg>
                        <?= DEMO2_FOOTER_CATEGORIES; ?>
                    </div>
                    <div class="menu_wrapper dropdown-menu dropdown-menu-lg-left"
                         aria-labelledby="dropdown_menu_wrapper">
                        <ul class="first_list">
                            <li class="parent_li">
                                <a href="#">
                                    Смартфоны <span class="caret"></span>
                                </a>
                                <ul class="second_list">
                                    <li>
                                        <a href="#">2-х ядерные</a>
                                    </li>
                                    <li>
                                        <a href="#">4-х ядерные</a>
                                    </li>
                                    <li class="parent_li">
                                        <a href="#">
                                            Процессор i3 <span class="caret"></span>
                                        </a>
                                        <ul class="third_list">
                                            <li>
                                                <a href="#">С большим экраном</a>
                                            </li>
                                            <li>
                                                <a href="#">8-и ядерные</a>
                                            </li>
                                            <li>
                                                <a href="#">Смартбуки</a>
                                            </li>
                                            <li>
                                                <a href="#">Для видеомонтажа</a>
                                            </li>
                                            <li>
                                                <a href="#">3D-экран</a>
                                            </li>
                                            <li>
                                                <a href="#">Процессор i7</a>
                                            </li>
                                            <li>
                                                <a href="#">Хромбуки</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Intel</a>
                                    </li>
                                    <li>
                                        <a href="#">На windows</a>
                                    </li>
                                    <li>
                                        <a href="#">Недорогие</a>
                                    </li>
                                    <li>
                                        <a href="#">С подсветкой клавиатуры</a>
                                    </li>
                                    <li>
                                        <a href="#">2-х ядерные</a>
                                    </li>
                                    <li>
                                        <a href="#">4-х ядерные</a>
                                    </li>
                                    <li>
                                        <a href="#">Процессор i3</a>
                                    </li>
                                    <li>
                                        <a href="#">Intel</a>
                                    </li>
                                    <li>
                                        <a href="#">На windows</a>
                                    </li>
                                    <li>
                                        <a href="#">Недорогие</a>
                                    </li>
                                    <li>
                                        <a href="#">С подсветкой клавиатуры</a>
                                    </li>
                                    <li>
                                        <a href="#">2-х ядерные</a>
                                    </li>
                                    <li>
                                        <a href="#">4-х ядерные</a>
                                    </li>
                                    <li>
                                        <a href="#">Процессор i3</a>
                                    </li>
                                    <li class="parent_li">
                                        <a href="#">
                                            Intel <span class="caret"></span>
                                        </a>
                                        <ul class="third_list">
                                            <li>
                                                <a href="#">С большим экраном</a>
                                            </li>
                                            <li>
                                                <a href="#">8-и ядерные</a>
                                            </li>
                                            <li>
                                                <a href="#">Смартбуки</a>
                                            </li>
                                            <li>
                                                <a href="#">Для видеомонтажа</a>
                                            </li>
                                            <li>
                                                <a href="#">3D-экран</a>
                                            </li>
                                            <li>
                                                <a href="#">Процессор i7</a>
                                            </li>
                                            <li>
                                                <a href="#">Хромбуки</a>
                                            </li>
                                            <li>
                                                <a href="#">С большим экраном</a>
                                            </li>
                                            <li>
                                                <a href="#">8-и ядерные</a>
                                            </li>
                                            <li>
                                                <a href="#">Смартбуки</a>
                                            </li>
                                            <li>
                                                <a href="#">Для видеомонтажа</a>
                                            </li>
                                            <li>
                                                <a href="#">3D-экран</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">На windows</a>
                                    </li>
                                    <li>
                                        <a href="#">Недорогие</a>
                                    </li>
                                    <li>
                                        <a href="#">С подсветкой клавиатуры</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Планшеты</a>
                            </li>
                            <li class="parent_li">
                                <a href="#">
                                    Ноутбуки <span class="caret"></span>
                                </a>
                                <ul class="second_list">
                                    <li>
                                        <a href="#">Недорогие</a>
                                    </li>
                                    <li>
                                        <a href="#">С подсветкой клавиатуры</a>
                                    </li>
                                    <li>
                                        <a href="#">2-х ядерные</a>
                                    </li>
                                    <li>
                                        <a href="#">4-х ядерные</a>
                                    </li>
                                    <li>
                                        <a href="#">Процессор i3</a>
                                    </li>
                                    <li>
                                        <a href="#">Intel</a>
                                    </li>
                                    <li>
                                        <a href="#">На windows</a>
                                    </li>
                                    <li>
                                        <a href="#">Недорогие</a>
                                    </li>
                                    <li>
                                        <a href="#">С подсветкой клавиатуры</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Смарт-часы</a>
                            </li>
                            <li>
                                <a href="#">Телевизоры</a>
                            </li>
                        </ul>
                    </div>

                </div>
            <?php endif; ?>
            <div class="block_information">
                <div class="button-main-cursor" hidden>
                    <span class="button-title"><?= BOX_HEADING_INFORMATION; ?></span> <span class="down"><i
                                class="fa fa-chevron-right"></i></span>
                </div>
                <ul class="menu_information d-flex justify-content-start align-items-center">
                    <?php require $template->requireBox('H_TOP_LINKS', $config); ?>
                </ul>
            </div>
        </div>
    </nav>
</div>
<!--</div>-->
<div class="cat_fader" id="cat_fader"></div>
