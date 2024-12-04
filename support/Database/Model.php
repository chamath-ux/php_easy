<?php

namespace Support\Database;
use Support\Factories\DatabaseFactory;
use Config\Config;

class Model{

    protected $table;
    protected $primaryKey = 'id';
    protected $attributes = [];
    private static $connection;
    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }

    public static function setConnection(){
        self::$connection = DatabaseFactory::connect(Config::get('database.default'));
    }

    public static function all()
    {
        $instance = new static();
        $stmt = self::$connection->connect()->query("SELECT * FROM {$instance->getTable()}");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $instance = new static();
        $stmt = self::$connection->connect()->prepare("SELECT * FROM {$instance->getTable()} WHERE {$instance->primaryKey} = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    private function getTable() : string
    {
        return $this->table ?? strtolower((new \ReflectionClass($this))->getShortName()). 's';
    }

    public function create()
    {
        $instance = new static();
        foreach ($instance->attributes as $key => $attribute) {
            $stmt = self::$connection->connect()->query("INSERT INTO {$instance->getTable()} ($attribute,) {$instance->getTable()}");
        }
       
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}