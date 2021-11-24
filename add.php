<?php
require_once("classes/db.php");

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'root';
$dbname = 'crime2';

$db = new db($dbhost, $dbuser, $dbpass, $dbname);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$name = $_POST["name"];
$lat = $_POST["lat"];
$long = $_POST["long"];

$insert = $db->query('INSERT INTO poi (name,latitude,longitude) VALUES (?,?,?)', $name, $lat, $long);
$db->close();

header('Location: index.php');
?>
