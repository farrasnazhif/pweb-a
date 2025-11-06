<?php
require 'config.php';
require 'auth.php';
require_login();
$mysqli = db_connect();
$err = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nama = trim($_POST['nama'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');
    $no_hp = trim($_POST['no_hp'] ?? '');
    if($nama === '') $err = 'Name is required.';
    else {
        $stmt = $mysqli->prepare('INSERT INTO pelanggan (nama, alamat, no_hp) VALUES (?,?,?)');
        $stmt->bind_param('sss', $nama, $alamat, $no_hp);
        if($stmt->execute()) header('Location: pelanggan_list.php');
        else $err = $mysqli->error;
    }
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Add Customer</title><link rel="stylesheet" href="assets/style.css"></head>
<body>
<div class="wrap">
  <h2>Add Customer</h2>
  <?php if($err): ?><div class="alert"><?=$err?></div><?php endif; ?>
  <form method="post" class="form">
    <label>Name <input type="text" name="nama" required></label>
    <label>Address <textarea name="alamat"></textarea></label>
    <label>Phone <input type="text" name="no_hp"></label>
    <button class="btn" type="submit">Save</button>
    <a href="pelanggan_list.php">Cancel</a>
  </form>
</div></body></html>