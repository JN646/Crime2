<?php
require_once("classes/db.php");
require_once("classes/poi.class.php");
require_once("global.php");

$db = new db($dbhost, $dbuser, $dbpass, $dbname);

$id = $_GET["id"];

$poi = new PointOfInterest($id, $name = NULL, $lat = NULL, $long = NULL);

$poi->deletePOI($id);

// Redirect
header('Location: index.php');
?>
