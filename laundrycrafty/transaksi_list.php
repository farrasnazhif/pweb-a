<?php
require 'config.php';
require 'auth.php';
require_login();
$mysqli = db_connect();
$res = $mysqli->query('SELECT t.*, p.nama as pelanggan, l.nama_layanan FROM transaksi t JOIN pelanggan p ON p.id_pelanggan=t.id_pelanggan JOIN layanan l ON l.id_layanan=t.id_layanan ORDER BY t.id_transaksi DESC');
?>
<!doctype html><html><head><meta charset="utf-8"><title>Transactions</title><link rel="stylesheet" href="assets/style.css"></head>
<body><div class="wrap">
  <header><h2>Transactions</h2><a class="btn" href="transaksi_add.php">Add Transaction</a> <a href="dashboard.php">Back</a></header>
  <table class="table">
    <thead><tr><th>#</th><th>Customer</th><th>Service</th><th>Weight</th><th>Total</th><th>Status</th><th>Action</th></tr></thead>
    <tbody>
    <?php while($row=$res->fetch_assoc()): ?>
      <tr>
        <td><?=$row['id_transaksi']?></td>
        <td><?=htmlspecialchars($row['pelanggan'])?></td>
        <td><?=htmlspecialchars($row['nama_layanan'])?></td>
        <td><?=$row['berat']?> kg</td>
        <td>Rp <?=number_format($row['total_harga'],0,',','.')?></td>
        <td><?=$row['status']?></td>
        <td><a href="transaksi_detail.php?id=<?=$row['id_transaksi']?>">Detail</a> | <a href="transaksi_update_status.php?id=<?=$row['id_transaksi']?>">Update Status</a></td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</div></body></html>