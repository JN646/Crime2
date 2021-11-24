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
  </head>
  <body>
    <h1>Crime 2</h1>
    <form class="" action="add.php" method="post">
      <label for="">Name</label>
      <input type="text" name="name" value="">
      <label for="">Lat</label>
      <input type="text" name="lat" value="">
      <label for="">Long</label>
      <input type="text" name="long" value="">
      <button type="submit" name="submit">Add</button>
    </form>
    <table width="100%">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Lat</th>
        <th>Long</th>
      </tr>
      <?php foreach ($accounts as $account): ?>
        <tr>
          <td><?= $account['id'] ?></td>
          <td><?= $account['name'] ?></td>
          <td><?= $account['latitude'] ?></td>
          <td><?= $account['longitude'] ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </body>
</html>
