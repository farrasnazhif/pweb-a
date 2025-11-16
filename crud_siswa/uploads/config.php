<?php
$koneksi = mysqli_connect("localhost", "root", "root", "crud_siswa");

if (!$koneksi) {
    die("Connection Failed: " . mysqli_connect_error());
}
?>