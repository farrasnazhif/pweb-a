<?php
require 'config.php';
require 'auth.php';
require_login();
$mysqli = db_connect();
$id = intval($_GET['id'] ?? 0);
$mysqli->query("DELETE FROM layanan WHERE id_layanan={$id}");
header('Location: layanan_list.php');
exit;