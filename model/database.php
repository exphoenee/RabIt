<?php

class Database
{
	public static function Init($dbName, $dbUser, $dbPass) {
		$dsn = "mysql:host=localhost;dbname=". $dbName .";charset=utf8mb4";
		self::$connection = new \PDO($dsn, $dbUser, $dbPass);
	}

  public static function Exec($sql, $params = null) {
		self::$query = self::$connection->prepare($sql);
		$result = self::$query->execute($params);

		if(!$result) {
			trigger_error('Database Error - "'. self::Error() .'"', E_USER_NOTICE);
		}
		return $result;
	}

  public static function Result($class = null, $all = true) {
		if($class)
		{
			$result = self::$query->fetchAll(\PDO::FETCH_CLASS, $class);
		}
		else {
			$result = self::$query->fetchAll(\PDO::FETCH_ASSOC);
		}
		if ($result && !$all) {
			$result = $result[0];
		}
		return $result;
	}

  public static function LastId() {
		return self::$connection->lastInsertId();
	}
	public static function Error() {
		$error = self::$query->errorInfo();
		return $error[2];
	}

	private static $connection = null;
	private static $query = null;
}