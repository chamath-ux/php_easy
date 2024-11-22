<?php

namespace Support\Database;
use Config\Config;
use Support\Database\Database;

class Mysql implements Database{

    private $host;
    private $username;
    private $password;
    private $dbname;
    private $connection;
    private static $instance;

    public function __construct()
    {
        $this->host = Config::get('database.connections.mysql.host');
        $this->username = Config::get('database.connections.mysql.username');
        $this->password = Config::get('database.connections.mysql.password');
        $this->dbname = Config::get('database.connections.mysql.database');

        try{
           $this->connection = new \PDO('mysql:host='.$this->host.';dbname='.$this->dbname,$this->username,$this->password);
           $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function connect()
    {
        return $this->connection;
    }
}