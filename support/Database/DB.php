<?php

namespace Support\Database;
use Support\Factories\DatabaseFactory;
use Support\Database\QueryBuilder;
use Config\Config;
use Support\Database\Model;

class DB{

protected $connection;
protected $table; 
protected $fields;
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

 public function table($table)
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

public function select(...$fields):object
{
    $this->fields = $fields;
    $this->queryBuilder->setSelect($fields);
    return $this;
}

public function getTable()
{
    return $this->table;
}

public function getFields()
{
    return $this->fields;
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
 * @param string 'inner' join type
 */

 public function join($table2,$column1,$condition,$column2):object
 {
     $this->queryBuilder->setJoin($table2,$column1,$condition,$column2,'inner');
     return $this;
 }

 /**
 * @param string $table1
 * @param string $table2
 * @param string $column1
 * @param string $condition
 * @param string $column2
 */

 public function leftJoin($table2,$column1,$condition,$column2):object
 {
     $this->queryBuilder->setJoin($table2,$column1,$condition,$column2,'left');
     return $this;
 }

 /**
 * @param string $table1
 * @param string $table2
 * @param string $column1
 * @param string $condition
 * @param string $column2
 */

 public function rightJoin($table2,$column1,$condition,$column2):object
 {
     $this->queryBuilder->setJoin($table2,$column1,$condition,$column2,'right');
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


public function groupBy($groupColumn)
{
    $this->queryBuilder->setGroupBy($groupColumn);
    return $this;
    
}

public function count($count)
{
    $this->queryBuilder->setCount($count);
    return $this;
}

public function get()
{
    $stmt = $this->connection->connect()->prepare($this->queryBuilder->build());
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

}