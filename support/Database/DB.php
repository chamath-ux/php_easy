<?php

namespace Support\Database;
use Support\Factories\DatabaseFactory;
use Support\Database\QueryBuilder;
use Config\Config;
use Support\Database\Model;

class DB{

protected $connection;
protected $table; 
protected QueryBuilder $queryBuilder;

public function __construct()
{
    $this->setConnection();
    $this->queryBuilder = new QueryBuilder();
}


public function setConnection()
{
    $this->connection = DatabaseFactory::connect(Config::get('database.default'));
}

/**
 * @param string $table
 */

 public function table($table):object
 {
     
     $this->table = $table;
    $this->queryBuilder->setTable($table);
     return $this;
 }

 /**
 * @param string $key
 * @param string $value
 */

public function where($key,$condition,$value):object
{

    $this->queryBuilder->addCondition($key,$condition,$value,$not=false);
    return $this;
}

/**
 * @param string $key
 * @param string $condition
 * @param string $value
 */

public function whereNot($key,$condition,$value):object
{

    $this->queryBuilder->addCondition($key,$condition,$value,$not=true);
    return $this;
}

/**
 * @param array $fields
 */

public function select($fields):object
{
    $this->queryBuilder->setSelect($fields);
    return $this;
}

/**
 * @param string $min
 */

public function min($min):object
{
    $this->queryBuilder->setMin($min);
    return $this;
}

/**
 * @param string $table1
 * @param string $table2
 * @param string $column1
 * @param string $condition
 * @param string $column2
 */

 public function join($table2,$column1,$condition,$column2):object
 {
     $this->queryBuilder->setJoin($table2,$column1,$condition,$column2);
     return $this;
 }

/**
 * @param string $max
 */

 public function max($max):object
 {
     $this->queryBuilder->setMax($max);
     return $this;
 }

public function get()
{
    // return $this->queryBuilder->build();
    $stmt = $this->connection->connect()->prepare($this->queryBuilder->build());
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

}