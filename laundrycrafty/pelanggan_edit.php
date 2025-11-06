<?php
require 'config.php';
require 'auth.php';
require_login();
$mysqli = db_connect();
$id = intval($_GET['id'] ?? 0);
$row = $mysqli->query("SELECT * FROM pelanggan WHERE id_pelanggan={$id}")->fetch_assoc();
if(!$row){ echo 'Not found'; exit; }
$err = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nama = trim($_POST['nama'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');
    $no_hp = trim($_POST['no_hp'] ?? '');
    if($nama === '') $err = 'Name required.';
    else {
        $stmt = $mysqli->prepare('UPDATE pelanggan SET nama=?, alamat=?, no_hp=? WHERE id_pelanggan=?');
        $stmt->bind_param('sssi', $nama, $alamat, $no_hp, $id);
        if($stmt->execute()) header('Location: pelanggan_list.php');
        else $err = $mysqli->error;
    }
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Edit Customer</title><link rel="stylesheet" href="assets/style.css"></head>
<body><div class="wrap">
  <h2>Edit Customer</h2>
  <?php if($err): ?><div class="alert"><?=$err?></div><?php endif; ?>
  <form method="post" class="form">
    <label>Name <input type="text" name="nama" value="<?=htmlspecialchars($row['nama'])?>" required></label>
    <label>Address <textarea name="alamat"><?=htmlspecialchars($row['alamat'])?></textarea></label>
    <label>Phone <input type="text" name="no_hp" value="<?=htmlspecialchars($row['no_hp'])?>"></label>
    <button class="btn" type="submit">Update</button> <a href="pelanggan_list.php">Cancel</a>
  </form>
</div></body></html>