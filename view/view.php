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
      <title>Document</title>
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

  public static function renderEditorMenu($user = null) {
    $html = '';
    $edit = false;
    $id = null;

    if (isset($user)) {
      $edit = true;
    };

    if (isset($user['user_id'])) {
      $id = $user['user_id'];
    };

    $html .=
    '<div class="' .($edit ? "edit" : "add"). '">
      <form action="'. Request::MakeURL("users", ($edit ? "update" : "add"), $id) .'" method="POST">'.
        ($edit
          ? ''
          : '<label for="newuserName">Felhasználó név</label>').
        '<input
          type="text"
          name="name"
          placeholder="' .($edit ? $user['name'] : "név"). '"
          id="newuserName"></input>'
        .Request::AddSubmitId().
        '<button
          type="submit">'
            .($edit ? "Frissítés" : "Hozzáadás").
        '</button>'
        .($edit ? '<a href="'. Request::MakeURL("users"). '">Mégsem</a>' : '').
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