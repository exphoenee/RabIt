<?php
class AdvertView {

  /*
  * generating the Adveristment view
  */
  public static function home($adverts) {

    $html = '';

    $html .= '<div><h1>Hirdetések</h1>';
    $select = new SelectView(UserController::read(), "name", "user_id");
    $html .= View::renderEditorMenu($adverts[0], true, $select);
    $html .= self::renderAdvertTable($adverts, $select);

    $html .='</div>';
    return $html;
  }

  public static function renderAdvertTable($adverts, $select) {
    $table = new TableView($adverts, true);
    return $table->setSelector($select)->render();
  }
}
?>