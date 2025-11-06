<?php
require 'config.php';
require 'auth.php';
require_login();
$mysqli = db_connect();
$err = '';
$pel = $mysqli->query('SELECT id_pelanggan, nama FROM pelanggan');
$lay = $mysqli->query('SELECT id_layanan, nama_layanan, harga_per_kg FROM layanan');

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id_pelanggan = intval($_POST['id_pelanggan'] ?? 0);
    $id_layanan = intval($_POST['id_layanan'] ?? 0);
    $berat = floatval($_POST['berat'] ?? 0);
    $tanggal_masuk = $_POST['tanggal_masuk'] ?? date('Y-m-d');
    $tanggal_selesai = $_POST['tanggal_selesai'] ?: null;

    if($id_pelanggan ==0 || $id_layanan==0 || $berat <= 0) $err = 'Select customer, service, and positive weight.';
    else {
        // get price
        $stmt = $mysqli->prepare('SELECT harga_per_kg FROM layanan WHERE id_layanan=?');
        $stmt->bind_param('i', $id_layanan);
        $stmt->execute();
        $harga = $stmt->get_result()->fetch_assoc()['harga_per_kg'] ?? 0;
        $total = $harga * $berat;

        $ins = $mysqli->prepare('INSERT INTO transaksi (id_pelanggan,id_layanan,tanggal_masuk,tanggal_selesai,berat,total_harga) VALUES (?,?,?,?,?,?)');
        $ins->bind_param('iissdd',$id_pelanggan,$id_layanan,$tanggal_masuk,$tanggal_selesai,$berat,$total);
        if($ins->execute()) header('Location: transaksi_list.php');
        else $err = $mysqli->error;
    }
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Add Transaction</title><link rel="stylesheet" href="assets/style.css"></head>
<body><div class="wrap">
  <h2>Add Transaction</h2>
  <?php if($err): ?><div class="alert"><?=$err?></div><?php endif; ?>
  <form method="post" class="form">
    <label>Customer
      <select name="id_pelanggan" required>
        <option value="">-- select --</option>
        <?php mysqli_data_seek($pel,0); while($r=$pel->fetch_assoc()): ?>
          <option value="<?=$r['id_pelanggan']?>"><?=htmlspecialchars($r['nama'])?></option>
        <?php endwhile; ?>
      </select>
    </label>
    <label>Service
      <select name="id_layanan" required>
        <option value="">-- select --</option>
        <?php mysqli_data_seek($lay,0); while($r=$lay->fetch_assoc()): ?>
          <option value="<?=$r['id_layanan']?>"><?=$r['nama_layanan']?> (Rp <?=number_format($r['harga_per_kg'],0,',','.')?>/kg)</option>
        <?php endwhile; ?>
      </select>
    </label>
    <label>Weight (kg) <input type="number" step="0.1" name="berat" required></label>
    <label>Entry Date <input type="date" name="tanggal_masuk" value="<?=date('Y-m-d')?>"></label>
    <label>Finish Date (optional) <input type="date" name="tanggal_selesai"></label>
    <button class="btn" type="submit">Save</button> <a href="transaksi_list.php">Cancel</a>
  </form>
</div></body></html>