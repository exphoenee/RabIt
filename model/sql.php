<?php

/*
* this class creates the database queries
*/
class Sql {
  private $type;
  private $table;
  private $fields;
  private $values;
  private $keys;
  private $where;
  private $count;

  private $groupBy;
  private $orderBy;
  private $orderDir;
  private $limit;

  public function __construct($type, $table) {
    $this->type = $type;
    $this->table = $table;
    $this->fields = "*";
    $this->keys = [];
    $this->values = [];
    $this->where = null;
    $this->orderDir = null;
  }

  /*
  * setting up the fields of the query
  */
  public function setFields($fields) {
    $this->fields = $fields;

    forEach ($fields as &$field) {
      if ($field == '') {
        $field="NULL";
      }
      else {
        $field = "'".$field."'";
      }
    }

    $keys = array_keys($fields);

    forEach ($keys as &$key) {
      $key = "`".$key."`";
    }

    $this->keys = $keys;
    $this->values = $fields;

    return $this;
  }

  /*
  * setting up the WHERE of the query
  */
  public function setWhere($where) {
    $this->where = $where;
    return $this;
  }

  /*
  * setting up the GROUP BY of the query (not uest in the project)
  */
  public function setGroupBy($groupBy) {
    $this->groupBy = $groupBy;
    return $this;
  }

  /*
  * setting up the ORDER BY of the query (not uest in the project)
  */
  public function setOrderBy($orderBy, $orderDir = null) {
    $this->orderBy = $orderBy;
    $this->orderDir = $orderDir;
    return $this;
  }

  /*
  * setting up the LIMIT of the query (not uest in the project)
  */
  public function setLimit($limit) {
    $this->limit = $limit;
    return $this;
  }

  /*
  * setting up the COUNT of the query (not uest in the project)
  */
  public function getCount() {
    $this->fields = 'COUNT('.$this->fields.')';
    return $this;
  }

  /*
  * generating the SQL query string
  */
  public function getSQL() {
    $sql = $this->type ." ";

    if ($this->type == "SELECT") {
      $sql .= $this->fields;
      $sql .= " FROM ";
      $sql .= (\Config::$dbPrefix . $this->table);

      if ($this->where) {
        $sql .= " WHERE ";
        $sql .= $this->where;
      }

      if ($this->groupBy) {
        $sql .= (" GROUP BY ". $this->groupBy);
      }

      if ($this->orderBy) {
        $sql .= (" ORDER BY ". $this->orderBy);
        if ($this->orderDir) {
          $sql .= (" ". $this->orderDir);
        }
      }

      if ($this->limit) {
        $sql .= (" LIMIT ". $this->limit);
      }
    } else
    if ($this->type == "INSERT") {
      $sql .= "INTO ";
      $sql .= "`".(\Config::$dbPrefix . $this->table)."` ";
      $sql .= "(".implode(", ", $this->keys).")";
      $sql .= " VALUES ";
      $sql .= "(".implode(", ", $this->values).")";
    } else
    if ($this->type == "UPDATE") {
      $sql .= "`".(\Config::$dbPrefix . $this->table)."` ";
      $sql .= " SET ";

      $fields = [];
      foreach (array_combine($this->keys, $this->values) as $key => $record) {
        array_push($fields, $key." = ".$record);
      }
      $sql .= implode(", ", $fields);

      if ($this->where) {
        $sql .= " WHERE ";
        $sql .= $this->where;
      }
    } else
    if ($this->type == "DELETE") {
      $sql .= "FROM ";
      $sql .= (\Config::$dbPrefix . $this->table);

      if ($this->where) {
        $sql .= " WHERE ";
        $sql .= $this->where;
      }
    }

    return $sql;
  }

  /*
  * Instantiation of a new SELECT query
  */
  public static function Select($table) {
    return new Sql("SELECT", $table);
  }

  /*
  * Instantiation of a new INSRET query
  */
  public static function Insert($table) {
    return new Sql("INSERT", $table);
  }

  /*
  * Instantiation of a new UPDATE query
  */
  public static function Update($table) {
    return new Sql("UPDATE", $table);
  }

  /*
  * Instantiation of a new DELETE query
  */
  public static function Delete($table) {
    return new Sql("DELETE", $table);
  }

  /*
  * Magic method for the SQL query string generation
  */
  public function __toString() {
    return $this->getSQL();
  }
}
?>