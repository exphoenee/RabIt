<?php

class Request {

	public static function hasFormSent($submit) {
		$formData = self::Post();
		if (isset($formData[$submit])) {
			return $formData;
		}
		return false;
	}

  public static function Get($param, $default = null) {
    if (isset($_GET[$param])) {
        return urlencode($_GET[$param]);
    }
    return $default;
  }

  public static function Post($key = null){
  if($key !== null) {
      if (isset($_POST[$key])) {
        return $_POST[$key];
      }
		} else {
			$post = $_POST;
			return $post;
		}
		return null;
	}

	public static function AddSubmitId() {
		$html = '';
		$html .=
			'<input type="hidden" name="submitId" value="'.rand().'">';
		return $html;
	}

	public static function SubmitCheck()
	{
		if(isset($_POST['submitId']))
		{
			$id = $_POST['submitId'];

			if(isset($_SESSION['lastSubmitId']) && $_SESSION['lastSubmitId'] == $id)
			{
				$_POST = [];
			}
			else
			{
				$_SESSION['lastSubmitId'] = $id;
			}
		}
	}

	public static function MakeURL($page, $action = null, $param = null)
	{
		$url = Config::$base .$page;
		if($action){ $url .= ("/". $action); }
		if($param){ $url .= ("/". $param); }

		return $url;
	}
	public static function Path($index)
	{
		if (self::$path === null) {
			$script = $_SERVER['PHP_SELF'];
			$request = $_SERVER['REQUEST_URI'];

			$script = str_replace("index.php", "", $script);
			$request = str_replace($script, "", $request);

			self::$path = explode("/", $request);
		}

		if (isset(self::$path[$index])) {
			return self::$path[$index];
		}

		return null;
	}
	public static function GetPage()
	{
		return self::Path(0);
	}
	public static function GetAction()
	{
		return self::Path(1);
	}
	public static function GetParam()
	{
		return self::Path(2);
	}

	private static $path = null;
}

?>