<?php

class Controller {

  public static function renderPage() {
    $page = Request::getPage();

    $html = '';
    $html .= View::header();
    $html .= View::openBody();
    $html .= View::navbar();
    $html .= View::openMain();
    $html .= Self::content($page);
    $html .= View::closeMain();
    $html .= View::closeBody();
    echo $html;
  }

  public static function content($page) {
    $html = '';
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
        AdvertController::hanldeAdverts();
        $adverts = AdvertController::read();
        $html .= AdvertView::home($adverts);
        break;
    }
    return $html;
  }

  public static function generateUserSelect($selected) {
    return View::renderUserSelect(UserController::read(), "name", $selected);
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

  public static function getPrimaryKey() {
    return substr(Request::GetPage(), 0, -1)."_id";
  }
}

?>