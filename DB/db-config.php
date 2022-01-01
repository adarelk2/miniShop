<?php
ini_set('display_errors', 0);
session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'root';
$DATABASE_NAME = 'website';

// Try and connect using the info above.
$mysqli = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
$mysqli->set_charset("utf8");



if ($mysqli->connect_error) 
{
    echo 'שגיאה בהתחברות לשרת ה MySQL in: '.$mysqli->connect_errno;
    echo '<br>';
    echo 'שגיאה בהתחברות לשרת ה MySQL in: '.$mysqli->connect_error;
    exit();
}
//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
date_default_timezone_set("Asia/Jerusalem");
?>