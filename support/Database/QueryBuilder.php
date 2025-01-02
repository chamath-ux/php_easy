<?php

namespace Support\Database;

class QueryBuilder{

private $table;
protected $fields;
protected $where = [];
protected $orderBy;
protected $limit;
protected $offset;
protected $min;
protected $max;
protected $join;
protected $union;
protected $groupBy;
protected $count;


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
    $this->fields = $fields;
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
   * @param string $max
   */

   public function setMax($max)
   {
     $this->max = sprintf(" MAX(%s) as {$max}",$max);
   }

    /**
     * @param string $table1
     * @param string $table2
     * @param string $column1
     * @param string $condition
     * @param string $column2
     * @param string 'inner' join type
    */

   public function setJoin($table2,$column1,$condition,$column2,$type)
   {

     $joinType = function($type):string
     {
        if($type == 'inner')
        {
            return 'INNER JOIN';

        }else if($type == 'left')
        {
            return 'LEFT JOIN';

        }else if($type == 'right')
        {
            return 'RIGHT JOIN';
        }
     };
     $this->join = sprintf(" %s %s ON %s %s %s",$joinType($type),$table2,$column1,$condition,$column2);
   }

   public function setGroupBy($groupColumn)
   {
        $this->groupBy = sprintf(" GROUP BY %s ", $groupColumn);
   }

   public function setCount($count)
   {
        $this->count = sprintf(" COUNT(%s)",$count);
        
   }

   public function selectFields()
   {
    if(empty($this->fields) &&  empty($this->min) && empty($this->max))
    {
        $field = '*';

    }else if(!empty($this->fields) &&  (empty($this->min) && empty($this->max))){

    $field= implode(',', $this->fields);

    }else if((empty($this->fields) && empty($this->max)) &&  !empty($this->min)){

        $field = $this->min;

    }else if((empty($this->fields) &&  empty($this->min)) && !empty($this->max))
    {
        $field = $this->max;
    }else if(!empty($this->count))
    {
        $field = $this->count;
    }

     return $field;
   }

/**
 * build a sql query
 */

    public function build():string
    {

        $field = $this->selectFields();

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
        
        if(!empty($this->join)){
            $sql .= $this->join;
        }

        if(!empty($this->union))
        {
            $sql .= $this->union;
        }
        if(!empty($this->groupBy))
        {
            $sql .= $this->groupBy;
        }

        

        return $sql;
    }

}