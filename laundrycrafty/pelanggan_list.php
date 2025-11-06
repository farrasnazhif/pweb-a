<?php
require 'config.php';
require 'auth.php';
require_login();
$mysqli = db_connect();
$res = $mysqli->query('SELECT * FROM pelanggan ORDER BY id_pelanggan DESC');
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Customers</title><link rel="stylesheet" href="assets/style.css"></head>
<body>
<div class="wrap">
  <header><h2>Customers</h2><a class="btn" href="pelanggan_add.php">Add Customer</a> <a href="dashboard.php">Back</a></header>
  <table class="table">
    <thead><tr><th>#</th><th>Name</th><th>Address</th><th>Phone</th><th>Action</th></tr></thead>
    <tbody>
    <?php while($row=$res->fetch_assoc()): ?>
      <tr>
        <td><?=$row['id_pelanggan']?></td>
        <td><?=htmlspecialchars($row['nama'])?></td>
        <td><?=htmlspecialchars($row['alamat'])?></td>
        <td><?=htmlspecialchars($row['no_hp'])?></td>
        <td>
          <a href="pelanggan_edit.php?id=<?=$row['id_pelanggan']?>">Edit</a> |
          <a href="pelanggan_delete.php?id=<?=$row['id_pelanggan']?>" onclick="return confirm('Delete?')">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body></html>