<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/farmdata/escapehtml.php';
$host = "localhost";
$user = $_SESSION['dbuser'];
$pass = $_SESSION['dbpass'];
$dbName = $_SESSION['db'];
try {
   $dbcon = new PDO("mysql:host=".$host.";dbname=".$dbName, $user, $pass,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET sql_mode="TRADITIONAL"'));
   $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $dbcon->query("SET SESSION sql_mode = 'ALLOW_INVALID_DATES'");
} catch (PDOException $e) {
  $host = $_SERVER['HTTP_HOST']."/farmdata";
  echo '<link type="text/css" href="/farmdata/design.css" rel = "stylesheet">';
  echo  ("Connection Failed !! : ".$e->getMessage());
  echo '<br clear="all"/><br clear="all"/>';
$method = "http";
/*
$method = "https";
*/

  echo '<form method="POST" action="'.$method.'://'.$host.'"/>';
  echo '<input type ="submit" class="submitbutton" value = "Log In Again">';
  echo '</form>';
  die();
}
?>
