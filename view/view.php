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
    </head>';
    return $html;
  }

  public static function navbar() {
    $html = '';

    $html .=
      '<div>
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
      </div>';
    return $html;
  }

  public static function renderEditorMenu($data, $edit = false) {
    $html = '';

    $idKey = Controller::getPrimaryKey();

    $id = null;
    if (isset($data[$idKey])) {
      $id = $data[$idKey];
    };

    unset($data[$idKey]);

    $html .=
    '<div class="' .($edit ? "add" : "edit"). '">
      <form action="'. Request::MakeURL(Request::GetPage(), ($edit ? "add" : "update"), ($edit ? null : $id)) .'" method="POST">';

    $fieldName = Mocks::headerText();
    foreach ($data as $key => $field) {
      $html .=
        '<div class="inputfiled">'.
          ($edit
          ? '<label for="newuserName">'. $fieldName[$key] .'</label>'
          : '').
          '<input
            type="text"
            name="'. $key .'"
            placeholder="' .($edit ? "név" : $field). '"
            id="'. $key .'"></input>'
          .Request::AddSubmitId().
          '</div>';
    }

    $html .=
        '<button
          type="submit">'
            .($edit ? "Hozzáadás" : "Frissítés" ).
        '</button>'
        .($edit ? '' : '<a href="'. Request::MakeURL(Request::GetPage()). '">Mégsem</a>').
      '</form>
    </div>';
    return $html;
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

  public static function closeBody() {
    $html = '';
    $html .=
      '</body>
    </html>';
    return $html;
  }
}
?>