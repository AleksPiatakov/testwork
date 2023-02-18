<?php

/**
 * Created by PhpStorm.
 * User: 'Serhii.M'
 * Date: 02.04.2019
 * Time: 13:21
 */

if (!function_exists('runkit_constant_remove')) {
    die('need runkit support');
}
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('max_execution_time', '0');
require('Yandex_Translate.php');
function getDirContents($path)
{

    $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));

    $files = array();
    foreach ($rii as $file) {
        if (!$file->isDir() && $file->getExtension() === 'php') {
            $folder_name = $file->getPath();
            $folder_name = str_replace('russian', 'srpski', $folder_name);
            $files[$folder_name][] = ['fullpath' => $file->getPathname(), 'file' => $file->getFilename()];
        }
    }

    return $files;
}

function tep_session_save_path()
{
    return 'tep_session_save_path()';
}

function tep_href_link($a, $b, $c)
{
    return "tep_href_link($a,$b,$c)";
}

$root_path = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
$path = $root_path . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'languages' . DIRECTORY_SEPARATOR . '';
//$path = $root_path . DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'languages'.DIRECTORY_SEPARATOR;
//$path = $root_path . DIRECTORY_SEPARATOR.'landing_lang'.DIRECTORY_SEPARATOR;
//$path = $root_path . DIRECTORY_SEPARATOR.'ext'.DIRECTORY_SEPARATOR.'create_language'.DIRECTORY_SEPARATOR;
//$fileArray = getDirContents($path.'russian');


//foreach ($fileArray as $folder_name => $files){
//    foreach ($files as $file){
//        makeTranslate($folder_name,$file);
//        echo $file['fullpath'].PHP_EOL;
//        file_put_contents('1.txt', $file['fullpath'].PHP_EOL,FILE_APPEND);
//    }
//}

makeTranslate($path, ['fullpath' => $path . 'add_ccgvdc_russian.php', 'file' => 'add_ccgvdc_srpski.php']);
makeTranslate($path, ['fullpath' => $path . 'russian.php', 'file' => 'srpski.php']);
//makeTranslate($path,['fullpath'=>$path.'russian_db_error.php','file'=>'srpski_db_error.php']);
makeTranslate($path, ['fullpath' => $path . 'order_edit_russian.php', 'file' => 'order_edit_srpski.php']);
//makeTranslate('C:/OSPanel/domains/solomono.loc\ext\create_language',['fullpath'=>'C:/OSPanel/domains/solomono.loc\ext\create_language\1.php','file'=>'1.php']);
function makeTranslate($folder_name, $file)
{
    $translator = new Yandex_Translate();

    $definedConst = get_defined_constants(true)['user'] ?: [];
    require_once($file['fullpath']);
    $newDefinedConst = get_defined_constants(true)['user'];
    $intersect = array_diff($newDefinedConst, $definedConst);
    $filepath = $folder_name . DIRECTORY_SEPARATOR . $file['file'];
    if (!file_exists($folder_name)) {
        if (strstr(strtolower(PHP_OS), 'win')) {
            mkdir($folder_name, 775, true);
        } else {
            system("mkdir -m 775 -p " . $folder_name);
        }
    }
    $new_file = '<?php ' . PHP_EOL;
    file_put_contents($filepath, $new_file);
    foreach ($intersect as $const => $size) {
        runkit_constant_remove($const);
        $translatedItem = $translator->yandexTranslate('ru', 'sr', $size);
        $result = json_decode($translatedItem, true);
        $new_file = "define('$const','" . addslashes(html_entity_decode($result['text'][0])) . "');" . PHP_EOL;
        file_put_contents($filepath, $new_file, FILE_APPEND);
    }
}

die;
