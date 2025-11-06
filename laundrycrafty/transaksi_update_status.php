<?php
require 'config.php';
require 'auth.php';
require_login();
$mysqli = db_connect();
$id = intval($_GET['id'] ?? 0);
$row = $mysqli->query("SELECT * FROM transaksi WHERE id_transaksi={$id}")->fetch_assoc();
if(!$row){ echo 'Not found'; exit; }
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $status = $_POST['status'] ?? $row['status'];
    $tanggal_selesai = $_POST['tanggal_selesai'] ?: null;
    $stmt = $mysqli->prepare('UPDATE transaksi SET status=?, tanggal_selesai=? WHERE id_transaksi=?');
    $stmt->bind_param('ssi', $status, $tanggal_selesai, $id);
    $stmt->execute();
    header('Location: transaksi_list.php');
    exit;
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Update Status</title><link rel="stylesheet" href="assets/style.css"></head>
<body><div class="wrap">
  <h2>Update Status #<?=$row['id_transaksi']?></h2>
  <form method="post" class="form">
    <label>Status
      <select name="status">
        <option <?= $row['status']=='Proses' ? 'selected' : '' ?>>Proses</option>
        <option <?= $row['status']=='Selesai' ? 'selected' : '' ?>>Selesai</option>
        <option <?= $row['status']=='Sudah Diambil' ? 'selected' : '' ?>>Sudah Diambil</option>
      </select>
    </label>
    <label>Finish Date <input type="date" name="tanggal_selesai" value="<?=$row['tanggal_selesai']?>"></label>
    <button class="btn" type="submit">Save</button> <a href="transaksi_list.php">Cancel</a>
  </form>
</div></body></html>