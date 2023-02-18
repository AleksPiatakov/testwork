<?php
require('includes/application_top.php');

include_once('html-open.php');
include_once('header.php');
?>

<div class="customize_template container">
    <div class="left_col">
        <div class="white_overlay">
            <ul class="nav-tabs">
                <li>
                    <a aria-expanded="false" data-toggle="tab" href="#custom_temp-MAINCONF">Основные настройки</a>
                </li>
                <li>
                    <a aria-expanded="false" data-toggle="tab" href="#custom_temp-LEFT">Левая колонка</a>
                </li>
                <li class="active">
                    <a aria-expanded="true" data-toggle="tab" href="#custom_temp-MAINPAGE">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                            <g fill="none" fill-rule="evenodd"><g fill="#18BF49"><g><g><g><g><g>
                                <path d="M15.1 5H6.9c-.497 0-.9.403-.9.9v9.2c0 .497.403.9.9.9h8.2c.497 0 .9-.403.9-.9V5.9c0-.497-.403-.9-.9-.9zM15.1 0H6.9c-.497 0-.9.403-.9.9v1.2c0 .497.403.9.9.9h8.2c.497 0 .9-.403.9-.9V.9c0-.497-.403-.9-.9-.9z" transform="translate(-195 -252) translate(175 160) translate(0 20) translate(0 62) translate(20 10)"/>
                                <path fill-opacity=".4" d="M3.1 0H.9C.403 0 0 .403 0 .9v3.2c0 .497.403.9.9.9h2.2c.497 0 .9-.403.9-.9V.9c0-.497-.403-.9-.9-.9zM3.1 7H.9c-.497 0-.9.403-.9.9v1.2c0 .497.403.9.9.9h2.2c.497 0 .9-.403.9-.9V7.9c0-.497-.403-.9-.9-.9zM3.1 12H.9c-.497 0-.9.403-.9.9v2.2c0 .497.403.9.9.9h2.2c.497 0 .9-.403.9-.9v-2.2c0-.497-.403-.9-.9-.9z" transform="translate(-195 -252) translate(175 160) translate(0 20) translate(0 62) translate(20 10)"/>
                            </g></g></g></g></g></g></g>
                        </svg>
                        Главная страница
                    </a>
                </li>
                <li>
                    <a aria-expanded="false" data-toggle="tab" href="#custom_temp-HEADER">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                            <g fill="none" fill-rule="evenodd">
                                <g fill="#18BF49"><g><g><g><g><g>
                                    <path d="M15.1 5H6.9c-.497 0-.9.403-.9.9v4.2c0 .497.403.9.9.9h8.2c.497 0 .9-.403.9-.9V5.9c0-.497-.403-.9-.9-.9zM15.1 13H6.9c-.497 0-.9.403-.9.9v1.2c0 .497.403.9.9.9h8.2c.497 0 .9-.403.9-.9v-1.2c0-.497-.403-.9-.9-.9z" opacity=".3" transform="translate(-195 -288) translate(175 160) translate(0 20) translate(20 108)"/>
                                    <path d="M15.1 0H.9C.403 0 0 .403 0 .9v1.2c0 .497.403.9.9.9h14.2c.497 0 .9-.403.9-.9V.9c0-.497-.403-.9-.9-.9z" transform="translate(-195 -288) translate(175 160) translate(0 20) translate(20 108)"/>
                                    <path d="M3.1 5H.9c-.497 0-.9.403-.9.9v2.2c0 .497.403.9.9.9h2.2c.497 0 .9-.403.9-.9V5.9c0-.497-.403-.9-.9-.9zM3.1 11H.9c-.497 0-.9.403-.9.9v3.2c0 .497.403.9.9.9h2.2c.497 0 .9-.403.9-.9v-3.2c0-.497-.403-.9-.9-.9z" opacity=".3" transform="translate(-195 -288) translate(175 160) translate(0 20) translate(20 108)"/>
                                </g></g></g></g></g></g>
                            </g>
                        </svg>
                        Шапка
                    </a>
                </li>
                <li>
                    <a aria-expanded="false" data-toggle="tab" href="#custom_temp-FOOTER">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                            <g fill="none" fill-rule="evenodd">
                                <g fill="#18BF49"><g><g><g><g><g>
                                    <path d="M15.1 5H6.9c-.497 0-.9.403-.9.9v4.2c0 .497.403.9.9.9h8.2c.497 0 .9-.403.9-.9V5.9c0-.497-.403-.9-.9-.9z" opacity=".3" transform="translate(-195 -324) translate(175 160) translate(0 20) translate(20 144)"/>
                                    <path d="M15.1 13H.9c-.497 0-.9.403-.9.9v1.2c0 .497.403.9.9.9h14.2c.497 0 .9-.403.9-.9v-1.2c0-.497-.403-.9-.9-.9z" transform="translate(-195 -324) translate(175 160) translate(0 20) translate(20 144)"/>
                                    <path d="M15.1 0H.9C.403 0 0 .403 0 .9v1.2c0 .497.403.9.9.9h14.2c.497 0 .9-.403.9-.9V.9c0-.497-.403-.9-.9-.9zM3.1 5H.9c-.497 0-.9.403-.9.9v4.2c0 .497.403.9.9.9h2.2c.497 0 .9-.403.9-.9V5.9c0-.497-.403-.9-.9-.9z" opacity=".3" transform="translate(-195 -324) translate(175 160) translate(0 20) translate(20 144)"/>
                                </g></g></g></g></g></g>
                            </g>
                        </svg>
                        Подвал
                    </a>
                </li>
                <li>
                    <a aria-expanded="false" data-toggle="tab" href="#custom_temp-PRODUCT_INFO">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                            <g fill="none" fill-rule="evenodd">
                                <g fill="#18BF49"><g><g><g><g><g>
                                    <path d="M15.1 9H.9c-.497 0-.9.403-.9.9v1.2c0 .497.403.9.9.9h14.2c.497 0 .9-.403.9-.9V9.9c0-.497-.403-.9-.9-.9zM13.1 14H2.9c-.497 0-.9.403-.9.9v.2c0 .497.403.9.9.9h10.2c.497 0 .9-.403.9-.9v-.2c0-.497-.403-.9-.9-.9z" opacity=".3" transform="translate(-195 -360) translate(175 160) translate(0 20) translate(20 180)"/>
                                    <path d="M11.1 0H4.9c-.497 0-.9.403-.9.9v5.2c0 .497.403.9.9.9h6.2c.497 0 .9-.403.9-.9V.9c0-.497-.403-.9-.9-.9z" transform="translate(-195 -360) translate(175 160) translate(0 20) translate(20 180)"/>
                                </g></g></g></g></g></g>
                            </g>
                        </svg>
                        Товар
                    </a>
                </li>
                <li>
                    <a aria-expanded="false" data-toggle="tab" href="#custom_temp-LISTING">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15">
                            <g fill="none" fill-rule="evenodd">
                                <g fill="#18BF49"><g><g><g><g><g>
                                    <path d="M9.1 0H6.9c-.497 0-.9.403-.9.9v3.2c0 .497.403.9.9.9h2.2c.497 0 .9-.403.9-.9V.9c0-.497-.403-.9-.9-.9zM3.1 9H.9c-.497 0-.9.403-.9.9v3.2c0 .497.403.9.9.9h2.2c.497 0 .9-.403.9-.9V9.9c0-.497-.403-.9-.9-.9zM15.1 9h-2.2c-.497 0-.9.403-.9.9v4.2c0 .497.403.9.9.9h2.2c.497 0 .9-.403.9-.9V9.9c0-.497-.403-.9-.9-.9z" opacity=".3" transform="translate(-195 -396) translate(175 160) translate(0 20) translate(20 216)"/>
                                    <path d="M15.1 0h-2.2c-.497 0-.9.403-.9.9v5.2c0 .497.403.9.9.9h2.2c.497 0 .9-.403.9-.9V.9c0-.497-.403-.9-.9-.9zM3.1 0H.9C.403 0 0 .403 0 .9v5.2c0 .497.403.9.9.9h2.2c.497 0 .9-.403.9-.9V.9c0-.497-.403-.9-.9-.9zM9.1 7H6.9c-.497 0-.9.403-.9.9v4.2c0 .497.403.9.9.9h2.2c.497 0 .9-.403.9-.9V7.9c0-.497-.403-.9-.9-.9z" transform="translate(-195 -396) translate(175 160) translate(0 20) translate(20 216)"/>
                                </g></g></g></g></g></g>
                            </g>
                        </svg>
                        Список товаров
                    </a>
                </li>
                <hr>
                <li>
                    <a aria-expanded="false" data-toggle="tab" href="#custom_temp-addModule">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                            <g fill="none" fill-rule="evenodd">
                                <g fill="#18BF49" fill-rule="nonzero"><g><g><g><g>
                                    <path d="M12.5 8.87c.523 0 1.021-.095 1.5-.238v.607L8.333 12c-.212.1-.454.1-.666 0L.387 8.475c-.516-.245-.516-1.061 0-1.306L7.072 4C7.478 6.758 9.75 8.87 12.5 8.87z" opacity=".3" transform="translate(-195 -453) translate(175 160) translate(0 20) translate(20 273)"/>
                                    <path d="M15.612 11.76l-1.83-.76-5.036 2.094c-.474.198-1.018.198-1.492 0L2.22 11l-1.831.76c-.517.215-.517.932 0 1.147l7.28 3.027c.21.088.453.088.664 0l7.281-3.027c.516-.215.516-.932-.001-1.147zM9.5 4.5h2v2c0 .276.224.5.5.5h1c.276 0 .5-.224.5-.5v-2h2c.276 0 .5-.224.5-.5V3c0-.276-.224-.5-.5-.5h-2v-2c0-.276-.224-.5-.5-.5h-1c-.276 0-.5.224-.5.5v2h-2c-.276 0-.5.224-.5.5v1c0 .276.224.5.5.5z" transform="translate(-195 -453) translate(175 160) translate(0 20) translate(20 273)"/>
                                </g></g></g></g></g>
                            </g>
                        </svg>
                        Добавить модуль
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="tab-content white_overlay">
            <div class="tab-pane fade " id="custom_temp-MAINCONF">1</div>
            <div class="tab-pane fade" id="custom_temp-LEFT">2</div>
            <div class="tab-pane fade active in" id="custom_temp-MAINPAGE">
                <div class="h2">
                    Главная страница
                    <span>
                        Дизайн:
                        <select name="" id="">
                            <option value="" selected>Ноутбуки</option>
                        </select>
                    </span>
                </div>
                <div class="h4">Последовательность блоков</div>
                <p class="description">Вы можете перемещать и редактировать блоки</p>
                <hr>
                <div class="sequence">
                    <div class="sequence_left">
                        <ul class="sortable" id="MAINPAGE">
                            <li class="active" data-location="" data-id="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15">
                                    <g fill="none" fill-rule="evenodd">
                                        <g fill="#18BF49"><g><g><g><g><g><g><g><g><g>
                                            <path d="M7.1 0H.9C.403 0 0 .403 0 .9v1.2c0 .497.403.9.9.9h6.2c.497 0 .9-.403.9-.9V.9c0-.497-.403-.9-.9-.9zM10.1 6H.9c-.497 0-.9.403-.9.9v1.2c0 .497.403.9.9.9h9.2c.497 0 .9-.403.9-.9V6.9c0-.497-.403-.9-.9-.9zM9.1 12H.9c-.497 0-.9.403-.9.9v1.2c0 .497.403.9.9.9h8.2c.497 0 .9-.403.9-.9v-1.2c0-.497-.403-.9-.9-.9z" transform="translate(-494 -259) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(30) translate(10 11)"/>
                                            <path d="M15.1 0h-2.2c-.497 0-.9.403-.9.9v1.2c0 .497.403.9.9.9h2.2c.497 0 .9-.403.9-.9V.9c0-.497-.403-.9-.9-.9zM15.1 6h-1.2c-.497 0-.9.403-.9.9v1.2c0 .497.403.9.9.9h1.2c.497 0 .9-.403.9-.9V6.9c0-.497-.403-.9-.9-.9zM15.1 12h-1.2c-.497 0-.9.403-.9.9v1.2c0 .497.403.9.9.9h1.2c.497 0 .9-.403.9-.9v-1.2c0-.497-.403-.9-.9-.9z" opacity=".3" transform="translate(-494 -259) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(30) translate(10 11)"/>
                                        </g></g></g></g></g></g></g></g></g></g>
                                    </g>
                                </svg>
                                Категории
                                <span class="tune_li">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <g fill="none" fill-rule="evenodd">
                                            <g fill="#495056" fill-rule="nonzero"><g><g><g><g><g><g><g><g><g>
                                                <path fill-opacity=".3" d="M15.795 9.923l-1.436-.794c.145-.748.145-1.516 0-2.264l1.436-.794c.164-.091.24-.278.185-.452-.37-1.135-1-2.177-1.843-3.051-.128-.133-.335-.164-.499-.074l-1.435.793c-.603-.497-1.298-.88-2.049-1.132V.57c0-.18-.13-.338-.315-.377-1.212-.259-2.468-.259-3.68 0-.184.039-.316.196-.316.377v1.587c-.75.255-1.443.64-2.049 1.132L2.36 2.497c-.163-.092-.371-.06-.498.074C1.018 3.444.388 4.487.018 5.623c-.056.173.02.361.186.451l1.435.794c-.145.748-.145 1.516 0 2.264l-1.435.794c-.164.09-.241.278-.186.451.371 1.136 1 2.178 1.844 3.052.127.133.334.164.498.074l1.436-.793c.603.497 1.298.88 2.048 1.132v1.587c0 .181.132.338.317.377 1.212.259 2.468.259 3.68 0 .185-.039.316-.196.316-.377v-1.587c.75-.256 1.444-.64 2.05-1.132l1.435.793c.163.091.371.06.498-.074.844-.873 1.474-1.916 1.843-3.052.054-.175-.024-.362-.188-.454zM8 11c-1.657 0-3-1.343-3-3s1.343-3 3-3 3 1.343 3 3c0 .796-.316 1.559-.879 2.121-.562.563-1.325.88-2.121.879z" transform="translate(-751 -304) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 46) translate(30) translate(267 10)"/>
                                                <path d="M8 10c-1.105 0-2-.895-2-2s.895-2 2-2 2 .895 2 2-.895 2-2 2z" transform="translate(-751 -304) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 46) translate(30) translate(267 10)"/>
                                            </g></g></g></g></g></g></g></g></g></g>
                                        </g>
                                    </svg>
                                </span>
                                <span class="status">
                                    <input id="1" type="checkbox" checked>
                                    <label for="1"></label>
                                </span>
                            </li>
                            <li class="open active" data-location="" data-id="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                    <g fill="none" fill-rule="evenodd">
                                        <g fill-rule="nonzero"><g><g><g><g><g><g><g><g><g>
                                            <path fill="#18BF49" d="M14 0H2C.895 0 0 .895 0 2v12c0 1.105.895 2 2 2h12c1.105 0 2-.895 2-2V2c0-1.105-.895-2-2-2z" transform="translate(-494 -304) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 46) translate(30) translate(10 10)"/>
                                            <path fill="#FFF" d="M2.67 11V7.546c.126-.232.302-.347.527-.347.202 0 .344.06.424.182.08.122.121.317.121.587V11H4.99V7.875C4.967 6.73 4.546 6.157 3.73 6.157c-.454 0-.822.186-1.103.558l-.035-.47H1.42V11H2.67zm4.833.088c.34 0 .655-.065.945-.196.29-.13.51-.3.663-.512l-.488-.751c-.278.284-.625.426-1.041.426-.287 0-.5-.081-.637-.244-.138-.162-.216-.42-.233-.771h2.474v-.61c-.006-.75-.16-1.317-.462-1.7-.301-.382-.751-.573-1.349-.573-.612 0-1.082.204-1.41.611-.328.407-.493.986-.493 1.736v.378c0 .709.18 1.254.537 1.635.357.38.855.57 1.494.57zm.461-2.918H6.721c.017-.343.075-.592.173-.747.098-.155.256-.233.473-.233.216 0 .369.073.457.22.087.146.134.361.14.646v.114zM11.307 11l.673-2.751.672 2.751h1.033l.984-4.755h-1.19l-.427 2.668-.633-2.668h-.883l-.633 2.672-.422-2.672H9.286L10.27 11h1.037z" transform="translate(-494 -304) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 46) translate(30) translate(10 10)"/>
                                        </g></g></g></g></g></g></g></g></g></g>
                                    </g>
                                </svg>
                                Новинки
                                <span class="tune_li">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <g fill="none" fill-rule="evenodd">
                                            <g fill="#495056" fill-rule="nonzero"><g><g><g><g><g><g><g><g><g>
                                                <path fill-opacity=".3" d="M15.795 9.923l-1.436-.794c.145-.748.145-1.516 0-2.264l1.436-.794c.164-.091.24-.278.185-.452-.37-1.135-1-2.177-1.843-3.051-.128-.133-.335-.164-.499-.074l-1.435.793c-.603-.497-1.298-.88-2.049-1.132V.57c0-.18-.13-.338-.315-.377-1.212-.259-2.468-.259-3.68 0-.184.039-.316.196-.316.377v1.587c-.75.255-1.443.64-2.049 1.132L2.36 2.497c-.163-.092-.371-.06-.498.074C1.018 3.444.388 4.487.018 5.623c-.056.173.02.361.186.451l1.435.794c-.145.748-.145 1.516 0 2.264l-1.435.794c-.164.09-.241.278-.186.451.371 1.136 1 2.178 1.844 3.052.127.133.334.164.498.074l1.436-.793c.603.497 1.298.88 2.048 1.132v1.587c0 .181.132.338.317.377 1.212.259 2.468.259 3.68 0 .185-.039.316-.196.316-.377v-1.587c.75-.256 1.444-.64 2.05-1.132l1.435.793c.163.091.371.06.498-.074.844-.873 1.474-1.916 1.843-3.052.054-.175-.024-.362-.188-.454zM8 11c-1.657 0-3-1.343-3-3s1.343-3 3-3 3 1.343 3 3c0 .796-.316 1.559-.879 2.121-.562.563-1.325.88-2.121.879z" transform="translate(-751 -304) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 46) translate(30) translate(267 10)"/>
                                                <path d="M8 10c-1.105 0-2-.895-2-2s.895-2 2-2 2 .895 2 2-.895 2-2 2z" transform="translate(-751 -304) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 46) translate(30) translate(267 10)"/>
                                            </g></g></g></g></g></g></g></g></g></g>
                                        </g>
                                    </svg>
                                </span>
                                <span class="status">
                                    <input id="2" type="checkbox" checked>
                                    <label for="2"></label>
                                </span>
                            </li>
                            <li data-location="" data-id="" checked>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                    <g fill="none" fill-rule="evenodd">
                                        <g fill="#18BF49"><g><g><g><g><g><g><g><g><g>
                                            <path d="M4.1 0H.9C.403 0 0 .403 0 .9v2.2c0 .497.403.9.9.9h3.2c.497 0 .9-.403.9-.9V.9c0-.497-.403-.9-.9-.9zM15.1 0H7.9c-.497 0-.9.403-.9.9v2.2c0 .497.403.9.9.9h7.2c.497 0 .9-.403.9-.9V.9c0-.497-.403-.9-.9-.9z" opacity=".3" transform="translate(-494 -396) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 138) translate(30) translate(10 10)"/>
                                            <path d="M15.1 6H.9c-.497 0-.9.403-.9.9v2.2c0 .497.403.9.9.9h14.2c.497 0 .9-.403.9-.9V6.9c0-.497-.403-.9-.9-.9z" transform="translate(-494 -396) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 138) translate(30) translate(10 10)"/>
                                            <path d="M7.1 12H.9c-.497 0-.9.403-.9.9v2.2c0 .497.403.9.9.9h6.2c.497 0 .9-.403.9-.9v-2.2c0-.497-.403-.9-.9-.9zM15.1 12h-4.2c-.497 0-.9.403-.9.9v2.2c0 .497.403.9.9.9h4.2c.497 0 .9-.403.9-.9v-2.2c0-.497-.403-.9-.9-.9z" opacity=".3" transform="translate(-494 -396) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 138) translate(30) translate(10 10)"/>
                                        </g></g></g></g></g></g></g></g></g></g>
                                    </g>
                                </svg>
                                Баннер длинный
                                <span class="tune_li">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <g fill="none" fill-rule="evenodd">
                                            <g fill="#495056" fill-rule="nonzero"><g><g><g><g><g><g><g><g><g>
                                                <path fill-opacity=".3" d="M15.795 9.923l-1.436-.794c.145-.748.145-1.516 0-2.264l1.436-.794c.164-.091.24-.278.185-.452-.37-1.135-1-2.177-1.843-3.051-.128-.133-.335-.164-.499-.074l-1.435.793c-.603-.497-1.298-.88-2.049-1.132V.57c0-.18-.13-.338-.315-.377-1.212-.259-2.468-.259-3.68 0-.184.039-.316.196-.316.377v1.587c-.75.255-1.443.64-2.049 1.132L2.36 2.497c-.163-.092-.371-.06-.498.074C1.018 3.444.388 4.487.018 5.623c-.056.173.02.361.186.451l1.435.794c-.145.748-.145 1.516 0 2.264l-1.435.794c-.164.09-.241.278-.186.451.371 1.136 1 2.178 1.844 3.052.127.133.334.164.498.074l1.436-.793c.603.497 1.298.88 2.048 1.132v1.587c0 .181.132.338.317.377 1.212.259 2.468.259 3.68 0 .185-.039.316-.196.316-.377v-1.587c.75-.256 1.444-.64 2.05-1.132l1.435.793c.163.091.371.06.498-.074.844-.873 1.474-1.916 1.843-3.052.054-.175-.024-.362-.188-.454zM8 11c-1.657 0-3-1.343-3-3s1.343-3 3-3 3 1.343 3 3c0 .796-.316 1.559-.879 2.121-.562.563-1.325.88-2.121.879z" transform="translate(-751 -304) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 46) translate(30) translate(267 10)"/>
                                                <path d="M8 10c-1.105 0-2-.895-2-2s.895-2 2-2 2 .895 2 2-.895 2-2 2z" transform="translate(-751 -304) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 46) translate(30) translate(267 10)"/>
                                            </g></g></g></g></g></g></g></g></g></g>
                                        </g>
                                    </svg>
                                </span>
                                <span class="status">
                                    <input id="4" type="checkbox">
                                    <label for="4"></label>
                                </span>
                            </li>
                            <li data-location="" data-id="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="10" viewBox="0 0 16 10">
                                    <g fill="none" fill-rule="evenodd">
                                        <g fill="#18BF49"><g><g><g><g><g><g><g><g><g>
                                            <path d="M2.1 1H0v8h2.1c.497 0 .9-.403.9-.9V1.9c0-.497-.403-.9-.9-.9z" opacity=".3" transform="translate(-494 -445) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 184) translate(30) translate(10 13)"/>
                                            <path d="M15.1 1H13v8h2.1c.497 0 .9-.403.9-.9V1.9c0-.497-.403-.9-.9-.9z" opacity=".3" transform="translate(-494 -445) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 184) translate(30) translate(10 13) matrix(-1 0 0 1 29 0)"/>
                                            <path d="M11.1 0H4.9c-.497 0-.9.403-.9.9v8.2c0 .497.403.9.9.9h6.2c.497 0 .9-.403.9-.9V.9c0-.497-.403-.9-.9-.9z" transform="translate(-494 -445) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 184) translate(30) translate(10 13)"/>
                                        </g></g></g></g></g></g></g></g></g></g>
                                    </g>
                                </svg>
                                Слайдер
                                <span class="tune_li">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <g fill="none" fill-rule="evenodd">
                                            <g fill="#495056" fill-rule="nonzero"><g><g><g><g><g><g><g><g><g>
                                                <path fill-opacity=".3" d="M15.795 9.923l-1.436-.794c.145-.748.145-1.516 0-2.264l1.436-.794c.164-.091.24-.278.185-.452-.37-1.135-1-2.177-1.843-3.051-.128-.133-.335-.164-.499-.074l-1.435.793c-.603-.497-1.298-.88-2.049-1.132V.57c0-.18-.13-.338-.315-.377-1.212-.259-2.468-.259-3.68 0-.184.039-.316.196-.316.377v1.587c-.75.255-1.443.64-2.049 1.132L2.36 2.497c-.163-.092-.371-.06-.498.074C1.018 3.444.388 4.487.018 5.623c-.056.173.02.361.186.451l1.435.794c-.145.748-.145 1.516 0 2.264l-1.435.794c-.164.09-.241.278-.186.451.371 1.136 1 2.178 1.844 3.052.127.133.334.164.498.074l1.436-.793c.603.497 1.298.88 2.048 1.132v1.587c0 .181.132.338.317.377 1.212.259 2.468.259 3.68 0 .185-.039.316-.196.316-.377v-1.587c.75-.256 1.444-.64 2.05-1.132l1.435.793c.163.091.371.06.498-.074.844-.873 1.474-1.916 1.843-3.052.054-.175-.024-.362-.188-.454zM8 11c-1.657 0-3-1.343-3-3s1.343-3 3-3 3 1.343 3 3c0 .796-.316 1.559-.879 2.121-.562.563-1.325.88-2.121.879z" transform="translate(-751 -304) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 46) translate(30) translate(267 10)"/>
                                                <path d="M8 10c-1.105 0-2-.895-2-2s.895-2 2-2 2 .895 2 2-.895 2-2 2z" transform="translate(-751 -304) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 46) translate(30) translate(267 10)"/>
                                            </g></g></g></g></g></g></g></g></g></g>
                                        </g>
                                    </svg>
                                </span>
                                <span class="status">
                                    <input id="5" type="checkbox">
                                    <label for="5"></label>
                                </span>
                            </li>
                            <li class="active" data-location="" data-id="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15">
                                    <g fill="none" fill-rule="evenodd">
                                        <g fill="#18BF49"><g><g><g><g><g><g><g><g><g>
                                            <path d="M10.1 4H8.9c-.497 0-.9.403-.9.9v9.2c0 .497.403.9.9.9h1.2c.497 0 .9-.403.9-.9V4.9c0-.497-.403-.9-.9-.9z" opacity=".3" transform="translate(-494 -488) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 230) translate(30) translate(10 10)"/>
                                            <path d="M14.1 0h-1.2c-.497 0-.9.403-.9.9v13.2c0 .497.403.9.9.9h1.2c.497 0 .9-.403.9-.9V.9c0-.497-.403-.9-.9-.9z" transform="translate(-494 -488) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 230) translate(30) translate(10 10)"/>
                                            <path d="M6.1 8H4.9c-.497 0-.9.403-.9.9v5.2c0 .497.403.9.9.9h1.2c.497 0 .9-.403.9-.9V8.9c0-.497-.403-.9-.9-.9zM2.1 10H.9c-.497 0-.9.403-.9.9v3.2c0 .497.403.9.9.9h1.2c.497 0 .9-.403.9-.9v-3.2c0-.497-.403-.9-.9-.9z" opacity=".3" transform="translate(-494 -488) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 230) translate(30) translate(10 10)"/>
                                        </g></g></g></g></g></g></g></g></g></g>
                                    </g>
                                </svg>
                                Топ продаж
                                <span class="tune_li">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <g fill="none" fill-rule="evenodd">
                                            <g fill="#495056" fill-rule="nonzero"><g><g><g><g><g><g><g><g><g>
                                                <path fill-opacity=".3" d="M15.795 9.923l-1.436-.794c.145-.748.145-1.516 0-2.264l1.436-.794c.164-.091.24-.278.185-.452-.37-1.135-1-2.177-1.843-3.051-.128-.133-.335-.164-.499-.074l-1.435.793c-.603-.497-1.298-.88-2.049-1.132V.57c0-.18-.13-.338-.315-.377-1.212-.259-2.468-.259-3.68 0-.184.039-.316.196-.316.377v1.587c-.75.255-1.443.64-2.049 1.132L2.36 2.497c-.163-.092-.371-.06-.498.074C1.018 3.444.388 4.487.018 5.623c-.056.173.02.361.186.451l1.435.794c-.145.748-.145 1.516 0 2.264l-1.435.794c-.164.09-.241.278-.186.451.371 1.136 1 2.178 1.844 3.052.127.133.334.164.498.074l1.436-.793c.603.497 1.298.88 2.048 1.132v1.587c0 .181.132.338.317.377 1.212.259 2.468.259 3.68 0 .185-.039.316-.196.316-.377v-1.587c.75-.256 1.444-.64 2.05-1.132l1.435.793c.163.091.371.06.498-.074.844-.873 1.474-1.916 1.843-3.052.054-.175-.024-.362-.188-.454zM8 11c-1.657 0-3-1.343-3-3s1.343-3 3-3 3 1.343 3 3c0 .796-.316 1.559-.879 2.121-.562.563-1.325.88-2.121.879z" transform="translate(-751 -304) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 46) translate(30) translate(267 10)"/>
                                                <path d="M8 10c-1.105 0-2-.895-2-2s.895-2 2-2 2 .895 2 2-.895 2-2 2z" transform="translate(-751 -304) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 46) translate(30) translate(267 10)"/>
                                            </g></g></g></g></g></g></g></g></g></g>
                                        </g>
                                    </svg>
                                </span>
                                <span class="status">
                                    <input id="6" type="checkbox" checked>
                                    <label for="6"></label>
                                </span>
                            </li>
                            <li data-location="" data-id="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 0 16 14">
                                    <g fill="none" fill-rule="evenodd">
                                        <g fill="#18BF49"><g><g><g><g><g><g><g><g><g>
                                            <path d="M15.1 6H.9c-.497 0-.9.403-.9.9v.2c0 .497.403.9.9.9h14.2c.497 0 .9-.403.9-.9v-.2c0-.497-.403-.9-.9-.9z" opacity=".3" transform="translate(-494 -535) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 276) translate(30) translate(10 11)"/>
                                            <path d="M8 0C6.895 0 6 .895 6 2s.895 2 2 2 2-.895 2-2-.895-2-2-2zM8 10c-1.105 0-2 .895-2 2s.895 2 2 2 2-.895 2-2-.895-2-2-2z" transform="translate(-494 -535) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 276) translate(30) translate(10 11)"/>
                                        </g></g></g></g></g></g></g></g></g></g>
                                    </g>
                                </svg>
                                Скидки
                                <span class="tune_li">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <g fill="none" fill-rule="evenodd">
                                            <g fill="#495056" fill-rule="nonzero"><g><g><g><g><g><g><g><g><g>
                                                <path fill-opacity=".3" d="M15.795 9.923l-1.436-.794c.145-.748.145-1.516 0-2.264l1.436-.794c.164-.091.24-.278.185-.452-.37-1.135-1-2.177-1.843-3.051-.128-.133-.335-.164-.499-.074l-1.435.793c-.603-.497-1.298-.88-2.049-1.132V.57c0-.18-.13-.338-.315-.377-1.212-.259-2.468-.259-3.68 0-.184.039-.316.196-.316.377v1.587c-.75.255-1.443.64-2.049 1.132L2.36 2.497c-.163-.092-.371-.06-.498.074C1.018 3.444.388 4.487.018 5.623c-.056.173.02.361.186.451l1.435.794c-.145.748-.145 1.516 0 2.264l-1.435.794c-.164.09-.241.278-.186.451.371 1.136 1 2.178 1.844 3.052.127.133.334.164.498.074l1.436-.793c.603.497 1.298.88 2.048 1.132v1.587c0 .181.132.338.317.377 1.212.259 2.468.259 3.68 0 .185-.039.316-.196.316-.377v-1.587c.75-.256 1.444-.64 2.05-1.132l1.435.793c.163.091.371.06.498-.074.844-.873 1.474-1.916 1.843-3.052.054-.175-.024-.362-.188-.454zM8 11c-1.657 0-3-1.343-3-3s1.343-3 3-3 3 1.343 3 3c0 .796-.316 1.559-.879 2.121-.562.563-1.325.88-2.121.879z" transform="translate(-751 -304) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 46) translate(30) translate(267 10)"/>
                                                <path d="M8 10c-1.105 0-2-.895-2-2s.895-2 2-2 2 .895 2 2-.895 2-2 2z" transform="translate(-751 -304) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 46) translate(30) translate(267 10)"/>
                                            </g></g></g></g></g></g></g></g></g></g>
                                        </g>
                                    </svg>
                                </span>
                                <span class="status">
                                    <input id="7" type="checkbox">
                                    <label for="7"></label>
                                </span>
                            </li>
                            <li data-location="" data-id="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                    <g fill="none" fill-rule="evenodd">
                                        <g fill="#18BF49" fill-rule="nonzero"><g><g><g><g><g><g><g><g><g>
                                            <path d="M4.382 0H.934c-.276 0-.5.224-.5.5 0 .099.03.195.084.277l2.927 4.39c.307.46.928.585 1.387.278l1.8-1.2c.21-.14.283-.414.17-.64L5.277.553C5.107.214 4.761 0 4.382 0zm6.342.553L9.197 3.605c-.112.226-.04.5.17.64l1.8 1.2c.46.307 1.081.182 1.388-.277l2.927-4.39c.153-.23.09-.54-.139-.694C15.261.029 15.164 0 15.066 0h-3.448c-.379 0-.725.214-.894.553z" opacity=".3" transform="translate(-494 -580) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 322) translate(30) translate(10 10)"/>
                                            <path d="M8 6c-2.761 0-5 2.239-5 5s2.239 5 5 5 5-2.239 5-5-2.239-5-5-5zm1.747 6.108l.24 1.454c.022.14-.033.283-.143.366-.11.084-.257.095-.378.03l-1.226-.675c-.15-.082-.332-.082-.482 0l-1.225.673c-.12.066-.267.055-.378-.029-.11-.084-.165-.225-.142-.366l.24-1.454c.026-.157-.025-.318-.137-.432L5.108 10.65c-.097-.1-.133-.249-.09-.384.042-.136.154-.235.289-.256L6.68 9.8c.165-.025.306-.13.377-.28l.619-1.311c.06-.128.185-.209.322-.209s.262.08.322.209l.619 1.31c.071.15.212.256.377.281l1.375.21c.136.02.248.12.29.255.043.136.007.285-.091.385l-1.008 1.027c-.112.113-.162.274-.136.431z" transform="translate(-494 -580) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 322) translate(30) translate(10 10)"/>
                                        </g></g></g></g></g></g></g></g></g></g>
                                    </g>
                                </svg>
                                Рекомендуемые
                                <span class="tune_li">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <g fill="none" fill-rule="evenodd">
                                            <g fill="#495056" fill-rule="nonzero"><g><g><g><g><g><g><g><g><g>
                                                <path fill-opacity=".3" d="M15.795 9.923l-1.436-.794c.145-.748.145-1.516 0-2.264l1.436-.794c.164-.091.24-.278.185-.452-.37-1.135-1-2.177-1.843-3.051-.128-.133-.335-.164-.499-.074l-1.435.793c-.603-.497-1.298-.88-2.049-1.132V.57c0-.18-.13-.338-.315-.377-1.212-.259-2.468-.259-3.68 0-.184.039-.316.196-.316.377v1.587c-.75.255-1.443.64-2.049 1.132L2.36 2.497c-.163-.092-.371-.06-.498.074C1.018 3.444.388 4.487.018 5.623c-.056.173.02.361.186.451l1.435.794c-.145.748-.145 1.516 0 2.264l-1.435.794c-.164.09-.241.278-.186.451.371 1.136 1 2.178 1.844 3.052.127.133.334.164.498.074l1.436-.793c.603.497 1.298.88 2.048 1.132v1.587c0 .181.132.338.317.377 1.212.259 2.468.259 3.68 0 .185-.039.316-.196.316-.377v-1.587c.75-.256 1.444-.64 2.05-1.132l1.435.793c.163.091.371.06.498-.074.844-.873 1.474-1.916 1.843-3.052.054-.175-.024-.362-.188-.454zM8 11c-1.657 0-3-1.343-3-3s1.343-3 3-3 3 1.343 3 3c0 .796-.316 1.559-.879 2.121-.562.563-1.325.88-2.121.879z" transform="translate(-751 -304) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 46) translate(30) translate(267 10)"/>
                                                <path d="M8 10c-1.105 0-2-.895-2-2s.895-2 2-2 2 .895 2 2-.895 2-2 2z" transform="translate(-751 -304) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 46) translate(30) translate(267 10)"/>
                                            </g></g></g></g></g></g></g></g></g></g>
                                        </g>
                                    </svg>
                                </span>
                                <span class="status">
                                    <input id="8" type="checkbox">
                                    <label for="8"></label>
                                </span>
                            </li>
                            <li class="active" data-location="" data-id="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="13" viewBox="0 0 16 13">
                                    <g fill="none" fill-rule="evenodd">
                                        <g fill-rule="nonzero"><g><g><g><g><g><g><g><g><g>
                                            <path fill="#18BF49" d="M9.586 0H5c-.552 0-1 .448-1 1v4.586c0 .265.105.52.293.707l5.293 5.293c.78.78 2.047.78 2.828 0l2.889-2.889c.937-.937.937-2.457 0-3.394l-5.01-5.01C10.105.105 9.85 0 9.586 0z" transform="translate(-494 -628) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 368) translate(30) translate(10 12)"/>
                                            <path fill="#FFF" d="M7.586 0H3c-.552 0-1 .448-1 1v4.586c0 .265.105.52.293.707l5.293 5.293c.78.78 2.047.78 2.828 0l3.172-3.172c.78-.78.78-2.047 0-2.828L8.293.293C8.105.105 7.85 0 7.586 0z" transform="translate(-494 -628) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 368) translate(30) translate(10 12)"/>
                                            <path fill="#18BF49" d="M5.586 0H1C.448 0 0 .448 0 1v4.586c0 .265.105.52.293.707l5.293 5.293c.78.78 2.047.78 2.828 0l3.172-3.172c.78-.78.78-2.047 0-2.828L6.293.293C6.105.105 5.85 0 5.586 0zM2 3c0-.552.448-1 1-1s1 .448 1 1-.448 1-1 1-1-.448-1-1z" opacity=".3" transform="translate(-494 -628) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 368) translate(30) translate(10 12)"/>
                                        </g></g></g></g></g></g></g></g></g></g>
                                    </g>
                                </svg>
                                Производители
                                <span class="tune_li">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <g fill="none" fill-rule="evenodd">
                                            <g fill="#495056" fill-rule="nonzero"><g><g><g><g><g><g><g><g><g>
                                                <path fill-opacity=".3" d="M15.795 9.923l-1.436-.794c.145-.748.145-1.516 0-2.264l1.436-.794c.164-.091.24-.278.185-.452-.37-1.135-1-2.177-1.843-3.051-.128-.133-.335-.164-.499-.074l-1.435.793c-.603-.497-1.298-.88-2.049-1.132V.57c0-.18-.13-.338-.315-.377-1.212-.259-2.468-.259-3.68 0-.184.039-.316.196-.316.377v1.587c-.75.255-1.443.64-2.049 1.132L2.36 2.497c-.163-.092-.371-.06-.498.074C1.018 3.444.388 4.487.018 5.623c-.056.173.02.361.186.451l1.435.794c-.145.748-.145 1.516 0 2.264l-1.435.794c-.164.09-.241.278-.186.451.371 1.136 1 2.178 1.844 3.052.127.133.334.164.498.074l1.436-.793c.603.497 1.298.88 2.048 1.132v1.587c0 .181.132.338.317.377 1.212.259 2.468.259 3.68 0 .185-.039.316-.196.316-.377v-1.587c.75-.256 1.444-.64 2.05-1.132l1.435.793c.163.091.371.06.498-.074.844-.873 1.474-1.916 1.843-3.052.054-.175-.024-.362-.188-.454zM8 11c-1.657 0-3-1.343-3-3s1.343-3 3-3 3 1.343 3 3c0 .796-.316 1.559-.879 2.121-.562.563-1.325.88-2.121.879z" transform="translate(-751 -304) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 46) translate(30) translate(267 10)"/>
                                                <path d="M8 10c-1.105 0-2-.895-2-2s.895-2 2-2 2 .895 2 2-.895 2-2 2z" transform="translate(-751 -304) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 46) translate(30) translate(267 10)"/>
                                            </g></g></g></g></g></g></g></g></g></g>
                                        </g>
                                    </svg>
                                </span>
                                <span class="status">
                                    <input id="9" type="checkbox" checked>
                                    <label for="9"></label>
                                </span>
                            </li>
                            <li class="active" data-location="" data-id="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="11" viewBox="0 0 16 11">
                                    <g fill="none" fill-rule="evenodd">
                                        <g fill="#18BF49" fill-rule="nonzero"><g><g><g><g><g><g><g><g><g>
                                            <path d="M15.903 5.082C14.397 2.05 11.415 0 8 0 4.585 0 1.602 2.052.097 5.082c-.13.263-.13.573 0 .836C1.603 8.95 4.585 11 8 11c3.415 0 6.398-2.052 7.903-5.082.13-.263.13-.573 0-.836zm-7.9 4.543H8c-2.208-.001-3.997-1.847-3.996-4.124 0-2.277 1.79-4.122 3.998-4.122S11.999 3.224 12 5.501c0 2.277-1.788 4.123-3.996 4.124z" opacity=".3" transform="translate(-494 -674) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 414) translate(30) translate(10 12)"/>
                                            <path d="M10.574 6.212c-.247.949-.967 1.689-1.887 1.94-.92.253-1.901-.022-2.572-.719-.67-.697-.928-1.711-.676-2.658.529.401 1.263.344 1.727-.135.465-.479.52-1.236.13-1.781.922-.271 1.912-.009 2.592.687.68.695.942 1.715.687 2.666h-.001z" transform="translate(-494 -674) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 414) translate(30) translate(10 12)"/>
                                        </g></g></g></g></g></g></g></g></g></g>
                                    </g>
                                </svg>
                                Просмотренные товары
                                <span class="tune_li">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <g fill="none" fill-rule="evenodd">
                                            <g fill="#495056" fill-rule="nonzero"><g><g><g><g><g><g><g><g><g>
                                                <path fill-opacity=".3" d="M15.795 9.923l-1.436-.794c.145-.748.145-1.516 0-2.264l1.436-.794c.164-.091.24-.278.185-.452-.37-1.135-1-2.177-1.843-3.051-.128-.133-.335-.164-.499-.074l-1.435.793c-.603-.497-1.298-.88-2.049-1.132V.57c0-.18-.13-.338-.315-.377-1.212-.259-2.468-.259-3.68 0-.184.039-.316.196-.316.377v1.587c-.75.255-1.443.64-2.049 1.132L2.36 2.497c-.163-.092-.371-.06-.498.074C1.018 3.444.388 4.487.018 5.623c-.056.173.02.361.186.451l1.435.794c-.145.748-.145 1.516 0 2.264l-1.435.794c-.164.09-.241.278-.186.451.371 1.136 1 2.178 1.844 3.052.127.133.334.164.498.074l1.436-.793c.603.497 1.298.88 2.048 1.132v1.587c0 .181.132.338.317.377 1.212.259 2.468.259 3.68 0 .185-.039.316-.196.316-.377v-1.587c.75-.256 1.444-.64 2.05-1.132l1.435.793c.163.091.371.06.498-.074.844-.873 1.474-1.916 1.843-3.052.054-.175-.024-.362-.188-.454zM8 11c-1.657 0-3-1.343-3-3s1.343-3 3-3 3 1.343 3 3c0 .796-.316 1.559-.879 2.121-.562.563-1.325.88-2.121.879z" transform="translate(-751 -304) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 46) translate(30) translate(267 10)"/>
                                                <path d="M8 10c-1.105 0-2-.895-2-2s.895-2 2-2 2 .895 2 2-.895 2-2 2z" transform="translate(-751 -304) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 46) translate(30) translate(267 10)"/>
                                            </g></g></g></g></g></g></g></g></g></g>
                                        </g>
                                    </svg>
                                </span>
                                <span class="status">
                                    <input id="10" type="checkbox" checked>
                                    <label for="10"></label>
                                </span>
                            </li>
                            <li data-location="" data-id="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                    <g fill="none" fill-rule="evenodd">
                                        <g fill="#18BF49"><g><g><g><g><g><g><g><g><g>
                                            <path d="M9.1 0H6.9c-.497 0-.9.403-.9.9v8.2c0 .497.403.9.9.9h2.2c.497 0 .9-.403.9-.9V.9c0-.497-.403-.9-.9-.9zM15.1 0h-2.2c-.497 0-.9.403-.9.9v8.2c0 .497.403.9.9.9h2.2c.497 0 .9-.403.9-.9V.9c0-.497-.403-.9-.9-.9z" transform="translate(-494 -718) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 460) translate(30) translate(10 10)"/>
                                            <path d="M15.1 12H6.9c-.497 0-.9.403-.9.9v2.2c0 .497.403.9.9.9h8.2c.497 0 .9-.403.9-.9v-2.2c0-.497-.403-.9-.9-.9zM3.1 0H.9C.403 0 0 .403 0 .9v3.2c0 .497.403.9.9.9h2.2c.497 0 .9-.403.9-.9V.9c0-.497-.403-.9-.9-.9zM3.1 7H.9c-.497 0-.9.403-.9.9v7.2c0 .497.403.9.9.9h2.2c.497 0 .9-.403.9-.9V7.9c0-.497-.403-.9-.9-.9z" opacity=".3" transform="translate(-494 -718) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 460) translate(30) translate(10 10)"/>
                                        </g></g></g></g></g></g></g></g></g></g>
                                    </g>
                                </svg>
                                Новости
                                <span class="tune_li">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <g fill="none" fill-rule="evenodd">
                                            <g fill="#495056" fill-rule="nonzero"><g><g><g><g><g><g><g><g><g>
                                                <path fill-opacity=".3" d="M15.795 9.923l-1.436-.794c.145-.748.145-1.516 0-2.264l1.436-.794c.164-.091.24-.278.185-.452-.37-1.135-1-2.177-1.843-3.051-.128-.133-.335-.164-.499-.074l-1.435.793c-.603-.497-1.298-.88-2.049-1.132V.57c0-.18-.13-.338-.315-.377-1.212-.259-2.468-.259-3.68 0-.184.039-.316.196-.316.377v1.587c-.75.255-1.443.64-2.049 1.132L2.36 2.497c-.163-.092-.371-.06-.498.074C1.018 3.444.388 4.487.018 5.623c-.056.173.02.361.186.451l1.435.794c-.145.748-.145 1.516 0 2.264l-1.435.794c-.164.09-.241.278-.186.451.371 1.136 1 2.178 1.844 3.052.127.133.334.164.498.074l1.436-.793c.603.497 1.298.88 2.048 1.132v1.587c0 .181.132.338.317.377 1.212.259 2.468.259 3.68 0 .185-.039.316-.196.316-.377v-1.587c.75-.256 1.444-.64 2.05-1.132l1.435.793c.163.091.371.06.498-.074.844-.873 1.474-1.916 1.843-3.052.054-.175-.024-.362-.188-.454zM8 11c-1.657 0-3-1.343-3-3s1.343-3 3-3 3 1.343 3 3c0 .796-.316 1.559-.879 2.121-.562.563-1.325.88-2.121.879z" transform="translate(-751 -304) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 46) translate(30) translate(267 10)"/>
                                                <path d="M8 10c-1.105 0-2-.895-2-2s.895-2 2-2 2 .895 2 2-.895 2-2 2z" transform="translate(-751 -304) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 46) translate(30) translate(267 10)"/>
                                            </g></g></g></g></g></g></g></g></g></g>
                                        </g>
                                    </svg>
                                </span>
                                <span class="status">
                                    <input id="11" type="checkbox">
                                    <label for="11"></label>
                                </span>
                            </li>
                            <li class="active" data-location="" data-id="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                    <g fill="none" fill-rule="evenodd">
                                        <g fill="#18BF49"><g><g><g><g><g><g><g><g><g>
                                            <path d="M15.1 0H.9C.403 0 0 .403 0 .9v2.2c0 .497.403.9.9.9h14.2c.497 0 .9-.403.9-.9V.9c0-.497-.403-.9-.9-.9zM15.1 6H.9c-.497 0-.9.403-.9.9v.2c0 .497.403.9.9.9h14.2c.497 0 .9-.403.9-.9v-.2c0-.497-.403-.9-.9-.9z" opacity=".3" transform="translate(-494 -764) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 506) translate(30) translate(10 10)"/>
                                            <path d="M15.1 14H.9c-.497 0-.9.403-.9.9v.2c0 .497.403.9.9.9h14.2c.497 0 .9-.403.9-.9v-.2c0-.497-.403-.9-.9-.9zM15.1 10H.9c-.497 0-.9.403-.9.9v.2c0 .497.403.9.9.9h14.2c.497 0 .9-.403.9-.9v-.2c0-.497-.403-.9-.9-.9z" transform="translate(-494 -764) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 506) translate(30) translate(10 10)"/>
                                        </g></g></g></g></g></g></g></g></g></g>
                                    </g>
                                </svg>
                                Текст главной
                                <span class="tune_li">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <g fill="none" fill-rule="evenodd">
                                            <g fill="#495056" fill-rule="nonzero"><g><g><g><g><g><g><g><g><g>
                                                <path fill-opacity=".3" d="M15.795 9.923l-1.436-.794c.145-.748.145-1.516 0-2.264l1.436-.794c.164-.091.24-.278.185-.452-.37-1.135-1-2.177-1.843-3.051-.128-.133-.335-.164-.499-.074l-1.435.793c-.603-.497-1.298-.88-2.049-1.132V.57c0-.18-.13-.338-.315-.377-1.212-.259-2.468-.259-3.68 0-.184.039-.316.196-.316.377v1.587c-.75.255-1.443.64-2.049 1.132L2.36 2.497c-.163-.092-.371-.06-.498.074C1.018 3.444.388 4.487.018 5.623c-.056.173.02.361.186.451l1.435.794c-.145.748-.145 1.516 0 2.264l-1.435.794c-.164.09-.241.278-.186.451.371 1.136 1 2.178 1.844 3.052.127.133.334.164.498.074l1.436-.793c.603.497 1.298.88 2.048 1.132v1.587c0 .181.132.338.317.377 1.212.259 2.468.259 3.68 0 .185-.039.316-.196.316-.377v-1.587c.75-.256 1.444-.64 2.05-1.132l1.435.793c.163.091.371.06.498-.074.844-.873 1.474-1.916 1.843-3.052.054-.175-.024-.362-.188-.454zM8 11c-1.657 0-3-1.343-3-3s1.343-3 3-3 3 1.343 3 3c0 .796-.316 1.559-.879 2.121-.562.563-1.325.88-2.121.879z" transform="translate(-751 -304) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 46) translate(30) translate(267 10)"/>
                                                <path d="M8 10c-1.105 0-2-.895-2-2s.895-2 2-2 2 .895 2 2-.895 2-2 2z" transform="translate(-751 -304) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 46) translate(30) translate(267 10)"/>
                                            </g></g></g></g></g></g></g></g></g></g>
                                        </g>
                                    </svg>
                                </span>
                                <span class="status">
                                    <input id="12" type="checkbox" checked>
                                    <label for="12"></label>
                                </span>
                            </li>
                            <li class="active" data-location="" data-id="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                    <g fill="none" fill-rule="evenodd"><g><g><g><g><g><g><g><g><g><g>
                                        <path fill="#18BF49" d="M11.1 5H9.9c-.497 0-.9.403-.9.9v9.2c0 .497.403.9.9.9h1.2c.497 0 .9-.403.9-.9V5.9c0-.497-.403-.9-.9-.9z" opacity=".3" transform="translate(-494 -810) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 552) translate(30) translate(10 10)"/>
                                        <path fill="#18BF49" d="M15.1 1h-1.2c-.497 0-.9.403-.9.9v13.2c0 .497.403.9.9.9h1.2c.497 0 .9-.403.9-.9V1.9c0-.497-.403-.9-.9-.9z" transform="translate(-494 -810) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 552) translate(30) translate(10 10)"/>
                                        <path fill="#18BF49" d="M7.1 12H5.9c-.497 0-.9.403-.9.9v2.2c0 .497.403.9.9.9h1.2c.497 0 .9-.403.9-.9v-2.2c0-.497-.403-.9-.9-.9zM3.1 14H.9c-.497 0-.9.403-.9.9v.2c0 .497.403.9.9.9h2.2c.497 0 .9-.403.9-.9v-.2c0-.497-.403-.9-.9-.9z" opacity=".3" transform="translate(-494 -810) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 552) translate(30) translate(10 10)"/>
                                        <g fill-rule="nonzero">
                                            <path fill="#FFF" d="M13 3.667C11.562 1.6 9.383 0 7 0 4.012 0 1.402 2.052.085 5.082c-.113.263-.113 1.49 0 1.753C1.403 9.865 4.012 11 7 11c2.386 0 4.562-1.597 6-3.667V3.667z" transform="translate(-494 -810) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 552) translate(30) translate(10 10)"/>
                                            <path fill="#18BF49" d="M11.928 4.696C10.797 2.49 8.56 1 6 1S1.202 2.493.072 4.696c-.096.191-.096.417 0 .608C1.202 7.51 3.44 9 6 9s4.798-1.492 5.928-3.696c.096-.191.096-.417 0-.608zM6 8H6C4.342 8 2.999 6.656 3 5c0-1.657 1.343-3 3-3s3 1.343 3 3c0 1.656-1.342 3-2.999 3z" opacity=".3" transform="translate(-494 -810) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 552) translate(30) translate(10 10)"/>
                                            <path fill="#18BF49" d="M7.927 5.52c-.185.69-.726 1.23-1.417 1.413-.69.184-1.427-.016-1.93-.524-.504-.508-.698-1.247-.509-1.937.398.293.949.251 1.298-.098.348-.349.39-.9.098-1.298.69-.197 1.435-.006 1.945.501s.708 1.25.516 1.943z" transform="translate(-494 -810) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 552) translate(30) translate(10 10)"/>
                                        </g></g></g></g></g></g></g></g></g></g></g>
                                    </g>
                                </svg>
                                Топ просмотров
                                <span class="tune_li">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <g fill="none" fill-rule="evenodd">
                                            <g fill="#495056" fill-rule="nonzero"><g><g><g><g><g><g><g><g><g>
                                                <path fill-opacity=".3" d="M15.795 9.923l-1.436-.794c.145-.748.145-1.516 0-2.264l1.436-.794c.164-.091.24-.278.185-.452-.37-1.135-1-2.177-1.843-3.051-.128-.133-.335-.164-.499-.074l-1.435.793c-.603-.497-1.298-.88-2.049-1.132V.57c0-.18-.13-.338-.315-.377-1.212-.259-2.468-.259-3.68 0-.184.039-.316.196-.316.377v1.587c-.75.255-1.443.64-2.049 1.132L2.36 2.497c-.163-.092-.371-.06-.498.074C1.018 3.444.388 4.487.018 5.623c-.056.173.02.361.186.451l1.435.794c-.145.748-.145 1.516 0 2.264l-1.435.794c-.164.09-.241.278-.186.451.371 1.136 1 2.178 1.844 3.052.127.133.334.164.498.074l1.436-.793c.603.497 1.298.88 2.048 1.132v1.587c0 .181.132.338.317.377 1.212.259 2.468.259 3.68 0 .185-.039.316-.196.316-.377v-1.587c.75-.256 1.444-.64 2.05-1.132l1.435.793c.163.091.371.06.498-.074.844-.873 1.474-1.916 1.843-3.052.054-.175-.024-.362-.188-.454zM8 11c-1.657 0-3-1.343-3-3s1.343-3 3-3 3 1.343 3 3c0 .796-.316 1.559-.879 2.121-.562.563-1.325.88-2.121.879z" transform="translate(-751 -304) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 46) translate(30) translate(267 10)"/>
                                                <path d="M8 10c-1.105 0-2-.895-2-2s.895-2 2-2 2 .895 2 2-.895 2-2 2z" transform="translate(-751 -304) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 46) translate(30) translate(267 10)"/>
                                            </g></g></g></g></g></g></g></g></g></g>
                                        </g>
                                    </svg>
                                </span>
                                <span class="status">
                                    <input id="13" type="checkbox" checked>
                                    <label for="13"></label>
                                </span>
                            </li>
                            <li class="active" data-location="" data-id="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                    <g fill="none" fill-rule="evenodd">
                                        <g fill="#18BF49" fill-rule="nonzero"><g><g><g><g><g><g><g><g><g>
                                            <path d="M14 5c1.105 0 2 .895 2 2v8.253c0 .079-.023.156-.067.221-.123.184-.371.234-.555.111l-2.126-1.417c-.164-.11-.357-.168-.555-.168H7c-1.105 0-2-.895-2-2v-1h6c1.054 0 1.918-.816 1.995-1.85L13 9V5z" opacity=".3" transform="translate(-494 -856) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 598) translate(30) translate(10 10)"/>
                                            <path d="M2.748 9.168L.622 10.585c-.184.123-.432.073-.555-.11-.044-.066-.067-.143-.067-.222V2C0 .895.895 0 2 0h7c1.105 0 2 .895 2 2v5c0 1.105-.895 2-2 2H3.303c-.198 0-.39.058-.555.168z" transform="translate(-494 -856) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 598) translate(30) translate(10 10)"/>
                                        </g></g></g></g></g></g></g></g></g></g>
                                    </g>
                                </svg>
                                Последние комментарии
                                <span class="tune_li">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                        <g fill="none" fill-rule="evenodd">
                                            <g fill="#495056" fill-rule="nonzero"><g><g><g><g><g><g><g><g><g>
                                                <path fill-opacity=".3" d="M15.795 9.923l-1.436-.794c.145-.748.145-1.516 0-2.264l1.436-.794c.164-.091.24-.278.185-.452-.37-1.135-1-2.177-1.843-3.051-.128-.133-.335-.164-.499-.074l-1.435.793c-.603-.497-1.298-.88-2.049-1.132V.57c0-.18-.13-.338-.315-.377-1.212-.259-2.468-.259-3.68 0-.184.039-.316.196-.316.377v1.587c-.75.255-1.443.64-2.049 1.132L2.36 2.497c-.163-.092-.371-.06-.498.074C1.018 3.444.388 4.487.018 5.623c-.056.173.02.361.186.451l1.435.794c-.145.748-.145 1.516 0 2.264l-1.435.794c-.164.09-.241.278-.186.451.371 1.136 1 2.178 1.844 3.052.127.133.334.164.498.074l1.436-.793c.603.497 1.298.88 2.048 1.132v1.587c0 .181.132.338.317.377 1.212.259 2.468.259 3.68 0 .185-.039.316-.196.316-.377v-1.587c.75-.256 1.444-.64 2.05-1.132l1.435.793c.163.091.371.06.498-.074.844-.873 1.474-1.916 1.843-3.052.054-.175-.024-.362-.188-.454zM8 11c-1.657 0-3-1.343-3-3s1.343-3 3-3 3 1.343 3 3c0 .796-.316 1.559-.879 2.121-.562.563-1.325.88-2.121.879z" transform="translate(-751 -304) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 46) translate(30) translate(267 10)"/>
                                                <path d="M8 10c-1.105 0-2-.895-2-2s.895-2 2-2 2 .895 2 2-.895 2-2 2z" transform="translate(-751 -304) translate(430 60) translate(0 40) translate(20 71) translate(4 56) translate(0 21) translate(0 46) translate(30) translate(267 10)"/>
                                            </g></g></g></g></g></g></g></g></g></g>
                                        </g>
                                    </svg>
                                </span>
                                <span class="status">
                                    <input id="14" type="checkbox" checked>
                                    <label for="14"></label>
                                </span>
                            </li>
                        </ul>
                    </div>
<!--      если для select не будут использоваться плагины - нужно дописать стили для стрелок      -->
                    <div class="sequence_right">
                        <div class="sequence_row">
                            <span class="w-75">
                                Источник (статья)
                                <select class="elem_overlay select_source" name="" id="">
                                    <option value="" selected>Новинки</option>
                                </select>
                            </span>
                            <span class="w-25">
                                Лимит
                                <input class="elem_overlay" type="number" value="5">
                            </span>
                            <span class="w-25">
                                Высота
                                <input class="elem_overlay" type="text" value="400px">
                            </span>
                        </div>
                        <div class="sequence_row">
                            <span class="w-60">
                                Ширина
                                 <select class="elem_overlay select_width" name="" id="">
                                    <option value="" selected>По ширине страницы (100%)</option>
                                </select>
                            </span>
                            <span class="w-40">
                                Отборажение модуля
                                 <select class="elem_overlay select_slider" name="" id="">
                                    <option value="" selected>Slider</option>
                                    <option value="">Сетка</option>
                                </select>
                            </span>
                        </div>
                        <div class="sequence_row">
                            <span>
                                Для профессионалов
                                <textarea class="elem_overlay" name="" id="" >
array (
  'id' =>
  array (
    'val' => '71',
    'callable' => 'getArticles',
    'label' => 'ARTICLE_NAME',
  ),
)
                                </textarea>
                            </span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="custom_temp-HEADER">4</div>
            <div class="tab-pane fade" id="custom_temp-FOOTER">5</div>
            <div class="tab-pane fade" id="custom_temp-PRODUCT_INFO">6</div>
            <div class="tab-pane fade" id="custom_temp-LISTING">7</div>
            <div class="tab-pane fade" id="custom_temp-addModule">8</div>
        </div>
</div>


</div>



<?php include_once('footer.php');?>
<?php
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
