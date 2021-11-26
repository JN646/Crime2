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
    $this->id = $id;
    $this->name = $name;
    $this->lat = $lat;
    $this->long = $long;
    $this->incident = $incident;
    $this->status = $status;
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

  function setName($name) {
    $this->name = $name;
  }

  function setIncident($incident) {
    $this->incident = $incident;
  }

  function setLat($lat) {
    $this->lat = $lat;
  }

  function setLong($long) {
    $this->long = $long;
  }

  function setStatus($status) {
    $this->status = $status;
  }

  function createPOI() {
    $db = new db();

    $insert = $db->query('INSERT INTO poi (name,latitude,longitude,incident,status) VALUES (?,?,?,?,?)', $this->name, $this->lat, $this->long, $this->incident, $this->status);
    $db->close();
  }

  function deletePOI($id) {
    $db = new db();

    $insert = $db->query('DELETE FROM poi WHERE id = ?', $id);
    $db->close();
  }
}

?>
