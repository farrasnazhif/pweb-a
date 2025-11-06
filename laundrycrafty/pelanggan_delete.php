<?php
require 'config.php';
require 'auth.php';
require_login();
$mysqli = db_connect();
$id = intval($_GET['id'] ?? 0);
$mysqli->query("DELETE FROM pelanggan WHERE id_pelanggan={$id}");
header('Location: pelanggan_list.php');
exit;