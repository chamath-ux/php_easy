<?php

namespace Support\Database\Eloquent;
use Support\Factories\DatabaseFactory;
use Config\Config;
use Support\Database\QueryBuilder;

class Model{

    protected $table;
    protected $primaryKey = 'id';
    protected $attributes = [];
    protected static $connection;
    
    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
        $this->queryBuilder = new QueryBuilder();
        $this->setTable();
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

    protected function getTable() : string
    {
        return $this->table ?? strtolower((new \ReflectionClass($this))->getShortName()). 's';
    }

    public function setTable()
    {
        $this->queryBuilder->setTable($this->getTable());
    }

    public function create()
    {
        $instance = new static();
        foreach ($instance->attributes as $key => $attribute) {
            $stmt = self::$connection->connect()->query("INSERT INTO {$instance->getTable()} ($attribute,) {$instance->getTable()}");
        }
       
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param string $key
     * @param string $value
     */

    public static function where($key,$condition,$value):object
    {
        $instance = new static();

        $instance->queryBuilder->addCondition($key,$condition,$value,$not=false);
        return $instance;
    }

    /**
     * @param array $fields
     */

    public static function select($fields):object
    {
        $instance = new static();
        $instance->queryBuilder->setSelect($fields);
        return $instance;
    }

    public function get()
    {
        $stmt = self::$connection->connect()->prepare($this->queryBuilder->build());
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
}