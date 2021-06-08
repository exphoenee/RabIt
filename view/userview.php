<?php
class UserView {

  public static function home($users) {
    $html = '';
    $html .='<div><h1>Falhasználók</h1>';

    $html .= View::renderEditorMenu();
    $html .= self::renderUserTable($users);

    $html .='</div>';
    return $html;
  }

  public static function renderUserTable($users) {
    $table = new TableView($users, true);
    return $table->render();
  }
}
?>