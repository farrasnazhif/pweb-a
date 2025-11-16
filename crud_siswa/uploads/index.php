<?php include 'config.php'; ?>

<!DOCTYPE html>
<html>
<head>
<title>Data Siswa</title>
<style>
table, td, th { border:1px solid black; border-collapse:collapse; padding:15px; }
a { font-size:22px; }
</style>
</head>
<body>

<h1>Data Siswa</h1>
<a href="tambah.php">Tambah Data</a>
<br><br>

<table width="100%">
<tr>
    <th>Foto</th>
    <th>NRP</th>
    <th>Nama</th>
    <th>Jenis Kelamin</th>
    <th>Telepon</th>
    <th>Alamat</th>
    <th>Aksi</th>
</tr>

<?php
$data = mysqli_query($koneksi, "SELECT * FROM siswa");
while($d = mysqli_fetch_array($data)){
?>
<tr>
    <td><img src="uploads/<?php echo $d['foto']; ?>" width="150"></td>
    <td><?php echo $d['nrp']; ?></td>
    <td><?php echo $d['nama']; ?></td>
    <td><?php echo $d['jenis_kelamin']; ?></td>
    <td><?php echo $d['telepon']; ?></td>
    <td><?php echo $d['alamat']; ?></td>
    <td>
        <a href="ubah.php?id=<?php echo $d['id']; ?>">Ubah</a> |
        <a href="hapus.php?id=<?php echo $d['id']; ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
    </td>
</tr>
<?php } ?>
</table>

</body>
</html>