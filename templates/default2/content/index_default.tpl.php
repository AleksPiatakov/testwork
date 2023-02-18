<?php

foreach ($template->settings['MAINPAGE'] as $const => $arr) {
    if ($file = $template->getFiles('MAINPAGE', $const, $config)) {
        require_once $file;
    }
}
