<?php

foreach ($template->settings['LEFT'] as $const => $arr) {
    if ($file = $template->getFiles('LEFT', $const, $config)) {
        require_once $file;
    }
}
