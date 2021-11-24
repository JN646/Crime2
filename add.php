<?php
require_once("classes/db.php");
require_once("classes/poi.class.php");
require_once("global.php");

$db = new db();

$name = $_POST["name"];
$lat = $_POST["lat"];
$long = $_POST["long"];
$incident = $_POST["incident"];

$poi = new PointOfInterest($id = NULL, $name, $lat, $long, $incident);

$poi->createPOI();

// Redirect
header('Location: index.php');
?>
