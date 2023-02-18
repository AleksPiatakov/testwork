<?php

/*
  $Id: address_book.php,v 1.2 2003/09/24 13:57:00 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

if (!isset($_GET['secret']) || $_GET['secret'] !== '9955615397') {
    exit('Invalid secret key');
}
$rootPath = __DIR__ . '/../../';
chdir($rootPath);
require('includes/application_top.php');
$englishLangId = 1;
$chinasLangId = 19;
//articles
$tableName = 'articles_description';
$keyFieldName = 'articles_id';
$queryCheck = tep_db_query("select * from $tableName where language_id = $chinasLangId");
$queryCheckCount = tep_db_num_rows($queryCheck);
if ($queryCheckCount == 0) {
    $query = tep_db_query("select * from $tableName where language_id = $englishLangId");
    while ($row = tep_db_fetch_array($query)) {
        unset($row['language_id']);
        $fields = array_keys($row);
        $values = array_values($row);
        $keyFieldValue = $row[$keyFieldName];
        tep_db_query("insert into $tableName (`" . implode('`, `', $fields) . "`,`language_id`) (select `" . implode('`, `', $fields) . "`,$chinasLangId from $tableName where `$keyFieldName` =  $keyFieldValue and language_id = $englishLangId)");
    }
}

//categories
$tableName = 'categories_description';
$keyFieldName = 'categories_id';
$queryCheck = tep_db_query("select * from $tableName where language_id = $chinasLangId");
$queryCheckCount = tep_db_num_rows($queryCheck);
if ($queryCheckCount == 0) {
    $query = tep_db_query("select * from $tableName where language_id = $englishLangId");
    while ($row = tep_db_fetch_array($query)) {
        unset($row['language_id']);
        $fields = array_keys($row);
        $values = array_values($row);
        $keyFieldValue = $row[$keyFieldName];
        tep_db_query("insert into $tableName (`" . implode('`, `', $fields) . "`,`language_id`) (select `" . implode('`, `', $fields) . "`,$chinasLangId from $tableName where `$keyFieldName` =  $keyFieldValue and language_id = $englishLangId)");
    }
}

//product
$tableName = 'products_description';
$keyFieldName = 'products_id';
$queryCheck = tep_db_query("select * from $tableName where language_id = $chinasLangId");
$queryCheckCount = tep_db_num_rows($queryCheck);
if ($queryCheckCount == 0) {
    $query = tep_db_query("select * from $tableName where language_id = $englishLangId");
    while ($row = tep_db_fetch_array($query)) {
        unset($row['language_id']);
        $fields = array_keys($row);
        $values = array_values($row);
        $keyFieldValue = $row[$keyFieldName];
        tep_db_query("insert into $tableName (`" . implode('`, `', $fields) . "`,`language_id`) (select `" . implode('`, `', $fields) . "`,$chinasLangId from $tableName where `$keyFieldName` =  $keyFieldValue and language_id = $englishLangId)");
    }
}

//coupons
$tableName = 'coupons_description';
$keyFieldName = 'coupon_id';
$queryCheck = tep_db_query("select * from $tableName where language_id = $chinasLangId");
$queryCheckCount = tep_db_num_rows($queryCheck);
if ($queryCheckCount == 0) {
    $query = tep_db_query("select * from $tableName where language_id = $englishLangId");
    while ($row = tep_db_fetch_array($query)) {
        unset($row['language_id']);
        $fields = array_keys($row);
        $values = array_values($row);
        $keyFieldValue = $row[$keyFieldName];
        tep_db_query("insert into $tableName (`" . implode('`, `', $fields) . "`,`language_id`) (select `" . implode('`, `', $fields) . "`,$chinasLangId from $tableName where `$keyFieldName` =  $keyFieldValue and language_id = $englishLangId)");
    }
}

//email_content
$tableName = 'email_content';
$keyFieldName = 'email_content_id';
$queryCheck = tep_db_query("select * from $tableName where language_id = $chinasLangId");
$queryCheckCount = tep_db_num_rows($queryCheck);
if ($queryCheckCount == 0) {
    $query = tep_db_query("select * from $tableName where language_id = $englishLangId");
    while ($row = tep_db_fetch_array($query)) {
        unset($row['language_id']);
        $fields = array_keys($row);
        $values = array_values($row);
        $keyFieldValue = $row[$keyFieldName];
        tep_db_query("insert into $tableName (`" . implode('`, `', $fields) . "`,`language_id`) (select `" . implode('`, `', $fields) . "`,$chinasLangId from $tableName where `$keyFieldName` =  $keyFieldValue and language_id = $englishLangId)");
    }
}
//manufacturers
$tableName = 'manufacturers_info';
$keyFieldName = 'manufacturers_id';
$queryCheck = tep_db_query("select * from $tableName where languages_id = $chinasLangId");
$queryCheckCount = tep_db_num_rows($queryCheck);
if ($queryCheckCount == 0) {
    $query = tep_db_query("select * from $tableName where languages_id = $englishLangId");
    while ($row = tep_db_fetch_array($query)) {
        unset($row['languages_id']);
        $fields = array_keys($row);
        $values = array_values($row);
        $keyFieldValue = $row[$keyFieldName];
        tep_db_query("insert into $tableName (`" . implode('`, `', $fields) . "`,`languages_id`) (select `" . implode('`, `', $fields) . "`,$chinasLangId from $tableName where `$keyFieldName` =  $keyFieldValue and languages_id = $englishLangId)");
    }
}

//meta_tags
$tableName = 'meta_tags';
$keyFieldName = 'manufacturers_id';
$queryCheck = tep_db_query("select * from $tableName where language_id = $chinasLangId");
$queryCheckCount = tep_db_num_rows($queryCheck);
if ($queryCheckCount == 0) {
    $query = tep_db_query("select * from $tableName where language_id = $englishLangId");
    while ($row = tep_db_fetch_array($query)) {
        unset($row['language_id']);
        $fields = array_keys($row);
        $values = array_values($row);
        $keyFieldValue = $row[$keyFieldName];
        tep_db_query("insert into $tableName (`" . implode('`, `', $fields) . "`,`language_id`) (select `" . implode('`, `', $fields) . "`,$chinasLangId from $tableName where `$keyFieldName` =  $keyFieldValue and language_id = $englishLangId)");
    }
}

//orders_status
$tableName = 'orders_status';
$keyFieldName = 'orders_status_id';
$queryCheck = tep_db_query("select * from $tableName where language_id = $chinasLangId");
$queryCheckCount = tep_db_num_rows($queryCheck);
if ($queryCheckCount == 0) {
    $query = tep_db_query("select * from $tableName where language_id = $englishLangId");
    while ($row = tep_db_fetch_array($query)) {
        unset($row['language_id']);
        $fields = array_keys($row);
        $values = array_values($row);
        $keyFieldValue = $row[$keyFieldName];
        tep_db_query("insert into $tableName (`" . implode('`, `', $fields) . "`,`language_id`) (select `" . implode('`, `', $fields) . "`,$chinasLangId from $tableName where `$keyFieldName` =  $keyFieldValue and language_id = $englishLangId)");
    }
}

//phesis_poll_data
$tableName = 'phesis_poll_data';
$keyFieldName = 'voteID';
$queryCheck = tep_db_query("select * from $tableName where language_id = $chinasLangId");
$queryCheckCount = tep_db_num_rows($queryCheck);
if ($queryCheckCount == 0) {
    $query = tep_db_query("select * from $tableName where language_id = $englishLangId");
    while ($row = tep_db_fetch_array($query)) {
        unset($row['language_id']);
        $fields = array_keys($row);
        $values = array_values($row);
        $keyFieldValue = $row[$keyFieldName];
        tep_db_query("insert into $tableName (`" . implode('`, `', $fields) . "`,`language_id`) (select `" . implode('`, `', $fields) . "`,$chinasLangId from $tableName where `$keyFieldName` =  $keyFieldValue and pollID = $row[pollID] and language_id = $englishLangId)");
    }
}

//products_options_values
$tableName = 'products_options_values';
$keyFieldName = 'products_options_values_id';
$queryCheck = tep_db_query("select * from $tableName where language_id = $chinasLangId");
$queryCheckCount = tep_db_num_rows($queryCheck);
if ($queryCheckCount == 0) {
    $query = tep_db_query("select * from $tableName where language_id = $englishLangId");
    while ($row = tep_db_fetch_array($query)) {
        unset($row['language_id']);
        $fields = array_keys($row);
        $values = array_values($row);
        $keyFieldValue = $row[$keyFieldName];
        tep_db_query("insert into $tableName (`" . implode('`, `', $fields) . "`,`language_id`) (select `" . implode('`, `', $fields) . "`,$chinasLangId from $tableName where `$keyFieldName` =  $keyFieldValue and language_id = $englishLangId)");
    }
}
echo "done";
