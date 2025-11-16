<?php include 'config.php';

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id='$id'");
$d = mysqli_fetch_array($data);
?>

<h2>Ubah Data Siswa</h2>

<form method="post" enctype="multipart/form-data">
    NRP: <input type="text" name="nrp" value="<?= $d['nrp']; ?>"><br><br>
    Nama: <input type="text" name="nama" value="<?= $d['nama']; ?>"><br><br>

    Jenis Kelamin:
    <select name="jenis_kelamin">
        <option value="laki-laki" <?= $d['jenis_kelamin']=="laki-laki"?"selected":"" ?>>Laki-Laki</option>
        <option value="perempuan" <?= $d['jenis_kelamin']=="perempuan"?"selected":"" ?>>Perempuan</option>
    </select><br><br>

    Telepon: <input type="text" name="telepon" value="<?= $d['telepon']; ?>"><br><br>
    Alamat: <textarea name="alamat"><?= $d['alamat']; ?></textarea><br><br>

    Foto Lama:<br>
    <img src="uploads/<?= $d['foto']; ?>" width="120"><br><br>

    Ganti Foto: <input type="file" name="foto"><br><br>

    <input type="submit" name="submit" value="Update">
</form>

<?php
if(isset($_POST['submit'])){
    $nrp = $_POST['nrp'];
    $nama = $_POST['nama'];
    $jk = $_POST['jenis_kelamin'];
    $telp = $_POST['telepon'];
    $alamat = $_POST['alamat'];

    if($_FILES['foto']['name'] != ""){
        $foto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        move_uploaded_file($tmp, "uploads/".$foto);
    } else {
        $foto = $d['foto'];
    }

    mysqli_query($koneksi, "UPDATE siswa SET 
        nrp='$nrp',
        nama='$nama',
        jenis_kelamin='$jk',
        telepon='$telp',
        alamat='$alamat',
        foto='$foto'
    WHERE id='$id'");

    echo "<script>alert('Data berhasil diupdate'); window.location='index.php';</script>";
}
?>