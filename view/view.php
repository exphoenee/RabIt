<?php
class View {
  public static function header() {
    $html = '';
    $html .=
    '<!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>'.Config::$title.'</title>
      <link rel="stylesheet" href="'.Config::$base.'/style/style.css"">
    </head>';
    return $html;
  }

  public static function navbar() {
    $html = '';

    $html .=
      '<header id="menu">
        <nav>
          <ul>';

    foreach (Mocks::$menu as $menuPoint) {
      $html .=
            '<li>
              <a href="'.Request::MakeURL($menuPoint['link']).'">'
                .$menuPoint['text'].
              '</a>
            </li>';
    };
    $html .=
          '</ul>
        </nav>
      </header>';
    return $html;
  }

  public static function renderEditorMenu($data, $edit = false, $select=null) {
    $html = '';

    $page = Request::GetPage();
    $idKey = Controller::getPrimaryKey();

    $id = $edit ? "add" : null;
    if (isset($data[$idKey]) && !$edit) {
      $id = $data[$idKey];
    };

    unset($data[$idKey]);

    $html .=
    '<div class="' .($edit ? "add" : "edit"). '">
      <form action="'. Request::MakeURL($page, ($edit ? "add" : "update"), ($edit ? null : $id)) .'" method="POST">';

    $fieldName = Mocks::headerText();
    foreach ($data as $key => $field) {
      if (($select) && ($key == $select->getForeignKey())) {
        $html .= $select->setSelected($id)->render();
      } else {
        $html .=
          '<div class="inputfiled">'.
            '<label for="'. $key .'-'. $id .'">'. $fieldName[$key] .'</label>
            <input
              type="text"
              name="'. $key .'"
              id="'. $key .'-'. $id .'"></input>
          </div>';
      }
    }

    $html .=
        Request::AddSubmitId().
        '<button
          class="link-btn '.($edit ? "new" : "update").'"
          type="submit">'
            .($edit ? "Hozzáadás" : "Frissítés" ).
        '</button>'
        .($edit ? '' : (View::createLinkButton(Request::MakeURL($page), "Mégsem", "cancel"))).
      '</form>
    </div>';
    return $html;
  }


  public static function createLinkButton($url, $text, $class = null) {
    return '<div
        class="link-btn'
          .($class ? " ".$class : "").
        '">
          <a href="'. $url .'">
            '.$text.'
          </a>
        </div>';
  }

  public static function home() {
    return '<div>Home</div>';
  }

  public static function openBody() {
    $html = '';
    $html .=
      '<body>';
    return $html;
  }

  public static function openMain() {
    $html = '';
    $html .=
      '<main>';
    return $html;
  }

  public static function closeMain() {
    $html = '';
    $html .=
      '</main>';
    return $html;
  }
  public static function closeBody() {
    $html = '';
    $html .=
      '</body></html>';
    return $html;
  }
}
?>