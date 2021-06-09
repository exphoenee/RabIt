<?php
/*
* Later thay also comes form database and
* they had easing the work for me
*/
  class Mocks {
    public static $menu =
    [
      "home" =>
      [
        "text" => "Főoldal",
        "link" => "home",
      ],
      "user" =>
      [
        "text" => "Felhasználók",
        "link" => "users",
      ],
      "advert" =>
      [
        "text" => "Hirdetések",
        "link" => "adverts",
      ],
    ];

    public static $idTags = [
      "user_id" => "User Azonosító",
      "advert_id" => "Hirdetés azonosító",
    ];

    public static $editor =  ["edit-cell" => "Szerkesztés", "delete-cell" => "Törlés"];

    public static $filedNames = [
      "title" => "Hirdetés címe",
      "name" => "Felhasználó neve"
    ];

    public static function headerText() {
      return array_merge(self::$idTags, self::$filedNames);
    }

  }

?>