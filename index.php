<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Crime 2</title>
    <?php require_once("classes/db.php") ?>
    <?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = 'root';
    $dbname = 'crime2';

    $db = new db($dbhost, $dbuser, $dbpass, $dbname);

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $accounts = $db->query('SELECT * FROM poi')->fetchAll();
    ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </head>
  <body>
    <h1>Crime 2</h1>
    <h3>Points of Interest</h3>
    <div class="border">
      <form class="" action="add.php" method="post">
        <label for="">Name</label>
        <input id="name" type="text" name="name" value="">
        <label for="">Lat</label>
        <input id="lat" type="text" name="lat" value="">
        <label for="">Long</label>
        <input id="long" type="text" name="long" value="">
        <button type="submit" name="submit">Add</button>
        <button type="button" onclick="getLocation()" name="gps">GPS</button>
      </form>
    </div>
    <table width="100%">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Lat</th>
        <th>Long</th>
        <th>Delete</th>
      </tr>
      <?php foreach ($accounts as $account): ?>
        <tr>
          <td><?= $account['id'] ?></td>
          <td><?= $account['name'] ?></td>
          <td><?= $account['latitude'] ?></td>
          <td><?= $account['longitude'] ?></td>
          <td class="text-center"><a href="delete.php?id=<?= $account['id'] ?>">Delete</a></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </body>
  <script type="text/javascript">
    // Ask GPS
    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
      }
    }

    // Get coords
    function showPosition(position) {
      var name = document.getElementById("name");
      var lat = document.getElementById("lat");
      var long = document.getElementById("long");

      // Update values with lat long.
      lat.value = position.coords.latitude;
      long.value = position.coords.longitude;

      // Enter a default name if none is entered.
      if (name.value == "") {
        name.value = "Current Location";
      }
    }
  </script>
</html>
