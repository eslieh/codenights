<?php
  // $hostname = "localhost:3306";
  // $username = "lqzluuep_codenights";
  // $password = "2298416425092150Vic@2004";
  // $dbname = "lqzluuep_meals";
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $dbname = "codenights";
  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error: ".mysqli_connect_error();
  }
  date_default_timezone_set("Africa/Nairobi");
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
?>