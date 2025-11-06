<?php
require 'config.php';
require 'auth.php';
require_login();
$mysqli = db_connect();
$res = $mysqli->query('SELECT * FROM layanan ORDER BY id_layanan DESC');
?>
<!doctype html><html><head><meta charset="utf-8"><title>Services</title><link rel="stylesheet" href="assets/style.css"></head>
<body><div class="wrap">
  <header><h2>Services</h2><a class="btn" href="layanan_add.php">Add Service</a> <a href="dashboard.php">Back</a></header>
  <table class="table">
    <thead><tr><th>#</th><th>Service</th><th>Price/kg</th><th>Action</th></tr></thead>
    <tbody>
    <?php while($row=$res->fetch_assoc()): ?>
      <tr>
        <td><?=$row['id_layanan']?></td>
        <td><?=htmlspecialchars($row['nama_layanan'])?></td>
        <td><?=number_format($row['harga_per_kg'],0,',','.')?></td>
        <td>
          <a href="layanan_edit.php?id=<?=$row['id_layanan']?>">Edit</a> |
          <a href="layanan_delete.php?id=<?=$row['id_layanan']?>" onclick="return confirm('Delete?')">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</div></body></html>