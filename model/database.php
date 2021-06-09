<?php

class Database
{
  /*
  * Initializing th database
  */
	public static function Init($dbName, $dbUser, $dbPass) {
		$dsn = "mysql:host=localhost;dbname=". $dbName .";charset=utf8mb4";
		self::$connection = new \PDO($dsn, $dbUser, $dbPass);
	}

  /*
  * Executing the prepared database query
  */
  public static function Exec($sql, $params = null) {
		self::$query = self::$connection->prepare($sql);
		$result = self::$query->execute($params);

		if(!$result) {
			trigger_error('Database Error - "'. self::Error() .'"', E_USER_NOTICE);
		}
		return $result;
	}

  /*
  * Fetching the results of the query
  */
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

  /*
  * Thats gets the last inserted, updated, deleted id. In this task I did'nt used that
  */
  public static function LastId() {
		return self::$connection->lastInsertId();
	}

  /*
  * Primitive error handling (not used in the project)
  * TODO: it would be more secure to use at every database qery
  */
	public static function Error() {
		$error = self::$query->errorInfo();
		return $error[2];
	}

  /*
  * Global valiblaes in the calss to reach they quick
  */
	private static $connection = null;
	private static $query = null;
}