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

$id = $_GET["id"];

$insert = $db->query('DELETE FROM poi WHERE id = ?', $id);
$db->close();

header('Location: index.php');
?>
