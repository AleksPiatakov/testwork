<?php
require_once('includes/application_top.php');
require_once(__DIR__ . DIRECTORY_SEPARATOR . 'includes/languages/' . $language . '/new_importexport.php');

if ($_GET['download'] == '') {
    include_once('html-open.php');
    include_once('header.php');
}
if($_GET['import_type']){
    $all_products = tep_get_all_products();
}
switch ($_GET['import_type']) {
    case 'easypopulate':
        $languages = tep_get_languages_formatted();
        if (isset($_REQUEST["epcust_language"])) {
            $codeLanguage = tep_db_prepare_input($_REQUEST["epcust_language"]);
            $languages_id = tep_get_languages_id($codeLanguage);
            $language = $languages[$languages_id]['directory'];
            $languages_code = $languages[$languages_id]['code'];
        }
        $file = __DIR__ . "/easypopulate.php";
        $const = 'EXCEL_IMPORT_MODULE_ENABLED';
        require_once(__DIR__ . DIRECTORY_SEPARATOR . 'includes/languages/' . $language . '/easypopulate.php');
        break;
    case 'prom':
        $file = DIR_FS_EXT . "prom_excel/prom.php";
        $const = 'PROM_EXCEL_MODULE_ENABLED';
        require_once(__DIR__ . DIRECTORY_SEPARATOR . 'includes/languages/' . $language . '/modules/prom_excel/prom_excel.php');
        break;
    case 'yml':
        $file = DIR_FS_EXT . "yml_import/yml_import.php";
        $const = 'YML_MODULE_ENABLED';
        require_once(__DIR__ . DIRECTORY_SEPARATOR . 'includes/languages/' . $language . '/modules/yml_import/yml_import.php');
        break;
    case 'osc_import':
        $file = DIR_FS_EXT . "osc_import/osc_import.php";
        $const = 'OSC_IMPORT_MODULE_ENABLED';
        require_once(__DIR__ . DIRECTORY_SEPARATOR . 'includes/languages/' . $language . '/modules/osc_import/osc_import.php');
        break;
    default:
        $file = '';
        $const = '';
}

switch ($_GET['export_type']) {
    case 'google_feed':
        $const = 'GOOGLE_FEED_MODULE_ENABLED';
        break;
    case 'rozetka':
        $const = 'EXPORT_ROZETKA_MODULE_ENABLED';
        break;
    case 'hotline':
        $const = 'EXPORT_HOTLINE_MODULE_ENABLED';
        break;
    case 'prom':
        $const = 'EXPORT_PROMUA_MODULE_ENABLED';
        break;
    case 'facebook':
        $const = 'EXPORT_FACEBOOK_FEED_MODULE_ENABLED';
        break;
    case 'xml':
        $const = 'EXPORT_PRICEUA_MODULE_ENABLED';
        break;
    case 'pdf':
        $const = 'EXPORT_PDF_MODULE_ENABLED';
        break;
    case 'yandex':
        $const = 'YANDEX_MARKET_MODULE_ENABLED';
        break;
}

$filePath = checkModuleIsActiveAndExist($file, $const) ? $file : '';

function checkModuleIsActiveAndExist($file, $const)
{
    return file_exists($file) && defined($const) && constant($const) == 'true';
}

$import_class = "active";
$import_selected = "true";
$export_class = "";
$export_selected = "false";

if (isset($_GET['action_type']) && $_GET['action_type'] == 'export') {
    $import_class = "";
    $import_selected = "false";
    $export_class = "active";
    $export_selected = "true";
}

if ($_GET['download'] == 'activestream') {
    if ($filePath && $export_class) require_once($filePath);
}

$import_modules = [
    'exel' => [
        'file' => __DIR__ . '/' . FILENAME_EASYPOPULATE,
        'file_name' => FILENAME_EASYPOPULATE,
        'const' => 'EXCEL_IMPORT_MODULE_ENABLED',
        'image' => 'importexport/excel.png',
        'title' => 'Excel (CSV)',
        'comment' => '',
    ],
    'prom' => [
        'file' => DIR_FS_EXT . "prom_excel/prom.php",
        'file_name' => FILENAME_PROM,
        'const' => 'PROM_EXCEL_MODULE_ENABLED',
        'image' => 'importexport/prom.png',
        'title' => 'Prom.ua',
        'comment' => 'Excel',
    ],
    'yml' => [
        'file' => DIR_FS_EXT . "yml_import/yml_import.php",
        'file_name' => FILENAME_YML,
        'const' => 'YML_MODULE_ENABLED',
        'image' => 'importexport/code.png',
        'title' => 'XML (YML)',
        'comment' => '',
    ],
    'osc' => [
        'file' => DIR_FS_EXT . "osc_import/osc_import.php",
        'file_name' => FILENAME_OSC,
        'const' => 'OSC_IMPORT_MODULE_ENABLED',
        'image' => 'importexport/osc.png',
        'title' => 'osCommerce',
        'comment' => 'v2.2+',
    ],
    '1C' => [
        'file' => '',
        'const' => ' ',
        'image' => 'importexport/1c.png',
        'title' => '1С',
        'comment' => 'Bitrix',
    ],
    'amazon' => [
        'file' => '',
        'const' => ' ',
        'image' => 'importexport/amazon.png',
        'title' => 'Amazon',
        'comment' => IMPORTEXPORT_UNDER_ORDER,
    ],
    'ali_express' => [
        'file' => '',
        'const' => ' ',
        'image' => 'importexport/ali.png',
        'title' => 'AliExpress',
        'comment' => IMPORTEXPORT_UNDER_ORDER,
    ],
];

$export_modules = [
    'excel' => [
        'file' => __DIR__ . "/easypopulate.php",
        'link' => FILENAME_NEW_IMPORT_EXPORT . '?import_type=' . basename(FILENAME_EASYPOPULATE, '.php') . '&action_type=export',
        'const' => 'EXCEL_IMPORT_MODULE_ENABLED',
        'image' => 'importexport/excel.png',
        'title' => 'Excel',
        'comment' => 'CSV',
    ],
    'discover' => [
        'file' => DIR_FS_EXT . "google_feed/google_feed.php",
        'link' => FILENAME_NEW_IMPORT_EXPORT . '?export_type=google_feed' . '&action_type=export',
        'const' => 'GOOGLE_FEED_MODULE_ENABLED',
        'image' => 'importexport/discover.png',
        'title' => 'Google Feed',
        'comment' => 'XML',
        'xml' => HTTP_SERVER . '/' . DIR_WS_INCLUDES . 'xml/google.xml'
    ],
    'rozetka' => [
        'file' => DIR_FS_EXT . "export_rozetka/rozetka.php",
        'link' => FILENAME_NEW_IMPORT_EXPORT . '?export_type=rozetka' . '&action_type=export',
        'const' => 'EXPORT_ROZETKA_MODULE_ENABLED',
        'image' => 'importexport/rozetka.png',
        'title' => 'Rozetka',
        'comment' => 'XML',
        'xml' => HTTP_SERVER . '/' . DIR_WS_INCLUDES . 'xml/rozetka.xml'
    ],
    'hotline' => [
        'file' => DIR_FS_EXT . "export_hotline/hotline.php",
        'link' => FILENAME_NEW_IMPORT_EXPORT . '?export_type=hotline' . '&action_type=export',
        'const' => 'EXPORT_HOTLINE_MODULE_ENABLED',
        'image' => 'importexport/hotline.png',
        'title' => 'Hotline.ua',
        'comment' => 'XML',
        'xml' => HTTP_SERVER . '/' . DIR_WS_INCLUDES . 'xml/hotline.xml'
    ],
    'prom' => [
        'file' => DIR_FS_EXT . "export_promua/promua.php",
        'link' => FILENAME_NEW_IMPORT_EXPORT . '?export_type=prom' . '&action_type=export',
        'const' => 'EXPORT_PROMUA_MODULE_ENABLED',
        'image' => 'importexport/prom.png',
        'title' => 'Prom.ua',
        'comment' => 'XML',
        'xml' => HTTP_SERVER . '/' . DIR_WS_INCLUDES . 'xml/promua.xml'
    ],
    '1C' => [
        'file' => '',
        'const' => ' ',
        'image' => 'importexport/1c.png',
        'title' => '1С',
        'comment' => 'Bitrix',
    ],
    'facebook' => [
        'file' => DIR_FS_EXT . "export_facebook_feed/facebook_feed.php",
        'link' => FILENAME_NEW_IMPORT_EXPORT . '?export_type=facebook' . '&action_type=export',
        'const' => 'EXPORT_FACEBOOK_FEED_MODULE_ENABLED',
        'image' => 'importexport/facebook.png',
        'title' => 'Facebook Feed',
        'comment' => 'XML',
        'xml' => HTTP_SERVER . '/' . DIR_WS_INCLUDES . 'xml/facebook.xml'
    ],
    'api' => [
        'file' => '',
        'const' => ' ',
        'image' => 'importexport/api.png',
        'title' => 'API',
        'comment' => '',
    ],
    'xml' => [
        'file' => '../' . DIR_WS_INCLUDES . 'xml/priceua.php',
        'link' => FILENAME_NEW_IMPORT_EXPORT . '?export_type=xml' . '&action_type=export',
        'const' => 'EXPORT_PRICEUA_MODULE_ENABLED',
        'image' => 'importexport/code.png',
        'title' => 'Price.ua',
        'comment' => 'XML',
        'xml' => HTTP_SERVER . '/' . DIR_WS_INCLUDES . 'xml/priceua.xml'
    ],
    'pdf' => [
        'file' =>  DIR_FS_EXT . "pdf_export/pdf.php",
        'link' => FILENAME_NEW_IMPORT_EXPORT . '?export_type=pdf' . '&action_type=export',
        'const' => 'EXPORT_PDF_MODULE_ENABLED',
        'image' => 'importexport/pdf.png',
        'title' => 'PDF',
        'comment' => '',
        'xml' => tep_href_link('all/c-0.html', 'pdf=true&row_by_page=all'),
    ],
    'yandex' => [
        'file' => DIR_FS_EXT . "yandex_market/yandex_market.php",
        'link' => FILENAME_NEW_IMPORT_EXPORT . '?export_type=yandex' . '&action_type=export',
        'const' => 'YANDEX_MARKET_MODULE_ENABLED',
        'image' => 'importexport/yandex.png',
        'title' => 'Yandex Market',
        'comment' => 'XML',
        'xml' => HTTP_SERVER . '/' . DIR_WS_INCLUDES . 'xml/market.xml'
    ],
];

?>

<!--если для селектов не будет использоваться плагин, добавить для них слрелки -->
<div class="container">
    <div class="importexport">
        <div class="importexport_header">
            <ul class="nav-tabs">
                <li class="<?php echo $import_class; ?>">
                    <a aria-expanded="<?php echo $import_selected; ?>" href="<?=tep_href_link('new_importexport.php', 'action_type=import')?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                            <g fill="#41484E">
                                <path d="M9 5.3c0-.166-.134-.3-.3-.3H7.3c-.166 0-.3.134-.3.3V10H2v-.024c-1.13-.161-2-1.134-2-2.31 0-.992.62-1.84 1.494-2.177-.018-.116-.027-.235-.027-.356C1.467 3.845 2.51 2.8 3.8 2.8c.234 0 .46.034.672.098C5.02 1.216 6.602 0 8.467 0c1.833 0 3.391 1.174 3.965 2.811 1.119.11 2.005 1.011 2.094 2.137C15.4 5.385 16 6.289 16 7.333 16 8.806 14.806 10 13.333 10H9zM9.3 12h1.976c.165 0 .3.134.3.3 0 .08-.032.156-.088.212l-3.276 3.276c-.117.117-.307.117-.424 0l-3.276-3.276c-.117-.117-.117-.307 0-.424.056-.056.133-.088.212-.088H6.7c.166 0 .3-.134.3-.3V10h2v1.7c0 .166.134.3.3.3z"/>
                            </g>
                        </svg>
                        <?=IMPORTEXPORT_TAB_IMPORT; ?>
                    </a>
                </li>
                <li class="<?php echo $export_class; ?>">
                    <a aria-expanded="<?php echo $export_selected; ?>" href="<?=tep_href_link('new_importexport.php', 'action_type=export')?>">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 20 20">
                            <defs>
                                <path id="n6xzr199za" d="M14 2v6.786c-.001.372-.273.697-.662.788l-5.68 1.278c-.433.097-.883.097-1.316 0L.663 9.574C.273 9.484 0 9.159 0 8.786V1.999L1 0l6 1 6-1 1 2z"/>
                            </defs>
                            <g fill="none" fill-rule="evenodd">
                                <g>
                                    <g>
                                        <g>
                                            <g>
                                                <g>
                                                    <g>
                                                        <g transform="translate(-567 -127) translate(430 100) translate(0 20) translate(129) translate(10 7) translate(1 9)">
                                                            <mask id="an59or80mb" fill="#fff">
                                                                <use xlink:href="#n6xzr199za"/>
                                                            </mask>
                                                            <use fill="#C8CACC" fill-rule="nonzero" xlink:href="#n6xzr199za"/>
                                                            <path fill="#A1A4A7" fill-rule="nonzero" d="M14 2.999L14 9.997 7 11 7 1z" mask="url(#an59or80mb)"/>
                                                        </g>
                                                        <path fill="#A1A4A7" fill-rule="nonzero" d="M9.3 4h1.976c.165 0 .3.134.3.3 0 .08-.032.156-.088.212L8.212 7.788c-.117.117-.307.117-.424 0L4.512 4.512c-.117-.117-.117-.307 0-.424.056-.056.133-.088.212-.088H6.7c.166 0 .3-.134.3-.3V.3c0-.166.134-.3.3-.3h1.4c.166 0 .3.134.3.3v3.4c0 .166.134.3.3.3z" transform="translate(-567 -127) translate(430 100) translate(0 20) translate(129) translate(10 7) matrix(1 0 0 -1 0 8)"/>
                                                        <path fill="#41484E" fill-rule="nonzero" d="M13.809 9.032L8 10l1.612 3.224c.223.445.739.66 1.21.502l4.805-1.602c.158-.052.243-.222.19-.38-.008-.025-.02-.049-.035-.07L14.108 9.16c-.066-.098-.183-.149-.3-.13zM.373 12.124l4.804 1.602c.472.157.988-.057 1.21-.502L8 10l-5.809-.968c-.116-.02-.233.031-.299.13L.218 11.672c-.092.138-.055.324.083.416.022.015.046.027.072.035z" transform="translate(-567 -127) translate(430 100) translate(0 20) translate(129) translate(10 7)"/>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        <?=IMPORTEXPORT_TAB_EXPORT; ?>
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab-content">
            <div class="tab-pane fade <?php echo $import_class; ?> in" id="import_tab">
                <div class="platforms_block">
                    <?php foreach($import_modules as $module):?>
                        <?php if ($module['const'] == $const) :?>
                            <a class="item back-link" href="<?=FILENAME_NEW_IMPORT_EXPORT?>">
                                <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                                <?=IMAGE_BACK?>
                            </a>
                        <?php endif; ?>
                        <a class="item <?=$module['const'] === $const ? 'selected' : '' ?> <?=$const !== '' ? 'hide' : '' ?>"
                            <?php echo checkModuleIsActiveAndExist($module['file'], $module['const'])
                            ?'href="' . FILENAME_NEW_IMPORT_EXPORT . '?import_type=' . basename($module['file_name'], '.php') . '&action_type=import' . '"'
                            :'style="opacity:0.5" href="mailto:admin@solomono.net"'; ?>>
                            <img src="images/<?php echo $module['image'] ?>" alt="<?php echo $module['title'] ?>">
                            <div class="text">
                                <div class="title"><?php echo $module['title'] ?></div>
                                <?php echo $module['comment'] ?>
                            </div>
                        </a>
                    <?php endforeach; ?>
                    <?php if ($const == '') :?>
                        <a class="item" href="mailto:admin@solomono.net">
                            <img src="images/importexport/excel.png">
                            <div class="text">
                                <div class="title"><?=IMPORTEXPORT_ORDER_OWN_VARIANT?></div>
                            </div>
                        </a>
                    <?php endif; ?>
	                <a class="item back-link button_instructions" href="https://solomono.net/ru/excel-import-eksport-a-180.html">
		                <span><?=GO_INSTRUCTIONS?></span>
	                </a>
                </div>
                <?php if ($filePath && $import_class) require_once($filePath); ?>
            </div>

            <div class="tab-pane fade <?php echo $export_class; ?> in" id="export_tab">
                <div class="platforms_block">
                    <?php foreach($export_modules as $module): ?>
                        <?php if ($module['const'] == $const) :?>
                            <a class="item back-link" href="<?=FILENAME_NEW_IMPORT_EXPORT?>?action_type=export">
                                <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                                <?=IMAGE_BACK?>
                            </a>
                        <?php endif; ?>
                        <a class="item<?= $module['const'] == $const ? ' selected' : '' ?><?=$const !== '' ? ' hide' : '' ?><?=$module['xml'] ? ' xml' : ''?>"
                            <?php echo checkModuleIsActiveAndExist($module['file'], $module['const'])
                            ?'href="' . $module['link'] . '"'
                            :'style="opacity:0.5" href="mailto:admin@solomono.net"'; ?>
                            <?=$module['xml'] ? " data-xml={$module['xml']}" : ''?>>
                            <img src="images/<?php echo $module['image'] ?>">
                            <div class="text">
                                <div class="title"><?php echo $module['title'] ?></div>
                                <?php echo $module['comment'] ?>
                            </div>
                        </a>
                    <?php endforeach; ?>
                    <?php if ($const == '') :?>
                        <a class="item" href="mailto:admin@solomono.net">
                            <img src="images/importexport/excel.png">
                            <div class="text">
                                <div class="title"><?=IMPORTEXPORT_ORDER_OWN_VARIANT?></div>
                            </div>
                        </a>
                        <p class="info_text"><?=IMPORTEXPORT_IF_INTERESTED; ?>, <a href="mailto:admin@solomono.net"><?=IMPORTEXPORT_CONTACT_US; ?></a>.</p>
                    <?php endif; ?>
                </div>
                <?php if(in_array($_GET['export_type'], ['google_feed', 'prom', 'rozetka', 'hotline', 'facebook', 'xml', 'yandex'])){ ?>
                <div class="main_settings_block">
                    <?php
                    $configuration_query = tep_db_query("SELECT configuration_id, configuration_value, configuration_key FROM " . TABLE_CONFIGURATION . " WHERE configuration_key IN ('GOOGLE_FEED_CHOOSE_ALL_PRODUCTS', 'GOOGLE_FEED_CHOOSE_PRODUCTS_2', 'GOOGLE_FEED_CHOOSE_PRODUCTS_3')");
                    $configuration = [];
                    if($configuration_query->num_rows){
                        while($row = tep_db_fetch_array($configuration_query)){
                            $configuration[$row['configuration_key']] = $row;
                        }
                    }
                    echo '<table id="google_feed_settings" class="dataTableRowSelected">';
                    foreach ($configuration as $key => $value){
                        $checked = htmlspecialchars($value['configuration_value']) == 'true'?true:false;
                        echo '<tr><td><label for="'.$value['configuration_key'].'_key" style="margin: 0;">'.(getConstantValue($value['configuration_key'].'_TITLE',$value['configuration_key'])).'</label></td>
                              <td><label class="i-switch bg-info m-t-xs m-r" style="margin: 0 10px;">
                                <input
                                    id="'.$value['configuration_key'].'_key"
                                    type="checkbox"
                                    class="switchValue"
                                    '. ($checked?'checked=""':'') .' data-href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=' . $_GET['gID'] . '&cID=' . $value['configuration_id'] . '&action=setflag&flag='.($checked?'0':'1') ) . '"><i></i>
                                </label></td></tr>';
                    }
                    echo '</table>';?>
                </div>
                <?php } ?>
                <?php if ($filePath && $export_class) require_once($filePath); ?>
            </div>
        </div>
    </div>
</div>

<?php if (isset($_GET['export_type'])) : ?>
    <script>
        $(document).ready(function () {
            var xml = $('.selected.xml');
            if (xml.length > 0) {
                var url = xml.data('xml');
                var html = "" +
                    "<div class='xml-element'>" +
                        "<p class='xml-element-name'><?=XML_ELEMENT_NAME?>:</p>" +
                        "<a id='copy-xml' href='" + url + "'>" + url + "</a>" +
                        "<button class='btn button-small const-btn green_btn' onclick=\"copyxml('#copy-xml')\"><?=COPY_BUTTON?></button>" +
                    "</div>";
                $( '[id="export_tab"]' ).append(html);
            }
        });
        
        function copyxml(el) {
            var $tmp = $("<textarea>");
            $("body").append($tmp);
            $tmp.val($(el).text()).select();
            document.execCommand("copy");
            $tmp.remove();
            show_tooltip("<?=COPY_TEXT?>", 1000);
        }
    </script>
<?php endif;

include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
