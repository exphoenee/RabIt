<?php
  require 'autoload.php';

  session_start();
  date_default_timezone_set("Europe/Budapest");
  ini_set('display_errors', "on");
  ini_set('error_reporting', E_ALL);
  error_reporting(E_ALL);

  Request::SubmitCheck();
  Database::Init(Config::$dbName, Config::$dbUser, Config::$dbPass);
?>