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

  public static function create($data) {
    return Controller::create("user", $data);
  }

  public static function read($id = null) {
    return Controller::read("user", $id);
  }

  public static function update($id, $data) {
    return Controller::update("user", $id, $data);
  }

  public static function delete($id) {
    return Controller::delete("user", $id);
  }
}
?>