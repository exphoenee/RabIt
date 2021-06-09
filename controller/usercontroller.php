<?php

class UserController {

  public static function hanldeUsers() {
    $data = Request::Post();
    $action = Request::GetAction();
    $id = Request::GetParam();

    switch ($action) {
      case "add":
        self::create($data);
        break;
      case "delete":
        self::delete($id);
        break;
      case "update":
        self::update($id, $data);
        break;
      default:
        break;
    }
  }

  /*
  * This is the CREATE operation
  */
  public static function create($data) {
    return Controller::create("user", $data);
  }

  /*
  * This is the READ operation
  * if the method get $id as parameter gets only one record,
  * if does'nt then fetches all the datas form the table
  */
  public static function read($id = null) {
    return Controller::read("user", $id);
  }

  /*
  * This is the UPDATE operation
  */
  public static function update($id, $data) {
    return Controller::update("user", $id, $data);
  }

  /*
  * This is the DELETE operation (HARD DELETE)
  */
  public static function delete($id) {
    return Controller::delete("user", $id);
  }
}
?>