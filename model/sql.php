<?php

  class Sql {
    private $type;
    private $table;
    private $fields;
    private $values;
    private $kesy;
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

      $this->keys = "(".implode(", ", $keys).")";
      $this->values = "(".implode(", ", $fields).")";

      return $this;
    }

    public function setWhere($where) {
      $this->where = $where;
      return $this;
    }

    public function setGroupBy($groupBy) {
      $this->groupBy = $groupBy;
      return $this;
    }

    public function setOrderBy($orderBy, $orderDir = null) {
      $this->orderBy = $orderBy;
      $this->orderDir = $orderDir;
      return $this;
    }

    public function setLimit($limit) {
      $this->limit = $limit;
      return $this;
    }

    public function getCount() {
      $this->fields = 'COUNT('.$this->fields.')';
      return $this;
    }

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
        $sql .= $this->keys;
        $sql .= " VALUES ";
        $sql .= $this->values;
      } else
      if ($this->type == "UPDATE") {
        $sql .= "`".(\Config::$dbPrefix . $this->table)."` ";
        $sql .= $this->keys;
        $sql .= " SET ";
        $sql .= $this->values;

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

      var_dump($sql);

      return $sql;
    }

    public static function Select($table) {
      return new Sql("SELECT", $table);
    }
    public static function Insert($table) {
      return new Sql("INSERT", $table);
    }
    public static function Update($table) {
      return new Sql("UPDATE", $table);
    }
    public static function Delete($table) {
      return new Sql("DELETE", $table);
    }
    public function __toString() {
      return $this->getSQL();
    }
  }
?>