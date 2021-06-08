<?php

class UserController {

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