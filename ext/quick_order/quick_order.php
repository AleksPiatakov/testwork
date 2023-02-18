<?php

if (is_file(__DIR__ . '/' . TEMPLATE_NAME . '/quick_order.php')) {
    require_once __DIR__ . '/' . TEMPLATE_NAME . '/quick_order.php';
} else {
    require_once __DIR__ . '/' . DIR_WS_DEFAULT_TEMPLATE_NAME . 'quick_order.php';
}
