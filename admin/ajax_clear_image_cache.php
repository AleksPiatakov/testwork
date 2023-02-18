<?php
/**
 * Created by PhpStorm.
 * User: 'Serhii.M'
 * Date: 06.08.2019
 * Time: 13:24
 */



if (!function_exists('rrmdir')) {
    function rrmdir($src) {
        $dir = opendir($src);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                $full = $src . '/' . $file;
                if (is_dir($full)) {
                    rrmdir($full);
                } else {
                    unlink($full);
                }
            }
        }
        closedir($dir);
        rmdir($src);
    }
}
$rootPath=dirname(dirname($_SERVER['SCRIPT_FILENAME']));
if (file_exists($rootPath.'/images/cache')) rrmdir($rootPath.'/images/cache');
die('OK');