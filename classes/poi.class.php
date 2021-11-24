<?php
/**
 * Points of Interest
 */
class PointOfInterest extends db {
  private $id;
  private $name;
  private $lat;
  private $long;

  function __construct($id, $name, $lat, $long) {
    $this->id = $id;
    $this->name = $name;
    $this->lat = $lat;
    $this->long = $long;
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

  function setName($name) {
    $this->name = $name;
  }

  function setLat($lat) {
    $this->lat = $lat;
  }

  function setLong($long) {
    $this->long = $long;
  }

  function createPOI() {
    $db = new db();

    $insert = $db->query('INSERT INTO poi (name,latitude,longitude) VALUES (?,?,?)', $this->name, $this->lat, $this->long);
    $db->close();
  }

  function deletePOI($id) {
    $db = new db();

    $insert = $db->query('DELETE FROM poi WHERE id = ?', $id);
    $db->close();
  }
}

?>
