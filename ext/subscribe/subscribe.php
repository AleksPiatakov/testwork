<?php

if (is_file(__DIR__ . '/' . TEMPLATE_NAME . '/subscribe.php')) {
    require_once __DIR__ . '/' . TEMPLATE_NAME . '/subscribe.php';
} else {
    require_once __DIR__ . '/' . DIR_WS_DEFAULT_TEMPLATE_NAME . 'subscribe.php';
}
