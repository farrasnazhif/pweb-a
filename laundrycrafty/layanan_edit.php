<?php
require 'config.php';
require 'auth.php';
require_login();
$mysqli = db_connect();
$id = intval($_GET['id'] ?? 0);
$row = $mysqli->query("SELECT * FROM layanan WHERE id_layanan={$id}")->fetch_assoc();
if(!$row){ echo 'Not found'; exit; }
$err = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nama = trim($_POST['nama_layanan'] ?? '');
    $harga = floatval($_POST['harga_per_kg'] ?? 0);
    if($nama === '' || $harga <= 0) $err = 'Name and positive price required.';
    else {
        $stmt = $mysqli->prepare('UPDATE layanan SET nama_layanan=?, harga_per_kg=? WHERE id_layanan=?');
        $stmt->bind_param('sdi', $nama, $harga, $id);
        if($stmt->execute()) header('Location: layanan_list.php');
        else $err = $mysqli->error;
    }
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Edit Service</title><link rel="stylesheet" href="assets/style.css"></head>
<body><div class="wrap">
  <h2>Edit Service</h2>
  <?php if($err): ?><div class="alert"><?=$err?></div><?php endif; ?>
  <form method="post" class="form">
    <label>Service Name <input type="text" name="nama_layanan" value="<?=htmlspecialchars($row['nama_layanan'])?>" required></label>
    <label>Price per kg <input type="number" step="0.01" name="harga_per_kg" value="<?=$row['harga_per_kg']?>" required></label>
    <button class="btn" type="submit">Update</button> <a href="layanan_list.php">Cancel</a>
  </form>
</div></body></html>