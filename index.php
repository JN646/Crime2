<?php require_once("partials/_header.php"); ?>
    <div class="container">
      <?php
      $accounts = $db->query('SELECT * FROM poi');
      ?>
      <h3>Points of Interest <span class="badge bg-secondary"><?= $accounts->numRows(); ?></span></h3>
      <?php $accounts = $db->query('SELECT * FROM poi')->fetchAll(); ?>
      <div class="row">
        <div class="col">
          <div class="card">
            <h5 class="card-header">Create</h5>
            <div class="card-body">
              <form class="" action="add.php" method="post">
                <div class="col">
                  <label for="">Name</label>
                  <input class="form-control" id="name" type="text" name="name" value="">
                </div>
                <div class="row">
                  <div class="col">
                    <label for="">Long</label>
                    <input class="form-control" id="long" type="text" name="long" value="">
                  </div>
                  <div class="col">
                    <label for="">Lat</label>
                    <input class="form-control" id="lat" type="text" name="lat" value="">
                  </div>
                </div>
                <div class="mt-2">
                  <button class="btn btn-primary" type="submit" name="submit"><i class="bi bi-plus"></i> Add</button>
                  <button class="btn btn-primary" type="button" onclick="getLocation()" name="gps"><i class="bi bi-geo"></i> GPS</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col">
          <table class="table table-bordered">
            <tr>
              <th class="text-center">ID</th>
              <th class="text-center">Name</th>
              <th class="text-center">Long</th>
              <th class="text-center">Lat</th>
              <th class="text-center">Created At</th>
              <th class="text-center">Delete</th>
            </tr>
            <?php foreach ($accounts as $account): ?>
              <tr>
                <td class="text-center"><?= $account['id'] ?></td>
                <td><?= $account['name'] ?></td>
                <td><?= $account['longitude'] ?></td>
                <td><?= $account['latitude'] ?></td>
                <td><?= $account['created_at'] ?></td>
                <td class="text-center"><a href="delete.php?id=<?= $account['id'] ?>"><i class="bi bi-trash"></i></a></td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
      </div>
      <div id="map" class="map"></div>
      <script type="text/javascript">
        <?php
          $php_array = $db->query('SELECT longitude, latitude FROM poi')->fetchAll();
          $js_array = json_encode($php_array);
          echo "var javascript_array = ". $js_array . ";\n";
        ?>
        const latitude = javascript_array.map(({ latitude }) => latitude);
        const longitude = javascript_array.map(({ longitude }) => longitude);

        console.log(latitude[1]);
        console.log(longitude);

        var map = new ol.Map({
                target: 'map',
                layers: [
                    new ol.layer.Tile({
                        source: new ol.source.OSM()
                    })
                ],
                view: new ol.View({
                    projection:"EPSG:4326",
                    center: [longitude[0], latitude[0]],
                    zoom: 10,
                    minzoom: 6,
                    maxzoom: 18
                })
            });

        for (var i = 0; i < javascript_array.length; i++) {
          var element = document.createElement('div');
          element.innerHTML = '<img src="https://cdn.mapmarker.io/api/v1/fa/stack?size=50&color=DC4C3F&icon=fa-microchip&hoffset=1" />';
          var marker = new ol.Overlay({
              position: [longitude[i], latitude[i]],
              positioning: 'center-center',
              element: element,
              stopEvent: false
          });
          map.addOverlay(marker);
          console.log(longitude[i], latitude[i]);
        };
      </script>

    </div>
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
<?php require_once("partials/_footer.php"); ?>
