<?php
require 'config.php';
require 'auth.php';
require_login();
$mysqli = db_connect();
$id = intval($_GET['id'] ?? 0);
$row = $mysqli->query('SELECT t.*, p.nama as pelanggan, l.nama_layanan FROM transaksi t JOIN pelanggan p ON p.id_pelanggan=t.id_pelanggan JOIN layanan l ON l.id_layanan=t.id_layanan WHERE t.id_transaksi='.$id)->fetch_assoc();
if(!$row){ echo 'Not found'; exit; }
?>
<!doctype html><html><head><meta charset="utf-8"><title>Transaction Detail</title><link rel="stylesheet" href="assets/style.css"></head>
<body><div class="wrap">
  <h2>Transaction #<?=$row['id_transaksi']?></h2>
  <ul>
    <li><strong>Customer:</strong> <?=htmlspecialchars($row['pelanggan'])?></li>
    <li><strong>Service:</strong> <?=htmlspecialchars($row['nama_layanan'])?></li>
    <li><strong>Weight:</strong> <?=$row['berat']?> kg</li>
    <li><strong>Total:</strong> Rp <?=number_format($row['total_harga'],0,',','.')?></li>
    <li><strong>Status:</strong> <?=$row['status']?></li>
    <li><strong>Entry:</strong> <?=$row['tanggal_masuk']?></li>
    <li><strong>Finish:</strong> <?=$row['tanggal_selesai']?:'-'?></li>
  </ul>
  <a href="transaksi_list.php">Back</a>
</div></body></html>