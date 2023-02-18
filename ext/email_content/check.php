<?php

/**
 * check.php -- файл для автоматического добавления константы модуля, таблицы и данных в БД
 */
class tempDb
{

    var $connection;

    function __construct($db_host, $db_username, $db_password, $db_name)
    {
        $this->connection = new mysqli($db_host, $db_username, $db_password);
        $this->select_db($db_name);
        $this->error();
    }

    function select_db($db)
    {
        $this->connection->select_db($db);
        $this->error();
    }

    function error($sql = '')
    {
        if ($this->connection->errno) {
            echo $sql . "\n";
            echo "MYSQL error no: " . $this->connection->errno . "\n";
            echo "Error: " . $this->connection->error . "\n";
            die;
        }
    }

    function multi_query($query)
    {
        $this->connection->multi_query($query);
        $this->error($query);
    }
}

function generateEmailTables($connection)
{
    $sql = file_get_contents(__DIR__ . '/email_content.sql');
    $connection->multi_query($sql);
}

if (!defined('EMAIL_CONTENT_MODULE_ENABLED')) {
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (`configuration_title`,`configuration_key`,`configuration_value`,`configuration_description`,`configuration_group_id`, 
        `sort_order`, `last_modified`,`date_added`,`use_function`,`set_function`) 
        VALUES ('Шаблоны писем', 'EMAIL_CONTENT_MODULE_ENABLED', 'email_content:false', 'Включить модуль Шаблоны писем', '277', 
        NULL, '2014-01-16 13:05:03', '0000-00-00 00:00:00', 'tep_check_modules_folder', 'tep_cfg_select_option(array(\'true\', \'false\'),')
        ");
    $query = tep_db_query("SHOW TABLES LIKE 'email_content'");
    $tableExist = tep_db_fetch_array($query);
    if (is_null($tableExist)) {
        $dotenv = parse_ini_file(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '.env');
        $connection = new tempDb($dotenv['DB_HOST'], $dotenv['DB_USERNAME'], $dotenv['DB_PASSWORD'], $dotenv['DB_DATABASE']);
        generateEmailTables($connection);
    }
    $module_installed = true;
}
