<?php
/*
* This is a basic configuration class against the .env file
*/
  class Config {

    /* main infos */
    public static $base = "http://localhost:3000/";
    public static $title = "RabIT teszt feladat";

    /* Change Before Deploy! */
    public static $sqlURI = "localhost";
    public static $dbName = 'rabit';
    public static $dbPass = 'rabit';
    public static $dbUser = 'rabit';
    public static $dbPrefix = "rabit__";
  }

?>