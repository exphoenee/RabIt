<?php

class Controller {

  public static function create($table, $data) {
    $sql = Sql::Insert($table)->setFields($data);
    return Database::Exec($sql, $data);
  }

  public static function read($table, $id = null) {
    $sql = Sql::Select($table);
    if ($id  !== null) {
      $sql->setWhere("`user_id` = ".$id);
    }
    return Database::Exec($sql);
  }

  public static function update($table, $id, $data) {
    $sql = Sql::Update($table)
      ->setFields($data)
      ->setWhere("`user_id` = ".$id);
    return Database::Exec($sql);
  }

  public static function delete($table, $id) {
    $sql = Sql::Delete($table)
      ->setWhere("`user_id` = ".$id);
    return Database::Exec($sql);
  }
}

?>