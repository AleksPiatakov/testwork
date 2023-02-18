<?php

if (!defined('MASTER_PASSWORD_MODULE_ENABLED')) {

    function generateStrongPassword($length = 15, $add_dashes = false, $available_sets = 'luds')
    {
        $sets = array();
        if (strpos($available_sets, 'l') !== false) {
            $sets[] = 'abcdefghjkmnpqrstuvwxyz';
        }
        if (strpos($available_sets, 'u') !== false) {
            $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
        }
        if (strpos($available_sets, 'd') !== false) {
            $sets[] = '23456789';
        }
        if (strpos($available_sets, 's') !== false) {
            $sets[] = '!@#$%&*?';
        }
        $all = '';
        $password = '';
        foreach ($sets as $set) {
            $password .= $set[array_rand(str_split($set))];
            $all .= $set;
        }
        $all = str_split($all);
        for ($i = 0; $i < $length - count($sets); $i++) {
            $password .= $all[array_rand($all)];
        }
        $password = str_shuffle($password);
        if (!$add_dashes) {
            return $password;
        }
        $dash_len = floor(sqrt($length));
        $dash_str = '';
        while (strlen($password) > $dash_len) {
            $dash_str .= substr($password, 0, $dash_len) . '-';
            $password = substr($password, $dash_len);
        }
        $dash_str .= $password;
        return $dash_str;
    }

    function generate_salt()
    {
        return crypt(generateStrongPassword(), generateStrongPassword(15, false, 'lu'));
    }

    function generatePassword()
    {
        $pass = generateStrongPassword() . generate_salt();
        return str_shuffle($pass);
    }

    $generated_password =  generatePassword();

    /**
     * check.php -- файл для автоматического добавления констант модуля в БД
     */
    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title,
         configuration_key,
         configuration_value,
         configuration_description,
         configuration_group_id,
         sort_order,
         date_added,
         last_modified,
         use_function,
         set_function)
         VALUES
        ('Модуль MASTER_PASSWORD',
        'MASTER_PASSWORD_MODULE_ENABLED',
        'master_password:false',
        'Модуль Master Password',
        '277',
        '1',
        '" . date('Y-m-d H:i:s') . "',
        '" . date('Y-m-d H:i:s') . "',
        'tep_check_modules_folder',
        'tep_cfg_select_option(array(\"master_password:true\", \"master_password:false\"),')
        ");

    tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . "
        (configuration_title,
        configuration_key,
        configuration_value,
        configuration_description,
        configuration_group_id,
        sort_order,
        last_modified,
        date_added,
        use_function,
        set_function) 
        VALUES 
        ('Master Password', 
        'MASTER_PASS', 
        '" . $generated_password . "', 
        'This password will allow you to login to any customers account.', 
        1, 
        23, 
        '" . date('Y-m-d H:i:s') . "', 
        '" . date('Y-m-d H:i:s') . "', 
        NULL, 
        NULL)");

    $module_installed = true;
}
