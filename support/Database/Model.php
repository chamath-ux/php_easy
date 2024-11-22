<?php

namespace Support\Database;
use Support\Factories\DatabaseFactory;
use Config\Config;

class Model{

    protected $table;
    protected $primaryKey = 'id';
    protected $attributes = [];
    private $connection;
    public function __construct()
    {
        $this->connection = DatabaseFactory::connect(Config::get('database.default'));
    }

    public function all()
    {
        $stmt = $this->connection->connect()->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->connection->connect()->prepare("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

}