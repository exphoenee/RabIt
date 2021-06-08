<?php

class AdvertController {

  public static function hanldeAdverts() {
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
    return Controller::create("advert", $data);
  }

  public static function read($id = null) {
    return Controller::read("advert", $id);
  }

  public static function update($id, $data) {
    return Controller::update("advert", $id, $data);
  }

  public static function delete($id) {
    return Controller::delete("advert", $id);
  }
}
?>