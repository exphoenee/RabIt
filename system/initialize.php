<?php
  require 'autoload.php';

  session_start();
  date_default_timezone_set("Europe/Budapest");
  ini_set('display_errors', "off");
  ini_set('error_reporting', E_NOTICE);
  error_reporting(E_NOTICE);

  Request::SubmitCheck();
  Database::Init(Config::$dbName, Config::$dbUser, Config::$dbPass);
?>