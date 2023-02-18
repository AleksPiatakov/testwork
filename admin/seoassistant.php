<?php

require_once(__DIR__ . DIRECTORY_SEPARATOR . 'includes/application_top.php');
switch ($_GET['import_type']) {
    case 'easypopulate':
        $file = __DIR__ . "/easypopulate.php";
        $const = 'EXCEL_IMPORT_MODULE_ENABLED';
        require_once(__DIR__ . DIRECTORY_SEPARATOR . 'includes/languages/' . $language . '/easypopulate.php');
        break;
    case 'prom':
        $file = DIR_FS_EXT . "prom_excel/prom.php";
        $const = 'PROM_EXCEL_MODULE_ENABLED';
        break;
    case 'yml':
        $file = DIR_FS_EXT . "yml_import/yml_import.php";
        $const = 'YML_MODULE_ENABLED';
        break;
    default:
        $file = '';
        $const = '';
}
$filePath = checkModuleIsActiveAndExist($file, $const) ? $file : '';
function checkModuleIsActiveAndExist($file, $const)
{
    return file_exists($file) && defined($const) && constant($const) == 'true';
}

if ($_GET['download'] !== 'activestream') {
    require_once(__DIR__ . DIRECTORY_SEPARATOR . 'html-open.php');
    require_once(__DIR__ . DIRECTORY_SEPARATOR . 'header.php');
    ?>

    <link rel="stylesheet" href="includes/solomono/css/seoassistant.css" type="text/css">

    <div class="seo-assistant-container">
        <div class="flex ai-center jc-between">
            <div class="seo-assistant-header">
                <h1>SEO Assistant</h1>
                <p>This service helps you to get real income: visitors, customer and orders. You can see here statistics of speed, errors, keywords etc.</p>
            </div>

            <div class="seo-assistant_balance-block flex">
                <div class="total-balance">Баланс<br><span>$573.65</span></div>
                <div class="top-up-balance-btn flex ai-center jc-center">Пополнить</div>
            </div>
        </div>

<!--        <div class="seo-assistant-block flex">-->
<!---->
<!--            --><?php
//            //исправлено ошибок
//            $metaTitleDone = 11;
//            $metaTitleAll = 48;
//
//            function LoadlineBackground($done, $all) {
//                return $done/$all * 100;
//            }
//
//            //            расчет точек для построения кривых
//            $viewsPerDays = [4 => 40, 10 => 65, 11 => 40, 12 => 144, 15 => 80, 27 => 160];
//            $conversionPerDays = [6 => 10, 15 => 45, 18 => 2, 24 => 144, 28 => 100, 30 => 30];
//
//            function bildDiagram($arr) {
//                $resArr = [];
//                foreach ($arr as $key => $value) {
//                    $day = 500 / 30 * $key;
//                    $newValue = 180 - $value;
//                    $resArr[$day] = $newValue;
//                }
//                return $resArr;
//            }
//            ?>
<!---->
<!--            <div class="seo-diagrams">-->
<!---->
<!--                <div class="diagrams-tab-title flex jc-center">-->
<!--                    <div id="tab-title-day" class="seo-assistant-bg-dark">День</div>-->
<!--                    <div id="tab-title-month">Месяц</div>-->
<!--                </div>-->
<!---->
<!--                <div class="tab-body day flex">-->
<!--                    <div class="diagrams-svg-wraper">-->
<!--                        <div class="prosmotry-diagram opacity0">-->
<!--                            <svg viewBox="0 0 500 180">-->
<!--                                <polyline fill="none"-->
<!--                                          stroke="#0074d9"-->
<!--                                          stroke-width="3"-->
<!--                                          stroke-linejoin="round"-->
<!--                                          points="-5,180-->
<!--                                  --><?php
//                                          $arr = bildDiagram($viewsPerDays);
//                                          foreach ($arr as $key => $value) {
//                                              echo $key . ',' . $value . ' ';
//                                          } ?><!--"/>-->
<!--                            </svg>-->
<!--                        </div>-->
<!--                        <div class="conversion-diagram opacity0">-->
<!--                            <svg viewBox="0 0 500 180">-->
<!--                                <polyline fill="none"-->
<!--                                          stroke-dasharray="6"-->
<!--                                          stroke="#fd466e"-->
<!--                                          stroke-width="3"-->
<!--                                          stroke-linejoin="round"-->
<!--                                          points="-5,180-->
<!--                                  --><?php
//                                          $arr = bildDiagram($conversionPerDays);
//                                          foreach ($arr as $key => $value) {
//                                              echo $key . ',' . $value . ' ';
//                                          } ?><!--"/>-->
<!--                            </svg>-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="diagrams-items">-->
<!--                        <div class="diagrams-item flex"><div id="prosmotry"></div>Просмотры</div>-->
<!--                        <div class="diagrams-item flex"><div id="conversion"></div>Конверсия «Купить»</div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--            </div>-->
<!---->
<!--            <div class="seo-indicators flex">-->
<!--                <div class="flex fd-column mr10">-->
<!--                    <div class="indicators-title flex jc-center ai-center">Техническое SEO</div>-->
<!--                    <div class="indicators-block gray">-->
<!--                        <div>Ошибки + редиректы</div>-->
<!--                        <div class="indicators-value">19</div>-->
<!--                    </div>-->
<!--                    <div class="indicators-block gray">-->
<!--                        <div>Скорость загрузки</div>-->
<!--                        <div class="indicators-value">87/99</div>-->
<!--                    </div>-->
<!--                    <div class="indicators-block gray">-->
<!--                        <div>Дубликаты</div>-->
<!--                        <div class="indicators-value">185</div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <div class="flex fd-column mr10">-->
<!--                    <div class="indicators-title flex jc-center ai-center">Google Search Console</div>-->
<!--                    <div class="indicators-block green">-->
<!--                        <div>Клики</div>-->
<!--                        <div class="indicators-value">2.5K</div>-->
<!--                    </div>-->
<!--                    <div class="indicators-block green">-->
<!--                        <div>Показы</div>-->
<!--                        <div class="indicators-value">87/99</div>-->
<!--                    </div>-->
<!--                    <div class="indicators-block green">-->
<!--                        <div>CTR</div>-->
<!--                        <div class="indicators-value">+12.9%</div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <div class="flex fd-column mr10">-->
<!--                    <div class="indicators-title flex jc-center ai-center">Google Analytics</div>-->
<!--                    <div class="indicators-block purple">-->
<!--                        <div>Цель 1: «Конверсия»</div>-->
<!--                        <div class="indicators-value">13%</div>-->
<!--                    </div>-->
<!--                    <div class="indicators-block purple">-->
<!--                        <div>Цель 2: «Удержание»</div>-->
<!--                        <div class="indicators-value">55%</div>-->
<!--                    </div>-->
<!--                    <div class="indicators-block purple">-->
<!--                        <div>Показатель отказов</div>-->
<!--                        <div class="indicators-value">76%</div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <div class="flex fd-column mr10">-->
<!--                    <div class="indicators-title flex jc-center ai-center">Ключевые слова</div>-->
<!--                    <div class="indicators-block blue">-->
<!--                        <div>Ключи в ТОП 3</div>-->
<!--                        <div class="indicators-value">19</div>-->
<!--                    </div>-->
<!--                    <div class="indicators-block blue">-->
<!--                        <div>Ключи в ТОП 10</div>-->
<!--                        <div class="indicators-value">80</div>-->
<!--                    </div>-->
<!--                    <div class="indicators-block blue">-->
<!--                        <div>Ключи в ТОП 100</div>-->
<!--                        <div class="indicators-value">671</div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="seo-recommendation">-->
<!--                <div class="recommendation-title">Исправьте дубликаты META Title</div>-->
<!--                <div class="recommendation-loadline red">-->
<!--                </div>-->
<!--                <div class="recommendation-title">Исправьте дубликаты META Description</div>-->
<!--                <div class="recommendation-loadline yellow">-->
<!--                    <div class="done" style="width: 50%"></div>-->
<!--                    <div class="recommendation-value">Исправлено 11/15 ошибок</div>-->
<!--                </div>-->
<!--                <div class="recommendation-title">Исправьте дубликаты H1</div>-->
<!--                <div class="recommendation-loadline yellow">-->
<!--                    <div class="done" style="width: 50%"></div>-->
<!--                    <div class="recommendation-value">Исправлено 64/96 ошибок</div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

        <div class="filters-search-block flex">
            <div class="plus">+</div>
            <div class="all">Все</div>
            <div class="category">Категории</div>
            <div class="filters">Фильтры</div>
            <div class="goods">Товары</div>
            <div class="manufacturers">Производители</div>
            <div class="pages">Страницы</div>
            <div class="filter-keys">Ключи</div>
            <input class="seo-search">
            <div class="seo-search-btn">Поиск</div>
        </div>
        <table class="seo-assistant-table">
            <thead>
            <tr>
                <th class="pencil text-center"></th>
                <th class="check-b text-center">#</th>
                <th class="page-link pl10">Ссылка
                    <div class="sort-arrows">
                        <div class='icon-up'></div>
                        <div class='icon-down'></div>
                    </div>
                </th>
                <th class="status text-center">Статус</th>
                <th class="heading pl10">H1
                    <div class="sort-arrows">
                        <div class='icon-up'></div>
                        <div class='icon-down'></div>
                    </div>
                </th>
                <th class="meta-t pl10">Meta Title
                    <div class="sort-arrows">
                        <div class='icon-up'></div>
                        <div class='icon-down'></div>
                    </div>
                </th>
                <th class="google-ps pl5">Google PS
                    <div class="sort-arrows">
                        <div class='icon-up'></div>
                        <div class='icon-down'></div>
                    </div>
                </th>
                <th class="meta-des pl10">Meta Description
                    <div class="sort-arrows">
                        <div class='icon-up'></div>
                        <div class='icon-down'></div>
                    </div>
                </th>
                <th class="seo-text pl5">SEO Текст
                    <div class="sort-arrows">
                        <div class='icon-up'></div>
                        <div class='icon-down'></div>
                    </div>
                </th>
                <th class="keys pl5">Ключей
                    <div class="sort-arrows">
                        <div class='icon-up'></div>
                        <div class='icon-down'></div>
                    </div>
                </th>
                <th class="top-key-frequency flex jc-between ai-center">
                    <div class="top-key">Топ ключ</div>
                    <div class="frequency">Частотность</div>
                </th>
                <th class="position-changes pl5">Position
                    <div class="sort-arrows">
                        <div class='icon-up'></div>
                        <div class='icon-down'></div>
                    </div>
                </th>
                <th class="ur pl5">UR
                    <div class="sort-arrows">
                        <div class='icon-up'></div>
                        <div class='icon-down'></div>
                    </div>
                </th>
                <th class="views pl5">Просмотры
                    <div class="sort-arrows">
                        <div class='icon-up'></div>
                        <div class='icon-down'></div>
                    </div>
                </th>
                <th class="conversion pl5">Конверсия Купить
                    <div class="sort-arrows">
                        <div class='icon-up'></div>
                        <div class='icon-down'></div>
                    </div>
                </th>
                <th class="incoming-links text-center">Входные ссылки
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="pencil text-center">
                    <svg viewBox="0 0 512 512">
                        <path fill="gray"
                              d="M497.9 142.1l-46.1 46.1c-4.7 4.7-12.3 4.7-17 0l-111-111c-4.7-4.7-4.7-12.3 0-17l46.1-46.1c18.7-18.7 49.1-18.7 67.9 0l60.1 60.1c18.8 18.7 18.8 49.1 0 67.9zM284.2 99.8L21.6 362.4.4 483.9c-2.9 16.4 11.4 30.6 27.8 27.8l121.5-21.3 262.6-262.6c4.7-4.7 4.7-12.3 0-17l-111-111c-4.8-4.7-12.4-4.7-17.1 0zM124.1 339.9c-5.5-5.5-5.5-14.3 0-19.8l154-154c5.5-5.5 14.3-5.5 19.8 0s5.5 14.3 0 19.8l-154 154c-5.5 5.5-14.3 5.5-19.8 0zM88 424h48v36.3l-64.5 11.3-31.1-31.1L51.7 376H88v48z"></path>
                    </svg>
                </td>
                <td class="check-b text-center">#</td>
                <td class="page-link pl10">
                    <div class="hide-text"><a href="#">/a-kak-v-akkaunte-instagram-sdelat-navigaciju-po-tovaram-a-412.html</a></div>
                </td>
                <td class="status text-center">404 ERR</td>
                <td class="heading pl10">
                    <div class="hide-text">
                        Как в аккаунте Инстаграм сделать навигацию по товарам
                    </div>
                </td>
                <td class="meta-t pl10">
                    <div class="hide-text">Как сделать меню в SoloMono</div>
                </td>
                <td class="google-ps flex ai-center jc-center">
                    <span class="google-red flex ai-center jc-center">12</span>
                    <span class="google-green flex ai-center jc-center">99</span>
                </td>
                <td class="meta-des pl10">
                    <div class="hide-text">
                        Creating an online store on the
                    </div>
                </td>
                <td class="seo-text text-center">537</td>
                <td class="keys text-center">7</td>
                <td class="top-key-frequency flex jc-between ai-center">
                    <div>Phoenix osCommerce</div>
                    <div>15.3К</div>
                </td>
                <td class="position-changes text-center">28 |2</td>
                <td class="ur text-center">78</td>
                <td class="views text-center">716</td>
                <td class="conversion text-center">137</td>
                <td class="incoming-links text-center">235</td>
            </tr>

            <tr>
                <td class="pencil text-center">
                    <svg viewBox="0 0 512 512">
                        <path fill="gray"
                              d="M497.9 142.1l-46.1 46.1c-4.7 4.7-12.3 4.7-17 0l-111-111c-4.7-4.7-4.7-12.3 0-17l46.1-46.1c18.7-18.7 49.1-18.7 67.9 0l60.1 60.1c18.8 18.7 18.8 49.1 0 67.9zM284.2 99.8L21.6 362.4.4 483.9c-2.9 16.4 11.4 30.6 27.8 27.8l121.5-21.3 262.6-262.6c4.7-4.7 4.7-12.3 0-17l-111-111c-4.8-4.7-12.4-4.7-17.1 0zM124.1 339.9c-5.5-5.5-5.5-14.3 0-19.8l154-154c5.5-5.5 14.3-5.5 19.8 0s5.5 14.3 0 19.8l-154 154c-5.5 5.5-14.3 5.5-19.8 0zM88 424h48v36.3l-64.5 11.3-31.1-31.1L51.7 376H88v48z"></path>
                    </svg>
                </td>
                <td class="check-b text-center">#</td>
                <td class="page-link pl10">
                    <div class="hide-text"><a href="#">/kak-v-akkaunte-instagram-sdelat-navigaciju-po-tovaram-a-412.html</a></div>
                </td>
                <td class="status text-center">OK</td>
                <td class="heading pl10">
                    <div class="hide-text">
                        A Как в аккаунте Инстаграм сделать навигацию по товарам
                    </div>
                </td>
                <td class="meta-t pl10">
                    <div class="hide-text">A Как сделать меню в SoloMono</div>
                </td>
                <td class="google-ps flex ai-center jc-center">
                    <span class="google-red flex ai-center jc-center">12</span>
                    <span class="google-green flex ai-center jc-center">99</span>
                </td>
                <td class="meta-des pl10">
                    <div class="hide-text">
                        Creating an online store on the
                    </div>
                </td>
                <td class="seo-text text-center">537</td>
                <td class="keys text-center">7</td>
                <td class="top-key-frequency flex jc-between ai-center">
                    <div>Phoenix osCommerce</div>
                    <div>15.3К</div>
                </td>
                <td class="position-changes text-center">28 |2</td>
                <td class="ur text-center">178</td>
                <td class="views text-center">316</td>
                <td class="conversion text-center">637</td>
                <td class="incoming-links text-center">235</td>
            </tr>
            </tbody>
        </table>
    </div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const getSort = ({ target }) => {
            const order = (target.dataset.order = -(target.dataset.order || -1));
            const index = [...target.parentNode.cells].indexOf(target);
            const collator = new Intl.Collator(['en', 'ru'], { numeric: true });
            const comparator = (index, order) => (a, b) => order * collator.compare(
                a.children[index].innerHTML,
                b.children[index].innerHTML
            );

            for(const tBody of target.closest('table').tBodies)
                tBody.append(...[...tBody.rows].sort(comparator(index, order)));

            for(const cell of target.parentNode.cells)
                cell.classList.toggle('sorted', cell === target);
        };
        document.querySelectorAll('.seo-assistant-table thead').forEach(tableTH => tableTH.addEventListener('click', () => getSort(event)));
    });

    $('.filters-search-block>div').on('click', function () {
        $(this).siblings().removeClass('seo-assistant-bg-dark');
        $(this).addClass('seo-assistant-bg-dark');
    })

    $('.diagrams-tab-title>div').on('click', function () {
        $(this).siblings().removeClass('seo-assistant-bg-dark');
        $(this).addClass('seo-assistant-bg-dark');
    })

    $('#prosmotry').on('click', function () {
        $(this).toggleClass('active');
        $('.prosmotry-diagram').toggleClass('opacity0');
    })

    $('#conversion').on('click', function () {
        $(this).toggleClass('active');
        $('.conversion-diagram').toggleClass('opacity0');
    })

</script>

<?php }
if ($filePath) {
    require_once($filePath);
}
require_once('footer.php');
require_once('html-close.php');
require_once(DIR_WS_INCLUDES . 'application_bottom.php');




