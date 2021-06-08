<?php
class AdvertView {

  public static function home($adverts) {

    $html = '';

    $html .= '<div><h1>Hirdetések</h1>';
    $html .= View::renderEditorMenu();
    $html .= self::renderAdvertTable($adverts);

    $html .='</div>';
    return $html;
  }

  public static function renderAdvertTable($adverts) {
    $table = new TableView($adverts, true);
    return $table->render();
  }
}
?>