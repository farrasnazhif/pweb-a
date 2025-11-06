<?php
require 'config.php';
require 'auth.php';
require_login();
$mysqli = db_connect();

$from = $_GET['from'] ?? date('Y-m-01');
$to = $_GET['to'] ?? date('Y-m-d');
$stmt = $mysqli->prepare("SELECT DATE(created_at) as tanggal, COALESCE(SUM(total_harga),0) as total FROM transaksi WHERE DATE(created_at) BETWEEN ? AND ? GROUP BY DATE(created_at) ORDER BY DATE(created_at) ASC");
$stmt->bind_param('ss', $from, $to);
$stmt->execute();
$res = $stmt->get_result();
$total_all = 0;
while($r = $res->fetch_assoc()) $total_all += $r['total'];
?>
<!doctype html><html><head><meta charset="utf-8"><title>Reports</title><link rel="stylesheet" href="assets/style.css"></head>
<body><div class="wrap">
  <h2>Revenue Report</h2>
  <form method="get" class="form-inline">
    <label>From <input type="date" name="from" value="<?=$from?>"></label>
    <label>To <input type="date" name="to" value="<?=$to?>"></label>
    <button class="btn" type="submit">Filter</button>
    <a href="dashboard.php">Back</a>
  </form>

  <table class="table">
    <thead><tr><th>Date</th><th>Revenue</th></tr></thead>
    <tbody>
    <?php
    $stmt->execute();
    $r = $stmt->get_result();
    while($row = $r->fetch_assoc()):
    ?>
      <tr>
        <td><?=$row['tanggal']?></td>
        <td>Rp <?=number_format($row['total'],0,',','.')?></td>
      </tr>
    <?php endwhile; ?>
      <tr><th>Total</th><th>Rp <?=number_format($total_all,0,',','.')?></th></tr>
    </tbody>
  </table>
</div></body></html>