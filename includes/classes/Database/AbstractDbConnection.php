<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 19.09.2016
 * Time: 16:20
 */

require_once __DIR__ . '/InterfaceDbConnection.php';
abstract class AbstractDbConnection implements InterfaceDbConnection
{

    private $connection;

    /**
     * @param mixed $connection
     */
    protected function setConnection($connection)
    {
        $this->connection = $connection;
    }
    protected static $instance; //The single instance
    private $host;

    /**
     * @param mixed $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param mixed $database
     */
    public function setDatabase($database)
    {
        $this->database = $database;
    }
    private $username;
    private $password;
    private $database;


    /**
     * AbstractDbConnection constructor.
     */
    public function __construct()
    {
        // Error handling
        if (mysqli_connect_error()) {
//            throw new \Exception(mysqli_connect_error());
            $message = "<br>
                SERVER_NAME: {$_SERVER["SERVER_NAME"]}<br>
                SCRIPT_NAME: {$_SERVER["SCRIPT_NAME"]}<br>
                REQUEST_URI: {$_SERVER["REQUEST_URI"]}";
            trigger_error(
                "Failed to connect to MySQL: " . mysqli_connect_error() . $message,
                E_USER_ERROR
            );
        }
    }



    /**
     * @return mixed
     */
    public function getConnection()
    {
        return $this->connection;
    }
}
