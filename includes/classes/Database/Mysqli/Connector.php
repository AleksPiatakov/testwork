<?php

include_once dirname(__DIR__) . '/AbstractDbConnection.php';

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 19.09.2016
 * Time: 16:16
 */
class Connector extends AbstractDbConnection
{

    /**
     * Connection constructor.
     * DB_HOST
     * DB_DATABASE
     * DB_USERNAME
     * DB_PASSWORD
     */
    public function __construct()
    {

        $this->setConnection(new mysqli(
            getenv('DB_HOST'),
            getenv('DB_USERNAME'),
            getenv('DB_PASSWORD'),
            getenv('DB_DATABASE')
        ));

        parent::__construct();
    }

    /**
     * @return Connector
     */
    public static function getInstance()
    {

        if (!self::$instance) { // If no instance then make one
            self::$instance = new self();
        }
        return self::$instance;
    }
}
