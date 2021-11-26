<?php
/**
 * Points of Interest
 */
class PointOfInterest extends db {
  private $id;
  private $name;
  private $lat;
  private $long;
  private $incident;
  private $status;

  function __construct($id, $name, $lat, $long, $incident, $status) {
    $this->setID($id);
    $this->setName($name);
    $this->setLat($lat);
    $this->setLong($long);
    $this->setIncident($incident);
    $this->setStatus($status);
  }

  function getID() {
    return $this->name;
  }

  function getName() {
    return $this->name;
  }

  function getLat() {
    return $this->lat;
  }

  function getLong() {
    return $this->long;
  }

  function getIncident() {
    return $this->incident;
  }

  function getStatus() {
    return $this->status;
  }

  function setID($id) {
    $this->id = $id;
  }

  function setName($name) {
    $this->name = $name;
  }

  function setIncident($incident) {
    $this->incident = $incident;
  }

  function setLat($lat) {
    if (!is_numeric($lat)) {
      die("Error: Must be a number.");
    } else {
      $this->lat = $lat;
    }
  }

  function setLong($long) {
    if (!is_numeric($long)) {
      die("Error: Must be a number.");
    } else {
      $this->long = $long;
    }
  }

  function setStatus($status) {
    if ($status == "0") {
      die("Error: Can't be 0.");
    } else {
      $this->status = $status;
    }
  }

  function createPOI() {
    $db = new db();

    $insert = $db->query('INSERT INTO `poi` (`name`,`latitude`,`longitude`,`incident`,`status`) VALUES (?,?,?,?,?)', $this->name, $this->lat, $this->long, $this->incident, $this->status);
    $db->close();
  }

  function deletePOI($id) {
    $db = new db();

    $insert = $db->query('DELETE FROM `poi` WHERE `id` = ?', $id);
    $db->close();
  }
}

?>
