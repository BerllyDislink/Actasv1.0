<?php

class Connection
{
    public $host = "localhost";
    public $dbname = "users_db2";
    public $port = '3306';
    public $user = "root";
    public $password = "";
    public $driver = "mysql";
    public $connect;
    private $stmt;


    public static function getConnection()
    {
        try {
            $connection = new Connection();
            $connection->connect = new PDO("{$connection->driver}:host={$connection->host};port={$connection->port};dbname={$connection->dbname};", $connection->user, $connection->password);
            $connection->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection->connect;
            //echo "Connection success";
        } catch (Exception $e) {
            echo "" . $e->getMessage() . "";
        }
    }
}
//Connection::getConnection();