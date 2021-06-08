<?php

class AdvertController {

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