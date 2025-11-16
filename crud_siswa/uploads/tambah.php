<?php include 'config.php'; ?>

<h2>Tambah Data Siswa</h2>

<form method="post" enctype="multipart/form-data">
    NRP: <input type="text" name="nrp"><br><br>
    Nama: <input type="text" name="nama"><br><br>

    Jenis Kelamin:
    <select name="jenis_kelamin">
        <option value="laki-laki">Laki-Laki</option>
        <option value="perempuan">Perempuan</option>
    </select><br><br>

    Telepon: <input type="text" name="telepon"><br><br>
    Alamat: <textarea name="alamat"></textarea><br><br>

    Foto: <input type="file" name="foto"><br><br>

    <input type="submit" name="submit" value="Simpan">
</form>

<?php
if (isset($_POST['submit'])) {

    $nrp = $_POST['nrp'];
    $nama = $_POST['nama'];
    $jk = $_POST['jenis_kelamin'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];

    // FOTO
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    // PASTIKAN FOLDER uploads/ ADA
    if (!is_dir("uploads")) {
        mkdir("uploads", 0777, true);
    }

    move_uploaded_file($tmp, "uploads/" . $foto);

    // INSERT TANPA KOLOM ID (AUTO INCREMENT)
    $query = "INSERT INTO siswa (nrp, nama, jenis_kelamin, telepon, alamat, foto)
              VALUES ('$nrp', '$nama', '$jk', '$telepon', '$alamat', '$foto')";

    mysqli_query($koneksi, $query);

    echo "<script>alert('Data berhasil disimpan'); window.location='index.php';</script>";
}
?>