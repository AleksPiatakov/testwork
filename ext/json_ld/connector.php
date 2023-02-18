<?php

require __DIR__ . "/Container.php";
require __DIR__ . "/IGenerate.php";

require __DIR__ . "/BreadcrumbList.php";
\JsonLd\Container::set("breadcrumb", new \JsonLd\BreadcrumbList());

if (strstr($PHP_SELF, FILENAME_PRODUCT_INFO)) {
    require __DIR__ . "/ProductReview.php";
    require __DIR__ . "/Product.php";
}
