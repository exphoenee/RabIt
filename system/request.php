<?php
/*
* This class handling the requests
* and the url things.
*/
class Request {

  /*
  * this method checks the form was already sent earlier (not used in the project)
  */
	public static function hasFormSent($submit) {
		$formData = self::Post();
		if (isset($formData[$submit])) {
			return $formData;
		}
		return false;
	}

  /*
  * handling the GET HTTP method
  * param argument takes out from the GET the value only key equls to prama
  * if there is set a default then not existing GET parameters returning the default
  */
  public static function Get($param, $default = null) {
    if (isset($_GET[$param])) {
        return urlencode($_GET[$param]);
    }
    return $default;
  }

  /*
  * handling the GET Post method
  * if key is not set returns back the enire POST
  */
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

  /*
  * adding a hidden input to the form validation
  */
	public static function AddSubmitId() {
		$html = '';
		$html .=
			'<input type="hidden" name="submitId" value="'.rand().'">';
		return $html;
	}

  /*
  * Checking the submit id
  */
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
        unset($_POST['submitId']);
				$_SESSION['lastSubmitId'] = $id;
			}
		}
	}

  /*
  * Creating the URLs
  */
	public static function MakeURL($page, $action = null, $param = null) {
		$url = Config::$base .$page;
		if($action){ $url .= ("/". $action); }
		if($param){ $url .= ("/". $param); }

		return $url;
	}

  /*
  * Getting out the PAGE/ACTION/PARAM form the mapped URL
  */
	public static function Path($index) {
		if (self::$path === null) {
			$request = $_SERVER['REQUEST_URI'];
			self::$path = explode("/", $request);
		}

		if (isset(self::$path[$index])) {
			return self::$path[$index];
		}

		return null;
	}

	public static function GetPage() {
		return self::Path(1);
	}
	public static function GetAction() {
		return self::Path(2);
	}
	public static function GetParam() {
		return self::Path(3);
	}

	private static $path = null;
}

?>