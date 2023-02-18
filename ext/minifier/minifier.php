<?php

/**
 * Created by PhpStorm.
 * User: 'Serhii.M'
 * Date: 06.02.2019
 * Time: 16:01
 */

//minifier
require_once DIR_WS_CLASSES . '/minify/src/Minify.php';
require_once DIR_WS_CLASSES . '/minify/src/CSS.php';
require_once DIR_WS_CLASSES . '/minify/src/JS.php';
require_once DIR_WS_CLASSES . '/minify/src/Exception.php';
require_once DIR_WS_CLASSES . '/minify/src/Exceptions/BasicException.php';
require_once DIR_WS_CLASSES . '/minify/src/Exceptions/FileImportException.php';
require_once DIR_WS_CLASSES . '/minify/src/Exceptions/IOException.php';
require_once DIR_WS_CLASSES . '/minify/path-converter/ConverterInterface.php';
require_once DIR_WS_CLASSES . '/minify/path-converter/Converter.php';

use MatthiasMullie\Minify;
$minifierCSS = new Minify\CSS();
$minifierJS = new Minify\JS();
