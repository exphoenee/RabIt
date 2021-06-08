<?php
class UserView {

  public static function home($users) {
    $html = '';
    $html .='<div><h1>Falhasználók</h1>';

    $html .= self::renderEditorMenu();
    $html .= self::renderUserTable($users);

    $html .='</div>';
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

  public static function renderUserTable($users) {
    $html = '';
    $thead = '';
    $tbody = '';

    $thead .= '<tr>';
    $thead .= '<th>User Azonosító</th>';
    $thead .= '<th>User neve</th>';
    $thead .= '<th>Szerkesztés</th>';
    $thead .= '<th>Törlés</th>';
    $thead .= '</tr>';

    foreach ($users as $user) {
      $tbody .= '<tr id="'. $user['user_id'] .'">';
      $tbody .= '<td>'. $user['user_id'] .'</td>';
      $tbody .= '<td>'. $user['name'] .'</td>';

      if (Request::GetParam() != $user['user_id']) {
        $tbody .= '<td><a href="'. Request::MakeURL("users", "edit", $user['user_id']) .'">Szerkesztés</a></td>';
      } else {
        $tbody .= '<td>'.self::renderEditorMenu($user).'</td>';
      }

      $tbody .= '<td><a href="'. Request::MakeURL("users", "delete", $user['user_id']) .'">Törlés</a></td>';
      $tbody .= '</tr>';
    }

    $html .=
      '<table><thead>'.$thead.'</thead><tbody>'.$tbody.'</tbody></table>';
    return $html;
  }
}
?>