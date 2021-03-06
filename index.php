<?php require_once("partials/_header.php"); ?>
    <div class="container">
      <?php
      $pois = $db->query('SELECT id FROM `poi`');
      ?>
      <h3>Points of Interest <span class="badge bg-secondary"><?= $pois->numRows(); ?></span></h3>
      <?php $pois = $db->query('SELECT * FROM `poi`')->fetchAll(); ?>
      <div class="row">
        <div class="col">
          <div class="card">
            <h5 class="card-header">Create</h5>
            <div class="card-body">
              <form class="" action="add.php" method="post">
                <div class="row">
                  <div class="col">
                    <label for="">Name</label>
                    <input class="form-control" id="name" type="text" name="name" value="">
                  </div>
                  <div class="col">
                    <label for="">Incident</label>
                    <select id="incident" class="form-control" name="incident">
                      <option value="0">Please Select</option>
                      <option value="Oranges">Oranges</option>
                      <option value="Apples">Apples</option>
                      <option value="Grapes">Grapes</option>
                    </select>
                  </div>
                  <div class="col">
                    <label for="">Status</label>
                    <select id="status" class="form-control" name="status">
                      <option value="0">Please Select</option>
                      <option value="ACTIVE">ACTIVE</option>
                      <option value="RESOLVED">RESOLVED</option>
                      <option value="EXPIRED">EXPIRED</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <label for="">Lon</label>
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
          <table id="poi" class="table table-bordered table-sm">
            <tr>
              <th class="text-center">ID</th>
              <th class="text-center">Name</th>
              <th class="text-center">Lon/Lat</th>
              <th class="text-center">Incident</th>
              <th class="text-center">Status</th>
              <th class="text-center">Created At</th>
              <th class="text-center">Delete</th>
            </tr>
            <?php foreach ($pois as $poi): ?>
              <tr>
                <td class="text-center"><?= $poi['id'] ?></td>
                <td><?= $poi['name'] ?></td>
                <td><?= number_format($poi['longitude'], 4, '.', '') ?>, <?= number_format($poi['latitude'], 4, '.', '') ?></td>
                <td><?= $poi['incident'] ?></td>
                <td class="text-center text-<?= $poi['status'] ?>"><?= $poi['status'] ?></td>
                <td><?= $poi['created_at'] ?></td>
                <td class="text-center"><a href="delete.php?id=<?= $poi['id'] ?>"><i class="bi bi-trash"></i></a></td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
      </div>
      <!-- Map Section -->
      <div id="map" class="map"></div>

      <div class="row my-2">
        <h3>Incidents by Type</h3>
      </div>
      <div class="row row-cols-3">
          <?php
          $list_of_incidents = $db->query('SELECT DISTINCT `incident` FROM `poi`')->fetchAll();
          ?>

          <?php foreach ($list_of_incidents as $incident): ?>
            <?php
            $countIncident = $db->query('SELECT `incident` FROM `poi` WHERE incident = ?', $incident);
            ?>
            <div class="col">
              <div class="card">
                <h5 class="card-header text-center"><?= $incident["incident"]; ?></h5>
                <div class="card-body">
                  <h1 class="display-2 text-center text-bold"><?= $countIncident->numRows() ?></h1>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="row my-2">
          <h3>Incidents by Status</h3>
        </div>
        <div class="row row-cols-3">
            <?php
            $list_of_statuses = $db->query('SELECT DISTINCT `status` FROM `poi`')->fetchAll();
            ?>

            <?php foreach ($list_of_statuses as $status): ?>
              <?php
              $countStatus = $db->query('SELECT `status` FROM `poi` WHERE `status` = ?', $status);
              ?>
              <div class="col">
                <div class="card">
                  <h5 class="card-header text-center"><?= $status["status"]; ?></h5>
                  <div class="card-body">
                    <h1 class="display-2 text-center text-<?= $status["status"]; ?>"><?= $countStatus->numRows() ?></h1>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <!-- JS -->
      <script type="text/javascript">
        <?php
          $php_array = $db->query('SELECT `longitude`, `latitude`, `status` FROM `poi`')->fetchAll();
          $js_array = json_encode($php_array);
          echo "var javascript_array = ". $js_array . ";\n";
        ?>
        const latitude = javascript_array.map(({ latitude }) => latitude);
        const longitude = javascript_array.map(({ longitude }) => longitude);
        const status = javascript_array.map(({ status }) => status);

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
          switch (status[i]) {
            case "ACTIVE":
              element.innerHTML = '<img src="https://cdn.mapmarker.io/api/v1/fa/stack?size=50&color=990000&icon=fa-microchip&hoffset=1" />';
              break;
            case "RESOLVED":
              element.innerHTML = '<img src="https://cdn.mapmarker.io/api/v1/fa/stack?size=50&color=009900&icon=fa-microchip&hoffset=1" />';
              break;
            case "EXPIRED":
              element.innerHTML = '<img src="https://cdn.mapmarker.io/api/v1/fa/stack?size=50&color=333333&icon=fa-microchip&hoffset=1" />';
              break;
          }
          var marker = new ol.Overlay({
              position: [longitude[i], latitude[i]],
              positioning: 'center-center',
              element: element,
              stopEvent: false
          });

          map.addOverlay(marker);
        };
      </script>

    </div>
<?php require_once("partials/_footer.php"); ?>
