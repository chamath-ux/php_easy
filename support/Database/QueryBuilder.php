<?php

namespace Support\Database;

class QueryBuilder{

private $table;
protected $fields = [];
protected $where = [];
protected $orderBy;
protected $limit;
protected $offset;
protected $min;


public function setTable($table):void
 {
     $this->table = $table;
 }

/**
 * @param string $key
 * @param string $value
 */

public function addCondition(string $key,string $condition,string $value, $not):void
{
    $prefix = $not ? 'NOT ' : '';
    $this->where[]  = sprintf(" %s %s %s '%s'",$prefix,$key,$condition,$value);
}

/**
 * @param array $fields
 */

 public function setSelect($fields):void
 {
    $this->fields[] = $fields;
 }

  /**
   * @param string $key
   * @param string $order
   */

  public function setOrderBy($key,$order):void
  {
    $this->orderBy = sprintf(" ORDER BY %s %s",$key,$order);
  }

  /**
   * @param int $limit
   */

  public function setLimit($limit)
  {
     $this->limit = sprintf(" LIMIT %s",$limit);
  }

  /**
   * @param int $offset
   */

   public function setOffset($offset)
   {
     $this->offset = sprintf(" OFFSET %s",$offset);
   }

   /**
   * @param string $min
   */

   public function setMin($min)
   {
     $this->min = sprintf(" MIN(%s) as {$min}",$min);
   }

/**
 * build a sql query
 */

    public function build():string
    {

        if(empty($this->fields) &&  empty($this->min))
        {
            $field = '*';

        }else if(!empty($this->fields) &&  empty($this->min)){

        $field= implode(',', $this->fields);

        }else if(empty($this->fields) &&  !empty($this->min)){

            $field = $this->min;
        }

        $sql =sprintf("SELECT %s  FROM %s",$field,$this->table);

        if(!empty($this->where)){
            $sql .= ' WHERE '.implode('', $this->where);
        }

        if(!empty($this->orderBy))
        {
            $sql .= $this->orderBy;
        }

        if(!empty($this->limit))
        {
            $sql .= $this->limit;
        }

        if(!empty($this->offset))
        {
            $sql .= $this->offset;
        }

        

        return $sql;
    }

}