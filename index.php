<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Crime 2</title>
    <?php
    require_once("classes/db.php");
    require_once("global.php");

    $db = new db($dbhost, $dbuser, $dbpass, $dbname);

    $accounts = $db->query('SELECT * FROM poi')->fetchAll();
    ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="container">
      <h1>Crime 2</h1>
      <h3>Points of Interest</h3>
      <div class="row">
        <div class="border">
          <form class="" action="add.php" method="post">
            <label for="">Name</label>
            <input class="form-control" id="name" type="text" name="name" value="">
            <label for="">Lat</label>
            <input class="form-control" id="lat" type="text" name="lat" value="">
            <label for="">Long</label>
            <input class="form-control" id="long" type="text" name="long" value="">
            <div class="mt-2">
              <button class="btn btn-primary" type="submit" name="submit"><i class="bi bi-plus"></i> Add</button>
              <button class="btn btn-primary" type="button" onclick="getLocation()" name="gps"><i class="bi bi-geo"></i> GPS</button>
            </div>
          </form>
        </div>
      </div>
      <div class="row mt-4">
        <table class="table table-bordered">
          <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Name</th>
            <th class="text-center">Lat</th>
            <th class="text-center">Long</th>
            <th class="text-center">Delete</th>
          </tr>
          <?php foreach ($accounts as $account): ?>
            <tr>
              <td class="text-center"><?= $account['id'] ?></td>
              <td><?= $account['name'] ?></td>
              <td><?= $account['latitude'] ?></td>
              <td><?= $account['longitude'] ?></td>
              <td class="text-center"><a href="delete.php?id=<?= $account['id'] ?>"><i class="bi bi-trash"></i></a></td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
    </div>
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
