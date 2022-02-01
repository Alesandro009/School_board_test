<?php
require __DIR__ . '/autoload.php';

use Simplon\Mysql\PDOConnector;
use Simplon\Mysql\Mysql;

class dbConnection
{

    private $connection;
    public function __construct()
    {
        $this->connection = new PDOConnector(
            $_ENV['DB_HOST'],
            $_ENV['DB_USERNAME'],
            $_ENV['DB_PASSWORD'],
            $_ENV['DB_DATABASE']
        );
    }

    public function getConnection()
    {
        $pdoConn = $this->connection->connect('utf8', []);


        return  new Mysql($pdoConn);
    }
}
