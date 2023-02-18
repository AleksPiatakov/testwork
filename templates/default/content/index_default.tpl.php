<?php

foreach ($template->settings['MAINPAGE'] as $const => $arr) {
    if ($file = $template->getFiles('MAINPAGE', $const, $config)) {
        if (file_exists($file)) {
            require_once $file;
        }
    }
}
