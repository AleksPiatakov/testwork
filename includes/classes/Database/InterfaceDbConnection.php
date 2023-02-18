<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 19.09.2016
 * Time: 16:16
 */
interface InterfaceDbConnection
{
    public static function getInstance();
    public function getConnection();
}
