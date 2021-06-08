<?php

class Controller {

  public static function renderPage() {
    $page = Request::getPage();

    $html = '';
    $html .= View::header();
    $html .= View::openBody();
    $html .= View::navbar();

    switch ($page) {
      case "home":
      default:
        $html .= HomeView::home();
        break;
      case "users":
        UserController::hanldeUsers();
        $users = UserController::read();
        $html .= UserView::home($users);
        break;
      case "adverts":
        $html .= AdvertView::home();
        break;
    }

    $html .= View::closeBody();
    echo $html;
  }

  public static function create($table, $data) {
    $sql = Sql::Insert($table)->setFields($data);
    Database::Exec($sql);
    return Database::Result();
  }

  public static function read($table, $id = null) {
    $sql = Sql::Select($table);
    if ($id  !== null) {
      $sql->setWhere("`user_id` = ".$id);
    }
    Database::Exec($sql);
    return Database::Result();
  }

  public static function update($table, $id, $data) {
    $sql = Sql::Update($table)
      ->setFields($data)
      ->setWhere("`user_id` = ".$id);
    Database::Exec($sql);
    return Database::Result();
  }

  public static function delete($table, $id) {
    $sql = Sql::Delete($table)
      ->setWhere("`user_id` = ".$id);
    Database::Exec($sql);
    return Database::Result();
  }
}

?>