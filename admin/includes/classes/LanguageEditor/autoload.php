<?php

spl_autoload_register(function ($className) {
    $classNamePrefix = "SoloMono\\LanguageEditor";
    if(strpos($className, $classNamePrefix) === 0) {
        $prefixLength = strlen($classNamePrefix);
        $className = substr($className, $prefixLength + 1);
        $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
        $fileName =
            __DIR__ .
            DIRECTORY_SEPARATOR .
            "src" .
            DIRECTORY_SEPARATOR .
            $className .
            ".php";
        if(is_file($fileName)) require_once $fileName;
    }
});