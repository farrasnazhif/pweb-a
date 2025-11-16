<?php
include 'config.php';

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM siswa WHERE id='$id'");

echo "<script>alert('Data berhasil dihapus'); window.location='index.php';</script>";
?>