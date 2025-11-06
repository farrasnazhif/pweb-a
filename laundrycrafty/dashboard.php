<?php
require 'config.php';
require 'auth.php';
require_login();
$mysqli = db_connect();

$tot_pelanggan = $mysqli->query('SELECT COUNT(*) as c FROM pelanggan')->fetch_object()->c;
$tot_transaksi = $mysqli->query('SELECT COUNT(*) as c FROM transaksi')->fetch_object()->c;
$pendapatan_hari = 0;
$today = date('Y-m-d');
$stmt = $mysqli->prepare("SELECT COALESCE(SUM(total_harga),0) as sum FROM transaksi WHERE DATE(created_at)=?");
$stmt->bind_param('s', $today);
$stmt->execute();
$pendapatan_hari = $stmt->get_result()->fetch_assoc()['sum'];
$user = current_user();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Dashboard - LaundryCrafty</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="wrap">
    <header class="top">
      <h1>LaundryCrafty</h1>
      <div class="user">Hello, <?=$user['username']?> | <a href="logout.php">Logout</a></div>
    </header>

    <nav class="nav">
      <a href="dashboard.php">Dashboard</a>
      <a href="pelanggan_list.php">Customers</a>
      <a href="layanan_list.php">Services</a>
      <a href="transaksi_list.php">Transactions</a>
      <a href="laporan.php">Reports</a>
    </nav>

    <main>
      <section class="cards">
        <div class="card">
          <h3>Customers</h3>
          <p class="big"><?=$tot_pelanggan?></p>
        </div>
        <div class="card">
          <h3>Transactions</h3>
          <p class="big"><?=$tot_transaksi?></p>
        </div>
        <div class="card">
          <h3>Today's Revenue</h3>
          <p class="big">Rp <?=number_format($pendapatan_hari,0,',','.')?></p>
        </div>
      </section>
      <section>
        <h2>Quick Actions</h2>
        <ul>
          <li><a href="pelanggan_add.php">Add Customer</a></li>
          <li><a href="layanan_add.php">Add Service</a></li>
          <li><a href="transaksi_add.php">Add Transaction</a></li>
        </ul>
      </section>
    </main>
  </div>
</body>
</html>